/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Exportiere Datenbank Struktur für projektweberp
CREATE DATABASE IF NOT EXISTS `projektweberp` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_german2_ci */;
USE `projektweberp`;

-- Exportiere Struktur von Tabelle projektweberp.dokumentation
DROP TABLE IF EXISTS `dokumentation`;
CREATE TABLE IF NOT EXISTS `dokumentation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datum` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `text` text COLLATE utf8_german2_ci NOT NULL,
  `klient_id` int(11) DEFAULT '0',
  `wichtig` tinyint(4) DEFAULT NULL,
  `todo` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

-- Exportiere Struktur von View projektweberp.dokumentation_view
DROP VIEW IF EXISTS `dokumentation_view`;
-- Erstelle temporäre Tabelle um View Abhängigkeiten zuvorzukommen
CREATE TABLE `dokumentation_view` (
	`doku_id` INT(11) NOT NULL,
	`datum` DATETIME NOT NULL,
	`text` TEXT NOT NULL COLLATE 'utf8_german2_ci',
	`klient_id` INT(11) NULL,
	`wichtig` TINYINT(4) NULL,
	`todo` TINYINT(4) NULL,
	`klienten_id` INT(11) NULL,
	`name` VARCHAR(50) NULL COMMENT 'nachname' COLLATE 'utf8_german2_ci',
	`vorname` VARCHAR(50) NULL COMMENT 'vorname' COLLATE 'utf8_german2_ci',
	`active` ENUM('Y','N') NULL COMMENT 'lebt derzeit in einrichtung?' COLLATE 'utf8_german2_ci'
) ENGINE=MyISAM;

