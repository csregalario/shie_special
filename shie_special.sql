-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2023 at 11:51 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

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
  `item_size` varchar(11) NOT NULL,
  `item_file` varchar(255) NOT NULL,
  `item_stats` char(1) NOT NULL DEFAULT 'A' COMMENT 'A=Active/\r\nI=Inactive',
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `price_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `item_name`, `item_size`, `item_file`, `item_stats`, `date_added`, `price_id`, `cat_id`) VALUES
(1, 'Pancit Malabon', 'Small', '', 'A', '2023-04-12 11:12:34', 1, 1),
(2, 'Pancit Malabon', 'Medium', '', 'A', '2023-04-16 04:14:49', 2, 1),
(3, 'Pancit Malabon', 'Large', '', 'A', '2023-04-16 04:21:42', 3, 1),
(4, 'Pancit Malabon', 'Small', '', 'A', '2023-04-16 04:22:49', 4, 2),
(5, 'Pancit Malabon', 'Medium', '', 'A', '2023-04-16 04:22:49', 5, 2),
(6, 'Pancit Malabon', 'Large', '', 'A', '2023-04-16 04:23:19', 6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_ref_number` varchar(255) NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_ordered` date NOT NULL,
  `item_qty` int(11) NOT NULL,
  `order_status` int(11) NOT NULL,
  `last_update_ts` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `price_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_price` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `last_update_ts` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `price`
--

INSERT INTO `price` (`price_id`, `item_id`, `item_price`, `cat_id`, `last_update_ts`, `date_added`) VALUES
(1, 1, 100, 1, '0000-00-00 00:00:00', '2023-03-21 10:10:04'),
(2, 2, 200, 1, '0000-00-00 00:00:00', '2023-03-21 20:02:40'),
(3, 3, 300, 1, '2023-03-04 21:14:18', '2023-03-21 21:14:18'),
(4, 4, 150, 2, '2023-03-04 21:18:10', '2023-03-21 21:18:10'),
(5, 5, 300, 2, '2023-03-04 21:23:51', '2023-03-21 21:23:51'),
(6, 6, 450, 2, '2023-03-04 21:25:16', '2023-03-21 21:25:16');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `reservation_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `delivery_date` date NOT NULL,
  `status` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `private_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `contact_num` varchar(15) NOT NULL,
  `email_add` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `user_type` varchar(1) NOT NULL DEFAULT 'C' COMMENT 'C = Customer / \r\nA = Admin',
  `user_stats` varchar(1) NOT NULL DEFAULT 'A' COMMENT 'A = Active /\r\nI = Inactive',
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `fname`, `lname`, `password`, `private_key`, `contact_num`, `email_add`, `address`, `user_type`, `user_stats`, `date_added`) VALUES
(31, '', 'JayK', 'Montero', '5b68ba110d2a49324e913f1a00315feb1557e87720d23b7880', '58w8M1M003k3c9X8Z', '2147483647', 'jayk@gmail.com', 'Polangui, Albay', 'C', 'A', '2023-04-28 19:12:41'),
(33, '', 'Anri', 'Torealba', 'c4bd42f1aa30b9dafe17f8e4e42463880039bd9e21cd53e42f', '76p4K8M4u9Y8c4z3V', '09123456789', 'anri@gmail.com', 'Polangui, Albay', 'C', 'A', '2023-04-28 19:12:41'),
(34, '', 'Jamaica', 'Lila', '3364f43e9afa075ee3893cdb111e09743edf3d519939ef41ee', '92o0b3W2I8t3P5P9w', '09121389213', 'jamaica12@gmail.com', 'camalig albay', 'C', 'A', '2023-04-30 08:33:25'),
(35, '', 'Juan', 'Luna', 'e90cf5237e9d8008c102805a0acc773aa6b7bfc3bcfa48b241', '27G8q2I4q1H5I2t8P', '09121389213', 'juan@gmail.com', 'ligao, albay', 'C', 'A', '2023-04-30 08:48:31'),
(36, '', 'Jhana', 'Luna', 'c14c21c42369971b08a8d57593942ea6db99df40ce36cd4298', '29X8s5m9G8f6d7O6m', '09121389213', 'jhana@gmail.com', 'ligao, albay', 'C', 'A', '2023-04-30 10:02:02'),
(37, '', 'Jayce', 'Salmon', 'c2e1638684e40923057fb9903cafdcd5eeda615cc997918f7b', '98x3E5k7B9A5X9Z8G', '09109875532', 'jayce@gmail.com', 'Polangui, Albay', 'C', 'A', '2023-04-30 11:01:54'),
(38, 'jona123', 'Jonabie', 'Kapay', 'b841bcd3052f690bac086526cc474bdb77c063435c50e83905', '08B1j8D2a5j9y7j1t', '09121389213', 'jona123@gmail.com', 'Tandarura Ligao', 'C', 'A', '2023-04-30 11:23:21'),
(39, 'apple123', 'James', 'Luna', '77610005ce94eb7e87f1d8a6ddd2de7d3739e3adacdfe6889a', '97j0W4b3V9K6o2c7z', '09121389213', 'james123@gmail.com', 'ligao, albay', 'C', 'A', '2023-04-30 11:31:13'),
(43, 'admin', 'admin', 'admin', 'password', NULL, '09128745261', 'admin@gmail.com', 'Ligao, Albay', 'A', 'A', '2023-04-30 19:22:37');

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
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `price_id` (`price_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`price_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `item_id` (`item_id`);

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
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

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
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`price_id`) REFERENCES `price` (`price_id`),
  ADD CONSTRAINT `item_ibfk_2` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `price`
--
ALTER TABLE `price`
  ADD CONSTRAINT `price_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`),
  ADD CONSTRAINT `price_ibfk_2` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
