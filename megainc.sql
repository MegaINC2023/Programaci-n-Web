-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 17-10-2023 a las 20:12:35
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

create database megainc;
use megainc;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `megainc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE `almacen` (
  `id_almacen` int(10) NOT NULL,
  `id_empresa` int(10) NOT NULL,
  `calle` varchar(50) NOT NULL,
  `numero` int(10) NOT NULL,
  `localidad` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`id_almacen`, `id_empresa`, `calle`, `numero`, `localidad`) VALUES
(34, 1, 'Brasil', 652, 'Salto'),
(130, 1, 'Independencia', 2532, 'Pando'),
(234, 1, 'Paysandu', 1542, 'Rivera'),
(444, 1, '8 de octubre', 2054, 'Montevideo'),
(445, 2, '18 de Julio', 344, 'Montevideo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `camion`
--

CREATE TABLE `camion` (
  `matricula` varchar(10) NOT NULL,
  `peso_max` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `camion`
--

INSERT INTO `camion` (`matricula`, `peso_max`) VALUES
('CTP 5974', '31 ton'),
('JTP 4458', '23 ton'),
('ZTP 5139', '31 ton');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `camioneta`
--

CREATE TABLE `camioneta` (
  `matricula` varchar(10) NOT NULL,
  `peso_max` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `camioneta`
--

INSERT INTO `camioneta` (`matricula`, `peso_max`) VALUES
('HTP 2681', '5 ton'),
('HTP 8542', '5 ton');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chofer`
--

