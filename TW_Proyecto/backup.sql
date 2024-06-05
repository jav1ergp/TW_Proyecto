CREATE TABLE `fotografias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `numero_hab` varchar(50) DEFAULT NULL,
  `idImagen` varchar(255) NOT NULL,
  `rutaImagen` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `numero_hab` (`numero_hab`),
  CONSTRAINT `fotografias_ibfk_1` FOREIGN KEY (`numero_hab`) REFERENCES `habitacion` (`numero`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



CREATE TABLE `habitacion` (
  `numero` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `capacidad` int DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `descripcion` text,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `estado` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'operativa',
  PRIMARY KEY (`numero`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO habitacion SET numero: '23432', capacidad: '677', precio: '123.00', descripcion: ' QWE                   ', foto: '', estado: 'Pendiente';
INSERT INTO habitacion SET numero: '34232', capacidad: '566', precio: '1220.00', descripcion: '         asd           ', foto: '', estado: 'Confirmada';
INSERT INTO habitacion SET numero: '43214', capacidad: '10', precio: '23.00', descripcion: '     123               ', foto: '', estado: 'Pendiente';
INSERT INTO habitacion SET numero: '500', capacidad: '500', precio: '12.00', descripcion: 'asd                    ', foto: '', estado: 'Confirmada';
INSERT INTO habitacion SET numero: '5435', capacidad: '3', precio: '2.00', descripcion: '    asd                ', foto: '', estado: 'Confirmada';
INSERT INTO habitacion SET numero: 'adsad', capacidad: '111', precio: '10.00', descripcion: '        asd            ', foto: '', estado: 'Confirmada';
INSERT INTO habitacion SET numero: 'asdasd', capacidad: '5656', precio: '123.00', descripcion: '   asd                 ', foto: '', estado: 'operativa';
INSERT INTO habitacion SET numero: 'asds', capacidad: '51', precio: '10.00', descripcion: '       asd             ', foto: '', estado: 'Pendiente';
INSERT INTO habitacion SET numero: 'fsdfds', capacidad: '102', precio: '10.00', descripcion: '          asd          ', foto: '', estado: 'Confirmada';
INSERT INTO habitacion SET numero: 'rewr', capacidad: '67', precio: '234.00', descripcion: '        sad            ', foto: '', estado: 'Confirmada';


CREATE TABLE `logs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fecha` datetime(6) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO logs SET id: '1', fecha: '2024-06-04 02:28:11.000000', descripcion: 'El usuario recepcionista@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '2', fecha: '2024-06-04 02:28:11.000000', descripcion: 'El usuario recepcionista@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '3', fecha: '2024-06-04 13:02:30.000000', descripcion: 'El usuario recepcionista@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '4', fecha: '2024-06-04 13:02:30.000000', descripcion: 'El usuario recepcionista@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '5', fecha: '2024-06-04 13:05:04.000000', descripcion: 'El usuario recepcionista@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '6', fecha: '2024-06-04 13:05:04.000000', descripcion: 'El usuario recepcionista@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '7', fecha: '2024-06-04 13:05:33.000000', descripcion: 'El usuario recepcionista@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '8', fecha: '2024-06-04 13:05:33.000000', descripcion: 'El usuario recepcionista@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '9', fecha: '2024-06-04 13:07:05.000000', descripcion: 'El usuario recepcionista@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '10', fecha: '2024-06-04 13:07:05.000000', descripcion: 'El usuario recepcionista@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '11', fecha: '2024-06-04 13:10:04.000000', descripcion: 'El usuario recepcionista@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '12', fecha: '2024-06-04 13:10:04.000000', descripcion: 'El usuario recepcionista@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '13', fecha: '2024-06-04 16:19:47.000000', descripcion: 'El usuario recepcionista@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '14', fecha: '2024-06-04 16:19:47.000000', descripcion: 'El usuario recepcionista@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '15', fecha: '2024-06-04 16:20:20.000000', descripcion: 'El usuario recepcionista@gmail.com ha cerrado sesión.';
INSERT INTO logs SET id: '16', fecha: '2024-06-04 16:20:20.000000', descripcion: 'El usuario  ha cerrado sesión.';
INSERT INTO logs SET id: '17', fecha: '2024-06-04 16:21:53.000000', descripcion: 'El usuario recepcionista@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '18', fecha: '2024-06-04 16:21:53.000000', descripcion: 'El usuario recepcionista@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '19', fecha: '2024-06-04 16:22:05.000000', descripcion: 'El usuario recepcionista@gmail.com ha cerrado sesión.';
INSERT INTO logs SET id: '20', fecha: '2024-06-04 16:22:05.000000', descripcion: 'El usuario  ha cerrado sesión.';
INSERT INTO logs SET id: '21', fecha: '2024-06-04 16:32:01.000000', descripcion: 'El usuario recepcionista@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '22', fecha: '2024-06-04 16:32:02.000000', descripcion: 'El usuario recepcionista@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '23', fecha: '2024-06-04 16:35:11.000000', descripcion: 'El usuario recepcionista@gmail.com ha cerrado sesión.';
INSERT INTO logs SET id: '24', fecha: '2024-06-04 16:35:11.000000', descripcion: 'El usuario  ha cerrado sesión.';
INSERT INTO logs SET id: '25', fecha: '2024-06-04 16:35:17.000000', descripcion: 'El usuario cliente@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '26', fecha: '2024-06-04 16:35:17.000000', descripcion: 'El usuario cliente@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '27', fecha: '2024-06-04 16:36:11.000000', descripcion: 'El usuario cliente@gmail.com ha cerrado sesión.';
INSERT INTO logs SET id: '28', fecha: '2024-06-04 16:36:11.000000', descripcion: 'El usuario  ha cerrado sesión.';
INSERT INTO logs SET id: '29', fecha: '2024-06-04 16:36:14.000000', descripcion: 'El usuario recepcionista@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '30', fecha: '2024-06-04 16:36:14.000000', descripcion: 'El usuario recepcionista@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '31', fecha: '2024-06-04 16:36:43.000000', descripcion: 'El usuario recepcionista@gmail.com ha cerrado sesión.';
INSERT INTO logs SET id: '32', fecha: '2024-06-04 16:36:43.000000', descripcion: 'El usuario  ha cerrado sesión.';
INSERT INTO logs SET id: '33', fecha: '2024-06-04 16:36:45.000000', descripcion: 'El usuario cliente@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '34', fecha: '2024-06-04 16:36:45.000000', descripcion: 'El usuario cliente@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '35', fecha: '2024-06-04 16:38:36.000000', descripcion: 'El usuario cliente@gmail.com ha cerrado sesión.';
INSERT INTO logs SET id: '36', fecha: '2024-06-04 16:38:36.000000', descripcion: 'El usuario  ha cerrado sesión.';
INSERT INTO logs SET id: '37', fecha: '2024-06-04 16:38:39.000000', descripcion: 'El usuario recepcionista@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '38', fecha: '2024-06-04 16:38:39.000000', descripcion: 'El usuario recepcionista@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '39', fecha: '2024-06-04 16:39:17.000000', descripcion: 'El usuario recepcionista@gmail.com ha cerrado sesión.';
INSERT INTO logs SET id: '40', fecha: '2024-06-04 16:39:17.000000', descripcion: 'El usuario  ha cerrado sesión.';
INSERT INTO logs SET id: '41', fecha: '2024-06-04 16:39:20.000000', descripcion: 'El usuario cliente@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '42', fecha: '2024-06-04 16:39:20.000000', descripcion: 'El usuario cliente@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '43', fecha: '2024-06-04 16:51:31.000000', descripcion: 'El usuario cliente@gmail.com ha cerrado sesión.';
INSERT INTO logs SET id: '44', fecha: '2024-06-04 16:51:31.000000', descripcion: 'El usuario  ha cerrado sesión.';
INSERT INTO logs SET id: '45', fecha: '2024-06-04 16:51:34.000000', descripcion: 'El usuario recepcionista@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '46', fecha: '2024-06-04 16:51:34.000000', descripcion: 'El usuario recepcionista@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '47', fecha: '2024-06-04 17:24:37.000000', descripcion: 'El usuario recepcionista@gmail.com ha cerrado sesión.';
INSERT INTO logs SET id: '48', fecha: '2024-06-04 17:24:37.000000', descripcion: 'El usuario  ha cerrado sesión.';
INSERT INTO logs SET id: '49', fecha: '2024-06-04 17:24:41.000000', descripcion: 'El usuario cliente@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '50', fecha: '2024-06-04 17:24:41.000000', descripcion: 'El usuario cliente@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '51', fecha: '2024-06-04 17:51:10.000000', descripcion: 'El usuario cliente@gmail.com ha cerrado sesión.';
INSERT INTO logs SET id: '52', fecha: '2024-06-04 17:51:10.000000', descripcion: 'El usuario  ha cerrado sesión.';
INSERT INTO logs SET id: '53', fecha: '2024-06-04 18:36:33.000000', descripcion: 'El usuario cliente@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '54', fecha: '2024-06-04 18:36:33.000000', descripcion: 'El usuario cliente@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '55', fecha: '2024-06-04 18:37:53.000000', descripcion: 'El usuario cliente@gmail.com ha cerrado sesión.';
INSERT INTO logs SET id: '56', fecha: '2024-06-04 18:37:53.000000', descripcion: 'El usuario  ha cerrado sesión.';
INSERT INTO logs SET id: '57', fecha: '2024-06-04 18:38:00.000000', descripcion: 'El usuario cliente@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '58', fecha: '2024-06-04 18:38:00.000000', descripcion: 'El usuario cliente@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '59', fecha: '2024-06-04 18:47:36.000000', descripcion: 'El usuario cliente@gmail.com ha cerrado sesión.';
INSERT INTO logs SET id: '60', fecha: '2024-06-04 18:47:36.000000', descripcion: 'El usuario  ha cerrado sesión.';
INSERT INTO logs SET id: '61', fecha: '2024-06-04 18:47:52.000000', descripcion: 'El usuario cliente@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '62', fecha: '2024-06-04 18:47:52.000000', descripcion: 'El usuario cliente@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '63', fecha: '2024-06-04 18:52:51.000000', descripcion: 'El usuario cliente@gmail.com ha cerrado sesión.';
INSERT INTO logs SET id: '64', fecha: '2024-06-04 18:52:51.000000', descripcion: 'El usuario  ha cerrado sesión.';
INSERT INTO logs SET id: '65', fecha: '2024-06-04 18:53:19.000000', descripcion: 'El usuario recepcionista@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '66', fecha: '2024-06-04 18:53:19.000000', descripcion: 'El usuario recepcionista@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '67', fecha: '2024-06-04 19:11:52.000000', descripcion: 'Se ha borrado una habitación';
INSERT INTO logs SET id: '68', fecha: '2024-06-04 19:14:58.000000', descripcion: 'El usuario recepcionista@gmail.com ha cerrado sesión.';
INSERT INTO logs SET id: '69', fecha: '2024-06-04 19:14:58.000000', descripcion: 'El usuario  ha cerrado sesión.';
INSERT INTO logs SET id: '70', fecha: '2024-06-04 19:15:35.000000', descripcion: 'El usuario recepcionista@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '71', fecha: '2024-06-04 19:15:35.000000', descripcion: 'El usuario recepcionista@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '72', fecha: '2024-06-04 19:15:36.000000', descripcion: 'El usuario recepcionista@gmail.com ha cerrado sesión.';
INSERT INTO logs SET id: '73', fecha: '2024-06-04 19:15:36.000000', descripcion: 'El usuario  ha cerrado sesión.';
INSERT INTO logs SET id: '74', fecha: '2024-06-04 19:16:28.000000', descripcion: 'El usuario administrador@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '75', fecha: '2024-06-04 19:16:28.000000', descripcion: 'El usuario administrador@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '76', fecha: '2024-06-04 19:17:45.000000', descripcion: 'El administrador administrador@gmail.com ha editado el perfil de 2javiergp23100130@gmail.com.';
INSERT INTO logs SET id: '77', fecha: '2024-06-04 19:17:45.000000', descripcion: 'El administrador administrador@gmail.com ha editado el perfil de 2javiergp23100130@gmail.com.';
INSERT INTO logs SET id: '78', fecha: '2024-06-04 19:19:16.000000', descripcion: 'El usuario ha cerrado sesión.';
INSERT INTO logs SET id: '79', fecha: '2024-06-04 19:19:16.000000', descripcion: 'El usuario ha cerrado sesión.';
INSERT INTO logs SET id: '80', fecha: '2024-06-04 19:20:10.000000', descripcion: 'El usuario administrador@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '81', fecha: '2024-06-04 19:20:10.000000', descripcion: 'El usuario administrador@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '82', fecha: '2024-06-04 19:25:08.000000', descripcion: 'El usuario ha cerrado sesión.';
INSERT INTO logs SET id: '83', fecha: '2024-06-04 19:25:08.000000', descripcion: 'El usuario ha cerrado sesión.';
INSERT INTO logs SET id: '84', fecha: '2024-06-04 19:25:12.000000', descripcion: 'El usuario recepcionista@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '85', fecha: '2024-06-04 19:25:12.000000', descripcion: 'El usuario recepcionista@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '86', fecha: '2024-06-04 19:27:25.000000', descripcion: 'El usuario ha cerrado sesión.';
INSERT INTO logs SET id: '87', fecha: '2024-06-04 19:27:25.000000', descripcion: 'El usuario ha cerrado sesión.';
INSERT INTO logs SET id: '88', fecha: '2024-06-04 19:27:29.000000', descripcion: 'El usuario cliente@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '89', fecha: '2024-06-04 19:27:29.000000', descripcion: 'El usuario cliente@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '90', fecha: '2024-06-04 19:27:30.000000', descripcion: 'El usuario ha cerrado sesión.';
INSERT INTO logs SET id: '91', fecha: '2024-06-04 19:27:30.000000', descripcion: 'El usuario ha cerrado sesión.';
INSERT INTO logs SET id: '92', fecha: '2024-06-04 19:27:33.000000', descripcion: 'El usuario recepcionista@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '93', fecha: '2024-06-04 19:27:33.000000', descripcion: 'El usuario recepcionista@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '94', fecha: '2024-06-04 19:27:53.000000', descripcion: 'El usuario ha cerrado sesión.';
INSERT INTO logs SET id: '95', fecha: '2024-06-04 19:27:53.000000', descripcion: 'El usuario ha cerrado sesión.';
INSERT INTO logs SET id: '96', fecha: '2024-06-04 19:27:56.000000', descripcion: 'El usuario recepcionista@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '97', fecha: '2024-06-04 19:27:56.000000', descripcion: 'El usuario recepcionista@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '98', fecha: '2024-06-04 19:28:03.000000', descripcion: 'El usuario ha cerrado sesión.';
INSERT INTO logs SET id: '99', fecha: '2024-06-04 19:28:03.000000', descripcion: 'El usuario ha cerrado sesión.';
INSERT INTO logs SET id: '100', fecha: '2024-06-04 19:28:06.000000', descripcion: 'El usuario recepcionista@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '101', fecha: '2024-06-04 19:28:06.000000', descripcion: 'El usuario recepcionista@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '102', fecha: '2024-06-04 19:29:05.000000', descripcion: 'El usuario ha cerrado sesión.';
INSERT INTO logs SET id: '103', fecha: '2024-06-04 19:29:05.000000', descripcion: 'El usuario ha cerrado sesión.';
INSERT INTO logs SET id: '104', fecha: '2024-06-04 19:29:10.000000', descripcion: 'El usuario recepcionista@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '105', fecha: '2024-06-04 19:29:10.000000', descripcion: 'El usuario recepcionista@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '106', fecha: '2024-06-04 19:31:21.000000', descripcion: 'El usuario ha cerrado sesión.';
INSERT INTO logs SET id: '107', fecha: '2024-06-04 19:31:21.000000', descripcion: 'El usuario ha cerrado sesión.';
INSERT INTO logs SET id: '108', fecha: '2024-06-04 19:31:24.000000', descripcion: 'El usuario recepcionista@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '109', fecha: '2024-06-04 19:31:24.000000', descripcion: 'El usuario recepcionista@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '110', fecha: '2024-06-05 16:42:09.000000', descripcion: 'El usuario cliente@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '111', fecha: '2024-06-05 16:42:09.000000', descripcion: 'El usuario cliente@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '112', fecha: '2024-06-05 16:42:11.000000', descripcion: 'El usuario ha cerrado sesión.';
INSERT INTO logs SET id: '113', fecha: '2024-06-05 16:42:11.000000', descripcion: 'El usuario ha cerrado sesión.';
INSERT INTO logs SET id: '114', fecha: '2024-06-05 16:42:17.000000', descripcion: 'El usuario administrador@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '115', fecha: '2024-06-05 16:42:18.000000', descripcion: 'El usuario administrador@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '116', fecha: '2024-06-05 17:02:36.000000', descripcion: 'El usuario ha cerrado sesión.';
INSERT INTO logs SET id: '117', fecha: '2024-06-05 17:02:36.000000', descripcion: 'El usuario ha cerrado sesión.';
INSERT INTO logs SET id: '118', fecha: '2024-06-05 17:02:43.000000', descripcion: 'El usuario administrador@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '119', fecha: '2024-06-05 17:02:43.000000', descripcion: 'El usuario administrador@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '120', fecha: '2024-06-05 17:47:04.000000', descripcion: 'El usuario ha cerrado sesión.';
INSERT INTO logs SET id: '121', fecha: '2024-06-05 17:47:04.000000', descripcion: 'El usuario ha cerrado sesión.';
INSERT INTO logs SET id: '122', fecha: '2024-06-05 17:47:08.000000', descripcion: 'El usuario administrador@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '123', fecha: '2024-06-05 17:47:09.000000', descripcion: 'El usuario administrador@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '124', fecha: '2024-06-05 18:07:15.000000', descripcion: 'El usuario ha cerrado sesión.';
INSERT INTO logs SET id: '125', fecha: '2024-06-05 18:07:15.000000', descripcion: 'El usuario ha cerrado sesión.';
INSERT INTO logs SET id: '126', fecha: '2024-06-05 18:18:48.000000', descripcion: 'El usuario administrador@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '127', fecha: '2024-06-05 18:18:49.000000', descripcion: 'El usuario administrador@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '128', fecha: '2024-06-05 18:19:09.000000', descripcion: 'El usuario ha cerrado sesión.';
INSERT INTO logs SET id: '129', fecha: '2024-06-05 18:19:09.000000', descripcion: 'El usuario ha cerrado sesión.';
INSERT INTO logs SET id: '130', fecha: '2024-06-05 18:23:06.000000', descripcion: 'El usuario cliente@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '131', fecha: '2024-06-05 18:23:06.000000', descripcion: 'El usuario cliente@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '132', fecha: '2024-06-05 18:23:25.000000', descripcion: 'El usuario ha cerrado sesión.';
INSERT INTO logs SET id: '133', fecha: '2024-06-05 18:23:25.000000', descripcion: 'El usuario ha cerrado sesión.';
INSERT INTO logs SET id: '134', fecha: '2024-06-05 18:46:31.000000', descripcion: 'El usuario administrador@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '135', fecha: '2024-06-05 18:46:31.000000', descripcion: 'El usuario administrador@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '136', fecha: '2024-06-05 18:53:19.000000', descripcion: 'El usuario ha cerrado sesión.';
INSERT INTO logs SET id: '137', fecha: '2024-06-05 18:53:19.000000', descripcion: 'El usuario ha cerrado sesión.';
INSERT INTO logs SET id: '138', fecha: '2024-06-05 18:53:24.000000', descripcion: 'El usuario administrador@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '139', fecha: '2024-06-05 18:53:24.000000', descripcion: 'El usuario administrador@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '140', fecha: '2024-06-05 19:58:55.000000', descripcion: 'El usuario ha cerrado sesión.';
INSERT INTO logs SET id: '141', fecha: '2024-06-05 19:58:55.000000', descripcion: 'El usuario ha cerrado sesión.';
INSERT INTO logs SET id: '142', fecha: '2024-06-05 19:59:00.000000', descripcion: 'El usuario administrador@gmail.com ha iniciado sesión.';
INSERT INTO logs SET id: '143', fecha: '2024-06-05 19:59:00.000000', descripcion: 'El usuario administrador@gmail.com ha iniciado sesión.';


CREATE TABLE `reserva` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `numero` varchar(50) NOT NULL,
  `capacidad` int DEFAULT NULL,
  `comentarios` text,
  `dia_entrada` date DEFAULT NULL,
  `dia_salida` date DEFAULT NULL,
  `estado` enum('Vacia','Pendiente','Confirmada') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'Vacia',
  `marca_tiempo` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `email` (`email`),
  KEY `numero` (`numero`),
  CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`email`) REFERENCES `usuarios` (`email`),
  CONSTRAINT `reserva_ibfk_2` FOREIGN KEY (`numero`) REFERENCES `habitacion` (`numero`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO reserva SET id: '21', email: 'recepcionista@gmail.com', numero: 'adsad', capacidad: '110', comentarios: 'A          ', dia_entrada: '2024-06-04', dia_salida: '2024-06-05', estado: 'Confirmada', marca_tiempo: '2024-06-04 00:09:59';
INSERT INTO reserva SET id: '30', email: 'recepcionista@gmail.com', numero: '5435', capacidad: '2', comentarios: 'sadsad              ', dia_entrada: '2024-06-04', dia_salida: '2024-06-05', estado: 'Confirmada', marca_tiempo: '2024-06-04 13:17:02';
INSERT INTO reserva SET id: '31', email: '1javiergp23100130@gmail.com', numero: 'adsad', capacidad: '35', comentarios: 'A          ', dia_entrada: '2024-06-04', dia_salida: '2024-06-05', estado: 'Confirmada', marca_tiempo: '2024-06-04 13:23:29';
INSERT INTO reserva SET id: '32', email: '1javiergp23100130@gmail.com', numero: '500', capacidad: '34', comentarios: 'asd                        ', dia_entrada: '2024-06-04', dia_salida: '2024-06-05', estado: 'Confirmada', marca_tiempo: '2024-06-04 14:23:48';
INSERT INTO reserva SET id: '33', email: '1javiergp23100130@gmail.com', numero: '34232', capacidad: '34', comentarios: 'asd&quot;
                        ', dia_entrada: '2024-06-04', dia_salida: '2024-06-05', estado: 'Confirmada', marca_tiempo: '2024-06-04 16:35:08';


CREATE TABLE `usuarios` (
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `apellidos` varchar(255) DEFAULT NULL,
  `dni` varchar(9) DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `clave` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `tarjeta` varchar(16) NOT NULL,
  `rol` varchar(15) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO usuarios SET nombre: 'Javier', apellidos: 'Perez', dni: '76067757H', email: '1javiergp23100130@gmail.com', clave: '$2y$10$d1bhuM7/huCu57N3QbXS5.kY5S0UDLvHt/clB1PoGdHxdrPdGP.5a', tarjeta: '1234567891234567', rol: 'administrador';
INSERT INTO usuarios SET nombre: 'Javier', apellidos: 'Perez', dni: '76067757H', email: '2javiergp23100130@gmail.com', clave: '$2y$10$4WGyXQf5CiCFKRQmwJ.MsuF698CqWSmjLt75jILvEK.mnv8aox2vu', tarjeta: '1234567891234569', rol: 'recepcionista';
INSERT INTO usuarios SET nombre: 'Javier', apellidos: 'Perez', dni: '76067757H', email: 'administrador@gmail.com', clave: '$2y$10$FTyu3X4Ozx7tNNGLtj.kSudgu4G4bH..fKXPcSh82xk1P8475i3uu', tarjeta: '1234567891234567', rol: 'administrador';
INSERT INTO usuarios SET nombre: 'Javier', apellidos: 'Perez', dni: '76067757H', email: 'cliente@gmail.com', clave: '$2y$10$bonuqPswSUZXlETODRsOWejQviE9w6eGK3XbemMcZgHwpw3TT60Lq', tarjeta: '1234567891234569', rol: 'cliente';
INSERT INTO usuarios SET nombre: 'Javier', apellidos: 'Perez', dni: '76067757H', email: 'javiergp23100130@gmail.com', clave: '$2y$10$75z5mt18TJ2HQ4tSCRE3X.P.JJcLFCwrjxtEBgDU41zoFJVVaXvb.', tarjeta: '1234567891234567', rol: 'cliente';
INSERT INTO usuarios SET nombre: 'Javier', apellidos: 'Perez', dni: '76067757H', email: 'recepcionista@gmail.com', clave: '$2y$10$GiR4Yt2S.BE6CrAyubK2OuW4pB0YSAt4cQT7tjTg54BNThD7r6PAW', tarjeta: '1234567891234567', rol: 'recepcionista';


