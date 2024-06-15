-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-06-2024 a las 08:13:16
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
(3, 1, 75, '2024-01-03'),
(4, 1, 75, '2024-02-03'),
(5, 1, 75, '2024-03-03'),
(6, 1, 73, '2024-04-03'),
(7, 12, 7, '2024-06-14');

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
  `dificultad` text NOT NULL,
  `reportada` boolean DEFAULT false
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`id`, `categoria`, `texto_pregunta`, `respuesta_correcta`, `respuesta_1`, `respuesta_2`, `respuesta_3`, `respuesta_4`, `dificultad`, `reportada`) VALUES
(1, 'Historia', '¿En qué año llegó Cristóbal Colón a América?', 3, '1500', '1498', '1492', '1482', 'facil', false),
(2, 'Deportes', '¿Cuántos jugadores hay en un equipo de fútbol?', 2, '10', '11', '12', '9', 'facil', false),
(3, 'Cultura', '¿Cuál es la capital de Francia?', 4, 'Madrid', 'Roma', 'Londres', 'París', 'facil', false),
(4, 'Geografía', '¿Cuál es el río más largo del mundo?', 4, 'Nilo', 'Mississippi', 'Yangtsé', 'Amazonas', 'facil', false),
(5, 'Ciencia', '¿Qué planeta es conocido como el planeta rojo?', 4, 'Júpiter', 'Saturno', 'Venus', 'Marte', 'facil', false),
(6, 'Arte', '¿Quién pintó la Mona Lisa?', 4, 'Pablo Picasso', 'Vincent van Gogh', 'Claude Monet', 'Leonardo da Vinci', 'facil', false),
(7, 'Historia', '¿Qué evento inició la Segunda Guerra Mundial?', 4, 'Invasión de Francia', 'Ataque a Pearl Harbor', 'Batalla de Stalingrado', 'Invasión de Polonia', 'facil', false),
(8, 'Cultura', '¿Quién escribió \"Don Quijote de la Mancha\"?', 4, 'Gabriel García Márquez', 'Federico García Lorca', 'Jorge Luis Borges', 'Miguel de Cervantes', 'facil', false),
(9, 'Deportes', '¿En qué año se celebraron los primeros Juegos Olímpicos modernos?', 3, '1900', '1888', '1896', '1904', 'facil', false),
(10, 'Ciencia', '¿Cuál es el elemento químico con símbolo O?', 4, 'Osmio', 'Oro', 'Oganesón', 'Oxígeno', 'facil', false),
(11, 'Geografía', '¿Cuál es el país más grande del mundo?', 4, 'Canadá', 'China', 'Estados Unidos', 'Rusia', 'normal', false),
(12, 'Historia', '¿Quién fue el primer presidente de Estados Unidos?', 4, 'Abraham Lincoln', 'Thomas Jefferson', 'John Adams', 'George Washington', 'normal', false),
(13, 'Deportes', '¿Qué equipo ha ganado más veces la Champions League?', 4, 'Barcelona', 'Manchester United', 'AC Milan', 'Real Madrid', 'normal', false),
(14, 'Cultura', '¿Quién es el autor de \"Cien años de soledad\"?', 4, 'Mario Vargas Llosa', 'Isabel Allende', 'Julio Cortázar', 'Gabriel García Márquez', 'normal', false),
(15, 'Ciencia', '¿Qué gas es más abundante en la atmósfera terrestre?', 4, 'Oxígeno', 'Dióxido de carbono', 'Argón', 'Nitrógeno', 'normal', false),
(16, 'Arte', '¿En qué museo se encuentra la pintura \"La noche estrellada\"?', 4, 'Museo del Louvre', 'Museo del Prado', 'Galería Nacional de Arte', 'Museo de Arte Moderno', 'normal', false),
(17, 'Historia', '¿En qué año cayó el Muro de Berlín?', 4, '1985', '1991', '1987', '1989', 'normal', false),
(18, 'Cultura', '¿Quién escribió \"La Odisea\"?', 4, 'Sófocles', 'Virgilio', 'Eurípides', 'Homero', 'normal', true),
(19, 'Deportes', '¿En qué deporte se utiliza una raqueta y una pelota amarilla?', 4, 'Bádminton', 'Squash', 'Racquetball', 'Tenis', 'normal', false),
(20, 'Ciencia', '¿Cuál es el órgano más grande del cuerpo humano?', 4, 'Hígado', 'Corazón', 'Pulmones', 'Piel', 'normal', false),
(21, 'Historia', '¿Quién lideró la independencia de India?', 4, 'Jawaharlal Nehru', 'Indira Gandhi', 'Subhas Chandra Bose', 'Mahatma Gandhi', 'dificil', false),
(22, 'Geografía', '¿Cuál es el punto más alto de África?', 4, 'Monte Kenia', 'Monte Elbrus', 'Monte Rwenzori', 'Monte Kilimanjaro', 'dificil', false),
(23, 'Cultura', '¿Cuál es el idioma más hablado en el mundo?', 4, 'Español', 'Inglés', 'Hindú', 'Mandarín', 'dificil', false),
(24, 'Ciencia', '¿Qué teoría científica fue propuesta por Albert Einstein en 1905?', 4, 'Teoría del Big Bang', 'Teoría de la Evolución', 'Teoría de la Deriva Continental', 'Teoría de la Relatividad', 'dificil', false),
(25, 'Arte', '¿Quién pintó \"El grito\"?', 4, 'Salvador Dalí', 'Pablo Picasso', 'Henri Matisse', 'Edvard Munch', 'dificil', false),
(26, 'Historia', '¿Qué faraón egipcio fue enterrado en la tumba KV62?', 4, 'Ramsés II', 'Cleopatra', 'Akhenatón', 'Tutankamón', 'dificil', false),
(27, 'Cultura', '¿En qué año comenzó la Revolución Francesa?', 4, '1792', '1804', '1776', '1789', 'dificil', false),
(28, 'Deportes', '¿Cuántos puntos vale un touchdown en el fútbol americano?', 1, '3', '7', '8', '6', 'dificil', false),
(29, 'Ciencia', '¿Cuál es la fórmula química del ozono?', 4, 'O2', 'O4', 'H2O', 'O3', 'dificil', false),
(30, 'Geografía', '¿Cuál es la capital de Mongolia?', 4, 'Astana', 'Bishkek', 'Taskent', 'Ulán Bator', 'dificil', true);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas_vistas`
--

CREATE TABLE `preguntas_vistas` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_pregunta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `preguntas_vistas`
--

INSERT INTO `preguntas_vistas` (`id`, `id_usuario`, `id_pregunta`) VALUES
(1, 12, 1),
(2, 12, 5),
(3, 12, 3),
(4, 12, 10),
(5, 12, 6),
(6, 12, 4),
(7, 12, 8),
(8, 12, 9);

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
  `foto` varchar(255) DEFAULT NULL,
  `fechaRegistro` date NOT NULL,
  `puntaje_total` int(11) DEFAULT NULL,
  `token` varchar(13) DEFAULT NULL,
  `cuenta_validada` tinyint(1) NOT NULL DEFAULT 0,
  `admin` boolean DEFAULT false,
  `editor` boolean DEFAULT false
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombreCompleto`, `anioDeNacimiento`, `genero`, `pais`, `ciudad`, `email`, `password`, `nombreUsuario`, `foto`, `fechaRegistro`, `puntaje_total`, `token`, `cuenta_validada`) VALUES
(1, 'Maria Gonzalez', '1992-08-25', 'femenino', 'Argentina', 'Ciudad3', 'maria@example.com', 'pikachu12', 'Maria', '1699279835.png', '2024-06-03', 120, '666508e4e84ed', 0),
(2, 'Juan Perez', '1988-05-14', 'masculino', 'Argentina', 'Ciudad1', 'juan@example.com', 'password123', 'JuanP', 'Preguntados.png', '2024-06-03', 150, '666508e4e84ed', 0),
(3, 'Luis Lopez', '1990-12-12', 'masculino', 'Argentina', 'Ciudad2', 'luis@example.com', 'pass456', 'LuisL', '1699296978.jpg', '2024-06-03', 95, '666508e4e84ed', 0),
(4, 'Ana Martinez', '1995-03-22', 'femenino', 'Argentina', 'Ciudad4', 'ana@example.com', 'qwerty', 'AnaM', '1699566454.jpg', '2024-06-03', 200, '666508e4e84ed', 0),
(5, 'Carlos Sanchez', '1985-11-30', 'masculino', 'Argentina', 'Ciudad5', 'carlos@example.com', 'password789', 'CarlosS', '1699404120.webp', '2024-06-03', 180, '666508e4e84ed', 0),
(6, 'Elena Ramirez', '1993-07-18', 'femenino', 'Argentina', 'Ciudad6', 'elena@example.com', 'pass987', 'ElenaR', '1699399349.jpg', '2024-06-03', 110, '666508e4e84ed', 0),
(7, 'Pedro Gomez', '1991-09-09', 'masculino', 'Argentina', 'Ciudad7', 'pedro@example.com', 'asd123', 'PedroG', '1699919393.jpg', '2024-06-03', 75, '666508e4e84ed', 0),
(8, 'Lucia Diaz', '1989-04-05', 'femenino', 'Argentina', 'Ciudad8', 'lucia@example.com', 'pass456', 'LuciaD', '1699758606.jpg', '2024-06-03', 140, '666508e4e84ed', 0),
(9, 'Miguel Torres', '1987-01-15', 'masculino', 'Argentina', 'Ciudad9', 'miguel@example.com', '123456', 'MiguelT', '1697154413.jpeg', '2024-06-03', 130, '666508e4e84ed', 0),
(10, 'Sofia Herrera', '1994-06-27', 'femenino', 'Argentina', 'Ciudad10', 'sofia@example.com', 'qwe789', 'SofiaH', '1699621422.jpg', '2024-06-03', 160, '666508e4e84ed', 0),
(11, 'Martin Guerreiro', '1999-02-01', 'masculino', 'Argentina', 'Moreno', 'guerreiromartin@gmail.com', '12', 'mag', '1699109847.jpg', '2024-06-01', 0, '666508e4e84ed', 0),
(12, 'Angel Leyes', '1999-10-25', 'masculino', 'Argentina', 'CIUDAD DE BUENOS AIRES - LINIERS', 'angelleyesdk@gmail.com', '12', 'AngelDNK', '1718320800.jpeg', '2024-06-14', 7, '666b7ea0d705f', 0);

