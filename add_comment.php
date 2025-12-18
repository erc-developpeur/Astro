<?php
session_start();
require_once 'config/dbconfig.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $media_id = $_POST['media_id'] ?? null;
    $media_type = $_POST['media_type'] ?? null;
    $comment = $_POST['comment'] ?? '';

    if (!$media_id || !$media_type || empty($comment)) {
        header('Location: player.php?id=' . $media_id . '&type=' . $media_type . '&error=1');
        exit;
    }

    try {
        $dbConfig = require_once 'config/dbconfig.php';
        $pdo = new PDO(
            "mysql:host=" . $dbConfig['host'] . ";dbname=" . $dbConfig['database'] . ";charset=" . $dbConfig['charset'],
            $dbConfig['username'],
            $dbConfig['password']
        );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("INSERT INTO comments (user_id, media_id, media_type, content) VALUES (?, ?, ?, ?)");
        $stmt->execute([$_SESSION['user_id'], $media_id, $media_type, $comment]);

        header('Location: player.php?id=' . $media_id . '&type=' . $media_type . '&success=1');
        exit;
    } catch (PDOException $e) {
        error_log("Erreur lors de l'ajout du commentaire: " . $e->getMessage());
        header('Location: player.php?id=' . $media_id . '&type=' . $media_type . '&error=2');
        exit;
    }
}
?> 