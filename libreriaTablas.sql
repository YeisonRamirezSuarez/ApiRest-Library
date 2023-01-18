-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 18-01-2023 a las 21:40:46
-- Versión del servidor: 10.5.16-MariaDB
-- Versión de PHP: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `id19666383_library`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `_id` bigint(20) UNSIGNED NOT NULL,
  `Titulo_libro` varchar(80) NOT NULL,
  `Autor_libro` varchar(30) NOT NULL,
  `Cantidad_libro` int(4) NOT NULL,
  `Url_libro` varchar(255) NOT NULL,
  `Imagen_libro` varchar(255) NOT NULL,
  `Descripcion_libro` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`_id`, `Titulo_libro`, `Autor_libro`, `Cantidad_libro`, `Url_libro`, `Imagen_libro`, `Descripcion_libro`) VALUES
(3, 'Sofia Qm', 'princesa', 9, 'sjsjjs', 'https://www.disneylapresspack.com/storage/programs/original_17pcfx60a0z9773m34gw1rgo1y0daf8w918rt61383d64o54tu.jpg', 'sbsbsb'),
(7, 'El West', 'STREAMING', 10, 'https://pbs.twimg.com/profile_images/1528735426751741953/wARlFhAb_400x400.jpg', 'https://pbs.twimg.com/profile_images/1528735426751741953/wARlFhAb_400x400.jpg', 'ff'),
(22, 'El principito', 'Antoine de Saint-Exupéry', 8, 'http://web.seducoahuila.gob.mx/biblioweb/upload/Antoine%20De%20Saint-Exup%C3%A9ry%20-%20El%20principito.pdf', 'https://canallector.com/old-thumbs/978-84-9838-234-1_g.jpg', 'El principito es una novela corta y la obra más famosa del escritor y aviador francés Antoine de Saint-Exupéry.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros_prestados`
--

CREATE TABLE `libros_prestados` (
  `_id` bigint(20) UNSIGNED NOT NULL,
  `_id_Libro` varchar(4) NOT NULL,
  `Titulo_libro_Prestado` varchar(255) NOT NULL,
  `Autor_libro_Prestado` varchar(255) NOT NULL,
  `Url_libro_Prestado` varchar(255) NOT NULL,
  `Imagen_libro_Prestado` varchar(255) NOT NULL,
  `Descripcion_libro_Prestado` varchar(255) NOT NULL,
  `Fecha_Prestamo_libro` varchar(50) NOT NULL,
  `Correo_Prestamo_libro` varchar(30) NOT NULL,
  `Nombre_Usuario_Prestamo_libro` varchar(255) NOT NULL,
  `Telefono_Usuario_Prestamo_libro` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `libros_prestados`
--

INSERT INTO `libros_prestados` (`_id`, `_id_Libro`, `Titulo_libro_Prestado`, `Autor_libro_Prestado`, `Url_libro_Prestado`, `Imagen_libro_Prestado`, `Descripcion_libro_Prestado`, `Fecha_Prestamo_libro`, `Correo_Prestamo_libro`, `Nombre_Usuario_Prestamo_libro`, `Telefono_Usuario_Prestamo_libro`) VALUES
(1, '22', 'El principito', 'Antoine de Saint-Exupéry', 'http://web.seducoahuila.gob.mx/biblioweb/upload/Antoine%20De%20Saint-Exup%C3%A9ry%20-%20El%20principito.pdf', 'https://canallector.com/old-thumbs/978-84-9838-234-1_g.jpg', 'El principito es una novela corta y la obra más famosa del escritor y aviador francés Antoine de Saint-Exupéry.', ' 18 ene. 2023, 09:54', 'mateo@wposs.com', 'Mateo Romera ', '3545151515'),
(2, '3', 'Sofia Qm', 'princesa', 'sjsjjs', 'https://www.disneylapresspack.com/storage/programs/original_17pcfx60a0z9773m34gw1rgo1y0daf8w918rt61383d64o54tu.jpg', 'sbsbsb', ' 18 ene. 2023, 09:55', 'mateo@wposs.com', 'Mateo Romera ', '3545151515'),
(7, '22', 'El principito', 'Antoine de Saint-Exupéry', 'http://web.seducoahuila.gob.mx/biblioweb/upload/Antoine%20De%20Saint-Exup%C3%A9ry%20-%20El%20principito.pdf', 'https://canallector.com/old-thumbs/978-84-9838-234-1_g.jpg', 'El principito es una novela corta y la obra más famosa del escritor y aviador francés Antoine de Saint-Exupéry.', ' 18 ene. 2023, 10:07', 'nelson@wposs.com', 'Nelson Rueda', '3164545454');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `_id` bigint(20) UNSIGNED NOT NULL,
  `Nombre_Usuario` varchar(120) NOT NULL,
  `Correo_Electronico` varchar(60) NOT NULL,
  `Telefono_Usuario` bigint(20) NOT NULL,
  `Direccion_Usuario` varchar(80) NOT NULL,
  `Contrasena_Usuario` varchar(60) NOT NULL,
  `Rol_Usuario` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`_id`, `Nombre_Usuario`, `Correo_Electronico`, `Telefono_Usuario`, `Direccion_Usuario`, `Contrasena_Usuario`, `Rol_Usuario`) VALUES
(1, 'Yeison Fabian Ramirez', 'admin@wposs.com', 3175057031, 'Cra 3A', 'admin1234', 'administrador'),
(2, 'Nelson Rueda', 'nelson@wposs.com', 3164545454, 'CRA 3 AN', 'admin1234', 'usuario'),
(3, 'Mateo Romera ', 'mateo@wposs.com', 3545151515, 'CRA 3 B', 'admin1234', 'usuario'),
(44, 'Fernando Rodríguez ', 'fernando@wposs.com', 3125464646, 'cra 3 an', 'admin1234', 'usuario');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`_id`),
  ADD UNIQUE KEY `_id` (`_id`);

--
-- Indices de la tabla `libros_prestados`
--
ALTER TABLE `libros_prestados`
  ADD PRIMARY KEY (`_id`),
  ADD UNIQUE KEY `_id` (`_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`_id`),
  ADD UNIQUE KEY `_id` (`_id`),
  ADD UNIQUE KEY `CorreoElectronico_Usuario` (`Correo_Electronico`),
  ADD UNIQUE KEY `Telefono_Usuario` (`Telefono_Usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `libros_prestados`
--
ALTER TABLE `libros_prestados`
  MODIFY `_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
