-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Sep 2023 pada 16.55
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penggajian`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jadwal_id` bigint(20) UNSIGNED NOT NULL,
  `anggota_id` bigint(20) UNSIGNED NOT NULL,
  `keterangan` enum('hadir','sakit','izin') NOT NULL,
  `bukti_kehadiran` text NOT NULL,
  `jam_masuk` datetime NOT NULL,
  `jam_keluar` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi_pengganti`
--

CREATE TABLE `absensi_pengganti` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jadwal_pengganti_id` bigint(20) UNSIGNED NOT NULL,
  `bukti_kehadiran` varchar(255) NOT NULL,
  `jam_masuk` datetime NOT NULL,
  `jam_keluar` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nik` varchar(255) NOT NULL,
  `jabatan_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `lokasi_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`id`, `nik`, `jabatan_id`, `user_id`, `lokasi_id`, `created_at`, `updated_at`) VALUES
(1, '202308080001', 1, 2, 1, '2023-09-02 15:54:09', '2023-09-02 15:54:09'),
(2, '202308080002', 1, 3, 1, '2023-09-02 15:54:09', '2023-09-02 15:54:09'),
(3, '202308080003', 1, 4, 1, '2023-09-02 15:54:09', '2023-09-02 15:54:09'),
(4, '114555544', 1, 5, 1, '2023-09-02 15:56:30', '2023-09-02 15:56:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_jabatan` varchar(255) NOT NULL,
  `gaji` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id`, `nama_jabatan`, `gaji`, `created_at`, `updated_at`) VALUES
(1, 'KARYAWAN', 8000000, '2023-09-02 15:54:09', '2023-09-03 07:11:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `periode_id` bigint(20) UNSIGNED NOT NULL,
  `anggota_id` bigint(20) UNSIGNED NOT NULL,
  `shift` enum('pagi','siang','malam') NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`id`, `periode_id`, `anggota_id`, `shift`, `tanggal`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'pagi', '2023-09-01', NULL, NULL),
(2, 1, 2, 'siang', '2023-09-01', NULL, NULL),
(3, 1, 3, 'malam', '2023-09-01', NULL, NULL),
(4, 1, 1, 'pagi', '2023-09-02', NULL, NULL),
(5, 1, 2, 'siang', '2023-09-02', NULL, NULL),
(6, 1, 3, 'malam', '2023-09-02', NULL, NULL),
(7, 1, 1, 'pagi', '2023-09-03', NULL, NULL),
(8, 1, 2, 'malam', '2023-09-03', NULL, '2023-09-03 07:09:06'),
(9, 1, 3, 'malam', '2023-09-03', NULL, NULL),
(10, 1, 1, 'pagi', '2023-09-04', NULL, NULL),
(11, 1, 2, 'siang', '2023-09-04', NULL, NULL),
(12, 1, 3, 'malam', '2023-09-04', NULL, NULL),
(13, 1, 1, 'pagi', '2023-09-05', NULL, NULL),
(14, 1, 2, 'siang', '2023-09-05', NULL, NULL),
(15, 1, 3, 'malam', '2023-09-05', NULL, NULL),
(16, 1, 1, 'pagi', '2023-09-06', NULL, NULL),
(17, 1, 2, 'siang', '2023-09-06', NULL, NULL),
(18, 1, 3, 'malam', '2023-09-06', NULL, NULL),
(19, 1, 1, 'pagi', '2023-09-07', NULL, NULL),
(20, 1, 2, 'siang', '2023-09-07', NULL, NULL),
(21, 1, 3, 'malam', '2023-09-07', NULL, NULL),
(22, 1, 1, 'pagi', '2023-09-08', NULL, NULL),
(23, 1, 2, 'siang', '2023-09-08', NULL, NULL),
(24, 1, 3, 'malam', '2023-09-08', NULL, NULL),
(25, 1, 1, 'pagi', '2023-09-09', NULL, NULL),
(26, 1, 2, 'siang', '2023-09-09', NULL, NULL),
(27, 1, 3, 'malam', '2023-09-09', NULL, NULL),
(28, 1, 1, 'pagi', '2023-09-10', NULL, NULL),
(29, 1, 2, 'siang', '2023-09-10', NULL, NULL),
(30, 1, 3, 'malam', '2023-09-10', NULL, NULL),
(31, 1, 1, 'pagi', '2023-09-11', NULL, NULL),
(32, 1, 2, 'siang', '2023-09-11', NULL, NULL),
(33, 1, 3, 'malam', '2023-09-11', NULL, NULL),
(34, 1, 1, 'pagi', '2023-09-12', NULL, NULL),
(35, 1, 2, 'siang', '2023-09-12', NULL, NULL),
(36, 1, 3, 'malam', '2023-09-12', NULL, NULL),
(37, 1, 1, 'pagi', '2023-09-13', NULL, NULL),
(38, 1, 2, 'siang', '2023-09-13', NULL, NULL),
(39, 1, 3, 'malam', '2023-09-13', NULL, NULL),
(40, 1, 1, 'pagi', '2023-09-14', NULL, NULL),
(41, 1, 2, 'siang', '2023-09-14', NULL, NULL),
(42, 1, 3, 'malam', '2023-09-14', NULL, NULL),
(43, 1, 1, 'pagi', '2023-09-15', NULL, NULL),
(44, 1, 2, 'siang', '2023-09-15', NULL, NULL),
(45, 1, 3, 'malam', '2023-09-15', NULL, NULL),
(46, 1, 1, 'pagi', '2023-09-16', NULL, NULL),
(47, 1, 2, 'siang', '2023-09-16', NULL, NULL),
(48, 1, 3, 'malam', '2023-09-16', NULL, NULL),
(49, 1, 1, 'pagi', '2023-09-17', NULL, NULL),
(50, 1, 2, 'siang', '2023-09-17', NULL, NULL),
(51, 1, 3, 'malam', '2023-09-17', NULL, NULL),
(52, 1, 1, 'pagi', '2023-09-18', NULL, NULL),
(53, 1, 2, 'siang', '2023-09-18', NULL, NULL),
(54, 1, 3, 'malam', '2023-09-18', NULL, NULL),
(55, 1, 1, 'pagi', '2023-09-19', NULL, NULL),
(56, 1, 2, 'siang', '2023-09-19', NULL, NULL),
(57, 1, 3, 'malam', '2023-09-19', NULL, NULL),
(58, 1, 1, 'pagi', '2023-09-20', NULL, NULL),
(59, 1, 2, 'siang', '2023-09-20', NULL, NULL),
(60, 1, 3, 'malam', '2023-09-20', NULL, NULL),
(61, 1, 1, 'pagi', '2023-09-21', NULL, NULL),
(62, 1, 2, 'siang', '2023-09-21', NULL, NULL),
(63, 1, 3, 'malam', '2023-09-21', NULL, NULL),
(64, 1, 1, 'pagi', '2023-09-22', NULL, NULL),
(65, 1, 2, 'siang', '2023-09-22', NULL, NULL),
(66, 1, 3, 'malam', '2023-09-22', NULL, NULL),
(67, 1, 1, 'pagi', '2023-09-23', NULL, NULL),
(68, 1, 2, 'siang', '2023-09-23', NULL, NULL),
(69, 1, 3, 'malam', '2023-09-23', NULL, NULL),
(70, 1, 1, 'pagi', '2023-09-24', NULL, NULL),
(71, 1, 2, 'siang', '2023-09-24', NULL, NULL),
(72, 1, 3, 'malam', '2023-09-24', NULL, NULL),
(73, 1, 1, 'pagi', '2023-09-25', NULL, NULL),
(74, 1, 2, 'siang', '2023-09-25', NULL, NULL),
(75, 1, 3, 'malam', '2023-09-25', NULL, NULL),
(76, 1, 1, 'pagi', '2023-09-26', NULL, NULL),
(77, 1, 2, 'siang', '2023-09-26', NULL, NULL),
(78, 1, 3, 'malam', '2023-09-26', NULL, NULL),
(79, 1, 1, 'pagi', '2023-09-27', NULL, NULL),
(80, 1, 2, 'siang', '2023-09-27', NULL, NULL),
(81, 1, 3, 'malam', '2023-09-27', NULL, NULL),
(82, 1, 1, 'pagi', '2023-09-28', NULL, NULL),
(83, 1, 2, 'siang', '2023-09-28', NULL, NULL),
(84, 1, 3, 'malam', '2023-09-28', NULL, NULL),
(85, 1, 1, 'pagi', '2023-09-29', NULL, NULL),
(86, 1, 2, 'siang', '2023-09-29', NULL, NULL),
(87, 1, 3, 'malam', '2023-09-29', NULL, NULL),
(88, 1, 1, 'pagi', '2023-09-30', NULL, NULL),
(89, 1, 2, 'siang', '2023-09-30', NULL, NULL),
(90, 1, 3, 'malam', '2023-09-30', NULL, NULL),
(91, 1, 4, 'pagi', '2023-09-01', '2023-09-03 02:41:32', '2023-09-03 02:41:32'),
(92, 1, 4, 'malam', '2023-09-02', '2023-09-03 07:05:50', '2023-09-03 07:05:50'),
(94, 1, 4, 'malam', '2023-09-04', '2023-09-03 07:05:58', '2023-09-03 07:05:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_pengganti`
--

