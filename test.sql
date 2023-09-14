-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2023 at 10:29 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customerId` int(11) NOT NULL,
  `customerName` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customerId`, `customerName`, `address`, `email`, `phone`) VALUES
(90, 'dhanush', 'erode', 'dhanush36@gmail.com', '9940716269'),
(91, 'vidhya', 'tirupur', 'vidhya@gmai.com', '987654323'),
(93, 'vinayaga', 'nala road', 'vinayaga@gmail.com', '9876543210'),
(94, 'ssvinayaga', 'kanagayam', 'ssvinayaga@gmail.com', '8970652351');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `SID` int(11) NOT NULL,
  `INVOICE_NO` int(11) NOT NULL,
  `INVOICE_DATE` date NOT NULL,
  `CNAME` varchar(50) NOT NULL,
  `CADDRESS` varchar(150) NOT NULL,
  `CCITY` varchar(50) NOT NULL,
  `PNAME` varchar(100) NOT NULL,
  `GRAND_TOTAL` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`SID`, `INVOICE_NO`, `INVOICE_DATE`, `CNAME`, `CADDRESS`, `CCITY`, `PNAME`, `GRAND_TOTAL`) VALUES
(1, 50, '2023-09-01', 'ssvinayaga', 'sivanmalai', 'kangayam', '1 1/2 jalli', 6750.00),
(2, 51, '2023-09-01', 'vinayaga', 'olapalayam', 'kanagayam', 'powder', 3800.00),
(3, 52, '2023-09-02', 'amman', 'kangayam nala road', 'kanagayam', 'chips', 7500.00),
(4, 53, '2023-09-02', 'dhanush', 'uthukuli', 'thirupur', '3/4 jalli', 3800.00),
(5, 54, '2023-09-02', 'akli', 'tirupur road', 'kangayam', 'chips', 4000.00),
(6, 56, '2023-09-03', 'shakthi', 'chennimalai', 'erode', '1 1/2 jalli', 5400.00),
(9, 55, '2023-09-04', 'siva bule metals', 'olapalayam', 'kangayam', '3/4 jalli', 11400.00),
(10, 57, '2023-09-05', 'sabari bule metals ', 'padiyur', 'tirupur', 'powder,1 1/2', 11100.00);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_products`
--

CREATE TABLE `invoice_products` (
  `ID` int(11) NOT NULL,
  `SID` int(11) NOT NULL,
  `PNAME` varchar(100) NOT NULL,
  `PRICE` double(10,2) NOT NULL,
  `QTY` int(11) NOT NULL,
  `TOTAL` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `invoice_products`
--

INSERT INTO `invoice_products` (`ID`, `SID`, `PNAME`, `PRICE`, `QTY`, `TOTAL`) VALUES
(1, 1, 'pro 1', 1500.00, 1, 1500.00),
(2, 2, 'pro1', 1200.00, 1, 1200.00),
(3, 3, 'jalli', 1800.00, 4, 6750.00),
(4, 4, '1 1/2 jalli', 1800.00, 4, 6750.00),
(5, 1, '1 1/2 jalli', 1800.00, 4, 6750.00),
(6, 2, 'powder', 1900.00, 2, 3800.00),
(7, 3, 'chips jalli', 2000.00, 4, 7500.00),
(8, 4, '3/4 jalli', 1900.00, 2, 3800.00),
(9, 5, 'power', 2000.00, 2, 4000.00),
(10, 7, '1 1/2 jalli', 1800.00, 3, 5400.00),
(11, 8, '3/4', 1900.00, 6, 11400.00),
(12, 9, '3/4 jalli', 1900.00, 6, 11400.00),
(13, 10, 'powder', 1900.00, 3, 5700.00),
(14, 10, '1 1/2', 1800.00, 3, 5400.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_price`) VALUES
(24, '1 1/2 jalli', 1800.00),
(25, '3/4 jalli', 1900.00),
(27, 'chips jalli', 2000.00),
(29, 'powder', 1900.00);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `supplier_address` varchar(255) NOT NULL,
  `supplier_phoneno` varchar(10) NOT NULL,
  `supplier_productname` varchar(255) NOT NULL,
  `product_price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `supplier_address`, `supplier_phoneno`, `supplier_productname`, `product_price`) VALUES
(1, 'dhanush', 'erode', '8907162551', 'desial', 900),
(2, 'shakthie raw stone', 'kangayam', '9865266188', 'rawstone', 150000),
(3, 'hp bunk', 'tirupur roade', '9940716266', 'desial', 200000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(40) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`) VALUES
('admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customerId`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`SID`);

--
-- Indexes for table `invoice_products`
--
ALTER TABLE `invoice_products`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `SID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `invoice_products`
--
ALTER TABLE `invoice_products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
