-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 17 Avril 2015 à 08:12
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `db_api`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `IDCOMMENT` bigint(20) NOT NULL,
  `IDPLATFORMGAME` bigint(20) NOT NULL,
  `AUTHOR` varchar(200) NOT NULL,
  `NOTE` decimal(3,1) NOT NULL,
  `CONTENT` varchar(200) NOT NULL,
  PRIMARY KEY (`IDCOMMENT`),
  KEY `FK_HAVE_COMMENT` (`IDPLATFORMGAME`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `IDCOMPANY` bigint(20) NOT NULL,
  `NAMECOMPANY` varchar(200) NOT NULL,
  `ACTIVITYCOMPANY` varchar(150) NOT NULL,
  PRIMARY KEY (`IDCOMPANY`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `configuration`
--

CREATE TABLE IF NOT EXISTS `configuration` (
  `IDCONFIGURATION` bigint(20) NOT NULL,
  `IDPLATFORMGAME` bigint(20) NOT NULL,
  `SYSTEM` varchar(200) NOT NULL,
  `RAM` varchar(200) NOT NULL,
  `DISK` varchar(200) NOT NULL,
  `GPU` varchar(200) NOT NULL,
  `CONNECTIONCONFIG` longtext NOT NULL,
  `DIRECTX` varchar(200) NOT NULL,
  PRIMARY KEY (`IDCONFIGURATION`),
  KEY `FK_HAVE_CONFIGURATION` (`IDPLATFORMGAME`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `game`
--

CREATE TABLE IF NOT EXISTS `game` (
  `IDGAME` bigint(20) NOT NULL,
  `TITLE` longtext NOT NULL,
  `DESCRIPTION` text NOT NULL,
  PRIMARY KEY (`IDGAME`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `have_company`
--

CREATE TABLE IF NOT EXISTS `have_company` (
  `IDCOMPANY` bigint(20) NOT NULL,
  `IDGAME` bigint(20) NOT NULL,
  PRIMARY KEY (`IDCOMPANY`,`IDGAME`),
  KEY `FK_HAVE_COMPANY2` (`IDGAME`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `have_language`
--

CREATE TABLE IF NOT EXISTS `have_language` (
  `LABELLANGUAGE` varchar(100) NOT NULL,
  `IDPLATFORMGAME` bigint(20) NOT NULL,
  PRIMARY KEY (`LABELLANGUAGE`,`IDPLATFORMGAME`),
  KEY `FK_HAVE_LANGUAGE2` (`IDPLATFORMGAME`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `have_link`
--

CREATE TABLE IF NOT EXISTS `have_link` (
  `IDLINK` bigint(20) NOT NULL,
  `IDGAME` bigint(20) NOT NULL,
  PRIMARY KEY (`IDLINK`,`IDGAME`),
  KEY `FK_HAVE_LINK2` (`IDGAME`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `have_note`
--

CREATE TABLE IF NOT EXISTS `have_note` (
  `IDNOTE` bigint(20) NOT NULL,
  `IDPLATFORMGAME` bigint(20) NOT NULL,
  `NOTE` decimal(3,1) DEFAULT NULL,
  PRIMARY KEY (`IDNOTE`,`IDPLATFORMGAME`),
  KEY `FK_HAVE_NOTE2` (`IDPLATFORMGAME`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `have_price`
--

CREATE TABLE IF NOT EXISTS `have_price` (
  `IDPRICE` bigint(20) NOT NULL,
  `IDPLATFORMGAME` bigint(20) NOT NULL,
  `PRICE` float NOT NULL,
  `CURRENCY` varchar(150) NOT NULL,
  PRIMARY KEY (`IDPRICE`,`IDPLATFORMGAME`),
  KEY `FK_HAVE_PRICE2` (`IDPLATFORMGAME`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `have_similargame`
--

CREATE TABLE IF NOT EXISTS `have_similargame` (
  `IDSIMILARGAME` bigint(20) NOT NULL,
  `IDPLATFORMGAME` bigint(20) NOT NULL,
  PRIMARY KEY (`IDSIMILARGAME`,`IDPLATFORMGAME`),
  KEY `FK_HAVE_SIMILARGAME2` (`IDPLATFORMGAME`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `have_subtitle`
--

CREATE TABLE IF NOT EXISTS `have_subtitle` (
  `LABELLANGUAGE` varchar(100) NOT NULL,
  `IDPLATFORMGAME` bigint(20) NOT NULL,
  PRIMARY KEY (`LABELLANGUAGE`,`IDPLATFORMGAME`),
  KEY `FK_HAVE_SUBTITLE2` (`IDPLATFORMGAME`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `have_type`
--

CREATE TABLE IF NOT EXISTS `have_type` (
  `IDTYPE` bigint(20) NOT NULL,
  `IDGAME` bigint(20) NOT NULL,
  PRIMARY KEY (`IDTYPE`,`IDGAME`),
  KEY `FK_HAVE_TYPE2` (`IDGAME`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `language`
--

CREATE TABLE IF NOT EXISTS `language` (
  `LABELLANGUAGE` varchar(100) NOT NULL,
  PRIMARY KEY (`LABELLANGUAGE`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `link`
--

CREATE TABLE IF NOT EXISTS `link` (
  `IDLINK` bigint(20) NOT NULL,
  `IDTYPELINK` smallint(6) NOT NULL,
  `CONTENTLINK` longtext NOT NULL,
  `SOCIAL` tinyint(1) NOT NULL,
  PRIMARY KEY (`IDLINK`),
  KEY `FK_HAVE_TYPELINK` (`IDTYPELINK`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

CREATE TABLE IF NOT EXISTS `media` (
  `IDMEDIA` bigint(20) NOT NULL,
  `IDPLATFORMGAME` bigint(20) NOT NULL,
  `TYPEMEDIA` varchar(100) NOT NULL,
  `TARGETMEDIA` varchar(200) NOT NULL,
  `LABELMEDIA` varchar(200) NOT NULL,
  `URLMEDIA` longtext NOT NULL,
  `ALTMEDIA` varchar(200) NOT NULL,
  PRIMARY KEY (`IDMEDIA`),
  KEY `FK_HAVE_MEDIA` (`IDPLATFORMGAME`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

CREATE TABLE IF NOT EXISTS `note` (
  `IDNOTE` bigint(20) NOT NULL,
  `SOURCE` longtext NOT NULL,
  PRIMARY KEY (`IDNOTE`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `platform`
--

CREATE TABLE IF NOT EXISTS `platform` (
  `ID` bigint(20) NOT NULL,
  `NAME` varchar(150) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `platformgame`
--

CREATE TABLE IF NOT EXISTS `platformgame` (
  `IDPLATFORMGAME` bigint(20) NOT NULL,
  `IDGAME` bigint(20) NOT NULL,
  `ID` bigint(20) NOT NULL,
  PRIMARY KEY (`IDPLATFORMGAME`),
  KEY `FK_HAVE_PFGAME_GAME` (`IDGAME`),
  KEY `FK_HAVE_PFGAME_PF` (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `point`
--

CREATE TABLE IF NOT EXISTS `point` (
  `IDPOINT` bigint(20) NOT NULL,
  `IDPLATFORMGAME` bigint(20) NOT NULL,
  `TYPEMEDIA` varchar(100) DEFAULT NULL,
  `POINT` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`IDPOINT`),
  KEY `FK_HAVE_POINT` (`IDPLATFORMGAME`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `seller`
--

CREATE TABLE IF NOT EXISTS `seller` (
  `IDPRICE` bigint(20) NOT NULL,
  `SELLER` varchar(150) NOT NULL,
  `TYPEMEDIA` varchar(100) NOT NULL,
  PRIMARY KEY (`IDPRICE`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `similargame`
--

CREATE TABLE IF NOT EXISTS `similargame` (
  `IDSIMILARGAME` bigint(20) NOT NULL,
  `LABELMEDIA` varchar(200) NOT NULL,
  `URLMEDIA` longtext NOT NULL,
  PRIMARY KEY (`IDSIMILARGAME`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `trick`
--

CREATE TABLE IF NOT EXISTS `trick` (
  `IDTRICK` bigint(20) NOT NULL,
  `IDPLATFORMGAME` bigint(20) NOT NULL,
  `LABELMEDIA` varchar(200) NOT NULL,
  PRIMARY KEY (`IDTRICK`),
  KEY `FK_HAVE_TRICK` (`IDPLATFORMGAME`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `IDTYPE` bigint(20) NOT NULL,
  `NAMETYPE` varchar(150) NOT NULL,
  PRIMARY KEY (`IDTYPE`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `typelink`
--

CREATE TABLE IF NOT EXISTS `typelink` (
  `IDTYPELINK` smallint(6) NOT NULL,
  `NAMETYPELINK` varchar(200) NOT NULL,
  PRIMARY KEY (`IDTYPELINK`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