CREATE TABLE `jadwal_pengganti` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jadwal_id` bigint(20) UNSIGNED NOT NULL,
  `anggota_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jadwal_pengganti`
--

INSERT INTO `jadwal_pengganti` (`id`, `jadwal_id`, `anggota_id`, `created_at`, `updated_at`) VALUES
(1, 8, 4, '2023-09-03 07:46:15', '2023-09-03 07:46:15'),
(2, 8, 4, '2023-09-03 07:47:56', '2023-09-03 07:47:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lokasi`
--

CREATE TABLE `lokasi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_lokasi` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `lokasi`
--

INSERT INTO `lokasi` (`id`, `nama_lokasi`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'smb', 'summarecon mall bekasi', '2023-09-02 15:54:09', '2023-09-02 15:54:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_05_15_023824_create_lokasi_table', 1),
(6, '2023_05_15_024735_create_jabatan_table', 1),
(7, '2023_05_16_021243_create_anggota_table', 1),
(8, '2023_06_16_083445_create_periode_table', 1),
(9, '2023_06_16_083824_create_jadwal_table', 1),
(10, '2023_06_17_183324_create_absensi_table', 1),
(11, '2023_06_21_013755_create_jadwal_pengganti_table', 1),
(12, '2023_06_21_013803_create_absensi_pengganti_table', 1),
(13, '2023_07_02_071831_create_potongan_gajis_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('joko@email.com', '$2y$10$URw2kXqET0bMQtrf8JCjT.RqE7sTYUIGnwwcY/V3QFTp2YQKhoIV2', '2023-09-03 03:53:26'),
('juki@email.com', '$2y$10$pn0EhRz/yeicAuD.0oW6wOBOPvWmwsrshR0v4e5YN2lrxyoF9d7va', '2023-09-03 03:31:18'),
('lutfi@lutfi.com', '$2y$10$YYxx5zvmw7DMBBoDIG.hEu54G49TivnocmTACCpyEPKjNaiaXr3h2', '2023-09-03 03:33:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `periode`
--

CREATE TABLE `periode` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dari` date NOT NULL,
  `hingga` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `periode`
--

INSERT INTO `periode` (`id`, `dari`, `hingga`, `created_at`, `updated_at`) VALUES
(1, '2023-09-01', '2023-09-30', '2023-09-02 15:54:09', '2023-09-02 15:54:09'),
(2, '2023-10-01', '2023-10-31', '2023-09-03 02:42:13', '2023-09-03 02:42:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `potongan_gajis`
--

CREATE TABLE `potongan_gajis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `nilai_potongan` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `potongan_gajis`
--

INSERT INTO `potongan_gajis` (`id`, `keterangan`, `nilai_potongan`, `created_at`, `updated_at`) VALUES
(1, 'potongan tidak hadir', 150000, '2023-09-02 15:54:08', '2023-09-02 15:54:08'),
(2, 'Asuransi', 50000, '2023-09-03 02:45:18', '2023-09-03 02:45:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('anggota','admin') NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `email`, `nama`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin@admin.com', 'Ali Mochtar', NULL, '$2y$10$sXNXZXsMsuYmbHK4xJEDBuNL.WIB7G973R9epG6RDIims5eRT17gq', 'admin', NULL, '2023-09-02 15:54:09', '2023-09-02 15:54:09'),
(2, 'mulwidodo.id@gmail.com', 'MULYADI', NULL, '$2y$10$yfxGgGJEPaIWm0XhyGm.D.w5zxyuUC/TeHFh5GOnjjlq8AmEJYmgS', 'anggota', 'CUnOU4wPYmCkfSVI9mXRbIW9V3xgk5q2IOKMjzQcNcq6OcCFxWVntQzt8u4w', '2023-09-02 15:54:09', '2023-09-03 07:10:01'),
(3, 'joko@email.com', 'JOKO SUPENO', NULL, '$2y$10$o/D579wqpnGyOPU7ExDkBe6MPgY6dZvHJ1sSMEYEripNA61gbt6Mm', 'anggota', NULL, '2023-09-02 15:54:09', '2023-09-03 07:13:46'),
(4, 'alimochtar2023@gmail.com', 'ALI MOCHTAR', NULL, '$2y$10$LYlNEdNJhdJzsSZ2Vu1oN.lPXnS4g/L4YazrWys2mpsMkkWuo43oi', 'anggota', 'IUFupMfJ01XxPh2U5pqepXHuBXdhv9Rq0vfBF5U0l1LPt8qvY1FFF7RVSOiH', '2023-09-02 15:54:09', '2023-09-03 07:36:10'),
(5, 'lutfi@lutfi.com', 'LUTFI IRAWAN', NULL, '$2y$10$o/D579wqpnGyOPU7ExDkBe6MPgY6dZvHJ1sSMEYEripNA61gbt6Mm', 'anggota', NULL, '2023-09-02 15:56:30', '2023-09-03 07:10:30');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `absensi_pengganti`
--
ALTER TABLE `absensi_pengganti`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `anggota_nik_unique` (`nik`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jabatan_nama_jabatan_unique` (`nama_jabatan`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jadwal_pengganti`
--
ALTER TABLE `jadwal_pengganti`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lokasi_nama_lokasi_unique` (`nama_lokasi`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `potongan_gajis`
--
ALTER TABLE `potongan_gajis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `absensi_pengganti`
--
ALTER TABLE `absensi_pengganti`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT untuk tabel `jadwal_pengganti`
--
ALTER TABLE `jadwal_pengganti`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `periode`
--
ALTER TABLE `periode`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `potongan_gajis`
--
ALTER TABLE `potongan_gajis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
