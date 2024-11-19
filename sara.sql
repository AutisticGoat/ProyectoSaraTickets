-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-11-2024 a las 02:13:18
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
-- Base de datos: `sara`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `ID` int(11) NOT NULL,
  `IdUsuario` int(11) NOT NULL,
  `IdProblema` int(11) NOT NULL,
  `IdMantenimiento` int(11) NOT NULL,
  `FechaAgendada` date NOT NULL DEFAULT current_timestamp(),
  `Estatus` varchar(25) DEFAULT 'Activa',
  `Comentario` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`ID`, `IdUsuario`, `IdProblema`, `IdMantenimiento`, `FechaAgendada`, `Estatus`, `Comentario`) VALUES
(1, 2, 2, 1, '2024-11-19', 'Sin presentar', 'Te estas tardando, eh?'),
(2, 2, 3, 1, '2024-11-18', 'Completa', 'no'),
(3, 2, 11, 1, '2024-11-18', 'Sin presentar', 'gegege');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimiento`
--

CREATE TABLE `mantenimiento` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(40) NOT NULL,
  `Ocupación` varchar(40) NOT NULL,
  `Contraseña` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mantenimiento`
--

INSERT INTO `mantenimiento` (`ID`, `Nombre`, `Ocupación`, `Contraseña`) VALUES
(1, 'Rodolfo', 'Reparaciones', '123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `problema`
--

CREATE TABLE `problema` (
  `ID` int(11) NOT NULL,
  `Descripción` varchar(255) NOT NULL,
  `Estatus` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `problema`
--

INSERT INTO `problema` (`ID`, `Descripción`, `Estatus`) VALUES
(1, 'Me duele la pilinga', 'Reportado'),
(2, 'Me duele el pipi\r\n', 'En proceso de soluci'),
(3, 'pene duro ayuda\r\n', 'Reportado'),
(4, 'gaygaygayagyagagad', 'Reportado'),
(5, '22222222222', 'Reportado'),
(6, '23232323', 'Reportado'),
(7, 'eeeeeeeeeeeeeeeeeeeeeeeeeeeeee Whawhaawhat!!\r\n', 'En proceso de soluci'),
(8, 'Hola soy adolfo solo para reportar que odio a los putos negors\r\n\r\n', 'Reportado'),
(9, 'Me duele el pico2', 'Reportado'),
(10, 'niggaLap', 'Reportado'),
(11, 'penennenenenene', 'En proceso de soluci');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `problematicket`
--

CREATE TABLE `problematicket` (
  `IdProblema` int(11) NOT NULL,
  `IdTicket` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `problematicket`
--

INSERT INTO `problematicket` (`IdProblema`, `IdTicket`) VALUES
(2, 4),
(3, 5),
(4, 6),
(5, 7),
(6, 8),
(7, 9),
(8, 10),
(9, 11),
(10, 12),
(11, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket`
--

CREATE TABLE `ticket` (
  `ID` int(11) NOT NULL,
  `HoraEntrada` datetime NOT NULL,
  `HoraSalida` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ticket`
--

INSERT INTO `ticket` (`ID`, `HoraEntrada`, `HoraSalida`) VALUES
(2, '2024-11-15 19:15:11', '2024-11-15 19:15:11'),
(3, '2024-11-06 22:56:49', '0000-00-00 00:00:00'),
(4, '2024-11-02 18:00:27', '2024-11-04 21:05:50'),
(5, '2024-11-08 20:52:30', '0000-00-00 00:00:00'),
(6, '2024-11-08 21:02:10', '0000-00-00 00:00:00'),
(7, '2024-11-15 10:56:13', '0000-00-00 00:00:00'),
(8, '2024-11-15 11:09:52', '0000-00-00 00:00:00'),
(9, '2024-11-15 11:10:19', '0000-00-00 00:00:00'),
(10, '2024-11-15 11:18:19', '0000-00-00 00:00:00'),
(11, '2024-11-15 11:22:24', '0000-00-00 00:00:00'),
(12, '2024-11-15 12:24:40', '0000-00-00 00:00:00'),
(13, '2024-11-15 18:00:12', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(40) NOT NULL,
  `Contraseña` varchar(14) NOT NULL,
  `Area` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ID`, `Nombre`, `Contraseña`, `Area`) VALUES
(1, 'Admin', 'secretoAdmin', 'Administrador'),
(2, 'Adolfo', '123', 'RH'),
(3, 'HermanoDelAdolfo', '123', 'Joto'),
(4, 'Nigger4', '123', 'nigga');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarioproblema`
--

CREATE TABLE `usuarioproblema` (
  `IdUsuario` int(11) NOT NULL,
  `IdProblema` int(11) NOT NULL,
  `AreaProblema` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarioproblema`
--

INSERT INTO `usuarioproblema` (`IdUsuario`, `IdProblema`, `AreaProblema`) VALUES
(2, 2, 'RH'),
(2, 3, 'RH'),
(2, 4, 'RH'),
(2, 5, 'RH'),
(2, 6, 'RH'),
(2, 7, 'RH'),
(2, 8, 'RH'),
(2, 9, 'RH'),
(2, 11, 'RH'),
(4, 10, 'nigga');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IdUsuario` (`IdUsuario`,`IdProblema`,`IdMantenimiento`),
  ADD KEY `IdProblema` (`IdProblema`),
  ADD KEY `IdMantenimiento` (`IdMantenimiento`);

--
-- Indices de la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Nombre` (`Nombre`,`Ocupación`);

--
-- Indices de la tabla `problema`
--
ALTER TABLE `problema`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `problematicket`
--
ALTER TABLE `problematicket`
  ADD KEY `IdProblema` (`IdProblema`,`IdTicket`),
  ADD KEY `IdTicket` (`IdTicket`);

--
-- Indices de la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `usuarioproblema`
--
ALTER TABLE `usuarioproblema`
  ADD KEY `IdUsuario` (`IdUsuario`,`IdProblema`,`AreaProblema`),
  ADD KEY `IdProblema` (`IdProblema`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `problema`
--
ALTER TABLE `problema`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`IdUsuario`) REFERENCES `usuario` (`ID`),
  ADD CONSTRAINT `citas_ibfk_2` FOREIGN KEY (`IdProblema`) REFERENCES `problema` (`ID`),
  ADD CONSTRAINT `citas_ibfk_3` FOREIGN KEY (`IdMantenimiento`) REFERENCES `mantenimiento` (`ID`);

--
-- Filtros para la tabla `problematicket`
--
ALTER TABLE `problematicket`
  ADD CONSTRAINT `problematicket_ibfk_1` FOREIGN KEY (`IdProblema`) REFERENCES `problema` (`ID`),
  ADD CONSTRAINT `problematicket_ibfk_2` FOREIGN KEY (`IdTicket`) REFERENCES `ticket` (`ID`);

--
-- Filtros para la tabla `usuarioproblema`
--
ALTER TABLE `usuarioproblema`
  ADD CONSTRAINT `usuarioproblema_ibfk_1` FOREIGN KEY (`IdUsuario`) REFERENCES `usuario` (`ID`),
  ADD CONSTRAINT `usuarioproblema_ibfk_2` FOREIGN KEY (`IdProblema`) REFERENCES `problema` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
