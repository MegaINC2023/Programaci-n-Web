-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-11-2023 a las 14:28:51
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


create database megainc;
use megainc;
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
) ;

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
('CTP 5974', '31000'),
('JTP 4458', '23000'),
('ZTP 5139', '31000');

--
-- Disparadores `camion`
--
DELIMITER $$
CREATE TRIGGER `camion_peso_max_check` BEFORE INSERT ON `camion` FOR EACH ROW BEGIN
    IF NEW.peso_max IS NOT NULL AND NEW.peso_max NOT REGEXP '^[0-9]+$' THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El campo peso_max debe contener solo valores numéricos';
    END IF;
END
$$
DELIMITER ;

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
('HTP 2681', '5000'),
('HTP 8542', '5000');

--
-- Disparadores `camioneta`
--
DELIMITER $$
CREATE TRIGGER `camioneta_peso_max_check` BEFORE INSERT ON `camioneta` FOR EACH ROW BEGIN
    IF NEW.peso_max IS NOT NULL AND NEW.peso_max NOT REGEXP '^[0-9]+$' THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El campo peso_max debe contener solo valores numéricos';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chofer`
--

CREATE TABLE `chofer` (
  `cedula` int(10) NOT NULL,
  `licencia` varchar(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL
) ;

--
-- Volcado de datos para la tabla `chofer`
--

INSERT INTO `chofer` (`cedula`, `licencia`, `nombre`, `apellido`) VALUES
(17438941, 'C', 'Sofia', 'Ramirez'),
(29848642, 'D', 'Mario', 'Ramirez'),
(54897452, 'D', 'Jose', 'Gonzales');

--
-- Disparadores `chofer`
--
DELIMITER $$
CREATE TRIGGER `chofer_licencia_check` BEFORE INSERT ON `chofer` FOR EACH ROW BEGIN
    IF NEW.licencia NOT IN ('Camion', 'Camioneta', 'D', 'C') THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Valor de licencia no válido';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `chofer_nombre_apellido_check` BEFORE INSERT ON `chofer` FOR EACH ROW BEGIN
    IF NEW.nombre REGEXP '^[A-Za-z]+$' = 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El nombre debe contener solo letras';
    END IF;

    IF NEW.apellido REGEXP '^[A-Za-z]+$' = 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El apellido debe contener solo letras';
    END IF;
END
$$
DELIMITER ;

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

--
-- Disparadores `direccion`
--
DELIMITER $$
CREATE TRIGGER `Direccion_check_numero_min_length` BEFORE INSERT ON `direccion` FOR EACH ROW BEGIN
    IF LENGTH(NEW.numero) < 3 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El campo numero debe tener al menos 3 dígitos';
    END IF;
END
$$
DELIMITER ;

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

--
-- Disparadores `empresa`
--
DELIMITER $$
CREATE TRIGGER `Empresa_check_id_empresa_positive` BEFORE INSERT ON `empresa` FOR EACH ROW BEGIN
    IF NEW.id_empresa <= 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El valor en id_empresa debe ser positivo';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrega`
--

CREATE TABLE `entrega` (
  `id_paquete` int(10) NOT NULL,
  `matricula` varchar(10) NOT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `hora_entrega` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `entrega`
--

INSERT INTO `entrega` (`id_paquete`, `matricula`, `fecha_entrega`, `hora_entrega`) VALUES
(413255, 'HTP 8542', NULL, NULL),
(432551, 'HTP 8542', NULL, NULL),
(543264, 'HTP 2681', '2023-09-05', '15:30:00'),
(614436, 'HTP 2681', '2023-05-05', '15:30:00'),
(652466, 'HTP 2681', '2023-09-05', '13:30:00');

--
-- Disparadores `entrega`
--
DELIMITER $$
CREATE TRIGGER `ValidarFechaEntrega` BEFORE INSERT ON `entrega` FOR EACH ROW BEGIN
    DECLARE fecha_registro_paquete DATE;

    -- Obtener la fecha de registro del paquete
    SELECT fecha_registro INTO fecha_registro_paquete
    FROM Paquete
    WHERE id_paquete = NEW.id_paquete;

    -- Verificar que la fecha de entrega sea posterior o igual a la fecha de registro
    IF NEW.fecha_entrega < fecha_registro_paquete THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'La fecha de entrega no puede ser anterior a la fecha de registro del paquete';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_insert_entrega` BEFORE INSERT ON `entrega` FOR EACH ROW BEGIN
  IF NEW.fecha_entrega < (SELECT fecha_registro FROM Paquete WHERE id_paquete = NEW.id_paquete) THEN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'La fecha de entrega no puede ser anterior a la fecha de registro del paquete';
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidad`
--

CREATE TABLE `localidad` (
  `localidad` varchar(20) NOT NULL,
  `departamento` varchar(20) NOT NULL
) ;

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
  `cedula` int(8) DEFAULT NULL,
  `contraseña` varchar(255) NOT NULL
) ;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`id_usuario`, `tipo_de_usuario`, `cedula`, `contraseña`) VALUES
(1, 'admin', 55555, '$2y$10$/UjfZIXqEUL4BWyofhniGOdi/kaQeeGYVDw9zsmCCBEi6TwtXlFZG'),
(2, 'chofer', 4444, '$2y$10$HQ/0wu3uzvBj5KPIicJiFOjtX29rLZJzO0ijSPNn08QpDa4YOrDWa'),
(3, 'almacenista', 333, '$2y$10$WAh5ypic2Me2jU830ozDB.AfBjnxZ6r4eVMjNMB4xTgb9fs0h4.0.'),
(4, 'administracion', 666666, '$2y$10$NH7BfZoPG9LkBYdw3j9JnOIXM2JHMVTFkT57i0wqkGym317eqwvdG');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote`
--

CREATE TABLE `lote` (
  `id_lote` int(10) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `peso` varchar(20) NOT NULL,
  `almacen_destino` int(10) DEFAULT NULL
) ;

--
-- Volcado de datos para la tabla `lote`
--

INSERT INTO `lote` (`id_lote`, `estado`, `peso`, `almacen_destino`) VALUES
(23452, 'En viaje', '100', 234),
(44512, 'En viaje', '134', 234),
(53151, 'Entregado', '200', 130),
(65312, 'En espera', '30', 34);

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
) ;

--
-- Volcado de datos para la tabla `paquete`
--

INSERT INTO `paquete` (`id_paquete`, `estado`, `fecha_registro`, `tipo`, `fragil`) VALUES
(124556, 'Entregado', '2023-09-11', 'Mueble', 'no'),
(154662, 'En espera', '2023-09-04', 'Electronico', 'si'),
(413255, 'En viaje', '2023-09-04', 'Mueble', 'no'),
(432551, 'En viaje', '2023-08-31', 'Electronico', 'si'),
(543264, 'En viaje', '2023-08-20', 'Mueble', 'no'),
(543678, 'Entregado', '2023-05-20', 'Indumentaria', 'no'),
(614436, 'Entregado', '2023-09-06', 'Mueble', 'si'),
(652466, 'Entregado', '2023-08-20', 'Electronico', 'si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pertenece`
--

