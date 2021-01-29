-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 25, 2021 at 06:37 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dsw`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_super` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `is_super`, `created_at`, `updated_at`, `username`, `phone`, `role`, `event_id`) VALUES
(1, 'Riyan Satria', 'admin@gmail.com', '$2y$10$ecW7FbA2bniFk5q0IA.xKORmsa3285XhweQpblc7Px6YnnXxIe4a.', 1, NULL, NULL, 'haloriyan', '0881036183076', 'superadmin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `admin_roles`
--

CREATE TABLE `admin_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `actions` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_roles`
--

INSERT INTO `admin_roles` (`id`, `role`, `module`, `actions`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'admin', 'create,store,update,delete', '2021-01-02 06:33:27', '2021-01-02 06:33:27'),
(3, 'event', 'judge', 'view,create,store,edit,update,delete', '2021-01-04 02:24:35', '2021-01-04 02:24:35');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `icon`, `name`, `value`, `created_at`, `updated_at`) VALUES
(1, 'fab fa-facebook', 'Mark Zuckerberg', 'https://www.facebook.com/zuck', '2020-11-25 03:32:45', '2020-11-25 03:32:45');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rundown_id` bigint(20) UNSIGNED NOT NULL,
  `type_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requirements` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prize` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `rundown_id`, `type_id`, `title`, `description`, `requirements`, `prize`, `created_at`, `updated_at`) VALUES
(4, 1, 2, 'Workshop Python for Beginner', 'Kita akan belajar python dan cocok bagi pemula yang baru mulai belajar', 'Laptop non Kentang', 'PSP', '2021-01-06 05:03:52', '2021-01-06 05:03:52'),
(5, 2, 2, 'Workshop Python for Beginner jilid II', 'Belajar Python untuk pemula', 'Laptop Kentang', 'iPad Pro 2020', '2021-01-06 05:16:57', '2021-01-06 05:16:57'),
(6, 1, 2, 'Speak by Riyan', 'lorem ipsum', '18 Tahun', 'Supra', '2021-01-24 21:35:32', '2021-01-24 21:35:32');

-- --------------------------------------------------------

--
-- Table structure for table `events_speaker`
--

CREATE TABLE `events_speaker` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `events_id` bigint(20) UNSIGNED NOT NULL,
  `speaker_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events_type`
--

CREATE TABLE `events_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events_type`
--

INSERT INTO `events_type` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Roadshow', '2021-01-04 03:14:07', '2021-01-04 03:14:07');

-- --------------------------------------------------------

--
-- Table structure for table `event_types`
--

CREATE TABLE `event_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_types`
--

INSERT INTO `event_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Main Event', '2020-11-25 03:53:34', '2020-11-25 03:53:34'),
(3, 'Roadshow', '2020-11-25 03:53:44', '2020-11-25 03:57:43');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `created_at`, `updated_at`) VALUES
(1, 'Pertanyaannya begini', 'Harusnya dijawab begini', '2020-12-27 22:37:17', '2020-12-27 22:37:17');

-- --------------------------------------------------------

--
-- Table structure for table `judges`
--

CREATE TABLE `judges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `linkedin_profile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2020_11_05_144832_create_admins_table', 1),
(4, '2020_11_05_145724_create_faqs_table', 1),
(5, '2020_11_05_145729_create_contacts_table', 1),
(6, '2020_11_20_070125_create_sponsors_table', 2),
(7, '2020_11_25_103646_create_event_types_table', 3),
(8, '2020_11_26_072655_create_events_table', 4),
(9, '2020_11_26_072943_create_speakers_table', 5),
(10, '2020_11_26_133155_create_judges_table', 6),
(11, '2020_11_20_070124_create_sponsor_type_table', 7),
(12, '2020_12_10_160732_create_timelines_table', 7),
(13, '2020_12_10_161023_create_rundowns_table', 7),
(14, '2020_12_23_075424_alter_table_admins', 8),
(16, '2020_12_23_095434_alter_table_timeline', 9),
(17, '2020_12_23_095038_alter_table_rundown', 10),
(18, '2020_12_28_055119_create_ticket_types_table', 11),
(19, '2020_12_28_055148_create_tickets_table', 11),
(20, '2020_11_26_072535_create_events_type_table', 12),
(21, '2020_12_23_073205_create_events_speaker_table', 13),
(22, '2021_01_02_123318_create_admin_roles_table', 13),
(23, '2021_01_02_124704_alter_admins_table', 13),
(24, '2021_01_06_093748_alter_tickets_table', 14),
(25, '2021_01_06_100415_create_users_table', 15),
(28, '2021_01_06_104557_update_users_table', 15),
(29, '2021_01_06_115535_update_events_table', 16),
(30, '2021_01_07_114020_create_ticket_orders_table', 17),
(32, '2021_01_11_094503_create_teams_table', 18);

-- --------------------------------------------------------

--
-- Table structure for table `rundowns`
--

CREATE TABLE `rundowns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rundowns`
--

INSERT INTO `rundowns` (`id`, `created_at`, `updated_at`, `title`, `date`, `start_time`, `end_time`, `notes`) VALUES
(1, '2020-12-27 22:29:27', '2020-12-27 22:50:15', 'Day 0', '2021-01-10', '08:00:00', '15:00:00', 'Hari pembukaan acara diedit'),
(2, '2021-01-06 05:16:30', '2021-01-06 05:16:30', 'Day 1', '2021-02-26', '11:16:00', '19:16:00', 'lorem ipsum dolor sit amet');

-- --------------------------------------------------------

--
-- Table structure for table `speakers`
--

CREATE TABLE `speakers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `linkedin_profile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sponsors`
--

