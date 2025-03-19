-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2025 at 09:59 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecom-shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand_name`, `created_at`, `updated_at`) VALUES
(1, 'Christian De Lumen Brand', '2025-03-17 14:18:58', '2025-03-17 14:18:58');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `checkouts`
--

CREATE TABLE `checkouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cart_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`cart_data`)),
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `zip_code` varchar(255) NOT NULL,
  `payment_option` varchar(255) NOT NULL,
  `proof_of_payment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `checkouts`
--

INSERT INTO `checkouts` (`id`, `cart_data`, `first_name`, `last_name`, `phone`, `address`, `barangay`, `zip_code`, `payment_option`, `proof_of_payment`, `created_at`, `updated_at`, `status`) VALUES
(18, '{\"0\":{\"id\":\"6\",\"name\":\"BlazeMic Pro\",\"price\":5000,\"quantity\":1,\"shippingFee\":120,\"totalPrice\":5000,\"image\":\"http:\\/\\/127.0.0.1:8000\\/storage\\/shop_image\\/X48B7uiNnTsYnz1x3k3Kg3x1YoWXG2fKgwhkslaA.jpg\",\"weight\":500},\"grand_total\":5120}', 'Jennifer', 'Daniwan', '09277612910', 'Cambridge Village, Block 19, Rizal', 'San Andress', '1900', 'gcash', 'proofpayment_image/g8aTex9IzcKFeThZ3CIXFxvC5WsjLn0HiSdFyReP.png', '2025-03-19 06:47:48', '2025-03-19 07:25:42', 1),
(19, '{\"0\":{\"id\":\"6\",\"name\":\"BlazeMic Pro\",\"price\":5000,\"quantity\":1,\"shippingFee\":120,\"totalPrice\":5000,\"image\":\"http:\\/\\/127.0.0.1:8000\\/storage\\/shop_image\\/X48B7uiNnTsYnz1x3k3Kg3x1YoWXG2fKgwhkslaA.jpg\",\"weight\":500},\"grand_total\":5120}', 'Jennifer', 'Daniwan', '09277612910', 'Cambridge Village, Block 19, Rizal', 'San Andress', '1900', 'gcash', 'proofpayment_image/g8aTex9IzcKFeThZ3CIXFxvC5WsjLn0HiSdFyReP.png', '2025-03-19 06:47:48', '2025-03-19 07:32:56', 1),
(20, '{\"0\":{\"id\":\"6\",\"name\":\"BlazeMic Pro\",\"price\":5000,\"quantity\":1,\"shippingFee\":120,\"totalPrice\":5000,\"image\":\"http:\\/\\/127.0.0.1:8000\\/storage\\/shop_image\\/X48B7uiNnTsYnz1x3k3Kg3x1YoWXG2fKgwhkslaA.jpg\",\"weight\":500},\"grand_total\":5120}', 'Jennifer', 'Daniwan', '09277612910', 'Cambridge Village, Block 19, Rizal', 'San Andress', '1900', 'gcash', 'proofpayment_image/g8aTex9IzcKFeThZ3CIXFxvC5WsjLn0HiSdFyReP.png', '2025-03-19 06:47:48', '2025-03-19 07:24:24', 0),
(21, '{\"0\":{\"id\":\"6\",\"name\":\"BlazeMic Pro\",\"price\":5000,\"quantity\":1,\"shippingFee\":120,\"totalPrice\":5000,\"image\":\"http:\\/\\/127.0.0.1:8000\\/storage\\/shop_image\\/X48B7uiNnTsYnz1x3k3Kg3x1YoWXG2fKgwhkslaA.jpg\",\"weight\":500},\"grand_total\":5120}', 'fafa\r\n', 'Daniwan', '09277612910', 'Cambridge Village, Block 19, Rizal', 'San Andress', '1900', 'gcash', 'proofpayment_image/g8aTex9IzcKFeThZ3CIXFxvC5WsjLn0HiSdFyReP.png', '2025-03-19 06:47:48', '2025-03-19 07:24:24', 0);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(9, '0001_01_01_000001_create_cache_table', 2),
(10, '0001_01_01_000002_create_jobs_table', 2),
(11, '2025_03_08_125104_update_users_table', 2),
(12, '2025_03_08_125422_update_users_table', 2),
(14, '2025_03_10_160812_add_subdomain_to_users_table', 3),
(15, '2025_03_13_202019_add_referral_code_to_users_table', 4),
(16, '2025_03_13_223028_create_members_table', 5),
(17, '2025_03_13_233017_add_referral_columns_to_users_table', 6),
(18, '2025_03_14_110111_add_referral_code_and_referred_by_to_users_table', 7),
(19, '2025_03_14_144215_create_playlists_table', 8),
(20, '2025_03_14_155055_add_thumbnail_url_to_playlists_table', 9),
(21, '2025_03_17_220023_create_brands_table', 10),
(22, '2025_03_17_220245_create_checkouts_table', 11),
(24, '2025_03_17_220437_add_shipping_rules_to_products_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `playlists`
--

CREATE TABLE `playlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `video_link` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `thumbnail_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `playlists`
--

INSERT INTO `playlists` (`id`, `title`, `video_link`, `created_at`, `updated_at`, `thumbnail_url`) VALUES
(7, 'Forex Module One', 'https://d1yei2z3i6k35z.cloudfront.net/4624298/674856edaa387_Untitled6.mp4', '2025-03-14 10:07:22', '2025-03-14 10:07:22', 'thumbnails/8WPmxnIVuhQmvnJo2ImJEn7Wj8JCr07XCmi6aich.jpg'),
(8, 'Forex Module Two', 'https://d1yei2z3i6k35z.cloudfront.net/4624298/674856edaa387_Untitled6.mp4', '2025-03-14 10:07:47', '2025-03-14 10:07:47', 'thumbnails/j3liGkxUjywAFllhgnd2xtz1q0WF3UssRjqote5z.png'),
(9, 'Forex Module Three', 'https://d1yei2z3i6k35z.cloudfront.net/4624298/674856edaa387_Untitled6.mp4', '2025-03-14 10:08:04', '2025-03-14 10:08:04', 'thumbnails/15hwP5tMLCFRZd7lJmjOwBj7kSXrRwp4wGQm0GGt.jpg'),
(10, 'Forex Module Four', 'https://d1yei2z3i6k35z.cloudfront.net/4624298/674856edaa387_Untitled6.mp4', '2025-03-14 10:09:06', '2025-03-14 10:09:06', 'thumbnails/AOHUOSAxZjk05DAO4icEVVG7Ot8dXR2yg9LVpkMc.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `shipping_rules` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`shipping_rules`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `weight` int(11) DEFAULT 500
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `category`, `image_path`, `shipping_rules`, `created_at`, `updated_at`, `weight`) VALUES
(6, 'BlazeMic Pro', 'Para sa solid na boses, malinaw at malutong—perfect sa streaming, podcast, o rap battles. Ready ka na bang marinig?', 5000.00, 'BlazeMic Pro', 'shop_image/X48B7uiNnTsYnz1x3k3Kg3x1YoWXG2fKgwhkslaA.jpg', '[{\"min_weight\":0,\"max_weight\":500,\"pouch_type\":\"Small\",\"shipping_fee\":120},{\"min_weight\":501,\"max_weight\":1000,\"pouch_type\":\"Small\",\"shipping_fee\":120},{\"min_weight\":1001,\"max_weight\":2000,\"pouch_type\":\"Medium\",\"shipping_fee\":180},{\"min_weight\":2001,\"max_weight\":3000,\"pouch_type\":\"Medium\",\"shipping_fee\":180},{\"min_weight\":3001,\"max_weight\":4000,\"pouch_type\":\"Large\",\"shipping_fee\":300},{\"min_weight\":4001,\"max_weight\":5000,\"pouch_type\":\"Large\",\"shipping_fee\":300},{\"min_weight\":5001,\"max_weight\":6000,\"pouch_type\":\"Extra Large\",\"shipping_fee\":400}]', NULL, NULL, 500),
(7, 'Nova Blitz GX', 'Take your setup next level. RGB lighting, smooth recline, and premium leather finish—made for gamers who never settle.', 2000.00, NULL, 'shop_image/j7d4ivJg9WvHtDTbyh4IXvaHyu7qQMpkuum3zO6L.jpg', '[{\"min_weight\":0,\"max_weight\":500,\"pouch_type\":\"Small\",\"shipping_fee\":120},{\"min_weight\":501,\"max_weight\":1000,\"pouch_type\":\"Small\",\"shipping_fee\":120},{\"min_weight\":1001,\"max_weight\":2000,\"pouch_type\":\"Medium\",\"shipping_fee\":180},{\"min_weight\":2001,\"max_weight\":3000,\"pouch_type\":\"Medium\",\"shipping_fee\":180},{\"min_weight\":3001,\"max_weight\":4000,\"pouch_type\":\"Large\",\"shipping_fee\":300},{\"min_weight\":4001,\"max_weight\":5000,\"pouch_type\":\"Large\",\"shipping_fee\":300},{\"min_weight\":5001,\"max_weight\":6000,\"pouch_type\":\"Extra Large\",\"shipping_fee\":400}]', NULL, NULL, 500);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
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
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('kBJFAIG6X8ctkwZKpRLi4jmkf0nDtxjabkIBOHCC', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicDAzVW5RN3dETDBxNXhQSEtsdHNvUnZBMUFRaERPdUI2SU1EbTYzeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zaG9wIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1742417925);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subdomain` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `referral_code` varchar(8) DEFAULT NULL,
  `referred_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `password_reset_expires` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `approved` tinyint(1) NOT NULL DEFAULT 0,
  `profile_picture` varchar(255) DEFAULT NULL,
  `default_profile` varchar(255) DEFAULT NULL,
  `is_online` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `subdomain`, `email_verified_at`, `password`, `referral_code`, `referred_by`, `created_at`, `updated_at`, `password_reset_token`, `password_reset_expires`, `is_admin`, `approved`, `profile_picture`, `default_profile`, `is_online`) VALUES
(111, 'Christian De Lumnen', 'chrislozan22@gmail.com', 'chrislozan', NULL, '$2y$12$b3RE0kjl.rz./dOFhX5znunBYgkLxp1Qoiyix0K4bl8jCMGFQCUcK', 'Dfp0TARO', NULL, '2025-03-14 04:49:27', '2025-03-19 10:50:44', NULL, NULL, 0, 1, NULL, 'profile_photos/profile_1741956567.jpg', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `checkouts`
--
ALTER TABLE `checkouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `playlists`
--
ALTER TABLE `playlists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `subdomain` (`subdomain`),
  ADD UNIQUE KEY `users_referral_code_unique` (`referral_code`),
  ADD KEY `users_referred_by_foreign` (`referred_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `checkouts`
--
ALTER TABLE `checkouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `playlists`
--
ALTER TABLE `playlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_referred_by_foreign` FOREIGN KEY (`referred_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
