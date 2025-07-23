-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 23, 2025 at 08:16 AM
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
-- Table structure for table `registrasi`
--

CREATE TABLE `registrasi` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tipe_pengguna` enum('Klien','Freelancer') NOT NULL,
  `telepon` varchar(13) DEFAULT NULL,
  `bio` text,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `registrasi`
--

INSERT INTO `registrasi` (`id`, `nama`, `email`, `password`, `tipe_pengguna`, `telepon`, `bio`, `gambar`) VALUES
(1, 'Bunga Ananta', 'ung@mail.com', '$2y$10$f3u.xtQ6rRSZnHLjHoFpjeFSwXPyANIUFjFJTL.4/u60dn0bHdupW', 'Freelancer', '0923412763872', 'shryvanjdiuebcwyuahfjbccxggejcbdtfe', 'Screenshot 2024-11-26 133849.png'),
(2, 'Keanu', 'kean@gmail.com', '$2y$10$3pQvTYSAcAlTBwjLLujlxe0VazE19Ee5QAHdVb2H16/9K6Vuo6YGS', 'Klien', '0887556334245', '-', 'enkapsulasi.png'),
(3, 'Keanu', 'kean@gmail.com', '$2y$10$75PZYZv1eRqQKQlGtslyceO7R51ggjS8X3IGBo9hj7Jbc06o9V/tC', 'Klien', '0887556334245', '-', 'enkapsulasi.png'),
(4, 'Mail', 'mail@gmail.com', '$2y$10$xTwtnQ1RSbRkTfP7yT3Sm..0X4rLILuojP4rrMnnaZIP9to6XcvYu', 'Freelancer', '8765543322345', '-', 'polimorphisme.png'),
(5, 'Mail', 'mail@gmail.com', '$2y$10$C/kgze0NYhfCqXe6Yn0/uOB6rGv5CsdWq7K2y5Cieb6lerig5qqTy', 'Freelancer', '8765543322345', '-', 'polimorphisme.png'),
(6, 'Dean', 'Dean@mail.com', '$2y$10$5oxKC704kZczSzqBaO9eOukSXEC9oYeiKxhpkV.cXmteAjGiTd37m', 'Freelancer', '7765432123456', '-', 'inheritence.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `registrasi`
--
ALTER TABLE `registrasi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `registrasi`
--
ALTER TABLE `registrasi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
