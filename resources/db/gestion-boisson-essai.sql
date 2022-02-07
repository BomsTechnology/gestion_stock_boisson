-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           5.7.33 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour gestion-boisson-essai
CREATE DATABASE IF NOT EXISTS `gestion-boisson-essai` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `gestion-boisson-essai`;

-- Listage de la structure de la table gestion-boisson-essai. customers
CREATE TABLE IF NOT EXISTS `customers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gestion-boisson-essai.customers : ~3 rows (environ)
DELETE FROM `customers`;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` (`id`, `name`, `contact`, `created_at`, `updated_at`) VALUES
	(1, 'marcelin', '456456456', '2022-01-12 15:08:09', '2022-01-12 15:08:10'),
	(3, 'papou', '455565656', '2022-01-18 13:29:48', '2022-01-22 18:29:35'),
	(5, 'Inconnu', '9999999999', '2022-01-25 13:54:29', '2022-01-25 13:54:29');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;

-- Listage de la structure de la table gestion-boisson-essai. drinks
CREATE TABLE IF NOT EXISTS `drinks` (
  `id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `quantity` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gestion-boisson-essai.drinks : ~6 rows (environ)
DELETE FROM `drinks`;
/*!40000 ALTER TABLE `drinks` DISABLE KEYS */;
INSERT INTO `drinks` (`id`, `name`, `price`, `quantity`, `created_at`, `updated_at`) VALUES
	('61e030fb72a99', '33 Export', 650, 10, '2022-01-13 14:02:35', '2022-01-13 14:02:35'),
	('61e034d0a1b97', 'Guiness Smoth', 650, 0, '2022-01-13 14:18:56', '2022-02-01 19:35:10'),
	('61e034f4d93ef', 'Grande Guiness', 1000, 4, '2022-01-13 14:19:32', '2022-01-13 14:19:32'),
	('61e15e8e5e5b3', 'Chill', 500, 10, '2022-01-14 11:29:18', '2022-01-14 11:29:18'),
	('61e15e9eac932', 'kadji', 650, 8, '2022-01-14 11:29:34', '2022-02-06 13:07:54'),
	('61e15eadba39f', 'petite Guiness', 1250, 8, '2022-01-14 11:29:49', '2022-02-06 12:59:58');
/*!40000 ALTER TABLE `drinks` ENABLE KEYS */;

-- Listage de la structure de la table gestion-boisson-essai. failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gestion-boisson-essai.failed_jobs : ~0 rows (environ)
DELETE FROM `failed_jobs`;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Listage de la structure de la table gestion-boisson-essai. inputs
CREATE TABLE IF NOT EXISTS `inputs` (
  `id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `provider_id` bigint(20) unsigned NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `inputs_user_id_foreign` (`user_id`),
  KEY `inputs_provider_id_foreign` (`provider_id`),
  CONSTRAINT `inputs_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `providers` (`id`),
  CONSTRAINT `inputs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gestion-boisson-essai.inputs : ~6 rows (environ)
DELETE FROM `inputs`;
/*!40000 ALTER TABLE `inputs` DISABLE KEYS */;
INSERT INTO `inputs` (`id`, `amount`, `user_id`, `provider_id`, `created_at`, `updated_at`) VALUES
	('61f009c6a95a1', 3250, NULL, 7, '2022-01-25', '2022-01-25'),
	('61f00cd64909a', 3250, NULL, 4, '2022-01-25', '2022-01-25'),
	('61f00d0aec12d', 1950, NULL, 4, '2022-01-25', '2022-01-25'),
	('61f010251a7ee', 3250, NULL, 7, '2022-01-25', '2022-01-25'),
	('61f2579769634', 12500, NULL, 1, '2022-01-27', '2022-01-27'),
	('61ffbf7a16012', 15000, NULL, 7, '2022-02-06', '2022-02-06');
/*!40000 ALTER TABLE `inputs` ENABLE KEYS */;

-- Listage de la structure de la table gestion-boisson-essai. migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gestion-boisson-essai.migrations : ~10 rows (environ)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2022_01_12_102828_create_customers_table', 1),
	(6, '2022_01_12_102913_create_providers_table', 1),
	(7, '2022_01_12_102934_create_outputs_table', 1),
	(8, '2022_01_12_102951_create_inputs_table', 1),
	(9, '2022_01_12_160112_create_drinks_table', 2),
	(10, '2022_01_12_161021_create_moves_table', 2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Listage de la structure de la table gestion-boisson-essai. moves
CREATE TABLE IF NOT EXISTS `moves` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `quantity` bigint(20) NOT NULL,
  `price` double NOT NULL,
  `drink_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `move_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `move_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_moves_drinks` (`drink_id`),
  CONSTRAINT `FK_moves_drinks` FOREIGN KEY (`drink_id`) REFERENCES `drinks` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gestion-boisson-essai.moves : ~15 rows (environ)
DELETE FROM `moves`;
/*!40000 ALTER TABLE `moves` DISABLE KEYS */;
INSERT INTO `moves` (`id`, `quantity`, `price`, `drink_id`, `move_id`, `move_type`, `created_at`, `updated_at`) VALUES
	(35, 5, 650, '61e15eadba39f', '61f009c6a95a1', 'App\\Models\\Input', '2022-02-06 13:43:43', NULL),
	(36, 10, 650, '61e15eadba39f', '61f009dbc56a0', 'App\\Models\\Output', NULL, NULL),
	(37, 5, 650, '61e15e9eac932', '61f00cd64909a', 'App\\Models\\Input', NULL, NULL),
	(38, 3, 650, '61e15eadba39f', '61f00d0aec12d', 'App\\Models\\Input', NULL, NULL),
	(39, 5, 650, '61e15eadba39f', '61f010251a7ee', 'App\\Models\\Input', NULL, NULL),
	(40, 5, 650, '61e15eadba39f', '61f01a8b9504f', 'App\\Models\\Output', NULL, NULL),
	(41, 5, 650, '61e15eadba39f', '61f0611776ac4', 'App\\Models\\Output', NULL, NULL),
	(42, 10, 1250, '61e15eadba39f', '61f2579769634', 'App\\Models\\Input', NULL, NULL),
	(43, 5, 1250, '61e15eadba39f', '61f825ab03b91', 'App\\Models\\Output', NULL, NULL),
	(44, 7, 1250, '61e15eadba39f', '61f98b0f347c9', 'App\\Models\\Output', NULL, NULL),
	(45, 6, 650, '61e034d0a1b97', '61f98b6e12035', 'App\\Models\\Output', NULL, NULL),
	(46, 12, 1250, '61e15eadba39f', '61ffbf7a16012', 'App\\Models\\Input', NULL, NULL),
	(47, 6, 650, '61e15e9eac932', '61ffbf935acd8', 'App\\Models\\Output', NULL, NULL),
	(48, 5, 1250, '61e15eadba39f', '61ffc64ddd520', 'App\\Models\\Output', NULL, NULL),
	(49, 1, 650, '61e15e9eac932', '61ffc82a17692', 'App\\Models\\Output', NULL, NULL);
/*!40000 ALTER TABLE `moves` ENABLE KEYS */;

-- Listage de la structure de la table gestion-boisson-essai. outputs
CREATE TABLE IF NOT EXISTS `outputs` (
  `id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `customer_id` bigint(20) unsigned NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `outputs_user_id_foreign` (`user_id`),
  KEY `outputs_customer_id_foreign` (`customer_id`),
  CONSTRAINT `outputs_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  CONSTRAINT `outputs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gestion-boisson-essai.outputs : ~9 rows (environ)
DELETE FROM `outputs`;
/*!40000 ALTER TABLE `outputs` DISABLE KEYS */;
INSERT INTO `outputs` (`id`, `amount`, `user_id`, `customer_id`, `created_at`, `updated_at`) VALUES
	('61f009dbc56a0', 6500, NULL, 1, '2022-01-25', '2022-01-25'),
	('61f01a8b9504f', 3250, NULL, 3, '2022-01-25', '2022-01-25'),
	('61f0611776ac4', 3250, NULL, 1, '2022-01-25', '2022-01-25'),
	('61f825ab03b91', 6250, NULL, 1, '2022-01-31', '2022-01-31'),
	('61f98b0f347c9', 8750, NULL, 1, '2022-02-01', '2022-02-01'),
	('61f98b6e12035', 3900, NULL, 1, '2022-02-01', '2022-02-01'),
	('61ffbf935acd8', 3900, NULL, 1, '2022-02-06', '2022-02-06'),
	('61ffc64ddd520', 6250, NULL, 1, '2022-02-06', '2022-02-06'),
	('61ffc82a17692', 650, NULL, 3, '2022-02-06', '2022-02-06');
/*!40000 ALTER TABLE `outputs` ENABLE KEYS */;

-- Listage de la structure de la table gestion-boisson-essai. password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gestion-boisson-essai.password_resets : ~0 rows (environ)
DELETE FROM `password_resets`;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Listage de la structure de la table gestion-boisson-essai. personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gestion-boisson-essai.personal_access_tokens : ~0 rows (environ)
DELETE FROM `personal_access_tokens`;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Listage de la structure de la table gestion-boisson-essai. providers
CREATE TABLE IF NOT EXISTS `providers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gestion-boisson-essai.providers : ~7 rows (environ)
DELETE FROM `providers`;
/*!40000 ALTER TABLE `providers` DISABLE KEYS */;
INSERT INTO `providers` (`id`, `name`, `contact`, `created_at`, `updated_at`) VALUES
	(1, 'sigha', '695456465', '2022-01-12 15:10:10', '2022-01-12 15:10:11'),
	(4, 'Kemayo', '895645', '2022-01-14 13:54:26', '2022-01-14 13:54:26'),
	(5, 'louis', '12312', '2022-01-14 13:54:42', '2022-01-14 13:54:42'),
	(6, 'paul', '1231', '2022-01-14 13:54:49', '2022-01-14 13:54:49'),
	(7, 'thomas', '12312315', '2022-01-14 13:54:58', '2022-01-14 13:54:58'),
	(8, 'zoomo', '10000', '2022-01-14 16:02:17', '2022-01-22 18:29:03'),
	(9, 'caca', '345', '2022-01-14 16:07:21', '2022-01-22 18:28:55');
/*!40000 ALTER TABLE `providers` ENABLE KEYS */;

-- Listage de la structure de la table gestion-boisson-essai. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gestion-boisson-essai.users : ~1 rows (environ)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'boms', 'boms@technology.com', '2022-01-12 12:24:29', '$2y$10$o2WvtZTtIs8dAjCI.JG7R.CsLn9kh4kGVZjPPLBGbwK8yiWZJB5p2', NULL, '2022-01-12 11:24:18', '2022-01-12 11:24:18'),
	(2, 'Kemayo Denis', 'gims@boms.dens', NULL, '$2y$10$EjDPJZKdeUDE2y2TUjHNqeAezfBYPhzBkpg9r4Jib/DmlLzuCBZQa', NULL, '2022-02-07 09:01:30', '2022-02-07 09:01:30');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
