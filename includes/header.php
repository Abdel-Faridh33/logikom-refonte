<header class="relative ">
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
                    <a href="<?php echo url('home.php'); ?>" class="min-w-fit">
                        <img src="<?php echo url('assets/images/logo.png'); ?>" alt="Logikom" width="50">
                    </a>
                    <div class="text-2xl font-bold text-slate-800">
                        Groupe<span class="text-red-600">Logikom</span>
                    </div>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <!-- Main page only Nav item -->
                    <?php if (basename($_SERVER['PHP_SELF']) === 'index.php'): ?>
                        <a href="<?php echo url('home.php'); ?>"
                            class="text-gray-700 hover:text-blue-600 transition-colors duration-200 font-medium">Qui sommes-nous ?</a>
                    <?php endif; ?>
                    <!-- Home page only Nav items -->
                    <?php if (basename($_SERVER['PHP_SELF']) === 'home.php'): ?>
                        <a href="#services"
                            class="text-gray-700 hover:text-blue-600 transition-colors duration-200 font-medium">Services</a>
                        <a href="#solutions"
                            class="text-gray-700 hover:text-blue-600 transition-colors duration-200 font-medium">Solutions</a>
                        <a href="#contact"
                            class="text-gray-700 hover:text-blue-600 transition-colors duration-200 font-medium">Contact</a>
                        <a href="<?php echo url('index.php'); ?>"
                            class="text-gray-700 hover:text-blue-600 transition-colors duration-200 font-medium">Boutique</a>
                    <?php endif; ?>

                    <!-- All pages -->
                    <?php if (isAdmin()): ?>
                        <a href="<?php echo url('admin/'); ?>"
                            class="text-gray-700 hover:text-blue-600 transition-colors duration-200 font-medium">Admin</a>
                    <?php endif; ?>

                    <!-- User Account / Login -->
                    <?php if (isLoggedIn()): ?>
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center space-x-2 text-gray-700">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                            </div>
                            <a href="<?php echo url('auth/logout.php'); ?>"
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
                    <a href="<?php echo url('home.php'); ?>"
                        class="block px-3 py-2 text-gray-700 hover:text-blue-600 transition-colors duration-200">Accueil</a>
                    <a href="#services"
                        class="block px-3 py-2 text-gray-700 hover:text-blue-600 transition-colors duration-200">Services</a>
                    <a href="#solutions"
                        class="block px-3 py-2 text-gray-700 hover:text-blue-600 transition-colors duration-200">Solutions</a>
                    <a href="<?php echo url('index.php'); ?>"
                        class="block px-3 py-2 text-gray-700 hover:text-blue-600 transition-colors duration-200">Boutique</a>
                    
                    <a href="#contact"
                        class="block px-3 py-2 text-gray-700 hover:text-blue-600 transition-colors duration-200">Contact</a>

                    <?php if (isAdmin()): ?>
                        <a href="<?php echo url('admin/'); ?>"
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
                            <a href="<?php echo url('auth/logout.php'); ?>"
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

<!-- Script pour le menu de catégories - Chargé immédiatement -->
<script>
    // Fonction pour ouvrir/fermer le menu des catégories
    function toggleCategoryMenu() {
        const menu = document.getElementById('categoryMenu');
        const overlay = document.getElementById('categoryMenuOverlay');

        if (!menu || !overlay) {
            console.error('Menu ou overlay non trouvé');
            return;
        }

        const isMenuHidden = menu.classList.contains('-translate-x-full');

        if (isMenuHidden) {
            // Ouvrir le menu
            console.log('Ouverture du menu');
            menu.classList.remove('-translate-x-full');
            menu.classList.add('translate-x-0');
            overlay.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        } else {
            // Fermer le menu
            console.log('Fermeture du menu');
            menu.classList.add('-translate-x-full');
            menu.classList.remove('translate-x-0');
            overlay.classList.add('hidden');
            document.body.style.overflow = '';
        }
    }

    // Fermer le menu avec la touche Escape
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            const menu = document.getElementById('categoryMenu');
            if (menu && !menu.classList.contains('-translate-x-full')) {
                toggleCategoryMenu();
            }
        }
    });

    // Gérer l'affichage des dropdowns au survol avec JavaScript
    document.addEventListener('DOMContentLoaded', function () {
        const categoryItems = document.querySelectorAll('.sidebar-category-item');
        console.log('🔍 Dropdowns sidebar - Nombre de catégories:', categoryItems.length);

        categoryItems.forEach(function (item, index) {
            const dropdown = item.querySelector('.sidebar-dropdown');

            if (dropdown) {
                console.log('✓ Dropdown trouvé pour catégorie', index);

                // Au survol de l'item de catégorie
                item.addEventListener('mouseenter', function () {
                    console.log('→ Survol catégorie', index);

                    // Calculer la position du dropdown
                    const rect = item.getBoundingClientRect();
                    const dropdownWidth = 288; // w-72 = 18rem = 288px

                    // Calculer la hauteur maximale pour ne pas dépasser l'écran
                    const windowHeight = window.innerHeight;
                    const spaceBelow = windowHeight - rect.top;
                    const maxHeight = Math.min(spaceBelow - 20, windowHeight * 0.8); // 80% de la hauteur d'écran max, avec marge de 20px

                    // Positionner le dropdown à droite de l'item
                    dropdown.style.left = rect.right + 'px';
                    dropdown.style.top = rect.top + 'px';
                    dropdown.style.maxHeight = maxHeight + 'px';

                    // Afficher le dropdown
                    dropdown.classList.add('show');

                    console.log('  Position - left:', rect.right, 'top:', rect.top, 'maxHeight:', maxHeight);
                });

                // Quand on quitte l'item de catégorie
                item.addEventListener('mouseleave', function (e) {
                    // Vérifier si la souris va vers le dropdown
                    const isGoingToDropdown = dropdown.contains(e.relatedTarget);
                    if (!isGoingToDropdown) {
                        console.log('← Sortie catégorie', index);
                        dropdown.classList.remove('show');
                    }
                });

                // Garder le dropdown ouvert quand on le survole
                dropdown.addEventListener('mouseenter', function () {
                    dropdown.classList.add('show');
                });

                // Fermer le dropdown quand on le quitte
                dropdown.addEventListener('mouseleave', function () {
                    dropdown.classList.remove('show');
                });
            } else {
                console.warn('✗ Pas de dropdown pour catégorie', index);
            }
        });
    });
