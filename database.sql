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
INSERT INTO `sessions` VALUES ('38ovd76j122ss650or8thtabkkacvi6kjjiffmbmh3d6riii459vu9dmld0mhhspq4g0eid98sabqv60g9bb5ik23gdlsbr88eoc983','1422008491','n4XZ3OEda7ktHWrfk98olCnokf3fomNj+VikKUN6SvIKu2GO9jclIuVHPxgdW5zib7+TG/13g2pzBgM8AtFppLdZu1AzvoSRmcAaRRsWnH07MWohtCSAdQvl7RvvnL/wsS4UyP/H3R3WZm1EDqwBnoBKV6tIFu9a9+hfXBns7qGfFfUsTSDVz58M4pzkcVCEvWMbwrnhTlddBY7uZUUvi4833QkWKQsaoKmkXLnzL+tsDheh7GP6BRYKQmk/55KxirKnlUQBG9uwhsBUp9L5XTl9N7v2f3WNHvxoZr05uP5FiF7qdI3HiPFjttktOSes5AW00B2rs87BaIoJ3qtuy3ZJBkWyMlnAytekflcIlAj/9U0WLc7aB0S8HPxBQ/s7qTO5sRnu5fZvim42gJ26cjzQDlOOPn8vqQ9mpJkCkI2qBKxACeAEgbQ903d69T7+AAmsrzOx2POzY+Wri8SxOMolL0H+u67+bAvjL1i3s5LmNlqll4vUy+b3KraNTtb0','5f3c7afe2fba1281debe3f2509264b2cc7f950f5c956fb0c065da7aa6562d0a7adf6f801b47aaa58cc18afac56eea885f57e9d75f8d06095aaa24705188ab775');
INSERT INTO `sessions` VALUES ('4u18kfi7jamkcnunbgjor1doahn8f54j5qs5j7ulcgnq757btrjv4mrfjt6ems33326fo39bvft9h9frv7k46i5p8gdkf15l342hcn1','1420914700','uuUuhc/JO0U0Nts2k/IxdlzYIFuOZBpdhbpfkiyu8aA=','ec200ee276dbc67c053764ad691461edbff8d498918b776274726740c1c6e9ed8326b10871dbf101be13cd546fb2f53f5f0b2240cb801a06a36de67380874651');
INSERT INTO `sessions` VALUES ('62toa83sdunfrclj88l5s1hrmnkmsqccomsoh80e544k0ug5b9la0bpe2lphl62lm9o6ma0rcl4tad3tijbmsk0mm2dauuhbhfvmep0','1422025474','5HxLXv8h3jaO7+HSVIK6OHGytmWIxjrR6M/nHFZ5GMkydOdfq0Cybq2/vuZ/f0xb/DooHzzb/XBXTgdPllrXc+J/uU5ebIWhaPKe/hBKSTu5UwxZH9xx6vPWb/xX1YA7z6hOQlXIh5gQKG5o6bGqJf+JdIyVouFO2chHV4E5tuNY6IGKs793TEVfLIDyne9A2ZdE8E3JD/HMAdL7POmhP485CPRyQA8HoYBGQXbCkns+eSfyVtpUrHBQK0ejX1JMbGzeAq9QAgYdyNWB+K06oBBV8Bgyg08gpPeJZpUg/EHZM975ry+8qTawl4ruSai4S573Q8CADQWoj0+3fRj+87QSYuRRPfSImYgSUsnLkmY+Pqt5hVj32x6G6RupTHJZwPb5aO/frODlpDMJ7WEYAcUggq5YBd3sN+e9TlbWTBc4mwhWkFenGHik+jWCm6Q+V+teIZLPLv2+VedxGkEY4g==','0fa63c4bacfd5dd7b8bc0ab542959cae87eaf2c305c4bbda5b1d32960d247f62fb2a6a1a7d42489172ec78506632c884f54a9060448c7b06795b0809bf981af8');
INSERT INTO `sessions` VALUES ('9abf0q1um1lsg1lntc6l3iablo7orrcrgcjr601h8000429cc905irhu3o0bgln0rd3l4ei2cifrrt43ib4c2fgu62hfqlkhobv5o70','1421928163','+d8JSB+ZhKLjGJyoAxhTymwZjfeLYIYcMjvzxgsB19LU9RRVurEVJ3+fl3k6q5XezRtwOi/nSFDLaipSp5wSYiX22UU+i4+2wPmSZfABE95p/A1MwyWUTXCW5C9zRuXf3Tazj1kmOwJrbEr+M1t93InFOszgL3rBxXzq58rUA4SCNryMguU/js1v308Tb0xAIbGqxfJes7HL3sI/MDJpKj5Z6vZp8Hg5Ilebf+qaf9yXRiT1Qmifd0pK3l+Z7HMJqIziis3oDE84iMl58spe5qU8tt9ENxWkzjVfN6CxBO4i2PlSQvPzhqQpsOn2iVuqs09Mn9xaHRleT+AtKujRGwVSUYseAEwRyHF6Lug50mHbzUc70lT5GexjFcmUSkcjnsT/GpSnT+KVkgNoQ87MhDZwnGgQ1IOnyILNRkoQALBWsUhcL+Qpyv1aTkwAO+RGjmg2lMvqt65WVPyqtNvXlQ==','d9e040afb719a5a075b828b09bb5047176ca16e080d4aa4016a7c036e6b46f79dc76d1d1518973333b263e7a530f962912a9a10a6a6a28e5803fbb4f09338700');
INSERT INTO `sessions` VALUES ('9fsj63vns042vnhkl0t5qatrlnkhgplcdkuc2iuhadrl7e33mftvt3kk4jv48ejfkmimob70ds39rukut768d7t7v1oa2sfstrgq7k0','1420617047','/58yhxMPXNthcwtFy4vEzNVzPHOjXlU/ZNJG6YbRdLWcpucGmWc1ONz3TG8rr+kjmkL0NbGR9BTbfd8Ya2ecmh76SQdhY1SeAxzXBaDX7Vqut8EILxlP32y0fmGhJJ1YccRHn47wujHazbMUpK4tUXQ4dki5COAxQZPgA1U7ab43dvxTm+LiaFS/pEmc4zeN0Lq6UUER5w1h86Oe5w87MWKm1ZpZhXXwOfFTAMkMX8Gc118ntol4Imq7gDHWoWtMRjTB/0I0q0qt9iMWevElbnLC3/+6iSzpse93rQjLKYSqE6YnQ0A2k/e0R/VdmbfnCS8xbuKECx/hn1XhqQTvzoxhcpuxLHlpB4Ikr1/iz+IXwniDrYjOLp8RXX56gsA4P150LjfirTGJ/qCUyx/pF3DWIEBNEJjcAEJ9ZWvz7B4ZLPYP62+pZ28n84irvDZ/9k57Hvwi7XjQa73fJn/XrnZDdonKwvwxhEWegHYIpdYiI166BzOwYiCz1sxuQ9mVHwsytTWExYBZofjtKUxXsvhHZ3kYQNT5ap2blJ/Vl9P1b+2tyZ34XrknzJgOLFj3MwnCBXL6dn1XYXeNFDksMfbe2d5/fGPuxYz2gHGPvLoDF3GkkRtirQuMDqO42fDpJ3lrouzURfn21YmkdjTI3LCblE3B3VieSiUQuHn5kFM20di1FludOt3LDjxbEuTuLe2qfvMedb75XPsAMK38fk4UdTn+GMj/2jSbJ7EgQqC2uQzRlLd7vIbWOyupNtl+nPI6/EYYDEXKwAkwnYVXPEc1FpX0EaIrEaBccNTDYL9LH54jUKus0OtdGNLOfscBh/LjJyVqMitFPL8Krr2eo+OZIkwtH1rsmou/Oej1j3gWdKVVj6hUdRnbqKrM5iibq9uinAUEahSVga7lh7rtTO8pGEf5SVdqvL65doAEKWY3B5hPgwvjL6pupom45fcwvUu1o9ZSuChMtg/kI48JTZ8XwyQR7MrFElN5Eq9XFv6Ueps5hi/IiPee0l43NZVheYOj36VMeDZY5epItIa1Mto01hOuXdXsaloIFgRiHDTetcZak/k3vaMAz0D1feDp7jU23qLO6K9KGBj/QZ8lT0V++GAZWlnWod9YI7C3u8vFoRaNmCdxn2Zqv1LMSYGC8z1IxNHh4bfiPk/lBnc0hZgj+BM5LdCZVYuhJVwRXhk=','2d70bff32cf36a54a291beb6e357bc7d5a71a1ee0ce0dea842120c0505056acc54cc9946c9eabf0c43edacbee9f8ef44bb2dbb0e6d14dcf3ac57c8c231f310b6');
INSERT INTO `sessions` VALUES ('9ussmutv449nrenj4k4ocej1p6bcpomaipas2d5a8rolftclptu1kmh6gqbsctfqct1ipjgkvoegl95je3ld7oa1c100rik8p66sh00','1421161770','oIuYLpHsYdK4uqn70dmw4cYqYkuzLpqTZ67HZb0kM3cFh7LJHXW6mPie6EiYkMhfEoy2MGF8Xo4mdRX8gs3+6HhCve1I69CmpU1MJW3IlHddpTePCBjdaj0JzqCH7W7pk2JG/EqvEj0Ka0+hT3Gm4DNchwDgLNtCuXKCrtgfDuBVnWFOkX4cY1mEEpV/kftjXWKNaXeQcuwiSfp3F59mWkCoDfHNNQbrKfZyRAu8dYFucGLh3EqoFkBDrxXCGSR+L0dXW5vMswEyzUSIiTlAdpV4/ffQX3lZ/qHVjGlOtxDXPabY2XGHN7XXSelILcS+rYbG40RiezXds6PCX5cDoPCc4yMgJKXbpAOkwQgqthMZbjysTFUbyfkAXlokqSInzHAcpf6TsJ1/rahaxZeYbQYHmNF/gD+MyT/HSSE6U3MufAXJQtxOrn8WDvaoJLM6/47+P6wcsBpbFp7uIn6Qc5BG43i6R4xVHT/HqeL8K14H06SdBFHVan/2tU+RgkFXKemuVeR73sqbh7o0lFh/B8SehjZ3AvyyI96wRsDISFlxz5CzTRhkbCzo8+2fMRuAuWKhaPJQiKtqGX47CcTuQg==','647fc11079ee01e9f661383ab4d3ef9e9b795efb8b102329c934b95a02a597dcf503cc3ecd10c66e96a507f701590350f68e0ecc428a5fb62577538f2a3adeca');
INSERT INTO `sessions` VALUES ('b8gjahhk81vus4ltl1dbckvd1dej5gfbfdod83lbm329kar0ahf2ntkd7232t41ho192calhv58jfobibsk67lqvb80nfr4m7jpn2q0','1422008545','/oDs5y6bZuu9SdM1HiZm2UTvG95rR5Zj4aDuMRNJUFsCKSLpY/KJCqrxR+EHXM2MRCzVN3IjHHiqf0TW3bKw1Bc82cqEJ5jjmecjlcihg40QafbBCl0bFudiH3Uq15RBlJ5EX3AHyAubgxLxx+t9pZgcZz2P0K6nDZM9CY85++otaMpN1dN+mE0zPwNa2z+Tnftf9pQBhaAb3r/7UWwUnyH46q5+UED+/MPKC0Ln39mUGOgnk8XvB6FlcLOHmym14xSKJ8UrQBJJhZFFFWf5YczzFcA0hqNAocyLFYt/1ZMWzF4crT2Sn7zQD0KpMz5wzjTUV8+JVw30nK2p6dFbonAzhkLWs0x08puvLs3J4ndGUhn4CTCxnFLvZTayqo27doMtHFwPk2U+C9IFfWFAvpSB5eOn9ujz6PH4+zSsrdzpWFuAfQEgx26Zf5sEdjNAUPYBh0GdlHhEcCjPX16QEg==','1b92e6b75d28eecacb88510e1d7cd698be3f4fc697c2fb4955e940c04790cd017caa600db535e3dc474e4ee9fa8243ea5557bf3ad0d8b81a9964e43e55d93b2b');
INSERT INTO `sessions` VALUES ('bpb5kg7p3affh0nfppt1g3ah0giap56dgvr30q542m7frk4er350qh1qc5as5bsgqk65f13pqtc14bnqu2903tdasu0kh1p6h7ok100','1420792807','wjVG7s4wVF11nwqKjjzNEoGlHYaarWYqT5M970KUJP+fsYiEdCVddAXbJNuHZYvCuCy7Oxsdsijig166e8eFW5AeskbpHwwqD8Wp2bFw11XivHuRCS3SSMA+qz5AThcjg3F5cAcMZ0J1Rzt+chsNAIUs2T1C3/LmLRFOXju7tvyncsKsJojTiwN96fIt78JdQlI88MbTXe7SydLokO/BM3YlFyjVoxTxVKorhol1wgNSSKG93Gu9jYYvItMwC5iCwd11vCHXucadODSwNSN83M4YcZZ124EFxR6ptcu2o9lZJliUpulq2LqfY7ne0ogaVa/pAg44AKcMpeq1uJYuBdCe2dbJX4oVCV4EglgLHUGBAJzaEfoXhD/jEprFyCISumnFGFfpzRiFQCddAjJvCpiv6fK9/p050EDjbaCoT36doF1zQZncZNPQCo8e4R79fUKhMzYCvvYxJneWHjw9Rw==','96f5f5a351c360c1ee9ce0a9ef454c77f64366444446cab233b05a69966fcc3ba9cef1b45827494852f9bd83b91f3cf3e53a58cbcc9dfab65609cf0b756a9ee6');
INSERT INTO `sessions` VALUES ('ego3bf90557e106lihvp2cc6364me2lrs10982qcrb36e402qc7o2jcp7lg93moc1v4rrlemo3lc7cmktk4uf40d1kb62vokfsqtnl3','1421928140','EHjPGRlkTHFN5EVvliKPgSbmRmRoMr4Hy6qhjTqdcQMOyOO9gczYj8JVJS3CtZwCW5fnpjDO11btbKHw2Fwsdkc2rVEoOi2qweMcQkQnLsfsKrlyg7M2B5df2ZUrMkhu2B1DrRXyklg4T+sWdc5sfrOE4tRDYfduR+JO40H4TW3p8tQqV9BSSklIfOCUvQAV7O3eh1cI09ciaI/1CgjPgDeMHKnlTiZeUnIol+WRHw/0IcIcdjsLlo5fyqbZorD5Vpvg93njKgtIibnR6GCKbX0CHg40pqLjSyaZP9xLo9kve9mRYv6vF2sBiAzbsxZPcybt+VIuaooEfoVsvOomHUZPIlSUfzpjzz4+tLU7B2tpFmuQ3eopa94bY6PMXBOgod2RrS8aEyPXAuf+HSnn1pPpgKxBaQKQ5z6oM9B2V+NNSfNsBiE2wohdSXpFsIGl3KD6aONGKhzaAB6P6wTzjw==','8734200b04c23840d3c4d36b6baf706023e8c443f255f79a80222704780efdf3441fb5ae3221f80ce2f8278a2d586130e50c6e31ac7f8a1f40a97b8a453a1d62');
INSERT INTO `sessions` VALUES ('hsbvu1ck7kq4c5rsft3fvi3b27p4efrburt51lv19vhq139p66q565cl5845cd96e08jj5i9shn012h1r3rejjvbrq9hl5it42f0ej1','1420978589','wDxGUsYByygY1uiFl5cqw/J/S5UH09VxdcrCSQeZWGR1cYisKgtwzuvAhy7z0813jahiiY9AB+jvTjoOdz8d5SDmI8DqAdorx+Pgjk1xsbtVDWdPUOhYL7D2WPGWj0SIH2DizDeHvxkwyIuf3AIzb8LNEnknuRi1V3Zk0sZpbjJuQoSPWzdyJx7sIpjsvkSyBkPHt0rsxo5UKSZUj18U3HHMGaBmcjHIlBAUKpVB+QTNPBGow6kR4/wpfAKha89ffhAdbRkNtU3mUhnSwd/uD1Zb9bbLq8ZqdjIxIknQzrQnY2yQ90dxEc5TdjiVuaakDUz9hexwJPych5fJBDLCDCp/QLsTZ1IWzv4WfZ4Il7dvA+6qwxyO1gMuYSkJMLYblxA8q0ZPlPp29XY8IQQcxVpnhSzifSwdk4KTbAm8/iDF9rIW++OE2Z8Q0fCXeDOFoEDLNbUCYIVk8hWjdJfALw==','42fd294c4d1aa9e9f0db191f541fd4c6b366afdf77f7a1dd90c0b53723799596d74c12360d247b261d1d6f09391fc212f0e6399e519cb5ac543aaa5258ea18f8');
INSERT INTO `sessions` VALUES ('i9tieqghvdc9arjldbuvep343nl5sokkv9cjfn4ca66r5tl0n43s8nsco0o6bpbv52l94f53b0ft070njt64fac3g4dns72c7a3ju51','1421234854','XhJcWuRKUMACDEm8GzgqFkBYWjC7LKeOw6Nfjxh6eijIYqM9KUgAJurMvwffszNlDe1wAJO4iarQlIPQpeu2X8F5agDKDJ/AvL4X47J35Q26n16H2Q3AL6kCt0VPIBz0N0UgZJbQXH1Mg7ROwj3gRQ7hB0KW3uSyd1srL+kkkzaCmXoik65yd8DsGIlHlVb+IB+GwabGXfddOzKRj3S0rHgXhSeqmnCrXGya1e4+sdhINnGyW4xMQWXsXstLt/TA1Xyp+pTs3pm5X4BdB+oMh7AVPCHLCXdyNev8yNjZsN7heQOxHUVK+VSZoH70u+3GNNU9Yr1NddWAAbT+vxcthjJKc2GlPgYxAf8GOKur/ZWKaDb2ueqItt/IBexmqhNh','5e65743208dc14ad99d1c6ef9594e83b2cf8ee19bd1183b05d40c1d58ae2c2b4bbe560f590788502f249fc02942b7b4302dfcc596368458e880165083fb7b2f1');
INSERT INTO `sessions` VALUES ('igftdrr54dld3iqg0fep81a85qfb7hblp0i7diiakhan4dpqr6rhiuk7vrn17rnjeg655qkjbjs6tnvp5cm8jlbfoq8g5f2d04c5kr1','1421928150','xQQaV7BMrKDm7sWO0EvYiOwahrfMtH1YWURiWfH+AhjG5lcUKTgCylzLVSWSoi7g+qjH7kDKCPyMxM8clfyGWuB51Xx5bEudkLouTcr7ztli/73x2gmdpUptEFKn8pEqwq311f6KMM7MvOyZtEIdlfrajm9smKwZR1upE45Tuu3mv5zX0bMUl8mE+/TsDrxnZnwzjv7O8EeYuTrDS17FEogAXO9ZKgA/6XJ2IX0J/l4+WBZXsFhmR/CIPzZAIMoI96EU4796goBOO9SsILrmGNTMv99bG+w96IDOvhrzGeEWG5OXpKwCYdqU1cJRbmz0GSremeeuWBdnSBWSOC152pcuIgVbOHoLeZkmHOehMI0MnwJNb4hVQrl7Sz0aU/Yq7HmGpO2QrpPIztFRvOGH6ouyklezMUF9gwBzxLyiZZ8rTnayHVk83QxzT3+0BeK9m19L2JI7b8H/iegj5HMU/mBa46iRwVFZS66qOQyIsgWyCcDWq1MAzrd/NI97Yxzc','53a944e0de343c1ec84ebf040447a8e943b241b530fb9cf11d04eb439da848a93bed60146b882b27afd6a17eac131f26700d5a9b0eff880a4eb01a93c88ab420');
INSERT INTO `sessions` VALUES ('l3hcfeqjs9bpki7qi11qfj1v205u93rhh2hqfak22la6gicojc7iv5bpkhvuaqniucddg43eaj4an5v9jp9j8lhdutbionjt446a9n3','1420552956','heoTf2nZcLOSeAEPa5GvIB6Pr2Oo1KEHEeHfbBA7an8aCDrkq0KPP2i19djzk+TTz2Schray04IUaUWYXBf7eeZfnVmiLNgLFgFQUALsruk6MfUuQDGQzqP5X0HSmADAbeCjGpt83tIqsbwcWG3G4XJPNKKWs90AAMOc7fkvxsYgFJGBn9jUx2g2zF/GfjacIdDPuMsvBcbZo6n5nDcpAZq75lijIp8GwUrGfgKuo1FzRQ3GZObqpa+OB1Xdjr5pRLWuzcwt3cl/Up5eijY3D3I337/7HXL9td+K5VeQmlgktTSeG0IVMJosLlQRtooXJ6VTBwgTrNQMYphCbywVPcjQK+yZIA+EZhwQftwhkIlYV3oEjAtJWvhuBYXI1eBeBUxxYVZn1pitB5t8jbIxlo/JT2T5n+Fx7pwxHw6zfXMg9KozPR3QSRckFY6TgojkBWlG6P8wYttLp9850CFNY9Fj6dKJ5npCMcz51kyzy2CjFc/0jBvU4yHI5PJ1pnnzCe7kpnFChj25+MG4NX7eOKtkLa/tf6lNiTUHVlbOIVHd1oXHs5W4CbQVtRteajeg1qE777Ze1fOCQI5NYSuEFnRe5rgruGUJq6AOxvfw0DlGUVr01MaL2gGwUvmHIaQugx0MAENKryI+/RtIJeIoHeCzGRV5lswDwZNUN3I8n5PNQ02Mwxl61veIpUJC3+gfJR2tnZlrP53RNHJeaFSS70hBfmDZ9ajknlADINrKPEB6277JYtcqJAdLH0avUOvqJk1YF6gY0bBIGRX0/vSylg03sOEVJEwWIErZ9UAcpUkD0Qs78gukWPERsr49G7iP6zPDpLODW3h5i5iYh+vOdxKmZNUB/jybm3JBLippEQ1VqW/iXdn4Yhip56WEt/o8ipqwMDaFBgwrwLWcK5HjMRGD//M+EI7f5L7DmZkQn2aXThVoymM5pKNdlWddkG7F/9N4X36wXNf/H10cHTtxHOhFNv0W1tgsUvCdnInaX/NAVUnHawhW+t+hdFMSXChCjTFL3dzml4S/O4fSZiQD2eSNl5j6U7Hdvt7J62VGZu2ZTelUR6fc8cqOGaeKWs8HVvcN4TDZh/NT+FIQ6CxLt333WYgMgS56Zquax6A/99mb/4lf9O0cIl1YXQQCxCyISwGM/koRqxehhPRZjEpYwkg9GPEQ7nzxltdxGIYtL7w7g0woKrpFSuakfND24I7yj17SMVH/lFC+IgJqQ96MpQp1PrIaCkMyQnN8CYPFo/2CdELBksri8dqzGBi04n+d','51dd4149d0911e7902efa405fdf3b394d69bf575c656ca7abc79dbfd61cbb95adb6948211fe25e9c0e2b5476871626287d0ffb2ace6478bb353c0451d61fa4a7');
INSERT INTO `sessions` VALUES ('lttl31sjnrh8kskh442chj0nu89ujg4dlc2j93ri1h4i54dnrf4636p3grnc00bl6ruofbi2t3gobfljopgaus06ucnne0siaq4rrn1','1420575444','zMb7tdEGNkXbTFy6C9LVm+8Su+leUFds9/wv9yHxkGwU5iQNlfVZSR4JEb/ZXacNDpqc+jwc/ARNKLM4jAMHbkD+w6EfBgvXdh1EJt1IXqkOK+fD3Dba3soWH7esHlNBDpwcC6cFLWrsm+Px2EoyHzazO1yV5FlgoDI3xAOtgQOMRv2k+NE5+M/FpeMrZ0SKCt1lt9+iFcAXCT6h9vkxHzroWCKRmGjTQsGesmG3uD2t/9uM2nTUp4rVzikZ41+GJzGwoKhrCMT1zIK7mlvYDez5Lo+3WZqTCoRgGt+HmWLo/t5rx4ChMm30WwA6XZ9twx+vS7X4N7zVBQxDvIShTLxQqG32kbJUyCxdKozX/Cea9uwpWmldPb2gxqDKuDKUtBDXRzRcq3FOlB4quErMVaHqeBPkvjBny8hslEJtLbuWlvZam9YspvsmoC1nhyzyhQ8qALsk7u6HnyHfVm/azzvIRdPhjT7idD6eRWmesee/jVJUF4yMvC/5ctYMFZXN','a3845e47a011b0f46067f26bad1176e04af5d58fd33141d88d397eeb5128aa0304c7aafaae589e797efdefebd9f9c767c5ffff286449952e51755bdc9721f040');
INSERT INTO `sessions` VALUES ('uj222tgofmg80v32vajr7p4c3ig61soj6m889kodldlg4nvg0smus4kn1860rqa2s1nfg98260nsl9u134gj73uanejoc2dom3sabn1','1421923219','FcPupveejCx+T26PK8LLFcGqH78S5T8THhezTQCOkekFHgOu/Os05LF5oFHrTB9sbpm9WAW3ShYM1z/ofalHB1stYRxdwOTr5XdbWETTl7Ic8Zjyuyn/GOnrgH0PxUyBo4Z/Bxsp35ZASNQ9bRoVVRRCc2WuMggX2Iryj68at/t4vHMbvYaq1A8sPLC7BtngDaSth8sWvVyHxJ+dc+SvsDt+8Jp3MH73e6nv2+Ri4N28dswEnZoQLIRDo7tswplwBMQbfC0RRRqkkPswobu0l37O9Qco4PUhkYiRorU5JvKqzUUfT1z1Ik0NwKCqRiYvgvz8853/ttzN8r+RQImQGEe8yR6RpBDi70YGuZ0YcKy9+8vOwmVxabhMNw6Bae8iDCkrHSyVgKyEB+MKMj9RRRfs0KoBC8lx2/33Tr1KpgdGhWzn8grFAuZR/tv78sohbcXfa2i3qAA4/Qm89GTejA==','5f1384906a19d22ac01eb9a896a467cfc5b628e976d9a9eec72788b0d01b39d5bc7f18e0906208bff4396f55e8ea710978e44afe088f2fa1cc1c57e508c4f550');
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

-- Dump completed on 2015-01-23 16:07:58
