-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01-Dez-2021 às 18:56
-- Versão do servidor: 10.4.14-MariaDB
-- versão do PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `teste`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `bem`
--

CREATE TABLE `bem` (
  `id` int(11) UNSIGNED NOT NULL,
  `cliente` int(11) UNSIGNED DEFAULT NULL,
  `contrato` int(11) UNSIGNED DEFAULT NULL,
  `imei` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `bem`
--

INSERT INTO `bem` (`id`, `cliente`, `contrato`, `imei`) VALUES
(1, 1, 2, '55555555'),
(2, 1, 6, '666666'),
(3, 2, 2, '7777777'),
(4, 2, NULL, '8888888'),
(5, 3, 5, '9999999'),
(6, 1, 4, '21212121'),
(7, 3, 3, '32323232'),
(8, 2, NULL, '54545444'),
(9, 3, 8, '787878787'),
(10, 3, 7, '96969666'),
(11, 3, 10, '10100100'),
(12, 2, 11, '88222222'),
(13, 2, NULL, '8833333'),
(14, 2, 11, '88555555'),
(15, 2, NULL, '8866666'),
(16, 2, NULL, '8877777'),
(17, 2, NULL, '8899999'),
(18, 2, NULL, '8844444'),
(19, 2, NULL, '8811111'),
(20, 2, NULL, '8800000');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) UNSIGNED NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `apelido` varchar(50) DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `origem` varchar(50) NOT NULL DEFAULT 'RDV'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id`, `nome`, `apelido`, `cpf`, `origem`) VALUES
(1, 'joão', 'j', '222', 'RDV'),
(2, 'pedro', 'p', '555', 'RDV'),
(3, 'maria', 'm', '888', 'RDV');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contrato`
--

