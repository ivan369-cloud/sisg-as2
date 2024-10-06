-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-10-2024 a las 09:57:03
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
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id_cita` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `motivo` varchar(200) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_medico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id_cita`, `fecha`, `hora`, `motivo`, `estado`, `id_paciente`, `id_medico`) VALUES
(1, '2024-03-22', '00:58:00', 'Dolor TX', 'Por atender', 1, 1),
(3, '2024-03-30', '00:17:00', 'Consulta', 'Por atender', 1, 1),
(5, '2024-03-23', '01:13:00', 'Dolor cabeza', 'por atender', 2, 2),
(6, '2024-03-23', '01:10:00', 'Consulta', 'Por atender', 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id_empleado` int(11) NOT NULL,
  `dpi` varchar(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `edad` int(11) NOT NULL,
  `sexo` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `area` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id_empleado`, `dpi`, `nombre`, `apellido`, `edad`, `sexo`, `email`, `telefono`, `area`) VALUES
(15, '1234567891234', 'Cato', ' Alvarado', 22, 'Masculino', 'aaasdadas@edfsdfsdfsdf.com', '123456789', 'Administración'),
(17, '1516148952369', 'Monica', 'Perez', 21, 'Femenino', 'monica@gmail.com', '41984598', 'Contabilidad'),
(19, '12345678', 'Adrian', 'Reyes', 22, 'Masculino', 'adrian@ar.com', '96582365', 'Seguridad');

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
  `dpi` int(11) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `telefono` int(11) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `sexo` varchar(10) NOT NULL,
  `fecha_nacimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `medicos`
--

INSERT INTO `medicos` (`ID_med`, `nombre_med`, `apellido_med`, `especialidad`, `colegiado`, `dpi`, `correo`, `telefono`, `direccion`, `sexo`, `fecha_nacimiento`) VALUES
(1, 'Lucia', 'Morales', 'Cardiologia', 5896, 1651666, 'lumo@gmail.com', 41259632, 'km 4 calle 3 zona 3', 'femenino', '1992-08-12'),
(3, 'Maria Juana', 'Perez Sagastume', 'Oncologia', 98458, 2147483647, 'mf@gmail.com', 745896587, 'zona 9', 'femenino', '2024-04-29'),
(6, 'Axel', 'Alvarado', 'Cardiologia', 94984, 4896814, 'ax@ax.com', 5662558, 'zona 15', 'masculino', '2024-09-01'),
(7, 'Lester', 'Lopez', 'Oftalmologia', 1849, 41686846, 'mn@nj.com', 2849849, 'zona 10', 'masculino', '2024-09-01'),
(8, 'Ivan', 'Perez', 'Psiquiatria', 8468, 984651, 'mek@oeivn.com', 46851, 'zona 5', 'masculino', '2024-09-02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id_paciente` int(11) NOT NULL,
  `dpi` varchar(13) NOT NULL,
  `primer_nombre` varchar(50) NOT NULL,
  `segundo_nombre` varchar(50) NOT NULL,
  `primer_apellido` varchar(50) NOT NULL,
  `segundo_apellido` varchar(50) NOT NULL,
  `edad` int(11) NOT NULL,
  `genero` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `telefono` int(11) NOT NULL,
  `observaciones` varchar(200) NOT NULL,
  `id_medico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id_paciente`, `dpi`, `primer_nombre`, `segundo_nombre`, `primer_apellido`, `segundo_apellido`, `edad`, `genero`, `email`, `fecha_nacimiento`, `direccion`, `telefono`, `observaciones`, `id_medico`) VALUES
(7, '12', 'Axeliño', 'lexA', 'Alvariño', 'odaravlA', 22, 'Masculino', 'axel@a', '2024-10-02', 'sadadadasdads', 1, 'Guapo, ', 1),
(15, '12312312241', 'Axeliño', 'lexA', 'Alvariño', 'odaravlA', 22, 'Masculino', 'axel@a', '2024-10-02', 'sadadadasdads', 123412343, 'Guapo, ', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `receta`
--

CREATE TABLE `receta` (
  `id_receta` int(11) NOT NULL,
  `enfermedad` varchar(200) NOT NULL,
  `receta` text NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_medico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `receta`
--

INSERT INTO `receta` (`id_receta`, `enfermedad`, `receta`, `id_paciente`, `id_medico`) VALUES
(1, 'asdasda', 'asdasdasd', 1, 1),
(2, 'Cancer Terminal', 'LLantos\nAbrazos de familiares\nUna vacaciones a europa o japon\nmusica chida\nno estudiar ingeneria en sistemas y valorar tus poderosas 8 horas de sueño', 2, 1),
(6, 'Mas voces en la chola', 'La dvd no se como continuar vivo papito, mejor date de baja\nestas gastando mucho aire\n\nTe amo Uwu\n\nONIIIIIIIIIIIIIIIICHAAAAAAAAAAAAAAAAAAAAAAAAAAAAAANNNNNNNNNNNN!!!!!!!!!!!!!\n\n\n\n\nasdasdsadasdas\n\n\n\n\n\n\ndsfbdsifsdbnifujasdbjidksaojkdsad\na\n\n\n\n\n\n\n\nasdasda\n\n\n\n\nasdasd\na\n\n\n\n\n\nCancer Cida tu mama\n\n\n\n\n\n\n\n\n\n\n\n\n\nAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA\n\n\n\nNAZIS', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `privilegio` varchar(50) NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `username`, `password`, `privilegio`, `activo`) VALUES
(7, 'empleado', '1234', 'empleado', 1),
(8, 'admin', 'admin', 'admin', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id_cita`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id_empleado`);

--
-- Indices de la tabla `medicos`
--
ALTER TABLE `medicos`
  ADD PRIMARY KEY (`ID_med`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id_paciente`);

--
-- Indices de la tabla `receta`
--
ALTER TABLE `receta`
  ADD PRIMARY KEY (`id_receta`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id_cita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `medicos`
--
ALTER TABLE `medicos`
  MODIFY `ID_med` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id_paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `receta`
--
ALTER TABLE `receta`
  MODIFY `id_receta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
