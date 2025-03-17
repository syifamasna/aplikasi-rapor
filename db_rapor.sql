-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2025 at 08:38 AM
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
-- Database: `db_rapor`
--

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
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_03_12_000000_create_student_classes_table', 2),
(5, '2025_03_17_051603_create_teachings_table', 3);

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
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2025-03-07 05:14:40', '2025-03-07 05:15:17'),
(2, 'Wali Kelas', '2025-03-07 05:13:42', '2025-03-07 05:13:42'),
(3, 'Guru Mapel', '2025-03-07 05:15:45', '2025-03-07 05:15:45'),
(4, 'Pj Prestasi', '2025-03-07 05:16:36', '2025-03-07 05:16:36');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(12, 8, 2, '2025-03-10 21:30:38', '2025-03-10 21:30:38'),
(13, 8, 3, '2025-03-10 21:30:38', '2025-03-10 21:30:38'),
(14, 17, 2, '2025-03-10 22:10:44', '2025-03-10 22:10:44'),
(15, 17, 3, '2025-03-10 22:10:44', '2025-03-10 22:10:44'),
(16, 18, 2, '2025-03-10 23:13:21', '2025-03-10 23:13:21'),
(17, 18, 3, '2025-03-10 23:13:21', '2025-03-10 23:13:21'),
(18, 19, 1, '2025-03-10 23:14:05', '2025-03-10 23:14:05'),
(19, 19, 2, '2025-03-10 23:14:05', '2025-03-10 23:14:05'),
(20, 19, 3, '2025-03-10 23:14:05', '2025-03-10 23:14:05'),
(21, 20, 1, '2025-03-10 23:35:30', '2025-03-10 23:35:30'),
(22, 21, 2, '2025-03-12 20:20:41', '2025-03-12 20:20:41'),
(23, 21, 3, '2025-03-12 20:20:41', '2025-03-12 20:20:41'),
(24, 22, 2, '2025-03-12 20:22:06', '2025-03-12 20:22:06'),
(25, 22, 3, '2025-03-12 20:22:06', '2025-03-12 20:22:06'),
(26, 23, 2, '2025-03-12 20:22:43', '2025-03-12 20:22:43'),
(27, 23, 3, '2025-03-12 20:22:43', '2025-03-12 20:22:43'),
(28, 24, 2, '2025-03-12 20:26:19', '2025-03-12 20:26:19'),
(29, 24, 3, '2025-03-12 20:26:19', '2025-03-12 20:26:19'),
(31, 25, 3, '2025-03-14 20:53:49', '2025-03-14 20:53:49'),
(32, 26, 2, '2025-03-14 20:55:07', '2025-03-14 20:55:07'),
(33, 26, 3, '2025-03-14 20:55:07', '2025-03-14 20:55:07'),
(34, 27, 2, '2025-03-14 20:55:58', '2025-03-14 20:55:58'),
(35, 27, 3, '2025-03-14 20:55:58', '2025-03-14 20:55:58'),
(36, 28, 2, '2025-03-14 21:05:01', '2025-03-14 21:05:01'),
(37, 28, 3, '2025-03-14 21:05:01', '2025-03-14 21:05:01'),
(38, 29, 2, '2025-03-14 21:06:05', '2025-03-14 21:06:05'),
(39, 29, 3, '2025-03-14 21:06:05', '2025-03-14 21:06:05'),
(40, 30, 2, '2025-03-14 21:07:02', '2025-03-14 21:07:02'),
(41, 30, 3, '2025-03-14 21:07:02', '2025-03-14 21:07:02'),
(42, 31, 2, '2025-03-14 21:07:58', '2025-03-14 21:07:58'),
(43, 31, 3, '2025-03-14 21:07:58', '2025-03-14 21:07:58'),
(44, 32, 2, '2025-03-14 21:08:48', '2025-03-14 21:08:48'),
(45, 32, 3, '2025-03-14 21:08:48', '2025-03-14 21:08:48'),
(46, 33, 2, '2025-03-14 21:09:43', '2025-03-14 21:09:43'),
(47, 33, 3, '2025-03-14 21:09:43', '2025-03-14 21:09:43'),
(48, 34, 2, '2025-03-14 21:12:04', '2025-03-14 21:12:04'),
(49, 34, 3, '2025-03-14 21:12:04', '2025-03-14 21:12:04'),
(50, 35, 2, '2025-03-14 21:13:10', '2025-03-14 21:13:10'),
(51, 35, 3, '2025-03-14 21:13:10', '2025-03-14 21:13:10'),
(52, 36, 2, '2025-03-14 21:13:52', '2025-03-14 21:13:52'),
(53, 36, 3, '2025-03-14 21:13:52', '2025-03-14 21:13:52'),
(54, 37, 2, '2025-03-14 21:15:14', '2025-03-14 21:15:14'),
(55, 37, 3, '2025-03-14 21:15:14', '2025-03-14 21:15:14'),
(56, 38, 2, '2025-03-14 21:15:59', '2025-03-14 21:15:59'),
(57, 38, 3, '2025-03-14 21:15:59', '2025-03-14 21:15:59'),
(58, 39, 2, '2025-03-14 21:16:44', '2025-03-14 21:16:44'),
(59, 39, 3, '2025-03-14 21:16:44', '2025-03-14 21:16:44'),
(60, 40, 2, '2025-03-14 21:17:31', '2025-03-14 21:17:31'),
(61, 40, 3, '2025-03-14 21:17:31', '2025-03-14 21:17:31'),
(62, 41, 2, '2025-03-14 21:18:14', '2025-03-14 21:18:14'),
(63, 41, 3, '2025-03-14 21:18:14', '2025-03-14 21:18:14'),
(64, 42, 3, '2025-03-14 21:22:41', '2025-03-14 21:22:41'),
(65, 43, 3, '2025-03-14 21:25:59', '2025-03-14 21:25:59'),
(66, 44, 3, '2025-03-14 21:27:23', '2025-03-14 21:27:23'),
(67, 45, 3, '2025-03-14 21:28:15', '2025-03-14 21:28:15'),
(68, 46, 3, '2025-03-14 21:29:11', '2025-03-14 21:29:11'),
(69, 47, 3, '2025-03-14 21:29:52', '2025-03-14 21:29:52'),
(70, 48, 3, '2025-03-14 21:30:51', '2025-03-14 21:30:51'),
(71, 49, 3, '2025-03-14 21:32:13', '2025-03-14 21:32:13'),
(72, 50, 3, '2025-03-14 21:33:02', '2025-03-14 21:33:02'),
(73, 51, 3, '2025-03-14 21:33:37', '2025-03-14 21:33:37'),
(74, 52, 3, '2025-03-14 21:34:16', '2025-03-14 21:34:16'),
(75, 53, 3, '2025-03-14 21:34:52', '2025-03-14 21:34:52'),
(76, 54, 3, '2025-03-14 21:35:32', '2025-03-14 21:35:32'),
(77, 55, 3, '2025-03-14 21:36:28', '2025-03-14 21:36:28'),
(78, 56, 3, '2025-03-14 21:38:09', '2025-03-14 21:38:09'),
(79, 57, 3, '2025-03-14 21:38:44', '2025-03-14 21:38:44'),
(80, 58, 3, '2025-03-14 21:39:16', '2025-03-14 21:39:16'),
(81, 59, 3, '2025-03-14 21:39:52', '2025-03-14 21:39:52'),
(82, 60, 3, '2025-03-14 21:40:31', '2025-03-14 21:40:31'),
(83, 61, 3, '2025-03-14 21:41:10', '2025-03-14 21:41:10'),
(84, 62, 3, '2025-03-14 21:42:39', '2025-03-14 21:42:39'),
(85, 63, 3, '2025-03-14 21:43:19', '2025-03-14 21:43:19'),
(86, 64, 3, '2025-03-14 21:43:59', '2025-03-14 21:43:59'),
(87, 65, 3, '2025-03-14 21:45:49', '2025-03-14 21:45:49'),
(88, 66, 3, '2025-03-14 21:46:23', '2025-03-14 21:46:23'),
(89, 67, 3, '2025-03-14 21:46:57', '2025-03-14 21:46:57'),
(90, 68, 3, '2025-03-14 21:47:35', '2025-03-14 21:47:35'),
(91, 69, 3, '2025-03-14 21:48:09', '2025-03-14 21:48:09'),
(92, 70, 3, '2025-03-14 21:48:56', '2025-03-14 21:48:56'),
(93, 71, 3, '2025-03-14 21:49:37', '2025-03-14 21:49:37'),
(94, 72, 3, '2025-03-14 21:50:56', '2025-03-14 21:50:56'),
(95, 73, 3, '2025-03-14 21:51:28', '2025-03-14 21:51:28'),
(96, 74, 3, '2025-03-14 21:52:01', '2025-03-14 21:52:01'),
(97, 75, 3, '2025-03-14 21:52:59', '2025-03-14 21:52:59'),
(98, 76, 3, '2025-03-14 21:53:30', '2025-03-14 21:53:30'),
(99, 77, 3, '2025-03-14 21:54:06', '2025-03-14 21:54:06'),
(100, 78, 3, '2025-03-14 21:55:03', '2025-03-14 21:55:03'),
(101, 79, 3, '2025-03-14 21:55:49', '2025-03-14 21:55:49'),
(102, 80, 3, '2025-03-14 21:58:25', '2025-03-14 21:58:25'),
(103, 81, 3, '2025-03-14 21:59:02', '2025-03-14 21:59:02'),
(104, 82, 3, '2025-03-14 21:59:35', '2025-03-14 21:59:35'),
(105, 83, 3, '2025-03-14 22:00:09', '2025-03-14 22:00:09'),
(106, 84, 3, '2025-03-14 22:01:17', '2025-03-14 22:01:17');

-- --------------------------------------------------------

--
-- Table structure for table `school_profiles`
--

CREATE TABLE `school_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `npsn` int(20) NOT NULL,
  `kode_pos` int(20) NOT NULL,
  `telepon` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `kepsek` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school_profiles`
--

INSERT INTO `school_profiles` (`id`, `nama`, `npsn`, `kode_pos`, `telepon`, `alamat`, `email`, `website`, `kepsek`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'SIT Aliya', 20219975, 16117, '02518422129', 'Jl. Gardu Raya, RT.03/RW.11, Bubulak, Kec. Bogor Bar., Kota Bogor, Jawa Barat', 'sitaliya01@gmail.com', 'https://sitaliya.sch.id/', 'Luluk Dianarini, S.TP, M.Pd.', NULL, NULL, '2025-03-05 11:37:13');

-- --------------------------------------------------------

--
-- Table structure for table `school_years`
--

CREATE TABLE `school_years` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tahun_awal` int(10) NOT NULL,
  `tahun_akhir` int(10) NOT NULL,
  `semester` enum('Ganjil','Genap') NOT NULL,
  `tempat_rapor` varchar(255) DEFAULT NULL,
  `tanggal_rapor` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school_years`
--

INSERT INTO `school_years` (`id`, `tahun_awal`, `tahun_akhir`, `semester`, `tempat_rapor`, `tanggal_rapor`, `created_at`, `updated_at`) VALUES
(3, 2024, 2025, 'Genap', 'Bogor', '2025-06-20', '2025-03-06 00:21:23', '2025-03-06 20:29:18'),
(5, 2024, 2025, 'Ganjil', 'Bogor', '2024-12-26', '2025-03-06 20:04:02', '2025-03-06 20:04:02'),
(7, 2023, 2024, 'Genap', 'Bogor', '2024-06-21', '2025-03-06 20:31:49', '2025-03-06 20:31:49');

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
('vgdv9TI4ctoYtsDATQn2kEMq6TNhuuVjgwx0kow3', 20, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoibkJ6dFNCczdOajRqRGJVSkpmUGNxSzAxWmQxY3NhbDcyYnlYVGcyYyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjA7czoxMToiYWN0aXZlX3JvbGUiO3M6MToiMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9zdHVkZW50cyI7fX0=', 1742196757);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nis` varchar(255) DEFAULT NULL,
  `nisn` varchar(255) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `class_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jk` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `nis`, `nisn`, `nama`, `class_id`, `jk`, `created_at`, `updated_at`) VALUES
