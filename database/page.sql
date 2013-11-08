CREATE  TABLE IF NOT EXISTS `page` (
  `id` INT(20) NOT NULL AUTO_INCREMENT ,
  `template` VARCHAR(255) NULL ,
  `title` VARCHAR(255) NULL ,
  `text` TEXT NULL ,
  `image` VARCHAR(255) NULL ,
  `slug` VARCHAR(510) NULL ,
  `date` DATETIME NULL ,
  `published` TINYINT(1) NULL ,
  `delete` TINYINT NULL ,
PRIMARY KEY (`id`))
ENGINE = InnoDB;