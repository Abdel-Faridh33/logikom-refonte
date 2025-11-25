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
                    <button onclick="showSolution('securite')" id="solution-securite"
                            class="solution-tab w-full text-left p-4 rounded-xl transition-all duration-300 flex items-center space-x-3 bg-blue-600 text-white shadow-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                        <span class="font-medium">Sécurité & Vidéo-Surveillance</span>
                    </button>

                    <button onclick="showSolution('reseau')" id="solution-reseau"
                            class="solution-tab w-full text-left p-4 rounded-xl transition-all duration-300 flex items-center space-x-3 bg-gray-50 text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"/>
                        </svg>
                        <span class="font-medium">Réseau & Maintenance</span>
                    </button>

                    <button onclick="showSolution('telecom')" id="solution-telecom"
                            class="solution-tab w-full text-left p-4 rounded-xl transition-all duration-300 flex items-center space-x-3 bg-gray-50 text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span class="font-medium">Télécom & Domotique</span>
                    </button>
                </div>
            </div>

            <!-- Solution Content -->
            <div class="lg:col-span-2">
                <!-- Sécurité & Vidéo-Surveillance -->
                <div id="solution-content-securite" class="solution-content bg-gray-50 rounded-2xl overflow-hidden">
                    <img src="https://images.pexels.com/photos/430208/pexels-photo-430208.jpeg?auto=compress&cs=tinysrgb&w=600&h=400&fit=crop"
                         alt="Sécurité & Vidéo-Surveillance" class="w-full h-64 object-cover">
                    <div class="p-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Sécurité & Vidéo-Surveillance</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            Protégez vos locaux avec nos solutions de sécurité professionnelles et performantes. De la simple caméra de surveillance au système de contrôle d'accès biométrique, nous avons la solution adaptée à vos besoins.
                        </p>

                        <div class="grid md:grid-cols-2 gap-4 mb-8">
                            <div class="flex items-start space-x-3">
                                <div class="w-2 h-2 bg-red-600 rounded-full mt-2"></div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Caméra de surveillance</h4>
                                    <p class="text-sm text-gray-600">Systèmes HD, 4K, avec vision nocturne</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="w-2 h-2 bg-red-600 rounded-full mt-2"></div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Barbelé électrique</h4>
                                    <p class="text-sm text-gray-600">Périmètre sécurisé électrifié</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="w-2 h-2 bg-red-600 rounded-full mt-2"></div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Contrôle d'accès biométrique</h4>
                                    <p class="text-sm text-gray-600">Empreintes, visage, badges RFID</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="w-2 h-2 bg-red-600 rounded-full mt-2"></div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Formation</h4>
                                    <p class="text-sm text-gray-600">Formation de vos équipes</p>
                                </div>
                            </div>
                        </div>

                        <a href="index.php" class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-xl transition-colors duration-300 font-medium inline-block">
                            Voir nos Produits
                        </a>
                    </div>
                </div>

                <!-- Réseau & Maintenance -->
                <div id="solution-content-reseau" class="solution-content bg-gray-50 rounded-2xl overflow-hidden hidden">
                    <img src="https://images.pexels.com/photos/159304/network-cable-ethernet-computer-159304.jpeg?auto=compress&cs=tinysrgb&w=600&h=400&fit=crop"
                         alt="Réseau & Maintenance" class="w-full h-64 object-cover">
                    <div class="p-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Réseau & Maintenance</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            Conception, installation et maintenance de réseaux informatiques, télécoms, acoustiques et électriques. Nous assurons la performance et la sécurité de votre infrastructure réseau.
                        </p>

                        <div class="grid md:grid-cols-2 gap-4 mb-8">
                            <div class="flex items-start space-x-3">
                                <div class="w-2 h-2 bg-blue-600 rounded-full mt-2"></div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Réseau informatique et Télécom</h4>
                                    <p class="text-sm text-gray-600">Infrastructure LAN/WAN, fibre optique</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="w-2 h-2 bg-blue-600 rounded-full mt-2"></div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Réseau Acoustique</h4>
                                    <p class="text-sm text-gray-600">Sonorisation professionnelle</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="w-2 h-2 bg-blue-600 rounded-full mt-2"></div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Réseau électrique et électronique</h4>
                                    <p class="text-sm text-gray-600">Installation et câblage électrique</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="w-2 h-2 bg-blue-600 rounded-full mt-2"></div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Maintenance et Sécurité Réseau</h4>
                                    <p class="text-sm text-gray-600">Support et monitoring 24/7</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="w-2 h-2 bg-blue-600 rounded-full mt-2"></div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Formation</h4>
                                    <p class="text-sm text-gray-600">Formation de vos équipes techniques</p>
                                </div>
                            </div>
                        </div>

                        <a href="index.php" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl transition-colors duration-300 font-medium inline-block">
                            Voir nos Produits
                        </a>
                    </div>
                </div>

                <!-- Télécom & Domotique -->
                <div id="solution-content-telecom" class="solution-content bg-gray-50 rounded-2xl overflow-hidden hidden">
                    <img src="https://images.pexels.com/photos/1571460/pexels-photo-1571460.jpeg?auto=compress&cs=tinysrgb&w=600&h=400&fit=crop"
                         alt="Télécom & Domotique" class="w-full h-64 object-cover">
                    <div class="p-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Télécom & Domotique</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            Solutions de télécommunication modernes et domotique intelligente pour automatiser et sécuriser vos espaces. Transformez votre maison ou bureau en espace connecté et intelligent.
                        </p>

                        <div class="grid md:grid-cols-2 gap-4 mb-8">
                            <div class="flex items-start space-x-3">
                                <div class="w-2 h-2 bg-green-600 rounded-full mt-2"></div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Téléphone analogique & VoIP</h4>
                                    <p class="text-sm text-gray-600">Systèmes de téléphonie modernes</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="w-2 h-2 bg-green-600 rounded-full mt-2"></div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Contrôle de locaux à distance</h4>
                                    <p class="text-sm text-gray-600">Gestion à distance via smartphone</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="w-2 h-2 bg-green-600 rounded-full mt-2"></div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Automatisation des portes</h4>
                                    <p class="text-sm text-gray-600">Portes automatiques sécurisées</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="w-2 h-2 bg-green-600 rounded-full mt-2"></div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Maison Intelligente</h4>
                                    <p class="text-sm text-gray-600">Domotique complète, éclairage, climat</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="w-2 h-2 bg-green-600 rounded-full mt-2"></div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Formation</h4>
                                    <p class="text-sm text-gray-600">Formation utilisateurs et installateurs</p>
                                </div>
                            </div>
                        </div>

                        <a href="index.php" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl transition-colors duration-300 font-medium inline-block">
                            Voir nos Produits
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>