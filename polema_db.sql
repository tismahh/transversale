-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : lun. 09 juin 2025 à 09:54
-- Version du serveur : 8.0.30
-- Version de PHP : 8.2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `polema_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `bureau`
--

CREATE TABLE `bureau` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `bureau`
--

INSERT INTO `bureau` (`id`, `name`, `description`, `logo`) VALUES
(1, 'Bureau 1', 'test efzuif ezuiofgizefgzeiy\r\nygzfufgyez ef ez', '6845d8e09731f.png'),
(2, 'Bureau 2', 'ezuif yzriuf yeryi ferui', '6845d8e7c7606.png'),
(3, 'Bureau 3', 'eff ezf ez fez ez', '6845d909e5c52.png'),
(4, 'Burea44', 'fezezfefezfez', '6845d9127c5d4.png'),
(5, 'Burr 55', NULL, '6845d8c7100fe.png'),
(6, 'Burr6', 'ezfezfze', '6845f9c926824.jpg'),
(7, 'Burrr77', NULL, '6845f9d713180.png'),
(8, 'burrr88', NULL, NULL),
(9, 'Burr9', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `club`
--

CREATE TABLE `club` (
  `id` int NOT NULL,
  `bureau_id` int DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `club`
--

INSERT INTO `club` (`id`, `bureau_id`, `name`, `description`, `logo`) VALUES
(1, 1, 'CLUB Z', 'efuif yzeui ezfzeu f zfyuize yufi', '6845e241305dc.jpg'),
(2, 2, 'Club WWW', 'fud hezgezy', '6845e24a074cd.jpg'),
(3, 3, 'ttttttttttt', 'uiuiui', '6845e25765acc.jpg'),
(4, 3, 'zezerzerze', NULL, '6845e263dfb39.jpg'),
(5, 2, 'WWWWW', 'ezfzef', '6845e2743a881.jpg'),
(6, 3, 'yyyyyyyyzefezezf', 'ezfezez', '6845e2886cb63.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20250402134450', '2025-06-08 13:24:43', 26),
('DoctrineMigrations\\Version20250411130641', '2025-06-08 13:24:43', 543),
('DoctrineMigrations\\Version20250501132202', '2025-06-08 13:24:44', 33);

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

CREATE TABLE `event` (
  `id` int NOT NULL,
  `organizer_id` int NOT NULL,
  `bureau_id` int DEFAULT NULL,
  `club_id` int DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `capacity` int DEFAULT NULL,
  `interest_count` int DEFAULT NULL,
  `poster` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `event`
--

INSERT INTO `event` (`id`, `organizer_id`, `bureau_id`, `club_id`, `title`, `description`, `start_date`, `end_date`, `capacity`, `interest_count`, `poster`) VALUES
(1, 1, 2, 1, 'EVENT WW', 'zefdu hezfuze fzegez', '2025-06-21 21:47:00', '2025-06-21 23:47:00', 100, NULL, '6845fd8e42e9b.png'),
(2, 2, 3, 2, 'TEST EVENT', 'ezfui z eui ezy', '2026-01-01 10:00:00', '2026-01-01 12:00:00', 120, NULL, '6845fd9729fc2.png'),
(3, 2, 3, 4, 'ezffezfezez', 'efzezf', '2026-05-04 00:00:00', '2025-06-08 01:34:00', 500, NULL, '6845f2d7ce939.jpg'),
(4, 1, 4, 3, 'efzefz', 'fezfzef', '2025-06-22 02:21:00', '2025-06-27 03:21:00', 1000, NULL, '6845fdc0463b7.png');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `registration`
--

CREATE TABLE `registration` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `event_id` int NOT NULL,
  `nb_places` int DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `login`, `roles`, `password`) VALUES
(1, 'user11117@gmail.com', 'huhuhuhu', '[]', '0000000'),
(2, 'hello@gmail.co', 'user2', '[]', '4444444444');

-- --------------------------------------------------------

--
-- Structure de la table `user_bureau`
--

CREATE TABLE `user_bureau` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `bureau_id` int NOT NULL,
  `role_in_bureau` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user_bureau`
--

INSERT INTO `user_bureau` (`id`, `user_id`, `bureau_id`, `role_in_bureau`) VALUES
(1, 1, 3, NULL),
(2, 2, 3, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user_club`
--

CREATE TABLE `user_club` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `club_id` int NOT NULL,
  `role_in_club` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bureau`
--
ALTER TABLE `bureau`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B8EE387232516FE2` (`bureau_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3BAE0AA7876C4DDA` (`organizer_id`),
  ADD KEY `IDX_3BAE0AA732516FE2` (`bureau_id`),
  ADD KEY `IDX_3BAE0AA761190A32` (`club_id`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_62A8A7A7A76ED395` (`user_id`),
  ADD KEY `IDX_62A8A7A771F7E88B` (`event_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  ADD UNIQUE KEY `UNIQ_8D93D649AA08CB10` (`login`);

--
-- Index pour la table `user_bureau`
--
ALTER TABLE `user_bureau`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_733DC5F9A76ED395` (`user_id`),
  ADD KEY `IDX_733DC5F932516FE2` (`bureau_id`);

--
-- Index pour la table `user_club`
--
ALTER TABLE `user_club`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C26F74BBA76ED395` (`user_id`),
  ADD KEY `IDX_C26F74BB61190A32` (`club_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bureau`
--
ALTER TABLE `bureau`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `club`
--
ALTER TABLE `club`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `event`
--
ALTER TABLE `event`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `user_bureau`
--
ALTER TABLE `user_bureau`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `user_club`
--
ALTER TABLE `user_club`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `club`
--
ALTER TABLE `club`
  ADD CONSTRAINT `FK_B8EE387232516FE2` FOREIGN KEY (`bureau_id`) REFERENCES `bureau` (`id`);

--
-- Contraintes pour la table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `FK_3BAE0AA732516FE2` FOREIGN KEY (`bureau_id`) REFERENCES `bureau` (`id`),
  ADD CONSTRAINT `FK_3BAE0AA761190A32` FOREIGN KEY (`club_id`) REFERENCES `club` (`id`),
  ADD CONSTRAINT `FK_3BAE0AA7876C4DDA` FOREIGN KEY (`organizer_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `registration`
--
ALTER TABLE `registration`
  ADD CONSTRAINT `FK_62A8A7A771F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
  ADD CONSTRAINT `FK_62A8A7A7A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `user_bureau`
--
ALTER TABLE `user_bureau`
  ADD CONSTRAINT `FK_733DC5F932516FE2` FOREIGN KEY (`bureau_id`) REFERENCES `bureau` (`id`),
  ADD CONSTRAINT `FK_733DC5F9A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `user_club`
--
ALTER TABLE `user_club`
  ADD CONSTRAINT `FK_C26F74BB61190A32` FOREIGN KEY (`club_id`) REFERENCES `club` (`id`),
  ADD CONSTRAINT `FK_C26F74BBA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
