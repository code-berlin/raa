-- -----------------------------------------------------
-- Table `mydb`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `user` (
  `id` INT(4) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(128) NOT NULL,
  `password` VARCHAR(128) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Data for table `mydb`.`user`
-- -----------------------------------------------------

INSERT INTO `user` (`id`, `username`, `password`)
VALUES (NULL, 'admin@code-b.com', 'b5edbafd026b773a7eb36d9b42b1bd6a952ddfdd');

COMMIT;

