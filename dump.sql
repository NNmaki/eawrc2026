-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 17.04.2026 klo 14:35
-- Palvelimen versio: 8.0.45-0ubuntu0.24.04.1
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eawrc2026_db`
--

-- --------------------------------------------------------

--
-- Rakenne taululle `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Rakenne taululle `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Rakenne taululle `events`
--

CREATE TABLE `events` (
  `id` bigint UNSIGNED NOT NULL,
  `rally_id` bigint UNSIGNED NOT NULL,
  `player_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` datetime NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `total_time` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Rakenne taululle `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Rakenne taululle `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Rakenne taululle `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Rakenne taululle `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vedos taulusta `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(8, '0001_01_01_000000_create_users_table', 1),
(9, '0001_01_01_000001_create_cache_table', 1),
(10, '0001_01_01_000002_create_jobs_table', 1),
(11, '2026_04_17_133423_create_rallies_table', 1),
(12, '2026_04_17_133513_create_stages_table', 1),
(13, '2026_04_17_133523_create_events_table', 1),
(14, '2026_04_17_133530_create_stage_times_table', 1);

-- --------------------------------------------------------

--
-- Rakenne taululle `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Rakenne taululle `rallies`
--

CREATE TABLE `rallies` (
  `id` bigint UNSIGNED NOT NULL,
  `rally_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_distance` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vedos taulusta `rallies`
--

INSERT INTO `rallies` (`id`, `rally_name`, `country`, `total_distance`, `created_at`, `updated_at`) VALUES
(1, 'Rally Croatia', 'Croatia', NULL, NULL, NULL),
(2, 'Rally Croatia', 'Croatia', NULL, NULL, NULL),
(3, 'Rally Estonia', 'Estonia', NULL, NULL, NULL),
(4, 'Central European Rally', 'Czech Republic', NULL, NULL, NULL),
(5, 'Rally Finland', 'Finland', NULL, NULL, NULL),
(6, 'EKO Acropolis Rally Greece', 'Greece', NULL, NULL, NULL),
(7, 'Forum8 Rally Japan', 'Japan', NULL, NULL, NULL),
(8, 'Safari Rally Kenya', 'Kenya', NULL, NULL, NULL),
(9, 'Rally Guanajuato México', 'Mexico', NULL, NULL, NULL),
(10, 'Rallye Monte-Carlo', 'Monaco', NULL, NULL, NULL),
(11, 'Vodafone Rally de Portugal', 'Portugal', NULL, NULL, NULL),
(12, 'Rally Italia Sardegna', 'Italy', NULL, NULL, NULL),
(13, 'Rally Sweden', 'Sweden', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Rakenne taululle `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Rakenne taululle `stages`
--

