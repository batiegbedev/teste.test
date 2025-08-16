<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactez-nous - Duggarswad</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/contact.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
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
                            <!-- <li><a href="{{ url('/post-recipe') }}" class="nav-link">Postez votre recette</a></li> -->
                            <li><a href="{{ url('/login') }}" class="nav-link">Accès administrateur</a></li>
                        </ul>
                    </nav>
        </div>
        
    </header>

    <!-- Hero Section -->
    <section class="contact-hero">
        <div class="container">
            <h1 class="hero-title">Contactez-nous</h1>
            <p class="hero-subtitle">Nous serions ravis de vous entendre. Envoyez-nous un message !</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="container">
            <div class="contact-content">
                <!-- Left Column - Contact Information -->
                <div class="contact-info">
                    <h2 class="contact-title">Entrer en contact</h2>
                    <p class="contact-description">
                        Vous avez une question sur les recettes traditionnelles ?<br>
                        Envie de collaborer? Ou simplement de nous dire bonjour?<br>
                        Nous sommes là pour vous aider !
                    </p>

                    <div class="contact-cards">
                        <div class="contact-card">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-details">
                                <h3>Envoyez-nous un e-mail</h3>
                                <p class="contact-value">info@duggarswad.com</p>
                                <p class="contact-note">Nous vous répondrons dans les 24 heures</p>
                            </div>
                        </div>

                        <div class="contact-card">
                            <div class="contact-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="contact-details">
                                <h3>Appelez-nous</h3>
                                <p class="contact-value">+91 9876543210</p>
                                <p class="contact-note">Du lundi au vendredi, de 9h00 à 18h00 IST</p>
                            </div>
                        </div>

                        <div class="contact-card">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-details">
                                <h3>Visitez-nous</h3>
                                <p class="contact-value">Jammu, Jammu-et-Cachemire<br>Inde - 180001</p>
                            </div>
                        </div>
                    </div>

                    <div class="social-section">
                        <h3>Suivez-nous</h3>
                        <div class="social-icons">
                            <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Contact Form -->
                <div class="contact-form">
                    <h2 class="form-title">Envoyez-nous un message</h2>
                    <form class="form">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="firstName">Prénom *</label>
                                <input type="text" id="firstName" name="firstName" required>
                            </div>
                            <div class="form-group">
                                <label for="lastName">Nom de famille *</label>
                                <input type="text" id="lastName" name="lastName" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Adresse e-mail *</label>
                            <input type="email" id="email" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Numéro de téléphone</label>
                            <input type="tel" id="phone" name="phone">
                        </div>

                        <div class="form-group">
                            <label for="subject">Sujet *</label>
                            <select id="subject" name="subject" required>
                                <option value="">Sélectionnez un sujet</option>
                                <option value="question">Question générale</option>
                                <option value="recipe">Soumettre une recette</option>
                                <option value="collaboration">Collaboration</option>
                                <option value="support">Support technique</option>
                                <option value="other">Autre</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="message">Message *</label>
                            <textarea id="message" name="message" rows="6" maxlength="1000" placeholder="Dites-nous comment nous pouvons vous aider..." required></textarea>
                            <div class="char-counter">
                                <span id="charCount">0</span>/1000 caractères
                            </div>
                        </div>

                        <div class="form-group checkbox-group">
                            <label class="checkbox-label">
                                <input type="checkbox" name="terms" required>
                                <span class="checkmark"></span>
                                J'accepte les termes et conditions.
                            </label>
                        </div>

                        <button type="submit" class="submit-btn">
                            <i class="fas fa-paper-plane"></i>
                            Envoyer un message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="container">
            <h2 class="faq-title">Questions fréquemment posées</h2>
            <div class="faq-list">
                <div class="faq-item">
                    <div class="faq-question">
                        <span>Comment puis-je soumettre une recette ?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Pour soumettre une recette, cliquez sur "Postez votre recette" dans le menu principal. Remplissez le formulaire avec les détails de votre recette, y compris les ingrédients, les instructions et une photo si possible. Notre équipe examinera votre soumission et la publiera dans les 48 heures.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <span>Combien de temps prend l'approbation d'une recette ?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Nous examinons généralement les recettes soumises dans les 24 à 48 heures. Si votre recette nécessite des modifications, nous vous contacterons par email. Une fois approuvée, votre recette sera publiée immédiatement sur notre site.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <span>Puis-je modifier ma recette soumise ?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Oui, vous pouvez modifier votre recette après soumission en nous contactant via le formulaire de contact. Veuillez inclure l'URL de votre recette et les modifications souhaitées. Nous mettrons à jour votre recette dans les 24 heures.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <span>Acceptez-vous des recettes d'autres régions ?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Bien que notre focus principal soit sur les recettes traditionnelles du Jammu-et-Cachemire, nous acceptons également les recettes d'autres régions de l'Inde qui respectent nos critères d'authenticité et de tradition. Chaque recette est évaluée individuellement.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <span>Comment puis-je devenir contributeur régulier ?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Pour devenir contributeur régulier, soumettez plusieurs recettes de qualité et contactez-nous via le formulaire de contact. Nous évaluerons votre contribution et vous contacterons pour discuter des possibilités de collaboration.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <span>Puis-je utiliser les recettes pour mon restaurant ?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Les recettes publiées sur Duggarswad sont destinées à un usage personnel et éducatif. Pour un usage commercial, veuillez nous contacter pour obtenir les autorisations nécessaires et discuter des conditions d'utilisation.</p>
                    </div>
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
               <script src="js/contact.js"></script>
           
       </body>
       </html>
