return "SET SQL_MODE=\"NO_AUTO_VALUE_ON_ZERO\";";
return "CREATE DATABASE IF NOT EXISTS  `$mysql_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;";
return "USE `$mysql_db`;";
return "CREATE TABLE IF NOT EXISTS `authentic_users` (`id` int(11) NOT NULL AUTO_INCREMENT,`user` varchar(255) NOT NULL,`pass` varchar(255) NOT NULL,`type` varchar(255) NOT NULL,PRIMARY KEY (`id`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;";
return "CREATE TABLE IF NOT EXISTS `posts` (`id` int(11) NOT NULL AUTO_INCREMENT,`title` text NOT NULL,`post` text NOT NULL,`date` int(11) NOT NULL,`comments` text NOT NULL,`tags` text NOT NULL,`poster` text NOT NULL,PRIMARY KEY (`id`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;";
return "CREATE  TABLE IF NOT EXISTS `$mysql_db`.`comments` (`commentID` INT NOT NULL AUTO_INCREMENT ,`postID` INT NULL ,`name` VARCHAR(45) NULL , `comment` TEXT NULL, `time` VARCHAR(45) NULL ,PRIMARY KEY (`commentID`) );";
