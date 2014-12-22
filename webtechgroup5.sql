-- phpMyAdmin SQL Dump
-- version 4.3.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 22, 2014 at 06:12 PM
-- Server version: 5.6.22
-- PHP Version: 5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `webtechgroup5`
--

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `user_id` int(11) NOT NULL,
  `time` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`user_id`, `time`) VALUES
(1, '1417979556'),
(1, '1417980530'),
(1, '1417981152'),
(1, '1417981252'),
(1, '1417979556'),
(1, '1417980530'),
(1, '1417981152'),
(1, '1417981252'),
(3, '1419255380');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(128) NOT NULL,
  `salt` char(128) NOT NULL,
  `fbid` varchar(128) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `username`, `email`, `password`, `salt`, `fbid`) VALUES
(1, 'NickBraat', 'nickbraat@planet.nl', '8f7a2fea4f7195c0cf2a264fe7a82e855e078b99040614a1694de23f8764c3399c434b225a8d33f9dce221bf2817780c9eabac5896970f8868e8bac14e2d93cd', 'dae98046f4f2665ebcd52d5a29d6e04bbe71e7549395a0f329cfe8138360dabe3e31877bb33fe266151b6427292a11e109fc1534c959d45e727dc384626e8caf', '10205602670490304'),
(2, 'Peter', 'p.j.s.d.kok@gmail.com', '589a2e3178a0005993fe7ffdb4015140444a62ba43044ff90b60172fb388470e3573f1a97b559a47af6c59237cd0de8b31155939824cb6e91c977e406ccdef29', 'e8783656aa34ccdcae48866b8a7d15e8722c682a99d7f390b1b4c02e2d33650998cdb844275a879e68898ddc2ee1c03bdf5c67f58090edcc461cbc44ca1ea448', '0');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` char(128) NOT NULL,
  `set_time` char(10) NOT NULL,
  `data` text NOT NULL,
  `session_key` char(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `set_time`, `data`, `session_key`) VALUES
('0jg6ubugsdvko7d3gopceup9npvg2v7mf49eqcovkqompoja3ulmpn7n4eu37jee0g01ovjoc6nihp204v5mg8197hdq4anbq1ko282', '1419267993', '5tGhJNyhs+ddebLPPoxM0wQX6dDr5OCRfdVKL9EDYatGNBOVuKIxjzeVZgvTWkmQ40uP5BtkGVRMFqK1NjEHZaoEnWzrE1SOGYsThSygnpk6NzTnnZXUuLr2fyL0plFabMymLhmFDlYpl9liV8eLQRjVf6HAY4K3tmISCDfkaLr9ANHG3gUVYTdsowRI/Wak6E3JX1PkWeuxFuOopTCQVayZd+LVPynnD73bUu2AlJrZ0bjOVAilgN5iWZPVX58R77LMIuznZyNZe1n9+m+0OHzIgWigYn9hevc/xtcllguF2sljyGv9GPxQ/Iovm03/bdUsi/KBv8B1L/VmqhZzbUTneYHEGisj1PCaQ47CW8ePFDuN8CVIQ002EvfwNodqqiDMQXaRESspA3zW1Gso/kqE6yOiaIx2Ncz5amtYcQWMivjUfTzXekgQ55vU+qWleM7cWZOZwcLC9ywYMo1ThZD/bbHcDrYlURZQgutFDvy/U0gs4hDPOiKn/NyOcILd5OY59allcjZfT0m+lb7xdPK5n44wVisoF8V3lO2QDj1I8IuwHyI9D2NWzcAvCHoOB3Xbo53wjIliFvbIcpruJnNWBtZ1eaM/Cl6rpBXWbukraFBdznHltAdb9ohh+TL0cxCd2COafXvOlkT6RXtYK95GbBQkFoKztkm0Lyd/Ko0m0uQnIylom2Mc+/UHp+biiP+jOIcxKpXCRlb7SP8gMfy4cvgkeyJAzRwcHHpgKTIYGwtnDaXz3NFzQYYLM0ht5zUlEpz0k/U63che2nn/Ni4f5soOKIa+q3VWMN5lNWpr58r7F+KO0X3KAeUx9Awd2Zcwq1TMV/M2j1/z1K7nlkaz76Vkzjlg/HC0nKRxjZRKGaZoy6qvGQ0y59vdYPI4JypCUxcp6PzNbFOVcsNtyCttbThZnHGO/2DMCQw5wGMu2/i2nCSC19netkVD7A1/UCLfVowBEoOkQDVEBg4nIQ9kS5MwVoBig3ihhTcsv93YwW2cSbxrwTX6Fz1BeGm8', 'b5fa13fc2b8fd0156d350c691abe736e4ff371169c7cf9d64c6d346e149bafde01eefdc51b41c4c2ce65cd49b83fab099f8efb5009f685dcaf642e89e8d803e7');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
