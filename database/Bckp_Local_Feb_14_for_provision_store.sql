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
  `category_description` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `category_details` */

insert  into `category_details`(`id`,`category_name`,`category_description`) values 
(1,'Beverages ','coffee/tea, juice, soda'),
(2,'Bread/Bakery ','sandwich loaves, dinner rolls, tortillas, bagels'),
(3,'Canned/Jarred ','vegetables, spaghetti sauce, ketchup'),
(4,'Dairy ','cheeses, eggs, milk, yogurt, butter'),
(5,'Dry/Baking ','cereals, flour, sugar, pasta, mixes'),
(6,'Frozen ','waffles, vegetables, individual meals, ice cream'),
(7,'Meat ','lunch meat, poultry, beef, pork'),
(8,'Produce ','fruits, vegetables'),
(9,'Cleaners ','purpose, laundry detergent, dishwashing liquid/detergent'),
(10,'Paper ','paper towels, toilet paper, aluminum foil, sandwich bags'),
(11,'Personal ','shampoo, soap, hand soap, shaving cream'),
(12,'Other ','baby items, pet items, batteries, greeting cards');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `customer_details` */

insert  into `customer_details`(`id`,`customer_name`,`customer_email`,`customer_address`,`customer_contact1`,`customer_contact2`,`balance`,`due`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'srivas','srivas@gmail.com','address1',9654659875,9654659875,0,220,'2017-02-08 12:39:57','2017-02-13 05:57:59',NULL),
(2,'edwin','edwin@gmail.com','address1',9654659875,9654659875,0,0,'2017-02-08 12:39:57',NULL,NULL),
(3,'srinivas','srini@gmail.com','address1',9654659875,9654659875,0,322,'2017-02-08 12:39:57','2017-02-14 05:36:02',NULL),
(4,'Deva','deva@gmial.com','Chennai',9635465465,8015383230,0,0,'2017-02-14 05:25:28','2017-02-14 05:25:28',NULL);

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(256) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=170 DEFAULT CHARSET=utf8;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(157,'2014_10_12_000000_create_users_table',1),
(158,'2014_10_12_100000_create_password_resets_table',1),
(159,'2017_02_06_090059_create_category_details_table',1),
(160,'2017_02_06_090059_create_customer_details_table',1),
(161,'2017_02_06_090059_create_stock_details_table',1),
(162,'2017_02_06_090059_create_stock_sales_table',1),
(163,'2017_02_06_090059_create_stock_user_table',1),
(164,'2017_02_06_090059_create_store_details_table',1),
(165,'2017_02_06_090059_create_supplier_details_table',1),
(166,'2017_02_06_090059_create_transactions_table',1),
(167,'2017_02_06_090059_create_uom_details_table',1),
(168,'2017_02_07_102728_CreatePurchaseDetailsTable',1),
(169,'2017_02_07_125317_create_sales_details_table',1);

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

/*Data for the table `purchase_details` */

