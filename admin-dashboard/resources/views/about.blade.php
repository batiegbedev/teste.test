<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À propos de nous - Duggarswad</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/about.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- Header -->
     <!-- Header -->
     <header class="header">
        <div class="container">
            <div class="logo">
                <div class="logo-icon">
                    <a href="{{ url('/welcome') }}"><img src="images/logo/logo.jpeg" alt="logo" class="logo-img"></a>
                </div>
                <span class="logo-text">Duggarswad</span>
            </div>
                    <nav class="nav">
                        <ul class="nav-list">
                            <li><a href="{{ url('/welcome') }}" class="nav-link active">Maison</a></li>
                            <li><a href="{{ url('/about') }}" class="nav-link">À propos de nous</a></li>
                            <li><a href="{{ url('/contact') }}" class="nav-link">Contact</a></li>
                            <li><a href="{{ url('/post-recipe') }}" class="nav-link">Postez votre recette</a></li>
                            <li><a href="{{ url('/login') }}" class="nav-link">Accès administrateur</a></li>
                        </ul>
                    </nav>
        </div>
        
    </header>

    <!-- Hero Section -->
    <section class="about-hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1 class="hero-title">À propos de Duggarswad</h1>
                    <p class="hero-subtitle">Préserver le patrimoine culinaire du Jammu-et-Cachemire</p>
                </div>
                
            </div>
        </div>
    </section>

    <!-- Notre Histoire Section -->
    <section class="our-story">
        <div class="container">
            <div class="story-content">
                <div class="story-text">
                    <h2 class="story-title">Notre histoire</h2>
                    <p class="story-paragraph">
                        Duggarswad est née d'un amour profond pour la cuisine traditionnelle du Jammu-et-Cachemire et d'une prise de conscience urgente : nos trésors culinaires disparaissent lentement. Avec la disparition progressive des recettes de nos grands-mères et l'avènement des commodités modernes, nous risquons de perdre un patrimoine culinaire riche et unique.
                    </p>
                    <p class="story-paragraph">
                        Le nom "Duggarswad" combine "Duggar" - se référant au peuple et à la région Dogra - et "swad" - signifiant "goût" en hindi. Notre mission est de capturer et partager les saveurs authentiques de notre terre natale, en préservant les techniques traditionnelles et les histoires qui accompagnent chaque recette.
                    </p>
                    <p class="story-paragraph">
                        Chaque recette partagée évoque la chaleur des cuisines familiales, la joie des préparations festives et l'amour mis à nourrir nos familles. La nourriture n'est pas seulement un moyen de subsistance, c'est une culture, une mémoire et une identité.
                    </p>
                </div>
                <div class="story-image">
                    <img src="images/images_pages/caffee.jpeg" alt="Boisson traditionnelle avec épices" class="story-img">
                </div>
            </div>
        </div>
    </section>

    <!-- Notre Mission Section -->
    <section class="our-mission">
        <div class="container">
            <h2 class="section-title">Notre mission</h2>
            <div class="mission-cards">
                <div class="mission-card">
                    <div class="mission-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3 class="mission-title">Préserver le patrimoine</h3>
                    <p class="mission-description">
                        Documenter et préserver les recettes traditionnelles qui risquent d'être oubliées, en veillant à ce qu'elles soient transmises aux générations futures.
                    </p>
                </div>
                <div class="mission-card">
                    <div class="mission-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="mission-title">Construire une communauté</h3>
                    <p class="mission-description">
                        Créez une plateforme où les gens peuvent partager leurs recettes familiales et se connecter autour de leur amour pour la cuisine traditionnelle.
                    </p>
                </div>
                <div class="mission-card">
                    <div class="mission-icon">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <h3 class="mission-title">Partager les connaissances</h3>
                    <p class="mission-description">
                        Rendre les techniques et recettes de cuisine traditionnelles accessibles à tous, quel que soit leur lieu de résidence ou leur origine.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Ce que nous défendons Section -->
    <section class="our-values">
        <div class="container">
            <h2 class="section-title">Ce que nous défendons</h2>
            <div class="values-grid">
                <div class="value-card">
                    <h3 class="value-title">Authenticité</h3>
                    <p class="value-description">
                        Nous privilégions les recettes authentiques et traditionnelles plutôt que les adaptations modernes, garantissant ainsi la préservation de la véritable essence de la cuisine Dogra.
                    </p>
                </div>
                <div class="value-card">
                    <h3 class="value-title">Communauté</h3>
                    <p class="value-description">
                        Chaque recette est accompagnée d'une histoire, nous reliant aux personnes et aux traditions qui rendent notre cuisine spéciale.
                    </p>
                </div>
                <div class="value-card">
                    <h3 class="value-title">Accessibilité</h3>
                    <p class="value-description">
                        Nous permettons à chacun de contribuer et d'apprendre facilement, en supprimant les barrières au partage des connaissances culinaires.
                    </p>
                </div>
                <div class="value-card">
                    <h3 class="value-title">Qualité</h3>
                    <p class="value-description">
                        Chaque recette est soigneusement examinée pour garantir son exactitude et son authenticité avant d'être partagée avec notre communauté.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Rejoignez notre mission Section -->
    <section class="join-mission">
        <div class="container">
            <div class="mission-content">
                <h2>Rejoignez notre mission</h2>
                <p class="mission-subtitle">
                    Aidez-nous à préserver le riche patrimoine culinaire du Jammu-et-Cachemire en partageant vos recettes familiales
                </p>
                <div class="mission-buttons">
                    <button class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Partagez votre recette
                    </button>
                    <button class="btn btn-secondary">
                        Entrer en contact
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <div class="footer-logo">
                        <div class="logo-icon">
                            <a href="{{ url('/welcome') }}"><img src="images/logo/logo.jpeg" alt="logo" class="logo-img"></a>
                        </div>
                        <span class="logo-text">Duggarswad</span>
                    </div>
                    <p class="footer-description">
                        Préserver les saveurs traditionnelles du Jammu, une recette à la fois.
                    </p>
                    <div class="social-links">
                        <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

                <div class="footer-section">
                    <h3 class="footer-title">Liens rapides</h3>
                    <ul class="footer-links">
                        <li><a href="{{ url('/welcome') }}">Maison</a></li>
                        <li><a href="{{ url('/about') }}">À propos de nous</a></li>
                        <li><a href="{{ url('/contact') }}">Contact</a></li>
                        <li><a href="{{ url('/post-recipe') }}">Publier une recette</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h3 class="footer-title">Catégories</h3>
                    <ul class="footer-links">
                        <li><a href="#">Plat principal</a></li>
                        <li><a href="#">Apéritifs</a></li>
                        <li><a href="#">Desserts</a></li>
                        <li><a href="#">Boissons</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h3 class="footer-title">Coordonnées</h3>
                    <div class="contact-info">
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <span>info@duggarswad.com</span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <span>+91 9876543210</span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Jammu, Jammu-et-Cachemire, Inde</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <p class="copyright">
                &copy; {{ date('Y') }} Duggarswad - Tous droits réservés.
                </p>
            </div>
        </div>
    </footer>

               <script src="js/script.js"></script>
           <script src="js/admin-popup.js"></script>
       </body>
       </html>
