-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2014 at 06:51 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `onlinecamerashop`
--

-- --------------------------------------------------------

--
-- Table structure for table `onlinecamerashop_cart`
--

CREATE TABLE IF NOT EXISTS `onlinecamerashop_cart` (
  `user_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`cart_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `onlinecamerashop_categories`
--

CREATE TABLE IF NOT EXISTS `onlinecamerashop_categories` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_name` varchar(100) NOT NULL,
  `c_description` text NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `onlinecamerashop_categories`
--

INSERT INTO `onlinecamerashop_categories` (`c_id`, `c_name`, `c_description`) VALUES
(1, 'Mobile', ''),
(2, 'Cameras', ''),
(3, 'Headphones', ''),
(4, 'Accessories', ''),
(5, 'Laptops', ''),
(6, 'ETC', '');

-- --------------------------------------------------------

--
-- Table structure for table `onlinecamerashop_products`
--

CREATE TABLE IF NOT EXISTS `onlinecamerashop_products` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_id` int(11) NOT NULL,
  `p_name` varchar(90) NOT NULL,
  `p_price` varchar(20) NOT NULL,
  `p_quantity` varchar(100) NOT NULL,
  `p_description` text NOT NULL,
  `color` text NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `onlinecamerashop_products`
--

INSERT INTO `onlinecamerashop_products` (`p_id`, `c_id`, `p_name`, `p_price`, `p_quantity`, `p_description`, `color`, `date_added`) VALUES
(1, 1, 'Camera DSLR', '200', '45', 'camera is awesome', '', '2014-07-22 23:00:00'),
(2, 2, 'Camera DSLR2', '121', '200', 'this is awesome cheap camera', '', '2014-07-23 13:38:45'),
(3, 1, 'Tripod for camera', '200', '200', 'This is description', 'black,white', '2014-07-25 16:16:05');

-- --------------------------------------------------------

--
-- Table structure for table `onlinecamerashop_ratings`
--

CREATE TABLE IF NOT EXISTS `onlinecamerashop_ratings` (
  `rating_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `dateposted` varchar(100) NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`rating_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `onlinecamerashop_users`
--

CREATE TABLE IF NOT EXISTS `onlinecamerashop_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(40) NOT NULL,
  `user_password` varchar(40) NOT NULL,
  `user_email` varchar(40) NOT NULL,
  `email_confirmed` enum('no','yes') NOT NULL,
  `email_confirmation_code` varchar(40) NOT NULL,
  `mobile_no` varchar(12) NOT NULL,
  `mobile_confirmed` enum('no','yes') NOT NULL,
  `mobile_confirmation_code` varchar(4) NOT NULL,
  `user_address` text NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `onlinecamerashop_users`
--

INSERT INTO `onlinecamerashop_users` (`user_id`, `user_name`, `user_password`, `user_email`, `email_confirmed`, `email_confirmation_code`, `mobile_no`, `mobile_confirmed`, `mobile_confirmation_code`, `user_address`) VALUES
(1, 'Yousaf', 'fb3275643d7eb0587b2fff396acf9e01', 'mmesunny@gmail.com', 'yes', '50984f2d93cd975ccf42f90cefc40cd3', '03009602698', 'no', '2616', 'asdasdasd');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