-- Exportiere Struktur von Tabelle projektweberp.einrichtung
DROP TABLE IF EXISTS `einrichtung`;
CREATE TABLE IF NOT EXISTS `einrichtung` (
  `name` varchar(50) COLLATE utf8_german2_ci DEFAULT NULL,
  `konto_iban` varchar(50) COLLATE utf8_german2_ci DEFAULT NULL,
  `konto_bezeichnung` varchar(50) COLLATE utf8_german2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci COMMENT='daten über die einrichtung';

-- Exportiere Daten aus Tabelle projektweberp.einrichtung: ~0 rows (ungefähr)
DELETE FROM `einrichtung`;
/*!40000 ALTER TABLE `einrichtung` DISABLE KEYS */;
INSERT INTO `einrichtung` (`name`, `konto_iban`, `konto_bezeichnung`) VALUES
	('Testeinrichtung', 'TestIBAN', 'TestKontobezeichnung');
/*!40000 ALTER TABLE `einrichtung` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle projektweberp.kleidergeld
DROP TABLE IF EXISTS `kleidergeld`;
CREATE TABLE IF NOT EXISTS `kleidergeld` (
  `id` varchar(1) COLLATE utf8_german2_ci NOT NULL,
  `wert` float NOT NULL,
  `comment` varchar(50) COLLATE utf8_german2_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

-- Exportiere Daten aus Tabelle projektweberp.kleidergeld: ~2 rows (ungefähr)
DELETE FROM `kleidergeld`;
/*!40000 ALTER TABLE `kleidergeld` DISABLE KEYS */;
INSERT INTO `kleidergeld` (`id`, `wert`, `comment`) VALUES
	('m', 36, 'männlich'),
	('w', 41, 'weiblich');
/*!40000 ALTER TABLE `kleidergeld` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle projektweberp.klienten
DROP TABLE IF EXISTS `klienten`;
CREATE TABLE IF NOT EXISTS `klienten` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_german2_ci DEFAULT '0' COMMENT 'nachname',
  `vorname` varchar(50) COLLATE utf8_german2_ci DEFAULT '0' COMMENT 'vorname',
  `geburtsdatum` date DEFAULT NULL,
  `geschlecht` enum('w','m') COLLATE utf8_german2_ci DEFAULT NULL,
  `active` enum('Y','N') COLLATE utf8_german2_ci DEFAULT NULL COMMENT 'lebt derzeit in einrichtung?',
  `aussenwohnung` enum('Y','N') COLLATE utf8_german2_ci DEFAULT NULL,
  `taschengeld_nr` int(11) DEFAULT NULL COMMENT 'deprecated, muss bei bedarf errechnet werden. nötig für den join in der klienten_view',
  `buchungszeichen_kostenbeitrag` varchar(50) COLLATE utf8_german2_ci DEFAULT NULL,
  `aufgenommen_am` date DEFAULT NULL,
  `entlassen_am` date DEFAULT NULL,
  `konto_iban` varchar(50) COLLATE utf8_german2_ci DEFAULT NULL,
  `fallverantwortlich` varchar(50) COLLATE utf8_german2_ci DEFAULT NULL COMMENT 'mitarbeiter des bz',
  `beratungszentrum` varchar(50) COLLATE utf8_german2_ci DEFAULT NULL,
  `wirtsch_juhi` varchar(50) COLLATE utf8_german2_ci DEFAULT NULL,
  `schule_ag` varchar(50) COLLATE utf8_german2_ci DEFAULT NULL COMMENT 'schule oder arbeitgeber',
  `angestr_abschluss` varchar(50) COLLATE utf8_german2_ci DEFAULT NULL COMMENT 'schulabschluss oder ausbildung',
  `ansprechpartner1_name` varchar(50) COLLATE utf8_german2_ci DEFAULT NULL,
  `ansprechpartner1_tel` varchar(50) COLLATE utf8_german2_ci DEFAULT NULL,
  `ansprechpartner1_email` varchar(50) COLLATE utf8_german2_ci DEFAULT NULL,
  `ansprechpartner2_name` varchar(50) COLLATE utf8_german2_ci DEFAULT NULL,
  `ansprechpartner2_tel` varchar(50) COLLATE utf8_german2_ci DEFAULT NULL,
  `ansprechpartner2_email` varchar(50) COLLATE utf8_german2_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci COMMENT='liste aller klienten in der einrichtung';

-- Exportiere Daten aus Tabelle projektweberp.klienten: ~12 rows (ungefähr)
DELETE FROM `klienten`;
/*!40000 ALTER TABLE `klienten` DISABLE KEYS */;
INSERT INTO `klienten` (`id`, `name`, `vorname`, `geburtsdatum`, `geschlecht`, `active`, `aussenwohnung`, `taschengeld_nr`, `buchungszeichen_kostenbeitrag`, `aufgenommen_am`, `entlassen_am`, `konto_iban`, `fallverantwortlich`, `beratungszentrum`, `wirtsch_juhi`, `schule_ag`, `angestr_abschluss`, `ansprechpartner1_name`, `ansprechpartner1_tel`, `ansprechpartner1_email`, `ansprechpartner2_name`, `ansprechpartner2_tel`, `ansprechpartner2_email`) VALUES
	(1, 'TestName', 'VornameTest', '1999-06-1', 'm', 'N', 'Y', 2, '', '1970-01-01', '1970-01-01', 'DE29384858687878843297', '', '', '', '', '', '', '', '', '', '', ''),
	
/*!40000 ALTER TABLE `klienten` ENABLE KEYS */;

-- Exportiere Struktur von View projektweberp.klienten_view
DROP VIEW IF EXISTS `klienten_view`;
-- Erstelle temporäre Tabelle um View Abhängigkeiten zuvorzukommen
CREATE TABLE `klienten_view` (
	`klienten_id` INT(11) NOT NULL,
	`name` VARCHAR(50) NULL COMMENT 'nachname' COLLATE 'utf8_german2_ci',
	`vorname` VARCHAR(50) NULL COMMENT 'vorname' COLLATE 'utf8_german2_ci',
	`geburtsdatum` DATE NULL,
	`geschlecht` ENUM('w','m') NULL COLLATE 'utf8_german2_ci',
	`active` ENUM('Y','N') NULL COMMENT 'lebt derzeit in einrichtung?' COLLATE 'utf8_german2_ci',
	`aussenwohnung` ENUM('Y','N') NULL COLLATE 'utf8_german2_ci',
	`taschengeld_nr` INT(11) NULL COMMENT 'deprecated, muss bei bedarf errechnet werden. nötig für den join in der klienten_view',
	`taschengeld` FLOAT NULL,
	`buchungszeichen` VARCHAR(50) NULL COLLATE 'utf8_german2_ci',
	`aufnahme` DATE NULL,
	`entlassen` DATE NULL,
	`iban` VARCHAR(50) NULL COLLATE 'utf8_german2_ci'
) ENGINE=MyISAM;

-- Exportiere Struktur von Tabelle projektweberp.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Exportiere Daten aus Tabelle projektweberp.migrations: ~2 rows (ungefähr)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle projektweberp.password_resets
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Exportiere Daten aus Tabelle projektweberp.password_resets: ~0 rows (ungefähr)
DELETE FROM `password_resets`;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle projektweberp.taschengeld
DROP TABLE IF EXISTS `taschengeld`;
CREATE TABLE IF NOT EXISTS `taschengeld` (
  `id` int(11) NOT NULL,
  `wert` float NOT NULL,
  `comment` varchar(50) COLLATE utf8_german2_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci ROW_FORMAT=COMPACT;

-- Exportiere Daten aus Tabelle projektweberp.taschengeld: ~3 rows (ungefähr)
DELETE FROM `taschengeld`;
/*!40000 ALTER TABLE `taschengeld` DISABLE KEYS */;
INSERT INTO `taschengeld` (`id`, `wert`, `comment`) VALUES
	(0, 42, 'unter 16'),
	(1, 49, '16-18'),
	(2, 114, '18+');
/*!40000 ALTER TABLE `taschengeld` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle projektweberp.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Exportiere Daten aus Tabelle projektweberp.users: ~0 rows (ungefähr)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'TestUser', 'Testuser@Test.de', '$2y$10$DesA1jCJaN6WZ09c7LYgVuMabai0oXWFT2RyklP4XKZDW./GqxMzG', '5ecLH51DZAeAXgusbPikjBBj6NfUnKwCxVazgcRmzMXROh2bm2Gggj65LodP', '2017-11-10 15:06:43', '2017-11-13 08:56:28');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Exportiere Struktur von View projektweberp.dokumentation_view
DROP VIEW IF EXISTS `dokumentation_view`;
-- Entferne temporäre Tabelle und erstelle die eigentliche View
DROP TABLE IF EXISTS `dokumentation_view`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `dokumentation_view` AS SELECT d.id as doku_id, d.datum, d.text, d.klient_id, d.wichtig, d.todo, klienten.id as klienten_id, klienten.name, klienten.vorname, klienten.active from dokumentation as d
left join klienten on d.klient_id = klienten.id ;

-- Exportiere Struktur von View projektweberp.klienten_view
DROP VIEW IF EXISTS `klienten_view`;
-- Entferne temporäre Tabelle und erstelle die eigentliche View
DROP TABLE IF EXISTS `klienten_view`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `klienten_view` AS SELECT k.id as klienten_id, k.name as name, k.vorname as vorname, k.geburtsdatum as geburtsdatum, k.geschlecht as geschlecht, k.active, k.aussenwohnung as aussenwohnung, k.taschengeld_nr as taschengeld_nr,
t.wert as taschengeld, k.buchungszeichen_kostenbeitrag as buchungszeichen, k.aufgenommen_am as aufnahme, k.entlassen_am as entlassen, k.konto_iban as iban
from klienten as k
left join taschengeld as t
on t.id = k.taschengeld_nr ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
