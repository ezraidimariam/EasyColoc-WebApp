@extends('layouts.app')

@section('title', 'Invitation à rejoindre une colocation')

@section('content')
<div class="min-h-screen bg-background-light dark:bg-background-dark">
    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-gradient-to-br from-primary/20 to-primary/5 dark:from-primary/10 dark:to-primary/5">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-24 -right-24 w-64 h-64 bg-primary/20 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-12 -left-12 w-48 h-48 bg-primary/10 rounded-full blur-2xl"></div>
        </div>
        <div class="relative max-w-7xl mx-auto px-6 md:px-10 py-16">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-black tracking-tight text-slate-900 dark:text-white mb-4">
                    Invitation à rejoindre une <span class="text-primary">Colocation</span>
                </h1>
                <p class="text-lg md:text-xl text-slate-600 dark:text-slate-300 leading-relaxed">
                    Vous avez été invité à rejoindre une colocation
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-6 md:px-10 py-12">
        <div class="bg-white dark:bg-slate-900 rounded-xl overflow-hidden shadow-2xl shadow-primary/5">
            <div class="p-8 md:p-12">
                <div class="bg-gradient-to-r from-primary/10 to-primary/5 dark:from-primary/5 dark:to-primary/10 rounded-xl p-8 mb-8 border border-primary/20">
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-4">
                        <span class="material-symbols-outlined text-primary mr-3">home</span>
                        {{ $invitation->colocation->name }}
                    </h2>
                    <p class="text-slate-600 dark:text-slate-300 mb-6">
                        Vous avez été invité par {{ $invitation->inviter->name }} ({{ $invitation->inviter->email }})
                        à rejoindre cette colocation.
                    </p>
                    <div class="bg-slate-100 dark:bg-slate-800 rounded-lg p-4 border border-slate-200 dark:border-slate-700">
                        <p class="text-sm text-slate-600 dark:text-slate-400">
                            Cette invitation est pour l'adresse email : 
                            <span class="font-bold text-slate-900 dark:text-slate-100">{{ $invitation->email }}</span>
                        </p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <form action="{{ route('invitations.accept', $invitation->token) }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center rounded-lg h-12 px-8 bg-primary text-slate-900 font-bold transition-transform hover:scale-105 active:scale-95 shadow-lg shadow-primary/20">
                            <span class="material-symbols-outlined mr-2">check_circle</span>
                            Accepter l'invitation
                        </button>
                    </form>
                    
                    <form action="{{ route('invitations.reject', $invitation->token) }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center rounded-lg h-12 px-8 bg-red-600 hover:bg-red-700 text-white font-bold transition-transform hover:scale-105 active:scale-95 shadow-lg shadow-red-600/20">
                            <span class="material-symbols-outlined mr-2">cancel</span>
                            Refuser l'invitation
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
