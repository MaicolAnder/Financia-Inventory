-- MariaDB dump 10.17  Distrib 10.4.11-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: margunsoft_financia_v2
-- ------------------------------------------------------
-- Server version	10.4.11-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `banco_estado`
--

DROP TABLE IF EXISTS `banco_estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banco_estado` (
  `Id_BanEst` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_BanEst` varchar(100) NOT NULL,
  PRIMARY KEY (`Id_BanEst`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banco_estado`
--

LOCK TABLES `banco_estado` WRITE;
/*!40000 ALTER TABLE `banco_estado` DISABLE KEYS */;
INSERT INTO `banco_estado` VALUES (1,'Activo'),(2,'Inactivo');
/*!40000 ALTER TABLE `banco_estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bancos`
--

DROP TABLE IF EXISTS `bancos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bancos` (
  `Id_Ban` int(11) NOT NULL AUTO_INCREMENT,
  `NombreCuenta_Ban` varchar(500) NOT NULL,
  `NumeroCuenta_Ban` varchar(100) DEFAULT NULL,
  `SaldoInicial_Ban` double DEFAULT NULL,
  `FechaBanco` date DEFAULT NULL,
  `Descripcion_Ban` text DEFAULT NULL,
  `FechaRegistro` timestamp NULL DEFAULT current_timestamp(),
  `Id_BanEst` int(11) DEFAULT NULL,
  `Id_TipCueBan` int(11) DEFAULT NULL,
  `Primary_Usu` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_Ban`) USING BTREE,
  KEY `fk_bancos_banco_estado1_idx` (`Id_BanEst`) USING BTREE,
  KEY `fk_bancos_tipo_cuenta_banco1_idx` (`Id_TipCueBan`) USING BTREE,
  CONSTRAINT `fk_bancos_banco_estado1` FOREIGN KEY (`Id_BanEst`) REFERENCES `banco_estado` (`Id_BanEst`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_bancos_tipo_cuenta_banco1` FOREIGN KEY (`Id_TipCueBan`) REFERENCES `tipo_cuenta_banco` (`Id_TipCueBan`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bancos`
--

LOCK TABLES `bancos` WRITE;
/*!40000 ALTER TABLE `bancos` DISABLE KEYS */;
INSERT INTO `bancos` VALUES (1,'Caja general','0',100000,'2020-03-23','Banco caja general',NULL,1,2,1),(2,'Tarjeta crédito empresarial',NULL,0,'2020-03-24','Banco para tarjeta de crédito','2020-03-24 08:03:52',1,1,1),(3,'Caja general 1','0',0,'2020-03-27','Caja principal','2020-03-27 08:03:39',1,2,7),(4,'Tarjeta crédito empresarial','0',0,'2020-04-01',NULL,'2020-04-02 02:04:15',1,1,7);
/*!40000 ALTER TABLE `bancos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bodega_estado`
--

DROP TABLE IF EXISTS `bodega_estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bodega_estado` (
  `Id_BodEst` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_BodEst` varchar(100) DEFAULT NULL,
  `Estado_BodEst` enum('Activo','Inactivo') DEFAULT 'Activo',
  `FechaRegistro_BodEst` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id_BodEst`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bodega_estado`
--

LOCK TABLES `bodega_estado` WRITE;
/*!40000 ALTER TABLE `bodega_estado` DISABLE KEYS */;
INSERT INTO `bodega_estado` VALUES (1,'Activo','Activo','2020-03-24 02:50:59'),(2,'Inactivo','Activo','2020-03-24 02:51:06');
/*!40000 ALTER TABLE `bodega_estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bodega_tipo`
--

DROP TABLE IF EXISTS `bodega_tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bodega_tipo` (
  `Id_BodTip` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_BodTip` varchar(100) DEFAULT NULL,
  `Estado_BodTip` enum('Activo','Inactivo') DEFAULT 'Activo',
  `FechaRegistro_BodTip` timestamp NULL DEFAULT current_timestamp(),
  `Primary_Usu` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_BodTip`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bodega_tipo`
--

LOCK TABLES `bodega_tipo` WRITE;
/*!40000 ALTER TABLE `bodega_tipo` DISABLE KEYS */;
INSERT INTO `bodega_tipo` VALUES (1,'Principal','Activo','2020-03-24 02:52:12',NULL),(2,'Sucursal','Activo','2020-03-24 02:52:26',NULL);
/*!40000 ALTER TABLE `bodega_tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bodegas`
--

DROP TABLE IF EXISTS `bodegas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bodegas` (
  `Id_Bod` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_Bod` varchar(500) NOT NULL,
  `Codigo_Bod` varchar(45) DEFAULT NULL,
  `Direccion_Bod` varchar(500) DEFAULT NULL,
  `Descripcion_Bod` text DEFAULT NULL,
  `FechaRegistro_Bod` timestamp NULL DEFAULT current_timestamp(),
  `FechaCreacion_Bod` datetime DEFAULT NULL,
  `Id_BodTip` int(11) DEFAULT NULL,
  `Id_BodEst` int(11) DEFAULT NULL,
  `Id_Usu` int(11) DEFAULT NULL COMMENT 'Responsable de la bodega',
  `Primary_Usu` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_Bod`) USING BTREE,
  KEY `fk_bodegas_bodega_tipo1_idx` (`Id_BodTip`) USING BTREE,
  KEY `fk_bodegas_bodega_estado1_idx` (`Id_BodEst`) USING BTREE,
  KEY `fk_bodegas_usuario1_idx` (`Id_Usu`) USING BTREE,
  CONSTRAINT `fk_bodegas_bodega_estado1` FOREIGN KEY (`Id_BodEst`) REFERENCES `bodega_estado` (`Id_BodEst`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_bodegas_bodega_tipo1` FOREIGN KEY (`Id_BodTip`) REFERENCES `bodega_tipo` (`Id_BodTip`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_bodegas_usuario1` FOREIGN KEY (`Id_Usu`) REFERENCES `usuario` (`Id_Usu`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bodegas`
--

LOCK TABLES `bodegas` WRITE;
/*!40000 ALTER TABLE `bodegas` DISABLE KEYS */;
INSERT INTO `bodegas` VALUES (1,'Bodega principal',NULL,NULL,NULL,NULL,NULL,NULL,1,1,NULL),(2,'Almacén secundario 1',NULL,NULL,NULL,NULL,NULL,1,1,1,NULL),(3,'Almacén secundario 2',NULL,NULL,NULL,NULL,NULL,1,1,1,NULL),(4,'Almacén general','1000',NULL,NULL,'2020-03-27 10:03:30','2020-03-26 00:00:00',NULL,1,1,1),(5,'Principal Centro','01','cra 23  3 45','Bodega principal Popayán','2020-05-02 21:05:00','2020-04-27 00:00:00',NULL,1,7,7);
/*!40000 ALTER TABLE `bodegas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria_item`
--

DROP TABLE IF EXISTS `categoria_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria_item` (
  `Id_CatIte` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_CatIte` varchar(100) NOT NULL,
  `FechaRegistro_CatIte` timestamp NULL DEFAULT current_timestamp(),
  `Estado_CatIte` enum('Activo','Inactivo') DEFAULT 'Activo',
  `Primary_Usu` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_CatIte`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria_item`
--

LOCK TABLES `categoria_item` WRITE;
/*!40000 ALTER TABLE `categoria_item` DISABLE KEYS */;
INSERT INTO `categoria_item` VALUES (1,'Grupo #1',NULL,NULL,NULL),(2,'Grupo #1','2020-03-27 10:03:27','Activo',1),(3,'Servicios varios','2020-04-01 00:03:28','Activo',7);
/*!40000 ALTER TABLE `categoria_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuracion`
--

DROP TABLE IF EXISTS `configuracion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuracion` (
  `Id_Conf` int(11) NOT NULL AUTO_INCREMENT,
  `key_Conf` varchar(255) DEFAULT NULL,
  `Value_Conf` varchar(255) DEFAULT NULL,
  `Descripcion_Conf` longtext DEFAULT NULL,
  `Id_ConfTip` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_Conf`) USING BTREE,
  KEY `fk_configuracion_tipo` (`Id_ConfTip`) USING BTREE,
  KEY `index_configuacion_id` (`Id_Conf`) USING BTREE,
  KEY `idx_key_Conf` (`key_Conf`) USING BTREE,
  CONSTRAINT `fk_configuracion_tipo` FOREIGN KEY (`Id_ConfTip`) REFERENCES `configuracion_tipo` (`Id_ConfTip`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuracion`
--

LOCK TABLES `configuracion` WRITE;
/*!40000 ALTER TABLE `configuracion` DISABLE KEYS */;
INSERT INTO `configuracion` VALUES (1,'NumeroUnicoForm_Afi','25201','Consecutivo número  único de afiliación',4),(2,'NumeroRadicado_Aut','1021','Consecutivo número de radicado para autorizaciones',4),(3,'NumeroAutorizacion_Aut','22','Consecutivo para el número de autorización',4),(4,'NumeroDoc_SolicitudPertinencia','1','Número de documentos por solicitud de pertinencia: 1. Un solo documento, 2. HC y Orden médica, 3. HC,  Orden médica y documento SOAT. ',2);
/*!40000 ALTER TABLE `configuracion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuracion_tipo`
--

DROP TABLE IF EXISTS `configuracion_tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuracion_tipo` (
  `Id_ConfTip` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_ConfTip` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id_ConfTip`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuracion_tipo`
--

LOCK TABLES `configuracion_tipo` WRITE;
/*!40000 ALTER TABLE `configuracion_tipo` DISABLE KEYS */;
INSERT INTO `configuracion_tipo` VALUES (1,'Ajustes del sistema'),(2,'Ajustes del cliente'),(3,'Visualización e interfaz '),(4,'Variables incrementales');
/*!40000 ALTER TABLE `configuracion_tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contrato_estado`
--

DROP TABLE IF EXISTS `contrato_estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contrato_estado` (
  `Id_ConEst` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_ConEst` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id_ConEst`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contrato_estado`
--

LOCK TABLES `contrato_estado` WRITE;
/*!40000 ALTER TABLE `contrato_estado` DISABLE KEYS */;
INSERT INTO `contrato_estado` VALUES (1,'Creado'),(2,'Vigente activo'),(3,'Anulado'),(4,'Cerrado');
/*!40000 ALTER TABLE `contrato_estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contrato_tipo`
--

DROP TABLE IF EXISTS `contrato_tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contrato_tipo` (
  `Id_ConTip` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_ConTip` varchar(100) DEFAULT NULL,
  `Estado_ConTip` enum('Activo','Inactivo') DEFAULT NULL,
  PRIMARY KEY (`Id_ConTip`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contrato_tipo`
--

LOCK TABLES `contrato_tipo` WRITE;
/*!40000 ALTER TABLE `contrato_tipo` DISABLE KEYS */;
INSERT INTO `contrato_tipo` VALUES (1,'CONTRATO CAPITADO','Activo'),(2,'EVENTO','Activo');
/*!40000 ALTER TABLE `contrato_tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contratos`
--

DROP TABLE IF EXISTS `contratos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contratos` (
  `Id_Con` int(11) NOT NULL AUTO_INCREMENT,
  `Numero_Con` varchar(100) DEFAULT NULL,
  `FechaInicio_Con` date DEFAULT NULL,
  `FechaFin_Con` date DEFAULT NULL,
  `Valor_Con` double(100,2) DEFAULT NULL,
  `Objeto_Con` longtext DEFAULT NULL,
  `Observacion_Con` longtext DEFAULT NULL,
  `Id_Emp` int(11) DEFAULT NULL,
  `Id_ConTip` int(11) DEFAULT NULL COMMENT 'Referente a la modalidad del contrato',
  `Id_ConEst` int(11) DEFAULT NULL,
  `Primary_Usu` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_Con`) USING BTREE,
  KEY `fk_contratos_tipo_1` (`Id_ConTip`) USING BTREE,
  KEY `fk_contratos_estado_1` (`Id_ConEst`) USING BTREE,
  KEY `fk_contrato_empresa` (`Id_Emp`) USING BTREE,
  CONSTRAINT `fk_contrato_empresa` FOREIGN KEY (`Id_Emp`) REFERENCES `empresa` (`Id_Emp`),
  CONSTRAINT `fk_contratos_estado_1` FOREIGN KEY (`Id_ConEst`) REFERENCES `contrato_estado` (`Id_ConEst`),
  CONSTRAINT `fk_contratos_tipo_1` FOREIGN KEY (`Id_ConTip`) REFERENCES `contrato_tipo` (`Id_ConTip`)
) ENGINE=InnoDB AUTO_INCREMENT=351 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contratos`
--

LOCK TABLES `contratos` WRITE;
/*!40000 ALTER TABLE `contratos` DISABLE KEYS */;
/*!40000 ALTER TABLE `contratos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cuenta_estado`
--

DROP TABLE IF EXISTS `cuenta_estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cuenta_estado` (
  `Id_CueEst` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_CueEst` varchar(70) NOT NULL,
  PRIMARY KEY (`Id_CueEst`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cuenta_estado`
--

LOCK TABLES `cuenta_estado` WRITE;
/*!40000 ALTER TABLE `cuenta_estado` DISABLE KEYS */;
INSERT INTO `cuenta_estado` VALUES (1,'Activo'),(2,'Inactivo');
/*!40000 ALTER TABLE `cuenta_estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cuenta_tipo`
--

DROP TABLE IF EXISTS `cuenta_tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cuenta_tipo` (
  `Id_CueTip` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_CueTip` varchar(70) NOT NULL,
  PRIMARY KEY (`Id_CueTip`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cuenta_tipo`
--

LOCK TABLES `cuenta_tipo` WRITE;
/*!40000 ALTER TABLE `cuenta_tipo` DISABLE KEYS */;
INSERT INTO `cuenta_tipo` VALUES (1,'Activo'),(2,'Egreso'),(3,'Ingreso'),(4,'Pasivo'),(5,'Patromonio'),(6,'Costos');
/*!40000 ALTER TABLE `cuenta_tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cuentas`
--

DROP TABLE IF EXISTS `cuentas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cuentas` (
  `Id_Cue` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_Cue` varchar(500) NOT NULL,
  `Cuenta_Cue` varchar(70) DEFAULT NULL,
  `Consecutivo_Cue` varchar(100) DEFAULT NULL,
  `FechaRegistro_Cue` timestamp NULL DEFAULT current_timestamp(),
  `Id_NatCue` int(11) DEFAULT NULL,
  `Id_CueEst` int(11) DEFAULT NULL,
  `Id_CueTip` int(11) DEFAULT NULL,
  `Id_Cue_CuentaPadre` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_Cue`) USING BTREE,
  KEY `fk_cuentas_naturaleza_cuenta1_idx` (`Id_NatCue`) USING BTREE,
  KEY `fk_cuentas_cuenta_estado1_idx` (`Id_CueEst`) USING BTREE,
  KEY `fk_cuentas_cuenta_tipo1_idx` (`Id_CueTip`) USING BTREE,
  KEY `fk_cuentas_cuentas1_idx` (`Id_Cue_CuentaPadre`) USING BTREE,
  CONSTRAINT `fk_cuentas_cuenta_estado1` FOREIGN KEY (`Id_CueEst`) REFERENCES `cuenta_estado` (`Id_CueEst`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cuentas_cuenta_tipo1` FOREIGN KEY (`Id_CueTip`) REFERENCES `cuenta_tipo` (`Id_CueTip`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cuentas_cuentas1` FOREIGN KEY (`Id_Cue_CuentaPadre`) REFERENCES `cuentas` (`Id_Cue`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cuentas_naturaleza_cuenta1` FOREIGN KEY (`Id_NatCue`) REFERENCES `naturaleza_cuenta` (`Id_NatCue`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=454 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cuentas`
--

LOCK TABLES `cuentas` WRITE;
/*!40000 ALTER TABLE `cuentas` DISABLE KEYS */;
INSERT INTO `cuentas` VALUES (1,'Activo','1',NULL,'2020-04-22 22:20:32',1,1,1,1),(2,'Activos Corrientes','101',NULL,'2020-04-22 22:20:32',1,1,1,1),(3,'Disponible','10101',NULL,'2020-04-22 22:20:32',1,1,1,2),(4,'Caja','1010101',NULL,'2020-04-22 22:20:32',1,1,1,3),(5,'Caja General','1010101001',NULL,'2020-04-22 22:20:32',1,1,1,4),(6,'Fondo Fijo','1010102',NULL,'2020-04-22 22:20:32',1,1,1,3),(7,'Bancos','1010103',NULL,'2020-04-22 22:20:32',1,1,1,3),(8,'Exigible','10102',NULL,'2020-04-22 22:20:32',1,1,1,2),(9,'Cuentas por cobrar Accionistas','1010201',NULL,'2020-04-22 22:20:32',1,1,1,8),(10,'Anticipos a empleados','1010202',NULL,'2020-04-22 22:20:32',1,1,1,8),(11,'Cuentas por cobrar empleados','1010203',NULL,'2020-04-22 22:20:32',1,1,1,8),(12,'Cuentas por cobrar Clientes','1010204',NULL,'2020-04-22 22:20:32',1,1,1,8),(13,'Cuentas por cobrar Compañías Asociadas','1010205',NULL,'2020-04-22 22:20:32',1,1,1,8),(14,'Cuentas por cobrar a Terceros','1010206',NULL,'2020-04-22 22:20:32',1,1,1,8),(15,'Realizable','10103',NULL,'2020-04-22 22:20:32',1,1,1,2),(16,'Anticipo a proveedores','1010301',NULL,'2020-04-22 22:20:32',1,1,1,15),(17,'Materia Prima','1010302',NULL,'2020-04-22 22:20:32',1,1,1,15),(18,'Materiales indirectos y suministros de fábrica','1010303',NULL,'2020-04-22 22:20:32',1,1,1,15),(19,'Mercancía en transito','1010304',NULL,'2020-04-22 22:20:32',1,1,1,15),(20,'Productos en proceso (MOD)','1010305',NULL,'2020-04-22 22:20:32',1,1,1,15),(21,'Productos en proceso (MOI)','1010306',NULL,'2020-04-22 22:20:32',1,1,1,15),(22,'Productos en proceso (Materia prima)','1010307',NULL,'2020-04-22 22:20:32',1,1,1,15),(23,'Inventario de Productos Terminados','1010308',NULL,'2020-04-22 22:20:32',1,1,1,15),(24,'Mercancía para la venta','1010309',NULL,'2020-04-22 22:20:32',1,1,1,15),(25,'Provisión por obsolescencia de (MP)','1010351',NULL,'2020-04-22 22:20:32',1,1,1,15),(26,'Provisión por obsolescencia de (Materiales indirectos)','1010352',NULL,'2020-04-22 22:20:32',1,1,1,15),(27,'Provisión por obsolescencia de productos terminados','1010353',NULL,'2020-04-22 22:20:32',1,1,1,15),(28,'Prepagado','10104',NULL,'2020-04-22 22:20:32',1,1,1,2),(29,'Impuestos pagados por anticipado','1010401',NULL,'2020-04-22 22:20:32',1,1,1,28),(30,'Impuesto al valor agregado','1010401001',NULL,'2020-04-22 22:20:32',1,1,1,29),(31,'Retenciones I.V.A.','1010401002',NULL,'2020-04-22 22:20:32',1,1,1,29),(32,'Retenciones I.S.L.R.','1010401003',NULL,'2020-04-22 22:20:32',1,1,1,29),(33,'Excedente de crédito fiscal (IVA)','1010401004',NULL,'2020-04-22 22:20:32',1,1,1,29),(34,'Seguros pagados por anticipado','1010402',NULL,'2020-04-22 22:20:32',1,1,1,28),(35,'Intereses pagados por anticipado','1010403',NULL,'2020-04-22 22:20:32',1,1,1,28),(36,'Alquileres pagados por anticipado','1010404',NULL,'2020-04-22 22:20:32',1,1,1,28),(37,'Activo No corrientes','102',NULL,'2020-04-22 22:20:32',1,1,1,1),(38,'Largo plazo','10201',NULL,'2020-04-22 22:20:32',1,1,1,37),(39,'Efectos por cobrar','1020101',NULL,'2020-04-22 22:20:32',1,1,1,38),(40,'Cuentas por cobrar','1020102',NULL,'2020-04-22 22:20:32',1,1,1,38),(41,'Hipotecas por cobrar','1020103',NULL,'2020-04-22 22:20:32',1,1,1,38),(42,'Inversiones en acciones','1020104',NULL,'2020-04-22 22:20:32',1,1,1,38),(43,'Provisión para fluctuaciones del valor de mercado en acciones','1020105',NULL,'2020-04-22 22:20:32',1,1,1,38),(44,'Inversiones en bonos','1020106',NULL,'2020-04-22 22:20:32',1,1,1,38),(45,'Provisión para fluctuaciones del valor de mercado en bonos','1020107',NULL,'2020-04-22 22:20:32',1,1,1,38),(46,'Inversiones en compañías asociadas','1020108',NULL,'2020-04-22 22:20:32',1,1,1,38),(47,'Inversiones en inmuebles','1020109',NULL,'2020-04-22 22:20:32',1,1,1,38),(48,'Inversiones permanentes','1020110',NULL,'2020-04-22 22:20:32',1,1,1,38),(49,'Propiedad','10202',NULL,'2020-04-22 22:20:32',1,1,1,37),(50,'Terreros','1020201',NULL,'2020-04-22 22:20:32',1,1,1,49),(52,'Planta','10203',NULL,'2020-04-22 22:20:32',1,1,1,37),(53,'Depreciación Acumulada Planta','10204',NULL,'2020-04-22 22:20:32',1,1,1,37),(54,'Obsolescencia de Planta','10205',NULL,'2020-04-22 22:20:32',1,1,1,37),(55,'Revalorización de Planta','10206',NULL,'2020-04-22 22:20:32',1,1,1,37),(57,'Depreciación Acumulada Revalorización de Planta','10207',NULL,'2020-04-22 22:20:32',1,1,1,37),(59,'Obsolescencia Revalorización de Planta','10208',NULL,'2020-04-22 22:20:32',1,1,1,37),(61,'Equipo','10209',NULL,'2020-04-22 22:20:32',1,1,1,37),(62,'Vehículos automotores','1020901',NULL,'2020-04-22 22:20:32',1,1,1,61),(63,'Vehículos automotores de carga','1020902',NULL,'2020-04-22 22:20:32',1,1,1,61),(64,'Vehículos de trasmisión mecánica','1020903',NULL,'2020-04-22 22:20:32',1,1,1,61),(65,'Maquinaria pesada','1020904',NULL,'2020-04-22 22:20:32',1,1,1,61),(66,'Muebles','1020911',NULL,'2020-04-22 22:20:32',1,1,1,61),(67,'Equipos de oficina','1020921',NULL,'2020-04-22 22:20:32',1,1,1,61),(68,'Depreciación Acumulada de Equipos','10210',NULL,'2020-04-22 22:20:32',1,1,1,37),(69,'Deprec Acum.Vehículos automotores','1021001',NULL,'2020-04-22 22:20:32',1,1,1,68),(70,'Deprec. Acum. Vehículos automotores de carga','1021002',NULL,'2020-04-22 22:20:32',1,1,1,68),(71,'Deprec. Acum Vehículos de trasmisión mecánica','1021003',NULL,'2020-04-22 22:20:32',1,1,1,68),(72,'Deprec. Acum. Maquinaria pesada','1021004',NULL,'2020-04-22 22:20:32',1,1,1,68),(73,'Depreciación Acumulada Muebles','1021011',NULL,'2020-04-22 22:20:32',1,1,1,68),(74,'Depreciación Acumulada Equipos de oficina','1021021',NULL,'2020-04-22 22:20:32',1,1,1,68),(75,'Obsolescencia de Equipos','10211',NULL,'2020-04-22 22:20:32',1,1,1,37),(76,'Obsolescencia Vehículos automotores','1021101',NULL,'2020-04-22 22:20:32',1,1,1,75),(77,'Obsolescencia Vehículos automotores de carga','1021102',NULL,'2020-04-22 22:20:32',1,1,1,75),(78,'Obsolescencia Vehículos de trasmisión mecánica','1021103',NULL,'2020-04-22 22:20:32',1,1,1,75),(79,'Obsolescencia Maquinaria pesada','1021104',NULL,'2020-04-22 22:20:32',1,1,1,75),(80,'Obsolescencia Muebles','1021111',NULL,'2020-04-22 22:20:32',1,1,1,75),(81,'Obsolescencia Equipos de oficina','1021121',NULL,'2020-04-22 22:20:32',1,1,1,75),(82,'Revalorización Equipos','10212',NULL,'2020-04-22 22:20:32',1,1,1,37),(83,'Revalorización Vehículos automotores','1021201',NULL,'2020-04-22 22:20:32',1,1,1,82),(84,'Revalorización Vehículos automotores de carga','1021202',NULL,'2020-04-22 22:20:32',1,1,1,82),(85,'Revalorización Vehículos de trasmisión mecánica','1021203',NULL,'2020-04-22 22:20:32',1,1,1,82),(86,'Revalorización Maquinaria pesada','1021204',NULL,'2020-04-22 22:20:32',1,1,1,82),(87,'Revalorización Muebles','1021211',NULL,'2020-04-22 22:20:32',1,1,1,82),(88,'Revalorización Equipos de oficina','1021221',NULL,'2020-04-22 22:20:32',1,1,1,82),(89,'Obsolescencia Revalorización de Equipos','10213',NULL,'2020-04-22 22:20:32',1,1,1,37),(90,'Obsolescencia Rev. Vehículos automotores','1021301',NULL,'2020-04-22 22:20:32',1,1,1,89),(91,'Obsolescencia Rev. Veh. automotores de carga','1021302',NULL,'2020-04-22 22:20:32',1,1,1,89),(92,'Obsolescencia Rev. Veh. Trasmisión mecánica','1021303',NULL,'2020-04-22 22:20:32',1,1,1,89),(93,'Obsolescencia Rev. Maq. pesada','1021304',NULL,'2020-04-22 22:20:32',1,1,1,89),(94,'Obsolescencia Rev. Muebles','1021311',NULL,'2020-04-22 22:20:32',1,1,1,89),(95,'Obsolescencia Rev. Equipos de oficina','1021321',NULL,'2020-04-22 22:20:32',1,1,1,89),(96,'Deprec. Acum. Revalorización de Equipos','10214',NULL,'2020-04-22 22:20:32',1,1,1,37),(97,'Deprec. Acum. Reval. Vehículos automotores','1021401',NULL,'2020-04-22 22:20:32',1,1,1,96),(98,'Deprec. Acum. Rev Vehículos automotores de carga','1021402',NULL,'2020-04-22 22:20:32',1,1,1,96),(99,'Deprec. Acum. Rev Veh. de trasmisión Mec.','1021403',NULL,'2020-04-22 22:20:32',1,1,1,96),(100,'Deprec. Acum. Revalorización Maquinaria pesada','1021404',NULL,'2020-04-22 22:20:32',1,1,1,96),(101,'Deprec. Acum. Revalorización Muebles','1021411',NULL,'2020-04-22 22:20:32',1,1,1,96),(102,'Deprec. Acum. Revalorización Equipos de oficina','1021421',NULL,'2020-04-22 22:20:32',1,1,1,96),(103,'Intangibles','10215',NULL,'2020-04-22 22:20:32',1,1,1,37),(104,'Derechos de autor','1021501',NULL,'2020-04-22 22:20:32',1,1,1,103),(105,'Franquicias','1021502',NULL,'2020-04-22 22:20:32',1,1,1,103),(106,'Marcas de fabrica','1021503',NULL,'2020-04-22 22:20:32',1,1,1,103),(107,'Patentes','1021504',NULL,'2020-04-22 22:20:32',1,1,1,103),(108,'Plusvalía','1021505',NULL,'2020-04-22 22:20:32',1,1,1,103),(109,'Software','1021506',NULL,'2020-04-22 22:20:32',1,1,1,103),(110,'Amortización intangibles','10216',NULL,'2020-04-22 22:20:32',1,1,1,37),(111,'Amortización derechos de autor','1021601',NULL,'2020-04-22 22:20:32',1,1,1,110),(112,'Amortización franquicias','1021602',NULL,'2020-04-22 22:20:32',1,1,1,110),(113,'Amortización marcas de fabrica','1021603',NULL,'2020-04-22 22:20:32',1,1,1,110),(114,'Amortización patentes','1021604',NULL,'2020-04-22 22:20:32',1,1,1,110),(115,'Amortización plusvalía','1021605',NULL,'2020-04-22 22:20:32',1,1,1,110),(116,'Amortización Software','1021606',NULL,'2020-04-22 22:20:32',1,1,1,110),(117,'Activos diferidos','103',NULL,'2020-04-22 22:20:32',1,1,1,1),(118,'Gastos diferidos','10301',NULL,'2020-04-22 22:20:32',1,1,1,117),(119,'Gastos de constitución','1030101',NULL,'2020-04-22 22:20:32',1,1,1,118),(120,'Gastos de organización','1030102',NULL,'2020-04-22 22:20:32',1,1,1,118),(121,'Gastos por campañas publicitarias','1030103',NULL,'2020-04-22 22:20:32',1,1,1,118),(122,'Seguros Prepagados','10302',NULL,'2020-04-22 22:20:32',1,1,1,117),(123,'Otros Activos','199',NULL,'2020-04-22 22:20:32',1,1,1,1),(124,'Depósitos dados en Garantía','19901',NULL,'2020-04-22 22:20:32',1,1,1,123),(125,'Depósitos dados en Garantía','1990101',NULL,'2020-04-22 22:20:32',1,1,1,124),(126,'Terrenos no utilizados','19902',NULL,'2020-04-22 22:20:32',1,1,1,123),(127,'Muebles en Desuso','19903',NULL,'2020-04-22 22:20:32',1,1,1,123),(128,'Pasivo','2',NULL,'2020-04-25 02:53:52',2,1,4,128),(129,'Pasivo Corriente','201',NULL,'2020-04-25 02:53:52',2,1,4,128),(130,'Efectos por pagar','20101',NULL,'2020-04-25 02:53:52',2,1,4,129),(131,'Efectos Bancarios','2010101',NULL,'2020-04-25 02:53:52',2,1,4,130),(132,'Efectos Comerciales','2010102',NULL,'2020-04-25 02:53:52',2,1,4,130),(133,'Cuentas por Pagar','20102',NULL,'2020-04-25 02:53:52',2,1,4,129),(134,'Préstamos Bancarios (Corto Plazo)','2010201',NULL,'2020-04-25 02:53:52',2,1,4,133),(135,'Cuentas Por Pagar Proveedores','2010202',NULL,'2020-04-25 02:53:52',2,1,4,133),(136,'Proveedores Recurentes','2010202001',NULL,'2020-04-25 02:53:52',2,1,4,135),(137,'Cuentas por pagar Gubernamentales','2010203',NULL,'2020-04-25 02:53:52',2,1,4,133),(138,'Impuestos al valor agregado','2010203001',NULL,'2020-04-25 02:53:52',2,1,4,137),(139,'Retenciones impuestos al valor agregado','2010203002',NULL,'2020-04-25 02:53:52',2,1,4,137),(140,'I.S.L.R.','2010203003',NULL,'2020-04-25 02:53:52',2,1,4,137),(141,'Retenciones I.S.L.R.','2010203004',NULL,'2020-04-25 02:53:52',2,1,4,137),(142,'I.V.S.S. (Seguro Social)','2010203005',NULL,'2020-04-25 02:53:52',2,1,4,137),(143,'P.I.E. (Perdida Involuntaria del empleo)','2010203006',NULL,'2020-04-25 02:53:52',2,1,4,137),(144,'Banavih','2010203007',NULL,'2020-04-25 02:53:52',2,1,4,137),(145,'I.N.C.E.S.','2010203008',NULL,'2020-04-25 02:53:52',2,1,4,137),(146,'Patente industria y comercio','2010203009',NULL,'2020-04-25 02:53:52',2,1,4,137),(147,'Cuentas por pagar empleados','2010204',NULL,'2020-04-25 02:53:52',2,1,4,133),(148,'Sueldos','2010204001',NULL,'2020-04-25 02:53:52',2,1,4,147),(149,'Horas extraordinarias','2010204002',NULL,'2020-04-25 02:53:52',2,1,4,147),(150,'Vacaciones','2010204003',NULL,'2020-04-25 02:53:52',2,1,4,147),(151,'Bono vacacional','2010204004',NULL,'2020-04-25 02:53:52',2,1,4,147),(152,'Utilidades','2010204005',NULL,'2020-04-25 02:53:52',2,1,4,147),(153,'Prestaciones Antigüedad','2010204006',NULL,'2020-04-25 02:53:52',2,1,4,147),(154,'Intereses sobres Prestaciones Antigüedad','2010204007',NULL,'2020-04-25 02:53:52',2,1,4,147),(155,'Bono por antigüedad','2010204008',NULL,'2020-04-25 02:53:52',2,1,4,147),(156,'Bono','2010204009',NULL,'2020-04-25 02:53:52',2,1,4,147),(157,'Bono para alimentación','2010204010',NULL,'2020-04-25 02:53:52',2,1,4,147),(158,'Días Feriados','2010204011',NULL,'2020-04-25 02:53:52',2,1,4,147),(159,'Dividendos por pagar','2010205',NULL,'2020-04-25 02:53:52',2,1,4,133),(160,'Anticipos de clientes','2010206',NULL,'2020-04-25 02:53:52',2,1,4,133),(161,'Cuentas por pagar compañias asociadas','2010207',NULL,'2020-04-25 02:53:52',2,1,4,133),(162,'Provisiones para contingencias','2010208',NULL,'2020-04-25 02:53:52',2,1,4,133),(163,'Pasivo No Corriente','202',NULL,'2020-04-25 02:53:52',2,1,4,128),(164,'Efectos por pagar (Largo Plazo)','20201',NULL,'2020-04-25 02:53:52',2,1,4,163),(165,'Efectos Bancarios','2020101',NULL,'2020-04-25 02:53:52',2,1,4,164),(166,'Efectos Comerciales','2020102',NULL,'2020-04-25 02:53:52',2,1,4,164),(167,'Cuentas por pagar Largo Plazo','20202',NULL,'2020-04-25 02:53:52',2,1,4,163),(168,'Hipocetas Por pagar','20203',NULL,'2020-04-25 02:53:52',2,1,4,163),(169,'Préstamos Bancarios (Largo Plazo)','20204',NULL,'2020-04-25 02:53:52',2,1,4,163),(170,'Otras Cuentas por Pagar (Largo Plazo)','20205',NULL,'2020-04-25 02:53:53',2,1,4,163),(171,'Préstamos Bancarios (Largo Plazo)','20206',NULL,'2020-04-25 02:53:53',2,1,4,163),(172,'Apartados','20207',NULL,'2020-04-25 02:53:53',2,1,4,163),(173,'Apartado de prestaciones sociales','2020701',NULL,'2020-04-25 02:53:53',2,1,4,172),(174,'Prestaciones por antigüedad','2020701001',NULL,'2020-04-25 02:53:53',2,1,4,173),(175,'Intereses sobre prestaciones de antigüedad','2020701002',NULL,'2020-04-25 02:53:53',2,1,4,173),(176,'Apartado para juicios pendientes','2020702',NULL,'2020-04-25 02:53:53',2,1,4,172),(177,'Diferidos','20208',NULL,'2020-04-25 02:53:53',2,1,4,163),(178,'Créditos diferidos','2020801',NULL,'2020-04-25 02:53:53',2,1,4,177),(179,'Alquileres cobrados por anticipado','2020801001',NULL,'2020-04-25 02:53:53',2,1,4,178),(180,'Intereses cobrados por anticipados','2020801002',NULL,'2020-04-25 02:53:53',2,1,4,178),(181,'Otros ingresos cobrados por anticipado','2020801003',NULL,'2020-04-25 02:53:53',2,1,4,178),(182,'Otros','20299',NULL,'2020-04-25 02:53:53',2,1,4,163),(183,'Depósitos recibidos en garantía','2029901',NULL,'2020-04-25 02:53:53',2,1,4,182),(184,'Utilidades no reclamadas','2029902',NULL,'2020-04-25 02:53:53',2,1,4,182),(185,'Cuentas por pagar accionistas','2029903',NULL,'2020-04-25 02:53:53',2,1,4,182),(186,'Patrimonio','3',NULL,'2020-04-25 03:03:26',1,1,5,186),(187,'Capital social','301',NULL,'2020-04-25 03:03:26',1,1,5,186),(188,'Emitido','30101',NULL,'2020-04-25 03:03:26',1,1,5,187),(189,'Pagado','3010101',NULL,'2020-04-25 03:03:26',1,1,5,188),(190,'Accionista','3010101001',NULL,'2020-04-25 03:03:26',1,1,5,189),(191,'Accionista','3010101002',NULL,'2020-04-25 03:03:26',1,1,5,189),(192,'Suscrito','3010102',NULL,'2020-04-25 03:03:26',1,1,5,188),(193,'Reservado','30102',NULL,'2020-04-25 03:03:26',1,1,5,187),(194,'Reservas acumuladas','3010201',NULL,'2020-04-25 03:03:26',1,1,5,193),(195,'Reserva legal','3010201001',NULL,'2020-04-25 03:03:26',1,1,5,194),(196,'Reserva estatutaria','3010201002',NULL,'2020-04-25 03:03:26',1,1,5,194),(197,'Reserva Voluntarias','3010201003',NULL,'2020-04-25 03:03:26',1,1,5,194),(198,'Otras reservas','3010201999',NULL,'2020-04-25 03:03:26',1,1,5,194),(199,'Resultados','302',NULL,'2020-04-25 03:03:26',1,1,5,186),(200,'Históricos','30201',NULL,'2020-04-25 03:03:26',1,1,5,199),(201,'Utilidad o Pérdida histórica','3020101',NULL,'2020-04-25 03:03:26',1,1,5,200),(202,'Utilidad o Pérdida no distribuida','3020101001',NULL,'2020-04-25 03:03:26',1,1,5,201),(203,'Resultado actual','30202',NULL,'2020-04-25 03:03:26',1,1,5,199),(204,'Utilidad o Pérdida actual','3020201',NULL,'2020-04-25 03:03:26',1,1,5,203),(205,'Utilidad o Pérdida del ejercicio','3020201001',NULL,'2020-04-25 03:03:26',1,1,5,204),(206,'Diferencia reconversión monetaria','3020201002',NULL,'2020-04-25 03:03:26',1,1,5,204),(207,'Ingresos','4',NULL,'2020-04-25 03:12:02',1,1,3,207),(208,'Ventas de la actividad','401',NULL,'2020-04-25 03:12:02',1,1,3,207),(209,'Bienes','40101',NULL,'2020-04-25 03:12:02',1,1,3,208),(210,'Productos Exentos','4010101',NULL,'2020-04-25 03:12:02',1,1,3,209),(211,'Descuentos en Ventas  Exentas','4010102',NULL,'2020-04-25 03:12:02',1,1,3,209),(212,'Devoluciones en Ventas Exentas','4010103',NULL,'2020-04-25 03:12:02',1,1,3,209),(213,'Productos Gravadas','4010104',NULL,'2020-04-25 03:12:02',1,1,3,209),(214,'Descuentos en Ventas  Gravadas','4010105',NULL,'2020-04-25 03:12:02',1,1,3,209),(215,'Devoluciones en Ventas Gravadas','4010106',NULL,'2020-04-25 03:12:02',1,1,3,209),(216,'Servicios','40102',NULL,'2020-04-25 03:12:02',1,1,3,208),(217,'Servicios exentos','4010201',NULL,'2020-04-25 03:12:02',1,1,3,216),(218,'Descuentos en servicios exentos','4010202',NULL,'2020-04-25 03:12:02',1,1,3,216),(219,'Notas de créditos en servicio exentos','4010203',NULL,'2020-04-25 03:12:02',1,1,3,216),(220,'Servicios Gravados','4010204',NULL,'2020-04-25 03:12:02',1,1,3,216),(221,'Descuentos en servicios Gravados','4010205',NULL,'2020-04-25 03:12:02',1,1,3,216),(222,'Notas de créditos en servicio Gravados','4010206',NULL,'2020-04-25 03:12:02',1,1,3,216),(223,'Otras ventas','402',NULL,'2020-04-25 03:12:02',1,1,3,207),(224,'Bienes','40201',NULL,'2020-04-25 03:12:02',1,1,3,223),(225,'Otros Productos Exentos','4020101',NULL,'2020-04-25 03:12:02',1,1,3,224),(226,'Descuentos en otras ventas Exentas','4020102',NULL,'2020-04-25 03:12:02',1,1,3,224),(227,'Devoluciones en otras ventas Exentas','4020103',NULL,'2020-04-25 03:12:02',1,1,3,224),(228,'Otros Productos Gravados','4020104',NULL,'2020-04-25 03:12:02',1,1,3,224),(229,'Descuentos en otras ventas Gravadas','4020105',NULL,'2020-04-25 03:12:02',1,1,3,224),(230,'Devoluciones en otras ventas Gravadas','4020106',NULL,'2020-04-25 03:12:02',1,1,3,224),(231,'Ingresos por Venta Activo fijo','4020107',NULL,'2020-04-25 03:12:02',1,1,3,224),(232,'Servicios','40202',NULL,'2020-04-25 03:12:02',1,1,3,223),(233,'Otros Servicios Exentos','4020201',NULL,'2020-04-25 03:12:02',1,1,3,232),(234,'Descuentos en servicios Exentos','4020202',NULL,'2020-04-25 03:12:02',1,1,3,232),(235,'Notas de créditos en servicio Exentos','4020203',NULL,'2020-04-25 03:12:02',1,1,3,232),(236,'Otros Servicios Gravados','4020204',NULL,'2020-04-25 03:12:02',1,1,3,232),(237,'Descuentos en servicios Gravados','4020205',NULL,'2020-04-25 03:12:02',1,1,3,232),(238,'Notas de créditos en servicio Gravados','4020206',NULL,'2020-04-25 03:12:02',1,1,3,232),(239,'Permutas','403',NULL,'2020-04-25 03:12:02',1,1,3,207),(240,'Permuta de Bienes','40301',NULL,'2020-04-25 03:12:02',1,1,3,239),(241,'Ingreso por Permutas Exentas','4030101',NULL,'2020-04-25 03:12:02',1,1,3,240),(242,'Ingresos por Permutas Gravadas','4030102',NULL,'2020-04-25 03:12:02',1,1,3,240),(243,'Ingresos por Permutas de Activo Fijo','4030103',NULL,'2020-04-25 03:12:02',1,1,3,240),(244,'Permuta de Servicios','40302',NULL,'2020-04-25 03:12:02',1,1,3,239),(245,'Permuta de servicios Exentos','4030201',NULL,'2020-04-25 03:12:02',1,1,3,244),(246,'Permuta de servicios Gravados','4030202',NULL,'2020-04-25 03:12:02',1,1,3,244),(247,'Ventas en especies','404',NULL,'2020-04-25 03:12:02',1,1,3,207),(248,'Bienes','40401',NULL,'2020-04-25 03:12:02',1,1,3,247),(249,'Ventas Exentas (Especies)','4040101',NULL,'2020-04-25 03:12:02',1,1,3,248),(250,'Descuentos en ventas Exentas (Especies)','4040102',NULL,'2020-04-25 03:12:02',1,1,3,248),(251,'Devoluciones en ventas Exentas (Especies)','4040103',NULL,'2020-04-25 03:12:02',1,1,3,248),(252,'Ventas Gravadas (Especies)','4040104',NULL,'2020-04-25 03:12:03',1,1,3,248),(253,'Descuentos en ventas Gravadas (Especies)','4040105',NULL,'2020-04-25 03:12:03',1,1,3,248),(254,'Devoluciones en ventas Gravadas Especies)','4040106',NULL,'2020-04-25 03:12:03',1,1,3,248),(255,'Servicios','40402',NULL,'2020-04-25 03:12:03',1,1,3,247),(256,'Servicios exentos','4040201',NULL,'2020-04-25 03:12:03',1,1,3,255),(257,'Descuentos en servicios Exentos','4040202',NULL,'2020-04-25 03:12:03',1,1,3,255),(258,'Notas de créditos en servicio Exentos','4040203',NULL,'2020-04-25 03:12:03',1,1,3,255),(259,'Servicios Gravados','4040204',NULL,'2020-04-25 03:12:03',1,1,3,255),(260,'Descuentos en servicios Gravados','4040205',NULL,'2020-04-25 03:12:03',1,1,3,255),(261,'Notas de créditos en servicio Gravados','4040206',NULL,'2020-04-25 03:12:03',1,1,3,255),(262,'Otros ingresos','49901',NULL,'2020-04-25 03:12:03',1,1,3,207),(263,'Bancarios','49901',NULL,'2020-04-25 03:12:03',1,1,3,262),(264,'Ingresos por intereses','4990101',NULL,'2020-04-25 03:12:03',1,1,3,263),(265,'Ajustes en ingresos','49999',NULL,'2020-04-25 03:12:03',1,1,3,262),(266,'Ajustes de años anteriores','4999999',NULL,'2020-04-25 03:12:03',1,1,3,265),(267,'Costos','5',NULL,'2020-04-25 03:24:12',2,1,6,267),(268,'Directos','501',NULL,'2020-04-25 03:24:12',2,1,6,267),(269,'Fijos','50101',NULL,'2020-04-25 03:24:12',2,1,6,268),(270,'De Producción ','5010101',NULL,'2020-04-25 03:24:12',2,1,6,269),(271,'Mano de obra','5010101001',NULL,'2020-04-25 03:24:12',2,1,6,270),(272,'Comercialización','5010102',NULL,'2020-04-25 03:24:12',2,1,6,269),(273,'Por Ditribución','5010103',NULL,'2020-04-25 03:24:12',2,1,6,269),(274,'De Administración','5010104',NULL,'2020-04-25 03:24:12',2,1,6,269),(275,'Fletes','5010104001',NULL,'2020-04-25 03:24:12',2,1,6,274),(276,'De Financiamiento','5010105',NULL,'2020-04-25 03:24:12',2,1,6,269),(277,'Variables','50102',NULL,'2020-04-25 03:24:12',2,1,6,268),(278,'De Producción ','5010201',NULL,'2020-04-25 03:24:12',2,1,6,277),(279,'Mano de obra','5010201001',NULL,'2020-04-25 03:24:12',2,1,6,278),(280,'Por Ditribución','5010202',NULL,'2020-04-25 03:24:12',2,1,6,277),(281,'De Administración','5010203',NULL,'2020-04-25 03:24:12',2,1,6,277),(282,'Fletes','5010203001',NULL,'2020-04-25 03:24:12',2,1,6,281),(283,'De Financiamiento','5010204',NULL,'2020-04-25 03:24:12',2,1,6,277),(284,'Indirectos','502',NULL,'2020-04-25 03:24:12',2,1,6,267),(285,'Fijos','50201',NULL,'2020-04-25 03:24:12',2,1,6,284),(286,'De Producción ','5020101',NULL,'2020-04-25 03:24:12',2,1,6,285),(287,'Mano de obra','5020101001',NULL,'2020-04-25 03:24:12',2,1,6,286),(288,'Comercialización','5020102',NULL,'2020-04-25 03:24:12',2,1,6,285),(289,'Por Ditribución','5020103',NULL,'2020-04-25 03:24:12',2,1,6,285),(290,'De Administración','5020104',NULL,'2020-04-25 03:24:12',2,1,6,285),(291,'Fletes','5020104001',NULL,'2020-04-25 03:24:12',2,1,6,290),(292,'De Financiamiento','5020105',NULL,'2020-04-25 03:24:12',2,1,6,285),(293,'Variables','50202',NULL,'2020-04-25 03:24:12',2,1,6,284),(294,'De Producción ','5020201',NULL,'2020-04-25 03:24:12',2,1,6,293),(295,'Mano de obra','5020201001',NULL,'2020-04-25 03:24:12',2,1,6,294),(296,'Por Ditribución','5020202',NULL,'2020-04-25 03:24:12',2,1,6,293),(297,'De Administración','5020203',NULL,'2020-04-25 03:24:12',2,1,6,293),(298,'Fletes','5020203001',NULL,'2020-04-25 03:24:12',2,1,6,297),(299,'De Financiamiento','5020204',NULL,'2020-04-25 03:24:12',2,1,6,293),(300,'Gastos','6',NULL,'2020-04-25 03:33:15',2,1,2,300),(301,'De Producción ','601',NULL,'2020-04-25 03:33:15',2,1,2,300),(302,'Departamento Producción','60101',NULL,'2020-04-25 03:33:15',2,1,2,301),(303,'Gastos laboral','6010101',NULL,'2020-04-25 03:33:15',2,1,2,302),(304,'Sueldos','6010101001',NULL,'2020-04-25 03:33:15',2,1,2,303),(305,'Horas extraordinarias','6010101002',NULL,'2020-04-25 03:33:15',2,1,2,303),(306,'Vacaciones','6010101003',NULL,'2020-04-25 03:33:15',2,1,2,303),(307,'Bono vacacional','6010101004',NULL,'2020-04-25 03:33:15',2,1,2,303),(308,'Utilidades','6010101005',NULL,'2020-04-25 03:33:15',2,1,2,303),(309,'Prestaciones Antigüedad','6010101006',NULL,'2020-04-25 03:33:15',2,1,2,303),(310,'Intereses sobres Prestaciones Antigüedad','6010101007',NULL,'2020-04-25 03:33:15',2,1,2,303),(311,'Bono por antigüedad','6010101008',NULL,'2020-04-25 03:33:15',2,1,2,303),(312,'Bono','6010101009',NULL,'2020-04-25 03:33:15',2,1,2,303),(313,'Bono para alimentación','6010101010',NULL,'2020-04-25 03:33:15',2,1,2,303),(314,'Feriados','6010101011',NULL,'2020-04-25 03:33:15',2,1,2,303),(315,'Agasajos','6010101012',NULL,'2020-04-25 03:33:15',2,1,2,303),(316,'Donaciones','6010101013',NULL,'2020-04-25 03:33:15',2,1,2,303),(317,'Seguro y gastos médicos','6010101014',NULL,'2020-04-25 03:33:15',2,1,2,303),(318,'Viaticos','6010102',NULL,'2020-04-25 03:33:15',2,1,2,302),(319,'Hospedaje','6010102001',NULL,'2020-04-25 03:33:15',2,1,2,318),(320,'Estacionamiento','6010102002',NULL,'2020-04-25 03:33:15',2,1,2,318),(321,'Alimentación','6010102003',NULL,'2020-04-25 03:33:15',2,1,2,318),(322,'Gastos de representación','6010102004',NULL,'2020-04-25 03:33:15',2,1,2,318),(323,'Transporte','6010102005',NULL,'2020-04-25 03:33:15',2,1,2,318),(324,'Teléfono','6010102006',NULL,'2020-04-25 03:33:15',2,1,2,318),(325,'De Ventas','602',NULL,'2020-04-25 03:33:15',2,1,2,300),(326,'Departamento Comercialización','60201',NULL,'2020-04-25 03:33:15',2,1,2,325),(327,'Gastos laboral','6020101',NULL,'2020-04-25 03:33:15',2,1,2,326),(328,'Sueldos','6020101001',NULL,'2020-04-25 03:33:15',2,1,2,327),(329,'Horas extraordinarias','6020101002',NULL,'2020-04-25 03:33:15',2,1,2,327),(330,'Vacaciones','6020101003',NULL,'2020-04-25 03:33:15',2,1,2,327),(331,'Bono vacacional','6020101004',NULL,'2020-04-25 03:33:15',2,1,2,327),(332,'Utilidades','6020101005',NULL,'2020-04-25 03:33:15',2,1,2,327),(333,'Prestaciones Antigüedad','6020101006',NULL,'2020-04-25 03:33:15',2,1,2,327),(334,'Intereses sobres Prestaciones Antigüedad','6020101007',NULL,'2020-04-25 03:33:15',2,1,2,327),(335,'Bono por antigüedad','6020101008',NULL,'2020-04-25 03:33:15',2,1,2,327),(336,'Bono','6020101009',NULL,'2020-04-25 03:33:15',2,1,2,327),(337,'Bono para alimentación','6020101010',NULL,'2020-04-25 03:33:15',2,1,2,327),(338,'Feriados','6020101011',NULL,'2020-04-25 03:33:15',2,1,2,327),(339,'Agasajos','6020101012',NULL,'2020-04-25 03:33:15',2,1,2,327),(340,'Donaciones','6020101013',NULL,'2020-04-25 03:33:15',2,1,2,327),(341,'Seguro y gastos médicos','6020101014',NULL,'2020-04-25 03:33:15',2,1,2,327),(342,'Viáticos','6020102',NULL,'2020-04-25 03:33:15',2,1,2,326),(343,'Hospedaje','6020102001',NULL,'2020-04-25 03:33:15',2,1,2,342),(344,'Estacionamiento','6020102002',NULL,'2020-04-25 03:33:15',2,1,2,342),(345,'Alimentación','6020102003',NULL,'2020-04-25 03:33:15',2,1,2,342),(346,'Gastos de representación','6020102004',NULL,'2020-04-25 03:33:15',2,1,2,342),(347,'Transporte','6020102005',NULL,'2020-04-25 03:33:15',2,1,2,342),(348,'Teléfono','6020102006',NULL,'2020-04-25 03:33:15',2,1,2,342),(349,'Eventos','6020103',NULL,'2020-04-25 03:33:15',2,1,2,326),(350,'Stand','6020103001',NULL,'2020-04-25 03:33:15',2,1,2,349),(351,'De Administración','603',NULL,'2020-04-25 03:33:15',2,1,2,300),(352,'Departamento de administración','60301',NULL,'2020-04-25 03:33:15',2,1,2,351),(353,'Servicios básicos','6030101',NULL,'2020-04-25 03:33:15',2,1,2,352),(354,'Alquiler','6030101001',NULL,'2020-04-25 03:33:15',2,1,2,353),(355,'Teléfono','6030101002',NULL,'2020-04-25 03:33:15',2,1,2,353),(356,'Electricidad','6030101003',NULL,'2020-04-25 03:33:15',2,1,2,353),(357,'Aseo Urbano','6030101004',NULL,'2020-04-25 03:33:15',2,1,2,353),(358,'Otros','6030101999',NULL,'2020-04-25 03:33:15',2,1,2,353),(359,'Implementos de oficina','6030102',NULL,'2020-04-25 03:33:15',2,1,2,352),(360,'Papelería y material','6030102001',NULL,'2020-04-25 03:33:15',2,1,2,359),(361,'Fotocopias','6030102002',NULL,'2020-04-25 03:33:15',2,1,2,359),(362,'Artículos de oficina','6030102003',NULL,'2020-04-25 03:33:15',2,1,2,359),(363,'Uniformes','6030102004',NULL,'2020-04-25 03:33:15',2,1,2,359),(364,'Empaques','6030102005',NULL,'2020-04-25 03:33:15',2,1,2,359),(365,'Gestiones','6030103',NULL,'2020-04-25 03:33:15',2,1,2,352),(366,'Correspondencia / encomiendas','6030103001',NULL,'2020-04-25 03:33:15',2,1,2,365),(367,'Gastos por gestiones','6030103002',NULL,'2020-04-25 03:33:15',2,1,2,365),(368,'Limpieza y mantenimiento','6030103003',NULL,'2020-04-25 03:33:15',2,1,2,365),(369,'Publicidad y propaganda','6030103004',NULL,'2020-04-25 03:33:15',2,1,2,365),(370,'Notaria y registro','6030103005',NULL,'2020-04-25 03:33:15',2,1,2,365),(371,'Honorarios','6030103006',NULL,'2020-04-25 03:33:15',2,1,2,365),(372,'Muebles y enseres','6030104',NULL,'2020-04-25 03:33:15',2,1,2,352),(373,'Equipos de computación','6030104001',NULL,'2020-04-25 03:33:15',2,1,2,372),(374,'Mobiliario','6030104002',NULL,'2020-04-25 03:33:15',2,1,2,372),(375,'Gastos de personal','6030105',NULL,'2020-04-25 03:33:15',2,1,2,352),(376,'Sueldos','6030105001',NULL,'2020-04-25 03:33:15',2,1,2,375),(377,'Horas extraordinarias','6030105002',NULL,'2020-04-25 03:33:15',2,1,2,375),(378,'Vacaciones','6030105003',NULL,'2020-04-25 03:33:15',2,1,2,375),(379,'Bono vacacional','6030105004',NULL,'2020-04-25 03:33:15',2,1,2,375),(380,'Utilidades','6030105005',NULL,'2020-04-25 03:33:15',2,1,2,375),(381,'Prestaciones Antigüedad','6030105006',NULL,'2020-04-25 03:33:15',2,1,2,375),(382,'Intereses sobres Prestaciones Antigüedad','6030105007',NULL,'2020-04-25 03:33:15',2,1,2,375),(383,'Bono por antigüedad','6030105008',NULL,'2020-04-25 03:33:15',2,1,2,375),(384,'Bono','6030105009',NULL,'2020-04-25 03:33:15',2,1,2,375),(385,'Bono para alimentación','6030105010',NULL,'2020-04-25 03:33:15',2,1,2,375),(386,'Feriados','6030105011',NULL,'2020-04-25 03:33:15',2,1,2,375),(387,'Agasajos','6030105012',NULL,'2020-04-25 03:33:15',2,1,2,375),(388,'Donaciones','6030105013',NULL,'2020-04-25 03:33:15',2,1,2,375),(389,'Seguro y gastos médicos','6030105014',NULL,'2020-04-25 03:33:15',2,1,2,375),(390,'I.V.S.S. (Seguro Social Obligatorio)','6030105015',NULL,'2020-04-25 03:33:15',2,1,2,375),(391,'Pérdida Involuntaria del Empleo (P.I.E.)','6030105016',NULL,'2020-04-25 03:33:15',2,1,2,375),(392,'Banavih / Faov','6030105017',NULL,'2020-04-25 03:33:15',2,1,2,375),(393,'I.N.C.E.S.','6030105018',NULL,'2020-04-25 03:33:15',2,1,2,375),(394,'Viáticos','6030106',NULL,'2020-04-25 03:33:15',2,1,2,352),(395,'Hospedaje','6030106001',NULL,'2020-04-25 03:33:15',2,1,2,394),(396,'Estacionamiento','6030106002',NULL,'2020-04-25 03:33:15',2,1,2,394),(397,'Alimentación','6030106003',NULL,'2020-04-25 03:33:15',2,1,2,394),(398,'Gastos de representación','6030106004',NULL,'2020-04-25 03:33:15',2,1,2,394),(399,'Transporte','6030106005',NULL,'2020-04-25 03:33:15',2,1,2,394),(400,'Depreciación','6030107',NULL,'2020-04-25 03:33:15',2,1,2,352),(401,'Depreciación de edificios','6030107001',NULL,'2020-04-25 03:33:15',2,1,2,400),(402,'Depreciación Vehículos Automotores','6030107002',NULL,'2020-04-25 03:33:15',2,1,2,400),(403,'Depreciación Vehículos automotores de carga','6030107003',NULL,'2020-04-25 03:33:15',2,1,2,400),(404,'Depreciación Vehículos de trasmisión mecánica','6030107004',NULL,'2020-04-25 03:33:15',2,1,2,400),(405,'Depreciación Maquinaria pesada','6030107005',NULL,'2020-04-25 03:33:15',2,1,2,400),(406,'Depreciación de Muebles','6030107006',NULL,'2020-04-25 03:33:15',2,1,2,400),(407,'Depreciación de Equipos de oficina','6030107007',NULL,'2020-04-25 03:33:15',2,1,2,400),(408,'Obsolescencia','6030108',NULL,'2020-04-25 03:33:15',2,1,2,352),(409,'Obsolescencia Vehículos Automotores','6030108001',NULL,'2020-04-25 03:33:15',2,1,2,408),(410,'Obsolescencia Vehículos automotores de carga','6030108002',NULL,'2020-04-25 03:33:15',2,1,2,408),(411,'Obsolescencia Vehículos de trasmisión mecánica','6030108003',NULL,'2020-04-25 03:33:15',2,1,2,408),(412,'Obsolescencia Maquinaria pesada','6030108004',NULL,'2020-04-25 03:33:15',2,1,2,408),(413,'Obsolescencia de Muebles','6030108005',NULL,'2020-04-25 03:33:15',2,1,2,408),(414,'Obsolescencia de Equipos de oficina','6030108006',NULL,'2020-04-25 03:33:15',2,1,2,408),(415,'Amortizaciones','6030109',NULL,'2020-04-25 03:33:15',2,1,2,352),(416,'Amortización derechos de autor','6030109001',NULL,'2020-04-25 03:33:15',2,1,2,415),(417,'Amortización franquicias','6030109002',NULL,'2020-04-25 03:33:15',2,1,2,415),(418,'Amortización marcas de fabrica','6030109003',NULL,'2020-04-25 03:33:15',2,1,2,415),(419,'Amortización patentes','6030109004',NULL,'2020-04-25 03:33:15',2,1,2,415),(420,'Amortización plusvalía','6030109005',NULL,'2020-04-25 03:33:15',2,1,2,415),(421,'Amortización Software','6030109006',NULL,'2020-04-25 03:33:15',2,1,2,415),(422,'Mantenimiento','6030110',NULL,'2020-04-25 03:33:15',2,1,2,352),(423,'Mantenimiento de Vehículos','6030110001',NULL,'2020-04-25 03:33:15',2,1,2,422),(424,'Mantenimiento de Mobiliario','6030110002',NULL,'2020-04-25 03:33:15',2,1,2,422),(425,'Mantenimiento de Equipo','6030110003',NULL,'2020-04-25 03:33:15',2,1,2,422),(426,'Reparaciones','6030111',NULL,'2020-04-25 03:33:15',2,1,2,352),(427,'Reparaciones de Vehículos','6030111001',NULL,'2020-04-25 03:33:15',2,1,2,426),(428,'Reparaciones de Mobiliario','6030111002',NULL,'2020-04-25 03:33:15',2,1,2,426),(429,'Reparaciones de Equipo','6030111003',NULL,'2020-04-25 03:33:15',2,1,2,426),(430,'Resguardo y Vigilancia','6030112',NULL,'2020-04-25 03:33:15',2,1,2,352),(431,'Vigilancia','6030112001',NULL,'2020-04-25 03:33:15',2,1,2,430),(432,'Equipo de vigilancia (Tecnologíco)','6030112002',NULL,'2020-04-25 03:33:15',2,1,2,430),(433,'Suministros para la vigilancia','6030112003',NULL,'2020-04-25 03:33:15',2,1,2,430),(434,'Polizas de Seguros','6030113',NULL,'2020-04-25 03:33:15',2,1,2,352),(435,'Seguro de edificios','6030113001',NULL,'2020-04-25 03:33:15',2,1,2,434),(436,'Seguro Vehículos Automotores','6030113002',NULL,'2020-04-25 03:33:15',2,1,2,434),(437,'Seguro Vehículos automotores de carga','6030113003',NULL,'2020-04-25 03:33:15',2,1,2,434),(438,'Seguro Vehículos de trasmisión mecánica','6030113004',NULL,'2020-04-25 03:33:15',2,1,2,434),(439,'Seguro Maquinaria pesada','6030113005',NULL,'2020-04-25 03:33:15',2,1,2,434),(440,'Seguro de Muebles','6030113006',NULL,'2020-04-25 03:33:15',2,1,2,434),(441,'Seguro de Equipos de oficina','6030113007',NULL,'2020-04-25 03:33:15',2,1,2,434),(442,'Gastos Bancarios','6030198',NULL,'2020-04-25 03:33:15',2,1,2,352),(443,'Gastos bancarios','6030198001',NULL,'2020-04-25 03:33:15',2,1,2,442),(444,'Comisión','6030198002',NULL,'2020-04-25 03:33:15',2,1,2,442),(445,'Intereses sobre prestamos','6030198003',NULL,'2020-04-25 03:33:15',2,1,2,442),(446,'Comisión punto de venta','6030198004',NULL,'2020-04-25 03:33:15',2,1,2,442),(447,'Tributos nacionales','6030199',NULL,'2020-04-25 03:33:15',2,1,2,352),(448,'Impuestos vehículos','6030199001',NULL,'2020-04-25 03:33:15',2,1,2,447),(449,'Notaria y registro','6030199002',NULL,'2020-04-25 03:33:15',2,1,2,447),(450,'I.S.L.R.','6030199003',NULL,'2020-04-25 03:33:15',2,1,2,447),(451,'Patente de industria y comercio','6030199004',NULL,'2020-04-25 03:33:15',2,1,2,447),(452,'Impuesto por publicidad','6030199005',NULL,'2020-04-25 03:33:15',2,1,2,447),(453,'Multas','6030199999',NULL,'2020-04-25 03:33:15',2,1,2,447);
/*!40000 ALTER TABLE `cuentas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departamento`
--

DROP TABLE IF EXISTS `departamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departamento` (
  `Id_Dep` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_Dep` varchar(100) DEFAULT NULL,
  `Codigo_Dep` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id_Dep`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamento`
--

LOCK TABLES `departamento` WRITE;
/*!40000 ALTER TABLE `departamento` DISABLE KEYS */;
INSERT INTO `departamento` VALUES (1,'Antioquia','5'),(2,'Atlantico','8'),(3,'D. C. Santa Fe de Bogotá','11'),(4,'Bolivar','13'),(5,'Boyaca','15'),(6,'Caldas','17'),(7,'Caqueta','18'),(8,'Cauca','19'),(9,'Cesar','20'),(10,'Cordova','23'),(11,'Cundinamarca','25'),(12,'Choco','27'),(13,'Huila','41'),(14,'La Guajira','44'),(15,'Magdalena','47'),(16,'Meta','50'),(17,'Nariño','52'),(18,'Norte de Santander','54'),(19,'Quindio','63'),(20,'Risaralda','66'),(21,'Santander','68'),(22,'Sucre','70'),(23,'Tolima','73'),(24,'Valle','76'),(25,'Arauca','81'),(26,'Casanare','85'),(27,'Putumayo','86'),(28,'San Andres','88'),(29,'Amazonas','91'),(30,'Guainia','94'),(31,'Guaviare','95'),(32,'Vaupes','97'),(33,'Vichada','99');
/*!40000 ALTER TABLE `departamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documento`
--

DROP TABLE IF EXISTS `documento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documento` (
  `Id_Doc` int(11) NOT NULL AUTO_INCREMENT,
  `FechaRegistro_Doc` timestamp NULL DEFAULT current_timestamp(),
  `Numero_Doc` varchar(100) DEFAULT NULL,
  `FechaDocumento_Doc` datetime DEFAULT NULL,
  `FechaVencimiento_Doc` datetime DEFAULT NULL,
  `Observacion_Doc` text DEFAULT NULL,
  `IvaIncluido_Doc` tinyint(4) DEFAULT NULL,
  `Id_Per` int(11) DEFAULT NULL COMMENT 'Cliente, tercero o remitente del documento',
  `Id_Usu` int(11) DEFAULT NULL COMMENT 'Usuario que registra el documento',
  `Id_DocTip` int(11) DEFAULT NULL,
  `Id_DocEst` int(11) DEFAULT NULL,
  `Id_TerPag` int(11) DEFAULT NULL,
  `Primary_Usu` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_Doc`) USING BTREE,
  KEY `fk_documento_persona1_idx` (`Id_Per`) USING BTREE,
  KEY `fk_documento_usuario1_idx` (`Id_Usu`) USING BTREE,
  KEY `fk_documento_documento_tipo1_idx` (`Id_DocTip`) USING BTREE,
  KEY `fk_documento_documento_estado1_idx` (`Id_DocEst`) USING BTREE,
  KEY `fk_documento_termino_pago1_idx` (`Id_TerPag`) USING BTREE,
  CONSTRAINT `fk_documento_documento_estado1` FOREIGN KEY (`Id_DocEst`) REFERENCES `documento_estado` (`Id_DocEst`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_documento_documento_tipo1` FOREIGN KEY (`Id_DocTip`) REFERENCES `documento_tipo` (`Id_DocTip`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_documento_persona1` FOREIGN KEY (`Id_Per`) REFERENCES `persona` (`Id_Per`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_documento_termino_pago1` FOREIGN KEY (`Id_TerPag`) REFERENCES `termino_pago` (`Id_TerPag`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_documento_usuario1` FOREIGN KEY (`Id_Usu`) REFERENCES `usuario` (`Id_Usu`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documento`
--

LOCK TABLES `documento` WRITE;
/*!40000 ALTER TABLE `documento` DISABLE KEYS */;
INSERT INTO `documento` VALUES (4,'2020-04-12 02:04:35','CM-1','2020-04-11 00:00:00','2020-04-26 00:00:00','Esta es una factura de compra',1,2,1,2,3,4,1),(5,'2020-04-12 02:04:26','CM-2','2020-04-11 00:00:00','2020-04-11 00:00:00','Esta es la factura de venta #2',0,1,1,2,2,2,1),(6,'2020-04-12 02:04:18','CM-3','2020-04-11 00:00:00','2020-04-26 00:00:00','Esta es la factura de compra #3',1,1,1,2,5,4,1),(7,'2020-04-12 04:04:20','CM-4','2020-04-11 00:00:00','2020-04-11 00:00:00',NULL,1,1,1,1,3,2,1),(8,'2020-04-12 04:04:11','CM-4','2020-04-11 00:00:00','2020-04-11 00:00:00',NULL,1,1,1,1,3,2,1),(9,'2020-04-12 04:04:31','CM-4','2020-04-11 00:00:00','2020-04-11 00:00:00',NULL,1,1,1,1,1,2,1),(10,'2020-04-12 04:04:44','CM-5','2020-04-11 00:00:00','2020-04-11 00:00:00',NULL,1,2,1,2,3,2,1),(11,'2020-04-12 04:04:21','CM-5','2020-04-11 00:00:00','2020-04-11 00:00:00',NULL,1,2,1,2,4,2,1),(12,'2020-04-12 04:04:39','CM-5','2020-04-11 00:00:00','2020-04-11 00:00:00',NULL,NULL,2,1,2,1,2,1),(13,'2020-04-12 04:04:59','CM-5','2020-04-11 00:00:00','2020-04-26 00:00:00',NULL,1,2,1,2,5,4,1),(14,'2020-04-12 04:04:39','CM-6','2020-04-11 00:00:00','2020-04-11 00:00:00','Test de modificación',NULL,2,1,2,3,2,1),(15,'2020-04-14 22:04:38','FV-1','2020-04-14 00:00:00','2020-04-14 00:00:00',NULL,1,1,1,1,5,2,1),(16,'2020-04-14 22:04:54','FV-1','2020-04-14 00:00:00','2020-04-14 00:00:00','Esta es una FV-01',1,6,7,1,1,1,7),(17,'2020-04-27 15:04:02','1234','2020-04-27 00:00:00','2020-05-12 00:00:00',NULL,0,5,7,1,6,3,7),(18,'2020-04-27 15:04:47','A1234','2020-04-27 00:00:00','2020-05-12 00:00:00',NULL,1,5,7,2,2,3,7),(19,'2020-04-27 15:04:19','B1234','2020-04-27 00:00:00','2020-05-12 00:00:00',NULL,0,5,7,2,3,3,7),(20,'2020-04-27 15:04:15','C1234','2020-04-27 00:00:00','2020-04-27 00:00:00',NULL,0,5,7,2,6,1,7),(21,'2020-04-27 15:04:49','A1111','2020-04-27 00:00:00','2020-05-12 00:00:00',NULL,1,5,7,1,1,3,7),(22,'2020-05-08 19:05:11','FV-2','2020-05-08 00:00:00','2020-05-23 00:00:00','Factura prueba de pago',1,1,1,1,5,4,1),(23,'2020-05-11 00:05:17','FV-6','2020-05-10 00:00:00','2020-05-10 00:00:00',NULL,1,7,1,1,3,2,1),(24,'2020-05-11 00:05:17','FV-6','2020-05-10 00:00:00','2020-05-10 00:00:00',NULL,1,7,1,1,5,2,1),(25,'2020-06-19 19:06:26',NULL,'2020-06-19 00:00:00','2020-06-19 00:00:00',NULL,1,7,1,1,1,2,1),(26,'2020-06-19 21:06:30','TER-PAG01','2020-06-19 00:00:00','2020-07-04 00:00:00','Factura a crédito',NULL,7,1,1,5,4,1),(27,'2020-06-22 22:06:26','6','2020-06-22 00:00:00','2020-06-22 00:00:00','Test numero de factura',NULL,2,1,1,1,2,1),(28,'2020-06-22 22:06:11',NULL,'2020-06-22 00:00:00','2020-07-22 00:00:00',NULL,1,2,1,1,6,5,1),(29,'2020-06-22 23:06:38','FV-5','2020-06-22 00:00:00','2020-07-07 00:00:00',NULL,1,1,1,1,5,4,1),(30,'2020-07-03 23:07:50',NULL,'2020-07-03 00:00:00','2020-07-03 00:00:00','Test Cotización',NULL,1,1,6,1,2,1),(31,'2020-07-03 23:07:17',NULL,'2020-07-03 00:00:00','2020-07-03 00:00:00','Test Cotización',NULL,1,1,6,1,2,1),(32,'2020-07-03 23:07:59',NULL,'2020-07-03 00:00:00','2020-07-03 00:00:00','Test Cotización',NULL,1,1,6,1,2,1),(33,'2020-07-03 23:07:12',NULL,'2020-07-03 00:00:00','2020-07-03 00:00:00','Test Cotización',NULL,1,1,6,1,2,1),(34,'2020-07-04 22:07:10',NULL,'2020-07-04 00:00:00','2020-07-04 00:00:00',NULL,NULL,2,1,6,1,2,1),(35,'2020-07-04 22:07:57','1','2020-07-04 00:00:00','2020-07-04 00:00:00','Numeración de cotizaciones',NULL,7,1,6,5,2,1),(36,'2020-07-04 22:07:14','1','2020-07-04 00:00:00','2020-07-04 00:00:00','Numeración cotización 2',NULL,1,1,6,1,2,1),(37,'2020-07-04 22:07:14','1','2020-07-04 00:00:00','2020-07-04 00:00:00',NULL,NULL,2,1,6,1,2,1),(38,'2020-07-04 22:07:21','1','2020-07-04 00:00:00','2020-07-04 00:00:00',NULL,NULL,1,1,6,1,2,1),(39,'2020-07-04 22:07:55','2','2020-07-04 00:00:00','2020-07-19 00:00:00','Cotización prueba case switch',NULL,7,1,6,5,4,1),(40,'2020-07-04 22:07:39','3','2020-07-04 00:00:00','2020-07-19 00:00:00','Modificación de documento',NULL,7,1,6,5,4,1),(41,'2020-07-06 02:07:55','1','2020-07-05 00:00:00','2020-07-05 00:00:00',NULL,NULL,7,1,7,1,2,1),(42,'2020-07-06 02:07:15','2','2020-07-05 00:00:00','2020-07-20 00:00:00',NULL,NULL,7,1,7,5,4,1),(43,'2020-07-06 02:07:50','3','2020-07-05 00:00:00','2020-07-20 00:00:00',NULL,NULL,1,1,7,5,4,1);
/*!40000 ALTER TABLE `documento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documento_estado`
--

DROP TABLE IF EXISTS `documento_estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documento_estado` (
  `Id_DocEst` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_DocEst` varchar(100) DEFAULT NULL,
  `Estado_DocEst` enum('Activo','Inactivo') DEFAULT 'Activo',
  `FechaRegistro_DocEst` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`Id_DocEst`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documento_estado`
--

LOCK TABLES `documento_estado` WRITE;
/*!40000 ALTER TABLE `documento_estado` DISABLE KEYS */;
INSERT INTO `documento_estado` VALUES (1,'Borrador','Activo','2020-03-31 21:13:21'),(2,'Inactivo','Activo','2020-03-31 21:14:26'),(3,'Anulado','Activo','2020-03-31 21:14:46'),(4,'Cancelado','Activo','2020-03-31 21:14:52'),(5,'Pagado','Activo','2020-03-31 21:16:24'),(6,'Credito','Activo','2020-05-10 17:33:13');
/*!40000 ALTER TABLE `documento_estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documento_observaciones`
--

DROP TABLE IF EXISTS `documento_observaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documento_observaciones` (
  `Id_DocObs` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_DocObs` text DEFAULT NULL,
  `Id_DocEst` int(11) DEFAULT NULL,
  `Id_Usu` int(11) DEFAULT NULL,
  `FechaRegistro` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Id_Doc` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_DocObs`),
  KEY `fk_documento_observaciones` (`Id_Doc`),
  KEY `fk_obs_documento_usuario` (`Id_Usu`),
  KEY `fk_observacion_doc_estado` (`Id_DocEst`),
  CONSTRAINT `fk_documento_observaciones` FOREIGN KEY (`Id_Doc`) REFERENCES `documento` (`Id_Doc`),
  CONSTRAINT `fk_obs_documento_usuario` FOREIGN KEY (`Id_Usu`) REFERENCES `usuario` (`Id_Usu`),
  CONSTRAINT `fk_observacion_doc_estado` FOREIGN KEY (`Id_DocEst`) REFERENCES `documento_estado` (`Id_DocEst`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documento_observaciones`
--

LOCK TABLES `documento_observaciones` WRITE;
/*!40000 ALTER TABLE `documento_observaciones` DISABLE KEYS */;
INSERT INTO `documento_observaciones` VALUES (1,'Agregar observación al documento',1,1,'2020-05-11 20:05:39',14),(2,'Test de anulación de documento 14',1,1,'2020-05-11 20:05:09',4),(3,'Test numero 2 de anulación de documento \'*/ -- ;',3,1,'2020-05-11 20:05:35',8),(4,'Anular documento, factor 0',3,1,'2020-05-19 00:05:48',14),(5,'Anular documento factor 0 v2',3,1,'2020-05-19 00:05:49',14),(6,NULL,3,1,'2020-05-19 00:05:01',14),(7,'DOCUMENTO ANULADO\r\nTest anulación random',3,1,'2020-05-29 20:05:14',23);
/*!40000 ALTER TABLE `documento_observaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documento_tipo`
--

DROP TABLE IF EXISTS `documento_tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documento_tipo` (
  `Id_DocTip` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_DocTip` varchar(100) DEFAULT NULL,
  `Estado_DocTip` enum('Activo','Inactivo') DEFAULT 'Activo',
  `FechaRegistro_DocTip` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`Id_DocTip`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documento_tipo`
--

LOCK TABLES `documento_tipo` WRITE;
/*!40000 ALTER TABLE `documento_tipo` DISABLE KEYS */;
INSERT INTO `documento_tipo` VALUES (1,'Factura de venta','Activo','2020-03-31 21:23:01'),(2,'Factura de compra','Activo','2020-03-31 21:23:18'),(3,'Nota débito','Activo','2020-03-31 21:23:50'),(4,'Nota crédito','Activo','2020-03-31 21:23:56'),(5,'Remisión','Activo','2020-03-31 21:27:22'),(6,'Cotización','Activo','2020-03-31 21:27:32'),(7,'Órden de compra','Activo','2020-03-31 21:27:42'),(8,'Comprobante de ingreso','Activo','2020-03-31 21:28:22'),(9,'Comprobante de egreso','Activo','2020-03-31 21:28:39');
/*!40000 ALTER TABLE `documento_tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresa`
--

DROP TABLE IF EXISTS `empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empresa` (
  `Id_Emp` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_Emp` varchar(250) DEFAULT NULL,
  `DigitoVerificacion_Emp` varchar(45) DEFAULT NULL,
  `Correo_Emp` varchar(300) DEFAULT NULL,
  `Direccion_Emp` varchar(250) DEFAULT NULL,
  `Telefono_Emp` varchar(300) DEFAULT NULL,
  `TelCelular_Emp` varchar(45) DEFAULT NULL,
  `Nit_Emp` varchar(50) DEFAULT NULL,
  `Id_Mun` int(11) DEFAULT NULL,
  `Id_EmpTip` int(11) DEFAULT NULL,
  `Id_Emp_Sede` int(11) DEFAULT NULL,
  `Id_EmpEst` int(11) DEFAULT NULL,
  `Primary_Usu` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_Emp`) USING BTREE,
  KEY `fk_empresa_municipio1_idx` (`Id_Mun`) USING BTREE,
  KEY `fk_empresa_empresa_tipo_1` (`Id_EmpTip`) USING BTREE,
  KEY `fk_empresa_empresa_1` (`Id_Emp_Sede`) USING BTREE,
  KEY `fk_empresa_estado_1` (`Id_EmpEst`) USING BTREE,
  KEY `fk_idx_Nombre_Emp` (`Nombre_Emp`) USING BTREE,
  KEY `fk_idx_Nit_Emp` (`Nit_Emp`) USING BTREE,
  CONSTRAINT `fk_empresa_empresa_1` FOREIGN KEY (`Id_Emp_Sede`) REFERENCES `empresa` (`Id_Emp`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_empresa_empresa_tipo_1` FOREIGN KEY (`Id_EmpTip`) REFERENCES `empresa_tipo` (`Id_EmpTip`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_empresa_estado_1` FOREIGN KEY (`Id_EmpEst`) REFERENCES `empresa_estado` (`Id_EmpEst`),
  CONSTRAINT `fk_empresa_municipio1` FOREIGN KEY (`Id_Mun`) REFERENCES `municipio` (`Id_Mun`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2702 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresa`
--

LOCK TABLES `empresa` WRITE;
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
/*!40000 ALTER TABLE `empresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresa_estado`
--

DROP TABLE IF EXISTS `empresa_estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empresa_estado` (
  `Id_EmpEst` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_EmpEst` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id_EmpEst`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresa_estado`
--

LOCK TABLES `empresa_estado` WRITE;
/*!40000 ALTER TABLE `empresa_estado` DISABLE KEYS */;
INSERT INTO `empresa_estado` VALUES (1,'Activo'),(2,'Inactivo');
/*!40000 ALTER TABLE `empresa_estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresa_tipo`
--

DROP TABLE IF EXISTS `empresa_tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empresa_tipo` (
  `Id_EmpTip` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_EmpTip` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`Id_EmpTip`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresa_tipo`
--

LOCK TABLES `empresa_tipo` WRITE;
/*!40000 ALTER TABLE `empresa_tipo` DISABLE KEYS */;
INSERT INTO `empresa_tipo` VALUES (1,'GENERAL'),(2,'EPS'),(3,'IPS'),(4,'TERCERO'),(5,'APORTANTE');
/*!40000 ALTER TABLE `empresa_tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gestion_documental`
--

DROP TABLE IF EXISTS `gestion_documental`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gestion_documental` (
  `Id_GesDoc` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_GesDoc` varchar(200) DEFAULT NULL,
  `Descripcion_GesDoc` text DEFAULT NULL,
  `NombreInterno_GesDoc` varchar(250) DEFAULT NULL,
  `Ubicacion_GesDoc` text DEFAULT NULL,
  `Formato_GesDoc` char(10) DEFAULT NULL,
  `Tamanio_GesDoc` double(10,2) DEFAULT NULL,
  `FechaRegistro_GesDoc` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Id_Usu` int(11) DEFAULT NULL,
  `Id_Per` int(11) DEFAULT NULL,
  `Id_Con` int(11) DEFAULT NULL,
  `Id_Doc` int(11) DEFAULT NULL,
  `Id_Tran` int(11) DEFAULT NULL,
  `Primary_Usu` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_GesDoc`) USING BTREE,
  KEY `fk_gestion_doc_usuario` (`Id_Usu`) USING BTREE,
  KEY `fk_gestion_doc_persona` (`Id_Per`) USING BTREE,
  KEY `fk_gestion_doc_contrato` (`Id_Con`) USING BTREE,
  KEY `fk_gestion_documental_documento1_idx` (`Id_Doc`) USING BTREE,
  KEY `fk_gestion_documental_transacciones1_idx` (`Id_Tran`) USING BTREE,
  CONSTRAINT `fk_gestion_doc_contrato` FOREIGN KEY (`Id_Con`) REFERENCES `contratos` (`Id_Con`),
  CONSTRAINT `fk_gestion_doc_persona` FOREIGN KEY (`Id_Per`) REFERENCES `persona` (`Id_Per`),
  CONSTRAINT `fk_gestion_doc_usuario` FOREIGN KEY (`Id_Usu`) REFERENCES `usuario` (`Id_Usu`),
  CONSTRAINT `fk_gestion_documental_documento1` FOREIGN KEY (`Id_Doc`) REFERENCES `documento` (`Id_Doc`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_gestion_documental_transacciones1` FOREIGN KEY (`Id_Tran`) REFERENCES `transacciones` (`Id_Tran`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gestion_documental`
--

LOCK TABLES `gestion_documental` WRITE;
/*!40000 ALTER TABLE `gestion_documental` DISABLE KEYS */;
/*!40000 ALTER TABLE `gestion_documental` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `idioma`
--

DROP TABLE IF EXISTS `idioma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `idioma` (
  `Id_Idi` int(11) NOT NULL AUTO_INCREMENT,
  `Idioma_Idi` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id_Idi`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `idioma`
--

LOCK TABLES `idioma` WRITE;
/*!40000 ALTER TABLE `idioma` DISABLE KEYS */;
INSERT INTO `idioma` VALUES (1,'Español'),(2,'Ingles');
/*!40000 ALTER TABLE `idioma` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `idioma_traductor`
--

DROP TABLE IF EXISTS `idioma_traductor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `idioma_traductor` (
  `Id_IdiTrad` int(11) NOT NULL AUTO_INCREMENT,
  `Id_Idi` int(11) DEFAULT NULL,
  `CampoOriginal_IdiTRad` varchar(255) DEFAULT NULL,
  `Traduccion_IdiTrad` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id_IdiTrad`) USING BTREE,
  KEY `fk_idioma_traductor_idi` (`Id_Idi`) USING BTREE,
  CONSTRAINT `fk_idioma_traductor_idi` FOREIGN KEY (`Id_Idi`) REFERENCES `idioma` (`Id_Idi`)
) ENGINE=InnoDB AUTO_INCREMENT=481 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `idioma_traductor`
--

LOCK TABLES `idioma_traductor` WRITE;
/*!40000 ALTER TABLE `idioma_traductor` DISABLE KEYS */;
INSERT INTO `idioma_traductor` VALUES (326,1,'Descripcion_Rol','Descripcion'),(327,1,'Primary_Usu','Codigo administrador'),(328,1,'Id_MenTip','Tipo mensaje'),(329,1,'Descripcion_Perm','Descripción'),(330,1,'Acceso_Perm','Accesso'),(331,1,'Controlador_Perm','Controlador'),(332,1,'Id_DocEst','Estado'),(333,1,'Id_DocTip','Tipo'),(334,1,'Id_Per','Contacto'),(335,1,'Id_TerPag','Término de pago'),(336,1,'Id_Usu','Usuario'),(337,1,'FechaRegistro_Doc','Fecha registro'),(338,1,'Numero_Doc','Número'),(339,1,'FechaDocumento_Doc','Fecha documento'),(340,1,'FechaVencimiento_Doc','Fecha vencimiento'),(341,1,'Observacion_Doc','Observación'),(342,1,'IvaIncluido_Doc','¿Iva incluido?'),(343,1,'Id_Emp','Empresa'),(344,1,'Id_Mun','Municipio'),(345,1,'Id_PerEst','Estado'),(346,1,'Id_PerGen','Género'),(347,1,'Id_PerTip','Tipo'),(348,1,'Id_PerTipId','Tipo identificación'),(349,1,'Identificacion_Per','Identificación'),(350,1,'Nombre1_Per','Primer nombre'),(351,1,'Nombre2_Per','Segundo nombre'),(352,1,'Apeliido1_Per','Primer apellido'),(353,1,'Apellido2_Per','Segundo apellido'),(354,1,'Telefono_Per','Teléfono'),(355,1,'TelCelular_Per','Celular'),(356,1,'Correo_Per','Correo electrónico'),(357,1,'Direccion_Per','Dirección residencia'),(358,1,'FechaNacimiento_Per','Fecha nacimiento'),(359,1,'FechaRegistro_Per','Fecha registro'),(360,1,'Celular_Per','Celular 2'),(361,1,'Id_BanEst','Estado'),(362,1,'Id_TipCueBan','Tipo cuenta'),(363,1,'NombreCuenta_Ban','Nombre cuenta'),(364,1,'NumeroCuenta_Ban','Número cuenta'),(365,1,'SaldoInicial_Ban','Saldo inicial'),(366,1,'FechaBanco','Fecha'),(367,1,'Descripcion_Ban','Descripción'),(368,1,'FechaRegistro','Fecha registro'),(369,1,'Id_Bod','Bodega'),(370,1,'Id_CatIte','Categoría'),(371,1,'Id_IteEst','Estado'),(372,1,'Id_IteTip','Tipo'),(373,1,'Id_Mar','Marca'),(374,1,'Id_Med','Medida'),(375,1,'Nombre_Ite','Nombre item'),(376,1,'Referencia_Ite','Referencia'),(377,1,'Serie_Ite','Serie'),(378,1,'FechaRegistro_Ite','Fecha registro'),(379,1,'Inventariable_Ite','¿Inventariable?'),(380,1,'Observacion_Ite','Observación'),(381,1,'Imagen_Item','Imagen'),(382,1,'Nombre_CatIte','Nombre categoría'),(383,1,'FechaRegistro_CatIte','Fecha registro'),(384,1,'Estado_CatIte','Estado'),(385,1,'Id_BodEst','Estado'),(386,1,'Id_BodTip','Tipo'),(387,1,'Nombre_Bod','Nombre bodega'),(388,1,'Codigo_Bod','Código'),(389,1,'Direccion_Bod','Dirección/Ubicación'),(390,1,'Descripcion_Bod','Descripción'),(391,1,'FechaRegistro_Bod','Fecha registro'),(392,1,'FechaCreacion_Bod','Fecha creación'),(393,1,'Nombre_ListPre','Nombre lista'),(394,1,'Estado_ListPre','Estado'),(395,1,'Valor_Incremento','Valor incremento($)'),(396,1,'Porcentaje_Incremento','Porcentaje incremento(%)'),(397,1,'Id_Idi','Idioma'),(398,1,'CampoOriginal_IdiTRad','Campo original'),(399,1,'Traduccion_IdiTrad','Traducción'),(400,1,'PrecioVenta','Precio venta'),(401,1,'Id_Ite','Item'),(402,1,'Id_ListPre','Lista de precios'),(403,1,'Id_Imp','Impuestos'),(404,1,'Nombre_Imp','Nombre impuesto'),(405,1,'Valor_Imp','Porcentaje (%)'),(406,1,'Estado_Imp','Estado'),(407,1,'FechaRegistro_Imp','Fecha registro'),(408,1,'Id_CueEst','Estado'),(409,1,'Id_CueTip','Tipo'),(410,1,'Id_Cue_CuentaPadre','Cuenta padre'),(411,1,'Id_NatCue','Naturaleza'),(412,1,'Nombre_Cue','Nombre'),(413,1,'Cuenta_Cue','Cuenta'),(414,1,'Consecutivo_Cue','Consecutivo'),(415,1,'FechaRegistro_Cue','Fecha registro'),(416,1,'Id_Ban','Banco'),(417,1,'Id_TranEst','Estado'),(418,1,'Id_TranTip','Tipo'),(419,1,'Id_Tran_TransaccionParcial','Transacción parcial'),(420,1,'Numero_Tran','Número'),(421,1,'Fecha_Tran','Fecha transacción'),(422,1,'NotaVisible_Tran','Nota (Visible)'),(423,1,'DocumentoAsociado_Tran','¿Factura asociada?'),(424,1,'FechaRegistro_Tran','Fecha registro'),(425,1,'Id_Rol','Rol'),(426,1,'Id_UsuEst','Estado'),(427,1,'Usuario_Usu','Usuario'),(428,1,'Contrasena_Usu','Contraseña'),(429,1,'UltimoAcceso_Usu','Fecha ultimo acceso'),(430,1,'UltimaContrasena_Usu','Ultima contraseña'),(431,1,'KeyPago_Usu','Llave pago'),(432,1,'Email_Usu','Email'),(433,1,'KeyRecoverPassword_Usu','Llave recuperación'),(434,1,'FechaRegistro_Usu','Fecha registro'),(435,1,'Nombre_TerPag','Nombre'),(436,1,'Dias_TerPag','Días de pago'),(437,1,'Estado_TerPag','Estado'),(438,1,'FechaRegistro_TerPag','Fecha registro'),(440,1,'Id_Per_expenses','Provedor'),(441,1,'Id_Per_income','Cliente'),(442,1,'Cantidad_Kar','Cantidad'),(443,1,'Costo_Kar','Costo'),(444,1,'Descuento_Kar','Descuento (%)'),(445,1,'Aceptado_Kar','OK'),(446,1,'Observacion_Kar','Observación'),(447,1,'FactorMovimiento_Kar','Factor'),(448,1,'Id_Doc','Documento'),(449,1,'Subtotal','Subtotal'),(450,1,'Id_MetPag','Método de pago'),(451,1,'Nombre_MetPag','Método de pago'),(452,1,'Estado_MePag','Estado'),(453,1,'Id_Ret','Retención'),(454,1,'Id_Cue_Ventas','Cuenta ventas'),(455,1,'Id_Cue_Compras','Cuenta compras'),(456,1,'Id_RetTip','Tipo'),(457,1,'Nombre_Ret','Retención'),(458,1,'Porcentaje_Ret','Porcentaje (%)'),(459,1,'Descripcion_Ret','Descripción'),(460,1,'FechaRegistro_Ret','Fecha registro'),(461,1,'Estado_Ret','Estado'),(462,1,'Valor_TranDet','Valor'),(463,1,'Cantidad_TranDet','Cantidad'),(464,1,'Observaciones_TranDet','Observación'),(465,1,'Id_Tran','Transacción'),(466,1,'Id_Cue','Cuenta'),(467,1,'Id_TranDetTip','Tipo'),(468,1,'Id_TranDetEst','Estado'),(469,1,'Nombre_DocEst','Estado'),(470,1,'Nombre_DocObs','Observación'),(471,1,'Id_NumDoc','Numeración documento'),(472,1,'Id_NumFac','Resolución de facturación'),(473,1,'Inicial_NumDoc','Número inicial'),(474,1,'Siguiente_NumDoc','Siguiente número'),(475,1,'Nombre_NumFac','Nombre'),(476,1,'Prefijo_NumFac','Prefijo factura'),(477,1,'Numero_NumFac','Número'),(478,1,'Resolucion_NumFac','Resolución de facturación'),(479,1,'Activo_NumFac','Estado'),(480,1,'Defecto_NumFac','¿Por defecto?');
/*!40000 ALTER TABLE `idioma_traductor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `impuestos`
--

DROP TABLE IF EXISTS `impuestos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `impuestos` (
  `Id_Imp` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_Imp` varchar(255) DEFAULT NULL,
  `Valor_Imp` double DEFAULT NULL,
  `Estado_Imp` enum('Activo','Inactivo') DEFAULT 'Activo',
  `FechaRegistro_Imp` timestamp NULL DEFAULT current_timestamp(),
  `Primary_Usu` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_Imp`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `impuestos`
--

LOCK TABLES `impuestos` WRITE;
/*!40000 ALTER TABLE `impuestos` DISABLE KEYS */;
INSERT INTO `impuestos` VALUES (3,'IVA',0,'Activo','2020-03-26 00:36:45',1),(4,'IVA',19,'Activo','2020-03-27 09:03:41',7),(5,'IVA',5,'Activo','2020-03-27 09:03:50',1),(6,'IVA',19,'Activo','2020-03-27 09:03:10',1),(7,'Retefuente',10,'Activo','2020-04-14 22:04:31',7),(8,'Estampillas',5,'Activo','2020-04-14 22:04:48',7);
/*!40000 ALTER TABLE `impuestos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `impuestos_items`
--

DROP TABLE IF EXISTS `impuestos_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `impuestos_items` (
  `Id_Ite` int(11) NOT NULL,
  `Id_Imp` int(11) NOT NULL,
  PRIMARY KEY (`Id_Ite`,`Id_Imp`) USING BTREE,
  KEY `fk_items_has_impuestos_impuestos1_idx` (`Id_Imp`) USING BTREE,
  KEY `fk_items_has_impuestos_items1_idx` (`Id_Ite`) USING BTREE,
  CONSTRAINT `fk_items_has_impuestos_impuestos1` FOREIGN KEY (`Id_Imp`) REFERENCES `impuestos` (`Id_Imp`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_items_has_impuestos_items1` FOREIGN KEY (`Id_Ite`) REFERENCES `items` (`Id_Ite`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `impuestos_items`
--

LOCK TABLES `impuestos_items` WRITE;
/*!40000 ALTER TABLE `impuestos_items` DISABLE KEYS */;
INSERT INTO `impuestos_items` VALUES (1,5),(4,5),(4,6),(5,4),(6,6),(7,4),(8,4),(9,4),(10,6);
/*!40000 ALTER TABLE `impuestos_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `impuestos_kardex`
--

DROP TABLE IF EXISTS `impuestos_kardex`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `impuestos_kardex` (
  `Id_ImpKar` int(11) NOT NULL AUTO_INCREMENT,
  `Id_kar` int(11) DEFAULT NULL,
  `Id_Imp` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_ImpKar`) USING BTREE,
  KEY `fk_impuestos_kardex_kardex1_idx` (`Id_kar`) USING BTREE,
  KEY `fk_impuestos_kardex_impuestos1_idx` (`Id_Imp`) USING BTREE,
  CONSTRAINT `fk_impuestos_kardex_impuestos1` FOREIGN KEY (`Id_Imp`) REFERENCES `impuestos` (`Id_Imp`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_impuestos_kardex_kardex1` FOREIGN KEY (`Id_kar`) REFERENCES `kardex` (`Id_kar`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `impuestos_kardex`
--

LOCK TABLES `impuestos_kardex` WRITE;
/*!40000 ALTER TABLE `impuestos_kardex` DISABLE KEYS */;
INSERT INTO `impuestos_kardex` VALUES (3,NULL,NULL),(10,1,3),(14,20,6),(15,21,5),(16,22,6),(17,22,5),(18,23,4),(19,24,4),(20,25,4),(21,26,4),(22,27,4),(23,28,4),(24,29,4),(25,30,5),(26,31,6),(27,31,5),(28,32,6),(29,32,5),(30,33,6),(31,34,5),(32,35,6),(33,35,5),(34,36,6),(35,37,5),(44,43,5),(45,44,6),(46,45,6),(47,45,5),(48,46,5),(49,47,5),(53,50,5),(54,51,6),(55,52,5),(56,53,6),(63,58,6),(64,58,5),(65,59,6),(66,60,6),(67,60,5),(68,64,6),(69,64,5),(70,65,6),(71,65,5),(72,66,6),(73,67,6),(74,67,5),(75,68,6),(76,68,5),(77,69,5),(78,70,6),(79,70,5),(80,72,6),(81,72,5),(82,73,6),(83,74,6),(84,75,5),(87,79,5),(88,81,6),(89,81,5),(90,82,6),(91,82,5),(92,84,5);
/*!40000 ALTER TABLE `impuestos_kardex` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_estado`
--

DROP TABLE IF EXISTS `item_estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_estado` (
  `Id_IteEst` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_IteEst` varchar(100) NOT NULL,
  PRIMARY KEY (`Id_IteEst`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_estado`
--

LOCK TABLES `item_estado` WRITE;
/*!40000 ALTER TABLE `item_estado` DISABLE KEYS */;
INSERT INTO `item_estado` VALUES (1,'Activo'),(2,'Inactivo');
/*!40000 ALTER TABLE `item_estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_tipo`
--

DROP TABLE IF EXISTS `item_tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_tipo` (
  `Id_IteTip` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_IteTip` varchar(100) NOT NULL,
  `FechaRegistro_IteTip` timestamp NULL DEFAULT current_timestamp(),
  `Estado_IteTip` enum('Activo','Inactivo') DEFAULT 'Activo',
  PRIMARY KEY (`Id_IteTip`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_tipo`
--

LOCK TABLES `item_tipo` WRITE;
/*!40000 ALTER TABLE `item_tipo` DISABLE KEYS */;
INSERT INTO `item_tipo` VALUES (1,'Inventariable','2020-03-24 03:11:19','Activo'),(2,'No inventariable','2020-03-24 03:11:26','Activo'),(3,'Servicio','2020-03-24 03:12:29','Activo');
/*!40000 ALTER TABLE `item_tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items` (
  `Id_Ite` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_Ite` mediumtext NOT NULL,
  `Referencia_Ite` varchar(500) DEFAULT NULL,
  `Serie_Ite` varchar(450) DEFAULT NULL,
  `FechaRegistro_Ite` timestamp NULL DEFAULT current_timestamp(),
  `Inventariable_Ite` tinyint(4) DEFAULT NULL,
  `Observacion_Ite` text DEFAULT NULL,
  `Imagen_Item` text DEFAULT NULL,
  `Id_CatIte` int(11) DEFAULT NULL,
  `Id_Mar` int(11) DEFAULT NULL,
  `Id_Med` int(11) DEFAULT NULL,
  `Id_Usu` int(11) DEFAULT NULL COMMENT 'Usuario que registro el Item',
  `Id_IteTip` int(11) DEFAULT NULL,
  `Id_IteEst` int(11) DEFAULT NULL,
  `Id_Bod` int(11) DEFAULT NULL,
  `Primary_Usu` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_Ite`) USING BTREE,
  KEY `fk_items_medidas1_idx` (`Id_Med`) USING BTREE,
  KEY `fk_items_usuario1_idx` (`Id_Usu`) USING BTREE,
  KEY `fk_items_marcas1_idx` (`Id_Mar`) USING BTREE,
  KEY `fk_items_item_estado1_idx` (`Id_IteEst`) USING BTREE,
  KEY `fk_items_item_tipo1_idx` (`Id_IteTip`) USING BTREE,
  KEY `fk_items_categoria_item1_idx` (`Id_CatIte`) USING BTREE,
  KEY `fk_items_bodegas1_idx` (`Id_Bod`) USING BTREE,
  CONSTRAINT `fk_items_bodegas1` FOREIGN KEY (`Id_Bod`) REFERENCES `bodegas` (`Id_Bod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_items_categoria_item1` FOREIGN KEY (`Id_CatIte`) REFERENCES `categoria_item` (`Id_CatIte`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_items_item_estado1` FOREIGN KEY (`Id_IteEst`) REFERENCES `item_estado` (`Id_IteEst`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_items_item_tipo1` FOREIGN KEY (`Id_IteTip`) REFERENCES `item_tipo` (`Id_IteTip`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_items_marcas1` FOREIGN KEY (`Id_Mar`) REFERENCES `marcas` (`Id_Mar`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_items_medidas1` FOREIGN KEY (`Id_Med`) REFERENCES `medidas` (`Id_Med`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_items_usuario1` FOREIGN KEY (`Id_Usu`) REFERENCES `usuario` (`Id_Usu`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` VALUES (1,'Servicio número 1','ref','Serie','2020-03-24 05:00:00',NULL,'Observación',NULL,2,NULL,1,1,3,1,4,1),(2,'Item #5',NULL,NULL,'2020-03-30 07:03:46',NULL,NULL,NULL,NULL,NULL,NULL,1,3,1,4,1),(3,'Item #2',NULL,NULL,'2020-03-30 07:03:46',NULL,NULL,NULL,2,NULL,1,1,3,1,4,1),(4,'Item #3',NULL,NULL,'2020-03-30 22:03:12',NULL,NULL,NULL,2,NULL,1,1,2,1,4,1),(5,'Servicio #1',NULL,NULL,'2020-04-01 00:03:56',NULL,'Mi primer servicio',NULL,NULL,NULL,NULL,7,3,1,NULL,7),(6,'Item #4','REF','SER','2020-04-05 22:04:38',NULL,'Observación Ítem número 4',NULL,2,NULL,1,1,3,1,4,1),(7,'Servicio número 2',NULL,NULL,'2020-04-14 22:04:01',NULL,'Esto es un servicio',NULL,3,NULL,NULL,7,3,1,NULL,7),(8,'PRUEBA1','PRUB1','PRUB1','2020-04-27 22:04:57',NULL,NULL,NULL,3,NULL,NULL,7,1,1,NULL,7),(9,'Portátil','X44U1','12344666','2020-05-02 21:05:13',NULL,'PRUEBA',NULL,3,NULL,NULL,7,3,1,5,7),(10,'Arroz Flor Huila x500gr','ARROZ00FHX500X25','FHX25','2020-08-03 02:08:42',NULL,NULL,'multitenan.png',2,NULL,1,1,1,1,4,1);
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kardex`
--

DROP TABLE IF EXISTS `kardex`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kardex` (
  `Id_kar` int(11) NOT NULL AUTO_INCREMENT,
  `Cantidad_Kar` int(11) DEFAULT NULL,
  `Costo_Kar` double DEFAULT NULL,
  `Descuento_Kar` double DEFAULT NULL,
  `Aceptado_Kar` tinyint(4) DEFAULT NULL COMMENT 'Aceptacion del elemento por parte de la persona asignada en el documento',
  `Observacion_Kar` text DEFAULT NULL,
  `FactorMovimiento_Kar` smallint(6) DEFAULT NULL COMMENT 'Determina si es un ingreso = 1, salida = -1  o movimiento nulo = 0',
  `Id_Doc` int(11) DEFAULT NULL COMMENT 'Documento',
  `Id_Ite` int(11) DEFAULT NULL COMMENT 'Item contabilizado',
  `Id_Med` int(11) DEFAULT NULL COMMENT 'Unidad de medida',
  `Id_Bod` int(11) DEFAULT NULL,
  `Id_KarTip` int(11) DEFAULT NULL COMMENT 'Tipo kardex',
  `Id_KarEst` int(11) DEFAULT NULL COMMENT 'Estado kardex',
  `Primary_Usu` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_kar`) USING BTREE,
  KEY `fk_kardex_documento1_idx` (`Id_Doc`) USING BTREE,
  KEY `fk_kardex_kardex_estado1_idx` (`Id_KarEst`) USING BTREE,
  KEY `fk_kardex_kardex_tipo1_idx` (`Id_KarTip`) USING BTREE,
  KEY `fk_kardex_medidas1_idx` (`Id_Med`) USING BTREE,
  KEY `fk_kardex_bodegas1_idx` (`Id_Bod`) USING BTREE,
  KEY `fk_kardex_items1_idx` (`Id_Ite`) USING BTREE,
  CONSTRAINT `fk_kardex_bodegas1` FOREIGN KEY (`Id_Bod`) REFERENCES `bodegas` (`Id_Bod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_kardex_documento1` FOREIGN KEY (`Id_Doc`) REFERENCES `documento` (`Id_Doc`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_kardex_items1` FOREIGN KEY (`Id_Ite`) REFERENCES `items` (`Id_Ite`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_kardex_kardex_estado1` FOREIGN KEY (`Id_KarEst`) REFERENCES `kardex_estado` (`Id_KarEst`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_kardex_kardex_tipo1` FOREIGN KEY (`Id_KarTip`) REFERENCES `kardex_tipo` (`Id_KarTip`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_kardex_medidas1` FOREIGN KEY (`Id_Med`) REFERENCES `medidas` (`Id_Med`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kardex`
--

LOCK TABLES `kardex` WRITE;
/*!40000 ALTER TABLE `kardex` DISABLE KEYS */;
INSERT INTO `kardex` VALUES (1,5,10000,3,NULL,NULL,1,5,2,NULL,4,2,1,1),(2,4,4500,6,NULL,NULL,1,5,6,1,4,2,1,1),(3,10,5000,NULL,NULL,NULL,1,5,3,1,4,2,1,1),(4,3,132000,NULL,NULL,'Kardex observación',1,6,1,1,4,2,1,1),(5,5,45000,5,NULL,NULL,1,6,4,1,4,2,1,1),(6,4,50000,5,NULL,'Kardex observación',-1,7,3,NULL,NULL,1,1,1),(7,10,50000,5,NULL,'Kardex observación',-1,7,4,NULL,NULL,1,1,1),(8,4,25000,10,NULL,'Kardex observación',-1,7,6,NULL,NULL,1,1,1),(9,5,100000,3,NULL,'Kardex observación',-1,7,2,NULL,NULL,1,1,1),(10,4,50000,5,NULL,'Kardex observación',-1,8,3,NULL,NULL,1,1,1),(11,10,50000,5,NULL,'Kardex observación',-1,8,4,NULL,NULL,1,1,1),(12,4,50000,5,NULL,'Kardex observación',-1,9,3,NULL,NULL,1,1,1),(13,10,50000,5,NULL,'Kardex observación',-1,9,4,NULL,NULL,1,1,1),(14,7,50000,NULL,NULL,NULL,1,10,4,1,4,2,1,1),(15,7,50000,NULL,NULL,NULL,1,11,4,1,4,2,1,1),(17,5,45000,NULL,NULL,NULL,1,13,4,1,4,2,1,1),(20,5,25000,NULL,NULL,NULL,-1,15,6,NULL,NULL,1,1,1),(21,10,50000,NULL,NULL,NULL,-1,15,3,NULL,NULL,1,1,1),(22,5,50000,NULL,NULL,NULL,-1,15,4,NULL,NULL,1,1,1),(23,1,5000000,NULL,NULL,NULL,-1,16,5,NULL,NULL,1,1,7),(24,2,1200000,NULL,NULL,NULL,-1,16,7,NULL,NULL,1,1,7),(25,1,1000000,5,NULL,'CREDITO XX',-1,17,NULL,NULL,NULL,1,1,7),(26,1,800000,NULL,NULL,NULL,1,18,NULL,NULL,NULL,2,1,7),(27,1,500000,NULL,NULL,NULL,1,19,NULL,NULL,NULL,2,1,7),(28,1,500000,NULL,NULL,NULL,1,20,NULL,NULL,NULL,2,1,7),(29,1,90000,NULL,NULL,NULL,-1,21,NULL,NULL,NULL,1,1,7),(30,7,132000,NULL,0,NULL,-1,22,1,NULL,NULL,1,1,1),(31,5,45000,5,0,'Con descuento',-1,22,4,NULL,NULL,1,1,1),(32,8,45000,NULL,NULL,NULL,0,23,4,NULL,NULL,1,1,1),(33,8,25000,3,NULL,NULL,0,23,6,NULL,NULL,1,1,1),(34,5,132000,NULL,NULL,NULL,0,23,1,NULL,NULL,1,1,1),(35,8,45000,NULL,NULL,NULL,-1,24,4,NULL,NULL,1,1,1),(36,8,25000,3,NULL,NULL,-1,24,6,NULL,NULL,1,1,1),(37,5,132000,NULL,NULL,NULL,-1,24,1,NULL,NULL,1,1,1),(38,3,45000,3,NULL,NULL,0,14,4,1,4,1,1,1),(39,5,45000,NULL,NULL,NULL,0,14,4,1,4,1,1,1),(40,10,132000,NULL,NULL,NULL,0,14,1,1,4,1,1,1),(43,10,132000,2,NULL,NULL,0,14,1,1,4,1,1,1),(44,7,50001,5,NULL,NULL,1,12,4,1,4,NULL,1,1),(45,1,45000,NULL,NULL,NULL,-1,25,4,NULL,NULL,1,1,1),(46,3,132000,NULL,NULL,NULL,-1,25,1,NULL,NULL,1,1,1),(47,2,132000,NULL,NULL,NULL,-1,26,1,NULL,NULL,1,1,1),(50,5,50000,NULL,NULL,NULL,-1,28,3,NULL,NULL,1,1,1),(51,2,25000,5,NULL,NULL,-1,28,6,NULL,NULL,1,1,1),(52,5,100000,NULL,NULL,NULL,-1,28,2,NULL,NULL,1,1,1),(53,4,25000,5,NULL,NULL,-1,29,6,NULL,NULL,1,1,1),(58,6,4700,NULL,NULL,NULL,1,27,4,NULL,NULL,NULL,1,1),(59,6,25000,NULL,NULL,NULL,1,27,6,NULL,NULL,NULL,1,1),(60,2,45000,NULL,NULL,NULL,1,27,4,NULL,NULL,NULL,1,1),(64,2,45000,NULL,NULL,NULL,0,33,4,NULL,NULL,1,1,1),(65,2,4700,NULL,NULL,NULL,0,34,4,NULL,NULL,1,1,1),(66,1,25000,NULL,NULL,NULL,0,34,6,NULL,NULL,1,1,1),(67,2,45000,NULL,NULL,NULL,0,35,4,NULL,NULL,1,1,1),(68,2,45000,NULL,NULL,NULL,0,36,4,NULL,NULL,1,1,1),(69,10,132000,NULL,NULL,NULL,0,37,1,NULL,NULL,1,1,1),(70,6,45000,NULL,NULL,NULL,0,38,4,NULL,NULL,1,1,1),(71,6,50000,NULL,NULL,NULL,0,39,3,NULL,NULL,1,1,1),(72,10,50000,NULL,NULL,NULL,0,39,4,NULL,NULL,1,1,1),(73,5,25000,NULL,NULL,NULL,0,39,6,NULL,NULL,1,1,1),(74,2,100000,NULL,NULL,NULL,0,39,2,NULL,NULL,1,1,1),(75,10,132000,NULL,NULL,NULL,0,39,1,NULL,NULL,1,1,1),(79,3,132000,NULL,NULL,'Cotización',0,40,1,NULL,NULL,1,1,1),(80,4,100000,NULL,NULL,'Cotización',0,40,2,NULL,NULL,1,1,1),(81,5,45000,NULL,NULL,NULL,0,41,4,NULL,NULL,1,1,1),(82,5,50000,NULL,NULL,NULL,0,42,4,1,4,1,1,1),(83,5,100000,NULL,NULL,NULL,0,42,2,NULL,4,1,1,1),(84,5,132000,NULL,NULL,NULL,0,43,1,1,4,1,1,1);
/*!40000 ALTER TABLE `kardex` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kardex_estado`
--

DROP TABLE IF EXISTS `kardex_estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kardex_estado` (
  `Id_KarEst` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_KarEst` varchar(100) DEFAULT NULL,
  `Estado_KarEst` enum('Activo','Inactivo') DEFAULT 'Activo',
  `FechaRegistro_KarEst` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id_KarEst`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kardex_estado`
--

LOCK TABLES `kardex_estado` WRITE;
/*!40000 ALTER TABLE `kardex_estado` DISABLE KEYS */;
INSERT INTO `kardex_estado` VALUES (1,'Activo','Activo','2020-04-12 02:12:27'),(2,'Inactivo','Activo','2020-04-12 02:12:32');
/*!40000 ALTER TABLE `kardex_estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kardex_tipo`
--

DROP TABLE IF EXISTS `kardex_tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kardex_tipo` (
  `Id_KarTip` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_KarTip` varchar(100) DEFAULT NULL,
  `Estado_KarTip` enum('Activo','Inactivo') DEFAULT 'Activo',
  `FechaRegistro_KarTip` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id_KarTip`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kardex_tipo`
--

LOCK TABLES `kardex_tipo` WRITE;
/*!40000 ALTER TABLE `kardex_tipo` DISABLE KEYS */;
INSERT INTO `kardex_tipo` VALUES (1,'Ingreso','Activo','2020-04-12 02:12:10'),(2,'Egreso','Activo','2020-04-12 02:12:17');
/*!40000 ALTER TABLE `kardex_tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lista_precios`
--

DROP TABLE IF EXISTS `lista_precios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lista_precios` (
  `Id_ListPre` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_ListPre` varchar(255) NOT NULL,
  `Estado_ListPre` enum('Activo','Inactivo') DEFAULT 'Activo',
  `Valor_Incremento` double DEFAULT NULL,
  `Porcentaje_Incremento` double DEFAULT NULL,
  `Primary_Usu` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_ListPre`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lista_precios`
--

LOCK TABLES `lista_precios` WRITE;
/*!40000 ALTER TABLE `lista_precios` DISABLE KEYS */;
INSERT INTO `lista_precios` VALUES (1,'General','Activo',NULL,25,7),(2,'Ventas por mayor','Activo',NULL,15,7),(3,'General','Activo',NULL,17,1),(4,'Promoción','Activo',NULL,20,1),(5,'Precio mayoristas','Activo',NULL,10,1);
/*!40000 ALTER TABLE `lista_precios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marcas`
--

DROP TABLE IF EXISTS `marcas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marcas` (
  `Id_Mar` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_Mar` varchar(500) NOT NULL,
  `FechaRegistro` timestamp NULL DEFAULT current_timestamp(),
  `Estado_Mar` enum('Activo','Inactivo') DEFAULT 'Activo',
  `Primary_Usu` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_Mar`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marcas`
--

LOCK TABLES `marcas` WRITE;
/*!40000 ALTER TABLE `marcas` DISABLE KEYS */;
/*!40000 ALTER TABLE `marcas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medidas`
--

DROP TABLE IF EXISTS `medidas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medidas` (
  `Id_Med` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_Med` varchar(250) DEFAULT NULL,
  `Valor_Med` double DEFAULT NULL,
  `Unidad_Med` char(12) DEFAULT NULL,
  `Estado_Med` enum('Activo','Inactivo') DEFAULT 'Activo',
  `Primary_Usu` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_Med`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medidas`
--

LOCK TABLES `medidas` WRITE;
/*!40000 ALTER TABLE `medidas` DISABLE KEYS */;
INSERT INTO `medidas` VALUES (1,'Kilogramos',1000,'Kg','Activo',1);
/*!40000 ALTER TABLE `medidas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mensaje_estado`
--

DROP TABLE IF EXISTS `mensaje_estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mensaje_estado` (
  `Id_MenEst` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_MenEst` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Id_MenEst`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensaje_estado`
--

LOCK TABLES `mensaje_estado` WRITE;
/*!40000 ALTER TABLE `mensaje_estado` DISABLE KEYS */;
/*!40000 ALTER TABLE `mensaje_estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mensaje_responsables`
--

DROP TABLE IF EXISTS `mensaje_responsables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mensaje_responsables` (
  `Id_MenRes` int(11) NOT NULL AUTO_INCREMENT,
  `FechaAsignacion_MenRes` datetime DEFAULT NULL,
  `EstadoResponsable_MenRes` enum('Activo','Inactivo') DEFAULT 'Activo',
  `Id_MenEst` int(11) DEFAULT NULL,
  `Id_Men` int(11) DEFAULT NULL,
  `Id_Usu_Remitente` int(11) DEFAULT NULL,
  `Id_Usu_Destinatario` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_MenRes`) USING BTREE,
  KEY `fk_mensaje_responsables_mensaje_estado1_idx` (`Id_MenEst`) USING BTREE,
  KEY `fk_mensaje_responsables_mensajes1_idx` (`Id_Men`) USING BTREE,
  KEY `fk_mensaje_responsables_usuario1_idx` (`Id_Usu_Remitente`) USING BTREE,
  KEY `fk_mensaje_responsables_usuario2_idx` (`Id_Usu_Destinatario`) USING BTREE,
  CONSTRAINT `fk_mensaje_responsables_mensaje_estado1` FOREIGN KEY (`Id_MenEst`) REFERENCES `mensaje_estado` (`Id_MenEst`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_mensaje_responsables_mensajes1` FOREIGN KEY (`Id_Men`) REFERENCES `mensajes` (`Id_Men`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_mensaje_responsables_usuario1` FOREIGN KEY (`Id_Usu_Remitente`) REFERENCES `usuario` (`Id_Usu`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_mensaje_responsables_usuario2` FOREIGN KEY (`Id_Usu_Destinatario`) REFERENCES `usuario` (`Id_Usu`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensaje_responsables`
--

LOCK TABLES `mensaje_responsables` WRITE;
/*!40000 ALTER TABLE `mensaje_responsables` DISABLE KEYS */;
/*!40000 ALTER TABLE `mensaje_responsables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mensaje_tipo`
--

DROP TABLE IF EXISTS `mensaje_tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mensaje_tipo` (
  `Id_MenTip` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_MenTip` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Id_MenTip`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensaje_tipo`
--

LOCK TABLES `mensaje_tipo` WRITE;
/*!40000 ALTER TABLE `mensaje_tipo` DISABLE KEYS */;
/*!40000 ALTER TABLE `mensaje_tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mensajes`
--

DROP TABLE IF EXISTS `mensajes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mensajes` (
  `Id_Men` int(11) NOT NULL AUTO_INCREMENT,
  `Asunto_Men` text DEFAULT NULL,
  `Mensaje_Men` longtext DEFAULT NULL,
  `FechaRegistro_Men` datetime DEFAULT NULL,
  `FechaVisto_Men` datetime DEFAULT NULL,
  `DestinatarioEmail_Men` varchar(250) DEFAULT NULL,
  `Estado_Men` enum('Activo','Inactivo') DEFAULT 'Activo',
  `Masivo_Men` tinyint(4) DEFAULT 0,
  `Id_MenTip` int(11) DEFAULT NULL,
  `Id_Per` int(11) DEFAULT NULL COMMENT 'Destinatario mensaje',
  `Primary_Usu` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_Men`) USING BTREE,
  KEY `fk_mensajes_mensaje_tipo1_idx` (`Id_MenTip`) USING BTREE,
  KEY `fk_mensajes_persona1_idx` (`Id_Per`) USING BTREE,
  CONSTRAINT `fk_mensajes_mensaje_tipo1` FOREIGN KEY (`Id_MenTip`) REFERENCES `mensaje_tipo` (`Id_MenTip`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_mensajes_persona1` FOREIGN KEY (`Id_Per`) REFERENCES `persona` (`Id_Per`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC COMMENT='	';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensajes`
--

LOCK TABLES `mensajes` WRITE;
/*!40000 ALTER TABLE `mensajes` DISABLE KEYS */;
INSERT INTO `mensajes` VALUES (7,NULL,'Este es un mensaje','2020-04-20 00:00:00',NULL,'madertu@hotmail.com',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `mensajes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `metodo_pago`
--

DROP TABLE IF EXISTS `metodo_pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `metodo_pago` (
  `Id_MetPag` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_MetPag` varchar(255) NOT NULL,
  `Estado_MePag` enum('Activo','Inactivo') DEFAULT 'Activo',
  `FechaRegistro` timestamp NULL DEFAULT current_timestamp(),
  `Primary_Usu` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_MetPag`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `metodo_pago`
--

LOCK TABLES `metodo_pago` WRITE;
/*!40000 ALTER TABLE `metodo_pago` DISABLE KEYS */;
INSERT INTO `metodo_pago` VALUES (1,'Efectivo','Activo','2020-04-14 22:04:30',7),(2,'Efectivo','Activo','2020-04-20 14:04:52',1),(3,'Tarjeta débito','Activo','2020-04-20 14:04:19',1),(4,'Tarjeta crédito','Activo','2020-04-20 14:04:42',1),(5,'Cheque','Activo','2020-04-20 14:04:07',1);
/*!40000 ALTER TABLE `metodo_pago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `municipio`
--

DROP TABLE IF EXISTS `municipio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `municipio` (
  `Id_Mun` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_Num` varchar(90) DEFAULT NULL,
  `Codigo_Mun` varchar(45) DEFAULT NULL,
  `Id_Dep` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_Mun`) USING BTREE,
  KEY `fk_municipio_departamento1_idx` (`Id_Dep`) USING BTREE,
  CONSTRAINT `fk_municipio_departamento1` FOREIGN KEY (`Id_Dep`) REFERENCES `departamento` (`Id_Dep`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1127 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `municipio`
--

LOCK TABLES `municipio` WRITE;
/*!40000 ALTER TABLE `municipio` DISABLE KEYS */;
INSERT INTO `municipio` VALUES (1,'MEDELLIN','1',1),(2,'ABEJORRAL','2',1),(3,'ABRIAQUI','4',1),(4,'ALEJANDRIA','21',1),(5,'AMAGA','30',1),(6,'AMALFI','31',1),(7,'ANDES','34',1),(8,'ANGELOPOLIS','36',1),(9,'ANGOSTURA','38',1),(10,'ANORI','40',1),(11,'ANTIOQUIA','42',1),(12,'ANZA','44',1),(13,'APARTADO','45',1),(14,'ARBOLETES','51',1),(15,'ARGELIA','55',1),(16,'ARMENIA','59',1),(17,'BARBOSA','79',1),(18,'BELMIRA','86',1),(19,'BELLO','88',1),(20,'BETANIA','91',1),(21,'BETULIA','93',1),(22,'BOLIVAR','101',1),(23,'BRICEÑO','107',1),(24,'BURITICA','113',1),(25,'CACERES','120',1),(26,'CAICEDO','125',1),(27,'CALDAS','129',1),(28,'CAMPAMENTO','134',1),(29,'CAÑASGORDAS','138',1),(30,'CARACOLI','142',1),(31,'CARAMANTA','145',1),(32,'CAREPA','147',1),(33,'CARMEN DE VIBORAL','148',1),(34,'CAROLINA','150',1),(35,'CAUCASIA','154',1),(36,'CHIGORODO','172',1),(37,'CISNEROS','190',1),(38,'COCORNA','197',1),(39,'CONCEPCION','206',1),(40,'CONCORDIA','209',1),(41,'COPACABANA','212',1),(42,'DABEIBA','234',1),(43,'DON MATIAS','237',1),(44,'EBEJICO','240',1),(45,'EL BAGRE','250',1),(46,'ENTRERRIOS','264',1),(47,'ENVIGADO','266',1),(48,'FREDONIA','282',1),(49,'FRONTINO','284',1),(50,'GIRALDO','306',1),(51,'GIRARDOTA','308',1),(52,'GOMEZ PLATA','310',1),(53,'GRANADA','313',1),(54,'GUADALUPE','315',1),(55,'GUARNE','318',1),(56,'GUATAPE','321',1),(57,'HELICONIA','347',1),(58,'HISPANIA','353',1),(59,'ITAGUI','360',1),(60,'ITUANGO','361',1),(61,'JARDIN','364',1),(62,'JERICO','368',1),(63,'LA CEJA','376',1),(64,'LA ESTRELLA','380',1),(65,'LA PINTADA','390',1),(66,'LA UNION','400',1),(67,'LIBORINA','411',1),(68,'MACEO','425',1),(69,'MARINILLA','440',1),(70,'MONTEBELLO','467',1),(71,'MURINDO','475',1),(72,'MUTATA','480',1),(73,'NARIÑO','483',1),(74,'NECOCLI','490',1),(75,'NECHI','495',1),(76,'OLAYA','501',1),(77,'PEÑOL','541',1),(78,'PEQUE','543',1),(79,'PUEBLORRICO','576',1),(80,'PUERTO BERRIO','579',1),(81,'PUERTO NARE (LA MAGDALENA)','585',1),(82,'PUERTO TRIUNFO','591',1),(83,'REMEDIOS','604',1),(84,'RETIRO','607',1),(85,'RIONEGRO','615',1),(86,'SABANALARGA','628',1),(87,'SABANETA','631',1),(88,'SALGAR','642',1),(89,'SAN ANDRES','647',1),(90,'SAN CARLOS','649',1),(91,'SAN FRANCISCO','652',1),(92,'SAN JERONIMO','656',1),(93,'SAN JOSE DE LA MONTAÑA','658',1),(94,'SAN JUAN DE URABA','659',1),(95,'SAN LUIS','660',1),(96,'SAN PEDRO','664',1),(97,'SAN PEDRO DE URABA','665',1),(98,'SAN RAFAEL','667',1),(99,'SAN ROQUE','670',1),(100,'SAN VICENTE','674',1),(101,'SANTA BARBARA','679',1),(102,'SANTA ROSA DE OSOS','686',1),(103,'SANTO DOMINGO','690',1),(104,'SANTUARIO','697',1),(105,'SEGOVIA','736',1),(106,'SONSON','756',1),(107,'SOPETRAN','761',1),(108,'TAMESIS','789',1),(109,'TARAZA','790',1),(110,'TARSO','792',1),(111,'TITIRIBI','809',1),(112,'TOLEDO','819',1),(113,'TURBO','837',1),(114,'URAMITA','842',1),(115,'URRAO','847',1),(116,'VALDIVIA','854',1),(117,'VALPARAISO','856',1),(118,'VEGACHI','858',1),(119,'VENECIA','861',1),(120,'VIGIA DEL FUERTE','873',1),(121,'YALI','885',1),(122,'YARUMAL','887',1),(123,'YOLOMBO','890',1),(124,'YONDO','893',1),(125,'ZARAGOZA','895',1),(126,'BARRANQUILLA (DISTRITO ESPECIAL INDUSTRIAL Y PORTUARIO DE BARRANQUILLA)','1',2),(127,'BARANOA','78',2),(128,'CAMPO DE LA CRUZ','137',2),(129,'CANDELARIA','141',2),(130,'GALAPA','296',2),(131,'JUAN DE ACOSTA','372',2),(132,'LURUACO','421',2),(133,'MALAMBO','433',2),(134,'MANATI','436',2),(135,'PALMAR DE VARELA','520',2),(136,'PIOJO','549',2),(137,'POLO NUEVO','558',2),(138,'PONEDERA','560',2),(139,'PUERTO COLOMBIA','573',2),(140,'REPELON','606',2),(141,'SABANAGRANDE','634',2),(142,'SABANALARGA','638',2),(143,'SANTA LUCIA','675',2),(144,'SANTO TOMAS','685',2),(145,'SOLEDAD','758',2),(146,'SUAN','770',2),(147,'TUBARA','832',2),(148,'USIACURI','849',2),(149,'Santa Fe de Bogotá','1',3),(150,'USAQUEN','1',3),(151,'CHAPINERO','2',3),(152,'SANTA FE','3',3),(153,'SAN CRISTOBAL','4',3),(154,'USME','5',3),(155,'TUNJUELITO','6',3),(156,'BOSA','7',3),(157,'KENNEDY','8',3),(158,'FONTIBON','9',3),(159,'ENGATIVA','10',3),(160,'SUBA','11',3),(161,'BARRIOS UNIDOS','12',3),(162,'TEUSAQUILLO','13',3),(163,'MARTIRES','14',3),(164,'ANTONIO NARIÑO','15',3),(165,'PUENTE ARANDA','16',3),(166,'CANDELARIA','17',3),(167,'RAFAEL URIBE','18',3),(168,'CIUDAD BOLIVAR','19',3),(169,'SUMAPAZ','20',3),(170,'CARTAGENA (DISTRITO TURISTICO Y CULTURAL DE CARTAGENA)','1',4),(171,'ACHI','6',4),(172,'ALTOS DEL ROSARIO','30',4),(173,'ARENAL','42',4),(174,'ARJONA','52',4),(175,'ARROYOHONDO','62',4),(176,'BARRANCO DE LOBA','74',4),(177,'CALAMAR','140',4),(178,'CANTAGALLO','160',4),(179,'CICUCO','188',4),(180,'CORDOBA','212',4),(181,'CLEMENCIA','222',4),(182,'EL CARMEN DE BOLIVAR','244',4),(183,'EL GUAMO','248',4),(184,'EL PEÑON','268',4),(185,'HATILLO DE LOBA','300',4),(186,'MAGANGUE','430',4),(187,'MAHATES','433',4),(188,'MARGARITA','440',4),(189,'MARIA LA BAJA','442',4),(190,'MONTECRISTO','458',4),(191,'MOMPOS','468',4),(192,'MORALES','473',4),(193,'PINILLOS','549',4),(194,'REGIDOR','580',4),(195,'RIO VIEJO','600',4),(196,'SAN CRISTOBAL','620',4),(197,'SAN ESTANISLAO','647',4),(198,'SAN FERNANDO','650',4),(199,'SAN JACINTO','654',4),(200,'SAN JACINTO DEL CAUCA','655',4),(201,'SAN JUAN NEPOMUCENO','657',4),(202,'SAN MARTIN DE LOBA','667',4),(203,'SAN PABLO','670',4),(204,'SANTA CATALINA','673',4),(205,'SANTA ROSA','683',4),(206,'SANTA ROSA DEL SUR','688',4),(207,'SIMITI','744',4),(208,'SOPLAVIENTO','760',4),(209,'TALAIGUA NUEVO','780',4),(210,'TIQUISIO (PUERTO RICO)','810',4),(211,'TURBACO','836',4),(212,'TURBANA','838',4),(213,'VILLANUEVA','873',4),(214,'ZAMBRANO','894',4),(215,'TUNJA','1',5),(216,'ALMEIDA','22',5),(217,'AQUITANIA','47',5),(218,'ARCABUCO','51',5),(219,'BELEN','87',5),(220,'BERBEO','90',5),(221,'BETEITIVA','92',5),(222,'BOAVITA','97',5),(223,'BOYACA','104',5),(224,'BRICEÑO','106',5),(225,'BUENAVISTA','109',5),(226,'BUSBANZA','114',5),(227,'CALDAS','131',5),(228,'CAMPOHERMOSO','135',5),(229,'CERINZA','162',5),(230,'CHINAVITA','172',5),(231,'CHIQUINQUIRA','176',5),(232,'CHISCAS','180',5),(233,'CHITA','183',5),(234,'CHITARAQUE','185',5),(235,'CHIVATA','187',5),(236,'CIENEGA','189',5),(237,'COMBITA','204',5),(238,'COPER','212',5),(239,'CORRALES','215',5),(240,'COVARACHIA','218',5),(241,'CUBARA','223',5),(242,'CUCAITA','224',5),(243,'CUITIVA','226',5),(244,'CHIQUIZA','232',5),(245,'CHIVOR','236',5),(246,'DUITAMA','238',5),(247,'EL COCUY','244',5),(248,'EL ESPINO','248',5),(249,'FIRAVITOBA','272',5),(250,'FLORESTA','276',5),(251,'GACHANTIVA','293',5),(252,'GAMEZA','296',5),(253,'GARAGOA','299',5),(254,'GUACAMAYAS','317',5),(255,'GUATEQUE','322',5),(256,'GUAYATA','325',5),(257,'GUICAN','332',5),(258,'IZA','362',5),(259,'JENESANO','367',5),(260,'JERICO','368',5),(261,'LABRANZAGRANDE','377',5),(262,'LA CAPILLA','380',5),(263,'LA VICTORIA','401',5),(264,'LA UVITA','403',5),(265,'VILLA DE LEIVA','407',5),(266,'MACANAL','425',5),(267,'MARIPI','442',5),(268,'MIRAFLORES','455',5),(269,'MONGUA','464',5),(270,'MONGUI','466',5),(271,'MONIQUIRA','469',5),(272,'MOTAVITA','476',5),(273,'MUZO','480',5),(274,'NOBSA','491',5),(275,'NUEVO COLON','494',5),(276,'OICATA','500',5),(277,'OTANCHE','507',5),(278,'PACHAVITA','511',5),(279,'PAEZ','514',5),(280,'PAIPA','516',5),(281,'PAJARITO','518',5),(282,'PANQUEBA','522',5),(283,'PAUNA','531',5),(284,'PAYA','533',5),(285,'PAZ DEL RIO','537',5),(286,'PESCA','542',5),(287,'PISBA','550',5),(288,'PUERTO BOYACA','572',5),(289,'QUIPAMA','580',5),(290,'RAMIRIQUI','599',5),(291,'RAQUIRA','600',5),(292,'RONDON','621',5),(293,'SABOYA','632',5),(294,'SACHICA','638',5),(295,'SAMACA','646',5),(296,'SAN EDUARDO','660',5),(297,'SAN JOSE DE PARE','664',5),(298,'SAN LUIS DE GACENO','667',5),(299,'SAN MATEO','673',5),(300,'SAN MIGUEL DE SEMA','676',5),(301,'SAN PABLO DE BORBUR','681',5),(302,'SANTANA','686',5),(303,'SANTA MARIA','690',5),(304,'SANTA ROSA DE VITERBO','693',5),(305,'SANTA SOFIA','696',5),(306,'SATIVANORTE','720',5),(307,'SATIVASUR','723',5),(308,'SIACHOQUE','740',5),(309,'SOATA','753',5),(310,'SOCOTA','755',5),(311,'SOCHA','757',5),(312,'SOGAMOSO','759',5),(313,'SOMONDOCO','761',5),(314,'SORA','762',5),(315,'SOTAQUIRA','763',5),(316,'SORACA','764',5),(317,'SUSACON','774',5),(318,'SUTAMARCHAN','776',5),(319,'SUTATENZA','778',5),(320,'TASCO','790',5),(321,'TENZA','798',5),(322,'TIBANA','804',5),(323,'TIBASOSA','806',5),(324,'TINJACA','808',5),(325,'TIPACOQUE','810',5),(326,'TOCA','814',5),(327,'TOGUI','816',5),(328,'TOPAGA','820',5),(329,'TOTA','822',5),(330,'TUNUNGUA','832',5),(331,'TURMEQUE','835',5),(332,'TUTA','837',5),(333,'TUTASA','839',5),(334,'UMBITA','842',5),(335,'VENTAQUEMADA','861',5),(336,'VIRACACHA','879',5),(337,'ZETAQUIRA','897',5),(338,'MANIZALES','1',6),(339,'AGUADAS','13',6),(340,'ANSERMA','42',6),(341,'ARANZAZU','50',6),(342,'BELALCAZAR','88',6),(343,'CHINCHINA','174',6),(344,'FILADELFIA','272',6),(345,'LA DORADA','380',6),(346,'LA MERCED','388',6),(347,'MANZANARES','433',6),(348,'MARMATO','442',6),(349,'MARQUETALIA','444',6),(350,'MARULANDA','446',6),(351,'NEIRA','486',6),(352,'NORCASIA','495',6),(353,'PACORA','513',6),(354,'PALESTINA','524',6),(355,'PENSILVANIA','541',6),(356,'RIOSUCIO','614',6),(357,'RISARALDA','616',6),(358,'SALAMINA','653',6),(359,'SAMANA','662',6),(360,'SAN JOSE','665',6),(361,'SUPIA','777',6),(362,'VICTORIA','867',6),(363,'VILLAMARIA','873',6),(364,'VITERBO','877',6),(365,'FLORENCIA','1',7),(366,'ALBANIA','29',7),(367,'BELEN DE LOS ANDAQUIES','94',7),(368,'CARTAGENA DEL CHAIRA','150',7),(369,'CURILLO','205',7),(370,'EL DONCELLO','247',7),(371,'EL PAUJIL','256',7),(372,'LA MONTAÑITA','410',7),(373,'MILAN','460',7),(374,'MORELIA','479',7),(375,'PUERTO RICO','592',7),(376,'SAN JOSE DE FRAGUA','610',7),(377,'SAN VICENTE DEL CAGUAN','753',7),(378,'SOLANO','756',7),(379,'SOLITA','785',7),(380,'VALPARAISO','860',7),(381,'POPAYAN','1',8),(382,'ALMAGUER','22',8),(383,'ARGELIA','50',8),(384,'BALBOA','75',8),(385,'BOLIVAR','100',8),(386,'BUENOS AIRES','110',8),(387,'CAJIBIO','130',8),(388,'CALDONO','137',8),(389,'CALOTO','142',8),(390,'CORINTO','212',8),(391,'EL TAMBO','256',8),(392,'FLORENCIA','290',8),(393,'GUAPI','318',8),(394,'INZA','355',8),(395,'JAMBALO','364',8),(396,'LA SIERRA','392',8),(397,'LA VEGA','397',8),(398,'LOPEZ (MICAY)','418',8),(399,'MERCADERES','450',8),(400,'MIRANDA','455',8),(401,'MORALES','473',8),(402,'PADILLA','513',8),(403,'PAEZ (BELALCAZAR)','517',8),(404,'PATIA (EL BORDO)','532',8),(405,'PIAMONTE','533',8),(406,'PIENDAMO','548',8),(407,'PUERTO TEJADA','573',8),(408,'PURACE (COCONUCO)','585',8),(409,'ROSAS','622',8),(410,'SAN SEBASTIAN','693',8),(411,'SANTANDER DE QUILICHAO','698',8),(412,'SANTA ROSA','701',8),(413,'SILVIA','743',8),(414,'SOTARA (PAISPAMBA)','760',8),(415,'SUAREZ','780',8),(416,'TIMBIO','807',8),(417,'TIMBIQUI','809',8),(418,'TORIBIO','821',8),(419,'TOTORO','824',8),(420,'VILLARICA','845',8),(421,'VALLEDUPAR','1',9),(422,'AGUACHICA','11',9),(423,'AGUSTIN CODAZZI','13',9),(424,'ASTREA','32',9),(425,'BECERRIL','45',9),(426,'BOSCONIA','60',9),(427,'CHIMICHAGUA','175',9),(428,'CHIRIGUANA','178',9),(429,'CURUMANI','228',9),(430,'EL COPEY','238',9),(431,'EL PASO','250',9),(432,'GAMARRA','295',9),(433,'GONZALEZ','310',9),(434,'LA GLORIA','383',9),(435,'LA JAGUA IBIRICO','400',9),(436,'MANAURE (BALCON DEL CESAR)','443',9),(437,'PAILITAS','517',9),(438,'PELAYA','550',9),(439,'PUEBLO BELLO','570',9),(440,'RIO DE ORO','614',9),(441,'LA PAZ (ROBLES)','621',9),(442,'SAN ALBERTO','710',9),(443,'SAN DIEGO','750',9),(444,'SAN MARTIN','770',9),(445,'TAMALAMEQUE','787',9),(446,'MONTERIA','1',10),(447,'AYAPEL','68',10),(448,'BUENAVISTA','79',10),(449,'CANALETE','90',10),(450,'CERETE','162',10),(451,'CHIMA','168',10),(452,'CHINU','182',10),(453,'CIENAGA DE ORO','189',10),(454,'COTORRA','300',10),(455,'LA APARTADA','350',10),(456,'LORICA','417',10),(457,'LOS CORDOBAS','419',10),(458,'MOMIL','464',10),(459,'MONTELIBANO','466',10),(460,'MOÑITOS','500',10),(461,'PLANETA RICA','555',10),(462,'PUEBLO NUEVO','570',10),(463,'PUERTO ESCONDIDO','574',10),(464,'PUERTO LIBERTADOR','580',10),(465,'PURISIMA','586',10),(466,'SAHAGUN','660',10),(467,'SAN ANDRES SOTAVENTO','670',10),(468,'SAN ANTERO','672',10),(469,'SAN BERNARDO DEL VIENTO','675',10),(470,'SAN CARLOS','678',10),(471,'SAN PELAYO','686',10),(472,'TIERRALTA','807',10),(473,'VALENCIA','855',10),(474,'AGUA DE DIOS','1',11),(475,'ALBAN','19',11),(476,'ANAPOIMA','35',11),(477,'ANOLAIMA','40',11),(478,'ARBELAEZ','53',11),(479,'BELTRAN','86',11),(480,'BITUIMA','95',11),(481,'BOJACA','99',11),(482,'CABRERA','120',11),(483,'CACHIPAY','123',11),(484,'CAJICA','126',11),(485,'CAPARRAPI','148',11),(486,'CAQUEZA','151',11),(487,'CARMEN DE CARUPA','154',11),(488,'CHAGUANI','168',11),(489,'CHIA','175',11),(490,'CHIPAQUE','178',11),(491,'CHOACHI','181',11),(492,'CHOCONTA','183',11),(493,'COGUA','200',11),(494,'COTA','214',11),(495,'CUCUNUBA','224',11),(496,'EL COLEGIO','245',11),(497,'EL PEÑON','258',11),(498,'EL ROSAL','260',11),(499,'FACATATIVA','269',11),(500,'FOMEQUE','279',11),(501,'FOSCA','281',11),(502,'FUNZA','286',11),(503,'FUQUENE','288',11),(504,'FUSAGASUGA','290',11),(505,'GACHALA','293',11),(506,'GACHANCIPA','295',11),(507,'GACHETA','297',11),(508,'GAMA','299',11),(509,'GIRARDOT','307',11),(510,'GRANADA','312',11),(511,'GUACHETA','317',11),(512,'GUADUAS','320',11),(513,'GUASCA','322',11),(514,'GUATAQUI','324',11),(515,'GUATAVITA','326',11),(516,'GUAYABAL DE SIQUIMA','328',11),(517,'GUAYABETAL','335',11),(518,'GUTIERREZ','339',11),(519,'JERUSALEN','368',11),(520,'JUNIN','372',11),(521,'LA CALERA','377',11),(522,'LA MESA','386',11),(523,'LA PALMA','394',11),(524,'LA PEÑA','398',11),(525,'LA VEGA','402',11),(526,'LENGUAZAQUE','407',11),(527,'MACHETA','426',11),(528,'MADRID','430',11),(529,'MANTA','436',11),(530,'MEDINA','438',11),(531,'MOSQUERA','473',11),(532,'NARIÑO','483',11),(533,'NEMOCON','486',11),(534,'NILO','488',11),(535,'NIMAIMA','489',11),(536,'NOCAIMA','491',11),(537,'VENECIA (OSPINA PEREZ)','506',11),(538,'PACHO','513',11),(539,'PAIME','518',11),(540,'PANDI','524',11),(541,'PARATEBUENO','530',11),(542,'PASCA','535',11),(543,'PUERTO SALGAR','572',11),(544,'PULI','580',11),(545,'QUEBRADANEGRA','592',11),(546,'QUETAME','594',11),(547,'QUIPILE','596',11),(548,'APULO (RAFAEL REYES)','599',11),(549,'RICAURTE','612',11),(550,'SAN ANTONIO DEL TEQUENDAMA','645',11),(551,'SAN BERNARDO','649',11),(552,'SAN CAYETANO','653',11),(553,'SAN FRANCISCO','658',11),(554,'SAN JUAN DE RIOSECO','662',11),(555,'SASAIMA','718',11),(556,'SESQUILE','736',11),(557,'SIBATE','740',11),(558,'SILVANIA','743',11),(559,'SIMIJACA','745',11),(560,'SOACHA','754',11),(561,'SOPO','758',11),(562,'SUBACHOQUE','769',11),(563,'SUESCA','772',11),(564,'SUPATA','777',11),(565,'SUSA','779',11),(566,'SUTATAUSA','781',11),(567,'TABIO','785',11),(568,'TAUSA','793',11),(569,'TENA','797',11),(570,'TENJO','799',11),(571,'TIBACUY','805',11),(572,'TIBIRITA','807',11),(573,'TOCAIMA','815',11),(574,'TOCANCIPA','817',11),(575,'TOPAIPI','823',11),(576,'UBALA','839',11),(577,'UBAQUE','841',11),(578,'UBATE','843',11),(579,'UNE','845',11),(580,'UTICA','851',11),(581,'VERGARA','862',11),(582,'VIANI','867',11),(583,'VILLAGOMEZ','871',11),(584,'VILLAPINZON','873',11),(585,'VILLETA','875',11),(586,'VIOTA','878',11),(587,'YACOPI','885',11),(588,'ZIPACON','898',11),(589,'ZIPAQUIRA','899',11),(590,'QUIBDO (SAN FRANCISCO DE QUIBDO)','1',12),(591,'ACANDI','6',12),(592,'ALTO BAUDO (PIE DE PATO)','25',12),(593,'ATRATO','50',12),(594,'BAGADO','73',12),(595,'BAHIA SOLANO (MUTIS)','75',12),(596,'BAJO BAUDO (PIZARRO)','77',12),(597,'BOJAYA (BELLAVISTA)','99',12),(598,'CANTON DE SAN PABLO (MANAGRU)','135',12),(599,'CONDOTO','205',12),(600,'EL CARMEN DE ATRATO','245',12),(601,'LITORAL DEL BAJO SAN JUAN (SANTA GENOVEVA DE DOCORDO)','250',12),(602,'ISTMINA','361',12),(603,'JURADO','372',12),(604,'LLORO','413',12),(605,'MEDIO ATRATO','425',12),(606,'MEDIO BAUDO','430',12),(607,'NOVITA','491',12),(608,'NUQUI','495',12),(609,'RIOQUITO','600',12),(610,'RIOSUCIO','615',12),(611,'SAN JOSE DEL PALMAR','660',12),(612,'SIPI','745',12),(613,'TADO','787',12),(614,'UNGUIA','800',12),(615,'UNION PANAMERICANA','810',12),(616,'NEIVA','1',13),(617,'ACEVEDO','6',13),(618,'AGRADO','13',13),(619,'AIPE','16',13),(620,'ALGECIRAS','20',13),(621,'ALTAMIRA','26',13),(622,'BARAYA','78',13),(623,'CAMPOALEGRE','132',13),(624,'COLOMBIA','206',13),(625,'ELIAS','244',13),(626,'GARZON','298',13),(627,'GIGANTE','306',13),(628,'GUADALUPE','319',13),(629,'HOBO','349',13),(630,'IQUIRA','357',13),(631,'ISNOS (SAN JOSE DE ISNOS)','359',13),(632,'LA ARGENTINA','378',13),(633,'LA PLATA','396',13),(634,'NATAGA','483',13),(635,'OPORAPA','503',13),(636,'PAICOL','518',13),(637,'PALERMO','524',13),(638,'PALESTINA','530',13),(639,'PITAL','548',13),(640,'PITALITO','551',13),(641,'RIVERA','615',13),(642,'SALADOBLANCO','660',13),(643,'SAN AGUSTIN','668',13),(644,'SANTA MARIA','676',13),(645,'SUAZA','770',13),(646,'TARQUI','791',13),(647,'TESALIA','797',13),(648,'TELLO','799',13),(649,'TERUEL','801',13),(650,'TIMANA','807',13),(651,'VILLAVIEJA','872',13),(652,'YAGUARA','885',13),(653,'RIOHACHA','1',14),(654,'BARRANCAS','78',14),(655,'DIBULLA','90',14),(656,'DISTRACCION','98',14),(657,'EL MOLINO','110',14),(658,'FONSECA','279',14),(659,'HATONUEVO','378',14),(660,'LA JAGUA DEL PILAR','420',14),(661,'MAICAO','430',14),(662,'MANAURE','560',14),(663,'SAN JUAN DEL CESAR','650',14),(664,'URIBIA','847',14),(665,'URUMITA','855',14),(666,'VILLANUEVA','874',14),(667,'SANTA MARTA (DISTRITO TURISTICO CULTURAL E HISTORICO DE SANTA MARTA)','1',15),(668,'ALGARROBO','30',15),(669,'ARACATACA','53',15),(670,'ARIGUANI (EL DIFICIL)','58',15),(671,'CERRO SAN ANTONIO','161',15),(672,'CHIVOLO','170',15),(673,'CIENAGA','189',15),(674,'CONCORDIA','205',15),(675,'EL BANCO','245',15),(676,'EL PIÑON','258',15),(677,'EL RETEN','268',15),(678,'FUNDACION','288',15),(679,'GUAMAL','318',15),(680,'PEDRAZA','541',15),(681,'PIJIÑO DEL CARMEN (PIJIÑO)','545',15),(682,'PIVIJAY','551',15),(683,'PLATO','555',15),(684,'PUEBLOVIEJO','570',15),(685,'REMOLINO','605',15),(686,'SABANAS DE SAN ANGEL','660',15),(687,'SALAMINA','675',15),(688,'SAN SEBASTIAN DE BUENAVISTA','692',15),(689,'SAN ZENON','703',15),(690,'SANTA ANA','707',15),(691,'SITIONUEVO','745',15),(692,'TENERIFE','798',15),(693,'VILLAVICENCIO','1',16),(694,'ACACIAS','6',16),(695,'BARRANCA DE UPIA','110',16),(696,'CABUYARO','124',16),(697,'CASTILLA LA NUEVA','150',16),(698,'SAN LUIS DE CUBARRAL','223',16),(699,'CUMARAL','226',16),(700,'EL CALVARIO','245',16),(701,'EL CASTILLO','251',16),(702,'EL DORADO','270',16),(703,'FUENTE DE ORO','287',16),(704,'GRANADA','313',16),(705,'GUAMAL','318',16),(706,'MAPIRIPAN','325',16),(707,'MESETAS','330',16),(708,'LA MACARENA','350',16),(709,'LA URIBE','370',16),(710,'LEJANIAS','400',16),(711,'PUERTO CONCORDIA','450',16),(712,'PUERTO GAITAN','568',16),(713,'PUERTO LOPEZ','573',16),(714,'PUERTO LLERAS','577',16),(715,'PUERTO RICO','590',16),(716,'RESTREPO','606',16),(717,'SAN CARLOS DE GUAROA','680',16),(718,'SAN JUAN DE ARAMA','683',16),(719,'SAN JUANITO','686',16),(720,'SAN MARTIN','689',16),(721,'VISTAHERMOSA','711',16),(722,'PASTO (SAN JUAN DE PASTO)','1',17),(723,'ALBAN (SAN JOSE)','19',17),(724,'ALDANA','22',17),(725,'ANCUYA','36',17),(726,'ARBOLEDA (BERRUECOS)','51',17),(727,'BARBACOAS','79',17),(728,'BELEN','83',17),(729,'BUESACO','110',17),(730,'COLON (GENOVA)','203',17),(731,'CONSACA','207',17),(732,'CONTADERO','210',17),(733,'CORDOBA','215',17),(734,'CUASPUD (CARLOSAMA)','224',17),(735,'CUMBAL','227',17),(736,'CUMBITARA','233',17),(737,'CHACHAGUI','240',17),(738,'EL CHARCO','250',17),(739,'EL PEÑOL','254',17),(740,'EL ROSARIO','256',17),(741,'EL TABLON','258',17),(742,'EL TAMBO','260',17),(743,'FUNES','287',17),(744,'GUACHUCAL','317',17),(745,'GUAITARILLA','320',17),(746,'GUALMATAN','323',17),(747,'ILES','352',17),(748,'IMUES','354',17),(749,'IPIALES','356',17),(750,'LA CRUZ','378',17),(751,'LA FLORIDA','381',17),(752,'LA LLANADA','385',17),(753,'LA TOLA','390',17),(754,'LA UNION','399',17),(755,'LEIVA','405',17),(756,'LINARES','411',17),(757,'LOS ANDES (SOTOMAYOR)','418',17),(758,'MAGUI (PAYAN)','427',17),(759,'MALLAMA (PIEDRANCHA)','435',17),(760,'MOSQUERA','473',17),(761,'OLAYA HERRERA (BOCAS DE SATINGA)','490',17),(762,'OSPINA','506',17),(763,'FRANCISCO PIZARRO (SALAHONDA)','520',17),(764,'POLICARPA','540',17),(765,'POTOSI','560',17),(766,'PROVIDENCIA','565',17),(767,'PUERRES','573',17),(768,'PUPIALES','585',17),(769,'RICAURTE','612',17),(770,'ROBERTO PAYAN (SAN JOSE)','621',17),(771,'SAMANIEGO','678',17),(772,'SANDONA','683',17),(773,'SAN BERNARDO','685',17),(774,'SAN LORENZO','687',17),(775,'SAN PABLO','693',17),(776,'SAN PEDRO DE CARTAGO','694',17),(777,'SANTA BARBARA (ISCUANDE)','696',17),(778,'SANTA CRUZ (GUACHAVES)','699',17),(779,'SAPUYES','720',17),(780,'TAMINANGO','786',17),(781,'TANGUA','788',17),(782,'TUMACO','835',17),(783,'TUQUERRES','838',17),(784,'YACUANQUER','885',17),(785,'CUCUTA','1',18),(786,'ABREGO','3',18),(787,'ARBOLEDAS','51',18),(788,'BOCHALEMA','99',18),(789,'BUCARASICA','109',18),(790,'CACOTA','125',18),(791,'CACHIRA','128',18),(792,'CHINACOTA','172',18),(793,'CHITAGA','174',18),(794,'CONVENCION','206',18),(795,'CUCUTILLA','223',18),(796,'DURANIA','239',18),(797,'EL CARMEN','245',18),(798,'EL TARRA','250',18),(799,'EL ZULIA','261',18),(800,'GRAMALOTE','313',18),(801,'HACARI','344',18),(802,'HERRAN','347',18),(803,'LABATECA','377',18),(804,'LA ESPERANZA','385',18),(805,'LA PLAYA','398',18),(806,'LOS PATIOS','405',18),(807,'LOURDES','418',18),(808,'MUTISCUA','480',18),(809,'OCAÑA','498',18),(810,'PAMPLONA','518',18),(811,'PAMPLONITA','520',18),(812,'PUERTO SANTANDER','553',18),(813,'RAGONVALIA','599',18),(814,'SALAZAR','660',18),(815,'SAN CALIXTO','670',18),(816,'SAN CAYETANO','673',18),(817,'SANTIAGO','680',18),(818,'SARDINATA','720',18),(819,'SILOS','743',18),(820,'TEORAMA','800',18),(821,'TIBU','810',18),(822,'TOLEDO','820',18),(823,'VILLACARO','871',18),(824,'VILLA DEL ROSARIO','874',18),(825,'ARMENIA','1',19),(826,'BUENAVISTA','111',19),(827,'CALARCA','130',19),(828,'CIRCASIA','190',19),(829,'CORDOBA','212',19),(830,'FILANDIA','272',19),(831,'GENOVA','302',19),(832,'LA TEBAIDA','401',19),(833,'MONTENEGRO','470',19),(834,'PIJAO','548',19),(835,'QUIMBAYA','594',19),(836,'SALENTO','690',19),(837,'PEREIRA','1',20),(838,'APIA','45',20),(839,'BALBOA','75',20),(840,'BELEN DE UMBRIA','88',20),(841,'DOS QUEBRADAS','170',20),(842,'GUATICA','318',20),(843,'LA CELIA','383',20),(844,'LA VIRGINIA','400',20),(845,'MARSELLA','440',20),(846,'MISTRATO','456',20),(847,'PUEBLO RICO','572',20),(848,'QUINCHIA','594',20),(849,'SANTA ROSA DE CABAL','682',20),(850,'SANTUARIO','687',20),(851,'BUCARAMANGA','1',21),(852,'AGUADA','13',21),(853,'ALBANIA','20',21),(854,'ARATOCA','51',21),(855,'BARBOSA','77',21),(856,'BARICHARA','79',21),(857,'BARRANCABERMEJA','81',21),(858,'BETULIA','92',21),(859,'BOLIVAR','101',21),(860,'CABRERA','121',21),(861,'CALIFORNIA','132',21),(862,'CAPITANEJO','147',21),(863,'CARCASI','152',21),(864,'CEPITA','160',21),(865,'CERRITO','162',21),(866,'CHARALA','167',21),(867,'CHARTA','169',21),(868,'CHIMA','176',21),(869,'CHIPATA','179',21),(870,'CIMITARRA','190',21),(871,'CONCEPCION','207',21),(872,'CONFINES','209',21),(873,'CONTRATACION','211',21),(874,'COROMORO','217',21),(875,'CURITI','229',21),(876,'EL CARMEN DE CHUCURY','235',21),(877,'EL GUACAMAYO','245',21),(878,'EL PEÑON','250',21),(879,'EL PLAYON','255',21),(880,'ENCINO','264',21),(881,'ENCISO','266',21),(882,'FLORIAN','271',21),(883,'FLORIDABLANCA','276',21),(884,'GALAN','296',21),(885,'GAMBITA','298',21),(886,'GIRON','307',21),(887,'GUACA','318',21),(888,'GUADALUPE','320',21),(889,'GUAPOTA','322',21),(890,'GUAVATA','324',21),(891,'GUEPSA','327',21),(892,'HATO','344',21),(893,'JESUS MARIA','368',21),(894,'JORDAN','370',21),(895,'LA BELLEZA','377',21),(896,'LANDAZURI','385',21),(897,'LA PAZ','397',21),(898,'LEBRIJA','406',21),(899,'LOS SANTOS','418',21),(900,'MACARAVITA','425',21),(901,'MALAGA','432',21),(902,'MATANZA','444',21),(903,'MOGOTES','464',21),(904,'MOLAGAVITA','468',21),(905,'OCAMONTE','498',21),(906,'OIBA','500',21),(907,'ONZAGA','502',21),(908,'PALMAR','522',21),(909,'PALMAS DEL SOCORRO','524',21),(910,'PARAMO','533',21),(911,'PIEDECUESTA','547',21),(912,'PINCHOTE','549',21),(913,'PUENTE NACIONAL','572',21),(914,'PUERTO PARRA','573',21),(915,'PUERTO WILCHES','575',21),(916,'RIONEGRO','615',21),(917,'SABANA DE TORRES','655',21),(918,'SAN ANDRES','669',21),(919,'SAN BENITO','673',21),(920,'SAN GIL','679',21),(921,'SAN JOAQUIN','682',21),(922,'SAN JOSE DE MIRANDA','684',21),(923,'SAN MIGUEL','686',21),(924,'SAN VICENTE DE CHUCURI','689',21),(925,'SANTA BARBARA','705',21),(926,'SANTA HELENA DEL OPON','720',21),(927,'SIMACOTA','745',21),(928,'SOCORRO','755',21),(929,'SUAITA','770',21),(930,'SUCRE','773',21),(931,'SURATA','780',21),(932,'TONA','820',21),(933,'VALLE SAN JOSE','855',21),(934,'VELEZ','861',21),(935,'VETAS','867',21),(936,'VILLANUEVA','872',21),(937,'ZAPATOCA','895',21),(938,'SINCELEJO','1',22),(939,'BUENAVISTA','110',22),(940,'CAIMITO','124',22),(941,'COLOSO (RICAURTE)','204',22),(942,'COROZAL','215',22),(943,'CHALAN','230',22),(944,'GALERAS (NUEVA GRANADA)','235',22),(945,'GUARANDA','265',22),(946,'LA UNION','400',22),(947,'LOS PALMITOS','418',22),(948,'MAJAGUAL','429',22),(949,'MORROA','473',22),(950,'OVEJAS','508',22),(951,'PALMITO','523',22),(952,'SAMPUES','670',22),(953,'SAN BENITO ABAD','678',22),(954,'SAN JUAN DE BETULIA','702',22),(955,'SAN MARCOS','708',22),(956,'SAN ONOFRE','713',22),(957,'SAN PEDRO','717',22),(958,'SINCE','742',22),(959,'SUCRE','771',22),(960,'TOLU','820',22),(961,'TOLUVIEJO','823',22),(962,'IBAGUE','1',23),(963,'ALPUJARRA','24',23),(964,'ALVARADO','26',23),(965,'AMBALEMA','30',23),(966,'ANZOATEGUI','43',23),(967,'ARMERO (GUAYABAL)','55',23),(968,'ATACO','67',23),(969,'CAJAMARCA','124',23),(970,'CARMEN APICALA','148',23),(971,'CASABIANCA','152',23),(972,'CHAPARRAL','168',23),(973,'COELLO','200',23),(974,'COYAIMA','217',23),(975,'CUNDAY','226',23),(976,'DOLORES','236',23),(977,'ESPINAL','268',23),(978,'FALAN','270',23),(979,'FLANDES','275',23),(980,'FRESNO','283',23),(981,'GUAMO','319',23),(982,'HERVEO','347',23),(983,'HONDA','349',23),(984,'ICONONZO','352',23),(985,'LERIDA','408',23),(986,'LIBANO','411',23),(987,'MARIQUITA','443',23),(988,'MELGAR','449',23),(989,'MURILLO','461',23),(990,'NATAGAIMA','483',23),(991,'ORTEGA','504',23),(992,'PALOCABILDO','520',23),(993,'PIEDRAS','547',23),(994,'PLANADAS','555',23),(995,'PRADO','563',23),(996,'PURIFICACION','585',23),(997,'RIOBLANCO','616',23),(998,'RONCESVALLES','622',23),(999,'ROVIRA','624',23),(1000,'SALDAÑA','671',23),(1001,'SAN ANTONIO','675',23),(1002,'SAN LUIS','678',23),(1003,'SANTA ISABEL','686',23),(1004,'SUAREZ','770',23),(1005,'VALLE DE SAN JUAN','854',23),(1006,'VENADILLO','861',23),(1007,'VILLAHERMOSA','870',23),(1008,'VILLARRICA','873',23),(1009,'CALI (SANTIAGO DE CALI)','1',24),(1010,'ALCALA','20',24),(1011,'ANDALUCIA','36',24),(1012,'ANSERMANUEVO','41',24),(1013,'ARGELIA','54',24),(1014,'BOLIVAR','100',24),(1015,'BUENAVENTURA','109',24),(1016,'BUGA','111',24),(1017,'BUGALAGRANDE','113',24),(1018,'CAICEDONIA','122',24),(1019,'CALIMA (DARIEN)','126',24),(1020,'CANDELARIA','130',24),(1021,'CARTAGO','147',24),(1022,'DAGUA','233',24),(1023,'EL AGUILA','243',24),(1024,'EL CAIRO','246',24),(1025,'EL CERRITO','248',24),(1026,'EL DOVIO','250',24),(1027,'FLORIDA','275',24),(1028,'GINEBRA','306',24),(1029,'GUACARI','318',24),(1030,'JAMUNDI','364',24),(1031,'LA CUMBRE','377',24),(1032,'LA UNION','400',24),(1033,'LA VICTORIA','403',24),(1034,'OBANDO','497',24),(1035,'PALMIRA','520',24),(1036,'PRADERA','563',24),(1037,'RESTREPO','606',24),(1038,'RIOFRIO','616',24),(1039,'ROLDANILLO','622',24),(1040,'SAN PEDRO','670',24),(1041,'SEVILLA','736',24),(1042,'TORO','823',24),(1043,'TRUJILLO','828',24),(1044,'TULUA','834',24),(1045,'ULLOA','845',24),(1046,'VERSALLES','863',24),(1047,'VIJES','869',24),(1048,'YOTOCO','890',24),(1049,'YUMBO','892',24),(1050,'ZARZAL','895',24),(1051,'ARAUCA','1',25),(1052,'ARAUQUITA','65',25),(1053,'CRAVO NORTE','220',25),(1054,'FORTUL','300',25),(1055,'PUERTO RONDON','591',25),(1056,'SARAVENA','736',25),(1057,'TAME','794',25),(1058,'YOPAL','1',26),(1059,'AGUAZUL','10',26),(1060,'CHAMEZA','15',26),(1061,'HATO COROZAL','125',26),(1062,'LA SALINA','136',26),(1063,'MANI','139',26),(1064,'MONTERREY','162',26),(1065,'NUNCHIA','225',26),(1066,'OROCUE','230',26),(1067,'PAZ DE ARIPORO','250',26),(1068,'PORE','263',26),(1069,'RECETOR','279',26),(1070,'SABANALARGA','300',26),(1071,'SACAMA','315',26),(1072,'SAN LUIS DE PALENQUE','325',26),(1073,'TAMARA','400',26),(1074,'TAURAMENA','410',26),(1075,'TRINIDAD','430',26),(1076,'VILLANUEVA','440',26),(1077,'MOCOA','1',27),(1078,'COLON','219',27),(1079,'ORITO','320',27),(1080,'PUERTO ASIS','568',27),(1081,'PUERTO CAICEDO','569',27),(1082,'PUERTO GUZMAN','571',27),(1083,'PUERTO LEGUIZAMO','573',27),(1084,'SIBUNDOY','749',27),(1085,'SAN FRANCISCO','755',27),(1086,'SAN MIGUEL (LA DORADA)','757',27),(1087,'SANTIAGO','760',27),(1088,'LA HORMIGA (VALLE DEL GUAMUEZ)','865',27),(1089,'VILLAGARZON','885',27),(1090,'SAN ANDRES','1',28),(1091,'PROVIDENCIA','564',28),(1092,'LETICIA','1',29),(1093,'EL ENCANTO','263',29),(1094,'LA CHORRERA','405',29),(1095,'LA PEDRERA','407',29),(1096,'LA VICTORIA','430',29),(1097,'MIRITI-PARANA','460',29),(1098,'PUERTO ALEGRIA','530',29),(1099,'PUERTO ARICA','536',29),(1100,'PUERTO NARIÑO','540',29),(1101,'PUERTO SANTANDER','669',29),(1102,'TARAPACA','798',29),(1103,'PUERTO INIRIDA','1',30),(1104,'BARRANCO MINAS','343',30),(1105,'SAN FELIPE','883',30),(1106,'PUERTO COLOMBIA','884',30),(1107,'LA GUADALUPE','885',30),(1108,'CACAHUAL','886',30),(1109,'PANA PANA (CAMPO ALEGRE)','887',30),(1110,'MORICHAL (MORICHAL NUEVO)','888',30),(1111,'SAN JOSE DEL GUAVIARE','1',31),(1112,'CALAMAR','15',31),(1113,'EL RETORNO','25',31),(1114,'MIRAFLORES','200',31),(1115,'MITU','1',32),(1116,'CARURU','161',32),(1117,'PACOA','511',32),(1118,'TARAIRA','666',32),(1119,'PAPUNAUA (MORICHAL)','777',32),(1120,'YAVARATE','889',32),(1121,'PUERTO CARREÑO','1',33),(1122,'LA PRIMAVERA','524',33),(1123,'SANTA RITA','572',33),(1124,'SANTA ROSALIA','666',33),(1125,'SAN JOSE DE OCUNE','760',33),(1126,'CUMARIBO','773',33);
/*!40000 ALTER TABLE `municipio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `naturaleza_cuenta`
--

DROP TABLE IF EXISTS `naturaleza_cuenta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `naturaleza_cuenta` (
  `Id_NatCue` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_NatCue` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id_NatCue`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `naturaleza_cuenta`
--

LOCK TABLES `naturaleza_cuenta` WRITE;
/*!40000 ALTER TABLE `naturaleza_cuenta` DISABLE KEYS */;
INSERT INTO `naturaleza_cuenta` VALUES (1,'Débito'),(2,'Crédito');
/*!40000 ALTER TABLE `naturaleza_cuenta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `numeracion_documentos`
--

DROP TABLE IF EXISTS `numeracion_documentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `numeracion_documentos` (
  `Id_NumDoc` int(11) NOT NULL AUTO_INCREMENT,
  `Inicial_NumDoc` int(11) DEFAULT NULL,
  `Siguiente_NumDoc` int(11) DEFAULT NULL,
  `Id_DocTip` int(11) DEFAULT NULL,
  `Id_TranTip` int(11) DEFAULT NULL,
  `Primary_Usu` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_NumDoc`),
  KEY `fk_numeracion_documentos_documento_tipo1_idx` (`Id_DocTip`),
  KEY `fk_numeracion_documentos_transaccion_tipo1_idx` (`Id_TranTip`),
  CONSTRAINT `fk_numeracion_documentos_documento_tipo1` FOREIGN KEY (`Id_DocTip`) REFERENCES `documento_tipo` (`Id_DocTip`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_numeracion_documentos_transaccion_tipo1` FOREIGN KEY (`Id_TranTip`) REFERENCES `transaccion_tipo` (`Id_TranTip`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `numeracion_documentos`
--

LOCK TABLES `numeracion_documentos` WRITE;
/*!40000 ALTER TABLE `numeracion_documentos` DISABLE KEYS */;
INSERT INTO `numeracion_documentos` VALUES (19,1,2,9,9,1),(20,1,3,8,8,1),(21,1,5,7,7,1),(22,1,6,6,6,1),(23,1,1,5,5,1),(24,1,1,4,4,1),(25,1,1,3,3,1),(26,1,2,2,2,1),(27,1,2,1,1,1);
/*!40000 ALTER TABLE `numeracion_documentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `numeracion_facturas`
--

DROP TABLE IF EXISTS `numeracion_facturas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `numeracion_facturas` (
  `Id_NumFac` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_NumFac` varchar(155) NOT NULL,
  `Prefijo_NumFac` varchar(50) DEFAULT NULL,
  `Numero_NumFac` int(11) NOT NULL,
  `Resolucion_NumFac` text DEFAULT NULL,
  `Activo_NumFac` enum('Activo','Inactivo') DEFAULT 'Activo',
  `Defecto_NumFac` enum('Activo','Inactivo') DEFAULT NULL,
  `Primary_Usu` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_NumFac`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `numeracion_facturas`
--

LOCK TABLES `numeracion_facturas` WRITE;
/*!40000 ALTER TABLE `numeracion_facturas` DISABLE KEYS */;
INSERT INTO `numeracion_facturas` VALUES (2,'Principal','FV',10,'Desde 10 hasta 1000','Activo','Activo',1);
/*!40000 ALTER TABLE `numeracion_facturas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pagos`
--

DROP TABLE IF EXISTS `pagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pagos` (
  `Id_Pag` int(11) NOT NULL AUTO_INCREMENT,
  `Valor_Pag` double DEFAULT NULL,
  `Fecha_Pag` datetime DEFAULT NULL,
  `Id_MetPag` int(11) DEFAULT NULL,
  `Id_Tran` int(11) DEFAULT NULL,
  `Primary_Usu` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_Pag`) USING BTREE,
  KEY `fk_pagos_metodo_pago1_idx` (`Id_MetPag`) USING BTREE,
  KEY `fk_pagos_transacciones1_idx` (`Id_Tran`) USING BTREE,
  CONSTRAINT `fk_pagos_metodo_pago1` FOREIGN KEY (`Id_MetPag`) REFERENCES `metodo_pago` (`Id_MetPag`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_pagos_transacciones1` FOREIGN KEY (`Id_Tran`) REFERENCES `transacciones` (`Id_Tran`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagos`
--

LOCK TABLES `pagos` WRITE;
/*!40000 ALTER TABLE `pagos` DISABLE KEYS */;
INSERT INTO `pagos` VALUES (1,2295299.95,'2020-05-08 16:05:27',2,6,1),(2,2295299.95,'2020-05-08 16:05:18',2,7,1),(3,1750000,'2020-05-09 17:05:06',2,8,1),(4,225000,'2020-05-09 20:05:04',2,9,1),(5,828000,'2020-05-15 18:05:52',3,10,1),(6,113050,'2020-06-29 17:06:19',2,11,1),(7,277200,'2020-07-02 22:07:45',2,12,1),(8,1370260,'2020-07-02 22:07:55',3,13,1),(9,9750,'2020-07-02 22:07:31',3,14,1),(10,600000,'2020-07-02 22:07:31',2,14,1),(11,815800,'2020-07-04 18:07:00',2,15,1),(12,2692750,'2020-07-04 21:07:31',2,16,1),(13,693000,'2020-07-05 21:07:31',3,17,1),(14,111600,'2020-07-07 18:07:53',4,18,1),(15,810000,'2020-07-11 15:07:13',2,19,1),(16,70000000,'2020-08-02 17:08:56',3,20,1),(17,25350000,'2020-08-02 17:08:56',2,20,1);
/*!40000 ALTER TABLE `pagos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permiso`
--

DROP TABLE IF EXISTS `permiso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permiso` (
  `Id_Perm` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion_Perm` varchar(251) DEFAULT NULL,
  `Acceso_Perm` enum('SI','NO') DEFAULT NULL,
  `Controlador_Perm` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`Id_Perm`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permiso`
--

LOCK TABLES `permiso` WRITE;
/*!40000 ALTER TABLE `permiso` DISABLE KEYS */;
INSERT INTO `permiso` VALUES (1,'Total','SI','Total');
/*!40000 ALTER TABLE `permiso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `persona`
--

DROP TABLE IF EXISTS `persona`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `persona` (
  `Id_Per` int(11) NOT NULL AUTO_INCREMENT,
  `Identificacion_Per` varchar(45) DEFAULT NULL,
  `Nombre1_Per` varchar(150) DEFAULT NULL,
  `Nombre2_Per` varchar(150) DEFAULT NULL,
  `Apeliido1_Per` varchar(150) DEFAULT NULL,
  `Apellido2_Per` varchar(150) DEFAULT NULL,
  `Telefono_Per` varchar(20) DEFAULT NULL,
  `TelCelular_Per` varchar(45) DEFAULT NULL,
  `Correo_Per` varchar(350) DEFAULT NULL,
  `Direccion_Per` varchar(255) DEFAULT NULL,
  `FechaNacimiento_Per` date DEFAULT NULL,
  `FechaRegistro_Per` datetime DEFAULT NULL,
  `Celular_Per` varchar(20) DEFAULT NULL,
  `Id_PerTipId` int(11) DEFAULT NULL,
  `Id_PerGen` int(11) DEFAULT NULL,
  `Id_Mun` int(11) DEFAULT NULL,
  `Id_PerEst` int(11) DEFAULT NULL,
  `Id_PerTip` int(11) DEFAULT NULL,
  `Id_Emp` int(11) DEFAULT NULL,
  `Primary_Usu` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_Per`) USING BTREE,
  KEY `fk_persona_persona_tipo_identificacion1_idx` (`Id_PerTipId`) USING BTREE,
  KEY `fk_persona_persona_genero1_idx` (`Id_PerGen`) USING BTREE,
  KEY `fk_persona_municipio1_idx` (`Id_Mun`) USING BTREE,
  KEY `fk_persona_persona_estado1_idx` (`Id_PerEst`) USING BTREE,
  KEY `fk_persona_persona_tipo1_idx` (`Id_PerTip`) USING BTREE,
  KEY `fk_persona_empresa1_idx` (`Id_Emp`) USING BTREE,
  KEY `fk_idx_Identificacion_Per` (`Identificacion_Per`) USING BTREE,
  KEY `fk_idx_nombre_persona` (`Nombre1_Per`,`Nombre2_Per`,`Apeliido1_Per`,`Apellido2_Per`) USING BTREE,
  CONSTRAINT `fk_persona_empresa1` FOREIGN KEY (`Id_Emp`) REFERENCES `empresa` (`Id_Emp`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_persona_municipio1` FOREIGN KEY (`Id_Mun`) REFERENCES `municipio` (`Id_Mun`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_persona_persona_estado1` FOREIGN KEY (`Id_PerEst`) REFERENCES `persona_estado` (`Id_PerEst`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_persona_persona_genero1` FOREIGN KEY (`Id_PerGen`) REFERENCES `persona_genero` (`Id_PerGen`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_persona_persona_tipo1` FOREIGN KEY (`Id_PerTip`) REFERENCES `persona_tipo` (`Id_PerTip`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_persona_persona_tipo_identificacion1` FOREIGN KEY (`Id_PerTipId`) REFERENCES `persona_tipo_identificacion` (`Id_PerTipId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `persona`
--

LOCK TABLES `persona` WRITE;
/*!40000 ALTER TABLE `persona` DISABLE KEYS */;
INSERT INTO `persona` VALUES (1,'1061772286','Miguel','Andersson','Tunubalá','Morales','3207296111','8470660','madertu@hotmail.com','Cra 3 No 3a-89','1994-07-19',NULL,NULL,4,1,406,1,3,NULL,1),(2,'25683936','Gladis','Amparo','Morales','Tombé','3167645007',NULL,'gamoralest@gmail.com',NULL,'2020-03-24','2020-03-24 22:03:57',NULL,4,2,413,1,1,NULL,1),(5,'1061772286','Maria','Victoria','Niquinas',NULL,NULL,'3207296111','vikynr@gmail.com',NULL,NULL,'2020-03-26 16:03:58',NULL,4,2,381,1,3,NULL,7),(6,'1061469761','Angy','Carolina','Martinez','Vidal','3127950861','8470660','angycarolinamartinezv@gmail.com','Cra 27n-77, Los hoyos','1994-06-14','2020-03-27 03:03:29',NULL,4,2,381,1,1,NULL,7),(7,'1061769461','Angy','Carolina','Martinez','Vidal','3127950861',NULL,NULL,'Cra 3 No 3a-89','2020-04-14','2020-04-14 17:04:51',NULL,4,NULL,NULL,1,3,NULL,1);
/*!40000 ALTER TABLE `persona` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `persona_estado`
--

DROP TABLE IF EXISTS `persona_estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `persona_estado` (
  `Id_PerEst` int(11) NOT NULL AUTO_INCREMENT,
  `Estado_PerEst` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id_PerEst`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `persona_estado`
--

LOCK TABLES `persona_estado` WRITE;
/*!40000 ALTER TABLE `persona_estado` DISABLE KEYS */;
INSERT INTO `persona_estado` VALUES (1,'Activo'),(2,'Inactivo');
/*!40000 ALTER TABLE `persona_estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `persona_genero`
--

DROP TABLE IF EXISTS `persona_genero`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `persona_genero` (
  `Id_PerGen` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion_PerGen` varchar(45) DEFAULT NULL,
  `Codigo_PerGen` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`Id_PerGen`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `persona_genero`
--

LOCK TABLES `persona_genero` WRITE;
/*!40000 ALTER TABLE `persona_genero` DISABLE KEYS */;
INSERT INTO `persona_genero` VALUES (1,'Masculino','M'),(2,'Femenino','F');
/*!40000 ALTER TABLE `persona_genero` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `persona_tipo`
--

DROP TABLE IF EXISTS `persona_tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `persona_tipo` (
  `Id_PerTip` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion_PerTip` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id_PerTip`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `persona_tipo`
--

LOCK TABLES `persona_tipo` WRITE;
/*!40000 ALTER TABLE `persona_tipo` DISABLE KEYS */;
INSERT INTO `persona_tipo` VALUES (1,'Cliente'),(2,'Provedor'),(3,'Cliente / Provedor');
/*!40000 ALTER TABLE `persona_tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `persona_tipo_identificacion`
--

DROP TABLE IF EXISTS `persona_tipo_identificacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `persona_tipo_identificacion` (
  `Id_PerTipId` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion_PerTipId` varchar(100) NOT NULL,
  `Codigo_PerTipId` char(5) DEFAULT NULL,
  PRIMARY KEY (`Id_PerTipId`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `persona_tipo_identificacion`
--

LOCK TABLES `persona_tipo_identificacion` WRITE;
/*!40000 ALTER TABLE `persona_tipo_identificacion` DISABLE KEYS */;
INSERT INTO `persona_tipo_identificacion` VALUES (1,'Certificado de nacido vivo','CN'),(2,'Registro civil de nacimiento','RC'),(3,'Tarjeta de Identidad','TI'),(4,'Cédula de Cuidadanía','CC'),(5,'Cédula de Extrangería','CE'),(6,'Pasaporte','PA'),(7,'Carnet diplomático','CD'),(8,'Salvoconducto de permanencia','SC');
/*!40000 ALTER TABLE `persona_tipo_identificacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `precios_item`
--

DROP TABLE IF EXISTS `precios_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `precios_item` (
  `Id_ListPre` int(11) NOT NULL,
  `Id_Ite` int(11) NOT NULL,
  `PrecioVenta` double DEFAULT NULL,
  `Primary_Usu` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_ListPre`,`Id_Ite`) USING BTREE,
  KEY `fk_lista_precios_has_items_items1_idx` (`Id_Ite`) USING BTREE,
  KEY `fk_lista_precios_has_items_lista_precios1_idx` (`Id_ListPre`) USING BTREE,
  CONSTRAINT `fk_lista_precios_has_items_items1` FOREIGN KEY (`Id_Ite`) REFERENCES `items` (`Id_Ite`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lista_precios_has_items_lista_precios1` FOREIGN KEY (`Id_ListPre`) REFERENCES `lista_precios` (`Id_ListPre`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `precios_item`
--

LOCK TABLES `precios_item` WRITE;
/*!40000 ALTER TABLE `precios_item` DISABLE KEYS */;
INSERT INTO `precios_item` VALUES (1,5,5000000,7),(1,7,1200000,7),(1,9,25000000,7),(2,5,450000,7),(2,9,2000000,7),(3,1,132000,1),(3,4,45000,1),(3,10,1500,1),(4,2,100000,1),(4,3,50000,1),(4,4,50000,1),(4,6,25000,1),(4,10,1400,1),(5,4,4700,1),(5,10,1350,1);
/*!40000 ALTER TABLE `precios_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `retencion_detalle_estado`
--

DROP TABLE IF EXISTS `retencion_detalle_estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `retencion_detalle_estado` (
  `Id_RetDetEst` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_RetDetEst` varchar(75) NOT NULL,
  PRIMARY KEY (`Id_RetDetEst`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `retencion_detalle_estado`
--

LOCK TABLES `retencion_detalle_estado` WRITE;
/*!40000 ALTER TABLE `retencion_detalle_estado` DISABLE KEYS */;
/*!40000 ALTER TABLE `retencion_detalle_estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `retencion_tipo`
--

DROP TABLE IF EXISTS `retencion_tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `retencion_tipo` (
  `Id_RetTip` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_RetTip` varchar(100) NOT NULL,
  PRIMARY KEY (`Id_RetTip`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `retencion_tipo`
--

LOCK TABLES `retencion_tipo` WRITE;
/*!40000 ALTER TABLE `retencion_tipo` DISABLE KEYS */;
/*!40000 ALTER TABLE `retencion_tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `retenciones`
--

DROP TABLE IF EXISTS `retenciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `retenciones` (
  `Id_Ret` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_Ret` varchar(500) NOT NULL,
  `Porcentaje_Ret` double DEFAULT NULL,
  `Descripcion_Ret` text DEFAULT NULL,
  `FechaRegistro_Ret` timestamp NULL DEFAULT current_timestamp(),
  `Estado_Ret` enum('Activo','Inactivo') DEFAULT 'Activo',
  `Id_RetTip` int(11) DEFAULT NULL COMMENT 'Tipo retencion',
  `Id_Cue_Ventas` int(11) DEFAULT NULL COMMENT 'Cuenta para retenciones a favor',
  `Id_Cue_Compras` int(11) DEFAULT NULL COMMENT 'Cuentas para retencciones por pagar',
  `Primary_Usu` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_Ret`) USING BTREE,
  KEY `fk_retenciones_retencion_tipo1_idx` (`Id_RetTip`) USING BTREE,
  KEY `fk_retenciones_cuentas1_idx` (`Id_Cue_Ventas`) USING BTREE,
  KEY `fk_retenciones_cuentas2_idx` (`Id_Cue_Compras`) USING BTREE,
  CONSTRAINT `fk_retenciones_cuentas1` FOREIGN KEY (`Id_Cue_Ventas`) REFERENCES `cuentas` (`Id_Cue`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_retenciones_cuentas2` FOREIGN KEY (`Id_Cue_Compras`) REFERENCES `cuentas` (`Id_Cue`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_retenciones_retencion_tipo1` FOREIGN KEY (`Id_RetTip`) REFERENCES `retencion_tipo` (`Id_RetTip`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `retenciones`
--

LOCK TABLES `retenciones` WRITE;
/*!40000 ALTER TABLE `retenciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `retenciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `retenciones_detalle`
--

DROP TABLE IF EXISTS `retenciones_detalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `retenciones_detalle` (
  `Id_RetDet` int(11) NOT NULL AUTO_INCREMENT,
  `Id_Ret` int(11) DEFAULT NULL,
  `Id_TranDet` int(11) DEFAULT NULL,
  `Base_RetDet` double DEFAULT NULL,
  `ValorRetenido_RetDet` double DEFAULT NULL,
  `Id_RetDetEst` int(11) DEFAULT NULL,
  `Id_Doc` int(11) DEFAULT NULL COMMENT 'Unicamente para retenciones de documentos de egreso',
  `FactorMovimiento` int(11) DEFAULT NULL,
  `Primary_Usu` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_RetDet`) USING BTREE,
  KEY `fk_retenciones_has_transaccion_detalle_transaccion_detalle1_idx` (`Id_TranDet`) USING BTREE,
  KEY `fk_retenciones_has_transaccion_detalle_retenciones1_idx` (`Id_Ret`) USING BTREE,
  KEY `fk_retenciones_detalle_retencion_detalle_estado1_idx` (`Id_RetDetEst`) USING BTREE,
  KEY `fk_retenciones_detalle_documento1_idx` (`Id_Doc`) USING BTREE,
  CONSTRAINT `fk_retenciones_detalle_documento1` FOREIGN KEY (`Id_Doc`) REFERENCES `documento` (`Id_Doc`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_retenciones_detalle_retencion_detalle_estado1` FOREIGN KEY (`Id_RetDetEst`) REFERENCES `retencion_detalle_estado` (`Id_RetDetEst`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_retenciones_has_transaccion_detalle_retenciones1` FOREIGN KEY (`Id_Ret`) REFERENCES `retenciones` (`Id_Ret`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_retenciones_has_transaccion_detalle_transaccion_detalle1` FOREIGN KEY (`Id_TranDet`) REFERENCES `transaccion_detalle` (`Id_TranDet`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `retenciones_detalle`
--

LOCK TABLES `retenciones_detalle` WRITE;
/*!40000 ALTER TABLE `retenciones_detalle` DISABLE KEYS */;
/*!40000 ALTER TABLE `retenciones_detalle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `Id_Rol` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion_Rol` varchar(150) DEFAULT NULL,
  `Primary_Usu` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_Rol`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'administrador',NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles_permiso`
--

DROP TABLE IF EXISTS `roles_permiso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles_permiso` (
  `Id_RolPerm` int(11) NOT NULL AUTO_INCREMENT,
  `Id_Rol` int(11) NOT NULL,
  `Id_Perm` int(11) NOT NULL,
  `Editar` char(2) DEFAULT NULL,
  `Crear` char(2) DEFAULT NULL,
  `Ver` char(2) DEFAULT NULL,
  `Listar` char(2) DEFAULT NULL,
  `Primary_Usu` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_RolPerm`,`Id_Rol`,`Id_Perm`) USING BTREE,
  KEY `fk_roles_has_permiso_permiso1_idx` (`Id_Perm`) USING BTREE,
  KEY `fk_roles_has_permiso_roles1_idx` (`Id_Rol`) USING BTREE,
  CONSTRAINT `fk_roles_has_permiso_permiso1` FOREIGN KEY (`Id_Perm`) REFERENCES `permiso` (`Id_Perm`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_roles_has_permiso_roles1` FOREIGN KEY (`Id_Rol`) REFERENCES `roles` (`Id_Rol`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles_permiso`
--

LOCK TABLES `roles_permiso` WRITE;
/*!40000 ALTER TABLE `roles_permiso` DISABLE KEYS */;
/*!40000 ALTER TABLE `roles_permiso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `termino_pago`
--

DROP TABLE IF EXISTS `termino_pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `termino_pago` (
  `Id_TerPag` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Registro para los datos de terminos de pago',
  `Nombre_TerPag` varchar(255) DEFAULT NULL,
  `Dias_TerPag` int(11) DEFAULT NULL,
  `Estado_TerPag` enum('Activo','Inactivo') DEFAULT 'Activo',
  `FechaRegistro_TerPag` datetime DEFAULT current_timestamp(),
  `Primary_Usu` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_TerPag`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `termino_pago`
--

LOCK TABLES `termino_pago` WRITE;
/*!40000 ALTER TABLE `termino_pago` DISABLE KEYS */;
INSERT INTO `termino_pago` VALUES (1,'Contado',0,'Activo','2020-03-24 19:00:53',7),(2,'Contado',0,'Activo','2020-03-31 20:57:35',1),(3,'15 días',15,'Activo','2020-04-01 21:04:50',7),(4,'15 días',15,'Activo','2020-04-11 20:04:49',1),(5,'1 mes',30,'Activo','2020-04-11 20:04:22',1);
/*!40000 ALTER TABLE `termino_pago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_cuenta_banco`
--

DROP TABLE IF EXISTS `tipo_cuenta_banco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_cuenta_banco` (
  `Id_TipCueBan` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_TipCueBan` varchar(100) NOT NULL,
  PRIMARY KEY (`Id_TipCueBan`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_cuenta_banco`
--

LOCK TABLES `tipo_cuenta_banco` WRITE;
/*!40000 ALTER TABLE `tipo_cuenta_banco` DISABLE KEYS */;
INSERT INTO `tipo_cuenta_banco` VALUES (1,'Crédito'),(2,'Débito');
/*!40000 ALTER TABLE `tipo_cuenta_banco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaccion_detalle`
--

DROP TABLE IF EXISTS `transaccion_detalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaccion_detalle` (
  `Id_TranDet` int(11) NOT NULL AUTO_INCREMENT,
  `Valor_TranDet` double DEFAULT NULL,
  `Cantidad_TranDet` int(11) DEFAULT NULL,
  `Observaciones_TranDet` text DEFAULT NULL,
  `Id_Tran` int(11) DEFAULT NULL COMMENT 'Maestro transaccion',
  `Id_Cue` int(11) DEFAULT NULL COMMENT 'Cuenta de la transaccion',
  `Id_Doc` int(11) DEFAULT NULL COMMENT 'Documento si esta activo',
  `Id_Imp` int(11) DEFAULT NULL,
  `Id_TranDetTip` int(11) DEFAULT NULL,
  `Id_TranDetEst` int(11) DEFAULT NULL COMMENT 'Estado',
  `FactorMoviemiento` tinyint(4) DEFAULT NULL,
  `Primary_Usu` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_TranDet`) USING BTREE,
  KEY `fk_transaccion_detalle_transacciones1_idx` (`Id_Tran`) USING BTREE,
  KEY `fk_transaccion_detalle_documento1_idx` (`Id_Doc`) USING BTREE,
  KEY `fk_transaccion_detalle_transaccion_detalle_estado1_idx` (`Id_TranDetEst`) USING BTREE,
  KEY `fk_transaccion_detalle_transaccion_detalle_tipo1_idx` (`Id_TranDetTip`) USING BTREE,
  KEY `fk_transaccion_detalle_cuentas1_idx` (`Id_Cue`) USING BTREE,
  KEY `fk_transaccion_detalle_impuestos1_idx` (`Id_Imp`) USING BTREE,
  CONSTRAINT `fk_transaccion_detalle_cuentas1` FOREIGN KEY (`Id_Cue`) REFERENCES `cuentas` (`Id_Cue`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_transaccion_detalle_documento1` FOREIGN KEY (`Id_Doc`) REFERENCES `documento` (`Id_Doc`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_transaccion_detalle_impuestos1` FOREIGN KEY (`Id_Imp`) REFERENCES `impuestos` (`Id_Imp`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_transaccion_detalle_transaccion_detalle_estado1` FOREIGN KEY (`Id_TranDetEst`) REFERENCES `transaccion_detalle_estado` (`Id_TranDetEst`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_transaccion_detalle_transaccion_detalle_tipo1` FOREIGN KEY (`Id_TranDetTip`) REFERENCES `transaccion_detalle_tipo` (`Id_TranDetTip`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_transaccion_detalle_transacciones1` FOREIGN KEY (`Id_Tran`) REFERENCES `transacciones` (`Id_Tran`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaccion_detalle`
--

LOCK TABLES `transaccion_detalle` WRITE;
/*!40000 ALTER TABLE `transaccion_detalle` DISABLE KEYS */;
INSERT INTO `transaccion_detalle` VALUES (6,2295299.95,1,NULL,6,NULL,22,NULL,1,1,1,1),(7,2295299.95,1,NULL,7,NULL,22,NULL,1,1,1,1),(8,1750000,1,'pago factura',8,NULL,15,NULL,1,1,1,1),(9,225000,1,NULL,9,NULL,13,NULL,2,1,-1,1),(10,828000,1,NULL,10,304,NULL,NULL,2,1,-1,1),(11,113050,1,'Pago de factura',11,NULL,29,NULL,1,1,1,1),(12,277200,1,NULL,12,NULL,26,NULL,1,1,1,1),(13,1370260,1,NULL,13,NULL,24,NULL,1,1,1,1),(14,609750,1,NULL,14,NULL,6,NULL,2,1,-1,1),(15,815800,1,'Pago cotización',15,NULL,40,NULL,6,1,-1,1),(16,2692750,1,NULL,16,NULL,39,NULL,6,1,-1,1),(17,693000,1,NULL,17,NULL,43,NULL,7,1,-1,1),(18,111600,1,NULL,18,NULL,35,NULL,2,1,0,1),(19,810000,1,NULL,19,NULL,42,NULL,1,1,0,1),(20,100000,1,NULL,20,4,NULL,NULL,1,1,1,1),(21,250000,1,NULL,20,17,NULL,NULL,1,1,1,1),(22,50000000,1,NULL,20,50,NULL,NULL,1,1,1,1),(23,45000000,1,NULL,20,223,NULL,NULL,1,1,1,1);
/*!40000 ALTER TABLE `transaccion_detalle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaccion_detalle_estado`
--

DROP TABLE IF EXISTS `transaccion_detalle_estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaccion_detalle_estado` (
  `Id_TranDetEst` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_TranDetEst` varchar(100) NOT NULL,
  PRIMARY KEY (`Id_TranDetEst`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaccion_detalle_estado`
--

LOCK TABLES `transaccion_detalle_estado` WRITE;
/*!40000 ALTER TABLE `transaccion_detalle_estado` DISABLE KEYS */;
INSERT INTO `transaccion_detalle_estado` VALUES (1,'Activo'),(2,'Inactivo');
/*!40000 ALTER TABLE `transaccion_detalle_estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaccion_detalle_tipo`
--

DROP TABLE IF EXISTS `transaccion_detalle_tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaccion_detalle_tipo` (
  `Id_TranDetTip` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_TranDetTip` varchar(100) NOT NULL,
  PRIMARY KEY (`Id_TranDetTip`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaccion_detalle_tipo`
--

LOCK TABLES `transaccion_detalle_tipo` WRITE;
/*!40000 ALTER TABLE `transaccion_detalle_tipo` DISABLE KEYS */;
INSERT INTO `transaccion_detalle_tipo` VALUES (1,'Factura de venta'),(2,'Factura de compra'),(3,'Nota débito'),(4,'Nota crédito'),(5,'Remisión'),(6,'Cotización'),(7,'Órden de compra'),(8,'Comprobante de ingreso'),(9,'Comprobante de egreso');
/*!40000 ALTER TABLE `transaccion_detalle_tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaccion_estado`
--

DROP TABLE IF EXISTS `transaccion_estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaccion_estado` (
  `Id_TranEst` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_TranEst` varchar(100) NOT NULL,
  PRIMARY KEY (`Id_TranEst`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaccion_estado`
--

LOCK TABLES `transaccion_estado` WRITE;
/*!40000 ALTER TABLE `transaccion_estado` DISABLE KEYS */;
INSERT INTO `transaccion_estado` VALUES (1,'Activo'),(2,'Inactivo'),(3,'Anulado'),(4,'Cancelado'),(5,'Pagado');
/*!40000 ALTER TABLE `transaccion_estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaccion_tipo`
--

DROP TABLE IF EXISTS `transaccion_tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaccion_tipo` (
  `Id_TranTip` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_TranTip` varchar(100) NOT NULL,
  PRIMARY KEY (`Id_TranTip`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaccion_tipo`
--

LOCK TABLES `transaccion_tipo` WRITE;
/*!40000 ALTER TABLE `transaccion_tipo` DISABLE KEYS */;
INSERT INTO `transaccion_tipo` VALUES (1,'Ingreso'),(2,'Egreso'),(3,'Nota débito'),(4,'Nota crédito'),(5,'Remisión'),(6,'Cotización'),(7,'Órden de compra'),(8,'Comprobante de ingreso'),(9,'Comprobante de egreso');
/*!40000 ALTER TABLE `transaccion_tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transacciones`
--

DROP TABLE IF EXISTS `transacciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transacciones` (
  `Id_Tran` int(11) NOT NULL AUTO_INCREMENT,
  `Numero_Tran` varchar(100) NOT NULL COMMENT 'Consecutivo autoincremental de transaccion',
  `Fecha_Tran` datetime DEFAULT NULL,
  `NotaVisible_Tran` text DEFAULT NULL,
  `DocumentoAsociado_Tran` tinyint(4) DEFAULT NULL COMMENT 'Valor si esta asociados a documentos',
  `FechaRegistro_Tran` datetime DEFAULT current_timestamp(),
  `Id_TranTip` int(11) DEFAULT NULL COMMENT 'Tipo de transaccion',
  `Id_TranEst` int(11) DEFAULT NULL COMMENT 'Estado de la transaccion',
  `Id_Ban` int(11) DEFAULT NULL COMMENT 'Banco de transaccion',
  `Id_Usu` int(11) DEFAULT NULL COMMENT 'Usuario que registra la transaccion',
  `Id_Per` int(11) DEFAULT NULL COMMENT 'A quien se le dirije la transaccion',
  `Id_Tran_TransaccionParcial` int(11) DEFAULT NULL COMMENT 'Para transacciones parciales sumar todas las transacciones asociadas a la transaccion padre',
  `Primary_Usu` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_Tran`) USING BTREE,
  KEY `fk_transacciones_transaccion_tipo1_idx` (`Id_TranTip`) USING BTREE,
  KEY `fk_transacciones_transaccion_estado1_idx` (`Id_TranEst`) USING BTREE,
  KEY `fk_transacciones_bancos1_idx` (`Id_Ban`) USING BTREE,
  KEY `fk_transacciones_usuario1_idx` (`Id_Usu`) USING BTREE,
  KEY `fk_transacciones_persona1_idx` (`Id_Per`) USING BTREE,
  KEY `fk_transacciones_transacciones1_idx` (`Id_Tran_TransaccionParcial`) USING BTREE,
  CONSTRAINT `fk_transacciones_bancos1` FOREIGN KEY (`Id_Ban`) REFERENCES `bancos` (`Id_Ban`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_transacciones_persona1` FOREIGN KEY (`Id_Per`) REFERENCES `persona` (`Id_Per`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_transacciones_transaccion_estado1` FOREIGN KEY (`Id_TranEst`) REFERENCES `transaccion_estado` (`Id_TranEst`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_transacciones_transaccion_tipo1` FOREIGN KEY (`Id_TranTip`) REFERENCES `transaccion_tipo` (`Id_TranTip`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_transacciones_transacciones1` FOREIGN KEY (`Id_Tran_TransaccionParcial`) REFERENCES `transacciones` (`Id_Tran`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_transacciones_usuario1` FOREIGN KEY (`Id_Usu`) REFERENCES `usuario` (`Id_Usu`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transacciones`
--

LOCK TABLES `transacciones` WRITE;
/*!40000 ALTER TABLE `transacciones` DISABLE KEYS */;
INSERT INTO `transacciones` VALUES (1,'TR-01','2020-05-08 00:00:00','Pago factura de ingreso',1,'2020-05-08 15:05:16',1,5,1,1,1,NULL,1),(2,'TR-01','2020-05-08 00:00:00','Pago factura de ingreso',1,'2020-05-08 16:05:26',1,5,1,1,1,NULL,1),(6,'PAG-01','2020-05-08 00:00:00',NULL,1,'2020-05-08 16:05:27',1,5,1,1,1,NULL,1),(7,'PAG-01','2020-05-08 00:00:00',NULL,1,'2020-05-08 16:05:18',1,5,1,1,1,NULL,1),(8,'PAG-02','2020-05-09 00:00:00','Pago de factura FV-1',1,'2020-05-09 17:05:06',1,5,1,1,1,NULL,1),(9,'PS-1','2020-05-09 00:00:00',NULL,1,'2020-05-09 20:05:04',2,5,1,1,2,NULL,1),(10,'PAG-03','2020-05-15 00:00:00',NULL,NULL,'2020-05-15 18:05:52',2,5,1,1,2,NULL,1),(11,'ASOS-01','2020-06-29 00:00:00',NULL,1,'2020-06-29 17:06:19',1,5,1,1,1,NULL,1),(12,'Automático','2020-07-02 00:00:00',NULL,1,'2020-07-02 22:07:45',1,5,1,1,7,NULL,1),(13,'1','2020-07-02 00:00:00',NULL,1,'2020-07-02 22:07:55',1,5,1,1,7,NULL,1),(14,'1','2020-07-02 00:00:00',NULL,1,'2020-07-02 22:07:31',2,5,1,1,1,NULL,1),(15,'4','2020-07-04 00:00:00',NULL,1,'2020-07-04 18:07:01',6,5,1,1,7,NULL,1),(16,'5','2020-07-04 00:00:00',NULL,1,'2020-07-04 21:07:31',6,5,2,1,7,NULL,1),(17,'4','2020-07-05 00:00:00',NULL,1,'2020-07-05 21:07:31',7,5,1,1,1,NULL,1),(18,'1','2020-07-07 00:00:00',NULL,1,'2020-07-07 18:07:53',8,5,1,1,7,NULL,1),(19,'1','2020-07-11 00:00:00','Ordén de compra redireccionamiento',1,'2020-07-11 15:07:13',9,5,2,1,7,NULL,1),(20,'2','2020-08-02 00:00:00',NULL,NULL,'2020-08-02 17:08:56',8,5,1,1,2,NULL,1);
/*!40000 ALTER TABLE `transacciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `Id_Usu` int(11) NOT NULL AUTO_INCREMENT,
  `Usuario_Usu` varchar(255) NOT NULL,
  `Contrasena_Usu` text NOT NULL,
  `UltimoAcceso_Usu` datetime DEFAULT NULL,
  `UltimaContrasena_Usu` text DEFAULT NULL,
  `KeyPago_Usu` double DEFAULT NULL,
  `Email_Usu` varchar(255) DEFAULT NULL,
  `KeyRecoverPassword_Usu` text DEFAULT NULL,
  `FechaRegistro_Usu` datetime DEFAULT current_timestamp(),
  `Primary_Usu` int(11) DEFAULT NULL,
  `Id_Per` int(11) DEFAULT NULL,
  `Id_UsuEst` int(11) DEFAULT NULL,
  `Id_Rol` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_Usu`) USING BTREE,
  KEY `fk_usuario_persona_idx` (`Id_Per`) USING BTREE,
  KEY `fk_usuario_usuario_estado1_idx` (`Id_UsuEst`) USING BTREE,
  KEY `fk_usuario_roles1_idx` (`Id_Rol`) USING BTREE,
  CONSTRAINT `fk_usuario_persona` FOREIGN KEY (`Id_Per`) REFERENCES `persona` (`Id_Per`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_roles1` FOREIGN KEY (`Id_Rol`) REFERENCES `roles` (`Id_Rol`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_usuario_estado1` FOREIGN KEY (`Id_UsuEst`) REFERENCES `usuario_estado` (`Id_UsuEst`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'maicolander','$2y$04$yeEGSpTCLXeB3QLADKFynuqI7EkcTj3AfiFiV0q7jkjQBdxJquDCG','2020-08-18 21:08:06','$2y$04$ixN8mgFcgXM5MhBa7WbQtuHPV/y13jEAcdXowUxWfoFAelbxbmcdi',NULL,'ander.misak@gmail.com',NULL,'2020-03-23 16:50:04',1,1,1,1),(7,'maicol','$2y$04$yeEGSpTCLXeB3QLADKFynuqI7EkcTj3AfiFiV0q7jkjQBdxJquDCG','2020-05-02 16:05:50',NULL,NULL,'vikynr@gmail.com',NULL,'2020-03-26 16:03:58',7,5,1,1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_estado`
--

DROP TABLE IF EXISTS `usuario_estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_estado` (
  `Id_UsuEst` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion_UsuEst` varchar(90) DEFAULT NULL,
  PRIMARY KEY (`Id_UsuEst`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_estado`
--

LOCK TABLES `usuario_estado` WRITE;
/*!40000 ALTER TABLE `usuario_estado` DISABLE KEYS */;
INSERT INTO `usuario_estado` VALUES (1,'Activo'),(2,'Inactivo');
/*!40000 ALTER TABLE `usuario_estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `vw_documento`
--

DROP TABLE IF EXISTS `vw_documento`;
/*!50001 DROP VIEW IF EXISTS `vw_documento`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_documento` (
  `Id_Doc` tinyint NOT NULL,
  `Contacto` tinyint NOT NULL,
  `Identificacion_Per` tinyint NOT NULL,
  `FechaRegistro_Doc` tinyint NOT NULL,
  `Numero_Doc` tinyint NOT NULL,
  `FechaDocumento_Doc` tinyint NOT NULL,
  `FechaVencimiento_Doc` tinyint NOT NULL,
  `Observacion_Doc` tinyint NOT NULL,
  `IvaIncluido_Doc` tinyint NOT NULL,
  `Usuario_Usu` tinyint NOT NULL,
  `Nombre_DocTip` tinyint NOT NULL,
  `Nombre_DocEst` tinyint NOT NULL,
  `Nombre_TerPag` tinyint NOT NULL,
  `Dias_TerPag` tinyint NOT NULL,
  `Id_Per` tinyint NOT NULL,
  `Id_Usu` tinyint NOT NULL,
  `Id_DocTip` tinyint NOT NULL,
  `Id_DocEst` tinyint NOT NULL,
  `Id_TerPag` tinyint NOT NULL,
  `Primary_Usu` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_items`
--

DROP TABLE IF EXISTS `vw_items`;
/*!50001 DROP VIEW IF EXISTS `vw_items`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_items` (
  `Id_Ite` tinyint NOT NULL,
  `Nombre_Ite` tinyint NOT NULL,
  `Referencia_Ite` tinyint NOT NULL,
  `Serie_Ite` tinyint NOT NULL,
  `FechaRegistro_Ite` tinyint NOT NULL,
  `Inventariable_Ite` tinyint NOT NULL,
  `Observacion_Ite` tinyint NOT NULL,
  `Imagen_Item` tinyint NOT NULL,
  `Primary_Usu` tinyint NOT NULL,
  `Nombre_CatIte` tinyint NOT NULL,
  `Nombre_Mar` tinyint NOT NULL,
  `Nombre_Med` tinyint NOT NULL,
  `Valor_Med` tinyint NOT NULL,
  `Nombre_IteTip` tinyint NOT NULL,
  `Nombre_IteEst` tinyint NOT NULL,
  `Nombre_Bod` tinyint NOT NULL,
  `Id_CatIte` tinyint NOT NULL,
  `Id_Mar` tinyint NOT NULL,
  `Id_Med` tinyint NOT NULL,
  `Id_Usu` tinyint NOT NULL,
  `Id_IteTip` tinyint NOT NULL,
  `Id_IteEst` tinyint NOT NULL,
  `Id_Bod` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_kardex`
--

DROP TABLE IF EXISTS `vw_kardex`;
/*!50001 DROP VIEW IF EXISTS `vw_kardex`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_kardex` (
  `Id_kar` tinyint NOT NULL,
  `Cantidad_Kar` tinyint NOT NULL,
  `Costo_Kar` tinyint NOT NULL,
  `Descuento_Kar` tinyint NOT NULL,
  `Aceptado_Kar` tinyint NOT NULL,
  `Observacion_Kar` tinyint NOT NULL,
  `FactorMovimiento_Kar` tinyint NOT NULL,
  `Nombre_Ite` tinyint NOT NULL,
  `Nombre_Med` tinyint NOT NULL,
  `Nombre_Bod` tinyint NOT NULL,
  `Nombre_KarTip` tinyint NOT NULL,
  `Nombre_KarEst` tinyint NOT NULL,
  `Unidad_Med` tinyint NOT NULL,
  `subtotal` tinyint NOT NULL,
  `descuento` tinyint NOT NULL,
  `impuestos` tinyint NOT NULL,
  `total` tinyint NOT NULL,
  `Id_Doc` tinyint NOT NULL,
  `Id_Ite` tinyint NOT NULL,
  `Id_Med` tinyint NOT NULL,
  `Id_Bod` tinyint NOT NULL,
  `Id_KarTip` tinyint NOT NULL,
  `Id_KarEst` tinyint NOT NULL,
  `Primary_Usu` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_persona`
--

DROP TABLE IF EXISTS `vw_persona`;
/*!50001 DROP VIEW IF EXISTS `vw_persona`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_persona` (
  `Id_Per` tinyint NOT NULL,
  `Identificacion_Per` tinyint NOT NULL,
  `Nombre1_Per` tinyint NOT NULL,
  `Nombre2_Per` tinyint NOT NULL,
  `Apeliido1_Per` tinyint NOT NULL,
  `Apellido2_Per` tinyint NOT NULL,
  `TelCelular_Per` tinyint NOT NULL,
  `Correo_Per` tinyint NOT NULL,
  `Nombre_Num` tinyint NOT NULL,
  `Estado_PerEst` tinyint NOT NULL,
  `Descripcion_PerTip` tinyint NOT NULL,
  `Descripcion_PerTipId` tinyint NOT NULL,
  `Codigo_PerTipId` tinyint NOT NULL,
  `FechaNacimiento_Per` tinyint NOT NULL,
  `Nombre_Dep` tinyint NOT NULL,
  `Descripcion_PerGen` tinyint NOT NULL,
  `Codigo_PerGen` tinyint NOT NULL,
  `Id_PerTipId` tinyint NOT NULL,
  `Id_PerGen` tinyint NOT NULL,
  `Id_Mun` tinyint NOT NULL,
  `Id_PerEst` tinyint NOT NULL,
  `Id_PerTip` tinyint NOT NULL,
  `Telefono_Per` tinyint NOT NULL,
  `FechaRegistro_Per` tinyint NOT NULL,
  `Celular_Per` tinyint NOT NULL,
  `Direccion_Per` tinyint NOT NULL,
  `Nombre_Emp` tinyint NOT NULL,
  `Primary_Usu` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_transacciones`
--

DROP TABLE IF EXISTS `vw_transacciones`;
/*!50001 DROP VIEW IF EXISTS `vw_transacciones`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_transacciones` (
  `Id_Tran` tinyint NOT NULL,
  `Numero_Tran` tinyint NOT NULL,
  `Fecha_Tran` tinyint NOT NULL,
  `NotaVisible_Tran` tinyint NOT NULL,
  `DocumentoAsociado_Tran` tinyint NOT NULL,
  `FechaRegistro_Tran` tinyint NOT NULL,
  `Primary_Usu` tinyint NOT NULL,
  `Nombre_TranTip` tinyint NOT NULL,
  `Nombre_TranEst` tinyint NOT NULL,
  `NombreCuenta_Ban` tinyint NOT NULL,
  `NumeroCuenta_Ban` tinyint NOT NULL,
  `Usuario_Usu` tinyint NOT NULL,
  `Contacto` tinyint NOT NULL,
  `Identificacion_Per` tinyint NOT NULL,
  `Id_TranTip` tinyint NOT NULL,
  `Id_TranEst` tinyint NOT NULL,
  `Id_Ban` tinyint NOT NULL,
  `Id_Usu` tinyint NOT NULL,
  `Id_Per` tinyint NOT NULL,
  `Id_Tran_TransaccionParcial` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_usuario`
--

DROP TABLE IF EXISTS `vw_usuario`;
/*!50001 DROP VIEW IF EXISTS `vw_usuario`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_usuario` (
  `Id_Usu` tinyint NOT NULL,
  `nombres` tinyint NOT NULL,
  `Email_Usu` tinyint NOT NULL,
  `UltimoAcceso_Usu` tinyint NOT NULL,
  `UltimaContrasena_Usu` tinyint NOT NULL,
  `KeyPago_Usu` tinyint NOT NULL,
  `Descripcion_UsuEst` tinyint NOT NULL,
  `Descripcion_Rol` tinyint NOT NULL,
  `Primary_Usu` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Dumping events for database 'margunsoft_financia_v2'
--

--
-- Dumping routines for database 'margunsoft_financia_v2'
--

--
-- Final view structure for view `vw_documento`
--

/*!50001 DROP TABLE IF EXISTS `vw_documento`*/;
/*!50001 DROP VIEW IF EXISTS `vw_documento`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_documento` AS select `documento`.`Id_Doc` AS `Id_Doc`,concat(coalesce(`persona`.`Nombre1_Per`,''),' ',coalesce(`persona`.`Nombre2_Per`,''),' ',coalesce(`persona`.`Apeliido1_Per`,''),' ',coalesce(`persona`.`Apellido2_Per`,'')) AS `Contacto`,`persona`.`Identificacion_Per` AS `Identificacion_Per`,`documento`.`FechaRegistro_Doc` AS `FechaRegistro_Doc`,`documento`.`Numero_Doc` AS `Numero_Doc`,`documento`.`FechaDocumento_Doc` AS `FechaDocumento_Doc`,`documento`.`FechaVencimiento_Doc` AS `FechaVencimiento_Doc`,`documento`.`Observacion_Doc` AS `Observacion_Doc`,`documento`.`IvaIncluido_Doc` AS `IvaIncluido_Doc`,`usuario`.`Usuario_Usu` AS `Usuario_Usu`,`documento_tipo`.`Nombre_DocTip` AS `Nombre_DocTip`,`documento_estado`.`Nombre_DocEst` AS `Nombre_DocEst`,`termino_pago`.`Nombre_TerPag` AS `Nombre_TerPag`,`termino_pago`.`Dias_TerPag` AS `Dias_TerPag`,`documento`.`Id_Per` AS `Id_Per`,`documento`.`Id_Usu` AS `Id_Usu`,`documento`.`Id_DocTip` AS `Id_DocTip`,`documento`.`Id_DocEst` AS `Id_DocEst`,`documento`.`Id_TerPag` AS `Id_TerPag`,`documento`.`Primary_Usu` AS `Primary_Usu` from (((((`documento` join `persona` on(`documento`.`Id_Per` = `persona`.`Id_Per`)) join `usuario` on(`documento`.`Id_Usu` = `usuario`.`Id_Usu`)) join `documento_tipo` on(`documento`.`Id_DocTip` = `documento_tipo`.`Id_DocTip`)) join `documento_estado` on(`documento`.`Id_DocEst` = `documento_estado`.`Id_DocEst`)) left join `termino_pago` on(`documento`.`Id_TerPag` = `termino_pago`.`Id_TerPag`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_items`
--

/*!50001 DROP TABLE IF EXISTS `vw_items`*/;
/*!50001 DROP VIEW IF EXISTS `vw_items`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_items` AS select `items`.`Id_Ite` AS `Id_Ite`,`items`.`Nombre_Ite` AS `Nombre_Ite`,`items`.`Referencia_Ite` AS `Referencia_Ite`,`items`.`Serie_Ite` AS `Serie_Ite`,`items`.`FechaRegistro_Ite` AS `FechaRegistro_Ite`,`items`.`Inventariable_Ite` AS `Inventariable_Ite`,`items`.`Observacion_Ite` AS `Observacion_Ite`,`items`.`Imagen_Item` AS `Imagen_Item`,`items`.`Primary_Usu` AS `Primary_Usu`,`categoria_item`.`Nombre_CatIte` AS `Nombre_CatIte`,`marcas`.`Nombre_Mar` AS `Nombre_Mar`,`medidas`.`Nombre_Med` AS `Nombre_Med`,`medidas`.`Valor_Med` AS `Valor_Med`,`item_tipo`.`Nombre_IteTip` AS `Nombre_IteTip`,`item_estado`.`Nombre_IteEst` AS `Nombre_IteEst`,`bodegas`.`Nombre_Bod` AS `Nombre_Bod`,`items`.`Id_CatIte` AS `Id_CatIte`,`items`.`Id_Mar` AS `Id_Mar`,`items`.`Id_Med` AS `Id_Med`,`items`.`Id_Usu` AS `Id_Usu`,`items`.`Id_IteTip` AS `Id_IteTip`,`items`.`Id_IteEst` AS `Id_IteEst`,`items`.`Id_Bod` AS `Id_Bod` from ((((((`items` left join `categoria_item` on(`items`.`Id_CatIte` = `categoria_item`.`Id_CatIte`)) left join `marcas` on(`items`.`Id_Mar` = `marcas`.`Id_Mar`)) left join `medidas` on(`items`.`Id_Med` = `medidas`.`Id_Med`)) left join `item_tipo` on(`items`.`Id_IteTip` = `item_tipo`.`Id_IteTip`)) left join `item_estado` on(`items`.`Id_IteEst` = `item_estado`.`Id_IteEst`)) left join `bodegas` on(`items`.`Id_Bod` = `bodegas`.`Id_Bod`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_kardex`
--

/*!50001 DROP TABLE IF EXISTS `vw_kardex`*/;
/*!50001 DROP VIEW IF EXISTS `vw_kardex`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_kardex` AS select `kardex`.`Id_kar` AS `Id_kar`,`kardex`.`Cantidad_Kar` AS `Cantidad_Kar`,`kardex`.`Costo_Kar` AS `Costo_Kar`,`kardex`.`Descuento_Kar` AS `Descuento_Kar`,`kardex`.`Aceptado_Kar` AS `Aceptado_Kar`,`kardex`.`Observacion_Kar` AS `Observacion_Kar`,`kardex`.`FactorMovimiento_Kar` AS `FactorMovimiento_Kar`,`items`.`Nombre_Ite` AS `Nombre_Ite`,concat(`medidas`.`Nombre_Med`,' (',`medidas`.`Valor_Med`,')') AS `Nombre_Med`,concat(`bodegas`.`Nombre_Bod`,' (',coalesce(`bodegas`.`Codigo_Bod`,''),')') AS `Nombre_Bod`,`kardex_tipo`.`Nombre_KarTip` AS `Nombre_KarTip`,`kardex_estado`.`Nombre_KarEst` AS `Nombre_KarEst`,`medidas`.`Unidad_Med` AS `Unidad_Med`,`kardex`.`Cantidad_Kar` * `kardex`.`Costo_Kar` AS `subtotal`,`kardex`.`Cantidad_Kar` * `kardex`.`Costo_Kar` * if(`kardex`.`Descuento_Kar` <> 'null',`kardex`.`Descuento_Kar`,0) / 100 AS `descuento`,`kardex`.`Cantidad_Kar` * `kardex`.`Costo_Kar` - `kardex`.`Cantidad_Kar` * `kardex`.`Costo_Kar` * if(`kardex`.`Descuento_Kar` <> 'null',`kardex`.`Descuento_Kar`,0) / 100 * (if(sum(`impuestos`.`Valor_Imp`) <> 'null',sum(`impuestos`.`Valor_Imp`),0) / 100) AS `impuestos`,`kardex`.`Cantidad_Kar` * `kardex`.`Costo_Kar` - if(`kardex`.`Descuento_Kar` <> 'null',`kardex`.`Descuento_Kar`,0) / 100 + `kardex`.`Cantidad_Kar` * `kardex`.`Costo_Kar` - `kardex`.`Cantidad_Kar` * `kardex`.`Costo_Kar` * if(`kardex`.`Descuento_Kar` <> 'null',`kardex`.`Descuento_Kar`,0) / 100 * (if(sum(`impuestos`.`Valor_Imp`) <> 'null',sum(`impuestos`.`Valor_Imp`),0) / 100) AS `total`,`kardex`.`Id_Doc` AS `Id_Doc`,`kardex`.`Id_Ite` AS `Id_Ite`,`kardex`.`Id_Med` AS `Id_Med`,`kardex`.`Id_Bod` AS `Id_Bod`,`kardex`.`Id_KarTip` AS `Id_KarTip`,`kardex`.`Id_KarEst` AS `Id_KarEst`,`kardex`.`Primary_Usu` AS `Primary_Usu` from (((((((`kardex` join `items` on(`kardex`.`Id_Ite` = `items`.`Id_Ite`)) left join `medidas` on(`kardex`.`Id_Med` = `medidas`.`Id_Med`)) left join `bodegas` on(`kardex`.`Id_Bod` = `bodegas`.`Id_Bod`)) join `kardex_tipo` on(`kardex`.`Id_KarTip` = `kardex_tipo`.`Id_KarTip`)) join `kardex_estado` on(`kardex`.`Id_KarEst` = `kardex_estado`.`Id_KarEst`)) left join `impuestos_kardex` on(`impuestos_kardex`.`Id_kar` = `kardex`.`Id_kar`)) left join `impuestos` on(`impuestos_kardex`.`Id_Imp` = `impuestos`.`Id_Imp`)) where `kardex`.`Id_Doc` = 9 group by `kardex`.`Id_kar` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_persona`
--

/*!50001 DROP TABLE IF EXISTS `vw_persona`*/;
/*!50001 DROP VIEW IF EXISTS `vw_persona`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_persona` AS select `persona`.`Id_Per` AS `Id_Per`,`persona`.`Identificacion_Per` AS `Identificacion_Per`,`persona`.`Nombre1_Per` AS `Nombre1_Per`,`persona`.`Nombre2_Per` AS `Nombre2_Per`,`persona`.`Apeliido1_Per` AS `Apeliido1_Per`,`persona`.`Apellido2_Per` AS `Apellido2_Per`,`persona`.`TelCelular_Per` AS `TelCelular_Per`,`persona`.`Correo_Per` AS `Correo_Per`,`municipio`.`Nombre_Num` AS `Nombre_Num`,`persona_estado`.`Estado_PerEst` AS `Estado_PerEst`,`persona_tipo`.`Descripcion_PerTip` AS `Descripcion_PerTip`,`persona_tipo_identificacion`.`Descripcion_PerTipId` AS `Descripcion_PerTipId`,`persona_tipo_identificacion`.`Codigo_PerTipId` AS `Codigo_PerTipId`,`persona`.`FechaNacimiento_Per` AS `FechaNacimiento_Per`,`departamento`.`Nombre_Dep` AS `Nombre_Dep`,`persona_genero`.`Descripcion_PerGen` AS `Descripcion_PerGen`,`persona_genero`.`Codigo_PerGen` AS `Codigo_PerGen`,`persona`.`Id_PerTipId` AS `Id_PerTipId`,`persona`.`Id_PerGen` AS `Id_PerGen`,`persona`.`Id_Mun` AS `Id_Mun`,`persona`.`Id_PerEst` AS `Id_PerEst`,`persona`.`Id_PerTip` AS `Id_PerTip`,`persona`.`Telefono_Per` AS `Telefono_Per`,`persona`.`FechaRegistro_Per` AS `FechaRegistro_Per`,`persona`.`Celular_Per` AS `Celular_Per`,`persona`.`Direccion_Per` AS `Direccion_Per`,`empresa`.`Nombre_Emp` AS `Nombre_Emp`,`persona`.`Primary_Usu` AS `Primary_Usu` from (((((((`persona` left join `municipio` on(`persona`.`Id_Mun` = `municipio`.`Id_Mun`)) left join `persona_estado` on(`persona`.`Id_PerEst` = `persona_estado`.`Id_PerEst`)) left join `persona_tipo` on(`persona`.`Id_PerTip` = `persona_tipo`.`Id_PerTip`)) left join `persona_tipo_identificacion` on(`persona`.`Id_PerTipId` = `persona_tipo_identificacion`.`Id_PerTipId`)) left join `departamento` on(`municipio`.`Id_Dep` = `departamento`.`Id_Dep`)) left join `persona_genero` on(`persona`.`Id_PerGen` = `persona_genero`.`Id_PerGen`)) left join `empresa` on(`persona`.`Id_Emp` = `empresa`.`Id_Emp`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_transacciones`
--

/*!50001 DROP TABLE IF EXISTS `vw_transacciones`*/;
/*!50001 DROP VIEW IF EXISTS `vw_transacciones`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_transacciones` AS select `transacciones`.`Id_Tran` AS `Id_Tran`,`transacciones`.`Numero_Tran` AS `Numero_Tran`,`transacciones`.`Fecha_Tran` AS `Fecha_Tran`,`transacciones`.`NotaVisible_Tran` AS `NotaVisible_Tran`,`transacciones`.`DocumentoAsociado_Tran` AS `DocumentoAsociado_Tran`,`transacciones`.`FechaRegistro_Tran` AS `FechaRegistro_Tran`,`transacciones`.`Primary_Usu` AS `Primary_Usu`,`transaccion_tipo`.`Nombre_TranTip` AS `Nombre_TranTip`,`transaccion_estado`.`Nombre_TranEst` AS `Nombre_TranEst`,`bancos`.`NombreCuenta_Ban` AS `NombreCuenta_Ban`,`bancos`.`NumeroCuenta_Ban` AS `NumeroCuenta_Ban`,`usuario`.`Usuario_Usu` AS `Usuario_Usu`,concat(coalesce(`persona`.`Nombre1_Per`,''),' ',coalesce(`persona`.`Nombre2_Per`,''),' ',coalesce(`persona`.`Apeliido1_Per`,''),' ',coalesce(`persona`.`Apellido2_Per`,'')) AS `Contacto`,`persona`.`Identificacion_Per` AS `Identificacion_Per`,`transacciones`.`Id_TranTip` AS `Id_TranTip`,`transacciones`.`Id_TranEst` AS `Id_TranEst`,`transacciones`.`Id_Ban` AS `Id_Ban`,`transacciones`.`Id_Usu` AS `Id_Usu`,`transacciones`.`Id_Per` AS `Id_Per`,`transacciones`.`Id_Tran_TransaccionParcial` AS `Id_Tran_TransaccionParcial` from (((((`transacciones` join `transaccion_tipo` on(`transacciones`.`Id_TranTip` = `transaccion_tipo`.`Id_TranTip`)) join `transaccion_estado` on(`transacciones`.`Id_TranEst` = `transaccion_estado`.`Id_TranEst`)) join `bancos` on(`transacciones`.`Id_Ban` = `bancos`.`Id_Ban`)) join `usuario` on(`transacciones`.`Id_Usu` = `usuario`.`Id_Usu`)) join `persona` on(`transacciones`.`Id_Per` = `persona`.`Id_Per`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_usuario`
--

/*!50001 DROP TABLE IF EXISTS `vw_usuario`*/;
/*!50001 DROP VIEW IF EXISTS `vw_usuario`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_usuario` AS select `usuario`.`Id_Usu` AS `Id_Usu`,concat(coalesce(`persona`.`Nombre1_Per`,''),' ',coalesce(`persona`.`Nombre2_Per`,''),' ',coalesce(`persona`.`Apeliido1_Per`,''),' ',coalesce(`persona`.`Apellido2_Per`,'')) AS `nombres`,`usuario`.`Email_Usu` AS `Email_Usu`,`usuario`.`UltimoAcceso_Usu` AS `UltimoAcceso_Usu`,`usuario`.`UltimaContrasena_Usu` AS `UltimaContrasena_Usu`,`usuario`.`KeyPago_Usu` AS `KeyPago_Usu`,`usuario_estado`.`Descripcion_UsuEst` AS `Descripcion_UsuEst`,`roles`.`Descripcion_Rol` AS `Descripcion_Rol`,`usuario`.`Primary_Usu` AS `Primary_Usu` from (((`usuario` join `persona` on(`usuario`.`Id_Per` = `persona`.`Id_Per`)) join `usuario_estado` on(`usuario`.`Id_UsuEst` = `usuario_estado`.`Id_UsuEst`)) join `roles` on(`usuario`.`Id_Rol` = `roles`.`Id_Rol`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-10-15 16:21:22
