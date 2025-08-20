<section id="solutions" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">
                Nos <span class="text-blue-600">Solutions</span> Métier
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Des solutions technologiques adaptées à chaque secteur d'activité
            </p>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Solution Tabs -->
            <div class="lg:col-span-1">
                <div class="space-y-2">
                    <button onclick="showSolution('infrastructure')" id="solution-infrastructure" 
                            class="solution-tab w-full text-left p-4 rounded-xl transition-all duration-300 flex items-center space-x-3 bg-blue-600 text-white shadow-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span class="font-medium">Infrastructure</span>
                    </button>
                    
                    <button onclick="showSolution('reseau')" id="solution-reseau" 
                            class="solution-tab w-full text-left p-4 rounded-xl transition-all duration-300 flex items-center space-x-3 bg-gray-50 text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"/>
                        </svg>
                        <span class="font-medium">Réseau</span>
                    </button>
                    
                    <button onclick="showSolution('securite')" id="solution-securite" 
                            class="solution-tab w-full text-left p-4 rounded-xl transition-all duration-300 flex items-center space-x-3 bg-gray-50 text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <span class="font-medium">Sécurité</span>
                    </button>
                    
                    <button onclick="showSolution('developpement')" id="solution-developpement" 
                            class="solution-tab w-full text-left p-4 rounded-xl transition-all duration-300 flex items-center space-x-3 bg-gray-50 text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                        </svg>
                        <span class="font-medium">Développement</span>
                    </button>
                    
                    <button onclick="showSolution('support')" id="solution-support" 
                            class="solution-tab w-full text-left p-4 rounded-xl transition-all duration-300 flex items-center space-x-3 bg-gray-50 text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span class="font-medium">Support</span>
                    </button>
                </div>
            </div>

            <!-- Solution Content -->
            <div class="lg:col-span-2">
                <div id="solution-content-infrastructure" class="solution-content bg-gray-50 rounded-2xl overflow-hidden">
                    <img src="https://images.pexels.com/photos/325229/pexels-photo-325229.jpeg?auto=compress&cs=tinysrgb&w=600&h=400&fit=crop" 
                         alt="Infrastructure IT Complète" class="w-full h-64 object-cover">
                    <div class="p-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Infrastructure IT Complète</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            Solutions d'infrastructure robustes et évolutives pour votre entreprise.
                        </p>
                        
                        <div class="grid md:grid-cols-2 gap-4 mb-8">
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-blue-600 rounded-full"></div>
                                <span class="text-gray-700">Serveurs haute performance</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-blue-600 rounded-full"></div>
                                <span class="text-gray-700">Réseaux sécurisés</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-blue-600 rounded-full"></div>
                                <span class="text-gray-700">Stockage centralisé</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-blue-600 rounded-full"></div>
                                <span class="text-gray-700">Virtualisation avancée</span>
                            </div>
                        </div>
                        
                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl transition-colors duration-300 font-medium">
                            En Savoir Plus
                        </button>
                    </div>
                </div>

                <!-- Autres contenus de solutions (cachés par défaut) -->
                <div id="solution-content-reseau" class="solution-content bg-gray-50 rounded-2xl overflow-hidden hidden">
                    <img src="https://images.pexels.com/photos/159304/network-cable-ethernet-computer-159304.jpeg?auto=compress&cs=tinysrgb&w=600&h=400&fit=crop" 
                         alt="Solutions Réseau Avancées" class="w-full h-64 object-cover">
                    <div class="p-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Solutions Réseau Avancées</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            Conception et déploiement de réseaux performants et sécurisés.
                        </p>
                        
                        <div class="grid md:grid-cols-2 gap-4 mb-8">
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-blue-600 rounded-full"></div>
                                <span class="text-gray-700">Architecture réseau optimisée</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-blue-600 rounded-full"></div>
                                <span class="text-gray-700">Wi-Fi entreprise</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-blue-600 rounded-full"></div>
                                <span class="text-gray-700">Monitoring 24/7</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-blue-600 rounded-full"></div>
                                <span class="text-gray-700">Redondance garantie</span>
                            </div>
                        </div>
                        
                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl transition-colors duration-300 font-medium">
                            En Savoir Plus
                        </button>
                    </div>
                </div>

                <!-- Autres solutions... -->
            </div>
        </div>
    </div>
</section>