-- Script pour créer un utilisateur de test
-- Exécutez ce script dans votre base de données MySQL

-- Créer la base de données si elle n'existe pas
CREATE DATABASE IF NOT EXISTS repice_web CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE repice_web;

-- Créer la table users si elle n'existe pas
CREATE TABLE IF NOT EXISTS users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(255) DEFAULT 'abonne',
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- Insérer un utilisateur admin de test
-- Mot de passe: password (hashé avec bcrypt)
INSERT INTO users (name, email, password, role, created_at, updated_at) VALUES 
('Administrateur', 'admin@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', NOW(), NOW()),
('Éditeur', 'editeur@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'editeur', NOW(), NOW()),
('Abonné', 'abonne@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'abonne', NOW(), NOW())
ON DUPLICATE KEY UPDATE 
    name = VALUES(name),
    role = VALUES(role),
    updated_at = NOW();

-- Créer la table recipes si elle n'existe pas
CREATE TABLE IF NOT EXISTS recipes (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    ingredients TEXT NOT NULL,
    instructions TEXT NOT NULL,
    cooking_time INT NOT NULL,
    difficulty ENUM('facile', 'moyen', 'difficile') NOT NULL,
    status ENUM('draft', 'published', 'archived') DEFAULT 'draft',
    user_id BIGINT UNSIGNED NOT NULL,
    image_path VARCHAR(255) NULL,
    servings INT DEFAULT 4,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_status_created (status, created_at),
    INDEX idx_user_status (user_id, status)
);

-- Insérer quelques recettes de test
INSERT INTO recipes (title, description, ingredients, instructions, cooking_time, difficulty, status, user_id, servings, created_at, updated_at) VALUES 
('Pasta Carbonara', 'Délicieuse recette de pâtes à la carbonara', '400g de spaghetti\n200g de pancetta\n4 œufs\n100g de parmesan', '1. Cuire les pâtes\n2. Faire revenir la pancetta\n3. Mélanger avec les œufs', 20, 'moyen', 'published', 2, 4, NOW(), NOW()),
('Tiramisu', 'Dessert italien classique', '6 œufs\n500g de mascarpone\nBiscuits à la cuillère', '1. Préparer la crème\n2. Tremper les biscuits\n3. Alterner les couches', 30, 'facile', 'published', 2, 6, NOW(), NOW())
ON DUPLICATE KEY UPDATE 
    updated_at = NOW();

SELECT 'Utilisateurs de test créés avec succès!' as message;
SELECT 'Email: admin@example.com, Mot de passe: password' as admin_credentials;
SELECT 'Email: editeur@example.com, Mot de passe: password' as editor_credentials;
SELECT 'Email: abonne@example.com, Mot de passe: password' as subscriber_credentials;
