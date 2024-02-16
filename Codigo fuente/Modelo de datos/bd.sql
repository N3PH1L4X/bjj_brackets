-- MySQL Script generated by MySQL Workbench
-- Fri Feb 16 15:33:34 2024
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema bjj_brackets
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema bjj_brackets
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `bjj_brackets` DEFAULT CHARACTER SET utf8 ;
USE `bjj_brackets` ;

-- -----------------------------------------------------
-- Table `bjj_brackets`.`deporte`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bjj_brackets`.`deporte` ;

CREATE TABLE IF NOT EXISTS `bjj_brackets`.`deporte` (
  `id_deporte` INT NOT NULL AUTO_INCREMENT,
  `nombre_deporte` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_deporte`),
  UNIQUE INDEX `iddeporte_UNIQUE` (`id_deporte` ASC) VISIBLE,
  UNIQUE INDEX `nombre_deporte_UNIQUE` (`nombre_deporte` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bjj_brackets`.`estado_evento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bjj_brackets`.`estado_evento` ;

CREATE TABLE IF NOT EXISTS `bjj_brackets`.`estado_evento` (
  `id_estado_evento` INT NOT NULL AUTO_INCREMENT,
  `nombre_estado_evento` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_estado_evento`),
  UNIQUE INDEX `id_estado_evento_UNIQUE` (`id_estado_evento` ASC) VISIBLE,
  UNIQUE INDEX `nombre_estado_evento_UNIQUE` (`nombre_estado_evento` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bjj_brackets`.`evento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bjj_brackets`.`evento` ;

CREATE TABLE IF NOT EXISTS `bjj_brackets`.`evento` (
  `id_evento` INT NOT NULL AUTO_INCREMENT,
  `f_inicio_evento` DATE NULL,
  `f_cierre_evento` DATE NULL,
  `deporte_id_deporte` INT NOT NULL,
  `estado_evento_id_estado_evento` INT NOT NULL,
  PRIMARY KEY (`id_evento`),
  UNIQUE INDEX `id_evento_UNIQUE` (`id_evento` ASC) VISIBLE,
  INDEX `fk_evento_deporte_idx` (`deporte_id_deporte` ASC) VISIBLE,
  INDEX `fk_evento_estado_evento1_idx` (`estado_evento_id_estado_evento` ASC) VISIBLE,
  CONSTRAINT `fk_evento_deporte`
    FOREIGN KEY (`deporte_id_deporte`)
    REFERENCES `bjj_brackets`.`deporte` (`id_deporte`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_evento_estado_evento1`
    FOREIGN KEY (`estado_evento_id_estado_evento`)
    REFERENCES `bjj_brackets`.`estado_evento` (`id_estado_evento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bjj_brackets`.`instructor`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bjj_brackets`.`instructor` ;

CREATE TABLE IF NOT EXISTS `bjj_brackets`.`instructor` (
  `id_instructor` INT NOT NULL AUTO_INCREMENT,
  `rut_instructor` VARCHAR(8) NOT NULL,
  `nombre_instructor` VARCHAR(55) NOT NULL,
  `primer_apellido_instructor` VARCHAR(45) NOT NULL,
  `segundo_apellido_instructor` VARCHAR(45) NULL,
  `correo_instructor` VARCHAR(65) NOT NULL,
  `telefono_instructor` VARCHAR(20) NULL,
  PRIMARY KEY (`id_instructor`),
  UNIQUE INDEX `id_instructor_UNIQUE` (`id_instructor` ASC) VISIBLE,
  UNIQUE INDEX `rut_instructor_UNIQUE` (`rut_instructor` ASC) VISIBLE,
  UNIQUE INDEX `correo_instructor_UNIQUE` (`correo_instructor` ASC) VISIBLE,
  UNIQUE INDEX `telefono_instructor_UNIQUE` (`telefono_instructor` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bjj_brackets`.`escuela`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bjj_brackets`.`escuela` ;

CREATE TABLE IF NOT EXISTS `bjj_brackets`.`escuela` (
  `id_escuela` INT NOT NULL AUTO_INCREMENT,
  `nombre_escuela` VARCHAR(45) NOT NULL,
  `escudo_escuela` VARCHAR(250) NULL,
  `instructor_id_instructor` INT NOT NULL,
  PRIMARY KEY (`id_escuela`),
  UNIQUE INDEX `idescuela_UNIQUE` (`id_escuela` ASC) VISIBLE,
  UNIQUE INDEX `escudo_escuela_UNIQUE` (`escudo_escuela` ASC) VISIBLE,
  INDEX `fk_escuela_instructor1_idx` (`instructor_id_instructor` ASC) VISIBLE,
  CONSTRAINT `fk_escuela_instructor1`
    FOREIGN KEY (`instructor_id_instructor`)
    REFERENCES `bjj_brackets`.`instructor` (`id_instructor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bjj_brackets`.`competidor`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bjj_brackets`.`competidor` ;

CREATE TABLE IF NOT EXISTS `bjj_brackets`.`competidor` (
  `id_competidor` INT NOT NULL AUTO_INCREMENT,
  `rut_competidor` VARCHAR(8) NOT NULL,
  `nombre_competidor` VARCHAR(55) NOT NULL,
  `primer_apellido_competidor` VARCHAR(45) NOT NULL,
  `segundo_apellido_competidor` VARCHAR(45) NULL,
  `peso_competidor` FLOAT NOT NULL,
  `edad_competidor` INT NOT NULL,
  `correo_competidor` VARCHAR(65) NOT NULL,
  `telefono_competidor` VARCHAR(20) NULL,
  `escuela_id_escuela` INT NOT NULL,
  PRIMARY KEY (`id_competidor`),
  UNIQUE INDEX `idcompetidor_UNIQUE` (`id_competidor` ASC) VISIBLE,
  UNIQUE INDEX `rut_competidor_UNIQUE` (`rut_competidor` ASC) VISIBLE,
  INDEX `fk_competidor_escuela1_idx` (`escuela_id_escuela` ASC) VISIBLE,
  UNIQUE INDEX `correo_competidor_UNIQUE` (`correo_competidor` ASC) VISIBLE,
  UNIQUE INDEX `telefono_competidor_UNIQUE` (`telefono_competidor` ASC) VISIBLE,
  CONSTRAINT `fk_competidor_escuela1`
    FOREIGN KEY (`escuela_id_escuela`)
    REFERENCES `bjj_brackets`.`escuela` (`id_escuela`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bjj_brackets`.`categoria`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bjj_brackets`.`categoria` ;

CREATE TABLE IF NOT EXISTS `bjj_brackets`.`categoria` (
  `id_categoria` INT NOT NULL AUTO_INCREMENT,
  `nombre_categoria` VARCHAR(45) NOT NULL,
  `deporte_id_deporte` INT NOT NULL,
  PRIMARY KEY (`id_categoria`),
  UNIQUE INDEX `id_categoria_UNIQUE` (`id_categoria` ASC) VISIBLE,
  INDEX `fk_categoria_deporte1_idx` (`deporte_id_deporte` ASC) VISIBLE,
  CONSTRAINT `fk_categoria_deporte1`
    FOREIGN KEY (`deporte_id_deporte`)
    REFERENCES `bjj_brackets`.`deporte` (`id_deporte`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bjj_brackets`.`estado_pago`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bjj_brackets`.`estado_pago` ;

CREATE TABLE IF NOT EXISTS `bjj_brackets`.`estado_pago` (
  `id_estado_pago` INT NOT NULL AUTO_INCREMENT,
  `nombre_estado_pago` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_estado_pago`),
  UNIQUE INDEX `id_estado_pago_UNIQUE` (`id_estado_pago` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bjj_brackets`.`inscripcion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bjj_brackets`.`inscripcion` ;

CREATE TABLE IF NOT EXISTS `bjj_brackets`.`inscripcion` (
  `id_inscripcion` INT NOT NULL AUTO_INCREMENT,
  `competidor_id_competidor` INT NOT NULL,
  `evento_id_evento` INT NOT NULL,
  `categoria_id_categoria` INT NOT NULL,
  `estado_pago_id_estado_pago` INT NOT NULL,
  PRIMARY KEY (`id_inscripcion`),
  UNIQUE INDEX `id_inscripcion_UNIQUE` (`id_inscripcion` ASC) VISIBLE,
  INDEX `fk_inscripcion_competidor1_idx` (`competidor_id_competidor` ASC) VISIBLE,
  INDEX `fk_inscripcion_evento1_idx` (`evento_id_evento` ASC) VISIBLE,
  INDEX `fk_inscripcion_categoria1_idx` (`categoria_id_categoria` ASC) VISIBLE,
  INDEX `fk_inscripcion_estado_pago1_idx` (`estado_pago_id_estado_pago` ASC) VISIBLE,
  CONSTRAINT `fk_inscripcion_competidor1`
    FOREIGN KEY (`competidor_id_competidor`)
    REFERENCES `bjj_brackets`.`competidor` (`id_competidor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_inscripcion_evento1`
    FOREIGN KEY (`evento_id_evento`)
    REFERENCES `bjj_brackets`.`evento` (`id_evento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_inscripcion_categoria1`
    FOREIGN KEY (`categoria_id_categoria`)
    REFERENCES `bjj_brackets`.`categoria` (`id_categoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_inscripcion_estado_pago1`
    FOREIGN KEY (`estado_pago_id_estado_pago`)
    REFERENCES `bjj_brackets`.`estado_pago` (`id_estado_pago`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `bjj_brackets`.`deporte`
-- -----------------------------------------------------
START TRANSACTION;
USE `bjj_brackets`;
INSERT INTO `bjj_brackets`.`deporte` (`id_deporte`, `nombre_deporte`) VALUES (1, 'Brazilian Jiu Jitsu');
INSERT INTO `bjj_brackets`.`deporte` (`id_deporte`, `nombre_deporte`) VALUES (2, 'Taekwondo');

COMMIT;


-- -----------------------------------------------------
-- Data for table `bjj_brackets`.`estado_evento`
-- -----------------------------------------------------
START TRANSACTION;
USE `bjj_brackets`;
INSERT INTO `bjj_brackets`.`estado_evento` (`id_estado_evento`, `nombre_estado_evento`) VALUES (1, 'Agendado');
INSERT INTO `bjj_brackets`.`estado_evento` (`id_estado_evento`, `nombre_estado_evento`) VALUES (2, 'En progreso');
INSERT INTO `bjj_brackets`.`estado_evento` (`id_estado_evento`, `nombre_estado_evento`) VALUES (3, 'Finalizado');

COMMIT;


-- -----------------------------------------------------
-- Data for table `bjj_brackets`.`instructor`
-- -----------------------------------------------------
START TRANSACTION;
USE `bjj_brackets`;
INSERT INTO `bjj_brackets`.`instructor` (`id_instructor`, `rut_instructor`, `nombre_instructor`, `primer_apellido_instructor`, `segundo_apellido_instructor`, `correo_instructor`, `telefono_instructor`) VALUES (1, '12345678', 'Cristian', 'Gonzalez', NULL, 'cristiang@correo.com', '00000001');
INSERT INTO `bjj_brackets`.`instructor` (`id_instructor`, `rut_instructor`, `nombre_instructor`, `primer_apellido_instructor`, `segundo_apellido_instructor`, `correo_instructor`, `telefono_instructor`) VALUES (2, '12345679', 'Eduardo', 'Eduardo', NULL, 'eduardoe@correo.com', '00000002');
INSERT INTO `bjj_brackets`.`instructor` (`id_instructor`, `rut_instructor`, `nombre_instructor`, `primer_apellido_instructor`, `segundo_apellido_instructor`, `correo_instructor`, `telefono_instructor`) VALUES (3, '12345670', 'Mauricio', 'Loyola', 'Vilches', 'mauriciol@correo.com', '00000003');

COMMIT;


-- -----------------------------------------------------
-- Data for table `bjj_brackets`.`escuela`
-- -----------------------------------------------------
START TRANSACTION;
USE `bjj_brackets`;
INSERT INTO `bjj_brackets`.`escuela` (`id_escuela`, `nombre_escuela`, `escudo_escuela`, `instructor_id_instructor`) VALUES (1, 'BJJF Chile', 'urlImagenEscudoEscuela1', 1);
INSERT INTO `bjj_brackets`.`escuela` (`id_escuela`, `nombre_escuela`, `escudo_escuela`, `instructor_id_instructor`) VALUES (2, 'Chong Ki', 'urlImagenEscudoEscuela2', 2);

COMMIT;


-- -----------------------------------------------------
-- Data for table `bjj_brackets`.`competidor`
-- -----------------------------------------------------
START TRANSACTION;
USE `bjj_brackets`;
INSERT INTO `bjj_brackets`.`competidor` (`id_competidor`, `rut_competidor`, `nombre_competidor`, `primer_apellido_competidor`, `segundo_apellido_competidor`, `peso_competidor`, `edad_competidor`, `correo_competidor`, `telefono_competidor`, `escuela_id_escuela`) VALUES (1, '26762822', 'Jose Andres', 'Lopez', 'Serrano', 93, 23, 'joseals0404@gmail.com', '+56963202779', 1);
INSERT INTO `bjj_brackets`.`competidor` (`id_competidor`, `rut_competidor`, `nombre_competidor`, `primer_apellido_competidor`, `segundo_apellido_competidor`, `peso_competidor`, `edad_competidor`, `correo_competidor`, `telefono_competidor`, `escuela_id_escuela`) VALUES (2, '11223344', 'Nombre1', 'Apellido1', 'SApellido1', 80, 23, 'correo@correo.com', '+56999999474', 2);
INSERT INTO `bjj_brackets`.`competidor` (`id_competidor`, `rut_competidor`, `nombre_competidor`, `primer_apellido_competidor`, `segundo_apellido_competidor`, `peso_competidor`, `edad_competidor`, `correo_competidor`, `telefono_competidor`, `escuela_id_escuela`) VALUES (3, '22334455', 'Nombre2', 'Apellido2', 'SApellido2', 71, 20, 'correo2@correo.com', '+56994477414', 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `bjj_brackets`.`categoria`
-- -----------------------------------------------------
START TRANSACTION;
USE `bjj_brackets`;
INSERT INTO `bjj_brackets`.`categoria` (`id_categoria`, `nombre_categoria`, `deporte_id_deporte`) VALUES (1, 'Gi', 1);
INSERT INTO `bjj_brackets`.`categoria` (`id_categoria`, `nombre_categoria`, `deporte_id_deporte`) VALUES (2, 'Nogi', 1);
INSERT INTO `bjj_brackets`.`categoria` (`id_categoria`, `nombre_categoria`, `deporte_id_deporte`) VALUES (3, 'Absoluto', 1);
INSERT INTO `bjj_brackets`.`categoria` (`id_categoria`, `nombre_categoria`, `deporte_id_deporte`) VALUES (4, 'Blanco - Blanco/Amarillo', 2);
INSERT INTO `bjj_brackets`.`categoria` (`id_categoria`, `nombre_categoria`, `deporte_id_deporte`) VALUES (5, 'Amarillo - Amarillo/Verde', 2);
INSERT INTO `bjj_brackets`.`categoria` (`id_categoria`, `nombre_categoria`, `deporte_id_deporte`) VALUES (6, 'Verde - Azul', 2);
INSERT INTO `bjj_brackets`.`categoria` (`id_categoria`, `nombre_categoria`, `deporte_id_deporte`) VALUES (7, 'Azul/Rojo - Rojo/Negro', 2);
INSERT INTO `bjj_brackets`.`categoria` (`id_categoria`, `nombre_categoria`, `deporte_id_deporte`) VALUES (8, 'Negro', 2);

COMMIT;


-- -----------------------------------------------------
-- Data for table `bjj_brackets`.`estado_pago`
-- -----------------------------------------------------
START TRANSACTION;
USE `bjj_brackets`;
INSERT INTO `bjj_brackets`.`estado_pago` (`id_estado_pago`, `nombre_estado_pago`) VALUES (1, 'Pago pendiente');
INSERT INTO `bjj_brackets`.`estado_pago` (`id_estado_pago`, `nombre_estado_pago`) VALUES (2, 'Pago OK');
INSERT INTO `bjj_brackets`.`estado_pago` (`id_estado_pago`, `nombre_estado_pago`) VALUES (3, 'Pago con problemas');

COMMIT;

