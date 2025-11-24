<?php
session_start();
require_once 'config/database.php';
require_once 'includes/functions.php';

// Récupération des données
$categories = getCategories();
$products = getProducts();
$featuredProducts = getFeaturedProducts(6);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Groupe Logikom - Solutions Informatiques & Infrastructure IT</title>
    <meta name="description" content="Groupe Logikom - Solutions informatiques innovantes, infrastructure IT, cybersécurité et support technique expert pour votre entreprise.">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Header -->
    <?php include 'includes/header.php'; ?>

    <!-- Hero Section -->
    <section id="accueil" class="relative min-h-screen bg-gradient-to-br from-slate-900 via-slate-800 to-blue-900 overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0 opacity-10">
            <img src="https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=1920&h=1080&fit=crop" 
                 alt="Technology Background" class="w-full h-full object-cover">
        </div>
        
        <!-- Content -->
        <div class="relative z-10 max-w-7xl mx-auto px-4 py-20 lg:py-32">
            <!-- Image Carousel -->
            <?php include 'includes/carousel.php'; ?>
            
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <!-- Trust Badge -->
                    <div class="flex items-center space-x-1 mb-6">
                        <div class="flex items-center space-x-1 bg-blue-600 text-white px-3 py-1 rounded-full text-sm">
                            <?php for($i = 0; $i < 5; $i++): ?>
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                            <?php endfor; ?>
                            <span class="ml-2 font-medium">Certifié ISO</span>
                        </div>
                    </div>

                    <h1 class="text-4xl lg:text-6xl font-bold text-white leading-tight mb-6">
                        Solutions
                        <span class="text-blue-400 block">Informatiques</span>
                        Innovantes
                    </h1>
                    
                    <p class="text-xl text-gray-300 mb-8 leading-relaxed">
                        Groupe Logikom accompagne votre transformation digitale avec des solutions 
                        sur mesure, un support technique expert et une approche personnalisée.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 mb-8">
                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-full flex items-center justify-center space-x-2 transition-all duration-300 transform hover:scale-105 shadow-lg">
                            <span class="font-semibold">Nos Solutions</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                        <button class="border-2 border-white text-white hover:bg-white hover:text-slate-900 px-8 py-4 rounded-full transition-all duration-300 transform hover:scale-105 font-semibold">
                            Consultation Gratuite
                        </button>
                    </div>

                    <!-- Key Benefits -->
                    <div class="space-y-3 mb-8">
                        <div class="flex items-center space-x-3 text-gray-300">
                            <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Support technique 24/7</span>
                        </div>
                        <div class="flex items-center space-x-3 text-gray-300">
                            <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Solutions personnalisées</span>
                        </div>
                        <div class="flex items-center space-x-3 text-gray-300">
                            <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Expertise reconnue depuis 15 ans</span>
                        </div>
                    </div>
                    
                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-8 pt-8 border-t border-gray-700">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-white mb-1">500+</div>
                            <div class="text-gray-400 text-sm">Clients Satisfaits</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-white mb-1">15+</div>
                            <div class="text-gray-400 text-sm">Années d'Expérience</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-white mb-1">24/7</div>
                            <div class="text-gray-400 text-sm">Support Technique</div>
                        </div>
                    </div>
                </div>
                
                <div class="relative">
                    <div class="relative z-10">
                        <img src="https://images.pexels.com/photos/3184360/pexels-photo-3184360.jpeg?auto=compress&cs=tinysrgb&w=800&h=600&fit=crop"
                             alt="Solutions Informatiques" class="w-full h-auto rounded-2xl shadow-2xl transform hover:scale-105 transition-transform duration-300">
                    </div>
                    <div class="absolute -top-4 -right-4 w-full h-full bg-blue-600 rounded-2xl opacity-20"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <?php include 'includes/services.php'; ?>

    <!-- Solutions Section -->
    <?php include 'includes/solutions.php'; ?>

    <!-- Shop Preview Section -->
    <div id="boutique" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">
                Notre <span class="text-blue-600">Boutique</span> IT
            </h2>
            <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                Découvrez notre sélection de produits informatiques professionnels
            </p>
            
            <!-- Featured Products -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                <?php foreach($featuredProducts as $product): ?>
                    <div class="bg-gray-50 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 cursor-pointer group overflow-hidden">
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
                            <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors">
                                <?php echo htmlspecialchars($product['Titre']); ?>
                            </h3>
                            <p class="text-gray-600 mb-4 line-clamp-2">
                                <?php echo htmlspecialchars(substr($product['Resume'], 0, 100)) . '...'; ?>
                            </p>
                            
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    <span class="text-2xl font-bold text-blue-600">
                                        <?php echo number_format($product['Prix_reduction'], 0, ',', ' '); ?> CFA
                                    </span>
                                    <?php if($product['Reduction'] > 0): ?>
                                        <span class="text-lg text-gray-500 line-through">
                                            <?php echo number_format($product['Prix_norm'], 0, ',', ' '); ?> CFA
                                        </span>
                                    <?php endif; ?>
                                </div>
                                
                                <button onclick="addToCart(<?php echo $product['Id']; ?>)" 
                                        class="bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-xl transition-colors duration-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5-6M17 13v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2-2v6"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <a href="index.php" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-full transition-all duration-300 transform hover:scale-105 font-semibold inline-block">
                Voir la Boutique
            </a>
        </div>
    </div>

    <!-- Testimonials Section -->
    <?php include 'includes/testimonials.php'; ?>

    <!-- Contact Section -->
    <?php include 'includes/contact.php'; ?>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

    <!-- Cart Modal -->
    <?php include 'includes/cart.php'; ?>

    <!-- Login Modal -->
    <?php include 'includes/login-modal.php'; ?>

    <script src="assets/js/main.js"></script>
</body>
</html>