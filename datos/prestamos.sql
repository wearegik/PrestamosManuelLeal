-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-04-2015 a las 01:38:36
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `prestamos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abonos`
--

CREATE TABLE IF NOT EXISTS `abonos` (
`idabono` int(11) unsigned NOT NULL,
  `idprestamo` int(11) unsigned NOT NULL,
  `valor` int(11) NOT NULL,
  `cuotas` int(2) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `abonos`
--

INSERT INTO `abonos` (`idabono`, `idprestamo`, `valor`, `cuotas`, `fecha`) VALUES
(3, 75, 100000, 25, '2015-04-15 01:50:17'),
(4, 75, 30000, 8, '2015-04-15 01:50:57'),
(5, 75, 70000, 18, '2015-04-15 01:53:03'),
(6, 75, 40000, 10, '2015-04-15 01:53:52'),
(7, 78, 200000, 11, '2015-04-15 17:46:31'),
(8, 78, 50000, 3, '2015-04-15 17:46:48'),
(9, 78, 850000, 46, '2015-04-15 17:50:32'),
(10, 79, 50000, 3, '2015-04-15 17:54:22'),
(11, 76, 130000, 90, '2015-04-16 00:38:13'),
(12, 82, 1100000, 60, '2015-04-16 00:39:22'),
(13, 74, 2600000, 90, '2015-04-16 00:44:55'),
(14, 73, 1200000, 60, '2015-04-16 00:45:28'),
(15, 77, 1200000, 60, '2015-04-16 00:45:51'),
(16, 83, 1100000, 30, '2015-04-16 00:46:28'),
(17, 84, 1100000, 30, '2015-04-16 00:46:47'),
(18, 85, 100000, 10, '2015-04-18 22:14:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
`idcliente` int(11) unsigned NOT NULL,
  `Nombres` text COLLATE utf8_spanish_ci NOT NULL,
  `Apellidos` text COLLATE utf8_spanish_ci NOT NULL,
  `Cedula` int(15) NOT NULL,
  `Direccion` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `Correo` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `Telefono` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idcliente`, `Nombres`, `Apellidos`, `Cedula`, `Direccion`, `Correo`, `Telefono`, `foto`) VALUES
(20, 'Mauricio', 'Lizcano', 10234564, 'calle inventada', 'edgarmlizcano@gmail.com', '6339691', '10995683_916400155059277_7438335936893587806_n.jpg'),
(21, 'Beto ', 'caceres', 8815247, 'bodega 5', 'bet@hotmail', '3152368', 'WIN_20141118_171712.JPG'),
(22, 'milton', 'barajas', 88753135, 'platano', 'milto@hotmail.com', '3143599695', 'WIN_20141118_171712.JPG'),
(23, 'ana galvan', 'galvan', 60355899, 'platano ocaÃ±a', 'anag@hotmail.com', '31185642', 'WIN_20141118_171712.JPG'),
(24, 'marlin', 'caceres', 65234789, 'platano hija de humberto c', 'marlin@hotmail.com', '311589647', 'WIN_20141031_152400.JPG'),
(25, 'marcial', 'costeÃ±o', 8963214, 'platano', 'marcial@hotmial.com', '31756238', 'WIN_20141118_171712.JPG'),
(26, 'oscar', 'guicho', 78945623, 'platano', 'guicho@hotmail.com', '317895632', 'WIN_20141118_171712.JPG'),
(27, 'nancy', 'guicha', 55698741, 'platano', 'nancy@hotmail.com', '315123654', 'WIN_20141118_171712.JPG'),
(28, 'alirio', 'platano', 556321470, 'platano(socorro)', 'alirio@hotmail.com', '3175662345', 'WIN_20141118_171712.JPG'),
(29, 'jorge', 'alba', 88152369, 'platano', 'jorge@hotmail.com', '31445552', 'WIN_20141118_171712.JPG'),
(30, 'jimena', 'giovany', 2147483647, 'platano', 'jimena@homail.com', '5562384', 'WIN_20141118_171712.JPG'),
(31, 'alfonso', 'rojas', 88456321, 'platano', 'alfonso@hotmail.com', '3142365212', 'WIN_20141118_171712.JPG'),
(32, 'leonor', 'mama de j', 60852147, 'platano', 'leonor@hotmail.com', '375285265', 'WIN_20141118_171712.JPG'),
(33, 'humberto', 'caceres', 45523698, 'platano', 'humberto@hotmail.com', '321852369', 'WIN_20141118_171712.JPG'),
(34, 'cecilia', 'milton', 55623471, 'platano', 'cecilia@hotmail.com', '3185852542', 'WIN_20141118_171712.JPG'),
(53, 'cliente', 'Prueba', 1023548873, 'call 19 # 20- 45', 'correodeprueba@prueba.com', '3214568723', 'prueba.png'),
(36, 'yecid', 'platano', 85236974, 'puesto milton', 'yecid@hotmail.com', '321456987', 'WIN_20141118_171712.JPG'),
(37, 'saul', 'barajas', 785632147, 'platano', 'saul@hotmail.com', '3104840536', 'WIN_20141118_171712.JPG'),
(38, 'socorro', 'de barajas', 60852369, 'platano', 'socorro@hotmail.com', '315263247', 'WIN_20141118_171712.JPG'),
(39, 'hemry', 'rojas', 52369874, 'platano', 'henrry@hotmail.com', '31268456', 'WIN_20141118_171712.JPG'),
(40, 'ever', 'mejia', 88452563, 'platano', 'chiguiro@hotmail.com', '3187380710', 'WIN_20141118_171712.JPG'),
(41, 'diana', 'valencia', 60852369, 'platano', 'diana@hotmail.com', '315269874', 'WIN_20141118_171712.JPG'),
(42, 'evangelista', 'caceres', 88523147, 'hijo humberto', 'evan@hotmail.com', '315826953', 'WIN_20141118_171712.JPG'),
(43, 'jose', 'valderrama', 88452369, 'platano', 'jose@hotmail.com', '3166946375', 'WIN_20141118_171712.JPG'),
(44, 'chavela', 'gamboa', 65896324, 'platano', 'chav@hotmail.com', '3156231785', 'WIN_20141118_171712.JPG'),
(45, 'marquitos', 'cecilia', 85236974, 'platano', 'marquit@hotmail.com', '315236987', 'WIN_20141118_171712.JPG'),
(46, 'luis fernando', 'platano', 88456123, 'platano', 'luis@hotmail.com', '3158963321', 'WIN_20141118_171712.JPG'),
(47, 'carlos ', 'camero', 58236974, 'platano', 'carlos@hotmail.com', '315896332', 'WIN_20141118_171712.JPG'),
(48, 'lisandro', 'gamboa', 56231475, 'platano', 'lis@hotmail.com', '3218007263', 'WIN_20141118_171712.JPG'),
(49, 'edinson', 'caleta', 5236987, 'platano', 'edin@hotmail.com', '31526321', 'WIN_20141118_171712.JPG'),
(50, 'luis ', 'enrrique', 88523693, 'platano', 'luis@hotmail.com', '315642582', 'WIN_20150320_152358.JPG'),
(51, 'nelson ', 'valderrama', 88156123, 'platano', 'nelson@hotmail.com', '3134915705', 'WIN_20141118_171712.JPG'),
(52, 'albeiro', 'cecilia', 88253654, 'platano', 'albeiro@hotmail.com', '31562456', 'WIN_20141031_152400.JPG');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `clientes_activos`
--
CREATE TABLE IF NOT EXISTS `clientes_activos` (
`Nombres` text
,`Apellidos` text
,`idcliente` int(11) unsigned
);
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo`
--

CREATE TABLE IF NOT EXISTS `prestamo` (
`idprestamo` int(20) unsigned NOT NULL,
  `idcliente` int(10) unsigned NOT NULL,
  `Valor` text COLLATE utf8_spanish_ci NOT NULL,
  `Interes` text COLLATE utf8_spanish_ci NOT NULL,
  `Prestamoya` text COLLATE utf8_spanish_ci NOT NULL,
  `Cuotas` text COLLATE utf8_spanish_ci NOT NULL,
  `Tiempo` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` tinyint(1) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=88 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `prestamo`
--

INSERT INTO `prestamo` (`idprestamo`, `idcliente`, `Valor`, `Interes`, `Prestamoya`, `Cuotas`, `Tiempo`, `fecha`, `estado`) VALUES
(76, 20, '100000', '10', '1', '90', '90', '2015-04-14 20:44:59', 1),
(75, 20, '200000', '10', '1', '60', '60', '2015-04-14 20:39:38', 1),
(74, 20, '2000000', '10', '0', '90', '90', '2015-04-14 20:39:11', 1),
(73, 20, '1000000', '10', '0', '60', '60', '2015-04-14 20:38:33', 1),
(77, 20, '1000000', '10', '0', '60', '60', '2015-04-15 12:40:02', 1),
(78, 21, '1000000', '5', '0', '60', '60', '2015-04-15 12:44:13', 1),
(79, 21, '1000000', '10', '0', '60', '60', '2015-04-15 12:53:27', 0),
(80, 22, '1000000', '10', '0', '60', '60', '2015-04-15 19:25:36', 0),
(81, 22, '1000000', '10', '0', '60', '60', '2015-04-15 19:27:11', 0),
(82, 22, '1000000', '5', '1', '60', '60', '2015-04-15 19:28:31', 1),
(83, 20, '1000000', '10', '1', '30', '30', '2015-04-15 19:41:12', 1),
(84, 20, '1000000', '10', '1', '30', '30', '2015-04-15 19:41:38', 1),
(85, 21, '500000', '10', '0', '60', '60', '2015-04-18 17:13:58', 0),
(86, 20, '100000', 'null', '1', '30', '30', '2015-04-18 18:22:30', 0),
(87, 53, '200000', '10', '1', '30', '30', '2015-04-18 18:28:45', 0);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `suma`
--
CREATE TABLE IF NOT EXISTS `suma` (
`Prestamoya` text
,`suma_total` double
);
-- --------------------------------------------------------

--
-- Estructura para la vista `clientes_activos`
--
DROP TABLE IF EXISTS `clientes_activos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `clientes_activos` AS select `c`.`Nombres` AS `Nombres`,`c`.`Apellidos` AS `Apellidos`,`c`.`idcliente` AS `idcliente` from (`cliente` `c` join `prestamo` `p` on((`c`.`idcliente` = `p`.`idcliente`))) where (`p`.`Prestamoya` = 1) group by `c`.`Nombres`,`c`.`Apellidos`,`c`.`idcliente`;

-- --------------------------------------------------------

--
-- Estructura para la vista `suma`
--
DROP TABLE IF EXISTS `suma`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `suma` AS select `prestamo`.`Prestamoya` AS `Prestamoya`,sum(`prestamo`.`Valor`) AS `suma_total` from `prestamo` group by `prestamo`.`Prestamoya`;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `abonos`
--
ALTER TABLE `abonos`
 ADD PRIMARY KEY (`idabono`), ADD KEY `idprestamo` (`idprestamo`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
 ADD PRIMARY KEY (`idcliente`);

--
-- Indices de la tabla `prestamo`
--
ALTER TABLE `prestamo`
 ADD PRIMARY KEY (`idprestamo`), ADD KEY `idcliente` (`idcliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `abonos`
--
ALTER TABLE `abonos`
MODIFY `idabono` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
MODIFY `idcliente` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT de la tabla `prestamo`
--
ALTER TABLE `prestamo`
MODIFY `idprestamo` int(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=88;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
