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
INSERT INTO `attendees` VALUES (22,2);
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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
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
INSERT INTO `events` VALUES (22,2,'Hardwell test event','Hardwell\'s test event, testing a lot more shit and giving it a boost, no idea how much text I still need to type, so just going on and on and on. There is snow outside and lalala on the radio. Just continuing... Barbra Streisand... Oeh food!','2015-01-25 20:03:00',121,'Eindhoven, Lempke','event_b079266b2ee902b33afe3be2a5472ca3.jpg');
INSERT INTO `events` VALUES (23,2,'Avicci\'s Birthday Bash 2015','Avicci\'s Birthday celebration. Featuring Dan Tyminsk, Hardwell, Gregor Salto, Vato Gonzalez, Partysquad and many many more! Tickets available now. Be there and enjoy!','2015-04-05 20:30:00',360,'Klokgebouw Eindhoven','event_313f04af40ff0131946b7030b71343f9.jpg');
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
  `pic_url` varchar(128) DEFAULT NULL,
  `fbid` varchar(128) NOT NULL DEFAULT '0',
  `scuser` int(32) unsigned DEFAULT NULL,
  `sctoken` varchar(32) DEFAULT NULL,
  `scusername` varchar(32) DEFAULT NULL,
  `scpermalink_url` varchar(64) DEFAULT NULL,
  `scavatar_url` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (1,'NickBraat','nickbraat@planet.nl','8f7a2fea4f7195c0cf2a264fe7a82e855e078b99040614a1694de23f8764c3399c434b225a8d33f9dce221bf2817780c9eabac5896970f8868e8bac14e2d93cd','dae98046f4f2665ebcd52d5a29d6e04bbe71e7549395a0f329cfe8138360dabe3e31877bb33fe266151b6427292a11e109fc1534c959d45e727dc384626e8caf',NULL,'0',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `members` VALUES (2,'Peter','p.j.s.d.kok@gmail.com','589a2e3178a0005993fe7ffdb4015140444a62ba43044ff90b60172fb388470e3573f1a97b559a47af6c59237cd0de8b31155939824cb6e91c977e406ccdef29','e8783656aa34ccdcae48866b8a7d15e8722c682a99d7f390b1b4c02e2d33650998cdb844275a879e68898ddc2ee1c03bdf5c67f58090edcc461cbc44ca1ea448','user_fa88fd776c1bf515dbb428cce0ba081d.jpg','837289849647805',19674541,'1-110922-19674541-b7d35464463b65','Peter de Kok','http://soundcloud.com/peter-de-kok','https://i1.sndcdn.com/avatars-000047723823-ckr5qc-large.jpg');
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
INSERT INTO `sessions` VALUES ('10aqdrhcl46vh4bo25rcnv23ndgeeetnnq50r0ktok6mpssdaou275p7u284fo64afhco0abrfkoou0naqlfp7tuqccqe1qc7rc9lt3','1422179638','uivlZF9iJNyRZEp4VRd3GzRhzxITf0t0Y5C59h4XWRzkmVUxDw2zMOznr/a8IAaUDavqZXYkvBUDwa/jNXqbtgwt7cW6tDc6jUdyhyMhUygyxrWTtDIlsUMT7yDWT1R2ci6f/r2PdXSj0eYoPcqPqy14TPVuKO3nU0EuBMnsFIzmEBG1vDVT5851T1QgcI/xK0ppgy+fit3t2RPjXjsJtixbEKUi7tJsL8D9r3/JcIIcvzSMeo/8pMrw3TV/BueDg2n43YCW3Yu9W2I+O0H5xAmfoaRKHGm1Oy7TNLDCYnI=','5034e7c2438d52caf4506b0cd24dd6eadf7c39472f48dc3cb6122f2c5de88d70ec875a8aa25bcdd6d6725eeb1314bfcacbfcea2db235f97798f3bfd5fc47bf57');
INSERT INTO `sessions` VALUES ('10p8srskl988bo8kcokmk07pb87tsk1bpivpu0ct3i326o3fhfek3ai1j1teocgcbqoeaom9p3aj979bc0l1lnfgk0ivul3ai4ppt32','1422181660','yJkxYTvL+1RH4aCjyPpJBIg8CdUVC+XjNXYjH3XdveNBhMRa2LR21xeCdk46sKp3Laq751AjSt369R/tDkdo7qFwXrLW8rcNtpo0ejpobz4Ip4u6FiFPa5/NWsYr3rGLDBS4pdGiJn2y9BlyqyjzyBD1eGdhQ3YdIRDlbruHabllr+8b0/WtU/VMdaxXRZIlTokS73vG8ZvhkmMxS7oOXyHWOQRdy1pVivRVhaQylnk5/ncxlzoBUCyG74rpl2Se1xvaPiMU71vbRWotSeYWfyfuMfA76r0Y3zPAUhvcH/k=','515dbdd2c455fac8943e5d1b2e876a6b7f7d3fa8a1ab19483d409df4274398ef6f700b0dfad0fb6c36a003e08e2d9f0e385d56e606e1b69ebca8d117971290d9');
INSERT INTO `sessions` VALUES ('376uf2b3c0jvjq9ce6joq6uuej84egqm010e9ikongn36dcr10fniar4td2agn1u1cf7htb1rcanrtm0lhp66u6ujl5uuv158ujqqt1','1422035201','W1L9XhhSsV2L3VY0PR02q2EJckexEEn8ig7SpmL0C/OJdzGjq7Rh8DVa1ZjCED2rma0ohJjK82bam4Vn/UjB2GSywy65iiROI//yCLSp7BeMkO2H3zF511BlBfrEONg94gTvX11VZlPAxjbV/+LY2ZB2/nvQgZradDjGbNMSZyzUT27QZRBde+XVsH0JUkrz6s+XDncyCZi+O8PDen2qmgZJ1hc5FORg1EIs1QpvlnssK0JHCD0Mlhntfrsr55gOxkUvd9ovBFkFaNQSCY+tbkqFY71ia5JM3giX/2gYGYY=','ce550d23275380de23bb313e7811f888ccba376f90e9bfe6a7a36dc7c5412fd373dffdb96b97056473c63a753d6855351fbcbe58c3926a3d293dfa4d41e330ca');
INSERT INTO `sessions` VALUES ('5k2uh347vf3ansmnnpkc0vtqnq1p3sdnkoe30j6re0cqbcb1ke5pcvo2i5t7rdhc5ad6gfn75fo3jb527ghgsv53405u5l5cthmo3p0','1422104553','SJMedoFkmM6oUnPXRyep7bxTpaV4y41RW8xSd5LAS4UiDwR5LxfnCidkDM6TlGFL9LDqiZ+1bpMdSHUpC9SJtQaJDSM7mSQ7/osej8PhIeBfYs4UegUGrofi42+oVd5Gh+Pu04keANZkDrmrpirkB7TdQu/qKlvrDRHOsVrBieqrHhraurhYFEm0b9I0DTqojLrH9WyWSt7ELHiGFgNwucKSEPTXCcr+32zeyaws09AiqWZhE0orimk2iuLWGnuhUWnlOyVzxUj7uJ7LjGSI9DVi1+y9j4+OZjrMAiD/NrDEj7StO6Uf+nEo8yt9hrVb2MpbGYxaluPXjCaYoWXNmenbdRxpjM5KDCacTFNQ9SBegbiDGAMsnF+jDZImEoK0L2/fJIWlxzsF1mP91PAKP9ntloFzCxI+OIk3pWf70EFdLWVJlUkDYakURYNSr6DmngRHna9A17/OEtusyTy6Tg==','955c5a4ddac45073208ae7b608638a1bd75f8ced58fe8611664aaa424912dbae273ffbc51bd2fb8e817fada7de30456af5ad1d3bfd59538f6da51d5d907f0f90');
INSERT INTO `sessions` VALUES ('a1h91dk7d6k69c8ombqt2e57ol8qhveb0dhicjb7o1b1oj5jbr49c8j4j7ktq4frgm0tc8jsdobkreu62eb134k93uhdimau1cppac0','1422181589','VpCBmce+JibQc2zajUxAL8TKS5IdCXZR4E18dj8MgJanl1THTTM7cp6HCzsq/iPzwmyqPaBG058o/i3d8/2aghCPOP1wEbBq+oNLGE4+8CSWW59mSL1jOn08cIiCBjyg9k13+PzXqpVjfRwOU/w0Xz5CaXo667pd//jA3mKVH4FndIXq2DXPawgFdszAnsr7Nc7SSxc7AxEpFyXs4SO9ZFX2V2mPIToOh9zkgwUbJMpxmpmoyxjPJ018lmXjZZkoZpJj4rCO8Iyo4AR0dEzAdNj0Pyv/czw+te8BRwjqWSQ=','71860383a2369f238d8f848aa5a49f00d2ff8bba9d99fad0534a91177273766dd2b1b992ecba4f5f2173dcbf66e3105c456c6fb1ed488e6c0b7e293fa06f9cd1');
INSERT INTO `sessions` VALUES ('anfj9oa20aknor5ml27pmje56fi18q1rs136gudiu0cuclf2mcpni2gvedcgj2af0nkh2br522hmne0ia6cqtlesmo9as7k3ocp6rp0','1422193114','+RoN2LsCd8CGo7UFVpmHwzJvW4dwcjutLKsff5N5HSGb82Yar71QAu8mgJp2yP4WrTpgXWl9Vno8eP9T2iddGmaQPM394L+aE3vsBrIuXGMaR1109VsXVXF549uD8JY8ppenO1CwImiVVBc/tFAaFtF+Xy9lCi3XbFowTkic3aDx/ZoohS+nJNVe2LEXyvLxin8KUWVc19NX8w+NM8x/4A/GboXZh8M76SdG1fGhodfIOPyftATVD+/riNcQX2i7GbvQ8NmvNvtO7BsFOLfLtVwYXnmyVVczltB/WOdSHQ2/WUYPq/+vE/wgjCK0lyNSNMtbb7QOWs+PubWZHhZYei2RpDnLDjRxqpQXnMCpqepfoaZY5U+bSkos+e8FpqDmhl6PZBExf5Pv27ObQ7luPiVykiyEnzhetRQSfkLJbwo=','407b3af61cc9d3e6cf344bd521476d475134246c041e29213fc8a9ffba7faea30a3893d9763cafae1aedbb2a4797c2e5f85f894304af0e4e9f27086b3e9bccf2');
INSERT INTO `sessions` VALUES ('bl05up3ru5c8ejakv3rlaq1mlipkf0jc2bi17fbgfvpf98i3hv0ru6ng1i5qckjq4mf27ehtgiuon67t3m0sh844pq9j1b65p7jk6m2','1422179657','yG3FVv7dVauMOir5B1MNYsZxkNDU9me5sNr17t4xsM0yTedOtpbsvtLlfLrPmbCUPMhH9/X8xNb1pcazl7RYRXHbF1HcPOA/uMm4jDRmgA4u6lP5nLAsmdRxxzaMhuTMxReF7S8utxZia8sf/NLHJbX+jhXkwwhOlby580A4D53Vdi8Rw15GHdn3ql1e27kUGh0KxkSLHGe9pShxzi+Gw+Vh2dg2VH5hpalvcCFJfIUK0DSXn3sHNqI6KHUn94Pt1eZcdgOGYbgAlpMT6PBNZJSSXtGrtI38qXrXsPhJWI4=','266a4edd48949b7cda8b59fc39eb00f18e9d6a68a72d925803d5c47a8fc348121197e17e8a8ec8c28d30743341ddc5fefcd68698428e6f000c0a9f78d422584a');
INSERT INTO `sessions` VALUES ('dmmfv3keqar8urjn2f9r8seamf3j2ci2fd5k72nqt1bm56tkj1jjr5jn5bfmvaide8tjj3jggdce4ah17h20rknvh4j204sijt3s742','1422181626','PCO+FZQTpML1oYy37dYEVAozFHITuL08h5HZcx/GvknezIfH0l5F1ZTip2143xa+2yLyPkKRT2HD04NCaXj+RP2zsVqJVBjmh+861RXB6/WR8WGu2Ki4eyD4nGgBquyqvsmsj1HbIP0BG9nDNRYp2CHk+Zo5hVdGFw/MMA+VtkRot6jyy+UXzQMGWbkZ1FUSfV0iFt28UHB3vyuP7yxKfL2gsFNiy7OkRFzUAx2ln9YAgRQXgJCAAmR0kzCgoPQ3bkfI+ppeqllnDCxyKIqOddkgenFqKGjY8RrWlMw8ee16mstnxISiIixwbh4rIr5kpaRupO5PzhX5D/gjJLj3f+GSQYdhoVpzQ2o4iYALb7N5ZWRk/yEoqDAHuZYZruia65rBU92ep5OcxkYLv3b1yqgTH8GKyxB58VttvkmCDILvozUl0mrjbL3Xc5GosP/gRHyV7gujuDlTwWFnU+eUNA==','bb30d767eba2fa496b0fe0a92427ffe92551deb47719b213567ba26b1fc35f96c8f70a8ddea8229f8e2f52d41bd82c829bd15d8eddc9370c71f636c2b7a6316d');
INSERT INTO `sessions` VALUES ('dni2jr6l7k1ot8lpsgo1afc4d7jqt1edni4ek63l1j68oharllhvhrgkeb0gacr6366jetkm6tafp18go0tvja0vflh2vnmi2iau7d0','1422048720','Ai6sDgY2YUG5lGgm5ZPygBNpCFICEzwlQqRXnHh/hRE/DL32RHSNEJOnHMJcoQDxUTPQ8f2am0xpNsCnfbXC4B+e9+7z5227Cvht0as9du0Q1HfqahNcKaktLSEfFy7tanel/vIN2y7QNmrKux+aqQxYtCNJ1lx54v8c8MBmCUP17sLbVdfG2TcyjU6IQ3/NN/1e7MTqINImrJfPoeanOyHeSfy2s2bpMeNqfoe6MbjhooDZxRFlLQyWMO/+XCil/xhJLw+nj+C9zybyx6XRL+mQL8qIoPT7hClZp7Wqtgo=','45d03365047f97eab9c6865a9a6947d28c844655c7031f8471f390907dc7e1e7754cbf60ff3625cfff02d5ea86b2467e765078a93a932adebb95d6f1f18c48f0');
INSERT INTO `sessions` VALUES ('fg4fjjbopvq44kjra24tgoe4m2m3i3205ll9ec62ls0oo215sp11s8ajb5ktoo4rhvi6h64vk8ra2p39gj9ledgbog7t2g72drv0om3','1422098659','e8jDBggJttOT9TUocv78vDhEP+HhKzNBSUPHLrIPNQc=','6de1ad55704429d87dbd00eb3b368fd715159b5cd1c221dbd7ce8f97d473d7326883d3f2176d13f8e368ed51189c980d90f2784c6380566263ab45926fa573d9');
INSERT INTO `sessions` VALUES ('fsnu1mi6nd22h9br6vf5lsu9tk4aohjde27l8hjh0uohdj4sora5bfks6dil1p46tgdn9ehoi1i3hnach7dq4ut2bomjgtrkc4a7ga2','1422097094','DpbYGdKmjSSNQUbxIY18oHLWmzgVC9c1INWuyKtJ1h8=','f6f34b8357216a66f004fdcecca82ca0ab302ad65d1e6d7b91be037c9330b3f270f7d0cc63e8838fc18788bea1aa5214d538a3051d11bf6a05c0d23cea65a069');
INSERT INTO `sessions` VALUES ('gl1l51acl22el9n37abs9ph0rqsgn8fhgr39d57r2dkkq2v89e7va59ql00e80p5fe7ip51pcnm92k0k4u99v6h2bdid2esvd948to2','1422036799','qvfqRzbTDyGEgV0ZaEDBga7NO/fLXnFldUKj4qFreqmMwhUXARflearb+I8citOdsho1VSvCK91SIuduJMR9TQilhyb+cDCvZ5oWiN7A5+uc299bqiS/ojxYsW6m4AeNJdj1ey6NhisOv8ZIT4OYiHnc6nAZvhQfLGmSQ/sZ79O5UPrWVkt5jjqP4zrE/xcgjv1fx8LTpyDPY09DjbWQwuxaF1a4TlXKcjAKy3dLoNza6lr2vzp35UT+7A32uWHqyCE4iZDlsGlNT9xAOGpGA0NxwIuyOpjgeXfbI96wuJY=','da78701f9baf0425a810ed4177e1f6a330cb0c6c69daf6341a851d394e00bb9748503cea778035995abaf6667033eb44ad5167b43754242d6e08ef9d46c936a9');
INSERT INTO `sessions` VALUES ('i7q2h82q862ohss6i1v08vk15p64km16opoaq9f82uvqdvf8gr5afn3jg6gm12mg11jeo3sooajctsm18nhb4e57r3tqlv0hemfj4m3','1422087432','86Xlzx69w7dPZm44/WAi8UT6/4p97rFR4WCrUwyFbEMf1/uzq/GLBTMUEGPkkeFP75iUIAdoe0OPqJIlzJL5f9KtxRXqp3qUuyAf5jRcKH4ump8T5Glj1PNS4DuM9wU1fniFrtRvpw6MQCAVPm/8nRLltd00LQbp6krIbF6XjkPkAXGUjxAopzEaYwaVbkt8bhL5iny7QrVsm7NFX1AE3Q/Q1JlG6HIxNAu/wFFr2v8LmgG5S+ENNwxnVOkv8ZYjUiCOopzvLIarvhAXHOng7ftEZNBF+xwmEW9WBYq5n+M=','3eae905af963a9eb9fc6620264635c8fa7ebd5d77713083b04306e037ce0f4266e55c05b9d05d2038fbf4df44b0079bb3d1864dc39caf4eb17aadbb3a688492d');
INSERT INTO `sessions` VALUES ('idgl4in8v374c4i49tm17unb1kd97p7f7opog3158955iu8mrmhfojec7snln2vahp35a79pgf7io7mcrirehe22bkh4e5abeh4car3','1422101927','ElJWtlGsONWPrlvr14Osb/xsB3f8xSuzdd6MFwVAew7nI5wm5AFHHRNxCUeUixHETr1d/iZ9nXFm7gpEW6t+l4YUFptRBx32WafAeQvvGzHtiHTVM3vgYR+7H3xp1zUSDNQohg7SZcvm0oYP61mf5YgvN0tz32RDS5fwgy7mtDn5YS6p6mZqzMnI0MsfppWqBgYPd09ZqFEljlsnwt20RnwSEXu392Jn1KJ3z9KtPYsQubham7L4eX1lT04Ie/Ap6aFIk/r7+ALKU8kuWZ20S2Ea/FZXlkJc5oCy1KIqvk5NHPa7UfR4aYeLRhg31gqRB56V7tVt/SDUmTeXprbxKFCb9oQyda14N1t8+1Zf0cVCIvlWXA3PUaPw0h86fgQnbkhwvQ4UrvpbzIbex+H54LNp63OOIo84lwozp52jdoonLjaQPDdOCIuZXdImWwPrTZ1hQ2NQAw0JCVS1ZHiLOw==','23c02de7f7ae32bda6c64704a62cf7193d1a687d9751ee5a98e3e93cb24db23f171efa575991e41a38eb9f1d39503285bb18ae63b0e6e4f2242dda952f50482b');
INSERT INTO `sessions` VALUES ('jkk65jd6b17knpkqm5vo6vaok4867rquscnrhsiib1m4amcb6lisk8n8at4j4asdqs3veg90ibn9q6kmbtmuespoi4ljr66br89ltv3','1422102762','2Gr3TY6ALJWB9SVCF+ghHfcUryTx3cXD+bjfgV0O2pk=','ab5976b390117fb20d7457bf34e76f5d0aa61ee821bd46ee609cd13ebe5dbfbc1b8078cd6e0ffc1f9dc04a15f4a45de98e8a119e7b6aaaab257e54cbeb84bc67');
INSERT INTO `sessions` VALUES ('k1ad58jomo3f2apkrsjkinsnbga3ibpvjhjs6sqsks66l1bf5a1orej1cvblfg6tibou9oc74pm6eblns4ijeo0efdblmb3bb2b0jj1','1422104561','YUpRTX0rgAVs2z/G9zNABTnSZj09DD/uqvjmGuP3taZ0vvuC5VmGxoJW5cZLxXVydGFANWK3gfuxlt6gDRfN/WmIYvdfx2UniS1AS6JPa1Fq9rq1+xrL1TL85/Unu2i9/wpZMJ8A9ksRraXsNg+kOarlOl/FgZrpTrB5zpsYXbv/vay8QVvMP8CVd7qKFvkn6dvDEFAxqZdh3LTaF2VtNyxkqWUg8hCQnpmgEtYEXSMMps6YcI45zOIiR4kIWMk6C/CuvQc/y05e/2STsC4FEty8B9L8cWUHq195BFELLds=','eb7219f94501bcecbe6d344927e7057ad87246860e3012db50857d57ab92fd7d323fad58323221f75434baef808c2e3281810cafba1043ae3f55f177a0e61d3b');
INSERT INTO `sessions` VALUES ('l0tlggndgkithlj71vanrde29knfl68m7rb0djtc3htutdj59eh7pkvuse341ouu5td28cugn9gnkonlnbq9533dhk071bnu4jfnud3','1422181563','zJegurEIa5lRzUAQffpDk3uevRtH3KcI3obDHDvrG/BcODANO8W6E3Bj7C1S2Gn9lzo4IMDr3NMiE+P85R/FLP/z694mXx2qhwmYtYjE0WvCI/3ANfGjrc8DeDtIdAsYALhSZnd8ovZ/dkg86sw62kNgOxFQJ9pRw2wxZwFTnCChPmj/qWshOmPKwk18Jw1+jYY0/EEWwTqOWCf2PuJkE2/U4wBofWvNg8PIGQT8tonraNVzTeawyV9aTafXV6bE0RKhB2eJgDSQmpToPZDjeMvp2LPbhJR/NTYhk6i7Qbc=','a6c3abaa1b3d334099880aa18d495545dd653b9f8cd9a42dcb5215843a6f7328ed8ce67cd21a8b8fc332479ce29b09e270295078470103cec45e94f8bb1af05d');
INSERT INTO `sessions` VALUES ('mqi45dp8e95ung6gg63gqucfa6aj2eqdt44avkg1b3etp4kg38j7umg6hkrf26hhu79oiti60e9f787a7muel9enmu00hvb9t9nqn82','1422137706','LW5W2B2Cwjvg541LAkHghMoas9lGvlYKHR5nmNxXvv4=','e03cb0ff036e78ad86787d38a47bc35dd99a133805aebbe58162f5031d25c4419af37036f427a8152d0c7e7f2ae33398e7f726164fef646abb0807a1f436fa1c');
INSERT INTO `sessions` VALUES ('recg4u8kqk1ubaaikdo0c69rt6vindms0jqcutiibublktgjujl1r52si4tcv1rdcf5jbdkd639dq4llt7sjk16qlivts24abdmsor3','1422097977','+d6lL2VDKGPE3EUl8/RUrYZ9PfKfQDg+h3X8mYrnU5E=','de888768f8224fa9440a06e91dce3e1f9a18fa5509dae59e5b9a4346d6bf8e03b81e0f4bc3f5ad612cef1bc0ad3beec9749df1663eec32f54be5b145d1fae771');
INSERT INTO `sessions` VALUES ('sj7u439hc7b4kbl7qmhqsukol3dts44n6cjifq0tv722bp9b6ie24t3npqp650q4l5fq1cbtttqop10dhvrmefseg66l9r78d7r6ms3','1422181580','/RfiZUpDFq8oNTMSbJiuSauSECzdwmuAcBLvGeYnByFSzDAHYL/BYCbIk0Ii/oMAdkjYY1l04cxBHt6NlZVdcerhGWygrKapbsM7igRvjfbSfzI8/zLYq3PgvUm8Q5KutNMSrY+kMqPr0GEVLZEwDvtlU59Gn8w3Kypq2wrIbxdZE8EXy4k2x+yKVdY/lTRiF6RTSbZPsUDekpRErsOcE1R+YsrLclqPyJ9fQ5/qGWXTIbFNXxBt8GxANdhIqZ/ne+Wsr0vXUaR73Nad2RZeu87/pdiIRsNm/ek6nAKZ+B1VTjgsjsdFGI6fpH5NunuZV7LYDWWlz13NWyMSM+SYew==','f717cdc1c59ad3a216e1b5ea313bd91770bae7b948bfca82d67ff146cc22cd42bf9e825ea257a2f7a82825702f4329eb15a6cda582d0d7bd54bb875ae64a654f');
INSERT INTO `sessions` VALUES ('t6vl3dv4ogc5tove6lcq96ebtqp4e302t0gpi7e03kb0cgc0j4f9m8hp9m3jba69roj6h6c0u9g11b7b8c6r415ugap94smjr849gp3','1422035167','hzt5jaunOFRWzpNMh8CtRwUKmuLS1zwLmvo8lywBCsk6YQqUm+AW49itvw9HEwpERT7UWTlY1+UtKOuuI7ckPMIi62EoHsOMb/G7OpCjZ1OET9ECUW/UycxCkJwAtMkzrzNp8vm4DgF1Sz9zvWAY3GuouVlahRVB3ORfIJG9/KDkpZeIpKeidvd8lNZYtMA2JSBACWBu7n0l7Qqam1g36PehrbkGLM1w9cF5vME1Y1al/8HFTEDEJRD+lUJiuxpbsROFMwdF90y9Xf0bup1mbtL+1oTIUmAmaQQdnHVT4cg=','d80cdaa351f16c2c0d246a8bde6b7492247886e120651e7258abd0ff3689a8f6a1e0e772ddc3cc7ca263599c86e5e5c2cceb189c8b23b68386abd8e686f155d8');
INSERT INTO `sessions` VALUES ('uhhejqmg95odravbb7786edjk8l3tr73ng0iejslagjivsh703nlpqli2mdtol9cko1jss71jc03ruj32k6ff4s76ccsi4ji390lc01','1422087891','+AeEKzZ+AxqEIkaQ83+Y46mJ7ftRZYSKA1VZ/wEtumk=','242937413cc997a86e029c0ff6fc79acbaefd3e253484ae9d7708f3ff366be789efd41f216e1222b605fb02f29bd2d91d185771b0c086eaf5a36fc25765fc417');
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
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
INSERT INTO `soundcloud` VALUES (15,'21',2,138084493,'tracks','2015-01-23 16:04:23','http://soundcloud.com/neus/pharrell-williams-happy-neus','https://i1.sndcdn.com/artworks-000072683010-jc546s-large.jpg','Pharrell Williams - Happy (NEUS Remix)');
INSERT INTO `soundcloud` VALUES (17,'23',2,112846736,'tracks','2015-01-25 11:38:40','http://soundcloud.com/nguy-n-khoa-d/hey-brother-avicci-ft-dan','http://i1.sndcdn.com/artworks-000008530585-sdj0kk-large.jpg','Hey Brother - Avicci ft. Dan Tyminsk');
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

-- Dump completed on 2015-01-25 14:39:21
