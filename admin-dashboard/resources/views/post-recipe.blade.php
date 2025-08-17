<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Share Your Recipe - Duggarswad</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/post-recipe.css">
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
    <section class="hero-section">
        <div class="container">
            <h1 class="hero-title">Share Your Traditional Recipe</h1>
            <p class="hero-subtitle">Help us preserve our culinary heritage by sharing your family’s authentic recipes</p>
        </div>
    </section>

    <!-- Submission Guidelines -->
    <section class="guidelines-section">
        <div class="container">
            <h2 class="section-title">Recipe Submission Guidelines</h2>
            <div class="guidelines-grid">
                <div class="guideline-card">
                    <div class="guideline-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h3>Authentic Recipes</h3>
                    <p>Share traditional recipes passed down from generation to generation</p>
                </div>
                <div class="guideline-card">
                    <div class="guideline-icon">
                        <i class="fas fa-camera"></i>
                    </div>
                    <h3>Include Photos</h3>
                    <p>Add high-quality images of your dish to make it more appealing</p>
                </div>
                <div class="guideline-card">
                    <div class="guideline-icon">
                        <i class="fas fa-list-ol"></i>
                    </div>
                    <h3>Detailed Instructions</h3>
                    <p>Provide clear, step-by-step cooking instructions</p>
                </div>
                <div class="guideline-card">
                    <div class="guideline-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3>Share the Story</h3>
                    <p>Include the cultural meaning or family story behind the recipe</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Recipe Form -->
    <section class="recipe-form-section">
        <div class="container">
            <form class="recipe-form" id="recipeForm">
                <h2 class="section-title">Recipe Details</h2>
                <p class="form-subtitle">All fields marked with * are required</p>

                <!-- Basic Information -->
                <div class="form-section">
                    <h3 class="form-section-title">Basic Information</h3>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="recipeTitle">Recipe Title *</label>
                            <input type="text" id="recipeTitle" name="recipeTitle" placeholder="e.g., Traditional Bhaderwah Rajma" required>
                            <p class="field-description">Choose a descriptive title that reflects the origin of the dish</p>
                            <div class="error-message" id="titleError">
                                <i class="fas fa-exclamation-circle"></i>
                                This field is required
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="recipeCategory">Category *</label>
                            <select id="recipeCategory" name="recipeCategory" required>
                                <option value="">Select a category</option>
                                <option value="main-dishes">Main Dishes</option>
                                <option value="appetizers">Appetizers</option>
                                <option value="desserts">Desserts</option>
                                <option value="drinks">Drinks</option>
                                <option value="sides">Side Dishes</option>
                                <option value="sauces">Sauces & Condiments</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="chefName">Your Name</label>
                            <input type="text" id="chefName" name="chefName" placeholder="Your name (optional)">
                            <p class="field-description">This will be shown as the recipe contributor</p>
                        </div>
                        
                        <div class="form-group">
                            <label for="prepTime">Preparation Time</label>
                            <input type="text" id="prepTime" name="prepTime" placeholder="e.g., 30 minutes">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="cookTime">Cooking Time</label>
                            <input type="text" id="cookTime" name="cookTime" placeholder="e.g., 45 minutes">
                        </div>
                        
                        <div class="form-group">
                            <label for="servings">Servings</label>
                            <input type="text" id="servings" name="servings" placeholder="e.g., 4 to 6 people">
                        </div>
                    </div>
                </div>

                <!-- Recipe Images -->
                <div class="form-section">
                    <h3 class="form-section-title">Recipe Images</h3>
                    <div class="image-upload-section">
                        <h4>Upload Images</h4>
                        <div class="upload-area" id="uploadArea">
                            <div class="upload-content">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <p>Drag and drop images here or click to browse</p>
                                <p class="upload-info">You can upload multiple images (JPG, PNG, max 5 MB each)</p>
                            </div>
                            <input type="file" id="imageUpload" name="images" multiple accept="image/*" style="display: none;">
                        </div>
                        <div class="image-preview" id="imagePreview"></div>
                    </div>
                </div>

                <!-- Ingredients -->
                <div class="form-section">
                    <h3 class="form-section-title">Ingredients</h3>
                    <div class="form-group">
                        <label for="ingredients">List of Ingredients *</label>
                        <textarea id="ingredients" name="ingredients" placeholder="List all ingredients with quantities, one per line: &#10;• 2 cups Basmati rice &#10;• 1 kg mutton cut into pieces &#10;• 2 large onions sliced &#10;• 1 tbsp ginger-garlic paste &#10;• ..." required></textarea>
                        <p class="field-description">List each ingredient on a new line with quantities</p>
                        <div class="character-counter">
                            <span id="ingredientsCounter">0</span>/2000 characters
                        </div>
                    </div>
                </div>

                <!-- Cooking Instructions -->
                <div class="form-section">
                    <h3 class="form-section-title">Cooking Instructions</h3>
                    <div class="form-group">
                        <label for="instructions">Step-by-step Instructions *</label>
                        <textarea id="instructions" name="instructions" placeholder="Provide detailed cooking instructions: &#10;1. Wash and soak the rice for 30 minutes &#10;2. Heat oil in a heavy-bottomed pan &#10;3. Add whole spices and let them crackle &#10;4. Add sliced onions and cook until golden brown &#10;5. ..." required></textarea>
                        <p class="field-description">Clearly number each step for easy following</p>
                        <div class="character-counter">
                            <span id="instructionsCounter">0</span>/5000 characters
                        </div>
                    </div>
                </div>

                <!-- Recipe History -->
                <div class="form-section">
                    <h3 class="form-section-title">Recipe Story and Cultural Significance</h3>
                    <div class="form-group">
                        <textarea id="recipeHistory" name="recipeHistory" placeholder="Share the story behind this recipe: &#10;- Where did you learn it? &#10;- What makes it special? &#10;- When is it traditionally prepared? &#10;- Any family memories associated with it?"></textarea>
                        <p class="field-description">This helps preserve the cultural context of the recipe</p>
                    </div>
                </div>

                <!-- Chef Tips -->
                <div class="form-section">
                    <h3 class="form-section-title">Chef's Tips & Variations</h3>
                    <div class="form-group">
                        <textarea id="chefTips" name="chefTips" placeholder="Share your tips, tricks or variations: &#10;- Secret ingredients that make it special &#10;- Common mistakes to avoid &#10;- Regional variations &#10;- Storage instructions"></textarea>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="form-section">
                    <h3 class="form-section-title">Contact Information <span class="optional">(optional)</span></h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" placeholder="your.email@example.com">
                            <p class="field-description">We will use this to contact you about your recipe</p>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" placeholder="+91 9876543210">
                        </div>
                    </div>
                </div>

                <!-- Terms and Submit -->
                <div class="form-section">
                    <div class="form-group checkbox-group">
                        <label class="checkbox-label">
                            <input type="checkbox" id="terms" name="terms" required>
                            <span class="checkmark"></span>
                            I accept the terms and conditions and confirm that this recipe is authentic and that I have the right to share it.
                        </label>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn btn-outline" id="previewBtn">
                            <i class="fas fa-eye"></i>
                            Recipe Preview
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i>
                            Submit for Review
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Recipe Preview (modal) -->
    <div id="previewModal" class="preview-modal" style="display:none;">
        <div class="modal-backdrop"></div>
        <div class="modal-content">
            <button class="modal-close" id="closePreviewModal" title="Close">&times;</button>
            <div id="previewContent"></div>
        </div>
    </div>

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
                        <li><a href="#">Main Dish</a></li>
                        <li><a href="#">Appetizers</a></li>
                        <li><a href="#">Desserts</a></li>
                        <li><a href="#">Drinks</a></li>
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

    <script src="js/post-recipe.js"></script>
    <script src="js/admin-popup.js"></script>
</body>
</html>
