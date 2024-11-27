-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-11-2024 a las 04:59:00
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
-- Base de datos: `sistematicketsreporte`
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
(15, 2, 1, 1, '2024-11-18', 'Sin presentar', 'El problema podría deberse a un cable de video suelto.'),
(16, 3, 2, 2, '2024-11-19', 'En Proceso', 'Se sospecha que el sistema operativo necesita una optimización.'),
(17, 4, 3, 3, '2024-11-20', 'Completado', 'Pantalla táctil presenta daño físico, necesita reemplazo.'),
(18, 5, 4, 1, '2024-11-21', 'Sin presentar', 'Teclado posiblemente tenga suciedad interna o daño mecánico.'),
(19, 2, 5, 2, '2024-11-22', 'En Proceso', 'La tablet está bloqueada por exceder intentos de contraseña.'),
(20, 3, 6, 3, '2024-11-18', 'Completado', 'La impresora presenta problemas en los inyectores de tinta.'),
(21, 4, 7, 1, '2024-11-19', 'Sin presentar', 'La pantalla cambia colores debido a un posible fallo en la tarjeta gráfica.'),
(22, 5, 8, 2, '2024-11-20', 'En Proceso', 'La tablet podría tener problemas en la batería o la placa madre.'),
(23, 2, 9, 3, '2024-11-21', 'Completado', 'El problema de conexión parece deberse a una mala configuración de red.'),
(24, 3, 10, 1, '2024-11-22', 'En Proceso', 'La tablet no tiene permisos para descargar el software necesario.'),
(25, 4, 11, 2, '2024-11-18', 'Sin presentar', 'La impresora tiene problemas en el cabezal de impresión.');

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
(1, 'Rodolfo', 'Reparaciones', '123'),
(2, 'Miguel', 'Reparaciones', 'qwneu237'),
(3, 'Gerardo', 'Reparaciones', 'CS238hc');

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
(1, 'Problema con computadora de escritorio: No envía imagen ', 'Reportado'),
(2, 'Problema con laptop: Sistema demasiado lento', 'Solucionado'),
(3, 'Problema con teléfono de empresa: Parte de la pantalla táctil no responde', 'Reportado'),
(4, 'Problema con computadora: Teclado no responde de forma apropiada (no funcionan las teclas I, O ni K)', 'Reportado'),
(5, 'Problema con tablet: Bloqueo por intentos excesivos de ingresar contraseña', 'Reportado'),
(6, 'Problema con impresora: Al imprimir se salta varias líneas y la imagen sale incompleta ', 'En proceso'),
(7, 'Problema con computadora de escritorio: Pantalla cambia entre colores constantemente ', 'En proceso'),
(8, 'Problema con Tablet: Equipo no logra encender\r\n', 'Reportado'),
(9, 'Problema con Laptop: No puede conectarse a internet', 'Reportado'),
(10, 'Problema con tablet: Carece de software necesario para trabajar, no se puede descargar', 'Reportado'),
(11, 'Problema con impresora: Nunca sale la impresión y la hoja queda en blanco', 'En proceso');

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
(3, 'Carlos ', '3949hf7v', 'Ventas '),
(4, 'Vicente', 'c9d78hzxc', 'Logística'),
(5, 'Roberto', 'chd89ewh', 'Producción');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarioproblema`
--

CREATE TABLE `usuarioproblema` (
  `IdUsuario` int(11) NOT NULL,
  `IdProblema` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarioproblema`
--

INSERT INTO `usuarioproblema` (`IdUsuario`, `IdProblema`) VALUES
(2, 1),
(2, 5),
(2, 9),
(3, 2),
(3, 6),
(3, 10),
(4, 3),
(4, 7),
(4, 11),
(5, 4),
(5, 8);

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
  ADD KEY `IdUsuario` (`IdUsuario`,`IdProblema`),
  ADD KEY `IdProblema` (`IdProblema`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
