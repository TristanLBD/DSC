-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 07 mai 2023 à 02:00
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dsc2`
--
CREATE DATABASE IF NOT EXISTS `dsc2` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `dsc2`;

-- --------------------------------------------------------

--
-- Structure de la table `affectation`
--

CREATE TABLE `affectation` (
  `Matricule` int(6) NOT NULL,
  `Date` date NOT NULL,
  `IdCaserne` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `affectation`
--

INSERT INTO `affectation` (`Matricule`, `Date`, `IdCaserne`) VALUES
(101010, '2020-03-21', 13),
(111111, '1970-01-01', 3),
(121212, '1970-01-01', 4),
(131313, '1970-01-01', 12),
(141414, '2020-03-21', 3),
(151515, '1970-01-01', 3),
(161616, '1970-01-01', 8),
(171717, '2020-04-10', 2),
(181818, '2020-03-23', 9),
(191919, '2020-03-28', 3),
(202020, '2020-03-20', 1),
(212121, '1970-01-01', 6),
(222222, '2020-04-07', 7),
(232323, '1970-01-01', 13),
(242424, '1970-01-01', 7),
(252525, '2020-04-12', 9),
(262626, '1970-01-01', 9),
(272727, '2020-03-17', 7),
(282828, '2020-03-20', 9),
(292929, '1970-01-01', 13),
(303030, '2020-03-16', 11),
(313131, '2020-04-04', 13),
(323232, '2020-03-31', 2),
(333333, '2020-03-16', 12),
(343434, '1970-01-01', 3),
(345678, '1970-01-01', 2),
(353535, '2020-03-27', 7),
(363636, '1970-01-01', 9),
(373737, '2020-03-26', 3),
(444444, '2020-04-05', 2),
(555555, '1970-01-01', 6),
(666666, '1970-01-01', 12),
(777777, '1970-01-01', 8),
(888888, '1970-01-01', 11),
(999999, '2020-04-09', 11);

-- --------------------------------------------------------

--
-- Structure de la table `carousel`
--

CREATE TABLE `carousel` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `info` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `carousel`
--

INSERT INTO `carousel` (`id`, `titre`, `info`, `img`) VALUES
(1, 'Feu à Narbonne', 'Feu de végétation près de Narbonne, d&#039;importants moyens de secours déployés', '1.jpg'),
(2, 'Feu à Carcassonne', 'De la fumée est apparue dans les remparts du célèbre château de Carcassonne (Aude) mercredi 19 avril 2023.', '2.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `caserne`
--

CREATE TABLE `caserne` (
  `idCaserne` int(11) NOT NULL,
  `NomCaserne` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `caserne`
--

INSERT INTO `caserne` (`idCaserne`, `NomCaserne`) VALUES
(1, 'Carcassonne'),
(2, 'Narbonne'),
(3, 'Limoux'),
(4, 'Castelnaudary'),
(5, 'Lézignan-Corbières\n'),
(6, 'Quillan'),
(7, 'Couiza'),
(8, 'Axat'),
(9, 'Bram'),
(10, 'Espéraza'),
(11, 'Coursan'),
(12, 'Trèbes'),
(13, 'Sigean');

-- --------------------------------------------------------

--
-- Structure de la table `employeur`
--

CREATE TABLE `employeur` (
  `idEmployeur` int(11) NOT NULL,
  `NomEmployeur` varchar(40) NOT NULL,
  `PrenomEmployeur` varchar(40) NOT NULL,
  `TelEmployeur` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `employeur`
--

INSERT INTO `employeur` (`idEmployeur`, `NomEmployeur`, `PrenomEmployeur`, `TelEmployeur`) VALUES
(1, 'VERSE', 'Alain', '0676542431'),
(2, 'NALINE', 'André', '0454245142'),
(3, 'ZOLE', 'Camille', '0676524156');

-- --------------------------------------------------------

--
-- Structure de la table `engin`
--

CREATE TABLE `engin` (
  `Numéro` tinyint(2) NOT NULL,
  `IdCaserne` int(11) NOT NULL,
  `IdTypeEngin` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `engin`
--

INSERT INTO `engin` (`Numéro`, `IdCaserne`, `IdTypeEngin`) VALUES
(1, 1, 'CCF'),
(1, 1, 'VSAV'),
(1, 1, 'VSS'),
(1, 2, 'CCF'),
(1, 2, 'VSAV'),
(1, 2, 'VSS'),
(1, 3, 'CCF'),
(1, 3, 'VSAV'),
(1, 3, 'VSS'),
(1, 4, 'CCF'),
(1, 4, 'VSAV'),
(1, 4, 'VSS'),
(1, 5, 'CCF'),
(1, 5, 'VSAV'),
(1, 5, 'VSS'),
(1, 6, 'CCF'),
(1, 6, 'VSAV'),
(1, 6, 'VSS'),
(1, 7, 'CCF'),
(1, 7, 'VSAV'),
(1, 7, 'VSS'),
(1, 8, 'CCF'),
(1, 8, 'VSAV'),
(1, 8, 'VSS'),
(1, 9, 'CCF'),
(1, 9, 'VSAV'),
(1, 9, 'VSS'),
(1, 10, 'CCF'),
(1, 10, 'VSAV'),
(1, 10, 'VSS'),
(1, 11, 'CCF'),
(1, 11, 'VSAV'),
(1, 11, 'VSS'),
(1, 12, 'CCF'),
(1, 12, 'VSAV'),
(1, 12, 'VSS');

-- --------------------------------------------------------

--
-- Structure de la table `exercer`
--

CREATE TABLE `exercer` (
  `Matricule` int(6) NOT NULL,
  `IdHabilitation` int(11) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `garage`
--

CREATE TABLE `garage` (
  `idGarage` int(11) NOT NULL,
  `nomGarage` varchar(75) NOT NULL,
  `villeGarage` int(8) NOT NULL,
  `addrGarage` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `garage`
--

INSERT INTO `garage` (`idGarage`, `nomGarage`, `villeGarage`, `addrGarage`) VALUES
(1, 'Garage Rigaud', 1, '99 Avenue Franklin Roosevelt'),
(2, 'Garage Auto Bleu', 1, '42 Rue Barbacane'),
(3, 'Garage Soler', 2, '155 Rue Roger Salengro'),
(4, 'Garage de l\'Horloge', 2, '42 Rue de l\'Horloge'),
(5, 'Garage Combe et Fils', 3, '14 Avenue de la Gare'),
(6, 'Garage Garage Auto Limouxin', 3, '16 Avenue du Pont'),
(7, 'Garage Groupe Ad Expert', 4, 'ZAC La Ferraudière'),
(8, 'Garage Midi Auto 11', 4, '1 Avenue Monseigneur de Langle'),
(9, 'Garage Bournet', 5, '2 Rue Jules Ferry'),
(10, 'Garage Auto Occasion Lézignanaise', 5, '6 Rue Pasteur'),
(11, 'Garage Les Garrigues', 6, '1 Avenue des Pyrénées'),
(12, 'Garage Romand', 6, '5 Rue Marcelin Albert'),
(13, 'Garage JLD', 7, '7 Route de Limoux'),
(14, 'Garage Sellier', 7, 'ZI de Pastabrac'),
(15, 'Garage Axat Auto', 8, '22 Rue des Pyrénées'),
(16, 'Garage Automéca 11', 8, '7 Rue des Pyrénées'),
(17, 'Garage Groupe Faurie', 9, '8 Rue des Châtaigniers'),
(18, 'Garage Carrosserie Industrielle Bramoise', 9, 'ZA Les Vernèdes'),
(19, 'Garage Delorme', 10, '18 Rue de la Gare'),
(20, 'Garage Garage de l\'Aude', 10, 'Avenue de la Gare'),
(21, 'Garage Darnis Automobiles', 11, '40 Avenue des Corbières40 Avenue des Corbières'),
(22, 'Garage Carrosserie Du Salou', 11, '8 Rue du Salou'),
(23, 'Garage Stef', 12, 'Avenue Pierre Curie'),
(24, 'Garage Métayer Automobiles', 12, 'Avenue du Languedoc'),
(25, 'Garage Auto 11 Sigean', 13, 'Avenue du Languedoc'),
(26, 'Garage Optimum Auto', 13, '28 Rte de Fraisse');

-- --------------------------------------------------------

--
-- Structure de la table `grade`
--

CREATE TABLE `grade` (
  `idGrade` int(11) NOT NULL,
  `LblGrade` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `grade`
--

INSERT INTO `grade` (`idGrade`, `LblGrade`) VALUES
(1, 'auxiliaire'),
(2, 'sapeur 2ème classe'),
(3, 'sapeur 1ère classe'),
(4, 'caporal'),
(5, 'caporal-chef'),
(6, 'sergent'),
(7, 'sergent-chef'),
(8, 'adjudant'),
(9, 'adjudant-chef'),
(10, 'lieutenant'),
(11, 'capitaine'),
(12, 'commandant'),
(13, 'lieutenant-colonel');

-- --------------------------------------------------------

--
-- Structure de la table `habilitation`
--

CREATE TABLE `habilitation` (
  `idHabilitation` int(11) NOT NULL,
  `LblHabilitation` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `habilitation`
--

INSERT INTO `habilitation` (`idHabilitation`, `LblHabilitation`) VALUES
(1, 'conducteur de véhicule de secours routier (VSR)'),
(2, 'chef d\'agrès fourgon pompe-tonne (FPT)'),
(3, 'équipier incendie'),
(4, 'équipier échelle pivotante automatique'),
(5, 'conducteur de véhicule fourgon pompe-tonne (FPT)'),
(6, 'conducteur échelle pivotante automatique'),
(12, 'Conducteur de véhicules marins.');

-- --------------------------------------------------------

--
-- Structure de la table `maintenance`
--

CREATE TABLE `maintenance` (
  `idCaserne` int(11) NOT NULL,
  `Numéro` tinyint(2) NOT NULL,
  `IdTypeEngin` varchar(4) NOT NULL,
  `idGarage` int(11) NOT NULL,
  `raison` varchar(255) DEFAULT NULL,
  `dateDebutMaintenance` date NOT NULL,
  `dateFinMaintenance` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `maintenance`
--

INSERT INTO `maintenance` (`idCaserne`, `Numéro`, `IdTypeEngin`, `idGarage`, `raison`, `dateDebutMaintenance`, `dateFinMaintenance`) VALUES
(1, 1, 'CCF', 1, 'Acquisition.', '0000-00-00', '0000-00-00'),
(1, 1, 'VSAV', 1, 'Acquisition.', '0000-00-00', '0000-00-00'),
(1, 1, 'VSS', 1, 'Acquisition.', '0000-00-00', '0000-00-00'),
(2, 1, 'CCF', 1, 'Acquisition.', '0000-00-00', '0000-00-00'),
(2, 1, 'VSAV', 1, 'Acquisition.', '0000-00-00', '0000-00-00'),
(2, 1, 'VSS', 1, 'Acquisition.', '0000-00-00', '0000-00-00'),
(3, 1, 'CCF', 1, 'Acquisition.', '0000-00-00', '0000-00-00'),
(3, 1, 'VSAV', 1, 'Acquisition.', '0000-00-00', '0000-00-00'),
(3, 1, 'VSS', 1, 'Acquisition.', '0000-00-00', '0000-00-00'),
(4, 1, 'CCF', 1, 'Acquisition.', '0000-00-00', '0000-00-00'),
(4, 1, 'VSAV', 1, 'Acquisition.', '0000-00-00', '0000-00-00'),
(4, 1, 'VSS', 1, 'Acquisition.', '0000-00-00', '0000-00-00'),
(5, 1, 'CCF', 1, 'Acquisition.', '0000-00-00', '0000-00-00'),
(5, 1, 'VSAV', 1, 'Acquisition.', '0000-00-00', '0000-00-00'),
(5, 1, 'VSS', 1, 'Acquisition.', '0000-00-00', '0000-00-00'),
(6, 1, 'CCF', 1, 'Acquisition.', '0000-00-00', '0000-00-00'),
(6, 1, 'VSAV', 1, 'Acquisition.', '0000-00-00', '0000-00-00'),
(6, 1, 'VSS', 1, 'Acquisition.', '0000-00-00', '0000-00-00'),
(7, 1, 'CCF', 1, 'Acquisition.', '0000-00-00', '0000-00-00'),
(7, 1, 'VSAV', 1, 'Acquisition.', '0000-00-00', '0000-00-00'),
(7, 1, 'VSS', 1, 'Acquisition.', '0000-00-00', '0000-00-00'),
(8, 1, 'CCF', 1, 'Acquisition.', '0000-00-00', '0000-00-00'),
(8, 1, 'VSAV', 1, 'Acquisition.', '0000-00-00', '0000-00-00'),
(8, 1, 'VSS', 1, 'Acquisition.', '0000-00-00', '0000-00-00'),
(9, 1, 'CCF', 1, 'Acquisition.', '0000-00-00', '0000-00-00'),
(9, 1, 'VSAV', 1, 'Acquisition.', '0000-00-00', '0000-00-00'),
(9, 1, 'VSS', 1, 'Acquisition.', '0000-00-00', '0000-00-00'),
(10, 1, 'CCF', 1, 'Acquisition.', '0000-00-00', '0000-00-00'),
(10, 1, 'VSAV', 1, 'Acquisition.', '0000-00-00', '0000-00-00'),
(10, 1, 'VSS', 1, 'Acquisition.', '0000-00-00', '0000-00-00'),
(11, 1, 'CCF', 1, 'Acquisition.', '0000-00-00', '0000-00-00'),
(11, 1, 'VSAV', 1, 'Acquisition.', '0000-00-00', '0000-00-00'),
(11, 1, 'VSS', 1, 'Acquisition.', '0000-00-00', '0000-00-00'),
(12, 1, 'CCF', 1, 'Acquisition.', '0000-00-00', '0000-00-00'),
(12, 1, 'VSAV', 1, 'Acquisition.', '0000-00-00', '0000-00-00'),
(12, 1, 'VSS', 1, 'Acquisition.', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Structure de la table `naturesinistre`
--

CREATE TABLE `naturesinistre` (
  `idNatureSInistre` int(11) NOT NULL,
  `LblNatureSinistre` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Table des sinistres';

--
-- Déchargement des données de la table `naturesinistre`
--

INSERT INTO `naturesinistre` (`idNatureSInistre`, `LblNatureSinistre`) VALUES
(1, 'feu dans un appartement'),
(2, 'feu de brousailles'),
(3, 'ascenseur bloqué');

-- --------------------------------------------------------

--
-- Structure de la table `pompier`
--

CREATE TABLE `pompier` (
  `Matricule` int(6) NOT NULL,
  `NomPompier` varchar(45) NOT NULL,
  `PrenomPompier` varchar(45) NOT NULL,
  `DateNaissPompier` date NOT NULL,
  `TelPompier` varchar(15) DEFAULT NULL,
  `SexePompier` enum('féminin','masculin') NOT NULL,
  `IdGrade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `pompier`
