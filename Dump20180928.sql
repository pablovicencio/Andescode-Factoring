CREATE DATABASE  IF NOT EXISTS `bd_factoring` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `bd_factoring`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: bd_factoring
-- ------------------------------------------------------
-- Server version	5.6.12-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `check_ope`
--

DROP TABLE IF EXISTS `check_ope`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `check_ope` (
  `ID_OPE` int(11) NOT NULL,
  `ID_GRUPO` int(11) NOT NULL,
  `ID_PARAM` int(11) NOT NULL,
  `OBS_LOG` varchar(200) DEFAULT NULL,
  `VIG_LOG` bit(1) NOT NULL,
  `FEC_LOG` datetime NOT NULL,
  `ID_USU` int(11) DEFAULT NULL,
  KEY `FK_CHECK_OPE_idx` (`ID_OPE`),
  KEY `FK_CHECK_USU_idx` (`ID_USU`),
  CONSTRAINT `fk_check_ope` FOREIGN KEY (`ID_OPE`) REFERENCES `operaciones` (`ID_OPE`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_check_usu` FOREIGN KEY (`ID_USU`) REFERENCES `usuarios` (`ID_USU`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `check_ope`
--

LOCK TABLES `check_ope` WRITE;
/*!40000 ALTER TABLE `check_ope` DISABLE KEYS */;
/*!40000 ALTER TABLE `check_ope` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
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
  KEY `FK_USU_CLI_idx` (`USU_CRE_CLI`),
  CONSTRAINT `FK_USU_CLI` FOREIGN KEY (`USU_CRE_CLI`) REFERENCES `usuarios` (`ID_USU`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'18398111-k','Monster INC.',0.9,0.3,50000,60000,'2018-08-07 23:20:07',1,'','bfd59291e825b5f2bbf1eb76569f8fe7','pablo.vicencio@correoaiep.cl','Sebastian Vicencio','Waldo Vicencio',10000000,18385191,2,'2018-12-01'),(25,'19919852-k','sebastian',0.55,0.1,20000,200,'2018-08-13 11:08:39',1,'','5e1888248b929ec99553224f4b2f633d','pablo.vicencioc@gmail.com','goku','GOHAN',NULL,NULL,NULL,NULL),(26,'19911852-k','sebastian',0.55,0.1,20000,200,'2018-08-13 11:08:39',1,'','e10adc3949ba59abbe56e057f20f883e','pablo.vicencioc@gmail.com','goku','GOHAN',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documentos`
--

DROP TABLE IF EXISTS `documentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documentos` (
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
  PRIMARY KEY (`ID_DOC`),
  KEY `FK_DOC_USU_idx` (`USU_REG_DOC`),
  KEY `FK_DOC_OPE_idx` (`ID_OPE`),
  CONSTRAINT `FK_DOC_OPE` FOREIGN KEY (`ID_OPE`) REFERENCES `operaciones` (`ID_OPE`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_DOC_USU` FOREIGN KEY (`USU_REG_DOC`) REFERENCES `usuarios` (`ID_USU`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documentos`
--

LOCK TABLES `documentos` WRITE;
/*!40000 ALTER TABLE `documentos` DISABLE KEYS */;
INSERT INTO `documentos` VALUES (6,'20125899-5','factis',221,100000,80,'2018-08-19','2018-08-31',16,'2018-08-19 09:08:11',1,1,1,NULL,NULL,NULL,NULL),(7,'50236895-8','nestle',340,2551360,98,'2018-07-18','2018-08-20',35,'2018-08-19 09:08:53',1,1,1,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `documentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gastos_ope`
--

DROP TABLE IF EXISTS `gastos_ope`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gastos_ope` (
  `ID_GASTO` int(11) NOT NULL AUTO_INCREMENT,
  `NOT_DEUDOR_GASTO` int(11) DEFAULT NULL,
  `ENVIO_CORREO_GASTO` int(11) DEFAULT NULL,
  `PROC_GASTO` int(11) DEFAULT NULL,
  `COPIA_FAC_GASTO` int(11) DEFAULT NULL,
  `SII_CERT_GASTO` int(11) DEFAULT NULL,
  `VIG_GASTO` bit(1) DEFAULT NULL,
  `ID_OPE_GASTO` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_GASTO`),
  KEY `FK_GASTO_OPE_idx` (`ID_OPE_GASTO`),
  CONSTRAINT `FK_GASTO_OPE` FOREIGN KEY (`ID_OPE_GASTO`) REFERENCES `operaciones` (`ID_OPE`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gastos_ope`
--

LOCK TABLES `gastos_ope` WRITE;
/*!40000 ALTER TABLE `gastos_ope` DISABLE KEYS */;
/*!40000 ALTER TABLE `gastos_ope` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_ope`
--

DROP TABLE IF EXISTS `log_ope`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log_ope` (
  `id_ope` int(11) DEFAULT NULL,
  `est_ant_ope` int(11) DEFAULT NULL,
  `est_nue_ope` int(11) DEFAULT NULL,
  `obs_log_ope` varchar(250) DEFAULT NULL,
  `id_usu` int(11) DEFAULT NULL,
  `fec_log_ope` datetime DEFAULT NULL,
  KEY `fk_log_ope_idx` (`id_ope`),
  KEY `fk_log_usu_idx` (`id_usu`),
  CONSTRAINT `fk_log_ope` FOREIGN KEY (`id_ope`) REFERENCES `operaciones` (`ID_OPE`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_log_usu` FOREIGN KEY (`id_usu`) REFERENCES `usuarios` (`ID_USU`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_ope`
--

LOCK TABLES `log_ope` WRITE;
/*!40000 ALTER TABLE `log_ope` DISABLE KEYS */;
/*!40000 ALTER TABLE `log_ope` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `operaciones`
--

DROP TABLE IF EXISTS `operaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `operaciones` (
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
  `OTROS_DESC_OPE` int(11) DEFAULT NULL,
  `NRO_CTA_DEST_OPE` int(11) NOT NULL,
  `MONTO_GIRO_OPE` int(11) NOT NULL,
  `CLI_OPE` int(11) DEFAULT NULL,
  `BCO_GIRO_OPE` int(11) DEFAULT NULL,
  `BCO_DEP_OPE` int(11) DEFAULT NULL,
  `FEC_REG_OPE` datetime NOT NULL,
  `EST_OPE` int(11) NOT NULL,
  PRIMARY KEY (`ID_OPE`),
  KEY `fk_ope_usu_idx` (`USU_OPE`),
  KEY `fk_ope_cli_idx` (`CLI_OPE`),
  CONSTRAINT `fk_ope_cli` FOREIGN KEY (`CLI_OPE`) REFERENCES `clientes` (`ID_CLI`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ope_usu` FOREIGN KEY (`USU_OPE`) REFERENCES `usuarios` (`ID_USU`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operaciones`
--

LOCK TABLES `operaciones` WRITE;
/*!40000 ALTER TABLE `operaciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `operaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tab_param`
--

DROP TABLE IF EXISTS `tab_param`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tab_param` (
  `COD_GRUPO` int(11) NOT NULL,
  `COD_ITEM` int(11) DEFAULT NULL,
  `DESC_ITEM` varchar(150) DEFAULT NULL,
  `VIG_ITEM` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tab_param`
--

LOCK TABLES `tab_param` WRITE;
/*!40000 ALTER TABLE `tab_param` DISABLE KEYS */;
INSERT INTO `tab_param` VALUES (1,0,'Perfil',''),(1,1,'Admin',''),(1,2,'Usuario',''),(2,0,'Cargos',''),(2,1,'Usuario',''),(3,0,'Tipo Documentos',''),(3,1,'Facturas',''),(4,0,'Estados Documentos',''),(4,1,'Ingresado',''),(5,0,'Bancos',''),(5,1,'Banco Estado',''),(5,2,'BCI',''),(6,0,'Tipo Operacion',''),(6,1,'Normal Factura','');
/*!40000 ALTER TABLE `tab_param` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Pablo','Andres','Vicencio','Contreras','18385191-8','pvicencioc@hotmail.cl',1,'2018-08-07 23:10:38',1,'e10adc3949ba59abbe56e057f20f883e','','PVICENCIOC'),(9,'karla','silvana','rives','gamboa','18385191-k','pvicencio@andescode.cl',2,'2018-08-09 11:08:37',1,'bfd59291e825b5f2bbf1eb76569f8fe7','','krives'),(10,'seba','waldo','vicencio','leiva','13589639-9','pablo.vicencio@clinicasdelcobre.cl',1,'2018-08-10 09:08:22',1,'c2c276ba5f8e4a6244b464dea79b804f','\0','svicencio'),(13,'Catalina','Constanza','vicencio','leiva','20147258-6','pablo.vicencio@clinicarioblanco.cl',2,'2018-08-11 07:08:32',1,'f77e9c7e92c8e90da66a88f622da8bf6','','cvicencio'),(14,'Karla','constanza','vicencio','gamboa','28369741-1','pvicencio@andescode.cl',2,'2018-08-13 05:08:42',1,'d5675d1ad766db2341d07ce6e4dd12f6','','karla'),(15,'patrik','leandro','pimentel','carvacho','17164970-6','ppimentel@andescode.cl',1,'2018-08-19 07:08:11',1,'73d313c4900537a277921be0f0c3e0b8','','ppimentel');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-09-28 16:45:45
