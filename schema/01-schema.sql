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


DROP TABLE IF EXISTS `eco_invoice_line`;
CREATE TABLE `eco_invoice_line` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`invoice_id` int(10) unsigned NOT NULL,
	`order_line_id` int(10) unsigned DEFAULT NULL,
	`product_id` int(10) unsigned DEFAULT NULL,
	`item_quantity` decimal(10,2) NOT NULL,
	`item_label` varchar(255) NOT NULL,
	`due_amount` varchar(255) NOT NULL,
	PRIMARY KEY (`id`),
	KEY `invoice_id` (`invoice_id`),
	KEY `order_line_id` (`order_line_id`),
	KEY `product_id` (`product_id`),
	CONSTRAINT `FK_eco_invoice_line_eco_product` FOREIGN KEY (`product_id`) REFERENCES `eco_product` (`id`),
	CONSTRAINT `FK_eco_invoice_line_eco_invoice` FOREIGN KEY (`invoice_id`) REFERENCES `eco_invoice` (`id`),
	CONSTRAINT `FK_eco_invoice_line_eco_order_line` FOREIGN KEY (`order_line_id`) REFERENCES `eco_order_line` (`id`)
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
	CONSTRAINT `FK_eco_payment_eco_user` FOREIGN KEY (`user_id`) REFERENCES `eco_user` (`id`),
	CONSTRAINT `FK_eco_payment_eco_order` FOREIGN KEY (`order_id`) REFERENCES `eco_order` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `eco_product`;
CREATE TABLE `eco_product` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`price` int(11) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `eco_user`;
CREATE TABLE `eco_user` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(255) DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

