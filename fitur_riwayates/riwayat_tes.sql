-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Jun 2026 pada 09.51
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
-- Struktur dari tabel `riwayat_tes`
--

CREATE TABLE `riwayat_tes` (
  `id_riwayat` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nama_mahasiswa` varchar(100) DEFAULT NULL,
  `hasil_peminatan` varchar(100) DEFAULT NULL,
  `tanggal_tes` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `riwayat_tes`
--

INSERT INTO `riwayat_tes` (`id_riwayat`, `id_user`, `nama_mahasiswa`, `hasil_peminatan`, `tanggal_tes`) VALUES
(1, NULL, 'Mahasiswa', 'Sistem Informasi', '2026-05-29 23:42:24'),
(2, NULL, 'Mahasiswa', 'Pendidikan', '2026-05-29 23:43:27'),
(3, NULL, 'Mahasiswa', 'Sistem Informasi', '2026-05-30 00:16:36'),
(4, NULL, 'Mahasiswa', 'Pendidikan', '2026-06-02 23:53:20'),
(5, NULL, 'Mahasiswa', 'Sistem Informasi', '2026-06-02 23:55:26'),
(6, NULL, 'Mahasiswa', 'Sistem Informasi', '2026-06-02 23:59:24');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `riwayat_tes`
--
ALTER TABLE `riwayat_tes`
  ADD PRIMARY KEY (`id_riwayat`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `riwayat_tes`
--
ALTER TABLE `riwayat_tes`
  MODIFY `id_riwayat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
