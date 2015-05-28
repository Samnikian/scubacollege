-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 28 mei 2015 om 14:38
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Gegevens worden geÃ«xporteerd voor tabel `kalender`
--

INSERT INTO `kalender` (`id`, `begin`, `einde`, `omschrijving`, `titel`, `locatie`, `fblink`, `heledag`, `minniveau`) VALUES
(1, '1432816511', '1432816511', 'Dit is een test omschrijving', 'Dit is een test evenement', 'Nekkerpool', '', '1', 0),
(2, '1432816511', '1432816511', 'Dit is een test omschrijving', 'Dit is een test evenement', 'Nekkerpool', '', '1', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `nieuws`
--

CREATE TABLE IF NOT EXISTS `nieuws` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `titel` varchar(150) NOT NULL,
  `tekst` text NOT NULL,
  `foto` varchar(150) NOT NULL,
  `wie` int(5) NOT NULL,
  `aangemaakt` varchar(10) NOT NULL,
  `gewijzigd` varchar(10) NOT NULL,
  `prioriteit` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `titel` (`titel`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Gegevens worden geÃ«xporteerd voor tabel `nieuws`
--

INSERT INTO `nieuws` (`id`, `titel`, `tekst`, `foto`, `wie`, `aangemaakt`, `gewijzigd`, `prioriteit`) VALUES
(3, 'Scuba Review', 'Binnenkort op vakantie en lang niet meer gedoken? Volg dan een Scuba Review en fris in ons zwembad je duikvaardigheden op! Op die manier ben je optimaal voorbereid voor een fijne duikvakantie. De prijs van deze opfrissingscursus is 30Ã¢â€šÂ¬. Optionaal kan je nog een open water duik maken.', 'images/nieuws/Scuba-Review.jpg', 0, '1420457020', '1422744163', 1),
(4, 'NIEUW: PADI SIDEMOUNT Specialty', 'Ervaar een nieuwe manier van duiken waarbij de flessen naast je hangen ipv op je rug. Dit biedt tal van voordelen.\r\n[url=http://www.google.be]Voor meer info klik hier[/url]', 'images/nieuws/NIEUW-PADI-SIDEMOUNT-Specialty.jpg', 0, '1420457020', '1422821194', 3),
(5, 'NIEUW: PADI Propulsion Vehicle Specialty', 'Laat je voorttrekken door een scooter, spaar lucht en energie, en ga op verkenning naar verder gelegen duikspots. Een zeer plezierige PADI specialty!\r\n\r\n[url=http://www.google.be]Voor meer info klik hier[/url]', 'geen', 1, '1420457020', '1420457020', 1),
(14, 'PADI Oxygen Provider Cursus', 'Een zeer interessante cursus voor elke duiker[url=test]Voor meer info klik hier[/url]', 'geen', 1, '1420458643', '1420458643', 1),
(15, 'OPEN WATER DIVER CURSUS', 'PROMOTIE : nu aan [b]369Ã¢â€šÂ¬[/b]\r\nInclusief gebruik duikmateriaal,Brevetterings-kosten en PADI Open Water DVD kit. GRATIS Lidmaatschap van onze duikclub tot eind 2015!! Extra korting bij inschrijving met 2 of meerdere personen!! Cursus start elke week\r\n\r\n[url=http://scubacollege.be?t=test]Voor meer info klik hier[/url]', 'geen', 0, '1420473696', '1431628398', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
