-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-06-2024 a las 22:10:44
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
-- Base de datos: `proyectofinal`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partida`
--

CREATE TABLE `partida` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `puntaje_obtenido` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE `pregunta` (
  `id` int(11) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `texto_pregunta` text NOT NULL,
  `respuesta_correcta` int(11) NOT NULL,
  `respuesta_1` text NOT NULL,
  `respuesta_2` text NOT NULL,
  `respuesta_3` text NOT NULL,
  `respuesta_4` text NOT NULL,
  `dificultad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`id`, `categoria`, `texto_pregunta`, `respuesta_correcta`, `respuesta_1`, `respuesta_2`, `respuesta_3`, `respuesta_4`, `dificultad`) VALUES
(1, 'Ciencia', '¿Cuál es el planeta más grande del sistema solar?', 2, 'Marte', 'Júpiter', 'Saturno', 'Neptuno', 0),
(2, 'Historia', '¿En qué año comenzó la Segunda Guerra Mundial?', 3, '1914', '1936', '1939', '1941', 0),
(3, 'Geografía', '¿Cuál es la capital de Australia?', 4, 'Sydney', 'Melbourne', 'Brisbane', 'Canberra', 0),
(4, 'Deportes', '¿Cuántos jugadores hay en un equipo de fútbol?', 1, '11', '9', '12', '10', 0),
(5, 'Literatura', '¿Quién escribió \"Cien años de soledad\"?', 1, 'Gabriel García Márquez', 'Mario Vargas Llosa', 'Isabel Allende', 'Pablo Neruda', 0),
(6, 'Ciencia', '¿Cuál es el elemento químico con el símbolo O?', 2, 'Carbono', 'Oxígeno', 'Oro', 'Osmio', 0),
(7, 'Historia', '¿Quién fue el primer presidente de los Estados Unidos?', 1, 'George Washington', 'Thomas Jefferson', 'John Adams', 'Abraham Lincoln', 0),
(8, 'Geografía', '¿Cuál es el río más largo del mundo?', 3, 'Nilo', 'Yangtsé', 'Amazonas', 'Misisipi', 0),
(9, 'Deportes', '¿En qué deporte se utiliza un \"putter\"?', 4, 'Tenis', 'Béisbol', 'Hockey', 'Golf', 0),
(10, 'Literatura', '¿Quién escribió \"Don Quijote de la Mancha\"?', 1, 'Miguel de Cervantes', 'Lope de Vega', 'Federico García Lorca', 'Calderón de la Barca', 0),
(11, 'Ciencia', '¿Qué tipo de animal es un tiburón?', 3, 'Mamífero', 'Anfibio', 'Pez', 'Reptil', 0),
(12, 'Historia', '¿En qué año llegó Cristóbal Colón a América?', 2, '1490', '1492', '1500', '1502', 0),
(13, 'Geografía', '¿Qué país tiene más habitantes?', 1, 'China', 'India', 'Estados Unidos', 'Indonesia', 0),
(14, 'Deportes', '¿En qué país se originó el voleibol?', 2, 'Rusia', 'Estados Unidos', 'Brasil', 'Italia', 0),
(15, 'Literatura', '¿Quién es el autor de \"1984\"?', 4, 'Aldous Huxley', 'Ray Bradbury', 'J.R.R. Tolkien', 'George Orwell', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombreCompleto` varchar(100) NOT NULL,
  `anioDeNacimiento` date NOT NULL,
  `genero` enum('masculino','femenino') NOT NULL,
  `pais` varchar(50) NOT NULL,
  `ciudad` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nombreUsuario` varchar(50) NOT NULL,
  `perfil` varchar(255) DEFAULT NULL,
  `fechaRegistro` date NOT NULL,
  `puntaje_total` int(11) DEFAULT NULL,
  `token` varchar(13) DEFAULT NULL,
  `cuenta_validada` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombreCompleto`, `anioDeNacimiento`, `genero`, `pais`, `ciudad`, `email`, `password`, `nombreUsuario`, `perfil`, `fechaRegistro`, `puntaje_total`, `token`, `cuenta_validada`) VALUES
(20, 'Angel Leyes', '1999-10-25', 'masculino', 'Argentina', 'CIUDAD DE BUENOS AIRES - LINIERS', 'angelleyesdk@gmail.com', '12345', 'AngelDNK', '', '2024-06-09', NULL, '666508e4e84ed', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `partida`
--
ALTER TABLE `partida`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombreUsuario` (`nombreUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `partida`
--
ALTER TABLE `partida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `partida`
--
ALTER TABLE `partida`
  ADD CONSTRAINT `partida_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
