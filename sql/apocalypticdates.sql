-- Create database and tables

DROP DATABASE IF EXISTS `apocalypticdates`;
CREATE DATABASE `apocalypticdates`;

CREATE  TABLE `apocalypticdates`.`author` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(100) NULL ,
  `description` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

CREATE  TABLE `apocalypticdates`.`date` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `author_id` INT NULL ,
  `date` DATE NULL ,
  `description` VARCHAR(255) NOT NULL ,
  `happened` TINYINT NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

-- Let's insert some dates

