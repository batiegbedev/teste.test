<?php
// Script de test pour vérifier la connexion à la base de données

echo "=== Test de connexion à la base de données ===\n";

try {
    // Connexion à la base de données
    $pdo = new PDO(
        'mysql:host=127.0.0.1;dbname=repice_web;charset=utf8mb4',
        'root',
        '',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    
    echo "✅ Connexion à la base de données réussie !\n";
    
    // Vérifier si la table users existe
    $stmt = $pdo->query("SHOW TABLES LIKE 'users'");
    if ($stmt->rowCount() > 0) {
        echo "✅ Table 'users' trouvée !\n";
        
        // Compter les utilisateurs
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM users");
        $count = $stmt->fetch()['count'];
        echo "📊 Nombre d'utilisateurs dans la base : $count\n";
        
        // Lister les utilisateurs
        $stmt = $pdo->query("SELECT id, name, email, role FROM users");
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "\n👥 Utilisateurs dans la base :\n";
        foreach ($users as $user) {
            echo "- ID: {$user['id']}, Nom: {$user['name']}, Email: {$user['email']}, Rôle: {$user['role']}\n";
        }
        
    } else {
        echo "❌ Table 'users' non trouvée !\n";
        echo "💡 Exécutez le script create_test_user.sql dans phpMyAdmin\n";
    }
    
    // Vérifier si la table recipes existe
    $stmt = $pdo->query("SHOW TABLES LIKE 'recipes'");
    if ($stmt->rowCount() > 0) {
        echo "✅ Table 'recipes' trouvée !\n";
        
        // Compter les recettes
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM recipes");
        $count = $stmt->fetch()['count'];
        echo "📊 Nombre de recettes dans la base : $count\n";
    } else {
        echo "❌ Table 'recipes' non trouvée !\n";
    }
    
} catch (PDOException $e) {
    echo "❌ Erreur de connexion : " . $e->getMessage() . "\n";
    echo "\n💡 Solutions possibles :\n";
    echo "1. Vérifiez que XAMPP est démarré (Apache et MySQL)\n";
    echo "2. Vérifiez que la base de données 'repice_web' existe\n";
    echo "3. Vérifiez les identifiants de connexion\n";
}

echo "\n=== Fin du test ===\n";
?>
