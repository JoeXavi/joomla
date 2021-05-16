DROP TABLE IF EXISTS `#__datasheet_product_section`;

CREATE TABLE `#__datasheet_product_section` (
	`id`       INT(11)     NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(100) NOT NULL,
	`description` TEXT NOT NULL,
	`state`	 VARCHAR(50)   NOT NULL,
	PRIMARY KEY (`id`)
)
	ENGINE =MyISAM
	AUTO_INCREMENT =0
	DEFAULT CHARSET =utf8;

ALTER TABLE `#__datasheet_product` ADD `section_id` INT(11) NOT NULL;
