-- MySQL dump 10.15  Distrib 10.0.34-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: phanvantam_shop
-- ------------------------------------------------------
-- Server version	10.0.34-MariaDB

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
-- Table structure for table `tbl_category`
--

DROP TABLE IF EXISTS `tbl_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_category` (
  `cat_id` int(5) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `parent_id` int(5) NOT NULL DEFAULT '0',
  `type` int(1) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '2',
  `create_at` int(10) NOT NULL,
  `create_by` int(1) NOT NULL,
  `modify_at` int(11) NOT NULL,
  `modify_by` int(11) NOT NULL,
  PRIMARY KEY (`cat_id`),
  KEY `create_by` (`create_by`),
  KEY `modify_by` (`modify_by`),
  CONSTRAINT `tbl_category_ibfk_1` FOREIGN KEY (`modify_by`) REFERENCES `tbl_user` (`user_id`),
  CONSTRAINT `tbl_category_ibfk_2` FOREIGN KEY (`create_by`) REFERENCES `tbl_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_category`
--

LOCK TABLES `tbl_category` WRITE;
/*!40000 ALTER TABLE `tbl_category` DISABLE KEYS */;
INSERT INTO `tbl_category` (`cat_id`, `title`, `slug`, `parent_id`, `type`, `active`, `create_at`, `create_by`, `modify_at`, `modify_by`) VALUES (10,'Điện thoại','dien-thoai',0,2,1,1512296644,1,1513937169,1),(11,'Điện thoại iPhone','dien-thoai-iphone',10,2,1,1512614886,1,1513062151,1),(12,'Máy tính','may-tinh',0,2,1,1513096449,1,1513096449,1),(13,'Công nghệ','cong-nghe',0,1,1,1513183416,1,1513936783,1),(14,'Tin tức','tin-tuc',13,1,1,1513183490,1,1513936639,1),(15,'Điện thoại OPPO','dien-thoai-oppo',10,2,1,1513254068,1,1513254779,1);
/*!40000 ALTER TABLE `tbl_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_customer`
--

DROP TABLE IF EXISTS `tbl_customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `address` varchar(200) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `phone` varchar(12) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `buy` int(1) NOT NULL DEFAULT '0',
  `code_active` varchar(32) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_vietnamese_ci,
  `subcribe` int(1) NOT NULL DEFAULT '0',
  `create_at` int(11) NOT NULL,
  PRIMARY KEY (`customer_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_customer`
--

LOCK TABLES `tbl_customer` WRITE;
/*!40000 ALTER TABLE `tbl_customer` DISABLE KEYS */;
INSERT INTO `tbl_customer` (`customer_id`, `fullname`, `email`, `address`, `phone`, `buy`, `code_active`, `note`, `subcribe`, `create_at`) VALUES (7,'Phan Văn Huy','phantam.t10@gmail.co','Tân Yên - Bắc Giang ','01656788365',1,'','',1,1513859014),(8,'Phan Văn Tâm   ','phantam.t10@gmail.com','Phú Đô - Nam Từ Liêm - Hà Nội','01656788365',0,'','',1,1515571390),(9,NULL,'vuvanxuan195@gmail.com',NULL,NULL,0,'3772facf7eaae060c1a23f5dc62cdcde',NULL,0,0);
/*!40000 ALTER TABLE `tbl_customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_detail_order`
--

DROP TABLE IF EXISTS `tbl_detail_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_detail_order` (
  `detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `connect_product` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  PRIMARY KEY (`detail_id`),
  KEY `oreder_id` (`order_id`),
  CONSTRAINT `tbl_detail_order_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `tbl_order` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_detail_order`
--

LOCK TABLES `tbl_detail_order` WRITE;
/*!40000 ALTER TABLE `tbl_detail_order` DISABLE KEYS */;
INSERT INTO `tbl_detail_order` (`detail_id`, `name`, `price`, `qty`, `total_price`, `connect_product`, `order_id`) VALUES (85,'Laptop HP Probook 440 G2 LED Backlit',13230000,1,13230000,7,1),(86,'Motorola Moto G5S Plus',6990000,1,6990000,11,2),(87,'Điện thoại iPhone 8 64G',20990000,1,20990000,5,3),(88,'Điện thoại iPhone 8 64G',20990000,2,41980000,5,4),(89,'Laptop HP Probook 440',9000000,1,9000000,6,4),(90,'Laptop HP Probook 440 G2 LED Backlit',13230000,1,13230000,7,5);
/*!40000 ALTER TABLE `tbl_detail_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_filter`
--

DROP TABLE IF EXISTS `tbl_filter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_filter` (
  `filter_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `type` int(1) NOT NULL COMMENT '1=>filter by price .2=> filter by category',
  `max_price` int(11) DEFAULT NULL,
  `min_price` int(11) DEFAULT '0',
  `cat_id` int(11) DEFAULT NULL,
  `create_at` int(12) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '2',
  `create_by` int(11) NOT NULL,
  `modify_at` int(12) NOT NULL,
  `modify_by` int(11) NOT NULL,
  PRIMARY KEY (`filter_id`),
  KEY `cat_id` (`cat_id`),
  KEY `create_by` (`create_by`),
  KEY `modify_by` (`modify_by`),
  CONSTRAINT `tbl_filter_ibfk_1` FOREIGN KEY (`modify_by`) REFERENCES `tbl_user` (`user_id`),
  CONSTRAINT `tbl_filter_ibfk_2` FOREIGN KEY (`create_by`) REFERENCES `tbl_user` (`user_id`),
  CONSTRAINT `tbl_filter_ibfk_3` FOREIGN KEY (`cat_id`) REFERENCES `tbl_category` (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_filter`
--

LOCK TABLES `tbl_filter` WRITE;
/*!40000 ALTER TABLE `tbl_filter` DISABLE KEYS */;
INSERT INTO `tbl_filter` (`filter_id`, `title`, `type`, `max_price`, `min_price`, `cat_id`, `create_at`, `active`, `create_by`, `modify_at`, `modify_by`) VALUES (11,'Từ 1.000.000đ đến 5.000.000đ',1,5000000,1000000,NULL,1512573657,1,1,1515631537,1),(13,'Máy tính',2,NULL,NULL,12,1512573802,1,1,1513361285,1),(14,'Điện thoại',2,NULL,NULL,10,1513137088,1,1,1513937289,1),(22,'Từ 5.000.000 đến 10.000.000',1,10000000,5000000,NULL,1515631367,1,1,1515631367,1),(23,'Từ 10.000.000 đến 15.000.000',1,15000000,10000000,NULL,1515631491,1,1,1515631491,1);
/*!40000 ALTER TABLE `tbl_filter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_history`
--

DROP TABLE IF EXISTS `tbl_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_history` (
  `history_id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(200) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `type` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `happen_at` int(11) NOT NULL,
  PRIMARY KEY (`history_id`)
) ENGINE=InnoDB AUTO_INCREMENT=237 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_history`
--

LOCK TABLES `tbl_history` WRITE;
/*!40000 ALTER TABLE `tbl_history` DISABLE KEYS */;
INSERT INTO `tbl_history` (`history_id`, `content`, `type`, `user_id`, `parent_id`, `happen_at`) VALUES (13,NULL,'login',1,0,1513650734),(15,NULL,'login',1,0,1513656051),(16,NULL,'login',3,0,1513668415),(17,NULL,'login',1,0,1513668427),(18,NULL,'login',3,0,1513668689),(19,NULL,'login',1,0,1513677246),(20,NULL,'login',1,0,1513692663),(21,NULL,'login',3,0,1513697524),(22,NULL,'login',1,0,1513753441),(23,NULL,'login',1,0,1513764499),(24,NULL,'login',1,0,1513778611),(25,NULL,'login',1,0,1513836712),(26,NULL,'login',1,0,1513913535),(27,NULL,'login',1,0,1513929267),(29,'Xóa thành công Menu : Máy tính.Tạo ngày 18/12/2017','drop',1,27,1513933597),(30,'Xóa thành công Menu : Trang chủ.Tạo ngày 20/12/2017','drop',1,27,1513933604),(31,'Xóa thành công Menu : Liên hệ.Tạo ngày 07/12/2017','drop',1,27,1513933612),(32,'Xóa thành công Menu : Hôm nay.Tạo ngày 07/12/2017','drop',1,27,1513933617),(33,'Xóa thành công Menu : Trang chủ.Tạo ngày 07/12/2017','drop',1,27,1513933627),(34,'Cập nhập thành công Menu : Điện thoại','edit',1,27,1513933827),(35,'Thêm thành công Menu : Liên ','add',1,27,1513933891),(37,'Đã đưa trang : Why do we use it vào thùng rác ','edit',1,27,1513935078),(38,'Đã cập nhập danh mục : Công nghệ','edit',1,27,1513936783),(39,'Xóa thành công danh mục : \"dxc\" .Được tạo lúc ','drop',1,27,1513937025),(40,'Đã cập nhập danh mục : Điện thoại','edit',1,27,1513937169),(41,'Đã đưa bộ lọc :  vào thùng rác ','drop',1,27,1513937707),(42,'Đã đưa bộ lọc : Máy tính vào thùng rác ','drop',1,27,1513937758),(43,'Đã đưa bộ lọc : 1.000.000đ - 2.000.000đ vào thùng rác ','drop',1,27,1513937896),(44,'Đã đưa bộ lọc : Điện thoại vào thùng rác ','drop',1,27,1513937913),(45,'Đã đưa bài viết : \' OPPO A83 rò rỉ thông số cấu hình sử dụng bảo mật khuôn mặt \' vào thùng rác . ','drop',1,27,1513938820),(46,'Cập nhập bài viết : \'\' ','edit',1,27,1513939616),(47,'Cập nhập bài viết : \'\' ','edit',1,27,1513939760),(48,'Cập nhập bài viết : \'\' ','edit',1,27,1513939775),(49,'Cập nhập bài viết : \'Section 11033 of de Finibus Bonorum et Malorum written by Cicero in 45 BC\' ','edit',1,27,1513940140),(50,'Đã đưa bài viết : \' Section 11033 of de Finibus Bonorum et Malorum written by Cicero in 45 BC \' vào thùng rác . ','drop',1,27,1513940246),(51,'Đã xóa bài viết : \' Section 11033 of de Finibus Bonorum et Malorum written by Cicero in 45 BC \' .Được tạo lúc 15/12/2017','drop',1,27,1513940523),(52,NULL,'login',1,0,1513952123),(59,'Đã đưa sản phẩm : \' HTC U Ultra Sapphire \' vào thùng rác ','drop',1,52,1513953013),(60,'Đã đưa sản phẩm : \' Sony Xperia XA Ultra \' vào thùng rác ','drop',1,52,1513953132),(61,'Đã đưa sản phẩm : \' HTC U Ultra Sapphire \' vào thùng rác ','drop',1,52,1513953154),(62,'Đã đưa sản phẩm : \' Huawei Nova 2i \' vào thùng rác ','drop',1,52,1513953154),(63,'Đã đưa sản phẩm : \' Sony Xperia XA Ultra \' vào thùng rác ','drop',1,52,1513953154),(64,'Cập nhập bài viết : \'OPPO A83 rò rỉ thông số cấu hình sử dụng bảo mật khuôn mặt\' ','edit',1,52,1513953229),(65,NULL,'login',1,0,1513956365),(66,NULL,'login',5,0,1513956397),(67,NULL,'login',1,0,1513956622),(68,NULL,'login',5,0,1513958288),(69,NULL,'login',1,0,1513958323),(70,NULL,'login',1,0,1513958358),(71,NULL,'login',5,0,1513959731),(72,'Thêm bài viết : \'Điện thoại cơ bản hỗ trợ 4G của Nokia vừa đạt chứng nhận Bluetooth\' ','add',5,71,1513960290),(73,'Cập nhập bài viết : \'Điện thoại cơ bản hỗ trợ 4G của Nokia vừa đạt chứng nhận Bluetooth\' ','edit',5,71,1513960503),(74,NULL,'login',1,0,1513961181),(75,NULL,'login',6,0,1513961220),(76,NULL,'login',6,0,1513963303),(78,NULL,'login',1,0,1514029783),(79,NULL,'login',1,0,1514100289),(80,NULL,'login',1,0,1514711516),(81,NULL,'login',1,0,1514711519),(82,NULL,'login',1,0,1514711520),(83,NULL,'login',1,0,1514711522),(84,NULL,'login',1,0,1514711682),(85,NULL,'login',1,0,1514727512),(87,'Đã đưa bài viết : \' Điện thoại cơ bản hỗ trợ 4G của Nokia vừa đạt chứng nhận Bluetooth \' vào thùng rác . ','drop',1,85,1514734871),(88,'Đã đưa bài viết : \' OPPO A83 rò rỉ thông số cấu hình sử dụng bảo mật khuôn mặt \' vào thùng rác . ','drop',1,85,1514735072),(89,'Đã đưa bài viết : \' Điện thoại cơ bản hỗ trợ 4G của Nokia vừa đạt chứng nhận Bluetooth \' vào thùng rác . ','drop',1,85,1514735072),(90,'Đã đưa sản phẩm : \' Sony Xperia XA Ultra \' vào thùng rác ','drop',1,85,1514738148),(92,'Đã đưa sản phẩm : \' Huawei Nova 2i \' vào thùng rác ','drop',1,85,1514738243),(93,'Đã đưa sản phẩm : \' Sony Xperia XA Ultra \' vào thùng rác ','drop',1,85,1514738243),(94,'Đã đưa sản phẩm : \' Samsung Galaxy A5 \' vào thùng rác ','drop',1,85,1514738243),(95,'Đã đưa sản phẩm : \' Motorola Moto G5S Plus \' vào thùng rác ','drop',1,85,1514738243),(96,'Đã đưa sản phẩm : \' Laptop HP Probook 440 \' vào thùng rác ','drop',1,85,1514738243),(97,'Đã đưa sản phẩm : \' Laptop HP Probook 440 G2 LED \' vào thùng rác ','drop',1,85,1514738243),(98,'Đã đưa sản phẩm : \' Laptop HP Probook 440 G2 LED Backlit \' vào thùng rác ','drop',1,85,1514738243),(99,'Đã đưa sản phẩm : \' Laptop HP Probook 440 \' vào thùng rác ','drop',1,85,1514738243),(100,'Đã đưa sản phẩm : \' Điện thoại iPhone 8 64G \' vào thùng rác ','drop',1,85,1514738243),(101,NULL,'login',1,0,1514768070),(102,NULL,'login',1,0,1514773453),(103,'Đã đưa bộ lọc : Điện thoại vào thùng rác ','drop',1,102,1514775818),(104,'Đã đưa bộ lọc : Điện thoại vào thùng rác ','drop',1,102,1514775857),(105,NULL,'login',5,0,1514793340),(106,NULL,'login',1,0,1514944058),(107,NULL,'login',1,0,1515196489),(108,NULL,'login',1,0,1515229584),(109,NULL,'login',1,0,1515574108),(110,'Cập nhập thành công Menu : Điện thoại','edit',1,109,1515574979),(111,'Cập nhập thành công Menu : Điện thoại iPhone','edit',1,109,1515574982),(112,NULL,'login',1,0,1515583589),(113,NULL,'login',1,0,1515583589),(114,'Cập nhập thành công Menu : Điện thoại','edit',1,113,1515583694),(115,'Cập nhập thành công Menu : Điện thoại iPhone','edit',1,113,1515583735),(116,'Thêm thành công Menu : Tablet','add',1,113,1515584687),(117,'Cập nhập thành công Menu : Tablet','edit',1,113,1515584764),(118,'Xóa thành công Menu : Liên .Tạo ngày 22/12/2017','drop',1,113,1515584778),(119,'Thêm thành công Menu : Điện thoại','add',1,113,1515584830),(120,'Xóa thành công Menu : Trang chủ.Tạo ngày 15/12/2017','drop',1,113,1515584866),(121,'Thêm thành công Menu : Trang chủ','add',1,113,1515584898),(122,'Thêm thành công Menu : Trang chủ','add',1,113,1515584958),(123,'Thêm thành công Menu : Máy tính','add',1,113,1515585017),(124,'Cập nhập thành công Menu : Trang chủ','edit',1,113,1515585040),(125,'Cập nhập thành công Menu : Điện thoại','edit',1,113,1515585056),(126,'Cập nhập thành công Menu : Máy tính','edit',1,113,1515585064),(127,'Cập nhập thành công Menu : Tablet','edit',1,113,1515585074),(128,'Cập nhập thành công Menu : Tin tức','edit',1,113,1515585082),(129,'Thêm thành công Menu : Tai nghe','add',1,113,1515585611),(130,'Thêm thành công Menu : Tin tức','add',1,113,1515585645),(131,'Thêm thành công Menu : Điện thoại OPPO','add',1,113,1515585696),(132,NULL,'login',1,0,1515627584),(133,'Thêm thành công Menu : Điện thoại','add',1,132,1515627849),(134,'Thêm thành công Menu : Điện thoại OPPO','add',1,132,1515627886),(135,'Thêm thành công Menu : Điện thoại iPhone','add',1,132,1515627981),(136,'Thêm thành công Menu : Máy tính','add',1,132,1515628008),(137,'Thêm thành công Menu : Tablet','add',1,132,1515628036),(138,'Thêm thành công Menu : Tai nghe','add',1,132,1515628065),(139,'Thêm sản phẩm : \' Điện thoại Samsung Galaxy J7 Pro \'','add',1,132,1515629614),(140,'Cập nhập sản phẩm : \' Điện thoại Samsung Galaxy J7 Pro \'','edit',1,132,1515629868),(141,'Cập nhập sản phẩm : \' Điện thoại Samsung Galaxy J7 Pro \'','edit',1,132,1515629925),(142,'Cập nhập sản phẩm : \' HTC U Ultra Sapphire \'','edit',1,132,1515629961),(143,'Cập nhập sản phẩm : \' HTC U Ultra Sapphire \'','edit',1,132,1515630147),(144,'Cập nhập sản phẩm : \' Điện thoại Samsung Galaxy J7 Pro \'','edit',1,132,1515630175),(145,'Đã thêm bộ lọc : Từ 5.000.000 đến 10.000.000','add',1,132,1515631233),(146,'Đã thêm bộ lọc : Từ 5.000.000 đến 10.000.000','add',1,132,1515631256),(147,'Đã thêm bộ lọc : Từ 5.000.000 đến 10.000.000','add',1,132,1515631283),(148,'Đã thêm bộ lọc : Từ 5.000.000 đến 10.000.000','add',1,132,1515631294),(149,'Đã thêm bộ lọc : Từ 5.000.000 đến 10.000.000','add',1,132,1515631296),(150,'Đã thêm bộ lọc : Từ 5.000.000 đến 10.000.000','add',1,132,1515631329),(151,'Đã thêm bộ lọc : Từ 5.000.000 đến 10.000.000','add',1,132,1515631341),(152,'Đã thêm bộ lọc : Từ 5.000.000 đến 10.000.000','add',1,132,1515631367),(153,'Đã đưa bộ lọc : Từ 5.000.000 đến 10.000.000 vào thùng rác ','drop',1,132,1515631374),(154,'Đã đưa bộ lọc : Từ 5.000.000 đến 10.000.000 vào thùng rác ','drop',1,132,1515631399),(155,'Đã xóa bộ lọc : \' Từ 5.000.000 đến 10.000.000 \'.Được tạo lúc 11/01/2018','drop',1,132,1515631408),(156,'Đã thêm bộ lọc : Từ 10.000.000 đến 15.000.000','add',1,132,1515631491),(157,'Đã cập nhập bộ lọc : Từ 1.000.000đ đến 5.000.000đ','edit',1,132,1515631537),(158,NULL,'login',1,0,1515719602),(159,NULL,'login',1,0,1516176171),(160,NULL,'login',5,0,1516759160),(161,NULL,'login',5,0,1517215735),(162,NULL,'login',1,0,1517239025),(163,NULL,'login',1,0,1517302360),(164,NULL,'login',1,0,1517404680),(165,NULL,'login',1,0,1517468288),(166,'Cập nhập sản phẩm : \' Điện thoại Samsung Galaxy J7 Pro \'','edit',1,165,1517468312),(167,NULL,'login',1,0,1517477448),(168,NULL,'login',1,0,1517539383),(169,NULL,'login',1,0,1517547205),(170,NULL,'login',1,0,1517556400),(171,'Thêm thành công Menu : liên hệ','add',1,170,1517560846),(172,'Xóa thành công Menu : liên hệ.Tạo ngày 02/02/2018','drop',1,170,1517561064),(173,NULL,'login',1,0,1517562158),(174,NULL,'login',1,0,1518145602),(175,NULL,'login',1,0,1518178618),(176,NULL,'login',1,0,1519380707),(177,NULL,'login',1,0,1519445955),(178,NULL,'login',1,0,1519614731),(179,NULL,'login',1,0,1519639312),(180,NULL,'login',1,0,1519722931),(199,NULL,'login',1,0,1519831172),(200,'Thêm thành công trang : ggggg','add',1,199,1519836243),(201,'Thêm trang : ggggg','add',1,199,1519836244),(202,'Đã đưa trang : \" ggggg \" vào thùng rác ','edit',1,199,1519836253),(203,'Đã đưa trang : \" ggggg \" vào thùng rác ','edit',1,199,1519836284),(204,'Đã đưa trang : \" ggggg \" vào thùng rác ','edit',1,199,1519836290),(205,NULL,'login',1,0,1519843465),(206,NULL,'login',1,0,1519915330),(207,NULL,'login',1,0,1519976054),(208,'Đã đưa trang : \" Where does it come from \" vào thùng rác ','edit',1,207,1519976100),(209,NULL,'login',1,0,1520007795),(210,NULL,'login',1,0,1520085555),(211,NULL,'login',1,0,1520101378),(212,'Thêm thành công trang : giới thiệu','add',1,211,1520149189),(213,'Thêm trang : giới thiệu','add',1,211,1520149189),(214,'Thêm thành công Menu : abcxyz','add',1,211,1520149283),(215,'Thêm thành công Menu : âsssasas','add',1,211,1520149379),(216,'Xóa thành công Menu : âsssasas.Tạo ngày 04/03/2018','drop',1,211,1520149441),(217,'Xóa thành công Menu : abcxyz.Tạo ngày 04/03/2018','drop',1,211,1520149447),(218,'Thêm thành công Menu : abcxyz','add',1,211,1520149699),(219,'Xóa thành công Menu : abcxyz.Tạo ngày 04/03/2018','drop',1,211,1520149761),(220,'Thêm thành công Menu : abcxyz','add',1,211,1520149777),(221,'Xóa thành công Menu : abcxyz.Tạo ngày 04/03/2018','drop',1,211,1520149821),(222,'Thêm thành công Menu : abcxyz','add',1,211,1520149854),(223,'Xóa thành công Menu : abcxyz.Tạo ngày 04/03/2018','drop',1,211,1520149937),(224,'Thêm thành công Menu : abcxyz','add',1,211,1520149954),(225,'Thêm thành công Menu : về trang chủ','add',1,211,1520151753),(226,'Xóa thành công Menu : về trang chủ.Tạo ngày 04/03/2018','drop',1,211,1520151845),(227,'Xóa thành công Menu : abcxyz.Tạo ngày 04/03/2018','drop',1,211,1520151851),(228,'Thêm thành công Menu : abcxyz','add',1,211,1520156297),(229,'Thêm thành công Menu : âsssasas','add',1,211,1520156346),(230,'Xóa thành công Menu : abcxyz.Tạo ngày 04/03/2018','drop',1,211,1520156409),(231,'Xóa thành công Menu : âsssasas.Tạo ngày 04/03/2018','drop',1,211,1520156414),(232,NULL,'login',1,0,1520181951),(233,'Xóa thành công Menu : Điện thoại OPPO.Tạo ngày 11/01/2018','drop',1,232,1520181982),(234,'Thêm thành công Menu : Điện thoại sam sung','add',1,232,1520182017),(235,NULL,'login',1,0,1520217854),(236,NULL,'login',5,0,1520217880);
/*!40000 ALTER TABLE `tbl_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_media`
--

DROP TABLE IF EXISTS `tbl_media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_media` (
  `media_id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(200) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `caption` varchar(200) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `id_connect` int(11) DEFAULT '0',
  `active` int(1) NOT NULL DEFAULT '2',
  `type` int(1) NOT NULL,
  `create_at` int(11) NOT NULL,
  `create_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`media_id`),
  KEY `id_connect` (`id_connect`),
  KEY `create_by` (`create_by`)
) ENGINE=InnoDB AUTO_INCREMENT=326 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_media`
--

LOCK TABLES `tbl_media` WRITE;
/*!40000 ALTER TABLE `tbl_media` DISABLE KEYS */;
INSERT INTO `tbl_media` (`media_id`, `url`, `title`, `caption`, `id_connect`, `active`, `type`, `create_at`, `create_by`) VALUES (1,'public/images/sytem/post.jpg','Ảnh mặc định cho bài viết',NULL,0,3,3,999999999,1),(2,'public/images/sytem/product.jpg','Ảnh mặc định cho sản phẩm',NULL,0,3,2,999999999,1),(3,'public/images/sytem/avatar.jpg','Ảnh mặc định cho người dùng ','Ảnh mặc định cho người dùng ',0,3,1,11111111,1),(178,'public/images/post/bai1.jpg','bai1','undefined',6,1,2,1512295082,1),(180,'public/images/post/bai3.jpg','bai3','undefined',8,1,2,1512295815,1),(184,'public/images/product/product(copy-1).png','Product','undefined',1,1,3,1512296605,1),(186,'public/images/product/product(copy-5).jpg','Product','undefined',1,1,3,1512296757,1),(216,'public/images/product/product.jpg','Product','undefined',1,1,3,1512446214,1),(220,'public/images/product/product(copy-2).jpg','Product','undefined',1,1,3,1512449268,1),(222,'public/images/product/product(copy-1).jpg','Product','undefined',1,1,3,1512456009,1),(231,'public/images/product/product.png','Product','undefined',1,1,3,1512469668,1),(241,'public/images/avatar/phan-van-khuong(copy-1).png','Phan Văn Khương','undefined',1,1,1,1512844286,1),(250,'public/images/product/slider-250.png','Slider 250','Lễ hội Sam sung trả góp',15,1,3,1512925584,1),(251,'public/images/product/slider-2(copy-1).png','Slider 2','Qùa tặng hấp dẫn từ OPPO',16,1,3,1512990105,1),(252,'public/images/product/dien-thoai-iphone-x-64gb(copy-5).png','Điện thoại iPhone X 64GB','undefined',4,1,3,1513061962,1),(253,'public/images/product/dien-thoai-iphone-x-64gb(copy-4).png','Điện thoại iPhone X 64GB','undefined',4,1,3,1513061969,1),(254,'public/images/product/dien-thoai-iphone-x-64gb(copy-3).png','Điện thoại iPhone X 64GB','undefined',4,1,3,1513061981,1),(255,'public/images/product/dien-thoai-iphone-x-64gb(copy-2).png','Điện thoại iPhone X 64GB','undefined',4,1,3,1513061996,1),(256,'public/images/product/dien-thoai-iphone-x-64gb(copy-1).png','Điện thoại iPhone X 64GB','undefined',4,1,3,1513062005,1),(257,'public/images/product/dien-thoai-iphone-8-64g.png','Điện thoại iPhone 8 64G','undefined',5,1,3,1513062246,1),(258,'public/images/product/dien-thoai-iphone-8-64gb(copy-3).png','Điện thoại iPhone 8 64GB','undefined',5,1,3,1513062264,1),(259,'public/images/product/dien-thoai-iphone-8-64gb(copy-2).png','Điện thoại iPhone 8 64GB','undefined',5,1,3,1513062269,1),(260,'public/images/product/dien-thoai-iphone-8-64gb(copy-1).png','Điện thoại iPhone 8 64GB','undefined',5,1,3,1513062274,1),(261,'public/images/product/mien-phi-van-chuyen(copy-1).png','Miễn phí vận chuyển','undefined',1,1,3,1513100331,1),(265,'public/images/post/oppo-a83-ro-ri-thong-so-cau-hinh-su-dung-bao-mat-khuon-mat(copy-1).png','OPPO A83 rò rỉ thông số cấu hình sử dụng bảo mật khuôn mặt','undefined',1,1,2,1513183552,1),(266,'public/images/product/dien-thoai-iphone-x-64gb(copy-7).png','Điện thoại iPhone X 64GB','undefined',4,1,3,1513353408,1),(267,'public/images/product/dien-thoai-iphone-x-64gb(copy-6).png','Điện thoại iPhone X 64GB','undefined',4,1,3,1513353434,1),(268,'public/images/product/dien-thoai-iphone-x-64gb.png','Điện thoại iPhone X 64GB','undefined',4,1,3,1513353440,1),(273,'public/images/avatar/phan-van-khuong.png','Phan Văn Khương','undefined',1,1,1,1513495703,1),(274,'public/images/product/laptop-hp-probook-440.png','Laptop HP Probook 440','undefined',6,1,3,1513550174,1),(275,'public/images/product/what-is-lorem-ipsum(copy-2).png','What is Lorem Ipsum','undefined',6,1,3,1513550180,1),(276,'public/images/product/what-is-lorem-ipsum(copy-1).png','What is Lorem Ipsum','undefined',6,1,3,1513550190,1),(277,'public/images/product/laptop-hp-probook-440-g2-led-backlit.png','Laptop HP Probook 440 G2 LED Backlit','undefined',7,1,3,1513550830,1),(278,'public/images/product/laptop-hp-probook-440-g2-led-backlit(copy-5).png','Laptop HP Probook 440 G2 LED Backlit','undefined',7,1,3,1513550836,1),(279,'public/images/product/laptop-hp-probook-440-g2-led-backlit(copy-4).png','Laptop HP Probook 440 G2 LED Backlit','undefined',7,1,3,1513550843,1),(280,'public/images/product/laptop-hp-probook-440-g2-led-backlit(copy-3).png','Laptop HP Probook 440 G2 LED Backlit','undefined',7,1,3,1513550849,1),(281,'public/images/product/laptop-hp-probook-440-g2-led-backlit(copy-2).png','Laptop HP Probook 440 G2 LED Backlit','undefined',7,1,3,1513550864,1),(282,'public/images/product/laptop-hp-probook-440-g2-led-backlit(copy-1).png','Laptop HP Probook 440 G2 LED Backlit','undefined',7,1,3,1513550872,1),(283,'public/images/product/laptop-hp-probook-440-g2-led(copy-1).png','Laptop HP Probook 440 G2 LED','undefined',8,1,3,1513551001,1),(288,'public/images/product/laptop-hp-probook-440(copy-4).png','Laptop HP Probook 440','undefined',9,1,3,1513551643,1),(289,'public/images/product/laptop-hp-probook-440(copy-3).png','Laptop HP Probook 440','undefined',9,1,3,1513551648,1),(290,'public/images/product/laptop-hp-probook-440(copy-2).png','Laptop HP Probook 440','undefined',9,1,3,1513551679,1),(297,'public/images/product/thanh-toan-nhanh(copy-1).png','Thanh toán nhanh','undefined',4,1,3,1513697637,1),(298,'public/images/product/dat-hang-online(copy-1).png','Đặt hàng online','undefined',5,1,3,1513697680,1),(299,'public/images/product/motorola-moto-g5s-plus(copy-5).png','Motorola Moto G5S Plus','undefined',11,1,3,1513698568,1),(300,'public/images/product/motorola-moto-g5s-plus.png','Motorola Moto G5S Plus','undefined',11,1,3,1513698569,1),(301,'public/images/product/motorola-moto-g5s-plus(copy-4).png','Motorola Moto G5S Plus','undefined',11,1,3,1513698574,1),(302,'public/images/product/motorola-moto-g5s-plus(copy-3).png','Motorola Moto G5S Plus','undefined',11,1,3,1513698579,1),(303,'public/images/product/motorola-moto-g5s-plus(copy-2).png','Motorola Moto G5S Plus','undefined',11,1,3,1513698586,1),(304,'public/images/product/motorola-moto-g5s-plus(copy-1).png','Motorola Moto G5S Plus','undefined',11,1,3,1513698595,1),(305,'public/images/product/samsung-galaxy-a5.png','Samsung Galaxy A5','undefined',12,1,3,1513698696,1),(306,'public/images/product/sony-xperia-xa-ultra.png','Sony Xperia XA Ultra','undefined',13,1,3,1513700052,1),(307,'public/images/product/huawei-nova-2i.png','Huawei Nova 2i','undefined',15,1,3,1513700264,1),(308,'public/images/product/htc-u-ultra-sapphire.png','HTC U Ultra Sapphire','undefined',16,1,3,1513700659,1),(309,'public/images/product/htc-u-ultra-sapphire(copy-5).png','HTC U Ultra Sapphire','undefined',16,1,3,1513700665,1),(310,'public/images/product/htc-u-ultra-sapphire(copy-4).png','HTC U Ultra Sapphire','undefined',16,1,3,1513700669,1),(311,'public/images/product/htc-u-ultra-sapphire(copy-3).png','HTC U Ultra Sapphire','undefined',16,1,3,1513700673,1),(312,'public/images/product/htc-u-ultra-sapphire(copy-2).png','HTC U Ultra Sapphire','undefined',16,1,3,1513700677,1),(313,'public/images/product/htc-u-ultra-sapphire(copy-1).png','HTC U Ultra Sapphire','undefined',16,1,3,1513700681,1),(314,'public/images/post/dien-thoai-co-ban-ho-tro-4g-cua-nokia-vua-dat-chung-nhan-bluetooth(copy-1).png','Điện thoại cơ bản hỗ trợ 4G của Nokia vừa đạt chứng nhận Bluetooth','undefined',2,1,2,1513960285,5),(315,'public/images/product/mien-phi-van-chuyen(copy-1).png','Miễn phí vận chuyển',NULL,5,1,3,1515574694,1),(316,'public/images/product/samsung.png','Samsung','',1,1,3,1515586065,1),(317,'public/images/product/tra-gop-sam-sung.png','Trả góp Sam sung','',2,1,3,1515586205,1),(318,'public/images/product/thanh-toan-nhanh.png','Thanh toán nhanh',NULL,6,1,3,1515629046,1),(319,'public/images/product/tiet-kiem-hon.png','Tiết kiệm hơn',NULL,7,1,3,1515629094,1),(320,'public/images/product/tu-van-247(copy-1).png','Tư vấn 24/7',NULL,8,1,3,1515629151,1),(321,'public/images/product/dat-hang-online.png','Đặt hàng online',NULL,9,1,3,1515629218,1),(322,'public/images/product/dien-thoai-samsung-galaxy-j7-pro(copy-1).png','Điện thoại Samsung Galaxy J7 Pro',NULL,17,1,3,1515629608,1),(323,'public/images/product/3499704f027336546022b340f1e45304.jpg',NULL,NULL,0,2,3,1517468300,1),(324,'public/images/product/dien-thoai-samsung-galaxy-j7-pro.png','Điện thoại Samsung Galaxy J7 Pro',NULL,17,1,3,1517468311,1),(325,'public/images/product/5b00c11f36a0a3a3656165c704773c2c.jpg',NULL,NULL,0,2,3,1517547215,1);
/*!40000 ALTER TABLE `tbl_media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_menu`
--

DROP TABLE IF EXISTS `tbl_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `type` int(1) NOT NULL COMMENT '1 => page .2 => cat_post. 3 => cat_product',
  `connect_to` int(11) DEFAULT NULL,
  `parent_id` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '2',
  `link` varchar(200) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `location` int(1) NOT NULL COMMENT '1=> header . 2=> footer 3- sidebar 4-> response',
  `ordinal` int(2) NOT NULL,
  `create_at` int(12) NOT NULL,
  `modify_at` int(12) NOT NULL,
  `create_by` int(11) NOT NULL,
  `modify_by` int(11) NOT NULL,
  PRIMARY KEY (`menu_id`),
  KEY `modify_by` (`modify_by`),
  KEY `create_by` (`create_by`),
  CONSTRAINT `tbl_menu_ibfk_1` FOREIGN KEY (`modify_by`) REFERENCES `tbl_user` (`user_id`),
  CONSTRAINT `tbl_menu_ibfk_2` FOREIGN KEY (`create_by`) REFERENCES `tbl_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_menu`
--

LOCK TABLES `tbl_menu` WRITE;
/*!40000 ALTER TABLE `tbl_menu` DISABLE KEYS */;
INSERT INTO `tbl_menu` (`menu_id`, `title`, `type`, `connect_to`, `parent_id`, `active`, `link`, `location`, `ordinal`, `create_at`, `modify_at`, `create_by`, `modify_by`) VALUES (3,'Chính sách trả góp',1,2,6,1,'where-does-it-come-from.html',2,1,1512619090,1513757048,1,1),(6,'Chính sách mua hàng',1,2,0,1,'where-does-it-come-from.html',2,1,1512982583,1513756153,1,1),(7,'Chính sách bảo hành - đổi trả',1,6,6,1,'why-do-we-use-i.html',2,4,1512985619,1513756987,1,1),(8,'Quy định - chính sách',1,2,6,1,'where-does-it-come-from.html',2,3,1513015664,1513756996,1,1),(9,'Tablet',3,10,0,1,'san-pham/dien-thoai',1,4,1513016412,1515585074,1,1),(10,'Tin tức',2,13,0,1,'cong-nghe',1,5,1513303403,1515585082,1,1),(11,'Điện thoại',3,10,0,1,'san-pham/dien-thoai',3,1,1513303781,1515583694,1,1),(12,'Điện thoại iPhone',3,11,11,1,'san-pham/dien-thoai-iphone',3,2,1513307289,1515583735,1,1),(15,'Máy tính',3,12,0,1,'san-pham/may-tinh',3,1,1513550602,1513758319,1,1),(19,'Tablet',3,15,0,1,'san-pham/dien-thoai-oppo',3,1,1515584687,1515584687,1,1),(20,'Điện thoại',3,10,0,1,'san-pham/dien-thoai',1,2,1515584830,1515585056,1,1),(21,'Trang chủ',4,NULL,0,1,'trang-chu.html',1,1,1515584958,1515585040,1,1),(22,'Máy tính',3,12,0,1,'san-pham/may-tinh',1,3,1515585017,1515585064,1,1),(23,'Tai nghe',3,10,0,1,'san-pham/dien-thoai',3,1,1515585611,1515585611,1,1),(24,'Tin tức',2,13,0,1,'tin-tuc/cong-nghe',3,1,1515585645,1515585645,1,1),(25,'Điện thoại OPPO',3,15,11,1,'san-pham/dien-thoai-oppo',3,1,1515585696,1515585696,1,1),(26,'Điện thoại',3,10,0,1,'san-pham/dien-thoai',4,1,1515627849,1515627849,1,1),(28,'Điện thoại iPhone',3,11,26,1,'san-pham/dien-thoai-iphone',4,1,1515627981,1515627981,1,1),(29,'Máy tính',3,12,0,1,'san-pham/may-tinh',4,1,1515628008,1515628008,1,1),(30,'Tablet',3,12,0,1,'san-pham/may-tinh',4,1,1515628036,1515628036,1,1),(31,'Tai nghe',3,12,0,1,'san-pham/may-tinh',4,1,1515628065,1515628065,1,1),(32,'Điện thoại sam sung',3,10,0,2,'san-pham/dien-thoai',1,1,1520182017,1520182017,1,1);
/*!40000 ALTER TABLE `tbl_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_order`
--

DROP TABLE IF EXISTS `tbl_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `code_order` varchar(10) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `buyer` int(11) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '3',
  `payment_method` varchar(30) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `code_active` varchar(33) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `total_price` int(11) NOT NULL,
  `total_qty` int(11) NOT NULL,
  `create_at` int(12) NOT NULL,
  PRIMARY KEY (`order_id`),
  UNIQUE KEY `code_order` (`code_order`),
  KEY `buyer` (`buyer`),
  CONSTRAINT `tbl_order_ibfk_1` FOREIGN KEY (`buyer`) REFERENCES `tbl_customer` (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_order`
--

LOCK TABLES `tbl_order` WRITE;
/*!40000 ALTER TABLE `tbl_order` DISABLE KEYS */;
INSERT INTO `tbl_order` (`order_id`, `code_order`, `buyer`, `active`, `payment_method`, `code_active`, `total_price`, `total_qty`, `create_at`) VALUES (1,'VSZ-1',7,3,'direct-payment','235980b03cfc7ffd9f1d6468a7d382dd',13230000,1,1513858271),(2,'VSZ-2',7,3,'direct-payment','',6990000,1,1513859014),(3,'VSZ-3',8,4,'direct-payment','',20990000,1,1513859936),(4,'VSZ-4',8,3,'direct-payment','dca802c97173fb76e5ca1eea09a2ca68',50980000,3,1515560301),(5,'VSZ-5',8,2,'direct-payment','6b17ccf125e5f88ef6c8e2fbaca16a6f',13230000,1,1515571390);
/*!40000 ALTER TABLE `tbl_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_page`
--

DROP TABLE IF EXISTS `tbl_page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_page` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `slug` varchar(200) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `content` text COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `active` int(1) NOT NULL DEFAULT '2',
  `create_at` int(11) NOT NULL,
  `modify_by` int(11) NOT NULL,
  `create_by` int(11) NOT NULL,
  `modify_at` int(11) NOT NULL,
  PRIMARY KEY (`page_id`),
  KEY `modify_by` (`modify_by`),
  KEY `create_by` (`create_by`),
  CONSTRAINT `tbl_page_ibfk_1` FOREIGN KEY (`modify_by`) REFERENCES `tbl_user` (`user_id`),
  CONSTRAINT `tbl_page_ibfk_2` FOREIGN KEY (`create_by`) REFERENCES `tbl_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_page`
--

LOCK TABLES `tbl_page` WRITE;
/*!40000 ALTER TABLE `tbl_page` DISABLE KEYS */;
INSERT INTO `tbl_page` (`page_id`, `title`, `slug`, `content`, `active`, `create_at`, `modify_by`, `create_by`, `modify_at`) VALUES (1,'giới thiệu','gioi-thieu','<p>shop đồ điện tử vs shop</p>\r\n',1,1520149189,1,1,1520149189);
/*!40000 ALTER TABLE `tbl_page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_post`
--

DROP TABLE IF EXISTS `tbl_post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_post` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `content` text COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `thumbnail` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `active` int(1) NOT NULL DEFAULT '2',
  `view` int(11) DEFAULT '1',
  `create_at` int(11) NOT NULL,
  `create_by` int(11) NOT NULL,
  `modify_at` int(11) NOT NULL,
  `modify_by` int(11) NOT NULL,
  PRIMARY KEY (`post_id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `thumbnail` (`thumbnail`),
  KEY `cat_id` (`cat_id`),
  KEY `modify_by` (`modify_by`),
  KEY `creat_by` (`create_by`),
  CONSTRAINT `tbl_post_ibfk_1` FOREIGN KEY (`create_by`) REFERENCES `tbl_user` (`user_id`),
  CONSTRAINT `tbl_post_ibfk_2` FOREIGN KEY (`modify_by`) REFERENCES `tbl_user` (`user_id`),
  CONSTRAINT `tbl_post_ibfk_3` FOREIGN KEY (`cat_id`) REFERENCES `tbl_category` (`cat_id`),
  CONSTRAINT `tbl_post_ibfk_4` FOREIGN KEY (`thumbnail`) REFERENCES `tbl_media` (`media_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_post`
--

LOCK TABLES `tbl_post` WRITE;
/*!40000 ALTER TABLE `tbl_post` DISABLE KEYS */;
INSERT INTO `tbl_post` (`post_id`, `title`, `excerpt`, `content`, `thumbnail`, `cat_id`, `slug`, `active`, `view`, `create_at`, `create_by`, `modify_at`, `modify_by`) VALUES (1,'OPPO A83 rò rỉ thông số cấu hình sử dụng bảo mật khuôn mặt','            Đầu th&aacute;ng 12 vừa qua, cơ quan TENAA đ&atilde; thừa nhận sự xuất hiện của OPPO A83 với thiết kế to&agrave;n m&agrave;n h&igrave;nh. Mới đ&acirc;y, nguồn tin r&ograve; rỉ lại cho ch&uacute;ng ta...\r\n        ','<h2 dir=\"ltr\">Đầu th&aacute;ng 12 vừa qua, cơ quan&nbsp;<a href=\"https://www.thegioididong.com/tin-tuc/fcc-ccc-la-gi-vi-sao-smartphone-muon-ban-ra-phai-duoc-ho-chung-nhan--1024896\" target=\"_blank\" title=\"TENAA\" type=\"TENAA\">TENAA</a>&nbsp;đ&atilde; thừa nhận sự xuất hiện của&nbsp;<a href=\"https://www.thegioididong.com/tin-tuc/tim-kiem?key=OPPO+A83\" target=\"_blank\" title=\"OPPO A83 \" type=\"OPPO A83 \">OPPO A83</a>với thiết kế m&agrave;n h&igrave;nh tr&agrave;n viền. Mới đ&acirc;y, nguồn tin r&ograve; rỉ lại cho ch&uacute;ng ta biết th&ecirc;m cấu h&igrave;nh của m&aacute;y.</h2>\r\n\r\n<p><img alt=\"Thông tin rò rỉ về cấu hình của OPPO A83\" src=\"https://cdn4.tgdd.vn/Files/2017/12/13/1050119/oppo-a83-leak-2_600x459.jpg\" title=\"Thông tin rò rỉ về cấu hình của OPPO A83\" /></p>\r\n\r\n<p dir=\"ltr\">Theo đ&oacute;, OPPO A83 sẽ c&oacute; m&agrave;n h&igrave;nh 5.7 inch HD+ tỉ lệ 18:9 đang ng&agrave;y c&agrave;ng thịnh h&agrave;nh, trang bị bộ vi xử l&yacute; Helio P23 đi k&egrave;m 2 GB RAM + 16 GB ROM (hỗ trợ khe cắm thẻ nhớ microSD).</p>\r\n\r\n<p><img alt=\"Thông tin rò rỉ về cấu hình của OPPO A83\" src=\"https://cdn1.tgdd.vn/Files/2017/12/13/1050119/oppo-a83-leak-3_600x512.jpg\" title=\"Thông tin rò rỉ về cấu hình của OPPO A83\" /></p>\r\n\r\n<p dir=\"ltr\">Nh&igrave;n v&agrave;o những h&igrave;nh ảnh được cung cấp c&oacute; thể thấy rằng OPPO A83 kh&ocirc;ng được t&iacute;ch hợp cảm biến v&acirc;n tay. Thay v&agrave;o đ&oacute;, nhiều người tin rằng m&aacute;y sẽ sử dụng chức năng bảo mật nhận diện khu&ocirc;n mặt. Ngo&agrave;i ra, sản phẩm n&agrave;y c&ograve;n sở hữu camera trước sau 5/13 MP v&agrave; vi&ecirc;n pin dung lượng 3.180 mAh.</p>\r\n\r\n<p><img alt=\"Thông tin rò rỉ về cấu hình của OPPO A83\" src=\"https://cdn3.tgdd.vn/Files/2017/12/13/1050119/oppo-a83-leak-1_600x291.jpg\" title=\"Thông tin rò rỉ về cấu hình của OPPO A83\" /></p>\r\n\r\n<p>Th&ocirc;ng số cấu h&igrave;nh của tin đồn n&agrave;y ho&agrave;n to&agrave;n ph&ugrave; hợp với những th&ocirc;ng tin của cơ quan TENAA cung cấp từ trước đ&oacute;. Chưa hết, trang&nbsp;<a href=\"http://playfuldroid.com/oppo-a83-specs-surface-may-arrive-with-facial-recognition-instead-of-fingerprint-scanner/\" rel=\"nofollow\" target=\"_blank\" title=\"playfuldroid \" type=\"playfuldroid \">playfuldroid</a>&nbsp;c&ograve;n cho biết th&ecirc;m, OPPO A83 c&oacute; k&iacute;ch thước 150.5 x73.1 x 7.7 mm, xuất hiện với t&ugrave;y chọn m&agrave;u v&agrave;ng v&agrave; đen cho người d&ugrave;ng chọn lựa.</p>\r\n\r\n<p dir=\"ltr\">Dự kiến, OPPO sẽ c&ocirc;ng bố OPPO A83 v&agrave;o ng&agrave;y 30/12 tới với gi&aacute; b&aacute;n khoảng 1.199 NDT (gần 4.1 triệu đồng).</p>\r\n',265,14,'oppo-a83-ro-ri-thong-so-cau-hinh-su-dung-bao-mat-k',1,31,1513183556,1,1513953229,1),(2,'Điện thoại cơ bản hỗ trợ 4G của Nokia vừa đạt chứng nhận Bluetooth','Một v&agrave;i th&ocirc;ng tin gần nhất cho thấy, HMD sắp ra mắt một điện thoại &quot;cục gạch&quot; hỗ trợ 4G. V&agrave; mới nhất, c&aacute;c model TA-1047, TA-1060 đ&atilde; đạt chứng nhận tại&nbsp;FCC. Dự kiến đ&acirc;y ch&iacute;nh l&agrave; những điện thoại cơ bản hỗ trợ 4G tuy kh&ocirc;ng phải l&agrave; smartphone.','<h2>Một v&agrave;i th&ocirc;ng tin gần nhất cho thấy, HMD sắp ra mắt một điện thoại &quot;cục gạch&quot; hỗ trợ 4G. V&agrave; mới nhất, c&aacute;c model TA-1047, TA-1060 đ&atilde; đạt chứng nhận tại&nbsp;<a href=\"https://www.thegioididong.com/tin-tuc/fcc-ccc-la-gi-vi-sao-smartphone-muon-ban-ra-phai-duoc-ho-chung-nhan--1024896\" target=\"_blank\" title=\"FCC\">FCC</a>. Dự kiến đ&acirc;y ch&iacute;nh l&agrave; những điện thoại cơ bản hỗ trợ 4G tuy kh&ocirc;ng phải l&agrave; smartphone.</h2>\r\n\r\n<p>Theo&nbsp;<a href=\"https://www.gizmochina.com/2017/12/21/4g-nokia-feature-phone-receives-bluetooth-sig-certification-launch-nearing/\" rel=\"nofollow\" target=\"_blank\" title=\"Nokia\">gizmochina</a>, mẫu điện thoại cơ bản hỗ trợ 4G của&nbsp;<a href=\"https://www.thegioididong.com/dtdd-nokia\" target=\"_blank\" title=\"Nokia \">Nokia</a>&nbsp;cũng vừa đạt chứng nhận tại tổ chức Bluetooth SIG, điều n&agrave;y chứng tỏ m&aacute;y đ&atilde; sẵn s&agrave;ng ra mắt.</p>\r\n\r\n<p>Bluetooth SIG đ&atilde; chứng nhận 5 model gồm: Nokia TA-1047, TA-1060, TA-1056, TA-1079 v&agrave; TA-1066. Dường như đ&acirc;y l&agrave; 5 biến thể của mẫu điện thoại nghe gọi sắp ra mắt.</p>\r\n\r\n<p><img alt=\"Điện thoại cục gạch Nokia hỗ trợ 4G đạt chứng nhận Bluetooth\" src=\"https://cdn.tgdd.vn/Files/2017/12/21/1052290/nokia-2_800x300.jpg\" title=\"Điện thoại cục gạch Nokia hỗ trợ 4G đạt chứng nhận Bluetooth\" /></p>\r\n\r\n<p>Dự kiến chiếc điện thoại mới n&agrave;y sẽ l&ecirc;n kệ ở nhiều thị trường kh&aacute;c nhau với 2 phi&ecirc;n bản l&agrave; 1 SIM v&agrave; 2 SIM. Ngo&agrave;i ra, phần m&ocirc; tả phần mềm cho thấy m&aacute;y kh&ocirc;ng chạy Android, rất c&oacute; thể sẽ t&iacute;ch hợp hệ điều h&agrave;nh series 30+ Feature OS tương tự như&nbsp;<a href=\"https://www.thegioididong.com/dtdd/nokia-3310-2017\" target=\"_blank\" title=\"Nokia 3310\">Nokia 3310</a>&nbsp;(2017).</p>\r\n\r\n<p>Danh s&aacute;ch tr&ecirc;n FCC cho thấy m&aacute;y c&oacute; k&iacute;ch thước l&agrave; 133 x 68 mm. N&oacute; được suy đo&aacute;n sẽ sử dụng b&agrave;n ph&iacute;m QWERTY giống với Nokia E72.</p>\r\n',314,14,'dien-thoai-co-ban-ho-tro-4g-cua-nokia-vua-dat-chung-nhan-bluetooth',2,23,1513960290,5,1513960503,5);
/*!40000 ALTER TABLE `tbl_post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_product`
--

DROP TABLE IF EXISTS `tbl_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `favorite` int(1) NOT NULL DEFAULT '0',
  `name` varchar(220) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `percen` int(11) DEFAULT '0',
  `thumb` int(11) NOT NULL,
  `img_involve` varchar(220) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `depict` text COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `price` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `info` text COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `create_at` int(11) NOT NULL,
  `total_product` int(11) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '2',
  `discount` int(11) DEFAULT NULL,
  `create_by` int(11) NOT NULL,
  `modify_by` int(11) NOT NULL,
  `modify_at` int(11) NOT NULL,
  PRIMARY KEY (`product_id`),
  KEY `thumb` (`thumb`),
  KEY `cat_id` (`cat_id`),
  KEY `create_by` (`create_by`),
  KEY `modify_by` (`modify_by`),
  CONSTRAINT `tbl_product_ibfk_1` FOREIGN KEY (`modify_by`) REFERENCES `tbl_user` (`user_id`),
  CONSTRAINT `tbl_product_ibfk_2` FOREIGN KEY (`create_by`) REFERENCES `tbl_user` (`user_id`),
  CONSTRAINT `tbl_product_ibfk_3` FOREIGN KEY (`thumb`) REFERENCES `tbl_media` (`media_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_product`
--

LOCK TABLES `tbl_product` WRITE;
/*!40000 ALTER TABLE `tbl_product` DISABLE KEYS */;
INSERT INTO `tbl_product` (`product_id`, `favorite`, `name`, `slug`, `percen`, `thumb`, `img_involve`, `depict`, `price`, `cat_id`, `info`, `create_at`, `total_product`, `active`, `discount`, `create_by`, `modify_by`, `modify_at`) VALUES (4,1,'Điện thoại iPhone X 64GB','dien-thoai-iphone-x-64gb',10,252,'[\"268\",\"267\",\"266\",\"256\",\"255\",\"254\",\"253\"]','<h2><a href=\"https://www.thegioididong.com/dtdd-apple-iphone\" target=\"_blank\" title=\"Điện thoại iPhone\">iPhone</a>&nbsp;X l&agrave; chiếc smartphone được rất nhiều người mong chờ bởi đ&acirc;y được xem l&agrave; chiếc m&aacute;y để Apple kỉ niệm 10 năm chiếc iPhone đầu ti&ecirc;n được b&aacute;n ra.</h2>\r\n\r\n<h3><strong>Thiết kế đột ph&aacute;</strong></h3>\r\n\r\n<p>Như c&aacute;c bạn cũng đ&atilde; biết th&igrave; đ&atilde; 4 năm kể từ iPhone 6 v&agrave; iPhone 6 Plus Apple vẫn chưa c&oacute; thay đổi n&agrave;o đ&aacute;ng kể trong thiết kế của m&igrave;nh.</p>\r\n\r\n<p><a href=\"https://www.thegioididong.com/images/42/114115/iphone-x-64gb1.jpg\" onclick=\"return false;\"><img alt=\"Thiết kế đột phá\" src=\"https://cdn4.tgdd.vn/Products/Images/42/114115/iphone-x-64gb1.jpg\" title=\"Thiết kế đột phá\" /></a></p>\r\n\r\n<p>Nhưng với iPhone X th&igrave; đ&oacute; lại l&agrave; 1 c&acirc;u chuyện ho&agrave;n to&agrave;n kh&aacute;c, m&aacute;y chuyển qua sử dụng m&agrave;n h&igrave;nh tỉ lệ 19,5:9 mới mẻ với phần diện t&iacute;ch hiển thị mặt trước cực lớn.</p>\r\n\r\n<p><a href=\"https://www.thegioididong.com/images/42/114115/iphone-x-64gb2.jpg\" onclick=\"return false;\"><img alt=\"Thiết kế đột phá\" src=\"https://cdn1.tgdd.vn/Products/Images/42/114115/iphone-x-64gb2.jpg\" title=\"Thiết kế đột phá\" /></a></p>\r\n\r\n<p>Mặt lưng k&iacute;nh hỗ trợ sạc nhanh kh&ocirc;ng d&acirc;y cũng như phần camera k&eacute;p đặt dọc cũng l&agrave; những thứ đầu ti&ecirc;n xuất hiện tr&ecirc;n 1 chiếc iPhone.</p>\r\n\r\n<h3><strong>M&agrave;n h&igrave;nh với tai thỏ</strong></h3>\r\n\r\n<p>Điểm khiến iPhone X bị ch&ecirc; nhiều nhất đ&oacute; ch&iacute;nh l&agrave; phần &quot;tai thỏ&quot; ph&iacute;a tr&ecirc;n m&agrave;n h&igrave;nh, Apple đ&atilde; chấp nhận điều n&agrave;y để đặt cụm camera&nbsp;TrueDept mới của h&atilde;ng.</p>\r\n\r\n<p><a href=\"https://www.thegioididong.com/images/42/114115/iphone-x-64gb15.jpg\" onclick=\"return false;\"><img alt=\"Màn hình với tai thỏ\" src=\"https://cdn3.tgdd.vn/Products/Images/42/114115/iphone-x-64gb15.jpg\" title=\"Màn hình với tai thỏ\" /></a></p>\r\n\r\n<p>M&agrave;n h&igrave;nh k&iacute;ch thước 5.8 inch độ ph&acirc;n giải&nbsp;1125 x 2436 pixels đem đến khả năng hiển thị xuất sắc.</p>\r\n\r\n<p><a href=\"https://www.thegioididong.com/images/42/114115/iphone-x-64gb20.jpg\" onclick=\"return false;\"><img alt=\"Màn hình với tai thỏ\" src=\"https://cdn.tgdd.vn/Products/Images/42/114115/iphone-x-64gb20.jpg\" title=\"Màn hình với tai thỏ\" /></a></p>\r\n\r\n<p>iPhone X sử dụng tấm nền&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/man-hinh-oled-la-gi-905762\" target=\"_blank\" title=\"Tìm hiểu màn hình OLED\">OLED</a>&nbsp;(được tinh chỉnh bởi Apple) thay v&igrave; LCD như những chiếc iPhone trước đ&acirc;y v&agrave; điều n&agrave;y đem lại cho m&aacute;y 1 m&agrave;u đen thể hiện rất s&acirc;u cũng khả năng t&aacute;i tạo m&agrave;u sắc kh&ocirc;ng k&eacute;m phần ch&iacute;nh x&aacute;c.</p>\r\n\r\n<h3><strong>Face ID tạo n&ecirc;n đột ph&aacute;</strong></h3>\r\n\r\n<p>Touch ID tr&ecirc;n iPhone X đ&atilde; bị loại bỏ, thay v&agrave;o đ&oacute; l&agrave; bạn sẽ chuyển qua sử dụng Face ID, một phương thức bảo mật sinh trắc học mới của Apple.</p>\r\n\r\n<p><a href=\"https://www.thegioididong.com/images/42/114115/iphone-x-64gb7.jpg\" onclick=\"return false;\"><img alt=\"Face ID tạo nên đột phá\" src=\"https://cdn2.tgdd.vn/Products/Images/42/114115/iphone-x-64gb7.jpg\" title=\"Face ID tạo nên đột phá\" /></a></p>\r\n\r\n<p>Với sự trợ gi&uacute;p của cụm&nbsp;camera&nbsp;TrueDept th&igrave; iPhone X c&oacute; khả năng nhận diện khu&ocirc;n mặt 3D của người d&ugrave;ng từ đ&oacute; mở kh&oacute;a chiếc iPhone một c&aacute;ch nhanh ch&oacute;ng.</p>\r\n\r\n<p><a href=\"https://www.thegioididong.com/images/42/114115/iphone-x-64gb11.jpg\" onclick=\"return false;\"><img alt=\"Face ID tạo nên đột phá\" src=\"https://cdn4.tgdd.vn/Products/Images/42/114115/iphone-x-64gb11.jpg\" title=\"Face ID tạo nên đột phá\" /></a></p>\r\n\r\n<p>Tuy sẽ hơi hụt hẫng khi Touch ID đ&atilde; qu&aacute; quen thuộc tr&ecirc;n những chiếc iPhone như tốc độ cũng như trải nghiệm &quot;kh&oacute;a như kh&ocirc;ng kh&oacute;a&quot; của Face ID ho&agrave;n to&agrave;n c&oacute; thể khiến bạn y&ecirc;n t&acirc;m sử dụng.</p>\r\n\r\n<h3><strong>Thao t&aacute;c vuốt v&agrave; vuốt</strong></h3>\r\n\r\n<p>Kh&ocirc;ng c&ograve;n ph&iacute;m Home cứng n&ecirc;n c&aacute;c thao t&aacute;c tr&ecirc;n iPhone X cũng ho&agrave;n to&agrave;n kh&aacute;c so với những đ&agrave;n anh đi trước.</p>\r\n\r\n<p><a href=\"https://www.thegioididong.com/images/42/114115/iphone-x-64gb3.jpg\" onclick=\"return false;\"><img alt=\"Thao tác vuốt và vuốt\" src=\"https://cdn1.tgdd.vn/Products/Images/42/114115/iphone-x-64gb3.jpg\" title=\"Thao tác vuốt và vuốt\" /></a></p>\r\n\r\n<p>Giờ đ&acirc;y chỉ với thao t&aacute;c vuốt v&agrave; vuốt từ cạnh dưới l&agrave; bạn đ&atilde; c&oacute; thể truy cập v&agrave;o đa nhiệm, trở về m&agrave;n h&igrave;nh Home một c&aacute;ch nhanh ch&oacute;ng.</p>\r\n\r\n<h3><strong>Camera cải tiến</strong></h3>\r\n\r\n<p>iPhone X vẫn sở hữu bộ đ&ocirc;i camera với độ ph&acirc;n giải 12 MP nhưng camera tele thứ 2 với khẩu độ được n&acirc;ng l&ecirc;n mức f/2.4 so với f/2.8 của iPhone 7 Plus.</p>\r\n\r\n<p><a href=\"https://www.thegioididong.com/images/42/114115/iphone-x-64gb19.jpg\" onclick=\"return false;\"><img alt=\"Camera cải tiến\" src=\"https://cdn3.tgdd.vn/Products/Images/42/114115/iphone-x-64gb19.jpg\" title=\"Camera cải tiến\" /></a></p>\r\n\r\n<p>Ngo&agrave;i ra th&igrave; cả 2 camera tr&ecirc;n iPhone X đều sở hữu cho m&igrave;nh khả năng chống rung quang học gi&uacute;p bạn dễ d&agrave;ng bắt trọn mọi khoảnh khắc trong cuộc sống.</p>\r\n\r\n<p><a href=\"https://www.thegioididong.com/images/42/114115/iphone-x-64gb9.jpg\" onclick=\"return false;\"><img alt=\"Camera cải tiến\" src=\"https://cdn.tgdd.vn/Products/Images/42/114115/iphone-x-64gb9.jpg\" title=\"Camera cải tiến\" /></a></p>\r\n\r\n<p>Camera trước độ ph&acirc;n giải 7 MP với khả năng selfie x&oacute;a ph&ocirc;ng đ&aacute;p ứng tốt mọi nhu cầu tự sướng của giới trẻ hiện nay.</p>\r\n\r\n<p><a href=\"https://www.thegioididong.com/images/42/114115/iphone-x-64gb8.jpg\" onclick=\"return false;\"><img alt=\"Camera cải tiến\" src=\"https://cdn2.tgdd.vn/Products/Images/42/114115/iphone-x-64gb8.jpg\" title=\"Camera cải tiến\" /></a></p>\r\n\r\n<p>Bộ đ&ocirc;i camera tr&ecirc;n iPhone X được đ&aacute;nh gi&aacute; rất cao về chất lượng ảnh chụp v&agrave; l&agrave; một trong những chiếc camera phone chụp ảnh đẹp nhất trong năm 2017.</p>\r\n\r\n<h3><strong>Hiệu năng mạnh mẽ</strong></h3>\r\n\r\n<p>Hiệu năng của những chiếc iPhone chưa bao giờ l&agrave; vấn đề v&agrave; với iPhone X th&igrave; mọi thứ vấn rất ấn tượng.</p>\r\n\r\n<p><a href=\"https://www.thegioididong.com/images/42/114115/iphone-x-64gb10.jpg\" onclick=\"return false;\"><img alt=\"Hiệu năng mạnh mẽ\" src=\"https://cdn4.tgdd.vn/Products/Images/42/114115/iphone-x-64gb10.jpg\" title=\"Hiệu năng mạnh mẽ\" /></a></p>\r\n\r\n<p>Con chip&nbsp;<a href=\"https://www.thegioididong.com/tin-tuc/chi-tiet-a11-bionic-chip-co-nhieu-thanh-phan-apple-tu-trong-nhat-tu-truoc-den-nay-1021653\" target=\"_blank\" title=\"Apple A11 Bionic 6 nhân\">Apple A11 Bionic 6 nh&acirc;n</a>&nbsp;kết hợp với 3 GB RAM th&igrave; iPhone X tự tin l&agrave; chiếc&nbsp;<a href=\"https://www.thegioididong.com/dtdd\" target=\"_blank\" title=\"Điện thoại di động\">smartphone</a>&nbsp;mạnh mẽ nhất m&agrave; Apple từng sản xuất.</p>\r\n\r\n<p><a href=\"https://www.thegioididong.com/images/42/114115/iphone-x-64gb13.jpg\" onclick=\"return false;\"><img alt=\"Hiệu năng mạnh mẽ\" src=\"https://cdn1.tgdd.vn/Products/Images/42/114115/iphone-x-64gb13.jpg\" title=\"Hiệu năng mạnh mẽ\" /></a></p>\r\n\r\n<p>Ngo&agrave;i ra với iPhone X th&igrave; Apple cũng nhấn mạnh với trải nghiệm thực tế ảo tăng cường gi&uacute;p bạn c&oacute; những ph&uacute;t gi&acirc;y thư gi&atilde;n th&uacute; vị.</p>\r\n\r\n<p><a href=\"https://www.thegioididong.com/images/42/114115/iphone-x-64gb17.jpg\" onclick=\"return false;\"><img alt=\"Hiệu năng mạnh mẽ\" src=\"https://cdn3.tgdd.vn/Products/Images/42/114115/iphone-x-64gb17.jpg\" title=\"Hiệu năng mạnh mẽ\" /></a></p>\r\n\r\n<p>Vi&ecirc;n pin tr&ecirc;n iPhone X c&oacute; dung lượng&nbsp;2716 mAh (lớn hơn cả tr&ecirc;n iPhone 8 Plus) cho bạn sử dụng kh&aacute; ổn trong khoảng một ng&agrave;y li&ecirc;n tục.</p>\r\n',29990000,11,'Hệ điều h&agrave;nh:	iOS 11\r\nCamera sau:	2 camera 12 MP\r\nCamera trước:	7 MP\r\nCPU:	Apple A11 Bionic 6 nh&acirc;n\r\nRAM:	3 GB\r\nBộ nhớ trong:	64 GB\r\nThẻ SIM:	1 Nano SIM, Hỗ trợ 4G\r\nDung lượng pin:	2716 mAh, c&oacute; sạc nhanh',1513062011,10,1,26990000,1,1,1513353441),(5,1,'Điện thoại iPhone 8 64G','dien-thoai-iphone-8-64g',NULL,257,'[\"260\",\"259\",\"258\"]','<h3>Thay đổi phong c&aacute;ch thiết kế</h3>\r\n\r\n<p>iPhone 8 kết hợp giữa những đường n&eacute;t đ&atilde; l&agrave;m n&ecirc;n chuẩn mực, thương hiệu với sự thời thượng v&agrave; hiện đại của mặt lưng phủ k&iacute;nh cường lực thay v&igrave; nguy&ecirc;n khối kim loại. Điểm thiết kế n&agrave;y mang lại độ b&oacute;ng bẩy, đẹp mắt hơn cho sản phẩm.</p>\r\n\r\n<h2><a href=\"https://cdn.tgdd.vn/Files/2017/09/13/1021096/p9122094_800x450.jpg\" onclick=\"return false;\"><img alt=\"Trên tay iPhone 8\" src=\"https://cdn.tgdd.vn/Files/2017/09/13/1021096/p9122094_800x450.jpg\" title=\"Trên tay iPhone 8\" /></a></h2>\r\n\r\n<p>Mặt lưng k&iacute;nh gi&uacute;p iPhone 8 được t&iacute;ch hợp c&ocirc;ng nghệ sạc kh&ocirc;ng d&acirc;y hiện đại m&agrave; người d&ugrave;ng mong đợi từ l&acirc;u. Ngo&agrave;i ra c&ograve;n l&agrave; lần đầu ti&ecirc;n Apple trang bị c&ocirc;ng nghệ sạc pin nhanh cho iPhone.</p>\r\n\r\n<p><a href=\"https://cdn.tgdd.vn/Files/2017/09/13/1021096/p9122088_800x451.jpg\" onclick=\"return false;\"><img alt=\"Trên tay iPhone 8\" src=\"https://cdn2.tgdd.vn/Files/2017/09/13/1021096/p9122088_800x451.jpg\" title=\"Trên tay iPhone 8\" /></a></p>\r\n\r\n<p>Phong c&aacute;ch mới cũng đồng thời loại bỏ ho&agrave;n to&agrave;n những chi tiết thừa như phần anten tr&ecirc;n mặt lưng để đưa thiết kế iPhone 8 đến độ ho&agrave;n hảo.</p>\r\n\r\n<p><a href=\"https://cdn.tgdd.vn/Files/2017/09/13/1021096/p9122102_800x450.jpg\" onclick=\"return false;\"><img alt=\"Trên tay iPhone 8\" src=\"https://cdn4.tgdd.vn/Files/2017/09/13/1021096/p9122102_800x450.jpg\" title=\"Trên tay iPhone 8\" /></a></p>\r\n\r\n<h3>M&agrave;n h&igrave;nh chất lượng</h3>\r\n\r\n<p>Mặt trước iPhone 8 vẫn sở hữu m&agrave;n h&igrave;nh 4.7 inch độ ph&acirc;n giải Retina HD nhưng được Apple n&acirc;ng cấp v&agrave; gọi bằng c&aacute;i t&ecirc;n Retina HD True Tone với khả năng hiển thị m&agrave;u ch&iacute;nh x&aacute;c hơn. Ph&iacute;m home cảm ứng lực 3D Touch t&iacute;ch hợp với cả cảm biến v&acirc;n tay.&nbsp;</p>\r\n\r\n<p><a href=\"https://cdn.tgdd.vn/Files/2017/09/13/1021096/p9122098_800x451.jpg\" onclick=\"return false;\"><img alt=\"Trên tay iPhone 8\" src=\"https://cdn1.tgdd.vn/Files/2017/09/13/1021096/p9122098_800x451.jpg\" title=\"Trên tay iPhone 8\" /></a></p>\r\n\r\n<h3>N&acirc;ng cấp camera</h3>\r\n\r\n<p>Camera ch&iacute;nh c&oacute; độ ph&acirc;n giải 12 MP, khẩu độ F/1.8 c&ugrave;ng rất nhiều cải tiến về h&igrave;nh ảnh, độ sắc n&eacute;t, tốc độ hay khả năng chụp thiếu s&aacute;ng. Ngo&agrave;i ra c&ograve;n n&acirc;ng cấp một v&agrave;i điểm như hỗ trợ quay video 4K @60fps, v&agrave; n&acirc;ng tiếp video 240fps l&ecirc;n độ ph&acirc;n giải 1080p.</p>\r\n\r\n<p><a href=\"https://cdn.tgdd.vn/Files/2017/09/13/1021096/p9122104_800x451.jpg\" onclick=\"return false;\"><img alt=\"Trên tay iPhone 8\" src=\"https://cdn3.tgdd.vn/Files/2017/09/13/1021096/p9122104_800x451.jpg\" title=\"Trên tay iPhone 8\" /></a></p>\r\n\r\n<p>Camera trước vẫn c&oacute; độ ph&acirc;n giải 7 MP c&ugrave;ng khẩu độ F/2.2.</p>\r\n\r\n<p>Điểm nổi bật nhất phải kể đến l&agrave; t&iacute;nh năng chụp &aacute;nh s&aacute;ng s&acirc;n khấu cho ph&eacute;p thay đổi g&oacute;c hắt s&aacute;ng v&agrave;o khu&ocirc;n mặt tạo ra c&aacute;c bức ảnh nghệ thuật như trong ph&ograve;ng studio chuy&ecirc;n nghiệp.</p>\r\n\r\n<p><a href=\"https://www.thegioididong.com/images/42/114112/iphone-8-256gb-h5-1.jpg\" onclick=\"return false;\"><img alt=\"iphone-8-256gb\" src=\"https://cdn.tgdd.vn/Products/Images/42/114112/iphone-8-256gb-h5-1.jpg\" title=\"iphone-8-256gb\" /></a></p>\r\n\r\n<h3>Cấu h&igrave;nh mạnh mẽ nhất</h3>\r\n\r\n<p>Điểm qua cấu h&igrave;nh, iPhone 8 sẽ sử dụng con chip 6 nh&acirc;n A11 Bionic tương tự như tr&ecirc;n&nbsp;<a href=\"https://www.thegioididong.com/dtdd/iphone-x-64gb\" target=\"_blank\" title=\"iPhone X\" type=\"iPhone X\">iPhone X</a>, chip c&oacute; sức mạnh cao cấp nhất t&iacute;nh đến thời điểm ra mắt iPhone 8, c&ugrave;ng 2 GB RAM.&nbsp;&nbsp;</p>\r\n\r\n<p><a href=\"https://cdn.tgdd.vn/Files/2017/09/13/1021096/p9122097_800x451.jpg\" onclick=\"return false;\"><img alt=\"Trên tay iPhone 8\" src=\"https://cdn2.tgdd.vn/Files/2017/09/13/1021096/p9122097_800x451.jpg\" title=\"Trên tay iPhone 8\" /></a></p>\r\n\r\n<p>Kết hợp c&ugrave;ng phi&ecirc;n bản iOS 11, cả iPhone 8 nhấn mạnh v&agrave;o khả năng tr&igrave;nh chiếu thực tế ảo AR mang đến những trải nghiệm ho&agrave;n to&agrave;n kh&aacute;c biệt so với trước đ&acirc;y.</p>\r\n\r\n<p><a href=\"https://www.thegioididong.com/images/42/114112/iphone-8-256gb-h10-1.jpg\" onclick=\"return false;\"><img alt=\"iphone-8-256gb\" src=\"https://cdn4.tgdd.vn/Products/Images/42/114112/iphone-8-256gb-h10-1.jpg\" title=\"iphone-8-256gb\" /></a></p>\r\n\r\n<h3>Chống nước, bụi cao cấp</h3>\r\n\r\n<p>iPhone 8 kh&ocirc;ng qu&ecirc;n t&iacute;ch hợp chuẩn chống nước, bụi cao cấp mang đến sự an to&agrave;n, bền bỉ cũng như khả năng sử dụng l&acirc;u d&agrave;i chống chịu nhiều điều kiện thời tiết.</p>\r\n\r\n<p><a href=\"https://www.thegioididong.com/images/42/114112/iphone-8-256gb-h1-1.jpg\" onclick=\"return false;\"><img alt=\"iPhone 8 256GB\" src=\"https://cdn1.tgdd.vn/Products/Images/42/114112/iphone-8-256gb-h1-1.jpg\" title=\"iPhone 8 256GB\" /></a></p>\r\n',20990000,11,'M&agrave;n h&igrave;nh:	LED-backlit IPS LCD, 4.7&quot;, Retina HD\r\nHệ điều h&agrave;nh:	iOS 11\r\nCamera sau:	12 MP\r\nCamera trước:	7 MP\r\nCPU:	Apple A11 Bionic 6 nh&acirc;n\r\nRAM:	2 GB\r\nBộ nhớ trong:	64 GB',1513062277,20,1,NULL,1,1,1513333612),(6,1,'Laptop HP Probook 440','laptop-hp-probook-440',10,274,'[\"276\",\"275\"]','<p>M&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 l&agrave; d&ograve;ng m&aacute;y t&iacute;nh x&aacute;ch tay th&iacute;ch hợp cho doanh nghiệp v&agrave; những người l&agrave;m văn ph&ograve;ng. Do đ&oacute;, ngo&agrave;i cấu h&igrave;nh tốt, thiết kế bền bỉ, m&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 c&ograve;n c&oacute; khả năng bảo mật to&agrave;n diện gi&uacute;p bạn lu&ocirc;n y&ecirc;n t&acirc;m về dữ liệu của m&igrave;nh.</p>\r\n\r\n<p>M&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 l&agrave; d&ograve;ng m&aacute;y t&iacute;nh x&aacute;ch tay th&iacute;ch hợp cho doanh nghiệp v&agrave; những người l&agrave;m văn ph&ograve;ng. Do đ&oacute;, ngo&agrave;i cấu h&igrave;nh tốt, thiết kế bền bỉ, m&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 c&ograve;n c&oacute; khả năng bảo mật to&agrave;n diện gi&uacute;p bạn lu&ocirc;n y&ecirc;n t&acirc;m về dữ liệu của m&igrave;nh.</p>\r\n\r\n<p>M&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 l&agrave; d&ograve;ng m&aacute;y t&iacute;nh x&aacute;ch tay th&iacute;ch hợp cho doanh nghiệp v&agrave; những người l&agrave;m văn ph&ograve;ng. Do đ&oacute;, ngo&agrave;i cấu h&igrave;nh tốt, thiết kế bền bỉ, m&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 c&ograve;n c&oacute; khả năng bảo mật to&agrave;n diện gi&uacute;p bạn lu&ocirc;n y&ecirc;n t&acirc;m về dữ liệu của m&igrave;nh.</p>\r\n\r\n<p>M&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 l&agrave; d&ograve;ng m&aacute;y t&iacute;nh x&aacute;ch tay th&iacute;ch hợp cho doanh nghiệp v&agrave; những người l&agrave;m văn ph&ograve;ng. Do đ&oacute;, ngo&agrave;i cấu h&igrave;nh tốt, thiết kế bền bỉ, m&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 c&ograve;n c&oacute; khả năng bảo mật to&agrave;n diện gi&uacute;p bạn lu&ocirc;n y&ecirc;n t&acirc;m về dữ liệu của m&igrave;nh.</p>\r\n',10000000,12,'M&agrave;n h&igrave;nh:	LED-backlit IPS LCD, 4.7&quot;, Retina HD Hệ điều h&agrave;nh:	iOS 11 Camera sau:	12 MP Camera trước:	7 MP CPU:	Apple A11 Bionic 6 nh&acirc;n RAM:	2 GB Bộ nhớ trong:	64 GB',1513550200,20,1,9000000,1,1,1513550920),(7,1,'Laptop HP Probook 440 G2 LED Backlit','laptop-hp-probook-440-g2-led-backlit',10,277,'[\"282\",\"281\",\"280\",\"279\",\"278\"]','<p>M&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 l&agrave; d&ograve;ng m&aacute;y t&iacute;nh x&aacute;ch tay th&iacute;ch hợp cho doanh nghiệp v&agrave; những người l&agrave;m văn ph&ograve;ng. Do đ&oacute;, ngo&agrave;i cấu h&igrave;nh tốt, thiết kế bền bỉ, m&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 c&ograve;n c&oacute; khả năng bảo mật to&agrave;n diện gi&uacute;p bạn lu&ocirc;n y&ecirc;n t&acirc;m về dữ liệu của m&igrave;nh.</p>\r\n\r\n<p>M&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 l&agrave; d&ograve;ng m&aacute;y t&iacute;nh x&aacute;ch tay th&iacute;ch hợp cho doanh nghiệp v&agrave; những người l&agrave;m văn ph&ograve;ng. Do đ&oacute;, ngo&agrave;i cấu h&igrave;nh tốt, thiết kế bền bỉ, m&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 c&ograve;n c&oacute; khả năng bảo mật to&agrave;n diện gi&uacute;p bạn lu&ocirc;n y&ecirc;n t&acirc;m về dữ liệu của m&igrave;nh.</p>\r\n\r\n<p>M&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 l&agrave; d&ograve;ng m&aacute;y t&iacute;nh x&aacute;ch tay th&iacute;ch hợp cho doanh nghiệp v&agrave; những người l&agrave;m văn ph&ograve;ng. Do đ&oacute;, ngo&agrave;i cấu h&igrave;nh tốt, thiết kế bền bỉ, m&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 c&ograve;n c&oacute; khả năng bảo mật to&agrave;n diện gi&uacute;p bạn lu&ocirc;n y&ecirc;n t&acirc;m về dữ liệu của m&igrave;nh.</p>\r\n\r\n<p>M&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 l&agrave; d&ograve;ng m&aacute;y t&iacute;nh x&aacute;ch tay th&iacute;ch hợp cho doanh nghiệp v&agrave; những người l&agrave;m văn ph&ograve;ng. Do đ&oacute;, ngo&agrave;i cấu h&igrave;nh tốt, thiết kế bền bỉ, m&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 c&ograve;n c&oacute; khả năng bảo mật to&agrave;n diện gi&uacute;p bạn lu&ocirc;n y&ecirc;n t&acirc;m về dữ liệu của m&igrave;nh.</p>\r\n',14700000,12,'Bộ vi xử l&yacute; :Intel Core i505200U 2.2 GHz (3MB L3)\r\nCache upto 2.7 GHz\r\nBộ nhớ RAM :4 GB (DDR3 Bus 1600 MHz)\r\nĐồ họa :Intel HD Graphics\r\nỔ đĩa cứng :500 GB (HDD)',1513550876,100,1,13230000,1,1,1513550876),(8,1,'Laptop HP Probook 440 G2 LED','laptop-hp-probook-440-g2-led',20,283,NULL,'<p>M&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 l&agrave; d&ograve;ng m&aacute;y t&iacute;nh x&aacute;ch tay th&iacute;ch hợp cho doanh nghiệp v&agrave; những người l&agrave;m văn ph&ograve;ng. Do đ&oacute;, ngo&agrave;i cấu h&igrave;nh tốt, thiết kế bền bỉ, m&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 c&ograve;n c&oacute; khả năng bảo mật to&agrave;n diện gi&uacute;p bạn lu&ocirc;n y&ecirc;n t&acirc;m về dữ liệu của m&igrave;nh.</p>\r\n\r\n<p>M&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 l&agrave; d&ograve;ng m&aacute;y t&iacute;nh x&aacute;ch tay th&iacute;ch hợp cho doanh nghiệp v&agrave; những người l&agrave;m văn ph&ograve;ng. Do đ&oacute;, ngo&agrave;i cấu h&igrave;nh tốt, thiết kế bền bỉ, m&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 c&ograve;n c&oacute; khả năng bảo mật to&agrave;n diện gi&uacute;p bạn lu&ocirc;n y&ecirc;n t&acirc;m về dữ liệu của m&igrave;nh.</p>\r\n\r\n<p>M&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 l&agrave; d&ograve;ng m&aacute;y t&iacute;nh x&aacute;ch tay th&iacute;ch hợp cho doanh nghiệp v&agrave; những người l&agrave;m văn ph&ograve;ng. Do đ&oacute;, ngo&agrave;i cấu h&igrave;nh tốt, thiết kế bền bỉ, m&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 c&ograve;n c&oacute; khả năng bảo mật to&agrave;n diện gi&uacute;p bạn lu&ocirc;n y&ecirc;n t&acirc;m về dữ liệu của m&igrave;nh.</p>\r\n\r\n<p>M&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 l&agrave; d&ograve;ng m&aacute;y t&iacute;nh x&aacute;ch tay th&iacute;ch hợp cho doanh nghiệp v&agrave; những người l&agrave;m văn ph&ograve;ng. Do đ&oacute;, ngo&agrave;i cấu h&igrave;nh tốt, thiết kế bền bỉ, m&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 c&ograve;n c&oacute; khả năng bảo mật to&agrave;n diện gi&uacute;p bạn lu&ocirc;n y&ecirc;n t&acirc;m về dữ liệu của m&igrave;nh.</p>\r\n',10000000,12,'Bộ vi xử l&yacute; :Intel Core i505200U 2.2 GHz (3MB L3)\r\nCache upto 2.7 GHz\r\nBộ nhớ RAM :4 GB (DDR3 Bus 1600 MHz)\r\nĐồ họa :Intel HD Graphics\r\nỔ đĩa cứng :500 GB (HDD)',1513551007,100,1,8000000,1,1,1513697789),(9,1,'Laptop HP Probook 440','laptop-hp-probook',10,288,'[\"290\",\"289\"]','<p>M&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 l&agrave; d&ograve;ng m&aacute;y t&iacute;nh x&aacute;ch tay th&iacute;ch hợp cho doanh nghiệp v&agrave; những người l&agrave;m văn ph&ograve;ng. Do đ&oacute;, ngo&agrave;i cấu h&igrave;nh tốt, thiết kế bền bỉ, m&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 c&ograve;n c&oacute; khả năng bảo mật to&agrave;n diện gi&uacute;p bạn lu&ocirc;n y&ecirc;n t&acirc;m về dữ liệu của m&igrave;nh.</p>\r\n\r\n<p>M&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 l&agrave; d&ograve;ng m&aacute;y t&iacute;nh x&aacute;ch tay th&iacute;ch hợp cho doanh nghiệp v&agrave; những người l&agrave;m văn ph&ograve;ng. Do đ&oacute;, ngo&agrave;i cấu h&igrave;nh tốt, thiết kế bền bỉ, m&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 c&ograve;n c&oacute; khả năng bảo mật to&agrave;n diện gi&uacute;p bạn lu&ocirc;n y&ecirc;n t&acirc;m về dữ liệu của m&igrave;nh.</p>\r\n\r\n<p>M&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 l&agrave; d&ograve;ng m&aacute;y t&iacute;nh x&aacute;ch tay th&iacute;ch hợp cho doanh nghiệp v&agrave; những người l&agrave;m văn ph&ograve;ng. Do đ&oacute;, ngo&agrave;i cấu h&igrave;nh tốt, thiết kế bền bỉ, m&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 c&ograve;n c&oacute; khả năng bảo mật to&agrave;n diện gi&uacute;p bạn lu&ocirc;n y&ecirc;n t&acirc;m về dữ liệu của m&igrave;nh.</p>\r\n\r\n<p>M&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 l&agrave; d&ograve;ng m&aacute;y t&iacute;nh x&aacute;ch tay th&iacute;ch hợp cho doanh nghiệp v&agrave; những người l&agrave;m văn ph&ograve;ng. Do đ&oacute;, ngo&agrave;i cấu h&igrave;nh tốt, thiết kế bền bỉ, m&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 c&ograve;n c&oacute; khả năng bảo mật to&agrave;n diện gi&uacute;p bạn lu&ocirc;n y&ecirc;n t&acirc;m về dữ liệu của m&igrave;nh.</p>\r\n',10000000,12,'Bộ vi xử l&yacute; :Intel Core i505200U 2.2 GHz (3MB L3)\r\nCache upto 2.7 GHz\r\nBộ nhớ RAM :4 GB (DDR3 Bus 1600 MHz)\r\nĐồ họa :Intel HD Graphics\r\nỔ đĩa cứng :500 GB (HDD)',1513551700,100,1,9000000,1,1,1513697777),(11,0,'Motorola Moto G5S Plus','motorola-moto-g5s-plus',NULL,300,'[\"304\",\"303\",\"302\",\"301\",\"299\"]','<p>M&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 l&agrave; d&ograve;ng m&aacute;y t&iacute;nh x&aacute;ch tay th&iacute;ch hợp cho doanh nghiệp v&agrave; những người l&agrave;m văn ph&ograve;ng. Do đ&oacute;, ngo&agrave;i cấu h&igrave;nh tốt, thiết kế bền bỉ, m&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 c&ograve;n c&oacute; khả năng bảo mật to&agrave;n diện gi&uacute;p bạn lu&ocirc;n y&ecirc;n t&acirc;m về dữ liệu của m&igrave;nh.</p>\r\n\r\n<p>M&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 l&agrave; d&ograve;ng m&aacute;y t&iacute;nh x&aacute;ch tay th&iacute;ch hợp cho doanh nghiệp v&agrave; những người l&agrave;m văn ph&ograve;ng. Do đ&oacute;, ngo&agrave;i cấu h&igrave;nh tốt, thiết kế bền bỉ, m&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 c&ograve;n c&oacute; khả năng bảo mật to&agrave;n diện gi&uacute;p bạn lu&ocirc;n y&ecirc;n t&acirc;m về dữ liệu của m&igrave;nh.</p>\r\n\r\n<p>M&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 l&agrave; d&ograve;ng m&aacute;y t&iacute;nh x&aacute;ch tay th&iacute;ch hợp cho doanh nghiệp v&agrave; những người l&agrave;m văn ph&ograve;ng. Do đ&oacute;, ngo&agrave;i cấu h&igrave;nh tốt, thiết kế bền bỉ, m&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 c&ograve;n c&oacute; khả năng bảo mật to&agrave;n diện gi&uacute;p bạn lu&ocirc;n y&ecirc;n t&acirc;m về dữ liệu của m&igrave;nh.</p>\r\n\r\n<p>M&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 l&agrave; d&ograve;ng m&aacute;y t&iacute;nh x&aacute;ch tay th&iacute;ch hợp cho doanh nghiệp v&agrave; những người l&agrave;m văn ph&ograve;ng. Do đ&oacute;, ngo&agrave;i cấu h&igrave;nh tốt, thiết kế bền bỉ, m&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 c&ograve;n c&oacute; khả năng bảo mật to&agrave;n diện gi&uacute;p bạn lu&ocirc;n y&ecirc;n t&acirc;m về dữ liệu của m&igrave;nh.</p>\r\n',6990000,15,'Bộ vi xử l&yacute; :Intel Core i505200U 2.2 GHz (3MB L3) Cache upto 2.7 GHz Bộ nhớ RAM :4 GB (DDR3 Bus 1600 MHz) Đồ họa :Intel HD Graphics Ổ đĩa cứng :500 GB (HDD)',1513698599,10,1,NULL,1,1,1513698599),(12,0,'Samsung Galaxy A5','samsung-galaxy-a5',20,305,NULL,'<p>M&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 l&agrave; d&ograve;ng m&aacute;y t&iacute;nh x&aacute;ch tay th&iacute;ch hợp cho doanh nghiệp v&agrave; những người l&agrave;m văn ph&ograve;ng. Do đ&oacute;, ngo&agrave;i cấu h&igrave;nh tốt, thiết kế bền bỉ, m&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 c&ograve;n c&oacute; khả năng bảo mật to&agrave;n diện gi&uacute;p bạn lu&ocirc;n y&ecirc;n t&acirc;m về dữ liệu của m&igrave;nh.</p>\r\n\r\n<p>M&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 l&agrave; d&ograve;ng m&aacute;y t&iacute;nh x&aacute;ch tay th&iacute;ch hợp cho doanh nghiệp v&agrave; những người l&agrave;m văn ph&ograve;ng. Do đ&oacute;, ngo&agrave;i cấu h&igrave;nh tốt, thiết kế bền bỉ, m&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 c&ograve;n c&oacute; khả năng bảo mật to&agrave;n diện gi&uacute;p bạn lu&ocirc;n y&ecirc;n t&acirc;m về dữ liệu của m&igrave;nh.</p>\r\n\r\n<p>M&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 l&agrave; d&ograve;ng m&aacute;y t&iacute;nh x&aacute;ch tay th&iacute;ch hợp cho doanh nghiệp v&agrave; những người l&agrave;m văn ph&ograve;ng. Do đ&oacute;, ngo&agrave;i cấu h&igrave;nh tốt, thiết kế bền bỉ, m&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 c&ograve;n c&oacute; khả năng bảo mật to&agrave;n diện gi&uacute;p bạn lu&ocirc;n y&ecirc;n t&acirc;m về dữ liệu của m&igrave;nh.</p>\r\n\r\n<p>M&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 l&agrave; d&ograve;ng m&aacute;y t&iacute;nh x&aacute;ch tay th&iacute;ch hợp cho doanh nghiệp v&agrave; những người l&agrave;m văn ph&ograve;ng. Do đ&oacute;, ngo&agrave;i cấu h&igrave;nh tốt, thiết kế bền bỉ, m&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 c&ograve;n c&oacute; khả năng bảo mật to&agrave;n diện gi&uacute;p bạn lu&ocirc;n y&ecirc;n t&acirc;m về dữ liệu của m&igrave;nh.</p>\r\n',7990000,10,'Bộ vi xử l&yacute; :Intel Core i505200U 2.2 GHz (3MB L3) Cache upto 2.7 GHz Bộ nhớ RAM :4 GB (DDR3 Bus 1600 MHz) Đồ họa :Intel HD Graphics Ổ đĩa cứng :500 GB (HDD)',1513698700,10,1,6390000,1,1,1513698700),(13,1,'Sony Xperia XA Ultra','sony-xperia-xa-ultra',10,306,NULL,'<p>M&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 l&agrave; d&ograve;ng m&aacute;y t&iacute;nh x&aacute;ch tay th&iacute;ch hợp cho doanh nghiệp v&agrave; những người l&agrave;m văn ph&ograve;ng. Do đ&oacute;, ngo&agrave;i cấu h&igrave;nh tốt, thiết kế bền bỉ, m&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 c&ograve;n c&oacute; khả năng bảo mật to&agrave;n diện gi&uacute;p bạn lu&ocirc;n y&ecirc;n t&acirc;m về dữ liệu của m&igrave;nh.</p>\r\n\r\n<p>M&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 l&agrave; d&ograve;ng m&aacute;y t&iacute;nh x&aacute;ch tay th&iacute;ch hợp cho doanh nghiệp v&agrave; những người l&agrave;m văn ph&ograve;ng. Do đ&oacute;, ngo&agrave;i cấu h&igrave;nh tốt, thiết kế bền bỉ, m&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 c&ograve;n c&oacute; khả năng bảo mật to&agrave;n diện gi&uacute;p bạn lu&ocirc;n y&ecirc;n t&acirc;m về dữ liệu của m&igrave;nh.</p>\r\n\r\n<p>M&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 l&agrave; d&ograve;ng m&aacute;y t&iacute;nh x&aacute;ch tay th&iacute;ch hợp cho doanh nghiệp v&agrave; những người l&agrave;m văn ph&ograve;ng. Do đ&oacute;, ngo&agrave;i cấu h&igrave;nh tốt, thiết kế bền bỉ, m&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 c&ograve;n c&oacute; khả năng bảo mật to&agrave;n diện gi&uacute;p bạn lu&ocirc;n y&ecirc;n t&acirc;m về dữ liệu của m&igrave;nh.</p>\r\n\r\n<p>M&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 l&agrave; d&ograve;ng m&aacute;y t&iacute;nh x&aacute;ch tay th&iacute;ch hợp cho doanh nghiệp v&agrave; những người l&agrave;m văn ph&ograve;ng. Do đ&oacute;, ngo&agrave;i cấu h&igrave;nh tốt, thiết kế bền bỉ, m&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 c&ograve;n c&oacute; khả năng bảo mật to&agrave;n diện gi&uacute;p bạn lu&ocirc;n y&ecirc;n t&acirc;m về dữ liệu của m&igrave;nh.</p>\r\n',6990000,10,'Bộ vi xử l&yacute; :Intel Core i505200U 2.2 GHz (3MB L3) Cache upto 2.7 GHz Bộ nhớ RAM :4 GB (DDR3 Bus 1600 MHz) Đồ họa :Intel HD Graphics Ổ đĩa cứng :500 GB (HDD)',1513700060,10,1,6291000,1,1,1513700137),(15,0,'Huawei Nova 2i','huawei-nova-2i',NULL,307,NULL,'<p>M&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 l&agrave; d&ograve;ng m&aacute;y t&iacute;nh x&aacute;ch tay th&iacute;ch hợp cho doanh nghiệp v&agrave; những người l&agrave;m văn ph&ograve;ng. Do đ&oacute;, ngo&agrave;i cấu h&igrave;nh tốt, thiết kế bền bỉ, m&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 c&ograve;n c&oacute; khả năng bảo mật to&agrave;n diện gi&uacute;p bạn lu&ocirc;n y&ecirc;n t&acirc;m về dữ liệu của m&igrave;nh.</p>\r\n\r\n<p>M&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 l&agrave; d&ograve;ng m&aacute;y t&iacute;nh x&aacute;ch tay th&iacute;ch hợp cho doanh nghiệp v&agrave; những người l&agrave;m văn ph&ograve;ng. Do đ&oacute;, ngo&agrave;i cấu h&igrave;nh tốt, thiết kế bền bỉ, m&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 c&ograve;n c&oacute; khả năng bảo mật to&agrave;n diện gi&uacute;p bạn lu&ocirc;n y&ecirc;n t&acirc;m về dữ liệu của m&igrave;nh.</p>\r\n\r\n<p>M&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 l&agrave; d&ograve;ng m&aacute;y t&iacute;nh x&aacute;ch tay th&iacute;ch hợp cho doanh nghiệp v&agrave; những người l&agrave;m văn ph&ograve;ng. Do đ&oacute;, ngo&agrave;i cấu h&igrave;nh tốt, thiết kế bền bỉ, m&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 c&ograve;n c&oacute; khả năng bảo mật to&agrave;n diện gi&uacute;p bạn lu&ocirc;n y&ecirc;n t&acirc;m về dữ liệu của m&igrave;nh.</p>\r\n\r\n<p>M&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 l&agrave; d&ograve;ng m&aacute;y t&iacute;nh x&aacute;ch tay th&iacute;ch hợp cho doanh nghiệp v&agrave; những người l&agrave;m văn ph&ograve;ng. Do đ&oacute;, ngo&agrave;i cấu h&igrave;nh tốt, thiết kế bền bỉ, m&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 c&ograve;n c&oacute; khả năng bảo mật to&agrave;n diện gi&uacute;p bạn lu&ocirc;n y&ecirc;n t&acirc;m về dữ liệu của m&igrave;nh.</p>\r\n',5990000,15,'Bộ vi xử l&yacute; :Intel Core i505200U 2.2 GHz (3MB L3) Cache upto 2.7 GHz Bộ nhớ RAM :4 GB (DDR3 Bus 1600 MHz) Đồ họa :Intel HD Graphics Ổ đĩa cứng :500 GB (HDD)',1513700268,10,1,NULL,1,1,1513700268),(16,0,'HTC U Ultra Sapphire','htc-u-ultra-sapphire',NULL,308,'[\"313\",\"312\",\"311\",\"310\",\"309\"]','<p>M&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 l&agrave; d&ograve;ng m&aacute;y t&iacute;nh x&aacute;ch tay th&iacute;ch hợp cho doanh nghiệp v&agrave; những người l&agrave;m văn ph&ograve;ng. Do đ&oacute;, ngo&agrave;i cấu h&igrave;nh tốt, thiết kế bền bỉ, m&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 c&ograve;n c&oacute; khả năng bảo mật to&agrave;n diện gi&uacute;p bạn lu&ocirc;n y&ecirc;n t&acirc;m về dữ liệu của m&igrave;nh.</p>\r\n\r\n<p>M&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 l&agrave; d&ograve;ng m&aacute;y t&iacute;nh x&aacute;ch tay th&iacute;ch hợp cho doanh nghiệp v&agrave; những người l&agrave;m văn ph&ograve;ng. Do đ&oacute;, ngo&agrave;i cấu h&igrave;nh tốt, thiết kế bền bỉ, m&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 c&ograve;n c&oacute; khả năng bảo mật to&agrave;n diện gi&uacute;p bạn lu&ocirc;n y&ecirc;n t&acirc;m về dữ liệu của m&igrave;nh.</p>\r\n\r\n<p>M&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 l&agrave; d&ograve;ng m&aacute;y t&iacute;nh x&aacute;ch tay th&iacute;ch hợp cho doanh nghiệp v&agrave; những người l&agrave;m văn ph&ograve;ng. Do đ&oacute;, ngo&agrave;i cấu h&igrave;nh tốt, thiết kế bền bỉ, m&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 c&ograve;n c&oacute; khả năng bảo mật to&agrave;n diện gi&uacute;p bạn lu&ocirc;n y&ecirc;n t&acirc;m về dữ liệu của m&igrave;nh.</p>\r\n\r\n<p>M&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 l&agrave; d&ograve;ng m&aacute;y t&iacute;nh x&aacute;ch tay th&iacute;ch hợp cho doanh nghiệp v&agrave; những người l&agrave;m văn ph&ograve;ng. Do đ&oacute;, ngo&agrave;i cấu h&igrave;nh tốt, thiết kế bền bỉ, m&aacute;y t&iacute;nh x&aacute;ch tay HP Probook 440 G2 c&ograve;n c&oacute; khả năng bảo mật to&agrave;n diện gi&uacute;p bạn lu&ocirc;n y&ecirc;n t&acirc;m về dữ liệu của m&igrave;nh.</p>\r\n',9788890,10,'Bộ vi xử l&yacute; :Intel Core i505200U 2.2 GHz (3MB L3) Cache upto 2.7 GHz Bộ nhớ RAM :4 GB (DDR3 Bus 1600 MHz) Đồ họa :Intel HD Graphics Ổ đĩa cứng :500 GB (HDD)',1513700687,10,1,NULL,1,1,1515630147),(17,1,'Điện thoại Samsung Galaxy J7 Pro','dien-thoai-samsung-galaxy-j7-pro',NULL,322,'[\"324\"]','<h2>Đặc điểm nổi bật của Samsung Galaxy J7 Pro</h2>\r\n\r\n<p><img src=\"https://cdn4.tgdd.vn/Products/Images/42/103404/Slider/vi-vn-samsung-galaxy-j7-pro-(1).jpg\" /></p>\r\n\r\n<p><a href=\"https://www.thegioididong.com/tin-tuc/kinh-cuong-luc-la-gi--596319#gorillaglass4\" target=\"_blank\">T&igrave;m hiểu th&ecirc;m</a></p>\r\n\r\n<p><a href=\"https://www.thegioididong.com/hoi-dap/samsung-exynos-7870-843409\" target=\"_blank\">T&igrave;m hiểu th&ecirc;m</a></p>\r\n\r\n<p>Bộ sản phẩm chuẩn: Hộp, Pin, Sạc, Tai nghe, S&aacute;ch hướng dẫn</p>\r\n\r\n<h2>Samsung Galaxy J7 Pro l&agrave; một chiếc smartphone ph&ugrave; hợp với những người y&ecirc;u th&iacute;ch một sản phẩm pin tốt, th&iacute;ch hệ điều h&agrave;nh mới c&ugrave;ng những t&iacute;nh năng đi k&egrave;m độc quyền của&nbsp;<a href=\"https://www.thegioididong.com/dtdd-samsung\" target=\"_blank\" title=\"Điện thoại Samsung\">Samsung</a>.</h2>\r\n\r\n<h3><strong>Thiết kế độc đ&aacute;o</strong></h3>\r\n\r\n<p>Ấn tượng đầu ti&ecirc;n về thiết kế của chiếc&nbsp;Samsung Galaxy J7 Pro ch&iacute;nh l&agrave; mặt lưng của m&aacute;y. Đường cắt ăng ten ở mặt sau được ho&agrave;n thiện dạng ăn v&agrave;o th&acirc;n sau m&aacute;y sau đ&oacute; đi l&ecirc;n gần như chữ U rất đặc biệt,&nbsp;lạ mắt.</p>\r\n\r\n<p><a href=\"https://www.thegioididong.com/images/42/103404/samsung-galaxy-j7-pro4.jpg\" onclick=\"return false;\"><img alt=\"Thiết kế mới lạ\" src=\"https://cdn.tgdd.vn/Products/Images/42/103404/samsung-galaxy-j7-pro4.jpg\" title=\"Thiết kế mới lạ\" /></a></p>\r\n\r\n<p><em>Thiết kế mới lạ</em></p>\r\n\r\n<p>M&aacute;y cho cảm gi&aacute;c cầm nắm kh&aacute; đầm tay, chắc chắn với khung kim loại bo cong mềm mại ở c&aacute;c g&oacute;c.</p>\r\n\r\n<p><a href=\"https://www.thegioididong.com/images/42/103404/samsung-galaxy-j7-pro6.jpg\" onclick=\"return false;\"><img alt=\"Cảm biến vân tay một chạm\" src=\"https://cdn2.tgdd.vn/Products/Images/42/103404/samsung-galaxy-j7-pro6.jpg\" title=\"Cảm biến vân tay một chạm\" /></a></p>\r\n\r\n<p><em>Cảm biến v&acirc;n tay một chạm</em></p>\r\n\r\n<p>Ph&iacute;a trước vẫn l&agrave; m&agrave;n h&igrave;nh 5.5 inch độ ph&acirc;n giải Full HD, tr&ecirc;n tấm nền&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/man-hinh-super-amoled-la-gi-905770\" target=\"_blank\" title=\"Tìm hiểu màn hình Super AMOLED\">Super AMOLED</a>&nbsp;v&agrave; được bảo vệ bởi k&iacute;nh cường lực bo cong 2.5D.</p>\r\n\r\n<p><a href=\"https://www.thegioididong.com/images/42/103404/samsung-galaxy-j7-pro7.jpg\" onclick=\"return false;\"><img alt=\"Màn hình lớn, sắc nét\" src=\"https://cdn4.tgdd.vn/Products/Images/42/103404/samsung-galaxy-j7-pro7.jpg\" title=\"Màn hình lớn, sắc nét\" /></a></p>\r\n\r\n<p><em>M&agrave;n h&igrave;nh lớn, sắc n&eacute;t</em></p>\r\n',6990000,10,'M&agrave;n h&igrave;nh:	Super AMOLED, 5.5&quot;, Full HD\r\nHệ điều h&agrave;nh:	Android 7.0\r\nCamera sau:	13 MP\r\nCamera trước:	13 MP\r\nCPU:	Exynos 7870 8 nh&acirc;n 64-bit\r\nRAM:	3 GB',1515629614,100,1,NULL,1,1,1517468312);
/*!40000 ALTER TABLE `tbl_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_slider`
--

DROP TABLE IF EXISTS `tbl_slider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_slider` (
  `slider_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `thumb` int(11) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '2',
  `create_at` int(12) NOT NULL,
  `modify_at` int(12) NOT NULL,
  `create_by` int(5) NOT NULL,
  `modify_by` int(5) NOT NULL,
  PRIMARY KEY (`slider_id`),
  KEY `thumb` (`thumb`),
  KEY `create_by` (`create_by`),
  KEY `modify_by` (`modify_by`),
  CONSTRAINT `tbl_slider_ibfk_1` FOREIGN KEY (`thumb`) REFERENCES `tbl_media` (`media_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_slider`
--

LOCK TABLES `tbl_slider` WRITE;
/*!40000 ALTER TABLE `tbl_slider` DISABLE KEYS */;
INSERT INTO `tbl_slider` (`slider_id`, `title`, `thumb`, `active`, `create_at`, `modify_at`, `create_by`, `modify_by`) VALUES (1,'Samsung',316,1,1515586078,1515586078,1,1),(2,'Trả góp Sam sung ',317,1,1515586220,1515586220,1,1);
/*!40000 ALTER TABLE `tbl_slider` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_support`
--

DROP TABLE IF EXISTS `tbl_support`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_support` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `depict` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `thumb` int(10) NOT NULL,
  `link` varchar(200) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `active` int(1) NOT NULL DEFAULT '2',
  `page_connect` int(11) NOT NULL,
  `create_at` int(11) NOT NULL,
  `modify_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `thumb` (`thumb`),
  KEY `page_connect` (`page_connect`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_support`
--

LOCK TABLES `tbl_support` WRITE;
/*!40000 ALTER TABLE `tbl_support` DISABLE KEYS */;
INSERT INTO `tbl_support` (`id`, `title`, `depict`, `thumb`, `link`, `active`, `page_connect`, `create_at`, `modify_at`) VALUES (5,'Miễn phí vận chuyển','Tận tay khách hàng',315,NULL,1,0,1515574721,1515574721),(6,'Thanh toán nhanh','Hỗ trợ nhiều hình thức',318,NULL,1,0,1515629048,1515629048),(7,'Tiết kiệm hơn','Với nhiều ưu đãi cực lớn',319,'why-do-we-use-i.html',1,6,1515629098,1515629098),(8,'Tư vấn 24/7','1900.9999',320,'why-do-we-use-i.html',1,6,1515629152,1515629152),(9,'Đặt hàng online','Thao tác đơn giản',321,'why-do-we-use-i.html',1,6,1515629219,1515629219);
/*!40000 ALTER TABLE `tbl_support` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sytem`
--

DROP TABLE IF EXISTS `tbl_sytem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_sytem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `describe` text COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `tel` varchar(13) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `address` varchar(200) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `per_page` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sytem`
--

LOCK TABLES `tbl_sytem` WRITE;
/*!40000 ALTER TABLE `tbl_sytem` DISABLE KEYS */;
INSERT INTO `tbl_sytem` (`id`, `title`, `describe`, `tel`, `address`, `email`, `per_page`) VALUES (1,'vshop','Vshop luôn cung cấp luôn là sản phẩm chính hãng có thông tin rõ ràng, chính sách ưu đãi cực lớn cho khách hàng có thẻ thành viên.','01698411857','106 - Trần Bình - Cầu Giấy - Hà Nội','phantam.t10@gmail.com',8);
/*!40000 ALTER TABLE `tbl_sytem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_user` (
  `user_id` int(5) NOT NULL AUTO_INCREMENT,
  `password` varchar(32) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `avatar` int(11) DEFAULT NULL,
  `level` int(1) NOT NULL DEFAULT '3',
  `salt` varchar(40) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `fullname` varchar(200) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `address` text COLLATE utf8mb4_vietnamese_ci,
  `tel` varchar(13) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `facebook` varchar(200) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `modify_at` int(12) DEFAULT NULL,
  `code_confirm` varchar(200) COLLATE utf8mb4_vietnamese_ci NOT NULL DEFAULT '{}',
  `create_at` int(11) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  KEY `avatar` (`avatar`),
  CONSTRAINT `tbl_user_ibfk_1` FOREIGN KEY (`avatar`) REFERENCES `tbl_media` (`media_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user`
--

LOCK TABLES `tbl_user` WRITE;
/*!40000 ALTER TABLE `tbl_user` DISABLE KEYS */;
INSERT INTO `tbl_user` (`user_id`, `password`, `email`, `avatar`, `level`, `salt`, `active`, `fullname`, `address`, `tel`, `facebook`, `modify_at`, `code_confirm`, `create_at`) VALUES (1,'23737df6fce285b2eac4c728937a1977','phantam.t10@gmail.com',273,1,'f5f7e1c69d39eeab514bb22e9da42313',1,'Phan Văn Tâm','','01698411857','',1519976075,'[]',1511658087),(5,'87f5cc93cac27f2712a20000a8188936','phanhuy.t10@gmail.com',NULL,2,'db936adf80fcfde49bb6c795505b11ad',1,'Phan Huy',NULL,NULL,NULL,1513961210,'{}',1513956306),(6,'2cdf43a22bd3bd61c92d0a5c088dbecc','phankhuong.t10@gmail.com',NULL,3,'792a7362132bfca13a8d35ac5127bf6f',2,'Phan Khương',NULL,NULL,NULL,1513961200,'{\"reset_pass\":{\"code\":\"16bc367ed731da444a3a705f3baf8e4c\",\"time\":1513962851}}',1513961200);
/*!40000 ALTER TABLE `tbl_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'phanvantam_shop'
--

--
-- Dumping routines for database 'phanvantam_shop'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-03-06  9:51:55
