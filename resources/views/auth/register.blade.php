<x-guest-layout>
    <!-- Register Form -->
    <div class="space-y-6" x-data="{ showPassword: false, showConfirmPassword: false }">
        <div class="text-center">
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Créer un compte</h3>
            <p class="text-gray-600">Rejoignez EasyColoc et simplifiez vos dépenses</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-user text-primary mr-2"></i> Nom complet
                </label>
                <input 
                    id="name" 
                    type="text" 
                    name="name" 
                    value="{{ old('name') }}" 
                    required 
                    autofocus 
                    autocomplete="name"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300"
                    placeholder="Jean Dupont"
                >
                @error('name')
                    <p class="mt-2 text-sm text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p>
                @enderror
            </div>

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
                    <i class="fas fa-lock text-primary mr-2"></i> Mot de passe
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

            <!-- Terms -->
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                <div class="flex items-start space-x-3">
                    <input 
                        type="checkbox" 
                        name="terms" 
                        required
                        class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary focus:ring-2 mt-1"
                    >
                    <div class="text-sm text-blue-800">
                        En créant un compte, vous acceptez nos 
                        <a href="#" class="font-medium underline hover:text-blue-900">conditions d'utilisation</a> 
                        et notre 
                        <a href="#" class="font-medium underline hover:text-blue-900">politique de confidentialité</a>.
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <button 
                type="submit" 
                class="w-full btn-primary text-white font-bold py-3 px-4 rounded-xl flex items-center justify-center space-x-2"
            >
                <i class="fas fa-user-plus"></i>
                <span>Créer mon compte</span>
            </button>
        </form>

        <!-- Login Link -->
        <div class="text-center">
            <p class="text-gray-600">
                Déjà un compte ? 
                <a href="{{ route('login') }}" class="text-primary hover:text-primary-800 font-medium transition-colors">
                    Se connecter
                </a>
            </p>
        </div>
    </div>
</x-guest-layout>
