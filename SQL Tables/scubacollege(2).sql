-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 18 aug 2015 om 16:41
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
-- Tabelstructuur voor tabel `cursussen`
--

CREATE TABLE IF NOT EXISTS `cursussen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `leerling` int(11) DEFAULT NULL,
  `cursus` int(11) DEFAULT NULL,
  `betaald` varchar(25) DEFAULT NULL,
  `medischformulier` varchar(25) DEFAULT NULL,
  `sessies_zwembad_gedaan` int(11) DEFAULT NULL,
  `sessies_buiten_gedaan` int(11) DEFAULT NULL,
  `sessies_theorie_gedaan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `leerling` (`leerling`),
  KEY `cursus` (`cursus`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `kalender`
--

CREATE TABLE IF NOT EXISTS `kalender` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `begin` varchar(150) DEFAULT NULL,
  `einde` varchar(150) DEFAULT NULL,
  `Omschrijving` mediumtext,
  `titel` varchar(150) DEFAULT NULL,
  `locatie` varchar(150) DEFAULT NULL,
  `fblink` varchar(250) DEFAULT NULL,
  `heledag` varchar(5) DEFAULT NULL,
  `minniveau` int(5) DEFAULT NULL,
  `kostprijs` decimal(10,0) DEFAULT NULL,
  `aangemaakt_door` int(5) DEFAULT NULL,
  `gewijzigd_door` int(5) DEFAULT NULL,
  `aangemaakt` varchar(10) DEFAULT NULL,
  `gewijzigd` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `minniveau` (`minniveau`),
  KEY `aangemaakt_door` (`aangemaakt_door`),
  KEY `gewijzigd_door` (`gewijzigd_door`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `leden`
--

CREATE TABLE IF NOT EXISTS `leden` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `lidnr` int(10) DEFAULT NULL,
  `adres` varchar(250) DEFAULT NULL,
  `opleidingen` int(11) DEFAULT NULL,
  `naam` int(11) DEFAULT NULL,
  `voornaam` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `lidnr_2` (`lidnr`),
  KEY `lidnr` (`lidnr`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `lessen`
--

CREATE TABLE IF NOT EXISTS `lessen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesgever` int(11) DEFAULT NULL,
  `leerling` int(11) DEFAULT NULL,
  `cursus` int(11) DEFAULT NULL,
  `soort` int(11) DEFAULT NULL,
  `soort_nummer` int(11) DEFAULT NULL,
  `wanneer` varchar(150) DEFAULT NULL,
  `waar` int(11) DEFAULT NULL,
  `opmerkingen` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lesgever` (`lesgever`),
  KEY `leerling` (`leerling`),
  KEY `cursus` (`cursus`),
  KEY `waar` (`waar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `locaties`
--

CREATE TABLE IF NOT EXISTS `locaties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(250) DEFAULT NULL,
  `locatie` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `email` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `last_login_time` varchar(150) DEFAULT NULL,
  `reset_hash` varchar(250) DEFAULT NULL,
  `reset_time` varchar(150) DEFAULT NULL,
  `reset_email` varchar(250) DEFAULT NULL,
  `last_login_ip` varchar(20) DEFAULT NULL,
  `aantal_pogingen` int(11) DEFAULT NULL,
  `lidnr` int(10) DEFAULT NULL,
  `activatie_hash` varchar(250) DEFAULT NULL,
  UNIQUE KEY `id` (`id`,`lidnr`),
  KEY `lidnr` (`lidnr`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `nieuws`
--

CREATE TABLE IF NOT EXISTS `nieuws` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `titel` varchar(150) DEFAULT NULL,
  `tekst` mediumtext,
  `foto` varchar(150) DEFAULT NULL,
  `aangemaakt_door` int(5) DEFAULT NULL,
  `aangemaakt` varchar(10) DEFAULT NULL,
  `gewijzigd` varchar(10) DEFAULT NULL,
  `gewijzigd_door` int(5) DEFAULT NULL,
  `prioriteit` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `aangemaakt_door` (`aangemaakt_door`),
  KEY `gewijzigd_door` (`gewijzigd_door`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `opleidingen`
--

CREATE TABLE IF NOT EXISTS `opleidingen` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `naam` varchar(250) DEFAULT NULL,
  `afkorting` varchar(50) DEFAULT NULL,
  `omschrijving` mediumtext,
  `minniveau` int(5) DEFAULT NULL,
  `prijs` varchar(10) DEFAULT NULL,
  `sessies_zwembad` int(3) DEFAULT NULL,
  `sessies_buiten` int(3) DEFAULT NULL,
  `sessies_theorie` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `minniveau` (`minniveau`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Gegevens worden geëxporteerd voor tabel `opleidingen`
--

INSERT INTO `opleidingen` (`id`, `naam`, `afkorting`, `omschrijving`, `minniveau`, `prijs`, `sessies_zwembad`, `sessies_buiten`, `sessies_theorie`) VALUES
(1, 'Geen', 'Geen', 'Geen', 1, '0', 0, 0, 0);

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `cursussen`
--
ALTER TABLE `cursussen`
  ADD CONSTRAINT `cursussen_ibfk_1` FOREIGN KEY (`leerling`) REFERENCES `login` (`id`),
  ADD CONSTRAINT `cursussen_ibfk_2` FOREIGN KEY (`cursus`) REFERENCES `opleidingen` (`id`);

--
-- Beperkingen voor tabel `kalender`
--
ALTER TABLE `kalender`
  ADD CONSTRAINT `kalender_ibfk_3` FOREIGN KEY (`gewijzigd_door`) REFERENCES `login` (`id`),
  ADD CONSTRAINT `kalender_ibfk_1` FOREIGN KEY (`minniveau`) REFERENCES `opleidingen` (`id`),
  ADD CONSTRAINT `kalender_ibfk_2` FOREIGN KEY (`aangemaakt_door`) REFERENCES `login` (`id`);

--
-- Beperkingen voor tabel `lessen`
--
ALTER TABLE `lessen`
  ADD CONSTRAINT `lessen_ibfk_1` FOREIGN KEY (`lesgever`) REFERENCES `login` (`id`),
  ADD CONSTRAINT `lessen_ibfk_2` FOREIGN KEY (`leerling`) REFERENCES `login` (`id`),
  ADD CONSTRAINT `lessen_ibfk_3` FOREIGN KEY (`cursus`) REFERENCES `cursussen` (`id`),
  ADD CONSTRAINT `lessen_ibfk_4` FOREIGN KEY (`waar`) REFERENCES `locaties` (`id`);

--
-- Beperkingen voor tabel `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `ResLid` FOREIGN KEY (`lidnr`) REFERENCES `leden` (`lidnr`);

--
-- Beperkingen voor tabel `nieuws`
--
ALTER TABLE `nieuws`
  ADD CONSTRAINT `nieuws_ibfk_2` FOREIGN KEY (`gewijzigd_door`) REFERENCES `login` (`id`),
  ADD CONSTRAINT `nieuws_ibfk_1` FOREIGN KEY (`aangemaakt_door`) REFERENCES `login` (`id`);

--
-- Beperkingen voor tabel `opleidingen`
--
ALTER TABLE `opleidingen`
  ADD CONSTRAINT `opleidingen_ibfk_1` FOREIGN KEY (`minniveau`) REFERENCES `opleidingen` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
