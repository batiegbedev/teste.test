# 🍳 Backend Laravel - Système de Gestion de Recettes

## 📋 Vue d'ensemble

Ce backend Laravel implémente un système complet de gestion de recettes avec authentification, gestion des rôles et permissions.

## 🏗️ Architecture

### Structure des dossiers
```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Auth/           # Contrôleurs d'authentification
│   │   ├── AdminController.php
│   │   ├── RecipeController.php
│   │   └── PermissionController.php
│   ├── Middleware/
│   │   ├── AdminMiddleware.php
│   │   └── EditeurMiddleware.php
│   └── Requests/
│       └── Auth/
├── Models/
│   ├── User.php
│   └── Recipe.php
└── Helpers/
    └── PermissionHelper.php
```

## 🔐 Système d'authentification

### Rôles utilisateurs
- **Admin** : Accès complet à toutes les fonctionnalités
- **Éditeur** : Peut créer et modifier du contenu
- **Abonné** : Accès en lecture seule

### Middleware de sécurité
- `AdminMiddleware` : Restreint l'accès aux administrateurs
- `EditeurMiddleware` : Restreint l'accès aux éditeurs et admins

## 📊 Modèles de données

### User
```php
// Champs principaux
- name (string)
- email (string, unique)
- password (string, hashed)
- role (string: admin|editeur|abonne)
- email_verified_at (timestamp)
```

### Recipe
```php
// Champs principaux
- title (string)
- description (text)
- ingredients (text)
- instructions (text)
- cooking_time (integer, minutes)
- difficulty (enum: facile|moyen|difficile)
- status (enum: draft|published|archived)
- user_id (foreign key)
- servings (integer)
- image_path (string, nullable)
```

## 🛣️ Routes principales

### Authentification
- `GET /login` - Page de connexion
- `POST /login` - Traitement de connexion
- `POST /logout` - Déconnexion
- `GET /register` - Page d'inscription
- `POST /register` - Traitement d'inscription

### Administration
- `GET /admin/dashboard` - Tableau de bord admin
- `GET /admin/users` - Liste des utilisateurs
- `GET /admin/users/{user}` - Détails utilisateur
- `PUT /admin/users/{user}` - Modifier utilisateur
- `DELETE /admin/users/{user}` - Supprimer utilisateur
- `GET /admin/permissions` - Gestion des permissions

### Recettes
- `GET /recipes` - Liste des recettes
- `GET /recipes/{recipe}` - Détails d'une recette
- `GET /recipes/create` - Créer une recette (éditeurs+)
- `POST /recipes` - Sauvegarder une recette
- `GET /recipes/{recipe}/edit` - Éditer une recette
- `PUT /recipes/{recipe}` - Mettre à jour une recette
- `DELETE /recipes/{recipe}` - Supprimer une recette

## 🔧 Configuration

### Fichier de configuration des rôles
`config/roles.php` définit :
- Les permissions par rôle
- La hiérarchie des rôles
- Le rôle par défaut

### Variables d'environnement
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=repice_web
DB_USERNAME=root
DB_PASSWORD=
```

## 🚀 Installation et démarrage

1. **Cloner le projet**
```bash
git clone <repository>
cd admin-dashboard
```

2. **Installer les dépendances**
```bash
composer install
npm install
```

3. **Configuration de l'environnement**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configuration de la base de données**
```bash
# Créer la base de données
mysql -u root -p
CREATE DATABASE repice_web CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

5. **Exécuter les migrations et seeders**
```bash
php artisan migrate
php artisan db:seed
```

6. **Démarrer le serveur**
```bash
php artisan serve
```

## 👥 Utilisateurs de test

Après avoir exécuté les seeders, vous pouvez vous connecter avec :

- **Admin** : `admin@example.com` / `password`
- **Éditeur** : `editeur@example.com` / `password`

## 🔒 Sécurité

### Fonctionnalités de sécurité implémentées
- Authentification Laravel Breeze
- Middleware de contrôle d'accès
- Validation des données
- Protection CSRF
- Rate limiting sur les tentatives de connexion
- Hachage des mots de passe

### Bonnes pratiques
- Vérification des permissions avant chaque action
- Validation des données côté serveur
- Protection contre les injections SQL (Eloquent ORM)
- Gestion sécurisée des sessions

## 📈 Fonctionnalités avancées

### Gestion des permissions
- Système de permissions basé sur les rôles
- Hiérarchie des rôles
- Helper pour vérifier les permissions

### Statistiques
- Nombre total d'utilisateurs par rôle
- Statistiques des recettes
- Tableau de bord administrateur

### Gestion du contenu
- Système de brouillon/publication
- Contrôle d'accès au contenu
- Pagination des résultats

## 🧪 Tests

```bash
# Exécuter tous les tests
php artisan test

# Tests spécifiques
php artisan test --filter=Auth
php artisan test --filter=Recipe
```

## 📝 API Endpoints (futur)

Le système est préparé pour une API REST :
- Routes API dans `routes/api.php`
- Contrôleurs API dédiés
- Authentification par token

## 🔄 Maintenance

### Commandes utiles
```bash
# Vider le cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear

# Optimiser l'application
php artisan optimize

# Surveiller les logs
tail -f storage/logs/laravel.log
```

## 🤝 Contribution

1. Fork le projet
2. Créer une branche feature
3. Commiter les changements
4. Pousser vers la branche
5. Ouvrir une Pull Request

## 📄 Licence

Ce projet est sous licence MIT.
