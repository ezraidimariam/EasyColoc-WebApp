@extends('layouts.app')

@section('title', 'Ajouter une Dépense')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="gradient-bg rounded-2xl p-8 mb-8 text-white animate-fade-in">
        <div class="flex items-center space-x-3">
            <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                <i class="fas fa-receipt text-white text-2xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold">Ajouter une Dépense</h1>
                <p class="text-lg opacity-90">Enregistrez une nouvelle dépense pour {{ $colocation->name }}</p>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-xl p-8 animate-slide-up">
        @if($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-6">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-red-600"></i>
                    </div>
                    <div>
                        <h3 class="text-red-800 font-semibold">Erreurs de validation</h3>
                        <ul class="list-disc list-inside text-red-700 text-sm mt-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('expenses.store', $colocation) }}" method="POST" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div class="md:col-span-2">
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-tag text-primary mr-2"></i> Titre de la dépense
                    </label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300"
                           placeholder="Ex: Courses Carrefour">
                    @error('title')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Amount -->
                <div>
                    <label for="amount" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-euro-sign text-primary mr-2"></i> Montant (€)
                    </label>
                    <div class="relative">
                        <input type="number" id="amount" name="amount" value="{{ old('amount') }}" step="0.01" min="0.01" required
                               class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300"
                               placeholder="0.00">
                        <span class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 font-medium">€</span>
                    </div>
                    @error('amount')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Date -->
                <div>
                    <label for="date" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-calendar text-primary mr-2"></i> Date
                    </label>
                    <input type="date" id="date" name="date" value="{{ old('date', now()->format('Y-m-d')) }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300">
                    @error('date')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Category -->
                <div>
                    <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-list text-primary mr-2"></i> Catégorie
                    </label>
                    <select id="category" name="category" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300">
                        <option value="">Sélectionner une catégorie</option>
                        @foreach($categories as $category)
                            <option value="{{ $category }}" {{ old('category') == $category ? 'selected' : '' }}>
                                {{ $category }}
                            </option>
                        @endforeach
                    </select>
                    @error('category')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Payer -->
                <div>
                    <label for="payer_id" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-user text-primary mr-2"></i> Payeur
                    </label>
                    <select id="payer_id" name="payer_id" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300">
                        <option value="">Sélectionner un payeur</option>
                        @foreach($members as $member)
                            <option value="{{ $member->id }}" {{ old('payer_id') == $member->id ? 'selected' : '' }}>
                                {{ $member->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('payer_id')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <a href="{{ route('colocations.show', $colocation) }}" 
                   class="flex items-center space-x-2 text-gray-600 hover:text-gray-800 transition-colors duration-300">
                    <i class="fas fa-arrow-left"></i>
                    <span>Retour à la colocation</span>
                </a>
                <div class="space-x-3">
                    <button type="reset" class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium rounded-xl transition-all duration-300">
                        <i class="fas fa-undo mr-2"></i> Réinitialiser
                    </button>
                    <button type="submit" class="btn-primary text-white font-bold py-3 px-6 rounded-xl">
                        <i class="fas fa-plus mr-2"></i> Ajouter la dépense
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Info Card -->
    <div class="mt-6 bg-blue-50 border border-blue-200 rounded-xl p-6">
        <div class="flex items-start space-x-3">
            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                <i class="fas fa-info text-blue-600"></i>
            </div>
            <div>
                <h3 class="text-blue-800 font-semibold mb-1">Information importante</h3>
                <p class="text-blue-700 text-sm">
                    Cette dépense sera partagée équitablement entre tous les membres actifs de la colocation. 
                    Le solde de chaque membre sera automatiquement mis à jour.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
