<?php
	include('conexion.php');
	echo "<div style='float: left'>Volver a la página principal:<br><br><br><br>  <a href='' onclick='javascript:window.history.back(-1); return false;'><img class='option' src='rsc/imgs/casa.png' /></a></div>";
?>


<html class="photo">
<head>
	
	<title>Welcome👨‍💻</title>
<style>

.photo{
	background-image: url('rsc/imgs/bibliotecaucam.png');
	background-repeat: no-repeat;
	background-position-x: center;
	background-position-y: center;
	background-size: 50rem;
	background-color: FFE633;
}


</style>


</head>

<body>

<a href="libros.php"><button >Libros UCAM</button></a> <br><br>
<a href="usuarios.php"><button>Usuarios UCAM</button></a>


</body>

</html> 