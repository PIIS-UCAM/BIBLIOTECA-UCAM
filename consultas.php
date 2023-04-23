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
	$id_usuario_borrar = $_POST['id_usuario_borrar'];

	$id_usuario = $_POST['id_usuario'];
	$id_libro = $_POST['id_libro'];
	$fecha_reserva = date('d/m/Y H:i:s');
	$fecha_devolucion = date('d/m/Y H:i:s', strtotime("+15 days"));

	$fecha_expedicion_carnet = date("Y-m-d H:i:s");
	$fecha_validez_carnet = date("Y-m-d H:i:s", strtotime("+365 days"));

	$id_baja = $_POST['id_baja'];
	
	$connect->query("SET NAMES utf8");

	if (isset($addLibro)) {
		$consulta = mysqli_query($connect, "INSERT INTO libros (id, titulo, autor, genero, editorial, numero_paginas, stock, isbn) VALUES ('', '$titulo', '$autor', '$genero', '$editorial', '$numpags', '$stock', '$isbn1')");
        echo "<script type='text/javascript'>alert('Libro añadido 😉👍');</script>";
		header('location: libros.php');
	}

	else if (isset($removeLibro)) {
		$consulta = mysqli_query($connect, "DELETE FROM libros WHERE isbn='$isbnOid' OR id='$isbnOid'");
		echo "<script type='text/javascript'>alert('Libro eliminado 😉👍');</script>";
        header('location: libros.php');
	}

	else if (isset($addUsuario)){
		
		if(empty($permisos)){
			$permisos = 0;
		} else {
			$permisos = 1;
		}
		$fotoSubida = fopen($_FILES['fotoCarnet']['tmp_name'], 'r');
		$binariosFoto = fread($fotoSubida, $_FILES['fotoCarnet']['size']);
		$binariosFoto = mysqli_escape_string($connect, $binariosFoto);
		$consulta = mysqli_query($connect, "INSERT INTO usuarios (id, nombre, apellidos, dni, fecha_de_nacimiento, permisos, email, contrasenia, Fecha_de_expedicion, Fecha_de_validez, Foto_de_carnet) VALUES ('', '$nombreUsuario', '$apellidosUsuario', '$dni', '$fecha_de_nacimiento', '$permisos', '$email', '$contrasenia', '$fecha_expedicion_carnet', '$fecha_validez_carnet', '$binariosFoto')");
		echo "<script type='text/javascript'>alert('Usuario añadido 😉👍');</script>";
		header('location: usuarios.php');
	}

	else if (isset($removeUsuario)) {
		$consulta = mysqli_query($connect, "SELECT COUNT(*) as cantidad_reservas FROM reservas WHERE id_usuario = $id_usuario_borrar");
		$comprobar_consulta= mysqli_fetch_array($consulta);  
		
		if ($comprobar_consulta[0] > 0) {
			echo '<script>alert("El usuario no se puede eliminar. Tiene libros pendientes de devolver.")</script>';
		} else {

			$consulta = mysqli_query($connect, "SELECT * FROM usuarios WHERE id = $id_usuario_borrar");
			$comprobar_consulta= mysqli_fetch_array($consulta);
			
			if(isset($comprobar_consulta[0])){
				$consulta = mysqli_query($connect, "DELETE FROM usuarios WHERE id = $id_usuario_borrar");
				echo "<script>alert('Usuario eliminado 😉👍');</script>";
			}
			else{
				echo "<script>alert('Usuario inexistente');</script>";
			}
		}
		echo "<script>window.location = 'usuarios.php';</script>";
	}

	else if (isset($id_baja)) {

		$consulta = mysqli_query($connect, "SELECT COUNT(*) as cantidad_reservas FROM reservas WHERE id_usuario = $id_baja");
		$comprobar_consulta= mysqli_fetch_array($consulta);  
		
		if ($comprobar_consulta[0] > 0) {
			echo '<script>alert("El usuario no se puede eliminar. Tiene libros pendientes de devolver.")</script>';
			echo "<script>window.location = 'biblioteca.php';</script>";
		} else {
			$consulta = mysqli_query($connect, "SELECT Email FROM usuarios WHERE id = $id_baja");
			$comprobar_consulta = mysqli_fetch_array($consulta);

			if(isset($comprobar_consulta[0])){
				$consulta = mysqli_query($connect, "DELETE FROM usuarios WHERE id='$id_baja'");
				$mensaje = "Su usuario ha sido dado de baja correctamente 😉👍¡Esperamos volver a verle en el futuro!👋";
				echo "<script>alert('$mensaje');</script>";
			}
		}
		echo "<script>window.location = 'index.php';</script>";
	}

	else if (isset($id_usuario) && isset($id_libro)) {
		$consulta = mysqli_query($connect, "SELECT COUNT(*) as cantidad_reservas FROM reservas  WHERE id_libro = $id_libro AND id_usuario = $id_usuario");
		$comprobar_consulta= mysqli_fetch_array($consulta);  
		if ($comprobar_consulta[0] > 0) {
			echo '<script>alert("Ya tiene una reserva de un ejemplar de este libro.")</script>';
		} else {
			$consulta = mysqli_query($connect, "INSERT INTO reservas (id, id_libro, id_usuario, fecha_reserva, fecha_devolucion) VALUES ('', '$id_libro', '$id_usuario', '$fecha_reserva', '$fecha_devolucion')");
			$consulta = mysqli_query($connect, "UPDATE libros SET stock = stock-1 WHERE stock >= 1 AND id= '$id_libro'");
			$consulta = mysqli_query($connect, "UPDATE libros SET reservado = true WHERE stock = 0 AND id= '$id_libro'");
			echo '<script>alert("Reserva realizada 😉👍")</script>';
		}
		echo "<script>window.location = 'biblioteca.php';</script>";
	}
	else {
	}

?>