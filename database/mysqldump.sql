-- MySQL dump 10.13  Distrib 5.5.43, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: learn2program_db
-- ------------------------------------------------------
-- Server version	5.5.43-0ubuntu0.12.04.1

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
  `time` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uId` (`uId`),
  KEY `eId` (`eId`),
  CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`uId`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `answers_ibfk_2` FOREIGN KEY (`eId`) REFERENCES `exercises` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=134 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answers`
--

LOCK TABLES `answers` WRITE;
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;
INSERT INTO `answers` VALUES (1,'xx',1,1,1,NULL),(2,'xx',1,2,1,NULL),(3,'xx',1,2,2,NULL),(4,'xx',1,1,5,NULL),(5,'xx',1,1,3,NULL),(6,'xx',1,4,5,NULL),(7,'xx',1,10,10,NULL),(8,'xx',1,2,3,NULL),(9,'xx',1,9,1,NULL),(10,'xx',1,2,10,NULL),(11,'xx',1,2,7,NULL),(12,'xx',1,2,9,NULL),(13,'xx',1,2,8,NULL),(14,'xx',1,2,3,NULL),(15,'xx',1,3,10,NULL),(16,'xx',1,3,9,NULL),(17,'xx',1,3,8,NULL),(18,'xx',1,3,6,NULL),(19,'xx',1,3,3,NULL),(20,'xx',1,1,7,NULL),(21,'xx',1,4,1,NULL),(22,'xx',1,4,2,NULL),(23,'xx',1,4,3,NULL),(24,'xx',1,4,4,NULL),(25,'xx',1,4,6,NULL),(26,'xx',1,5,1,NULL),(27,'xx',1,5,2,NULL),(28,'xx',1,5,3,NULL),(29,'xx',1,5,4,NULL),(30,'xx',1,5,6,NULL),(31,'xx',1,5,7,NULL),(32,'xx',1,7,1,NULL),(33,'xx',1,7,2,NULL),(34,'xx',1,7,3,NULL),(35,'xx',1,7,4,NULL),(36,'xx',1,7,6,NULL),(37,'xx',1,7,7,NULL),(38,'xx',1,7,8,NULL),(39,'xx',1,9,1,NULL),(40,'xx',1,9,2,NULL),(41,'xx',1,9,3,NULL),(42,'xx',1,9,4,NULL),(43,'xx',1,9,6,NULL),(44,'xx',1,9,7,NULL),(45,'xx',1,9,8,NULL),(46,'xx',1,9,9,NULL),(47,'xx',1,11,2,NULL),(48,'xx',1,11,3,NULL),(49,'xx',1,11,4,NULL),(50,'xx',1,11,6,NULL),(51,'xx',1,11,7,NULL),(52,'xx',1,11,8,NULL),(53,'xx',1,11,9,NULL),(54,'xx',1,13,1,NULL),(55,'xx',1,13,2,NULL),(56,'xx',1,13,3,NULL),(57,'xx',1,13,4,NULL),(58,'xx',1,13,6,NULL),(59,'xx',1,13,7,NULL),(60,'xx',1,13,8,NULL),(61,'xx',1,13,9,NULL),(62,'xx',1,15,3,NULL),(63,'xx',1,15,4,NULL),(64,'xx',1,15,6,NULL),(65,'xx',1,15,7,NULL),(66,'xx',1,15,8,NULL),(67,'xx',1,15,9,NULL),(68,'xx',1,17,1,NULL),(69,'xx',1,17,2,NULL),(70,'xx',1,17,4,NULL),(71,'xx',1,17,6,NULL),(72,'xx',1,17,7,NULL),(73,'xx',1,17,8,NULL),(74,'xx',1,17,9,NULL),(75,'xx',1,19,1,NULL),(76,'xx',1,19,2,NULL),(77,'xx',1,19,3,NULL),(78,'xx',1,19,4,NULL),(79,'xx',1,19,6,NULL),(80,'xx',1,19,7,NULL),(81,'xx',1,19,8,NULL),(82,'xx',1,19,9,NULL),(83,'xx',1,21,1,NULL),(84,'xx',1,21,2,NULL),(85,'xx',1,21,7,NULL),(86,'xx',1,21,8,NULL),(87,'xx',1,21,9,NULL),(88,'xx',1,23,1,NULL),(89,'xx',1,23,2,NULL),(90,'xx',1,23,3,NULL),(91,'xx',1,23,4,NULL),(92,'xx',1,23,6,NULL),(93,'xx',1,23,7,NULL),(94,'xx',1,23,8,NULL),(95,'xx',1,23,9,NULL),(96,'xx',1,25,1,NULL),(97,'xx',1,25,2,NULL),(98,'xx',1,25,3,NULL),(99,'xx',1,25,4,NULL),(100,'xx',1,25,9,NULL),(101,'xx',1,27,1,NULL),(102,'xx',1,27,2,NULL),(103,'xx',1,27,3,NULL),(104,'xx',1,35,4,NULL),(105,'xx',1,35,6,NULL),(106,'xx',1,35,7,NULL),(107,'xx',1,35,8,NULL),(108,'xx',1,35,9,NULL),(109,'xx',1,35,1,NULL),(110,'xx',1,35,2,NULL),(111,'xx',1,35,3,NULL),(112,'xx',1,35,4,NULL),(113,'xx',1,35,6,NULL),(114,'xx',1,35,7,NULL),(115,'xx',1,35,8,NULL),(116,'xx',1,35,9,NULL),(117,'xx',1,35,10,NULL),(118,'xx',1,35,5,NULL),(119,'xx',1,36,6,NULL),(120,'xx',1,36,7,NULL),(121,'xx',1,36,8,NULL),(122,'xx',1,36,9,NULL),(123,'xx',1,36,1,NULL),(124,'xx',1,36,2,NULL),(125,'xx',1,36,3,NULL),(126,'xx',1,36,4,NULL),(127,'xx',1,36,6,NULL),(128,'xx',1,36,7,NULL),(129,'xx',1,36,8,NULL),(130,'xx',1,36,9,NULL),(131,'xx',1,36,10,NULL),(132,'xx',1,36,11,NULL),(133,'xx',1,36,12,NULL);
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
-- Table structure for table `challenges`
--

DROP TABLE IF EXISTS `challenges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `challenges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userA` int(11) NOT NULL,
  `userB` int(11) NOT NULL,
  `exId` int(11) NOT NULL,
  `winner` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `userA` (`userA`),
  KEY `userB` (`userB`),
  KEY `exId` (`exId`),
  CONSTRAINT `challenges_ibfk_1` FOREIGN KEY (`userA`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `challenges_ibfk_2` FOREIGN KEY (`userB`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `challenges_ibfk_3` FOREIGN KEY (`exId`) REFERENCES `exercises` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `challenges`
--

LOCK TABLES `challenges` WRITE;
/*!40000 ALTER TABLE `challenges` DISABLE KEYS */;
/*!40000 ALTER TABLE `challenges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conversations`
--

DROP TABLE IF EXISTS `conversations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conversations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conversations`
--

LOCK TABLES `conversations` WRITE;
/*!40000 ALTER TABLE `conversations` DISABLE KEYS */;
INSERT INTO `conversations` VALUES (1),(2),(3),(4),(5),(6),(7),(8),(9);
/*!40000 ALTER TABLE `conversations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conversations_participants`
--

DROP TABLE IF EXISTS `conversations_participants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conversations_participants` (
  `conversationId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`conversationId`,`userId`),
  KEY `userId` (`userId`),
  CONSTRAINT `conversations_participants_ibfk_1` FOREIGN KEY (`conversationId`) REFERENCES `conversations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `conversations_participants_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conversations_participants`
--

LOCK TABLES `conversations_participants` WRITE;
/*!40000 ALTER TABLE `conversations_participants` DISABLE KEYS */;
INSERT INTO `conversations_participants` VALUES (6,1),(7,1),(9,1),(6,2),(8,2),(7,3),(8,3),(9,36);
/*!40000 ALTER TABLE `conversations_participants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exercises`
--

DROP TABLE IF EXISTS `exercises`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exercises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(500) NOT NULL,
  `tips` varchar(500) DEFAULT NULL,
  `start_code` text NOT NULL,
  `expected_result` text NOT NULL,
  `makerId` int(11) NOT NULL,
  `language` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `makerId` (`makerId`),
  CONSTRAINT `exercises_ibfk_1` FOREIGN KEY (`makerId`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exercises`
--