CREATE TABLE `pertenece` (
  `id_paquete` int(10) NOT NULL,
  `id_lote` int(10) NOT NULL
) ;

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
) ;

--
-- Volcado de datos para la tabla `realiza`
--

INSERT INTO `realiza` (`id_lote`, `id_almacen`, `id_trayecto`, `matricula`) VALUES
(53151, 34, 102, 'CTP 5974'),
(23452, 234, 101, 'JTP 4458'),
(44512, 130, 102, 'ZTP 5139');

--
-- Disparadores `realiza`
--
DELIMITER $$
CREATE TRIGGER `CheckLoteWeight` BEFORE INSERT ON `realiza` FOR EACH ROW BEGIN
    DECLARE lote_weight DECIMAL(10, 2);
    DECLARE max_weight DECIMAL(10, 2);

    -- Obtiene el peso del lote que se va a agregar
    SELECT CAST(L.peso AS DECIMAL(10, 2))
    INTO lote_weight
    FROM Lote L
    WHERE L.id_lote = NEW.id_lote;

    -- Obtiene el peso máximo del camión al que se va a agregar el lote
    SELECT CAST(C.peso_max AS DECIMAL(10, 2))
    INTO max_weight
    FROM Camion C
    WHERE C.matricula = NEW.matricula;

    -- Comprueba si el peso del lote supera el límite del camión y lanza una excepción si es así
    IF lote_weight > max_weight THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El peso del lote supera el límite del camión';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `ChequeoPeso` BEFORE INSERT ON `realiza` FOR EACH ROW BEGIN
    DECLARE total_weight DECIMAL(10, 2);
    DECLARE max_weight DECIMAL(10, 2);

    -- Calcula la suma del peso de todos los lotes relacionados con el camión actual
    SELECT SUM(CAST(L.peso AS DECIMAL(10, 2)))
    INTO total_weight
    FROM Lote L
    WHERE L.id_lote IN (SELECT id_lote FROM Realiza WHERE matricula = NEW.matricula);

    -- Obtiene el peso máximo del camión
    SELECT CAST(C.peso_max AS DECIMAL(10, 2))
    INTO max_weight
    FROM Camion C
    WHERE C.matricula = NEW.matricula;

    -- Comprueba si la suma excede el límite del camión y lanza una excepción si es así
    IF (total_weight > max_weight) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'La suma del peso de los lotes excede el límite del camión';
    END IF;
