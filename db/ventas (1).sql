-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-02-2023 a las 01:59:33
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ventas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `concepto` varchar(100) NOT NULL,
  `monto` int(50) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`id`, `descripcion`, `concepto`, `monto`, `fecha`, `nombre`) VALUES
(1, 'Dinero para pagos', 'Dinero', 200, '2022-12-11 05:40:21', 'Emanuel');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codbarra`
--

CREATE TABLE `codbarra` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `codigo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `codbarra`
--

INSERT INTO `codbarra` (`id`, `id_producto`, `codigo`) VALUES
(13, 41, '013300'),
(18, 44, '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos`
--

CREATE TABLE `datos` (
  `id` int(11) NOT NULL,
  `negocio` varchar(100) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `mensaje` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `datos`
--

INSERT INTO `datos` (`id`, `negocio`, `telefono`, `direccion`, `mensaje`) VALUES
(1, 'Ejemplo', '9911165670', 'Calle 27 x 14 y 16', 'GRACIAS POR SU COMPRA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `color` varchar(20) DEFAULT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id`, `title`, `color`, `start`, `end`) VALUES
(2, 'Prueba', '#0071c5', '2023-01-03 00:00:00', '2023-01-07 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

CREATE TABLE `gastos` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `concepto` varchar(100) NOT NULL,
  `monto` int(50) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` int(11) NOT NULL,
  `rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Empleado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(20) NOT NULL,
  `codigo` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `precioVenta` float NOT NULL,
  `precioCompra` float NOT NULL,
  `existencia` int(50) NOT NULL,
  `total` float NOT NULL,
  `fecha` date DEFAULT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `codigo`, `descripcion`, `precioVenta`, `precioCompra`, `existencia`, `total`, `fecha`, `nombre`) VALUES
(41, '013300', 'Jugo del valle ', 17, 10.5, 0, 0, '2022-12-17', 'Emanuel'),
(44, '2', 'Cerillos chicos', 3.5, 1.5, 40, 164.5, '2022-12-10', 'Emanuel'),
(48, '3', 'Galleta Globitos', 17, 12, 25, 510, '2022-12-10', 'Emanuel'),
(49, '4', 'Galletas Chokis', 15, 8, 47, 720, '2022-12-10', 'Carolina Martin'),
(50, '5', 'Coca Cola ', 35, 10, 18, 1050, '2022-12-10', 'Carolina Martin'),
(51, '6', 'chetos ', 12, 10, 50, 600, '2022-12-10', 'Emanuel'),
(59, '7', 'Papas Rojas ', 17, 8, 9, 170, '2023-01-25', 'Emanuel'),
(61, '010201747821', 'Paleta helada', 17, 10.5, 10, 170, '2023-01-18', 'Emanuel'),
(62, '7506425606917', 'Jabon Escudo ', 17, 15, 16, 340, '2023-01-18', 'Emanuel');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_vendidos`
--

CREATE TABLE `productos_vendidos` (
  `id` int(20) NOT NULL,
  `id_producto` int(20) NOT NULL,
  `cantidad` int(20) NOT NULL,
  `id_venta` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos_vendidos`
--

INSERT INTO `productos_vendidos` (`id`, `id_producto`, `cantidad`, `id_venta`) VALUES
(30, 50, 1, 9),
(31, 62, 1, 10),
(32, 50, 1, 10),
(33, 50, 1, 11),
(34, 62, 1, 11),
(35, 48, 1, 12),
(36, 44, 1, 12),
(37, 50, 1, 12),
(38, 44, 5, 13),
(39, 50, 2, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `municipio` varchar(150) NOT NULL,
  `estado` varchar(150) NOT NULL,
  `pais` varchar(150) NOT NULL,
  `tema` varchar(150) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `settings`
--

INSERT INTO `settings` (`id`, `municipio`, `estado`, `pais`, `tema`, `fecha`) VALUES
(1, 'Dzilam Gonzalez', 'Yucatan', 'Mexico', 'bg-dark', '2022-12-11 05:19:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `fecha` timestamp NULL DEFAULT current_timestamp() COMMENT 'CURRENT_TIMESTAMP',
  `rol_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `nombre`, `correo`, `password`, `telefono`, `fecha`, `rol_id`) VALUES
(43, 'Emanuel', 'mugarte5672@gmail.com.es', '12345', '9981571220', '2022-05-05 23:06:09', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(20) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'CURRENT_TIMESTAMP',
  `total` float NOT NULL,
  `pago` float NOT NULL,
  `cambio` float NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `fecha`, `total`, `pago`, `cambio`, `nombre`) VALUES
(9, '2023-01-24 17:01:12', 35, 50, 15, 'Emanuel'),
(10, '2023-01-24 17:01:51', 52, 100, 48, 'Emanuel'),
(11, '2023-01-24 17:02:45', 52, 200, 148, 'Emanuel'),
(12, '2023-01-24 17:03:20', 55.5, 500, 444.5, 'Emanuel'),
(13, '2023-01-24 17:03:40', 87.5, 100, 12.5, 'Emanuel');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `codbarra`
--
ALTER TABLE `codbarra`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Indices de la tabla `datos`
--
ALTER TABLE `datos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Indices de la tabla `productos_vendidos`
--
ALTER TABLE `productos_vendidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `rol_id` (`rol_id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `codbarra`
--
ALTER TABLE `codbarra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `datos`
--
ALTER TABLE `datos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `gastos`
--
ALTER TABLE `gastos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `productos_vendidos`
--
ALTER TABLE `productos_vendidos`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
