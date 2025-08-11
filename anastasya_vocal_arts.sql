-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Agu 2025 pada 11.42
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `anastasya_vocal_arts`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `nama_lengkap`, `email`, `created_at`) VALUES
(1, 'admin', '$2y$10$eHexvF.SEe4O6rX9Sn6tqO7ktyQdV1fNZS57I.uRCpZs4FP28JGOW', 'Admin Pendaftaran', 'mail@anastasya.co', '2025-08-09 19:41:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `nama_panggilan` varchar(100) DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(20) DEFAULT NULL,
  `alamat_lengkap` text DEFAULT NULL,
  `telepon_murid` varchar(20) DEFAULT NULL,
  `email_murid` varchar(255) DEFAULT NULL,
  `nama_orang_tua` varchar(255) DEFAULT NULL,
  `pekerjaan_orang_tua` varchar(255) DEFAULT NULL,
  `telepon_orang_tua` varchar(20) DEFAULT NULL,
  `email_orang_tua` varchar(255) DEFAULT NULL,
  `pendidikan_terakhir` varchar(255) DEFAULT NULL,
  `kelas_semester` varchar(100) DEFAULT NULL,
  `hobi_minat` text DEFAULT NULL,
  `pengalaman_musik` text DEFAULT NULL,
  `genre_favorit` text DEFAULT NULL,
  `pernah_lomba` varchar(10) DEFAULT NULL,
  `detail_lomba` text DEFAULT NULL,
  `motivasi_harapan` text DEFAULT NULL,
  `referensi_lagu` text DEFAULT NULL,
  `riwayat_kesehatan` text DEFAULT NULL,
  `foto_path` varchar(255) DEFAULT NULL,
  `tanggal_pendaftaran` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `students`
--

INSERT INTO `students` (`id`, `nama_lengkap`, `nama_panggilan`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `alamat_lengkap`, `telepon_murid`, `email_murid`, `nama_orang_tua`, `pekerjaan_orang_tua`, `telepon_orang_tua`, `email_orang_tua`, `pendidikan_terakhir`, `kelas_semester`, `hobi_minat`, `pengalaman_musik`, `genre_favorit`, `pernah_lomba`, `detail_lomba`, `motivasi_harapan`, `referensi_lagu`, `riwayat_kesehatan`, `foto_path`, `tanggal_pendaftaran`) VALUES
(1, 'asdasd', 'asdlkasjd', 'lkjasdlkj', '1997-01-23', 'Laki-laki', 'asdasdsad', 'asdasdasd', 'asdasd', 'qweqwe', 'qweqwe', 'qweqwe', 'qweqwe', 'qweqwe', 'qweqwe', 'qweqwe', 'qweqwe', 'qweqew', 'Ya', 'asdasd', 'asdads', 'asdasd', 'asdasd', 'uploads/68979d12b6ef1_ChatGPT_Image_10_Agu_2025__01_18_42.png', '2025-08-09 19:10:10');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
