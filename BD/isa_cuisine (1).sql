-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 07 avr. 2023 à 11:01
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `isa_cuisine`
--

-- --------------------------------------------------------

--
-- Structure de la table `ingredients`
--

CREATE TABLE `ingredients` (
  `id_ingredient` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ingredients`
--

INSERT INTO `ingredients` (`id_ingredient`, `nom`, `image`) VALUES
(1, 'pilons de poulet', 'pilons de poulet'),
(2, 'oignons', 'oignons'),
(3, 'farine', 'farine'),
(4, 'l\'agneuax', 'l\'agneaux'),
(5, 'poissons', 'poissons'),
(6, 'viande', 'viande'),
(7, 'sel', 'sel'),
(8, 'poivron', 'poivron'),
(9, 'tomates', 'tomates'),
(10, 'carottes', 'carottes'),
(11, 'courgettes', 'courgettes'),
(12, 'pomme-de-terre', 'pomme-de-terre'),
(13, 'semoule', 'semoule'),
(14, 'huile', 'huile'),
(15, 'NOIX DE COCO', 'Noix de coco'),
(16, 'cannelle', 'cannelle'),
(17, 'BANANE', 'BANANE'),
(18, 'pomme', 'pomme'),
(19, 'Vermicelles de blé', 'Vermicelles de blé'),
(20, 'huile d\'olive', 'huile d\'olive'),
(21, 'Sucre en poudre', 'Sucre en poudre'),
(22, 'Raisins secs ', 'Raisins secs'),
(23, 'Amandes', 'Amandes'),
(24, 'Eau', 'Eau'),
(25, 'feuilles de brick', 'feuilles de brick'),
(26, 'beurre', 'beurre'),
(27, 'des fruits de mer', 'des fruits de mer'),
(28, 'safran', 'safran'),
(29, '', ''),
(32, 'epinards', 'epinards'),
(33, 'L\'ail', 'l\'ail'),
(34, 'epinards', 'epinards');

-- --------------------------------------------------------

--
-- Structure de la table `plats_tag`
--

CREATE TABLE `plats_tag` (
  `id_recette` int(255) NOT NULL,
  `id_tag` int(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `plats_tag`
--

INSERT INTO `plats_tag` (`id_recette`, `id_tag`, `id`) VALUES
(1, 2, 1),
(2, 2, 2),
(3, 2, 3),
(4, 2, 4),
(5, 2, 5),
(6, 2, 6),
(7, 2, 7),
(8, 2, 8),
(9, 1, 9),
(10, 1, 10),
(12, 1, 11),
(11, 1, 12);

-- --------------------------------------------------------

--
-- Structure de la table `recette`
--

CREATE TABLE `recette` (
  `id_recette` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `recette`
--

INSERT INTO `recette` (`id_recette`, `titre`, `image`, `description`) VALUES
(1, 'Seffa', 'La seffa marocaine.', 'Un plat traditionnel marocain,elle est est souvent servie lors de grandes occasions et de fêtes, en particulier pendant le mois sacré du Ramadan. C’est un plat sucré et parfumé qui peut être dégusté comme dessert ou comme plat princ'),
(2, 'Tagine', 'Tagine marocain', 'Le tajine marocain est un plat traditionnel emblématique du Maroc, qui tire son nom du récipient en terre cuite dans lequel il est cuit. Il s\'agit d\'un plat mijoté à feu doux, qui associe souvent des viandes, des légumes, des fruits secs et des épices pou'),
(3, ' pastilla', 'pastilla marocaine', 'La bestila (aussi appelée pastilla) est un plat traditionnel marocain, qui est souvent servi lors de grandes occasions et de fêtes, en particulier lors des mariages.'),
(4, 'Harira marocaine', 'harira', 'La Harira est une soupe traditionnelle marocaine, épaisse et copieuse, souvent servie comme plat principal pendant le mois sacré de Ramadan'),
(5, 'couscous marocain', 'couscous', 'Le couscous est un plat de fête au Maroc, souvent servi lors de grandes occasions et de célébrations familiales. C\'est également un plat très populaire dans les restaurants marocains du monde entier.'),
(6, 'tanjiya', 'tanjiya marrakech', 'Tanjia marrakchia : C\'est un plat traditionnel de Marrakech qui est préparé avec de l\'agneau mijoté dans une jarre en argile avec des épices (cumin, coriandre, safran), de l\'ail et des légumes. La viande est très tendre et est souvent servie avec du pain '),
(7, 'rfissa', 'rfissa marocaine', 'Rfissa est un plat traditionnel marocain à base de poulet, de lentilles et de msemen (une sorte de pain plat). Les lentilles sont cuites avec des épices et du bouillon de poulet pour créer une sauce épaisse et savoureuse.'),
(8, 'crêpe marocaine msemen', 'crêpe marocaine msemen', ' msemen sont souvent servis pour le petit déjeuner ou le goûter, accompagnés de beurre fondu, de miel ou de confiture. '),
(9, 'salade tektouka', 'salade tektouka', 'La salade taktouka est une salade marocaine populaire qui est généralement faite avec des poivrons et des tomates rôtis ou grillés'),
(10, 'salade carottes', 'salade carotte', 'La salade de carottes marocaine est une variante de la salade de carottes classique, mais avec des ingrédients marocains traditionnels qui lui donnent une saveur unique.'),
(11, 'salade bakoula', 'salade epinard (bekoula)', 'La salade d’épinards marocaine, également connue sous le nom de « bekoula », est une salade fraîche et saine qui est souvent servie comme entrée ou accompagnement dans la cuisine marocaine.'),
(12, 'Salade variée', 'salade variée', 'La salade variée marocaine est une salade polyvalente et colorée, souvent servie comme entrée ou accompagnement dans la cuisine marocaine. Elle est composée d’un mélange d’ingrédients frais et savoureux, qui sont découpés en petits morceaux et mélangés en');

-- --------------------------------------------------------

--
-- Structure de la table `recette_ingredient`
--

CREATE TABLE `recette_ingredient` (
  `id_recettes` int(255) NOT NULL,
  `id_ingredients` int(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `recette_ingredient`
--

INSERT INTO `recette_ingredient` (`id_recettes`, `id_ingredients`, `id`) VALUES
(1, 13, 1),
(1, 14, 2),
(1, 16, 3),
(1, 19, 4),
(1, 20, 5),
(1, 21, 6),
(1, 22, 7),
(1, 23, 8),
(1, 24, 9),
(2, 1, 10),
(2, 2, 11),
(2, 7, 12),
(2, 8, 13),
(2, 9, 14),
(2, 10, 15),
(2, 11, 16),
(2, 12, 17),
(2, 14, 18),
(2, 24, 19),
(3, 1, 20),
(3, 2, 21),
(3, 7, 22),
(3, 8, 23),
(3, 14, 24),
(3, 16, 25),
(2, 21, 26),
(2, 23, 27),
(2, 24, 28),
(2, 25, 29),
(4, 2, 30),
(4, 14, 31),
(4, 24, 32),
(4, 24, 33),
(4, 6, 34),
(4, 9, 35),
(11, 20, 36);

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE `tags` (
  `id_tag` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tags`
--

INSERT INTO `tags` (`id_tag`, `nom`) VALUES
(1, 'salades'),
(2, 'plats'),
(3, 'jus');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id_ingredient`);

--
-- Index pour la table `plats_tag`
--
ALTER TABLE `plats_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tag` (`id_tag`),
  ADD KEY `id_recette` (`id_recette`);

--
-- Index pour la table `recette`
--
ALTER TABLE `recette`
  ADD PRIMARY KEY (`id_recette`);

--
-- Index pour la table `recette_ingredient`
--
ALTER TABLE `recette_ingredient`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ingredients` (`id_ingredients`),
  ADD KEY `id_recettes` (`id_recettes`);

--
-- Index pour la table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id_tag`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id_ingredient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pour la table `plats_tag`
--
ALTER TABLE `plats_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `recette`
--
ALTER TABLE `recette`
  MODIFY `id_recette` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `recette_ingredient`
--
ALTER TABLE `recette_ingredient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT pour la table `tags`
--
ALTER TABLE `tags`
  MODIFY `id_tag` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `plats_tag`
--
ALTER TABLE `plats_tag`
  ADD CONSTRAINT `plats_tag_ibfk_1` FOREIGN KEY (`id_tag`) REFERENCES `tags` (`id_tag`),
  ADD CONSTRAINT `plats_tag_ibfk_2` FOREIGN KEY (`id_recette`) REFERENCES `recette` (`id_recette`);

--
-- Contraintes pour la table `recette_ingredient`
--
ALTER TABLE `recette_ingredient`
  ADD CONSTRAINT `recette_ingredient_ibfk_1` FOREIGN KEY (`id_ingredients`) REFERENCES `ingredients` (`id_ingredient`),
  ADD CONSTRAINT `recette_ingredient_ibfk_2` FOREIGN KEY (`id_recettes`) REFERENCES `recette` (`id_recette`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
