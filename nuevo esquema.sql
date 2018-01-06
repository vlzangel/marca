-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-01-2018 a las 17:32:35
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `marca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(500) NOT NULL,
  `img` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id`, `nombre`, `img`) VALUES
(3, 'Belenes Max', '1515021095.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `precio` float NOT NULL,
  `peso` varchar(100) NOT NULL,
  `marca` int(11) NOT NULL,
  `tamanos` text NOT NULL,
  `edades` text NOT NULL,
  `presentaciones` text NOT NULL,
  `planes` text NOT NULL,
  `dataextra` text NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `precio`, `peso`, `marca`, `tamanos`, `edades`, `presentaciones`, `planes`, `dataextra`, `status`) VALUES
(10, 'Belenes Max', 700, '2000 g', 3, 'a:3:{s:8:"Pequeño";i:0;s:7:"Mediano";i:1;s:6:"Grande";i:1;}', 'a:3:{s:8:"Cachorro";i:1;s:6:"Adulto";i:1;s:6:"Maduro";i:1;}', 'a:3:{s:4:"900g";s:1:"0";s:5:"2000g";s:4:"1000";s:5:"4000g";s:4:"1000";}', 'a:4:{i:1;i:1;i:2;i:1;i:3;i:1;i:4;i:1;}', 'a:1:{s:3:"img";s:15:"Belenes-max.png";}', 'Activo'),
(9, 'Royal Canin', 0, '', 0, 'a:3:{s:8:"Pequeño";i:1;s:7:"Mediano";i:1;s:6:"Grande";i:1;}', 'a:3:{s:8:"Cachorro";i:1;s:6:"Adulto";i:1;s:6:"Maduro";i:1;}', 'a:3:{s:4:"900g";s:3:"900";s:5:"2000g";s:3:"900";s:5:"4000g";s:3:"900";}', 'a:4:{i:1;i:1;i:2;i:1;i:3;i:1;i:4;i:1;}', 'a:1:{s:3:"img";s:15:"Royal-canin.png";}', 'Activo'),
(8, 'Tier Holistic', 0, '', 0, 'a:3:{s:8:"Pequeño";i:1;s:7:"Mediano";i:1;s:6:"Grande";i:1;}', 'a:3:{s:8:"Cachorro";i:1;s:6:"Adulto";i:1;s:6:"Maduro";i:1;}', 'a:3:{s:4:"900g";s:3:"800";s:5:"2000g";s:3:"900";s:5:"4000g";s:3:"800";}', 'a:4:{i:1;i:1;i:2;i:1;i:3;i:1;i:4;i:1;}', 'a:1:{s:3:"img";s:17:"Tier-holistic.png";}', 'Activo'),
(7, 'Dow Chow', 0, '', 0, 'a:3:{s:8:"Pequeño";i:1;s:7:"Mediano";i:1;s:6:"Grande";i:1;}', 'a:3:{s:8:"Cachorro";i:1;s:6:"Adulto";i:1;s:6:"Maduro";i:1;}', 'a:3:{s:4:"900g";s:3:"700";s:5:"2000g";s:3:"700";s:5:"4000g";s:3:"700";}', 'a:4:{i:1;i:1;i:2;i:1;i:3;i:1;i:4;i:1;}', 'a:1:{s:3:"img";s:12:"dow-chow.png";}', 'Activo'),
(6, 'Nupec', 0, '', 0, 'a:3:{s:8:"Pequeño";i:1;s:7:"Mediano";i:1;s:6:"Grande";i:1;}', 'a:3:{s:8:"Cachorro";i:1;s:6:"Adulto";i:1;s:6:"Maduro";i:1;}', 'a:3:{s:4:"900g";s:3:"600";s:5:"2000g";s:3:"600";s:5:"4000g";s:3:"600";}', 'a:4:{i:1;i:1;i:2;i:1;i:3;i:1;i:4;i:1;}', 'a:1:{s:3:"img";s:9:"NUPEC.png";}', 'Activo'),
(22, 'Prueba', 100, '13,5 kg', 3, 'a:3:{s:8:"Pequeño";i:1;s:7:"Mediano";i:0;s:6:"Grande";i:0;}', 'a:3:{s:8:"Cachorro";i:0;s:6:"Adulto";i:1;s:6:"Maduro";i:0;}', 'N;', 'a:4:{i:1;i:0;i:2;i:1;i:3;i:1;i:4;i:0;}', 'a:1:{s:3:"img";s:14:"1515021741.png";}', 'Activo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
