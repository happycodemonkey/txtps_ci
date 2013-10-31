-- MySQL dump 10.13  Distrib 5.1.69, for redhat-linux-gnu (x86_64)
--
-- Host: localhost    Database: txtps
-- ------------------------------------------------------
-- Server version	5.1.66

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

--
-- Table structure for table `arguments`
--

DROP TABLE IF EXISTS `arguments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `arguments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `generator_id` int(10) unsigned NOT NULL,
  `name` varchar(45) NOT NULL,
  `variable` varchar(45) NOT NULL,
  `type` varchar(10) NOT NULL,
  `description` varchar(100) NOT NULL,
  `optional` tinyint(1) NOT NULL,
  `options` varchar(150) DEFAULT NULL,
  `default_value` varchar(30) DEFAULT NULL,
  `min_value` int(10) unsigned DEFAULT NULL,
  `max_value` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `arguments`
--

LOCK TABLES `arguments` WRITE;
/*!40000 ALTER TABLE `arguments` DISABLE KEYS */;
INSERT INTO `arguments` VALUES (1,1,'n','n','INTEGER','',0,'',NULL,NULL,NULL),(2,1,'v','v','FLOAT','',0,'',NULL,NULL,NULL),(4,2,'hp-min','hp-min','INTEGER','minimum level',0,'',NULL,NULL,NULL),(5,2,'hp-max','hp-max','INTEGER','maximum level',0,'',NULL,NULL,NULL),(6,2,'x-anisotropy','anisotropy-x','FLOAT','isotropy in x direction',0,'',NULL,NULL,NULL),(7,2,'y-anisotropy','anisotropy-y','FLOAT','isotropy in y direction',0,'',NULL,NULL,NULL),(8,2,'z-anisotropy','anisotropy-z','FLOAT','anisotropy in z direction',0,'',NULL,NULL,NULL),(9,2,'Scheme','scheme','SELECT','Refinement scheme',0,'\"H\",\"HP\"',NULL,NULL,NULL),(10,3,'hp-min','hp-min','INTEGER','',0,'',NULL,0,0),(11,3,'hp-max','hp-max','INTEGER','',0,'',NULL,0,0),(12,3,'anisotropy-x','anisotropy-x','FLOAT','',0,'',NULL,0,0),(13,3,'anisotropy-y','anisotropy-y','FLOAT','',0,'',NULL,0,0),(14,3,'anisotropy-z','anisotropy-z','FLOAT','',0,'',NULL,0,0),(15,3,'scheme','scheme','SELECT','',0,'H,HP',NULL,0,0),(16,4,'hp-min','hp-min','INTEGER','',0,'',NULL,0,0),(17,4,'hp-max','hp-max','INTEGER','',0,'',NULL,0,0),(18,4,'anisotropy-x','anisotropy-x','FLOAT','',0,'',NULL,0,0),(19,4,'anisotropy-y','anisotropy-y','FLOAT','',0,'',NULL,0,0),(20,4,'anisotropy-z','anisotropy-x','FLOAT','',0,'',NULL,0,0),(21,4,'scheme','scheme','SELECT','',0,'H,HP',NULL,0,0),(22,5,'hp-min','hp-min','INTEGER','',0,'',NULL,0,0),(23,5,'hp-max','hp-max','INTEGER','',0,'',NULL,0,0),(24,5,'anisotropy-x','anisotropy-x','FLOAT','',0,'',NULL,0,0),(25,5,'anisotropy-y','anisotropy-y','FLOAT','',0,'',NULL,0,0),(26,5,'anisotropy-z','anisotropy-z','FLOAT','',0,'',NULL,0,0),(27,5,'scheme','scheme','SELECT','',0,'H,HP',NULL,0,0),(28,7,'mx','mx','INTEGER','Number of elements in x direction',0,'','50',5,50000),(29,7,'my','my','INTEGER','Number of elements in y direction',0,'','50',5,50000),(31,8,'m','m','INTEGER','grid size in one direction',0,'','5',5,0),(32,8,'n','n','INTEGER','grid size in other direction',0,'','5',5,0),(33,8,'t','t','INTEGER','number of time steps',0,'','2',0,20),(34,9,'ne','ne','INTEGER','problem size in number of elements (eg, 31 gives 32^2 grid)',0,'','3',3,0),(35,9,'alpha','alpha','FLOAT','scaling of material coeficient in embedded circle',0,'','1.0',0,0),(36,10,'nex','nex','INTEGER','Number of elements in x direction',0,'','5',2,0),(37,10,'ney','ney','INTEGER','Number of elements in y direction',0,'','1',1,0),(38,10,'nez','nez','INTEGER','Number of elements in z direction',0,'','1',1,0),(43,10,'spectral degree','p','INTEGER','degree of spectral elements',0,'','3',1,0),(42,10,'coefficient jump','factor','INTEGER','factor influencing jump in coefficients, zero for no jump',0,'','0',0,0),(44,11,'nx','nx','INTEGER','Number of points in x direction',0,'','10',5,0),(45,11,'ny','ny','INTEGER','Number of points in y direction',0,'','10',5,0),(48,11,'lid velocity','v','FLOAT','Dimensionless velocity of lid',0,'','0.01',0,0),(47,11,'prandtl','p','FLOAT','dimensionless thermal/momentum diffusity ratio',0,'','0.00',0,0),(49,11,'grashof','g','FLOAT','dimensionless temperature gradent',0,'','0.0',0,0),(50,12,'m','m','INTEGER','Number of grid points in each direction;\nthe matrix size will be the square of this.',0,'','10',10,0),(51,13,'iter','iter','INTEGER','Number of uniform refinement steps. Default = 1 corresponding to no refinement levels.',0,'','1',1,0),(52,13,'order-tetr','ordertetr','INTEGER','Tetrahedral elements approximation order',0,'','2',2,0),(53,13,'order-pris','orderpris','INTEGER','Prism element approximation order',0,'','2',2,0);
/*!40000 ALTER TABLE `arguments` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-10-15 12:26:50
