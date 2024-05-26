-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-05-2024 a las 21:31:02
-- Versión del servidor: 8.4.0
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `javiergp2324`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotografias`
--

CREATE TABLE `fotografias` (
  `id` int NOT NULL,
  `habitacion_id` int NOT NULL,
  `imagen` longblob NOT NULL,
  `nombre_imagen` varchar(255) NOT NULL,
  `tipo_imagen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitaciones`
--

CREATE TABLE `habitaciones` (
  `id` int NOT NULL,
  `numero` varchar(50) NOT NULL,
  `capacidad` int DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id` int NOT NULL,
  `email` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `habitacion_id` int NOT NULL,
  `num_huespedes` int NOT NULL,
  `comentarios` text,
  `fecha_entrada` date NOT NULL,
  `fecha_salida` date NOT NULL,
  `estado` enum('Pendiente','Confirmada') DEFAULT 'Pendiente',
  `marca_de_tiempo` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `apellidos` varchar(255) DEFAULT NULL,
  `dni` varchar(9) DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `clave` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `tarjeta` varchar(16) NOT NULL,
  `rol` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`nombre`, `apellidos`, `dni`, `email`, `clave`, `tarjeta`, `rol`) VALUES
('Javier', 'Perez', '76067757H', 'j123232aviergp23100130@gmail.com', '$2y$10$kYtMYBhcwsQ/IQQHSB1AL.zXWbw7Svdbl3FpmhAhiYMvqugwg46lG', '1234567891234567', ''),
('Javier', 'Perez', '76067757H', 'j23213viergp23100130@gmail.com', '$2y$10$0H7seqX8xqoxBPrNOOEdY.6a.3KqXNiGAsyQJzc210Igt9HisxbPm', '1234567891234567', ''),
('Javier', 'Perez', '76067757H', 'javi234rgp23100130@gmail.com', '$2y$10$HpJpeR.rjbg.zyFQpphHC.QhVDvy7SMXAlC3tXXXOMc6PrLJbvO9i', '1234567891234567', 'administrador'),
('123213', 'Perez', '76067757H', 'javie2222rgp23100130@gmail.com', '$2y$10$y0AZBGyAiBNvgor/w02Qre0e/nAZp2VjqLhhf5.r0D6W1KVfLIrbS', '1234567891234567', ''),
('12', 'Perez', '76067757H', 'javie22rgp23100130@gmail.com', '$2y$10$Mgzn6j9eAj2clA9XFXD01OksTPMZQ5n9k/QaiLdBB66nZqCpBaxZa', '0', ''),
('3', 'Perez', '76067757H', 'javier2gp23100130@gmail.com', '$2y$10$g3/FU2UKjz7vc6MY2YvaeuED8EDmvoVLcYBp46HQT0bRQzcD0exi6', '0', ''),
('Javier', 'Perez', '76067757H', 'javiergp21323100130@gmail.com', '$2y$10$YsfMFwt0JqZe7mNG2iQABOhoTs0woezlF3LMKlYwrcSZpCFlvT8oy', '1234567891234567', ''),
('Javier', 'Perez', '76067757H', 'javiergp2233100130@gmail.com', '$2y$10$cV8SNVlv3XFv8QgBIDzqWeLDkurhK2whtm3UWRI6hTLPcdbmfpeZa', '1234567891234567', ''),
('1', 'Perez', '76067757H', 'javiergp23100130@gmail.com', '$2y$10$bi/J1Hs/uOL9KU0FoKFzauCIBrIrukMTD7IQx8fCAjTQU/8BuTGmK', '0', ''),
('Javier', 'Perez', '76067757H', 'javiergp23223100130@gmail.com', '$2y$10$q0oJU5Apw6Bsv543uSpLr.ecV2yUV73ik0r6EiegeiWFPbcA3oLoG', '1234567891234567', ''),
('Javier', 'Perez', '76067757H', 'javiergp23232100130@gmail.com', '$2y$10$i935Yk3.bhmBfVStFt/Z6en4vs63zA6dlrA.6VWhzQhrjYmYJQrqm', '1234567891234567', 'cliente'),
('Javier', 'Perez', '76067757H', 'javiergp233100130@gmail.com4435', '$2y$10$Xr5XcjQxxLS96smYciCjd.Op8Q3o1zT8vn1npnO8XsGcjbHAy0k5q', '1234567891234567', ''),
('123', 'Perez', '76067757H', 'javiergp23ewr100130@gmail.com', '$2y$10$gJMBVGlIpgijNYSdgyJCpeKeXaE2.VkXH44ulIsJNuty6u5VSWGeW', '0', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `fotografias`
--
ALTER TABLE `fotografias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `habitacion_id` (`habitacion_id`);

--
-- Indices de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`email`),
  ADD KEY `habitacion_id` (`habitacion_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `fotografias`
--
ALTER TABLE `fotografias`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `fotografias`
--
ALTER TABLE `fotografias`
  ADD CONSTRAINT `fotografias_ibfk_1` FOREIGN KEY (`habitacion_id`) REFERENCES `habitaciones` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`email`) REFERENCES `usuarios` (`email`),
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`habitacion_id`) REFERENCES `habitaciones` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
