-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-03-2022 a las 15:32:14
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `powerbi`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes`
--

CREATE TABLE `reportes` (
  `id` int(11) NOT NULL,
  `nombre_reporte` varchar(1000) NOT NULL,
  `url_reporte` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reportes`
--

INSERT INTO `reportes` (`id`, `nombre_reporte`, `url_reporte`) VALUES
(1, 'Test', 'https://app.powerbi.com/view?r=eyJrIjoiZjNkMTc3NDMtZTRkMC00NzA0LTg5NDctZjQwNzA4YTJhYWQyIiwidCI6IjIyMmU1NjQwLTc5NDUtNDI3Mi05YjBiLWYyZTg1NWY3N2NmZSJ9&pageName=ReportSection'),
(2, 'Test2', 'https://app.powerbi.com/view?r=eyJrIjoiMDUwNTFkODYtMWM3Yi00ODRhLWI0NTUtM2ZkOTNhOTYyODZlIiwidCI6IjIyMmU1NjQwLTc5NDUtNDI3Mi05YjBiLWYyZTg1NWY3N2NmZSJ9'),
(3, 'Test3', 'https://app.powerbi.com/view?r=eyJrIjoiZjNkMTc3NDMtZTRkMC00NzA0LTg5NDctZjQwNzA4YTJhYWQyIiwidCI6IjIyMmU1NjQwLTc5NDUtNDI3Mi05YjBiLWYyZTg1NWY3N2NmZSJ9&pageName=ReportSection'),
(4, 'Test4', 'https://app.powerbi.com/view?r=eyJrIjoiZjNkMTc3NDMtZTRkMC00NzA0LTg5NDctZjQwNzA4YTJhYWQyIiwidCI6IjIyMmU1NjQwLTc5NDUtNDI3Mi05YjBiLWYyZTg1NWY3N2NmZSJ9&pageName=ReportSection'),
(5, 'Correos Activos JEJ', 'https://app.powerbi.com/view?r=eyJrIjoiMTliYmU0MjUtM2Q5Zi00YWQyLThjNmQtNmVlNTk0ODIxNjFkIiwidCI6IjIyMmU1NjQwLTc5NDUtNDI3Mi05YjBiLWYyZTg1NWY3N2NmZSJ9&pageName=ReportSection');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes_asignados`
--

CREATE TABLE `reportes_asignados` (
  `id` int(11) NOT NULL,
  `correo` varchar(500) NOT NULL,
  `id_reporte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reportes_asignados`
--

INSERT INTO `reportes_asignados` (`id`, `correo`, `id_reporte`) VALUES
(32, 'equezada@jej.cl', 1),
(33, 'equezada@jej.cl', 2),
(51, 'dlopezav@jej.cl', 2),
(52, 'dlopezav@jej.cl', 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `reportes`
--
ALTER TABLE `reportes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reportes_asignados`
--
ALTER TABLE `reportes_asignados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_reportes_asignados` (`id_reporte`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `reportes`
--
ALTER TABLE `reportes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `reportes_asignados`
--
ALTER TABLE `reportes_asignados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `reportes_asignados`
--
ALTER TABLE `reportes_asignados`
  ADD CONSTRAINT `fk_reportes_asignados` FOREIGN KEY (`id_reporte`) REFERENCES `reportes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
