<?php
session_start();
require_once '../config/database.php';
require_once '../includes/functions.php';

// Vérifier si l'utilisateur est admin
if (!isAdmin()) {
    header('Location: ' . url('index.php'));
    exit;
}

// Récupérer les statistiques
$totalProducts = fetchOne("SELECT COUNT(*) as count FROM commerce_article")['count'];
$totalOrders = fetchOne("SELECT COUNT(*) as count FROM commerce_commande")['count'];
$totalRevenue = fetchOne("
    SELECT SUM(ca.Montant) as total 
    FROM commerce_commande_article ca 
    JOIN commerce_commande c ON ca.Id_commande = c.Id_commande
")['total'] ?? 0;

// Récupérer les commandes récentes
$recentOrders = fetchAll("
    SELECT c.*, 
           (SELECT SUM(Montant) FROM commerce_commande_article WHERE Id_commande = c.Id_commande) as Total
    FROM commerce_commande c 
    ORDER BY c.Date DESC 
    LIMIT 10
");

// Récupérer les produits
$products = getProducts();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Groupe Logikom</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?php echo url('assets/css/style.css'); ?>">
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold text-gray-900">Administration Logikom</h1>
                <div class="flex items-center space-x-4">
                    <a href="<?php echo url('index.php'); ?>" class="text-gray-600 hover:text-gray-900">Retour au site</a>
                    <a href="<?php echo url('auth/logout.php'); ?>" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">
                        Déconnexion
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Produits</p>
                        <p class="text-2xl font-bold text-gray-900"><?php echo $totalProducts; ?></p>
                    </div>
                    <div class="bg-blue-500 p-3 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Commandes</p>
                        <p class="text-2xl font-bold text-gray-900"><?php echo $totalOrders; ?></p>
                    </div>
                    <div class="bg-green-500 p-3 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Revenus</p>
                        <p class="text-2xl font-bold text-gray-900"><?php echo formatPrice($totalRevenue); ?></p>
                    </div>
                    <div class="bg-purple-500 p-3 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Clients</p>
                        <p class="text-2xl font-bold text-gray-900">89</p>
                    </div>
                    <div class="bg-orange-500 p-3 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m3 5.197H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs -->
        <div class="bg-white rounded-xl shadow-sm mb-8">
            <div class="border-b">
                <div class="flex">
                    <button onclick="showAdminTab('products')" id="admin-tab-products" 
                            class="admin-tab px-6 py-4 font-medium transition-colors text-blue-600 border-b-2 border-blue-600">
                        Produits
                    </button>
                    <button onclick="showAdminTab('orders')" id="admin-tab-orders" 
                            class="admin-tab px-6 py-4 font-medium transition-colors text-gray-600 hover:text-gray-900">
                        Commandes
                    </button>
                    <button onclick="showAdminTab('categories')" id="admin-tab-categories" 
                            class="admin-tab px-6 py-4 font-medium transition-colors text-gray-600 hover:text-gray-900">
                        Catégories
                    </button>
                </div>
            </div>

            <div class="p-6">
                <!-- Products Tab -->
                <div id="admin-content-products" class="admin-content">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-gray-900">Gestion des Produits</h2>
                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            <span>Nouveau Produit</span>
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b">
                                    <th class="text-left py-3 px-4 font-medium text-gray-900">Produit</th>
                                    <th class="text-left py-3 px-4 font-medium text-gray-900">Catégorie</th>
                                    <th class="text-left py-3 px-4 font-medium text-gray-900">Prix</th>
                                    <th class="text-left py-3 px-4 font-medium text-gray-900">Date</th>
                                    <th class="text-left py-3 px-4 font-medium text-gray-900">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($products as $product): ?>
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="py-4 px-4">
                                            <div class="flex items-center space-x-3">
                                                <img src="../assets/images/article/<?php echo htmlspecialchars($product['Image']); ?>" 
                                                     alt="<?php echo htmlspecialchars($product['Titre']); ?>"
                                                     class="w-12 h-12 object-cover rounded-lg">
                                                <div>
                                                    <p class="font-medium text-gray-900"><?php echo htmlspecialchars($product['Titre']); ?></p>
                                                    <p class="text-sm text-gray-500"><?php echo htmlspecialchars(substr($product['Resume'], 0, 50)) . '...'; ?></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4 text-gray-600"><?php echo htmlspecialchars($product['NomCategorie']); ?></td>
                                        <td class="py-4 px-4 font-medium text-gray-900">
                                            <?php echo formatPrice($product['Prix_reduction']); ?>
                                        </td>
                                        <td class="py-4 px-4 text-gray-600">
                                            <?php echo date('d/m/Y', strtotime($product['Date'])); ?>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="flex items-center space-x-2">
                                                <a href="<?php echo urlWithParams('produit.php', ['id' => $product['Id']]); ?>"
                                                   class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                    </svg>
                                                </a>
                                                <button class="p-2 text-gray-600 hover:bg-gray-50 rounded-lg">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                </button>
                                                <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Orders Tab -->
                <div id="admin-content-orders" class="admin-content hidden">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Commandes Récentes</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b">
                                    <th class="text-left py-3 px-4 font-medium text-gray-900">Commande</th>
                                    <th class="text-left py-3 px-4 font-medium text-gray-900">Client</th>
                                    <th class="text-left py-3 px-4 font-medium text-gray-900">Total</th>
                                    <th class="text-left py-3 px-4 font-medium text-gray-900">Date</th>
                                    <th class="text-left py-3 px-4 font-medium text-gray-900">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($recentOrders as $order): ?>
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="py-4 px-4 font-medium text-blue-600">#<?php echo substr($order['Id_commande'], 0, 8); ?></td>
                                        <td class="py-4 px-4 text-gray-900"><?php echo htmlspecialchars($order['Prenom'] . ' ' . $order['Nom']); ?></td>
                                        <td class="py-4 px-4 font-medium text-gray-900"><?php echo formatPrice($order['Total'] ?? 0); ?></td>
                                        <td class="py-4 px-4 text-gray-600"><?php echo date('d/m/Y', strtotime($order['Date'])); ?></td>
                                        <td class="py-4 px-4">
                                            <div class="flex items-center space-x-2">
                                                <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Categories Tab -->
                <div id="admin-content-categories" class="admin-content hidden">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Gestion des Catégories</h2>
                    <div class="text-center py-12">
                        <svg class="mx-auto w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2h10a2 2 0 012 2v2M7 7V5a2 2 0 012-2h6a2 2 0 012 2v2"/>
                        </svg>
                        <p class="text-gray-500">Fonctionnalité en développement</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showAdminTab(tabName) {
            // Hide all admin contents
            document.querySelectorAll('.admin-content').forEach(content => {
                content.classList.add('hidden');
            });
            
            // Remove active class from all admin tabs
            document.querySelectorAll('.admin-tab').forEach(tab => {
                tab.classList.remove('text-blue-600', 'border-b-2', 'border-blue-600');
                tab.classList.add('text-gray-600', 'hover:text-gray-900');
            });
            
            // Show selected admin content
            document.getElementById('admin-content-' + tabName).classList.remove('hidden');
            
            // Add active class to selected admin tab
            const activeTab = document.getElementById('admin-tab-' + tabName);
            activeTab.classList.remove('text-gray-600', 'hover:text-gray-900');
            activeTab.classList.add('text-blue-600', 'border-b-2', 'border-blue-600');
        }
    </script>
</body>
</html>