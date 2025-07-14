-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 11, 2025 at 05:56 PM
-- Server version: 9.1.0
-- PHP Version: 8.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employee_bee_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
CREATE TABLE IF NOT EXISTS `companies` (
  `id` int NOT NULL AUTO_INCREMENT,
  `company_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `industry` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `contact_person` varchar(100) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `website_url` varchar(255) DEFAULT NULL,
  `business_registration_number` varchar(50) DEFAULT NULL,
  `company_size` varchar(20) DEFAULT NULL,
  `description` text,
  `logo_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `company_name`, `email`, `password`, `industry`, `location`, `contact_person`, `phone_number`, `website_url`, `business_registration_number`, `company_size`, `description`, `logo_path`, `created_at`, `updated_at`) VALUES
(1, 'com', 'com@gmail.com', '$2y$10$xYQrwdk.Vufv0gs8h1tPguwntO8M2cAqIohnicLWAwghSDTMIjPwe', '', '', '', '', NULL, NULL, NULL, NULL, NULL, '2025-06-19 20:43:57', '2025-06-19 20:44:08');

-- --------------------------------------------------------

--
-- Table structure for table `employee_auth`
--

DROP TABLE IF EXISTS `employee_auth`;
CREATE TABLE IF NOT EXISTS `employee_auth` (
  `id` int NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nic_or_national_id` varchar(20) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_id` (`unique_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employee_auth`
--

INSERT INTO `employee_auth` (`id`, `unique_id`, `email`, `password`, `nic_or_national_id`, `country`, `birthdate`, `created_at`, `updated_at`) VALUES
(1, 'BEE-SL1438', 'minura@gmail.com', '$2y$10$n0Zf6zFsv8.xrMGcLipA8eKLwleUZFM9QVsWd4z4EaQe.bW.Qg0ki', '200122501438', 'SL', '2001-08-12', '2025-07-11 12:38:13', '2025-07-11 12:38:13');

-- --------------------------------------------------------

--
-- Table structure for table `employee_career_data`
--

DROP TABLE IF EXISTS `employee_career_data`;
CREATE TABLE IF NOT EXISTS `employee_career_data` (
  `employee_id` int NOT NULL,
  `skills` text,
  `education` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employee_career_data`
--

INSERT INTO `employee_career_data` (`employee_id`, `skills`, `education`, `created_at`, `updated_at`) VALUES
(1, 'React,Java Script,PHP', 'BSc. Software Engineering University of Bedfordshire ', '2025-07-11 12:38:13', '2025-07-11 12:38:13');

-- --------------------------------------------------------

--
-- Table structure for table `employee_profile`
--

DROP TABLE IF EXISTS `employee_profile`;
CREATE TABLE IF NOT EXISTS `employee_profile` (
  `employee_id` int NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `linkedin_url` varchar(255) DEFAULT NULL,
  `portfolio_url` varchar(255) DEFAULT NULL,
  `resume_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employee_profile`
--

INSERT INTO `employee_profile` (`employee_id`, `full_name`, `email`, `phone_number`, `profile_picture`, `location`, `linkedin_url`, `portfolio_url`, `resume_path`, `created_at`, `updated_at`) VALUES
(1, 'Minura Anuradha', 'minura@gmail.com', '0716001072', '/public/images/default-user.png', 'Colombo, Sri Lanka', '', '', '', '2025-07-11 12:38:13', '2025-07-11 12:38:13');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee_career_data`
--
ALTER TABLE `employee_career_data`
  ADD CONSTRAINT `employee_career_data_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee_auth` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employee_profile`
--
ALTER TABLE `employee_profile`
  ADD CONSTRAINT `employee_profile_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee_auth` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
