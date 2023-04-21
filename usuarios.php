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
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f2f2f2;
            }

            h1 {
                color: #002856;
                font-size: 36px;
                margin-bottom: 20px;
				margin-left: 20px;
            }

            footer {
                background-color: #002856;
                padding: 20px;
                text-align: center;
                color: #fff;
                font-size: 16px;
                position: absolute;
                bottom: 0;
                width: 100%;
            }

			#pagUsuarios {
				background-color: #E2A300;
			}

			.boton_alta {
				text-decoration: none;
				font-weight: bold;
				font-size: 15px;
				color: white;
				padding: 5px 30px;
				background-color: #002856;
				border: 2px solid #002856;
				border-radius: 5px;
				cursor: pointer;
			}

			.boton_alta:hover {
				background-color: #004691;
				border-color: #004691;
			}

			.boton_baja {
				text-decoration: none;
				font-weight: bold;
				font-size: 15px;
				color: white;
				padding: 5px 30px;
				background-color: #E21B1B;
				border: 2px solid #E21B1B;
				border-radius: 5px;
				cursor: pointer;
			}

			.boton_baja:hover {
				background-color: #FF2E2E;
				border-color: #FF2E2E;
			}

            table {
                border-collapse: collapse;
                width: 100%;
                background-color: #fff;
                margin-bottom: 50px;
            }

            th, td {
                padding: 8px;
                text-align: center;
                border: 1px solid #ccc;
            }

            th {
                background-color: #002856;
                color: white;
                font-weight: bold;
            }

            tbody tr:nth-child(odd) {
                background-color: #f2f2f2;
            }

            .form-container {
                margin-left: 20px;
            }

            input[type="text"], input[type="date"], input[type="email"] {
                margin-bottom: 10px;
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
            <footer>
                &copy; 2023 Biblioteca UCAM. Todos los derechos reservados.
            </footer>
	</body>
</html>
