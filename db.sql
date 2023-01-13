-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13-Jan-2023 às 14:55
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `loja_site`
--
CREATE DATABASE IF NOT EXISTS `loja_site` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `loja_site`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `itensvenda`
--

DROP TABLE IF EXISTS `itensvenda`;
CREATE TABLE `itensvenda` (
  `id` int(11) NOT NULL,
  `idvenda` varchar(10) NOT NULL,
  `idproduto` varchar(10) NOT NULL,
  `qtd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `itensvenda`
--

INSERT INTO `itensvenda` (`id`, `idvenda`, `idproduto`, `qtd`) VALUES
(1, '12', '1', 18),
(2, '12', '2', 1),
(3, '13', '1', 18),
(4, '13', '2', 2),
(5, '13', '3', 1),
(6, '14', '1', 19),
(7, '14', '2', 2),
(8, '14', '3', 2),
(9, '15', '1', 1),
(10, '16', '1', 2),
(11, '17', '1', 1),
(12, '18', '1', 1),
(13, '19', '1', 1),
(14, '20', '1', 1),
(15, '21', '1', 1),
(16, '22', '2', 1),
(17, '23', '2', 1),
(18, '23', '1', 2),
(19, '23', '3', 1),
(20, '24', '1', 1),
(21, '25', '1', 2),
(22, '26', '1', 1),
(23, '27', '1', 1),
(24, '28', '1', 1),
(25, '29', '1', 1),
(26, '30', '1', 1),
(27, '31', '1', 1),
(28, '32', '1', 1),
(29, '33', '1', 1),
(30, '34', '1', 1),
(31, '35', '1', 1),
(32, '36', '1', 1),
(33, '37', '2', 1),
(34, '38', '1', 1),
(35, '39', '1', 1),
(36, '39', '2', 1),
(37, '40', '1', 1),
(38, '40', '2', 1),
(39, '41', '1', 1),
(40, '42', '2', 1),
(41, '43', '1', 3),
(42, '43', '2', 2),
(43, '44', '1', 1),
(44, '44', '2', 1),
(45, '45', '2', 1),
(46, '46', '2', 1),
(47, '47', '1', 1),
(48, '48', '1', 1),
(49, '49', '1', 1),
(50, '50', '1', 1),
(51, '51', '1', 1),
(52, '52', '1', 1),
(53, '53', '1', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `oferta` double NOT NULL,
  `descricao` varchar(500) NOT NULL,
  `imagem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `preco`, `oferta`, `descricao`, `imagem`) VALUES
(1, 'Tv', '1000.00', 10, 'Smart TV 55” 4K LED TCL 55P635 VA Wi-Fi - Bluetooth HDR Google Assistente 3 HDMI 1 USB', 'tv.jpg'),
(2, 'Geladeira', '2000.00', 5, 'Geladeira/Refrigerador Panasonic Frost Free Duplex - Aço Escovado 387L Top Freezer NR-BT41PD1XA', 'geladeira.jpg'),
(3, 'Computador', '1500.00', 15, 'Notebook Gamer Acer Nitro 5 AN517-54-55T5 Intel Core i5 Windows 11 Home 8GB 512GB SSD GTX 1650 17.3\'', 'computador.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `venda`
--

DROP TABLE IF EXISTS `venda`;
CREATE TABLE `venda` (
  `id` int(11) NOT NULL,
  `valor` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `venda`
--

INSERT INTO `venda` (`id`, `valor`) VALUES
(1, 10000),
(2, 10000),
(3, 10000),
(4, 20000),
(5, 20000),
(6, 20000),
(7, 20000),
(8, 20000),
(9, 20000),
(10, 20000),
(11, 20000),
(12, 20000),
(13, 23500),
(14, 26000),
(15, 1000),
(16, 2000),
(17, 1000),
(18, 1000),
(19, 1000),
(20, 1000),
(21, 1000),
(22, 2000),
(23, 5500),
(24, 1000),
(25, 2000),
(26, 1000),
(27, 1000),
(28, 1000),
(29, 1000),
(30, 1000),
(31, 1000),
(32, 1000),
(33, 1000),
(34, 1000),
(35, 1000),
(36, 1000),
(37, 2000),
(38, 1000),
(39, 3000),
(40, 3000),
(41, 1000),
(42, 2000),
(43, 7000),
(44, 3000),
(45, 2000),
(46, 2000),
(47, 1000),
(48, 1000),
(49, 1000),
(50, 1000),
(51, 1000),
(52, 1000),
(53, 1000);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `itensvenda`
--
ALTER TABLE `itensvenda`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `venda`
--
ALTER TABLE `venda`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `itensvenda`
--
ALTER TABLE `itensvenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `venda`
--
ALTER TABLE `venda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
