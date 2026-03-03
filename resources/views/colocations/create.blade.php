@extends('layouts.app')

@section('title', 'Créer une Colocation')

@section('content')
<div class="min-h-screen bg-background-light dark:bg-background-dark">
    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-gradient-to-br from-primary/20 to-primary/5 dark:from-primary/10 dark:to-primary/5">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-24 -right-24 w-64 h-64 bg-primary/20 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-12 -left-12 w-48 h-48 bg-primary/10 rounded-full blur-2xl"></div>
        </div>
        <div class="relative max-w-7xl mx-auto px-6 md:px-10 py-16">
            <div class="flex flex-col lg:flex-row justify-between items-center gap-8">
                <div class="text-center lg:text-left">
                    <h1 class="text-4xl md:text-5xl font-black tracking-tight text-slate-900 dark:text-white mb-4">
                        Créer une <span class="text-primary">Colocation</span>
                    </h1>
                    <p class="text-lg md:text-xl text-slate-600 dark:text-slate-300 leading-relaxed">
                        Démarrez la gestion de vos dépenses partagées
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-6 md:px-10 py-12">
        <!-- Form Card -->
        <div class="bg-white dark:bg-slate-900 rounded-xl overflow-hidden shadow-2xl shadow-primary/5">
            <div class="p-8 md:p-12">
                @if($errors->any())
                    <div class="bg-red-900/90 dark:bg-red-900/90 border border-red-600 dark:border-red-400 rounded-lg p-4 mb-6">
                        <div class="flex items-center">
                            <span class="material-symbols-outlined text-red-300 mr-3">error</span>
                            <div>
                                <h3 class="text-red-100 font-semibold">Erreurs de validation</h3>
                                <ul class="list-disc list-inside text-red-200 text-sm mt-1">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('colocations.store') }}" method="POST" class="space-y-8">
                    @csrf
                    
                    <div>
                        <label for="name" class="block text-sm font-bold text-slate-900 dark:text-slate-100 mb-3">
                            <span class="material-symbols-outlined text-primary mr-2">home</span>
                            Nom de la colocation
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required
                               class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 text-slate-900 dark:text-slate-100 placeholder:text-slate-400"
                               placeholder="Ex: Appartement Paris 15ème">
                        @error('name')
                            <p class="mt-2 text-sm text-red-400 flex items-center">
                                <span class="material-symbols-outlined text-xs mr-1">error</span> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Features Preview -->
                    <div class="bg-gradient-to-r from-primary/10 to-primary/5 dark:from-primary/5 dark:to-primary/10 rounded-xl p-6 border border-primary/20">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">
                            <span class="material-symbols-outlined text-primary mr-2">star</span>
                            Ce que vous obtenez
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-primary/20 rounded-full flex items-center justify-center">
                                    <span class="material-symbols-outlined text-primary text-sm">check</span>
                                </div>
                                <span class="text-sm text-slate-700 dark:text-slate-300">Suivi des dépenses partagées</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-primary/20 rounded-full flex items-center justify-center">
                                    <span class="material-symbols-outlined text-primary text-sm">check</span>
                                </div>
                                <span class="text-sm text-slate-700 dark:text-slate-300">Calcul automatique des soldes</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-primary/20 rounded-full flex items-center justify-center">
                                    <span class="material-symbols-outlined text-primary text-sm">check</span>
                                </div>
                                <span class="text-sm text-slate-700 dark:text-slate-300">Invitation de membres</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-primary/20 rounded-full flex items-center justify-center">
                                    <span class="material-symbols-outlined text-primary text-sm">check</span>
                                </div>
                                <span class="text-sm text-slate-700 dark:text-slate-300">Système de réputation</span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-between pt-6 border-t border-slate-200 dark:border-slate-700">
                        <a href="{{ route('colocations.index') }}" 
                           class="flex items-center space-x-2 text-slate-600 dark:text-slate-400 hover:text-primary dark:hover:text-primary transition-colors duration-300">
                            <span class="material-symbols-outlined">arrow_back</span>
                            <span>Retour aux colocations</span>
                        </a>
                        <button type="submit" class="flex items-center justify-center rounded-lg h-12 px-8 bg-primary text-slate-900 font-bold transition-transform hover:scale-105 active:scale-95 shadow-lg shadow-primary/20">
                            <span class="material-symbols-outlined mr-2">rocket_launch</span>
                            Créer la colocation
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Info Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
            <div class="bg-white dark:bg-slate-900 rounded-xl overflow-hidden shadow-xl shadow-slate-200/50 dark:shadow-none border border-slate-100 dark:border-slate-800 hover:shadow-primary/10 transition-all">
                <div class="p-6">
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/20 rounded-full flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-blue-600 dark:text-blue-400 text-xl">group</span>
                    </div>
                    <h3 class="font-bold text-slate-900 dark:text-white mb-2">Multi-utilisateurs</h3>
                    <p class="text-sm text-slate-600 dark:text-slate-400">Invitez jusqu'à 10 membres pour gérer ensemble vos dépenses.</p>
                </div>
            </div>
            
            <div class="bg-white dark:bg-slate-900 rounded-xl overflow-hidden shadow-xl shadow-slate-200/50 dark:shadow-none border border-slate-100 dark:border-slate-800 hover:shadow-primary/10 transition-all">
                <div class="p-6">
                    <div class="w-12 h-12 bg-green-100 dark:bg-green-900/20 rounded-full flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-green-600 dark:text-green-400 text-xl">calculate</span>
                    </div>
                    <h3 class="font-bold text-slate-900 dark:text-white mb-2">Calcul intelligent</h3>
                    <p class="text-sm text-slate-600 dark:text-slate-400">Répartition automatique et équitable des dépenses entre tous les membres.</p>
                </div>
            </div>
            
            <div class="bg-white dark:bg-slate-900 rounded-xl overflow-hidden shadow-xl shadow-slate-200/50 dark:shadow-none border border-slate-100 dark:border-slate-800 hover:shadow-primary/10 transition-all">
                <div class="p-6">
                    <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/20 rounded-full flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-purple-600 dark:text-purple-400 text-xl">shield</span>
                    </div>
                    <h3 class="font-bold text-slate-900 dark:text-white mb-2">Sécurisé</h3>
                    <p class="text-sm text-slate-600 dark:text-slate-400">Vos données sont protégées et accessibles uniquement par les membres invités.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
