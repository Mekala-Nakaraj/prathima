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
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table prathima.failed_jobs: ~0 rows (approximately)
DELETE FROM `failed_jobs`;

-- Dumping structure for table prathima.loans
CREATE TABLE IF NOT EXISTS `loans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `loan_id` bigint unsigned NOT NULL,
  `interest_rate` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved_loan_amount` decimal(12,2) NOT NULL,
  `start_date` date NOT NULL,
  `due_date` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `agreement` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table prathima.loans: ~3 rows (approximately)
DELETE FROM `loans`;
INSERT INTO `loans` (`id`, `loan_id`, `interest_rate`, `approved_loan_amount`, `start_date`, `due_date`, `agreement`, `created_at`, `updated_at`) VALUES
	(1, 2, '12.00', 10000.00, '2024-07-12', '2024-07-21', 'test2', '2024-07-13 04:14:37', '2024-07-13 05:17:29'),
	(2, 1, '"[\\"1\\",\\"2\\",\\"3\\",\\"4\\"]"', 10000.00, '2024-07-07', '"[\\"15\\",\\"30\\",\\"90\\",\\"120\\"]"', 'Test 2', '2024-07-15 01:40:21', '2024-07-17 01:07:00'),
	(3, 27, '10.00', 2000.00, '2024-07-16', '2024-07-31', 'test', '2024-07-15 02:02:33', '2024-07-15 02:02:33');

-- Dumping structure for table prathima.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table prathima.password_reset_tokens: ~0 rows (approximately)
DELETE FROM `password_reset_tokens`;

-- Dumping structure for table prathima.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
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

-- Dumping structure for table prathima.settings
CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table prathima.settings: ~15 rows (approximately)
DELETE FROM `settings`;
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
	(1, 'MAIL_MAILER', 'smtp', '2024-07-15 04:49:21', '2024-07-15 05:09:44'),
	(2, 'MAIL_HOST', 'smtp.gmail.com', '2024-07-15 04:49:21', '2024-07-15 05:09:44'),
	(3, 'MAIL_PORT', '465', '2024-07-15 04:49:21', '2024-07-15 05:09:45'),
	(4, 'MAIL_USERNAME', 'v4inspire.official@gmail.com', '2024-07-15 04:49:21', '2024-07-15 05:09:45'),
	(5, 'MAIL_PASSWORD', 'rriq hhkv bzhe mosk', '2024-07-15 04:49:21', '2024-07-15 05:09:45'),
	(6, 'MAIL_ENCRYPTION', 'ssl', '2024-07-15 04:49:21', '2024-07-15 05:09:45'),
	(7, 'MAIL_FROM_ADDRESS', 'v4inspire.official@gmail.com', '2024-07-15 04:49:21', '2024-07-15 05:09:45'),
	(8, 'MAIL_FROM_NAME', 'Prathima', '2024-07-15 04:49:21', '2024-07-15 05:49:49'),
	(10, 'SMS_GATEWAY_URL', 'HJGJFJFTHR', '2024-07-16 00:06:36', '2024-07-16 00:06:36'),
	(11, 'SMS_API_KEY', 'HGFTRHTR', '2024-07-16 00:06:37', '2024-07-16 00:06:37'),
	(12, 'SMS_SENDER_ID', 'GFDHUK', '2024-07-16 00:06:38', '2024-07-16 00:06:38'),
	(13, 'TEST_PHONE_NUMBER', '9876543210', '2024-07-16 00:06:38', '2024-07-16 00:15:51'),
	(14, 'initial_loan_amount', '10000', '2024-07-16 00:24:02', '2024-07-16 00:24:02'),
	(15, 'initial_interest_rate', '21', '2024-07-16 00:24:03', '2024-07-16 00:24:03'),
	(16, 'loan_paid_date', '21', '2024-07-16 00:24:03', '2024-07-16 00:34:55');

