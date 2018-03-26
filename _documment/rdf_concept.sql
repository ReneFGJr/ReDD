-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 14, 2018 at 10:35 AM
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
-- Table structure for table `rdf_concept`
--

CREATE TABLE IF NOT EXISTS `rdf_concept` (
`id_cc` bigint(20) unsigned NOT NULL,
  `cc_class` int(11) NOT NULL,
  `cc_use` int(11) NOT NULL DEFAULT '0',
  `cc_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cc_pref_term` int(11) NOT NULL,
  `cc_origin` char(20) NOT NULL,
  `cc_update` date NOT NULL,
  `cc_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1220 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rdf_concept`
--
ALTER TABLE `rdf_concept`
 ADD UNIQUE KEY `id_c` (`id_cc`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rdf_concept`
--
ALTER TABLE `rdf_concept`
MODIFY `id_cc` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1220;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
