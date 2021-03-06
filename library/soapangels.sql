-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `soapangels`
--

--
-- Table structure for table `products`
--
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `prodId` int UNSIGNED NOT NULL,
  `prodName` varchar(30) NOT NULL,
  `prodDescription` text NOT NULL,
  `prodImage` varchar(50) NOT NULL,
  `prodPrice` decimal(10,0) NOT NULL,
  `prodStock` smallint NOT NULL,
  `itemId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--
INSERT INTO `products` (`prodId`, `prodName`, `prodDescription`, `prodImage`, `prodPrice`, `prodStock`, `itemId`) VALUES
(1, 'Raspberry Soap', 'This delicious-smelling red soap will fill you with the excitement and energy of fresh summer berries', 'images/soaps/raspberry-soap.jpg',  '5.99', 10, 1),
(2, 'Pumpkin Soap', 'This warm pumpkin soap will have you falling backward into pure bliss', 'images/soaps/pumpkin-soap.jpg',  '5.99', 10, 1),
(3, 'Mint Soap', 'This cool and refreshing soap will clear your mind and leave you with the invigorating scent of evergreen trees', 'images/soaps/mint-soap.jpg',  '5.99', 10, 1),
(4, 'Melon Soap', 'This soft and creamy soap will moisturize your skin and put a spring in your step', 'images/soaps/melon-soap.jpg',  '5.99', 10, 1),
(5, 'Raspberry Lip Balm', 'Our raspberry lip balm will have your lips feeling as full and tasty as fresh raspberries', 'images/balms/raspberry-balm.jpg',  '2.99', 10, 2),
(6, 'Mint Lotion', 'Our mint lotion is just the thing to rejuvenate mind and body', 'images/lotions/mint-lotion.jpg',  '7.99', 10, 3),
(7, 'Mint Scrub', 'Our mint scrub will clear and energize your skin and leave you tingling', 'images/scrubs/mint-scrub.jpg',  '6.99', 10, 4);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`prodId`),
  ADD KEY `itemId` (`itemId`);

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `prodId` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
  
--
-- Table structure for table `items`
--
DROP TABLE IF EXISTS `items`;
CREATE TABLE `items` (
  `itemId` int NOT NULL,
  `itemName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--
INSERT INTO `items` (`itemId`, `itemName`) VALUES
(1, 'Soaps'),
(2, 'Balms'),
(3, 'Lotions'),
(4, 'Scrubs');

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`itemId`);
  
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `itemId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
  
--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`itemId`) REFERENCES `items` (`itemId`);
COMMIT;

--
-- Table structure for table `clients`
--
 DROP TABLE IF EXISTS `clients`;
 CREATE TABLE `clients` (
   `clientId` int UNSIGNED NOT NULL,
   `clientFullname` varchar(15) NOT NULL,
   `clientUsername` varchar(25) NOT NULL,
   `clientEmail` varchar(40) NOT NULL,
   `clientPassword` varchar(255) NOT NULL,
   `clientLevel` enum('1','2','3') NOT NULL DEFAULT '1'
 ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for table `clients`
--
 ALTER TABLE `clients`
   ADD PRIMARY KEY (`clientId`);
  
--
-- AUTO_INCREMENT for table `clients`
--
 ALTER TABLE `clients`
 MODIFY `clientId` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- Table structure for table `purchases`
--
 DROP TABLE IF EXISTS `purchases`;
 CREATE TABLE `purchases` (
   `purchaseTime` DATETIME DEFAULT CURRENT_TIMESTAMP,
   `clientId` int UNSIGNED NOT NULL,
   `prodId` int UNSIGNED NOT NULL,
   `purchaseQuantity` int UNSIGNED NOT NULL,
   `purchasePrice` decimal(10,0) NOT NULL,
   `purchaseId` int UNSIGNED NOT NULL
 ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for table `purchases`
--
 ALTER TABLE `purchases`
   ADD PRIMARY KEY (`purchaseId`);
  
--
-- AUTO_INCREMENT for table `purchases`
--
 ALTER TABLE `purchases`
 MODIFY `purchaseId` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_ibfk_1` FOREIGN KEY (`clientId`) REFERENCES `clients` (`clientId`);
COMMIT;

ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_ibfk_2` FOREIGN KEY (`prodId`) REFERENCES `products` (`prodId`);
COMMIT;




/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
