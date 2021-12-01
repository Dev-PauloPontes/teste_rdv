
--
-- Database: `teste`
--
CREATE DATABASE IF NOT EXISTS `teste` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `teste`;

-- --------------------------------------------------------

--
-- Table structure for table `bem`
--

DROP TABLE IF EXISTS `bem`;
CREATE TABLE `bem` (
  `id` int(11) UNSIGNED NOT NULL,
  `cliente` int(11) UNSIGNED DEFAULT NULL,
  `contrato` int(11) UNSIGNED DEFAULT NULL,
  `imei` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente` (
  `id` int(11) UNSIGNED NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `apelido` varchar(50) DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `origem` varchar(50) NOT NULL DEFAULT 'RDV'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `contrato`
--

DROP TABLE IF EXISTS `contrato`;
CREATE TABLE `contrato` (
  `id_contrato` int(11) UNSIGNED NOT NULL,
  `cliente` int(11) UNSIGNED NOT NULL,
  `tipo_contrato` int(11) UNSIGNED NOT NULL,
  `desconto` decimal(7,2) NOT NULL DEFAULT '0.00' COMMENT 'Valor desconto integral',
  `desconto_pos` decimal(7,2) NOT NULL DEFAULT '0.00' COMMENT 'Valor desconto posterior meses do contrato',
  `mapa` varchar(10) NOT NULL DEFAULT 'OPEN' COMMENT 'OPEN | GOOGLE',
  `desconto_mapa` char(1) NOT NULL DEFAULT 'N' COMMENT 'Aplicar desconto mapa OPEN ?',
  `valor_desconto_mapa` decimal(7,2) NOT NULL DEFAULT '0.49' COMMENT 'Valor desconto mapa OPEN',
  `data_inicio_contrato` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_inicio_pagamento` timestamp NULL DEFAULT NULL,
  `data_fim_contrato` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tipo_contrato`
--

DROP TABLE IF EXISTS `tipo_contrato`;
CREATE TABLE `tipo_contrato` (
  `id_tipo_contrato` int(11) UNSIGNED NOT NULL,
  `nome_tipo_contrato` varchar(50) NOT NULL,
  `cod_tipo_contrato` varchar(10) NOT NULL,
  `meses` int(2) NOT NULL DEFAULT '0' COMMENT '0 = infinito',
  `valor` decimal(7,2) NOT NULL DEFAULT '0.00',
  `valor_pos` decimal(7,2) NOT NULL DEFAULT '0.00',
  `obs` varchar(255) DEFAULT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_encerramento` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipo_contrato`
--

INSERT INTO `tipo_contrato` (`id_tipo_contrato`, `nome_tipo_contrato`, `cod_tipo_contrato`, `meses`, `valor`, `valor_pos`, `obs`, `data_cadastro`, `data_encerramento`) VALUES
(1, 'Comodato Plano 1 (1 operadora)', 'PLANO1-1OP', 1, '130.90', '11.90', NULL, '2021-11-07 00:18:47', NULL),
(2, 'Comodato Plano 1 (Multi-operadora)', 'PLANO1-MOP', 1, '133.90', '14.90', NULL, '2021-11-07 00:18:47', NULL),
(3, 'Comodato Plano 2 (1 operadora)', 'PLANO2-1OP', 2, '80.90', '11.90', NULL, '2021-11-07 00:18:47', NULL),
(4, 'Comodato Plano 2 (Multi-operadora)', 'PLANO2-MOP', 2, '83.90', '14.90', NULL, '2021-11-07 00:18:47', NULL),
(5, 'Comodato Plano 3 (1 operadora)', 'PLANO3-1OP', 4, '50.90', '11.90', NULL, '2021-11-07 00:18:47', NULL),
(6, 'Comodato Plano 3 (Multi-operadora)', 'PLANO3-MOP', 4, '53.90', '14.90', NULL, '2021-11-07 00:18:47', NULL),
(7, 'Comodato Plano 4 (1 operadora)', 'PLANO4-1OP', 6, '40.90', '11.90', NULL, '2021-11-07 00:18:47', NULL),
(8, 'Comodato Plano 4 (Multi-operadora)', 'PLANO4-MOP', 6, '43.90', '14.90', NULL, '2021-11-07 00:18:47', NULL),
(9, 'Comodato Plano 5 (1 operadora)', 'PLANO5-1OP', 12, '30.90', '11.90', NULL, '2021-11-07 00:18:47', NULL),
(10, 'Comodato Plano 5 (Multi-operadora)', 'PLANO5-MOP', 12, '33.90', '14.90', NULL, '2021-11-07 00:18:47', NULL),
(11, 'Comodato Plano 6 (1 operadora)', 'PLANO6-1OP', 12, '19.90', '11.90', 'R$50,00 de entrada', '2021-11-07 00:18:47', NULL),
(12, 'Comodato Plano 6 (Multi-operadora)', 'PLAN-6-MOP', 12, '22.90', '14.90', 'R$50,00 de entrada', '2021-11-07 00:18:47', NULL),
(13, 'Plataforma e SimCard (1 operadora)', 'PL-SIM-1OP', 0, '11.90', '11.90', NULL, '2021-11-07 00:18:47', NULL),
(14, 'Plataforma e SimCard (Multi-operadora)', 'PL-SIM-MOP', 0, '14.90', '14.90', NULL, '2021-11-07 00:18:47', NULL),
(15, 'Somente plataforma', 'PLATAFORMA', 0, '3.99', '3.99', NULL, '2021-11-07 00:18:47', NULL),
(16, 'Gratuito', 'GRATUITO', 0, '0.00', '0.00', 'Gratuito com acesso limitado', '2021-11-07 00:18:47', NULL),
(17, 'Parceria (1 mês)', 'PARC-1', 1, '0.00', '3.99', NULL, '2021-11-07 00:18:47', NULL),
(18, 'Parceria (3 meses)', 'PARC-3', 3, '0.00', '3.99', NULL, '2021-11-07 00:18:47', NULL),
(19, 'Parceria (6 meses)', 'PARC-6', 6, '0.00', '3.99', NULL, '2021-11-07 00:18:47', NULL),
(20, 'Parceria (12 meses)', 'PARC-12', 12, '0.00', '3.99', NULL, '2021-11-07 00:18:47', NULL),
(21, 'Parceria (18 meses)', 'PARC-18', 18, '0.00', '3.99', NULL, '2021-11-07 00:18:47', NULL),
(22, 'Parceria (24 meses)', 'PARC-24', 24, '0.00', '3.99', NULL, '2021-11-07 00:18:47', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bem`
--
ALTER TABLE `bem`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `imei_index` (`imei`) USING BTREE,
  ADD KEY `cliente_index` (`cliente`),
  ADD KEY `contrato_index` (`contrato`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `apelido_uniq` (`apelido`),
  ADD UNIQUE KEY `cpf_origem_uniq` (`cpf`,`origem`) USING BTREE,
  ADD KEY `origem_index` (`origem`);

--
-- Indexes for table `contrato`
--
ALTER TABLE `contrato`
  ADD PRIMARY KEY (`id_contrato`),
  ADD KEY `tipo_contrato_index` (`tipo_contrato`),
  ADD KEY `cliente_index` (`cliente`);

--
-- Indexes for table `tipo_contrato`
--
ALTER TABLE `tipo_contrato`
  ADD PRIMARY KEY (`id_tipo_contrato`),
  ADD UNIQUE KEY `cod_tipo_contrato_index` (`cod_tipo_contrato`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bem`
--
ALTER TABLE `bem`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contrato`
--
ALTER TABLE `contrato`
  MODIFY `id_contrato` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tipo_contrato`
--
ALTER TABLE `tipo_contrato`
  MODIFY `id_tipo_contrato` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bem`
--
ALTER TABLE `bem`
  ADD CONSTRAINT `bem_ibfk_1` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `bem_ibfk_9` FOREIGN KEY (`contrato`) REFERENCES `contrato` (`id_contrato`);

--
-- Constraints for table `contrato`
--
ALTER TABLE `contrato`
  ADD CONSTRAINT `contrato_ibfk_1` FOREIGN KEY (`tipo_contrato`) REFERENCES `tipo_contrato` (`id_tipo_contrato`),
  ADD CONSTRAINT `contrato_ibfk_2` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`id`);
