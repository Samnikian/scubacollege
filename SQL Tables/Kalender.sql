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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;