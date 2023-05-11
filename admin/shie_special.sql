-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2023 at 09:44 AM
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
-- Database: `shie_special`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `category_name` varchar(20) NOT NULL,
  `category_description` text NOT NULL,
  `cat_stats` char(1) NOT NULL DEFAULT 'A' COMMENT 'A=Active/\r\nI=Inactive',
  `cat_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `category_name`, `category_description`, `cat_stats`, `cat_file`) VALUES
(1, 'Classic regular', 'Noodles mixed with the traditional shrimp sauce and tinapa flakes.', 'A', 'p.png'),
(2, 'Overload special', 'Loaded with greater/extra default toppings and variety of seafoods.', 'A', 'p.png');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(11) NOT NULL,
  `item_name` text NOT NULL,
  `item_file` varchar(255) NOT NULL,
  `item_stats` char(1) NOT NULL DEFAULT 'A' COMMENT 'A=Active/\r\nI=Inactive',
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `item_name`, `item_file`, `item_stats`, `date_added`) VALUES
(1, 'Pancit Malabon', '', 'A', '2023-04-12 11:12:34');

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `price_id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `item_price` int(11) DEFAULT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `size_id` int(200) NOT NULL,
  `last_update_ts` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `price`
--

INSERT INTO `price` (`price_id`, `item_id`, `item_price`, `cat_id`, `size_id`, `last_update_ts`, `date_added`, `start_date`, `end_date`) VALUES
(1, 1, 100, 1, 6, '2023-05-11 07:40:32', '2023-03-21 02:10:04', '2023-05-11', '2023-04-21'),
(2, 1, 200, 1, 7, '2023-05-11 07:40:32', '2023-05-11 07:40:32', '2023-03-21', '2023-04-21'),
(3, 1, 300, 1, 8, '2023-05-11 07:40:32', '2023-05-10 16:00:00', '2023-03-21', '2023-04-21'),
(4, 1, 150, 2, 9, '2023-05-11 07:40:32', '2023-05-10 16:00:00', '2023-03-21', '2023-04-21'),
(5, 1, 300, 2, 10, '2023-05-11 07:40:32', '2023-05-11 07:40:32', '2023-03-21', '2023-04-21'),
(6, 1, 450, 2, 11, '2023-05-11 07:40:32', '2023-05-10 16:00:00', '2023-03-21', '2023-04-21');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `reservation_id` int(11) NOT NULL,
  `order_ref_number` int(200) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_ordered` date NOT NULL,
  `pickup_date` date NOT NULL,
  `order_status` varchar(1) NOT NULL DEFAULT 'P' COMMENT 'P = Pending / R = Received',
  `item_quantity` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `cat_id` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `size_id` int(11) NOT NULL,
  `size` varchar(10) NOT NULL,
  `price_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`size_id`, `size`, `price_id`, `cat_id`) VALUES
(6, 'Small-C', 1, 1),
(7, 'Medium-C', 2, 1),
(8, 'Large-C', 3, 1),
(9, 'Small-O', 4, 2),
(10, 'Medium-O', 5, 2),
(11, 'Large-O', 6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `contact_num` varchar(15) NOT NULL,
  `email_add` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `user_type` varchar(1) NOT NULL DEFAULT 'C' COMMENT 'C = Customer / \r\nA = Admin',
  `user_stats` varchar(1) NOT NULL DEFAULT 'A' COMMENT 'A = Active /\r\nI = Inactive',
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`price_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`size_id`),
  ADD KEY `price_id` (`price_id`,`cat_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `price`
--
ALTER TABLE `price`
  MODIFY `price_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