CREATE TABLE `sponsors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `field` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sponsors`
--

INSERT INTO `sponsors` (`id`, `type_id`, `name`, `address`, `field`, `phone`, `link`, `logo`, `created_at`, `updated_at`) VALUES
(1, 1, 'AgendaKota', 'Koridor Coworking Space', 'Event Organizer', '0881036183086', 'https://agendakota.id', 'logo agendakota.png', '2020-11-20 00:22:32', '2020-11-20 00:22:32'),
(4, 1, 'Riyana Lighting', 'jalan bumiarjo v 11', 'Lighting', '085321450680', 'https://wa.me/62881036183076', 'Screenshot from 2019-12-08 12-12-33.png', '2021-01-22 21:02:28', '2021-01-22 21:03:51');

-- --------------------------------------------------------

--
-- Table structure for table `sponsor_type`
--

CREATE TABLE `sponsor_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sponsor_type`
--

INSERT INTO `sponsor_type` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Vendor', '2021-01-22 08:25:26', '2021-01-22 08:25:26');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_chief` bigint(20) UNSIGNED NOT NULL,
  `user_1` bigint(20) UNSIGNED DEFAULT NULL,
  `user_2` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `user_chief`, `user_1`, `user_2`, `created_at`, `updated_at`) VALUES
(1, 'Riyan Hebat', 1, 9, 2, '2021-01-11 03:56:14', '2021-01-24 22:28:46');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `name`, `description`, `price`, `created_at`, `updated_at`, `event_id`) VALUES
(1, 'Beginner', 'Untuk beginner', 5000, '2021-01-07 04:52:41', '2021-01-07 04:52:41', 4);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_orders`
--

CREATE TABLE `ticket_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `total_pay` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_orders`
--

INSERT INTO `ticket_orders` (`id`, `user_id`, `ticket_id`, `qty`, `total_pay`, `status`, `created_at`, `updated_at`) VALUES
(5, 1, 1, 2, 10000, 0, '2021-01-07 06:53:26', '2021-01-07 11:02:46'),
(6, 1, 1, 2, 10000, 1, '2021-01-11 04:14:29', '2021-01-11 04:14:29');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_types`
--

CREATE TABLE `ticket_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_types`
--

INSERT INTO `ticket_types` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(2, 'Tiket Main Event', 'untuk main event', '2020-12-27 23:14:43', '2020-12-27 23:14:43');

-- --------------------------------------------------------

--
-- Table structure for table `timelines`
--

CREATE TABLE `timelines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `open_date` date NOT NULL,
  `close_date` date NOT NULL,
  `judgement_date` date NOT NULL,
  `main_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `timelines`
--

