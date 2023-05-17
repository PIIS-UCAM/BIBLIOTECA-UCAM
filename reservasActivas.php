<?php
    include('conexion.php');
    include('admin.php');
    include('consultas.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Reservas activas</title>
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
                position: float;
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
			<h1>Reservas activas:</h1>
				
            <?php
                $sql = "SELECT u.DNI, u.Nombre, u.Apellidos, l.Titulo, l.Autor, r.fecha_reserva, r.fecha_devolucion FROM reservas r INNER JOIN usuarios u ON u.id = r.id_usuario INNER JOIN libros l ON l.id = r.id_libro;";
                $resultado = $connect->query($sql) or die(mysqli_error($connect)); 
            ?>
            <br>
            <table border="1px solid black" cellspacing="0">
                <thead style="background-color: #1B7CC7;"> 
                    <th></th>
                    <th>DNI del cliente</th>
                    <th>Nombre del cliente</th>
                    <th>Libro reservado</th> 
                    <th>Fecha de reserva</th>
                    <th>Fecha de devolución</th>
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

                                echo "<tr><td align='center'>
                                <div class='form-check'>
                                <input class='form-check-input' type='checkbox' value='' id='flexCheckDefault'>
                              </div></td><td align='center'>" .$valor["DNI"]. "</td><td align='center'>".$valor["Nombre"]." ".$valor["Apellidos"]."</td><td align='center'>\"".$valor["Titulo"]."\" de ".$valor["Autor"]."</td><td align='center'>" .$valor["fecha_reserva"]."</td><td align='center'>" .$valor["fecha_devolucion"]."</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8' align='center'>0 resultados</td></tr>";
                    }
                ?>
                </tbody>
            </table>
            <form name="form" action="consultas.php" method="POST">
                <label for="eliminarReserva">Pulse el botón para eliminar las reservas activas seleccionadas: </label>
                <input type="submit" id="baja" name="eliminarReserva" class="boton_baja" value="Eliminar">
            </form>
		</div>
        <footer>
            &copy; 2023 Biblioteca UCAM. Todos los derechos reservados.
        </footer>
	</body>
</html>