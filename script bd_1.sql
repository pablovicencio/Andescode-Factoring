-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: bd_factoring
-- ------------------------------------------------------
-- Server version	5.7.19

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
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `ID_CLI` int(11) NOT NULL AUTO_INCREMENT,
  `RUT_CLI` varchar(10) DEFAULT NULL,
  `NOM_CLI` varchar(100) DEFAULT NULL,
  `TASA_CLI` float DEFAULT NULL,
  `COM_COB_CLI` float DEFAULT NULL,
  `COM_CUR_CLI` float DEFAULT NULL,
  `APERTURA_CLI` int(11) DEFAULT NULL,
  `DIA_CLI` int(11) DEFAULT NULL,
  `FEC_CRE_CLI` datetime DEFAULT NULL,
  `USU_CRE_CLI` int(11) DEFAULT NULL,
  `VIG_CLI` bit(1) DEFAULT NULL,
  `PASS_CLI` varchar(32) DEFAULT NULL,
  `MAIL_CLI` varchar(50) DEFAULT NULL,
  `OTROS_DESC_CLI` int(11) DEFAULT NULL,
  `GG_CLI` varchar(50) DEFAULT NULL,
  `GF_CLI` varchar(50) DEFAULT NULL,
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
INSERT INTO `clientes` VALUES (1,'18398111-k','Monster INC.',0.9,0.3,50000,60000,0,'2018-08-07 23:20:07',1,'','bfd59291e825b5f2bbf1eb76569f8fe7','pablo.vicencio@correoaiep.cl',0,'Sebastian Vicencio','Waldo Vicencio'),(2,'25369232-2','epic games',0.55,0.1,20000,2000,1,'2018-08-11 08:08:48',1,'','eeb53b0e0656fc740d73be482471c8a4','pablo.vicencioc@gmail.com',0,'goku','GOHAN'),(3,'25369232-7','dbgt',0.55,0.1,20000,2000,1,'2018-08-11 08:08:13',1,'','e64467623c029c4dd1087a597f880497','pablo.vicencioc@gmail.com',0,'bulma','milk'),(4,'10336852-5','defensa deudores',0.55,0.1,20000,2000,1,'2018-08-13 05:08:15',1,'','935d1aaeb598b2fd3e9d529d472d98d1','pablo.vicencioc@gmail.com',0,'goku','GOHAN'),(5,'10234562-1','sebastian',0.55,0.1,20000,200,4,'2018-08-13 07:08:43',1,'','0e48c88e25dd014ea8640f982a4b5ce3','pablo.vicencioc@gmail.com',0,'goku','GOHAN'),(6,'13456789-5','sebastian',0.55,0.1,20000,200,1,'2018-08-13 10:08:15',1,'','a6aaf56c84c77c51e93ab4784668289d','pablo.vicencioc@gmail.com',4110,'goku','GOHAN'),(7,'13456789-k','sebastian',0.55,0.1,20000,200,1,'2018-08-13 10:08:10',1,'','b7a1d1a40e9f0a5605ad4dd4367fcbbf','pablo.vicencioc@gmail.com',4110,'goku','GOHAN'),(8,'13456789-4','sebastian',0.55,0.1,20000,200,1,'2018-08-13 10:08:49',1,'','b63f4e7cf239ba79673bb8021516e7bd','pablo.vicencioc@gmail.com',4110,'goku','GOHAN'),(9,'13456789-7','sebastian',0.55,0.1,20000,200,1,'2018-08-13 10:08:20',1,'','086266d1127ab04d86355b125fcb80eb','pablo.vicencioc@gmail.com',4110,'goku','GOHAN'),(10,'13456789-1','sebastian',0.55,0.1,20000,200,1,'2018-08-13 10:08:56',1,'','6f74aaf61f79f5f42171e4ab784744a5','pablo.vicencioc@gmail.com',4110,'goku','GOHAN'),(11,'13456789-0','sebastian',0.55,0.1,20000,200,1,'2018-08-13 10:08:23',1,'','75f4ea0e2e6c26f4927a95ada0e45350','pablo.vicencioc@gmail.com',4110,'goku','GOHAN'),(12,'13456789-9','sebastian',0.55,0.1,20000,200,1,'2018-08-13 10:08:09',1,'','57994912b60da42330bb522ba6e87d39','pablo.vicencioc@gmail.com',4110,'goku','GOHAN'),(13,'13456789-6','sebastian',0.55,0.1,20000,200,1,'2018-08-13 10:08:01',1,'','2be8e5303ae6d87929700ddd50774cd2','pablo.vicencioc@gmail.com',4110,'goku','GOHAN'),(14,'13456782-9','sebastian',0.55,0.1,20000,200,1,'2018-08-13 10:08:21',1,'','d6813f689e2228e00e54d03f6a0551e4','pablo.vicencioc@gmail.com',4110,'goku','GOHAN'),(15,'13476732-9','sebastian',0.55,0.1,20000,200,1,'2018-08-13 11:08:22',1,'','6682e61b9e64634947cc381019d8cb36','pablo.vicencioc@gmail.com',4110,'goku','GOHAN'),(16,'17476732-9','sebastian',0.55,0.1,20000,200,1,'2018-08-13 11:08:40',1,'','c0256a94fa7a5bb499d38b42d811f189','pablo.vicencioc@gmail.com',4110,'goku','GOHAN'),(17,'17486732-9','sebastian',0.55,0.1,20000,200,1,'2018-08-13 11:08:05',1,'','28d19459ab4bb71f8a196f0096f892ce','pablo.vicencioc@gmail.com',4110,'goku','GOHAN'),(18,'17486737-9','sebastian',0.55,0.1,20000,200,1,'2018-08-13 11:08:27',1,'','70d51be2eacc5a62d743a1141b8c9b21','pablo.vicencioc@gmail.com',4110,'goku','GOHAN'),(19,'17476737-9','sebastian',0.55,0.1,20000,200,1,'2018-08-13 11:08:29',1,'','c64e869cf88ea3c5d5dd4e91a4eb2628','pablo.vicencioc@gmail.com',4110,'goku','GOHAN'),(20,'17476737-k','sebastian',0.55,0.1,20000,200,1,'2018-08-13 11:08:07',1,'','aa732955dd14bac82c01592a0f396b99','pablo.vicencioc@gmail.com',4110,'goku','GOHAN'),(21,'19369852-5','sebastian',0.55,0.1,20000,200,7,'2018-08-13 11:08:18',1,'','349062dcd11dff54fcae75fc70850704','pablo.vicencioc@gmail.com',100,'goku','GOHAN'),(22,'19389852-5','sebastian',0.55,0.1,20000,200,7,'2018-08-13 11:08:00',1,'','d65362f852d72219d68c0149cbe41cc8','pablo.vicencioc@gmail.com',100,'goku','GOHAN'),(23,'19389852-k','sebastian',0.55,0.1,20000,200,7,'2018-08-13 11:08:46',1,'','ab7069b6ee1f180bc65864cf527eeba1','pablo.vicencioc@gmail.com',100,'goku','GOHAN'),(24,'19319852-k','sebastian',0.55,0.1,20000,200,7,'2018-08-13 11:08:15',1,'','37f724b847e2ee7083e13f2116e6c0b4','pablo.vicencioc@gmail.com',100,'goku','GOHAN'),(25,'19919852-k','sebastian',0.55,0.1,20000,200,7,'2018-08-13 11:08:39',1,'','5e1888248b929ec99553224f4b2f633d','pablo.vicencioc@gmail.com',100,'goku','GOHAN'),(26,'19911852-k','sebastian',0.55,0.1,20000,200,7,'2018-08-13 11:08:39',1,'','75be2961437591197774450bf381bdb7','pablo.vicencioc@gmail.com',100,'goku','GOHAN');
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
  `ID_CLI` int(11) DEFAULT NULL,
  `TIPO_DOC` int(11) DEFAULT NULL,
  `EST_DOC` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_DOC`),
  KEY `FK_DOC_USU_idx` (`USU_REG_DOC`),
  KEY `FK_DOC_CLI_idx` (`ID_CLI`),
  CONSTRAINT `FK_DOC_CLI` FOREIGN KEY (`ID_CLI`) REFERENCES `clientes` (`ID_CLI`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_DOC_USU` FOREIGN KEY (`USU_REG_DOC`) REFERENCES `usuarios` (`ID_USU`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documentos`
--

LOCK TABLES `documentos` WRITE;
/*!40000 ALTER TABLE `documentos` DISABLE KEYS */;
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
  `ID_CLI_GASTO` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_GASTO`),
  KEY `FK_OPE_CLI_idx` (`ID_CLI_GASTO`),
  CONSTRAINT `FK_OPE_CLI` FOREIGN KEY (`ID_CLI_GASTO`) REFERENCES `clientes` (`ID_CLI`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gastos_ope`
--

LOCK TABLES `gastos_ope` WRITE;
/*!40000 ALTER TABLE `gastos_ope` DISABLE KEYS */;
INSERT INTO `gastos_ope` VALUES (1,4350,3450,2350,1925,1925,'',1),(2,100,200,NULL,400,500,'',25),(3,100,200,300,400,500,'',26);
/*!40000 ALTER TABLE `gastos_ope` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `operaciones`
--

DROP TABLE IF EXISTS `operaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `operaciones` (
  `ID_OPE` int(11) NOT NULL AUTO_INCREMENT,
  `EST_ANT_OPE` int(11) DEFAULT NULL,
  `EST_NUE_OPE` int(11) DEFAULT NULL,
  `FEC_OPE` datetime DEFAULT NULL,
  `USU_OPE` int(11) DEFAULT NULL,
  `ID_DOC_OPE` int(11) DEFAULT NULL,
  `TIPO_OPE` int(11) DEFAULT NULL,
  `OBS_OPE` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID_OPE`),
  KEY `FK_USU_OPE_idx` (`ID_DOC_OPE`),
  CONSTRAINT `FK_DOC_OPE` FOREIGN KEY (`ID_DOC_OPE`) REFERENCES `documentos` (`ID_DOC`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_USU_OPE` FOREIGN KEY (`ID_DOC_OPE`) REFERENCES `usuarios` (`ID_USU`) ON DELETE NO ACTION ON UPDATE NO ACTION
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
INSERT INTO `tab_param` VALUES (1,0,'Perfil',''),(1,1,'Admin',''),(1,2,'Usuario',''),(2,0,'Cargos',''),(2,1,'Usuario','');
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Pablo','Andres','Vicencio','Contreras','18385191-8','pvicencioc@hotmail.cl',2,'2018-08-07 23:10:38',1,'e10adc3949ba59abbe56e057f20f883e','','PVICENCIOC'),(9,'karla','silvana','rives','gamboa','18385191-k','pvicencio@andescode.cl',2,'2018-08-09 11:08:37',1,'bfd59291e825b5f2bbf1eb76569f8fe7','','krives'),(10,'seba','waldo','vicencio','leiva','13589639-9','pablo.vicencio@clinicasdelcobre.cl',1,'2018-08-10 09:08:22',1,'c2c276ba5f8e4a6244b464dea79b804f','\0','svicencio'),(13,'Catalina','Constanza','vicencio','leiva','20147258-6','pablo.vicencio@clinicarioblanco.cl',2,'2018-08-11 07:08:32',1,'f77e9c7e92c8e90da66a88f622da8bf6','','cvicencio'),(14,'Karla','constanza','vicencio','gamboa','28369741-1','pvicencio@andescode.cl',2,'2018-08-13 05:08:42',1,'d5675d1ad766db2341d07ce6e4dd12f6','','karla');
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

-- Dump completed on 2018-08-14 20:28:47