INSERT INTO `usuario` (`id`, `nombreCompleto`, `anioDeNacimiento`, `genero`, `pais`, `ciudad`, `email`, `password`, `nombreUsuario`, `foto`, `fechaRegistro`, `token`, `cuenta_validada`, `admin`, `editor`) VALUES
(13, 'Admin User', '1980-01-01', 'masculino', 'Estados Unidos', 'Nueva York','admin@example.com', '12', 'admin', ' ', '2024-06-03', '666508e4e84ed', 1, TRUE, FALSE),
(14, 'Editor User', '1990-01-01', 'femenino', 'Canadá', 'Toronto', 'editor@example.com', '12', 'editorUser', ' ', '2024-06-03', '666508e4e84ed', 1,  FALSE, TRUE);
--
-- Índices para tablas volcadas
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas_vistas`
--

CREATE TABLE `preguntas_sugeridas` (
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
-- Volcado de datos para la tabla `preguntas_vistas`
--

INSERT INTO `preguntas_sugeridas` (`id`, `categoria`, `texto_pregunta`, `respuesta_correcta`, `respuesta_1`, `respuesta_2`, `respuesta_3`, `respuesta_4`, `dificultad`) VALUES
(1, 'Matematica', '¿Cuál es la raiz cuadrada de 49?', 2, '1', '7', '4', '10', 'facil'),
(2, 'Matematica', '¿Cuál es la raiz cuadrada de 144?', 1, '12', '7', '4', '10', 'facil');

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
-- Indices de la tabla `preguntas_vistas`
--
ALTER TABLE `preguntas_vistas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `partida_ibfk_2` (`id_usuario`),
  ADD KEY `partida_ibfk_3` (`id_pregunta`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombreUsuario` (`nombreUsuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `preguntas_sugeridas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `partida`
--
ALTER TABLE `partida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `preguntas_vistas`
--
ALTER TABLE `preguntas_vistas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `preguntas_sugeridas`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `partida`
--
ALTER TABLE `partida`
  ADD CONSTRAINT `partida_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE;

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
