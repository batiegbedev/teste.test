<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partagez votre recette - Duggarswad</title>
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
    <section class="hero-section">
        <div class="container">
            <h1 class="hero-title">Partagez votre recette traditionnelle</h1>
            <p class="hero-subtitle">Aidez-nous à préserver notre patrimoine culinaire en partageant les recettes authentiques de votre famille</p>
        </div>
    </section>

    <!-- Submission Guidelines -->
    <section class="guidelines-section">
        <div class="container">
            <h2 class="section-title">Directives de soumission de recettes</h2>
            <div class="guidelines-grid">
                <div class="guideline-card">
                    <div class="guideline-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h3>Recettes authentiques</h3>
                    <p>Partagez des recettes traditionnelles transmises de génération en génération</p>
                </div>
                <div class="guideline-card">
                    <div class="guideline-icon">
                        <i class="fas fa-camera"></i>
                    </div>
                    <h3>Inclure des photos</h3>
                    <p>Ajoutez des images de haute qualité de votre plat pour le rendre plus attrayant</p>
                </div>
                <div class="guideline-card">
                    <div class="guideline-icon">
                        <i class="fas fa-list-ol"></i>
                    </div>
                    <h3>Instructions détaillées</h3>
                    <p>Fournir des instructions de cuisson claires, étape par étape</p>
                </div>
                <div class="guideline-card">
                    <div class="guideline-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3>Partagez l'histoire</h3>
                    <p>Inclure la signification culturelle ou l'histoire familiale derrière la recette</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Recipe Form -->
    <section class="recipe-form-section">
        <div class="container">
           

            <form class="recipe-form" id="recipeForm">
                <h2 class="section-title">Détails de la recette</h2>
                <p class="form-subtitle">Tous les champs marqués d'un * sont obligatoires</p>
                <!-- Basic Information -->
                <div class="form-section">
                    <h3 class="form-section-title">Informations de base</h3>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="recipeTitle">Titre de la recette *</label>
                            <input type="text" id="recipeTitle" name="recipeTitle" placeholder="par exemple, le Rajma traditionnel de Bhaderwah" required>
                            <p class="field-description">Choisissez un titre descriptif qui reflète l'origine du plat</p>
                            <div class="error-message" id="titleError">
                                <i class="fas fa-exclamation-circle"></i>
                                Ce champ est obligatoire
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="recipeCategory">Catégorie *</label>
                            <select id="recipeCategory" name="recipeCategory" required>
                                <option value="">Sélectionnez une catégorie</option>
                                <option value="plats-principaux">Plats principaux</option>
                                <option value="entrees">Entrées</option>
                                <option value="desserts">Desserts</option>
                                <option value="boissons">Boissons</option>
                                <option value="accompagnements">Accompagnements</option>
                                <option value="sauces">Sauces et condiments</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="chefName">Votre nom</label>
                            <input type="text" id="chefName" name="chefName" placeholder="Votre nom (facultatif)">
                            <p class="field-description">Cela sera affiché comme contributeur de recette</p>
                        </div>
                        
                        <div class="form-group">
                            <label for="prepTime">Temps de préparation</label>
                            <input type="text" id="prepTime" name="prepTime" placeholder="par exemple, 30 minutes">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="cookTime">Temps de cuisson</label>
                            <input type="text" id="cookTime" name="cookTime" placeholder="par exemple, 45 minutes">
                        </div>
                        
                        <div class="form-group">
                            <label for="servings">Portions</label>
                            <input type="text" id="servings" name="servings" placeholder="par exemple, 4 à 6 personnes">
                        </div>
                    </div>
                </div>

                <!-- Recipe Images -->
                <div class="form-section">
                    <h3 class="form-section-title">Images de recettes</h3>
                    <div class="image-upload-section">
                        <h4>Télécharger des images</h4>
                        <div class="upload-area" id="uploadArea">
                            <div class="upload-content">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <p>Faites glisser et déposez les images ici ou cliquez pour parcourir</p>
                                <p class="upload-info">Vous pouvez télécharger plusieurs images (JPG, PNG, max 5 Mo chacune)</p>
                            </div>
                            <input type="file" id="imageUpload" name="images" multiple accept="image/*" style="display: none;">
                        </div>
                        <div class="image-preview" id="imagePreview"></div>
                    </div>
                </div>

                <!-- Ingredients -->
                <div class="form-section">
                    <h3 class="form-section-title">Ingrédients</h3>
                    <div class="form-group">
                        <label for="ingredients">Liste des ingrédients *</label>
                        <textarea id="ingredients" name="ingredients" placeholder="Énumérez tous les ingrédients avec les quantités, un par ligne : &#10;• 2 tasses de riz Basmati &#10;• 1 kg de mouton coupé en morceaux &#10;• 2 gros oignons émincés &#10;• 1 cuillère à soupe de pâte de gingembre et d'ail &#10;• ..." required></textarea>
                        <p class="field-description">Énumérez chaque ingrédient sur une nouvelle ligne avec les quantités</p>
                        <div class="character-counter">
                            <span id="ingredientsCounter">0</span>/2000 caractères
                        </div>
                    </div>
                </div>

                <!-- Cooking Instructions -->
                <div class="form-section">
                    <h3 class="form-section-title">Instructions de cuisson</h3>
                    <div class="form-group">
                        <label for="instructions">Instructions étape par étape *</label>
                        <textarea id="instructions" name="instructions" placeholder="Fournissez des instructions de cuisson détaillées : &#10;1. Lavez et faites tremper le riz pendant 30 minutes &#10;2. Faites chauffer l'huile dans une casserole à fond épais &#10;3. Ajoutez les épices entières et laissez-les crépiter &#10;4. Ajoutez les oignons émincés et faites cuire jusqu'à ce qu'ils soient dorés &#10;5. ..." required></textarea>
                        <p class="field-description">Numérotez clairement chaque étape pour un suivi facile</p>
                        <div class="character-counter">
                            <span id="instructionsCounter">0</span>/5000 caractères
                        </div>
                    </div>
                </div>

                <!-- Recipe History -->
                <div class="form-section">
                    <h3 class="form-section-title">Histoire de la recette et signification culturelle</h3>
                    <div class="form-group">
                        <textarea id="recipeHistory" name="recipeHistory" placeholder="Partagez l'histoire derrière cette recette : &#10;- Où l'avez-vous apprise ? &#10;- Qu'est-ce qui la rend spéciale ? &#10;- Quand est-elle traditionnellement préparée ? &#10;- Des souvenirs de famille qui y sont associés ?"></textarea>
                        <p class="field-description">Cela permet de préserver le contexte culturel de la recette</p>
                    </div>
                </div>

                <!-- Chef Tips -->
                <div class="form-section">
                    <h3 class="form-section-title">Conseils et variantes du chef</h3>
                    <div class="form-group">
                        <textarea id="chefTips" name="chefTips" placeholder="Partagez vos conseils, astuces ou variantes : &#10;- Ingrédients secrets qui le rendent spécial &#10;- Erreurs courantes à éviter &#10;- Variations régionales &#10;- Instructions de stockage"></textarea>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="form-section">
                    <h3 class="form-section-title">Coordonnées <span class="optional">(facultatif)</span></h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">Adresse email</label>
                            <input type="email" id="email" name="email" placeholder="votre.email@exemple.com">
                            <p class="field-description">Nous l'utiliserons pour vous contacter au sujet de votre recette</p>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Numéro de téléphone</label>
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
                            J'accepte les termes et conditions et confirme que cette recette est authentique et que j'ai le droit de la partager.
                        </label>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn btn-outline" id="previewBtn">
                            <i class="fas fa-eye"></i>
                            Aperçu de la recette
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i>
                            Soumettre pour examen
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Aperçu de la recette (modale) -->
    <div id="previewModal" class="preview-modal" style="display:none;">
        <div class="modal-backdrop"></div>
        <div class="modal-content">
            <button class="modal-close" id="closePreviewModal" title="Fermer">&times;</button>
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

               <script src="js/post-recipe.js"></script>
           <script src="js/admin-popup.js"></script>
       </body>
       </html>
