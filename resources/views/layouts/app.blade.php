<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'EasyColoc') - Your Trusted Colocation Partner</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700,0..1&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#36e270",
                        "background-light": "#f6f8f6",
                        "background-dark": "#112117",
                    },
                    fontFamily: {
                        "display": ["Inter"]
                    },
                    borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
                },
            },
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100">
<div class="relative flex min-h-screen w-full flex-col overflow-x-hidden">
<!-- Navigation Bar -->
<header class="sticky top-0 z-50 w-full border-b border-slate-200 dark:border-slate-800 bg-white/80 dark:bg-background-dark/80 backdrop-blur-md">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<div class="flex items-center justify-between h-16">
<div class="flex items-center gap-8">
<a class="flex items-center gap-2 group" href="/">
<div class="bg-primary p-1.5 rounded-lg text-white">
<span class="material-symbols-outlined block text-2xl">home</span>
</div>
<h2 class="text-slate-900 dark:text-slate-100 text-xl font-bold tracking-tight">EasyColoc</h2>
</a>
<nav class="hidden md:flex items-center gap-6">
<a class="text-slate-600 dark:text-slate-400 hover:text-primary dark:hover:text-primary text-sm font-medium transition-colors" href="{{ route('dashboard') }}">Dashboard</a>
<a class="text-slate-600 dark:text-slate-400 hover:text-primary dark:hover:text-primary text-sm font-medium transition-colors" href="{{ route('colocations.index') }}">My Colocations</a>
</nav>
</div>
<div class="flex items-center gap-4">
<div class="hidden lg:flex items-center bg-slate-100 dark:bg-slate-800 rounded-lg px-3 py-1.5 w-64 border border-transparent focus-within:border-primary/50 transition-all">
<span class="material-symbols-outlined text-slate-400 text-xl">search</span>
<input class="bg-transparent border-none focus:ring-0 text-sm w-full placeholder:text-slate-400" placeholder="Search colocations..." type="text"/>
</div>
<div class="flex items-center gap-2">
@auth
<!-- Notifications Dropdown -->
<div class="relative" x-data="{ open: false }">
<button @click="open = !open" class="p-2 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg transition-colors relative">
<span class="material-symbols-outlined text-slate-700 dark:text-slate-300">notifications</span>
<span class="absolute top-1 right-1 bg-primary text-[10px] text-white font-bold px-1 rounded-full">3</span>
</button>
<div x-show="open" 
     @click.away="open = false"
     x-transition:enter="transition ease-out duration-200"
     x-transition:enter-start="opacity-0 transform scale-95"
     x-transition:enter-end="opacity-100 transform scale-100"
     x-transition:leave="transition ease-in duration-150"
     x-transition:leave-start="opacity-100 transform scale-100"
     x-transition:leave-end="opacity-0 transform scale-95"
     class="absolute right-0 mt-2 w-80 bg-slate-900 dark:bg-slate-800 rounded-lg shadow-lg border border-slate-600 dark:border-slate-700 py-2 z-[9999]">
    <div class="px-4 py-2 border-b border-slate-600 dark:border-slate-700 flex justify-between items-center">
        <h3 class="text-sm font-semibold text-slate-100 dark:text-slate-200">Notifications</h3>
        <button @click="open = false" class="text-slate-400 hover:text-slate-300 transition-colors">
            <span class="material-symbols-outlined text-sm">close</span>
        </button>
    </div>
    <div class="max-h-96 overflow-y-auto">
        <a href="#" class="block px-4 py-3 hover:bg-slate-700 dark:hover:bg-slate-600 transition-colors">
            <div class="flex items-start gap-3">
                <span class="material-symbols-outlined text-green-400 text-sm mt-0.5">check_circle</span>
                <div class="flex-1">
                    <p class="text-sm text-slate-100 dark:text-slate-200">Invitation accepted</p>
                    <p class="text-xs text-slate-400 dark:text-slate-500">John joined your colocation</p>
                </div>
            </div>
        </a>
        <a href="#" class="block px-4 py-3 hover:bg-slate-700 dark:hover:bg-slate-600 transition-colors">
            <div class="flex items-start gap-3">
                <span class="material-symbols-outlined text-blue-400 text-sm mt-0.5">payments</span>
                <div class="flex-1">
                    <p class="text-sm text-slate-100 dark:text-slate-200">New expense added</p>
                    <p class="text-xs text-slate-400 dark:text-slate-500">Groceries - $45.50</p>
                </div>
            </div>
        </a>
        <a href="#" class="block px-4 py-3 hover:bg-slate-700 dark:hover:bg-slate-600 transition-colors">
            <div class="flex items-start gap-3">
                <span class="material-symbols-outlined text-yellow-400 text-sm mt-0.5">warning</span>
                <div class="flex-1">
                    <p class="text-sm text-slate-100 dark:text-slate-200">Payment reminder</p>
                    <p class="text-xs text-slate-400 dark:text-slate-500">You owe $25.00</p>
                </div>
            </div>
        </a>
    </div>
    <div class="px-4 py-2 border-t border-slate-600 dark:border-slate-700">
        <button @click="open = false" class="text-slate-400 hover:text-slate-300 transition-colors">
            <span class="material-symbols-outlined text-sm">close</span>
        </button>
        <a href="#" class="text-xs text-primary hover:text-primary/80 transition-colors">Mark all as read</a>
    </div>
