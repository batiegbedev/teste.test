# 🍃 Duggarswad - Site de Recettes Traditionnelles

Un site web moderne et responsive pour partager et découvrir les recettes traditionnelles du Jammu, créé avec HTML, CSS et JavaScript.

## 📋 Description

Duggarswad est une plateforme dédiée à la préservation et au partage des saveurs traditionnelles du pays Duggar. Le site permet aux utilisateurs de découvrir des recettes authentiques transmises de génération en génération.

## ✨ Fonctionnalités

### Frontend
- **Design Responsive** : Interface adaptée à tous les appareils
- **Navigation Interactive** : Menu de navigation avec états actifs
- **Recherche de Recettes** : Barre de recherche en temps réel
- **Filtrage par Catégorie** : Système de filtrage avancé
- **Newsletter** : Système d'abonnement avec validation
- **Animations** : Effets visuels et transitions fluides
- **Menu Mobile** : Navigation adaptée aux appareils mobiles

### Sections Principales
1. **Header** : Logo et navigation principale
2. **Hero Section** : Section d'accueil avec appel à l'action
3. **Statistiques** : Compteurs animés des recettes et contributeurs
4. **Catégories** : Onglets pour filtrer le contenu
5. **Recherche** : Barre de recherche et filtres
6. **Recettes** : Affichage des recettes avec images
7. **Newsletter** : Formulaire d'abonnement
8. **Footer** : Informations de contact et liens

## 🛠️ Technologies Utilisées

- **HTML5** : Structure sémantique
- **CSS3** : Styles modernes avec Flexbox et Grid
- **JavaScript (ES6+)** : Interactivité et animations
- **Font Awesome** : Icônes
- **Responsive Design** : Mobile-first approach

## 📁 Structure du Projet

```
duggarswad-blog/
├── index.html          # Page d'accueil
├── css/
│   └── style.css       # Styles principaux
├── js/
│   └── script.js       # JavaScript interactif
├── images/             # Images du site
└── README.md          # Documentation
```

## 🚀 Installation et Utilisation

### Prérequis
- Navigateur web moderne (Chrome, Firefox, Safari, Edge)
- Serveur web local (optionnel)

### Installation
1. Clonez ou téléchargez le projet
2. Ouvrez le fichier `index.html` dans votre navigateur
3. Ou utilisez un serveur local pour de meilleures performances

### Serveur Local (Recommandé)
```bash
# Avec Python 3
python -m http.server 8000

# Avec Node.js (si vous avez http-server installé)
npx http-server

# Avec PHP
php -S localhost:8000
```

Puis ouvrez `http://localhost:8000` dans votre navigateur.

## 🎨 Design et UX

### Palette de Couleurs
- **Rouge Principal** : `#e74c3c` (Logo, accents, boutons)
- **Rouge Foncé** : `#c0392b` (Hover states)
- **Gris Foncé** : `#2c3e50` (Footer)
- **Gris Clair** : `#f8f9fa` (Sections alternées)
- **Blanc** : `#ffffff` (Arrière-plans)

### Typographie
- **Police Principale** : Segoe UI, Tahoma, Geneva, Verdana, sans-serif
- **Hiérarchie** : Tailles de 14px à 48px selon l'importance

### Responsive Breakpoints
- **Mobile** : < 480px
- **Tablet** : 480px - 768px
- **Desktop** : > 768px

## 🔧 Fonctionnalités JavaScript

### Navigation
- Gestion des états actifs
- Smooth scroll pour les liens internes
- Menu mobile responsive

### Recherche et Filtrage
- Recherche en temps réel
- Filtrage par catégorie
- Onglets interactifs

### Animations
- Intersection Observer pour les animations au scroll
- Animation des compteurs de statistiques
- Transitions fluides

### Newsletter
- Validation d'email
- Notifications utilisateur
- Gestion des formulaires

## 📱 Responsive Design

Le site est entièrement responsive avec :
- **Mobile-first approach**
- **Flexbox et Grid CSS**
- **Images adaptatives**
- **Menu hamburger pour mobile**
- **Typographie scalable**

## 🔮 Fonctionnalités Futures

### Backend (Laravel)
- Système d'authentification
- Gestion des recettes (CRUD)
- Base de données MySQL/PostgreSQL
- API RESTful
- Upload d'images
- Système de commentaires

### Frontend Avancé
- PWA (Progressive Web App)
- Mode sombre
- Animations plus avancées
- Lazy loading des images
- Service Worker pour le cache

## 🤝 Contribution

Pour contribuer au projet :

1. Fork le repository
2. Créez une branche pour votre fonctionnalité
3. Committez vos changements
4. Poussez vers la branche
5. Ouvrez une Pull Request

## 📄 Licence

Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus de détails.

## 👨‍💻 Développeur

Créé avec ❤️ pour préserver le patrimoine culinaire de Jammu.

## 📞 Contact

- **Email** : info@duggarswad.com
- **Téléphone** : +91 9876543210
- **Adresse** : Jammu, Jammu-et-Cachemire, Inde

---

**Note** : Ce projet est actuellement en version frontend uniquement. Le backend Laravel sera ajouté dans une phase ultérieure pour permettre la gestion complète des recettes et des utilisateurs.
