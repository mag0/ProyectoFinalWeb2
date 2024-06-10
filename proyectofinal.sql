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

--
-- Volcado de datos para la tabla `partida`
--

INSERT INTO `partida` (`id`, `id_usuario`, `puntaje_obtenido`, `fecha`) VALUES
(1, 1, 85, '2024-06-01'),
(2, 1, 90, '2024-05-02'),
(3, 1, 75, '2024-01-03');

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
  `dificultad` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`id`, `categoria`, `texto_pregunta`, `respuesta_correcta`, `respuesta_1`, `respuesta_2`, `respuesta_3`, `respuesta_4`, `dificultad`) VALUES
(1, 'Historia', '¿En qué año llegó Cristóbal Colón a América?', 3, '1500', '1498', '1492', '1482', 'facil'),
(2, 'Deportes', '¿Cuántos jugadores hay en un equipo de fútbol?', 2, '10', '11', '12', '9', 'facil'),
(3, 'Cultura', '¿Cuál es la capital de Francia?', 4, 'Madrid', 'Roma', 'Londres', 'París', 'facil'),
(4, 'Geografía', '¿Cuál es el río más largo del mundo?', 4, 'Nilo', 'Mississippi', 'Yangtsé', 'Amazonas', 'facil'),
(5, 'Ciencia', '¿Qué planeta es conocido como el planeta rojo?', 4, 'Júpiter', 'Saturno', 'Venus', 'Marte', 'facil'),
(6, 'Arte', '¿Quién pintó la Mona Lisa?', 4, 'Pablo Picasso', 'Vincent van Gogh', 'Claude Monet', 'Leonardo da Vinci', 'facil'),
(7, 'Historia', '¿Qué evento inició la Segunda Guerra Mundial?', 4, 'Invasión de Francia', 'Ataque a Pearl Harbor', 'Batalla de Stalingrado', 'Invasión de Polonia', 'facil'),
(8, 'Cultura', '¿Quién escribió "Don Quijote de la Mancha"?', 4, 'Gabriel García Márquez', 'Federico García Lorca', 'Jorge Luis Borges', 'Miguel de Cervantes', 'facil'),
(9, 'Deportes', '¿En qué año se celebraron los primeros Juegos Olímpicos modernos?', 3, '1900', '1888', '1896', '1904', 'facil'),
(10, 'Ciencia', '¿Cuál es el elemento químico con símbolo O?', 4, 'Osmio', 'Oro', 'Oganesón', 'Oxígeno', 'facil'),
(11, 'Geografía', '¿Cuál es el país más grande del mundo?', 4, 'Canadá', 'China', 'Estados Unidos', 'Rusia', 'normal'),
(12, 'Historia', '¿Quién fue el primer presidente de Estados Unidos?', 4, 'Abraham Lincoln', 'Thomas Jefferson', 'John Adams', 'George Washington', 'normal'),
(13, 'Deportes', '¿Qué equipo ha ganado más veces la Champions League?', 4, 'Barcelona', 'Manchester United', 'AC Milan', 'Real Madrid', 'normal'),
(14, 'Cultura', '¿Quién es el autor de "Cien años de soledad"?', 4, 'Mario Vargas Llosa', 'Isabel Allende', 'Julio Cortázar', 'Gabriel García Márquez', 'normal'),
(15, 'Ciencia', '¿Qué gas es más abundante en la atmósfera terrestre?', 4, 'Oxígeno', 'Dióxido de carbono', 'Argón', 'Nitrógeno', 'normal'),
(16, 'Arte', '¿En qué museo se encuentra la pintura "La noche estrellada"?', 4, 'Museo del Louvre', 'Museo del Prado', 'Galería Nacional de Arte', 'Museo de Arte Moderno', 'normal'),
(17, 'Historia', '¿En qué año cayó el Muro de Berlín?', 4, '1985', '1991', '1987', '1989', 'normal'),
(18, 'Cultura', '¿Quién escribió "La Odisea"?', 4, 'Sófocles', 'Virgilio', 'Eurípides', 'Homero', 'normal'),
(19, 'Deportes', '¿En qué deporte se utiliza una raqueta y una pelota amarilla?', 4, 'Bádminton', 'Squash', 'Racquetball', 'Tenis', 'normal'),
(20, 'Ciencia', '¿Cuál es el órgano más grande del cuerpo humano?', 4, 'Hígado', 'Corazón', 'Pulmones', 'Piel', 'normal'),
(21, 'Historia', '¿Quién lideró la independencia de India?', 4, 'Jawaharlal Nehru', 'Indira Gandhi', 'Subhas Chandra Bose', 'Mahatma Gandhi', 'dificil'),
(22, 'Geografía', '¿Cuál es el punto más alto de África?', 4, 'Monte Kenia', 'Monte Elbrus', 'Monte Rwenzori', 'Monte Kilimanjaro', 'dificil'),
(23, 'Cultura', '¿Cuál es el idioma más hablado en el mundo?', 4, 'Español', 'Inglés', 'Hindú', 'Mandarín', 'dificil'),
(24, 'Ciencia', '¿Qué teoría científica fue propuesta por Albert Einstein en 1905?', 4, 'Teoría del Big Bang', 'Teoría de la Evolución', 'Teoría de la Deriva Continental', 'Teoría de la Relatividad', 'dificil'),
(25, 'Arte', '¿Quién pintó "El grito"?', 4, 'Salvador Dalí', 'Pablo Picasso', 'Henri Matisse', 'Edvard Munch', 'dificil'),
(26, 'Historia', '¿Qué faraón egipcio fue enterrado en la tumba KV62?', 4, 'Ramsés II', 'Cleopatra', 'Akhenatón', 'Tutankamón', 'dificil'),
(27, 'Cultura', '¿En qué año comenzó la Revolución Francesa?', 4, '1792', '1804', '1776', '1789', 'dificil'),
(28, 'Deportes', '¿Cuántos puntos vale un touchdown en el fútbol americano?', 1, '3', '7', '8', '6', 'dificil'),
(29, 'Ciencia', '¿Cuál es la fórmula química del ozono?', 4, 'O2', 'O4', 'H2O', 'O3', 'dificil'),
(30, 'Geografía', '¿Cuál es la capital de Mongolia?', 4, 'Astana', 'Bishkek', 'Taskent', 'Ulán Bator', 'dificil');


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
(1, 'Maria Gonzalez', '1992-08-25', 'femenino', 'Pais3', 'Ciudad3', 'maria@example.com', 'pikachu12', 'Maria', '', '2024-06-03', 120, '666508e4e84ed', 0),
(2, 'Juan Perez', '1988-05-14', 'masculino', 'Pais1', 'Ciudad1', 'juan@example.com', 'password123', 'JuanP', '', '2024-06-03', 150, '666508e4e84ed', 0),
(3, 'Luis Lopez', '1990-12-12', 'masculino', 'Pais2', 'Ciudad2', 'luis@example.com', 'pass456', 'LuisL', '', '2024-06-03', 95, '666508e4e84ed', 0),
(4, 'Ana Martinez', '1995-03-22', 'femenino', 'Pais4', 'Ciudad4', 'ana@example.com', 'qwerty', 'AnaM', '', '2024-06-03', 200, '666508e4e84ed', 0),
(5, 'Carlos Sanchez', '1985-11-30', 'masculino', 'Pais5', 'Ciudad5', 'carlos@example.com', 'password789', 'CarlosS', '', '2024-06-03', 180, '666508e4e84ed', 0),
(6, 'Elena Ramirez', '1993-07-18', 'femenino', 'Pais6', 'Ciudad6', 'elena@example.com', 'pass987', 'ElenaR', '', '2024-06-03', 110, '666508e4e84ed', 0),
(7, 'Pedro Gomez', '1991-09-09', 'masculino', 'Pais7', 'Ciudad7', 'pedro@example.com', 'asd123', 'PedroG', '', '2024-06-03', 75, '666508e4e84ed', 0),
(8, 'Lucia Diaz', '1989-04-05', 'femenino', 'Pais8', 'Ciudad8', 'lucia@example.com', 'pass456', 'LuciaD', '', '2024-06-03', 140, '666508e4e84ed', 0),
(9, 'Miguel Torres', '1987-01-15', 'masculino', 'Pais9', 'Ciudad9', 'miguel@example.com', '123456', 'MiguelT', '', '2024-06-03', 130, '666508e4e84ed', 0),
(10, 'Sofia Herrera', '1994-06-27', 'femenino', 'Pais10', 'Ciudad10', 'sofia@example.com', 'qwe789', 'SofiaH', '', '2024-06-03', 160, '666508e4e84ed', 0),
(11, 'Angel Leyes', '1999-10-25', 'masculino', 'Argentina', 'Liniers', 'angelleyesdk@gmail.com', '12345', 'AngelDNK', '', '2024-06-09', 0, '666508e4e84ed', 0),
(12, 'Martin Guerreiro', '1999-02-01', 'masculino', 'Argentina', 'Moreno', 'guerreiromartin@gmail.com', '12', 'mag', '', '2024-06-01', 0, '666508e4e84ed', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas_vistas`
--

CREATE TABLE `preguntas_vistas` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `id_usuario` int(11) NOT NULL,
    `id_pregunta` int(11) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- AUTO_INCREMENT de la tabla `preguntas_vistas`
--
ALTER TABLE `preguntas_vistas`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `partida`
--
ALTER TABLE `partida`
  ADD CONSTRAINT `partida_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE;
COMMIT;

--
-- Filtros para la tabla `preguntas_vistas`
--
ALTER TABLE `preguntas_vistas`
    ADD CONSTRAINT `partida_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE,
    ADD CONSTRAINT `partida_ibfk_3` FOREIGN KEY (`id_pregunta`) REFERENCES `pregunta` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;