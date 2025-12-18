<?php
session_start();

// Vérifier si un fichier a été uploadé
if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
    $file = $_FILES['avatar'];
    
    // Vérifier le type de fichier
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($file['type'], $allowed_types)) {
        $_SESSION['error'] = "Type de fichier non autorisé. Utilisez JPG, PNG ou GIF.";
        header('Location: profile.php');
        exit;
    }
    
    // Vérifier la taille du fichier (max 2MB)
    if ($file['size'] > 2 * 1024 * 1024) {
        $_SESSION['error'] = "L'image est trop grande. Maximum 2MB.";
        header('Location: profile.php');
        exit;
    }
    
    // Créer le dossier uploads s'il n'existe pas
    $upload_dir = 'www/uploads/avatars/';
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    
    // Générer un nom de fichier unique
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = 'avatar_' . (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'temp') . '_' . time() . '.' . $extension;
    $filepath = $upload_dir . $filename;
    
    // Déplacer le fichier
    if (move_uploaded_file($file['tmp_name'], $filepath)) {
        // Mettre à jour le chemin de l'avatar dans la session
        $_SESSION['avatar'] = 'uploads/avatars/' . $filename;
        
        // Si l'utilisateur est connecté, mettre à jour la base de données
        if (isset($_SESSION['user_id'])) {
            require_once 'config/database.php';
            $conn = getDBConnection();
            
            $stmt = $conn->prepare("UPDATE users SET avatar = ? WHERE id = ?");
            $stmt->bind_param("si", $_SESSION['avatar'], $_SESSION['user_id']);
            $stmt->execute();
            $stmt->close();
            $conn->close();
        }
        
        $_SESSION['success'] = "Avatar mis à jour avec succès!";
    } else {
        $_SESSION['error'] = "Erreur lors du téléchargement de l'image.";
    }
} else {
    $_SESSION['error'] = "Aucun fichier n'a été uploadé ou une erreur est survenue.";
}

header('Location: profile.php');
exit; 