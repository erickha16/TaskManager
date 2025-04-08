<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>@yield('title')</title>
</head>
<body>
    <!-- Navigation Bar -->
    @if(Auth::check())
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <svg class="h-8 w-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <span class="ml-2 text-xl font-bold text-gray-800">TaskManager</span>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="ml-4 flex items-center md:ml-6">
                        <span class="text-sm font-medium text-gray-500 mr-4">Welcome, {{ Auth::user()->name }}!</span>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                Logout
                                <svg class="ml-1 -mr-0.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    @endif
    <!-- Main Content -->
    @yield('content')
    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-8">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            <p class="text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} Task Manager. All rights reserved.
            </p>
        </div>
    </footer>

    <!-- Toast de notificación -->
<div id="toast" class="hidden fixed bottom-4 right-4 z-50">
    <div class="flex items-center p-4 w-full max-w-xs text-white rounded-lg shadow-lg" id="toast-content">
        <div class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" id="toast-icon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        <div class="ml-3 text-sm font-normal" id="toast-message"></div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 text-white hover:text-gray-100 rounded-lg p-1.5 inline-flex h-8 w-8" onclick="hideToast()">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
</div>
    @yield('scripts')
    <script>
        // Funciones globales para manejar el toast
    window.showToast = function(message, type = 'success') {
        const toast = document.getElementById('toast');
        const toastContent = document.getElementById('toast-content');
        const toastIcon = document.getElementById('toast-icon');
        const toastMessage = document.getElementById('toast-message');
        
        // Configura el mensaje y el color según el tipo
        toastMessage.textContent = message;
        toastContent.className = `flex items-center p-4 w-full max-w-xs text-white rounded-lg shadow-lg toast-transition toast-show ${
            type === 'success' ? 'bg-green-600' : 'bg-red-600'
        }`;
        
        // Cambia el icono según el tipo
        if (type === 'success') {
            toastIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>';
        } else {
            toastIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>';
        }
        
        toast.classList.remove('hidden');
        
        // Oculta automáticamente después de 3 segundos
        setTimeout(() => {
            hideToast();
        }, 3000);
    };

    window.hideToast = function() {
        const toast = document.getElementById('toast');
        toast.classList.add('hidden');
    };
    </script>
</body>
</html>