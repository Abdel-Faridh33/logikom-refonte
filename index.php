<?php
session_start();
require_once 'config/database.php';
require_once 'includes/functions.php';

// Récupération des paramètres de filtrage
$selectedCategory = isset($_GET['category']) ? (int)$_GET['category'] : 0;
$selectedGrande = isset($_GET['grande']) ? (int)$_GET['grande'] : 0;
$search = isset($_GET['search']) ? sanitize($_GET['search']) : '';
$sortBy = isset($_GET['sort']) ? sanitize($_GET['sort']) : 'date';
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;

// Configuration de la pagination
$itemsPerPage = 15;
$offset = ($page - 1) * $itemsPerPage;

// Récupération des données
$categoriesGrandes = getCategoriesGrandes();
$categories = getCategories();

// Construction de la requête pour les produits
$query = "
    SELECT a.*, c.Nom as NomCategorie, cg.Nom as NomGrande
    FROM commerce_article a
    JOIN commerce_categorie c ON a.Categorie = c.Id
    JOIN commerce_categorie_grande cg ON c.Grande = cg.Id
    WHERE 1=1
";
$params = [];

if ($selectedGrande > 0) {
    $query .= " AND cg.Id = ?";
    $params[] = $selectedGrande;
}

if ($selectedCategory > 0) {
    $query .= " AND c.Id = ?";
    $params[] = $selectedCategory;
}

