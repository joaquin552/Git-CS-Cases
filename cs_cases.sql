-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-10-2026 a las 15:39:08
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
-- Base de datos: `cs_cases`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arma`
--

CREATE TABLE `arma` (
  `IDarma` int(11) NOT NULL,
  `nombreArma` varchar(50) NOT NULL,
  `probabilidad` int(11) NOT NULL,
  `tipoArma` varchar(25) NOT NULL,
  `IDobjeto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `IDcaja` int(11) NOT NULL,
  `nombreCaja` varchar(50) NOT NULL,
  `tipoCaja` varchar(25) NOT NULL,
  `IDobjeto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificaciones_pagina`
--

CREATE TABLE `calificaciones_pagina` (
  `IDcalificacion` int(11) NOT NULL,
  `IDusuario` int(11) NOT NULL,
  `puntuacion` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `IDcomentario` int(11) NOT NULL,
  `contenido` text NOT NULL,
  `IDautor` int(11) NOT NULL,
  `IDreceptor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `IDcomentario` int(11) NOT NULL,
  `IDusuario` int(11) NOT NULL,
  `comentario` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios_perfil`
--

CREATE TABLE `comentarios_perfil` (
  `IDcomentario` int(11) NOT NULL,
  `IDperfil` int(11) NOT NULL,
  `IDautor` int(11) NOT NULL,
  `comentario` text NOT NULL,
  `estado` varchar(20) DEFAULT 'visible',
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_usuario`
--

CREATE TABLE `inventario_usuario` (
  `IDinventario` int(11) NOT NULL,
  `IDusuario` int(11) NOT NULL,
  `IDobjeto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `objeto`
--

CREATE TABLE `objeto` (
  `IDobjeto` int(11) NOT NULL,
  `nombreObjeto` varchar(50) NOT NULL,
  `rareza` varchar(25) NOT NULL,
  `IDusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `IDusuario` int(11) NOT NULL,
  `nombreUsuario` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `rol` varchar(25) NOT NULL DEFAULT 'usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`IDusuario`, `nombreUsuario`, `email`, `contraseña`, `rol`) VALUES
(1, 'cristo', 'cristo@pepe.cum', '$2y$10$zV6KuLGfJWGHSM25yu/eC.xTKpP7zWw9aeLglG97PPhlCxh6OV1Zi', 'usuario'),
(2, 'thiago', '11223123@gmaildasfkasfkdf', '$2y$10$7RR2vA49fhAmQpKDmCaJm.foXq9cvUrqBxflDJ51Q1K.gPwVqOSaq', 'dev'),
(3, 'random', 'sdf@dfs', '$2y$10$TVkevHH31NhNaEc3UDaqa.ALyM6o.sPQNR/pA3uMv2a4uZ9WJ7Jhe', 'usuario');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `arma`
--
ALTER TABLE `arma`
  ADD PRIMARY KEY (`IDarma`),
  ADD KEY `IDobjeto` (`IDobjeto`);

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`IDcaja`),
  ADD KEY `IDobjeto` (`IDobjeto`);

--
-- Indices de la tabla `calificaciones_pagina`
--
ALTER TABLE `calificaciones_pagina`
  ADD PRIMARY KEY (`IDcalificacion`),
  ADD UNIQUE KEY `unico_usuario_calificacion` (`IDusuario`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`IDcomentario`),
  ADD KEY `IDautor` (`IDautor`),
  ADD KEY `IDreceptor` (`IDreceptor`);

--
-- Indices de la tabla `comentarios_perfil`
--
ALTER TABLE `comentarios_perfil`
  ADD PRIMARY KEY (`IDcomentario`),
  ADD KEY `IDperfil` (`IDperfil`),
  ADD KEY `IDautor` (`IDautor`);

--
-- Indices de la tabla `inventario_usuario`
--
ALTER TABLE `inventario_usuario`
  ADD PRIMARY KEY (`IDinventario`),
  ADD KEY `IDusuario` (`IDusuario`),
  ADD KEY `IDobjeto` (`IDobjeto`);

--
-- Indices de la tabla `objeto`
--
ALTER TABLE `objeto`
  ADD PRIMARY KEY (`IDobjeto`),
  ADD KEY `IDusuario` (`IDusuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`IDusuario`),
  ADD UNIQUE KEY `nombreUsuario` (`nombreUsuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `arma`
--
ALTER TABLE `arma`
  MODIFY `IDarma` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `IDcaja` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `calificaciones_pagina`
--
ALTER TABLE `calificaciones_pagina`
  MODIFY `IDcalificacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `IDcomentario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `IDcomentario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comentarios_perfil`
--
ALTER TABLE `comentarios_perfil`
  MODIFY `IDcomentario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inventario_usuario`
--
ALTER TABLE `inventario_usuario`
  MODIFY `IDinventario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `objeto`
--
ALTER TABLE `objeto`
  MODIFY `IDobjeto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `IDusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `arma`
--
ALTER TABLE `arma`
  ADD CONSTRAINT `arma_ibfk_1` FOREIGN KEY (`IDobjeto`) REFERENCES `objeto` (`IDobjeto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `caja`
--
ALTER TABLE `caja`
  ADD CONSTRAINT `caja_ibfk_1` FOREIGN KEY (`IDobjeto`) REFERENCES `objeto` (`IDobjeto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `calificaciones_pagina`
--
ALTER TABLE `calificaciones_pagina`
  ADD CONSTRAINT `calificaciones_pagina_ibfk_1` FOREIGN KEY (`IDusuario`) REFERENCES `usuario` (`IDusuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`IDautor`) REFERENCES `usuario` (`IDusuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`IDreceptor`) REFERENCES `usuario` (`IDusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comentarios_perfil`
--
ALTER TABLE `comentarios_perfil`
  ADD CONSTRAINT `comentarios_perfil_ibfk_1` FOREIGN KEY (`IDperfil`) REFERENCES `usuario` (`IDusuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `comentarios_perfil_ibfk_2` FOREIGN KEY (`IDautor`) REFERENCES `usuario` (`IDusuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `inventario_usuario`
--
ALTER TABLE `inventario_usuario`
  ADD CONSTRAINT `inventario_usuario_ibfk_1` FOREIGN KEY (`IDusuario`) REFERENCES `usuario` (`IDusuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inventario_usuario_ibfk_2` FOREIGN KEY (`IDobjeto`) REFERENCES `objeto` (`IDobjeto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `objeto`
--
ALTER TABLE `objeto`
  ADD CONSTRAINT `objeto_ibfk_1` FOREIGN KEY (`IDusuario`) REFERENCES `usuario` (`IDusuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
