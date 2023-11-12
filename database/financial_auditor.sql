-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 12, 2023 at 02:21 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `financial_auditor`
--

-- --------------------------------------------------------

--
-- Table structure for table `budgets`
--

CREATE TABLE `budgets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_name` varchar(3000) NOT NULL,
  `quantity` int(11) NOT NULL,
  `budget_price` float NOT NULL,
  `totals` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `budgets`
--

INSERT INTO `budgets` (`id`, `user_id`, `item_name`, `quantity`, `budget_price`, `totals`) VALUES
(10, 1, 'Hair kits', 1, 10000, 10000),
(11, 1, 'Gas', 1, 4000, 4000),
(12, 1, 'Food Stuff', 1, 20000, 20000),
(13, 1, 'Toileteries', 1, 8000, 8000),
(14, 1, 'Beverages', 1, 15000, 15000),
(15, 1, 'Fruits', 1, 3500, 3500),
(16, 1, 'Cable Subscribtion', 1, 3000, 3000),
(17, 1, 'Wears', 1, 16500, 16500),
(18, 1, 'Drinks', 1, 5700, 5700);

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_name` varchar(3000) NOT NULL,
  `quantity` int(20) NOT NULL,
  `actual_price` float NOT NULL,
  `totals` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `user_id`, `item_name`, `quantity`, `actual_price`, `totals`) VALUES
(10, 1, 'Hair kits', 1, 13000, 13000),
(11, 1, 'Gas', 1, 6500, 6500),
(12, 1, 'Food Stuff', 1, 35000, 35000),
(13, 1, 'Toileteries', 1, 10000, 10000),
(14, 1, 'Beverages', 1, 25000, 25000),
(15, 1, 'Fruits', 1, 5000, 5000),
(16, 1, 'Cable Subscribtion', 1, 4000, 4000),
(17, 1, 'Wears', 1, 18000, 18000),
(18, 1, 'Drinks', 1, 6500, 6500);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_name` varchar(3000) NOT NULL,
  `quantity` int(11) NOT NULL,
  `budget_price` float NOT NULL,
  `actual_price` float NOT NULL,
  `differences` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `user_id`, `item_name`, `quantity`, `budget_price`, `actual_price`, `differences`) VALUES
(10, 1, 'Hair kits', 1, 10000, 13000, -3000),
(11, 1, 'Gas', 1, 4000, 6500, -2500),
(12, 1, 'Food Stuff', 1, 20000, 35000, -15000),
(13, 1, 'Toileteries', 1, 8000, 10000, -2000),
(14, 1, 'Beverages', 1, 15000, 25000, -10000),
(15, 1, 'Fruits', 1, 3500, 5000, -1500),
(16, 1, 'Cable Subscribtion', 1, 3000, 4000, -1000),
(17, 1, 'Wears', 1, 16500, 18000, -1500),
(18, 1, 'Drinks', 1, 5700, 6500, -800);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`) VALUES
(1, 'Yewande', 'Adegoke', 'abuh@gmail.com', '$2y$10$QvVAu9lpjiOVQiD2JOWQROw3DvfWBGMyuN3Wp8TP0gQhKowzcGK/u'),
(2, 'Cornelius', 'Adegoke', 'code.fortunatus@gmail.com', '$2y$10$QvVAu9lpjiOVQiD2JOWQROw3DvfWBGMyuN3Wp8TP0gQhKowzcGK/u');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `budgets`
--
ALTER TABLE `budgets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reports_ibfk_1` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `budgets`
--
ALTER TABLE `budgets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `budgets`
--
ALTER TABLE `budgets`
  ADD CONSTRAINT `budgets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
