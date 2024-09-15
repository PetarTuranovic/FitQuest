-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2024 at 12:41 AM
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
-- Database: `fitquest`
--

-- --------------------------------------------------------

--
-- Table structure for table `exercise`
--

CREATE TABLE `exercise` (
  `exercise_id` int(11) NOT NULL,
  `training_id` int(11) NOT NULL,
  `exercise_type` varchar(255) NOT NULL,
  `number_of_series` int(11) NOT NULL,
  `number_of_reps` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exercise`
--

INSERT INTO `exercise` (`exercise_id`, `training_id`, `exercise_type`, `number_of_series`, `number_of_reps`) VALUES
(1, 1, 'pushup', 1, 10),
(2, 2, 'squat', 2, 15),
(3, 2, 'pushup', 1, 10),
(4, 3, 'squat', 2, 12),
(5, 3, 'squat', 4, 12),
(6, 4, 'squat', 1, 11),
(7, 6, 'pushup', 1, 10),
(8, 7, 'squat', 1, 10),
(9, 8, 'pushup', 2, 10),
(10, 10, 'pushup', 1, 10),
(11, 11, 'pushup', 1, 10),
(12, 12, 'pushup', 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `training`
--

CREATE TABLE `training` (
  `training_id` int(11) NOT NULL,
  `user_id` int(6) UNSIGNED NOT NULL,
  `training_type` varchar(255) NOT NULL,
  `fatigue_level` int(11) NOT NULL,
  `duration_minutes` int(11) NOT NULL,
  `start_weight` decimal(5,2) DEFAULT NULL,
  `training_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `training`
--

INSERT INTO `training` (`training_id`, `user_id`, `training_type`, `fatigue_level`, `duration_minutes`, `start_weight`, `training_date`) VALUES
(1, 1, 'cardio', 2, 5, NULL, '2024-09-15 13:18:00'),
(2, 1, 'strength', 4, 20, 74.00, '2024-09-15 18:15:00'),
(3, 1, 'cardio', 3, 30, 70.00, '2024-09-15 22:11:00'),
(4, 1, 'cardio', 4, 10, 70.00, '2024-09-15 22:14:00'),
(5, 1, 'cardio', 3, 20, 70.00, '2024-09-15 22:15:00'),
(6, 1, 'strength', 2, 20, 70.00, '2024-09-15 22:15:00'),
(7, 1, 'flexibility', 3, 10, 68.00, '2024-09-15 22:18:00'),
(8, 1, 'cardio', 3, 20, 68.00, '2024-09-16 22:28:00'),
(9, 1, 'strength', 2, 30, 68.00, '2024-09-15 22:30:00'),
(10, 1, 'strength', 2, 30, 68.00, '2024-09-15 22:30:00'),
(11, 1, 'flexibility', 2, 3, 68.00, '2024-09-15 22:32:00'),
(12, 1, 'strength', 2, 30, 68.00, '2024-09-15 22:33:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(6) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `weight` double(100,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `password`, `weight`) VALUES
(1, 'petar', '$2y$10$GftXtTrw3ZkBg3SfrXhujOerQSxzfJD/JTZ3hab0tjNXUXKhBxsOW', 76.52),
(2, 'zoran', '$2y$10$VXJUhyE4LSQapLm5/HZQmubmLFYm6nyriQP.jDQnia6mnHjbKvHQO', 76.52),
(3, 'dragan', '$2y$10$gUS6VKaoFxtJv1Q5OUa/OOq97dfNa.Wr89IJ6s4MF0v//BVAcL4vW', 70.50),
(4, 'ana', '$2y$10$8ZKxLXiYIv1YqdQDoEGBauTXWyu4iQ5ofo20nbtn12gnijwj/VSZW', 65.30),
(5, 'cele', '$2y$10$k/OsjIQ1y7mE140EU/2NJunHWTePeLK4b9oPvwun/cc59Ue4E6s1m', 100.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exercise`
--
ALTER TABLE `exercise`
  ADD PRIMARY KEY (`exercise_id`),
  ADD KEY `training_id` (`training_id`);

--
-- Indexes for table `training`
--
ALTER TABLE `training`
  ADD PRIMARY KEY (`training_id`),
  ADD KEY `usersss` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exercise`
--
ALTER TABLE `exercise`
  MODIFY `exercise_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `training`
--
ALTER TABLE `training`
  MODIFY `training_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `exercise`
--
ALTER TABLE `exercise`
  ADD CONSTRAINT `exercise_ibfk_1` FOREIGN KEY (`training_id`) REFERENCES `training` (`training_id`);

--
-- Constraints for table `training`
--
ALTER TABLE `training`
  ADD CONSTRAINT `usersss` FOREIGN KEY (`user_id`) REFERENCES `users` (`userid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
