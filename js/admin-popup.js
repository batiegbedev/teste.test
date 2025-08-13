// Admin Popup Functionality
class AdminPopup {
    constructor() {
        this.popup = null;
        this.isOpen = false;
        this.init();
    }

    init() {
        // Create popup HTML
        this.createPopupHTML();
        
        // Add event listeners
        this.addEventListeners();
        
        // Add styles
        this.addStyles();
    }

    createPopupHTML() {
        const popupHTML = `
            <div id="adminPopup" class="admin-popup">
                <div class="admin-popup-overlay"></div>
                <div class="admin-popup-content">
                    <div class="admin-popup-header">
                        <h2>Accès administrateur</h2>
                        <button class="admin-popup-close" id="adminPopupClose">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    
                    <div class="admin-popup-body">
                        <form id="adminLoginForm" class="admin-login-form">
                            <div class="form-group">
                                <label for="adminUsername">Nom d'utilisateur</label>
                                <input type="text" id="adminUsername" name="username" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="adminPassword">Mot de passe</label>
                                <div class="password-input-group">
                                    <input type="password" id="adminPassword" name="password" required>
                                    <button type="button" class="password-toggle" id="passwordToggle">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="form-group checkbox-group">
                                <label class="checkbox-label">
                                    <input type="checkbox" id="rememberMe" name="rememberMe">
                                    <span class="checkmark"></span>
                                    Se souvenir de moi
                                </label>
                            </div>
                            
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-sign-in-alt"></i>
                                    Se connecter
                                </button>
                            </div>
                        </form>
                        
                        <div class="admin-help">
                            <p><i class="fas fa-info-circle"></i> Contactez l'administrateur si vous avez oublié vos identifiants</p>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        document.body.insertAdjacentHTML('beforeend', popupHTML);
        this.popup = document.getElementById('adminPopup');
    }

    addEventListeners() {
        // Open popup when admin link is clicked
        const adminLinks = document.querySelectorAll('.nav-link[href="#"]');
        adminLinks.forEach(link => {
            if (link.textContent.trim() === 'Accès administrateur') {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    this.open();
                });
            }
        });

        // Close popup
        const closeBtn = document.getElementById('adminPopupClose');
        const overlay = this.popup.querySelector('.admin-popup-overlay');
        
        closeBtn.addEventListener('click', () => this.close());
        overlay.addEventListener('click', () => this.close());

        // Close on Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && this.isOpen) {
                this.close();
            }
        });

        // Password toggle
        const passwordToggle = document.getElementById('passwordToggle');
        const passwordInput = document.getElementById('adminPassword');
        
        passwordToggle.addEventListener('click', () => {
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;
            passwordToggle.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
        });

        // Form submission
        const loginForm = document.getElementById('adminLoginForm');
        loginForm.addEventListener('submit', (e) => {
            e.preventDefault();
            this.handleLogin();
        });

        // Real-time validation
        const inputs = loginForm.querySelectorAll('input[required]');
        inputs.forEach(input => {
            input.addEventListener('blur', () => this.validateField(input));
            input.addEventListener('input', () => this.clearFieldError(input));
        });
    }

    addStyles() {
        const styles = `
            .admin-popup {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 10000;
                display: none;
                animation: fadeIn 0.3s ease;
            }

            .admin-popup.show {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .admin-popup-overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                backdrop-filter: blur(5px);
            }

            .admin-popup-content {
                position: relative;
                background: #fff;
                border-radius: 12px;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
                width: 90%;
                max-width: 400px;
                max-height: 90vh;
                overflow-y: auto;
                animation: slideInUp 0.3s ease;
            }

            .admin-popup-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 20px 25px;
                border-bottom: 1px solid #e9ecef;
            }

            .admin-popup-header h2 {
                margin: 0;
                font-size: 1.3rem;
                font-weight: 600;
                color: #2c3e50;
            }

            .admin-popup-close {
                background: none;
                border: none;
                font-size: 1.2rem;
                color: #6c757d;
                cursor: pointer;
                padding: 5px;
                border-radius: 50%;
                transition: all 0.3s ease;
                width: 32px;
                height: 32px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .admin-popup-close:hover {
                background: #f8f9fa;
                color: #e74c3c;
            }

            .admin-popup-body {
                padding: 25px;
            }

            .admin-login-form {
                margin-bottom: 20px;
            }

            .admin-login-form .form-group {
                margin-bottom: 20px;
            }

            .admin-login-form label {
                display: block;
                font-weight: 600;
                color: #2c3e50;
                margin-bottom: 8px;
                font-size: 0.95rem;
            }

            .admin-login-form input[type="text"],
            .admin-login-form input[type="password"] {
                width: 100%;
                padding: 12px 16px;
                border: 2px solid #e9ecef;
                border-radius: 8px;
                font-size: 1rem;
                transition: border-color 0.3s ease, box-shadow 0.3s ease;
                background: #fff;
            }

            .admin-login-form input:focus {
                outline: none;
                border-color: #e74c3c;
                box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.1);
            }

            .admin-login-form input.error {
                border-color: #e74c3c;
            }

            .password-input-group {
                position: relative;
            }

            .password-toggle {
                position: absolute;
                right: 12px;
                top: 50%;
                transform: translateY(-50%);
                background: none;
                border: none;
                color: #6c757d;
                cursor: pointer;
                padding: 5px;
                font-size: 1rem;
                transition: color 0.3s ease;
            }

            .password-toggle:hover {
                color: #e74c3c;
            }

