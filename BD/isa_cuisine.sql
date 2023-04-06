-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 31 mars 2023 à 15:57
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.0.25

SET
SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET
time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `isa_cuisine`
--

-- --------------------------------------------------------

--
-- Structure de la table `listes`
--

CREATE TABLE `ingredients`
(
    `id_ingredient` int(11) NOT NULL,
    `nom`           varchar(255) NOT NULL,
    `image`         varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `plats_tag`
--

CREATE TABLE `recette_tag`
(
    `id_recette` int(255) NOT NULL,
    `id_tag`     int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `recette`
--

CREATE TABLE `recette`
(
    `id_recette`  int(11) NOT NULL,
    `titre`       varchar(255) NOT NULL,
    `image`       varchar(255) NOT NULL,
    `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `recette_list`
--

CREATE TABLE `recette_ingredient`
(
    `id_recette`    int(255) NOT NULL,
    `id_ingredient` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE `tag`
(
    `id_tag` int(11) NOT NULL,
    `nom`    varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `listes`
--
ALTER TABLE `listes`
    ADD PRIMARY KEY (`id_ingredient`);

--
-- Index pour la table `recette`
--
ALTER TABLE `recette`
    ADD PRIMARY KEY (`id_recette`);

--
-- Index pour la table `tags`
--
ALTER TABLE `tags`
    ADD PRIMARY KEY (`id_tag`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `listes`
--
ALTER TABLE `listes`
    MODIFY `id_ingredient` int (11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `recette`
--
ALTER TABLE `recette`
    MODIFY `id_recette` int (11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tags`
--
ALTER TABLE `tags`
    MODIFY `id_tag` int (11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
