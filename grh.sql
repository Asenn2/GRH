-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 03 juin 2024 à 01:26
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `grh`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonce`
--

CREATE TABLE `annonce` (
  `id` int(11) NOT NULL,
  `titre` varchar(25) NOT NULL,
  `texte` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `annonce`
--

INSERT INTO `annonce` (`id`, `titre`, `texte`) VALUES
(1, 'Reunion', 'Obligatoire a 18h');

-- --------------------------------------------------------

--
-- Structure de la table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `candidat`
--

CREATE TABLE `candidat` (
  `idCandidat` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `Mail` varchar(255) NOT NULL,
  `Cv` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `candidature`
--

CREATE TABLE `candidature` (
  `idCandidature` int(11) NOT NULL,
  `idOffreEmploi` int(11) NOT NULL,
  `idCandidat` int(11) NOT NULL,
  `Motivation` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `condition`
--

CREATE TABLE `condition` (
  `idCondition` int(11) NOT NULL,
  `TypeAvantage` varchar(255) NOT NULL,
  `NomCondition` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `conge`
--

CREATE TABLE `conge` (
  `idConge` int(11) NOT NULL,
  `NomConge` varchar(255) DEFAULT NULL,
  `TypeConge` int(11) NOT NULL,
  `DateDebut` date NOT NULL,
  `DateFin` date NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `idEmploye` int(11) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `conge`
--

INSERT INTO `conge` (`idConge`, `NomConge`, `TypeConge`, `DateDebut`, `DateFin`, `Description`, `status`, `idEmploye`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, 2, '2024-06-01', '2024-06-08', 'tyty', 'En cours', 1, NULL, '2024-05-31 17:03:24', '2024-05-31 17:03:24');

-- --------------------------------------------------------

--
-- Structure de la table `contrat`
--

CREATE TABLE `contrat` (
  `idContrat` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `Employe` int(11) NOT NULL,
  `Conditions` varchar(255) NOT NULL,
  `Type` int(11) NOT NULL,
  `Debut` date NOT NULL,
  `Fin` date NOT NULL,
  `DateResiliation` date NOT NULL,
  `contratFile` varchar(300) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `demandeformation`
--

CREATE TABLE `demandeformation` (
  `idDemandeFormation` int(11) NOT NULL,
  `Employe` int(11) NOT NULL,
  `Formation` int(11) NOT NULL,
  `status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `demandeformation`
--

INSERT INTO `demandeformation` (`idDemandeFormation`, `Employe`, `Formation`, `status`) VALUES
(1, 1, 2, 'En cours'),
(4, 1, 3, 'En cours');

-- --------------------------------------------------------

--
-- Structure de la table `demandepromotion`
--

