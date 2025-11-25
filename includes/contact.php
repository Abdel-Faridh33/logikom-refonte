<section id="contact" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">
                Contactez <span class="text-blue-600">Nos Experts</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Prêt à transformer votre infrastructure IT ? Nos experts vous accompagnent
            </p>
        </div>

        <div class="grid lg:grid-cols-2 gap-16">
            <!-- Contact Form -->
            <div class="bg-gray-50 p-8 rounded-2xl">
                <h3 class="text-2xl font-bold text-gray-900 mb-8">Demande de Devis Gratuit</h3>
                <form id="contact-form" class="space-y-6">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="nom" class="block text-sm font-medium text-gray-700 mb-2">
                                Nom Complet *
                            </label>
                            <input type="text" id="nom" name="nom" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all duration-200"
                                   placeholder="Jean Dupont">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email Professionnel *
                            </label>
                            <input type="email" id="email" name="email" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all duration-200"
                                   placeholder="jean@entreprise.com">
                        </div>
                    </div>
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="telephone" class="block text-sm font-medium text-gray-700 mb-2">
                                Téléphone
                            </label>
                            <input type="tel" id="telephone" name="telephone"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all duration-200"
                                   placeholder="+229 01 91 93 93 93">
                        </div>
                        <div>
                            <label for="entreprise" class="block text-sm font-medium text-gray-700 mb-2">
                                Entreprise
                            </label>
                            <input type="text" id="entreprise" name="entreprise"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all duration-200"
                                   placeholder="Nom de votre entreprise">
                        </div>
                    </div>
                    
                    <div>
                        <label for="sujet" class="block text-sm font-medium text-gray-700 mb-2">
                            Sujet de votre demande
                        </label>
                        <select id="sujet" name="sujet"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all duration-200">
                            <option value="">Sélectionnez un sujet</option>
                            <option value="infrastructure">Infrastructure IT</option>
                            <option value="cybersecurite">Cybersécurité</option>
                            <option value="cloud">Solutions Cloud</option>
                            <option value="developpement">Développement</option>
                            <option value="support">Support Technique</option>
                            <option value="autre">Autre</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                            Décrivez votre projet *
                        </label>
                        <textarea id="message" name="message" rows="6" required
                                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all duration-200"
                                  placeholder="Décrivez vos besoins, objectifs et contraintes..."></textarea>
                    </div>
                    
                    <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-xl transition-all duration-300 transform hover:scale-105 font-semibold shadow-lg">
                        Envoyer la Demande
                    </button>
                </form>
            </div>

            <!-- Contact Information -->
            <div class="space-y-8">
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-8">Informations de Contact</h3>
                    
                    <div class="space-y-6">
                        <div class="flex items-start space-x-4">
                            <div class="bg-blue-600 p-3 rounded-xl">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-1">Adresse</h4>
                                <p class="text-gray-600">Agontinkon<br>Cotonou, Bénin</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="bg-blue-600 p-3 rounded-xl">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-1">Téléphone</h4>
                                <p class="text-gray-600">+229 01 91 93 93 93</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="bg-blue-600 p-3 rounded-xl">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-1">Email</h4>
                                <p class="text-gray-600">contact@groupelogikom.com</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="bg-blue-600 p-3 rounded-xl">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-1">Horaires</h4>
                                <p class="text-gray-600">
                                    Lundi - Vendredi: 8:00 -20:00<br>
                                    Samedi: 9:00 - 15:00<br>
                                    Support 24/7 disponible
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Certifications -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 p-8 rounded-2xl text-white">
                    <h4 class="text-xl font-bold mb-4">Certifications & Partenaires</h4>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-white rounded-full"></div>
                            <span>ISO 27001</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-white rounded-full"></div>
                            <span>Microsoft Partner</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-white rounded-full"></div>
                            <span>AWS Certified</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-white rounded-full"></div>
                            <span>Cisco Partner</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>