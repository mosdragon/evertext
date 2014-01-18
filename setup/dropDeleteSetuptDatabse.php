<?php
	require_once(__DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."lib".DIRECTORY_SEPARATOR."database.php"); //creates $db variable with db connection info
	

	$createQuery = $db->prepare("

-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.34 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             8.2.0.4675
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for evertext
DROP DATABASE IF EXISTS `evertext`;
CREATE DATABASE IF NOT EXISTS `evertext` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `evertext`;


-- Dumping structure for table evertext.conversations
DROP TABLE IF EXISTS `conversations`;
CREATE TABLE IF NOT EXISTS `conversations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `users` varchar(50) DEFAULT NULL,
  `owner` int(11) DEFAULT NULL,
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `number` (`number`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table evertext.conversations: ~1 rows (approximately)
/*!40000 ALTER TABLE `conversations` DISABLE KEYS */;
INSERT INTO `conversations` (`id`, `number`, `name`, `users`, `owner`) VALUES
	(2, 4048893665, 'EVERTEXT', NULL, 1);
/*!40000 ALTER TABLE `conversations` ENABLE KEYS */;


-- Dumping structure for table evertext.messages
DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `conversation` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `message` varchar(200) DEFAULT NULL,
  `recievers` varchar(50) DEFAULT NULL,
  `postTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table evertext.messages: ~2 rows (approximately)
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` (`id`, `conversation`, `sender`, `message`, `recievers`, `postTime`) VALUES
	(1, 6, 3, 'HELLO', NULL, '2014-01-18 14:51:40'),
	(2, 6, 3, 'HELLO', NULL, '2014-01-18 14:51:53');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;


-- Dumping structure for table evertext.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT '0',
  `email` varchar(50) DEFAULT '0',
  `username` varchar(50) DEFAULT '0',
  `password` varchar(65) DEFAULT '0',
  `authToken` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT '0',
  `evernote` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table evertext.users: ~1 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `authToken`, `phone`, `evernote`) VALUES
	(2, NULL, 'ashaw596@gmail.com', NULL, 'school', NULL, '4048893664', 'asdfhajkldsfh');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
");

echo $createQuery->execute();