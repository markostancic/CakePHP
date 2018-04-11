-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 11, 2018 at 12:12 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `consumables`
--

DROP TABLE IF EXISTS `consumables`;
CREATE TABLE IF NOT EXISTS `consumables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `consumable_status` enum('draft','in_use','phase_out','obsolete') NOT NULL,
  `recommended_rating` enum('platinum','gold','silver') DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_item_consumables_idx` (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `consumables`
--

INSERT INTO `consumables` (`id`, `item_id`, `consumable_status`, `recommended_rating`, `created`, `modified`) VALUES
(1, 500, 'draft', 'platinum', '2018-04-10 13:30:40', '2018-04-10 13:30:40'),
(2, 509, 'draft', 'platinum', '2018-04-11 08:52:47', '2018-04-11 08:52:47');

-- --------------------------------------------------------

--
-- Table structure for table `goods`
--

DROP TABLE IF EXISTS `goods`;
CREATE TABLE IF NOT EXISTS `goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `hts_number_id` int(11) DEFAULT NULL,
  `tax_group_id` int(11) DEFAULT NULL,
  `eccn` enum('EAR99') DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `for_distributors` tinyint(1) DEFAULT NULL,
  `status` enum('draft','for_sale','phase_out','obsolete','nrnd') NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_item_goods_idx` (`item_id`),
  KEY `FK_hts_number_goods_idx` (`hts_number_id`),
  KEY `FK_tax_group_goods_idx` (`tax_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `goods`
--

INSERT INTO `goods` (`id`, `item_id`, `pid`, `hts_number_id`, `tax_group_id`, `eccn`, `release_date`, `for_distributors`, `status`, `created`, `modified`) VALUES
(1, 501, NULL, NULL, NULL, NULL, NULL, 0, 'draft', '2018-04-10 13:52:20', '2018-04-10 13:52:20');

-- --------------------------------------------------------

--
-- Table structure for table `hts_numbers`
--

DROP TABLE IF EXISTS `hts_numbers`;
CREATE TABLE IF NOT EXISTS `hts_numbers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hts_number` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hts_numbers`
--

INSERT INTO `hts_numbers` (`id`, `hts_number`, `created`, `modified`) VALUES
(1, 432434, '2018-03-23 08:39:02', '2018-04-05 08:00:25');

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

DROP TABLE IF EXISTS `inventories`;
CREATE TABLE IF NOT EXISTS `inventories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `status` enum('draft','in_use','phase_out','obsolete') NOT NULL,
  `recommended_rating` enum('platinum','gold','silver') DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_item_inventories_idx` (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `item_id`, `status`, `recommended_rating`, `created`, `modified`) VALUES
(1, 510, 'draft', 'platinum', '2018-04-11 08:58:32', '2018-04-11 08:58:32');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` text,
  `weight` int(11) DEFAULT NULL,
  `measurement_unit_id` int(11) NOT NULL,
  `item_type_id` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code_UNIQUE` (`code`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  KEY `FK_measuement_types_idx` (`measurement_unit_id`),
  KEY `FK_item_type` (`item_type_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=513 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `code`, `name`, `description`, `weight`, `measurement_unit_id`, `item_type_id`, `deleted`, `created`, `modified`) VALUES
(344, 'POT-0001', 'ygbv', '', NULL, 1, 15, 0, '2018-04-05 07:35:23', '2018-04-05 07:42:55'),
(345, 'POT-0002', 'ujubv', '', NULL, 1, 15, 1, '2018-04-05 07:39:47', '2018-04-05 07:40:53'),
(346, 'GOD-0001', 'yhmj', '', NULL, 1, 14, 1, '2018-04-05 07:55:14', '2018-04-05 07:56:04'),
(347, 'GOD-0002', 'tgjhi', '', NULL, 1, 14, 1, '2018-04-05 07:59:09', '2018-04-05 07:59:09'),
(348, 'SI-0001', 'ghfnjh', '', NULL, 1, 16, 1, '2018-04-05 08:11:28', '2018-04-05 08:13:16'),
(351, 'SMD-0001', 'hmnj', '', NULL, 4, 4, 1, '2018-04-05 08:45:50', '2018-04-05 08:45:50'),
(353, 'PP-0001', 'yded', '', NULL, 5, 2, 1, '2018-04-05 09:20:06', '2018-04-05 09:20:06'),
(354, 'PP-0002', 'rfrth', '', NULL, 5, 2, 0, '2018-04-05 09:22:25', '2018-04-05 09:22:29'),
(376, 'IZRDKUT-0001', 'ybdsd', '', NULL, 1, 13, 1, '2018-04-05 10:07:43', '2018-04-05 10:07:50'),
(469, 'KIT-0001', 'fbb', 'opiss', 123, 1, 3, 0, '2018-04-10 08:09:12', '2018-04-10 08:09:12'),
(472, 'RND-0001', 'ngs', 'gacvz', 123, 1, 10, 0, '2018-04-10 08:39:39', '2018-04-10 08:39:39'),
(499, 'PRO-0001', 'cyjs', '', NULL, 1, 1, 0, '2018-04-10 13:26:57', '2018-04-10 13:26:57'),
(500, 'POT-0003', 'mgfasdf', '', NULL, 1, 15, 0, '2018-04-10 13:30:40', '2018-04-10 13:30:40'),
(501, 'GOD-0003', 'yjmxc ', '', NULL, 4, 14, 0, '2018-04-10 13:52:20', '2018-04-10 13:52:20'),
(502, 'PRO-0002', 'asdas', '', NULL, 1, 1, 0, '2018-04-10 15:05:29', '2018-04-10 15:05:29'),
(503, 'PRO-0003', 'marko', '', NULL, 1, 1, 0, '2018-04-11 07:26:18', '2018-04-11 07:26:18'),
(504, 'PRO-0004', 'etgnjxZXscfvgf', '', NULL, 1, 1, 0, '2018-04-11 07:26:46', '2018-04-11 07:26:46'),
(505, 'SMD-0002', 'yrdas', '', NULL, 1, 4, 0, '2018-04-11 08:08:08', '2018-04-11 08:08:08'),
(506, 'PP-0003', 'uyufsf', '', NULL, 1, 2, 0, '2018-04-11 08:15:00', '2018-04-11 08:15:00'),
(507, 'KIT-0002', 'sadfasdczXZCDes', '', NULL, 1, 3, 1, '2018-04-11 08:46:01', '2018-04-11 08:46:01'),
(508, 'KIT-0003', 'asdasf', '', NULL, 1, 3, 0, '2018-04-11 08:52:29', '2018-04-11 08:52:29'),
(509, 'POT-0004', 'asffyghjf', '', NULL, 1, 15, 0, '2018-04-11 08:52:47', '2018-04-11 08:52:47'),
(510, 'SI-0002', 'asbdvaas', '', NULL, 1, 16, 0, '2018-04-11 08:58:32', '2018-04-11 08:58:32'),
(511, 'USLPR-0001', 'sadas', '', NULL, 1, 8, 0, '2018-04-11 09:15:54', '2018-04-11 09:15:54'),
(512, 'IZRDKUT-0002', 'dashnfdg', '', NULL, 1, 13, 0, '2018-04-11 09:25:51', '2018-04-11 09:25:51');

-- --------------------------------------------------------

--
-- Table structure for table `item_types`
--

DROP TABLE IF EXISTS `item_types`;
CREATE TABLE IF NOT EXISTS `item_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `name` varchar(45) NOT NULL,
  `class` enum('product','material','kit','semi_product','service_product','service_supplier','goods','consumable','inventory','other') NOT NULL,
  `tangible` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code_UNIQUE` (`code`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_types`
--

INSERT INTO `item_types` (`id`, `code`, `name`, `class`, `tangible`, `active`, `created`, `modified`) VALUES
(1, 'PRO', 'Proizvod', 'product', 1, 1, '2018-03-23 08:38:33', '2018-04-05 08:29:59'),
(2, 'PP', 'Poluproizvod', 'semi_product', 1, 0, '2018-03-23 08:38:49', '2018-03-23 08:38:49'),
(3, 'KIT', 'Kitovi', 'kit', 1, 1, '2018-03-23 13:30:20', '2018-03-23 13:30:20'),
(4, 'SMD', 'SMD Komponente', 'material', 1, 1, '2018-03-23 13:30:55', '2018-03-23 13:30:55'),
(5, 'THR', 'Through Hole Komponente', 'material', 1, 1, '2018-03-23 13:31:22', '2018-03-23 13:31:22'),
(6, 'PCB', 'PCB ploce', 'material', 1, 1, '2018-03-23 13:32:37', '2018-03-23 13:32:37'),
(7, 'DOK', 'Dokumentacija', 'material', 1, 1, '2018-03-23 13:33:12', '2018-03-23 13:33:12'),
(8, 'USLPR', 'Payment Request', 'service_product', 0, 1, '2018-03-23 13:34:37', '2018-03-23 13:34:46'),
(9, 'USLKFL', 'Key File License', 'service_product', 0, 1, '2018-03-23 13:36:06', '2018-03-23 13:36:06'),
(10, 'RND', 'Razvoj', 'service_product', 0, 1, '2018-03-23 13:36:31', '2018-03-23 13:36:31'),
(11, 'DNGL', 'USB Dongle License', 'service_product', 1, 1, '2018-03-23 13:37:09', '2018-03-23 13:37:09'),
(12, 'ELD', 'Electronic License Delivery', 'service_product', 0, 1, '2018-03-23 13:37:52', '2018-03-23 13:37:52'),
(13, 'IZRDKUT', 'Izrada kutije', 'service_supplier', 0, 1, '2018-03-23 13:38:26', '2018-03-23 13:38:26'),
(14, 'GOD', 'Farbanje proizvoda', 'goods', 1, 1, '2018-03-23 13:38:56', '2018-03-23 13:38:56'),
(15, 'POT', 'Potrosni materijal', 'consumable', 1, 0, '2018-03-23 13:40:38', '2018-03-23 13:40:38'),
(16, 'SI', 'Sitan inventar', 'inventory', 1, 1, '2018-03-23 13:41:18', '2018-03-23 13:41:18'),
(18, 'PTPO2', 'Repromaterijal', 'material', 1, 0, '2018-03-23 13:42:34', '2018-03-23 13:42:34');

-- --------------------------------------------------------

--
-- Table structure for table `kits`
--

DROP TABLE IF EXISTS `kits`;
CREATE TABLE IF NOT EXISTS `kits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `hts_number_id` int(11) DEFAULT NULL,
  `tax_group_id` int(11) DEFAULT NULL,
  `eccn` enum('EAR99') DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `for_distributors` tinyint(1) DEFAULT NULL,
  `kit_status` enum('draft','for_sale','phase_out','obsolete','nrnd') NOT NULL,
  `hide_kit_content` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pid_UNIQUE` (`pid`),
  KEY `FK_item_kits_idx` (`item_id`),
  KEY `FK_hts_numbers_kits_idx` (`hts_number_id`),
  KEY `FK_tax_group_kits_idx` (`tax_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kits`
--

INSERT INTO `kits` (`id`, `item_id`, `pid`, `hts_number_id`, `tax_group_id`, `eccn`, `release_date`, `for_distributors`, `kit_status`, `hide_kit_content`, `created`, `modified`) VALUES
(1, 469, 3546, 1, 14, 'EAR99', '2018-04-10', 1, 'for_sale', NULL, '2018-04-10 08:09:12', '2018-04-10 08:09:12'),
(2, 507, NULL, NULL, NULL, NULL, NULL, 0, 'draft', NULL, '2018-04-11 08:46:01', '2018-04-11 08:46:01'),
(3, 508, NULL, NULL, NULL, NULL, NULL, 0, 'draft', NULL, '2018-04-11 08:52:29', '2018-04-11 08:52:29');

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

DROP TABLE IF EXISTS `materials`;
CREATE TABLE IF NOT EXISTS `materials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) DEFAULT NULL,
  `material_status` enum('development','in_use','phase_out','obsolete') NOT NULL COMMENT 'ENUM(''development'', ''in_use'', ''phase_out'', ''obsolete'')',
  `service_production` tinyint(1) DEFAULT NULL,
  `recommended_rating` enum('platinum','gold','silver') DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `item_UNIQUE` (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`id`, `item_id`, `material_status`, `service_production`, `recommended_rating`, `created`, `modified`) VALUES
(1, 351, 'development', 1, 'platinum', '2018-04-05 08:45:50', '2018-04-05 08:45:50'),
(2, 505, 'development', 0, 'platinum', '2018-04-11 08:08:08', '2018-04-11 08:08:08');

-- --------------------------------------------------------

--
-- Table structure for table `measuement_units`
--

DROP TABLE IF EXISTS `measuement_units`;
CREATE TABLE IF NOT EXISTS `measuement_units` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `symbol` varchar(5) NOT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `measuement_units`
--

INSERT INTO `measuement_units` (`id`, `name`, `symbol`, `active`, `created`, `modified`) VALUES
(1, 'Metar', 'm', 1, '2018-03-23 08:36:17', '2018-04-05 08:53:06'),
(4, 'Jutar', 'j', 0, '2018-03-29 10:09:12', '2018-03-29 10:09:12'),
(5, 'Kilogram', 'kg', 1, '2018-04-05 08:52:41', '2018-04-05 08:52:49');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `hts_number_id` int(11) DEFAULT NULL,
  `tax_group_id` int(11) DEFAULT NULL,
  `product_eccn` enum('EAR99') DEFAULT NULL,
  `product_release_date` date DEFAULT NULL,
  `for_distributors` tinyint(1) DEFAULT NULL,
  `product_status` enum('development','for_sale','phase_out','obsolete','nrnd') NOT NULL,
  `service_production` tinyint(1) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pid_UNIQUE` (`pid`),
  KEY `FK_item_products_idx` (`item_id`),
  KEY `FK_hts_number_hts_idx` (`hts_number_id`),
  KEY `FK_tax_group` (`tax_group_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `item_id`, `pid`, `hts_number_id`, `tax_group_id`, `product_eccn`, `product_release_date`, `for_distributors`, `product_status`, `service_production`, `created`, `modified`) VALUES
(1, 499, NULL, NULL, NULL, NULL, NULL, 0, 'development', 0, '2018-04-10 13:26:57', '2018-04-10 13:26:57'),
(2, 502, NULL, NULL, NULL, NULL, NULL, 0, 'development', 0, '2018-04-10 15:05:29', '2018-04-10 15:05:29'),
(3, 503, 54548, 1, 5, 'EAR99', '2018-04-11', 0, 'for_sale', 0, '2018-04-11 07:26:18', '2018-04-11 07:26:18'),
(4, 504, NULL, NULL, NULL, NULL, NULL, 0, 'development', 0, '2018-04-11 07:26:46', '2018-04-11 07:26:46');

-- --------------------------------------------------------

--
-- Table structure for table `semi_products`
--

DROP TABLE IF EXISTS `semi_products`;
CREATE TABLE IF NOT EXISTS `semi_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `semi_product_status` enum('development','in_use','phase_out','obsolete') NOT NULL,
  `service_production` tinyint(1) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_item_semi-product_idx` (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `semi_products`
--

INSERT INTO `semi_products` (`id`, `item_id`, `semi_product_status`, `service_production`, `created`, `modified`) VALUES
(1, 353, 'development', 0, '2018-04-05 09:20:06', '2018-04-05 09:20:06'),
(2, 354, 'development', 0, '2018-04-05 09:22:25', '2018-04-05 09:22:29'),
(3, 506, 'development', 0, '2018-04-11 08:15:00', '2018-04-11 08:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `service_products`
--

DROP TABLE IF EXISTS `service_products`;
CREATE TABLE IF NOT EXISTS `service_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `hts_number_id` int(11) DEFAULT NULL,
  `tax_group_id` int(11) DEFAULT NULL,
  `eccn` enum('EAR99','3D991') DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `for_distributors` tinyint(1) DEFAULT NULL,
  `service_status` enum('development','for_sale','phase_out','obsolete') NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_item_service_products_idx` (`item_id`),
  KEY `FK_hts_numember_service_products_idx` (`hts_number_id`),
  KEY `FK_tax_group_service_products_idx` (`tax_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service_products`
--

INSERT INTO `service_products` (`id`, `item_id`, `pid`, `hts_number_id`, `tax_group_id`, `eccn`, `release_date`, `for_distributors`, `service_status`, `created`, `modified`) VALUES
(1, 472, 7833, 1, 5, '3D991', '2018-04-10', 1, 'for_sale', '2018-04-10 08:39:39', '2018-04-10 08:39:39'),
(2, 511, NULL, NULL, NULL, NULL, NULL, 0, 'development', '2018-04-11 09:15:54', '2018-04-11 09:15:54');

-- --------------------------------------------------------

--
-- Table structure for table `service_suppliers`
--

DROP TABLE IF EXISTS `service_suppliers`;
CREATE TABLE IF NOT EXISTS `service_suppliers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `service_status` enum('draft','in_use','phase_out','obsolete') NOT NULL,
  `service_rating` enum('platinum','gold','silver') DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_item_service_suppliers_idx` (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service_suppliers`
--

INSERT INTO `service_suppliers` (`id`, `item_id`, `service_status`, `service_rating`, `created`, `modified`) VALUES
(1, 376, 'draft', 'platinum', '2018-04-05 10:07:43', '2018-04-05 10:07:50'),
(2, 512, 'draft', 'platinum', '2018-04-11 09:25:51', '2018-04-11 09:25:51');

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

DROP TABLE IF EXISTS `taxes`;
CREATE TABLE IF NOT EXISTS `taxes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tax` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`id`, `tax`, `created`, `modified`) VALUES
(5, 20, '2018-04-04 10:18:11', '2018-04-04 10:18:11'),
(14, 30, '2018-04-05 10:02:31', '2018-04-11 07:48:17');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `consumables`
--
ALTER TABLE `consumables`
  ADD CONSTRAINT `FK_item_consumables` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `goods`
--
ALTER TABLE `goods`
  ADD CONSTRAINT `FK_hts_number_goods` FOREIGN KEY (`hts_number_id`) REFERENCES `hts_numbers` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_item_goods` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_tax_group_goods` FOREIGN KEY (`tax_group_id`) REFERENCES `taxes` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `inventories`
--
ALTER TABLE `inventories`
  ADD CONSTRAINT `FK_item_inventories` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `FK_item_types` FOREIGN KEY (`item_type_id`) REFERENCES `item_types` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_measuement_types` FOREIGN KEY (`measurement_unit_id`) REFERENCES `measuement_units` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `kits`
--
ALTER TABLE `kits`
  ADD CONSTRAINT `FK_hts_numbers_kits` FOREIGN KEY (`hts_number_id`) REFERENCES `hts_numbers` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_item_kits` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_tax_group_kits` FOREIGN KEY (`tax_group_id`) REFERENCES `taxes` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `materials`
--
ALTER TABLE `materials`
  ADD CONSTRAINT `FK_item_materials` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_hts_number_products` FOREIGN KEY (`hts_number_id`) REFERENCES `hts_numbers` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_item_products` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_tax_group_products` FOREIGN KEY (`tax_group_id`) REFERENCES `taxes` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `semi_products`
--
ALTER TABLE `semi_products`
  ADD CONSTRAINT `FK_item_semi-products` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `service_products`
--
ALTER TABLE `service_products`
  ADD CONSTRAINT `FK_hts_numember_service_products` FOREIGN KEY (`hts_number_id`) REFERENCES `hts_numbers` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_item_service_products` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_tax_group_service_products` FOREIGN KEY (`tax_group_id`) REFERENCES `taxes` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `service_suppliers`
--
ALTER TABLE `service_suppliers`
  ADD CONSTRAINT `FK_item_service_suppliers` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
