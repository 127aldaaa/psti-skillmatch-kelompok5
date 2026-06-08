-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Jun 2026 pada 09.48
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skillmatch`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal_tes`
--

CREATE TABLE `soal_tes` (
  `id_soal` int(11) NOT NULL,
  `pertanyaan` text NOT NULL,
  `opsi_a` varchar(255) NOT NULL,
  `opsi_b` varchar(255) NOT NULL,
  `opsi_c` varchar(255) NOT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp(),
  `diubah_pada` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `kategori_a` varchar(100) DEFAULT NULL,
  `kategori_b` varchar(100) DEFAULT NULL,
  `kategori_c` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `soal_tes`
--

INSERT INTO `soal_tes` (`id_soal`, `pertanyaan`, `opsi_a`, `opsi_b`, `opsi_c`, `dibuat_pada`, `diubah_pada`, `kategori_a`, `kategori_b`, `kategori_c`) VALUES
(2, 'Saya senang mempelajari aplikasi, website, atau sistem digital.', 'Sangat tertarik', 'Tertarik', 'Kurang tertarik', '2026-05-09 19:38:28', '2026-05-29 16:26:41', 'Sistem Informasi', 'Engineering', 'Pendidikan'),
(3, 'Saya tertarik mengelola data dan informasi secara terstruktur.', 'Sangat tertarik', 'Tertarik', 'Kurang tertarik', '2026-05-09 19:38:28', '2026-05-21 08:56:58', 'Sistem Informasi', 'Engineering', 'Pendidikan'),
(4, 'Saya tertarik membantu orang lain memahami materi pelajaran.', 'Sangat tertarik', 'Tertarik', 'Kurang tertarik', '2026-05-09 19:38:28', '2026-05-21 08:56:58', 'Pendidikan', 'Sistem Informasi', 'Engineering'),
(5, 'Saya senang membuat kegiatan belajar yang kreatif dan menarik.', 'Sangat tertarik', 'Tertarik', 'Kurang tertarik', '2026-05-09 19:38:28', '2026-05-21 08:56:59', 'Pendidikan', 'Sistem Informasi', 'Engineering'),
(7, 'Saya tertarik memahami cara kerja mesin atau alat teknologi.', 'Sangat tertarik', 'Tertarik', 'Kurang tertarik', '2026-05-09 19:38:28', '2026-05-21 08:09:47', 'Engineering', 'Sistem Informasi', 'Pendidikan'),
(8, 'Saya suka memperbaiki atau merakit sesuatu.', 'Sangat tertarik', 'Tertarik', 'Kurang tertarik', '2026-05-09 19:38:28', '2026-05-21 08:56:59', 'Engineering', 'Sistem Informasi', 'Pendidikan'),
(9, 'Saya senang memecahkan masalah teknis atau logika.', 'Sangat tertarik', 'Tertarik', 'Kurang tertarik', '2026-05-09 19:38:28', '2026-05-21 08:56:59', 'Engineering', 'Sistem Informasi', 'Pendidikan'),
(10, 'apakah anda menyukai dunia pendidikan', 'Sangat tertarik', 'Tertarik', 'Kurang tertarik', '2026-05-10 08:53:17', '2026-05-21 08:56:59', 'Pendidikan', 'Sistem Informasi', 'Engineering');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `soal_tes`
--
ALTER TABLE `soal_tes`
  ADD PRIMARY KEY (`id_soal`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `soal_tes`
--
ALTER TABLE `soal_tes`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