END
$$
DELIMITER ;

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
) ;

--
-- Volcado de datos para la tabla `trayecto`
--

INSERT INTO `trayecto` (`id_trayecto`, `origen`, `destino`, `distancia`) VALUES
(101, '444', '234', '506'),
(102, '444', '34', '491');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE `vehiculo` (
  `matricula` varchar(10) NOT NULL,
  `licencia` varchar(10) DEFAULT NULL,
  `estado` varchar(50) NOT NULL,
  `peso_max` varchar(10) DEFAULT NULL
) ;

--
-- Volcado de datos para la tabla `vehiculo`
--

INSERT INTO `vehiculo` (`matricula`, `licencia`, `estado`, `peso_max`) VALUES
('CTP 5974', 'D', 'Transportando', '31000'),
('HTP 2621', 'C', 'No disponible', '5000'),
('HTP 2681', 'D', 'No disponible', '25000'),
('HTP 8542', 'C', 'En Viaje', '5000'),
('JTP 4458', 'D', 'Transportando', '23000'),
('ZTP 5139', 'D', 'Disponible', '31000');

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
(53151, 34, 102, '2023-09-01', '08:35:00'),
(53151, 130, 102, '2023-08-28', '17:00:00');

--
-- Disparadores `viaja`
--
DELIMITER $$
CREATE TRIGGER `Viaja_check_positive_values` BEFORE INSERT ON `viaja` FOR EACH ROW BEGIN
    IF NEW.id_lote <= 0 OR NEW.id_almacen <= 0 OR NEW.id_trayecto <= 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Los valores en id_lote, id_almacen e id_trayecto deben ser positivos';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `check_fecha_hora_llegada` BEFORE INSERT ON `viaja` FOR EACH ROW BEGIN
  DECLARE fecha_salida_trayecto DATE;
  DECLARE hora_salida_trayecto TIME;

  -- Obtén la fecha y hora de salida del trayecto correspondiente
  SELECT fecha_salida, hora_salida
  INTO fecha_salida_trayecto, hora_salida_trayecto
  FROM Trayecto
  WHERE id_trayecto = NEW.id_trayecto;

  IF NEW.fecha_llegada < fecha_salida_trayecto OR (NEW.fecha_llegada = fecha_salida_trayecto AND NEW.hora_llegada < hora_salida_trayecto) THEN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'La fecha y hora de llegada deben ser posteriores a la fecha y hora de salida en el trayecto';
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vistachofercamionlote`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vistachofercamionlote` (
`CedulaChofer` int(10)
,`MatriculaCamion` varchar(10)
,`IDLote` int(10)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vistachofercamiontrayecto`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vistachofercamiontrayecto` (
`CedulaChofer` int(10)
,`MatriculaCamion` varchar(10)
,`IDTrayecto` int(10)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_almacen_con_lotes`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_almacen_con_lotes` (
`Almacen_ID` int(10)
,`Calle_Almacen` varchar(50)
,`Numero_Almacen` int(10)
,`Localidad_Almacen` varchar(50)
,`Trayecto_ID` int(10)
,`Origen_Trayecto` varchar(100)
,`Destino_Trayecto` varchar(100)
,`Lote_ID` int(10)
,`Estado_Lote` varchar(20)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_almacen_trayecto_lote`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_almacen_trayecto_lote` (
`Almacen_ID` int(10)
,`Calle_Almacen` varchar(50)
,`Numero_Almacen` int(10)
,`Localidad_Almacen` varchar(50)
,`Trayecto_ID` int(10)
,`Origen_Trayecto` varchar(100)
,`Destino_Trayecto` varchar(100)
,`Lote_ID` int(10)
,`Estado_Lote` varchar(20)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vistachofercamionlote`
--
DROP TABLE IF EXISTS `vistachofercamionlote`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vistachofercamionlote`  AS SELECT `m`.`cedula` AS `CedulaChofer`, `m`.`matricula` AS `MatriculaCamion`, `r`.`id_lote` AS `IDLote` FROM (`maneja` `m` join `realiza` `r` on(`m`.`matricula` = `r`.`matricula`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vistachofercamiontrayecto`
--
DROP TABLE IF EXISTS `vistachofercamiontrayecto`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vistachofercamiontrayecto`  AS SELECT `m`.`cedula` AS `CedulaChofer`, `m`.`matricula` AS `MatriculaCamion`, `r`.`id_trayecto` AS `IDTrayecto` FROM (`maneja` `m` join `realiza` `r` on(`m`.`matricula` = `r`.`matricula`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_almacen_con_lotes`
--
DROP TABLE IF EXISTS `vista_almacen_con_lotes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_almacen_con_lotes` AS 
SELECT 
    `a`.`id_almacen` AS `Almacen_ID`, 
    `a`.`calle` AS `Calle_Almacen`, 
    `a`.`numero` AS `Numero_Almacen`, 
    `a`.`localidad` AS `Localidad_Almacen`, 
    `t`.`id_trayecto` AS `Trayecto_ID`, 
    `t`.`origen` AS `Origen_Trayecto`, 
    `t`.`destino` AS `Destino_Trayecto`, 
    `l`.`id_lote` AS `Lote_ID`, 
    `l`.`estado` AS `Estado_Lote` 
FROM 
    (
        (
            (`almacen` `a` 
            LEFT JOIN `tiene` `ti` ON (`a`.`id_almacen` = `ti`.`id_almacen`)
        ) 
        LEFT JOIN `trayecto` `t` ON (`ti`.`id_trayecto` = `t`.`id_trayecto`)
        ) 
        LEFT JOIN `viaja` `v` ON (`a`.`id_almacen` = `v`.`id_almacen`)
    ) 
    LEFT JOIN `lote` `l` ON (`v`.`id_lote` = `l`.`id_lote`)
WHERE 
    `l`.`id_lote` IS NOT NULL;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_almacen_trayecto_lote`
--
DROP TABLE IF EXISTS `vista_almacen_trayecto_lote`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_almacen_trayecto_lote`  AS SELECT `a`.`id_almacen` AS `Almacen_ID`, `a`.`calle` AS `Calle_Almacen`, `a`.`numero` AS `Numero_Almacen`, `a`.`localidad` AS `Localidad_Almacen`, `t`.`id_trayecto` AS `Trayecto_ID`, `t`.`origen` AS `Origen_Trayecto`, `t`.`destino` AS `Destino_Trayecto`, `l`.`id_lote` AS `Lote_ID`, `l`.`estado` AS `Estado_Lote` FROM ((((`almacen` `a` left join `tiene` `ti` on(`a`.`id_almacen` = `ti`.`id_almacen`)) left join `trayecto` `t` on(`ti`.`id_trayecto` = `t`.`id_trayecto`)) left join `viaja` `v` on(`a`.`id_almacen` = `v`.`id_almacen`)) left join `lote` `l` on(`v`.`id_lote` = `l`.`id_lote`))  ;

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
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `almacen`
--
ALTER TABLE `almacen`
  MODIFY `id_almacen` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id_empresa` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `login`
--
ALTER TABLE `login`
  MODIFY `id_usuario` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lote`
--
ALTER TABLE `lote`
  MODIFY `id_lote` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `paquete`
--
ALTER TABLE `paquete`
  MODIFY `id_paquete` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `trayecto`
--
ALTER TABLE `trayecto`
  MODIFY `id_trayecto` int(10) NOT NULL AUTO_INCREMENT;

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