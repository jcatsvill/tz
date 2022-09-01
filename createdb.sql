CREATE DATABASE `tz`;
USE `tz`;
CREATE TABLE `posts` (
	`Id` INT NOT NULL AUTO_INCREMENT,
	`userId` INT NOT NULL,
	`title` varchar(255) NOT NULL,
	`body` TEXT NOT NULL,
	PRIMARY KEY (`Id`)
);

CREATE TABLE `comments` (
	`Id` INT NOT NULL AUTO_INCREMENT,
	`postId` INT NOT NULL,
	`name` varchar(255) NOT NULL,
	`email` varchar(128) NOT NULL,
	`body` TEXT NOT NULL,
	PRIMARY KEY (`Id`)
);

ALTER TABLE `comments` ADD CONSTRAINT `comments_fk0` FOREIGN KEY (`postId`) REFERENCES `posts`(`Id`);
