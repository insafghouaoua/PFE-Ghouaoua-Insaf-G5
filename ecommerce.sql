-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 01, 2023 at 12:57 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrateur`
--

CREATE TABLE `administrateur` (
  `administrateur_id` int(255) NOT NULL,
  `image_profile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datedenaissance` date NOT NULL,
  `genre` char(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` int(20) NOT NULL,
  `mot_de_passe` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `administrateur`
--

INSERT INTO `administrateur` (`administrateur_id`, `image_profile`, `nom`, `prenom`, `datedenaissance`, `genre`, `email`, `telephone`, `mot_de_passe`) VALUES
(6, 'image-profile.png', 'Ghouaoua', 'Insaf', '2002-02-13', NULL, 'insafghouaoua@gmail.com', 553840633, 'lllll5L@');

-- --------------------------------------------------------

--
-- Table structure for table `categorieproduit`
--

CREATE TABLE `categorieproduit` (
  `categorie_id` int(255) NOT NULL,
  `categorie` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categorieproduit`
--

INSERT INTO `categorieproduit` (`categorie_id`, `categorie`) VALUES
(1001, 'Produits de jardinage et d\'extérieur'),
(2002, 'Articles pour la maison'),
(3003, 'Produits de loisirs');

-- --------------------------------------------------------

--
-- Table structure for table `commande`
--

CREATE TABLE `commande` (
  `commande_id` int(255) NOT NULL,
  `utilisateur_id` int(255) NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wilaya` int(2) NOT NULL,
  `adresse_postale` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `cree_le` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `commande_produit`
--

CREATE TABLE `commande_produit` (
  `commande_id` int(255) NOT NULL,
  `produit_id` int(255) NOT NULL,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix_vente` float NOT NULL,
  `quantite` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `commentaire`
--

CREATE TABLE `commentaire` (
  `commentaire_id` int(255) NOT NULL,
  `produit_id` int(255) NOT NULL,
  `utilisateur_id` int(255) DEFAULT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_profile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentaire` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `cree_le` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `message_id` int(11) NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offre_achat_partage`
--

CREATE TABLE `offre_achat_partage` (
  `offre_id` int(255) NOT NULL,
  `produit_id` int(255) NOT NULL,
  `utilisateur_id` int(255) NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_profile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wilaya` int(2) NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pourcentage` int(2) NOT NULL,
  `duree_utilisation` int(2) NOT NULL,
  `commentaire` text COLLATE utf8mb4_unicode_ci,
  `cree_le` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offre_achat_partage`
--

INSERT INTO `offre_achat_partage` (`offre_id`, `produit_id`, `utilisateur_id`, `nom`, `prenom`, `image_profile`, `wilaya`, `email`, `pourcentage`, `duree_utilisation`, `commentaire`, `cree_le`) VALUES
(9, 16, 39, 'Guasmi', 'Aymen', 'image-profile-aymen.png', 1, 'utilisateur@exemple.com', 10, 1, 'cc', '2023-05-31 21:49:05');

-- --------------------------------------------------------

--
-- Table structure for table `panier`
--

CREATE TABLE `panier` (
  `panier_id` int(255) NOT NULL,
  `utilisateur_id` int(255) NOT NULL,
  `cree_le` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `panier_produit`
--

CREATE TABLE `panier_produit` (
  `panier_id` int(255) NOT NULL,
  `produit_id` int(255) NOT NULL,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantite` int(20) NOT NULL,
  `prix_vente` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `participation_achat_partage`
--

CREATE TABLE `participation_achat_partage` (
  `participation_id` int(255) NOT NULL,
  `offre_id` int(255) NOT NULL,
  `produit_id` int(255) NOT NULL,
  `utilisateur_id` int(255) NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_profile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wilaya` int(2) NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pourcentage` int(2) NOT NULL,
  `duree_utilisation` int(2) NOT NULL,
  `commentaire` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `cree_le` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produit`
--

CREATE TABLE `produit` (
  `produit_id` int(255) NOT NULL,
  `categorie_id` int(255) NOT NULL,
  `categorie` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marque` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `petite_description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix_initial` float NOT NULL,
  `prix_vente` float NOT NULL,
  `quantite` int(20) NOT NULL,
  `statut` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produit`
--

INSERT INTO `produit` (`produit_id`, `categorie_id`, `categorie`, `nom`, `marque`, `petite_description`, `description`, `image`, `prix_initial`, `prix_vente`, `quantite`, `statut`) VALUES
(16, 1001, 'Produits de jardinage et d\'extérieur', 'Einhell Motobineuse électrique ', 'Einhell', '1400 W, Largeur de travail 40 cm, Profondeur de travail 20 cm, Guidon ergonomique et pliable', 'Moteur puissant. Fréquence: 50 Hz Double interrupteur de sécurité Guidon ergonomique pliable Roues réglable en hauteur pour faciliter le déplacement Anti-arrachement du câble Volume en m³ : 0.09', '61Necusin2L._AC_SX569_.jpg', 20000, 30760, 100, 'en_stock'),
(17, 1001, 'Produits de jardinage et d\'extérieur', 'Souffleur à feuilles sans fil', 'Bosch', 'Sans fil ALB 18 LI, Vert', 'Souffleur sans fil avec vitesse de soufflerie jusqu\'à 210 km/h pour décoller facilement les feuilles mouillées et collées sur le sol Batterie 18v lithium-ion(pas de perte de puissance, pas de décharge), interchangeable avec les outils électroportatifs et de jardin power4all 18v Syneon chip : puce intelligente dans la machine : délivre uniquement la puissance nécessaire pour une utilisation optimale de l\'outil', '61ufyJJW4+L._AC_SX569_.jpg', 10000, 17790, 70, 'en_stock'),
(18, 1001, 'Produits de jardinage et d\'extérieur', 'Cisaille à gazon à batterie', 'Bosch', 'AdvancedShear 18V-10 (sans batterie, système 18 volts, coupe jusqu\'à 85 m² par charge de batterie, avec couteau à arbustes et à gazon, en boîte)', 'Un outil polyvalent pour entretenir votre gazon, vos arbustes et vos haies ! Le passage d’une tâche à l’autre est très facile grâce au système « Multi-click », qui permet de changer de lame rapidement Fini les interruptions ! Grâce au système « anti-blocage », l’outil permet de couper des branches épaisses sans caler', '71Vg3Sg3pqS.__AC_SX300_SY300_QL70_ML2_.jpg', 11000, 19000, 150, 'nouveaute'),
(21, 1001, 'Produits de jardinage et d\'extérieur', 'Souffleur de feuilles sans fil', 'Bosch', 'sans batterie, 36 V, Moteur Brushless, pour les feuilles tenaces qui collent au sol et grandes surfaces, 2,8 kg, dans carton', 'Souffleur de feuilles sans fil très puissant et sans émissions pour les travaux de nettoyage de jardin exigeants Le ventilateur axial débarrasse facilement les surfaces dures, non planes ou humides des déchets végétaux qui se sont incrustés', '615ePiZmGyL._AC_SX569_.jpg', 30000, 37050, 60, 'en_promo'),
(22, 1001, 'Produits de jardinage et d\'extérieur', 'Meuleuse d\'angle sans fil', 'WORX', 'Livrée avec 2 batteries et chargeur, 8600 rpm, poignée auxiliaire, disque, carter, coffret de rangement', 'Boîtier en métal pour une durabilité et une durée de vie prolongée Poignée auxiliaire à 2 positions pour un meilleur confort Poignée souple pour une prise confortable', '81qWTnWN1rL._AC_SX569_.jpg', 35000, 42600, 60, 'en_stock'),
(23, 1001, 'Produits de jardinage et d\'extérieur', 'Tronçonneuse sans fil', 'Bosch', 'Livrée sans batterie ni chargeur, avec huile 80 ml, système 18V, longueur de guide: 20cm', 'La tronçonneuse sans-fil compacte UniversalChain 18 offre une prise en main parfaite grâce à son faible poids Nouveau crochet de butée permettant de réaliser facilement des coupes nettes par en dessous', '615AXvyXuaL._AC_SX569_.jpg', 14000, 21000, 150, 'en_stock'),
(24, 1001, 'Produits de jardinage et d\'extérieur', 'Élagueuse et Taille Haie à Batterie', 'Greenworks', 'Batterie sur Perche 2-en-1 avec Bandoulière, Guide Tronçonneuse 20 cm, Lames Double Action Taille-Haie 51 cm, Batterie 40V 2Ah Chargeur', 'ÉLAGUEUSE SUR PERCHE ET TAILLE-HAIE POUR GRANDS JARDINS - l’élagueuse 2 en 1 vous permet de passer d\'un outil à l\'autre pour couper, tailler et élaguer haies et arbres avec une perche d’une portée allant jusqu\'à 2,4 m BATTERIE LITHIUM 40V 2Ah NOUVELLE GENERATION - alimentée par une batterie avancée utilisable dans tout outil Greenworks 40V', '51EQt2QnvOL.__AC_SX300_SY300_QL70_ML2_.jpg', 43000, 51990, 180, 'en_stock'),
(26, 2002, 'Articles pour la maison', 'Yaourtière', 'Seb', '12 pots, Pots verre 140 ml, 5 programmes automatiques, Sans BPA, Compact, Yaourt maison, Desserts lactés, Fromages blancs, Fabriqué en France', 'Yaourtière 12 pots avec programme express et variété infinie de desserts Programme express 4 heures pour des yaourts parfaits en deux fois moins de temps 5 programmes pour des choix extrêmement variés de desserts lactés, fromages blancs et desserts moelleux', '41oT8FE2IWL._AC_SX569_.jpg', 20000, 27900, 70, 'en_stock'),
(27, 2002, 'Articles pour la maison', 'Friteuse semi-professionnelle', 'Tefal', '3,5 L, 2300 W, Jusqu\'à 6 pers, Filtration automatique de l\'huile, Minuteur digital', 'CAPCITE : l\'Oleoclean offre une capacité de 3,5 L pour 1,2 kg de frites, jusqu\'à 6 personnes SYSTEME FILTRATION : une huile toujours propre grâce au système breveté de filtration automatique de l\'huile. L\'huile est filtrée et peut être stockée dans une boite hermétique en vue d\'une prochaine utilisation. Idéal lorsque vous variez vos fritures', '71WQrTOzjfS.__AC_SY300_SX300_QL70_ML2_.jpg', 28000, 33100, 80, 'nouveaute'),
(29, 2002, 'Articles pour la maison', 'Hachoir à viande', 'Bosch', 'Jusqu\'à 4,3 kilos de viande par minute – Puissance de 800 W', 'Avec le hachoir à viande ProPower de Bosch et sa fabrication puissante et robuste, réalisez vos propres saucisses, tartares, boulettes... Dites adieu aux aller-retours chez le boucher Le hachoir ProPower permet une grande capacité d\'utilisation grâce à son moteur robuste, qui s\'arrête automatiquement à 2200 W', '81D-KdwSt4L._AC_SX569_.jpg', 28000, 33000, 60, 'en_promo'),
(30, 3003, 'Produits de loisirs', 'Wonder Core 2', 'WONDER CORE', 'Unisexe avec siège tournant intégré et rameur', 'Siège de torsion intégré pour cibler vos obliques et tonifier votre taille, en ajoutant un coussin pour le bas ABS, ou faire un ton bas AB presse pour vraiment votre ventre', '817hriMjbvL._AC_SX569_.jpg', 21000, 27900, 60, 'en_promo'),
(31, 3003, 'Produits de loisirs', 'Vélo d’Appartement', 'CARE FITNESS', 'Pliable SV-316-7 Fonctions - Masse d’Inertie 4 kg - Freinage Magnétique', 'Un équipement qui vous accompagne ! Avec le vélo pliant SV-316, pratiquez du sport à la maison ou en appartement en toute sécurité. Facilité d’utilisation, ergonomie, maniabilité, il a été pensé pour vous simplifier le vélo d’appartement !', '51tqUmb4J-S._AC_SX569_.jpg', 41000, 48700, 130, 'nouveaute');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `utilisateur_id` int(255) NOT NULL,
  `image_profile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datedenaissance` date NOT NULL,
  `genre` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mot_de_passe` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`utilisateur_id`, `image_profile`, `nom`, `prenom`, `datedenaissance`, `genre`, `email`, `telephone`, `mot_de_passe`) VALUES
(39, 'image-profile-aymen.png', 'Guasmi', 'Aymen', '2023-03-03', 'homme', 'guasmiaymen@gmail.com', '0553840633', 'lllll5L@'),
(60, 'image-profile-meriem.png', 'Meriem', 'Halilou', '2003-02-08', 'femme', 'haliloumeriem@gmail.com', '0551234657', 'lllll5L@'),
(61, '', 'haiahem', 'rahim', '2023-05-10', 'homme', 'haiahem.rahim@gmail.com', '0668911515', 'Annaba2323@'),
(64, '', 'ghouaoua', 'mohamed', '2023-05-09', 'femme', 'insafghouaoua@gmail.com', '0555545555', 'Insaf2323'),
(65, 'image-profile-mohamed.png', 'Bahi', 'Mohamed', '2023-05-03', NULL, 'utilisateur@exemple.com', '0555555555', 'lllll5L@');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`administrateur_id`);

--
-- Indexes for table `categorieproduit`
--
ALTER TABLE `categorieproduit`
  ADD PRIMARY KEY (`categorie_id`);

--
-- Indexes for table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`commande_id`),
  ADD KEY `utilisateur_id` (`utilisateur_id`);

--
-- Indexes for table `commande_produit`
--
ALTER TABLE `commande_produit`
  ADD KEY `commande_id` (`commande_id`),
  ADD KEY `produit_id` (`produit_id`);

--
-- Indexes for table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`commentaire_id`),
  ADD KEY `produit_id` (`produit_id`),
  ADD KEY `utilisateur_id` (`utilisateur_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `offre_achat_partage`
--
ALTER TABLE `offre_achat_partage`
  ADD PRIMARY KEY (`offre_id`),
  ADD KEY `utilisateur_id` (`utilisateur_id`),
  ADD KEY `produit_id` (`produit_id`);

--
-- Indexes for table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`panier_id`),
  ADD KEY `utilisateur_id` (`utilisateur_id`);

--
-- Indexes for table `panier_produit`
--
ALTER TABLE `panier_produit`
  ADD KEY `produit_id` (`produit_id`),
  ADD KEY `panier_id` (`panier_id`);

--
-- Indexes for table `participation_achat_partage`
--
ALTER TABLE `participation_achat_partage`
  ADD PRIMARY KEY (`participation_id`),
  ADD KEY `offre_id` (`offre_id`),
  ADD KEY `produit_id` (`produit_id`),
  ADD KEY `utilisateur_id` (`utilisateur_id`);

--
-- Indexes for table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`produit_id`),
  ADD KEY `categorie_id` (`categorie_id`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`utilisateur_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrateur`
--
ALTER TABLE `administrateur`
  MODIFY `administrateur_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categorieproduit`
--
ALTER TABLE `categorieproduit`
  MODIFY `categorie_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3004;

--
-- AUTO_INCREMENT for table `commande`
--
ALTER TABLE `commande`
  MODIFY `commande_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `commentaire_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offre_achat_partage`
--
ALTER TABLE `offre_achat_partage`
  MODIFY `offre_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `panier`
--
ALTER TABLE `panier`
  MODIFY `panier_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `participation_achat_partage`
--
ALTER TABLE `participation_achat_partage`
  MODIFY `participation_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produit`
--
ALTER TABLE `produit`
  MODIFY `produit_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `utilisateur_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_2` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`utilisateur_id`);

--
-- Constraints for table `commande_produit`
--
ALTER TABLE `commande_produit`
  ADD CONSTRAINT `commande_produit_ibfk_1` FOREIGN KEY (`commande_id`) REFERENCES `commande` (`commande_id`),
  ADD CONSTRAINT `commande_produit_ibfk_2` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`produit_id`);

--
-- Constraints for table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`produit_id`),
  ADD CONSTRAINT `commentaire_ibfk_2` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`utilisateur_id`);

--
-- Constraints for table `offre_achat_partage`
--
ALTER TABLE `offre_achat_partage`
  ADD CONSTRAINT `offre_achat_partage_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`utilisateur_id`),
  ADD CONSTRAINT `offre_achat_partage_ibfk_2` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`produit_id`);

--
-- Constraints for table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`utilisateur_id`);

--
-- Constraints for table `panier_produit`
--
ALTER TABLE `panier_produit`
  ADD CONSTRAINT `panier_produit_ibfk_1` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`produit_id`),
  ADD CONSTRAINT `panier_produit_ibfk_2` FOREIGN KEY (`panier_id`) REFERENCES `panier` (`panier_id`);

--
-- Constraints for table `participation_achat_partage`
--
ALTER TABLE `participation_achat_partage`
  ADD CONSTRAINT `participation_achat_partage_ibfk_1` FOREIGN KEY (`offre_id`) REFERENCES `offre_achat_partage` (`offre_id`),
  ADD CONSTRAINT `participation_achat_partage_ibfk_2` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`produit_id`),
  ADD CONSTRAINT `participation_achat_partage_ibfk_3` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`utilisateur_id`);

--
-- Constraints for table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`categorie_id`) REFERENCES `categorieproduit` (`categorie_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
