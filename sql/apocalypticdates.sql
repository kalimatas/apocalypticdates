-- Create database and tables

DROP DATABASE IF EXISTS `apocalypticdates`;
CREATE DATABASE `apocalypticdates`;

CREATE TABLE `apocalypticdates`.`author` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(100) NULL ,
  `description` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

CREATE  TABLE `apocalypticdates`.`date` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `author_id` INT NULL ,
  `date` VARCHAR(45) NOT NULL,
  `description` VARCHAR(255) NOT NULL ,
  `happened` TINYINT NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

-- Let's insert some dates
INSERT INTO `apocalypticdates`.`author` VALUES
(null, 'Early Christians', 'Some clever guys'),
(null, 'Various Christians, Sabbatai Zevi', 'They both were wrong'),
(null, 'Jeanne Dixon', 'Just psychic');
;

INSERT INTO `apocalypticdates`.`date` VALUES
(null, 1, '1st century', 'Some first century Christians, including Paul the Apostle, expected Jesus to return within one generation of his death.', 0),
(null, 2, '1666', 'The presence of 666 in the date led to superstitious fears of the end of the world from some Christians.', 0),
(null, 3, '1962, Feb 4', 'This psychic predicted a planetary alignment on this day was to bring destruction to the world on this day.', 0);