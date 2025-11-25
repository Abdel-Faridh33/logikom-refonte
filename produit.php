<?php
session_start();
require_once 'config/database.php';
require_once 'includes/functions.php';

$productId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!$productId) {
    header('Location: index.php');
    exit;
}

$product = getProductById($productId);

if (!$product) {
    header('Location: index.php');
    exit;
}

// Récupérer les images du produit
$images = [];
for ($i = 0; $i <= 5; $i++) {
    $imageField = $i == 0 ? 'Image' : 'Image' . $i;
    if (!empty($product[$imageField])) {
        $images[] = $product[$imageField];
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['Titre']); ?> - Groupe Logikom</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Header -->
    <?php include 'includes/header.php'; ?>

    <!-- Product Detail -->
    <div class="py-20 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4">
            <!-- Back Button -->
            <a href="index.php" class="flex items-center space-x-2 text-blue-600 hover:text-blue-700 mb-8 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                <span>Retour à la boutique</span>
            </a>

            <div class="grid lg:grid-cols-2 gap-12">
                <!-- Product Images -->
                <div>
                    <div class="bg-white rounded-2xl p-6 shadow-lg mb-6">
                        <img id="main-image" src="assets/images/article//<?php echo htmlspecialchars($images[0]); ?>" 
                             alt="<?php echo htmlspecialchars($product['Titre']); ?>"
                             class="w-full h-96 object-cover rounded-xl">
                    </div>
                    
                    <?php if (count($images) > 1): ?>
                        <div class="flex space-x-4">
                            <?php foreach($images as $index => $image): ?>
                                <button onclick="changeMainImage('assets/images/article//<?php echo htmlspecialchars($image); ?>', this)"
                                        class="w-20 h-20 rounded-xl overflow-hidden border-2 border-gray-200 hover:border-gray-300 transition-all <?php echo $index === 0 ? 'border-blue-600' : ''; ?>">
                                    <img src="uploassets/images/article/ads/<?php echo htmlspecialchars($image); ?>" alt="" class="w-full h-full object-cover">
                                </button>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Product Info -->
                <div>
                    <div class="bg-white rounded-2xl p-8 shadow-lg">
                        <!-- Breadcrumb -->
                        <div class="text-sm text-gray-500 mb-4">
                            <?php echo htmlspecialchars($product['NomGrande']); ?> > <?php echo htmlspecialchars($product['NomCategorie']); ?>
                        </div>
                        
                        <h1 class="text-3xl font-bold text-gray-900 mb-6"><?php echo htmlspecialchars($product['Titre']); ?></h1>

                        <!-- Price -->
                        <div class="flex items-center space-x-4 mb-6">
                            <span class="text-4xl font-bold text-blue-600">
                                <?php echo formatPrice($product['Prix_reduction']); ?>
                            </span>
                            <?php if($product['Reduction'] > 0): ?>
                                <span class="text-2xl text-gray-500 line-through">
                                    <?php echo formatPrice($product['Prix_norm']); ?>
                                </span>
                                <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                                    -<?php echo $product['Reduction']; ?>%
                                </span>
                            <?php endif; ?>
                        </div>

                        <!-- Short Description -->
                        <p class="text-gray-600 mb-8 text-lg leading-relaxed">
                            <?php echo htmlspecialchars($product['Resume']); ?>
                        </p>

                        <!-- Quantity and Add to Cart -->
                        <div class="flex items-center space-x-4 mb-8">
                            <div class="flex items-center border border-gray-300 rounded-xl">
                                <button onclick="decreaseQuantity()" class="px-4 py-2 hover:bg-gray-100 transition-colors">-</button>
                                <span id="quantity" class="px-4 py-2 border-x border-gray-300">1</span>
                                <button onclick="increaseQuantity()" class="px-4 py-2 hover:bg-gray-100 transition-colors">+</button>
                            </div>
                            
                            <button onclick="addToCartWithQuantity(<?php echo $product['Id']; ?>)" 
                                    class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-3 px-6 rounded-xl transition-colors duration-300 flex items-center justify-center space-x-2 font-semibold">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5-6M17 13v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2-2v6"/>
                                </svg>
                                <span>Ajouter au panier</span>
                            </button>
                        </div>

                        <!-- Features -->
                        <div class="border-t pt-8">
                            <div class="grid grid-cols-3 gap-6 text-center">
                                <div class="flex flex-col items-center">
                                    <svg class="w-6 h-6 text-blue-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                    </svg>
                                    <span class="text-sm text-gray-600">Livraison gratuite</span>
                                </div>
                                <div class="flex flex-col items-center">
                                    <svg class="w-6 h-6 text-green-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span class="text-sm text-gray-600">Garantie incluse</span>
                                </div>
                                <div class="flex flex-col items-center">
                                    <svg class="w-6 h-6 text-orange-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                    </svg>
                                    <span class="text-sm text-gray-600">Retour 30 jours</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Details -->
            <div class="mt-12 bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="border-b">
                    <div class="flex">
                        <button onclick="showTab('description')" id="tab-description" 
                                class="tab-button px-8 py-4 font-medium transition-colors text-blue-600 border-b-2 border-blue-600">
                            Description
                        </button>
                        <button onclick="showTab('specifications')" id="tab-specifications" 
                                class="tab-button px-8 py-4 font-medium transition-colors text-gray-600 hover:text-gray-900">
                            Spécifications
                        </button>
                    </div>
                </div>

                <div class="p-8">
                    <div id="content-description" class="tab-content">
                        <div class="prose max-w-none">
                            <?php echo $product['Description']; ?>
                        </div>
                    </div>

                    <div id="content-specifications" class="tab-content hidden">
                        <div class="text-center py-12">
                            <p class="text-gray-500">Spécifications techniques disponibles sur demande</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

    <!-- Cart Modal -->
    <?php include 'includes/cart.php'; ?>

    <!-- Login Modal -->
    <?php include 'includes/login-modal.php'; ?>

    <script src="assets/js/main.js"></script>
    <script>
        let currentQuantity = 1;

        function increaseQuantity() {
            currentQuantity++;
            document.getElementById('quantity').textContent = currentQuantity;
        }

        function decreaseQuantity() {
            if (currentQuantity > 1) {
                currentQuantity--;
                document.getElementById('quantity').textContent = currentQuantity;
            }
        }

        function addToCartWithQuantity(productId) {
            addToCart(productId, currentQuantity);
        }

        function changeMainImage(src, button) {
            document.getElementById('main-image').src = src;
            
            // Update active thumbnail
            document.querySelectorAll('.w-20').forEach(btn => {
                btn.classList.remove('border-blue-600');
                btn.classList.add('border-gray-200');
            });
            button.classList.remove('border-gray-200');
            button.classList.add('border-blue-600');
        }

        function showTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });
            
            // Remove active class from all tab buttons
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('text-blue-600', 'border-b-2', 'border-blue-600');
                button.classList.add('text-gray-600', 'hover:text-gray-900');
            });
            
            // Show selected tab content
            document.getElementById('content-' + tabName).classList.remove('hidden');
            
            // Add active class to selected tab button
            const activeButton = document.getElementById('tab-' + tabName);
            activeButton.classList.remove('text-gray-600', 'hover:text-gray-900');
            activeButton.classList.add('text-blue-600', 'border-b-2', 'border-blue-600');
        }
    </script>
</body>
</html>