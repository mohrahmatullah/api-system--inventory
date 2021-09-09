-- Adminer 4.8.1 MySQL 8.0.26 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1,	'Food',	NULL,	NULL),
(2,	'Drink',	NULL,	NULL),
(3,	'Dessert',	NULL,	NULL);

DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `customers` (`id`, `nama`, `alamat`, `email`, `telepon`, `created_at`, `updated_at`) VALUES
(1,	'PT. Indofood Tbk',	'Pandelang',	'test@email.com',	'083876854003',	NULL,	NULL),
(2,	'PT. Daridanke Tbk',	'Pandelang',	'test@email.com',	'083876854003',	NULL,	NULL),
(3,	'PT. ABC Tbk',	'Pandelang',	'test@email.com',	'083876854003',	NULL,	NULL),
(4,	'PT. Jartawi Tbk',	'Pandelang',	'test@email.com',	'083876854003',	NULL,	NULL);

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'2014_10_12_000000_create_users_table',	1),
(2,	'2014_10_12_100000_create_password_resets_table',	1),
(3,	'2018_12_18_035002_create_customers_table',	1),
(4,	'2018_12_18_035015_create_sales_table',	1),
(5,	'2018_12_18_035038_create_suppliers_table',	1),
(6,	'2018_12_18_041830_create_categories_table',	1),
(7,	'2018_12_18_042809_create_products_table',	1),
(8,	'2018_12_18_043146_create_product_masuk_table',	1),
(9,	'2018_12_18_043233_create_product_keluar_table',	1),
(10,	'2018_12_19_044911_add_field_role_to_table_users',	1),
(11,	'2019_08_19_000000_create_failed_jobs_table',	1),
(12,	'2019_12_14_000001_create_personal_access_tokens_table',	1);

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
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

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1,	'App\\Models\\User',	1,	'authToken',	'64739487342eec1702eb4f72a4e5d8d08d29b5da692df60ea346069ceb61ec4e',	'[\"*\"]',	NULL,	'2021-09-08 06:14:05',	'2021-09-08 06:14:05'),
(2,	'App\\Models\\User',	1,	'authToken',	'e98e7d9eb34f3e204b23932319e06c4615cda7e4b14cf77f699714f6f7920e26',	'[\"*\"]',	NULL,	'2021-09-08 06:17:00',	'2021-09-08 06:17:00'),
(3,	'App\\Models\\User',	1,	'authToken',	'954ce607b48d2e6cb6836db39e24025af25b0aa141256cf84b68500165a3e0ac',	'[\"*\"]',	NULL,	'2021-09-08 06:18:31',	'2021-09-08 06:18:31'),
(4,	'App\\Models\\User',	1,	'authToken',	'0b0a5f0176072e100a0400e89979dffc8a5fa168e9b40e77f4361be49c21ca09',	'[\"*\"]',	NULL,	'2021-09-08 06:30:21',	'2021-09-08 06:30:21'),
(5,	'App\\Models\\User',	2,	'authToken',	'b4937214402338c155e9a8dfeb87bc7579db1e15cde0a73e7074bb958ef45a3e',	'[\"*\"]',	NULL,	'2021-09-08 06:38:00',	'2021-09-08 06:38:00'),
(6,	'App\\Models\\User',	1,	'authToken',	'9f206a42006dc57d12151c7ec19efe471d0d4ca88dcd75a3fba7019df4ebe750',	'[\"*\"]',	NULL,	'2021-09-08 06:38:26',	'2021-09-08 06:38:26'),
(7,	'App\\Models\\User',	1,	'authToken',	'6dbf70e715943ae487a87396c473c1128070eb31e16f923a8908cd82b0bde86a',	'[\"*\"]',	'2021-09-08 07:44:16',	'2021-09-08 07:29:08',	'2021-09-08 07:44:16'),
(8,	'App\\Models\\User',	1,	'authToken',	'b975ee124b1710eb5451190d43ce49974dc8e1a87ae84efbeca4de59979af3ac',	'[\"*\"]',	'2021-09-08 07:54:15',	'2021-09-08 07:47:59',	'2021-09-08 07:54:15'),
(9,	'App\\Models\\User',	1,	'authToken',	'2954bb0db24fbe0aac288fb393c3e8e9bd7a17ac2037e4a1e7b38dbd37101d63',	'[\"*\"]',	NULL,	'2021-09-08 07:48:36',	'2021-09-08 07:48:36'),
(10,	'App\\User',	1,	'authToken',	'652003c3807491768ce50e7e413c240880f92b54d0973759664a53e85c279900',	'[\"*\"]',	NULL,	'2021-09-08 07:54:38',	'2021-09-08 07:54:38'),
(11,	'App\\User',	1,	'authToken',	'fd16453b9b679857c254eae454587b9f16d27400293e252f870255c7fed234ca',	'[\"*\"]',	NULL,	'2021-09-08 07:55:45',	'2021-09-08 07:55:45'),
(12,	'App\\Models\\User',	1,	'authToken',	'abb6485a4ca7a1b8d0162282ee7fa7d85c465d9db251b0e8ef39c719d2d61f67',	'[\"*\"]',	'2021-09-08 08:16:26',	'2021-09-08 07:59:54',	'2021-09-08 08:16:26'),
(13,	'App\\Models\\User',	1,	'authToken',	'ac170cd2a6cc6f47817878491902637330eb5e11a72cf683b1b7107d3b8652a2',	'[\"*\"]',	'2021-09-08 08:18:24',	'2021-09-08 08:17:55',	'2021-09-08 08:18:24'),
(14,	'App\\Models\\User',	1,	'authToken',	'fa5be52f1a7fef7a9c3d83a152051528d4777a330f350125215862748b7bdad4',	'[\"*\"]',	'2021-09-09 00:46:40',	'2021-09-08 08:18:56',	'2021-09-09 00:46:40'),
(15,	'App\\Models\\User',	1,	'authToken',	'6deb113a7f19a932e2c4daf61145c42a2c3b61613e13a750f3f7fd3ba9263cc3',	'[\"*\"]',	NULL,	'2021-09-09 00:46:32',	'2021-09-09 00:46:32');

