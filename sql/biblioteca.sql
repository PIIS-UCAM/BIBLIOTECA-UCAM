DROP USER IF EXISTS 'bibliotecario'@'localhost';

CREATE USER 'bibliotecario'@'localhost' IDENTIFIED BY '1234';

GRANT ALL PRIVILEGES ON *.* TO 'bibliotecario'@'localhost';

DROP DATABASE IF EXISTS biblioteca;

CREATE DATABASE biblioteca;

USE biblioteca;


CREATE TABLE Libros(

    id INT (11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    Titulo Varchar (250) NOT NULL,
    Autor Varchar (250) NOT NULL,
    Editorial Varchar (250) NOT NULL, 
    Genero Varchar (250) NOT NULL,
    Stock INT (3) NOT NULL,
    Numero_paginas Varchar (1000),
    ISBN Varchar (250) NOT NULL,
    Reservado Boolean NOT NULL
);  
 
CREATE TABLE Usuarios(
 
    id INT (11) PRIMARY KEY AUTO_INCREMENT NOT NULL, 
    Nombre Varchar (250) NOT NULL,
    DNI Varchar (250) NOT NULL,
    Apellidos Varchar(250) NOT NULL,
    Permisos Boolean NOT NULL,
    Fecha_de_nacimiento DATE NOT NULL,
    Email Varchar (250) NOT NULL,
    Contrasenia Varchar (250) NOT NULL,
    Fecha_de_expedicion DATETIME NOT NULL,
    Fecha_de_validez DATETIME NOT NULL
);      

CREATE TABLE Reservas(
 
    id INT (11) PRIMARY KEY AUTO_INCREMENT NOT NULL, 
    id_libro INT(11) NOT NULL,
    id_usuario INT(11) NOT NULL, 
    fecha_reserva DATETIME NOT NULL,
    fecha_devolucion DATETIME NOT NULL,
    CONSTRAINT fk_reservas_libros
    FOREIGN KEY (id_libro) 
    REFERENCES libros(id),
    CONSTRAINT fk_reservas_usuarios
    FOREIGN KEY (id_usuario) 
    REFERENCES usuarios(id)

);