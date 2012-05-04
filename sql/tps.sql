DROP TABLE IF EXISTS `collection`;

CREATE TABLE `collection` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(45) NOT NULL,	
	`description` text,
	PRIMARY KEY (`id`)
);

DROP TABLE IF EXISTS `generator`;

CREATE TABLE `generator` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(45) NOT NULL,	
	`description` text,
	`script` varchar(100),
	`collection_id` int(10) unsigned NOT NULL,
	PRIMARY KEY (`id`)
);

DROP TABLE IF EXISTS `problem`;

CREATE TABLE `problem` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`identifier` varchar(6) NOT NULL,
	`description` text,
	`generator_id` int(10) unsigned NOT NULL,
	`user_id` mediumint(8) unsigned NOT NULL,
	`created_datetime` timestamp,
	`error` tinyint(1),
	PRIMARY KEY (`id`)
);

DROP TABLE IF EXISTS `arguments`;

CREATE TABLE `arguments` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`generator_id` int(10) unsigned NOT NULL,
	`name` varchar(45) NOT NULL,
	`variable` varchar(45) NOT NULL,
	`type` varchar(10) NOT NULL,
	`description` varchar(100) NOT NULL,
	`optional` tinyint(1) NOT NULL,
	`options` varchar(150),
	`default_value` varchar(30),
	PRIMARY KEY (`id`)
);

DROP TABLE IF EXISTS `problem_argument`;

CREATE TABLE `problem_argument` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`problem_id` int(10) unsigned NOT NULL,
	`argument_id` int(10) unsigned NOT NULL,
	`value` varchar(30) NOT NULL,
	PRIMARY KEY (`id`)
);

DROP TABLE IF EXISTS `resource`;

CREATE TABLE `resource` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`reference_id` int(10) unsigned NOT NULL,
	`name` varchar(100) NOT NULL,
	`reference_type` enum('problem','generator','collection') NOT NULL,
	`resource_type` enum('image','file') NOT NULL,
	PRIMARY KEY (`id`)
);
