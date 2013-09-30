-- MySQL dump 10.13  Distrib 5.1.62, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: codeigniter
-- ------------------------------------------------------
-- Server version	5.1.62-0ubuntu0.11.10.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

use txtps;

--
-- Table structure for table `anamod_data`
--

DROP TABLE IF EXISTS `anamod_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anamod_data` (
  `file_id` int(11) NOT NULL,
  `simple-trace` double DEFAULT NULL,
  `simple-trace-abs` double DEFAULT NULL,
  `simple-norm1` double DEFAULT NULL,
  `simple-normInf` double DEFAULT NULL,
  `simple-normF` double DEFAULT NULL,
  `simple-diagonal-dominance` double DEFAULT NULL,
  `simple-symmetry-snorm` double DEFAULT NULL,
  `simple-symmetry-anorm` double DEFAULT NULL,
  `simple-symmetry-fsnorm` double DEFAULT NULL,
  `simple-symmetry-fanorm` double DEFAULT NULL,
  `structure-n-struct-unsymm` int(11) DEFAULT NULL,
  `structure-nrows` int(11) DEFAULT NULL,
  `structure-symmetry` int(11) DEFAULT NULL,
  `structure-nnzeros` int(11) DEFAULT NULL,
  `structure-max-nnzeros-per-row` int(11) DEFAULT NULL,
  `structure-min-nnzeros-per-row` int(11) DEFAULT NULL,
  `structure-left-bandwidth` int(11) DEFAULT NULL,
  `structure-right-bandwidth` int(11) DEFAULT NULL,
  `structure-left-skyline` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `structure-right-skyline` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `structure-n-dummy-rows` int(11) DEFAULT NULL,
  `structure-dummy-rows-kind` int(11) DEFAULT NULL,
  `structure-dummy-rows` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `structure-diag-zerostart` int(11) DEFAULT NULL,
  `structure-diag-definite` int(11) DEFAULT NULL,
  `structure-blocksize` int(11) DEFAULT NULL,
  `variance-row-variability` double DEFAULT NULL,
  `variance-col-variability` double DEFAULT NULL,
  `variance-diagonal-average` double DEFAULT NULL,
  `variance-diagonal-variance` double DEFAULT NULL,
  `variance-diagonal-sign` int(11) DEFAULT NULL,
  `normal-trace-asquared` double DEFAULT NULL,
  `normal-commutator-normF` double DEFAULT NULL,
  `normal-ruhe75-bound` double DEFAULT NULL,
  `normal-lee95-bound` double DEFAULT NULL,
  `normal-lee96-ubound` double DEFAULT NULL,
  `normal-lee96-lbound` double DEFAULT NULL,
  `spectrum-n-ritz-values` int(11) DEFAULT NULL,
  `spectrum-ritz-values-r` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `spectrum-ritz-values-c` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `spectrum-ellipse-ax` double DEFAULT NULL,
  `spectrum-ellipse-ay` double DEFAULT NULL,
  `spectrum-ellipse-cx` double DEFAULT NULL,
  `spectrum-ellipse-cy` double DEFAULT NULL,
  `spectrum-kappa` double DEFAULT NULL,
  `spectrum-positive-fraction` double DEFAULT NULL,
  `spectrum-sigma-max` double DEFAULT NULL,
  `spectrum-sigma-min` double DEFAULT NULL,
  `spectrum-lambda-max-by-magnitude-re` double DEFAULT NULL,
  `spectrum-lambda-max-by-magnitude-im` double DEFAULT NULL,
  `spectrum-lambda-min-by-magnitude-re` double DEFAULT NULL,
  `spectrum-lambda-min-by-magnitude-im` double DEFAULT NULL,
  `spectrum-lambda-max-by-real-part-re` double DEFAULT NULL,
  `spectrum-lambda-max-by-real-part-im` double DEFAULT NULL,
  `spectrum-lambda-max-by-im-part-re` double DEFAULT NULL,
  `spectrum-lambda-max-by-im-part-im` double DEFAULT NULL,
  `jpl-n-colours` int(11) DEFAULT NULL,
  `jpl-colour-set-sizes` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jpl-colour-offsets` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jpl-colours` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `iprs-nnzup` int(11) DEFAULT NULL,
  `iprs-nnzlow` int(11) DEFAULT NULL,
  `iprs-nnzdia` int(11) DEFAULT NULL,
  `iprs-nnz` int(11) DEFAULT NULL,
  `iprs-avgnnzprow` int(11) DEFAULT NULL,
  `iprs-avgdistfromdiag` int(11) DEFAULT NULL,
  `iprs-relsymm` double DEFAULT NULL,
  `iprs-upband` int(11) DEFAULT NULL,
  `iprs-loband` int(11) DEFAULT NULL,
  `iprs-n-nonzero-diags` int(11) DEFAULT NULL,
  `iprs-avg-diag-dist` double DEFAULT NULL,
  `iprs-sigma-diag-dist` double DEFAULT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `arguments`
--

DROP TABLE IF EXISTS `arguments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `arguments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `generator_id` int(32) NOT NULL DEFAULT '0',
  `sequence` tinyint(4) DEFAULT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `variable` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `optional` tinyint(1) NOT NULL,
  `options` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `default_value` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=270 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `collection`
--

DROP TABLE IF EXISTS `collection`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `collection` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `type` enum('collection','generator','product') COLLATE utf8_unicode_ci DEFAULT NULL,
  `id` int(11) DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `file`
--

DROP TABLE IF EXISTS `file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resource_id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `size` int(32) NOT NULL,
  `resource_type` enum('problem','generator','collection') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2725 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `filetype`
--

DROP TABLE IF EXISTS `filetype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `filetype` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ext` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ext` (`ext`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `generator`
--

DROP TABLE IF EXISTS `generator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `generator` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `script` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `generatortype_id` int(10) unsigned DEFAULT NULL,
  `collection_id` int(10) unsigned DEFAULT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=276 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'admin','Administrator'),(2,'members','General User');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `image`
--

DROP TABLE IF EXISTS `image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resource_id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `resource_type` enum('problem','generator','collection') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` int(10) unsigned DEFAULT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `identifier` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `generator_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `error` tinyint(1) DEFAULT NULL,
  `hold` tinyint(1) DEFAULT NULL,
  `producttype_id` int(10) NOT NULL DEFAULT '0',
  `arguments` text COLLATE utf8_unicode_ci,
  `cmd` text COLLATE utf8_unicode_ci,
  `description` tinytext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`,`producttype_id`)
) ENGINE=InnoDB AUTO_INCREMENT=285 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `script`
--

DROP TABLE IF EXISTS `script`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `script` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `generator_id` int(11) DEFAULT NULL,
  `path` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `statistics`
--

DROP TABLE IF EXISTS `statistics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `statistics` (
  `product_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` int(10) unsigned NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,2130706433,'administrator','59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4','9462e8eee0','admin@admin.com','',NULL,'9d029802e28cd9c768e8e62277c0df49ec65c48c',1268889823,1334696934,1,'Admin','istrator','ADMIN','0'),(2,2130706433,'cmarnold@tacc.utexas.edu','7b416f0587f1c3b13679885a9fc88221086bb9dd',NULL,'cmarnold@tacc.utexas.edu',NULL,NULL,'b1c15fdd842d3925fc3a51f92854c237a72e62c6',1334689628,1335532567,1,'Carrie','Arnold',NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_groups`
--

DROP TABLE IF EXISTS `users_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_groups`
--

LOCK TABLES `users_groups` WRITE;
/*!40000 ALTER TABLE `users_groups` DISABLE KEYS */;
INSERT INTO `users_groups` VALUES (1,1,1),(2,1,2),(3,2,2),(6,2,1);
/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-04-27 14:17:44
