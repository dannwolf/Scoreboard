-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-02-2018 a las 15:58:04
-- Versión del servidor: 5.6.26
-- Versión de PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `scoreboard`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `drivers`
--

CREATE TABLE IF NOT EXISTS `drivers` (
  `id` int(10) unsigned NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `foto` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `drivers`
--

INSERT INTO `drivers` (`id`, `nombre`, `foto`) VALUES
(1, 'Prospero Garcia', NULL),
(2, 'Ivan Falcon', NULL),
(3, 'Gamaliel Perez', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodos`
--

CREATE TABLE IF NOT EXISTS `periodos` (
  `id` int(10) unsigned NOT NULL,
  `nombre` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `periodos`
--

INSERT INTO `periodos` (`id`, `nombre`) VALUES
(1, 'Semana 1'),
(2, 'Semana 2'),
(3, 'Semana 3'),
(4, 'Semana 4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `scores`
--

CREATE TABLE IF NOT EXISTS `scores` (
  `id` int(11) NOT NULL,
  `drivers_id` int(10) unsigned NOT NULL,
  `stats_id` int(10) unsigned NOT NULL,
  `periodos_id` int(10) unsigned NOT NULL,
  `valor` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `scores`
--

INSERT INTO `scores` (`id`, `drivers_id`, `stats_id`, `periodos_id`, `valor`, `fecha`) VALUES
(1, 1, 1, 1, 80, '2018-02-04'),
(2, 2, 1, 1, 80, '2018-02-04'),
(3, 1, 1, 2, 100, '2018-02-11'),
(4, 1, 2, 1, 90, '2018-02-04'),
(5, 1, 3, 1, 70, '2018-02-19'),
(6, 1, 1, 3, 80, '2018-02-22'),
(7, 1, 2, 2, 100, '2018-02-23'),
(8, 1, 1, 4, 90, '2018-02-22'),
(9, 1, 2, 4, 80, '0000-00-00'),
(10, 1, 4, 4, 90, '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stats`
--

CREATE TABLE IF NOT EXISTS `stats` (
  `id` int(10) unsigned NOT NULL,
  `nombre` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `stats`
--

INSERT INTO `stats` (`id`, `nombre`) VALUES
(1, 'Puntualidad'),
(2, 'Asistencia'),
(3, 'Presentacion/Uniforme'),
(4, 'Actitud');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `periodos`
--
ALTER TABLE `periodos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`id`,`drivers_id`,`stats_id`,`periodos_id`),
  ADD KEY `fk_socres_drivers_idx` (`drivers_id`),
  ADD KEY `fk_socres_stats1_idx` (`stats_id`),
  ADD KEY `fk_scores_periodos1_idx` (`periodos_id`);

--
-- Indices de la tabla `stats`
--
ALTER TABLE `stats`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `periodos`
--
ALTER TABLE `periodos`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `scores`
--
ALTER TABLE `scores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `stats`
--
ALTER TABLE `stats`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `scores`
--
ALTER TABLE `scores`
  ADD CONSTRAINT `fk_scores_periodos1` FOREIGN KEY (`periodos_id`) REFERENCES `periodos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_socres_drivers` FOREIGN KEY (`drivers_id`) REFERENCES `drivers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_socres_stats1` FOREIGN KEY (`stats_id`) REFERENCES `stats` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
