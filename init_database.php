<?php
try {
    // Connexion à MySQL sans sélectionner de base de données
    $pdo = new PDO(
        "mysql:host=127.0.0.1;charset=utf8mb4",
        "root",
        "",
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    echo "Connexion à MySQL réussie!\n";

    // Création de la base de données si elle n'existe pas
    $pdo->exec("CREATE DATABASE IF NOT EXISTS astro_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "Base de données 'astro_db' vérifiée/créée.\n";

    // Sélection de la base de données
    $pdo->exec("USE astro_db");

    // Création de la table movies
    $pdo->exec("CREATE TABLE IF NOT EXISTS movies (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        description TEXT,
        image VARCHAR(255),
        rating DECIMAL(3,1) DEFAULT 0.0,
        views INT DEFAULT 0,
        is_featured BOOLEAN DEFAULT FALSE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
    echo "Table 'movies' créée.\n";

    // Création de la table categories
    $pdo->exec("CREATE TABLE IF NOT EXISTS categories (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        slug VARCHAR(100) NOT NULL UNIQUE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
    echo "Table 'categories' créée.\n";

    // Création de la table movie_categories (relation many-to-many)
    $pdo->exec("CREATE TABLE IF NOT EXISTS movie_categories (
        movie_id INT,
        category_id INT,
        PRIMARY KEY (movie_id, category_id),
        FOREIGN KEY (movie_id) REFERENCES movies(id) ON DELETE CASCADE,
        FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
    echo "Table 'movie_categories' créée.\n";

    // Insertion de quelques catégories de base
    $categories = [
        ['Action', 'action'],
        ['Comédie', 'comedie'],
        ['Drame', 'drame'],
        ['Science-Fiction', 'science-fiction'],
        ['Thriller', 'thriller']
    ];

    $stmt = $pdo->prepare("INSERT IGNORE INTO categories (name, slug) VALUES (?, ?)");
    foreach ($categories as $category) {
        $stmt->execute($category);
    }
    echo "Catégories de base insérées.\n";

    // Insertion de quelques films de test
    $movies = [
        [
            'title' => 'Aventures Intergalactiques',
            'description' => 'Une épopée spatiale captivante',
            'image' => 'img/movie1.jpg',
            'rating' => 4.8,
            'is_featured' => 1
        ],
        [
            'title' => 'Le Mystère de l\'Océan',
            'description' => 'Un thriller sous-marin',
            'image' => 'img/movie2.jpg',
            'rating' => 4.5,
            'is_featured' => 1
        ]
    ];

    $stmt = $pdo->prepare("INSERT INTO movies (title, description, image, rating, is_featured) VALUES (?, ?, ?, ?, ?)");
    foreach ($movies as $movie) {
        $stmt->execute([
            $movie['title'],
            $movie['description'],
            $movie['image'],
            $movie['rating'],
            $movie['is_featured']
        ]);
    }
    echo "Films de test insérés.\n";

    echo "\nInitialisation de la base de données terminée avec succès!\n";

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage() . "\n";
    echo "Code d'erreur : " . $e->getCode() . "\n";
    
    if (strpos($e->getMessage(), "Connection refused") !== false) {
        echo "\nSuggestions pour résoudre le problème :\n";
        echo "1. Vérifiez que XAMPP est installé\n";
        echo "2. Ouvrez le panneau de contrôle XAMPP\n";
        echo "3. Démarrez le service MySQL\n";
        echo "4. Attendez que le statut passe au vert\n";
        echo "5. Réessayez ce script\n";
    }
} 