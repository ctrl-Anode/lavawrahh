-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 16, 2024 at 03:41 PM
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
-- Database: `lavaui`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `duration_minutes` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `instructor` varchar(100) NOT NULL,
  `schedule` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `type`, `description`, `duration_minutes`, `price`, `instructor`, `schedule`) VALUES
(1, 'Yearly', 'wadadawd', 999, 500.00, 'bruno', '2024-12-15 20:21:00');

-- --------------------------------------------------------

--
-- Table structure for table `class_bookings`
--

CREATE TABLE `class_bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `booking_date` datetime NOT NULL DEFAULT current_timestamp(),
  `terms_accepted` tinyint(1) NOT NULL DEFAULT 0,
  `status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_bookings`
--

INSERT INTO `class_bookings` (`id`, `user_id`, `class_id`, `booking_date`, `terms_accepted`, `status`) VALUES
(1, 1, 1, '2024-12-15 13:22:50', 1, 'cancelled'),
(11, 1, 1, '2024-12-15 15:50:52', 1, 'confirmed'),
(12, 1, 1, '2024-12-15 15:50:55', 1, 'confirmed'),
(13, 1, 1, '2024-12-15 15:53:53', 1, 'confirmed'),
(14, 2, 1, '2024-12-15 16:19:55', 1, 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `memberships`
--

CREATE TABLE `memberships` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `info` text DEFAULT NULL,
  `duration_months` int(11) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `memberships`
--

INSERT INTO `memberships` (`id`, `type`, `price`, `info`, `duration_months`, `status`) VALUES
(1, 'Lifetime', 20000.00, 'qwert', 999, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `reset_token` varchar(10) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_reset`
--

