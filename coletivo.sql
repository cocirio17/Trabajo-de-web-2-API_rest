-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-10-2024 a las 23:57:34
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
-- Base de datos: `coletivo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `boleto`
--

CREATE TABLE `boleto` (
  `id_boleto` int(11) NOT NULL,
  `destino_inicio` varchar(45) NOT NULL,
  `destino_fin` varchar(45) NOT NULL,
  `fecha_salida` date NOT NULL,
  `precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `boleto`
--

INSERT INTO `boleto` (`id_boleto`, `destino_inicio`, `destino_fin`, `fecha_salida`, `precio`) VALUES
(1, 'Buenos Aires', 'Córdoba', '2024-11-01', 1500),
(2, 'Buenos Aires', 'Mendoza', '2024-11-05', 2000),
(3, 'Córdoba', 'Salta', '2024-11-10', 1800),
(4, 'Mendoza', 'Bariloche', '2024-11-15', 2200),
(5, 'Buenos Aires', 'Ushuaia', '2024-12-01', 3000),
(6, 'Mar Del Plata', 'Tandil', '2024-09-05', 6000),
(7, 'Mar Del Plata', 'Buenos Aires', '2024-09-10', 5000),
(8, 'Córdoba', 'Mendoza', '2024-09-12', 8000),
(9, 'Tandil', 'La Plata', '2024-09-15', 3500),
(10, 'Rosario', 'Salta', '2024-09-18', 9500),
(11, 'Bariloche', 'Neuquén', '2024-09-20', 11000),
(12, 'De zamora', 'Rivadavia', '2024-09-22', 0),
(13, 'Bahía Blanca', 'Santa Rosa', '2024-09-25', 4000),
(14, 'Posadas', 'Formosa', '2024-09-28', 3000),
(15, 'San Juan', 'San Luis', '2024-10-01', 6000),
(16, 'Resistencia', 'Corrientes', '2024-10-03', 2000),
(17, 'Santiago del Estero', 'Catamarca', '2024-10-05', 4500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id_pasajero` int(11) NOT NULL,
  `dni` int(9) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `edad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id_pasajero`, `dni`, `nombre`, `apellido`, `edad`) VALUES
(1, 45320123, 'Franco', 'De la torrre', 22),
(2, 40123456, 'Carlos', 'Montes', 40),
(3, 46902186, 'Juan Antonio', 'Calortino', 32),
(4, 37895124, 'Laura', 'Fernández', 39),
(5, 48902123, 'Pedro', 'Martínez', 25),
(6, 40239487, 'Ana', 'García', 30),
(7, 47902345, 'Lucía', 'Rodríguez', 34),
(8, 45678910, 'Jorge', 'Ramírez', 41),
(9, 44123456, 'Sofía', 'Martínez', 29),
(10, 43123457, 'Fernando', 'Alonso', 37),
(11, 45123458, 'Raúl', 'Domínguez', 44),
(12, 46982345, 'Claudia', 'Gómez', 33),
(13, 46123459, 'Andrés', 'Paredes', 36),
(14, 47895123, 'Valeria', 'Salazar', 27),
(15, 48765432, 'Sergio', 'Cruz', 31),
(16, 49321012, 'Natalia', 'Vargas', 29),
(17, 40567891, 'Gustavo', 'Santos', 35),
(18, 49234567, 'Marta', 'Ibarra', 38),
(19, 48591234, 'Diego', 'Cortes', 26),
(20, 46789012, 'Silvia', 'Lopez', 42),
(21, 47987654, 'Oscar', 'Pérez', 30),
(22, 47123456, 'Patricia', 'Morales', 39);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(45) NOT NULL,
  `contrasenea` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `contrasenea`) VALUES
(1, 'webadmin', '$2y$10$tOWtmXxSkXBAmL65u0SIZeO8yoqt3TRDExcFV13hpaKjyLZ6fw5q6');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viaje`
--

CREATE TABLE `viaje` (
  `id_viaje` int(11) NOT NULL,
  `destino_inicio` varchar(20) NOT NULL,
  `destino_fin` varchar(20) NOT NULL,
  `fecha_salida` date NOT NULL,
  `precio` int(10) NOT NULL,
  `id_pasajero` int(11) NOT NULL,
  `imagen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `viaje`
--

INSERT INTO `viaje` (`id_viaje`, `destino_inicio`, `destino_fin`, `fecha_salida`, `precio`, `id_pasajero`, `imagen`) VALUES
(2, 'San Lorenzo', 'Azul', '2024-10-19', 30000, 14, 'img/67106021300f8.jpg'),
(3, 'Rosario', 'Mendoza', '2024-11-15', 1800, 3, 'img/6710609251440.jpg'),
(4, 'Salta', 'Tucumán', '2024-12-05', 1200, 4, 'img/671061d436d19.jpg'),
(5, 'Neuquén', 'Bariloche', '2024-12-20', 2000, 5, 'img/67106188b91fb.jpg'),
(6, 'La Plata', 'Mar del Plata', '2024-10-25', 900, 6, ''),
(7, 'Santa Fe', 'Posadas', '2024-11-10', 1600, 7, ''),
(8, 'San Juan', 'San Luis', '2024-12-15', 1700, 8, ''),
(9, 'Resistencia', 'Formosa', '2024-11-30', 1400, 9, ''),
(10, 'Bahía Blanca', 'Viedma', '2024-12-25', 1300, 10, ''),
(11, 'Córdoba', 'Salta', '2024-10-15', 1400, 1, ''),
(12, 'Mendoza', 'Neuquén', '2024-11-05', 1600, 2, ''),
(13, 'Tandil', 'Mar del Plata', '2024-11-20', 900, 3, ''),
(14, 'Rosario', 'Buenos Aires', '2024-12-10', 1300, 4, ''),
(15, 'Mar del plata', 'Azul', '2024-10-10', 9200, 7, ''),
(16, 'Mar del plata', 'Loberia', '2024-10-17', 4500, 3, ''),
(17, 'Mar del plata', 'Azul', '2024-10-19', 300, 4, ''),
(20, 'San Antonio', 'Pigue', '2025-01-07', 90000, 15, ''),
(21, 'Colon', 'Rosario', '2025-12-19', 90000, 1, ''),
(22, 'San juan', 'Mendoza', '2024-10-31', 80000, 3, ''),
(25, 'Mar del plata', 'Cordoba', '2024-02-12', 4000, 12, '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `boleto`
--
ALTER TABLE `boleto`
  ADD PRIMARY KEY (`id_boleto`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id_pasajero`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `viaje`
--
ALTER TABLE `viaje`
  ADD PRIMARY KEY (`id_viaje`),
  ADD KEY `id_pasajero` (`id_pasajero`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `boleto`
--
ALTER TABLE `boleto`
  MODIFY `id_boleto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id_pasajero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `viaje`
--
ALTER TABLE `viaje`
  MODIFY `id_viaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `viaje`
--
ALTER TABLE `viaje`
  ADD CONSTRAINT `viaje_ibfk_1` FOREIGN KEY (`id_pasajero`) REFERENCES `personas` (`id_pasajero`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
