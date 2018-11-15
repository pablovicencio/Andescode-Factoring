-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 15-11-2018 a las 18:12:36
-- Versión del servidor: 5.7.23
-- Versión de PHP: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_factoring`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `check_ope`
--

DROP TABLE IF EXISTS `check_ope`;
CREATE TABLE IF NOT EXISTS `check_ope` (
  `ID_OPE` int(11) NOT NULL,
  `ID_GRUPO` int(11) NOT NULL,
  `ID_PARAM` int(11) NOT NULL,
  `OBS_LOG` varchar(200) DEFAULT NULL,
  `VIG_LOG` bit(1) NOT NULL,
  `FEC_LOG` datetime NOT NULL,
  `ID_USU` int(11) DEFAULT NULL,
  KEY `FK_CHECK_OPE_idx` (`ID_OPE`),
  KEY `FK_CHECK_USU_idx` (`ID_USU`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `ID_CLI` int(11) NOT NULL AUTO_INCREMENT,
  `RUT_CLI` varchar(10) DEFAULT NULL,
  `NOM_CLI` varchar(100) DEFAULT NULL,
  `TASA_INICIAL` float DEFAULT NULL,
  `COM_COB_INICIAL` float DEFAULT NULL,
  `COM_CUR_INICIAL` float DEFAULT NULL,
  `APERTURA_INICIAL` int(11) DEFAULT NULL,
  `FEC_CRE_CLI` datetime DEFAULT NULL,
  `USU_CRE_CLI` int(11) DEFAULT NULL,
  `VIG_CLI` bit(1) DEFAULT NULL,
  `PASS_CLI` varchar(32) DEFAULT NULL,
  `MAIL_CLI` varchar(50) DEFAULT NULL,
  `GG_CLI` varchar(50) DEFAULT NULL,
  `GF_CLI` varchar(50) DEFAULT NULL,
  `LINEA_CRED_CLI` bigint(20) DEFAULT NULL,
  `NRO_CTA_CLI` int(11) DEFAULT NULL,
  `BCO_CLI` int(11) DEFAULT NULL,
  `VENC_LIN_CRED_CLI` date DEFAULT NULL,
  PRIMARY KEY (`ID_CLI`),
  UNIQUE KEY `RUT_CLI_UNIQUE` (`RUT_CLI`),
  KEY `FK_USU_CLI_idx` (`USU_CRE_CLI`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`ID_CLI`, `RUT_CLI`, `NOM_CLI`, `TASA_INICIAL`, `COM_COB_INICIAL`, `COM_CUR_INICIAL`, `APERTURA_INICIAL`, `FEC_CRE_CLI`, `USU_CRE_CLI`, `VIG_CLI`, `PASS_CLI`, `MAIL_CLI`, `GG_CLI`, `GF_CLI`, `LINEA_CRED_CLI`, `NRO_CTA_CLI`, `BCO_CLI`, `VENC_LIN_CRED_CLI`) VALUES
(1, '18398111-k', 'Monster INC.', 0.9, 0.3, 50000, 60000, '2018-08-07 23:20:07', 1, b'1', 'bfd59291e825b5f2bbf1eb76569f8fe7', 'pablo.vicencio@correoaiep.cl', 'Sebastian Vicencio', 'Waldo Vicencio', 10000000, 18385191, 2, '2018-12-01'),
(25, '19919852-k', 'sebastian', 0.55, 0.1, 20000, 200, '2018-08-13 11:08:39', 1, b'1', '5e1888248b929ec99553224f4b2f633d', 'pablo.vicencioc@gmail.com', 'goku', 'GOHAN', NULL, NULL, NULL, NULL),
(26, '19911852-k', 'sebastian', 0.55, 0.1, 20000, 200, '2018-08-13 11:08:39', 1, b'1', 'e10adc3949ba59abbe56e057f20f883e', 'pablo.vicencioc@gmail.com', 'goku', 'GOHAN', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

DROP TABLE IF EXISTS `documentos`;
CREATE TABLE IF NOT EXISTS `documentos` (
  `ID_DOC` int(11) NOT NULL AUTO_INCREMENT,
  `RUT_DEU_DOC` varchar(10) DEFAULT NULL,
  `NOM_DEU_DOC` varchar(100) DEFAULT NULL,
  `NRO_DOC` int(11) DEFAULT NULL,
  `MONTO_DOC` bigint(20) DEFAULT NULL,
  `ANTICIPO_DOC` bigint(20) DEFAULT NULL,
  `FEC_OPE_DOC` date DEFAULT NULL,
  `FEC_VEN_DOC` date DEFAULT NULL,
  `PLAZO_DOC` int(11) DEFAULT NULL,
  `FEC_REGI_DOC` datetime DEFAULT NULL,
  `USU_REG_DOC` int(11) DEFAULT NULL,
  `TIPO_DOC` int(11) DEFAULT NULL,
  `EST_DOC` int(11) DEFAULT NULL,
  `ID_OPE` int(11) DEFAULT NULL,
  `MONTO_FINAN_DOC` int(11) DEFAULT NULL,
  `COM_COB_DOC` int(11) DEFAULT NULL,
  `DIF_PRE_DOC` int(11) DEFAULT NULL,
  `ANTICIPO_PORC` int(11) DEFAULT '0',
  PRIMARY KEY (`ID_DOC`),
  KEY `FK_DOC_USU_idx` (`USU_REG_DOC`),
  KEY `FK_DOC_OPE_idx` (`ID_OPE`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `documentos`
--

INSERT INTO `documentos` (`ID_DOC`, `RUT_DEU_DOC`, `NOM_DEU_DOC`, `NRO_DOC`, `MONTO_DOC`, `ANTICIPO_DOC`, `FEC_OPE_DOC`, `FEC_VEN_DOC`, `PLAZO_DOC`, `FEC_REGI_DOC`, `USU_REG_DOC`, `TIPO_DOC`, `EST_DOC`, `ID_OPE`, `MONTO_FINAN_DOC`, `COM_COB_DOC`, `DIF_PRE_DOC`, `ANTICIPO_PORC`) VALUES
(6, '20125899-5', 'factis', 221, 100000, 80, '2018-08-19', '2018-08-31', 16, '2018-08-19 09:08:11', 1, 1, 1, NULL, NULL, NULL, NULL, 0),
(7, '50236895-8', 'nestle', 340, 2551360, 98, '2018-07-18', '2018-08-20', 35, '2018-08-19 09:08:53', 1, 1, 1, NULL, NULL, NULL, NULL, 0),
(8, '18385191-7', 'test', 154, 1000000, 888160, '2018-11-03', '2018-11-30', 32, NULL, 1, 1, 1, 16, 900000, 3200, 8640, 90),
(9, '18385191-7', 'test', 154, 1000000, 888160, '2018-11-03', '2018-11-30', 32, NULL, 1, 1, 1, 17, 900000, 3200, 8640, 90),
(10, '18385191-7', 'test', 154, 1000000, 888160, '2018-11-03', '2018-11-30', 32, NULL, 1, 1, 1, 18, 900000, 3200, 8640, 90),
(11, '18385191-7', 'test', 154, 1000000, 888160, '2018-11-03', '2018-11-30', 32, '2018-11-03 08:57:48', 1, 1, 1, 19, 900000, 3200, 8640, 90),
(12, '7894561-2', 'test', 78, 10000000, 9292100, '2018-11-15', '2018-12-30', 54, '2018-11-15 03:53:20', 1, 1, 1, 20, 9500000, 54000, 153900, 95),
(13, '7894561-2', 'test', 78, 10000000, 9292100, '2018-11-15', '2018-12-30', 54, '2018-11-15 03:54:54', 1, 1, 1, 21, 9500000, 54000, 153900, 95),
(14, '7894561-2', 'test', 78, 10000000, 9292100, '2018-11-15', '2018-12-30', 54, '2018-11-15 04:04:30', 1, 1, 1, 22, 9500000, 54000, 153900, 95),
(15, '7894561-2', 'test', 78, 10000000, 9292100, '2018-11-15', '2018-12-30', 54, '2018-11-15 04:08:18', 1, 1, 1, 23, 9500000, 54000, 153900, 95);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos_ope`
--

