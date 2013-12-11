/*
SQLyog Ultimate v8.3 
MySQL - 5.5.24 : Database - santander
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE DATABASE `santander`;

USE `santander`;

/*Table structure for table `cliente` */

DROP TABLE IF EXISTS `cliente`;

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `uid_facebook` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

/*Table structure for table `foto` */

DROP TABLE IF EXISTS `foto`;

CREATE TABLE `foto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `tipo` tinyint(4) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_foto` (`cliente_id`),
  CONSTRAINT `FK_foto` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=230 DEFAULT CHARSET=latin1;

/*Table structure for table `premio` */

DROP TABLE IF EXISTS `premio`;

CREATE TABLE `premio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) DEFAULT NULL,
  `imagen` varchar(50) DEFAULT NULL,
  `posicion` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `premio` */

insert  into `premio`(`id`,`descripcion`,`imagen`,`posicion`,`created`,`modified`) values (8,'1 Enero','ipod.png',1,'2013-12-07 13:41:10','2013-12-07 14:03:38'),(9,'10 Enero','play_station_yellow.png',4,'2013-12-07 13:42:04','2013-12-10 22:16:52'),(10,'25 Dic','play_station_yellow.png',6,'2013-12-11 03:36:21','2013-12-11 03:36:39');

/*Table structure for table `premio_cliente` */

DROP TABLE IF EXISTS `premio_cliente`;

CREATE TABLE `premio_cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime DEFAULT NULL,
  `foto_id` int(11) NOT NULL,
  `premio_id` int(11) NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_premio_cliente_premio` (`premio_id`),
  KEY `FK_premio_cliente` (`foto_id`),
  CONSTRAINT `FK_premio_cliente` FOREIGN KEY (`foto_id`) REFERENCES `foto` (`id`),
  CONSTRAINT `FK_premio_cliente_premio` FOREIGN KEY (`premio_id`) REFERENCES `premio` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`,`role`,`created`,`modified`) values (1,'admin','df521d6113cd9c13a6e1693e888f9b6c3f90e5d0','admin','2013-11-30 03:58:38','2013-12-01 02:40:11');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
