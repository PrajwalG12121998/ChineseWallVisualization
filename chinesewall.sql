-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 08, 2020 at 06:44 PM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chinesewall`
--

-- --------------------------------------------------------

--
-- Table structure for table `consultants`
--

DROP TABLE IF EXISTS `consultants`;
CREATE TABLE IF NOT EXISTS `consultants` (
  `ID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `DOJ` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `consultants`
--

INSERT INTO `consultants` (`ID`, `Name`, `DOJ`) VALUES
(12345, 'Nikunj Prasad', '2020-06-08'),
(12, 'xyz', '1999-08-07'),
(11, 'abc', '2000-06-08'),
(16, 'qwe', '2020-06-01'),
(17, 'tyu', '2007-08-09'),
(18, 'iop', '2006-03-11');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `client_number` int(11) NOT NULL AUTO_INCREMENT,
  `client_name` varchar(45) DEFAULT NULL,
  `client_domain` varchar(45) DEFAULT NULL,
  `project_name` varchar(45) DEFAULT NULL,
  `priority_level` int(11) DEFAULT NULL,
  `client_resource` longtext,
  `project_startDate` date DEFAULT NULL,
  `AssignedTo` text,
  `end_date` date DEFAULT NULL,
  `Competitors` text,
  PRIMARY KEY (`client_number`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`client_number`, `client_name`, `client_domain`, `project_name`, `priority_level`, `client_resource`, `project_startDate`, `AssignedTo`, `end_date`, `Competitors`) VALUES
(1, 'Amazon', 'onlineShopping', 'ABC', 9, NULL, '2020-06-08', '12345', NULL, 'Flipkart,BookStore'),
(2, 'Zomato', 'onlineFoodDelivery', 'XYZ', 5, NULL, '2020-06-08', NULL, NULL, 'Swiggy,UberEats'),
(3, 'Swiggy', 'onlineFoodDelivery', 'abc', 2, NULL, '2018-11-08', '11', '2019-11-08', NULL),
(4, 'UberEats', 'onlineFoodDelivery', 'abc', 6, NULL, '2019-01-03', '12', '2020-01-03', NULL),
(5, 'Microsoft', 'computerServices', 'abc', 8, NULL, '2018-07-06', NULL, '2020-01-01', NULL),
(6, 'Indigo', 'airlines', 'abc', 7, NULL, '2018-09-07', NULL, '2019-01-01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `idUsers` int(11) NOT NULL,
  `id` varchar(45) DEFAULT NULL,
  `user_password` varchar(45) DEFAULT NULL,
  `user_type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idUsers`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idUsers`, `id`, `user_password`, `user_type`) VALUES
(1, 'admin@gmail.com', 'admin', 'admin');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
