-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 14, 2018 at 10:36 AM
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
-- Table structure for table `rdf_form_class`
--

CREATE TABLE IF NOT EXISTS `rdf_form_class` (
`id_sc` bigint(20) unsigned NOT NULL,
  `sc_class` int(11) NOT NULL,
  `sc_propriety` int(11) NOT NULL,
  `sc_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sc_range` int(11) NOT NULL,
  `sc_ativo` int(11) NOT NULL DEFAULT '1',
  `sc_ord` int(11) NOT NULL DEFAULT '99'
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rdf_form_class`
--
ALTER TABLE `rdf_form_class`
 ADD UNIQUE KEY `id_sc` (`id_sc`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rdf_form_class`
--
ALTER TABLE `rdf_form_class`
MODIFY `id_sc` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=48;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
