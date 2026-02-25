@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="text-center">
                <h1 class="text-2xl font-bold text-red-900 mb-4">Invitation non disponible</h1>
                <div class="bg-red-50 border border-red-200 rounded-lg p-6">
                    <p class="text-red-700">{{ $message }}</p>
                </div>
                <div class="mt-6">
                    <a href="{{ route('dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Retour au tableau de bord
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
