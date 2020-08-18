-- MySQL Script generated by MySQL Workbench
-- Tue Aug 18 11:04:14 2020
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema Trainingskalender
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `Trainingskalender` ;

-- -----------------------------------------------------
-- Schema Trainingskalender
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `Trainingskalender` DEFAULT CHARACTER SET utf8 ;
USE `Trainingskalender` ;

-- -----------------------------------------------------
-- Table `Trainingskalender`.`Member`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Trainingskalender`.`Member` (
  `memberId` INT NOT NULL AUTO_INCREMENT,
  `firstName` VARCHAR(45) NOT NULL,
  `lastName` VARCHAR(45) NOT NULL,
  `gender` ENUM('M', 'W') NOT NULL,
  `phonenumber` VARCHAR(45) NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`memberId`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Trainingskalender`.`TrainingEntry`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Trainingskalender`.`TrainingEntry` (
  `trainingEntryId` INT NOT NULL AUTO_INCREMENT,
  `trainingDate` DATE NOT NULL,
  `startTime` DATETIME NOT NULL,
  `created` TIMESTAMP(2) NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` TIMESTAMP(2) NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`trainingEntryId`),
  CONSTRAINT `Member`
    FOREIGN KEY (`trainingEntryId`)
    REFERENCES `Trainingskalender`.`Member` (`memberId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Trainingskalender`.`Area`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Trainingskalender`.`Area` (
  `areaId` INT NOT NULL AUTO_INCREMENT,
  `labelling` VARCHAR(45) NOT NULL,
  `maxNumberOfPeople` INT NOT NULL,
  PRIMARY KEY (`areaId`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Trainingskalender`.`Timeslot`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Trainingskalender`.`Timeslot` (
  `TimeslotId` INT NOT NULL AUTO_INCREMENT,
  `startTime` DATETIME NOT NULL,
  `endTime` DATETIME NOT NULL,
  PRIMARY KEY (`TimeslotId`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Trainingskalender`.`AreaTrainingEntry`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Trainingskalender`.`AreaTrainingEntry` (
  `AreaTrainingEntryId` INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`AreaTrainingEntryId`),
  CONSTRAINT `AreaId`
    FOREIGN KEY (`AreaTrainingEntryId`)
    REFERENCES `Trainingskalender`.`Area` (`areaId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `TrainingEntryId`
    FOREIGN KEY (`AreaTrainingEntryId`)
    REFERENCES `Trainingskalender`.`TrainingEntry` (`trainingEntryId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `Timeslot`
    FOREIGN KEY (`AreaTrainingEntryId`)
    REFERENCES `Trainingskalender`.`Timeslot` (`TimeslotId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
