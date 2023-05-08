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

        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 10px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            opacity: 0.90;
        }

        body {
            background: url('https://investigacion.ucam.edu/sites/investigacion.ucam.edu/files/public/imagenes/componentes/two-col/hitech.jpg')  no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        h1{
            text-align: center;
        }

        .rating {
            --dir: right;
            --fill: gold;
            --fillbg: rgba(100, 100, 100, 0.15);
            --star: url('rsc/imgs/estrella.svg');
            --stars: 5;
            --starsize: 2rem;
            --symbol: var(--star);
            --w: calc(var(--stars) * var(--starsize));
            --x: calc(100% * (var(--value) / var(--stars)));
            block-size: var(--starsize);
            inline-size: var(--w);
            position: relative;
            touch-action: manipulation;
            -webkit-appearance: none;
        }
        
        .rating::-webkit-slider-runnable-track {
            background: linear-gradient(to var(--dir), var(--fill) 0 var(--x), var(--fillbg) 0 var(--x));
            block-size: 100%;
            mask: repeat left center/var(--starsize) var(--symbol);
            -webkit-mask: repeat left center/var(--starsize) var(--symbol);
        }
        
        .rating::-webkit-slider-thumb {
            height: var(--starsize);
            opacity: 0;
            width: var(--starsize);
            -webkit-appearance: none;
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
                $resultado2 = mysqli_stmt_get_result($stmt);
                // Obtener el primer registro
                $usuario = mysqli_fetch_array($resultado2);

                echo "<div class='container'>";
                
                if($usuario['Foto_de_carnet'] != NULL)
                {
                    echo '<div class="datosUsuario"><img src="data:image/jpeg;base64,'.base64_encode($usuario['Foto_de_carnet']).'">';
                }
                else
                {
                    echo '<div class="datosUsuario"><img class="card-img-top" src="rsc/imgs/sinfoto.png">';
                }
                
                echo "<span>".$usuario['Nombre']." ".$usuario['Apellidos']."</span></div>";
    ?>
        <input class="rating" max="5"
            step="0.5"
            style="--value:<?php echo $valor["valoracion"]; ?>"
            type="range"
            value="<?php echo $valor["valoracion"]; ?>"><br>
    <?php
                
                echo "<span>".$valor["comentario"]."</span></div>";
            }
        } else {
            echo "<h2>Este libro todavía no tiene valoraciones</h2>";
        }
    ?>
  </body>
</html>
