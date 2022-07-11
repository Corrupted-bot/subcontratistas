-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-07-2022 a las 05:17:37
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
-- Estructura de tabla para la tabla `contratos`
--

CREATE TABLE `contratos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(500) NOT NULL,
  `id_subcontratista` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `contratos`
--

INSERT INTO `contratos` (`id`, `nombre`, `id_subcontratista`, `created_at`, `updated_at`) VALUES
(1, 'Brainstorming Digital', 1, '2022-07-08', '2022-07-08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcontratistas`
--

CREATE TABLE `subcontratistas` (
  `id` int(11) NOT NULL,
  `razon_social` varchar(500) NOT NULL,
  `representante_legal` varchar(500) NOT NULL,
  `numero_contacto` varchar(500) NOT NULL,
  `contacto_comercial` varchar(500) NOT NULL,
  `direccion` text NOT NULL,
  `correo` varchar(500) NOT NULL,
  `persona_jej` varchar(500) NOT NULL,
  `disciplina` varchar(500) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `subcontratistas`
--

INSERT INTO `subcontratistas` (`id`, `razon_social`, `representante_legal`, `numero_contacto`, `contacto_comercial`, `direccion`, `correo`, `persona_jej`, `disciplina`, `created_at`, `updated_at`) VALUES
(1, 'J.E.J INGENIERIA S.A', 'diego Lopez', '992048684', '992048648', 'AVENIDA APOQUINDO 2930 1101', 'dlopezav@jej.cl', 'Diego lopez', 'Programador', '2022-07-08', '2022-07-08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `displayName` varchar(255) NOT NULL,
  `mail` varchar(500) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `displayName`, `mail`, `password`) VALUES
(5, 'Diego Lopez Test 2', 'diego.lopez2000@hotmail.com', 'eyJpdiI6IkpEYTYwVEY2aWY5U1Rjek80NER6TVE9PSIsInZhbHVlIjoiSmVrdWtsaHI3SlA0TytGbnBCdkZ1dz09IiwibWFjIjoiOGI1YTNiZTgyODM3MTMyNzM1YTExM2NkMTQyYWZkODM1ZDczY2MxZDNkOTNlNzM4YjMyM2E1NmFlNTVkNDE1ZSIsInRhZyI6IiJ9'),
(6, 'Diego Lopez Avendaño', 'antraxh037@gmail.com', 'eyJpdiI6IjdBSEZFMVpDZDhYRXJwQlpETHRqUFE9PSIsInZhbHVlIjoiczBNQ0Vtb0kxeUpMTTE4SkpSQnFCQT09IiwibWFjIjoiM2I5OTcwNGYyZGZlZjJkZmU4MTgxODFiYzYyZjY1NTdhYzk1ZTNjZmQ4MTFhMTlkMzlhMGIzNzE0ZjI5NjYzYyIsInRhZyI6IiJ9');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contratos`
--
ALTER TABLE `contratos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `subcontratistas`
--
ALTER TABLE `subcontratistas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `contratos`
--
ALTER TABLE `contratos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `subcontratistas`
--
ALTER TABLE `subcontratistas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
