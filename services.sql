-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2025 at 07:52 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `service_type` varchar(20) DEFAULT NULL,
  `service_name` varchar(100) DEFAULT NULL,
  `expiration_date` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `reminder_30days` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'reminder for 30 days',
  `reminder_15days` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'reminder for 15 days',
  `reminder_7days` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'reminder for 7 days',
  `reminder_on_expiry` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'reminder on day',
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='reminder notification send table data';

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service_type`, `service_name`, `expiration_date`, `email`, `reminder_30days`, `reminder_15days`, `reminder_7days`, `reminder_on_expiry`, `created_at`, `updated_at`) VALUES
(1, 'Hosting', 'abc.com', '2025-01-06', 'shivam28203@gmail.com', 0, 0, 0, 0, '2025-01-01', '2025-01-01'),
(2, 'Domain', 'mywebsite.com', '2025-01-21', 'Tejas178@proton.me', 0, 0, 0, 0, '2025-01-05', '2025-01-05'),
(3, 'plugin', 'Custom Form Plugin', '2025-01-13', 'shivammaurya1014@gmail.com', 0, 0, 0, 0, '2025-01-05', '2025-01-05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
