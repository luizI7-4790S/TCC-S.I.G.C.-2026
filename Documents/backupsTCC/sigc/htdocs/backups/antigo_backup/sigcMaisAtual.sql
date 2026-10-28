-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 29/06/2026 às 00:37
-- Versão do servidor: 8.4.7
-- Versão do PHP: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sigc`
--
CREATE DATABASE IF NOT EXISTS `sigc` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `sigc`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `administrador`
--

DROP TABLE IF EXISTS `administrador`;
CREATE TABLE IF NOT EXISTS `administrador` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuario` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tema` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `administrador`
--

INSERT INTO `administrador` (`id`, `nome`, `usuario`, `senha`, `tema`) VALUES
(1, 'Luiz Felipe\r\n', 'luiz', '$2y$10$jv7Y5f7pK41vnL8QAqgCfuVEa6cnW2ujH13tQ/rkYpjy0epaTBZTW', 'azulEscuro'),
(2, 'admin', 'admin@gmail.com', '$2y$10$axzVjbWG79QS69z7abwqeOU3/DCsg1fdhL7uxWnuQ34uyy7bWb4q2', 'verdeEscuro'),
(3, 'Luiz Felipe Leges', 'luizfelipeferruolileges@gmail.com', '$2y$10$.6VXbK71SW1nhbiMw45zBe2YahSSJPxc44pFAUwMc63NI1bUtNM.a', 'rosaEscuro'),
(4, 'Eliane Ferrioli Leges', 'eliane.ferrolino@gmail.com', '$2y$10$4WffE613wfdy8k/yBVK3uujREvU8WrOAg0P0aOjLMdDGPTaGQiVL6', 'rosaClaro'),
(5, 'Luizzz', 'luiz1', '$2y$10$c8cdeWiTlT.ceJrnoE1jiOlnPihBoY71fso/cUNtXZJBdcOy375Yq', 'azulEscuro'),
(6, 'Kassiano', 'kassiano', '$2y$10$/NMuJU00/zLfSGzGXz2RS.t7DuMD3XfAs/lNKI6ukEsaOv3qJBYL.', 'rosaClaro'),
(7, 'Anderson Leges', 'anderson', '$2y$10$//qU391994nDtJBSXlYXV.YUlt4lo950WfPwP2dDaRAY6KEWVu9nO', 'azulClaro');

-- --------------------------------------------------------

--
-- Estrutura para tabela `aluno`
--

DROP TABLE IF EXISTS `aluno`;
CREATE TABLE IF NOT EXISTS `aluno` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nome_guerra` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estagiando` tinyint(1) DEFAULT NULL,
  `monitor` tinyint(1) DEFAULT NULL,
  `graduacao` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero` int DEFAULT NULL,
  `nota_provao` decimal(5,2) DEFAULT NULL,
  `id_pelotao` int DEFAULT NULL,
  `id_mensalidade` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pelotao` (`id_pelotao`),
  KEY `fk_aluno_mensalidade` (`id_mensalidade`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `aluno`
--

INSERT INTO `aluno` (`id`, `nome`, `nome_guerra`, `estagiando`, `monitor`, `graduacao`, `numero`, `nota_provao`, `id_pelotao`, `id_mensalidade`) VALUES
(1, 'Juliana Leges', 'J. Leges', 0, 0, 'Sargento', 417, 97.00, 1, 0),
(2, 'Rodrigo Silveira', 'Silveira', 0, 0, 'Tenente', 83, 47.00, 1, 0),
(3, 'Enzo Meireles', 'Meireles', 0, 0, 'Soldado', 12, 0.00, 1, 0),
(4, 'Luiz Felipe Leges', 'Leges', 1, 1, '1 Tenente', 40, 100.00, 3, 0),
(5, 'Juliana Ferrioli Leges', 'J. Leges', 0, 0, '2 Sargento', 417, 100.00, 2, 0),
(6, 'Luis Antônio Ferreira', 'Ferreira', 1, 0, 'Capitão', NULL, 79.00, 3, 0),
(7, 'Carlos Augusto Silva', 'Silva', 0, 1, 'Tenente', NULL, 85.00, 1, 1),
(8, 'Mariana Costa Ribeiro', 'Ribeiro', 1, 0, 'Major', NULL, 92.00, 2, 0),
(9, 'Roberto Almeida Santos', 'Almeida', 0, 0, 'Capitão', NULL, 68.00, 3, 2),
(10, 'Ana Beatriz Oliveira', 'Oliveira', 1, 1, 'Tenente', NULL, 74.00, 1, 0),
(11, 'Fernando Souza Lima', 'Souza', 0, 0, 'Coronel', NULL, 81.00, 4, 3),
(12, 'Juliana Mendes Pereira', 'Mendes', 1, 0, 'Major', NULL, 89.00, 2, 0),
(13, 'Ricardo Jorge Rocha', 'Rocha', 0, 1, 'Capitão', NULL, 95.00, 3, 1),
(14, 'Camila Antunes Dias', 'Dias', 1, 1, 'Tenente', NULL, 63.00, 1, 0),
(15, 'Lucas Gabriel Martins', 'Martins', 0, 0, 'Major', NULL, 77.00, 2, 4),
(16, 'Amanda Vieira Gomes', 'Vieira', 1, 0, 'Capitão', NULL, 88.00, 3, 0),
(17, 'Bruno César Carvalho', 'Carvalho', 0, 1, 'Tenente', NULL, 71.00, 1, 2),
(18, 'Larissa Lopes Ferreira', 'Lopes', 1, 0, 'Coronel', NULL, 90.00, 4, 0),
(19, 'Thiago Henrique Ramos', 'Ramos', 0, 0, 'Major', NULL, 65.00, 2, 1),
(20, 'Bárbara Cristina Cruz', 'Cruz', 1, 1, 'Capitão', NULL, 83.00, 3, 0),
(21, 'Gabriel Vinícius Moza', 'Moza', 0, 0, 'Tenente', NULL, 79.00, 1, 3),
(22, 'Letícia Maria Cardozo', 'Cardozo', 1, 0, 'Major', NULL, 96.00, 2, 0),
(23, 'Rodrigo Otávio Neves', 'Neves', 0, 1, 'Capitão', NULL, 72.00, 3, 2),
(24, 'Patrícia Helen Barbosa', 'Barbosa', 1, 1, 'Tenente', NULL, 87.00, 1, 0),
(25, 'Marcelo Augusto Nunes', 'Nunes', 0, 0, 'Coronel', NULL, 84.00, 4, 4),
(26, 'Danielle Priscila Reis', 'Reis', 1, 0, 'Major', NULL, 70.00, 2, 0),
(27, 'Felipe Fontes Machado', 'Machado', 0, 1, 'Capitão', NULL, 91.00, 3, 1),
(28, 'Aline de Souza Castro', 'Castro', 1, 1, 'Tenente', NULL, 76.00, 1, 0),
(29, 'Gustavo Borges Duarte', 'Duarte', 0, 0, 'Major', NULL, 69.00, 2, 3),
(30, 'Vanessa Kelly Franco', 'Franco', 1, 0, 'Capitão', NULL, 82.00, 3, 0),
(31, 'Leonardo Assis Fonseca', 'Fonseca', 0, 1, 'Tenente', NULL, 94.00, 1, 2),
(32, 'Isabela Cristina Cunha', 'Cunha', 1, 0, 'Coronel', NULL, 80.00, 4, 0),
(33, 'Eduardo Antunes Pires', 'Pires', 0, 0, 'Major', NULL, 62.00, 2, 1),
(34, 'Beatriz Regina Sales', 'Sales', 1, 1, 'Capitão', NULL, 86.00, 3, 0),
(35, 'Maurício José Teixeira', 'Teixeira', 0, 0, 'Tenente', NULL, 75.00, 1, 4),
(36, 'Tatiane Soares Moura', 'Moura', 1, 0, 'Major', NULL, 89.00, 2, 0),
(37, 'Renato Pinheiro Guimarães', 'Guimarães', 0, 1, 'Capitão', NULL, 93.00, 3, 2),
(38, 'Priscila Fontoura Melo', 'Melo', 1, 1, 'Tenente', NULL, 67.00, 1, 0),
(39, 'Alexandre Viana Morais', 'Morais', 0, 0, 'Coronel', NULL, 78.00, 4, 3),
(40, 'Caroline Marques farias', 'Farias', 1, 0, 'Major', NULL, 91.00, 2, 0),
(41, 'André Luiz Nogueira', 'Nogueira', 0, 1, 'Capitão', NULL, 85.00, 3, 1),
(42, 'Débora Regina Xavier', 'Xavier', 1, 1, 'Tenente', NULL, 73.00, 1, 0),
(43, 'Sérgio Murilo Peixoto', 'Peixoto', 0, 0, 'Major', NULL, 64.00, 2, 2),
(44, 'Natalia Silva Aragão', 'Aragão', 1, 0, 'Capitão', NULL, 88.00, 3, 0),
(45, 'Vinícius Costa Vilela', 'Vilela', 0, 1, 'Tenente', NULL, 97.00, 1, 4),
(46, 'Camila Roberta Miranda', 'Miranda', 1, 0, 'Coronel', NULL, 81.00, 4, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `aluno_administrador`
--

DROP TABLE IF EXISTS `aluno_administrador`;
CREATE TABLE IF NOT EXISTS `aluno_administrador` (
  `id_aluno` int NOT NULL,
  `id_adm` int NOT NULL,
  PRIMARY KEY (`id_aluno`,`id_adm`),
  KEY `id_adm` (`id_adm`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `anotacao`
--

DROP TABLE IF EXISTS `anotacao`;
CREATE TABLE IF NOT EXISTS `anotacao` (
  `id` int NOT NULL AUTO_INCREMENT,
  `texto` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `titulo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `arquivo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_criacao` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `anotacao_administrador`
