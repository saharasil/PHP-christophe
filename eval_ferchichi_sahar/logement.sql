-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 19 mars 2020 à 18:28
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `immobilier`
--

-- --------------------------------------------------------

--
-- Structure de la table `logement`
--

CREATE TABLE `logement` (
  `id_logement` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `ville` varchar(30) NOT NULL,
  `cp` varchar(10) NOT NULL,
  `surface` float NOT NULL,
  `prix` float NOT NULL,
  `photo` varchar(250) NOT NULL,
  `type` enum('location','vente') NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `logement`
--

INSERT INTO `logement` (`id_logement`, `titre`, `adresse`, `ville`, `cp`, `surface`, `prix`, `photo`, `type`, `description`) VALUES
(1, 'Maison', '7 rue de soleil', 'Paris', '75015', 1245, 250000, 'images/images.jpg', 'vente', 'Une vaste maison avec un beau jardin'),
(2, 'Maison', '34 rue de France', 'Paris', '75015', 167, 17000, 'images/images1.jpg', 'vente', 'Maison en vente dans la compagne.'),
(3, 'Maison', '54 avenue jean jaures ', 'Paris', '91220', 344, 145000, 'images/images3.jpg', 'vente', 'jolie maison '),
(4, 'Maison', '54 avenue jean paul', 'Paris', '91221', 500, 175000, 'images/34065762_71.jpg', 'vente', 'magnifique maison ');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `logement`
--
ALTER TABLE `logement`
  ADD PRIMARY KEY (`id_logement`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `logement`
--
ALTER TABLE `logement`
  MODIFY `id_logement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
