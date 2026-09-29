-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 18, 2025 at 05:14 AM
-- Server version: 8.0.30
-- PHP Version: 8.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `website_kos_laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `jobs`
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
-- Table structure for table `job_batches`
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
-- Table structure for table `kamars`
--

CREATE TABLE `kamars` (
  `id` bigint UNSIGNED NOT NULL,
  `no_kamar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe_kamar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_perbulan` decimal(10,2) NOT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fasilitas` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Tersedia',
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kamars`
--

INSERT INTO `kamars` (`id`, `no_kamar`, `tipe_kamar`, `harga_perbulan`, `ukuran`, `fasilitas`, `status`, `foto`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'R14', 'VIP', 900000.00, '6X8', '[\"Lengkap\"]', 'Terisi', 'kamar/jjApUhNJdON8HK22KXxoIpaGy60M1wA3ebG4MkrY.jpg', 2, '2025-11-16 20:28:08', '2025-11-16 20:37:47'),
(2, 'R15', 'Biasa', 600000.00, '5x3', '[\"Lengkap\",\"tanpa AC dan Meja Belajar\"]', 'Terisi', 'kamar/GGTKUGk5bdfENK2K5FgKIMPE7cZI3OX9vhUcsoOK.jpg', 4, '2025-11-17 11:05:35', '2025-11-17 11:05:55'),
(3, 'R13', 'VIP', 900000.00, '6X8', '[\"Lengkap\"]', 'Tersedia', 'kamar/Dl0I7XTXkq8tyxF7alUoBmD0GXE9DsSpsal45Pwd.jpg', NULL, '2025-11-17 11:25:49', '2025-11-17 11:25:49'),
(4, 'R12', 'Biasa', 600000.00, '5x3', '[\"Lengkap kecuali ac dan meja belajar.\"]', 'Terisi', 'kamar/Z0J0lvHrddquxMAi1jVzWGslE8uGCnno9KsrpIAc.jpg', 5, '2025-11-17 11:26:30', '2025-11-17 11:43:24');

-- --------------------------------------------------------

--
-- Table structure for table `laporans`
--

CREATE TABLE `laporans` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `kamar_id` bigint UNSIGNED DEFAULT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Baru',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laporans`
--

