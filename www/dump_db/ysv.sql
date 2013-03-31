-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Мар 31 2013 г., 14:10
-- Версия сервера: 5.5.29-MariaDB-log
-- Версия PHP: 5.3.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `ysv`
--

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `header` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `preview` text NOT NULL,
  `body` text NOT NULL,
  `onMainList` enum('0','1') NOT NULL DEFAULT '0',
  `isTopOnMain` enum('0','1') NOT NULL DEFAULT '0',
  `isTopOnSections` enum('0','1') NOT NULL DEFAULT '0',
  `isShow` enum('0','1') NOT NULL DEFAULT '1',
  `date` date NOT NULL,
  `author` smallint(5) unsigned NOT NULL DEFAULT '0',
  `position` int(11) NOT NULL DEFAULT '9999',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `header` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `preview` text NOT NULL,
  `body` text NOT NULL,
  `isMainPage` enum('0','1') NOT NULL DEFAULT '0',
  `onMainList` enum('0','1') NOT NULL DEFAULT '0',
  `isTopOnMain` enum('0','1') NOT NULL DEFAULT '0',
  `isTopOnSections` enum('0','1') NOT NULL DEFAULT '0',
  `isShow` enum('0','1') NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  `author` smallint(5) unsigned NOT NULL DEFAULT '0',
  `position` int(11) NOT NULL DEFAULT '9999',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `tree`
--

CREATE TABLE IF NOT EXISTS `tree` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lft` int(10) unsigned NOT NULL,
  `rgt` int(10) unsigned NOT NULL,
  `level` smallint(5) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `controller` varchar(65) NOT NULL,
  `tableName` varchar(65) NOT NULL,
  `pageId` int(10) unsigned NOT NULL DEFAULT '0',
  `isShow` enum('1','0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `lft` (`lft`),
  KEY `rgt` (`rgt`),
  KEY `level` (`level`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