-- Dumping structure for table prathima.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `user_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pincode` varchar(20) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `otp` varchar(6) DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `house_type` varchar(50) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `company_email` varchar(255) DEFAULT NULL,
  `company_location` varchar(255) DEFAULT NULL,
  `otp_expires_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `phone_number` (`phone_number`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table prathima.users: ~3 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `name`, `email`, `phone_number`, `email_verified_at`, `password`, `remember_token`, `user_type`, `created_at`, `updated_at`, `pincode`, `city`, `district`, `state`, `country`, `otp`, `gender`, `dob`, `address`, `house_type`, `company_name`, `company_email`, `company_location`, `otp_expires_at`) VALUES
	(1, 'admin', 'admin@gmail.com', '9789325262', NULL, '$2y$12$3G9.O76ll.boJISG9JlDwOx8XVr1ylWHEAmL9Eoi4wBPOh7OgrnHi', NULL, 'admin', '2024-07-05 22:54:48', '2024-07-10 06:16:48', NULL, NULL, NULL, NULL, NULL, '398152', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-06 04:16:19'),
	(2, 'Dinesh', 'dinesh@gmail.com', '1234567890', NULL, '$2y$12$3G9.O76ll.boJISG9JlDwOx8XVr1ylWHEAmL9Eoi4wBPOh7OgrnHi', NULL, 'field_manager', '2024-07-05 04:53:25', '2024-07-12 12:59:14', NULL, NULL, NULL, NULL, NULL, '671187', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-06 04:24:21'),
	(27, 'dinesh12', 'mpsdinesh1221@gmail.com', '987612340', NULL, '$2y$12$YP0Xk8TQ9OLWqSiaPP/ekO1LqS6wAKRXULsbl.xF45CQkQGNI2/Uy', NULL, 'relation_manager', '2024-07-15 01:53:47', '2024-07-15 07:24:13', NULL, NULL, NULL, NULL, NULL, '805158', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-15 07:34:13'),
	(28, 'logesh', 'logesh@gmail.com', '9876543210', NULL, '$2y$12$0UXYYwyVEs6UmknSFQgLNeiiqiYvugWz82vEBKNBPxA175zGaQ/iq', NULL, 'relation_manager', '2024-07-16 01:48:30', '2024-07-16 01:48:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Dumping structure for table prathima.users_loans
CREATE TABLE IF NOT EXISTS `users_loans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `loan_id` bigint unsigned NOT NULL,
  `agreed` tinyint(1) DEFAULT '0',
  `agreed_date` timestamp NULL DEFAULT NULL,
  `payment_transaction` enum('pending','processing','deposit') DEFAULT 'processing',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table prathima.users_loans: ~5 rows (approximately)
DELETE FROM `users_loans`;
INSERT INTO `users_loans` (`id`, `user_id`, `loan_id`, `agreed`, `agreed_date`, `payment_transaction`, `created_at`, `updated_at`) VALUES
	(1, 1, 101, 1, '2024-07-15 04:30:00', 'pending', '2024-07-15 05:55:18', '2024-07-15 05:55:18'),
	(2, 2, 102, 1, '2024-07-15 07:11:29', 'deposit', '2024-07-15 05:55:18', '2024-07-15 05:55:18'),
	(3, 3, 103, 1, '2024-07-15 06:30:00', 'processing', '2024-07-15 05:55:18', '2024-07-15 05:55:18'),
	(4, 4, 104, 0, NULL, 'processing', '2024-07-15 05:55:18', '2024-07-15 05:55:18'),
	(5, 5, 105, 0, '2024-07-15 08:30:00', 'processing', '2024-07-15 05:55:18', '2024-07-15 05:55:18');

-- Dumping structure for table prathima.user_kycs
CREATE TABLE IF NOT EXISTS `user_kycs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'success',
  `aadhar_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pan_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pan_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aadhar_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ifsc_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_tax_receipt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rental_agreements` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smart_card` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smart_card_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driving_license_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recent_gas_slip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recent_broadband_bill` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pay_slip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_card` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pf_member_passbook` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_holder_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `relationship_manager_verified` tinyint(1) DEFAULT '0',
  `field_manager_verified` tinyint(1) DEFAULT '0',
  `loan_amount` decimal(10,2) DEFAULT NULL,
  `reason` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table prathima.user_kycs: ~0 rows (approximately)
DELETE FROM `user_kycs`;
INSERT INTO `user_kycs` (`id`, `user_id`, `status`, `aadhar_number`, `pan_number`, `pan_file`, `aadhar_file`, `account_number`, `ifsc_code`, `bank_name`, `property_tax_receipt`, `rental_agreements`, `smart_card`, `smart_card_file`, `driving_license_file`, `recent_gas_slip`, `recent_broadband_bill`, `pay_slip`, `id_card`, `pf_member_passbook`, `account_holder_name`, `is_verified`, `created_at`, `updated_at`, `relationship_manager_verified`, `field_manager_verified`, `loan_amount`, `reason`) VALUES
	(1, 2, 'Verified', '484846876768', 'CIGPV2696K', NULL, NULL, '4016108004292', 'CNRB0004016', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-07-12 06:52:19', '2024-07-16 03:57:02', 1, 1, 5000.00, NULL),
	(2, 1, 'Verified', '484846876728', 'GLQPD4636C', NULL, NULL, '4016108004292', 'CNRB0004016', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-07-15 01:56:26', '2024-07-16 03:56:35', 1, 1, 700.00, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
