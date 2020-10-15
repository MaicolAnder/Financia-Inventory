-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema SaludPro
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema SaludPro
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `SaludPro` DEFAULT CHARACTER SET utf8 ;
USE `SaludPro` ;

-- -----------------------------------------------------
-- Table `SaludPro`.`persona_tipo_identificacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SaludPro`.`persona_tipo_identificacion` (
  `Id_PerTipId` INT NOT NULL AUTO_INCREMENT,
  `Descripcion_PerTipId` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`Id_PerTipId`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SaludPro`.`persona_genero`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SaludPro`.`persona_genero` (
  `Id_PerGen` INT NOT NULL AUTO_INCREMENT,
  `Descripcion_PerGen` VARCHAR(45) NULL,
  `Codigo_PerGen` VARCHAR(5) NULL,
  PRIMARY KEY (`Id_PerGen`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SaludPro`.`departamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SaludPro`.`departamento` (
  `Id_Dep` INT NOT NULL AUTO_INCREMENT,
  `Nombre_Dep` VARCHAR(100) NULL,
  `Codigo_Dep` VARCHAR(45) NULL,
  PRIMARY KEY (`Id_Dep`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SaludPro`.`municipio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SaludPro`.`municipio` (
  `Id_Mun` INT NOT NULL AUTO_INCREMENT,
  `Nombre_Num` VARCHAR(90) NULL,
  `Codigo_Mun` VARCHAR(45) NULL,
  `Id_Dep` INT NULL,
  PRIMARY KEY (`Id_Mun`),
  INDEX `fk_municipio_departamento1_idx` (`Id_Dep` ASC) VISIBLE,
  CONSTRAINT `fk_municipio_departamento1`
    FOREIGN KEY (`Id_Dep`)
    REFERENCES `SaludPro`.`departamento` (`Id_Dep`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SaludPro`.`persona_estado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SaludPro`.`persona_estado` (
  `Id_PerEst` INT NOT NULL AUTO_INCREMENT,
  `Estado_PerEst` VARCHAR(45) NULL,
  PRIMARY KEY (`Id_PerEst`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SaludPro`.`persona_tipo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SaludPro`.`persona_tipo` (
  `Id_PerTip` INT NOT NULL AUTO_INCREMENT,
  `Descripcion_PerTip` VARCHAR(45) NULL,
  PRIMARY KEY (`Id_PerTip`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SaludPro`.`empresa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SaludPro`.`empresa` (
  `Id_Emp` INT NOT NULL AUTO_INCREMENT,
  `Nombre_Emp` VARCHAR(250) NULL,
  `DigitoVerificacion_Emp` VARCHAR(45) NULL,
  `Correo_Emp` VARCHAR(45) NULL,
  `Direccion_Emp` VARCHAR(250) NULL,
  `Telefono_Emp` VARCHAR(45) NULL,
  `TelCelular_Emp` VARCHAR(45) NULL,
  `Nit_Emp` VARCHAR(50) NULL,
  `Id_Mun` INT NULL,
  PRIMARY KEY (`Id_Emp`),
  INDEX `fk_empresa_municipio1_idx` (`Id_Mun` ASC) VISIBLE,
  CONSTRAINT `fk_empresa_municipio1`
    FOREIGN KEY (`Id_Mun`)
    REFERENCES `SaludPro`.`municipio` (`Id_Mun`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SaludPro`.`etnia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SaludPro`.`etnia` (
  `Id_Etnia` INT NOT NULL AUTO_INCREMENT,
  `Descripcion_Etnia` VARCHAR(100) NULL,
  PRIMARY KEY (`Id_Etnia`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SaludPro`.`grupo_poblacional`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SaludPro`.`grupo_poblacional` (
  `Id_GrupPob` INT NOT NULL AUTO_INCREMENT,
  `Descripcion_GrupPob` VARCHAR(100) NULL,
  `Id_Etnia` INT NULL,
  PRIMARY KEY (`Id_GrupPob`),
  INDEX `fk_grupo_poblacional_etnia1_idx` (`Id_Etnia` ASC) VISIBLE,
  CONSTRAINT `fk_grupo_poblacional_etnia1`
    FOREIGN KEY (`Id_Etnia`)
    REFERENCES `SaludPro`.`etnia` (`Id_Etnia`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SaludPro`.`discapacidad`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SaludPro`.`discapacidad` (
  `Id_Disc` INT NOT NULL AUTO_INCREMENT,
  `Descripcion_Disc` VARCHAR(255) NULL,
  PRIMARY KEY (`Id_Disc`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SaludPro`.`persona`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SaludPro`.`persona` (
  `Id_Per` INT NOT NULL AUTO_INCREMENT,
  `Identificacion_Per` VARCHAR(45) NULL,
  `Nombre1_Per` VARCHAR(150) NULL,
  `Nombre2_Per` VARCHAR(150) NULL,
  `Apeliido1_Per` VARCHAR(150) NULL,
  `Apellido2_Per` VARCHAR(150) NULL,
  `Telefono_Per` VARCHAR(20) NULL,
  `TelCelular_Per` VARCHAR(45) NULL,
  `Correo_Per` VARCHAR(350) NULL,
  `Direccion_Per` VARCHAR(255) NULL,
  `Comuna_Per` VARCHAR(250) NULL,
  `ZonaResidencia_Per` ENUM('Rural', 'Urbana') NULL,
  `FechaNacimiento_Per` DATE NULL,
  `FechaRegistro_Per` DATETIME NULL,
  `Celular_Per` VARCHAR(20) NULL,
  `Id_PerTipId` INT NULL,
  `Id_PerGen` INT NULL,
  `Id_Mun` INT NULL,
  `Id_PerEst` INT NULL,
  `Id_PerTip` INT NULL,
  `Id_Emp` INT NULL,
  `Id_GrupPob` INT NULL,
  `Id_Disc` INT NULL,
  PRIMARY KEY (`Id_Per`),
  INDEX `fk_persona_persona_tipo_identificacion1_idx` (`Id_PerTipId` ASC) VISIBLE,
  INDEX `fk_persona_persona_genero1_idx` (`Id_PerGen` ASC) VISIBLE,
  INDEX `fk_persona_municipio1_idx` (`Id_Mun` ASC) VISIBLE,
  INDEX `fk_persona_persona_estado1_idx` (`Id_PerEst` ASC) VISIBLE,
  INDEX `fk_persona_persona_tipo1_idx` (`Id_PerTip` ASC) VISIBLE,
  INDEX `fk_persona_empresa1_idx` (`Id_Emp` ASC) VISIBLE,
  INDEX `fk_persona_grupo_poblacional1_idx` (`Id_GrupPob` ASC) VISIBLE,
  INDEX `fk_persona_discapacidad1_idx` (`Id_Disc` ASC) VISIBLE,
  CONSTRAINT `fk_persona_persona_tipo_identificacion1`
    FOREIGN KEY (`Id_PerTipId`)
    REFERENCES `SaludPro`.`persona_tipo_identificacion` (`Id_PerTipId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_persona_persona_genero1`
    FOREIGN KEY (`Id_PerGen`)
    REFERENCES `SaludPro`.`persona_genero` (`Id_PerGen`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_persona_municipio1`
    FOREIGN KEY (`Id_Mun`)
    REFERENCES `SaludPro`.`municipio` (`Id_Mun`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_persona_persona_estado1`
    FOREIGN KEY (`Id_PerEst`)
    REFERENCES `SaludPro`.`persona_estado` (`Id_PerEst`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_persona_persona_tipo1`
    FOREIGN KEY (`Id_PerTip`)
    REFERENCES `SaludPro`.`persona_tipo` (`Id_PerTip`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_persona_empresa1`
    FOREIGN KEY (`Id_Emp`)
    REFERENCES `SaludPro`.`empresa` (`Id_Emp`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_persona_grupo_poblacional1`
    FOREIGN KEY (`Id_GrupPob`)
    REFERENCES `SaludPro`.`grupo_poblacional` (`Id_GrupPob`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_persona_discapacidad1`
    FOREIGN KEY (`Id_Disc`)
    REFERENCES `SaludPro`.`discapacidad` (`Id_Disc`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SaludPro`.`usuario_estado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SaludPro`.`usuario_estado` (
  `Id_UsuEst` INT NOT NULL AUTO_INCREMENT,
  `Descripcion_UsuEst` VARCHAR(90) NULL,
  PRIMARY KEY (`Id_UsuEst`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SaludPro`.`roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SaludPro`.`roles` (
  `Id_Rol` INT NOT NULL AUTO_INCREMENT,
  `Descripcion_Rol` VARCHAR(45) NULL,
  PRIMARY KEY (`Id_Rol`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SaludPro`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SaludPro`.`usuario` (
  `Id_Usu` INT NOT NULL AUTO_INCREMENT,
  `Contrasena_Usu` TEXT NOT NULL,
  `Email_Usu` VARCHAR(200) NOT NULL,
  `UltimoAcceso_Usu` DATETIME NULL,
  `UltimaContrasena_Usu` TEXT NULL,
  `KeyPago_Usu` DOUBLE NULL,
  `Id_Per` INT NULL,
  `Id_UsuEst` INT NULL,
  `Id_Rol` INT NULL,
  PRIMARY KEY (`Id_Usu`),
  INDEX `fk_usuario_persona_idx` (`Id_Per` ASC) VISIBLE,
  INDEX `fk_usuario_usuario_estado1_idx` (`Id_UsuEst` ASC) VISIBLE,
  INDEX `fk_usuario_roles1_idx` (`Id_Rol` ASC) VISIBLE,
  CONSTRAINT `fk_usuario_persona`
    FOREIGN KEY (`Id_Per`)
    REFERENCES `SaludPro`.`persona` (`Id_Per`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_usuario_estado1`
    FOREIGN KEY (`Id_UsuEst`)
    REFERENCES `SaludPro`.`usuario_estado` (`Id_UsuEst`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_roles1`
    FOREIGN KEY (`Id_Rol`)
    REFERENCES `SaludPro`.`roles` (`Id_Rol`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SaludPro`.`permiso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SaludPro`.`permiso` (
  `Id_Perm` INT NOT NULL AUTO_INCREMENT,
  `Descripcion_Perm` VARCHAR(45) NULL,
  `Acceso_Perm` ENUM('SI', 'NO') NULL,
  PRIMARY KEY (`Id_Perm`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SaludPro`.`roles_permiso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SaludPro`.`roles_permiso` (
  `Id_RolPerm` INT NOT NULL AUTO_INCREMENT,
  `Id_Rol` INT NULL,
  `Id_Perm` INT NULL,
  PRIMARY KEY (`Id_RolPerm`, `Id_Rol`, `Id_Perm`),
  INDEX `fk_roles_has_permiso_permiso1_idx` (`Id_Perm` ASC) VISIBLE,
  INDEX `fk_roles_has_permiso_roles1_idx` (`Id_Rol` ASC) VISIBLE,
  CONSTRAINT `fk_roles_has_permiso_roles1`
    FOREIGN KEY (`Id_Rol`)
    REFERENCES `SaludPro`.`roles` (`Id_Rol`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_roles_has_permiso_permiso1`
    FOREIGN KEY (`Id_Perm`)
    REFERENCES `SaludPro`.`permiso` (`Id_Perm`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SaludPro`.`regimen`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SaludPro`.`regimen` (
  `Id_Regimen` INT NOT NULL AUTO_INCREMENT,
  `Nombre_Regimen` VARCHAR(100) NULL,
  PRIMARY KEY (`Id_Regimen`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SaludPro`.`tramite_tipo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SaludPro`.`tramite_tipo` (
  `Id_TramTip` INT NOT NULL AUTO_INCREMENT,
  `Descripcion_TramTip` VARCHAR(45) NULL,
  PRIMARY KEY (`Id_TramTip`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SaludPro`.`afiliacion_tipo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SaludPro`.`afiliacion_tipo` (
  `Id_AfiTip` INT NOT NULL AUTO_INCREMENT,
  `Descripcion_AfiTip` VARCHAR(45) NULL,
  PRIMARY KEY (`Id_AfiTip`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SaludPro`.`afiliado_tipo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SaludPro`.`afiliado_tipo` (
  `Id_AfidoTip` INT NOT NULL AUTO_INCREMENT,
  `Descripcion_AfidoTip` VARCHAR(45) NULL,
  PRIMARY KEY (`Id_AfidoTip`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SaludPro`.`cotizante_tipo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SaludPro`.`cotizante_tipo` (
  `Id_CotTip` INT NOT NULL AUTO_INCREMENT,
  `Descripcion_CotTip` VARCHAR(45) NULL,
  PRIMARY KEY (`Id_CotTip`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SaludPro`.`sisben`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SaludPro`.`sisben` (
  `Id_Sisben` INT NOT NULL AUTO_INCREMENT,
  `Nivel_Sisben` INT NULL,
  `Descripcion_Sisben` TEXT NULL,
  PRIMARY KEY (`Id_Sisben`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SaludPro`.`afiliado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SaludPro`.`afiliado` (
  `Id_Afi` INT NOT NULL AUTO_INCREMENT,
  `Id_Per` INT NULL,
  `Id_Regimen` INT NULL,
  `Id_TramTip` INT NULL,
  `Id_AfiTip` INT NULL,
  `Id_AfidoTip` INT NULL,
  `Id_CotTip` INT NULL,
  `Id_Sisben` INT NULL,
  PRIMARY KEY (`Id_Afi`),
  INDEX `fk_afiliado_persona1_idx` (`Id_Per` ASC) VISIBLE,
  INDEX `fk_afiliado_regimen1_idx` (`Id_Regimen` ASC) VISIBLE,
  INDEX `fk_afiliado_tramite_tipo1_idx` (`Id_TramTip` ASC) VISIBLE,
  INDEX `fk_afiliado_afiliacion_tipo1_idx` (`Id_AfiTip` ASC) VISIBLE,
  INDEX `fk_afiliado_Afiliado_tipo1_idx` (`Id_AfidoTip` ASC) VISIBLE,
  INDEX `fk_afiliado_cotizante_tipo1_idx` (`Id_CotTip` ASC) VISIBLE,
  INDEX `fk_afiliado_sisben1_idx` (`Id_Sisben` ASC) VISIBLE,
  CONSTRAINT `fk_afiliado_persona1`
    FOREIGN KEY (`Id_Per`)
    REFERENCES `SaludPro`.`persona` (`Id_Per`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_afiliado_regimen1`
    FOREIGN KEY (`Id_Regimen`)
    REFERENCES `SaludPro`.`regimen` (`Id_Regimen`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_afiliado_tramite_tipo1`
    FOREIGN KEY (`Id_TramTip`)
    REFERENCES `SaludPro`.`tramite_tipo` (`Id_TramTip`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_afiliado_afiliacion_tipo1`
    FOREIGN KEY (`Id_AfiTip`)
    REFERENCES `SaludPro`.`afiliacion_tipo` (`Id_AfiTip`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_afiliado_Afiliado_tipo1`
    FOREIGN KEY (`Id_AfidoTip`)
    REFERENCES `SaludPro`.`afiliado_tipo` (`Id_AfidoTip`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_afiliado_cotizante_tipo1`
    FOREIGN KEY (`Id_CotTip`)
    REFERENCES `SaludPro`.`cotizante_tipo` (`Id_CotTip`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_afiliado_sisben1`
    FOREIGN KEY (`Id_Sisben`)
    REFERENCES `SaludPro`.`sisben` (`Id_Sisben`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SaludPro`.`seguridad_social_afiliacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SaludPro`.`seguridad_social_afiliacion` (
  `Id_SegSocialAfi` INT NOT NULL AUTO_INCREMENT,
  `FechaReg_SegSocialAfi` DATE NULL,
  `Id_Afi` INT NOT NULL,
  `Id_Emp_ARL` INT NULL,
  `Id_EPS` INT NULL,
  `Id_Pensiones` INT NULL,
  PRIMARY KEY (`Id_SegSocialAfi`),
  INDEX `fk_seguridad_social_empresa1_idx` (`Id_Emp_ARL` ASC) VISIBLE,
  INDEX `fk_seguridad_social_afiliacion_empresa1_idx` (`Id_EPS` ASC) VISIBLE,
  INDEX `fk_seguridad_social_afiliacion_empresa2_idx` (`Id_Pensiones` ASC) VISIBLE,
  INDEX `fk_seguridad_social_afiliacion_afiliado1_idx` (`Id_Afi` ASC) VISIBLE,
  CONSTRAINT `fk_seguridad_social_empresa1`
    FOREIGN KEY (`Id_Emp_ARL`)
    REFERENCES `SaludPro`.`empresa` (`Id_Emp`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_seguridad_social_afiliacion_empresa1`
    FOREIGN KEY (`Id_EPS`)
    REFERENCES `SaludPro`.`empresa` (`Id_Emp`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_seguridad_social_afiliacion_empresa2`
    FOREIGN KEY (`Id_Pensiones`)
    REFERENCES `SaludPro`.`empresa` (`Id_Emp`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_seguridad_social_afiliacion_afiliado1`
    FOREIGN KEY (`Id_Afi`)
    REFERENCES `SaludPro`.`afiliado` (`Id_Afi`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SaludPro`.`empleador_tipo_aportante`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SaludPro`.`empleador_tipo_aportante` (
  `Id_EmplTipApor` INT NOT NULL AUTO_INCREMENT,
  `Descripcion_EmplTipApor` VARCHAR(45) NULL,
  PRIMARY KEY (`Id_EmplTipApor`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SaludPro`.`empleador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SaludPro`.`empleador` (
  `Id_Emple` INT NOT NULL AUTO_INCREMENT,
  `Id_Afi` INT NULL,
  `Id_Emp` INT NULL,
  `Id_Per` INT NULL,
  `Id_EmplTipApor` INT NULL,
  PRIMARY KEY (`Id_Emple`),
  INDEX `fk_empleador_empresa1_idx` (`Id_Emp` ASC) VISIBLE,
  INDEX `fk_empleador_persona1_idx` (`Id_Per` ASC) VISIBLE,
  INDEX `fk_empleador_afiliado1_idx` (`Id_Afi` ASC) VISIBLE,
  INDEX `fk_empleador_empleador_tipo_aportante1_idx` (`Id_EmplTipApor` ASC) VISIBLE,
  CONSTRAINT `fk_empleador_empresa1`
    FOREIGN KEY (`Id_Emp`)
    REFERENCES `SaludPro`.`empresa` (`Id_Emp`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_empleador_persona1`
    FOREIGN KEY (`Id_Per`)
    REFERENCES `SaludPro`.`persona` (`Id_Per`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_empleador_afiliado1`
    FOREIGN KEY (`Id_Afi`)
    REFERENCES `SaludPro`.`afiliado` (`Id_Afi`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_empleador_empleador_tipo_aportante1`
    FOREIGN KEY (`Id_EmplTipApor`)
    REFERENCES `SaludPro`.`empleador_tipo_aportante` (`Id_EmplTipApor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
