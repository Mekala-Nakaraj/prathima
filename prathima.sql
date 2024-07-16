-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;



-- Dumping structure for table prathima.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table prathima.failed_jobs: ~0 rows (approximately)
DELETE FROM `failed_jobs`;

-- Dumping structure for table prathima.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table prathima.migrations: ~5 rows (approximately)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2024_07_03_094726_create_user_kycs_table', 2);

-- Dumping structure for table prathima.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table prathima.password_reset_tokens: ~0 rows (approximately)
DELETE FROM `password_reset_tokens`;

-- Dumping structure for table prathima.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table prathima.personal_access_tokens: ~0 rows (approximately)
DELETE FROM `personal_access_tokens`;

-- Dumping structure for table prathima.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `user_type` varchar(50) DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pincode` varchar(20) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `gas_bill_path` varchar(255) DEFAULT NULL,
  `salary_slip_path` varchar(255) DEFAULT NULL,
  `gas_bill_number` varchar(255) DEFAULT NULL,
  `salary_slip_number` varchar(255) DEFAULT NULL,
  `gas_bill` varchar(255) DEFAULT NULL,
  `salary_slip` varchar(255) DEFAULT NULL,
  `otp` varchar(6) DEFAULT NULL,
  `otp_expires_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `phone_number` (`phone_number`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table prathima.users: ~5 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `name`, `email`, `phone_number`, `email_verified_at`, `password`, `remember_token`, `user_type`, `created_at`, `updated_at`, `pincode`, `city`, `district`, `state`, `country`, `gas_bill_path`, `salary_slip_path`, `gas_bill_number`, `salary_slip_number`, `gas_bill`, `salary_slip`, `otp`, `otp_expires_at`) VALUES
	(1, 'admin', 'admin@gmail.com', '9789325262', NULL, '$2y$12$3G9.O76ll.boJISG9JlDwOx8XVr1ylWHEAmL9Eoi4wBPOh7OgrnHi', NULL, 'admin', '2024-07-05 22:54:48', '2024-07-10 06:16:48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '398152', '2024-07-06 04:16:19'),
	(2, 'Dinesh', 'dinesh@gmail.com', '1234567890', NULL, '$2y$12$3G9.O76ll.boJISG9JlDwOx8XVr1ylWHEAmL9Eoi4wBPOh7OgrnHi', NULL, 'user', '2024-07-05 04:53:25', '2024-07-06 04:14:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '671187', '2024-07-06 04:24:21'),
	(6, 'logesh', 'logesh@gmail.com', '7708080885', NULL, '$2y$12$FR3fHLRwEt0m25MjMIl7AOP5YWXo.E0Ue3Chv8dTpwzM8YtXaul72', NULL, 'user', '2024-07-05 04:56:05', '2024-07-09 09:55:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '759935', '2024-07-06 05:51:28'),
	(7, 'dinesh21', 'dinesh21@gmail.com', '7708080882', NULL, '$2y$12$BgUxffKq0MMnNG6BMS2AQuSXjZ1Cg82QGIZcinkW1ICJRyqxu/.Oa', NULL, 'user', '2024-07-05 07:35:11', '2024-07-09 09:54:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-06 06:50:20'),
	(17, 'Nandhanas', 'nandhanag99@gmail.com', '9876512340', NULL, '$2y$12$b0mU0Bge6dmaUK7QWWZFouY3Hpvs0Ii2BFAioPlPGgg9Zlgejo.kO', NULL, 'user', '2024-07-07 22:54:01', '2024-07-07 23:01:02', '625521', 'Theni', 'Theni', 'Tamil Nadu', 'Inida', 'gas_bills/of4zfl9kG3bSYwP4p6nfexPI0qndGlpXwekEqmoC.pdf', 'salary_slips/eYkth0K6zsK7VRDI2AbTN5qn1xKXmpxkiyqQud1O.pdf', 'HJFFSDERT67', 'ZDFXGCH2345678', NULL, NULL, NULL, '2024-07-07 23:08:32');

-- Dumping structure for table prathima.user_kycs
CREATE TABLE IF NOT EXISTS `user_kycs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'success',
  `aadhar_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pan_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ifsc_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table prathima.user_kycs: ~2 rows (approximately)
DELETE FROM `user_kycs`;
INSERT INTO `user_kycs` (`id`, `user_id`, `status`, `aadhar_number`, `pan_number`, `account_number`, `ifsc_code`, `is_verified`, `created_at`, `updated_at`) VALUES
	(1, 1, 'success', '547575707305', 'GLQPD4636C', '4016108004294', 'CNRB0004016', 1, '2024-07-10 03:23:25', '2024-07-10 03:23:25'),
	(2, 6, 'Rejected', '547575707350', 'GLQPD463C6', '3527101004123', 'CNRB0003527', 1, '2024-07-10 03:39:32', '2024-07-10 03:48:16');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
