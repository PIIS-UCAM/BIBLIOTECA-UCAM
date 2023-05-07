<?php
    
    include('conexion.php');
    include('consultas.php');
    session_start();

    $idLibro = $_GET['id_libro'];

    //Cuando se quieren recoger sus valoraciones
	$sql = "SELECT * FROM reservas WHERE id_libro='$idLibro'";
	$resultado = $connect->query($sql) or die(mysqli_error($connect)); 

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Valoraciones</title>
    <style>
        img {
            height: 34px;
            width: 34px;
            border-radius: 50%;
        }

        .datosUsuario {
            display: flex;
            align-items: center;
        }

        .datosUsuario img {
            margin-right: 10px;
        }

        .datosUsuario p {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
    </style>
  </head>
  <body>
    <a href="tablaFiltroBusqueda.php" style="text-decoration: none; color: #002664;"> < Volver al resultado de la búsqueda</a>
    <h1>Opiniones de clientes</h1>
    <?php
        if (mysqli_num_rows($resultado)>0) {
            while($valor = mysqli_fetch_assoc($resultado)) {
                // Obtener el ID de usuario
                $id_usuario = $valor["id_usuario"];
                // Preparar la consulta
                $stmt = mysqli_prepare($connect, "SELECT Nombre, Apellidos, Foto_de_carnet FROM Usuarios WHERE id = ?");
	            // Vincular los parámetros
                mysqli_stmt_bind_param($stmt, "i", $id_usuario);
                // Ejecutar la consulta
                mysqli_stmt_execute($stmt);
                // Obtener el resultado
                $resultado = mysqli_stmt_get_result($stmt);
                // Obtener el primer registro
                $usuario = mysqli_fetch_array($resultado);
                
                if($usuario['Foto_de_carnet'] != NULL)
                    echo '<div class="datosUsuario"><img src="data:image/jpeg;base64,'.base64_encode($usuario['Foto_de_carnet']).'">';
                else
                    echo '<div class="datosUsuario"><img class="card-img-top" src="rsc/imgs/sinfoto.png">';
                
                echo "<p>".$usuario['Nombre']." ".$usuario['Apellidos']."</p></div>";
                echo "<p>".$valor["valoracion"]."</p>";
                echo "<p>".$valor["comentario"]."</p></div>";
            }
        } else {
            echo "<h2>Este libro todavía no tiene valoraciones</h2>";
        }
    ?>
  </body>
</html>
