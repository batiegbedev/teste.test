// Contact Page JavaScript
document.addEventListener('DOMContentLoaded', function() {
    
    // Character counter for message textarea
    const messageTextarea = document.getElementById('message');
    const charCount = document.getElementById('charCount');
    
    if (messageTextarea && charCount) {
        messageTextarea.addEventListener('input', function() {
            const currentLength = this.value.length;
            charCount.textContent = currentLength;
            
            // Change color when approaching limit
            if (currentLength > 900) {
                charCount.style.color = '#e74c3c';
            } else if (currentLength > 800) {
                charCount.style.color = '#f39c12';
            } else {
                charCount.style.color = '#666';
            }
        });
    }

    // FAQ Accordion functionality
    const faqItems = document.querySelectorAll('.faq-item');
    
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        
        question.addEventListener('click', function() {
            const isActive = item.classList.contains('active');
            
            // Close all other FAQ items
            faqItems.forEach(otherItem => {
                otherItem.classList.remove('active');
            });
            
            // Toggle current item
            if (!isActive) {
                item.classList.add('active');
            }
        });
    });

    // Contact form handling
    const contactForm = document.querySelector('.contact-form .form');
    
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            const formData = new FormData(this);
            const submitBtn = this.querySelector('.submit-btn');
            
            // Validate form
            if (validateForm(formData)) {
                // Show loading state
                submitBtn.classList.add('loading');
                submitBtn.innerHTML = '<i class="fas fa-spinner"></i> Sending...';
                
                // Simulate form submission (replace with actual API call)
                setTimeout(() => {
                    // Reset form
                    this.reset();
                    charCount.textContent = '0';
                    
                    // Show success message
                    showNotification('Your message has been sent successfully! We will reply within 24 hours.', 'success');
                    
                    // Reset button
                    submitBtn.classList.remove('loading');
                    submitBtn.innerHTML = '<i class="fas fa-paper-plane"></i> Send Message';
                }, 2000);
            }
        });
    }

    // Form validation function
    function validateForm(formData) {
        const firstName = formData.get('firstName');
        const lastName = formData.get('lastName');
        const email = formData.get('email');
        const subject = formData.get('subject');
        const message = formData.get('message');
        const terms = formData.get('terms');

        // Check required fields
        if (!firstName || firstName.trim().length < 2) {
            showNotification('First name must be at least 2 characters.', 'error');
            return false;
        }

        if (!lastName || lastName.trim().length < 2) {
            showNotification('Last name must be at least 2 characters.', 'error');
            return false;
        }

        if (!email || !isValidEmail(email)) {
            showNotification('Please enter a valid email address.', 'error');
            return false;
        }

        if (!subject) {
            showNotification('Please select a subject.', 'error');
            return false;
        }

        if (!message || message.trim().length < 10) {
            showNotification('Message must be at least 10 characters.', 'error');
            return false;
        }

        if (!terms) {
            showNotification('Please accept the terms and conditions.', 'error');
            return false;
        }

        return true;
    }

    // Email validation function
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // Notification function
    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.innerHTML = `
            <div class="notification-content">
                <span class="notification-message">${message}</span>
                <button class="notification-close">&times;</button>
            </div>
        `;

        if (!document.querySelector('#notification-styles')) {
            const style = document.createElement('style');
            style.id = 'notification-styles';
            style.textContent = `
                .notification { position: fixed; top: 20px; right: 20px; background: white; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 10000; transform: translateX(100%); transition: transform 0.3s ease; max-width: 400px; }
                .notification.show { transform: translateX(0); }
                .notification-content { padding: 15px 20px; display: flex; align-items: center; justify-content: space-between; }
                .notification-message { color: #333; font-size: 14px; }
                .notification-close { background: none; border: none; font-size: 20px; cursor: pointer; color: #666; margin-left: 10px; }
                .notification-success { border-left: 4px solid #27ae60; }
                .notification-error { border-left: 4px solid #e74c3c; }
                .notification-info { border-left: 4px solid #3498db; }
            `;
            document.head.appendChild(style);
        }

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
                setTimeout(() => { if (document.body.contains(notification)) document.body.removeChild(notification); }, 300);
            }
        }, 5000);
    }

    // Real-time form validation
    const formInputs = document.querySelectorAll('.form-group input, .form-group select, .form-group textarea');
    
    formInputs.forEach(input => {
        input.addEventListener('blur', function() { validateField(this); });
        input.addEventListener('input', function() { this.style.borderColor = '#ddd'; });
    });

    function validateField(field) {
        const value = field.value.trim();
        const fieldName = field.name;
        
        switch(fieldName) {
            case 'firstName':
            case 'lastName':
                field.style.borderColor = value.length < 2 ? '#e74c3c' : '#27ae60';
                break;
            case 'email':
                field.style.borderColor = !isValidEmail(value) ? '#e74c3c' : '#27ae60';
                break;
            case 'subject':
                field.style.borderColor = !value ? '#e74c3c' : '#27ae60';
                break;
            case 'message':
                field.style.borderColor = value.length < 10 ? '#e74c3c' : '#27ae60';
                break;
        }
    }

    // Smooth scroll for FAQ section
    const faqSection = document.querySelector('.faq-section');
    if (faqSection) {
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, { threshold: 0.1 });

        const faqItems = document.querySelectorAll('.faq-item');
        faqItems.forEach((item, index) => {
            item.style.opacity = '0';
            item.style.transform = 'translateY(30px)';
            item.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
            observer.observe(item);
        });
    }

    // Contact card hover effects
    const contactCards = document.querySelectorAll('.contact-card');
    contactCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            const icon = this.querySelector('.contact-icon');
            if (icon) icon.style.transform = 'scale(1.1)';
        });
        card.addEventListener('mouseleave', function() {
            const icon = this.querySelector('.contact-icon');
            if (icon) icon.style.transform = 'scale(1)';
        });
    });

    // Social media links
    const socialLinks = document.querySelectorAll('.social-icon');
    socialLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const platform = this.querySelector('i').className;
            showNotification(`Redirecting to ${getPlatformName(platform)}...`, 'info');
        });
    });

    function getPlatformName(className) {
        if (className.includes('facebook')) return 'Facebook';
        if (className.includes('instagram')) return 'Instagram';
        if (className.includes('twitter')) return 'Twitter';
        if (className.includes('youtube')) return 'YouTube';
        return 'social media';
    }

    console.log('Contact page loaded successfully!');
});
