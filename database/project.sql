-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 19, 2024 at 07:20 PM
-- Server version: 8.0.31
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `additional_info`
--

DROP TABLE IF EXISTS `additional_info`;
CREATE TABLE IF NOT EXISTS `additional_info` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `bookings_id` bigint UNSIGNED NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `visa_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_additional_info_bookings1_idx` (`bookings_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `additional_info`
--

INSERT INTO `additional_info` (`id`, `bookings_id`, `notes`, `visa_photo`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 11, NULL, NULL, '2024-03-16 11:26:58', '2024-03-16 11:26:58', NULL),
(7, 12, NULL, NULL, '2024-03-16 11:28:28', '2024-03-16 11:28:28', NULL),
(8, 13, NULL, NULL, '2024-03-16 11:31:07', '2024-03-16 11:31:07', NULL),
(9, 14, NULL, NULL, '2024-03-16 14:54:06', '2024-03-16 14:54:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
CREATE TABLE IF NOT EXISTS `blogs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `views` int DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `tags` text COLLATE utf8mb4_unicode_ci,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `keywords` text COLLATE utf8mb4_unicode_ci,
  `user_id` bigint UNSIGNED NOT NULL,
  `state_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blogs_user_id_foreign` (`user_id`),
  KEY `blogs_state_id_foreign` (`state_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs_states`
--

DROP TABLE IF EXISTS `blogs_states`;
CREATE TABLE IF NOT EXISTS `blogs_states` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs_states`
--

INSERT INTO `blogs_states` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'المدينة المنورة', '2024-03-10 16:34:06', NULL),
(4, 'مكة المكرمة', '2024-03-10 19:10:39', '2024-03-10 19:10:39'),
(5, 'الرياض', '2024-03-10 19:12:57', '2024-03-10 19:18:14'),
(7, 'جدة', '2024-03-10 19:15:52', '2024-03-10 19:15:52');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `return_date` date DEFAULT NULL,
  `return_time` time DEFAULT NULL,
  `booking_status` int NOT NULL DEFAULT '0',
  `booking_type` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'e.g: trip, hourly, plan',
  `is_return` tinyint(1) NOT NULL DEFAULT '0',
  `is_paid` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `from_lat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_long` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to_lat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to_long` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `trip_price_id` bigint DEFAULT NULL,
  `site_price_id` bigint DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_bookings_users1_idx` (`user_id`),
  KEY `fk_bookings_trips_prices1_idx` (`trip_price_id`),
  KEY `fk_bookings_sites_prices1_idx` (`site_price_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `date`, `time`, `return_date`, `return_time`, `booking_status`, `booking_type`, `is_return`, `is_paid`, `is_deleted`, `notes`, `from_lat`, `from_long`, `to_lat`, `to_long`, `created_at`, `updated_at`, `deleted_at`, `user_id`, `trip_price_id`, `site_price_id`) VALUES
(11, '2024-03-23', '16:00:00', NULL, NULL, 0, 'trip', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '2024-03-16 11:26:58', '2024-03-16 11:26:58', NULL, 6, 1, NULL),
(12, '2024-03-23', '16:00:00', NULL, NULL, 0, 'trip', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '2024-03-16 11:28:28', '2024-03-16 11:28:28', NULL, 6, 1, NULL),
(13, '2024-03-23', '16:00:00', NULL, NULL, 0, 'trip', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '2024-03-16 11:31:07', '2024-03-16 11:31:07', NULL, 6, 1, NULL),
(14, '2024-03-23', '16:00:00', NULL, NULL, 0, 'trip', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '2024-03-16 14:54:06', '2024-03-16 14:54:06', NULL, 6, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

DROP TABLE IF EXISTS `cars`;
CREATE TABLE IF NOT EXISTS `cars` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `car_category_id` bigint UNSIGNED NOT NULL,
  `driver_id` bigint UNSIGNED DEFAULT NULL,
  `num_passengers` int NOT NULL DEFAULT '1',
  `bags` int DEFAULT '0',
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cars_users1_idx` (`driver_id`),
  KEY `fk_cars_categories1_idx` (`car_category_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `name`, `car_category_id`, `driver_id`, `num_passengers`, `bags`, `color`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'كامري/سوناتا 2024', 1, NULL, 3, 3, NULL, NULL, NULL, NULL, NULL),
(2, 'فورد تورس 2024', 3, NULL, 3, 3, NULL, NULL, NULL, NULL, NULL),
(3, 'جمس يوكن اكس ال 2024', 2, NULL, 7, 7, NULL, NULL, NULL, NULL, NULL),
(4, 'اتش ون 2024', 2, NULL, 11, 11, NULL, NULL, NULL, NULL, NULL),
(5, 'لكزس es 2024', 3, NULL, 3, 3, NULL, NULL, NULL, NULL, NULL),
(6, 'مرسيدس S560 2023', 4, NULL, 3, 3, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `photo`, `created_at`, `updated_at`) VALUES
(1, 'اقتصادية', NULL, NULL, NULL),
(2, 'عائلية', NULL, NULL, NULL),
(3, 'VIP', NULL, NULL, NULL),
(4, 'فاخرة', NULL, NULL, NULL),
(5, 'باصات', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

DROP TABLE IF EXISTS `discounts`;
CREATE TABLE IF NOT EXISTS `discounts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `booking_count` int NOT NULL DEFAULT '1',
  `percentage` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `bookings_id` bigint UNSIGNED NOT NULL,
  `payment_method_id` bigint NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `booking_price` double NOT NULL,
  `paid_percentage` int NOT NULL DEFAULT '0',
  `discount_amount` double DEFAULT '0',
  `booking_total` double DEFAULT '0',
  `additional_services_price` double DEFAULT '0',
  `tax` double DEFAULT NULL,
  `card_num` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Payment_bookings1_idx` (`bookings_id`),
  KEY `fk_Payment_Payment_methods1_idx` (`payment_method_id`),
  KEY `fk_payment_users1_idx` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `bookings_id`, `payment_method_id`, `user_id`, `booking_price`, `paid_percentage`, `discount_amount`, `booking_total`, `additional_services_price`, `tax`, `card_num`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 11, 2, 6, 100, 25, 0, 400, 200, NULL, NULL, '2024-03-16 11:26:58', '2024-03-16 11:26:58', NULL),
(2, 12, 2, 6, 100, 25, 0, 400, 200, NULL, NULL, '2024-03-16 11:28:28', '2024-03-16 11:28:28', NULL),
(3, 13, 2, 6, 100, 25, 0, 400, 200, NULL, NULL, '2024-03-16 11:31:07', '2024-03-16 11:31:07', NULL),
(4, 14, 2, 6, 100, 25, 0, 400, 200, NULL, NULL, '2024-03-16 14:54:06', '2024-03-16 14:54:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

DROP TABLE IF EXISTS `payment_methods`;
CREATE TABLE IF NOT EXISTS `payment_methods` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`) VALUES
(2, 'الدفع النقدى'),
(1, 'الدفع بواسطة بطاقة الائتمان'),
(3, 'الدفع عند الوصول');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(10, 'App\\Models\\User', 1, 'main', '4c34d0252b63a83c1d2497462031b76d353dc3710be3ba1d5b26156caab8d02a', '[\"*\"]', NULL, NULL, '2024-03-12 17:53:33', '2024-03-12 17:53:33'),
(11, 'App\\Models\\User', 1, 'main', '505ecd0fdf223d6d9fa77a7ec4b77243fdfb760e410ee2f87bc6dbdfa660afd0', '[\"*\"]', NULL, NULL, '2024-03-12 18:58:39', '2024-03-12 18:58:39'),
(12, 'App\\Models\\User', 1, 'main', '8568fa4a63a644e61666de87b284ba33599b6631bfda46e1c693817543e94796', '[\"*\"]', '2024-03-16 11:32:12', NULL, '2024-03-13 17:36:05', '2024-03-16 11:32:12'),
(13, 'App\\Models\\User', 1, 'main', '094b541acc3ccc0c9caa22e0a18b2b9c8404ab6539243b1e224d91da5fc237fe', '[\"*\"]', NULL, NULL, '2024-03-13 17:38:10', '2024-03-13 17:38:10'),
(14, 'App\\Models\\User', 1, 'main', '4eb7bfc79ab30b1eec4675b593e466782a23ff2eff4fbac37e843f109ab31da3', '[\"*\"]', '2024-03-16 14:54:05', NULL, '2024-03-16 10:50:01', '2024-03-16 14:54:05');

-- --------------------------------------------------------

--
-- Table structure for table `sightseeings`
--

DROP TABLE IF EXISTS `sightseeings`;
CREATE TABLE IF NOT EXISTS `sightseeings` (
  `id` bigint NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_Sightseeings_categories1_idx` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sites_prices`
--

DROP TABLE IF EXISTS `sites_prices`;
CREATE TABLE IF NOT EXISTS `sites_prices` (
  `id` bigint NOT NULL,
  `car_id` bigint UNSIGNED NOT NULL,
  `sightseeing_id` bigint NOT NULL,
  `inital_price` double NOT NULL DEFAULT '0',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_cars_has_Sightseeings_Sightseeings1_idx` (`sightseeing_id`),
  KEY `fk_cars_has_Sightseeings_cars1_idx` (`car_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

DROP TABLE IF EXISTS `trips`;
CREATE TABLE IF NOT EXISTS `trips` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trips`
--

INSERT INTO `trips` (`id`, `from`, `to`, `start_date`, `end_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'مطار جدة', 'داخل جدة', NULL, NULL, NULL, NULL, NULL),
(3, 'جدة', 'مكة', NULL, NULL, NULL, NULL, NULL),
(4, 'مكة', 'جدة', NULL, NULL, NULL, NULL, NULL),
(5, 'مكة', 'الطائف', NULL, NULL, NULL, NULL, NULL),
(6, 'الطائف', 'مكة', NULL, NULL, NULL, NULL, NULL),
(7, 'جدة', 'الطائف', NULL, NULL, NULL, NULL, NULL),
(8, 'الطائف', 'جدة', NULL, NULL, NULL, NULL, NULL),
(9, 'جدة', 'المدينة', NULL, NULL, NULL, NULL, NULL),
(10, 'المدينة', 'جدة', NULL, NULL, NULL, NULL, NULL),
(11, 'مكة', 'المدينة', NULL, NULL, NULL, NULL, NULL),
(12, 'المدينة', 'مكة', NULL, NULL, NULL, NULL, NULL),
(13, 'الفندق', 'المطار', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trips_prices`
--

DROP TABLE IF EXISTS `trips_prices`;
CREATE TABLE IF NOT EXISTS `trips_prices` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `car_id` bigint UNSIGNED NOT NULL,
  `trip_id` bigint UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `initial_price` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `fk_cars_has_trips_trips1_idx` (`trip_id`),
  KEY `fk_cars_has_trips_cars1_idx` (`car_id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trips_prices`
--

INSERT INTO `trips_prices` (`id`, `car_id`, `trip_id`, `start_date`, `end_date`, `initial_price`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 3, '2024-03-11', NULL, 200, '2024-03-11 19:38:17', NULL, NULL),
(2, 3, 3, '2024-03-11', NULL, 400, '2024-03-11 19:38:17', NULL, NULL),
(3, 4, 3, '2024-03-11', NULL, 330, '2024-03-11 19:38:17', NULL, NULL),
(4, 5, 3, '2024-03-11', NULL, 350, '2024-03-11 19:38:17', NULL, NULL),
(5, 6, 3, '2024-03-11', NULL, 1100, '2024-03-11 19:38:17', NULL, NULL),
(6, 1, 4, '2024-03-11', NULL, 200, '2024-03-11 19:38:17', NULL, NULL),
(7, 3, 4, '2024-03-11', NULL, 400, '2024-03-11 19:38:17', NULL, NULL),
(8, 4, 4, '2024-03-11', NULL, 330, '2024-03-11 19:38:17', NULL, NULL),
(9, 5, 4, '2024-03-11', NULL, 350, '2024-03-11 19:38:17', NULL, NULL),
(10, 6, 4, '2024-03-11', NULL, 1100, '2024-03-11 19:38:17', NULL, NULL),
(11, 1, 5, '2024-03-11', NULL, 200, '2024-03-11 19:38:17', NULL, NULL),
(12, 3, 5, '2024-03-11', NULL, 400, '2024-03-11 19:38:17', NULL, NULL),
(13, 4, 5, '2024-03-11', NULL, 350, '2024-03-11 19:38:17', NULL, NULL),
(14, 5, 5, '2024-03-11', NULL, 400, '2024-03-11 19:38:17', NULL, NULL),
(15, 6, 5, '2024-03-11', NULL, 0, '2024-03-11 19:38:17', NULL, NULL),
(16, 1, 6, '2024-03-11', NULL, 200, '2024-03-11 19:38:17', NULL, NULL),
(17, 3, 6, '2024-03-11', NULL, 400, '2024-03-11 19:38:17', NULL, NULL),
(18, 4, 6, '2024-03-11', NULL, 350, '2024-03-11 19:38:17', NULL, NULL),
(19, 5, 6, '2024-03-11', NULL, 400, '2024-03-11 19:38:17', NULL, NULL),
(20, 6, 6, '2024-03-11', NULL, 0, '2024-03-11 19:38:17', NULL, NULL),
(21, 1, 7, '2024-03-11', NULL, 320, '2024-03-11 19:38:17', NULL, NULL),
(22, 3, 7, '2024-03-11', NULL, 500, '2024-03-11 19:38:17', NULL, NULL),
(23, 4, 7, '2024-03-11', NULL, 450, '2024-03-11 19:38:17', NULL, NULL),
(24, 5, 7, '2024-03-11', NULL, 500, '2024-03-11 19:38:17', NULL, NULL),
(25, 6, 7, '2024-03-11', NULL, 0, '2024-03-11 19:38:17', NULL, NULL),
(26, 1, 8, '2024-03-11', NULL, 320, '2024-03-11 19:38:17', NULL, NULL),
(27, 3, 8, '2024-03-11', NULL, 500, '2024-03-11 19:38:17', NULL, NULL),
(28, 4, 8, '2024-03-11', NULL, 450, '2024-03-11 19:38:17', NULL, NULL),
(29, 5, 8, '2024-03-11', NULL, 500, '2024-03-11 19:38:17', NULL, NULL),
(30, 6, 8, '2024-03-11', NULL, 0, '2024-03-11 19:38:17', NULL, NULL),
(31, 1, 9, '2024-03-11', NULL, 470, '2024-03-11 19:38:17', NULL, NULL),
(32, 3, 9, '2024-03-11', NULL, 800, '2024-03-11 19:38:17', NULL, NULL),
(33, 4, 9, '2024-03-11', NULL, 650, '2024-03-11 19:38:17', NULL, NULL),
(34, 5, 9, '2024-03-11', NULL, 800, '2024-03-11 19:38:17', NULL, NULL),
(35, 6, 9, '2024-03-11', NULL, 0, '2024-03-11 19:38:17', NULL, NULL),
(36, 1, 10, '2024-03-11', NULL, 470, '2024-03-11 19:38:17', NULL, NULL),
(37, 3, 10, '2024-03-11', NULL, 800, '2024-03-11 19:38:17', NULL, NULL),
(38, 4, 10, '2024-03-11', NULL, 650, '2024-03-11 19:38:17', NULL, NULL),
(39, 5, 10, '2024-03-11', NULL, 800, '2024-03-11 19:38:17', NULL, NULL),
(40, 6, 10, '2024-03-11', NULL, 0, '2024-03-11 19:38:17', NULL, NULL),
(41, 1, 11, '2024-03-11', NULL, 450, '2024-03-11 19:38:17', NULL, NULL),
(42, 3, 11, '2024-03-11', NULL, 800, '2024-03-11 19:38:17', NULL, NULL),
(43, 4, 11, '2024-03-11', NULL, 650, '2024-03-11 19:38:17', NULL, NULL),
(44, 5, 11, '2024-03-11', NULL, 800, '2024-03-11 19:38:17', NULL, NULL),
(45, 6, 11, '2024-03-11', NULL, 0, '2024-03-11 19:38:17', NULL, NULL),
(46, 1, 12, '2024-03-11', NULL, 450, '2024-03-11 19:38:17', NULL, NULL),
(47, 3, 12, '2024-03-11', NULL, 800, '2024-03-11 19:38:17', NULL, NULL),
(48, 4, 12, '2024-03-11', NULL, 650, '2024-03-11 19:38:17', NULL, NULL),
(49, 5, 12, '2024-03-11', NULL, 800, '2024-03-11 19:38:17', NULL, NULL),
(50, 6, 12, '2024-03-11', NULL, 0, '2024-03-11 19:38:17', NULL, NULL),
(51, 1, 2, '2024-03-11', NULL, 90, '2024-03-11 19:38:17', NULL, NULL),
(52, 3, 2, '2024-03-11', NULL, 200, '2024-03-11 19:38:17', NULL, NULL),
(53, 4, 2, '2024-03-11', NULL, 150, '2024-03-11 19:38:17', NULL, NULL),
(54, 5, 2, '2024-03-11', NULL, 170, '2024-03-11 19:38:17', NULL, NULL),
(55, 6, 2, '2024-03-11', NULL, 500, '2024-03-11 19:38:17', NULL, NULL),
(56, 1, 13, '2024-03-11', NULL, 80, '2024-03-11 19:38:17', NULL, NULL),
(57, 3, 13, '2024-03-11', NULL, 150, '2024-03-11 19:38:17', NULL, NULL),
(58, 4, 13, '2024-03-11', NULL, 120, '2024-03-11 19:38:17', NULL, NULL),
(59, 5, 13, '2024-03-11', NULL, 150, '2024-03-11 19:38:17', NULL, NULL),
(60, 6, 13, '2024-03-11', NULL, 400, '2024-03-11 19:38:17', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type_id` int NOT NULL DEFAULT '6',
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `booking_counter` int NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `fk_users_user_types1_idx` (`user_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `whatsapp`, `user_type_id`, `is_admin`, `is_active`, `booking_counter`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', 'admin@alraqy.com', NULL, NULL, 1, 1, 1, 0, NULL, '$2y$12$Xxl62N8qAVnGVCAgWl0J2O00MKdEAbV3Owk9XTTua9Hy.609OBW.C', NULL, NULL, NULL, NULL),
(2, 'seo', 'seo@alraqy.com', NULL, NULL, 5, 1, 1, 0, NULL, '$2y$12$Xxl62N8qAVnGVCAgWl0J2O00MKdEAbV3Owk9XTTua9Hy.609OBW.C', NULL, NULL, NULL, NULL),
(6, 'Emad Kerhily', 'ekarhilli@gmail.com', '6565654546', '76676', 3, 0, 0, 2, NULL, '$2y$12$SjbFCHu2Wvyytx5h0LfwCOUwMBAbHNFFl3llApLsRGPgMTz3o/sT2', NULL, '2024-03-10 09:31:15', '2024-03-13 17:45:43', '2024-03-13 17:45:43'),
(7, 'Emad Kerhily', 'ekarhilli@hotmail.com', '011234567', NULL, 6, 0, 0, 0, NULL, '$2y$12$JGDD.rrqzYNBP6VwAMjTXuT9rh99UCnajx0Hu/dWbivfFtk6wszcK', NULL, '2024-03-10 09:50:16', '2024-03-10 10:50:58', '2024-03-10 10:50:58'),
(8, 'Emad Kerhily', 'ekarhilli@yahoo.com', '+7888888888', NULL, 4, 0, 0, 0, NULL, '$2y$12$kd719.fyoWHi2QmnMgvUL.RsntOrFZvLWRvvTKEi3tPLQP2uzxMqC', NULL, '2024-03-10 09:51:37', '2024-03-10 10:47:01', '2024-03-10 10:47:01');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

DROP TABLE IF EXISTS `user_types`;
CREATE TABLE IF NOT EXISTS `user_types` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'e.g: admin,driver,partner,user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'driver'),
(6, 'guest'),
(3, 'partner'),
(5, 'seo'),
(4, 'user');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `additional_info`
--
ALTER TABLE `additional_info`
  ADD CONSTRAINT `fk_additional_info_bookings1` FOREIGN KEY (`bookings_id`) REFERENCES `bookings` (`id`);

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `blogs_states` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `blogs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `fk_bookings_sites_prices1` FOREIGN KEY (`site_price_id`) REFERENCES `sites_prices` (`id`),
  ADD CONSTRAINT `fk_bookings_trips_prices1` FOREIGN KEY (`trip_price_id`) REFERENCES `trips_prices` (`id`),
  ADD CONSTRAINT `fk_bookings_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `fk_cars_cars_categories1` FOREIGN KEY (`car_category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `fk_cars_users1` FOREIGN KEY (`driver_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `fk_Payment_bookings1` FOREIGN KEY (`bookings_id`) REFERENCES `bookings` (`id`),
  ADD CONSTRAINT `fk_Payment_Payment_methods1` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`),
  ADD CONSTRAINT `fk_payment_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `sightseeings`
--
ALTER TABLE `sightseeings`
  ADD CONSTRAINT `fk_Sightseeings_categories1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `sites_prices`
--
ALTER TABLE `sites_prices`
  ADD CONSTRAINT `fk_cars_has_Sightseeings_cars1` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`),
  ADD CONSTRAINT `fk_cars_has_Sightseeings_Sightseeings1` FOREIGN KEY (`sightseeing_id`) REFERENCES `sightseeings` (`id`);

--
-- Constraints for table `trips_prices`
--
ALTER TABLE `trips_prices`
  ADD CONSTRAINT `fk_trips_prices_cars1` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_trips_prices_trips1` FOREIGN KEY (`trip_id`) REFERENCES `trips` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_user_types1` FOREIGN KEY (`user_type_id`) REFERENCES `user_types` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
