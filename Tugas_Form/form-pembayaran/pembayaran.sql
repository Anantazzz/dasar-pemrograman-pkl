-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 23, 2025 at 08:18 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `form`
--

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int NOT NULL,
  `proyek` varchar(255) NOT NULL,
  `jumlah` int NOT NULL,
  `metode` varchar(100) NOT NULL,
  `setuju` tinyint(1) DEFAULT '0'
) ;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `proyek`, `jumlah`, `metode`, `setuju`) VALUES
(1, 'Pembangunan Aplikasi E-commerce', 350000, 'Transfer Bank', 1),
(2, 'Pembangunan Aplikasi E-commerce', 350000, 'Transfer Bank', 1),
(3, 'Pembangunan Aplikasi E-commerce', 350000, 'Transfer Bank', 1),
(4, 'Pembangunan Aplikasi E-commerce', 879000, 'Transfer Bank', 1),
(5, 'Pembangunan Aplikasi E-commerce', 977000, 'Transfer Bank', 0),
(6, 'Pembangunan Aplikasi E-commerce', 78000, 'Transfer Bank', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
