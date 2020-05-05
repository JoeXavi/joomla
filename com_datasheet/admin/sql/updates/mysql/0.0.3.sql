ALTER TABLE `#__datasheet_product` ADD `url_video`VARCHAR(500) NOT NULL;
ALTER TABLE `#__datasheet_product` ADD `marca_id` INT(11) NOT NULL;

DROP TABLE IF EXISTS `#__datasheet_product_brand`;

CREATE TABLE `#__datasheet_product_brand` (
	`id`       INT(11)     NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(100) NOT NULL,
	`description` TEXT NOT NULL,
    `logo` VARCHAR(250)   NOT NULL,
	`state`	 VARCHAR(50)   NOT NULL,
	PRIMARY KEY (`id`)
)
	ENGINE =MyISAM
	AUTO_INCREMENT =0
	DEFAULT CHARSET =utf8;
