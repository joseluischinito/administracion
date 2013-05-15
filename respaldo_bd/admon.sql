-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2013 at 08:07 AM
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cuenta`
--

CREATE TABLE IF NOT EXISTS `cuenta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `activo_pasivo` smallint(6) NOT NULL,
  `tipo` smallint(6) NOT NULL,
  `padre_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`),
  KEY `fk_Cuenta_Cuenta1_idx` (`padre_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cuentae`
--

CREATE TABLE IF NOT EXISTS `cuentae` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `tipo` smallint(6) NOT NULL,
  `padre_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cuentaE_cuentaE1_idx` (`padre_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `empresa`
--

CREATE TABLE IF NOT EXISTS `empresa` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `empleados` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `empresa`
--

INSERT INTO `empresa` (`id`, `nombre`, `empleados`) VALUES
(1, 'Galletas D&iacute;az', 1),
(2, 'Facebook Inc.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `estado_resultados`
--

CREATE TABLE IF NOT EXISTS `estado_resultados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_id` smallint(6) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_inicio_periodo` date NOT NULL,
  `fecha_fin_periodo` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Estado_Resultados_Empresa1_idx` (`empresa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `operacioe`
--

CREATE TABLE IF NOT EXISTS `operacioe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad` double DEFAULT NULL,
  `cuentaE_id` int(11) NOT NULL,
  `estado_resultados_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_operacioE_cuentaE1_idx` (`cuentaE_id`),
  KEY `fk_operacioE_Estado_Resultados1_idx` (`estado_resultados_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `operaciont`
--

CREATE TABLE IF NOT EXISTS `operaciont` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cargo_abono` smallint(6) NOT NULL,
  `monto_operacion` double NOT NULL DEFAULT '0',
  `cuenta_id` int(11) NOT NULL,
  `balance_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_operacionT_Cuenta1_idx` (`cuenta_id`),
  KEY `fk_operacionT_Balance1_idx` (`balance_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(70) NOT NULL,
  `apellido_paterno` varchar(70) NOT NULL,
  `apellico_materno` varchar(50) DEFAULT NULL,
  `nombre_usuario` varchar(30) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(140) NOT NULL,
  `tipo` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_usuario_UNIQUE` (`nombre_usuario`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido_paterno`, `apellico_materno`, `nombre_usuario`, `password`, `email`, `tipo`) VALUES
(1, 'Henoc', 'D&iacute;az', 'Hern&aacute;ndez', 'henocdz', '4c9f2b24b98bbe69cdeb1ba1d76194cd', 'hdz@rfdz.mx', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `balance`
--
ALTER TABLE `balance`
  ADD CONSTRAINT `fk_Balance_Empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `cuenta`
--
ALTER TABLE `cuenta`
  ADD CONSTRAINT `fk_Cuenta_Cuenta1` FOREIGN KEY (`padre_id`) REFERENCES `cuenta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `cuentae`
--
ALTER TABLE `cuentae`
  ADD CONSTRAINT `fk_cuentaE_cuentaE1` FOREIGN KEY (`padre_id`) REFERENCES `cuentae` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `estado_resultados`
--
ALTER TABLE `estado_resultados`
  ADD CONSTRAINT `fk_Estado_Resultados_Empresa1` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `operacioe`
--
ALTER TABLE `operacioe`
  ADD CONSTRAINT `fk_operacioE_cuentaE1` FOREIGN KEY (`cuentaE_id`) REFERENCES `cuentae` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_operacioE_Estado_Resultados1` FOREIGN KEY (`estado_resultados_id`) REFERENCES `estado_resultados` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `operaciont`
--
ALTER TABLE `operaciont`
  ADD CONSTRAINT `fk_operacionT_Balance1` FOREIGN KEY (`balance_id`) REFERENCES `balance` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_operacionT_Cuenta1` FOREIGN KEY (`cuenta_id`) REFERENCES `cuenta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
