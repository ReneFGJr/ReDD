-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 18-Jan-2017 às 20:41
-- Versão do servidor: 5.7.11
-- PHP Version: 5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `redd`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `researcher`
--

CREATE TABLE `researcher` (
  `id_r` bigint(20) UNSIGNED NOT NULL,
  `r_name` char(250) NOT NULL,
  `r_xml` char(250) NOT NULL,
  `r_lastupdate` date NOT NULL,
  `r_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `r_lattes` char(250) NOT NULL,
  `r_status` int(11) NOT NULL DEFAULT '1',
  `r_harvesting` date NOT NULL,
  `r_lattes_id` char(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `researcher`
--

INSERT INTO `researcher` (`id_r`, `r_name`, `r_xml`, `r_lastupdate`, `r_created`, `r_lattes`, `r_status`, `r_harvesting`, `r_lattes_id`) VALUES
(1, 'Rene Faustino Gabriel Junior', 'http://buscacv.cnpq.br/buscacv/rest/download/curriculo/K4518324E6', '0000-00-00', '2016-12-27 14:14:37', 'http://lattes.cnpq.br/5900345665779424', 1, '2017-01-17', ''),
(7, 'Valdir José Morigi', 'http://buscacv.cnpq.br/buscacv/rest/download/curriculo/K4785542J2', '0000-00-00', '2017-01-17 01:18:32', 'http://lattes.cnpq.br/6542370154854198', 1, '2017-01-17', ''),
(8, 'Rafael Port da Rocha', 'http://buscacv.cnpq.br/buscacv/rest/download/curriculo/K4782513D4', '2016-09-15', '2017-01-17 01:21:00', 'http://lattes.cnpq.br/5118387541734094', 1, '2017-01-17', '5118387541734094'),
(4, 'Samile Andréa de Souza Vanz', 'http://buscacv.cnpq.br/buscacv/rest/download/curriculo/K4702339P2', '2017-01-11', '2016-12-27 15:40:49', 'http://lattes.cnpq.br/5243732207004083', 1, '2017-01-17', '5243732207004083'),
(5, 'Sonia Elisa Caregnato', 'http://buscacv.cnpq.br/buscacv/rest/download/curriculo/K4793334D8', '2016-12-27', '2016-12-27 15:42:14', 'http://lattes.cnpq.br/5627209208288722', 1, '2017-01-04', '5627209208288722'),
(9, 'Ana Maria Mielniczuk de Moura', 'http://buscacv.cnpq.br/buscacv/rest/download/curriculo/K4721430J0', '2016-09-22', '2017-01-17 01:22:12', 'http://lattes.cnpq.br/1734997653639992', 1, '2017-01-17', '1734997653639992'),
(10, 'Eliane Lourdes da Silva Moro', 'http://buscacv.cnpq.br/buscacv/rest/download/curriculo/K4705611U3', '0000-00-00', '2017-01-17 01:23:12', 'http://lattes.cnpq.br/7005124544331261', 1, '2017-01-17', ''),
(11, 'Jackson da Silva Medeiros', 'http://buscacv.cnpq.br/buscacv/rest/download/curriculo/K4233965D6', '2016-12-23', '2017-01-17 01:24:03', 'http://lattes.cnpq.br/4182663628298542', 1, '2017-01-17', '4182663628298542'),
(12, 'Rita do Carmo Ferreira Laipelt', 'http://buscacv.cnpq.br/buscacv/rest/download/curriculo/K4137882J9', '2016-09-06', '2017-01-17 01:25:03', 'http://lattes.cnpq.br/3995942647359410', 1, '2017-01-17', '3995942647359410'),
(13, 'Rodrigo Silva Caxias de Sousa', 'http://buscacv.cnpq.br/buscacv/rest/download/curriculo/K4774549E5', '0000-00-00', '2017-01-17 01:25:59', 'http://lattes.cnpq.br/0569672544113959', 1, '2017-01-17', ''),
(14, 'Marcia Heloisa Tavares de Figueredo Lima', 'http://buscacv.cnpq.br/buscacv/rest/download/curriculo/K4787589U6', '2017-01-13', '2017-01-17 02:29:16', ' http://lattes.cnpq.br/6563330119993372', 1, '2017-01-17', '6563330119993372'),
(15, 'Moisés Rockembach', 'http://buscacv.cnpq.br/buscacv/rest/download/curriculo/K4537799H9', '0000-00-00', '2017-01-17 17:09:03', 'http://lattes.cnpq.br/1304688580274983', 1, '0000-00-00', ''),
(16, 'Maria do Rocio Fontoura Teixeira', 'http://buscacv.cnpq.br/buscacv/rest/download/curriculo/K4778868D1', '0000-00-00', '2017-01-17 17:12:33', 'http://lattes.cnpq.br/6975295280564336', 1, '0000-00-00', '');

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
  MODIFY `id_r` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
