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
                position: fixed;
            }

            #pagReservasActivas {
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
				margin-right: 20px;
            }

            input[type="text"], input[type="date"], input[type="email"] {
                margin-bottom: 10px;
            }

		</style>
        <script src="js/jquery-3.6.4.min.js"></script>
	</head>
	<body>
		<!--Usuarios-->
		<div style="clear: both; padding-top: 10px">
			<h1>Reservas activas:</h1>
			<div class="form-container">
                <?php
                    $sql = "SELECT u.DNI, u.Nombre, u.Apellidos, l.Titulo, l.Autor, r.id, r.fecha_reserva, r.fecha_devolucion FROM reservas r INNER JOIN usuarios u ON u.id = r.id_usuario INNER JOIN libros l ON l.id = r.id_libro;";
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

                                    echo "<tr><td align='center'>
                                    <div class='form-check'>
                                    <input class='form-check-input' type='checkbox' value='".$valor["id"]."' id='flexCheckDefault'>
                                </div></td><td align='center'>" .$valor["DNI"]. "</td><td align='center'>".$valor["Nombre"]." ".$valor["Apellidos"]."</td><td align='center'>\"".$valor["Titulo"]."\" de ".$valor["Autor"]."</td><td align='center'>" .$valor["fecha_reserva"]."</td><td align='center'>" .$valor["fecha_devolucion"]."</td></tr>";
                            }
                        } else {
                            echo "<tr><td colspan='8' align='center'>0 resultados</td></tr>";
                        }
                    ?>
                    </tbody>
                </table>
                <form id="formEliminarReserva" action="consultas.php" method="POST">
                    <label for="eliminarReserva">Pulse el botón para eliminar las reservas activas seleccionadas: </label>
                    <input id="baja" name="eliminarReserva" class="boton_baja" value="Eliminar">
                </form>
            </div>
		</div>
        <script>
            $(document).ready(function() {
                $('#formEliminarReserva').submit(function(event) {
                    event.preventDefault(); // Evitar que el formulario se envíe de forma tradicional
                    
                    var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
                    var reservasEliminar = [];
                    checkboxes.forEach(function(checkbox) {
                        reservasEliminar.push(checkbox.value); //Recojo el valor del id de la reserva seleccionado y lo guardo en el array
                    });
                    
                    $.ajax({
                        url: 'consultas.php',
                        type: 'POST',
                        data: {idsReservasEliminar: reservasEliminar}
                    });
                });
            });
        </script>
        <footer>
            &copy; 2023 Biblioteca UCAM. Todos los derechos reservados.
        </footer>
	</body>
</html>