LOCK TABLES `exercises` WRITE;
/*!40000 ALTER TABLE `exercises` DISABLE KEYS */;
INSERT INTO `exercises` VALUES (1,'Print \'Hello, world\'.','Submit the answer','print(\"Hello, world\")','^[Hh]ello[,]? [Ww]orld$',1,'python'),(2,'Print \'Hello, \'*your name*.','What is your name?','print(\"\")','[hH]ello, [A-Za-z]+',1,'python'),(3,'Using multiple variables.','Take the sentence \'All work and no play makes Jack a dull boy\' and store each word in a seperate variable. Print the sentence on a single line.','\"All work and no play makes Jack a dull boy\"','All work and no play makes Jack a dull boy',2,'python'),(4,'Add parenthesis to the expression 6 * 1 - 2 to change its value (?, ?, ?, ?, ?, ?) from 4 to -6.','Learn your basic maths!','result = 6 * 1 - 2\nprint(result)','-6',2,'python'),(5,'Create a function nine_dots(), using the function three_dots().','You can concatenate string with the \'+\'-operator.','def three_dots():\n    value (?, ?, ?, ?, ?, ?) = \"...\"\n    return value (?, ?, ?, ?, ?, ?)\n\nprint(nine_dots())','^\\.\\.\\.\\.\\.\\.\\.\\.\\.$',3,'python'),(6,'Fill in the body of the function definition for cat_5_times so that it will print the string, s, 5 times','Meow Meow','def cat_5_times(s):\n    <fill in your code here>','([A-Za-z0-9]+\\n){5}',3,'python'),(7,'Wrap this code in a function called compare(x, y). Call it with a first value (?, ?, ?, ?, ?, ?) that is larger than the second value (?, ?, ?, ?, ?, ?).','x < x+1','if x < y:\n    print x, \"is less than\", y\nelif x > y:\n    print x, \"is greater than\", y\nelse:\n    print x, \"and\", y, \"are equal\"','[0-9]+ is greater than [0-9]+',4,'python'),(8,'What is the answer to the ultimate question of life, the universe and everything?','It is not 24.','the_answer =\nprint(the_answer)','42',4,'python'),(9,'Given Fibonacci\'s row, what is the number with index 20','As computer scientists, the first element has index = 0.','number =\nprint(number)','6765',4,'python'),(10,'Draw a spyrograph using turtles.','Build a function capable of drawing a circle with an arbitrary color and diameter. Call that function repeatedly to draw the spyrograph.','import turtle\nalex = turtle.Turtle()\nscreen = alex.getscreen()\nscreen.setup(750,750)\nalex.speed(0)\ndef draw_track(r, color):\n    i = 0\n    while i < 50:\n        alex.pencolor(color)\n        alex.circle(r)\n        alex.right(360/49)\n        alex.forward(5)\n        i = i + 1\ncolors = [\"green\",\"purple\",\"magenta\",\"blue\",\"yellow\",\"orange\",\"red\"]\nfor color in colors:\n    if color == \"green\":\n        r = 140\n        draw_track(r, color)\n    if color == \"purple\":\n        r = 120\n        draw_track(r, color)\n    if color == \"magenta\":\n        r = 100\n        draw_track(r, color)\n    if color == \"blue\":\n        r = 80\n        draw_track(r, color)\n    if color == \"yellow\":\n        r = 60\n        draw_track(r, color)\n    if color == \"orange\":\n        r = 40\n        draw_track(r, color)\n    if color == \"red\":\n        r = 20\n        draw_track(r, color)\n','*',2,'python'),(11,'Introduce yourself with C++ classes','Use the C++ reference to learn more about classes','#include<iostream>\nclass Myclass {\n  private:\n  	int myint;\n  public:\n  	Myclass(const int& i){myint = i;};\n  	int getInt() {return myint;};\n};\n\nint main() {\n  	Myclass mc(10);\n    std::cout << mc.getInt();\n}','*',3,'cpp'),(12,'Convert the following C++ code into Python','You should first learn both languages...','#include <iostream>\n\nint main(){\n  std::cout << \"Get Rekt...\" << std::endl;\n}','^Get Rekt...$',3,'python'),(13,'Convert the following Python code to C++','You should first learn both languages...','sum = 0\nfor i in range(10)\n    sum = sum + i\nprint(i)','^45$',3,'cpp');
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
-- Table structure for table `exercises_in_series`
--

DROP TABLE IF EXISTS `exercises_in_series`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exercises_in_series` (
  `exId` int(11) NOT NULL,
  `seriesId` int(11) NOT NULL,
  `ex_index` int(11) NOT NULL,
  PRIMARY KEY (`exId`,`seriesId`),
  KEY `seriesId` (`seriesId`),
  CONSTRAINT `exercises_in_series_ibfk_1` FOREIGN KEY (`exId`) REFERENCES `exercises` (`id`) ON DELETE CASCADE,
  CONSTRAINT `exercises_in_series_ibfk_2` FOREIGN KEY (`seriesId`) REFERENCES `series` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exercises_in_series`
--

