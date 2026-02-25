@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h1 class="text-2xl font-bold text-gray-900 mb-6">Invitation à rejoindre une colocation</h1>

            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6">
                <h2 class="text-lg font-semibold text-blue-900 mb-2">{{ $invitation->colocation->name }}</h2>
                <p class="text-blue-700 mb-4">
                    Vous avez été invité par {{ $invitation->inviter->name }} ({{ $invitation->inviter->email }})
                    à rejoindre cette colocation.
                </p>
                <p class="text-sm text-blue-600">
                    Cette invitation est pour l'adresse email : <strong>{{ $invitation->email }}</strong>
                </p>
            </div>

            <div class="flex gap-4">
                <form action="{{ route('invitations.accept', $invitation->token) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded">
                        Accepter l'invitation
                    </button>
                </form>
                
                <form action="{{ route('invitations.reject', $invitation->token) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded">
                        Refuser l'invitation
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
