/*
SQLyog Community v12.2.4 (64 bit)
MySQL - 5.5.50 : Database - inventry
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`inventry` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `inventry`;

/*Table structure for table `category_details` */

DROP TABLE IF EXISTS `category_details`;

CREATE TABLE `category_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `category_details` */

insert  into `category_details`(`id`,`category_name`) values 
(2,'Paint'),
(3,'Stainless Steel Sheet');

/*Table structure for table `category_units_masters` */

DROP TABLE IF EXISTS `category_units_masters`;

CREATE TABLE `category_units_masters` (
  `cu_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `measure_id` int(11) NOT NULL,
  `uom_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`cu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `category_units_masters` */

insert  into `category_units_masters`(`cu_id`,`category_id`,`measure_id`,`uom_id`,`created_at`,`updated_at`,`status`) values 
(9,2,6,19,'2017-02-14 12:34:53','0000-00-00 00:00:00',NULL),
(10,3,1,3,'2017-02-15 04:56:21','0000-00-00 00:00:00',NULL),
(11,3,2,7,'2017-02-15 04:56:21','0000-00-00 00:00:00',NULL),
(12,3,4,13,'2017-02-15 04:56:21','0000-00-00 00:00:00',NULL);

/*Table structure for table `customer_details` */

DROP TABLE IF EXISTS `customer_details`;

CREATE TABLE `customer_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(200) NOT NULL,
  `customer_email` varchar(200) NOT NULL,
  `customer_address` varchar(500) NOT NULL,
  `customer_contact1` bigint(20) DEFAULT NULL,
  `customer_contact2` bigint(20) DEFAULT NULL,
  `balance` double unsigned NOT NULL DEFAULT '0',
  `due` double unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `customer_details` */

/*Table structure for table `measures_master` */

DROP TABLE IF EXISTS `measures_master`;

CREATE TABLE `measures_master` (
  `measure_id` tinyint(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`measure_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `measures_master` */

insert  into `measures_master`(`measure_id`,`name`) values 
(1,'Length'),
(2,'Breadth'),
(3,'Diametre'),
(4,'Thickness'),
(5,'Weight'),
(6,'Volume');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(256) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2017_02_06_090059_create_category_details_table',1),
(4,'2017_02_06_090059_create_customer_details_table',1),
(5,'2017_02_06_090059_create_stock_details_table',1),
(6,'2017_02_06_090059_create_stock_sales_table',1),
(7,'2017_02_06_090059_create_stock_user_table',1),
(8,'2017_02_06_090059_create_store_details_table',1),
(9,'2017_02_06_090059_create_supplier_details_table',1),
(10,'2017_02_06_090059_create_transactions_table',1),
(11,'2017_02_06_090059_create_uom_details_table',1);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(256) NOT NULL,
  `token` varchar(256) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`(255)),
  KEY `password_resets_token_index` (`token`(255))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `password_resets` */

/*Table structure for table `stock_details` */

DROP TABLE IF EXISTS `stock_details`;

CREATE TABLE `stock_details` (
  `stock_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `stock_name` varchar(120) NOT NULL,
  `category_id` int(11) NOT NULL,
  `purchase_cost` double unsigned NOT NULL,
  `selling_cost` double unsigned NOT NULL,
  `supplier_id` varchar(250) NOT NULL,
  `stock_quantity` int(10) unsigned NOT NULL DEFAULT '0',
  `uom` varchar(120) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`stock_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `stock_details` */

/*Table structure for table `stock_sales` */

DROP TABLE IF EXISTS `stock_sales`;

CREATE TABLE `stock_sales` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `transactionid` varchar(250) NOT NULL,
  `transidnumber` int(11) NOT NULL,
  `stock_name` varchar(200) NOT NULL,
  `category` varchar(120) NOT NULL,
  `supplier_name` varchar(200) NOT NULL,
  `selling_price` decimal(10,2) unsigned NOT NULL,
  `quantity` decimal(10,2) unsigned NOT NULL,
  `amount` decimal(10,2) unsigned NOT NULL,
  `date` date NOT NULL,
  `username` varchar(120) NOT NULL,
  `customer_id` varchar(120) NOT NULL,
  `subtotal` decimal(10,2) unsigned NOT NULL,
  `payment` decimal(10,2) unsigned NOT NULL,
  `balance` decimal(10,2) unsigned NOT NULL,
  `discount` decimal(10,0) unsigned NOT NULL,
  `tax` decimal(10,0) unsigned NOT NULL,
  `tax_dis` varchar(100) NOT NULL,
  `dis_amount` decimal(10,0) unsigned NOT NULL,
  `grand_total` decimal(10,0) unsigned NOT NULL,
  `due` date NOT NULL,
  `mode` varchar(250) NOT NULL,
  `description` varchar(500) NOT NULL,
  `count1` int(11) NOT NULL,
  `billnumber` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `stock_sales` */

/*Table structure for table `stock_user` */

DROP TABLE IF EXISTS `stock_user`;

CREATE TABLE `stock_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(120) NOT NULL,
  `password` varchar(120) NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `answer` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `stock_user` */

