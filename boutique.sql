-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 16 juil. 2023 à 12:39
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `boutique`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

DROP TABLE IF EXISTS `adresse`;
CREATE TABLE IF NOT EXISTS `adresse` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `firstname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `numero` int NOT NULL,
  `rue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `codePostal` int NOT NULL,
  `ville` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `adresse`
--

INSERT INTO `adresse` (`id`, `id_user`, `firstname`, `lastname`, `numero`, `rue`, `codePostal`, `ville`) VALUES
(5, 4, 'Toto', 'Toto', 1, 'rue republique', 75001, 'Paris');

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `idArt` int NOT NULL AUTO_INCREMENT,
  `titreArt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `date` date NOT NULL,
  `id_categorie` int NOT NULL,
  `id_sousCategorie` int NOT NULL,
  `quantite` int NOT NULL,
  `imgArt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `promotion` int NOT NULL,
  PRIMARY KEY (`idArt`)
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`idArt`, `titreArt`, `description`, `prix`, `date`, `id_categorie`, `id_sousCategorie`, `quantite`, `imgArt`, `promotion`) VALUES
(9, 'Boucles d\'oreilles Jasmin', 'Boucles d\'oreilles longues doré à l\'or fin, formées de différents motifs en nacre.\r\nRavissantes boucles à l\'aspect sobre et efficace qui saura faire son effet.\r\n\r\nLongueur : 65mm\r\nPoids d\'une boucle : 4,16g', '55.00', '2023-05-25', 3, 1, 9, 'https://cdn.shopify.com/s/files/1/0602/7975/0845/products/SEC18315-01SEL-P_380x443_crop_center.jpg?v=1667234371', 0),
(10, 'Boucles d\'oreilles Sunrise', 'Boucles d\'oreilles en acier doré à l\'or fin présentant un cercle à demi coloré.\r\nNous conseillons de les porter en accumulation afin de rehausser le style.\r\nDéclinées en bracelet, collier et bague\r\nDiamètre : 12mm\r\nPoids de la boucle : 0,77g', '30.00', '2023-05-16', 3, 3, 20, 'https://cdn.shopify.com/s/files/1/0602/7975/0845/products/SEM19703-01TQB-P1_380x443_crop_center.jpg?v=1678878425', 0),
(11, 'Boucles d\'oreilles Lilith', 'Boucles d\'oreilles en acier doré à l\'or fin représentant un cercle martelé à l\'image d\'un soleil.L\'effet martelé de ce bijou amène un air ethnique à votre tenue. Idéal si vous souhaitez élever votre tenue sans effort.Diamètre : 28mmPoids: 2,06g', '35.00', '2023-07-03', 3, 4, 0, 'https://cdn.shopify.com/s/files/1/0602/7975/0845/products/SEM19976-01UNI-NM_380x443_crop_center.jpg?v=1677841640', 0),
(12, 'Earcuff Chanty', 'Un earcuff ajustable en acier uni ou doré à l’or fin qu’il suffit simplement d’enfiler sur le l’oreille.\r\nMinimaliste et tellement stylé, cet accessoire se porte aussi bien seul qu’en accumulation avec d’autres boucles.\r\nÀ l’unité, pour les mixer à votre guise !\r\nLargeur : 10mm', '20.00', '2023-06-08', 3, 2, 0, 'https://cdn.shopify.com/s/files/1/0602/7975/0845/products/earcuff-chanty-acier-dore-portees_380x443_crop_center.jpg?v=1654079288', 0),
(13, 'Bracelet Ma bonne étoile', 'Bracelet chaînette en acier uni ou doré à l\'or fin sur laquelle une médaille est gravée du message \"Ma bonne étoile\".\r\nUn ravissant petit bracelet nous rappelant qu\'il faut croire en sa bonne étoile !\r\nDécliné en collier, bague et charm\r\nLongueur : 15cm e', '25.00', '2023-03-08', 2, 5, 15, 'https://cdn.shopify.com/s/files/1/0602/7975/0845/products/bracelet-ma-bonne-etoile-acier-dore_380x443_crop_center.jpg?v=1653051499', 0),
(14, 'Bracelet Sienna', 'Bracelet chaînette en acier uni ou doré à l’or fin sur lequel deux petits cœurs de métal sont attachés ainsi qu’un petit zirconium en pampille.\r\nC’est un très joli bijou d’amour qui se porte comme une seconde peau et ne s’enlève jamais.\r\nDécliné en collie', '30.00', '2023-03-08', 2, 5, 17, 'https://cdn.shopify.com/s/files/1/0602/7975/0845/products/Bracelet-Sienna_2c36a2e7-c42e-49fc-aa22-67cba65e5d86_380x443_crop_center.jpg?v=1653314091', 0),
(15, 'Bracelet Cyloeh', 'Bracelet en acier doré à l\'or fin sur lequel est attaché un motif de papillon ciselé et orné de nacre et d\'un zirconium.\r\nNous conseillons de le porter avec d\'autres bracelets de nos collections afin de rehausser le style.\r\nDécliné en boucles d\'oreilles e', '35.00', '2023-03-08', 2, 5, 8, 'https://cdn.shopify.com/s/files/1/0602/7975/0845/products/SBS18073-01SEL-P_380x443_crop_center.jpg?v=1667402318', 0),
(16, 'Bracelet Star', 'Bracelet triple chaîne en acier uni ou doré à l\'or fin sur laquelle sont accrochées une étoile et une pastille de métal.\r\nCe superbe bracelet occupe magnifiquement le poignet sur lequel il est établi.\r\nDécliné en collier\r\nLongueur : 15cm et 3cm de réglage', '45.00', '2023-03-05', 2, 6, 17, 'https://cdn.shopify.com/s/files/1/0602/7975/0845/products/Bracelet-Newton-Bracelet-Star_e5e09ddc-fccd-4ecb-84ea-97b9eff35461_380x443_crop_center.jpg?v=1652958930', 0),
(17, 'Bracelet Cross', 'Bracelet multi-rang coloré sur lequel sont enfilées des perles de pierres fines et une petite croix en nacre ou en turquoise.\r\nCe bracelet se porte comme un talisman protecteur.\r\nLongueur : 2 tours ajustables avec chaîne de rallonge', '49.00', '2023-03-05', 2, 6, 18, 'https://cdn.shopify.com/s/files/1/0602/7975/0845/products/bracelet-cross-acier-dore-nacre_380x443_crop_center.jpg?v=1652948636', 0),
(18, 'Collier Nawel', 'Collier multi-rang en acier doré à l\'or fin. Sur la première chaîne se trouvent trois pastilles serties d\'un zirconium en leur centre et sur la seconde chaîne, un pendentif avec un cercle dans un anneau.\r\nCe bijou a beaucoup d\'allure et habille tout de su', '45.00', '2023-06-12', 4, 7, 12, 'https://cdn.shopify.com/s/files/1/0602/7975/0845/products/SNX20161-01WHT-P1_380x443_crop_center.jpg?v=1679324957', 0),
(19, 'Collier Sahas', '\r\nCollier en acier doré à l\'or fin à double rang, dont l\'une des deux chaînes présentent des pampilles en zirconiums colorés qui représentent les couleurs des 7 chakras : racine, sacré, plexus solaire, coeur, gorge, 3ème oeil et couronne.\r\nCe bijou a beau', '55.00', '2023-05-12', 4, 7, 16, 'https://cdn.shopify.com/s/files/1/0602/7975/0845/products/SNX19736-01MIX-P1_380x443_crop_center.jpg?v=1678722414', 0),
(20, 'Collier Anouchka', 'Collier en acier doré à l\'or fin sur lequel deux zirconiums sont attachés. Trois chaînettes y sont suspendues.\r\nCe bijou a beaucoup d\'allure et se porte aussi bien seul qu\'en accumulation avec d\'autres colliers de nos collections.\r\nDécliné en bracelet et ', '45.00', '2023-05-04', 4, 8, 11, 'https://cdn.shopify.com/s/files/1/0602/7975/0845/products/SNM19887-01GRN-P1_380x443_crop_center.jpg?v=1677663287', 0),
(21, 'Sautoir Pera', 'Collier long en acier uni ou doré à l\'or fin sur lequel est suspendu un pendentif de forme géométrique en forme de poire.\r\nPorté seul ou en accumulation, ce petit bijou est magnifique pour complémenter vos tenues plus estivales.\r\nLongueur : 75cm et 5cm de', '45.00', '2023-05-25', 4, 9, 15, 'https://cdn.shopify.com/s/files/1/0602/7975/0845/products/sautoir-pera-acier-dore_380x443_crop_center.jpg?v=1651764278', 0),
(22, 'Sautoir Astra', 'Collier long en acier doré à l’or fin sur lequel un motif ciselé d’un soleil d’or se place sur une médaille de nacre ou d’acétate de couleurs.\r\nCe long sautoir est une pièce maîtresse de nos collections et peut se porter avec les boucles d’oreilles assort', '55.00', '2023-04-11', 4, 9, 13, 'https://cdn.shopify.com/s/files/1/0602/7975/0845/products/Collier-Astra-Collier-Love-Collier-Rabi_380x443_crop_center.jpg?v=1662733543', 0),
(23, 'Sautoir Moonflower', 'Collier long en acier uni ou doré à l’or fin sur lequel est accrochée une médaille de nacre piquée en son centre d’un motif de fleur en zirconiums brillants.\r\nCe sautoir au look précieux pourra se porter mélanger avec d’autres colliers de nos collections ', '59.00', '2023-04-11', 4, 9, 14, 'https://cdn.shopify.com/s/files/1/0602/7975/0845/products/SNL13589-01SEL-P1_380x443_crop_center.jpg?v=1678374503', 0),
(24, 'Bague Fiore', 'Bague ajustable en acier doré à l\'or fin avec un motif de fleur coloré.\r\nNous conseillons de la porter en accumulation avec d\'autres bagues de nos collections.\r\nDéclinée en boucles d\'oreilles, jonc, bracelet et collier\r\nDiamètre : ajustable', '30.00', '2023-02-20', 5, 10, 12, 'https://cdn.shopify.com/s/files/1/0602/7975/0845/products/SRM19751_380x443_crop_center.jpg?v=1679046891', 0),
(25, 'Bague Louve', 'Bague ajustable en acier doré à l\'or fin sur laquelle se trouve une forme géométrique composée de pierre naturelle en son centre et de zirconiums colorés.\r\nElle est très élégante et apporte une touche subtile de couleur sur vos mains.\r\nDiamètre : ajustabl', '39.00', '2023-02-20', 5, 10, 2, 'https://cdn.shopify.com/s/files/1/0602/7975/0845/products/SRM19822-01GRN-P1_380x443_crop_center.jpg?v=1679328248', 0),
(26, 'Bague Nacera', 'Bague ajustable en acier doré à l\'or fin sur laquelle est attachée une pastille en nacre.\r\nNous conseillons de la porter en accumulation avec d\'autres bagues de nos collections.\r\nDiamètre : ajustable\r\nLargeur : 8mm \r\nPastille : 11mm', '35.00', '2022-10-10', 5, 11, 3, 'https://cdn.shopify.com/s/files/1/0602/7975/0845/products/SRM19658-01SEL-P1_380x443_crop_center.jpg?v=1678093161', 0),
(27, 'Bague Cassidy', 'Bague martelée ajustable en acier doré à l\'or fin à double rangée. Sur l\'une des deux rangées se trouvent des zirconiums colorés qui apportent de l\'éclat au bijou.\r\nSon allure ethnique chic habille sans effort. Elle se porte aussi bien seule qu\'accumulée ', '30.00', '2022-10-10', 5, 11, 0, 'https://cdn.shopify.com/s/files/1/0602/7975/0845/products/SRT20039-01WHT-P1_380x443_crop_center.jpg?v=1679327114', 0),
(28, 'Bague Cameleo', 'Bague ajustable en acier doré à l\'or fin martelée.\r\nCette pièce élégante habille tout de suite votre main. Elle se porte seule ou bien accumulée avec d\'autres bagues de nos collections.\r\nDéclinée en jonc \r\nDiamètre : ajustable\r\nLargeur : 18mm', '30.00', '2022-10-10', 5, 12, 0, 'https://cdn.shopify.com/s/files/1/0602/7975/0845/products/SRL19908-01MAT-P2_380x443_crop_center.jpg?v=1677832809', 0),
(29, 'Orion rose', 'L\'or rose glamour rencontre le titane audacieux, un duo cosmique. L\'Orion Rose de 38 mm transmet une crainte pour le céleste avec une sensibilité de conception tournée vers l\'avenir et une fonctionnalité de double fuseau horaire.', '199.00', '2023-05-11', 6, 11, 4, 'https://www.mvmt.com/dw/image/v2/BDKZ_PRD/on/demandware.static/-/Sites-mgi-master/default/dw588e350b/images/products/FC01-TIRG_l_4.jpg?sw=453&sh=453', 0),
(30, 'Santa Monica Black', 'Inspiré des rues emblématiques de Los Angeles, la Santa Monica Black est l\'essence d\'une pièce minimaliste. Ce modèle de 38 mm présente un coloris noir et or rose brossé saisissant.', '129.00', '2023-06-11', 6, 12, 1, 'https://www.mvmt.com/dw/image/v2/BDKZ_PRD/on/demandware.static/-/Sites-mgi-master/default/dw1170c2fe/images/products/MB01-RGBL_l_2.jpg?sw=800&sh=800', 0),
(31, 'Reina gold', 'Une montre-bijoux. Marqueurs cardinaux en forme de boucle. Un look classique qui survit aux tendances. La Reina s\'inspire des éléments de design de mode de longue date que nous admirons le plus. Doté d\'un bracelet double tour, un clin d\'œil au look deux m', '149.00', '2023-06-24', 6, 12, 0, 'https://www.mvmt.com/dw/image/v2/BDKZ_PRD/on/demandware.static/-/Sites-mgi-master/default/dwc5b02f96/images/products/28000303_l_3.jpg?sw=800&sh=800', 0);