CREATE TABLE `contrato` (
  `id_contrato` int(11) UNSIGNED NOT NULL,
  `cliente` int(11) UNSIGNED NOT NULL,
  `tipo_contrato` int(11) UNSIGNED NOT NULL,
  `desconto` decimal(7,2) NOT NULL DEFAULT 0.00 COMMENT 'Valor desconto integral',
  `desconto_pos` decimal(7,2) NOT NULL DEFAULT 0.00 COMMENT 'Valor desconto posterior meses do contrato',
  `mapa` varchar(10) NOT NULL DEFAULT 'OPEN' COMMENT 'OPEN | GOOGLE',
  `desconto_mapa` char(1) NOT NULL DEFAULT 'N' COMMENT 'Aplicar desconto mapa OPEN ?',
  `valor_desconto_mapa` decimal(7,2) NOT NULL DEFAULT 0.49 COMMENT 'Valor desconto mapa OPEN',
  `data_inicio_contrato` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_inicio_pagamento` timestamp NULL DEFAULT NULL,
  `data_fim_contrato` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `contrato`
--

INSERT INTO `contrato` (`id_contrato`, `cliente`, `tipo_contrato`, `desconto`, `desconto_pos`, `mapa`, `desconto_mapa`, `valor_desconto_mapa`, `data_inicio_contrato`, `data_inicio_pagamento`, `data_fim_contrato`) VALUES
(1, 1, 21, '15.00', '8.00', 'OPEN', 'S', '0.49', '2021-11-19 12:04:00', '2021-11-19 03:00:00', '2021-11-30 03:00:00'),
(2, 1, 5, '10.02', '2.25', 'GOOGLE', 'N', '0.49', '2021-11-19 12:04:14', '2021-11-24 03:00:00', NULL),
(3, 3, 13, '10.00', '90.00', 'OPEN', 'S', '0.49', '2021-11-19 12:04:24', '2021-11-19 03:00:00', '2021-11-27 03:00:00'),
(4, 1, 9, '94.35', '89.50', 'GOOGLE', 'S', '3.00', '2021-11-19 12:04:00', '2021-11-29 03:00:00', NULL),
(5, 3, 2, '2.00', '3.00', 'GOOGLE', 'S', '0.49', '2021-11-24 14:10:02', '2021-11-11 03:00:00', NULL),
(6, 2, 4, '5.01', '6.67', 'OPEN', 'S', '1.18', '2021-11-24 14:28:51', '2021-11-04 03:00:00', NULL),
(7, 3, 8, '2.00', '1.00', 'GOOGLE', 'S', '0.00', '2021-11-25 12:01:58', '2021-11-09 03:00:00', NULL),
(8, 3, 7, '4.00', '2.00', 'GOOGLE', 'S', '1.00', '2021-11-25 12:04:49', '2021-11-01 03:00:00', NULL),
(9, 2, 10, '12.22', '10.33', 'GOOGLE', 'S', '1.11', '2021-11-25 18:48:15', '2021-11-10 03:00:00', NULL),
(10, 3, 1, '3.33', '3.33', 'GOOGLE', 'S', '2.22', '2021-11-25 19:10:38', '2021-11-10 03:00:00', NULL),
(11, 2, 11, '10.00', '12.00', 'GOOGLE', 'S', '0.49', '2021-12-01 12:24:48', '2021-12-16 03:00:00', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_contrato`
--

CREATE TABLE `tipo_contrato` (
  `id_tipo_contrato` int(11) UNSIGNED NOT NULL,
  `nome_tipo_contrato` varchar(50) NOT NULL,
  `cod_tipo_contrato` varchar(10) NOT NULL,
  `meses` int(2) NOT NULL DEFAULT 0 COMMENT '0 = infinito',
  `valor` decimal(7,2) NOT NULL DEFAULT 0.00,
  `valor_pos` decimal(7,2) NOT NULL DEFAULT 0.00,
  `obs` varchar(255) DEFAULT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_encerramento` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tipo_contrato`
--

INSERT INTO `tipo_contrato` (`id_tipo_contrato`, `nome_tipo_contrato`, `cod_tipo_contrato`, `meses`, `valor`, `valor_pos`, `obs`, `data_cadastro`, `data_encerramento`) VALUES
(1, 'Comodato Plano 1 (1 operadora)', 'PLANO1-1OP', 1, '130.90', '11.90', NULL, '2021-11-07 03:18:47', NULL),
(2, 'Comodato Plano 1 (Multi-operadora)', 'PLANO1-MOP', 1, '133.90', '14.90', '', '2021-11-07 03:18:47', NULL),
(4, 'Comodato Plano 2 (Multi-operadora)', 'PLANO2-MOP', 2, '83.90', '14.90', NULL, '2021-11-07 03:18:47', NULL),
(5, 'Comodato Plano 3 (1 operadora)', 'PLANO3-1OP', 4, '50.90', '11.90', '', '2021-11-07 03:18:47', NULL),
(7, 'Comodato Plano 4 (1 operadora)', 'PLANO4-1OP', 6, '40.90', '11.90', NULL, '2021-11-07 03:18:47', NULL),
(8, 'Comodato Plano 4 (Multi-operadora)', 'PLANO4-MOP', 6, '43.90', '14.90', NULL, '2021-11-07 03:18:47', NULL),
(9, 'Comodato Plano 5 (1 operadora)', 'PLANO5-1OP', 12, '30.90', '11.90', NULL, '2021-11-07 03:18:47', NULL),
(10, 'Comodato Plano 5 (Multi-operadora)', 'PLANO5-MOP', 12, '33.90', '14.90', NULL, '2021-11-07 03:18:47', NULL),
(11, 'Comodato Plano 6 (1 operadora)', 'PLANO6-1OP', 12, '19.90', '11.90', 'R$50,00 de entrada', '2021-11-07 03:18:47', NULL),
(12, 'Comodato Plano 6 (Multi-operadora)', 'PLAN-6-MOP', 12, '22.90', '14.90', 'R$50,00 de entrada', '2021-11-07 03:18:47', NULL),
(13, 'Plataforma e SimCard (1 operadora)', 'PL-SIM-1OP', 0, '11.90', '11.90', NULL, '2021-11-07 03:18:47', NULL),
(14, 'Plataforma e SimCard (Multi-operadora)', 'PL-SIM-MOP', 0, '14.90', '14.90', NULL, '2021-11-07 03:18:47', NULL),
(15, 'Somente plataforma', 'PLATAFORMA', 0, '3.99', '3.99', '', '2021-11-07 03:18:47', NULL),
(16, 'Gratuito', 'GRATUITO', 0, '0.00', '0.00', 'Gratuito com acesso limitado', '2021-11-07 03:18:47', NULL),
(17, 'Parceria (1 mês)', 'PARC-1', 1, '0.00', '3.99', NULL, '2021-11-07 03:18:47', NULL),
(18, 'Parceria (3 meses)', 'PARC-3', 3, '0.00', '3.99', NULL, '2021-11-07 03:18:47', NULL),
(19, 'Parceria (6 meses)', 'PARC-6', 6, '0.00', '3.99', NULL, '2021-11-07 03:18:47', NULL),
(20, 'Parceria (12 meses)', 'PARC-12', 12, '0.00', '3.99', NULL, '2021-11-07 03:18:47', NULL),
(21, 'Parceria (18 meses)', 'PARC-18', 18, '0.00', '3.99', NULL, '2021-11-07 03:18:47', NULL),
(22, 'Parceria (24 meses)', 'PARC-24', 24, '0.00', '3.99', NULL, '2021-11-07 03:18:47', NULL),
(27, 'A TESTE', 'PARC-1222', 5, '3.99', '2.99', 'DDFDFDF', '2021-11-22 19:07:04', '2021-11-05 03:00:00');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `bem`
--
ALTER TABLE `bem`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `imei_index` (`imei`) USING BTREE,
  ADD KEY `cliente_index` (`cliente`),
  ADD KEY `contrato_index` (`contrato`);

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `apelido_uniq` (`apelido`),
  ADD UNIQUE KEY `cpf_origem_uniq` (`cpf`,`origem`) USING BTREE,
  ADD KEY `origem_index` (`origem`);

--
-- Índices para tabela `contrato`
--
ALTER TABLE `contrato`
  ADD PRIMARY KEY (`id_contrato`),
  ADD KEY `tipo_contrato_index` (`tipo_contrato`),
  ADD KEY `cliente_index` (`cliente`);

--
-- Índices para tabela `tipo_contrato`
--
ALTER TABLE `tipo_contrato`
  ADD PRIMARY KEY (`id_tipo_contrato`),
  ADD UNIQUE KEY `cod_tipo_contrato_index` (`cod_tipo_contrato`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `bem`
--
ALTER TABLE `bem`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `contrato`
--
ALTER TABLE `contrato`
  MODIFY `id_contrato` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `tipo_contrato`
--
ALTER TABLE `tipo_contrato`
  MODIFY `id_tipo_contrato` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `bem`
--
ALTER TABLE `bem`
  ADD CONSTRAINT `bem_ibfk_1` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `bem_ibfk_9` FOREIGN KEY (`contrato`) REFERENCES `contrato` (`id_contrato`);

--
-- Limitadores para a tabela `contrato`
--
ALTER TABLE `contrato`
  ADD CONSTRAINT `contrato_ibfk_1` FOREIGN KEY (`tipo_contrato`) REFERENCES `tipo_contrato` (`id_tipo_contrato`),
  ADD CONSTRAINT `contrato_ibfk_2` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
