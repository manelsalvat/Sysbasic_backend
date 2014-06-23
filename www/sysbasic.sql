-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 19-06-2014 a les 20:36:20
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

CREATE TABLE IF NOT EXISTS `categorias` (
  `codigo` smallint(3) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de la taula `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `nif` varchar(9) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `CP` int(5) DEFAULT NULL,
  `poblacion` varchar(30) DEFAULT NULL,
  `telefono` int(9) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `imagen` varchar(10) DEFAULT NULL,
  `domicilio_pago` varchar(24) DEFAULT NULL,
  `activo` enum('SI','NO') DEFAULT NULL,
  `tipo_cliente` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`nif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de la taula `documentos`
--

CREATE TABLE IF NOT EXISTS `documentos` (
  `tipo` enum('PRE','PED','FAC') DEFAULT NULL,
  `numero` int(10) NOT NULL,
  `fecha` date DEFAULT NULL,
  `importe` decimal(8,2) DEFAULT NULL,
  `nif_usuario` varchar(9) DEFAULT NULL,
  `nif_cliente` varchar(9) DEFAULT NULL,
  PRIMARY KEY (`numero`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de la taula `facturas`
--

CREATE TABLE IF NOT EXISTS `facturas` (
  `numero_documento` int(10) NOT NULL DEFAULT '0',
  `numero_factura` int(10) NOT NULL,
  `tipo_de_pago` varchar(20) DEFAULT NULL,
  `vencimiento` date DEFAULT NULL,
  `domicilio_pago` varchar(24) DEFAULT NULL,
  PRIMARY KEY (`numero_documento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de la taula `matriz_iva`
--

CREATE TABLE IF NOT EXISTS `matriz_iva` (
  `id_tipo_iva` smallint(1) DEFAULT NULL,
  `id_tipo_cliente` smallint(1) DEFAULT NULL,
  `porcentaje_iva` smallint(2) DEFAULT NULL,
  `porcentaje_recargo_equivalencia` smallint(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de la taula `pedidos`
--

CREATE TABLE IF NOT EXISTS `pedidos` (
  `numero_documento` int(10) NOT NULL DEFAULT '0',
  `numero_pedido` int(10) NOT NULL,
  `direccion_entrega_pedido` varchar(50) DEFAULT NULL,
  `CP_entrega_pedido` int(5) DEFAULT NULL,
  `poblacion_entrega_pedido` varchar(30) DEFAULT NULL,
  `telefono_entrega_pedido` int(9) DEFAULT NULL,
  PRIMARY KEY (`numero_documento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de la taula `presupuestos`
--

CREATE TABLE IF NOT EXISTS `presupuestos` (
  `numero_documento` int(10) NOT NULL DEFAULT '0',
  `numero_presupuesto` int(10) NOT NULL,
  `dias_de_validez_presupuesto` smallint(3) DEFAULT NULL,
  PRIMARY KEY (`numero_documento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de la taula `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `codigo` int(10) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `marca` varchar(30) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `precio` decimal(8,2) DEFAULT NULL,
  `id_iva` smallint(1) DEFAULT NULL,
  `descuento` decimal(4,2) DEFAULT NULL,
  `unidad_de_medida` varchar(10) DEFAULT NULL,
  `estoc` int(10) DEFAULT NULL,
  `vendible` enum('SI','NO') DEFAULT NULL,
  `favorito` enum('SI','NO') DEFAULT NULL,
  `id_categoria` smallint(3) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de la taula `productos_por_documento`
--

CREATE TABLE IF NOT EXISTS `productos_por_documento` (
  `numero_documento` int(10) NOT NULL,
  `codigo_producto` int(10) NOT NULL,
  `nombre_producto` varchar(30) DEFAULT NULL,
  `marca_producto` varchar(30) DEFAULT NULL,
  `descripcion_producto` varchar(255) DEFAULT NULL,
  `precio_producto` decimal(8,2) DEFAULT NULL,
  `cantidad` int(6) DEFAULT NULL,
  `iva` decimal(4,2) DEFAULT NULL,
  `recargo_equivalencia` decimal(4,2) DEFAULT NULL,
  `descuento` decimal(4,2) DEFAULT NULL,
  PRIMARY KEY (`numero_documento`,`codigo_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de la taula `proveedores`
--

CREATE TABLE IF NOT EXISTS `proveedores` (
  `nif` varchar(9) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `CP` int(5) DEFAULT NULL,
  `poblacion` varchar(30) DEFAULT NULL,
  `telefono` int(9) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `imagen` varchar(10) DEFAULT NULL,
  `persona_de_contacto` varchar(30) DEFAULT NULL,
  `activo` enum('SI','NO') DEFAULT NULL,
  PRIMARY KEY (`nif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de la taula `tipo_cliente`
--

CREATE TABLE IF NOT EXISTS `tipo_cliente` (
  `id_tipo` smallint(1) NOT NULL,
  `nombre_tipo` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de la taula `tipo_iva`
--

CREATE TABLE IF NOT EXISTS `tipo_iva` (
  `id_tipo` smallint(1) NOT NULL,
  `nombre_tipo` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de la taula `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `nif` varchar(9) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `CP` int(5) DEFAULT NULL,
  `poblacion` varchar(30) DEFAULT NULL,
  `telefono` int(9) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `imagen` varchar(10) DEFAULT NULL,
  `domicilio_pago` varchar(24) DEFAULT NULL,
  `tipo_cliente` smallint(1) DEFAULT NULL,
  `activo` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`nif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
