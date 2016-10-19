-- phpMyAdmin SQL Dump
-- version 4.0.10.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 29, 2014 at 07:33 PM
-- Server version: 5.5.40-cll
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `rbrgvnd_demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `rbrgvnd_user`
--

CREATE TABLE IF NOT EXISTS `rbrgvnd_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_last_seen` int(10) unsigned DEFAULT NULL,
  `date_join` int(10) unsigned NOT NULL,
  `ip_register` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_last` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uuid` (`uuid`),
  UNIQUE KEY `date` (`date_join`),
  UNIQUE KEY `username` (`username`),
  KEY `ip` (`ip_last`),
  KEY `ip_register` (`ip_register`),
  KEY `password` (`password`),
  KEY `username_password_pair` (`username`,`password`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ;

--
-- Dumping data for table `rbrgvnd_user`
--

INSERT INTO `rbrgvnd_user` (`id`, `uuid`, `username`, `email`, `password`, `date_last_seen`, `date_join`, `ip_register`, `ip_last`) VALUES(1, '160201cf-ba16-4128-aa9d-d24445a2544f', 'Demo', 'demo@rbrgvnd.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 1417320304, 1417251424, NULL, NULL);