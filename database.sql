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
-- Table structure for table `attendees`
--

DROP TABLE IF EXISTS `attendees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attendees` (
  `event_id` int(11) NOT NULL,
  `creator_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendees`
--

LOCK TABLES `attendees` WRITE;
/*!40000 ALTER TABLE `attendees` DISABLE KEYS */;
INSERT INTO `attendees` VALUES (14,1);
INSERT INTO `attendees` VALUES (14,1);
INSERT INTO `attendees` VALUES (21,2);
INSERT INTO `attendees` VALUES (1,2);
INSERT INTO `attendees` VALUES (2,2);
INSERT INTO `attendees` VALUES (15,2);
/*!40000 ALTER TABLE `attendees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `creator_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `start` datetime NOT NULL,
  `duration` int(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `pic_url` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,1,'Test Event 2.0','Description','2015-12-31 23:59:00',2,'Eindhoven','none');
INSERT INTO `events` VALUES (2,1,'Test Event 3.0','Description test 2','2015-01-24 21:00:00',360,'Breda','none');
INSERT INTO `events` VALUES (3,1,'Feestje','Feestje','2015-08-17 20:30:00',240,'Rucphen','none');
INSERT INTO `events` VALUES (11,1,'Event 4.0','Description','2015-01-14 21:00:00',300,'Best','none');
INSERT INTO `events` VALUES (12,1,'Event 5.00','Omschrijving','2015-01-14 20:10:00',305,'Beste','none');
INSERT INTO `events` VALUES (14,3,'Test Event Cas','Description Cas','2015-01-23 00:02:00',340,'Eindhoven Cas','none');
INSERT INTO `events` VALUES (15,2,'Testing123','Description','2015-01-14 20:00:00',120,'bla','none');
INSERT INTO `events` VALUES (16,2,'Testing123','Description','2015-01-14 20:00:00',120,'bla','none');
INSERT INTO `events` VALUES (17,2,'Testing123','Description','2015-01-14 20:00:00',120,'bla','none');
INSERT INTO `events` VALUES (18,2,'Testblablalblalba','Description','2015-01-14 20:00:00',65,'here','none');
INSERT INTO `events` VALUES (19,2,'Testblablalblalba','Description','2015-01-14 20:00:00',65,'here','none');
INSERT INTO `events` VALUES (20,2,'Test23qwerqwer','Description','2015-01-14 20:00:00',45,'452','none');
INSERT INTO `events` VALUES (21,2,'asdfasdf','asdfasdfasdfasdfasdf','2016-01-01 20:00:00',120,'asdfasdfasdfasdf','none');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

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
  `fbid` varchar(128) NOT NULL DEFAULT '0',
  `scuser` int(32) unsigned DEFAULT NULL,
  `sctoken` varchar(32) DEFAULT NULL,
  `scusername` varchar(32) DEFAULT NULL,
  `scpermalink_url` varchar(64) DEFAULT NULL,
  `scavatar_url` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (1,'NickBraat','nickbraat@planet.nl','8f7a2fea4f7195c0cf2a264fe7a82e855e078b99040614a1694de23f8764c3399c434b225a8d33f9dce221bf2817780c9eabac5896970f8868e8bac14e2d93cd','dae98046f4f2665ebcd52d5a29d6e04bbe71e7549395a0f329cfe8138360dabe3e31877bb33fe266151b6427292a11e109fc1534c959d45e727dc384626e8caf','0',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `members` VALUES (2,'Peter','p.j.s.d.kok@gmail.com','589a2e3178a0005993fe7ffdb4015140444a62ba43044ff90b60172fb388470e3573f1a97b559a47af6c59237cd0de8b31155939824cb6e91c977e406ccdef29','e8783656aa34ccdcae48866b8a7d15e8722c682a99d7f390b1b4c02e2d33650998cdb844275a879e68898ddc2ee1c03bdf5c67f58090edcc461cbc44ca1ea448','837289849647805',19674541,'1-110922-19674541-b7d35464463b65','Peter de Kok','http://soundcloud.com/peter-de-kok','https://i1.sndcdn.com/avatars-000047723823-ckr5qc-large.jpg');
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
INSERT INTO `sessions` VALUES ('376uf2b3c0jvjq9ce6joq6uuej84egqm010e9ikongn36dcr10fniar4td2agn1u1cf7htb1rcanrtm0lhp66u6ujl5uuv158ujqqt1','1422035201','W1L9XhhSsV2L3VY0PR02q2EJckexEEn8ig7SpmL0C/OJdzGjq7Rh8DVa1ZjCED2rma0ohJjK82bam4Vn/UjB2GSywy65iiROI//yCLSp7BeMkO2H3zF511BlBfrEONg94gTvX11VZlPAxjbV/+LY2ZB2/nvQgZradDjGbNMSZyzUT27QZRBde+XVsH0JUkrz6s+XDncyCZi+O8PDen2qmgZJ1hc5FORg1EIs1QpvlnssK0JHCD0Mlhntfrsr55gOxkUvd9ovBFkFaNQSCY+tbkqFY71ia5JM3giX/2gYGYY=','ce550d23275380de23bb313e7811f888ccba376f90e9bfe6a7a36dc7c5412fd373dffdb96b97056473c63a753d6855351fbcbe58c3926a3d293dfa4d41e330ca');
INSERT INTO `sessions` VALUES ('gl1l51acl22el9n37abs9ph0rqsgn8fhgr39d57r2dkkq2v89e7va59ql00e80p5fe7ip51pcnm92k0k4u99v6h2bdid2esvd948to2','1422036799','qvfqRzbTDyGEgV0ZaEDBga7NO/fLXnFldUKj4qFreqmMwhUXARflearb+I8citOdsho1VSvCK91SIuduJMR9TQilhyb+cDCvZ5oWiN7A5+uc299bqiS/ojxYsW6m4AeNJdj1ey6NhisOv8ZIT4OYiHnc6nAZvhQfLGmSQ/sZ79O5UPrWVkt5jjqP4zrE/xcgjv1fx8LTpyDPY09DjbWQwuxaF1a4TlXKcjAKy3dLoNza6lr2vzp35UT+7A32uWHqyCE4iZDlsGlNT9xAOGpGA0NxwIuyOpjgeXfbI96wuJY=','da78701f9baf0425a810ed4177e1f6a330cb0c6c69daf6341a851d394e00bb9748503cea778035995abaf6667033eb44ad5167b43754242d6e08ef9d46c936a9');
INSERT INTO `sessions` VALUES ('jnv5acrdbqrn86ictom6piraa3tche53t88lednp3i336km5cd3462j2it6o7j1ugp9lv6e9i4qa2rpn04kagq9g4s5t9qldqfebn21','1422047048','z588HRO+ubFaecC+3/WJUSL7Kzi/5rN48NIfh+TQ23D2VFen00py7MuxfH7NX1jBISgvj3d7Kg7k2SDBQBarXxXYAkDWOUYUyN88dB+VbC78HZSibjbZJ1IeCSemlEo6qLXTIMYlLBBVR/pxQQuP5ffupUARR9lx+Uez+JvAMVZ8RNT7NI4lZeC74JM/jKIBanpZpA0bE3axB55f6cUJASpTkzdbTQHahkhXpHouXZOOWLzcVrUJxxHvKMxNOOYLQyFTd/tce3Stu+D8+pmmoeySCCLmpSPCuEfeyHsLdg8=','3f5a018feb2220e8c5b1baa5e8739724ad4344d78cc40701c58024c92619cd1c3fa9d5d3ad3812ac6e351fdff514f058db9c065e528ad0b9cbd9d9d1cabee20d');
INSERT INTO `sessions` VALUES ('t6vl3dv4ogc5tove6lcq96ebtqp4e302t0gpi7e03kb0cgc0j4f9m8hp9m3jba69roj6h6c0u9g11b7b8c6r415ugap94smjr849gp3','1422035167','hzt5jaunOFRWzpNMh8CtRwUKmuLS1zwLmvo8lywBCsk6YQqUm+AW49itvw9HEwpERT7UWTlY1+UtKOuuI7ckPMIi62EoHsOMb/G7OpCjZ1OET9ECUW/UycxCkJwAtMkzrzNp8vm4DgF1Sz9zvWAY3GuouVlahRVB3ORfIJG9/KDkpZeIpKeidvd8lNZYtMA2JSBACWBu7n0l7Qqam1g36PehrbkGLM1w9cF5vME1Y1al/8HFTEDEJRD+lUJiuxpbsROFMwdF90y9Xf0bup1mbtL+1oTIUmAmaQQdnHVT4cg=','d80cdaa351f16c2c0d246a8bde6b7492247886e120651e7258abd0ff3689a8f6a1e0e772ddc3cc7ca263599c86e5e5c2cceb189c8b23b68386abd8e686f155d8');
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `soundcloud`
--

DROP TABLE IF EXISTS `soundcloud`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `soundcloud` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` varchar(11) DEFAULT NULL,
  `member_id` int(11) unsigned DEFAULT NULL,
  `sc_id` int(11) unsigned DEFAULT NULL,
  `type` varchar(16) DEFAULT NULL,
  `addedAt` datetime DEFAULT NULL,
  `permalink_url` varchar(128) DEFAULT NULL,
  `artwork_url` varchar(128) DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `soundcloud`
--

LOCK TABLES `soundcloud` WRITE;
/*!40000 ALTER TABLE `soundcloud` DISABLE KEYS */;
INSERT INTO `soundcloud` VALUES (1,'9999999',2,7880687,'playlist','2015-01-07 09:54:00',NULL,NULL,NULL);
INSERT INTO `soundcloud` VALUES (2,'9999999',2,7880687,'playlist','2015-01-07 09:58:05',NULL,NULL,NULL);
INSERT INTO `soundcloud` VALUES (3,'9999999',2,7880687,'playlists','2015-01-07 10:26:15','http://soundcloud.com/peter-de-kok/sets/concert-at-sea-2013-favorites',NULL,NULL);
INSERT INTO `soundcloud` VALUES (4,'9999999',2,7880687,'playlists','2015-01-07 11:22:29','http://soundcloud.com/peter-de-kok/sets/concert-at-sea-2013-favorites','https://i1.sndcdn.com/artworks-000053124820-dwch5j-large.jpg',NULL);
INSERT INTO `soundcloud` VALUES (5,'9999999',2,7880687,'playlists','2015-01-07 11:36:50','http://soundcloud.com/peter-de-kok/sets/concert-at-sea-2013-favorites','https://i1.sndcdn.com/artworks-000053124820-dwch5j-large.jpg',NULL);
INSERT INTO `soundcloud` VALUES (6,'9999999',2,74517736,'tracks','2015-01-07 12:35:53','http://soundcloud.com/go-apr-s-ski/feest-dj-ruud-gas-op-die','https://i1.sndcdn.com/artworks-000038074113-ecxxwk-large.jpg','FEEST DJ RUUD - Gas Op Die Lollie');
INSERT INTO `soundcloud` VALUES (7,'9999999',2,7880361,'playlists','2015-01-07 12:36:14','http://soundcloud.com/peter-de-kok/sets/kutmuziek-stampen-gek','https://i1.sndcdn.com/artworks-000044122008-pxdkpa-large.jpg','Kutmuziek, stampen gek!');
INSERT INTO `soundcloud` VALUES (8,'9999999',2,7880687,'playlists','2015-01-09 09:54:30','http://soundcloud.com/peter-de-kok/sets/concert-at-sea-2013-favorites','https://i1.sndcdn.com/artworks-000053124820-dwch5j-large.jpg','Concert at Sea 2013 Favorites');
INSERT INTO `soundcloud` VALUES (9,'9999999',2,7880687,'playlists','2015-01-09 09:59:08','http://soundcloud.com/peter-de-kok/sets/concert-at-sea-2013-favorites','https://i1.sndcdn.com/artworks-000053124820-dwch5j-large.jpg','Concert at Sea 2013 Favorites');
INSERT INTO `soundcloud` VALUES (10,'9999999',2,7880687,'playlists','2015-01-09 09:59:49','http://soundcloud.com/peter-de-kok/sets/concert-at-sea-2013-favorites','https://i1.sndcdn.com/artworks-000053124820-dwch5j-large.jpg','Concert at Sea 2013 Favorites');
INSERT INTO `soundcloud` VALUES (11,'9999999',2,7880687,'playlists','2015-01-09 10:00:20','http://soundcloud.com/peter-de-kok/sets/concert-at-sea-2013-favorites','https://i1.sndcdn.com/artworks-000053124820-dwch5j-large.jpg','Concert at Sea 2013 Favorites');
INSERT INTO `soundcloud` VALUES (12,'20',2,7880361,'playlists','2015-01-09 10:01:17','http://soundcloud.com/peter-de-kok/sets/kutmuziek-stampen-gek','https://i1.sndcdn.com/artworks-000044122008-pxdkpa-large.jpg','Kutmuziek, stampen gek!');
INSERT INTO `soundcloud` VALUES (14,'temp_id',2,7880687,'playlists','2015-01-23 11:21:17','http://soundcloud.com/peter-de-kok/sets/concert-at-sea-2013-favorites','https://i1.sndcdn.com/artworks-000053124820-dwch5j-large.jpg','Concert at Sea 2013 Favorites');
INSERT INTO `soundcloud` VALUES (15,'21',2,138084493,'tracks','2015-01-23 16:04:23','http://soundcloud.com/neus/pharrell-williams-happy-neus','https://i1.sndcdn.com/artworks-000072683010-jc546s-large.jpg','Pharrell Williams - Happy (NEUS Remix)');
/*!40000 ALTER TABLE `soundcloud` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-01-23 22:21:02
