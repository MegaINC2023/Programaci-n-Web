-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-10-2022 a las 23:28:49
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

CREATE DATABASE login;

use login;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `login`
--

-- --------------------------------------------------------

--



-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `cedula` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `chofer` (
  `ci` int(11) NOT NULL,
  `licencia` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombreComp` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `camion` (
  `matricula` varchar(11) NOT NULL,
  `estado` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pesoMax` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `paquetes` (
  `id_paquete` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `estado` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomb_calle` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_calle` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `departamento` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `localidad` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_registro` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `lotes` (
  `id_lotes` int(11) PRIMARY KEY AUTO_INCREMENT,
  `estado` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peso` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `almacen` (
  `id_almacen` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `empresa` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomb_calle` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_calle` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `localidad` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
--
-- Volcado de datos para la tabla `usuarios`
--



--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cedula` (`cedula`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;