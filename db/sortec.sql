-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-03-2026 a las 05:28:28
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
-- Base de datos: `sortec`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `boleto`
--

CREATE TABLE `boleto` (
  `idBoleto` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `idUsuario` varchar(10) DEFAULT NULL,
  `idSorteo` int(11) NOT NULL,
  `idCompra` varchar(17) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sorteo`
--

CREATE TABLE `sorteo` (
  `idSorteo` int(11) NOT NULL,
  `nombreSorteo` varchar(50) NOT NULL,
  `descripcion` varchar(150) NOT NULL,
  `enlaceImagen` text NOT NULL,
  `fechaJuego` date NOT NULL,
  `organizador` varchar(50) NOT NULL,
  `boletosRestantes` int(11) NOT NULL,
  `precioBoleto` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sorteo`
--

INSERT INTO `sorteo` (`idSorteo`, `nombreSorteo`, `descripcion`, `enlaceImagen`, `fechaJuego`, `organizador`, `boletosRestantes`, `precioBoleto`) VALUES
(519660382, 'Sorteo1', 'Sorteo de prueba.', 'https://images.unsplash.com/photo-1515172013099-a1a53deb7927?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Z2l2ZWF3YXl8ZW58MHx8MHx8fDA%3D', '2026-03-21', 'Yo', 120, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` varchar(10) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `rol` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombre`, `apellido`, `telefono`, `correo`, `contrasena`, `rol`) VALUES
('6Ye0zP9sqd', 'aaa', 'aaa', '1234567890', 'correo@correo.com', 'holacola', 'usuario'),
('abcdefghij', 'José', 'AtaIDE', '8712345678', 'joseA@correo.com', 'contrasena', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `boleto`
--
ALTER TABLE `boleto`
  ADD PRIMARY KEY (`idBoleto`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idSorteo` (`idSorteo`);

--
-- Indices de la tabla `sorteo`
--
ALTER TABLE `sorteo`
  ADD PRIMARY KEY (`idSorteo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `sorteo`
--
ALTER TABLE `sorteo`
  MODIFY `idSorteo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=519660383;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `boleto`
--
ALTER TABLE `boleto`
  ADD CONSTRAINT `boleto_idSorteo` FOREIGN KEY (`idSorteo`) REFERENCES `sorteo` (`idSorteo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `boleto_idUsuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
