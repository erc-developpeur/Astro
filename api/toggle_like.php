<?php
session_start();
header('Content-Type: application/json');

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Utilisateur non connecté']);
    exit;
}

// Récupérer les données POST
$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'] ?? null;
$type = $data['type'] ?? null;

if (!$id || !$type) {
    echo json_encode(['success' => false, 'message' => 'Données manquantes']);
    exit;
}

try {
    // Récupération de la configuration de la base de données
    $dbConfig = require_once __DIR__ . '/../config/dbconfig.php';
    
    // Connexion à la base de données
    $conn = new mysqli(
        $dbConfig['host'],
        $dbConfig['username'],
        $dbConfig['password'],
        $dbConfig['database']
    );
    
    if ($conn->connect_error) {
        throw new Exception("Connexion échouée: " . $conn->connect_error);
    }

    // Vérifier si le like existe déjà
    $table = ($type === 'movie') ? 'user_likes' : 'user_likes';
    $idColumn = ($type === 'movie') ? 'movie_id' : 'serie_id';
    
    $checkSql = "SELECT * FROM $table WHERE user_id = ? AND $idColumn = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("ii", $_SESSION['user_id'], $id);
    $checkStmt->execute();
    $result = $checkStmt->get_result();
    
    if ($result->num_rows > 0) {
        // Supprimer le like
        $deleteSql = "DELETE FROM $table WHERE user_id = ? AND $idColumn = ?";
        $deleteStmt = $conn->prepare($deleteSql);
        $deleteStmt->bind_param("ii", $_SESSION['user_id'], $id);
        $deleteStmt->execute();
        $success = $deleteStmt->affected_rows > 0;
    } else {
        // Ajouter le like
        $insertSql = "INSERT INTO $table (user_id, $idColumn) VALUES (?, ?)";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bind_param("ii", $_SESSION['user_id'], $id);
        $insertStmt->execute();
        $success = $insertStmt->affected_rows > 0;
    }
    
    $conn->close();
    
    echo json_encode(['success' => $success]);
    
} catch (Exception $e) {
    error_log("Erreur dans toggle_like.php: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Erreur serveur']);
} 