</div>
</div>

<!-- Profile Dropdown -->
<div class="relative" x-data="{ open: false }">
<button @click="open = !open" class="p-2 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg transition-colors">
<span class="material-symbols-outlined text-slate-700 dark:text-slate-300">account_circle</span>
</button>
<div x-show="open" 
     @click.away="open = false"
     x-transition:enter="transition ease-out duration-200"
     x-transition:enter-start="opacity-0 transform scale-95"
     x-transition:enter-end="opacity-100 transform scale-100"
     x-transition:leave="transition ease-in duration-150"
     x-transition:leave-start="opacity-100 transform scale-100"
     x-transition:leave-end="opacity-0 transform scale-95"
     class="absolute right-0 mt-2 w-48 bg-slate-900 dark:bg-slate-800 rounded-lg shadow-lg border border-slate-600 dark:border-slate-700 py-1 z-[9999]">
    <div class="px-4 py-2 border-b border-slate-600 dark:border-slate-700 flex justify-between items-center">
        <button @click="open = false" class="text-slate-400 hover:text-slate-300 transition-colors">
            <span class="material-symbols-outlined text-sm">close</span>
        </button>
    </div>
    <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-slate-100 dark:text-slate-200 hover:bg-slate-700 dark:hover:bg-slate-600 transition-colors">Dashboard</a>
    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-slate-100 dark:text-slate-200 hover:bg-slate-700 dark:hover:bg-slate-600 transition-colors">Profile</a>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-slate-100 dark:text-slate-200 hover:bg-slate-700 dark:hover:bg-slate-600 transition-colors">Log out</button>
    </form>
</div>
</div>
@else
<a href="{{ route('login') }}" class="text-slate-600 dark:text-slate-400 hover:text-primary dark:hover:text-primary text-sm font-medium transition-colors">Log in</a>
<a href="{{ route('register') }}" class="px-6 py-2 bg-primary hover:bg-primary/90 text-white font-bold rounded-xl transition-all shadow-lg shadow-primary/20">Sign up</a>
@endauth
</div>
</div>
</div>
</header>

<!-- Flash Messages -->
<div class="fixed top-20 right-4 z-50 space-y-2">
    @if(session('success'))
        <div class="bg-green-900/90 dark:bg-green-900/90 border border-green-600 dark:border-green-400 rounded-lg p-4 shadow-lg fade-in">
            <div class="flex items-center">
                <span class="material-symbols-outlined text-green-300 dark:text-green-300 mr-3">check_circle</span>
                <p class="text-sm font-medium text-green-100 dark:text-green-100">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-900/90 dark:bg-red-900/90 border border-red-600 dark:border-red-400 rounded-lg p-4 shadow-lg fade-in">
            <div class="flex items-center">
                <span class="material-symbols-outlined text-red-300 dark:text-red-300 mr-3">error</span>
                <p class="text-sm font-medium text-red-100 dark:text-red-100">{{ session('error') }}</p>
            </div>
        </div>
    @endif
</div>

<!-- Main Content -->
<main class="flex-1">
    @yield('content')
</main>
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@stack('scripts')
</body>
</html>
