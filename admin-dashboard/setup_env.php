<?php
// Script pour configurer automatiquement le fichier .env

echo "=== Configuration du fichier .env ===\n";

// Lire le fichier .env
$envContent = file_get_contents('.env');

// Configuration de la base de données
$envContent = str_replace('DB_DATABASE=laravel', 'DB_DATABASE=repice_web', $envContent);
$envContent = str_replace('DB_USERNAME=root', 'DB_USERNAME=root', $envContent);
$envContent = str_replace('DB_PASSWORD=', 'DB_PASSWORD=', $envContent);

// Configuration de l'application
$envContent = str_replace('APP_NAME=Laravel', 'APP_NAME="Recipe Web"', $envContent);
$envContent = str_replace('APP_ENV=local', 'APP_ENV=local', $envContent);
$envContent = str_replace('APP_DEBUG=true', 'APP_DEBUG=true', $envContent);

// Écrire le fichier .env modifié
file_put_contents('.env', $envContent);

echo "✅ Fichier .env configuré avec succès !\n";
echo "📋 Configuration :\n";
echo "- Base de données : repice_web\n";
echo "- Utilisateur : root\n";
echo "- Mot de passe : (vide)\n";
echo "- Nom de l'app : Recipe Web\n";
echo "- Debug : activé\n";

echo "\n=== Configuration terminée ===\n";
?>
