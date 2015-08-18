-- ---
-- Globals
-- ---

-- SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-- SET FOREIGN_KEY_CHECKS=0;

-- ---
-- Table 'kalender'
-- 
-- ---

DROP TABLE IF EXISTS `kalender`;
		
CREATE TABLE `kalender` (
  `id` INTEGER(5) NULL AUTO_INCREMENT DEFAULT NULL,
  `begin` VARCHAR(150) NULL DEFAULT NULL,
  `einde` VARCHAR(150) NULL DEFAULT NULL,
  `Omschrijving` MEDIUMTEXT NULL DEFAULT NULL,
  `titel` VARCHAR(150) NULL DEFAULT NULL,
  `locatie` VARCHAR(150) NULL DEFAULT NULL,
  `fblink` VARCHAR(250) NULL DEFAULT NULL,
  `heledag` VARCHAR(5) NULL DEFAULT NULL,
  `minniveau` INTEGER(5) NULL DEFAULT NULL,
  `minniveau_naam` VARCHAR(250) NULL DEFAULT NULL,
  `kostprijs` DECIMAL(10) NULL DEFAULT NULL,
  `aangemaakt_door` INTEGER(5) NULL DEFAULT NULL,
  `gewijzigd_door` INTEGER(5) NULL DEFAULT NULL,
  `aangemaakt` VARCHAR(10) NULL DEFAULT NULL,
  `gewijzigd` VARCHAR(10) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'opleidingen'
-- 
-- ---

DROP TABLE IF EXISTS `opleidingen`;
		
CREATE TABLE `opleidingen` (
  `id` INTEGER(5) NULL AUTO_INCREMENT DEFAULT NULL,
  `naam` VARCHAR(250) NULL DEFAULT NULL,
  `afkorting` VARCHAR(50) NULL DEFAULT NULL,
  `omschrijving` MEDIUMTEXT NULL DEFAULT NULL,
  `minniveau` INTEGER(5) NULL DEFAULT NULL,
  `minniveau_naam` VARCHAR(250) NULL DEFAULT NULL,
  `kostprijs` DECIMAL(10) NULL DEFAULT NULL,
  `sessies_zwembad` INTEGER NULL DEFAULT NULL,
  `sessies_buiten` INTEGER NULL DEFAULT NULL,
  `sessies_theorie` INTEGER NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'nieuws'
-- 
-- ---

DROP TABLE IF EXISTS `nieuws`;
		
CREATE TABLE `nieuws` (
  `id` INTEGER(5) NULL AUTO_INCREMENT DEFAULT NULL,
  `titel` VARCHAR(150) NULL DEFAULT NULL,
  `tekst` MEDIUMTEXT NULL DEFAULT NULL,
  `foto` VARCHAR(150) NULL DEFAULT NULL,
  `aangemaakt_door` INTEGER(5) NULL DEFAULT NULL,
  `aangemaakt` VARCHAR(10) NULL DEFAULT NULL,
  `gewijzigd` VARCHAR(10) NULL DEFAULT NULL,
  `gewijzigd_door` INTEGER(5) NULL DEFAULT NULL,
  `prioriteit` INTEGER(3) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'login'
-- 
-- ---

DROP TABLE IF EXISTS `login`;
		
CREATE TABLE `login` (
  `id` INTEGER(5) NULL AUTO_INCREMENT DEFAULT NULL,
  `email` VARCHAR(250) NULL DEFAULT NULL,
  `password` VARCHAR(250) NULL DEFAULT NULL,
  `last_login_time` VARCHAR(150) NULL DEFAULT NULL,
  `reset_hash` VARCHAR(250) NULL DEFAULT NULL,
  `reset_time` VARCHAR(150) NULL DEFAULT NULL,
  `reset_email` VARCHAR(250) NULL DEFAULT NULL,
  `last_login_ip` VARCHAR(20) NULL DEFAULT NULL,
  `aantal_pogingen` INTEGER NULL DEFAULT NULL,
  `lidnr` INTEGER(10) NULL DEFAULT NULL,
  `activatie_hash` VARCHAR(250) NULL DEFAULT NULL,
  UNIQUE KEY (`id`, `lidnr`)
);

-- ---
-- Table 'leden'
-- 
-- ---

DROP TABLE IF EXISTS `leden`;
		
CREATE TABLE `leden` (
  `id` INTEGER(5) NULL AUTO_INCREMENT DEFAULT NULL,
  `lidnr` INTEGER(10) NULL DEFAULT NULL,
  `straat` INTEGER NULL DEFAULT NULL,
  `huisnummer` INTEGER NULL DEFAULT NULL,
  `postcode` INTEGER NULL DEFAULT NULL,
  `gemeente` INTEGER NULL DEFAULT NULL,
  `opleidingen` INTEGER NULL DEFAULT NULL,
  `naam` INTEGER NULL DEFAULT NULL,
  `voornaam` INTEGER NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'cursussen'
-- 
-- ---

DROP TABLE IF EXISTS `cursussen`;
		
CREATE TABLE `cursussen` (
  `id` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `leerling` INTEGER NULL DEFAULT NULL,
  `cursus` INTEGER NULL DEFAULT NULL,
  `betaald` INTEGER NULL DEFAULT NULL,
  `medischformulier` INTEGER NULL DEFAULT NULL,
  `sessies_zwembad_gedaan` INTEGER NULL DEFAULT NULL,
  `sessies_buiten_gedaan` INTEGER NULL DEFAULT NULL,
  `sessies_theorie_gedaan` INTEGER NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'lessen'
-- 
-- ---

DROP TABLE IF EXISTS `lessen`;
		
CREATE TABLE `lessen` (
  `id` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `lesgever` INTEGER NULL DEFAULT NULL,
  `leerling` INTEGER NULL DEFAULT NULL,
  `cursus` INTEGER NULL DEFAULT NULL,
  `soort` INTEGER NULL DEFAULT NULL,
  `soort_nummer` INTEGER NULL DEFAULT NULL,
  `datum` INTEGER NULL DEFAULT NULL,
  `tijd` INTEGER NULL DEFAULT NULL,
  `waar` INTEGER NULL DEFAULT NULL,
  `opmerkingen` INTEGER NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Foreign Keys 
-- ---

ALTER TABLE `kalender` ADD FOREIGN KEY (minniveau) REFERENCES `opleidingen` (`id`);
ALTER TABLE `kalender` ADD FOREIGN KEY (aangemaakt_door) REFERENCES `login` (`id`);
ALTER TABLE `kalender` ADD FOREIGN KEY (gewijzigd_door) REFERENCES `login` (`id`);
ALTER TABLE `opleidingen` ADD FOREIGN KEY (minniveau) REFERENCES `opleidingen` (`id`);
ALTER TABLE `nieuws` ADD FOREIGN KEY (aangemaakt_door) REFERENCES `login` (`id`);
ALTER TABLE `nieuws` ADD FOREIGN KEY (gewijzigd_door) REFERENCES `login` (`id`);
ALTER TABLE `leden` ADD FOREIGN KEY (lidnr) REFERENCES `login` (`lidnr`);
ALTER TABLE `cursussen` ADD FOREIGN KEY (leerling) REFERENCES `login` (`id`);
ALTER TABLE `cursussen` ADD FOREIGN KEY (cursus) REFERENCES `opleidingen` (`id`);
ALTER TABLE `lessen` ADD FOREIGN KEY (lesgever) REFERENCES `login` (`id`);
ALTER TABLE `lessen` ADD FOREIGN KEY (leerling) REFERENCES `login` (`id`);
ALTER TABLE `lessen` ADD FOREIGN KEY (cursus) REFERENCES `cursussen` (`id`);

-- ---
-- Table Properties
-- ---

-- ALTER TABLE `kalender` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `opleidingen` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `nieuws` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `login` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `leden` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `cursussen` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `lessen` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ---
-- Test Data
-- ---

-- INSERT INTO `kalender` (`id`,`begin`,`einde`,`Omschrijving`,`titel`,`locatie`,`fblink`,`heledag`,`minniveau`,`minniveau_naam`,`kostprijs`,`aangemaakt_door`,`gewijzigd_door`,`aangemaakt`,`gewijzigd`) VALUES
-- ('','','','','','','','','','','','','','','');
-- INSERT INTO `opleidingen` (`id`,`naam`,`afkorting`,`omschrijving`,`minniveau`,`minniveau_naam`,`kostprijs`,`sessies_zwembad`,`sessies_buiten`,`sessies_theorie`) VALUES
-- ('','','','','','','','','','');
-- INSERT INTO `nieuws` (`id`,`titel`,`tekst`,`foto`,`aangemaakt_door`,`aangemaakt`,`gewijzigd`,`gewijzigd_door`,`prioriteit`) VALUES
-- ('','','','','','','','','');
-- INSERT INTO `login` (`id`,`email`,`password`,`last_login_time`,`reset_hash`,`reset_time`,`reset_email`,`last_login_ip`,`aantal_pogingen`,`lidnr`,`activatie_hash`) VALUES
-- ('','','','','','','','','','','');
-- INSERT INTO `leden` (`id`,`lidnr`,`straat`,`huisnummer`,`postcode`,`gemeente`,`opleidingen`,`naam`,`voornaam`) VALUES
-- ('','','','','','','','','');
-- INSERT INTO `cursussen` (`id`,`leerling`,`cursus`,`betaald`,`medischformulier`,`sessies_zwembad_gedaan`,`sessies_buiten_gedaan`,`sessies_theorie_gedaan`) VALUES
-- ('','','','','','','','');
-- INSERT INTO `lessen` (`id`,`lesgever`,`leerling`,`cursus`,`soort`,`soort_nummer`,`datum`,`tijd`,`waar`,`opmerkingen`) VALUES
-- ('','','','','','','','','','');
