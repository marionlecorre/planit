-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:8889
-- Généré le :  Dim 22 Mars 2015 à 15:51
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
  `beginDate` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `event`
--

INSERT INTO `event` (`id`, `user_id`, `name`, `slug`, `description`, `beginDate`, `end_date`, `image`) VALUES
(1, 1, 'Nouvel An', 'nouvelan', 'On va boire du champagne faire la fête et tout et tout', '2014-12-31 00:00:00', '2015-01-01 00:00:00', 'nouvel-an.jpg'),
(2, 2, 'Noël', 'noel', 'Petit papa noel quand tu descendras du ciel... tu m''amèneras un macbook Pro stp', '2014-12-24 00:00:00', '2014-12-25 00:00:00', 'noel.jpg'),
(3, 3, 'Anniversaire Florent', 'annivflorent', 'Hapyy birthday to youuu Diabeto <3 get on the flow', '2014-11-20 00:00:00', '2014-11-21 00:00:00', 'photo_evenement.jpg'),
(4, 3, 'Mariage d''Aurélie', 'mariageaurelie', 'Beau mariage à Lavaur avec Marina en demoiselle d''honneur en robe rose', '2015-04-16 00:00:00', '2015-04-17 00:00:00', 'mariage.jpg'),
(5, 3, 'Gala', 'Gala', 'Soirée de ouf sur une péniche', '2015-01-23 20:00:00', '2015-01-24 05:00:00', '3-5245.jpeg'),
(6, 1, 'Allez je fais du sport', 'Allez je fais du sport', 'pour ne plus être grosse', '2015-01-22 00:06:32', '2015-01-23 00:06:32', '1-62570.jpeg'),
(7, 1, 'Boire du café', 'Boire du café', 'Le café c''est la vie', '2015-02-12 00:00:00', '2015-02-13 00:00:00', '1-44121.jpeg'),
(11, 4, 'Emy''s Birthday', 'Emy''s Birthday', 'Emy''s Birthday at home', '2015-03-24 00:00:00', '2015-03-24 00:00:00', '4-69131.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `expense`
--

CREATE TABLE `expense` (
`id` int(11) NOT NULL,
  `type_expense_id` int(11) DEFAULT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `unit` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `stock` double NOT NULL,
  `quantity` double NOT NULL,
  `consummate` double NOT NULL,
  `bought` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `expense`
--

INSERT INTO `expense` (`id`, `type_expense_id`, `name`, `unit`, `price`, `stock`, `quantity`, `consummate`, `bought`) VALUES
(1, 1, 'Vodka', 'Bouteilles', 10, 5, 22, 4, 1),
(2, 2, 'Paté', 'Grammes', 0.2, 0, 500, 0, 0),
(4, 4, 'Coca Cola', 'Bottles', 0.8, 0, 7, 0, 0),
(5, 4, 'Orange Juice', 'Bottles', 0.47, 2, 6, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `fos_user`
--

CREATE TABLE `fos_user` (
`id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `firstname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `firstname`, `lastname`, `image`) VALUES
(1, 'ali@babouche.com', 'ali@babouche.com', 'ali@babouche.com', 'ali@babouche.com', 1, 'oyvqd85j4m8g0ow88cskcwk0ckwg4cw', '4AJaIdlK30DFn6P5gISgkbd03TDkk6o1NJ32wmxpuUeOSfUCcfOzKKIZIGeZUkKVXXIB01d7URf/MnZfUV9PGw==', '2015-03-20 17:40:39', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'Ali', 'Babouche', 'kira.jpg'),
(2, 'marion@lecorre.com', 'marion@lecorre.com', 'marion@lecorre.com', 'marion@lecorre.com', 1, 'g72sh8mwndkcs0oc0ck8w48c8k4owsg', 'rZVtk8CZf0Jf0BefC05xp3YflEwE4mqvKC3iURh6OKhO0lWgUT5sw7iivsgOKdxMS6W9WAtHaPBvzz6c4QJi7w==', '2015-03-22 15:42:59', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'Marion', 'Le Corre', 'jackson.jpg'),
(3, 'mariona@avataneo.com', 'mariona@avataneo.com', 'mariona@avataneo.com', 'mariona@avataneo.com', 1, 'km6c7pgv0tck88sog4wwks4wkog08ck', 'dRn7g5Ib9VNvJGBpgfEorH9lzsx+IaVbp3Y4BM6T0LLgZwFNCd+RpElIbF2/t5xWqgGojQ1ntav0XF0PdivVdQ==', '2015-03-20 17:43:09', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'Marina', 'Avataneo', 'grisou.jpg'),
(4, 'john@doe.com', 'john@doe.com', 'john@doe.com', 'john@doe.com', 1, 'ehyny1y64lk480sog80w0s0kwggwooo', 'WwWYjH+uHYeSsieSRSVhYZkbrVCSIWWsCiUyqv+rt8617zOhH9zD8eF8GPs3JUtEF9u8oCo1cAtPmoigXxNVXg==', '2015-03-20 17:44:32', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'John', 'Doe', 'image-profil.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `guest`
--

CREATE TABLE `guest` (
`id` int(11) NOT NULL,
  `type_guest_id` int(11) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `paymentmean_id` int(11) DEFAULT NULL,
  `firstname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `confirmed` int(11) NOT NULL,
  `payed` int(11) NOT NULL,
  `sent` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `guest`
--

INSERT INTO `guest` (`id`, `type_guest_id`, `module_id`, `paymentmean_id`, `firstname`, `lastname`, `email`, `confirmed`, `payed`, `sent`) VALUES
(6, 1, 6, 1, 'test', 'test', 'test@g.com', 0, 2, 0),
(7, 1, 6, 1, 'test', 'test', 'test@g.com', 0, 2, 0),
(9, 6, 2, NULL, 'Audrey', 'Cougot', 'audreycougot@gmail.com', 1, 1, 0),
(11, 1, 4, NULL, 'Ali', 'Babouche', 'alibabouche@gmail.com', 1, 0, 0),
(12, 1, 4, NULL, 'Marina', 'Avataneo', 'avataneo.marina@orange.fr', 1, 0, 0),
(13, 1, 4, NULL, 'Marion', 'Le Corre', 'marionlecorre@live.fr', 1, 1, 0),
(23, 9, 22, 2, 'Misel', 'Le Correffg', 'lecorre.mar@gmail.com', 1, 0, 1),
(24, 9, 22, NULL, 'Marion', 'Le Corre', 'marionlecorre@live.fr', 0, 0, 1),
(25, 12, 30, NULL, 'Clara', 'Hood', 'clarahood@gmail.com', 0, 0, 0),
(26, 12, 30, NULL, 'Luc', 'Skywalker', 'luc@gmail.com', 0, 0, 0),
(28, 3, 4, NULL, 'test', 'test', 'test@gmail.com', 1, 0, 1),
(29, 1, 4, NULL, 'Hugo', 'Garrido', 'hugo@gmail.com', 1, 0, 1),
(30, 9, 22, 2, 'Hugo', 'Garrido', 'lecorre.mar@gmail.com', 1, 0, 1),
(31, 8, 4, NULL, 'test', 'test', 'test@gmail.com', 1, 0, 1),
(33, 9, 22, NULL, 'test', 'test', 'marionlecorre@gmail.com', 2, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `inflow`
--

CREATE TABLE `inflow` (
`id` int(11) NOT NULL,
  `module_id` int(11) DEFAULT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `inflow`
--

INSERT INTO `inflow` (`id`, `module_id`, `name`, `amount`) VALUES
(1, 12, 'Mamie', 1000),
(2, 12, 'Maman robe', 500),
(3, 34, 'Donation for gift', 200),
(4, 8, 'test', 78),
(5, 8, 'test', 78);

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

CREATE TABLE `item` (
`id` int(11) NOT NULL,
  `list_id` int(11) DEFAULT NULL,
  `content` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `checked` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `item`
--

INSERT INTO `item` (`id`, `list_id`, `content`, `checked`) VALUES
(1, 1, 'Se faire beaux', 0),
(8, 1, 'Appeler méméee', 0);

-- --------------------------------------------------------

--
-- Structure de la table `module`
--

CREATE TABLE `module` (
`id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `inttype` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `maxguests` int(11) DEFAULT NULL,
  `payable` tinyint(1) DEFAULT NULL,
  `moduletype` tinyint(1) DEFAULT NULL,
  `max_budget` int(11) DEFAULT NULL,
  `base` int(11) DEFAULT NULL,
  `max_capacity_p` int(11) DEFAULT NULL,
  `max_price_p` int(11) DEFAULT NULL,
  `max_time_to_go` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `max_capacity_t` int(11) DEFAULT NULL,
  `max_price_t` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `module`
--

INSERT INTO `module` (`id`, `event_id`, `name`, `slug`, `inttype`, `type`, `maxguests`, `payable`, `moduletype`, `max_budget`, `base`, `max_capacity_p`, `max_price_p`, `max_time_to_go`, `max_capacity_t`, `max_price_t`) VALUES
(2, 1, 'Gestion des invités', 'gestion-des-invites', 1, 'guests', 200, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 2, 'Listes de tâches', 'listes-de-taches', 2, 'todo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 3, 'Gestion des invités', 'gestion-des-invites', 1, 'guests', 140, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 4, 'Gestion des invités', 'gestion-des-invites', 1, 'guests', 100, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 2, 'Gestion des invités', 'gestion-des-invites', 1, 'guests', 50, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 6, 'Gestion du budget', 'gestion-du-budget', 2, 'budget', NULL, NULL, NULL, 1000, 300, NULL, NULL, NULL, NULL, NULL),
(9, 6, 'Gestion du lieu', 'gestion-du-lieu', 3, 'place', NULL, NULL, NULL, NULL, NULL, 100, 600, '2', NULL, NULL),
(10, 6, 'Gestion du transport', 'gestion-du-transport', 4, 'transportation', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 60, 500),
(11, 6, 'Listes de tâches', 'listes-de-taches', 5, 'todo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 5, 'Gestion du budget', 'gestion-du-budget', 2, 'budget', NULL, NULL, NULL, 2000, 400, NULL, NULL, NULL, NULL, NULL),
(13, 3, 'Listes de tâches', 'listes-de-taches', 5, 'todo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 3, 'Gestion du lieu', 'gestion-du-lieu', 3, 'place', NULL, NULL, NULL, NULL, NULL, 400, 4000, '1h30', NULL, NULL),
(22, 5, 'Gestion des invités', 'gestion-des-invites', 1, 'guests', 140, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 11, 'Gestion des invités', 'gestion-des-invites', 1, 'guests', 30, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 11, 'Gestion du budget', 'gestion-du-budget', 2, 'budget', NULL, NULL, NULL, 300, 100, NULL, NULL, NULL, NULL, NULL),
(36, 11, 'Listes de tâches', 'listes-de-taches', 5, 'todo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 3, 'Gestion du budget', 'gestion-du-budget', 2, 'budget', NULL, NULL, NULL, 1200, 300, NULL, NULL, NULL, NULL, NULL),
(39, 3, 'Gestion du transport', 'gestion-du-transport', 4, 'transportation', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 70, 1000),
(44, 1, 'Gestion du transport', 'gestion-du-transport', 4, 'transportation', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 555, 55),
(45, 1, 'Gestion du budget', 'gestion-du-budget', 2, 'budget', NULL, NULL, NULL, 20000, 50, NULL, NULL, NULL, NULL, NULL),
(50, 7, 'Gestion du budget', 'gestion-du-budget', 2, 'budget', NULL, NULL, NULL, 85, 866, NULL, NULL, NULL, NULL, NULL);

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
(4, 3),
(4, 4),
(22, 2),
(30, 2);

-- --------------------------------------------------------

--
-- Structure de la table `payment_means`
--

CREATE TABLE `payment_means` (
`id` int(11) NOT NULL,
  `label` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `payment_means`
--

INSERT INTO `payment_means` (`id`, `label`) VALUES
(1, 'CB'),
(2, 'Chèque'),
(3, 'Espèce'),
(4, 'Virement');

-- --------------------------------------------------------

--
-- Structure de la table `place`
--

CREATE TABLE `place` (
`id` int(11) NOT NULL,
  `module_id` int(11) DEFAULT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8_unicode_ci,
  `tel` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `distance` double DEFAULT NULL,
  `price` double DEFAULT NULL,
  `capacity` double DEFAULT NULL,
  `website` longtext COLLATE utf8_unicode_ci,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `remark` longtext COLLATE utf8_unicode_ci,
  `image` longtext COLLATE utf8_unicode_ci,
  `contract` longtext COLLATE utf8_unicode_ci,
  `state` int(11) NOT NULL,
  `oldstate` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `place`
--

INSERT INTO `place` (`id`, `module_id`, `name`, `address`, `tel`, `distance`, `price`, `capacity`, `website`, `latitude`, `longitude`, `remark`, `image`, `contract`, `state`, `oldstate`) VALUES
(2, 14, 'Car en bolage', '55 rue du culotte', '023478946738', 135, 2000, 100, 'www.carenbolage.fr', NULL, NULL, 'Mouais', '2-71053.jpeg', '2-11124.jpeg', 3, 0),
(3, 14, 'MFR Vertus', '33 rue du trone 94560 Hugres', '098765432123', 34, 3200, 200, 'www.mfrvertus.fr', NULL, NULL, 'Chouette', '3-16081.jpeg', '3-59506.jpeg', 1, 0),
(4, 14, 'La maison de Jackie', '45 avenue du cheval 89760 lol', '0874563782', 45, 4000, 250, NULL, NULL, NULL, 'Ils sont gentils', NULL, '4-19154.jpeg', 2, 2),
(5, 14, 'Test', '65 rue du paradis', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL),
(19, 9, 'te,dtt', 'nfkkdl', '', 0, 0, 0, '', 0, 0, '', '-87540.jpeg', NULL, 3, NULL),
(20, 9, 'test', 'cdsfqsfsdfsdfdsq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-90645.jpeg', NULL, 3, NULL),
(21, 9, 'Lac du Connemara', 'Compté de Galway Irlande', '089562358', 1277, 566, 6555, 'www.sardou.com', NULL, NULL, 'Terre brûlée au vent , Des landes de pierre, Autour des lacs, C''est pour les vivants Un peu d''enfer, Le Connemara. Des nuages noirs , Qui viennent du nord Colorent la terre, Les lacs, les rivières : C''est le décor Du Connemara.', '21-86125.jpeg', '21-17886.jpeg', 1, 0),
(25, 9, 'ghjb', 'ghj', '', 0, 0, 0, '', 0, 0, '', '-8971.jpeg', NULL, 3, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `task_list`
--

CREATE TABLE `task_list` (
`id` int(11) NOT NULL,
  `module_id` int(11) DEFAULT NULL,
  `name` tinytext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `task_list`
--

INSERT INTO `task_list` (`id`, `module_id`, `name`) VALUES
(1, 13, 'A faire avant'),
(3, 11, 'Todo'),
(4, 11, 'Doing'),
(5, 11, 'done');

-- --------------------------------------------------------

--
-- Structure de la table `transportation`
--

CREATE TABLE `transportation` (
`id` int(11) NOT NULL,
  `module_id` int(11) DEFAULT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` double DEFAULT NULL,
  `capacity` double DEFAULT NULL,
  `website` longtext COLLATE utf8_unicode_ci,
  `remark` longtext COLLATE utf8_unicode_ci,
  `image` longtext COLLATE utf8_unicode_ci,
  `contract` longtext COLLATE utf8_unicode_ci,
  `state` int(11) NOT NULL,
  `oldstate` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `transportation`
--

INSERT INTO `transportation` (`id`, `module_id`, `name`, `tel`, `price`, `capacity`, `website`, `remark`, `image`, `contract`, `state`, `oldstate`) VALUES
(3, 39, 'Car ki roule', NULL, 500, 500, NULL, NULL, '3-3354.jpeg', '3-63686.pdf', 1, 3),
(8, 39, 'Car ki roule', NULL, 300, NULL, NULL, NULL, NULL, NULL, 3, 2),
(9, 39, 'Car en bolage', '0345678356', 1000, 100, 'www.carenbolage.com', NULL, '9-65517.jpeg', '9-20811.jpeg', 3, NULL),
(10, 10, 'Car à OK', '8976678', 996, 50, 'www.karaoké.com', NULL, '10-16550.jpeg', '10-91181.jpeg', 1, 0),
(11, 10, 'Car ismatique', '98678765', 9078, 78, 'www.charismatique.com', NULL, NULL, NULL, 3, 3),
(16, 10, 'Car en barre', '5699', 85, 8633596, 'cbjvjihg', NULL, NULL, NULL, 3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `type_expense`
--

CREATE TABLE `type_expense` (
`id` int(11) NOT NULL,
  `module_id` int(11) DEFAULT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `type_expense`
--

INSERT INTO `type_expense` (`id`, `module_id`, `name`) VALUES
(1, 12, 'Boissons'),
(2, 12, 'Bouffe'),
(4, 34, 'Drinks'),
(7, 8, 'Boissons');

-- --------------------------------------------------------

--
-- Structure de la table `type_guest`
--

CREATE TABLE `type_guest` (
`id` int(11) NOT NULL,
  `module_id` int(11) DEFAULT NULL,
  `label` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci,
  `price` double DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `type_guest`
--

INSERT INTO `type_guest` (`id`, `module_id`, `label`, `message`, `price`) VALUES
(1, 4, 'Amis IMAC', 'coucou mes amis imac', NULL),
(2, 4, 'Amis SRC', 'coucou mes amis src', 30),
(3, 4, 'Famille', 'Coucou', NULL),
(5, 6, 'Famille', 'Coucou ma famille', 0),
(6, 2, 'Amis de Toulouse', 'bonne année !!!!', 3),
(8, 4, 'Non adhérent', '', 70),
(9, 22, 'Non adhérent', 'T''es moche !', 40),
(10, 22, 'les moches', 'Yoo les moches', 60),
(12, 30, 'Family', 'You are invited to celebrate the 31st Emy''s Birthday with us !', 0),
(14, 30, 'Friends', 'Hello !\r\nYou are invited to celebrate the 31st Emy''s birthday with her family', 0),
(16, 5, 'Friends', NULL, NULL),
(18, 2, 'Amis de Paris', 'coucou', 5);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `event`
--
ALTER TABLE `event`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_3BAE0AA7A76ED395` (`user_id`);

--
-- Index pour la table `expense`
--
ALTER TABLE `expense`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_2D3A8DA6EE960D5E` (`type_expense_id`);

--
-- Index pour la table `fos_user`
--
ALTER TABLE `fos_user`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`), ADD UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`);

--
-- Index pour la table `guest`
--
ALTER TABLE `guest`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_ACB79A3557B581A4` (`type_guest_id`), ADD KEY `IDX_ACB79A35AFC2B591` (`module_id`), ADD KEY `IDX_ACB79A351594D248` (`paymentmean_id`);

--
-- Index pour la table `inflow`
--
ALTER TABLE `inflow`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_CBBF3F71AFC2B591` (`module_id`);

--
-- Index pour la table `item`
--
ALTER TABLE `item`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_1F1B251E3DAE168B` (`list_id`);

--
-- Index pour la table `module`
--
ALTER TABLE `module`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_C24262871F7E88B` (`event_id`);

--
-- Index pour la table `paymentmeans_module`
--
ALTER TABLE `paymentmeans_module`
 ADD PRIMARY KEY (`guestsmodule_id`,`paymentmeans_id`), ADD KEY `IDX_A4BA4E093A6610AA` (`guestsmodule_id`), ADD KEY `IDX_A4BA4E099F63E055` (`paymentmeans_id`);

--
-- Index pour la table `payment_means`
--
ALTER TABLE `payment_means`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `place`
--
ALTER TABLE `place`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_741D53CDAFC2B591` (`module_id`);

--
-- Index pour la table `task_list`
--
ALTER TABLE `task_list`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_377B6C63AFC2B591` (`module_id`);

--
-- Index pour la table `transportation`
--
ALTER TABLE `transportation`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_9B1722DAFC2B591` (`module_id`);

--
-- Index pour la table `type_expense`
--
ALTER TABLE `type_expense`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_51BE253AFC2B591` (`module_id`);

--
-- Index pour la table `type_guest`
--
ALTER TABLE `type_guest`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_A2BB1DC2AFC2B591` (`module_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `event`
--
ALTER TABLE `event`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `expense`
--
ALTER TABLE `expense`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `fos_user`
--
ALTER TABLE `fos_user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `guest`
--
ALTER TABLE `guest`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT pour la table `inflow`
--
ALTER TABLE `inflow`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `item`
--
ALTER TABLE `item`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `module`
--
ALTER TABLE `module`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT pour la table `payment_means`
--
ALTER TABLE `payment_means`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `place`
--
ALTER TABLE `place`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT pour la table `task_list`
--
ALTER TABLE `task_list`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `transportation`
--
ALTER TABLE `transportation`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `type_expense`
--
ALTER TABLE `type_expense`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `type_guest`
--
ALTER TABLE `type_guest`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `event`
--
ALTER TABLE `event`
ADD CONSTRAINT `FK_3BAE0AA7A76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`);

--
-- Contraintes pour la table `expense`
--
ALTER TABLE `expense`
ADD CONSTRAINT `FK_2D3A8DA6EE960D5E` FOREIGN KEY (`type_expense_id`) REFERENCES `type_expense` (`id`);

--
-- Contraintes pour la table `guest`
--
ALTER TABLE `guest`
ADD CONSTRAINT `FK_ACB79A351594D248` FOREIGN KEY (`paymentmean_id`) REFERENCES `payment_means` (`id`),
ADD CONSTRAINT `FK_ACB79A3557B581A4` FOREIGN KEY (`type_guest_id`) REFERENCES `type_guest` (`id`),
ADD CONSTRAINT `FK_ACB79A35AFC2B591` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`);

--
-- Contraintes pour la table `inflow`
--
ALTER TABLE `inflow`
ADD CONSTRAINT `FK_CBBF3F71AFC2B591` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`);

--
-- Contraintes pour la table `item`
--
ALTER TABLE `item`
ADD CONSTRAINT `FK_1F1B251E3DAE168B` FOREIGN KEY (`list_id`) REFERENCES `task_list` (`id`);

--
-- Contraintes pour la table `module`
--
ALTER TABLE `module`
ADD CONSTRAINT `FK_C24262871F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`);

--
-- Contraintes pour la table `paymentmeans_module`
--
ALTER TABLE `paymentmeans_module`
ADD CONSTRAINT `FK_A4BA4E099F63E055` FOREIGN KEY (`paymentmeans_id`) REFERENCES `payment_means` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `FK_A4BA4E093A6610AA` FOREIGN KEY (`guestsmodule_id`) REFERENCES `module` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `place`
--
ALTER TABLE `place`
ADD CONSTRAINT `FK_741D53CDAFC2B591` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`);

--
-- Contraintes pour la table `task_list`
--
ALTER TABLE `task_list`
ADD CONSTRAINT `FK_377B6C63AFC2B591` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`);

--
-- Contraintes pour la table `transportation`
--
ALTER TABLE `transportation`
ADD CONSTRAINT `FK_9B1722DAFC2B591` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`);

--
-- Contraintes pour la table `type_expense`
--
ALTER TABLE `type_expense`
ADD CONSTRAINT `FK_51BE253AFC2B591` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`);

--
-- Contraintes pour la table `type_guest`
--
ALTER TABLE `type_guest`
ADD CONSTRAINT `FK_A2BB1DC2AFC2B591` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
