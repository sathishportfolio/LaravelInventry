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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `category_details` */

/*Table structure for table `category_units_masters` */

DROP TABLE IF EXISTS `category_units_masters`;

CREATE TABLE `category_units_masters` (
  `cu_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `measure_id` int(11) NOT NULL,
  `uom_id` int(11) DEFAULT NULL,
  `value` double(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`cu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `category_units_masters` */

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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(16,'2014_10_12_000000_create_users_table',1),
(17,'2014_10_12_100000_create_password_resets_table',1),
(18,'2017_02_06_090059_create_category_details_table',1),
(19,'2017_02_06_090059_create_customer_details_table',1),
(20,'2017_02_06_090059_create_stock_details_table',1),
(21,'2017_02_06_090059_create_stock_sales_table',1),
(22,'2017_02_06_090059_create_stock_user_table',1),
(23,'2017_02_06_090059_create_store_details_table',1),
(24,'2017_02_06_090059_create_supplier_details_table',1),
(25,'2017_02_06_090059_create_transactions_table',1),
(26,'2017_02_06_090059_create_uom_details_table',1),
(27,'2017_02_07_102728_CreatePurchaseDetailsTable',1),
(28,'2017_02_07_125317_create_sales_details_table',1),
(29,'2017_02_14_090631_create_unit_of_measures_master_table',1),
(30,'2017_02_14_103137_create_category_units_masters_table',1);

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

/*Table structure for table `purchase_details` */

DROP TABLE IF EXISTS `purchase_details`;

CREATE TABLE `purchase_details` (
  `purchase_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `stock_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `supplier_address` varchar(260) NOT NULL,
  `supplier_contact1` bigint(20) NOT NULL,
  `opening_due` double(10,2) unsigned NOT NULL,
  `opening_balance` double(10,2) unsigned NOT NULL,
  `purchase_quantity` int(10) unsigned NOT NULL,
  `purchase_total` double(10,2) unsigned NOT NULL,
  `purchase_cost` double(10,2) unsigned NOT NULL,
  `selling_cost` double(10,2) unsigned NOT NULL,
  `opening_stock` int(10) unsigned NOT NULL,
  `closing_stock` int(10) unsigned NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `grand_total` double(10,2) unsigned NOT NULL,
  `payment` double(10,2) unsigned NOT NULL,
  `closing_due` double(10,2) unsigned NOT NULL,
  `closing_balance` double(10,2) unsigned NOT NULL,
  `mode` tinyint(1) NOT NULL,
  `billnumber` varchar(120) DEFAULT NULL,
  `billdate` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`purchase_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `purchase_details` */

/*Table structure for table `sales_details` */

DROP TABLE IF EXISTS `sales_details`;

CREATE TABLE `sales_details` (
  `sales_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `stock_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_address` varchar(260) NOT NULL,
  `customer_contact1` bigint(20) NOT NULL,
  `opening_balance` double(10,2) unsigned NOT NULL,
  `opening_due` double(10,2) unsigned NOT NULL,
  `sales_quantity` int(10) unsigned NOT NULL,
  `price` double(10,2) unsigned NOT NULL,
  `sales_total` double(10,2) unsigned NOT NULL,
  `opening_stock` int(10) unsigned NOT NULL,
  `closing_stock` int(10) unsigned NOT NULL,
  `discount_percent` double(10,2) unsigned NOT NULL,
  `discount_amount` double(10,2) unsigned NOT NULL,
  `tax_description` varchar(255) DEFAULT NULL,
  `tax_percent` double(10,2) unsigned NOT NULL,
  `tax_amount` double(10,2) unsigned NOT NULL,
  `sales_description` varchar(255) DEFAULT NULL,
  `grand_total` double(10,2) unsigned NOT NULL,
  `payment` double(10,2) unsigned NOT NULL,
  `closing_balance` double(10,2) unsigned NOT NULL,
  `closing_due` double(10,2) unsigned NOT NULL,
  `mode` tinyint(1) NOT NULL,
  `billnumber` varchar(120) DEFAULT NULL,
  `billdate` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`sales_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sales_details` */

/*Table structure for table `stock_details` */

DROP TABLE IF EXISTS `stock_details`;

CREATE TABLE `stock_details` (
  `stock_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `stock_name` varchar(120) NOT NULL,
  `category_id` int(11) NOT NULL,
  `purchase_cost` double unsigned DEFAULT NULL,
  `selling_cost` double unsigned DEFAULT NULL,
  `supplier_id` int(10) unsigned NOT NULL,
  `stock_quantity` int(10) unsigned NOT NULL DEFAULT '0',
  `measuring_units` varchar(120) DEFAULT NULL,
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

/*Table structure for table `stock_units_details` */

DROP TABLE IF EXISTS `stock_units_details`;

CREATE TABLE `stock_units_details` (
  `sud_id` int(11) NOT NULL AUTO_INCREMENT,
  `stock_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `measure_id` int(11) DEFAULT NULL,
  `uom_id` int(11) DEFAULT NULL,
  `value` double(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`sud_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `stock_units_details` */

insert  into `stock_units_details`(`sud_id`,`stock_id`,`category_id`,`measure_id`,`uom_id`,`value`,`created_at`,`updated_at`,`status`) values 
(1,1,3,1,3,10.00,'2017-02-15 10:01:24','0000-00-00 00:00:00',NULL),
(2,1,3,2,7,10.00,'2017-02-15 10:01:24','0000-00-00 00:00:00',NULL),
(3,1,3,4,13,2.00,'2017-02-15 10:01:24','0000-00-00 00:00:00',NULL),
(4,2,3,1,3,20.00,'2017-02-15 10:02:01','0000-00-00 00:00:00',NULL),
(5,2,3,2,7,20.00,'2017-02-15 10:02:01','0000-00-00 00:00:00',NULL),
(6,2,3,4,13,2.00,'2017-02-15 10:02:01','0000-00-00 00:00:00',NULL),
(7,3,3,1,3,30.00,'2017-02-15 10:03:14','0000-00-00 00:00:00',NULL),
(8,3,3,2,7,30.00,'2017-02-15 10:03:14','0000-00-00 00:00:00',NULL),
(9,3,3,4,13,2.00,'2017-02-15 10:03:14','0000-00-00 00:00:00',NULL),
(10,4,2,6,18,500.00,'2017-02-15 10:57:15','0000-00-00 00:00:00',NULL),
(11,5,3,1,3,200.00,'2017-02-16 05:48:12','0000-00-00 00:00:00',NULL),
(12,5,3,2,7,100.00,'2017-02-16 05:48:12','0000-00-00 00:00:00',NULL),
(13,5,3,4,13,2.00,'2017-02-16 05:48:12','0000-00-00 00:00:00',NULL);

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
  `name` varchar(16) DEFAULT NULL,
  `symbol` varchar(8) DEFAULT NULL,
  `measure_id` varchar(16) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`uom_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `unit_of_measures_master` */

/*Table structure for table `uom_details` */

DROP TABLE IF EXISTS `uom_details`;

CREATE TABLE `uom_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `spec` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `uom_details` */

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `users` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