LOCK TABLES `exercises_in_series` WRITE;
/*!40000 ALTER TABLE `exercises_in_series` DISABLE KEYS */;
INSERT INTO `exercises_in_series` VALUES (1,1,1),(2,1,2),(2,2,3),(3,2,1),(4,2,2),(5,3,1),(6,3,2),(7,4,1),(8,4,2),(9,4,3),(10,5,1),(11,3,3),(12,3,4),(13,3,5);
/*!40000 ALTER TABLE `exercises_in_series` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `friends`
--

DROP TABLE IF EXISTS `friends`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `friends` (
  `id1` int(11) NOT NULL,
  `id2` int(11) NOT NULL,
  `status` enum('pending','accepted','declined') NOT NULL,
  `action_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id1`,`id2`),
  KEY `id2` (`id2`),
  KEY `action_user_id` (`action_user_id`),
  CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`id1`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`id2`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `friends_ibfk_3` FOREIGN KEY (`action_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `friends`
--

LOCK TABLES `friends` WRITE;
/*!40000 ALTER TABLE `friends` DISABLE KEYS */;
INSERT INTO `friends` VALUES (1,2,'accepted',2),(1,3,'declined',3),(1,4,'pending',4);
/*!40000 ALTER TABLE `friends` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `founderId` int(11) NOT NULL,
  `conversationId` int(11) NOT NULL,
  `private` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `founderId` (`founderId`),
  KEY `conversationId` (`conversationId`),
  CONSTRAINT `groups_ibfk_1` FOREIGN KEY (`founderId`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `groups_ibfk_2` FOREIGN KEY (`conversationId`) REFERENCES `conversations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'Group for BINF2',3,1,0),(2,'Everyone who loves python',1,2,0),(3,'WE LOVE C++ !!!',2,3,0),(4,'Join this group for help with chapter 3',1,4,0),(5,'This is a private group',1,5,1);
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
-- Table structure for table `guides`
--

DROP TABLE IF EXISTS `guides`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `guides` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `writerId` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`),
  KEY `writerId` (`writerId`),
  CONSTRAINT `guides_ibfk_1` FOREIGN KEY (`writerId`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `guides`
--

LOCK TABLES `guides` WRITE;
/*!40000 ALTER TABLE `guides` DISABLE KEYS */;
INSERT INTO `guides` VALUES (32,1,'1. The way of the program','<p>The goal of this book is to teach you to think like a computer scientist. This way of thinking&nbsp;combines some of the best features of mathematics, engineering, and natural science. Like mathematicians,&nbsp;computer scientists use formal languages to denote ideas (specifically computations).<br />Like engineers, they design things, assembling components into systems and evaluating tradeoffs&nbsp;among alternatives. Like scientists, they observe the behavior of complex systems, form hypotheses,&nbsp;and test predictions.<br />The single most important skill for a computer scientist is <strong>problem solving</strong>. Problem solving&nbsp;means the ability to formulate problems, think creatively about solutions, and express a solution<br />clearly and accurately. As it turns out, the process of learning to program is an excellent opportunity&nbsp;to practice problem-solving skills. That&rsquo;s why this chapter is called, The way of the program.<br />On one level, you will be learning to program, a useful skill by itself. On another level, you will&nbsp;use programming as a means to an end. As we go along, that end will become clearer.</p>\n                        <h2><br />1.1 The Python programming language</h2>\n                        <p><br />The programming language you will be learning is Python. Python is an example of a <strong>high-level&nbsp;</strong><strong>language</strong>; other high-level languages you might have heard of are C++, PHP, and Java.<br />As you might infer from the name high-level language, there are also <strong>low-level languages</strong>, sometimes&nbsp;referred to as machine languages or assembly languages. Loosely speaking, computers can&nbsp;only execute programs written in low-level languages. Thus, programs written in a high-level language&nbsp;have to be processed before they can run. This extra processing takes some time, which is a&nbsp;small disadvantage of high-level languages.<br />But the advantages are enormous. First, it is much easier to program in a high-level language.&nbsp;Programs written in a high-level language take less time to write, they are shorter and easier to&nbsp;read, and they are more likely to be correct. Second, high-level languages are <strong>portable</strong>, meaning&nbsp;that they can run on different kinds of computers with few or no modifications. Low-level programs&nbsp;can run on only one kind of computer and have to be rewritten to run on another.<br />Due to these advantages, almost all programs are written in high-level languages. Low-level languages&nbsp;are used only for a few specialized applications.<br />Two kinds of programs process high-level languages into low-level languages: <strong>interpreters</strong> and&nbsp;<strong>compilers</strong>. An interpreter reads a high-level program and executes it, meaning that it does what the&nbsp;program says. It processes the program a little at a time, alternately reading lines and performing&nbsp;computations.</p>\n                        <p><img src=\"http://www.greenteapress.com/thinkpython/html/thinkpython001.png\" alt=\"\" width=\"332\" height=\"79\" /></p>\n                        <p>A compiler reads the program and translates it completely before the program starts running. In&nbsp;this case, the high-level program is called the <strong>source code</strong>, and the translated program is called the<br /><strong>object code</strong> or the <strong>executable</strong>. Once a program is compiled, you can execute it repeatedly without&nbsp;further translation.</p>\n                        <p><img src=\"http://www.greenteapress.com/thinkpython/html/thinkpython002.png\" alt=\"\" width=\"484\" height=\"79\" /><br />Many modern languages use both processes. They are first compiled into a lower level language,&nbsp;called <strong>byte code</strong>, and then interpreted by a program called a <strong>virtual machine</strong>. Python uses both&nbsp;processes, but because of the way programmers interact with it, it is usually considered an interpreted&nbsp;language.</p>\n                        <p><br />There are two ways to use the Python interpreter: <em>shell mode</em> and <em>script mode</em>. In shell mode, you<br />type Python expressions into the <strong>Python shell</strong>, and the interpreter immediately shows the result:</p>\n                        <p><code>$ python3</code><br /><code>Python 3.2 (r32:88445, Mar 25 2011, 19:28:28)</code><br /><code>[GCC 4.5.2] on linux2</code><br /><code>Type \"help\", \"copyright\", \"credits\" or \"license\" for more information.</code><br /><code>&gt;&gt;&gt; 2 + 2</code><br /><code>4</code><br /><code>&gt;&gt;&gt;</code></p>\n                        <p><br />The &gt;&gt;&gt; is called the <strong>Python prompt</strong>. The interpreter uses the prompt to indicate that it is ready&nbsp;for instructions. We typed 2 + 2, and the interpreter evaluated our expression, and replied 4, and<br />on the next line it gave a new prompt, indicating that it is ready for more input.<br />Alternatively, you can write a program in a file and use the interpreter to execute the contents of&nbsp;the file. Such a file is called a <strong>script</strong>. For example, we used a text editor to create a file named&nbsp;firstprogram.py with the following contents:</p>\n                        <p><br /><code>print(\"My first program adds two numbers, 2 and 3:\")</code><br /><code>print(2 + 3)</code></p>\n                        <p><br />By convention, files that contain Python programs have names that end with <code>.py</code> . Following this&nbsp;convention will help your operating system and other programs identify a file as containing python&nbsp;code.</p>\n                        <p><br /><code>$ python firstprogram.py</code><br /><code>My first program adds two numbers, 2 and 3:</code><br /><code>5</code></p>\n                        <p><br />These examples show Python being run from a Unix command line. In other development environments,&nbsp;the details of executing programs may differ. Also, most programs are more interesting&nbsp;than this one.<br />The examples in this book use both the Python interpreter and scripts. You will be able to tell&nbsp;which is intended since shell mode examples will always start with the Python prompt.<br />Working directly in the interpreter is convenient for testing short bits of code because you get&nbsp;immediate feedback. Think of it as scratch paper used to help you work out problems. Anything&nbsp;longer than a few lines should be put into a script.</p>\n                        <h2><br />1.2 What is a program?</h2>\n                        <p><br />A <strong>program</strong> is a sequence of instructions that specifies how to perform a computation. The computation&nbsp;might be something mathematical, such as solving a system of equations or finding the&nbsp;roots of a polynomial, but it can also be a symbolic computation, such as searching and replacing&nbsp;text in a document or (strangely enough) compiling a program.<br />The details look different in different languages, but a few basic instructions appear in just about&nbsp;every language:</p>\n                        <p style=\"padding-left: 30px;\"><br /><strong>input</strong> Get data from the keyboard, a file, or some other device.<br /><strong>output</strong> Display data on the screen or send data to a file or other device.<br /><strong>math and logic</strong> Perform basic mathematical operations like addition, and multiplication, and logical&nbsp;operations like and, or, and not.<br /><strong>conditional execution</strong> Check for certain conditions and execute the appropriate sequence of statements.<br /><strong>repetition</strong> Perform some action repeatedly, usually with some variation.</p>\n                        <p>Believe it or not, that&rsquo;s pretty much all there is to it. Every program you&rsquo;ve ever used, no matter&nbsp;how complicated, is made up of instructions that look more or less like these. Thus, we can describe&nbsp;programming as the process of breaking a large, complex task into smaller and smaller subtasks&nbsp;until the subtasks are simple enough to be performed with sequences of these basic instructions.<br />That may be a little vague, but we will come back to this topic later when we talk about algorithms.</p>\n                        <h2><br />1.3 What is debugging?</h2>\n                        <p><br />Programming is a complex process, and because it is done by human beings, it often leads to errors.<br />Programming errors are called <strong>bugs</strong> and the process of tracking them down and correcting them is&nbsp;called <strong>debugging</strong>. Some claim that in 1945, a dead moth caused a problem on relay number 70,&nbsp;panel F, of one of the first computers at Harvard, and the term <strong>bug</strong> has remained in use since.<br />Three kinds of errors can occur in a program: <em>syntax errors</em>, <em>runtime errors</em>, and <em>semantic errors</em>. It&nbsp;is useful to distinguish between them in order to track them down more quickly.</p>\n                        <h2><br />1.4 Syntax errors</h2>\n                        <p>Python can only execute a program if the program is syntactically correct; otherwise, the process&nbsp;fails and returns an error message. <strong>Syntax</strong> refers to the structure of a program and the rules about<br />that structure. For example, in English, a sentence must begin with a capital letter and end with a&nbsp;period. this sentence contains a <strong>syntax error</strong>. So does this one&nbsp;</p>\n                        <p>For most readers, a few syntax errors are not a significant problem, which is why we can read the&nbsp;poetry of e. e. cummings without problems. Python is not so forgiving. If there is a single syntax&nbsp;error anywhere in your program, Python will display an error message and quit, and you will not&nbsp;be able to run your program. During the first few weeks of your programming career, you will&nbsp;probably spend a lot of time tracking down syntax errors. As you gain experience, though, you&nbsp;will make fewer errors and find them faster.</p>\n                        <h2>1.5 Runtime errors</h2>\n                        <p>The second type of error is a runtime error, so called because the error does not appear until you run&nbsp;the program. These errors are also called <strong>exceptions</strong> because they usually indicate that something&nbsp;exceptional (and bad) has happened.<br />Runtime errors are rare in the simple programs you will see in the first few chapters, so it might be&nbsp;a while before you encounter one.</p>\n                        <h2><br />1.6 Semantic errors</h2>\n                        <p>The third type of error is the <strong>semantic error</strong>. If there is a semantic error in your program, it will&nbsp;run successfully, in the sense that the computer will not generate any error messages, but it will&nbsp;not do the right thing. It will do something else. Specifically, it will do what you told it to do.<br />The problem is that the program you wrote is not the program you wanted to write. The meaning of&nbsp;the program (its semantics) is wrong. Identifying semantic errors can be tricky because it requires&nbsp;you to work backward by looking at the output of the program and trying to figure out what it is&nbsp;doing.</p>\n                        <h2><br />1.7 Experimental debugging</h2>\n                        <p>One of the most important skills you will acquire is debugging. Although it can be frustrating,&nbsp;debugging is one of the most intellectually rich, challenging, and interesting parts of programming.<br />In some ways, debugging is like detective work. You are confronted with clues, and you have to&nbsp;infer the processes and events that led to the results you see.<br />Debugging is also like an experimental science. Once you have an idea what is going wrong, you&nbsp;modify your program and try again. If your hypothesis was correct, then you can predict the result<br />of the modification, and you take a step closer to a working program. If your hypothesis was&nbsp;wrong, you have to come up with a new one. As Sherlock Holmes pointed out, When you have<br />eliminated the impossible, whatever remains, however improbable, must be the truth. (A. Conan&nbsp;Doyle, <em>The Sign of Four</em>)<br />For some people, programming and debugging are the same thing. That is, programming is the&nbsp;process of gradually debugging a program until it does what you want. The idea is that you should<br />start with a program that does <em>something</em> and make small modifications, debugging them as you&nbsp;go, so that you always have a working program.<br />For example, Linux is an operating system kernel that contains millions of lines of code, but it&nbsp;started out as a simple program Linus Torvalds used to explore the Intel 80386 chip. According<br />to Larry Greenfield, one of Linus&rsquo;s earlier projects was a program that would switch between&nbsp;displaying AAAA and BBBB. This later evolved to Linux (<em>The Linux Users&rsquo; Guide</em> Beta Version&nbsp;1).<br />Later chapters will make more suggestions about debugging and other programming practices.</p>\n                        <h2><br />1.8 Formal and natural languages</h2>\n                        <p><strong>Natural languages</strong> are the languages that people speak, such as English, Spanish, and French.<br />They were not designed by people (although people try to impose some order on them); they&nbsp;evolved naturally.<br /><strong>Formal languages</strong> are languages that are designed by people for specific applications. For example,&nbsp;the notation that mathematicians use is a formal language that is particularly good at denoting<br />relationships among numbers and symbols. Chemists use a formal language to represent the chemical&nbsp;structure of molecules. And most importantly:<br /><em>Programming languages are formal languages that have been designed to express&nbsp;computations.</em><br />Formal languages tend to have strict rules about syntax. For example, <code>3+3=6</code> is a syntactically&nbsp;correct mathematical statement, but <code>3=+6$</code> is not. H<sub>2</sub>O is a syntactically correct chemical name,<br />but 2Zz is not.<br />Syntax rules come in two flavors, pertaining to <strong>tokens</strong> and structure. Tokens are the basic elements&nbsp;of the language, such as words, numbers, and chemical elements. One of the problems with <code>3=+6$</code><br /><br />is that <code>$</code> is not a legal token in mathematics (at least as far as we know). Similarly, <sub>2</sub>Zz is not legal&nbsp;because there is no element with the abbreviation Zz.<br />The second type of syntax rule pertains to the <strong>structure</strong> of a statement&mdash; that is, the way the&nbsp;tokens are arranged. The statement <code>3=+6$</code> is structurally illegal because you can&rsquo;t place a plus<br />sign immediately after an equal sign. Similarly, molecular formulas have to have subscripts after&nbsp;the element name, not before.<br />When you read a sentence in English or a statement in a formal language, you have to figure out&nbsp;what the structure of the sentence is (although in a natural language you do this subconsciously).<br />This process is called <strong>parsing</strong>.<br />For example, when you hear the sentence, &ldquo;The other shoe fell&rdquo;, you understand that the other&nbsp;shoe is the subject and fell is the verb. Once you have parsed a sentence, you can figure out what&nbsp;it means, or the <strong>semantics</strong> of the sentence. Assuming that you know what a shoe is and what it&nbsp;means to fall, you will understand the general implication of this sentence.<br />Although formal and natural languages have many features in common&mdash;tokens, structure, syntax,&nbsp;and semantics &mdash; there are many differences:</p>\n                        <p style=\"padding-left: 30px;\"><strong>ambiguity</strong> Natural languages are full of ambiguity, which people deal with by using contextual&nbsp;clues and other information. Formal languages are designed to be nearly or completely unambiguous,&nbsp;which means that any statement has exactly one meaning, regardless of context.<br /><strong>redundancy</strong> In order to make up for ambiguity and reduce misunderstandings, natural languages&nbsp;employ lots of redundancy. As a result, they are often verbose. Formal languages are less<br />redundant and more concise.<br /><strong>literalness</strong> Formal languages mean exactly what they say. On the other hand, natural languages&nbsp;are full of idiom and metaphor. If someone says, &ldquo;The other shoe fell&rdquo;, there is probably no<br />shoe and nothing falling.</p>\n                        <p>People who grow up speaking a natural language&mdash;everyone&mdash;often have a hard time adjusting to&nbsp;formal languages. In some ways, the difference between formal and natural language is like the<br />difference between poetry and prose, but more so:</p>\n                        <p style=\"padding-left: 30px;\"><strong>poetry</strong> Words are used for their sounds as well as for their meaning, and the whole poem together&nbsp;creates an effect or emotional response. Ambiguity is not only common but often deliberate.<br /><strong>prose</strong> The literal meaning of words is more important, and the structure contributes more meaning.&nbsp;Prose is more amenable to analysis than poetry but still often ambiguous.<br /><strong>program</strong> The meaning of a computer program is unambiguous and literal, and can be understood&nbsp;entirely by analysis of the tokens and structure.</p>\n                        <p>Here are some suggestions for reading programs (and other formal languages). First, remember that formal languages are much more dense than natural languages, so it takes longer to read them.<br />Also, the structure is very important, so it is usually not a good idea to read from top to bottom, left&nbsp;to right. Instead, learn to parse the program in your head, identifying the tokens and interpreting&nbsp;the structure. Finally, the details matter. Little things like spelling errors and bad punctuation,&nbsp;which you can get away with in natural languages, can make a big difference in a formal language.</p>\n                        <h2><br />1.9 The first program</h2>\n                        <p>Traditionally, the first program written in a new language is called Hello, World! because all it&nbsp;does is display the words, Hello, World! In Python, the script looks like this:<br /><code>print(\"Hello, World!\")</code><br />This is an example of using the print function, which doesn&rsquo;t actually print anything on paper. It&nbsp;displays a value on the screen. In this case, the result is the words&nbsp;</p>\n                        <p><code>Hello, World!</code></p>\n                        <p>The quotation marks in the program mark the beginning and end of the value; they don&rsquo;t appear in&nbsp;the result.<br />Some people judge the quality of a programming language by the simplicity of the Hello, World!&nbsp;program. By this  standard, Python does about as well as possible.</p>\n                        <h2><br />1.10 Comments</h2>\n                        <p>As programs get bigger and more complicated, they get more difficult to read. Formal languages&nbsp;are dense, and it is often difficult to look at a piece of code and figure out what it is doing, or why.<br />For this reason, it is a good idea to add notes to your programs to explain in natural language what&nbsp;the program is doing.<br />A <strong>comment</strong> in a computer program is text that is intended only for the human reader - it is completely&nbsp;ignored by the interpreter.<br />In Python, the # token starts a comment. The rest of the line is ignored. Here is a new version of&nbsp;Hello, World!.</p>\n                        <p><code>#---------------------------------------------------</code><br /><code># This demo program shows off how elegant Python is!</code><br /><code># Written by Joe Soap, December 2010.</code><br /><code># Anyone may freely copy or modify this program.</code><br /><code>#---------------------------------------------------</code><br /><code>print(\"Hello, World!\") # Isn&rsquo;t this easy!</code></p>\n                        <p><br />You&rsquo;ll also notice that we&rsquo;ve left a blank line in the program. Blank lines are also ignored by&nbsp;the interpreter, but comments and blank lines can make your programs much easier for humans to&nbsp;parse. Use them liberally!</p>\n                        <h2><a href=\"../../series/1\">1.11 Exercises</a></h2>'),(33,1,'2. Variables, expressions and statements','<h2>2.1 Values and data types</h2>\n                        <p>A <strong>value</strong> is one of the fundamental things &mdash; like a letter or a number &mdash; that a program manipulates.<br />The values we have seen so far are <code>4</code> (the result when we added <code>2 + 2</code>), and \"<code>Hello,&nbsp;World!</code>\".<br />These values are classified into different <strong>classes</strong>, or <strong>data types</strong>: 4 is an <em>integer</em>, and <code>\"Hello,&nbsp;World!</code>\" is a <strong>string</strong>, so-called because it contains a string of letters. You (and the interpreter) can<br />identify strings because they are enclosed in quotation marks.<br />If you are not sure what class a value falls into, Python has a function called type which can tell&nbsp;you.<br /><code>&gt;&gt;&gt; type(\"Hello, World!\")</code><br /><code>&lt;class &rsquo;str&rsquo;&gt;</code><br /><code>&gt;&gt;&gt; type(17)</code><br /><code>&lt;class &rsquo;int&rsquo;&gt;</code><br />Not surprisingly, strings belong to the class <strong>str</strong> and integers belong to the class <strong>int</strong>. Less obviously,&nbsp;numbers with a decimal point belong to a class called <strong>float</strong>, because these numbers are<br />represented in a format called <em>floating-point</em>. At this stage, you can treat the words <em>class</em> and <em>type</em>&nbsp;interchangeably. We&rsquo;ll come back to a deeper understanding of what a class is in later chapters.<br /><code>&gt;&gt;&gt; type(3.2)</code><br /><code>&lt;class &rsquo;float&rsquo;&gt;</code><br />What about values like \"17\" and \"3.2\"? They look like numbers, but they are in quotation&nbsp;marks like strings.<br /><code>&gt;&gt;&gt; type(\"17\")</code><br /><code>&lt;class &rsquo;str&rsquo;&gt;</code><br /><code>&gt;&gt;&gt; type(\"3.2\")</code><br /><code>&lt;class &rsquo;str&rsquo;&gt;</code><br />They&rsquo;re strings!<br />Strings in Python can be enclosed in either single quotes (&rsquo;) or double quotes (\"), or three of each&nbsp;(&rdquo;&rsquo; or \"\"\")<br /><code>&gt;&gt;&gt; type(&rsquo;This is a string.&rsquo;)</code><br /><code>&lt;class &rsquo;str&rsquo;&gt;</code><br /><code>&gt;&gt;&gt; type(\"And so is this.\")</code><br /><code>&lt;class &rsquo;str&rsquo;&gt;</code><br /><code>&gt;&gt;&gt; type(\"\"\"and this.\"\"\")</code><br /><code>&lt;class &rsquo;str&rsquo;&gt;</code><br /><code>&gt;&gt;&gt; type(&rsquo;&rsquo;&rsquo;and even this...&rsquo;&rsquo;&rsquo;)</code><br /><code>&lt;class &rsquo;str&rsquo;&gt;</code><br />Double quoted strings can contain single quotes inside them, as in \"<code>Bruce&rsquo;s beard</code>\", and&nbsp;single quoted strings can have double quotes inside them, as in &rsquo;<code>The knights who say&nbsp;\"Ni!\"</code>&rsquo;.<br />Strings enclosed with three occurrences of either quote symbol are called triple quoted strings.<br />They can contain either single or double quotes:<br /><code>&gt;&gt;&gt; print(&rsquo;&rsquo;&rsquo;\"Oh no\", she exclaimed, \"Ben&rsquo;s bike is broken!\"&rsquo;&rsquo;&rsquo;)</code><br /><code>\"Oh no\", she exclaimed, \"Ben&rsquo;s bike is broken!\"</code><br /><code>&gt;&gt;&gt;</code><br />Triple quoted strings can even span multiple lines:<br /><code>&gt;&gt;&gt; message = \"\"\"This message will</code><br /><code>... span several</code><br /><code>... lines.\"\"\"</code><br /><code>&gt;&gt;&gt; print(message)</code><br /><code>This message will</code><br /><code>span several</code><br /><code>lines.</code><br /><code>&gt;&gt;&gt;</code><br />Python doesn&rsquo;t care whether you use single or double quotes or the three-of-a-kind quotes to surround&nbsp;your strings: once it has parsed the text of your program or command, the way it stores the&nbsp;value is identical in all cases, and the surrounding quotes are not part of the value. But when the&nbsp;interpreter wants to display a string, it has to decide which quotes to use to make it look like a&nbsp;string.<br /><code>&gt;&gt;&gt; &rsquo;This is a string.&rsquo;</code><br /><code>&rsquo;This is a string.&rsquo;</code><br /><code>&gt;&gt;&gt; \"\"\"And so is this.\"\"\"</code><br /><code>&rsquo;And so is this.&rsquo;</code><br />So the Python language designers usually chose to surround their strings by single quotes. What&nbsp;do think would happen if the string already contained single quotes? Try it for yourself and see.<br />When you type a large integer, you might be tempted to use commas between groups of three&nbsp;digits, as in 42,000. This is not a legal integer in Python, but it does mean something else, which&nbsp;is legal:<br /><code>&gt;&gt;&gt; 42000</code><br /><code>42000</code><br /><code>&gt;&gt;&gt; 42,000</code><br /><code>(42, 0)</code><br />Well, that&rsquo;s not what we expected at all! Because of the comma, Python chose to treat this as a&nbsp;<em>pair</em> of values. We&rsquo;ll come back to learn about pairs later. But, for the moment, remember not to&nbsp;put commas or spaces in your integers, no matter how big they are. Also revisit what we said in the&nbsp;previous chapter: formal languages are strict, the notation is concise, and even the smallest change&nbsp;might mean something quite different from what you intended.</p>\n                        <h2><br />2.2 Variables</h2>\n                        <p>One of the most powerful features of a programming language is the ability to manipulate <strong>variables</strong>.<br />A variable is a name that refers to a value.<br /><strong>Assignment statements</strong> create new variables and give them values:<br /><code>&gt;&gt;&gt; message = \"And now for something completely different\"</code><br /><code>&gt;&gt;&gt; n = 17</code><br /><code>&gt;&gt;&gt; pi = 3.14159</code><br />This example makes three assignments. The first assigns the string value \"What&rsquo;s up, Doc?\"&nbsp;to a new variable named message. The second gives the integer 17 to n, and the third assigns&nbsp;the floating-point number 3.14159 to a variable called pi.<br />The <strong>assignment token</strong>, =, should not be confused with equals, which uses the token ==. The&nbsp;assignment statement links a name, on the left hand side of the operator, with a value, on the right&nbsp;hand side. This is why you will get an error if you enter:<br /><code>&gt;&gt;&gt; 17 = n</code><br /><strong>Tip</strong>: When reading or writing code, say to yourself &ldquo;n is assigned 17&rdquo; or &ldquo;n gets the value 17&rdquo;.&nbsp;Don&rsquo;t say &ldquo;n equals 17&rdquo;.<br /><strong>Note</strong>: In case you are wondering, a token is a character or string of characters that has syntactic&nbsp;meaning in a language. In Python operators, keywords, literals, and white space all form tokens in&nbsp;the language.<br />A common way to represent variables on paper is to write the name with an arrow pointing to the&nbsp;variable&rsquo;s value. This kind of figure is called a <strong>state snapshot</strong> because it shows what state each of&nbsp;the variables is in at a particular instant in time. (Think of it as the variable&rsquo;s state of mind). This&nbsp;diagram shows the result of executing the assignment statements:</p>\n                        <p><img src=\"http://www.greenteapress.com/thinkpython/html/thinkpython003.png\" alt=\"\" width=\"350\" height=\"71\" /><br />If you ask the interpreter to evaluate a variable, it will produce the value that is currently linked to&nbsp;the variable:<br /><code>&gt;&gt;&gt; message</code><br /><code>&rsquo;And now for something completely different&rsquo;</code><br /><code>&gt;&gt;&gt; n</code><br /><code>17</code><br /><code>&gt;&gt;&gt; pi</code><br /><code>3.14159</code><br />In each case the result is the value of the variable. Variables also have types; again, we can ask the&nbsp;interpreter what they are.<br /><code>&gt;&gt;&gt; type(message)</code><br /><code>&lt;class &rsquo;str&rsquo;&gt;</code><br /><code>&gt;&gt;&gt; type(n)</code><br /><code>&lt;class &rsquo;int&rsquo;&gt;</code><br /><code>&gt;&gt;&gt; type(pi)</code><br /><code>&lt;class &rsquo;float&rsquo;&gt;</code><br />The type of a variable is the type of the value it currently refers to.<br />We use variables in a program to &ldquo;remember&rdquo; things, like the current score at the football game.<br />But variables are <em>variable</em>. This means they can change over time, just like the scoreboard at a&nbsp;football game. You can assign a value to a variable, and later assign a different value to the same&nbsp;variable.<br /><strong>Note</strong>: This is different from math. In math, if you give x the value 3, it cannot change to link to a&nbsp;different value half-way through your calculations!<br /><code>&gt;&gt;&gt; day = \"Thursday\"</code><br /><code>&gt;&gt;&gt; day</code><br /><code>&rsquo;Thursday&rsquo;</code><br /><code>&gt;&gt;&gt; day = \"Friday\"</code><br /><code>&gt;&gt;&gt; day</code><br /><code>&rsquo;Friday&rsquo;</code><br /><code>&gt;&gt;&gt; day = 21</code><br /><code>&gt;&gt;&gt; day</code><br /><code>21</code><br />You&rsquo;ll notice we changed the value of <code>day</code> three times, and on the third assignment we even gave&nbsp;it a value that was of a different type.<br />A great deal of programming is about having the computer remember things, e.g. <em>The number of&nbsp;missed calls on your phone</em>, and then arranging to update or change the variable when you miss&nbsp;another call.</p>\n                        <h2><br />2.3 Variable names and keywords</h2>\n                        <p>Valid <strong>variable names</strong> in Python must conform to the following three simple rules:</p>\n                        <p style=\"padding-left: 30px;\">1. They are an arbitrarily long sequence of letters and digits.<br />2. The sequence must begin with a letter.<br />3. In addtion to a..z, and A..Z, the underscore (_) is a letter.</p>\n                        <p>Although it is legal to use uppercase letters, by convention we don&rsquo;t. If you do, remember that case&nbsp;matters. <code>Bruce</code> and <code>bruce</code> are different variables.<br />The underscore character ( _) can appear in a name. It is often used in names with multiple words,&nbsp;such as <code>my_name</code> or <code>price_of_tea_in_china</code>.<br />There are some situations in which names beginning with an underscore have special meaning, so&nbsp;a safe rule for beginners is to start all names with a letter other than the underscore.<br />If you give a variable an illegal name, you get a syntax error:<br /><code>&gt;&gt;&gt; 76trombones = \"big parade\"</code><br /><code>SyntaxError: invalid syntax</code><br /><code>&gt;&gt;&gt; more$ = 1000000</code><br /><code>SyntaxError: invalid syntax</code><br /><code>&gt;&gt;&gt; class = \"Computer Science 101\"</code><br /><code>SyntaxError: invalid syntax</code><br /><code>76trombones</code> is illegal because it does not begin with a letter. <code>more$</code> is illegal because it&nbsp;contains an illegal character, the dollar sign. But what&rsquo;s wrong with <code>class</code>?<br />It turns out that <code>class</code> is one of the Python <strong>keywords</strong>. Keywords define the language&rsquo;s syntax&nbsp;rules and structure, and they cannot be used as variable names.<br />Python has thirty-something keywords (and every now and again improvements to Python introduce&nbsp;or eliminate one or two):</p>\n                        <table style=\"height: 78px;\" width=\"607\">\n                        <tbody>\n                        <tr>\n                        <td>and</td>\n                        <td>as</td>\n                        <td>assert</td>\n                        <td>break</td>\n                        <td>class</td>\n                        <td>continue</td>\n                        </tr>\n                        <tr>\n                        <td>def</td>\n                        <td>del</td>\n                        <td>elif</td>\n                        <td>else</td>\n                        <td>except</td>\n                        <td>exec</td>\n                        </tr>\n                        <tr>\n                        <td>finally</td>\n                        <td>for</td>\n                        <td>from</td>\n                        <td>global</td>\n                        <td>if</td>\n                        <td>import</td>\n                        </tr>\n                        <tr>\n                        <td>in</td>\n                        <td>is</td>\n                        <td>lambda</td>\n                        <td>nonlocal</td>\n                        <td>not</td>\n                        <td>or</td>\n                        </tr>\n                        <tr>\n                        <td>pass</td>\n                        <td>raise</td>\n                        <td>return</td>\n                        <td>try</td>\n                        <td>while</td>\n                        <td>with</td>\n                        </tr>\n                        <tr>\n                        <td>yield</td>\n                        <td>True</td>\n                        <td>False</td>\n                        <td>None</td>\n                        <td>&nbsp;</td>\n                        <td>&nbsp;</td>\n                        </tr>\n                        </tbody>\n                        </table>\n                        <p><br />You might want to keep this list handy. If the interpreter complains about one of your variable&nbsp;names and you don&rsquo;t know why, see if it is on this list.<br />Programmers generally choose names for their variables that are meaningful to the human readers&nbsp;of the program&mdash;they help the programmer document, or remember, what the variable is used for.</p>\n                        <table style=\"height: 129px;\" width=\"604\">\n                        <tbody>\n                        <tr>\n                        <td>Caution: Beginners sometimes confuse &ldquo;meaningful to the human readers&rdquo; with &ldquo;meaningful&nbsp;to the computer&rdquo;. So they&rsquo;ll wrongly think that because they&rsquo;ve called some variable average&nbsp;or pi, it will somehow automagically calculate an average, or automagically associate the variable&nbsp;pi with the value 3.14159. No! The computer doesn&rsquo;t attach semantic meaning to your&nbsp;variable names.<br />So you&rsquo;ll find some instructors who deliberately don&rsquo;t choose meaningful names when they&nbsp;teach beginners &mdash; not because they don&rsquo;t think it is a good habit, but because they&rsquo;re trying to&nbsp;reinforce the message that you, the programmer, have to write some program code to calculate&nbsp;the average, or you must write an assignment statement to give a variable the value you want it&nbsp;to have.</td>\n                        </tr>\n                        </tbody>\n                        </table>\n                        <p>&nbsp;</p>\n                        <h2>2.4 Statements</h2>\n                        <p>A <strong>statement</strong> is an instruction that the Python interpreter can execute. We have only seen the&nbsp;assignment statement so far. Some other kinds of statements that we&rsquo;ll see shortly are <code>while</code>&nbsp;statements, <code>for</code> statements, <code>if</code> statements, and <code>import</code> statements. (There are other kinds too!)&nbsp;When you type a statement on the command line, Python executes it. Statements don&rsquo;t produce&nbsp;any result.</p>\n                        <h2><br />2.5 Evaluating expressions</h2>\n                        <p>An <strong>expression</strong> is a combination of values, variables, operators, and calls to functions. If you type&nbsp;an expression at the Python prompt, the interpreter <strong>evaluates</strong> it and displays the result:<br /><code>&gt;&gt;&gt; 1 + 1</code><br /><code>2</code><br /><code>&gt;&gt;&gt; len(\"hello\")</code><br /><code>5</code><br />In this example <code>len</code> is a built-in Python function that returns the number of characters in a string.<br />We&rsquo;ve previously seen the <code>print</code> and the <code>type</code> functions, so this is our third example of a function!<br />The <em>evaluation</em> of an <em>expression</em> produces a value, which is why expressions can appear on the&nbsp;right hand side of assignment statements. A value all by itself is a simple expression, and so is a&nbsp;variable.<br /><code>&gt;&gt;&gt; 17</code><br /><code>17</code><br /><code>&gt;&gt;&gt; y = 3.14</code><br /><code>&gt;&gt;&gt; x = len(\"hello\")</code><br /><code>&gt;&gt;&gt; x</code><br /><code>5</code><br /><code>&gt;&gt;&gt; y</code><br /><code>3.14</code></p>\n                        <h2><br />2.6 Operators and operands</h2>\n                        <p>Operators are special tokens that represent computations like addition, multiplication and division.&nbsp;The values the operator uses are called <strong>operands</strong>.<br />The following are all legal Python expressions whose meaning is more or less clear:<br /><code>20 + 32 hour - 1 hour * 60 + minute minute / 60 5 ** 2</code><br /><code>(5 + 9) * (15 - 7)</code><br />The tokens +, -, and *, and the use of parenthesis for grouping, mean in Python what they mean&nbsp;in mathematics. The asterisk (*) is the token for multiplication, and ** is the token for exponentiation.<br /><code>&gt;&gt;&gt; 2 ** 3</code><br /><code>8</code><br /><code>&gt;&gt;&gt; 3 ** 2</code><br /><code>9</code><br />When a variable name appears in the place of an operand, it is replaced with its value before the&nbsp;operation is performed.<br />Addition, subtraction, multiplication, and exponentiation all do what you expect.<br />Example: so let us convert 645 minutes into hours:<br /><code>&gt;&gt;&gt; minutes = 645</code><br /><code>&gt;&gt;&gt; hours = minutes / 60</code><br /><code>&gt;&gt;&gt; hours</code><br /><code>10.75</code><br />Oops! In Python 3, the division operator / always yields a floating point result. What we might&nbsp;have wanted to know was how many <em>whole</em> hours there are, and how many minutes remain. Python&nbsp;gives us two different flavours of the division operator. The second, called <strong>integer division</strong> uses&nbsp;the token //. It always <em>truncates</em> its result down to the next smallest integer (to the left on the&nbsp;number line).<br /><code>&gt;&gt;&gt; 7 / 4</code><br /><code>1.75</code><br /><code>&gt;&gt;&gt; 7 // 4</code><br /><code>1</code><br /><code>&gt;&gt;&gt; minutes = 645</code><br /><code>&gt;&gt;&gt; hours = minutes // 60</code><br /><code>&gt;&gt;&gt; hours</code><br /><code>10</code><br />Take care that you choose the correct falvour of the division operator. If you&rsquo;re working with&nbsp;expressions where you need floating point values, use the division operator that does the division&nbsp;accurately.</p>\n                        <h2><br />2.7 Type converter functions</h2>\n                        <p>Here we&rsquo;ll look at three more Python functions, <code>int</code>, <code>float</code> and <code>str</code>, which will (attempt to)&nbsp;convert their arguments into types <code>int</code>, <code>float</code> and <code>str</code> respectively. We call these type converter&nbsp;functions.<br />The <code>int</code> function can take a floating point number or a string, and turn it into an int. For floating&nbsp;point numbers, it <em>discards</em> the decimal portion of the number - a process we call <em>truncation towards&nbsp;zero</em> on the number line. Let us see this in action:<br />&gt;&gt;<code>&gt; int(3.14)</code><br /><code>3</code><br /><code>&gt;&gt;&gt; int(3.9999) # This doesn&rsquo;t round to the closest int!</code><br /><code>3</code><br /><code>&gt;&gt;&gt; int(3.0)</code><br /><code>3</code><br /><code>&gt;&gt;&gt; int(-3.999) # Note that the result is closer to zero</code><br /><code>-3</code><br /><code>&gt;&gt;&gt; int(minutes/60)</code><br /><code>10</code><br /><code>&gt;&gt;&gt; int(\"2345\") # parse a string to produce an int</code><br /><code>2345</code><br /><code>&gt;&gt;&gt; int(17) # int even works if its argument is already an int</code><br /><code>17</code><br /><code>&gt;&gt;&gt; int(\"23 bottles\")</code><br /><code>Traceback (most recent call last):</code><br /><code>File \"&lt;interactive input&gt;\", line 1, in &lt;module&gt;</code><br /><code>ValueError: invalid literal for int() with base 10: &rsquo;23 bottles&rsquo;</code><br />The last case shows that a string has to be a syntactically legal number, otherwise you&rsquo;ll get one of&nbsp;those pesky runtime errors.<br />The type converter <code>float</code> can turn an integer, a float, or a syntactically legal string into a float.<br /><code>&gt;&gt;&gt; float(17)</code><br /><code>17.0</code><br /><code>&gt;&gt;&gt; float(\"123.45\")</code><br /><code>123.45</code><br /><code>The type converter str turns its argument into a string:</code><br /><code>&gt;&gt;&gt; str(17)</code><br /><code>&rsquo;17&rsquo;</code><br /><code>&gt;&gt;&gt; str(123.45)</code><br /><code>&rsquo;123.45&rsquo;</code></p>\n                        <p>&nbsp;</p>\n                        <h2>2.8 Order of operations</h2>\n                        <p>When more than one operator appears in an expression, the order of evaluation depends on the&nbsp;<strong>rules of precedence</strong>. Python follows the same precedence rules for its mathematical operators that&nbsp;mathematics does. The acronym PEMDAS is a useful way to remember the order of operations:</p>\n                        <p style=\"padding-left: 30px;\">1. <strong>P</strong>arentheses have the highest precedence and can be used to force an expression to evaluate&nbsp;in the order you want. Since expressions in parentheses are evaluated first, <code>2 * (3-1)</code> is&nbsp;4, and <code>(1+1)**(5-2)</code> is 8. You can also use parentheses to make an expression easier to&nbsp;read, as in <code>(minute * 100) / 60</code>, even though it doesn&rsquo;t change the result.<br />2. <strong>E</strong>xponentiation has the next highest precedence, so <code>2**1+1</code> is 3 and not 4, and <code>3*1**3</code> is&nbsp;3 and not 27.<br />3. <strong>M</strong>ultiplication and both <strong>D</strong>ivision operators have the same precedence, which is higher than&nbsp;Addition and Subtraction, which also have the same precedence. So <code>2*3-1</code> yields 5 rather&nbsp;than 4, and <code>5-2*2</code> is 1, not 6. #. Operators with the <em>same</em> precedence are evaluated from&nbsp;left-to-right. In algebra we say they are <em>left-associative</em>. So in the expression <code>6-3+2</code>, the&nbsp;subtraction happens first, yielding 3. We then add 2 to get the result 5. If the operations had&nbsp;been evaluated from right to left, the result would have been <code>6-(3+2)</code>, which is 1. (The&nbsp;acronym PEDMAS could mislead you to thinking that division has higher precedence than&nbsp;multiplication, and addition is done ahead of subtraction - don&rsquo;t be misled. Subtraction and&nbsp;addition are at the same precedence, and the left-to-right rule applies.)&nbsp;</p>\n                        <p><strong>Note</strong>: Due to some historical quirk, an exception to the left-to-right left-associative rule is the&nbsp;exponentiation operator **, so a useful hint is to always use parentheses to force exactly the order&nbsp;you want when exponentiation is involved:<br /><code>&gt;&gt;&gt; 2 ** 3 ** 2 # the right-most ** operator gets done first!</code><br /><code>512</code><br /><code>&gt;&gt;&gt; (2 ** 3) ** 2 # use parentheses to force the order you want!</code><br /><code>64</code><br />The immediate mode command prompt of Python is great for exploring and experimenting with&nbsp;expressions like this.</p>\n                        <h2><br />2.9 Operations on strings</h2>\n                        <p><br />In general, you cannot perform mathematical operations on strings, even if the strings look like&nbsp;numbers. The following are illegal (assuming that <code>message</code> has type string):<br /><code>message - 1 \"Hello\" / 123 message * \"Hello\" \"15\" + 2</code><br />Interestingly, the + operator does work with strings, but for strings, the + operator represents&nbsp;<strong>concatenation</strong>, not addition. Concatenation means joining the two operands by linking them end-to-end. For example:<br /><code>fruit = \"banana\"</code><br /><code>baked_good = \" nut bread\"</code><br /><code>print(fruit + baked_good)</code><br />The output of this program is <code>banana nut bread</code>. The space before the word <code>nut</code> is part of&nbsp;the string, and is necessary to produce the space between the concatenated strings.<br />The * operator also works on strings; it performs repetition. For example, &rsquo;<code>Fun&rsquo;*3</code> is&nbsp;&rsquo;<code>FunFunFun</code>&rsquo;. One of the operands has to be a string; the other has to be an integer.<br />On one hand, this interpretation of + and * makes sense by analogy with addition and multiplication.<br />Just as <code>4*3</code> is equivalent to <code>4+4+4</code>, we expect \"<code>Fun\"*3</code> to be the same as<code>&nbsp;\"Fun\"+\"Fun\"+\"Fun\"</code>, and it is. On the other hand, there is a significant way in which string&nbsp;concatenation and repetition are different from integer addition and multiplication. Can you think&nbsp;of a property that addition and multiplication have that string concatenation and repetition do not?</p>\n                        <h2><br />2.10 Input</h2>\n                        <p>There is a built-in function in Python for getting input from the user:<br /><code>name = input(\"Please enter your name: \")</code><br />The user of the program can enter the name and press <code>return</code>. When this happens the text that&nbsp;has been entered is returned from the <code>input</code> function, and in this case assigned to the variable&nbsp;<code>name</code>.<br />Even if you asked the user to enter their age, you would get back a string like \"<code>17</code>\". It would be&nbsp;your job, as the programmer, to convert that string into a int or a float, using the <code>int</code> or <code>float</code>&nbsp;converter functions we saw earlier.</p>\n                        <p>&nbsp;</p>\n                        <h2>2.11 Composition</h2>\n                        <p>So far, we have looked at the elements of a program &mdash; variables, expressions, statements, and&nbsp;function calls &mdash; in isolation, without talking about how to combine them.<br />One of the most useful features of programming languages is their ability to take small building&nbsp;blocks and <strong>compose</strong> them into larger chunks.<br />For example, we know how to get the user to enter some input, we know how to convert the string&nbsp;we get into a float, we know how to write a complex expression, and we know how to print values.<br />Let&rsquo;s put these together in a small four-step program that asks the user to input a value for the&nbsp;radius of a circle, and then computes the area of the circle from the formula&nbsp;</p>\n                        <p><img src=\"http://upload.wikimedia.org/math/f/2/c/f2c4b9606fb5f2702616adae4f94f83d.png\" alt=\"\" width=\"74\" height=\"18\" /></p>\n                        <p>Firstly, we&rsquo;ll do the four steps one at a time:<br /><code>response = input(\"What is your radius? \")</code><br /><code>r = float(response)</code><br /><code>area = 3.14159 * r**2</code><br /><code>print(\"The area is \", area)</code><br />Now let&rsquo;s compose the first two lines into a single line of code, and compose the second two lines&nbsp;into another line of code.<br /><code>r = float(input(\"What is your radius? \"))</code><br /><code>print(\"The area is \", 3.14159 * r**2)</code><br />If we really wanted to be tricky, we could write it all in one statement:<br /><code>print(\"The area is \", 3.14159*float(input(\"What is your radius?\"))**2)</code><br />Such compact code may not be most understandable for humans, but it does illustrate how we can&nbsp;compose bigger chunks from our building blocks.<br />If you&rsquo;re ever in doubt about whether to compose code or fragment it into smaller steps, try to&nbsp;make it as simple as you can for the human to follow. My choice would be the first case above,&nbsp;with four separate steps.</p>\n                        <h2><a href=\"../../series/2\">2.12 Exercises</a></h2>');
/*!40000 ALTER TABLE `guides` ENABLE KEYS */;
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
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER check_guide
BEFORE INSERT ON guides
FOR EACH ROW 
BEGIN
    IF NEW.title = "" THEN
        SET NEW.title = Null;
    END IF;
    IF NEW.content = "" THEN
        SET NEW.content = Null;
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
  `memberId` int(11) NOT NULL,
  `groupId` int(11) NOT NULL,
  `status` enum('pending','accepted','declined') NOT NULL,
  PRIMARY KEY (`memberId`,`groupId`),
  KEY `groupId` (`groupId`),
  CONSTRAINT `members_of_groups_ibfk_1` FOREIGN KEY (`memberId`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `members_of_groups_ibfk_2` FOREIGN KEY (`groupId`) REFERENCES `groups` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members_of_groups`
--

LOCK TABLES `members_of_groups` WRITE;
/*!40000 ALTER TABLE `members_of_groups` DISABLE KEYS */;
INSERT INTO `members_of_groups` VALUES (1,1,'accepted'),(1,2,'accepted'),(1,3,'accepted'),(1,4,'accepted'),(1,5,'accepted'),(2,1,'accepted'),(2,2,'accepted'),(2,3,'accepted'),(2,4,'accepted'),(2,5,'declined'),(3,1,'accepted'),(3,2,'accepted'),(3,3,'accepted'),(3,4,'accepted'),(3,5,'declined'),(4,1,'accepted'),(4,2,'accepted'),(4,3,'accepted'),(4,4,'accepted'),(4,5,'accepted'),(5,1,'accepted'),(6,1,'accepted'),(6,4,'accepted'),(7,1,'accepted'),(8,1,'accepted'),(9,1,'accepted'),(10,1,'accepted'),(11,1,'accepted'),(12,1,'accepted'),(12,5,'declined'),(13,1,'accepted'),(13,5,'accepted'),(14,1,'accepted'),(14,4,'accepted'),(14,5,'accepted'),(15,2,'accepted'),(15,5,'accepted'),(16,2,'accepted'),(17,2,'accepted'),(18,2,'accepted'),(19,2,'accepted'),(19,4,'accepted'),(20,2,'accepted'),(20,4,'accepted'),(21,2,'accepted'),(21,4,'accepted'),(21,5,'accepted'),(22,2,'accepted'),(23,2,'accepted'),(24,3,'accepted'),(25,3,'accepted'),(26,3,'accepted'),(26,5,'accepted'),(27,3,'accepted'),(27,5,'accepted'),(28,3,'accepted'),(29,3,'accepted'),(30,3,'accepted'),(31,3,'accepted'),(32,3,'accepted'),(33,4,'accepted'),(34,4,'accepted'),(35,4,'accepted'),(35,5,'accepted'),(36,4,'accepted'),(36,5,'accepted');
/*!40000 ALTER TABLE `members_of_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `conversationId` int(11) NOT NULL,
  `message` text NOT NULL,
  `author` int(11) NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `conversationId` (`conversationId`),
  CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`conversationId`) REFERENCES `conversations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,6,'hello',1,1,'2015-05-25 19:45:03'),(2,6,'world',1,1,'2015-05-25 19:45:03'),(3,6,'how are you',1,1,'2015-05-25 19:45:03'),(4,6,'can you help me?',1,1,'2015-05-25 19:45:03'),(5,6,'i don\'t understand x',1,1,'2015-05-25 19:45:03'),(6,6,'sure',2,1,'2015-05-25 19:45:03'),(7,6,'what don\'t you understand about it?',2,1,'2015-05-25 19:45:04'),(8,7,'hello my friend',1,1,'2015-05-25 19:45:04'),(9,7,'i\'m not your friend, buddy',3,1,'2015-05-25 19:45:04'),(10,7,'i\'m not your buddy, dude',1,1,'2015-05-25 19:45:04'),(11,7,'i\'m not your  dude, pal',3,1,'2015-05-25 19:45:04'),(12,7,'i\'m not your pal, man',1,1,'2015-05-25 19:45:04'),(13,7,'i\'m not your man, sir',3,1,'2015-05-25 19:45:05'),(14,8,'Lorem ipsum',2,1,'2015-05-25 19:45:05'),(15,8,'Lorem ipsum dolor congue lobortis cubilia rutrum condimentum diam velit habitasse tortor facilisis gravida enim vestibulum duis leo ultricies aliquet dolor.',3,1,'2015-05-25 19:45:05'),(16,8,'Fames molestie vivamus euismod etiam eget ad quisque eget ac mattis, congue felis tellus enim posuere potenti ac pellentesque eleifend nisi, litora nibh aenean aliquam aenean sed neque dictumst eros.',2,1,'2015-05-25 19:45:05'),(17,8,'Tempus curabitur non ullamcorper elementum eleifend at conubia commodo, molestie placerat varius suspendisse fames sagittis maecenas magna, varius luctus bibendum inceptos luctus maecenas libero, ac ipsum accumsan eu varius feugiat vitae diam ac neque cursus.',3,1,'2015-05-25 19:45:05'),(18,8,'Semper hac porta vel interdum congue integer potenti egestas, nibh potenti ultrices hendrerit sociosqu eleifend dui, pretium suscipit urna fermentum quisque accumsan nibh mollis lacus diam primis dapibus aenean vulputate.',2,1,'2015-05-25 19:45:05'),(19,8,'Convallis velit vivamus quisque lobortis scelerisque netus consectetur elementum primis inceptos proin volutpat ullamcorper platea hac commodo a cras cubilia porttitor.',3,1,'2015-05-25 19:45:05'),(20,8,'Habitant turpis pulvinar ac sollicitudin ultricies aenean, nunc mi at sollicitudin potenti eget, morbi quam egestas velit erat.',2,1,'2015-05-25 19:45:05'),(21,8,'Platea sem mattis venenatis eget lorem accumsan consectetur diam, augue dui id netus sem tortor praesent, malesuada ornare litora massa class vehicula sit ut ullamcorper leo ut ac vehicula litora fringilla placerat dui.',3,1,'2015-05-25 19:45:05'),(22,8,'Nunc pharetra tristique ad mattis consectetur pretium maecenas, gravida velit hac justo integer lobortis pulvinar, quisque feugiat ac cras tristique lorem.',2,1,'2015-05-25 19:45:05'),(23,8,'Lorem ipsum',3,1,'2015-05-25 19:45:06'),(24,9,'HELLO',1,0,'2015-05-25 19:58:06');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `generator_user_id` int(11) NOT NULL,
  `type` varchar(128) NOT NULL,
  `object_id` int(11) DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (1,1,4,'friend request',NULL,0,'2015-05-25 19:45:06'),(2,1,2,'friend request accepted',NULL,0,'2015-05-25 19:45:06'),(3,1,3,'friend request declined',NULL,0,'2015-05-25 19:45:06'),(4,1,-1,'series updated',1,0,'2015-05-25 19:45:06'),(5,1,-1,'exercise referenced',1,0,'2015-05-25 19:45:06'),(6,1,-1,'exercise copied',1,0,'2015-05-25 19:45:06'),(7,1,4,'exercise completed',1,0,'2015-05-25 19:45:06'),(8,2,-1,'group request accepted',5,0,'2015-05-25 19:50:48'),(9,3,-1,'group request accepted',5,0,'2015-05-25 19:50:49'),(10,4,-1,'group request accepted',5,0,'2015-05-25 19:50:50'),(11,12,-1,'group request accepted',5,0,'2015-05-25 19:50:50'),(12,13,-1,'group request accepted',5,0,'2015-05-25 19:50:51'),(13,14,-1,'group request accepted',5,0,'2015-05-25 19:50:52'),(14,15,-1,'group request accepted',5,0,'2015-05-25 19:50:53'),(15,21,-1,'group request accepted',5,0,'2015-05-25 19:50:54'),(16,26,-1,'group request accepted',5,0,'2015-05-25 19:50:54'),(17,27,-1,'group request accepted',5,0,'2015-05-25 19:50:55'),(18,35,-1,'group request accepted',5,0,'2015-05-25 19:50:56'),(19,36,-1,'group request accepted',5,0,'2015-05-25 19:50:56'),(20,4,-1,'group request accepted',5,0,'2015-05-25 19:51:04');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
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
  `views` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`,`tId`),
  KEY `makerId` (`makerId`),
  KEY `tId` (`tId`),
  CONSTRAINT `series_ibfk_1` FOREIGN KEY (`makerId`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `series_ibfk_2` FOREIGN KEY (`tId`) REFERENCES `types` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `series`
--

LOCK TABLES `series` WRITE;
/*!40000 ALTER TABLE `series` DISABLE KEYS */;
INSERT INTO `series` VALUES (1,'Chapter 1','The way of the program',1,1,0),(2,'Chapter 2','Variables, expressions and statements',2,2,0),(3,'Chapter 3','Functions',3,3,0),(4,'Chapter 4','Conditionals',4,4,0),(5,'Chapter 5','Turtles',2,5,0),(6,'Series 6','Description about this series',2,6,0),(7,'Series 7','Description about this series',3,7,0),(8,'Series 8','Description about this series',4,8,0),(9,'Series 9','Description about this series',1,9,0),(10,'Series 10','Description about this series',1,10,0),(11,'Series 11','Description about this series',1,11,0),(12,'Series 12','Description about this series',1,12,0);
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
  `userId` int(11) DEFAULT NULL,
  `seriesId` int(11) NOT NULL,
  `rating` enum('0','1','2','3','4','5') NOT NULL,
  UNIQUE KEY `userId` (`userId`,`seriesId`),
  KEY `seriesId` (`seriesId`),
  CONSTRAINT `series_ratings_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `series_ratings_ibfk_2` FOREIGN KEY (`seriesId`) REFERENCES `series` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `series_ratings`
--

LOCK TABLES `series_ratings` WRITE;
/*!40000 ALTER TABLE `series_ratings` DISABLE KEYS */;
INSERT INTO `series_ratings` VALUES (1,1,'1'),(1,2,'3'),(1,3,'4'),(1,4,'3'),(1,5,'4'),(2,1,'2'),(2,2,'1'),(2,3,'5'),(2,4,'4'),(2,5,'2'),(3,1,'2'),(3,2,'4'),(3,3,'5'),(3,4,'3'),(3,5,'1'),(4,1,'2'),(4,2,'5'),(4,3,'4'),(4,4,'4'),(4,5,'4'),(5,1,'4'),(5,2,'4'),(5,3,'4'),(5,4,'4'),(5,5,'4'),(6,1,'3'),(6,2,'3'),(6,3,'3'),(6,4,'3'),(6,5,'3'),(7,1,'2'),(7,2,'2'),(7,3,'2'),(7,4,'1'),(7,5,'1'),(8,1,'2'),(8,2,'2'),(8,3,'2'),(8,4,'5'),(8,5,'5'),(9,1,'4'),(9,2,'4'),(9,3,'4'),(9,4,'4'),(9,5,'4');
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
  `difficulty` enum('Easy','Intermediate','Hard','Insane') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subject` (`subject`,`difficulty`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `types`
--

LOCK TABLES `types` WRITE;
/*!40000 ALTER TABLE `types` DISABLE KEYS */;
INSERT INTO `types` VALUES (1,'aaa','Easy'),(4,'aaa','Intermediate'),(7,'aaa','Hard'),(10,'aaa','Insane'),(2,'bbb','Easy'),(5,'bbb','Intermediate'),(8,'bbb','Hard'),(11,'bbb','Insane'),(3,'ccc','Easy'),(6,'ccc','Intermediate'),(9,'ccc','Hard'),(12,'ccc','Insane');
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
  `pass` varchar(60) NOT NULL,
  `username` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `score` int(11) NOT NULL DEFAULT '0',
  `image` varchar(50) NOT NULL DEFAULT 'NoProfileImage.jpg',
  `info` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'$2y$10$/6jI4u6/nQzXOgrBqVRJuuJT3hTw/bPoS.7yF6zaTT662k8bDJZKa','armin','a@a.a',5,'user1ProfileImage.jpg','Armin Halilovic is the driving force.'),(2,'$2y$10$0ByqyKTL3VTZ7TIsOwxZkeJwy7yHBTJEzhDXlNiRp2arJ4P9dqVdW','bruno','b@b.b',10,'user2ProfileImage.jpg','Bruno De Deken is our main design architect.'),(3,'$2y$10$G8lmhWRAS8GdQyue16oA9ufBVFh6XqsP8vHOX6.wf0g3Am.o3bX3C','raphael','r@r.r',8,'user3ProfileImage.jpg','<h3 class=\"container col-md-9 col-md-offset-1\">Introduction:</h3>\n<div class=\"container col-md-9 col-md-offset-1\">Raphael Assa is the database designer. Sometimes he spends his time on useless&nbsp;stuff like listening to some music through his own profile page<img src=\"../../js/tinymce/plugins/emoticons/img/smiley-cool.gif\" alt=\"cool\"><iframe src=\"https://www.youtube.com/embed/QMKWwOe7FL4\" width=\"425\" height=\"350\"></iframe></div>\n<div class=\"container col-md-9 col-md-offset-1\">&nbsp;</div>\n<h3 class=\"container col-md-9 col-md-offset-1\">Pictures</h3>\n<div class=\"container col-md-9 col-md-offset-1\">He also like to look at some pictures from time to time...<img src=\"http://www.bankers-anonymous.com/wp-content/uploads/2013/03/Be-Rational-Get-Real.png\" alt=\"\" width=\"436\" height=\"346\"><br><br></div>\n<h3 class=\"container col-md-9 col-md-offset-1\">Final Word</h3>\n<div class=\"container col-md-9 col-md-offset-1\">Raphael is a huge supporter of the following working method:\n<ol style=\"list-style-type: upper-roman;\">\n<li><em>Analyse the nature of the problem</em></li>\n<li><em>Analyse the possible solutions &amp; choose the most appropriate one</em></li>\n<li><em>Apply the solution &amp; adapt to it</em></li>\n<li><em>Re-use the first 3 steps &amp; overcome all problems of humanity</em></li>\n</ol>\n</div> '),(4,'$2y$10$yZe.DaIOuhyBeV0.kXhZhOjNyScTY0RZMmARz4wKJl8kz.Ce8RZzu','fouad','f@f.f',6,'user4ProfileImage.jpg','Fouad is the graphic designer.'),(5,'$2y$10$9KvicDV6Sgnkr6cD4m9F4.Ul6x7gVhzGOTHrYce4o7.KT7zJ7K2Wm','Sarah','SarahRWills@dayrep.com ',7,'0_.jpg',NULL),(6,'$2y$10$eIfx8AkkpdMUs0LZ0s7zhO6iPP1gu4tHQ9eSIBlBAGZi4ewd3hE5i','Simone','SimoneStap@teleworm.us',12,'0.jpg',NULL),(7,'$2y$10$vKPSZXwiCMsgw9HmrMdIYea0hXajkY/GqlbpIIzSgzfu9qc1JbUDW','Roef','RoefSoetens@jourrapide.com',14,'1.jpg',NULL),(8,'$2y$10$NU7oxejeU4a4vy4QvOEFnODFpb3uNZAgb3mfX/npaw3n5e74AlOF2','Rahim','RahimFloor@teleworm.us',4,'37.jpg',NULL),(9,'$2y$10$5k6clZKk8HNvA1bejkR0..j.3nwfHeLVjlsPGLlXf/g0DfEzOZe9C','Ikra','IkraUlijn@armyspy.com',9,'1_.jpg',NULL),(10,'$2y$10$1aq9h7.jQ/2h5OjwS0pwxOFmVlKWBDTAekVceDpoKOWCn6oIQW9.a','Marise','MariseVeger@armyspy.com',10,'7_.jpg',NULL),(11,'$2y$10$P7mJ/gGicfTYhbLERpB1xuTUdFoY.Nu3YfWpBLn1xLFbY0BIO4oXi','Zilan','ZilanHebben@teleworm.us',20,'2.jpg',NULL),(12,'$2y$10$PXwT4DTPkXVHCWSlXDAENO86oBHYvq87wydPHbus2K40YX4IAeB0S','Devin','DevinHermelink@jourrapide.com',19,'13.jpg',NULL),(13,'$2y$10$J8A5DQhfw2ahVI9XJnMxruwOVh.yI6kBHbkRrCa4S/y61Qakcx1ZO','Fiep','FiepFloor@dayrep.com',15,'28.jpg',NULL),(14,'$2y$10$xhx./F5eIMBxPemMPvP0.ulpEu3utovcRTfZx9E0I6B92x1tJCgs.','Sue-Ann','Sue-AnnMoll@dayrep.com',2,'19_.jpg',NULL),(15,'$2y$10$1UawUO1B6EwQ2VSFVgKETunP.u4gXLgwfhTm/dUovsrZe18K168Om','Evie','EvieBerden@jourrapide.com',0,'20_.jpg',NULL),(16,'$2y$10$If4BNX0nH.jbEwK8sFnCSe02HpuL1dBjDq7PS3uWaxYYTfupdw.3O','Carel','CarelVersteegen@jourrapide.com',10,'40.jpg',NULL),(17,'$2y$10$q.Mj1ei263qcy1ORzyvsQu0I06Pi/DdQpaoNJrkpyzXwfJsuXgsCa','Anieke','AniekeKuijs@jourrapide.com',8,'42_.jpg',NULL),(18,'$2y$10$ZmQ/tbZh4PlMnL3GVJQjwODqHTGzXyz9l5f2jXPf8HV1D9e1lPwXm','Sunaina','SunainaVerheggen@jourrapide.com',30,'55_.jpg',NULL),(19,'$2y$10$C3lZSZgi9tBFo4iqbNL2qOlvW5Ea52aeKYcPSOZIKFueu3hsdhaja','Azzeddine','AzzeddineOosterink@teleworm.us',21,'31.jpg',NULL),(20,'$2y$10$jQ/GnxN1HDimVDPuaoR32uNDAaYg7PsFmgLv46Mvycn4IkXTwVquK','Fedor','FedorvanGool@armyspy.com',18,'42.jpg',NULL),(21,'$2y$10$Sfzxi.F2O1q..zkhoiKML.wduR4FXwbM3IOLWbQVn5g0hUpaWbDoS','Alican','AlicanvanLeusen@armyspy.com',20,'67.jpg',NULL),(22,'$2y$10$uXRhiJXI86OVBDuZ6qGay.RZjJWGJi75nmGhz.hnGvyeVnhAHmI1.','Patty','PattyBrak@dayrep.com',19,'56_.jpg',NULL),(23,'$2y$10$vEt9xvGRZBFGJ2jFMXSTle7PYOFtwcjMSNmO7WzhE0XcYrMQX5FLK','Shivanie','ShivanieSterenborg@armyspy.com',13,'67_.jpg',NULL),(24,'$2y$10$kZVAmi7qPecLv1OxZrJl.uzP5IpGBhYE.0Osht9S1ofi.aqN8Z3t.','Menno','MennoWesteneng@armyspy.com',12,'87.jpg',NULL),(25,'$2y$10$pG62uIErv7InC/333jjQZ.qM7OxMqt.El6TxwdvW8p3M33DkX3WCa','Shahin','ShahinvandenDungen@jourrapide.com',0,'80.jpg',NULL),(26,'$2y$10$nrcm0zfL2TktOB7itDHLsOtHbRAa.j26vp9D6PXFzeqhjZrfeHQES','Jorrick','JorrickTrommelen@teleworm.us',27,'93.jpg',NULL),(27,'$2y$10$VFPQgp5iet21kiRmaPra6OU9hR798meFGkMWPMbAATM7Qft1aSOvi','Iyas','IyasRafidAswad@armyspy.com',8,'47.jpg',NULL),(28,'$2y$10$dGQLOsApyHlLlMSy67JMzeDFIJP586fRYJ43D7ugj9nxyKHqoUOHm','Ikraam','IkraamAsimahMaalouf@dayrep.com',22,'68_.jpg',NULL),(29,'$2y$10$N8MLe5kXSQqO7qPKsdgwqu5EfSdNfAaPT8gBVLPB4cqQmUbc1h8U6','Abdel','AbdelKazimMorcos@rhyta.com',21,'91.jpg',NULL),(30,'$2y$10$iJabZZhIZTiQUxw4d5l7HuA38BW462VwVzYunFCZqkU0251mxfsze','Stephan','StephanWannemaker@jourrapide.com',0,'75.jpg',NULL),(31,'$2y$10$0ILyR6KtbhCLYBHyh2UI8O.lolj3AVl9tPFNQP2QUShM9Mb7Buo0K','Karin','KarinEichelberger@rhyta.com',25,'89_.jpg',NULL),(32,'$2y$10$7tYuvNTwk0gHqZ.hMGCuUuygNrpovNvuCc8WXNiDRZ.gcKdtiN8gi','Laurene','LaurenePatel@jourrapide.com',0,'69_.jpg',NULL),(33,'$2y$10$E73liTRYzooBfF.aenPcdOPxM1fZopMzDUGHJBGmMtUU61yvRMkgC','Soren','SorenChalifour@teleworm.us',30,'88.jpg',NULL),(34,'$2y$10$rcK4IDJ9wlFN7LbcOuwuy.onU1JMJZVBsbspTpPvvSNFPtDwFnyJu','Fauna','FaunaLeroy@jourrapide.com',0,'65_.jpg',NULL),(35,'$2y$10$20blIab7n3FAOcrnLronEOcvyP4D802RotSwUW.VaEXOFR4dUZMQ2','Len','len@len.len',99999,'len.jpg',NULL),(36,'$2y$10$Qc7gOhXs7gBBdG5.FZ.HrOxVRLO5c.FlMnTt/763zPN3Tl73j6f9W','Bart','bart@bart.bart',99999,'bart.jpg',NULL);
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

-- Dump completed on 2015-05-25 22:07:56
