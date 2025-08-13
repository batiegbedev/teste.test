// DOM Elements
let uploadedImages = [];
const recipeForm = document.getElementById('recipeForm');
const uploadArea = document.getElementById('uploadArea');
const imageUpload = document.getElementById('imageUpload');
const imagePreview = document.getElementById('imagePreview');
const ingredientsTextarea = document.getElementById('ingredients');
const instructionsTextarea = document.getElementById('instructions');
const ingredientsCounter = document.getElementById('ingredientsCounter');
const instructionsCounter = document.getElementById('instructionsCounter');
const previewBtn = document.getElementById('previewBtn');

// Character counters
function updateCharacterCounter(textarea, counterElement, maxLength) {
    const currentLength = textarea.value.length;
    counterElement.textContent = currentLength;
}
function removeImage(imageId) {
    uploadedImages = uploadedImages.filter(img => img.id != imageId);
    const previewItem = imagePreview.querySelector(`[data-id="${imageId}"]`);
    if (previewItem) {
        previewItem.remove();
    }
}

// Form validation
function validateForm() {
    let isValid = true;
    const requiredFields = [
        { element: document.getElementById('recipeTitle'), errorId: 'titleError' },
        { element: document.getElementById('recipeCategory'), errorId: null },
        { element: document.getElementById('ingredients'), errorId: null },
        { element: document.getElementById('instructions'), errorId: null },
        { element: document.getElementById('terms'), errorId: null }
    ];

    requiredFields.forEach(field => {
        const element = field.element;
        const errorElement = field.errorId ? document.getElementById(field.errorId) : null;
        
        if (!element.value.trim()) {
            element.classList.add('error');
            if (errorElement) {
                errorElement.classList.add('show');
            }
            isValid = false;
        } else {
            element.classList.remove('error');
            if (errorElement) {
                errorElement.classList.remove('show');
            }
        }
    });

    return isValid;
}

// Real-time validation
const requiredInputs = document.querySelectorAll('input[required], select[required], textarea[required]');

requiredInputs.forEach(input => {
    input.addEventListener('blur', () => {
        if (!input.value.trim()) {
            input.classList.add('error');
        } else {
            input.classList.remove('error');
        }
    });
    input.addEventListener('input', () => {
        if (input.value.trim()) {
            input.classList.remove('error');
        }
    });
});

// Form submission
if (recipeForm) {
    recipeForm.addEventListener('submit', (e) => {
        e.preventDefault();
        
        if (!validateForm()) {
            showNotification('Veuillez remplir tous les champs obligatoires', 'error');
            return;
        }

        // Show loading state
        recipeForm.classList.add('form-loading');
        
        // Simulate form submission
        setTimeout(() => {
            recipeForm.classList.remove('form-loading');
            showNotification('Votre recette a été soumise avec succès ! Elle sera examinée et publiée sous peu.', 'success');
            
            // Reset form
            recipeForm.reset();
            uploadedImages = [];
            imagePreview.innerHTML = '';
            ingredientsCounter.textContent = '0';
            instructionsCounter.textContent = '0';
            
            // Remove error states
            document.querySelectorAll('.error').forEach(el => el.classList.remove('error'));
            document.querySelectorAll('.error-message').forEach(el => el.classList.remove('show'));
            
        }, 2000);
    });
}

// Preview functionality
if (previewBtn) {
    previewBtn.addEventListener('click', () => {
        if (!validateForm()) {
            showNotification('Veuillez remplir tous les champs obligatoires pour prévisualiser', 'error');
            return;
        }
        // Récupérer les données du formulaire
        const formData = new FormData(recipeForm);
        const previewData = {
            title: formData.get('recipeTitle'),
            category: formData.get('recipeCategory'),
            chefName: formData.get('chefName'),
            prepTime: formData.get('prepTime'),
            cookTime: formData.get('cookTime'),
            servings: formData.get('servings'),
            ingredients: formData.get('ingredients'),
            instructions: formData.get('instructions'),
            history: formData.get('recipeHistory'),
            tips: formData.get('chefTips'),
            images: (typeof uploadedImages !== 'undefined') ? uploadedImages : []
        };
        // Stocker les données dans sessionStorage et ouvrir la page d'aperçu
        sessionStorage.setItem('recipePreview', JSON.stringify(previewData));
        window.open('preview.html', '_blank');
    });
}