            .checkbox-group {
                margin-bottom: 25px;
            }

            .checkbox-label {
                display: flex;
                align-items: center;
                gap: 10px;
                cursor: pointer;
                font-size: 0.9rem;
                color: #2c3e50;
            }

            .checkbox-label input[type="checkbox"] {
                width: auto;
                margin: 0;
            }

            .form-actions {
                margin-bottom: 20px;
            }

            

            .admin-help {
                text-align: center;
                padding: 15px;
                background: #f8f9fa;
                border-radius: 8px;
                border-left: 4px solid #3498db;
            }

            .admin-help p {
                margin: 0;
                font-size: 0.85rem;
                color: #6c757d;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
            }

            .admin-help i {
                color: #3498db;
            }

            .error-message {
                color: #e74c3c;
                font-size: 0.85rem;
                margin-top: 5px;
                display: none;
            }

            .error-message.show {
                display: block;
            }

            .success-message {
                color: #27ae60;
                font-size: 0.85rem;
                margin-top: 5px;
                display: none;
            }

            .success-message.show {
                display: block;
            }

            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }

            @keyframes slideInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @media (max-width: 480px) {
                .admin-popup-content {
                    width: 95%;
                    margin: 20px;
                }

                .admin-popup-header,
                .admin-popup-body {
                    padding: 20px;
                }
            }
        `;

        const styleSheet = document.createElement('style');
        styleSheet.textContent = styles;
        document.head.appendChild(styleSheet);
    }

    open() {
        this.popup.classList.add('show');
        this.isOpen = true;
        document.body.style.overflow = 'hidden';
        
        // Focus on username input
        setTimeout(() => {
            document.getElementById('adminUsername').focus();
        }, 100);
    }

    close() {
        this.popup.classList.remove('show');
        this.isOpen = false;
        document.body.style.overflow = '';
        
        // Reset form
        document.getElementById('adminLoginForm').reset();
        this.clearAllErrors();
    }

    validateField(field) {
        if (!field.value.trim()) {
            field.classList.add('error');
            return false;
        }
        return true;
    }

    clearFieldError(field) {
        if (field.value.trim()) {
            field.classList.remove('error');
        }
    }

    clearAllErrors() {
        const errorFields = this.popup.querySelectorAll('.error');
        errorFields.forEach(field => field.classList.remove('error'));
    }

    showError(message) {
        this.showNotification(message, 'error');
    }

    showSuccess(message) {
        this.showNotification(message, 'success');
    }

    showNotification(message, type = 'info') {
        // Remove existing notifications
        const existingNotifications = document.querySelectorAll('.admin-notification');
        existingNotifications.forEach(notification => notification.remove());

        const notification = document.createElement('div');
        notification.className = `admin-notification admin-notification-${type}`;
        notification.innerHTML = `
            <div class="notification-content">
                <i class="fas ${this.getNotificationIcon(type)}"></i>
                <span>${message}</span>
                <button class="notification-close" onclick="this.parentElement.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;

        // Add notification styles
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: ${this.getNotificationColor(type)};
            color: white;
            padding: 15px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            z-index: 10001;
            max-width: 400px;
            animation: slideInRight 0.3s ease;
        `;

        notification.querySelector('.notification-content').style.cssText = `
            display: flex;
            align-items: center;
            gap: 10px;
        `;

        notification.querySelector('.notification-close').style.cssText = `
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            margin-left: auto;
            padding: 0;
            font-size: 14px;
        `;

        document.body.appendChild(notification);

        // Auto remove after 5 seconds
        setTimeout(() => {
            if (notification.parentElement) {
                notification.remove();
            }
        }, 5000);
    }

    getNotificationIcon(type) {
        switch (type) {
            case 'success': return 'fa-check-circle';
            case 'error': return 'fa-exclamation-circle';
            case 'warning': return 'fa-exclamation-triangle';
            default: return 'fa-info-circle';
        }
    }

    getNotificationColor(type) {
        switch (type) {
            case 'success': return '#27ae60';
            case 'error': return '#e74c3c';
            case 'warning': return '#f39c12';
            default: return '#3498db';
        }
    }

    async handleLogin() {
        const username = document.getElementById('adminUsername').value.trim();
        const password = document.getElementById('adminPassword').value.trim();
        const rememberMe = document.getElementById('rememberMe').checked;

        // Validate fields
        if (!username || !password) {
            this.showError('Veuillez remplir tous les champs');
            return;
        }

        // Disable submit button
        const submitBtn = document.querySelector('#adminLoginForm .btn-primary');
        const originalText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Connexion...';

        try {
            // Simulate API call
            await this.simulateLogin(username, password, rememberMe);
            
            this.showSuccess('Connexion réussie ! Redirection...');
            
            // Close popup after success
            setTimeout(() => {
                this.close();
                // Here you would typically redirect to admin dashboard
                console.log('Redirecting to admin dashboard...');
            }, 1500);

        } catch (error) {
            this.showError(error.message);
        } finally {
            // Re-enable submit button
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        }
    }

    simulateLogin(username, password, rememberMe) {
        return new Promise((resolve, reject) => {
            setTimeout(() => {
                // Simulate authentication logic
                if (username === 'admin' && password === 'admin123') {
                    resolve({ success: true, user: { username, role: 'admin' } });
                } else {
                    reject(new Error('Nom d\'utilisateur ou mot de passe incorrect'));
                }
            }, 1500);
        });
    }
}

// Initialize admin popup when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new AdminPopup();
});
