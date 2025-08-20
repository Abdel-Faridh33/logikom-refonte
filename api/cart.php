<?php
session_start();
require_once '../config/database.php';
require_once '../includes/functions.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$userId = getUserId();

if ($method === 'GET') {
    $action = $_GET['action'] ?? '';
    
    switch ($action) {
        case 'get':
            $items = getCartItems($userId);
            $total = getCartTotal($userId);
            $count = getCartCount($userId);
            
            echo json_encode([
                'success' => true,
                'items' => $items,
                'total' => $total,
                'count' => $count
            ]);
            break;
            
        case 'count':
            $count = getCartCount($userId);
            echo json_encode([
                'success' => true,
                'count' => $count
            ]);
            break;
            
        default:
            echo json_encode(['success' => false, 'message' => 'Action non valide']);
    }
} elseif ($method === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $action = $input['action'] ?? '';
    
    switch ($action) {
        case 'add':
            $productId = (int)($input['product_id'] ?? 0);
            $quantity = (int)($input['quantity'] ?? 1);
            
            if ($productId > 0) {
                $result = addToCart($userId, $productId, $quantity);
                $count = getCartCount($userId);
                
                echo json_encode([
                    'success' => $result !== false,
                    'count' => $count
                ]);
            } else {
                echo json_encode(['success' => false, 'message' => 'ID produit invalide']);
            }
            break;
            
        case 'remove':
            $productId = (int)($input['product_id'] ?? 0);
            
            if ($productId > 0) {
                $result = removeFromCart($userId, $productId);
                $count = getCartCount($userId);
                
                echo json_encode([
                    'success' => $result !== false,
                    'count' => $count
                ]);
            } else {
                echo json_encode(['success' => false, 'message' => 'ID produit invalide']);
            }
            break;
            
        case 'update':
            $productId = (int)($input['product_id'] ?? 0);
            $quantity = (int)($input['quantity'] ?? 0);
            
            if ($productId > 0) {
                $result = updateCartQuantity($userId, $productId, $quantity);
                $count = getCartCount($userId);
                
                echo json_encode([
                    'success' => $result !== false,
                    'count' => $count
                ]);
            } else {
                echo json_encode(['success' => false, 'message' => 'ID produit invalide']);
            }
            break;
            
        default:
            echo json_encode(['success' => false, 'message' => 'Action non valide']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Méthode non autorisée']);
}
?>