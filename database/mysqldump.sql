-- MySQL dump 10.13  Distrib 5.5.41, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: learn2program_db
-- ------------------------------------------------------
-- Server version	5.5.41-0ubuntu0.12.04.1

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
-- Table structure for table `conversations`
--

DROP TABLE IF EXISTS `conversations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conversations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userA` int(11) DEFAULT NULL,
  `userB` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conversations`
--

LOCK TABLES `conversations` WRITE;
/*!40000 ALTER TABLE `conversations` DISABLE KEYS */;
INSERT INTO `conversations` VALUES (1,1,2),(2,2,3),(3,3,4),(4,1,4),(5,2,4),(6,1,5),(7,2,5),(8,3,5),(9,4,5),(10,1,6),(11,2,6),(12,3,6),(13,4,6),(14,5,6),(15,1,7),(16,2,7),(17,3,7),(18,1,3),(19,6,7),(20,2,9),(21,7,9),(22,6,9),(23,1,9),(24,5,9),(25,3,9),(26,3,10);
/*!40000 ALTER TABLE `conversations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exercises`
--

DROP TABLE IF EXISTS `exercises`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exercises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(767) NOT NULL,
  `tips` varchar(500) DEFAULT NULL,
  `start_code` text NOT NULL,
  `expected_result` text NOT NULL,
  `serieId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `serieId` (`serieId`),
  CONSTRAINT `exercises_ibfk_1` FOREIGN KEY (`serieId`) REFERENCES `series` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exercises`
--

LOCK TABLES `exercises` WRITE;
/*!40000 ALTER TABLE `exercises` DISABLE KEYS */;
INSERT INTO `exercises` VALUES (1,'hiuh','iuh','iuh','i',1);
/*!40000 ALTER TABLE `exercises` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER check_exercise
BEFORE INSERT ON exercises
FOR EACH ROW 
BEGIN
    IF NEW.question = "" THEN
        SET NEW.question = Null;
    END IF;
    IF NEW.start_code = "" THEN
        SET NEW.start_code = Null;
    END IF;
    IF NEW.expected_result = "" THEN
        SET NEW.expected_result = Null;
    END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `given_code` text NOT NULL,
  `success` tinyint(1) NOT NULL,
  `uId` int(11) NOT NULL,
  `eId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answers`
--

LOCK TABLES `answers` WRITE;
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;
/*!40000 ALTER TABLE `answers` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER check_answer
BEFORE INSERT ON answers
FOR EACH ROW 
BEGIN
    IF NEW.given_code = "" THEN
        SET NEW.given_code = Null;
    END IF; 
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `friends`
--

DROP TABLE IF EXISTS `friends`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `friends` (
  `id1` int(11) NOT NULL DEFAULT '0',
  `id2` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id1`,`id2`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `friends`
--