if ($search) {
    $query .= " AND (a.Titre LIKE ? OR a.Resume LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

// Compter le nombre total de produits pour la pagination
$countQuery = "
    SELECT COUNT(*) as total
    FROM commerce_article a
    JOIN commerce_categorie c ON a.Categorie = c.Id
    JOIN commerce_categorie_grande cg ON c.Grande = cg.Id
    WHERE 1=1
";
if ($selectedGrande > 0) {
    $countQuery .= " AND cg.Id = ?";
}
if ($selectedCategory > 0) {
    $countQuery .= " AND c.Id = ?";
}
if ($search) {
    $countQuery .= " AND (a.Titre LIKE ? OR a.Resume LIKE ?)";
}

$totalResult = fetchOne($countQuery, $params);
$totalProducts = $totalResult['total'];
$totalPages = ceil($totalProducts / $itemsPerPage);

// Tri
switch ($sortBy) {
    case 'price_asc':
        $query .= " ORDER BY a.Prix_reduction ASC";
        break;
    case 'price_desc':
        $query .= " ORDER BY a.Prix_reduction DESC";
        break;
    case 'name':
        $query .= " ORDER BY a.Titre ASC";
        break;
    default:
        $query .= " ORDER BY a.Date DESC";
}

// Ajouter la pagination à la requête (en utilisant des valeurs directes car PDO ne gère pas toujours bien LIMIT/OFFSET comme paramètres)
$query .= " LIMIT " . (int)$itemsPerPage . " OFFSET " . (int)$offset;

$products = fetchAll($query, $params);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boutique - Groupe Logikom</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Header -->
    <?php include 'includes/header.php'; ?>

    <!-- Carousel Section -->
    <section class="relative w-full overflow-hidden bg-gray-900">
        <div class="relative h-[400px] md:h-[500px]">
            <!-- Slide 1 -->
            <div class="carousel-slide absolute inset-0 transition-opacity duration-700 opacity-100">
                <img src="assets/images/baniere_drones1.png" alt="Banner 1" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                    <div class="text-center text-white px-4">
                        <h2 class="text-4xl md:text-5xl font-bold mb-4">Drones Professionnelles</h2>
                        <p class="text-xl md:text-2xl mb-6">Équipez d'un drone avec les meilleurs performances</p>
                        <a href="#products" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-full transition-all duration-300 transform hover:scale-105 inline-block">
                            Découvrir nos produits
                        </a>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="carousel-slide absolute inset-0 transition-opacity duration-700 opacity-0">
                <img src="assets/images/banner22.jpg" alt="Banner 2" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                    <div class="text-center text-white px-4">
                        <h2 class="text-4xl md:text-5xl font-bold mb-4">Sécurité & Vidéo-Surveillance</h2>
                        <p class="text-xl md:text-2xl mb-6">Des équipements de qualité pour votre sécurité</p>
                        <a href="#products" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-full transition-all duration-300 transform hover:scale-105 inline-block">
                            Explorer le catalogue
                        </a>
                    </div>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="carousel-slide absolute inset-0 transition-opacity duration-700 opacity-0">
                <img src="assets/images/banner22.png" alt="Banner 3" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                    <div class="text-center text-white px-4">
                        <h2 class="text-4xl md:text-5xl font-bold mb-4">Connectivité & Réseau</h2>
                        <p class="text-xl md:text-2xl mb-6">Assurer-vous une meilleur liaison avec votre équipe et vos proches</p>
                        <a href="#products" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-full transition-all duration-300 transform hover:scale-105 inline-block">
                            Voir nos solutions
                        </a>
                    </div>
                </div>
            </div>

            <!-- Navigation Arrows -->
            <button onclick="previousSlide()" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-50 hover:bg-opacity-75 text-gray-800 p-3 rounded-full transition-all duration-300 z-10">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <button onclick="nextSlide()" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-50 hover:bg-opacity-75 text-gray-800 p-3 rounded-full transition-all duration-300 z-10">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>

            <!-- Dots Indicator -->
            <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2 z-10">
                <button onclick="goToSlide(0)" class="carousel-dot w-3 h-3 rounded-full bg-white transition-all duration-300"></button>
                <button onclick="goToSlide(1)" class="carousel-dot w-3 h-3 rounded-full bg-white bg-opacity-50 transition-all duration-300"></button>
                <button onclick="goToSlide(2)" class="carousel-dot w-3 h-3 rounded-full bg-white bg-opacity-50 transition-all duration-300"></button>
            </div>
        </div>
    </section>

    <!-- Boutique Section -->
    <section id="products" class="py-20 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">
                    Boutique <span class="text-blue-600">Logikom</span>
                </h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Découvrez notre sélection de produits IT professionnels
                </p>
            </div>

            <!-- Categories Grandes -->
            <div class="mb-8">
                <div class="flex flex-wrap gap-4 justify-center">
                    <a href="index.php" class="px-6 py-3 rounded-full transition-all duration-300 font-medium <?php echo $selectedGrande == 0 ? 'bg-blue-600 text-white shadow-lg' : 'bg-white text-gray-700 hover:bg-blue-50 hover:text-blue-600 shadow-md'; ?>">
                        Tous les produits
                    </a>
                    <?php foreach($categoriesGrandes as $grande): ?>
                        <a href="index.php?grande=<?php echo $grande['Id']; ?>" 
                           class="px-6 py-3 rounded-full transition-all duration-300 font-medium <?php echo $selectedGrande == $grande['Id'] ? 'bg-blue-600 text-white shadow-lg' : 'bg-white text-gray-700 hover:bg-blue-50 hover:text-blue-600 shadow-md'; ?>">
                            <?php echo htmlspecialchars($grande['Nom']); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Sous-catégories -->
            <?php if ($selectedGrande > 0): ?>
                <?php $subCategories = getCategoriesByGrande($selectedGrande); ?>
                <?php if (!empty($subCategories)): ?>
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Sous-catégories</h3>
                        <div class="flex flex-wrap gap-3">
                            <a href="index.php?grande=<?php echo $selectedGrande; ?>" 
                               class="px-4 py-2 rounded-full transition-all duration-300 text-sm font-medium <?php echo $selectedCategory == 0 ? 'bg-blue-100 text-blue-700 border border-blue-300' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'; ?>">
                                Toutes
                            </a>
                            <?php foreach($subCategories as $category): ?>
                                <a href="index.php?grande=<?php echo $selectedGrande; ?>&category=<?php echo $category['Id']; ?>" 
                                   class="px-4 py-2 rounded-full transition-all duration-300 text-sm font-medium <?php echo $selectedCategory == $category['Id'] ? 'bg-blue-100 text-blue-700 border border-blue-300' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'; ?>">
                                    <?php echo htmlspecialchars($category['Nom']); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <!-- Filters and Search -->
            <div class="bg-white p-6 rounded-2xl shadow-lg mb-8">
                <form method="GET" class="flex flex-col lg:flex-row gap-4 items-center justify-between">
                    <input type="hidden" name="grande" value="<?php echo $selectedGrande; ?>">
                    <input type="hidden" name="category" value="<?php echo $selectedCategory; ?>">
                    
                    <div class="flex-1 max-w-md">
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>"
                                   placeholder="Rechercher un produit..."
                                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-4">
                        <select name="sort" onchange="this.form.submit()" 
                                class="px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                            <option value="date" <?php echo $sortBy == 'date' ? 'selected' : ''; ?>>Plus récents</option>
                            <option value="name" <?php echo $sortBy == 'name' ? 'selected' : ''; ?>>Nom A-Z</option>
                            <option value="price_asc" <?php echo $sortBy == 'price_asc' ? 'selected' : ''; ?>>Prix croissant</option>
                            <option value="price_desc" <?php echo $sortBy == 'price_desc' ? 'selected' : ''; ?>>Prix décroissant</option>
                        </select>
                        
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl transition-colors">
                            Rechercher
                        </button>
                    </div>
                </form>
            </div>

            <!-- Products Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php if (empty($products)): ?>
                    <div class="col-span-full text-center py-12">
                        <p class="text-xl text-gray-500">Aucun produit trouvé</p>
                    </div>
                <?php else: ?>
                    <?php foreach($products as $product): ?>
                        <div onclick="window.location.href='produit.php?id=<?php echo $product['Id']; ?>'" 
                             class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 cursor-pointer group overflow-hidden">
                            <div class="relative">
                                <img src="uploads/<?php echo htmlspecialchars($product['Image']); ?>" 
                                     alt="<?php echo htmlspecialchars($product['Titre']); ?>"
                                     class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-300">
                                <?php if($product['Reduction'] > 0): ?>
                                    <div class="absolute top-4 left-4">
                                        <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                                            -<?php echo $product['Reduction']; ?>%
                                        </span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <div class="p-6">
                                <div class="text-sm text-blue-600 mb-2"><?php echo htmlspecialchars($product['NomGrande']); ?> > <?php echo htmlspecialchars($product['NomCategorie']); ?></div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors">
                                    <?php echo htmlspecialchars($product['Titre']); ?>
                                </h3>
                                <p class="text-gray-600 mb-4 line-clamp-2">
                                    <?php echo htmlspecialchars(substr($product['Resume'], 0, 100)) . '...'; ?>
                                </p>
                                
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <span class="text-2xl font-bold text-blue-600">
                                            <?php echo formatPrice($product['Prix_reduction']); ?>
                                        </span>
                                        <?php if($product['Reduction'] > 0): ?>
                                            <span class="text-lg text-gray-500 line-through">
                                                <?php echo formatPrice($product['Prix_norm']); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <button onclick="event.stopPropagation(); addToCart(<?php echo $product['Id']; ?>)" 
                                            class="bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-xl transition-colors duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5-6M17 13v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2-2v6"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- Pagination -->
            <?php if ($totalPages > 1): ?>
                <div class="flex flex-col items-center mt-12 space-y-4">
                    <!-- Info -->
                    <div class="text-gray-600 text-sm">
                        Affichage <?php echo min($offset + 1, $totalProducts); ?> - <?php echo min($offset + $itemsPerPage, $totalProducts); ?> sur <?php echo $totalProducts; ?> produits
                    </div>

                    <!-- Pagination Buttons -->
                    <div class="flex items-center space-x-2">
                        <!-- Previous Button -->
                        <?php if ($page > 1): ?>
                            <a href="?<?php echo http_build_query(array_merge($_GET, ['page' => $page - 1])); ?>"
                               class="flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                                Précédent
                            </a>
                        <?php else: ?>
                            <span class="flex items-center px-4 py-2 bg-gray-100 border border-gray-200 rounded-lg text-gray-400 cursor-not-allowed">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                                Précédent
                            </span>
                        <?php endif; ?>

                        <!-- Page Numbers -->
                        <div class="flex items-center space-x-1">
                            <?php
                            $startPage = max(1, $page - 2);
                            $endPage = min($totalPages, $page + 2);

                            // Première page
                            if ($startPage > 1): ?>
                                <a href="?<?php echo http_build_query(array_merge($_GET, ['page' => 1])); ?>"
                                   class="px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-blue-50 hover:border-blue-600 transition-colors">
                                    1
                                </a>
                                <?php if ($startPage > 2): ?>
                                    <span class="px-2 text-gray-500">...</span>
                                <?php endif; ?>
                            <?php endif; ?>

                            <!-- Pages du milieu -->
                            <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                                <?php if ($i == $page): ?>
                                    <span class="px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold">
                                        <?php echo $i; ?>
                                    </span>
                                <?php else: ?>
                                    <a href="?<?php echo http_build_query(array_merge($_GET, ['page' => $i])); ?>"
                                       class="px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-blue-50 hover:border-blue-600 transition-colors">
                                        <?php echo $i; ?>
                                    </a>
                                <?php endif; ?>
                            <?php endfor; ?>

                            <!-- Dernière page -->
                            <?php if ($endPage < $totalPages): ?>
                                <?php if ($endPage < $totalPages - 1): ?>
                                    <span class="px-2 text-gray-500">...</span>
                                <?php endif; ?>
                                <a href="?<?php echo http_build_query(array_merge($_GET, ['page' => $totalPages])); ?>"
                                   class="px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-blue-50 hover:border-blue-600 transition-colors">
                                    <?php echo $totalPages; ?>
                                </a>
                            <?php endif; ?>
                        </div>

                        <!-- Next Button -->
                        <?php if ($page < $totalPages): ?>
                            <a href="?<?php echo http_build_query(array_merge($_GET, ['page' => $page + 1])); ?>"
                               class="flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                                Suivant
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        <?php else: ?>
                            <span class="flex items-center px-4 py-2 bg-gray-100 border border-gray-200 rounded-lg text-gray-400 cursor-not-allowed">
                                Suivant
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Back to Home -->
            <div class="bg-gray-50 py-8 mt-12">
                <div class="max-w-7xl mx-auto px-4 text-center">
                    <a href="home.php" class="text-blue-600 hover:text-blue-700 transition-colors">
                        ← Retour à l'accueil
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

    <!-- Cart Modal -->
    <?php include 'includes/cart.php'; ?>

    <!-- Login Modal -->
    <?php include 'includes/login-modal.php'; ?>

    <script src="assets/js/main.js"></script>

    <!-- Carousel Script -->
    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.carousel-slide');
        const dots = document.querySelectorAll('.carousel-dot');
        const totalSlides = slides.length;
        let autoSlideInterval;

        function showSlide(index) {
            // Wrap around if index is out of bounds
            if (index >= totalSlides) {
                currentSlide = 0;
            } else if (index < 0) {
                currentSlide = totalSlides - 1;
            } else {
                currentSlide = index;
            }

            // Update slides
            slides.forEach((slide, i) => {
                if (i === currentSlide) {
                    slide.classList.remove('opacity-0');
                    slide.classList.add('opacity-100');
                } else {
                    slide.classList.remove('opacity-100');
                    slide.classList.add('opacity-0');
                }
            });

            // Update dots
            dots.forEach((dot, i) => {
                if (i === currentSlide) {
                    dot.classList.remove('bg-opacity-50');
                    dot.classList.add('bg-opacity-100');
                } else {
                    dot.classList.remove('bg-opacity-100');
                    dot.classList.add('bg-opacity-50');
                }
            });
        }

        function nextSlide() {
            showSlide(currentSlide + 1);
            resetAutoSlide();
        }

        function previousSlide() {
            showSlide(currentSlide - 1);
            resetAutoSlide();
        }

        function goToSlide(index) {
            showSlide(index);
            resetAutoSlide();
        }

        function resetAutoSlide() {
            clearInterval(autoSlideInterval);
            autoSlideInterval = setInterval(() => {
                nextSlide();
            }, 5000); // Change slide every 5 seconds
        }

        // Initialize auto-slide
        resetAutoSlide();

        // Pause auto-slide on hover
        const carouselSection = document.querySelector('.relative.w-full.overflow-hidden');
        if (carouselSection) {
            carouselSection.addEventListener('mouseenter', () => {
                clearInterval(autoSlideInterval);
            });

            carouselSection.addEventListener('mouseleave', () => {
                resetAutoSlide();
            });
        }
    </script>
</body>
</html>