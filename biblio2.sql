-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 13 jan. 2020 à 20:55
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `biblio2`
--

-- --------------------------------------------------------

--
-- Structure de la table `connexion`
--

DROP TABLE IF EXISTS `connexion`;
CREATE TABLE IF NOT EXISTS `connexion` (
  `email` varchar(200) NOT NULL,
  `mdp` varchar(999) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `connexion`
--

INSERT INTO `connexion` (`email`, `mdp`) VALUES
('root.lib@pro.fr', '$2y$10$1HxzPGtrV2nYtwkQo.31..yvA7mOdxwyReWpgkKJKXUOHk98RZWOa'),
('ae@ae.fr', '$2y$10$LQTejzx7g41T10csxmvmQ.BhOaEezVu155JPjak7uN6Y4msGY7.TK');

-- --------------------------------------------------------

--
-- Structure de la table `emprunt`
--

DROP TABLE IF EXISTS `emprunt`;
CREATE TABLE IF NOT EXISTS `emprunt` (
  `numlivre` int(11) NOT NULL,
  `numpersonne` int(11) NOT NULL,
  `sortie` date NOT NULL,
  `retour` date DEFAULT NULL,
  PRIMARY KEY (`numlivre`,`numpersonne`,`sortie`),
  KEY `numlivre` (`numlivre`),
  KEY `numlivre_2` (`numlivre`),
  KEY `numpersonne` (`numpersonne`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `emprunt`
--

INSERT INTO `emprunt` (`numlivre`, `numpersonne`, `sortie`, `retour`) VALUES
(1, 8, '1999-04-02', NULL),
(2, 3, '2020-01-25', '2020-02-02'),
(3, 1, '1999-03-03', '1999-03-30'),
(3, 3, '1999-03-30', '1999-04-15');

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

DROP TABLE IF EXISTS `livre`;
CREATE TABLE IF NOT EXISTS `livre` (
  `numlivre` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) NOT NULL,
  `auteur` varchar(100) NOT NULL,
  `genre` enum('Roman','Poésie','Nouvelle','BD') NOT NULL DEFAULT 'Roman',
  `prix` int(11) DEFAULT NULL,
  PRIMARY KEY (`numlivre`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `livre`
--

INSERT INTO `livre` (`numlivre`, `titre`, `auteur`, `genre`, `prix`) VALUES
(1, 'Les chouans', 'Balzac', 'Roman', 80),
(2, 'Germinal', 'Zola', 'Roman', 75),
(3, 'L’assommoir\r\n', 'Zola', 'Roman', 95),
(4, 'La bête humaine', 'Zola', 'Roman', 70),
(5, 'Les misérables\r\n', 'Les misérables\r\n', 'Roman', 105),
(6, 'La peste\r\n', 'Camus\r\n', 'Roman', 112),
(7, 'Les lettres persanes', 'Maupassant', 'Roman', 140),
(8, 'Bel ami\r\n', 'Maupassant', 'Roman', 76),
(9, 'Les lettres de mon moulin', 'Daudet', 'Roman', 100),
(10, 'César', 'Pagnol', 'Roman', 100),
(11, 'Marius\r\n', 'Pagnol\r\n', 'Roman', 65),
(12, 'Fanny', 'Pagnol', 'Roman', 72),
(13, 'Les fleurs du mal', 'Baudelaire', 'Roman', 130),
(14, 'Paroles\r\n', 'Prévert', 'Roman', 120),
(15, 'Les raisins de la colère ', 'Steinbeck', 'Roman', 135);

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

DROP TABLE IF EXISTS `personne`;
CREATE TABLE IF NOT EXISTS `personne` (
  `numpersonne` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `ville` varchar(200) NOT NULL,
  PRIMARY KEY (`numpersonne`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `personne`
--

INSERT INTO `personne` (`numpersonne`, `nom`, `prenom`, `ville`) VALUES
(1, 'Durand', 'Jean-Pierre', 'Toulouse'),
(2, 'Brieusel', 'Chantai', 'Colomiers'),
(3, 'Riols', 'Jacques', 'Toulouse'),
(4, 'Denavylle', 'Hélêne', 'Toulouse'),
(5, 'Planchon', 'André', 'Muret'),
(6, 'Pêne', 'Gérôme', 'Albi'),
(7, 'Bert', 'Jean-Pierre', 'St Orens'),
(8, 'Gonzales', 'Alain', 'Toulouse'),
(9, 'Martin', 'François', 'Balma'),
(10, 'Jourda', 'Véronique', 'Colomiers');

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `statnbemprunt`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `statnbemprunt`;
CREATE TABLE IF NOT EXISTS `statnbemprunt` (
`numlivre` int(11)
,`numpersonne` int(11)
,`sortie` date
,`retour` date
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `table_nb_emprunt`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `table_nb_emprunt`;
CREATE TABLE IF NOT EXISTS `table_nb_emprunt` (
`Nb_emprunt` bigint(21)
,`numlivre` int(11)
);

-- --------------------------------------------------------

--
-- Structure de la vue `statnbemprunt`
--
DROP TABLE IF EXISTS `statnbemprunt`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `statnbemprunt`  AS  select `emprunt`.`numlivre` AS `numlivre`,`emprunt`.`numpersonne` AS `numpersonne`,`emprunt`.`sortie` AS `sortie`,`emprunt`.`retour` AS `retour` from `emprunt` ;

-- --------------------------------------------------------

--
-- Structure de la vue `table_nb_emprunt`
--
DROP TABLE IF EXISTS `table_nb_emprunt`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `table_nb_emprunt`  AS  select count(0) AS `Nb_emprunt`,`emprunt`.`numlivre` AS `numlivre` from `emprunt` group by `emprunt`.`numlivre` ;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `emprunt`
--
ALTER TABLE `emprunt`
  ADD CONSTRAINT `emprunt_ibfk_1` FOREIGN KEY (`numlivre`) REFERENCES `livre` (`numlivre`),
  ADD CONSTRAINT `emprunt_ibfk_2` FOREIGN KEY (`numpersonne`) REFERENCES `personne` (`numpersonne`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
