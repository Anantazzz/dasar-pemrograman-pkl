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
-- Table structure for table `portofolio`
--

CREATE TABLE `portofolio` (
  `id` int NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `ringkasan` text,
  `keahlian` text,
  `warna` varchar(50) DEFAULT NULL,
  `proyek` json DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `terbuka` tinyint(1) DEFAULT NULL,
  `layanan` json DEFAULT NULL,
  `setuju` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `portofolio`
--

INSERT INTO `portofolio` (`id`, `judul`, `ringkasan`, `keahlian`, `warna`, `proyek`, `longitude`, `latitude`, `terbuka`, `layanan`, `setuju`, `created_at`) VALUES
(1, 'h', 'i', '[\"Pemasaran Digital\"]', '#211f23', '[{\"url\": \"jg\", \"judul\": \"bj\", \"deskripsi\": \"io\"}]', 106.8456, -6.2088, 1, NULL, 1, '2025-07-23 07:06:08'),
(2, 'ui', 'ux', '[\"Desain UI\\/UX\"]', '#34b253', '[{\"url\": \"uc\", \"judul\": \"u\", \"deskripsi\": \"i\"}]', 106.8456, -6.2088, 1, NULL, 1, '2025-07-23 07:07:32'),
(3, 'ui', 'ux', '[\"Desain UI\\/UX\"]', '#34b253', '[]', 106.8456, -6.2088, 1, '[\"Konsultasi\"]', 1, '2025-07-23 07:15:53'),
(4, 'youtuber', 'konten', '[\"Penulisan Konten\"]', '#905614', '[{\"url\": \".com\", \"judul\": \"u\", \"deskripsi\": \"i\"}]', 106.8456, -6.2088, 1, '[\"Maintenance\"]', 1, '2025-07-23 07:16:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `portofolio`
--
ALTER TABLE `portofolio`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `portofolio`
--
ALTER TABLE `portofolio`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
