<?php
session_start();
require_once 'config/dbconfig.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Vous devez être connecté pour ajouter des médias à votre liste']);
    exit;
}

$media_id = $_POST['media_id'] ?? null;
$media_type = $_POST['media_type'] ?? null;

if (!$media_id || !$media_type) {
    echo json_encode(['success' => false, 'message' => 'Données manquantes']);
    exit;
}

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET,
        DB_USER,
        DB_PASS
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifier si le média est déjà dans la liste
    $stmt = $pdo->prepare("SELECT * FROM user_watchlist WHERE user_id = ? AND media_id = ? AND media_type = ?");
    $stmt->execute([$_SESSION['user_id'], $media_id, $media_type]);
    $exists = $stmt->fetch();

    if ($exists) {
        // Supprimer de la liste
        $stmt = $pdo->prepare("DELETE FROM user_watchlist WHERE user_id = ? AND media_id = ? AND media_type = ?");
        $stmt->execute([$_SESSION['user_id'], $media_id, $media_type]);
        echo json_encode(['success' => true, 'message' => 'Média retiré de votre liste', 'action' => 'remove']);
    } else {
        // Ajouter à la liste
        $stmt = $pdo->prepare("INSERT INTO user_watchlist (user_id, media_id, media_type) VALUES (?, ?, ?)");
        $stmt->execute([$_SESSION['user_id'], $media_id, $media_type]);
        echo json_encode(['success' => true, 'message' => 'Média ajouté à votre liste', 'action' => 'add']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Une erreur est survenue lors de la mise à jour de votre liste']);
} 