// Wait for DOM to load
document.addEventListener('DOMContentLoaded', function() {
    // --- Hero Slider ---
    const slides = document.querySelectorAll('.hero-slider .slide');
    const prevBtn = document.querySelector('.hero-slider .slider-arrow.prev');
    const nextBtn = document.querySelector('.hero-slider .slider-arrow.next');
    const dots = document.querySelectorAll('.hero-slider .dot');
    let currentSlide = 0;
    let sliderInterval;

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.toggle('active', i === index);
            dots[i].classList.toggle('active', i === index);
        });
        currentSlide = index;
    }

    function nextSlide() {
        let next = (currentSlide + 1) % slides.length;
        showSlide(next);
    }

    function prevSlide() {
        let prev = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(prev);
    }

    function startSlider() {
        sliderInterval = setInterval(nextSlide, 5000);
    }

    function stopSlider() {
        clearInterval(sliderInterval);
    }

    if (slides.length > 0) {
        showSlide(0);
        startSlider();
        if (nextBtn && prevBtn) {
            nextBtn.addEventListener('click', () => {
                stopSlider();
                nextSlide();
                startSlider();
            });
            prevBtn.addEventListener('click', () => {
                stopSlider();
                prevSlide();
                startSlider();
            });
        }
        dots.forEach((dot, i) => {
            dot.addEventListener('click', () => {
                stopSlider();
                showSlide(i);
                startSlider();
            });
        });
        // Pause slider on hover
        const sliderContainer = document.querySelector('.hero-slider .slider-container');
        if (sliderContainer) {
            sliderContainer.addEventListener('mouseenter', stopSlider);
            sliderContainer.addEventListener('mouseleave', startSlider);
        }
    }

    // Navigation active
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            navLinks.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Category Tabs
    const tabBtns = document.querySelectorAll('.tab-btn');
    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            tabBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            filterRecipes(this.textContent);
        });
    });

    // Recipe Search
    const searchInput = document.querySelector('.search-input');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            searchRecipes(searchTerm);
        });
    }

    // Filter by Category
    const filterSelect = document.querySelector('.filter-select');
    if (filterSelect) {
        filterSelect.addEventListener('change', function() {
            const selectedCategory = this.value;
            filterByCategory(selectedCategory);
        });
    }

    // Newsletter Subscription
    const newsletterForm = document.querySelector('.newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('.newsletter-input').value;
            subscribeNewsletter(email);
        });
    }

    // Action Buttons
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

    // Scroll animations
    const observerOptions = { threshold: 0.1, rootMargin: '0px 0px -50px 0px' };
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
            }
        });
    }, observerOptions);

    const animateElements = document.querySelectorAll('.stat-card, .recipe-card, .hero-content');
    animateElements.forEach(el => {
        observer.observe(el);
    });

    // Smooth scroll for internal links
    const internalLinks = document.querySelectorAll('a[href^="#"]');
    internalLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // Recipe search function
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

    // Filter by category function
    function filterByCategory(category) {
        const recipeCards = document.querySelectorAll('.recipe-card');
        recipeCards.forEach(card => {
            const cardCategory = card.querySelector('.meta-item:last-child').textContent.trim();
            if (category === 'All Categories' || cardCategory === category) {
                card.style.display = 'block';
                card.style.opacity = '1';
            } else {
                card.style.display = 'none';
                card.style.opacity = '0';
            }
        });
    }

    // Tabs filter function
    function filterRecipes(filterType) {
        const recipeCards = document.querySelectorAll('.recipe-card');
        switch(filterType) {
            case 'Traditional Recipes':
                recipeCards.forEach(card => { card.style.display = 'block'; card.style.opacity = '1'; });
                break;
            case 'Contributors':
                console.log('Show contributors');
                break;
            case 'Recipes Shared Today':
                console.log('Show today’s recipes');
                break;
        }
    }

    // Newsletter subscription
    function subscribeNewsletter(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            showNotification('Please enter a valid email address', 'error');
            return;
        }
        console.log('Subscribed to newsletter:', email);
        showNotification('Thank you for subscribing!', 'success');
        document.querySelector('.newsletter-input').value = '';
    }

    // Open share recipe modal
    function openShareRecipeModal() {
        console.log('Open share recipe modal');
        showNotification('Sharing feature under development', 'info');
    }

    // Scroll to recipes section
    function scrollToRecipes() {
        const recipesSection = document.querySelector('.recipes');
        if (recipesSection) {
            recipesSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }

    // Notifications
    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.innerHTML = `
            <div class="notification-content">
                <span class="notification-message">${message}</span>
                <button class="notification-close">&times;</button>
            </div>
        `;

        const style = document.createElement('style');
        style.textContent = `
            .notification { position: fixed; top: 20px; right: 20px; background: white; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 10000; transform: translateX(100%); transition: transform 0.3s ease; max-width: 400px; }
            .notification.show { transform: translateX(0); }
            .notification-content { padding: 15px 20px; display: flex; justify-content: space-between; align-items: center; }
            .notification-message { font-size: 14px; color: #333; }
            .notification-close { background: none; border: none; font-size: 20px; cursor: pointer; color: #666; margin-left: 10px; }
            .notification-success { border-left: 4px solid #27ae60; }
            .notification-error { border-left: 4px solid #e74c3c; }
            .notification-info { border-left: 4px solid #3498db; }
        `;
        document.head.appendChild(style);

        document.body.appendChild(notification);
        setTimeout(() => { notification.classList.add('show'); }, 100);

        const closeBtn = notification.querySelector('.notification-close');
        closeBtn.addEventListener('click', () => {
            notification.classList.remove('show');
            setTimeout(() => { document.body.removeChild(notification); }, 300);
        });

        setTimeout(() => {
            if (document.body.contains(notification)) {
                notification.classList.remove('show');
                setTimeout(() => { if (document.body.contains(notification)) { document.body.removeChild(notification); } }, 300);
            }
        }, 5000);
    }

    // Stats animation
    function animateStats() {
        const statNumbers = document.querySelectorAll('.stat-number');
        statNumbers.forEach(stat => {
            const target = parseInt(stat.textContent);
            let current = 0;
            const increment = target / 50;
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) { current = target; clearInterval(timer); }
                stat.textContent = Math.floor(current);
            }, 50);
        });
    }

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

    // Mobile menu
    function initMobileMenu() {
        const header = document.querySelector('.header');
        const nav = document.querySelector('.nav');

        const mobileMenuBtn = document.createElement('button');
        mobileMenuBtn.className = 'mobile-menu-btn';
        mobileMenuBtn.innerHTML = '<i class="fas fa-bars"></i>';

        const mobileStyle = document.createElement('style');
        mobileStyle.textContent = `
            .mobile-menu-btn { display: none; background: none; border: none; font-size: 24px; color: #333; cursor: pointer; }
            @media (max-width: 768px) {
                .mobile-menu-btn { display: block; }
                .nav { display: none; width: 100%; margin-top: 20px; }
                .nav.show { display: block; }
                .nav-list { flex-direction: column; gap: 15px; }
            }
        `;
        document.head.appendChild(mobileStyle);

        header.querySelector('.container').appendChild(mobileMenuBtn);

        mobileMenuBtn.addEventListener('click', function() {
            nav.classList.toggle('show');
        });
    }
    initMobileMenu();

    // Preload images
    function preloadImages() {
        const images = [
            'images/images_pages/foot_backgroung1.jpg',
            'images/images_pages/foot_background2.jpg',
            'images/images_pages/caffee.jpeg'
        ];
        images.forEach(src => { const img = new Image(); img.src = src; });
    }
    preloadImages();

    console.log('Duggarswad - Site loaded successfully!');
});