--

DROP TABLE IF EXISTS `anotacao_administrador`;
CREATE TABLE IF NOT EXISTS `anotacao_administrador` (
  `id_anotacao` int NOT NULL,
  `id_adm` int NOT NULL,
  PRIMARY KEY (`id_anotacao`,`id_adm`),
  KEY `id_adm` (`id_adm`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `arrecadacao`
--

DROP TABLE IF EXISTS `arrecadacao`;
CREATE TABLE IF NOT EXISTS `arrecadacao` (
  `id` int NOT NULL AUTO_INCREMENT,
  `valor` decimal(10,2) DEFAULT NULL,
  `mes` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_mensalidade` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_mensalidade` (`id_mensalidade`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `arrecadacao_administrador`
--

DROP TABLE IF EXISTS `arrecadacao_administrador`;
CREATE TABLE IF NOT EXISTS `arrecadacao_administrador` (
  `id_arrecadacao` int NOT NULL,
  `id_adm` int NOT NULL,
  PRIMARY KEY (`id_arrecadacao`,`id_adm`),
  KEY `id_adm` (`id_adm`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `mensalidade`
--

DROP TABLE IF EXISTS `mensalidade`;
CREATE TABLE IF NOT EXISTS `mensalidade` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_aluno` int NOT NULL,
  `mes_referencia` tinyint NOT NULL,
  `ano_referencia` smallint NOT NULL,
  `valor_base` decimal(10,2) NOT NULL,
  `valor_pago` decimal(10,2) NOT NULL,
  `data_pagamento` date NOT NULL,
  `observacao` text COLLATE utf8mb4_unicode_ci,
  `metodo_pagamento` enum('Dinheiro','PIX','Cartão','Transferência') COLLATE utf8mb4_unicode_ci NOT NULL,
  `arquivado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_aluno` (`id_aluno`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `mensalidade_administrador`
--

DROP TABLE IF EXISTS `mensalidade_administrador`;
CREATE TABLE IF NOT EXISTS `mensalidade_administrador` (
  `id_mensalidade` int NOT NULL,
  `id_adm` int NOT NULL,
  PRIMARY KEY (`id_mensalidade`,`id_adm`),
  KEY `id_adm` (`id_adm`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pelotao`
--

DROP TABLE IF EXISTS `pelotao`;
CREATE TABLE IF NOT EXISTS `pelotao` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantia_alunos` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `pelotao`
--

INSERT INTO `pelotao` (`id`, `nome`, `quantia_alunos`) VALUES
(1, 'Cobra', 0),
(2, 'Águia', 0),
(3, 'Tigre', 0),
(4, 'Leão', 0),
(5, 'Falcão', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pelotao_administrador`
--

DROP TABLE IF EXISTS `pelotao_administrador`;
CREATE TABLE IF NOT EXISTS `pelotao_administrador` (
  `id_pel` int NOT NULL,
  `id_adm` int NOT NULL,
  PRIMARY KEY (`id_pel`,`id_adm`),
  KEY `id_adm` (`id_adm`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `responsavel`
--

DROP TABLE IF EXISTS `responsavel`;
CREATE TABLE IF NOT EXISTS `responsavel` (
  `id` int NOT NULL AUTO_INCREMENT,
  `telefone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nome` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_aluno` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_aluno` (`id_aluno`)
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `responsavel`
--

INSERT INTO `responsavel` (`id`, `telefone`, `nome`, `id_aluno`) VALUES
(13, '(55) 99939-7329', 'Eliane Ferrioli Leges', 0),
(18, '(55) 99876-5432', 'Sandra Regina Costa', 2),
(17, '(55) 99123-4567', 'Marcos Roberto Silva', 1),
(16, '1313131313 L', 'Lucas Molaine', 0),
(20, '(53) 99222-3344', 'Patrícia Souza Oliveira', 4),
(21, '(55) 98444-5566', 'Jeferson Lima Santos', 5),
(22, '(54) 99333-4455', 'Cláudia Mendes Pereira', 6),
(23, '(55) 99666-7788', 'Luiz Fernando Rocha', 0),
(24, '(51) 98777-8899', 'Regina Antunes Dias', 8),
(25, '(55) 99111-4444', 'Ricardo Jorge Martins', 9),
(26, '(53) 98222-5555', 'Sônia Vieira Gomes', 10),
(27, '(54) 99333-6666', 'Paulo César Carvalho', 11),
(28, '(55) 98444-7777', 'Maria Lopes Ferreira', 12),
(31, '(53) 99777-0000', 'Jorge Vinícius Moza', 15),
(32, '(54) 98888-1111', 'Lúcia Maria Cardozo', 16),
(33, '(55) 99999-2222', 'Sérgio Otávio Neves', 17),
(34, '(51) 99111-3333', 'Helena Barbosa Reis', 18),
(35, '(55) 98222-4444', 'Marcelo Augusto Nunes', 19),
(36, '(53) 99333-5555', 'Priscila Fontes Castro', 20),
(37, '(54) 98444-6666', 'Fernando Machado Silva', 21),
(39, '(51) 98666-8888', 'Gustavo Borges Franco', 23),
(40, '(53) 99777-9999', 'Vanessa Kelly Fonseca', 24),
(41, '(54) 98888-0000', 'Leonardo Assis Cunha', 25),
(42, '(55) 99999-1111', 'Isabela Cristina Pires', 26),
(43, '(51) 99222-3333', 'Eduardo Antunes Sales', 27),
(45, '(53) 99444-5555', 'Maurício José Moura', 29),
(46, '(54) 98555-6666', 'Tatiane Soares Guimarães', 30),
(47, '(55) 99666-7777', 'Renato Pinheiro Melo', 31),
(48, '(51) 98777-8888', 'Fátima Fontoura Morais', 32),
(50, '(54) 98999-0000', 'Caroline Marques Nogueira', 34),
(52, '(51) 99233-4455', 'Débora Regina Peixoto', 36),
(53, '(55) 99344-5566', 'Sérgio Murilo Aragão', 37),
(54, '(53) 99455-6677', 'Natalia Silva Vilela', 38),
(55, '(54) 99566-7788', 'Vinícius Costa Miranda', 39);

-- --------------------------------------------------------

--
-- Estrutura para tabela `responsavel_administrador`
--

DROP TABLE IF EXISTS `responsavel_administrador`;
CREATE TABLE IF NOT EXISTS `responsavel_administrador` (
  `id_resp` int NOT NULL,
  `id_adm` int NOT NULL,
  PRIMARY KEY (`id_resp`,`id_adm`),
  KEY `id_adm` (`id_adm`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
