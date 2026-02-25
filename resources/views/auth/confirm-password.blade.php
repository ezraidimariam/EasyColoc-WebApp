<x-guest-layout>
    <!-- Confirm Password -->
    <div class="space-y-6" x-data="{ showPassword: false }">
        <div class="text-center">
            <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-shield-alt text-orange-600 text-2xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Zone sécurisée</h3>
            <p class="text-gray-600">Veuillez confirmer votre mot de passe pour continuer</p>
        </div>

        <!-- Security Info -->
        <div class="bg-orange-50 border border-orange-200 rounded-xl p-4">
            <div class="flex items-start space-x-3">
                <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-lock text-orange-600 text-sm"></i>
                </div>
                <div class="text-sm text-orange-800">
                    Cette action nécessite une confirmation de votre identité pour protéger votre compte.
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
            @csrf

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-lock text-primary mr-2"></i> Mot de passe
                </label>
                <div class="relative">
                    <input 
                        id="password" 
                        :type="showPassword ? 'text' : 'password'"
                        name="password" 
                        required 
                        autocomplete="current-password"
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

            <!-- Submit Button -->
            <button 
                type="submit" 
                class="w-full btn-primary text-white font-bold py-3 px-4 rounded-xl flex items-center justify-center space-x-2"
            >
                <i class="fas fa-check"></i>
                <span>Confirmer et continuer</span>
            </button>
        </form>

        <!-- Cancel -->
        <div class="text-center">
            <a href="{{ url()->previous() }}" class="text-gray-600 hover:text-gray-800 font-medium transition-colors flex items-center justify-center space-x-2">
                <i class="fas fa-times"></i>
                <span>Annuler</span>
            </a>
        </div>
    </div>
</x-guest-layout>
