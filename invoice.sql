-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2023 at 11:48 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invoice`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `c_id` int(100) NOT NULL,
  `c_name` varchar(255) NOT NULL,
  `c_address` varchar(255) NOT NULL,
  `c_phone` varchar(20) NOT NULL,
  `added_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`c_id`, `c_name`, `c_address`, `c_phone`, `added_time`) VALUES
(1, 'Xenos Davenport', 'Veniam distinctio ', '+1 (968) 886-6334', '2023-04-30 00:00:00'),
(2, 'Claire Kaufman', 'Fugiat odio culpa ', '+1 (447) 371-9137', '2023-04-30 15:04:45'),
(4, 'Doris Gilliam', 'Dolor reiciendis odi', '+1 (932) 815-7093', '2023-04-30 15:05:46'),
(5, 'Oprah Walker', 'Dolor qui vel ut nis', '+1 (356) 759-5898', '2023-04-30 15:09:28'),
(6, 'Rina Keller', 'Consequatur consecte', '+1 (955) 681-3192', '2023-04-30 15:10:34'),
(7, 'Quentin Sanders', 'Quidem velit est odi', '+1 (368) 651-1938', '2023-04-30 15:12:10'),
(8, 'Atiqur Rahman', 'Gazipur', '01830445326', '2023-05-02 09:10:58'),
(9, 'lily', 'dhaka', '01730429046', '2023-05-03 15:27:04'),
(10, 'ashil', 'tangail', '01910566722', '2023-05-03 17:31:46');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(100) NOT NULL,
  `c_id` int(255) NOT NULL,
  `item_id` int(255) NOT NULL,
  `product_qty` int(255) NOT NULL,
  `total` int(255) NOT NULL,
  `invoice_code` varchar(255) NOT NULL,
  `creation_time` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `c_id`, `item_id`, `product_qty`, `total`, `invoice_code`, `creation_time`) VALUES
(85, 10, 5, 2, 1100, '8520', '2023-05-03'),
(86, 10, 1, 2, 440, '8520', '2023-05-03'),
(87, 8, 1, 43, 9460, '122222', '2023-05-03'),
(88, 8, 5, 2, 1100, '122222', '2023-05-03'),
(89, 8, 1, 1, 220, '122222', '2023-05-03'),
(90, 2, 1, 1, 220, '123132131', '2023-05-11'),
(91, 2, 3, 2, 1400, '123132131', '2023-05-11');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(100) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_des` text NOT NULL,
  `price` varchar(100) NOT NULL,
  `qty` int(100) NOT NULL,
  `item_added_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `item_des`, `price`, `qty`, `item_added_time`) VALUES
(1, 'mouse', 'usb mouse', '220', 5, '2023-04-30 15:24:22'),
(2, 'pc', 'Walton', '2000', 10, '2023-04-30 17:33:54'),
(3, 'keyboard', 'RGB and usb keyboard', '700', 10, '2023-05-02 09:11:38'),
(4, 'laptop', 'KARONDA core i7 ', '150000', 10, '2023-05-03 15:27:56'),
(5, 'earphone', 'nick band', '550', 100, '2023-05-03 17:32:10');

-- --------------------------------------------------------

--
-- Table structure for table `total_amount_table`
--

CREATE TABLE `total_amount_table` (
  `id` int(100) NOT NULL,
  `c_id` int(100) NOT NULL,
  `invoice_code` int(11) NOT NULL,
  `Total_price` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `total_amount_table`
--

INSERT INTO `total_amount_table` (`id`, `c_id`, `invoice_code`, `Total_price`, `created_at`) VALUES
(13, 10, 8520, 1540, '2023-05-03 17:32:32'),
(14, 8, 122222, 10780, '2023-05-03 17:40:28'),
(15, 2, 123132131, 1620, '2023-05-11 15:50:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `total_amount_table`
--
ALTER TABLE `total_amount_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `c_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `total_amount_table`
--
ALTER TABLE `total_amount_table`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
