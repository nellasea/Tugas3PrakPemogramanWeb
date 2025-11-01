-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2025 at 05:05 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bimbel cihuyy`
--

-- --------------------------------------------------------

--
-- Table structure for table `pendaftar`
--

CREATE TABLE `pendaftar` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `paket_bimbel` varchar(100) NOT NULL,
  `lokasi_belajar` varchar(100) NOT NULL,
  `fasilitas_tambahan` text NOT NULL,
  `pajak` float NOT NULL,
  `catatan` text NOT NULL,
  `metode_pembayaran` varchar(50) NOT NULL,
  `harga_paket` int(11) NOT NULL,
  `harga_lokasi` int(11) NOT NULL,
  `harga_fasilitas` int(11) NOT NULL,
  `biaya_layanan` int(11) NOT NULL,
  `total_biaya` int(11) NOT NULL,
  `tanggal_daftar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pendaftar`
--

INSERT INTO `pendaftar` (`id`, `nama`, `email`, `paket_bimbel`, `lokasi_belajar`, `fasilitas_tambahan`, `pajak`, `catatan`, `metode_pembayaran`, `harga_paket`, `harga_lokasi`, `harga_fasilitas`, `biaya_layanan`, `total_biaya`, `tanggal_daftar`) VALUES
(1, 'Nayla ', 'naylasaskiazalianti@gmail.com', 'Paket Intensif SBMPTN', 'Jakarta Pusat', '', 10, '', 'E-Wallet', 500000, 100000, 0, 2000, 662200, '2025-10-30 07:24:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pendaftar`
--
ALTER TABLE `pendaftar`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pendaftar`
--
ALTER TABLE `pendaftar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
