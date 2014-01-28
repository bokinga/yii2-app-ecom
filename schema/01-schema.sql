DROP TABLE IF EXISTS `eco_discount`;
CREATE TABLE `eco_discount` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
	`label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
	`amount` int(11) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `eco_invoice`;
CREATE TABLE `eco_invoice` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`order_id` int(10) unsigned NOT NULL,
	`due_amount` int(11) NOT NULL,
	`due_datetime` datetime DEFAULT NULL,
	`created` datetime NOT NULL,
	PRIMARY KEY (`id`),
	KEY `order_id` (`order_id`),
	CONSTRAINT `FK_eco_invoice_eco_order` FOREIGN KEY (`order_id`) REFERENCES `eco_order` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `eco_order`;
CREATE TABLE `eco_order` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`user_id` int(10) unsigned NOT NULL,
	`status` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
	`due_amount` int(11) NOT NULL,
	`created` datetime NOT NULL,
	PRIMARY KEY (`id`),
	KEY `user_id` (`user_id`),
	CONSTRAINT `FK_eco_order_eco_user` FOREIGN KEY (`user_id`) REFERENCES `eco_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `eco_order_line`;
CREATE TABLE `eco_order_line` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`order_id` int(10) unsigned NOT NULL,
	`product_id` int(10) unsigned NOT NULL,
	`quantity` decimal(10,2) NOT NULL,
	`due_amount` int(11) NOT NULL,
	PRIMARY KEY (`id`),
	KEY `order_id` (`order_id`),
	KEY `product_id` (`product_id`),
	CONSTRAINT `FK_eco_order_line_eco_order` FOREIGN KEY (`order_id`) REFERENCES `eco_order` (`id`),
	CONSTRAINT `FK_eco_order_line_eco_product` FOREIGN KEY (`product_id`) REFERENCES `eco_product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `eco_payment`;
CREATE TABLE `eco_payment` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`user_id` int(10) unsigned DEFAULT NULL,
	`order_id` int(10) unsigned NOT NULL,
	`bank_code` varchar(20) NOT NULL,
	`amount` varchar(255) NOT NULL,
	`status` varchar(20) NOT NULL,
	`data_dump` blob NOT NULL,
	`created` datetime NOT NULL,
	PRIMARY KEY (`id`),
	KEY `order_id` (`order_id`),
	KEY `user_id` (`user_id`),
	CONSTRAINT `FK_eco_payment_eco_order` FOREIGN KEY (`order_id`) REFERENCES `eco_order` (`id`),
	CONSTRAINT `FK_eco_payment_eco_user` FOREIGN KEY (`user_id`) REFERENCES `eco_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `eco_product`;
CREATE TABLE `eco_product` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	`price` int(11) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `eco_user`;
CREATE TABLE `eco_user` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(255) DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2014-01-28 09:46:43
