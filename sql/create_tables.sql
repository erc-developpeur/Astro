-- Création de la table users
CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    role ENUM('visitor', 'user', 'admin') DEFAULT 'visitor',
    avatar VARCHAR(255) DEFAULT 'default_avatar.jpg',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL,
    is_active BOOLEAN DEFAULT TRUE
);

-- Création de la table user_likes
CREATE TABLE IF NOT EXISTS user_likes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    content_id INT NOT NULL,
    content_type ENUM('serie', 'movie') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_user_content (user_id, content_id, content_type)
);

-- Création de la table user_watchlist
CREATE TABLE IF NOT EXISTS user_watchlist (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    content_id INT NOT NULL,
    content_type ENUM('serie', 'movie') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_user_watchlist (user_id, content_id, content_type)
);

-- Création de la table views
CREATE TABLE IF NOT EXISTS views (
    id INT PRIMARY KEY AUTO_INCREMENT,
    content_id INT NOT NULL,
    content_type ENUM('serie', 'movie') NOT NULL,
    user_id INT,
    ip_address VARCHAR(45),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Création de la table user_history
CREATE TABLE IF NOT EXISTS user_history (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    content_id INT NOT NULL,
    content_type ENUM('serie', 'movie') NOT NULL,
    watched_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_user_content_history (user_id, content_id, content_type)
);

-- Création de la table comments
CREATE TABLE IF NOT EXISTS comments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    media_id INT NOT NULL,
    media_type ENUM('movie', 'serie') NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_media (media_id, media_type)
);

-- Insertion d'un utilisateur visiteur par défaut
INSERT INTO users (username, email, password, role) VALUES ('visiteur', 'visiteur@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'visitor'); 