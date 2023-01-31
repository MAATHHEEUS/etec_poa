-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: tcc
-- ------------------------------------------------------
-- Server version	5.7.36

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
-- Table structure for table `tb_noticias`
--

DROP TABLE IF EXISTS `tb_noticias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_noticias` (
  `noticia_id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(60) COLLATE latin1_general_cs NOT NULL,
  `dtcad` date NOT NULL,
  `descricao` varchar(260) COLLATE latin1_general_cs NOT NULL,
  PRIMARY KEY (`noticia_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_noticias`
--

LOCK TABLES `tb_noticias` WRITE;
/*!40000 ALTER TABLE `tb_noticias` DISABLE KEYS */;
INSERT INTO `tb_noticias` VALUES (1,'Notícia 1','2023-01-05','Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste quos iure, \nmolestiae deleniti doloribus facere voluptates vel earum omnis rerum, quas blanditiis numquam mollitia voluptatum temporibus placeat \nfuga asperiores velit?'),(2,'Notícia 2','2023-01-05','Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste quos iure, \nmolestiae deleniti doloribus facere voluptates vel earum omnis rerum, quas blanditiis numquam mollitia voluptatum temporibus placeat \nfuga asperiores velit?'),(3,'Notícia 3','2023-01-07','Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste quos iure, \nmolestiae deleniti doloribus facere voluptates vel earum omnis rerum, quas blanditiis numquam mollitia voluptatum temporibus placeat \nfuga asperiores velit?');
/*!40000 ALTER TABLE `tb_noticias` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-01-31 20:43:54