</script>

<!-- Modal/Sidebar Catégories - Style Amazon avec Dropdown au Survol -->
<div id="categoryMenuOverlay" class="fixed inset-0 bg-black bg-opacity-50 hidden transition-opacity"
    style="z-index: 9998;" onclick="toggleCategoryMenu()"></div>
<div id="categoryMenu"
    class="fixed top-0 left-0 h-full w-80 bg-white shadow-2xl transform -translate-x-full transition-transform duration-300 ease-in-out"
    style="z-index: 9999;">
    <!-- Header du menu -->
    <div class="bg-gray-800 text-white p-4 flex items-center justify-between">
        <div class="flex items-center space-x-2">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
            </svg>
            <span class="font-bold text-lg">Toutes les Catégories</span>
        </div>
        <button onclick="toggleCategoryMenu()" class="text-white hover:text-gray-300 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Contenu du menu avec dropdowns au survol - Scroll interne -->
    <div class="py-2 overflow-y-auto" style="height: calc(100vh - 4rem); z-index: 9999;">
        <!-- Lien vers toutes les catégories -->
        <div class="border-b-2 border-gray-200 py-3 px-4 bg-gray-50">
            <a href="<?php echo url('index.php'); ?>"
                class="text-gray-900 font-bold hover:text-blue-600 flex items-center justify-between transition-colors">
                <span>Tous les produits</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        <!-- Catégories avec dropdown au survol -->
        <?php
        $allCategories = getCategoriesGrandes();
        foreach ($allCategories as $grandeCategory):
            $subCategories = getCategoriesByGrande($grandeCategory['Id']);
            ?>
            <div class="sidebar-category-item relative border-b border-gray-200">
                <!-- Grande Catégorie -->
                <a href="<?php echo urlWithParams('index.php', ['grande' => $grandeCategory['Id']]); ?>"
                    class="flex items-center justify-between w-full px-4 py-3 hover:bg-blue-50 transition-colors group">
                    <span class="font-semibold text-gray-900 group-hover:text-blue-600">
                        <?php echo htmlspecialchars($grandeCategory['Nom']); ?>
                    </span>
                    <?php if (!empty($subCategories)): ?>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-600 transition-colors" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    <?php endif; ?>
                </a>

                <!-- Dropdown des sous-catégories (apparaît au survol) -->
                <?php if (!empty($subCategories)): ?>
                    <div class="sidebar-dropdown w-72 bg-white shadow-2xl border border-gray-200">
                        <div class="py-2 max-h-[calc(100vh-8rem)] overflow-y-auto">
                            <!-- En-tête du dropdown -->
                            <div class="px-4 py-3 bg-gray-50 border-b border-gray-200 sticky top-0">
                                <h3 class="font-bold text-gray-900 text-sm">
                                    <?php echo htmlspecialchars($grandeCategory['Nom']); ?>
                                </h3>
                            </div>

                            <!-- Lien "Voir tout" -->
                            <a href="<?php echo urlWithParams('index.php', ['grande' => $grandeCategory['Id']]); ?>"
                                class="block px-4 py-2.5 hover:bg-blue-50 hover:text-blue-600 transition-colors font-semibold text-sm border-b border-gray-200">
                                <div class="flex items-center justify-between">
                                    <span>Voir tout</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </div>
                            </a>

                            <!-- Sous-catégories -->
                            <?php foreach ($subCategories as $subCat): ?>
                                <a href="<?php echo urlWithParams('index.php', ['grande' => $grandeCategory['Id'], 'category' => $subCat['Id']]); ?>"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 hover:pl-6 transition-all">
                                    <?php echo htmlspecialchars($subCat['Nom']); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>