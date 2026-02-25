@extends('layouts.app')

@section('title', 'Mes Colocations')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Hero Section -->
    <div class="gradient-bg rounded-2xl p-8 mb-8 text-white animate-fade-in">
        <div class="flex flex-col lg:flex-row justify-between items-center">
            <div>
                <h1 class="text-4xl font-bold mb-4">Mes Colocations</h1>
                <p class="text-xl opacity-90">Gérez facilement vos dépenses partagées</p>
            </div>
            @if(!Auth::user()->activeColocation())
                <a href="{{ route('colocations.create') }}" class="btn-primary text-white font-bold py-3 px-6 rounded-full mt-4 lg:mt-0">
                    <i class="fas fa-plus mr-2"></i> Créer une colocation
                </a>
            @endif
        </div>
    </div>

    @if(Auth::user()->activeColocation())
        <!-- Active Colocation Card -->
        <div class="bg-white rounded-2xl shadow-xl p-6 mb-8 card-hover animate-slide-up">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gradient-to-r from-success to-green-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-home text-white"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">Colocation Active</h2>
                        <p class="text-gray-600">{{ Auth::user()->activeColocation()->name }}</p>
                    </div>
                </div>
                <a href="{{ route('colocations.show', Auth::user()->activeColocation()) }}" 
                   class="bg-gradient-to-r from-primary to-secondary text-white px-6 py-3 rounded-full hover:shadow-lg transition-all duration-300">
                    <i class="fas fa-arrow-right mr-2"></i> Accéder
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                <div class="bg-blue-50 rounded-lg p-4 text-center">
                    <i class="fas fa-users text-blue-600 text-2xl mb-2"></i>
                    <p class="text-2xl font-bold text-blue-900">{{ Auth::user()->activeColocation()->activeMembers()->count() }}</p>
                    <p class="text-sm text-blue-600">Membres</p>
                </div>
                <div class="bg-green-50 rounded-lg p-4 text-center">
                    <i class="fas fa-receipt text-green-600 text-2xl mb-2"></i>
                    <p class="text-2xl font-bold text-green-900">{{ Auth::user()->activeColocation()->expenses()->count() }}</p>
                    <p class="text-sm text-green-600">Dépenses</p>
                </div>
                <div class="bg-purple-50 rounded-lg p-4 text-center">
                    <i class="fas fa-euro-sign text-purple-600 text-2xl mb-2"></i>
                    <p class="text-2xl font-bold text-purple-900">{{ number_format(Auth::user()->activeColocation()->expenses()->sum('amount'), 2) }}€</p>
                    <p class="text-sm text-purple-600">Total dépenses</p>
                </div>
            </div>
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white rounded-2xl shadow-xl p-12 text-center card-hover">
            <div class="w-24 h-24 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-home text-white text-4xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Aucune colocation active</h2>
            <p class="text-gray-600 mb-8 max-w-md mx-auto">
                Créez une nouvelle colocation pour commencer à gérer vos dépenses partagées ou rejoignez-en une via une invitation.
            </p>
            <div class="space-x-4">
                <a href="{{ route('colocations.create') }}" class="btn-primary text-white font-bold py-3 px-8 rounded-full">
                    <i class="fas fa-plus mr-2"></i> Créer une colocation
                </a>
                <button class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 px-8 rounded-full transition-all duration-300">
                    <i class="fas fa-envelope mr-2"></i> J'ai une invitation
                </button>
            </div>
        </div>
    @endif

    @if($ownedColocations->count() > 0)
        <!-- Past Colocations -->
        <div class="mt-12">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">Mes colocations créées</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($ownedColocations as $colocation)
                    <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h4 class="font-bold text-lg text-gray-900">{{ $colocation->name }}</h4>
                                <p class="text-sm text-gray-600 mt-1">
                                    Statut: 
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $colocation->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $colocation->status === 'active' ? 'Active' : 'Annulée' }}
                                    </span>
                                </p>
                            </div>
                            @if($colocation->status === 'active')
                                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-check text-green-600"></i>
                                </div>
                            @else
                                <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-times text-red-600"></i>
                                </div>
                            @endif
                        </div>
                        
                        <div class="space-y-3">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Membres</span>
                                <span class="font-medium text-gray-900">{{ $colocation->activeMembers()->count() }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Dépenses</span>
                                <span class="font-medium text-gray-900">{{ $colocation->expenses()->count() }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Total</span>
                                <span class="font-medium text-gray-900">{{ number_format($colocation->expenses()->sum('amount'), 2) }}€</span>
                            </div>
                        </div>
                        
                        @if($colocation->status === 'active')
                            <a href="{{ route('colocations.show', $colocation) }}" 
                               class="w-full mt-4 bg-gradient-to-r from-primary to-secondary text-white text-center py-2 rounded-lg hover:shadow-lg transition-all duration-300">
                                <i class="fas fa-arrow-right mr-2"></i> Voir les détails
                            </a>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
