/*
 Navicat Premium Data Transfer

 Source Server         : MySQL - Localhost
 Source Server Type    : MySQL
 Source Server Version : 100414
 Source Host           : localhost:3306
 Source Schema         : margunsoft_financia_v2

 Target Server Type    : MySQL
 Target Server Version : 100414
 File Encoding         : 65001

 Date: 10/09/2021 21:21:56
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for banco_estado
-- ----------------------------
DROP TABLE IF EXISTS `banco_estado`;
CREATE TABLE `banco_estado`  (
  `Id_BanEst` int NOT NULL AUTO_INCREMENT,
  `Nombre_BanEst` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`Id_BanEst`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of banco_estado
-- ----------------------------
INSERT INTO `banco_estado` VALUES (1, 'Activo');
INSERT INTO `banco_estado` VALUES (2, 'Inactivo');

-- ----------------------------
-- Table structure for bancos
-- ----------------------------
DROP TABLE IF EXISTS `bancos`;
CREATE TABLE `bancos`  (
  `Id_Ban` int NOT NULL AUTO_INCREMENT,
  `NombreCuenta_Ban` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NumeroCuenta_Ban` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `SaldoInicial_Ban` double NULL DEFAULT NULL,
  `FechaBanco` date NULL DEFAULT NULL,
  `Descripcion_Ban` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `FechaRegistro` timestamp NULL DEFAULT current_timestamp,
  `Id_BanEst` int NULL DEFAULT NULL,
  `Id_TipCueBan` int NULL DEFAULT NULL,
  `Primary_Usu` int NULL DEFAULT NULL,
  PRIMARY KEY (`Id_Ban`) USING BTREE,
  INDEX `fk_bancos_banco_estado1_idx`(`Id_BanEst`) USING BTREE,
  INDEX `fk_bancos_tipo_cuenta_banco1_idx`(`Id_TipCueBan`) USING BTREE,
  CONSTRAINT `fk_bancos_banco_estado1` FOREIGN KEY (`Id_BanEst`) REFERENCES `banco_estado` (`Id_BanEst`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_bancos_tipo_cuenta_banco1` FOREIGN KEY (`Id_TipCueBan`) REFERENCES `tipo_cuenta_banco` (`Id_TipCueBan`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of bancos
-- ----------------------------
INSERT INTO `bancos` VALUES (1, 'Caja general', '0', 100000, '2020-03-23', 'Banco caja general', NULL, 1, 2, 1);
INSERT INTO `bancos` VALUES (2, 'Tarjeta crédito empresarial', NULL, 0, '2020-03-24', 'Banco para tarjeta de crédito', '2020-03-24 03:03:52', 1, 1, 1);
INSERT INTO `bancos` VALUES (3, 'Caja general 1', '0', 0, '2020-03-27', 'Caja principal', '2020-03-27 03:03:39', 1, 2, 7);
INSERT INTO `bancos` VALUES (4, 'Tarjeta crédito empresarial', '0', 0, '2020-04-01', NULL, '2020-04-01 21:04:15', 1, 1, 7);

-- ----------------------------
-- Table structure for bodega_estado
-- ----------------------------
DROP TABLE IF EXISTS `bodega_estado`;
CREATE TABLE `bodega_estado`  (
  `Id_BodEst` int NOT NULL AUTO_INCREMENT,
  `Nombre_BodEst` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Estado_BodEst` enum('Activo','Inactivo') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Activo',
  `FechaRegistro_BodEst` timestamp NULL DEFAULT current_timestamp,
  PRIMARY KEY (`Id_BodEst`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of bodega_estado
-- ----------------------------
INSERT INTO `bodega_estado` VALUES (1, 'Activo', 'Activo', '2020-03-23 21:50:59');
INSERT INTO `bodega_estado` VALUES (2, 'Inactivo', 'Activo', '2020-03-23 21:51:06');

-- ----------------------------
-- Table structure for bodega_tipo
-- ----------------------------
DROP TABLE IF EXISTS `bodega_tipo`;
CREATE TABLE `bodega_tipo`  (
  `Id_BodTip` int NOT NULL AUTO_INCREMENT,
  `Nombre_BodTip` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Estado_BodTip` enum('Activo','Inactivo') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Activo',
  `FechaRegistro_BodTip` timestamp NULL DEFAULT current_timestamp,
  `Primary_Usu` int NULL DEFAULT NULL,
  PRIMARY KEY (`Id_BodTip`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of bodega_tipo
-- ----------------------------
INSERT INTO `bodega_tipo` VALUES (1, 'Principal', 'Activo', '2020-03-23 21:52:12', NULL);
INSERT INTO `bodega_tipo` VALUES (2, 'Sucursal', 'Activo', '2020-03-23 21:52:26', NULL);

-- ----------------------------
-- Table structure for bodegas
-- ----------------------------
DROP TABLE IF EXISTS `bodegas`;
CREATE TABLE `bodegas`  (
  `Id_Bod` int NOT NULL AUTO_INCREMENT,
  `Nombre_Bod` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Codigo_Bod` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Direccion_Bod` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Descripcion_Bod` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `FechaRegistro_Bod` timestamp NULL DEFAULT current_timestamp,
  `FechaCreacion_Bod` datetime NULL DEFAULT NULL,
  `Id_BodTip` int NULL DEFAULT NULL,
  `Id_BodEst` int NULL DEFAULT NULL,
  `Id_Usu` int NULL DEFAULT NULL COMMENT 'Responsable de la bodega',
  `Primary_Usu` int NULL DEFAULT NULL,
  PRIMARY KEY (`Id_Bod`) USING BTREE,
  INDEX `fk_bodegas_bodega_tipo1_idx`(`Id_BodTip`) USING BTREE,
  INDEX `fk_bodegas_bodega_estado1_idx`(`Id_BodEst`) USING BTREE,
  INDEX `fk_bodegas_usuario1_idx`(`Id_Usu`) USING BTREE,
  CONSTRAINT `fk_bodegas_bodega_estado1` FOREIGN KEY (`Id_BodEst`) REFERENCES `bodega_estado` (`Id_BodEst`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_bodegas_bodega_tipo1` FOREIGN KEY (`Id_BodTip`) REFERENCES `bodega_tipo` (`Id_BodTip`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_bodegas_usuario1` FOREIGN KEY (`Id_Usu`) REFERENCES `usuario` (`Id_Usu`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of bodegas
-- ----------------------------
INSERT INTO `bodegas` VALUES (1, 'Bodega principal', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL);
INSERT INTO `bodegas` VALUES (2, 'Almacén secundario 1', NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL);
INSERT INTO `bodegas` VALUES (3, 'Almacén secundario 2', NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL);
INSERT INTO `bodegas` VALUES (4, 'Almacén general', '1000', NULL, NULL, '2020-03-27 05:03:30', NULL, NULL, 1, 1, 1);
INSERT INTO `bodegas` VALUES (5, 'Principal Centro', '01', 'cra 23  3 45', 'Bodega principal Popayán', '2020-05-02 16:05:00', '2020-04-27 00:00:00', NULL, 1, 7, 7);

-- ----------------------------
-- Table structure for categoria_item
-- ----------------------------
DROP TABLE IF EXISTS `categoria_item`;
CREATE TABLE `categoria_item`  (
  `Id_CatIte` int NOT NULL AUTO_INCREMENT,
  `Nombre_CatIte` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `FechaRegistro_CatIte` timestamp NULL DEFAULT current_timestamp,
  `Estado_CatIte` enum('Activo','Inactivo') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Activo',
  `Primary_Usu` int NULL DEFAULT NULL,
  PRIMARY KEY (`Id_CatIte`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of categoria_item
-- ----------------------------
INSERT INTO `categoria_item` VALUES (1, 'Grupo #1', NULL, NULL, NULL);
INSERT INTO `categoria_item` VALUES (2, 'Grupo #1', '2020-03-27 05:03:27', 'Activo', 1);
INSERT INTO `categoria_item` VALUES (3, 'Servicios varios', '2020-03-31 19:03:28', 'Activo', 7);

-- ----------------------------
-- Table structure for configuracion
-- ----------------------------
DROP TABLE IF EXISTS `configuracion`;
CREATE TABLE `configuracion`  (
  `Id_Conf` int NOT NULL AUTO_INCREMENT,
  `key_Conf` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Value_Conf` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Descripcion_Conf` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `Id_ConfTip` int NULL DEFAULT NULL,
  PRIMARY KEY (`Id_Conf`) USING BTREE,
  INDEX `fk_configuracion_tipo`(`Id_ConfTip`) USING BTREE,
  INDEX `index_configuacion_id`(`Id_Conf`) USING BTREE,
  INDEX `idx_key_Conf`(`key_Conf`) USING BTREE,
  CONSTRAINT `fk_configuracion_tipo` FOREIGN KEY (`Id_ConfTip`) REFERENCES `configuracion_tipo` (`Id_ConfTip`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of configuracion
-- ----------------------------
INSERT INTO `configuracion` VALUES (1, 'NumeroUnicoForm_Afi', '25201', 'Consecutivo número  único de afiliación', 4);
INSERT INTO `configuracion` VALUES (2, 'NumeroRadicado_Aut', '1021', 'Consecutivo número de radicado para autorizaciones', 4);
INSERT INTO `configuracion` VALUES (3, 'NumeroAutorizacion_Aut', '22', 'Consecutivo para el número de autorización', 4);
INSERT INTO `configuracion` VALUES (4, 'NumeroDoc_SolicitudPertinencia', '1', 'Número de documentos por solicitud de pertinencia: 1. Un solo documento, 2. HC y Orden médica, 3. HC,  Orden médica y documento SOAT. ', 2);

-- ----------------------------
-- Table structure for configuracion_tipo
-- ----------------------------
DROP TABLE IF EXISTS `configuracion_tipo`;
CREATE TABLE `configuracion_tipo`  (
  `Id_ConfTip` int NOT NULL AUTO_INCREMENT,
  `Nombre_ConfTip` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Id_ConfTip`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of configuracion_tipo
-- ----------------------------
INSERT INTO `configuracion_tipo` VALUES (1, 'Ajustes del sistema');
INSERT INTO `configuracion_tipo` VALUES (2, 'Ajustes del cliente');
INSERT INTO `configuracion_tipo` VALUES (3, 'Visualización e interfaz ');
INSERT INTO `configuracion_tipo` VALUES (4, 'Variables incrementales');

-- ----------------------------
-- Table structure for contrato_estado
-- ----------------------------
DROP TABLE IF EXISTS `contrato_estado`;
CREATE TABLE `contrato_estado`  (
  `Id_ConEst` int NOT NULL AUTO_INCREMENT,
  `Nombre_ConEst` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Id_ConEst`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of contrato_estado
-- ----------------------------
INSERT INTO `contrato_estado` VALUES (1, 'Creado');
INSERT INTO `contrato_estado` VALUES (2, 'Vigente activo');
INSERT INTO `contrato_estado` VALUES (3, 'Anulado');
INSERT INTO `contrato_estado` VALUES (4, 'Cerrado');

-- ----------------------------
-- Table structure for contrato_tipo
-- ----------------------------
DROP TABLE IF EXISTS `contrato_tipo`;
CREATE TABLE `contrato_tipo`  (
  `Id_ConTip` int NOT NULL AUTO_INCREMENT,
  `Nombre_ConTip` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Estado_ConTip` enum('Activo','Inactivo') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Id_ConTip`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of contrato_tipo
-- ----------------------------
INSERT INTO `contrato_tipo` VALUES (1, 'CONTRATO CAPITADO', 'Activo');
INSERT INTO `contrato_tipo` VALUES (2, 'EVENTO', 'Activo');

-- ----------------------------
-- Table structure for contratos
-- ----------------------------
DROP TABLE IF EXISTS `contratos`;
CREATE TABLE `contratos`  (
  `Id_Con` int NOT NULL AUTO_INCREMENT,
  `Numero_Con` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `FechaInicio_Con` date NULL DEFAULT NULL,
  `FechaFin_Con` date NULL DEFAULT NULL,
  `Valor_Con` double(100, 2) NULL DEFAULT NULL,
  `Objeto_Con` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `Observacion_Con` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `Id_Emp` int NULL DEFAULT NULL,
  `Id_ConTip` int NULL DEFAULT NULL COMMENT 'Referente a la modalidad del contrato',
  `Id_ConEst` int NULL DEFAULT NULL,
  `Primary_Usu` int NULL DEFAULT NULL,
  PRIMARY KEY (`Id_Con`) USING BTREE,
  INDEX `fk_contratos_tipo_1`(`Id_ConTip`) USING BTREE,
  INDEX `fk_contratos_estado_1`(`Id_ConEst`) USING BTREE,
  INDEX `fk_contrato_empresa`(`Id_Emp`) USING BTREE,
  CONSTRAINT `fk_contrato_empresa` FOREIGN KEY (`Id_Emp`) REFERENCES `empresa` (`Id_Emp`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_contratos_estado_1` FOREIGN KEY (`Id_ConEst`) REFERENCES `contrato_estado` (`Id_ConEst`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_contratos_tipo_1` FOREIGN KEY (`Id_ConTip`) REFERENCES `contrato_tipo` (`Id_ConTip`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 351 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of contratos
-- ----------------------------

-- ----------------------------
-- Table structure for cuenta_estado
-- ----------------------------
DROP TABLE IF EXISTS `cuenta_estado`;
CREATE TABLE `cuenta_estado`  (
  `Id_CueEst` int NOT NULL AUTO_INCREMENT,
  `Nombre_CueEst` varchar(70) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`Id_CueEst`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of cuenta_estado
-- ----------------------------
INSERT INTO `cuenta_estado` VALUES (1, 'Activo');
INSERT INTO `cuenta_estado` VALUES (2, 'Inactivo');

-- ----------------------------
-- Table structure for cuenta_tipo
-- ----------------------------
DROP TABLE IF EXISTS `cuenta_tipo`;
CREATE TABLE `cuenta_tipo`  (
  `Id_CueTip` int NOT NULL AUTO_INCREMENT,
  `Nombre_CueTip` varchar(70) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`Id_CueTip`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of cuenta_tipo
-- ----------------------------
INSERT INTO `cuenta_tipo` VALUES (1, 'Activo');
INSERT INTO `cuenta_tipo` VALUES (2, 'Egreso');
INSERT INTO `cuenta_tipo` VALUES (3, 'Ingreso');
INSERT INTO `cuenta_tipo` VALUES (4, 'Pasivo');
INSERT INTO `cuenta_tipo` VALUES (5, 'Patromonio');
INSERT INTO `cuenta_tipo` VALUES (6, 'Costos');

-- ----------------------------
-- Table structure for cuentas
-- ----------------------------
DROP TABLE IF EXISTS `cuentas`;
CREATE TABLE `cuentas`  (
  `Id_Cue` int NOT NULL AUTO_INCREMENT,
  `Nombre_Cue` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Cuenta_Cue` varchar(70) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Consecutivo_Cue` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `FechaRegistro_Cue` timestamp NULL DEFAULT current_timestamp,
  `Id_NatCue` int NULL DEFAULT NULL,
  `Id_CueEst` int NULL DEFAULT NULL,
  `Id_CueTip` int NULL DEFAULT NULL,
  `Id_Cue_CuentaPadre` int NULL DEFAULT NULL,
  PRIMARY KEY (`Id_Cue`) USING BTREE,
  INDEX `fk_cuentas_naturaleza_cuenta1_idx`(`Id_NatCue`) USING BTREE,
  INDEX `fk_cuentas_cuenta_estado1_idx`(`Id_CueEst`) USING BTREE,
  INDEX `fk_cuentas_cuenta_tipo1_idx`(`Id_CueTip`) USING BTREE,
  INDEX `fk_cuentas_cuentas1_idx`(`Id_Cue_CuentaPadre`) USING BTREE,
  CONSTRAINT `fk_cuentas_cuenta_estado1` FOREIGN KEY (`Id_CueEst`) REFERENCES `cuenta_estado` (`Id_CueEst`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cuentas_cuenta_tipo1` FOREIGN KEY (`Id_CueTip`) REFERENCES `cuenta_tipo` (`Id_CueTip`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cuentas_cuentas1` FOREIGN KEY (`Id_Cue_CuentaPadre`) REFERENCES `cuentas` (`Id_Cue`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cuentas_naturaleza_cuenta1` FOREIGN KEY (`Id_NatCue`) REFERENCES `naturaleza_cuenta` (`Id_NatCue`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 454 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of cuentas
-- ----------------------------
INSERT INTO `cuentas` VALUES (1, 'Activo', '1', NULL, '2020-04-22 17:20:32', 1, 1, 1, 1);
INSERT INTO `cuentas` VALUES (2, 'Activos Corrientes', '101', NULL, '2020-04-22 17:20:32', 1, 1, 1, 1);
INSERT INTO `cuentas` VALUES (3, 'Disponible', '10101', NULL, '2020-04-22 17:20:32', 1, 1, 1, 2);
INSERT INTO `cuentas` VALUES (4, 'Caja', '1010101', NULL, '2020-04-22 17:20:32', 1, 1, 1, 3);
INSERT INTO `cuentas` VALUES (5, 'Caja General', '1010101001', NULL, '2020-04-22 17:20:32', 1, 1, 1, 4);
INSERT INTO `cuentas` VALUES (6, 'Fondo Fijo', '1010102', NULL, '2020-04-22 17:20:32', 1, 1, 1, 3);
INSERT INTO `cuentas` VALUES (7, 'Bancos', '1010103', NULL, '2020-04-22 17:20:32', 1, 1, 1, 3);
INSERT INTO `cuentas` VALUES (8, 'Exigible', '10102', NULL, '2020-04-22 17:20:32', 1, 1, 1, 2);
INSERT INTO `cuentas` VALUES (9, 'Cuentas por cobrar Accionistas', '1010201', NULL, '2020-04-22 17:20:32', 1, 1, 1, 8);
INSERT INTO `cuentas` VALUES (10, 'Anticipos a empleados', '1010202', NULL, '2020-04-22 17:20:32', 1, 1, 1, 8);
INSERT INTO `cuentas` VALUES (11, 'Cuentas por cobrar empleados', '1010203', NULL, '2020-04-22 17:20:32', 1, 1, 1, 8);
INSERT INTO `cuentas` VALUES (12, 'Cuentas por cobrar Clientes', '1010204', NULL, '2020-04-22 17:20:32', 1, 1, 1, 8);
INSERT INTO `cuentas` VALUES (13, 'Cuentas por cobrar Compañías Asociadas', '1010205', NULL, '2020-04-22 17:20:32', 1, 1, 1, 8);
INSERT INTO `cuentas` VALUES (14, 'Cuentas por cobrar a Terceros', '1010206', NULL, '2020-04-22 17:20:32', 1, 1, 1, 8);
INSERT INTO `cuentas` VALUES (15, 'Realizable', '10103', NULL, '2020-04-22 17:20:32', 1, 1, 1, 2);
INSERT INTO `cuentas` VALUES (16, 'Anticipo a proveedores', '1010301', NULL, '2020-04-22 17:20:32', 1, 1, 1, 15);
INSERT INTO `cuentas` VALUES (17, 'Materia Prima', '1010302', NULL, '2020-04-22 17:20:32', 1, 1, 1, 15);
INSERT INTO `cuentas` VALUES (18, 'Materiales indirectos y suministros de fábrica', '1010303', NULL, '2020-04-22 17:20:32', 1, 1, 1, 15);
INSERT INTO `cuentas` VALUES (19, 'Mercancía en transito', '1010304', NULL, '2020-04-22 17:20:32', 1, 1, 1, 15);
INSERT INTO `cuentas` VALUES (20, 'Productos en proceso (MOD)', '1010305', NULL, '2020-04-22 17:20:32', 1, 1, 1, 15);
INSERT INTO `cuentas` VALUES (21, 'Productos en proceso (MOI)', '1010306', NULL, '2020-04-22 17:20:32', 1, 1, 1, 15);
INSERT INTO `cuentas` VALUES (22, 'Productos en proceso (Materia prima)', '1010307', NULL, '2020-04-22 17:20:32', 1, 1, 1, 15);
INSERT INTO `cuentas` VALUES (23, 'Inventario de Productos Terminados', '1010308', NULL, '2020-04-22 17:20:32', 1, 1, 1, 15);
INSERT INTO `cuentas` VALUES (24, 'Mercancía para la venta', '1010309', NULL, '2020-04-22 17:20:32', 1, 1, 1, 15);
INSERT INTO `cuentas` VALUES (25, 'Provisión por obsolescencia de (MP)', '1010351', NULL, '2020-04-22 17:20:32', 1, 1, 1, 15);
INSERT INTO `cuentas` VALUES (26, 'Provisión por obsolescencia de (Materiales indirectos)', '1010352', NULL, '2020-04-22 17:20:32', 1, 1, 1, 15);
INSERT INTO `cuentas` VALUES (27, 'Provisión por obsolescencia de productos terminados', '1010353', NULL, '2020-04-22 17:20:32', 1, 1, 1, 15);
INSERT INTO `cuentas` VALUES (28, 'Prepagado', '10104', NULL, '2020-04-22 17:20:32', 1, 1, 1, 2);
INSERT INTO `cuentas` VALUES (29, 'Impuestos pagados por anticipado', '1010401', NULL, '2020-04-22 17:20:32', 1, 1, 1, 28);
INSERT INTO `cuentas` VALUES (30, 'Impuesto al valor agregado', '1010401001', NULL, '2020-04-22 17:20:32', 1, 1, 1, 29);
INSERT INTO `cuentas` VALUES (31, 'Retenciones I.V.A.', '1010401002', NULL, '2020-04-22 17:20:32', 1, 1, 1, 29);
INSERT INTO `cuentas` VALUES (32, 'Retenciones I.S.L.R.', '1010401003', NULL, '2020-04-22 17:20:32', 1, 1, 1, 29);
INSERT INTO `cuentas` VALUES (33, 'Excedente de crédito fiscal (IVA)', '1010401004', NULL, '2020-04-22 17:20:32', 1, 1, 1, 29);
INSERT INTO `cuentas` VALUES (34, 'Seguros pagados por anticipado', '1010402', NULL, '2020-04-22 17:20:32', 1, 1, 1, 28);
INSERT INTO `cuentas` VALUES (35, 'Intereses pagados por anticipado', '1010403', NULL, '2020-04-22 17:20:32', 1, 1, 1, 28);
INSERT INTO `cuentas` VALUES (36, 'Alquileres pagados por anticipado', '1010404', NULL, '2020-04-22 17:20:32', 1, 1, 1, 28);
INSERT INTO `cuentas` VALUES (37, 'Activo No corrientes', '102', NULL, '2020-04-22 17:20:32', 1, 1, 1, 1);
INSERT INTO `cuentas` VALUES (38, 'Largo plazo', '10201', NULL, '2020-04-22 17:20:32', 1, 1, 1, 37);
INSERT INTO `cuentas` VALUES (39, 'Efectos por cobrar', '1020101', NULL, '2020-04-22 17:20:32', 1, 1, 1, 38);
INSERT INTO `cuentas` VALUES (40, 'Cuentas por cobrar', '1020102', NULL, '2020-04-22 17:20:32', 1, 1, 1, 38);
INSERT INTO `cuentas` VALUES (41, 'Hipotecas por cobrar', '1020103', NULL, '2020-04-22 17:20:32', 1, 1, 1, 38);
INSERT INTO `cuentas` VALUES (42, 'Inversiones en acciones', '1020104', NULL, '2020-04-22 17:20:32', 1, 1, 1, 38);
INSERT INTO `cuentas` VALUES (43, 'Provisión para fluctuaciones del valor de mercado en acciones', '1020105', NULL, '2020-04-22 17:20:32', 1, 1, 1, 38);
INSERT INTO `cuentas` VALUES (44, 'Inversiones en bonos', '1020106', NULL, '2020-04-22 17:20:32', 1, 1, 1, 38);
INSERT INTO `cuentas` VALUES (45, 'Provisión para fluctuaciones del valor de mercado en bonos', '1020107', NULL, '2020-04-22 17:20:32', 1, 1, 1, 38);
INSERT INTO `cuentas` VALUES (46, 'Inversiones en compañías asociadas', '1020108', NULL, '2020-04-22 17:20:32', 1, 1, 1, 38);
INSERT INTO `cuentas` VALUES (47, 'Inversiones en inmuebles', '1020109', NULL, '2020-04-22 17:20:32', 1, 1, 1, 38);
INSERT INTO `cuentas` VALUES (48, 'Inversiones permanentes', '1020110', NULL, '2020-04-22 17:20:32', 1, 1, 1, 38);
INSERT INTO `cuentas` VALUES (49, 'Propiedad', '10202', NULL, '2020-04-22 17:20:32', 1, 1, 1, 37);
INSERT INTO `cuentas` VALUES (50, 'Terreros', '1020201', NULL, '2020-04-22 17:20:32', 1, 1, 1, 49);
INSERT INTO `cuentas` VALUES (52, 'Planta', '10203', NULL, '2020-04-22 17:20:32', 1, 1, 1, 37);
INSERT INTO `cuentas` VALUES (53, 'Depreciación Acumulada Planta', '10204', NULL, '2020-04-22 17:20:32', 1, 1, 1, 37);
INSERT INTO `cuentas` VALUES (54, 'Obsolescencia de Planta', '10205', NULL, '2020-04-22 17:20:32', 1, 1, 1, 37);
INSERT INTO `cuentas` VALUES (55, 'Revalorización de Planta', '10206', NULL, '2020-04-22 17:20:32', 1, 1, 1, 37);
INSERT INTO `cuentas` VALUES (57, 'Depreciación Acumulada Revalorización de Planta', '10207', NULL, '2020-04-22 17:20:32', 1, 1, 1, 37);
INSERT INTO `cuentas` VALUES (59, 'Obsolescencia Revalorización de Planta', '10208', NULL, '2020-04-22 17:20:32', 1, 1, 1, 37);
INSERT INTO `cuentas` VALUES (61, 'Equipo', '10209', NULL, '2020-04-22 17:20:32', 1, 1, 1, 37);
INSERT INTO `cuentas` VALUES (62, 'Vehículos automotores', '1020901', NULL, '2020-04-22 17:20:32', 1, 1, 1, 61);
INSERT INTO `cuentas` VALUES (63, 'Vehículos automotores de carga', '1020902', NULL, '2020-04-22 17:20:32', 1, 1, 1, 61);
INSERT INTO `cuentas` VALUES (64, 'Vehículos de trasmisión mecánica', '1020903', NULL, '2020-04-22 17:20:32', 1, 1, 1, 61);
INSERT INTO `cuentas` VALUES (65, 'Maquinaria pesada', '1020904', NULL, '2020-04-22 17:20:32', 1, 1, 1, 61);
INSERT INTO `cuentas` VALUES (66, 'Muebles', '1020911', NULL, '2020-04-22 17:20:32', 1, 1, 1, 61);
INSERT INTO `cuentas` VALUES (67, 'Equipos de oficina', '1020921', NULL, '2020-04-22 17:20:32', 1, 1, 1, 61);
INSERT INTO `cuentas` VALUES (68, 'Depreciación Acumulada de Equipos', '10210', NULL, '2020-04-22 17:20:32', 1, 1, 1, 37);
INSERT INTO `cuentas` VALUES (69, 'Deprec Acum.Vehículos automotores', '1021001', NULL, '2020-04-22 17:20:32', 1, 1, 1, 68);
INSERT INTO `cuentas` VALUES (70, 'Deprec. Acum. Vehículos automotores de carga', '1021002', NULL, '2020-04-22 17:20:32', 1, 1, 1, 68);
INSERT INTO `cuentas` VALUES (71, 'Deprec. Acum Vehículos de trasmisión mecánica', '1021003', NULL, '2020-04-22 17:20:32', 1, 1, 1, 68);
INSERT INTO `cuentas` VALUES (72, 'Deprec. Acum. Maquinaria pesada', '1021004', NULL, '2020-04-22 17:20:32', 1, 1, 1, 68);
INSERT INTO `cuentas` VALUES (73, 'Depreciación Acumulada Muebles', '1021011', NULL, '2020-04-22 17:20:32', 1, 1, 1, 68);
INSERT INTO `cuentas` VALUES (74, 'Depreciación Acumulada Equipos de oficina', '1021021', NULL, '2020-04-22 17:20:32', 1, 1, 1, 68);
INSERT INTO `cuentas` VALUES (75, 'Obsolescencia de Equipos', '10211', NULL, '2020-04-22 17:20:32', 1, 1, 1, 37);
INSERT INTO `cuentas` VALUES (76, 'Obsolescencia Vehículos automotores', '1021101', NULL, '2020-04-22 17:20:32', 1, 1, 1, 75);
INSERT INTO `cuentas` VALUES (77, 'Obsolescencia Vehículos automotores de carga', '1021102', NULL, '2020-04-22 17:20:32', 1, 1, 1, 75);
INSERT INTO `cuentas` VALUES (78, 'Obsolescencia Vehículos de trasmisión mecánica', '1021103', NULL, '2020-04-22 17:20:32', 1, 1, 1, 75);
INSERT INTO `cuentas` VALUES (79, 'Obsolescencia Maquinaria pesada', '1021104', NULL, '2020-04-22 17:20:32', 1, 1, 1, 75);
INSERT INTO `cuentas` VALUES (80, 'Obsolescencia Muebles', '1021111', NULL, '2020-04-22 17:20:32', 1, 1, 1, 75);
INSERT INTO `cuentas` VALUES (81, 'Obsolescencia Equipos de oficina', '1021121', NULL, '2020-04-22 17:20:32', 1, 1, 1, 75);
INSERT INTO `cuentas` VALUES (82, 'Revalorización Equipos', '10212', NULL, '2020-04-22 17:20:32', 1, 1, 1, 37);
INSERT INTO `cuentas` VALUES (83, 'Revalorización Vehículos automotores', '1021201', NULL, '2020-04-22 17:20:32', 1, 1, 1, 82);
INSERT INTO `cuentas` VALUES (84, 'Revalorización Vehículos automotores de carga', '1021202', NULL, '2020-04-22 17:20:32', 1, 1, 1, 82);
INSERT INTO `cuentas` VALUES (85, 'Revalorización Vehículos de trasmisión mecánica', '1021203', NULL, '2020-04-22 17:20:32', 1, 1, 1, 82);
INSERT INTO `cuentas` VALUES (86, 'Revalorización Maquinaria pesada', '1021204', NULL, '2020-04-22 17:20:32', 1, 1, 1, 82);
INSERT INTO `cuentas` VALUES (87, 'Revalorización Muebles', '1021211', NULL, '2020-04-22 17:20:32', 1, 1, 1, 82);
INSERT INTO `cuentas` VALUES (88, 'Revalorización Equipos de oficina', '1021221', NULL, '2020-04-22 17:20:32', 1, 1, 1, 82);
INSERT INTO `cuentas` VALUES (89, 'Obsolescencia Revalorización de Equipos', '10213', NULL, '2020-04-22 17:20:32', 1, 1, 1, 37);
INSERT INTO `cuentas` VALUES (90, 'Obsolescencia Rev. Vehículos automotores', '1021301', NULL, '2020-04-22 17:20:32', 1, 1, 1, 89);
INSERT INTO `cuentas` VALUES (91, 'Obsolescencia Rev. Veh. automotores de carga', '1021302', NULL, '2020-04-22 17:20:32', 1, 1, 1, 89);
INSERT INTO `cuentas` VALUES (92, 'Obsolescencia Rev. Veh. Trasmisión mecánica', '1021303', NULL, '2020-04-22 17:20:32', 1, 1, 1, 89);
INSERT INTO `cuentas` VALUES (93, 'Obsolescencia Rev. Maq. pesada', '1021304', NULL, '2020-04-22 17:20:32', 1, 1, 1, 89);
INSERT INTO `cuentas` VALUES (94, 'Obsolescencia Rev. Muebles', '1021311', NULL, '2020-04-22 17:20:32', 1, 1, 1, 89);
INSERT INTO `cuentas` VALUES (95, 'Obsolescencia Rev. Equipos de oficina', '1021321', NULL, '2020-04-22 17:20:32', 1, 1, 1, 89);
INSERT INTO `cuentas` VALUES (96, 'Deprec. Acum. Revalorización de Equipos', '10214', NULL, '2020-04-22 17:20:32', 1, 1, 1, 37);
INSERT INTO `cuentas` VALUES (97, 'Deprec. Acum. Reval. Vehículos automotores', '1021401', NULL, '2020-04-22 17:20:32', 1, 1, 1, 96);
INSERT INTO `cuentas` VALUES (98, 'Deprec. Acum. Rev Vehículos automotores de carga', '1021402', NULL, '2020-04-22 17:20:32', 1, 1, 1, 96);
INSERT INTO `cuentas` VALUES (99, 'Deprec. Acum. Rev Veh. de trasmisión Mec.', '1021403', NULL, '2020-04-22 17:20:32', 1, 1, 1, 96);
INSERT INTO `cuentas` VALUES (100, 'Deprec. Acum. Revalorización Maquinaria pesada', '1021404', NULL, '2020-04-22 17:20:32', 1, 1, 1, 96);
INSERT INTO `cuentas` VALUES (101, 'Deprec. Acum. Revalorización Muebles', '1021411', NULL, '2020-04-22 17:20:32', 1, 1, 1, 96);
INSERT INTO `cuentas` VALUES (102, 'Deprec. Acum. Revalorización Equipos de oficina', '1021421', NULL, '2020-04-22 17:20:32', 1, 1, 1, 96);
INSERT INTO `cuentas` VALUES (103, 'Intangibles', '10215', NULL, '2020-04-22 17:20:32', 1, 1, 1, 37);
INSERT INTO `cuentas` VALUES (104, 'Derechos de autor', '1021501', NULL, '2020-04-22 17:20:32', 1, 1, 1, 103);
INSERT INTO `cuentas` VALUES (105, 'Franquicias', '1021502', NULL, '2020-04-22 17:20:32', 1, 1, 1, 103);
INSERT INTO `cuentas` VALUES (106, 'Marcas de fabrica', '1021503', NULL, '2020-04-22 17:20:32', 1, 1, 1, 103);
INSERT INTO `cuentas` VALUES (107, 'Patentes', '1021504', NULL, '2020-04-22 17:20:32', 1, 1, 1, 103);
INSERT INTO `cuentas` VALUES (108, 'Plusvalía', '1021505', NULL, '2020-04-22 17:20:32', 1, 1, 1, 103);
INSERT INTO `cuentas` VALUES (109, 'Software', '1021506', NULL, '2020-04-22 17:20:32', 1, 1, 1, 103);
INSERT INTO `cuentas` VALUES (110, 'Amortización intangibles', '10216', NULL, '2020-04-22 17:20:32', 1, 1, 1, 37);
INSERT INTO `cuentas` VALUES (111, 'Amortización derechos de autor', '1021601', NULL, '2020-04-22 17:20:32', 1, 1, 1, 110);
INSERT INTO `cuentas` VALUES (112, 'Amortización franquicias', '1021602', NULL, '2020-04-22 17:20:32', 1, 1, 1, 110);
INSERT INTO `cuentas` VALUES (113, 'Amortización marcas de fabrica', '1021603', NULL, '2020-04-22 17:20:32', 1, 1, 1, 110);
INSERT INTO `cuentas` VALUES (114, 'Amortización patentes', '1021604', NULL, '2020-04-22 17:20:32', 1, 1, 1, 110);
INSERT INTO `cuentas` VALUES (115, 'Amortización plusvalía', '1021605', NULL, '2020-04-22 17:20:32', 1, 1, 1, 110);
INSERT INTO `cuentas` VALUES (116, 'Amortización Software', '1021606', NULL, '2020-04-22 17:20:32', 1, 1, 1, 110);
INSERT INTO `cuentas` VALUES (117, 'Activos diferidos', '103', NULL, '2020-04-22 17:20:32', 1, 1, 1, 1);
INSERT INTO `cuentas` VALUES (118, 'Gastos diferidos', '10301', NULL, '2020-04-22 17:20:32', 1, 1, 1, 117);
INSERT INTO `cuentas` VALUES (119, 'Gastos de constitución', '1030101', NULL, '2020-04-22 17:20:32', 1, 1, 1, 118);
INSERT INTO `cuentas` VALUES (120, 'Gastos de organización', '1030102', NULL, '2020-04-22 17:20:32', 1, 1, 1, 118);
INSERT INTO `cuentas` VALUES (121, 'Gastos por campañas publicitarias', '1030103', NULL, '2020-04-22 17:20:32', 1, 1, 1, 118);
INSERT INTO `cuentas` VALUES (122, 'Seguros Prepagados', '10302', NULL, '2020-04-22 17:20:32', 1, 1, 1, 117);
INSERT INTO `cuentas` VALUES (123, 'Otros Activos', '199', NULL, '2020-04-22 17:20:32', 1, 1, 1, 1);
INSERT INTO `cuentas` VALUES (124, 'Depósitos dados en Garantía', '19901', NULL, '2020-04-22 17:20:32', 1, 1, 1, 123);
INSERT INTO `cuentas` VALUES (125, 'Depósitos dados en Garantía', '1990101', NULL, '2020-04-22 17:20:32', 1, 1, 1, 124);
INSERT INTO `cuentas` VALUES (126, 'Terrenos no utilizados', '19902', NULL, '2020-04-22 17:20:32', 1, 1, 1, 123);
INSERT INTO `cuentas` VALUES (127, 'Muebles en Desuso', '19903', NULL, '2020-04-22 17:20:32', 1, 1, 1, 123);
INSERT INTO `cuentas` VALUES (128, 'Pasivo', '2', NULL, '2020-04-24 21:53:52', 2, 1, 4, 128);
INSERT INTO `cuentas` VALUES (129, 'Pasivo Corriente', '201', NULL, '2020-04-24 21:53:52', 2, 1, 4, 128);
INSERT INTO `cuentas` VALUES (130, 'Efectos por pagar', '20101', NULL, '2020-04-24 21:53:52', 2, 1, 4, 129);
INSERT INTO `cuentas` VALUES (131, 'Efectos Bancarios', '2010101', NULL, '2020-04-24 21:53:52', 2, 1, 4, 130);
INSERT INTO `cuentas` VALUES (132, 'Efectos Comerciales', '2010102', NULL, '2020-04-24 21:53:52', 2, 1, 4, 130);
INSERT INTO `cuentas` VALUES (133, 'Cuentas por Pagar', '20102', NULL, '2020-04-24 21:53:52', 2, 1, 4, 129);
INSERT INTO `cuentas` VALUES (134, 'Préstamos Bancarios (Corto Plazo)', '2010201', NULL, '2020-04-24 21:53:52', 2, 1, 4, 133);
INSERT INTO `cuentas` VALUES (135, 'Cuentas Por Pagar Proveedores', '2010202', NULL, '2020-04-24 21:53:52', 2, 1, 4, 133);
INSERT INTO `cuentas` VALUES (136, 'Proveedores Recurentes', '2010202001', NULL, '2020-04-24 21:53:52', 2, 1, 4, 135);
INSERT INTO `cuentas` VALUES (137, 'Cuentas por pagar Gubernamentales', '2010203', NULL, '2020-04-24 21:53:52', 2, 1, 4, 133);
INSERT INTO `cuentas` VALUES (138, 'Impuestos al valor agregado', '2010203001', NULL, '2020-04-24 21:53:52', 2, 1, 4, 137);
INSERT INTO `cuentas` VALUES (139, 'Retenciones impuestos al valor agregado', '2010203002', NULL, '2020-04-24 21:53:52', 2, 1, 4, 137);
INSERT INTO `cuentas` VALUES (140, 'I.S.L.R.', '2010203003', NULL, '2020-04-24 21:53:52', 2, 1, 4, 137);
INSERT INTO `cuentas` VALUES (141, 'Retenciones I.S.L.R.', '2010203004', NULL, '2020-04-24 21:53:52', 2, 1, 4, 137);
INSERT INTO `cuentas` VALUES (142, 'I.V.S.S. (Seguro Social)', '2010203005', NULL, '2020-04-24 21:53:52', 2, 1, 4, 137);
INSERT INTO `cuentas` VALUES (143, 'P.I.E. (Perdida Involuntaria del empleo)', '2010203006', NULL, '2020-04-24 21:53:52', 2, 1, 4, 137);
INSERT INTO `cuentas` VALUES (144, 'Banavih', '2010203007', NULL, '2020-04-24 21:53:52', 2, 1, 4, 137);
INSERT INTO `cuentas` VALUES (145, 'I.N.C.E.S.', '2010203008', NULL, '2020-04-24 21:53:52', 2, 1, 4, 137);
INSERT INTO `cuentas` VALUES (146, 'Patente industria y comercio', '2010203009', NULL, '2020-04-24 21:53:52', 2, 1, 4, 137);
INSERT INTO `cuentas` VALUES (147, 'Cuentas por pagar empleados', '2010204', NULL, '2020-04-24 21:53:52', 2, 1, 4, 133);
INSERT INTO `cuentas` VALUES (148, 'Sueldos', '2010204001', NULL, '2020-04-24 21:53:52', 2, 1, 4, 147);
INSERT INTO `cuentas` VALUES (149, 'Horas extraordinarias', '2010204002', NULL, '2020-04-24 21:53:52', 2, 1, 4, 147);
INSERT INTO `cuentas` VALUES (150, 'Vacaciones', '2010204003', NULL, '2020-04-24 21:53:52', 2, 1, 4, 147);
INSERT INTO `cuentas` VALUES (151, 'Bono vacacional', '2010204004', NULL, '2020-04-24 21:53:52', 2, 1, 4, 147);
INSERT INTO `cuentas` VALUES (152, 'Utilidades', '2010204005', NULL, '2020-04-24 21:53:52', 2, 1, 4, 147);
INSERT INTO `cuentas` VALUES (153, 'Prestaciones Antigüedad', '2010204006', NULL, '2020-04-24 21:53:52', 2, 1, 4, 147);
INSERT INTO `cuentas` VALUES (154, 'Intereses sobres Prestaciones Antigüedad', '2010204007', NULL, '2020-04-24 21:53:52', 2, 1, 4, 147);
INSERT INTO `cuentas` VALUES (155, 'Bono por antigüedad', '2010204008', NULL, '2020-04-24 21:53:52', 2, 1, 4, 147);
INSERT INTO `cuentas` VALUES (156, 'Bono', '2010204009', NULL, '2020-04-24 21:53:52', 2, 1, 4, 147);
INSERT INTO `cuentas` VALUES (157, 'Bono para alimentación', '2010204010', NULL, '2020-04-24 21:53:52', 2, 1, 4, 147);
INSERT INTO `cuentas` VALUES (158, 'Días Feriados', '2010204011', NULL, '2020-04-24 21:53:52', 2, 1, 4, 147);
INSERT INTO `cuentas` VALUES (159, 'Dividendos por pagar', '2010205', NULL, '2020-04-24 21:53:52', 2, 1, 4, 133);
INSERT INTO `cuentas` VALUES (160, 'Anticipos de clientes', '2010206', NULL, '2020-04-24 21:53:52', 2, 1, 4, 133);
INSERT INTO `cuentas` VALUES (161, 'Cuentas por pagar compañias asociadas', '2010207', NULL, '2020-04-24 21:53:52', 2, 1, 4, 133);
INSERT INTO `cuentas` VALUES (162, 'Provisiones para contingencias', '2010208', NULL, '2020-04-24 21:53:52', 2, 1, 4, 133);
INSERT INTO `cuentas` VALUES (163, 'Pasivo No Corriente', '202', NULL, '2020-04-24 21:53:52', 2, 1, 4, 128);
INSERT INTO `cuentas` VALUES (164, 'Efectos por pagar (Largo Plazo)', '20201', NULL, '2020-04-24 21:53:52', 2, 1, 4, 163);
INSERT INTO `cuentas` VALUES (165, 'Efectos Bancarios', '2020101', NULL, '2020-04-24 21:53:52', 2, 1, 4, 164);
INSERT INTO `cuentas` VALUES (166, 'Efectos Comerciales', '2020102', NULL, '2020-04-24 21:53:52', 2, 1, 4, 164);
INSERT INTO `cuentas` VALUES (167, 'Cuentas por pagar Largo Plazo', '20202', NULL, '2020-04-24 21:53:52', 2, 1, 4, 163);
INSERT INTO `cuentas` VALUES (168, 'Hipocetas Por pagar', '20203', NULL, '2020-04-24 21:53:52', 2, 1, 4, 163);
INSERT INTO `cuentas` VALUES (169, 'Préstamos Bancarios (Largo Plazo)', '20204', NULL, '2020-04-24 21:53:52', 2, 1, 4, 163);
INSERT INTO `cuentas` VALUES (170, 'Otras Cuentas por Pagar (Largo Plazo)', '20205', NULL, '2020-04-24 21:53:53', 2, 1, 4, 163);
INSERT INTO `cuentas` VALUES (171, 'Préstamos Bancarios (Largo Plazo)', '20206', NULL, '2020-04-24 21:53:53', 2, 1, 4, 163);
INSERT INTO `cuentas` VALUES (172, 'Apartados', '20207', NULL, '2020-04-24 21:53:53', 2, 1, 4, 163);
INSERT INTO `cuentas` VALUES (173, 'Apartado de prestaciones sociales', '2020701', NULL, '2020-04-24 21:53:53', 2, 1, 4, 172);
INSERT INTO `cuentas` VALUES (174, 'Prestaciones por antigüedad', '2020701001', NULL, '2020-04-24 21:53:53', 2, 1, 4, 173);
INSERT INTO `cuentas` VALUES (175, 'Intereses sobre prestaciones de antigüedad', '2020701002', NULL, '2020-04-24 21:53:53', 2, 1, 4, 173);
INSERT INTO `cuentas` VALUES (176, 'Apartado para juicios pendientes', '2020702', NULL, '2020-04-24 21:53:53', 2, 1, 4, 172);
INSERT INTO `cuentas` VALUES (177, 'Diferidos', '20208', NULL, '2020-04-24 21:53:53', 2, 1, 4, 163);
INSERT INTO `cuentas` VALUES (178, 'Créditos diferidos', '2020801', NULL, '2020-04-24 21:53:53', 2, 1, 4, 177);
INSERT INTO `cuentas` VALUES (179, 'Alquileres cobrados por anticipado', '2020801001', NULL, '2020-04-24 21:53:53', 2, 1, 4, 178);
INSERT INTO `cuentas` VALUES (180, 'Intereses cobrados por anticipados', '2020801002', NULL, '2020-04-24 21:53:53', 2, 1, 4, 178);
INSERT INTO `cuentas` VALUES (181, 'Otros ingresos cobrados por anticipado', '2020801003', NULL, '2020-04-24 21:53:53', 2, 1, 4, 178);
INSERT INTO `cuentas` VALUES (182, 'Otros', '20299', NULL, '2020-04-24 21:53:53', 2, 1, 4, 163);
INSERT INTO `cuentas` VALUES (183, 'Depósitos recibidos en garantía', '2029901', NULL, '2020-04-24 21:53:53', 2, 1, 4, 182);
INSERT INTO `cuentas` VALUES (184, 'Utilidades no reclamadas', '2029902', NULL, '2020-04-24 21:53:53', 2, 1, 4, 182);
INSERT INTO `cuentas` VALUES (185, 'Cuentas por pagar accionistas', '2029903', NULL, '2020-04-24 21:53:53', 2, 1, 4, 182);
INSERT INTO `cuentas` VALUES (186, 'Patrimonio', '3', NULL, '2020-04-24 22:03:26', 1, 1, 5, 186);
INSERT INTO `cuentas` VALUES (187, 'Capital social', '301', NULL, '2020-04-24 22:03:26', 1, 1, 5, 186);
INSERT INTO `cuentas` VALUES (188, 'Emitido', '30101', NULL, '2020-04-24 22:03:26', 1, 1, 5, 187);
INSERT INTO `cuentas` VALUES (189, 'Pagado', '3010101', NULL, '2020-04-24 22:03:26', 1, 1, 5, 188);
INSERT INTO `cuentas` VALUES (190, 'Accionista', '3010101001', NULL, '2020-04-24 22:03:26', 1, 1, 5, 189);
INSERT INTO `cuentas` VALUES (191, 'Accionista', '3010101002', NULL, '2020-04-24 22:03:26', 1, 1, 5, 189);
INSERT INTO `cuentas` VALUES (192, 'Suscrito', '3010102', NULL, '2020-04-24 22:03:26', 1, 1, 5, 188);
INSERT INTO `cuentas` VALUES (193, 'Reservado', '30102', NULL, '2020-04-24 22:03:26', 1, 1, 5, 187);
INSERT INTO `cuentas` VALUES (194, 'Reservas acumuladas', '3010201', NULL, '2020-04-24 22:03:26', 1, 1, 5, 193);
INSERT INTO `cuentas` VALUES (195, 'Reserva legal', '3010201001', NULL, '2020-04-24 22:03:26', 1, 1, 5, 194);
INSERT INTO `cuentas` VALUES (196, 'Reserva estatutaria', '3010201002', NULL, '2020-04-24 22:03:26', 1, 1, 5, 194);
INSERT INTO `cuentas` VALUES (197, 'Reserva Voluntarias', '3010201003', NULL, '2020-04-24 22:03:26', 1, 1, 5, 194);
INSERT INTO `cuentas` VALUES (198, 'Otras reservas', '3010201999', NULL, '2020-04-24 22:03:26', 1, 1, 5, 194);
INSERT INTO `cuentas` VALUES (199, 'Resultados', '302', NULL, '2020-04-24 22:03:26', 1, 1, 5, 186);
INSERT INTO `cuentas` VALUES (200, 'Históricos', '30201', NULL, '2020-04-24 22:03:26', 1, 1, 5, 199);
INSERT INTO `cuentas` VALUES (201, 'Utilidad o Pérdida histórica', '3020101', NULL, '2020-04-24 22:03:26', 1, 1, 5, 200);
INSERT INTO `cuentas` VALUES (202, 'Utilidad o Pérdida no distribuida', '3020101001', NULL, '2020-04-24 22:03:26', 1, 1, 5, 201);
INSERT INTO `cuentas` VALUES (203, 'Resultado actual', '30202', NULL, '2020-04-24 22:03:26', 1, 1, 5, 199);
INSERT INTO `cuentas` VALUES (204, 'Utilidad o Pérdida actual', '3020201', NULL, '2020-04-24 22:03:26', 1, 1, 5, 203);
INSERT INTO `cuentas` VALUES (205, 'Utilidad o Pérdida del ejercicio', '3020201001', NULL, '2020-04-24 22:03:26', 1, 1, 5, 204);
INSERT INTO `cuentas` VALUES (206, 'Diferencia reconversión monetaria', '3020201002', NULL, '2020-04-24 22:03:26', 1, 1, 5, 204);
INSERT INTO `cuentas` VALUES (207, 'Ingresos', '4', NULL, '2020-04-24 22:12:02', 1, 1, 3, 207);
INSERT INTO `cuentas` VALUES (208, 'Ventas de la actividad', '401', NULL, '2020-04-24 22:12:02', 1, 1, 3, 207);
INSERT INTO `cuentas` VALUES (209, 'Bienes', '40101', NULL, '2020-04-24 22:12:02', 1, 1, 3, 208);
INSERT INTO `cuentas` VALUES (210, 'Productos Exentos', '4010101', NULL, '2020-04-24 22:12:02', 1, 1, 3, 209);
INSERT INTO `cuentas` VALUES (211, 'Descuentos en Ventas  Exentas', '4010102', NULL, '2020-04-24 22:12:02', 1, 1, 3, 209);
INSERT INTO `cuentas` VALUES (212, 'Devoluciones en Ventas Exentas', '4010103', NULL, '2020-04-24 22:12:02', 1, 1, 3, 209);
INSERT INTO `cuentas` VALUES (213, 'Productos Gravadas', '4010104', NULL, '2020-04-24 22:12:02', 1, 1, 3, 209);
INSERT INTO `cuentas` VALUES (214, 'Descuentos en Ventas  Gravadas', '4010105', NULL, '2020-04-24 22:12:02', 1, 1, 3, 209);
INSERT INTO `cuentas` VALUES (215, 'Devoluciones en Ventas Gravadas', '4010106', NULL, '2020-04-24 22:12:02', 1, 1, 3, 209);
INSERT INTO `cuentas` VALUES (216, 'Servicios', '40102', NULL, '2020-04-24 22:12:02', 1, 1, 3, 208);
INSERT INTO `cuentas` VALUES (217, 'Servicios exentos', '4010201', NULL, '2020-04-24 22:12:02', 1, 1, 3, 216);
INSERT INTO `cuentas` VALUES (218, 'Descuentos en servicios exentos', '4010202', NULL, '2020-04-24 22:12:02', 1, 1, 3, 216);
INSERT INTO `cuentas` VALUES (219, 'Notas de créditos en servicio exentos', '4010203', NULL, '2020-04-24 22:12:02', 1, 1, 3, 216);
INSERT INTO `cuentas` VALUES (220, 'Servicios Gravados', '4010204', NULL, '2020-04-24 22:12:02', 1, 1, 3, 216);
INSERT INTO `cuentas` VALUES (221, 'Descuentos en servicios Gravados', '4010205', NULL, '2020-04-24 22:12:02', 1, 1, 3, 216);
INSERT INTO `cuentas` VALUES (222, 'Notas de créditos en servicio Gravados', '4010206', NULL, '2020-04-24 22:12:02', 1, 1, 3, 216);
INSERT INTO `cuentas` VALUES (223, 'Otras ventas', '402', NULL, '2020-04-24 22:12:02', 1, 1, 3, 207);
INSERT INTO `cuentas` VALUES (224, 'Bienes', '40201', NULL, '2020-04-24 22:12:02', 1, 1, 3, 223);
INSERT INTO `cuentas` VALUES (225, 'Otros Productos Exentos', '4020101', NULL, '2020-04-24 22:12:02', 1, 1, 3, 224);
INSERT INTO `cuentas` VALUES (226, 'Descuentos en otras ventas Exentas', '4020102', NULL, '2020-04-24 22:12:02', 1, 1, 3, 224);
INSERT INTO `cuentas` VALUES (227, 'Devoluciones en otras ventas Exentas', '4020103', NULL, '2020-04-24 22:12:02', 1, 1, 3, 224);
INSERT INTO `cuentas` VALUES (228, 'Otros Productos Gravados', '4020104', NULL, '2020-04-24 22:12:02', 1, 1, 3, 224);
INSERT INTO `cuentas` VALUES (229, 'Descuentos en otras ventas Gravadas', '4020105', NULL, '2020-04-24 22:12:02', 1, 1, 3, 224);
INSERT INTO `cuentas` VALUES (230, 'Devoluciones en otras ventas Gravadas', '4020106', NULL, '2020-04-24 22:12:02', 1, 1, 3, 224);
INSERT INTO `cuentas` VALUES (231, 'Ingresos por Venta Activo fijo', '4020107', NULL, '2020-04-24 22:12:02', 1, 1, 3, 224);
INSERT INTO `cuentas` VALUES (232, 'Servicios', '40202', NULL, '2020-04-24 22:12:02', 1, 1, 3, 223);
INSERT INTO `cuentas` VALUES (233, 'Otros Servicios Exentos', '4020201', NULL, '2020-04-24 22:12:02', 1, 1, 3, 232);
INSERT INTO `cuentas` VALUES (234, 'Descuentos en servicios Exentos', '4020202', NULL, '2020-04-24 22:12:02', 1, 1, 3, 232);
INSERT INTO `cuentas` VALUES (235, 'Notas de créditos en servicio Exentos', '4020203', NULL, '2020-04-24 22:12:02', 1, 1, 3, 232);
INSERT INTO `cuentas` VALUES (236, 'Otros Servicios Gravados', '4020204', NULL, '2020-04-24 22:12:02', 1, 1, 3, 232);
INSERT INTO `cuentas` VALUES (237, 'Descuentos en servicios Gravados', '4020205', NULL, '2020-04-24 22:12:02', 1, 1, 3, 232);
INSERT INTO `cuentas` VALUES (238, 'Notas de créditos en servicio Gravados', '4020206', NULL, '2020-04-24 22:12:02', 1, 1, 3, 232);
INSERT INTO `cuentas` VALUES (239, 'Permutas', '403', NULL, '2020-04-24 22:12:02', 1, 1, 3, 207);
INSERT INTO `cuentas` VALUES (240, 'Permuta de Bienes', '40301', NULL, '2020-04-24 22:12:02', 1, 1, 3, 239);
INSERT INTO `cuentas` VALUES (241, 'Ingreso por Permutas Exentas', '4030101', NULL, '2020-04-24 22:12:02', 1, 1, 3, 240);
INSERT INTO `cuentas` VALUES (242, 'Ingresos por Permutas Gravadas', '4030102', NULL, '2020-04-24 22:12:02', 1, 1, 3, 240);
INSERT INTO `cuentas` VALUES (243, 'Ingresos por Permutas de Activo Fijo', '4030103', NULL, '2020-04-24 22:12:02', 1, 1, 3, 240);
INSERT INTO `cuentas` VALUES (244, 'Permuta de Servicios', '40302', NULL, '2020-04-24 22:12:02', 1, 1, 3, 239);
INSERT INTO `cuentas` VALUES (245, 'Permuta de servicios Exentos', '4030201', NULL, '2020-04-24 22:12:02', 1, 1, 3, 244);
INSERT INTO `cuentas` VALUES (246, 'Permuta de servicios Gravados', '4030202', NULL, '2020-04-24 22:12:02', 1, 1, 3, 244);
INSERT INTO `cuentas` VALUES (247, 'Ventas en especies', '404', NULL, '2020-04-24 22:12:02', 1, 1, 3, 207);
INSERT INTO `cuentas` VALUES (248, 'Bienes', '40401', NULL, '2020-04-24 22:12:02', 1, 1, 3, 247);
INSERT INTO `cuentas` VALUES (249, 'Ventas Exentas (Especies)', '4040101', NULL, '2020-04-24 22:12:02', 1, 1, 3, 248);
INSERT INTO `cuentas` VALUES (250, 'Descuentos en ventas Exentas (Especies)', '4040102', NULL, '2020-04-24 22:12:02', 1, 1, 3, 248);
INSERT INTO `cuentas` VALUES (251, 'Devoluciones en ventas Exentas (Especies)', '4040103', NULL, '2020-04-24 22:12:02', 1, 1, 3, 248);
INSERT INTO `cuentas` VALUES (252, 'Ventas Gravadas (Especies)', '4040104', NULL, '2020-04-24 22:12:03', 1, 1, 3, 248);
INSERT INTO `cuentas` VALUES (253, 'Descuentos en ventas Gravadas (Especies)', '4040105', NULL, '2020-04-24 22:12:03', 1, 1, 3, 248);
INSERT INTO `cuentas` VALUES (254, 'Devoluciones en ventas Gravadas Especies)', '4040106', NULL, '2020-04-24 22:12:03', 1, 1, 3, 248);
INSERT INTO `cuentas` VALUES (255, 'Servicios', '40402', NULL, '2020-04-24 22:12:03', 1, 1, 3, 247);
INSERT INTO `cuentas` VALUES (256, 'Servicios exentos', '4040201', NULL, '2020-04-24 22:12:03', 1, 1, 3, 255);
INSERT INTO `cuentas` VALUES (257, 'Descuentos en servicios Exentos', '4040202', NULL, '2020-04-24 22:12:03', 1, 1, 3, 255);
INSERT INTO `cuentas` VALUES (258, 'Notas de créditos en servicio Exentos', '4040203', NULL, '2020-04-24 22:12:03', 1, 1, 3, 255);
INSERT INTO `cuentas` VALUES (259, 'Servicios Gravados', '4040204', NULL, '2020-04-24 22:12:03', 1, 1, 3, 255);
INSERT INTO `cuentas` VALUES (260, 'Descuentos en servicios Gravados', '4040205', NULL, '2020-04-24 22:12:03', 1, 1, 3, 255);
INSERT INTO `cuentas` VALUES (261, 'Notas de créditos en servicio Gravados', '4040206', NULL, '2020-04-24 22:12:03', 1, 1, 3, 255);
INSERT INTO `cuentas` VALUES (262, 'Otros ingresos', '49901', NULL, '2020-04-24 22:12:03', 1, 1, 3, 207);
INSERT INTO `cuentas` VALUES (263, 'Bancarios', '49901', NULL, '2020-04-24 22:12:03', 1, 1, 3, 262);
INSERT INTO `cuentas` VALUES (264, 'Ingresos por intereses', '4990101', NULL, '2020-04-24 22:12:03', 1, 1, 3, 263);
INSERT INTO `cuentas` VALUES (265, 'Ajustes en ingresos', '49999', NULL, '2020-04-24 22:12:03', 1, 1, 3, 262);
INSERT INTO `cuentas` VALUES (266, 'Ajustes de años anteriores', '4999999', NULL, '2020-04-24 22:12:03', 1, 1, 3, 265);
INSERT INTO `cuentas` VALUES (267, 'Costos', '5', NULL, '2020-04-24 22:24:12', 2, 1, 6, 267);
INSERT INTO `cuentas` VALUES (268, 'Directos', '501', NULL, '2020-04-24 22:24:12', 2, 1, 6, 267);
INSERT INTO `cuentas` VALUES (269, 'Fijos', '50101', NULL, '2020-04-24 22:24:12', 2, 1, 6, 268);
INSERT INTO `cuentas` VALUES (270, 'De Producción ', '5010101', NULL, '2020-04-24 22:24:12', 2, 1, 6, 269);
INSERT INTO `cuentas` VALUES (271, 'Mano de obra', '5010101001', NULL, '2020-04-24 22:24:12', 2, 1, 6, 270);
INSERT INTO `cuentas` VALUES (272, 'Comercialización', '5010102', NULL, '2020-04-24 22:24:12', 2, 1, 6, 269);
INSERT INTO `cuentas` VALUES (273, 'Por Ditribución', '5010103', NULL, '2020-04-24 22:24:12', 2, 1, 6, 269);
INSERT INTO `cuentas` VALUES (274, 'De Administración', '5010104', NULL, '2020-04-24 22:24:12', 2, 1, 6, 269);
INSERT INTO `cuentas` VALUES (275, 'Fletes', '5010104001', NULL, '2020-04-24 22:24:12', 2, 1, 6, 274);
INSERT INTO `cuentas` VALUES (276, 'De Financiamiento', '5010105', NULL, '2020-04-24 22:24:12', 2, 1, 6, 269);
INSERT INTO `cuentas` VALUES (277, 'Variables', '50102', NULL, '2020-04-24 22:24:12', 2, 1, 6, 268);
INSERT INTO `cuentas` VALUES (278, 'De Producción ', '5010201', NULL, '2020-04-24 22:24:12', 2, 1, 6, 277);
INSERT INTO `cuentas` VALUES (279, 'Mano de obra', '5010201001', NULL, '2020-04-24 22:24:12', 2, 1, 6, 278);
INSERT INTO `cuentas` VALUES (280, 'Por Ditribución', '5010202', NULL, '2020-04-24 22:24:12', 2, 1, 6, 277);
INSERT INTO `cuentas` VALUES (281, 'De Administración', '5010203', NULL, '2020-04-24 22:24:12', 2, 1, 6, 277);
INSERT INTO `cuentas` VALUES (282, 'Fletes', '5010203001', NULL, '2020-04-24 22:24:12', 2, 1, 6, 281);
INSERT INTO `cuentas` VALUES (283, 'De Financiamiento', '5010204', NULL, '2020-04-24 22:24:12', 2, 1, 6, 277);
INSERT INTO `cuentas` VALUES (284, 'Indirectos', '502', NULL, '2020-04-24 22:24:12', 2, 1, 6, 267);
INSERT INTO `cuentas` VALUES (285, 'Fijos', '50201', NULL, '2020-04-24 22:24:12', 2, 1, 6, 284);
INSERT INTO `cuentas` VALUES (286, 'De Producción ', '5020101', NULL, '2020-04-24 22:24:12', 2, 1, 6, 285);
INSERT INTO `cuentas` VALUES (287, 'Mano de obra', '5020101001', NULL, '2020-04-24 22:24:12', 2, 1, 6, 286);
INSERT INTO `cuentas` VALUES (288, 'Comercialización', '5020102', NULL, '2020-04-24 22:24:12', 2, 1, 6, 285);
INSERT INTO `cuentas` VALUES (289, 'Por Ditribución', '5020103', NULL, '2020-04-24 22:24:12', 2, 1, 6, 285);
INSERT INTO `cuentas` VALUES (290, 'De Administración', '5020104', NULL, '2020-04-24 22:24:12', 2, 1, 6, 285);
INSERT INTO `cuentas` VALUES (291, 'Fletes', '5020104001', NULL, '2020-04-24 22:24:12', 2, 1, 6, 290);
INSERT INTO `cuentas` VALUES (292, 'De Financiamiento', '5020105', NULL, '2020-04-24 22:24:12', 2, 1, 6, 285);
INSERT INTO `cuentas` VALUES (293, 'Variables', '50202', NULL, '2020-04-24 22:24:12', 2, 1, 6, 284);
INSERT INTO `cuentas` VALUES (294, 'De Producción ', '5020201', NULL, '2020-04-24 22:24:12', 2, 1, 6, 293);
INSERT INTO `cuentas` VALUES (295, 'Mano de obra', '5020201001', NULL, '2020-04-24 22:24:12', 2, 1, 6, 294);
INSERT INTO `cuentas` VALUES (296, 'Por Ditribución', '5020202', NULL, '2020-04-24 22:24:12', 2, 1, 6, 293);
INSERT INTO `cuentas` VALUES (297, 'De Administración', '5020203', NULL, '2020-04-24 22:24:12', 2, 1, 6, 293);
INSERT INTO `cuentas` VALUES (298, 'Fletes', '5020203001', NULL, '2020-04-24 22:24:12', 2, 1, 6, 297);
INSERT INTO `cuentas` VALUES (299, 'De Financiamiento', '5020204', NULL, '2020-04-24 22:24:12', 2, 1, 6, 293);
INSERT INTO `cuentas` VALUES (300, 'Gastos', '6', NULL, '2020-04-24 22:33:15', 2, 1, 2, 300);
INSERT INTO `cuentas` VALUES (301, 'De Producción ', '601', NULL, '2020-04-24 22:33:15', 2, 1, 2, 300);
INSERT INTO `cuentas` VALUES (302, 'Departamento Producción', '60101', NULL, '2020-04-24 22:33:15', 2, 1, 2, 301);
INSERT INTO `cuentas` VALUES (303, 'Gastos laboral', '6010101', NULL, '2020-04-24 22:33:15', 2, 1, 2, 302);
INSERT INTO `cuentas` VALUES (304, 'Sueldos', '6010101001', NULL, '2020-04-24 22:33:15', 2, 1, 2, 303);
INSERT INTO `cuentas` VALUES (305, 'Horas extraordinarias', '6010101002', NULL, '2020-04-24 22:33:15', 2, 1, 2, 303);
INSERT INTO `cuentas` VALUES (306, 'Vacaciones', '6010101003', NULL, '2020-04-24 22:33:15', 2, 1, 2, 303);
INSERT INTO `cuentas` VALUES (307, 'Bono vacacional', '6010101004', NULL, '2020-04-24 22:33:15', 2, 1, 2, 303);
INSERT INTO `cuentas` VALUES (308, 'Utilidades', '6010101005', NULL, '2020-04-24 22:33:15', 2, 1, 2, 303);
INSERT INTO `cuentas` VALUES (309, 'Prestaciones Antigüedad', '6010101006', NULL, '2020-04-24 22:33:15', 2, 1, 2, 303);
INSERT INTO `cuentas` VALUES (310, 'Intereses sobres Prestaciones Antigüedad', '6010101007', NULL, '2020-04-24 22:33:15', 2, 1, 2, 303);
INSERT INTO `cuentas` VALUES (311, 'Bono por antigüedad', '6010101008', NULL, '2020-04-24 22:33:15', 2, 1, 2, 303);
INSERT INTO `cuentas` VALUES (312, 'Bono', '6010101009', NULL, '2020-04-24 22:33:15', 2, 1, 2, 303);
INSERT INTO `cuentas` VALUES (313, 'Bono para alimentación', '6010101010', NULL, '2020-04-24 22:33:15', 2, 1, 2, 303);
INSERT INTO `cuentas` VALUES (314, 'Feriados', '6010101011', NULL, '2020-04-24 22:33:15', 2, 1, 2, 303);
INSERT INTO `cuentas` VALUES (315, 'Agasajos', '6010101012', NULL, '2020-04-24 22:33:15', 2, 1, 2, 303);
INSERT INTO `cuentas` VALUES (316, 'Donaciones', '6010101013', NULL, '2020-04-24 22:33:15', 2, 1, 2, 303);
INSERT INTO `cuentas` VALUES (317, 'Seguro y gastos médicos', '6010101014', NULL, '2020-04-24 22:33:15', 2, 1, 2, 303);
INSERT INTO `cuentas` VALUES (318, 'Viaticos', '6010102', NULL, '2020-04-24 22:33:15', 2, 1, 2, 302);
INSERT INTO `cuentas` VALUES (319, 'Hospedaje', '6010102001', NULL, '2020-04-24 22:33:15', 2, 1, 2, 318);
INSERT INTO `cuentas` VALUES (320, 'Estacionamiento', '6010102002', NULL, '2020-04-24 22:33:15', 2, 1, 2, 318);
INSERT INTO `cuentas` VALUES (321, 'Alimentación', '6010102003', NULL, '2020-04-24 22:33:15', 2, 1, 2, 318);
INSERT INTO `cuentas` VALUES (322, 'Gastos de representación', '6010102004', NULL, '2020-04-24 22:33:15', 2, 1, 2, 318);
INSERT INTO `cuentas` VALUES (323, 'Transporte', '6010102005', NULL, '2020-04-24 22:33:15', 2, 1, 2, 318);
INSERT INTO `cuentas` VALUES (324, 'Teléfono', '6010102006', NULL, '2020-04-24 22:33:15', 2, 1, 2, 318);
INSERT INTO `cuentas` VALUES (325, 'De Ventas', '602', NULL, '2020-04-24 22:33:15', 2, 1, 2, 300);
INSERT INTO `cuentas` VALUES (326, 'Departamento Comercialización', '60201', NULL, '2020-04-24 22:33:15', 2, 1, 2, 325);
INSERT INTO `cuentas` VALUES (327, 'Gastos laboral', '6020101', NULL, '2020-04-24 22:33:15', 2, 1, 2, 326);
INSERT INTO `cuentas` VALUES (328, 'Sueldos', '6020101001', NULL, '2020-04-24 22:33:15', 2, 1, 2, 327);
INSERT INTO `cuentas` VALUES (329, 'Horas extraordinarias', '6020101002', NULL, '2020-04-24 22:33:15', 2, 1, 2, 327);
INSERT INTO `cuentas` VALUES (330, 'Vacaciones', '6020101003', NULL, '2020-04-24 22:33:15', 2, 1, 2, 327);
INSERT INTO `cuentas` VALUES (331, 'Bono vacacional', '6020101004', NULL, '2020-04-24 22:33:15', 2, 1, 2, 327);
INSERT INTO `cuentas` VALUES (332, 'Utilidades', '6020101005', NULL, '2020-04-24 22:33:15', 2, 1, 2, 327);
INSERT INTO `cuentas` VALUES (333, 'Prestaciones Antigüedad', '6020101006', NULL, '2020-04-24 22:33:15', 2, 1, 2, 327);
INSERT INTO `cuentas` VALUES (334, 'Intereses sobres Prestaciones Antigüedad', '6020101007', NULL, '2020-04-24 22:33:15', 2, 1, 2, 327);
INSERT INTO `cuentas` VALUES (335, 'Bono por antigüedad', '6020101008', NULL, '2020-04-24 22:33:15', 2, 1, 2, 327);
INSERT INTO `cuentas` VALUES (336, 'Bono', '6020101009', NULL, '2020-04-24 22:33:15', 2, 1, 2, 327);
INSERT INTO `cuentas` VALUES (337, 'Bono para alimentación', '6020101010', NULL, '2020-04-24 22:33:15', 2, 1, 2, 327);
INSERT INTO `cuentas` VALUES (338, 'Feriados', '6020101011', NULL, '2020-04-24 22:33:15', 2, 1, 2, 327);
INSERT INTO `cuentas` VALUES (339, 'Agasajos', '6020101012', NULL, '2020-04-24 22:33:15', 2, 1, 2, 327);
INSERT INTO `cuentas` VALUES (340, 'Donaciones', '6020101013', NULL, '2020-04-24 22:33:15', 2, 1, 2, 327);
INSERT INTO `cuentas` VALUES (341, 'Seguro y gastos médicos', '6020101014', NULL, '2020-04-24 22:33:15', 2, 1, 2, 327);
INSERT INTO `cuentas` VALUES (342, 'Viáticos', '6020102', NULL, '2020-04-24 22:33:15', 2, 1, 2, 326);
INSERT INTO `cuentas` VALUES (343, 'Hospedaje', '6020102001', NULL, '2020-04-24 22:33:15', 2, 1, 2, 342);
INSERT INTO `cuentas` VALUES (344, 'Estacionamiento', '6020102002', NULL, '2020-04-24 22:33:15', 2, 1, 2, 342);
INSERT INTO `cuentas` VALUES (345, 'Alimentación', '6020102003', NULL, '2020-04-24 22:33:15', 2, 1, 2, 342);
INSERT INTO `cuentas` VALUES (346, 'Gastos de representación', '6020102004', NULL, '2020-04-24 22:33:15', 2, 1, 2, 342);
INSERT INTO `cuentas` VALUES (347, 'Transporte', '6020102005', NULL, '2020-04-24 22:33:15', 2, 1, 2, 342);
INSERT INTO `cuentas` VALUES (348, 'Teléfono', '6020102006', NULL, '2020-04-24 22:33:15', 2, 1, 2, 342);
INSERT INTO `cuentas` VALUES (349, 'Eventos', '6020103', NULL, '2020-04-24 22:33:15', 2, 1, 2, 326);
INSERT INTO `cuentas` VALUES (350, 'Stand', '6020103001', NULL, '2020-04-24 22:33:15', 2, 1, 2, 349);
INSERT INTO `cuentas` VALUES (351, 'De Administración', '603', NULL, '2020-04-24 22:33:15', 2, 1, 2, 300);
INSERT INTO `cuentas` VALUES (352, 'Departamento de administración', '60301', NULL, '2020-04-24 22:33:15', 2, 1, 2, 351);
INSERT INTO `cuentas` VALUES (353, 'Servicios básicos', '6030101', NULL, '2020-04-24 22:33:15', 2, 1, 2, 352);
INSERT INTO `cuentas` VALUES (354, 'Alquiler', '6030101001', NULL, '2020-04-24 22:33:15', 2, 1, 2, 353);
INSERT INTO `cuentas` VALUES (355, 'Teléfono', '6030101002', NULL, '2020-04-24 22:33:15', 2, 1, 2, 353);
INSERT INTO `cuentas` VALUES (356, 'Electricidad', '6030101003', NULL, '2020-04-24 22:33:15', 2, 1, 2, 353);
INSERT INTO `cuentas` VALUES (357, 'Aseo Urbano', '6030101004', NULL, '2020-04-24 22:33:15', 2, 1, 2, 353);
INSERT INTO `cuentas` VALUES (358, 'Otros', '6030101999', NULL, '2020-04-24 22:33:15', 2, 1, 2, 353);
INSERT INTO `cuentas` VALUES (359, 'Implementos de oficina', '6030102', NULL, '2020-04-24 22:33:15', 2, 1, 2, 352);
INSERT INTO `cuentas` VALUES (360, 'Papelería y material', '6030102001', NULL, '2020-04-24 22:33:15', 2, 1, 2, 359);
INSERT INTO `cuentas` VALUES (361, 'Fotocopias', '6030102002', NULL, '2020-04-24 22:33:15', 2, 1, 2, 359);
INSERT INTO `cuentas` VALUES (362, 'Artículos de oficina', '6030102003', NULL, '2020-04-24 22:33:15', 2, 1, 2, 359);
INSERT INTO `cuentas` VALUES (363, 'Uniformes', '6030102004', NULL, '2020-04-24 22:33:15', 2, 1, 2, 359);
INSERT INTO `cuentas` VALUES (364, 'Empaques', '6030102005', NULL, '2020-04-24 22:33:15', 2, 1, 2, 359);
INSERT INTO `cuentas` VALUES (365, 'Gestiones', '6030103', NULL, '2020-04-24 22:33:15', 2, 1, 2, 352);
INSERT INTO `cuentas` VALUES (366, 'Correspondencia / encomiendas', '6030103001', NULL, '2020-04-24 22:33:15', 2, 1, 2, 365);
INSERT INTO `cuentas` VALUES (367, 'Gastos por gestiones', '6030103002', NULL, '2020-04-24 22:33:15', 2, 1, 2, 365);
INSERT INTO `cuentas` VALUES (368, 'Limpieza y mantenimiento', '6030103003', NULL, '2020-04-24 22:33:15', 2, 1, 2, 365);
INSERT INTO `cuentas` VALUES (369, 'Publicidad y propaganda', '6030103004', NULL, '2020-04-24 22:33:15', 2, 1, 2, 365);
INSERT INTO `cuentas` VALUES (370, 'Notaria y registro', '6030103005', NULL, '2020-04-24 22:33:15', 2, 1, 2, 365);
INSERT INTO `cuentas` VALUES (371, 'Honorarios', '6030103006', NULL, '2020-04-24 22:33:15', 2, 1, 2, 365);
INSERT INTO `cuentas` VALUES (372, 'Muebles y enseres', '6030104', NULL, '2020-04-24 22:33:15', 2, 1, 2, 352);
INSERT INTO `cuentas` VALUES (373, 'Equipos de computación', '6030104001', NULL, '2020-04-24 22:33:15', 2, 1, 2, 372);
INSERT INTO `cuentas` VALUES (374, 'Mobiliario', '6030104002', NULL, '2020-04-24 22:33:15', 2, 1, 2, 372);
INSERT INTO `cuentas` VALUES (375, 'Gastos de personal', '6030105', NULL, '2020-04-24 22:33:15', 2, 1, 2, 352);
INSERT INTO `cuentas` VALUES (376, 'Sueldos', '6030105001', NULL, '2020-04-24 22:33:15', 2, 1, 2, 375);
INSERT INTO `cuentas` VALUES (377, 'Horas extraordinarias', '6030105002', NULL, '2020-04-24 22:33:15', 2, 1, 2, 375);
INSERT INTO `cuentas` VALUES (378, 'Vacaciones', '6030105003', NULL, '2020-04-24 22:33:15', 2, 1, 2, 375);
INSERT INTO `cuentas` VALUES (379, 'Bono vacacional', '6030105004', NULL, '2020-04-24 22:33:15', 2, 1, 2, 375);
INSERT INTO `cuentas` VALUES (380, 'Utilidades', '6030105005', NULL, '2020-04-24 22:33:15', 2, 1, 2, 375);
INSERT INTO `cuentas` VALUES (381, 'Prestaciones Antigüedad', '6030105006', NULL, '2020-04-24 22:33:15', 2, 1, 2, 375);
INSERT INTO `cuentas` VALUES (382, 'Intereses sobres Prestaciones Antigüedad', '6030105007', NULL, '2020-04-24 22:33:15', 2, 1, 2, 375);
INSERT INTO `cuentas` VALUES (383, 'Bono por antigüedad', '6030105008', NULL, '2020-04-24 22:33:15', 2, 1, 2, 375);
INSERT INTO `cuentas` VALUES (384, 'Bono', '6030105009', NULL, '2020-04-24 22:33:15', 2, 1, 2, 375);
INSERT INTO `cuentas` VALUES (385, 'Bono para alimentación', '6030105010', NULL, '2020-04-24 22:33:15', 2, 1, 2, 375);
INSERT INTO `cuentas` VALUES (386, 'Feriados', '6030105011', NULL, '2020-04-24 22:33:15', 2, 1, 2, 375);
INSERT INTO `cuentas` VALUES (387, 'Agasajos', '6030105012', NULL, '2020-04-24 22:33:15', 2, 1, 2, 375);
INSERT INTO `cuentas` VALUES (388, 'Donaciones', '6030105013', NULL, '2020-04-24 22:33:15', 2, 1, 2, 375);
INSERT INTO `cuentas` VALUES (389, 'Seguro y gastos médicos', '6030105014', NULL, '2020-04-24 22:33:15', 2, 1, 2, 375);
INSERT INTO `cuentas` VALUES (390, 'I.V.S.S. (Seguro Social Obligatorio)', '6030105015', NULL, '2020-04-24 22:33:15', 2, 1, 2, 375);
INSERT INTO `cuentas` VALUES (391, 'Pérdida Involuntaria del Empleo (P.I.E.)', '6030105016', NULL, '2020-04-24 22:33:15', 2, 1, 2, 375);
INSERT INTO `cuentas` VALUES (392, 'Banavih / Faov', '6030105017', NULL, '2020-04-24 22:33:15', 2, 1, 2, 375);
INSERT INTO `cuentas` VALUES (393, 'I.N.C.E.S.', '6030105018', NULL, '2020-04-24 22:33:15', 2, 1, 2, 375);
INSERT INTO `cuentas` VALUES (394, 'Viáticos', '6030106', NULL, '2020-04-24 22:33:15', 2, 1, 2, 352);
INSERT INTO `cuentas` VALUES (395, 'Hospedaje', '6030106001', NULL, '2020-04-24 22:33:15', 2, 1, 2, 394);
INSERT INTO `cuentas` VALUES (396, 'Estacionamiento', '6030106002', NULL, '2020-04-24 22:33:15', 2, 1, 2, 394);
INSERT INTO `cuentas` VALUES (397, 'Alimentación', '6030106003', NULL, '2020-04-24 22:33:15', 2, 1, 2, 394);
INSERT INTO `cuentas` VALUES (398, 'Gastos de representación', '6030106004', NULL, '2020-04-24 22:33:15', 2, 1, 2, 394);
INSERT INTO `cuentas` VALUES (399, 'Transporte', '6030106005', NULL, '2020-04-24 22:33:15', 2, 1, 2, 394);
INSERT INTO `cuentas` VALUES (400, 'Depreciación', '6030107', NULL, '2020-04-24 22:33:15', 2, 1, 2, 352);
INSERT INTO `cuentas` VALUES (401, 'Depreciación de edificios', '6030107001', NULL, '2020-04-24 22:33:15', 2, 1, 2, 400);
INSERT INTO `cuentas` VALUES (402, 'Depreciación Vehículos Automotores', '6030107002', NULL, '2020-04-24 22:33:15', 2, 1, 2, 400);
INSERT INTO `cuentas` VALUES (403, 'Depreciación Vehículos automotores de carga', '6030107003', NULL, '2020-04-24 22:33:15', 2, 1, 2, 400);
INSERT INTO `cuentas` VALUES (404, 'Depreciación Vehículos de trasmisión mecánica', '6030107004', NULL, '2020-04-24 22:33:15', 2, 1, 2, 400);
INSERT INTO `cuentas` VALUES (405, 'Depreciación Maquinaria pesada', '6030107005', NULL, '2020-04-24 22:33:15', 2, 1, 2, 400);
INSERT INTO `cuentas` VALUES (406, 'Depreciación de Muebles', '6030107006', NULL, '2020-04-24 22:33:15', 2, 1, 2, 400);
INSERT INTO `cuentas` VALUES (407, 'Depreciación de Equipos de oficina', '6030107007', NULL, '2020-04-24 22:33:15', 2, 1, 2, 400);
INSERT INTO `cuentas` VALUES (408, 'Obsolescencia', '6030108', NULL, '2020-04-24 22:33:15', 2, 1, 2, 352);
INSERT INTO `cuentas` VALUES (409, 'Obsolescencia Vehículos Automotores', '6030108001', NULL, '2020-04-24 22:33:15', 2, 1, 2, 408);
INSERT INTO `cuentas` VALUES (410, 'Obsolescencia Vehículos automotores de carga', '6030108002', NULL, '2020-04-24 22:33:15', 2, 1, 2, 408);
INSERT INTO `cuentas` VALUES (411, 'Obsolescencia Vehículos de trasmisión mecánica', '6030108003', NULL, '2020-04-24 22:33:15', 2, 1, 2, 408);
INSERT INTO `cuentas` VALUES (412, 'Obsolescencia Maquinaria pesada', '6030108004', NULL, '2020-04-24 22:33:15', 2, 1, 2, 408);
INSERT INTO `cuentas` VALUES (413, 'Obsolescencia de Muebles', '6030108005', NULL, '2020-04-24 22:33:15', 2, 1, 2, 408);
INSERT INTO `cuentas` VALUES (414, 'Obsolescencia de Equipos de oficina', '6030108006', NULL, '2020-04-24 22:33:15', 2, 1, 2, 408);
INSERT INTO `cuentas` VALUES (415, 'Amortizaciones', '6030109', NULL, '2020-04-24 22:33:15', 2, 1, 2, 352);
INSERT INTO `cuentas` VALUES (416, 'Amortización derechos de autor', '6030109001', NULL, '2020-04-24 22:33:15', 2, 1, 2, 415);
INSERT INTO `cuentas` VALUES (417, 'Amortización franquicias', '6030109002', NULL, '2020-04-24 22:33:15', 2, 1, 2, 415);
INSERT INTO `cuentas` VALUES (418, 'Amortización marcas de fabrica', '6030109003', NULL, '2020-04-24 22:33:15', 2, 1, 2, 415);
INSERT INTO `cuentas` VALUES (419, 'Amortización patentes', '6030109004', NULL, '2020-04-24 22:33:15', 2, 1, 2, 415);
INSERT INTO `cuentas` VALUES (420, 'Amortización plusvalía', '6030109005', NULL, '2020-04-24 22:33:15', 2, 1, 2, 415);
INSERT INTO `cuentas` VALUES (421, 'Amortización Software', '6030109006', NULL, '2020-04-24 22:33:15', 2, 1, 2, 415);
INSERT INTO `cuentas` VALUES (422, 'Mantenimiento', '6030110', NULL, '2020-04-24 22:33:15', 2, 1, 2, 352);
INSERT INTO `cuentas` VALUES (423, 'Mantenimiento de Vehículos', '6030110001', NULL, '2020-04-24 22:33:15', 2, 1, 2, 422);
INSERT INTO `cuentas` VALUES (424, 'Mantenimiento de Mobiliario', '6030110002', NULL, '2020-04-24 22:33:15', 2, 1, 2, 422);
INSERT INTO `cuentas` VALUES (425, 'Mantenimiento de Equipo', '6030110003', NULL, '2020-04-24 22:33:15', 2, 1, 2, 422);
INSERT INTO `cuentas` VALUES (426, 'Reparaciones', '6030111', NULL, '2020-04-24 22:33:15', 2, 1, 2, 352);
INSERT INTO `cuentas` VALUES (427, 'Reparaciones de Vehículos', '6030111001', NULL, '2020-04-24 22:33:15', 2, 1, 2, 426);
INSERT INTO `cuentas` VALUES (428, 'Reparaciones de Mobiliario', '6030111002', NULL, '2020-04-24 22:33:15', 2, 1, 2, 426);
INSERT INTO `cuentas` VALUES (429, 'Reparaciones de Equipo', '6030111003', NULL, '2020-04-24 22:33:15', 2, 1, 2, 426);
INSERT INTO `cuentas` VALUES (430, 'Resguardo y Vigilancia', '6030112', NULL, '2020-04-24 22:33:15', 2, 1, 2, 352);
INSERT INTO `cuentas` VALUES (431, 'Vigilancia', '6030112001', NULL, '2020-04-24 22:33:15', 2, 1, 2, 430);
INSERT INTO `cuentas` VALUES (432, 'Equipo de vigilancia (Tecnologíco)', '6030112002', NULL, '2020-04-24 22:33:15', 2, 1, 2, 430);
INSERT INTO `cuentas` VALUES (433, 'Suministros para la vigilancia', '6030112003', NULL, '2020-04-24 22:33:15', 2, 1, 2, 430);
INSERT INTO `cuentas` VALUES (434, 'Polizas de Seguros', '6030113', NULL, '2020-04-24 22:33:15', 2, 1, 2, 352);
INSERT INTO `cuentas` VALUES (435, 'Seguro de edificios', '6030113001', NULL, '2020-04-24 22:33:15', 2, 1, 2, 434);
INSERT INTO `cuentas` VALUES (436, 'Seguro Vehículos Automotores', '6030113002', NULL, '2020-04-24 22:33:15', 2, 1, 2, 434);
INSERT INTO `cuentas` VALUES (437, 'Seguro Vehículos automotores de carga', '6030113003', NULL, '2020-04-24 22:33:15', 2, 1, 2, 434);
INSERT INTO `cuentas` VALUES (438, 'Seguro Vehículos de trasmisión mecánica', '6030113004', NULL, '2020-04-24 22:33:15', 2, 1, 2, 434);
INSERT INTO `cuentas` VALUES (439, 'Seguro Maquinaria pesada', '6030113005', NULL, '2020-04-24 22:33:15', 2, 1, 2, 434);
INSERT INTO `cuentas` VALUES (440, 'Seguro de Muebles', '6030113006', NULL, '2020-04-24 22:33:15', 2, 1, 2, 434);
INSERT INTO `cuentas` VALUES (441, 'Seguro de Equipos de oficina', '6030113007', NULL, '2020-04-24 22:33:15', 2, 1, 2, 434);
INSERT INTO `cuentas` VALUES (442, 'Gastos Bancarios', '6030198', NULL, '2020-04-24 22:33:15', 2, 1, 2, 352);
INSERT INTO `cuentas` VALUES (443, 'Gastos bancarios', '6030198001', NULL, '2020-04-24 22:33:15', 2, 1, 2, 442);
INSERT INTO `cuentas` VALUES (444, 'Comisión', '6030198002', NULL, '2020-04-24 22:33:15', 2, 1, 2, 442);
INSERT INTO `cuentas` VALUES (445, 'Intereses sobre prestamos', '6030198003', NULL, '2020-04-24 22:33:15', 2, 1, 2, 442);
INSERT INTO `cuentas` VALUES (446, 'Comisión punto de venta', '6030198004', NULL, '2020-04-24 22:33:15', 2, 1, 2, 442);
INSERT INTO `cuentas` VALUES (447, 'Tributos nacionales', '6030199', NULL, '2020-04-24 22:33:15', 2, 1, 2, 352);
INSERT INTO `cuentas` VALUES (448, 'Impuestos vehículos', '6030199001', NULL, '2020-04-24 22:33:15', 2, 1, 2, 447);
INSERT INTO `cuentas` VALUES (449, 'Notaria y registro', '6030199002', NULL, '2020-04-24 22:33:15', 2, 1, 2, 447);
INSERT INTO `cuentas` VALUES (450, 'I.S.L.R.', '6030199003', NULL, '2020-04-24 22:33:15', 2, 1, 2, 447);
INSERT INTO `cuentas` VALUES (451, 'Patente de industria y comercio', '6030199004', NULL, '2020-04-24 22:33:15', 2, 1, 2, 447);
INSERT INTO `cuentas` VALUES (452, 'Impuesto por publicidad', '6030199005', NULL, '2020-04-24 22:33:15', 2, 1, 2, 447);
INSERT INTO `cuentas` VALUES (453, 'Multas', '6030199999', NULL, '2020-04-24 22:33:15', 2, 1, 2, 447);

-- ----------------------------
-- Table structure for departamento
-- ----------------------------
DROP TABLE IF EXISTS `departamento`;
CREATE TABLE `departamento`  (
  `Id_Dep` int NOT NULL AUTO_INCREMENT,
  `Nombre_Dep` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Codigo_Dep` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Id_Dep`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 34 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of departamento
-- ----------------------------
INSERT INTO `departamento` VALUES (1, 'Antioquia', '5');
INSERT INTO `departamento` VALUES (2, 'Atlantico', '8');
INSERT INTO `departamento` VALUES (3, 'D. C. Santa Fe de Bogotá', '11');
INSERT INTO `departamento` VALUES (4, 'Bolivar', '13');
INSERT INTO `departamento` VALUES (5, 'Boyaca', '15');
INSERT INTO `departamento` VALUES (6, 'Caldas', '17');
INSERT INTO `departamento` VALUES (7, 'Caqueta', '18');
INSERT INTO `departamento` VALUES (8, 'Cauca', '19');
INSERT INTO `departamento` VALUES (9, 'Cesar', '20');
INSERT INTO `departamento` VALUES (10, 'Cordova', '23');
INSERT INTO `departamento` VALUES (11, 'Cundinamarca', '25');
INSERT INTO `departamento` VALUES (12, 'Choco', '27');
INSERT INTO `departamento` VALUES (13, 'Huila', '41');
INSERT INTO `departamento` VALUES (14, 'La Guajira', '44');
INSERT INTO `departamento` VALUES (15, 'Magdalena', '47');
INSERT INTO `departamento` VALUES (16, 'Meta', '50');
INSERT INTO `departamento` VALUES (17, 'Nariño', '52');
INSERT INTO `departamento` VALUES (18, 'Norte de Santander', '54');
INSERT INTO `departamento` VALUES (19, 'Quindio', '63');
INSERT INTO `departamento` VALUES (20, 'Risaralda', '66');
INSERT INTO `departamento` VALUES (21, 'Santander', '68');
INSERT INTO `departamento` VALUES (22, 'Sucre', '70');
INSERT INTO `departamento` VALUES (23, 'Tolima', '73');
INSERT INTO `departamento` VALUES (24, 'Valle', '76');
INSERT INTO `departamento` VALUES (25, 'Arauca', '81');
INSERT INTO `departamento` VALUES (26, 'Casanare', '85');
INSERT INTO `departamento` VALUES (27, 'Putumayo', '86');
INSERT INTO `departamento` VALUES (28, 'San Andres', '88');
INSERT INTO `departamento` VALUES (29, 'Amazonas', '91');
INSERT INTO `departamento` VALUES (30, 'Guainia', '94');
INSERT INTO `departamento` VALUES (31, 'Guaviare', '95');
INSERT INTO `departamento` VALUES (32, 'Vaupes', '97');
INSERT INTO `departamento` VALUES (33, 'Vichada', '99');

-- ----------------------------
-- Table structure for documento
-- ----------------------------
DROP TABLE IF EXISTS `documento`;
CREATE TABLE `documento`  (
  `Id_Doc` int NOT NULL AUTO_INCREMENT,
  `FechaRegistro_Doc` timestamp NULL DEFAULT current_timestamp,
  `Numero_Doc` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `FechaDocumento_Doc` datetime NULL DEFAULT NULL,
  `FechaVencimiento_Doc` datetime NULL DEFAULT NULL,
  `Observacion_Doc` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `IvaIncluido_Doc` tinyint NULL DEFAULT NULL,
  `Id_Per` int NULL DEFAULT NULL COMMENT 'Cliente, tercero o remitente del documento',
  `Id_Usu` int NULL DEFAULT NULL COMMENT 'Usuario que registra el documento',
  `Id_DocTip` int NULL DEFAULT NULL,
  `Id_DocEst` int NULL DEFAULT NULL,
  `Id_TerPag` int NULL DEFAULT NULL,
  `Primary_Usu` int NULL DEFAULT NULL,
  PRIMARY KEY (`Id_Doc`) USING BTREE,
  INDEX `fk_documento_persona1_idx`(`Id_Per`) USING BTREE,
  INDEX `fk_documento_usuario1_idx`(`Id_Usu`) USING BTREE,
  INDEX `fk_documento_documento_tipo1_idx`(`Id_DocTip`) USING BTREE,
  INDEX `fk_documento_documento_estado1_idx`(`Id_DocEst`) USING BTREE,
  INDEX `fk_documento_termino_pago1_idx`(`Id_TerPag`) USING BTREE,
  CONSTRAINT `fk_documento_documento_estado1` FOREIGN KEY (`Id_DocEst`) REFERENCES `documento_estado` (`Id_DocEst`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_documento_documento_tipo1` FOREIGN KEY (`Id_DocTip`) REFERENCES `documento_tipo` (`Id_DocTip`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_documento_persona1` FOREIGN KEY (`Id_Per`) REFERENCES `persona` (`Id_Per`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_documento_termino_pago1` FOREIGN KEY (`Id_TerPag`) REFERENCES `termino_pago` (`Id_TerPag`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_documento_usuario1` FOREIGN KEY (`Id_Usu`) REFERENCES `usuario` (`Id_Usu`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 45 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of documento
-- ----------------------------
INSERT INTO `documento` VALUES (4, '2020-04-11 21:04:35', 'CM-1', '2020-04-11 00:00:00', '2020-04-26 00:00:00', 'Esta es una factura de compra', 1, 2, 1, 2, 3, 4, 1);
INSERT INTO `documento` VALUES (5, '2020-04-11 21:04:26', 'CM-2', '2020-04-11 00:00:00', '2020-04-11 00:00:00', 'Esta es la factura de venta #2', 0, 1, 1, 2, 2, 2, 1);
INSERT INTO `documento` VALUES (6, '2020-04-11 21:04:18', 'CM-3', '2020-04-11 00:00:00', '2020-04-26 00:00:00', 'Esta es la factura de compra #3', 1, 1, 1, 2, 5, 4, 1);
INSERT INTO `documento` VALUES (7, '2020-04-11 23:04:20', 'CM-4', '2020-04-11 00:00:00', '2020-04-11 00:00:00', NULL, 1, 1, 1, 1, 3, 2, 1);
INSERT INTO `documento` VALUES (8, '2020-04-11 23:04:11', 'CM-4', '2020-04-11 00:00:00', '2020-04-11 00:00:00', NULL, 1, 1, 1, 1, 3, 2, 1);
INSERT INTO `documento` VALUES (9, '2020-04-11 23:04:31', 'CM-4', '2020-04-11 00:00:00', '2020-04-11 00:00:00', NULL, 1, 1, 1, 1, 1, 2, 1);
INSERT INTO `documento` VALUES (10, '2020-04-11 23:04:44', 'CM-5', '2020-04-11 00:00:00', '2020-04-11 00:00:00', NULL, 1, 2, 1, 2, 3, 2, 1);
INSERT INTO `documento` VALUES (11, '2020-04-11 23:04:21', 'CM-5', '2020-04-11 00:00:00', '2020-04-11 00:00:00', NULL, 1, 2, 1, 2, 4, 2, 1);
INSERT INTO `documento` VALUES (12, '2020-04-11 23:04:39', 'CM-5', '2020-04-11 00:00:00', '2020-04-11 00:00:00', NULL, NULL, 2, 1, 2, 1, 2, 1);
INSERT INTO `documento` VALUES (13, '2020-04-11 23:04:59', 'CM-5', '2020-04-11 00:00:00', '2020-04-26 00:00:00', NULL, 1, 2, 1, 2, 5, 4, 1);
INSERT INTO `documento` VALUES (14, '2020-04-11 23:04:39', 'CM-6', '2020-04-11 00:00:00', '2020-04-11 00:00:00', 'Test de modificación', NULL, 2, 1, 2, 3, 2, 1);
INSERT INTO `documento` VALUES (15, '2020-04-14 17:04:38', 'FV-1', '2020-04-14 00:00:00', '2020-04-14 00:00:00', NULL, 1, 1, 1, 1, 5, 2, 1);
INSERT INTO `documento` VALUES (16, '2020-04-14 17:04:54', 'FV-1', '2020-04-14 00:00:00', '2020-04-14 00:00:00', 'Esta es una FV-01', 1, 6, 7, 1, 1, 1, 7);
INSERT INTO `documento` VALUES (17, '2020-04-27 10:04:02', '1234', '2020-04-27 00:00:00', '2020-05-12 00:00:00', NULL, 0, 5, 7, 1, 6, 3, 7);
INSERT INTO `documento` VALUES (18, '2020-04-27 10:04:47', 'A1234', '2020-04-27 00:00:00', '2020-05-12 00:00:00', NULL, 1, 5, 7, 2, 2, 3, 7);
INSERT INTO `documento` VALUES (19, '2020-04-27 10:04:19', 'B1234', '2020-04-27 00:00:00', '2020-05-12 00:00:00', NULL, 0, 5, 7, 2, 3, 3, 7);
INSERT INTO `documento` VALUES (20, '2020-04-27 10:04:15', 'C1234', '2020-04-27 00:00:00', '2020-04-27 00:00:00', NULL, 0, 5, 7, 2, 6, 1, 7);
INSERT INTO `documento` VALUES (21, '2020-04-27 10:04:49', 'A1111', '2020-04-27 00:00:00', '2020-05-12 00:00:00', NULL, 1, 5, 7, 1, 1, 3, 7);
INSERT INTO `documento` VALUES (22, '2020-05-08 14:05:11', 'FV-2', '2020-05-08 00:00:00', '2020-05-23 00:00:00', 'Factura prueba de pago', 1, 1, 1, 1, 5, 4, 1);
INSERT INTO `documento` VALUES (23, '2020-05-10 19:05:17', 'FV-6', '2020-05-10 00:00:00', '2020-05-10 00:00:00', NULL, 1, 7, 1, 1, 3, 2, 1);
INSERT INTO `documento` VALUES (24, '2020-05-10 19:05:17', 'FV-6', '2020-05-10 00:00:00', '2020-05-10 00:00:00', NULL, 1, 7, 1, 1, 5, 2, 1);
INSERT INTO `documento` VALUES (25, '2020-06-19 14:06:26', NULL, '2020-06-19 00:00:00', '2020-06-19 00:00:00', NULL, 1, 7, 1, 1, 1, 2, 1);
INSERT INTO `documento` VALUES (26, '2020-06-19 16:06:30', 'TER-PAG01', '2020-06-19 00:00:00', '2020-07-04 00:00:00', 'Factura a crédito', NULL, 7, 1, 1, 5, 4, 1);
INSERT INTO `documento` VALUES (27, '2020-06-22 17:06:26', '6', '2020-06-22 00:00:00', '2020-06-22 00:00:00', 'Test numero de factura', NULL, 2, 1, 1, 5, 2, 1);
INSERT INTO `documento` VALUES (28, '2020-06-22 17:06:11', NULL, '2020-06-22 00:00:00', '2020-07-22 00:00:00', NULL, 1, 2, 1, 1, 6, 5, 1);
INSERT INTO `documento` VALUES (29, '2020-06-22 18:06:38', 'FV-5', '2020-06-22 00:00:00', '2020-07-07 00:00:00', NULL, 1, 1, 1, 1, 5, 4, 1);
INSERT INTO `documento` VALUES (30, '2020-07-03 18:07:50', NULL, '2020-07-03 00:00:00', '2020-07-03 00:00:00', 'Test Cotización', NULL, 1, 1, 6, 1, 2, 1);
INSERT INTO `documento` VALUES (31, '2020-07-03 18:07:17', NULL, '2020-07-03 00:00:00', '2020-07-03 00:00:00', 'Test Cotización', NULL, 1, 1, 6, 1, 2, 1);
INSERT INTO `documento` VALUES (32, '2020-07-03 18:07:59', NULL, '2020-07-03 00:00:00', '2020-07-03 00:00:00', 'Test Cotización', NULL, 1, 1, 6, 1, 2, 1);
INSERT INTO `documento` VALUES (33, '2020-07-03 18:07:12', NULL, '2020-07-03 00:00:00', '2020-07-03 00:00:00', 'Test Cotización', NULL, 1, 1, 6, 1, 2, 1);
INSERT INTO `documento` VALUES (34, '2020-07-04 17:07:10', NULL, '2020-07-04 00:00:00', '2020-07-04 00:00:00', NULL, NULL, 2, 1, 6, 1, 2, 1);
INSERT INTO `documento` VALUES (35, '2020-07-04 17:07:57', '1', '2020-07-04 00:00:00', '2020-07-04 00:00:00', 'Numeración de cotizaciones', NULL, 7, 1, 6, 5, 2, 1);
INSERT INTO `documento` VALUES (36, '2020-07-04 17:07:14', '1', '2020-07-04 00:00:00', '2020-07-04 00:00:00', 'Numeración cotización 2', NULL, 1, 1, 6, 1, 2, 1);
INSERT INTO `documento` VALUES (37, '2020-07-04 17:07:14', '1', '2020-07-04 00:00:00', '2020-07-04 00:00:00', NULL, NULL, 2, 1, 6, 1, 2, 1);
INSERT INTO `documento` VALUES (38, '2020-07-04 17:07:21', '1', '2020-07-04 00:00:00', '2020-07-04 00:00:00', NULL, NULL, 1, 1, 6, 1, 2, 1);
INSERT INTO `documento` VALUES (39, '2020-07-04 17:07:55', '2', '2020-07-04 00:00:00', '2020-07-19 00:00:00', 'Cotización prueba case switch', NULL, 7, 1, 6, 5, 4, 1);
INSERT INTO `documento` VALUES (40, '2020-07-04 17:07:39', '3', '2020-07-04 00:00:00', '2020-07-19 00:00:00', 'Modificación de documento', NULL, 7, 1, 6, 5, 4, 1);
INSERT INTO `documento` VALUES (41, '2020-07-05 21:07:55', '1', '2020-07-05 00:00:00', '2020-07-05 00:00:00', NULL, NULL, 7, 1, 7, 1, 2, 1);
INSERT INTO `documento` VALUES (42, '2020-07-05 21:07:15', '2', '2020-07-05 00:00:00', '2020-07-20 00:00:00', NULL, NULL, 7, 1, 7, 5, 4, 1);
INSERT INTO `documento` VALUES (43, '2020-07-05 21:07:50', '3', '2020-07-05 00:00:00', '2020-07-20 00:00:00', NULL, NULL, 1, 1, 7, 5, 4, 1);
INSERT INTO `documento` VALUES (44, '2020-10-21 18:10:30', 'CM-5', '2020-10-21 00:00:00', '2020-10-21 00:00:00', NULL, 1, 1, 1, 2, 5, 2, 1);

-- ----------------------------
-- Table structure for documento_estado
-- ----------------------------
DROP TABLE IF EXISTS `documento_estado`;
CREATE TABLE `documento_estado`  (
  `Id_DocEst` int NOT NULL AUTO_INCREMENT,
  `Nombre_DocEst` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Estado_DocEst` enum('Activo','Inactivo') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Activo',
  `FechaRegistro_DocEst` datetime NULL DEFAULT current_timestamp,
  PRIMARY KEY (`Id_DocEst`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of documento_estado
-- ----------------------------
INSERT INTO `documento_estado` VALUES (1, 'Borrador', 'Activo', '2020-03-31 21:13:21');
INSERT INTO `documento_estado` VALUES (2, 'Inactivo', 'Activo', '2020-03-31 21:14:26');
INSERT INTO `documento_estado` VALUES (3, 'Anulado', 'Activo', '2020-03-31 21:14:46');
INSERT INTO `documento_estado` VALUES (4, 'Cancelado', 'Activo', '2020-03-31 21:14:52');
INSERT INTO `documento_estado` VALUES (5, 'Pagado', 'Activo', '2020-03-31 21:16:24');
INSERT INTO `documento_estado` VALUES (6, 'Credito', 'Activo', '2020-05-10 17:33:13');

-- ----------------------------
-- Table structure for documento_observaciones
-- ----------------------------
DROP TABLE IF EXISTS `documento_observaciones`;
CREATE TABLE `documento_observaciones`  (
  `Id_DocObs` int NOT NULL AUTO_INCREMENT,
  `Nombre_DocObs` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `Id_DocEst` int NULL DEFAULT NULL,
  `Id_Usu` int NULL DEFAULT NULL,
  `FechaRegistro` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `Id_Doc` int NULL DEFAULT NULL,
  PRIMARY KEY (`Id_DocObs`) USING BTREE,
  INDEX `fk_documento_observaciones`(`Id_Doc`) USING BTREE,
  INDEX `fk_obs_documento_usuario`(`Id_Usu`) USING BTREE,
  INDEX `fk_observacion_doc_estado`(`Id_DocEst`) USING BTREE,
  CONSTRAINT `fk_documento_observaciones` FOREIGN KEY (`Id_Doc`) REFERENCES `documento` (`Id_Doc`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_obs_documento_usuario` FOREIGN KEY (`Id_Usu`) REFERENCES `usuario` (`Id_Usu`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_observacion_doc_estado` FOREIGN KEY (`Id_DocEst`) REFERENCES `documento_estado` (`Id_DocEst`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of documento_observaciones
-- ----------------------------
INSERT INTO `documento_observaciones` VALUES (1, 'Agregar observación al documento', 1, 1, '2020-05-11 15:05:39', 14);
INSERT INTO `documento_observaciones` VALUES (2, 'Test de anulación de documento 14', 1, 1, '2020-05-11 15:05:09', 4);
INSERT INTO `documento_observaciones` VALUES (3, 'Test numero 2 de anulación de documento \'*/ -- ;', 3, 1, '2020-05-11 15:05:35', 8);
INSERT INTO `documento_observaciones` VALUES (4, 'Anular documento, factor 0', 3, 1, '2020-05-18 19:05:48', 14);
INSERT INTO `documento_observaciones` VALUES (5, 'Anular documento factor 0 v2', 3, 1, '2020-05-18 19:05:49', 14);
INSERT INTO `documento_observaciones` VALUES (6, NULL, 3, 1, '2020-05-18 19:05:01', 14);
INSERT INTO `documento_observaciones` VALUES (7, 'DOCUMENTO ANULADO\r\nTest anulación random', 3, 1, '2020-05-29 15:05:14', 23);

-- ----------------------------
-- Table structure for documento_tipo
-- ----------------------------
DROP TABLE IF EXISTS `documento_tipo`;
CREATE TABLE `documento_tipo`  (
  `Id_DocTip` int NOT NULL AUTO_INCREMENT,
  `Nombre_DocTip` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Estado_DocTip` enum('Activo','Inactivo') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Activo',
  `FechaRegistro_DocTip` datetime NULL DEFAULT current_timestamp,
  PRIMARY KEY (`Id_DocTip`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of documento_tipo
-- ----------------------------
INSERT INTO `documento_tipo` VALUES (1, 'Factura de venta', 'Activo', '2020-03-31 21:23:01');
INSERT INTO `documento_tipo` VALUES (2, 'Factura de compra', 'Activo', '2020-03-31 21:23:18');
INSERT INTO `documento_tipo` VALUES (3, 'Nota débito', 'Activo', '2020-03-31 21:23:50');
INSERT INTO `documento_tipo` VALUES (4, 'Nota crédito', 'Activo', '2020-03-31 21:23:56');
INSERT INTO `documento_tipo` VALUES (5, 'Remisión', 'Activo', '2020-03-31 21:27:22');
INSERT INTO `documento_tipo` VALUES (6, 'Cotización', 'Activo', '2020-03-31 21:27:32');
INSERT INTO `documento_tipo` VALUES (7, 'Órden de compra', 'Activo', '2020-03-31 21:27:42');
INSERT INTO `documento_tipo` VALUES (8, 'Comprobante de ingreso', 'Activo', '2020-03-31 21:28:22');
INSERT INTO `documento_tipo` VALUES (9, 'Comprobante de egreso', 'Activo', '2020-03-31 21:28:39');

-- ----------------------------
-- Table structure for empresa
-- ----------------------------
DROP TABLE IF EXISTS `empresa`;
CREATE TABLE `empresa`  (
  `Id_Emp` int NOT NULL AUTO_INCREMENT,
  `Nombre_Emp` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `DigitoVerificacion_Emp` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Correo_Emp` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Direccion_Emp` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Telefono_Emp` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `TelCelular_Emp` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Nit_Emp` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Id_Mun` int NULL DEFAULT NULL,
  `Id_EmpTip` int NULL DEFAULT NULL,
  `Id_Emp_Sede` int NULL DEFAULT NULL,
  `Id_EmpEst` int NULL DEFAULT NULL,
  `Primary_Usu` int NULL DEFAULT NULL,
  PRIMARY KEY (`Id_Emp`) USING BTREE,
  INDEX `fk_empresa_municipio1_idx`(`Id_Mun`) USING BTREE,
  INDEX `fk_empresa_empresa_tipo_1`(`Id_EmpTip`) USING BTREE,
  INDEX `fk_empresa_empresa_1`(`Id_Emp_Sede`) USING BTREE,
  INDEX `fk_empresa_estado_1`(`Id_EmpEst`) USING BTREE,
  INDEX `fk_idx_Nombre_Emp`(`Nombre_Emp`) USING BTREE,
  INDEX `fk_idx_Nit_Emp`(`Nit_Emp`) USING BTREE,
  CONSTRAINT `fk_empresa_empresa_1` FOREIGN KEY (`Id_Emp_Sede`) REFERENCES `empresa` (`Id_Emp`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_empresa_empresa_tipo_1` FOREIGN KEY (`Id_EmpTip`) REFERENCES `empresa_tipo` (`Id_EmpTip`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_empresa_estado_1` FOREIGN KEY (`Id_EmpEst`) REFERENCES `empresa_estado` (`Id_EmpEst`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_empresa_municipio1` FOREIGN KEY (`Id_Mun`) REFERENCES `municipio` (`Id_Mun`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 2702 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of empresa
-- ----------------------------

-- ----------------------------
-- Table structure for empresa_estado
-- ----------------------------
DROP TABLE IF EXISTS `empresa_estado`;
CREATE TABLE `empresa_estado`  (
  `Id_EmpEst` int NOT NULL AUTO_INCREMENT,
  `Nombre_EmpEst` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Id_EmpEst`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of empresa_estado
-- ----------------------------
INSERT INTO `empresa_estado` VALUES (1, 'Activo');
INSERT INTO `empresa_estado` VALUES (2, 'Inactivo');

-- ----------------------------
-- Table structure for empresa_tipo
-- ----------------------------
DROP TABLE IF EXISTS `empresa_tipo`;
CREATE TABLE `empresa_tipo`  (
  `Id_EmpTip` int NOT NULL AUTO_INCREMENT,
  `Nombre_EmpTip` varchar(70) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Id_EmpTip`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of empresa_tipo
-- ----------------------------
INSERT INTO `empresa_tipo` VALUES (1, 'GENERAL');
INSERT INTO `empresa_tipo` VALUES (2, 'EPS');
INSERT INTO `empresa_tipo` VALUES (3, 'IPS');
INSERT INTO `empresa_tipo` VALUES (4, 'TERCERO');
INSERT INTO `empresa_tipo` VALUES (5, 'APORTANTE');

-- ----------------------------
-- Table structure for gestion_documental
-- ----------------------------
DROP TABLE IF EXISTS `gestion_documental`;
CREATE TABLE `gestion_documental`  (
  `Id_GesDoc` int NOT NULL AUTO_INCREMENT,
  `Nombre_GesDoc` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Descripcion_GesDoc` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `NombreInterno_GesDoc` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Ubicacion_GesDoc` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `Formato_GesDoc` char(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Tamanio_GesDoc` double(10, 2) NULL DEFAULT NULL,
  `FechaRegistro_GesDoc` datetime NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  `Id_Usu` int NULL DEFAULT NULL,
  `Id_Per` int NULL DEFAULT NULL,
  `Id_Con` int NULL DEFAULT NULL,
  `Id_Doc` int NULL DEFAULT NULL,
  `Id_Tran` int NULL DEFAULT NULL,
  `Primary_Usu` int NULL DEFAULT NULL,
  PRIMARY KEY (`Id_GesDoc`) USING BTREE,
  INDEX `fk_gestion_doc_usuario`(`Id_Usu`) USING BTREE,
  INDEX `fk_gestion_doc_persona`(`Id_Per`) USING BTREE,
  INDEX `fk_gestion_doc_contrato`(`Id_Con`) USING BTREE,
  INDEX `fk_gestion_documental_documento1_idx`(`Id_Doc`) USING BTREE,
  INDEX `fk_gestion_documental_transacciones1_idx`(`Id_Tran`) USING BTREE,
  CONSTRAINT `fk_gestion_doc_contrato` FOREIGN KEY (`Id_Con`) REFERENCES `contratos` (`Id_Con`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_gestion_doc_persona` FOREIGN KEY (`Id_Per`) REFERENCES `persona` (`Id_Per`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_gestion_doc_usuario` FOREIGN KEY (`Id_Usu`) REFERENCES `usuario` (`Id_Usu`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_gestion_documental_documento1` FOREIGN KEY (`Id_Doc`) REFERENCES `documento` (`Id_Doc`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_gestion_documental_transacciones1` FOREIGN KEY (`Id_Tran`) REFERENCES `transacciones` (`Id_Tran`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of gestion_documental
-- ----------------------------

-- ----------------------------
-- Table structure for idioma
-- ----------------------------
DROP TABLE IF EXISTS `idioma`;
CREATE TABLE `idioma`  (
  `Id_Idi` int NOT NULL AUTO_INCREMENT,
  `Idioma_Idi` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Id_Idi`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of idioma
-- ----------------------------
INSERT INTO `idioma` VALUES (1, 'Español');
INSERT INTO `idioma` VALUES (2, 'Ingles');

-- ----------------------------
-- Table structure for idioma_traductor
-- ----------------------------
DROP TABLE IF EXISTS `idioma_traductor`;
CREATE TABLE `idioma_traductor`  (
  `Id_IdiTrad` int NOT NULL AUTO_INCREMENT,
  `Id_Idi` int NULL DEFAULT NULL,
  `CampoOriginal_IdiTRad` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Traduccion_IdiTrad` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Id_IdiTrad`) USING BTREE,
  INDEX `fk_idioma_traductor_idi`(`Id_Idi`) USING BTREE,
  CONSTRAINT `fk_idioma_traductor_idi` FOREIGN KEY (`Id_Idi`) REFERENCES `idioma` (`Id_Idi`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 483 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of idioma_traductor
-- ----------------------------
INSERT INTO `idioma_traductor` VALUES (326, 1, 'Descripcion_Rol', 'Descripcion');
INSERT INTO `idioma_traductor` VALUES (327, 1, 'Primary_Usu', 'Codigo administrador');
INSERT INTO `idioma_traductor` VALUES (328, 1, 'Id_MenTip', 'Tipo mensaje');
INSERT INTO `idioma_traductor` VALUES (329, 1, 'Descripcion_Perm', 'Descripción');
INSERT INTO `idioma_traductor` VALUES (330, 1, 'Acceso_Perm', 'Accesso');
INSERT INTO `idioma_traductor` VALUES (331, 1, 'Controlador_Perm', 'Controlador');
INSERT INTO `idioma_traductor` VALUES (332, 1, 'Id_DocEst', 'Estado');
INSERT INTO `idioma_traductor` VALUES (333, 1, 'Id_DocTip', 'Tipo');
INSERT INTO `idioma_traductor` VALUES (334, 1, 'Id_Per', 'Contacto');
INSERT INTO `idioma_traductor` VALUES (335, 1, 'Id_TerPag', 'Término de pago');
INSERT INTO `idioma_traductor` VALUES (336, 1, 'Id_Usu', 'Usuario');
INSERT INTO `idioma_traductor` VALUES (337, 1, 'FechaRegistro_Doc', 'Fecha registro');
INSERT INTO `idioma_traductor` VALUES (338, 1, 'Numero_Doc', 'Número');
INSERT INTO `idioma_traductor` VALUES (339, 1, 'FechaDocumento_Doc', 'Fecha documento');
INSERT INTO `idioma_traductor` VALUES (340, 1, 'FechaVencimiento_Doc', 'Fecha vencimiento');
INSERT INTO `idioma_traductor` VALUES (341, 1, 'Observacion_Doc', 'Observación');
INSERT INTO `idioma_traductor` VALUES (342, 1, 'IvaIncluido_Doc', '¿Iva incluido?');
INSERT INTO `idioma_traductor` VALUES (343, 1, 'Id_Emp', 'Empresa');
INSERT INTO `idioma_traductor` VALUES (344, 1, 'Id_Mun', 'Municipio');
INSERT INTO `idioma_traductor` VALUES (345, 1, 'Id_PerEst', 'Estado');
INSERT INTO `idioma_traductor` VALUES (346, 1, 'Id_PerGen', 'Género');
INSERT INTO `idioma_traductor` VALUES (347, 1, 'Id_PerTip', 'Tipo');
INSERT INTO `idioma_traductor` VALUES (348, 1, 'Id_PerTipId', 'Tipo identificación');
INSERT INTO `idioma_traductor` VALUES (349, 1, 'Identificacion_Per', 'Identificación');
INSERT INTO `idioma_traductor` VALUES (350, 1, 'Nombre1_Per', 'Primer nombre');
INSERT INTO `idioma_traductor` VALUES (351, 1, 'Nombre2_Per', 'Segundo nombre');
INSERT INTO `idioma_traductor` VALUES (352, 1, 'Apeliido1_Per', 'Primer apellido');
INSERT INTO `idioma_traductor` VALUES (353, 1, 'Apellido2_Per', 'Segundo apellido');
INSERT INTO `idioma_traductor` VALUES (354, 1, 'Telefono_Per', 'Teléfono');
INSERT INTO `idioma_traductor` VALUES (355, 1, 'TelCelular_Per', 'Celular');
INSERT INTO `idioma_traductor` VALUES (356, 1, 'Correo_Per', 'Correo electrónico');
INSERT INTO `idioma_traductor` VALUES (357, 1, 'Direccion_Per', 'Dirección residencia');
INSERT INTO `idioma_traductor` VALUES (358, 1, 'FechaNacimiento_Per', 'Fecha nacimiento');
INSERT INTO `idioma_traductor` VALUES (359, 1, 'FechaRegistro_Per', 'Fecha registro');
INSERT INTO `idioma_traductor` VALUES (360, 1, 'Celular_Per', 'Celular 2');
INSERT INTO `idioma_traductor` VALUES (361, 1, 'Id_BanEst', 'Estado');
INSERT INTO `idioma_traductor` VALUES (362, 1, 'Id_TipCueBan', 'Tipo cuenta');
INSERT INTO `idioma_traductor` VALUES (363, 1, 'NombreCuenta_Ban', 'Nombre cuenta');
INSERT INTO `idioma_traductor` VALUES (364, 1, 'NumeroCuenta_Ban', 'Número cuenta');
INSERT INTO `idioma_traductor` VALUES (365, 1, 'SaldoInicial_Ban', 'Saldo inicial');
INSERT INTO `idioma_traductor` VALUES (366, 1, 'FechaBanco', 'Fecha');
INSERT INTO `idioma_traductor` VALUES (367, 1, 'Descripcion_Ban', 'Descripción');
INSERT INTO `idioma_traductor` VALUES (368, 1, 'FechaRegistro', 'Fecha registro');
INSERT INTO `idioma_traductor` VALUES (369, 1, 'Id_Bod', 'Bodega');
INSERT INTO `idioma_traductor` VALUES (370, 1, 'Id_CatIte', 'Categoría');
INSERT INTO `idioma_traductor` VALUES (371, 1, 'Id_IteEst', 'Estado');
INSERT INTO `idioma_traductor` VALUES (372, 1, 'Id_IteTip', 'Tipo');
INSERT INTO `idioma_traductor` VALUES (373, 1, 'Id_Mar', 'Marca');
INSERT INTO `idioma_traductor` VALUES (374, 1, 'Id_Med', 'Medida');
INSERT INTO `idioma_traductor` VALUES (375, 1, 'Nombre_Ite', 'Nombre item');
INSERT INTO `idioma_traductor` VALUES (376, 1, 'Referencia_Ite', 'Referencia');
INSERT INTO `idioma_traductor` VALUES (377, 1, 'Serie_Ite', 'Serie');
INSERT INTO `idioma_traductor` VALUES (378, 1, 'FechaRegistro_Ite', 'Fecha registro');
INSERT INTO `idioma_traductor` VALUES (379, 1, 'Inventariable_Ite', '¿Inventariable?');
INSERT INTO `idioma_traductor` VALUES (380, 1, 'Observacion_Ite', 'Observación');
INSERT INTO `idioma_traductor` VALUES (381, 1, 'Imagen_Item', 'Imagen');
INSERT INTO `idioma_traductor` VALUES (382, 1, 'Nombre_CatIte', 'Nombre categoría');
INSERT INTO `idioma_traductor` VALUES (383, 1, 'FechaRegistro_CatIte', 'Fecha registro');
INSERT INTO `idioma_traductor` VALUES (384, 1, 'Estado_CatIte', 'Estado');
INSERT INTO `idioma_traductor` VALUES (385, 1, 'Id_BodEst', 'Estado');
INSERT INTO `idioma_traductor` VALUES (386, 1, 'Id_BodTip', 'Tipo');
INSERT INTO `idioma_traductor` VALUES (387, 1, 'Nombre_Bod', 'Nombre bodega');
INSERT INTO `idioma_traductor` VALUES (388, 1, 'Codigo_Bod', 'Código');
INSERT INTO `idioma_traductor` VALUES (389, 1, 'Direccion_Bod', 'Dirección/Ubicación');
INSERT INTO `idioma_traductor` VALUES (390, 1, 'Descripcion_Bod', 'Descripción');
INSERT INTO `idioma_traductor` VALUES (391, 1, 'FechaRegistro_Bod', 'Fecha registro');
INSERT INTO `idioma_traductor` VALUES (392, 1, 'FechaCreacion_Bod', 'Fecha creación');
INSERT INTO `idioma_traductor` VALUES (393, 1, 'Nombre_ListPre', 'Nombre lista');
INSERT INTO `idioma_traductor` VALUES (394, 1, 'Estado_ListPre', 'Estado');
INSERT INTO `idioma_traductor` VALUES (395, 1, 'Valor_Incremento', 'Valor incremento($)');
INSERT INTO `idioma_traductor` VALUES (396, 1, 'Porcentaje_Incremento', 'Porcentaje incremento(%)');
INSERT INTO `idioma_traductor` VALUES (397, 1, 'Id_Idi', 'Idioma');
INSERT INTO `idioma_traductor` VALUES (398, 1, 'CampoOriginal_IdiTRad', 'Campo original');
INSERT INTO `idioma_traductor` VALUES (399, 1, 'Traduccion_IdiTrad', 'Traducción');
INSERT INTO `idioma_traductor` VALUES (400, 1, 'PrecioVenta', 'Precio venta');
INSERT INTO `idioma_traductor` VALUES (401, 1, 'Id_Ite', 'Item');
INSERT INTO `idioma_traductor` VALUES (402, 1, 'Id_ListPre', 'Lista de precios');
INSERT INTO `idioma_traductor` VALUES (403, 1, 'Id_Imp', 'Impuestos');
INSERT INTO `idioma_traductor` VALUES (404, 1, 'Nombre_Imp', 'Nombre impuesto');
INSERT INTO `idioma_traductor` VALUES (405, 1, 'Valor_Imp', 'Porcentaje (%)');
INSERT INTO `idioma_traductor` VALUES (406, 1, 'Estado_Imp', 'Estado');
INSERT INTO `idioma_traductor` VALUES (407, 1, 'FechaRegistro_Imp', 'Fecha registro');
INSERT INTO `idioma_traductor` VALUES (408, 1, 'Id_CueEst', 'Estado');
INSERT INTO `idioma_traductor` VALUES (409, 1, 'Id_CueTip', 'Tipo');
INSERT INTO `idioma_traductor` VALUES (410, 1, 'Id_Cue_CuentaPadre', 'Cuenta padre');
INSERT INTO `idioma_traductor` VALUES (411, 1, 'Id_NatCue', 'Naturaleza');
INSERT INTO `idioma_traductor` VALUES (412, 1, 'Nombre_Cue', 'Nombre');
INSERT INTO `idioma_traductor` VALUES (413, 1, 'Cuenta_Cue', 'Cuenta');
INSERT INTO `idioma_traductor` VALUES (414, 1, 'Consecutivo_Cue', 'Consecutivo');
INSERT INTO `idioma_traductor` VALUES (415, 1, 'FechaRegistro_Cue', 'Fecha registro');
INSERT INTO `idioma_traductor` VALUES (416, 1, 'Id_Ban', 'Banco');
INSERT INTO `idioma_traductor` VALUES (417, 1, 'Id_TranEst', 'Estado');
INSERT INTO `idioma_traductor` VALUES (418, 1, 'Id_TranTip', 'Tipo');
INSERT INTO `idioma_traductor` VALUES (419, 1, 'Id_Tran_TransaccionParcial', 'Transacción parcial');
INSERT INTO `idioma_traductor` VALUES (420, 1, 'Numero_Tran', 'Número');
INSERT INTO `idioma_traductor` VALUES (421, 1, 'Fecha_Tran', 'Fecha transacción');
INSERT INTO `idioma_traductor` VALUES (422, 1, 'NotaVisible_Tran', 'Nota (Visible)');
INSERT INTO `idioma_traductor` VALUES (423, 1, 'DocumentoAsociado_Tran', '¿Factura asociada?');
INSERT INTO `idioma_traductor` VALUES (424, 1, 'FechaRegistro_Tran', 'Fecha registro');
INSERT INTO `idioma_traductor` VALUES (425, 1, 'Id_Rol', 'Rol');
INSERT INTO `idioma_traductor` VALUES (426, 1, 'Id_UsuEst', 'Estado');
INSERT INTO `idioma_traductor` VALUES (427, 1, 'Usuario_Usu', 'Usuario');
INSERT INTO `idioma_traductor` VALUES (428, 1, 'Contrasena_Usu', 'Contraseña');
INSERT INTO `idioma_traductor` VALUES (429, 1, 'UltimoAcceso_Usu', 'Fecha ultimo acceso');
INSERT INTO `idioma_traductor` VALUES (430, 1, 'UltimaContrasena_Usu', 'Ultima contraseña');
INSERT INTO `idioma_traductor` VALUES (431, 1, 'KeyPago_Usu', 'Llave pago');
INSERT INTO `idioma_traductor` VALUES (432, 1, 'Email_Usu', 'Email');
INSERT INTO `idioma_traductor` VALUES (433, 1, 'KeyRecoverPassword_Usu', 'Llave recuperación');
INSERT INTO `idioma_traductor` VALUES (434, 1, 'FechaRegistro_Usu', 'Fecha registro');
INSERT INTO `idioma_traductor` VALUES (435, 1, 'Nombre_TerPag', 'Nombre');
INSERT INTO `idioma_traductor` VALUES (436, 1, 'Dias_TerPag', 'Días de pago');
INSERT INTO `idioma_traductor` VALUES (437, 1, 'Estado_TerPag', 'Estado');
INSERT INTO `idioma_traductor` VALUES (438, 1, 'FechaRegistro_TerPag', 'Fecha registro');
INSERT INTO `idioma_traductor` VALUES (440, 1, 'Id_Per_expenses', 'Provedor');
INSERT INTO `idioma_traductor` VALUES (441, 1, 'Id_Per_income', 'Cliente');
INSERT INTO `idioma_traductor` VALUES (442, 1, 'Cantidad_Kar', 'Cantidad');
INSERT INTO `idioma_traductor` VALUES (443, 1, 'Costo_Kar', 'Costo');
INSERT INTO `idioma_traductor` VALUES (444, 1, 'Descuento_Kar', 'Descuento (%)');
INSERT INTO `idioma_traductor` VALUES (445, 1, 'Aceptado_Kar', 'OK');
INSERT INTO `idioma_traductor` VALUES (446, 1, 'Observacion_Kar', 'Observación');
INSERT INTO `idioma_traductor` VALUES (447, 1, 'FactorMovimiento_Kar', 'Factor');
INSERT INTO `idioma_traductor` VALUES (448, 1, 'Id_Doc', 'Documento');
INSERT INTO `idioma_traductor` VALUES (449, 1, 'Subtotal', 'Subtotal');
INSERT INTO `idioma_traductor` VALUES (450, 1, 'Id_MetPag', 'Método de pago');
INSERT INTO `idioma_traductor` VALUES (451, 1, 'Nombre_MetPag', 'Método de pago');
INSERT INTO `idioma_traductor` VALUES (452, 1, 'Estado_MePag', 'Estado');
INSERT INTO `idioma_traductor` VALUES (453, 1, 'Id_Ret', 'Retención');
INSERT INTO `idioma_traductor` VALUES (454, 1, 'Id_Cue_Ventas', 'Cuenta ventas');
INSERT INTO `idioma_traductor` VALUES (455, 1, 'Id_Cue_Compras', 'Cuenta compras');
INSERT INTO `idioma_traductor` VALUES (456, 1, 'Id_RetTip', 'Tipo');
INSERT INTO `idioma_traductor` VALUES (457, 1, 'Nombre_Ret', 'Retención');
INSERT INTO `idioma_traductor` VALUES (458, 1, 'Porcentaje_Ret', 'Porcentaje (%)');
INSERT INTO `idioma_traductor` VALUES (459, 1, 'Descripcion_Ret', 'Descripción');
INSERT INTO `idioma_traductor` VALUES (460, 1, 'FechaRegistro_Ret', 'Fecha registro');
INSERT INTO `idioma_traductor` VALUES (461, 1, 'Estado_Ret', 'Estado');
INSERT INTO `idioma_traductor` VALUES (462, 1, 'Valor_TranDet', 'Valor');
INSERT INTO `idioma_traductor` VALUES (463, 1, 'Cantidad_TranDet', 'Cantidad');
INSERT INTO `idioma_traductor` VALUES (464, 1, 'Observaciones_TranDet', 'Observación');
INSERT INTO `idioma_traductor` VALUES (465, 1, 'Id_Tran', 'Transacción');
INSERT INTO `idioma_traductor` VALUES (466, 1, 'Id_Cue', 'Cuenta');
INSERT INTO `idioma_traductor` VALUES (467, 1, 'Id_TranDetTip', 'Tipo');
INSERT INTO `idioma_traductor` VALUES (468, 1, 'Id_TranDetEst', 'Estado');
INSERT INTO `idioma_traductor` VALUES (469, 1, 'Nombre_DocEst', 'Estado');
INSERT INTO `idioma_traductor` VALUES (470, 1, 'Nombre_DocObs', 'Observación');
INSERT INTO `idioma_traductor` VALUES (471, 1, 'Id_NumDoc', 'Numeración documento');
INSERT INTO `idioma_traductor` VALUES (472, 1, 'Id_NumFac', 'Resolución de facturación');
INSERT INTO `idioma_traductor` VALUES (473, 1, 'Inicial_NumDoc', 'Número inicial');
INSERT INTO `idioma_traductor` VALUES (474, 1, 'Siguiente_NumDoc', 'Siguiente número');
INSERT INTO `idioma_traductor` VALUES (475, 1, 'Nombre_NumFac', 'Nombre');
INSERT INTO `idioma_traductor` VALUES (476, 1, 'Prefijo_NumFac', 'Prefijo factura');
INSERT INTO `idioma_traductor` VALUES (477, 1, 'Numero_NumFac', 'Número');
INSERT INTO `idioma_traductor` VALUES (478, 1, 'Resolucion_NumFac', 'Resolución de facturación');
INSERT INTO `idioma_traductor` VALUES (479, 1, 'Activo_NumFac', 'Estado');
INSERT INTO `idioma_traductor` VALUES (480, 1, 'Defecto_NumFac', '¿Por defecto?');
INSERT INTO `idioma_traductor` VALUES (481, 1, 'income', NULL);
INSERT INTO `idioma_traductor` VALUES (482, 1, 'expenses', NULL);

-- ----------------------------
-- Table structure for impuestos
-- ----------------------------
DROP TABLE IF EXISTS `impuestos`;
CREATE TABLE `impuestos`  (
  `Id_Imp` int NOT NULL AUTO_INCREMENT,
  `Nombre_Imp` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Valor_Imp` double NULL DEFAULT NULL,
  `Estado_Imp` enum('Activo','Inactivo') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Activo',
  `FechaRegistro_Imp` timestamp NULL DEFAULT current_timestamp,
  `Primary_Usu` int NULL DEFAULT NULL,
  PRIMARY KEY (`Id_Imp`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of impuestos
-- ----------------------------
INSERT INTO `impuestos` VALUES (3, 'IVA', 0, 'Activo', '2020-03-25 19:36:45', 1);
INSERT INTO `impuestos` VALUES (4, 'IVA', 19, 'Activo', '2020-03-27 04:03:41', 7);
INSERT INTO `impuestos` VALUES (5, 'IVA', 5, 'Activo', '2020-03-27 04:03:50', 1);
INSERT INTO `impuestos` VALUES (6, 'IVA', 19, 'Activo', '2020-03-27 04:03:10', 1);
INSERT INTO `impuestos` VALUES (7, 'Retefuente', 10, 'Activo', '2020-04-14 17:04:31', 7);
INSERT INTO `impuestos` VALUES (8, 'Estampillas', 5, 'Activo', '2020-04-14 17:04:48', 7);

-- ----------------------------
-- Table structure for impuestos_items
-- ----------------------------
DROP TABLE IF EXISTS `impuestos_items`;
CREATE TABLE `impuestos_items`  (
  `Id_Ite` int NOT NULL,
  `Id_Imp` int NOT NULL,
  PRIMARY KEY (`Id_Ite`, `Id_Imp`) USING BTREE,
  INDEX `fk_items_has_impuestos_impuestos1_idx`(`Id_Imp`) USING BTREE,
  INDEX `fk_items_has_impuestos_items1_idx`(`Id_Ite`) USING BTREE,
  CONSTRAINT `fk_items_has_impuestos_impuestos1` FOREIGN KEY (`Id_Imp`) REFERENCES `impuestos` (`Id_Imp`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_items_has_impuestos_items1` FOREIGN KEY (`Id_Ite`) REFERENCES `items` (`Id_Ite`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of impuestos_items
-- ----------------------------
INSERT INTO `impuestos_items` VALUES (1, 5);
INSERT INTO `impuestos_items` VALUES (4, 5);
INSERT INTO `impuestos_items` VALUES (4, 6);
INSERT INTO `impuestos_items` VALUES (5, 4);
INSERT INTO `impuestos_items` VALUES (6, 6);
INSERT INTO `impuestos_items` VALUES (7, 4);
INSERT INTO `impuestos_items` VALUES (8, 4);
INSERT INTO `impuestos_items` VALUES (9, 4);
INSERT INTO `impuestos_items` VALUES (10, 6);

-- ----------------------------
-- Table structure for impuestos_kardex
-- ----------------------------
DROP TABLE IF EXISTS `impuestos_kardex`;
CREATE TABLE `impuestos_kardex`  (
  `Id_ImpKar` int NOT NULL AUTO_INCREMENT,
  `Id_kar` int NULL DEFAULT NULL,
  `Id_Imp` int NULL DEFAULT NULL,
  PRIMARY KEY (`Id_ImpKar`) USING BTREE,
  INDEX `fk_impuestos_kardex_kardex1_idx`(`Id_kar`) USING BTREE,
  INDEX `fk_impuestos_kardex_impuestos1_idx`(`Id_Imp`) USING BTREE,
  CONSTRAINT `fk_impuestos_kardex_impuestos1` FOREIGN KEY (`Id_Imp`) REFERENCES `impuestos` (`Id_Imp`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_impuestos_kardex_kardex1` FOREIGN KEY (`Id_kar`) REFERENCES `kardex` (`Id_kar`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 94 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of impuestos_kardex
-- ----------------------------
INSERT INTO `impuestos_kardex` VALUES (3, NULL, NULL);
INSERT INTO `impuestos_kardex` VALUES (10, 1, 3);
INSERT INTO `impuestos_kardex` VALUES (14, 20, 6);
INSERT INTO `impuestos_kardex` VALUES (15, 21, 5);
INSERT INTO `impuestos_kardex` VALUES (16, 22, 6);
INSERT INTO `impuestos_kardex` VALUES (17, 22, 5);
INSERT INTO `impuestos_kardex` VALUES (18, 23, 4);
INSERT INTO `impuestos_kardex` VALUES (19, 24, 4);
INSERT INTO `impuestos_kardex` VALUES (20, 25, 4);
INSERT INTO `impuestos_kardex` VALUES (21, 26, 4);
INSERT INTO `impuestos_kardex` VALUES (22, 27, 4);
INSERT INTO `impuestos_kardex` VALUES (23, 28, 4);
INSERT INTO `impuestos_kardex` VALUES (24, 29, 4);
INSERT INTO `impuestos_kardex` VALUES (25, 30, 5);
INSERT INTO `impuestos_kardex` VALUES (26, 31, 6);
INSERT INTO `impuestos_kardex` VALUES (27, 31, 5);
INSERT INTO `impuestos_kardex` VALUES (28, 32, 6);
INSERT INTO `impuestos_kardex` VALUES (29, 32, 5);
INSERT INTO `impuestos_kardex` VALUES (30, 33, 6);
INSERT INTO `impuestos_kardex` VALUES (31, 34, 5);
INSERT INTO `impuestos_kardex` VALUES (32, 35, 6);
INSERT INTO `impuestos_kardex` VALUES (33, 35, 5);
INSERT INTO `impuestos_kardex` VALUES (34, 36, 6);
INSERT INTO `impuestos_kardex` VALUES (35, 37, 5);
INSERT INTO `impuestos_kardex` VALUES (44, 43, 5);
INSERT INTO `impuestos_kardex` VALUES (45, 44, 6);
INSERT INTO `impuestos_kardex` VALUES (46, 45, 6);
INSERT INTO `impuestos_kardex` VALUES (47, 45, 5);
INSERT INTO `impuestos_kardex` VALUES (48, 46, 5);
INSERT INTO `impuestos_kardex` VALUES (49, 47, 5);
INSERT INTO `impuestos_kardex` VALUES (53, 50, 5);
INSERT INTO `impuestos_kardex` VALUES (54, 51, 6);
INSERT INTO `impuestos_kardex` VALUES (55, 52, 5);
INSERT INTO `impuestos_kardex` VALUES (56, 53, 6);
INSERT INTO `impuestos_kardex` VALUES (63, 58, 6);
INSERT INTO `impuestos_kardex` VALUES (64, 58, 5);
INSERT INTO `impuestos_kardex` VALUES (65, 59, 6);
INSERT INTO `impuestos_kardex` VALUES (66, 60, 6);
INSERT INTO `impuestos_kardex` VALUES (67, 60, 5);
INSERT INTO `impuestos_kardex` VALUES (68, 64, 6);
INSERT INTO `impuestos_kardex` VALUES (69, 64, 5);
INSERT INTO `impuestos_kardex` VALUES (70, 65, 6);
INSERT INTO `impuestos_kardex` VALUES (71, 65, 5);
INSERT INTO `impuestos_kardex` VALUES (72, 66, 6);
INSERT INTO `impuestos_kardex` VALUES (73, 67, 6);
INSERT INTO `impuestos_kardex` VALUES (74, 67, 5);
INSERT INTO `impuestos_kardex` VALUES (75, 68, 6);
INSERT INTO `impuestos_kardex` VALUES (76, 68, 5);
INSERT INTO `impuestos_kardex` VALUES (77, 69, 5);
INSERT INTO `impuestos_kardex` VALUES (78, 70, 6);
INSERT INTO `impuestos_kardex` VALUES (79, 70, 5);
INSERT INTO `impuestos_kardex` VALUES (80, 72, 6);
INSERT INTO `impuestos_kardex` VALUES (81, 72, 5);
INSERT INTO `impuestos_kardex` VALUES (82, 73, 6);
INSERT INTO `impuestos_kardex` VALUES (83, 74, 6);
INSERT INTO `impuestos_kardex` VALUES (84, 75, 5);
INSERT INTO `impuestos_kardex` VALUES (87, 79, 5);
INSERT INTO `impuestos_kardex` VALUES (88, 81, 6);
INSERT INTO `impuestos_kardex` VALUES (89, 81, 5);
INSERT INTO `impuestos_kardex` VALUES (90, 82, 6);
INSERT INTO `impuestos_kardex` VALUES (91, 82, 5);
INSERT INTO `impuestos_kardex` VALUES (92, 84, 5);
INSERT INTO `impuestos_kardex` VALUES (93, 85, 6);

-- ----------------------------
-- Table structure for item_estado
-- ----------------------------
DROP TABLE IF EXISTS `item_estado`;
CREATE TABLE `item_estado`  (
  `Id_IteEst` int NOT NULL AUTO_INCREMENT,
  `Nombre_IteEst` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`Id_IteEst`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of item_estado
-- ----------------------------
INSERT INTO `item_estado` VALUES (1, 'Activo');
INSERT INTO `item_estado` VALUES (2, 'Inactivo');

-- ----------------------------
-- Table structure for item_tipo
-- ----------------------------
DROP TABLE IF EXISTS `item_tipo`;
CREATE TABLE `item_tipo`  (
  `Id_IteTip` int NOT NULL AUTO_INCREMENT,
  `Nombre_IteTip` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `FechaRegistro_IteTip` timestamp NULL DEFAULT current_timestamp,
  `Estado_IteTip` enum('Activo','Inactivo') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Activo',
  PRIMARY KEY (`Id_IteTip`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of item_tipo
-- ----------------------------
INSERT INTO `item_tipo` VALUES (1, 'Inventariable', '2020-03-23 22:11:19', 'Activo');
INSERT INTO `item_tipo` VALUES (2, 'No inventariable', '2020-03-23 22:11:26', 'Activo');
INSERT INTO `item_tipo` VALUES (3, 'Servicio', '2020-03-23 22:12:29', 'Activo');

-- ----------------------------
-- Table structure for items
-- ----------------------------
DROP TABLE IF EXISTS `items`;
CREATE TABLE `items`  (
  `Id_Ite` int NOT NULL AUTO_INCREMENT,
  `Nombre_Ite` mediumtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Referencia_Ite` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Serie_Ite` varchar(450) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `FechaRegistro_Ite` timestamp NULL DEFAULT current_timestamp,
  `Inventariable_Ite` tinyint NULL DEFAULT NULL,
  `Observacion_Ite` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `Imagen_Item` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `Id_CatIte` int NULL DEFAULT NULL,
  `Id_Mar` int NULL DEFAULT NULL,
  `Id_Med` int NULL DEFAULT NULL,
  `Id_Usu` int NULL DEFAULT NULL COMMENT 'Usuario que registro el Item',
  `Id_IteTip` int NULL DEFAULT NULL,
  `Id_IteEst` int NULL DEFAULT NULL,
  `Id_Bod` int NULL DEFAULT NULL,
  `Primary_Usu` int NULL DEFAULT NULL,
  PRIMARY KEY (`Id_Ite`) USING BTREE,
  INDEX `fk_items_medidas1_idx`(`Id_Med`) USING BTREE,
  INDEX `fk_items_usuario1_idx`(`Id_Usu`) USING BTREE,
  INDEX `fk_items_marcas1_idx`(`Id_Mar`) USING BTREE,
  INDEX `fk_items_item_estado1_idx`(`Id_IteEst`) USING BTREE,
  INDEX `fk_items_item_tipo1_idx`(`Id_IteTip`) USING BTREE,
  INDEX `fk_items_categoria_item1_idx`(`Id_CatIte`) USING BTREE,
  INDEX `fk_items_bodegas1_idx`(`Id_Bod`) USING BTREE,
  CONSTRAINT `fk_items_bodegas1` FOREIGN KEY (`Id_Bod`) REFERENCES `bodegas` (`Id_Bod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_items_categoria_item1` FOREIGN KEY (`Id_CatIte`) REFERENCES `categoria_item` (`Id_CatIte`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_items_item_estado1` FOREIGN KEY (`Id_IteEst`) REFERENCES `item_estado` (`Id_IteEst`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_items_item_tipo1` FOREIGN KEY (`Id_IteTip`) REFERENCES `item_tipo` (`Id_IteTip`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_items_marcas1` FOREIGN KEY (`Id_Mar`) REFERENCES `marcas` (`Id_Mar`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_items_medidas1` FOREIGN KEY (`Id_Med`) REFERENCES `medidas` (`Id_Med`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_items_usuario1` FOREIGN KEY (`Id_Usu`) REFERENCES `usuario` (`Id_Usu`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of items
-- ----------------------------
INSERT INTO `items` VALUES (1, 'Servicio número 1', 'ref', 'Serie', '2020-03-24 00:00:00', NULL, 'Observación', NULL, 2, NULL, 1, 1, 3, 1, 4, 1);
INSERT INTO `items` VALUES (2, 'Item #5', NULL, NULL, '2020-03-30 02:03:46', NULL, NULL, NULL, NULL, NULL, NULL, 1, 3, 1, 4, 1);
INSERT INTO `items` VALUES (3, 'Item #2', NULL, NULL, '2020-03-30 02:03:46', NULL, NULL, NULL, 2, NULL, 1, 1, 3, 1, 4, 1);
INSERT INTO `items` VALUES (4, 'Item #3', NULL, NULL, '2020-03-30 17:03:12', NULL, NULL, NULL, 2, NULL, 1, 1, 2, 1, 4, 1);
INSERT INTO `items` VALUES (5, 'Servicio #1', NULL, NULL, '2020-03-31 19:03:56', NULL, 'Mi primer servicio', NULL, NULL, NULL, NULL, 7, 3, 1, NULL, 7);
INSERT INTO `items` VALUES (6, 'Item #4', 'REF', 'SER', '2020-04-05 17:04:38', NULL, 'Observación Ítem número 4', NULL, 2, NULL, 1, 1, 3, 1, 4, 1);
INSERT INTO `items` VALUES (7, 'Servicio número 2', NULL, NULL, '2020-04-14 17:04:01', NULL, 'Esto es un servicio', NULL, 3, NULL, NULL, 7, 3, 1, NULL, 7);
INSERT INTO `items` VALUES (8, 'PRUEBA1', 'PRUB1', 'PRUB1', '2020-04-27 17:04:57', NULL, NULL, NULL, 3, NULL, NULL, 7, 1, 1, NULL, 7);
INSERT INTO `items` VALUES (9, 'Portátil', 'X44U1', '12344666', '2020-05-02 16:05:13', NULL, 'PRUEBA', NULL, 3, NULL, NULL, 7, 3, 1, 5, 7);
INSERT INTO `items` VALUES (10, 'Arroz Flor Huila x500gr', 'ARROZ00FHX500X25', 'FHX25', '2020-08-02 21:08:42', NULL, NULL, 'multitenan.png', 2, NULL, 1, 1, 1, 1, 4, 1);

-- ----------------------------
-- Table structure for kardex
-- ----------------------------
DROP TABLE IF EXISTS `kardex`;
CREATE TABLE `kardex`  (
  `Id_kar` int NOT NULL AUTO_INCREMENT,
  `Cantidad_Kar` int NULL DEFAULT NULL,
  `Costo_Kar` double NULL DEFAULT NULL,
  `Descuento_Kar` double NULL DEFAULT NULL,
  `Aceptado_Kar` tinyint NULL DEFAULT NULL COMMENT 'Aceptacion del elemento por parte de la persona asignada en el documento',
  `Observacion_Kar` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `FactorMovimiento_Kar` smallint NULL DEFAULT NULL COMMENT 'Determina si es un ingreso = 1, salida = -1  o movimiento nulo = 0',
  `Id_Doc` int NULL DEFAULT NULL COMMENT 'Documento',
  `Id_Ite` int NULL DEFAULT NULL COMMENT 'Item contabilizado',
  `Id_Med` int NULL DEFAULT NULL COMMENT 'Unidad de medida',
  `Id_Bod` int NULL DEFAULT NULL,
  `Id_KarTip` int NULL DEFAULT NULL COMMENT 'Tipo kardex',
  `Id_KarEst` int NULL DEFAULT NULL COMMENT 'Estado kardex',
  `Primary_Usu` int NULL DEFAULT NULL,
  PRIMARY KEY (`Id_kar`) USING BTREE,
  INDEX `fk_kardex_documento1_idx`(`Id_Doc`) USING BTREE,
  INDEX `fk_kardex_kardex_estado1_idx`(`Id_KarEst`) USING BTREE,
  INDEX `fk_kardex_kardex_tipo1_idx`(`Id_KarTip`) USING BTREE,
  INDEX `fk_kardex_medidas1_idx`(`Id_Med`) USING BTREE,
  INDEX `fk_kardex_bodegas1_idx`(`Id_Bod`) USING BTREE,
  INDEX `fk_kardex_items1_idx`(`Id_Ite`) USING BTREE,
  CONSTRAINT `fk_kardex_bodegas1` FOREIGN KEY (`Id_Bod`) REFERENCES `bodegas` (`Id_Bod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_kardex_documento1` FOREIGN KEY (`Id_Doc`) REFERENCES `documento` (`Id_Doc`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_kardex_items1` FOREIGN KEY (`Id_Ite`) REFERENCES `items` (`Id_Ite`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_kardex_kardex_estado1` FOREIGN KEY (`Id_KarEst`) REFERENCES `kardex_estado` (`Id_KarEst`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_kardex_kardex_tipo1` FOREIGN KEY (`Id_KarTip`) REFERENCES `kardex_tipo` (`Id_KarTip`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_kardex_medidas1` FOREIGN KEY (`Id_Med`) REFERENCES `medidas` (`Id_Med`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 86 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of kardex
-- ----------------------------
INSERT INTO `kardex` VALUES (1, 5, 10000, 3, NULL, NULL, 1, 5, 2, NULL, 4, 2, 1, 1);
INSERT INTO `kardex` VALUES (2, 4, 4500, 6, NULL, NULL, 1, 5, 6, 1, 4, 2, 1, 1);
INSERT INTO `kardex` VALUES (3, 10, 5000, NULL, NULL, NULL, 1, 5, 3, 1, 4, 2, 1, 1);
INSERT INTO `kardex` VALUES (4, 3, 132000, NULL, NULL, 'Kardex observación', 1, 6, 1, 1, 4, 2, 1, 1);
INSERT INTO `kardex` VALUES (5, 5, 45000, 5, NULL, NULL, 1, 6, 4, 1, 4, 2, 1, 1);
INSERT INTO `kardex` VALUES (6, 4, 50000, 5, NULL, 'Kardex observación', -1, 7, 3, NULL, NULL, 1, 1, 1);
INSERT INTO `kardex` VALUES (7, 10, 50000, 5, NULL, 'Kardex observación', -1, 7, 4, NULL, NULL, 1, 1, 1);
INSERT INTO `kardex` VALUES (8, 4, 25000, 10, NULL, 'Kardex observación', -1, 7, 6, NULL, NULL, 1, 1, 1);
INSERT INTO `kardex` VALUES (9, 5, 100000, 3, NULL, 'Kardex observación', -1, 7, 2, NULL, NULL, 1, 1, 1);
INSERT INTO `kardex` VALUES (10, 4, 50000, 5, NULL, 'Kardex observación', -1, 8, 3, NULL, NULL, 1, 1, 1);
INSERT INTO `kardex` VALUES (11, 10, 50000, 5, NULL, 'Kardex observación', -1, 8, 4, NULL, NULL, 1, 1, 1);
INSERT INTO `kardex` VALUES (12, 4, 50000, 5, NULL, 'Kardex observación', -1, 9, 3, NULL, NULL, 1, 1, 1);
INSERT INTO `kardex` VALUES (13, 10, 50000, 5, NULL, 'Kardex observación', -1, 9, 4, NULL, NULL, 1, 1, 1);
INSERT INTO `kardex` VALUES (14, 7, 50000, NULL, NULL, NULL, 1, 10, 4, 1, 4, 2, 1, 1);
INSERT INTO `kardex` VALUES (15, 7, 50000, NULL, NULL, NULL, 1, 11, 4, 1, 4, 2, 1, 1);
INSERT INTO `kardex` VALUES (17, 5, 45000, NULL, NULL, NULL, 1, 13, 4, 1, 4, 2, 1, 1);
INSERT INTO `kardex` VALUES (20, 5, 25000, NULL, NULL, NULL, -1, 15, 6, NULL, NULL, 1, 1, 1);
INSERT INTO `kardex` VALUES (21, 10, 50000, NULL, NULL, NULL, -1, 15, 3, NULL, NULL, 1, 1, 1);
INSERT INTO `kardex` VALUES (22, 5, 50000, NULL, NULL, NULL, -1, 15, 4, NULL, NULL, 1, 1, 1);
INSERT INTO `kardex` VALUES (23, 1, 5000000, NULL, NULL, NULL, -1, 16, 5, NULL, NULL, 1, 1, 7);
INSERT INTO `kardex` VALUES (24, 2, 1200000, NULL, NULL, NULL, -1, 16, 7, NULL, NULL, 1, 1, 7);
INSERT INTO `kardex` VALUES (25, 1, 1000000, 5, NULL, 'CREDITO XX', -1, 17, NULL, NULL, NULL, 1, 1, 7);
INSERT INTO `kardex` VALUES (26, 1, 800000, NULL, NULL, NULL, 1, 18, NULL, NULL, NULL, 2, 1, 7);
INSERT INTO `kardex` VALUES (27, 1, 500000, NULL, NULL, NULL, 1, 19, NULL, NULL, NULL, 2, 1, 7);
INSERT INTO `kardex` VALUES (28, 1, 500000, NULL, NULL, NULL, 1, 20, NULL, NULL, NULL, 2, 1, 7);
INSERT INTO `kardex` VALUES (29, 1, 90000, NULL, NULL, NULL, -1, 21, NULL, NULL, NULL, 1, 1, 7);
INSERT INTO `kardex` VALUES (30, 7, 132000, NULL, 0, NULL, -1, 22, 1, NULL, NULL, 1, 1, 1);
INSERT INTO `kardex` VALUES (31, 5, 45000, 5, 0, 'Con descuento', -1, 22, 4, NULL, NULL, 1, 1, 1);
INSERT INTO `kardex` VALUES (32, 8, 45000, NULL, NULL, NULL, 0, 23, 4, NULL, NULL, 1, 1, 1);
INSERT INTO `kardex` VALUES (33, 8, 25000, 3, NULL, NULL, 0, 23, 6, NULL, NULL, 1, 1, 1);
INSERT INTO `kardex` VALUES (34, 5, 132000, NULL, NULL, NULL, 0, 23, 1, NULL, NULL, 1, 1, 1);
INSERT INTO `kardex` VALUES (35, 8, 45000, NULL, NULL, NULL, -1, 24, 4, NULL, NULL, 1, 1, 1);
INSERT INTO `kardex` VALUES (36, 8, 25000, 3, NULL, NULL, -1, 24, 6, NULL, NULL, 1, 1, 1);
INSERT INTO `kardex` VALUES (37, 5, 132000, NULL, NULL, NULL, -1, 24, 1, NULL, NULL, 1, 1, 1);
INSERT INTO `kardex` VALUES (38, 3, 45000, 3, NULL, NULL, 0, 14, 4, 1, 4, 1, 1, 1);
INSERT INTO `kardex` VALUES (39, 5, 45000, NULL, NULL, NULL, 0, 14, 4, 1, 4, 1, 1, 1);
INSERT INTO `kardex` VALUES (40, 10, 132000, NULL, NULL, NULL, 0, 14, 1, 1, 4, 1, 1, 1);
INSERT INTO `kardex` VALUES (43, 10, 132000, 2, NULL, NULL, 0, 14, 1, 1, 4, 1, 1, 1);
INSERT INTO `kardex` VALUES (44, 7, 50001, 5, NULL, NULL, 1, 12, 4, 1, 4, NULL, 1, 1);
INSERT INTO `kardex` VALUES (45, 1, 45000, NULL, NULL, NULL, -1, 25, 4, NULL, NULL, 1, 1, 1);
INSERT INTO `kardex` VALUES (46, 3, 132000, NULL, NULL, NULL, -1, 25, 1, NULL, NULL, 1, 1, 1);
INSERT INTO `kardex` VALUES (47, 2, 132000, NULL, NULL, NULL, -1, 26, 1, NULL, NULL, 1, 1, 1);
INSERT INTO `kardex` VALUES (50, 5, 50000, NULL, NULL, NULL, -1, 28, 3, NULL, NULL, 1, 1, 1);
INSERT INTO `kardex` VALUES (51, 2, 25000, 5, NULL, NULL, -1, 28, 6, NULL, NULL, 1, 1, 1);
INSERT INTO `kardex` VALUES (52, 5, 100000, NULL, NULL, NULL, -1, 28, 2, NULL, NULL, 1, 1, 1);
INSERT INTO `kardex` VALUES (53, 4, 25000, 5, NULL, NULL, -1, 29, 6, NULL, NULL, 1, 1, 1);
INSERT INTO `kardex` VALUES (58, 6, 4700, NULL, NULL, NULL, 1, 27, 4, NULL, NULL, NULL, 1, 1);
INSERT INTO `kardex` VALUES (59, 6, 25000, NULL, NULL, NULL, 1, 27, 6, NULL, NULL, NULL, 1, 1);
INSERT INTO `kardex` VALUES (60, 2, 45000, NULL, NULL, NULL, 1, 27, 4, NULL, NULL, NULL, 1, 1);
INSERT INTO `kardex` VALUES (64, 2, 45000, NULL, NULL, NULL, 0, 33, 4, NULL, NULL, 1, 1, 1);
INSERT INTO `kardex` VALUES (65, 2, 4700, NULL, NULL, NULL, 0, 34, 4, NULL, NULL, 1, 1, 1);
INSERT INTO `kardex` VALUES (66, 1, 25000, NULL, NULL, NULL, 0, 34, 6, NULL, NULL, 1, 1, 1);
INSERT INTO `kardex` VALUES (67, 2, 45000, NULL, NULL, NULL, 0, 35, 4, NULL, NULL, 1, 1, 1);
INSERT INTO `kardex` VALUES (68, 2, 45000, NULL, NULL, NULL, 0, 36, 4, NULL, NULL, 1, 1, 1);
INSERT INTO `kardex` VALUES (69, 10, 132000, NULL, NULL, NULL, 0, 37, 1, NULL, NULL, 1, 1, 1);
INSERT INTO `kardex` VALUES (70, 6, 45000, NULL, NULL, NULL, 0, 38, 4, NULL, NULL, 1, 1, 1);
INSERT INTO `kardex` VALUES (71, 6, 50000, NULL, NULL, NULL, 0, 39, 3, NULL, NULL, 1, 1, 1);
INSERT INTO `kardex` VALUES (72, 10, 50000, NULL, NULL, NULL, 0, 39, 4, NULL, NULL, 1, 1, 1);
INSERT INTO `kardex` VALUES (73, 5, 25000, NULL, NULL, NULL, 0, 39, 6, NULL, NULL, 1, 1, 1);
INSERT INTO `kardex` VALUES (74, 2, 100000, NULL, NULL, NULL, 0, 39, 2, NULL, NULL, 1, 1, 1);
INSERT INTO `kardex` VALUES (75, 10, 132000, NULL, NULL, NULL, 0, 39, 1, NULL, NULL, 1, 1, 1);
INSERT INTO `kardex` VALUES (79, 3, 132000, NULL, NULL, 'Cotización', 0, 40, 1, NULL, NULL, 1, 1, 1);
INSERT INTO `kardex` VALUES (80, 4, 100000, NULL, NULL, 'Cotización', 0, 40, 2, NULL, NULL, 1, 1, 1);
INSERT INTO `kardex` VALUES (81, 5, 45000, NULL, NULL, NULL, 0, 41, 4, NULL, NULL, 1, 1, 1);
INSERT INTO `kardex` VALUES (82, 5, 50000, NULL, NULL, NULL, 0, 42, 4, 1, 4, 1, 1, 1);
INSERT INTO `kardex` VALUES (83, 5, 100000, NULL, NULL, NULL, 0, 42, 2, NULL, 4, 1, 1, 1);
INSERT INTO `kardex` VALUES (84, 5, 132000, NULL, NULL, NULL, 0, 43, 1, 1, 4, 1, 1, 1);
INSERT INTO `kardex` VALUES (85, 10, 1500, NULL, NULL, NULL, -1, 44, 10, 1, 4, 2, 1, 1);

-- ----------------------------
-- Table structure for kardex_estado
-- ----------------------------
DROP TABLE IF EXISTS `kardex_estado`;
CREATE TABLE `kardex_estado`  (
  `Id_KarEst` int NOT NULL AUTO_INCREMENT,
  `Nombre_KarEst` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Estado_KarEst` enum('Activo','Inactivo') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Activo',
  `FechaRegistro_KarEst` timestamp NULL DEFAULT current_timestamp,
  PRIMARY KEY (`Id_KarEst`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of kardex_estado
-- ----------------------------
INSERT INTO `kardex_estado` VALUES (1, 'Activo', 'Activo', '2020-04-11 21:12:27');
INSERT INTO `kardex_estado` VALUES (2, 'Inactivo', 'Activo', '2020-04-11 21:12:32');

-- ----------------------------
-- Table structure for kardex_tipo
-- ----------------------------
DROP TABLE IF EXISTS `kardex_tipo`;
CREATE TABLE `kardex_tipo`  (
  `Id_KarTip` int NOT NULL AUTO_INCREMENT,
  `Nombre_KarTip` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Estado_KarTip` enum('Activo','Inactivo') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Activo',
  `FechaRegistro_KarTip` timestamp NULL DEFAULT current_timestamp,
  PRIMARY KEY (`Id_KarTip`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of kardex_tipo
-- ----------------------------
INSERT INTO `kardex_tipo` VALUES (1, 'Ingreso', 'Activo', '2020-04-11 21:12:10');
INSERT INTO `kardex_tipo` VALUES (2, 'Egreso', 'Activo', '2020-04-11 21:12:17');

-- ----------------------------
-- Table structure for lista_precios
-- ----------------------------
DROP TABLE IF EXISTS `lista_precios`;
CREATE TABLE `lista_precios`  (
  `Id_ListPre` int NOT NULL AUTO_INCREMENT,
  `Nombre_ListPre` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Estado_ListPre` enum('Activo','Inactivo') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Activo',
  `Valor_Incremento` double NULL DEFAULT NULL,
  `Porcentaje_Incremento` double NULL DEFAULT NULL,
  `Primary_Usu` int NULL DEFAULT NULL,
  PRIMARY KEY (`Id_ListPre`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of lista_precios
-- ----------------------------
INSERT INTO `lista_precios` VALUES (1, 'General', 'Activo', NULL, 25, 7);
INSERT INTO `lista_precios` VALUES (2, 'Ventas por mayor', 'Activo', NULL, 15, 7);
INSERT INTO `lista_precios` VALUES (3, 'General', 'Activo', NULL, 17, 1);
INSERT INTO `lista_precios` VALUES (4, 'Promoción', 'Activo', NULL, 20, 1);
INSERT INTO `lista_precios` VALUES (5, 'Precio mayoristas', 'Activo', 1000, 10, 1);

-- ----------------------------
-- Table structure for marcas
-- ----------------------------
DROP TABLE IF EXISTS `marcas`;
CREATE TABLE `marcas`  (
  `Id_Mar` int NOT NULL AUTO_INCREMENT,
  `Nombre_Mar` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `FechaRegistro` timestamp NULL DEFAULT current_timestamp,
  `Estado_Mar` enum('Activo','Inactivo') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Activo',
  `Primary_Usu` int NULL DEFAULT NULL,
  PRIMARY KEY (`Id_Mar`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of marcas
-- ----------------------------

-- ----------------------------
-- Table structure for medidas
-- ----------------------------
DROP TABLE IF EXISTS `medidas`;
CREATE TABLE `medidas`  (
  `Id_Med` int NOT NULL AUTO_INCREMENT,
  `Nombre_Med` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Valor_Med` double NULL DEFAULT NULL,
  `Unidad_Med` char(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Estado_Med` enum('Activo','Inactivo') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Activo',
  `Primary_Usu` int NULL DEFAULT NULL,
  PRIMARY KEY (`Id_Med`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of medidas
-- ----------------------------
INSERT INTO `medidas` VALUES (1, 'Kilogramos', 1000, 'Kg', 'Activo', 1);

-- ----------------------------
-- Table structure for mensaje_estado
-- ----------------------------
DROP TABLE IF EXISTS `mensaje_estado`;
CREATE TABLE `mensaje_estado`  (
  `Id_MenEst` int NOT NULL AUTO_INCREMENT,
  `Nombre_MenEst` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Id_MenEst`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of mensaje_estado
-- ----------------------------

-- ----------------------------
-- Table structure for mensaje_responsables
-- ----------------------------
DROP TABLE IF EXISTS `mensaje_responsables`;
CREATE TABLE `mensaje_responsables`  (
  `Id_MenRes` int NOT NULL AUTO_INCREMENT,
  `FechaAsignacion_MenRes` datetime NULL DEFAULT NULL,
  `EstadoResponsable_MenRes` enum('Activo','Inactivo') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Activo',
  `Id_MenEst` int NULL DEFAULT NULL,
  `Id_Men` int NULL DEFAULT NULL,
  `Id_Usu_Remitente` int NULL DEFAULT NULL,
  `Id_Usu_Destinatario` int NULL DEFAULT NULL,
  PRIMARY KEY (`Id_MenRes`) USING BTREE,
  INDEX `fk_mensaje_responsables_mensaje_estado1_idx`(`Id_MenEst`) USING BTREE,
  INDEX `fk_mensaje_responsables_mensajes1_idx`(`Id_Men`) USING BTREE,
  INDEX `fk_mensaje_responsables_usuario1_idx`(`Id_Usu_Remitente`) USING BTREE,
  INDEX `fk_mensaje_responsables_usuario2_idx`(`Id_Usu_Destinatario`) USING BTREE,
  CONSTRAINT `fk_mensaje_responsables_mensaje_estado1` FOREIGN KEY (`Id_MenEst`) REFERENCES `mensaje_estado` (`Id_MenEst`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_mensaje_responsables_mensajes1` FOREIGN KEY (`Id_Men`) REFERENCES `mensajes` (`Id_Men`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_mensaje_responsables_usuario1` FOREIGN KEY (`Id_Usu_Remitente`) REFERENCES `usuario` (`Id_Usu`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_mensaje_responsables_usuario2` FOREIGN KEY (`Id_Usu_Destinatario`) REFERENCES `usuario` (`Id_Usu`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of mensaje_responsables
-- ----------------------------

-- ----------------------------
-- Table structure for mensaje_tipo
-- ----------------------------
DROP TABLE IF EXISTS `mensaje_tipo`;
CREATE TABLE `mensaje_tipo`  (
  `Id_MenTip` int NOT NULL AUTO_INCREMENT,
  `Nombre_MenTip` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Id_MenTip`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of mensaje_tipo
-- ----------------------------

-- ----------------------------
-- Table structure for mensajes
-- ----------------------------
DROP TABLE IF EXISTS `mensajes`;
CREATE TABLE `mensajes`  (
  `Id_Men` int NOT NULL AUTO_INCREMENT,
  `Asunto_Men` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `Mensaje_Men` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `FechaRegistro_Men` datetime NULL DEFAULT NULL,
  `FechaVisto_Men` datetime NULL DEFAULT NULL,
  `DestinatarioEmail_Men` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Estado_Men` enum('Activo','Inactivo') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Activo',
  `Masivo_Men` tinyint NULL DEFAULT 0,
  `Id_MenTip` int NULL DEFAULT NULL,
  `Id_Per` int NULL DEFAULT NULL COMMENT 'Destinatario mensaje',
  `Primary_Usu` int NULL DEFAULT NULL,
  PRIMARY KEY (`Id_Men`) USING BTREE,
  INDEX `fk_mensajes_mensaje_tipo1_idx`(`Id_MenTip`) USING BTREE,
  INDEX `fk_mensajes_persona1_idx`(`Id_Per`) USING BTREE,
  CONSTRAINT `fk_mensajes_mensaje_tipo1` FOREIGN KEY (`Id_MenTip`) REFERENCES `mensaje_tipo` (`Id_MenTip`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_mensajes_persona1` FOREIGN KEY (`Id_Per`) REFERENCES `persona` (`Id_Per`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = '	' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of mensajes
-- ----------------------------
INSERT INTO `mensajes` VALUES (7, NULL, 'Este es un mensaje', '2020-04-20 00:00:00', NULL, 'madertu@hotmail.com', NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for metodo_pago
-- ----------------------------
DROP TABLE IF EXISTS `metodo_pago`;
CREATE TABLE `metodo_pago`  (
  `Id_MetPag` int NOT NULL AUTO_INCREMENT,
  `Nombre_MetPag` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Estado_MePag` enum('Activo','Inactivo') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Activo',
  `FechaRegistro` timestamp NULL DEFAULT current_timestamp,
  `Primary_Usu` int NULL DEFAULT NULL,
  PRIMARY KEY (`Id_MetPag`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of metodo_pago
-- ----------------------------
INSERT INTO `metodo_pago` VALUES (1, 'Efectivo', 'Activo', '2020-04-14 17:04:30', 7);
INSERT INTO `metodo_pago` VALUES (2, 'Efectivo', 'Activo', '2020-04-20 09:04:52', 1);
INSERT INTO `metodo_pago` VALUES (3, 'Tarjeta débito', 'Activo', '2020-04-20 09:04:19', 1);
INSERT INTO `metodo_pago` VALUES (4, 'Tarjeta crédito', 'Activo', '2020-04-20 09:04:42', 1);
INSERT INTO `metodo_pago` VALUES (5, 'Cheque', 'Activo', '2020-04-20 09:04:07', 1);

-- ----------------------------
-- Table structure for municipio
-- ----------------------------
DROP TABLE IF EXISTS `municipio`;
CREATE TABLE `municipio`  (
  `Id_Mun` int NOT NULL AUTO_INCREMENT,
  `Nombre_Num` varchar(90) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Codigo_Mun` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Id_Dep` int NULL DEFAULT NULL,
  PRIMARY KEY (`Id_Mun`) USING BTREE,
  INDEX `fk_municipio_departamento1_idx`(`Id_Dep`) USING BTREE,
  CONSTRAINT `fk_municipio_departamento1` FOREIGN KEY (`Id_Dep`) REFERENCES `departamento` (`Id_Dep`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1127 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of municipio
-- ----------------------------
INSERT INTO `municipio` VALUES (1, 'MEDELLIN', '1', 1);
INSERT INTO `municipio` VALUES (2, 'ABEJORRAL', '2', 1);
INSERT INTO `municipio` VALUES (3, 'ABRIAQUI', '4', 1);
INSERT INTO `municipio` VALUES (4, 'ALEJANDRIA', '21', 1);
INSERT INTO `municipio` VALUES (5, 'AMAGA', '30', 1);
INSERT INTO `municipio` VALUES (6, 'AMALFI', '31', 1);
INSERT INTO `municipio` VALUES (7, 'ANDES', '34', 1);
INSERT INTO `municipio` VALUES (8, 'ANGELOPOLIS', '36', 1);
INSERT INTO `municipio` VALUES (9, 'ANGOSTURA', '38', 1);
INSERT INTO `municipio` VALUES (10, 'ANORI', '40', 1);
INSERT INTO `municipio` VALUES (11, 'ANTIOQUIA', '42', 1);
INSERT INTO `municipio` VALUES (12, 'ANZA', '44', 1);
INSERT INTO `municipio` VALUES (13, 'APARTADO', '45', 1);
INSERT INTO `municipio` VALUES (14, 'ARBOLETES', '51', 1);
INSERT INTO `municipio` VALUES (15, 'ARGELIA', '55', 1);
INSERT INTO `municipio` VALUES (16, 'ARMENIA', '59', 1);
INSERT INTO `municipio` VALUES (17, 'BARBOSA', '79', 1);
INSERT INTO `municipio` VALUES (18, 'BELMIRA', '86', 1);
INSERT INTO `municipio` VALUES (19, 'BELLO', '88', 1);
INSERT INTO `municipio` VALUES (20, 'BETANIA', '91', 1);
INSERT INTO `municipio` VALUES (21, 'BETULIA', '93', 1);
INSERT INTO `municipio` VALUES (22, 'BOLIVAR', '101', 1);
INSERT INTO `municipio` VALUES (23, 'BRICEÑO', '107', 1);
INSERT INTO `municipio` VALUES (24, 'BURITICA', '113', 1);
INSERT INTO `municipio` VALUES (25, 'CACERES', '120', 1);
INSERT INTO `municipio` VALUES (26, 'CAICEDO', '125', 1);
INSERT INTO `municipio` VALUES (27, 'CALDAS', '129', 1);
INSERT INTO `municipio` VALUES (28, 'CAMPAMENTO', '134', 1);
INSERT INTO `municipio` VALUES (29, 'CAÑASGORDAS', '138', 1);
INSERT INTO `municipio` VALUES (30, 'CARACOLI', '142', 1);
INSERT INTO `municipio` VALUES (31, 'CARAMANTA', '145', 1);
INSERT INTO `municipio` VALUES (32, 'CAREPA', '147', 1);
INSERT INTO `municipio` VALUES (33, 'CARMEN DE VIBORAL', '148', 1);
INSERT INTO `municipio` VALUES (34, 'CAROLINA', '150', 1);
INSERT INTO `municipio` VALUES (35, 'CAUCASIA', '154', 1);
INSERT INTO `municipio` VALUES (36, 'CHIGORODO', '172', 1);
INSERT INTO `municipio` VALUES (37, 'CISNEROS', '190', 1);
INSERT INTO `municipio` VALUES (38, 'COCORNA', '197', 1);
INSERT INTO `municipio` VALUES (39, 'CONCEPCION', '206', 1);
INSERT INTO `municipio` VALUES (40, 'CONCORDIA', '209', 1);
INSERT INTO `municipio` VALUES (41, 'COPACABANA', '212', 1);
INSERT INTO `municipio` VALUES (42, 'DABEIBA', '234', 1);
INSERT INTO `municipio` VALUES (43, 'DON MATIAS', '237', 1);
INSERT INTO `municipio` VALUES (44, 'EBEJICO', '240', 1);
INSERT INTO `municipio` VALUES (45, 'EL BAGRE', '250', 1);
INSERT INTO `municipio` VALUES (46, 'ENTRERRIOS', '264', 1);
INSERT INTO `municipio` VALUES (47, 'ENVIGADO', '266', 1);
INSERT INTO `municipio` VALUES (48, 'FREDONIA', '282', 1);
INSERT INTO `municipio` VALUES (49, 'FRONTINO', '284', 1);
INSERT INTO `municipio` VALUES (50, 'GIRALDO', '306', 1);
INSERT INTO `municipio` VALUES (51, 'GIRARDOTA', '308', 1);
INSERT INTO `municipio` VALUES (52, 'GOMEZ PLATA', '310', 1);
INSERT INTO `municipio` VALUES (53, 'GRANADA', '313', 1);
INSERT INTO `municipio` VALUES (54, 'GUADALUPE', '315', 1);
INSERT INTO `municipio` VALUES (55, 'GUARNE', '318', 1);
INSERT INTO `municipio` VALUES (56, 'GUATAPE', '321', 1);
INSERT INTO `municipio` VALUES (57, 'HELICONIA', '347', 1);
INSERT INTO `municipio` VALUES (58, 'HISPANIA', '353', 1);
INSERT INTO `municipio` VALUES (59, 'ITAGUI', '360', 1);
INSERT INTO `municipio` VALUES (60, 'ITUANGO', '361', 1);
INSERT INTO `municipio` VALUES (61, 'JARDIN', '364', 1);
INSERT INTO `municipio` VALUES (62, 'JERICO', '368', 1);
INSERT INTO `municipio` VALUES (63, 'LA CEJA', '376', 1);
INSERT INTO `municipio` VALUES (64, 'LA ESTRELLA', '380', 1);
INSERT INTO `municipio` VALUES (65, 'LA PINTADA', '390', 1);
INSERT INTO `municipio` VALUES (66, 'LA UNION', '400', 1);
INSERT INTO `municipio` VALUES (67, 'LIBORINA', '411', 1);
INSERT INTO `municipio` VALUES (68, 'MACEO', '425', 1);
INSERT INTO `municipio` VALUES (69, 'MARINILLA', '440', 1);
INSERT INTO `municipio` VALUES (70, 'MONTEBELLO', '467', 1);
INSERT INTO `municipio` VALUES (71, 'MURINDO', '475', 1);
INSERT INTO `municipio` VALUES (72, 'MUTATA', '480', 1);
INSERT INTO `municipio` VALUES (73, 'NARIÑO', '483', 1);
INSERT INTO `municipio` VALUES (74, 'NECOCLI', '490', 1);
INSERT INTO `municipio` VALUES (75, 'NECHI', '495', 1);
INSERT INTO `municipio` VALUES (76, 'OLAYA', '501', 1);
INSERT INTO `municipio` VALUES (77, 'PEÑOL', '541', 1);
INSERT INTO `municipio` VALUES (78, 'PEQUE', '543', 1);
INSERT INTO `municipio` VALUES (79, 'PUEBLORRICO', '576', 1);
INSERT INTO `municipio` VALUES (80, 'PUERTO BERRIO', '579', 1);
INSERT INTO `municipio` VALUES (81, 'PUERTO NARE (LA MAGDALENA)', '585', 1);
INSERT INTO `municipio` VALUES (82, 'PUERTO TRIUNFO', '591', 1);
INSERT INTO `municipio` VALUES (83, 'REMEDIOS', '604', 1);
INSERT INTO `municipio` VALUES (84, 'RETIRO', '607', 1);
INSERT INTO `municipio` VALUES (85, 'RIONEGRO', '615', 1);
INSERT INTO `municipio` VALUES (86, 'SABANALARGA', '628', 1);
INSERT INTO `municipio` VALUES (87, 'SABANETA', '631', 1);
INSERT INTO `municipio` VALUES (88, 'SALGAR', '642', 1);
INSERT INTO `municipio` VALUES (89, 'SAN ANDRES', '647', 1);
INSERT INTO `municipio` VALUES (90, 'SAN CARLOS', '649', 1);
INSERT INTO `municipio` VALUES (91, 'SAN FRANCISCO', '652', 1);
INSERT INTO `municipio` VALUES (92, 'SAN JERONIMO', '656', 1);
INSERT INTO `municipio` VALUES (93, 'SAN JOSE DE LA MONTAÑA', '658', 1);
INSERT INTO `municipio` VALUES (94, 'SAN JUAN DE URABA', '659', 1);
INSERT INTO `municipio` VALUES (95, 'SAN LUIS', '660', 1);
INSERT INTO `municipio` VALUES (96, 'SAN PEDRO', '664', 1);
INSERT INTO `municipio` VALUES (97, 'SAN PEDRO DE URABA', '665', 1);
INSERT INTO `municipio` VALUES (98, 'SAN RAFAEL', '667', 1);
INSERT INTO `municipio` VALUES (99, 'SAN ROQUE', '670', 1);
INSERT INTO `municipio` VALUES (100, 'SAN VICENTE', '674', 1);
INSERT INTO `municipio` VALUES (101, 'SANTA BARBARA', '679', 1);
INSERT INTO `municipio` VALUES (102, 'SANTA ROSA DE OSOS', '686', 1);
INSERT INTO `municipio` VALUES (103, 'SANTO DOMINGO', '690', 1);
INSERT INTO `municipio` VALUES (104, 'SANTUARIO', '697', 1);
INSERT INTO `municipio` VALUES (105, 'SEGOVIA', '736', 1);
INSERT INTO `municipio` VALUES (106, 'SONSON', '756', 1);
INSERT INTO `municipio` VALUES (107, 'SOPETRAN', '761', 1);
INSERT INTO `municipio` VALUES (108, 'TAMESIS', '789', 1);
INSERT INTO `municipio` VALUES (109, 'TARAZA', '790', 1);
INSERT INTO `municipio` VALUES (110, 'TARSO', '792', 1);
INSERT INTO `municipio` VALUES (111, 'TITIRIBI', '809', 1);
INSERT INTO `municipio` VALUES (112, 'TOLEDO', '819', 1);
INSERT INTO `municipio` VALUES (113, 'TURBO', '837', 1);
INSERT INTO `municipio` VALUES (114, 'URAMITA', '842', 1);
INSERT INTO `municipio` VALUES (115, 'URRAO', '847', 1);
INSERT INTO `municipio` VALUES (116, 'VALDIVIA', '854', 1);
INSERT INTO `municipio` VALUES (117, 'VALPARAISO', '856', 1);
INSERT INTO `municipio` VALUES (118, 'VEGACHI', '858', 1);
INSERT INTO `municipio` VALUES (119, 'VENECIA', '861', 1);
INSERT INTO `municipio` VALUES (120, 'VIGIA DEL FUERTE', '873', 1);
INSERT INTO `municipio` VALUES (121, 'YALI', '885', 1);
INSERT INTO `municipio` VALUES (122, 'YARUMAL', '887', 1);
INSERT INTO `municipio` VALUES (123, 'YOLOMBO', '890', 1);
INSERT INTO `municipio` VALUES (124, 'YONDO', '893', 1);
INSERT INTO `municipio` VALUES (125, 'ZARAGOZA', '895', 1);
INSERT INTO `municipio` VALUES (126, 'BARRANQUILLA (DISTRITO ESPECIAL INDUSTRIAL Y PORTUARIO DE BARRANQUILLA)', '1', 2);
INSERT INTO `municipio` VALUES (127, 'BARANOA', '78', 2);
INSERT INTO `municipio` VALUES (128, 'CAMPO DE LA CRUZ', '137', 2);
INSERT INTO `municipio` VALUES (129, 'CANDELARIA', '141', 2);
INSERT INTO `municipio` VALUES (130, 'GALAPA', '296', 2);
INSERT INTO `municipio` VALUES (131, 'JUAN DE ACOSTA', '372', 2);
INSERT INTO `municipio` VALUES (132, 'LURUACO', '421', 2);
INSERT INTO `municipio` VALUES (133, 'MALAMBO', '433', 2);
INSERT INTO `municipio` VALUES (134, 'MANATI', '436', 2);
INSERT INTO `municipio` VALUES (135, 'PALMAR DE VARELA', '520', 2);
INSERT INTO `municipio` VALUES (136, 'PIOJO', '549', 2);
INSERT INTO `municipio` VALUES (137, 'POLO NUEVO', '558', 2);
INSERT INTO `municipio` VALUES (138, 'PONEDERA', '560', 2);
INSERT INTO `municipio` VALUES (139, 'PUERTO COLOMBIA', '573', 2);
INSERT INTO `municipio` VALUES (140, 'REPELON', '606', 2);
INSERT INTO `municipio` VALUES (141, 'SABANAGRANDE', '634', 2);
INSERT INTO `municipio` VALUES (142, 'SABANALARGA', '638', 2);
INSERT INTO `municipio` VALUES (143, 'SANTA LUCIA', '675', 2);
INSERT INTO `municipio` VALUES (144, 'SANTO TOMAS', '685', 2);
INSERT INTO `municipio` VALUES (145, 'SOLEDAD', '758', 2);
INSERT INTO `municipio` VALUES (146, 'SUAN', '770', 2);
INSERT INTO `municipio` VALUES (147, 'TUBARA', '832', 2);
INSERT INTO `municipio` VALUES (148, 'USIACURI', '849', 2);
INSERT INTO `municipio` VALUES (149, 'Santa Fe de Bogotá', '1', 3);
INSERT INTO `municipio` VALUES (150, 'USAQUEN', '1', 3);
INSERT INTO `municipio` VALUES (151, 'CHAPINERO', '2', 3);
INSERT INTO `municipio` VALUES (152, 'SANTA FE', '3', 3);
INSERT INTO `municipio` VALUES (153, 'SAN CRISTOBAL', '4', 3);
INSERT INTO `municipio` VALUES (154, 'USME', '5', 3);
INSERT INTO `municipio` VALUES (155, 'TUNJUELITO', '6', 3);
INSERT INTO `municipio` VALUES (156, 'BOSA', '7', 3);
INSERT INTO `municipio` VALUES (157, 'KENNEDY', '8', 3);
INSERT INTO `municipio` VALUES (158, 'FONTIBON', '9', 3);
INSERT INTO `municipio` VALUES (159, 'ENGATIVA', '10', 3);
INSERT INTO `municipio` VALUES (160, 'SUBA', '11', 3);
INSERT INTO `municipio` VALUES (161, 'BARRIOS UNIDOS', '12', 3);
INSERT INTO `municipio` VALUES (162, 'TEUSAQUILLO', '13', 3);
INSERT INTO `municipio` VALUES (163, 'MARTIRES', '14', 3);
INSERT INTO `municipio` VALUES (164, 'ANTONIO NARIÑO', '15', 3);
INSERT INTO `municipio` VALUES (165, 'PUENTE ARANDA', '16', 3);
INSERT INTO `municipio` VALUES (166, 'CANDELARIA', '17', 3);
INSERT INTO `municipio` VALUES (167, 'RAFAEL URIBE', '18', 3);
INSERT INTO `municipio` VALUES (168, 'CIUDAD BOLIVAR', '19', 3);
INSERT INTO `municipio` VALUES (169, 'SUMAPAZ', '20', 3);
INSERT INTO `municipio` VALUES (170, 'CARTAGENA (DISTRITO TURISTICO Y CULTURAL DE CARTAGENA)', '1', 4);
INSERT INTO `municipio` VALUES (171, 'ACHI', '6', 4);
INSERT INTO `municipio` VALUES (172, 'ALTOS DEL ROSARIO', '30', 4);
INSERT INTO `municipio` VALUES (173, 'ARENAL', '42', 4);
INSERT INTO `municipio` VALUES (174, 'ARJONA', '52', 4);
INSERT INTO `municipio` VALUES (175, 'ARROYOHONDO', '62', 4);
INSERT INTO `municipio` VALUES (176, 'BARRANCO DE LOBA', '74', 4);
INSERT INTO `municipio` VALUES (177, 'CALAMAR', '140', 4);
INSERT INTO `municipio` VALUES (178, 'CANTAGALLO', '160', 4);
INSERT INTO `municipio` VALUES (179, 'CICUCO', '188', 4);
INSERT INTO `municipio` VALUES (180, 'CORDOBA', '212', 4);
INSERT INTO `municipio` VALUES (181, 'CLEMENCIA', '222', 4);
INSERT INTO `municipio` VALUES (182, 'EL CARMEN DE BOLIVAR', '244', 4);
INSERT INTO `municipio` VALUES (183, 'EL GUAMO', '248', 4);
INSERT INTO `municipio` VALUES (184, 'EL PEÑON', '268', 4);
INSERT INTO `municipio` VALUES (185, 'HATILLO DE LOBA', '300', 4);
INSERT INTO `municipio` VALUES (186, 'MAGANGUE', '430', 4);
INSERT INTO `municipio` VALUES (187, 'MAHATES', '433', 4);
INSERT INTO `municipio` VALUES (188, 'MARGARITA', '440', 4);
INSERT INTO `municipio` VALUES (189, 'MARIA LA BAJA', '442', 4);
INSERT INTO `municipio` VALUES (190, 'MONTECRISTO', '458', 4);
INSERT INTO `municipio` VALUES (191, 'MOMPOS', '468', 4);
INSERT INTO `municipio` VALUES (192, 'MORALES', '473', 4);
INSERT INTO `municipio` VALUES (193, 'PINILLOS', '549', 4);
INSERT INTO `municipio` VALUES (194, 'REGIDOR', '580', 4);
INSERT INTO `municipio` VALUES (195, 'RIO VIEJO', '600', 4);
INSERT INTO `municipio` VALUES (196, 'SAN CRISTOBAL', '620', 4);
INSERT INTO `municipio` VALUES (197, 'SAN ESTANISLAO', '647', 4);
INSERT INTO `municipio` VALUES (198, 'SAN FERNANDO', '650', 4);
INSERT INTO `municipio` VALUES (199, 'SAN JACINTO', '654', 4);
INSERT INTO `municipio` VALUES (200, 'SAN JACINTO DEL CAUCA', '655', 4);
INSERT INTO `municipio` VALUES (201, 'SAN JUAN NEPOMUCENO', '657', 4);
INSERT INTO `municipio` VALUES (202, 'SAN MARTIN DE LOBA', '667', 4);
INSERT INTO `municipio` VALUES (203, 'SAN PABLO', '670', 4);
INSERT INTO `municipio` VALUES (204, 'SANTA CATALINA', '673', 4);
INSERT INTO `municipio` VALUES (205, 'SANTA ROSA', '683', 4);
INSERT INTO `municipio` VALUES (206, 'SANTA ROSA DEL SUR', '688', 4);
INSERT INTO `municipio` VALUES (207, 'SIMITI', '744', 4);
INSERT INTO `municipio` VALUES (208, 'SOPLAVIENTO', '760', 4);
INSERT INTO `municipio` VALUES (209, 'TALAIGUA NUEVO', '780', 4);
INSERT INTO `municipio` VALUES (210, 'TIQUISIO (PUERTO RICO)', '810', 4);
INSERT INTO `municipio` VALUES (211, 'TURBACO', '836', 4);
INSERT INTO `municipio` VALUES (212, 'TURBANA', '838', 4);
INSERT INTO `municipio` VALUES (213, 'VILLANUEVA', '873', 4);
INSERT INTO `municipio` VALUES (214, 'ZAMBRANO', '894', 4);
INSERT INTO `municipio` VALUES (215, 'TUNJA', '1', 5);
INSERT INTO `municipio` VALUES (216, 'ALMEIDA', '22', 5);
INSERT INTO `municipio` VALUES (217, 'AQUITANIA', '47', 5);
INSERT INTO `municipio` VALUES (218, 'ARCABUCO', '51', 5);
INSERT INTO `municipio` VALUES (219, 'BELEN', '87', 5);
INSERT INTO `municipio` VALUES (220, 'BERBEO', '90', 5);
INSERT INTO `municipio` VALUES (221, 'BETEITIVA', '92', 5);
INSERT INTO `municipio` VALUES (222, 'BOAVITA', '97', 5);
INSERT INTO `municipio` VALUES (223, 'BOYACA', '104', 5);
INSERT INTO `municipio` VALUES (224, 'BRICEÑO', '106', 5);
INSERT INTO `municipio` VALUES (225, 'BUENAVISTA', '109', 5);
INSERT INTO `municipio` VALUES (226, 'BUSBANZA', '114', 5);
INSERT INTO `municipio` VALUES (227, 'CALDAS', '131', 5);
INSERT INTO `municipio` VALUES (228, 'CAMPOHERMOSO', '135', 5);
INSERT INTO `municipio` VALUES (229, 'CERINZA', '162', 5);
INSERT INTO `municipio` VALUES (230, 'CHINAVITA', '172', 5);
INSERT INTO `municipio` VALUES (231, 'CHIQUINQUIRA', '176', 5);
INSERT INTO `municipio` VALUES (232, 'CHISCAS', '180', 5);
INSERT INTO `municipio` VALUES (233, 'CHITA', '183', 5);
INSERT INTO `municipio` VALUES (234, 'CHITARAQUE', '185', 5);
INSERT INTO `municipio` VALUES (235, 'CHIVATA', '187', 5);
INSERT INTO `municipio` VALUES (236, 'CIENEGA', '189', 5);
INSERT INTO `municipio` VALUES (237, 'COMBITA', '204', 5);
INSERT INTO `municipio` VALUES (238, 'COPER', '212', 5);
INSERT INTO `municipio` VALUES (239, 'CORRALES', '215', 5);
INSERT INTO `municipio` VALUES (240, 'COVARACHIA', '218', 5);
INSERT INTO `municipio` VALUES (241, 'CUBARA', '223', 5);
INSERT INTO `municipio` VALUES (242, 'CUCAITA', '224', 5);
INSERT INTO `municipio` VALUES (243, 'CUITIVA', '226', 5);
INSERT INTO `municipio` VALUES (244, 'CHIQUIZA', '232', 5);
INSERT INTO `municipio` VALUES (245, 'CHIVOR', '236', 5);
INSERT INTO `municipio` VALUES (246, 'DUITAMA', '238', 5);
INSERT INTO `municipio` VALUES (247, 'EL COCUY', '244', 5);
INSERT INTO `municipio` VALUES (248, 'EL ESPINO', '248', 5);
INSERT INTO `municipio` VALUES (249, 'FIRAVITOBA', '272', 5);
INSERT INTO `municipio` VALUES (250, 'FLORESTA', '276', 5);
INSERT INTO `municipio` VALUES (251, 'GACHANTIVA', '293', 5);
INSERT INTO `municipio` VALUES (252, 'GAMEZA', '296', 5);
INSERT INTO `municipio` VALUES (253, 'GARAGOA', '299', 5);
INSERT INTO `municipio` VALUES (254, 'GUACAMAYAS', '317', 5);
INSERT INTO `municipio` VALUES (255, 'GUATEQUE', '322', 5);
INSERT INTO `municipio` VALUES (256, 'GUAYATA', '325', 5);
INSERT INTO `municipio` VALUES (257, 'GUICAN', '332', 5);
INSERT INTO `municipio` VALUES (258, 'IZA', '362', 5);
INSERT INTO `municipio` VALUES (259, 'JENESANO', '367', 5);
INSERT INTO `municipio` VALUES (260, 'JERICO', '368', 5);
INSERT INTO `municipio` VALUES (261, 'LABRANZAGRANDE', '377', 5);
INSERT INTO `municipio` VALUES (262, 'LA CAPILLA', '380', 5);
INSERT INTO `municipio` VALUES (263, 'LA VICTORIA', '401', 5);
INSERT INTO `municipio` VALUES (264, 'LA UVITA', '403', 5);
INSERT INTO `municipio` VALUES (265, 'VILLA DE LEIVA', '407', 5);
INSERT INTO `municipio` VALUES (266, 'MACANAL', '425', 5);
INSERT INTO `municipio` VALUES (267, 'MARIPI', '442', 5);
INSERT INTO `municipio` VALUES (268, 'MIRAFLORES', '455', 5);
INSERT INTO `municipio` VALUES (269, 'MONGUA', '464', 5);
INSERT INTO `municipio` VALUES (270, 'MONGUI', '466', 5);
INSERT INTO `municipio` VALUES (271, 'MONIQUIRA', '469', 5);
INSERT INTO `municipio` VALUES (272, 'MOTAVITA', '476', 5);
INSERT INTO `municipio` VALUES (273, 'MUZO', '480', 5);
INSERT INTO `municipio` VALUES (274, 'NOBSA', '491', 5);
INSERT INTO `municipio` VALUES (275, 'NUEVO COLON', '494', 5);
INSERT INTO `municipio` VALUES (276, 'OICATA', '500', 5);
INSERT INTO `municipio` VALUES (277, 'OTANCHE', '507', 5);
INSERT INTO `municipio` VALUES (278, 'PACHAVITA', '511', 5);
INSERT INTO `municipio` VALUES (279, 'PAEZ', '514', 5);
INSERT INTO `municipio` VALUES (280, 'PAIPA', '516', 5);
INSERT INTO `municipio` VALUES (281, 'PAJARITO', '518', 5);
INSERT INTO `municipio` VALUES (282, 'PANQUEBA', '522', 5);
INSERT INTO `municipio` VALUES (283, 'PAUNA', '531', 5);
INSERT INTO `municipio` VALUES (284, 'PAYA', '533', 5);
INSERT INTO `municipio` VALUES (285, 'PAZ DEL RIO', '537', 5);
INSERT INTO `municipio` VALUES (286, 'PESCA', '542', 5);
INSERT INTO `municipio` VALUES (287, 'PISBA', '550', 5);
INSERT INTO `municipio` VALUES (288, 'PUERTO BOYACA', '572', 5);
INSERT INTO `municipio` VALUES (289, 'QUIPAMA', '580', 5);
INSERT INTO `municipio` VALUES (290, 'RAMIRIQUI', '599', 5);
INSERT INTO `municipio` VALUES (291, 'RAQUIRA', '600', 5);
INSERT INTO `municipio` VALUES (292, 'RONDON', '621', 5);
INSERT INTO `municipio` VALUES (293, 'SABOYA', '632', 5);
INSERT INTO `municipio` VALUES (294, 'SACHICA', '638', 5);
INSERT INTO `municipio` VALUES (295, 'SAMACA', '646', 5);
INSERT INTO `municipio` VALUES (296, 'SAN EDUARDO', '660', 5);
INSERT INTO `municipio` VALUES (297, 'SAN JOSE DE PARE', '664', 5);
INSERT INTO `municipio` VALUES (298, 'SAN LUIS DE GACENO', '667', 5);
INSERT INTO `municipio` VALUES (299, 'SAN MATEO', '673', 5);
INSERT INTO `municipio` VALUES (300, 'SAN MIGUEL DE SEMA', '676', 5);
INSERT INTO `municipio` VALUES (301, 'SAN PABLO DE BORBUR', '681', 5);
INSERT INTO `municipio` VALUES (302, 'SANTANA', '686', 5);
INSERT INTO `municipio` VALUES (303, 'SANTA MARIA', '690', 5);
INSERT INTO `municipio` VALUES (304, 'SANTA ROSA DE VITERBO', '693', 5);
INSERT INTO `municipio` VALUES (305, 'SANTA SOFIA', '696', 5);
INSERT INTO `municipio` VALUES (306, 'SATIVANORTE', '720', 5);
INSERT INTO `municipio` VALUES (307, 'SATIVASUR', '723', 5);
INSERT INTO `municipio` VALUES (308, 'SIACHOQUE', '740', 5);
INSERT INTO `municipio` VALUES (309, 'SOATA', '753', 5);
INSERT INTO `municipio` VALUES (310, 'SOCOTA', '755', 5);
INSERT INTO `municipio` VALUES (311, 'SOCHA', '757', 5);
INSERT INTO `municipio` VALUES (312, 'SOGAMOSO', '759', 5);
INSERT INTO `municipio` VALUES (313, 'SOMONDOCO', '761', 5);
INSERT INTO `municipio` VALUES (314, 'SORA', '762', 5);
INSERT INTO `municipio` VALUES (315, 'SOTAQUIRA', '763', 5);
INSERT INTO `municipio` VALUES (316, 'SORACA', '764', 5);
INSERT INTO `municipio` VALUES (317, 'SUSACON', '774', 5);
INSERT INTO `municipio` VALUES (318, 'SUTAMARCHAN', '776', 5);
INSERT INTO `municipio` VALUES (319, 'SUTATENZA', '778', 5);
INSERT INTO `municipio` VALUES (320, 'TASCO', '790', 5);
INSERT INTO `municipio` VALUES (321, 'TENZA', '798', 5);
INSERT INTO `municipio` VALUES (322, 'TIBANA', '804', 5);
INSERT INTO `municipio` VALUES (323, 'TIBASOSA', '806', 5);
INSERT INTO `municipio` VALUES (324, 'TINJACA', '808', 5);
INSERT INTO `municipio` VALUES (325, 'TIPACOQUE', '810', 5);
INSERT INTO `municipio` VALUES (326, 'TOCA', '814', 5);
INSERT INTO `municipio` VALUES (327, 'TOGUI', '816', 5);
INSERT INTO `municipio` VALUES (328, 'TOPAGA', '820', 5);
INSERT INTO `municipio` VALUES (329, 'TOTA', '822', 5);
INSERT INTO `municipio` VALUES (330, 'TUNUNGUA', '832', 5);
INSERT INTO `municipio` VALUES (331, 'TURMEQUE', '835', 5);
INSERT INTO `municipio` VALUES (332, 'TUTA', '837', 5);
INSERT INTO `municipio` VALUES (333, 'TUTASA', '839', 5);
INSERT INTO `municipio` VALUES (334, 'UMBITA', '842', 5);
INSERT INTO `municipio` VALUES (335, 'VENTAQUEMADA', '861', 5);
INSERT INTO `municipio` VALUES (336, 'VIRACACHA', '879', 5);
INSERT INTO `municipio` VALUES (337, 'ZETAQUIRA', '897', 5);
INSERT INTO `municipio` VALUES (338, 'MANIZALES', '1', 6);
INSERT INTO `municipio` VALUES (339, 'AGUADAS', '13', 6);
INSERT INTO `municipio` VALUES (340, 'ANSERMA', '42', 6);
INSERT INTO `municipio` VALUES (341, 'ARANZAZU', '50', 6);
INSERT INTO `municipio` VALUES (342, 'BELALCAZAR', '88', 6);
INSERT INTO `municipio` VALUES (343, 'CHINCHINA', '174', 6);
INSERT INTO `municipio` VALUES (344, 'FILADELFIA', '272', 6);
INSERT INTO `municipio` VALUES (345, 'LA DORADA', '380', 6);
INSERT INTO `municipio` VALUES (346, 'LA MERCED', '388', 6);
INSERT INTO `municipio` VALUES (347, 'MANZANARES', '433', 6);
INSERT INTO `municipio` VALUES (348, 'MARMATO', '442', 6);
INSERT INTO `municipio` VALUES (349, 'MARQUETALIA', '444', 6);
INSERT INTO `municipio` VALUES (350, 'MARULANDA', '446', 6);
INSERT INTO `municipio` VALUES (351, 'NEIRA', '486', 6);
INSERT INTO `municipio` VALUES (352, 'NORCASIA', '495', 6);
INSERT INTO `municipio` VALUES (353, 'PACORA', '513', 6);
INSERT INTO `municipio` VALUES (354, 'PALESTINA', '524', 6);
INSERT INTO `municipio` VALUES (355, 'PENSILVANIA', '541', 6);
INSERT INTO `municipio` VALUES (356, 'RIOSUCIO', '614', 6);
INSERT INTO `municipio` VALUES (357, 'RISARALDA', '616', 6);
INSERT INTO `municipio` VALUES (358, 'SALAMINA', '653', 6);
INSERT INTO `municipio` VALUES (359, 'SAMANA', '662', 6);
INSERT INTO `municipio` VALUES (360, 'SAN JOSE', '665', 6);
INSERT INTO `municipio` VALUES (361, 'SUPIA', '777', 6);
INSERT INTO `municipio` VALUES (362, 'VICTORIA', '867', 6);
INSERT INTO `municipio` VALUES (363, 'VILLAMARIA', '873', 6);
INSERT INTO `municipio` VALUES (364, 'VITERBO', '877', 6);
INSERT INTO `municipio` VALUES (365, 'FLORENCIA', '1', 7);
INSERT INTO `municipio` VALUES (366, 'ALBANIA', '29', 7);
INSERT INTO `municipio` VALUES (367, 'BELEN DE LOS ANDAQUIES', '94', 7);
INSERT INTO `municipio` VALUES (368, 'CARTAGENA DEL CHAIRA', '150', 7);
INSERT INTO `municipio` VALUES (369, 'CURILLO', '205', 7);
INSERT INTO `municipio` VALUES (370, 'EL DONCELLO', '247', 7);
INSERT INTO `municipio` VALUES (371, 'EL PAUJIL', '256', 7);
INSERT INTO `municipio` VALUES (372, 'LA MONTAÑITA', '410', 7);
INSERT INTO `municipio` VALUES (373, 'MILAN', '460', 7);
INSERT INTO `municipio` VALUES (374, 'MORELIA', '479', 7);
INSERT INTO `municipio` VALUES (375, 'PUERTO RICO', '592', 7);
INSERT INTO `municipio` VALUES (376, 'SAN JOSE DE FRAGUA', '610', 7);
INSERT INTO `municipio` VALUES (377, 'SAN VICENTE DEL CAGUAN', '753', 7);
INSERT INTO `municipio` VALUES (378, 'SOLANO', '756', 7);
INSERT INTO `municipio` VALUES (379, 'SOLITA', '785', 7);
INSERT INTO `municipio` VALUES (380, 'VALPARAISO', '860', 7);
INSERT INTO `municipio` VALUES (381, 'POPAYAN', '1', 8);
INSERT INTO `municipio` VALUES (382, 'ALMAGUER', '22', 8);
INSERT INTO `municipio` VALUES (383, 'ARGELIA', '50', 8);
INSERT INTO `municipio` VALUES (384, 'BALBOA', '75', 8);
INSERT INTO `municipio` VALUES (385, 'BOLIVAR', '100', 8);
INSERT INTO `municipio` VALUES (386, 'BUENOS AIRES', '110', 8);
INSERT INTO `municipio` VALUES (387, 'CAJIBIO', '130', 8);
INSERT INTO `municipio` VALUES (388, 'CALDONO', '137', 8);
INSERT INTO `municipio` VALUES (389, 'CALOTO', '142', 8);
INSERT INTO `municipio` VALUES (390, 'CORINTO', '212', 8);
INSERT INTO `municipio` VALUES (391, 'EL TAMBO', '256', 8);
INSERT INTO `municipio` VALUES (392, 'FLORENCIA', '290', 8);
INSERT INTO `municipio` VALUES (393, 'GUAPI', '318', 8);
INSERT INTO `municipio` VALUES (394, 'INZA', '355', 8);
INSERT INTO `municipio` VALUES (395, 'JAMBALO', '364', 8);
INSERT INTO `municipio` VALUES (396, 'LA SIERRA', '392', 8);
INSERT INTO `municipio` VALUES (397, 'LA VEGA', '397', 8);
INSERT INTO `municipio` VALUES (398, 'LOPEZ (MICAY)', '418', 8);
INSERT INTO `municipio` VALUES (399, 'MERCADERES', '450', 8);
INSERT INTO `municipio` VALUES (400, 'MIRANDA', '455', 8);
INSERT INTO `municipio` VALUES (401, 'MORALES', '473', 8);
INSERT INTO `municipio` VALUES (402, 'PADILLA', '513', 8);
INSERT INTO `municipio` VALUES (403, 'PAEZ (BELALCAZAR)', '517', 8);
INSERT INTO `municipio` VALUES (404, 'PATIA (EL BORDO)', '532', 8);
INSERT INTO `municipio` VALUES (405, 'PIAMONTE', '533', 8);
INSERT INTO `municipio` VALUES (406, 'PIENDAMO', '548', 8);
INSERT INTO `municipio` VALUES (407, 'PUERTO TEJADA', '573', 8);
INSERT INTO `municipio` VALUES (408, 'PURACE (COCONUCO)', '585', 8);
INSERT INTO `municipio` VALUES (409, 'ROSAS', '622', 8);
INSERT INTO `municipio` VALUES (410, 'SAN SEBASTIAN', '693', 8);
INSERT INTO `municipio` VALUES (411, 'SANTANDER DE QUILICHAO', '698', 8);
INSERT INTO `municipio` VALUES (412, 'SANTA ROSA', '701', 8);
INSERT INTO `municipio` VALUES (413, 'SILVIA', '743', 8);
INSERT INTO `municipio` VALUES (414, 'SOTARA (PAISPAMBA)', '760', 8);
INSERT INTO `municipio` VALUES (415, 'SUAREZ', '780', 8);
INSERT INTO `municipio` VALUES (416, 'TIMBIO', '807', 8);
INSERT INTO `municipio` VALUES (417, 'TIMBIQUI', '809', 8);
INSERT INTO `municipio` VALUES (418, 'TORIBIO', '821', 8);
INSERT INTO `municipio` VALUES (419, 'TOTORO', '824', 8);
INSERT INTO `municipio` VALUES (420, 'VILLARICA', '845', 8);
INSERT INTO `municipio` VALUES (421, 'VALLEDUPAR', '1', 9);
INSERT INTO `municipio` VALUES (422, 'AGUACHICA', '11', 9);
INSERT INTO `municipio` VALUES (423, 'AGUSTIN CODAZZI', '13', 9);
INSERT INTO `municipio` VALUES (424, 'ASTREA', '32', 9);
INSERT INTO `municipio` VALUES (425, 'BECERRIL', '45', 9);
INSERT INTO `municipio` VALUES (426, 'BOSCONIA', '60', 9);
INSERT INTO `municipio` VALUES (427, 'CHIMICHAGUA', '175', 9);
INSERT INTO `municipio` VALUES (428, 'CHIRIGUANA', '178', 9);
INSERT INTO `municipio` VALUES (429, 'CURUMANI', '228', 9);
INSERT INTO `municipio` VALUES (430, 'EL COPEY', '238', 9);
INSERT INTO `municipio` VALUES (431, 'EL PASO', '250', 9);
INSERT INTO `municipio` VALUES (432, 'GAMARRA', '295', 9);
INSERT INTO `municipio` VALUES (433, 'GONZALEZ', '310', 9);
INSERT INTO `municipio` VALUES (434, 'LA GLORIA', '383', 9);
INSERT INTO `municipio` VALUES (435, 'LA JAGUA IBIRICO', '400', 9);
INSERT INTO `municipio` VALUES (436, 'MANAURE (BALCON DEL CESAR)', '443', 9);
INSERT INTO `municipio` VALUES (437, 'PAILITAS', '517', 9);
INSERT INTO `municipio` VALUES (438, 'PELAYA', '550', 9);
INSERT INTO `municipio` VALUES (439, 'PUEBLO BELLO', '570', 9);
INSERT INTO `municipio` VALUES (440, 'RIO DE ORO', '614', 9);
INSERT INTO `municipio` VALUES (441, 'LA PAZ (ROBLES)', '621', 9);
INSERT INTO `municipio` VALUES (442, 'SAN ALBERTO', '710', 9);
INSERT INTO `municipio` VALUES (443, 'SAN DIEGO', '750', 9);
INSERT INTO `municipio` VALUES (444, 'SAN MARTIN', '770', 9);
INSERT INTO `municipio` VALUES (445, 'TAMALAMEQUE', '787', 9);
INSERT INTO `municipio` VALUES (446, 'MONTERIA', '1', 10);
INSERT INTO `municipio` VALUES (447, 'AYAPEL', '68', 10);
INSERT INTO `municipio` VALUES (448, 'BUENAVISTA', '79', 10);
INSERT INTO `municipio` VALUES (449, 'CANALETE', '90', 10);
INSERT INTO `municipio` VALUES (450, 'CERETE', '162', 10);
INSERT INTO `municipio` VALUES (451, 'CHIMA', '168', 10);
INSERT INTO `municipio` VALUES (452, 'CHINU', '182', 10);
INSERT INTO `municipio` VALUES (453, 'CIENAGA DE ORO', '189', 10);
INSERT INTO `municipio` VALUES (454, 'COTORRA', '300', 10);
INSERT INTO `municipio` VALUES (455, 'LA APARTADA', '350', 10);
INSERT INTO `municipio` VALUES (456, 'LORICA', '417', 10);
INSERT INTO `municipio` VALUES (457, 'LOS CORDOBAS', '419', 10);
INSERT INTO `municipio` VALUES (458, 'MOMIL', '464', 10);
INSERT INTO `municipio` VALUES (459, 'MONTELIBANO', '466', 10);
INSERT INTO `municipio` VALUES (460, 'MOÑITOS', '500', 10);
INSERT INTO `municipio` VALUES (461, 'PLANETA RICA', '555', 10);
INSERT INTO `municipio` VALUES (462, 'PUEBLO NUEVO', '570', 10);
INSERT INTO `municipio` VALUES (463, 'PUERTO ESCONDIDO', '574', 10);
INSERT INTO `municipio` VALUES (464, 'PUERTO LIBERTADOR', '580', 10);
INSERT INTO `municipio` VALUES (465, 'PURISIMA', '586', 10);
INSERT INTO `municipio` VALUES (466, 'SAHAGUN', '660', 10);
INSERT INTO `municipio` VALUES (467, 'SAN ANDRES SOTAVENTO', '670', 10);
INSERT INTO `municipio` VALUES (468, 'SAN ANTERO', '672', 10);
INSERT INTO `municipio` VALUES (469, 'SAN BERNARDO DEL VIENTO', '675', 10);
INSERT INTO `municipio` VALUES (470, 'SAN CARLOS', '678', 10);
INSERT INTO `municipio` VALUES (471, 'SAN PELAYO', '686', 10);
INSERT INTO `municipio` VALUES (472, 'TIERRALTA', '807', 10);
INSERT INTO `municipio` VALUES (473, 'VALENCIA', '855', 10);
INSERT INTO `municipio` VALUES (474, 'AGUA DE DIOS', '1', 11);
INSERT INTO `municipio` VALUES (475, 'ALBAN', '19', 11);
INSERT INTO `municipio` VALUES (476, 'ANAPOIMA', '35', 11);
INSERT INTO `municipio` VALUES (477, 'ANOLAIMA', '40', 11);
INSERT INTO `municipio` VALUES (478, 'ARBELAEZ', '53', 11);
INSERT INTO `municipio` VALUES (479, 'BELTRAN', '86', 11);
INSERT INTO `municipio` VALUES (480, 'BITUIMA', '95', 11);
INSERT INTO `municipio` VALUES (481, 'BOJACA', '99', 11);
INSERT INTO `municipio` VALUES (482, 'CABRERA', '120', 11);
INSERT INTO `municipio` VALUES (483, 'CACHIPAY', '123', 11);
INSERT INTO `municipio` VALUES (484, 'CAJICA', '126', 11);
INSERT INTO `municipio` VALUES (485, 'CAPARRAPI', '148', 11);
INSERT INTO `municipio` VALUES (486, 'CAQUEZA', '151', 11);
INSERT INTO `municipio` VALUES (487, 'CARMEN DE CARUPA', '154', 11);
INSERT INTO `municipio` VALUES (488, 'CHAGUANI', '168', 11);
INSERT INTO `municipio` VALUES (489, 'CHIA', '175', 11);
INSERT INTO `municipio` VALUES (490, 'CHIPAQUE', '178', 11);
INSERT INTO `municipio` VALUES (491, 'CHOACHI', '181', 11);
INSERT INTO `municipio` VALUES (492, 'CHOCONTA', '183', 11);
INSERT INTO `municipio` VALUES (493, 'COGUA', '200', 11);
INSERT INTO `municipio` VALUES (494, 'COTA', '214', 11);
INSERT INTO `municipio` VALUES (495, 'CUCUNUBA', '224', 11);
INSERT INTO `municipio` VALUES (496, 'EL COLEGIO', '245', 11);
INSERT INTO `municipio` VALUES (497, 'EL PEÑON', '258', 11);
INSERT INTO `municipio` VALUES (498, 'EL ROSAL', '260', 11);
INSERT INTO `municipio` VALUES (499, 'FACATATIVA', '269', 11);
INSERT INTO `municipio` VALUES (500, 'FOMEQUE', '279', 11);
INSERT INTO `municipio` VALUES (501, 'FOSCA', '281', 11);
INSERT INTO `municipio` VALUES (502, 'FUNZA', '286', 11);
INSERT INTO `municipio` VALUES (503, 'FUQUENE', '288', 11);
INSERT INTO `municipio` VALUES (504, 'FUSAGASUGA', '290', 11);
INSERT INTO `municipio` VALUES (505, 'GACHALA', '293', 11);
INSERT INTO `municipio` VALUES (506, 'GACHANCIPA', '295', 11);
INSERT INTO `municipio` VALUES (507, 'GACHETA', '297', 11);
INSERT INTO `municipio` VALUES (508, 'GAMA', '299', 11);
INSERT INTO `municipio` VALUES (509, 'GIRARDOT', '307', 11);
INSERT INTO `municipio` VALUES (510, 'GRANADA', '312', 11);
INSERT INTO `municipio` VALUES (511, 'GUACHETA', '317', 11);
INSERT INTO `municipio` VALUES (512, 'GUADUAS', '320', 11);
INSERT INTO `municipio` VALUES (513, 'GUASCA', '322', 11);
INSERT INTO `municipio` VALUES (514, 'GUATAQUI', '324', 11);
INSERT INTO `municipio` VALUES (515, 'GUATAVITA', '326', 11);
INSERT INTO `municipio` VALUES (516, 'GUAYABAL DE SIQUIMA', '328', 11);
INSERT INTO `municipio` VALUES (517, 'GUAYABETAL', '335', 11);
INSERT INTO `municipio` VALUES (518, 'GUTIERREZ', '339', 11);
INSERT INTO `municipio` VALUES (519, 'JERUSALEN', '368', 11);
INSERT INTO `municipio` VALUES (520, 'JUNIN', '372', 11);
INSERT INTO `municipio` VALUES (521, 'LA CALERA', '377', 11);
INSERT INTO `municipio` VALUES (522, 'LA MESA', '386', 11);
INSERT INTO `municipio` VALUES (523, 'LA PALMA', '394', 11);
INSERT INTO `municipio` VALUES (524, 'LA PEÑA', '398', 11);
INSERT INTO `municipio` VALUES (525, 'LA VEGA', '402', 11);
INSERT INTO `municipio` VALUES (526, 'LENGUAZAQUE', '407', 11);
INSERT INTO `municipio` VALUES (527, 'MACHETA', '426', 11);
INSERT INTO `municipio` VALUES (528, 'MADRID', '430', 11);
INSERT INTO `municipio` VALUES (529, 'MANTA', '436', 11);
INSERT INTO `municipio` VALUES (530, 'MEDINA', '438', 11);
INSERT INTO `municipio` VALUES (531, 'MOSQUERA', '473', 11);
INSERT INTO `municipio` VALUES (532, 'NARIÑO', '483', 11);
INSERT INTO `municipio` VALUES (533, 'NEMOCON', '486', 11);
INSERT INTO `municipio` VALUES (534, 'NILO', '488', 11);
INSERT INTO `municipio` VALUES (535, 'NIMAIMA', '489', 11);
INSERT INTO `municipio` VALUES (536, 'NOCAIMA', '491', 11);
INSERT INTO `municipio` VALUES (537, 'VENECIA (OSPINA PEREZ)', '506', 11);
INSERT INTO `municipio` VALUES (538, 'PACHO', '513', 11);
INSERT INTO `municipio` VALUES (539, 'PAIME', '518', 11);
INSERT INTO `municipio` VALUES (540, 'PANDI', '524', 11);
INSERT INTO `municipio` VALUES (541, 'PARATEBUENO', '530', 11);
INSERT INTO `municipio` VALUES (542, 'PASCA', '535', 11);
INSERT INTO `municipio` VALUES (543, 'PUERTO SALGAR', '572', 11);
INSERT INTO `municipio` VALUES (544, 'PULI', '580', 11);
INSERT INTO `municipio` VALUES (545, 'QUEBRADANEGRA', '592', 11);
INSERT INTO `municipio` VALUES (546, 'QUETAME', '594', 11);
INSERT INTO `municipio` VALUES (547, 'QUIPILE', '596', 11);
INSERT INTO `municipio` VALUES (548, 'APULO (RAFAEL REYES)', '599', 11);
INSERT INTO `municipio` VALUES (549, 'RICAURTE', '612', 11);
INSERT INTO `municipio` VALUES (550, 'SAN ANTONIO DEL TEQUENDAMA', '645', 11);
INSERT INTO `municipio` VALUES (551, 'SAN BERNARDO', '649', 11);
INSERT INTO `municipio` VALUES (552, 'SAN CAYETANO', '653', 11);
INSERT INTO `municipio` VALUES (553, 'SAN FRANCISCO', '658', 11);
INSERT INTO `municipio` VALUES (554, 'SAN JUAN DE RIOSECO', '662', 11);
INSERT INTO `municipio` VALUES (555, 'SASAIMA', '718', 11);
INSERT INTO `municipio` VALUES (556, 'SESQUILE', '736', 11);
INSERT INTO `municipio` VALUES (557, 'SIBATE', '740', 11);
INSERT INTO `municipio` VALUES (558, 'SILVANIA', '743', 11);
INSERT INTO `municipio` VALUES (559, 'SIMIJACA', '745', 11);
INSERT INTO `municipio` VALUES (560, 'SOACHA', '754', 11);
INSERT INTO `municipio` VALUES (561, 'SOPO', '758', 11);
INSERT INTO `municipio` VALUES (562, 'SUBACHOQUE', '769', 11);
INSERT INTO `municipio` VALUES (563, 'SUESCA', '772', 11);
INSERT INTO `municipio` VALUES (564, 'SUPATA', '777', 11);
INSERT INTO `municipio` VALUES (565, 'SUSA', '779', 11);
INSERT INTO `municipio` VALUES (566, 'SUTATAUSA', '781', 11);
INSERT INTO `municipio` VALUES (567, 'TABIO', '785', 11);
INSERT INTO `municipio` VALUES (568, 'TAUSA', '793', 11);
INSERT INTO `municipio` VALUES (569, 'TENA', '797', 11);
INSERT INTO `municipio` VALUES (570, 'TENJO', '799', 11);
INSERT INTO `municipio` VALUES (571, 'TIBACUY', '805', 11);
INSERT INTO `municipio` VALUES (572, 'TIBIRITA', '807', 11);
INSERT INTO `municipio` VALUES (573, 'TOCAIMA', '815', 11);
INSERT INTO `municipio` VALUES (574, 'TOCANCIPA', '817', 11);
INSERT INTO `municipio` VALUES (575, 'TOPAIPI', '823', 11);
INSERT INTO `municipio` VALUES (576, 'UBALA', '839', 11);
INSERT INTO `municipio` VALUES (577, 'UBAQUE', '841', 11);
INSERT INTO `municipio` VALUES (578, 'UBATE', '843', 11);
INSERT INTO `municipio` VALUES (579, 'UNE', '845', 11);
INSERT INTO `municipio` VALUES (580, 'UTICA', '851', 11);
INSERT INTO `municipio` VALUES (581, 'VERGARA', '862', 11);
INSERT INTO `municipio` VALUES (582, 'VIANI', '867', 11);
INSERT INTO `municipio` VALUES (583, 'VILLAGOMEZ', '871', 11);
INSERT INTO `municipio` VALUES (584, 'VILLAPINZON', '873', 11);
INSERT INTO `municipio` VALUES (585, 'VILLETA', '875', 11);
INSERT INTO `municipio` VALUES (586, 'VIOTA', '878', 11);
INSERT INTO `municipio` VALUES (587, 'YACOPI', '885', 11);
INSERT INTO `municipio` VALUES (588, 'ZIPACON', '898', 11);
INSERT INTO `municipio` VALUES (589, 'ZIPAQUIRA', '899', 11);
INSERT INTO `municipio` VALUES (590, 'QUIBDO (SAN FRANCISCO DE QUIBDO)', '1', 12);
INSERT INTO `municipio` VALUES (591, 'ACANDI', '6', 12);
INSERT INTO `municipio` VALUES (592, 'ALTO BAUDO (PIE DE PATO)', '25', 12);
INSERT INTO `municipio` VALUES (593, 'ATRATO', '50', 12);
INSERT INTO `municipio` VALUES (594, 'BAGADO', '73', 12);
INSERT INTO `municipio` VALUES (595, 'BAHIA SOLANO (MUTIS)', '75', 12);
INSERT INTO `municipio` VALUES (596, 'BAJO BAUDO (PIZARRO)', '77', 12);
INSERT INTO `municipio` VALUES (597, 'BOJAYA (BELLAVISTA)', '99', 12);
INSERT INTO `municipio` VALUES (598, 'CANTON DE SAN PABLO (MANAGRU)', '135', 12);
INSERT INTO `municipio` VALUES (599, 'CONDOTO', '205', 12);
INSERT INTO `municipio` VALUES (600, 'EL CARMEN DE ATRATO', '245', 12);
INSERT INTO `municipio` VALUES (601, 'LITORAL DEL BAJO SAN JUAN (SANTA GENOVEVA DE DOCORDO)', '250', 12);
INSERT INTO `municipio` VALUES (602, 'ISTMINA', '361', 12);
INSERT INTO `municipio` VALUES (603, 'JURADO', '372', 12);
INSERT INTO `municipio` VALUES (604, 'LLORO', '413', 12);
INSERT INTO `municipio` VALUES (605, 'MEDIO ATRATO', '425', 12);
INSERT INTO `municipio` VALUES (606, 'MEDIO BAUDO', '430', 12);
INSERT INTO `municipio` VALUES (607, 'NOVITA', '491', 12);
INSERT INTO `municipio` VALUES (608, 'NUQUI', '495', 12);
INSERT INTO `municipio` VALUES (609, 'RIOQUITO', '600', 12);
INSERT INTO `municipio` VALUES (610, 'RIOSUCIO', '615', 12);
INSERT INTO `municipio` VALUES (611, 'SAN JOSE DEL PALMAR', '660', 12);
INSERT INTO `municipio` VALUES (612, 'SIPI', '745', 12);
INSERT INTO `municipio` VALUES (613, 'TADO', '787', 12);
INSERT INTO `municipio` VALUES (614, 'UNGUIA', '800', 12);
INSERT INTO `municipio` VALUES (615, 'UNION PANAMERICANA', '810', 12);
INSERT INTO `municipio` VALUES (616, 'NEIVA', '1', 13);
INSERT INTO `municipio` VALUES (617, 'ACEVEDO', '6', 13);
INSERT INTO `municipio` VALUES (618, 'AGRADO', '13', 13);
INSERT INTO `municipio` VALUES (619, 'AIPE', '16', 13);
INSERT INTO `municipio` VALUES (620, 'ALGECIRAS', '20', 13);
INSERT INTO `municipio` VALUES (621, 'ALTAMIRA', '26', 13);
INSERT INTO `municipio` VALUES (622, 'BARAYA', '78', 13);
INSERT INTO `municipio` VALUES (623, 'CAMPOALEGRE', '132', 13);
INSERT INTO `municipio` VALUES (624, 'COLOMBIA', '206', 13);
INSERT INTO `municipio` VALUES (625, 'ELIAS', '244', 13);
INSERT INTO `municipio` VALUES (626, 'GARZON', '298', 13);
INSERT INTO `municipio` VALUES (627, 'GIGANTE', '306', 13);
INSERT INTO `municipio` VALUES (628, 'GUADALUPE', '319', 13);
INSERT INTO `municipio` VALUES (629, 'HOBO', '349', 13);
INSERT INTO `municipio` VALUES (630, 'IQUIRA', '357', 13);
INSERT INTO `municipio` VALUES (631, 'ISNOS (SAN JOSE DE ISNOS)', '359', 13);
INSERT INTO `municipio` VALUES (632, 'LA ARGENTINA', '378', 13);
INSERT INTO `municipio` VALUES (633, 'LA PLATA', '396', 13);
INSERT INTO `municipio` VALUES (634, 'NATAGA', '483', 13);
INSERT INTO `municipio` VALUES (635, 'OPORAPA', '503', 13);
INSERT INTO `municipio` VALUES (636, 'PAICOL', '518', 13);
INSERT INTO `municipio` VALUES (637, 'PALERMO', '524', 13);
INSERT INTO `municipio` VALUES (638, 'PALESTINA', '530', 13);
INSERT INTO `municipio` VALUES (639, 'PITAL', '548', 13);
INSERT INTO `municipio` VALUES (640, 'PITALITO', '551', 13);
INSERT INTO `municipio` VALUES (641, 'RIVERA', '615', 13);
INSERT INTO `municipio` VALUES (642, 'SALADOBLANCO', '660', 13);
INSERT INTO `municipio` VALUES (643, 'SAN AGUSTIN', '668', 13);
INSERT INTO `municipio` VALUES (644, 'SANTA MARIA', '676', 13);
INSERT INTO `municipio` VALUES (645, 'SUAZA', '770', 13);
INSERT INTO `municipio` VALUES (646, 'TARQUI', '791', 13);
INSERT INTO `municipio` VALUES (647, 'TESALIA', '797', 13);
INSERT INTO `municipio` VALUES (648, 'TELLO', '799', 13);
INSERT INTO `municipio` VALUES (649, 'TERUEL', '801', 13);
INSERT INTO `municipio` VALUES (650, 'TIMANA', '807', 13);
INSERT INTO `municipio` VALUES (651, 'VILLAVIEJA', '872', 13);
INSERT INTO `municipio` VALUES (652, 'YAGUARA', '885', 13);
INSERT INTO `municipio` VALUES (653, 'RIOHACHA', '1', 14);
INSERT INTO `municipio` VALUES (654, 'BARRANCAS', '78', 14);
INSERT INTO `municipio` VALUES (655, 'DIBULLA', '90', 14);
INSERT INTO `municipio` VALUES (656, 'DISTRACCION', '98', 14);
INSERT INTO `municipio` VALUES (657, 'EL MOLINO', '110', 14);
INSERT INTO `municipio` VALUES (658, 'FONSECA', '279', 14);
INSERT INTO `municipio` VALUES (659, 'HATONUEVO', '378', 14);
INSERT INTO `municipio` VALUES (660, 'LA JAGUA DEL PILAR', '420', 14);
INSERT INTO `municipio` VALUES (661, 'MAICAO', '430', 14);
INSERT INTO `municipio` VALUES (662, 'MANAURE', '560', 14);
INSERT INTO `municipio` VALUES (663, 'SAN JUAN DEL CESAR', '650', 14);
INSERT INTO `municipio` VALUES (664, 'URIBIA', '847', 14);
INSERT INTO `municipio` VALUES (665, 'URUMITA', '855', 14);
INSERT INTO `municipio` VALUES (666, 'VILLANUEVA', '874', 14);
INSERT INTO `municipio` VALUES (667, 'SANTA MARTA (DISTRITO TURISTICO CULTURAL E HISTORICO DE SANTA MARTA)', '1', 15);
INSERT INTO `municipio` VALUES (668, 'ALGARROBO', '30', 15);
INSERT INTO `municipio` VALUES (669, 'ARACATACA', '53', 15);
INSERT INTO `municipio` VALUES (670, 'ARIGUANI (EL DIFICIL)', '58', 15);
INSERT INTO `municipio` VALUES (671, 'CERRO SAN ANTONIO', '161', 15);
INSERT INTO `municipio` VALUES (672, 'CHIVOLO', '170', 15);
INSERT INTO `municipio` VALUES (673, 'CIENAGA', '189', 15);
INSERT INTO `municipio` VALUES (674, 'CONCORDIA', '205', 15);
INSERT INTO `municipio` VALUES (675, 'EL BANCO', '245', 15);
INSERT INTO `municipio` VALUES (676, 'EL PIÑON', '258', 15);
INSERT INTO `municipio` VALUES (677, 'EL RETEN', '268', 15);
INSERT INTO `municipio` VALUES (678, 'FUNDACION', '288', 15);
INSERT INTO `municipio` VALUES (679, 'GUAMAL', '318', 15);
INSERT INTO `municipio` VALUES (680, 'PEDRAZA', '541', 15);
INSERT INTO `municipio` VALUES (681, 'PIJIÑO DEL CARMEN (PIJIÑO)', '545', 15);
INSERT INTO `municipio` VALUES (682, 'PIVIJAY', '551', 15);
INSERT INTO `municipio` VALUES (683, 'PLATO', '555', 15);
INSERT INTO `municipio` VALUES (684, 'PUEBLOVIEJO', '570', 15);
INSERT INTO `municipio` VALUES (685, 'REMOLINO', '605', 15);
INSERT INTO `municipio` VALUES (686, 'SABANAS DE SAN ANGEL', '660', 15);
INSERT INTO `municipio` VALUES (687, 'SALAMINA', '675', 15);
INSERT INTO `municipio` VALUES (688, 'SAN SEBASTIAN DE BUENAVISTA', '692', 15);
INSERT INTO `municipio` VALUES (689, 'SAN ZENON', '703', 15);
INSERT INTO `municipio` VALUES (690, 'SANTA ANA', '707', 15);
INSERT INTO `municipio` VALUES (691, 'SITIONUEVO', '745', 15);
INSERT INTO `municipio` VALUES (692, 'TENERIFE', '798', 15);
INSERT INTO `municipio` VALUES (693, 'VILLAVICENCIO', '1', 16);
INSERT INTO `municipio` VALUES (694, 'ACACIAS', '6', 16);
INSERT INTO `municipio` VALUES (695, 'BARRANCA DE UPIA', '110', 16);
INSERT INTO `municipio` VALUES (696, 'CABUYARO', '124', 16);
INSERT INTO `municipio` VALUES (697, 'CASTILLA LA NUEVA', '150', 16);
INSERT INTO `municipio` VALUES (698, 'SAN LUIS DE CUBARRAL', '223', 16);
INSERT INTO `municipio` VALUES (699, 'CUMARAL', '226', 16);
INSERT INTO `municipio` VALUES (700, 'EL CALVARIO', '245', 16);
INSERT INTO `municipio` VALUES (701, 'EL CASTILLO', '251', 16);
INSERT INTO `municipio` VALUES (702, 'EL DORADO', '270', 16);
INSERT INTO `municipio` VALUES (703, 'FUENTE DE ORO', '287', 16);
INSERT INTO `municipio` VALUES (704, 'GRANADA', '313', 16);
INSERT INTO `municipio` VALUES (705, 'GUAMAL', '318', 16);
INSERT INTO `municipio` VALUES (706, 'MAPIRIPAN', '325', 16);
INSERT INTO `municipio` VALUES (707, 'MESETAS', '330', 16);
INSERT INTO `municipio` VALUES (708, 'LA MACARENA', '350', 16);
INSERT INTO `municipio` VALUES (709, 'LA URIBE', '370', 16);
INSERT INTO `municipio` VALUES (710, 'LEJANIAS', '400', 16);
INSERT INTO `municipio` VALUES (711, 'PUERTO CONCORDIA', '450', 16);
INSERT INTO `municipio` VALUES (712, 'PUERTO GAITAN', '568', 16);
INSERT INTO `municipio` VALUES (713, 'PUERTO LOPEZ', '573', 16);
INSERT INTO `municipio` VALUES (714, 'PUERTO LLERAS', '577', 16);
INSERT INTO `municipio` VALUES (715, 'PUERTO RICO', '590', 16);
INSERT INTO `municipio` VALUES (716, 'RESTREPO', '606', 16);
INSERT INTO `municipio` VALUES (717, 'SAN CARLOS DE GUAROA', '680', 16);
INSERT INTO `municipio` VALUES (718, 'SAN JUAN DE ARAMA', '683', 16);
INSERT INTO `municipio` VALUES (719, 'SAN JUANITO', '686', 16);
INSERT INTO `municipio` VALUES (720, 'SAN MARTIN', '689', 16);
INSERT INTO `municipio` VALUES (721, 'VISTAHERMOSA', '711', 16);
INSERT INTO `municipio` VALUES (722, 'PASTO (SAN JUAN DE PASTO)', '1', 17);
INSERT INTO `municipio` VALUES (723, 'ALBAN (SAN JOSE)', '19', 17);
INSERT INTO `municipio` VALUES (724, 'ALDANA', '22', 17);
INSERT INTO `municipio` VALUES (725, 'ANCUYA', '36', 17);
INSERT INTO `municipio` VALUES (726, 'ARBOLEDA (BERRUECOS)', '51', 17);
INSERT INTO `municipio` VALUES (727, 'BARBACOAS', '79', 17);
INSERT INTO `municipio` VALUES (728, 'BELEN', '83', 17);
INSERT INTO `municipio` VALUES (729, 'BUESACO', '110', 17);
INSERT INTO `municipio` VALUES (730, 'COLON (GENOVA)', '203', 17);
INSERT INTO `municipio` VALUES (731, 'CONSACA', '207', 17);
INSERT INTO `municipio` VALUES (732, 'CONTADERO', '210', 17);
INSERT INTO `municipio` VALUES (733, 'CORDOBA', '215', 17);
INSERT INTO `municipio` VALUES (734, 'CUASPUD (CARLOSAMA)', '224', 17);
INSERT INTO `municipio` VALUES (735, 'CUMBAL', '227', 17);
INSERT INTO `municipio` VALUES (736, 'CUMBITARA', '233', 17);
INSERT INTO `municipio` VALUES (737, 'CHACHAGUI', '240', 17);
INSERT INTO `municipio` VALUES (738, 'EL CHARCO', '250', 17);
INSERT INTO `municipio` VALUES (739, 'EL PEÑOL', '254', 17);
INSERT INTO `municipio` VALUES (740, 'EL ROSARIO', '256', 17);
INSERT INTO `municipio` VALUES (741, 'EL TABLON', '258', 17);
INSERT INTO `municipio` VALUES (742, 'EL TAMBO', '260', 17);
INSERT INTO `municipio` VALUES (743, 'FUNES', '287', 17);
INSERT INTO `municipio` VALUES (744, 'GUACHUCAL', '317', 17);
INSERT INTO `municipio` VALUES (745, 'GUAITARILLA', '320', 17);
INSERT INTO `municipio` VALUES (746, 'GUALMATAN', '323', 17);
INSERT INTO `municipio` VALUES (747, 'ILES', '352', 17);
INSERT INTO `municipio` VALUES (748, 'IMUES', '354', 17);
INSERT INTO `municipio` VALUES (749, 'IPIALES', '356', 17);
INSERT INTO `municipio` VALUES (750, 'LA CRUZ', '378', 17);
INSERT INTO `municipio` VALUES (751, 'LA FLORIDA', '381', 17);
INSERT INTO `municipio` VALUES (752, 'LA LLANADA', '385', 17);
INSERT INTO `municipio` VALUES (753, 'LA TOLA', '390', 17);
INSERT INTO `municipio` VALUES (754, 'LA UNION', '399', 17);
INSERT INTO `municipio` VALUES (755, 'LEIVA', '405', 17);
INSERT INTO `municipio` VALUES (756, 'LINARES', '411', 17);
INSERT INTO `municipio` VALUES (757, 'LOS ANDES (SOTOMAYOR)', '418', 17);
INSERT INTO `municipio` VALUES (758, 'MAGUI (PAYAN)', '427', 17);
INSERT INTO `municipio` VALUES (759, 'MALLAMA (PIEDRANCHA)', '435', 17);
INSERT INTO `municipio` VALUES (760, 'MOSQUERA', '473', 17);
INSERT INTO `municipio` VALUES (761, 'OLAYA HERRERA (BOCAS DE SATINGA)', '490', 17);
INSERT INTO `municipio` VALUES (762, 'OSPINA', '506', 17);
INSERT INTO `municipio` VALUES (763, 'FRANCISCO PIZARRO (SALAHONDA)', '520', 17);
INSERT INTO `municipio` VALUES (764, 'POLICARPA', '540', 17);
INSERT INTO `municipio` VALUES (765, 'POTOSI', '560', 17);
INSERT INTO `municipio` VALUES (766, 'PROVIDENCIA', '565', 17);
INSERT INTO `municipio` VALUES (767, 'PUERRES', '573', 17);
INSERT INTO `municipio` VALUES (768, 'PUPIALES', '585', 17);
INSERT INTO `municipio` VALUES (769, 'RICAURTE', '612', 17);
INSERT INTO `municipio` VALUES (770, 'ROBERTO PAYAN (SAN JOSE)', '621', 17);
INSERT INTO `municipio` VALUES (771, 'SAMANIEGO', '678', 17);
INSERT INTO `municipio` VALUES (772, 'SANDONA', '683', 17);
INSERT INTO `municipio` VALUES (773, 'SAN BERNARDO', '685', 17);
INSERT INTO `municipio` VALUES (774, 'SAN LORENZO', '687', 17);
INSERT INTO `municipio` VALUES (775, 'SAN PABLO', '693', 17);
INSERT INTO `municipio` VALUES (776, 'SAN PEDRO DE CARTAGO', '694', 17);
INSERT INTO `municipio` VALUES (777, 'SANTA BARBARA (ISCUANDE)', '696', 17);
INSERT INTO `municipio` VALUES (778, 'SANTA CRUZ (GUACHAVES)', '699', 17);
INSERT INTO `municipio` VALUES (779, 'SAPUYES', '720', 17);
INSERT INTO `municipio` VALUES (780, 'TAMINANGO', '786', 17);
INSERT INTO `municipio` VALUES (781, 'TANGUA', '788', 17);
INSERT INTO `municipio` VALUES (782, 'TUMACO', '835', 17);
INSERT INTO `municipio` VALUES (783, 'TUQUERRES', '838', 17);
INSERT INTO `municipio` VALUES (784, 'YACUANQUER', '885', 17);
INSERT INTO `municipio` VALUES (785, 'CUCUTA', '1', 18);
INSERT INTO `municipio` VALUES (786, 'ABREGO', '3', 18);
INSERT INTO `municipio` VALUES (787, 'ARBOLEDAS', '51', 18);
INSERT INTO `municipio` VALUES (788, 'BOCHALEMA', '99', 18);
INSERT INTO `municipio` VALUES (789, 'BUCARASICA', '109', 18);
INSERT INTO `municipio` VALUES (790, 'CACOTA', '125', 18);
INSERT INTO `municipio` VALUES (791, 'CACHIRA', '128', 18);
INSERT INTO `municipio` VALUES (792, 'CHINACOTA', '172', 18);
INSERT INTO `municipio` VALUES (793, 'CHITAGA', '174', 18);
INSERT INTO `municipio` VALUES (794, 'CONVENCION', '206', 18);
INSERT INTO `municipio` VALUES (795, 'CUCUTILLA', '223', 18);
INSERT INTO `municipio` VALUES (796, 'DURANIA', '239', 18);
INSERT INTO `municipio` VALUES (797, 'EL CARMEN', '245', 18);
INSERT INTO `municipio` VALUES (798, 'EL TARRA', '250', 18);
INSERT INTO `municipio` VALUES (799, 'EL ZULIA', '261', 18);
INSERT INTO `municipio` VALUES (800, 'GRAMALOTE', '313', 18);
INSERT INTO `municipio` VALUES (801, 'HACARI', '344', 18);
INSERT INTO `municipio` VALUES (802, 'HERRAN', '347', 18);
INSERT INTO `municipio` VALUES (803, 'LABATECA', '377', 18);
INSERT INTO `municipio` VALUES (804, 'LA ESPERANZA', '385', 18);
INSERT INTO `municipio` VALUES (805, 'LA PLAYA', '398', 18);
INSERT INTO `municipio` VALUES (806, 'LOS PATIOS', '405', 18);
INSERT INTO `municipio` VALUES (807, 'LOURDES', '418', 18);
INSERT INTO `municipio` VALUES (808, 'MUTISCUA', '480', 18);
INSERT INTO `municipio` VALUES (809, 'OCAÑA', '498', 18);
INSERT INTO `municipio` VALUES (810, 'PAMPLONA', '518', 18);
INSERT INTO `municipio` VALUES (811, 'PAMPLONITA', '520', 18);
INSERT INTO `municipio` VALUES (812, 'PUERTO SANTANDER', '553', 18);
INSERT INTO `municipio` VALUES (813, 'RAGONVALIA', '599', 18);
INSERT INTO `municipio` VALUES (814, 'SALAZAR', '660', 18);
INSERT INTO `municipio` VALUES (815, 'SAN CALIXTO', '670', 18);
INSERT INTO `municipio` VALUES (816, 'SAN CAYETANO', '673', 18);
INSERT INTO `municipio` VALUES (817, 'SANTIAGO', '680', 18);
INSERT INTO `municipio` VALUES (818, 'SARDINATA', '720', 18);
INSERT INTO `municipio` VALUES (819, 'SILOS', '743', 18);
INSERT INTO `municipio` VALUES (820, 'TEORAMA', '800', 18);
INSERT INTO `municipio` VALUES (821, 'TIBU', '810', 18);
INSERT INTO `municipio` VALUES (822, 'TOLEDO', '820', 18);
INSERT INTO `municipio` VALUES (823, 'VILLACARO', '871', 18);
INSERT INTO `municipio` VALUES (824, 'VILLA DEL ROSARIO', '874', 18);
INSERT INTO `municipio` VALUES (825, 'ARMENIA', '1', 19);
INSERT INTO `municipio` VALUES (826, 'BUENAVISTA', '111', 19);
INSERT INTO `municipio` VALUES (827, 'CALARCA', '130', 19);
INSERT INTO `municipio` VALUES (828, 'CIRCASIA', '190', 19);
INSERT INTO `municipio` VALUES (829, 'CORDOBA', '212', 19);
INSERT INTO `municipio` VALUES (830, 'FILANDIA', '272', 19);
INSERT INTO `municipio` VALUES (831, 'GENOVA', '302', 19);
INSERT INTO `municipio` VALUES (832, 'LA TEBAIDA', '401', 19);
INSERT INTO `municipio` VALUES (833, 'MONTENEGRO', '470', 19);
INSERT INTO `municipio` VALUES (834, 'PIJAO', '548', 19);
INSERT INTO `municipio` VALUES (835, 'QUIMBAYA', '594', 19);
INSERT INTO `municipio` VALUES (836, 'SALENTO', '690', 19);
INSERT INTO `municipio` VALUES (837, 'PEREIRA', '1', 20);
INSERT INTO `municipio` VALUES (838, 'APIA', '45', 20);
INSERT INTO `municipio` VALUES (839, 'BALBOA', '75', 20);
INSERT INTO `municipio` VALUES (840, 'BELEN DE UMBRIA', '88', 20);
INSERT INTO `municipio` VALUES (841, 'DOS QUEBRADAS', '170', 20);
INSERT INTO `municipio` VALUES (842, 'GUATICA', '318', 20);
INSERT INTO `municipio` VALUES (843, 'LA CELIA', '383', 20);
INSERT INTO `municipio` VALUES (844, 'LA VIRGINIA', '400', 20);
INSERT INTO `municipio` VALUES (845, 'MARSELLA', '440', 20);
INSERT INTO `municipio` VALUES (846, 'MISTRATO', '456', 20);
INSERT INTO `municipio` VALUES (847, 'PUEBLO RICO', '572', 20);
INSERT INTO `municipio` VALUES (848, 'QUINCHIA', '594', 20);
INSERT INTO `municipio` VALUES (849, 'SANTA ROSA DE CABAL', '682', 20);
INSERT INTO `municipio` VALUES (850, 'SANTUARIO', '687', 20);
INSERT INTO `municipio` VALUES (851, 'BUCARAMANGA', '1', 21);
INSERT INTO `municipio` VALUES (852, 'AGUADA', '13', 21);
INSERT INTO `municipio` VALUES (853, 'ALBANIA', '20', 21);
INSERT INTO `municipio` VALUES (854, 'ARATOCA', '51', 21);
INSERT INTO `municipio` VALUES (855, 'BARBOSA', '77', 21);
INSERT INTO `municipio` VALUES (856, 'BARICHARA', '79', 21);
INSERT INTO `municipio` VALUES (857, 'BARRANCABERMEJA', '81', 21);
INSERT INTO `municipio` VALUES (858, 'BETULIA', '92', 21);
INSERT INTO `municipio` VALUES (859, 'BOLIVAR', '101', 21);
INSERT INTO `municipio` VALUES (860, 'CABRERA', '121', 21);
INSERT INTO `municipio` VALUES (861, 'CALIFORNIA', '132', 21);
INSERT INTO `municipio` VALUES (862, 'CAPITANEJO', '147', 21);
INSERT INTO `municipio` VALUES (863, 'CARCASI', '152', 21);
INSERT INTO `municipio` VALUES (864, 'CEPITA', '160', 21);
INSERT INTO `municipio` VALUES (865, 'CERRITO', '162', 21);
INSERT INTO `municipio` VALUES (866, 'CHARALA', '167', 21);
INSERT INTO `municipio` VALUES (867, 'CHARTA', '169', 21);
INSERT INTO `municipio` VALUES (868, 'CHIMA', '176', 21);
INSERT INTO `municipio` VALUES (869, 'CHIPATA', '179', 21);
INSERT INTO `municipio` VALUES (870, 'CIMITARRA', '190', 21);
INSERT INTO `municipio` VALUES (871, 'CONCEPCION', '207', 21);
INSERT INTO `municipio` VALUES (872, 'CONFINES', '209', 21);
INSERT INTO `municipio` VALUES (873, 'CONTRATACION', '211', 21);
INSERT INTO `municipio` VALUES (874, 'COROMORO', '217', 21);
INSERT INTO `municipio` VALUES (875, 'CURITI', '229', 21);
INSERT INTO `municipio` VALUES (876, 'EL CARMEN DE CHUCURY', '235', 21);
INSERT INTO `municipio` VALUES (877, 'EL GUACAMAYO', '245', 21);
INSERT INTO `municipio` VALUES (878, 'EL PEÑON', '250', 21);
INSERT INTO `municipio` VALUES (879, 'EL PLAYON', '255', 21);
INSERT INTO `municipio` VALUES (880, 'ENCINO', '264', 21);
INSERT INTO `municipio` VALUES (881, 'ENCISO', '266', 21);
INSERT INTO `municipio` VALUES (882, 'FLORIAN', '271', 21);
INSERT INTO `municipio` VALUES (883, 'FLORIDABLANCA', '276', 21);
INSERT INTO `municipio` VALUES (884, 'GALAN', '296', 21);
INSERT INTO `municipio` VALUES (885, 'GAMBITA', '298', 21);
INSERT INTO `municipio` VALUES (886, 'GIRON', '307', 21);
INSERT INTO `municipio` VALUES (887, 'GUACA', '318', 21);
INSERT INTO `municipio` VALUES (888, 'GUADALUPE', '320', 21);
INSERT INTO `municipio` VALUES (889, 'GUAPOTA', '322', 21);
INSERT INTO `municipio` VALUES (890, 'GUAVATA', '324', 21);
INSERT INTO `municipio` VALUES (891, 'GUEPSA', '327', 21);
INSERT INTO `municipio` VALUES (892, 'HATO', '344', 21);
INSERT INTO `municipio` VALUES (893, 'JESUS MARIA', '368', 21);
INSERT INTO `municipio` VALUES (894, 'JORDAN', '370', 21);
INSERT INTO `municipio` VALUES (895, 'LA BELLEZA', '377', 21);
INSERT INTO `municipio` VALUES (896, 'LANDAZURI', '385', 21);
INSERT INTO `municipio` VALUES (897, 'LA PAZ', '397', 21);
INSERT INTO `municipio` VALUES (898, 'LEBRIJA', '406', 21);
INSERT INTO `municipio` VALUES (899, 'LOS SANTOS', '418', 21);
INSERT INTO `municipio` VALUES (900, 'MACARAVITA', '425', 21);
INSERT INTO `municipio` VALUES (901, 'MALAGA', '432', 21);
INSERT INTO `municipio` VALUES (902, 'MATANZA', '444', 21);
INSERT INTO `municipio` VALUES (903, 'MOGOTES', '464', 21);
INSERT INTO `municipio` VALUES (904, 'MOLAGAVITA', '468', 21);
INSERT INTO `municipio` VALUES (905, 'OCAMONTE', '498', 21);
INSERT INTO `municipio` VALUES (906, 'OIBA', '500', 21);
INSERT INTO `municipio` VALUES (907, 'ONZAGA', '502', 21);
INSERT INTO `municipio` VALUES (908, 'PALMAR', '522', 21);
INSERT INTO `municipio` VALUES (909, 'PALMAS DEL SOCORRO', '524', 21);
INSERT INTO `municipio` VALUES (910, 'PARAMO', '533', 21);
INSERT INTO `municipio` VALUES (911, 'PIEDECUESTA', '547', 21);
INSERT INTO `municipio` VALUES (912, 'PINCHOTE', '549', 21);
INSERT INTO `municipio` VALUES (913, 'PUENTE NACIONAL', '572', 21);
INSERT INTO `municipio` VALUES (914, 'PUERTO PARRA', '573', 21);
INSERT INTO `municipio` VALUES (915, 'PUERTO WILCHES', '575', 21);
INSERT INTO `municipio` VALUES (916, 'RIONEGRO', '615', 21);
INSERT INTO `municipio` VALUES (917, 'SABANA DE TORRES', '655', 21);
INSERT INTO `municipio` VALUES (918, 'SAN ANDRES', '669', 21);
INSERT INTO `municipio` VALUES (919, 'SAN BENITO', '673', 21);
INSERT INTO `municipio` VALUES (920, 'SAN GIL', '679', 21);
INSERT INTO `municipio` VALUES (921, 'SAN JOAQUIN', '682', 21);
INSERT INTO `municipio` VALUES (922, 'SAN JOSE DE MIRANDA', '684', 21);
INSERT INTO `municipio` VALUES (923, 'SAN MIGUEL', '686', 21);
INSERT INTO `municipio` VALUES (924, 'SAN VICENTE DE CHUCURI', '689', 21);
INSERT INTO `municipio` VALUES (925, 'SANTA BARBARA', '705', 21);
INSERT INTO `municipio` VALUES (926, 'SANTA HELENA DEL OPON', '720', 21);
INSERT INTO `municipio` VALUES (927, 'SIMACOTA', '745', 21);
INSERT INTO `municipio` VALUES (928, 'SOCORRO', '755', 21);
INSERT INTO `municipio` VALUES (929, 'SUAITA', '770', 21);
INSERT INTO `municipio` VALUES (930, 'SUCRE', '773', 21);
INSERT INTO `municipio` VALUES (931, 'SURATA', '780', 21);
INSERT INTO `municipio` VALUES (932, 'TONA', '820', 21);
INSERT INTO `municipio` VALUES (933, 'VALLE SAN JOSE', '855', 21);
INSERT INTO `municipio` VALUES (934, 'VELEZ', '861', 21);
INSERT INTO `municipio` VALUES (935, 'VETAS', '867', 21);
INSERT INTO `municipio` VALUES (936, 'VILLANUEVA', '872', 21);
INSERT INTO `municipio` VALUES (937, 'ZAPATOCA', '895', 21);
INSERT INTO `municipio` VALUES (938, 'SINCELEJO', '1', 22);
INSERT INTO `municipio` VALUES (939, 'BUENAVISTA', '110', 22);
INSERT INTO `municipio` VALUES (940, 'CAIMITO', '124', 22);
INSERT INTO `municipio` VALUES (941, 'COLOSO (RICAURTE)', '204', 22);
INSERT INTO `municipio` VALUES (942, 'COROZAL', '215', 22);
INSERT INTO `municipio` VALUES (943, 'CHALAN', '230', 22);
INSERT INTO `municipio` VALUES (944, 'GALERAS (NUEVA GRANADA)', '235', 22);
INSERT INTO `municipio` VALUES (945, 'GUARANDA', '265', 22);
INSERT INTO `municipio` VALUES (946, 'LA UNION', '400', 22);
INSERT INTO `municipio` VALUES (947, 'LOS PALMITOS', '418', 22);
INSERT INTO `municipio` VALUES (948, 'MAJAGUAL', '429', 22);
INSERT INTO `municipio` VALUES (949, 'MORROA', '473', 22);
INSERT INTO `municipio` VALUES (950, 'OVEJAS', '508', 22);
INSERT INTO `municipio` VALUES (951, 'PALMITO', '523', 22);
INSERT INTO `municipio` VALUES (952, 'SAMPUES', '670', 22);
INSERT INTO `municipio` VALUES (953, 'SAN BENITO ABAD', '678', 22);
INSERT INTO `municipio` VALUES (954, 'SAN JUAN DE BETULIA', '702', 22);
INSERT INTO `municipio` VALUES (955, 'SAN MARCOS', '708', 22);
INSERT INTO `municipio` VALUES (956, 'SAN ONOFRE', '713', 22);
INSERT INTO `municipio` VALUES (957, 'SAN PEDRO', '717', 22);
INSERT INTO `municipio` VALUES (958, 'SINCE', '742', 22);
INSERT INTO `municipio` VALUES (959, 'SUCRE', '771', 22);
INSERT INTO `municipio` VALUES (960, 'TOLU', '820', 22);
INSERT INTO `municipio` VALUES (961, 'TOLUVIEJO', '823', 22);
INSERT INTO `municipio` VALUES (962, 'IBAGUE', '1', 23);
INSERT INTO `municipio` VALUES (963, 'ALPUJARRA', '24', 23);
INSERT INTO `municipio` VALUES (964, 'ALVARADO', '26', 23);
INSERT INTO `municipio` VALUES (965, 'AMBALEMA', '30', 23);
INSERT INTO `municipio` VALUES (966, 'ANZOATEGUI', '43', 23);
INSERT INTO `municipio` VALUES (967, 'ARMERO (GUAYABAL)', '55', 23);
INSERT INTO `municipio` VALUES (968, 'ATACO', '67', 23);
INSERT INTO `municipio` VALUES (969, 'CAJAMARCA', '124', 23);
INSERT INTO `municipio` VALUES (970, 'CARMEN APICALA', '148', 23);
INSERT INTO `municipio` VALUES (971, 'CASABIANCA', '152', 23);
INSERT INTO `municipio` VALUES (972, 'CHAPARRAL', '168', 23);
INSERT INTO `municipio` VALUES (973, 'COELLO', '200', 23);
INSERT INTO `municipio` VALUES (974, 'COYAIMA', '217', 23);
INSERT INTO `municipio` VALUES (975, 'CUNDAY', '226', 23);
INSERT INTO `municipio` VALUES (976, 'DOLORES', '236', 23);
INSERT INTO `municipio` VALUES (977, 'ESPINAL', '268', 23);
INSERT INTO `municipio` VALUES (978, 'FALAN', '270', 23);
INSERT INTO `municipio` VALUES (979, 'FLANDES', '275', 23);
INSERT INTO `municipio` VALUES (980, 'FRESNO', '283', 23);
INSERT INTO `municipio` VALUES (981, 'GUAMO', '319', 23);
INSERT INTO `municipio` VALUES (982, 'HERVEO', '347', 23);
INSERT INTO `municipio` VALUES (983, 'HONDA', '349', 23);
INSERT INTO `municipio` VALUES (984, 'ICONONZO', '352', 23);
INSERT INTO `municipio` VALUES (985, 'LERIDA', '408', 23);
INSERT INTO `municipio` VALUES (986, 'LIBANO', '411', 23);
INSERT INTO `municipio` VALUES (987, 'MARIQUITA', '443', 23);
INSERT INTO `municipio` VALUES (988, 'MELGAR', '449', 23);
INSERT INTO `municipio` VALUES (989, 'MURILLO', '461', 23);
INSERT INTO `municipio` VALUES (990, 'NATAGAIMA', '483', 23);
INSERT INTO `municipio` VALUES (991, 'ORTEGA', '504', 23);
INSERT INTO `municipio` VALUES (992, 'PALOCABILDO', '520', 23);
INSERT INTO `municipio` VALUES (993, 'PIEDRAS', '547', 23);
INSERT INTO `municipio` VALUES (994, 'PLANADAS', '555', 23);
INSERT INTO `municipio` VALUES (995, 'PRADO', '563', 23);
INSERT INTO `municipio` VALUES (996, 'PURIFICACION', '585', 23);
INSERT INTO `municipio` VALUES (997, 'RIOBLANCO', '616', 23);
INSERT INTO `municipio` VALUES (998, 'RONCESVALLES', '622', 23);
INSERT INTO `municipio` VALUES (999, 'ROVIRA', '624', 23);
INSERT INTO `municipio` VALUES (1000, 'SALDAÑA', '671', 23);
INSERT INTO `municipio` VALUES (1001, 'SAN ANTONIO', '675', 23);
INSERT INTO `municipio` VALUES (1002, 'SAN LUIS', '678', 23);
INSERT INTO `municipio` VALUES (1003, 'SANTA ISABEL', '686', 23);
INSERT INTO `municipio` VALUES (1004, 'SUAREZ', '770', 23);
INSERT INTO `municipio` VALUES (1005, 'VALLE DE SAN JUAN', '854', 23);
INSERT INTO `municipio` VALUES (1006, 'VENADILLO', '861', 23);
INSERT INTO `municipio` VALUES (1007, 'VILLAHERMOSA', '870', 23);
INSERT INTO `municipio` VALUES (1008, 'VILLARRICA', '873', 23);
INSERT INTO `municipio` VALUES (1009, 'CALI (SANTIAGO DE CALI)', '1', 24);
INSERT INTO `municipio` VALUES (1010, 'ALCALA', '20', 24);
INSERT INTO `municipio` VALUES (1011, 'ANDALUCIA', '36', 24);
INSERT INTO `municipio` VALUES (1012, 'ANSERMANUEVO', '41', 24);
INSERT INTO `municipio` VALUES (1013, 'ARGELIA', '54', 24);
INSERT INTO `municipio` VALUES (1014, 'BOLIVAR', '100', 24);
INSERT INTO `municipio` VALUES (1015, 'BUENAVENTURA', '109', 24);
INSERT INTO `municipio` VALUES (1016, 'BUGA', '111', 24);
INSERT INTO `municipio` VALUES (1017, 'BUGALAGRANDE', '113', 24);
INSERT INTO `municipio` VALUES (1018, 'CAICEDONIA', '122', 24);
INSERT INTO `municipio` VALUES (1019, 'CALIMA (DARIEN)', '126', 24);
INSERT INTO `municipio` VALUES (1020, 'CANDELARIA', '130', 24);
INSERT INTO `municipio` VALUES (1021, 'CARTAGO', '147', 24);
INSERT INTO `municipio` VALUES (1022, 'DAGUA', '233', 24);
INSERT INTO `municipio` VALUES (1023, 'EL AGUILA', '243', 24);
INSERT INTO `municipio` VALUES (1024, 'EL CAIRO', '246', 24);
INSERT INTO `municipio` VALUES (1025, 'EL CERRITO', '248', 24);
INSERT INTO `municipio` VALUES (1026, 'EL DOVIO', '250', 24);
INSERT INTO `municipio` VALUES (1027, 'FLORIDA', '275', 24);
INSERT INTO `municipio` VALUES (1028, 'GINEBRA', '306', 24);
INSERT INTO `municipio` VALUES (1029, 'GUACARI', '318', 24);
INSERT INTO `municipio` VALUES (1030, 'JAMUNDI', '364', 24);
INSERT INTO `municipio` VALUES (1031, 'LA CUMBRE', '377', 24);
INSERT INTO `municipio` VALUES (1032, 'LA UNION', '400', 24);
INSERT INTO `municipio` VALUES (1033, 'LA VICTORIA', '403', 24);
INSERT INTO `municipio` VALUES (1034, 'OBANDO', '497', 24);
INSERT INTO `municipio` VALUES (1035, 'PALMIRA', '520', 24);
INSERT INTO `municipio` VALUES (1036, 'PRADERA', '563', 24);
INSERT INTO `municipio` VALUES (1037, 'RESTREPO', '606', 24);
INSERT INTO `municipio` VALUES (1038, 'RIOFRIO', '616', 24);
INSERT INTO `municipio` VALUES (1039, 'ROLDANILLO', '622', 24);
INSERT INTO `municipio` VALUES (1040, 'SAN PEDRO', '670', 24);
INSERT INTO `municipio` VALUES (1041, 'SEVILLA', '736', 24);
INSERT INTO `municipio` VALUES (1042, 'TORO', '823', 24);
INSERT INTO `municipio` VALUES (1043, 'TRUJILLO', '828', 24);
INSERT INTO `municipio` VALUES (1044, 'TULUA', '834', 24);
INSERT INTO `municipio` VALUES (1045, 'ULLOA', '845', 24);
INSERT INTO `municipio` VALUES (1046, 'VERSALLES', '863', 24);
INSERT INTO `municipio` VALUES (1047, 'VIJES', '869', 24);
INSERT INTO `municipio` VALUES (1048, 'YOTOCO', '890', 24);
INSERT INTO `municipio` VALUES (1049, 'YUMBO', '892', 24);
INSERT INTO `municipio` VALUES (1050, 'ZARZAL', '895', 24);
INSERT INTO `municipio` VALUES (1051, 'ARAUCA', '1', 25);
INSERT INTO `municipio` VALUES (1052, 'ARAUQUITA', '65', 25);
INSERT INTO `municipio` VALUES (1053, 'CRAVO NORTE', '220', 25);
INSERT INTO `municipio` VALUES (1054, 'FORTUL', '300', 25);
INSERT INTO `municipio` VALUES (1055, 'PUERTO RONDON', '591', 25);
INSERT INTO `municipio` VALUES (1056, 'SARAVENA', '736', 25);
INSERT INTO `municipio` VALUES (1057, 'TAME', '794', 25);
INSERT INTO `municipio` VALUES (1058, 'YOPAL', '1', 26);
INSERT INTO `municipio` VALUES (1059, 'AGUAZUL', '10', 26);
INSERT INTO `municipio` VALUES (1060, 'CHAMEZA', '15', 26);
INSERT INTO `municipio` VALUES (1061, 'HATO COROZAL', '125', 26);
INSERT INTO `municipio` VALUES (1062, 'LA SALINA', '136', 26);
INSERT INTO `municipio` VALUES (1063, 'MANI', '139', 26);
INSERT INTO `municipio` VALUES (1064, 'MONTERREY', '162', 26);
INSERT INTO `municipio` VALUES (1065, 'NUNCHIA', '225', 26);
INSERT INTO `municipio` VALUES (1066, 'OROCUE', '230', 26);
INSERT INTO `municipio` VALUES (1067, 'PAZ DE ARIPORO', '250', 26);
INSERT INTO `municipio` VALUES (1068, 'PORE', '263', 26);
INSERT INTO `municipio` VALUES (1069, 'RECETOR', '279', 26);
INSERT INTO `municipio` VALUES (1070, 'SABANALARGA', '300', 26);
INSERT INTO `municipio` VALUES (1071, 'SACAMA', '315', 26);
INSERT INTO `municipio` VALUES (1072, 'SAN LUIS DE PALENQUE', '325', 26);
INSERT INTO `municipio` VALUES (1073, 'TAMARA', '400', 26);
INSERT INTO `municipio` VALUES (1074, 'TAURAMENA', '410', 26);
INSERT INTO `municipio` VALUES (1075, 'TRINIDAD', '430', 26);
INSERT INTO `municipio` VALUES (1076, 'VILLANUEVA', '440', 26);
INSERT INTO `municipio` VALUES (1077, 'MOCOA', '1', 27);
INSERT INTO `municipio` VALUES (1078, 'COLON', '219', 27);
INSERT INTO `municipio` VALUES (1079, 'ORITO', '320', 27);
INSERT INTO `municipio` VALUES (1080, 'PUERTO ASIS', '568', 27);
INSERT INTO `municipio` VALUES (1081, 'PUERTO CAICEDO', '569', 27);
INSERT INTO `municipio` VALUES (1082, 'PUERTO GUZMAN', '571', 27);
INSERT INTO `municipio` VALUES (1083, 'PUERTO LEGUIZAMO', '573', 27);
INSERT INTO `municipio` VALUES (1084, 'SIBUNDOY', '749', 27);
INSERT INTO `municipio` VALUES (1085, 'SAN FRANCISCO', '755', 27);
INSERT INTO `municipio` VALUES (1086, 'SAN MIGUEL (LA DORADA)', '757', 27);
INSERT INTO `municipio` VALUES (1087, 'SANTIAGO', '760', 27);
INSERT INTO `municipio` VALUES (1088, 'LA HORMIGA (VALLE DEL GUAMUEZ)', '865', 27);
INSERT INTO `municipio` VALUES (1089, 'VILLAGARZON', '885', 27);
INSERT INTO `municipio` VALUES (1090, 'SAN ANDRES', '1', 28);
INSERT INTO `municipio` VALUES (1091, 'PROVIDENCIA', '564', 28);
INSERT INTO `municipio` VALUES (1092, 'LETICIA', '1', 29);
INSERT INTO `municipio` VALUES (1093, 'EL ENCANTO', '263', 29);
INSERT INTO `municipio` VALUES (1094, 'LA CHORRERA', '405', 29);
INSERT INTO `municipio` VALUES (1095, 'LA PEDRERA', '407', 29);
INSERT INTO `municipio` VALUES (1096, 'LA VICTORIA', '430', 29);
INSERT INTO `municipio` VALUES (1097, 'MIRITI-PARANA', '460', 29);
INSERT INTO `municipio` VALUES (1098, 'PUERTO ALEGRIA', '530', 29);
INSERT INTO `municipio` VALUES (1099, 'PUERTO ARICA', '536', 29);
INSERT INTO `municipio` VALUES (1100, 'PUERTO NARIÑO', '540', 29);
INSERT INTO `municipio` VALUES (1101, 'PUERTO SANTANDER', '669', 29);
INSERT INTO `municipio` VALUES (1102, 'TARAPACA', '798', 29);
INSERT INTO `municipio` VALUES (1103, 'PUERTO INIRIDA', '1', 30);
INSERT INTO `municipio` VALUES (1104, 'BARRANCO MINAS', '343', 30);
INSERT INTO `municipio` VALUES (1105, 'SAN FELIPE', '883', 30);
INSERT INTO `municipio` VALUES (1106, 'PUERTO COLOMBIA', '884', 30);
INSERT INTO `municipio` VALUES (1107, 'LA GUADALUPE', '885', 30);
INSERT INTO `municipio` VALUES (1108, 'CACAHUAL', '886', 30);
INSERT INTO `municipio` VALUES (1109, 'PANA PANA (CAMPO ALEGRE)', '887', 30);
INSERT INTO `municipio` VALUES (1110, 'MORICHAL (MORICHAL NUEVO)', '888', 30);
INSERT INTO `municipio` VALUES (1111, 'SAN JOSE DEL GUAVIARE', '1', 31);
INSERT INTO `municipio` VALUES (1112, 'CALAMAR', '15', 31);
INSERT INTO `municipio` VALUES (1113, 'EL RETORNO', '25', 31);
INSERT INTO `municipio` VALUES (1114, 'MIRAFLORES', '200', 31);
INSERT INTO `municipio` VALUES (1115, 'MITU', '1', 32);
INSERT INTO `municipio` VALUES (1116, 'CARURU', '161', 32);
INSERT INTO `municipio` VALUES (1117, 'PACOA', '511', 32);
INSERT INTO `municipio` VALUES (1118, 'TARAIRA', '666', 32);
INSERT INTO `municipio` VALUES (1119, 'PAPUNAUA (MORICHAL)', '777', 32);
INSERT INTO `municipio` VALUES (1120, 'YAVARATE', '889', 32);
INSERT INTO `municipio` VALUES (1121, 'PUERTO CARREÑO', '1', 33);
INSERT INTO `municipio` VALUES (1122, 'LA PRIMAVERA', '524', 33);
INSERT INTO `municipio` VALUES (1123, 'SANTA RITA', '572', 33);
INSERT INTO `municipio` VALUES (1124, 'SANTA ROSALIA', '666', 33);
INSERT INTO `municipio` VALUES (1125, 'SAN JOSE DE OCUNE', '760', 33);
INSERT INTO `municipio` VALUES (1126, 'CUMARIBO', '773', 33);

-- ----------------------------
-- Table structure for naturaleza_cuenta
-- ----------------------------
DROP TABLE IF EXISTS `naturaleza_cuenta`;
CREATE TABLE `naturaleza_cuenta`  (
  `Id_NatCue` int NOT NULL AUTO_INCREMENT,
  `Nombre_NatCue` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Id_NatCue`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of naturaleza_cuenta
-- ----------------------------
INSERT INTO `naturaleza_cuenta` VALUES (1, 'Débito');
INSERT INTO `naturaleza_cuenta` VALUES (2, 'Crédito');

-- ----------------------------
-- Table structure for numeracion_documentos
-- ----------------------------
DROP TABLE IF EXISTS `numeracion_documentos`;
CREATE TABLE `numeracion_documentos`  (
  `Id_NumDoc` int NOT NULL AUTO_INCREMENT,
  `Inicial_NumDoc` int NULL DEFAULT NULL,
  `Siguiente_NumDoc` int NULL DEFAULT NULL,
  `Id_DocTip` int NULL DEFAULT NULL,
  `Id_TranTip` int NULL DEFAULT NULL,
  `Primary_Usu` int NULL DEFAULT NULL,
  PRIMARY KEY (`Id_NumDoc`) USING BTREE,
  INDEX `fk_numeracion_documentos_documento_tipo1_idx`(`Id_DocTip`) USING BTREE,
  INDEX `fk_numeracion_documentos_transaccion_tipo1_idx`(`Id_TranTip`) USING BTREE,
  CONSTRAINT `fk_numeracion_documentos_documento_tipo1` FOREIGN KEY (`Id_DocTip`) REFERENCES `documento_tipo` (`Id_DocTip`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_numeracion_documentos_transaccion_tipo1` FOREIGN KEY (`Id_TranTip`) REFERENCES `transaccion_tipo` (`Id_TranTip`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 28 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of numeracion_documentos
-- ----------------------------
INSERT INTO `numeracion_documentos` VALUES (19, 1, 3, 9, 9, 1);
INSERT INTO `numeracion_documentos` VALUES (20, 1, 5, 8, 8, 1);
INSERT INTO `numeracion_documentos` VALUES (21, 1, 5, 7, 7, 1);
INSERT INTO `numeracion_documentos` VALUES (22, 1, 6, 6, 6, 1);
INSERT INTO `numeracion_documentos` VALUES (23, 1, 1, 5, 5, 1);
INSERT INTO `numeracion_documentos` VALUES (24, 1, 1, 4, 4, 1);
INSERT INTO `numeracion_documentos` VALUES (25, 1, 1, 3, 3, 1);
INSERT INTO `numeracion_documentos` VALUES (26, 1, 2, 2, 2, 1);
INSERT INTO `numeracion_documentos` VALUES (27, 1, 2, 1, 1, 1);

-- ----------------------------
-- Table structure for numeracion_facturas
-- ----------------------------
DROP TABLE IF EXISTS `numeracion_facturas`;
CREATE TABLE `numeracion_facturas`  (
  `Id_NumFac` int NOT NULL AUTO_INCREMENT,
  `Nombre_NumFac` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Prefijo_NumFac` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `Numero_NumFac` int NOT NULL,
  `Resolucion_NumFac` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `Activo_NumFac` enum('Activo','Inactivo') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'Activo',
  `Defecto_NumFac` enum('Activo','Inactivo') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `Primary_Usu` int NULL DEFAULT NULL,
  PRIMARY KEY (`Id_NumFac`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of numeracion_facturas
-- ----------------------------
INSERT INTO `numeracion_facturas` VALUES (2, 'Principal', 'FV', 10, 'Desde 10 hasta 1000', 'Activo', 'Activo', 1);

-- ----------------------------
-- Table structure for pagos
-- ----------------------------
DROP TABLE IF EXISTS `pagos`;
CREATE TABLE `pagos`  (
  `Id_Pag` int NOT NULL AUTO_INCREMENT,
  `Valor_Pag` double NULL DEFAULT NULL,
  `Fecha_Pag` datetime NULL DEFAULT NULL,
  `Id_MetPag` int NULL DEFAULT NULL,
  `Id_Tran` int NULL DEFAULT NULL,
  `Primary_Usu` int NULL DEFAULT NULL,
  PRIMARY KEY (`Id_Pag`) USING BTREE,
  INDEX `fk_pagos_metodo_pago1_idx`(`Id_MetPag`) USING BTREE,
  INDEX `fk_pagos_transacciones1_idx`(`Id_Tran`) USING BTREE,
  CONSTRAINT `fk_pagos_metodo_pago1` FOREIGN KEY (`Id_MetPag`) REFERENCES `metodo_pago` (`Id_MetPag`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_pagos_transacciones1` FOREIGN KEY (`Id_Tran`) REFERENCES `transacciones` (`Id_Tran`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of pagos
-- ----------------------------
INSERT INTO `pagos` VALUES (1, 2295299.95, '2020-05-08 16:05:27', 2, 6, 1);
INSERT INTO `pagos` VALUES (2, 2295299.95, '2020-05-08 16:05:18', 2, 7, 1);
INSERT INTO `pagos` VALUES (3, 1750000, '2020-05-09 17:05:06', 2, 8, 1);
INSERT INTO `pagos` VALUES (4, 225000, '2020-05-09 20:05:04', 2, 9, 1);
INSERT INTO `pagos` VALUES (5, 828000, '2020-05-15 18:05:52', 3, 10, 1);
INSERT INTO `pagos` VALUES (6, 113050, '2020-06-29 17:06:19', 2, 11, 1);
INSERT INTO `pagos` VALUES (7, 277200, '2020-07-02 22:07:45', 2, 12, 1);
INSERT INTO `pagos` VALUES (8, 1370260, '2020-07-02 22:07:55', 3, 13, 1);
INSERT INTO `pagos` VALUES (9, 9750, '2020-07-02 22:07:31', 3, 14, 1);
INSERT INTO `pagos` VALUES (10, 600000, '2020-07-02 22:07:31', 2, 14, 1);
INSERT INTO `pagos` VALUES (11, 815800, '2020-07-04 18:07:00', 2, 15, 1);
INSERT INTO `pagos` VALUES (12, 2692750, '2020-07-04 21:07:31', 2, 16, 1);
INSERT INTO `pagos` VALUES (13, 693000, '2020-07-05 21:07:31', 3, 17, 1);
INSERT INTO `pagos` VALUES (14, 111600, '2020-07-07 18:07:53', 4, 18, 1);
INSERT INTO `pagos` VALUES (15, 810000, '2020-07-11 15:07:13', 2, 19, 1);
INSERT INTO `pagos` VALUES (16, 70000000, '2020-08-02 17:08:56', 3, 20, 1);
INSERT INTO `pagos` VALUES (17, 25350000, '2020-08-02 17:08:56', 2, 20, 1);
INSERT INTO `pagos` VALUES (18, 17850, '2020-10-21 18:10:17', 2, 21, 1);
INSERT INTO `pagos` VALUES (19, 1316000, '2020-10-21 19:10:57', 2, 22, 1);
INSERT INTO `pagos` VALUES (20, 325068, '2021-05-15 09:05:34', 2, 23, 1);

-- ----------------------------
-- Table structure for permiso
-- ----------------------------
DROP TABLE IF EXISTS `permiso`;
CREATE TABLE `permiso`  (
  `Id_Perm` int NOT NULL AUTO_INCREMENT,
  `Descripcion_Perm` varchar(251) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Acceso_Perm` enum('SI','NO') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Controlador_Perm` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Id_Perm`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of permiso
-- ----------------------------
INSERT INTO `permiso` VALUES (1, 'Total', 'SI', 'Total');

-- ----------------------------
-- Table structure for persona
-- ----------------------------
DROP TABLE IF EXISTS `persona`;
CREATE TABLE `persona`  (
  `Id_Per` int NOT NULL AUTO_INCREMENT,
  `Identificacion_Per` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Nombre1_Per` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Nombre2_Per` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Apeliido1_Per` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Apellido2_Per` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Telefono_Per` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `TelCelular_Per` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Correo_Per` varchar(350) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Direccion_Per` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `FechaNacimiento_Per` date NULL DEFAULT NULL,
  `FechaRegistro_Per` datetime NULL DEFAULT NULL,
  `Celular_Per` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Id_PerTipId` int NULL DEFAULT NULL,
  `Id_PerGen` int NULL DEFAULT NULL,
  `Id_Mun` int NULL DEFAULT NULL,
  `Id_PerEst` int NULL DEFAULT NULL,
  `Id_PerTip` int NULL DEFAULT NULL,
  `Id_Emp` int NULL DEFAULT NULL,
  `Primary_Usu` int NULL DEFAULT NULL,
  PRIMARY KEY (`Id_Per`) USING BTREE,
  INDEX `fk_persona_persona_tipo_identificacion1_idx`(`Id_PerTipId`) USING BTREE,
  INDEX `fk_persona_persona_genero1_idx`(`Id_PerGen`) USING BTREE,
  INDEX `fk_persona_municipio1_idx`(`Id_Mun`) USING BTREE,
  INDEX `fk_persona_persona_estado1_idx`(`Id_PerEst`) USING BTREE,
  INDEX `fk_persona_persona_tipo1_idx`(`Id_PerTip`) USING BTREE,
  INDEX `fk_persona_empresa1_idx`(`Id_Emp`) USING BTREE,
  INDEX `fk_idx_Identificacion_Per`(`Identificacion_Per`) USING BTREE,
  INDEX `fk_idx_nombre_persona`(`Nombre1_Per`, `Nombre2_Per`, `Apeliido1_Per`, `Apellido2_Per`) USING BTREE,
  CONSTRAINT `fk_persona_empresa1` FOREIGN KEY (`Id_Emp`) REFERENCES `empresa` (`Id_Emp`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_persona_municipio1` FOREIGN KEY (`Id_Mun`) REFERENCES `municipio` (`Id_Mun`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_persona_persona_estado1` FOREIGN KEY (`Id_PerEst`) REFERENCES `persona_estado` (`Id_PerEst`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_persona_persona_genero1` FOREIGN KEY (`Id_PerGen`) REFERENCES `persona_genero` (`Id_PerGen`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_persona_persona_tipo1` FOREIGN KEY (`Id_PerTip`) REFERENCES `persona_tipo` (`Id_PerTip`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_persona_persona_tipo_identificacion1` FOREIGN KEY (`Id_PerTipId`) REFERENCES `persona_tipo_identificacion` (`Id_PerTipId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of persona
-- ----------------------------
INSERT INTO `persona` VALUES (1, '1061772286', 'Miguel', 'Andersson', 'Tunubalá', 'Morales', '3207296111', '8470660', 'madertu@hotmail.com', 'Cra 3 No 3a-89', '1994-07-19', NULL, NULL, 4, 1, 406, 1, 3, NULL, 1);
INSERT INTO `persona` VALUES (2, '25683936', 'Gladis', 'Amparo', 'Morales', 'Tombé', '3167645007', NULL, 'gamoralest@gmail.com', NULL, '2020-03-24', '2020-03-24 22:03:57', NULL, 4, 2, 413, 1, 1, NULL, 1);
INSERT INTO `persona` VALUES (5, '1061772286', 'Maria', 'Victoria', 'Niquinas', NULL, NULL, '3207296111', 'vikynr@gmail.com', NULL, NULL, '2020-03-26 16:03:58', NULL, 4, 2, 381, 1, 3, NULL, 7);
INSERT INTO `persona` VALUES (6, '1061469761', 'Angy', 'Carolina', 'Martinez', 'Vidal', '3127950861', '8470660', 'angycarolinamartinezv@gmail.com', 'Cra 27n-77, Los hoyos', '1994-06-14', '2020-03-27 03:03:29', NULL, 4, 2, 381, 1, 1, NULL, 7);
INSERT INTO `persona` VALUES (7, '1061769461', 'Angy', 'Carolina', 'Martinez', 'Vidal', '3127950861', NULL, NULL, 'Cra 3 No 3a-89', '2020-04-14', '2020-04-14 17:04:51', NULL, 4, NULL, NULL, 1, 3, NULL, 1);

-- ----------------------------
-- Table structure for persona_estado
-- ----------------------------
DROP TABLE IF EXISTS `persona_estado`;
CREATE TABLE `persona_estado`  (
  `Id_PerEst` int NOT NULL AUTO_INCREMENT,
  `Estado_PerEst` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Id_PerEst`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of persona_estado
-- ----------------------------
INSERT INTO `persona_estado` VALUES (1, 'Activo');
INSERT INTO `persona_estado` VALUES (2, 'Inactivo');

-- ----------------------------
-- Table structure for persona_genero
-- ----------------------------
DROP TABLE IF EXISTS `persona_genero`;
CREATE TABLE `persona_genero`  (
  `Id_PerGen` int NOT NULL AUTO_INCREMENT,
  `Descripcion_PerGen` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Codigo_PerGen` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Id_PerGen`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of persona_genero
-- ----------------------------
INSERT INTO `persona_genero` VALUES (1, 'Masculino', 'M');
INSERT INTO `persona_genero` VALUES (2, 'Femenino', 'F');

-- ----------------------------
-- Table structure for persona_tipo
-- ----------------------------
DROP TABLE IF EXISTS `persona_tipo`;
CREATE TABLE `persona_tipo`  (
  `Id_PerTip` int NOT NULL AUTO_INCREMENT,
  `Descripcion_PerTip` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Id_PerTip`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of persona_tipo
-- ----------------------------
INSERT INTO `persona_tipo` VALUES (1, 'Cliente');
INSERT INTO `persona_tipo` VALUES (2, 'Provedor');
INSERT INTO `persona_tipo` VALUES (3, 'Cliente / Provedor');

-- ----------------------------
-- Table structure for persona_tipo_identificacion
-- ----------------------------
DROP TABLE IF EXISTS `persona_tipo_identificacion`;
CREATE TABLE `persona_tipo_identificacion`  (
  `Id_PerTipId` int NOT NULL AUTO_INCREMENT,
  `Descripcion_PerTipId` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Codigo_PerTipId` char(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Id_PerTipId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of persona_tipo_identificacion
-- ----------------------------
INSERT INTO `persona_tipo_identificacion` VALUES (1, 'Certificado de nacido vivo', 'CN');
INSERT INTO `persona_tipo_identificacion` VALUES (2, 'Registro civil de nacimiento', 'RC');
INSERT INTO `persona_tipo_identificacion` VALUES (3, 'Tarjeta de Identidad', 'TI');
INSERT INTO `persona_tipo_identificacion` VALUES (4, 'Cédula de Cuidadanía', 'CC');
INSERT INTO `persona_tipo_identificacion` VALUES (5, 'Cédula de Extrangería', 'CE');
INSERT INTO `persona_tipo_identificacion` VALUES (6, 'Pasaporte', 'PA');
INSERT INTO `persona_tipo_identificacion` VALUES (7, 'Carnet diplomático', 'CD');
INSERT INTO `persona_tipo_identificacion` VALUES (8, 'Salvoconducto de permanencia', 'SC');

-- ----------------------------
-- Table structure for precios_item
-- ----------------------------
DROP TABLE IF EXISTS `precios_item`;
CREATE TABLE `precios_item`  (
  `Id_ListPre` int NOT NULL,
  `Id_Ite` int NOT NULL,
  `PrecioVenta` double NULL DEFAULT NULL,
  `Primary_Usu` int NULL DEFAULT NULL,
  PRIMARY KEY (`Id_ListPre`, `Id_Ite`) USING BTREE,
  INDEX `fk_lista_precios_has_items_items1_idx`(`Id_Ite`) USING BTREE,
  INDEX `fk_lista_precios_has_items_lista_precios1_idx`(`Id_ListPre`) USING BTREE,
  CONSTRAINT `fk_lista_precios_has_items_items1` FOREIGN KEY (`Id_Ite`) REFERENCES `items` (`Id_Ite`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lista_precios_has_items_lista_precios1` FOREIGN KEY (`Id_ListPre`) REFERENCES `lista_precios` (`Id_ListPre`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of precios_item
-- ----------------------------
INSERT INTO `precios_item` VALUES (1, 5, 5000000, 7);
INSERT INTO `precios_item` VALUES (1, 7, 1200000, 7);
INSERT INTO `precios_item` VALUES (1, 9, 25000000, 7);
INSERT INTO `precios_item` VALUES (2, 5, 450000, 7);
INSERT INTO `precios_item` VALUES (2, 9, 2000000, 7);
INSERT INTO `precios_item` VALUES (3, 1, 132000, 1);
INSERT INTO `precios_item` VALUES (3, 4, 45000, 1);
INSERT INTO `precios_item` VALUES (3, 10, 1500, 1);
INSERT INTO `precios_item` VALUES (4, 2, 100000, 1);
INSERT INTO `precios_item` VALUES (4, 3, 50000, 1);
INSERT INTO `precios_item` VALUES (4, 4, 50000, 1);
INSERT INTO `precios_item` VALUES (4, 6, 25000, 1);
INSERT INTO `precios_item` VALUES (4, 10, 1400, 1);
INSERT INTO `precios_item` VALUES (5, 4, 4700, 1);
INSERT INTO `precios_item` VALUES (5, 10, 1350, 1);

-- ----------------------------
-- Table structure for retencion_detalle_estado
-- ----------------------------
DROP TABLE IF EXISTS `retencion_detalle_estado`;
CREATE TABLE `retencion_detalle_estado`  (
  `Id_RetDetEst` int NOT NULL AUTO_INCREMENT,
  `Nombre_RetDetEst` varchar(75) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`Id_RetDetEst`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of retencion_detalle_estado
-- ----------------------------

-- ----------------------------
-- Table structure for retencion_tipo
-- ----------------------------
DROP TABLE IF EXISTS `retencion_tipo`;
CREATE TABLE `retencion_tipo`  (
  `Id_RetTip` int NOT NULL AUTO_INCREMENT,
  `Nombre_RetTip` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`Id_RetTip`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of retencion_tipo
-- ----------------------------

-- ----------------------------
-- Table structure for retenciones
-- ----------------------------
DROP TABLE IF EXISTS `retenciones`;
CREATE TABLE `retenciones`  (
  `Id_Ret` int NOT NULL AUTO_INCREMENT,
  `Nombre_Ret` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Porcentaje_Ret` double NULL DEFAULT NULL,
  `Descripcion_Ret` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `FechaRegistro_Ret` timestamp NULL DEFAULT current_timestamp,
  `Estado_Ret` enum('Activo','Inactivo') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Activo',
  `Id_RetTip` int NULL DEFAULT NULL COMMENT 'Tipo retencion',
  `Id_Cue_Ventas` int NULL DEFAULT NULL COMMENT 'Cuenta para retenciones a favor',
  `Id_Cue_Compras` int NULL DEFAULT NULL COMMENT 'Cuentas para retencciones por pagar',
  `Primary_Usu` int NULL DEFAULT NULL,
  PRIMARY KEY (`Id_Ret`) USING BTREE,
  INDEX `fk_retenciones_retencion_tipo1_idx`(`Id_RetTip`) USING BTREE,
  INDEX `fk_retenciones_cuentas1_idx`(`Id_Cue_Ventas`) USING BTREE,
  INDEX `fk_retenciones_cuentas2_idx`(`Id_Cue_Compras`) USING BTREE,
  CONSTRAINT `fk_retenciones_cuentas1` FOREIGN KEY (`Id_Cue_Ventas`) REFERENCES `cuentas` (`Id_Cue`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_retenciones_cuentas2` FOREIGN KEY (`Id_Cue_Compras`) REFERENCES `cuentas` (`Id_Cue`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_retenciones_retencion_tipo1` FOREIGN KEY (`Id_RetTip`) REFERENCES `retencion_tipo` (`Id_RetTip`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of retenciones
-- ----------------------------

-- ----------------------------
-- Table structure for retenciones_detalle
-- ----------------------------
DROP TABLE IF EXISTS `retenciones_detalle`;
CREATE TABLE `retenciones_detalle`  (
  `Id_RetDet` int NOT NULL AUTO_INCREMENT,
  `Id_Ret` int NULL DEFAULT NULL,
  `Id_TranDet` int NULL DEFAULT NULL,
  `Base_RetDet` double NULL DEFAULT NULL,
  `ValorRetenido_RetDet` double NULL DEFAULT NULL,
  `Id_RetDetEst` int NULL DEFAULT NULL,
  `Id_Doc` int NULL DEFAULT NULL COMMENT 'Unicamente para retenciones de documentos de egreso',
  `FactorMovimiento` int NULL DEFAULT NULL,
  `Primary_Usu` int NULL DEFAULT NULL,
  PRIMARY KEY (`Id_RetDet`) USING BTREE,
  INDEX `fk_retenciones_has_transaccion_detalle_transaccion_detalle1_idx`(`Id_TranDet`) USING BTREE,
  INDEX `fk_retenciones_has_transaccion_detalle_retenciones1_idx`(`Id_Ret`) USING BTREE,
  INDEX `fk_retenciones_detalle_retencion_detalle_estado1_idx`(`Id_RetDetEst`) USING BTREE,
  INDEX `fk_retenciones_detalle_documento1_idx`(`Id_Doc`) USING BTREE,
  CONSTRAINT `fk_retenciones_detalle_documento1` FOREIGN KEY (`Id_Doc`) REFERENCES `documento` (`Id_Doc`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_retenciones_detalle_retencion_detalle_estado1` FOREIGN KEY (`Id_RetDetEst`) REFERENCES `retencion_detalle_estado` (`Id_RetDetEst`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_retenciones_has_transaccion_detalle_retenciones1` FOREIGN KEY (`Id_Ret`) REFERENCES `retenciones` (`Id_Ret`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_retenciones_has_transaccion_detalle_transaccion_detalle1` FOREIGN KEY (`Id_TranDet`) REFERENCES `transaccion_detalle` (`Id_TranDet`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of retenciones_detalle
-- ----------------------------

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `Id_Rol` int NOT NULL AUTO_INCREMENT,
  `Descripcion_Rol` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Primary_Usu` int NULL DEFAULT NULL,
  PRIMARY KEY (`Id_Rol`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'administrador', NULL);

-- ----------------------------
-- Table structure for roles_permiso
-- ----------------------------
DROP TABLE IF EXISTS `roles_permiso`;
CREATE TABLE `roles_permiso`  (
  `Id_RolPerm` int NOT NULL AUTO_INCREMENT,
  `Id_Rol` int NOT NULL,
  `Id_Perm` int NOT NULL,
  `Editar` char(2) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Crear` char(2) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Ver` char(2) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Listar` char(2) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Primary_Usu` int NULL DEFAULT NULL,
  PRIMARY KEY (`Id_RolPerm`, `Id_Rol`, `Id_Perm`) USING BTREE,
  INDEX `fk_roles_has_permiso_permiso1_idx`(`Id_Perm`) USING BTREE,
  INDEX `fk_roles_has_permiso_roles1_idx`(`Id_Rol`) USING BTREE,
  CONSTRAINT `fk_roles_has_permiso_permiso1` FOREIGN KEY (`Id_Perm`) REFERENCES `permiso` (`Id_Perm`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_roles_has_permiso_roles1` FOREIGN KEY (`Id_Rol`) REFERENCES `roles` (`Id_Rol`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 51 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of roles_permiso
-- ----------------------------

-- ----------------------------
-- Table structure for termino_pago
-- ----------------------------
DROP TABLE IF EXISTS `termino_pago`;
CREATE TABLE `termino_pago`  (
  `Id_TerPag` int NOT NULL AUTO_INCREMENT COMMENT 'Registro para los datos de terminos de pago',
  `Nombre_TerPag` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `Dias_TerPag` int NULL DEFAULT NULL,
  `Estado_TerPag` enum('Activo','Inactivo') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Activo',
  `FechaRegistro_TerPag` datetime NULL DEFAULT current_timestamp,
  `Primary_Usu` int NULL DEFAULT NULL,
  PRIMARY KEY (`Id_TerPag`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of termino_pago
-- ----------------------------
INSERT INTO `termino_pago` VALUES (1, 'Contado', 0, 'Activo', '2020-03-24 19:00:53', 7);
INSERT INTO `termino_pago` VALUES (2, 'Contado', 0, 'Activo', '2020-03-31 20:57:35', 1);
INSERT INTO `termino_pago` VALUES (3, '15 días', 15, 'Activo', '2020-04-01 21:04:50', 7);
INSERT INTO `termino_pago` VALUES (4, '15 días', 15, 'Activo', '2020-04-11 20:04:49', 1);
INSERT INTO `termino_pago` VALUES (5, '1 mes', 30, 'Activo', '2020-04-11 20:04:22', 1);

-- ----------------------------
-- Table structure for tipo_cuenta_banco
-- ----------------------------
DROP TABLE IF EXISTS `tipo_cuenta_banco`;
CREATE TABLE `tipo_cuenta_banco`  (
  `Id_TipCueBan` int NOT NULL AUTO_INCREMENT,
  `Nombre_TipCueBan` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`Id_TipCueBan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tipo_cuenta_banco
-- ----------------------------
INSERT INTO `tipo_cuenta_banco` VALUES (1, 'Crédito');
INSERT INTO `tipo_cuenta_banco` VALUES (2, 'Débito');

-- ----------------------------
-- Table structure for transaccion_detalle
-- ----------------------------
DROP TABLE IF EXISTS `transaccion_detalle`;
CREATE TABLE `transaccion_detalle`  (
  `Id_TranDet` int NOT NULL AUTO_INCREMENT,
  `Valor_TranDet` double NULL DEFAULT NULL,
  `Cantidad_TranDet` int NULL DEFAULT NULL,
  `Observaciones_TranDet` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `Id_Tran` int NULL DEFAULT NULL COMMENT 'Maestro transaccion',
  `Id_Cue` int NULL DEFAULT NULL COMMENT 'Cuenta de la transaccion',
  `Id_Doc` int NULL DEFAULT NULL COMMENT 'Documento si esta activo',
  `Id_Imp` int NULL DEFAULT NULL,
  `Id_TranDetTip` int NULL DEFAULT NULL,
  `Id_TranDetEst` int NULL DEFAULT NULL COMMENT 'Estado',
  `FactorMoviemiento` tinyint NULL DEFAULT NULL,
  `Primary_Usu` int NULL DEFAULT NULL,
  PRIMARY KEY (`Id_TranDet`) USING BTREE,
  INDEX `fk_transaccion_detalle_transacciones1_idx`(`Id_Tran`) USING BTREE,
  INDEX `fk_transaccion_detalle_documento1_idx`(`Id_Doc`) USING BTREE,
  INDEX `fk_transaccion_detalle_transaccion_detalle_estado1_idx`(`Id_TranDetEst`) USING BTREE,
  INDEX `fk_transaccion_detalle_transaccion_detalle_tipo1_idx`(`Id_TranDetTip`) USING BTREE,
  INDEX `fk_transaccion_detalle_cuentas1_idx`(`Id_Cue`) USING BTREE,
  INDEX `fk_transaccion_detalle_impuestos1_idx`(`Id_Imp`) USING BTREE,
  CONSTRAINT `fk_transaccion_detalle_cuentas1` FOREIGN KEY (`Id_Cue`) REFERENCES `cuentas` (`Id_Cue`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_transaccion_detalle_documento1` FOREIGN KEY (`Id_Doc`) REFERENCES `documento` (`Id_Doc`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_transaccion_detalle_impuestos1` FOREIGN KEY (`Id_Imp`) REFERENCES `impuestos` (`Id_Imp`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_transaccion_detalle_transaccion_detalle_estado1` FOREIGN KEY (`Id_TranDetEst`) REFERENCES `transaccion_detalle_estado` (`Id_TranDetEst`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_transaccion_detalle_transaccion_detalle_tipo1` FOREIGN KEY (`Id_TranDetTip`) REFERENCES `transaccion_detalle_tipo` (`Id_TranDetTip`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_transaccion_detalle_transacciones1` FOREIGN KEY (`Id_Tran`) REFERENCES `transacciones` (`Id_Tran`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 28 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of transaccion_detalle
-- ----------------------------
INSERT INTO `transaccion_detalle` VALUES (6, 2295299.95, 1, NULL, 6, NULL, 22, NULL, 1, 1, 1, 1);
INSERT INTO `transaccion_detalle` VALUES (7, 2295299.95, 1, NULL, 7, NULL, 22, NULL, 1, 1, 1, 1);
INSERT INTO `transaccion_detalle` VALUES (8, 1750000, 1, 'pago factura', 8, NULL, 15, NULL, 1, 1, 1, 1);
INSERT INTO `transaccion_detalle` VALUES (9, 225000, 1, NULL, 9, NULL, 13, NULL, 2, 1, -1, 1);
INSERT INTO `transaccion_detalle` VALUES (10, 828000, 1, NULL, 10, 304, NULL, NULL, 2, 1, -1, 1);
INSERT INTO `transaccion_detalle` VALUES (11, 113050, 1, 'Pago de factura', 11, NULL, 29, NULL, 1, 1, 1, 1);
INSERT INTO `transaccion_detalle` VALUES (12, 277200, 1, NULL, 12, NULL, 26, NULL, 1, 1, 1, 1);
INSERT INTO `transaccion_detalle` VALUES (13, 1370260, 1, NULL, 13, NULL, 24, NULL, 1, 1, 1, 1);
INSERT INTO `transaccion_detalle` VALUES (14, 609750, 1, NULL, 14, NULL, 6, NULL, 2, 1, -1, 1);
INSERT INTO `transaccion_detalle` VALUES (15, 815800, 1, 'Pago cotización', 15, NULL, 40, NULL, 6, 1, -1, 1);
INSERT INTO `transaccion_detalle` VALUES (16, 2692750, 1, NULL, 16, NULL, 39, NULL, 6, 1, -1, 1);
INSERT INTO `transaccion_detalle` VALUES (17, 693000, 1, NULL, 17, NULL, 43, NULL, 7, 1, -1, 1);
INSERT INTO `transaccion_detalle` VALUES (18, 111600, 1, NULL, 18, NULL, 35, NULL, 2, 1, 0, 1);
INSERT INTO `transaccion_detalle` VALUES (19, 810000, 1, NULL, 19, NULL, 42, NULL, 1, 1, 0, 1);
INSERT INTO `transaccion_detalle` VALUES (20, 100000, 1, NULL, 20, 4, NULL, NULL, 1, 1, 1, 1);
INSERT INTO `transaccion_detalle` VALUES (21, 250000, 1, NULL, 20, 17, NULL, NULL, 1, 1, 1, 1);
INSERT INTO `transaccion_detalle` VALUES (22, 50000000, 1, NULL, 20, 50, NULL, NULL, 1, 1, 1, 1);
INSERT INTO `transaccion_detalle` VALUES (23, 45000000, 1, NULL, 20, 223, NULL, NULL, 1, 1, 1, 1);
INSERT INTO `transaccion_detalle` VALUES (24, 17850, 1, NULL, 21, NULL, 44, NULL, 2, 1, -1, 1);
INSERT INTO `transaccion_detalle` VALUES (25, 120000, 1, NULL, 22, 4, NULL, 5, 1, 1, 1, 1);
INSERT INTO `transaccion_detalle` VALUES (26, 1000000, 1, NULL, 22, 24, NULL, 6, 1, 1, 1, 1);
INSERT INTO `transaccion_detalle` VALUES (27, 325068, 1, NULL, 23, NULL, 27, NULL, 1, 1, 1, 1);

-- ----------------------------
-- Table structure for transaccion_detalle_estado
-- ----------------------------
DROP TABLE IF EXISTS `transaccion_detalle_estado`;
CREATE TABLE `transaccion_detalle_estado`  (
  `Id_TranDetEst` int NOT NULL AUTO_INCREMENT,
  `Nombre_TranDetEst` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`Id_TranDetEst`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of transaccion_detalle_estado
-- ----------------------------
INSERT INTO `transaccion_detalle_estado` VALUES (1, 'Activo');
INSERT INTO `transaccion_detalle_estado` VALUES (2, 'Inactivo');

-- ----------------------------
-- Table structure for transaccion_detalle_tipo
-- ----------------------------
DROP TABLE IF EXISTS `transaccion_detalle_tipo`;
CREATE TABLE `transaccion_detalle_tipo`  (
  `Id_TranDetTip` int NOT NULL AUTO_INCREMENT,
  `Nombre_TranDetTip` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`Id_TranDetTip`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of transaccion_detalle_tipo
-- ----------------------------
INSERT INTO `transaccion_detalle_tipo` VALUES (1, 'Factura de venta');
INSERT INTO `transaccion_detalle_tipo` VALUES (2, 'Factura de compra');
INSERT INTO `transaccion_detalle_tipo` VALUES (3, 'Nota débito');
INSERT INTO `transaccion_detalle_tipo` VALUES (4, 'Nota crédito');
INSERT INTO `transaccion_detalle_tipo` VALUES (5, 'Remisión');
INSERT INTO `transaccion_detalle_tipo` VALUES (6, 'Cotización');
INSERT INTO `transaccion_detalle_tipo` VALUES (7, 'Órden de compra');
INSERT INTO `transaccion_detalle_tipo` VALUES (8, 'Comprobante de ingreso');
INSERT INTO `transaccion_detalle_tipo` VALUES (9, 'Comprobante de egreso');

-- ----------------------------
-- Table structure for transaccion_estado
-- ----------------------------
DROP TABLE IF EXISTS `transaccion_estado`;
CREATE TABLE `transaccion_estado`  (
  `Id_TranEst` int NOT NULL AUTO_INCREMENT,
  `Nombre_TranEst` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`Id_TranEst`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of transaccion_estado
-- ----------------------------
INSERT INTO `transaccion_estado` VALUES (1, 'Activo');
INSERT INTO `transaccion_estado` VALUES (2, 'Inactivo');
INSERT INTO `transaccion_estado` VALUES (3, 'Anulado');
INSERT INTO `transaccion_estado` VALUES (4, 'Cancelado');
INSERT INTO `transaccion_estado` VALUES (5, 'Pagado');

-- ----------------------------
-- Table structure for transaccion_tipo
-- ----------------------------
DROP TABLE IF EXISTS `transaccion_tipo`;
CREATE TABLE `transaccion_tipo`  (
  `Id_TranTip` int NOT NULL AUTO_INCREMENT,
  `Nombre_TranTip` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`Id_TranTip`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of transaccion_tipo
-- ----------------------------
INSERT INTO `transaccion_tipo` VALUES (1, 'Ingreso');
INSERT INTO `transaccion_tipo` VALUES (2, 'Egreso');
INSERT INTO `transaccion_tipo` VALUES (3, 'Nota débito');
INSERT INTO `transaccion_tipo` VALUES (4, 'Nota crédito');
INSERT INTO `transaccion_tipo` VALUES (5, 'Remisión');
INSERT INTO `transaccion_tipo` VALUES (6, 'Cotización');
INSERT INTO `transaccion_tipo` VALUES (7, 'Órden de compra');
INSERT INTO `transaccion_tipo` VALUES (8, 'Comprobante de ingreso');
INSERT INTO `transaccion_tipo` VALUES (9, 'Comprobante de egreso');

-- ----------------------------
-- Table structure for transacciones
-- ----------------------------
DROP TABLE IF EXISTS `transacciones`;
CREATE TABLE `transacciones`  (
  `Id_Tran` int NOT NULL AUTO_INCREMENT,
  `Numero_Tran` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT 'Consecutivo autoincremental de transaccion',
  `Fecha_Tran` datetime NULL DEFAULT NULL,
  `NotaVisible_Tran` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `DocumentoAsociado_Tran` tinyint NULL DEFAULT NULL COMMENT 'Valor si esta asociados a documentos',
  `FechaRegistro_Tran` datetime NULL DEFAULT current_timestamp,
  `Id_TranTip` int NULL DEFAULT NULL COMMENT 'Tipo de transaccion',
  `Id_TranEst` int NULL DEFAULT NULL COMMENT 'Estado de la transaccion',
  `Id_Ban` int NULL DEFAULT NULL COMMENT 'Banco de transaccion',
  `Id_Usu` int NULL DEFAULT NULL COMMENT 'Usuario que registra la transaccion',
  `Id_Per` int NULL DEFAULT NULL COMMENT 'A quien se le dirije la transaccion',
  `Id_Tran_TransaccionParcial` int NULL DEFAULT NULL COMMENT 'Para transacciones parciales sumar todas las transacciones asociadas a la transaccion padre',
  `Primary_Usu` int NULL DEFAULT NULL,
  PRIMARY KEY (`Id_Tran`) USING BTREE,
  INDEX `fk_transacciones_transaccion_tipo1_idx`(`Id_TranTip`) USING BTREE,
  INDEX `fk_transacciones_transaccion_estado1_idx`(`Id_TranEst`) USING BTREE,
  INDEX `fk_transacciones_bancos1_idx`(`Id_Ban`) USING BTREE,
  INDEX `fk_transacciones_usuario1_idx`(`Id_Usu`) USING BTREE,
  INDEX `fk_transacciones_persona1_idx`(`Id_Per`) USING BTREE,
  INDEX `fk_transacciones_transacciones1_idx`(`Id_Tran_TransaccionParcial`) USING BTREE,
  CONSTRAINT `fk_transacciones_bancos1` FOREIGN KEY (`Id_Ban`) REFERENCES `bancos` (`Id_Ban`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_transacciones_persona1` FOREIGN KEY (`Id_Per`) REFERENCES `persona` (`Id_Per`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_transacciones_transaccion_estado1` FOREIGN KEY (`Id_TranEst`) REFERENCES `transaccion_estado` (`Id_TranEst`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_transacciones_transaccion_tipo1` FOREIGN KEY (`Id_TranTip`) REFERENCES `transaccion_tipo` (`Id_TranTip`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_transacciones_transacciones1` FOREIGN KEY (`Id_Tran_TransaccionParcial`) REFERENCES `transacciones` (`Id_Tran`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_transacciones_usuario1` FOREIGN KEY (`Id_Usu`) REFERENCES `usuario` (`Id_Usu`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of transacciones
-- ----------------------------
INSERT INTO `transacciones` VALUES (1, 'TR-01', '2020-05-08 00:00:00', 'Pago factura de ingreso', 1, '2020-05-08 15:05:16', 1, 5, 1, 1, 1, NULL, 1);
INSERT INTO `transacciones` VALUES (2, 'TR-01', '2020-05-08 00:00:00', 'Pago factura de ingreso', 1, '2020-05-08 16:05:26', 1, 5, 1, 1, 1, NULL, 1);
INSERT INTO `transacciones` VALUES (6, 'PAG-01', '2020-05-08 00:00:00', NULL, 1, '2020-05-08 16:05:27', 1, 5, 1, 1, 1, NULL, 1);
INSERT INTO `transacciones` VALUES (7, 'PAG-01', '2020-05-08 00:00:00', NULL, 1, '2020-05-08 16:05:18', 1, 5, 1, 1, 1, NULL, 1);
INSERT INTO `transacciones` VALUES (8, 'PAG-02', '2020-05-09 00:00:00', 'Pago de factura FV-1', 1, '2020-05-09 17:05:06', 1, 5, 1, 1, 1, NULL, 1);
INSERT INTO `transacciones` VALUES (9, 'PS-1', '2020-05-09 00:00:00', NULL, 1, '2020-05-09 20:05:04', 2, 5, 1, 1, 2, NULL, 1);
INSERT INTO `transacciones` VALUES (10, 'PAG-03', '2020-05-15 00:00:00', NULL, NULL, '2020-05-15 18:05:52', 2, 5, 1, 1, 2, NULL, 1);
INSERT INTO `transacciones` VALUES (11, 'ASOS-01', '2020-06-29 00:00:00', NULL, 1, '2020-06-29 17:06:19', 1, 5, 1, 1, 1, NULL, 1);
INSERT INTO `transacciones` VALUES (12, 'Automático', '2020-07-02 00:00:00', NULL, 1, '2020-07-02 22:07:45', 1, 5, 1, 1, 7, NULL, 1);
INSERT INTO `transacciones` VALUES (13, '1', '2020-07-02 00:00:00', NULL, 1, '2020-07-02 22:07:55', 1, 5, 1, 1, 7, NULL, 1);
INSERT INTO `transacciones` VALUES (14, '1', '2020-07-02 00:00:00', NULL, 1, '2020-07-02 22:07:31', 2, 5, 1, 1, 1, NULL, 1);
INSERT INTO `transacciones` VALUES (15, '4', '2020-07-04 00:00:00', NULL, 1, '2020-07-04 18:07:01', 6, 5, 1, 1, 7, NULL, 1);
INSERT INTO `transacciones` VALUES (16, '5', '2020-07-04 00:00:00', NULL, 1, '2020-07-04 21:07:31', 6, 5, 2, 1, 7, NULL, 1);
INSERT INTO `transacciones` VALUES (17, '4', '2020-07-05 00:00:00', NULL, 1, '2020-07-05 21:07:31', 7, 5, 1, 1, 1, NULL, 1);
INSERT INTO `transacciones` VALUES (18, '1', '2020-07-07 00:00:00', NULL, 1, '2020-07-07 18:07:53', 8, 5, 1, 1, 7, NULL, 1);
INSERT INTO `transacciones` VALUES (19, '1', '2020-07-11 00:00:00', 'Ordén de compra redireccionamiento', 1, '2020-07-11 15:07:13', 9, 5, 2, 1, 7, NULL, 1);
INSERT INTO `transacciones` VALUES (20, '2', '2020-08-02 00:00:00', NULL, NULL, '2020-08-02 17:08:56', 8, 5, 1, 1, 2, NULL, 1);
INSERT INTO `transacciones` VALUES (21, '2', '2020-10-21 00:00:00', NULL, 1, '2020-10-21 18:10:17', 9, 5, 1, 1, 1, NULL, 1);
INSERT INTO `transacciones` VALUES (22, '3', '2020-10-21 00:00:00', NULL, NULL, '2020-10-21 19:10:57', 8, 5, 1, 1, 7, NULL, 1);
INSERT INTO `transacciones` VALUES (23, '4', '2021-05-15 00:00:00', NULL, 1, '2021-05-15 09:05:34', 8, 5, 1, 1, 2, NULL, 1);

-- ----------------------------
-- Table structure for usuario
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario`  (
  `Id_Usu` int NOT NULL AUTO_INCREMENT,
  `Usuario_Usu` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Contrasena_Usu` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `UltimoAcceso_Usu` datetime NULL DEFAULT NULL,
  `UltimaContrasena_Usu` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `KeyPago_Usu` double NULL DEFAULT NULL,
  `Email_Usu` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `KeyRecoverPassword_Usu` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `FechaRegistro_Usu` datetime NULL DEFAULT current_timestamp,
  `Primary_Usu` int NULL DEFAULT NULL,
  `Id_Per` int NULL DEFAULT NULL,
  `Id_UsuEst` int NULL DEFAULT NULL,
  `Id_Rol` int NULL DEFAULT NULL,
  PRIMARY KEY (`Id_Usu`) USING BTREE,
  INDEX `fk_usuario_persona_idx`(`Id_Per`) USING BTREE,
  INDEX `fk_usuario_usuario_estado1_idx`(`Id_UsuEst`) USING BTREE,
  INDEX `fk_usuario_roles1_idx`(`Id_Rol`) USING BTREE,
  CONSTRAINT `fk_usuario_persona` FOREIGN KEY (`Id_Per`) REFERENCES `persona` (`Id_Per`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_roles1` FOREIGN KEY (`Id_Rol`) REFERENCES `roles` (`Id_Rol`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_usuario_estado1` FOREIGN KEY (`Id_UsuEst`) REFERENCES `usuario_estado` (`Id_UsuEst`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES (1, 'maicolander', '$2y$04$yeEGSpTCLXeB3QLADKFynuqI7EkcTj3AfiFiV0q7jkjQBdxJquDCG', '2021-05-15 09:05:54', '$2y$04$ixN8mgFcgXM5MhBa7WbQtuHPV/y13jEAcdXowUxWfoFAelbxbmcdi', NULL, 'ander.misak@gmail.com', NULL, '2020-03-23 16:50:04', 1, 1, 1, 1);
INSERT INTO `usuario` VALUES (7, 'maicol', '$2y$04$yeEGSpTCLXeB3QLADKFynuqI7EkcTj3AfiFiV0q7jkjQBdxJquDCG', '2020-05-02 16:05:50', NULL, NULL, 'vikynr@gmail.com', NULL, '2020-03-26 16:03:58', 7, 5, 1, 1);

-- ----------------------------
-- Table structure for usuario_estado
-- ----------------------------
DROP TABLE IF EXISTS `usuario_estado`;
CREATE TABLE `usuario_estado`  (
  `Id_UsuEst` int NOT NULL AUTO_INCREMENT,
  `Descripcion_UsuEst` varchar(90) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Id_UsuEst`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of usuario_estado
-- ----------------------------
INSERT INTO `usuario_estado` VALUES (1, 'Activo');
INSERT INTO `usuario_estado` VALUES (2, 'Inactivo');

-- ----------------------------
-- View structure for vw_documento
-- ----------------------------
DROP VIEW IF EXISTS `vw_documento`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_documento` AS select `documento`.`Id_Doc` AS `Id_Doc`,concat(coalesce(`persona`.`Nombre1_Per`,''),' ',coalesce(`persona`.`Nombre2_Per`,''),' ',coalesce(`persona`.`Apeliido1_Per`,''),' ',coalesce(`persona`.`Apellido2_Per`,'')) AS `Contacto`,`persona`.`Identificacion_Per` AS `Identificacion_Per`,`documento`.`FechaRegistro_Doc` AS `FechaRegistro_Doc`,`documento`.`Numero_Doc` AS `Numero_Doc`,`documento`.`FechaDocumento_Doc` AS `FechaDocumento_Doc`,`documento`.`FechaVencimiento_Doc` AS `FechaVencimiento_Doc`,`documento`.`Observacion_Doc` AS `Observacion_Doc`,`documento`.`IvaIncluido_Doc` AS `IvaIncluido_Doc`,`usuario`.`Usuario_Usu` AS `Usuario_Usu`,`documento_tipo`.`Nombre_DocTip` AS `Nombre_DocTip`,`documento_estado`.`Nombre_DocEst` AS `Nombre_DocEst`,`termino_pago`.`Nombre_TerPag` AS `Nombre_TerPag`,`termino_pago`.`Dias_TerPag` AS `Dias_TerPag`,`documento`.`Id_Per` AS `Id_Per`,`documento`.`Id_Usu` AS `Id_Usu`,`documento`.`Id_DocTip` AS `Id_DocTip`,`documento`.`Id_DocEst` AS `Id_DocEst`,`documento`.`Id_TerPag` AS `Id_TerPag`,`documento`.`Primary_Usu` AS `Primary_Usu` from (((((`documento` join `persona` on(`documento`.`Id_Per` = `persona`.`Id_Per`)) join `usuario` on(`documento`.`Id_Usu` = `usuario`.`Id_Usu`)) join `documento_tipo` on(`documento`.`Id_DocTip` = `documento_tipo`.`Id_DocTip`)) join `documento_estado` on(`documento`.`Id_DocEst` = `documento_estado`.`Id_DocEst`)) left join `termino_pago` on(`documento`.`Id_TerPag` = `termino_pago`.`Id_TerPag`)) ;

-- ----------------------------
-- View structure for vw_items
-- ----------------------------
DROP VIEW IF EXISTS `vw_items`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_items` AS select `items`.`Id_Ite` AS `Id_Ite`,`items`.`Nombre_Ite` AS `Nombre_Ite`,`items`.`Referencia_Ite` AS `Referencia_Ite`,`items`.`Serie_Ite` AS `Serie_Ite`,`items`.`FechaRegistro_Ite` AS `FechaRegistro_Ite`,`items`.`Inventariable_Ite` AS `Inventariable_Ite`,`items`.`Observacion_Ite` AS `Observacion_Ite`,`items`.`Imagen_Item` AS `Imagen_Item`,`items`.`Primary_Usu` AS `Primary_Usu`,`categoria_item`.`Nombre_CatIte` AS `Nombre_CatIte`,`marcas`.`Nombre_Mar` AS `Nombre_Mar`,`medidas`.`Nombre_Med` AS `Nombre_Med`,`medidas`.`Valor_Med` AS `Valor_Med`,`item_tipo`.`Nombre_IteTip` AS `Nombre_IteTip`,`item_estado`.`Nombre_IteEst` AS `Nombre_IteEst`,`bodegas`.`Nombre_Bod` AS `Nombre_Bod`,`items`.`Id_CatIte` AS `Id_CatIte`,`items`.`Id_Mar` AS `Id_Mar`,`items`.`Id_Med` AS `Id_Med`,`items`.`Id_Usu` AS `Id_Usu`,`items`.`Id_IteTip` AS `Id_IteTip`,`items`.`Id_IteEst` AS `Id_IteEst`,`items`.`Id_Bod` AS `Id_Bod` from ((((((`items` left join `categoria_item` on(`items`.`Id_CatIte` = `categoria_item`.`Id_CatIte`)) left join `marcas` on(`items`.`Id_Mar` = `marcas`.`Id_Mar`)) left join `medidas` on(`items`.`Id_Med` = `medidas`.`Id_Med`)) left join `item_tipo` on(`items`.`Id_IteTip` = `item_tipo`.`Id_IteTip`)) left join `item_estado` on(`items`.`Id_IteEst` = `item_estado`.`Id_IteEst`)) left join `bodegas` on(`items`.`Id_Bod` = `bodegas`.`Id_Bod`)) ;

-- ----------------------------
-- View structure for vw_kardex
-- ----------------------------
DROP VIEW IF EXISTS `vw_kardex`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_kardex` AS select `kardex`.`Id_kar` AS `Id_kar`,`kardex`.`Cantidad_Kar` AS `Cantidad_Kar`,`kardex`.`Costo_Kar` AS `Costo_Kar`,`kardex`.`Descuento_Kar` AS `Descuento_Kar`,`kardex`.`Aceptado_Kar` AS `Aceptado_Kar`,`kardex`.`Observacion_Kar` AS `Observacion_Kar`,`kardex`.`FactorMovimiento_Kar` AS `FactorMovimiento_Kar`,`items`.`Nombre_Ite` AS `Nombre_Ite`,concat(`medidas`.`Nombre_Med`,' (',`medidas`.`Valor_Med`,')') AS `Nombre_Med`,concat(`bodegas`.`Nombre_Bod`,' (',coalesce(`bodegas`.`Codigo_Bod`,''),')') AS `Nombre_Bod`,`kardex_tipo`.`Nombre_KarTip` AS `Nombre_KarTip`,`kardex_estado`.`Nombre_KarEst` AS `Nombre_KarEst`,`medidas`.`Unidad_Med` AS `Unidad_Med`,`kardex`.`Cantidad_Kar` * `kardex`.`Costo_Kar` AS `subtotal`,`kardex`.`Cantidad_Kar` * `kardex`.`Costo_Kar` * if(`kardex`.`Descuento_Kar` <> 'null',`kardex`.`Descuento_Kar`,0) / 100 AS `descuento`,`kardex`.`Cantidad_Kar` * `kardex`.`Costo_Kar` - `kardex`.`Cantidad_Kar` * `kardex`.`Costo_Kar` * if(`kardex`.`Descuento_Kar` <> 'null',`kardex`.`Descuento_Kar`,0) / 100 * (if(sum(`impuestos`.`Valor_Imp`) <> 'null',sum(`impuestos`.`Valor_Imp`),0) / 100) AS `impuestos`,`kardex`.`Cantidad_Kar` * `kardex`.`Costo_Kar` - if(`kardex`.`Descuento_Kar` <> 'null',`kardex`.`Descuento_Kar`,0) / 100 + `kardex`.`Cantidad_Kar` * `kardex`.`Costo_Kar` - `kardex`.`Cantidad_Kar` * `kardex`.`Costo_Kar` * if(`kardex`.`Descuento_Kar` <> 'null',`kardex`.`Descuento_Kar`,0) / 100 * (if(sum(`impuestos`.`Valor_Imp`) <> 'null',sum(`impuestos`.`Valor_Imp`),0) / 100) AS `total`,`kardex`.`Id_Doc` AS `Id_Doc`,`kardex`.`Id_Ite` AS `Id_Ite`,`kardex`.`Id_Med` AS `Id_Med`,`kardex`.`Id_Bod` AS `Id_Bod`,`kardex`.`Id_KarTip` AS `Id_KarTip`,`kardex`.`Id_KarEst` AS `Id_KarEst`,`kardex`.`Primary_Usu` AS `Primary_Usu` from (((((((`kardex` join `items` on(`kardex`.`Id_Ite` = `items`.`Id_Ite`)) left join `medidas` on(`kardex`.`Id_Med` = `medidas`.`Id_Med`)) left join `bodegas` on(`kardex`.`Id_Bod` = `bodegas`.`Id_Bod`)) join `kardex_tipo` on(`kardex`.`Id_KarTip` = `kardex_tipo`.`Id_KarTip`)) join `kardex_estado` on(`kardex`.`Id_KarEst` = `kardex_estado`.`Id_KarEst`)) left join `impuestos_kardex` on(`impuestos_kardex`.`Id_kar` = `kardex`.`Id_kar`)) left join `impuestos` on(`impuestos_kardex`.`Id_Imp` = `impuestos`.`Id_Imp`)) where `kardex`.`Id_Doc` = 9 group by `kardex`.`Id_kar` ;

-- ----------------------------
-- View structure for vw_persona
-- ----------------------------
DROP VIEW IF EXISTS `vw_persona`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_persona` AS select `persona`.`Id_Per` AS `Id_Per`,`persona`.`Identificacion_Per` AS `Identificacion_Per`,`persona`.`Nombre1_Per` AS `Nombre1_Per`,`persona`.`Nombre2_Per` AS `Nombre2_Per`,`persona`.`Apeliido1_Per` AS `Apeliido1_Per`,`persona`.`Apellido2_Per` AS `Apellido2_Per`,`persona`.`TelCelular_Per` AS `TelCelular_Per`,`persona`.`Correo_Per` AS `Correo_Per`,`municipio`.`Nombre_Num` AS `Nombre_Num`,`persona_estado`.`Estado_PerEst` AS `Estado_PerEst`,`persona_tipo`.`Descripcion_PerTip` AS `Descripcion_PerTip`,`persona_tipo_identificacion`.`Descripcion_PerTipId` AS `Descripcion_PerTipId`,`persona_tipo_identificacion`.`Codigo_PerTipId` AS `Codigo_PerTipId`,`persona`.`FechaNacimiento_Per` AS `FechaNacimiento_Per`,`departamento`.`Nombre_Dep` AS `Nombre_Dep`,`persona_genero`.`Descripcion_PerGen` AS `Descripcion_PerGen`,`persona_genero`.`Codigo_PerGen` AS `Codigo_PerGen`,`persona`.`Id_PerTipId` AS `Id_PerTipId`,`persona`.`Id_PerGen` AS `Id_PerGen`,`persona`.`Id_Mun` AS `Id_Mun`,`persona`.`Id_PerEst` AS `Id_PerEst`,`persona`.`Id_PerTip` AS `Id_PerTip`,`persona`.`Telefono_Per` AS `Telefono_Per`,`persona`.`FechaRegistro_Per` AS `FechaRegistro_Per`,`persona`.`Celular_Per` AS `Celular_Per`,`persona`.`Direccion_Per` AS `Direccion_Per`,`empresa`.`Nombre_Emp` AS `Nombre_Emp`,`persona`.`Primary_Usu` AS `Primary_Usu` from (((((((`persona` left join `municipio` on(`persona`.`Id_Mun` = `municipio`.`Id_Mun`)) left join `persona_estado` on(`persona`.`Id_PerEst` = `persona_estado`.`Id_PerEst`)) left join `persona_tipo` on(`persona`.`Id_PerTip` = `persona_tipo`.`Id_PerTip`)) left join `persona_tipo_identificacion` on(`persona`.`Id_PerTipId` = `persona_tipo_identificacion`.`Id_PerTipId`)) left join `departamento` on(`municipio`.`Id_Dep` = `departamento`.`Id_Dep`)) left join `persona_genero` on(`persona`.`Id_PerGen` = `persona_genero`.`Id_PerGen`)) left join `empresa` on(`persona`.`Id_Emp` = `empresa`.`Id_Emp`)) ;

-- ----------------------------
-- View structure for vw_transacciones
-- ----------------------------
DROP VIEW IF EXISTS `vw_transacciones`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_transacciones` AS select `transacciones`.`Id_Tran` AS `Id_Tran`,`transacciones`.`Numero_Tran` AS `Numero_Tran`,`transacciones`.`Fecha_Tran` AS `Fecha_Tran`,`transacciones`.`NotaVisible_Tran` AS `NotaVisible_Tran`,`transacciones`.`DocumentoAsociado_Tran` AS `DocumentoAsociado_Tran`,`transacciones`.`FechaRegistro_Tran` AS `FechaRegistro_Tran`,`transacciones`.`Primary_Usu` AS `Primary_Usu`,`transaccion_tipo`.`Nombre_TranTip` AS `Nombre_TranTip`,`transaccion_estado`.`Nombre_TranEst` AS `Nombre_TranEst`,`bancos`.`NombreCuenta_Ban` AS `NombreCuenta_Ban`,`bancos`.`NumeroCuenta_Ban` AS `NumeroCuenta_Ban`,`usuario`.`Usuario_Usu` AS `Usuario_Usu`,concat(coalesce(`persona`.`Nombre1_Per`,''),' ',coalesce(`persona`.`Nombre2_Per`,''),' ',coalesce(`persona`.`Apeliido1_Per`,''),' ',coalesce(`persona`.`Apellido2_Per`,'')) AS `Contacto`,`persona`.`Identificacion_Per` AS `Identificacion_Per`,`transacciones`.`Id_TranTip` AS `Id_TranTip`,`transacciones`.`Id_TranEst` AS `Id_TranEst`,`transacciones`.`Id_Ban` AS `Id_Ban`,`transacciones`.`Id_Usu` AS `Id_Usu`,`transacciones`.`Id_Per` AS `Id_Per`,`transacciones`.`Id_Tran_TransaccionParcial` AS `Id_Tran_TransaccionParcial` from (((((`transacciones` join `transaccion_tipo` on(`transacciones`.`Id_TranTip` = `transaccion_tipo`.`Id_TranTip`)) join `transaccion_estado` on(`transacciones`.`Id_TranEst` = `transaccion_estado`.`Id_TranEst`)) join `bancos` on(`transacciones`.`Id_Ban` = `bancos`.`Id_Ban`)) join `usuario` on(`transacciones`.`Id_Usu` = `usuario`.`Id_Usu`)) join `persona` on(`transacciones`.`Id_Per` = `persona`.`Id_Per`)) ;

-- ----------------------------
-- View structure for vw_usuario
-- ----------------------------
DROP VIEW IF EXISTS `vw_usuario`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_usuario` AS select `usuario`.`Id_Usu` AS `Id_Usu`,concat(coalesce(`persona`.`Nombre1_Per`,''),' ',coalesce(`persona`.`Nombre2_Per`,''),' ',coalesce(`persona`.`Apeliido1_Per`,''),' ',coalesce(`persona`.`Apellido2_Per`,'')) AS `nombres`,`usuario`.`Email_Usu` AS `Email_Usu`,`usuario`.`UltimoAcceso_Usu` AS `UltimoAcceso_Usu`,`usuario`.`UltimaContrasena_Usu` AS `UltimaContrasena_Usu`,`usuario`.`KeyPago_Usu` AS `KeyPago_Usu`,`usuario_estado`.`Descripcion_UsuEst` AS `Descripcion_UsuEst`,`roles`.`Descripcion_Rol` AS `Descripcion_Rol`,`usuario`.`Primary_Usu` AS `Primary_Usu` from (((`usuario` join `persona` on(`usuario`.`Id_Per` = `persona`.`Id_Per`)) join `usuario_estado` on(`usuario`.`Id_UsuEst` = `usuario_estado`.`Id_UsuEst`)) join `roles` on(`usuario`.`Id_Rol` = `roles`.`Id_Rol`)) ;

SET FOREIGN_KEY_CHECKS = 1;
