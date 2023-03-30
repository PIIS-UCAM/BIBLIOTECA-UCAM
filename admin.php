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
 
<nav class="menu"> 
  <ul>
    <li><a href="acceso.php">Acceso</a></li>
    <li><a href="index.php">Index</a></li>
    <li><a href="libros.php">Libros</a></li>
	<li><a href="usuarios.php">Usuarios</a></li>
	<li><a href="AltayBajaUsuario.php">Alta/Baja Usuarios</a></li>
  </ul>
  </ul>
</nav>


 
</body>

</html> 