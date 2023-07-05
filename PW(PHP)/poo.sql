-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 17-Jun-2023 às 01:41
-- Versão do servidor: 8.0.31
-- versão do PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `poo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `agendamentos`
--

DROP TABLE IF EXISTS `agendamentos`;
CREATE TABLE IF NOT EXISTS `agendamentos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_massagista` int DEFAULT NULL,
  `id_massagem` int DEFAULT NULL,
  `data_hr` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_massagista` (`id_massagista`),
  KEY `id_massagem` (`id_massagem`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `massagens`
--

DROP TABLE IF EXISTS `massagens`;
CREATE TABLE IF NOT EXISTS `massagens` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `valor` double NOT NULL,
  `tipo` enum('Simples','Completa') COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `massagens`
--

INSERT INTO `massagens` (`id`, `nome`, `valor`, `tipo`) VALUES
(1, 'Massagem 1', 55, 'Simples'),
(2, 'Massagem 2', 99, 'Completa');

-- --------------------------------------------------------

--
-- Estrutura da tabela `massagista`
--

DROP TABLE IF EXISTS `massagista`;
CREATE TABLE IF NOT EXISTS `massagista` (
  `id` int NOT NULL,
  `nome` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `dataNasc` date NOT NULL,
  `contato` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `massagista`
--

INSERT INTO `massagista` (`id`, `nome`, `dataNasc`, `contato`) VALUES
(0, 'Massagista Boa', '1999-04-16', '9855441651');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
