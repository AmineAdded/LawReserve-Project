-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 03 déc. 2024 à 01:02
-- Version du serveur : 8.0.36
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `vue-api`
--

-- --------------------------------------------------------

--
-- Structure de la table `appointment`
--

DROP TABLE IF EXISTS `appointment`;
CREATE TABLE IF NOT EXISTS `appointment` (
  `idAppointment` int NOT NULL AUTO_INCREMENT,
  `law` varchar(30) NOT NULL,
  `client` varchar(30) NOT NULL,
  `service` varchar(30) NOT NULL,
  `price` double NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`idAppointment`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `appointment`
--

INSERT INTO `appointment` (`idAppointment`, `law`, `client`, `service`, `price`, `date`) VALUES
(1, 'Souha Karoui', 'Amine Added', 'Family Law Services', 100, '2024-12-05'),
(16, 'khalil Jaafer', 'Raed Saidi', 'Employment Law Advaisory', 1000, '2024-12-16'),
(15, 'Rayen Benzid', 'Aya Lamouchi', 'Real Estate Legal Services', 500, '2024-12-04'),
(7, 'Souha Karoui', 'Aziz Maddeh', 'Criminal Defense Services', 200, '2024-12-11'),
(14, 'Rayen Benzid', 'Aya Lamouchi', 'Immigration Legal Services', 500, '2024-12-11');

-- --------------------------------------------------------

--
-- Structure de la table `categorys`
--

DROP TABLE IF EXISTS `categorys`;
CREATE TABLE IF NOT EXISTS `categorys` (
  `id` int NOT NULL AUTO_INCREMENT,
  `price` double NOT NULL,
  `image` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `title` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `categorys`
--

INSERT INTO `categorys` (`id`, `price`, `image`, `description`, `title`) VALUES
(1, 100, 'assets/empl.jpg', 'Professional advice and services for family law matters.', 'Family Law Services'),
(2, 200, 'assets/criminal.jpg', 'Expert criminal defense representation and consultation.', 'Criminal Defense Services'),
(3, 150, 'assets/Res.jpg', 'Comprehensive legal services for real estate transactions.', 'Real Estate Legal Services'),
(4, 180, 'assets/imeg.jpg', 'Legal assistance for immigration and visa processes.', 'Immigration Legal Services'),
(5, 120, 'assets/empl.jpg', 'Advice and representation for employment-related issues.', 'Employment Law Advisory'),
(6, 250, 'assets/Intellectual-Property-services.jpg', 'Protect and manage intellectual property assets.', 'Intellectual Property Services'),
(7, 130, 'assets/Env.jpg', 'Guidance on environmental laws and compliance.', 'Environmental Legal Services'),
(8, 220, 'assets/RES.jpeg', 'Legal support for businesses and commercial transactions.', 'Business Law Services');

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` int NOT NULL AUTO_INCREMENT,
  `image` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `price` double NOT NULL,
  `description` varchar(200) NOT NULL,
  `category` varchar(200) NOT NULL,
  `consultantName` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`id`, `image`, `title`, `price`, `description`, `category`, `consultantName`) VALUES
(1, 'assets/family.jpg', 'Family Law Services', 100, 'Professional advice and services for family law matters.', 'Law', 'Souha Karoui'),
(2, 'criminal_defense.jpg', 'Criminal Defense Services', 200, 'Expert criminal defense representation and consultation.', 'Law', 'Souha Karoui'),
(3, 'real_estate.jpg', 'Real Estate Legal Services', 150, 'Comprehensive legal services for real estate transactions.', 'Real Estate', 'Rayen Benzid'),
(4, 'immigration.jpg', 'Immigration Legal Services', 180, 'Legal assistance for immigration and visa processes.', 'Immigration', 'khalil Jaafer\n'),
(5, 'business_law.jpg', 'Business Law Services', 220, 'Legal support for businesses and commercial transactions.', 'Business', 'Rayen Benzid');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
