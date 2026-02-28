<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>EasyColoc - Your Trusted Colocation Partner</title>
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
<a class="flex items-center gap-2 group" href="#">
<div class="bg-primary p-1.5 rounded-lg text-white">
<span class="material-symbols-outlined block text-2xl">home</span>
</div>
<h2 class="text-slate-900 dark:text-slate-100 text-xl font-bold tracking-tight">EasyColoc</h2>
</a>
<nav class="hidden md:flex items-center gap-6">
<a class="text-slate-600 dark:text-slate-400 hover:text-primary dark:hover:text-primary text-sm font-medium transition-colors" href="#features">Features</a>
<a class="text-slate-600 dark:text-slate-400 hover:text-primary dark:hover:text-primary text-sm font-medium transition-colors" href="#how-it-works">How It Works</a>
<a class="text-slate-600 dark:text-slate-400 hover:text-primary dark:hover:text-primary text-sm font-medium transition-colors" href="#pricing">Pricing</a>
<a class="text-slate-600 dark:text-slate-400 hover:text-primary dark:hover:text-primary text-sm font-medium transition-colors" href="#testimonials">Reviews</a>
</nav>
</div>
<div class="flex items-center gap-4">
<div class="hidden lg:flex items-center bg-slate-100 dark:bg-slate-800 rounded-lg px-3 py-1.5 w-64 border border-transparent focus-within:border-primary/50 transition-all">
<span class="material-symbols-outlined text-slate-400 text-xl">search</span>
<input class="bg-transparent border-none focus:ring-0 text-sm w-full placeholder:text-slate-400" placeholder="Search features..." type="text"/>
</div>
<div class="flex items-center gap-2">
@auth
<button class="p-2 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg transition-colors relative">
<span class="material-symbols-outlined text-slate-700 dark:text-slate-300">notifications</span>
<span class="absolute top-1 right-1 bg-primary text-[10px] text-white font-bold px-1 rounded-full">3</span>
</button>
<button class="p-2 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg transition-colors">
<span class="material-symbols-outlined text-slate-700 dark:text-slate-300">account_circle</span>
</button>
@else
<a href="{{ route('login') }}" class="text-slate-600 dark:text-slate-400 hover:text-primary dark:hover:text-primary text-sm font-medium transition-colors">Log in</a>
<a href="{{ route('register') }}" class="px-6 py-2 bg-primary hover:bg-primary/90 text-white font-bold rounded-xl transition-all shadow-lg shadow-primary/20">Sign up</a>
@endauth
</div>
</div>
</div>
</div>
</header>
<main class="flex-1">
<!-- Hero Section -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-20">
<div class="grid lg:grid-cols-2 gap-12 items-center">
<div class="space-y-8">
<div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/10 text-primary text-sm font-semibold uppercase tracking-wider">
<span class="material-symbols-outlined text-sm">verified_user</span>
                            Colocation Certified
                        </div>
<h1 class="text-slate-900 dark:text-slate-100 text-5xl lg:text-6xl font-black leading-[1.1] tracking-tight">
                            Your Trusted Partner in <span class="text-primary">Shared Living</span> Management
                        </h1>
<p class="text-slate-600 dark:text-slate-400 text-lg leading-relaxed max-w-lg">
                            Discover a seamless way to manage your colocation. Track expenses, split bills, and maintain harmony with your roommates.
                        </p>
<div class="flex flex-wrap gap-4">
<a href="{{ route('register') }}" class="px-8 py-4 bg-primary hover:bg-primary/90 text-white font-bold rounded-xl transition-all shadow-lg shadow-primary/20">
                                Get Started
                            </a>
<a href="#how-it-works" class="px-8 py-4 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:border-primary text-slate-700 dark:text-slate-200 font-bold rounded-xl transition-all">
                                Learn More
                            </a>
