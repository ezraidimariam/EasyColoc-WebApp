@extends('layouts.app')

@section('title', $colocation->name)

@section('content')
<div class="min-h-screen bg-background-light dark:bg-background-dark">
    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-gradient-to-br from-primary/20 to-primary/5 dark:from-primary/10 dark:to-primary/5">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-24 -right-24 w-64 h-64 bg-primary/20 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-12 -left-12 w-48 h-48 bg-primary/10 rounded-full blur-2xl"></div>
        </div>
        <div class="relative max-w-7xl mx-auto px-6 md:px-10 py-16">
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-8">
                <div>
                    <h1 class="text-4xl md:text-5xl font-black tracking-tight text-slate-900 dark:text-white mb-4">
                        {{ $colocation->name }}
                    </h1>
                    <p class="text-lg md:text-xl text-slate-600 dark:text-slate-300 leading-relaxed">
                        Gestion des dépenses partagées
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row gap-4">
                    @if(Auth::user()->id === $colocation->owner_id)
                        <form action="{{ route('colocations.cancel', $colocation) }}" method="POST">
                            @csrf
                            <button type="submit" class="flex items-center justify-center rounded-lg h-12 px-8 bg-red-600 hover:bg-red-700 text-white font-bold transition-transform hover:scale-105 active:scale-95 shadow-lg shadow-red-600/20"
                                    onclick="return confirm('Êtes-vous sûr de vouloir annuler cette colocation ?')">
                                <span class="material-symbols-outlined mr-2">cancel</span>
                                Annuler
                            </button>
                        </form>
                    @else
                        <form action="{{ route('colocations.leave', $colocation) }}" method="POST">
                            @csrf
                            <button type="submit" class="flex items-center justify-center rounded-lg h-12 px-8 bg-yellow-600 hover:bg-yellow-700 text-white font-bold transition-transform hover:scale-105 active:scale-95 shadow-lg shadow-yellow-600/20"
                                    onclick="return confirm('Êtes-vous sûr de vouloir quitter cette colocation ?')">
                                <span class="material-symbols-outlined mr-2">logout</span>
                                Quitter
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 md:px-10 py-12">
        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
            <div class="bg-white dark:bg-slate-900 rounded-xl overflow-hidden shadow-xl shadow-slate-200/50 dark:shadow-none border border-slate-100 dark:border-slate-800">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-600 dark:text-slate-400">Membres actifs</p>
                            <p class="text-3xl font-bold text-slate-900 dark:text-white">{{ $colocation->activeMembers()->count() }}</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/20 rounded-full flex items-center justify-center">
                            <span class="material-symbols-outlined text-blue-600 dark:text-blue-400 text-xl">group</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-slate-900 rounded-xl overflow-hidden shadow-xl shadow-slate-200/50 dark:shadow-none border border-slate-100 dark:border-slate-800">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-600 dark:text-slate-400">Total dépenses</p>
                            <p class="text-3xl font-bold text-slate-900 dark:text-white">{{ number_format($expenses->sum('amount'), 2) }}€</p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 dark:bg-green-900/20 rounded-full flex items-center justify-center">
                            <span class="material-symbols-outlined text-green-600 dark:text-green-400 text-xl">euro</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-slate-900 rounded-xl overflow-hidden shadow-xl shadow-slate-200/50 dark:shadow-none border border-slate-100 dark:border-slate-800">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-600 dark:text-slate-400">Dépenses totales</p>
                            <p class="text-3xl font-bold text-slate-900 dark:text-white">{{ $expenses->count() }}</p>
                        </div>
                        <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/20 rounded-full flex items-center justify-center">
                            <span class="material-symbols-outlined text-purple-600 dark:text-purple-400 text-xl">receipt</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-slate-900 rounded-xl overflow-hidden shadow-xl shadow-slate-200/50 dark:shadow-none border border-slate-100 dark:border-slate-800">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-600 dark:text-slate-400">Moyenne/personne</p>
                            <p class="text-3xl font-bold text-slate-900 dark:text-white">
                                {{ $colocation->activeMembers()->count() > 0 ? number_format($expenses->sum('amount') / $colocation->activeMembers()->count(), 2) : '0.00' }}€
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-orange-100 dark:bg-orange-900/20 rounded-full flex items-center justify-center">
                            <span class="material-symbols-outlined text-orange-600 dark:text-orange-400 text-xl">trending_up</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Members Section -->
        <div class="bg-white dark:bg-slate-900 rounded-xl overflow-hidden shadow-2xl shadow-primary/5 mb-12">
            <div class="p-8 md:p-12">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white">
                        <span class="material-symbols-outlined text-primary mr-3">group</span>
                        Membres
                    </h2>
                    <span class="bg-blue-100 dark:bg-blue-900/20 text-blue-800 dark:text-blue-400 px-3 py-1 rounded-full text-sm font-medium border border-blue-200 dark:border-blue-800">
                        {{ $colocation->activeMembers()->count() }} membres
                    </span>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($colocation->activeMembers as $member)
                        <div class="bg-slate-50 dark:bg-slate-800 rounded-xl p-6 border border-slate-200 dark:border-slate-700 hover:shadow-lg transition-all duration-300">
                            <div class="flex justify-between items-start mb-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-12 h-12 bg-gradient-to-br from-primary to-primary/70 rounded-full flex items-center justify-center text-white font-bold">
                                        {{ strtoupper(substr($member->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-slate-900 dark:text-white">{{ $member->name }}</h3>
                                        <p class="text-sm text-slate-600 dark:text-slate-400">{{ $member->email }}</p>
                                    </div>
                                </div>
                                @if($member->id === $colocation->owner_id)
                                    <span class="bg-gradient-to-r from-primary to-primary/70 text-white px-3 py-1 rounded-full text-xs font-medium">
                                        Propriétaire
                                    </span>
                                @endif
                            </div>
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-sm text-slate-600 dark:text-slate-400">Réputation</p>
                                    <p class="text-lg font-bold {{ $member->reputation >= 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                        {{ $member->reputation >= 0 ? '+' : '' }}{{ $member->reputation }}
                                    </p>
                                </div>
                                @if(Auth::user()->id === $colocation->owner_id && $member->id !== $colocation->owner_id)
                                    <form action="{{ route('colocations.remove', [$colocation, $member]) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 text-sm font-medium transition-colors"
                                                onclick="return confirm('Retirer {{ $member->name }} de la colocation ?')">
                                            <span class="material-symbols-outlined text-sm mr-1">person_remove</span>
                                            Retirer
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Balance and Settlements -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
            <!-- Balances -->
            <div class="bg-white dark:bg-slate-900 rounded-xl overflow-hidden shadow-2xl shadow-primary/5">
                <div class="p-8 md:p-12">
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-8">
                        <span class="material-symbols-outlined text-primary mr-3">balance</span>
                        Soldes
                    </h2>
                    <div class="space-y-4">
                        @foreach($balances as $balance)
                            <div class="bg-slate-50 dark:bg-slate-800 rounded-xl p-6 border border-slate-200 dark:border-slate-700 hover:shadow-lg transition-all duration-300">
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-primary to-primary/70 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                            {{ strtoupper(substr($balance['user']->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-slate-900 dark:text-white">{{ $balance['user']->name }}</h3>
                                            <p class="text-sm text-slate-600 dark:text-slate-400">A payé: {{ number_format($balance['paid'], 2) }}€</p>
                                            <p class="text-sm text-slate-600 dark:text-slate-400">Part: {{ number_format($balance['share'], 2) }}€</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-xl font-bold {{ $balance['balance'] >= 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                            {{ $balance['balance'] >= 0 ? '+' : '' }}{{ number_format($balance['balance'], 2) }}€
                                        </p>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $balance['balance'] >= 0 ? 'bg-green-100 dark:bg-green-900/20 text-green-800 dark:text-green-400' : 'bg-red-100 dark:bg-red-900/20 text-red-800 dark:text-red-400' }}">
                                            {{ $balance['balance'] >= 0 ? 'Créditeur' : 'Débiteur' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Settlements -->
            <div class="bg-white dark:bg-slate-900 rounded-xl overflow-hidden shadow-2xl shadow-primary/5">
                <div class="p-8 md:p-12">
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-8">
                        <span class="material-symbols-outlined text-primary mr-3">swap_horiz</span>
                        Qui doit quoi à qui
                    </h2>
                    @if($settlements->count() > 0)
                        <div class="space-y-4">
                            @foreach($settlements as $settlement)
                                <div class="bg-gradient-to-r from-yellow-50 to-orange-50 dark:from-yellow-900/20 dark:to-orange-900/20 rounded-xl p-6 border border-yellow-200 dark:border-yellow-800 hover:shadow-lg transition-all duration-300">
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center text-white text-sm font-bold">
                                                {{ strtoupper(substr($settlement['from']->name, 0, 1)) }}
                                            </div>
                                            <span class="material-symbols-outlined text-yellow-600">arrow_forward</span>
                                            <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-white text-sm font-bold">
                                                {{ strtoupper(substr($settlement['to']->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <p class="font-medium text-slate-900 dark:text-white">
                                                    {{ $settlement['from']->name }} → {{ $settlement['to']->name }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <div class="bg-yellow-600 text-white px-4 py-2 rounded-full font-bold">
                                                {{ number_format($settlement['amount'], 2) }}€
                                            </div>
                                            <form action="{{ route('payments.store', $colocation) }}" method="POST" class="inline">
                                                @csrf
                                                <input type="hidden" name="from_user_id" value="{{ $settlement['from']->id }}">
                                                <input type="hidden" name="to_user_id" value="{{ $settlement['to']->id }}">
                                                <input type="hidden" name="amount" value="{{ $settlement['amount'] }}">
                                                <input type="hidden" name="description" value="Paiement de {{ $settlement['from']->name }} à {{ $settlement['to']->name }}">
                                                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors flex items-center gap-1">
                                                    <span class="material-symbols-outlined text-sm">check</span>
                                                    Marquer payé
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-xl border border-green-200 dark:border-green-800">
                            <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                                <span class="material-symbols-outlined text-white text-2xl">check_circle</span>
                            </div>
                            <p class="text-green-700 dark:text-green-300 font-bold text-lg">Tout est équilibré!</p>
                            <p class="text-green-600 dark:text-green-400 text-sm mt-1">Aucun remboursement nécessaire</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Invitation Section (Owner only) -->
        @if(Auth::user()->id === $colocation->owner_id)
            <div class="bg-white dark:bg-slate-900 rounded-xl overflow-hidden shadow-2xl shadow-primary/5 mb-12">
                <div class="p-8 md:p-12">
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-8">
                        <span class="material-symbols-outlined text-primary mr-3">person_add</span>
                        Inviter un membre
                    </h2>
                    <form action="{{ route('colocations.invite', $colocation) }}" method="POST" class="flex gap-4">
                        @csrf
                        <div class="flex-1">
                            <input type="email" name="email" placeholder="Email de la personne à inviter" required
                                   class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-slate-900 dark:text-slate-100 placeholder:text-slate-400">
                        </div>
                        <button type="submit" class="flex items-center justify-center rounded-lg h-12 px-8 bg-primary text-slate-900 font-bold transition-transform hover:scale-105 active:scale-95 shadow-lg shadow-primary/20">
                            <span class="material-symbols-outlined mr-2">send</span>
                            Inviter
                        </button>
                    </form>
                    
                    @if($invitations->count() > 0)
                        <div class="mt-6">
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-3">Invitations en attente</h3>
                            <div class="space-y-2">
                                @foreach($invitations as $invitation)
                                    <div class="flex justify-between items-center bg-slate-50 dark:bg-slate-800 px-4 py-3 rounded-lg border border-slate-200 dark:border-slate-700">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 bg-yellow-100 dark:bg-yellow-900/20 rounded-full flex items-center justify-center">
                                                <span class="material-symbols-outlined text-yellow-600 dark:text-yellow-400 text-sm">schedule</span>
                                            </div>
                                            <span class="text-sm font-medium text-slate-900 dark:text-slate-100">{{ $invitation->email }}</span>
                                        </div>
                                        <span class="bg-yellow-100 dark:bg-yellow-900/20 text-yellow-800 dark:text-yellow-400 px-2 py-1 rounded-full text-xs font-medium">En attente</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <!-- Expenses Section -->
        <div class="bg-white dark:bg-slate-900 rounded-xl overflow-hidden shadow-2xl shadow-primary/5">
            <div class="p-8 md:p-12">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white">
                        <span class="material-symbols-outlined text-primary mr-3">receipt</span>
                        Dépenses
                    </h2>
                    <div class="flex items-center gap-4">
                        <form method="GET" action="{{ route('colocations.show', $colocation) }}" class="flex items-center gap-2">
                            <label for="month" class="text-sm text-slate-600 dark:text-slate-400">Filtrer par mois:</label>
                            <select name="month" id="month" class="bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-transparent">
                                <option value="all" {{ $month === 'all' ? 'selected' : '' }}>Tous les mois</option>
                                <option value="1" {{ $month === '1' ? 'selected' : '' }}>Janvier</option>
                                <option value="2" {{ $month === '2' ? 'selected' : '' }}>Février</option>
                                <option value="3" {{ $month === '3' ? 'selected' : '' }}>Mars</option>
                                <option value="4" {{ $month === '4' ? 'selected' : '' }}>Avril</option>
                                <option value="5" {{ $month === '5' ? 'selected' : '' }}>Mai</option>
                                <option value="6" {{ $month === '6' ? 'selected' : '' }}>Juin</option>
                                <option value="7" {{ $month === '7' ? 'selected' : '' }}>Juillet</option>
                                <option value="8" {{ $month === '8' ? 'selected' : '' }}>Août</option>
                                <option value="9" {{ $month === '9' ? 'selected' : '' }}>Septembre</option>
                                <option value="10" {{ $month === '10' ? 'selected' : '' }}>Octobre</option>
                                <option value="11" {{ $month === '11' ? 'selected' : '' }}>Novembre</option>
                                <option value="12" {{ $month === '12' ? 'selected' : '' }}>Décembre</option>
                            </select>
                        </form>
                        <a href="{{ route('expenses.create', $colocation) }}" class="flex items-center justify-center rounded-lg h-10 px-6 bg-primary text-slate-900 font-bold transition-transform hover:scale-105 active:scale-95 shadow-lg shadow-primary/20">
                            <span class="material-symbols-outlined mr-2">add</span>
                            Ajouter
                        </a>
                    </div>
                </div>

                <!-- Statistics Section -->
                @if($expensesByCategory->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                        @foreach($expensesByCategory as $category => $data)
                            <div class="bg-gradient-to-br from-slate-50 to-slate-100 dark:from-slate-800 dark:to-slate-700 rounded-xl p-6 border border-slate-200 dark:border-slate-600">
                                <div class="flex items-center justify-between mb-4">
                                    <h4 class="font-bold text-slate-900 dark:text-white">{{ $category }}</h4>
                                    <span class="bg-primary text-white px-3 py-1 rounded-full text-sm font-bold">
                                        {{ $data['count'] }}
                                    </span>
                                </div>
                                <div class="text-2xl font-bold text-primary mb-2">
                                    {{ number_format($data['total'], 2) }}€
                                </div>
                                <div class="text-sm text-slate-600 dark:text-slate-400">
                                    {{ $data['count'] }} dépense{{ $data['count'] > 1 ? 's' : '' }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                @if($expenses->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-700">
                            <thead class="bg-slate-50 dark:bg-slate-800">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Titre</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Montant</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Catégorie</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Payeur</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-slate-900 divide-y divide-slate-200 dark:divide-slate-700">
                                @foreach($expenses as $expense)
                                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 bg-gradient-to-br from-primary to-primary/70 rounded-full flex items-center justify-center text-white text-xs font-bold mr-3">
                                                    {{ strtoupper(substr($expense->title, 0, 1)) }}
                                                </div>
                                                <div class="text-sm font-medium text-slate-900 dark:text-slate-100">{{ $expense->title }}</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="text-sm font-bold text-slate-900 dark:text-slate-100">{{ number_format($expense->amount, 2) }}€</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 dark:bg-blue-900/20 text-blue-800 dark:text-blue-400">
                                                {{ $expense->category }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-6 h-6 bg-slate-200 dark:bg-slate-600 rounded-full flex items-center justify-center text-slate-600 dark:text-slate-300 text-xs font-bold mr-2">
                                                    {{ strtoupper(substr($expense->payer->name, 0, 1)) }}
                                                </div>
                                                <span class="text-sm text-slate-900 dark:text-slate-100">{{ $expense->payer->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 dark:text-slate-400">
                                            {{ $expense->date->format('d/m/Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('expenses.edit', [$colocation, $expense]) }}" 
                                                   class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 transition-colors">
                                                    <span class="material-symbols-outlined text-sm">edit</span>
                                                </a>
                                                <form action="{{ route('expenses.destroy', [$colocation, $expense]) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 transition-colors"
                                                            onclick="return confirm('Supprimer cette dépense ?')">
                                                        <span class="material-symbols-outlined text-sm">delete</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-12 bg-slate-50 dark:bg-slate-800 rounded-xl">
                        <div class="w-16 h-16 bg-slate-200 dark:bg-slate-700 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="material-symbols-outlined text-slate-400 dark:text-slate-500 text-2xl">receipt</span>
                        </div>
                        <p class="text-slate-500 dark:text-slate-400 font-medium">Aucune dépense pour le moment</p>
                        <p class="text-slate-400 dark:text-slate-500 text-sm mt-1">Ajoutez votre première dépense pour commencer</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
