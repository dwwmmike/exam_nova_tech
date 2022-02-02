-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 12, 2021 at 10:11 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nova_tech`
--

-- --------------------------------------------------------

--
-- Table structure for table `adresses`
--

CREATE TABLE `adresses` (
  `id_adresse` int(11) NOT NULL,
  `rue` varchar(250) NOT NULL,
  `ville` varchar(100) NOT NULL,
  `complement` varchar(250) NOT NULL,
  `id_client` int(11) NOT NULL,
  `code_postal` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `adresses`
--

INSERT INTO `adresses` (`id_adresse`, `rue`, `ville`, `complement`, `id_client`, `code_postal`) VALUES
(1, '5 rue de la pierre noire ', 'ville', 'batiment A', 1, '97200'),
(2, 'xrjryjryjryj', 'xrfjrtjrtjyrjrtyj', 'hxturfturftj', 3, '');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `email` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id_client`, `nom`, `prenom`, `age`, `email`) VALUES
(1, 'Dupond', 'Jean', 42, ''),
(2, 'Peter', 'McGonagan', 35, ''),
(3, 'Phillip', 'Moris', 33, '');

-- --------------------------------------------------------

--
-- Table structure for table `commandes`
--

CREATE TABLE `commandes` (
  `id_commande` int(11) NOT NULL,
  `reference` int(11) NOT NULL,
  `poids` float NOT NULL,
  `total` float NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_adresse` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `commandes`
--

INSERT INTO `commandes` (`id_commande`, `reference`, `poids`, `total`, `id_client`, `id_adresse`) VALUES
(1, 12452, 4.3, 5000, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `commandes_pc_gamer`
--

CREATE TABLE `commandes_pc_gamer` (
  `id_commande` int(11) NOT NULL,
  `id_pc_gamer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `composants`
--

CREATE TABLE `composants` (
  `id_composant` int(11) NOT NULL,
  `nom_composant` varchar(50) NOT NULL,
  `id_type_composant` int(11) DEFAULT NULL,
  `prix` float NOT NULL,
  `description` text NOT NULL,
  `image` varchar(250) DEFAULT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `composants`
--

INSERT INTO `composants` (`id_composant`, `nom_composant`, `id_type_composant`, `prix`, `description`, `image`, `quantite`) VALUES
(1, 'AMD Ryzen 5 3600', 3, 1000, '', '', 0),
(2, 'AMD Ryzen 3 1200 AF (3,1 GHz)', 3, 0, '', '', 0),
(3, 'NVIDIA 3080', 6, 2000, 'sefdhwdfh', '', 3),
(4, 'un boitier', 2, 229.96, 'xfgnfgn', '', 41),
(5, 'une alim', 9, 45, 'wdfbdwfb', '', 42),
(6, 'une cm', 4, 29.9, 'qrthterh', '', 35),
(7, 'un hdd', 8, 4555, 'dfgh,', '', 42),
(8, 'ram', 5, 20.99, 'srgfnrfgn', '', 28),
(10, 'un ventirad', 10, 45, 'xfgn', '', 12),
(11, 'windows', 11, 45, 'cfgh,ghf', '', 12),
(12, 'carte graph', 3, 100, 'balbablabla', 'carte.png', 32),
(13, 'qerhgerhg', 2, 35, 'erhgerhg', '', 25),
(20, 'new', 6, 1200, 'dfgnbwdfghn', '', 667),
(21, 'takeoffdd', 5, 1200, 'erhsqerth', '22014031042-Dawn-of-the-Planet-of-the-Apes-Backgrounds-WideWallpapersHD.jpg', 8);

-- --------------------------------------------------------

--
-- Table structure for table `pc_gamer`
--

CREATE TABLE `pc_gamer` (
  `id_pc_gamer` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `description` varchar(550) NOT NULL,
  `date` date NOT NULL,
  `prix` float NOT NULL,
  `image` varchar(250) NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pc_gamer`
--

INSERT INTO `pc_gamer` (`id_pc_gamer`, `nom`, `description`, `date`, `prix`, `image`, `quantite`) VALUES
(6, 'Dupondhh', 'rthrthj', '2021-06-18', 1200, 'second-sister-inquisitor-star-wars-funko-pop (1).jpg', 15);

-- --------------------------------------------------------

--
-- Table structure for table `pc_gamer_comp`
--

CREATE TABLE `pc_gamer_comp` (
  `id_pc_gamer` int(11) NOT NULL,
  `id_composant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pc_portables`
--

CREATE TABLE `pc_portables` (
  `id_pc_portable` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  `prix` float NOT NULL,
  `image` varchar(50) NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pc_portables`
--

INSERT INTO `pc_portables` (`id_pc_portable`, `nom`, `description`, `date`, `prix`, `image`, `quantite`) VALUES
(4, 'ailonfyou', 'waaaw', '2021-06-24', 120000000, 'logo.png', 11),
(6, 'Sub.Nojoke', 'dfgnbwdfghn', '2021-06-27', 1200, 'logo.png', 7),
(7, 'neeeeeeeeeeeeeeeew', 'dthdth', '2021-07-01', 800, 'TheCrystalsAwards2018-bg[1].jpg', 11);

-- --------------------------------------------------------

--
-- Table structure for table `statut`
--

CREATE TABLE `statut` (
  `id_statut` int(11) NOT NULL,
  `nom_statut` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `statut`
--

INSERT INTO `statut` (`id_statut`, `nom_statut`) VALUES
(1, 'Administrateur'),
(2, 'Utilisateur');

-- --------------------------------------------------------

--
-- Table structure for table `type_composant`
--

CREATE TABLE `type_composant` (
  `id_type_composant` int(11) NOT NULL,
  `nom_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type_composant`
--

INSERT INTO `type_composant` (`id_type_composant`, `nom_type`) VALUES
(2, 'Boitier'),
(3, 'Processeur'),
(4, 'Carte Mere'),
(5, 'Memoire'),
(6, 'Carte Graphique'),
(7, 'SSD'),
(8, 'HDD'),
(9, 'Alimentation'),
(10, 'Refroidissement'),
(11, 'Systeme d\'exploitation');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id_utilisateur` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `id_statut` int(11) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `nom`, `prenom`, `login`, `password`, `id_statut`, `email`) VALUES
(7, 'Vegeta', 'Majin', 'vegeta', '22298fb40914e48b1556ce0c8ffa7c93', 1, 'd4t0y@outlook.com'),
(8, 'Beerus', 'Salma', 'beerus', 'e06c426359fb4765675a2443989c09ba', 2, 'beerus@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adresses`
--
ALTER TABLE `adresses`
  ADD PRIMARY KEY (`id_adresse`),
  ADD KEY `fk_adresse_client` (`id_client`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`);

--
-- Indexes for table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id_commande`),
  ADD KEY `fk_adresse` (`id_adresse`),
  ADD KEY `fk_client_commande` (`id_client`);

--
-- Indexes for table `commandes_pc_gamer`
--
ALTER TABLE `commandes_pc_gamer`
  ADD PRIMARY KEY (`id_commande`,`id_pc_gamer`),
  ADD KEY `fk_pc_gamer_commande` (`id_pc_gamer`);

--
-- Indexes for table `composants`
--
ALTER TABLE `composants`
  ADD PRIMARY KEY (`id_composant`),
  ADD KEY `fk_comp` (`id_type_composant`);

--
-- Indexes for table `pc_gamer`
--
ALTER TABLE `pc_gamer`
  ADD PRIMARY KEY (`id_pc_gamer`);

--
-- Indexes for table `pc_gamer_comp`
--
ALTER TABLE `pc_gamer_comp`
  ADD PRIMARY KEY (`id_pc_gamer`,`id_composant`),
  ADD KEY `fk_pc` (`id_composant`);

--
-- Indexes for table `pc_portables`
--
ALTER TABLE `pc_portables`
  ADD PRIMARY KEY (`id_pc_portable`);

--
-- Indexes for table `statut`
--
ALTER TABLE `statut`
  ADD PRIMARY KEY (`id_statut`);

--
-- Indexes for table `type_composant`
--
ALTER TABLE `type_composant`
  ADD PRIMARY KEY (`id_type_composant`);

--
-- Indexes for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id_utilisateur`),
  ADD KEY `fk_statut` (`id_statut`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adresses`
--
ALTER TABLE `adresses`
  MODIFY `id_adresse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id_commande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `composants`
--
ALTER TABLE `composants`
  MODIFY `id_composant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `pc_gamer`
--
ALTER TABLE `pc_gamer`
  MODIFY `id_pc_gamer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pc_portables`
--
ALTER TABLE `pc_portables`
  MODIFY `id_pc_portable` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `statut`
--
ALTER TABLE `statut`
  MODIFY `id_statut` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `type_composant`
--
ALTER TABLE `type_composant`
  MODIFY `id_type_composant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adresses`
--
ALTER TABLE `adresses`
  ADD CONSTRAINT `fk_adresse_client` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `fk_adresse` FOREIGN KEY (`id_adresse`) REFERENCES `adresses` (`id_adresse`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_client_commande` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `commandes_pc_gamer`
--
ALTER TABLE `commandes_pc_gamer`
  ADD CONSTRAINT `fk_commande_pc_gamer` FOREIGN KEY (`id_commande`) REFERENCES `commandes` (`id_commande`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pc_gamer_commande` FOREIGN KEY (`id_pc_gamer`) REFERENCES `pc_gamer` (`id_pc_gamer`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `composants`
--
ALTER TABLE `composants`
  ADD CONSTRAINT `fk_comp` FOREIGN KEY (`id_type_composant`) REFERENCES `type_composant` (`id_type_composant`);

--
-- Constraints for table `pc_gamer_comp`
--
ALTER TABLE `pc_gamer_comp`
  ADD CONSTRAINT `fk_pc` FOREIGN KEY (`id_composant`) REFERENCES `composants` (`id_composant`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pc_gamer_comp_ibfk_1` FOREIGN KEY (`id_pc_gamer`) REFERENCES `pc_gamer` (`id_pc_gamer`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD CONSTRAINT `fk_statut` FOREIGN KEY (`id_statut`) REFERENCES `statut` (`id_statut`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
