<?php
    include('conexion.php');
    include('admin.php');
    include('consultas.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Usuarios</title>
		<style type="text/css">
			#pagUsuarios {
				background-color: #E2A300;
			}

			.boton_alta{
				text-decoration: none;
				font-weight: 10px;
				font-size: 15px;
				color: white;
				padding-top: 5px;
				padding-bottom: 5px;
				padding-left: 30px;
				padding-right: 30px;
				background-color: #52595D;
				border: 3px solid black;
			} 

			.boton_baja{
				text-decoration: none;
				font-weight: 10px;
				font-size: 15px;
				color: white;
				padding-bottom: 5px;
				padding-top: 5px;
				padding-left: 30px; 
				padding-right: 30px;
				background-color: #e2a300;
				border: 3px solid black; 
			}
 
		</style>
	</head>
	<body>
		<!--Usuarios-->
		<div style="clear: both; padding-top: 10px">
			<h1>Usuarios:</h1>	
			<form name="form" action="consultas.php" method="POST">
				<input required type="text" name="nombreUsuario" placeholder="Nombre"><br>
				<input required type="text" name="apellidosUsuario" placeholder="Apellido"><br>
				<input required type="text" name="dni" placeholder="DNI"><br>
				<input required type="date" name="fecha_de_nacimiento" placeholder="Fecha de nacimiento"><br>
				<input required type="email" name="email" placeholder="Correo"><br>
				<input required type="text" name="contrasenia" placeholder="Contraseña"><br>
				<p>Conceder permisos de administrador/bibliotecario: <input type="checkbox" name="checkBoxPermisos"></p>
				<input type="submit" name="addUsuario" class="boton_alta" value="Alta" onclick="add()"><br><br>
			</form>
			<form name="form" action="consultas.php" method="POST">
				<input required type="text" name="dniOid" placeholder="DNI o ID del usuario">
				<input type="submit" id="baja" name="removeUsuario" class="boton_baja" value="Eliminar">
			</form>
			<?php
				$sql = "SELECT id, Nombre, Apellidos, DNI, Fecha_de_nacimiento, Permisos, Email, Contrasenia FROM Usuarios";
				$resultado = $connect->query($sql) or die(mysqli_error($connect)); 
			?>
			<br>
				<table border="1px solid black" cellspacing="0">
					<thead style="background-color: #1B7CC7;"> 
						<th>Id</th>
						<th>Nombre</th>
						<th>Apellidos</th>
						<th>DNI</th> 
						<th>Fecha de nacimiento</th>
						<th>Permisos</th>
						<th>Email</th>
						<th>Contraseña</th>
					</thead>
					<tbody>
					<?php
						if (mysqli_num_rows($resultado)>0) {
							while($valor = mysqli_fetch_assoc($resultado)) {

								if($valor["Permisos"] == '1'){
									$valor["Permisos"] = 'Bibliotecario';
								} else
								{
									$valor["Permisos"] = 'Cliente';
								}

									echo "<tr><td align='center'>".$valor["id"]. "</td><td align='center'>" .$valor["Nombre"]. "</td><td align='center'>".$valor["Apellidos"]."</td><td align='center'>" .$valor["DNI"]."</td><td align='center'>" .$valor["Fecha_de_nacimiento"]."</td><td align='center'>" .$valor["Permisos"]."</td><td align='center'>" .$valor["Email"]. "</td><td align='center'>" .$valor["Contrasenia"]."</td></tr>";
							}
						} else {
							echo "<tr><td colspan='8' align='center'>0 resultados</td></tr>";
						}
					?>
					</tbody>
				</table>
			</div>

	</body>
</html> 