CREATE TABLE `chofer` (
  `cedula` int(10) NOT NULL,
  `licencia` varchar(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `chofer`
--

INSERT INTO `chofer` (`cedula`, `licencia`, `nombre`, `apellido`) VALUES
(17438941, 'C , D', 'Sofia', 'Ramirez'),
(29848642, 'D', 'Mario', 'Ramirez'),
(54897452, 'D', 'Jose', 'Gonzales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion`
--

CREATE TABLE `direccion` (
  `id_paquete` int(10) NOT NULL,
  `calle` varchar(20) NOT NULL,
  `numero` int(10) NOT NULL,
  `localidad` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `direccion`
--

INSERT INTO `direccion` (`id_paquete`, `calle`, `numero`, `localidad`) VALUES
(124556, 'Jose pedro varela', 688, 'Melo'),
(154662, 'Lorenzo Latorre', 16, 'Empalme olmos'),
(413255, 'Av. Sarandi', 1102, 'Rivera'),
(432551, 'Diego Lamas', 1172, 'Rivera'),
(543264, '25 de agosto', 808, 'Pando'),
(543678, 'Agraciada', 810, 'Rivera'),
(614436, '19 de abril', 651, 'Salto'),
(652466, 'Artigas', 2268, 'Salto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id_empresa` int(10) NOT NULL,
  `empresa` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id_empresa`, `empresa`) VALUES
(1, 'quick carry'),
(2, 'crecom');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrega`
--

CREATE TABLE `entrega` (
  `id_paquete` int(10) NOT NULL,
  `matricula` int(10) NOT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `hora_entrega` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `entrega`
--

INSERT INTO `entrega` (`id_paquete`, `matricula`, `fecha_entrega`, `hora_entrega`) VALUES
(413255, 0, '0000-00-00', '00:00:00'),
(432551, 0, '0000-00-00', '00:00:00'),
(543264, 0, '2023-09-05', '15:30:00'),
(614436, 0, '2023-05-05', '15:30:00'),
(652466, 0, '2023-09-05', '13:30:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidad`
--

CREATE TABLE `localidad` (
  `localidad` varchar(20) NOT NULL,
  `departamento` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `localidad`
--

INSERT INTO `localidad` (`localidad`, `departamento`) VALUES
('Empalme olmos', 'Canelones'),
('Melo', 'Cerro Largo'),
('Pando', 'Canelones'),
('Rivera', 'Rivera'),
('Salto', 'Salto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `id_usuario` int(10) NOT NULL,
  `tipo_de_usuario` varchar(15) DEFAULT NULL,
  `cedula` int(10) DEFAULT NULL,
  `contraseña` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `login` (`id_usuario`, `tipo_de_usuario`, `cedula`, `contraseña`) VALUES
(1, 'admin', '55555', '$2y$10$/UjfZIXqEUL4BWyofhniGOdi/kaQeeGYVDw9zsmCCBEi6TwtXlFZG'),
(2, 'chofer', '4444', '$2y$10$HQ/0wu3uzvBj5KPIicJiFOjtX29rLZJzO0ijSPNn08QpDa4YOrDWa'),
(3, 'almacenista', '333', '$2y$10$WAh5ypic2Me2jU830ozDB.AfBjnxZ6r4eVMjNMB4xTgb9fs0h4.0.'),
(4, 'administracion', '666666', '$2y$10$NH7BfZoPG9LkBYdw3j9JnOIXM2JHMVTFkT57i0wqkGym317eqwvdG');
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote`
--

CREATE TABLE `lote` (
  `id_lote` int(10) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `peso` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lote`
--

INSERT INTO `lote` (`id_lote`, `estado`, `peso`) VALUES
(23452, 'En viaje', '100 kg'),
(44512, 'En viaje', '134 kg'),
(53151, 'Entregado', '200 kg'),
(65312, 'En espera', '30 kg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maneja`
--

CREATE TABLE `maneja` (
  `cedula` int(10) NOT NULL,
  `matricula` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `maneja`
--

INSERT INTO `maneja` (`cedula`, `matricula`) VALUES
(17438941, 'JTP 4458'),
(29848642, 'CTP 5974'),
(54897452, 'ZTP 5139');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquete`
--

CREATE TABLE `paquete` (
  `id_paquete` int(10) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `fecha_registro` date NOT NULL,
  `tipo` varchar(20) DEFAULT NULL,
  `fragil` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paquete`
--

INSERT INTO `paquete` (`id_paquete`, `estado`, `fecha_registro`, `tipo`, `fragil`) VALUES
(124556, 'Entregado', '2023-09-11', 'Mueble', 'no'),
(154662, 'En espera', '2023-09-04', 'Electronico', 'si'),
(413255, 'En viaje', '2023-09-04', 'Mueble', 'no'),
(432551, 'En viaje', '2023-08-31', 'Electronico', 'si'),
(543264, 'En viaje', '2023-08-20', 'Mueble', 'no'),
(543678, 'Entregado', '2023-06-20', 'Indumentaria', 'no'),
(614436, 'Entregado', '2023-09-06', 'Mueble', 'si'),
(652466, 'Entregado', '2023-08-20', 'Electronico', 'si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pertenece`
--

CREATE TABLE `pertenece` (
  `id_paquete` int(10) NOT NULL,
  `id_lote` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pertenece`
--

INSERT INTO `pertenece` (`id_paquete`, `id_lote`) VALUES
(413255, 23452),
(432551, 44512),
(543264, 44512),
(614436, 53151),
(652466, 53151);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `realiza`
--

CREATE TABLE `realiza` (
  `id_lote` int(10) NOT NULL,
  `id_almacen` int(10) NOT NULL,
  `id_trayecto` int(10) NOT NULL,
  `matricula` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `realiza`
--

INSERT INTO `realiza` (`id_lote`, `id_almacen`, `id_trayecto`, `matricula`) VALUES
(53151, 34, 102, 'CTP 5974'),
(23452, 234, 101, 'JTP 4458'),
(44512, 130, 102, 'ZTP 5139');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiene`
--

CREATE TABLE `tiene` (
  `id_trayecto` int(10) NOT NULL,
  `id_almacen` int(10) NOT NULL,
  `posicion` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tiene`
--

INSERT INTO `tiene` (`id_trayecto`, `id_almacen`, `posicion`) VALUES
(101, 130, 'trasbordo'),
(101, 234, 'destino'),
(101, 444, 'origen'),
(102, 34, 'destino'),
(102, 130, 'trasbordo'),
(102, 444, 'origen');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trayecto`
--

CREATE TABLE `trayecto` (
  `id_trayecto` int(10) NOT NULL,
  `origen` varchar(100) NOT NULL,
  `destino` varchar(100) NOT NULL,
  `distancia` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `trayecto`
--

INSERT INTO `trayecto` (`id_trayecto`, `origen`, `destino`, `distancia`) VALUES
(101, '444', '234', '506km'),
(102, '444', '34', '491km');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE `vehiculo` (
  `matricula` varchar(10) NOT NULL,
  `licencia` varchar(10) DEFAULT NULL,
  `estado` varchar(50) NOT NULL,
  `peso_max` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vehiculo`
--

INSERT INTO `vehiculo` (`matricula`, `licencia`, `estado`, `peso_max`) VALUES
('CTP 5974', 'D', 'Transportando', '31 ton'),
('HTP 2621', 'C', 'No disponible', '5 ton'),
('HTP 2681', 'D', 'No disponible', '25 ton'),
('HTP 8542', 'C', 'En Viaje', '5 ton'),
('JTP 4458', 'D', 'Transportando', '23 ton'),
('ZTP 5139', 'D', 'Disponible', '31 ton');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viaja`
--

CREATE TABLE `viaja` (
  `id_lote` int(10) NOT NULL,
  `id_almacen` int(10) NOT NULL,
  `id_trayecto` int(10) NOT NULL,
  `fecha_llegada` date DEFAULT NULL,
  `hora_llegada` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `viaja`
--

INSERT INTO `viaja` (`id_lote`, `id_almacen`, `id_trayecto`, `fecha_llegada`, `hora_llegada`) VALUES
(23452, 234, 0, '0000-00-00', '00:00:00'),
(44512, 130, 101, '0000-00-00', '00:00:00'),
(44512, 234, 0, '0000-00-00', '00:00:00'),
(53151, 34, 102, '2023-09-01', '08:35:00'),
(53151, 130, 102, '2023-08-28', '17:00:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD PRIMARY KEY (`id_almacen`),
  ADD KEY `fk_empresa` (`id_empresa`);

--
-- Indices de la tabla `camion`
--
ALTER TABLE `camion`
  ADD PRIMARY KEY (`matricula`);

--
-- Indices de la tabla `camioneta`
--
ALTER TABLE `camioneta`
  ADD PRIMARY KEY (`matricula`);

--
-- Indices de la tabla `chofer`
--
ALTER TABLE `chofer`
  ADD PRIMARY KEY (`cedula`);

--
-- Indices de la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD PRIMARY KEY (`id_paquete`),
  ADD KEY `fk_Dilocalidad` (`localidad`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Indices de la tabla `entrega`
--
ALTER TABLE `entrega`
  ADD PRIMARY KEY (`id_paquete`);

--
-- Indices de la tabla `localidad`
--
ALTER TABLE `localidad`
  ADD PRIMARY KEY (`localidad`,`departamento`);

--
-- Indices de la tabla `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `cedula` (`cedula`);

  ALTER TABLE `login`
  MODIFY `id_usuario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Indices de la tabla `lote`
--
ALTER TABLE `lote`
  ADD PRIMARY KEY (`id_lote`);

--
-- Indices de la tabla `maneja`
--
ALTER TABLE `maneja`
  ADD PRIMARY KEY (`cedula`,`matricula`);

--
-- Indices de la tabla `paquete`
--
ALTER TABLE `paquete`
  ADD PRIMARY KEY (`id_paquete`);

--
-- Indices de la tabla `pertenece`
--
ALTER TABLE `pertenece`
  ADD PRIMARY KEY (`id_paquete`),
  ADD KEY `fk_Plote` (`id_lote`);

--
-- Indices de la tabla `realiza`
--
ALTER TABLE `realiza`
  ADD PRIMARY KEY (`id_lote`,`id_almacen`,`id_trayecto`),
  ADD KEY `fk_Rcamion` (`matricula`);

--
-- Indices de la tabla `tiene`
--
ALTER TABLE `tiene`
  ADD PRIMARY KEY (`id_trayecto`,`id_almacen`);

--
-- Indices de la tabla `trayecto`
--
ALTER TABLE `trayecto`
  ADD PRIMARY KEY (`id_trayecto`);

--
-- Indices de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD PRIMARY KEY (`matricula`);

--
-- Indices de la tabla `viaja`
--
ALTER TABLE `viaja`
  ADD PRIMARY KEY (`id_lote`,`id_almacen`,`id_trayecto`),
  ADD KEY `fk_Valmacen` (`id_almacen`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD CONSTRAINT `fk_empresa` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id_empresa`);

--
-- Filtros para la tabla `camion`
--
ALTER TABLE `camion`
  ADD CONSTRAINT `fk_matricula` FOREIGN KEY (`matricula`) REFERENCES `vehiculo` (`matricula`);

--
-- Filtros para la tabla `camioneta`
--
ALTER TABLE `camioneta`
  ADD CONSTRAINT `fk_Ccammatricula` FOREIGN KEY (`matricula`) REFERENCES `vehiculo` (`matricula`);

--
-- Filtros para la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD CONSTRAINT `fk_Didpaquete` FOREIGN KEY (`id_paquete`) REFERENCES `paquete` (`id_paquete`),
  ADD CONSTRAINT `fk_Dilocalidad` FOREIGN KEY (`localidad`) REFERENCES `localidad` (`localidad`);

--
-- Filtros para la tabla `pertenece`
--
ALTER TABLE `pertenece`
  ADD CONSTRAINT `fk_Plote` FOREIGN KEY (`id_lote`) REFERENCES `lote` (`id_lote`);

--
-- Filtros para la tabla `realiza`
--
ALTER TABLE `realiza`
  ADD CONSTRAINT `fk_Rcamion` FOREIGN KEY (`matricula`) REFERENCES `camion` (`matricula`);

--
-- Filtros para la tabla `viaja`
--
ALTER TABLE `viaja`
  ADD CONSTRAINT `fk_Valmacen` FOREIGN KEY (`id_almacen`) REFERENCES `almacen` (`id_almacen`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
