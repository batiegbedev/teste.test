/**
 * Script global pour les interactions dynamiques
 * Gère les popups, notifications, animations et requêtes AJAX
 */

// Configuration globale
const DynamicApp = {
    // Configuration
    config: {
        apiBase: '/api',
        animationDuration: 300,
        toastDuration: 5000,
    },

    // Initialisation
    init() {
        this.initAnimations();
        this.initEventListeners();
        this.initIntersectionObserver();
        this.initGlobalFunctions();
        console.log('🚀 DynamicApp initialisé');
    },

    // Initialisation des animations
    initAnimations() {
        // Animation des éléments au scroll
        const animatedElements = document.querySelectorAll('.animate-on-scroll');
        animatedElements.forEach((el, index) => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                el.style.transition = 'all 0.6s ease';
                el.style.opacity = '1';
                el.style.transform = 'translateY(0)';
            }, index * 100);
        });

        // Effet de hover pour les cartes
        const hoverCards = document.querySelectorAll('.hover-lift');
        hoverCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-4px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });
    },

    // Initialisation des écouteurs d'événements
    initEventListeners() {
        // Gestion des formulaires AJAX
        document.addEventListener('submit', (e) => {
            if (e.target.hasAttribute('data-ajax')) {
                e.preventDefault();
                this.handleAjaxForm(e.target);
            }
        });

        // Gestion des clics sur les boutons d'action
        document.addEventListener('click', (e) => {
            if (e.target.hasAttribute('data-action')) {
                e.preventDefault();
                this.handleAction(e.target);
            }
        });

        // Gestion des confirmations de popup
        document.addEventListener('popup-confirmed', (e) => {
            this.handlePopupConfirmation(e.detail);
        });
    },

    // Initialisation de l'Intersection Observer
    initIntersectionObserver() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('slide-up');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.animate-on-scroll').forEach(el => {
            observer.observe(el);
        });
    },

    // Initialisation des fonctions globales
    initGlobalFunctions() {
        // Fonction globale pour afficher des notifications
        window.showNotification = (type, message, duration = this.config.toastDuration) => {
            this.showToast(type, message, duration);
        };

        // Fonction globale pour afficher des popups
        window.showPopup = (id, type, title, message) => {
            this.showPopup(id, type, title, message);
        };

        // Fonction globale pour les requêtes AJAX
        window.ajaxRequest = (url, options = {}) => {
            return this.ajaxRequest(url, options);
        };
    },

    // Gestion des formulaires AJAX
    async handleAjaxForm(form) {
        const formData = new FormData(form);
        const url = form.action;
        const method = form.method;

        try {
            this.showLoading(form);
            
            const response = await fetch(url, {
                method: method,
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            const data = await response.json();
            
            if (data.success) {
                this.showNotification('success', data.message);
                if (data.redirect) {
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 1000);
                }
            } else {
                this.showNotification('error', data.message);
            }

        } catch (error) {
            this.showNotification('error', 'Erreur de connexion au serveur');
            console.error('Erreur AJAX:', error);
        } finally {
            this.hideLoading(form);
        }
    },

    // Gestion des actions
    async handleAction(button) {
        const action = button.getAttribute('data-action');
        const url = button.getAttribute('data-url');
        const confirmMessage = button.getAttribute('data-confirm');

        if (confirmMessage && !confirm(confirmMessage)) {
            return;
        }

        try {
            const response = await this.ajaxRequest(url, {
                method: action === 'delete' ? 'DELETE' : 'POST'
            });

            if (response.success) {
                this.showNotification('success', response.message);
                
                // Recharger la page ou mettre à jour l'interface
                if (response.reload) {
                    window.location.reload();
                }
            } else {
                this.showNotification('error', response.message);
            }

        } catch (error) {
            this.showNotification('error', 'Erreur lors de l\'action');
        }
    },

    // Gestion des confirmations de popup
    handlePopupConfirmation(detail) {
        const { id, action, url } = detail;
        
        if (action && url) {
            this.ajaxRequest(url, { method: action })
                .then(response => {
                    if (response.success) {
                        this.showNotification('success', response.message);
                    } else {
                        this.showNotification('error', response.message);
                    }
                })
                .catch(error => {
                    this.showNotification('error', 'Erreur lors de l\'action');
                });
        }
    },

    // Requête AJAX générique
    async ajaxRequest(url, options = {}) {
        const defaultOptions = {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        };

        const finalOptions = { ...defaultOptions, ...options };

        const response = await fetch(url, finalOptions);
        return await response.json();
    },

    // Affichage des notifications toast
    showToast(type, message, duration = this.config.toastDuration) {
        const toastId = 'toast-' + Date.now();
        const toastHtml = this.createToastHTML(type, message, toastId);
        
        document.body.insertAdjacentHTML('beforeend', toastHtml);
        
        const toast = document.getElementById(toastId);
        toast.style.transform = 'translateX(100%)';
        
        setTimeout(() => {
            toast.style.transition = 'transform 0.3s ease-in-out';
            toast.style.transform = 'translateX(0)';
        }, 100);
        
        if (duration > 0) {
            setTimeout(() => {
                this.closeToast(toastId);
            }, duration);
        }
    },

    // Création du HTML pour les toasts
    createToastHTML(type, message, id) {
        const colors = {
            success: { bg: 'bg-green-500', border: 'border-green-200', icon: 'text-green-500' },
            error: { bg: 'bg-red-500', border: 'border-red-200', icon: 'text-red-500' },
            warning: { bg: 'bg-yellow-500', border: 'border-yellow-200', icon: 'text-yellow-500' },
            info: { bg: 'bg-blue-500', border: 'border-blue-200', icon: 'text-blue-500' }
        };

        const icons = {
            success: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />',
            error: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />',
            warning: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />',
            info: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />'
        };

        return `
            <div id="${id}" class="fixed top-4 right-4 z-50">
                <div class="bg-white dark:bg-gray-800 border-l-4 ${colors[type].border} shadow-lg rounded-lg p-4 max-w-sm w-full transform transition-all duration-300 ease-in-out">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 ${colors[type].icon}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                ${icons[type]}
                            </svg>
                        </div>
                        <div class="ml-3 flex-1">
                            <p class="text-sm font-medium text-gray-900 dark:text-gray-100">${message}</p>
                        </div>
                        <div class="ml-4 flex-shrink-0 flex">
                            <button onclick="DynamicApp.closeToast('${id}')" class="inline-flex text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;
    },

    // Fermeture des toasts
    closeToast(id) {
        const toast = document.getElementById(id);
        if (toast) {
            toast.style.transform = 'translateX(100%)';
            
            setTimeout(() => {
                toast.remove();
            }, 300);
        }
    },

    // Affichage des popups
    showPopup(id, type, title, message) {
        const popup = document.getElementById(id);
        if (popup) {
            const titleEl = popup.querySelector('h3');
            const messageEl = popup.querySelector('p');
            
            if (titleEl) titleEl.textContent = title;
            if (messageEl) messageEl.textContent = message;
            
            popup.classList.remove('hidden');
            popup.style.opacity = '0';
            popup.style.transform = 'scale(0.9)';
            
            setTimeout(() => {
                popup.style.transition = 'all 0.3s ease';
                popup.style.opacity = '1';
                popup.style.transform = 'scale(1)';
            }, 100);
        }
    },

    // Fermeture des popups
    closePopup(id) {
        const popup = document.getElementById(id);
        if (popup) {
            popup.style.transition = 'all 0.3s ease';
            popup.style.opacity = '0';
            popup.style.transform = 'scale(0.9)';
            
            setTimeout(() => {
                popup.classList.add('hidden');
            }, 300);
        }
    },

    // Affichage du loading
    showLoading(element) {
        const button = element.querySelector('button[type="submit"]') || element;
        const originalText = button.textContent;
        
        button.disabled = true;
        button.innerHTML = '<div class="loading-spinner mr-2"></div>Chargement...';
        button.setAttribute('data-original-text', originalText);
    },

    // Masquage du loading
    hideLoading(element) {
        const button = element.querySelector('button[type="submit"]') || element;
        const originalText = button.getAttribute('data-original-text');
        
        button.disabled = false;
        button.textContent = originalText;
    }
};

// Initialisation au chargement de la page
document.addEventListener('DOMContentLoaded', () => {
    DynamicApp.init();
});

// Export pour utilisation dans d'autres modules
if (typeof module !== 'undefined' && module.exports) {
    module.exports = DynamicApp;
}
