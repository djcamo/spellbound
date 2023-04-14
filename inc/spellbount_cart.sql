-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 30, 2023 at 10:31 AM
-- Server version: 5.7.26
-- PHP Version: 7.3.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spellbount_cart`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `user_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`cart_id`,`product_id`),
  KEY `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `category_description` varchar(255) NOT NULL,
  `category_image` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `active` char(1) NOT NULL,
  `created` timestamp NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_description`, `category_image`, `url`, `active`, `created`, `modified`) VALUES
(1, 'Incense', 'Incense sticks, cones and accessories', 'incense.jpg', 'incense.php', '1', '2023-01-17 13:30:00', '0000-00-00 00:00:00'),
(2, 'Aromatherapy', '', 'essential-oils.jpg', 'aromatherapy.php', '1', '2023-01-17 13:30:00', '0000-00-00 00:00:00'),
(3, 'Meditation', '', 'buddhist.jpg', 'meditation.php', '1', '2023-01-17 13:30:00', '0000-00-00 00:00:00'),
(4, 'Herbs', '', 'herbs.jpg', 'herbs.php', '1', '2023-01-17 13:30:00', '0000-00-00 00:00:00'),
(5, 'Altar Tools', '', 'tools.jpg', 'alter-tools.php', '1', '2023-01-17 13:30:00', '0000-00-00 00:00:00'),
(6, 'Tarot/Oracle', '', 'tarot-oracle.jpg', 'tarot-oracle.php', '1', '2023-01-17 13:30:00', '0000-00-00 00:00:00'),
(7, 'Books', '', 'books-cds.jpg', 'books.php', '1', '2023-01-17 13:30:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `user_name`, `user_email`) VALUES
(1, 2, 'john', 'john@john.com');

-- --------------------------------------------------------

--
-- Table structure for table `orders_history`
--

DROP TABLE IF EXISTS `orders_history`;
CREATE TABLE IF NOT EXISTS `orders_history` (
  `order_id` int(11) NOT NULL,
  `history_time` date NOT NULL,
  `history_status` varchar(255) NOT NULL,
  `history_notes` varchar(255) NOT NULL,
  PRIMARY KEY (`order_id`,`history_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders_history`
--

INSERT INTO `orders_history` (`order_id`, `history_time`, `history_status`, `history_notes`) VALUES
(1, '2023-01-18', 'active', 'notes');

-- --------------------------------------------------------

--
-- Table structure for table `orders_totals`
--

DROP TABLE IF EXISTS `orders_totals`;
CREATE TABLE IF NOT EXISTS `orders_totals` (
  `total_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `total_name` varchar(255) NOT NULL,
  `total_amount` decimal(10,0) NOT NULL,
  PRIMARY KEY (`total_id`),
  KEY `order` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders_totals`
--

INSERT INTO `orders_totals` (`total_id`, `order_id`, `total_name`, `total_amount`) VALUES
(1, 1, 'for john', '100');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `product_description` text NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `created` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `slug`, `product_description`, `product_price`, `active`, `product_image`, `created`, `modified`) VALUES
(1, 'Nag Champa', 'nag-champa', '', '$4', 1, 'nag.jpg', '2023-03-17 03:44:01', '0000-00-00 00:00:00'),
(2, 'Nag Champa Cones', 'nag-champa-cones', '', '$3', 1, 'nag_cones.jpg', '2023-03-17 03:44:07', '0000-00-00 00:00:00'),
(3, 'White Sage', 'white-sage', '', '$12', 1, 'white-sage.jpg', '2023-03-17 03:43:56', '0000-00-00 00:00:00'),
(4, 'Charcoal', 'charcoal', '', '$8', 1, 'charcoal-1.jpg', '2023-03-17 03:43:51', '0000-00-00 00:00:00'),
(5, 'Gumleaf Essential Oils', 'gumleaf-essential-oils', '    <p>Gumleaf Essentials is one of Australia\'s most reputable brands of essential oils, having been in production since the 1970\'s.</p>\r\n    <p>These essential oils are the finest quality available and have been stringently tested and certified as 100% pure, natural & true to botanical.</p>\r\n<p>Ideal for use in aromatherapy, ultrasonic oil diffusers, oil burners, bath or blended for massage.</p>', 'from $15.00', 1, 'PURE-ESSENTIAL-OILS.jpg', '2023-03-17 03:43:23', '0000-00-00 00:00:00'),
(6, 'Gumleaf Fragrant Oils', 'gumleaf-fragrent-oils', '<p>With over 60 fragrances to choose from including traditional favourites, gourmet delicacies, Australian natives and contemporary new blends.</p>\n<p>Ideal for use in oil burners and <span class=\"d-none d-lg-inline\">ultrasonic oil diffusers</span>.</p>', 'from $15.00', 1, 'gumleaf-fregrant.jpg', '2023-03-17 03:43:44', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

DROP TABLE IF EXISTS `product_categories`;
CREATE TABLE IF NOT EXISTS `product_categories` (
  `product_id` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`categoryId`),
  KEY `category` (`categoryId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`product_id`, `categoryId`) VALUES
(1, 1),
(2, 1),
(5, 2),
(6, 2),
(3, 4),
(4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_role` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_role`, `user_name`, `user_email`, `user_password`) VALUES
(1, 'admin', 'david', 'djcamo66@gmail.com', 'dogstar'),
(2, 'customer', 'john', 'john@john.com', 'password');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders_totals`
--
ALTER TABLE `orders_totals`
  ADD CONSTRAINT `order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD CONSTRAINT `category` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`category_id`),
  ADD CONSTRAINT `product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
