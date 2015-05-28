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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;