-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2024 at 12:28 AM
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
-- Database: `payroll_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `date_of_birth` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `first_name`, `last_name`, `date_of_birth`) VALUES
(2, 'Pckison', 'John', '2021-08-30'),
(3, 'kwizera', 'Dady', '2024-04-30'),
(44, 'iuytrdsdfghj', 'uytfrdsdfgh', '2024-04-03'),
(45, 'Dukuze ', 'Fidel', '2023-01-09'),
(46, 'Felix', 'Ishimwe', '2022-10-06'),
(47, 'Felix', 'Ishimwe', '2022-10-06');

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `payroll_id` int(11) NOT NULL,
  `employee_id` varchar(20) DEFAULT NULL,
  `pay_period_start_date` varchar(50) DEFAULT NULL,
  `pay_period_end_date` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`payroll_id`, `employee_id`, `pay_period_start_date`, `pay_period_end_date`) VALUES
(1, '2', 'ertyu', 'kijhgfcxz'),
(2, '', '', ''),
(3, '34', '', ''),
(4, '', '', ''),
(5, '', '', ''),
(6, '3', '2024-04-10', '2024-04-30'),
(20, '3', '2024-04-02', '2024-05-01'),
(45, '45', '2024-04-09', '2024-04-16'),
(46, '3', '2024-04-04', '2024-04-10');

-- --------------------------------------------------------

--
-- Table structure for table `tax`
--

CREATE TABLE `tax` (
  `tax_id` int(11) NOT NULL,
  `tax_name` varchar(20) DEFAULT NULL,
  `tax_rate` varchar(50) DEFAULT NULL,
  `tax_category` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tax`
--

INSERT INTO `tax` (`tax_id`, `tax_name`, `tax_rate`, `tax_category`) VALUES
(1, 'hdsgaSHJ', 'hdsgaSHJ', 'LASUDSJKJHS'),
(3, 'kjjjjjj', '2', 'yyyy'),
(4, 'to car', '66', 'trtrr'),
(47, 'www', '1', 'eee');

-- --------------------------------------------------------

--
-- Table structure for table `timetracking`
--

CREATE TABLE `timetracking` (
  `time_id` int(11) NOT NULL,
  `employee_id` varchar(20) DEFAULT NULL,
  `clock_in_time` varchar(50) DEFAULT NULL,
  `clock_out_time` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timetracking`
--

INSERT INTO `timetracking` (`time_id`, `employee_id`, `clock_in_time`, `clock_out_time`) VALUES
(3, '3', '34', '55'),
(5, '47', '2024-03-31T13:02', '2024-04-11T13:02'),
(6, '45', '2024-02-29T16:59', '2024'),
(7, '45', '2023-11-25T13:06', '2024-04-05T13:03'),
(9, '47', '12', '13');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `activation_code` varchar(50) DEFAULT NULL,
  `is_activated` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `username`, `email`, `telephone`, `password`, `creationdate`, `activation_code`, `is_activated`) VALUES
(1, 'kwizera', 'ange', 'ange', 'kwizera@gmail.com', '0781525425', '$2y$10$Ywtv4YtQ1oxHcASrR8bc1eTybh9/f8cn1plzz3A18m./tRNy2kjxS', '2024-04-10 18:39:05', '222', 0),
(4, 'mugisha', 'ange', 'mugisha', 'mugisha@gmail.com', '0781525425', '$2y$10$7i1xh0s/KfXFJ1ysFmi.suDrxhmbZYd1QRNXcKs0lpsQ4QvfF2b52', '2024-04-10 18:42:50', '2222', 0),
(11, 'regis', 'alex', 'regrebc', 'alexregs@gmail.com', '0799855666', '$2y$10$qk1o6EyPSQV2Hyb8y4QBgut9dvVTd5jVWLWMA8afgVmkA9TZxzzfa', '2024-04-10 18:57:30', '222', 0),
(12, 'nepo', 'iradu', 'iraduknd', 'nepoirad@gmail.com', '073299887', '$2y$10$xqM1i0Nh0XbAdeAfWTHQPujDBOEu4RUNJ661EOaF0GZ7DTbKwvpKK', '2024-04-10 19:00:03', '55555', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`payroll_id`);

--
-- Indexes for table `tax`
--
ALTER TABLE `tax`
  ADD PRIMARY KEY (`tax_id`);

--
-- Indexes for table `timetracking`
--
ALTER TABLE `timetracking`
  ADD PRIMARY KEY (`time_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `payroll`
--
ALTER TABLE `payroll`
  MODIFY `payroll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tax`
--
ALTER TABLE `tax`
  MODIFY `tax_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `timetracking`
--
ALTER TABLE `timetracking`
  MODIFY `time_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
