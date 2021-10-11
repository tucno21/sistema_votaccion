-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 11-10-2021 a las 20:26:16
-- Versión del servidor: 5.7.34-log
-- Versión de PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_votacion2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `candidatos`
--

CREATE TABLE `candidatos` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `dni` int(11) DEFAULT NULL,
  `photo` varchar(60) DEFAULT NULL,
  `logo` varchar(60) DEFAULT NULL,
  `group_name` varchar(60) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fecha_votacion`
--

CREATE TABLE `fecha_votacion` (
  `id` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_fin` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `fecha_votacion`
--

INSERT INTO `fecha_votacion` (`id`, `fecha`, `hora_inicio`, `hora_fin`) VALUES
(1, '2021-09-21', '08:30:00', '20:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modlogin`
--

CREATE TABLE `modlogin` (
  `id` int(11) NOT NULL,
  `name_ie` varchar(45) DEFAULT NULL,
  `photo` varchar(60) DEFAULT NULL,
  `color_b` varchar(45) DEFAULT NULL,
  `color_s` varchar(45) DEFAULT NULL,
  `fecha` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `modlogin`
--

INSERT INTO `modlogin` (`id`, `name_ie`, `photo`, `color_b`, `color_s`, `fecha`) VALUES
(1, 'Colegio', NULL, NULL, NULL, '2023');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `dni` int(11) DEFAULT NULL,
  `aula` varchar(45) DEFAULT NULL,
  `candidatoId` int(11) DEFAULT NULL,
  `date_access` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `photo` varchar(60) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `rango` varchar(45) DEFAULT NULL,
  `date_access` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `photo`, `estado`, `rango`, `date_access`) VALUES
(1, 'Admin', 'admin@admin.com', '$2y$10$k8AxH4I2BCIZgyjaz8OLJukJKpYPg.LX1dIGIo3P8ARQ1X5wrqhp2', NULL, 1, 'Administrador', '2021-10-11 20:20:36');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `candidatos`
--
ALTER TABLE `candidatos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `fecha_votacion`
--
ALTER TABLE `fecha_votacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modlogin`
--
ALTER TABLE `modlogin`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `canditatoId_idx` (`candidatoId`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `candidatos`
--
ALTER TABLE `candidatos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `fecha_votacion`
--
ALTER TABLE `fecha_votacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `modlogin`
--
ALTER TABLE `modlogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `canditatoId` FOREIGN KEY (`candidatoId`) REFERENCES `candidatos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
