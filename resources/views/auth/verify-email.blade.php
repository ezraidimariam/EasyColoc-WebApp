<x-guest-layout>
    <!-- Verify Email -->
    <div class="space-y-6">
        <div class="text-center">
            <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-envelope text-purple-600 text-2xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Vérifiez votre email</h3>
            <p class="text-gray-600">Merci de vous être inscrit ! Vérifiez votre adresse email pour continuer</p>
        </div>

        <!-- Success Message -->
        @if (session('status') == 'verification-link-sent')
            <div class="bg-green-50 border border-green-200 rounded-xl p-4 animate-slide-up">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-check text-green-600 text-sm"></i>
                    </div>
                    <p class="text-green-800 text-sm font-medium">
                        Un nouveau lien de vérification a été envoyé à votre adresse email.
                    </p>
                </div>
            </div>
        @endif

        <!-- Info Card -->
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
            <div class="flex items-start space-x-3">
                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-info text-blue-600"></i>
                </div>
                <div>
                    <h4 class="text-blue-800 font-semibold mb-2">Prochaines étapes :</h4>
                    <ol class="text-blue-700 text-sm space-y-1 list-decimal list-inside">
                        <li>Vérifiez votre boîte de réception</li>
                        <li>Cliquez sur le lien de vérification dans l'email</li>
                        <li>Revenez sur cette page si nécessaire</li>
                    </ol>
                    <p class="text-blue-700 text-sm mt-3">
                        Si vous n'avez pas reçu l'email, nous pouvons vous en envoyer un autre.
                    </p>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="space-y-4">
            <form method="POST" action="{{ route('verification.send') }}" class="w-full">
                @csrf
                <button 
                    type="submit" 
                    class="w-full btn-primary text-white font-bold py-3 px-4 rounded-xl flex items-center justify-center space-x-2"
                >
                    <i class="fas fa-paper-plane"></i>
                    <span>Renvoyer l'email de vérification</span>
                </button>
            </form>

            <div class="text-center">
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button 
                        type="submit" 
                        class="text-gray-600 hover:text-gray-800 font-medium transition-colors flex items-center justify-center space-x-2"
                    >
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Déconnexion</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
