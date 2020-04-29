DROP TABLE IF EXISTS `#__datasheet_product_type`;

CREATE TABLE `#__datasheet_product_type` (
	`id`       INT(11)     NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(100) NOT NULL,
	`description` TINYTEXT NOT NULL,
	`datas` TINYTEXT NOT NULL,
	`state`	 VARCHAR(50)   NOT NULL,
	PRIMARY KEY (`id`)
)
	ENGINE =MyISAM
	AUTO_INCREMENT =0
	DEFAULT CHARSET =utf8;

INSERT INTO `#__datasheet_product_type` (`name`,`description`,`datas`,`state`) VALUES
('Motos','Data sheet de motos','{"0":"1","1":"2"}','active'),
('Llantas','Data sheet de llantas','{"0":"4","1":"3"}','active');



DROP TABLE IF EXISTS `#__datasheet_product_data`;

CREATE TABLE `#__datasheet_product_data` (
	`id`       INT(11)     NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(100) NOT NULL,
	`diminutive` VARCHAR(20) NOT NULL,
	`measurement` VARCHAR(20) NOT NULL,
	`description` TINYTEXT NOT NULL,
	`type` VARCHAR(100) NOT NULL,
	`state`	 VARCHAR(50)   NOT NULL,
	PRIMARY KEY (`id`)
)
	ENGINE =MyISAM
	AUTO_INCREMENT =0
	DEFAULT CHARSET =utf8;

INSERT INTO `#__datasheet_product_data` (`name`,`diminutive`,`measurement`,`description`,`type`,`state`) VALUES
('Precio','$','.','Valor de producto','text','active'),
('Cilindrada','','C.C.','Cilindrada de moto','number','active'),
('Modelo','Mod.','','Modelo de producto','number','active'),
('Potencia','','N/m','Potencia de moto','number','active');



DROP TABLE IF EXISTS `#__datasheet_product`;

CREATE TABLE `#__datasheet_product` (
	`id`       INT(11)     NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(100) NOT NULL,
	`description` TINYTEXT NOT NULL,
	`relations` TINYTEXT NOT NULL,
	`img_default`VARCHAR(250)   NOT NULL,
	`galery_folder`VARCHAR(250)   NOT NULL,
	`type_id` INT(11) NOT NULL,
	`state`	   VARCHAR(50)   NOT NULL,
	PRIMARY KEY (`id`)
)
	ENGINE =MyISAM
	AUTO_INCREMENT =0
	DEFAULT CHARSET =utf8;



DROP TABLE IF EXISTS `#__datasheet_product_data_value`;

CREATE TABLE `#__datasheet_product_data_value` (
	`id`       INT(11)     NOT NULL AUTO_INCREMENT,
	`product_id` INT(11) NOT NULL,
	`data`  TEXT NOT NULL,
	PRIMARY KEY (`id`)
)
	ENGINE =MyISAM
	AUTO_INCREMENT =0
	DEFAULT CHARSET =utf8;