DROP TABLE IF EXISTS `gastos_ope`;
CREATE TABLE IF NOT EXISTS `gastos_ope` (
  `ID_GASTO` int(11) NOT NULL AUTO_INCREMENT,
  `NOT_DEUDOR_GASTO` int(11) DEFAULT NULL,
  `ENVIO_CORREO_GASTO` int(11) DEFAULT NULL,
  `PROC_GASTO` int(11) DEFAULT NULL,
  `COPIA_FAC_GASTO` int(11) DEFAULT NULL,
  `SII_CERT_GASTO` int(11) DEFAULT NULL,
  `VIG_GASTO` bit(1) DEFAULT NULL,
  `ID_OPE_GASTO` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_GASTO`),
  KEY `FK_GASTO_OPE_idx` (`ID_OPE_GASTO`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `gastos_ope`
--

INSERT INTO `gastos_ope` (`ID_GASTO`, `NOT_DEUDOR_GASTO`, `ENVIO_CORREO_GASTO`, `PROC_GASTO`, `COPIA_FAC_GASTO`, `SII_CERT_GASTO`, `VIG_GASTO`, `ID_OPE_GASTO`) VALUES
(1, 1000, 1000, 1000, 1000, 1000, b'1', NULL),
(2, 1000, 1000, 1000, 1000, 1000, b'1', NULL),
(3, 1000, 1000, 1000, 1000, 1000, b'1', NULL),
(4, 1000, 1000, 1000, 1000, 1000, b'1', NULL),
(5, 1000, 1000, 1000, 1000, 1000, b'1', NULL),
(6, 1000, 1000, 1000, 1000, 1000, b'1', 13),
(7, 1000, 1000, 1000, 1000, 1000, b'1', 14),
(8, 1000, 1000, 1000, 1000, 1000, b'1', 15),
(9, 1000, 1000, 1000, 1000, 1000, b'1', 16),
(10, 1000, 1000, 1000, 1000, 1000, b'1', 17),
(11, 1000, 1000, 1000, 1000, 1000, b'1', 18),
(12, 1000, 1000, 1000, 1000, 1000, b'1', 19),
(13, 100, 200, 100, 200, 100, b'1', 20),
(14, 100, 200, 100, 200, 100, b'1', 21),
(15, 100, 200, 100, 200, 100, b'1', 22),
(16, 100, 200, 100, 200, 100, b'1', 23);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log_ope`
--

DROP TABLE IF EXISTS `log_ope`;
CREATE TABLE IF NOT EXISTS `log_ope` (
  `id_ope` int(11) DEFAULT NULL,
  `est_ant_ope` int(11) DEFAULT NULL,
  `est_nue_ope` int(11) DEFAULT NULL,
  `obs_log_ope` varchar(250) DEFAULT NULL,
  `id_usu` int(11) DEFAULT NULL,
  `fec_log_ope` datetime DEFAULT NULL,
  KEY `fk_log_ope_idx` (`id_ope`),
  KEY `fk_log_usu_idx` (`id_usu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operaciones`
--

DROP TABLE IF EXISTS `operaciones`;
CREATE TABLE IF NOT EXISTS `operaciones` (
  `ID_OPE` int(11) NOT NULL AUTO_INCREMENT,
  `FEC_OPE` date DEFAULT NULL,
  `USU_OPE` int(11) DEFAULT NULL,
  `TIPO_OPE` int(11) DEFAULT NULL,
  `OBS_OPE` varchar(100) DEFAULT NULL,
  `TASA_OPE` float NOT NULL,
  `COM_COB_OPE` float NOT NULL,
  `COM_CUR_OPE` float NOT NULL,
  `APERTURA_OPE` int(11) NOT NULL,
  `DIA_OPE` int(11) NOT NULL,
  `OTROS_DESC_OPE` int(11) DEFAULT '0',
  `NRO_CTA_DEST_OPE` int(11) DEFAULT NULL,
  `MONTO_GIRO_OPE` int(11) NOT NULL,
  `CLI_OPE` int(11) DEFAULT NULL,
  `BCO_GIRO_OPE` int(11) DEFAULT NULL,
  `BCO_DEP_OPE` int(11) DEFAULT NULL,
  `FEC_REG_OPE` datetime NOT NULL,
  `EST_OPE` int(11) DEFAULT NULL,
  `IVA_COM_COB_OPE` float DEFAULT NULL,
  `IVA_COM_OPE` float DEFAULT NULL,
  PRIMARY KEY (`ID_OPE`),
  KEY `fk_ope_usu_idx` (`USU_OPE`),
  KEY `fk_ope_cli_idx` (`CLI_OPE`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `operaciones`
--

INSERT INTO `operaciones` (`ID_OPE`, `FEC_OPE`, `USU_OPE`, `TIPO_OPE`, `OBS_OPE`, `TASA_OPE`, `COM_COB_OPE`, `COM_CUR_OPE`, `APERTURA_OPE`, `DIA_OPE`, `OTROS_DESC_OPE`, `NRO_CTA_DEST_OPE`, `MONTO_GIRO_OPE`, `CLI_OPE`, `BCO_GIRO_OPE`, `BCO_DEP_OPE`, `FEC_REG_OPE`, `EST_OPE`, `IVA_COM_COB_OPE`, `IVA_COM_OPE`) VALUES
(1, '2018-11-03', 1, 1, ' ', 0.9, 0.3, 50000, 60000, 1, 0, NULL, 900000, 1, NULL, NULL, '2018-11-03 08:29:00', NULL, NULL, NULL),
(2, '2018-11-03', 1, 1, ' ', 0.9, 0.3, 50000, 60000, 1, 0, NULL, 900000, 1, NULL, NULL, '2018-11-03 08:33:26', 1, NULL, NULL),
(3, '2018-11-03', 1, 1, ' ', 0.9, 0.3, 50000, 60000, 1, 0, NULL, 900000, 1, NULL, NULL, '2018-11-03 08:34:02', 1, NULL, NULL),
(4, '2018-11-03', 1, 1, ' ', 0.9, 0.3, 50000, 60000, 1, 0, NULL, 900000, 1, NULL, NULL, '2018-11-03 08:34:34', 1, NULL, NULL),
(5, '2018-11-03', 1, 1, ' ', 0.9, 0.3, 50000, 60000, 1, 0, NULL, 900000, 1, NULL, NULL, '2018-11-03 08:35:06', 1, NULL, NULL),
(6, '2018-11-03', 1, 1, ' ', 0.9, 0.3, 50000, 60000, 1, 0, NULL, 900000, 1, NULL, NULL, '2018-11-03 08:35:18', 1, NULL, NULL),
(7, '2018-11-03', 1, 1, ' ', 0.9, 0.3, 50000, 60000, 1, 0, NULL, 900000, 1, NULL, NULL, '2018-11-03 08:36:28', 1, NULL, NULL),
(8, '2018-11-03', 1, 1, ' ', 0.9, 0.3, 50000, 60000, 1, 0, NULL, 900000, 1, NULL, NULL, '2018-11-03 08:38:56', 1, NULL, NULL),
(9, '2018-11-03', 1, 1, ' ', 0.9, 0.3, 50000, 60000, 1000, 0, NULL, 800000, 1, NULL, NULL, '2018-11-03 08:42:54', 1, NULL, NULL),
(10, '2018-11-03', 1, 1, ' ', 0.9, 0.3, 50000, 60000, 1000, 0, NULL, 800000, 1, NULL, NULL, '2018-11-03 08:45:08', 1, NULL, NULL),
(11, '2018-11-03', 1, 1, ' ', 0.9, 0.3, 50000, 60000, 1000, 0, NULL, 800000, 1, NULL, NULL, '2018-11-03 08:46:50', 1, NULL, NULL),
(12, '2018-11-03', 1, 1, ' ', 0.9, 0.3, 50000, 60000, 1000, 0, NULL, 800000, 1, NULL, NULL, '2018-11-03 08:47:26', 1, NULL, NULL),
(13, '2018-11-03', 1, 1, ' ', 0.9, 0.3, 50000, 60000, 1000, 0, NULL, 800000, 1, NULL, NULL, '2018-11-03 08:47:58', 1, NULL, NULL),
(14, '2018-11-03', 1, 1, ' ', 0.9, 0.3, 50000, 60000, 1, 0, NULL, 900000, 1, NULL, NULL, '2018-11-03 08:49:21', 1, NULL, NULL),
(15, '2018-11-03', 1, 1, ' ', 0.9, 0.3, 50000, 60000, 1, 0, NULL, 900000, 1, NULL, NULL, '2018-11-03 08:51:06', 1, NULL, NULL),
(16, '2018-11-03', 1, 1, ' ', 0.9, 0.3, 50000, 60000, 1, 0, NULL, 900000, 1, NULL, NULL, '2018-11-03 08:53:05', 1, NULL, NULL),
(17, '2018-11-03', 1, 1, ' ', 0.9, 0.3, 50000, 60000, 1, 0, NULL, 900000, 1, NULL, NULL, '2018-11-03 08:55:52', 1, NULL, NULL),
(18, '2018-11-03', 1, 1, ' ', 0.9, 0.3, 50000, 60000, 1, 0, NULL, 900000, 1, NULL, NULL, '2018-11-03 08:56:46', 1, NULL, NULL),
(19, '2018-11-03', 1, 1, ' ', 0.9, 0.3, 50000, 60000, 1, 0, NULL, 900000, 1, NULL, NULL, '2018-11-03 08:57:48', 1, NULL, NULL),
(20, '2018-11-15', 1, 1, ' ', 0.9, 0.3, 50000, 60000, 5, 1000, NULL, 9500000, 1, NULL, NULL, '2018-11-15 03:53:20', 1, NULL, NULL),
(21, '2018-11-15', 1, 1, ' ', 0.9, 0.3, 50000, 60000, 5, 1000, NULL, 9500000, 1, NULL, NULL, '2018-11-15 03:54:54', 1, NULL, NULL),
(22, '2018-11-15', 1, 1, ' ', 0.9, 0.3, 50000, 60000, 5, 0, NULL, 9500000, 1, NULL, NULL, '2018-11-15 04:04:30', 1, NULL, NULL),
(23, '2018-11-15', 1, 1, ' ', 0.9, 0.3, 50000, 60000, 5, 0, NULL, 9500000, 1, NULL, NULL, '2018-11-15 04:08:18', 1, 10260, 9500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_param`
--

DROP TABLE IF EXISTS `tab_param`;
CREATE TABLE IF NOT EXISTS `tab_param` (
  `COD_GRUPO` int(11) NOT NULL,
  `COD_ITEM` int(11) DEFAULT NULL,
  `DESC_ITEM` varchar(150) DEFAULT NULL,
  `VIG_ITEM` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tab_param`
--

INSERT INTO `tab_param` (`COD_GRUPO`, `COD_ITEM`, `DESC_ITEM`, `VIG_ITEM`) VALUES
(1, 0, 'Perfil', b'1'),
(2, 0, 'Cargos', b'1'),
(2, 1, 'Usuario', b'1'),
(3, 0, 'Tipo Documentos', b'1'),
(3, 1, 'Facturas', b'1'),
(4, 0, 'Estados Documentos', b'1'),
(5, 0, 'Bancos', b'1'),
(5, 1, 'Banco Estado', b'1'),
(6, 0, 'Tipo Operacion', b'1'),
(6, 1, 'Normal Factura', b'1'),
(4, 1, 'Ingresado', b'1'),
(1, 1, 'Admin', b'1'),
(7, 0, 'Estados Operacion', b'1'),
(7, 1, 'Simulada', b'1'),
(7, 2, 'Pre-Aprobada', b'1'),
(7, 3, 'Aprobada', b'1'),
(7, 4, 'Cursada', b'1'),
(7, 5, 'Anulada', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `ID_USU` int(11) NOT NULL AUTO_INCREMENT,
  `NOM1_USU` varchar(25) DEFAULT NULL,
  `NOM2_USU` varchar(25) DEFAULT NULL,
  `APEPAT_USU` varchar(25) DEFAULT NULL,
  `APEMAT_USU` varchar(25) DEFAULT NULL,
  `RUT_USU` varchar(10) DEFAULT NULL,
  `MAIL_USU` varchar(50) DEFAULT NULL,
  `ID_PERFIL` int(11) DEFAULT NULL,
  `FEC_CRE_USU` datetime DEFAULT NULL,
  `CARGO_USU` int(11) DEFAULT NULL,
  `PASS_USU` varchar(32) DEFAULT NULL,
  `VIG_USU` bit(1) DEFAULT NULL,
  `NICK_USU` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID_USU`),
  UNIQUE KEY `RUT_USU_UNIQUE` (`RUT_USU`),
  UNIQUE KEY `NICK_USU_UNIQUE` (`NICK_USU`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID_USU`, `NOM1_USU`, `NOM2_USU`, `APEPAT_USU`, `APEMAT_USU`, `RUT_USU`, `MAIL_USU`, `ID_PERFIL`, `FEC_CRE_USU`, `CARGO_USU`, `PASS_USU`, `VIG_USU`, `NICK_USU`) VALUES
(1, 'Pablo', 'Andres', 'Vicencio', 'Contreras', '18385191-8', 'pvicencioc@hotmail.cl', 1, '2018-08-07 23:10:38', 1, 'e10adc3949ba59abbe56e057f20f883e', b'1', 'PVICENCIOC'),
(9, 'karla', 'silvana', 'rives', 'gamboa', '18385191-k', 'pvicencio@andescode.cl', 2, '2018-08-09 11:08:37', 1, 'bfd59291e825b5f2bbf1eb76569f8fe7', b'1', 'krives'),
(10, 'seba', 'waldo', 'vicencio', 'leiva', '13589639-9', 'pablo.vicencio@clinicasdelcobre.cl', 1, '2018-08-10 09:08:22', 1, 'c2c276ba5f8e4a6244b464dea79b804f', b'0', 'svicencio'),
(13, 'Catalina', 'Constanza', 'vicencio', 'leiva', '20147258-6', 'pablo.vicencio@clinicarioblanco.cl', 2, '2018-08-11 07:08:32', 1, 'f77e9c7e92c8e90da66a88f622da8bf6', b'1', 'cvicencio'),
(14, 'Karla', 'constanza', 'vicencio', 'gamboa', '28369741-1', 'pvicencio@andescode.cl', 2, '2018-08-13 05:08:42', 1, 'd5675d1ad766db2341d07ce6e4dd12f6', b'1', 'karla'),
(15, 'patrik', 'leandro', 'pimentel', 'carvacho', '17164970-6', 'ppimentel@andescode.cl', 1, '2018-08-19 07:08:11', 1, '73d313c4900537a277921be0f0c3e0b8', b'1', 'ppimentel');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `check_ope`
--
ALTER TABLE `check_ope`
  ADD CONSTRAINT `fk_check_ope` FOREIGN KEY (`ID_OPE`) REFERENCES `operaciones` (`ID_OPE`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_check_usu` FOREIGN KEY (`ID_USU`) REFERENCES `usuarios` (`ID_USU`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `FK_USU_CLI` FOREIGN KEY (`USU_CRE_CLI`) REFERENCES `usuarios` (`ID_USU`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD CONSTRAINT `FK_DOC_OPE` FOREIGN KEY (`ID_OPE`) REFERENCES `operaciones` (`ID_OPE`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_DOC_USU` FOREIGN KEY (`USU_REG_DOC`) REFERENCES `usuarios` (`ID_USU`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `gastos_ope`
--
ALTER TABLE `gastos_ope`
  ADD CONSTRAINT `FK_GASTO_OPE` FOREIGN KEY (`ID_OPE_GASTO`) REFERENCES `operaciones` (`ID_OPE`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `log_ope`
--
ALTER TABLE `log_ope`
  ADD CONSTRAINT `fk_log_ope` FOREIGN KEY (`id_ope`) REFERENCES `operaciones` (`ID_OPE`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_log_usu` FOREIGN KEY (`id_usu`) REFERENCES `usuarios` (`ID_USU`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `operaciones`
--
ALTER TABLE `operaciones`
  ADD CONSTRAINT `fk_ope_cli` FOREIGN KEY (`CLI_OPE`) REFERENCES `clientes` (`ID_CLI`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ope_usu` FOREIGN KEY (`USU_OPE`) REFERENCES `usuarios` (`ID_USU`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
