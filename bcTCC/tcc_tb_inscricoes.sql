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
-- Table structure for table `tb_inscricoes`
--

DROP TABLE IF EXISTS `tb_inscricoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_inscricoes` (
  `id_inscricao` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) COLLATE latin1_general_cs NOT NULL,
  `cpf` varchar(11) COLLATE latin1_general_cs NOT NULL,
  `mae` varchar(60) COLLATE latin1_general_cs NOT NULL,
  `periodo` varchar(1) COLLATE latin1_general_cs NOT NULL,
  `diassemana` varchar(1) COLLATE latin1_general_cs NOT NULL,
  `rg` varchar(9) COLLATE latin1_general_cs NOT NULL,
  `uf` varchar(2) COLLATE latin1_general_cs NOT NULL,
  `orgao` varchar(9) COLLATE latin1_general_cs NOT NULL,
  `dt_nasc` date NOT NULL,
  `dt_expedi` date NOT NULL,
  `nome_resp` varchar(60) COLLATE latin1_general_cs DEFAULT NULL,
  `cpf_resp` varchar(11) COLLATE latin1_general_cs DEFAULT NULL,
  `id_curso` int(11) NOT NULL,
  `email` varchar(100) COLLATE latin1_general_cs NOT NULL,
  PRIMARY KEY (`id_inscricao`),
  KEY `id_curso` (`id_curso`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_inscricoes`
--

LOCK TABLES `tb_inscricoes` WRITE;
/*!40000 ALTER TABLE `tb_inscricoes` DISABLE KEYS */;
INSERT INTO `tb_inscricoes` VALUES (1,'Matheus','31321313123','Maria','2','1','213123213','SP','SSP','1998-11-04','2018-09-14','','',1,'m@email'),(5,'Jão','11111111111','Jão','1','1','222222222','SC','SSSC','1998-09-16','2020-10-20','','',1,'Jão11111111111@etec.sp.gov.br'),(4,'Fill','12345678899','Mãe','1','1','234556444','SP','SSP','1997-03-30','2020-04-13','','',3,'Fill12345678899@etec.sp.gov.br'),(6,'Teste','99999999999','Teste','1','1','333333333','SP','SSP','1999-04-13','2020-09-14','','',1,'Teste99999999999@etec.sp.gov.br');
/*!40000 ALTER TABLE `tb_inscricoes` ENABLE KEYS */;
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
