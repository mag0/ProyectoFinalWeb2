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
  `fecha` date NOT NULL,
  `resultado`  boolean NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `partida`
--

INSERT INTO `partida` (`id`, `id_usuario`, `puntaje_obtenido`, `fecha`, `resultado`) VALUES
(1, 1, 85, '2024-06-01', true),
(2, 1, 90, '2024-05-02', false),
(3, 1, 75, '2024-01-03', false),
(4, 1, 75, '2024-02-03', true),
(5, 1, 75, '2024-03-03', true),
(6, 1, 73, '2024-04-03', true),
(7, 12, 7, '2024-06-14', true);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE `pregunta` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `texto_pregunta` text NOT NULL,
  `respuesta_correcta` int(11) NOT NULL,
  `respuesta_1` text NOT NULL,
  `respuesta_2` text NOT NULL,
  `respuesta_3` text NOT NULL,
  `respuesta_4` text NOT NULL,
  `dificultad` text NOT NULL,
  `reportada` boolean DEFAULT false,
  `respondidas` int(11) DEFAULT 0,
  `respondidas_correctamente` int(11) DEFAULT 0,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`id`, `id_categoria`, `texto_pregunta`, `respuesta_correcta`, `respuesta_1`, `respuesta_2`, `respuesta_3`, `respuesta_4`, `dificultad`, `reportada`, `respondidas`,`respondidas_correctamente`,`fecha`) VALUES