(256, '242501006', NULL, 'Aisha Alzena Qurrota A Yun', 6, 'Perempuan', '2025-03-16 18:51:33', '2025-03-16 18:51:33'),
(257, '242501010', NULL, 'Aleana Nafla Raudha', 6, 'Perempuan', '2025-03-16 18:51:33', '2025-03-16 18:51:33'),
(258, '242501011', NULL, 'Aleisha Edeline Permana', 6, 'Perempuan', '2025-03-16 18:51:34', '2025-03-16 18:51:34'),
(259, '242501013', NULL, 'Alinka Humaira Putri', 6, 'Perempuan', '2025-03-16 18:51:34', '2025-03-16 18:51:34'),
(260, '242501015', NULL, 'Althafariz Prawira Dhanuputra', 6, 'Laki-laki', '2025-03-16 18:51:34', '2025-03-16 18:51:34'),
(261, '242501016', NULL, 'Annasya Dayu Wismadi', 6, 'Perempuan', '2025-03-16 18:51:34', '2025-03-16 18:51:34'),
(262, '242501019', NULL, 'Arshaka Bayanaka Candra', 6, 'Laki-laki', '2025-03-16 18:51:34', '2025-03-16 18:51:34'),
(263, '242501022', NULL, 'Aryasatya Widyanata Narendra', 6, 'Laki-laki', '2025-03-16 18:51:34', '2025-03-16 18:51:34'),
(264, '242501026', NULL, 'Aulian Arfan Raffasya', 6, 'Laki-laki', '2025-03-16 18:51:34', '2025-03-16 18:51:34'),
(265, '242501031', NULL, 'Claretta Ashana Gemilang', 6, 'Perempuan', '2025-03-16 18:51:34', '2025-03-16 18:51:34'),
(266, '242501038', NULL, 'Fateena Afifatun Nuha', 6, 'Perempuan', '2025-03-16 18:51:34', '2025-03-16 18:51:34'),
(267, '242501039', NULL, 'Fathiya Ainayya Asrori', 6, 'Perempuan', '2025-03-16 18:51:34', '2025-03-16 18:51:34'),
(268, '242501044', NULL, 'Hassa Kamila Pramudita', 6, 'Perempuan', '2025-03-16 18:51:34', '2025-03-16 18:51:34'),
(269, '242501049', NULL, 'Kanaya Queenza Faranisa', 6, 'Perempuan', '2025-03-16 18:51:35', '2025-03-16 18:51:35'),
(270, '242501052', NULL, 'Kevin Alvaro Restridyo', 6, 'Laki-laki', '2025-03-16 18:51:35', '2025-03-16 18:51:35'),
(271, '242501069', NULL, 'Muhammad Ismat Ariq Yamani', 6, 'Laki-laki', '2025-03-16 18:51:35', '2025-03-16 18:51:35'),
(272, '242501071', NULL, 'Muhammad Luthfi Alfarizqi', 6, 'Laki-laki', '2025-03-16 18:51:35', '2025-03-16 18:51:35'),
(273, '242501073', NULL, 'Muhammad Rafasya Alfariq', 6, 'Laki-laki', '2025-03-16 18:51:35', '2025-03-16 18:51:35'),
(274, '242501078', NULL, 'Nafiza Luthfiannisa Riyandi', 6, 'Perempuan', '2025-03-16 18:51:35', '2025-03-16 18:51:35'),
(275, '242501081', NULL, 'Nayla Zahra Khairunnisa', 6, 'Perempuan', '2025-03-16 18:51:35', '2025-03-16 18:51:35'),
(276, '242501083', NULL, 'Noya Aditama Putranto', 6, 'Laki-laki', '2025-03-16 18:51:35', '2025-03-16 18:51:35'),
(277, '242501085', NULL, 'Putri Dayu Alfathunnisa', 6, 'Perempuan', '2025-03-16 18:51:35', '2025-03-16 18:51:35'),
(278, '242501100', NULL, 'Shanum Ghania Putri Santosa', 6, 'Perempuan', '2025-03-16 18:51:35', '2025-03-16 18:51:35'),
(279, '242501101', NULL, 'Shaquila Queenesha Shallum Ramadhan', 6, 'Perempuan', '2025-03-16 18:51:35', '2025-03-16 18:51:35'),
(280, '242501107', NULL, 'Umair Al Hadid', 6, 'Laki-laki', '2025-03-16 18:51:35', '2025-03-16 18:51:35'),
(281, '242501110', NULL, 'Zayn Achmad Ibrahim', 6, 'Laki-laki', '2025-03-16 18:51:35', '2025-03-16 18:51:35'),
(282, '242501113', NULL, 'Ziyyan Narendra Rahman', 6, 'Laki-laki', '2025-03-16 18:51:35', '2025-03-16 18:51:35'),
(283, '242501114', NULL, 'Zysy Azzahra Zein', 6, 'Perempuan', '2025-03-16 18:51:35', '2025-03-16 18:51:35'),
(285, '242501005', NULL, 'Aghniya Sholihah', 7, 'Perempuan', '2025-03-16 19:04:48', '2025-03-16 19:04:48'),
(286, '242501007', NULL, 'Aisyah Al-Khawarizmi', 7, 'Perempuan', '2025-03-16 19:04:48', '2025-03-16 19:04:48'),
(287, '242501012', NULL, 'Alinka Alya Kirana Ferdians', 7, 'Perempuan', '2025-03-16 19:04:48', '2025-03-16 19:04:48'),
(288, '242501014', NULL, 'Alrafaeyza Edi Pradana', 7, 'Laki-laki', '2025-03-16 19:04:48', '2025-03-16 19:04:48'),
(289, '242501020', NULL, 'Arshaka Muhammad Ghaisan', 7, 'Laki-laki', '2025-03-16 19:04:48', '2025-03-16 19:04:48'),
(290, '242501021', NULL, 'Arthur Rafasya Arjuna Salim', 7, 'Laki-laki', '2025-03-16 19:04:48', '2025-03-16 19:04:48'),
(291, '242501027', NULL, 'Aurora Pendar Cakrawala F', 7, 'Perempuan', '2025-03-16 19:04:48', '2025-03-16 19:04:48'),
(292, '242501034', NULL, 'Drisana Nafeeza Alfathunissa', 7, 'Perempuan', '2025-03-16 19:04:48', '2025-03-16 19:04:48'),
(293, '242501036', NULL, 'Faaizan Dzulquwwah', 7, 'Laki-laki', '2025-03-16 19:04:48', '2025-03-16 19:04:48'),
(294, '242501037', NULL, 'Fadlan Ali Fahreza', 7, 'Laki-laki', '2025-03-16 19:04:48', '2025-03-16 19:04:48'),
(295, '242501041', NULL, 'Gentama Al Fatih Arienda', 7, 'Laki-laki', '2025-03-16 19:04:48', '2025-03-16 19:04:48'),
(296, '242501050', NULL, 'Kayyisah Reviana Aristawidya', 7, 'Perempuan', '2025-03-16 19:04:49', '2025-03-16 19:04:49'),
(297, '242501055', NULL, 'Kirana Shaqueena Azkadeena', 7, 'Perempuan', '2025-03-16 19:04:49', '2025-03-16 19:04:49'),
(298, '242501057', NULL, 'Laqisha Fania Nailazaara Praditya', 7, 'Perempuan', '2025-03-16 19:04:49', '2025-03-16 19:04:49'),
(299, '242501059', NULL, 'Maryam Lulu Elquran', 7, 'Perempuan', '2025-03-16 19:04:49', '2025-03-16 19:04:49'),
(300, '242501066', NULL, 'Muhammad Farid Asyraf Abqory', 7, 'Laki-laki', '2025-03-16 19:04:49', '2025-03-16 19:04:49'),
(301, '242501068', NULL, 'Muhammad Irsya Raffasya Alfarezi', 7, 'Laki-laki', '2025-03-16 19:04:49', '2025-03-16 19:04:49'),
(302, '242501072', NULL, 'Muhammad Mazza Affa Albana', 7, 'Laki-laki', '2025-03-16 19:04:49', '2025-03-16 19:04:49'),
(303, '242501076', NULL, 'Muhammad Yusuf', 7, 'Laki-laki', '2025-03-16 19:04:49', '2025-03-16 19:04:49'),
(304, '242501079', NULL, 'Nahda Rafanda', 7, 'Perempuan', '2025-03-16 19:04:49', '2025-03-16 19:04:49'),
(305, '242501080', NULL, 'Naura Salsabila Hafidzah', 7, 'Perempuan', '2025-03-16 19:04:49', '2025-03-16 19:04:49'),
(306, '242501082', NULL, 'Nizam Aldian Akbar Wibisono', 7, 'Laki-laki', '2025-03-16 19:04:49', '2025-03-16 19:04:49'),
(307, '242501084', NULL, 'Prameswari Mahiya Azzahra', 7, 'Perempuan', '2025-03-16 19:04:49', '2025-03-16 19:04:49'),
(308, '242501090', NULL, 'Raqilla Aflah Elnusa', 7, 'Laki-laki', '2025-03-16 19:04:49', '2025-03-16 19:04:49'),
(309, '242501092', NULL, 'Ravania Mutiara Alesha', 7, 'Perempuan', '2025-03-16 19:04:49', '2025-03-16 19:04:49'),
(310, '242501098', NULL, 'Sahla Sabiya Badri', 7, 'Perempuan', '2025-03-16 19:04:49', '2025-03-16 19:04:49'),
(311, '242501099', NULL, 'Shanum Defaira Putri Nasution', 7, 'Perempuan', '2025-03-16 19:04:49', '2025-03-16 19:04:49'),
(312, '242501102', NULL, 'Shoufiya Az-Zaheera', 7, 'Perempuan', '2025-03-16 19:04:49', '2025-03-16 19:04:49'),
(313, '242501104', NULL, 'Syafira Althafunnisa Wibowo', 7, 'Perempuan', '2025-03-16 19:04:49', '2025-03-16 19:04:49'),
(314, '242501002', NULL, 'Abimanyu Nawasena Aksa', 8, 'Laki-laki', '2025-03-16 19:04:49', '2025-03-16 19:04:49'),
(315, '242501001', NULL, 'Abdul Hamid Gumilang', 8, 'Laki-laki', '2025-03-16 19:04:49', '2025-03-16 19:04:49'),
(316, '242501003', NULL, 'Adisti Rachmadina Saidah Yuliandri', 8, 'Perempuan', '2025-03-16 19:04:49', '2025-03-16 19:04:49'),
(317, '242501023', NULL, 'Ashimah D Arasy', 8, 'Perempuan', '2025-03-16 19:04:49', '2025-03-16 19:04:49'),
(318, '242501025', NULL, 'Atharizz Rasyid Ghazali', 8, 'Laki-laki', '2025-03-16 19:04:49', '2025-03-16 19:04:49'),
(319, '242501028', NULL, 'Ayesha Shaqilla Adzani', 8, 'Perempuan', '2025-03-16 19:04:49', '2025-03-16 19:04:49'),
(320, '242501035', NULL, 'Dysheva Almeera Falisha', 8, 'Perempuan', '2025-03-16 19:04:49', '2025-03-16 19:04:49'),
(321, '242501040', NULL, 'Fitria Rizqy Anastasia', 8, 'Perempuan', '2025-03-16 19:04:50', '2025-03-16 19:04:50'),
(322, '242501042', NULL, 'Ghiffari Ash Shiddiq Praceka', 8, 'Laki-laki', '2025-03-16 19:04:50', '2025-03-16 19:04:50'),
(323, '242501043', NULL, 'Gilbran Aldric Widyadhana', 8, 'Laki-laki', '2025-03-16 19:04:50', '2025-03-16 19:04:50'),
(324, '242501048', NULL, 'Jingga Naira Shakilawafa', 8, 'Perempuan', '2025-03-16 19:04:50', '2025-03-16 19:04:50'),
(325, '242501051', NULL, 'Kenisha Arandra Danumartono', 8, 'Perempuan', '2025-03-16 19:04:50', '2025-03-16 19:04:50'),
(326, '242501053', NULL, 'Khadijah Aghnia Ramadhani', 8, 'Perempuan', '2025-03-16 19:04:50', '2025-03-16 19:04:50'),
(327, '242501054', NULL, 'Kirana Shanum Setiawan', 8, 'Perempuan', '2025-03-16 19:04:50', '2025-03-16 19:04:50'),
(328, '242501056', NULL, 'Kirei Atthiya Maheswari', 8, 'Perempuan', '2025-03-16 19:04:50', '2025-03-16 19:04:50'),
(329, '242501060', NULL, 'Mikhail Abqary Nadhif', 8, 'Laki-laki', '2025-03-16 19:04:50', '2025-03-16 19:04:50'),
(330, '242501061', NULL, 'Muhammad Abqory Arsyana Azlan', 8, 'Laki-laki', '2025-03-16 19:04:50', '2025-03-16 19:04:50'),
(331, '242501087', NULL, 'Raden Sucihati Ridwan Saputra', 8, 'Perempuan', '2025-03-16 19:04:50', '2025-03-16 19:04:50'),
(332, '242501088', NULL, 'Raffasya Naufal Athazaky', 8, 'Laki-laki', '2025-03-16 19:04:50', '2025-03-16 19:04:50'),
(333, '242501091', NULL, 'Ratu Husna Qonita', 8, 'Perempuan', '2025-03-16 19:04:50', '2025-03-16 19:04:50'),
(334, '242501093', NULL, 'Razzan Abqary Widiyono', 8, 'Laki-laki', '2025-03-16 19:04:50', '2025-03-16 19:04:50'),
(335, '242501094', NULL, 'Reynand Abrisam Dhanurendra', 8, 'Laki-laki', '2025-03-16 19:04:50', '2025-03-16 19:04:50'),
(336, '242501095', NULL, 'Romeesa Lashira Farzana', 8, 'Perempuan', '2025-03-16 19:04:50', '2025-03-16 19:04:50'),
(337, '242501103', NULL, 'Sorindeia Gangamata', 8, 'Perempuan', '2025-03-16 19:04:50', '2025-03-16 19:04:50'),
(338, '242501105', NULL, 'Teuku Fatharian Ghani', 8, 'Laki-laki', '2025-03-16 19:04:50', '2025-03-16 19:04:50'),
(339, '242501106', NULL, 'Thalita Zalfa Nabihah', 8, 'Perempuan', '2025-03-16 19:04:50', '2025-03-16 19:04:50'),
(340, '242501108', NULL, 'Yanuaris Azka Berlian', 8, 'Laki-laki', '2025-03-16 19:04:50', '2025-03-16 19:04:50'),
(341, '242501112', NULL, 'Zia Farra Adreena', 8, 'Perempuan', '2025-03-16 19:04:51', '2025-03-16 19:04:51'),
(342, '242501004', NULL, 'Adiva Elshanum Iriyanto', 9, 'Perempuan', '2025-03-16 19:04:51', '2025-03-16 19:04:51'),
(343, '242501008', NULL, 'Aisyah Muthi Rabbani', 9, 'Perempuan', '2025-03-16 19:04:51', '2025-03-16 19:04:51'),
(344, '242501009', NULL, 'Aisyah Nuha Ramadhani', 9, 'Perempuan', '2025-03-16 19:04:51', '2025-03-16 19:04:51'),
(345, '242501017', NULL, 'Annasya Putri Mohamad Pakaya', 9, 'Perempuan', '2025-03-16 19:04:51', '2025-03-16 19:04:51'),
(346, '242501018', NULL, 'Arasely Mashel Setiawan', 9, 'Perempuan', '2025-03-16 19:04:51', '2025-03-16 19:04:51'),
(347, '242501024', NULL, 'Athafariz Dzakhwan Najib', 9, 'Laki-laki', '2025-03-16 19:04:51', '2025-03-16 19:04:51'),
(348, '242501029', NULL, 'Aysha Ayuna Arkha', 9, 'Perempuan', '2025-03-16 19:04:51', '2025-03-16 19:04:51'),
(349, '242501030', NULL, 'Chairannisa Tri Wardono', 9, 'Perempuan', '2025-03-16 19:04:51', '2025-03-16 19:04:51'),
(350, '242501032', NULL, 'Dean Hikam', 9, 'Laki-laki', '2025-03-16 19:04:51', '2025-03-16 19:04:51'),
(351, '242501033', NULL, 'Devandra Arkananta Aji', 9, 'Laki-laki', '2025-03-16 19:04:51', '2025-03-16 19:04:51'),
(352, '242501045', NULL, 'Hazura Chairumi Oshasiro', 9, 'Perempuan', '2025-03-16 19:04:51', '2025-03-16 19:04:51'),
(353, '242501046', NULL, 'Huriya Uzma Azqiara', 9, 'Perempuan', '2025-03-16 19:04:51', '2025-03-16 19:04:51'),
(354, '242501047', NULL, 'Ismi Nurraga', 9, 'Perempuan', '2025-03-16 19:04:51', '2025-03-16 19:04:51'),
(355, '242501058', NULL, 'Laudya Rizqiyah Mardiyanto', 9, 'Perempuan', '2025-03-16 19:04:51', '2025-03-16 19:04:51'),
(356, '242501062', NULL, 'Muhammad Adnan Arrasyid', 9, 'Laki-laki', '2025-03-16 19:04:51', '2025-03-16 19:04:51'),
(357, '242501063', NULL, 'Muhammad Ahsan Abrisham', 9, 'Laki-laki', '2025-03-16 19:04:51', '2025-03-16 19:04:51'),
(358, '242501064', NULL, 'Muhammad Arkan Arrasyid', 9, 'Laki-laki', '2025-03-16 19:04:51', '2025-03-16 19:04:51'),
(359, '242501065', NULL, 'Muhammad Arvin Ghani As-Sandawi', 9, 'Laki-laki', '2025-03-16 19:04:51', '2025-03-16 19:04:51'),
(360, '242501067', NULL, 'Muhammad Ibrahim Abqary', 9, 'Laki-laki', '2025-03-16 19:04:51', '2025-03-16 19:04:51'),
(361, '242501070', NULL, 'Muhammad Kyan Abhinaya', 9, 'Laki-laki', '2025-03-16 19:04:51', '2025-03-16 19:04:51'),
(362, '242501074', NULL, 'Muhammad Refasya Alfariz', 9, 'Laki-laki', '2025-03-16 19:04:52', '2025-03-16 19:04:52'),
(363, '242501075', NULL, 'Muhammad Umar Adas Piana', 9, 'Laki-laki', '2025-03-16 19:04:52', '2025-03-16 19:04:52'),
(364, '242501077', NULL, 'Nafisatul Himmah Alisha Putri', 9, 'Perempuan', '2025-03-16 19:04:52', '2025-03-16 19:04:52'),
(365, '242501086', NULL, 'Qiana Azkadina Gita Pratama', 9, 'Perempuan', '2025-03-16 19:04:52', '2025-03-16 19:04:52'),
(366, '242501089', NULL, 'Rainisa Gendis Ramadhina', 9, 'Perempuan', '2025-03-16 19:04:52', '2025-03-16 19:04:52'),
(367, '242501096', NULL, 'Rylo Harren Adler', 9, 'Laki-laki', '2025-03-16 19:04:52', '2025-03-16 19:04:52'),
(368, '242501097', NULL, 'Sabiya Shanum Andira', 9, 'Perempuan', '2025-03-16 19:04:52', '2025-03-16 19:04:52'),
(369, '242501109', NULL, 'Zareen Adia Rumaisha', 9, 'Perempuan', '2025-03-16 19:04:52', '2025-03-16 19:04:52'),
(370, '242501111', NULL, 'Zea Qanita Zakia Abdurohman', 9, 'Perempuan', '2025-03-16 19:04:52', '2025-03-16 19:04:52'),
(371, '232401001', '3177662279', 'Abimanyu Kaindra Pranoto Putra', 10, 'Laki-laki', '2025-03-16 21:12:29', '2025-03-16 21:12:29'),
(372, '232401005', '3174362409', 'Adam Khalief Arka Payana', 10, 'Laki-laki', '2025-03-16 21:12:29', '2025-03-16 21:12:29'),
(373, '232401006', '3176520402', 'Afiqa Nailah Kamil', 10, 'Perempuan', '2025-03-16 21:12:30', '2025-03-16 21:12:30'),
(374, '232401008', '3171040884', 'Ahsan Faruq Arsyad', 10, 'Laki-laki', '2025-03-16 21:12:30', '2025-03-16 21:12:30'),
(375, '232401012', '3175417127', 'Aisyah Putri Almahyra', 10, 'Perempuan', '2025-03-16 21:12:30', '2025-03-16 21:12:30'),
(376, '232401014', '3165248762', 'Akhtar Rafif Hernanda', 10, 'Laki-laki', '2025-03-16 21:12:30', '2025-03-16 21:12:30'),
(377, '232401025', '3165618648', 'Arsakha Huayan Pulungan', 10, 'Laki-laki', '2025-03-16 21:12:30', '2025-03-16 21:12:30'),
(378, '232401032', '3163779792', 'Aulia Khairunnisa Satyagraha', 10, 'Perempuan', '2025-03-16 21:12:30', '2025-03-16 21:12:30'),
(379, '232401033', '3162239458', 'Ayda Rayya Putriwibie', 10, 'Perempuan', '2025-03-16 21:12:30', '2025-03-16 21:12:30'),
(380, '232401034', '3161051062', 'Azmya Shafana Mahveen A', 10, 'Perempuan', '2025-03-16 21:12:30', '2025-03-16 21:12:30'),
(381, '232401037', '3162498975', 'Danish Adhyastha Pradana', 10, 'Laki-laki', '2025-03-16 21:12:30', '2025-03-16 21:12:30'),
(382, '232401042', '3162274446', 'Faizan Athmar Mauza', 10, 'Laki-laki', '2025-03-16 21:12:30', '2025-03-16 21:12:30'),
(383, '232401045', '3176955479', 'Fayza Ziya Afifa', 10, 'Perempuan', '2025-03-16 21:12:30', '2025-03-16 21:12:30'),
(384, '232401050', '3177771072', 'Hanina Arsyila Prasetia', 10, 'Perempuan', '2025-03-16 21:12:30', '2025-03-16 21:12:30'),
(385, '232401058', '3172456867', 'Keinara Azkadina Shaumi', 10, 'Perempuan', '2025-03-16 21:12:31', '2025-03-16 21:12:31'),
(386, '232401060', '3159166497', 'Kenzie Faiz Hamizan', 10, 'Laki-laki', '2025-03-16 21:12:31', '2025-03-16 21:12:31'),
(387, '232401064', '3164916344', 'Kinara Arsyila Shaninditha', 10, 'Perempuan', '2025-03-16 21:12:31', '2025-03-16 21:12:31'),
(388, '232401073', '3162545534', 'Misha Rayna Amira', 10, 'Perempuan', '2025-03-16 21:12:31', '2025-03-16 21:12:31'),
(389, '232401075', '3166560547', 'Muhammad Almer Shakiy Reinan', 10, 'Laki-laki', '2025-03-16 21:12:31', '2025-03-16 21:12:31'),
(390, '232401077', '3167945610', 'Muhammad Hafizh Yuliadi', 10, 'Laki-laki', '2025-03-16 21:12:31', '2025-03-16 21:12:31'),
(391, '232401083', '3166758035', 'Muhammad Razka Athalla Rasendrio', 10, 'Laki-laki', '2025-03-16 21:12:31', '2025-03-16 21:12:31'),
(392, '232401084', '3164088864', 'Muhammad Zidny Al Banna', 10, 'Laki-laki', '2025-03-16 21:12:31', '2025-03-16 21:12:31'),
(393, '232401086', '3164623708', 'Naoki Abrisham', 10, 'Laki-laki', '2025-03-16 21:12:31', '2025-03-16 21:12:31'),
(394, '232401100', '3164042078', 'Shaqueena Giola Sugiyono', 10, 'Perempuan', '2025-03-16 21:12:31', '2025-03-16 21:12:31'),
(395, '232401101', '3176386513', 'Shareen Almahyra Naifa', 10, 'Perempuan', '2025-03-16 21:12:31', '2025-03-16 21:12:31'),
(396, '232401106', '3163061971', 'Veony Audrielle Hidayat', 10, 'Perempuan', '2025-03-16 21:12:31', '2025-03-16 21:12:31'),
(397, '232401108', '3177447600', 'Viola Raisya Husna', 10, 'Perempuan', '2025-03-16 21:12:31', '2025-03-16 21:12:31'),
(398, '242502119', '0', 'Hafizh Ihyanur Furqon', 10, 'Laki-laki', '2025-03-16 21:12:31', '2025-03-16 21:12:31'),
(399, '232401003', '3173129703', 'Abyan Atharizz Ahmadi', 11, 'Laki-laki', '2025-03-16 21:12:31', '2025-03-16 21:12:31'),
(400, '232401009', '3172770870', 'Ainayya Azkadina Ismail', 11, 'Perempuan', '2025-03-16 21:12:31', '2025-03-16 21:12:31'),
(401, '232401018', '3163120874', 'Almahyra Naureen Alfhatunnisa', 11, 'Perempuan', '2025-03-16 21:12:31', '2025-03-16 21:12:31'),
(402, '232401019', '3161832820', 'Aluna Alesha Azzahra', 11, 'Perempuan', '2025-03-16 21:12:31', '2025-03-16 21:12:31'),
(403, '232401021', '3169705391', 'Amrullah Adam Azzaky', 11, 'Laki-laki', '2025-03-16 21:12:31', '2025-03-16 21:12:31'),
(404, '232401024', '3160833108', 'Aqilah Nur Sabrina', 11, 'Perempuan', '2025-03-16 21:12:31', '2025-03-16 21:12:31'),
(405, '232401028', '3161560917', 'Arsyila Nazafarin Adrina', 11, 'Perempuan', '2025-03-16 21:12:31', '2025-03-16 21:12:31'),
(406, '232401030', '3167416540', 'Atharianzi Farzan Suwadi', 11, 'Laki-laki', '2025-03-16 21:12:31', '2025-03-16 21:12:31'),
(407, '232401031', '3161577051', 'Athaya Raqila Forlendiana', 11, 'Laki-laki', '2025-03-16 21:12:32', '2025-03-16 21:12:32'),
(408, '232401035', '3175206562', 'Bening Dhiya Sabhira', 11, 'Perempuan', '2025-03-16 21:12:32', '2025-03-16 21:12:32'),
(409, '232401039', '3172328164', 'Elvania Athahira Harma', 11, 'Perempuan', '2025-03-16 21:12:32', '2025-03-16 21:12:32'),
(410, '232401040', '3176017969', 'Ercillia Hanania Rayadinata', 11, 'Perempuan', '2025-03-16 21:12:32', '2025-03-16 21:12:32'),
(411, '232401047', '3176637647', 'Gentala Hafizhan Ahmad', 11, 'Laki-laki', '2025-03-16 21:12:32', '2025-03-16 21:12:32'),
(412, '232401056', '3170087998', 'Kayra Nadhifa Almaira', 11, 'Perempuan', '2025-03-16 21:12:32', '2025-03-16 21:12:32'),
(413, '232401057', '3167058680', 'Kean Alkhalifi Irawan', 11, 'Laki-laki', '2025-03-16 21:12:32', '2025-03-16 21:12:32'),
(414, '232401061', '3173652243', 'Khaizuran Rasya Abqari', 11, 'Laki-laki', '2025-03-16 21:12:32', '2025-03-16 21:12:32'),
(415, '232401068', '3177472400', 'Marcello Al Fadelf', 11, 'Laki-laki', '2025-03-16 21:12:32', '2025-03-16 21:12:32'),
(416, '232401070', '3170368863', 'Maulana Daffa Zakaria', 11, 'Laki-laki', '2025-03-16 21:12:32', '2025-03-16 21:12:32'),
(417, '232401071', '3166068306', 'Mikayla Ava Zahvalna', 11, 'Perempuan', '2025-03-16 21:12:32', '2025-03-16 21:12:32'),
(418, '232401072', '3167853161', 'Milena Aira Althafunnisa', 11, 'Perempuan', '2025-03-16 21:12:32', '2025-03-16 21:12:32'),
(419, '232401074', '3160790824', 'Mochamad Afkar Awanta Ghazwan', 11, 'Laki-laki', '2025-03-16 21:12:32', '2025-03-16 21:12:32'),
(420, '232401078', '3177554113', 'Muhammad Hanan Rafif Alfathan', 11, 'Laki-laki', '2025-03-16 21:12:32', '2025-03-16 21:12:32'),
(421, '232401079', '3161802075', 'Muhammad Hudzaifah Al Luqman', 11, 'Laki-laki', '2025-03-16 21:12:32', '2025-03-16 21:12:32'),
(422, '232401090', '3170336933', 'Nayla Nur Fauziyah', 11, 'Perempuan', '2025-03-16 21:12:32', '2025-03-16 21:12:32'),
(423, '232401093', '3168064024', 'Rafaeyza Atreo Lesmana', 11, 'Laki-laki', '2025-03-16 21:12:32', '2025-03-16 21:12:32'),
(424, '232401102', '3175255677', 'Shareen Elena Azzahra', 11, 'Perempuan', '2025-03-16 21:12:32', '2025-03-16 21:12:32'),
(425, '232401103', '3164245687', 'Shiraz Muhammad Fatih', 11, 'Laki-laki', '2025-03-16 21:12:32', '2025-03-16 21:12:32'),
(426, '232401112', '3163462018', 'Zalyka Khaliluna Santapradja', 11, 'Perempuan', '2025-03-16 21:12:32', '2025-03-16 21:12:32'),
(427, '232401004', '3165055681', 'Abyan Vale Setiawan', 12, 'Laki-laki', '2025-03-16 21:12:33', '2025-03-16 21:12:33'),
(428, '232401010', '3169651270', 'Aisyah Ayudia Inara', 12, 'Perempuan', '2025-03-16 21:12:33', '2025-03-16 21:12:33'),
(429, '232401015', '3177054730', 'Aldebaran Putra Pratama', 12, 'Laki-laki', '2025-03-16 21:12:33', '2025-03-16 21:12:33'),
(430, '232401016', '3163511287', 'Alesha Azqiara Firmansyah', 12, 'Perempuan', '2025-03-16 21:12:33', '2025-03-16 21:12:33'),
(431, '232401020', '3169597243', 'Aluna Shafiya', 12, 'Perempuan', '2025-03-16 21:12:33', '2025-03-16 21:12:33'),
(432, '232401023', '3178468197', 'Aqila Zhafira Al Faruqi', 12, 'Perempuan', '2025-03-16 21:12:33', '2025-03-16 21:12:33'),
(433, '232401026', '3177045266', 'Arsakha Moussa Al Ghazali', 12, 'Laki-laki', '2025-03-16 21:12:33', '2025-03-16 21:12:33'),
(434, '232401027', '3170786855', 'Arsy Naifa Wijaya', 12, 'Perempuan', '2025-03-16 21:12:33', '2025-03-16 21:12:33'),
(435, '232401029', '3162713517', 'Arzachel Muhammad Ravasya', 12, 'Laki-laki', '2025-03-16 21:12:33', '2025-03-16 21:12:33'),
(436, '232401036', '3179529056', 'Dafiya Almahyra Jati', 12, 'Perempuan', '2025-03-16 21:12:33', '2025-03-16 21:12:33'),
(437, '232401046', '3167829643', 'Fiko Abiyu Hail', 12, 'Laki-laki', '2025-03-16 21:12:33', '2025-03-16 21:12:33'),
(438, '232401048', '3164543985', 'Hafsha Medina Althafunnisa', 12, 'Perempuan', '2025-03-16 21:12:33', '2025-03-16 21:12:33'),
(439, '232401052', '3166514139', 'Hannan Khairul Fawwaz', 12, 'Laki-laki', '2025-03-16 21:12:33', '2025-03-16 21:12:33'),
(440, '232401065', '3176780997', 'Malika Farzana Taqwa', 12, 'Perempuan', '2025-03-16 21:12:33', '2025-03-16 21:12:33'),
(441, '232401066', '3176923980', 'Maliqa Kamilia Fahmi', 12, 'Perempuan', '2025-03-16 21:12:33', '2025-03-16 21:12:33'),
(442, '232401067', '3179648486', 'Maraca Takbir Naoka Sabil', 12, 'Laki-laki', '2025-03-16 21:12:33', '2025-03-16 21:12:33'),
(443, '232401076', '3167247579', 'Muhammad Aqramudzaki Ramadhan', 12, 'Laki-laki', '2025-03-16 21:12:33', '2025-03-16 21:12:33'),
(444, '232401080', '3162001874', 'Muhammad Ibrahim Ghaisan', 12, 'Laki-laki', '2025-03-16 21:12:33', '2025-03-16 21:12:33'),
(445, '232401081', '0137687782', 'Muhammad Mikail Arrasykhan', 12, 'Laki-laki', '2025-03-16 21:12:33', '2025-03-16 21:12:33'),
(446, '232401085', '3162080190', 'Mumtazah Nur Rahman', 12, 'Perempuan', '2025-03-16 21:12:33', '2025-03-16 21:12:33'),
(447, '232401087', '3172570300', 'Nararya Parama Cakrawangsa', 12, 'Laki-laki', '2025-03-16 21:12:34', '2025-03-16 21:12:34'),
(448, '232401088', '3164164127', 'Narisha Abigail Sonaji', 12, 'Perempuan', '2025-03-16 21:12:34', '2025-03-16 21:12:34'),
(449, '232401089', '3160962960', 'Nasha Ghina Adnadiantoro', 12, 'Perempuan', '2025-03-16 21:12:34', '2025-03-16 21:12:34'),
(450, '232401096', '3168103364', 'Raja Athar Brigiant', 12, 'Laki-laki', '2025-03-16 21:12:34', '2025-03-16 21:12:34'),
(451, '232401097', '3169368624', 'Ratu Savana Rinjani', 12, 'Perempuan', '2025-03-16 21:12:34', '2025-03-16 21:12:34'),
(452, '232401098', '3177323604', 'Rezvan Athaya Jayanata', 12, 'Laki-laki', '2025-03-16 21:12:34', '2025-03-16 21:12:34'),
(453, '232401107', '3175794572', 'Vidya Mughni Saleha', 12, 'Perempuan', '2025-03-16 21:12:34', '2025-03-16 21:12:34'),
(454, '232401110', '3177535095', 'Zahira Adreena Raya', 12, 'Perempuan', '2025-03-16 21:12:34', '2025-03-16 21:12:34'),
(455, '232401002', '3173008052', 'Abizar Khairan Wibowo', 13, 'Laki-laki', '2025-03-16 21:12:34', '2025-03-16 21:12:34'),
(456, '232401007', '3172046211', 'Afiya Ilmany Satrya', 13, 'Perempuan', '2025-03-16 21:12:34', '2025-03-16 21:12:34'),
(457, '232401011', '3175952595', 'Aisyah Khairina', 13, 'Perempuan', '2025-03-16 21:12:34', '2025-03-16 21:12:34'),
(458, '232401013', '3163624282', 'Aisyah Silmi Afiqa', 13, 'Perempuan', '2025-03-16 21:12:34', '2025-03-16 21:12:34'),
(459, '232401017', '3169768304', 'Allea Nabila Rinaldi', 13, 'Perempuan', '2025-03-16 21:12:34', '2025-03-16 21:12:34'),
(460, '232401022', '3176204340', 'Annasya Adreena Saila', 13, 'Perempuan', '2025-03-16 21:12:34', '2025-03-16 21:12:34'),
(461, '232401038', '3177264768', 'Earlyta Arsyfa Iriyana Isdian', 13, 'Perempuan', '2025-03-16 21:12:34', '2025-03-16 21:12:34'),
(462, '232401041', '3160684674', 'Faiqa Tsurayya', 13, 'Perempuan', '2025-03-16 21:12:34', '2025-03-16 21:12:34'),
(463, '232401043', '3164738888', 'Faizan Shakiel Alfarizi', 13, 'Laki-laki', '2025-03-16 21:12:34', '2025-03-16 21:12:34'),
(464, '232401044', '3176781704', 'Farel Nabil Alfarizi', 13, 'Laki-laki', '2025-03-16 21:12:34', '2025-03-16 21:12:34'),
(465, '232401049', '3176789647', 'Hanif Abqary Maulana', 13, 'Laki-laki', '2025-03-16 21:12:34', '2025-03-16 21:12:34'),
(466, '232401051', '3179454279', 'Hannaira Kalani Adzra Haryadi', 13, 'Perempuan', '2025-03-16 21:12:34', '2025-03-16 21:12:34'),
(467, '232401053', '3168806233', 'Hannan Masyfu\' Zuhdy', 13, 'Laki-laki', '2025-03-16 21:12:34', '2025-03-16 21:12:34'),
(468, '232401054', '3175936943', 'Ibnu Sina Albani', 13, 'Laki-laki', '2025-03-16 21:12:35', '2025-03-16 21:12:35'),
(469, '232401055', '3174279350', 'Kailash Arrayyan Wibowo', 13, 'Laki-laki', '2025-03-16 21:12:35', '2025-03-16 21:12:35'),
(470, '232401062', '3178447295', 'Khaylila Zaira Surahman', 13, 'Perempuan', '2025-03-16 21:12:35', '2025-03-16 21:12:35'),
(471, '232401063', '3164692774', 'Khayri Tsaqib Ath-Thahir', 13, 'Laki-laki', '2025-03-16 21:12:35', '2025-03-16 21:12:35'),
(472, '232401069', '3171185624', 'Maryam Zhafira', 13, 'Perempuan', '2025-03-16 21:12:35', '2025-03-16 21:12:35'),
(473, '232401082', '3175017976', 'Muhammad Rafif Farqah', 13, 'Laki-laki', '2025-03-16 21:12:36', '2025-03-16 21:12:36'),
(474, '232401091', '3178478851', 'Nazmya Wafia Solehudin', 13, 'Perempuan', '2025-03-16 21:12:36', '2025-03-16 21:12:36'),
(475, '232401092', '3174075703', 'Niq Adresia Geniee', 13, 'Perempuan', '2025-03-16 21:12:36', '2025-03-16 21:12:36'),
(476, '232401094', '3167897617', 'Rafassya Virendra Shaquille Sihombing', 13, 'Laki-laki', '2025-03-16 21:12:36', '2025-03-16 21:12:36'),
(477, '232401095', '3163462961', 'Rainysora Assyifa', 13, 'Perempuan', '2025-03-16 21:12:36', '2025-03-16 21:12:36'),
(478, '232401099', '3175844181', 'Shana Rainun Hafiedza', 13, 'Perempuan', '2025-03-16 21:12:36', '2025-03-16 21:12:36'),
(479, '232401104', '3178914023', 'Sulthon Abdul Jalil Khoiruddin', 13, 'Laki-laki', '2025-03-16 21:12:36', '2025-03-16 21:12:36'),
(480, '232401105', '3175496465', 'Tsabit Faizul Furqon', 13, 'Laki-laki', '2025-03-16 21:12:36', '2025-03-16 21:12:36'),
(481, '232401109', '0179019313', 'Yusuf Ahmad Al-Ghazi Purwanto', 13, 'Laki-laki', '2025-03-16 21:12:36', '2025-03-16 21:12:36'),
(482, '232401111', '3175349981', 'Zahra Ramadina Wibowo', 13, 'Perempuan', '2025-03-16 21:12:36', '2025-03-16 21:12:36'),
(483, '222301003', '3160200273', 'Adzkiya Sabrina Excellin', 14, 'Perempuan', '2025-03-16 21:14:59', '2025-03-16 21:14:59'),
(484, '222301009', '3168821199', 'Altharik Bramantya Adinegara', 14, 'Laki-laki', '2025-03-16 21:14:59', '2025-03-16 21:14:59'),
(485, '222301089', '3150406180', 'Arsyil Athaya Rakana', 14, 'Laki-laki', '2025-03-16 21:14:59', '2025-03-16 21:14:59'),
(486, '222301012', '3151857574', 'Athifa Putri Nurindra', 14, 'Perempuan', '2025-03-16 21:14:59', '2025-03-16 21:14:59'),
(487, '222301015', '3152029333', 'Ayri Atlantic Sunarya', 14, 'Perempuan', '2025-03-16 21:14:59', '2025-03-16 21:14:59'),
(488, '222301064', '3164286772', 'Aysha Shaqueena Budiman', 14, 'Perempuan', '2025-03-16 21:14:59', '2025-03-16 21:14:59'),
(489, '222301092', '3150806252', 'Elquinta Sanidya', 14, 'Perempuan', '2025-03-16 21:14:59', '2025-03-16 21:14:59'),
(490, '222301021', '3150726357', 'Faezia Kaureen Purnomo', 14, 'Perempuan', '2025-03-16 21:14:59', '2025-03-16 21:14:59'),
(491, '222301069', '0162573841', 'Fayyad Ashrafil Dzikri', 14, 'Laki-laki', '2025-03-16 21:14:59', '2025-03-16 21:14:59'),
(492, '222301031', '3157711631', 'Kenzie Alfarizki Irawan', 14, 'Laki-laki', '2025-03-16 21:14:59', '2025-03-16 21:14:59'),
(493, '222301095', '3158077867', 'Kiran Alesha Inara', 14, 'Perempuan', '2025-03-16 21:14:59', '2025-03-16 21:14:59'),
(494, '222301073', '0158935975', 'La Ode Hamzah Abdurrahman Davis', 14, 'Laki-laki', '2025-03-16 21:14:59', '2025-03-16 21:14:59'),
(495, '222301096', '3158041662', 'Laqifha Ghaniya Ramadhaniva Praditya', 14, 'Perempuan', '2025-03-16 21:14:59', '2025-03-16 21:14:59'),
(496, '222301035', '3151082667', 'Mazaya Rizqi Putri Maulana', 14, 'Perempuan', '2025-03-16 21:14:59', '2025-03-16 21:14:59'),
(497, '222301118', '3156303880', 'Moch. Fabyandra Bagas Akbar', 14, 'Laki-laki', '2025-03-16 21:14:59', '2025-03-16 21:14:59'),
(498, '222301075', '3152890809', 'Muhamad Athar Aditya Nagara', 14, 'Laki-laki', '2025-03-16 21:14:59', '2025-03-16 21:14:59'),
(499, '222301038', '3164341892', 'Muhammad Abrar Rasyad', 14, 'Laki-laki', '2025-03-16 21:14:59', '2025-03-16 21:14:59'),
(500, '222301040', '3157912897', 'Muhammad Haidar Fathul Islam', 14, 'Laki-laki', '2025-03-16 21:14:59', '2025-03-16 21:14:59'),
(501, '222301101', '0164105306', 'Muhammad Rasya Aji Putra', 14, 'Laki-laki', '2025-03-16 21:14:59', '2025-03-16 21:14:59'),
(502, '222301043', '3152721383', 'Muthia Adzkia Zahidah', 14, 'Perempuan', '2025-03-16 21:14:59', '2025-03-16 21:14:59'),
(503, '222301102', '3169417199', 'Naura Syafa Azkadina', 14, 'Perempuan', '2025-03-16 21:14:59', '2025-03-16 21:14:59'),
(504, '222301079', '3152437563', 'Nuha Virendra Dinata', 14, 'Laki-laki', '2025-03-16 21:14:59', '2025-03-16 21:14:59'),
(505, '222301106', '3156611507', 'Renata Sofia Heriyansyah', 14, 'Perempuan', '2025-03-16 21:14:59', '2025-03-16 21:14:59'),
(506, '222301048', '3153374988', 'Salasika Shahia Allura', 14, 'Perempuan', '2025-03-16 21:14:59', '2025-03-16 21:14:59'),
(507, '222301081', '3160459429', 'Shabira Zahira Hibatillah Johari', 14, 'Perempuan', '2025-03-16 21:15:00', '2025-03-16 21:15:00'),
(508, '222301110', '3159834216', 'Syahira Nazla Hafidzah', 14, 'Perempuan', '2025-03-16 21:15:00', '2025-03-16 21:15:00'),
(509, '222301057', '3167782510', 'Adeva Afsyen Rakasiwi', 15, 'Perempuan', '2025-03-16 21:15:00', '2025-03-16 21:15:00'),
(510, '222301084', '3154355752', 'Aldrian Satriadhi Wicaksono', 15, 'Laki-laki', '2025-03-16 21:15:00', '2025-03-16 21:15:00'),
(511, '222301086', '3159736230', 'Annisa Hayfa Maulydina', 15, 'Perempuan', '2025-03-16 21:15:00', '2025-03-16 21:15:00'),
(512, '222301088', '3169412501', 'Arsy Rizqiya Ramadhani', 15, 'Perempuan', '2025-03-16 21:15:00', '2025-03-16 21:15:00'),
(513, '222301016', '3152824091', 'Ayshaira Azmya Putri Maulana', 15, 'Perempuan', '2025-03-16 21:15:00', '2025-03-16 21:15:00'),
(514, '222301017', '3153392897', 'Bagas Almairi Faisal', 15, 'Laki-laki', '2025-03-16 21:15:00', '2025-03-16 21:15:00'),
(515, '222301068', '3166840774', 'Farah Islamidiena', 15, 'Perempuan', '2025-03-16 21:15:00', '2025-03-16 21:15:00'),
(516, '222301023', '3154941223', 'Fathya Nur Sabrina', 15, 'Perempuan', '2025-03-16 21:15:00', '2025-03-16 21:15:00'),
(517, '222301026', '3167549097', 'Felovea Hima Riensya', 15, 'Perempuan', '2025-03-16 21:15:00', '2025-03-16 21:15:00'),
(518, '222301070', '0163547434', 'Gafran Alaric Ibrahim', 15, 'Laki-laki', '2025-03-16 21:15:00', '2025-03-16 21:15:00'),
(519, '222301028', '3155328600', 'Gibran Arifin Permana', 15, 'Laki-laki', '2025-03-16 21:15:00', '2025-03-16 21:15:00'),
(520, '232402116', '3159810196', 'Hasna Ayu Nabila', 15, 'Perempuan', '2025-03-16 21:15:00', '2025-03-16 21:15:00'),
(521, '222301093', '0153276852', 'Ines Qoirina Rahmani', 15, 'Perempuan', '2025-03-16 21:15:00', '2025-03-16 21:15:00'),
(522, '222301094', '3154346472', 'Khalifa Arkananta Abdillah', 15, 'Laki-laki', '2025-03-16 21:15:00', '2025-03-16 21:15:00'),
(523, '222301034', '3166914188', 'Malika Nasywa Azzahra', 15, 'Perempuan', '2025-03-16 21:15:00', '2025-03-16 21:15:00'),
(524, '222301074', '3168399215', 'Maryam Nazma Rolanda', 15, 'Perempuan', '2025-03-16 21:15:01', '2025-03-16 21:15:01'),
(525, '222301076', '3156675431', 'Muhammad Adhyasta Putra Hidyansyah', 15, 'Laki-laki', '2025-03-16 21:15:01', '2025-03-16 21:15:01'),
(526, '222301041', '3152011507', 'Muhammad Qaiser Pradipta Pasha', 15, 'Laki-laki', '2025-03-16 21:15:01', '2025-03-16 21:15:01'),
(527, '222301078', '3161799662', 'Nathisa Hasya Hindarsah', 15, 'Perempuan', '2025-03-16 21:15:01', '2025-03-16 21:15:01'),
(528, '222301080', '3156221159', 'Qurrota Nurkiasatina Teja', 15, 'Perempuan', '2025-03-16 21:15:01', '2025-03-16 21:15:01'),
(529, '222301105', '3155594078', 'Reihana Aqilatunnisa', 15, 'Perempuan', '2025-03-16 21:15:01', '2025-03-16 21:15:01'),
(530, '222301107', '3163486172', 'Revallina Aisya Rivai', 15, 'Perempuan', '2025-03-16 21:15:01', '2025-03-16 21:15:01'),
(531, '222301108', '3162345740', 'Rio Sandiaga Prasetya', 15, 'Laki-laki', '2025-03-16 21:15:01', '2025-03-16 21:15:01'),
(532, '222301049', '3169621539', 'Shabrienia Kusuma Putri', 15, 'Perempuan', '2025-03-16 21:15:01', '2025-03-16 21:15:01'),
(533, '222301052', '3150132491', 'Tsaqib Hafizul Furqon', 15, 'Laki-laki', '2025-03-16 21:15:01', '2025-03-16 21:15:01'),
(534, '222301053', '3168830952', 'Wise Alkarney Paramasatya Dien Muhammad', 15, 'Laki-laki', '2025-03-16 21:15:01', '2025-03-16 21:15:01'),
(535, '232402113', '3161986493', 'Yusuf Lindan Saputra', 15, 'Laki-laki', '2025-03-16 21:15:01', '2025-03-16 21:15:01'),
(536, '222301054', '0152689568', 'Zalfakamil Almira Indrasari', 15, 'Perempuan', '2025-03-16 21:15:01', '2025-03-16 21:15:01'),
(537, '222301002', '3162357417', 'Adzkia Syifa Al Rasyid', 16, 'Perempuan', '2025-03-16 21:15:01', '2025-03-16 21:15:01'),
(538, '222301004', '3164224303', 'Afiqa Nazneen Qonita', 16, 'Perempuan', '2025-03-16 21:15:01', '2025-03-16 21:15:01'),
(539, '222301005', '3169740159', 'Ahmad Aqeel Tsaniy', 16, 'Laki-laki', '2025-03-16 21:15:01', '2025-03-16 21:15:01'),
(540, '222301059', '3154117891', 'Alesha Azfa Zahira', 16, 'Perempuan', '2025-03-16 21:15:01', '2025-03-16 21:15:01'),
(541, '222301006', '3169684603', 'Alesha Bungaliandita', 16, 'Perempuan', '2025-03-16 21:15:01', '2025-03-16 21:15:01'),
(542, '222301007', '3151510305', 'Alkhalifi Hamizan Raymos', 16, 'Laki-laki', '2025-03-16 21:15:01', '2025-03-16 21:15:01'),
(543, '222301010', '3169514703', 'Arisha Manzilia Fauzan', 16, 'Perempuan', '2025-03-16 21:15:02', '2025-03-16 21:15:02'),
(544, '222301063', '3168059645', 'Athaya Hamizan Kurniawan', 16, 'Laki-laki', '2025-03-16 21:15:02', '2025-03-16 21:15:02'),
(545, '222301014', '3165261572', 'Ayra Shidqia Balqis', 16, 'Perempuan', '2025-03-16 21:15:02', '2025-03-16 21:15:02'),
(546, '222301018', '3163319902', 'Cahaya Salsabila', 16, 'Perempuan', '2025-03-16 21:15:02', '2025-03-16 21:15:02'),
(547, '222301019', '3152690637', 'Cheryl Zeeba Arsyfa', 16, 'Perempuan', '2025-03-16 21:15:02', '2025-03-16 21:15:02'),
(548, '222301091', '3152896759', 'Danadyaksa Abyan Nurohman', 16, 'Laki-laki', '2025-03-16 21:15:02', '2025-03-16 21:15:02'),
(549, '222301020', '3158154041', 'Emir Ghanim Erningpraja', 16, 'Laki-laki', '2025-03-16 21:15:02', '2025-03-16 21:15:02'),
(550, '222301067', '3157737583', 'Fahira Anindya Asrori', 16, 'Perempuan', '2025-03-16 21:15:02', '2025-03-16 21:15:02'),
(551, '222301022', '3155700345', 'Fathiya Alisha Zahra', 16, 'Perempuan', '2025-03-16 21:15:02', '2025-03-16 21:15:02'),
(552, '222301030', '3155758803', 'Kaliandra Althafunnizam Umari', 16, 'Laki-laki', '2025-03-16 21:15:02', '2025-03-16 21:15:02'),
(553, '242503118', '3163066918', 'Kenziro Aqila Resyafano', 16, 'Laki-laki', '2025-03-16 21:15:02', '2025-03-16 21:15:02'),
(554, '222301032', '0168504771', 'Khalil Alandra Wibawa', 16, 'Laki-laki', '2025-03-16 21:15:02', '2025-03-16 21:15:02'),
(555, '222301033', '3151449322', 'Kirana Niandra Aryasena', 16, 'Perempuan', '2025-03-16 21:15:02', '2025-03-16 21:15:02'),
(556, '222301098', '3155156655', 'Makaila Jihan Alesha', 16, 'Perempuan', '2025-03-16 21:15:02', '2025-03-16 21:15:02'),
(557, '222301039', '3161337375', 'Muhammad Adskhan Safaraz Gunawan', 16, 'Laki-laki', '2025-03-16 21:15:02', '2025-03-16 21:15:02'),
(558, '222301077', '3167154657', 'Muhammad Fauzan Ahza Hamizan', 16, 'Laki-laki', '2025-03-16 21:15:02', '2025-03-16 21:15:02'),
(559, '222301100', '3156567088', 'Muhammad Rafisqi Ahza', 16, 'Laki-laki', '2025-03-16 21:15:02', '2025-03-16 21:15:02'),
(560, '222301042', '0159594911', 'Mumtaz Dzikran Al Faqih', 16, 'Laki-laki', '2025-03-16 21:15:03', '2025-03-16 21:15:03'),
(561, '222301045', '3160581571', 'Nadia Hasna Varisha', 16, 'Perempuan', '2025-03-16 21:15:03', '2025-03-16 21:15:03'),
(562, '222301104', '3158350004', 'Nur Annisa Dewi Luthfiana', 16, 'Perempuan', '2025-03-16 21:15:03', '2025-03-16 21:15:03'),
(563, '222301109', '3154904325', 'Shane Aulia Nafiza', 16, 'Perempuan', '2025-03-16 21:15:03', '2025-03-16 21:15:03'),
(564, '222301051', '0165483092', 'Syafiqa Maritza Nasution', 16, 'Perempuan', '2025-03-16 21:15:03', '2025-03-16 21:15:03'),
(565, '222301082', '3166022519', 'Ukasyah Ibnu Hamzah', 16, 'Laki-laki', '2025-03-16 21:15:03', '2025-03-16 21:15:03'),
(566, '222301001', '3159827564', 'Adiba Arsyfa Khairina', 17, 'Perempuan', '2025-03-16 21:15:03', '2025-03-16 21:15:03'),
(567, '222301058', '3168438267', 'Adreena Shabira Attamimi', 17, 'Perempuan', '2025-03-16 21:15:03', '2025-03-16 21:15:03'),
(568, '222301060', '0169042269', 'Alikha Azalea Putri Cahyadie', 17, 'Perempuan', '2025-03-16 21:15:03', '2025-03-16 21:15:03'),
(569, '222301061', '3152294270', 'Almaira Azzahra Arifin', 17, 'Perempuan', '2025-03-16 21:15:03', '2025-03-16 21:15:03'),
(570, '222301085', '3160433415', 'Almeer Leivano Totti Syahresqi', 17, 'Laki-laki', '2025-03-16 21:15:03', '2025-03-16 21:15:03'),
(571, '222301011', '3150812868', 'Arkan Rasyid Prawira', 17, 'Laki-laki', '2025-03-16 21:15:03', '2025-03-16 21:15:03'),
(572, '222301062', '3164411484', 'Athalla Putra Wargadibrata', 17, 'Laki-laki', '2025-03-16 21:15:03', '2025-03-16 21:15:03'),
(573, '222301013', '3161956975', 'Avalia Dara Budiman', 17, 'Perempuan', '2025-03-16 21:15:03', '2025-03-16 21:15:03'),
(574, '222301090', '3164637904', 'Azzalea Mikhayla Humaira', 17, 'Perempuan', '2025-03-16 21:15:03', '2025-03-16 21:15:03'),
(575, '222301065', '3162025646', 'Carissa Nabila Indrawan', 17, 'Perempuan', '2025-03-16 21:15:03', '2025-03-16 21:15:03'),
(576, '222301066', '3158120903', 'Daffa Arezky Yusuf Wardhana', 17, 'Laki-laki', '2025-03-16 21:15:03', '2025-03-16 21:15:03'),
(577, '222301024', '3162301843', 'Fatimah Husnul Muazzizah', 17, 'Perempuan', '2025-03-16 21:15:03', '2025-03-16 21:15:03'),
(578, '222301025', '3150250218', 'Felicia Renata Aimi', 17, 'Perempuan', '2025-03-16 21:15:03', '2025-03-16 21:15:03'),
(579, '222301027', '3156755757', 'Ghaitsa Melody Satifa', 17, 'Perempuan', '2025-03-16 21:15:03', '2025-03-16 21:15:03'),
(580, '222301029', '3165818644', 'Iftina Assyabiya Rafifa', 17, 'Perempuan', '2025-03-16 21:15:03', '2025-03-16 21:15:03'),
(581, '222301072', '3160419413', 'Imam Musthafa Ibrahim', 17, 'Laki-laki', '2025-03-16 21:15:03', '2025-03-16 21:15:03'),
(582, '222301097', '0137867401', 'Luqman Fachry Sadikin', 17, 'Laki-laki', '2025-03-16 21:15:03', '2025-03-16 21:15:03'),
(583, '222301036', '0143546447', 'Mazra Fadhlullah', 17, 'Laki-laki', '2025-03-16 21:15:03', '2025-03-16 21:15:03'),
(584, '222301037', '3169601408', 'Miratusani Marfin', 17, 'Perempuan', '2025-03-16 21:15:03', '2025-03-16 21:15:03'),
(585, '222301099', '3164136795', 'Muhammad Ghifary Zafran Fachreza', 17, 'Laki-laki', '2025-03-16 21:15:04', '2025-03-16 21:15:04'),
(586, '222301044', '3153854191', 'Nabila Putri Kinara', 17, 'Perempuan', '2025-03-16 21:15:04', '2025-03-16 21:15:04'),
(587, '222301103', '3169153072', 'Novelty Khoir Nasution', 17, 'Laki-laki', '2025-03-16 21:15:04', '2025-03-16 21:15:04'),
(588, '222301046', '3152392929', 'Rafassya Ammar Alfathan', 17, 'Laki-laki', '2025-03-16 21:15:04', '2025-03-16 21:15:04'),
(589, '222301047', '3155342609', 'Sabita Elmira Tamsil', 17, 'Perempuan', '2025-03-16 21:15:04', '2025-03-16 21:15:04'),
(590, '222301050', '3165722210', 'Shakila Zoey Kayyisah', 17, 'Perempuan', '2025-03-16 21:15:04', '2025-03-16 21:15:04'),
(591, '222301083', '3157380309', 'Zahira Suraiya Hanifah', 17, 'Perempuan', '2025-03-16 21:15:04', '2025-03-16 21:15:04'),
(592, '222301055', '3156187466', 'Zhafira Zahratu Almaira Prayogo', 17, 'Perempuan', '2025-03-16 21:15:04', '2025-03-16 21:15:04'),
(593, '222301056', '3150821106', 'Zubair Al Kahfi', 17, 'Laki-laki', '2025-03-16 21:15:04', '2025-03-16 21:15:04'),
(594, '212201001', '0149992130', 'Abdullah Fattah Rommy Suheri', 18, 'Laki-laki', '2025-03-17 00:17:38', '2025-03-17 00:17:38'),
(595, '212201009', '0142631042', 'Ahmad Orie Syahidan', 18, 'Laki-laki', '2025-03-17 00:17:38', '2025-03-17 00:17:38'),
(596, '212201010', '3143386945', 'Aiko Prameswari Puspa Atmaja', 18, 'Perempuan', '2025-03-17 00:17:38', '2025-03-17 00:17:38'),
(597, '212201015', '3140827322', 'Amirah Bilqis', 18, 'Perempuan', '2025-03-17 00:17:38', '2025-03-17 00:17:38'),
(598, '212201016', '0145289948', 'Annas Fadhillah Gumilang', 18, 'Laki-laki', '2025-03-17 00:17:39', '2025-03-17 00:17:39'),
(599, '212201026', '3157147625', 'Banun Khairi Rasyid Al Khalifi', 18, 'Laki-laki', '2025-03-17 00:17:39', '2025-03-17 00:17:39'),
(600, '212201028', '0159014211', 'Candrasa Dwi Wardono', 18, 'Laki-laki', '2025-03-17 00:17:39', '2025-03-17 00:17:39'),
(601, '212201040', '0144533415', 'Ghibran Vasudeva Krisna Salim', 18, 'Laki-laki', '2025-03-17 00:17:39', '2025-03-17 00:17:39'),
(602, '212201045', '0159187128', 'Hafiza Khaira Lubna', 18, 'Perempuan', '2025-03-17 00:17:40', '2025-03-17 00:17:40'),
(603, '212201046', '0157116458', 'Hania Muntafizha', 18, 'Perempuan', '2025-03-17 00:17:40', '2025-03-17 00:17:40'),
(604, '212201047', '0147418308', 'Haruna Vierza Wardhana', 18, 'Laki-laki', '2025-03-17 00:17:40', '2025-03-17 00:17:40'),
(605, '242501116', '0141473698', 'Kamilla Aisha Restrindya', 18, 'Perempuan', '2025-03-17 00:17:41', '2025-03-17 00:17:41'),
(606, '212201054', '0146829735', 'Keanu Anarghya Tsani', 18, 'Laki-laki', '2025-03-17 00:17:41', '2025-03-17 00:17:41'),
(607, '212201060', '0148663400', 'Kiyomi Aira Putri Cahyadie', 18, 'Perempuan', '2025-03-17 00:17:41', '2025-03-17 00:17:41'),
(608, '212201061', '3155172934', 'Luqyana Khalwa Salima', 18, 'Perempuan', '2025-03-17 00:17:41', '2025-03-17 00:17:41'),
(609, '212201062', '3141608248', 'Mahira Luvita Robby', 18, 'Perempuan', '2025-03-17 00:17:41', '2025-03-17 00:17:41'),
(610, '212201064', '0158803223', 'Mecca Shabira Aisya', 18, 'Perempuan', '2025-03-17 00:17:41', '2025-03-17 00:17:41'),
(611, '212201065', '0158557310', 'Meyranezka Genayu Maulana', 18, 'Perempuan', '2025-03-17 00:17:41', '2025-03-17 00:17:41'),
(612, '212201068', '0149743551', 'Muhammad Afham Syafieq', 18, 'Laki-laki', '2025-03-17 00:17:41', '2025-03-17 00:17:41'),
(613, '212201072', '0133147554', 'Muhammad Arqan Alkhalifi', 18, 'Laki-laki', '2025-03-17 00:17:42', '2025-03-17 00:17:42'),
(614, '212201080', '0141326846', 'Muhammad Makaio El Barra', 18, 'Laki-laki', '2025-03-17 00:17:42', '2025-03-17 00:17:42'),
(615, '212201081', '0157315754', 'Muhammad Najib', 18, 'Laki-laki', '2025-03-17 00:17:42', '2025-03-17 00:17:42'),
(616, '212201083', '0149873943', 'Muhammad Ribha Daroyn', 18, 'Laki-laki', '2025-03-17 00:17:42', '2025-03-17 00:17:42'),
(617, '212201095', '0135105808', 'Rizky Almair Zaidan', 18, 'Laki-laki', '2025-03-17 00:17:42', '2025-03-17 00:17:42'),
(618, '212201098', '3154305442', 'Sarah Husni Faqihah', 18, 'Perempuan', '2025-03-17 00:17:42', '2025-03-17 00:17:42'),
(619, '222302122', '0141766663', 'Tubagus Ihsan Musyaffa', 18, 'Laki-laki', '2025-03-17 00:17:42', '2025-03-17 00:17:42'),
(620, '212201106', '3144330677', 'Yumna fariha maulana', 18, 'Perempuan', '2025-03-17 00:17:42', '2025-03-17 00:17:42'),
(621, '222302119', '3147196419', 'Zahra Ayna Mardhiyyah', 18, 'Perempuan', '2025-03-17 00:17:42', '2025-03-17 00:17:42'),
(622, '212201004', '0142662613', 'Adila Fatina', 19, 'Perempuan', '2025-03-17 00:17:43', '2025-03-17 00:17:43'),
(623, '212201007', '0143896375', 'Ahmad Fauzan Yahya', 19, 'Laki-laki', '2025-03-17 00:17:44', '2025-03-17 00:17:44'),
(624, '212201011', '3151232929', 'Aisy Adwayuna Salfigie', 19, 'Perempuan', '2025-03-17 00:17:44', '2025-03-17 00:17:44'),
(625, '212201013', '0147191913', 'Aisyah Putri Khairunnisa', 19, 'Perempuan', '2025-03-17 00:17:44', '2025-03-17 00:17:44'),
(626, '212201018', '0146608201', 'Arsya Raisya Tirtasuwanda', 19, 'Perempuan', '2025-03-17 00:17:44', '2025-03-17 00:17:44'),
(627, '212201021', '3148881661', 'Asqala Farras Adhiba', 19, 'Perempuan', '2025-03-17 00:17:44', '2025-03-17 00:17:44'),
(628, '212201023', '3149846038', 'Ayudia inara ferdians', 19, 'Perempuan', '2025-03-17 00:17:44', '2025-03-17 00:17:44'),
(629, '212201024', '0154006623', 'Azril Raditya Azikin', 19, 'Laki-laki', '2025-03-17 00:17:44', '2025-03-17 00:17:44'),
(630, '212201025', '3142210208', 'Azzaky Prawira Abisatya', 19, 'Laki-laki', '2025-03-17 00:17:44', '2025-03-17 00:17:44'),
(631, '212201031', '0159391615', 'Fahrezi Dzikrullah Wibowo', 19, 'Laki-laki', '2025-03-17 00:17:44', '2025-03-17 00:17:44'),
(632, '212201032', '0158103986', 'Falah Akbar Billah', 19, 'Laki-laki', '2025-03-17 00:17:44', '2025-03-17 00:17:44'),
(633, '212201037', '0156509819', 'Fayhaa Aida Kamil', 19, 'Perempuan', '2025-03-17 00:17:45', '2025-03-17 00:17:45'),
(634, '212201038', '0146107660', 'Gendhis Diah Pitaloka', 19, 'Perempuan', '2025-03-17 00:17:45', '2025-03-17 00:17:45'),
(635, '212201053', '0141597246', 'Kayana Yasser Permana', 19, 'Laki-laki', '2025-03-17 00:17:45', '2025-03-17 00:17:45'),
(636, '212201057', '0142752960', 'Khaizan Athar Alfatih', 19, 'Laki-laki', '2025-03-17 00:17:45', '2025-03-17 00:17:45'),
(637, '212201063', '0144168163', 'Mas Dastan Hafiz Alvino', 19, 'Laki-laki', '2025-03-17 00:17:45', '2025-03-17 00:17:45'),
(638, '212201071', '0142313539', 'Muhammad Alfareeza Putra Jayadi', 19, 'Laki-laki', '2025-03-17 00:17:45', '2025-03-17 00:17:45'),
(639, '212201074', '0153723378', 'Muhammad Farhan Alfatih', 19, 'Laki-laki', '2025-03-17 00:17:45', '2025-03-17 00:17:45'),
(640, '212201076', '3145842949', 'Muhammad Haqqy Wirakartakusumah', 19, 'Laki-laki', '2025-03-17 00:17:45', '2025-03-17 00:17:45'),
(641, '212201077', '0149804999', 'Muhammad Jaladhi Abhirama Arsyad', 19, 'Laki-laki', '2025-03-17 00:17:46', '2025-03-17 00:17:46'),
(642, '212201084', '0148848669', 'Muhammad Zaqi Kurnia Putra', 19, 'Laki-laki', '2025-03-17 00:17:46', '2025-03-17 00:17:46'),
(643, '212201089', '0143610848', 'Nuha Nabilah', 19, 'Perempuan', '2025-03-17 00:17:46', '2025-03-17 00:17:46'),
(644, '222302112', '0147333235', 'Raiqa Labibah Khaira', 19, 'Perempuan', '2025-03-17 00:17:46', '2025-03-17 00:17:46'),
(645, '212201096', '3151074786', 'Sahiyyah Aila Dyari', 19, 'Perempuan', '2025-03-17 00:17:46', '2025-03-17 00:17:46'),
(646, '212201099', '3149951857', 'SHAFIA RAFANIA PUTRI', 19, 'Perempuan', '2025-03-17 00:17:46', '2025-03-17 00:17:46'),
(647, '212201102', '0146938171', 'Umair Ibnu Hamzah', 19, 'Laki-laki', '2025-03-17 00:17:46', '2025-03-17 00:17:46'),
(648, '212201104', '0142751664', 'Uwais Al Fatih', 19, 'Laki-laki', '2025-03-17 00:17:46', '2025-03-17 00:17:46'),
(649, '212201108', '0148470731', 'Zahra Khoerunisa Anwar', 19, 'Perempuan', '2025-03-17 00:17:46', '2025-03-17 00:17:46'),
(650, '21220112', '0148593857', 'Abrisam Ahmad Rasyid', 20, 'Laki-laki', '2025-03-17 00:17:46', '2025-03-17 00:17:46'),
(651, '212201005', '0146394657', 'Adnazaidan Zafir Boniran', 20, 'Laki-laki', '2025-03-17 00:17:47', '2025-03-17 00:17:47'),
(652, '212201006', '3159571076', 'Aflahal Mayza Hatta', 20, 'Laki-laki', '2025-03-17 00:17:47', '2025-03-17 00:17:47'),
(653, '212201008', '3150317333', 'Ahmad Kafabihi Ilmi', 20, 'Laki-laki', '2025-03-17 00:17:47', '2025-03-17 00:17:47'),
(654, '212201012', '0142520121', 'Aisyah Azzahra Sopian', 20, 'Perempuan', '2025-03-17 00:17:47', '2025-03-17 00:17:47'),
(655, '212201017', '0141643271', 'Annazwa Kaunia', 20, 'Perempuan', '2025-03-17 00:17:47', '2025-03-17 00:17:47'),
(656, '212201020', '0138480095', 'Askha Aretha Azla', 20, 'Perempuan', '2025-03-17 00:17:47', '2025-03-17 00:17:47'),
(657, '212201022', '0143545625', 'Aura Loveliyah Mardiyanto', 20, 'Perempuan', '2025-03-17 00:17:47', '2025-03-17 00:17:47'),
(658, '212201029', '0151433427', 'Dewa Attala Dyandra Andieka', 20, 'Laki-laki', '2025-03-17 00:17:47', '2025-03-17 00:17:47'),
(659, '212201033', '3148161825', 'Farisha Assyira Putri', 20, 'Perempuan', '2025-03-17 00:17:47', '2025-03-17 00:17:47'),
(660, '212201035', '3154186731', 'Fathimah Azzahra Shihab', 20, 'Perempuan', '2025-03-17 00:17:47', '2025-03-17 00:17:47'),
(661, '212201039', '0153586024', 'Ghaisan Akhtarul Akbar', 20, 'Laki-laki', '2025-03-17 00:17:47', '2025-03-17 00:17:47'),
(662, '212201041', '3143797351', 'Gibran Al Habsyi Prabundani', 20, 'Laki-laki', '2025-03-17 00:17:47', '2025-03-17 00:17:47'),
(663, '212201043', '0147849080', 'Granada Maritza Natanegara', 20, 'Perempuan', '2025-03-17 00:17:48', '2025-03-17 00:17:48'),
(664, '212201052', '0142194880', 'Jennahara Nur Simfoni', 20, 'Perempuan', '2025-03-17 00:17:48', '2025-03-17 00:17:48'),
(665, '212201055', '0143366785', 'Ken Shinatriya Ariyuda', 20, 'Laki-laki', '2025-03-17 00:17:48', '2025-03-17 00:17:48'),
(666, '242501115', '0', 'Maryam Hia', 20, 'Perempuan', '2025-03-17 00:17:48', '2025-03-17 00:17:48'),
(667, '212201066', '0142317974', 'Mikha Adiya Abigail', 20, 'Perempuan', '2025-03-17 00:17:48', '2025-03-17 00:17:48'),
(668, '212201067', '0143128831', 'Muchammad Khedira Altaf Ali', 20, 'Laki-laki', '2025-03-17 00:17:49', '2025-03-17 00:17:49'),
(669, '212201075', '3155558929', 'Muhammad Ghaizan El Barra', 20, 'Laki-laki', '2025-03-17 00:17:49', '2025-03-17 00:17:49'),
(670, '212201079', '0145288792', 'Muhammad Luthfan Dhiyaulhaq', 20, 'Laki-laki', '2025-03-17 00:17:49', '2025-03-17 00:17:49'),
(671, '212201082', '0157492711', 'Muhammad Rafa Abdillah', 20, 'Laki-laki', '2025-03-17 00:17:49', '2025-03-17 00:17:49'),
(672, '212201085', '3149160802', 'Nabila Ulya Hafiza Wibisono', 20, 'Perempuan', '2025-03-17 00:17:49', '2025-03-17 00:17:49'),
(673, '212201088', '0157374546', 'Nandanarasya Aqila Aliyurrohim', 20, 'Laki-laki', '2025-03-17 00:17:49', '2025-03-17 00:17:49'),
(674, '212201094', '0141803448', 'Ratu Ayu Sahila', 20, 'Perempuan', '2025-03-17 00:17:49', '2025-03-17 00:17:49'),
(675, '212201100', '0141642135', 'Siti Zahrani Zakirah Fuad', 20, 'Perempuan', '2025-03-17 00:17:49', '2025-03-17 00:17:49');
INSERT INTO `students` (`id`, `nis`, `nisn`, `nama`, `class_id`, `jk`, `created_at`, `updated_at`) VALUES
(676, '212201101', '0157439679', 'Sorayya Zahira Zein', 20, 'Perempuan', '2025-03-17 00:17:49', '2025-03-17 00:17:49'),
(677, '212201107', '0144487266', 'Yuugi Khairan Sisva', 20, 'Laki-laki', '2025-03-17 00:17:49', '2025-03-17 00:17:49'),
(678, '212201002', '0149630300', 'Abraham Aulian Hakim', 21, 'Laki-laki', '2025-03-17 00:17:49', '2025-03-17 00:17:49'),
(679, '212201003', '0147570833', 'Adam Almerio Kamil Sagala', 21, 'Laki-laki', '2025-03-17 00:17:50', '2025-03-17 00:17:50'),
(680, '212201027', '0145244687', 'Callysta Faustine Adzkia', 21, 'Perempuan', '2025-03-17 00:17:50', '2025-03-17 00:17:50'),
(681, '212201036', '0147861347', 'Fatimah Al Husna Alyssa Tagor', 21, 'Perempuan', '2025-03-17 00:17:50', '2025-03-17 00:17:50'),
(682, '212201034', '0152463705', 'Fatimah Azzahra Nurhafizhah', 21, 'Perempuan', '2025-03-17 00:17:50', '2025-03-17 00:17:50'),
(683, '212201042', '3141077037', 'Gibran Shakil Budiman', 21, 'Laki-laki', '2025-03-17 00:17:50', '2025-03-17 00:17:50'),
(684, '212201044', '3142143589', 'Hafidz Aryan Negara', 21, 'Laki-laki', '2025-03-17 00:17:50', '2025-03-17 00:17:50'),
(685, '212201048', '0146131304', 'Hasbie Khairy Gunawan', 21, 'Laki-laki', '2025-03-17 00:17:50', '2025-03-17 00:17:50'),
(686, '212201049', '3143797019', 'Hauna Salsabila Khoirunnisa', 21, 'Perempuan', '2025-03-17 00:17:50', '2025-03-17 00:17:50'),
(687, '212201050', '0147314513', 'Ibrahim Faiza Ahmad', 21, 'Laki-laki', '2025-03-17 00:17:50', '2025-03-17 00:17:50'),
(688, '212201051', '0149195580', 'Ilham Kertapati Budiman', 21, 'Laki-laki', '2025-03-17 00:17:50', '2025-03-17 00:17:50'),
(689, '212201056', '3143246113', 'Kenzie Nour Fayyadhi Farid', 21, 'Laki-laki', '2025-03-17 00:17:51', '2025-03-17 00:17:51'),
(690, '212201058', '0155478255', 'Khayra Wafiqah Taqiyyah', 21, 'Perempuan', '2025-03-17 00:17:51', '2025-03-17 00:17:51'),
(691, '212201059', '0142914438', 'Kiandra Syifa Azzahra', 21, 'Perempuan', '2025-03-17 00:17:51', '2025-03-17 00:17:51'),
(692, '212201069', '3145187531', 'Muhammad Ahda Surya Arrayyan', 21, 'Laki-laki', '2025-03-17 00:17:51', '2025-03-17 00:17:51'),
(693, '212201070', '0148154247', 'Muhammad Akhtar Khalfani', 21, 'Laki-laki', '2025-03-17 00:17:51', '2025-03-17 00:17:51'),
(694, '212201073', '0143622126', 'Muhammad Athar Rey Aristo', 21, 'Laki-laki', '2025-03-17 00:17:51', '2025-03-17 00:17:51'),
(695, '212201078', '0145169114', 'Muhammad Keanu Alvaro', 21, 'Laki-laki', '2025-03-17 00:17:52', '2025-03-17 00:17:52'),
(696, '212201086', '0132121579', 'Nadia Khansa Azzahra', 21, 'Perempuan', '2025-03-17 00:17:52', '2025-03-17 00:17:52'),
(697, '212201087', '0141299563', 'Nafisa Hidayati Suparno', 21, 'Perempuan', '2025-03-17 00:17:52', '2025-03-17 00:17:52'),
(698, '212201090', '3148894248', 'Putri Kayla Shahqueena Purnama Dewi', 21, 'Perempuan', '2025-03-17 00:17:53', '2025-03-17 00:17:53'),
(699, '212201091', '0155199537', 'Radisya Khairina Sakhi', 21, 'Perempuan', '2025-03-17 00:17:53', '2025-03-17 00:17:53'),
(700, '212201092', '0159772356', 'Raisya Khoiriyatul Ummah', 21, 'Perempuan', '2025-03-17 00:17:53', '2025-03-17 00:17:53'),
(701, '212201093', '3159189657', 'Raisya Shafira Andradi', 21, 'Perempuan', '2025-03-17 00:17:53', '2025-03-17 00:17:53'),
(702, '212201097', '0147096255', 'Saif Alfath Putra Eryndra', 21, 'Laki-laki', '2025-03-17 00:17:53', '2025-03-17 00:17:53'),
(703, '232403114', '3143648619', 'Syahir Pasha Azzami', 21, 'Laki-laki', '2025-03-17 00:17:53', '2025-03-17 00:17:53'),
(704, '212201103', '0146777701', 'Ustman Khalish Mirza', 21, 'Laki-laki', '2025-03-17 00:17:53', '2025-03-17 00:17:53'),
(705, '202101005', '0139251180', 'Affan Alidrisi Muhtar', 22, 'Laki-laki', '2025-03-17 00:18:23', '2025-03-17 00:18:23'),
(706, '202101007', '0146842686', 'Ahmad Raihan Malik Al-Fatih', 22, 'Laki-laki', '2025-03-17 00:18:23', '2025-03-17 00:18:23'),
(707, '202101008', '3140863230', 'Aisya Ayat Al-Akhras', 22, 'Perempuan', '2025-03-17 00:18:23', '2025-03-17 00:18:23'),
(708, '202101012', '0144863844', 'Ammara Divyacarla Pulungan', 22, 'Perempuan', '2025-03-17 00:18:23', '2025-03-17 00:18:23'),
(709, '202101018', '3132645740', 'Aqsha Adya Zafran Pujiansyah', 22, 'Laki-laki', '2025-03-17 00:18:23', '2025-03-17 00:18:23'),
(710, '202101024', '0143255429', 'Athar Arkan', 22, 'Laki-laki', '2025-03-17 00:18:23', '2025-03-17 00:18:23'),
(711, '202101027', '0133623682', 'Aulia Syafa Khoirunnisa', 22, 'Perempuan', '2025-03-17 00:18:23', '2025-03-17 00:18:23'),
(712, '202101029', '3136217428', 'Aysar Antartica Sunarya', 22, 'Laki-laki', '2025-03-17 00:18:23', '2025-03-17 00:18:23'),
(713, '202101031', '0134325764', 'Batara Sakti Abiyoso Prianto', 22, 'Laki-laki', '2025-03-17 00:18:24', '2025-03-17 00:18:24'),
(714, '202101036', '0143551194', 'Divia Kaureen Pranata Marzuki', 22, 'Perempuan', '2025-03-17 00:18:24', '2025-03-17 00:18:24'),
(715, '222303114', '0138475726', 'Izarra Ghadia', 22, 'Perempuan', '2025-03-17 00:18:24', '2025-03-17 00:18:24'),
(716, '202101054', '0133254281', 'Karina Aretha Herryadi', 22, 'Perempuan', '2025-03-17 00:18:24', '2025-03-17 00:18:24'),
(717, '202101055', '0134747071', 'Kayden Alfariz Zaindra', 22, 'Laki-laki', '2025-03-17 00:18:24', '2025-03-17 00:18:24'),
(718, '202101056', '0141686309', 'Khaira Damitsa Zahidah', 22, 'Perempuan', '2025-03-17 00:18:24', '2025-03-17 00:18:24'),
(719, '202101059', '0133859834', 'Khansa Amira Sasikirana', 22, 'Perempuan', '2025-03-17 00:18:24', '2025-03-17 00:18:24'),
(720, '202101062', '0145983573', 'Muhammad Abbad Az Zariri', 22, 'Laki-laki', '2025-03-17 00:18:24', '2025-03-17 00:18:24'),
(721, '202101063', '0132995212', 'Muhammad Akhdan Ziyad', 22, 'Laki-laki', '2025-03-17 00:18:24', '2025-03-17 00:18:24'),
(722, '202101066', '3134236922', 'Muhammad Angga Purnama', 22, 'Laki-laki', '2025-03-17 00:18:24', '2025-03-17 00:18:24'),
(723, '202101069', '0131829310', 'Muhammad Benzema Razzaq Ramadhan', 22, 'Laki-laki', '2025-03-17 00:18:24', '2025-03-17 00:18:24'),
(724, '202101072', '0149624105', 'Muhammad Fathan Alghifari Riyandi', 22, 'Laki-laki', '2025-03-17 00:18:24', '2025-03-17 00:18:24'),
(725, '202101078', '0137258755', 'Muhammad Raihan Rizki Habibie', 22, 'Laki-laki', '2025-03-17 00:18:24', '2025-03-17 00:18:24'),
(726, '202101081', '3147371696', 'Muhammad Salman Al Razy', 22, 'Laki-laki', '2025-03-17 00:18:25', '2025-03-17 00:18:25'),
(727, '202101084', '0139163346', 'Nabila Hasna Asyifa', 22, 'Perempuan', '2025-03-17 00:18:25', '2025-03-17 00:18:25'),
(728, '202101087', '0133598764', 'Naura Shafa Reinan', 22, 'Perempuan', '2025-03-17 00:18:25', '2025-03-17 00:18:25'),
(729, '202101091', '3133922925', 'Raisa Khairina Putri', 22, 'Perempuan', '2025-03-17 00:18:25', '2025-03-17 00:18:25'),
(730, '202101110', '0134074393', 'Yaqdhan Arkan Kala Gojali', 22, 'Laki-laki', '2025-03-17 00:18:25', '2025-03-17 00:18:25'),
(731, '202101112', '3138588435', 'Zeska Khansa Khalila Muttaqien', 22, 'Perempuan', '2025-03-17 00:18:25', '2025-03-17 00:18:25'),
(732, '202101001', '0135693751', 'Abiyani Jannati Putri', 23, 'Perempuan', '2025-03-17 00:18:25', '2025-03-17 00:18:25'),
(733, '202101013', '0148347351', 'Andaru Rabbani Rahsyad Bevryanto', 23, 'Laki-laki', '2025-03-17 00:18:25', '2025-03-17 00:18:25'),
(734, '202101015', '0141058072', 'Annida Khaira Pribadi', 23, 'Perempuan', '2025-03-17 00:18:25', '2025-03-17 00:18:25'),
(735, '202101021', '0134664056', 'Arjuna Wistara Nirwasita', 23, 'Laki-laki', '2025-03-17 00:18:25', '2025-03-17 00:18:25'),
(736, '202101023', '0136564222', 'Asoka Giri', 23, 'Perempuan', '2025-03-17 00:18:25', '2025-03-17 00:18:25'),
(737, '202101026', '0132813845', 'Aufarizal Erabbani Alkasha', 23, 'Laki-laki', '2025-03-17 00:18:25', '2025-03-17 00:18:25'),
(738, '202101030', '0137951860', 'Azzura Winayaka Yusuf', 23, 'Laki-laki', '2025-03-17 00:18:25', '2025-03-17 00:18:25'),
(739, '202101034', '0137412973', 'Devandra Ghani Annafi Nugroho', 23, 'Laki-laki', '2025-03-17 00:18:25', '2025-03-17 00:18:25'),
(740, '202101037', '3141991837', 'Dzhafran Ahnafil Khairy', 23, 'Laki-laki', '2025-03-17 00:18:26', '2025-03-17 00:18:26'),
(741, '202101039', '3134967671', 'Dzulqia Zara', 23, 'Perempuan', '2025-03-17 00:18:26', '2025-03-17 00:18:26'),
(742, '202101045', '0136596523', 'Hafiza Alayya Faiqah', 23, 'Perempuan', '2025-03-17 00:18:26', '2025-03-17 00:18:26'),
(743, '202101049', '0139216066', 'Haura Syahla Fatimah', 23, 'Perempuan', '2025-03-17 00:18:26', '2025-03-17 00:18:26'),
(744, '202101052', '0144898552', 'Jahran Abdurrahman Satya', 23, 'Laki-laki', '2025-03-17 00:18:26', '2025-03-17 00:18:26'),
(745, '202101057', '0141010703', 'Khaizura Yariqa Qatrunnada', 23, 'Perempuan', '2025-03-17 00:18:26', '2025-03-17 00:18:26'),
(746, '222303017', '3139400255', 'Marsya Adiba Farin', 23, 'Perempuan', '2025-03-17 00:18:26', '2025-03-17 00:18:26'),
(747, '202101074', '0149355332', 'Muhammad Hasan Sakdan', 23, 'Laki-laki', '2025-03-17 00:18:26', '2025-03-17 00:18:26'),
(748, '202101077', '0134216305', 'Muhammad Radith Febrian', 23, 'Laki-laki', '2025-03-17 00:18:26', '2025-03-17 00:18:26'),
(749, '202101079', '0143275757', 'Muhammad Razka Al Rasyid', 23, 'Laki-laki', '2025-03-17 00:18:26', '2025-03-17 00:18:26'),
(750, '202101080', '0149131787', 'Muhammad Razzan Abidzar', 23, 'Laki-laki', '2025-03-17 00:18:26', '2025-03-17 00:18:26'),
(751, '202101086', '0135350943', 'Naura Afiyah Qonita', 23, 'Perempuan', '2025-03-17 00:18:26', '2025-03-17 00:18:26'),
(752, '202101093', '0136793786', 'Rasya Muhammad Athaya', 23, 'Laki-laki', '2025-03-17 00:18:26', '2025-03-17 00:18:26'),
(753, '202101099', '0141607878', 'Sabian Azka Putra Rustanu', 23, 'Laki-laki', '2025-03-17 00:18:27', '2025-03-17 00:18:27'),
(754, '202101100', '0134283314', 'Sadid Sakho Fidinillah', 23, 'Laki-laki', '2025-03-17 00:18:27', '2025-03-17 00:18:27'),
(755, '202101102', '3142472803', 'Sophia Ayu Anjani', 23, 'Perempuan', '2025-03-17 00:18:27', '2025-03-17 00:18:27'),
(756, '202101103', '0146088164', 'Syahira Khanza Rania Putri', 23, 'Perempuan', '2025-03-17 00:18:27', '2025-03-17 00:18:27'),
(757, '202101105', '3138383812', 'Syamil Shifan Hamid', 23, 'Laki-laki', '2025-03-17 00:18:27', '2025-03-17 00:18:27'),
(758, '202101107', '0139832202', 'Syifa Namira Alfariza', 23, 'Perempuan', '2025-03-17 00:18:28', '2025-03-17 00:18:28'),
(759, '202101004', '3142388936', 'Afdhal Lathief Aziizan', 24, 'Laki-laki', '2025-03-17 00:18:28', '2025-03-17 00:18:28'),
(760, '202101006', '0137584248', 'Afia Ahza Pramesti', 24, 'Perempuan', '2025-03-17 00:18:28', '2025-03-17 00:18:28'),
(761, '202101011', '0132887378', 'Amira Markaziya Fauzan', 24, 'Perempuan', '2025-03-17 00:18:28', '2025-03-17 00:18:28'),
(762, '202101016', '0146884261', 'Apriellya Mutiara Jasmine', 24, 'Perempuan', '2025-03-17 00:18:28', '2025-03-17 00:18:28'),
(763, '202101019', '0149030291', 'Ardhana Hafsya Lefiand', 24, 'Laki-laki', '2025-03-17 00:18:28', '2025-03-17 00:18:28'),
(764, '202101022', '0139271430', 'Ashagiselva Tasmira Rahadian', 24, 'Perempuan', '2025-03-17 00:18:28', '2025-03-17 00:18:28'),
(765, '202101025', '0139096870', 'Athar Ghassan Attaya Pangadjo', 24, 'Laki-laki', '2025-03-17 00:18:28', '2025-03-17 00:18:28'),
(766, '202101028', '3147516853', 'Aurora Kiran Lituhayu', 24, 'Perempuan', '2025-03-17 00:18:28', '2025-03-17 00:18:28'),
(767, '202101033', '0147726743', 'Damar Abrarhakim Kusuma', 24, 'Laki-laki', '2025-03-17 00:18:29', '2025-03-17 00:18:29'),
(768, '202101035', '0131202912', 'Dikveinna Locita Hayatunajah', 24, 'Perempuan', '2025-03-17 00:18:29', '2025-03-17 00:18:29'),
(769, '222303115', '0143603942', 'Evan Narottama Zhafran', 24, 'Laki-laki', '2025-03-17 00:18:29', '2025-03-17 00:18:29'),
(770, '202101043', '0148300257', 'Fikran El Khairan', 24, 'Laki-laki', '2025-03-17 00:18:29', '2025-03-17 00:18:29'),
(771, '202101050', '3137735637', 'Hideo Rakauna Hafiedz', 24, 'Laki-laki', '2025-03-17 00:18:29', '2025-03-17 00:18:29'),
(772, '242505117', '0141172497', 'Izfar Raifan Zibriel', 24, 'Laki-laki', '2025-03-17 00:18:29', '2025-03-17 00:18:29'),
(773, '202101053', '0132541410', 'Jenahara Sachiyori Lovember', 24, 'Perempuan', '2025-03-17 00:18:29', '2025-03-17 00:18:29'),
(774, '202101070', '0135052630', 'Muhammad Didier Ergie Syamsuar', 24, 'Laki-laki', '2025-03-17 00:18:29', '2025-03-17 00:18:29'),
(775, '202101071', '0134069509', 'Muhammad Farhan Dzaky', 24, 'Laki-laki', '2025-03-17 00:18:30', '2025-03-17 00:18:30'),
(776, '202101076', '0136284469', 'Muhammad Nabil Mopangga', 24, 'Laki-laki', '2025-03-17 00:18:30', '2025-03-17 00:18:30'),
(777, '202101082', '0132462412', 'Muhammad Syauqi Ar Raffi Satyagraha', 24, 'Laki-laki', '2025-03-17 00:18:30', '2025-03-17 00:18:30'),
(778, '222303120', '3139411645', 'Muhammad Zhafran Aqila', 24, 'Laki-laki', '2025-03-17 00:18:30', '2025-03-17 00:18:30'),
(779, '202101092', '0143237493', 'Rashif Chaer Farzana Syaban', 24, 'Laki-laki', '2025-03-17 00:18:30', '2025-03-17 00:18:30'),
(780, '202101096', '0136836456', 'Regian Manggala Putra', 24, 'Laki-laki', '2025-03-17 00:18:30', '2025-03-17 00:18:30'),
(781, '202101097', '0137821304', 'Reina Annabeth Lesmana', 24, 'Perempuan', '2025-03-17 00:18:30', '2025-03-17 00:18:30'),
(782, '202101003', '0132073133', 'Shafira Adelia Putri', 24, 'Perempuan', '2025-03-17 00:18:30', '2025-03-17 00:18:30'),
(783, '202101101', '0131720022', 'Shidqya Lathyfa Zuna', 24, 'Perempuan', '2025-03-17 00:18:30', '2025-03-17 00:18:30'),
(784, '202101106', '0146185935', 'Syamima Adziqa Mahira', 24, 'Perempuan', '2025-03-17 00:18:31', '2025-03-17 00:18:31'),
(785, '202101111', '0146073675', 'Zafara Heritsa Maalik', 24, 'Laki-laki', '2025-03-17 00:18:31', '2025-03-17 00:18:31'),
(786, '202101002', '0141834465', 'Abrisam Irfan Yusran', 25, 'Laki-laki', '2025-03-17 00:18:31', '2025-03-17 00:18:31'),
(787, '212202114', '0149449868', 'Ahza Pradipta Wicaksono', 25, 'Laki-laki', '2025-03-17 00:18:31', '2025-03-17 00:18:31'),
(788, '202101017', '0131959924', 'Aqila Putri Satria', 25, 'Perempuan', '2025-03-17 00:18:31', '2025-03-17 00:18:31'),
(789, '202101020', '0135152110', 'Arfan Mikail Avicenna', 25, 'Laki-laki', '2025-03-17 00:18:31', '2025-03-17 00:18:31'),
(790, '202101032', '0133297653', 'Belinda Fitri Melodi', 25, 'Perempuan', '2025-03-17 00:18:31', '2025-03-17 00:18:31'),
(791, '202101038', '0145290042', 'Dzidny Sachio Alery', 25, 'Laki-laki', '2025-03-17 00:18:32', '2025-03-17 00:18:32'),
(792, '202101040', '0134349468', 'Edelweiss Kamilia Sagala', 25, 'Perempuan', '2025-03-17 00:18:32', '2025-03-17 00:18:32'),
(793, '202101044', '0133877140', 'Ghalya Hassya Praceka', 25, 'Perempuan', '2025-03-17 00:18:32', '2025-03-17 00:18:32'),
(794, '202101046', '3131155672', 'Haniayu Pramesti Madyana', 25, 'Perempuan', '2025-03-17 00:18:32', '2025-03-17 00:18:32'),
(795, '222303113', '0138376590', 'Hanifah Mutiara Lubis', 25, 'Perempuan', '2025-03-17 00:18:32', '2025-03-17 00:18:32'),
(796, '202101058', '0143848724', 'Khaliqa Anaya Husna Alkausar', 25, 'Perempuan', '2025-03-17 00:18:32', '2025-03-17 00:18:32'),
(797, '202101060', '3149900262', 'Malikah Azzahra Siregar', 25, 'Perempuan', '2025-03-17 00:18:32', '2025-03-17 00:18:32'),
(798, '202101061', '0142449591', 'Mazaya Haura Shabrina', 25, 'Perempuan', '2025-03-17 00:18:32', '2025-03-17 00:18:32'),
(799, '202101064', '0131501160', 'Muhammad Akram Ziyad', 25, 'Laki-laki', '2025-03-17 00:18:32', '2025-03-17 00:18:32'),
(800, '202101067', '3140425656', 'Muhammad Athar Ismail', 25, 'Laki-laki', '2025-03-17 00:18:32', '2025-03-17 00:18:32'),
(801, '202101068', '0147731507', 'Muhammad Azzam Syifa Al Hadid', 25, 'Laki-laki', '2025-03-17 00:18:33', '2025-03-17 00:18:33'),
(802, '212202110', '3140112777', 'Muhammad Faqih Mubarak', 25, 'Laki-laki', '2025-03-17 00:18:33', '2025-03-17 00:18:33'),
(803, '202101073', '0136725706', 'Muhammad Ghazi Al Barra', 25, 'Laki-laki', '2025-03-17 00:18:33', '2025-03-17 00:18:33'),
(804, '202101083', '131449499', 'Muhammad Zafier Al Ayyubi', 25, 'Laki-laki', '2025-03-17 00:18:33', '2025-03-17 00:18:33'),
(805, '202101085', '3135122138', 'Nadiya Calisha', 25, 'Perempuan', '2025-03-17 00:18:33', '2025-03-17 00:18:33'),
(806, '232404115', '0134269875', 'Nafisah Humaira Izzati', 25, 'Perempuan', '2025-03-17 00:18:34', '2025-03-17 00:18:34'),
(807, '202101089', '0131002575', 'Ozayr Yuanta Marjono', 25, 'Laki-laki', '2025-03-17 00:18:34', '2025-03-17 00:18:34'),
(808, '202101090', '0135696037', 'Prayata Nafi Iskandaria', 25, 'Laki-laki', '2025-03-17 00:18:34', '2025-03-17 00:18:34'),
(809, '202101095', '0146094708', 'Rayandra Fadhilah Sudewo', 25, 'Laki-laki', '2025-03-17 00:18:34', '2025-03-17 00:18:34'),
(810, '202101098', '0136301790', 'Rifqiansyah Pranawa Depianta', 25, 'Laki-laki', '2025-03-17 00:18:34', '2025-03-17 00:18:34'),
(811, '202101108', '3121347154', 'Tsamir Nashrillah Al Kamil Johari', 25, 'Laki-laki', '2025-03-17 00:18:34', '2025-03-17 00:18:34'),
(812, '202101109', '0139201742', 'Wardah Nur Fathimah', 25, 'Perempuan', '2025-03-17 00:18:34', '2025-03-17 00:18:34'),
(813, '192001006', '0125110010', 'Aisyah Zahira Ramadhani', 1, 'Perempuan', '2025-03-17 00:19:17', '2025-03-17 00:19:17'),
(814, '192001009', '0128970710', 'Alifiandra Rasyid Putra Anggriawan', 1, 'Laki-laki', '2025-03-17 00:19:17', '2025-03-17 00:19:17'),
(815, '192001015', '0124210237', 'Aqsazura Kinar Akbar', 1, 'Perempuan', '2025-03-17 00:19:18', '2025-03-17 00:19:18'),
(816, '192001017', '0124107962', 'Arkan Ramaditia Hayza', 1, 'Laki-laki', '2025-03-17 00:19:18', '2025-03-17 00:19:18'),
(817, '192001018', '0132396983', 'Azka Putra Feriansyah', 1, 'Laki-laki', '2025-03-17 00:19:18', '2025-03-17 00:19:18'),
(818, '192001028', '0124417031', 'Fahri Akbar Kadarisman', 1, 'Laki-laki', '2025-03-17 00:19:18', '2025-03-17 00:19:18'),
(819, '192001030', '0129130358', 'Faiq Arsa Pradian', 1, 'Laki-laki', '2025-03-17 00:19:19', '2025-03-17 00:19:19'),
(820, '192001032', '0122313064', 'Fakhru Zubair Akmal', 1, 'Laki-laki', '2025-03-17 00:19:19', '2025-03-17 00:19:19'),
(821, '192001034', '0123786079', 'Gendis Fathiyyah Lestari', 1, 'Perempuan', '2025-03-17 00:19:19', '2025-03-17 00:19:19'),
(822, '192001041', '0129506129', 'Haydar Muhammad Alzam', 1, 'Laki-laki', '2025-03-17 00:19:19', '2025-03-17 00:19:19'),
(823, '192001045', '3121726311', 'Kadziyah Shakila Septiansyah', 1, 'Perempuan', '2025-03-17 00:19:20', '2025-03-17 00:19:20'),
(824, '192001056', '3137919398', 'Luthfi Ahmad Muttaqi', 1, 'Laki-laki', '2025-03-17 00:19:20', '2025-03-17 00:19:20'),
(825, '192001059', '0137858957', 'Makkah Azka Mohammed', 1, 'Laki-laki', '2025-03-17 00:19:20', '2025-03-17 00:19:20'),
(826, '192001062', '0132274511', 'Mirza Izzatul Arshad', 1, 'Laki-laki', '2025-03-17 00:19:20', '2025-03-17 00:19:20'),
(827, '192001069', '0129588483', 'Muhammad Dirga Maizar Rafli', 1, 'Laki-laki', '2025-03-17 00:19:20', '2025-03-17 00:19:20'),
(828, '192001071', '0133906562', 'Muhammad Fatih Alkina', 1, 'Laki-laki', '2025-03-17 00:19:20', '2025-03-17 00:19:20'),
(829, '192001073', '0135266656', 'Muhammad Hilmi Almujahid', 1, 'Laki-laki', '2025-03-17 00:19:21', '2025-03-17 00:19:21'),
(830, '192001074', '0123722565', 'Muhammad Kaysan Kenzie Tigus', 1, 'Laki-laki', '2025-03-17 00:19:21', '2025-03-17 00:19:21'),
(831, '192001079', '0137183308', 'Muhammad Shabiy \nArfan Ar Rifai', 1, 'Laki-laki', '2025-03-17 00:19:21', '2025-03-17 00:19:21'),
(832, '192001084', '0122592264', 'Naifa Alecia Nonci', 1, 'Perempuan', '2025-03-17 00:19:21', '2025-03-17 00:19:21'),
(833, '192001089', '0134128958', 'Naurah Chantika Salsabilla', 1, 'Perempuan', '2025-03-17 00:19:22', '2025-03-17 00:19:22'),
(834, '192001091', '0136830908', 'Quinnara Adni Shakeela', 1, 'Perempuan', '2025-03-17 00:19:22', '2025-03-17 00:19:22'),
(835, '192001097', '0129609631', 'Raisa Salsabila', 1, 'Perempuan', '2025-03-17 00:19:24', '2025-03-17 00:19:24'),
(836, '192001100', '0122607178', 'Rayyan Syazwan Nafiz', 1, 'Laki-laki', '2025-03-17 00:19:24', '2025-03-17 00:19:24'),
(837, '192001109', '0137322751', 'Yumi Faizia Hanifah', 1, 'Perempuan', '2025-03-17 00:19:25', '2025-03-17 00:19:25'),
(838, '192001111', '0126623541', 'Zahrania Dawiyah', 1, 'Perempuan', '2025-03-17 00:19:25', '2025-03-17 00:19:25'),
(839, '192001112', '0126861651', 'Zahrayya Kamila Latisha', 1, 'Perempuan', '2025-03-17 00:19:25', '2025-03-17 00:19:25'),
(840, '192001007', '0133092122', 'Akhtar Byakta Candra', 2, 'Laki-laki', '2025-03-17 00:19:26', '2025-03-17 00:19:26'),
(841, '192001008', '0137838300', 'Alessio Ardana Ismail', 2, 'Laki-laki', '2025-03-17 00:19:26', '2025-03-17 00:19:26'),
(842, '192001020', '0132265094', 'Bianca Nayla', 2, 'Perempuan', '2025-03-17 00:19:26', '2025-03-17 00:19:26'),
(843, '192001022', '0138266059', 'Dama Arkananta Raqilla', 2, 'Laki-laki', '2025-03-17 00:19:26', '2025-03-17 00:19:26'),
(844, '192001023', '3121694075', 'Danendra Canon Zabir', 2, 'Laki-laki', '2025-03-17 00:19:27', '2025-03-17 00:19:27'),
(845, '192001035', '0128794640', 'Ghaida Hudzaifah Azzahra', 2, 'Perempuan', '2025-03-17 00:19:28', '2025-03-17 00:19:28'),
(846, '192001036', '0125507073', 'Ghazanfar Alkhalifi', 2, 'Laki-laki', '2025-03-17 00:19:29', '2025-03-17 00:19:29'),
(847, '192001037', '0134215812', 'Gusti Sabka Yarif Tamsil', 2, 'Laki-laki', '2025-03-17 00:19:29', '2025-03-17 00:19:29'),
(848, '192001038', '0124355913', 'Hafiz Mahendra', 2, 'Laki-laki', '2025-03-17 00:19:30', '2025-03-17 00:19:30'),
(849, '192001040', '3128719299', 'Hatta Zakaria', 2, 'Laki-laki', '2025-03-17 00:19:30', '2025-03-17 00:19:30'),
(850, '212203116', '0125216438', 'Jaris Ataya Finandi Aurum', 2, 'Laki-laki', '2025-03-17 00:19:30', '2025-03-17 00:19:30'),
(851, '192001044', '3124685763', 'Jihan Syakira Shafwa Harahap', 2, 'Perempuan', '2025-03-17 00:19:30', '2025-03-17 00:19:30'),
(852, '192001046', '0126043327', 'Kaira Namanda Rahman', 2, 'Perempuan', '2025-03-17 00:19:30', '2025-03-17 00:19:30'),
(853, '192001049', '0138957474', 'Keisha Zafira Hadzqi', 2, 'Perempuan', '2025-03-17 00:19:31', '2025-03-17 00:19:31'),
(854, '192001050', '0135264843', 'Khaira Tsany Haniyah', 2, 'Perempuan', '2025-03-17 00:19:31', '2025-03-17 00:19:31'),
(855, '192001052', '0134396695', 'Kian Nugraha El Hakim', 2, 'Laki-laki', '2025-03-17 00:19:31', '2025-03-17 00:19:31'),
(856, '192001057', '0131306172', 'Maika Verrani', 2, 'Perempuan', '2025-03-17 00:19:31', '2025-03-17 00:19:31'),
(857, '192001060', '0122495274', 'Marisa Aini Gunawan', 2, 'Perempuan', '2025-03-17 00:19:32', '2025-03-17 00:19:32'),
(858, '192001063', '0121660526', 'Mochammad Azriel Badil Irzam', 2, 'Laki-laki', '2025-03-17 00:19:32', '2025-03-17 00:19:32'),
(859, '192001072', '0134992785', 'Muhammad Ghazi Rabbani', 2, 'Laki-laki', '2025-03-17 00:19:32', '2025-03-17 00:19:32'),
(860, '192001082', '0123677450', 'Muliyantika Hasanah', 2, 'Perempuan', '2025-03-17 00:19:33', '2025-03-17 00:19:33'),
(861, '192001093', '0136939165', 'Raffa Alfaryzqi Prasetia', 2, 'Laki-laki', '2025-03-17 00:19:33', '2025-03-17 00:19:33'),
(862, '192001094', '0128566760', 'Raffandra Dzaky Prayogo', 2, 'Laki-laki', '2025-03-17 00:19:34', '2025-03-17 00:19:34'),
(863, '192001095', '3129281625', 'Raffasya Alby Prabundani', 2, 'Laki-laki', '2025-03-17 00:19:35', '2025-03-17 00:19:35'),
(864, '192001098', '3139111309', 'Raissa Hasanaty Labiba', 2, 'Perempuan', '2025-03-17 00:19:35', '2025-03-17 00:19:35'),
(865, '192001105', '0124473423', 'Shaina Anindya Putri Septiadi', 2, 'Perempuan', '2025-03-17 00:19:36', '2025-03-17 00:19:36'),
(866, '192001106', '0139085647', 'Syauqi Zharfan Yamani', 2, 'Laki-laki', '2025-03-17 00:19:36', '2025-03-17 00:19:36'),
(867, '192001001', '0139321761', 'Affan Ahsan Nurindra', 3, 'Laki-laki', '2025-03-17 00:19:37', '2025-03-17 00:19:37'),
(868, '192001011', '0125957496', 'Althaf Syamil Arrasyid', 3, 'Laki-laki', '2025-03-17 00:19:37', '2025-03-17 00:19:37'),
(869, '192001014', '0135649577', 'Aqilah Zahirah Kazhimah', 3, 'Perempuan', '2025-03-17 00:19:37', '2025-03-17 00:19:37'),
(870, '212203113', '132461049', 'Aracelia Calysta', 3, 'Perempuan', '2025-03-17 00:19:37', '2025-03-17 00:19:37'),
(871, '192001019', '0138933336', 'Bagas Audric Indratama', 3, 'Laki-laki', '2025-03-17 00:19:38', '2025-03-17 00:19:38'),
(872, '192001021', '0129428252', 'Daffa Alvaro Aryasatya', 3, 'Laki-laki', '2025-03-17 00:19:38', '2025-03-17 00:19:38'),
(873, '192001024', '3132616098', 'Dhiya Akhtar Harimurthi', 3, 'Laki-laki', '2025-03-17 00:19:39', '2025-03-17 00:19:39'),
(874, '192001027', '3128325858', 'Fadli Aseffa Kiarad', 3, 'Laki-laki', '2025-03-17 00:19:39', '2025-03-17 00:19:39'),
(875, '192001031', '0123091777', 'Fakhri Zuhair Akram', 3, 'Laki-laki', '2025-03-17 00:19:40', '2025-03-17 00:19:40'),
(876, '192001047', '0136160814', 'Kayumi Puteri Mutiara', 3, 'Perempuan', '2025-03-17 00:19:41', '2025-03-17 00:19:41'),
(877, '192001048', '0131263583', 'Keenand Athaya Adhyatama', 3, 'Laki-laki', '2025-03-17 00:19:41', '2025-03-17 00:19:41'),
(878, '192001051', '0128365849', 'Khayla Belvania Charnie', 3, 'Perempuan', '2025-03-17 00:19:42', '2025-03-17 00:19:42'),
(879, '192001053', '0136770985', 'Kinan Akhtar Mahera', 3, 'Laki-laki', '2025-03-17 00:19:42', '2025-03-17 00:19:42'),
(880, '192001054', '0121106546', 'Kinanthi Ayunda Putri', 3, 'Perempuan', '2025-03-17 00:19:42', '2025-03-17 00:19:42'),
(881, '192001055', '0124808384', 'Lizayani Ramadhina Putri', 3, 'Perempuan', '2025-03-17 00:19:43', '2025-03-17 00:19:43'),
(882, '192001066', '0135154633', 'Muhammad Arham Zunnurain Rifai', 3, 'Laki-laki', '2025-03-17 00:19:43', '2025-03-17 00:19:43'),
(883, '192001068', '0134872138', 'Muhammad Azmi Taqiyyuddin', 3, 'Laki-laki', '2025-03-17 00:19:44', '2025-03-17 00:19:44'),
(884, '192001076', '0137336255', 'Muhammad Rafardhan Athaya', 3, 'Laki-laki', '2025-03-17 00:19:44', '2025-03-17 00:19:44'),
(885, '192001077', '0136225885', 'Muhammad Rasya Athaya', 3, 'Laki-laki', '2025-03-17 00:19:45', '2025-03-17 00:19:45'),
(886, '192001085', '0123985812', 'Najwa Aisyah Zahra Wibisono', 3, 'Perempuan', '2025-03-17 00:19:45', '2025-03-17 00:19:45'),
(887, '192001096', '0138478412', 'Raisa Nacita Budiawan', 3, 'Perempuan', '2025-03-17 00:19:45', '2025-03-17 00:19:45'),
(888, '192001101', '0132871208', 'Razka Faeyza Al-Abyaz', 3, 'Laki-laki', '2025-03-17 00:19:45', '2025-03-17 00:19:45'),
(889, '192001102', '0135664432', 'Riani Adhystiara Witandra', 3, 'Perempuan', '2025-03-17 00:19:45', '2025-03-17 00:19:45'),
(890, '192001103', '0128735945', 'Salsabila Agni Sopian', 3, 'Perempuan', '2025-03-17 00:19:45', '2025-03-17 00:19:45'),
(891, '192001104', '0132047456', 'Sayyid Zabdan Syafiq', 3, 'Laki-laki', '2025-03-17 00:19:45', '2025-03-17 00:19:45'),
(892, '192001107', '0131008109', 'Yaqdhan Rakha Assaid', 3, 'Laki-laki', '2025-03-17 00:19:46', '2025-03-17 00:19:46'),
(893, '192001108', '0122106417', 'Yasmine Zainiyah Ahmad', 3, 'Perempuan', '2025-03-17 00:19:46', '2025-03-17 00:19:46'),
(894, '192001002', '0128228465', 'Afia Zahra Qanita Menoadji', 4, 'Perempuan', '2025-03-17 00:19:46', '2025-03-17 00:19:46'),
(895, '192001003', '3132680095', 'Ahmad Alhawarizmi', 4, 'Laki-laki', '2025-03-17 00:19:47', '2025-03-17 00:19:47'),
(896, '192001004', '0138946501', 'Ahmad Athallah Budiman', 4, 'Laki-laki', '2025-03-17 00:19:47', '2025-03-17 00:19:47'),
(897, '192001005', '0137060260', 'Aila Syifa Raihana Sihombing', 4, 'Perempuan', '2025-03-17 00:19:47', '2025-03-17 00:19:47'),
(898, '192001010', '0126315475', 'Alma Nurizza Tampubolon', 4, 'Perempuan', '2025-03-17 00:19:47', '2025-03-17 00:19:47'),
(899, '192001012', '0139063316', 'Anisa Zafira Anum', 4, 'Perempuan', '2025-03-17 00:19:47', '2025-03-17 00:19:47'),
(900, '192001013', '3139107517', 'Aqila Hanifah', 4, 'Perempuan', '2025-03-17 00:19:48', '2025-03-17 00:19:48'),
(901, '192001016', '0125381963', 'Arif Rahman Hakim', 4, 'Laki-laki', '2025-03-17 00:19:48', '2025-03-17 00:19:48'),
(902, '192001025', '3135132532', 'Dyah Deryn Anindya', 4, 'Perempuan', '2025-03-17 00:19:48', '2025-03-17 00:19:48'),
(903, '192001026', '0126616512', 'El Azzam Dzaky Khoiruddin', 4, 'Laki-laki', '2025-03-17 00:19:48', '2025-03-17 00:19:48'),
(904, '192001029', '0137383000', 'Fahryan Nabil Wibisana', 4, 'Laki-laki', '2025-03-17 00:19:48', '2025-03-17 00:19:48'),
(905, '192001033', '3134626714', 'Fathiyah Hilwah Aliyah', 4, 'Perempuan', '2025-03-17 00:19:48', '2025-03-17 00:19:48'),
(906, '192001039', '3128146950', 'Halim Abbasy', 4, 'Laki-laki', '2025-03-17 00:19:48', '2025-03-17 00:19:48'),
(907, '192001042', '3139146726', 'Hayumi Azzahra Harsyaputri', 4, 'Perempuan', '2025-03-17 00:19:49', '2025-03-17 00:19:49'),
(908, '192001043', '0132158299', 'Jeffry Alexander Ferdy Kraus', 4, 'Laki-laki', '2025-03-17 00:19:49', '2025-03-17 00:19:49'),
(909, '192001058', '0126509160', 'Maisyanova Ayrazka Albana', 4, 'Perempuan', '2025-03-17 00:19:49', '2025-03-17 00:19:49'),
(910, '192001064', '0136172325', 'Muhamad Hanif Amrullah', 4, 'Laki-laki', '2025-03-17 00:19:49', '2025-03-17 00:19:49'),
(911, '192001065', '3131797166', 'Muhammad Alfatih', 4, 'Laki-laki', '2025-03-17 00:19:49', '2025-03-17 00:19:49'),
(912, '192001067', '0128193322', 'Muhammad Arkan Oktrakiya', 4, 'Laki-laki', '2025-03-17 00:19:49', '2025-03-17 00:19:49'),
(913, '192001070', '0134590254', 'Muhammad Fathir Radinka', 4, 'Laki-laki', '2025-03-17 00:19:49', '2025-03-17 00:19:49'),
(914, '192001075', '0137893578', 'Muhammad Kenzie Azka', 4, 'Laki-laki', '2025-03-17 00:19:49', '2025-03-17 00:19:49'),
(915, '192001081', '0123633504', 'Muhammad Syabil Izfanaya', 4, 'Laki-laki', '2025-03-17 00:19:49', '2025-03-17 00:19:49'),
(916, '192001086', '0138088207', 'Natasya Kayla Lathiifah', 4, 'Perempuan', '2025-03-17 00:19:50', '2025-03-17 00:19:50'),
(917, '192001087', '3125385793', 'Naufal Dzaky Kurniawan', 4, 'Laki-laki', '2025-03-17 00:19:50', '2025-03-17 00:19:50'),
(918, '192001090', '0139938654', 'Pranajarafa Dzakwan Fadhlurrohman', 4, 'Laki-laki', '2025-03-17 00:19:51', '2025-03-17 00:19:51'),
(919, '192001092', '0138164866', 'Rachel Sabita Humaira', 4, 'Perempuan', '2025-03-17 00:19:51', '2025-03-17 00:19:51'),
(920, '192001110', '0121425793', 'Zahran Ibrahim Hernanda', 4, 'Laki-laki', '2025-03-17 00:19:51', '2025-03-17 00:19:51');

