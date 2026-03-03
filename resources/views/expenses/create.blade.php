@extends('layouts.app')

@section('title', 'Ajouter une Dépense')

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
                        Ajouter une <span class="text-primary">Dépense</span>
                    </h1>
                    <p class="text-lg md:text-xl text-slate-600 dark:text-slate-300 leading-relaxed">
                        Enregistrez une nouvelle dépense pour {{ $colocation->name }}
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

                <form action="{{ route('expenses.store', $colocation) }}" method="POST" class="space-y-8">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Title -->
                        <div class="md:col-span-2">
                            <label for="title" class="block text-sm font-bold text-slate-900 dark:text-slate-100 mb-3">
                                <span class="material-symbols-outlined text-primary mr-2">tag</span>
                                Titre de la dépense
                            </label>
                            <input type="text" id="title" name="title" value="{{ old('title') }}" required
                                   class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 text-slate-900 dark:text-slate-100 placeholder:text-slate-400"
                                   placeholder="Ex: Courses Carrefour">
                            @error('title')
                                <p class="mt-2 text-sm text-red-400 flex items-center">
                                    <span class="material-symbols-outlined text-xs mr-1">error</span> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Amount -->
                        <div>
                            <label for="amount" class="block text-sm font-bold text-slate-900 dark:text-slate-100 mb-3">
                                <span class="material-symbols-outlined text-primary mr-2">euro</span>
                                Montant (€)
                            </label>
                            <div class="relative">
                                <input type="number" id="amount" name="amount" value="{{ old('amount') }}" step="0.01" min="0.01" required
                                       class="w-full px-4 py-3 pr-12 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 text-slate-900 dark:text-slate-100 placeholder:text-slate-400"
                                       placeholder="0.00">
                                <span class="absolute right-4 top-1/2 transform -translate-y-1/2 text-slate-500 dark:text-slate-400 font-medium">€</span>
                            </div>
                            @error('amount')
                                <p class="mt-2 text-sm text-red-400 flex items-center">
                                    <span class="material-symbols-outlined text-xs mr-1">error</span> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Date -->
                        <div>
                            <label for="date" class="block text-sm font-bold text-slate-900 dark:text-slate-100 mb-3">
                                <span class="material-symbols-outlined text-primary mr-2">calendar_today</span>
                                Date
                            </label>
                            <input type="date" id="date" name="date" value="{{ old('date', now()->format('Y-m-d')) }}" required
                                   class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 text-slate-900 dark:text-slate-100">
                            @error('date')
                                <p class="mt-2 text-sm text-red-400 flex items-center">
                                    <span class="material-symbols-outlined text-xs mr-1">error</span> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="category" class="block text-sm font-bold text-slate-900 dark:text-slate-100 mb-3">
                                <span class="material-symbols-outlined text-primary mr-2">category</span>
                                Catégorie
                            </label>
                            <select id="category" name="category" required
                                    class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 text-slate-900 dark:text-slate-100">
                                <option value="">Sélectionner une catégorie</option>
                                @foreach(App\Models\Expense::getCategories() as $category)
                                    <option value="{{ $category }}" {{ old('category') == $category ? 'selected' : '' }}>
                                        {{ $category }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category')
                                <p class="mt-2 text-sm text-red-400 flex items-center">
                                    <span class="material-symbols-outlined text-xs mr-1">error</span> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Payer -->
                        <div>
                            <label for="payer_id" class="block text-sm font-bold text-slate-900 dark:text-slate-100 mb-3">
                                <span class="material-symbols-outlined text-primary mr-2">person</span>
                                Payeur
                            </label>
                            <select id="payer_id" name="payer_id" required
                                    class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 text-slate-900 dark:text-slate-100">
                                <option value="">Sélectionner un payeur</option>
                                @foreach($colocation->activeMembers as $member)
                                    <option value="{{ $member->id }}" {{ old('payer_id') == $member->id ? 'selected' : '' }}>
                                        {{ $member->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('payer_id')
                                <p class="mt-2 text-sm text-red-400 flex items-center">
                                    <span class="material-symbols-outlined text-xs mr-1">error</span> {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-between pt-6 border-t border-slate-200 dark:border-slate-700">
                        <a href="{{ route('colocations.show', $colocation) }}" 
                           class="flex items-center space-x-2 text-slate-600 dark:text-slate-400 hover:text-primary dark:hover:text-primary transition-colors duration-300">
                            <span class="material-symbols-outlined">arrow_back</span>
                            <span>Retour à la colocation</span>
                        </a>
                        <div class="space-x-3">
                            <button type="reset" class="flex items-center justify-center rounded-lg h-12 px-8 bg-slate-200 dark:bg-slate-700 hover:bg-slate-300 dark:hover:bg-slate-600 text-slate-800 dark:text-slate-200 font-medium transition-transform hover:scale-105 active:scale-95">
                                <span class="material-symbols-outlined mr-2">refresh</span>
                                Réinitialiser
                            </button>
                            <button type="submit" class="flex items-center justify-center rounded-lg h-12 px-8 bg-primary text-slate-900 font-bold transition-transform hover:scale-105 active:scale-95 shadow-lg shadow-primary/20">
                                <span class="material-symbols-outlined mr-2">add</span>
                                Ajouter la dépense
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Info Card -->
        <div class="mt-6 bg-blue-100 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-6">
            <div class="flex items-start space-x-3">
                <div class="w-10 h-10 bg-blue-200 dark:bg-blue-800/40 rounded-full flex items-center justify-center flex-shrink-0">
                    <span class="material-symbols-outlined text-blue-600 dark:text-blue-400">info</span>
                </div>
                <div>
                    <h3 class="text-blue-800 dark:text-blue-300 font-semibold mb-1">Information importante</h3>
                    <p class="text-blue-700 dark:text-blue-400 text-sm">
                        Cette dépense sera partagée équitablement entre tous les membres actifs de la colocation. 
                        Le solde de chaque membre sera automatiquement mis à jour.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