</div>
<div class="flex items-center gap-6 pt-4">
<div class="flex -space-x-3">
<div class="w-10 h-10 rounded-full border-2 border-white bg-slate-200 bg-cover" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuABdBdf48nRJbhRxRbPA_s9htaA_sLU7wtZyJMpASLZN4Wy98WXP-kcR0R8doQmjMM-UfDRDZzqbGbm4u6SUwO_bWFKAYpHSKcgle0hheFTgRZdoNp-UU1wm2YNU9WOC-q-yV_xSTkvNfSnjotIM-XzKmjIqxl83RhrLzyrnF66lTFfQPj9dX04r4PRUP1omoq6Q6lnmznf9F2kmRdISxmwAjkH6iJ3v_4g3ZEysH8e-jF6qH-3Odvr48rMfZpijjkRz5XEs38I6Kub')"></div>
<div class="w-10 h-10 rounded-full border-2 border-white bg-slate-300 bg-cover" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuC2h-DycpUoW8gYA3pLET5vGQzHDm_zoYwh8Wb3Z3m_YcMuXHK6yFcI9jks2dGqvnX9l1NfbjGJ336OPi2oP3a2y_dcDpH5K7MdxBhqffeJCPdKXJzJ595KOQ3zFD3RSIgXl3JP1AcQOnzeETL6OqY_hfLTI65KdLSI8jIFEXWQe-Ob-dyPUwWD8GKMAlE9tXf_RhN47CeSZA3dBDmoTqJsQbhvfWGCYAY_nhVzxxA-vmt-h3QOvUuVpYd4JXgt6kUGUEs0souQ2l6M')"></div>
<div class="w-10 h-10 rounded-full border-2 border-white bg-slate-400 bg-cover" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuA2Y70B0v50MBciq8Nd-tOy6NGzne1wruyZm82NKVp3k1zBf39Du0WQ_0vW7mTEmoDFRQW19gdBSDN_uBAq3upvBkU8qojsxdakEwAJvy_vacEYFI1ldURW83xDKaiiEk8Msg7q3veM6w6ZohVQpCMLh_p2Klt2o_qK7djAN4dKNfwrLq1C767SJHR9gYmnFdXxkm4NMYryJrXrGRlSnML_galTP6SHsfc9XDM_53p6Hch5VkmvgwaeaRa5m0MP05ML2c4qQkeyc-kb')"></div>
</div>
<p class="text-sm text-slate-500 dark:text-slate-400">
                                Joined by <span class="font-bold text-slate-900 dark:text-slate-100">10k+</span> happy roommates
                            </p>
</div>
</div>
<div class="relative">
<div class="absolute -inset-4 bg-primary/10 rounded-[2.5rem] rotate-3 -z-10"></div>
<div class="aspect-square bg-slate-100 rounded-[2rem] overflow-hidden shadow-2xl bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80')"></div>
</div>
</div>
</section>
<!-- Categories Banner -->
<section class="bg-white dark:bg-slate-900 border-y border-slate-100 dark:border-slate-800 py-10">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 overflow-x-auto">
<div class="flex justify-between items-center gap-12 min-w-max">
<div class="flex items-center gap-3 grayscale opacity-50 hover:grayscale-0 hover:opacity-100 transition-all cursor-pointer">
<span class="material-symbols-outlined text-4xl text-primary">receipt_long</span>
<span class="font-bold uppercase tracking-tighter text-slate-900 dark:text-slate-100">Smart Bills</span>
</div>
<div class="flex items-center gap-3 grayscale opacity-50 hover:grayscale-0 hover:opacity-100 transition-all cursor-pointer">
<span class="material-symbols-outlined text-4xl text-primary">group</span>
<span class="font-bold uppercase tracking-tighter text-slate-900 dark:text-slate-100">Easy Split</span>
</div>
<div class="flex items-center gap-3 grayscale opacity-50 hover:grayscale-0 hover:opacity-100 transition-all cursor-pointer">
<span class="material-symbols-outlined text-4xl text-primary">insights</span>
<span class="font-bold uppercase tracking-tighter text-slate-900 dark:text-slate-100">Smart Stats</span>
</div>
<div class="flex items-center gap-3 grayscale opacity-50 hover:grayscale-0 hover:opacity-100 transition-all cursor-pointer">
<span class="material-symbols-outlined text-4xl text-primary">notifications</span>
<span class="font-bold uppercase tracking-tighter text-slate-900 dark:text-slate-100">Alerts</span>
</div>
</div>
</div>
</section>
<!-- Best Features -->
<section id="features" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
<div class="flex justify-between items-end mb-12">
<div class="space-y-2">
<h2 class="text-3xl font-bold text-slate-900 dark:text-slate-100">Best Features</h2>
<p class="text-slate-500">Most loved features by our community</p>
</div>
<a class="text-primary font-semibold hover:underline flex items-center gap-1" href="#how-it-works">
                        Learn More <span class="material-symbols-outlined text-sm">arrow_forward</span>
