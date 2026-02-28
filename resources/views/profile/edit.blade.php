@extends('layouts.app')

@section('title', 'Profil')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <div class="mb-8">
        <h1 class="text-3xl md:text-4xl font-bold text-slate-900 dark:text-slate-100 mb-2">Mon Profil</h1>
        <p class="text-slate-600 dark:text-slate-400">Gérez vos informations personnelles et votre compte</p>
    </div>

    <div class="space-y-8">
        <!-- Profile Information -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl border border-slate-100 dark:border-slate-700 p-8">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-primary rounded-xl flex items-center justify-center mr-4">
                    <span class="material-symbols-outlined text-white text-xl">person</span>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-slate-900 dark:text-slate-100">Informations du profil</h2>
                    <p class="text-slate-600 dark:text-slate-400 text-sm">Mettez à jour vos informations personnelles</p>
                </div>
            </div>
            
            <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                @csrf
                @method('PATCH')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Nom</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 transform -translate-y-1/2 text-slate-400 text-sm">person</span>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                value="{{ old('name', $user->name) }}"
                                class="w-full pl-10 pr-4 py-3 bg-slate-50 dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent text-slate-900 dark:text-slate-100 placeholder-slate-500 dark:placeholder-slate-400 transition-all"
                                required
                            >
                        </div>
                        @error('name')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Email</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 transform -translate-y-1/2 text-slate-400 text-sm">email</span>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                value="{{ old('email', $user->email) }}"
                                class="w-full pl-10 pr-4 py-3 bg-slate-50 dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent text-slate-900 dark:text-slate-100 placeholder-slate-500 dark:placeholder-slate-400 transition-all"
                                required
                            >
                        </div>
                        @error('email')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="flex justify-end">
                    <button type="submit" class="bg-primary hover:bg-primary/90 text-white font-bold py-3 px-6 rounded-xl transition-all shadow-lg shadow-primary/20 flex items-center gap-2">
                        <span class="material-symbols-outlined">save</span>
                        Mettre à jour le profil
                    </button>
                </div>
            </form>
        </div>

        <!-- Password Update -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl border border-slate-100 dark:border-slate-700 p-8">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center mr-4">
                    <span class="material-symbols-outlined text-white text-xl">lock</span>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-slate-900 dark:text-slate-100">Mot de passe</h2>
                    <p class="text-slate-600 dark:text-slate-400 text-sm">Assurez la sécurité de votre compte</p>
                </div>
            </div>
            
            <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Mot de passe actuel</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 transform -translate-y-1/2 text-slate-400 text-sm">lock</span>
                            <input 
                                type="password" 
                                id="current_password" 
                                name="current_password"
                                class="w-full pl-10 pr-12 py-3 bg-slate-50 dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent text-slate-900 dark:text-slate-100 placeholder-slate-500 dark:placeholder-slate-400 transition-all"
                                required
                                x-data="{ show: false }"
                                :type="show ? 'text' : 'password'"
                            >
                            <button 
                                type="button" 
                                @click="show = !show"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-slate-400 hover:text-primary transition-colors"
                            >
                                <span class="material-symbols-outlined text-sm" x-show="!show">visibility</span>
                                <span class="material-symbols-outlined text-sm" x-show="show">visibility_off</span>
                            </button>
                        </div>
                        @error('current_password')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Nouveau mot de passe</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 transform -translate-y-1/2 text-slate-400 text-sm">lock</span>
                            <input 
                                type="password" 
                                id="password" 
                                name="password"
                                class="w-full pl-10 pr-12 py-3 bg-slate-50 dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent text-slate-900 dark:text-slate-100 placeholder-slate-500 dark:placeholder-slate-400 transition-all"
                                required
                                x-data="{ show: false }"
                                :type="show ? 'text' : 'password'"
                            >
                            <button 
                                type="button" 
                                @click="show = !show"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-slate-400 hover:text-primary transition-colors"
                            >
                                <span class="material-symbols-outlined text-sm" x-show="!show">visibility</span>
                                <span class="material-symbols-outlined text-sm" x-show="show">visibility_off</span>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Confirmer le nouveau mot de passe</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 transform -translate-y-1/2 text-slate-400 text-sm">lock</span>
                        <input 
                            type="password" 
                            id="password_confirmation" 
                            name="password_confirmation"
                            class="w-full pl-10 pr-12 py-3 bg-slate-50 dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent text-slate-900 dark:text-slate-100 placeholder-slate-500 dark:placeholder-slate-400 transition-all"
                            required
                            x-data="{ show: false }"
                            :type="show ? 'text' : 'password'"
                        >
                        <button 
                            type="button" 
                            @click="show = !show"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-slate-400 hover:text-primary transition-colors"
                        >
                            <span class="material-symbols-outlined text-sm" x-show="!show">visibility</span>
                            <span class="material-symbols-outlined text-sm" x-show="show">visibility_off</span>
                        </button>
                    </div>
                </div>
                
                <div class="flex justify-end">
                    <button type="submit" class="bg-primary hover:bg-primary/90 text-white font-bold py-3 px-6 rounded-xl transition-all shadow-lg shadow-primary/20 flex items-center gap-2">
                        <span class="material-symbols-outlined">lock_reset</span>
                        Mettre à jour le mot de passe
                    </button>
                </div>
            </form>
        </div>

        <!-- Account Statistics -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl border border-slate-100 dark:border-slate-700 p-8">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-yellow-500 rounded-xl flex items-center justify-center mr-4">
                    <span class="material-symbols-outlined text-white text-xl">insights</span>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-slate-900 dark:text-slate-100">Statistiques du compte</h2>
                    <p class="text-slate-600 dark:text-slate-400 text-sm">Vue d'ensemble de votre activité</p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center p-6 bg-primary/10 rounded-xl border border-primary/20">
                    <div class="text-2xl font-bold text-primary mb-2">{{ $user->reputation ?? 0 }}</div>
                    <div class="text-slate-600 dark:text-slate-400 text-sm">Points de réputation</div>
                </div>
                <div class="text-center p-6 bg-blue-50 dark:bg-blue-900/20 rounded-xl border border-blue-200 dark:border-blue-800">
                    <div class="text-2xl font-bold text-blue-600 dark:text-blue-400 mb-2">{{ $user->created_at->diffForHumans() }}</div>
                    <div class="text-slate-600 dark:text-slate-400 text-sm">Membre depuis</div>
                </div>
                <div class="text-center p-6 bg-green-50 dark:bg-green-900/20 rounded-xl border border-green-200 dark:border-green-800">
                    <div class="text-2xl font-bold text-green-600 dark:text-green-400 mb-2">{{ $user->email }}</div>
                    <div class="text-slate-600 dark:text-slate-400 text-sm">Email vérifié</div>
                </div>
            </div>
        </div>

        <!-- Delete Account -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl border border-red-200 dark:border-red-800 p-8">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-red-500 rounded-xl flex items-center justify-center mr-4">
                    <span class="material-symbols-outlined text-white text-xl">warning</span>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-slate-900 dark:text-slate-100">Supprimer le compte</h2>
                    <p class="text-slate-600 dark:text-slate-400 text-sm">Attention : cette action est irréversible</p>
                </div>
            </div>
            
            <p class="text-slate-700 dark:text-slate-300 mb-6">
                La suppression de votre compte supprimera définitivement toutes vos données. 
                Cette action ne peut pas être annulée.
            </p>
            
            <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-xl transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined">delete_forever</span>
                    Supprimer mon compte
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