--

INSERT INTO `pompier` (`Matricule`, `NomPompier`, `PrenomPompier`, `DateNaissPompier`, `TelPompier`, `SexePompier`, `IdGrade`) VALUES
(101010, 'Lévesque', 'Amélie', '2005-06-17', '0634567890', 'féminin', 3),
(111111, 'Leblond', 'Tristan', '2003-01-15', '0674985719', 'masculin', 13),
(121212, 'Roy', 'Vincent', '1996-04-23', '0678901234', 'masculin', 12),
(131313, 'Lapierre', 'Stéphanie', '2006-09-08', '0689012345', 'féminin', 1),
(141414, 'Côté', 'Gabriel', '1994-12-11', '0645678901', 'masculin', 10),
(151515, 'Bouchard', 'Sophie', '2003-07-05', '0607080910', 'féminin', 8),
(161616, 'Gagnon', 'Mélanie', '1999-11-22', '0678912345', 'féminin', 7),
(171717, 'Tremblay', 'Simon', '1992-03-12', '0643219876', 'masculin', 5),
(181818, 'Bélanger', 'Julie', '2004-02-19', '0654321987', 'féminin', 11),
(191919, 'Morin', 'Alexandre', '1997-09-30', '0612345678', 'masculin', 6),
(202020, 'Poirier', 'Émilie', '2002-08-08', '0623456789', 'féminin', 9),
(212121, 'Beaulieu', 'Samuel', '1995-05-25', '0676543210', 'masculin', 2),
(222222, 'Dupont', 'Marie', '2001-07-20', '0645678912', 'féminin', 5),
(232323, 'Boucher', 'Louis', '1993-12-07', '0656789123', 'masculin', 1),
(242424, 'Girard', 'Audrey', '2005-07-16', '0645678912', 'féminin', 12),
(252525, 'Bergeron', 'François', '1998-04-23', '0689123456', 'masculin', 3),
(262626, 'Roy', 'Sophie', '2000-02-12', '0678912345', 'féminin', 8),
(272727, 'Lavoie', 'Alexandra', '1996-11-18', '0643219876', 'féminin', 10),
(282828, 'Gauthier', 'David', '1994-08-07', '0654321987', 'masculin', 2),
(292929, 'Simard', 'Isabelle', '2003-06-24', '0612345678', 'féminin', 11),
(303030, 'Fournier', 'Antoine', '1997-03-09', '0623456789', 'masculin', 6),
(313131, 'Tremblay', 'Sarah', '1999-09-30', '0678901234', 'féminin', 5),
(323232, 'Lapointe', 'Maxime', '1995-02-25', '0645678901', 'masculin', 7),
(333333, 'Gagnon', 'Jean', '1998-12-01', '0601020304', 'masculin', 9),
(343434, 'Dubois', 'Simon', '1998-08-29', '0678912345', 'masculin', 4),
(345678, 'Pelletier', 'Marie', '2001-11-12', '0612345678', 'féminin', 9),
(353535, 'Lévesque', 'Audrey', '1997-05-06', '0689123456', 'féminin', 12),
(363636, 'Boivin', 'Philippe', '2002-03-18', '0643219876', 'masculin', 3),
(373737, 'Lacroix', 'Stéphanie', '1994-12-23', '0656789123', 'féminin', 8),
(444444, 'Lavoie', 'Sophie', '2002-03-12', '0612345678', 'féminin', 2),
(555555, 'Bélanger', 'Éric', '1999-05-04', '0687654321', 'masculin', 7),
(666666, 'Tremblay', 'Julie', '2000-11-28', '0698765432', 'féminin', 4),
(777777, 'Desjardins', 'David', '1997-08-15', '0611223344', 'masculin', 11),
(888888, 'Bergeron', 'Catherine', '2004-02-29', '0677889900', 'féminin', 6),
(999999, 'Leclerc', 'Nicolas', '1995-09-03', '0654321098', 'masculin', 8);