-- --------------------------------------------------------

--
-- Structure de la table `carousel`
--

DROP TABLE IF EXISTS `carousel`;
CREATE TABLE IF NOT EXISTS `carousel` (
  `id` int NOT NULL AUTO_INCREMENT,
  `imgCarousel` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `titreCarousel` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `texteCarousel` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `carousel`
--

INSERT INTO `carousel` (`id`, `imgCarousel`, `titreCarousel`, `texteCarousel`) VALUES
(1, 'https://piwii.fr/wp-content/uploads/2018/02/Capture-d%E2%80%99e%CC%81cran-2020-01-10-a%CC%80-14.59.01.png', 'Notre collection de bracelets ', 'De jolis bracelets pour vos soirées d\'été.'),
(2, 'https://cdn.shopify.com/s/files/1/0602/7975/0845/products/SEM19976-01UNI-NM_380x443_crop_center.jpg?v=1677841640', 'Summer vibes!', 'L\'été arrive, avec ces boucles soyez aussi brillante que le soleil!'),
(3, 'https://www.mvmt.com/dw/image/v2/BDKZ_PRD/on/demandware.static/-/Sites-mgi-master/default/dw1170c2fe/images/products/MB01-RGBL_l_2.jpg?sw=800&sh=800', 'Ne loupez plus aucun evenement.', 'L\'été arrive, et avec lui les barbecues entre amis, les sorties bateaux et les piquenique sur la plage. Ne soyez plus en retard et profitez de l\'été!');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `idCat` int NOT NULL AUTO_INCREMENT,
  `titreCat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `imgCat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idCat`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`idCat`, `titreCat`, `imgCat`) VALUES
(2, 'Bracelets', 'https://piwii.fr/wp-content/uploads/2018/02/Capture-d%E2%80%99e%CC%81cran-2020-01-10-a%CC%80-14.59.01.png'),
(3, 'Boucles d\'oreilles', 'https://cdn.shopify.com/s/files/1/2364/4415/products/IMG_9208.heic?v=1680018166'),
(4, 'Colliers', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcST0odZORloL-gwfnNrIk54G_iwoMP7HkRC-w&usqp=CAU'),
(5, 'Bagues', 'https://cdn.shopify.com/s/files/1/0272/2489/9683/products/bague-rubis-fines-989A0237_700x.jpg?v=1634130923'),
(6, 'Montres', 'https://www.histoiredor.com/dw/image/v2/BCQS_PRD/on/demandware.static/-/Sites-THOM_CATALOG/default/dw345e35f4/images/HIMFJQC712-model0.jpg?sw=750&sh=750');

-- --------------------------------------------------------

--
-- Structure de la table `codepromo`
--

DROP TABLE IF EXISTS `codepromo`;
CREATE TABLE IF NOT EXISTS `codepromo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `valeur` int NOT NULL,
  `date_expiration` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `codepromo`
--

INSERT INTO `codepromo` (`id`, `code`, `valeur`, `date_expiration`) VALUES
(1, 'Bijoux35', 35, '2023-07-27');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `adresse` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date` date NOT NULL,
  `prixTotal` decimal(10,2) NOT NULL,
  `paymentIntentId` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `id_user`, `adresse`, `phone`, `date`, `prixTotal`, `paymentIntentId`) VALUES
(28, 4, 'Too Toto 1 rue republique 75001 Paris', '06 04 93 95 23', '2023-07-06', '234.99', 'pi_3NQnAuJ37nAgG00X1nj3YGnY'),
(29, 4, 'Too Toto 1 rue republique 75001 Paris', '06 04 93 95 23', '2023-07-16', '59.99', 'pi_3NUTzXJ37nAgG00X0c3JHgHd');

-- --------------------------------------------------------

--
-- Structure de la table `commandpanier`
--

DROP TABLE IF EXISTS `commandpanier`;
CREATE TABLE IF NOT EXISTS `commandpanier` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_commande` int NOT NULL,
  `id_article` int NOT NULL,
  `quantite_art` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commandpanier`
--

INSERT INTO `commandpanier` (`id`, `id_commande`, `id_article`, `quantite_art`) VALUES
(17, 21, 10, 0),
(18, 22, 24, 0),
(19, 22, 25, 0),
(20, 23, 14, 0),
(21, 24, 15, 0),
(22, 24, 16, 0),
(23, 25, 16, 0),
(24, 26, 17, 0),
(25, 27, 13, 0),
(26, 28, 13, 2),
(27, 28, 10, 6),
(28, 29, 9, 1);

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_article` int NOT NULL,
  `quantite_art` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`id`, `id_user`, `id_article`, `quantite_art`) VALUES