// Notification system
function showNotification(message, type = 'info') {
    // Remove existing notifications
    const existingNotifications = document.querySelectorAll('.notification');
    existingNotifications.forEach(notification => notification.remove());
    
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <div class="notification-content">
            <i class="fas ${getNotificationIcon(type)}"></i>
            <span>${message}</span>
            <button class="notification-close" onclick="this.parentElement.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
    
    // Add styles
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: ${getNotificationColor(type)};
        color: white;
        padding: 15px 20px;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        z-index: 1000;
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

function getNotificationIcon(type) {
    switch (type) {
        case 'success': return 'fa-check-circle';
        case 'error': return 'fa-exclamation-circle';
        case 'warning': return 'fa-exclamation-triangle';
        default: return 'fa-info-circle';
    }
}

function getNotificationColor(type) {
    switch (type) {
        case 'success': return '#27ae60';
        case 'error': return '#e74c3c';
        case 'warning': return '#f39c12';
        default: return '#3498db';
    }
}

// Add CSS animation for notifications
const style = document.createElement('style');
style.textContent = `
    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
`;
document.head.appendChild(style);

// Auto-save functionality
let autoSaveTimeout;
function autoSave() {
    clearTimeout(autoSaveTimeout);
    autoSaveTimeout = setTimeout(() => {
        const formData = new FormData(recipeForm);
        const data = {
            title: formData.get('recipeTitle'),
            category: formData.get('recipeCategory'),
            chefName: formData.get('chefName'),
            prepTime: formData.get('prepTime'),
            cookTime: formData.get('cookTime'),
            servings: formData.get('servings'),
            ingredients: formData.get('ingredients'),
            instructions: formData.get('instructions'),
            history: formData.get('recipeHistory'),
            tips: formData.get('chefTips'),
            email: formData.get('email'),
            phone: formData.get('phone')
        };
        
        localStorage.setItem('recipeDraft', JSON.stringify(data));
    }, 1000);
}

// Add auto-save to form inputs
const formInputs = recipeForm.querySelectorAll('input, select, textarea');

formInputs.forEach(input => {
    input.addEventListener('input', autoSave);
});

// Load draft on page load
window.addEventListener('load', () => {
    const draft = localStorage.getItem('recipeDraft');
    if (draft) {
        const data = JSON.parse(draft);
        Object.keys(data).forEach(key => {
            const element = document.querySelector(`[name="${key}"]`);
            if (element && data[key]) {
                element.value = data[key];
            }
        });
        // Update character counters
        if (ingredientsTextarea && data.ingredients) {
            updateCharacterCounter(ingredientsTextarea, ingredientsCounter, 2000);
        }
        if (instructionsTextarea && data.instructions) {
            updateCharacterCounter(instructionsTextarea, instructionsCounter, 5000);
        }
    }
});

// Clear draft after successful submission
function clearDraft() {
    localStorage.removeItem('recipeDraft');
}


// Enhanced form interactions
document.addEventListener('DOMContentLoaded', () => {
    // Smooth scrolling for form sections
    const formSections = document.querySelectorAll('.form-section');
    formSections.forEach(section => {
        const title = section.querySelector('.form-section-title');
        if (title) {
            title.style.cursor = 'pointer';
            title.addEventListener('click', () => {
                section.scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
        }
    });
    // Add visual feedback for form completion
    function updateFormProgress() {
        const requiredFields = document.querySelectorAll('input[required], select[required], textarea[required]');
        const filledFields = Array.from(requiredFields).filter(field => field.value.trim() !== '');
        const progress = (filledFields.length / requiredFields.length) * 100;
        // You can add a progress bar here if needed
        console.log(`Form completion: ${Math.round(progress)}%`);
    }
    // Update progress on input
    formInputs.forEach(input => {
        input.addEventListener('input', updateFormProgress);
    });
    // Initial progress check
    updateFormProgress();

    // Keyboard shortcuts
    document.addEventListener('keydown', (e) => {
        // Ctrl/Cmd + S to save draft
        if ((e.ctrlKey || e.metaKey) && e.key === 's') {
            e.preventDefault();
            autoSave();
            showNotification('Brouillon sauvegardé', 'success');
        }
        // Ctrl/Cmd + Enter to submit
        if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
            e.preventDefault();
            recipeForm.dispatchEvent(new Event('submit'));
        }
    });
});
