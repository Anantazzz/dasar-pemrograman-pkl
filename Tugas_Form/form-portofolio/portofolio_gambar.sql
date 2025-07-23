-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 23, 2025 at 08:17 AM
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
-- Table structure for table `portofolio_gambar`
--

CREATE TABLE `portofolio_gambar` (
  `id` int NOT NULL,
  `portofolio_id` int DEFAULT NULL,
  `nama_file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `portofolio_gambar`
--

INSERT INTO `portofolio_gambar` (`id`, `portofolio_id`, `nama_file`) VALUES
(1, 2, '68808a349999e.png'),
(2, 3, '68808c2988f27.png'),
(3, 4, '68808c664d31e.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `portofolio_gambar`
--
ALTER TABLE `portofolio_gambar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `portofolio_id` (`portofolio_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `portofolio_gambar`
--
ALTER TABLE `portofolio_gambar`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `portofolio_gambar`
--
ALTER TABLE `portofolio_gambar`
  ADD CONSTRAINT `portofolio_gambar_ibfk_1` FOREIGN KEY (`portofolio_id`) REFERENCES `portofolio` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
