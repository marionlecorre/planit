-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:8889
-- Généré le :  Dim 28 Décembre 2014 à 00:15
-- Version du serveur :  5.5.38
-- Version de PHP :  5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `planit`
--

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

CREATE TABLE `event` (
`id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `begin_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `event`
--

INSERT INTO `event` (`id`, `name`, `slug`, `description`, `begin_date`, `end_date`, `user_id`, `image`) VALUES
(1, 'Anniversaire Florent', 'anniversaire-florent', '22 ans de Flo dans un bar chouette', '2014-11-22 19:00:00', '2014-12-22 23:30:00', 3, 'photo_evenement.jpg'),
(2, 'Mariage Aurélie', 'mariage-aurelie', 'Mariage de Ben et Aurélie à Lavaur et Marina en témoin avec une belle robe rose', '2015-09-19 13:00:00', '2015-09-20 19:00:00', 3, 'mariage.jpg'),
(3, 'Jour de l''an', 'jour-de-lan', 'Jour de l''an avec les potes à la maison', '2014-12-31 19:00:00', '2015-01-01 05:00:00', 1, 'nouvel-an.jpg'),
(4, 'Noël chez Mamie', 'noel-chez-mamie', 'Noël chez Mamie avec Misel', '2014-12-25 12:00:00', '2014-12-25 17:00:00', 2, 'noel.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `guest`
--

CREATE TABLE `guest` (
`id` int(11) NOT NULL,
  `firstname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `module_id` int(11) DEFAULT NULL,
  `confirmed` int(11) NOT NULL,
  `payed` int(11) NOT NULL,
  `sent` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `guest`
--

INSERT INTO `guest` (`id`, `firstname`, `lastname`, `slug`, `email`, `module_id`, `confirmed`, `payed`, `sent`) VALUES
(1, 'Warina', 'Avataneo', 'mavataneo', 'warina@grisou.com', 2, 2, 0, 0),
(2, 'Marion', 'LaMoche', 'mlamoche', 'marion@jackson.com', 2, 1, 0, 0),
(3, 'Ali', 'Babouche', 'ababouche', 'ali@kira.com', 2, 2, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`) VALUES
('20141219155432'),
('20141222222117'),
('20141223172251'),
('20141226113022'),
('20141226114309'),
('20141226115212'),
('20141226120434'),
('20141226121207'),
('20141227214918'),
('20141227221101'),
('20141227221246'),
('20141227221341'),
('20141227232151'),
('20141227232318'),
('20141227232942'),
('20141227233359');

-- --------------------------------------------------------

--
-- Structure de la table `module`
--

CREATE TABLE `module` (
`id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `list_type` int(11) DEFAULT NULL,
  `max_guests` int(11) DEFAULT NULL,
  `payable` tinyint(1) DEFAULT NULL,
  `max_time_to_go` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `int_type` int(11) NOT NULL,
  `max_budget` int(11) DEFAULT NULL,
  `max_capacity_p` int(11) DEFAULT NULL,
  `max_price_p` int(11) DEFAULT NULL,
  `max_capacity_t` int(11) DEFAULT NULL,
  `max_price_t` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `module`
--

INSERT INTO `module` (`id`, `name`, `slug`, `type`, `list_type`, `max_guests`, `payable`, `max_time_to_go`, `int_type`, `max_budget`, `max_capacity_p`, `max_price_p`, `max_capacity_t`, `max_price_t`, `event_id`) VALUES
(2, 'Gestion des invités', 'gestion-des-invites', 'guests', 1, 30, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, 1),
(3, 'Gestion du budget', 'gestion-du-budget', 'budget', NULL, NULL, NULL, NULL, 2, NULL, NULL, 100, NULL, NULL, 1),
(4, 'Invitations', 'invitations', 'guests', 1, 200, 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, 2),
(5, 'Lieu', 'lieu', 'place', NULL, NULL, NULL, '30 minutes', 3, NULL, 250, 3000, NULL, NULL, 2),
(6, 'Budget', 'budget', 'budget', NULL, NULL, NULL, NULL, 2, 15000, NULL, NULL, NULL, NULL, 2),
(7, 'A ne pas oublier', 'a-ne-pas-oublier', 'todo', NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, 2),
(8, 'Invitations', 'invitations', 'guests', 1, 30, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, 3),
(9, 'Todo', 'todo', 'todo', NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, 3),
(10, 'Budget', 'budget', 'budget', NULL, NULL, NULL, NULL, 2, 200, NULL, NULL, NULL, NULL, 4);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
`id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `mail` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `name`, `surname`, `mail`, `password`, `image`) VALUES
(1, 'Ali', 'Babouche', 'alibabouche@gmail.com', 'alibabouche', 'kira.jpg'),
(2, 'Marion', 'Le Cordula', 'marionlecordula@gmail.com', 'moche', 'jackson.jpg'),
(3, 'Warina', 'Avataneo', 'warina@gmail.com', 'warina', 'grisou.jpg');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `event`
--
ALTER TABLE `event`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_3BAE0AA7A76ED395` (`user_id`);

--
-- Index pour la table `guest`
--
ALTER TABLE `guest`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_6D76B531AFC2B591` (`module_id`);

--
-- Index pour la table `migration_versions`
--
ALTER TABLE `migration_versions`
 ADD PRIMARY KEY (`version`);

--
-- Index pour la table `module`
--
ALTER TABLE `module`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_C24262871F7E88B` (`event_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `event`
--
ALTER TABLE `event`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `guest`
--
ALTER TABLE `guest`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `module`
--
ALTER TABLE `module`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `event`
--
ALTER TABLE `event`
ADD CONSTRAINT `FK_3BAE0AA7A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `guest`
--
ALTER TABLE `guest`
ADD CONSTRAINT `FK_6D76B531AFC2B591` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`);

--
-- Contraintes pour la table `module`
--
ALTER TABLE `module`
ADD CONSTRAINT `FK_C24262871F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;