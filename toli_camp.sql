-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-10-2023 a las 12:15:21
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `toli_camp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `categoria`) VALUES
(1, 'verduras'),
(2, 'carnes'),
(3, 'frutas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_producto`
--

CREATE TABLE `det_producto` (
  `id_det_producto` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `docu_ven` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `det_producto`
--

INSERT INTO `det_producto` (`id_det_producto`, `id_producto`, `docu_ven`) VALUES
(1, 1, 1106632513);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_venta`
--

CREATE TABLE `det_venta` (
  `id_det_venta` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `id_det_producto` int(11) NOT NULL,
  `docu_clien` int(11) NOT NULL,
  `total_v` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `det_venta`
--

INSERT INTO `det_venta` (`id_det_venta`, `id_venta`, `id_det_producto`, `docu_clien`, `total_v`) VALUES
(1, 1, 1, 1106632525, 10000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id_estado` int(11) NOT NULL,
  `estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id_estado`, `estado`) VALUES
(1, 'ACTIVO'),
(2, 'VENCIDO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

CREATE TABLE `genero` (
  `id_genero` int(11) NOT NULL,
  `genero` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `genero`
--

INSERT INTO `genero` (`id_genero`, `genero`) VALUES
(1, 'masculino'),
(2, 'femenino'),
(3, 'otro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso`
--

CREATE TABLE `ingreso` (
  `id_ingreso` int(11) NOT NULL,
  `documento` int(11) NOT NULL,
  `fecha_ingre` date NOT NULL,
  `hora_ingre` time NOT NULL,
  `fecha_sali` date NOT NULL,
  `hora_sali` time NOT NULL,
  `durac` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `ingreso`
--

INSERT INTO `ingreso` (`id_ingreso`, `documento`, `fecha_ingre`, `hora_ingre`, `fecha_sali`, `hora_sali`, `durac`) VALUES
(1, 1106632525, '2023-10-26', '01:26:22', '0000-00-00', '00:00:00', 0),
(2, 1106632525, '2023-10-26', '01:30:47', '0000-00-00', '00:00:00', 0),
(3, 1106632525, '2023-10-26', '01:31:07', '0000-00-00', '00:00:00', 0),
(4, 1106632118, '2023-10-26', '10:41:05', '0000-00-00', '00:00:00', 0),
(5, 1106632118, '2023-10-26', '10:44:24', '0000-00-00', '00:00:00', 0),
(6, 1106632513, '2023-10-26', '10:47:24', '0000-00-00', '00:00:00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(500) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `precio` decimal(10,0) NOT NULL,
  `disponibles` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `cantidad` smallint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre_producto`, `descripcion`, `precio`, `disponibles`, `id_categoria`, `cantidad`) VALUES
(1, 'tomate', 'Se encuentra variedad de tomates grandes y pequeños', 5000, 50, 1, 60);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `tipo_rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `tipo_rol`) VALUES
(1, 'administrador'),
(2, 'usuario'),
(3, 'vendedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trig_pass`
--

CREATE TABLE `trig_pass` (
  `id_trigpass` int(11) NOT NULL,
  `documento` int(10) NOT NULL,
  `correo_electronico` text NOT NULL,
  `contraseña` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `documento` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `password` varchar(500) NOT NULL,
  `correo_electronico` varchar(50) NOT NULL,
  `celular` varchar(10) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `id_genero` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `fallos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`documento`, `nombre`, `apellido`, `password`, `correo_electronico`, `celular`, `direccion`, `id_genero`, `id_rol`, `id_estado`, `fallos`) VALUES
(1106632118, 'yudy', 'rico', '$2y$12$f2gTqfFDE5duw6dtfAuLMeU/5ibEtCqm/FuMz5OQbOiqmwwZE26Tu', 'yerico8@misena.edu.co', '3203020256', 'Carrera 8d #131-25 barrio montecarlo', 2, 2, 1, 0),
(1106632513, 'jeidy', 'joven', '$2y$12$aQ7vTJirCTJHQyN3wKz4uu3zJmNBrr.FKJX6PRj1CBgDs9607bhmm', 'Jeidy13@gmail.com', '3133130948', 'Manzana Q casa 5 barrio: bosque baja', 2, 3, 1, 0),
(1106632525, 'jhoen', 'ramos', '$2y$12$GprzLgvGSFU.O.rP4ra.v.9FalCCzrBrv.cKtza8jzYAHpde.nnoq', 'sahileth96@gmail.com', '3227825320', 'Manzana Q casa 5 barrio: bosque baja', 2, 1, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `id_det_producto` int(11) NOT NULL,
  `cantidad` smallint(5) NOT NULL,
  `docu_clien` int(11) NOT NULL,
  `total_v` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `fecha`, `hora`, `id_det_producto`, `cantidad`, `docu_clien`, `total_v`) VALUES
(1, '2023-10-17', '11:26:59', 1, 5, 1106632525, 10000.00);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `det_producto`
--
ALTER TABLE `det_producto`
  ADD PRIMARY KEY (`id_det_producto`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `documento` (`docu_ven`);

--
-- Indices de la tabla `det_venta`
--
ALTER TABLE `det_venta`
  ADD PRIMARY KEY (`id_det_venta`),
  ADD KEY `id_producto` (`id_det_producto`),
  ADD KEY `id_venta` (`id_venta`),
  ADD KEY `documento` (`docu_clien`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`id_genero`);

--
-- Indices de la tabla `ingreso`
--
ALTER TABLE `ingreso`
  ADD PRIMARY KEY (`id_ingreso`),
  ADD KEY `documento` (`documento`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `trig_pass`
--
ALTER TABLE `trig_pass`
  ADD PRIMARY KEY (`id_trigpass`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`documento`),
  ADD KEY `id_estado` (`id_estado`),
  ADD KEY `id_genero` (`id_genero`),
  ADD KEY `id_rol` (`id_rol`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_det_producto` (`id_det_producto`),
  ADD KEY `ventas_ibfk_2` (`docu_clien`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `det_producto`
--
ALTER TABLE `det_producto`
  MODIFY `id_det_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `det_venta`
--
ALTER TABLE `det_venta`
  MODIFY `id_det_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `genero`
--
ALTER TABLE `genero`
  MODIFY `id_genero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ingreso`
--
ALTER TABLE `ingreso`
  MODIFY `id_ingreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `trig_pass`
--
ALTER TABLE `trig_pass`
  MODIFY `id_trigpass` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `det_producto`
--
ALTER TABLE `det_producto`
  ADD CONSTRAINT `det_producto_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON UPDATE CASCADE,
  ADD CONSTRAINT `det_producto_ibfk_2` FOREIGN KEY (`docu_ven`) REFERENCES `usuarios` (`documento`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `det_venta`
--
ALTER TABLE `det_venta`
  ADD CONSTRAINT `det_venta_ibfk_2` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`) ON DELETE CASCADE,
  ADD CONSTRAINT `det_venta_ibfk_3` FOREIGN KEY (`docu_clien`) REFERENCES `usuarios` (`documento`) ON UPDATE CASCADE,
  ADD CONSTRAINT `det_venta_ibfk_4` FOREIGN KEY (`id_det_producto`) REFERENCES `det_producto` (`id_det_producto`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `ingreso`
--
ALTER TABLE `ingreso`
  ADD CONSTRAINT `ingreso_ibfk_1` FOREIGN KEY (`documento`) REFERENCES `usuarios` (`documento`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
