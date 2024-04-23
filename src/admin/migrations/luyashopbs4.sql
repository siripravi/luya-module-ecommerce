-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2023 at 01:54 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `luyashopbs4`
--

-- --------------------------------------------------------

--
-- Table structure for table `catalog_article`
--

CREATE TABLE `catalog_article` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `product_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `price` decimal(9,2) DEFAULT NULL,
  `price_old` decimal(9,2) DEFAULT NULL,
  `currency_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `available` int(11) NOT NULL DEFAULT 1,
  `image_id` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `position` int(11) NOT NULL DEFAULT 0,
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  `album_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `catalog_article`
--

INSERT INTO `catalog_article` (`id`, `name`, `product_id`, `text`, `code`, `price`, `price_old`, `currency_id`, `unit_id`, `available`, `image_id`, `created_at`, `updated_at`, `position`, `enabled`, `album_id`) VALUES
(6, '{\"en\":\"Brown Choclolate Cake\"}', 28, 'Cakes are frequently described according to their physical form. Cakes may be small and intended for individual consumption. Larger cakes may be made to be sliced and served as part of a meal or social function. Common shapes include: Bundt cakesCake dressCake ballsCake popsConical, such as the …', '{\"en\":\"BROW0001\"}', NULL, NULL, 0, 0, 1, 9, 2147483647, 2147483647, 0, 1, 1),
(7, '{\"en\":\"Honey Chocolate Dip Cake\"}', 28, 'Honey cake has had a long and diverse evolution. From breadcrumbs mashed with honey came the sweet and spiced cake we know today. Whether you like it, love it, or will always pass on this Rosh Hashanah classic, its evolution exemplifies the culinary journey of Jewish Diaspora. This is more than a cake; it connects Jews to Torah, holidays and the sweetness of life.', '{\"en\":\"HONCHK0001\"}', NULL, NULL, 0, 0, 1, 12, 2147483647, 2147483647, 0, 1, NULL),
(8, '{\"en\":\"Creamy Butter Cookies\"}', 29, 'Buttor Cream biscuites topped with chocolate drops', '{\"en\":\"BISC9034\"}', NULL, NULL, 0, 0, 1, 3, 2147483647, 2147483647, 0, 1, 2),
(9, '{\"en\":\"Vanilla Cake with Butter Cream\"}', 30, 'It’s notoriously hard to find a really good, classic cupcake recipe. Many promise game changing techniques, but all too often they fall short.\n\nSo why should you believe me when I say this is the last Vanilla Cupcake recipe you’ll ever use?', '{\"en\":\"VNL00234\"}', NULL, NULL, 0, 0, 1, 49, 2147483647, 2147483647, 0, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `catalog_article_price`
--

CREATE TABLE `catalog_article_price` (
  `article_id` int(11) NOT NULL,
  `value_id` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` float NOT NULL,
  `unit_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `catalog_article_price`
--

INSERT INTO `catalog_article_price` (`article_id`, `value_id`, `currency_id`, `qty`, `price`, `unit_id`) VALUES
(6, 31, 3, 1, 1000, 4),
(6, 32, 3, 1, 647, 4),
(6, 34, 3, 1, 786, 4),
(7, 32, 3, 20, 580, 4),
(8, 35, 3, 1, 20, 4),
(8, 35, 3, 1, 750, 5),
(9, 34, 3, 1, 1240, 4);

-- --------------------------------------------------------

--
-- Table structure for table `catalog_article_value_ref`
--

CREATE TABLE `catalog_article_value_ref` (
  `article_id` int(11) NOT NULL,
  `value_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `catalog_article_value_ref`
--

INSERT INTO `catalog_article_value_ref` (`article_id`, `value_id`) VALUES
(6, 31),
(6, 32),
(6, 33),
(6, 34),
(7, 31),
(7, 34),
(8, 31),
(8, 32),
(8, 35),
(9, 31),
(9, 34);

-- --------------------------------------------------------

--
-- Table structure for table `catalog_brand`
--

CREATE TABLE `catalog_brand` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `position` int(11) NOT NULL DEFAULT 0,
  `enabled` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `catalog_brand`
--

