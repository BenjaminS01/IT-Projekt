-- MySQL Script generated by MySQL Workbench
-- Tue Sep 15 00:42:45 2020
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema heroku_baf632cb15a3418
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `heroku_baf632cb15a3418` ;

-- -----------------------------------------------------
-- Schema heroku_baf632cb15a3418
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `heroku_baf632cb15a3418` DEFAULT CHARACTER SET utf8 ;
USE `heroku_baf632cb15a3418` ;

-- -----------------------------------------------------
-- Table `heroku_baf632cb15a3418`.`Member`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `heroku_baf632cb15a3418`.`Member` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `firstName` VARCHAR(50) NOT NULL,
  `lastName` VARCHAR(50) NOT NULL,
  `gender` ENUM('Damen', 'Herren') NOT NULL,
  `phoneNumber` VARCHAR(20) NULL,
  `email` VARCHAR(50) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `email_UNIQUE` ON `heroku_baf632cb15a3418`.`Member` (`email` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `heroku_baf632cb15a3418`.`TrainingEntry`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `heroku_baf632cb15a3418`.`TrainingEntry` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `trainingDate` DATE NOT NULL,
  `typeOfTraining` ENUM('Kurs', 'Einzeltraining') NOT NULL,
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
    REFERENCES `heroku_baf632cb15a3418`.`Member` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `memberId_idx` ON `heroku_baf632cb15a3418`.`TrainingEntry` (`memberId` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `heroku_baf632cb15a3418`.`Area`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `heroku_baf632cb15a3418`.`Area` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `labelling` VARCHAR(80) NOT NULL,
  `maxNumberOfPeople` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `heroku_baf632cb15a3418`.`Timeslot`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `heroku_baf632cb15a3418`.`Timeslot` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `startTime` TIME NOT NULL,
  `endTime` TIME NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `heroku_baf632cb15a3418`.`Course`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `heroku_baf632cb15a3418`.`Course` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `labelling` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `heroku_baf632cb15a3418`.`AreaTimeslot`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `heroku_baf632cb15a3418`.`AreaTimeslot` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `areaId` INT NOT NULL,
  `timeslotId` INT NOT NULL,
  `weekday` VARCHAR(45) NULL,
  `courseId` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `areaId`
    FOREIGN KEY (`areaId`)
    REFERENCES `heroku_baf632cb15a3418`.`Area` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `timeslotId`
    FOREIGN KEY (`timeslotId`)
    REFERENCES `heroku_baf632cb15a3418`.`Timeslot` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `courseId`
    FOREIGN KEY (`courseId`)
    REFERENCES `heroku_baf632cb15a3418`.`Course` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `areaId_idx` ON `heroku_baf632cb15a3418`.`AreaTimeslot` (`areaId` ASC) VISIBLE;

CREATE INDEX `timeslotId_idx` ON `heroku_baf632cb15a3418`.`AreaTimeslot` (`timeslotId` ASC) VISIBLE;

CREATE INDEX `courseId_idx` ON `heroku_baf632cb15a3418`.`AreaTimeslot` (`courseId` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `heroku_baf632cb15a3418`.`TrainingTimeslot`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `heroku_baf632cb15a3418`.`TrainingTimeslot` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `areaTimeslotId` INT NOT NULL,
  `trainingEntryId` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `areaTimeslotId`
    FOREIGN KEY (`areaTimeslotId`)
    REFERENCES `heroku_baf632cb15a3418`.`AreaTimeslot` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `trainingEntryId`
    FOREIGN KEY (`trainingEntryId`)
    REFERENCES `heroku_baf632cb15a3418`.`TrainingEntry` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `areaTimeslotId_idx` ON `heroku_baf632cb15a3418`.`TrainingTimeslot` (`areaTimeslotId` ASC) VISIBLE;

CREATE INDEX `trainingEntryId_idx` ON `heroku_baf632cb15a3418`.`TrainingTimeslot` (`trainingEntryId` ASC) VISIBLE;

USE `heroku_baf632cb15a3418` ;

-- -----------------------------------------------------
-- Placeholder table for view `heroku_baf632cb15a3418`.`viewAreaTimeslot`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `heroku_baf632cb15a3418`.`viewAreaTimeslot` (`id` INT, `labelling` INT, `startTime` INT, `endTime` INT, `weekday` INT, `course` INT);

-- -----------------------------------------------------
-- View `heroku_baf632cb15a3418`.`viewAreaTimeslot`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `heroku_baf632cb15a3418`.`viewAreaTimeslot`;
USE `heroku_baf632cb15a3418`;
CREATE  OR REPLACE VIEW `viewAreaTimeslot` AS
select ati.id, a.labelling, t.startTime, t.endTime, ati.weekday, c.labelling as course from timeslot t 
join AreaTimeslot ati on t.id = ati.timeslotId
join Area a on a.id = ati.areaId
join course c on c.id = ati.courseId;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
