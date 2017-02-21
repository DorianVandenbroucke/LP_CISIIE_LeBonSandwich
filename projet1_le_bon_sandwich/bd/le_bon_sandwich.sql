-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 21 Février 2017 à 20:15
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `le_bon_sandwich`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `nom` varchar(64) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`, `description`) VALUES
(1, 'salades', 'Nos bonnes salades, fraichement livrées par nos producteurs bios et locaux'),
(2, 'crudités', 'Nos crudités variées  et préparées avec soin, issues de producteurs locaux et bio pour la plupart.'),
(3, 'viandes', 'Nos viandes finement découpées et cuites comme vous le préférez. Viande issue d\'élevages certifiés et locaux.'),
(4, 'Fromages', 'Nos fromages bios et au lait cru. En majorité des AOC.'),
(5, 'Sauces', 'Toutes les sauces du monde !');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `montant` float NOT NULL,
  `date_de_livraison` date NOT NULL,
  `etat` varchar(20) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `commande`
--

INSERT INTO `commande` (`id`, `montant`, `date_de_livraison`, `etat`, `token`) VALUES
(3, 0, '1970-01-01', '1', 'dqDkmheCQz2BuJHjHTmsIRcBejyH7N9Y'),
(4, 0, '1970-01-01', '1', '8ubwgkUBgYZVLw3S8ig+Fb42IAycsZ6r'),
(5, 1, '1970-01-01', '1', 'a+G5VR0vn0b6n53RqLUZUgrWFgvKoXCf'),
(6, 4.6, '1970-01-01', '1', '1ZULE+tR4AQP4j26lMKuro7npoaGiPJ1'),
(7, 0, '1970-01-01', '1', 'b5c39UY7nnxef3HKz6nKxT1X7K2OkRt+'),
(8, 0, '1970-01-01', '1', 'EgtdwkCjM1RJexCsTbxoNM3sBF3QL54v'),
(9, 0, '1970-01-01', '1', '9tYso1A7xo4cle+rDXIhuSLLZBWlwZO7'),
(10, 0, '2017-01-31', '1', 'wVnnjeoolTSLo6hbyV7GkEGl43jzGDHh'),
(11, 0, '2017-01-31', '1', 'iTCTVHQovlGsD5rhE05HypaM5t8sgtD2'),
(12, 0, '2017-01-31', '1', 'a2nZDg6CdFP8Sw2ZWWuS+NTrm0oHbH6z'),
(13, 0, '2017-01-31', '1', 'Wcd3OB+02CKH6lm96MUIv8ll6TfccGXq'),
(15, 5.3, '2017-02-02', '1', 'NleV7iRfbt1vLX/Qd8WqYqnCNoUYa+yY');

-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

CREATE TABLE `ingredient` (
  `id` int(11) NOT NULL,
  `nom` varchar(64) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `description` text,
  `fournisseur` varchar(128) DEFAULT NULL,
  `img` varchar(128) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `ingredient`
--

INSERT INTO `ingredient` (`id`, `nom`, `cat_id`, `description`, `fournisseur`, `img`) VALUES
(1, 'laitue', 1, 'belle laitue verte', 'ferme "la bonne salade"', NULL),
(2, 'roquette', 1, 'la roquette qui pète ! bio, bien sur, et sauvage', 'ferme "la bonne salade"', NULL),
(3, 'mâche', 1, 'une mâche toute jeune et croquante', 'ferme "la bonne salade"', NULL),
(4, 'carottes', 2, 'belles carottes bio, rapées avec amour', 'au jardin sauvage', NULL),
(5, 'concombre', 2, 'concombre de jardin, bio et bien frais', 'au jardin sauvage', NULL),
(6, 'avocat', 2, 'avocats en direct du Mexique !', 'la huerta bonita, Puebla', NULL),
(7, 'blanc de poulet', 3, 'blanc de poulet émincé, et grillé comme il faut', 'élevage "le poulet volant"', NULL),
(8, 'magret de canard', 3, 'magret de canard grillé, puis émincé', 'le colvert malin', NULL),
(9, 'steack haché', 3, 'notre steack haché saveur, 5% MG., préparé juste avant cuisson.\r\nViande de notre producteur local.', 'ferme "la vache qui plane"', NULL),
(10, 'munster', 4, 'Du munster de Munster, en direct. Pour amateurs avertis !', 'fromagerie "le bon munster de toujours"', NULL),
(11, 'chèvre frais', 4, 'un chèvre frais onctueux et goutu !', 'A la chèvre rieuse', NULL),
(12, 'comté AOC 18mois', 4, 'le meilleur comté du monde !', 'fromagerie du jura', NULL),
(13, 'vinaigrette huile d\'olive', 5, 'la vinaigrette éternelle, à l\'huile d\'olive et moutarde à l\'ancienne.', 'Le Bon Sandwich', NULL),
(14, 'salsa jalapeña', 5, 'sauce très légérement pimentée :-)', 'El Yucateco', NULL),
(15, 'salsa habanera', 5, 'Pour initiés uniquement, dangereux sinon !', 'EL yucateco', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ingredient_sandwich`
--

CREATE TABLE `ingredient_sandwich` (
  `id_ingredient` int(11) NOT NULL,
  `id_sandwich` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `ingredient_sandwich`
--

INSERT INTO `ingredient_sandwich` (`id_ingredient`, `id_sandwich`) VALUES
(10, 14),
(3, 14),
(9, 16),
(2, 16);

-- --------------------------------------------------------

--
-- Structure de la table `sandwich`
--

CREATE TABLE `sandwich` (
  `id` int(11) NOT NULL,
  `type_de_pain` varchar(255) NOT NULL,
  `taille` varchar(255) NOT NULL,
  `id_commande` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `sandwich`
--

INSERT INTO `sandwich` (`id`, `type_de_pain`, `taille`, `id_commande`) VALUES
(5, 'complet', 'petite faim', 1),
(6, 'complet', 'petite faim', 1),
(7, 'complet', 'petite faim', 1),
(8, 'blanc', 'petite faim', 1),
(9, 'blanc', 'petite faim', 1),
(10, 'blanc', 'ogre', 2),
(11, 'blanc', 'petite faim', 5),
(12, 'blanc', 'petite faim', 6),
(13, 'blanc', 'grosse faim', 6),
(14, 'blanc', 'grosse faim', 6),
(15, 'blanc', 'ogre', 15),
(16, 'blanc', 'ogre', 15);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sandwich`
--
ALTER TABLE `sandwich`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pour la table `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pour la table `sandwich`
--
ALTER TABLE `sandwich`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
