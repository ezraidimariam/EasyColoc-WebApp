@extends('layouts.app')

@section('title', 'Invitation non disponible')

@section('content')
<div class="min-h-screen bg-background-light dark:bg-background-dark">
    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-gradient-to-br from-red-500/20 to-red-500/5 dark:from-red-500/10 dark:to-red-500/5">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-24 -right-24 w-64 h-64 bg-red-500/20 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-12 -left-12 w-48 h-48 bg-red-500/10 rounded-full blur-2xl"></div>
        </div>
        <div class="relative max-w-7xl mx-auto px-6 md:px-10 py-16">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-black tracking-tight text-slate-900 dark:text-white mb-4">
                    Invitation <span class="text-red-500">non disponible</span>
                </h1>
                <p class="text-lg md:text-xl text-slate-600 dark:text-slate-300 leading-relaxed">
                    Cette invitation ne peut pas être traitée
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-6 md:px-10 py-12">
        <div class="bg-white dark:bg-slate-900 rounded-xl overflow-hidden shadow-2xl shadow-red-500/5">
            <div class="p-8 md:p-12 text-center">
                <div class="bg-red-100 dark:bg-red-900/20 rounded-full p-6 inline-flex items-center justify-center mb-8">
                    <span class="material-symbols-outlined text-red-600 dark:text-red-400 text-5xl">error</span>
                </div>
                <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl p-8 mb-8">
                    <p class="text-red-800 dark:text-red-300 text-lg">{{ $message }}</p>
                </div>
                <div>
                    <a href="{{ route('dashboard') }}" 
                       class="flex items-center justify-center rounded-lg h-12 px-8 bg-primary text-slate-900 font-bold transition-transform hover:scale-105 active:scale-95 shadow-lg shadow-primary/20 mx-auto max-w-xs">
                        <span class="material-symbols-outlined mr-2">home</span>
                        Retour au tableau de bord
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
