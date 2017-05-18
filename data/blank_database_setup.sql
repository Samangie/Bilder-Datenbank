CREATE DATABASE `bilderdb_4h_hawkes`
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_german2_ci;

USE `bilderdb_4h_hawkes`;

CREATE TABLE `access_user` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(64) NOT NULL ,
  `email` VARCHAR(64) NOT NULL,
  `password` VARCHAR(64) NOT NULL
);

CREATE TABLE `gallery_category` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(64) NOT NULL,
  `description` VARCHAR(200),
  `user_id` INT NOT NULL,
  FOREIGN KEY (`user_id`) REFERENCES `access_user`(`id`)
);

CREATE TABLE `gallery_image` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `image_name` VARCHAR(64) NOT NULL,
  `title` VARCHAR(64) NOT NULL,
  `gallery_id` INT NOT NULL,
  FOREIGN KEY (`gallery_id`) REFERENCES `gallery_category`(`id`)
)

