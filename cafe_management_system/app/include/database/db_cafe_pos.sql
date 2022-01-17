-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2021 at 02:25 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_cafe_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `meals`
--

CREATE TABLE `meals` (
  `id` int(6) NOT NULL,
  `meal_name` varchar(70) NOT NULL,
  `price` double NOT NULL,
  `category` varchar(70) NOT NULL,
  `picture_of_meal` varchar(200) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `meals`
--

INSERT INTO `meals` (`id`, `meal_name`, `price`, `category`, `picture_of_meal`, `date_created`) VALUES
(1, 'Soda', 30, 'soft_drink', 'uploads/12248soda.jpg', '2021-10-22'),
(2, 'Mandazi', 5, 'breakfast', 'uploads/30229mandazi.jpg', '2021-10-22'),
(3, 'Tea', 15, 'breakfast', 'uploads/26083tea.jpg', '2021-10-22'),
(4, 'Coffee', 20, 'breakfast', 'uploads/31764coffee.jpg', '2021-10-22'),
(5, 'Rice', 20, 'lunch', 'uploads/40472steamed rice.jpg', '2021-10-22'),
(6, 'Ugali', 20, 'lunch', 'uploads/43162ugali.jpg', '2021-10-22'),
(7, 'Beans', 30, 'supper', 'uploads/44530beans.jpg', '2021-10-22'),
(8, 'Pilau', 70, 'lunch', 'uploads/59853pilau.jpg', '2021-10-22');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(6) NOT NULL,
  `meal_id` int(6) NOT NULL,
  `quantity` int(3) NOT NULL DEFAULT 1,
  `payment_method` int(2) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `meal_id`, `quantity`, `payment_method`, `date_created`) VALUES
(2, 8, 3, 1, '2021-10-21'),
(3, 1, 3, 1, '2021-10-22'),
(4, 2, 4, 2, '2021-10-22'),
(5, 5, 3, 2, '2021-10-26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(6) NOT NULL,
  `first_name` varchar(70) NOT NULL,
  `last_name` varchar(70) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `username` varchar(70) NOT NULL,
  `password` varchar(200) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `phone_number`, `username`, `password`, `date_created`) VALUES
(1, 'Admin', 'Irene', '+1 (478) 934-2394', 'admin', 'admin', '2021-10-22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `meals`
--
ALTER TABLE `meals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meal_id` (`meal_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `meals`
--
ALTER TABLE `meals`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
