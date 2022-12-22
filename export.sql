-- MySQL dump 10.13  Distrib 8.0.31, for Linux (x86_64)
--
-- Host: localhost    Database: vflix
-- ------------------------------------------------------
-- Server version	8.0.31-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `actor`
--

DROP TABLE IF EXISTS `actor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `actor` (
  `actor_id` int NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`actor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actor`
--

LOCK TABLES `actor` WRITE;
/*!40000 ALTER TABLE `actor` DISABLE KEYS */;
INSERT INTO `actor` VALUES (1,'Leonardo di Caprio'),(2,'Park Hoon'),(3,'Shin Sia'),(4,'Park Eun-bin'),(5,'Seo Eun-Soo'),(6,'Takuya Eguchi'),(7,'Saori Hayami'),(8,'Atsumi Tanezaki');
/*!40000 ALTER TABLE `actor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ci_sessions` (
  `id` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp` int unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `episode`
--

DROP TABLE IF EXISTS `episode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `episode` (
  `episode_id` int NOT NULL AUTO_INCREMENT,
  `season_id` int NOT NULL,
  `title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `qlt` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`episode_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `episode`
--

LOCK TABLES `episode` WRITE;
/*!40000 ALTER TABLE `episode` DISABLE KEYS */;
INSERT INTO `episode` VALUES (8,8,'Episisode #1','readyforlove',NULL),(9,9,'Soundtrack S1 01-р анги','Soundtrack1_01','[\"720\"]'),(10,9,'Soundtrack S1 02-р анги','Soundtrack1_02','[\"720\"]'),(11,9,'Soundtrack S1 03-р анги','Soundtrack1 03',NULL),(12,9,'Soundtrack S1 04-р анги','Soundtrack1 04','null'),(13,12,'BigMouth S1 1-р анги','BigMouthS1_01','[\"720\"]'),(14,12,'BigMouth S1 2-р анги','BigMouthS1_02','[\"720\"]'),(15,12,'BigMouth S1 3-р анги','BigMouthS1_03',NULL),(16,12,'BigMouth S1 4-р анги','BigMouthS1_04',NULL),(17,12,'BigMouth S1 5-р анги','BigMouthS1_05',NULL),(18,12,'BigMouth S1 6-р анги','BigMouthS1_06','null'),(19,12,'BigMouth S1 7-р анги','BigMouthS1_07',NULL);
/*!40000 ALTER TABLE `episode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faq`
--

DROP TABLE IF EXISTS `faq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faq` (
  `faq_id` int NOT NULL AUTO_INCREMENT,
  `question` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`faq_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faq`
--

LOCK TABLES `faq` WRITE;
/*!40000 ALTER TABLE `faq` DISABLE KEYS */;
/*!40000 ALTER TABLE `faq` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `genre`
--

DROP TABLE IF EXISTS `genre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `genre` (
  `genre_id` int NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`genre_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genre`
--

LOCK TABLES `genre` WRITE;
/*!40000 ALTER TABLE `genre` DISABLE KEYS */;
INSERT INTO `genre` VALUES (1,'Комеди'),(2,'Адал явдалт'),(3,'Action'),(5,'Гэмт хэрэг'),(6,'Баримтат'),(7,'Драм'),(8,'Гэр бүл, хүүхийн'),(9,'Уран зөгнөлт'),(10,'Түүхэн'),(11,'Аймшгийн'),(12,'Нууцлаг'),(13,'Романс'),(14,'Шинжлэх ухааны'),(15,'Триллер'),(16,'Дайн байлдаан'),(17,'Тулаант'),(18,'Вестерн');
/*!40000 ALTER TABLE `genre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movie`
--

DROP TABLE IF EXISTS `movie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `movie` (
  `movie_id` int NOT NULL AUTO_INCREMENT,
  `title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_short` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_long` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` int NOT NULL,
  `rating` int NOT NULL,
  `genre_id` int NOT NULL,
  `actors` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured` int NOT NULL,
  `kids_restriction` int NOT NULL DEFAULT '0',
  `url` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `qlt` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`movie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movie`
--

LOCK TABLES `movie` WRITE;
/*!40000 ALTER TABLE `movie` DISABLE KEYS */;
INSERT INTO `movie` VALUES (7,'Test kino','','Test kino',2022,5,2,'[]',0,0,'demonslayer','[\"1080\",\"720\"]');
/*!40000 ALTER TABLE `movie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paylog`
--

DROP TABLE IF EXISTS `paylog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paylog` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `client` varchar(32) DEFAULT NULL,
  `forwarder` varchar(32) DEFAULT NULL,
  `remote` varchar(32) DEFAULT NULL,
  `params` longtext,
  `text` varchar(55) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paylog`
--

LOCK TABLES `paylog` WRITE;
/*!40000 ALTER TABLE `paylog` DISABLE KEYS */;
INSERT INTO `paylog` VALUES (1,NULL,NULL,'122.201.23.201','test','loremipsum','2022-12-13 10:13:19'),(2,NULL,NULL,'122.201.23.201','13500/7e3fef7c52a7592f736707baf76c45c4e0c588306854aeb372cdb626abc715db','Багц олдсонгүй','2022-12-13 10:20:43'),(3,NULL,NULL,'122.201.23.201','13500/7e3fef7c52a7592f736707baf76c45c4e0c588306854aeb372cdb626abc715db','Багц олдсонгүй','2022-12-13 10:21:03'),(4,NULL,NULL,'122.201.23.201','9900/5280dbf5b8c1467d3f63508f8293ee390d828163fee7856bc5bb2400d8e90804','Хэрэглэгч олдсонгүй','2022-12-13 10:37:37'),(5,NULL,NULL,'122.201.23.201','9500/5280dbf5b8c1467d3f63508f8293ee390d828163fee7856bc5bb2400d8e90804','Хэрэглэгч олдсонгүй','2022-12-13 10:38:23');
/*!40000 ALTER TABLE `paylog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plan`
--

DROP TABLE IF EXISTS `plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `plan` (
  `plan_id` int NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `screens` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL COMMENT '1 active, 0 inactive',
  `months` tinyint DEFAULT '1',
  PRIMARY KEY (`plan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plan`
--

LOCK TABLES `plan` WRITE;
/*!40000 ALTER TABLE `plan` DISABLE KEYS */;
INSERT INTO `plan` VALUES (1,'1 сар','1','5000',1,1),(2,'2 сар','1','9500',1,2),(3,'3 сар','1','13500',1,3);
/*!40000 ALTER TABLE `plan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `season`
--

DROP TABLE IF EXISTS `season`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `season` (
  `season_id` int NOT NULL AUTO_INCREMENT,
  `series_id` int NOT NULL,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`season_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `season`
--

LOCK TABLES `season` WRITE;
/*!40000 ALTER TABLE `season` DISABLE KEYS */;
INSERT INTO `season` VALUES (1,1,'Season 1'),(2,30,'Season 1'),(3,1,'Season 2'),(4,1,'Season 3'),(5,1,'Season 4'),(6,41,'Season 1'),(8,46,'Season 1'),(9,49,'Season 1'),(10,49,'Season 2'),(12,50,'Season 1');
/*!40000 ALTER TABLE `season` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `series`
--

DROP TABLE IF EXISTS `series`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `series` (
  `series_id` int NOT NULL AUTO_INCREMENT,
  `title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_short` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_long` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `genre_id` int NOT NULL,
  `actors` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'comma separated actor_id',
  `year` int NOT NULL,
  `rating` int DEFAULT '5',
  `featured` int NOT NULL,
  `kids_restriction` int NOT NULL,
  `episodes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`series_id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `series`
--

LOCK TABLES `series` WRITE;
/*!40000 ALTER TABLE `series` DISABLE KEYS */;
INSERT INTO `series` VALUES (49,'Soundtrack','','Хан Сон Ү бол шинэхэн зурагчин залуу. Тэрээр И Ин Со-той 19 жил найзалж байгаа бөгөөд санаандгүйгээр 2 долоо хоног хамтдаа амьдрах шаардлагатай болно. И Ин Со бол дууны үг бичиж амьдралаа залгуулдаг. Сон Ү Ин Со хоёр хамт амьдрах болсноор тэдний харилцаа өөрчлөгдөж бие биенээ өөрөөр харж эхэлнэ.\r\n',2,'',2022,NULL,0,0,'',2),(50,'Том амт','','Хан Сон Ү бол шинэхэн зурагчин залуу. Тэрээр И Ин Со-той 19 жил найзалж байгаа бөгөөд санаандгүйгээр 2 долоо хоног хамтдаа амьдрах шаардлагатай болно. И Ин Со бол дууны үг бичиж амьдралаа залгуулдаг. Сон Ү Ин Со хоёр хамт амьдрах болсноор тэдний харилцаа өөрчлөгдөж бие биенээ өөрөөр харж эхэлнэ. Soundtrack #1 2022 | бүх анги Монгол хадмалаар орж дууслаа\r\n',2,'',2022,NULL,0,0,'',2);
/*!40000 ALTER TABLE `series` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `settings_id` int NOT NULL AUTO_INCREMENT,
  `type` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`settings_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'site_name','Videoflix'),(2,'site_email',''),(3,'paypal_merchant_email',''),(4,'invoice_address',''),(5,'language','english'),(6,'purchase_code',''),(7,'privacy_policy',''),(8,'refund_policy',''),(9,'terms','test terms');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sms`
--

DROP TABLE IF EXISTS `sms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sms` (
  `id` int NOT NULL AUTO_INCREMENT,
  `client` varchar(55) DEFAULT NULL,
  `forwarder` varchar(55) DEFAULT NULL,
  `remote` varchar(55) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `phone` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription`
--

DROP TABLE IF EXISTS `subscription`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subscription` (
  `subscription_id` int NOT NULL AUTO_INCREMENT,
  `plan_id` int NOT NULL,
  `user_id` int NOT NULL,
  `price_amount` int NOT NULL,
  `paid_amount` float NOT NULL,
  `timestamp_from` int NOT NULL,
  `timestamp_to` int NOT NULL,
  `payment_method` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'bank',
  `payment_details` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '--',
  `payment_timestamp` int NOT NULL,
  `status` int NOT NULL DEFAULT '1' COMMENT '1 active, 0 cancelled',
  PRIMARY KEY (`subscription_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `type` int NOT NULL COMMENT '1 admin, 0 customer',
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `phone` int NOT NULL,
  `email` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `password` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user1` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user 1',
  `user1_session` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user1_movielist` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user1_serieslist` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `plan_id` int NOT NULL,
  `status` int NOT NULL DEFAULT '1' COMMENT '0 banned',
  `verified` tinyint NOT NULL DEFAULT '0',
  `verified_timestamp` timestamp NULL DEFAULT NULL,
  `otp` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `hash` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `phone` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,1,'Mr. Admin',98950575,'admin@neontoon.mn','c9d8bba5244022fabf59d0aa7a5edf0dfbf51338','','','','',0,1,1,NULL,NULL,'2022-12-12 00:59:50',NULL),(5,0,'Aagii',86950575,NULL,'Aagii@555','user 1','1670733225','[1, 5, 8]','',0,1,2,'0000-00-00 00:00:00','3611','2022-12-12 00:59:50','7e3fef7c52a7592f736707baf76c45c4e0c588306854aeb372cdb626abc715db'),(6,1,'achka_admin',85008599,NULL,'4990dd968c77fcf4fc28163eb1ab1dbd4311c34f','user 1','','','',0,1,2,'0000-00-00 00:00:00','9912','2022-12-12 00:59:50',NULL),(8,0,'Enhee',99081113,NULL,'4c15a7b39df971affc4ac1d9354b215778f764c0','user 1','1671173010','','',0,1,2,'0000-00-00 00:00:00','6177','2022-12-12 00:59:50',NULL),(9,1,'Лхагваа',89358569,NULL,'beca3691d7899355b9a7312efde54f7f2a186a5e','user 1','1670928999','','',0,1,2,'0000-00-00 00:00:00','6629','2022-12-12 00:59:50',NULL),(10,0,'Kami',90122470,NULL,'0d538adeb3fc4403ec13222ee156d2c6ce9cdbfc','user 1','1668677906','','',0,1,2,'0000-00-00 00:00:00','2259','2022-12-12 00:59:50',NULL),(11,0,'user',94340307,NULL,'fd64bfd46af4c6fee8fb8dca28c6d4ebc13eaca8','user 1','','','',0,1,0,NULL,'3454','2022-12-12 00:59:50',NULL),(12,0,'Duluu',89638944,NULL,'35be8534da484967b17efa86055b341388d64ccf','user 1','','','',0,1,2,'0000-00-00 00:00:00','7366','2022-12-12 00:59:50',NULL),(13,0,NULL,65987845,NULL,'a47eb9fe98dca82bfa93638b7eb3c6799ba6ea2f','user 1','','','',0,1,0,NULL,'8315','2022-12-12 00:59:50',NULL),(14,0,NULL,45127845,NULL,'881605d60dbb38012019f3c51560b100b275df79','user 1','','','',0,1,0,NULL,'8996','2022-12-12 00:59:50',NULL),(15,0,NULL,12457889,NULL,'ecfb2b4481dac8d932ef71f352b9feff56e7c77e','user 1','','','',0,1,0,NULL,'6081','2022-12-12 00:59:50',NULL),(17,0,'Esko',99743622,NULL,'7fabf303f5defc1745c54daeca882b90e0480a95','user 1','1669560400','','',0,1,2,'0000-00-00 00:00:00','6412','2022-12-12 00:59:50',NULL),(20,0,'Aagii',80102053,NULL,'c9d8bba5244022fabf59d0aa7a5edf0dfbf51338','user 1','1671179945','','',0,1,2,'0000-00-00 00:00:00','5508','2022-12-12 00:59:50',NULL),(23,0,'soko',95949674,NULL,'4c15a7b39df971affc4ac1d9354b215778f764c0','user 1','1671193168','','',0,1,2,'0000-00-00 00:00:00','8000','2022-12-16 10:47:23',NULL),(24,0,'Orgil',94615574,NULL,'371c37f256538afb4362cbc959742eb0cc896cb5','user 1','1671198558','','',0,1,2,'0000-00-00 00:00:00','8763','2022-12-16 13:48:26',NULL),(25,0,'Nymaka1',86250731,NULL,'6368fc9741685b809d22bb53ae6f155f23625a91','user 1','1671203231','','',0,1,2,'0000-00-00 00:00:00','9096','2022-12-16 15:06:32',NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-12-17 15:54:13