INSERT INTO `laporans` (`id`, `user_id`, `kamar_id`, `judul`, `deskripsi`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Air Keruh', 'Air keran di kamar mandi keruh, di wastafel juga airnya berwarna coklat dan kotor', 'Baru', '2025-11-16 21:09:43', '2025-11-16 21:09:43'),
(2, 4, NULL, 'lampu kamar mati', 'lampu kamar kelap kelip, sepertinya kebakar.', 'Baru', '2025-11-17 10:51:03', '2025-11-17 10:51:03');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_11_12_093611_add_fields_to_users_table', 2),
(5, '2025_11_12_101435_add_role_to_users_table', 3),
(6, '2025_11_12_164559_add_google_refresh_token_to_users_table', 4),
(7, '2025_11_13_153731_create_kamars_table', 5),
(8, '2025_11_16_180401_create_kamars_table', 6),
(9, '2025_11_16_180446_create_pembayarans_table', 6),
(10, '2025_11_17_033946_create_pengeluarans_table', 7),
(11, '2025_11_17_040236_create_laporans_table', 8),
(12, '2025_11_17_181451_create_pemesanans_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('fikrisaiyidil2004@gmail.com', '$2y$12$Mtlm6FFCoauZqpvoaAAI5es9VYyDnscNuwURhJ4hDe/TupFfPYXQq', '2025-11-12 08:54:15');

-- --------------------------------------------------------

--
-- Table structure for table `pembayarans`
--

CREATE TABLE `pembayarans` (
  `id` bigint UNSIGNED NOT NULL,
  `kamar_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `bulan_tahun` date NOT NULL,
  `status_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Belum Bayar',
  `jumlah_bayar` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembayarans`
--

INSERT INTO `pembayarans` (`id`, `kamar_id`, `user_id`, `bulan_tahun`, `status_pembayaran`, `jumlah_bayar`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2025-11-01', 'Lunas', 900000.00, '2025-11-17 01:05:14', '2025-11-17 01:05:28'),
(2, 2, 4, '2025-11-01', 'Belum Bayar', 600000.00, '2025-11-17 11:06:05', '2025-11-17 11:06:05'),
(3, 4, 5, '2025-11-01', 'Belum Bayar', 600000.00, '2025-11-17 11:43:24', '2025-11-17 11:43:24');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanans`
--

CREATE TABLE `pemesanans` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `kamar_id` bigint UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengeluarans`
--

CREATE TABLE `pengeluarans` (
  `id` bigint UNSIGNED NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` decimal(10,2) NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengeluarans`
--

INSERT INTO `pengeluarans` (`id`, `kategori`, `deskripsi`, `jumlah`, `tanggal`, `created_at`, `updated_at`) VALUES
(1, 'Lain-lain', 'Jasa Pengangkut Sampah', 50000.00, '2025-11-17', '2025-11-16 20:50:50', '2025-11-16 20:50:50');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('7SwTUHwAw6lQ3DGhSBGXHr1DQDJm2iLrfFxz2WAx', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOXIxbG1pRnZjenJUTmN1cVBTUXV3RGdBUk1CaUFaaGEzaHZtRXJjMyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly93ZWJzaXRlLWtvcy1sYXJhdmVsLnRlc3QvYWRtaW4vZGFzaGJvYXJkIjtzOjU6InJvdXRlIjtzOjk6ImRhc2hib2FyZCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1763406087),
('lxHI5WJdxHLrOHofSqim736tT6bOaitwr5fnDqjs', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMERnQWo4N1Q3YjI2QTdDODdKR0M4alkxYW1vSVNIVnJNYWhFMXZ6USI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly93ZWJzaXRlLWtvcy1sYXJhdmVsLnRlc3QvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1763442134),
('sDRI5YX8G9lAJSGrkq85lXZrkmSCRKssdqqQpLO1', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRGNUMUh1RVpOWHQ4Z3BuTk9oaUFlMkpUOW1ucE9KMXpoNG1sVHJsYiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly93ZWJzaXRlLWtvcy1sYXJhdmVsLnRlc3QvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO319', 1763442581);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `google_refresh_token` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `no_hp`, `jenis_kelamin`, `pekerjaan`, `alamat`, `google_refresh_token`) VALUES
(1, 'Saiyidil fikri', 'saiyidil.fikri0140@gmail.com', 'admin', NULL, '$2y$12$AGOSRcj0otSCJ4h4Jp5VKu5NOosl7ouHf5j7DqEqCT3ACOEatuy9.', 'NOS8IUONWM4Mcdy6jAyyL6VJT5CK021ElcpfkDnI8Tz4DvawzyuccFoXXR5W', '2025-11-12 03:06:02', '2025-11-12 03:06:02', '082111411594', 'Laki-laki', 'Mahasiswa', 'jln. bangausakti', NULL),
(2, 'fazil', 'fazil123@gmail.com', 'user', NULL, '$2y$12$IpXsFYMj0Jzm1Wa3gqFLA.zP0BI1RhNiviSgKL/qd1MdtcDjLcBWu', NULL, '2025-11-12 08:31:45', '2025-11-12 08:31:45', '1234567899', 'Laki-laki', 'Mahasiswa', 'Jln bangau sakti', NULL),
(3, 'aidil', 'fikrisaiyidil2004@gmail.com', 'user', NULL, '$2y$12$mHxd7OICGnuS0P9MhSxOJO4La87wqkWJGlO.mzBDKMaUpRx2yz07a', NULL, '2025-11-12 08:53:51', '2025-11-12 08:53:51', '12345678912', 'Laki-laki', 'Mahasiswa', 'Bangko', NULL),
(4, 'untung', 'senjuciha1@gmail.com', 'user', NULL, '$2y$12$lnRoqYg0HQ.Yepw3cQLn4e3bPUKIP3ZDi3Yy8rabzqVZP2t6NT6xK', 'NjQvzUY5oGQDNsXQqwrZotEYjwFn3YWbVKAjHIsylnzQOjLfKA0mrT7v2Ve2', '2025-11-15 15:28:45', '2025-11-15 15:28:45', '0888888888', 'Laki-laki', 'Mahasiswa', 'Jl. Kakatua Sakti', NULL),
(5, 'Muhammad Habibi', 'habibi@admin.com', 'user', NULL, '$2y$12$Y7Rhas9Tcvpiur1f/upi6usmti54L95MmVlt67rfkd..as/ke8QvS', 'Jx4AquFwUCaK9RK5cCwoSgJbMULX6BVuYOKpKI9xwGIaVCh9IWqlyh464EBg', '2025-11-17 09:54:00', '2025-11-17 09:54:00', '089699667788', 'Laki-laki', 'Mahasiswa', 'Jl. Sukakarya', NULL);

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
-- Indexes for table `kamars`
--
ALTER TABLE `kamars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kamars_user_id_foreign` (`user_id`);

--
-- Indexes for table `laporans`
--
ALTER TABLE `laporans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laporans_user_id_foreign` (`user_id`),
  ADD KEY `laporans_kamar_id_foreign` (`kamar_id`);

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
-- Indexes for table `pembayarans`
--
ALTER TABLE `pembayarans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembayarans_kamar_id_foreign` (`kamar_id`),
  ADD KEY `pembayarans_user_id_foreign` (`user_id`);

--
-- Indexes for table `pemesanans`
--
ALTER TABLE `pemesanans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_pending_booking_unique` (`user_id`,`status`),
  ADD KEY `pemesanans_kamar_id_foreign` (`kamar_id`);

--
-- Indexes for table `pengeluarans`
--
ALTER TABLE `pengeluarans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kamars`
--
ALTER TABLE `kamars`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `laporans`
--
ALTER TABLE `laporans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pembayarans`
--
ALTER TABLE `pembayarans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pemesanans`
--
ALTER TABLE `pemesanans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengeluarans`
--
ALTER TABLE `pengeluarans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kamars`
--
ALTER TABLE `kamars`
  ADD CONSTRAINT `kamars_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `laporans`
--
ALTER TABLE `laporans`
  ADD CONSTRAINT `laporans_kamar_id_foreign` FOREIGN KEY (`kamar_id`) REFERENCES `kamars` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `laporans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pembayarans`
--
ALTER TABLE `pembayarans`
  ADD CONSTRAINT `pembayarans_kamar_id_foreign` FOREIGN KEY (`kamar_id`) REFERENCES `kamars` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pembayarans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pemesanans`
--
ALTER TABLE `pemesanans`
  ADD CONSTRAINT `pemesanans_kamar_id_foreign` FOREIGN KEY (`kamar_id`) REFERENCES `kamars` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pemesanans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
