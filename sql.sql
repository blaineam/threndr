-- MySQL dump 10.13  Distrib 5.5.44, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: threndr
-- ------------------------------------------------------
-- Server version	5.5.44-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `admin` varchar(100) NOT NULL DEFAULT 'false',
  `phonenumber` varchar(18) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `orderedproducts`
--

DROP TABLE IF EXISTS `orderedproducts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orderedproducts` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `orderid` int(255) unsigned DEFAULT NULL,
  `productid` int(255) DEFAULT NULL,
  `orderquantity` int(10) DEFAULT NULL,
  `productsize` varchar(3) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `customerid` int(255) unsigned DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `projectedshipmentdate` datetime DEFAULT NULL,
  `actualshipdate` datetime DEFAULT NULL,
  `status` varchar(300) DEFAULT 'Order Received',
  `trackingnumber` varchar(50) DEFAULT NULL,
  `totalprice` varchar(100) DEFAULT '',
  `shippingcost` varchar(10) DEFAULT '',
  `subtotal` varchar(100) DEFAULT '',
  `mailingstreet` varchar(100) DEFAULT NULL,
  `mailingstreet2` varchar(100) DEFAULT NULL,
  `mailingcity` varchar(100) DEFAULT NULL,
  `mailingstate` varchar(100) DEFAULT NULL,
  `mailingzip` varchar(18) DEFAULT NULL,
  `billingstreet` varchar(100) DEFAULT NULL,
  `billingstreet2` varchar(100) DEFAULT NULL,
  `billingcity` varchar(100) DEFAULT NULL,
  `billingstate` varchar(100) DEFAULT NULL,
  `billingzip` varchar(18) DEFAULT NULL,
  `cardexpiration` varchar(30) DEFAULT NULL,
  `cardnumber` varchar(17) DEFAULT NULL,
  `ccvcode` varchar(10) DEFAULT NULL,
  `paymenttype` varchar(50) DEFAULT NULL,
  `nameoncard` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;



--
-- Table structure for table `productinventory`
--

DROP TABLE IF EXISTS `productinventory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productinventory` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `productid` int(255) NOT NULL,
  `XS` int(10) DEFAULT NULL,
  `S` int(10) DEFAULT NULL,
  `M` int(10) DEFAULT NULL,
  `L` int(10) DEFAULT NULL,
  `XL` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(45) NOT NULL,
  `title` varchar(150) NOT NULL,
  `inventoryquantity` int(255) DEFAULT '1',
  `price` varchar(15) NOT NULL,
  `size` varchar(45) DEFAULT '',
  `description` varchar(500) NOT NULL,
  `graphic` varchar(1000) NOT NULL,
  `agegroup` varchar(45) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `featured` varchar(4) NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reviews` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `productid` int(255) unsigned NOT NULL,
  `title` varchar(200) NOT NULL,
  `rating` int(2) NOT NULL,
  `description` longtext NOT NULL,
  `customerid` int(255) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `productid` (`productid`),
  KEY `customerid` (`customerid`),
  CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`productid`) REFERENCES `products` (`id`),
  CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`customerid`) REFERENCES `customers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;