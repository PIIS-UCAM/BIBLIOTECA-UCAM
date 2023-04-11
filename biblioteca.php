<?php
	include('conexion.php');
	include('consultas.php');
	session_start();
	// echo "<div style='float: left'>Volver a la página principal:<br><br><br><br>  <a href='' onclick='javascript:window.history.back(-1); return false;'><img class='option' src='rsc/imgs/casa.png' /></a></div>";
?>

<html>
	<head>
		
		<title>¡Bienvenido, <?php echo $_SESSION['usuario']; ?>!</title>
		<link rel="stylesheet" href="css/styles.css">
		<style>

			header{
				height: auto;
			}

			.photo{
				background-image: url('rsc/imgs/bibliotecaucam.png');
				background-repeat: no-repeat;
				background-position-x: center;
				background-position-y: center;   
				background-size: 50rem;
				background-color: #e2a300;
			}

			.menu ul{
				list-style-type: none;
				margin: 0;
				padding: 0;
				overflow: hidden;
				background-color: #002664;
			}

			.menu li {
				float: left;
			}

			.menu li a {
				display: block;
				color: white;
				text-align: center;
				padding: 14px 16px;
				text-decoration: none;
			}

			.menu li a:hover:not(.active) {
				background-color: #e2a300;
			}

			.btn_buscar{
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
             
            .gradient{
                background-image: linear-gradient(to right, rgba(27, 124, 199), rgba(226, 163, 0));
            }

			.menu ul{
				list-style-type: none;
				margin: 0;
				padding: 0;
				overflow: hidden;
				background-color: #002664;
			}

			.menu li {
				float: left;
			}

			.menu li a {
				display: block;
				color: white;
				text-align: center;
				padding: 14px 16px;
				text-decoration: none;
			}

			.menu li a:hover:not(.active) {
				background-color: #e2a300;
			} 

		</style> 
		
	</head>

	<body>
		<header>
			
			<div class="logo">
				<img src="rsc/imgs/logo.png">
			</div>
			<input type="checkbox" id="nav_check" hidden>
			<nav>
				<div class="logo">
				<img src="rsc/imgs/logo.png" alt="">
				</div>
				<div> 
				<ul>
					<li>
						<a href="index.php">Página de inicio</a>
					</li>
					<li>
						<a href="" class="active">Perfil de <?php echo $_SESSION['usuario']; ?></a>
					</li>
					<li>
						<a href="">Reserved</a>
					</li>
					<li>
						<form name="form" id="formularioBaja" action="consultas.php" method="POST">
							<input style="display: none;" type="text" name="id_baja" value="<?php echo $_SESSION['id_usuario']?>">
							<a id="btnBaja" name="bajaUsuario" href="javascript:{}" onclick="document.getElementById('formularioBaja').submit();">Darse de baja</a>
						</form>
					</li>
				</ul>
				</div>
			</nav>
			<label for="nav_check" class="hamburger">
				<div></div>
				<div></div>
				<div></div>
			</label>
		</header>

		<div>       
			<h3>Busqueda de Libros</h3>

			<form name="form" action="" method="POST">
			Búsqueda de libro : <input type="search" name="busquedalibro" size="30" maxlength="20" placeholder="Escriba el título del libro a buscar"> 
				<input type="submit" class="btn_buscar" value="Buscar">
			</form>
		</div> 

		<?php
			$busquedalibro = $_POST["busquedalibro"]; 
			if(isset($busquedalibro))
				$sql = "SELECT id, titulo, autor, genero, editorial, numero_paginas, stock, ISBN FROM libros WHERE reservado = false AND titulo LIKE '%$busquedalibro%'";
			else
				$sql = "SELECT id, titulo, autor, genero, editorial, numero_paginas, stock, ISBN FROM libros WHERE reservado = false";
			
			$resultado = $connect->query($sql) or die(mysqli_error($connect));
		?> 
			<br>
				<table border="1px solid black" cellspacing="0">
					<thead style="background-color: #4d8cf2;">
						<th>Id</th>
						<th>Título</th>
						<th>Autor</th> 
						<th>Género</th>
						<th>Editorial</th> 
						<th>Número de páginas</th>
						<th>ISBN</th>
						<th>Stock</th>
						<th>Reservar</th>
					</thead> 
					<tbody>
			<?php
				if (mysqli_num_rows($resultado)>0) {
					while($valor = mysqli_fetch_assoc($resultado)) {
						echo "<form id='formularioReserva' action='consultas.php' method='POST'>
						<input type='text' style='display: none;' name='id_usuario' value='".$_SESSION['id_usuario']."' />
						<input type='text' style='display: none;' name='id_libro' value='".$valor["id"]."' />
						<tr><td align='center'>".$valor["id"]. "</td><td align='center'>" .$valor["titulo"]. "</td><td align='center'>".$valor["autor"]."</td><td align='center'>" .$valor["genero"]. "</td><td align='center'>" .$valor["editorial"]."</td><td align='center'>" .$valor["numero_paginas"]. "</td><td align='center'>" .$valor["ISBN"]."</td><td align='center'>" .$valor["stock"]. "</td><td align='center'>
						<input type='submit' class='btn_reservar' value='Reservar' id='btnReserva' /></td></tr></form>";
					}
			?>
		<script type="text/javascript">

			const formularioReserva = document.querySelector('#formularioReserva');
			const btnReserva = document.querySelector('#btnReserva');
			const formularioBaja = document.querySelector('#formularioBaja');
			const btnBaja =  document.querySelector('#btnBaja');

			btnReserva.addEventListener('click', (event) => {
				// Prevenir el envío predeterminado del formulario
				event.preventDefault();

				const fecha_reserva = new Date();
				const fecha_devolucion = new Date();
				fecha_devolucion.setDate(fecha_devolucion.getDate() + 15);
				let opciones = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
				let fechaReservaFormateada = fecha_reserva.toLocaleDateString('es-ES', opciones);
				let horaReservaFormateada = fecha_reserva.toLocaleString('es-ES', { hour: 'numeric', minute: 'numeric' });
				let fechaDevolucionFormateada = fecha_devolucion.toLocaleDateString('es-ES', opciones);
				let horaDevolucionFormateada = fecha_devolucion.toLocaleString('es-ES', { hour: 'numeric', minute: 'numeric' });
				
				// Mostrar un mensaje de confirmación y obtener la respuesta del usuario
				const confirmacion = confirm(`¿Está seguro de que desea reservar el libro?\n- Fecha de reserva: ${fechaReservaFormateada} a las ${horaReservaFormateada}\n- Devolución antes del: ${fechaDevolucionFormateada} a las ${horaDevolucionFormateada}`);

				// Si el usuario confirma, enviar el formulario
				if (confirmacion) {
					formularioReserva.submit();
				}

			});

			btnBaja.addEventListener('click', (event) => {
				
				// Prevenir el envío predeterminado del formulario
				event.preventDefault();
				
				// Mostrar un mensaje de confirmación y obtener la respuesta del usuario
				const confirmacion = confirm(`¿Está seguro de que desea eliminar su usuario del sistema?`);

				// Si el usuario confirma, enviar el formulario
				if (confirmacion) {
					formularioBaja.submit();
				}
			})

		</script> 
			<?php
				} else {
					echo "<tr><td colspan='9' align='center'>0 resultados</td></tr>";
				}
			?>

	</body>

</html> 