-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 18 aug 2015 om 16:24
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `nieuws`
--

CREATE TABLE IF NOT EXISTS `nieuws` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `titel` varchar(150) NOT NULL,
  `tekst` text NOT NULL,
  `foto` varchar(150) NOT NULL,
  `aangemaakt_door` int(5) NOT NULL,
  `aangemaakt` varchar(10) NOT NULL,
  `gewijzigd` varchar(10) NOT NULL,
  `prioriteit` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `titel` (`titel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `opleidingen`
--

CREATE TABLE IF NOT EXISTS `opleidingen` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `naam` varchar(250) NOT NULL,
  `afkorting` varchar(50) NOT NULL,
  `omschrijving` text NOT NULL,
  `minniveau` int(5) DEFAULT NULL,
  `prijs` varchar(10) NOT NULL,
  `sessies_zwembad` int(3) NOT NULL,
  `sessies_buiten` int(3) NOT NULL,
  `sessies_theorie` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `minniveau` (`minniveau`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `opleidingen`
--
ALTER TABLE `opleidingen`
  ADD CONSTRAINT `MinNivOpleiding` FOREIGN KEY (`minniveau`) REFERENCES `opleidingen` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