INSERT INTO `timelines` (`id`, `event_id`, `type`, `open_date`, `close_date`, `judgement_date`, `main_date`, `created_at`, `updated_at`) VALUES
(2, 4, 'straight', '2021-01-28', '2021-02-02', '2021-02-17', '2021-02-28', '2021-01-06 05:04:33', '2021-01-06 05:04:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instance` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employment_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_medium` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `has_joined_dsi` tinyint(4) DEFAULT NULL,
  `interested_with_dsi` tinyint(4) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `instance`, `employment_status`, `reason`, `gender`, `address`, `social_linkedin`, `social_medium`, `social_instagram`, `social_facebook`, `has_joined_dsi`, `interested_with_dsi`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Riyan Satria', 'riyan.satria.619@gmail.com', '$2y$10$P9dt4BhESwfq.DAb9SqakO80vf0M7rQ.xjPWBp9TA9cUoho/xi5yK', '0881036183076', 'AgendaKota', 'Bekerja', 'ngetes fungsi register', 'Laki-laki', NULL, 'https://www.linkedin.com/in/haloriyan', 'https://medium.com/@haloriyan', 'https://www.instagram.com/haloriyan', 'https://www.facebook.com/haloriyan', 0, NULL, 1, '2021-01-06 04:00:15', '2021-01-11 23:11:45'),
(2, 'Yoga Agung', 'yprasetio531@gmail.com', '$2y$10$hHUeg3/DVMuZ/SfgxAFMru9g7zngchn9SPuxnMYu34RmvT4..7one', '0881036183076', 'DSI', 'Bekerja', 'tidka ada', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, '2021-01-11 05:19:07', '2021-01-11 05:19:07'),
(3, 'Mark Zuckerberg', 'mark@facebook.com', '$2y$10$kebM6h5ST/ifulDrbGKhI.JmcuZXcg6LgeVenVqPmkasjeWSufR/G', '0881036183076', 'Facebook', 'Bekerja', 'gada', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, 0, 1, 1, '2021-01-11 05:26:42', '2021-01-11 05:26:42'),
(9, 'Bagas', 'bagas@gmail.com', '$2y$10$XSZnhmW6iPGIZj8mZ8DS1O7JBLVMl5.jeIChdLwxOyOr/owOfyMz6', NULL, NULL, NULL, NULL, 'Perempuan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-01-24 22:28:46', '2021-01-24 22:28:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_roles`
--
ALTER TABLE `admin_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_type_id_index` (`type_id`),
  ADD KEY `events_rundown_id_index` (`rundown_id`);

--
-- Indexes for table `events_speaker`
--
ALTER TABLE `events_speaker`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_speaker_events_id_foreign` (`events_id`),
  ADD KEY `events_speaker_speaker_id_foreign` (`speaker_id`);

--
-- Indexes for table `events_type`
--
ALTER TABLE `events_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_types`
--
ALTER TABLE `event_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `judges`
--
ALTER TABLE `judges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `judges_event_id_index` (`event_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rundowns`
--
ALTER TABLE `rundowns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `speakers`
--
ALTER TABLE `speakers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `speakers_event_id_index` (`event_id`);

--
-- Indexes for table `sponsors`
--
ALTER TABLE `sponsors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `sponsor_type`
--
ALTER TABLE `sponsor_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teams_user_chief_index` (`user_chief`),
  ADD KEY `teams_user_1_index` (`user_1`),
  ADD KEY `teams_user_2_index` (`user_2`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tickets_event_id_index` (`event_id`);

--
-- Indexes for table `ticket_orders`
--
ALTER TABLE `ticket_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_orders_user_id_index` (`user_id`),
  ADD KEY `ticket_orders_ticket_id_index` (`ticket_id`);

--
-- Indexes for table `ticket_types`
--
ALTER TABLE `ticket_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timelines`
--
ALTER TABLE `timelines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `timelines_event_id_index` (`event_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_roles`
--
ALTER TABLE `admin_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `events_speaker`
--
ALTER TABLE `events_speaker`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events_type`
--
ALTER TABLE `events_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `event_types`
--
ALTER TABLE `event_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `judges`
--
ALTER TABLE `judges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `rundowns`
--
ALTER TABLE `rundowns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `speakers`
--
ALTER TABLE `speakers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sponsors`
--
ALTER TABLE `sponsors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sponsor_type`
--
ALTER TABLE `sponsor_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ticket_orders`
--
ALTER TABLE `ticket_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ticket_types`
--
ALTER TABLE `ticket_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `timelines`
--
ALTER TABLE `timelines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_rundown_id_foreign` FOREIGN KEY (`rundown_id`) REFERENCES `rundowns` (`id`),
  ADD CONSTRAINT `events_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `event_types` (`id`);

--
-- Constraints for table `events_speaker`
--
ALTER TABLE `events_speaker`
  ADD CONSTRAINT `events_speaker_events_id_foreign` FOREIGN KEY (`events_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `events_speaker_speaker_id_foreign` FOREIGN KEY (`speaker_id`) REFERENCES `speakers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `judges`
--
ALTER TABLE `judges`
  ADD CONSTRAINT `judges_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);

--
-- Constraints for table `speakers`
--
ALTER TABLE `speakers`
  ADD CONSTRAINT `speakers_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);

--
-- Constraints for table `sponsors`
--
ALTER TABLE `sponsors`
  ADD CONSTRAINT `sponsors_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `sponsor_type` (`id`);

--
-- Constraints for table `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `teams_user_1_foreign` FOREIGN KEY (`user_1`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `teams_user_2_foreign` FOREIGN KEY (`user_2`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `teams_user_chief_foreign` FOREIGN KEY (`user_chief`) REFERENCES `users` (`id`);

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);

--
-- Constraints for table `ticket_orders`
--
ALTER TABLE `ticket_orders`
  ADD CONSTRAINT `ticket_orders_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`),
  ADD CONSTRAINT `ticket_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `timelines`
--
ALTER TABLE `timelines`
  ADD CONSTRAINT `timelines_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
