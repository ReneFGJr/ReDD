-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 14, 2018 at 10:37 AM
-- Server version: 5.6.20-log
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `find`
--

-- --------------------------------------------------------

--
-- Table structure for table `rdf_name`
--

CREATE TABLE IF NOT EXISTS `rdf_name` (
`id_n` bigint(20) unsigned NOT NULL,
  `n_name` varchar(250) NOT NULL,
  `n_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `n_lock` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2643 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rdf_name`
--
ALTER TABLE `rdf_name`
 ADD UNIQUE KEY `id_n` (`id_n`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rdf_name`
--
ALTER TABLE `rdf_name`
MODIFY `id_n` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2643;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
