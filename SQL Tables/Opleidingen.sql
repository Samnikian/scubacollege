CREATE TABLE IF NOT EXISTS `opleidingen` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `naam` varchar(250) NOT NULL,
  `afkorting` varchar(50) NOT NULL,
  `omschrijving` text NOT NULL,
  `minniveau` int(5) NOT NULL,
  `minniveau_naam` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;