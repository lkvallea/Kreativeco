-- MySQL dump 10.13  Distrib 8.0.36, for macos14 (x86_64)
--
-- Host: 174.136.25.173    Database: ometlcom_kreativeco_db
-- ------------------------------------------------------
-- Server version	5.7.44-log-cll-lve

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `post_history`
--

DROP TABLE IF EXISTS `post_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post_history` (
  `id_post_history` int(11) NOT NULL AUTO_INCREMENT,
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tittle` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `description` text COLLATE utf8_spanish2_ci,
  `created_History` timestamp NULL DEFAULT NULL,
  `edit_val` varchar(10) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'edited',
  PRIMARY KEY (`id_post_history`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_history`
--

LOCK TABLES `post_history` WRITE;
/*!40000 ALTER TABLE `post_history` DISABLE KEYS */;
INSERT INTO `post_history` VALUES (1,2,18,'Nuevo Post','ssssss','2024-04-24 03:20:57','edited'),(2,2,18,'Nuevo Post','post editado','2024-04-24 03:21:37','edited'),(3,2,18,'Nuevo Post','post editados','2024-04-24 03:27:28','edited'),(4,2,18,'Nuevo Post','post editadosss','2024-04-24 04:03:23','edited'),(5,2,18,'Nuevo Post','post editadossss','2024-04-24 04:03:56','edited'),(6,2,18,'Nuevo Post','post editadddossss','2024-04-24 04:04:20','edited'),(7,2,18,'Nuevo Post','post editadddossss','2024-04-24 04:32:10','deleted'),(8,2,18,'Nuevo Post','post editadddossss','2024-04-24 04:34:30','deleted'),(9,3,18,'Nuevo Posts','ssssss','2024-04-24 05:39:00','deleted');
/*!40000 ALTER TABLE `post_history` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-23 17:45:22
