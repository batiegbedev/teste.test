// Attendre que le DOM soit chargé
document.addEventListener('DOMContentLoaded', function() {
    
    // Navigation active
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // Retirer la classe active de tous les liens
            navLinks.forEach(l => l.classList.remove('active'));
            // Ajouter la classe active au lien cliqué
            this.classList.add('active');
        });
    });

    // Tabs des catégories
    const tabBtns = document.querySelectorAll('.tab-btn');
    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Retirer la classe active de tous les boutons
            tabBtns.forEach(b => b.classList.remove('active'));
            // Ajouter la classe active au bouton cliqué
            this.classList.add('active');
            
            // Ici vous pouvez ajouter la logique pour filtrer les recettes
            filterRecipes(this.textContent);
        });
    });

    // Recherche de recettes
    const searchInput = document.querySelector('.search-input');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            searchRecipes(searchTerm);
        });
    }

    // Filtre par catégorie
    const filterSelect = document.querySelector('.filter-select');
    if (filterSelect) {
        filterSelect.addEventListener('change', function() {
            const selectedCategory = this.value;
            filterByCategory(selectedCategory);
        });
    }

    // Newsletter subscription
    const newsletterForm = document.querySelector('.newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('.newsletter-input').value;
            subscribeNewsletter(email);
        });
    }

    // Boutons d'action
    const shareRecipeBtn = document.querySelector('.btn-primary');
    if (shareRecipeBtn) {
        shareRecipeBtn.addEventListener('click', function() {
            openShareRecipeModal();
        });
    }

    const exploreRecipesBtn = document.querySelector('.btn-secondary');
    if (exploreRecipesBtn) {
        exploreRecipesBtn.addEventListener('click', function() {
            scrollToRecipes();
        });
    }

    // Animation au scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
            }
        });
    }, observerOptions);

    // Observer les éléments à animer
    const animateElements = document.querySelectorAll('.stat-card, .recipe-card, .hero-content');
    animateElements.forEach(el => {
        observer.observe(el);
    });

    // Smooth scroll pour les liens internes
    const internalLinks = document.querySelectorAll('a[href^="#"]');
    internalLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Fonction de recherche de recettes
    function searchRecipes(searchTerm) {
        const recipeCards = document.querySelectorAll('.recipe-card');
        recipeCards.forEach(card => {
            const title = card.querySelector('.recipe-title').textContent.toLowerCase();
            const excerpt = card.querySelector('.recipe-excerpt').textContent.toLowerCase();
            
            if (title.includes(searchTerm) || excerpt.includes(searchTerm)) {
                card.style.display = 'block';
                card.style.opacity = '1';
            } else {
                card.style.display = 'none';
                card.style.opacity = '0';
            }
        });
    }

    // Fonction de filtrage par catégorie
    function filterByCategory(category) {
        const recipeCards = document.querySelectorAll('.recipe-card');
        recipeCards.forEach(card => {
            const cardCategory = card.querySelector('.meta-item:last-child').textContent.trim();
            
            if (category === 'Toutes les catégories' || cardCategory === category) {
                card.style.display = 'block';
                card.style.opacity = '1';
            } else {
                card.style.display = 'none';
                card.style.opacity = '0';
            }
        });
    }

    // Fonction de filtrage des recettes (pour les tabs)
    function filterRecipes(filterType) {
        const recipeCards = document.querySelectorAll('.recipe-card');
        
        switch(filterType) {
            case 'Recettes traditionnelles':
                // Afficher toutes les recettes
                recipeCards.forEach(card => {
                    card.style.display = 'block';
                    card.style.opacity = '1';
                });
                break;
            case 'Contributeurs':
                // Ici vous pouvez ajouter la logique pour afficher les contributeurs
                console.log('Afficher les contributeurs');
                break;
            case 'Recettes partagées aujourd\'hui':
                // Ici vous pouvez ajouter la logique pour les recettes du jour
                console.log('Afficher les recettes du jour');
                break;
        }
    }

    // Fonction d'abonnement à la newsletter
    function subscribeNewsletter(email) {
        // Validation basique de l'email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            showNotification('Veuillez entrer une adresse email valide', 'error');
            return;
        }

        // Simulation d'envoi à l'API
        console.log('Abonnement à la newsletter:', email);
        
        // Afficher un message de succès
        showNotification('Merci pour votre abonnement !', 'success');
        
        // Vider le champ
        document.querySelector('.newsletter-input').value = '';
    }

    // Fonction pour ouvrir le modal de partage de recette
    function openShareRecipeModal() {
        // Ici vous pouvez créer un modal pour partager une recette
        console.log('Ouvrir le modal de partage de recette');
        showNotification('Fonctionnalité de partage en cours de développement', 'info');
    }

    // Fonction pour faire défiler vers les recettes
    function scrollToRecipes() {
        const recipesSection = document.querySelector('.recipes');
        if (recipesSection) {
            recipesSection.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    }

    // Fonction pour afficher les notifications
    function showNotification(message, type = 'info') {
        // Créer l'élément de notification
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.innerHTML = `
            <div class="notification-content">
                <span class="notification-message">${message}</span>
                <button class="notification-close">&times;</button>
            </div>
        `;

        // Ajouter les styles CSS pour la notification
        const style = document.createElement('style');
        style.textContent = `
            .notification {
                position: fixed;
                top: 20px;
                right: 20px;
                background: white;
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                z-index: 10000;
                transform: translateX(100%);
                transition: transform 0.3s ease;
                max-width: 400px;
            }
            .notification.show {
                transform: translateX(0);
            }
            .notification-content {
                padding: 15px 20px;
                display: flex;
                align-items: center;
                justify-content: space-between;
            }
            .notification-message {
                color: #333;
                font-size: 14px;
            }
            .notification-close {
                background: none;
                border: none;
                font-size: 20px;
                cursor: pointer;
                color: #666;
                margin-left: 10px;
            }
            .notification-success {
                border-left: 4px solid #27ae60;
            }
            .notification-error {
                border-left: 4px solid #e74c3c;
            }
            .notification-info {
                border-left: 4px solid #3498db;
            }
        `;
        document.head.appendChild(style);

        // Ajouter la notification au DOM
        document.body.appendChild(notification);

        // Afficher la notification
        setTimeout(() => {
            notification.classList.add('show');
        }, 100);

        // Gérer la fermeture
        const closeBtn = notification.querySelector('.notification-close');
        closeBtn.addEventListener('click', () => {
            notification.classList.remove('show');
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        });

        // Auto-fermeture après 5 secondes
        setTimeout(() => {
            if (document.body.contains(notification)) {
                notification.classList.remove('show');
                setTimeout(() => {
                    if (document.body.contains(notification)) {
                        document.body.removeChild(notification);
                    }
                }, 300);
            }
        }, 5000);
    }

    // Animation des cartes de statistiques
    function animateStats() {
        const statNumbers = document.querySelectorAll('.stat-number');
        statNumbers.forEach(stat => {
            const target = parseInt(stat.textContent);
            let current = 0;
            const increment = target / 50;
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                stat.textContent = Math.floor(current);
            }, 50);
        });
    }

    // Lancer l'animation des stats quand elles sont visibles
    const statsSection = document.querySelector('.stats');
    if (statsSection) {
        const statsObserver = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateStats();
                    statsObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });
        
        statsObserver.observe(statsSection);
    }

    // Gestion du menu mobile (si nécessaire)
    function initMobileMenu() {
        const header = document.querySelector('.header');
        const nav = document.querySelector('.nav');
        
        // Créer le bouton hamburger pour mobile
        const mobileMenuBtn = document.createElement('button');
        mobileMenuBtn.className = 'mobile-menu-btn';
        mobileMenuBtn.innerHTML = '<i class="fas fa-bars"></i>';
        
        // Ajouter les styles pour le menu mobile
        const mobileStyle = document.createElement('style');
        mobileStyle.textContent = `
            .mobile-menu-btn {
                display: none;
                background: none;
                border: none;
                font-size: 24px;
                color: #333;
                cursor: pointer;
            }
            @media (max-width: 768px) {
                .mobile-menu-btn {
                    display: block;
                }
                .nav {
                    display: none;
                    width: 100%;
                    margin-top: 20px;
                }
                .nav.show {
                    display: block;
                }
                .nav-list {
                    flex-direction: column;
                    gap: 15px;
                }
            }
        `;
        document.head.appendChild(mobileStyle);
        
        // Ajouter le bouton au header
        header.querySelector('.container').appendChild(mobileMenuBtn);
        
        // Gérer le clic sur le bouton
        mobileMenuBtn.addEventListener('click', function() {
            nav.classList.toggle('show');
        });
    }

    // Initialiser le menu mobile
    initMobileMenu();

    // Précharger les images pour une meilleure performance
    function preloadImages() {
        const images = [
            'images/hero-salad.jpg',
            'images/recipe1-1.jpg',
            'images/recipe1-2.jpg',
            'images/recipe2-1.jpg',
            'images/recipe2-2.jpg'
        ];
        
        images.forEach(src => {
            const img = new Image();
            img.src = src;
        });
    }

    // Précharger les images
    preloadImages();

    console.log('Duggarswad - Site chargé avec succès !');
});
