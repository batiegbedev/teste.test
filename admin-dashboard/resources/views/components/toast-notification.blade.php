@props(['id' => 'toast', 'type' => 'info', 'message' => '', 'duration' => 5000])

@php
    $colors = [
        'success' => ['bg' => 'bg-green-500', 'icon' => 'text-green-500', 'border' => 'border-green-200'],
        'error' => ['bg' => 'bg-red-500', 'icon' => 'text-red-500', 'border' => 'border-red-200'],
        'warning' => ['bg' => 'bg-yellow-500', 'icon' => 'text-yellow-500', 'border' => 'border-yellow-200'],
        'info' => ['bg' => 'bg-blue-500', 'icon' => 'text-blue-500', 'border' => 'border-blue-200'],
    ];
    
    $icons = [
        'success' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />',
        'error' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />',
        'warning' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />',
        'info' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />',
    ];
@endphp

<div id="{{ $id }}" class="fixed top-4 right-4 z-50 hidden">
    <div class="bg-white dark:bg-gray-800 border-l-4 {{ $colors[$type]['border'] }} shadow-lg rounded-lg p-4 max-w-sm w-full transform transition-all duration-300 ease-in-out">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 {{ $colors[$type]['icon'] }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    {!! $icons[$type] !!}
                </svg>
            </div>
            <div class="ml-3 flex-1">
                <p class="text-sm font-medium text-gray-900 dark:text-gray-100">
                    {{ $message }}
                </p>
            </div>
            <div class="ml-4 flex-shrink-0 flex">
                <button onclick="closeToast('{{ $id }}')" class="inline-flex text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Barre de progression -->
        <div class="mt-2 h-1 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
            <div class="h-full {{ $colors[$type]['bg'] }} transition-all duration-300 ease-linear" style="width: 100%"></div>
        </div>
    </div>
</div>

<script>
function showToast(id, type = 'info', message = '', duration = 5000) {
    const toast = document.getElementById(id);
    if (toast) {
        // Mettre à jour le contenu
        const messageEl = toast.querySelector('p');
        if (messageEl) messageEl.textContent = message;
        
        // Afficher le toast
        toast.classList.remove('hidden');
        toast.style.transform = 'translateX(100%)';
        
        // Animation d'apparition
        setTimeout(() => {
            toast.style.transition = 'transform 0.3s ease-in-out';
            toast.style.transform = 'translateX(0)';
        }, 100);
        
        // Barre de progression
        const progressBar = toast.querySelector('.h-1 > div');
        if (progressBar) {
            setTimeout(() => {
                progressBar.style.width = '0%';
            }, 100);
        }
        
        // Auto-fermeture
        if (duration > 0) {
            setTimeout(() => {
                closeToast(id);
            }, duration);
        }
    }
}

function closeToast(id) {
    const toast = document.getElementById(id);
    if (toast) {
        toast.style.transform = 'translateX(100%)';
        
        setTimeout(() => {
            toast.classList.add('hidden');
        }, 300);
    }
}

// Fonction globale pour afficher des notifications
window.showNotification = function(type, message, duration = 5000) {
    const toastId = 'toast-' + Date.now();
    const toastHtml = `
        <div id="${toastId}" class="fixed top-4 right-4 z-50">
            <div class="bg-white dark:bg-gray-800 border-l-4 border-${type === 'success' ? 'green' : type === 'error' ? 'red' : type === 'warning' ? 'yellow' : 'blue'}-200 shadow-lg rounded-lg p-4 max-w-sm w-full transform transition-all duration-300 ease-in-out">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-${type === 'success' ? 'green' : type === 'error' ? 'red' : type === 'warning' ? 'yellow' : 'blue'}-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            ${type === 'success' ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />' : 
                              type === 'error' ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />' : 
                              type === 'warning' ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />' : 
                              '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />'}
                        </svg>
                    </div>
                    <div class="ml-3 flex-1">
                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100">${message}</p>
                    </div>
                    <div class="ml-4 flex-shrink-0 flex">
                        <button onclick="closeToast('${toastId}')" class="inline-flex text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    document.body.insertAdjacentHTML('beforeend', toastHtml);
    
    const toast = document.getElementById(toastId);
    toast.style.transform = 'translateX(100%)';
    
    setTimeout(() => {
        toast.style.transition = 'transform 0.3s ease-in-out';
        toast.style.transform = 'translateX(0)';
    }, 100);
    
    if (duration > 0) {
        setTimeout(() => {
            closeToast(toastId);
        }, duration);
    }
};
</script>
