-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2025 at 06:06 PM
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
(3, '0001_01_01_000002_create_jobs_table', 1);

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
-- Table structure for table `school_profiles`
--

CREATE TABLE `school_profiles` (
  `id` bigint(20) NOT NULL,
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
(1, 'SIT Aliya', 20219975, 16117, '02518422129', 'Jl. Gardu Raya, RT.03/RW.11, Bubulak, Kec. Bogor Bar., Kota Bogor, Jawa Barat', 'sitaliya01@gmail.com', 'https://sitaliya.sch.id/', 'Luluk Dianarini, S.TP, M.Pd.', 'school_logos/mal5ITG7glGYMV7g4CNG18kQXPG3yLJwq5GrTkV7.png', NULL, '2025-02-10 13:00:22');

-- --------------------------------------------------------

--
-- Table structure for table `school_years`
--

CREATE TABLE `school_years` (
  `id` bigint(20) NOT NULL,
  `tahun_pelajaran` varchar(255) NOT NULL,
  `semester` enum('Ganjil','Genap') NOT NULL,
  `tempat_rapor` varchar(255) DEFAULT NULL,
  `tanggal_rapor` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
('6zWkavcmWy1QMCQcBTrZOrr0YU1HyGZu3oKrJBoy', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidmtDYTVTazduWHo1UUFXNlE0dHNWTVdESVlhUldHRGJRR0xkU0ZZWSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1741173107),
('c1DhSMET8ZJDJWiAA8bi27DCcOjG6KPb96BRPdkj', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiWEg2SGg0SXdQZDBoamZhTTJjTlhTTDZoOU94RUNCRW9jU0lkQXc3NCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1741162294),
('DnGh55GJzLFvtPSpCX9hyBcQ0sOTDxRwva4BJ6Y2', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRERyMkR3bFV5aXdOTEpzTXJqU3dicUd5YnUwN3lsdEM3VEdXbjB6QyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMS9hZG1pbi9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1741169321),
('epGcaTGvPX4BzZxC4eg9GBL4fa1pKmN0mAiS5lni', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVXpZRm44VDlaWW1FcWUwaWZaaWtHVmxSMnZrSEtjb2k2eGZXbU5DNyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fX0=', 1741167824),
('lPf4OaErPt9AcEg74Xm0Mt3EKOySC5j2Yk5mhuQM', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTnpMcmZRRllNUzZUVFRHQ3hoTFBEbnNQSXF2MmdiUlczMmJmTkpaeSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1741162105);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nis` varchar(255) NOT NULL,
  `nisn` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kelas` varchar(255) DEFAULT NULL,
  `jk` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `nis`, `nisn`, `nama`, `kelas`, `jk`, `created_at`, `updated_at`) VALUES
(107, '192001007', '0133092122', 'Akhtar Byakta Candra', '6B', 'Laki-laki', '2024-11-15 01:03:10', '2024-11-15 01:03:10'),
(108, '192001008', '0137838300', 'Alessio Ardana Ismail', '6B', 'Laki-laki', '2024-11-15 01:03:10', '2024-11-15 01:03:10'),
(109, '192001020', '0132265094', 'Bianca Nayla', '6B', 'Perempuan', '2024-11-15 01:03:10', '2024-11-15 01:03:10'),
(110, '192001022', '0138266059', 'Dama Arkananta Raqilla', '6B', 'Laki-laki', '2024-11-15 01:03:11', '2024-11-15 01:03:11'),
(111, '192001023', '3121694075', 'Danendra Canon Zabir', '6B', 'Laki-laki', '2024-11-15 01:03:11', '2024-11-15 01:03:11'),
(112, '192001035', '0128794640', 'Ghaida Hudzaifah Azzahra', '6B', 'Perempuan', '2024-11-15 01:03:11', '2024-11-15 01:03:11'),
(113, '192001036', '0125507073', 'Ghazanfar Alkhalifi', '6B', 'Laki-laki', '2024-11-15 01:03:11', '2024-11-15 01:03:11'),
(114, '192001037', '0134215812', 'Gusti Sabka Yarif Tamsil', '6B', 'Laki-laki', '2024-11-15 01:03:11', '2024-11-15 01:03:11'),
(115, '192001038', '0124355913', 'Hafiz Mahendra', '6B', 'Laki-laki', '2024-11-15 01:03:11', '2024-11-15 01:03:11'),
(116, '192001040', '3128719299', 'Hatta Zakaria', '6B', 'Laki-laki', '2024-11-15 01:03:11', '2024-11-15 01:03:11'),
(117, '212203116', '0125216438', 'Jaris Ataya Finandi Aurum', '6B', 'Laki-laki', '2024-11-15 01:03:11', '2024-11-15 01:03:11'),
(118, '192001044', '3124685763', 'Jihan Syakira Shafwa Harahap', '6B', 'Perempuan', '2024-11-15 01:03:11', '2024-11-15 01:03:11'),
(119, '192001046', '0126043327', 'Kaira Namanda Rahman', '6B', 'Perempuan', '2024-11-15 01:03:11', '2024-11-15 01:03:11'),
(120, '192001049', '0138957474', 'Keisha Zafira Hadzqi', '6B', 'Perempuan', '2024-11-15 01:03:11', '2024-11-15 01:03:11'),
(121, '192001050', '0135264843', 'Khaira Tsany Haniyah', '6B', 'Perempuan', '2024-11-15 01:03:11', '2024-11-15 01:03:11'),
(122, '192001052', '0134396695', 'Kian Nugraha El Hakim', '6B', 'Laki-laki', '2024-11-15 01:03:11', '2024-11-15 01:03:11'),
(123, '192001057', '0131306172', 'Maika Verrani', '6B', 'Perempuan', '2024-11-15 01:03:11', '2024-11-15 01:03:11'),
(124, '192001060', '0122495274', 'Marisa Aini Gunawan', '6B', 'Perempuan', '2024-11-15 01:03:11', '2024-11-15 01:03:11'),
(125, '192001063', '0121660526', 'Mochammad Azriel Badil Irzam', '6B', 'Laki-laki', '2024-11-15 01:03:11', '2024-11-15 01:03:11'),
(126, '192001072', '0134992785', 'Muhammad Ghazi Rabbani', '6B', 'Laki-laki', '2024-11-15 01:03:11', '2024-11-15 01:03:11'),
(127, '192001082', '0123677450', 'Muliyantika Hasanah', '6B', 'Perempuan', '2024-11-15 01:03:12', '2024-11-15 01:03:12'),
(128, '192001093', '0136939165', 'Raffa Alfaryzqi Prasetia', '6B', 'Laki-laki', '2024-11-15 01:03:12', '2024-11-15 01:03:12'),
(129, '192001094', '0128566760', 'Raffandra Dzaky Prayogo', '6B', 'Laki-laki', '2024-11-15 01:03:12', '2024-11-15 01:03:12'),
(130, '192001095', '3129281625', 'Raffasya Alby Prabundani', '6B', 'Laki-laki', '2024-11-15 01:03:12', '2024-11-15 01:03:12'),
(131, '192001098', '3139111309', 'Raissa Hasanaty Labiba', '6B', 'Perempuan', '2024-11-15 01:03:12', '2024-11-15 01:03:12'),
(132, '192001105', '0124473423', 'Shaina Anindya Putri Septiadi', '6B', 'Perempuan', '2024-11-15 01:03:12', '2024-11-15 01:03:12'),
(133, '192001106', '0139085647', 'Syauqi Zharfan Yamani', '6B', 'Laki-laki', '2024-11-15 01:03:12', '2024-11-15 01:03:12'),
(134, '192001006', '125110010', 'Aisyah Zahira Ramadhani', '6A', 'Perempuan', '2024-11-15 01:07:47', '2025-02-09 01:36:55'),
(135, '192001009', '128970710', 'Alifiandra Rasyid Putra Anggriawan', '6A', 'Laki-laki', '2024-11-15 01:07:47', '2024-11-15 01:07:47'),
(136, '192001015', '124210237', 'Aqsazura Kinar Akbar', '6A', 'Perempuan', '2024-11-15 01:07:47', '2024-11-15 01:07:47'),
(137, '192001017', '124107962', 'Arkan Ramaditia Hayza', '6A', 'Laki-laki', '2024-11-15 01:07:47', '2024-11-15 01:07:47'),
(138, '192001018', '132396983', 'Azka Putra Feriansyah', '6A', 'Laki-laki', '2024-11-15 01:07:48', '2024-11-15 01:07:48'),
(139, '192001028', '0124417031', 'Fahri Akbar Kadarisman', '6A', 'Laki-laki', '2024-11-15 01:07:48', '2024-11-15 01:07:48'),
(140, '192001030', '0129130358', 'Faiq Arsa Pradian', '6A', 'Laki-laki', '2024-11-15 01:07:48', '2024-11-15 01:07:48'),
(141, '192001032', '0122313064', 'Fakhru Zubair Akmal', '6A', 'Laki-laki', '2024-11-15 01:07:48', '2024-11-15 01:07:48'),
(142, '192001034', '0123786079', 'Gendis Fathiyyah Lestari', '6A', 'Perempuan', '2024-11-15 01:07:48', '2024-11-15 01:07:48'),
(143, '192001041', '0129506129', 'Haydar Muhammad Alzam', '6A', 'Laki-laki', '2024-11-15 01:07:48', '2024-11-15 01:07:48'),
(144, '192001045', '3121726311', 'Kadziyah Shakila Septiansyah', '6A', 'Perempuan', '2024-11-15 01:07:48', '2024-11-15 01:07:48'),
(145, '192001056', '3137919398', 'Luthfi Ahmad Muttaqi', '6A', 'Laki-laki', '2024-11-15 01:07:48', '2024-11-15 01:07:48'),
(146, '192001059', '0137858957', 'Makkah Azka Mohammed', '6A', 'Laki-laki', '2024-11-15 01:07:48', '2024-11-15 01:07:48'),
(147, '192001062', '0132274511', 'Mirza Izzatul Arshad', '6A', 'Laki-laki', '2024-11-15 01:07:48', '2024-11-15 01:07:48'),
(148, '192001069', '0129588483', 'Muhammad Dirga Maizar Rafli', '6A', 'Laki-laki', '2024-11-15 01:07:48', '2024-11-15 01:07:48'),
(149, '192001071', '0133906562', 'Muhammad Fatih Alkina', '6A', 'Laki-laki', '2024-11-15 01:07:48', '2024-11-15 01:07:48'),
(150, '192001073', '0135266656', 'Muhammad Hilmi Almujahid', '6A', 'Laki-laki', '2024-11-15 01:07:48', '2024-11-15 01:07:48'),
(151, '192001074', '0123722565', 'Muhammad Kaysan Kenzie Tigus', '6A', 'Laki-laki', '2024-11-15 01:07:48', '2024-11-15 01:07:48'),
(152, '192001079', '0137183308', 'Muhammad Shabiy \nArfan Ar Rifai', '6A', 'Laki-laki', '2024-11-15 01:07:48', '2024-11-15 01:07:48'),
(153, '192001084', '0122592264', 'Naifa Alecia Nonci', '6A', 'Perempuan', '2024-11-15 01:07:48', '2024-11-15 01:07:48'),
(154, '192001089', '0134128958', 'Naurah Chantika Salsabilla', '6A', 'Perempuan', '2024-11-15 01:07:48', '2024-11-15 01:07:48'),
(155, '192001091', '0136830908', 'Quinnara Adni Shakeela', '6A', 'Perempuan', '2024-11-15 01:07:48', '2024-11-15 01:07:48'),
(156, '192001097', '0129609631', 'Raisa Salsabila', '6A', 'Perempuan', '2024-11-15 01:07:48', '2024-11-15 01:07:48'),
(157, '192001100', '0122607178', 'Rayyan Syazwan Nafiz', '6A', 'Laki-laki', '2024-11-15 01:07:49', '2024-11-15 01:07:49'),
(158, '192001109', '0137322751', 'Yumi Faizia Hanifah', '6A', 'Perempuan', '2024-11-15 01:07:49', '2024-11-15 01:07:49'),
(159, '192001111', '0126623541', 'Zahrania Dawiyah', '6A', 'Perempuan', '2024-11-15 01:07:49', '2024-11-15 01:07:49'),
(160, '192001112', '0126861651', 'Zahrayya Kamila Latisha', '6A', 'Perempuan', '2024-11-15 01:07:49', '2024-11-15 01:07:49'),
(161, '192001001', '0139321761', 'Affan Ahsan Nurindra', '6C', 'Laki-laki', '2024-11-15 01:09:18', '2024-11-15 01:09:18'),
(162, '192001011', '0125957496', 'Althaf Syamil Arrasyid', '6C', 'Laki-laki', '2024-11-15 01:09:18', '2024-11-15 01:09:18'),
(163, '192001014', '0135649577', 'Aqilah Zahirah Kazhimah', '6C', 'Perempuan', '2024-11-15 01:09:18', '2024-11-15 01:09:18'),
(164, '212203113', '132461049', 'Aracelia Calysta', '6C', 'Perempuan', '2024-11-15 01:09:18', '2024-11-15 01:09:18'),
(165, '192001019', '0138933336', 'Bagas Audric Indratama', '6C', 'Laki-laki', '2024-11-15 01:09:18', '2024-11-15 01:09:18'),
(166, '192001021', '0129428252', 'Daffa Alvaro Aryasatya', '6C', 'Laki-laki', '2024-11-15 01:09:18', '2024-11-15 01:09:18'),
(167, '192001024', '3132616098', 'Dhiya Akhtar Harimurthi', '6C', 'Laki-laki', '2024-11-15 01:09:18', '2024-11-15 01:09:18'),
(168, '192001027', '3128325858', 'Fadli Aseffa Kiarad', '6C', 'Laki-laki', '2024-11-15 01:09:18', '2024-11-15 01:09:18'),
(169, '192001031', '0123091777', 'Fakhri Zuhair Akram', '6C', 'Laki-laki', '2024-11-15 01:09:18', '2024-11-15 01:09:18'),
(170, '192001047', '0136160814', 'Kayumi Puteri Mutiara', '6C', 'Perempuan', '2024-11-15 01:09:18', '2024-11-15 01:09:18'),
(171, '192001048', '0131263583', 'Keenand Athaya Adhyatama', '6C', 'Laki-laki', '2024-11-15 01:09:18', '2024-11-15 01:09:18'),
(172, '192001051', '0128365849', 'Khayla Belvania Charnie', '6C', 'Perempuan', '2024-11-15 01:09:18', '2024-11-15 01:09:18'),
(173, '192001053', '0136770985', 'Kinan Akhtar Mahera', '6C', 'Laki-laki', '2024-11-15 01:09:18', '2024-11-15 01:09:18'),
(174, '192001054', '0121106546', 'Kinanthi Ayunda Putri', '6C', 'Perempuan', '2024-11-15 01:09:18', '2024-11-15 01:09:18'),
(175, '192001055', '0124808384', 'Lizayani Ramadhina Putri', '6C', 'Perempuan', '2024-11-15 01:09:18', '2024-11-15 01:09:18'),
(176, '192001066', '0135154633', 'Muhammad Arham Zunnurain Rifai', '6C', 'Laki-laki', '2024-11-15 01:09:19', '2024-11-15 01:09:19'),
(177, '192001068', '0134872138', 'Muhammad Azmi Taqiyyuddin', '6C', 'Laki-laki', '2024-11-15 01:09:19', '2024-11-15 01:09:19'),
(178, '192001076', '0137336255', 'Muhammad Rafardhan Athaya', '6C', 'Laki-laki', '2024-11-15 01:09:19', '2024-11-15 01:09:19'),
(179, '192001077', '0136225885', 'Muhammad Rasya Athaya', '6C', 'Laki-laki', '2024-11-15 01:09:19', '2024-11-15 01:09:19'),
(180, '192001085', '0123985812', 'Najwa Aisyah Zahra Wibisono', '6C', 'Perempuan', '2024-11-15 01:09:19', '2024-11-15 01:09:19'),
(181, '192001096', '0138478412', 'Raisa Nacita Budiawan', '6C', 'Perempuan', '2024-11-15 01:09:19', '2024-11-15 01:09:19'),
(182, '192001101', '0132871208', 'Razka Faeyza Al-Abyaz', '6C', 'Laki-laki', '2024-11-15 01:09:19', '2024-11-15 01:09:19'),
(183, '192001102', '0135664432', 'Riani Adhystiara Witandra', '6C', 'Perempuan', '2024-11-15 01:09:19', '2024-11-15 01:09:19'),
(184, '192001103', '0128735945', 'Salsabila Agni Sopian', '6C', 'Perempuan', '2024-11-15 01:09:19', '2024-11-15 01:09:19'),
(185, '192001104', '0132047456', 'Sayyid Zabdan Syafiq', '6C', 'Laki-laki', '2024-11-15 01:09:19', '2024-11-15 01:09:19'),
(186, '192001107', '0131008109', 'Yaqdhan Rakha Assaid', '6C', 'Laki-laki', '2024-11-15 01:09:19', '2024-11-15 01:09:19'),
(187, '192001108', '0122106417', 'Yasmine Zainiyah Ahmad', '6C', 'Perempuan', '2024-11-15 01:09:19', '2024-11-15 01:09:19'),
(188, '192001002', '0128228465', 'Afia Zahra Qanita Menoadji', '6D', 'Perempuan', '2024-11-15 01:10:18', '2024-11-15 01:10:18'),
(189, '192001003', '3132680095', 'Ahmad Alhawarizmi', '6D', 'Laki-laki', '2024-11-15 01:10:18', '2024-11-15 01:10:18'),
(190, '192001004', '0138946501', 'Ahmad Athallah Budiman', '6D', 'Laki-laki', '2024-11-15 01:10:19', '2024-11-15 01:10:19'),
(192, '192001010', '0126315475', 'Alma Nurizza Tampubolon', '6D', 'Perempuan', '2024-11-15 01:10:19', '2024-11-15 01:10:19'),
(193, '192001012', '0139063316', 'Anisa Zafira Anum', '6D', 'Perempuan', '2024-11-15 01:10:19', '2024-11-15 01:10:19'),
(194, '192001013', '3139107517', 'Aqila Hanifah', '6D', 'Perempuan', '2024-11-15 01:10:19', '2024-11-15 01:10:19'),
(195, '192001016', '0125381963', 'Arif Rahman Hakim', '6D', 'Laki-laki', '2024-11-15 01:10:19', '2024-11-15 01:10:19'),
(196, '192001025', '3135132532', 'Dyah Deryn Anindya', '6D', 'Perempuan', '2024-11-15 01:10:19', '2024-11-15 01:10:19'),
(197, '192001026', '0126616512', 'El Azzam Dzaky Khoiruddin', '6D', 'Laki-laki', '2024-11-15 01:10:19', '2024-11-15 01:10:19'),
(198, '192001029', '0137383000', 'Fahryan Nabil Wibisana', '6D', 'Laki-laki', '2024-11-15 01:10:19', '2024-11-15 01:10:19'),
(199, '192001033', '3134626714', 'Fathiyah Hilwah Aliyah', '6D', 'Perempuan', '2024-11-15 01:10:19', '2024-11-15 01:10:19'),
(200, '192001039', '3128146950', 'Halim Abbasy', '6D', 'Laki-laki', '2024-11-15 01:10:19', '2024-11-15 01:10:19'),
(201, '192001042', '3139146726', 'Hayumi Azzahra Harsyaputri', '6D', 'Perempuan', '2024-11-15 01:10:19', '2024-11-15 01:10:19'),
(202, '192001043', '0132158299', 'Jeffry Alexander Ferdy Kraus', '6D', 'Laki-laki', '2024-11-15 01:10:19', '2024-11-15 01:10:19'),
(203, '192001058', '0126509160', 'Maisyanova Ayrazka Albana', '6D', 'Perempuan', '2024-11-15 01:10:19', '2024-11-15 01:10:19'),
(204, '192001064', '0136172325', 'Muhamad Hanif Amrullah', '6D', 'Laki-laki', '2024-11-15 01:10:19', '2024-11-15 01:10:19'),
(205, '192001065', '3131797166', 'Muhammad Alfatih', '6D', 'Laki-laki', '2024-11-15 01:10:19', '2024-11-15 01:10:19'),
(206, '192001067', '0128193322', 'Muhammad Arkan Oktrakiya', '6D', 'Laki-laki', '2024-11-15 01:10:19', '2024-11-15 01:10:19'),
(207, '192001070', '0134590254', 'Muhammad Fathir Radinka', '6D', 'Laki-laki', '2024-11-15 01:10:20', '2024-11-15 01:10:20'),
(208, '192001075', '0137893578', 'Muhammad Kenzie Azka', '6D', 'Laki-laki', '2024-11-15 01:10:20', '2024-11-15 01:10:20'),
(209, '192001081', '0123633504', 'Muhammad Syabil Izfanaya', '6D', 'Laki-laki', '2024-11-15 01:10:20', '2024-11-15 01:10:20'),
(210, '192001086', '0138088207', 'Natasya Kayla Lathiifah', '6D', 'Perempuan', '2024-11-15 01:10:20', '2024-11-15 01:10:20'),
(211, '192001087', '3125385793', 'Naufal Dzaky Kurniawan', '6D', 'Laki-laki', '2024-11-15 01:10:20', '2024-11-15 01:10:20'),
(212, '192001090', '0139938654', 'Pranajarafa Dzakwan Fadhlurrohman', '6D', 'Laki-laki', '2024-11-15 01:10:20', '2024-11-15 01:10:20'),
(213, '192001092', '0138164866', 'Rachel Sabita Humaira', '6D', 'Perempuan', '2024-11-15 01:10:20', '2024-11-15 01:10:20'),
(218, '192001110', '0121425793', 'Zahran Ibrahim Hernanda', '6D', 'Laki-laki', '2024-12-04 20:51:04', '2024-12-04 20:51:04'),
(219, '192001005', '0137060260', 'Aila Syifa Raihana Sihombing', '6D', 'Perempuan', '2024-12-04 20:53:37', '2024-12-04 20:53:37');

-- --------------------------------------------------------

--
-- Table structure for table `student_classes`
--

CREATE TABLE `student_classes` (
  `id` bigint(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `wali_kelas` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `singkatan` varchar(255) DEFAULT NULL,
  `kelompok_mapel` enum('Mata Pelajaran Wajib','Muatan Lokal') NOT NULL,
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
(1, 'Pendidikan Agama Islam dan Budi Pekerti', '...', 'Mata Pelajaran Wajib', NULL, NULL, NULL, '2024-11-13 20:09:32', '2024-11-13 20:11:12'),
(2, 'Pendidikan Pancasila', '...', 'Mata Pelajaran Wajib', NULL, NULL, NULL, '2024-11-13 23:26:30', '2024-11-13 23:26:30'),
(3, 'Bahasa Indonesia', '...', 'Mata Pelajaran Wajib', NULL, NULL, NULL, '2024-11-13 23:26:45', '2024-11-13 23:26:45'),
(4, 'Matematika', NULL, 'Mata Pelajaran Wajib', NULL, NULL, NULL, '2024-11-13 23:26:54', '2024-12-27 03:20:00'),
(5, 'Ilmu Pengetahuan Alam dan Sosial', NULL, 'Mata Pelajaran Wajib', NULL, NULL, NULL, '2024-11-13 23:27:22', '2024-12-27 03:19:48'),
(6, 'Pendidikan Jasmani, Olahraga dan Kesehatan', '...', 'Mata Pelajaran Wajib', NULL, NULL, NULL, '2024-11-13 23:27:52', '2024-11-13 23:28:05'),
(7, 'Seni Budaya dan Prakarya', '...', 'Mata Pelajaran Wajib', NULL, NULL, NULL, '2024-11-13 23:28:20', '2024-11-13 23:28:20'),
(8, 'Bahasa Inggris', '...', 'Mata Pelajaran Wajib', NULL, NULL, NULL, '2024-11-13 23:28:35', '2024-11-13 23:28:35'),
(9, 'Bahasa dan Sastra Sunda', '...', 'Muatan Lokal', NULL, NULL, NULL, '2024-11-13 23:29:26', '2024-11-13 23:29:26'),
(10, 'Bahasa Arab', '...', 'Muatan Lokal', NULL, NULL, NULL, '2024-11-13 23:29:48', '2024-11-13 23:30:02');

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
  `telepon` int(20) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `role` enum('Admin','Wali Kelas','Guru Mapel','Pj Prestasi') NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `nip`, `nuptk`, `jk`, `telepon`, `alamat`, `role`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@aliya.com', '$2y$12$/ECKzVXFagk52INMBOiYoeJKtFXEGuzLAvt7ODg0KRDbt0vXJgyeq', NULL, NULL, 'Perempuan', NULL, NULL, 'Admin', NULL, '2025-02-18 00:33:34', '2025-02-18 00:33:34');

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
  ADD KEY `kelas` (`kelas`);

--
-- Indexes for table `student_classes`
--
ALTER TABLE `student_classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `school_profiles`
--
ALTER TABLE `school_profiles`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `school_years`
--
ALTER TABLE `school_years`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=255;

--
-- AUTO_INCREMENT for table `student_classes`
--
ALTER TABLE `student_classes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