</a>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
<!-- Feature 1 -->
<div class="group cursor-pointer">
<div class="relative aspect-[4/5] bg-slate-50 dark:bg-slate-800 rounded-2xl overflow-hidden mb-4 p-4 transition-all group-hover:shadow-xl border border-transparent group-hover:border-primary/20">
<div class="absolute top-4 right-4 z-10">
<button class="w-10 h-10 rounded-full bg-white/80 dark:bg-slate-700/80 backdrop-blur shadow-sm flex items-center justify-center text-slate-400 hover:text-primary transition-colors">
<span class="material-symbols-outlined">favorite</span>
</button>
</div>
<div class="w-full h-full flex items-center justify-center">
<span class="material-symbols-outlined text-6xl text-primary">receipt_long</span>
</div>
<button class="absolute bottom-4 left-4 right-4 bg-primary text-white py-3 rounded-xl font-bold opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all">
                                Try Now
                            </button>
</div>
<div class="space-y-1">
<p class="text-xs text-slate-400 uppercase font-bold tracking-widest">Management</p>
<h3 class="font-bold text-slate-900 dark:text-slate-100 group-hover:text-primary transition-colors">Bill Tracking</h3>
<div class="flex items-center gap-2">
<span class="text-primary font-black text-lg">Free</span>
<span class="text-slate-400 text-sm">Forever</span>
</div>
</div>
</div>
<!-- Feature 2 -->
<div class="group cursor-pointer">
<div class="relative aspect-[4/5] bg-slate-50 dark:bg-slate-800 rounded-2xl overflow-hidden mb-4 p-4 transition-all group-hover:shadow-xl border border-transparent group-hover:border-primary/20">
<div class="absolute top-4 right-4 z-10">
<button class="w-10 h-10 rounded-full bg-white/80 dark:bg-slate-700/80 backdrop-blur shadow-sm flex items-center justify-center text-slate-400 hover:text-primary transition-colors">
<span class="material-symbols-outlined">favorite</span>
</button>
</div>
<div class="w-full h-full flex items-center justify-center">
<span class="material-symbols-outlined text-6xl text-primary">calculate</span>
</div>
<button class="absolute bottom-4 left-4 right-4 bg-primary text-white py-3 rounded-xl font-bold opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all">
                                Try Now
                            </button>
</div>
<div class="space-y-1">
<p class="text-xs text-slate-400 uppercase font-bold tracking-widest">Finance</p>
<h3 class="font-bold text-slate-900 dark:text-slate-100 group-hover:text-primary transition-colors">Smart Split</h3>
<div class="flex items-center gap-2">
<span class="text-primary font-black text-lg">Free</span>
<span class="text-slate-400 text-sm">Forever</span>
</div>
</div>
</div>
<!-- Feature 3 -->
<div class="group cursor-pointer">
<div class="relative aspect-[4/5] bg-slate-50 dark:bg-slate-800 rounded-2xl overflow-hidden mb-4 p-4 transition-all group-hover:shadow-xl border border-transparent group-hover:border-primary/20">
<div class="absolute top-4 right-4 z-10">
<button class="w-10 h-10 rounded-full bg-white/80 dark:bg-slate-700/80 backdrop-blur shadow-sm flex items-center justify-center text-slate-400 hover:text-primary transition-colors">
<span class="material-symbols-outlined">favorite</span>
</button>
</div>
<div class="w-full h-full flex items-center justify-center">
<span class="material-symbols-outlined text-6xl text-primary">chat</span>
</div>
<button class="absolute bottom-4 left-4 right-4 bg-primary text-white py-3 rounded-xl font-bold opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all">
                                Try Now
                            </button>
