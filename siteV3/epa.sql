-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 07 avr. 2020 à 20:27
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
-- Base de données :  `epa`
--

-- --------------------------------------------------------

--
-- Structure de la table `adherent`
--

DROP TABLE IF EXISTS `adherent`;
CREATE TABLE IF NOT EXISTS `adherent` (
  `id_user` int(250) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `date_naissance` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `numtel` int(10) DEFAULT NULL,
  `pays_origine` varchar(255) NOT NULL,
  `sexe` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `dateCotisation` date DEFAULT NULL,
  `dateInscription` datetime NOT NULL,
  `choix_paiement` varchar(255) NOT NULL,
  `valide` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `adherent`
--

INSERT INTO `adherent` (`id_user`, `nom`, `prenom`, `date_naissance`, `email`, `numtel`, `pays_origine`, `sexe`, `password`, `dateCotisation`, `dateInscription`, `choix_paiement`, `valide`) VALUES
(16, 'hamrioui', 'jjn', '1110-01-01', 'amrioui@yahoo.fr', 662230786, 'ALJ', 'F', '971179a4d5937b486d476ae5de648624', NULL, '2020-04-06 00:00:00', 'cheque', 1),
(15, 'ooo', 'odile', '1234-01-01', 'odile_hamrioui@yahoo.fr', 662230786, 'AZR', 'F', '971179a4d5937b486d476ae5de648624', NULL, '2020-04-06 00:00:00', 'cheque', 1);

-- --------------------------------------------------------

--
-- Structure de la table `adherent_valide`
--

DROP TABLE IF EXISTS `adherent_valide`;
CREATE TABLE IF NOT EXISTS `adherent_valide` (
  `id_user` int(250) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `date_naissance` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `numtel` int(10) DEFAULT NULL,
  `pays_origine` varchar(255) NOT NULL,
  `sexe` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dateCotisation` date DEFAULT NULL,
  `dateInscription` datetime NOT NULL,
  `choix_paiement` varchar(255) NOT NULL,
  `valide` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `conseiladmin`
--

DROP TABLE IF EXISTS `conseiladmin`;
CREATE TABLE IF NOT EXISTS `conseiladmin` (
  `id_ca` int(11) NOT NULL AUTO_INCREMENT,
  `nomCA` varchar(255) NOT NULL,
  `prenomCA` varchar(255) NOT NULL,
  `date_naissanceCA` date NOT NULL,
  `emailCA` varchar(255) NOT NULL,
  `passworCA` varchar(255) NOT NULL,
  `numTEL` int(11) DEFAULT NULL,
  `typeCA` varchar(255) NOT NULL,
  PRIMARY KEY (`id_ca`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `docpdf`
--

DROP TABLE IF EXISTS `docpdf`;
CREATE TABLE IF NOT EXISTS `docpdf` (
  `idFile` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `file_url` varchar(255) NOT NULL,
  `dateInsert` datetime DEFAULT NULL,
  PRIMARY KEY (`idFile`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `doc_paiement`
--

DROP TABLE IF EXISTS `doc_paiement`;
CREATE TABLE IF NOT EXISTS `doc_paiement` (
  `id_paiement` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `file_url` varchar(255) NOT NULL,
  PRIMARY KEY (`id_paiement`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `doc_reunion`
--

DROP TABLE IF EXISTS `doc_reunion`;
CREATE TABLE IF NOT EXISTS `doc_reunion` (
  `id_doc` int(11) NOT NULL AUTO_INCREMENT,
  `id_reunion` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `file_url` varchar(255) NOT NULL,
  PRIMARY KEY (`id_doc`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `membrebureau`
--

DROP TABLE IF EXISTS `membrebureau`;
CREATE TABLE IF NOT EXISTS `membrebureau` (
  `id_membre` int(11) NOT NULL AUTO_INCREMENT,
  `nomM` varchar(255) NOT NULL,
  `prenomM` varchar(255) NOT NULL,
  `date_naissance` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` int(10) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_membre`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `membrebureau`
--

INSERT INTO `membrebureau` (`id_membre`, `nomM`, `prenomM`, `date_naissance`, `email`, `password`, `phone`, `adresse`) VALUES
(1, 'Brunel Lobrichon', 'Geneviève', '1900-04-30', 'presidente@epa.fr', 'epa', 1234567891, NULL),
(2, 'Chan', 'Louisette', '1900-04-30', 'secretaire@epa.fr', 'chanlouisette', 1111111111, NULL),
(3, 'Goungounga', 'Hélène', '1900-04-30', 'compta@epa.fr', 'goungoungahelene', 222222222, NULL),
(4, 'Atangana', 'Symphorien', '1900-04-30', 'accueil_etudiant@epa.fr', 'atanganasymphorien', 333333333, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `reunion`
--

DROP TABLE IF EXISTS `reunion`;
CREATE TABLE IF NOT EXISTS `reunion` (
  `id_reunion` int(11) NOT NULL AUTO_INCREMENT,
  `lieu` varchar(255) NOT NULL,
  `dat` date NOT NULL,
  `objet` varchar(255) NOT NULL,
  PRIMARY KEY (`id_reunion`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reunion`
--

INSERT INTO `reunion` (`id_reunion`, `lieu`, `dat`, `objet`) VALUES
(2, 'PARIS', '2021-02-02', 'nayaa');

-- --------------------------------------------------------

--
-- Structure de la table `themes`
--

DROP TABLE IF EXISTS `themes`;
CREATE TABLE IF NOT EXISTS `themes` (
  `id_theme` int(11) NOT NULL AUTO_INCREMENT,
  `nomTheme` varchar(255) NOT NULL,
  PRIMARY KEY (`id_theme`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `themes`
--

INSERT INTO `themes` (`id_theme`, `nomTheme`) VALUES
(1, 'Accueil des étudiants en France'),
(2, 'Santé et Mutuelle'),
(3, 'Education'),
(4, 'Action Sociale et solidaire');

-- --------------------------------------------------------

--
-- Structure de la table `theme_abonne`
--

DROP TABLE IF EXISTS `theme_abonne`;
CREATE TABLE IF NOT EXISTS `theme_abonne` (
  `id_ab` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `nomTheme` varchar(255) NOT NULL,
  PRIMARY KEY (`id_ab`)
) ENGINE=MyISAM AUTO_INCREMENT=118 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `theme_abonne`
--

INSERT INTO `theme_abonne` (`id_ab`, `id_user`, `nomTheme`) VALUES
(117, 17, 'Education'),
(116, 17, 'Accueil des étudiants en France');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
