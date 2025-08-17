<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Dynamic header -->
            <div class="animate-on-scroll bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                                Welcome, {{ auth()->user()->name }}!
                            </h1>
                            <p class="mt-2 text-gray-600 dark:text-gray-400">
                                Manage your recipes and explore new flavors
                            </p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="text-right">
                                <p class="text-sm text-gray-500 dark:text-gray-400">Role</p>
                                <p class="text-lg font-semibold text-indigo-600 dark:text-indigo-400">
                                    {{ ucfirst(auth()->user()->role) }}
                                </p>
                            </div>
                            <div class="w-12 h-12 bg-indigo-600 rounded-full flex items-center justify-center hover-lift">
                                <span class="text-white text-lg font-bold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dynamic statistics -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Stat card 1 -->
                <div class="animate-on-scroll bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg hover-lift">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Recipes</p>
                                <p class="text-2xl font-semibold text-gray-900 dark:text-white">12</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stat card 2 -->
                <div class="animate-on-scroll bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg hover-lift">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Published</p>
                                <p class="text-2xl font-semibold text-gray-900 dark:text-white">8</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stat card 3 -->
                <div class="animate-on-scroll bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg hover-lift">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-yellow-500 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Drafts</p>
                                <p class="text-2xl font-semibold text-gray-900 dark:text-white">4</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stat card 4 -->
                <div class="animate-on-scroll bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg hover-lift">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-purple-500 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Views</p>
                                <p class="text-2xl font-semibold text-gray-900 dark:text-white">1,234</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick actions -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Create a recipe -->
                <div class="animate-on-scroll bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg hover-lift">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Quick Actions</h3>
                        <div class="space-y-3">
                            <button onclick="showNotification('info', 'Feature under development')" 
                                    class="w-full flex items-center justify-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Create a new recipe
                            </button>
                            
                            <button onclick="showNotification('info', 'Feature under development')" 
                                    class="w-full flex items-center justify-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                                View all recipes
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Recent activity -->
                <div class="animate-on-scroll bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg hover-lift">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Recent Activity</h3>
                        <div class="space-y-3">
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                <span class="text-sm text-gray-600 dark:text-gray-400">Recipe "Pasta Carbonara" published</span>
                                <span class="text-xs text-gray-500">2h ago</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                <span class="text-sm text-gray-600 dark:text-gray-400">Recipe "Tiramisu" updated</span>
                                <span class="text-xs text-gray-500">1d ago</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-yellow-500 rounded-full"></div>
                                <span class="text-sm text-gray-600 dark:text-gray-400">New recipe created</span>
                                <span class="text-xs text-gray-500">3d ago</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent recipes -->
            <div class="animate-on-scroll bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Recent Recipes</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Recipe 1 -->
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 hover-lift">
                            <div class="flex items-center justify-between mb-2">
                                <h4 class="font-semibold text-gray-900 dark:text-white">Pasta Carbonara</h4>
                                <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">Published</span>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Delicious traditional carbonara pasta recipe</p>
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-gray-500">Difficulty: Medium</span>
                                <button onclick="showNotification('success', 'Recipe opened')" 
                                        class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                    View →
                                </button>
                            </div>
                        </div>

                        <!-- Recipe 2 -->
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 hover-lift">
                            <div class="flex items-center justify-between mb-2">
                                <h4 class="font-semibold text-gray-900 dark:text-white">Tiramisu</h4>
                                <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">Published</span>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Classic Italian dessert with coffee flavors</p>
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-gray-500">Difficulty: Easy</span>
                                <button onclick="showNotification('success', 'Recipe opened')" 
                                        class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                    View →
                                </button>
                            </div>
                        </div>

                        <!-- Recipe 3 -->
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 hover-lift">
                            <div class="flex items-center justify-between mb-2">
                                <h4 class="font-semibold text-gray-900 dark:text-white">Mushroom Risotto</h4>
                                <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded-full">Draft</span>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Creamy risotto with Paris mushrooms</p>
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-gray-500">Difficulty: Medium</span>
                                <button onclick="showNotification('info', 'Recipe is being drafted')" 
                                        class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                    Edit →
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Dynamic popups -->
    <x-dynamic-popup id="confirmPopup" type="info" title="Confirmation" message="Are you sure you want to perform this action?" />
    <x-toast-notification id="mainToast" type="info" message="" />

    <script>
        // Extra animations
        document.addEventListener('DOMContentLoaded', function() {
            // Stats card animation
            const statsCards = document.querySelectorAll('.animate-on-scroll');
            statsCards.forEach((card, index) => {
                setTimeout(() => {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px)';
                    card.style.transition = 'all 0.6s ease';
                    
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, 100);
                }, index * 100);
            });

            // Enhanced hover effect for cards
            const hoverCards = document.querySelectorAll('.hover-lift');
            hoverCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-4px) scale(1.02)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });
        });

        // Function to display notifications
        function showNotification(type, message) {
            if (typeof window.showNotification === 'function') {
                window.showNotification(type, message);
            } else {
                // Simple fallback
                alert(message);
            }
        }
    </script>
</x-app-layout>
