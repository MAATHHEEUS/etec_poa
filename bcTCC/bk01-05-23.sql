-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql101.epizy.com
-- Tempo de geração: 01-Maio-2023 às 19:04
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `epiz_33834181_tcc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cursos`
--

CREATE TABLE `tb_cursos` (
  `id_curso` int(11) NOT NULL,
  `prof_id` int(11) DEFAULT NULL,
  `nome` varchar(60) COLLATE latin1_general_cs NOT NULL,
  `resumo` varchar(250) COLLATE latin1_general_cs NOT NULL,
  `requisitos` varchar(250) COLLATE latin1_general_cs NOT NULL,
  `periodo` varchar(25) COLLATE latin1_general_cs NOT NULL,
  `diassemana` varchar(25) COLLATE latin1_general_cs NOT NULL,
  `tipo` varchar(60) COLLATE latin1_general_cs NOT NULL,
  `excluido` varchar(1) COLLATE latin1_general_cs NOT NULL DEFAULT 'N',
  `qtde_vagas` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Extraindo dados da tabela `tb_cursos`
--

INSERT INTO `tb_cursos` (`id_curso`, `prof_id`, `nome`, `resumo`, `requisitos`, `periodo`, `diassemana`, `tipo`, `excluido`, `qtde_vagas`) VALUES
(1, 3, 'DS', 'Desenvolvimento de sistemas, programação, banco de dados, sites, TI.', 'Ter 14 anos ou mais, terminado ou cursando o ensino médio regular.', 'Noite', 'Sábados', 'Ensino Técnico', 'N', 3),
(2, 3, 'ADM', 'Adiministração de pequenas, médias e grandes empresas, conhecimento geral do mercado de trabalho empresarial.', 'Ter 14 anos ou mais, terminado ou cursando o ensino médio regular.', 'Noite', 'Seg. a Sex.', 'Ensino Técnico', 'N', 2),
(3, 3, 'EMT', 'Ensino médio integrado técnico', 'Terminado o ensino fundamental', 'Integral', 'Seg. a Sex.', 'Ensino Médio Técnico', 'N', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_denuncias`
--

CREATE TABLE `tb_denuncias` (
  `denuncia_id` int(11) NOT NULL,
  `dtcad` date NOT NULL,
  `descricao` varchar(300) COLLATE latin1_general_cs NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Extraindo dados da tabela `tb_denuncias`
--

INSERT INTO `tb_denuncias` (`denuncia_id`, `dtcad`, `descricao`) VALUES
(1, '2023-01-06', 'sssssssssssssssssssssss'),
(2, '2023-01-06', 'Ótimo sistema!'),
(3, '2023-01-16', 'Teste testes testes mais testes'),
(4, '2023-04-01', 'ta funcionando legal?'),
(5, '2023-04-08', 'dffdfdffdfd'),
(6, '2023-04-27', 'TEste de Máximo caracteres AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_inscricoes`
--

CREATE TABLE `tb_inscricoes` (
  `id_inscricao` int(11) NOT NULL,
  `nome` varchar(60) COLLATE latin1_general_cs NOT NULL,
  `cpf` varchar(11) COLLATE latin1_general_cs NOT NULL,
  `mae` varchar(60) COLLATE latin1_general_cs NOT NULL,
  `periodo` varchar(25) COLLATE latin1_general_cs NOT NULL,
  `diassemana` varchar(25) COLLATE latin1_general_cs NOT NULL,
  `rg` varchar(9) COLLATE latin1_general_cs NOT NULL,
  `uf` varchar(2) COLLATE latin1_general_cs NOT NULL,
  `orgao` varchar(9) COLLATE latin1_general_cs NOT NULL,
  `dt_nasc` date NOT NULL,
  `dt_expedi` date NOT NULL,
  `nome_resp` varchar(60) COLLATE latin1_general_cs DEFAULT NULL,
  `cpf_resp` varchar(11) COLLATE latin1_general_cs DEFAULT NULL,
  `id_curso` int(11) NOT NULL,
  `email` varchar(100) COLLATE latin1_general_cs NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Extraindo dados da tabela `tb_inscricoes`
--

INSERT INTO `tb_inscricoes` (`id_inscricao`, `nome`, `cpf`, `mae`, `periodo`, `diassemana`, `rg`, `uf`, `orgao`, `dt_nasc`, `dt_expedi`, `nome_resp`, `cpf_resp`, `id_curso`, `email`) VALUES
(1, 'Matheus', '31321313123', 'Maria', 'Tarde', 'Seg. a Sex.', '213123213', 'SP', 'SSP', '1998-11-04', '2018-09-14', '', '', 1, 'm@email'),
(5, 'Jão', '11111111111', 'Jão', 'Manha', 'Seg. a Sex.', '222222222', 'SC', 'SSSC', '1998-09-16', '2020-10-20', '', '', 1, 'Jão11111111111@etec.sp.gov.br'),
(4, 'Fill', '12345678899', 'Mãe', 'Manha', 'Seg. a Sex.', '234556444', 'SP', 'SSP', '1997-03-30', '2020-04-13', '', '', 3, 'Fill12345678899@etec.sp.gov.br'),
(6, 'Teste', '99999999999', 'Teste', 'Manha', 'Seg. a Sex.', '333333333', 'SP', 'SSP', '1999-04-13', '2020-09-14', '', '', 3, 'Teste99999999999@etec.sp.gov.br'),
(9, 'Jão', '44444444444', 'Joa', 'Integral', 'Seg. a Sex.', '43433434', 'SP', 'SSP', '1999-04-16', '2022-10-20', '', '', 3, 'Jão44444444444@etec.sp.gov.br'),
(10, 'Jorge Henrique Iwashita Uchida', '24092265824', 'Iara Iwashita', 'Integral', 'Seg. a Sex.', '111111111', 'SP', 'SSP', '2003-06-25', '2023-03-30', '', '', 3, 'Jorge24092265824@etec.sp.gov.br');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_interacoes`
--

CREATE TABLE `tb_interacoes` (
  `id_pergunta` int(11) NOT NULL,
  `autor` varchar(60) COLLATE latin1_general_cs NOT NULL,
  `dt_cad` date NOT NULL,
  `descricao` varchar(300) COLLATE latin1_general_cs DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Extraindo dados da tabela `tb_interacoes`
--

INSERT INTO `tb_interacoes` (`id_pergunta`, `autor`, `dt_cad`, `descricao`) VALUES
(1, 'Teste', '2023-01-09', 'TEste???'),
(2, 'Fulano', '2023-01-09', 'Pergunta 2 teste '),
(3, 'EU', '2023-01-16', 'TEste Teste??'),
(4, 'jorge', '2023-04-01', 'mano ta funcionando legal?');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_interesse`
--

CREATE TABLE `tb_interesse` (
  `id_interesse` int(11) NOT NULL,
  `nome` varchar(60) COLLATE latin1_general_cs NOT NULL,
  `email` varchar(100) COLLATE latin1_general_cs NOT NULL,
  `ddd` tinyint(2) NOT NULL,
  `telefone` bigint(9) NOT NULL,
  `periodo` varchar(25) COLLATE latin1_general_cs NOT NULL,
  `diassemana` varchar(25) COLLATE latin1_general_cs NOT NULL,
  `curso` varchar(10) COLLATE latin1_general_cs NOT NULL,
  `descricao` varchar(100) COLLATE latin1_general_cs NOT NULL DEFAULT '-'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Extraindo dados da tabela `tb_interesse`
--

INSERT INTO `tb_interesse` (`id_interesse`, `nome`, `email`, `ddd`, `telefone`, `periodo`, `diassemana`, `curso`, `descricao`) VALUES
(1, 'Matheus', 'Mco.Matheus@gmail.com', 11, 213132131, 'Tarde', 'Sabados', 'ADM', 'Pequena descrição aqui'),
(2, 'sdadad', 'email.com', 11, 123456789, 'Manha', 'Semana', 'DS', '-'),
(3, 'TEste TESTE', 'teste@gmail.com', 11, 999999999, 'Manha', 'Semana', 'ADM', '-'),
(4, 'Matheus Carvalho Oliveira', 'email@email.com.br', 11, 115416116, 'Integral', 'Sabados', 'DS', '-'),
(5, 'Nome', 'email', 0, 0, 'Manha', 'Semana', 'DS', 'Texto de teste registro de interesse AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),
(6, 'Teste Teste TESTE TESTE TESTE TESTE TESTE TESTE EEEEEEEEEEEE', '@email@email@emai', 22, 999999999, 'Noite', 'Semana', 'INFONET', 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the i'),
(7, 'Matheus Carvalho Oliveira', '@email@email@email@email@email@email@email@email@e', 11, 974200390, 'Manha', 'Semana', 'INFONET', 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the i');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_noticias`
--

CREATE TABLE `tb_noticias` (
  `noticia_id` int(11) NOT NULL,
  `titulo` varchar(60) COLLATE latin1_general_cs NOT NULL,
  `dtcad` date NOT NULL,
  `descricao` varchar(1000) COLLATE latin1_general_cs NOT NULL,
  `nome_arq` varchar(60) COLLATE latin1_general_cs NOT NULL DEFAULT 'logo.png'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Extraindo dados da tabela `tb_noticias`
--

INSERT INTO `tb_noticias` (`noticia_id`, `titulo`, `dtcad`, `descricao`, `nome_arq`) VALUES
(9, 'SEMANA PAULO FREIRE', '2023-04-27', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letrase', 'Paulo_Freire_1977.jpg'),
(2, 'Notícia 2', '2023-01-05', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste quos iure, \nmolestiae deleniti doloribus facere voluptates vel earum omnis rerum, quas blanditiis numquam mollitia voluptatum temporibus placeat \nfuga asperiores velit?', 'logo.png'),
(3, 'Notícia 3', '2023-01-07', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste quos iure, \nmolestiae deleniti doloribus facere voluptates vel earum omnis rerum, quas blanditiis numquam mollitia voluptatum temporibus placeat \nfuga asperiores velit?', 'logo.png'),
(7, 'Infonet - ETEC Poá', '2023-04-27', 'Novo curso oferecido pela ETEC de Poá está com vagas abertas, o informática para internet ou InfoNet como é mais conhecido ..........', 'ETEC_POA.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_oportunidades`
--

CREATE TABLE `tb_oportunidades` (
  `oportunidade_id` int(11) NOT NULL,
  `nome` varchar(60) COLLATE latin1_general_cs NOT NULL,
  `resumo` varchar(260) COLLATE latin1_general_cs NOT NULL,
  `requisitos` varchar(260) COLLATE latin1_general_cs NOT NULL,
  `site` varchar(100) COLLATE latin1_general_cs DEFAULT NULL,
  `contato` varchar(40) COLLATE latin1_general_cs DEFAULT NULL,
  `area` varchar(40) COLLATE latin1_general_cs DEFAULT NULL,
  `empresa` varchar(60) COLLATE latin1_general_cs DEFAULT NULL,
  `tipo` set('Estágio','Bolsa') COLLATE latin1_general_cs DEFAULT NULL,
  `excluido` varchar(1) COLLATE latin1_general_cs NOT NULL DEFAULT 'N'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Extraindo dados da tabela `tb_oportunidades`
--

INSERT INTO `tb_oportunidades` (`oportunidade_id`, `nome`, `resumo`, `requisitos`, `site`, `contato`, `area`, `empresa`, `tipo`, `excluido`) VALUES
(1, 'Programador jr', 'Trabalhará a frente do sistemas já desenvolvidos, realizando alterações e correções', 'HTML, CSS, JAVASCRIPT, PHP, MYSQL', 'www.google.com.br', '1199999-9999/114749-0908', 'TI', 'Google', 'Estágio', 'N'),
(2, 'Adm jr', 'Trabalhará manipulando documentos em Word, Excel e Ferramentas Básicas de edição', 'INFORMÁTICA BÁSICA, WORD, EXCEL', 'www.google.com.br', '1199999-9999/114749-0908', 'Administração', 'Google', 'Bolsa', 'N');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_respostas`
--

CREATE TABLE `tb_respostas` (
  `id_resposta` int(11) NOT NULL,
  `autor` varchar(60) COLLATE latin1_general_cs NOT NULL,
  `dt_cad` date NOT NULL,
  `descricao` varchar(300) COLLATE latin1_general_cs DEFAULT NULL,
  `id_pergunta` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Extraindo dados da tabela `tb_respostas`
--

INSERT INTO `tb_respostas` (`id_resposta`, `autor`, `dt_cad`, `descricao`, `id_pergunta`) VALUES
(1, 'Autor resposta', '2023-01-10', 'Resposta teste', 1),
(2, 'Matheus ', '2023-01-09', 'Teste resposta 2', 1),
(3, 'Eu', '2023-01-09', 'Xxxxxxxxxxxxsasc saskjdmc\r\nskdnasld~\r\n\r\ndaksmdkasmd', 2),
(4, 'Matheus', '2023-01-16', 'Teste', 2),
(5, 'Teteu', '2023-04-27', 'Melhor que ta em! TESTE EEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE', 4),
(6, 'AUTOR XXX', '2023-04-28', 'RESPONDIDA POR TESTE  TESTE  TESTE  TESTE ', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuarios`
--

CREATE TABLE `tb_usuarios` (
  `usuario_id` int(11) NOT NULL,
  `email` varchar(60) COLLATE latin1_general_cs NOT NULL,
  `senha` varchar(60) COLLATE latin1_general_cs NOT NULL,
  `tipo` set('admin','aluno','prof','') COLLATE latin1_general_cs DEFAULT NULL,
  `excluido` varchar(1) COLLATE latin1_general_cs NOT NULL DEFAULT 'N'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Extraindo dados da tabela `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`usuario_id`, `email`, `senha`, `tipo`, `excluido`) VALUES
(4, 'Jão11@etec.sp.gov.br', '00123', 'aluno', 'N'),
(2, 'm@email', '1', 'aluno', 'N'),
(3, 'Fill12345678899@etec.sp.gov.br', '11111', 'prof', 'N'),
(5, 'Teste99999999999@etec.sp.gov.br', '00000', 'aluno', 'N'),
(6, 'Teste99999999999@etec.sp.gov.br', '00000', 'aluno', 'S'),
(7, 'admin@email', 'admin', 'admin', 'N'),
(8, 'Jão44444444444@etec.sp.gov.br', '00000', 'aluno', 'N'),
(9, 'Jorge24092265824@etec.sp.gov.br', '00000', 'aluno', 'N');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_cursos`
--
ALTER TABLE `tb_cursos`
  ADD PRIMARY KEY (`id_curso`),
  ADD KEY `usuario_id` (`prof_id`);

--
-- Índices para tabela `tb_denuncias`
--
ALTER TABLE `tb_denuncias`
  ADD PRIMARY KEY (`denuncia_id`);

--
-- Índices para tabela `tb_inscricoes`
--
ALTER TABLE `tb_inscricoes`
  ADD PRIMARY KEY (`id_inscricao`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Índices para tabela `tb_interacoes`
--
ALTER TABLE `tb_interacoes`
  ADD PRIMARY KEY (`id_pergunta`);

--
-- Índices para tabela `tb_interesse`
--
ALTER TABLE `tb_interesse`
  ADD PRIMARY KEY (`id_interesse`);

--
-- Índices para tabela `tb_noticias`
--
ALTER TABLE `tb_noticias`
  ADD PRIMARY KEY (`noticia_id`);

--
-- Índices para tabela `tb_oportunidades`
--
ALTER TABLE `tb_oportunidades`
  ADD PRIMARY KEY (`oportunidade_id`);

--
-- Índices para tabela `tb_respostas`
--
ALTER TABLE `tb_respostas`
  ADD PRIMARY KEY (`id_resposta`),
  ADD KEY `id_pergunta` (`id_pergunta`);

--
-- Índices para tabela `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD PRIMARY KEY (`usuario_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_cursos`
--
ALTER TABLE `tb_cursos`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tb_denuncias`
--
ALTER TABLE `tb_denuncias`
  MODIFY `denuncia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tb_inscricoes`
--
ALTER TABLE `tb_inscricoes`
  MODIFY `id_inscricao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `tb_interacoes`
--
ALTER TABLE `tb_interacoes`
  MODIFY `id_pergunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `tb_interesse`
--
ALTER TABLE `tb_interesse`
  MODIFY `id_interesse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `tb_noticias`
--
ALTER TABLE `tb_noticias`
  MODIFY `noticia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `tb_oportunidades`
--
ALTER TABLE `tb_oportunidades`
  MODIFY `oportunidade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tb_respostas`
--
ALTER TABLE `tb_respostas`
  MODIFY `id_resposta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