(28, 6, 18, 2);

-- --------------------------------------------------------

--
-- Structure de la table `souscategorie`
--

DROP TABLE IF EXISTS `souscategorie`;
CREATE TABLE IF NOT EXISTS `souscategorie` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titreSousCat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `imgSousCat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_parent` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `souscategorie`
--

INSERT INTO `souscategorie` (`id`, `titreSousCat`, `imgSousCat`, `id_parent`) VALUES
(1, 'Boucles longues', 'https://cdn.shopify.com/s/files/1/0602/7975/0845/products/SEL19973-01GRN-NM_380x442_crop_center.jpg?v=1679327540', 3),
(2, 'Earcuffs', 'https://cdn.shopify.com/s/files/1/0602/7975/0845/products/earcuff-randa-acier-dore-1-portees_380x443_crop_center.jpg?v=1654079953', 3),
(3, 'Mini boucles', 'https://cdn.shopify.com/s/files/1/0602/7975/0845/products/SES20140-01TQB-P2_380x443_crop_center.jpg?v=1684148052', 3),
(4, 'Boucles medium', 'https://cdn.shopify.com/s/files/1/0602/7975/0845/products/SEC18556-01UNI-P_380x443_crop_center.jpg?v=1669624528', 3),
(5, 'Bracelets simples', 'https://cdn.shopify.com/s/files/1/0602/7975/0845/products/Collier-Ange-Bracelet-Velasquez-1_380x443_crop_center.jpg?v=1683193524', 2),
(6, 'Bracelets multi-rangs', 'https://cdn.shopify.com/s/files/1/0602/7975/0845/products/SBX16201-01CFE-P1_380x443_crop_center.jpg?v=1678350669', 2),
(7, 'Colliers mutil-rangs', 'https://cdn.shopify.com/s/files/1/0602/7975/0845/products/SNX20398-01WHT-P1_380x443_crop_center.jpg?v=1679053878', 4),
(8, 'Colliers medium', 'https://cdn.shopify.com/s/files/1/0602/7975/0845/products/SNM20301-01RED-P1_2777ef05-a0c3-48e0-8543-e4fb397ea11b_380x443_crop_center.jpg?v=1679065559', 4),
(9, 'Sautoirs', 'https://cdn.shopify.com/s/files/1/0602/7975/0845/products/Sautoir-Alpha-Bracelet-Galaxy-840x980_eb4ac284-f2ee-4c34-8532-95f7b47195ac_380x443_crop_center.jpg?v=1649256768', 4),
(10, 'Bagues fines', 'https://cdn.shopify.com/s/files/1/0602/7975/0845/products/bague-atomium-acier-dore-portee_380x443_crop_center.jpg?v=1668674256', 5),
(11, 'Bagues larges', 'https://cdn.shopify.com/s/files/1/0602/7975/0845/products/SRL19927-01MAT-P1_380x443_crop_center.jpg?v=1678458485', 5),
(12, 'Montres femme', 'https://www.rienasemettre.fr/wp-content/uploads/2019/12/montre-femme-tendance-guide-achat.jpg', 6);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `firstname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phoneUser` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `firstname`, `lastname`, `avatar`, `phoneUser`) VALUES
(4, 'toto@toto.com', '$2y$10$46Arck0Y.tYTGJ7IUR6rNezORV84MryqzSKGSnzM0XUPKS6/jpRDW', 'Toto', 'Too', 'gif', '06 04 93 95 23'),
(6, 'cam@cam.fr', '$2y$10$Sm5LfUiQeoJFCwWgKI8KaeATgoPEtTEjQGw9gV/MpBgtF9fvAI/Om', 'cam', 'cam', 'avatars/default.png', NULL),
(8, 'admin@admin.fr', '$2y$10$O4sH4/equ6wC6U8DHS8W1uFDa53KHffknTg19ypj5ED5TecAJFZpG', 'admin', 'admin', 'avatars/default.png', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
