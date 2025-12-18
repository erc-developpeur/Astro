<?php
require_once 'config/dbconfig.php';

try {
    $dbConfig = require_once 'config/dbconfig.php';
    $pdo = new PDO(
        "mysql:host=" . $dbConfig['host'] . ";dbname=" . $dbConfig['database'] . ";charset=" . $dbConfig['charset'],
        $dbConfig['username'],
        $dbConfig['password']
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifier si la table comments existe
    $result = $pdo->query("SHOW TABLES LIKE 'comments'");
    if ($result->rowCount() == 0) {
        // Créer la table comments
        $sql = "CREATE TABLE IF NOT EXISTS comments (
            id INT PRIMARY KEY AUTO_INCREMENT,
            user_id INT NOT NULL,
            media_id INT NOT NULL,
            media_type ENUM('movie', 'serie') NOT NULL,
            content TEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
            INDEX idx_media (media_id, media_type)
        )";
        $pdo->exec($sql);
        echo "La table comments a été créée avec succès.\n";
    } else {
        echo "La table comments existe déjà.\n";
    }

    // Vérifier la structure de la table
    $columns = $pdo->query("DESCRIBE comments")->fetchAll(PDO::FETCH_COLUMN);
    echo "Colonnes de la table comments :\n";
    print_r($columns);

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage() . "\n";
}
?> 