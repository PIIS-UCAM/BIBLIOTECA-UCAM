DROP USER IF EXISTS 'bibliotecario'@'localhost';

CREATE USER 'bibliotecario'@'localhost' IDENTIFIED BY '1234';

GRANT ALL PRIVILEGES ON *.* TO 'bibliotecario'@'localhost';

DROP DATABASE IF EXISTS biblioteca;

CREATE DATABASE biblioteca;

USE biblioteca;

CREATE TABLE `libros` (
  `id` int(11) NOT NULL,
  `Titulo` varchar(250) NOT NULL,
  `Autor` varchar(250) NOT NULL,
  `Editorial` varchar(250) NOT NULL,
  `Genero` varchar(250) NOT NULL,
  `Stock` int(3) NOT NULL,
  `Numero_paginas` varchar(1000) DEFAULT NULL,
  `ISBN` varchar(250) NOT NULL,
  `Reservado` tinyint(1) NOT NULL,
  `contador` int DEFAULT 0,
  `sumatorio` int DEFAULT 0,
  `media` dec(2,1) DEFAULT 0

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `libros`
--

INSERT INTO `libros` (`id`, `Titulo`, `Autor`, `Editorial`, `Genero`, `Stock`, `Numero_paginas`, `ISBN`, `Reservado`) VALUES (1, 'Harry Potter', 'JK Rowling', 'Anaya', 'Fantasía', 1, '434', '3243423 234', 0);
INSERT INTO `libros` (`id`, `Titulo`, `Autor`, `Editorial`, `Genero`, `Stock`, `Numero_paginas`, `ISBN`, `Reservado`) VALUES (2, 'El código Da Vinci', 'Dan Brown', 'Umbriel', 'Misterio', 4, '560', '3452678 564', 0);
INSERT INTO `libros` (`id`, `Titulo`, `Autor`, `Editorial`, `Genero`, `Stock`, `Numero_paginas`, `ISBN`, `Reservado`) VALUES (3, 'La Ilíada', 'Homero', 'Gredos', 'Clásicos', 2, '400', '9876543 210', 0);
INSERT INTO `libros` (`id`, `Titulo`, `Autor`, `Editorial`, `Genero`, `Stock`, `Numero_paginas`, `ISBN`, `Reservado`) VALUES (4, '1984', 'George Orwell', 'Penguin Books', 'Ciencia Ficción', 3, '328', '5638210 928', 1);
INSERT INTO `libros` (`id`, `Titulo`, `Autor`, `Editorial`, `Genero`, `Stock`, `Numero_paginas`, `ISBN`, `Reservado`) VALUES (5, 'El gran Gatsby', 'F. Scott Fitzgerald', 'DeBolsillo', 'Ficción Literaria', 2, '240', '7689023 341', 0);
INSERT INTO `libros` (`id`, `Titulo`, `Autor`, `Editorial`, `Genero`, `Stock`, `Numero_paginas`, `ISBN`, `Reservado`) VALUES (6, 'Cien años de soledad', 'Gabriel García Márquez', 'Círculo de Lectores', 'Realismo Mágico', 5, '440', '6782301 234', 2);
INSERT INTO `libros` (`id`, `Titulo`, `Autor`, `Editorial`, `Genero`, `Stock`, `Numero_paginas`, `ISBN`, `Reservado`) VALUES (7, 'El principito', 'Antoine de Saint-Exupéry', 'Salamandra', 'Fábula', 3, '96', '4567231 809', 1);
INSERT INTO `libros` (`id`, `Titulo`, `Autor`, `Editorial`, `Genero`, `Stock`, `Numero_paginas`, `ISBN`, `Reservado`) VALUES (8, 'Matar a un ruiseñor', 'Harper Lee', 'Vintage Books', 'Ficción Legal', 2, '376', '1230987 654', 0);


-- --------------------------------------------------------

--
-- Table structure for table `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `id_libro` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_reserva` datetime NOT NULL,
  `fecha_devolucion` datetime NOT NULL,
  `valoracion` int,
  `comentario` varchar(1000)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservas`
--



-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `Nombre` varchar(250) NOT NULL,
  `DNI` varchar(250) NOT NULL,
  `Apellidos` varchar(250) NOT NULL,
  `Permisos` tinyint(1) NOT NULL,
  `Fecha_de_nacimiento` DATE NOT NULL,
  `Email` varchar(250) NOT NULL,
  `Contrasenia` varchar(250) NOT NULL,
  `Fecha_de_expedicion` DATETIME NOT NULL,
  `Fecha_de_validez` DATETIME NOT NULL,
  `Foto_de_carnet` MEDIUMBLOB NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `Nombre`, `DNI`, `Apellidos`, `Permisos`, `Fecha_de_nacimiento`, `Email`, `Contrasenia`) VALUES (1, 'Pepe', '3452345234F', 'Vazquez Ortiz', 0, '1998-04-23', 'pepe@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055');
INSERT INTO `usuarios` (`id`, `Nombre`, `DNI`, `Apellidos`, `Permisos`, `Fecha_de_nacimiento`, `Email`, `Contrasenia`) VALUES (2, 'Laura', '2453423114K', 'Garcia Gomez', 1, '1995-06-15', 'laura@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055');
INSERT INTO `usuarios` (`id`, `Nombre`, `DNI`, `Apellidos`, `Permisos`, `Fecha_de_nacimiento`, `Email`, `Contrasenia`) VALUES (3, 'Carlos', '4534252356P', 'Sanchez Ruiz', 0, '2000-11-03', 'carlos@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055');
INSERT INTO `usuarios` (`id`, `Nombre`, `DNI`, `Apellidos`, `Permisos`, `Fecha_de_nacimiento`, `Email`, `Contrasenia`) VALUES (4, 'Ana', '2323423123H', 'Lopez Martinez', 1, '1992-02-28', 'ana@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055');
INSERT INTO `usuarios` (`id`, `Nombre`, `DNI`, `Apellidos`, `Permisos`, `Fecha_de_nacimiento`, `Email`, `Contrasenia`) VALUES (5, 'David', '3452345121L', 'Gonzalez Castro', 0, '1999-09-17', 'david@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055');
INSERT INTO `usuarios` (`id`, `Nombre`, `DNI`, `Apellidos`, `Permisos`, `Fecha_de_nacimiento`, `Email`, `Contrasenia`) VALUES (6, 'Sara', '3652342333E', 'Jimenez Alvarez', 1, '1997-07-22', 'sara@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055');
INSERT INTO `usuarios` (`id`, `Nombre`, `DNI`, `Apellidos`, `Permisos`, `Fecha_de_nacimiento`, `Email`, `Contrasenia`) VALUES (7, 'Adrian', '1423423677M', 'Perez Dominguez', 0, '1996-12-09', 'adrian@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_reservas_libros` (`id_libro`),
  ADD KEY `fk_reservas_usuarios` (`id_usuario`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `libros`
--
ALTER TABLE `libros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `fk_reservas_libros` FOREIGN KEY (`id_libro`) REFERENCES `libros` (`id`),
  ADD CONSTRAINT `fk_reservas_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);
COMMIT;
