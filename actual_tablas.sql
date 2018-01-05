-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-01-2018 a las 11:33:58
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
-- Estructura de tabla para la tabla `cobros`
--

CREATE TABLE `cobros` (
  `id` int(11) NOT NULL,
  `item_orden` int(11) NOT NULL,
  `fecha_cobro` datetime NOT NULL,
  `openpay_transaccion_id` varchar(200) NOT NULL,
  `status` varchar(50) NOT NULL,
  `fecha_creacion` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cobros`
--

INSERT INTO `cobros` (`id`, `item_orden`, `fecha_cobro`, `openpay_transaccion_id`, `status`, `fecha_creacion`) VALUES
(1, 1, '2017-12-27 02:30:04', 'trwknq5ftl9hkwowuqum', 'Pagado', '2017-12-27 02:30:04'),
(2, 1, '2018-02-26 19:30:04', 'trwknq5ftl9hkwowuqum', 'Pendiente', '2017-12-27 02:30:04'),
(3, 2, '2017-12-27 02:30:04', 'trwknq5ftl9hkwowuqum', 'Pagado', '2017-12-27 02:30:04'),
(4, 2, '2018-06-26 19:30:04', 'trwknq5ftl9hkwowuqum', 'Pendiente', '2017-12-27 02:30:04'),
(5, 3, '2017-12-27 02:32:39', 'try566xgctebbohvem4x', 'Pagado', '2017-12-27 02:32:39'),
(6, 3, '2018-02-26 19:32:39', '---', 'Pendiente', '2017-12-27 02:32:39'),
(7, 4, '2017-12-27 02:32:39', 'try566xgctebbohvem4x', 'Pagado', '2017-12-27 02:32:39'),
(8, 4, '2018-03-26 19:32:39', '---', 'Pendiente', '2017-12-27 02:32:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `despachos`
--

CREATE TABLE `despachos` (
  `id` int(11) NOT NULL,
  `cliente` int(11) NOT NULL,
  `orden` int(11) NOT NULL,
  `sub_orden` int(11) NOT NULL,
  `mes` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `fecha_creacion` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `despachos`
--

INSERT INTO `despachos` (`id`, `cliente`, `orden`, `sub_orden`, `mes`, `status`, `fecha_creacion`) VALUES
(1, 1, 1, 1, '2017-12-26', 'Recibida', '2017-12-27 02:30:04'),
(2, 1, 1, 1, '2018-01-26', 'Pendiente', '2017-12-27 02:30:04'),
(3, 1, 1, 2, '2017-12-26', 'Enviada', '2017-12-27 02:30:04'),
(4, 1, 1, 2, '2018-01-26', 'Pendiente', '2017-12-27 02:30:04'),
(5, 1, 1, 2, '2018-02-26', 'Pendiente', '2017-12-27 02:30:04'),
(6, 1, 1, 2, '2018-03-26', 'Pendiente', '2017-12-27 02:30:04'),
(7, 1, 1, 2, '2018-04-26', 'Pendiente', '2017-12-27 02:30:04'),
(8, 1, 1, 2, '2018-05-26', 'Pendiente', '2017-12-27 02:30:04'),
(9, 1, 2, 3, '2017-12-26', 'Pendiente', '2017-12-27 02:32:39'),
(10, 1, 2, 3, '2018-01-26', 'Pendiente', '2017-12-27 02:32:39'),
(11, 1, 2, 4, '2017-12-26', 'Pendiente', '2017-12-27 02:32:39'),
(12, 1, 2, 4, '2018-01-26', 'Pendiente', '2017-12-27 02:32:39'),
(13, 1, 2, 4, '2018-02-26', 'Pendiente', '2017-12-27 02:32:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items_ordenes`
--

CREATE TABLE `items_ordenes` (
  `id` int(11) NOT NULL,
  `id_orden` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `data` text NOT NULL,
  `status_suscripcion` varchar(20) NOT NULL,
  `total` varchar(11) NOT NULL,
  `fecha_entrega` date NOT NULL,
  `plan` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `items_ordenes`
--

INSERT INTO `items_ordenes` (`id`, `id_orden`, `id_producto`, `data`, `status_suscripcion`, `total`, `fecha_entrega`, `plan`) VALUES
(1, 1, 7, 'a:4:{s:6:"tamano";s:7:"Mediano";s:4:"edad";s:6:"Adulto";s:12:"presentacion";s:5:"2000g";s:4:"plan";s:9:"Bimestral";}', 'Pendiente', '1400', '2017-12-26', 2),
(2, 1, 8, 'a:4:{s:6:"tamano";s:7:"Mediano";s:4:"edad";s:6:"Maduro";s:12:"presentacion";s:5:"2000g";s:4:"plan";s:9:"Semestral";}', 'Pendiente', '5400', '2017-12-26', 4),
(3, 2, 6, 'a:4:{s:6:"tamano";s:6:"Grande";s:4:"edad";s:8:"Cachorro";s:12:"presentacion";s:4:"900g";s:4:"plan";s:9:"Bimestral";}', 'Pendiente', '1200', '2017-12-26', 2),
(4, 2, 9, 'a:4:{s:6:"tamano";s:0:"";s:4:"edad";s:6:"Adulto";s:12:"presentacion";s:5:"4000g";s:4:"plan";s:10:"Trimestral";}', 'Pendiente', '2700', '2017-12-26', 3);

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
(5, 'Cat Show', '1515064355.png'),
(4, 'Beneful', '1515064335.png'),
(6, 'Dog Show', '1515064373.png'),
(7, 'Gatina', '1515064384.png'),
(8, 'Nupec', '1515064392.png'),
(9, 'Pal Gato', '1515064401.png'),
(10, 'Pro Plan', '1515064415.png'),
(11, 'Royal Canin', '1515064446.png'),
(12, 'Tier Holistic', '1515073490.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes`
--

CREATE TABLE `ordenes` (
  `id` int(11) NOT NULL,
  `cliente` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `total` varchar(11) NOT NULL,
  `fecha_creacion` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ordenes`
--

INSERT INTO `ordenes` (`id`, `cliente`, `cantidad`, `total`, `fecha_creacion`) VALUES
(1, 1, 2, '6800', '2017-12-26'),
(2, 1, 2, '3900', '2017-12-26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planes`
--

CREATE TABLE `planes` (
  `id` int(11) NOT NULL,
  `plan` varchar(200) NOT NULL,
  `descripcion` text NOT NULL,
  `meses` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `planes`
--

INSERT INTO `planes` (`id`, `plan`, `descripcion`, `meses`, `status`) VALUES
(1, 'Mensual', 'Una vez al mes podrás contar con la dotación para tu perrito', 1, 'Activo'),
(2, 'Bimestral', 'Cada dos meses te estará llegando tu selección de NutriHeroes', 2, 'Activo'),
(3, 'Trimestral', 'Tu selección de NutriHeroes cada tres meses', 3, 'Activo'),
(4, 'Semestral', 'Cada 6 meses llegará a la puerta de tu casa u oficina la dotación de tu mascota', 6, 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `precio` float NOT NULL,
  `peso` varchar(100) NOT NULL,
  `marca` int(11) NOT NULL,
  `tipo_mascota` int(11) NOT NULL,
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

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `peso`, `marca`, `tipo_mascota`, `tamanos`, `edades`, `presentaciones`, `planes`, `dataextra`, `status`) VALUES
(10, 'Belenes Max', 'Raza media adulta', 700, '13,5 kg', 5, 1, 'a:3:{s:8:"Pequeño";i:0;s:7:"Mediano";i:1;s:6:"Grande";i:1;}', 'a:3:{s:8:"Cachorro";i:1;s:6:"Adulto";i:1;s:6:"Maduro";i:1;}', 'a:3:{s:4:"900g";s:1:"0";s:5:"2000g";s:4:"1000";s:5:"4000g";s:4:"1000";}', 'a:4:{i:1;i:1;i:2;i:1;i:3;i:1;i:4;i:1;}', 'a:1:{s:3:"img";s:15:"Belenes-max.png";}', 'Activo'),
(9, 'Royal Canin', 'Raza media adulta', 550, '10 kg', 11, 1, 'a:3:{s:8:"Pequeño";i:1;s:7:"Mediano";i:1;s:6:"Grande";i:1;}', 'a:3:{s:8:"Cachorro";i:1;s:6:"Adulto";i:1;s:6:"Maduro";i:1;}', 'a:3:{s:4:"900g";s:3:"900";s:5:"2000g";s:3:"900";s:5:"4000g";s:3:"900";}', 'a:4:{i:1;i:1;i:2;i:1;i:3;i:1;i:4;i:1;}', 'a:1:{s:3:"img";s:15:"Royal-canin.png";}', 'Activo'),
(8, 'Tier Holistic', 'Raza media adulta', 650, '3 kg', 12, 1, 'a:3:{s:8:"Pequeño";i:1;s:7:"Mediano";i:1;s:6:"Grande";i:1;}', 'a:3:{s:8:"Cachorro";i:1;s:6:"Adulto";i:1;s:6:"Maduro";i:1;}', 'a:3:{s:4:"900g";s:3:"800";s:5:"2000g";s:3:"900";s:5:"4000g";s:3:"800";}', 'a:4:{i:1;i:1;i:2;i:1;i:3;i:1;i:4;i:1;}', 'a:1:{s:3:"img";s:17:"Tier-holistic.png";}', 'Activo'),
(7, 'Dow Chow', 'Raza media adulta', 840, '3 kg', 6, 1, 'a:3:{s:8:"Pequeño";i:1;s:7:"Mediano";i:1;s:6:"Grande";i:1;}', 'a:3:{s:8:"Cachorro";i:1;s:6:"Adulto";i:1;s:6:"Maduro";i:1;}', 'a:3:{s:4:"900g";s:3:"700";s:5:"2000g";s:3:"700";s:5:"4000g";s:3:"700";}', 'a:4:{i:1;i:1;i:2;i:1;i:3;i:1;i:4;i:1;}', 'a:1:{s:3:"img";s:12:"dow-chow.png";}', 'Activo'),
(6, 'Nupec', 'Raza media adulta', 1200, '20 kg', 8, 1, 'a:3:{s:8:"Pequeño";i:1;s:7:"Mediano";i:1;s:6:"Grande";i:1;}', 'a:3:{s:8:"Cachorro";i:1;s:6:"Adulto";i:1;s:6:"Maduro";i:1;}', 'a:3:{s:4:"900g";s:3:"600";s:5:"2000g";s:3:"600";s:5:"4000g";s:3:"600";}', 'a:4:{i:1;i:1;i:2;i:1;i:3;i:1;i:4;i:1;}', 'a:1:{s:3:"img";s:9:"NUPEC.png";}', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_mascotas`
--

CREATE TABLE `tipo_mascotas` (
  `id` int(11) NOT NULL,
  `tipo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_mascotas`
--

INSERT INTO `tipo_mascotas` (`id`, `tipo`) VALUES
(1, 'Perro'),
(2, 'Gato');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cobros`
--
ALTER TABLE `cobros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `despachos`
--
ALTER TABLE `despachos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `items_ordenes`
--
ALTER TABLE `items_ordenes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `planes`
--
ALTER TABLE `planes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_mascotas`
--
ALTER TABLE `tipo_mascotas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cobros`
--
ALTER TABLE `cobros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `despachos`
--
ALTER TABLE `despachos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `items_ordenes`
--
ALTER TABLE `items_ordenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `planes`
--
ALTER TABLE `planes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT de la tabla `tipo_mascotas`
--
ALTER TABLE `tipo_mascotas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
