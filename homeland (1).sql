-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2025 at 10:25 PM
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
-- Database: `homeland`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) NOT NULL,
  `adminname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `mypassword` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `adminname`, `email`, `mypassword`, `created_at`) VALUES
(4, 'muuse', 'muusedaahir87@gmail.com', '$2y$10$eC6DvxzqA4At5UtgypijIOQBkbGg/9qgR6V7t6MbBvB2bM2PNRMyq', '2025-06-07 07:01:42');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) NOT NULL,
  `name` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`) VALUES
(2, 'Property-Land', '2022-12-29 11:42:14'),
(3, 'Commercial-Building', '2022-12-29 11:42:14'),
(11, 'Guryo--Cusub', '2025-07-23 12:07:12');

-- --------------------------------------------------------

--
-- Table structure for table `favs`
--

CREATE TABLE `favs` (
  `id` int(10) NOT NULL,
  `prop_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favs`
--

INSERT INTO `favs` (`id`, `prop_id`, `user_id`, `created_at`) VALUES
(8, 4, 1, '2023-01-03 17:47:25'),
(10, 14, 34, '2025-07-24 17:24:01'),
(11, 18, 34, '2025-07-24 17:27:17'),
(12, 21, 34, '2025-07-24 17:32:14'),
(16, 17, 34, '2025-07-25 16:54:14'),
(18, 20, 34, '2025-07-25 16:54:30'),
(19, 20, 33, '2025-07-26 05:26:54'),
(20, 17, 33, '2025-07-26 18:16:42'),
(21, 15, 39, '2025-07-27 08:22:47'),
(22, 15, 42, '2025-07-27 12:25:46');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT 'default.png',
  `address` varchar(255) DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `id_document` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `verified` tinyint(1) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `user_id`, `full_name`, `phone`, `profile_pic`, `address`, `gender`, `dob`, `id_document`, `bio`, `verified`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 34, 'qaysar', '0636865687', 'user_34_1753469456.webp', 'Siinaay, Hargeisa', 'male', '2005-01-15', NULL, '', 0, 1, '2025-07-25 13:22:21', '2025-07-25 18:52:03'),
(4, 33, 'Hoobaan Rent company', '0636865687', 'user_33_1753507951.jpg', 'hargeisa', 'male', '0000-00-00', NULL, '', 0, 1, '2025-07-25 14:51:31', '2025-07-26 05:32:31'),
(6, 39, 'ashly', '0634803504', 'user_39_1753604475.jpg', 'pepsi, Hargeisa ', 'male', '0000-00-00', NULL, '', 0, 1, '2025-07-27 08:18:01', '2025-07-27 08:22:22'),
(7, 42, 'alqaysar', '065454321', 'user_42_1753616745.webp', 'Jig-jiga yar, Hargeisa', 'male', '0000-00-00', NULL, '', 0, 1, '2025-07-27 11:30:16', '2025-07-27 11:46:25');

-- --------------------------------------------------------

--
-- Table structure for table `props`
--

