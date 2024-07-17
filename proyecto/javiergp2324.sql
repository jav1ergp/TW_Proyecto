-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-07-2024 a las 13:47:41
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
  `numero_hab` varchar(50) DEFAULT NULL,
  `idImagen` varchar(255) NOT NULL,
  `rutaImagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitacion`
--

CREATE TABLE `habitacion` (
  `numero` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `capacidad` int DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `descripcion` text,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `estado` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'operativa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `habitacion`
--

INSERT INTO `habitacion` (`numero`, `capacidad`, `precio`, `descripcion`, `foto`, `estado`) VALUES
('23432', 677, 123.00, ' QWE                   ', NULL, 'Pendiente'),
('34232', 566, 1220.00, '         asd           ', NULL, 'Confirmada'),
('43214', 10, 23.00, '     123               ', '', 'Pendiente'),
('500', 500, 12.00, 'asd                    ', NULL, 'Confirmada'),
('5435', 3, 2.00, '    asd                ', NULL, 'Confirmada'),
('adsad', 111, 10.00, '        asd            ', NULL, 'Confirmada'),
('asdasd', 5656, 123.00, '   asd                 ', NULL, 'Confirmada'),
('asds', 51, 10.00, '       asd             ', NULL, 'Pendiente'),
('DROP TABLE fotografias;', 10, 10.00, '      asd              ', NULL, 'Confirmada'),
('eqeww', 10, 1.00, '                              DROP TABLE fotografias;\r\n          ', NULL, 'Confirmada'),
('fsdfds', 102, 10.00, '          asd          ', NULL, 'Confirmada'),
('rewr', 67, 234.00, '        sad            ', NULL, 'Confirmada'),
('sdf', 10, 1.00, '  asd                  ', NULL, 'operativa'),
('sdfsdf', 67, 1231.00, '  sadsadsa                  ', NULL, 'Confirmada'),
('sdfsdfdsfsdc x', 23, 123.00, '                                         asdasdas                   ', NULL, 'operativa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs`
--

CREATE TABLE `logs` (
  `id` int NOT NULL,
  `fecha` datetime(6) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `logs`
--

INSERT INTO `logs` (`id`, `fecha`, `descripcion`) VALUES
(1, '2024-06-04 02:28:11.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(2, '2024-06-04 02:28:11.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(3, '2024-06-04 13:02:30.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(4, '2024-06-04 13:02:30.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(5, '2024-06-04 13:05:04.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(6, '2024-06-04 13:05:04.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(7, '2024-06-04 13:05:33.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(8, '2024-06-04 13:05:33.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(9, '2024-06-04 13:07:05.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(10, '2024-06-04 13:07:05.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(11, '2024-06-04 13:10:04.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(12, '2024-06-04 13:10:04.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(13, '2024-06-04 16:19:47.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(14, '2024-06-04 16:19:47.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(15, '2024-06-04 16:20:20.000000', 'El usuario recepcionista@gmail.com ha cerrado sesión.'),
(16, '2024-06-04 16:20:20.000000', 'El usuario  ha cerrado sesión.'),
(17, '2024-06-04 16:21:53.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(18, '2024-06-04 16:21:53.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(19, '2024-06-04 16:22:05.000000', 'El usuario recepcionista@gmail.com ha cerrado sesión.'),
(20, '2024-06-04 16:22:05.000000', 'El usuario  ha cerrado sesión.'),
(21, '2024-06-04 16:32:01.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(22, '2024-06-04 16:32:02.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(23, '2024-06-04 16:35:11.000000', 'El usuario recepcionista@gmail.com ha cerrado sesión.'),
(24, '2024-06-04 16:35:11.000000', 'El usuario  ha cerrado sesión.'),
(25, '2024-06-04 16:35:17.000000', 'El usuario cliente@gmail.com ha iniciado sesión.'),
(26, '2024-06-04 16:35:17.000000', 'El usuario cliente@gmail.com ha iniciado sesión.'),
(27, '2024-06-04 16:36:11.000000', 'El usuario cliente@gmail.com ha cerrado sesión.'),
(28, '2024-06-04 16:36:11.000000', 'El usuario  ha cerrado sesión.'),
(29, '2024-06-04 16:36:14.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(30, '2024-06-04 16:36:14.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(31, '2024-06-04 16:36:43.000000', 'El usuario recepcionista@gmail.com ha cerrado sesión.'),
(32, '2024-06-04 16:36:43.000000', 'El usuario  ha cerrado sesión.'),
(33, '2024-06-04 16:36:45.000000', 'El usuario cliente@gmail.com ha iniciado sesión.'),
(34, '2024-06-04 16:36:45.000000', 'El usuario cliente@gmail.com ha iniciado sesión.'),
(35, '2024-06-04 16:38:36.000000', 'El usuario cliente@gmail.com ha cerrado sesión.'),
(36, '2024-06-04 16:38:36.000000', 'El usuario  ha cerrado sesión.'),
(37, '2024-06-04 16:38:39.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(38, '2024-06-04 16:38:39.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(39, '2024-06-04 16:39:17.000000', 'El usuario recepcionista@gmail.com ha cerrado sesión.'),
(40, '2024-06-04 16:39:17.000000', 'El usuario  ha cerrado sesión.'),
(41, '2024-06-04 16:39:20.000000', 'El usuario cliente@gmail.com ha iniciado sesión.'),
(42, '2024-06-04 16:39:20.000000', 'El usuario cliente@gmail.com ha iniciado sesión.'),
(43, '2024-06-04 16:51:31.000000', 'El usuario cliente@gmail.com ha cerrado sesión.'),
(44, '2024-06-04 16:51:31.000000', 'El usuario  ha cerrado sesión.'),
(45, '2024-06-04 16:51:34.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(46, '2024-06-04 16:51:34.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(47, '2024-06-04 17:24:37.000000', 'El usuario recepcionista@gmail.com ha cerrado sesión.'),
(48, '2024-06-04 17:24:37.000000', 'El usuario  ha cerrado sesión.'),
(49, '2024-06-04 17:24:41.000000', 'El usuario cliente@gmail.com ha iniciado sesión.'),
(50, '2024-06-04 17:24:41.000000', 'El usuario cliente@gmail.com ha iniciado sesión.'),
(51, '2024-06-04 17:51:10.000000', 'El usuario cliente@gmail.com ha cerrado sesión.'),
(52, '2024-06-04 17:51:10.000000', 'El usuario  ha cerrado sesión.'),
(53, '2024-06-04 18:36:33.000000', 'El usuario cliente@gmail.com ha iniciado sesión.'),
(54, '2024-06-04 18:36:33.000000', 'El usuario cliente@gmail.com ha iniciado sesión.'),
(55, '2024-06-04 18:37:53.000000', 'El usuario cliente@gmail.com ha cerrado sesión.'),
(56, '2024-06-04 18:37:53.000000', 'El usuario  ha cerrado sesión.'),
(57, '2024-06-04 18:38:00.000000', 'El usuario cliente@gmail.com ha iniciado sesión.'),
(58, '2024-06-04 18:38:00.000000', 'El usuario cliente@gmail.com ha iniciado sesión.'),
(59, '2024-06-04 18:47:36.000000', 'El usuario cliente@gmail.com ha cerrado sesión.'),
(60, '2024-06-04 18:47:36.000000', 'El usuario  ha cerrado sesión.'),
(61, '2024-06-04 18:47:52.000000', 'El usuario cliente@gmail.com ha iniciado sesión.'),
(62, '2024-06-04 18:47:52.000000', 'El usuario cliente@gmail.com ha iniciado sesión.'),
(63, '2024-06-04 18:52:51.000000', 'El usuario cliente@gmail.com ha cerrado sesión.'),
(64, '2024-06-04 18:52:51.000000', 'El usuario  ha cerrado sesión.'),
(65, '2024-06-04 18:53:19.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(66, '2024-06-04 18:53:19.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(67, '2024-06-04 19:11:52.000000', 'Se ha borrado una habitación'),
(68, '2024-06-04 19:14:58.000000', 'El usuario recepcionista@gmail.com ha cerrado sesión.'),
(69, '2024-06-04 19:14:58.000000', 'El usuario  ha cerrado sesión.'),
(70, '2024-06-04 19:15:35.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(71, '2024-06-04 19:15:35.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(72, '2024-06-04 19:15:36.000000', 'El usuario recepcionista@gmail.com ha cerrado sesión.'),
(73, '2024-06-04 19:15:36.000000', 'El usuario  ha cerrado sesión.'),
(74, '2024-06-04 19:16:28.000000', 'El usuario administrador@gmail.com ha iniciado sesión.'),
(75, '2024-06-04 19:16:28.000000', 'El usuario administrador@gmail.com ha iniciado sesión.'),
(76, '2024-06-04 19:17:45.000000', 'El administrador administrador@gmail.com ha editado el perfil de 2javiergp23100130@gmail.com.'),
(77, '2024-06-04 19:17:45.000000', 'El administrador administrador@gmail.com ha editado el perfil de 2javiergp23100130@gmail.com.'),
(78, '2024-06-04 19:19:16.000000', 'El usuario ha cerrado sesión.'),
(79, '2024-06-04 19:19:16.000000', 'El usuario ha cerrado sesión.'),
(80, '2024-06-04 19:20:10.000000', 'El usuario administrador@gmail.com ha iniciado sesión.'),
(81, '2024-06-04 19:20:10.000000', 'El usuario administrador@gmail.com ha iniciado sesión.'),
(82, '2024-06-04 19:25:08.000000', 'El usuario ha cerrado sesión.'),
(83, '2024-06-04 19:25:08.000000', 'El usuario ha cerrado sesión.'),
(84, '2024-06-04 19:25:12.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(85, '2024-06-04 19:25:12.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(86, '2024-06-04 19:27:25.000000', 'El usuario ha cerrado sesión.'),
(87, '2024-06-04 19:27:25.000000', 'El usuario ha cerrado sesión.'),
(88, '2024-06-04 19:27:29.000000', 'El usuario cliente@gmail.com ha iniciado sesión.'),
(89, '2024-06-04 19:27:29.000000', 'El usuario cliente@gmail.com ha iniciado sesión.'),
(90, '2024-06-04 19:27:30.000000', 'El usuario ha cerrado sesión.'),
(91, '2024-06-04 19:27:30.000000', 'El usuario ha cerrado sesión.'),
(92, '2024-06-04 19:27:33.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(93, '2024-06-04 19:27:33.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(94, '2024-06-04 19:27:53.000000', 'El usuario ha cerrado sesión.'),
(95, '2024-06-04 19:27:53.000000', 'El usuario ha cerrado sesión.'),
(96, '2024-06-04 19:27:56.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(97, '2024-06-04 19:27:56.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(98, '2024-06-04 19:28:03.000000', 'El usuario ha cerrado sesión.'),
(99, '2024-06-04 19:28:03.000000', 'El usuario ha cerrado sesión.'),
(100, '2024-06-04 19:28:06.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(101, '2024-06-04 19:28:06.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(102, '2024-06-04 19:29:05.000000', 'El usuario ha cerrado sesión.'),
(103, '2024-06-04 19:29:05.000000', 'El usuario ha cerrado sesión.'),
(104, '2024-06-04 19:29:10.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(105, '2024-06-04 19:29:10.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(106, '2024-06-04 19:31:21.000000', 'El usuario ha cerrado sesión.'),
(107, '2024-06-04 19:31:21.000000', 'El usuario ha cerrado sesión.'),
(108, '2024-06-04 19:31:24.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(109, '2024-06-04 19:31:24.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(110, '2024-06-05 17:31:41.000000', 'El usuario administrador@gmail.com ha iniciado sesión.'),
(111, '2024-06-05 17:31:41.000000', 'El usuario administrador@gmail.com ha iniciado sesión.'),
(112, '2024-06-05 20:45:30.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(113, '2024-06-05 20:45:30.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(114, '2024-06-06 16:36:38.000000', 'El usuario administrador@gmail.com ha iniciado sesión.'),
(115, '2024-06-06 16:36:38.000000', 'El usuario administrador@gmail.com ha iniciado sesión.'),
(116, '2024-06-06 19:58:25.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(117, '2024-06-06 19:58:25.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(118, '2024-06-06 20:14:29.000000', 'Se ha añadido nueva habitación.'),
(119, '2024-06-07 12:50:26.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(120, '2024-06-07 12:50:26.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(121, '2024-06-07 12:50:39.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(122, '2024-06-07 12:50:39.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(123, '2024-06-07 13:05:40.000000', 'Se ha añadido al nuevo usuario Javier con DNI: 76067757H.'),
(124, '2024-06-07 13:06:16.000000', 'Se ha añadido nueva habitación.'),
(125, '2024-06-07 15:08:34.000000', 'Se ha añadido al nuevo usuario Javier con DNI: 76067757H.'),
(126, '2024-06-07 15:18:36.000000', 'Se ha añadido al nuevo usuario Javier con DNI: 76067757H.'),
(127, '2024-06-07 15:19:35.000000', 'Se ha añadido al nuevo usuario Javier con DNI: 76067757H.'),
(128, '2024-06-07 15:25:21.000000', 'El usuario cliente@gmail.com ha iniciado sesión.'),
(129, '2024-06-07 15:25:21.000000', 'El usuario cliente@gmail.com ha iniciado sesión.'),
(130, '2024-06-07 15:26:12.000000', 'Se ha añadido al nuevo usuario Javier con DNI: 76067757H.'),
(131, '2024-06-07 15:28:56.000000', 'El usuario ha cerrado sesión.'),
(132, '2024-06-07 15:28:57.000000', 'El usuario ha cerrado sesión.'),
(133, '2024-06-07 15:29:10.000000', 'Se ha añadido al nuevo usuario Javier con DNI: 76067757H.'),
(134, '2024-06-07 15:30:07.000000', 'Se ha añadido al nuevo usuario Javier con DNI: 76067757H.'),
(135, '2024-06-07 15:34:23.000000', 'El usuario cliente@gmail.com ha iniciado sesión.'),
(136, '2024-06-07 15:34:23.000000', 'El usuario cliente@gmail.com ha iniciado sesión.'),
(137, '2024-06-07 15:34:37.000000', 'Se ha añadido al nuevo usuario Javier con DNI: 76067757H.'),
(138, '2024-06-07 17:19:40.000000', 'Se ha añadido al nuevo usuario &lt;h1&gt;Javier&lt;/h1&gt; con DNI: 76067757H.'),
(139, '2024-06-07 17:52:08.000000', 'Se ha añadido al nuevo usuario DROP TABLE fotografias; con DNI: 76067757H.'),
(140, '2024-06-07 17:53:45.000000', 'El usuario ha cerrado sesión.'),
(141, '2024-06-07 17:53:45.000000', 'El usuario ha cerrado sesión.'),
(142, '2024-06-07 17:53:50.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(143, '2024-06-07 17:53:50.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(144, '2024-06-07 17:54:04.000000', 'Se ha añadido nueva habitación.'),
(145, '2024-06-07 17:55:37.000000', 'Se ha añadido nueva habitación.'),
(146, '2024-06-07 19:07:32.000000', 'El usuario ha cerrado sesión.'),
(147, '2024-06-07 19:07:32.000000', 'El usuario ha cerrado sesión.'),
(148, '2024-06-07 19:07:35.000000', 'El usuario administrador@gmail.com ha iniciado sesión.'),
(149, '2024-06-07 19:07:35.000000', 'El usuario administrador@gmail.com ha iniciado sesión.'),
(150, '2024-06-07 19:33:48.000000', 'El usuario ha cerrado sesión.'),
(151, '2024-06-07 19:33:48.000000', 'El usuario ha cerrado sesión.'),
(152, '2024-06-07 19:33:56.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(153, '2024-06-07 19:33:56.000000', 'El usuario recepcionista@gmail.com ha iniciado sesión.'),
(154, '2024-06-07 19:34:07.000000', 'Se ha añadido nueva habitación.'),
(155, '2024-06-07 19:36:04.000000', 'Se ha añadido al nuevo usuario Javier con DNI: 76067757H.'),
(156, '2024-06-07 19:41:53.000000', 'El administrador recepcionista@gmail.com ha editado el perfil de cliente@gmail.com.'),
(157, '2024-06-07 19:41:53.000000', 'El administrador recepcionista@gmail.com ha editado el perfil de cliente@gmail.com.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `id` int NOT NULL,
  `email` varchar(50) NOT NULL,
  `numero` varchar(50) NOT NULL,
  `capacidad` int DEFAULT NULL,
  `comentarios` text,
  `dia_entrada` date DEFAULT NULL,
  `dia_salida` date DEFAULT NULL,
  `estado` enum('Vacia','Pendiente','Confirmada') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'Vacia',
  `marca_tiempo` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`id`, `email`, `numero`, `capacidad`, `comentarios`, `dia_entrada`, `dia_salida`, `estado`, `marca_tiempo`) VALUES
(21, 'recepcionista@gmail.com', 'adsad', 110, 'A          ', '2024-06-04', '2024-06-05', 'Confirmada', '2024-06-03 22:09:59'),
(30, 'recepcionista@gmail.com', '5435', 2, 'sadsad              ', '2024-06-04', '2024-06-05', 'Confirmada', '2024-06-04 11:17:02'),
(31, '1javiergp23100130@gmail.com', 'adsad', 35, 'A          ', '2024-06-04', '2024-06-05', 'Confirmada', '2024-06-04 11:23:29'),
(32, '1javiergp23100130@gmail.com', '500', 34, 'asd                        ', '2024-06-04', '2024-06-05', 'Confirmada', '2024-06-04 12:23:48'),
(33, '1javiergp23100130@gmail.com', '34232', 34, 'asd&quot;\r\n                        ', '2024-06-04', '2024-06-05', 'Confirmada', '2024-06-04 14:35:08'),
(36, '1javiergp23100130@gmail.com', 'asdasd', 2, '         asd                                       ', '2024-06-18', '2024-06-28', 'Confirmada', '2024-06-06 18:03:32'),
(37, '1javiergp23100130@gmail.com', 'sdfsdf', 3, 'cccccccccccc                                           ', '2024-06-20', '2024-06-23', 'Confirmada', '2024-06-06 18:14:54'),
(39, 'cliente@gmail.com', 'eqeww', 1, '        ASDASDA                                        ', '2024-06-07', '2024-06-29', 'Confirmada', '2024-06-07 16:04:54');

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
('Javier', 'Perez', '76067757H', '1javiergp23100130@gmail.com', '$2y$10$d1bhuM7/huCu57N3QbXS5.kY5S0UDLvHt/clB1PoGdHxdrPdGP.5a', '1234567891234567', 'administrador'),
('Javier', 'Perez', '76067757H', '2javiergp23100130@gmail.com', '$2y$10$4WGyXQf5CiCFKRQmwJ.MsuF698CqWSmjLt75jILvEK.mnv8aox2vu', '1234567891234569', 'recepcionista'),
('Javier', 'Perez', '76067757H', 'administrador@gmail.com', '$2y$10$FTyu3X4Ozx7tNNGLtj.kSudgu4G4bH..fKXPcSh82xk1P8475i3uu', '1234567891234567', 'administrador'),
('Javier', 'Perez2', '76067757H', 'cliente@gmail.com', '$2y$10$HX1gZDOfzmEaMyZatW2Q5O5gbyGrD5f9XeL5bZmOVWSLSmUcRufQ6', '1234567891234569', 'cliente'),
('Javier', 'Perez', '76067757H', 'jaadsASDviergp23100130@gmail.com', '$2y$10$bCPmFkgdnDNlZ4utrcoK5uOxmS4ILwGJslyijt7kv1yzAZ0rQFvUC', '1234567891234567', 'cliente'),
('Javier', 'Perez', '76067757H', 'jasdfdsfviergp23100130@gmail.com', '$2y$10$AeE.IZ1W1Y.wDOfSKhPQCe1Es5hPBJtrBOxcqBTTV20hCs.iPOCvW', '1234567891234567', 'cliente'),
('Javier', 'Perez', '76067757H', 'javier23gp23100130@gmail.com', '$2y$10$JLrA9m413h6C2WuaCSQ/k.O5ZJL44ASgeGRHORFT6k4Y1.YBrp3sK', '1234567891234567', 'cliente'),
('Javier', 'Perez', '76067757H', 'javiergp23100130@gmail.com', '$2y$10$75z5mt18TJ2HQ4tSCRE3X.P.JJcLFCwrjxtEBgDU41zoFJVVaXvb.', '1234567891234567', 'cliente'),
('&lt;h1&gt;Javier&lt;/h1&gt;', 'Perez', '76067757H', 'javiergp2310sadsd0130@gmail.com', '$2y$10$Rq4okEzbe2NhcyQDY3Twhuhh3u.bt3s0ieBJ6XMBnNIWOegjlCbIa', '1234567891234567', 'cliente'),
('DROP TABLE fotografias;', 'Perez', '76067757H', 'javiergp231321312100130@gmail.com', '$2y$10$k7mf1Y.8yneBdZXRoerA9O0RxMnWB2mXT8Ww38.1nGdMGhwmJa8Gy', '1234567891234567', 'cliente'),
('Javier', 'Perez', '76067757H', 'javiergp23sadsad100130@gmail.com', '$2y$10$UFo0/5bTIzRKiWEe4K6XEOo1eH9A6cZF04HaWl4BdQNn/DgjEEM76', '1234567891234567', 'cliente'),
('Javier', 'Perez', '76067757H', 'javiesfdsfsdfrgp23100130@gmail.com', '$2y$10$ONqmVoeJeAZeEw1sYO3ExuOAauZQ9rf.XXjspjYedoreVsfxY/KGm', '1234567891234567', 'cliente'),
('Javier', 'Perez', '76067757H', 'jSSSSSSSSSSSaviergp23100130@gmail.com', '$2y$10$Ynw5uI.mXz7Skg7x3OJqReWby8eJ4yHVIQSNeHCAizcXp6FMh9sfK', '1234567891234567', 'cliente'),
('Javier', 'Perez', '76067757H', 'recepcionista@gmail.com', '$2y$10$GiR4Yt2S.BE6CrAyubK2OuW4pB0YSAt4cQT7tjTg54BNThD7r6PAW', '1234567891234567', 'recepcionista');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `fotografias`
--
ALTER TABLE `fotografias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `numero_hab` (`numero_hab`);

--
-- Indices de la tabla `habitacion`
--
ALTER TABLE `habitacion`
  ADD PRIMARY KEY (`numero`);

--
-- Indices de la tabla `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `numero` (`numero`);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `fotografias`
--
ALTER TABLE `fotografias`
  ADD CONSTRAINT `fotografias_ibfk_1` FOREIGN KEY (`numero_hab`) REFERENCES `habitacion` (`numero`) ON DELETE CASCADE;

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`email`) REFERENCES `usuarios` (`email`),
  ADD CONSTRAINT `reserva_ibfk_2` FOREIGN KEY (`numero`) REFERENCES `habitacion` (`numero`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
