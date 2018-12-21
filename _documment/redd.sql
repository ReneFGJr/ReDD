-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 23, 2018 at 10:21 AM
-- Server version: 5.6.20-log
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `marc21`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



-- --------------------------------------------------------

--
-- Table structure for table `marc21`
--

CREATE TABLE IF NOT EXISTS `marc21` (
`id_mc` bigint(20) unsigned NOT NULL,
  `mc_tipo` char(100) NOT NULL,
  `mc_ativo` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `marc21`
--

INSERT INTO `marc21` (`id_mc`, `mc_tipo`, `mc_ativo`) VALUES
(1, 'Controle Bibliográfico (Marc Bibliográfico)', 1),
(2, 'Controle de Autoridade (Marc Bibliográfico)', 1);

-- --------------------------------------------------------

--
-- Table structure for table `marc21_code`
--

CREATE TABLE IF NOT EXISTS `marc21_code` (
`id_c` bigint(20) unsigned NOT NULL,
  `c_tag` int(11) NOT NULL,
  `c_code` char(1) NOT NULL,
  `c_text` text NOT NULL,
  `c_status` int(1) NOT NULL DEFAULT '1',
  `c_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `marc21_code`
--

INSERT INTO `marc21_code` (`id_c`, `c_tag`, `c_code`, `c_text`, `c_status`, `c_created`) VALUES
(1, 2, 'a', 'Gabriel Junior, Rene Faustino', 0, '2018-11-20 18:37:00'),
(2, 2, 'd', '1969-', 0, '2018-11-20 18:42:29'),
(3, 4, 'a', 'a casa de papel', 0, '2018-11-20 19:17:09'),
(4, 2, 'd', '1969-', 0, '2018-11-20 19:57:31'),
(5, 10, 'a', 'Gabriel Junior, Rene Faustino', 0, '2018-11-20 19:59:56'),
(6, 10, 'd', '1969-', 0, '2018-11-20 20:00:03'),
(7, 10, 'd', '1969-', 0, '2018-11-20 20:10:58'),
(8, 11, 'a', 'Gabriel Junior, Rene Faustino', 1, '2018-11-21 16:13:07'),
(9, 11, 'd', '1969-', 1, '2018-11-21 16:13:16'),
(10, 12, 'a', 'Título da Obra', 0, '2018-11-21 16:13:49'),
(11, 12, 'b', 'subtítulo da obra', 0, '2018-11-21 16:13:58'),
(12, 12, 'a', 'Título da obra /', 1, '2018-11-21 16:20:19'),
(13, 12, 'c', 'Rene Faustino Gabriel junior', 1, '2018-11-21 16:20:34');

-- --------------------------------------------------------

--
-- Table structure for table `marc21_registro`
--

CREATE TABLE IF NOT EXISTS `marc21_registro` (
`id_m` bigint(20) unsigned NOT NULL,
  `m_user` int(11) NOT NULL,
  `m_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `m_author` text NOT NULL,
  `m_title` text NOT NULL,
  `m_year` char(6) NOT NULL,
  `m_status` int(11) NOT NULL DEFAULT '0',
  `m_ativo` int(11) NOT NULL DEFAULT '1',
  `m_type` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `marc21_registro`
--

INSERT INTO `marc21_registro` (`id_m`, `m_user`, `m_created`, `m_author`, `m_title`, `m_year`, `m_status`, `m_ativo`, `m_type`) VALUES
(1, 1, '2018-11-20 14:08:20', 'Novo registro', 'Novo registro', '', 0, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `marc21_tag`
--

CREATE TABLE IF NOT EXISTS `marc21_tag` (
`id_t` bigint(20) unsigned NOT NULL,
  `t_tag` char(3) NOT NULL,
  `t_ind1` char(1) NOT NULL,
  `t_ind2` char(1) NOT NULL,
  `t_registro` int(11) NOT NULL,
  `t_status` int(11) NOT NULL DEFAULT '1',
  `t_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `t_user` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `marc21_tag`
--

INSERT INTO `marc21_tag` (`id_t`, `t_tag`, `t_ind1`, `t_ind2`, `t_registro`, `t_status`, `t_created`, `t_user`) VALUES
(1, '245', '_', '', 1, 0, '2018-11-20 17:43:49', 1),
(2, '245', '0', '0', 1, 0, '2018-11-20 17:52:44', 1),
(3, '700', '_', '_', 1, 0, '2018-11-20 18:46:32', 1),
(4, '750', '_', '_', 1, 0, '2018-11-20 18:46:39', 1),
(5, '780', '_', '_', 1, 0, '2018-11-20 18:46:46', 1),
(6, '133', '_', '_', 1, 0, '2018-11-20 18:47:09', 1),
(7, '135', '_', '_', 1, 0, '2018-11-20 18:47:15', 1),
(8, '111', '_', '_', 1, 0, '2018-11-20 19:42:16', 1),
(9, '999', '_', '_', 1, 0, '2018-11-20 19:42:23', 1),
(10, '100', '_', '_', 1, 0, '2018-11-20 19:59:49', 1),
(11, '100', '1', '_', 1, 1, '2018-11-21 16:12:51', 1),
(12, '245', '_', '0', 1, 1, '2018-11-21 16:13:35', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
 ADD PRIMARY KEY (`id`), ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `marc21`
--
ALTER TABLE `marc21`
 ADD UNIQUE KEY `id_mc` (`id_mc`);

--
-- Indexes for table `marc21_code`
--
ALTER TABLE `marc21_code`
 ADD UNIQUE KEY `id_c` (`id_c`);

--
-- Indexes for table `marc21_registro`
--
ALTER TABLE `marc21_registro`
 ADD UNIQUE KEY `id_m` (`id_m`);

--
-- Indexes for table `marc21_tag`
--
ALTER TABLE `marc21_tag`
 ADD UNIQUE KEY `id_t` (`id_t`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `marc21`
--
ALTER TABLE `marc21`
MODIFY `id_mc` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `marc21_code`
--
ALTER TABLE `marc21_code`
MODIFY `id_c` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `marc21_registro`
--
ALTER TABLE `marc21_registro`
MODIFY `id_m` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `marc21_tag`
--
ALTER TABLE `marc21_tag`
MODIFY `id_t` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
