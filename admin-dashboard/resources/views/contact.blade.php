<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Duggarswad</title>
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
    <section class="contact-hero">
        <div class="container">
            <h1 class="hero-title">Contact Us</h1>
            <p class="hero-subtitle">We would love to hear from you. Send us a message!</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="container">
            <div class="contact-content">
                <!-- Left Column - Contact Information -->
                <div class="contact-info">
                    <h2 class="contact-title">Get in touch</h2>
                    <p class="contact-description">
                        Do you have a question about traditional recipes?<br>
                        Want to collaborate? Or just say hello?<br>
                        We're here to help!
                    </p>

                    <div class="contact-cards">
                        <div class="contact-card">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-details">
                                <h3>Send us an email</h3>
                                <p class="contact-value">info@duggarswad.com</p>
                                <p class="contact-note">We will respond within 24 hours.</p>
                            </div>
                        </div>

                        <div class="contact-card">
                            <div class="contact-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="contact-details">
                                <h3>Call us</h3>
                                <p class="contact-value">+91 9876543210</p>
                                <p class="contact-note">Monday to Friday, 9:00 a.m. to 6:00 p.m. IST</p>
                            </div>
                        </div>

                        <div class="contact-card">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-details">
                                <h3>Visit us</h3>
                                <p class="contact-value">Jammu, Jammu and Kashmir<br>India - 180001</p>
                            </div>
                        </div>
                    </div>

                    <div class="social-section">
                        <h3>Follow us</h3>
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
                    <h2 class="form-title">Send us a message</h2>
                    <form class="form">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="firstName">First name *</label>
                                <input type="text" id="firstName" name="firstName" required>
                            </div>
                            <div class="form-group">
                                <label for="lastName">Last name *</label>
                                <input type="text" id="lastName" name="lastName" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email address *</label>
                            <input type="email" id="email" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone number</label>
                            <input type="tel" id="phone" name="phone">
                        </div>

                        <div class="form-group">
                            <label for="subject">Subject *</label>
                            <select id="subject" name="subject" required>
                                <option value="">Select a topic</option>
                                <option value="question">General question</option>
                                <option value="recipe">Submit a recipe</option>
                                <option value="collaboration">Collaboration</option>
                                <option value="support">Technical support</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="message">Message *</label>
                            <textarea id="message" name="message" rows="6" maxlength="1000" placeholder="Tell us how we can help you..." required></textarea>
                            <div class="char-counter">
                                <span id="charCount">0</span>/1000 characters
                            </div>
                        </div>

                        <div class="form-group checkbox-group">
                            <label class="checkbox-label">
                                <input type="checkbox" name="terms" required>
                                <span class="checkmark"></span>
                                I agree to the terms and conditions.
                            </label>
                        </div>

                        <button type="submit" class="submit-btn">
                            <i class="fas fa-paper-plane"></i>
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="container">
            <h2 class="faq-title">Frequently Asked Questions</h2>
            <div class="faq-list">
                <div class="faq-item">
                    <div class="faq-question">
                        <span>How can I submit a recipe?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>To submit a recipe, click on "Post Your Recipe" in the main menu. Fill out the form with the details of your recipe, including ingredients, instructions, and a photo if possible. Our team will review your submission and publish it within 48 hours.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <span>How long does it take for a recipe to be approved?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>We usually review submitted recipes within 24 to 48 hours. If your recipe requires changes, we will contact you by email. Once approved, your recipe will be published immediately on our site.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <span>Can I edit my submitted recipe?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Yes, you can edit your recipe after submission by contacting us through the contact form. Please include the URL of your recipe and the changes you want. We will update your recipe within 24 hours.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <span>Do you accept recipes from other regions?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Although our main focus is on traditional recipes from Jammu and Kashmir, we also accept recipes from other regions of India that meet our authenticity and tradition criteria. Each recipe is evaluated individually.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <span>How can I become a regular contributor?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>To become a regular contributor, submit several quality recipes and contact us through the contact form. We will evaluate your contribution and reach out to discuss collaboration opportunities.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <span>Can I use the recipes for my restaurant?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>The recipes published on Duggarswad are intended for personal and educational use. For commercial use, please contact us to obtain the necessary permissions and discuss terms of use.</p>
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
                    <h3 class="footer-title">Contact Information</h3>
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
                            <span>Jammu, Jammu and Kashmir, India</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <p class="copyright">
                &copy; {{ date('Y') }} Duggarswad - All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <script src="js/script.js"></script>
    <script src="js/contact.js"></script>
</body>
</html>
