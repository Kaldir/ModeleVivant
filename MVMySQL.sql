-- phpMyAdmin SQL Dump
-- version 4.1.14.8
-- http://www.phpmyadmin.net
--
-- Host: db706429770.db.1and1.com
-- Generation Time: Mar 01, 2018 at 06:44 PM
-- Server version: 5.5.59-0+deb7u1-log
-- PHP Version: 5.4.45-0+deb7u12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db706429770`
--

-- --------------------------------------------------------

--
-- Table structure for table `mv_ad`
--

CREATE TABLE IF NOT EXISTS `mv_ad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_category` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `creation_date` datetime NOT NULL,
  `published` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_category` (`id_category`),
  KEY `id_user` (`id_user`),
  KEY `id_category_2` (`id_category`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mv_category`
--

CREATE TABLE IF NOT EXISTS `mv_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mv_comment`
--

CREATE TABLE IF NOT EXISTS `mv_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `comment` text NOT NULL,
  `creation_date` datetime NOT NULL,
  `signalised` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_post` (`id_post`),
  KEY `id_user` (`id_user`),
  KEY `id_post_2` (`id_post`),
  KEY `id_post_3` (`id_post`),
  KEY `id_user_2` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mv_post`
--

CREATE TABLE IF NOT EXISTS `mv_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_category` (`id_category`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mv_user`
--

CREATE TABLE IF NOT EXISTS `mv_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `pseudo` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `mv_user`
--

INSERT INTO `mv_user` (`id`, `admin`, `pseudo`, `mail`, `password`, `avatar`, `creation_date`) VALUES
(9, 0, 'Lulu', 'lulu@kldr.fr', '$2y$10$UhP2KKGSi5k7z3rTqp4x9.fsQ9wlut5N3Exd0Fha6j6tbRdAH392C', NULL, '2018-03-01 08:31:47');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mv_ad`
--
ALTER TABLE `mv_ad`
  ADD CONSTRAINT `mv_ad_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `mv_user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mv_ad_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `mv_category` (`id`);

--
-- Constraints for table `mv_comment`
--
ALTER TABLE `mv_comment`
  ADD CONSTRAINT `mv_comment_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `mv_user` (`id`),
  ADD CONSTRAINT `mv_comment_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `mv_post` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mv_post`
--
ALTER TABLE `mv_post`
  ADD CONSTRAINT `mv_post_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `mv_category` (`id`),
  ADD CONSTRAINT `mv_post_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `mv_user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
