# Guide de Réorganisation des Catégories - Style Amazon.fr

## Vue d'ensemble

Ce guide explique la nouvelle structure de catégories inspirée d'Amazon.fr pour votre boutique Logikom.

## Structure Hiérarchique

### 📦 Niveau 1 : Grandes Catégories (8 principales)

1. **Informatique & Ordinateurs** - Ordinateurs, composants et matériel informatique
2. **Smartphones & Téléphonie** - Téléphones et accessoires mobiles
3. **Photo & Caméras** - Équipement photographique et vidéo
4. **TV, Audio & Home Cinéma** - Divertissement audiovisuel
5. **Consoles & Jeux Vidéo** - Gaming et accessoires
6. **Objets Connectés** - Wearables et IoT
7. **Réseaux & Domotique** - Infrastructure réseau et maison intelligente
8. **Accessoires & Périphériques** - Périphériques et accessoires PC

### 📋 Niveau 2 : Sous-catégories (140+ catégories détaillées)

Chaque grande catégorie contient entre 7 et 19 sous-catégories spécialisées.

## Détail par Grande Catégorie

### 1. Informatique & Ordinateurs (19 sous-catégories)
```
├── Ordinateurs Portables
├── Ordinateurs de Bureau
├── PC Tout-en-un
├── Tablettes
├── Serveurs
├── Composants PC
│   ├── Processeurs (CPU)
│   ├── Cartes Graphiques (GPU)
│   ├── Mémoire RAM
│   ├── SSD & Disques Durs
│   ├── Cartes Mères
│   ├── Alimentations PC
│   ├── Boîtiers PC
│   └── Ventilation & Watercooling
├── Moniteurs & Écrans
├── Imprimantes & Scanners
│   ├── Imprimantes
│   ├── Scanners
│   └── Imprimantes Multifonctions
└── Stockage
    ├── Stockage Externe
    └── Lecteurs & Graveurs
```

### 2. Smartphones & Téléphonie (9 sous-catégories)
```
├── Smartphones
├── Téléphones Fixes
├── Téléphones Reconditionnés
└── Accessoires
    ├── Coques & Étuis
    ├── Protections Écran
    ├── Chargeurs & Câbles
    ├── Batteries Externes
    ├── Support Téléphone
    └── Pièces Détachées Mobile
```

### 3. Photo & Caméras (10 sous-catégories)
```
├── Appareils Photo Numériques
├── Caméras & Caméscopes
├── Drones
├── Optiques
│   ├── Objectifs
│   └── Filtres Photo
├── Supports
│   ├── Trépieds & Supports
│   └── Stabilisateurs
├── Stockage (Cartes Mémoire)
├── Sacs & Housses Photo
└── Flash & Éclairage
```

### 4. TV, Audio & Home Cinéma (10 sous-catégories)
```
├── Affichage
│   ├── Téléviseurs
│   ├── Vidéoprojecteurs
│   └── Supports TV
├── Audio
│   ├── Barres de Son
│   ├── Enceintes Bluetooth
│   ├── Systèmes Home Cinéma
│   ├── Casques Audio
│   └── Écouteurs
├── Lecteurs (Blu-ray/DVD)
└── Câbles HDMI & Audio
```

### 5. Consoles & Jeux Vidéo (10 sous-catégories)
```
├── Consoles
│   ├── PlayStation
│   ├── Xbox
│   └── Nintendo Switch
├── PC Gaming
└── Accessoires Gaming
    ├── Manettes & Controllers
    ├── Claviers Gaming
    ├── Souris Gaming
    ├── Casques Gaming
    ├── Chaises Gaming
    └── Accessoires Console
```

### 6. Objets Connectés (7 sous-catégories)
```
├── Wearables
│   ├── Montres Connectées
│   ├── Bracelets Connectés
│   ├── Lunettes Connectées
│   └── Trackers GPS
├── Santé (Balances Connectées)
├── Maison
│   ├── Enceintes Intelligentes
│   └── Caméras Connectées
```

