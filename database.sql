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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
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
INSERT INTO `events` VALUES (20,2,'Test23s','Description','2015-01-14 20:00:00',45,'452','none');
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
INSERT INTO `sessions` VALUES ('9fsj63vns042vnhkl0t5qatrlnkhgplcdkuc2iuhadrl7e33mftvt3kk4jv48ejfkmimob70ds39rukut768d7t7v1oa2sfstrgq7k0','1420617047','/58yhxMPXNthcwtFy4vEzNVzPHOjXlU/ZNJG6YbRdLWcpucGmWc1ONz3TG8rr+kjmkL0NbGR9BTbfd8Ya2ecmh76SQdhY1SeAxzXBaDX7Vqut8EILxlP32y0fmGhJJ1YccRHn47wujHazbMUpK4tUXQ4dki5COAxQZPgA1U7ab43dvxTm+LiaFS/pEmc4zeN0Lq6UUER5w1h86Oe5w87MWKm1ZpZhXXwOfFTAMkMX8Gc118ntol4Imq7gDHWoWtMRjTB/0I0q0qt9iMWevElbnLC3/+6iSzpse93rQjLKYSqE6YnQ0A2k/e0R/VdmbfnCS8xbuKECx/hn1XhqQTvzoxhcpuxLHlpB4Ikr1/iz+IXwniDrYjOLp8RXX56gsA4P150LjfirTGJ/qCUyx/pF3DWIEBNEJjcAEJ9ZWvz7B4ZLPYP62+pZ28n84irvDZ/9k57Hvwi7XjQa73fJn/XrnZDdonKwvwxhEWegHYIpdYiI166BzOwYiCz1sxuQ9mVHwsytTWExYBZofjtKUxXsvhHZ3kYQNT5ap2blJ/Vl9P1b+2tyZ34XrknzJgOLFj3MwnCBXL6dn1XYXeNFDksMfbe2d5/fGPuxYz2gHGPvLoDF3GkkRtirQuMDqO42fDpJ3lrouzURfn21YmkdjTI3LCblE3B3VieSiUQuHn5kFM20di1FludOt3LDjxbEuTuLe2qfvMedb75XPsAMK38fk4UdTn+GMj/2jSbJ7EgQqC2uQzRlLd7vIbWOyupNtl+nPI6/EYYDEXKwAkwnYVXPEc1FpX0EaIrEaBccNTDYL9LH54jUKus0OtdGNLOfscBh/LjJyVqMitFPL8Krr2eo+OZIkwtH1rsmou/Oej1j3gWdKVVj6hUdRnbqKrM5iibq9uinAUEahSVga7lh7rtTO8pGEf5SVdqvL65doAEKWY3B5hPgwvjL6pupom45fcwvUu1o9ZSuChMtg/kI48JTZ8XwyQR7MrFElN5Eq9XFv6Ueps5hi/IiPee0l43NZVheYOj36VMeDZY5epItIa1Mto01hOuXdXsaloIFgRiHDTetcZak/k3vaMAz0D1feDp7jU23qLO6K9KGBj/QZ8lT0V++GAZWlnWod9YI7C3u8vFoRaNmCdxn2Zqv1LMSYGC8z1IxNHh4bfiPk/lBnc0hZgj+BM5LdCZVYuhJVwRXhk=','2d70bff32cf36a54a291beb6e357bc7d5a71a1ee0ce0dea842120c0505056acc54cc9946c9eabf0c43edacbee9f8ef44bb2dbb0e6d14dcf3ac57c8c231f310b6');
INSERT INTO `sessions` VALUES ('bpb5kg7p3affh0nfppt1g3ah0giap56dgvr30q542m7frk4er350qh1qc5as5bsgqk65f13pqtc14bnqu2903tdasu0kh1p6h7ok100','1420792807','wjVG7s4wVF11nwqKjjzNEoGlHYaarWYqT5M970KUJP+fsYiEdCVddAXbJNuHZYvCuCy7Oxsdsijig166e8eFW5AeskbpHwwqD8Wp2bFw11XivHuRCS3SSMA+qz5AThcjg3F5cAcMZ0J1Rzt+chsNAIUs2T1C3/LmLRFOXju7tvyncsKsJojTiwN96fIt78JdQlI88MbTXe7SydLokO/BM3YlFyjVoxTxVKorhol1wgNSSKG93Gu9jYYvItMwC5iCwd11vCHXucadODSwNSN83M4YcZZ124EFxR6ptcu2o9lZJliUpulq2LqfY7ne0ogaVa/pAg44AKcMpeq1uJYuBdCe2dbJX4oVCV4EglgLHUGBAJzaEfoXhD/jEprFyCISumnFGFfpzRiFQCddAjJvCpiv6fK9/p050EDjbaCoT36doF1zQZncZNPQCo8e4R79fUKhMzYCvvYxJneWHjw9Rw==','96f5f5a351c360c1ee9ce0a9ef454c77f64366444446cab233b05a69966fcc3ba9cef1b45827494852f9bd83b91f3cf3e53a58cbcc9dfab65609cf0b756a9ee6');
INSERT INTO `sessions` VALUES ('l3hcfeqjs9bpki7qi11qfj1v205u93rhh2hqfak22la6gicojc7iv5bpkhvuaqniucddg43eaj4an5v9jp9j8lhdutbionjt446a9n3','1420552956','heoTf2nZcLOSeAEPa5GvIB6Pr2Oo1KEHEeHfbBA7an8aCDrkq0KPP2i19djzk+TTz2Schray04IUaUWYXBf7eeZfnVmiLNgLFgFQUALsruk6MfUuQDGQzqP5X0HSmADAbeCjGpt83tIqsbwcWG3G4XJPNKKWs90AAMOc7fkvxsYgFJGBn9jUx2g2zF/GfjacIdDPuMsvBcbZo6n5nDcpAZq75lijIp8GwUrGfgKuo1FzRQ3GZObqpa+OB1Xdjr5pRLWuzcwt3cl/Up5eijY3D3I337/7HXL9td+K5VeQmlgktTSeG0IVMJosLlQRtooXJ6VTBwgTrNQMYphCbywVPcjQK+yZIA+EZhwQftwhkIlYV3oEjAtJWvhuBYXI1eBeBUxxYVZn1pitB5t8jbIxlo/JT2T5n+Fx7pwxHw6zfXMg9KozPR3QSRckFY6TgojkBWlG6P8wYttLp9850CFNY9Fj6dKJ5npCMcz51kyzy2CjFc/0jBvU4yHI5PJ1pnnzCe7kpnFChj25+MG4NX7eOKtkLa/tf6lNiTUHVlbOIVHd1oXHs5W4CbQVtRteajeg1qE777Ze1fOCQI5NYSuEFnRe5rgruGUJq6AOxvfw0DlGUVr01MaL2gGwUvmHIaQugx0MAENKryI+/RtIJeIoHeCzGRV5lswDwZNUN3I8n5PNQ02Mwxl61veIpUJC3+gfJR2tnZlrP53RNHJeaFSS70hBfmDZ9ajknlADINrKPEB6277JYtcqJAdLH0avUOvqJk1YF6gY0bBIGRX0/vSylg03sOEVJEwWIErZ9UAcpUkD0Qs78gukWPERsr49G7iP6zPDpLODW3h5i5iYh+vOdxKmZNUB/jybm3JBLippEQ1VqW/iXdn4Yhip56WEt/o8ipqwMDaFBgwrwLWcK5HjMRGD//M+EI7f5L7DmZkQn2aXThVoymM5pKNdlWddkG7F/9N4X36wXNf/H10cHTtxHOhFNv0W1tgsUvCdnInaX/NAVUnHawhW+t+hdFMSXChCjTFL3dzml4S/O4fSZiQD2eSNl5j6U7Hdvt7J62VGZu2ZTelUR6fc8cqOGaeKWs8HVvcN4TDZh/NT+FIQ6CxLt333WYgMgS56Zquax6A/99mb/4lf9O0cIl1YXQQCxCyISwGM/koRqxehhPRZjEpYwkg9GPEQ7nzxltdxGIYtL7w7g0woKrpFSuakfND24I7yj17SMVH/lFC+IgJqQ96MpQp1PrIaCkMyQnN8CYPFo/2CdELBksri8dqzGBi04n+d','51dd4149d0911e7902efa405fdf3b394d69bf575c656ca7abc79dbfd61cbb95adb6948211fe25e9c0e2b5476871626287d0ffb2ace6478bb353c0451d61fa4a7');
INSERT INTO `sessions` VALUES ('lttl31sjnrh8kskh442chj0nu89ujg4dlc2j93ri1h4i54dnrf4636p3grnc00bl6ruofbi2t3gobfljopgaus06ucnne0siaq4rrn1','1420575444','zMb7tdEGNkXbTFy6C9LVm+8Su+leUFds9/wv9yHxkGwU5iQNlfVZSR4JEb/ZXacNDpqc+jwc/ARNKLM4jAMHbkD+w6EfBgvXdh1EJt1IXqkOK+fD3Dba3soWH7esHlNBDpwcC6cFLWrsm+Px2EoyHzazO1yV5FlgoDI3xAOtgQOMRv2k+NE5+M/FpeMrZ0SKCt1lt9+iFcAXCT6h9vkxHzroWCKRmGjTQsGesmG3uD2t/9uM2nTUp4rVzikZ41+GJzGwoKhrCMT1zIK7mlvYDez5Lo+3WZqTCoRgGt+HmWLo/t5rx4ChMm30WwA6XZ9twx+vS7X4N7zVBQxDvIShTLxQqG32kbJUyCxdKozX/Cea9uwpWmldPb2gxqDKuDKUtBDXRzRcq3FOlB4quErMVaHqeBPkvjBny8hslEJtLbuWlvZam9YspvsmoC1nhyzyhQ8qALsk7u6HnyHfVm/azzvIRdPhjT7idD6eRWmesee/jVJUF4yMvC/5ctYMFZXN','a3845e47a011b0f46067f26bad1176e04af5d58fd33141d88d397eeb5128aa0304c7aafaae589e797efdefebd9f9c767c5ffff286449952e51755bdc9721f040');
INSERT INTO `sessions` VALUES ('os5u5mq1vi70gnb9jhns332vpto69u6f1pb3icve9tcvl51pdprqountb36vma9q09ov92aidmtbbu9mi2g767uvagfo8m6r6appvf2','1420816664','/XiyG6bQnwI3RtFNrdHP1FTzrgLe/8BExrnMZhDcwVIyuG21pNAK0zaqVb/OzTO2IQ6dLyqeKktQ4XpFlVS7rcqHTYaK1cGGGZ4Y1vhphDGS+oPm2HtyQ6BKOLju6GokYpDZVh+hn5u9JpttdHYEVtwayMMfBN9GIB+To61PONJ432xqYQQ99o5Wz2NfabR4hHTScphS17qoU/pNi472pDFoQbGUKsr+wELgv0Ul6JBOeEefxM5i9SYHCsDjByK5o9tG6uTtFlBvIosHfWG5lul56+i5MWiFTaYdqw084qU36dyjT2tWK1mFCK7Z+rbZCtKHhZKdVwAQ+9v1+WkXP8CE8Z2BtPLb+5N5F2wCPvwGIoY8iMAPyxR8GzoWqtmxuCw/5QE6ymS7LnIB4InDWlM01mlBF53gp9xViF068N1rBRLUNcU5jhQV9Z1DsRf+vyKl7gYIpK2jVXf5GKy/GIVhY/jKLR8iUAl/XDMXZzkJ/aY+t+z6i6GiUL1/g1/3p9MrSH+MxvbFE5hw1Nhxjh1f6J0lYB/LjDouh0YUQDvn9rLk1OcVaUOF0Z7aA/c6aNu23EVkqL77iww6bS0axA==','6aad0711dc81cecee635a870e2d57c36411cc5eeb4eaa41a2d23053562b1814c1ed7c3778f6188f5302005f716afc738d77f1a03458e7a2b30baba6fc4a02513');
INSERT INTO `sessions` VALUES ('u019i89lk615vbr390fj5fikp69o0gfpggkh1km5oa5ofm1qi4jevvsks0jveblvhflh4jhdmb525s7pp56qcjjg7nbi2s3f2v0a5n2','1420794533','8HcOiXxYG0fCe9tGtdroegHRZJSf7KGrEDDG1xmmWIInj/m/6ZlHxl8zPQLja04KgCyGuEcr5ognjSqylD3fzn5OVVODCgTkI0zThEtwct1OM1nR2BRbB4YKfzeahO2VFPpPVtLRqqKmEGSUNpgdiluOy9RhtRzE347RBGymIZFJfpqK99mzAq9GGrbQAxoAy0CwL59rnb51143cUdb6vri+cr6ddtKLBGLm7Mbq/uWVzXmqv8bz13RQjz3T40WsRPIVYtfdckiUZ37MMTFP4DEKbpLyUODneoba3IgmXVzRUq/2qc5CJB6FGM5YQLq5RukicsfD9oQd9XutAhxW1tspMEMDz0f0rCmcuWbQFjdOEvvJz8YOX2DtQJz/NrZeALL+Y25gLhHNFeVpOWP6VIYdZdvMQCaA7sD2jsX02OEB/RFH4iexW5uGHEgJk0H0IEJ5Ako5pd/cNQVZ0BNsiw==','e18080c458c1103cdd2de76e5cc2f194d19be1582c6fca959c3432cab9a677f12640e07dd0be2399315c106ccb290158b094e0ac01e1698e0442044efaf2eb24');
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
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

-- Dump completed on 2015-01-09 16:19:46
