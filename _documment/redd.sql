-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 02, 2017 at 12:08 PM
-- Server version: 5.6.20-log
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `redd`
--

-- --------------------------------------------------------

--
-- Table structure for table `researcher`
--

CREATE TABLE IF NOT EXISTS `researcher` (
`id_r` bigint(20) unsigned NOT NULL,
  `r_name` char(250) NOT NULL,
  `r_xml` char(250) NOT NULL,
  `r_lastupdate` timestamp NOT NULL,
  `r_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `r_lattes` char(250) NOT NULL,
  `r_status` int(11) NOT NULL DEFAULT '1',
  `r_harvesting` date NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `researcher`
--

INSERT INTO `researcher` (`id_r`, `r_name`, `r_xml`, `r_lastupdate`, `r_created`, `r_lattes`, `r_status`, `r_harvesting`) VALUES
(1, 'Rene Faustino Gabriel Junior', 'http://buscacv.cnpq.br/buscacv/rest/download/curriculo/K4518324E6', '2016-12-27 14:14:37', '2016-12-27 14:14:37', 'http://lattes.cnpq.br/5900345665779424', 1, '0000-00-00'),
(2, 'Adriana Coelho Borges Kowarick', 'http://buscacv.cnpq.br/buscacv/rest/download/curriculo/K4783268Z4', '2016-12-27 14:17:11', '2016-12-27 14:17:11', 'http://lattes.cnpq.br/2342595417529352', 1, '0000-00-00'),
(3, 'Alexandre Rocha da Silva', 'http://buscacv.cnpq.br/buscacv/rest/download/curriculo/K4700304Y9', '2016-12-27 14:29:05', '2016-12-27 14:29:05', 'http://lattes.cnpq.br/6382569996199325', 1, '0000-00-00'),
(4, 'Samile Andréa de Souza Vanz', 'http://buscacv.cnpq.br/buscacv/rest/download/curriculo/K4702339P2', '2016-12-27 15:40:49', '2016-12-27 15:40:49', 'http://lattes.cnpq.br/5243732207004083', 1, '0000-00-00'),
(5, 'Sonia Elisa Caregnato', 'http://buscacv.cnpq.br/buscacv/rest/download/curriculo/K4793334D8', '2016-12-27 15:42:14', '2016-12-27 15:42:14', 'http://lattes.cnpq.br/5627209208288722', 1, '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `researcher`
--
ALTER TABLE `researcher`
 ADD UNIQUE KEY `id_r` (`id_r`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `researcher`
--
ALTER TABLE `researcher`
MODIFY `id_r` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