CREATE TABLE `stages` (
  `id` bigint UNSIGNED NOT NULL,
  `rally_id` bigint UNSIGNED NOT NULL,
  `stage_number` int NOT NULL,
  `stage_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `distance_km` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vedos taulusta `stages`
--

INSERT INTO `stages` (`id`, `rally_id`, `stage_number`, `stage_name`, `distance_km`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'Stojdraga', 10.24, '2026-04-17 11:35:12', '2026-04-17 11:35:12'),
(2, 2, 2, 'Hartje', 7.79, '2026-04-17 11:35:12', '2026-04-17 11:35:12'),
(3, 2, 3, 'Krašić', 8.77, '2026-04-17 11:35:12', '2026-04-17 11:35:12'),
(4, 3, 1, 'Nüpli', 8.60, '2026-04-17 11:35:12', '2026-04-17 11:35:12'),
(5, 3, 2, 'Koigu', 8.47, '2026-04-17 11:35:12', '2026-04-17 11:35:12'),
(6, 3, 3, 'Vahessaare', 8.60, '2026-04-17 11:35:12', '2026-04-17 11:35:12'),
(7, 3, 4, 'Vissi', 11.82, '2026-04-17 11:35:12', '2026-04-17 11:35:12'),
(8, 4, 1, 'Vítová', 8.77, '2026-04-17 11:35:12', '2026-04-17 11:35:12'),
(9, 4, 2, 'Líbošvary', 14.73, '2026-04-17 11:35:12', '2026-04-17 11:35:12'),
(10, 4, 3, 'Osičko', 8.94, '2026-04-17 11:35:12', '2026-04-17 11:35:12'),
(11, 5, 1, 'Honkanen', 10.41, '2026-04-17 11:35:12', '2026-04-17 11:35:12'),
(12, 5, 2, 'Vehmas', 12.57, '2026-04-17 11:35:12', '2026-04-17 11:35:12'),
(13, 5, 3, 'Saakoski', 4.83, '2026-04-17 11:35:12', '2026-04-17 11:35:12'),
(14, 5, 4, 'Painaa', 6.41, '2026-04-17 11:35:12', '2026-04-17 11:35:12'),
(15, 6, 1, 'Mariolata', 13.51, '2026-04-17 11:35:12', '2026-04-17 11:35:12'),
(16, 6, 2, 'Viniani', 11.12, '2026-04-17 11:35:12', '2026-04-17 11:35:12'),
(17, 6, 3, 'Parnassos', 5.57, '2026-04-17 11:35:12', '2026-04-17 11:35:12'),
(18, 6, 4, 'Drosochori', 8.68, '2026-04-17 11:35:12', '2026-04-17 11:35:12'),
(19, 7, 1, 'Oninokotaira', 11.38, '2026-04-17 11:35:12', '2026-04-17 11:35:12'),
(20, 7, 2, 'Habu Dam', 10.27, '2026-04-17 11:35:12', '2026-04-17 11:35:12'),
(21, 7, 3, 'Higashino', 6.96, '2026-04-17 11:35:12', '2026-04-17 11:35:12'),
(22, 7, 4, 'Nenoue Highlands', 6.81, '2026-04-17 11:35:12', '2026-04-17 11:35:12'),
(23, 8, 1, 'Moi North', 5.46, '2026-04-17 11:35:12', '2026-04-17 11:35:12'),
(24, 8, 2, 'Wileli', 4.92, '2026-04-17 11:35:12', '2026-04-17 11:35:12'),
(25, 8, 3, 'Sugunoi', 9.74, '2026-04-17 11:35:12', '2026-04-17 11:35:12'),
(26, 8, 4, 'Kanyawa', 10.70, '2026-04-17 11:35:12', '2026-04-17 11:35:12'),
(27, 9, 1, 'Ortega', 13.10, '2026-04-17 11:35:12', '2026-04-17 11:35:12'),
(28, 9, 2, 'Ibarrilla', 12.92, '2026-04-17 11:35:12', '2026-04-17 11:35:12'),
(29, 9, 3, 'Alfaro', 8.00, '2026-04-17 11:35:12', '2026-04-17 11:35:12'),
(30, 10, 1, 'La Bollène Vésubie - Col De Turini', 9.21, '2026-04-17 11:35:12', '2026-04-17 11:35:12'),
(31, 10, 2, 'La Maïris', 9.30, '2026-04-17 11:35:12', '2026-04-17 11:35:12'),
(32, 10, 3, 'La Moissière', 8.18, '2026-04-17 11:35:12', '2026-04-17 11:35:12'),
(33, 10, 4, 'Ravin de Coste Belle', 8.60, '2026-04-17 11:35:12', '2026-04-17 11:35:12'),
(34, 11, 1, 'Fridão', 16.72, '2026-04-17 11:35:12', '2026-04-17 11:35:12'),
(35, 11, 2, 'Touca', 7.51, '2026-04-17 11:35:12', '2026-04-17 11:35:12'),
(36, 11, 3, 'Carrazedo de Montenegro', 7.48, '2026-04-17 11:35:12', '2026-04-17 11:35:12'),
(37, 12, 1, 'Littichedda', 13.30, '2026-04-17 11:35:12', '2026-04-17 11:35:12'),
(38, 12, 2, 'Bortigiadas', 9.02, '2026-04-17 11:35:12', '2026-04-17 11:35:12'),
(39, 12, 3, 'Monte Muvri', 7.51, '2026-04-17 11:35:12', '2026-04-17 11:35:12'),
(40, 13, 1, 'Spikbrenna', 11.07, '2026-04-17 11:35:12', '2026-04-17 11:35:12'),
(41, 13, 2, 'Åslia', 10.39, '2026-04-17 11:35:12', '2026-04-17 11:35:12'),
(42, 13, 3, 'Älgsjön', 3.37, '2026-04-17 11:35:12', '2026-04-17 11:35:12'),
(43, 13, 4, 'Stora Jangen', 4.86, '2026-04-17 11:35:12', '2026-04-17 11:35:12');

-- --------------------------------------------------------

--
-- Rakenne taululle `stage_times`
--

CREATE TABLE `stage_times` (
  `id` bigint UNSIGNED NOT NULL,
  `event_id` bigint UNSIGNED NOT NULL,
  `stage_id` bigint UNSIGNED NOT NULL,
  `time_result` time NOT NULL,
  `recorded_at` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Rakenne taululle `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_rally_id_index` (`rally_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
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
-- Indexes for table `rallies`
--
ALTER TABLE `rallies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `stages`
--
ALTER TABLE `stages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stages_rally_id_index` (`rally_id`);

--
-- Indexes for table `stage_times`
--
ALTER TABLE `stage_times`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `stage_times_event_id_stage_id_unique` (`event_id`,`stage_id`),
  ADD KEY `stage_times_event_id_index` (`event_id`),
  ADD KEY `stage_times_stage_id_index` (`stage_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `rallies`
--
ALTER TABLE `rallies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `stages`
--
ALTER TABLE `stages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `stage_times`
--
ALTER TABLE `stage_times`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Rajoitteet vedostauluille
--

--
-- Rajoitteet taululle `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_rally_id_foreign` FOREIGN KEY (`rally_id`) REFERENCES `rallies` (`id`) ON DELETE CASCADE;

--
-- Rajoitteet taululle `stages`
--
ALTER TABLE `stages`
  ADD CONSTRAINT `stages_rally_id_foreign` FOREIGN KEY (`rally_id`) REFERENCES `rallies` (`id`) ON DELETE CASCADE;

--
-- Rajoitteet taululle `stage_times`
--
ALTER TABLE `stage_times`
  ADD CONSTRAINT `stage_times_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stage_times_stage_id_foreign` FOREIGN KEY (`stage_id`) REFERENCES `stages` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
