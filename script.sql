CREATE DATABASE  IF NOT EXISTS `crm-freelance`;
USE `crm-freelance`;

DROP TABLE IF EXISTS `client`;
CREATE TABLE `client` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `firstname` varchar(150) NOT NULL,
    `lastname` varchar(150) NOT NULL,
    `company` varchar(150) NOT NULL,
    `picture` varchar(250) NOT NULL,
    `date_of_birth` datetime DEFAULT NULL,
    `address` varchar(250) DEFAULT NULL,
    `email` char(250) DEFAULT NULL,
    `phone_number` varchar(50) DEFAULT NULL,
    `budget` varchar(100) DEFAULT NULL,
    `date_create` datetime NOT NULL,
    `notes` text,
    `last_happiness` int(11),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `project`;
CREATE TABLE `project` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `title` varchar(250) NOT NULL,
    `description` text DEFAULT NULL,
    `id_user` int(10) unsigned NOT NULL,
    `negociation_status` int(10) unsigned DEFAULT '0',
    `milestone` text,
    `status` varchar(150) DEFAULT 'en négociation',
  PRIMARY KEY (`id`),
  KEY `fk_p_id_user_idx` (`id_user`),
  CONSTRAINT `fk_p_id_user_idx` FOREIGN KEY (`id_user`) REFERENCES `client` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `bill`;
CREATE TABLE `bill` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `title` varchar(250) NOT NULL,
    `create_date` datetime NOT NULL,
    `status` varchar(250) DEFAULT 'envoyé',
    `payed_date` datetime,
    `file_name` varchar(250) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;