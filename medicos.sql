-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-09-2024 a las 08:29:05
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sisg`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicos`
--

CREATE TABLE `medicos` (
  `ID_med` int(11) NOT NULL,
  `nombre_med` varchar(50) NOT NULL,
  `apellido_med` varchar(50) NOT NULL,
  `especialidad` varchar(50) NOT NULL,
  `colegiado` int(11) NOT NULL,
  `dpi` int(13) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `telefono` int(8) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `sexo` varchar(10) NOT NULL,
  `fecha_nacimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `medicos`
--

INSERT INTO `medicos` (`ID_med`, `nombre_med`, `apellido_med`, `especialidad`, `colegiado`, `dpi`, `correo`, `telefono`, `direccion`, `sexo`, `fecha_nacimiento`) VALUES
(1, 'Lucia', 'Morales', 'cardiologia', 5896, 1651666, 'lumo@gmail.com', 41259632, 'km 4 calle 3 zona 3', 'femenino', '1992-08-12'),
(3, 'Maria Juan', 'Perez Sagastume', 'cardiologia', 98458, 2147483647, 'mf@gmail.com', 745896587, 'zona 9', 'masculino', '2024-04-29'),
(6, 'Axel', 'Alvarado', 'cardiologia', 94984, 4896814, 'ax@ax.com', 5662558, 'zona 15', 'masculino', '2024-09-01');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `medicos`
--
ALTER TABLE `medicos`
  ADD PRIMARY KEY (`ID_med`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `medicos`
--
ALTER TABLE `medicos`
  MODIFY `ID_med` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
