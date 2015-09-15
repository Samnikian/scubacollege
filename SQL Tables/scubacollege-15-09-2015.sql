-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 15 sep 2015 om 21:30
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
  `adres` varchar(250) NOT NULL,
  `opleidingen` varchar(150) NOT NULL,
  `naam` varchar(150) NOT NULL,
  `voornaam` varchar(150) NOT NULL,
  `level` int(3) NOT NULL DEFAULT '1',
  `active` int(1) NOT NULL DEFAULT '0',
  UNIQUE KEY `id` (`id`,`lidnr`),
  UNIQUE KEY `email` (`email`),
  KEY `lidnr` (`lidnr`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Gegevens worden geëxporteerd voor tabel `login`
--

INSERT INTO `login` (`id`, `email`, `password`, `last_login_time`, `reset_hash`, `reset_time`, `reset_email`, `last_login_ip`, `aantal_pogingen`, `lidnr`, `activatie_hash`, `adres`, `opleidingen`, `naam`, `voornaam`, `level`, `active`) VALUES
(0, 'niels@mortelmans.org', '$2y$10$GJ7gOm5tlAEJMeYtEXUxKewhK9KRxrndz3qZDEYy03BeBfhA6bCda', '1440084911', NULL, NULL, NULL, '::1', 0, 20135566, NULL, 'Mechelseweg 120, Kapelle-op-den-Bos', '2', 'Mortelmans', 'Niels', 4, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Gegevens worden geëxporteerd voor tabel `nieuws`
--

INSERT INTO `nieuws` (`id`, `titel`, `tekst`, `foto`, `aangemaakt_door`, `aangemaakt`, `gewijzigd`, `gewijzigd_door`, `prioriteit`) VALUES
(2, 'NIEUW: PADI SIDEMOUNT Specialty', 'Ervaar een nieuwe manier van duiken waarbij de flessen naast je hangen ipv op je rug. Dit biedt tal van voordelen.\r\n[url=http://www.google.be]Voor meer info klik hier[/url]', 'images/nieuws/NIEUW-PADI-SIDEMOUNT-Specialty.jpg', 0, '1439909109', '1439970103', 0, 1),
(5, 'Scuba Review', 'Binnenkort op vakantie en lang niet meer gedoken? Volg dan een Scuba Review en fris in ons zwembad je duikvaardigheden op! Op die manier ben je optimaal voorbereid voor een fijne duikvakantie. De prijs van deze opfrissingscursus is 30â‚¬. [i]Optioneel kan je nog een open water duik maken[/i].', 'images/nieuws/Scuba-Review.jpg', 0, '1439969890', '1439970131', 0, 1),
(6, 'NIEUW: PADI Propulsion Vehicle Specialty', 'Laat je voorttrekken door een scooter, spaar lucht en energie, en ga op verkenning naar verder gelegen duikspots. Een zeer plezierige PADI specialty!\r\n\r\n[url=http://www.google.be]Voor meer info klik hier[/url]', 'geen', 0, '1439969974', '1439969974', NULL, 1),
(7, 'PADI Oxygen Provider Cursus', 'Een zeer interessante cursus voor elke duiker[url=test]Voor meer info klik hier[/url]', 'geen', 0, '1439969988', '1439969988', NULL, 1),
(8, 'OPEN WATER DIVER CURSUS', 'PROMOTIE : nu aan [b]369â‚¬[/b]\r\nInclusief gebruik duikmateriaal,Brevetterings-kosten en PADI Open Water DVD kit. GRATIS Lidmaatschap van onze duikclub tot eind 2015!! Extra korting bij inschrijving met 2 of meerdere personen!! [i]Cursus start elke week[i][url=http://scubacollege.be?t=test]Voor meer info klik hier[/url]', 'geen', 0, '1439970062', '1439970062', NULL, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Gegevens worden geëxporteerd voor tabel `opleidingen`
--

INSERT INTO `opleidingen` (`id`, `naam`, `afkorting`, `omschrijving`, `minniveau`, `prijs`, `sessies_zwembad`, `sessies_buiten`, `sessies_theorie`) VALUES
(1, 'Geen', 'Geen', 'Geen', 1, '0', 0, 0, 0),
(2, 'Open Water Diver', 'OW', 'Dit is een test omschrijving', 1, '350', 3, 5, 1);

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
  ADD CONSTRAINT `kalender_ibfk_1` FOREIGN KEY (`minniveau`) REFERENCES `opleidingen` (`id`),
  ADD CONSTRAINT `kalender_ibfk_2` FOREIGN KEY (`aangemaakt_door`) REFERENCES `login` (`id`),
  ADD CONSTRAINT `kalender_ibfk_3` FOREIGN KEY (`gewijzigd_door`) REFERENCES `login` (`id`);

--
-- Beperkingen voor tabel `lessen`
--
ALTER TABLE `lessen`
  ADD CONSTRAINT `lessen_ibfk_1` FOREIGN KEY (`lesgever`) REFERENCES `login` (`id`),
  ADD CONSTRAINT `lessen_ibfk_2` FOREIGN KEY (`leerling`) REFERENCES `login` (`id`),
  ADD CONSTRAINT `lessen_ibfk_3` FOREIGN KEY (`cursus`) REFERENCES `cursussen` (`id`),
  ADD CONSTRAINT `lessen_ibfk_4` FOREIGN KEY (`waar`) REFERENCES `locaties` (`id`);

--
-- Beperkingen voor tabel `nieuws`
--
ALTER TABLE `nieuws`
  ADD CONSTRAINT `nieuws_ibfk_1` FOREIGN KEY (`aangemaakt_door`) REFERENCES `login` (`id`),
  ADD CONSTRAINT `nieuws_ibfk_2` FOREIGN KEY (`gewijzigd_door`) REFERENCES `login` (`id`);

--
-- Beperkingen voor tabel `opleidingen`
--
ALTER TABLE `opleidingen`
  ADD CONSTRAINT `opleidingen_ibfk_1` FOREIGN KEY (`minniveau`) REFERENCES `opleidingen` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
