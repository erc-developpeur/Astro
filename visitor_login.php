<?php
session_start();

// Création directe de la session visiteur
$_SESSION['visitor'] = true;
$_SESSION['user_id'] = 'visitor_' . uniqid();
$_SESSION['username'] = 'Visiteur';
$_SESSION['email'] = 'visiteur@example.com';
$_SESSION['role'] = 'visitor';
$_SESSION['avatar'] = 'www/img/default-avatar.png';

// Retourner une réponse JSON
header('Content-Type: application/json');
echo json_encode(['success' => true]);
?> 