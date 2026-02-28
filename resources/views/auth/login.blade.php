<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Sign In | EasyColoc</title>
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
        body {
            font-family: 'Inter', sans-serif;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 font-display">
<div class="relative flex min-h-screen w-full flex-col overflow-x-hidden">
<div class="flex h-full grow flex-col">
<!-- Top Navigation Bar -->
<header class="flex items-center justify-between border-b border-primary/10 bg-white dark:bg-background-dark px-6 md:px-10 py-4 sticky top-0 z-50">
<div class="flex items-center gap-8">
<div class="flex items-center gap-3">
<div class="bg-primary p-1.5 rounded-lg text-white">
<span class="material-symbols-outlined block text-2xl">home</span>
</div>
<h1 class="text-slate-900 dark:text-slate-100 text-xl font-bold tracking-tight">EasyColoc</h1>
</div>
<nav class="hidden lg:flex items-center gap-6">
<a class="text-slate-600 dark:text-slate-400 text-sm font-medium hover:text-primary transition-colors" href="#features">Features</a>
<a class="text-slate-600 dark:text-slate-400 text-sm font-medium hover:text-primary transition-colors" href="#how-it-works">How It Works</a>
<a class="text-slate-600 dark:text-slate-400 text-sm font-medium hover:text-primary transition-colors" href="#pricing">Pricing</a>
<a class="text-slate-600 dark:text-slate-400 text-sm font-medium hover:text-primary transition-colors" href="#testimonials">Reviews</a>
</nav>
</div>
<div class="flex items-center gap-4">
<div class="hidden md:flex items-center bg-slate-100 dark:bg-slate-800 rounded-lg px-3 py-1.5">
<span class="material-symbols-outlined text-slate-400 text-xl">search</span>
<input class="bg-transparent border-none focus:ring-0 text-sm w-48 placeholder:text-slate-400" placeholder="Search features..." type="text"/>
</div>
<a href="{{ route('register') }}" class="flex items-center justify-center rounded-lg h-10 px-5 bg-primary text-slate-900 text-sm font-bold transition-transform hover:scale-105 active:scale-95">
                        Sign Up
                    </a>
</div>
</header>
<main class="flex-1 flex items-center justify-center p-6 md:p-12">
<div class="w-full max-w-[1000px] grid md:grid-cols-2 bg-white dark:bg-slate-900 rounded-xl overflow-hidden shadow-2xl shadow-primary/5">
<!-- Left Side: Branding/Visual -->
<div class="hidden md:flex flex-col justify-between p-12 bg-primary/10 relative overflow-hidden">
<div class="z-10">
<h2 class="text-4xl font-black leading-tight tracking-tight text-slate-900 dark:text-white mb-6">
                                Your trusted partner in <span class="text-primary">Colocation.</span>
</h2>
<p class="text-slate-600 dark:text-slate-300 text-lg leading-relaxed">
                                Join our community today and get exclusive access to professional colocation management tools and premium features.
                            </p>
</div>
<div class="z-10 space-y-6">
<div class="flex items-center gap-4">
<div class="bg-white dark:bg-slate-800 p-2 rounded-lg shadow-sm">
<span class="material-symbols-outlined text-primary">verified</span>
</div>
<span class="font-medium">100% Secure Platform</span>
</div>
<div class="flex items-center gap-4">
<div class="bg-white dark:bg-slate-800 p-2 rounded-lg shadow-sm">
<span class="material-symbols-outlined text-primary">group</span>
</div>
<span class="font-medium">Smart Expense Splitting</span>
</div>
</div>
<!-- Abstract Background Decoration -->
<div class="absolute -bottom-24 -right-24 w-64 h-64 bg-primary/20 rounded-full blur-3xl"></div>
<div class="absolute -top-12 -left-12 w-48 h-48 bg-primary/10 rounded-full blur-2xl"></div>
</div>
<!-- Right Side: Form -->
<div class="p-8 md:p-12">
<div class="mb-8">
<h3 class="text-2xl font-bold text-slate-900 dark:text-white">Sign In</h3>
<p class="text-slate-500 dark:text-slate-400 mt-1">Access your colocation dashboard</p>
</div>
<form method="POST" action="{{ route('login') }}" class="space-y-5">
    @csrf
<div class="space-y-2">
<label class="text-sm font-semibold text-slate-700 dark:text-slate-300 ml-1">Email Address</label>
<div class="relative group">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors">mail</span>
<input 
    name="email"
    value="{{ old('email') }}"
    class="w-full pl-10 pr-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all placeholder:text-slate-400" 
    placeholder="john@example.com" 
    type="email"
    required
    autocomplete="email"
>
</div>
@error('email')
    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
@enderror
</div>
<div class="space-y-2">
<label class="text-sm font-semibold text-slate-700 dark:text-slate-300 ml-1">Password</label>
<div class="relative group">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors">lock</span>
<input 
    name="password"
    class="w-full pl-10 pr-10 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all placeholder:text-slate-400" 
    placeholder="••••••••" 
    type="password"
    required
    autocomplete="current-password"
    x-data="{ show: false }"
    :type="show ? 'text' : 'password'"
>
<button class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600" type="button" @click="show = !show">
<span class="material-symbols-outlined text-sm" x-show="!show">visibility</span>
<span class="material-symbols-outlined text-sm" x-show="show">visibility_off</span>
</button>
</div>
@error('password')
    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
@enderror
</div>
<div class="space-y-3 pt-2">
<label class="flex items-start gap-3 cursor-pointer group">
<div class="relative flex items-center mt-1">
<input name="remember" class="peer h-5 w-5 rounded border-slate-300 dark:border-slate-600 text-primary focus:ring-primary bg-white dark:bg-slate-800" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
</div>
<span class="text-sm text-slate-600 dark:text-slate-400 leading-tight">
                                        Keep me logged in
                                    </span>
</label>
<label class="flex items-start gap-3 cursor-pointer group">
<div class="relative flex items-center mt-1">
<input name="newsletter" class="peer h-5 w-5 rounded border-slate-300 dark:border-slate-600 text-primary focus:ring-primary bg-white dark:bg-slate-800" type="checkbox" checked>
</div>
<span class="text-sm text-slate-600 dark:text-slate-400 leading-tight">
                                        Subscribe to our newsletter for colocation tips and special offers.
                                    </span>
</label>
</div>
<button type="submit" class="w-full py-4 bg-primary text-slate-900 font-bold rounded-lg shadow-lg shadow-primary/20 hover:shadow-primary/30 transition-all hover:-translate-y-0.5 active:translate-y-0 mt-4">
                                Sign In
                            </button>
<div class="text-center mt-6">
<p class="text-slate-500 dark:text-slate-400 text-sm">
                                    New to EasyColoc? 
                                    <a href="{{ route('register') }}" class="text-primary font-bold hover:underline">Create an account</a>
</p>
</div>
</form>
</div>
</div>
</main>
<!-- Simple Footer -->
<footer class="py-8 px-10 border-t border-primary/10 flex flex-col md:flex-row justify-between items-center gap-4 bg-white dark:bg-background-dark">
<p class="text-slate-500 text-sm">© 2024 EasyColoc. All rights reserved.</p>
<div class="flex gap-6">
<a class="text-slate-500 hover:text-primary transition-colors text-sm" href="#">Help Center</a>
<a class="text-slate-500 hover:text-primary transition-colors text-sm" href="#">Contact Support</a>
<a class="text-slate-500 hover:text-primary transition-colors text-sm" href="#">Privacy</a>
</div>
</footer>
</div>
</div>
</body>
</html>
