-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-01-2024 a las 04:51:45
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `vale_pro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleprestamoequipos`
--

CREATE TABLE `detalleprestamoequipos` (
  `id_vale` int(11) DEFAULT NULL,
  `id_equipo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalleprestamoequipos`
--

INSERT INTO `detalleprestamoequipos` (`id_vale`, `id_equipo`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleprestamoreactivos`
--

CREATE TABLE `detalleprestamoreactivos` (
  `id_vale` int(11) DEFAULT NULL,
  `id_reactivo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalleprestamoreactivos`
--

INSERT INTO `detalleprestamoreactivos` (`id_vale`, `id_reactivo`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `id_equipo` int(11) NOT NULL,
  `nombre_equipo` varchar(255) NOT NULL,
  `marca` varchar(255) DEFAULT NULL,
  `condiciones` varchar(255) DEFAULT NULL,
  `comentarios` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`id_equipo`, `nombre_equipo`, `marca`, `condiciones`, `comentarios`) VALUES
(1, 'Microscopio de Fluorescencia', 'Nikon', 'Nuevo', 'Adquirido en 2023, alta resolución'),
(2, 'Cromatógrafo de Gases', 'Agilent Technologies', 'Usado', 'Mantenimiento realizado en 2022'),
(3, 'Espectrómetro de Absorción Atómica', 'PerkinElmer', 'Bueno', 'Ideal para análisis de metales pesados'),
(4, 'Centrífuga Refrigerada', 'Eppendorf', 'Nuevo', 'Capacidad hasta 24 tubos'),
(5, 'Calorímetro Diferencial de Barrido', 'Mettler Toledo', 'Excelente', 'Útil para análisis térmico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `id_grupo` int(11) NOT NULL,
  `nombre_grupo` varchar(255) NOT NULL,
  `nombre_responsable` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id_grupo`, `nombre_grupo`, `nombre_responsable`) VALUES
(1, 'Grupo 1', 'Ariadna'),
(2, 'Grupo 2', 'Alex'),
(3, 'Grupo 3', 'Angel David'),
(4, 'Grupo 4', 'Jesus'),
(5, 'Grupo 5', 'Zamudio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reactivos`
--

CREATE TABLE `reactivos` (
  `id_reactivo` int(11) NOT NULL,
  `nombre_reactivo` varchar(255) NOT NULL,
  `periodo_tiempo` varchar(255) DEFAULT NULL,
  `capacidad` int(11) DEFAULT NULL,
  `marca` varchar(255) DEFAULT NULL,
  `nivel_riesgo` varchar(255) DEFAULT NULL,
  `condiciones` varchar(255) DEFAULT NULL,
  `comentarios` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reactivos`
--

INSERT INTO `reactivos` (`id_reactivo`, `nombre_reactivo`, `periodo_tiempo`, `capacidad`, `marca`, `nivel_riesgo`, `condiciones`, `comentarios`) VALUES
(1, 'Ácido Sulfúrico', '2 años', 500, 'Merck', 'Alto', 'Nuevo', 'Almacenar en área ventilada'),
(2, 'Bromuro de Potasio', '5 años', 1000, 'Sigma-Aldrich', 'Bajo', 'Nuevo', 'Mantener en lugar seco'),
(3, 'Cloruro de Sodio', 'Indefinido', 2000, 'Fisher Scientific', 'Bajo', 'Nuevo', 'Para soluciones isotónicas'),
(4, 'Fenol', '3 años', 250, 'Acros Organics', 'Alto', 'Nuevo', 'Manipular con cuidado extremo'),
(5, 'Etanol', '4 años', 5000, 'Sigma-Aldrich', 'Moderado', 'Nuevo', 'Usar en campana extractora');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vale`
--

CREATE TABLE `vale` (
  `id_vale` int(11) NOT NULL,
  `id_grupo` int(11) DEFAULT NULL,
  `nombre_practica` varchar(255) DEFAULT NULL,
  `fecha_prestamo` date DEFAULT NULL,
  `fecha_practica` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vale`
--

INSERT INTO `vale` (`id_vale`, `id_grupo`, `nombre_practica`, `fecha_prestamo`, `fecha_practica`) VALUES
(1, 1, 'Cultivo de Bacterias', '2024-01-15', '2024-01-20'),
(2, 2, 'Síntesis de Nanopartículas', '2024-02-10', '2024-02-15'),
(3, 3, 'Análisis Espectral', '2024-03-05', '2024-03-10'),
(4, 4, 'Pruebas de Resistencia de Materiales', '2024-04-25', '2024-04-30'),
(5, 5, 'Síntesis de Compuestos Orgánicos', '2024-05-20', '2024-05-25');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalleprestamoequipos`
--
ALTER TABLE `detalleprestamoequipos`
  ADD KEY `id_vale` (`id_vale`),
  ADD KEY `id_equipo` (`id_equipo`);

--
-- Indices de la tabla `detalleprestamoreactivos`
--
ALTER TABLE `detalleprestamoreactivos`
  ADD KEY `id_vale` (`id_vale`),
  ADD KEY `id_reactivo` (`id_reactivo`);

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`id_equipo`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Indices de la tabla `reactivos`
--
ALTER TABLE `reactivos`
  ADD PRIMARY KEY (`id_reactivo`);

--
-- Indices de la tabla `vale`
--
ALTER TABLE `vale`
  ADD PRIMARY KEY (`id_vale`),
  ADD KEY `id_grupo` (`id_grupo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id_equipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `reactivos`
--
ALTER TABLE `reactivos`
  MODIFY `id_reactivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `vale`
--
ALTER TABLE `vale`
  MODIFY `id_vale` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalleprestamoequipos`
--
ALTER TABLE `detalleprestamoequipos`
  ADD CONSTRAINT `detalleprestamoequipos_ibfk_1` FOREIGN KEY (`id_vale`) REFERENCES `vale` (`id_vale`) ON DELETE CASCADE,
  ADD CONSTRAINT `detalleprestamoequipos_ibfk_2` FOREIGN KEY (`id_equipo`) REFERENCES `equipos` (`id_equipo`) ON DELETE CASCADE;

--
-- Filtros para la tabla `detalleprestamoreactivos`
--
ALTER TABLE `detalleprestamoreactivos`
  ADD CONSTRAINT `detalleprestamoreactivos_ibfk_1` FOREIGN KEY (`id_vale`) REFERENCES `vale` (`id_vale`) ON DELETE CASCADE,
  ADD CONSTRAINT `detalleprestamoreactivos_ibfk_2` FOREIGN KEY (`id_reactivo`) REFERENCES `reactivos` (`id_reactivo`) ON DELETE CASCADE;

--
-- Filtros para la tabla `vale`
--
ALTER TABLE `vale`
  ADD CONSTRAINT `vale_ibfk_1` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id_grupo`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
