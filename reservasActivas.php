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
                text-shadow: 2px 2px 4px #999;
            }

            footer {
                background-color: #002856;
                padding: 20px;
                text-align: center;
                color: #fff;
                font-size: 16px;
                bottom: 0;
                width: 100%;
                position: fixed;
                margin-top:50px;
                box-shadow: 0px -2px 4px #999;
            }

            #pagReservasActivas {
                background-color: #E2A300;
            }

			.boton_alta, .boton_baja {
				text-decoration: none;
				font-weight: bold;
				font-size: 15px;
				color: white;
				padding: 5px 30px;
				border: none;
				border-radius: 5px;
				cursor: pointer;
				transition: all 0.3s ease;
                box-shadow: 2px 2px 4px #999;
			}

            .boton_alta {
                background-color: #002856;
            }

			.boton_alta:hover {
				background-color: #004691;
			}

            .boton_baja {
				background-color: #E21B1B;
			}

			.boton_baja:hover {
				background-color: #FF2E2E;
			}

            table {
                border-collapse: collapse;
                width: 100%;
                background-color: #fff;
                margin-bottom: 50px;
                box-shadow: 2px 2px 4px #999;
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
                border-radius: 5px;
                border: 1px solid #ccc;
                padding: 5px;
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
                    $sql = "SELECT u.DNI, u.Nombre, u.Apellidos, l.Titulo, l.Autor, r.id, DATE_FORMAT(r.fecha_reserva, 'El %d/%m/%Y a las %H:%i:%s') as fecha_reserva, DATE_FORMAT(r.fecha_devolucion, 'El %d/%m/%Y a las %H:%i:%s') as fecha_devolucion FROM reservas r INNER JOIN usuarios u ON u.id = r.id_usuario INNER JOIN libros l ON l.id = r.id_libro;";
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
                                    <input class='form-check-input' type='checkbox' value='".$valor["id"]."' name='checkboxReserva'>
                                </td><td align='center'>" .$valor["DNI"]. "</td><td align='center'>".$valor["Nombre"]." ".$valor["Apellidos"]."</td><td align='center'>\"".$valor["Titulo"]."\" de ".$valor["Autor"]."</td><td align='center'>" .$valor["fecha_reserva"]."</td><td align='center'>" .$valor["fecha_devolucion"]."</td></tr>";
                            }
                        } else {
                            echo "<tr><td colspan='8' align='center'>0 resultados</td></tr>";
                        }
                    ?>
                    </tbody>
                </table>
                <form id="formEliminarReserva" action="consultas.php" method="POST">
                    <input type="hidden" name="arrayReservasEliminar" id="arrayReservasEliminar">
                    <label for="btnEliminarReserva">Pulse el botón para eliminar las reservas activas seleccionadas: </label>
                    <input id="btnEliminarReserva" name="btnEliminarReserva" type="submit" class="boton_baja" value="Eliminar">
                </form>
            </div>
		</div>
        <script>
            const btnEliminarReserva = document.querySelector('#btnEliminarReserva');
            const formEliminarReserva = document.querySelector('#formEliminarReserva');

            btnEliminarReserva.addEventListener('click', (event) => {
				// Prevenir el envío predeterminado del formulario
				event.preventDefault();
                
                var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
                var reservasEliminar = [];
                checkboxes.forEach(function(checkbox) {
                    reservasEliminar.push(checkbox.value); //Recojo el valor del id de la reserva seleccionado y lo guardo en el array
                });

                if(reservasEliminar.length === 0){
                    alert("No se ha seleccionado ninguna reserva 🤷‍♂");
                }
                else{

                    // Mostrar un mensaje de confirmación y obtener la respuesta del usuario
                    const confirmacion = confirm("¿Está seguro de que desea eliminar la reserva?");

                    // Si el usuario confirma, enviar el formulario
                    if (confirmacion) {
                        // Convierte el array a formato JSON
                        var datosReservasEliminar = JSON.stringify(reservasEliminar);
                        // Asigna el valor JSON al campo oculto del formulario
                        document.getElementById("arrayReservasEliminar").value = datosReservasEliminar;

                        formEliminarReserva.submit();
                    }
                }
            });
        </script>
	</body>
        <footer>
            &copy; 2023 Biblioteca UCAM. Todos los derechos reservados.
        </footer>
</html>
