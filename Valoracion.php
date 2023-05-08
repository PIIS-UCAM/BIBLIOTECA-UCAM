<?php
	include('conexion.php'); // Conexión a la base de datos
	include('consultas.php');
	session_start();
	// echo "<div style='float: left'>Volver a la página principal:<br><br><br><br>  <a href='' onclick='javascript:window.history.back(-1); return false;'><img class='option' src='rsc/imgs/casa.png' /></a></div>";
?>

<html>
	<head>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
		
		<title>¡Bienvenido, <?php echo $_SESSION['nombre']; ?>!</title>
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
				display: inline-block;
                text-decoration: none;
				font-weight: 20px; 
				font-size: 19px; 
				color: white;
				padding-bottom: 5px;
				padding-top: 5px;
				padding-left: 30px; 
				padding-right: 30px;
				background-color: #002664;
				border: 1px solid transparent; 
            }

			.btn_buscar:hover {
				text-decoration: none;
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

			a {
				text-decoration: none;
			}

			.menu li a:hover:not(.active) {
				background-color: #e2a300;
			} 

			.buscarlibro {
				margin: 20px 0px 20px 575px;
				display: inline-block;
				background-color: #fff;
				border: 1px solid #ced4da;
				border-radius: 0.25rem;
				line-height: 1.5;
				font-size: 1rem;
                font-weight: 400;
				padding: 0.375rem 0.75rem; 
				width: 20%;
			}
.star {
    font-size: 1.5rem;
    color: #ccc;
    cursor: pointer;
}

.star:hover, .star.hover {
    color: #ffc107;
}

.star.selected {
    color: #ffc107;
}

			.table{
				margin: 0px 0px 0px 225px;
				width:70%;
			}

			thead {
              background-color: #E2A300;
            }

			button:hover {
			background-color: #E2A300;
			}

			
			button {
			background-color: #E9E9E9;
			}

			.rating {
				direction: rtl;
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
					<a href="CarnetBiblioteca.php" class="active">Carnet de biblioteca</a>
				</li>
				<li>
					<a href="biblioteca.php">Reservas</a>
				</li>
      <li>
					<a href="Valoracion.php">Valoración de libros</a>
				</li>
				<li>
					<form name="form" id="formularioBaja" action="consultas.php" method="POST">
						<input style="display: none;" type="text" name="id_baja" value="<?php echo $_SESSION['id_usuario']?>">
						<a id="btnBaja" name="bajaUsuario" href="#" onclick="return confirm('¿Está seguro de que desea eliminar su usuario del sistema?') && document.forms[0].submit();">Darse de baja</a>
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
				<?php
					$id_usuario = $_SESSION['id_usuario'];

					$sql = "SELECT l.id, l.titulo, l.autor, l.genero, l.editorial, l.numero_paginas, l.stock, l.ISBN
					FROM libros l
					INNER JOIN reservas r
					ON l.id = r.id_libro
					WHERE r.id_usuario = $id_usuario";

					$resultado = $connect->query($sql) or die(mysqli_error($connect));
					?> 
						<br>
							<div class="container">
								<table class="table table-striped table-hover">
									<thead>
										<th scope="col">Id</th>
										<th scope="col">Título</th>
										<th scope="col">Autor</th> 
										<th scope="col">Género</th>
										<th scope="col">Editorial</th> 
										<th scope="col">Número de páginas</th>
										<th scope="col">ISBN</th>
										<th scope="col">Stock</th>
										<th scope="col">Valoración</th>
									</thead> 
									<tbody>
			<?php
			if (mysqli_num_rows($resultado) > 0) {
				while ($valor = mysqli_fetch_assoc($resultado)) {
					$id = $valor["id"];
					$titulo = $valor["titulo"];
					$autor = $valor["autor"];
					$genero = $valor["genero"];
					$editorial = $valor["editorial"];
					$numero_paginas = $valor["numero_paginas"];
					$ISBN = $valor["ISBN"];
					$stock = $valor["stock"];
			?>
					<form id="formularioValoracion<?php echo $id ?>" method="POST">
						<input type="hidden" name="id_usuario" value="<?php echo $_SESSION['id_usuario'] ?>" />
						<input type="hidden" name="id_libro" value="<?php echo $id ?>" />
						<tr>
							<td align="left"><?php echo $id ?></td>
							<td align="left"><?php echo $titulo ?></td>
							<td align="left"><?php echo $autor ?></td>
							<td align="left"><?php echo $genero ?></td>
							<td align="left"><?php echo $editorial ?></td>
							<td align="left"><?php echo $numero_paginas ?></td>
							<td align="left"><?php echo $ISBN ?></td>
							<td align="left"><?php echo $stock ?></td>
							<td align="left">
							
								<div class="rating">
									<span class="star" data-value="5">&#9733;</span>
									<span class="star" data-value="4">&#9733;</span>
									<span class="star" data-value="3">&#9733;</span>
									<span class="star" data-value="2">&#9733;</span>
									<span class="star" data-value="1">&#9733;</span>
									<input type="hidden" name="valoracion" class="star-value" value="">
								</div>

							</td>
						</tr>
						<tr>
							<td colspan="9">
								<br>
								<textarea type="text" name="comentario" style="width: 100%;" placeholder="Ingrese su comentario aquí"  rows="5" cols="50"></textarea><br><br>
								<button type="submit" name="enviar" >Enviar</button>
							</td>
						</tr>
					</form>
			<?php
				}
			}
			?>

			<?php

			// Recuperación de los datos del formulario
			$id_usuario = $_POST['id_usuario'];
			$id_libro = $_POST['id_libro'];
			$valoracion = $_POST['valoracion'];
			$comentario = $_POST['comentario'];

			// Actualización de la tabla "reservas"
			$sql = "UPDATE reservas SET valoracion = ?, comentario = ? WHERE id_usuario = ? AND id_libro = ?";
			$stmt = mysqli_prepare($connect, $sql);
			mysqli_stmt_bind_param($stmt, 'isii', $valoracion, $comentario, $id_usuario, $id_libro);
			mysqli_stmt_execute($stmt);

			// Actualización de la tabla "libros"
			$sql = "UPDATE libros SET contador = contador + 1, sumatorio = sumatorio + ? WHERE id = ?";
			$stmt = mysqli_prepare($connect, $sql);
			mysqli_stmt_bind_param($stmt, 'ii', $valoracion, $id_libro);
			mysqli_stmt_execute($stmt);

			$sql = "UPDATE libros SET media = sumatorio/contador WHERE id = ?";
			$stmt = mysqli_prepare($connect, $sql);
			mysqli_stmt_bind_param($stmt, 'i', $id_libro);
			mysqli_stmt_execute($stmt);

			mysqli_close($connect);
			?>
			
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const stars = document.querySelectorAll('.star');
    const starValue = document.querySelector('.star-value');

    stars.forEach((star, index) => {
      star.addEventListener('click', function () {
        const ratingValue = this.getAttribute('data-value');
        starValue.value = ratingValue;

        stars.forEach((s, i) => {
          if (i < index + 1) {
            s.classList.add('selected');
          } else {
            s.classList.remove('selected');
          }
        });
      });

      star.addEventListener('mouseover', function () {
        stars.forEach((s, i) => {
          if (i <= index) {
            s.classList.add('hover');
          } else {
            s.classList.remove('hover');
          }
        });
      });

      star.addEventListener('mouseout', function () {
        stars.forEach(s => {
          s.classList.remove('hover');
        });
      });
    });
  });
</script>

</body>		

</html> 

