<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Loading Popup -->
    <div id="loadingPopup" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 max-w-sm w-full mx-4 shadow-xl">
            <div class="flex items-center justify-center">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-indigo-600"></div>
                <span class="ml-3 text-gray-700 dark:text-gray-300">Logging in...</span>
            </div>
        </div>
    </div>

    <!-- Dynamic Error Popup -->
    <div id="errorPopup" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 max-w-md w-full mx-4 shadow-xl">
            <div class="flex items-center mb-4">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        Login Error
                    </h3>
                </div>
            </div>
            <div class="mt-2">
                <p id="errorMessage" class="text-sm text-red-600 dark:text-red-400"></p>
            </div>
            <div class="mt-4 flex justify-end">
                <button onclick="closeErrorPopup()" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                    Close
                </button>
            </div>
        </div>
    </div>

    <!-- Success Popup -->
    <div id="successPopup" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 max-w-md w-full mx-4 shadow-xl">
            <div class="flex items-center mb-4">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        Login Successful!
                    </h3>
                </div>
            </div>
            <div class="mt-2">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Redirecting...
                </p>
            </div>
        </div>
    </div>

    <form id="loginForm" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Remember me</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    Forgot your password?
                </a>
            @endif

            <x-primary-button class="ms-3" type="submit">
                Log in
            </x-primary-button>
        </div>
    </form>

    <!-- AJAX Login Script -->
    <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Show loading popup
            showLoadingPopup();
            
            // Get form data
            const formData = new FormData(this);
            
            // Send AJAX request
            fetch('{{ route("login") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            })
            .then(response => response.json())
            .then(data => {
                hideLoadingPopup();
                
                if (data.success) {
                    // Login successful
                    showSuccessPopup();
                    setTimeout(() => {
                        window.location.href = data.redirect || '/dashboard';
                    }, 1500);
                } else {
                    // Login error
                    showErrorPopup(data.message || 'Login error');
                }
            })
            .catch(error => {
                hideLoadingPopup();
                showErrorPopup('Server connection error');
                console.error('Error:', error);
            });
        });

        function showLoadingPopup() {
            document.getElementById('loadingPopup').classList.remove('hidden');
        }

        function hideLoadingPopup() {
            document.getElementById('loadingPopup').classList.add('hidden');
        }

        function showErrorPopup(message) {
            document.getElementById('errorMessage').textContent = message;
            document.getElementById('errorPopup').classList.remove('hidden');
            
            // Fade-in animation
            const popup = document.getElementById('errorPopup');
            popup.style.opacity = '0';
            popup.style.transform = 'scale(0.9)';
            
            setTimeout(() => {
                popup.style.transition = 'all 0.3s ease';
                popup.style.opacity = '1';
                popup.style.transform = 'scale(1)';
            }, 100);
        }

        function showSuccessPopup() {
            document.getElementById('successPopup').classList.remove('hidden');
            
            // Fade-in animation
            const popup = document.getElementById('successPopup');
            popup.style.opacity = '0';
            popup.style.transform = 'scale(0.9)';
            
            setTimeout(() => {
                popup.style.transition = 'all 0.3s ease';
                popup.style.opacity = '1';
                popup.style.transform = 'scale(1)';
            }, 100);
        }

        function closeErrorPopup() {
            const popup = document.getElementById('errorPopup');
            popup.style.transition = 'all 0.3s ease';
            popup.style.opacity = '0';
            popup.style.transform = 'scale(0.9)';
            
            setTimeout(() => {
                popup.classList.add('hidden');
            }, 300);
        }

        // Close popups by clicking outside
        document.addEventListener('click', function(event) {
            const errorPopup = document.getElementById('errorPopup');
            const successPopup = document.getElementById('successPopup');
            
            if (event.target === errorPopup) {
                closeErrorPopup();
            }
            if (event.target === successPopup) {
                successPopup.classList.add('hidden');
            }
        });

        // Close popups with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeErrorPopup();
                document.getElementById('successPopup').classList.add('hidden');
            }
        });
    </script>
</x-guest-layout>
