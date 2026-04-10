<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Lumière Beauty') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }

        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        .animate-slide-in {
            animation: slideIn 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800 antialiased">
    <nav class="fixed w-full z-50 glass border-b border-slate-200/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-semibold tracking-tight text-blue-900">
                        Lumière<span class="text-blue-500">.</span>
                    </a>
                </div>
                <div class="hidden sm:flex sm:space-x-8">
                    <a href="{{ route('home') }}"
                        class="text-slate-600 hover:text-blue-600 px-3 py-2 text-sm font-medium transition-colors">Catalog</a>
                    <a href="{{ route('guest.about') }}"
                        class="text-slate-600 hover:text-blue-600 px-3 py-2 text-sm font-medium transition-colors">About</a>
                    <a href="{{ route('guest.contact') }}"
                        class="text-slate-600 hover:text-blue-600 px-3 py-2 text-sm font-medium transition-colors">Contact</a>
                    @auth
                        <a href="{{ route('cart.index') }}"
                            class="text-slate-600 hover:text-blue-600 px-3 py-2 text-sm font-medium transition-colors">Cart</a>
                        <a href="{{ route('orders.index') }}"
                            class="text-slate-600 hover:text-blue-600 px-3 py-2 text-sm font-medium transition-colors">My
                            Orders</a>
                    @endauth
                </div>
                <div>
                    @auth
                        <div class="flex items-center space-x-4">
                            @if (Auth::user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}"
                                    class="text-slate-600 hover:text-blue-600 text-sm font-medium">Dashboard</a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="text-slate-600 hover:text-blue-600 text-sm font-medium">Logout</button>
                            </form>
                        </div>
                    @else
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('login') }}"
                                class="text-slate-600 hover:text-blue-600 text-sm font-medium">Login</a>
                            <a href="{{ route('register') }}"
                                class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-700 transition-colors">Register</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Toast Notification -->
    @if(session('success'))
    <div id="toast" class="fixed top-20 right-4 z-[100] animate-slide-in">
        <div class="glass border-l-4 border-blue-500 rounded-lg shadow-xl p-4 flex items-center space-x-3 min-w-[300px]">
            <div class="bg-blue-100 rounded-full p-1">
                <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <div class="flex-1">
                <p class="text-sm font-medium text-slate-900">{{ session('success') }}</p>
            </div>
            <button onclick="document.getElementById('toast').remove()" class="text-slate-400 hover:text-slate-600 transition-colors">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
    <script>
        setTimeout(() => {
            const toast = document.getElementById('toast');
            if(toast) {
                toast.style.opacity = '0';
                toast.style.transform = 'translateX(100%)';
                toast.style.transition = 'all 0.5s ease';
                setTimeout(() => toast.remove(), 500);
            }
        }, 3000);
    </script>
    @endif

    <main class="pt-16 min-h-screen">
        {{ $slot }}
    </main>

    <footer class="bg-white border-t border-slate-100 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-center text-slate-400 text-sm">
            &copy; {{ date('Y') }} Lumière Beauty. All rights reserved.
        </div>
    </footer>
</body>

</html>