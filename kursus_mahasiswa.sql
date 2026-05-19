-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2026 at 04:20 PM
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
-- Database: `kursus_mahasiswa`
--

-- --------------------------------------------------------

--
-- Table structure for table `kursus_pelatihan`
--

CREATE TABLE `kursus_pelatihan` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `kategori` varchar(100) DEFAULT NULL,
  `durasi` varchar(50) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kursus_pelatihan`
--

INSERT INTO `kursus_pelatihan` (`id`, `judul`, `deskripsi`, `kategori`, `durasi`, `updated_at`) VALUES
(1, 'Web Development Dasar', 'Belajar HTML CSS dan JavaScript', 'Web Development', '3 Bulan', '2026-05-19 13:26:13'),
(2, 'Database MySQL', 'Belajar dasar database MySQL', 'Database', '2 Bulan', '2026-05-19 13:26:13'),
(3, 'UI/UX Design Dasar', 'Belajar desain menggunakan Figma', 'Design', '2 Bulan', '2026-05-19 13:26:13');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran_kursus`
--

CREATE TABLE `pendaftaran_kursus` (
  `id` int(11) NOT NULL,
  `id_kursus` int(11) DEFAULT NULL,
  `nama_mahasiswa` varchar(100) DEFAULT NULL,
  `nim` varchar(30) DEFAULT NULL,
  `kelas` varchar(30) DEFAULT NULL,
  `tanggal_daftar` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pendaftaran_kursus`
--

INSERT INTO `pendaftaran_kursus` (`id`, `id_kursus`, `nama_mahasiswa`, `nim`, `kelas`, `tanggal_daftar`) VALUES
(1, 3, 'Nazwa aulia fitri', '1223', '4A PSTI', '2026-05-19 13:37:10'),
(2, 1, 'Niha Karina', '1234', '4B PSTI', '2026-05-19 14:19:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kursus_pelatihan`
--
ALTER TABLE `kursus_pelatihan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pendaftaran_kursus`
--
ALTER TABLE `pendaftaran_kursus`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kursus_pelatihan`
--
ALTER TABLE `kursus_pelatihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pendaftaran_kursus`
--
ALTER TABLE `pendaftaran_kursus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
