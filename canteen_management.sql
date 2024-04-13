-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2024 at 05:05 PM
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
-- Database: `canteen_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `stocks` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `stall_id` int(11) NOT NULL,
  `last_modified` date NOT NULL DEFAULT current_timestamp(),
  `isAvailable` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `price`, `stocks`, `category`, `stall_id`, `last_modified`, `isAvailable`) VALUES
(53, 'sfsdf', 1231, 12, 'snacks', 1, '2024-04-09', 1),
(54, 'Yakult', 20, 100, 'beverages', 1, '2024-04-08', 1),
(55, 'Yakult', 20, 100, 'beverages', 2, '2024-04-09', 1),
(56, 'Cheese cake', 20, 400, 'snacks', 1, '2024-04-10', 1),
(57, 'Kanin', 341, 1000, 'desserts', 2, '2024-04-07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stall`
--

CREATE TABLE `stall` (
  `id` int(11) NOT NULL,
  `stall_name` varchar(255) NOT NULL,
  `stall_owner_id` int(11) NOT NULL,
  `total_products` int(11) NOT NULL,
  `last_modified` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stall`
--

INSERT INTO `stall` (`id`, `stall_name`, `stall_owner_id`, `total_products`, `last_modified`) VALUES
(1, 'STALL A', 16, 89, '2024-04-02'),
(2, 'Stall B', 16, 1231, '2024-04-10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `created_at`) VALUES
(16, 'admin', 'admin', 'admin', '$2y$10$nijQeemI/33roOLe7YHfF.HAstObuaI9.bfTSKrRGScCvrK18kGZS', '2024-03-19'),
(17, 'gg', 'gg', 'gg', '$2y$10$H1cYWNvEwbp8v1s9IR0JEO2c/WI0NbkFOZF8ISoNIytD4wJE5/pcO', '2024-04-02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stall`
--
ALTER TABLE `stall`
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
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `stall`
--
ALTER TABLE `stall`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
