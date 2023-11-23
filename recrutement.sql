-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2023 at 10:22 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recrutement`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--


--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nom`, `prenom`, `email`, `password`, `adresse`, `OTP`, `OTP_expiry`, `cin`) VALUES
(1, 'admin', 'admin', 'admin-app@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'Rue Admin', NULL, NULL, 'JM99090');

-- --------------------------------------------------------

--
-- Table structure for table `candidat`
--


INSERT INTO `candidat` (`id_candidat`, `nom`, `prenom`, `email`, `password`, `adresse`, `cv`, `lettre_motiv`, `OTP`, `OTP_expiry`, `cin`) VALUES
(1, 'OUBELLA', 'Abdallah', 'aoubella88@gmail.com', 'e5f874580ceab0457e7b140eb014fd17', 'Guelmim', '1700667628.pdf', '1700350569.pdf', NULL, NULL, 'JM99090'),
(2, 'asasas', 'asasas', 'aoubella00@sqs.com', 'asasasasasasas', 'asassaasas', 'qsqsqsqs', 'qsqsqsqsqs', NULL, NULL, 'lm78787878');

-- --------------------------------------------------------

--
-- Table structure for table `demande_emploi`
--


--
-- Dumping data for table `demande_emploi`
--

INSERT INTO `demande_emploi` (`id_candidat`, `id_offre`, `date_entretien`, `accepted`) VALUES
(1, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `departement`
--


--
-- Dumping data for table `departement`
--

INSERT INTO `departement` (`id_depart`, `nom_depart`) VALUES
(1, 'Marketing'),
(2, 'Finance'),
(3, 'Ressources humaines'),
(4, 'Technologies de l\'information'),
(5, 'Opérations'),
(6, 'Ventes'),
(7, 'Service client'),
(8, 'Développement produit'),
(9, 'Logistique'),
(10, 'Qualité'),
(11, 'Administration'),
(12, 'Communication'),
(13, 'Relations publiques'),
(14, 'Recherche et développement'),
(15, 'Sécurité'),
(16, 'Formation'),
(17, 'Gestion de projet'),
(18, 'Achats'),
(19, 'Support technique'),
(20, 'Événementiel');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--


--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(8, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(9, '2023_10_23_183406_create_admin_table', 1),
(10, '2023_10_23_183820_create_candidat_table', 1),
(11, '2023_10_23_183952_create_departement_table', 1),
(12, '2023_10_23_184754_create_profession_table', 1),
(13, '2023_10_23_185052_create_offre_emploi_table', 1),
(14, '2023_10_23_185810_create_demanade_emploi_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `offre_emploi`
--

--
-- Dumping data for table `offre_emploi`
--

INSERT INTO `offre_emploi` (`id_offre`, `id_prof`, `details`, `type_emploi`, `date_pub`, `date_termine`, `termine`) VALUES
(1, 1, '15458546.pdf', 'Contrat à durée indéterminée', '2023-01-01 00:00:00', '2023-02-01 00:00:00', 0),
(2, 2, '15458546.pdf', 'Emploi à temps partiel', '2023-01-02 00:00:00', '2023-02-02 00:00:00', 0),
(3, 3, '15458546.pdf', 'Stage', '2023-01-06 00:00:00', '2023-02-03 00:00:00', 0),
(4, 4, '15458546.pdf', 'Emploi à temps partiel', '2023-01-04 00:00:00', '2023-11-23 13:54:10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--


-- --------------------------------------------------------

--
-- Table structure for table `profession`
--


--
-- Dumping data for table `profession`
--

INSERT INTO `profession` (`id_prof`, `id_depart`, `nom_prof`) VALUES
(1, 3, 'Ingénieur en informatique'),
(2, 5, 'Architecte'),
(3, 4, 'Designer graphique'),
(4, 7, 'Infirmière'),
(5, 6, 'Ingénieur civil'),
(6, 8, 'Comptable'),
(7, 9, 'Développeur web'),
(8, 14, 'Développeur mobile'),
(9, 17, 'Ingénieur en environnement'),
(10, 16, 'Responsable des ressources humaines'),
(11, 19, 'Traducteur'),
(12, 18, 'Electricien');


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
