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
  `fbid` varchar(128) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (1,'NickBraat','nickbraat@planet.nl','8f7a2fea4f7195c0cf2a264fe7a82e855e078b99040614a1694de23f8764c3399c434b225a8d33f9dce221bf2817780c9eabac5896970f8868e8bac14e2d93cd','dae98046f4f2665ebcd52d5a29d6e04bbe71e7549395a0f329cfe8138360dabe3e31877bb33fe266151b6427292a11e109fc1534c959d45e727dc384626e8caf','0');
INSERT INTO `members` VALUES (2,'Peter','p.j.s.d.kok@gmail.com','589a2e3178a0005993fe7ffdb4015140444a62ba43044ff90b60172fb388470e3573f1a97b559a47af6c59237cd0de8b31155939824cb6e91c977e406ccdef29','e8783656aa34ccdcae48866b8a7d15e8722c682a99d7f390b1b4c02e2d33650998cdb844275a879e68898ddc2ee1c03bdf5c67f58090edcc461cbc44ca1ea448','837289849647805');
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
INSERT INTO `sessions` VALUES ('5dp5h2icid22nvtbmbr191mrmov9hn3c64te40f2hn07frtrmjqf4i3ovf4b54170ts80k0plv9rgnpr5ii0c3bvbv5t10e6dcknjl1','1418492146','GnrktiTPZeBBWdzZEPV1s9bZO1bsFMXl8J7J7Jw9m0Y=','a0e3a984fe6187334c0e76dfa16f8fe1c77d9b7b55fdba174d2e036138667891d0b7ed845568d6db95bfa698a006bf15adf36131f8d39fb9f61c5a543b1d7a98');
INSERT INTO `sessions` VALUES ('cd2jrv1isag92k460r3iv3aspf9g0rb2f4d2ts2iieb8iprd0qd2b3hd25doqfa6o4o0nkas6ifiklqk80j861l4a9doa6v6257c073','1418491673','Y84ECs+olzE0jZuYVCAQHhGUnIVLLnZRwZEGyyxXaUw=','8262465b17063016e85558a2f0fea0e6a4c07f76b10a35158ae681e2c5fe6b5c0d87d91a8dea3a87ae1b2fdcb5a0269ac8810be684e428aa7f0df928194e0ea9');
INSERT INTO `sessions` VALUES ('hm9dgsuhfrkm210vp1no4kq2asgh7c5gp1504034el5f1ogv1n9k1of4vmuqajasmeprhk3qaek79a2fdsqqdm4ia30r1a5gennhk40','1419025745','VjRsEYgnVc1vi/lZPLgiy/BDiDEgzHESs/pLZtnWz+k=','b0339736a55238da51c7bf461bfbec21711560d7f255f219c076d9f3725f5b6dda09b3e70abac195d8a376771a5d397d52473faf2b1116b3e9d96ac2eabb67b4');
INSERT INTO `sessions` VALUES ('sb2lb4g9jd4r8q37mmm8upvi1bgcuufvlila6fdmkja09fsevooqangksnbs2t7akl4ob3mtksncndpoq44531vt3t6pirdbflse020','1420284447','WvQNJFpca8MnotJRM+GEgUknP6HB7thfZEZo4wdJWL6QVEULsClD7a/qW6uKx2Ul1g9L9x4TJ2choZBMLapg+SqttYwr9jKrKXgIuHTJXzGuhZyGQhZ969DRCbm2eGP3xdaejFj8kBSX7UBshg6gKmYrOtDx4eULSHzT/Mnf5r9tm6ic//7e9jHS7nrhU6K0/RFHwvCx0PLxb5QFjcGsmrZTh4es0czyxMVmW4COeze1qM3GQhHdU1DANC2MTmO8hawnY+6qARR2vnSeuJiVkvmGQVbF0rlWMZXcwdqeVv63Sj9hxXqlMAUO6ZFihocLG/MNH880WxSxo3rd24dbINaO4MP5+tLgaZa/7w15NAQjetmfkPGTVlAPi8TacpeL1P0Ip45BDdEDXgszgdYrG3eLGX/jLCdPCAltRYUJHS3qD0wyS2ZW+aIaYoGwxGgLPi0uxSPNqumm2zD8HdBy7VJARE+ru1lPvapBaU/u+xSFXK0NLnSrcf7zxrJRjTtSCTeXwvKbNYykbevplBP0Hfb5iEubTB4MwioeB1bLvq4bLtQVLCoTtFeSrE5uFDVnEsIyvOZX3sRbrF205BfP0/aNSOsDPzQEwQzUbvr0PLafCnQhxm4KY8G0MMgu7HBO4tuTa+kJngKaHe6IkHsnXLc8A6WHy/Tj2YnAbCgXaH/Hhzj+FfoqsVwzCVubT7JWIX8fqdgjsm7oJO+Ygx6iJ6Vf1qTnswdNehlgQF7n7/T5RY2NfUiv64v+kzuAJeCdlxZIcGNbel6azXm0xHBRNhFkogUaUXAufn7HMpbMzBk=','3d629678b7d43ac059fe426f561ab920c8e73b8fe6ce097a3b6e9338fb8387e948346ca45e6bd90f7cef41edfbde82392aead064e79c7700a5841baf84b4b492');
INSERT INTO `sessions` VALUES ('tun60k1890c9h45h9id5tp8gr40qt6u53be6h1c08vpl9t87cpvilanhipp8b6cu6i4km8guldj7qi93eb3v5cogia14bb5cf179po1','1420205104','6pIhSK4Z9al6OwZ5t0RKtSS1J2lGtMDCKpJPRy6ygDith7dUeRnhFwRlWp43ri3ThO63MQT3aAsiCmQ0uixdv9r2MgqcE38FOr0y4lPsLfrzy0g4e7FcAR3k8dIqgb1t8AxYmDPuIr65yXon+VtWz8gMwewYezT9eoU6ctwqWEbJjanwF1Bi3AGe3f+TI5sPaiBcqvER1bcrhVHgW8uyIgriiqHS0tGKB2p+qPtVRf9RKZpu25Hh1sciCR/WKNrnSJhakwKi9aEiats8wKUi6mohCRcBdiI3xJyH9x2/XStyIgBKHJnL30M1ntnup6himX8PF4Y3L320YiW3sWkBp7Qzv1zS9bS4qdMz5wfZ0diJSUQJuHaDd8z6pNfhh9YwYf1DpNqaOP1dObP6OTu0zlfoWD45pXZDeqrlrQXQtx2AzwPAtgu4MajHS2gWlhddkbhpYVbar4sILQ1mcyTW6WLRQXuayoBc6YZKInsh5fHR989o4ndydNfJDTq1NC+w8BxEldX8oZumrTJCFfbOYsaqPV9pnM5GBgciSwUAfy6T3y2d+7ry4fZoqI5OK1VTf9umk8Bm4kdenXz7ciFyqZFIZEybsXJiE29QZvENYe4UzhSa4qN6xzMpQltO3z1dlteqdgjJF+iv4aDvQQyJXC8s3lb0FLAV4S1eHrPLVy9cK2Df3a6Z4ucS5DnmoVlU+AdaO+obfyd+6lEloe/QPA+nSA+NLm1G//oFPL+OiTl1vDQuMPmxxE6iIeVBMNivOfM69BDot0PVWkB6nyP9d4jBA5m3MfjzRu6YlzEVu/1IFoH7wOJ8fnnXuiyoNx1LPyZwz7hVBiYVrYPWXN6K5SBM7Ns1P53/stCQxzXCn2VXojZxr/Ca9qrIBRKfb++p/X38uKwl7RhQ3/bA5L7vxw1f2H4yRUr2TzpWXzt2fPs=','ee0fd677c1b74e17220973b6e11206465ba3d7c48f415b65621832f852c12edd27547009a494c1affe96639b8edddd815cd9f7817de68144a7fea5e87b03765f');
INSERT INTO `sessions` VALUES ('ubek50u0i5qq388hcgbhfr96jpafehqbk8of59m14rc9plm0u8n4bthbpe4968qh18hhgk3kitr96jao6g7rm65hn2sumqnca149c42','1418916799','2L8U6+3TsceEIf6XCaTBfcXZ56ehEVvs0tnQQFkN9W+nzVNz1OJr2U7m0vlVXHO0xgaEawq7EsbrPRJc4nvUR/yHPhu7CtBL62HTQeawtjteCim/eLvBojp27nmAYqRDkd8SkNyqCj6YEo00m0LTOzzyjNJaA0nSk0QJCwDm+My+nqEf1LiXph/VdV+ELJirKJ/673im36z72uYwh6uhk9IOWf6a+8EfSGIn+ziEuQt7hLrYiUI9pR+wgachRN/B','d2fc59fbefeb0d772cea4c91e64cd2cc444f88bd8152ed7e35dd12c0e00356e42009546f52252bdd7c4dd531b506b91a92e91c61153bd7dd8c88e921182da72a');
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

-- Dump completed on 2015-01-03 12:29:08
