-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 04, 2025 at 02:05 PM
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
-- Table structure for table `blockchain_transactions`
--

DROP TABLE IF EXISTS `blockchain_transactions`;
CREATE TABLE IF NOT EXISTS `blockchain_transactions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(100) NOT NULL,
  `action` enum('hire','update','exit') NOT NULL,
  `transaction_hash` varchar(66) NOT NULL,
  `block_number` int DEFAULT NULL,
  `gas_used` int DEFAULT NULL,
  `status` enum('pending','confirmed','failed') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_employee_id` (`employee_id`),
  KEY `idx_transaction_hash` (`transaction_hash`),
  KEY `idx_created_at` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `blockchain_transactions`
--

INSERT INTO `blockchain_transactions` (`id`, `employee_id`, `action`, `transaction_hash`, `block_number`, `gas_used`, `status`, `created_at`, `updated_at`) VALUES
(1, 'BEE-SL9745', 'hire', '0x97ff7db80c78aed1167bff514506176fbcbdc89f33e5a56c39eba56b556fd387', NULL, NULL, 'pending', '2025-07-29 16:24:01', '2025-07-29 16:24:01'),
(2, 'BEE-SL1438', 'hire', '0x3779f113aea523ffc95cfdbb1c43c5a50eec0aa56f35462593328149c1936b6d', NULL, NULL, 'pending', '2025-07-29 20:34:00', '2025-07-29 20:34:00'),
(3, 'BEE-SL1438', 'hire', '0xe6d2afab60b44c0e72635c9704b7a9a655743396f8ca3c9f6f8e3396bbad2687', NULL, NULL, 'pending', '2025-07-30 09:17:01', '2025-07-30 09:17:01'),
(4, 'BEE-SL1438', 'hire', '0x94cc2082457572e107745dc3aa2b822b8ef3fbd352bfd1293185deb6460aac74', NULL, NULL, 'pending', '2025-07-30 10:24:48', '2025-07-30 10:24:48'),
(5, 'BEE-SL2963', 'hire', '0xf54469a11964fa63d8318c0fdfeff184f6d45754d5dbc507bd699847a051ad75', NULL, NULL, 'pending', '2025-08-01 15:26:38', '2025-08-01 15:26:38'),
(6, 'BEE-SL9745', 'hire', '0x159a30b30a0f132530004c93edf8c7fc04e3a1788ab43eaf86c00f8b264a7293', NULL, NULL, 'pending', '2025-08-01 15:57:50', '2025-08-01 15:57:50'),
(7, 'BEE-SL2963', 'hire', '0x7fff2a5937e9fec34d613d7455c97a6fd55169831788351a5853045b4ec4cd62', NULL, NULL, 'pending', '2025-08-01 16:01:01', '2025-08-01 16:01:01'),
(8, 'BEE-SL9745', 'hire', '0x173d3742beed699fff4cff4ed21ecf0378cbfa8655cf12b89572205e9a0343fd', NULL, NULL, 'pending', '2025-08-01 16:02:51', '2025-08-01 16:02:51'),
(9, 'BEE-SL9745', 'hire', '0x36ed07f367eef17e2b948ce6a3b52940fd1313bebc78cb0ec7259bd8211c1a26', NULL, NULL, 'pending', '2025-08-01 21:50:26', '2025-08-01 21:50:26');

-- --------------------------------------------------------

--
-- Table structure for table `blockchain_verification`
--

