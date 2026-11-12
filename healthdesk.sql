-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: November 05, 2026 at 02:55 AM
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
-- Database: `healthdesk`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `appointment_time` time DEFAULT NULL,
  `comments` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `user_id`, `doctor_id`, `appointment_date`, `appointment_time`, `comments`) VALUES
(1, 1, 2, '2026-11-05', '00:24:00', 'ghnf'),
(2, 1, 2, '2026-11-05', '00:24:00', 'ghnf'),
(3, 1, 2, '2026-11-05', '00:24:00', 'ghnf'),
(4, 1, 2, '2026-11-29', '00:24:00', 'ghnf'),
(5, 1, 1, '2026-11-07', '12:32:00', 'tugu'),
(6, 1, 1, '2026-05-07', '12:32:00', 'tugu'),
(7, 1, 3, '2026-05-07', '01:31:00', 'fyffuyt'),
(8, 1, 2, '2026-04-29', '00:38:00', 'fgsfdb'),
(9, 1, 2, '2026-04-29', '00:38:00', 'fgsfdb'),
(10, 1, 3, '2026-05-07', '01:31:00', 'fyffuyt'),
(11, 1, 3, '2026-05-01', '12:40:00', 'SS'),
(12, 1, 3, '2026-05-01', '12:40:00', 'SS'),
(13, 1, 3, '2026-05-01', '12:40:00', 'SS'),
(14, 1, 3, '2026-05-01', '12:40:00', 'SS'),
(15, 1, 4, '2026-05-07', '00:48:00', 'sdfd'),
(16, 1, 4, '2026-05-07', '00:48:00', 'sdfd'),
(17, 1, 1, '2026-05-08', '18:51:00', 'cv'),
(18, 1, 1, '2026-05-08', '19:01:00', 'aa'),
(19, 1, 2, '2026-05-01', '07:10:00', 'dd'),
(20, 1, 2, '2026-04-27', '22:00:00', ''),
(21, 1, 1, '2026-05-06', '22:33:00', 'aa'),
(22, 1, 2, '2026-05-06', '10:40:00', 'aa'),
(23, 1, 2, '2026-04-30', '23:28:00', ''),
(24, 1, 1, '2026-05-01', '12:06:00', 'aa'),
(25, 1, 1, '2026-04-27', '00:18:00', ''),
(26, 1, 1, '2026-05-15', '00:31:00', ''),
(27, 1, 1, '2026-04-30', '12:36:00', ''),
(28, 1, 2, '2026-05-01', '18:14:00', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `department`) VALUES
(1, 'Dr. Ayesha Rahman', 'General Physician'),
(2, 'Dr. Imran Kabir', 'General Physician'),
(3, 'Dr. Nusrat Jahan', 'Pediatrics'),
(4, 'Dr. Kamrul Hasan', 'Pediatrics'),
(5, 'Dr. Farhana Islam', 'Gynae & Obs'),
(6, 'Dr. Tasnim Ahmed', 'Gynae & Obs'),
(7, 'Dr. Rezaul Karim', 'Dermatology'),
(8, 'Dr. Mahfuz Hossain', 'Cardiology'),
(9, 'Dr. Sabrina Haque', 'Neurology'),
(10, 'Dr. Tanvir Alam', 'Orthopedics'),
(11, 'Dr. Fahim Rahman', 'Dentistry'),
(12, 'Dr. Rafiq Ahmed', 'Psychiatry'),
(13, 'Dr. Nazia Haque', 'ENT');

-- --------------------------------------------------------

--
-- Table structure for table `doctors_user`
--

CREATE TABLE `doctors_user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `office` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `reset_token` varchar(255) DEFAULT NULL,
  `token_expiry` datetime DEFAULT NULL,
  `serial_number` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `email`, `phone`, `address`, `office`, `password`, `created_at`, `reset_token`, `token_expiry`, `serial_number`) VALUES
(1, 'patient', 'GHF', 'FGH@HBCG', 'GCH', 'CGH', 'CH', '$2y$10$k6bgLiO1tX7Wn2fz92gHs.pdkaLL3COZZ7qUYCQGgeb1y0DQsa7sa', '2025-05-25 17:45:32', NULL, NULL, 0),
(2, 'patient', 'fgsg', 'aa@a', '22', '22', '22', '$2y$10$w0nGNjzmclO7soiyDluHfOUOfKr9gZVsDbO3neWJhfMDbJmn1utoG', '2025-05-25 17:59:16', NULL, NULL, 0),
(3, 'patient', 'add@', 'add@ee', '55', '55', '55', '$2y$10$p87O3PNA8aa4pXhI5zB9QuagW//vdD5cnO14Xm53vAnlDYx8xRSgi', '2025-05-25 18:02:44', NULL, NULL, 0),
(4, 'doctor', 'doc', 'doc@a', '11', '11', '11', '$2y$10$xb7iARVR7pK7kx.E3p0/k.vp9yvmn/Wtvs0JYJcE1DD7ajzvp7zue', '2025-05-27 17:27:00', NULL, NULL, 0),
(5, 'doctor', 'aa', 'aa@aa', '11', '11', '', '$2y$10$lqQ5OxB9YwWm8/bZiPlV5.2mCry/sQvyAVZrKGVx/GYfJV/H/E072', '2025-05-27 23:56:08', NULL, NULL, 0),
(6, 'patient', 'aa', 'labib@g.com', '015', 'Dhaka', '', '$2y$10$nToYXj0bfojxaVUw7h8q9O7Eemj6tqHatRe4zJocQ0QKd4BDM9EuW', '2025-05-28 00:12:59', NULL, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors_user`
--
ALTER TABLE `doctors_user`
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
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `doctors_user`
--
ALTER TABLE `doctors_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
