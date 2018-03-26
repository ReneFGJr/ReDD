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
-- Table structure for table `rdf_data`
--

CREATE TABLE IF NOT EXISTS `rdf_data` (
`id_d` bigint(20) unsigned NOT NULL,
  `d_r1` int(11) NOT NULL,
  `d_p` int(11) NOT NULL,
  `d_r2` int(11) NOT NULL,
  `d_literal` int(11) NOT NULL DEFAULT '0',
  `d_creadted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4097 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rdf_data`
--
ALTER TABLE `rdf_data`
 ADD UNIQUE KEY `id_d` (`id_d`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rdf_data`
--
ALTER TABLE `rdf_data`
MODIFY `id_d` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4097;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
