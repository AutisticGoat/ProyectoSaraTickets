-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-11-2024 a las 06:58:56
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
-- Estructura de tabla para la tabla `mantenimiento`
--

CREATE TABLE `mantenimiento` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(40) NOT NULL,
  `Opupación` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'Me duele la pilinga', 'Reportado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `problematicket`
--

CREATE TABLE `problematicket` (
  `IdProblema` int(11) NOT NULL,
  `IdTicket` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(3, '2024-11-06 22:56:49', '0000-00-00 00:00:00');

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
(2, 'Adolfo', '123', 'RH');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarioproblema`
--

CREATE TABLE `usuarioproblema` (
  `IdUsuario` int(11) NOT NULL,
  `IdProblema` int(11) NOT NULL,
  `AreaProblema` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarioproblemamantenimiento`
--

CREATE TABLE `usuarioproblemamantenimiento` (
  `IdUsuario` int(11) NOT NULL,
  `IdProblema` int(11) NOT NULL,
  `IdMantenimiento` int(11) NOT NULL,
  `Ocupación` varchar(40) NOT NULL,
  `Area` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Nombre` (`Nombre`,`Opupación`);

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
-- Indices de la tabla `usuarioproblemamantenimiento`
--
ALTER TABLE `usuarioproblemamantenimiento`
  ADD KEY `IdUsuario` (`IdUsuario`,`IdProblema`,`IdMantenimiento`,`Ocupación`,`Area`),
  ADD KEY `IdProblema` (`IdProblema`),
  ADD KEY `IdMantenimiento` (`IdMantenimiento`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `problema`
--
ALTER TABLE `problema`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

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

--
-- Filtros para la tabla `usuarioproblemamantenimiento`
--
ALTER TABLE `usuarioproblemamantenimiento`
  ADD CONSTRAINT `usuarioproblemamantenimiento_ibfk_1` FOREIGN KEY (`IdUsuario`) REFERENCES `usuario` (`ID`),
  ADD CONSTRAINT `usuarioproblemamantenimiento_ibfk_2` FOREIGN KEY (`IdProblema`) REFERENCES `problema` (`ID`),
  ADD CONSTRAINT `usuarioproblemamantenimiento_ibfk_3` FOREIGN KEY (`IdMantenimiento`) REFERENCES `mantenimiento` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
