-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 10-07-2024 a las 05:50:00
-- Versión del servidor: 8.0.37-0ubuntu0.23.10.2
-- Versión de PHP: 8.2.10-2ubuntu2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbmedios_gbm`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `first_login` tinyint(1) DEFAULT '1',
  `Code_Temp` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`, `role`, `email`, `first_login`, `Code_Temp`) VALUES
(1, 'Root', '$2y$10$8pUcRG8HbGvXYMZOczP2eOdUd0Wp9gpo.gefQMaGpCfmxyBOx.MTK', 'root', 'r@root.com', 0, 'TDMm'),
(3, 'Operador', 'GBM123', 'operator', 'o@operator.com', 1, NULL),
(6, 'Admin', '$2y$10$qhn17v748z6OkpKO5VqVXO/9HA0nPVH0KcbpICn6YySHmZ5Y5M9Yi', 'admin', 'a@admin.com', 0, NULL),
(24, 'Gerardo Manzur', 'GBM123', 'operator', 'gmanzur@gbm.net', 1, NULL),
(25, 'Heber Ulloa', 'GBM123', 'operator', 'hgulloa@gbm.net', 1, NULL),
(26, 'Jaciel Hernandez', 'GBM123', 'operator', 'jjhernandez@gbm.net', 1, NULL),
(27, 'Lenin Mejia', 'GBM123', 'admin', 'lmejia@gbm.net', 1, NULL),
(28, 'Mileny Pineda', 'GBM123', 'operator', 'mpineda@gbm.net', 1, NULL),
(29, 'Alejandro Colindres', 'GBM123', 'admin', 'acolindres@gbm.net', 1, NULL),
(30, 'Brandon Ventura', 'GBM123', 'operator', 'bventura@gbm.net', 1, '7874'),
(32, 'Carlos Pineda', 'GBM123', 'operator', 'capineda@gbm.net', 1, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