### 7. Réseaux & Domotique (13 sous-catégories)
```
├── Infrastructure Réseau
│   ├── Routeurs WiFi
│   ├── Modems
│   ├── Points d'accès WiFi
│   ├── Switches Réseau
│   ├── CPL (Courant Porteur)
│   └── Câbles Réseau
├── Sécurité
│   ├── Caméras IP
│   ├── Vidéosurveillance
│   └── Sonnettes Connectées
└── Domotique
    ├── Serrures Connectées
    ├── Ampoules Connectées
    ├── Prises Connectées
    └── Détecteurs & Capteurs
```

### 8. Accessoires & Périphériques (14 sous-catégories)
```
├── Saisie
│   ├── Claviers
│   ├── Souris
│   └── Tapis de Souris
├── Audio/Vidéo
│   ├── Webcams
│   ├── Microphones
│   ├── Enceintes PC
│   └── Casques PC
├── Connectivité
│   ├── Hub & Docks USB
│   ├── Cartes & Adaptateurs USB
│   └── Câbles & Adaptateurs
├── Rangement & Confort
│   ├── Housses & Sacoches PC
│   ├── Supports & Bras Écran
│   └── Lampes de Bureau
└── Entretien (Nettoyage & Entretien)
```

## Installation

### Étape 1 : Sauvegarde
```bash
# Sauvegardez votre base de données actuelle
mysqldump -u root -p group2411674 > backup_categories_$(date +%Y%m%d).sql
```

### Étape 2 : Exécution du script
```bash
# Connectez-vous à MySQL
mysql -u root -p group2411674

# Exécutez le script
source categories_amazon_structure.sql
```

### Étape 3 : Vérification
```sql
-- Vérifier les grandes catégories
SELECT * FROM commerce_categorie_grande;

-- Vérifier les sous-catégories
SELECT cg.Nom as GrandeCategorie, c.Nom as SousCategorie
FROM commerce_categorie c
JOIN commerce_categorie_grande cg ON c.Grande = cg.Id
ORDER BY cg.Nom, c.Nom;

-- Compter les catégories par grande catégorie
SELECT cg.Nom, COUNT(c.Id) as NombreSousCategories
FROM commerce_categorie_grande cg
LEFT JOIN commerce_categorie c ON cg.Id = c.Grande
GROUP BY cg.Id, cg.Nom
ORDER BY cg.Nom;
```

## Avantages de cette Structure

### 1. **Navigation Intuitive**
- Hiérarchie claire et logique
- Catégories familières pour les utilisateurs
- Inspiration d'Amazon = confiance des utilisateurs

### 2. **SEO Optimisé**
- Structure bien organisée pour les moteurs de recherche
- Catégories cohérentes et descriptives
- Meilleure indexation des produits

### 3. **Évolutivité**
- Facile d'ajouter de nouvelles sous-catégories
- Structure flexible pour la croissance
- Compatible avec l'expansion du catalogue

### 4. **Expérience Utilisateur**
- Filtrage rapide et efficace
- Recherche par catégorie simplifiée
- Moins de clics pour trouver un produit

## Migration des Produits Existants

Si vous avez déjà des produits, vous devrez les réassigner aux nouvelles catégories :

```sql
-- Exemple : Réassigner tous les ordinateurs portables
UPDATE commerce_article
SET Categorie = (SELECT Id FROM commerce_categorie WHERE Nom = 'Ordinateurs Portables')
WHERE Categorie = [ancien_id_categorie_laptops];

-- Répétez pour chaque ancienne catégorie
```

## Personnalisation

Vous pouvez facilement adapter cette structure :
- Ajouter des sous-catégories spécifiques à votre marché
- Retirer les catégories non pertinentes
- Renommer selon votre audience locale

## Support

Pour toute question sur l'implémentation :
1. Consultez la documentation technique dans le code
2. Vérifiez les logs d'erreur MySQL
3. Testez d'abord sur une base de données de développement

---

**Note:** Cette structure est inspirée d'Amazon.fr mais adaptée aux besoins d'une boutique IT professionnelle comme Groupe Logikom.
