<header class="relative">
    <!-- Top Bar -->
    <div class="bg-slate-800 text-white py-2 px-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center text-sm">
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                    </svg>
                    <span>+229 01 91 93 93 93</span>
                </div>
                <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                    </svg>
                    <span>contact@groupelogikom.com</span>
                </div>
            </div>
            <div class="hidden md:block">
                <span>Lun - Ven: 8:00 - 20:00</span>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="index.php" class="logo">
                        <img src="assets/images/logo.png" alt="Logikom" width="50">
                    </a>
                    <div class="text-2xl font-bold text-slate-800">
                        Groupe<span class="text-red-600">Logikom</span>
                    </div>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="index.php"
                        class="text-gray-700 hover:text-blue-600 transition-colors duration-200 font-medium">Accueil</a>
                    <a href="#services"
                        class="text-gray-700 hover:text-blue-600 transition-colors duration-200 font-medium">Services</a>
                    <a href="#solutions"
                        class="text-gray-700 hover:text-blue-600 transition-colors duration-200 font-medium">Solutions</a>
                    <a href="boutique.php"
                        class="text-gray-700 hover:text-blue-600 transition-colors duration-200 font-medium">Boutique</a>
                    <a href="#apropos"
                        class="text-gray-700 hover:text-blue-600 transition-colors duration-200 font-medium">À
                        propos</a>
                    <a href="#contact"
                        class="text-gray-700 hover:text-blue-600 transition-colors duration-200 font-medium">Contact</a>

                    <?php if (isAdmin()): ?>
                        <a href="admin/"
                            class="text-gray-700 hover:text-blue-600 transition-colors duration-200 font-medium">Admin</a>
                    <?php endif; ?>

                    <button onclick="toggleCart()"
                        class="relative p-2 text-gray-700 hover:text-blue-600 transition-colors duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5-6M17 13v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2-2v6" />
                        </svg>
                        <span id="cart-count"
                            class="absolute -top-1 -right-1 bg-blue-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                            <?php echo getCartCount(getUserId()); ?>
                        </span>
                    </button>

                    <?php if (isLoggedIn()): ?>
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center space-x-2 text-gray-700">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                            </div>
                            <a href="auth/logout.php"
                                class="flex items-center space-x-2 text-gray-700 hover:text-red-600 transition-colors duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                <span>Déconnexion</span>
                            </a>
                        </div>
                    <?php else: ?>
                        <button onclick="openLoginModal()"
                            class="text-gray-700 hover:text-blue-600 transition-colors duration-200 font-medium">
                            Connexion
                        </button>
                    <?php endif; ?>

                    <button
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-full transition-all duration-200 transform hover:scale-105">
                        Devis Gratuit
                    </button>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button onclick="toggleMobileMenu()"
                        class="text-gray-700 hover:text-blue-600 transition-colors duration-200">
                        <svg id="menu-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg id="close-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="md:hidden bg-white border-t hidden">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <a href="index.php"
                        class="block px-3 py-2 text-gray-700 hover:text-blue-600 transition-colors duration-200">Accueil</a>
                    <a href="#services"
                        class="block px-3 py-2 text-gray-700 hover:text-blue-600 transition-colors duration-200">Services</a>
                    <a href="#solutions"
                        class="block px-3 py-2 text-gray-700 hover:text-blue-600 transition-colors duration-200">Solutions</a>
                    <a href="boutique.php"
                        class="block px-3 py-2 text-gray-700 hover:text-blue-600 transition-colors duration-200">Boutique</a>
                    <a href="#apropos"
                        class="block px-3 py-2 text-gray-700 hover:text-blue-600 transition-colors duration-200">À
                        propos</a>
                    <a href="#contact"
                        class="block px-3 py-2 text-gray-700 hover:text-blue-600 transition-colors duration-200">Contact</a>

                    <?php if (isAdmin()): ?>
                        <a href="admin/"
                            class="block px-3 py-2 text-gray-700 hover:text-blue-600 transition-colors duration-200">Admin</a>
                    <?php endif; ?>

                    <button onclick="toggleCart()"
                        class="w-full text-left px-3 py-2 text-gray-700 hover:text-blue-600 transition-colors duration-200 flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5-6M17 13v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2-2v6" />
                        </svg>
                        <span>Panier (<span
                                id="mobile-cart-count"><?php echo getCartCount(getUserId()); ?></span>)</span>
                    </button>

                    <?php if (isLoggedIn()): ?>
                        <div class="px-3 py-2 border-t">
                            <div class="flex items-center space-x-2 text-gray-700 mb-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                            </div>
                            <a href="auth/logout.php"
                                class="w-full text-left text-red-600 hover:text-red-700 transition-colors duration-200">
                                Déconnexion
                            </a>
                        </div>
                    <?php else: ?>
                        <button onclick="openLoginModal()"
                            class="w-full text-left px-3 py-2 text-gray-700 hover:text-blue-600 transition-colors duration-200">
                            Connexion
                        </button>
                    <?php endif; ?>

                    <button
                        class="w-full text-left bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded transition-colors duration-200">
                        Devis Gratuit
                    </button>
                </div>
            </div>
        </div>
    </nav>
</header>