insert  into `purchase_details`(`purchase_id`,`stock_id`,`category_id`,`supplier_id`,`supplier_address`,`supplier_contact1`,`opening_due`,`opening_balance`,`purchase_quantity`,`purchase_total`,`purchase_cost`,`selling_cost`,`opening_stock`,`closing_stock`,`description`,`grand_total`,`payment`,`closing_due`,`closing_balance`,`mode`,`billnumber`,`billdate`,`created_at`,`updated_at`,`deleted_at`) values 
(1,3,10,1,'address1',9654659875,265.00,0.00,50,5000.00,100.00,125.00,0,50,'test',5265.00,265.00,5000.00,0.00,2,NULL,NULL,'2017-02-08 12:40:45','2017-02-08 12:40:45',NULL),
(2,1,10,2,'address1',9654659875,698.00,0.00,100,1000.00,10.00,12.00,0,100,NULL,1698.00,698.00,1000.00,0.00,1,NULL,NULL,'2017-02-08 12:41:45','2017-02-08 12:41:45',NULL),
(3,2,10,3,'address1',9654659875,985.00,0.00,250,10000.00,40.00,50.00,0,250,NULL,10985.00,5621.00,5364.00,0.00,1,NULL,NULL,'2017-02-08 12:42:19','2017-02-08 12:42:19',NULL),
(4,4,4,2,'address1',9654659875,1000.00,0.00,50,1250.00,25.00,30.00,0,50,NULL,2250.00,250.00,2000.00,0.00,3,NULL,NULL,'2017-02-08 12:49:26','2017-02-08 12:49:26',NULL),
(5,4,4,2,'address1',9654659875,2000.00,0.00,25,625.00,25.00,30.00,25,50,'test',2625.00,625.00,2000.00,0.00,1,NULL,NULL,'2017-02-13 05:32:45','2017-02-13 05:32:45',NULL),
(6,3,10,1,'address1',9654659875,5000.00,0.00,100,10000.00,100.00,125.00,40,140,NULL,15000.00,10000.00,5000.00,0.00,1,NULL,NULL,'2017-02-13 05:33:48','2017-02-13 05:33:48',NULL),
(7,4,4,2,'address1',9654659875,2000.00,0.00,50,1250.00,25.00,30.00,50,100,NULL,3250.00,3000.00,250.00,0.00,1,NULL,NULL,'2017-02-13 05:35:07','2017-02-13 05:35:07',NULL),
(8,10,4,2,'address1',9654659875,250.00,0.00,17,680.00,40.00,46.00,0,17,NULL,930.00,0.00,930.00,0.00,1,NULL,NULL,'2017-02-13 06:07:10','2017-02-13 06:07:10',NULL),
(9,9,4,1,'address1',9654659875,5000.00,0.00,56,4760.00,85.00,96.00,0,56,NULL,9760.00,0.00,9760.00,0.00,1,NULL,NULL,'2017-02-13 06:07:35','2017-02-13 06:07:35',NULL),
(10,5,10,3,'address1',9654659875,5364.00,0.00,20,240.00,12.00,15.00,0,20,NULL,5604.00,5000.00,604.00,0.00,1,NULL,NULL,'2017-02-13 06:08:10','2017-02-13 06:08:10',NULL),
(11,6,4,1,'address1',9654659875,9760.00,0.00,40,2800.00,70.00,85.00,0,40,NULL,12560.00,10000.00,2560.00,0.00,1,NULL,NULL,'2017-02-13 06:08:43','2017-02-13 06:08:43',NULL),
(12,7,4,1,'address1',9654659875,2560.00,0.00,42,3108.00,74.00,90.00,0,42,NULL,5668.00,3000.00,2668.00,0.00,1,NULL,NULL,'2017-02-13 06:09:36','2017-02-13 06:09:36',NULL),
(13,11,4,2,'address1',9654659875,930.00,0.00,34,340.00,10.00,20.00,0,34,NULL,1270.00,270.00,1000.00,0.00,1,NULL,NULL,'2017-02-13 06:10:06','2017-02-13 06:10:06',NULL),
(14,8,4,3,'address1',9654659875,604.00,0.00,34,1904.00,56.00,70.00,0,34,NULL,2508.00,2000.00,508.00,0.00,1,NULL,NULL,'2017-02-13 06:10:56','2017-02-13 06:10:56',NULL),
(15,12,4,3,'address1',9654659875,508.00,0.00,16,320.00,20.00,25.00,0,16,NULL,828.00,500.00,328.00,0.00,1,NULL,NULL,'2017-02-13 06:11:42','2017-02-13 06:11:42',NULL),
(16,3,10,2,'address1',9654659875,1000.00,0.00,20,2000.00,100.00,125.00,50,70,NULL,3000.00,1000.00,2000.00,0.00,1,NULL,NULL,'2017-02-13 16:20:17','2017-02-13 16:20:17',NULL),
(17,13,9,3,'address1',9654659875,328.00,0.00,20,300.00,15.00,20.00,0,20,NULL,628.00,500.00,128.00,0.00,2,NULL,NULL,'2017-02-14 05:31:06','2017-02-14 05:31:06',NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `sales_details` */

insert  into `sales_details`(`sales_id`,`stock_id`,`category_id`,`customer_id`,`customer_address`,`customer_contact1`,`opening_balance`,`opening_due`,`sales_quantity`,`price`,`sales_total`,`opening_stock`,`closing_stock`,`discount_percent`,`discount_amount`,`tax_description`,`tax_percent`,`tax_amount`,`sales_description`,`grand_total`,`payment`,`closing_balance`,`closing_due`,`mode`,`billnumber`,`billdate`,`created_at`,`updated_at`,`deleted_at`) values 
(1,2,10,1,'address1',9654659875,0.00,0.00,20,50.00,1000.00,250,230,5.00,50.00,'test',2.00,20.00,'test',970.00,500.00,0.00,470.00,1,NULL,NULL,'2017-02-08 12:45:01','2017-02-08 12:45:01',NULL),
(2,4,4,3,'address1',9654659875,0.00,0.00,25,30.00,750.00,50,25,5.00,37.00,'ghjghgjh',2.00,15.00,NULL,728.00,500.00,0.00,228.00,1,NULL,NULL,'2017-02-08 12:50:20','2017-02-08 12:50:20',NULL),
(3,3,10,3,'address1',9654659875,0.00,228.00,10,125.00,1250.00,50,40,2.00,25.00,NULL,1.00,12.00,NULL,1465.00,1400.00,0.00,65.00,1,NULL,NULL,'2017-02-09 08:56:20','2017-02-09 08:56:20',NULL),
(4,3,10,1,'address1',9654659875,0.00,470.00,40,125.00,5000.00,140,100,10.00,500.00,'Prof.Tax',5.00,250.00,'test',5220.00,5000.00,0.00,220.00,1,NULL,NULL,'2017-02-13 05:57:58','2017-02-13 05:57:58',NULL),
(5,3,10,3,'address1',9654659875,0.00,65.00,50,125.00,6250.00,100,50,5.00,312.00,NULL,10.00,625.00,NULL,6628.00,6000.00,0.00,628.00,1,NULL,NULL,'2017-02-13 16:18:46','2017-02-13 16:18:46',NULL),
(6,13,9,3,'address1',9654659875,0.00,628.00,10,20.00,200.00,20,10,5.00,10.00,'Prof.Tax',2.00,4.00,NULL,822.00,500.00,0.00,322.00,2,NULL,NULL,'2017-02-14 05:36:01','2017-02-14 05:36:01',NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `stock_details` */

insert  into `stock_details`(`stock_id`,`stock_name`,`category_id`,`purchase_cost`,`selling_cost`,`supplier_id`,`stock_quantity`,`uom`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Cello Fine Grip',10,10,12,'1',100,NULL,'2017-02-07 09:25:23','2017-02-08 12:41:46',NULL),
(2,'Hero',10,40,50,'1',230,NULL,'2017-02-07 09:25:23','2017-02-08 12:45:03',NULL),
(3,'Parker',10,100,125,'1',70,NULL,'2017-02-07 09:25:23','2017-02-13 16:20:18',NULL),
(4,'Milk',4,25,30,'1',100,NULL,'2017-02-08 12:48:15','2017-02-13 05:35:08',NULL),
(5,'Fingergrip',10,12,15,'1',20,NULL,'2017-02-13 06:02:17','2017-02-13 06:08:11',NULL),
(6,'Cheese',4,70,85,'2',40,NULL,'2017-02-13 06:03:33','2017-02-13 06:08:44',NULL),
(7,'Butter',4,74,90,'3',42,NULL,'2017-02-13 06:03:59','2017-02-13 06:09:37',NULL),
(8,'Tofu',4,56,70,'1',34,NULL,'2017-02-13 06:04:20','2017-02-13 06:10:57',NULL),
(9,'Paneer',4,85,96,'2',56,NULL,'2017-02-13 06:04:40','2017-02-13 06:07:36',NULL),
(10,'Ghee',4,40,46,'3',17,NULL,'2017-02-13 06:05:07','2017-02-13 06:07:11',NULL),
(11,'Curd',4,10,20,'1',34,NULL,'2017-02-13 06:05:54','2017-02-13 06:10:07',NULL),
(12,'Yogurd',4,20,25,'3',16,NULL,'2017-02-13 06:06:18','2017-02-13 06:11:43',NULL),
(13,'Vim washing bar',9,15,20,'3',10,NULL,'2017-02-14 05:28:54','2017-02-14 05:36:02',NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `supplier_details` */

insert  into `supplier_details`(`id`,`supplier_name`,`supplier_email`,`supplier_address`,`supplier_contact1`,`supplier_contact2`,`balance`,`due`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'arun','arun@gmail.com','address1','9654659875','9654659875',0,2668,'2017-02-08 12:39:57','2017-02-13 06:09:37',NULL),
(2,'bharath','bharath@gmail.com','address1','9654659875','9654659875',0,2000,'2017-02-08 12:39:57','2017-02-13 16:20:18',NULL),
(3,'Chandru','srini@gmail.com','address1','9654659875','9654659875',0,128,'2017-02-08 12:39:57','2017-02-14 05:31:07',NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

/*Data for the table `transactions` */

insert  into `transactions`(`id`,`type`,`sales_id`,`purchase_id`,`customer_id`,`supplier_id`,`subtotal`,`payment`,`mode`,`balance`,`due`,`created_at`,`updated_at`,`deleted_at`) values 
(1,1,NULL,1,NULL,1,5265.00,265.00,2,0.00,5000.00,'2017-02-08 12:40:47','2017-02-08 12:40:47',NULL),
(2,1,NULL,2,NULL,2,1698.00,698.00,1,0.00,1000.00,'2017-02-08 12:41:46','2017-02-08 12:41:46',NULL),
(3,1,NULL,3,NULL,3,10985.00,5621.00,1,0.00,5364.00,'2017-02-08 12:42:20','2017-02-08 12:42:20',NULL),
(4,2,1,NULL,1,NULL,970.00,500.00,1,0.00,470.00,'2017-02-08 12:45:03','2017-02-08 12:45:03',NULL),
(5,1,NULL,4,NULL,2,2250.00,250.00,3,0.00,2000.00,'2017-02-08 12:49:28','2017-02-08 12:49:28',NULL),
(6,2,2,NULL,3,NULL,728.00,500.00,1,0.00,228.00,'2017-02-08 12:50:22','2017-02-08 12:50:22',NULL),
(7,2,3,NULL,3,NULL,1465.00,1400.00,1,0.00,65.00,'2017-02-09 08:56:21','2017-02-09 08:56:21',NULL),
(8,1,NULL,5,NULL,2,2625.00,625.00,1,0.00,2000.00,'2017-02-13 05:32:46','2017-02-13 05:32:46',NULL),
(9,1,NULL,6,NULL,1,15000.00,10000.00,1,0.00,5000.00,'2017-02-13 05:33:49','2017-02-13 05:33:49',NULL),
(10,1,NULL,7,NULL,2,3250.00,3000.00,1,0.00,250.00,'2017-02-13 05:35:08','2017-02-13 05:35:08',NULL),
(11,2,4,NULL,1,NULL,5220.00,5000.00,1,0.00,220.00,'2017-02-13 05:57:59','2017-02-13 05:57:59',NULL),
(12,1,NULL,8,NULL,2,930.00,0.00,1,0.00,930.00,'2017-02-13 06:07:11','2017-02-13 06:07:11',NULL),
(13,1,NULL,9,NULL,1,9760.00,0.00,1,0.00,9760.00,'2017-02-13 06:07:36','2017-02-13 06:07:36',NULL),
(14,1,NULL,10,NULL,3,5604.00,5000.00,1,0.00,604.00,'2017-02-13 06:08:11','2017-02-13 06:08:11',NULL),
(15,1,NULL,11,NULL,1,12560.00,10000.00,1,0.00,2560.00,'2017-02-13 06:08:44','2017-02-13 06:08:44',NULL),
(16,1,NULL,12,NULL,1,5668.00,3000.00,1,0.00,2668.00,'2017-02-13 06:09:37','2017-02-13 06:09:37',NULL),
(17,1,NULL,13,NULL,2,1270.00,270.00,1,0.00,1000.00,'2017-02-13 06:10:07','2017-02-13 06:10:07',NULL),
(18,1,NULL,14,NULL,3,2508.00,2000.00,1,0.00,508.00,'2017-02-13 06:10:57','2017-02-13 06:10:57',NULL),
(19,1,NULL,15,NULL,3,828.00,500.00,1,0.00,328.00,'2017-02-13 06:11:43','2017-02-13 06:11:43',NULL),
(20,2,5,NULL,3,NULL,6628.00,6000.00,1,0.00,628.00,'2017-02-13 16:18:47','2017-02-13 16:18:47',NULL),
(21,1,NULL,16,NULL,2,3000.00,1000.00,1,0.00,2000.00,'2017-02-13 16:20:19','2017-02-13 16:20:19',NULL),
(22,1,NULL,17,NULL,3,628.00,500.00,2,0.00,128.00,'2017-02-14 05:31:07','2017-02-14 05:31:07',NULL),
(23,2,6,NULL,3,NULL,822.00,500.00,2,0.00,322.00,'2017-02-14 05:36:02','2017-02-14 05:36:02',NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`password`,`remember_token`,`created_at`,`updated_at`) values 
(1,'Administrator','admin@mystocks.in','$2y$10$RIYUsciRV01n/ruJf5l0.Oh6095jlxK91zk7iUFl5mUWR0D6ZfPxS','Y0klRzCznoewhYiFF5mU1xM3IHfOTr0TCBgTu9X4XArcgbM3nMjvn4XBVqHS','2017-02-08 12:39:57','2017-02-08 12:39:57');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
