-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2021 at 12:12 PM
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
-- Database: `db_zuri_high_school`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_id` int(6) NOT NULL,
  `class_name` varchar(70) NOT NULL,
  `class_teacher_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_id`, `class_name`, `class_teacher_id`) VALUES
(3, '1 North', 3),
(5, '1 West', 5),
(6, '1 South', 4),
(7, '2 North', 4),
(8, '3 North', 2),
(9, '2 East', 6);

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `marks_id` int(6) NOT NULL,
  `student_id` int(6) NOT NULL,
  `maths` int(2) NOT NULL DEFAULT 0,
  `english` int(2) NOT NULL DEFAULT 0,
  `kiswahili` int(2) NOT NULL DEFAULT 0,
  `biology` int(2) NOT NULL DEFAULT 0,
  `chemistry` int(2) NOT NULL DEFAULT 0,
  `physics` int(2) NOT NULL DEFAULT 0,
  `geography` int(2) NOT NULL DEFAULT 0,
  `history` int(2) NOT NULL DEFAULT 0,
  `agriculture` int(2) NOT NULL DEFAULT 0,
  `business_studies` int(2) NOT NULL DEFAULT 0,
  `cre` int(2) NOT NULL DEFAULT 0,
  `computer_studies` int(2) NOT NULL DEFAULT 0,
  `exam_type` varchar(20) NOT NULL,
  `year` int(11) NOT NULL,
  `term` int(2) NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `marks`
--

INSERT INTO `marks` (`marks_id`, `student_id`, `maths`, `english`, `kiswahili`, `biology`, `chemistry`, `physics`, `geography`, `history`, `agriculture`, `business_studies`, `cre`, `computer_studies`, `exam_type`, `year`, `term`, `remarks`, `date_created`) VALUES
(1, 3, 12, 49, 67, 85, 55, 98, 16, 25, 100, 89, 67, 29, 'cat_1', 2021, 3, '', '2021-10-26'),
(2, 4, 4, 91, 47, 2, 21, 20, 47, 83, 50, 46, 13, 6, 'cat_1', 2021, 1, '', '2021-10-26'),
(3, 4, 75, 15, 83, 67, 34, 46, 22, 8, 29, 74, 36, 23, 'cat_2', 2021, 1, 'Good', '2021-10-26');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `results_id` int(6) NOT NULL,
  `student_id` int(6) NOT NULL,
  `year` int(4) NOT NULL,
  `term` int(1) NOT NULL,
  `cat1_maths` int(3) NOT NULL DEFAULT 0,
  `cat1_english` int(3) NOT NULL DEFAULT 0,
  `cat1_kiswahili` int(3) NOT NULL DEFAULT 0,
  `cat1_physics` int(3) NOT NULL DEFAULT 0,
  `cat1_biology` int(3) NOT NULL DEFAULT 0,
  `cat1_chemistry` int(3) NOT NULL DEFAULT 0,
  `cat1_geography` int(3) NOT NULL DEFAULT 0,
  `cat1_history` int(3) NOT NULL DEFAULT 0,
  `cat1_agriculture` int(3) NOT NULL DEFAULT 0,
  `cat1_business_studies` int(3) NOT NULL DEFAULT 0,
  `cat1_cre` int(3) NOT NULL DEFAULT 0,
  `cat1_computer_studies` int(3) NOT NULL DEFAULT 0,
  `cat2_maths` int(3) NOT NULL DEFAULT 0,
  `cat2_english` int(3) NOT NULL DEFAULT 0,
  `cat2_kiswahili` int(3) NOT NULL DEFAULT 0,
  `cat2_physics` int(3) NOT NULL DEFAULT 0,
  `cat2_biology` int(3) NOT NULL DEFAULT 0,
  `cat2_chemistry` int(3) NOT NULL DEFAULT 0,
  `cat2_geography` int(3) NOT NULL DEFAULT 0,
  `cat2_history` int(3) NOT NULL DEFAULT 0,
  `cat2_agriculture` int(3) NOT NULL DEFAULT 0,
  `cat2_business_studies` int(3) NOT NULL DEFAULT 0,
  `cat2_cre` int(3) NOT NULL DEFAULT 0,
  `cat2_computer_studies` int(3) NOT NULL DEFAULT 0,
  `end_term_maths` int(3) NOT NULL DEFAULT 0,
  `end_term_english` int(3) NOT NULL DEFAULT 0,
  `end_term_kiswahili` int(3) NOT NULL DEFAULT 0,
  `end_term_physics` int(3) NOT NULL DEFAULT 0,
  `end_term_biology` int(3) NOT NULL DEFAULT 0,
  `end_term_chemistry` int(3) NOT NULL DEFAULT 0,
  `end_term_geography` int(3) NOT NULL DEFAULT 0,
  `end_term_history` int(3) NOT NULL DEFAULT 0,
  `end_term_agriculture` int(3) NOT NULL DEFAULT 0,
  `end_term_business_studies` int(3) NOT NULL DEFAULT 0,
  `end_term_cre` int(3) NOT NULL DEFAULT 0,
  `end_term_computer_studies` int(3) NOT NULL DEFAULT 0,
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`results_id`, `student_id`, `year`, `term`, `cat1_maths`, `cat1_english`, `cat1_kiswahili`, `cat1_physics`, `cat1_biology`, `cat1_chemistry`, `cat1_geography`, `cat1_history`, `cat1_agriculture`, `cat1_business_studies`, `cat1_cre`, `cat1_computer_studies`, `cat2_maths`, `cat2_english`, `cat2_kiswahili`, `cat2_physics`, `cat2_biology`, `cat2_chemistry`, `cat2_geography`, `cat2_history`, `cat2_agriculture`, `cat2_business_studies`, `cat2_cre`, `cat2_computer_studies`, `end_term_maths`, `end_term_english`, `end_term_kiswahili`, `end_term_physics`, `end_term_biology`, `end_term_chemistry`, `end_term_geography`, `end_term_history`, `end_term_agriculture`, `end_term_business_studies`, `end_term_cre`, `end_term_computer_studies`, `date_created`) VALUES
(1, 1, 2021, 1, 100, 33, 2, 90, 18, 97, 6, 53, 10, 80, 92, 61, 100, 72, 100, 53, 46, 30, 26, 18, 18, 11, 12, 11, 100, 61, 33, 83, 83, 85, 37, 74, 67, 82, 98, 49, '2021-10-27'),
(2, 5, 2021, 1, 80, 20, 85, 5, 69, 76, 29, 2, 9, 89, 22, 42, 69, 78, 97, 97, 89, 94, 93, 73, 56, 57, 86, 41, 39, 30, 22, 34, 65, 70, 60, 51, 69, 86, 1, 24, '2021-10-27'),
(3, 4, 2021, 1, 82, 91, 51, 59, 50, 67, 71, 41, 75, 88, 45, 88, 91, 45, 67, 61, 77, 85, 58, 31, 31, 54, 51, 94, 63, 17, 16, 31, 48, 44, 91, 56, 20, 71, 74, 33, '2021-10-27'),
(4, 7, 2021, 3, 62, 0, 0, 0, 59, 0, 0, 0, 0, 0, 0, 0, 70, 0, 0, 0, 62, 0, 0, 0, 0, 0, 0, 0, 79, 0, 0, 0, 70, 0, 0, 0, 0, 0, 0, 0, '2021-10-27'),
(5, 8, 2021, 2, 0, 0, 0, 42, 0, 0, 0, 83, 0, 0, 0, 0, 0, 0, 0, 64, 0, 0, 0, 64, 64, 0, 0, 0, 0, 0, 0, 73, 0, 0, 0, 72, 0, 0, 0, 0, '2021-10-27');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(6) NOT NULL,
  `first_name` varchar(70) NOT NULL,
  `last_name` varchar(70) NOT NULL,
  `adm_number` varchar(10) NOT NULL,
  `class_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `first_name`, `last_name`, `adm_number`, `class_id`) VALUES
