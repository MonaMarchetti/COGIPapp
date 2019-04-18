-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  jeu. 18 avr. 2019 à 13:48
-- Version du serveur :  10.3.14-MariaDB
-- Version de PHP :  7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `id9271623_cogip`
--

-- --------------------------------------------------------

--
-- Structure de la table `factures`
--

CREATE TABLE `factures` (
  `idfactures` int(11) NOT NULL,
  `datefacture` datetime DEFAULT NULL,
  `dateprestation` datetime DEFAULT NULL,
  `numfacture` varchar(45) DEFAULT NULL,
  `idsociete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `factures`
--

INSERT INTO `factures` (`idfactures`, `datefacture`, `dateprestation`, `numfacture`, `idsociete`) VALUES
(13, '2019-03-27 00:00:00', '2019-04-03 00:00:00', '545434', 7),
(16, '2019-04-10 00:00:00', '2019-04-19 00:00:00', '56456', 17),
(27, '2019-04-11 00:00:00', '2019-04-16 00:00:00', '8079068049', 12),
(30, '2019-04-11 00:00:00', '2019-04-09 00:00:00', '565687578957895', 23);

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

CREATE TABLE `personne` (
  `idpersonne` int(11) NOT NULL,
  `nom` varchar(45) DEFAULT NULL,
  `prenom` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `tel` int(25) NOT NULL,
  `idsociete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `personne`
--

INSERT INTO `personne` (`idpersonne`, `nom`, `prenom`, `email`, `tel`, `idsociete`) VALUES
(65, 'Mikey', 'Mouse', 'mikey@mouse.com', 1, 12),
(66, 'D', 'Caterina', 'cat.d@gmail.com', 767865897, 23);

-- --------------------------------------------------------

--
-- Structure de la table `societe`
--

CREATE TABLE `societe` (
  `idsociete` int(11) NOT NULL,
  `nomsociete` varchar(45) DEFAULT NULL,
  `pays` varchar(45) DEFAULT NULL,
  `tva` int(11) DEFAULT NULL,
  `type` enum('client','fournisseur') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `societe`
--

INSERT INTO `societe` (`idsociete`, `nomsociete`, `pays`, `tva`, `type`) VALUES
(3, 'BEATLES', 'UK', 9999999, 'fournisseur'),
(6, 'YEEEEah', 'Wonderland', 1, 'fournisseur'),
(7, 'YEEEEah', 'Wonderland', 1, 'fournisseur'),
(12, 'Hello', 'World', 851, 'fournisseur'),
(17, 'hep', 'si', 345, 'client'),
(21, 'dsgsd', 'fsdd', 654564, 'fournisseur'),
(23, 'Tardis', 'UK', 67896978, 'fournisseur');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `idutilisateur` int(2) NOT NULL,
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(25) NOT NULL,
  `type` enum('Godmode','Modo') NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idutilisateur`, `nom`, `prenom`, `type`, `password`) VALUES
(1, 'Ranu', 'Jean-Christian', 'Godmode', 'Ranu'),
(2, 'Perrache', 'Muriel', 'Modo', 'Perrache');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `factures`
--
ALTER TABLE `factures`
  ADD PRIMARY KEY (`idfactures`);

--
-- Index pour la table `personne`
--
ALTER TABLE `personne`
  ADD PRIMARY KEY (`idpersonne`);

--
-- Index pour la table `societe`
--
ALTER TABLE `societe`
  ADD PRIMARY KEY (`idsociete`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`idutilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `factures`
--
ALTER TABLE `factures`
  MODIFY `idfactures` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `personne`
--
ALTER TABLE `personne`
  MODIFY `idpersonne` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT pour la table `societe`
--
ALTER TABLE `societe`
  MODIFY `idsociete` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `idutilisateur` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