-- --------------------------------------------------------

--
-- Table structure for table `student_classes`
--

CREATE TABLE `student_classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `wali_kelas_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_classes`
--

INSERT INTO `student_classes` (`id`, `nama`, `wali_kelas_id`, `created_at`, `updated_at`) VALUES
(1, '6A', 8, '2025-03-12 10:20:26', '2025-03-12 10:24:30'),
(2, '6B', 17, '2025-03-12 10:24:42', '2025-03-12 10:24:42'),
(3, '6C', 18, '2025-03-12 10:24:55', '2025-03-12 10:24:55'),
(4, '6D', 19, '2025-03-12 10:25:05', '2025-03-12 10:25:05'),
(6, '1A', 21, '2025-03-12 20:27:09', '2025-03-12 20:27:09'),
(7, '1B', 22, '2025-03-12 20:27:29', '2025-03-12 20:27:29'),
(8, '1C', 23, '2025-03-12 20:27:41', '2025-03-12 20:27:41'),
(9, '1D', 24, '2025-03-12 20:27:54', '2025-03-12 20:27:54'),
(10, '2A', 26, '2025-03-14 22:02:49', '2025-03-14 22:02:49'),
(11, '2B', 27, '2025-03-14 22:03:32', '2025-03-14 22:03:32'),
(12, '2C', 28, '2025-03-14 22:03:59', '2025-03-14 22:03:59'),
(13, '2D', 29, '2025-03-14 22:04:17', '2025-03-14 22:04:17'),
(14, '3A', 30, '2025-03-14 22:04:34', '2025-03-14 22:04:34'),
(15, '3B', 31, '2025-03-14 22:05:00', '2025-03-14 22:05:00'),
(16, '3C', 32, '2025-03-14 22:05:20', '2025-03-14 22:05:20'),
(17, '3D', 33, '2025-03-14 22:05:40', '2025-03-14 22:05:40'),
(18, '4A', 34, '2025-03-14 22:06:09', '2025-03-14 22:06:09'),
(19, '4B', 35, '2025-03-14 22:06:21', '2025-03-14 22:06:21'),
(20, '4C', 36, '2025-03-14 22:06:50', '2025-03-14 22:06:50'),
(21, '4D', 37, '2025-03-14 22:07:17', '2025-03-14 22:07:17'),
(22, '5A', 38, '2025-03-14 22:07:40', '2025-03-14 22:07:40'),
(23, '5B', 39, '2025-03-14 22:08:06', '2025-03-14 22:08:06'),
(24, '5C', 40, '2025-03-14 22:08:19', '2025-03-14 22:08:19'),
(25, '5D', 41, '2025-03-14 22:08:38', '2025-03-14 22:08:38');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `singkatan` varchar(255) DEFAULT NULL,
  `kelompok_mapel` enum('Mata Pelajaran Wajib','Muatan Lokal','Seni dan Budaya') NOT NULL,
  `capaian` varchar(255) DEFAULT NULL,
  `tujuan` varchar(255) DEFAULT NULL,
  `aplikasi` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `nama`, `singkatan`, `kelompok_mapel`, `capaian`, `tujuan`, `aplikasi`, `created_at`, `updated_at`) VALUES
(1, 'Pendidikan Agama Islam dan Budi Pekerti', 'PAIBP', 'Mata Pelajaran Wajib', NULL, NULL, NULL, '2024-11-13 20:09:32', '2025-03-10 21:05:03'),
(2, 'Pendidikan Pancasila', '...', 'Mata Pelajaran Wajib', NULL, NULL, NULL, '2024-11-13 23:26:30', '2024-11-13 23:26:30'),
(3, 'Bahasa Indonesia', '...', 'Mata Pelajaran Wajib', NULL, NULL, NULL, '2024-11-13 23:26:45', '2024-11-13 23:26:45'),
(4, 'Matematika', 'MTK', 'Mata Pelajaran Wajib', NULL, NULL, NULL, '2024-11-13 23:26:54', '2025-03-10 21:10:32'),
(5, 'Ilmu Pengetahuan Alam dan Sosial', 'IPAS', 'Mata Pelajaran Wajib', NULL, NULL, NULL, '2024-11-13 23:27:22', '2025-03-10 21:10:42'),
(6, 'Pendidikan Jasmani, Olahraga dan Kesehatan', 'PJOK', 'Mata Pelajaran Wajib', NULL, NULL, NULL, '2024-11-13 23:27:52', '2025-03-10 21:11:00'),
(7, 'Seni Budaya dan Prakarya', 'SBdP', 'Mata Pelajaran Wajib', NULL, NULL, NULL, '2024-11-13 23:28:20', '2025-03-10 21:11:41'),
(8, 'Bahasa Inggris', '...', 'Mata Pelajaran Wajib', NULL, NULL, NULL, '2024-11-13 23:28:35', '2024-11-13 23:28:35'),
(9, 'Bahasa dan Sastra Sunda', '...', 'Muatan Lokal', NULL, NULL, NULL, '2024-11-13 23:29:26', '2024-11-13 23:29:26'),
(10, 'Bahasa Arab', '...', 'Muatan Lokal', NULL, NULL, NULL, '2024-11-13 23:29:48', '2024-11-13 23:30:02'),
(23, 'Al-Qur\'an Metode Ummi', 'Ummi', 'Muatan Lokal', NULL, NULL, NULL, '2025-03-10 20:48:32', '2025-03-10 20:48:32'),
(24, 'Tahfiz', NULL, 'Muatan Lokal', NULL, NULL, NULL, '2025-03-10 20:59:57', '2025-03-10 20:59:57'),
(26, 'Hadis', NULL, 'Muatan Lokal', NULL, NULL, NULL, '2025-03-10 21:07:39', '2025-03-10 21:07:39'),
(27, 'Informatika (Komputer)', NULL, 'Muatan Lokal', NULL, NULL, NULL, '2025-03-10 21:08:14', '2025-03-10 21:08:14'),
(28, 'Seni Musik', NULL, 'Seni dan Budaya', NULL, NULL, NULL, '2025-03-10 21:08:46', '2025-03-10 21:08:46');

-- --------------------------------------------------------

--
-- Table structure for table `teachings`
--

CREATE TABLE `teachings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teachings`
--

INSERT INTO `teachings` (`id`, `class_id`, `subject_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 6, 1, 21, '2025-03-16 23:51:28', '2025-03-16 23:51:28'),
(2, 6, 2, 21, '2025-03-17 00:05:18', '2025-03-17 00:05:18'),
(3, 6, 26, 21, '2025-03-17 00:05:29', '2025-03-17 00:05:50'),
(4, 6, 9, 21, '2025-03-17 00:06:02', '2025-03-17 00:06:02'),
(5, 6, 3, 42, '2025-03-17 00:06:41', '2025-03-17 00:07:08'),
(7, 6, 4, 42, '2025-03-17 00:07:53', '2025-03-17 00:07:53'),
(8, 6, 7, 42, '2025-03-17 00:08:39', '2025-03-17 00:08:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `nuptk` varchar(255) DEFAULT NULL,
  `jk` enum('Laki-Laki','Perempuan') NOT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `nip`, `nuptk`, `jk`, `telepon`, `alamat`, `image`, `created_at`, `updated_at`) VALUES
