CREATE  TABLE `blog`.`authetic_users` (

  `id` INT NOT NULL AUTO_INCREMENT ,

  `user` VARCHAR(255) NULL ,

  `pass` VARCHAR(255) NULL ,

  `type` VARCHAR(255) NULL ,

  PRIMARY KEY (`id`) ,

  UNIQUE INDEX `id_UNIQUE` (`id` ASC) );

