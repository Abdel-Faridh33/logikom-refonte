<?php
session_start();
require_once 'config/database.php';
require_once 'includes/functions.php';

// Récupération des paramètres de filtrage
$selectedCategory = isset($_GET['category']) ? (int)$_GET['category'] : 0;
$selectedGrande = isset($_GET['grande']) ? (int)$_GET['grande'] : 0;
$search = isset($_GET['search']) ? sanitize($_GET['search']) : '';
$sortBy = isset($_GET['sort']) ? sanitize($_GET['sort']) : 'date';

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

    <!-- Boutique Section -->
    <section class="py-20 bg-gray-50 min-h-screen">
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
                    <a href="boutique.php" class="px-6 py-3 rounded-full transition-all duration-300 font-medium <?php echo $selectedGrande == 0 ? 'bg-blue-600 text-white shadow-lg' : 'bg-white text-gray-700 hover:bg-blue-50 hover:text-blue-600 shadow-md'; ?>">
                        Tous les produits
                    </a>
                    <?php foreach($categoriesGrandes as $grande): ?>
                        <a href="boutique.php?grande=<?php echo $grande['Id']; ?>" 
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
                            <a href="boutique.php?grande=<?php echo $selectedGrande; ?>" 
                               class="px-4 py-2 rounded-full transition-all duration-300 text-sm font-medium <?php echo $selectedCategory == 0 ? 'bg-blue-100 text-blue-700 border border-blue-300' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'; ?>">
                                Toutes
                            </a>
                            <?php foreach($subCategories as $category): ?>
                                <a href="boutique.php?grande=<?php echo $selectedGrande; ?>&category=<?php echo $category['Id']; ?>" 
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

            <!-- Back to Home -->
            <div class="bg-gray-50 py-8 mt-12">
                <div class="max-w-7xl mx-auto px-4 text-center">
                    <a href="index.php" class="text-blue-600 hover:text-blue-700 transition-colors">
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
</body>
</html>