INSERT INTO `password_reset` (`id`, `email`, `reset_token`, `created_on`) VALUES
(1, 'ayminzane05@gmail.com', 'TEvuBeaX73', '2024-12-15 23:22:28');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `session_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `browser` varchar(255) NOT NULL,
  `ip` varchar(60) NOT NULL,
  `session_data` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `terms_and_conditions`
--

CREATE TABLE `terms_and_conditions` (
  `id` int(11) NOT NULL,
  `text` text NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `terms_and_conditions`
--

INSERT INTO `terms_and_conditions` (`id`, `text`, `status`) VALUES
(1, '**Terms and Conditions**\r\n\r\nWelcome to Perfect Fitness Gym! By accessing or using our services, you agree to comply with the following terms and conditions. Please read them carefully before using our website or facilities.\r\n\r\n### 1. **Acceptance of Terms**\r\nBy using Perfect Fitness Gym’s website or facilities, you agree to these terms and conditions. If you do not agree, you must discontinue your use of our services.\r\n\r\n### 2. **Membership and Payments**\r\n- Membership fees must be paid in full according to the chosen membership plan.\r\n- Membership is non-transferable and non-refundable.\r\n- Late payments may result in suspension or termination of access to facilities.\r\n\r\n### 3. **Health and Safety**\r\n- Members must complete a health declaration form before using the facilities.\r\n- Members are responsible for ensuring they are medically fit to exercise. Perfect Fitness Gym is not liable for injuries resulting from improper use of equipment or health-related issues.\r\n- Proper attire, including clean workout clothing and appropriate footwear, must be worn at all times.\r\n\r\n### 4. **Facility Use**\r\n- Equipment must be used in accordance with provided instructions and staff guidance.\r\n- Members must clean equipment after use and return it to its designated area.\r\n- Misuse or damage to equipment may result in penalties or membership termination.\r\n\r\n### 5. **Personal Belongings**\r\n- Members are responsible for securing their personal belongings in provided lockers.\r\n- Perfect Fitness Gym is not liable for lost, stolen, or damaged items.\r\n\r\n### 6. **Code of Conduct**\r\n- Respectful behavior toward staff and other members is mandatory.\r\n- Disruptive behavior, harassment, or inappropriate conduct will not be tolerated and may result in immediate termination of membership.\r\n\r\n### 7. **Changes to Terms**\r\nPerfect Fitness Gym reserves the right to modify these terms at any time. Updates will be posted on our website, and continued use of our services constitutes acceptance of these changes.\r\n\r\n### 8. **Liability**\r\nPerfect Fitness Gym is not responsible for any injuries, damages, or losses incurred while using our facilities, except where caused by gross negligence or willful misconduct.\r\n\r\n---\r\n\r\n**Privacy Policy**\r\n\r\nPerfect Fitness Gym values your privacy and is committed to protecting your personal information. This policy outlines how we collect, use, and safeguard your data.\r\n\r\n### 1. **Information We Collect**\r\nWe may collect the following information:\r\n- Personal details such as name, address, contact number, and email address.\r\n- Payment information for membership fees.\r\n- Health information provided through declaration forms.\r\n\r\n### 2. **How We Use Your Information**\r\nWe use your information to:\r\n- Process membership applications and payments.\r\n- Ensure member safety by assessing health risks.\r\n- Send updates, promotions, and notifications regarding our services.\r\n\r\n### 3. **Data Sharing**\r\nWe do not sell or share your personal information with third parties, except:\r\n- When required by law.\r\n- With service providers assisting in payment processing or facility management.\r\n\r\n### 4. **Data Security**\r\nWe implement appropriate measures to protect your information from unauthorized access, alteration, or disclosure. However, no system is completely secure, and we cannot guarantee the absolute security of your data.\r\n\r\n### 5. **Cookies and Website Use**\r\nOur website uses cookies to enhance user experience. You can adjust your browser settings to refuse cookies, but this may limit website functionality.\r\n\r\n### 6. **Your Rights**\r\nYou have the right to:\r\n- Access, update, or delete your personal information.\r\n- Opt out of marketing communications at any time.\r\n\r\n### 7. **Policy Updates**\r\nWe may update this privacy policy periodically. Changes will be posted on our website, and continued use of our services implies agreement with the updated policy.\r\n\r\nFor inquiries or concerns about our Terms and Conditions or Privacy Policy, please contact us at perfectfitnessgym@gmail.com or 09876543211.\r\n\r\n', 'Agreee');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_token` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `google_oauth_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `email_token`, `email_verified_at`, `password`, `remember_token`, `google_oauth_id`, `created_at`, `updated_at`) VALUES
(1, 'Paranode', 'ayminzane05@gmail.com', '8eaa9020216258244bbc71b7b2d9c8ab23d58b69b00b4202adc603cd1ce1d5b86e0c13033233a1b79481394cc9da882d376d', NULL, '$2y$04$N7L3kPSbN8C/x8QRYK04.eCEu9KqAIpVU6nF28h51cznQYoUEifyq', NULL, NULL, '2024-12-15 14:40:49', '2024-12-15 15:23:20');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `first_name`, `middle_name`, `last_name`, `username`, `contact`, `gender`, `address`, `email`, `password`, `email_token`, `created_at`, `updated_at`) VALUES
(1, 'Arnold', 'Zamora', 'Adeva', 'Paranode', '12345678901', 'male', 'pachoca,calapan city', 'ayminzane05@gmail.com', '$2y$04$SyVOqSPtEo0kRSMzp66lzOXNH1hrSh9CvAXX.tYOkVeRx9x507Yci', 'd7ee45cc71b12593459da5d763dfe8b60f7cfc74803f98a4836ff4b21750f08f4219392b81169b4339bca14d9f44c507e6de', '2024-12-15 12:19:48', '2024-12-15 12:19:48'),
(2, 'Arnold', 'Zamora', 'Adeva', 'Astre', '12345678901', 'male', 'pachoca,calapan city', 'arnoldadeva001@gmail.com', '$2y$04$8Yz/YtwQY2yj1Q5uvw/WOuNvjRzvSA6GpekY4EuFXxElxEbtBgiK.', '7264327b5ce61c95385174509838fd942b7527a9da6208b32105e866b267846d45f7316221cef7c9d62c38f4989bf38fa9ab', '2024-12-15 15:19:28', '2024-12-15 15:19:28');

-- --------------------------------------------------------

--
-- Table structure for table `user_memberships`
--

CREATE TABLE `user_memberships` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `membership_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `terms_accepted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_memberships`
--

INSERT INTO `user_memberships` (`id`, `user_id`, `membership_id`, `start_date`, `terms_accepted`) VALUES
(1, 1, 1, '2024-12-15', 1),
(2, 1, 1, '2024-12-15', 1),
(3, 1, 1, '2024-12-15', 1),
(4, 1, 1, '2024-12-15', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_bookings`
--
ALTER TABLE `class_bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `memberships`
--
ALTER TABLE `memberships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`session_id`);

--
-- Indexes for table `terms_and_conditions`
--
ALTER TABLE `terms_and_conditions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_memberships`
--
ALTER TABLE `user_memberships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `membership_id` (`membership_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `class_bookings`
--
ALTER TABLE `class_bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `memberships`
--
ALTER TABLE `memberships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `session_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `terms_and_conditions`
--
ALTER TABLE `terms_and_conditions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_memberships`
--
ALTER TABLE `user_memberships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `class_bookings`
--
ALTER TABLE `class_bookings`
  ADD CONSTRAINT `class_bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `class_bookings_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_memberships`
--
ALTER TABLE `user_memberships`
  ADD CONSTRAINT `user_memberships_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_memberships_ibfk_2` FOREIGN KEY (`membership_id`) REFERENCES `memberships` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
