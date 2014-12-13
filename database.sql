-- MySQL dump 10.13  Distrib 5.6.20, for osx10.8 (x86_64)
--
-- Host: localhost    Database: webtechgroup5
-- ------------------------------------------------------
-- Server version	5.6.20

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
-- Table structure for table `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_attempts` (
  `user_id` int(11) NOT NULL,
  `time` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_attempts`
--

LOCK TABLES `login_attempts` WRITE;
/*!40000 ALTER TABLE `login_attempts` DISABLE KEYS */;
INSERT INTO `login_attempts` VALUES (1,'1417979556');
INSERT INTO `login_attempts` VALUES (1,'1417980530');
INSERT INTO `login_attempts` VALUES (1,'1417981152');
INSERT INTO `login_attempts` VALUES (1,'1417981252');
/*!40000 ALTER TABLE `login_attempts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(128) NOT NULL,
  `salt` char(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (1,'NickBraat','nickbraat@planet.nl','8f7a2fea4f7195c0cf2a264fe7a82e855e078b99040614a1694de23f8764c3399c434b225a8d33f9dce221bf2817780c9eabac5896970f8868e8bac14e2d93cd','dae98046f4f2665ebcd52d5a29d6e04bbe71e7549395a0f329cfe8138360dabe3e31877bb33fe266151b6427292a11e109fc1534c959d45e727dc384626e8caf');
INSERT INTO `members` VALUES (2,'Peter','p.j.s.d.kok@gmail.com','589a2e3178a0005993fe7ffdb4015140444a62ba43044ff90b60172fb388470e3573f1a97b559a47af6c59237cd0de8b31155939824cb6e91c977e406ccdef29','e8783656aa34ccdcae48866b8a7d15e8722c682a99d7f390b1b4c02e2d33650998cdb844275a879e68898ddc2ee1c03bdf5c67f58090edcc461cbc44ca1ea448');
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` char(128) NOT NULL,
  `set_time` char(10) NOT NULL,
  `data` text NOT NULL,
  `session_key` char(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('1hj17rcojei2bbnfca2hdkjhcep7o0ikc3mfihcejefro4hpkbg4pe0jf9472rsjnb8tl1gm1gsce52dgd2ttufd15lplf1ejt15ro1','1418511126','AMcDZK76lUCI00L0ygEQwKIXXseIPPXg31AZd3I4wmNwQP2+KQI1jdtuMhfOiv3BLoewkXJd+ltx55PlRZvNVofkINY7yCLJILXp7HeNPJjFPUJd7QEb5LxpqMon0Q+v0S8C7o0eQBaHIGt4rMbzybvDF4X4Ttgde3x6HlXBWUOiBgjLGO46rh1hgH1hYjtdzCAtEhdSxKnwJiWmKp3jvBkMTRbju6PyRiHPluSSpDWC+JvCiK/yr39nzzIGC5is','5a3dc3c5ab9c22d40f84eef1106a9834220bba59092f00af7382021ca04206e3c5bc4e43d6d3fd5746de679d4c99e08437e9f45fce449605081d07e33d0ac49a');
INSERT INTO `sessions` VALUES ('5dp5h2icid22nvtbmbr191mrmov9hn3c64te40f2hn07frtrmjqf4i3ovf4b54170ts80k0plv9rgnpr5ii0c3bvbv5t10e6dcknjl1','1418492146','GnrktiTPZeBBWdzZEPV1s9bZO1bsFMXl8J7J7Jw9m0Y=','a0e3a984fe6187334c0e76dfa16f8fe1c77d9b7b55fdba174d2e036138667891d0b7ed845568d6db95bfa698a006bf15adf36131f8d39fb9f61c5a543b1d7a98');
INSERT INTO `sessions` VALUES ('cd2jrv1isag92k460r3iv3aspf9g0rb2f4d2ts2iieb8iprd0qd2b3hd25doqfa6o4o0nkas6ifiklqk80j861l4a9doa6v6257c073','1418491673','Y84ECs+olzE0jZuYVCAQHhGUnIVLLnZRwZEGyyxXaUw=','8262465b17063016e85558a2f0fea0e6a4c07f76b10a35158ae681e2c5fe6b5c0d87d91a8dea3a87ae1b2fdcb5a0269ac8810be684e428aa7f0df928194e0ea9');
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-12-13 23:52:25
