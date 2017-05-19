-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2017 at 06:54 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vithai`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(10) UNSIGNED NOT NULL,
  `admin` varchar(50) NOT NULL,
  `logo` varchar(50) NOT NULL,
  `email` varchar(120) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `marketing_documents` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `admin`, `logo`, `email`, `phone`, `marketing_documents`) VALUES
(1, 'Sridhar', 'logo2.jpg', 'sri@pluskb.com', '808080890', 'marketing1.zip');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(10) UNSIGNED NOT NULL,
  `lat` varchar(50) NOT NULL DEFAULT '0',
  `lng` varchar(50) NOT NULL DEFAULT '0',
  `mapimage` varchar(50) NOT NULL DEFAULT 'default.jpg',
  `name` varchar(50) DEFAULT NULL,
  `details` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `lat`, `lng`, `mapimage`, `name`, `details`) VALUES
(1, '34.025638', '-117.945146', 'map1.jpg', 'Event 1', '<Strong> Date: </strong> 02-02-2018 <br>\nLorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus.'),
(2, '34.027743', ' -117.945722', 'map2.png', 'Event 2', '<Strong> Date: </strong> 07-07-2018 <br>\nLorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus.'),
(3, '34.029465', '-117.946362', 'map3.jpg', 'Event 3', '<Strong> Date: </strong> 03-03-2018 <br>\nLorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus.');

-- --------------------------------------------------------

--
-- Table structure for table `stands`
--

CREATE TABLE `stands` (
  `id` int(10) UNSIGNED NOT NULL,
  `location_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `price` decimal(10,0) UNSIGNED NOT NULL DEFAULT '0',
  `image` varchar(50) DEFAULT NULL,
  `booking_status` varchar(20) NOT NULL DEFAULT 'Free',
  `booked_by` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `position` varchar(50) NOT NULL DEFAULT '0,0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stands`
--

INSERT INTO `stands` (`id`, `location_id`, `name`, `price`, `image`, `booking_status`, `booked_by`, `position`) VALUES
(1, 1, 'Stand1', '23', 'stand1.jpg', 'Booked', 1, '475,180'),
(2, 1, 'Stand2', '24', 'stand2.jpg', 'Free', 22, '620,160'),
(3, 1, 'Stand3', '100', 'stand3.jpg', 'Free', 15, '250,520'),
(4, 1, 'Stand4', '80', 'stand4.jpg', 'Free', 21, '800,420'),
(5, 2, 'Stand1', '23', 'stand1.jpg', 'Free', 10, '475,180'),
(6, 2, 'Stand2', '24', 'stand2.jpg', 'Free', 11, '620,160'),
(7, 2, 'Stand3', '100', 'stand3.jpg', 'Free', 12, '250,520'),
(8, 2, 'Stand4', '80', 'stand4.jpg', 'Free', 13, '800,420'),
(9, 3, 'Stand1', '23', 'stand1.jpg', 'Free', 10, '475,180'),
(10, 3, 'Stand2', '24', 'stand2.jpg', 'Free', 11, '620,160'),
(11, 3, 'Stand3', '100', 'stand3.jpg', 'Free', 19, '250,520'),
(12, 3, 'Stand4', '80', 'stand4.jpg', 'Free', 16, '800,420');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stands`
--
ALTER TABLE `stands`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `stands`
--
ALTER TABLE `stands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
