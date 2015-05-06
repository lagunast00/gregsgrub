-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2015 at 08:55 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gregsgrub`
--
CREATE DATABASE IF NOT EXISTS `gregsgrub` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `gregsgrub`;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `adminID` int(11) NOT NULL AUTO_INCREMENT,
  `nameIDadmin` int(11) NOT NULL,
  `thumbnailURL` varchar(40) NOT NULL DEFAULT 'images/default.jpg',
  `profile` text,
  PRIMARY KEY (`adminID`),
  UNIQUE KEY `nameID` (`nameIDadmin`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`adminID`, `nameIDadmin`, `thumbnailURL`, `profile`) VALUES
(1, 14, 'images/profiles/a34.jpg', 'FAVORITE SPORT: Football GO STEELERS!<br>\r\nFAVORITE PAST-TIME: Baking with mom<br>\r\nFAVORITE NOVEL: DaVinci Code<br>\r\nDREAM VACATON: Laying on the beach in the Carribean'),
(2, 47, 'images/profiles/a67.jpg', 'DREAM VACATION: Egypt<br>\r\nFAVORITE SPORT: Wind Surfing<br>\r\nFAVORITE PAST-TIME: Catching catfish in the streams back home<br>\r\nFAVORITE NOVEL: The Notebook');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `categoryID` int(11) NOT NULL,
  `categoryName` varchar(45) NOT NULL,
  PRIMARY KEY (`categoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryID`, `categoryName`) VALUES
(0, 'Appetizers'),
(1, 'Beverages'),
(2, 'Entrees'),
(3, 'Sandwiches'),
(4, 'Strombolis &amp; More'),
(5, 'Pizzas'),
(6, 'Pastas'),
(7, 'Sides'),
(8, 'Desserts'),
(11, 'Clothing'),
(12, 'Gift Cards'),
(13, 'Accessories');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `commentID` int(11) NOT NULL AUTO_INCREMENT,
  `userIDcomm` int(11) NOT NULL,
  `commentRating` int(11) NOT NULL,
  `commentText` text NOT NULL,
  `postID` int(11) NOT NULL DEFAULT '0',
  `commentDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `approved` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`commentID`),
  KEY `custID_idx` (`userIDcomm`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- RELATIONS FOR TABLE `comments`:
--   `userIDcomm`
--       `users` -> `userID`
--

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentID`, `userIDcomm`, `commentRating`, `commentText`, `postID`, `commentDate`, `approved`) VALUES
(1, 56, 1, 'THis is my first comment', 0, '2015-05-03 05:48:51', 1),
(2, 34, 1, 'Thanks for the comment', 1, '2015-05-03 05:44:36', 1),
(3, 56, 3, 'TESTING', 0, '2015-05-01 07:54:52', 1),
(4, 56, 2, 'Another New COmment', 0, '2015-05-03 05:40:42', 1),
(5, 56, 0, 'Thanks!', 4, '2015-05-01 19:52:50', 1),
(6, 64, 5, 'Amber was so sweet. We will order just again because of her. You truly have a great employee.', 0, '2015-05-03 05:50:01', 1),
(7, 67, 0, 'She is a crucial part of our team! Thanks for taking the time to recognize her!', 6, '2015-05-03 08:49:09', 1);

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE IF NOT EXISTS `coupons` (
  `couponID` int(11) NOT NULL AUTO_INCREMENT,
  `couponCode` varchar(7) NOT NULL,
  `couponValue` int(11) NOT NULL,
  `couponDesc` varchar(40) NOT NULL,
  PRIMARY KEY (`couponID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`couponID`, `couponCode`, `couponValue`, `couponDesc`) VALUES
(1, 'FBGG1', 5, 'Facebook Advertising'),
(2, 'TWGG1', 5, 'Twitter Advertising'),
(3, 'GPGG1', 5, 'Google Plus Advertising');

-- --------------------------------------------------------

--
-- Table structure for table `creditcards`
--

