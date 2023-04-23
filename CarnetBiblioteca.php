<?php
    
    include('conexion.php');
    include('consultas.php');
    session_start();

?>

<html>

<head>
  <title>Carnet</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="css/styles.css">
  <style>
        .card{
          width: 30rem;
          height: 15rem;
          margin: 30px 0px 0px 500px;
        }

        .card-img-top{
          width: 10rem;
          height: 11rem;
          float: left;
        }

        .card-header{
          text-align: center;
          background-color: #002664;
          color: white;
          font-weight: 900;
        }

        .card-body{
          background-color: #E9E9E9;
          color: black;
          font-weight:700;
        }

        .card-text1{
          margin: 0px 0px 5px 175px;
        }

        .card-text2{
          margin: 0px 0px 5px 175px;
        }

        .card-text3{
          margin: 0px 0px 5px 175px;
        }

        .card-text4{
          margin: 0px 0px 5px 175px;
        }
        .card-text5{
          margin: 0px 0px 5px 175px;
        }

        .card-text6{
          margin: 0px 0px 5px 175px;
        }

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

			.table{
				margin: 0px 0px 0px 300px;
				width:70%;
			}

			thead {
              background-color: #E2A300;
            }
			
			.btn_reservar{
				background-color: #52595D;
				color:white;
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
						<a href="biblioteca.php" class="active">Volver a la biblioteca</a>
					</li>
					<li>
						<a href="">Reservas</a>
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

<div class="card">
  <div class="card-header">BIBLIOTECA UCAM</div>
    <div class="card-body">
		<?php
			$id = $_SESSION['id_usuario'];
			// Obtener la foto de la base de datos
			$sql = "SELECT Foto_de_carnet FROM usuarios WHERE id = $id";
			$resultado = mysqli_query($connect, $sql);
			$fila = mysqli_fetch_assoc($resultado);

			// Mostrar la foto en una etiqueta img
			echo '<img class="card-img-top" src="data:image/jpeg;base64,'.base64_encode($fila['Foto_de_carnet']).'" alt="Foto de carnet faltante">';
		?>
      <p class="card-text1">Nombre: <?php echo $_SESSION['nombre']; ?> </p>
      <p class="card-text2">Apellidos: <?php echo $_SESSION['apellidos']; ?> </p>
      <p class="card-text4">DNI: <?php echo $_SESSION['DNI']; ?> </p>
      <p class="card-text3">Fecha de nacimiento: <?php echo date('d/m/Y', strtotime($_SESSION['Fecha_de_nacimiento'])); ?> </p>
      <p class="card-text5">Fecha de expedición: <?php echo date('d/m/Y, H:i:s', strtotime($_SESSION['Fecha_de_expedicion'])); ?> </p>
      <p class="card-text6">Fecha de validez: <?php echo date('d/m/Y, H:i:s', strtotime($_SESSION['Fecha_de_validez'])); ?> </p>
  </div>
</div>
</body>
 </html>
 