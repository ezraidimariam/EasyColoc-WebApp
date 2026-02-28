@extends('layouts.app')

@section('title', 'Mes Colocations')

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
                        Mes <span class="text-primary">Colocations</span>
                    </h1>
                    <p class="text-lg md:text-xl text-slate-600 dark:text-slate-300 leading-relaxed">
                        Gérez facilement vos dépenses partagées avec votre communauté
                    </p>
                </div>
                @if(!Auth::user()->activeColocation())
                    <a href="{{ route('colocations.create') }}" class="flex items-center justify-center rounded-lg h-12 px-8 bg-primary text-slate-900 text-sm font-bold transition-transform hover:scale-105 active:scale-95 shadow-lg shadow-primary/20">
                        <span class="material-symbols-outlined mr-2">add</span>
                        Créer une colocation
                    </a>
                @endif
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 md:px-10 py-12">
        @if(Auth::user()->activeColocation())
            <!-- Active Colocation Card -->
            <div class="bg-white dark:bg-slate-900 rounded-xl overflow-hidden shadow-2xl shadow-primary/5 mb-12">
                <div class="p-8 md:p-12">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-8">
                        <div class="flex items-center gap-4">
                            <div class="bg-primary p-3 rounded-xl text-white">
                                <span class="material-symbols-outlined text-3xl">home</span>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Colocation Active</h2>
                                <p class="text-slate-600 dark:text-slate-300 mt-1">{{ Auth::user()->activeColocation()->name }}</p>
                            </div>
                        </div>
                        <a href="{{ route('colocations.show', Auth::user()->activeColocation()) }}" 
                           class="flex items-center justify-center rounded-lg h-12 px-8 bg-primary text-slate-900 font-bold transition-transform hover:scale-105 active:scale-95 shadow-lg shadow-primary/20">
                            <span>Accéder</span>
                            <span class="material-symbols-outlined ml-2">arrow_forward</span>
                        </a>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-blue-50 dark:bg-blue-900/20 rounded-xl p-6 text-center border border-blue-100 dark:border-blue-800">
                            <span class="material-symbols-outlined text-blue-600 dark:text-blue-400 text-3xl mb-3">group</span>
                            <p class="text-3xl font-bold text-blue-900 dark:text-blue-100">{{ Auth::user()->activeColocation()->activeMembers()->count() }}</p>
                            <p class="text-sm text-blue-600 dark:text-blue-400 mt-1">Membres</p>
                        </div>
                        <div class="bg-green-50 dark:bg-green-900/20 rounded-xl p-6 text-center border border-green-100 dark:border-green-800">
                            <span class="material-symbols-outlined text-green-600 dark:text-green-400 text-3xl mb-3">receipt</span>
                            <p class="text-3xl font-bold text-green-900 dark:text-green-100">{{ Auth::user()->activeColocation()->expenses()->count() }}</p>
                            <p class="text-sm text-green-600 dark:text-green-400 mt-1">Dépenses</p>
                        </div>
                        <div class="bg-purple-50 dark:bg-purple-900/20 rounded-xl p-6 text-center border border-purple-100 dark:border-purple-800">
                            <span class="material-symbols-outlined text-purple-600 dark:text-purple-400 text-3xl mb-3">euro</span>
                            <p class="text-3xl font-bold text-purple-900 dark:text-purple-100">{{ number_format(Auth::user()->activeColocation()->expenses()->sum('amount'), 2) }}€</p>
                            <p class="text-sm text-purple-600 dark:text-purple-400 mt-1">Total dépenses</p>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white dark:bg-slate-900 rounded-xl overflow-hidden shadow-2xl shadow-primary/5">
                <div class="p-12 md:p-16 text-center">
                    <div class="bg-primary p-6 rounded-full text-white inline-flex items-center justify-center mb-8">
                        <span class="material-symbols-outlined text-5xl">home</span>
                    </div>
                    <h2 class="text-3xl font-bold text-slate-900 dark:text-white mb-4">Aucune colocation active</h2>
                    <p class="text-slate-600 dark:text-slate-300 text-lg leading-relaxed mb-8 max-w-2xl mx-auto">
                        Créez une nouvelle colocation pour commencer à gérer vos dépenses partagées ou rejoignez-en une via une invitation.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('colocations.create') }}" class="flex items-center justify-center rounded-lg h-12 px-8 bg-primary text-slate-900 font-bold transition-transform hover:scale-105 active:scale-95 shadow-lg shadow-primary/20">
                            <span class="material-symbols-outlined mr-2">add</span>
                            Créer une colocation
                        </a>
                        <button class="flex items-center justify-center rounded-lg h-12 px-8 bg-slate-100 dark:bg-slate-800 text-slate-900 dark:text-slate-100 font-bold transition-transform hover:scale-105 active:scale-95">
                            <span class="material-symbols-outlined mr-2">mail</span>
                            J'ai une invitation
                        </button>
                    </div>
                </div>
            </div>
        @endif

        @if($ownedColocations->count() > 0)
            <!-- Past Colocations -->
            <div class="mt-16">
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-8">Mes colocations créées</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($ownedColocations as $colocation)
                        <div class="bg-white dark:bg-slate-900 rounded-xl overflow-hidden shadow-xl shadow-slate-200/50 dark:shadow-none border border-slate-100 dark:border-slate-800 hover:shadow-primary/10 transition-all">
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h4 class="font-bold text-lg text-slate-900 dark:text-white">{{ $colocation->name }}</h4>
                                        <div class="mt-2">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $colocation->status === 'active' ? 'bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400' : 'bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-400' }}">
                                                <span class="material-symbols-outlined text-xs mr-1">{{ $colocation->status === 'active' ? 'check_circle' : 'cancel' }}</span>
                                                {{ $colocation->status === 'active' ? 'Active' : 'Annulée' }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center {{ $colocation->status === 'active' ? 'bg-green-100 dark:bg-green-900/20' : 'bg-red-100 dark:bg-red-900/20' }}">
                                        <span class="material-symbols-outlined {{ $colocation->status === 'active' ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                            {{ $colocation->status === 'active' ? 'check' : 'close' }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="space-y-3">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-slate-600 dark:text-slate-400">Membres</span>
                                        <span class="font-medium text-slate-900 dark:text-slate-100">{{ $colocation->activeMembers()->count() }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-slate-600 dark:text-slate-400">Dépenses</span>
                                        <span class="font-medium text-slate-900 dark:text-slate-100">{{ $colocation->expenses()->count() }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-slate-600 dark:text-slate-400">Total</span>
                                        <span class="font-medium text-slate-900 dark:text-slate-100">{{ number_format($colocation->expenses()->sum('amount'), 2) }}€</span>
                                    </div>
                                </div>
                                
                                @if($colocation->status === 'active')
                                    <a href="{{ route('colocations.show', $colocation) }}" 
                                       class="w-full mt-6 flex items-center justify-center rounded-lg h-10 bg-primary text-slate-900 font-bold transition-transform hover:scale-105 active:scale-95 shadow-lg shadow-primary/20">
                                        <span>Voir les détails</span>
                                        <span class="material-symbols-outlined ml-2">arrow_forward</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
