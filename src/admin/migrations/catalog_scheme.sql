-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2023 at 11:23 AM
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
-- Database: `only_catalog`
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

-- --------------------------------------------------------

--
-- Table structure for table `catalog_article_value_ref`
--

CREATE TABLE `catalog_article_value_ref` (
  `article_id` int(11) NOT NULL,
  `value_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `catalog_product_group_ref`
--

CREATE TABLE `catalog_product_group_ref` (
  `product_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `catalog_product_related_ref`
--

CREATE TABLE `catalog_product_related_ref` (
  `product_id` int(11) NOT NULL,
  `related_id` int(11) NOT NULL,
  `position` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `catalog_brand`
--
ALTER TABLE `catalog_brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `catalog_currency`
--
ALTER TABLE `catalog_currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `catalog_delivery`
--
ALTER TABLE `catalog_delivery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `catalog_feature`
--
ALTER TABLE `catalog_feature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `catalog_group`
--
ALTER TABLE `catalog_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `catalog_payment`
--
ALTER TABLE `catalog_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `catalog_product`
--
ALTER TABLE `catalog_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `catalog_related`
--
ALTER TABLE `catalog_related`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `catalog_set`
--
ALTER TABLE `catalog_set`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `catalog_unit`
--
ALTER TABLE `catalog_unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `catalog_value`
--
ALTER TABLE `catalog_value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
