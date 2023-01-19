-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 19 jan. 2023 à 14:53
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `session_formations`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie_module`
--

CREATE TABLE `categorie_module` (
  `id` int(11) NOT NULL,
  `intitule_categorie` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie_module`
--

INSERT INTO `categorie_module` (`id`, `intitule_categorie`) VALUES
(1, 'bureautique'),
(2, 'dev web');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230103104923', '2023-01-03 11:49:41', 2109);

-- --------------------------------------------------------

--
-- Structure de la table `formateur`
--

CREATE TABLE `formateur` (
  `id` int(11) NOT NULL,
  `nom_formateur` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom_formateur` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_formateur` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone_formateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `formateur`
--

INSERT INTO `formateur` (`id`, `nom_formateur`, `prenom_formateur`, `mail_formateur`, `telephone_formateur`) VALUES
(1, 'MURMAAN', 'Mickael', 'mickael@elan.fr', 511544529),
(4, 'bechri', 'mohamed', 'mohamed@hotmail.fr', 545000000),
(5, 'bechri', 'Boulbaba', 'boulbaba@formation.fr', 625252500);

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

CREATE TABLE `formation` (
  `id` int(11) NOT NULL,
  `intitule_formation` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `formation`
--

INSERT INTO `formation` (`id`, `intitule_formation`) VALUES
(2, 'Developement des applications mobile'),
(4, 'developpeur React JS'),
(5, 'PHP Symfony');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `module_session`
--

CREATE TABLE `module_session` (
  `id` int(11) NOT NULL,
  `intitule_module` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categorie_module_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `module_session`
--

INSERT INTO `module_session` (`id`, `intitule_module`, `categorie_module_id`) VALUES
(1, 'HTML', 2),
(2, 'CSS', 2),
(3, 'PHP', 2),
(4, 'Word', 1),
(5, 'React js', 2);

-- --------------------------------------------------------

--
-- Structure de la table `programme`
--

CREATE TABLE `programme` (
  `id` int(11) NOT NULL,
  `duree` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
  `module_session_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `programme`
--

INSERT INTO `programme` (`id`, `duree`, `session_id`, `module_session_id`) VALUES
(1, 2, NULL, 1),
(4, 1, NULL, 4),
(5, 15, NULL, 3),
(9, 10, NULL, 1),
(10, 3, NULL, 4),
(11, 1, NULL, 4),
(12, 0, NULL, 4),
(15, 1, NULL, 2),
(16, 3, 2, 4),
(19, 2, 6, 1),
(20, 2, 6, 2),
(21, 10, 6, 3),
(22, 10, 6, 5);

-- --------------------------------------------------------

--
-- Structure de la table `session`
--

CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `intitule_session` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_place` int(11) NOT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  `formation_id` int(11) NOT NULL,
  `formateur_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `session`
--

INSERT INTO `session` (`id`, `intitule_session`, `nombre_place`, `date_debut`, `date_fin`, `formation_id`, `formateur_id`) VALUES
(2, 'session mars 2023', 10, '2023-03-05 00:00:00', '2023-06-25 00:00:00', 2, 1),
(6, 'janvier', 3, '2023-01-02 00:00:00', '2023-02-03 00:00:00', 4, 4);

-- --------------------------------------------------------

--
-- Structure de la table `session_stagiaire`
--

CREATE TABLE `session_stagiaire` (
  `session_id` int(11) NOT NULL,
  `stagiaire_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `session_stagiaire`
--

INSERT INTO `session_stagiaire` (`session_id`, `stagiaire_id`) VALUES
(2, 2),
(6, 1),
(6, 2),
(6, 6);

-- --------------------------------------------------------

--
-- Structure de la table `stagiaire`
--

CREATE TABLE `stagiaire` (
  `id` int(11) NOT NULL,
  `nom_stagiaire` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom_stagiaire` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance_stagiaire` datetime NOT NULL,
  `sexe_stagiaire` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville_stagiaire` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cp_stagiaire` int(11) NOT NULL,
  `adresse_stagiaire` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_stagiaire` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone_stagiaire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `stagiaire`
--

INSERT INTO `stagiaire` (`id`, `nom_stagiaire`, `prenom_stagiaire`, `date_naissance_stagiaire`, `sexe_stagiaire`, `ville_stagiaire`, `cp_stagiaire`, `adresse_stagiaire`, `mail_stagiaire`, `telephone_stagiaire`) VALUES
(1, 'Mbappe', 'Kylian', '1998-12-22 12:52:04', 'homme', 'Paris', 93000, '9 rue de la foret', 'mbappePSG@elan.fr', 7894563),
(2, 'cristiano', 'ronaldo', '1985-02-05 12:51:28', 'homme', 'Madera', 9000, 'Madera', 'ronaldo@elan.fr', 6568947),
(6, 'Ben romdhan', 'mohamed ali', '1997-10-01 12:00:00', 'homme', 'tunis', 684455, 'rue tunis', 'daliEST@elan.fr', 225645656),
(7, 'Smith', 'Will', '1981-01-19 13:51:00', 'homme', 'Floride', 0, 'USA', 'Smith@formation.fr', 789995502);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie_module`
--
ALTER TABLE `categorie_module`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `formateur`
--
ALTER TABLE `formateur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `formation`
--
ALTER TABLE `formation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `module_session`
--
ALTER TABLE `module_session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7B3FEBCD29DBA96` (`categorie_module_id`);

--
-- Index pour la table `programme`
--
ALTER TABLE `programme`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3DDCB9FF613FECDF` (`session_id`),
  ADD KEY `IDX_3DDCB9FFF4DAC742` (`module_session_id`);

--
-- Index pour la table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D044D5D45200282E` (`formation_id`),
  ADD KEY `IDX_D044D5D4155D8F51` (`formateur_id`);

--
-- Index pour la table `session_stagiaire`
--
ALTER TABLE `session_stagiaire`
  ADD PRIMARY KEY (`session_id`,`stagiaire_id`),
  ADD KEY `IDX_C80B23B613FECDF` (`session_id`),
  ADD KEY `IDX_C80B23BBBA93DD6` (`stagiaire_id`);

--
-- Index pour la table `stagiaire`
--
ALTER TABLE `stagiaire`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie_module`
--
ALTER TABLE `categorie_module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `formateur`
--
ALTER TABLE `formateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `formation`
--
ALTER TABLE `formation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `module_session`
--
ALTER TABLE `module_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `programme`
--
ALTER TABLE `programme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `stagiaire`
--
ALTER TABLE `stagiaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `module_session`
--
ALTER TABLE `module_session`
  ADD CONSTRAINT `FK_7B3FEBCD29DBA96` FOREIGN KEY (`categorie_module_id`) REFERENCES `categorie_module` (`id`);

--
-- Contraintes pour la table `programme`
--
ALTER TABLE `programme`
  ADD CONSTRAINT `FK_3DDCB9FF613FECDF` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`),
  ADD CONSTRAINT `FK_3DDCB9FFF4DAC742` FOREIGN KEY (`module_session_id`) REFERENCES `module_session` (`id`);

--
-- Contraintes pour la table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `FK_D044D5D4155D8F51` FOREIGN KEY (`formateur_id`) REFERENCES `formateur` (`id`),
  ADD CONSTRAINT `FK_D044D5D45200282E` FOREIGN KEY (`formation_id`) REFERENCES `formation` (`id`);

--
-- Contraintes pour la table `session_stagiaire`
--
ALTER TABLE `session_stagiaire`
  ADD CONSTRAINT `FK_C80B23B613FECDF` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_C80B23BBBA93DD6` FOREIGN KEY (`stagiaire_id`) REFERENCES `stagiaire` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
