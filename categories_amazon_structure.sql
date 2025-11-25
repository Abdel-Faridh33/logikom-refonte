-- Script SQL pour réorganiser les catégories selon le modèle Amazon.fr
-- Base de données : group2411674
-- Tables : commerce_categorie_grande et commerce_categorie

-- Vider les tables existantes (ATTENTION : sauvegardez d'abord vos données!)
-- TRUNCATE TABLE commerce_categorie;
-- TRUNCATE TABLE commerce_categorie_grande;

-- ============================================================
-- GRANDES CATÉGORIES (Catégories principales)
-- ============================================================

INSERT INTO commerce_categorie_grande (Id, Nom) VALUES
(1, 'Informatique & Ordinateurs'),
(2, 'Smartphones & Téléphonie'),
(3, 'Photo & Caméras'),
(4, 'TV, Audio & Home Cinéma'),
(5, 'Consoles & Jeux Vidéo'),
(6, 'Objets Connectés'),
(7, 'Réseaux & Domotique'),
(8, 'Accessoires & Périphériques');

-- ============================================================
-- SOUS-CATÉGORIES
-- ============================================================

-- 1. Informatique & Ordinateurs
INSERT INTO commerce_categorie (Nom, Grande) VALUES
('Ordinateurs Portables', 1),
('Ordinateurs de Bureau', 1),
('PC Tout-en-un', 1),
('Tablettes', 1),
('Serveurs', 1),
('Processeurs (CPU)', 1),
('Cartes Graphiques (GPU)', 1),
('Mémoire RAM', 1),
('SSD & Disques Durs', 1),
('Cartes Mères', 1),
('Alimentations PC', 1),
('Boîtiers PC', 1),
('Ventilation & Watercooling', 1),
('Moniteurs & Écrans', 1),
('Imprimantes', 1),
('Scanners', 1),
('Imprimantes Multifonctions', 1),
('Stockage Externe', 1),
('Lecteurs & Graveurs', 1);

-- 2. Smartphones & Téléphonie
INSERT INTO commerce_categorie (Nom, Grande) VALUES
('Smartphones', 2),
('Téléphones Fixes', 2),
('Coques & Étuis', 2),
('Protections Écran', 2),
('Chargeurs & Câbles', 2),
('Batteries Externes', 2),
('Support Téléphone', 2),
('Pièces Détachées Mobile', 2),
('Téléphones Reconditionnés', 2);

-- 3. Photo & Caméras
INSERT INTO commerce_categorie (Nom, Grande) VALUES
('Appareils Photo Numériques', 3),
('Caméras & Caméscopes', 3),
('Drones', 3),
('Objectifs', 3),
('Filtres Photo', 3),
('Trépieds & Supports', 3),
('Cartes Mémoire', 3),
('Sacs & Housses Photo', 3),
('Flash & Éclairage', 3),
('Stabilisateurs', 3);

-- 4. TV, Audio & Home Cinéma
INSERT INTO commerce_categorie (Nom, Grande) VALUES
('Téléviseurs', 4),
('Vidéoprojecteurs', 4),
('Barres de Son', 4),
('Enceintes Bluetooth', 4),
('Systèmes Home Cinéma', 4),
('Casques Audio', 4),
('Écouteurs', 4),
('Lecteurs Blu-ray/DVD', 4),
('Supports TV', 4),
('Câbles HDMI & Audio', 4);

-- 5. Consoles & Jeux Vidéo
INSERT INTO commerce_categorie (Nom, Grande) VALUES
('PlayStation', 5),
('Xbox', 5),
('Nintendo Switch', 5),
('PC Gaming', 5),
('Manettes & Controllers', 5),
('Claviers Gaming', 5),
('Souris Gaming', 5),
('Casques Gaming', 5),
('Chaises Gaming', 5),
('Accessoires Console', 5);

-- 6. Objets Connectés
INSERT INTO commerce_categorie (Nom, Grande) VALUES
('Montres Connectées', 6),
('Bracelets Connectés', 6),
('Balances Connectées', 6),
('Trackers GPS', 6),
('Lunettes Connectées', 6),
('Enceintes Intelligentes', 6),
('Caméras Connectées', 6);

-- 7. Réseaux & Domotique
INSERT INTO commerce_categorie (Nom, Grande) VALUES
('Routeurs WiFi', 7),
('Modems', 7),
('Points d\'accès WiFi', 7),
('Switches Réseau', 7),
('CPL (Courant Porteur)', 7),
('Câbles Réseau', 7),
('Caméras IP', 7),
('Vidéosurveillance', 7),
('Sonnettes Connectées', 7),
('Serrures Connectées', 7),
('Ampoules Connectées', 7),
('Prises Connectées', 7),
('Détecteurs & Capteurs', 7);

-- 8. Accessoires & Périphériques
INSERT INTO commerce_categorie (Nom, Grande) VALUES
('Claviers', 8),
('Souris', 8),
('Webcams', 8),
('Microphones', 8),
('Enceintes PC', 8),
('Casques PC', 8),
('Hub & Docks USB', 8),
('Cartes & Adaptateurs USB', 8),
('Câbles & Adaptateurs', 8),
('Housses & Sacoches PC', 8),
('Tapis de Souris', 8),
('Supports & Bras Écran', 8),
('Lampes de Bureau', 8),
('Nettoyage & Entretien', 8);

-- ============================================================
-- Notes d'utilisation :
-- ============================================================
-- 1. Ce script suppose que vos tables ont une structure avec auto-increment pour les IDs
-- 2. Si vous avez déjà des produits liés aux anciennes catégories,
--    vous devrez les réassigner aux nouvelles catégories
-- 3. Sauvegardez votre base de données avant d'exécuter ce script !
-- 4. Ajustez les IDs selon votre base de données existante
-- ============================================================
