<?php

	include('conexion.php');
	error_reporting(E_ALL ^ E_NOTICE);

    $add = $_POST['add'];
	$remove = $_POST['remove'];
	$titulo = $_POST['titulo'];
	$autor = $_POST['autor'];
	$genero = $_POST['genero'];
	$editorial = $_POST['editorial'];
	$numpags = $_POST['numpags'];
    $stock = $_POST['stock'];
	$isbn1 = $_POST['isbn1'];
	$isbn2 = $_POST['isbn2'];

	$connect->query("SET NAMES utf8");

	if (isset($add)) {
		$consulta = mysqli_query($connect, "INSERT INTO libro (id, titulo, autor, genero, editorial, numero_paginas, stock, isbn) VALUES ('', '$titulo', '$autor', '$genero', '$editorial', '$numpags', '$stock', '$isbn1')");
        header('location: admin.php');
	} else {}

	if (isset($remove)) {
		$consulta = mysqli_query($connect, "DELETE FROM libro WHERE isbn='$isbn2'");
        header('location: admin.php');
	} else {}
?>