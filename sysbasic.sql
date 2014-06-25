-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 25-06-2014 a les 18:33:22
-- Versió del servidor: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sysbasic`
--
CREATE DATABASE IF NOT EXISTS `sysbasic` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `sysbasic`;

-- --------------------------------------------------------

--
-- Estructura de la taula `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `codigo` smallint(3) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de la taula `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `nif` varchar(9) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `CP` int(5) DEFAULT NULL,
  `poblacion` varchar(30) DEFAULT NULL,
  `telefono` int(9) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `imagen` varchar(10) DEFAULT NULL,
  `domicilio_pago` varchar(24) DEFAULT NULL,
  `activo` enum('SI','NO') NOT NULL DEFAULT 'SI',
  `recargo_equivalencia` enum('SI','NO') NOT NULL DEFAULT 'NO',
  PRIMARY KEY (`nif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de la taula `documentos`
--

DROP TABLE IF EXISTS `documentos`;
CREATE TABLE IF NOT EXISTS `documentos` (
  `numero` int(10) NOT NULL AUTO_INCREMENT,
  `tipo` enum('PRE','PED','FAC') NOT NULL,
  `fecha` date NOT NULL,
  `importe` decimal(8,2) NOT NULL,
  `nif_usuario` varchar(9) NOT NULL,
  `nif_cliente` varchar(9) NOT NULL,
  PRIMARY KEY (`numero`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de la taula `facturas`
--

DROP TABLE IF EXISTS `facturas`;
CREATE TABLE IF NOT EXISTS `facturas` (
  `numero_factura` int(10) NOT NULL AUTO_INCREMENT,
  `numero_documento` int(10) NOT NULL DEFAULT '0',
  `tipo_de_pago` varchar(20) DEFAULT NULL,
  `vencimiento` date DEFAULT NULL,
  `domicilio_pago` varchar(24) DEFAULT NULL,
  PRIMARY KEY (`numero_factura`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de la taula `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE IF NOT EXISTS `pedidos` (
  `numero_pedido` int(10) NOT NULL AUTO_INCREMENT,
  `numero_documento` int(10) NOT NULL DEFAULT '0',
  `direccion_entrega_pedido` varchar(50) DEFAULT NULL,
  `CP_entrega_pedido` int(5) DEFAULT NULL,
  `poblacion_entrega_pedido` varchar(30) DEFAULT NULL,
  `telefono_entrega_pedido` int(9) DEFAULT NULL,
  PRIMARY KEY (`numero_pedido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de la taula `presupuestos`
--

DROP TABLE IF EXISTS `presupuestos`;
CREATE TABLE IF NOT EXISTS `presupuestos` (
  `numero_presupuesto` int(10) NOT NULL AUTO_INCREMENT,
  `numero_documento` int(10) NOT NULL DEFAULT '0',
  `dias_de_validez_presupuesto` smallint(3) DEFAULT NULL,
  PRIMARY KEY (`numero_presupuesto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de la taula `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `codigo` int(10) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `marca` varchar(30) DEFAULT NULL,
  `descripcion` varchar(255) NOT NULL,
  `precio` decimal(8,2) NOT NULL,
  `id_iva` smallint(1) NOT NULL,
  `descuento` decimal(4,2) DEFAULT NULL,
  `unidad_de_medida` varchar(10) DEFAULT NULL,
  `estoc` int(10) DEFAULT NULL,
  `vendible` enum('SI','NO') NOT NULL DEFAULT 'SI',
  `favorito` enum('SI','NO') NOT NULL DEFAULT 'NO',
  `id_categoria` smallint(3) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de la taula `productos_por_documento`
--

DROP TABLE IF EXISTS `productos_por_documento`;
CREATE TABLE IF NOT EXISTS `productos_por_documento` (
  `numero_documento` int(10) NOT NULL,
  `codigo_producto` int(10) NOT NULL,
  `nombre_producto` varchar(30) NOT NULL,
  `marca_producto` varchar(30) DEFAULT NULL,
  `descripcion_producto` varchar(255) NOT NULL,
  `precio_producto` decimal(8,2) NOT NULL,
  `cantidad` int(6) NOT NULL,
  `iva` decimal(4,2) NOT NULL,
  `recargo_equivalencia` decimal(4,2) DEFAULT NULL,
  `descuento` decimal(4,2) DEFAULT NULL,
  PRIMARY KEY (`numero_documento`,`codigo_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de la taula `provee`
--

DROP TABLE IF EXISTS `provee`;
CREATE TABLE IF NOT EXISTS `provee` (
  `id_producto` int(10) NOT NULL,
  `id_proveedor` varchar(9) NOT NULL,
  PRIMARY KEY (`id_producto`,`id_proveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de la taula `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
CREATE TABLE IF NOT EXISTS `proveedores` (
  `nif` varchar(9) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `CP` int(5) DEFAULT NULL,
  `poblacion` varchar(30) DEFAULT NULL,
  `telefono` int(9) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `imagen` varchar(10) DEFAULT NULL,
  `persona_de_contacto` varchar(30) DEFAULT NULL,
  `activo` enum('SI','NO') NOT NULL DEFAULT 'SI',
  PRIMARY KEY (`nif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de la taula `tipo_iva`
--

DROP TABLE IF EXISTS `tipo_iva`;
CREATE TABLE IF NOT EXISTS `tipo_iva` (
  `id_tipo` smallint(1) NOT NULL AUTO_INCREMENT,
  `nombre_tipo` varchar(20) NOT NULL,
  `porcentaje` decimal(4,2) NOT NULL,
  `recargo_equivalencia` decimal(4,2) NOT NULL,
  PRIMARY KEY (`id_tipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Bolcant dades de la taula `tipo_iva`
--

INSERT INTO `tipo_iva` (`id_tipo`, `nombre_tipo`, `porcentaje`, `recargo_equivalencia`) VALUES
(1, 'general', '21.00', '5.20'),
(2, 'reducido', '10.00', '1.40'),
(3, 'superreducido', '4.00', '0.50'),
(4, 'tabaco', '21.00', '0.75');

-- --------------------------------------------------------

--
-- Estructura de la taula `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `nif` varchar(9) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `CP` int(5) DEFAULT NULL,
  `poblacion` varchar(30) DEFAULT NULL,
  `telefono` int(9) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `imagen` varchar(10) DEFAULT NULL,
  `domicilio_pago` varchar(24) DEFAULT NULL,
  `password` varchar(32) NOT NULL,
  `activo` enum('SI','NO') NOT NULL DEFAULT 'SI',
  PRIMARY KEY (`nif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Bolcant dades de la taula `usuarios`
--

INSERT INTO `usuarios` (`nif`, `nombre`, `apellidos`, `direccion`, `CP`, `poblacion`, `telefono`, `mail`, `imagen`, `domicilio_pago`, `password`, `activo`) VALUES
('38080266V', 'Josep Maria', 'Marín Salvador', 'c/ el meu carrer, 25', 8700, 'Igualada', 938041234, 'jmarinsa@gmail.com', NULL, 'ES2420770508221100223344', '27e5618d034927c42e71e422566c112a', 'SI');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