(1, 'Jackson', 'Mcbride', 'ZH2320', 5),
(3, 'Warren', 'Mullins', 'ZH2321', 3),
(4, 'Germane', 'Moses', 'ZH2322', 6),
(6, 'Nigel', 'Patrick', 'ZH2432', 6),
(7, 'mary', 'wambui', 'ZH3542', 4),
(8, 'Alex', 'K', 'ZH3547', 8),
(9, 'Abraham', 'Lincon', 'ZH4221', 5);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(6) NOT NULL,
  `subject_name` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject_name`) VALUES
(1, 'Biology'),
(2, 'Chemistry'),
(3, 'Physics'),
(4, 'Maths'),
(5, 'English'),
(6, 'CRE'),
(7, 'History');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(6) NOT NULL,
  `first_name` varchar(70) NOT NULL,
  `last_name` varchar(70) NOT NULL,
  `email_address` varchar(70) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `password` varchar(200) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'active',
  `user_level` int(2) NOT NULL DEFAULT 1,
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email_address`, `phone_number`, `password`, `status`, `user_level`, `date_created`) VALUES
(1, 'Admin', 'DBAdmin', 'admin@gmail.com', '+1 (948) 213-5596', 'admin', 'active', 3, '2021-10-25'),
(2, 'Denise', 'HOD', 'hod@gmail.com', '+1 (783) 644-6506', 'hod', 'active', 2, '2021-10-25'),
(3, 'Stephen', 'Hayden', 'teacher@gmail.com', '+1 (916) 335-9967', 'teacher', 'active', 1, '2021-10-25'),
(4, 'Hyatt', 'Newman', 'teacherHyatt@gmail.com', '+1 (314) 124-3674', 'teacher', 'active', 1, '2021-10-25'),
(5, 'Reuben', 'Rush', 'teacherRush@gmail.com', '+1 (642) 824-8467', 'teacher', 'active', 1, '2021-10-25'),
(6, 'Diana', 'Mcmillan', 'diana@gmail.com', '+1 (572) 435-9075', '1234', 'active', 1, '2021-10-27'),
(7, 'Irene', 'W', 'irene@gmail', '0712345678', '2345', 'active', 1, '2021-10-27'),
(8, 'Emily', 'Grace', 'emily@gmail.com', '0798765431', '2345', 'active', 1, '2021-10-27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`),
  ADD KEY `class_teacher` (`class_teacher_id`);

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`marks_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`results_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `marks_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `results_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