</div>
<div class="space-y-1">
<p class="text-xs text-slate-400 uppercase font-bold tracking-widest">Communication</p>
<h3 class="font-bold text-slate-900 dark:text-slate-100 group-hover:text-primary transition-colors">Room Chat</h3>
<div class="flex items-center gap-2">
<span class="text-primary font-black text-lg">Free</span>
<span class="text-slate-400 text-sm">Forever</span>
</div>
</div>
</div>
<!-- Feature 4 -->
<div class="group cursor-pointer">
<div class="relative aspect-[4/5] bg-slate-50 dark:bg-slate-800 rounded-2xl overflow-hidden mb-4 p-4 transition-all group-hover:shadow-xl border border-transparent group-hover:border-primary/20">
<div class="absolute top-4 right-4 z-10">
<button class="w-10 h-10 rounded-full bg-white/80 dark:bg-slate-700/80 backdrop-blur shadow-sm flex items-center justify-center text-slate-400 hover:text-primary transition-colors">
<span class="material-symbols-outlined">favorite</span>
</button>
</div>
<div class="w-full h-full flex items-center justify-center">
<span class="material-symbols-outlined text-6xl text-primary">calendar_month</span>
</div>
<button class="absolute bottom-4 left-4 right-4 bg-primary text-white py-3 rounded-xl font-bold opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all">
                                Try Now
                            </button>
</div>
<div class="space-y-1">
<p class="text-xs text-slate-400 uppercase font-bold tracking-widest">Planning</p>
<h3 class="font-bold text-slate-900 dark:text-slate-100 group-hover:text-primary transition-colors">Schedule</h3>
<div class="flex items-center gap-2">
<span class="text-primary font-black text-lg">Free</span>
<span class="text-slate-400 text-sm">Forever</span>
</div>
</div>
</div>
</div>
</section>
<!-- Promo Banner -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
<div class="relative bg-primary dark:bg-primary/90 rounded-[2.5rem] overflow-hidden p-8 lg:p-20 shadow-2xl shadow-primary/30">
<div class="absolute top-0 right-0 w-1/3 h-full opacity-20 pointer-events-none">
<span class="material-symbols-outlined text-[20rem] absolute -right-20 -top-20">home_work</span>
</div>
<div class="relative z-10 max-w-2xl text-white">
<h2 class="text-3xl lg:text-5xl font-black mb-6 leading-tight">Limited Time Offer: Start Free Today</h2>
<p class="text-lg lg:text-xl text-white/90 mb-10 leading-relaxed">
                            Upgrade your colocation experience with professional-grade management. Use code <span class="bg-white/20 px-2 py-1 rounded font-mono font-bold">COLOC20</span> for premium features.
                        </p>
<a href="{{ route('register') }}" class="bg-white text-primary px-10 py-4 rounded-xl font-bold text-lg hover:bg-slate-50 transition-colors">
                            Get Started Now
                        </a>
