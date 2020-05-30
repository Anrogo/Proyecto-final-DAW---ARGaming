-- Creación de usuario administrador de BBDD:
--CREATE USER 'admin'@'localhost' IDENTIFIED BY '1234';

-- Creación de la base de datos
CREATE DATABASE IF NOT EXISTS `ARGAMING_DB` CHARACTER SET utf8mb4_general_ci;
GRANT ALL PRIVILEGES ON argaming_db.* TO 'admin'@'localhost' IDENTIFIED BY '1234';


/*
Pasar de una codificación de caracteres a otra

ALTER DATABASE database_name
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

*/
-- Seleccionamos la base de datos
USE `ARGAMING_DB`;


-- Tabla de usuarios
create table usuarios (
    id_usuario int not null auto_increment primary key,
    username varchar(255) not null,
    nombre varchar(255) not null,
    apellidos varchar(255) not null,
    email varchar(255) not null unique,
    password varchar(255),
    creado TIMESTAMP not null DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    estado int not null default 1,
    rol int not null default 0,
    imagen_perfil varchar(255) not null
);

-- Tabla de posts
create table post (
    id_post int not null auto_increment primary key,
    id_usuario int not null,
    titulo varchar(255) not null,
    imagen_post varchar(255) not null,
    contenido varchar(255) not null,
    slug varchar(255) not null unique,
    creado TIMESTAMP not null DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    modificado TIMESTAMP not null DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    visitas varchar(255) not null,
    estado int not null default 1
);

-- Tabla de categorías
create table categorias (
    id_categoria int not null auto_increment primary key,
    nombre varchar(255) not null,
    descripcion varchar(255) not null,
    slug varchar(255) not null,
    imagen_categoria varchar(255) not null
);

-- Tabla de comentarios
create table comentarios (
    id_comentario int not null auto_increment primary key,
    id_post int not null,
    id_usuario int not null,
    texto varchar(255) not null,
    creado TIMESTAMP not null DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabla de pertenencia (post-categorías)
create table pertenecen (
    id_post int not null,
    id_categoria int not null
);

-- Claves foráneas

ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`);
COMMIT;

ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

-- Registros tabla de usuarios
INSERT INTO `usuarios` (`id_usuario`, `username`, `nombre`, `apellidos`, `email`, `password`, `fecha_creado`, `estado`, `rol`, `imagen`) 
VALUES 
(NULL, 'anrogo', 'Antonio', 'Rodríguez González', 'anrogo@email.es', MD5('123456'), current_timestamp(), '1', '1', ''),
(NULL, 'arodriguez', 'Antonio', 'R G', 'arodriguez@email.es', MD5('123456'), current_timestamp(), '1', '0', '')

-- Registros tabla de post
INSERT INTO `post` (`id_post`, `id_usuario`, `titulo`, `imagen_post`, `contenido`, `slug`, `creado`, `modificado`, `visitas`, `estado`) 
VALUES 
(NULL, '2', 'Bienvenidos al blog ARGaming', 'img6.jpg', 'Hola a todos! Con este post arrancamos el nuevo blog especializado en videojuegos donde podréis encontrar desde los clásicos juegos de PC hasta las últimas novedades de PS4 o Xbox One S. Y mucho más!', 'primer-post-del-blog', current_timestamp(), current_timestamp(), '', '1'); 

-- Registros tabla de comentarios
INSERT INTO `comentarios` (`id_comentario`, `id_post`, `id_usuario`, `texto`, `creado`) 
VALUES
(NULL, '1', '4', 'Genial, me ha encantado', current_timestamp()),
(NULL, '1', '6', 'Gracias por el aporte, me ha parecido una buena publicación para empezar!', current_timestamp())