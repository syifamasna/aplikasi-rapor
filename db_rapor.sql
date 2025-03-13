-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2025 at 09:43 AM
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
(4, '2025_03_12_000000_create_student_classes_table', 2);

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
(29, 24, 3, '2025-03-12 20:26:19', '2025-03-12 20:26:19');

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
('f8s9BXoGh1foSuSJMEqp5LeYrBp1l1xAvaUkuF6I', 20, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiUU5BY01VMTdWVnBmVUZoY1JLSmkzV25QMEdZSGVlazh2ZWpMSXJZWSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL3N0dWRlbnRzIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9zdHVkZW50cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjIwO3M6MTE6ImFjdGl2ZV9yb2xlIjtzOjE6IjEiO30=', 1741855284);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nis` varchar(255) NOT NULL,
  `nisn` varchar(255) NOT NULL,
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
(255, '2', '1', 'Syifa Khairunisa Masna', 6, 'Perempuan', '2025-03-12 21:54:40', '2025-03-12 22:04:37');

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
(9, '1D', 24, '2025-03-12 20:27:54', '2025-03-12 20:27:54');

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
(20, 'Admin', 'admin@aliya.com', '$2y$12$f7nC.SMPy1dONw0zMw5R..SlKS2PC5pA4bWfjhorpkIdaf/7Gwvl.', NULL, NULL, 'Perempuan', NULL, NULL, NULL, '2025-03-10 23:35:30', '2025-03-10 23:35:30'),
(21, 'Ahmad Suhaedi, S.Pd.I, M.Pd', 'ahmadsuhaedi@aliya.com', '$2y$12$4yUjpsPlNp24C48NE6juqObAkWts7yJVDa9ajfXtmQj//ikDRC85S', NULL, NULL, 'Laki-Laki', NULL, NULL, NULL, '2025-03-12 20:20:41', '2025-03-12 20:20:41'),
(22, 'Baban Sobana, S.Ag', 'babansobana@aliya.com', '$2y$12$q1pyWOdvbes.AS4z9Mib1.BzAcUOEzGP6.c6/Qi26oDdYVi.S.JqO', NULL, NULL, 'Laki-Laki', NULL, NULL, NULL, '2025-03-12 20:22:06', '2025-03-12 20:22:06'),
(23, 'Saiful Rahman, S.Pd.I', 'saifulrahman@aliya.com', '$2y$12$9HADbY9WLyZg8r0RTwg93uoOQTXACPC/HFcXzsfnrFnOgbvADMdAO', NULL, NULL, 'Laki-Laki', NULL, NULL, NULL, '2025-03-12 20:22:43', '2025-03-12 20:22:43'),
(24, 'Hendri Gunawan, S.HI', 'hendrigunawan@aliya.com', '$2y$12$9UA.8N4.d2Kz1pHVPjBVLuci5zxvpOvOluCD26i1kgMQ7c73pVZ9q', NULL, NULL, 'Laki-Laki', NULL, NULL, NULL, '2025-03-12 20:26:19', '2025-03-12 20:26:19');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=256;

--
-- AUTO_INCREMENT for table `student_classes`
--
ALTER TABLE `student_classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
