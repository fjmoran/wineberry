SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `wineberry` ;
CREATE SCHEMA IF NOT EXISTS `wineberry` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci ;
USE `wineberry` ;

-- -----------------------------------------------------
-- Table `wineberry`.`Perfil`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wineberry`.`Perfil` ;

CREATE TABLE IF NOT EXISTS `wineberry`.`Perfil` (
  `idPerfil` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombrePerfil` VARCHAR(45) NOT NULL,
  `descripcionPerfil` TEXT NULL,
  `activoPerfil` TINYINT(1) NOT NULL DEFAULT true,
  PRIMARY KEY (`idPerfil`),
  UNIQUE INDEX `idPerfil_UNIQUE` (`idPerfil` ASC),
  UNIQUE INDEX `nombrePerfil_UNIQUE` (`nombrePerfil` ASC),
  INDEX `nombrePerfil_idx` (`nombrePerfil` ASC))
ENGINE = InnoDB
COMMENT = 'perfil de usuario para poder establecer a que áreas del sist /* comment truncated */ /*ema tiene acceso y que tipo de accesos tiene.*/';


-- -----------------------------------------------------
-- Table `wineberry`.`Usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wineberry`.`Usuario` ;

CREATE TABLE IF NOT EXISTS `wineberry`.`Usuario` (
  `idUsuario` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombreUsuario` VARCHAR(200) NOT NULL,
  `userUsuario` VARCHAR(45) NOT NULL,
  `claveUsuario` VARCHAR(40) NOT NULL COMMENT 'se considera que la clave será almacenada en SHA1',
  `correoUsuario` VARCHAR(255) NOT NULL,
  `telefonoUsuario` VARCHAR(45) NULL,
  `celularUsuario` VARCHAR(45) NULL COMMENT 'Tabla de usuario del sistema',
  `lastloginUsuario` DATE NULL,
  `activoUsuario` TINYINT(1) NOT NULL DEFAULT true,
  `Perfil_idPerfil` INT UNSIGNED NOT NULL,
  UNIQUE INDEX `nombreUsuario_UNIQUE` (`nombreUsuario` ASC),
  UNIQUE INDEX `userUsuario_UNIQUE` (`userUsuario` ASC),
  INDEX `nombreUsuario_idx` (`nombreUsuario` ASC),
  INDEX `userUsuario_idx` (`userUsuario` ASC),
  PRIMARY KEY (`idUsuario`),
  UNIQUE INDEX `idUsuario_UNIQUE` (`idUsuario` ASC),
  INDEX `fk_Usuario_Perfil_idx` (`Perfil_idPerfil` ASC),
  UNIQUE INDEX `correoUsuario_UNIQUE` (`correoUsuario` ASC),
  CONSTRAINT `fk_Usuario_Perfil`
    FOREIGN KEY (`Perfil_idPerfil`)
    REFERENCES `wineberry`.`Perfil` (`idPerfil`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'usuarios del sistema.'
PACK_KEYS = Default
ROW_FORMAT = Default;


-- -----------------------------------------------------
-- Table `wineberry`.`Pais`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wineberry`.`Pais` ;

CREATE TABLE IF NOT EXISTS `wineberry`.`Pais` (
  `idPais` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombrePais` VARCHAR(120) NOT NULL,
  `intcodePais` VARCHAR(10) NULL COMMENT 'código del país (ver que ocupar el de aviación u otro.',
  `activoPais` TINYINT(1) NOT NULL DEFAULT true,
  PRIMARY KEY (`idPais`),
  UNIQUE INDEX `idPais_UNIQUE` (`idPais` ASC))
ENGINE = InnoDB
COMMENT = 'tabla de paises';


-- -----------------------------------------------------
-- Table `wineberry`.`Region`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wineberry`.`Region` ;

CREATE TABLE IF NOT EXISTS `wineberry`.`Region` (
  `idRegion` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombreRegion` VARCHAR(120) NOT NULL,
  `codeRegion` VARCHAR(10) NULL COMMENT 'codigo de las regiones según gobierno',
  `activoRegion` TINYINT(1) NOT NULL DEFAULT true,
  `Pais_idPais` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idRegion`),
  UNIQUE INDEX `idRegion_UNIQUE` (`idRegion` ASC),
  INDEX `fk_Region_Pais1_idx` (`Pais_idPais` ASC),
  CONSTRAINT `fk_Region_Pais1`
    FOREIGN KEY (`Pais_idPais`)
    REFERENCES `wineberry`.`Pais` (`idPais`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'listado de regiones';


-- -----------------------------------------------------
-- Table `wineberry`.`Comuna`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wineberry`.`Comuna` ;

CREATE TABLE IF NOT EXISTS `wineberry`.`Comuna` (
  `idComuna` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombreComuna` VARCHAR(120) NOT NULL,
  `codeComuna` VARCHAR(10) NULL COMMENT 'código de las comunas según gobierno',
  `activoComuna` TINYINT(1) NOT NULL DEFAULT true,
  `Region_idRegion` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idComuna`),
  UNIQUE INDEX `idComuna_UNIQUE` (`idComuna` ASC),
  INDEX `fk_Comuna_Region1_idx` (`Region_idRegion` ASC),
  CONSTRAINT `fk_Comuna_Region1`
    FOREIGN KEY (`Region_idRegion`)
    REFERENCES `wineberry`.`Region` (`idRegion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Listado de Comunas';


-- -----------------------------------------------------
-- Table `wineberry`.`Direccion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wineberry`.`Direccion` ;

CREATE TABLE IF NOT EXISTS `wineberry`.`Direccion` (
  `idDireccion` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `calleDireccion` VARCHAR(255) NOT NULL,
  `numeroDireccion` VARCHAR(10) NOT NULL,
  `ofDireccion` VARCHAR(10) NULL,
  `codigopostalDireccion` VARCHAR(10) NULL,
  `activoDireccion` TINYINT(1) NOT NULL DEFAULT true,
  `Comuna_idComuna` INT UNSIGNED NULL,
  `Pais_idPais` INT UNSIGNED NOT NULL,
  `Region_idRegion` INT UNSIGNED NULL,
  PRIMARY KEY (`idDireccion`),
  UNIQUE INDEX `idDireccion_UNIQUE` (`idDireccion` ASC),
  INDEX `fk_Direccion_Comuna1_idx` (`Comuna_idComuna` ASC),
  INDEX `fk_Direccion_Pais1_idx` (`Pais_idPais` ASC),
  INDEX `fk_Direccion_Region1_idx` (`Region_idRegion` ASC),
  CONSTRAINT `fk_Direccion_Comuna1`
    FOREIGN KEY (`Comuna_idComuna`)
    REFERENCES `wineberry`.`Comuna` (`idComuna`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Direccion_Pais1`
    FOREIGN KEY (`Pais_idPais`)
    REFERENCES `wineberry`.`Pais` (`idPais`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Direccion_Region1`
    FOREIGN KEY (`Region_idRegion`)
    REFERENCES `wineberry`.`Region` (`idRegion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Tabla de direcciones tanto para clientes como para contactos /* comment truncated */ /*.*/';


-- -----------------------------------------------------
-- Table `wineberry`.`Cliente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wineberry`.`Cliente` ;

CREATE TABLE IF NOT EXISTS `wineberry`.`Cliente` (
  `idCliente` INT UNSIGNED NOT NULL,
  `nombreCliente` VARCHAR(255) NOT NULL COMMENT 'en caso de persona se compone de nombres+Apellido1+Apellido2',
  `nombresCliente` VARCHAR(255) NULL COMMENT 'Para personas son los nombres, para la empresa es la razón social.',
  `Apellido1Cliente` VARCHAR(120) NULL,
  `Apellido2Cliente` VARCHAR(120) NULL,
  `rutCliente` VARCHAR(15) NOT NULL,
  `telefonoCliente` VARCHAR(45) NULL,
  `faxCliente` VARCHAR(45) NULL,
  `emailCliente` VARCHAR(255) NULL,
  `webCliente` VARCHAR(255) NULL,
  `giroCiente` VARCHAR(100) NULL,
  `activoCliente` TINYINT(1) NOT NULL DEFAULT true,
  `tipoCliente` SET('EMPRESA','PERSONA') NOT NULL DEFAULT 'EMPRESA',
  `Usuario_idUsuario` INT UNSIGNED NOT NULL,
  `Direccion_idDireccion` INT UNSIGNED NULL,
  PRIMARY KEY (`idCliente`),
  UNIQUE INDEX `idCliente_UNIQUE` (`idCliente` ASC),
  UNIQUE INDEX `nombreCliente_UNIQUE` (`nombreCliente` ASC),
  UNIQUE INDEX `rutCliente_UNIQUE` (`rutCliente` ASC),
  INDEX `fk_Cliente_Usuario1_idx` (`Usuario_idUsuario` ASC),
  INDEX `fk_Cliente_Direccion1_idx` (`Direccion_idDireccion` ASC),
  CONSTRAINT `fk_Cliente_Usuario1`
    FOREIGN KEY (`Usuario_idUsuario`)
    REFERENCES `wineberry`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cliente_Direccion1`
    FOREIGN KEY (`Direccion_idDireccion`)
    REFERENCES `wineberry`.`Direccion` (`idDireccion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Se guardan los datos del cliente.\n';


-- -----------------------------------------------------
-- Table `wineberry`.`TipoMateria`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wineberry`.`TipoMateria` ;

CREATE TABLE IF NOT EXISTS `wineberry`.`TipoMateria` (
  `idTipoMateria` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombreTipoMateria` VARCHAR(100) NOT NULL,
  `descripcionTipoMateria` TEXT NULL,
  `activoTipoMateria` TINYINT(1) NOT NULL DEFAULT true,
  PRIMARY KEY (`idTipoMateria`),
  UNIQUE INDEX `idTipoMateria_UNIQUE` (`idTipoMateria` ASC),
  UNIQUE INDEX `nombreTipoMateria_UNIQUE` (`nombreTipoMateria` ASC))
ENGINE = InnoDB
COMMENT = 'tipificación de las materias o proyectos de los clientes.';


-- -----------------------------------------------------
-- Table `wineberry`.`Materia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wineberry`.`Materia` ;

CREATE TABLE IF NOT EXISTS `wineberry`.`Materia` (
  `idMateria` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombreMateria` VARCHAR(50) NOT NULL,
  `descripcionMateria` TEXT NULL,
  `activoMateria` TINYINT(1) NOT NULL DEFAULT true,
  `Cliente_idCliente` INT UNSIGNED NOT NULL,
  `Usuario_idUsuario` INT UNSIGNED NOT NULL,
  `TipoMateria_idTipoMateria` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idMateria`, `Cliente_idCliente`),
  UNIQUE INDEX `idMateria_UNIQUE` (`idMateria` ASC),
  UNIQUE INDEX `nombreMateria_UNIQUE` (`nombreMateria` ASC),
  INDEX `fk_Materia_Cliente1_idx` (`Cliente_idCliente` ASC),
  INDEX `fk_Materia_Usuario1_idx` (`Usuario_idUsuario` ASC),
  INDEX `fk_Materia_TipoMateria1_idx` (`TipoMateria_idTipoMateria` ASC),
  CONSTRAINT `fk_Materia_Cliente1`
    FOREIGN KEY (`Cliente_idCliente`)
    REFERENCES `wineberry`.`Cliente` (`idCliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Materia_Usuario1`
    FOREIGN KEY (`Usuario_idUsuario`)
    REFERENCES `wineberry`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Materia_TipoMateria1`
    FOREIGN KEY (`TipoMateria_idTipoMateria`)
    REFERENCES `wineberry`.`TipoMateria` (`idTipoMateria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'materia perteneciente a un cliente.\ntambién se podría defini /* comment truncated */ /*r como proyectos de un cliente.*/';


-- -----------------------------------------------------
-- Table `wineberry`.`Trabajo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wineberry`.`Trabajo` ;

CREATE TABLE IF NOT EXISTS `wineberry`.`Trabajo` (
  `idTrabajo` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `fechaTrabajo` DATE NOT NULL,
  `tiempoTrabajo` TIME NOT NULL,
  `descripcionTrabajo` TEXT NULL,
  `facturadoTrabajo` TINYINT(1) NOT NULL DEFAULT false COMMENT 'Indica si el trabajo ha sido facturado o no.\nAl estar en \'true\' este trabajo NO puede ser modificado.\nEsto reemplaza la tabla EstadoTrabajo',
  `Usuario_idUsuario` INT UNSIGNED NOT NULL,
  `Materia_idMateria` INT UNSIGNED NOT NULL,
  `Materia_Cliente_idCliente` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idTrabajo`),
  UNIQUE INDEX `idTrabajo_UNIQUE` (`idTrabajo` ASC),
  INDEX `fk_Trabajo_Usuario1_idx` (`Usuario_idUsuario` ASC),
  INDEX `fk_Trabajo_Materia1_idx` (`Materia_idMateria` ASC, `Materia_Cliente_idCliente` ASC),
  CONSTRAINT `fk_Trabajo_Usuario1`
    FOREIGN KEY (`Usuario_idUsuario`)
    REFERENCES `wineberry`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Trabajo_Materia1`
    FOREIGN KEY (`Materia_idMateria` , `Materia_Cliente_idCliente`)
    REFERENCES `wineberry`.`Materia` (`idMateria` , `Cliente_idCliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'todos los trabajos ingresados';


-- -----------------------------------------------------
-- Table `wineberry`.`Archivo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wineberry`.`Archivo` ;

CREATE TABLE IF NOT EXISTS `wineberry`.`Archivo` (
  `idArchivo` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombreArchivo` VARCHAR(255) NOT NULL,
  `typeArchivo` VARCHAR(50) NOT NULL,
  `sizeArchivo` INT(11) NOT NULL,
  `contenidoArchivo` MEDIUMBLOB NOT NULL,
  `lockArchivo` TINYINT(1) NOT NULL DEFAULT true,
  `lastupdateArchivo` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `descripcionArchivo` TEXT NULL,
  `Materia_idMateria` INT UNSIGNED NOT NULL,
  `Materia_Cliente_idCliente` INT UNSIGNED NOT NULL,
  `Cliente_idCliente` INT UNSIGNED NOT NULL,
  `Usuario_idUsuario` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idArchivo`),
  UNIQUE INDEX `idArchivo_UNIQUE` (`idArchivo` ASC),
  UNIQUE INDEX `nombreArchivo_UNIQUE` (`nombreArchivo` ASC),
  INDEX `fk_Archivo_Materia1_idx` (`Materia_idMateria` ASC, `Materia_Cliente_idCliente` ASC),
  INDEX `fk_Archivo_Cliente1_idx` (`Cliente_idCliente` ASC),
  INDEX `fk_Archivo_Usuario1_idx` (`Usuario_idUsuario` ASC),
  CONSTRAINT `fk_Archivo_Materia1`
    FOREIGN KEY (`Materia_idMateria` , `Materia_Cliente_idCliente`)
    REFERENCES `wineberry`.`Materia` (`idMateria` , `Cliente_idCliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Archivo_Cliente1`
    FOREIGN KEY (`Cliente_idCliente`)
    REFERENCES `wineberry`.`Cliente` (`idCliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Archivo_Usuario1`
    FOREIGN KEY (`Usuario_idUsuario`)
    REFERENCES `wineberry`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Se guardan los archivos correspondiente a un cliente / mater /* comment truncated */ /*ia especifico.*/';


-- -----------------------------------------------------
-- Table `wineberry`.`Contacto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wineberry`.`Contacto` ;

CREATE TABLE IF NOT EXISTS `wineberry`.`Contacto` (
  `idContacto` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombreContacto` VARCHAR(200) NOT NULL,
  `telefonoContacto` VARCHAR(20) NULL,
  `celularContacto` VARCHAR(20) NULL,
  `correoContacto` VARCHAR(255) NULL,
  `rutContacto` VARCHAR(15) NULL,
  `webContacto` VARCHAR(255) NULL,
  `linkedInContacto` VARCHAR(400) NULL,
  `twitterContacto` VARCHAR(255) NULL,
  `facebookContacto` VARCHAR(400) NULL,
  `Direccion_idDireccion` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idContacto`),
  UNIQUE INDEX `idContacto_UNIQUE` (`idContacto` ASC),
  UNIQUE INDEX `nombreContacto_UNIQUE` (`nombreContacto` ASC),
  INDEX `fk_Contacto_Direccion1_idx` (`Direccion_idDireccion` ASC),
  CONSTRAINT `fk_Contacto_Direccion1`
    FOREIGN KEY (`Direccion_idDireccion`)
    REFERENCES `wineberry`.`Direccion` (`idDireccion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'son los contactos que tiene la empresa.';


-- -----------------------------------------------------
-- Table `wineberry`.`TipoContacto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wineberry`.`TipoContacto` ;

CREATE TABLE IF NOT EXISTS `wineberry`.`TipoContacto` (
  `idTipoContacto` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombreTipoContacto` VARCHAR(45) NOT NULL,
  `descripcionTipoContacto` TEXT NULL,
  PRIMARY KEY (`idTipoContacto`),
  UNIQUE INDEX `idTipoContacto_UNIQUE` (`idTipoContacto` ASC))
ENGINE = InnoDB
COMMENT = 'relaciones de los contactos con los clientes, por ejemplo co /* comment truncated */ /*ntador, secretaria etc.*/';


-- -----------------------------------------------------
-- Table `wineberry`.`ContactoCliente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wineberry`.`ContactoCliente` ;

CREATE TABLE IF NOT EXISTS `wineberry`.`ContactoCliente` (
  `Cliente_idCliente` INT UNSIGNED NOT NULL,
  `Contacto_idContacto` INT UNSIGNED NOT NULL,
  `TipoContacto_idTipoContacto` INT UNSIGNED NULL,
  PRIMARY KEY (`Cliente_idCliente`, `Contacto_idContacto`),
  INDEX `fk_ContactoCliente_Contacto1_idx` (`Contacto_idContacto` ASC),
  INDEX `fk_ContactoCliente_TipoContacto1_idx` (`TipoContacto_idTipoContacto` ASC),
  CONSTRAINT `fk_ContactoCliente_Cliente1`
    FOREIGN KEY (`Cliente_idCliente`)
    REFERENCES `wineberry`.`Cliente` (`idCliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ContactoCliente_Contacto1`
    FOREIGN KEY (`Contacto_idContacto`)
    REFERENCES `wineberry`.`Contacto` (`idContacto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ContactoCliente_TipoContacto1`
    FOREIGN KEY (`TipoContacto_idTipoContacto`)
    REFERENCES `wineberry`.`TipoContacto` (`idTipoContacto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'se guarda las relaciones de los contactos con los clientes.';


-- -----------------------------------------------------
-- Table `wineberry`.`Moneda`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wineberry`.`Moneda` ;

CREATE TABLE IF NOT EXISTS `wineberry`.`Moneda` (
  `idMoneda` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombreMoneda` VARCHAR(45) NOT NULL,
  `descripcionMoneda` TEXT NULL,
  `activoMoneda` TINYINT(1) NOT NULL DEFAULT true,
  PRIMARY KEY (`idMoneda`),
  UNIQUE INDEX `idMoneda_UNIQUE` (`idMoneda` ASC),
  UNIQUE INDEX `nombreMoneda_UNIQUE` (`nombreMoneda` ASC))
ENGINE = InnoDB
COMMENT = 'Guarda las distintas monedas con que se trabajaran.';


-- -----------------------------------------------------
-- Table `wineberry`.`TipoGasto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wineberry`.`TipoGasto` ;

CREATE TABLE IF NOT EXISTS `wineberry`.`TipoGasto` (
  `idTipoGasto` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombreTipoGasto` VARCHAR(45) NOT NULL,
  `descripcionTipoGasto` TEXT NULL,
  PRIMARY KEY (`idTipoGasto`),
  UNIQUE INDEX `idTipoGasto_UNIQUE` (`idTipoGasto` ASC))
ENGINE = InnoDB
COMMENT = 'Lista de tipos de gastos que se pueden realizar.\nEn caso que /* comment truncated */ /* no se ocupe hay que generar el tipo de defecto.*/';


-- -----------------------------------------------------
-- Table `wineberry`.`Gasto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wineberry`.`Gasto` ;

CREATE TABLE IF NOT EXISTS `wineberry`.`Gasto` (
  `idGasto` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `fechaGasto` DATE NOT NULL,
  `montoGasto` FLOAT NOT NULL,
  `pagadoGasto` TINYINT(1) NOT NULL DEFAULT false COMMENT 'indica si el gasto fue pagado por el cliente o no \nsi fue pagado esta en true, en caso contrario es false.',
  `descripcionGasto` TEXT NULL,
  `Usuario_idUsuario` INT UNSIGNED NOT NULL,
  `Materia_idMateria` INT UNSIGNED NOT NULL,
  `Materia_Cliente_idCliente` INT UNSIGNED NOT NULL,
  `Moneda_idMoneda` INT UNSIGNED NOT NULL,
  `TipoGasto_idTipoGasto` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idGasto`),
  UNIQUE INDEX `idGasto_UNIQUE` (`idGasto` ASC),
  INDEX `fk_Gasto_Usuario1_idx` (`Usuario_idUsuario` ASC),
  INDEX `fk_Gasto_Materia1_idx` (`Materia_idMateria` ASC, `Materia_Cliente_idCliente` ASC),
  INDEX `fk_Gasto_Moneda1_idx` (`Moneda_idMoneda` ASC),
  INDEX `fk_Gasto_TipoGasto1_idx` (`TipoGasto_idTipoGasto` ASC),
  CONSTRAINT `fk_Gasto_Usuario1`
    FOREIGN KEY (`Usuario_idUsuario`)
    REFERENCES `wineberry`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Gasto_Materia1`
    FOREIGN KEY (`Materia_idMateria` , `Materia_Cliente_idCliente`)
    REFERENCES `wineberry`.`Materia` (`idMateria` , `Cliente_idCliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Gasto_Moneda1`
    FOREIGN KEY (`Moneda_idMoneda`)
    REFERENCES `wineberry`.`Moneda` (`idMoneda`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Gasto_TipoGasto1`
    FOREIGN KEY (`TipoGasto_idTipoGasto`)
    REFERENCES `wineberry`.`TipoGasto` (`idTipoGasto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'se ingresas los gastos realizados para un cliente/materia de /* comment truncated */ /*terminado, por un usuario determinado.*/';


-- -----------------------------------------------------
-- Table `wineberry`.`Boleta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wineberry`.`Boleta` ;

CREATE TABLE IF NOT EXISTS `wineberry`.`Boleta` (
  `idImagenBoleta` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombreImagenBoleta` VARCHAR(200) NULL,
  `sizeImagenBoleta` INT(11) NULL,
  `contenidoImagenBoleta` MEDIUMBLOB NULL,
  `typeImagenBoleta` VARCHAR(50) NULL,
  `numeroBoleta` VARCHAR(45) NOT NULL,
  `descripcionImagenBoleta` TEXT NULL,
  `montoBoleta` FLOAT NOT NULL,
  `Gasto_idGasto` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idImagenBoleta`),
  UNIQUE INDEX `idImagenBoleta_UNIQUE` (`idImagenBoleta` ASC),
  INDEX `fk_Boleta_Gasto1_idx` (`Gasto_idGasto` ASC),
  CONSTRAINT `fk_Boleta_Gasto1`
    FOREIGN KEY (`Gasto_idGasto`)
    REFERENCES `wineberry`.`Gasto` (`idGasto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'se guarda las boletas con o sin imagen de los documentos ren /* comment truncated */ /*didos para poder ser presentadas al cliente en que caso de ser necesario.*/';


-- -----------------------------------------------------
-- Table `wineberry`.`TarifaUsuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wineberry`.`TarifaUsuario` ;

CREATE TABLE IF NOT EXISTS `wineberry`.`TarifaUsuario` (
  `idTarifaUsuario` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `valorTarifaUsuario` FLOAT NOT NULL,
  `Usuario_idUsuario` INT UNSIGNED NOT NULL,
  `Moneda_idMoneda` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idTarifaUsuario`, `Usuario_idUsuario`, `Moneda_idMoneda`),
  UNIQUE INDEX `idTarifaUsuario_UNIQUE` (`idTarifaUsuario` ASC),
  INDEX `fk_TarifaUsuario_Usuario1_idx` (`Usuario_idUsuario` ASC),
  INDEX `fk_TarifaUsuario_Moneda1_idx` (`Moneda_idMoneda` ASC),
  CONSTRAINT `fk_TarifaUsuario_Usuario1`
    FOREIGN KEY (`Usuario_idUsuario`)
    REFERENCES `wineberry`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TarifaUsuario_Moneda1`
    FOREIGN KEY (`Moneda_idMoneda`)
    REFERENCES `wineberry`.`Moneda` (`idMoneda`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Tarifa general asignada a una usuario';


-- -----------------------------------------------------
-- Table `wineberry`.`TarifaMateria`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wineberry`.`TarifaMateria` ;

CREATE TABLE IF NOT EXISTS `wineberry`.`TarifaMateria` (
  `idTarifaMateria` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `valorTarifaMateria` FLOAT NOT NULL,
  `Moneda_idMoneda` INT UNSIGNED NOT NULL,
  `Materia_idMateria` INT UNSIGNED NOT NULL,
  `Materia_Cliente_idCliente` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idTarifaMateria`, `Moneda_idMoneda`, `Materia_idMateria`, `Materia_Cliente_idCliente`),
  UNIQUE INDEX `idTarifaMateria_UNIQUE` (`idTarifaMateria` ASC),
  INDEX `fk_TarifaMateria_Moneda1_idx` (`Moneda_idMoneda` ASC),
  INDEX `fk_TarifaMateria_Materia1_idx` (`Materia_idMateria` ASC, `Materia_Cliente_idCliente` ASC),
  CONSTRAINT `fk_TarifaMateria_Moneda1`
    FOREIGN KEY (`Moneda_idMoneda`)
    REFERENCES `wineberry`.`Moneda` (`idMoneda`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TarifaMateria_Materia1`
    FOREIGN KEY (`Materia_idMateria` , `Materia_Cliente_idCliente`)
    REFERENCES `wineberry`.`Materia` (`idMateria` , `Cliente_idCliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'guarda las tarifas asignadas por materia a cada usuario.';


-- -----------------------------------------------------
-- Table `wineberry`.`EstadoFactura`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wineberry`.`EstadoFactura` ;

CREATE TABLE IF NOT EXISTS `wineberry`.`EstadoFactura` (
  `idEstadoFactura` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombreEstadoFactura` VARCHAR(45) NOT NULL,
  `descripcionEstadoFactura` TEXT NULL,
  PRIMARY KEY (`idEstadoFactura`),
  UNIQUE INDEX `idEstadoFactura_UNIQUE` (`idEstadoFactura` ASC))
ENGINE = InnoDB
COMMENT = 'Describe los distintos estados en que se encuentra una factu /* comment truncated */ /*ra*/';


-- -----------------------------------------------------
-- Table `wineberry`.`Factura`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wineberry`.`Factura` ;

CREATE TABLE IF NOT EXISTS `wineberry`.`Factura` (
  `idFactura` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `fechaFactura` DATE NOT NULL,
  `montoFactura` FLOAT NOT NULL,
  `fechainicioFactura` DATE NOT NULL,
  `fechafinFactura` DATE NOT NULL,
  `tasacambioFactura` FLOAT NOT NULL,
  `EstadoFactura_idEstadoFactura` INT UNSIGNED NOT NULL,
  `Cliente_idCliente` INT UNSIGNED NOT NULL,
  `Moneda_idMoneda` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idFactura`),
  UNIQUE INDEX `idFactura_UNIQUE` (`idFactura` ASC),
  INDEX `fk_Factura_EstadoFactura1_idx` (`EstadoFactura_idEstadoFactura` ASC),
  INDEX `fk_Factura_Cliente1_idx` (`Cliente_idCliente` ASC),
  INDEX `fk_Factura_Moneda1_idx` (`Moneda_idMoneda` ASC),
  CONSTRAINT `fk_Factura_EstadoFactura1`
    FOREIGN KEY (`EstadoFactura_idEstadoFactura`)
    REFERENCES `wineberry`.`EstadoFactura` (`idEstadoFactura`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Factura_Cliente1`
    FOREIGN KEY (`Cliente_idCliente`)
    REFERENCES `wineberry`.`Cliente` (`idCliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Factura_Moneda1`
    FOREIGN KEY (`Moneda_idMoneda`)
    REFERENCES `wineberry`.`Moneda` (`idMoneda`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'facturas realizadas';


-- -----------------------------------------------------
-- Table `wineberry`.`TrabajoFactura`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wineberry`.`TrabajoFactura` ;

CREATE TABLE IF NOT EXISTS `wineberry`.`TrabajoFactura` (
  `idTrabajoFactura` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tiempoTrabajoFactura` TIME NULL COMMENT 'El tiempo que se le factura al cliente en caso que no sea el mismo que esta en el trabajo facturado',
  `Factura_idFactura` INT UNSIGNED NOT NULL,
  `Trabajo_idTrabajo` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idTrabajoFactura`, `Trabajo_idTrabajo`),
  UNIQUE INDEX `idTrabajoFactura_UNIQUE` (`idTrabajoFactura` ASC),
  INDEX `fk_TrabajoFactura_Factura1_idx` (`Factura_idFactura` ASC),
  INDEX `fk_TrabajoFactura_Trabajo1_idx` (`Trabajo_idTrabajo` ASC),
  CONSTRAINT `fk_TrabajoFactura_Factura1`
    FOREIGN KEY (`Factura_idFactura`)
    REFERENCES `wineberry`.`Factura` (`idFactura`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TrabajoFactura_Trabajo1`
    FOREIGN KEY (`Trabajo_idTrabajo`)
    REFERENCES `wineberry`.`Trabajo` (`idTrabajo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Trabajos que están en la factura.';


-- -----------------------------------------------------
-- Table `wineberry`.`TipoAbono`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wineberry`.`TipoAbono` ;

CREATE TABLE IF NOT EXISTS `wineberry`.`TipoAbono` (
  `idTipoAbono` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombreTipoAbono` VARCHAR(45) NOT NULL,
  `descripcionTipoAbono` TEXT NULL,
  PRIMARY KEY (`idTipoAbono`),
  UNIQUE INDEX `idTipoAbono_UNIQUE` (`idTipoAbono` ASC))
ENGINE = InnoDB
COMMENT = 'Tipos de abonos que se puede realizar.\nEn caso de no ser ocu /* comment truncated */ /*pado debe agregarse tipo por defecto.*/';


-- -----------------------------------------------------
-- Table `wineberry`.`Abono`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wineberry`.`Abono` ;

CREATE TABLE IF NOT EXISTS `wineberry`.`Abono` (
  `idAbono` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `fechaAbono` DATE NOT NULL,
  `montoAbono` FLOAT NOT NULL,
  `descripcionAbono` TEXT NULL,
  `Cliente_idCliente` INT UNSIGNED NOT NULL,
  `Usuario_idUsuario` INT UNSIGNED NOT NULL,
  `TipoAbono_idTipoAbono` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idAbono`, `Cliente_idCliente`),
  UNIQUE INDEX `idAbono_UNIQUE` (`idAbono` ASC),
  INDEX `fk_Abono_Cliente1_idx` (`Cliente_idCliente` ASC),
  INDEX `fk_Abono_Usuario1_idx` (`Usuario_idUsuario` ASC),
  INDEX `fk_Abono_TipoAbono1_idx` (`TipoAbono_idTipoAbono` ASC),
  CONSTRAINT `fk_Abono_Cliente1`
    FOREIGN KEY (`Cliente_idCliente`)
    REFERENCES `wineberry`.`Cliente` (`idCliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Abono_Usuario1`
    FOREIGN KEY (`Usuario_idUsuario`)
    REFERENCES `wineberry`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Abono_TipoAbono1`
    FOREIGN KEY (`TipoAbono_idTipoAbono`)
    REFERENCES `wineberry`.`TipoAbono` (`idTipoAbono`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Reemplaza tabla AgendaEconomica\npara guardar los abonos o pl /* comment truncated */ /*atas entregadas por los clientes para distintos tramites.*/';


-- -----------------------------------------------------
-- Table `wineberry`.`Pagina`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wineberry`.`Pagina` ;

CREATE TABLE IF NOT EXISTS `wineberry`.`Pagina` (
  `idPagina` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `urlPagina` VARCHAR(255) NOT NULL COMMENT 'url de la pagina directorio+pagina',
  `nombrePagina` VARCHAR(255) NOT NULL COMMENT 'solo la pagina, sin directorios',
  `descripcionPagina` TEXT NULL COMMENT 'descripcion de la pagina',
  `activoPagina` TINYINT(1) NOT NULL DEFAULT true COMMENT 'indica si la pagina esta activa para ser desplegada.',
  PRIMARY KEY (`idPagina`),
  UNIQUE INDEX `idPagina_UNIQUE` (`idPagina` ASC),
  UNIQUE INDEX `urlPagina_UNIQUE` (`urlPagina` ASC))
ENGINE = InnoDB
COMMENT = 'pagina con listado de la paginas que existen en el sistema.\n /* comment truncated */ /*Este listado será ocupado para la validación de permisos de despliegue de dichas páginas.*/';


-- -----------------------------------------------------
-- Table `wineberry`.`Menu`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wineberry`.`Menu` ;

CREATE TABLE IF NOT EXISTS `wineberry`.`Menu` (
  `idMenu` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombreMenu` VARCHAR(45) NOT NULL COMMENT 'nombre a desplegar de la opción.',
  `nivelMenu` INT NOT NULL DEFAULT 1 COMMENT 'indique que nivel tiene',
  `activoMenu` TINYINT(1) NOT NULL DEFAULT true COMMENT 'indica si la opción esta activa para ser desplegada.',
  `posicionMenu` INT UNSIGNED NOT NULL DEFAULT 0,
  `spanclassMenu` VARCHAR(100) NULL,
  `Pagina_idPagina` INT UNSIGNED NULL,
  `Menu_idMenu` INT UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`idMenu`),
  UNIQUE INDEX `idMenu_UNIQUE` (`idMenu` ASC),
  INDEX `fk_Menu_Pagina1_idx` (`Pagina_idPagina` ASC),
  INDEX `fk_Menu_Menu1_idx` (`Menu_idMenu` ASC),
  CONSTRAINT `fk_Menu_Pagina1`
    FOREIGN KEY (`Pagina_idPagina`)
    REFERENCES `wineberry`.`Pagina` (`idPagina`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Menu_Menu1`
    FOREIGN KEY (`Menu_idMenu`)
    REFERENCES `wineberry`.`Menu` (`idMenu`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Despliegue del Menu con URL.';


-- -----------------------------------------------------
-- Table `wineberry`.`PaginaenPagina`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wineberry`.`PaginaenPagina` ;

CREATE TABLE IF NOT EXISTS `wineberry`.`PaginaenPagina` (
  `idPaginaenPagina` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `Pagina_idPagina` INT UNSIGNED NOT NULL,
  `Pagina_idPagina1` INT UNSIGNED NOT NULL,
  INDEX `fk_Pagina_has_Pagina1_Pagina2_idx` (`Pagina_idPagina1` ASC),
  INDEX `fk_Pagina_has_Pagina1_Pagina1_idx` (`Pagina_idPagina` ASC),
  PRIMARY KEY (`idPaginaenPagina`),
  CONSTRAINT `fk_Pagina_has_Pagina1_Pagina1`
    FOREIGN KEY (`Pagina_idPagina`)
    REFERENCES `wineberry`.`Pagina` (`idPagina`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Pagina_has_Pagina1_Pagina2`
    FOREIGN KEY (`Pagina_idPagina1`)
    REFERENCES `wineberry`.`Pagina` (`idPagina`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wineberry`.`PermisoPagina`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wineberry`.`PermisoPagina` ;

CREATE TABLE IF NOT EXISTS `wineberry`.`PermisoPagina` (
  `Perfil_idPerfil` INT UNSIGNED NOT NULL,
  `idPermisoPagina` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `PaginaenPagina_idPaginaenPagina` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idPermisoPagina`, `Perfil_idPerfil`, `PaginaenPagina_idPaginaenPagina`),
  INDEX `fk_PermisoPagina_PaginaenPagina1_idx` (`PaginaenPagina_idPaginaenPagina` ASC),
  CONSTRAINT `fk_PermisoPagina_Perfil1`
    FOREIGN KEY (`Perfil_idPerfil`)
    REFERENCES `wineberry`.`Perfil` (`idPerfil`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_PermisoPagina_PaginaenPagina1`
    FOREIGN KEY (`PaginaenPagina_idPaginaenPagina`)
    REFERENCES `wineberry`.`PaginaenPagina` (`idPaginaenPagina`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'permisos de las pagina.';


-- -----------------------------------------------------
-- Table `wineberry`.`Input`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wineberry`.`Input` ;

CREATE TABLE IF NOT EXISTS `wineberry`.`Input` (
  `idInput` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombreInput` VARCHAR(255) NOT NULL,
  `descripcionInput` TEXT NULL,
  `activoInput` TINYINT(1) NOT NULL DEFAULT true,
  `ocultoInput` TINYINT(1) NOT NULL DEFAULT false,
  `sololecturaInput` TINYINT(1) NOT NULL DEFAULT false,
  `Pagina_idPagina` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idInput`),
  UNIQUE INDEX `idConcepto_UNIQUE` (`idInput` ASC),
  INDEX `fk_Input_Pagina1_idx` (`Pagina_idPagina` ASC),
  CONSTRAINT `fk_Input_Pagina1`
    FOREIGN KEY (`Pagina_idPagina`)
    REFERENCES `wineberry`.`Pagina` (`idPagina`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Se describen los conceptos del sistema, como usuario, client /* comment truncated */ /*e, materia, etc.*/';


-- -----------------------------------------------------
-- Table `wineberry`.`Label`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wineberry`.`Label` ;

CREATE TABLE IF NOT EXISTS `wineberry`.`Label` (
  `idLabel` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombreLabel` VARCHAR(255) NOT NULL,
  `despliegueLabel` VARCHAR(255) NOT NULL,
  `classLabel` VARCHAR(255) NULL,
  PRIMARY KEY (`idLabel`),
  UNIQUE INDEX `idLabel_UNIQUE` (`idLabel` ASC))
ENGINE = InnoDB
COMMENT = 'listado de label que deben ser cambiados al momento de carga /* comment truncated */ /*r la pagina (internacionalización)*/';


-- -----------------------------------------------------
-- Table `wineberry`.`Feriado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wineberry`.`Feriado` ;

CREATE TABLE IF NOT EXISTS `wineberry`.`Feriado` (
  `idFeriado` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `fechaFeriado` DATE NOT NULL,
  `tipoFeriado` SET('COMPLETO','MEDIODIA') NOT NULL,
  `descripcionFeriado` TEXT NULL,
  `activoFeriado` TINYINT(1) NOT NULL DEFAULT true,
  `Pais_idPais` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idFeriado`),
  UNIQUE INDEX `idFeriados_UNIQUE` (`idFeriado` ASC),
  INDEX `fk_Feriados_Pais1_idx` (`Pais_idPais` ASC),
  CONSTRAINT `fk_Feriados_Pais1`
    FOREIGN KEY (`Pais_idPais`)
    REFERENCES `wineberry`.`Pais` (`idPais`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'tabla de feriados legales';


-- -----------------------------------------------------
-- Table `wineberry`.`Parametro`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wineberry`.`Parametro` ;

CREATE TABLE IF NOT EXISTS `wineberry`.`Parametro` (
  `idParametro` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombreParametro` VARCHAR(45) NOT NULL,
  `valorParametro` VARCHAR(45) NOT NULL,
  `activoParametro` TINYINT(1) NOT NULL DEFAULT true,
  PRIMARY KEY (`idParametro`))
ENGINE = InnoDB
COMMENT = 'tabla de parámetros estándar del sistema';


-- -----------------------------------------------------
-- Table `wineberry`.`ParametroUsuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wineberry`.`ParametroUsuario` ;

CREATE TABLE IF NOT EXISTS `wineberry`.`ParametroUsuario` (
  `idParametroUsuario` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombreParametroUsuario` VARCHAR(45) NOT NULL,
  `valorParametroUsuario` VARCHAR(45) NOT NULL,
  `Usuario_idUsuario` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idParametroUsuario`, `Usuario_idUsuario`),
  UNIQUE INDEX `idParametroUsuario_UNIQUE` (`idParametroUsuario` ASC),
  INDEX `fk_ParametroUsuario_Usuario1_idx` (`Usuario_idUsuario` ASC),
  CONSTRAINT `fk_ParametroUsuario_Usuario1`
    FOREIGN KEY (`Usuario_idUsuario`)
    REFERENCES `wineberry`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'listado de parámetros por usuario.';


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `wineberry`.`Perfil`
-- -----------------------------------------------------
START TRANSACTION;
USE `wineberry`;
INSERT INTO `wineberry`.`Perfil` (`idPerfil`, `nombrePerfil`, `descripcionPerfil`, `activoPerfil`) VALUES (1, 'Administrador', 'Perfil de Administrador con permisos sobre todo', true);

COMMIT;


-- -----------------------------------------------------
-- Data for table `wineberry`.`Usuario`
-- -----------------------------------------------------
START TRANSACTION;
USE `wineberry`;
INSERT INTO `wineberry`.`Usuario` (`idUsuario`, `nombreUsuario`, `userUsuario`, `claveUsuario`, `correoUsuario`, `telefonoUsuario`, `celularUsuario`, `lastloginUsuario`, `activoUsuario`, `Perfil_idPerfil`) VALUES (1, 'Administrador', 'root', '0553a463d0fe226e64d8dba14c4e8033dc81ce23', 'root@localhost.localdomain', NULL, NULL, NULL, true, 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `wineberry`.`Pais`
-- -----------------------------------------------------
START TRANSACTION;
USE `wineberry`;
INSERT INTO `wineberry`.`Pais` (`idPais`, `nombrePais`, `intcodePais`, `activoPais`) VALUES (1, 'Chile', 'CHI', 1);
INSERT INTO `wineberry`.`Pais` (`idPais`, `nombrePais`, `intcodePais`, `activoPais`) VALUES (2, 'Argentina', 'ARG', 1);
INSERT INTO `wineberry`.`Pais` (`idPais`, `nombrePais`, `intcodePais`, `activoPais`) VALUES (3, 'Estados Unidos de Norte AmÃ©rica', 'USA', 1);
INSERT INTO `wineberry`.`Pais` (`idPais`, `nombrePais`, `intcodePais`, `activoPais`) VALUES (4, 'PerÃº', 'PER', 1);
INSERT INTO `wineberry`.`Pais` (`idPais`, `nombrePais`, `intcodePais`, `activoPais`) VALUES (5, 'IrÃ¡n', 'IRA', 0);

COMMIT;


-- -----------------------------------------------------
-- Data for table `wineberry`.`Region`
-- -----------------------------------------------------
START TRANSACTION;
USE `wineberry`;
INSERT INTO `wineberry`.`Region` (`idRegion`, `nombreRegion`, `codeRegion`, `activoRegion`, `Pais_idPais`) VALUES (1, 'TarapacÃ¡', '01', 1, 1);
INSERT INTO `wineberry`.`Region` (`idRegion`, `nombreRegion`, `codeRegion`, `activoRegion`, `Pais_idPais`) VALUES (2, 'Antofagasta', '02', 1, 1);
INSERT INTO `wineberry`.`Region` (`idRegion`, `nombreRegion`, `codeRegion`, `activoRegion`, `Pais_idPais`) VALUES (3, 'Atacama', '03', 1, 1);
INSERT INTO `wineberry`.`Region` (`idRegion`, `nombreRegion`, `codeRegion`, `activoRegion`, `Pais_idPais`) VALUES (4, 'Coquimbo', '04', 1, 1);
INSERT INTO `wineberry`.`Region` (`idRegion`, `nombreRegion`, `codeRegion`, `activoRegion`, `Pais_idPais`) VALUES (5, 'ValparaÃ­so', '05', 1, 1);
INSERT INTO `wineberry`.`Region` (`idRegion`, `nombreRegion`, `codeRegion`, `activoRegion`, `Pais_idPais`) VALUES (6, 'Libertador Gral. Bernardo Oâ€™Higgins', '06', 1, 1);
INSERT INTO `wineberry`.`Region` (`idRegion`, `nombreRegion`, `codeRegion`, `activoRegion`, `Pais_idPais`) VALUES (7, 'Maule', '07', 1, 1);
INSERT INTO `wineberry`.`Region` (`idRegion`, `nombreRegion`, `codeRegion`, `activoRegion`, `Pais_idPais`) VALUES (8, 'BiobÃ­o', '08', 1, 1);
INSERT INTO `wineberry`.`Region` (`idRegion`, `nombreRegion`, `codeRegion`, `activoRegion`, `Pais_idPais`) VALUES (9, 'AraucanÃ­a', '09', 1, 1);
INSERT INTO `wineberry`.`Region` (`idRegion`, `nombreRegion`, `codeRegion`, `activoRegion`, `Pais_idPais`) VALUES (10, 'Los Lagos', '10', 1, 1);
INSERT INTO `wineberry`.`Region` (`idRegion`, `nombreRegion`, `codeRegion`, `activoRegion`, `Pais_idPais`) VALUES (11, 'AisÃ©n del Gral. Carlos IbÃ¡Ã±ez del Campo', '11', 1, 1);
INSERT INTO `wineberry`.`Region` (`idRegion`, `nombreRegion`, `codeRegion`, `activoRegion`, `Pais_idPais`) VALUES (12, 'Magallanes y de la AntÃ¡rtica Chilena', '12', 1, 1);
INSERT INTO `wineberry`.`Region` (`idRegion`, `nombreRegion`, `codeRegion`, `activoRegion`, `Pais_idPais`) VALUES (13, 'Metropolitana de Santiago', '13', 1, 1);
INSERT INTO `wineberry`.`Region` (`idRegion`, `nombreRegion`, `codeRegion`, `activoRegion`, `Pais_idPais`) VALUES (14, 'Los RÃ­os', '14', 1, 1);
INSERT INTO `wineberry`.`Region` (`idRegion`, `nombreRegion`, `codeRegion`, `activoRegion`, `Pais_idPais`) VALUES (15, 'Arica y Parinacota', '15', 1, 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `wineberry`.`Comuna`
-- -----------------------------------------------------
START TRANSACTION;
USE `wineberry`;
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (1, 'Las Condes', '13114', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (2, 'Puerto Montt', '10101', 1, 10);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (3, 'Chonchi', '10203', 1, 10);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (4, 'Punta Arenas', '12101', 1, 12);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (5, 'Laguna Blanca', '12102', 1, 12);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (6, 'RÃ­o Verde', '12103', 1, 12);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (7, 'San Gregorio', '12104', 1, 12);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (8, 'Cabo de Hornos', '12201', 1, 12);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (9, 'AntÃ¡rtica', '12202', 1, 12);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (10, 'Porvenir', '12301', 1, 12);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (11, 'Primavera', '12302', 1, 12);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (12, 'Timaukel', '12303', 1, 12);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (13, 'Natales', '12401', 1, 12);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (14, 'Torres del Paine', '12402', 1, 12);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (15, 'Arica', '15101', 1, 15);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (18, 'Camarones', '15102', 1, 15);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (19, 'Putre', '15201', 1, 15);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (20, 'General Lagos', '15202', 1, 15);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (21, 'Iquique', '01101', 1, 1);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (22, 'Alto Hospicio', '01102', 1, 1);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (23, 'Pozo Almonte', '01401', 1, 1);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (24, 'CamiÃ±a', '01402', 1, 1);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (25, 'Colchane', '01403', 1, 1);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (26, 'Huara', '01404', 1, 1);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (27, 'Pica', '01405', 1, 1);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (28, 'Antofagasta', '02101', 1, 2);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (29, 'Mejillones', '02102', 1, 2);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (30, 'Sierra Gorda', '02103', 1, 2);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (31, 'Taltal', '02104', 1, 2);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (32, 'Calama', '02201', 1, 2);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (33, 'OllagÃ¼e', '02202', 1, 2);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (34, 'San Pedro de Atacama', '02203', 1, 2);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (35, 'Tocopilla', '02301', 1, 2);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (36, 'MarÃ­a Elena', '02302', 1, 2);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (37, 'CopiapÃ³', '03101', 1, 3);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (38, 'Caldera', '03102', 1, 3);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (39, 'Tierra Amarilla', '03103', 1, 3);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (41, 'ChaÃ±aral', '03201', 1, 3);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (42, 'Diego de Almagro', '03202', 1, 3);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (43, 'Vallenar', '03301', 1, 3);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (44, 'Alto del Carmen', '03302', 1, 3);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (45, 'Freirina', '03303', 1, 3);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (46, 'Huasco', '03304', 1, 3);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (47, 'La Serena', '04101', 1, 4);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (48, 'Coquimbo', '04102', 1, 4);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (49, 'Andacollo', '04103', 1, 4);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (50, 'La Higuera', '04104', 1, 4);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (51, 'Paiguano', '04105', 1, 4);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (52, 'VicuÃ±a', '04106', 1, 4);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (53, 'Illapel', '04201', 1, 4);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (54, 'Canela', '04202', 1, 4);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (55, 'Los Vilos', '04203', 1, 4);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (56, 'Salamanca', '04204', 1, 4);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (57, 'Ovalle', '04301', 1, 4);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (58, 'CombarbalÃ¡', '04302', 1, 4);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (59, 'Monte Patria', '04303', 1, 4);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (60, 'Punitaqui', '04304', 1, 4);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (61, 'RÃ­o Hurtado', '04305', 1, 4);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (62, 'ValparaÃ­so', '05101', 1, 5);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (63, 'Casablanca', '05102', 1, 5);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (64, 'ConcÃ³n', '05103', 1, 5);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (65, 'Juan FernÃ¡ndez', '05104', 1, 5);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (66, 'PuchuncavÃ­', '05105', 1, 5);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (67, 'Quintero', '05107', 1, 5);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (68, 'ViÃ±a del Mar', '05109', 1, 5);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (69, 'Isla de Pascua', '05201', 1, 5);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (70, 'Los Andes', '05301', 1, 5);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (71, 'Calle Larga', '05302', 1, 5);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (72, 'Rinconada', '05303', 1, 5);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (73, 'San Esteban', '05304', 1, 5);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (74, 'La Ligua', '05401', 1, 5);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (75, 'Cabildo', '05402', 1, 5);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (76, 'Papudo', '05403', 1, 5);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (77, 'Petorca', '05404', 1, 5);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (78, 'Zapallar', '05405', 1, 5);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (79, 'Quillota', '05501', 1, 5);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (80, 'Calera', '05502', 1, 5);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (81, 'Hijuelas', '05503', 1, 5);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (82, 'La Cruz', '05504', 1, 5);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (83, 'Nogales', '05506', 1, 5);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (84, 'San Antonio', '05601', 1, 5);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (85, 'Algarrobo', '05602', 1, 5);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (86, 'Cartagena', '05603', 1, 5);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (87, 'El Quisco', '05604', 1, 5);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (88, 'El Tabo', '05605', 1, 5);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (89, 'Santo Domingo', '05606', 1, 5);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (90, 'San Felipe', '05701', 1, 5);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (91, 'Catemu', '05702', 1, 5);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (92, 'Llaillay', '05703', 1, 5);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (93, 'Panquehue', '05704', 1, 5);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (94, 'Putaendo', '05705', 1, 5);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (95, 'Santa MarÃ­a', '05706', 1, 5);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (96, 'QuilpuÃ©', '05801', 1, 5);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (97, 'Limache', '05802', 1, 5);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (98, 'OlmuÃ©', '05803', 1, 5);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (99, 'Villa Alemana', '05804', 1, 5);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (100, 'Rancagua', '06101', 1, 6);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (101, 'Codegua', '06102', 1, 6);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (102, 'Coinco', '06103', 1, 6);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (103, 'Coltauco', '06104', 1, 6);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (104, 'DoÃ±ihue', '06105', 1, 6);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (105, 'Graneros', '06106', 1, 6);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (106, 'Las Cabras', '06107', 1, 6);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (107, 'MachalÃ­', '06108', 1, 6);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (108, 'Malloa', '06109', 1, 6);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (109, 'Mostazal', '06110', 1, 6);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (110, 'Olivar', '06111', 1, 6);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (111, 'Peumo', '06112', 1, 6);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (112, 'Pichidegua', '06113', 1, 6);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (113, 'Quinta de Tilcoco', '06114', 1, 6);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (114, 'Rengo', '06115', 1, 6);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (115, 'RequÃ­noa', '06116', 1, 6);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (116, 'San Vicente', '06117', 1, 6);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (117, 'Pichilemu', '06201', 1, 6);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (118, 'La Estrella', '06202', 1, 6);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (119, 'Litueche', '06203', 1, 6);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (120, 'Marchihue', '06204', 1, 6);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (121, 'Navidad', '06205', 1, 6);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (122, 'Paredones', '06206', 1, 6);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (123, 'San Fernando', '06301', 1, 6);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (124, 'ChÃ©pica', '06302', 1, 6);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (125, 'Chimbarongo', '06303', 1, 6);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (126, 'Lolol', '06304', 1, 6);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (127, 'Nancagua', '06305', 1, 6);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (128, 'Palmilla', '06306', 1, 6);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (129, 'Peralillo', '06307', 1, 6);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (130, 'Placilla', '06308', 1, 6);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (131, 'Pumanque', '06309', 1, 6);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (132, 'Santa Cruz', '06310', 1, 6);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (133, 'Talca', '07101', 1, 7);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (134, 'ConstituciÃ³n', '07102', 1, 7);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (135, 'Curepto', '07103', 1, 7);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (136, 'Empedrado', '07104', 1, 7);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (137, 'Maule', '07105', 1, 7);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (138, 'Pelarco', '07106', 1, 7);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (139, 'Pencahue', '07107', 1, 7);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (140, 'RÃ­o Claro', '07108', 1, 7);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (141, 'San Clemente', '07109', 1, 7);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (142, 'San Rafael', '07110', 1, 7);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (143, 'Cauquenes', '07201', 1, 7);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (144, 'Chanco', '07202', 1, 7);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (145, 'Pelluhue', '07203', 1, 7);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (146, 'CuricÃ³', '07301', 1, 7);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (147, 'HualaÃ±Ã©', '07302', 1, 7);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (148, 'LicantÃ©n', '07303', 1, 7);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (149, 'Molina', '07304', 1, 7);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (150, 'Rauco', '07305', 1, 7);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (151, 'Romeral', '07306', 1, 7);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (152, 'Sagrada Familia', '07307', 1, 7);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (153, 'Teno', '07308', 1, 7);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (154, 'VichuquÃ©n', '07309', 1, 7);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (155, 'Linares', '07401', 1, 7);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (156, 'ColbÃºn', '07402', 1, 7);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (157, 'LongavÃ­', '07403', 1, 7);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (158, 'Parral', '07404', 1, 7);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (159, 'Retiro', '07405', 1, 7);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (160, 'San Javier', '07406', 1, 7);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (161, 'Villa Alegre', '07407', 1, 7);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (162, 'Yerbas Buenas', '07408', 1, 7);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (163, 'ConcepciÃ³n', '08101', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (164, 'Coronel', '08102', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (165, 'Chiguayante', '08103', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (166, 'Florida', '08104', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (167, 'Hualqui', '08105', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (168, 'Lota', '08106', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (169, 'Penco', '08107', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (170, 'San Pedro de la Paz', '08108', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (171, 'Santa Juana', '08109', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (172, 'Talcahuano', '08110', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (173, 'TomÃ©', '08111', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (174, 'HualpÃ©n', '08112', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (175, 'Lebu', '08201', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (176, 'Arauco', '08202', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (177, 'CaÃ±ete', '08203', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (178, 'Contulmo', '08204', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (179, 'Curanilahue', '08205', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (180, 'Los Ãlamos', '08206', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (181, 'TirÃºa', '08207', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (182, 'Los Ãngeles', '08301', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (183, 'Antuco', '08302', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (184, 'Cabrero', '08303', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (185, 'Laja', '08304', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (186, 'MulchÃ©n', '08305', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (187, 'Nacimiento', '08306', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (188, 'Negrete', '08307', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (189, 'Quilaco', '08309', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (190, 'Quilleco', '08309', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (191, 'San Rosendo', '08310', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (192, 'Santa BÃ¡rbara', '08311', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (193, 'Tucapel', '08312', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (194, 'Yumbel', '08313', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (195, 'Alto BiobÃ­o', '08314', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (196, 'ChillÃ¡n', '08401', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (197, 'Bulnes', '08402', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (198, 'Cobquecura', '08403', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (199, 'Coelemu', '08404', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (200, 'Coihueco', '08405', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (201, 'ChillÃ¡n Viejo', '08406', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (202, 'El Carmen', '08407', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (203, 'Ninhue', '08408', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (204, 'Ã‘iquÃ©n', '08409', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (205, 'Pemuco', '08410', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (206, 'Pinto', '08411', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (207, 'Portezuelo', '08412', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (208, 'QuillÃ³n', '08413', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (209, 'Quirihue', '08414', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (210, 'RÃ¡nquil', '08415', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (211, 'San Carlos', '08416', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (212, 'San FabiÃ¡n', '08417', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (213, 'San Ignacio', '08418', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (214, 'San NicolÃ¡s', '08419', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (215, 'Treguaco', '08420', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (216, 'Yungay', '08421', 1, 8);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (217, 'Temuco', '09101', 1, 9);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (218, 'Carahue', '09102', 1, 9);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (219, 'Cunco', '09103', 1, 9);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (220, 'Curarrehue', '09104', 1, 9);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (221, 'Freire', '09105', 1, 9);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (222, 'Galvarino', '09106', 1, 9);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (223, 'Gorbea', '09107', 1, 9);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (224, 'Lautaro', '09108', 1, 9);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (225, 'Loncoche', '09109', 1, 9);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (226, 'Melipeuco', '09110', 1, 9);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (227, 'Nueva Imperial', '09111', 1, 9);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (228, 'Padre las Casas', '09112', 1, 9);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (229, 'Perquenco', '09113', 1, 9);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (230, 'PitrufquÃ©n', '09114', 1, 9);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (231, 'PucÃ³n', '09115', 1, 9);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (232, 'Saavedra', '09116', 1, 9);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (233, 'Teodoro Schmidt', '09117', 1, 9);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (234, 'ToltÃ©n', '09118', 1, 9);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (235, 'VilcÃºn', '09119', 1, 9);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (236, 'Villarrica', '09120', 1, 9);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (237, 'Cholchol', '09121', 1, 9);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (238, 'Angol', '09201', 1, 9);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (239, 'Collipulli', '09202', 1, 9);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (240, 'CuracautÃ­n', '09203', 1, 9);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (241, 'Ercilla', '09204', 1, 9);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (242, 'Lonquimay', '09205', 1, 9);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (243, 'Los Sauces', '09206', 1, 9);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (244, 'Lumaco', '09207', 1, 9);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (245, 'PurÃ©n', '09208', 1, 9);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (246, 'Renaico', '09209', 1, 9);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (247, 'TraiguÃ©n', '09210', 1, 9);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (248, 'Victoria', '09211', 1, 9);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (249, 'Valdivia', '14101', 1, 14);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (250, 'Corral', '14102', 1, 14);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (251, 'Lanco', '14103', 1, 14);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (252, 'Los Lagos', '14104', 1, 14);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (253, 'MÃ¡fil', '14105', 1, 14);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (254, 'Mariquina', '14106', 1, 14);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (255, 'Paillaco', '14107', 1, 14);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (256, 'Panguipulli', '14108', 1, 14);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (257, 'La UniÃ³n', '14201', 1, 14);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (258, 'Futrono', '14202', 1, 14);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (259, 'Lago Ranco', '14203', 1, 14);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (260, 'RÃ­o Bueno', '14204', 1, 14);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (261, 'Calbuco', '10102', 1, 10);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (262, 'CochamÃ³', '10103', 1, 10);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (263, 'Fresia', '10104', 1, 10);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (264, 'Frutillar', '10105', 1, 10);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (265, 'Los Muermos', '10106', 1, 10);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (266, 'Llanquihue', '10107', 1, 10);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (267, 'MaullÃ­n', '10108', 1, 10);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (268, 'Puerto Varas', '10109', 1, 10);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (269, 'Castro', '10201', 1, 10);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (270, 'Ancud', '10202', 1, 10);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (271, 'Curaco de VÃ©lez', '10204', 1, 10);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (272, 'Dalcahue', '10205', 1, 10);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (273, 'PuqueldÃ³n', '10206', 1, 10);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (274, 'QueilÃ©n', '10207', 1, 10);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (275, 'QuellÃ³n', '10208', 1, 10);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (276, 'Quemchi', '10209', 1, 10);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (277, 'Quinchao', '10210', 1, 10);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (278, 'Osorno', '10301', 1, 10);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (279, 'Puerto Octay', '10302', 1, 10);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (280, 'Purranque', '10303', 1, 10);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (281, 'Puyehue', '10304', 1, 10);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (282, 'RÃ­o Negro', '10305', 1, 10);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (283, 'San Juan de la Costa', '10306', 1, 10);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (284, 'San Pablo', '10307', 1, 10);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (285, 'ChaitÃ©n', '10401', 1, 10);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (286, 'FutaleufÃº', '10402', 1, 10);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (287, 'HualaihuÃ©', '10403', 1, 10);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (288, 'Palena', '10404', 1, 10);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (289, 'Coihaique', '11101', 1, 11);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (290, 'Lago Verde', '11102', 1, 11);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (291, 'AisÃ©n', '11201', 1, 11);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (292, 'Cisnes', '11202', 1, 11);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (293, 'Guaitecas', '11203', 1, 11);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (294, 'Cochrane', '11301', 1, 11);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (295, 'O\'Higgins', '11302', 1, 11);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (296, 'Tortel', '11303', 1, 11);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (297, 'Chile Chico', '11401', 1, 11);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (298, 'RÃ­o IbÃ¡Ã±ez', '11402', 1, 11);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (299, 'Santiago', '13101', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (300, 'Cerrillos', '13102', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (301, 'Cerro Navia', '13103', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (302, 'ConchalÃ­', '13104', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (303, 'El Bosque', '13105', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (304, 'EstaciÃ³n Central', '13106', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (305, 'Huechuraba', '13107', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (306, 'Independencia', '13108', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (307, 'La Cisterna', '13109', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (308, 'La Florida', '13110', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (309, 'La Granja', '13111', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (310, 'La Pintana', '13112', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (311, 'La Reina', '13113', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (312, 'Lo Barnechea', '13115', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (313, 'Lo Espejo', '13116', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (314, 'Lo Prado', '13117', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (315, 'Macul', '13118', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (316, 'MaipÃº', '13119', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (317, 'Ã‘uÃ±oa', '13120', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (318, 'Pedro Aguirre Cerda', '13121', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (319, 'PeÃ±alolÃ©n', '13122', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (320, 'Providencia', '13123', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (321, 'Pudahuel', '13124', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (322, 'Quilicura', '13125', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (323, 'Quinta Normal', '13126', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (324, 'Recoleta', '13127', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (325, 'Renca', '13128', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (326, 'San JoaquÃ­n', '13129', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (327, 'San Miguel', '13130', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (328, 'San RamÃ³n', '13131', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (329, 'Vitacura', '13132', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (330, 'Puente Alto', '13201', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (331, 'Pirque', '13202', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (332, 'San JosÃ© de Maipo', '13203', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (333, 'Colina', '13301', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (334, 'Lampa', '13302', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (335, 'Tiltil', '13303', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (336, 'San Bernardo', '13401', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (337, 'Buin', '13402', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (338, 'Calera de Tango', '13403', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (339, 'Paine', '13404', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (340, 'Melipilla', '13501', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (341, 'AlhuÃ©', '13502', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (342, 'CuracavÃ­', '13503', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (343, 'MarÃ­a Pinto', '13504', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (344, 'San Pedro', '13505', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (345, 'Talagante', '13601', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (346, 'El Monte', '13602', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (347, 'Isla de Maipo', '13603', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (348, 'Padre Hurtado', '13604', 1, 13);
INSERT INTO `wineberry`.`Comuna` (`idComuna`, `nombreComuna`, `codeComuna`, `activoComuna`, `Region_idRegion`) VALUES (349, 'PeÃ±aflor', '13605', 1, 13);

COMMIT;


-- -----------------------------------------------------
-- Data for table `wineberry`.`Pagina`
-- -----------------------------------------------------
START TRANSACTION;
USE `wineberry`;
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (1, 'index.php', 'index.php', 'Inicio (MenÃº Superior)', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (2, 'informes.php', 'informes.php', 'Informes (MenÃº Superior)', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (3, 'admin.php', 'admin.php', 'AdministraciÃ³n (MenÃº Superior)', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (4, 'login.php', 'login.php', 'Login (MenÃº Superior)', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (5, '#usr_mod', 'pages_admin/usr_mod.php', 'Lista de Usuarios', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (6, '#roles_mod', 'pages_admin/roles_mod.php', 'Lista de Roles', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (7, '#roles_perm_mod', 'pages_admin/roles_perm_mod.php', 'Permisos por rol', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (8, '#cto_tipo_mod', 'pages_admin/cto_tipo_mod.php', 'Lista de Tipos de contacto', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (9, '#mat_mod', 'pages_admin/mat_mod.php', 'Lista de Materias', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (10, '#mat_tipo_mod', 'pages_admin/mat_tipo_mod.php', 'Lista de Tipos de materia', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (11, '#mat_tar_mod', 'pages_admin/mat_tar_mod.php', 'Lista de Tarifas por materia', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (12, '#fact_estdo_mod', 'pages_admin/fact_estdo_mod.php', 'Lista de Estados de factura', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (13, '#mon_mod', 'pages_admin/mon_mod.php', 'Lista de Tipos de moneda', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (14, '#tipo_abono_mod', 'pages_admin/tipo_abono_mod.php', 'Lista de Tipos de abono', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (15, '#tipo_gasto_mod', 'pages_admin/tipo_gasto_mod.php', 'Lista de Tipos de gasto', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (16, '#feriados_mod', 'pages_admin/feriados_mod.php', 'Lista de Feriados legales', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (17, '#pais_mod', 'pages_admin/pais_mod.php', 'Lista de PaÃ­ses', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (18, '#region_mod', 'pages_admin/region_mod.php', 'Lista de Regiones', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (19, '#comuna_mod', 'pages_admin/comuna_mod.php', 'Lista de Comunas', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (20, '#label_mod', 'pages_admin/label_mod.php', 'Lista de Labels', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (21, '#menu_mod', 'pages_admin/menu_mod.php', 'Lista de Items de menÃº', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (22, '#paginas_mod', 'pages_admin/paginas_mod.php', 'Lista de PÃ¡ginas del sistema', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (23, '#param_mod', 'pages_admin/param_mod.php', 'Lista de ParÃ¡metros globales', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (24, '#version', 'pages_admin/version.php', 'VersiÃ³n del sistema', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (25, '#licencia', 'pages_admin/licencia.php', 'Licencia (EULA)', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (26, 'act_desact.php', 'pages_admin/act_desact.php', 'Activar o desactivar registro de una grilla', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (27, 'comuna_crear.php', 'pages_admin/comuna_crear.php', 'CreaciÃ³n de Comuna', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (28, 'comuna_editar.php', 'pages_admin/comuna_editar.php', 'EdiciÃ³n de Comuna', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (29, 'cto_tipo_crear.php', 'pages_admin/cto_tipo_crear.php', 'CreaciÃ³n de Tipo contacto', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (30, 'cto_tipo_editar.php', 'pages_admin/cto_tipo_editar.php', 'EdiciÃ³n de Tipo contacto', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (31, 'fact_estdo_crear.php', 'pages_admin/fact_estdo_crear.php', 'CreaciÃ³n de Estados factura', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (32, 'fact_estdo_editar.php', 'pages_admin/fact_estdo_editar.php', 'EdiciÃ³n de Estados factura', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (33, 'feriados_crear.php', 'pages_admin/feriados_crear.php', 'CreaciÃ³n de Feriado legal', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (34, 'feriados_editar.php', 'pages_admin/feriados_editar.php', 'EdiciÃ³n de Feriado legal', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (35, 'label_crear.php', 'pages_admin/label_crear.php', 'CreaciÃ³n de Label', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (36, 'label_editar.php', 'pages_admin/label_editar.php', 'EdiciÃ³n de Label', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (37, 'mat_crear.php', 'pages_admin/mat_crear.php', 'CreaciÃ³n de Materia', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (38, 'mat_editar.php', 'pages_admin/mat_editar.php', 'EdiciÃ³n de Materia', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (39, 'mat_tar_crear.php', 'pages_admin/mat_tar_crear.php', 'CreaciÃ³n de Tarifa por materia', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (40, 'mat_tar_editar.php', 'pages_admin/mat_tar_editar.php', 'EdiciÃ³n de Tarifa por materia', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (41, 'mat_tipo_crear.php', 'pages_admin/mat_tipo_crear.php', 'CreaciÃ³n de Tipo de materia', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (42, 'mat_tipo_editar.php', 'pages_admin/mat_tipo_editar.php', 'EdiciÃ³n de Tipo de materia', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (43, 'menu_crear.php', 'pages_admin/menu_crear.php', 'CreaciÃ³n Item de menÃº', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (44, 'menu_editar.php', 'pages_admin/menu_editar.php', 'EdiciÃ³n Item de menÃº', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (45, 'mon_crear.php', 'pages_admin/mon_crear.php', 'CreaciÃ³n de Tipo de moneda', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (46, 'mon_editar.php', 'pages_admin/mon_editar.php', 'EdiciÃ³n de Tipo de moneda', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (47, 'paginas_crear.php', 'pages_admin/paginas_crear.php', 'CreaciÃ³n de PÃ¡gina del sistema', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (48, 'paginas_editar.php', 'pages_admin/paginas_editar.php', 'EdiciÃ³n de PÃ¡gina del sistema', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (49, 'pais_crear.php', 'pages_admin/pais_crear.php', 'CreaciÃ³n de PaÃ­s', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (50, 'pais_editar.php', 'pages_admin/pais_editar.php', 'EdiciÃ³n de PaÃ­s', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (51, 'param_crear.php', 'pages_admin/param_crear.php', 'CreaciÃ³n de ParÃ¡metro global', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (52, 'param_editar.php', 'pages_admin/param_editar.php', 'EdiciÃ³n de ParÃ¡metro Global', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (53, 'region_crear.php', 'pages_admin/region_crear.php', 'CreaciÃ³n de RegiÃ³n', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (54, 'region_editar.php', 'pages_admin/region_editar.php', 'EdiciÃ³n de RegiÃ³n', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (55, 'roles_crear.php', 'pages_admin/roles_crear.php', 'CreaciÃ³n de Rol', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (56, 'roles_editar.php', 'pages_admin/roles_editar.php', 'EdiciÃ³n de Rol', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (57, 'tipo_abono_crear.php', 'pages_admin/tipo_abono_crear.php', 'CreaciÃ³n de Tipo de abono', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (58, 'tipo_abono_editar.php', 'pages_admin/tipo_abono_editar.php', 'EdiciÃ³n de Tipo de abono', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (59, 'tipo_gasto_crear.php', 'pages_admin/tipo_gasto_crear.php', 'CreaciÃ³n de Tipo de gasto', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (60, 'tipo_gasto_editar.php', 'pages_admin/tipo_gasto_editar.php', 'EdiciÃ³n de Tipo de gasto', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (61, 'usr_clave_mod.php', 'pages_admin/usr_clave_mod.php', 'ModificaciÃ³n de clave', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (62, 'usr_crear.php', 'pages_admin/usr_crear.php', 'CreaciÃ³n de Usuario', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (63, 'usr_editar.php', 'pages_admin/usr_editar.php', 'EdiciÃ³n de Usuario', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (64, 'usr_mi_perfil.php', 'pages_admin/usr_mi_perfil.php', 'EdiciÃ³n de Perfil del usuario', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (65, 'usr_tar_mod.php', 'pages_admin/usr_tar_mod.php', 'EdiciÃ³n de Tarifa del usuario', 1);
INSERT INTO `wineberry`.`Pagina` (`idPagina`, `urlPagina`, `nombrePagina`, `descripcionPagina`, `activoPagina`) VALUES (66,'#paginas_paginas_mod','pages_admin/paginas_paginas_mod.php','Relaciones entre pÃ¡ginas del sistema',1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `wineberry`.`Menu`
-- -----------------------------------------------------
START TRANSACTION;
USE `wineberry`;
INSERT INTO `wineberry`.`Menu` (`idMenu`, `nombreMenu`, `nivelMenu`, `activoMenu`, `posicionMenu`, `spanclassMenu`, `Pagina_idPagina`, `Menu_idMenu`) VALUES (1, 'Inicio', 0, 1, 1, 'glyphicon glyphicon-home', 1, NULL);
INSERT INTO `wineberry`.`Menu` (`idMenu`, `nombreMenu`, `nivelMenu`, `activoMenu`, `posicionMenu`, `spanclassMenu`, `Pagina_idPagina`, `Menu_idMenu`) VALUES (2, 'Informes', 0, 1, 2, 'glyphicon glyphicon-file', 2, NULL);
INSERT INTO `wineberry`.`Menu` (`idMenu`, `nombreMenu`, `nivelMenu`, `activoMenu`, `posicionMenu`, `spanclassMenu`, `Pagina_idPagina`, `Menu_idMenu`) VALUES (3, 'AdministraciÃ³n', 0, 1, 3, 'glyphicon glyphicon-wrench', 3, NULL);
INSERT INTO `wineberry`.`Menu` (`idMenu`, `nombreMenu`, `nivelMenu`, `activoMenu`, `posicionMenu`, `spanclassMenu`, `Pagina_idPagina`, `Menu_idMenu`) VALUES (4, 'Salir', 0, 1, 4, 'glyphicon glyphicon-off', 4, NULL);
INSERT INTO `wineberry`.`Menu` (`idMenu`, `nombreMenu`, `nivelMenu`, `activoMenu`, `posicionMenu`, `spanclassMenu`, `Pagina_idPagina`, `Menu_idMenu`) VALUES (5,'Mantenedores',1,1,1,'',NULL,3);
INSERT INTO `wineberry`.`Menu` (`idMenu`, `nombreMenu`, `nivelMenu`, `activoMenu`, `posicionMenu`, `spanclassMenu`, `Pagina_idPagina`, `Menu_idMenu`) VALUES (6,'Usuarios',1,1,2,'glyphicon glyphicon-chevron-right',5,3);
INSERT INTO `wineberry`.`Menu` (`idMenu`, `nombreMenu`, `nivelMenu`, `activoMenu`, `posicionMenu`, `spanclassMenu`, `Pagina_idPagina`, `Menu_idMenu`) VALUES (7,'Roles',1,1,3,'glyphicon glyphicon-chevron-right',6,3);
INSERT INTO `wineberry`.`Menu` (`idMenu`, `nombreMenu`, `nivelMenu`, `activoMenu`, `posicionMenu`, `spanclassMenu`, `Pagina_idPagina`, `Menu_idMenu`) VALUES (8,'Permisos por rol',1,1,4,'glyphicon glyphicon-chevron-right',7,3);
INSERT INTO `wineberry`.`Menu` (`idMenu`, `nombreMenu`, `nivelMenu`, `activoMenu`, `posicionMenu`, `spanclassMenu`, `Pagina_idPagina`, `Menu_idMenu`) VALUES (9,'Tipos de contacto',1,1,5,'glyphicon glyphicon-chevron-right',8,3);
INSERT INTO `wineberry`.`Menu` (`idMenu`, `nombreMenu`, `nivelMenu`, `activoMenu`, `posicionMenu`, `spanclassMenu`, `Pagina_idPagina`, `Menu_idMenu`) VALUES (10,'Materias',1,1,6,'glyphicon glyphicon-chevron-right',9,3);
INSERT INTO `wineberry`.`Menu` (`idMenu`, `nombreMenu`, `nivelMenu`, `activoMenu`, `posicionMenu`, `spanclassMenu`, `Pagina_idPagina`, `Menu_idMenu`) VALUES (11,'Tipos de materia',1,1,7,'glyphicon glyphicon-chevron-right',10,3);
INSERT INTO `wineberry`.`Menu` (`idMenu`, `nombreMenu`, `nivelMenu`, `activoMenu`, `posicionMenu`, `spanclassMenu`, `Pagina_idPagina`, `Menu_idMenu`) VALUES (12,'Tarifas por materia',1,1,8,'glyphicon glyphicon-chevron-right',11,3);
INSERT INTO `wineberry`.`Menu` (`idMenu`, `nombreMenu`, `nivelMenu`, `activoMenu`, `posicionMenu`, `spanclassMenu`, `Pagina_idPagina`, `Menu_idMenu`) VALUES (13,'Estados de factura',1,1,9,'glyphicon glyphicon-chevron-right',12,3);
INSERT INTO `wineberry`.`Menu` (`idMenu`, `nombreMenu`, `nivelMenu`, `activoMenu`, `posicionMenu`, `spanclassMenu`, `Pagina_idPagina`, `Menu_idMenu`) VALUES (14,'Tipos de moneda',1,1,10,'glyphicon glyphicon-chevron-right',13,3);
INSERT INTO `wineberry`.`Menu` (`idMenu`, `nombreMenu`, `nivelMenu`, `activoMenu`, `posicionMenu`, `spanclassMenu`, `Pagina_idPagina`, `Menu_idMenu`) VALUES (15,'Tipos de abono',1,1,11,'glyphicon glyphicon-chevron-right',14,3);
INSERT INTO `wineberry`.`Menu` (`idMenu`, `nombreMenu`, `nivelMenu`, `activoMenu`, `posicionMenu`, `spanclassMenu`, `Pagina_idPagina`, `Menu_idMenu`) VALUES (16,'Tipo de gasto',1,1,12,'glyphicon glyphicon-chevron-right',15,3);
INSERT INTO `wineberry`.`Menu` (`idMenu`, `nombreMenu`, `nivelMenu`, `activoMenu`, `posicionMenu`, `spanclassMenu`, `Pagina_idPagina`, `Menu_idMenu`) VALUES (17,'Feriados legales',1,1,13,'glyphicon glyphicon-chevron-right',16,3);
INSERT INTO `wineberry`.`Menu` (`idMenu`, `nombreMenu`, `nivelMenu`, `activoMenu`, `posicionMenu`, `spanclassMenu`, `Pagina_idPagina`, `Menu_idMenu`) VALUES (18,'ParÃ¡metros',1,1,14,'',NULL,3);
INSERT INTO `wineberry`.`Menu` (`idMenu`, `nombreMenu`, `nivelMenu`, `activoMenu`, `posicionMenu`, `spanclassMenu`, `Pagina_idPagina`, `Menu_idMenu`) VALUES (19,'PaÃ­ses',1,1,15,'glyphicon glyphicon-chevron-right',17,3);
INSERT INTO `wineberry`.`Menu` (`idMenu`, `nombreMenu`, `nivelMenu`, `activoMenu`, `posicionMenu`, `spanclassMenu`, `Pagina_idPagina`, `Menu_idMenu`) VALUES (20,'Regiones',1,1,16,'glyphicon glyphicon-chevron-right',18,3);
INSERT INTO `wineberry`.`Menu` (`idMenu`, `nombreMenu`, `nivelMenu`, `activoMenu`, `posicionMenu`, `spanclassMenu`, `Pagina_idPagina`, `Menu_idMenu`) VALUES (21,'Comunas',1,1,17,'glyphicon glyphicon-chevron-right',19,3);
INSERT INTO `wineberry`.`Menu` (`idMenu`, `nombreMenu`, `nivelMenu`, `activoMenu`, `posicionMenu`, `spanclassMenu`, `Pagina_idPagina`, `Menu_idMenu`) VALUES (22,'Labels',1,1,18,'glyphicon glyphicon-chevron-right',20,3);
INSERT INTO `wineberry`.`Menu` (`idMenu`, `nombreMenu`, `nivelMenu`, `activoMenu`, `posicionMenu`, `spanclassMenu`, `Pagina_idPagina`, `Menu_idMenu`) VALUES (23,'MenÃº',1,1,19,'glyphicon glyphicon-chevron-right',21,3);
INSERT INTO `wineberry`.`Menu` (`idMenu`, `nombreMenu`, `nivelMenu`, `activoMenu`, `posicionMenu`, `spanclassMenu`, `Pagina_idPagina`, `Menu_idMenu`) VALUES (24,'PÃ¡ginas',1,1,20,'glyphicon glyphicon-chevron-right',22,3);
INSERT INTO `wineberry`.`Menu` (`idMenu`, `nombreMenu`, `nivelMenu`, `activoMenu`, `posicionMenu`, `spanclassMenu`, `Pagina_idPagina`, `Menu_idMenu`) VALUES (25,'ParÃ¡metros Globales',1,1,21,'glyphicon glyphicon-chevron-right',23,3);
INSERT INTO `wineberry`.`Menu` (`idMenu`, `nombreMenu`, `nivelMenu`, `activoMenu`, `posicionMenu`, `spanclassMenu`, `Pagina_idPagina`, `Menu_idMenu`) VALUES (26,'InformaciÃ³n del Sistema',1,1,23,'glyphicon glyphicon-chevron-right',NULL,3);
INSERT INTO `wineberry`.`Menu` (`idMenu`, `nombreMenu`, `nivelMenu`, `activoMenu`, `posicionMenu`, `spanclassMenu`, `Pagina_idPagina`, `Menu_idMenu`) VALUES (27,'VersiÃ³n',1,1,24,'glyphicon glyphicon-chevron-right',24,3);
INSERT INTO `wineberry`.`Menu` (`idMenu`, `nombreMenu`, `nivelMenu`, `activoMenu`, `posicionMenu`, `spanclassMenu`, `Pagina_idPagina`, `Menu_idMenu`) VALUES (28,'Licencia',1,1,25,'glyphicon glyphicon-chevron-right',25,3);
INSERT INTO `wineberry`.`Menu` (`idMenu`, `nombreMenu`, `nivelMenu`, `activoMenu`, `posicionMenu`, `spanclassMenu`, `Pagina_idPagina`, `Menu_idMenu`) VALUES (29,'Mapa de pÃ¡ginas',1,1,22,'glyphicon glyphicon-chevron-right',66,3);

COMMIT;

USE `wineberry`;

DELIMITER $$

USE `wineberry`$$
DROP TRIGGER IF EXISTS `wineberry`.`Usuario_BINS` $$
USE `wineberry`$$


CREATE TRIGGER `Usuario_BINS` BEFORE INSERT ON `Usuario` FOR EACH ROW
-- Edit trigger body code below this line. Do not edit lines above this one
SET NEW.claveUsuario = SHA1(NEW.claveUsuario);$$


DELIMITER ;
