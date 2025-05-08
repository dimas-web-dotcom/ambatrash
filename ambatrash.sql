-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2025 at 04:48 PM
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
-- Database: `recyclehub`
--

-- --------------------------------------------------------

--
-- Table structure for table `list_buy`
--

CREATE TABLE `list_buy` (
  `id_buy` int(11) NOT NULL,
  `ID_packet` int(11) NOT NULL,
  `ID_user` int(11) NOT NULL,
  `order_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `list_buy`
--

INSERT INTO `list_buy` (`id_buy`, `ID_packet`, `ID_user`, `order_date`) VALUES
(26, 3, 21, '2025-02-25'),
(27, 4, 21, '2025-02-27'),
(29, 3, 53, '2025-03-05'),
(33, 3, 43, '2025-03-06'),
(34, 4, 54, '2025-03-06'),
(35, 4, 43, '2025-03-06'),
(36, 4, 43, '2025-03-06'),
(37, 4, 43, '2025-03-06'),
(38, 4, 21, '2025-03-26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `list_buy`
--
ALTER TABLE `list_buy`
  ADD PRIMARY KEY (`id_buy`),
  ADD KEY `ID_user` (`ID_user`),
  ADD KEY `ID_packet` (`ID_packet`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `list_buy`
--
ALTER TABLE `list_buy`
  MODIFY `id_buy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `list_buy`
--
ALTER TABLE `list_buy`
  ADD CONSTRAINT `ID_packet` FOREIGN KEY (`ID_packet`) REFERENCES `packet` (`ID_packet`),
  ADD CONSTRAINT `ID_user` FOREIGN KEY (`ID_user`) REFERENCES `users` (`ID_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