-- --------------------------------------------------------

--
-- Structure de la table `prevoir`
--

CREATE TABLE `prevoir` (
  `idTypeEngin` varchar(4) NOT NULL,
  `IdNatSinistre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `prevoir`
--

INSERT INTO `prevoir` (`idTypeEngin`, `IdNatSinistre`) VALUES
('EPA', 1),
('FPT', 1),
('VSAV', 1),
('VSAV', 2),
('VSAV', 3);

-- --------------------------------------------------------

--
-- Structure de la table `professionnel`
--

CREATE TABLE `professionnel` (
  `MatPro` int(6) NOT NULL,
  `DateEmbauche` date NOT NULL,
  `Indice` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `professionnel`
--

INSERT INTO `professionnel` (`MatPro`, `DateEmbauche`, `Indice`) VALUES
(101010, '2023-04-24', 953),
(111111, '2023-04-24', 579),
(131313, '2023-04-24', 867),
(151515, '2023-04-24', 597),
(161616, '2023-04-24', 897),
(191919, '2023-04-24', 679),
(202020, '2023-04-24', 749),
(222222, '2023-04-24', 741),
(232323, '2023-04-24', 560),
(252525, '2023-04-24', 565),
(282828, '2023-04-24', 972),
(292929, '2023-04-24', 821),
(303030, '2023-04-24', 669),
(313131, '2023-04-24', 723),
(323232, '2023-04-24', 971),
(333333, '2023-04-24', 502),
(343434, '2023-04-24', 726),
(353535, '2023-04-24', 715),
(444444, '2023-04-24', 895),
(777777, '2023-04-24', 590),
(888888, '2023-04-24', 723);

-- --------------------------------------------------------

--
-- Structure de la table `reclamer`
--

CREATE TABLE `reclamer` (
  `idTypeEngin` varchar(4) NOT NULL,
  `IdHabilitation` int(11) NOT NULL,
  `Nbr` tinyint(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `reclamer`
--

INSERT INTO `reclamer` (`idTypeEngin`, `IdHabilitation`, `Nbr`) VALUES
('FPT', 2, 1),
('FPT', 3, 2),
('FPT', 5, 1);

-- --------------------------------------------------------

--
-- Structure de la table `typeengin`
--

CREATE TABLE `typeengin` (
  `idTypeEngin` varchar(4) NOT NULL,
  `LblEngin` varchar(45) DEFAULT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `typeengin`
--

INSERT INTO `typeengin` (`idTypeEngin`, `LblEngin`, `img`) VALUES
('BLS', 'Bateau Léger De Sauvetage', 'bls.png'),
('BRS', 'Bateau de Reconnaissance et de Sauvetage', 'brs.png'),
('CCF', 'Camion-Citerne feux de Forêts', 'ccf.png'),
('EPA', 'Échelle Pivotante Automatique', 'epa.jpeg'),
('FPT', 'Fourgon Pompe-Tonne', 'fpt.jpeg'),
('MPR', 'Moto Pompe Remorquable', 'mpr.png'),
('RMV', 'Remorque Moto Ventilateur', 'rmv.png'),
('VPC', 'Véhicule Poste de Commandement', 'vpc.png'),
('VSAV', 'Véhicule de Secours aux Victimes', 'vsav.jpeg'),
('VSR', 'Véhicule Secours Routier', 'vsr.jpg'),
('VSS', 'Véhicule de Soutien Sanitaire', 'vss.png');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pwd` longtext NOT NULL,
  `role` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `email`, `pwd`, `role`) VALUES
