-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2021 at 10:03 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `service_id` int(11) DEFAULT NULL,
  `contact_name` varchar(150) COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_bin NOT NULL,
  `message` text COLLATE utf8mb4_bin DEFAULT NULL,
  `id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`service_id`, `contact_name`, `email`, `message`, `id`) VALUES
(3, 'abdullah', 'a@a.x', 'المملكة العربية السعودية', 17),
(1, 'abdullah', 'eng.abdullah_98@outlook.com', '&#39;p', 21),
(4, 'anonymous', 'a@a.a', 'a', 24),
(3, 'abdullah', '2@w.x', 'd', 25);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `user_id`, `token`, `expires_at`, `created_at`) VALUES
(9, 15, 'e7808b57a3c509702f9b131eb27fec59', '2021-06-14 19:06:18', '2021-06-13 20:06:18');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(12) NOT NULL,
  `name` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `price` double(9,2) UNSIGNED NOT NULL,
  `image` varchar(128) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`) VALUES
(2, 'wires  ', '', 42.48, 'uploads/products/1626818243selk.png'),
(4, 'Tubes', '', 4.50, 'uploads/products/1626635906iron.jpg'),
(8, 'iron', '', 140.00, 'uploads/products/202107/16266429911626634226imageforseel.jpg'),
(9, 'wood', '', 1447.20, 'uploads/products/202107/1626789001wood.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `price` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `price`) VALUES
(1, 'iron', 'for iron tools', '1440.00'),
(2, 'wires', 'فلوس ', '42.00'),
(3, 'Wood', 'فلوس', '1258.00'),
(4, 'Tubes', 'no description', '1.50'),
(7, 'a', 'a', '15.00');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `admin_email` varchar(64) COLLATE utf8mb4_bin NOT NULL,
  `app_name` varchar(64) COLLATE utf8mb4_bin NOT NULL DEFAULT 'Service App'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `admin_email`, `app_name`) VALUES
(1, 'admin@admin.a', 'O-ENVIRON'),
(2, 'abdullah.98ha@gmail.com', 'service app');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_bin NOT NULL DEFAULT 'user',
  `create_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `password`, `role`, `create_at`) VALUES
(16, 'abdullah.98ha@gamil.com', 'aawad_s', '$2y$10$cyzpyWglb4ZjAdI.Krn8ZuyA1msMfspx7h0qBX1UEahuUQ8kb8Ox2', 'admin', '2021-06-10 21:41:38'),
(18, 'm@m.m', 'm', '$2y$10$eO3/OfB45lbR1dIctZtakOasw/K1KPQ9KIH440N5yMwMY1lyPDWGS', 'user', '2021-07-04 10:37:57'),
(19, 'admin@admin.a', 'admin', '$2y$10$cRs5rZh4KkZdC734jFTmbO2qfEQnH7J21zTKn3Wgjp4vpHgy6Lmuq', 'admin', '2021-07-04 14:56:10'),
(20, 'user@user.u', 'user', '$2y$10$5P8M0Y2BW55fdeNxEnTk7.OTdzIKjvsJI8mawj/dyN/tFIwJVtTWa', 'user', '2021-07-04 14:59:04'),
(21, 'b@b.b', 'b', '$2y$10$LqB9pknxKtFxft9hEb4v2eDQDxMI4Ipro2C9wCHOvg24qdYOWQaEG', 'user', '2021-07-04 15:04:21'),
(22, 'saad@s.s', 'saad', '$2y$10$CAud9amdgCaHxjzUeCByXu6JQuy5xaJ2QZfnPmMzps642WtbF4POS', 'user', '2021-07-05 10:06:59'),
(23, 'ass@w.qa', 'abdullah', '$2y$10$q.ljgyOCLJROu9oJ32erTek.PgyVXLmyR/QM4tHmMTs7ECTNAmPzy', 'user', '2021-07-05 10:29:06'),
(27, 'gg@gg.g', 'Gaber', '$2y$10$R52bBR.y4hozubml5WGqo.v/S3a9nJfLryF2cFH5T317l8S37NyAO', 'user', '2021-07-07 10:09:31'),
(28, 'jojo2102010@hotmail.com', 'abdullah', '$2y$10$mwGmZtjoGnwxwq06/Bcg...M7kMyNxNaX5ls5Tyt.yeNathN0LDNe', 'user', '2021-07-28 11:46:05'),
(29, 'saleh@ahmed.sa', 'saleh', '$2y$10$rUWGB3PR5OnbZRmwo5NwCOV2EqrrNPTt6rPZxY0OSJIQ39ad2OFJ.', 'user', '2021-08-02 23:33:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_service_id` (`service_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_service_id` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
