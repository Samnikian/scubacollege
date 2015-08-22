-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 18 aug 2015 om 16:21
-- Serverversie: 5.6.17
-- PHP-versie: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `scubacollege`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `kalender`
--

CREATE TABLE IF NOT EXISTS `kalender` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `begin` varchar(150) NOT NULL,
  `einde` varchar(150) NOT NULL,
  `omschrijving` text NOT NULL,
  `titel` varchar(150) NOT NULL,
  `locatie` varchar(150) NOT NULL,
  `fblink` varchar(250) NOT NULL,
  `heledag` varchar(5) NOT NULL,
  `minniveau` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `minniveau` (`minniveau`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Gegevens worden geëxporteerd voor tabel `kalender`
--

INSERT INTO `kalender` (`id`, `begin`, `einde`, `omschrijving`, `titel`, `locatie`, `fblink`, `heledag`, `minniveau`) VALUES
(1, '1432764000', '1432764000', 'Dit is een [u]test[/u] omschrijving', 'Dit is een test evenement', 'Nekkerpool', '', '', 0),
(3, '1435183200', '1435183200', 'Dit is nogmaals een test', 'Klein testje', 'Mortelmans Computing, Mechelseweg, Kapelle-op-den-Bos, BelgiÃ«', 'https://www.facebook.com/events/1448283488824627/', '', 3),
(5, '1435183200', '1435183200', 'Dit is nogmaals een test', 'Klein testje', 'De Nekker, Mechelen', 'https://www.facebook.com/events/1448283488824627/', '', 3),
(6, '1436997600', '1436997600', 'Omschrijving blablabla', 'Test titel', 'Provinciaal Sport & Recreatiecentrum, Nekkerspoel-Borcht, Mechelen, BelgiÃ«', '', '', 0),
(7, '1440453600', '1440453600', 'Dit is een test evenement', 'Test evenement', 'Put van Ekeren, Ekersedijk, Antwerpen, BelgiÃ«', '', '', 9);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
