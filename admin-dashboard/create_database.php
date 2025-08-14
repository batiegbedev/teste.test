<?php
// Script pour créer la base de données et les tables

echo "=== Création de la base de données et des tables ===\n";

try {
    // Connexion à MySQL sans spécifier de base de données
    $pdo = new PDO(
        'mysql:host=127.0.0.1;charset=utf8mb4',
        'root',
        '',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    
    echo "✅ Connexion à MySQL réussie !\n";
    
    // Créer la base de données
    $pdo->exec("CREATE DATABASE IF NOT EXISTS repice_web CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "✅ Base de données 'repice_web' créée !\n";
    
    // Se connecter à la base de données créée
    $pdo = new PDO(
        'mysql:host=127.0.0.1;dbname=repice_web;charset=utf8mb4',
        'root',
        '',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    
    // Créer la table users
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) UNIQUE NOT NULL,
        email_verified_at TIMESTAMP NULL,
        password VARCHAR(255) NOT NULL,
        role VARCHAR(255) DEFAULT 'abonne',
        remember_token VARCHAR(100) NULL,
        created_at TIMESTAMP NULL,
        updated_at TIMESTAMP NULL
    )";
    
    $pdo->exec($sql);
    echo "✅ Table 'users' créée !\n";
    
    // Créer la table recipes
    $sql = "CREATE TABLE IF NOT EXISTS recipes (
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
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    )";
    
    $pdo->exec($sql);
    echo "✅ Table 'recipes' créée !\n";
    
    // Insérer les utilisateurs de test
    $sql = "INSERT INTO users (name, email, password, role, created_at, updated_at) VALUES 
        ('Administrateur', 'admin@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', NOW(), NOW()),
        ('Éditeur', 'editeur@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'editeur', NOW(), NOW()),
        ('Abonné', 'abonne@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'abonne', NOW(), NOW())
        ON DUPLICATE KEY UPDATE 
            name = VALUES(name),
            role = VALUES(role),
            updated_at = NOW()";
    
    $pdo->exec($sql);
    echo "✅ Utilisateurs de test créés !\n";
    
    // Insérer les recettes de test
    $sql = "INSERT INTO recipes (title, description, ingredients, instructions, cooking_time, difficulty, status, user_id, servings, created_at, updated_at) VALUES 
        ('Pasta Carbonara', 'Délicieuse recette de pâtes à la carbonara', '400g de spaghetti\n200g de pancetta\n4 œufs\n100g de parmesan', '1. Cuire les pâtes\n2. Faire revenir la pancetta\n3. Mélanger avec les œufs', 20, 'moyen', 'published', 2, 4, NOW(), NOW()),
        ('Tiramisu', 'Dessert italien classique', '6 œufs\n500g de mascarpone\nBiscuits à la cuillère', '1. Préparer la crème\n2. Tremper les biscuits\n3. Alterner les couches', 30, 'facile', 'published', 2, 6, NOW(), NOW())
        ON DUPLICATE KEY UPDATE 
            updated_at = NOW()";
    
    $pdo->exec($sql);
    echo "✅ Recettes de test créées !\n";
    
    echo "\n🎉 Base de données configurée avec succès !\n";
    echo "\n📋 Identifiants de connexion :\n";
    echo "- Admin: admin@example.com / password\n";
    echo "- Éditeur: editeur@example.com / password\n";
    echo "- Abonné: abonne@example.com / password\n";
    
} catch (PDOException $e) {
    echo "❌ Erreur : " . $e->getMessage() . "\n";
    echo "\n💡 Vérifiez que :\n";
    echo "1. XAMPP est démarré (Apache et MySQL)\n";
    echo "2. MySQL fonctionne correctement\n";
}

echo "\n=== Fin de la configuration ===\n";
?>
