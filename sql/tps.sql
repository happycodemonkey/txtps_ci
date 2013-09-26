CREATE DATABASE IF NOT EXISTS `txtps`;

USE `txtps`;

DROP TABLE IF EXISTS `anamod_data`;

CREATE TABLE `anamod_data` (
  `file_id` int(11) NOT NULL,
  `simple-trace` double default NULL,
  `simple-trace-abs` double default NULL,
  `simple-norm1` double default NULL,
  `simple-normInf` double default NULL,
  `simple-normF` double default NULL,
  `simple-diagonal-dominance` double default NULL,
  `simple-symmetry-snorm` double default NULL,
  `simple-symmetry-anorm` double default NULL,
  `simple-symmetry-fsnorm` double default NULL,
  `simple-symmetry-fanorm` double default NULL,
  `structure-n-struct-unsymm` int(11) default NULL,
  `structure-nrows` int(11) default NULL,
  `structure-symmetry` int(11) default NULL,
  `structure-nnzeros` int(11) default NULL,
  `structure-max-nnzeros-per-row` int(11) default NULL,
  `structure-min-nnzeros-per-row` int(11) default NULL,
  `structure-left-bandwidth` int(11) default NULL,
  `structure-right-bandwidth` int(11) default NULL,
  `structure-left-skyline` varchar(1024) collate utf8_unicode_ci default NULL,
  `structure-right-skyline` varchar(1024) collate utf8_unicode_ci default NULL,
  `structure-n-dummy-rows` int(11) default NULL,
  `structure-dummy-rows-kind` int(11) default NULL,
  `structure-dummy-rows` varchar(1024) collate utf8_unicode_ci default NULL,
  `structure-diag-zerostart` int(11) default NULL,
  `structure-diag-definite` int(11) default NULL,
  `structure-blocksize` int(11) default NULL,
  `variance-row-variability` double default NULL,
  `variance-col-variability` double default NULL,
  `variance-diagonal-average` double default NULL,
  `variance-diagonal-variance` double default NULL,
  `variance-diagonal-sign` int(11) default NULL,
  `normal-trace-asquared` double default NULL,
  `normal-commutator-normF` double default NULL,
  `normal-ruhe75-bound` double default NULL,
  `normal-lee95-bound` double default NULL,
  `normal-lee96-ubound` double default NULL,
  `normal-lee96-lbound` double default NULL,
  `spectrum-n-ritz-values` int(11) default NULL,
  `spectrum-ritz-values-r` varchar(1024) collate utf8_unicode_ci default NULL,
  `spectrum-ritz-values-c` varchar(1024) collate utf8_unicode_ci default NULL,
  `spectrum-ellipse-ax` double default NULL,
  `spectrum-ellipse-ay` double default NULL,
  `spectrum-ellipse-cx` double default NULL,
  `spectrum-ellipse-cy` double default NULL,
  `spectrum-kappa` double default NULL,
  `spectrum-positive-fraction` double default NULL,
  `spectrum-sigma-max` double default NULL,
  `spectrum-sigma-min` double default NULL,
  `spectrum-lambda-max-by-magnitude-re` double default NULL,
  `spectrum-lambda-max-by-magnitude-im` double default NULL,
  `spectrum-lambda-min-by-magnitude-re` double default NULL,
  `spectrum-lambda-min-by-magnitude-im` double default NULL,
  `spectrum-lambda-max-by-real-part-re` double default NULL,
  `spectrum-lambda-max-by-real-part-im` double default NULL,
  `spectrum-lambda-max-by-im-part-re` double default NULL,
  `spectrum-lambda-max-by-im-part-im` double default NULL,
  `jpl-n-colours` int(11) default NULL,
  `jpl-colour-set-sizes` varchar(1024) collate utf8_unicode_ci default NULL,
  `jpl-colour-offsets` varchar(1024) collate utf8_unicode_ci default NULL,
  `jpl-colours` varchar(1024) collate utf8_unicode_ci default NULL,
  `iprs-nnzup` int(11) default NULL,
  `iprs-nnzlow` int(11) default NULL,
  `iprs-nnzdia` int(11) default NULL,
  `iprs-nnz` int(11) default NULL,
  `iprs-avgnnzprow` int(11) default NULL,
  `iprs-avgdistfromdiag` int(11) default NULL,
  `iprs-relsymm` double default NULL,
  `iprs-upband` int(11) default NULL,
  `iprs-loband` int(11) default NULL,
  `iprs-n-nonzero-diags` int(11) default NULL,
  `iprs-avg-diag-dist` double default NULL,
  `iprs-sigma-diag-dist` double default NULL,
  PRIMARY KEY  (`file_id`)
);
 
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
	`min_value` int(10) unsigned,
	`max_value` int(10) unsigned,
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