</div>
</div>
</section>
<!-- How It Works -->
<section id="how-it-works" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
<div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
<h2 class="text-3xl font-bold text-slate-900 dark:text-slate-100">How It Works</h2>
<p class="text-slate-500">Simple steps to perfect colocation management</p>
</div>
<div class="grid md:grid-cols-3 gap-8">
<div class="bg-white dark:bg-slate-800 p-8 rounded-3xl border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-lg transition-all">
<div class="flex gap-1 text-primary mb-6">
<span class="material-symbols-outlined">star</span>
<span class="material-symbols-outlined">star</span>
<span class="material-symbols-outlined">star</span>
<span class="material-symbols-outlined">star</span>
<span class="material-symbols-outlined">star</span>
</div>
<p class="text-slate-600 dark:text-slate-300 italic mb-8">"EasyColoc has transformed how we manage our shared apartment. No more arguments about bills!"</p>
<div class="flex items-center gap-4">
<div class="w-12 h-12 rounded-full bg-cover" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuD6P-SqvjsUWNZhu48DgPWjrIkOfhf2x479eJq07-fkoH5I_3Hjcrp8MHVbiXeS5DGivc1pOVhARmTm_cHDKpaDanZVqS9w_KQ3qPh0o9CGeatyh7jXTBYd-rICzCizqdaUMUHcMx217nF_6MjCSwFCZdNHtdljdyOXmYeb5x06dISKCTfPQzF9toGfovso3Y0hFVAb61Usu9uq7jyxnre1i7wXkV1mFRPndAShyzGwXG04YPnMi0wZlfSjC9nReQTvkx0OtvIGhIIg')"></div>
<div>
<h4 class="font-bold text-slate-900 dark:text-slate-100">Marie Dubois</h4>
<p class="text-xs text-slate-400">Student, Paris</p>
</div>
</div>
</div>
<div class="bg-white dark:bg-slate-800 p-8 rounded-3xl border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-lg transition-all">
<div class="flex gap-1 text-primary mb-6">
<span class="material-symbols-outlined">star</span>
<span class="material-symbols-outlined">star</span>
<span class="material-symbols-outlined">star</span>
<span class="material-symbols-outlined">star</span>
<span class="material-symbols-outlined">star</span>
</div>
<p class="text-slate-600 dark:text-slate-300 italic mb-8">"Finally an app that actually understands colocation needs. The expense splitting is perfect!"</p>
<div class="flex items-center gap-4">
<div class="w-12 h-12 rounded-full bg-cover" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDXEPJchuG9d_xr5NpsMU49zOk3bTOah-DpzndrUW9dfW4wVq9amSw3yW9claK6KfpulLgaTj74qsuIBibBHSLtF6VBvRhWchDwv8Jd-XoARAVcghXzbLfffQNC6BCIcc9f-5VNb4wmsjvtTxEKqWKfCPrUkAr8D5lw8PtguTGM5_begvWtLf0WAY9TFefhrXhiukz5DB8lme8sqR7Jj9dKmhhMstUqixFv0wzMdYKAZkt9rAt62j0BNCXHHMI7gxOwumEpO70298bz')"></div>
<div>
<h4 class="font-bold text-slate-900 dark:text-slate-100">Lucas Martin</h4>
<p class="text-xs text-slate-400">Young Professional</p>
</div>
</div>
</div>
<div class="bg-white dark:bg-slate-800 p-8 rounded-3xl border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-lg transition-all">
<div class="flex gap-1 text-primary mb-6">
<span class="material-symbols-outlined">star</span>
<span class="material-symbols-outlined">star</span>
<span class="material-symbols-outlined">star</span>
<span class="material-symbols-outlined">star</span>
<span class="material-symbols-outlined">star_half</span>
</div>
<p class="text-slate-600 dark:text-slate-300 italic mb-8">"The scheduling feature alone is worth it. We never miss cleaning days anymore!"</p>
<div class="flex items-center gap-4">
<div class="w-12 h-12 rounded-full bg-cover" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuC_KqPE632uki-dOApHFX3ml0hym6mkCsLnWW9eIUFuCOQ_hrX8FelnOr-QsmBCiVpup5vNVNz0EiqJapR50dVqKiUBkRPK6Yjd_eIkoufJGu1UIwZXgThMduSBE1cb59LX8lt1aFzxqtF9MM0_iq0IFfAg3MdvxQigePdvPkEGrr9dm9UJFKFI9z1aRcZ7YgDdSPEKgftUKYHLqOAnWxzb9RLbg-I3pzxvyYhauqvs4ZuqOzkNjpNAN07X7ucSPDjnpl7aBjjfxoiq')"></div>
<div>
<h4 class="font-bold text-slate-900 dark:text-slate-100">Sophie Laurent</h4>
<p class="text-xs text-slate-400">Digital Nomad</p>
</div>
</div>
</div>
</div>
</section>
</main>
<!-- Footer -->
<footer class="bg-white dark:bg-background-dark border-t border-slate-200 dark:border-slate-800 pt-20 pb-10">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
<div class="space-y-6">
<a class="flex items-center gap-2" href="#">
<div class="bg-primary p-1.5 rounded-lg text-white">
<span class="material-symbols-outlined block text-2xl">home</span>
</div>
<h2 class="text-slate-900 dark:text-slate-100 text-xl font-bold tracking-tight">EasyColoc</h2>
</a>
<p class="text-slate-500 text-sm leading-relaxed">
                            Your leading colocation management platform for seamless shared living.
                        </p>
