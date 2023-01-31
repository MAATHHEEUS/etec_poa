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
-- Table structure for table `tb_oportunidades`
--

DROP TABLE IF EXISTS `tb_oportunidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_oportunidades` (
  `oportunidade_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) COLLATE latin1_general_cs NOT NULL,
  `resumo` varchar(260) COLLATE latin1_general_cs NOT NULL,
  `requisitos` varchar(260) COLLATE latin1_general_cs NOT NULL,
  `site` varchar(100) COLLATE latin1_general_cs DEFAULT NULL,
  `contato` varchar(40) COLLATE latin1_general_cs DEFAULT NULL,
  `area` varchar(40) COLLATE latin1_general_cs DEFAULT NULL,
  `empresa` varchar(60) COLLATE latin1_general_cs DEFAULT NULL,
  `tipo` set('Estágio','Bolsa') COLLATE latin1_general_cs DEFAULT NULL,
  PRIMARY KEY (`oportunidade_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_oportunidades`
--

LOCK TABLES `tb_oportunidades` WRITE;
/*!40000 ALTER TABLE `tb_oportunidades` DISABLE KEYS */;
INSERT INTO `tb_oportunidades` VALUES (1,'Programador jr','Trabalhará a frente do sistemas já desenvolvidos, realizando alterações e correções','HTML, CSS, JAVASCRIPT, PHP, MYSQL','www.google.com.br','1199999-9999/114749-0908','TI','Google','Estágio'),(2,'Adm jr','Trabalhará manipulando documentos em Word, Excel e Ferramentas Básicas de edição','INFORMÁTICA BÁSICA, WORD, EXCEL','www.google.com.br','1199999-9999/114749-0908','Administração','Google','Bolsa');
/*!40000 ALTER TABLE `tb_oportunidades` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-01-31 20:43:56
