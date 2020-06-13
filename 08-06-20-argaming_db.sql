-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-06-2020 a las 18:31:56
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `ARGAMING_DB` CHARACTER SET utf8mb4;
GRANT ALL PRIVILEGES ON argaming_db.* TO 'admin'@'localhost' IDENTIFIED BY '1234';
use `argaming_db`;
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `argaming_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `imagen_categoria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `texto` varchar(500) NOT NULL,
  `creado` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id_comentario`, `id_post`, `id_usuario`, `texto`, `creado`) VALUES
(1, 1, 6, 'Gracias por el aporte, me ha parecido una buena publicación para empezar!', '2020-05-30 12:49:32'),
(2, 1, 4, 'Genial, me ha encantado', '2020-05-30 16:14:45'),
(3, 2, 1, 'Bienvenidos, podéis dejar vuestros comentarios por aquí debajo una vez que estéis registrados! :D', '2020-05-31 15:17:48'),
(4, 2, 2, 'Yo acabo de registrarme. Ha sido rápido y fácil jeje', '2020-06-01 18:52:02'),
(6, 1, 1, 'Gracias a vosotros, porque este blog es por y para los fans de los videojuegos!', '2020-06-04 19:41:51'),
(7, 8, 12, 'Que mono el gato!', '2020-06-07 13:01:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pertenecen`
--

CREATE TABLE `pertenecen` (
  `id_post` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post`
--

CREATE TABLE `post` (
  `id_post` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `imagen_post` varchar(255) NOT NULL,
  `contenido` varchar(5000) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `creado` timestamp NOT NULL DEFAULT current_timestamp(),
  `modificado` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `visitas` varchar(255) NOT NULL DEFAULT '1',
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `post`
--

INSERT INTO `post` (`id_post`, `id_usuario`, `titulo`, `imagen_post`, `contenido`, `slug`, `creado`, `modificado`, `visitas`, `estado`) VALUES
(1, 1, 'Bienvenidos al blog ARGaming', 'img6.jpg', 'Hola a todos! Con este post arrancamos el nuevo blog especializado en videojuegos donde podréis encontrar desde los clásicos juegos de PC hasta las últimas novedades de PS4 o Xbox One S. Y mucho más!\r\n\r\nSi no quieres perderte nada también puedes seguirnos en redes sociales. Las encontrarás en la parte inferior de nuestra web. Gracias, esperamos verte a menudo por aquí!', 'primer-post', '2020-06-04 19:41:05', '2020-06-08 07:46:50', '16', 1),
(2, 1, 'Cómo unirse a nuestra nueva comunidad', 'img5.jpg', '¿Quieres unirte a nuestra comunidad? Pues es sencillo solo tendrás que registrarte (arriba a la derecha) dónde te pediremos lo datos básicos, nada raro, y tras recibir una confirmación en tu correo estarás dentro!\r\n\r\nDespués solo tienes que irte a Login ( el acceso ó Inicio de sesión que se encuentra arriba a la izquierda) y poner las credenciales (usuario y contraseña) con las que hayas creado la cuenta. Así de simple.\r\n\r\nUna vez te registres y loguees tendrás acceso a dos opciones extra, comentar cualquier post o crear un post de lo que prefieras. ¡¿A qué se supone que estás esperando?!', 'nuevos-usuarios-argaming', '2020-06-04 21:16:51', '2020-06-08 08:01:55', '14', 1),
(4, 11, 'Prueba, creado mi primer post desde formulario', 'images3.jpg', '\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"\r\n\r\n\"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?\"', 'post-de-prueba', '2020-06-04 21:07:28', '2020-06-08 07:33:03', '2', 1),
(8, 4, 'Mi post con foto', 'img2.jpg', '\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"\r\n\r\n\"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?\"', 'post-con-foto', '2020-06-04 21:29:03', '2020-06-08 07:44:53', '9', 1),
(11, 2, 'Final Fantasy VII: Remake', 'final-fantasy-vii-remake-portada.jpg', 'Nueva adaptación de la obra maestra del rol japonés. El remake del séptimo capítulo de la saga nos trasladará al mundo de la entrega original de PlayStation y PC, renovando sus gráficos para la consola PlayStation 4, añadiendo nuevos detalles la historia, así como aportando presumibles cambios jugables al sistema de batallas y de exploración. Este nuevo \'Final Fantasy VII\' tiene detrás al mismo equipo creativo del original.', 'final-fantasy-remake-7', '2020-06-08 06:31:25', '2020-06-08 07:53:13', '11', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `modificado` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` int(11) NOT NULL DEFAULT 1,
  `rol` int(11) NOT NULL DEFAULT 0,
  `imagen_perfil` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `username`, `nombre`, `apellidos`, `email`, `password`, `modificado`, `estado`, `rol`, `imagen_perfil`) VALUES
(1, 'anrogo', 'Antonio', 'Rodríguez González', 'anrogo@email.es', 'e10adc3949ba59abbe56e057f20f883e', '2020-06-04 21:44:38', 1, 1, 'anrogo.jpg'),
(2, 'arodriguez', 'Antonio', 'Rodríguez', 'arodriguez55@email.es', '25d55ad283aa400af464c76d713c07ad', '2020-06-03 16:24:06', 1, 0, 'arodriguez.png'),
(4, 'jorge_1', 'Jorge', 'García Torres', 'jorge-1@gmail.com', '25f9e794323b453885f5181f1b624d0b', '2020-06-02 17:59:02', 1, 0, 'jorge_1.png'),
(6, 'Federico_Ibañez', 'Federico', 'Ibañez', 'federico_ibaez@gmail.com', '25d55ad283aa400af464c76d713c07ad', '2020-05-31 09:36:33', 1, 0, 'federico_ibañez.png'),
(10, 'Destroyer', 'Alfredo', 'Martinez De los Cobos', 'alfre_destro@gmail.com', '25f9e794323b453885f5181f1b624d0b', '2020-06-07 11:44:55', 1, 0, 'destroyer.png'),
(11, 'anrogo2', 'Antonio', 'Rodriguez González', 'anrogo2@email.es', 'd41d8cd98f00b204e9800998ecf8427e', '2020-06-03 21:26:35', 1, 1, 'anrogo.jpg'),
(12, 'Naaraa', 'Arancha', 'Rodríguez González', 'arodriguezg55@gmail.es', 'e807f1fcf82d132f9bb018ca6738a19f', '2020-06-04 21:42:34', 1, 1, 'arancha.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `comentario_ibfk_1` (`id_post`),
  ADD KEY `comentario_ibfk_2` (`id_usuario`);

--
-- Indices de la tabla `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id_post`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `post_ibfk_1` (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `post`
--
ALTER TABLE `post`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`),
  ADD CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
