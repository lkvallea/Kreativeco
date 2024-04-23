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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nickName` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `password` varchar(256) COLLATE utf8_spanish2_ci NOT NULL,
  `rol` int(3) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `create_user` timestamp NULL DEFAULT NULL,
  `date_login` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (14,'usuarioUno','Pedro','Valle','corre1@corre.com','$2y$12$ZNLoFu2K95AMu10qZL0Uce/8Xk1hhug8VYlze4gCkYKHgQQswk.He',1,1,'2024-04-24 00:18:47',NULL),(15,'usuarioDos','Juan','Valle','corre2@corre.com','$2y$12$7Jlf.EN6.YGz16k/teE8hu343pmnjjlCKS/Ec2eTgeHcGib8DUxBK',2,1,'2024-04-24 00:19:13',NULL),(16,'usuarioTres','Luis','Valle','corre3@corre.com','$2y$12$ltDf549bFXdpE6D5s35K2.mCO1UU1Mh3wb9owY2S4uxxD9IYK545i',3,1,'2024-04-24 00:19:27',NULL),(17,'usuarioCuatro','Fer','Valle','corre4@corre.com','$2y$12$XjvkWIwYqzp7kMLRAy0cDuZyRAfwGVq8VWJO6JdCFPfbu9Y13gF6u',4,1,'2024-04-24 00:19:43',NULL),(18,'usuarioCinco','Andres','Valle','corre5@corre.com','$2y$12$5y0wNXcu0SdW6GNoJtY8weAcaDmqS5yOFga3/W1jLZ1.xk57EN05q',5,1,'2024-04-24 00:19:56',NULL),(21,'usuarioCinco','Andres','Valle','corre5s@corre.com','$2y$12$WDKKOUWjGf8Wp.8ukW2B1ugnrMXX4ZbDAdFl2f88bL/b0a4DsWadC',5,1,'2024-04-24 05:35:48',NULL),(25,'usuarioCinco','Andres','Valle','cor4re5s@corre.com','$2y$12$MYMg9HweY3032JT9aZyZLeMvLoGiZUDBKqta0Jp67qrzyvju2rwsu',4,1,'2024-04-24 05:38:31',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-23 17:45:23
