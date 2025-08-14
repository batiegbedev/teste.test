@props(['id', 'type' => 'info', 'title' => '', 'message' => '', 'show' => false])

@php
    $colors = [
        'success' => ['bg' => 'bg-green-50 dark:bg-green-900/20', 'icon' => 'text-green-400', 'button' => 'bg-green-600 hover:bg-green-700'],
        'error' => ['bg' => 'bg-red-50 dark:bg-red-900/20', 'icon' => 'text-red-400', 'button' => 'bg-red-600 hover:bg-red-700'],
        'warning' => ['bg' => 'bg-yellow-50 dark:bg-yellow-900/20', 'icon' => 'text-yellow-400', 'button' => 'bg-yellow-600 hover:bg-yellow-700'],
        'info' => ['bg' => 'bg-blue-50 dark:bg-blue-900/20', 'icon' => 'text-blue-400', 'button' => 'bg-blue-600 hover:bg-blue-700'],
    ];
    
    $icons = [
        'success' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />',
        'error' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />',
        'warning' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />',
        'info' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />',
    ];
@endphp

<div id="{{ $id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 {{ $show ? '' : 'hidden' }}" 
     x-data="{ show: {{ $show ? 'true' : 'false' }} }" 
     x-show="show" 
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 transform scale-95"
     x-transition:enter-end="opacity-100 transform scale-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 transform scale-100"
     x-transition:leave-end="opacity-0 transform scale-95">
    
    <div class="bg-white dark:bg-gray-800 rounded-lg p-6 max-w-md w-full mx-4 shadow-xl {{ $colors[$type]['bg'] }}">
        <div class="flex items-center mb-4">
            <div class="flex-shrink-0">
                <svg class="h-6 w-6 {{ $colors[$type]['icon'] }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    {!! $icons[$type] !!}
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ $title }}
                </h3>
            </div>
        </div>
        
        <div class="mt-2">
            <p class="text-sm text-gray-600 dark:text-gray-400">
                {{ $message }}
            </p>
        </div>
        
        <div class="mt-4 flex justify-end space-x-3">
            <button onclick="closePopup('{{ $id }}')" 
                    class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-500 dark:hover:text-gray-400 transition-colors">
                Annuler
            </button>
            <button onclick="confirmPopup('{{ $id }}')" 
                    class="px-4 py-2 text-sm font-medium text-white {{ $colors[$type]['button'] }} rounded-md transition-colors">
                Confirmer
            </button>
        </div>
    </div>
</div>

<script>
function showPopup(id, type = 'info', title = '', message = '') {
    const popup = document.getElementById(id);
    if (popup) {
        // Mettre à jour le contenu
        const titleEl = popup.querySelector('h3');
        const messageEl = popup.querySelector('p');
        if (titleEl) titleEl.textContent = title;
        if (messageEl) messageEl.textContent = message;
        
        // Afficher le popup
        popup.classList.remove('hidden');
        
        // Animation d'apparition
        popup.style.opacity = '0';
        popup.style.transform = 'scale(0.9)';
        
        setTimeout(() => {
            popup.style.transition = 'all 0.3s ease';
            popup.style.opacity = '1';
            popup.style.transform = 'scale(1)';
        }, 100);
    }
}

function closePopup(id) {
    const popup = document.getElementById(id);
    if (popup) {
        popup.style.transition = 'all 0.3s ease';
        popup.style.opacity = '0';
        popup.style.transform = 'scale(0.9)';
        
        setTimeout(() => {
            popup.classList.add('hidden');
        }, 300);
    }
}

function confirmPopup(id) {
    // Émettre un événement personnalisé pour la confirmation
    const event = new CustomEvent('popup-confirmed', { detail: { id } });
    document.dispatchEvent(event);
    closePopup(id);
}

// Fermer les popups en cliquant à l'extérieur
document.addEventListener('click', function(event) {
    const popups = document.querySelectorAll('[id$="Popup"]');
    popups.forEach(popup => {
        if (event.target === popup) {
            closePopup(popup.id);
        }
    });
});

// Fermer les popups avec la touche Escape
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        const popups = document.querySelectorAll('[id$="Popup"]');
        popups.forEach(popup => {
            if (!popup.classList.contains('hidden')) {
                closePopup(popup.id);
            }
        });
    }
});
</script>
