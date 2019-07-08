-- Adminer 4.4.0 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `image`, `created_at`, `updated_at`) VALUES
(1,	'Azeem Ahmad',	'azeem@firsteconomy.com',	'2019-07-01 09:39:28',	'$2y$10$36fRO7UtnV5jPXEenjNE6.qoUlBuvHJ5ZUe7m/yNd3utaGBQfPs2.',	'AjS9sgp7J901MFLpm7PCLpQKFvxDkeNRI9I0Vn2in0IWThmQZCh2ACawVyWl',	'x73CV67zaMdlckP9gKoP7ioxr2XwH00I.jpeg',	'2019-06-25 04:38:05',	'2019-07-01 09:11:57'),
(3,	'Azeem Ahmad',	'azeemahmad12345@gmail.com',	NULL,	'$2y$10$9eQPxVANnHvtdL6uBIEcSenn51JNVB8bR1NtOYpuD1FKrbfO1dgEy',	NULL,	NULL,	'2019-07-03 06:47:06',	'2019-07-03 06:47:06');

DROP TABLE IF EXISTS `admin_password_resets`;
CREATE TABLE `admin_password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `admin_password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'2014_10_12_000000_create_users_table',	1),
(2,	'2014_10_12_100000_create_password_resets_table',	1),
(3,	'2019_06_28_064638_create_posts_table',	2),
(4,	'2016_06_01_000001_create_oauth_auth_codes_table',	3),
(5,	'2016_06_01_000002_create_oauth_access_tokens_table',	3),
(6,	'2016_06_01_000003_create_oauth_refresh_tokens_table',	3),
(7,	'2016_06_01_000004_create_oauth_clients_table',	3),
(8,	'2016_06_01_000005_create_oauth_personal_access_clients_table',	3),
(10,	'2019_07_01_152405_create_permission_tables',	4),
(11,	'2019_07_08_124739_create_posts_table',	5);

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(1,	'App\\Admin',	3),
(2,	'App\\Admin',	3),
(3,	'App\\Admin',	3),
(9,	'App\\Admin',	3),
(17,	'App\\Admin',	3);

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles` (
  `role_id` int(10) unsigned NOT NULL,
  `model_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `model_has_roles` (`role_id`, `model_id`, `model_type`) VALUES
(1,	1,	'App\\Admin'),
(2,	3,	'App\\Admin');

DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('f7f456bc713bdcc4f4914d3d9dada359bfeae431c8ac4d3c9687b4d9a5a0297c1d04cadfeb45dabf',	1,	1,	'MyApp',	'[]',	0,	'2019-06-28 06:31:13',	'2019-06-28 06:31:13',	'2020-06-28 12:01:13');

DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE `oauth_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1,	NULL,	'Laravel Personal Access Client',	'STcOd9j7j50VzOoMh7BpQ0VtLAhUqC3GRB6wODPk',	'http://localhost',	1,	0,	0,	'2019-06-28 05:48:19',	'2019-06-28 05:48:19'),
(2,	NULL,	'Laravel Password Grant Client',	'Fde8WtJA6s2CgCxaFCm3oT8Lta0b7Jj0YWhP5jO4',	'http://localhost',	0,	1,	0,	'2019-06-28 05:48:19',	'2019-06-28 05:48:19');

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1,	1,	'2019-06-28 05:48:19',	'2019-06-28 05:48:19');

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1,	'view_posts',	'admin',	'2019-07-01 11:10:33',	'2019-07-01 11:10:33'),
(2,	'add_posts',	'admin',	'2019-07-01 11:10:33',	'2019-07-01 11:10:33'),
(3,	'edit_posts',	'admin',	'2019-07-01 11:10:33',	'2019-07-01 11:10:33'),
(4,	'delete_posts',	'admin',	'2019-07-01 11:10:33',	'2019-07-01 11:10:33'),
(9,	'view_roles',	'admin',	'2019-07-01 11:29:05',	'2019-07-01 11:29:05'),
(10,	'add_roles',	'admin',	'2019-07-01 11:29:05',	'2019-07-01 11:29:05'),
(11,	'edit_roles',	'admin',	'2019-07-01 11:29:05',	'2019-07-01 11:29:05'),
(12,	'delete_roles',	'admin',	'2019-07-01 11:29:05',	'2019-07-01 11:29:05'),
(17,	'view_users',	'admin',	'2019-07-03 06:31:28',	'2019-07-03 06:31:28'),
(18,	'add_users',	'admin',	'2019-07-03 06:31:28',	'2019-07-03 06:31:28'),
(19,	'edit_users',	'admin',	'2019-07-03 06:31:28',	'2019-07-03 06:31:28'),
(20,	'delete_users',	'admin',	'2019-07-03 06:31:28',	'2019-07-03 06:31:28');

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `posts` (`id`, `created_at`, `updated_at`, `deleted_at`, `title`, `description`, `status`) VALUES
(1,	'2019-07-08 07:21:31',	'2019-07-08 07:21:31',	NULL,	'My First Project',	'<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',	'1');

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1,	'Admin',	'admin',	'2019-07-01 11:09:19',	'2019-07-01 11:09:19'),
(2,	'User',	'admin',	'2019-07-01 11:53:36',	'2019-07-01 11:53:36');

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1,	1),
(2,	1),
(3,	1),
(4,	1),
(9,	1),
(10,	1),
(11,	1),
(12,	1),
(17,	1),
(18,	1),
(19,	1),
(20,	1),
(1,	2),
(2,	2),
(3,	2);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `token`, `created_at`, `updated_at`) VALUES
(1,	'Azeem Ahmad',	'azeem@firsteconomy.com',	'$2y$10$1q8/6SlAKVANNOX.na4nA.OLQDZlKiO37kq3tws1O56wJyK6cAufu',	'1UF7u0kWNVhmkx4vnK2Slsq6YtsGkVtXgC27C7WjhbyFnwWpASHDQCyCDs5u',	'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImY3ZjQ1NmJjNzEzYmRjYzRmNDkxNGQzZDlkYWRhMzU5YmZlYWU0MzFjOGFjNGQzYzk2ODdiNGQ5YTVhMDI5N2MxZDA0Y2FkZmViNDVkYWJmIn0.eyJhdWQiOiIxIiwianRpIjoiZjdmNDU2YmM3MTNiZGNjNGY0OTE0ZDNkOWRhZGEzNTliZmVhZTQzMWM4YWM0ZDNjOTY4N2I0ZDlhNWEwMjk3YzFkMDRjYWRmZWI0NWRhYmYiLCJpYXQiOjE1NjE3MjMyNzMsIm5iZiI6MTU2MTcyMzI3MywiZXhwIjoxNTkzMzQ1NjczLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.aYVgKjYqjhdAG5NHTLsXiT_OgfGqq4SwzChWwyZtO1l8OJ8rwXaDgqdEmd6Cct2bZvMBc8gyp_P2_z6rUyNciT_U6hrjS6GUh18H41Bx3yPOm5wIn8A2tfEodKDWBqpiye8OeNa66-knb15jIpz9zpB0TJcY3qvYy2iQi-Wq5bDJxzg0szyiUuMo2ieJal8W4gu26wCbuaF_4UWaNjTLBhrDNKuvL1QAfNcOXQa8PGPugfYTeQC2B2yv9awZA_xbazVNp7_D-3UzvstJw7mSGkRr7Ww9V2OTrzwGhkGrscKzttAdZavJ3zNvKNcjsi4wnC3AypeIAfky-01snWWPN2_GE9xbq4sB_72Hkl1e7k9mAa1-VKdKU5_MFJI10l84Mz6gk1BtGQpLoSiVLY6lv9a2zbleMQCp854QPTI2BdOgjQUAuX1NRsPUdV2tLh3tsVMYiP_6hPK0ywONlmI8nHZqhz_3tvMLbUifNj1XOSare7CcDLkz16T4RRMTZO6eca_DiXCcO4s9TXVlvjB5DbFwFzZYZz83WvE57DgYi84L8P0rTl7Nrmy96na2DvzLJifmMoldqWFMoSM-cpHviETNHRJjTNs4JBSkrDGo0Y_5fJ5vTc135B__oKn193Q34FRHLVGfWQAPjrnFMLIRAhsF_JLRQ4iuP0GACHLiq4s',	'2018-08-29 03:03:32',	'2019-06-28 06:31:13');

-- 2019-07-08 07:34:13