LOCK TABLES `friends` WRITE;
/*!40000 ALTER TABLE `friends` DISABLE KEYS */;
INSERT INTO `friends` VALUES (1,2),(1,9),(2,9),(3,7);
/*!40000 ALTER TABLE `friends` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER check_friends
BEFORE INSERT ON friends
FOR EACH ROW 
BEGIN
    IF NEW.id1 = NEW.id2 THEN
        SET NEW.id1 = Null;
    END IF;
    IF EXISTS (SELECT * FROM friends WHERE (id1 = NEW.id1 and id2 = NEW.id2) or (id1 = NEW.id2 and id2 = NEW.id1)) THEN
        SET NEW.id1 = Null;
    END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `founderId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `founderId` (`founderId`),
  CONSTRAINT `groups_ibfk_1` FOREIGN KEY (`founderId`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'bebis',2);
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER check_group
BEFORE INSERT ON groups
FOR EACH ROW 
BEGIN
    IF NEW.name = "" THEN
        SET NEW.name = Null;
    END IF; 
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `members_of_groups`
--

DROP TABLE IF EXISTS `members_of_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members_of_groups` (
  `memberId` int(11) NOT NULL DEFAULT '0',
  `groupId` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`memberId`,`groupId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members_of_groups`
--

LOCK TABLES `members_of_groups` WRITE;
/*!40000 ALTER TABLE `members_of_groups` DISABLE KEYS */;
INSERT INTO `members_of_groups` VALUES (1,1),(2,1);
/*!40000 ALTER TABLE `members_of_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `conversationId` int(11) DEFAULT NULL,
  `message` text NOT NULL,
  `author` varchar(50) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (0,'heyyooo','2','2015-03-10 20:18:04'),(1,'aaaaa','2','2015-03-10 20:25:19'),(1,'fff','2','2015-03-10 20:26:02'),(1,'fff','2','2015-03-10 20:27:04'),(7,'ggfdsfd','2','2015-03-10 20:31:46'),(7,'ggfdsfdsa','2','2015-03-10 20:31:53'),(7,'ggfdsfdsa','2','2015-03-10 20:32:05'),(7,'poipoi','2','2015-03-10 20:32:17'),(7,'poipoi','2','2015-03-10 20:32:51'),(7,'ytreytre','2','2015-03-10 20:32:54'),(7,'pokpok','2','2015-03-10 20:37:56'),(7,'pokpok','2','2015-03-10 20:40:10'),(11,'uyguyg','2','2015-03-10 20:40:31'),(11,'iguygiuyg','2','2015-03-10 20:40:32'),(11,'kbhjvbkjhb','2','2015-03-10 20:40:34'),(11,'vkjhvkjhg','2','2015-03-10 20:40:35'),(11,'vkjghfkjhg','2','2015-03-10 20:40:36'),(11,'oiuypiyuiy','2','2015-03-10 20:40:37'),(1,'hdrdutrd','2','2015-03-10 20:52:30'),(1,'jgfjhgf','2','2015-03-10 20:52:36'),(1,'seyreyhtr','2','2015-03-10 20:55:23'),(1,'hrdhr','2','2015-03-10 20:56:17'),(1,'ddfjytdfj','2','2015-03-10 20:56:19'),(1,'gkygiuy','2','2015-03-10 20:57:41'),(1,'kjhguygyg','2','2015-03-10 20:57:48'),(1,'ygoug','2','2015-03-10 20:58:41'),(1,'ygoughlj','2','2015-03-10 20:58:47'),(1,'oiuhoiuh','2','2015-03-10 20:58:49'),(1,'bkjhgyiug','2','2015-03-10 20:58:51'),(1,'hubohuih','2','2015-03-10 20:58:53'),(1,'sytcetre','2','2015-03-10 20:59:08'),(1,'yhtdhytd','2','2015-03-10 20:59:10'),(1,'oijåoij','1','2015-03-10 20:59:29'),(1,'gesges','1','2015-03-10 22:22:14'),(1,'peuqihfwuirhgf','1','2015-03-10 23:31:44'),(18,'liuhliuhliuh','3','2015-03-10 23:44:14'),(2,'ypmoiunyhpniouhopå','3','2015-03-10 23:44:18'),(3,'hnoiuhpmuohömu','3','2015-03-10 23:44:22'),(12,'hmpouihmpomiuhn','3','2015-03-10 23:44:26'),(10,'iuhoiuhmpunh','6','2015-03-10 23:44:39'),(11,'mhiouhmpimuhpu','6','2015-03-10 23:44:43'),(12,'iu,hpuhpumh','6','2015-03-10 23:44:48'),(14,'mpiuhp,uhpiouhp','6','2015-03-10 23:44:53'),(14,'kpuohoimhpoh,','6','2015-03-10 23:44:54'),(19,'puoh,kpougoöoiumkypoh','6','2015-03-10 23:45:03'),(19,'fiut6gbruoyrvfcuyikyu','6','2015-03-10 23:46:13'),(19,'iturfvgutyrfciukyr','6','2015-03-10 23:46:14'),(1,'liubliyuugl','2','2015-03-11 01:29:17'),(2,'hbunihblkjh','2','2015-03-11 01:29:28'),(7,'kjbhlkjhblkjbnhlkjhljkl','2','2015-03-11 01:29:41'),(16,'iutgbyiutftyufitbdfrvhukuy','2','2015-03-11 01:29:55'),(20,'jopuimhynopiu','9','2015-03-11 01:30:32'),(21,'kbuygbkbyhjg','9','2015-03-11 01:35:06'),(20,'bkhgkyug','9','2015-03-11 01:35:13'),(22,'kybgkuynkyk','9','2015-03-11 01:35:22'),(23,'kjhbgkjhbgk','9','2015-03-11 01:36:40'),(24,'jhgfjhft','9','2015-03-11 02:10:42'),(24,'yhrdiytfd','9','2015-03-11 02:18:04'),(24,'uygoiugpiugjpiu','9','2015-03-11 02:18:06'),(24,'9769786juiyub','9','2015-03-11 02:18:07'),(24,'uyh97ny98y987ol86r8r','9','2015-03-11 02:18:09'),(24,'4w6243f56u368','9','2015-03-11 02:18:10'),(24,'fe5643ef5ifuj5','9','2015-03-11 02:18:12'),(23,'tfuybtfuyitrdi','9','2015-03-11 02:25:02'),(23,'rthecytirec','9','2015-03-11 02:25:21'),(22,'drtuytrfvk','9','2015-03-11 02:46:46'),(24,'uiyktgbliytgbh','9','2015-03-11 02:46:52'),(21,'oiutybuitvli','9','2015-03-11 02:46:56'),(8,'iohuhbnluhj','3','2015-03-11 02:47:54'),(12,'luhliuhnukhjkl','3','2015-03-11 02:48:01'),(17,'uhlunhlukjhjh','3','2015-03-11 02:48:06'),(25,'yiuknguiluhjlkh','3','2015-03-11 02:48:14'),(25,'ulyhbuh','3','2015-03-11 02:48:17'),(25,'bliygiluhg','3','2015-03-11 02:48:19'),(26,'kgflbyg','10','2015-03-11 02:49:23'),(26,'rhtdjvtdjtyd','3','2015-03-11 02:50:07'),(26,'jytfbjytfjtyvfjtf','3','2015-03-11 02:50:09'),(26,'jytfcjbjytfj','3','2015-03-11 02:50:11'),(26,'jytfjtyfctfjyf','3','2015-03-11 02:50:12'),(26,'kytb8o6776ho87','3','2015-03-11 02:50:14'),(12,'yjtrbkytrfygbrfk','3','2015-03-11 02:51:26'),(18,'dhjrdujv tyjrd','3','2015-03-11 02:51:28'),(18,'truktyvrfkuyfv','3','2015-03-11 02:52:50'),(18,'kuygbkuygk','3','2015-03-11 02:52:51'),(18,'gnkyugbkyug','3','2015-03-11 02:52:52'),(18,'ukybgkuygk','3','2015-03-11 02:52:53'),(12,'kjhgvkyubg','3','2015-03-11 02:57:17'),(26,'kuygnkygkylg','3','2015-03-11 02:57:21'),(8,'ftyjfvtjfgf','3','2015-03-11 02:57:23'),(8,'judhg\r\nuifhåouivhruophv\r\nuhrpouabhipruhbpia\r\npiei8wjhvcåwe8hj','3','2015-03-11 03:01:23'),(8,'f789432yh7tfc654ht78g5632g87\r\nu78098yu809y0u\r\n9u08y908y\r\n9y90o8u8u','3','2015-03-11 03:01:49'),(8,'p986hg786987\r\nirojgoirhgriuh\r\nuhfioeufhi','3','2015-03-11 03:02:53'),(12,'ouihobiuhui','3','2015-03-11 03:17:52'),(3,'trjvfyuk','3','2015-03-11 05:04:09'),(20,'guyobguykg','2','2015-03-12 12:49:56'),(20,'uiygnuiygnkuhg','2','2015-03-12 12:49:58'),(20,'jkhgnuyngk','2','2015-03-12 12:49:59'),(20,'jkhgnkuyg','2','2015-03-12 12:50:00'),(20,'kjhbgky','2','2015-03-12 12:50:02'),(20,'oijjoij\r\njio0joi','2','2015-03-12 17:54:27'),(2,'jgftuvf','2','2015-03-12 19:19:57'),(2,'uiytbhgk','2','2015-03-12 19:19:59'),(11,'jhgfcvuiytfvb','2','2015-03-12 19:20:03'),(7,'kugbykj','2','2015-03-12 19:44:19'),(7,'hygfcjfdjyjd','2','2015-03-12 20:08:54'),(7,'jydyydtjrydjtfgxdsfdzhz','2','2015-03-12 20:09:02'),(7,'oiuhoiuhiuhpuihpiuhpihu\r\n\r\nui\r\n\r\njj\r\n\r\njjj\r\nj','2','2015-03-12 20:29:03'),(7,'yukgfvkygy','2','2015-03-13 20:08:50');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `series`
--

DROP TABLE IF EXISTS `series`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `series` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `makerId` int(11) NOT NULL,
  `tId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`,`tId`),
  KEY `makerId` (`makerId`),
  KEY `tId` (`tId`),
  CONSTRAINT `series_ibfk_1` FOREIGN KEY (`makerId`) REFERENCES `users` (`id`),
  CONSTRAINT `series_ibfk_2` FOREIGN KEY (`tId`) REFERENCES `types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `series`
--

LOCK TABLES `series` WRITE;
/*!40000 ALTER TABLE `series` DISABLE KEYS */;
INSERT INTO `series` VALUES (1,'uhoiuh','',3,1);
/*!40000 ALTER TABLE `series` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER check_title
BEFORE INSERT ON series
FOR EACH ROW 
BEGIN
    IF NEW.title = "" THEN
        SET NEW.title = Null;
    END IF; 
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `series_ratings`
--

DROP TABLE IF EXISTS `series_ratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `series_ratings` (
  `userId` int(11) NOT NULL DEFAULT '0',
  `serieId` int(11) NOT NULL DEFAULT '0',
  `rating` enum('0','1','2','3','4','5') NOT NULL,
  PRIMARY KEY (`userId`,`serieId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `series_ratings`
--

LOCK TABLES `series_ratings` WRITE;
/*!40000 ALTER TABLE `series_ratings` DISABLE KEYS */;
/*!40000 ALTER TABLE `series_ratings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `types`
--

DROP TABLE IF EXISTS `types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(50) NOT NULL,
  `difficulty` enum('easy','intermediate','hard','insane') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subject` (`subject`,`difficulty`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `types`
--

LOCK TABLES `types` WRITE;
/*!40000 ALTER TABLE `types` DISABLE KEYS */;
INSERT INTO `types` VALUES (1,'oijhoiu','easy');
/*!40000 ALTER TABLE `types` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER check_type
BEFORE INSERT ON types
FOR EACH ROW 
BEGIN
    IF NEW.subject = "" THEN
        SET NEW.subject = Null;
    END IF; 
    IF NEW.difficulty = "" THEN
        SET NEW.difficulty = Null;
    END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pass` varchar(255) NOT NULL,
  `username` varchar(20) NOT NULL,
  `mail` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'$2y$10$iaTD313ZErJ3IddvR9qnfOJtWvs.y5QSZKYw68p.nflgLY3Pa7ZmS','mina','mina@beba.com'),(2,'$2y$10$sp6h91IRWu/DQveENb5qn.zXjskJaaqPO2Z2.wVBBZ1ClartaMIo.','arminn','armin@armin.armin'),(3,'$2y$10$.vz2qXgntQsB3zqSZfIg6upebqCa1FzP9w5ruwEDszzxvrbzsMOAi','c','c@c.c'),(4,'$2y$10$QMFPxXHpEcp/BteZQcYWouMdYzwbbUzEI6xhmo3bfEY3u4Eh5bNs.','d','d@d.d'),(5,'$2y$10$engN2gtDcQ7d61KCAGcwEe9Vt3pXovforrzrepYsKJwEzVtMcLAYO','e','e@e.e'),(6,'$2y$10$rKR/ss95.dwPPC1tLsrjpeXfXHapULKw2mb8F4pgLiplHS/wdGU6.','f','f@f.f'),(7,'$2y$10$TqEnipfXtgabsOhpyeeZe.DIW.e.HYpoQG.1D89qU.qZ3ulqDqe4K','g','g@g.g'),(9,'$2y$10$FGuaNdDaCg3VWQnG4gtEbuX5LrPUKTBGFXZaDhRQ3t3wkvy8DS5Je','h','h@h.h'),(10,'$2y$10$LBOHwH9PcbIttlv26piBKebA0SOWeFuN5zaaanxRQE7.Ds8jfkYX6','j','j@j.j'),(11,'$2y$10$NJhLMhaYRMKiYDOt3fAtDefD.z.ShpS8Z9aAz2.ft.srqFBORYHry','hcedhtcejytedejtvejy','d@d.d'),(12,'$2y$10$hWySu.zIp3piGHkbm1U8wO9jIaRkux4uOAQBdssaRd28M87HbL.2q','uuu','h@h.h');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER check_users
BEFORE INSERT ON users 
FOR EACH ROW 
BEGIN
    IF NEW.pass = "" THEN
        SET NEW.pass = Null;
    END IF;
    IF NEW.username = "" THEN
        SET NEW.username = Null;
    END IF;
    IF NEW.mail = "" THEN
        SET NEW.pass = Null;
    END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-03-16 23:34:35
