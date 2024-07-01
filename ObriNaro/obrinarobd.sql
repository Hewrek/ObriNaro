-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-07-2024 a las 12:38:55
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `obrinarobd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `juego_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`id`, `usuario_id`, `juego_id`, `cantidad`) VALUES
(59, 17, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `juego_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_producto` decimal(10,2) NOT NULL,
  `precio_total` decimal(10,2) NOT NULL,
  `fecha_actual` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`id`, `usuario_id`, `juego_id`, `cantidad`, `precio_producto`, `precio_total`, `fecha_actual`) VALUES
(35, 17, 1, 1, 47650.00, 47650.00, '2024-07-01 05:32:26'),
(36, 17, 4, 2, 23430.00, 46860.00, '2024-07-01 05:32:26'),
(37, 17, 5, 2, 30000.00, 60000.00, '2024-07-01 05:32:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `id_contacto` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `mensaje` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`id_contacto`, `nombre`, `email`, `mensaje`) VALUES
(1, 'test1', 'test1@gmail.com', 'muy buena pagina un 10'),
(2, 'Nefi Apablaza', 'mcsg.android@gmail.com', '1234'),
(4, 'Nefi Apablaza', 'mcsg.android@gmail.com', '123'),
(5, 'Nefi Apablaza', 'mcsg.android@gmail.com', 'holahola\r\n'),
(6, 'Nefi Apablaza', 'mcsg.android@gmail.com', 'hola fer'),
(7, 'test', 'test@gmail.com', 'ewewew'),
(10, 'tasdsad', 'sada@asdsa.cl', '123213'),
(11, 'test', 'asdasdasdasd@asdasda.com', '1232132131231323'),
(12, 'tesatt', 'sdas@asdad.com', 'qwewqewq');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juegos`
--

CREATE TABLE `juegos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(30) NOT NULL,
  `imagen` text NOT NULL,
  `precio` int(11) NOT NULL,
  `desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `juegos`
--

INSERT INTO `juegos` (`id`, `titulo`, `imagen`, `precio`, `desc`) VALUES
(1, 'Sekiro Shadow Die Twice', './img/juegos/01.jpg', 47650, 'En Sekiro: Shadows Die Twice, te sumerges en el Japón feudal como el \"lobo de un solo brazo\", un guerrero shinobi con la tarea de rescatar a tu joven señor secuestrado y vengar tu honor perdido. El juego combina acción intensa y sigilo con un sistema de combate visceral y desafiante.'),
(2, 'Dark Souls 3', './img/juegos/02.jpg', 38500, 'Dark Souls 3: En un mundo oscuro y devastado, lucha contra criaturas colosales y despiadados seres en tu búsqueda por enlazar el fuego y salvar la humanidad.'),
(3, 'Elden Ring', './img/juegos/03.jpg', 37760, 'Elden Ring: Explora un vasto reino fracturado y lleno de misterios como Eljin, el heredero desterrado, mientras desentrañas antiguas leyendas y desafías a poderosos enemigos en un viaje épico.'),
(4, 'Minecraft', './img/juegos/04.jpg', 23430, 'Minecraft: Sumérgete en un mundo infinito de bloques donde puedes explorar, construir y sobrevivir en paisajes generados aleatoriamente, enfrentando peligros y creando tus propias aventuras.'),
(5, 'Nier: Automata', './img/juegos/05.jpg', 30000, 'Nier: Automata: Únete a androides 2B, 9S y A2 en una misión para recuperar la Tierra de las máquinas invasoras, explorando una narrativa profunda y un combate fluido en este RPG de acción.'),
(7, 'Dark Souls Remastered', './img/juegos/06.jpg', 26900, 'Dark Souls Remastered: Embárcate en un viaje desafiante a través de Lordran, donde cada paso puede ser tu último en un mundo infestado de monstruos y enemigos despiadados, en busca de reavivar la llama primigenia.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `user` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(15) NOT NULL,
  `fono` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `user`, `email`, `password`, `fono`) VALUES
(11, 'Nefi Apablaza', 'nefixandres@gmail.com', '1234567', '935548150'),
(15, 'test1', 'ne@gmail.com', '1234567', '123456789'),
(16, 'test', 'hazza.nebu@gmail.com', '1234567', '123456789'),
(17, 'ferchouchi', 'fer@gmail.com', '1234567', '912345677');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_contacto`
--

CREATE TABLE `usuario_contacto` (
  `id_usuario` int(11) NOT NULL,
  `id_contacto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario_contacto`
--

INSERT INTO `usuario_contacto` (`id_usuario`, `id_contacto`) VALUES
(11, 4),
(11, 5),
(11, 6),
(11, 7),
(11, 10),
(11, 11),
(17, 12);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `juego_id` (`juego_id`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `juego_id` (`juego_id`);

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`id_contacto`);

--
-- Indices de la tabla `juegos`
--
ALTER TABLE `juegos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `titulo` (`titulo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `user` (`user`);

--
-- Indices de la tabla `usuario_contacto`
--
ALTER TABLE `usuario_contacto`
  ADD PRIMARY KEY (`id_usuario`,`id_contacto`),
  ADD KEY `id_contacto` (`id_contacto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `id_contacto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `juegos`
--
ALTER TABLE `juegos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `fk_carrito_juego` FOREIGN KEY (`juego_id`) REFERENCES `juegos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_carrito_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `fk_compra_juego` FOREIGN KEY (`juego_id`) REFERENCES `juegos` (`id`),
  ADD CONSTRAINT `fk_compra_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `usuario_contacto`
--
ALTER TABLE `usuario_contacto`
  ADD CONSTRAINT `usuario_contacto_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_contacto_ibfk_2` FOREIGN KEY (`id_contacto`) REFERENCES `contacto` (`id_contacto`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
