-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Dec 05, 2016 at 12:40 AM
-- Server version: 5.5.49-log
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `orderdetails`
--

CREATE TABLE IF NOT EXISTS `orderdetails` (
  `orderid` int(11) NOT NULL,
  `partid` int(11) NOT NULL,
  `partname` varchar(60) NOT NULL,
  `number` int(11) NOT NULL,
  `totalprice` float NOT NULL,
  `inventory` int(11) NOT NULL,
  `ordertime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`orderid`, `partid`, `partname`, `number`, `totalprice`, `inventory`, `ordertime`) VALUES
(6895, 5, 'Honda Oil', 1, 17.87, 149, '2016-12-05 00:28:17'),
(7357, 13, 'Tie Rod End Boot', 20, 236.6, -2, '2016-12-05 00:03:00');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `userid` int(11) NOT NULL,
  `orderid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`userid`, `orderid`) VALUES
(4, 6895),
(4, 7357);

-- --------------------------------------------------------

--
-- Table structure for table `parts`
--

CREATE TABLE IF NOT EXISTS `parts` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `position` varchar(45) NOT NULL,
  `type` varchar(45) NOT NULL,
  `price` double NOT NULL,
  `inventory` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parts`
--

INSERT INTO `parts` (`id`, `name`, `position`, `type`, `price`, `inventory`) VALUES
(3, 'Fog Light No2', 'Wheel', 'Toyota', 149.99, 0),
(5, 'Honda Oil', 'Machine Oil', 'Honda', 17.87, 149),
(6, '17-inch Wheel', 'Wheel', 'Toyota', 164.7, 99),
(7, '19 inch trim', 'Wheel', 'Toyota', 289.99, 60),
(8, 'Rock Crawler 51', 'Wheel', 'Toyota', 55.99, 50),
(9, 'Air Sensor Adapter', 'Inner Part', 'Toyota', 29.36, 88),
(13, 'Tie Rod End Boot', 'Inner Parts', 'Toyota', 11.83, -2),
(17, 'Leather Seat Cover', 'Inner Parts', 'Toyota', 25.23, 89),
(18, 'Valve Iron', 'Wheel', 'Toyota', 7.11, 100),
(19, 'Fender', 'Machine Oil', 'Honda', 111.98, 100),
(20, 'Brake Disc', 'Wheel', 'Honda', 77.42, 100),
(21, 'Temperature Sensor', 'Inner Parts', 'Honda', 20.31, 100),
(22, 'Fog Light ', 'Light', 'Honda', 34.68, 93),
(23, 'Hood  Handle', 'Wheel', 'Toyota', 24.57, 100),
(24, 'Hood Bumper', 'Machine Oil', 'Ford', 14.33, 100),
(25, 'Wheels Spacer', 'Wheel', 'Ford', 20.37, 100),
(26, 'Tailgate Handle', 'Inner Parts', 'Ford', 66.37, 100),
(27, 'Proforged  Parts', 'Light', 'Toyota', 35.17, 100),
(28, 'Battery ', 'Inner Parts', 'AUDI', 192.7, 100),
(29, 'Cylinder Cover', 'Machine Oil', 'AUDI', 20.7, 100),
(30, 'oils', 'Wheel', 'Toyota', 39.99, 600),
(31, 'wad', 'Wheel', 'Toyota', 123, 156),
(32, '5864', 'Wheel', 'Toyota', 415, -2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `rank` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `rank`) VALUES
(1, 'admin@admin', 'admin', 2),
(4, '1234@gmail.com', 'Password123', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`orderid`,`partname`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderid`);

--
-- Indexes for table `parts`
--
ALTER TABLE `parts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `parts`
--
ALTER TABLE `parts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
