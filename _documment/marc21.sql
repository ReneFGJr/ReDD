-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 22, 2018 at 07:45 PM
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

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('2efbr6dt83nmnq09a3sqk6sfm9f695kn', '::1', 1542738728, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323733383432393b),
('3p6qfcfl0hpcbcmdf9b9up7frk3i369h', '::1', 1542737945, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323733373638333b),
('4qg1h4vu6rtq0ndib092b51fl65rf1ol', '::1', 1542816848, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323831363733333b),
('6edng7tjr8l26cdr9s7ost700lag919o', '::1', 1542736882, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323733363639343b),
('6nfck1avvdvvvob6pm1l7t66pbigk3gh', '::1', 1542728976, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323732383639383b),
('8lt84s1dtd03gjdap6td88qqu2jal19s', '::1', 1542741438, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323734313134323b),
('9hs2iqc3k6at84ianhph3p14n69ufptl', '::1', 1542817234, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323831373138393b),
('ad0nahecjc8elvjqv3j7cbm8uoupdcuh', '::1', 1542736364, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323733363139353b),
('cue8dt6pq0tga62182fve03audckcbf6', '::1', 1542737664, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323733373337383b),
('dhejst05n1fhffuu2si2qcqltvqie76u', '::1', 1542742950, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323734323636343b),
('e36mlheb9o9rs6emepnvlqv8l8soqv17', '::1', 1542739359, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323733393038333b),
('en0nck88bkfc122vlhovomde6vknjvdm', '::1', 1542735833, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323733353730303b),
('f3hghu0kvq9e5bramjvdd3nfqebcg2er', '::1', 1542728686, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323732383338363b),
('fl77sdg104eailb2m4cmomesibls118a', '::1', 1542738320, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323733383036373b),
('hfpbah8dbv3eonceunfvl5oafh3q7s1v', '::1', 1542737347, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323733373034373b),
('hp5n4qqb39skgp6j8656oop5srfpe8a0', '::1', 1542739692, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323733393431363b),
('ju05gdnhbrs1v9t83dhfm2jd2mdoimjq', '::1', 1542735071, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323733343835393b),
('jvrm6e9kl4qteqcegi1n6mpok2rgbfpd', '::1', 1542745059, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323734343936323b),
('k1nn8k902f076i1ne24qv35dhhj48076', '::1', 1542740691, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323734303433383b),
('k4ti03scknsieo80s3lq3bgj91jq0gku', '::1', 1542744934, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323734343635383b),
('l592qbogg33nhef4sj5sq7hn9d2vbmil', '::1', 1542734763, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323733343535373b),
('ll0vlcgbj4b016kuqvgaqvsm2mn8ekcr', '::1', 1542735377, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323733353336353b),
('o7sebo2o77psb7ju0uuabhqri5l74cni', '::1', 1542729269, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323732393036383b),
('oscfkp39990grikiamo4qjqb0jliq2mc', '::1', 1542740401, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323734303132333b),
('pa3i6li08uebgjcgct6ulltsnc0odoo8', '::1', 1542741053, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323734303832353b),
('po1iksuh8jgiojlttur2t2hp2tcvkqn1', '::1', 1542744003, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323734333935393b),
('psl4gimlog4vfpe3ur2aff5pchufkljn', '::1', 1542743270, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323734323937343b),
('qs2b9r882jpctl4ngnu1114deqkr9r0q', '::1', 1542739035, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323733383736383b),
('sbgftcfh67vr2r7s6gsv1dmn9o628pal', '::1', 1542743875, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323734333631303b),
('tlgl7336m6hbclr24nsg2qf8q8viilbq', '::1', 1542741600, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323734313438303b),
('ubnul5dle5q7kpjq7bceduq1flrhvqsb', '::1', 1542739885, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323733393737343b),
('v10df25e230bqjhnb4n1hjjg14epesqs', '::1', 1542743491, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534323734333237363b);

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

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id_us` bigint(20) unsigned NOT NULL,
  `us_nome` char(80) COLLATE utf8_unicode_ci NOT NULL,
  `us_email` char(80) COLLATE utf8_unicode_ci NOT NULL,
  `us_cidade` char(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `us_pais` char(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `us_codigo` char(7) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `us_link` char(80) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `us_ativo` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `us_nivel` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `us_image` text COLLATE utf8_unicode_ci,
  `us_genero` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `us_verificado` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `us_autenticador` char(3) COLLATE utf8_unicode_ci NOT NULL,
  `us_cadastro` int(11) DEFAULT NULL,
  `us_revisoes` int(11) NOT NULL,
  `us_colaboracoes` int(11) NOT NULL,
  `us_acessos` int(11) NOT NULL,
  `us_pesquisa` int(11) NOT NULL,
  `us_erros` int(11) NOT NULL,
  `us_outros` int(11) NOT NULL,
  `us_last` int(11) NOT NULL,
  `us_perfil` text COLLATE utf8_unicode_ci NOT NULL,
  `us_login` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `us_password` char(40) COLLATE utf8_unicode_ci NOT NULL,
  `us_perfil_check` char(25) COLLATE utf8_unicode_ci NOT NULL,
  `us_institution` char(30) COLLATE utf8_unicode_ci NOT NULL,
  `us_badge` char(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_us`, `us_nome`, `us_email`, `us_cidade`, `us_pais`, `us_codigo`, `us_link`, `us_ativo`, `us_nivel`, `us_image`, `us_genero`, `us_verificado`, `us_autenticador`, `us_cadastro`, `us_revisoes`, `us_colaboracoes`, `us_acessos`, `us_pesquisa`, `us_erros`, `us_outros`, `us_last`, `us_perfil`, `us_login`, `us_password`, `us_perfil_check`, `us_institution`, `us_badge`) VALUES
(1, 'Administrador', 'admin', '', '', '0000001', '', '1', '9', '', 'M', '1', '0', 20140706, 0, 0, 400, 0, 0, 0, 20170715, '#ADM', 'admin', '21232f297a57a5a743894a0e4a801fc3', '', '', '00001'),
(6, 'Rene Faustino Gabriel Junior', 'renefgj@gmail.com', '', '', '', '', '1', NULL, NULL, NULL, NULL, 'MD5', NULL, 0, 0, 0, 0, 0, 0, 0, '', 'renefgj@gmail.com', 'f72209d26501af510a55d68e03c32936', '1679091c5a880faf6fb5e6087', 'UFRGS', '00006');

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
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD UNIQUE KEY `id_us` (`id_us`);

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
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id_us` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
