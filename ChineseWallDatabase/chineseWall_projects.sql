-- MySQL dump 10.13  Distrib 5.7.30, for Linux (x86_64)
--
-- Host: localhost    Database: chineseWall
-- ------------------------------------------------------
-- Server version	5.7.30-0ubuntu0.16.04.1

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
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_name` varchar(45) DEFAULT NULL,
  `client_domain` varchar(45) DEFAULT NULL,
  `project_name` varchar(45) DEFAULT NULL,
  `priority_level` int(11) DEFAULT NULL,
  `client_resource` longtext,
  `project_startDate` date DEFAULT NULL,
  `AssignedTo` text,
  `end_date` date DEFAULT NULL,
  `project_status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (1,'Amazon','onlineShopping','ABC',9,NULL,'2020-06-08','12345',NULL,'ongoing'),(2,'Zomato','onlineFoodDelivery','XYZ',9,NULL,'2020-06-08',NULL,NULL,NULL),(3,'Swiggy','onlineFoodDelivery','abc',2,NULL,'2018-11-08','11','2019-11-08','finished'),(4,'UberEats','onlineFoodDelivery','abc',6,NULL,'2019-01-03','12','2020-01-03','finished'),(5,'Microsoft','computerServices','abc',8,NULL,'2018-07-06',NULL,NULL,NULL),(6,'Indigo','airlines','abc',7,NULL,'2018-09-07',NULL,NULL,NULL),(7,'Zomato','onlineFoodDelivery','acd',9,NULL,'2018-06-02','16','2020-01-04','finished'),(8,'Apple','computerServices','amc',8,NULL,'2018-06-05','17','2020-01-05','finished'),(9,'AirIndia','airlines','dya',6,NULL,'2020-01-10','17','2020-04-05','finished'),(10,'Swiggy','onlineFoodDelivery','adqw',2,NULL,'2014-02-03','11','2015-02-03','finished'),(11,'IBM','computerServices','cadfa',8,NULL,'2007-02-03','18','2012-04-08','finished'),(12,'BigBinary','computerServices','adda',2,NULL,'2020-06-02',NULL,NULL,'ongoing');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-06-10 17:43:19
