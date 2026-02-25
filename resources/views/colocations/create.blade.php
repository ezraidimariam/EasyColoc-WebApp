@extends('layouts.app')

@section('title', 'Créer une Colocation')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="gradient-bg rounded-2xl p-8 mb-8 text-white animate-fade-in">
        <div class="flex items-center space-x-3">
            <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                <i class="fas fa-home text-white text-2xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold">Créer une Colocation</h1>
                <p class="text-lg opacity-90">Démarrez la gestion de vos dépenses partagées</p>
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

        <form action="{{ route('colocations.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-tag text-primary mr-2"></i> Nom de la colocation
                </label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300"
                       placeholder="Ex: Appartement Paris 15ème">
                @error('name')
                    <p class="mt-2 text-sm text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Features Preview -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-star text-yellow-500 mr-2"></i> Ce que vous obtenez
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-check text-green-600 text-sm"></i>
                        </div>
                        <span class="text-sm text-gray-700">Suivi des dépenses partagées</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-check text-green-600 text-sm"></i>
                        </div>
                        <span class="text-sm text-gray-700">Calcul automatique des soldes</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-check text-green-600 text-sm"></i>
                        </div>
                        <span class="text-sm text-gray-700">Invitation de membres</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-check text-green-600 text-sm"></i>
                        </div>
                        <span class="text-sm text-gray-700">Système de réputation</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <a href="{{ route('colocations.index') }}" 
                   class="flex items-center space-x-2 text-gray-600 hover:text-gray-800 transition-colors duration-300">
                    <i class="fas fa-arrow-left"></i>
                    <span>Retour aux colocations</span>
                </a>
                <button type="submit" class="btn-primary text-white font-bold py-3 px-8 rounded-xl">
                    <i class="fas fa-rocket mr-2"></i> Créer la colocation
                </button>
            </div>
        </form>
    </div>

    <!-- Info Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
        <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                <i class="fas fa-users text-blue-600 text-xl"></i>
            </div>
            <h3 class="font-semibold text-gray-900 mb-2">Multi-utilisateurs</h3>
            <p class="text-sm text-gray-600">Invitez jusqu'à 10 membres pour gérer ensemble vos dépenses.</p>
        </div>
        
        <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mb-4">
                <i class="fas fa-calculator text-green-600 text-xl"></i>
            </div>
            <h3 class="font-semibold text-gray-900 mb-2">Calcul intelligent</h3>
            <p class="text-sm text-gray-600">Répartition automatique et équitable des dépenses entre tous les membres.</p>
        </div>
        
        <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
            <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mb-4">
                <i class="fas fa-shield-alt text-purple-600 text-xl"></i>
            </div>
            <h3 class="font-semibold text-gray-900 mb-2">Sécurisé</h3>
            <p class="text-sm text-gray-600">Vos données sont protégées et accessibles uniquement par les membres invités.</p>
        </div>
    </div>
</div>
@endsection
