<x-guest-layout>
    <!-- Forgot Password Form -->
    <div class="space-y-6">
        <div class="text-center">
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-lock text-blue-600 text-2xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Mot de passe oublié ?</h3>
            <p class="text-gray-600">Pas de problème, nous vous enverrons un lien de réinitialisation</p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="bg-green-50 border border-green-200 rounded-xl p-4 animate-slide-up">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-check text-green-600 text-sm"></i>
                    </div>
                    <p class="text-green-800 text-sm font-medium">{{ session('status') }}</p>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-envelope text-primary mr-2"></i> Adresse email
                </label>
                <input 
                    id="email" 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    required 
                    autofocus
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300"
                    placeholder="votre@email.com"
                >
                @error('email')
                    <p class="mt-2 text-sm text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Submit Button -->
            <button 
                type="submit" 
                class="w-full btn-primary text-white font-bold py-3 px-4 rounded-xl flex items-center justify-center space-x-2"
            >
                <i class="fas fa-paper-plane"></i>
                <span>Envoyer le lien de réinitialisation</span>
            </button>
        </form>

        <!-- Back to Login -->
        <div class="text-center">
            <a href="{{ route('login') }}" class="text-primary hover:text-primary-800 font-medium transition-colors flex items-center justify-center space-x-2">
                <i class="fas fa-arrow-left"></i>
                <span>Retour à la connexion</span>
            </a>
        </div>
    </div>
</x-guest-layout>