CREATE TABLE `props` (
  `id` int(10) NOT NULL,
  `name` varchar(200) NOT NULL,
  `location` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `price` varchar(200) NOT NULL,
  `baths` int(20) NOT NULL,
  `sq_ft` varchar(30) NOT NULL,
  `home_type` varchar(200) NOT NULL,
  `year_built` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  `price_sqft` int(30) NOT NULL,
  `description` text NOT NULL,
  `admin_name` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('available','leased') DEFAULT 'available',
  `is_leased` tinyint(1) NOT NULL DEFAULT 0,
  `rooms` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `props`
--

INSERT INTO `props` (`id`, `name`, `location`, `image`, `price`, `baths`, `sq_ft`, `home_type`, `year_built`, `type`, `price_sqft`, `description`, `admin_name`, `created_at`, `status`, `is_leased`, `rooms`) VALUES
(14, 'guri', 'new hargeisa', 'bangalo1.jpg', '2300', 3, '5,500', 'Condo', '2023', 'Rent', 120, 'waaa gurri', 'muuse', '2025-06-24 18:57:34', 'available', 1, 0),
(15, 'bangalo', 'jig-jiga yar', 'bangalo2.jpg', '500', 2, '328.084', 'Condo', '2023', 'Rent', 14, 'Spacious and well-maintained 4-bedroom home available for rent at just $500 per month. This comfortable property offers two clean and modern toilets, a bright and airy living area, and a fully equipped kitchen, making it perfect for families or shared living. Each bedroom provides generous space and storage, ensuring everyone has their own private retreat. Located in a safe, quiet neighborhood close to schools, markets, and public transport, this home combines convenience with comfort. Don’t miss this great rental opportunity—move in and feel right at home!', 'muuse', '2025-06-29 05:17:08', 'available', 0, 0),
(17, 'villa', 'Siinaay, Hargeisa', 'bangalo5.jpg', '700', 2, '25000', 'Condo', '2023', 'Rent', 120, 'Spacious and well-maintained 4-bedroom home available for rent at just $500 per month. This comfortable property offers two clean and modern toilets, a bright and airy living area, and a fully equipped kitchen, making it perfect for families or shared living. Each bedroom provides generous space and storage, ensuring everyone has their own private retreat. Located in a safe, quiet neighborhood close to schools, markets, and public transport, this home combines convenience with comfort. Don’t miss this great rental opportunity—move in and feel right at home!\r\n\r\n', 'muuse', '2025-06-29 05:27:55', 'available', 0, 0),
(18, 'saddex qol ', 'Siinaay, Hargeisa', 'bangalo.jpg', '120', 2, '120', 'Property-Land', '2024', 'Rent', 3000, 'Gurigu waxa uu ku yaalla dagmada axmed dhagax xaafada Siinay, qiimaha $120, midkiiba ', 'muuse', '2025-06-29 05:57:47', 'available', 0, 0),
(19, 'Bangalo ', 'hargeisa, somaliland', 'bangalo6.jpg', '450', 2, '5,500', 'Condo', '2020', 'Rent', 520, 'Spacious and well-maintained 4-bedroom home available for rent in a quiet and family-friendly neighborhood. This beautiful property features two clean and modern toilets, a large living area filled with natural light, and a functional kitchen perfect for daily cooking. Each bedroom offers ample space and storage, making it ideal for families or shared living. The home is conveniently located near schools, shops, and public transport, ensuring easy access to everything you need. Comfortable, secure, and ready to move in — your perfect rental home awaits!', 'muuse', '2025-06-29 05:59:32', 'available', 0, 0),
(20, 'Villa Buildings', 'october ', 'bangalo4.jpg', '700', 2, '5,500', 'Condo', '2025', 'Rent', 120, 'Spacious and well-maintained 4-bedroom home available for rent in a quiet and family-friendly neighborhood. This beautiful property features two clean and modern toilets, a large living area filled with natural light, and a functional kitchen perfect for daily cooking. Each bedroom offers ample space and storage, making it ideal for families or shared living. The home is conveniently located near schools, shops, and public transport, ensuring easy access to everything you need. Comfortable, secure, and ready to move in — your perfect rental home awaits!', 'muuse', '2025-06-29 06:01:17', 'available', 0, 0),
(21, 'guri23', 'masalaha', 'guri.jpeg', '400', 1, '', 'Guryo--Cusub', '2025', 'Rent', 0, '🏡 Spacious 7-Room Home for Rent in Masalaha – $400/month\r\nLooking for a comfortable and affordable rental in Masalaha? This spacious 7-room home is perfect for families or shared living.\r\n\r\n✅ Property Features:\r\n\r\n🛏️ 7 generously sized rooms\r\n\r\n🛁 1 clean and functional bathroom\r\n\r\n💸 Only $400 per month – unbeatable value for this size\r\n\r\n📍 Located in Masalaha – a peaceful, well-connected neighborhood\r\n\r\n🌞 Bright interiors with natural ventilation\r\n\r\n🏠 Ideal for large families or group tenants\r\n\r\nWhether you\'re settling down with family or need extra space for work and living, this home offers ample space, privacy, and convenience.\r\n\r\n📞 Contact us today to schedule a viewing and secure this great rental opportunity!\r\n\r\n', 'muuse', '2025-07-23 12:16:09', 'available', 0, 7);

-- --------------------------------------------------------

--
-- Table structure for table `related_images`
--

CREATE TABLE `related_images` (
  `id` int(10) NOT NULL,
  `image` varchar(200) NOT NULL,
  `prop_id` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `related_images`
--

INSERT INTO `related_images` (`id`, `image`, `prop_id`, `created_at`) VALUES
(31, 'gudaha-1750791454.jpg', 14, '2025-06-24 18:57:34'),
(32, 'gudaha2-1750791454.jpg', 14, '2025-06-24 18:57:34'),
(33, 'sawir-1750791454.jpg', 14, '2025-06-24 18:57:34'),
(34, 'sawir-1751174228.jpg', 15, '2025-06-29 05:17:08'),
(35, 'sawir0-1751174228.jpg', 15, '2025-06-29 05:17:08'),
(36, 'sawir1-1751174228.jpg', 15, '2025-06-29 05:17:08'),
(40, 'gudaha0-1751174875.jpg', 17, '2025-06-29 05:27:55'),
(41, 'gudaha1-1751174875.jpg', 17, '2025-06-29 05:27:55'),
(42, 'gudaha0-1751176667.jpg', 18, '2025-06-29 05:57:47'),
(43, 'gudaha1-1751176667.jpg', 18, '2025-06-29 05:57:47'),
(44, 'gudaha0-1751176772.jpg', 19, '2025-06-29 05:59:32'),
(45, 'gudaha1-1751176772.jpg', 19, '2025-06-29 05:59:32'),
(46, 'gudaha0-1751176877.jpg', 20, '2025-06-29 06:01:17'),
(47, 'gudaha1-1751176877.jpg', 20, '2025-06-29 06:01:17'),
(48, 'gudaha-1753272969.jpg', 21, '2025-07-23 12:16:09'),
(49, 'gudaha0-1753272969.jpg', 21, '2025-07-23 12:16:09'),
(50, 'gudaha1-1753272969.jpg', 21, '2025-07-23 12:16:09');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(10) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` int(40) NOT NULL,
  `prop_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `author` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `name`, `email`, `phone`, `prop_id`, `user_id`, `author`, `created_at`, `status`) VALUES
(4, 'MOhamed Hassan', 'moha@gmail.com', 21234433, 1, 2, 'Mohamed Hassan', '2023-01-01 11:41:43', 'rejected'),
(5, 'MOhamed Hassan', 'Moha@gmail.com', 22212343, 4, 1, 'admin.second', '2023-01-03 17:48:24', 'confirmed'),
(6, 'maxamed', 'muusedaahir87@gmail.com', 672223515, 2, 19, 'Mohamed Hassan', '2025-06-24 08:02:16', 'confirmed'),
(8, 'maxamed', 'saleebaandaahir41@gmail.com', 727741, 11, 19, 'muuse', '2025-06-24 08:57:02', 'confirmed'),
(9, 'maxamed', 'maxamed@gmail.com', 63727741, 14, 19, 'muuse', '2025-06-24 19:22:20', 'confirmed'),
(10, 'abdiwalli', 'saleebaandaahir41@gmail.com', 727741, 17, 33, 'muuse', '2025-07-26 17:32:19', 'pending'),
(11, 'ashly', 'mhmedjordan@gmail.com', 634803504, 20, 39, 'muuse', '2025-07-27 08:27:21', 'confirmed'),
(12, 'axmed qays', 'qaysaxmed2@gmail.com', 636865687, 17, 42, 'muuse', '2025-07-27 12:19:35', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `mypassword` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `otp_code` varchar(6) DEFAULT NULL,
  `is_verified` tinyint(4) DEFAULT 0,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_token_expires` datetime DEFAULT NULL,
  `otp_expires` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `mypassword`, `created_at`, `otp_code`, `is_verified`, `reset_token`, `reset_token_expires`, `otp_expires`) VALUES
(4, 'zultaan', 'zultaan29@gmail.com', '$2y$10$HBgDwmmO1MiiEd98kQ73wOawgp1fPXCoGp3X4iq7ugH5nI07aNYkW', '2025-06-08 16:13:43', NULL, 0, NULL, NULL, NULL),
(5, 'maxamed', 'saleebaandaahir41@gmail.com', '$2y$10$89m88XH7gVjXqhhG9rs65u5nbyZbuONogvd5OPNbRa9frttgnaTla', '2025-06-20 20:24:45', NULL, 0, '3cdfb0b12bfaf7c0f9e56457d38441a5a48f55580f6823c81e38552302db6177da094a28db2e1a5e72b15e0a50d3b2d5fd5e', '2025-06-21 12:11:13', NULL),
(6, 'maxamed', 'axmed@gmail.com', '$2y$10$o0aEsJ2hr14wx1FozOsWoeOfLvtUYqMRJqkLDJvgcUI6/T9HB2LrS', '2025-06-21 08:21:13', NULL, 0, NULL, NULL, NULL),
(7, 'maxamed', 'iimaan29@gmail.com', '$2y$10$KuUL0qZik2xs6f3S1j5fJOTt9627qDXsT2Ii62ZcmVp2sHYqaW2cG', '2025-06-21 08:51:53', NULL, 0, NULL, NULL, NULL),
(20, 'muuse', 'muusedaahir87@gmail.com', '$2y$10$3NyOqZ2H8qKtgxS1Mr1D1eCWjoYYdNDzjeI49RxjQpm3paGN2J53a', '2025-06-21 10:28:22', NULL, 1, '9c173ee9c4aba9947983fc817092be2dcc59a9b1a2e89f19ed7735d20ff4f8ea292a7c51ed5913718e43694daa3433fffcd3', '2025-06-24 21:20:45', NULL),
(21, 'maxamedz', 'macamed23@gmail.com', '$2y$10$q2oN3CqJoj7ytAZP5DtUuO6AXXNbdW1ySKkZsJhOw7e/tHt87HvK6', '2025-06-25 08:13:36', '832034', 0, NULL, NULL, '2025-06-25 08:23:36'),
(33, 'Hoobaan Rent company', 'hoobaanrentcompany@gmail.com', '', '2025-07-24 08:42:13', NULL, 1, NULL, NULL, NULL),
(34, 'qaysar', 'qaysardaahir937@gmail.com', '$2y$10$TmXfyxpyN77xETCz.lqf0e/pBVI/jCB2FQktJ6S4P9KLlJLjFhx3u', '2025-07-24 09:02:21', NULL, 1, '70dd657542d723585f3f54af9cd50106fccd6f947c2c632bf1c08c0ff13e31c2ff6c0eb8148419a9fb3453f59e83085abdbf', '2025-07-27 12:49:55', NULL),
(35, 'abdiwali', 'apdiwalimuuse56@gmail.com', '$2y$10$lcl5RuGAEhS6RQBMcwgyLeQD7fQ7x4LJZL6G2sHc32R7p/HWo.4zy', '2025-07-26 06:13:14', NULL, 1, NULL, NULL, NULL),
(38, 'ashly', 'mhmedjordan@gmail.com', '$2y$10$7mF9hU6mn1.Gtmv8hyrQ.uhRkQ4qTEF6cI5IFt8BspEGnvQXFxOQK', '2025-07-27 08:13:35', '307619', 0, NULL, NULL, '2025-07-27 08:23:35'),
(39, 'ashly', 'mhmedfuture@gmail.com', '$2y$10$V/30bUkrshjmkQYBPMzBgu8ixypFp7M7CAbSKX65v5SiuYctLGsyC', '2025-07-27 08:17:25', NULL, 1, NULL, NULL, NULL),
(40, 'alqaysar', 'alqayserdaahir@gmail.com', '$2y$10$qeAZJamzyUzazd1cEfAP5uTKwmrefh8FO3JJhxhctG4.8IaQbCkhS', '2025-07-27 10:19:25', '277739', 0, NULL, NULL, '2025-07-27 10:29:25'),
(41, 'qays', 'axmedqays2@gmail.com', '$2y$10$zBeujH2o1d1Sr6F0zfmncexq/PYUte/l6KepJmjx5Qyy.Zs5oYYRy', '2025-07-27 10:57:30', '574237', 0, NULL, NULL, '2025-07-27 11:12:00'),
(42, 'alqaysar', 'qaysaxmed2@gmail.com', '$2y$10$Ks5y5qRZkvBhC2fqJczfYOi.RdJIKz8ChMDvkRiAZUEyB8iFg.P..', '2025-07-27 11:10:07', NULL, 1, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favs`
--
ALTER TABLE `favs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `props`
--
ALTER TABLE `props`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `related_images`
--
ALTER TABLE `related_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `favs`
--
ALTER TABLE `favs`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `props`
--
ALTER TABLE `props`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `related_images`
--
ALTER TABLE `related_images`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