CREATE TABLE IF NOT EXISTS `creditcards` (
  `cardID` int(100) NOT NULL AUTO_INCREMENT,
  `orderIDcredit` int(100) NOT NULL,
  `cardName` varchar(40) NOT NULL,
  `cardType` varchar(20) NOT NULL,
  `cardNumber` varchar(17) NOT NULL,
  `cardCw` int(3) NOT NULL,
  `cardExpires` date NOT NULL,
  `cardChargeAmount` double NOT NULL,
  PRIMARY KEY (`cardID`),
  UNIQUE KEY `orderID` (`orderIDcredit`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- RELATIONS FOR TABLE `creditcards`:
--   `orderIDcredit`
--       `orders` -> `orderID`
--

--
-- Dumping data for table `creditcards`
--

INSERT INTO `creditcards` (`cardID`, `orderIDcredit`, `cardName`, `cardType`, `cardNumber`, `cardCw`, `cardExpires`, `cardChargeAmount`) VALUES
(9, 102, 'Bruce Wayne', 'Visa', '2147483647', 521, '2015-04-28', 84.84),
(10, 106, 'Bruce Wayne', 'Master Card', '2147483647', 521, '2015-04-30', 44.73),
(14, 103, 'Bruce Wayne', 'Master Card', '9876543219876543', 521, '2015-04-29', 60.86);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `customerID` int(11) NOT NULL AUTO_INCREMENT,
  `nameIDcust` int(11) NOT NULL,
  `thumbnailURL` varchar(40) DEFAULT 'images/default.jpg',
  `address1` varchar(45) NOT NULL,
  `address2` varchar(45) DEFAULT NULL,
  `city` varchar(45) NOT NULL,
  `stateCode` char(2) NOT NULL,
  `postalCode` int(11) NOT NULL,
  `daddress1` varchar(45) NOT NULL,
  `daddress2` varchar(45) NOT NULL,
  `dcity` varchar(45) NOT NULL,
  `dstateCode` varchar(2) NOT NULL,
  `dpostalCode` int(11) NOT NULL,
  PRIMARY KEY (`customerID`),
  KEY `stateCode_idx` (`stateCode`),
  KEY `nameIDcust_idx` (`nameIDcust`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- RELATIONS FOR TABLE `customers`:
--   `nameIDcust`
--       `names` -> `nameID`
--   `stateCode`
--       `state` -> `stateCode`
--

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customerID`, `nameIDcust`, `thumbnailURL`, `address1`, `address2`, `city`, `stateCode`, `postalCode`, `daddress1`, `daddress2`, `dcity`, `dstateCode`, `dpostalCode`) VALUES
(20, 40, 'images/profiles/c56.jpg', '3 Up St.', 'Apt. 3', 'Waco', 'DC', 12345, '421 Butterfly Lane', ' ', 'Hermitage', 'PA', 16148),
(22, 42, 'images/profiles/c64.jpg', '123 Main St.', '', 'San Juan', 'LA', 46877, '1155 Charlotte St', 'Apt A', 'Asheville', 'NC', 28801),
(23, 58, 'images/default.jpg', '12 Main St', 'Suite 23', 'Raleigh', 'NC', 28739, '12 Main St', 'Suite 23', 'Raleigh', 'NC', 28739);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
  `employeeID` int(11) NOT NULL AUTO_INCREMENT,
  `nameID` int(11) NOT NULL,
  `jobStatus` varchar(10) NOT NULL,
  `thumbnailURL` varchar(40) NOT NULL DEFAULT 'images/default.jpg',
  `profile` text NOT NULL,
  PRIMARY KEY (`employeeID`),
  KEY `nameID_idx` (`nameID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- RELATIONS FOR TABLE `employees`:
--   `nameID`
--       `names` -> `nameID`
--

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employeeID`, `nameID`, `jobStatus`, `thumbnailURL`, `profile`) VALUES
(4, 10, 'Employed', 'images/profiles/e30.jpg', 'DREAM JOB: Ice Skater <br>\r\nFAVORITE PAST-TIME: Missionary to Haiti<br>\r\nDREAM VACATION: The Alps<br>\r\nFAVORITE SPORT: Ice Skating'),
(5, 15, 'Terminated', 'images/profiles/e38.jpg', 'FAVORITE NOVEL: Slaughter House 5<br>\r\nDREAM JOB: Zoo Keeper<br>\r\nFAVORITE MENU ITEM: Cheese Calzone<br>\r\nFAVORITE SPORT: Baseball'),
(6, 56, 'Employed', 'images/profiles/e76.gif', 'FAVORITE MENU ITEM: Ribeye <br>\r\nDREAM VACATION: Mountain biking in Colorado<br>\r\nFAVORITE SPORT: Rugby<br>\r\nDREAM JOB: Professional Gambler\r\n'),
(7, 59, 'Employed', 'images/profiles/e79.jpg', 'I am a new employee and will have a profile shorty.'),
(8, 60, 'Employed', 'images/profiles/e80.jpg', 'DREAM JOB: Always wanted to be a teacher.<br>\r\nFAVORITE MENU ITEM: Parmesan Chicken<br>\r\nFAVORITE NOVEL: The Giver<br>\r\nFAVORITE SPORT: Soccer');

-- --------------------------------------------------------

--
-- Table structure for table `information`
--

CREATE TABLE IF NOT EXISTS `information` (
  `infoID` int(11) NOT NULL AUTO_INCREMENT,
  `infoName` varchar(45) DEFAULT NULL,
  `infoText` text,
  `infoFAQ` text,
  `infoMainPhotoURL` varchar(155) DEFAULT NULL,
  `infoSmallPhotoURL` varchar(155) DEFAULT NULL,
  PRIMARY KEY (`infoID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `information`
--

INSERT INTO `information` (`infoID`, `infoName`, `infoText`, `infoFAQ`, `infoMainPhotoURL`, `infoSmallPhotoURL`) VALUES
(1, 'mission', 'Greg''s Grub is a locally owned business/restaurant to satisfy your hunger! Known for our speedy service and exceptional locally grown produce, Greg''s Grub strives to make your belly AND wallet full. Giving our customers the option to buy a la carte enables out prices to remain cost efficient and wallet friendly. With our rotating promotions and hot deals, Greg''s Grub is not one to pass up.', 'We are proud to only use local produce!', NULL, NULL),
(3, 'FAQ', 'No. Greg''s Grub is living wage certified, meaning that all employees receive more than minimum wage. This ensures that customers can receive the lowest price possible for all of our products.', 'Is tipping required or included in my subtotal?', NULL, NULL),
(4, 'FAQ', 'Greg''s Grub strives to accommodate its customer''s needs. Customers should not feel restricted when ordering for a large party; however, we do require a minimum of $10 for delivery orders.', 'Is there a maximum capacity for delivery orders?', NULL, NULL),
(6, 'promo', 'We have big changes coming in the weeks to follow. Not only are we adding to our already extensive menu, some southern style dishes, we will soon be available to cater your next celebration or gathering. Feel free to ask us about the coming changes.', 'We will soon be offering catering!', NULL, NULL),
(7, 'FAQ', 'Yes! In order to make your experience top notch, you can request an employee to deliver your order. Don''t forget to mention them in our comment section.', 'Can I request a specific employee for delivery?', NULL, NULL),
(8, 'FAQ', 'To make payment more accessible to our customers, you are now able to pay via credit card or cash after delivery. You can even enter your card information online in just a few easy steps.', 'Are you only allowed to pay cash after delivery or can I pay with a credit card?', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `names`
--

CREATE TABLE IF NOT EXISTS `names` (
  `nameID` int(11) NOT NULL AUTO_INCREMENT,
  `fName` varchar(45) NOT NULL,
  `lName` varchar(45) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`nameID`),
  KEY `userID_idx` (`userID`),
  KEY `fName` (`fName`),
  KEY `lName` (`lName`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

--
-- RELATIONS FOR TABLE `names`:
--   `userID`
--       `users` -> `userID`
--

--
-- Dumping data for table `names`
--

INSERT INTO `names` (`nameID`, `fName`, `lName`, `phone`, `userID`) VALUES
(10, 'Amber', 'Fiscer', '8285556545', 30),
(14, 'Matthew', 'Battyanyi', '828-555-2545', 34),
(15, 'Timothy', 'King', '8285550103', 38),
(40, 'Bruce', 'Wayne', '828-555-2545', 56),
(42, 'Clark', 'Kent', '724-555-6565', 64),
(47, 'Chase', 'Vassen', '828-555-2545', 67),
(56, 'Chandler', 'Bing', '724-555-9856', 76),
(57, '', '', '', 77),
(58, 'Tony', 'Stark', '919-555-7878', 78),
(59, 'Chris', 'Thompson', '8285559898', 79),
(60, 'Louis', 'Black', '828-555-9878', 80);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE IF NOT EXISTS `orderdetails` (
  `orderDetailsID` int(11) NOT NULL AUTO_INCREMENT,
  `orderID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `productQty` int(11) NOT NULL,
  `productTotal` double NOT NULL,
  `productSpecial` varchar(155) DEFAULT NULL,
  `productTemp` tinytext,
  PRIMARY KEY (`orderDetailsID`),
  KEY `orderID_idx` (`orderID`),
  KEY `productID_idx` (`productID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=93 ;

--
-- RELATIONS FOR TABLE `orderdetails`:
--   `orderID`
--       `orders` -> `orderID`
--   `productID`
--       `products` -> `productID`
--

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`orderDetailsID`, `orderID`, `productID`, `productQty`, `productTotal`, `productSpecial`, `productTemp`) VALUES
(63, 102, 13, 1, 13.99, '', ''),
(64, 102, 7, 3, 56.97, 'no seasoning', 'Medium'),
(65, 102, 1, 4, 7.96, '', ''),
(66, 103, 14, 4, 51.96, '', ''),
(67, 104, 22, 3, 26.97, '', ''),
(68, 104, 5, 3, 5.97, '', ''),
(69, 105, 22, 1, 8.99, 'extra cheese', ''),
(70, 105, 6, 1, 5.99, '', ''),
(71, 105, 1, 1, 1.99, '', ''),
(72, 106, 7, 1, 18.99, '', 'Medium'),
(73, 106, 5, 2, 3.98, '', ''),
(74, 106, 13, 1, 13.99, 'no sauce', ''),
(75, 107, 7, 1, 18.99, '', 'Rare'),
(76, 107, 6, 1, 5.99, '', ''),
(77, 108, 4, 1, 5.99, '', ''),
(78, 108, 1, 10, 19.9, '', ''),
(79, 109, 1, 1, 1.99, '', ''),
(81, 110, 4, 1, 5.99, '', ''),
(82, 111, 1, 1, 1.99, '', ''),
(83, 111, 4, 1, 5.99, '', ''),
(84, 112, 4, 1, 5.99, '', ''),
(85, 113, 4, 1, 5.99, '', ''),
(86, 116, 4, 1, 5.99, '', ''),
(87, 113, 6, 1, 5.99, '', ''),
(88, 113, 1, 1, 1.99, '', ''),
(89, 117, 7, 1, 18.99, '', ''),
(90, 118, 13, 1, 13.99, '', ''),
(91, 118, 5, 1, 1.99, '', ''),
(92, 119, 6, 1, 5.99, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `orderID` int(11) NOT NULL AUTO_INCREMENT,
  `orderStartDate` datetime DEFAULT NULL,
  `orderSendDate` datetime DEFAULT NULL,
  `orderCompleteDate` datetime DEFAULT NULL,
  `delivery` char(1) DEFAULT NULL,
  `deliveryComments` varchar(155) NOT NULL DEFAULT 'No Comments',
  `orderSubTotal` double NOT NULL DEFAULT '0',
  `orderTax` double NOT NULL DEFAULT '0',
  `orderDeliveryCharge` double NOT NULL DEFAULT '0',
  `orderTotal` double DEFAULT NULL,
  `couponID` int(11) DEFAULT NULL,
  `paymentID` int(11) DEFAULT NULL,
  `paid` char(1) DEFAULT NULL,
  `employeeID` int(11) DEFAULT NULL,
  `customerID` int(11) DEFAULT NULL,
  `orderStatus` varchar(16) NOT NULL DEFAULT 'Order Sent',
  PRIMARY KEY (`orderID`),
  KEY `customerID_idx` (`customerID`),
  KEY `paymentID_idx` (`paymentID`),
  KEY `employeeID_idx` (`employeeID`),
  KEY `couponID` (`couponID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=120 ;

--
-- RELATIONS FOR TABLE `orders`:
--   `couponID`
--       `coupons` -> `couponID`
--   `customerID`
--       `customers` -> `customerID`
--   `employeeID`
--       `employees` -> `employeeID`
--   `paymentID`
--       `payment` -> `paymentID`
--

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `orderStartDate`, `orderSendDate`, `orderCompleteDate`, `delivery`, `deliveryComments`, `orderSubTotal`, `orderTax`, `orderDeliveryCharge`, `orderTotal`, `couponID`, `paymentID`, `paid`, `employeeID`, `customerID`, `orderStatus`) VALUES
(102, '2015-04-28 15:03:14', '2015-04-28 15:04:30', '2015-04-28 15:15:25', 'N', 'Ring Bell', 78.92, 5.92, 0, 84.84, NULL, 2, 'Y', NULL, 20, 'Order Completed'),
(103, '2015-04-28 15:04:33', '2015-04-28 15:05:44', '2015-04-29 21:36:40', 'Y', 'No Comments', 51.96, 3.9, 5, 60.86, NULL, 2, 'Y', 4, 20, 'Order Completed'),
(104, '2015-04-28 15:06:03', '2015-04-28 15:06:41', '2015-04-28 15:16:41', 'Y', 'No Comments', 32.94, 2.47, 5, 40.41, NULL, 1, NULL, 6, 22, 'Being Delivered'),
(105, '2015-04-28 21:30:46', '2015-04-28 21:39:33', '2015-04-29 00:30:21', 'Y', 'No Comments', 16.97, 1.27, 5, 23.24, NULL, 1, 'Y', 4, 20, 'Order Completed'),
(106, '2015-04-28 21:39:39', '2015-04-28 21:41:06', '2015-04-28 22:06:20', 'Y', 'no silverware', 36.96, 2.77, 5, 44.73, NULL, 2, 'Y', 4, 20, 'Order Completed'),
(107, '2015-04-28 21:53:47', '2015-04-28 21:54:23', '2015-04-29 00:29:49', 'Y', 'Please HURRY!', 24.98, 1.87, 5, 31.85, NULL, 1, 'Y', 4, 22, 'Order Completed'),
(108, '2015-04-29 00:03:16', '2015-04-29 00:03:47', '2015-04-29 00:07:03', 'N', 'No Comments', 25.89, 1.94, 0, 27.83, 2, 1, 'Y', NULL, 22, 'Order Completed'),
(109, '2015-04-29 00:32:46', '2015-04-29 00:33:55', '2015-04-29 12:49:27', 'N', 'No Comments', 3.98, 0.3, 0, 4.28, NULL, 1, 'Y', 4, 20, 'Order Completed'),
(110, '2015-04-29 00:36:49', '2015-04-29 00:37:17', '2015-04-29 18:54:31', 'Y', 'No Comments', 5.99, 0.45, 5, 11.44, NULL, 1, NULL, NULL, 20, 'Being Delivered'),
(111, '2015-04-29 11:24:58', NULL, NULL, NULL, 'No Comments', 7.98, 0.6, 0, 8.58, NULL, NULL, NULL, NULL, 20, 'Order Sent'),
(112, '2015-04-29 12:41:27', '2015-04-29 12:41:57', '2015-04-29 19:13:52', 'Y', 'No Comments', 5.99, 0.45, 5, 11.44, NULL, 1, NULL, 6, 22, 'Being Delivered'),
(113, '2015-04-29 19:41:47', '2015-05-04 17:01:24', '2015-05-04 17:02:04', 'N', '', 13.97, 0.67, 0, 9.64, 1, 1, 'Y', 4, 22, 'Order Completed'),
(114, '2015-04-29 22:02:10', NULL, NULL, NULL, 'No Comments', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 20, 'Order Sent'),
(115, '2015-05-01 01:20:04', NULL, NULL, NULL, 'No Comments', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 20, 'Order Sent'),
(116, '2015-05-04 02:01:20', '2015-05-04 02:01:46', '2015-05-04 02:02:36', 'N', '', 5.99, 0.45, 0, 6.44, NULL, 1, 'Y', 4, 22, 'Order Completed'),
(117, '2015-05-04 17:08:29', '2015-05-04 17:18:37', '2015-05-04 17:21:04', 'Y', '', 18.99, 1.05, 5, 20.04, 1, 1, 'Y', 4, 20, 'Order Completed'),
(118, '2015-05-04 17:19:20', '2015-05-04 17:20:01', '2015-05-04 17:20:42', 'N', '', 15.98, 0.82, 0, 11.8, 3, 1, 'Y', 4, 20, 'Order Completed'),
(119, '2015-05-04 22:52:45', NULL, NULL, 'N', '', 5.99, 0.45, 0, 6.44, NULL, 1, NULL, NULL, 22, 'Order Sent');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `paymentID` int(11) NOT NULL AUTO_INCREMENT,
  `paymentMethod` varchar(10) NOT NULL,
  PRIMARY KEY (`paymentID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`paymentID`, `paymentMethod`) VALUES
(1, 'Cash'),
(2, 'Credit'),
(3, 'On Pickup');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `productID` int(11) NOT NULL AUTO_INCREMENT,
  `productName` varchar(45) NOT NULL,
  `categoryID` int(11) NOT NULL,
  `productDescription` varchar(155) NOT NULL,
  `productPrice` double NOT NULL,
  `productPhotoURL` varchar(155) DEFAULT NULL,
  `requireTemp` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`productID`),
  KEY `categoryID_idx` (`categoryID`),
  KEY `productName` (`productName`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=94 ;

--
-- RELATIONS FOR TABLE `products`:
--   `categoryID`
--       `categories` -> `categoryID`
--

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productID`, `productName`, `categoryID`, `productDescription`, `productPrice`, `productPhotoURL`, `requireTemp`) VALUES
(1, 'Coca-Cola', 1, '20oz. Coca-Cola Original', 1.99, 'images/products/p1.jpg', 0),
(2, 'French Fries', 7, 'Fresh Seasoned French Fries', 2.79, 'images/products/p2.jpg', 0),
(4, 'Mozzarella Sticks', 0, '10 golden fried mozzarella sticks with marinara dipping sauce.', 6.99, 'images/products/p4.jpg', 0),
(5, 'Sprite', 1, '20oz Sprite', 1.99, 'images/products/p5.jpg', 0),
(6, 'Triple Fudge Cake', 8, 'Triple fudge chocolate cake', 5.99, 'images/products/p6.jpg', 0),
(7, '11oz. Ribeye', 2, 'Fire-Grilled Ribeye', 18.99, 'images/products/p7.jpg', 1),
(11, 'Parm Chicken', 6, 'Home-made Parmesan Chicken with Angel Hair Pasta in our house marinara sauce.', 12.99, 'images/products/chicken.jpg', 0),
(12, 'Cheddar Burger', 3, 'Our delicious original burger topped with cheddar cheese.', 10.99, 'images/products/p12.jpg', 1),
(13, 'Fried Shrimp', 2, 'Fresh Never Frozen Fried Shrimp', 13.99, 'images/products/shrimp.jpg', 0),
(14, 'Cheese Pizza', 5, 'Our original cheese pizza with our house sauce and then wood-fired ', 12.99, 'images/products/pizza.jpg', 0),
(15, '16oz Glass', 13, 'Greg''s Grub 16oz Pint Glass', 6.99, 'images/products/p15.jpg', 0),
(16, 'Shot Glass', 13, 'Greg''s Grub 2oz Shot Glass', 4.99, 'images/products/p16.jpg', 0),
(17, 'Black T-Shirt (S)', 11, 'Greg''s Grub Small Black T-Shirt', 14.99, 'images/products/p17.jpg', 0),
(18, 'Black T-Shirt (M)', 11, 'Greg''s Grub Medium Black T-Shirt', 14.99, 'images/products/p18.jpg', 0),
(19, '$10 Gift Card', 12, '$10 Greg''s Grub Gift Card', 10, 'images/products/p19.jpg', 0),
(20, '$25 Gift Card', 12, '$25 Greg''s Grub Gift Card', 25, 'images/products/p20.jpg', 0),
(22, 'Cheese Calzone', 4, 'Made from scratch 3 cheese calzone with riccotta, mozzarella, and parmesan cheeses.', 9.99, 'images/products/p22.jpg', 0),
(24, 'White T-Shirt (S)', 11, 'Greg''s Grub Small White T-Shirt', 14.99, 'images/products/p24.jpg', 0),
(25, 'White T-Shirt (M)', 11, 'Greg''s Grub Medium White T-Shirt', 14.99, 'images/products/p25.jpg', 0),
(26, 'Black Hat', 11, 'Greg''s Grub One Size Black Baseball Hat', 19.99, 'images/products/p26.jpg', 0),
(27, 'Black Sweatshirt (S)', 11, 'Greg''s Grub Small Black Sweatshirt', 24.99, 'images/products/p27.jpg', 0),
(28, 'White Sweatshirt (S)', 11, 'Greg''s Grub Small White Sweatshirt', 24.99, 'images/products/p28.jpg', 0),
(30, 'Cherry Coke', 1, '20oz Cherry Coke', 1.99, 'images/products/p30.jpg', 0),
(31, 'Barq''s Root Beer', 1, '20oz Barq''s Root Beer', 1.99, 'images/products/p31.jpg', 0),
(32, 'Diet Coke', 1, '20oz Diet Coke', 1.99, 'images/products/p32.jpg', 0),
(33, 'Coke Zero', 1, '20oz Coke Zero', 1.99, 'images/products/p33.jpg', 0),
(34, 'Fanta', 1, '20oz Fanta', 1.99, 'images/products/p34.jpg', 0),
(35, 'Sprite Zero', 1, '20os Sprite Zero', 1.99, 'images/products/p35.jpg', 0),
(36, 'Liption Green Tea', 1, '20oz Lipton Green Tea', 1.99, 'images/products/p36.jpg', 0),
(37, 'Dansani Water', 1, '20oz Dasani Water', 1.99, 'images/products/p37.jpg', 0),
(38, '$50 Gift Card', 12, '$50 Greg''s Grub Gift Card', 50, 'images/products/p38.jpg', 0),
(39, '$100 Gift Card', 12, '$100 Greg''s Grub Gift Card', 100, 'images/products/p39.jpg', 0),
(40, 'Black Sweatshirt (M)', 11, 'Greg''s Grub Medium Black Sweat Shirt', 24.99, 'images/products/p40.jpg', 0),
(41, 'Black Sweatshirt (XL)', 11, 'Greg''s Grub Extra-Large Black Sweat Shirt', 24.99, 'images/products/p41.jpg', 0),
(42, 'Black Sweatshirt (L)', 11, 'Greg''s Grub Large Black Sweat Shirt', 24.99, 'images/products/p42.jpg', 0),
(43, 'Black T-Shirt (L)', 11, 'Greg''s Grub Large Black T-Shirt', 14.99, 'images/products/p43.jpg', 0),
(44, 'Black T-Shirt (XL)', 11, 'Greg''s Grub Extra-Large Black T-Shirt', 14.99, 'images/products/p44.jpg', 0),
(45, 'White Sweatshirt(XL)', 11, 'Greg''s Grub Extra-Large White Sweat Shirt', 24.99, 'images/products/p45.jpg', 0),
(46, 'White Sweatshirt (M)', 11, 'Greg''s Grub Medium White Sweatshirt', 24.99, 'images/products/p46.jpg', 0),
(47, 'White Sweatshirt (L)', 11, 'Greg''s Grub Large White Sweatshirt', 24.99, 'images/products/p47.jpg', 0),
(48, 'White T-Shirt (L)', 11, 'Greg''s Grub Large White T-Shirt', 14.99, 'images/products/p48.jpg', 0),
(49, 'White T-Shirt (XL)', 11, 'Greg''s Grub Extra-Large White T-Shirt', 14.99, 'images/products/p49.jpg', 0),
(50, 'Kettle Chips', 0, 'House made kettle chips with zesty dipping sauce.', 4.99, 'images/products/p50.jpg', 0),
(51, 'BBQ Pork Sliders', 0, 'Our very own BBQ pork sliders in our homemade sauce.', 7.99, 'images/products/p51.jpg', 0),
(52, 'Fried Pickles', 0, 'Golden fried pickle chips served with ranch dipping sauce.', 6.99, 'images/products/p52.jpg', 0),
(53, 'Loaded Fries', 0, 'Two servings of our fresh cut fries loaded with cheese, bacon, and green onion.', 7.99, 'images/products/p53.jpg', 0),
(54, 'Nachos', 0, 'Tortilla chips loaded with beef, cheese, lettuce, and green onion.', 7.99, 'images/products/p54.jpg', 0),
(55, 'Pretzel Sticks', 0, '4 freshly made soft pretzel sticks. Served with beer cheese and bacon honey mustard.', 4.99, 'images/products/p55.jpg', 0),
(56, 'Potato Skins', 0, 'Freshly made potato skins topped with cheese, bacon, and green onion.', 6.99, 'images/products/p56.jpg', 0),
(57, 'Buffalo Wings', 0, '10 spicy Buffalo wings served with celery and bleu cheese.', 7.99, 'images/products/p57.jpg', 0),
(58, 'Spinach Dip', 0, 'Homemade spinach and artichoke dip with shredded provolone and tortilla chips.', 6.99, 'images/products/p58.jpg', 0),
(59, 'Key Lime Pie', 8, 'Homemade southern key lime pie with whip cream.', 5.99, 'images/products/p59.jpg', 0),
(60, 'Strawberry Shortcake', 8, 'Shortcake loaded with strawberries and whip cream.', 5.99, 'images/products/p60.jpg', 0),
(61, 'Turtle Cheesecake', 8, 'Our very own Turtle Cheesecake with fudge, caramel, and pecans.', 5.99, 'images/products/p61.jpeg', 0),
(62, 'Red Velvet Cake', 8, 'Three-layer red velvet cake with our homemade cream cheese icing.', 5.99, 'images/products/p62.jpg', 0),
(63, 'Stuffed Shells', 6, 'Ricotta and mozzarella cheese stuffed shells in out homemade sauce.', 12.99, 'images/products/p63.jpg', 0),
(64, 'Chicken Alfredo', 6, 'Chicken, broccoli, alfredo, and fettuccine noodles. Simple and amazing.', 16.99, 'images/products/p64.jpg', 0),
(65, 'Prime Rib Pasta', 6, 'Ziti noodles in a zesty horseradish sauce, with prime rib, asparagus, and mushrooms.', 17.99, 'images/products/p65.jpg', 0),
(66, 'Spagetti & Meatballs', 6, 'Homemade meatballs and tomato sauce on top a huge mound of spagetti.', 14.99, 'images/products/p66.jpg', 0),
(67, 'Pepperoni Pizza', 5, 'Wood-fired pepperoni pizza.', 13.99, 'images/products/p67.jpg', 0),
(68, 'Supreme Pizza', 5, 'Wood-fired pizza with all your favorite toppings.', 14.99, 'images/products/p68.jpg', 0),
(69, 'Margarita Pizza', 5, 'Wood-fired pizza in a plum tomato sauce with fresh mozzarella and basil.', 13.99, 'images/products/p69.jpg', 0),
(70, 'Veggie Pizza', 5, 'Wood-fired pizza with every veggie imaginable.', 14.99, 'images/products/p70.jpg', 0),
(71, 'Chicken Sandwich', 3, 'Grilled chicken sandwich.', 9.99, 'images/products/p71.jpg', 0),
(72, 'Philly Cheesesteak', 3, 'Philly cheesesteak topped with peppers, onions, and provolone cheese.', 8.99, 'images/products/p72.jpg', 0),
(73, 'Club Sandwich', 3, 'Turkey club with bacon, lettuce, tomato, Swiss cheese, and mayonnaise.', 8.99, 'images/products/p73.png', 0),
(74, 'Baked Potato', 7, 'Fully loaded baked potato with butter, bacon, cheese, and sour cream.', 2.79, 'images/products/p74.png', 0),
(75, 'Sweet Potato', 7, 'Baked sweet potato loaded with butter, cinnamon, and sugar.', 2.79, 'images/products/p75.jpg', 0),
(76, 'Broccoli', 7, 'Steamed broccoli. ', 2.79, 'images/products/p76.jpg', 0),
(77, 'Green Beans', 7, 'Steamed green beans.', 2.79, 'images/products/p77.jpg', 0),
(78, 'Mashed Potatoes', 7, 'Mashed potatoes with butter, salt, and pepper.', 2.79, 'images/products/p78.jpg', 0),
(79, 'Ham Calzone', 4, 'Ham, mozzarella, and ricotta cheese stuffed calzone. ', 10.99, 'images/products/p79.jpg', 0),
(80, 'Spinach Calzone', 4, 'Spinach, mozzarella, and ricotta cheese stuffed calzone.', 9.99, 'images/products/p80.jpg', 0),
(81, 'Pepperoni Stromboli', 4, 'Pepperoni and mozzarella cheese stuffed stromboli.', 10.99, 'images/products/p81.jpg', 0),
(82, 'Sausage Stomboli', 4, 'Sausage and mozzarella cheese stuffed stromboli.', 10.99, 'images/products/p82.jpg', 0),
(83, 'Chicken Tenders', 2, 'Eight hand breaded chicken tenders served with honey mustard.', 12.99, 'images/products/p83.jpg', 0),
(84, 'Almond Salmon', 2, 'Almond-crusted salmon perfectly grilled.', 14.99, 'images/products/p84.jpg', 0),
(85, 'Chopped Steak', 2, '10oz chopped steak grilled to your liking.', 12.99, 'images/products/p85.jpg', 1),
(86, 'New York Strip', 2, '9oz New York Strip perfectly grilled to your liking.', 14.99, 'images/products/p86.jpg', 1),
(87, 'Grilled Chicken', 2, 'Montreal-seasoned grilled chicken breast.', 13.99, 'images/products/p87.jpg', 0),
(88, 'Grilled Shrimp', 2, '3 skewers of grilled shrimp served over rice.', 12.99, 'images/products/p88.jpg', 0),
(89, 'Lamb Chops', 2, 'Garlic and herb marinated lamb chops, fire-grillled to your liking.', 15.99, 'images/products/p89.jpg', 1),
(90, 'BBQ Ribs', 2, 'Half rack of our slow-cooked ribs smothered in our homemade BBQ sauce.', 15.99, 'images/products/p90.jpg', 0),
(91, 'Pork Chops', 2, 'Perfectly seasoned grilled pork chops.', 14.99, 'images/products/p91.jpg', 0),
(92, 'Grilled Tilapia', 2, 'Grilled tilapia in a light sauce.', 14.99, 'images/products/p92.jpg', 0),
(93, 'Stuffed Peppers', 2, '3 of our homemade stuffed peppers.', 13.99, 'images/products/p93.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE IF NOT EXISTS `state` (
  `stateCode` char(2) NOT NULL,
  `stateName` varchar(45) NOT NULL,
  PRIMARY KEY (`stateCode`),
  UNIQUE KEY `stateName_UNIQUE` (`stateName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`stateCode`, `stateName`) VALUES
('AL', 'Alabama'),
('AK', 'Alaska'),
('AZ', 'Arizona'),
('AR', 'Arkansas'),
('CA', 'California'),
('CO', 'Colorado'),
('CT', 'Connecticut'),
('DE', 'Delaware'),
('DC', 'District of Columbia'),
('FL', 'Florida'),
('GA', 'Georgia'),
('HI', 'Hawaii'),
('ID', 'Idaho'),
('IL', 'Illinois'),
('IN', 'Indiana'),
('IA', 'Iowa'),
('KS', 'Kansas'),
('KY', 'Kentucky'),
('LA', 'Louisiana'),
('ME', 'Maine'),
('MD', 'Maryland'),
('MA', 'Massachusetts'),
('MI', 'Michigan'),
('MN', 'Minnesota'),
('MS', 'Mississippi'),
('MO', 'Missouri'),
('MT', 'Montana'),
('NE', 'Nebraska'),
('NV', 'Nevada'),
('NH', 'New Hampshire'),
('NJ', 'New Jearsey'),
('NM', 'New Mexico'),
('NY', 'New York'),
('NC', 'North Carolina'),
('ND', 'North Dakota'),
('OH', 'Ohio'),
('OK', 'Oklahoma'),
('OR', 'Oregon'),
('PA', 'Pennsylvania'),
('RI', 'Rhode Island'),
('SC', 'South Carolina'),
('SD', 'South Dakota'),
('TN', 'Tennessee'),
('TX', 'Texas'),
('UT', 'Utah'),
('VT', 'Vermont'),
('VA', 'Virginia'),
('WA', 'Washington'),
('WV', 'West Virginia'),
('WI', 'Wisconsin'),
('WY', 'Wyoming');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `userEmail` varchar(45) NOT NULL,
  `userName` varchar(45) NOT NULL,
  `userPassword` varchar(255) NOT NULL,
  `userLevel` char(1) NOT NULL,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `userName_UNIQUE` (`userName`),
  UNIQUE KEY `userEmail_UNIQUE` (`userEmail`),
  UNIQUE KEY `userPassword_UNIQUE` (`userPassword`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=81 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userEmail`, `userName`, `userPassword`, `userLevel`) VALUES
(30, 'amber@me.com', 'Amber1', '$2y$10$4Y.SV3FFmVUY6YRRQ8x3keoHZjr6gDvy092aWMJm357sJaT5Ndmtq', 'E'),
(34, 'matthewbattyanyi@student.abtech.edu', 'Lagunast00', '$2y$10$Tfmsc8pvxkucxbiKyVuKEefVJObl7uMa1reA.OM0.B3ycooGh19lC', 'A'),
(38, 'tim@me.com', 'Timmy1', '$2y$10$cIQKPfC39b0Ai/cLSInZlOLe4pCXMa4SUOzhY/tWxLNw19aPSOfgi', 'E'),
(56, 'batman@me.com', 'batman', '$2y$10$xJCcAC2vLixXgy9AlzZwuuqh7I7lLVvUSPe5m/XGCY9hNWYmrU3eO', 'C'),
(64, 'superman@me.com', 'superman', '$2y$10$7/JvhwaYINO.8CUJ/7Oqo.J7MYmabaPXfGGY8AbnJgtv.8nz6SvY2', 'C'),
(67, 'chase@me.com', 'Chase1', '$2y$10$.nez.QQoUEYuYctXhrtwH.gP0Wziddwip4F/iwVudYvyaqJ4bYuey', 'A'),
(76, 'chandler@me.com', 'Chandler1', '$2y$10$D5kEvn1wkO65jIhYUVkYpu6tPYiMVOyPIYt46QM5oopiyTkitc3NG', 'E'),
(77, '', 'localhost', '$2y$10$PIfcpp3h4nLFiA4kmu4IaOZP4h4iR6OvqC6dSlVN3UKD2FlloGil2', 'A'),
(78, 'stark@me.com', 'IronMan1', '$2y$10$Rz.5lPvN5ml0LLncEjF9T.BRAW0GIttn8ORpZL4TasAl2WtLu1zhC', 'C'),
(79, 'chris@me.com', 'Chrisman1', '$2y$10$iDf1VRW3qcjhAyohvO/0Eu65v7FSTZTI4D/UoEhnFLRZxzHa46Vze', 'E'),
(80, 'louis@me.com', 'LouisB1', '$2y$10$m7WpAFCBq7DgmrnfodPcH.s2pd9HuYZDF.5VuPYHQc0SRQBJtNSYW', 'E');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `userIDcomm` FOREIGN KEY (`userIDcomm`) REFERENCES `users` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `creditcards`
--
ALTER TABLE `creditcards`
  ADD CONSTRAINT `orderIDcredit` FOREIGN KEY (`orderIDcredit`) REFERENCES `orders` (`orderID`);

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `nameIDcust` FOREIGN KEY (`nameIDcust`) REFERENCES `names` (`nameID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `stateCode` FOREIGN KEY (`stateCode`) REFERENCES `state` (`stateCode`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `nameID` FOREIGN KEY (`nameID`) REFERENCES `names` (`nameID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `names`
--
ALTER TABLE `names`
  ADD CONSTRAINT `userID` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `orderID` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `productID` FOREIGN KEY (`productID`) REFERENCES `products` (`productID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `couponID` FOREIGN KEY (`couponID`) REFERENCES `coupons` (`couponID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `customerID` FOREIGN KEY (`customerID`) REFERENCES `customers` (`customerID`),
  ADD CONSTRAINT `employeeID` FOREIGN KEY (`employeeID`) REFERENCES `employees` (`employeeID`),
  ADD CONSTRAINT `paymentID` FOREIGN KEY (`paymentID`) REFERENCES `payment` (`paymentID`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `categoryID` FOREIGN KEY (`categoryID`) REFERENCES `categories` (`categoryID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
