<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us – Duggarswad</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/about.css">
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
                    <li><a href="{{ url('/welcome') }}" class="nav-link active">Home</a></li>
                    <li><a href="{{ url('/about') }}" class="nav-link">About Us</a></li>
                    <li><a href="{{ url('/contact') }}" class="nav-link">Contact</a></li>
                    <!-- <li><a href="{{ url('/post-recipe') }}" class="nav-link">Post Your Recipe</a></li> -->
                    <li><a href="{{ url('/login') }}" class="nav-link">Log In</a></li>
                    <li><a href="{{ url('/register') }}" class="nav-link">Sign Up</a></li>
                </ul>
            </nav>
        </div>
    </header>

<!-- Hero Section -->
<section class="about-hero">
    <div class="container">
        <div class="hero-content">
            <div class="hero-text">
                <h1 class="hero-title">About Duggarswad</h1>
                <p class="hero-subtitle">Preserving the culinary heritage of Jammu & Kashmir</p>
            </div>
        </div>
    </div>
</section>

<!-- Our Story Section -->
<section class="our-story">
    <div class="container">
        <div class="story-content">
            <div class="story-text">
                <h2 class="story-title">Our Story</h2>
                <p class="story-paragraph">
                    Duggarswad was born from a deep love for the traditional cuisine of Jammu & Kashmir and an urgent realization: our culinary treasures are slowly disappearing. As our grandmothers’ recipes fade and modern conveniences take over, we risk losing a rich and unique culinary heritage.
                </p>
                <p class="story-paragraph">
                    The name "Duggarswad" combines "Duggar"—referring to the Dogra people and region—and "swad," meaning "taste" in Hindi. Our mission is to capture and share the authentic flavors of our homeland, preserving traditional techniques and the stories behind each recipe.
                </p>
                <p class="story-paragraph">
                    Every shared recipe evokes the warmth of family kitchens, the joy of festive preparations, and the love poured into nourishing our families. Food is not just sustenance—it’s culture, memory, and identity.
                </p>
            </div>
            <div class="story-image">
                <img src="images/images_pages/caffee.jpeg" alt="Traditional spiced beverage" class="story-img">
            </div>
        </div>
    </div>
</section>

<!-- Our Mission Section -->
<section class="our-mission">
    <div class="container">
        <h2 class="section-title">Our Mission</h2>
        <div class="mission-cards">
            <div class="mission-card">
                <div class="mission-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <h3 class="mission-title">Preserve Heritage</h3>
                <p class="mission-description">
                    Document and safeguard traditional recipes at risk of being forgotten, ensuring they are passed on to future generations.
                </p>
            </div>
            <div class="mission-card">
                <div class="mission-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h3 class="mission-title">Build Community</h3>
                <p class="mission-description">
                    Create a platform where people can share family recipes and connect through their love for traditional cooking.
                </p>
            </div>
            <div class="mission-card">
                <div class="mission-icon">
                    <i class="fas fa-book-open"></i>
                </div>
                <h3 class="mission-title">Share Knowledge</h3>
                <p class="mission-description">
                    Make traditional cooking techniques and recipes accessible to everyone, regardless of location or background.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Our Values Section -->
<section class="our-values">
    <div class="container">
        <h2 class="section-title">What We Stand For</h2>
        <div class="values-grid">
            <div class="value-card">
                <h3 class="value-title">Authenticity</h3>
                <p class="value-description">
                    We prioritize authentic, traditional recipes over modern adaptations, ensuring the true essence of Dogra cuisine is preserved.
                </p>
            </div>
            <div class="value-card">
                <h3 class="value-title">Community</h3>
                <p class="value-description">
                    Every recipe comes with a story, connecting us to the people and traditions that make our cuisine special.
                </p>
            </div>
            <div class="value-card">
                <h3 class="value-title">Accessibility</h3>
                <p class="value-description">
                    We empower everyone to contribute and learn easily, removing barriers to sharing culinary knowledge.
                </p>
            </div>
            <div class="value-card">
                <h3 class="value-title">Quality</h3>
                <p class="value-description">
                    Each recipe is carefully reviewed to ensure accuracy and authenticity before being shared with our community.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Join Our Mission Section -->
<section class="join-mission">
    <div class="container">
        <div class="mission-content">
            <h2>Join Our Mission</h2>
            <p class="mission-subtitle">
                Help us preserve the rich culinary heritage of Jammu & Kashmir by sharing your family recipes
            </p>
            <div class="mission-buttons">
                <button class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Share Your Recipe
                </button>
                <button class="btn btn-secondary">
                    Get in Touch
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
                    Preserving the traditional flavors of Jammu, one recipe at a time.
                </p>
                <div class="social-links">
                    <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

            <div class="footer-section">
                <h3 class="footer-title">Quick Links</h3>
                <ul class="footer-links">
                    <li><a href="{{ url('/welcome') }}">Home</a></li>
                    <li><a href="{{ url('/about') }}">About Us</a></li>
                    <li><a href="{{ url('/contact') }}">Contact</a></li>
                    <li><a href="{{ url('/post-recipe') }}">Post a Recipe</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3 class="footer-title">Categories</h3>
                <ul class="footer-links">
                    <li><a href="#">Main Course</a></li>
                    <li><a href="#">Appetizers</a></li>
                    <li><a href="#">Desserts</a></li>
                    <li><a href="#">Beverages</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3 class="footer-title">Contact Info</h3>
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
                        <span>Jammu, Jammu & Kashmir, India</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p class="copyright">
            &copy; {{ date('Y') }} Duggarswad – All rights reserved.
            </p>
        </div>
    </div>
</footer>

<script src="js/script.js"></script>
<script src="js/admin-popup.js"></script>
</body>
</html>
