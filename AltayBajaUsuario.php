<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
		<meta charset="utf-8"/> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Alta/Baja Usuario</title>
		<link rel="stylesheet" type="text/css" href="css/estilos.css"/> 
		<script src="js/jquery-3.6.4.min.js"></script>
	</head> 

	<body style="background-color: antiquewhite;">  

	<div  style="clear: both; padding-top: 10px">
	<div>
			<form style="justify-content: center" name="form" action="admin_consultas.php" method="POST">
				<h1>Usuarios:</h1>	
				<input type="text" name="nombreUsuario" placeholder="Nombre"><br>
				<input type="text" name="apellidosUsuario" placeholder="Apellido"><br>
				<input type="text" name="dni" placeholder="DNI"><br>
				<input type="date" name="fecha_de_nacimiento" placeholder="Fecha de nacimiento"><br>
				<input type="text" name="email" placeholder="Correo"><br>
				<input type="text" name="contrasenia" placeholder="Contraseña"><br>
				<p>Conceder permisos de administrador/bibliotecario: <input type="checkbox" name="permisos"></p>
				<input type="submit" name="alta" value="Alta" onclick="add()"><br><br>
				<input type="text" name="dniOid" placeholder="DNI o ID del usuario">
				<input type="submit" name="remove" style="background-color: red;" value="Eliminar" onclick="remove()">

			</form> 

			<?php
				$sql = "SELECT id, Nombre, Apellido, DNI, Fecha_de_nacimiento, permisos, Email, Contrasenia FROM Usuario";
				$resultado = $connect->query($sql) or die(mysqli_error($connect)); 
			?> 
				<br>
				<table border="1px solid black" cellspacing="0">
					<thead style="background-color: #4d8cf2;">
						<th>Id</th>
						<th>Nombre</th> 
						<th>Apellidos</th>
						<th>DNI</th>
						<th>Fecha de Nacimiento</th> 
						<th>Email</th>
						<th>Contraseña</th>
					</thead>
					<tbody>
					<?php
				if (mysqli_num_rows($resultado)>0) {
					while($valor = mysqli_fetch_assoc($resultado)) {
						echo "<tr><td align='center'>".$valor["id"]. "</td><td align='center'>" .$valor["nombreUsuario"]. "</td><td align='center'>".$valor["apellidosUsuario"]."</td><td align='center'>" .$valor["dni"]."</td><td align='center'>" .$valor["fecha_de_nacimiento"]."</td><td align='center'>" .$valor["permisos"]."</td><td align='center'>" .$valor["email"]. "</td><td align='center'>" .$valor["contrasenia"]."</td></tr>";
					}
				} else {
					echo "<tr><td colspan='8' align='center'>0 resultados</td></tr>";
				}
			?>
					</tbody>
				</table>
		</div>
		
		<script type="text/javascript">
			function showHidePass(){
				var pass = document.getElementById("pass");
				var checkpass = document.getElementById("checkpass");

				if (checkpass.checked){
					pass.setAttribute("type", "text");
				} else {
					pass.setAttribute("type", "password");
				}
			}

			function add(){
				alert('Añadido 😉👍');
			} 

			function remove(){
				alert('Eliminado 😉👍');
			}
		</script>

	</body>

</html> 