INSERT INTO `catalog_brand` (`id`, `name`, `image_id`, `position`, `enabled`) VALUES
(3, 'Britannia', 38, 0, 1),
(4, 'Cookie', 41, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `catalog_currency`
--

CREATE TABLE `catalog_currency` (
  `id` int(11) NOT NULL,
  `code` varchar(3) NOT NULL,
  `rate` decimal(8,4) NOT NULL,
  `position` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `before` varchar(20) NOT NULL,
  `after` varchar(20) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `catalog_currency`
--

INSERT INTO `catalog_currency` (`id`, `code`, `rate`, `position`, `name`, `before`, `after`, `enabled`) VALUES
(3, 'INR', 0.2500, 0, 'Indian Rupee', 'Rs.', '/-', 1);

-- --------------------------------------------------------

--
-- Table structure for table `catalog_delivery`
--

CREATE TABLE `catalog_delivery` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL DEFAULT 1,
  `name` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `position` int(11) NOT NULL DEFAULT 0,
  `enabled` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `catalog_feature`
--

CREATE TABLE `catalog_feature` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `position` int(11) NOT NULL DEFAULT 0,
  `enabled` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `catalog_feature`
--

INSERT INTO `catalog_feature` (`id`, `name`, `position`, `enabled`) VALUES
(8, 'Size', 0, 1),
(9, 'Version', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `catalog_feature_filter`
--

CREATE TABLE `catalog_feature_filter` (
  `feature_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `catalog_feature_group_ref`
--

CREATE TABLE `catalog_feature_group_ref` (
  `feature_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `catalog_feature_group_ref`
--

INSERT INTO `catalog_feature_group_ref` (`feature_id`, `group_id`) VALUES
(9, 7),
(8, 7),
(9, 8),
(8, 8),
(9, 9);

-- --------------------------------------------------------

--
-- Table structure for table `catalog_group`
--

CREATE TABLE `catalog_group` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(225) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `cover_image_id` int(11) DEFAULT NULL,
  `images_list` text DEFAULT NULL,
  `teaser` varchar(255) DEFAULT NULL,
  `text` text DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `main` tinyint(1) NOT NULL DEFAULT 0,
  `position` int(11) NOT NULL DEFAULT 0,
  `enabled` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `catalog_group`
--

INSERT INTO `catalog_group` (`id`, `parent_id`, `name`, `slug`, `cover_image_id`, `images_list`, `teaser`, `text`, `created_at`, `updated_at`, `main`, `position`, `enabled`) VALUES
(7, 0, 'Cakes', 'cakes', 6, NULL, 'delicious cakes', 'A cake is a type of flour confection that is usually baked and made from flour, sugar, eggs, fat, a liquid, and a leavening agent, such as baking soda or baking powder. Cakes can be simple or elaborate and share features with desserts such as pastries, meringues, custards, and pies. The most common ingredients include flour, sugar, eggs, fat (such as butter, oil, or margarine), a liquid, and a leavening agent, such as baking soda or baking powder. Common additional ingredients include dried, candied, or fresh fruit, nuts, cocoa, and...', 2147483647, 2147483647, 1, 1, 1),
(8, 0, 'Cookies', 'cookies', 55, NULL, 'crispy cookies', NULL, 2147483647, 2147483647, 1, 2, 1),
(9, 0, 'Cupcakes', 'cupcakes', 58, NULL, 'Cupcakes', 'Cupcakes', 2147483647, 2147483647, 1, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `catalog_payment`
--

CREATE TABLE `catalog_payment` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL DEFAULT 1,
  `name` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `position` int(11) NOT NULL DEFAULT 0,
  `enabled` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `catalog_product`
--

CREATE TABLE `catalog_product` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `cover_image_id` int(11) DEFAULT NULL,
  `images_list` text DEFAULT NULL,
  `teaser` varchar(255) DEFAULT NULL,
  `text` text DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `price_from` int(11) NOT NULL DEFAULT 0,
  `view` varchar(255) DEFAULT NULL,
  `position` int(11) NOT NULL DEFAULT 0,
  `enabled` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `catalog_product`
--

INSERT INTO `catalog_product` (`id`, `name`, `slug`, `brand_id`, `cover_image_id`, `images_list`, `teaser`, `text`, `created_at`, `updated_at`, `price_from`, `view`, `position`, `enabled`) VALUES
(28, 'Chocolate Cake', 'chocolate-cake', NULL, 3, NULL, NULL, NULL, 2147483647, 2147483647, 0, NULL, 1, 1),
(29, 'Butter Cookies', 'butter-cookies', NULL, 63, NULL, NULL, NULL, 2147483647, 2147483647, 25, NULL, 0, 1),
(30, 'Vanilla Cake', 'vanilla-cake', 3, 46, NULL, NULL, NULL, 2147483647, 2147483647, 254, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `catalog_product_group_ref`
--

CREATE TABLE `catalog_product_group_ref` (
  `product_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `catalog_product_group_ref`
--

INSERT INTO `catalog_product_group_ref` (`product_id`, `group_id`) VALUES
(28, 7),
(29, 8),
(30, 7);

-- --------------------------------------------------------

--
-- Table structure for table `catalog_product_related_ref`
--

CREATE TABLE `catalog_product_related_ref` (
  `product_id` int(11) NOT NULL,
  `related_id` int(11) NOT NULL,
  `position` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `catalog_product_related_ref`
--

INSERT INTO `catalog_product_related_ref` (`product_id`, `related_id`, `position`) VALUES
(28, 6, 0),
(29, 6, 0),
(30, 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `catalog_product_status`
--

CREATE TABLE `catalog_product_status` (
  `product_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `catalog_related`
--

CREATE TABLE `catalog_related` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `position` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `catalog_related`
--

INSERT INTO `catalog_related` (`id`, `name`, `position`) VALUES
(6, 'Popular Cakes', 0);

-- --------------------------------------------------------

--
-- Table structure for table `catalog_set`
--

CREATE TABLE `catalog_set` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `catalog_unit`
--

CREATE TABLE `catalog_unit` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(100) NOT NULL,
  `position` int(11) NOT NULL DEFAULT 0,
  `enabled` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `catalog_unit`
--

INSERT INTO `catalog_unit` (`id`, `name`, `code`, `position`, `enabled`) VALUES
(4, 'Piece', 'PCS', 0, 1),
(5, 'Pack of 20', 'PKT', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `catalog_value`
--

CREATE TABLE `catalog_value` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `feature_id` int(11) NOT NULL,
  `position` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `catalog_value`
--

INSERT INTO `catalog_value` (`id`, `name`, `feature_id`, `position`) VALUES
(31, 'Eggless', 9, 0),
(32, 'With Egg', 9, 0),
(33, '6 inch', 8, 0),
(34, '12 inch', 8, 0),
(35, 'Pack', 8, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catalog_article`
--
ALTER TABLE `catalog_article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `catalog_article_price`
--
ALTER TABLE `catalog_article_price`
  ADD PRIMARY KEY (`article_id`,`currency_id`,`unit_id`,`qty`,`value_id`) USING BTREE,
  ADD KEY `fk-catalog_article_price-currency_id` (`currency_id`);

--
-- Indexes for table `catalog_article_value_ref`
--
ALTER TABLE `catalog_article_value_ref`
  ADD PRIMARY KEY (`article_id`,`value_id`),
  ADD KEY `fk-catalog_article_value_ref-value_id` (`value_id`);

--
-- Indexes for table `catalog_brand`
--
ALTER TABLE `catalog_brand`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-catalog_brand-image_id` (`image_id`);

--
-- Indexes for table `catalog_currency`
--
ALTER TABLE `catalog_currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `catalog_delivery`
--
ALTER TABLE `catalog_delivery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `catalog_feature`
--
ALTER TABLE `catalog_feature`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `catalog_feature_filter`
--
ALTER TABLE `catalog_feature_filter`
  ADD PRIMARY KEY (`feature_id`,`group_id`),
  ADD KEY `fk-nxt_feature_filter-category_id` (`group_id`);

--
-- Indexes for table `catalog_group`
--
ALTER TABLE `catalog_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-catalog_group-parent_id` (`parent_id`),
  ADD KEY `fk-catalog_group-cover_image_id` (`cover_image_id`);

--
-- Indexes for table `catalog_payment`
--
ALTER TABLE `catalog_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `catalog_product`
--
ALTER TABLE `catalog_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-catalog_product-brand_id` (`brand_id`);

--
-- Indexes for table `catalog_product_group_ref`
--
ALTER TABLE `catalog_product_group_ref`
  ADD PRIMARY KEY (`product_id`,`group_id`),
  ADD KEY `fk-catalog_product_group_ref-group_id` (`group_id`);

--
-- Indexes for table `catalog_product_related_ref`
--
ALTER TABLE `catalog_product_related_ref`
  ADD PRIMARY KEY (`product_id`,`related_id`),
  ADD KEY `fk-catalog_product_related_ref-related_id` (`related_id`) USING BTREE;

--
-- Indexes for table `catalog_product_status`
--
ALTER TABLE `catalog_product_status`
  ADD PRIMARY KEY (`product_id`,`status_id`),
  ADD KEY `fk-product_status-status_id` (`status_id`);

--
-- Indexes for table `catalog_related`
--
ALTER TABLE `catalog_related`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `catalog_set`
--
ALTER TABLE `catalog_set`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `catalog_unit`
--
ALTER TABLE `catalog_unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `catalog_value`
--
ALTER TABLE `catalog_value`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-catalog_value-feature_id` (`feature_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catalog_article`
--
ALTER TABLE `catalog_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `catalog_brand`
--
ALTER TABLE `catalog_brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `catalog_currency`
--
ALTER TABLE `catalog_currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `catalog_delivery`
--
ALTER TABLE `catalog_delivery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `catalog_feature`
--
ALTER TABLE `catalog_feature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `catalog_group`
--
ALTER TABLE `catalog_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `catalog_payment`
--
ALTER TABLE `catalog_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `catalog_product`
--
ALTER TABLE `catalog_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `catalog_related`
--
ALTER TABLE `catalog_related`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `catalog_set`
--
ALTER TABLE `catalog_set`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `catalog_unit`
--
ALTER TABLE `catalog_unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `catalog_value`
--
ALTER TABLE `catalog_value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
