<?php
// Configuration de l'URL de base
// Pour le développement local
define('BASE_URL', '/logikom-refonte');

// Pour le déploiement sur dev.groupelogikom.com (décommenter la ligne ci-dessous)
// define('BASE_URL', '');

// Configuration de la base de données MySQL
$host = 'localhost';
$dbname = 'group2411674';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Fonction pour exécuter des requêtes
function executeQuery($query, $params = []) {
    global $pdo;
    try {
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        return $stmt;
    } catch(PDOException $e) {
        error_log("Erreur SQL: " . $e->getMessage());
        return false;
    }
}

// Fonction pour obtenir une seule ligne
function fetchOne($query, $params = []) {
    $stmt = executeQuery($query, $params);
    return $stmt ? $stmt->fetch() : false;
}

// Fonction pour obtenir plusieurs lignes
function fetchAll($query, $params = []) {
    $stmt = executeQuery($query, $params);
    return $stmt ? $stmt->fetchAll() : [];
}
?>