(8, 'Siska Maryana Dewi S.Si.,S.Pd.', 'siskamaryanadewi@aliya.com', '$2y$12$bw/CvpV0U3hXElIR3P.NweeFYRIMTjz7777s1kEWe1/kBBIVn.Fkm', NULL, NULL, 'Perempuan', NULL, NULL, NULL, '2025-03-10 21:30:38', '2025-03-10 21:30:38'),
(17, 'Gunawan, S.Kom', 'gunawan@aliya.com', '$2y$12$yvDTwEA3HuyEuJ58vYTiie3gHMg3IchYHWhaL/5pciYGx3tC8og9u', NULL, NULL, 'Laki-Laki', NULL, NULL, NULL, '2025-03-10 22:10:43', '2025-03-10 22:10:43'),
(18, 'Irma Oktaviana Majid, S.Pt', 'irmaoktavianamajid@aliya.com', '$2y$12$ssTP0epA.inLWERBOlkIDer6R2XU.1ZK9iBiHzE3DRnaepcUayd86', NULL, NULL, 'Perempuan', NULL, NULL, NULL, '2025-03-10 23:13:20', '2025-03-12 20:21:18'),
(19, 'Asep Rudini Setiawan, S.Pi.,M.Pd', 'aseprudinisetiawan@aliya.com', '$2y$12$KcY.9wwD1HMDj5Sn5Sf8Deym/kwhsjvj/1giHsEhF6vxhhpTXLi4W', NULL, NULL, 'Laki-Laki', NULL, NULL, NULL, '2025-03-10 23:14:05', '2025-03-10 23:14:05'),
(20, 'Syifa Khairunisa Masna', 'admin@aliya.com', '$2y$12$f7nC.SMPy1dONw0zMw5R..SlKS2PC5pA4bWfjhorpkIdaf/7Gwvl.', NULL, NULL, 'Perempuan', NULL, NULL, 'images/MEELhDg0Bk0zQVjnKX74kT5HfRMFNdEFpzK63CQw.jpg', '2025-03-10 23:35:30', '2025-03-16 21:04:28'),
(21, 'Ahmad Suhaedi, S.Pd.I, M.Pd', 'ahmadsuhaedi@aliya.com', '$2y$12$4yUjpsPlNp24C48NE6juqObAkWts7yJVDa9ajfXtmQj//ikDRC85S', NULL, NULL, 'Laki-Laki', NULL, NULL, NULL, '2025-03-12 20:20:41', '2025-03-12 20:20:41'),
(22, 'Baban Sobana, S.Ag', 'babansobana@aliya.com', '$2y$12$q1pyWOdvbes.AS4z9Mib1.BzAcUOEzGP6.c6/Qi26oDdYVi.S.JqO', NULL, NULL, 'Laki-Laki', NULL, NULL, NULL, '2025-03-12 20:22:06', '2025-03-12 20:22:06'),
(23, 'Saiful Rahman, S.Pd.I', 'saifulrahman@aliya.com', '$2y$12$9HADbY9WLyZg8r0RTwg93uoOQTXACPC/HFcXzsfnrFnOgbvADMdAO', NULL, NULL, 'Laki-Laki', NULL, NULL, NULL, '2025-03-12 20:22:43', '2025-03-12 20:22:43'),
(24, 'Hendri Gunawan, S.HI', 'hendrigunawan@aliya.com', '$2y$12$9UA.8N4.d2Kz1pHVPjBVLuci5zxvpOvOluCD26i1kgMQ7c73pVZ9q', NULL, NULL, 'Laki-Laki', NULL, NULL, NULL, '2025-03-12 20:26:19', '2025-03-12 20:26:19'),
(25, 'Erlita Hanum, S.Pd.', 'erlitahanum@aliya.com', '$2y$12$BsU3aju50T1Obbju7uHDC.3dE.CdLLkKPn3mjLT3Cr8L/WSL0eUvC', NULL, NULL, 'Perempuan', NULL, NULL, NULL, '2025-03-14 20:53:49', '2025-03-14 20:53:49'),
(26, 'Heriansyah, S.Ag, S.Pd', 'heriansyah@aliya.com', '$2y$12$52.VyzAKJzmDTVwHp6yFKeTFPwFRJgH1ATgDqSCx0A89btFG6RH8C', NULL, NULL, 'Laki-Laki', NULL, NULL, NULL, '2025-03-14 20:55:07', '2025-03-14 20:55:07'),
(27, 'Is Rosita, S.Pd.I', 'iisrosita@aliya.com', '$2y$12$j/gDTPPbCmEkjRs7lfN.wumhy437d0GgRER5E3foFn.LwmWBUhBcq', NULL, NULL, 'Perempuan', NULL, NULL, NULL, '2025-03-14 20:55:58', '2025-03-14 20:55:58'),
(28, 'M.Yushar Abdullah, S.Pd.I', 'myusharabdullah@aliya.com', '$2y$12$VxY1C0IyIgyf7bEIPDa7Huqh9SWwD.SrwP7M8BMcUJ6NQDh6dQXLK', NULL, NULL, 'Laki-Laki', NULL, NULL, NULL, '2025-03-14 21:05:01', '2025-03-14 21:05:01'),
(29, 'Dianawati, S.Pd.I', 'dinawati@aliya.com', '$2y$12$cUAEGqRqiwqGSQb06kqkQeR.K9jQPybJmN9cky2OBXTYhpcAq.5OC', NULL, NULL, 'Perempuan', NULL, NULL, NULL, '2025-03-14 21:06:04', '2025-03-14 21:06:04'),
(30, 'Abdul Mubarok, S.Pd.I', 'abdulmubarok@aliya.com', '$2y$12$mh2krhdySROG6m/9bZTBC.y9gWlI06qOSD2aYGOrtW67XMcUQi.xa', NULL, NULL, 'Laki-Laki', NULL, NULL, NULL, '2025-03-14 21:07:02', '2025-03-14 21:07:02'),
(31, 'Siti Mariyam, S.Pd', 'sitimariyam@aliya.com', '$2y$12$ckPAtiPgWgI/hS1QFiTzkeFuMYUmb/9W81lG1asWF..aJsYkdw032', NULL, NULL, 'Perempuan', NULL, NULL, NULL, '2025-03-14 21:07:58', '2025-03-14 21:07:58'),
(32, 'Rodina Agustina, S.Pd', 'rodinagustina@aliya.com', '$2y$12$G259x3qYoaGeIRXRGqupAOZ0crFFR56HISRHII0OPg.Exz6iDATWO', NULL, NULL, 'Perempuan', NULL, NULL, NULL, '2025-03-14 21:08:48', '2025-03-14 21:08:48'),
(33, 'Sri Andriani, S.Pd', 'sriandriani@aliya.com', '$2y$12$y3eA3OSA08FgWNAETAbDset/zwnB4cPtJKUdoH0en33NlDKO1GcEa', NULL, NULL, 'Perempuan', NULL, NULL, NULL, '2025-03-14 21:09:43', '2025-03-14 21:09:43'),
(34, 'Yugie Widyastuti Yusup, S.P.,M.Pd', 'yugiewidyastutiyusup@aliya.com', '$2y$12$jIUzb52Bro9pInh4TiAnhOdezwZGereR0ehHQyTZbNur6w4s1yOXi', NULL, NULL, 'Perempuan', NULL, NULL, NULL, '2025-03-14 21:12:04', '2025-03-14 21:12:04'),
(35, 'Fakhri Mubarok, S.Sos.I.,M.Pd.', 'fakhrimubarok@aliya.com', '$2y$12$v8qFl9gcyS.rj92yv0iELe.v3A4S.cXyK8hIjtFww93bh/0PGkKWi', NULL, NULL, 'Laki-Laki', NULL, NULL, NULL, '2025-03-14 21:13:10', '2025-03-14 21:13:10'),
(36, 'Moh. Abdul Kholis, M.Pd.', 'mohabdulkholis@aliya.com', '$2y$12$CJbsT19eWORNjC57V/m6/.3ogbbN8rOZ5WUoxalRVGeoEbUplu04K', NULL, NULL, 'Laki-Laki', NULL, NULL, NULL, '2025-03-14 21:13:52', '2025-03-14 21:13:52'),
(37, 'Asmah Yulisa Vitri, S.Pd', 'asmahyulisavitri@aliya.com', '$2y$12$yUjqvK3Rf5a1eeSdnlMiEOBHVo9G.mxZPFQGAR0Qm8XLqpJbczzVK', NULL, NULL, 'Perempuan', NULL, NULL, NULL, '2025-03-14 21:15:14', '2025-03-14 21:15:14'),
(38, 'Hakim Amarullah, S.S', 'hakimamarullah@aliya.com', '$2y$12$/bv3vK9/SnoYAC.Qjjh6m.sVjVWR0ykRk45NtRZqvUHsNvOwTLKTa', NULL, NULL, 'Laki-Laki', NULL, NULL, NULL, '2025-03-14 21:15:59', '2025-03-14 21:15:59'),
(39, 'Siti Maryam, S.Pd.', 'sitimaryam@aliya.com', '$2y$12$tOvGxGuIrJG8gNG3L4y6lOJFGrHyu9P8G5SNP5ZDl9EhEbVgbOMRK', NULL, NULL, 'Perempuan', NULL, NULL, NULL, '2025-03-14 21:16:44', '2025-03-14 21:16:44'),
(40, 'Ida Parida, M.Pd', 'idaparida@aliya.com', '$2y$12$MuldVq/nDc8fLTgNj211muv3wZ1gpAM5qgBeNkpR7PTfQmMB0z5e.', NULL, NULL, 'Perempuan', NULL, NULL, NULL, '2025-03-14 21:17:31', '2025-03-14 21:17:31'),
(41, 'Nunung Nurhayati, S.P', 'nunungnurhayati@aliya.com', '$2y$12$9b4.NyXwYdf/uexkSheFZu8H5e4DcTo2d7LnW23//9LT/OlcyRxfK', NULL, NULL, 'Perempuan', NULL, NULL, NULL, '2025-03-14 21:18:13', '2025-03-14 21:18:13'),
(42, 'Fikri Latipatul Huda, S.Sos.I', 'fikrilatipatulhuda@aliya.com', '$2y$12$x0wjHfi7tgl4E6iDpGG6OuvgsHdKTc3bLUjWjpo5GCBlB9Glizo8q', NULL, NULL, 'Perempuan', NULL, NULL, NULL, '2025-03-14 21:22:41', '2025-03-14 21:22:41'),
(43, 'Fatimah Nurul Jannah, S.Pd', 'fatimahnuruljannah@aliya.com', '$2y$12$PKSLFhngm97uN18DjNu7EuDtkhQRt/VYK7djoPHpR/eaRrT..fnK.', NULL, NULL, 'Perempuan', NULL, NULL, NULL, '2025-03-14 21:25:59', '2025-03-14 21:25:59'),
(44, 'Anis Nur Laili, S.Pi', 'anisnurlaili@aliya.com', '$2y$12$hDCuptJ64wcU6a.hVrTCR.yfw81r05pU15H4Wr2.Jpv2o28FAHOVG', NULL, NULL, 'Perempuan', NULL, NULL, NULL, '2025-03-14 21:27:23', '2025-03-14 21:27:23'),
(45, 'Nurul Hikmah, S.P', 'nurulhikmah@aliya.com', '$2y$12$yqfEQGogJ56WjC3Eai72G.H6KgoHFiwpQoIOnUd9Jpv7Dm/jxQ7z2', NULL, NULL, 'Perempuan', NULL, NULL, NULL, '2025-03-14 21:28:15', '2025-03-14 21:28:15'),
(46, 'Nurita Alawiah, S.Pd', 'nuritaalawiyah@aliya.com', '$2y$12$R57HXPBppfg.WjlWjh.E4ewCS/9J2HOGkqWvzCgHD.82aDhSJA7/2', NULL, NULL, 'Perempuan', NULL, NULL, NULL, '2025-03-14 21:29:11', '2025-03-14 21:29:11'),
(47, 'Tuti Alawiyah, S.Ag', 'tutialawiyah@aliya.com', '$2y$12$N8CX5VGQ7RZUGpASOzWpku8zk53HBsZavF1wipciIIqnIJPHkhAr2', NULL, NULL, 'Perempuan', NULL, NULL, NULL, '2025-03-14 21:29:52', '2025-03-14 21:29:52'),
(48, 'Akhmad Sofyan, S.Pd.I, M.Pd', 'akhmadsofyan@aliya.com', '$2y$12$mNQmPPFeuNDPwcXxZBkmZ.yF.j/RIt.n18zwRfykcyWgw0VrxIeAG', NULL, NULL, 'Laki-Laki', NULL, NULL, NULL, '2025-03-14 21:30:51', '2025-03-14 21:30:51'),
(49, 'Sri Mulyanih, S.Pd.I', 'srimulyanih@aliya.com', '$2y$12$9KUvs4LDZUxgLS22Jkrdb.liqvuD2nlJkwbd5yk6ssN8pmrR.6hdu', NULL, NULL, 'Perempuan', NULL, NULL, NULL, '2025-03-14 21:32:13', '2025-03-14 21:32:13'),
(50, 'Heri Kiswanto, S.Pd.I', 'herikiswanto@aliya.com', '$2y$12$lEZv9.t8.d0EwBXcMYdEEeDFe/hQidFT3GHrbHLzOC9kkuma8Ir7O', NULL, NULL, 'Laki-Laki', NULL, NULL, NULL, '2025-03-14 21:33:02', '2025-03-14 21:33:02'),
(51, 'Dedi Supriadi, S.Pd.I', 'dedisupriadi@aliya.com', '$2y$12$bNZsc3Bs1h6QVvIcjejEzeHExIMdxFlMoNuAjwM2ryk7eGLuJuSgu', NULL, NULL, 'Laki-Laki', NULL, NULL, NULL, '2025-03-14 21:33:37', '2025-03-14 21:33:37'),
(52, 'Yuni Annisa, S.Pd', 'yuniannisa@aliya.com', '$2y$12$K7Rxy6OgcL6MepgfyKISVeaGDQL8bcjAqT7J23cOUZyuBiB.8X0PS', NULL, NULL, 'Perempuan', NULL, NULL, NULL, '2025-03-14 21:34:16', '2025-03-14 21:34:16'),
(53, 'Widianti Sudjud, S.Sos, M.Pd', 'widiantisudjud@aliya.com', '$2y$12$XjdlhoSX9rv66PLFg0RDcuz5JA7z69dS7vDRn.lzW5QaS3KbP2Jj2', NULL, NULL, 'Perempuan', NULL, NULL, NULL, '2025-03-14 21:34:52', '2025-03-14 21:34:52'),
(54, 'Irma Nur Muharani, S. Sos', 'irmanurmuharani@aliya.com', '$2y$12$it6/UgMXbnRcd.BZPbzuzehERIbbdhjUqGu/tz5HnUg753.udZhJK', NULL, NULL, 'Perempuan', NULL, NULL, NULL, '2025-03-14 21:35:32', '2025-03-14 21:35:32'),
(55, 'Deni Tri Wibowo, S.Pd', 'denitriwibowo@aliya.com', '$2y$12$ir0CY3.YV.ICmTjSYrkfaOAbMfmTWWrlQ7uMZZBxL0U1u9BSFUx4G', NULL, NULL, 'Laki-Laki', NULL, NULL, NULL, '2025-03-14 21:36:28', '2025-03-14 21:36:28'),
(56, 'Abdul Rahman H, S.Pd.I, M.Pd', 'abdulrahmanh@aliya.com', '$2y$12$CRi6j.vQGfBwlmfxguUHU.ocBEwRFXSW7HhaTkVj4cgg2CnEV.bJy', NULL, NULL, 'Laki-Laki', NULL, NULL, NULL, '2025-03-14 21:38:09', '2025-03-14 21:38:09'),
(57, 'Erni Sukmawati, S.Ag', 'ernisukmawati@aliya.com', '$2y$12$hiY0cuDSvNPckOrwMmnqRuEzNC0HiTyyePiT.ocbTcKvCFyKqLlau', NULL, NULL, 'Perempuan', NULL, NULL, NULL, '2025-03-14 21:38:44', '2025-03-14 21:38:44'),
(58, 'Muhajir S.Pd', 'muhajir@aliya.com', '$2y$12$aSY3xb/nTIyWtJ7GnZgyT.jjL8fOxbuv5XFKxC204zKJNWez.t1yu', NULL, NULL, 'Laki-Laki', NULL, NULL, NULL, '2025-03-14 21:39:16', '2025-03-14 21:39:16'),
(59, 'Nurul Apriliandaru.K, S.Pd', 'nurulapriliandaru@aliya.com', '$2y$12$PY5k2NCL2TMyCi4caL8UQOs22nbZBMGY/StAYn8TNu7HC.Iw9Ymfu', NULL, NULL, 'Perempuan', NULL, NULL, NULL, '2025-03-14 21:39:52', '2025-03-14 21:39:52'),
(60, 'Luziana Agustina H. S.Kom', 'luzianaagustinah@aliya.com', '$2y$12$uNzTKijRYum5wNwfRVeROeEP1thW.eKKDqxMXwGGjgzsSbJd3ZQjG', NULL, NULL, 'Perempuan', NULL, NULL, NULL, '2025-03-14 21:40:31', '2025-03-14 21:40:31'),
(61, 'Rini Harsanti, A.Md', 'riniharsanti@aliya.com', '$2y$12$yjt1Z54jw4ac8EPXpxkj2.qBPbvOKrg83DxVaDqb5XEDe2wdNEHTu', NULL, NULL, 'Perempuan', NULL, NULL, NULL, '2025-03-14 21:41:10', '2025-03-14 21:41:10'),
(62, 'Zaenal Arifin, S.SI', 'zaenalarifin@aliya.com', '$2y$12$/w0K3xLlMfcNGmGhRYR8b.luVcgD82g29kKk1iE1gUpKiWWRtbQd.', NULL, NULL, 'Laki-Laki', NULL, NULL, NULL, '2025-03-14 21:42:39', '2025-03-14 21:42:39'),
(63, 'Nita Kurniawati, S.Pd.I', 'nitakurniawati@aliya.com', '$2y$12$b7smYm9s/EtpTT8Igx7TGeaCcVPI3tnwVAttk1yCvGSO6Siz7./2u', NULL, NULL, 'Perempuan', NULL, NULL, NULL, '2025-03-14 21:43:19', '2025-03-14 21:43:19'),
(64, 'Hawin Ausa, S.Pd.I', 'hawinausa@aliya.com', '$2y$12$7aD6wC4z9vL7tIbczh1squpIYAOwav/GyKjPWukVwcw3q84103WUm', NULL, NULL, 'Perempuan', NULL, NULL, NULL, '2025-03-14 21:43:59', '2025-03-14 21:43:59'),
(65, 'Eka Irawati, S.Pd.I', 'ekairawati@aliya.com', '$2y$12$7SveQS0WHhVLrrtghhX5pOhDZ7uWmooiUNXPFC0W/qU5m94V152A6', NULL, NULL, 'Perempuan', NULL, NULL, NULL, '2025-03-14 21:45:49', '2025-03-14 21:45:49'),
(66, 'Evi Siti Fatimah, S.Pd.I', 'evisitifatimah@aliya.com', '$2y$12$7fcWYtj.VMex4zMV5B6y1uqPddNE80G8FO8WD80vK/wSID2yq/8gK', NULL, NULL, 'Perempuan', NULL, NULL, NULL, '2025-03-14 21:46:23', '2025-03-14 21:46:23'),
(67, 'Nandang Mursyid, S.HI', 'nandangmursyid@aliya.com', '$2y$12$5u.mPNRJRoAY8clIWh2vXu60bh18B88QTLOsGMoQn4I9xsVbKOgIi', NULL, NULL, 'Laki-Laki', NULL, NULL, NULL, '2025-03-14 21:46:57', '2025-03-14 21:46:57'),
(68, 'Mochamad Husen, S.Ag', 'mochamadhusen@aliya.com', '$2y$12$Z4DiXN2LZImIWM.SAVYJyOjtJDpiBIh/1C.N6W63ldEQsLT1nMyAm', NULL, NULL, 'Laki-Laki', NULL, NULL, NULL, '2025-03-14 21:47:35', '2025-03-14 21:47:35'),
(69, 'Suhendar, S.Pd.I', 'suhendar@aliya.com', '$2y$12$S24AyOduEsG8ihUNPieBBeCOoFnyVrAuuLfkRtVUeF3vZGSDmtZhS', NULL, NULL, 'Laki-Laki', NULL, NULL, NULL, '2025-03-14 21:48:08', '2025-03-14 21:48:08'),
(70, 'Zakiyatun Nufus, S.Ag', 'zakiyatunnufus@aliya.com', '$2y$12$41.FhDW5y8Sg9rQDwQg5wu3nve2YuaNsbhTWjKjlQ2I1y6cwWfZlq', NULL, NULL, 'Perempuan', NULL, NULL, NULL, '2025-03-14 21:48:56', '2025-03-14 21:48:56'),
(71, 'Neneng Supriatin, S.Pd.I', 'nenengsupriatin@aliya.com', '$2y$12$I3uwhldJ0rZkIM2wYQePUO63n/Xjpng9Vm0q5dFojfj0VKHd/Xor2', NULL, NULL, 'Perempuan', NULL, NULL, NULL, '2025-03-14 21:49:37', '2025-03-14 21:49:37'),
(72, 'Saprudin, S.S', 'saprudin@aliya.com', '$2y$12$I2XbQdHhAkUi//3.dsPEH.fIKDgtyhZ.BjuzX1NaDb5HgrqbtEGKG', NULL, NULL, 'Laki-Laki', NULL, NULL, NULL, '2025-03-14 21:50:56', '2025-03-14 21:50:56'),
(73, 'Zaenal Abidin, M.Pd.I', 'zaenalabidin@aliya.com', '$2y$12$yxcOEKnBnfpeTmetmpvDOuasrv84wWbLojFsAnarPjwZBEvfNpuQK', NULL, NULL, 'Laki-Laki', NULL, NULL, NULL, '2025-03-14 21:51:28', '2025-03-14 21:51:28'),
(74, 'Rini Musyarofah, S.Pd', 'rinimusyarofah@aliya.com', '$2y$12$HonWz6vhH01EzUsEDUjw3OiIemFWNd1pfwNMLez2WSY/7hB8aKII2', NULL, NULL, 'Perempuan', NULL, NULL, NULL, '2025-03-14 21:52:01', '2025-03-14 21:52:01'),
(75, 'Iad Indriadiharja, S.Sy', 'iadindriadiharja@aliya.com', '$2y$12$213t9haDZ2C8dsTo/t9Wr.3Oyth3/3dSpj6RczfDzp4jCPiEjyR9e', NULL, NULL, 'Perempuan', NULL, NULL, NULL, '2025-03-14 21:52:59', '2025-03-14 21:52:59'),
(76, 'Adam, S.Pd', 'adam@aliya.com', '$2y$12$mrV9z7VqcW.XG4RahfD3.uuvjO7BIppauUyd7kHoqK3S1zPvCocpq', NULL, NULL, 'Laki-Laki', NULL, NULL, NULL, '2025-03-14 21:53:30', '2025-03-14 21:53:30'),
(77, 'Siti Sofah, S.Pd', 'sitisofiah@aliya.com', '$2y$12$meMu495wQO1vtpf.XNzRdOz9uvaKV8b60/C0LOs34OzTs2XpqHWPS', NULL, NULL, 'Perempuan', NULL, NULL, NULL, '2025-03-14 21:54:06', '2025-03-14 21:54:06'),
(78, 'Ateng, S.Th.I', 'ateng@aliya.com', '$2y$12$V1vORbLTvE.x8S4unDCTgO8lVtgEA1Wz7/998eeEzmD9WbG7bYM6q', NULL, NULL, 'Laki-Laki', NULL, NULL, NULL, '2025-03-14 21:55:03', '2025-03-14 21:55:03'),
(79, 'Aini Mulyati P. S.Sos.I', 'ainimulyati@aliya.com', '$2y$12$CpJUvP//d3p.13hooumje.rzkJBeizvSX1tN.AXpGFBpp3D7CSaUW', NULL, NULL, 'Perempuan', NULL, NULL, NULL, '2025-03-14 21:55:49', '2025-03-14 21:55:49'),
(80, 'Yanditasman Hia, S.Pd.I', 'yanditasmanhia@aliya.com', '$2y$12$O7EQxLnab1UEhZxYCpCTcuN1u55zeZ2MIBV4lqkeUXgttbfxuBzVy', NULL, NULL, 'Laki-Laki', NULL, NULL, NULL, '2025-03-14 21:58:25', '2025-03-14 21:58:25'),
(81, 'Iip Syarifah, S.Pd.I', 'iipsyarifah@aliya.com', '$2y$12$X88a1QPt2sq6.WBa29xINeUwi7XaRfzySnvVuApQzxPU8xn84mS5i', NULL, NULL, 'Perempuan', NULL, NULL, NULL, '2025-03-14 21:59:02', '2025-03-14 21:59:02'),
(82, 'Hilda Nurul Fauziah, S.Pd.I', 'hildanurulfauziah@aliya.com', '$2y$12$Z74u8YGFvmExunWeimHql.Bbvb3TbOWGOhtVo2KRq08ehMu.YYIWK', NULL, NULL, 'Perempuan', NULL, NULL, NULL, '2025-03-14 21:59:35', '2025-03-14 21:59:35'),
(83, 'Asep Setiaji, S.Pd', 'asepsetiaji@aliya.com', '$2y$12$oHinqQtthT7ZL92Hdrehm.7IbMBuYl623NKuTDisXfIva5u27dkeO', NULL, NULL, 'Laki-Laki', NULL, NULL, NULL, '2025-03-14 22:00:09', '2025-03-14 22:00:09'),
(84, 'Abdullah Hapid, S.Pd.I', 'abdullahhapid@aliya.com', '$2y$12$SD.TNTgpfGVdbJq/RRuhM.V22pLq4hXivnYUC/pZA7Ez351R7TxDm', NULL, NULL, 'Laki-Laki', NULL, NULL, NULL, '2025-03-14 22:01:17', '2025-03-14 22:01:17');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`role_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `school_profiles`
--
ALTER TABLE `school_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_years`
--
ALTER TABLE `school_years`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelas` (`class_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `student_classes`
--
ALTER TABLE `student_classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_classes_wali_kelas_id_foreign` (`wali_kelas_id`),
  ADD KEY `nama` (`nama`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Indexes for table `teachings`
--
ALTER TABLE `teachings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teachings_class_id_foreign` (`class_id`),
  ADD KEY `teachings_subject_id_foreign` (`subject_id`),
  ADD KEY `teachings_user_id_foreign` (`user_id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `school_profiles`
--
ALTER TABLE `school_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `school_years`
--
ALTER TABLE `school_years`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1029;

--
-- AUTO_INCREMENT for table `student_classes`
--
ALTER TABLE `student_classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `teachings`
--
ALTER TABLE `teachings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `student_classes` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `student_classes`
--
ALTER TABLE `student_classes`
  ADD CONSTRAINT `student_classes_wali_kelas_id_foreign` FOREIGN KEY (`wali_kelas_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `teachings`
--
ALTER TABLE `teachings`
  ADD CONSTRAINT `teachings_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `student_classes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `teachings_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `teachings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
