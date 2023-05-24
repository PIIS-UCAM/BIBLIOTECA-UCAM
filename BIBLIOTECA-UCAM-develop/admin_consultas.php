<?php

	include('conexion.php');
	error_reporting(E_ALL ^ E_NOTICE);

    $addLibro = $_POST['addLibro'];
	$removeLibro = $_POST['removeLibro'];
	$titulo = $_POST['titulo'];
	$autor = $_POST['autor'];
	$genero = $_POST['genero'];
	$editorial = $_POST['editorial'];
	$numpags = $_POST['numpags'];
    $stock = $_POST['stock'];
	$isbn1 = $_POST['isbn'];
	$isbnOid = $_POST['isbnOid'];

	$addUsuario = $_POST['addUsuario'];
	$removeUsuario = $_POST['removeUsuario'];
	$nombreUsuario = $_POST['nombreUsuario'];
	$apellidosUsuario = $_POST['apellidosUsuario'];
	$dni = $_POST['dni'];
	$fecha_de_nacimiento = $_POST['fecha_de_nacimiento'];
	$email = $_POST['email'];
	$contrasenia = md5($_POST['contrasenia']);
	$permisos = $_POST['checkBoxPermisos'];
	$dniOid = $_POST['dniOid'];

	
	$connect->query("SET NAMES utf8");

	if (isset($addLibro)) {
		$consulta = mysqli_query($connect, "INSERT INTO libro (id, titulo, autor, genero, editorial, numero_paginas, stock, isbn) VALUES ('', '$titulo', '$autor', '$genero', '$editorial', '$numpags', '$stock', '$isbn1')");
        echo "<script type='text/javascript'>alert('Libro añadido 😉👍');</script>";
		header('location: libros.php');
	}
	else if (isset($removeLibro)) {
		$consulta = mysqli_query($connect, "DELETE FROM libro WHERE isbn='$isbnOid' OR id='$isbnOid'");
		echo "<script type='text/javascript'>alert('Libro eliminado 😉👍');</script>";
        header('location: libros.php');
	}
	else if (isset($addUsuario)){
		
		if(empty($permisos)){
			$permisos = 0;
		} else {
			$permisos = 1;
		}

		$consulta = mysqli_query($connect, "INSERT INTO usuario (id, nombre, apellidos, dni, fecha_de_nacimiento, permisos, email, contrasenia) VALUES ('', '$nombreUsuario', '$apellidosUsuario', '$dni', '$fecha_de_nacimiento', '$permisos', '$email', '$contrasenia')");
        echo "<script type='text/javascript'>alert('Usuario añadido 😉👍');</script>";
		header('location: usuarios.php');
	}
	else if (isset($removeUsuario)) {
		$consulta = mysqli_query($connect, "DELETE FROM usuario WHERE dni='$dniOid' OR id=$dniOid");
		echo "<script type='text/javascript'>alert('Usuario eliminado 😉👍');</script>";
        header('location: usuarios.php');
	}
	else {}

?>