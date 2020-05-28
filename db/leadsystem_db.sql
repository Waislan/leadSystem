-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 09-Mar-2020 às 19:02
-- Versão do servidor: 5.7.26
-- versão do PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `leadsystem_db`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` bigint(11) NOT NULL AUTO_INCREMENT,
  `email_admin` varchar(45) NOT NULL,
  `senha_admin` varchar(100) NOT NULL,
  `nome_admin` varchar(45) NOT NULL,
  `login_admin` varchar(20) NOT NULL,
  `master_admin` enum('true','false') NOT NULL,
  PRIMARY KEY (`id_admin`),
  UNIQUE KEY `login_admin` (`login_admin`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `admin`
--

INSERT INTO `admin` (`id_admin`, `email_admin`, `senha_admin`, `nome_admin`, `login_admin`, `master_admin`) VALUES
(3, 'waislanluis@gmail.com', 'e73e45bd84ea9dfec3bd85f67cf04e8e', 'Waislan Sanches', 'waislan', 'true'),
(8, 'ze123456@gmail.com', 'fd6a7b4da9eda9ebc857dd599ec2b7ce', 'ZÃ© Pilintra', 'ze123456', 'true'),
(7, 'exu12345@dmail.com', '87feb10c9b14406284608b78152795d6', 'Exu da Meia Noite', 'exu', 'false');

-- --------------------------------------------------------

--
-- Estrutura da tabela `campos_obrigatorios`
--

DROP TABLE IF EXISTS `campos_obrigatorios`;
CREATE TABLE IF NOT EXISTS `campos_obrigatorios` (
  `id_registro` int(1) NOT NULL,
  `campo_nome` enum('true','false') NOT NULL,
  `campo_email` enum('true','false') NOT NULL,
  `campo_telefone` enum('true','false') NOT NULL,
  `campo_cep` enum('true','false') NOT NULL,
  `campo_endereco` enum('true','false') NOT NULL,
  `campo_numero` enum('true','false') NOT NULL,
  `campo_bairro` enum('true','false') NOT NULL,
  `campo_cidade` enum('true','false') NOT NULL,
  PRIMARY KEY (`id_registro`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `campos_obrigatorios`
--

INSERT INTO `campos_obrigatorios` (`id_registro`, `campo_nome`, `campo_email`, `campo_telefone`, `campo_cep`, `campo_endereco`, `campo_numero`, `campo_bairro`, `campo_cidade`) VALUES
(1, 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cep`
--

