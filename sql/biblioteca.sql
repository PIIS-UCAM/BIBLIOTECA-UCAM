DROP DATABASE IF EXISTS biblioteca;

    CREATE DATABASE biblioteca;

USE biblioteca;


CREATE TABLE Libro (

    id INT (11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    Titulo Varchar (250) NOT NULL,
    Autor Varchar (250) NOT NULL,
    Editorial Varchar (250) NOT NULL,
    Genero Varchar (250) NOT NULL,
    Stock INT (3) NOT NULL,
    Numero_paginas Varchar (1000),
    ISBN Varchar (250) NOT NULL
); 
 

CREATE TABLE Usuario(
 
    id INT (11) PRIMARY KEY AUTO_INCREMENT NOT NULL, 
    Nombre Varchar (250) NOT NULL,
    DNI Varchar (250) NOT NULL,
    Apellidos Varchar(250) NOT NULL,
    Permisos Boolean NOT NULL,
    Fecha_de_nacimiento Varchar (250) NOT NULL,
    Email Varchar (250) NOT NULL,
Contrasenia Varchar (250) NOT NULL
);     