-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 04-04-2022 a las 14:52:28
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `wc_challenge`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `phinxlog`
--

CREATE TABLE `phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `phinxlog`
--

INSERT INTO `phinxlog` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`) VALUES
(20220401125735, 'Initial', '2022-04-01 15:57:35', '2022-04-01 15:57:35', 0),
(20220401132856, 'CreateProducts', '2022-04-01 16:32:18', '2022-04-01 16:32:20', 0),
(20220401134034, 'Initial', '2022-04-01 16:40:34', '2022-04-01 16:40:34', 0),
(20220401143648, 'AlterDescriptionOnProducts', '2022-04-01 17:37:11', '2022-04-01 17:37:12', 0),
(20220401144234, 'AlterPriceOnProducts', '2022-04-01 17:42:45', '2022-04-01 17:42:47', 0),
(20220401144948, 'CreateProducts', '2022-04-01 17:50:36', '2022-04-01 17:50:37', 0),
(20220401145557, 'CreateProducts', '2022-04-01 17:56:39', '2022-04-01 17:56:40', 0),
(20220401145709, 'Initial', '2022-04-01 17:57:09', '2022-04-01 17:57:09', 0),
(20220401150318, 'AlterDescriptionOnProducts', '2022-04-01 18:03:29', '2022-04-01 18:03:30', 0),
(20220401150808, 'AlterDescriptionOnProducts', '2022-04-01 18:08:22', '2022-04-01 18:08:23', 0),
(20220401155945, 'CreateProducts', '2022-04-01 19:00:11', '2022-04-01 19:00:13', 0),
(20220401160050, 'AlterDescriptionOnProducts', '2022-04-01 19:01:02', '2022-04-01 19:01:03', 0),
(20220401193044, 'Initial', '2022-04-01 22:30:45', '2022-04-01 22:30:45', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `productId` int(11) DEFAULT NULL,
  `sku` varchar(60) DEFAULT NULL,
  `title` varchar(60) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `inventory_quantity` int(10) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `phinxlog`
--
ALTER TABLE `phinxlog`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