CREATE TABLE `demandepromotion` (
  `idDemandePromotion` int(11) NOT NULL,
  `Promotion` int(11) NOT NULL,
  `Employe` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `demandepromotion`
--

INSERT INTO `demandepromotion` (`idDemandePromotion`, `Promotion`, `Employe`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'En cours', NULL, '2024-06-02 19:01:37', '2024-06-02 19:01:37');

-- --------------------------------------------------------

--
-- Structure de la table `demandestage`
--

CREATE TABLE `demandestage` (
  `idDemandeStage` int(11) NOT NULL,
  `idStage` int(11) NOT NULL,
  `idStageCandidat` int(11) NOT NULL,
  `Motivation` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

CREATE TABLE `departement` (
  `idDepartement` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `Desc` varchar(255) DEFAULT NULL,
  `photo` varchar(300) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `departement`
--

INSERT INTO `departement` (`idDepartement`, `nom`, `Desc`, `photo`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Info', 'zada', '/storage/photos/1717089446WhatsApp Image 2024-05-25 at 02.52.56.jpeg', NULL, '2024-05-30 16:17:26', '2024-05-30 16:17:26');

-- --------------------------------------------------------

--
-- Structure de la table `employe`
--

CREATE TABLE `employe` (
  `idEmploye` int(11) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `sexe` varchar(255) NOT NULL,
  `LieuNaiss` varchar(255) NOT NULL,
  `DateNaiss` date NOT NULL,
  `Num` varchar(255) NOT NULL,
  `Adresse` varchar(255) NOT NULL,
  `dateEmb` date NOT NULL,
  `idDepartement` int(11) NOT NULL,
  `idPoste` int(11) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `employe`
--

INSERT INTO `employe` (`idEmploye`, `mail`, `nom`, `prenom`, `sexe`, `LieuNaiss`, `DateNaiss`, `Num`, `Adresse`, `dateEmb`, `idDepartement`, `idPoste`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'ziad.sell@hotmail.com', 'Ziad', 'Sellak', 'homme', 'rabat', '2002-10-24', '06666666', 'Adresse1', '2024-05-30', 2, 1, NULL, '2024-05-30 16:18:50', '2024-05-30 16:18:50');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

CREATE TABLE `formation` (
  `idFormation` int(11) NOT NULL,
  `NomFormation` varchar(255) NOT NULL,
  `DateFormation` date NOT NULL,
  `DureeHeure` int(11) NOT NULL,
  `Objectif` varchar(255) NOT NULL,
  `Format` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `formation`
--

INSERT INTO `formation` (`idFormation`, `NomFormation`, `DateFormation`, `DureeHeure`, `Objectif`, `Format`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Formation1', '2024-05-31', 20, 'pour', 'Présentielle', NULL, '2024-05-20 14:58:17', '2024-05-20 14:58:17'),
(3, 'Formation2', '2024-06-23', 35, 'Pour', 'En ligne', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `login_table`
--

CREATE TABLE `login_table` (
  `idlogin_table` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(10) NOT NULL,
  `idEmploye` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `login_table`
--

INSERT INTO `login_table` (`idlogin_table`, `email`, `password`, `role`, `idEmploye`) VALUES
(0, 'rh@gmail.com', '12345', 'RH', NULL),
(1, 'ziad.sell@hotmail.com', '12345', 'Employe', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, 'create_GRHDATABASE', 1);

-- --------------------------------------------------------

--
-- Structure de la table `offreemploi`
--

CREATE TABLE `offreemploi` (
  `idOffreEmploi` int(11) NOT NULL,
  `idTypeContrat` int(11) NOT NULL,
  `idPoste` int(11) NOT NULL,
  `idDepartement` int(11) NOT NULL,
  `CompetenceRequise` varchar(255) NOT NULL,
  `Commentaire` varchar(100) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `poste`
--

CREATE TABLE `poste` (
  `idPoste` int(11) NOT NULL,
  `Fonction` varchar(255) NOT NULL,
  `AdresseLieuTravail` varchar(100) NOT NULL,
  `Salaire` double NOT NULL,
  `Desc` varchar(100) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `poste`
--

INSERT INTO `poste` (`idPoste`, `Fonction`, `AdresseLieuTravail`, `Salaire`, `Desc`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'DEVELOPPEMENT WEB', 'Domicile', 8000, 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAaa', NULL, '2024-05-19 19:00:38', '2024-05-19 19:00:38');

-- --------------------------------------------------------

--
-- Structure de la table `promotion`
--

CREATE TABLE `promotion` (
  `idPromotion` int(11) NOT NULL,
  `DatePromo` date DEFAULT NULL,
  `NouveauPoste` int(11) NOT NULL,
  `EmployePromu` int(11) DEFAULT NULL,
  `Formation` int(11) DEFAULT NULL,
  `Evaluation` varchar(255) DEFAULT NULL,
  `commentaire` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `promotion`
--

INSERT INTO `promotion` (`idPromotion`, `DatePromo`, `NouveauPoste`, `EmployePromu`, `Formation`, `Evaluation`, `commentaire`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '2024-06-12', 1, NULL, 3, NULL, 'Nécessaire a tout Dev Web', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('9LZyBII0JOP5f8XOjWqTm1gdF1sQmmRrUR9bOKJf', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36 OPR/109.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQldtUkJ5TGxSejJhazY0Q3R0ekZubzlLRXBVTEtEdWRJUVlFTEN3OSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9TdGFnZS8xIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1717370730);

-- --------------------------------------------------------

--
-- Structure de la table `stage`
--

CREATE TABLE `stage` (
  `idStage` int(11) NOT NULL,
  `Type` int(11) NOT NULL,
  `Objectif` varchar(255) NOT NULL,
  `Desc` varchar(255) DEFAULT NULL,
  `idDepartement` int(11) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `stage`
--

INSERT INTO `stage` (`idStage`, `Type`, `Objectif`, `Desc`, `idDepartement`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Premier contact avec le domaine', 'Disponible avant fin août', 2, NULL, '2024-06-02 22:14:34', '2024-06-02 22:14:34');

-- --------------------------------------------------------

--
-- Structure de la table `stagecandidat`
--

CREATE TABLE `stagecandidat` (
  `idStageCandidat` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `Mail` varchar(255) NOT NULL,
  `Cv` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `stagiaire`
--

CREATE TABLE `stagiaire` (
  `idStagiaire` int(11) NOT NULL,
  `NomStagiaire` varchar(255) NOT NULL,
  `PrenomStagiaire` varchar(255) NOT NULL,
  `Mail` varchar(255) NOT NULL,
  `DebutStage` date NOT NULL,
  `FinStage` date NOT NULL,
  `idStage` int(11) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tache`
--

CREATE TABLE `tache` (
  `idTache` int(11) NOT NULL,
  `contenu` text NOT NULL,
  `idEmploye` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tache`
--

INSERT INTO `tache` (`idTache`, `contenu`, `idEmploye`) VALUES
(1, 'Préparer le site', 1);

-- --------------------------------------------------------

--
-- Structure de la table `typeconge`
--

CREATE TABLE `typeconge` (
  `idTypeConge` int(11) NOT NULL,
  `NomTypeConge` varchar(255) NOT NULL,
  `Desc` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `typeconge`
--

INSERT INTO `typeconge` (`idTypeConge`, `NomTypeConge`, `Desc`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Congé annuel', 'dfdfd', NULL, '2024-05-20 14:55:55', '2024-05-20 14:55:55'),
(2, 'Congé Paternité', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `typecontrat`
--

CREATE TABLE `typecontrat` (
  `idTypeContrat` int(11) NOT NULL,
  `NomTypeContrat` varchar(255) NOT NULL,
  `Desc` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `typestage`
--

CREATE TABLE `typestage` (
  `idTypeStage` int(11) NOT NULL,
  `NomTypeStage` varchar(255) NOT NULL,
  `Desc` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `typestage`
--

INSERT INTO `typestage` (`idTypeStage`, `NomTypeStage`, `Desc`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Stage d\'observation', NULL, NULL, '2024-06-02 22:13:36', '2024-06-02 22:13:36');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `annonce`
--
ALTER TABLE `annonce`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `candidat`
--
ALTER TABLE `candidat`
  ADD PRIMARY KEY (`idCandidat`);

--
-- Index pour la table `candidature`
--
ALTER TABLE `candidature`
  ADD PRIMARY KEY (`idCandidature`),
  ADD KEY `candidature_idoffreemploi_foreign` (`idOffreEmploi`),
  ADD KEY `candidature_idcandidat_foreign` (`idCandidat`);

--
-- Index pour la table `condition`
--
ALTER TABLE `condition`
  ADD PRIMARY KEY (`idCondition`);

--
-- Index pour la table `conge`
--
ALTER TABLE `conge`
  ADD PRIMARY KEY (`idConge`),
  ADD KEY `conge_typeconge_foreign` (`TypeConge`),
  ADD KEY `idEmploye` (`idEmploye`);

--
-- Index pour la table `contrat`
--
ALTER TABLE `contrat`
  ADD PRIMARY KEY (`idContrat`),
  ADD KEY `contrat_type_foreign` (`Type`),
  ADD KEY `contrat_employe_foreign` (`Employe`);

--
-- Index pour la table `demandeformation`
--
ALTER TABLE `demandeformation`
  ADD PRIMARY KEY (`idDemandeFormation`),
  ADD KEY `Employe` (`Employe`),
  ADD KEY `Formation` (`Formation`);

--
-- Index pour la table `demandepromotion`
--
ALTER TABLE `demandepromotion`
  ADD PRIMARY KEY (`idDemandePromotion`),
  ADD KEY `demandepromotion_employe_foreign` (`Employe`),
  ADD KEY `demandepromotion_promotion_foreign` (`Promotion`);

--
-- Index pour la table `demandestage`
--
ALTER TABLE `demandestage`
  ADD PRIMARY KEY (`idDemandeStage`),
  ADD KEY `demandestage_idstage_foreign` (`idStage`),
  ADD KEY `demandestage_idstagecandidat_foreign` (`idStageCandidat`);

--
-- Index pour la table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`idDepartement`);

--
-- Index pour la table `employe`
--
ALTER TABLE `employe`
  ADD PRIMARY KEY (`idEmploye`),
  ADD KEY `employe_iddepartement_foreign` (`idDepartement`),
  ADD KEY `employe_idposte_foreign` (`idPoste`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `formation`
--
ALTER TABLE `formation`
  ADD PRIMARY KEY (`idFormation`);

--
-- Index pour la table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Index pour la table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `login_table`
--
ALTER TABLE `login_table`
  ADD PRIMARY KEY (`idlogin_table`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idEmploye` (`idEmploye`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `offreemploi`
--
ALTER TABLE `offreemploi`
  ADD PRIMARY KEY (`idOffreEmploi`),
  ADD KEY `offreemploi_idtypecontrat_foreign` (`idTypeContrat`),
  ADD KEY `offreemploi_idposte_foreign` (`idPoste`),
  ADD KEY `offreemploi_iddepartement_foreign` (`idDepartement`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `poste`
--
ALTER TABLE `poste`
  ADD PRIMARY KEY (`idPoste`);

--
-- Index pour la table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`idPromotion`),
  ADD KEY `promotion_nouveauposte_foreign` (`NouveauPoste`),
  ADD KEY `promotion_employepromu_foreign` (`EmployePromu`),
  ADD KEY `promotion_formation_foreign` (`Formation`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Index pour la table `stage`
--
ALTER TABLE `stage`
  ADD PRIMARY KEY (`idStage`),
  ADD KEY `stage_iddepartement_foreign` (`idDepartement`),
  ADD KEY `stage_type_foreign` (`Type`);

--
-- Index pour la table `stagecandidat`
--
ALTER TABLE `stagecandidat`
  ADD PRIMARY KEY (`idStageCandidat`);

--
-- Index pour la table `stagiaire`
--
ALTER TABLE `stagiaire`
  ADD PRIMARY KEY (`idStagiaire`),
  ADD KEY `stagiaire_idstage_foreign` (`idStage`);

--
-- Index pour la table `tache`
--
ALTER TABLE `tache`
  ADD PRIMARY KEY (`idTache`),
  ADD KEY `idEmploye` (`idEmploye`);

--
-- Index pour la table `typeconge`
--
ALTER TABLE `typeconge`
  ADD PRIMARY KEY (`idTypeConge`);

--
-- Index pour la table `typecontrat`
--
ALTER TABLE `typecontrat`
  ADD PRIMARY KEY (`idTypeContrat`);

--
-- Index pour la table `typestage`
--
ALTER TABLE `typestage`
  ADD PRIMARY KEY (`idTypeStage`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `annonce`
--
ALTER TABLE `annonce`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `candidat`
--
ALTER TABLE `candidat`
  MODIFY `idCandidat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `candidature`
--
ALTER TABLE `candidature`
  MODIFY `idCandidature` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `condition`
--
ALTER TABLE `condition`
  MODIFY `idCondition` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `conge`
--
ALTER TABLE `conge`
  MODIFY `idConge` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `contrat`
--
ALTER TABLE `contrat`
  MODIFY `idContrat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `demandeformation`
--
ALTER TABLE `demandeformation`
  MODIFY `idDemandeFormation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `demandepromotion`
--
ALTER TABLE `demandepromotion`
  MODIFY `idDemandePromotion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `demandestage`
--
ALTER TABLE `demandestage`
  MODIFY `idDemandeStage` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `departement`
--
ALTER TABLE `departement`
  MODIFY `idDepartement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `employe`
--
ALTER TABLE `employe`
  MODIFY `idEmploye` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `formation`
--
ALTER TABLE `formation`
  MODIFY `idFormation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `offreemploi`
--
ALTER TABLE `offreemploi`
  MODIFY `idOffreEmploi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `poste`
--
ALTER TABLE `poste`
  MODIFY `idPoste` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `idPromotion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `stage`
--
ALTER TABLE `stage`
  MODIFY `idStage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `stagecandidat`
--
ALTER TABLE `stagecandidat`
  MODIFY `idStageCandidat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `stagiaire`
--
ALTER TABLE `stagiaire`
  MODIFY `idStagiaire` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tache`
--
ALTER TABLE `tache`
  MODIFY `idTache` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `typeconge`
--
ALTER TABLE `typeconge`
  MODIFY `idTypeConge` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `typecontrat`
--
ALTER TABLE `typecontrat`
  MODIFY `idTypeContrat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `typestage`
--
ALTER TABLE `typestage`
  MODIFY `idTypeStage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `candidature`
--
ALTER TABLE `candidature`
  ADD CONSTRAINT `candidature_idcandidat_foreign` FOREIGN KEY (`idCandidat`) REFERENCES `candidat` (`idCandidat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `candidature_idoffreemploi_foreign` FOREIGN KEY (`idOffreEmploi`) REFERENCES `offreemploi` (`idOffreEmploi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `conge`
--
ALTER TABLE `conge`
  ADD CONSTRAINT `conge_ibfk_1` FOREIGN KEY (`idEmploye`) REFERENCES `employe` (`idEmploye`) ON UPDATE CASCADE,
  ADD CONSTRAINT `conge_typeconge_foreign` FOREIGN KEY (`TypeConge`) REFERENCES `typeconge` (`idTypeConge`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `contrat`
--
ALTER TABLE `contrat`
  ADD CONSTRAINT `contrat_employe_foreign` FOREIGN KEY (`Employe`) REFERENCES `employe` (`idEmploye`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contrat_type_foreign` FOREIGN KEY (`Type`) REFERENCES `typecontrat` (`idTypeContrat`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `demandeformation`
--
ALTER TABLE `demandeformation`
  ADD CONSTRAINT `demandeformation_ibfk_1` FOREIGN KEY (`Formation`) REFERENCES `formation` (`idFormation`) ON UPDATE CASCADE,
  ADD CONSTRAINT `demandeformation_ibfk_2` FOREIGN KEY (`Employe`) REFERENCES `employe` (`idEmploye`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `demandepromotion`
--
ALTER TABLE `demandepromotion`
  ADD CONSTRAINT `demandepromotion_employe_foreign` FOREIGN KEY (`Employe`) REFERENCES `employe` (`idEmploye`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `demandepromotion_promotion_foreign` FOREIGN KEY (`Promotion`) REFERENCES `promotion` (`idPromotion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `demandestage`
--
ALTER TABLE `demandestage`
  ADD CONSTRAINT `demandestage_idstage_foreign` FOREIGN KEY (`idStage`) REFERENCES `stage` (`idStage`) ON UPDATE CASCADE,
  ADD CONSTRAINT `demandestage_idstagecandidat_foreign` FOREIGN KEY (`idStageCandidat`) REFERENCES `stagecandidat` (`idStageCandidat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `employe`
--
ALTER TABLE `employe`
  ADD CONSTRAINT `employe_iddepartement_foreign` FOREIGN KEY (`idDepartement`) REFERENCES `departement` (`idDepartement`) ON UPDATE CASCADE,
  ADD CONSTRAINT `employe_idposte_foreign` FOREIGN KEY (`idPoste`) REFERENCES `poste` (`idPoste`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `login_table`
--
ALTER TABLE `login_table`
  ADD CONSTRAINT `login_table_ibfk_1` FOREIGN KEY (`idEmploye`) REFERENCES `employe` (`idEmploye`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `offreemploi`
--
ALTER TABLE `offreemploi`
  ADD CONSTRAINT `offreemploi_iddepartement_foreign` FOREIGN KEY (`idDepartement`) REFERENCES `departement` (`idDepartement`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `offreemploi_idposte_foreign` FOREIGN KEY (`idPoste`) REFERENCES `poste` (`idPoste`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `offreemploi_idtypecontrat_foreign` FOREIGN KEY (`idTypeContrat`) REFERENCES `typecontrat` (`idTypeContrat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `promotion`
--
ALTER TABLE `promotion`
  ADD CONSTRAINT `promotion_employepromu_foreign` FOREIGN KEY (`EmployePromu`) REFERENCES `employe` (`idEmploye`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `promotion_formation_foreign` FOREIGN KEY (`Formation`) REFERENCES `formation` (`idFormation`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `promotion_nouveauposte_foreign` FOREIGN KEY (`NouveauPoste`) REFERENCES `poste` (`idPoste`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `stage`
--
ALTER TABLE `stage`
  ADD CONSTRAINT `stage_iddepartement_foreign` FOREIGN KEY (`idDepartement`) REFERENCES `departement` (`idDepartement`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stage_type_foreign` FOREIGN KEY (`Type`) REFERENCES `typestage` (`idTypeStage`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `stagiaire`
--
ALTER TABLE `stagiaire`
  ADD CONSTRAINT `stagiaire_idstage_foreign` FOREIGN KEY (`idStage`) REFERENCES `stage` (`idStage`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `tache`
--
ALTER TABLE `tache`
  ADD CONSTRAINT `tache_ibfk_1` FOREIGN KEY (`idEmploye`) REFERENCES `employe` (`idEmploye`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