<div class="flex gap-4">
<a class="w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-600 dark:text-slate-400 hover:bg-primary hover:text-white transition-all" href="#">
<span class="material-symbols-outlined text-xl">share</span>
</a>
<a class="w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-600 dark:text-slate-400 hover:bg-primary hover:text-white transition-all" href="#">
<span class="material-symbols-outlined text-xl">public</span>
</a>
<a class="w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-600 dark:text-slate-400 hover:bg-primary hover:text-white transition-all" href="#">
<span class="material-symbols-outlined text-xl">alternate_email</span>
</a>
</div>
</div>
<div>
<h4 class="font-bold text-slate-900 dark:text-slate-100 mb-6 uppercase tracking-wider text-xs">Features</h4>
<ul class="space-y-4">
<li><a class="text-slate-500 hover:text-primary transition-colors text-sm" href="#features">Bill Tracking</a></li>
<li><a class="text-slate-500 hover:text-primary transition-colors text-sm" href="#how-it-works">Smart Split</a></li>
<li><a class="text-slate-500 hover:text-primary transition-colors text-sm" href="#pricing">Pricing</a></li>
<li><a class="text-slate-500 hover:text-primary transition-colors text-sm" href="#testimonials">Reviews</a></li>
<li><a class="text-slate-500 hover:text-primary transition-colors text-sm" href="{{ route('login') }}">Login</a></li>
</ul>
</div>
<div>
<h4 class="font-bold text-slate-900 dark:text-slate-100 mb-6 uppercase tracking-wider text-xs">Support</h4>
<ul class="space-y-4">
<li><a class="text-slate-500 hover:text-primary transition-colors text-sm" href="#">Help Center</a></li>
<li><a class="text-slate-500 hover:text-primary transition-colors text-sm" href="#">Contact Us</a></li>
<li><a class="text-slate-500 hover:text-primary transition-colors text-sm" href="#">Privacy Policy</a></li>
<li><a class="text-slate-500 hover:text-primary transition-colors text-sm" href="#">Terms of Service</a></li>
<li><a class="text-slate-500 hover:text-primary transition-colors text-sm" href="#">FAQ</a></li>
</ul>
</div>
<div>
<h4 class="font-bold text-slate-900 dark:text-slate-100 mb-6 uppercase tracking-wider text-xs">Stay Updated</h4>
<p class="text-sm text-slate-500 mb-4">Get tips for better colocation living and exclusive offers.</p>
<form class="space-y-3">
<input class="w-full bg-slate-100 dark:bg-slate-800 border-none rounded-xl focus:ring-primary text-sm p-4" placeholder="Email address" type="email"/>
<button class="w-full bg-primary text-white font-bold py-4 rounded-xl shadow-lg shadow-primary/20">Subscribe</button>
</form>
</div>
</div>
<div class="pt-8 border-t border-slate-100 dark:border-slate-800 flex flex-col md:flex-row justify-between items-center gap-6">
<p class="text-slate-400 text-sm"> 2024 EasyColoc. All rights reserved.</p>
<div class="flex gap-6">
<span class="material-symbols-outlined text-3xl text-slate-300">payments</span>
<span class="material-symbols-outlined text-3xl text-slate-300">credit_card</span>
<span class="material-symbols-outlined text-3xl text-slate-300">account_balance_wallet</span>
</div>
</div>
</div>
</footer>
</div>
</body>
</html>
