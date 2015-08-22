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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Gegevens worden geëxporteerd voor tabel `nieuws`
--

INSERT INTO `nieuws` (`id`, `titel`, `tekst`, `foto`, `aangemaakt_door`, `aangemaakt`, `gewijzigd`, `prioriteit`) VALUES
(3, 'Scuba Review', 'Binnenkort op vakantie en lang niet meer gedoken? Volg dan een Scuba Review en fris in ons zwembad je duikvaardigheden op! Op die manier ben je optimaal voorbereid voor een fijne duikvakantie. De prijs van deze opfrissingscursus is 30â‚¬. [i]Optioneel kan je nog een open water duik maken[/i].', 'images/nieuws/Scuba-Review.jpg', 0, '1420457020', '1438689947', 1),
(4, 'NIEUW: PADI SIDEMOUNT Specialty', 'Ervaar een nieuwe manier van duiken waarbij de flessen naast je hangen ipv op je rug. Dit biedt tal van voordelen.\r\n[url=http://www.google.be]Voor meer info klik hier[/url]', 'images/nieuws/NIEUW-PADI-SIDEMOUNT-Specialty.jpg', 0, '1420457020', '1422821194', 3),
(5, 'NIEUW: PADI Propulsion Vehicle Specialty', 'Laat je voorttrekken door een scooter, spaar lucht en energie, en ga op verkenning naar verder gelegen duikspots. Een zeer plezierige PADI specialty!\r\n\r\n[url=http://www.google.be]Voor meer info klik hier[/url]', 'geen', 1, '1420457020', '1420457020', 1),
(14, 'PADI Oxygen Provider Cursus', 'Een zeer interessante cursus voor elke duiker[url=test]Voor meer info klik hier[/url]', 'geen', 1, '1420458643', '1420458643', 1),
(15, 'OPEN WATER DIVER CURSUS', 'PROMOTIE : nu aan [b]369â‚¬[/b]\r\nInclusief gebruik duikmateriaal,Brevetterings-kosten en PADI Open Water DVD kit. GRATIS Lidmaatschap van onze duikclub tot eind 2015!! Extra korting bij inschrijving met 2 of meerdere personen!! [i]Cursus start elke week[i]\r\n\r\n[url=http://scubacollege.be?t=test]Voor meer info klik hier[/url]', 'geen', 0, '1420473696', '1438690848', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
