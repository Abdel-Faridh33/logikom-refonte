<?php
// Fonctions utilitaires pour l'application

// Récupérer toutes les catégories grandes
function getCategoriesGrandes() {
    return fetchAll("SELECT * FROM commerce_categorie_grande ORDER BY Nom");
}

// Récupérer toutes les catégories
function getCategories() {
    $query = "
        SELECT c.*, cg.Nom as NomGrande 
        FROM commerce_categorie c 
        JOIN commerce_categorie_grande cg ON c.Grande = cg.Id 
        ORDER BY cg.Nom, c.Nom
    ";
    return fetchAll($query);
}

// Récupérer les catégories par grande catégorie
function getCategoriesByGrande($grandeId) {
    return fetchAll("SELECT * FROM commerce_categorie WHERE Grande = ? ORDER BY Nom", [$grandeId]);
}

// Récupérer tous les produits
function getProducts($categoryId = null, $search = null, $limit = null) {
    $query = "
        SELECT a.*, c.Nom as NomCategorie, cg.Nom as NomGrande
        FROM commerce_article a
        JOIN commerce_categorie c ON a.Categorie = c.Id
        JOIN commerce_categorie_grande cg ON c.Grande = cg.Id
        WHERE 1=1
    ";
    $params = [];
    
    if ($categoryId) {
        $query .= " AND a.Categorie = ?";
        $params[] = $categoryId;
    }
    
    if ($search) {
        $query .= " AND (a.Titre LIKE ? OR a.Resume LIKE ?)";
        $params[] = "%$search%";
        $params[] = "%$search%";
    }
    
    $query .= " ORDER BY a.Date DESC";
    
    if ($limit) {
        $query .= " LIMIT ?";
        $params[] = $limit;
    }
    
    return fetchAll($query, $params);
}

// Récupérer les produits en vedette
function getFeaturedProducts($limit = 6) {
    return getProducts(null, null, $limit);
}

