-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:8889
-- Généré le :  Mar 30 Décembre 2014 à 12:04
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
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `begin_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `event`
--

INSERT INTO `event` (`id`, `user_id`, `name`, `slug`, `description`, `begin_date`, `end_date`, `image`) VALUES
(1, 1, 'Nouvel An', 'nouvelan', 'On va boire du champagne faire la fête et tout et tout', '2014-12-31 00:00:00', '2015-01-01 00:00:00', 'nouvel-an.jpg'),
(2, 2, 'Noël', 'noel', 'Petit papa noel quand tu descendras du ciel... tu m''amèneras un macbook Pro stp', '2014-12-24 00:00:00', '2014-12-25 00:00:00', 'noel.jpg'),
(3, 3, 'Anniversaire Florent', 'annivflorent', 'Hapyy birthday to youuu Diabeto <3 get on the flow', '2014-11-19 00:00:00', '2014-11-20 00:00:00', 'photo_evenement.jpg'),
(4, 3, 'Mariage d''Aurélie', 'mariageaurelie', 'Beau mariage à Lavaur avec Marina en demoiselle d''honneur en robe rose', '2015-04-16 00:00:00', '2015-04-17 00:00:00', 'mariage.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `Guest`
--

CREATE TABLE `Guest` (
`id` int(11) NOT NULL,
  `type_guest_id` int(11) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `firstname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `confirmed` int(11) NOT NULL,
  `payed` int(11) NOT NULL,
  `sent` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Guest`
--

INSERT INTO `Guest` (`id`, `type_guest_id`, `module_id`, `firstname`, `lastname`, `email`, `confirmed`, `payed`, `sent`) VALUES
(1, 1, 4, 'Alizée', 'Camarasa', 'babouche@kira.com', 1, 1, 1),
(2, 1, 4, 'Marion', 'Lecorredula', 'lamoche@jackson.com', 2, 0, 0),
(3, 1, 4, 'Marina', 'Avataneo', 'warina@grisou.com', 1, 0, 0),
(4, 2, 4, 'Bill', 'Boquet', 'bill@pasdechat.com', 1, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `module`
--

CREATE TABLE `module` (
`id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `int_type` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `list_type` int(11) DEFAULT NULL,
  `max_guests` int(11) DEFAULT NULL,
  `payable` tinyint(1) DEFAULT NULL,
  `max_budget` int(11) DEFAULT NULL,
  `max_capacity_p` int(11) DEFAULT NULL,
  `max_price_p` int(11) DEFAULT NULL,
  `max_time_to_go` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `max_capacity_t` int(11) DEFAULT NULL,
  `max_price_t` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `module`
--

INSERT INTO `module` (`id`, `event_id`, `name`, `slug`, `int_type`, `type`, `list_type`, `max_guests`, `payable`, `max_budget`, `max_capacity_p`, `max_price_p`, `max_time_to_go`, `max_capacity_t`, `max_price_t`) VALUES
(2, 1, 'Invités', 'guests', 1, 'guests', NULL, 200, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 2, 'TODO', 'todo', 2, 'todo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 3, 'Invités', 'guests', 1, 'guests', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 4, 'invités', 'guests', 1, 'guests', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `TypeGuest`
--

CREATE TABLE `TypeGuest` (
`id` int(11) NOT NULL,
  `module_id` int(11) DEFAULT NULL,
  `label` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `message` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `TypeGuest`
--

INSERT INTO `TypeGuest` (`id`, `module_id`, `label`, `slug`, `message`, `price`) VALUES
(1, 4, 'Amis IMAC', 'imac', 'coucou mes amis imac', 20),
(2, 4, 'Amis SRC', 'src', 'coucou mes amis src', 30);

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
(1, 'Babouche', 'Ali', 'alizee.camarasa@gmail.com', '28012904', 'kira.jpg'),
(2, 'LeCorre', 'Marion', 'marion@lecorre.com', '0000', 'jackson.jpg'),
(3, 'Avataneo', 'Warina', 'marina@avtaneo.com', '0000', 'grisou.jpg');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `event`
--
ALTER TABLE `event`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_3BAE0AA7A76ED395` (`user_id`);

--
-- Index pour la table `Guest`
--
ALTER TABLE `Guest`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_6D76B53157B581A4` (`type_guest_id`), ADD KEY `IDX_6D76B531AFC2B591` (`module_id`);

--
-- Index pour la table `module`
--
ALTER TABLE `module`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_C24262871F7E88B` (`event_id`);

--
-- Index pour la table `TypeGuest`
--
ALTER TABLE `TypeGuest`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_65AD8281AFC2B591` (`module_id`);

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
-- AUTO_INCREMENT pour la table `Guest`
--
ALTER TABLE `Guest`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `module`
--
ALTER TABLE `module`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `TypeGuest`
--
ALTER TABLE `TypeGuest`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
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
-- Contraintes pour la table `Guest`
--
ALTER TABLE `Guest`
ADD CONSTRAINT `FK_6D76B531AFC2B591` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`),
ADD CONSTRAINT `FK_6D76B53157B581A4` FOREIGN KEY (`type_guest_id`) REFERENCES `TypeGuest` (`id`);

--
-- Contraintes pour la table `module`
--
ALTER TABLE `module`
ADD CONSTRAINT `FK_C24262871F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`);

--
-- Contraintes pour la table `TypeGuest`
--
ALTER TABLE `TypeGuest`
ADD CONSTRAINT `FK_65AD8281AFC2B591` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
