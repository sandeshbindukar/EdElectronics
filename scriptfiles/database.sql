-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2019 at 03:10 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webassignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_categories`
--

CREATE TABLE `tb_categories` (
  `category_id` int(8) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_categories`
--

INSERT INTO `tb_categories` (`category_id`, `category_name`) VALUES
(1, 'TVs'),
(2, 'Computers'),
(3, 'Phones'),
(4, 'Gamings'),
(5, 'Cameras');

-- --------------------------------------------------------

--
-- Table structure for table `tb_products`
--

CREATE TABLE `tb_products` (
  `product_code` int(8) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_details` text NOT NULL,
  `product_manufacturer` text NOT NULL,
  `product_price` double(10,2) NOT NULL,
  `product_image` text NOT NULL,
  `category_id` int(8) NOT NULL,
  `featured` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_products`
--

INSERT INTO `tb_products` (`product_code`, `product_name`, `product_details`, `product_manufacturer`, `product_price`, `product_image`, `category_id`, `featured`) VALUES
(1001, '  LG-UK6300  ', '    LG 43\" UK6300 4K UHD Smart Television    ', '  LG  ', 50000.00, 'lg.jpg', 1, 1),
(2001, 'MSI-23338P', 'MSI - 15.6\" Laptop - Intel Core i7 - 16GB Memory - NVIDIA GeForce GTX', 'MSI', 122580.00, 'msi.jpg', 2, 0),
(3001, ' Iphone X ', ' Apple iPhone X smartphone. Announced Sep 2017. Features 5.8â€³ Super AMOLED display, Apple A11 Bionic chipset ', 'APPLE', 123000.00, 'iPhoneX-Svr.png', 3, 0),
(4000, 'PlayStation 4 ', 'Single-chip custom processor\r\n\r\nCPU : x86-64 AMD â€œJaguarâ€, 8 cores\r\n\r\nGPU : 1.84 TFLOPS, AMD Radeonâ„¢ based graphics engine', ' Sony Interactive Entertainment', 20000.00, 'ps4.jpg', 4, 0),
(5001, ' Nikon D5600 ', ' Nikon D5600 DSLR Camera with 18-140mm Lens B&H # NID560018140 MFR # 1577 ', ' NIKON ', 150000.00, 'nikon.jpg', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_reviews`
--

CREATE TABLE `tb_reviews` (
  `review_id` int(8) NOT NULL,
  `product_code` int(8) NOT NULL,
  `author` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_reviews`
--

INSERT INTO `tb_reviews` (`review_id`, `product_code`, `author`, `content`, `date`) VALUES
(10, 5001, 'Sandesh Bindukar', 'This product is great!', '2019-01-08 21:07:29'),
(11, 3001, 'Ram Shrestha', 'NICE NICE NICE NICE NICE NICE NICE', '2019-01-08 21:17:44'),
(12, 1001, 'Hari Bahadur Karki', 'Amazing TV  Amazing TV Amazing TV Amazing TV Amazing TV Amazing TV ', '2019-01-08 21:20:52'),
(13, 3001, 'Bipin GC', 'wtf', '2019-01-10 16:39:21'),
(14, 2001, 'Harry Snow', 'Best Gaming Laptop\r\n', '2019-01-12 13:55:43'),
(15, 4000, 'Bishal Magar', 'Cool\r\n', '2019-01-12 13:56:51');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user_details`
--

CREATE TABLE `tb_user_details` (
  `user_id` int(8) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile_number` int(10) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user_details`
--

INSERT INTO `tb_user_details` (`user_id`, `user_type`, `name`, `surname`, `gender`, `email`, `username`, `password`, `mobile_number`, `address`) VALUES
(1, 'admin', 'Sandesh', 'Bindukar', '', 'sandeshbindukar@gmail.com', 'sandeshbindukar', '$2y$10$HyfiMbCjYGhEKA.GcSTDI.FefcB9ZQsF4OVJ8jVGUso/0Om1e8Fa2', 2147483647, 'Sinamangal'),
(2, 'user', 'Max', 'White', '', 'max@gmail.com', 'max123', '$2y$10$dUgbNnqVjpz.XoODDjfgE.vEsnrrYvxlHCJmApCcxqE.TkRSj9cRK', 123456789, 'USA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_categories`
--
ALTER TABLE `tb_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tb_products`
--
ALTER TABLE `tb_products`
  ADD PRIMARY KEY (`product_code`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `tb_reviews`
--
ALTER TABLE `tb_reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `product_code` (`product_code`);

--
-- Indexes for table `tb_user_details`
--
ALTER TABLE `tb_user_details`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_categories`
--
ALTER TABLE `tb_categories`
  MODIFY `category_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_products`
--
ALTER TABLE `tb_products`
  MODIFY `product_code` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5002;

--
-- AUTO_INCREMENT for table `tb_reviews`
--
ALTER TABLE `tb_reviews`
  MODIFY `review_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_user_details`
--
ALTER TABLE `tb_user_details`
  MODIFY `user_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_products`
--
ALTER TABLE `tb_products`
  ADD CONSTRAINT `fk_cat` FOREIGN KEY (`category_id`) REFERENCES `tb_categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_reviews`
--
ALTER TABLE `tb_reviews`
  ADD CONSTRAINT `ck_review` FOREIGN KEY (`product_code`) REFERENCES `tb_products` (`product_code`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
