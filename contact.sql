-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2021 at 01:51 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `application`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(255) NOT NULL,
  `user_id_to` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `created_at`, `updated_at`, `user_id`, `user_id_to`) VALUES
(52, '2021-06-17 11:50:43', NULL, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(50) NOT NULL,
  `country_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_name`) VALUES
(16, 'Argentina'),
(19, 'Austrija'),
(17, 'Belgium'),
(10, 'BiH'),
(9, 'Croatia'),
(15, 'France'),
(3, 'Germany'),
(11, 'Greece'),
(12, 'Italy'),
(18, 'Montenegro'),
(8, 'Netherlands'),
(13, 'Portugal'),
(5, 'Russia'),
(1, 'Serbia'),
(7, 'Spain'),
(6, 'Sweden'),
(4, 'Switzerland'),
(2, 'Turkey'),
(14, 'USA');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `seen` tinyint(1) NOT NULL,
  `user_from` int(255) NOT NULL,
  `user_to` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pending_contact`
--

CREATE TABLE `pending_contact` (
  `id` int(255) NOT NULL,
  `user_id_from` int(255) NOT NULL,
  `user_id_to` int(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reset_pwd`
--

CREATE TABLE `reset_pwd` (
  `id` int(11) NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `selector` text COLLATE utf8_unicode_ci NOT NULL,
  `token` longtext COLLATE utf8_unicode_ci NOT NULL,
  `expires` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(255) NOT NULL,
  `role_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Operator');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `organization` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `number` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `notes` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `src` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alt` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ban` timestamp NULL DEFAULT NULL,
  `banned_from` int(255) DEFAULT NULL,
  `v_key` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `verified` tinyint(1) NOT NULL,
  `counrty_id` int(255) NOT NULL,
  `role_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `created_at`, `updated_at`, `user_name`, `organization`, `number`, `email`, `password`, `notes`, `src`, `alt`, `ban`, `banned_from`, `v_key`, `verified`, `counrty_id`, `role_id`) VALUES
(1, '2021-06-02 11:35:49', '2021-06-16 20:02:25', 'Boris', 'praktikant', '052605184', 'boris.dmitrovic@quantox.com', '4297f44b13955235245b2497399d7a93', '                                                                               somthing             ', 'images/users/1623840055_slike-prirode-za-desktop-757.jpg', 'user picture', '2021-06-10 07:30:26', 1, '', 1, 1, 1),
(4, '2021-06-02 12:29:07', NULL, 'noname', 'noorganization', '0000000', 'noname@gmail.com', '4297f44b13955235245b2497399d7a93', 'nonotes', NULL, NULL, NULL, NULL, '', 1, 16, 2),
(14, '2021-06-07 07:58:25', NULL, 'Username', 'Organization', '12312312312', 'username@gmail.com', '8d4646eb2d7067126eb08adb0672f7bb', 'asasas', NULL, 'user picture', NULL, NULL, '', 0, 12, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_favorites`
--

CREATE TABLE `user_favorites` (
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id_1` int(100) NOT NULL,
  `user_id_2` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_favorites`
--

INSERT INTO `user_favorites` (`created_at`, `user_id_1`, `user_id_2`) VALUES
('2021-06-08 06:13:06', 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_id_to` (`user_id_to`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `country_name` (`country_name`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_from` (`user_from`),
  ADD KEY `user_to` (`user_to`);

--
-- Indexes for table `pending_contact`
--
ALTER TABLE `pending_contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_from` (`user_id_from`,`user_id_to`);

--
-- Indexes for table `reset_pwd`
--
ALTER TABLE `reset_pwd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD KEY `number` (`number`),
  ADD KEY `email` (`email`),
  ADD KEY `counrty_id` (`counrty_id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `ban` (`ban`),
  ADD KEY `banned_from` (`banned_from`),
  ADD KEY `verified` (`verified`);

--
-- Indexes for table `user_favorites`
--
ALTER TABLE `user_favorites`
  ADD KEY `user_id_1` (`user_id_1`),
  ADD KEY `user_id_2` (`user_id_2`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `pending_contact`
--
ALTER TABLE `pending_contact`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `reset_pwd`
--
ALTER TABLE `reset_pwd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