DROP TABLE IF EXISTS `blockchain_verification`;
CREATE TABLE IF NOT EXISTS `blockchain_verification` (
  `id` int NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(100) NOT NULL,
  `company_id` varchar(100) NOT NULL,
  `record_index` int NOT NULL DEFAULT '0',
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `verification_date` timestamp NULL DEFAULT NULL,
  `last_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_employee_company_record` (`employee_id`,`company_id`,`record_index`),
  KEY `idx_employee_id` (`employee_id`),
  KEY `idx_company_id` (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_employees`
--

DROP TABLE IF EXISTS `company_employees`;
CREATE TABLE IF NOT EXISTS `company_employees` (
  `id` int NOT NULL AUTO_INCREMENT,
  `company_id` int NOT NULL,
  `employee_unique_id` varchar(20) NOT NULL,
  `role_title` varchar(100) NOT NULL,
  `skills_on_hire` text,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `status` enum('active','inactive','resigned','terminated') DEFAULT 'active',
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`),
  KEY `employee_unique_id` (`employee_unique_id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `company_employees`
--

INSERT INTO `company_employees` (`id`, `company_id`, `employee_unique_id`, `role_title`, `skills_on_hire`, `start_date`, `end_date`, `status`) VALUES
(13, 1, 'BEE-SL1438', 'test', 'sql', '2025-07-07', NULL, 'active'),
(2, 1, 'BEE-SL2963', 'Intern', 'SQL,JS', '2025-07-12', NULL, 'inactive'),
(9, 1, 'BEE-SL7896', 'q', 'q', '2025-07-24', NULL, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `company_profile`
--

DROP TABLE IF EXISTS `company_profile`;
CREATE TABLE IF NOT EXISTS `company_profile` (
  `id` int NOT NULL AUTO_INCREMENT,
  `company_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `industry` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `company_size` varchar(20) DEFAULT NULL,
  `description` text,
  `website_url` varchar(255) DEFAULT NULL,
  `linkedin_url` varchar(255) DEFAULT NULL,
  `contact_person` varchar(100) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `business_registration_number` varchar(50) DEFAULT NULL,
  `logo_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `company_profile`
--

INSERT INTO `company_profile` (`id`, `company_name`, `email`, `password`, `industry`, `location`, `company_size`, `description`, `website_url`, `linkedin_url`, `contact_person`, `phone_number`, `business_registration_number`, `logo_path`, `created_at`, `updated_at`) VALUES
(1, 'Company 01-1', 'com@gmail.com', '$2y$10$daJME3XIu7oi9XVlWpyc2uKzloInEYlxpu96KyIbDHJwHKsHhh6rO', 'Technology', 'Colombo', '11-50', 'With decades of maintenance of way expertise and experience, no one knows the rail like Loram. Today, we’re leveraging our accumulated data, analytics and maintenance algorithms with advanced inspection technologies to provide you actionable intelligence with real-time monitoring and the most precise application of', 'https://www.linkedin.com/in/minura-jayasingha-62360724b/', 'https://www.linkedin.com/in/minura-jayasingha-62360724b/', 'Minura Anuradha', '0716001072', 'EW150-68', 'storage/uploads/company/logo_68797e034d788_Lvra_Blue_Logo_PNG.webp', '2025-07-14 21:13:53', '2025-07-31 16:21:19'),
(2, 'test', 'test@gmail.com', '$2y$10$a7bKFB6xPybcjn9GQeuLgu7GAhKYgwWvBb4m1AINU5xk3JQiEAo6m', '', '', '', '', '', '', 'Minura', '741852963', '', 'storage/uploads/company/logo_6876db48b878e_images.png', '2025-07-15 22:50:48', '2025-07-15 22:50:48');

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
) ENGINE=InnoDB AUTO_INCREMENT=3003 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employee_auth`
--

INSERT INTO `employee_auth` (`id`, `unique_id`, `email`, `password`, `nic_or_national_id`, `country`, `birthdate`, `created_at`, `updated_at`) VALUES
(1, 'BEE-SL1438', 'minura@gmail.com', '$2y$10$n0Zf6zFsv8.xrMGcLipA8eKLwleUZFM9QVsWd4z4EaQe.bW.Qg0ki', '200122501438', 'SL', '2001-08-12', '2025-07-11 12:38:13', '2025-07-11 12:38:13'),
(2, 'BEE-SL2963', 'emp@gmail.com', '$2y$10$WR4vTaGTBis9nDuY8r/pReQX1ZMtsNYBrOMMQ4NYkig/HKieKDN92', '741852963', 'SL', '2025-07-29', '2025-07-14 21:11:49', '2025-07-14 21:11:49'),
(3, 'BEE-SL9745', 'test@gmail.com', '$2y$10$4CiQJFa.ZGMAoQ8cNGV/7.1NYzEnB3JcJqiin/ANAQVh7.vW6XOwq', '123469745', 'SL', '2025-07-31', '2025-07-14 22:12:39', '2025-07-14 22:12:39'),
(4, 'BEE-SL7896', 'test01@gmail.com', '$2y$10$tOsL0iXjI8wekPDlhHW9UuuU1A.yVnovbQbuiszSE50.jWyl66H7y', '201457896', 'SL', '2025-07-17', '2025-07-29 15:26:58', '2025-07-29 15:26:58');

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
(1, 'React,Java Script,PHP', 'BSc. Software Engineering University of Bedfordshire', '2025-07-11 12:38:13', '2025-07-16 00:53:48'),
(2, '', '', '2025-07-14 21:11:49', '2025-07-14 21:11:49'),
(3, '', '', '2025-07-14 22:12:39', '2025-07-14 22:12:39'),
(4, '', '', '2025-07-29 15:26:58', '2025-07-29 15:26:58');

-- --------------------------------------------------------

--
-- Table structure for table `employee_feedback`
--

DROP TABLE IF EXISTS `employee_feedback`;
CREATE TABLE IF NOT EXISTS `employee_feedback` (
  `id` int NOT NULL AUTO_INCREMENT,
  `company_employee_id` int NOT NULL,
  `feedback_type` enum('comment','achievement','promotion') DEFAULT 'comment',
  `feedback_text` text NOT NULL,
  `updated_role` varchar(100) DEFAULT NULL,
  `new_skills` text,
  `date_recorded` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `company_employee_id` (`company_employee_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
(1, 'Minura Anuradha', 'minura@gmail.com', '074', 'storage/uploads/employee/profile_6889ed956e0a3_my-notion-face-transparent.png', 'Colombo, Sri Lanka', 'https://www.linkedin.com/in/minura-jayasingha-62360724b/', 'https://www.linkedin.com/in/minura-jayasingha-62360724b/', 'storage/uploads/employee/resumes/resume_6889ef84de07d_IT Support Intern at IFS.pdf', '2025-07-11 12:38:13', '2025-07-30 10:10:12'),
(2, 'Emp', 'emp@gmail.com', '7418529630', '/public/images/default-user.png', 'Colombo', '', '', '', '2025-07-14 21:11:49', '2025-07-14 21:11:49'),
(3, 'test', 'test@gmail.com', '', '/public/images/default-user.png', '', '', '', '', '2025-07-14 22:12:39', '2025-07-14 22:12:39'),
(4, 'test01', 'test01@gmail.com', '741852963', '/public/images/default-user.png', '', '', '', '', '2025-07-29 15:26:58', '2025-07-29 15:26:58');

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
