-- MySQL Script generated by MySQL Workbench
-- Mon Sep 14 21:55:17 2020
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema trainingskalender
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `trainingskalender` ;

-- -----------------------------------------------------
-- Schema trainingskalender
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `trainingskalender` DEFAULT CHARACTER SET utf8 ;
USE `trainingskalender` ;

-- -----------------------------------------------------
-- Table `trainingskalender`.`Member`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `trainingskalender`.`Member` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `firstName` VARCHAR(50) NOT NULL,
  `lastName` VARCHAR(50) NOT NULL,
  `gender` ENUM('Damen', 'Herren') NOT NULL,
  `phoneNumber` VARCHAR(20) NULL,
  `email` VARCHAR(50) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;




-- -----------------------------------------------------
-- Table `trainingskalender`.`TrainingEntry`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `trainingskalender`.`TrainingEntry` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `trainingDate` DATE NOT NULL,
  `typeOfTraining` ENUM('Kurs', 'Training') NOT NULL,
  `changingRoom` VARCHAR(45) NOT NULL,
  `changingRoomBeforeStartTime` VARCHAR(45) NOT NULL,
  `changingRoomBeforeEndTime` TIME NOT NULL,
  `changingRoomAfterStartTime` TIME NOT NULL,
  `changingRoomAfterEndTime` TIME NOT NULL,
  `cardioStartTime` TIME NOT NULL,
  `cardioEndTime` VARCHAR(45) NOT NULL,
  `memberId` INT NOT NULL,
  `areaTimeslotId` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `memberId`
    FOREIGN KEY (`memberId`)
    REFERENCES `trainingskalender`.`Member` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;




-- -----------------------------------------------------
-- Table `trainingskalender`.`Area`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `trainingskalender`.`Area` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `labelling` VARCHAR(80) NOT NULL,
  `maxNumberOfPeople` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `trainingskalender`.`Timeslot`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `trainingskalender`.`Timeslot` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `startTime` TIME NOT NULL,
  `endTime` TIME NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `trainingskalender`.`Course`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `trainingskalender`.`Course` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `labelling` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `trainingskalender`.`AreaTimeslot`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `trainingskalender`.`AreaTimeslot` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `areaId` INT NOT NULL,
  `timeslotId` INT NOT NULL,
  `weekday` VARCHAR(45) NULL,
  `courseId` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `areaId`
    FOREIGN KEY (`areaId`)
    REFERENCES `trainingskalender`.`Area` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `timeslotId`
    FOREIGN KEY (`timeslotId`)
    REFERENCES `trainingskalender`.`Timeslot` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `courseId`
    FOREIGN KEY (`courseId`)
    REFERENCES `trainingskalender`.`Course` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;




-- -----------------------------------------------------
-- Table `trainingskalender`.`TrainingTimeslot`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `trainingskalender`.`TrainingTimeslot` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `areaTimeslotId` INT NOT NULL,
  `trainingEntryId` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `areaTimeslotId`
    FOREIGN KEY (`areaTimeslotId`)
    REFERENCES `trainingskalender`.`AreaTimeslot` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `trainingEntryId`
    FOREIGN KEY (`trainingEntryId`)
    REFERENCES `trainingskalender`.`TrainingEntry` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

;

USE `trainingskalender` ;

-- -----------------------------------------------------
-- Placeholder table for view `trainingskalender`.`viewAreaTimeslot`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `trainingskalender`.`viewAreaTimeslot` (`id` INT, `labelling` INT, `startTime` INT, `endTime` INT, `weekday` INT, `course` INT);

-- -----------------------------------------------------
-- View `trainingskalender`.`viewAreaTimeslot`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `trainingskalender`.`viewAreaTimeslot`;
USE `trainingskalender`;
CREATE  OR REPLACE VIEW `viewAreaTimeslot` AS
select ati.id, a.labelling, t.startTime, t.endTime, ati.weekday, c.labelling as course from timeslot t 
join AreaTimeslot ati on t.id = ati.timeslotId
join Area a on a.id = ati.areaId
join course c on c.id = ati.courseId;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;