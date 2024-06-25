-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Apr 04, 2024 at 09:30 AM
-- Server version: 8.0.27
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tmaconnect`
--

-- --------------------------------------------------------

--
-- Table structure for table `tc_benef`
--

DROP TABLE IF EXISTS `tc_benef`;
CREATE TABLE IF NOT EXISTS `tc_benef` (
  `IdBenef` int NOT NULL AUTO_INCREMENT,
  `lbl_benef` varchar(50) NOT NULL,
  `ser_benef` int NOT NULL,
  `actif` varchar(3) NOT NULL,
  PRIMARY KEY (`IdBenef`),
  KEY `ser_benef` (`ser_benef`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tc_benef`
--

INSERT INTO `tc_benef` (`IdBenef`, `lbl_benef`, `ser_benef`, `actif`) VALUES
(1, 'Adhérent', 2, 'oui');

-- --------------------------------------------------------

--
-- Table structure for table `tc_date`
--

DROP TABLE IF EXISTS `tc_date`;
CREATE TABLE IF NOT EXISTS `tc_date` (
  `date_connect` timestamp NOT NULL,
  PRIMARY KEY (`date_connect`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tc_demandes`
--

DROP TABLE IF EXISTS `tc_demandes`;
CREATE TABLE IF NOT EXISTS `tc_demandes` (
  `IdDemande` int NOT NULL AUTO_INCREMENT,
  `dom_dmd` int NOT NULL,
  `qual_dmd` int NOT NULL,
  `prt_dmd` int NOT NULL,
  `libelle` varchar(80) NOT NULL,
  `date_crea` date NOT NULL,
  `util_crea` int NOT NULL,
  `date_emet` date NOT NULL,
  `util_emet` int NOT NULL,
  `date_recu` date NOT NULL,
  `util_benef` int NOT NULL,
  `date_etat_dmd` date NOT NULL,
  `etat_dmd` int NOT NULL,
  `date_visa_dmd` date NOT NULL,
  `util_sign_dmd` int NOT NULL,
  `util_affect_dmd` int NOT NULL,
  `date_fs` date DEFAULT NULL,
  `amorti_dmd` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `date_rct_prvu` date DEFAULT NULL,
  `regroupement` int NOT NULL,
  `date_archiv` date DEFAULT NULL,
  `IdLdoi` int DEFAULT NULL,
  `IdEval` int DEFAULT NULL,
  `IdRecette` int DEFAULT NULL,
  `IdMep` int DEFAULT NULL,
  PRIMARY KEY (`IdDemande`),
  KEY `fk_TCDemandes_TCDomaine` (`dom_dmd`),
  KEY `qual_dmd` (`qual_dmd`),
  KEY `prt_dmd` (`prt_dmd`),
  KEY `util_crea` (`util_crea`),
  KEY `util_emet` (`util_emet`),
  KEY `util_benef` (`util_benef`),
  KEY `etat_dmd` (`etat_dmd`),
  KEY `util_sign_dmd` (`util_sign_dmd`),
  KEY `util_affect_dmd` (`util_affect_dmd`),
  KEY `regroupement` (`regroupement`),
  KEY `fk_tc_demandes_tc_mep` (`IdMep`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tc_demandes`
--

INSERT INTO `tc_demandes` (`IdDemande`, `dom_dmd`, `qual_dmd`, `prt_dmd`, `libelle`, `date_crea`, `util_crea`, `date_emet`, `util_emet`, `date_recu`, `util_benef`, `date_etat_dmd`, `etat_dmd`, `date_visa_dmd`, `util_sign_dmd`, `util_affect_dmd`, `date_fs`, `amorti_dmd`, `date_rct_prvu`, `regroupement`, `date_archiv`, `IdLdoi`, `IdEval`, `IdRecette`, `IdMep`) VALUES
(8, 1, 3, 2, 'test demande', '2023-08-24', 5, '2023-08-24', 5, '2023-08-24', 1, '2023-08-24', 3, '2023-08-24', 4, 6, '2023-08-30', 'on', '2023-08-31', 1, '2023-08-24', 1, 1, NULL, 162),
(9, 2, 2, 2, 'test demande', '2023-08-24', 5, '2023-08-24', 5, '2023-08-24', 1, '2023-08-24', 3, '2023-08-24', 4, 6, '2023-08-30', 'on', '2023-08-31', 1, '2023-08-25', 1, 1, NULL, 164),
(10, 2, 1, 3, 'test demande', '2023-08-25', 3, '2023-08-25', 3, '2023-08-25', 1, '2023-08-25', 2, '2023-08-25', 2, 1, '2023-08-30', 'on', '2023-08-31', 2, '2023-08-25', 1, 1, NULL, 163),
(11, 2, 1, 3, 'Test pour voir si l\'affichage dans le champs libellé du tableau des demandes', '2023-08-25', 3, '2023-08-25', 3, '2023-08-25', 1, '2023-08-25', 2, '2023-08-25', 2, 1, '2023-08-30', 'on', '2023-08-31', 2, '2023-08-25', 1, 1, NULL, 165);

-- --------------------------------------------------------

--
-- Table structure for table `tc_domaine`
--

DROP TABLE IF EXISTS `tc_domaine`;
CREATE TABLE IF NOT EXISTS `tc_domaine` (
  `IdDomaine` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) NOT NULL,
  PRIMARY KEY (`IdDomaine`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tc_domaine`
--

INSERT INTO `tc_domaine` (`IdDomaine`, `libelle`) VALUES
(1, 'CPT - Comptabilité'),
(2, 'Congés payés');

-- --------------------------------------------------------

--
-- Table structure for table `tc_droit`
--

DROP TABLE IF EXISTS `tc_droit`;
CREATE TABLE IF NOT EXISTS `tc_droit` (
  `IdDroit` int NOT NULL AUTO_INCREMENT,
  `d_libelle` varchar(50) NOT NULL,
  PRIMARY KEY (`IdDroit`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tc_droit`
--

INSERT INTO `tc_droit` (`IdDroit`, `d_libelle`) VALUES
(1, '100 - Super Admin'),
(2, '90 - Chef de service'),
(3, '80 - Admin'),
(4, '50 - Utilisateur');

-- --------------------------------------------------------

--
-- Table structure for table `tc_environnement`
--

DROP TABLE IF EXISTS `tc_environnement`;
CREATE TABLE IF NOT EXISTS `tc_environnement` (
  `IdEnv` int NOT NULL AUTO_INCREMENT,
  `nom_env` varchar(10) NOT NULL,
  `libelle` varchar(30) NOT NULL,
  PRIMARY KEY (`IdEnv`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tc_environnement`
--

INSERT INTO `tc_environnement` (`IdEnv`, `nom_env`, `libelle`) VALUES
(1, 'AS400', 'AS400'),
(2, 'NET', 'Internet');

-- --------------------------------------------------------

--
-- Table structure for table `tc_etat`
--

DROP TABLE IF EXISTS `tc_etat`;
CREATE TABLE IF NOT EXISTS `tc_etat` (
  `IdEtat` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) NOT NULL,
  PRIMARY KEY (`IdEtat`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tc_etat`
--

INSERT INTO `tc_etat` (`IdEtat`, `libelle`) VALUES
(1, 'Transmise au responsable des études'),
(2, 'En attente'),
(3, 'Acceptée'),
(4, 'Terminée'),
(5, 'Refusée'),
(7, 'Abandonnée');

-- --------------------------------------------------------

--
-- Table structure for table `tc_eval`
--

DROP TABLE IF EXISTS `tc_eval`;
CREATE TABLE IF NOT EXISTS `tc_eval` (
  `IdEval` int NOT NULL AUTO_INCREMENT,
  `date_eval` date NOT NULL,
  `util_date_emet` int NOT NULL,
  `charge_eval` int NOT NULL,
  `tarif_eval` varchar(30) NOT NULL,
  `accept_eval` varchar(3) NOT NULL,
  `date_accept_eval` date NOT NULL,
  `util_accept_eval` int NOT NULL,
  `nbj_passe` varchar(2) NOT NULL,
  `rap_eval` varchar(2) NOT NULL,
  `demande_fact` varchar(3) NOT NULL,
  PRIMARY KEY (`IdEval`),
  KEY `util_date_emet` (`util_date_emet`),
  KEY `util_accept_eval` (`util_accept_eval`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tc_groupe`
--

DROP TABLE IF EXISTS `tc_groupe`;
CREATE TABLE IF NOT EXISTS `tc_groupe` (
  `IdGroupe` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) NOT NULL,
  PRIMARY KEY (`IdGroupe`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tc_groupe`
--

INSERT INTO `tc_groupe` (`IdGroupe`, `libelle`) VALUES
(1, 'Etudes'),
(2, 'Etudes + Exploit. + TMA'),
(3, 'Exploitation');

-- --------------------------------------------------------

--
-- Table structure for table `tc_ldoi`
--

DROP TABLE IF EXISTS `tc_ldoi`;
CREATE TABLE IF NOT EXISTS `tc_ldoi` (
  `IdLdoi` int NOT NULL AUTO_INCREMENT,
  `nom_env` int NOT NULL,
  `type` varchar(10) NOT NULL,
  `environnement` int NOT NULL,
  `libelle` varchar(50) NOT NULL,
  `date_mep` int DEFAULT NULL,
  PRIMARY KEY (`IdLdoi`),
  KEY `nom_env` (`nom_env`),
  KEY `environnement` (`environnement`),
  KEY `date_mep` (`date_mep`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tc_logs`
--

DROP TABLE IF EXISTS `tc_logs`;
CREATE TABLE IF NOT EXISTS `tc_logs` (
  `IdUtil` int NOT NULL,
  `date_connect` timestamp NOT NULL,
  PRIMARY KEY (`IdUtil`,`date_connect`),
  KEY `date_connect` (`date_connect`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tc_mep`
--

DROP TABLE IF EXISTS `tc_mep`;
CREATE TABLE IF NOT EXISTS `tc_mep` (
  `IdMep` int NOT NULL AUTO_INCREMENT,
  `date_mep` date NOT NULL,
  `util_emet_mep` int NOT NULL,
  PRIMARY KEY (`IdMep`),
  KEY `util_date_mep` (`util_emet_mep`)
) ENGINE=InnoDB AUTO_INCREMENT=167 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tc_mep`
--

INSERT INTO `tc_mep` (`IdMep`, `date_mep`, `util_emet_mep`) VALUES
(149, '2023-12-14', 1),
(150, '2023-12-14', 1),
(151, '2023-12-14', 1),
(152, '2023-12-14', 1),
(153, '2023-12-14', 3),
(154, '2023-12-13', 3),
(155, '2023-12-14', 3),
(156, '2023-12-13', 3),
(157, '2023-12-14', 1),
(158, '2023-12-14', 1),
(159, '2023-12-14', 1),
(160, '2023-12-14', 1),
(161, '2023-12-20', 1),
(162, '2024-01-26', 3),
(163, '2023-12-21', 2),
(164, '2023-12-21', 1),
(165, '2024-01-26', 3),
(166, '2023-12-21', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tc_poste`
--

DROP TABLE IF EXISTS `tc_poste`;
CREATE TABLE IF NOT EXISTS `tc_poste` (
  `IdPoste` int NOT NULL AUTO_INCREMENT,
  `p_libelle` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`IdPoste`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tc_poste`
--

INSERT INTO `tc_poste` (`IdPoste`, `p_libelle`) VALUES
(1, 'Directeur des Systèmes d\'Informations'),
(2, 'Administrateur réseau adjoint'),
(3, 'Développeur junior'),
(4, 'Gestionnaire Prestations'),
(5, 'Responsable du Service Etudes '),
(6, 'Chef de projet TMA AUBAY\r\n'),
(7, 'Analyste');

-- --------------------------------------------------------

--
-- Table structure for table `tc_priorite`
--

DROP TABLE IF EXISTS `tc_priorite`;
CREATE TABLE IF NOT EXISTS `tc_priorite` (
  `IdPriorite` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) NOT NULL,
  PRIMARY KEY (`IdPriorite`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tc_priorite`
--

INSERT INTO `tc_priorite` (`IdPriorite`, `libelle`) VALUES
(1, 'Très Urgente'),
(2, 'Urgente'),
(3, 'Moyenne'),
(4, 'Faible');

-- --------------------------------------------------------

--
-- Table structure for table `tc_qualif`
--

DROP TABLE IF EXISTS `tc_qualif`;
CREATE TABLE IF NOT EXISTS `tc_qualif` (
  `IdQual` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) NOT NULL,
  `Fac_eval` int DEFAULT NULL,
  `Fac_mep` int DEFAULT NULL,
  `Fac_rct` int DEFAULT NULL,
  PRIMARY KEY (`IdQual`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tc_qualif`
--

INSERT INTO `tc_qualif` (`IdQual`, `libelle`, `Fac_eval`, `Fac_mep`, `Fac_rct`) VALUES
(1, 'Curative', 50, 50, 0),
(2, 'Evolutive', 50, 0, 50),
(3, 'Garantie', 0, 0, 0),
(4, 'Préventive', 50, 0, 50),
(5, 'Support', 50, 50, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tc_recette`
--

DROP TABLE IF EXISTS `tc_recette`;
CREATE TABLE IF NOT EXISTS `tc_recette` (
  `IdRecette` int NOT NULL AUTO_INCREMENT,
  `date_mise_rct` date NOT NULL,
  `util_date_emet` int NOT NULL,
  `num_bon_lvrs` int NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `rct_prononce` varchar(3) NOT NULL,
  `util_rct_prononce` int NOT NULL,
  `nb_fch_evos` int NOT NULL,
  `nb_fch_non_anos` int NOT NULL,
  `nb_fch_valos` int NOT NULL,
  PRIMARY KEY (`IdRecette`),
  KEY `util_date_emet` (`util_date_emet`),
  KEY `util_rct_prononce` (`util_rct_prononce`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tc_regroupement`
--

DROP TABLE IF EXISTS `tc_regroupement`;
CREATE TABLE IF NOT EXISTS `tc_regroupement` (
  `IdRegroupe` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) NOT NULL,
  PRIMARY KEY (`IdRegroupe`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tc_regroupement`
--

INSERT INTO `tc_regroupement` (`IdRegroupe`, `libelle`) VALUES
(1, 'Demande Standard'),
(2, 'Certificats Internet');

-- --------------------------------------------------------

--
-- Table structure for table `tc_service`
--

DROP TABLE IF EXISTS `tc_service`;
CREATE TABLE IF NOT EXISTS `tc_service` (
  `IdService` int NOT NULL AUTO_INCREMENT,
  `c_libelle` varchar(50) NOT NULL,
  `s_libelle` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IdService`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tc_service`
--

INSERT INTO `tc_service` (`IdService`, `c_libelle`, `s_libelle`) VALUES
(1, 'INF', 'Direction Informatique'),
(2, 'ADH', 'Service Adhérent'),
(3, 'PRE', 'Service Prestations'),
(4, 'HOM', 'Service Homologation'),
(5, 'CTL', 'Service Contrôle'),
(6, 'CPT', 'Service Comptabilité'),
(7, 'AUB', 'Aubay'),
(8, 'CGE', 'Contrôle de Gestion'),
(9, 'COU', 'Service Logistique'),
(10, 'DG', 'Direction Générale'),
(11, 'SEI', 'Secrétariat Informatique'),
(12, 'SG', 'Secrétariat Général');

-- --------------------------------------------------------

--
-- Table structure for table `tc_utilisateur`
--

DROP TABLE IF EXISTS `tc_utilisateur`;
CREATE TABLE IF NOT EXISTS `tc_utilisateur` (
  `IdUtil` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `matricule` char(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(50) NOT NULL,
  `passwd` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `S_users` int NOT NULL,
  `P_users` int NOT NULL,
  `D_users` int NOT NULL,
  `dateFin` date NOT NULL,
  `derniere_connect` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `actif` char(3) DEFAULT NULL,
  PRIMARY KEY (`IdUtil`),
  KEY `S_users` (`S_users`),
  KEY `P_users` (`P_users`),
  KEY `D_users` (`D_users`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tc_utilisateur`
--

INSERT INTO `tc_utilisateur` (`IdUtil`, `nom`, `prenom`, `matricule`, `email`, `passwd`, `S_users`, `P_users`, `D_users`, `dateFin`, `derniere_connect`, `actif`) VALUES
(1, 'ROUY', 'Mathis', 'C1120', 'c1120@cnetp.fr', '$2y$10$Tn0mc85bcw07YHTyYcY.suPHmYD2KohyEWriWWI/S1d/khASvHJWu', 1, 3, 1, '2025-07-31', '2024-03-22 16:15:38', 'OUI'),
(2, 'NANKOO', 'Kevin', 'C1091', 'c1091@cnetp.fr', '$2y$10$2TOmKW2EBGhWVwViFTMD3.sLx.pPdv9AVGwnsLxgvLfZak/CVxgoO', 1, 2, 2, '2023-06-01', '2023-06-01 12:55:08', NULL),
(3, 'PIGOUCHET', 'Etienne', 'C0123', 'c0123@cnetp.fr', '$2y$10$dcUUV2jxtZmO6ZpbeZYvw.Gq1fZR9Y7.zKeYHfUCFpicwZ3ANuEfW', 1, 1, 1, '0000-00-00', '2023-11-15 16:15:02', 'NON'),
(4, 'HAOUZI ', 'Jean-Luc', 'C0321', 'c0321@cnetp.fr', '$2y$10$RspV3PcsTj0KbDbptpo5jugJzWTgVftUEUBgg46UE9qE/WrInNqSu', 1, 5, 2, '0000-00-00', '2023-11-15 14:06:03', NULL),
(5, 'GORLIEZ', 'Karine', 'C0910', 'c0910@cnetp.fr', '$2y$10$YTstclors1fjN.YkenJJFOkkVMgepFFLI.V7L1oRwr0eYXgIZzwCG', 7, 6, 1, '0000-00-00', '2023-11-15 15:27:49', NULL),
(6, 'MALJAOUI', 'Souhail', 'C0456', 'c0456@cnetp.fr', '$2y$10$Er3YSWMbZGHktle6IAlAIOx3L2Eei.mpYqH3xZxEMWt/9pyNbnXwe', 7, 7, 4, '0000-00-00', '2023-07-20 09:33:06', NULL),
(13, 'MERLINO', 'Elodie', 'c0920', 'c0920@cnetp.fr', '$2y$10$f7O5uREjgwaEk5m6HIKoAudl2BsqCjxV7y42/IiEtypwLjqloLpsi', 7, 7, 3, '2024-02-23', '2023-11-30 16:08:19', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tc_benef`
--
ALTER TABLE `tc_benef`
  ADD CONSTRAINT `tc_benef_ibfk_1` FOREIGN KEY (`ser_benef`) REFERENCES `tc_service` (`IdService`);

--
-- Constraints for table `tc_demandes`
--
ALTER TABLE `tc_demandes`
  ADD CONSTRAINT `fk_tc_demandes_tc_mep` FOREIGN KEY (`IdMep`) REFERENCES `tc_mep` (`IdMep`),
  ADD CONSTRAINT `fk_TCDemandes_TCDomaine` FOREIGN KEY (`dom_dmd`) REFERENCES `tc_domaine` (`IdDomaine`),
  ADD CONSTRAINT `tc_demandes_ibfk_1` FOREIGN KEY (`qual_dmd`) REFERENCES `tc_qualif` (`IdQual`),
  ADD CONSTRAINT `tc_demandes_ibfk_2` FOREIGN KEY (`prt_dmd`) REFERENCES `tc_priorite` (`IdPriorite`),
  ADD CONSTRAINT `tc_demandes_ibfk_3` FOREIGN KEY (`util_crea`) REFERENCES `tc_utilisateur` (`IdUtil`),
  ADD CONSTRAINT `tc_demandes_ibfk_4` FOREIGN KEY (`util_emet`) REFERENCES `tc_utilisateur` (`IdUtil`),
  ADD CONSTRAINT `tc_demandes_ibfk_5` FOREIGN KEY (`util_benef`) REFERENCES `tc_utilisateur` (`IdUtil`),
  ADD CONSTRAINT `tc_demandes_ibfk_6` FOREIGN KEY (`etat_dmd`) REFERENCES `tc_etat` (`IdEtat`),
  ADD CONSTRAINT `tc_demandes_ibfk_7` FOREIGN KEY (`util_sign_dmd`) REFERENCES `tc_utilisateur` (`IdUtil`),
  ADD CONSTRAINT `tc_demandes_ibfk_8` FOREIGN KEY (`util_affect_dmd`) REFERENCES `tc_utilisateur` (`IdUtil`),
  ADD CONSTRAINT `tc_demandes_ibfk_9` FOREIGN KEY (`regroupement`) REFERENCES `tc_regroupement` (`IdRegroupe`);

--
-- Constraints for table `tc_eval`
--
ALTER TABLE `tc_eval`
  ADD CONSTRAINT `tc_eval_ibfk_1` FOREIGN KEY (`util_date_emet`) REFERENCES `tc_utilisateur` (`IdUtil`),
  ADD CONSTRAINT `tc_eval_ibfk_2` FOREIGN KEY (`util_accept_eval`) REFERENCES `tc_utilisateur` (`IdUtil`);

--
-- Constraints for table `tc_ldoi`
--
ALTER TABLE `tc_ldoi`
  ADD CONSTRAINT `tc_ldoi_ibfk_1` FOREIGN KEY (`nom_env`) REFERENCES `tc_environnement` (`IdEnv`),
  ADD CONSTRAINT `tc_ldoi_ibfk_2` FOREIGN KEY (`environnement`) REFERENCES `tc_environnement` (`IdEnv`),
  ADD CONSTRAINT `tc_ldoi_ibfk_3` FOREIGN KEY (`date_mep`) REFERENCES `tc_mep` (`IdMep`);

--
-- Constraints for table `tc_logs`
--
ALTER TABLE `tc_logs`
  ADD CONSTRAINT `tc_logs_ibfk_1` FOREIGN KEY (`IdUtil`) REFERENCES `tc_utilisateur` (`IdUtil`),
  ADD CONSTRAINT `tc_logs_ibfk_2` FOREIGN KEY (`date_connect`) REFERENCES `tc_date` (`date_connect`);

--
-- Constraints for table `tc_mep`
--
ALTER TABLE `tc_mep`
  ADD CONSTRAINT `tc_mep_ibfk_1` FOREIGN KEY (`util_emet_mep`) REFERENCES `tc_utilisateur` (`IdUtil`);

--
-- Constraints for table `tc_recette`
--
ALTER TABLE `tc_recette`
  ADD CONSTRAINT `tc_recette_ibfk_1` FOREIGN KEY (`util_date_emet`) REFERENCES `tc_utilisateur` (`IdUtil`),
  ADD CONSTRAINT `tc_recette_ibfk_2` FOREIGN KEY (`util_rct_prononce`) REFERENCES `tc_utilisateur` (`IdUtil`);

--
-- Constraints for table `tc_utilisateur`
--
ALTER TABLE `tc_utilisateur`
  ADD CONSTRAINT `tc_utilisateur_ibfk_1` FOREIGN KEY (`S_users`) REFERENCES `tc_service` (`IdService`),
  ADD CONSTRAINT `tc_utilisateur_ibfk_2` FOREIGN KEY (`P_users`) REFERENCES `tc_poste` (`IdPoste`),
  ADD CONSTRAINT `tc_utilisateur_ibfk_3` FOREIGN KEY (`D_users`) REFERENCES `tc_droit` (`IdDroit`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
