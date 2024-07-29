-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2023 at 11:33 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `advance_booking_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `booked_vehicles`
--

CREATE TABLE `booked_vehicles` (
  `S_no` int(11) NOT NULL,
  `user_id` int(5) DEFAULT NULL,
  `vehicle_id` varchar(10) DEFAULT NULL,
  `rental_date` datetime(2) DEFAULT NULL,
  `recovery_date` datetime(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment_details`
--

CREATE TABLE `payment_details` (
  `S_no` int(11) NOT NULL,
  `user_id` tinyint(5) DEFAULT NULL,
  `vehicle_id` varchar(10) DEFAULT NULL,
  `total_amount` float NOT NULL,
  `penalty` float DEFAULT NULL,
  `total_payable` float DEFAULT NULL,
  `payment_status` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_info`
--

CREATE TABLE `vehicle_info` (
  `S_no` int(11) NOT NULL,
  `vehicle_id` varchar(10) DEFAULT NULL,
  `vehicle_name` varchar(20) DEFAULT NULL,
  `cost_hr` int(11) DEFAULT NULL,
  `cost_day` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehicle_info`
--

INSERT INTO `vehicle_info` (`S_no`, `vehicle_id`, `vehicle_name`, `cost_hr`, `cost_day`) VALUES
(1, 'TW1', 'Duke 200', 249, 2499),
(2, 'FW1', 'Skoda f-20', 509, 5599),
(3, 'TW2', 'Enfield i3s', 199, 1499),
(4, 'TW3', 'Avenger z-max', 299, 6499),
(5, 'TW4', 'Java X-mas', 159, 1399),
(6, 'FW2', 'Suzuki sz', 699, 4999),
(7, 'FW3', 'Kia  3S0', 999, 9999),
(8, 'TW5', 'Crux max', 249, 4499),
(9, 'FW4', 'Thar 4X', 1499, 7599),
(14, 'TW6', 'Avenger TVS raider', 219, 1599),
(15, 'TW7', 'Hero Splender', 169, 999),
(16, 'TW8', 'Apache RTR', 219, 1999),
(17, 'TW9', 'Activa 5G', 499, 1799),
(18, 'TW10', 'Activa 5G', 299, 1799),
(19, 'TW11', 'Yamaha R15', 399, 1899),
(20, 'TW12', 'TVS Ronin', 219, 1099),
(21, 'TW13', 'Bajaj Pulsor', 159, 1699),
(22, 'FW5', 'SANTRO', 259, 2699),
(23, 'FW6', 'Grand ino NiOs', 419, 2599),
(24, 'FW7', 'AURA', 369, 3999),
(25, 'FW8', 'X-Cent', 319, 2599),
(26, 'FW9', 'creta', 499, 4019),
(27, 'FW10', 'VENUE', 309, 2799),
(28, 'FW11', 'MARUTi BALENO', 499, 2899),
(29, 'FW12', 'Fortuner', 619, 6099);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booked_vehicles`
--
ALTER TABLE `booked_vehicles`
  ADD PRIMARY KEY (`S_no`);

--
-- Indexes for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`S_no`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `vehicle_id` (`vehicle_id`);

--
-- Indexes for table `vehicle_info`
--
ALTER TABLE `vehicle_info`
  ADD PRIMARY KEY (`S_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booked_vehicles`
--
ALTER TABLE `booked_vehicles`
  MODIFY `S_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `S_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `vehicle_info`
--
ALTER TABLE `vehicle_info`
  MODIFY `S_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
