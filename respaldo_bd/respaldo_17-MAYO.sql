-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2013 at 08:04 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `admon`
--

-- --------------------------------------------------------

--
-- Table structure for table `balance`
--

CREATE TABLE IF NOT EXISTS `balance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_id` smallint(6) NOT NULL,
  `denominacion` varchar(45) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_inicio_periodo` date NOT NULL,
  `fecha_fin_periodo` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Balance_Empresa_idx` (`empresa_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `balance`
--

INSERT INTO `balance` (`id`, `empresa_id`, `denominacion`, `fecha_creacion`, `fecha_inicio_periodo`, `fecha_fin_periodo`) VALUES
(2, 1, 'MX', '2013-05-15 00:00:00', '2013-05-01', '2013-05-31'),
(4, 1, 'MX', '2013-05-15 23:47:43', '2013-05-01', '2013-05-02'),
(5, 1, 'MX', '2013-05-15 23:59:13', '2013-07-01', '2013-07-31'),
(6, 1, 'MX', '2013-05-16 03:55:30', '2013-06-01', '2013-06-30'),
(7, 1, 'MX', '2013-05-16 04:00:47', '2013-05-02', '2013-05-30'),
(8, 1, 'MX', '2013-05-17 05:20:43', '2012-12-01', '2012-12-31');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `balance`
--
ALTER TABLE `balance`
  ADD CONSTRAINT `fk_Balance_Empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
