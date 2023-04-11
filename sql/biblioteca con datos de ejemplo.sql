-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2023 at 06:49 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `biblioteca`
--

-- --------------------------------------------------------

--
-- Table structure for table `libros`
--

CREATE TABLE `libros` (
  `id` int(11) NOT NULL,
  `Titulo` varchar(250) NOT NULL,
  `Autor` varchar(250) NOT NULL,
  `Editorial` varchar(250) NOT NULL,
  `Genero` varchar(250) NOT NULL,
  `Stock` int(3) NOT NULL,
  `Numero_paginas` varchar(1000) DEFAULT NULL,
  `ISBN` varchar(250) NOT NULL,
  `Reservado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `libros`
--

INSERT INTO `libros` (`id`, `Titulo`, `Autor`, `Editorial`, `Genero`, `Stock`, `Numero_paginas`, `ISBN`, `Reservado`) VALUES
(1, 'Harry Potter', 'JK Rowling', 'Anaya', 'Fantasía', 1, '434', '3243423 234', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `id_libro` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_reserva` datetime NOT NULL,
  `fecha_devolucion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservas`
--

INSERT INTO `reservas` (`id`, `id_libro`, `id_usuario`, `fecha_reserva`, `fecha_devolucion`) VALUES
(1, 1, 1, '2023-04-11 18:49:27', '2023-04-26 18:49:27');

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
  `Fecha_de_nacimiento` varchar(250) NOT NULL,
  `Email` varchar(250) NOT NULL,
  `Contrasenia` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `Nombre`, `DNI`, `Apellidos`, `Permisos`, `Fecha_de_nacimiento`, `Email`, `Contrasenia`) VALUES
(1, 'Pepe', '3452345234F', 'Vazquez', 0, '1998-04-23', 'asdf@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055');

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
