<div id="login-modal" class="fixed inset-0 z-50 overflow-hidden hidden">
    <div class="absolute inset-0 bg-black bg-opacity-50" onclick="closeLoginModal()"></div>
    
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-md bg-white rounded-2xl shadow-2xl">
        <div class="p-8">
            <!-- Header -->
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-bold text-gray-900">Connexion</h2>
                <button onclick="closeLoginModal()" class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Demo Info -->
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-6">
                <h3 class="font-semibold text-blue-900 mb-2">Compte de démonstration</h3>
                <p class="text-sm text-blue-700 mb-2">
                    Utilisez ces identifiants pour accéder à l'interface admin :
                </p>
                <div class="text-sm text-blue-800 font-mono">
                    <div>Nom d'utilisateur: <strong>admin</strong></div>
                    <div>Mot de passe: <strong>admin</strong></div>
                </div>
            </div>

            <!-- Form -->
            <form id="login-form" onsubmit="handleLogin(event)">
                <div id="login-error" class="bg-red-50 border border-red-200 rounded-xl p-4 flex items-center space-x-2 mb-6 hidden">
                    <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-red-700">Nom d'utilisateur ou mot de passe incorrect</span>
                </div>

                <div class="mb-6">
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-2">
                        Nom d'utilisateur
                    </label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                        </svg>
                        <input type="text" id="username" name="username" required
                               class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                               placeholder="Entrez votre nom d'utilisateur">
                    </div>
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Mot de passe
                    </label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <input type="password" id="password" name="password" required
                               class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                               placeholder="Entrez votre mot de passe">
                    </div>
                </div>

                <button type="submit" id="login-submit" 
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl transition-colors duration-300 font-semibold">
                    Se connecter
                </button>
            </form>
        </div>
    </div>
</div>