/*Table structure for table `store_details` */

DROP TABLE IF EXISTS `store_details`;

CREATE TABLE `store_details` (
  `name` varchar(100) NOT NULL,
  `log` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `place` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `web` varchar(100) NOT NULL,
  `pin` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `store_details` */

/*Table structure for table `supplier_details` */

DROP TABLE IF EXISTS `supplier_details`;

CREATE TABLE `supplier_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(200) NOT NULL,
  `supplier_email` varchar(200) NOT NULL,
  `supplier_address` varchar(500) NOT NULL,
  `supplier_contact1` varchar(100) NOT NULL,
  `supplier_contact2` varchar(100) NOT NULL,
  `balance` double unsigned NOT NULL DEFAULT '0',
  `due` double unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `supplier_details` */

/*Table structure for table `transactions` */

DROP TABLE IF EXISTS `transactions`;

CREATE TABLE `transactions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL,
  `sales_id` int(11) DEFAULT NULL,
  `purchase_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `subtotal` double(10,2) unsigned NOT NULL,
  `payment` double(10,2) unsigned NOT NULL,
  `mode` tinyint(1) NOT NULL,
  `balance` double(10,2) unsigned NOT NULL,
  `due` double(10,2) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `transactions` */

/*Table structure for table `unit_of_measures_master` */

DROP TABLE IF EXISTS `unit_of_measures_master`;

CREATE TABLE `unit_of_measures_master` (
  `uom_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(16) COLLATE utf8_bin DEFAULT NULL,
  `symbol` varchar(8) COLLATE utf8_bin DEFAULT NULL,
  `measure_id` varchar(16) COLLATE utf8_bin DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`uom_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `unit_of_measures_master` */

insert  into `unit_of_measures_master`(`uom_id`,`name`,`symbol`,`measure_id`,`created_at`,`updated_at`,`status`) values 
(1,'Millimeter','mm','1','2017-02-14 14:32:46','0000-00-00 00:00:00',1),
(2,'Centimeter','cm','1','2017-02-14 14:32:46','0000-00-00 00:00:00',1),
(3,'Inch','in','1','2017-02-14 14:33:24','0000-00-00 00:00:00',1),
(4,'Metre','m','1','2017-02-14 14:32:46','0000-00-00 00:00:00',1),
(5,'Millimeter','mm','2','2017-02-14 14:32:46','0000-00-00 00:00:00',1),
(6,'Centimeter','cm','2','2017-02-14 14:32:46','0000-00-00 00:00:00',1),
(7,'Inch','in','2','2017-02-14 14:33:24','0000-00-00 00:00:00',1),
(8,'Metre','m','2','2017-02-14 14:32:46','0000-00-00 00:00:00',1),
(9,'Millimeter','mm','3','2017-02-14 14:32:46','0000-00-00 00:00:00',1),
(10,'Centimeter','cm','3','2017-02-14 14:32:46','0000-00-00 00:00:00',1),
(11,'Inch','in','3','2017-02-14 14:33:24','0000-00-00 00:00:00',1),
(12,'Metre','m','3','2017-02-14 14:32:46','0000-00-00 00:00:00',1),
(13,'Gauge','ga.','4','2017-02-14 14:29:04','0000-00-00 00:00:00',1),
(14,'Millimeter','mm','4','2017-02-14 14:32:46','0000-00-00 00:00:00',1),
(15,'Gram','g','5','2017-02-14 14:30:05','0000-00-00 00:00:00',1),
(16,'Killogram','kg','5','2017-02-14 14:33:24','0000-00-00 00:00:00',1),
(17,'Pounds','lbs','5','2017-02-14 14:30:40','0000-00-00 00:00:00',1),
(18,'Millilitre','ml','6','2017-02-14 14:32:46','0000-00-00 00:00:00',1),
(19,'Litre','l','6','2017-02-14 14:33:24','0000-00-00 00:00:00',1);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(256) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`password`,`remember_token`,`created_at`,`updated_at`) values 
(1,'Administrator','admin@mystocks.in','$2y$10$Qejw6z28yglHBhlEptYza.nknGlas7ETS7uLoJnRmmpOIjtFVHydm','AKnL19lclwsWkC8Ii6nRCr3ZD398hnqBCO0GPQP7did4bs6NYQKv0M6peooJ','2017-02-14 06:16:31','2017-02-14 06:16:31');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
