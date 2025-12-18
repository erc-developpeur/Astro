<?php
try {
    $pdo = new PDO(
        "mysql:host=localhost;charset=utf8mb4",
        "root",
        "",
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    echo "Connexion à MySQL réussie!\n";
    
    // Vérifier si la base de données existe
    $result = $pdo->query("SHOW DATABASES LIKE 'astro_db'");
    if ($result->rowCount() > 0) {
        echo "La base de données 'astro_db' existe.\n";
    } else {
        echo "La base de données 'astro_db' n'existe pas.\n";
        // Créer la base de données
        $pdo->exec("CREATE DATABASE astro_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        echo "Base de données 'astro_db' créée avec succès.\n";
    }
    
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage() . "\n";
    echo "Code d'erreur : " . $e->getCode() . "\n";
    
    // Vérifier si MySQL est en cours d'exécution
    if (strpos($e->getMessage(), "Connection refused") !== false) {
        echo "\nSuggestions pour résoudre le problème :\n";
        echo "1. Vérifiez que MySQL est installé\n";
        echo "2. Vérifiez que le service MySQL est en cours d'exécution\n";
        echo "3. Sur Windows, ouvrez les Services et démarrez 'MySQL'\n";
        echo "4. Sur XAMPP, démarrez MySQL depuis le panneau de contrôle\n";
    }
} 