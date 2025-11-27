# Guide de Déploiement - Groupe Logikom

## Configuration pour LWS (Production)

### 1. Configuration de HOST_NAME

Avant de déployer sur `dev.groupelogikom.com`, vous devez modifier le fichier `includes/functions.php` (lignes 5-11) :

```php
// Commenter la ligne de développement local
// define('HOST_NAME', 'http://localhost/logikom-refonte');

// Décommenter la ligne de production
define('HOST_NAME', 'https://dev.groupelogikom.com');
```

**Note:** HOST_NAME peut aussi être défini dans `config/database.php` si vous préférez centraliser la configuration.

### 2. Structure sur le serveur LWS

Sur votre hébergement LWS, le sous-domaine `dev.groupelogikom.com` doit pointer directement vers le **contenu** du dossier, pas le dossier lui-même.

**Configuration correcte:**
```
Sous-domaine: dev.groupelogikom.com
Racine: /public_html/ (contenant directement les fichiers du projet)
```

**Structure des fichiers:**
```
/public_html/
├── admin/
├── api/
├── assets/
├── auth/
├── config/
├── includes/
├── home.php
├── index.php
├── produit.php
└── ...
```

### 3. Configuration de la base de données

Dans `config/database.php`, mettez à jour les informations de connexion:

```php
// Pour LWS
$host = 'votrehost.mysql.db';  // Fourni par LWS
$dbname = 'votrebasededonnees';
$username = 'votreutilisateur';
$password = 'votremotdepasse';
```

### 4. Vérification après déploiement

Testez les URLs suivantes pour confirmer que tout fonctionne:

- ✅ Page d'accueil: `https://dev.groupelogikom.com/home.php`
- ✅ Boutique: `https://dev.groupelogikom.com/index.php`
- ✅ Catégorie: `https://dev.groupelogikom.com/index.php?grande=7&category=44`
- ✅ Produit: `https://dev.groupelogikom.com/produit.php?id=123`
- ✅ Admin: `https://dev.groupelogikom.com/admin/`

Les URLs ne doivent **PAS** contenir le nom du dossier en double comme:
- ❌ `https://dev.groupelogikom.com/dev.groupelogikom.com/?grande=7`

---

## Développement Local

Pour le développement local (XAMPP), utilisez:

```php
// Développement local
define('HOST_NAME', 'http://localhost/logikom-refonte');

// Base de données locale
$host = 'localhost';
$dbname = 'group2411674';
$username = 'root';
$password = '';
```

Accès local: `http://localhost/logikom-refonte/home.php`

---

## Fonctions Helper

Le projet utilise deux fonctions pour générer les URLs avec `HOST_NAME`:

### `url($path)`
Génère une URL complète:
```php
<a href="<?php echo url('index.php'); ?>">Boutique</a>
// Résultat: https://dev.groupelogikom.com/index.php (en production)
// Résultat: http://localhost/logikom-refonte/index.php (en local)
```

### `urlWithParams($path, $params)`
Génère une URL complète avec paramètres:
```php
<a href="<?php echo urlWithParams('index.php', ['grande' => 7, 'category' => 44]); ?>">
// Résultat: https://dev.groupelogikom.com/index.php?grande=7&category=44 (en production)
// Résultat: http://localhost/logikom-refonte/index.php?grande=7&category=44 (en local)
```

---

## Checklist de Déploiement

- [ ] Mettre à jour `HOST_NAME` dans `includes/functions.php` (changer vers https://dev.groupelogikom.com)
- [ ] Configurer les informations de connexion à la base de données dans `config/database.php`
- [ ] Uploader tous les fichiers sur LWS
- [ ] Vérifier que le sous-domaine pointe vers le bon dossier
- [ ] Tester toutes les URLs principales
- [ ] Vérifier les liens de navigation
- [ ] Tester l'ajout au panier
- [ ] Tester la connexion admin

---

## Résolution de Problèmes

### Problème: URLs avec double dossier
```
https://dev.groupelogikom.com/dev.groupelogikom.com/?grande=7
```

**Solution:**
1. Vérifier que `HOST_NAME` est défini sur `https://dev.groupelogikom.com`
2. Vérifier que le sous-domaine pointe vers le contenu du dossier, pas le dossier parent

### Problème: Images non affichées

**Solution:**
Vérifier le chemin des images dans le code. Elles doivent utiliser:
```php
<img src="<?php echo url('assets/images/logo.png'); ?>">
```

### Problème: CSS non chargé

**Solution:**
```php
<link rel="stylesheet" href="<?php echo url('assets/css/style.css'); ?>">
```

---

## Support

Pour toute question, contacter l'équipe de développement.
