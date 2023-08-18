-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2023 at 03:16 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employee`
--

-- --------------------------------------------------------

--
-- Table structure for table `information`
--

CREATE TABLE `information` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `contact_number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `information`
--

INSERT INTO `information` (`id`, `first_name`, `middle_name`, `last_name`, `contact_number`) VALUES
(2, 'Test Name x', 'M2', 'Test Last2asd', 2147483647),
(3, 'Test Name 2', 'M2', 'Test Last2', 2147483647),
(4, 'Test Name 4', 'M2', 'Test Last2', 2147483647),
(5, 'Test Name 5', 'M2', 'Test Last2', 2147483647),
(6, 'Test', 'test', 'last test', 654655),
(7, 'Test', 'test', 'last test', 654655),
(8, 'Test', 'test', 'last test', 654655),
(9, 'Test', 'test', 'last test', 654655),
(10, 'Test', 'test', 'last test', 654655),
(11, 'Test', 'test', 'last test', 654655),
(12, 'Test', 'test', 'last test', 654655),
(13, 'Test', 'test', 'last test', 654655),
(14, 'Test', 'test', 'last test', 654655),
(15, 'Test', 'test', 'last test', 654655),
(16, 'Test', 'test', 'last test', 654655),
(17, 'Test', 'test', 'last test', 654655),
(18, 'Test', 'test', 'last test', 654655),
(19, 'Test', 'test', 'last test', 654655),
(20, 'Test', 'test', 'last test', 654655);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `information`
--
ALTER TABLE `information`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `information`
--
ALTER TABLE `information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