DROP TABLE IF EXISTS `cep`;
CREATE TABLE IF NOT EXISTS `cep` (
  `id_cep` bigint(11) NOT NULL AUTO_INCREMENT,
  `cep` int(8) UNSIGNED ZEROFILL NOT NULL,
  PRIMARY KEY (`id_cep`),
  UNIQUE KEY `unique` (`cep`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cep`
--

INSERT INTO `cep` (`id_cep`, `cep`) VALUES
(1, 15210000),
(2, 37701336),
(3, 37701331),
(4, 37701332),
(5, 37701333),
(6, 15210001),
(7, 15210002),
(8, 15210003),
(9, 15210004);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pesquisas`
--

DROP TABLE IF EXISTS `pesquisas`;
CREATE TABLE IF NOT EXISTS `pesquisas` (
  `id_pesquisa` bigint(11) NOT NULL AUTO_INCREMENT,
  `nome_usuario` varchar(45) NOT NULL,
  `email_usuario` varchar(45) NOT NULL,
  `telefone_usuario` varchar(15) NOT NULL,
  `cep` char(8) NOT NULL,
  `endereco` varchar(45) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `bairro` varchar(45) NOT NULL,
  `cidade` varchar(45) NOT NULL,
  `data` char(10) NOT NULL,
  `viavel` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_pesquisa`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pesquisas`
--

INSERT INTO `pesquisas` (`id_pesquisa`, `nome_usuario`, `email_usuario`, `telefone_usuario`, `cep`, `endereco`, `numero`, `bairro`, `cidade`, `data`, `viavel`) VALUES
(1, 'Teste1', 'teste1@gmail.com', '(11) 11111-1111', '15210000', 'Teste1', '1', '', 'Nova AlianÃ§a', '2020-03-07', 0),
(2, 'Teste2', 'teste2@gmail.com', '(22) 22222-2222', '15210000', 'Teste1', '1', '', 'Nova AlianÃ§a', '2020-03-07', 0),
(4, 'Teste3', 'teste3@gmail.com', '(33) 33333-3333', '15210000', 'Teste3', '3', 'Teste3', '', '2020-03-07', 0),
(5, 'Teste3', 'teste3@gmail.com', '(33) 33333-3333', '15210000', 'Teste3', '', 'Teste3', '', '2020-03-07', 0),
(6, 'Teste3', 'teste3@gmail.com', '(33) 33333-3333', '15210000', 'Teste3', '', 'Teste3', '', '2020-03-07', 0),
(7, 'Teste4', 'teste4@gmail.com', '(44) 44444-4444', '15210000', 'Teste4', '4', 'Teste4', 'Teste4', '2020-03-07', 1),
(8, 'Teste5', 'teste5@gmail.com', '(55) 55555-5555', '15210000', 'Teste5', '5', 'Teste5', 'Nova AlianÃ§a', '2020-03-07', 1),
(9, 'Teste6', 'teste6@gmail.com', '(66) 66666-6666', '37701336', 'Rua Doutor Wilson Rafael Danza', '6', 'SÃ£o Geraldo', 'PoÃ§os de Caldas', '2020-03-07', 0),
(10, 'Teste7', 'teste7@gmail.com', '(77) 77777-7777', '37701337', 'Rua Carmo Lamana', '7', 'SÃ£o Geraldo', 'PoÃ§os de Caldas', '2020-03-07', 0),
(11, 'Teste8', 'teste8@gmail.com', '(88) 88888-8888', '37701338', 'Rua Gabriel Rodrigues Martins', '8', 'SÃ£o Geraldo', 'PoÃ§os de Caldas', '2020-03-07', 0),
(12, 'Teste9', 'teste9@gmail.com', '(99) 99999-9999', '37701339', 'Rua JoÃ£o Bueno BrandÃ£o', '9', 'SÃ£o Geraldo', 'PoÃ§os de Caldas', '2020-03-07', 0),
(13, 'Teste10', 'teste10@gmail.com', '(17) 99268-6677', '37701336', 'Teste10', '10', 'Teste10', 'Teste10', '2020-03-04', 0),
(15, 'Teste11', 'teste11@gmail.com', '(17) 99268-6677', '15210000', 'Teste11', '11', 'Teste11', 'Teste11', '2020-03-01', 1),
(17, 'teste6', 'teste6@teste6.com', '(66) 66666-6666', '99999999', 'teste6', '6', 'teste6', 'teste6', '2020-03-07', 0),
(18, 'Teste12', 'teste12@gmail.com', '(12) 12121-2121', '37701330', 'Rua Iguatimara', '12', 'Vila Iguatimara e FÃ¡tima', 'PoÃ§os de Caldas', '2020-03-07', 0),
(19, 'Teste13', 'teste13@gmail.com', '(13) 13131-3131', '37701336', 'Rua Doutor Wilson Rafael Danza', '13', 'SÃ£o Geraldo', 'PoÃ§os de Caldas', '2020-03-07', 1),
(20, 'teste14', 'teste14@gmail.com', '(14) 14141-1414', '14141414', 'teste14', '14', 'teste14', 'teste14', '2020-03-07', 0),
(21, 'teste15', 'teste15@gmail.com', '(15) 15151-1515', '15151515', 'teste15', '15', 'teste15', 'teste15', '2020-03-07', 1),
(22, 'Teste16', 'teste16@gmail.com', '(16) 16161-6161', '37701338', '...', '16', '...', '...', '2020-03-07', 0),
(23, 'Teste17', 'teste17@gmail.com', '(17) 1717-1717', '37701338', 'Rua JoÃ£o Bueno BrandÃ£o', '17', 'SÃ£o Geraldo', 'PoÃ§os de Caldas', '2020-03-07', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `redirecionamento`
--

DROP TABLE IF EXISTS `redirecionamento`;
CREATE TABLE IF NOT EXISTS `redirecionamento` (
  `id_registro` int(1) NOT NULL AUTO_INCREMENT,
  `url` varchar(45) NOT NULL,
  PRIMARY KEY (`id_registro`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `redirecionamento`
--

INSERT INTO `redirecionamento` (`id_registro`, `url`) VALUES
(1, 'www.youtube.com/');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
