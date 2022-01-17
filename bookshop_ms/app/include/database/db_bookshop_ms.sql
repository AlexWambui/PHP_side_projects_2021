-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2021 at 12:23 PM
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
-- Database: `db_bookshop_ms`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(6) NOT NULL,
  `category` varchar(70) NOT NULL,
  `title` varchar(70) NOT NULL,
  `author` varchar(70) NOT NULL,
  `description` varchar(200) NOT NULL,
  `price` int(5) NOT NULL,
  `book_cover` varchar(200) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `category`, `title`, `author`, `description`, `price`, `book_cover`, `date_created`) VALUES
(2, 'romance', 'After', 'Anna Todd', 'Nice romance fiction book', 1500, 'uploads/38997bookshop.jpg', '2021-10-15 09:37:35'),
(4, 'romance', 'Tom Sowyer', 'Clinton Bakari', 'Fictional book.', 2500, 'uploads/70393images (2).jpg', '2021-10-16 12:38:47'),
(5, 'history', 'Malcolm X', 'Malcom X', 'Good history book.', 1500, 'uploads/93281images (3).jpg', '2021-10-19 09:43:54');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(6) NOT NULL,
  `book_id` int(6) NOT NULL,
  `customer_names` varchar(100) NOT NULL,
  `date_created` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `book_id`, `customer_names`, `date_created`) VALUES
(2, 2, 'Clinton', '2021-10-15 13:36:00'),
(3, 4, 'Lauren Waithera', '2021-10-16 12:39:04'),
(4, 4, 'Peter', '2021-10-19 09:42:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(6) NOT NULL,
  `first_name` varchar(70) NOT NULL,
  `last_name` varchar(70) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email_address` varchar(70) NOT NULL,
  `password` varchar(200) NOT NULL,
  `user_level` int(2) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `phone_number`, `email_address`, `password`, `user_level`, `date_created`) VALUES
(1, 'Admin', 'DBAdmin', '+1 (599) 645-5029', 'admin@gmail.com', 'admin', 1, '2021-10-14 21:18:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
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
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