// Récupérer un produit par ID
function getProductById($id) {
    return fetchOne("
        SELECT a.*, c.Nom as NomCategorie, cg.Nom as NomGrande
        FROM commerce_article a
        JOIN commerce_categorie c ON a.Categorie = c.Id
        JOIN commerce_categorie_grande cg ON c.Grande = cg.Id
        WHERE a.Id = ?
    ", [$id]);
}

// Récupérer les articles du panier
function getCartItems($userId) {
    return fetchAll("
        SELECT p.*, a.Titre, a.Prix_reduction, a.Image, a.Resume
        FROM commerce_panier p
        JOIN commerce_article a ON p.Id_article = a.Id
        WHERE p.Id_user = ?
        ORDER BY p.Date DESC
    ", [$userId]);
}

// Ajouter un article au panier
function addToCart($userId, $articleId, $quantity = 1) {
    // Vérifier si l'article existe déjà dans le panier
    $existing = fetchOne("SELECT * FROM commerce_panier WHERE Id_user = ? AND Id_article = ?", [$userId, $articleId]);
    
    if ($existing) {
        // Mettre à jour la quantité
        return executeQuery("UPDATE commerce_panier SET Quantite = Quantite + ? WHERE Id_user = ? AND Id_article = ?", 
                          [$quantity, $userId, $articleId]);
    } else {
        // Ajouter un nouvel article
        return executeQuery("INSERT INTO commerce_panier (Id_user, Id_article, Quantite) VALUES (?, ?, ?)", 
                          [$userId, $articleId, $quantity]);
    }
}

// Supprimer un article du panier
function removeFromCart($userId, $articleId) {
    return executeQuery("DELETE FROM commerce_panier WHERE Id_user = ? AND Id_article = ?", [$userId, $articleId]);
}

// Mettre à jour la quantité dans le panier
function updateCartQuantity($userId, $articleId, $quantity) {
    if ($quantity <= 0) {
        return removeFromCart($userId, $articleId);
    }
    return executeQuery("UPDATE commerce_panier SET Quantite = ? WHERE Id_user = ? AND Id_article = ?", 
                      [$quantity, $userId, $articleId]);
}

// Vider le panier
function clearCart($userId) {
    return executeQuery("DELETE FROM commerce_panier WHERE Id_user = ?", [$userId]);
}

// Calculer le total du panier
function getCartTotal($userId) {
    $result = fetchOne("
        SELECT SUM(p.Quantite * a.Prix_reduction) as total
        FROM commerce_panier p
        JOIN commerce_article a ON p.Id_article = a.Id
        WHERE p.Id_user = ?
    ", [$userId]);
    
    return $result ? (int)$result['total'] : 0;
}

// Compter les articles dans le panier
function getCartCount($userId) {
    $result = fetchOne("SELECT SUM(Quantite) as count FROM commerce_panier WHERE Id_user = ?", [$userId]);
    return $result ? (int)$result['count'] : 0;
}

// Générer un ID utilisateur unique
function generateUserId() {
    return rand(0, 9) . '_' . rand(0, 23) . '_' . rand(0, 59) . '_' . rand(0, 59) . '_' . rand(100, 999);
}

// Obtenir l'ID utilisateur de la session
function getUserId() {
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['user_id'] = generateUserId();
    }
    return $_SESSION['user_id'];
}

// Vérifier si l'utilisateur est connecté
function isLoggedIn() {
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}

// Vérifier si l'utilisateur est admin
function isAdmin() {
    return isLoggedIn() && isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
}

// Authentification
function login($username, $password) {
    // Authentification simple pour la démo
    if ($username === 'admin' && $password === 'admin') {
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['user_role'] = 'admin';
        return true;
    }
    return false;
}

// Déconnexion
function logout() {
    session_destroy();
    session_start();
    // Régénérer l'ID utilisateur pour le panier
    $_SESSION['user_id'] = generateUserId();
}

// Formater le prix
function formatPrice($price) {
    return number_format($price, 0, ',', ' ') . ' CFA';
}

// Nettoyer les données d'entrée
function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// Récupérer les frais de livraison
function getShippingCosts() {
    return fetchAll("SELECT * FROM commerce_frais_livraison ORDER BY Nom_ville");
}

// Créer une commande
function createOrder($orderData) {
    $orderId = generateOrderId();
    
    // Insérer la commande
    $query = "INSERT INTO commerce_commande (Id_commande, Nom, Prenom, Numero, Mail, Lieu) VALUES (?, ?, ?, ?, ?, ?)";
    $result = executeQuery($query, [
        $orderId,
        $orderData['nom'],
        $orderData['prenom'],
        $orderData['numero'],
        $orderData['email'],
        $orderData['lieu']
    ]);
    
    if ($result) {
        // Ajouter les articles de la commande
        $cartItems = getCartItems($orderData['userId']);
        foreach ($cartItems as $item) {
            executeQuery("INSERT INTO commerce_commande_article (Id_commande, Article, Quantite, Montant) VALUES (?, ?, ?, ?)", [
                $orderId,
                $item['Id_article'],
                $item['Quantite'],
                $item['Prix_reduction'] * $item['Quantite']
            ]);
        }
        
        // Ajouter les frais de livraison
        if (isset($orderData['frais_livraison'])) {
            executeQuery("INSERT INTO commerce_commande_livraison (Id_commande, Montant) VALUES (?, ?)", [
                $orderId,
                $orderData['frais_livraison']
            ]);
        }
        
        // Vider le panier
        clearCart($orderData['userId']);
        
        return $orderId;
    }
    
    return false;
}

// Générer un ID de commande
function generateOrderId() {
    return rand(0, 9) . '_' . rand(0, 23) . '_' . rand(0, 59) . '_' . rand(0, 59) . '_' . rand(100, 999) . '_' . time();
}
?>