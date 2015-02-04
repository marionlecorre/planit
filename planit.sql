-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:8889
-- Généré le :  Mer 04 Février 2015 à 20:28
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `event`
--

INSERT INTO `event` (`id`, `user_id`, `name`, `slug`, `description`, `begin_date`, `end_date`, `image`) VALUES
(1, 1, 'Nouvel An', 'nouvelan', 'On va boire du champagne faire la fête et tout et tout', '2014-12-31 00:00:00', '2015-01-01 00:00:00', 'nouvel-an.jpg'),
(2, 2, 'Noël', 'noel', 'Petit papa noel quand tu descendras du ciel... tu m''amèneras un macbook Pro stp', '2014-12-24 00:00:00', '2014-12-25 00:00:00', 'noel.jpg'),
(3, 3, 'Anniversaire Florent', 'annivflorent', 'Hapyy birthday to youuu Diabeto <3 get on the flow', '2014-11-19 00:00:00', '2014-11-20 00:00:00', 'photo_evenement.jpg'),
(4, 3, 'Mariage d''Aurélie', 'mariageaurelie', 'Beau mariage à Lavaur avec Marina en demoiselle d''honneur en robe rose', '2015-04-16 00:00:00', '2015-04-17 00:00:00', 'mariage.jpg'),
(5, 3, 'Gala', 'Gala', 'Soirée de ouf sur une péniche', '2015-01-23 20:00:00', '2015-01-24 05:00:00', '3-5245.jpeg'),
(6, 1, 'Allez je fais du sport', 'Allez je fais du sport', 'pour ne plus être grosse', '2015-01-22 00:06:32', '2015-01-23 00:06:32', '1-62570.jpeg'),
(7, 1, 'Boire du café', 'Boire du café', 'Le café c''est la vie', '2015-02-12 00:00:00', '2015-02-13 00:00:00', '1-44121.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `guest`
--

CREATE TABLE `guest` (
`id` int(11) NOT NULL,
  `type_guest_id` int(11) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `firstname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `confirmed` int(11) NOT NULL,
  `payed` int(11) NOT NULL,
  `sent` tinyint(1) NOT NULL,
  `paymentmean_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `guest`
--

INSERT INTO `guest` (`id`, `type_guest_id`, `module_id`, `firstname`, `lastname`, `email`, `confirmed`, `payed`, `sent`, `paymentmean_id`) VALUES
(1, 1, 4, 'Alizée', 'Camaras', 'babouche@kira.com', 2, 0, 0, 2),
(2, 1, 4, 'Marion', 'Lecorredula', 'lamoche@jackson.com', 2, 0, 0, NULL),
(3, 1, 4, 'Marina', 'Avataneo', 'warina@grisou.com', 1, 0, 0, NULL),
(5, 2, 4, 'Test', 'test', 'test@g.com', 2, 0, 0, NULL),
(6, 1, 6, 'test', 'test', 'test@g.com', 0, 2, 0, 1),
(7, 1, 6, 'test', 'test', 'test@g.com', 0, 2, 0, 1),
(9, 6, 2, 'Audrey', 'Cougot', 'audreycougot@gmail.com', 2, 0, 0, NULL),
(10, 4, 7, 'test', 'test', 'test@g.com', 0, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

CREATE TABLE `item` (
`id` int(11) NOT NULL,
  `type_item_id` int(11) DEFAULT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `stock` double NOT NULL,
  `quantity` double NOT NULL,
  `consummate` double NOT NULL,
  `bought` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `item`
--

INSERT INTO `item` (`id`, `type_item_id`, `name`, `price`, `stock`, `quantity`, `consummate`, `bought`) VALUES
(1, 1, 'Coca Cola', 8.5, 0, 3, 0, 1),
(2, 1, 'Rhum', 14, 2, 4, 0, 0),
(3, 2, 'Cookies', 10, 0, 12, 0, 1),
(4, 2, 'Riz', 2, 3, 9, 0, 0),
(5, 1, 'Sprite', 3, 0, 10, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `listType` int(11) DEFAULT NULL,
  `max_guests` int(11) DEFAULT NULL,
  `payable` tinyint(1) DEFAULT NULL,
  `max_budget` int(11) DEFAULT NULL,
  `max_capacity_p` int(11) DEFAULT NULL,
  `max_price_p` int(11) DEFAULT NULL,
  `max_time_to_go` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `max_capacity_t` int(11) DEFAULT NULL,
  `max_price_t` int(11) DEFAULT NULL,
  `guestmodule_type` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `module`
--

INSERT INTO `module` (`id`, `event_id`, `name`, `slug`, `int_type`, `type`, `listType`, `max_guests`, `payable`, `max_budget`, `max_capacity_p`, `max_price_p`, `max_time_to_go`, `max_capacity_t`, `max_price_t`, `guestmodule_type`) VALUES
(2, 1, 'Invités', 'guests', 1, 'guests', NULL, 200, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(3, 2, 'TODO', 'todo', 2, 'todo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 3, 'Invités', 'guests', 1, 'guests', 2, 300, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(5, 4, 'invités', 'guests', 1, 'guests', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(6, 2, 'Invitations', 'invitations', 1, 'guests', 1, 300, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(7, 5, 'Invitations', 'invitations', 1, 'guests', 1, 200, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(8, 6, 'Budget', 'budget', 2, 'budget', NULL, NULL, NULL, 1000, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 6, 'Lieu', 'lieu', 3, 'place', NULL, NULL, NULL, NULL, 100, 600, '2', NULL, NULL, NULL),
(10, 6, 'Transport', 'transport', 4, 'transportation', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 60, 500, NULL),
(11, 6, 'TODO', 'todo', 5, 'todo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 5, 'Budget', 'budget', 2, 'budget', NULL, NULL, NULL, 2000, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `PaymentMeans`
--

CREATE TABLE `PaymentMeans` (
`id` int(11) NOT NULL,
  `label` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `PaymentMeans`
--

INSERT INTO `PaymentMeans` (`id`, `label`) VALUES
(1, 'CB'),
(2, 'Chèque'),
(3, 'Espèce'),
(4, 'Virement');

-- --------------------------------------------------------

--
-- Structure de la table `paymentmeans_module`
--

CREATE TABLE `paymentmeans_module` (
  `guestsmodule_id` int(11) NOT NULL,
  `paymentmeans_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `paymentmeans_module`
--

INSERT INTO `paymentmeans_module` (`guestsmodule_id`, `paymentmeans_id`) VALUES
(4, 2),
(4, 3);

-- --------------------------------------------------------

--
-- Structure de la table `TypeGuest`
--

CREATE TABLE `TypeGuest` (
`id` int(11) NOT NULL,
  `module_id` int(11) DEFAULT NULL,
  `label` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `message` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `TypeGuest`
--

INSERT INTO `TypeGuest` (`id`, `module_id`, `label`, `message`, `price`) VALUES
(1, 4, 'Amis IMAC', 'coucou mes amis imac', 20),
(2, 4, 'Amis SRC', 'coucou mes amis src', 30),
(3, 4, 'Famille', 'Coucou', 70),
(4, 7, 'Imac adhérents', 'Bonjour viens au gala', 26),
(5, 6, 'Famille', 'Coucou ma famille', 0),
(6, 2, 'Amis de Toulouse', 'bonne année !!!!', 3);

-- --------------------------------------------------------

--
-- Structure de la table `type_item`
--

CREATE TABLE `type_item` (
`id` int(11) NOT NULL,
  `module_id` int(11) DEFAULT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `type_item`
--

INSERT INTO `type_item` (`id`, `module_id`, `name`, `type`) VALUES
(1, 12, 'Boissons', 0),
(2, 12, 'Nourriture', 0),
(3, 12, 'Mamie', 1);

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
-- Index pour la table `guest`
--
ALTER TABLE `guest`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_ACB79A3557B581A4` (`type_guest_id`), ADD KEY `IDX_ACB79A35AFC2B591` (`module_id`), ADD KEY `IDX_ACB79A351594D248` (`paymentmean_id`);

--
-- Index pour la table `item`
--
ALTER TABLE `item`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_1F1B251E3A4E3DAB` (`type_item_id`);

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
-- Index pour la table `PaymentMeans`
--
ALTER TABLE `PaymentMeans`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `paymentmeans_module`
--
ALTER TABLE `paymentmeans_module`
 ADD PRIMARY KEY (`guestsmodule_id`,`paymentmeans_id`), ADD KEY `IDX_A4BA4E093A6610AA` (`guestsmodule_id`), ADD KEY `IDX_A4BA4E099F63E055` (`paymentmeans_id`);

--
-- Index pour la table `TypeGuest`
--
ALTER TABLE `TypeGuest`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_65AD8281AFC2B591` (`module_id`);

--
-- Index pour la table `type_item`
--
ALTER TABLE `type_item`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_C814E016AFC2B591` (`module_id`);

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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `guest`
--
ALTER TABLE `guest`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `item`
--
ALTER TABLE `item`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `module`
--
ALTER TABLE `module`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `PaymentMeans`
--
ALTER TABLE `PaymentMeans`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `TypeGuest`
--
ALTER TABLE `TypeGuest`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `type_item`
--
ALTER TABLE `type_item`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
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
ADD CONSTRAINT `FK_6D76B5311594D248` FOREIGN KEY (`paymentmean_id`) REFERENCES `PaymentMeans` (`id`),
ADD CONSTRAINT `FK_6D76B53157B581A4` FOREIGN KEY (`type_guest_id`) REFERENCES `TypeGuest` (`id`),
ADD CONSTRAINT `FK_6D76B531AFC2B591` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`);

--
-- Contraintes pour la table `item`
--
ALTER TABLE `item`
ADD CONSTRAINT `FK_1F1B251E3A4E3DAB` FOREIGN KEY (`type_item_id`) REFERENCES `type_item` (`id`);

--
-- Contraintes pour la table `module`
--
ALTER TABLE `module`
ADD CONSTRAINT `FK_C24262871F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`);

--
-- Contraintes pour la table `paymentmeans_module`
--
ALTER TABLE `paymentmeans_module`
ADD CONSTRAINT `FK_A4BA4E093A6610AA` FOREIGN KEY (`guestsmodule_id`) REFERENCES `module` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `FK_A4BA4E099F63E055` FOREIGN KEY (`paymentmeans_id`) REFERENCES `PaymentMeans` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `TypeGuest`
--
ALTER TABLE `TypeGuest`
ADD CONSTRAINT `FK_65AD8281AFC2B591` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`);

--
-- Contraintes pour la table `type_item`
--
ALTER TABLE `type_item`
ADD CONSTRAINT `FK_C814E016AFC2B591` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
