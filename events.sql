-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 08 jan 2015 om 14:24
-- Serverversie: 5.6.13
-- PHP-versie: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `webtechgroup5`
--
CREATE DATABASE IF NOT EXISTS `webtechgroup5` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `webtechgroup5`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `attendees`
--

CREATE TABLE IF NOT EXISTS `attendees` (
  `event_id` int(11) NOT NULL,
  `creator_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden uitgevoerd voor tabel `attendees`
--

INSERT INTO `attendees` (`event_id`, `creator_id`) VALUES
(14, 1),
(14, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `creator_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `start` datetime NOT NULL,
  `duration` int(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `pic_url` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Gegevens worden uitgevoerd voor tabel `events`
--

INSERT INTO `events` (`id`, `creator_id`, `name`, `description`, `start`, `duration`, `location`, `pic_url`) VALUES
(1, 1, 'Test Event 2.0', 'Description', '2015-12-31 23:59:00', 2, 'Eindhoven', 'none'),
(2, 1, 'Test Event 3.0', 'Description test 2', '2015-01-24 21:00:00', 360, 'Breda', 'none'),
(3, 1, 'Feestje', 'Feestje', '2015-08-17 20:30:00', 240, 'Rucphen', 'none'),
(11, 1, 'Event 4.0', 'Description', '2015-01-14 21:00:00', 300, 'Best', 'none'),
(12, 1, 'Event 5.00', 'Omschrijving', '2015-01-14 20:10:00', 305, 'Beste', 'none'),
(14, 3, 'Test Event Cas', 'Description Cas', '2015-01-23 00:02:00', 340, 'Eindhoven Cas', 'none');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