(0, 'administrateur@gmail.com', '$2y$12$RBJrtbrxzndChYmj.pO/dektkrpBXplx5rAXGEupmWIRvn7sIh0qy', 'Admin');

-- --------------------------------------------------------

--
-- Structure de la table `villes_france`
--

CREATE TABLE `villes_france` (
  `ville_id` int(8) NOT NULL,
  `nom` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `villes_france`
--

INSERT INTO `villes_france` (`ville_id`, `nom`) VALUES
(1, 'Carcassonne'),
(2, 'Narbonne'),
(3, 'Limoux'),
(4, 'Castelnaudary'),
(5, 'Lézignan-Corbières\n'),
(6, 'Quillan'),
(7, 'Couiza'),
(8, 'Axat'),
(9, 'Bram'),
(10, 'Espéraza'),
(11, 'Coursan'),
(12, 'Trèbes'),
(13, 'Sigean');

-- --------------------------------------------------------

--
-- Structure de la table `volontaire`
--

CREATE TABLE `volontaire` (
  `MatVolontaire` int(6) NOT NULL,
  `Bip` varchar(3) DEFAULT NULL,
  `IdEmployeur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `volontaire`
--

INSERT INTO `volontaire` (`MatVolontaire`, `Bip`, `IdEmployeur`) VALUES
(121212, '811', 1),
(141414, '789', 2),
(171717, '861', 2),
(181818, '305', 1),
(212121, '303', 3),
(242424, '334', 3),
(262626, '831', 1),
(272727, '517', 1),
(345678, '744', 3),
(363636, '827', 3),
(373737, '953', 1),
(555555, '738', 2),
(666666, '182', 1),
(999999, '474', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `affectation`
--
ALTER TABLE `affectation`
  ADD PRIMARY KEY (`Matricule`,`Date`,`IdCaserne`),
  ADD KEY `FK_AFFECTATION_CASERNE` (`IdCaserne`);

--
-- Index pour la table `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `caserne`
--
ALTER TABLE `caserne`
  ADD PRIMARY KEY (`idCaserne`);

--
-- Index pour la table `employeur`
--
ALTER TABLE `employeur`
  ADD PRIMARY KEY (`idEmployeur`);

--
-- Index pour la table `engin`
--
ALTER TABLE `engin`
  ADD PRIMARY KEY (`Numéro`,`IdCaserne`,`IdTypeEngin`),
  ADD KEY `FK_ENGIN_CASERNE` (`IdCaserne`),
  ADD KEY `FK_RECLAMER_TYPEENGIN` (`IdTypeEngin`);

--
-- Index pour la table `exercer`
--
ALTER TABLE `exercer`
  ADD PRIMARY KEY (`Matricule`,`IdHabilitation`),
  ADD KEY `FK_EXERCER_HABILITATION` (`IdHabilitation`);

--
-- Index pour la table `garage`
--
ALTER TABLE `garage`
  ADD PRIMARY KEY (`idGarage`),
  ADD KEY `villeGarage` (`villeGarage`);

--
-- Index pour la table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`idGrade`);

--
-- Index pour la table `habilitation`
--
ALTER TABLE `habilitation`
  ADD PRIMARY KEY (`idHabilitation`);

--
-- Index pour la table `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`idCaserne`,`Numéro`,`IdTypeEngin`,`idGarage`,`dateDebutMaintenance`),
  ADD KEY `IdTypeEngin` (`IdTypeEngin`),
  ADD KEY `idGarage` (`idGarage`),
  ADD KEY `Numéro` (`Numéro`);

--
-- Index pour la table `naturesinistre`
--
ALTER TABLE `naturesinistre`
  ADD PRIMARY KEY (`idNatureSInistre`);

--
-- Index pour la table `pompier`
--
ALTER TABLE `pompier`
  ADD PRIMARY KEY (`Matricule`),
  ADD KEY `FK_POMPIER_GRADE` (`IdGrade`);

--
-- Index pour la table `prevoir`
--
ALTER TABLE `prevoir`
  ADD PRIMARY KEY (`idTypeEngin`,`IdNatSinistre`),
  ADD KEY `FK_PREVOIR_SINISTRE` (`IdNatSinistre`);

--
-- Index pour la table `professionnel`
--
ALTER TABLE `professionnel`
  ADD PRIMARY KEY (`MatPro`);

--
-- Index pour la table `reclamer`
--
ALTER TABLE `reclamer`
  ADD PRIMARY KEY (`idTypeEngin`,`IdHabilitation`),
  ADD KEY `FK_RECLAMER_HABILITATION` (`IdHabilitation`);

--
-- Index pour la table `typeengin`
--
ALTER TABLE `typeengin`
  ADD PRIMARY KEY (`idTypeEngin`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `villes_france`
--
ALTER TABLE `villes_france`
  ADD PRIMARY KEY (`ville_id`);

--
-- Index pour la table `volontaire`
--
ALTER TABLE `volontaire`
  ADD PRIMARY KEY (`MatVolontaire`),
  ADD KEY `FK_PRO_POMPIER` (`MatVolontaire`),
  ADD KEY `FK_VOLONTAIRE_EMPLOYEUR` (`IdEmployeur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `caserne`
--
ALTER TABLE `caserne`
  MODIFY `idCaserne` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `employeur`
--
ALTER TABLE `employeur`
  MODIFY `idEmployeur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `garage`
--
ALTER TABLE `garage`
  MODIFY `idGarage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `grade`
--
ALTER TABLE `grade`
  MODIFY `idGrade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `habilitation`
--
ALTER TABLE `habilitation`
  MODIFY `idHabilitation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `naturesinistre`
--
ALTER TABLE `naturesinistre`
  MODIFY `idNatureSInistre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `villes_france`
--
ALTER TABLE `villes_france`
  MODIFY `ville_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `affectation`
--
ALTER TABLE `affectation`
  ADD CONSTRAINT `FK_AFFECTATION_CASERNE` FOREIGN KEY (`IdCaserne`) REFERENCES `caserne` (`idCaserne`),
  ADD CONSTRAINT `FK_AFFECTATION_POMPIER` FOREIGN KEY (`Matricule`) REFERENCES `pompier` (`Matricule`);

--
-- Contraintes pour la table `engin`
--
ALTER TABLE `engin`
  ADD CONSTRAINT `FK_ENGIN_CASERNE` FOREIGN KEY (`IdCaserne`) REFERENCES `caserne` (`idCaserne`),
  ADD CONSTRAINT `FK_RECLAMER_TYPEENGIN` FOREIGN KEY (`IdTypeEngin`) REFERENCES `typeengin` (`idTypeEngin`);

--
-- Contraintes pour la table `exercer`
--
ALTER TABLE `exercer`
  ADD CONSTRAINT `FK_EXERCER_HABILITATION` FOREIGN KEY (`IdHabilitation`) REFERENCES `habilitation` (`idHabilitation`),
  ADD CONSTRAINT `exercer_ibfk_1` FOREIGN KEY (`Matricule`) REFERENCES `pompier` (`Matricule`);

--
-- Contraintes pour la table `garage`
--
ALTER TABLE `garage`
  ADD CONSTRAINT `garage_ibfk_1` FOREIGN KEY (`villeGarage`) REFERENCES `villes_france` (`ville_id`);

--
-- Contraintes pour la table `maintenance`
--
ALTER TABLE `maintenance`
  ADD CONSTRAINT `FK_MAINTENANCE_GARAGE` FOREIGN KEY (`idGarage`) REFERENCES `garage` (`idGarage`) ON DELETE CASCADE,
  ADD CONSTRAINT `maintenance_ibfk_1` FOREIGN KEY (`idCaserne`) REFERENCES `engin` (`IdCaserne`) ON DELETE CASCADE,
  ADD CONSTRAINT `maintenance_ibfk_2` FOREIGN KEY (`IdTypeEngin`) REFERENCES `engin` (`IdTypeEngin`) ON DELETE CASCADE,
  ADD CONSTRAINT `maintenance_ibfk_3` FOREIGN KEY (`IdTypeEngin`) REFERENCES `engin` (`IdTypeEngin`) ON DELETE CASCADE,
  ADD CONSTRAINT `maintenance_ibfk_4` FOREIGN KEY (`idGarage`) REFERENCES `garage` (`idGarage`) ON DELETE CASCADE,
  ADD CONSTRAINT `maintenance_ibfk_5` FOREIGN KEY (`Numéro`) REFERENCES `engin` (`Numéro`) ON DELETE CASCADE;

--
-- Contraintes pour la table `pompier`
--
ALTER TABLE `pompier`
  ADD CONSTRAINT `FK_POMPIER_GRADE` FOREIGN KEY (`IdGrade`) REFERENCES `grade` (`idGrade`);

--
-- Contraintes pour la table `prevoir`
--
ALTER TABLE `prevoir`
  ADD CONSTRAINT `FK_PREVOIR_ENGIN` FOREIGN KEY (`idTypeEngin`) REFERENCES `typeengin` (`idTypeEngin`),
  ADD CONSTRAINT `FK_PREVOIR_SINISTRE` FOREIGN KEY (`IdNatSinistre`) REFERENCES `naturesinistre` (`idNatureSInistre`);

--
-- Contraintes pour la table `professionnel`
--
ALTER TABLE `professionnel`
  ADD CONSTRAINT `FK_VOLONTAIRE_POMPIER` FOREIGN KEY (`MatPro`) REFERENCES `pompier` (`Matricule`);

--
-- Contraintes pour la table `reclamer`
--
ALTER TABLE `reclamer`
  ADD CONSTRAINT `FK_RECLAMER_ENGIN` FOREIGN KEY (`idTypeEngin`) REFERENCES `typeengin` (`idTypeEngin`),
  ADD CONSTRAINT `FK_RECLAMER_HABILITATION` FOREIGN KEY (`IdHabilitation`) REFERENCES `habilitation` (`idHabilitation`);

--
-- Contraintes pour la table `volontaire`
--
ALTER TABLE `volontaire`
  ADD CONSTRAINT `volontaire_ibfk_1` FOREIGN KEY (`MatVolontaire`) REFERENCES `pompier` (`Matricule`),
  ADD CONSTRAINT `volontaire_ibfk_2` FOREIGN KEY (`IdEmployeur`) REFERENCES `employeur` (`idEmployeur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
