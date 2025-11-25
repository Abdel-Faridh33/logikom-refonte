# Guide de Déploiement - Groupe Logikom

## Configuration pour LWS (Production)

### 1. Configuration de BASE_URL

Avant de déployer sur `dev.groupelogikom.com`, vous devez modifier le fichier `config/database.php` :

```php
// Commenter la ligne de développement local
// define('BASE_URL', '/logikom-refonte');

// Décommenter la ligne de production
define('BASE_URL', '');
```

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
define('BASE_URL', '/logikom-refonte');

// Base de données locale
$host = 'localhost';
$dbname = 'group2411674';
$username = 'root';
$password = '';
```

Accès local: `http://localhost/logikom-refonte/home.php`

---

## Fonctions Helper

Le projet utilise deux fonctions pour générer les URLs:

### `url($path)`
Génère une URL simple:
```php
<a href="<?php echo url('index.php'); ?>">Boutique</a>
// Résultat: /index.php (en production)
// Résultat: /logikom-refonte/index.php (en local)
```

### `urlWithParams($path, $params)`
Génère une URL avec paramètres:
```php
<a href="<?php echo urlWithParams('index.php', ['grande' => 7, 'category' => 44]); ?>">
// Résultat: /index.php?grande=7&category=44 (en production)
```

---

## Checklist de Déploiement

- [ ] Mettre à jour `BASE_URL` dans `config/database.php`
- [ ] Configurer les informations de connexion à la base de données
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
1. Vérifier que `BASE_URL` est défini sur `''` (chaîne vide)
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
