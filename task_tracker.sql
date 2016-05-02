-- MySQL dump 10.13  Distrib 5.6.24, for Win64 (x86_64)
--
-- Host: localhost    Database: task_tracker
-- ------------------------------------------------------
-- Server version	5.6.17

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
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_description` text,
  `start_timestamp` datetime DEFAULT NULL,
  `end_timestamp` datetime DEFAULT NULL,
  `fixed_timestamp` varchar(50) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `assigned_to` int(11) DEFAULT NULL,
  `is_daily` int(11) DEFAULT '0',
  `status` varchar(45) DEFAULT 'Pending',
  `signature` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks`
--

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
INSERT INTO `tasks` VALUES (1,'Upload WP to the Leads Table and Email the Client','2016-04-29 15:00:00','2016-04-29 19:00:00','',1,1,0,'Done','Joene Floresca','2016-04-29 15:25:40','2016-04-29 15:32:15'),(2,'Make some changes in WP Upload Tool','2016-04-30 15:34:00','2016-04-29 15:34:00','',1,1,0,'Done','Joene Floresca','2016-04-29 15:34:33','2016-04-29 15:58:25'),(3,'Worked on Users Module Tasks Tracker','2016-04-29 15:35:00','2016-04-30 15:35:00','',1,1,0,'Done','Joene Floresca','2016-04-29 15:35:43','2016-04-29 15:58:19'),(4,'Worked on Email Sending in Tasks Tracker','2016-04-29 15:36:00','2016-04-29 21:00:00','',1,1,0,'Pending','Joene Floresca','2016-04-29 15:36:34','2016-04-29 17:00:52'),(5,'Worked on Report Generator Tasks Tracker','2016-04-29 15:37:00','2016-04-30 15:37:00','',1,1,0,'Done','Joene Floresca','2016-04-29 15:37:42','2016-04-29 15:58:06'),(6,'Added files on new project','2016-04-29 15:41:00','2016-04-30 15:41:00','',1,1,0,'Done','Joene Floresca','2016-04-29 15:41:19','2016-04-29 15:48:11'),(7,'Finish BRK Website','2016-04-29 15:55:00','2016-04-30 15:55:00','',2,1,0,'Pending','Krishna Rao','2016-04-29 15:55:22','2016-04-29 16:03:44'),(8,'TEST','2016-05-02 19:09:00','2016-05-20 19:09:00','',1,1,0,'Pending','TEST','2016-05-02 19:09:29','2016-05-02 19:09:29'),(9,'TEST TEST','2016-05-02 19:09:00','2016-05-02 23:00:00','',1,1,0,'Pending','TEST','2016-05-02 19:09:41','2016-05-02 19:09:41'),(10,'TEST','2016-05-02 20:06:00','2016-05-19 20:06:00','',1,1,0,'Done','TEST','2016-05-02 20:06:15','2016-05-02 20:08:39'),(11,'TEST','2016-05-02 21:19:00','2016-05-13 21:19:00',NULL,1,1,1,'Pending','TEST','2016-05-02 21:19:30','2016-05-02 21:19:30');
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `access_level` int(11) NOT NULL,
  `id_number` int(11) NOT NULL,
  `ameyo_login` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `department` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_id_number_unique` (`id_number`),
  UNIQUE KEY `users_ameyo_login_unique` (`ameyo_login`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Joene Floresca','$2y$10$5vuLHHvekpZ2/VxrDIZCmem557S9yhzPW.F77ZYcOe1aJVFuEXm.e',0,1775,'1775','IT','QnFtu8r6L8SpSdwgVn6iIOj4btyYTw0u7OHgiRlHfdfSoiGTvjUgE1fenkLv','2016-02-29 01:03:22','2016-05-02 12:05:30'),(2,'Raven','$2y$10$PYAHrxbwqwhJgWoUcNGjiudH.IaRUFgQrne0PogMcMhIiduK0fmCW',0,1935,'','','fkc60Wm4DS8Gqhi9V9q5VTe1Ur9jl29hnSUIKvCXKqoxKsWtZodNswMvpnBW','2016-03-14 01:10:50','2016-04-29 07:55:46');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-02 21:33:56
