-- MySQL dump 10.13  Distrib 8.0.35, for Linux (x86_64)
--
-- Host: localhost    Database: BenutzerDatenbank
-- ------------------------------------------------------
-- Server version	8.0.35-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Benutzer`
--

DROP TABLE IF EXISTS `Benutzer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Benutzer` (
  `UserID` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `passwort` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Benutzer`
--

LOCK TABLES `Benutzer` WRITE;
/*!40000 ALTER TABLE `Benutzer` DISABLE KEYS */;
INSERT INTO `Benutzer` VALUES (1,'test','','web@web.de'),(2,'test2','','web@web.de'),(3,'test3','','web@webb.de'),(4,'test4','','web@web.de'),(5,'DeinBenutzername','DeinPasswort','deine-email@example.com'),(6,'rene-andre.vierkant','','crazyvision26@gmail.com'),(7,'rene-andre.vierkant','4324234','crazyvision26@gmail.com'),(8,'test12345','12345','web@eb.de'),(9,'tester12345','12345','web@web.de'),(10,'mirko','mirko3320','mirko221@lachs.de'),(11,'mirko42','12345','mirko221@lachs.de'),(12,'rene-andre.vierkant','11122233344455','crazyvision26@gmail.com'),(13,'tammo','12345','web@web.de'),(14,'rene-andre.vierkant','$2y$10$UhDU3Al7STLz3.DA.pqIZ.XcgrCEWc8hjXDQlbsNcMy5BaDVr9YVW','crazyvision26@gmail.com'),(15,'rene-test','$2y$10$XZYr/4b66P/1YudJf/tKmON3l63L1sWyFQKdTo.4oZQv2cefFSl1W','crazyvision26@gmail.com');
/*!40000 ALTER TABLE `Benutzer` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET CO