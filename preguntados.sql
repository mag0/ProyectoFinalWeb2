-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-04-2024 a las 01:15:22
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
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nombreCompleto` VARCHAR(100) NOT NULL,
    `anioDeNacimiento` DATE NOT NULL,
    `genero` ENUM('masculino', 'femenino') NOT NULL,
    `pais` VARCHAR(50) NOT NULL,
    `ciudad` VARCHAR(50) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `password` VARCHAR(100) NOT NULL,
    `nombreUsuario` VARCHAR(50) NOT NULL UNIQUE,
    `perfil` VARCHAR(255),
    `fechaRegistro` DATE NOT NULL,
    `puntaje_total` INT 0,
    `cuenta_validada` tinyint FALSE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`nombreCompleto`, `anioDeNacimiento`, `genero`, `pais`, `ciudad`, `email`, `password`, `nombreUsuario`, `fechaRegistro`, `puntaje_total`, `cuenta_validada`)
VALUES
    ('Maria Gonzalez', '1992-08-25', 'femenino', 'Pais3', 'Ciudad3', 'maria@example.com', 'pikachu12', 'Maria', '2024-06-03', 120, FALSE),
    ('Juan Perez', '1988-05-14', 'masculino', 'Pais1', 'Ciudad1', 'juan@example.com', 'password123', 'JuanP', '2024-06-03', 150, FALSE),
    ('Luis Lopez', '1990-12-12', 'masculino', 'Pais2', 'Ciudad2', 'luis@example.com', 'pass456', 'LuisL', '2024-06-03', 95, FALSE),
    ('Ana Martinez', '1995-03-22', 'femenino', 'Pais4', 'Ciudad4', 'ana@example.com', 'qwerty', 'AnaM', '2024-06-03', 200, FALSE),
    ('Carlos Sanchez', '1985-11-30', 'masculino', 'Pais5', 'Ciudad5', 'carlos@example.com', 'password789', 'CarlosS', '2024-06-03', 180, FALSE),
    ('Elena Ramirez', '1993-07-18', 'femenino', 'Pais6', 'Ciudad6', 'elena@example.com', 'pass987', 'ElenaR', '2024-06-03', 110, FALSE),
    ('Pedro Gomez', '1991-09-09', 'masculino', 'Pais7', 'Ciudad7', 'pedro@example.com', 'asd123', 'PedroG', '2024-06-03', 75, FALSE),
    ('Lucia Diaz', '1989-04-05', 'femenino', 'Pais8', 'Ciudad8', 'lucia@example.com', 'pass456', 'LuciaD', '2024-06-03', 140, FALSE),
    ('Miguel Torres', '1987-01-15', 'masculino', 'Pais9', 'Ciudad9', 'miguel@example.com', '123456', 'MiguelT', '2024-06-03', 130, FALSE),
    ('Sofia Herrera', '1994-06-27', 'femenino', 'Pais10', 'Ciudad10', 'sofia@example.com', 'qwe789', 'SofiaH', '2024-06-03', 160, FALSE);



-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `partida`
--

CREATE TABLE IF NOT EXISTS `partida` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `id_usuario` INT NOT NULL,
    `puntaje_obtenido` INT NOT NULL,
    `fecha` DATE NOT NULL,
    FOREIGN KEY (`id_usuario`) REFERENCES `usuario`(`id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `partida`
--

INSERT INTO `partida` (`id_usuario`, `puntaje_obtenido`, `fecha`) VALUES
             (1, 85, '2024-06-01'),
             (1, 90, '2024-05-02'),
             (1, 75, '2024-01-03');

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE IF NOT EXISTS `pregunta` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `categoria` VARCHAR(50) NOT NULL,
    `texto_pregunta` TEXT NOT NULL,
    `respuesta_correcta` INT NOT NULL,
    `respuesta_1` TEXT NOT NULL,
    `respuesta_2` TEXT NOT NULL,
    `respuesta_3` TEXT NOT NULL,
    `respuesta_4` TEXT NOT NULL,
    `dificultad` INT NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`id`, `categoria`, `texto_pregunta`, `respuesta_correcta`, `respuesta_1`, `respuesta_2`, `respuesta_3`, `respuesta_4`, `dificultad`) VALUES
             (1, 'Ciencia', '¿Cuál es el planeta más grande del sistema solar?', 2, 'Marte', 'Júpiter', 'Saturno', 'Neptuno', 'facil'),
             (2, 'Historia', '¿En qué año comenzó la Segunda Guerra Mundial?', 3, '1914', '1936', '1939', '1941', 'medio'),
             (3, 'Geografía', '¿Cuál es la capital de Australia?', 4, 'Sydney', 'Melbourne', 'Brisbane', 'Canberra', 'facil'),
             (4, 'Deportes', '¿Cuántos jugadores hay en un equipo de fútbol?', 1, '11', '9', '12', '10', 'facil'),
             (5, 'Literatura', '¿Quién escribió "Cien años de soledad"?', 1, 'Gabriel García Márquez', 'Mario Vargas Llosa', 'Isabel Allende', 'Pablo Neruda', 'medio'),
             (6, 'Ciencia', '¿Cuál es el elemento químico con el símbolo O?', 2, 'Carbono', 'Oxígeno', 'Oro', 'Osmio', 'facil'),
             (7, 'Historia', '¿Quién fue el primer presidente de los Estados Unidos?', 1, 'George Washington', 'Thomas Jefferson', 'John Adams', 'Abraham Lincoln', 'medio'),
             (8, 'Geografía', '¿Cuál es el río más largo del mundo?', 3, 'Nilo', 'Yangtsé', 'Amazonas', 'Misisipi', 'medio'),
             (9, 'Deportes', '¿En qué deporte se utiliza un "putter"?', 4, 'Tenis', 'Béisbol', 'Hockey', 'Golf', 'facil'),
             (10, 'Literatura', '¿Quién escribió "Don Quijote de la Mancha"?', 1, 'Miguel de Cervantes', 'Lope de Vega', 'Federico García Lorca', 'Calderón de la Barca', 'medio'),
             (11, 'Ciencia', '¿Qué tipo de animal es un tiburón?', 3, 'Mamífero', 'Anfibio', 'Pez', 'Reptil', 'facil'),
             (12, 'Historia', '¿En qué año llegó Cristóbal Colón a América?', 2, '1490', '1492', '1500', '1502', 'medio'),
             (13, 'Geografía', '¿Qué país tiene más habitantes?', 1, 'China', 'India', 'Estados Unidos', 'Indonesia', 'facil'),
             (14, 'Deportes', '¿En qué país se originó el voleibol?', 2, 'Rusia', 'Estados Unidos', 'Brasil', 'Italia', 'medio'),
             (15, 'Literatura', '¿Quién es el autor de "1984"?', 4, 'Aldous Huxley', 'Ray Bradbury', 'J.R.R. Tolkien', 'George Orwell', 'medio');


-- --------------------------------------------------------

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

