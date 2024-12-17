-- Password Reset Table
CREATE TABLE IF NOT EXISTS `password_reset` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL,
  `reset_token` VARCHAR(10) NOT NULL,
  `created_on` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sessions Table
CREATE TABLE IF NOT EXISTS `sessions` (
  `session_id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `browser` VARCHAR(255) NOT NULL,
  `ip` VARCHAR(60) NOT NULL,
  `session_data` TEXT NOT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Users Table
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(20) NOT NULL,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `email_token` VARCHAR(255) NOT NULL,
  `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
  `password` VARCHAR(255) NOT NULL,
  `remember_token` VARCHAR(100) DEFAULT NULL,
  `google_oauth_id` VARCHAR(255) DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- User Information Table
CREATE TABLE IF NOT EXISTS `user_info` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(50) NOT NULL,
  `middle_name` VARCHAR(50) DEFAULT NULL,
  `last_name` VARCHAR(50) NOT NULL,
  `username` VARCHAR(20) NOT NULL UNIQUE,
  `contact` VARCHAR(15) NOT NULL,
  `gender` ENUM('male', 'female', 'other') NOT NULL,
  `address` VARCHAR(255) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `email_token` VARCHAR(100) DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Memberships Table
CREATE TABLE IF NOT EXISTS `memberships` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `type` VARCHAR(50) NOT NULL,
  `price` DECIMAL(10, 2) NOT NULL,
  `info` TEXT DEFAULT NULL,
  `duration_months` INT NOT NULL,
  `status` VARCHAR(50) NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Terms and Conditions Table
CREATE TABLE IF NOT EXISTS `terms_and_conditions` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `text` TEXT NOT NULL,
  `status` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- User Memberships Table
CREATE TABLE IF NOT EXISTS `user_memberships` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `membership_id` INT NOT NULL,
  `start_date` DATE NOT NULL,
  `terms_accepted` BOOLEAN NOT NULL DEFAULT 0,
  FOREIGN KEY (`user_id`) REFERENCES `user_info`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`membership_id`) REFERENCES `memberships`(`id`) ON DELETE CASCADE,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Classes Table
CREATE TABLE IF NOT EXISTS `classes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `type` VARCHAR(50) NOT NULL,
  `description` TEXT DEFAULT NULL,
  `duration_minutes` INT NOT NULL,
  `price` DECIMAL(10, 2) NOT NULL,
  `instructor` VARCHAR(100) NOT NULL,
  `schedule` DATETIME NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Class Bookings Table
CREATE TABLE IF NOT EXISTS `class_bookings` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `class_id` INT NOT NULL,
  `booking_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `terms_accepted` BOOLEAN NOT NULL DEFAULT 0,
  FOREIGN KEY (`user_id`) REFERENCES `user_info`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`class_id`) REFERENCES `classes`(`id`) ON DELETE CASCADE,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
