-- Blockchain Transactions Table
-- This table logs all blockchain operations for audit and tracking purposes

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Add blockchain_verification table for storing verification status
CREATE TABLE IF NOT EXISTS `blockchain_verification` (
  `id` int NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(100) NOT NULL,
  `company_id` varchar(100) NOT NULL,
  `record_index` int NOT NULL DEFAULT 0,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `verification_date` timestamp NULL DEFAULT NULL,
  `last_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_employee_company_record` (`employee_id`,`company_id`,`record_index`),
  KEY `idx_employee_id` (`employee_id`),
  KEY `idx_company_id` (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci; 