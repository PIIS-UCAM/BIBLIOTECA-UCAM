<?php
    include('conexion.php');
    include('admin.php');
    
?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_usuario']) && isset($_POST['id_libro'])) {
    // Obtener los valores enviados en el formulario
		$id_usuario = $_POST['id_usuario'];
		$id_libro = $_POST['id_libro'];

    
        // Verificar si la fecha de devolución está dentro del rango de penalización
        $sql = "SELECT fecha_devolucion FROM reservas WHERE id_usuario = $id_usuario AND id_libro = $id_libro";
        $resultado = $connect->query($sql) or die(mysqli_error($connect));
        $fila = mysqli_fetch_assoc($resultado);
        $fecha_devolucion = $fila['fecha_devolucion'];
        $fecha_sistema = new DateTime();
		$fecha_sistema_str = $fecha_sistema->format('Y-m-d');

		
		if ($fecha_sistema_str > $fecha_devolucion) {

		if ($fecha_sistema_str > $fecha_devolucion && $fecha_sistema_str <= date('Y-m-d', strtotime('+7 days', strtotime($fecha_devolucion)))) {
			// La fecha del sistema es mayor de 1 a 7 días de la fecha de devolución
			$fecha_penalizacion = date('Y-m-d', strtotime('+7 days', strtotime($fecha_sistema_str)));
			$mensaje = "Devolucion realizada correctamente. Por retraso en la devolucion se le ha aplicado una penalizacion de 7 dias";
			echo "<script>alert('$mensaje');</script>";
		} elseif ($fecha_sistema_str > date('Y-m-d', strtotime('+7 days', strtotime($fecha_devolucion))) && $fecha_sistema_str <= date('Y-m-d', strtotime('+15 days', strtotime($fecha_devolucion)))) {
			// La fecha del sistema es mayor de 7 a 15 días de la fecha de devolución
			$fecha_penalizacion = date('Y-m-d', strtotime('+1 month', strtotime($fecha_sistema_str)));
			$mensaje = "Devolucion realizada correctamente. Por retraso en la devolucion se le ha aplicado una penalizacion de 1 mes";
			echo "<script>alert('$mensaje');</script>";
		} elseif ($fecha_sistema_str > date('Y-m-d', strtotime('+15 days', strtotime($fecha_devolucion))) && $fecha_sistema_str <= date('Y-m-d', strtotime('+30 days', strtotime($fecha_devolucion)))) {
			// La fecha del sistema es mayor de 15 a 30 días de la fecha de devolución
			$fecha_penalizacion = date('Y-m-d', strtotime('+2 months', strtotime($fecha_sistema_str)));
			$mensaje = "Devolucion realizada correctamente. Por retraso en la devolucion se le ha aplicado una penalizacion de 2 meses";
			echo "<script>alert('$mensaje');</script>";
		} elseif ($fecha_sistema_str > date('Y-m-d', strtotime('+30 days', strtotime($fecha_devolucion)))) {
		   // Penalización de 6 meses más el retraso en días
           $dias_retraso = (new DateTime($fecha_devolucion))->diff(new DateTime($fecha_sistema_str))->days;
           $fecha_penalizacion = date('Y-m-d', strtotime("+6 months +$dias_retraso days", strtotime($fecha_sistema_str)));
           $mensaje = "Devolucion realizada correctamente. Por retraso en la devolucion se le ha aplicado una penalizacion de 6 meses mas el tiempo de retraso.";
           echo "<script>alert('$mensaje');</script>";
		}

		$sql = "SELECT fecha_de_penalizacion FROM usuarios WHERE id = $id_usuario";
		$resultado = $connect->query($sql) or die(mysqli_error($connect));
		$fila = mysqli_fetch_assoc($resultado);
		$fecha_penalizacion_actual = $fila['fecha_de_penalizacion'];

		// Comprobar si la nueva fecha de penalización es más tardía que la fecha actual o si la actual es nula
		if ($fecha_penalizacion_actual == null || $fecha_penalizacion > $fecha_penalizacion_actual) {
			// Actualizar la fecha de penalización
		$sql = "UPDATE usuarios SET fecha_de_penalizacion = '$fecha_penalizacion' WHERE id = $id_usuario";
		$resultado = $connect->query($sql) or die(mysqli_error($connect));
		}

		}
		else 
		{
			// La fecha del sistema es igual o anterior a la fecha de devolución, por lo que no se aplica ninguna penalización
			$mensaje = "Devolucion realizada correctamente";
			echo "<script>alert('$mensaje');</script>";
		}

		// Ejecutar la sentencia SQL para eliminar la reserva
		
		$sql = "DELETE FROM reservas WHERE id_usuario = $id_usuario AND id_libro = $id_libro";
    	$resultado = $connect->query($sql) or die(mysqli_error($connect));

		$sql = "UPDATE libros SET stock = stock+1,reservado = false  where id = $id_libro";
    	$resultado = $connect->query($sql) or die(mysqli_error($connect));
	
		
	}        
    
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
        $sql = "SELECT u.DNI, u.Nombre, u.Apellidos, l.Titulo, l.Autor, r.id as id_reserva, u.id as id_usuario, l.id as id_libro, DATE_FORMAT(r.fecha_reserva, 'El %d/%m/%Y a las %H:%i:%s') as fecha_reserva, DATE_FORMAT(r.fecha_devolucion, 'El %d/%m/%Y a las %H:%i:%s') as fecha_devolucion FROM reservas r INNER JOIN usuarios u ON u.id = r.id_usuario INNER JOIN libros l ON l.id = r.id_libro;";
        $resultado = $connect->query($sql) or die(mysqli_error($connect)); 
    ?>
    <br>
    <table border="1px solid black" cellspacing="0">
        <thead style="background-color: #1B7CC7;"> 
            <th>DNI del cliente</th>
            <th>Nombre del cliente</th>
            <th>Libro reservado</th> 
            <th>Fecha de reserva</th>
            <th>Fecha de devolución</th>
            <th>Devolver</th>
        </thead>
        <tbody>
        <?php
        if (mysqli_num_rows($resultado)>0) {
            while($valor = mysqli_fetch_assoc($resultado)) {
                echo "<tr><td align='center'>" .$valor["DNI"]. "</td><td align='center'>".$valor["Nombre"]." ".$valor["Apellidos"]."</td><td align='center'>\"".$valor["Titulo"]."\" de ".$valor["Autor"]."</td><td align='center'>" .$valor["fecha_reserva"]."</td><td align='center'>" .$valor["fecha_devolucion"]."</td>";

                echo "<td align='center'>
                    <form action='reservasActivas.php' method='POST'>
                        <input type='hidden' name='id_reserva' value='".$valor["id_reserva"]."'>
                        <input type='hidden' name='id_usuario' value='".$valor["id_usuario"]."'>
                        <input type='hidden' name='id_libro' value='".$valor["id_libro"]."'>
                        <input type='submit' value='Devolver'>
                    </form>
                </td></tr>";
            }
        } else {
            echo "<tr><td colspan='7' align='center'>0 resultados</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>
    </div>
        
	</body>
        <footer>
            &copy; 2023 Biblioteca UCAM. Todos los derechos reservados.
        </footer>
</html>
