-- -----------------------------------------------------
-- Filename: DDL command file
-- Authors: Xue Han, Yuhan Du, Xuetao Wu
-- Short description: This document to create database, tables, and constraints
-- -----------------------------------------------------

-- -----------------------------------------------------
-- create database eventmanagement
-- -----------------------------------------------------

CREATE DATABASE IF NOT EXISTS eventmanagement;
use eventmanagement;



-- -----------------------------------------------------
-- Table `user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `user` ;

CREATE TABLE IF NOT EXISTS `user` (
  `id` INT NOT NULL auto_increment,
  `user_name` VARCHAR(50) NOT NULL,
  `full_name` VARCHAR(50) NULL,
  `email` VARCHAR(50) NOT NULL,
  `phone` VARCHAR(50) NULL,
  `password` VARCHAR(500) NOT NULL,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `event`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `event` ;

CREATE TABLE IF NOT EXISTS `event` (
  `id` INT NOT NULL auto_increment,
  `user_id` INT NOT NULL,
  `event_name` VARCHAR(500) NOT NULL,
  `event_type` VARCHAR(50) NULL,
  `date` DATE NOT NULL,
  `time` TIME NOT NULL,
  `location` VARCHAR(200) NOT NULL,
  `status` TINYINT NOT NULL DEFAULT 0,
  `max_attendees` INT NULL,
  `min_attendees` INT NULL,
  `organizer_name` VARCHAR(100) NULL,
  `description` VARCHAR(5000) NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_poster`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `event_attendees`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `event_attendees` ;

CREATE TABLE IF NOT EXISTS `event_attendees` (
  `event_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  `status` VARCHAR(50) NULL,
  PRIMARY KEY (`event_id`, `user_id`),
  CONSTRAINT `fk_user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_event_id`
    FOREIGN KEY (`event_id`)
    REFERENCES `event` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