DROP TABLE IF EXISTS `product_keluar`;
CREATE TABLE `product_keluar` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int unsigned NOT NULL,
  `customer_id` int unsigned NOT NULL,
  `qty` int NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_keluar_product_id_foreign` (`product_id`),
  KEY `product_keluar_customer_id_foreign` (`customer_id`),
  CONSTRAINT `product_keluar_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_keluar_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `product_masuk`;
CREATE TABLE `product_masuk` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int unsigned NOT NULL,
  `supplier_id` int unsigned NOT NULL,
  `qty` int NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_masuk_product_id_foreign` (`product_id`),
  KEY `product_masuk_supplier_id_foreign` (`supplier_id`),
  CONSTRAINT `product_masuk_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_masuk_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `product_masuk` (`id`, `product_id`, `supplier_id`, `qty`, `status`, `tanggal`, `created_at`, `updated_at`) VALUES
(1,	1,	1,	3,	'0',	'2021-09-28',	NULL,	NULL);

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int unsigned NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `products` (`id`, `category_id`, `nama`, `harga`, `image`, `qty`, `created_at`, `updated_at`) VALUES
(1,	1,	'Ayam Mentah',	1800,	'/upload/products/ayam-mentah.jpg',	0,	'2021-09-08 12:00:24',	NULL),
(2,	3,	'Cake coklat',	2800,	'/upload/products/cake-coklat.jpg',	0,	NULL,	NULL),
(3,	2,	'Cendol',	20000,	'/upload/products/cendol.jpg',	0,	NULL,	NULL),
(4,	1,	'Donut Manis',	3800,	'/upload/products/donut-manis.jpg',	0,	NULL,	NULL);

DROP TABLE IF EXISTS `sales`;
CREATE TABLE `sales` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE `suppliers` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `suppliers` (`id`, `nama`, `alamat`, `email`, `telepon`, `created_at`, `updated_at`) VALUES
(1,	'PT. Indofood Tbk',	'Pandelang',	'test@email.com',	'083876854003',	NULL,	NULL),
(2,	'PT. Daridanke Tbk',	'Pandelang',	'test@email.com',	'083876854003',	NULL,	NULL),
(3,	'PT. ABC Tbk',	'Pandelang',	'test@email.com',	'083876854003',	NULL,	NULL),
(4,	'PT. Jartawi Tbk',	'Pandelang',	'test@email.com',	'083876854003',	NULL,	NULL);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','staff') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'staff',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1,	'admin',	'admin@email.com',	'$2y$10$4bwmW15vqne7iB9zr.eqgO2tlv4vDysqj3qDNQ9CeQFBHPEOIYrc.',	NULL,	NULL,	NULL,	'admin'),
(2,	'user',	'user@email.com',	'$2y$10$fl3umZFoLMACH1SqMhrW9uabtBlwUn.iOw8lYry.46Ir2EIfAS5e.',	NULL,	NULL,	NULL,	'staff');

-- 2021-09-09 00:55:21
