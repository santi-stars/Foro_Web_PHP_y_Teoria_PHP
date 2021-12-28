-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-12-2021 a las 17:59:57
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `foromotos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `category_id` int(6) NOT NULL,
  `category_name` varchar(200) COLLATE utf8_bin NOT NULL,
  `category_desc` varchar(200) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_desc`) VALUES
(1, 'Motos nuevas', 'Categoria para temas relacionados con motos nuevas'),
(2, 'Motos de segunda mano', 'Categoria para temas relacionados con motos de segunda mano'),
(3, 'Mecánica', 'Temas relaccionados con la mecánica de motos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(6) NOT NULL,
  `comment_text` text COLLATE utf8_bin NOT NULL,
  `comment_date` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(6) NOT NULL,
  `topic_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_text`, `comment_date`, `user_id`, `topic_id`) VALUES
(1, 'me he comprado una caquita de moto papito!!! está más en el taller que en mi garaje', '2021-11-23 20:42:39', 4, 1),
(2, 'Estos c@$&%?ºs de blasco bikes llevan un mes entero para arreglarme la bomba de agua de la moto!!! y siempre que paso por las mañanas están esos dos olgazanes tomando cafe y tocándose los h&=$#s bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla cago en dios!!!', '2021-12-12 14:03:15', 2, 8),
(3, 'Si yo suelo verlos cuando paso tambien, son unos loquillos huevones', '2021-12-12 14:03:57', 4, 8),
(4, 'el mecánico más guapo de los dos, ese tal santi, siempre está comiendo galletas y bebiendo café\r\nNo hace ni un huevo!!!', '2021-12-14 23:08:07', 3, 8),
(5, 'Voy de la óptica hasta mi casa de caballito locoooooo!!! ', '2021-12-16 16:45:46', 5, 3),
(6, 'Si es que soy un poco ruín a la hora de comprar las motos y luego se me rompen cada 2 x 3, pero eso si... luego me quejo al del taller porque me cobra mucho siendo que la moto no me ha costado casi nada y claro... el mecanico dice que eso no es su problema!!!', '2021-12-16 16:48:10', 4, 4),
(7, 'Algo hicieron mal estos de Blaco Bikes porque me cambiaron el cilindro y despues de ir 1 año con la moto a fuego, se me gripa!!! la culpa la tiene los mecánicos', '2021-12-16 16:49:53', 14, 5),
(8, 'Soy toreto bravo y la FAMILY es lo más important del world!!!', '2021-12-16 16:51:20', 3, 6),
(9, 'Me compré una vespa porque son muy chu chu chuuulis pero luego se me apaga cada 2 x 3 y está más en el taller que en mi garaje, la DGT manda mis multas de estacionamiento encima de la acera... directamente al taller!!!', '2021-12-16 16:53:07', 14, 7),
(14, 'bla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla bla', '2021-12-17 20:10:03', 33, 14),
(15, 'BGFDFGDFGF', '2021-12-27 17:42:12', 33, 14),
(23, 'v vnbn nb mv nvb', '2021-12-27 22:29:01', 33, 14),
(25, 'dfyhjuyjkjyughuhtgf', '2021-12-27 22:32:54', 33, 14),
(29, 'Vaya zarrios te compras!!!', '2021-12-28 12:49:35', 33, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `topics`
--

CREATE TABLE `topics` (
  `topic_id` int(6) NOT NULL,
  `topic_name` varchar(200) COLLATE utf8_bin NOT NULL,
  `topic_date` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(6) NOT NULL,
  `category_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `topics`
--

INSERT INTO `topics` (`topic_id`, `topic_name`, `topic_date`, `user_id`, `category_id`) VALUES
(1, 'Mi moto es una ponzoña papito!!!', '2021-11-23 20:40:10', 4, 2),
(3, 'Mi moto hace unos caballitos que flipas!!!', '2021-12-12 12:11:52', 5, 1),
(4, 'Aaaaayyyyy mamita otra vez se me rompió esta moto china!!!', '2021-12-12 12:12:53', 4, 1),
(5, 'Se me gripó todo el cilindro cuando me metieron el pistón!!!', '2021-12-12 12:13:38', 2, 3),
(6, 'La FAMILIA de mecánicos es lo más importante!!! RESPECT!!!', '2021-12-12 12:14:18', 3, 3),
(7, 'Mi vespa se apaga cuando quiere!!!', '2021-12-12 12:18:48', 2, 3),
(8, 'Llevé mi X Evo a Blasco Bikes y aun no la han arreglado!!!', '2021-12-12 12:19:50', 2, 3),
(14, 'bla bla bla', '2021-12-17 20:10:03', 33, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `user_id` int(6) NOT NULL,
  `user_nick` varchar(100) COLLATE utf8_bin NOT NULL,
  `user_email` varchar(200) COLLATE utf8_bin NOT NULL,
  `user_pass` varchar(100) COLLATE utf8_bin NOT NULL,
  `user_reg_date` datetime NOT NULL DEFAULT current_timestamp(),
  `user_level` int(6) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_id`, `user_nick`, `user_email`, `user_pass`, `user_reg_date`, `user_level`) VALUES
(1, 'santiR6', 'santi_r6@hotmail.es', '9a788153b78f57c055dce89aaa7e94d1', '2021-11-23 18:47:12', 666),
(2, 'elCuñado69', 'elcuñado69@gmail.com', '34cbda7f9efc05d41444409798f53adb', '2021-11-23 19:45:29', 0),
(3, 'vinGasolina', 'vin_gasolina69@hotmail.com', '34cbda7f9efc05d41444409798f53adb', '2021-12-01 16:35:31', 0),
(4, 'papitoLoco', 'papitoloquito6969@hotmail.com', '34cbda7f9efc05d41444409798f53adb', '2021-11-23 19:46:29', 0),
(5, 'raulCrack', 'raulfucker69@hotmail.com', '34cbda7f9efc05d41444409798f53adb', '2021-11-23 20:09:38', 0),
(13, 'SergioBlasco99', 'sergi99@gmail.com', '5bf8078ffb843897b457390490bd8dc9', '2021-12-14 18:37:17', 0),
(14, 'felipeElVago69', 'felipeElVago69@gmail.com', 'f00053ddc7c0a7484b5ea5cccc7debc3', '2021-12-14 20:40:49', 0),
(33, 'reyBribon69', 'reyBribon69@hotmail.es', 'c1efcdf836658ba7e7bf012be23f2ee8', '2021-12-14 22:13:20', 0),
(34, 'santir6', 'santi@gmail.es', '34cbda7f9efc05d41444409798f53adb', '2021-12-28 13:03:50', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name_unique` (`category_name`);

--
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id_fk` (`user_id`) USING BTREE,
  ADD KEY `topic_id_fk` (`topic_id`);

--
-- Indices de la tabla `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`topic_id`),
  ADD UNIQUE KEY `topic_name_unique` (`topic_name`),
  ADD KEY `user_id_fk` (`user_id`) USING BTREE,
  ADD KEY `category_id_fk` (`category_id`) USING BTREE;

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_nick_unique` (`user_nick`),
  ADD UNIQUE KEY `user_email_unique` (`user_email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `topics`
--
ALTER TABLE `topics`
  MODIFY `topic_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `topic_id_fk` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`topic_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `category_id_fk` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
