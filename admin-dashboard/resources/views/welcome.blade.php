<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Duggarswad - Traditional Recipes</title>

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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

    <!-- Hero Slider Section -->
    <section class="hero-slider">
        <div class="slider-container">
            <div class="slider">
                <div class="slide active">
                    <img src="images/images_pages/foot_backgroung1.jpg" alt="Slider 1" class="slider-img">
                    <div class="slide-caption">
                        <h1 class="slider-title">Taste the Tradition of Duggar</h1>
                        <p class="slider-desc">Discover the authentic flavors of Jammu & Kashmir</p>
                        <a href="#" class="slider-btn">Explore</a>
                    </div>
                </div>
                <div class="slide">
                    <img src="images/images_pages/foot_background2.jpg" alt="Slider 2" class="slider-img">
                    <div class="slide-caption">
                        <h1 class="slider-title">Share Your Family Recipes</h1>
                        <p class="slider-desc">Contribute to the preservation of culinary heritage</p>
                        <a href="#" class="slider-btn">Share a Recipe</a>
                    </div>
                </div>
                <div class="slide">
                    <img src="images/images_pages/caffee.jpeg" alt="Slider 3" class="slider-img">
                    <div class="slide-caption">
                        <h1 class="slider-title">Join the Duggarswad Community</h1>
                        <p class="slider-desc">Connect, discover, and savor together</p>
                        <a href="#" class="slider-btn">Join</a>
                    </div>
                </div>
            </div>
            <button class="slider-arrow prev"><i class="fas fa-chevron-left"></i></button>
            <button class="slider-arrow next"><i class="fas fa-chevron-right"></i></button>
            <div class="slider-dots">
                <span class="dot active"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number">2</div>
                    <div class="stat-label">Traditional Recipes</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">3</div>
                    <div class="stat-label">Contributors</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">0</div>
                    <div class="stat-label">Recipes Shared Today</div>
                </div>
            </div>
        </div>
    </section>


    <!-- Categories Section -->
<section class="categories">
    <div class="container">
        <div class="categories-tabs">
            <button class="tab-btn active">Traditional Recipes</button>
            <button class="tab-btn">Contributors</button>
            <button class="tab-btn">Recipes Shared Today</button>
        </div>
    </div>
</section>

<!-- Search Section -->
<section class="search-section">
    <div class="container">
        <h2 class="section-title">
            Traditional Recipes and Stories
        </h2>
        <p class="section-subtitle">
            Discover authentic flavors passed down through generations
        </p>
        <div class="search-filters">
            <div class="search-box">
                <input type="text" placeholder="Search recipes..." class="search-input">
                <i class="fas fa-search search-icon"></i>
            </div>
            <div class="category-filter">
                <select class="filter-select">
                    <option>All Categories</option>
                    <option>Main Course</option>
                    <option>Appetizers</option>
                    <option>Desserts</option>
                    <option>Beverages</option>
                </select>
                <i class="fas fa-chevron-down filter-icon"></i>
            </div>
        </div>
    </div>
</section>

<!-- Recipes Section -->
<section class="recipes">
    <div class="container">
        <div class="recipes-grid">
            <!-- Recipe Card 1 -->
            <article class="recipe-card">
                <div class="recipe-images">
                    <img src="images/images_pages/foot_backgroung1.jpg" class="recipe-img">
                </div>
                <div class="recipe-content">
                    <h3 class="recipe-title">Traditional Rajma from Bhaderwah</h3>
                    <div class="recipe-meta">
                        <span class="meta-item">
                            <i class="fas fa-user"></i>
                            Priya Sharma
                        </span>
                        <span class="meta-item">
                            <i class="fas fa-calendar"></i>
                            January 15, 2024
                        </span>
                        <span class="meta-item">
                            <i class="fas fa-tag"></i>
                            Main Course
                        </span>
                    </div>
                    <p class="recipe-excerpt">
                        Pressure cook soaked rajma with salt and turmeric until tender. Heat mustard oil in a heavy-bottomed pan and...
                    </p>
                    <a href="#" class="recipe-link">Read More →</a>
                </div>
            </article>

            <!-- Recipe Card 2 -->
            <article class="recipe-card">
                <div class="recipe-images">
                    <img src="images/images_pages/foot_background2.jpg" class="recipe-img">
                </div>
                <div class="recipe-content">
                    <h3 class="recipe-title">Ambal – Traditional Pumpkin Curry</h3>
                    <div class="recipe-meta">
                        <span class="meta-item">
                            <i class="fas fa-user"></i>
                            Rajesh Kumar
                        </span>
                        <span class="meta-item">
                            <i class="fas fa-calendar"></i>
                            January 12, 2024
                        </span>
                        <span class="meta-item">
                            <i class="fas fa-tag"></i>
                            Main Course
                        </span>
                    </div>
                    <p class="recipe-excerpt">
                        Heat mustard oil and sauté pumpkin pieces until lightly golden. Remove and set aside. In the same oil, sauté onions until golden brown.
                    </p>
                    <a href="#" class="recipe-link">Read More →</a>
                </div>
            </article>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="newsletter">
    <div class="container">
        <div class="newsletter-content">
            <h2 class="newsletter-title">Stay Updated with Traditional Recipes</h2>
            <p class="newsletter-subtitle">
                Receive the latest recipes and stories in your inbox
            </p>
            <form class="newsletter-form">
                <input type="email" placeholder="Enter your email address" class="newsletter-input" required>
                <button type="submit" class="newsletter-btn">Subscribe</button>
            </form>
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
                    Preserving traditional flavors of Jammu, one recipe at a time.
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
