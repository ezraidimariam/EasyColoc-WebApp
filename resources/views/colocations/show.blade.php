@extends('layouts.app')

@section('title', $colocation->name)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="gradient-bg rounded-2xl p-8 mb-8 text-white animate-fade-in">
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center">
            <div>
                <h1 class="text-4xl font-bold mb-2">{{ $colocation->name }}</h1>
                <p class="text-lg opacity-90">Gestion des dépenses partagées</p>
            </div>
            <div class="mt-4 lg:mt-0 space-x-3 flex flex-col sm:flex-row">
                @if(Auth::user()->id === $colocation->owner_id)
                    <form action="{{ route('colocations.cancel', $colocation) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full transition-all duration-300 w-full sm:w-auto"
                                onclick="return confirm('Êtes-vous sûr de vouloir annuler cette colocation ?')">
                            <i class="fas fa-times mr-2"></i> Annuler
                        </button>
                    </form>
                    <!-- Debug: Direct link test -->
                    <a href="{{ route('colocations.cancel', $colocation) }}" 
                       class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-full transition-all duration-300 w-full sm:w-auto inline-block text-center">
                        <i class="fas fa-bug mr-2"></i> Test Cancel
                    </a>
                @else
                    <form action="{{ route('colocations.leave', $colocation) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-full transition-all duration-300 w-full sm:w-auto"
                                onclick="return confirm('Êtes-vous sûr de vouloir quitter cette colocation ?')">
                            <i class="fas fa-sign-out-alt mr-2"></i> Quitter
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Membres actifs</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $colocation->activeMembers()->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-users text-blue-600"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Total dépenses</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($expenses->sum('amount'), 2) }}€</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-euro-sign text-green-600"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Dépenses totales</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $expenses->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-receipt text-purple-600"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Moyenne/personne</p>
                    <p class="text-2xl font-bold text-gray-900">
                        {{ $colocation->activeMembers()->count() > 0 ? number_format($expenses->sum('amount') / $colocation->activeMembers()->count(), 2) : '0.00' }}€
                    </p>
                </div>
                <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-chart-line text-orange-600"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Members Section -->
    <div class="bg-white rounded-2xl shadow-xl p-6 mb-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-900">
                <i class="fas fa-users text-primary mr-3"></i> Membres
            </h2>
            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                {{ $colocation->activeMembers()->count() }} membres
            </span>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($colocation->activeMembers as $member)
                <div class="border border-gray-200 rounded-xl p-6 hover:shadow-lg transition-all duration-300">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center text-white font-bold">
                                {{ strtoupper(substr($member->name, 0, 1)) }}
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900">{{ $member->name }}</h3>
                                <p class="text-sm text-gray-600">{{ $member->email }}</p>
                            </div>
                        </div>
                        @if($member->id === $colocation->owner_id)
                            <span class="bg-gradient-to-r from-primary to-secondary text-white px-3 py-1 rounded-full text-xs font-medium">
                                Propriétaire
                            </span>
                        @endif
                    </div>
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-600">Réputation</p>
                            <p class="text-lg font-bold {{ $member->reputation >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                {{ $member->reputation >= 0 ? '+' : '' }}{{ $member->reputation }}
                            </p>
                        </div>
                        @if(Auth::user()->id === $colocation->owner_id && $member->id !== $colocation->owner_id)
                            <form action="{{ route('colocations.remove', [$colocation, $member]) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium"
                                        onclick="return confirm('Retirer {{ $member->name }} de la colocation ?')">
                                    <i class="fas fa-user-minus mr-1"></i> Retirer
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Balance and Settlements -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Balances -->
        <div class="bg-white rounded-2xl shadow-xl p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">
                <i class="fas fa-balance-scale text-primary mr-3"></i> Soldes
            </h2>
            <div class="space-y-4">
                @foreach($balances as $balance)
                    <div class="border border-gray-200 rounded-xl p-4 hover:shadow-md transition-all duration-300">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center text-white font-bold text-sm">
                                    {{ strtoupper(substr($balance['user']->name, 0, 1)) }}
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900">{{ $balance['user']->name }}</h3>
                                    <p class="text-sm text-gray-600">A payé: {{ number_format($balance['paid'], 2) }}€</p>
                                    <p class="text-sm text-gray-600">Part: {{ number_format($balance['share'], 2) }}€</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-xl font-bold {{ $balance['balance'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $balance['balance'] >= 0 ? '+' : '' }}{{ number_format($balance['balance'], 2) }}€
                                </p>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $balance['balance'] >= 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $balance['balance'] >= 0 ? 'Créditeur' : 'Débiteur' }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Settlements -->
        <div class="bg-white rounded-2xl shadow-xl p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">
                <i class="fas fa-exchange-alt text-primary mr-3"></i> Qui doit quoi à qui
            </h2>
            @if($settlements->count() > 0)
                <div class="space-y-4">
                    @foreach($settlements as $settlement)
                        <div class="bg-gradient-to-r from-yellow-50 to-orange-50 border border-yellow-200 rounded-xl p-4 hover:shadow-md transition-all duration-300">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center text-white text-sm font-bold">
                                        {{ strtoupper(substr($settlement['from']->name, 0, 1)) }}
                                    </div>
                                    <i class="fas fa-arrow-right text-yellow-600"></i>
                                    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-white text-sm font-bold">
                                        {{ strtoupper(substr($settlement['to']->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">
                                            {{ $settlement['from']->name }} → {{ $settlement['to']->name }}
                                        </p>
                                    </div>
                                </div>
                                <div class="bg-yellow-600 text-white px-4 py-2 rounded-full font-bold">
                                    {{ number_format($settlement['amount'], 2) }}€
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-xl">
                    <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-check text-white text-2xl"></i>
                    </div>
                    <p class="text-green-700 font-bold text-lg">Tout est équilibré!</p>
                    <p class="text-green-600 text-sm mt-1">Aucun remboursement nécessaire</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Invitation Section (Owner only) -->
    @if(Auth::user()->id === $colocation->owner_id)
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl shadow-xl p-6 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">
                <i class="fas fa-user-plus text-primary mr-3"></i> Inviter un membre
            </h2>
            <form action="{{ route('colocations.invite', $colocation) }}" method="POST" class="flex gap-4">
                @csrf
                <div class="flex-1">
                    <input type="email" name="email" placeholder="Email de la personne à inviter" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                </div>
                <button type="submit" class="btn-primary text-white font-bold py-3 px-6 rounded-xl">
                    <i class="fas fa-paper-plane mr-2"></i> Inviter
                </button>
            </form>
            
            @if($invitations->count() > 0)
                <div class="mt-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Invitations en attente</h3>
                    <div class="space-y-2">
                        @foreach($invitations as $invitation)
                            <div class="flex justify-between items-center bg-white px-4 py-3 rounded-lg border border-gray-200">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-clock text-yellow-600 text-sm"></i>
                                    </div>
                                    <span class="text-sm font-medium text-gray-900">{{ $invitation->email }}</span>
                                </div>
                                <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs font-medium">En attente</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    @endif

    <!-- Expenses Section -->
    <div class="bg-white rounded-2xl shadow-xl p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-900">
                <i class="fas fa-receipt text-primary mr-3"></i> Dépenses
            </h2>
            <a href="{{ route('expenses.create', $colocation) }}" class="btn-primary text-white font-bold py-2 px-4 rounded-full">
                <i class="fas fa-plus mr-2"></i> Ajouter
            </a>
        </div>

        @if($expenses->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catégorie</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payeur</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($expenses as $expense)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center text-white text-xs font-bold mr-3">
                                            {{ strtoupper(substr($expense->title, 0, 1)) }}
                                        </div>
                                        <div class="text-sm font-medium text-gray-900">{{ $expense->title }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-bold text-gray-900">{{ number_format($expense->amount, 2) }}€</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ $expense->category }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-6 h-6 bg-gray-200 rounded-full flex items-center justify-center text-gray-600 text-xs font-bold mr-2">
                                            {{ strtoupper(substr($expense->payer->name, 0, 1)) }}
                                        </div>
                                        <span class="text-sm text-gray-900">{{ $expense->payer->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $expense->date->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('expenses.edit', [$colocation, $expense]) }}" 
                                           class="text-indigo-600 hover:text-indigo-900 transition-colors">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('expenses.destroy', [$colocation, $expense]) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 transition-colors"
                                                    onclick="return confirm('Supprimer cette dépense ?')">
                                                <i class="fas fa-trash"></i>
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
            <div class="text-center py-12 bg-gray-50 rounded-xl">
                <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-receipt text-gray-400 text-2xl"></i>
                </div>
                <p class="text-gray-500 font-medium">Aucune dépense pour le moment</p>
                <p class="text-gray-400 text-sm mt-1">Ajoutez votre première dépense pour commencer</p>
            </div>
        @endif
    </div>
</div>
@endsection