(1, 2, '¿En qué año llegó Cristóbal Colón a América?', 3, '1500', '1498', '1492', '1482', 'facil', false, 10, 8,'2024-06-01'),
(2, 3, '¿Cuántos jugadores hay en un equipo de fútbol?', 2, '10', '11', '12', '9', 'facil', false, 10, 5,'2024-06-01'),
(3, 4, '¿Cuál es la capital de Francia?', 4, 'Madrid', 'Roma', 'Londres', 'París', 'facil', false, 10, 1,'2024-06-01'),
(4, 1, '¿Cuál es el río más largo del mundo?', 4, 'Nilo', 'Mississippi', 'Yangtsé', 'Amazonas', 'facil', false, 0, 0,'2024-06-01'),
(5, 5, '¿Qué planeta es conocido como el planeta rojo?', 4, 'Júpiter', 'Saturno', 'Venus', 'Marte', 'facil', true, 0, 0,'2024-06-01'),
(6, 9, '¿Quién pintó la Mona Lisa?', 4, 'Pablo Picasso', 'Vincent van Gogh', 'Claude Monet', 'Leonardo da Vinci', 'facil', false, 0, 0,'2024-06-01'),
(7, 2, '¿Qué evento inició la Segunda Guerra Mundial?', 4, 'Invasión de Francia', 'Ataque a Pearl Harbor', 'Batalla de Stalingrado', 'Invasión de Polonia', 'facil', false, 0, 0,'2024-06-01'),
(8, 4, '¿Quién escribió "Don Quijote de la Mancha"?', 4, 'Gabriel García Márquez', 'Federico García Lorca', 'Jorge Luis Borges', 'Miguel de Cervantes', 'facil', false, 0, 0,'2024-06-01'),
(9, 3, '¿En qué año se celebraron los primeros Juegos Olímpicos modernos?', 3, '1900', '1888', '1896', '1904', 'facil', false, 0, 0,'2024-06-01'),
(10, 5, '¿Cuál es el elemento químico con símbolo O?', 4, 'Osmio', 'Oro', 'Oganesón', 'Oxígeno', 'facil', false, 0, 0,'2024-06-01'),
(11, 1, '¿Cuál es el país más grande del mundo?', 4, 'Canadá', 'China', 'Estados Unidos', 'Rusia', 'normal', true, 0, 0,'2024-06-01'),
(12, 2, '¿Quién fue el primer presidente de Estados Unidos?', 4, 'Abraham Lincoln', 'Thomas Jefferson', 'John Adams', 'George Washington', 'normal', false, 0, 0,'2024-06-01'),
(13, 3, '¿Qué equipo ha ganado más veces la Champions League?', 4, 'Barcelona', 'Manchester United', 'AC Milan', 'Real Madrid', 'facil', false, 0, 0,'2024-06-01'),
(14, 4, '¿Quién es el autor de "Cien años de soledad"?', 4, 'Mario Vargas Llosa', 'Isabel Allende', 'Julio Cortázar', 'Gabriel García Márquez', 'normal', false, 0, 0,'2024-06-01'),
(15, 5, '¿Qué gas es más abundante en la atmósfera terrestre?', 4, 'Oxígeno', 'Dióxido de carbono', 'Argón', 'Nitrógeno', 'facil', false, 0, 0,'2024-06-01'),
(16, 9, '¿En qué museo se encuentra la pintura "La noche estrellada"?', 4, 'Museo del Louvre', 'Museo del Prado', 'Galería Nacional de Arte', 'Museo de Arte Moderno', 'normal', false, 0, 0,'2024-06-01'),
(17, 2, '¿En qué año cayó el Muro de Berlín?', 4, '1985', '1991', '1987', '1989', 'normal', false, 0, 0,'2024-06-01'),
(18, 4, '¿Quién escribió "La Odisea"?', 4, 'Sófocles', 'Virgilio', 'Eurípides', 'Homero', 'normal', true, 0, 0,'2024-06-01'),
(19, 3, '¿En qué deporte se utiliza una raqueta y una pelota amarilla?', 4, 'Bádminton', 'Squash', 'Racquetball', 'Tenis', 'facil', false, 0, 0,'2024-06-01'),
(20, 5, '¿Cuál es el órgano más grande del cuerpo humano?', 4, 'Hígado', 'Corazón', 'Pulmones', 'Piel', 'normal', false, 0, 0,'2024-06-01'),
(21, 2, '¿Quién lideró la independencia de India?', 4, 'Jawaharlal Nehru', 'Indira Gandhi', 'Subhas Chandra Bose', 'Mahatma Gandhi', 'dificil', false, 0, 0,'2024-06-01'),
(22, 1, '¿Cuál es el punto más alto de África?', 4, 'Monte Kenia', 'Monte Elbrus', 'Monte Rwenzori', 'Monte Kilimanjaro', 'facil', false, 0, 0,'2024-06-01'),
(23, 4, '¿Cuál es el idioma más hablado en el mundo?', 4, 'Español', 'Inglés', 'Hindú', 'Mandarín', 'facil', false, 0, 0,'2024-04-01'),
(24, 5, '¿Qué teoría científica fue propuesta por Albert Einstein en 1905?', 4, 'Teoría del Big Bang', 'Teoría de la Evolución', 'Teoría de la Deriva Continental', 'Teoría de la Relatividad', 'dificil', false, 0, 0,'2024-06-01'),
(25, 9, '¿Quién pintó "El grito"?', 4, 'Salvador Dalí', 'Pablo Picasso', 'Henri Matisse', 'Edvard Munch', 'facil', false, 0, 0,'2024-06-02'),
(26, 2, '¿Qué faraón egipcio fue enterrado en la tumba KV62?', 4, 'Ramsés II', 'Cleopatra', 'Akhenatón', 'Tutankamón', 'dificil', false, 0, 0,'2024-06-02'),
(27, 4, '¿En qué año comenzó la Revolución Francesa?', 4, '1792', '1804', '1776', '1789', 'dificil', false, 0, 0,'2024-06-02'),
(28, 3, '¿Cuántos puntos vale un touchdown en el fútbol americano?', 1, '3', '7', '8', '6', 'facil', false, 0, 0,'2024-04-02'),
(29, 5, '¿Cuál es la fórmula química del ozono?', 4, 'O2', 'O4', 'H2O', 'O3', 'dificil', false, 0, 0,'2024-04-02'),
(30, 1, '¿Cuál es la capital de Mongolia?', 4, 'Astana', 'Bishkek', 'Taskent', 'Ulán Bator', 'facil', true, 0, 0,'2024-04-02'),
(31, 1, '¿Cuál es el color del cielo en un día despejado?', 4, 'Verde', 'Rojo', 'Amarillo', 'Azul', 'facil', 0, 0, 0, '2024-02-24'),
(32, 1, '¿Cuántas patas tiene un perro?', 3, '2', '3', '4', '5', 'facil', 0, 0, 0, '2024-06-24'),
(33, 2, '¿Qué número viene después del 2?', 3, '4', '5', '3', '1', 'facil', 0, 0, 0, '2024-06-24'),
(34, 2, '¿Qué animal es conocido como el rey de la selva?', 3, 'Elefante', 'Tigre', 'León', 'Jirafa', 'facil', 0, 0, 0, '2024-03-24'),
(35, 3, '¿Cuál es el primer mes del año?', 4, 'Marzo', 'Abril', 'Mayo', 'Enero', 'facil', 0, 0, 0, '2024-06-24'),
(36, 3, '¿Qué planeta es conocido como el planeta rojo?', 3, 'Venus', 'Saturno', 'Marte', 'Júpiter', 'facil', 0, 0, 0, '2024-01-24'),
(37, 4, '¿Cómo se llama el ratón más famoso de Disney?', 3, 'Jerry', 'Minnie Mouse', 'Mickey Mouse', 'Speedy', 'facil', 0, 0, 0, '2024-06-25'),
(38, 4, '¿Cuál es el nombre del presidente de Estados Unidos?', 3, 'Donald Trump', 'Barack Obama', 'Joe Biden', 'George Bush', 'facil', 0, 0, 0, '2024-06-24'),
(39, 5, '¿Cuál es la capital de Francia?', 3, 'Madrid', 'Londres', 'París', 'Berlín', 'facil', 0, 0, 0, '2024-06-24'),
(40, 5, '¿Cuántas letras tiene el alfabeto?', 3, '25', '24', '26', '27', 'facil', 0, 0, 0, '2024-06-24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas_vistas`
--

CREATE TABLE `pregunta_vista` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_pregunta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `preguntas_vistas`
--

INSERT INTO `pregunta_vista` (`id`, `id_usuario`, `id_pregunta`) VALUES
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
  `editor` boolean DEFAULT false,
  `preguntas_respondidas` INT DEFAULT 0,
  `preguntas_bien_respondidas` INT DEFAULT 0,
  `monedas` INT DEFAULT 5,
  `trampas` INT DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombreCompleto`, `anioDeNacimiento`, `genero`, `pais`, `ciudad`, `email`, `password`, `nombreUsuario`, `foto`, `fechaRegistro`, `puntaje_total`,
                       `token`, `cuenta_validada`, `preguntas_respondidas`, `preguntas_bien_respondidas`) VALUES
(1, 'Maria Gonzalez', '1992-08-25', 'femenino', 'Argentina', 'Posadas', 'maria@example.com', 'pikachu12', 'Maria', '1699279835.png', '2024-06-03', 120, '666508e4e84ed', 0, 203, 140),
(2, 'Juan Perez', '1988-05-14', 'masculino', 'Argentina', 'Rosario', 'juan@example.com', 'password123', 'JuanP', 'Preguntados.png', '2024-06-03', 150, '666508e4e84ed', 0, 203, 140),
(3, 'Luis Lopez', '1990-12-12', 'masculino', 'Argentina', 'Mar del Plata', 'luis@example.com', 'pass456', 'LuisL', '1699296978.jpg', '2024-06-03', 95, '666508e4e84ed', 0, 203, 140),
(4, 'Ana Martinez', '1995-03-22', 'femenino', 'Argentina', 'Parana', 'ana@example.com', 'qwerty', 'AnaM', '1699566454.jpg', '2024-06-03', 200, '666508e4e84ed', 0, 203, 140),
(5, 'Carlos Sanchez', '1985-11-30', 'masculino', 'España', 'Madrid', 'carlos@example.com', 'password789', 'CarlosS', '1699404120.webp', '2024-06-03', 180, '666508e4e84ed', 0, 203, 140),
(6, 'Elena Ramirez', '1993-07-18', 'masculino', 'Inglaterra', 'Londres', 'elena@example.com', 'pass987', 'ElenaR', '1699399349.jpg', '2024-06-03', 110, '666508e4e84ed', 0, 203, 140),
(7, 'Pedro Gomez', '1991-09-09', 'masculino', 'Peru', 'Lima', 'pedro@example.com', 'asd123', 'PedroG', '1699919393.jpg', '2024-06-03', 75, '666508e4e84ed', 0, 203, 140),
(8, 'Lucia Diaz', '1989-04-05', 'femenino', 'Argentina', 'Moreno', 'lucia@example.com', 'pass456', 'LuciaD', '1699758606.jpg', '2024-06-03', 140, '666508e4e84ed', 0, 203, 140),
(9, 'Miguel Torres', '1987-01-15', 'masculino', 'Argentina', 'Moreno', 'miguel@example.com', '123456', 'MiguelT', '1697154413.jpeg', '2024-06-03', 130, '666508e4e84ed', 0, 54, 23),
(10, 'Sofia Herrera', '1994-06-27', 'femenino', 'Argentina', 'Moreno', 'sofia@example.com', 'qwe789', 'SofiaH', '1699621422.jpg', '2024-06-03', 160, '666508e4e84ed', 0, 54, 14),
(11, 'Martin Guerreiro', '1999-02-01', 'masculino', 'Argentina', 'Moreno', 'guerreiromartin@gmail.com', '12', 'mag', '1699109847.jpg', '2024-06-01', 0, '666508e4e84ed', 1, 75, 23),
(12, 'Angel Leyes', '1999-10-25', 'masculino', 'Argentina', 'Liniers', 'angelleyesdk@gmail.com', '12', 'AngelDNK', '1718320800.jpeg', '2024-06-14', 7, '666b7ea0d705f', 1, 203, 140),
(13, 'Juan Perez', '1990-01-15', 'masculino', 'Argentina', 'Buenos Aires', 'juanp@example.com', 'password123', 'JuansP', '1718320800.jpeg', '2024-06-05', 150, 'token1', 1, 220, 160),
(14, 'Ana Lopez', '1985-03-22', 'femenino', 'Chile', 'Santiago', 'analopez@example.com', 'password456', 'AnaL', '1718320800.jpeg', '2024-06-06', 200, 'token2', 1, 230, 170),
(15, 'Carlos Martinez', '1995-07-10', 'masculino', 'Uruguay', 'Montevideo', 'carlosm@example.com', 'password789', 'CarlosM', '1718320800.jpeg', '2024-06-07', 180, 'token3', 1, 210, 150),
(16, 'Lucia Fernandez', '1988-11-30', 'femenino', 'Peru', 'Lima', 'luciaf@example.com', 'password101', 'LuciaF', '1718320800.jpeg', '2024-06-08', 170, 'token4', 1, 240, 180),
(17, 'Pedro Sanchez', '1992-06-18', 'masculino', 'Mexico', 'Ciudad de Mexico', 'pedros@example.com', 'password202', 'PedroS', '1718320800.jpeg', '2024-06-09', 160, 'token5', 1, 250, 190),
(18, 'Marta Diaz', '1983-04-12', 'femenino', 'Colombia', 'Bogota', 'martad@example.com', 'password303', 'MartaD', '1718320800.jpeg', '2024-06-10', 140, 'token6', 1, 260, 200),
(19, 'Jose Ramirez', '1998-09-25', 'masculino', 'Paraguay', 'Asuncion', 'joser@example.com', 'password404', 'JoseR', '1718320800.jpeg', '2024-06-11', 130, 'token7', 1, 270, 210),
(20, 'Sofia Gutierrez', '1993-12-05', 'femenino', 'Bolivia', 'La Paz', 'sofiag@example.com', 'password505', 'SofiaG', '1718320800.jpeg', '2024-06-12', 190, 'token8', 1, 280, 220),
(21, 'Diego Torres', '1987-05-09', 'masculino', 'Ecuador', 'Quito', 'diegot@example.com', 'password606', 'DiegoT', '1718320800.jpeg', '2024-06-13', 210, 'token9', 1, 290, 230),
(22, 'Laura Ruiz', '1991-02-18', 'femenino', 'Venezuela', 'Caracas', 'laurar@example.com', 'password707', 'LauraR', '1718320800.jpeg', '2024-06-14', 220, 'token10', 1, 300, 240);

INSERT INTO `usuario` (`id`, `nombreCompleto`, `anioDeNacimiento`, `genero`, `pais`, `ciudad`, `email`, `password`, `nombreUsuario`, `foto`, `fechaRegistro`, `token`, `cuenta_validada`,
                       `admin`, `editor`, `monedas`) VALUES
(23, 'Admin User', '1980-01-01', 'masculino', 'Estados Unidos', 'Nueva York','admin@example.com', '12', 'admin', ' ', '2024-06-03', '666508e4e84ed', 1, TRUE, FALSE, 0),
(24, 'Editor User', '1990-01-01', 'femenino', 'Canadá', 'Toronto', 'editor@example.com', '12', 'editor', ' ', '2024-06-03', '666508e4e84ed', 1,  FALSE, TRUE, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas_sugeridas`
--

CREATE TABLE `pregunta_sugerida` (
    `id` int(11) NOT NULL,
    `id_categoria` int(11) NOT NULL,
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

INSERT INTO `pregunta_sugerida` (`id`, `id_categoria`, `texto_pregunta`, `respuesta_correcta`, `respuesta_1`, `respuesta_2`, `respuesta_3`, `respuesta_4`, `dificultad`) VALUES
(1, 7, '¿Cuál es la raiz cuadrada de 49?', 2, '1', '7', '4', '10', 'facil'),
(2, 7, '¿Cuál es la raiz cuadrada de 144?', 1, '12', '7', '4', '10', 'facil'),
(3, 7, '¿Cuál es la raiz cuadrada de 100?', 4, '12', '7', '4', '10', 'facil');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
   `id` int(11) NOT NULL,
   `nombre` varchar(50) NOT NULL,
   `color` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO categoria (`id`, `nombre`, `color`) VALUES
(1, 'Geografia', 'blue'),
(2, 'Historia', 'red'),
(3, 'Deportes', 'green'),
(4, 'Cultura', 'orange'),
(5, 'Ciencia', 'purple'),
(6, 'Literatura', 'goldenrod'),
(7, 'Matemáticas', 'cyan'),
(8, 'Música', 'magenta'),
(9, 'Arte', 'crimson'),
(10, 'Cine', 'salmon');

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
-- Indices de la tabla `preguntas_vistas`
--
ALTER TABLE `pregunta_vista`
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
-- Indices de la tabla `preguntas_sugeridas`
--
ALTER TABLE `pregunta_sugerida`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `preguntas_vistas`
--
ALTER TABLE `pregunta_vista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `preguntas_sugeridas`
--
ALTER TABLE `pregunta_sugerida`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
ALTER TABLE `pregunta_vista`
  ADD CONSTRAINT `partida_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `partida_ibfk_3` FOREIGN KEY (`id_pregunta`) REFERENCES `pregunta` (`id`) ON DELETE CASCADE;
COMMIT;

--
-- Filtros para la tabla `pregunta`
--
ALTER TABLE `pregunta`
    ADD CONSTRAINT `partida_ibfk_4` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`) ON DELETE CASCADE;
COMMIT;

--
-- Filtros para la tabla `pregunta`
--
ALTER TABLE `pregunta_sugerida`
    ADD CONSTRAINT `partida_ibfk_5` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
