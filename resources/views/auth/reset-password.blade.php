<x-guest-layout>
    <!-- Reset Password Form -->
    <div class="space-y-6" x-data="{ showPassword: false, showConfirmPassword: false }">
        <div class="text-center">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-key text-green-600 text-2xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Réinitialiser le mot de passe</h3>
            <p class="text-gray-600">Choisissez votre nouveau mot de passe</p>
        </div>

        <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-envelope text-primary mr-2"></i> Adresse email
                </label>
                <input 
                    id="email" 
                    type="email" 
                    name="email" 
                    value="{{ old('email', $request->email) }}" 
                    required 
                    autofocus 
                    autocomplete="username"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300"
                    placeholder="votre@email.com"
                >
                @error('email')
                    <p class="mt-2 text-sm text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-lock text-primary mr-2"></i> Nouveau mot de passe
                </label>
                <div class="relative">
                    <input 
                        id="password" 
                        :type="showPassword ? 'text' : 'password'"
                        name="password" 
                        required 
                        autocomplete="new-password"
                        class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300"
                        placeholder="••••••••"
                    >
                    <button 
                        type="button" 
                        @click="showPassword = !showPassword"
                        class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700"
                    >
                        <i class="fas" :class="showPassword ? 'fa-eye-slash' : 'fa-eye'"></i>
                    </button>
                </div>
                @error('password')
                    <p class="mt-2 text-sm text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-lock text-primary mr-2"></i> Confirmer le mot de passe
                </label>
                <div class="relative">
                    <input 
                        id="password_confirmation" 
                        :type="showConfirmPassword ? 'text' : 'password'"
                        name="password_confirmation" 
                        required 
                        autocomplete="new-password"
                        class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300"
                        placeholder="••••••••"
                    >
                    <button 
                        type="button" 
                        @click="showConfirmPassword = !showConfirmPassword"
                        class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700"
                    >
                        <i class="fas" :class="showConfirmPassword ? 'fa-eye-slash' : 'fa-eye'"></i>
                    </button>
                </div>
                @error('password_confirmation')
                    <p class="mt-2 text-sm text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Password Requirements -->
            <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4">
                <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-info text-yellow-600 text-sm"></i>
                    </div>
                    <div class="text-sm text-yellow-800">
                        <p class="font-semibold mb-1">Conseils de sécurité :</p>
                        <ul class="list-disc list-inside space-y-1">
                            <li>Utilisez au moins 8 caractères</li>
                            <li>Incluez des majuscules, minuscules et chiffres</li>
                            <li>Ajoutez des caractères spéciaux pour plus de sécurité</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <button 
                type="submit" 
                class="w-full btn-primary text-white font-bold py-3 px-4 rounded-xl flex items-center justify-center space-x-2"
            >
                <i class="fas fa-check"></i>
                <span>Réinitialiser le mot de passe</span>
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
