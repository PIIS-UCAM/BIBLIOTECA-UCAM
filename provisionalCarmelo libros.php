<?php
    include('conexion.php');
    include('admin.php');
    include('admin_consultas.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Libros</title>
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


            #pagLibros {
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

            .content {
                flex: 1;
            }

            footer {
                background-color: #002856;
                padding: 20px;
                text-align: center;
                color: #fff;
                font-size: 16px;
            }
        </style>
    </head>
    <body>
        <div class="content">
        </style>
    </head>
    <body>
        <!--Libros-->
        <div style="clear: both; padding-top: 10px">
            <h1>Libros:</h1>
            <div class="form-container">
                <form name="form" action="admin_consultas.php" method="POST">
                    <input required type="text" name="titulo" placeholder="Titulo"><br>
                    <input required type="text" name="autor" placeholder="Autor"><br>
                    <input required type="text" name="editorial" placeholder="Editorial"><br>
                    <input required type="text" name="isbn" placeholder="ISBN"><br>
					<input required type="text" name="Género" placeholder="Género"><br>
					<input required type="text" name="" placeholder="Número de páginas"><br>
					<input required type="text" name="Stock" placeholder="Stock"><br>
					<input required type="date" name="fecha_de_publicacion" placeholder="Fecha de publicación"><br>
					<input type="submit" name="addLibro" class="boton_alta" value="Añadir" onclick="add()"><br><br>
</form>
<form name="form" action="admin_consultas.php" method="POST">
<input required type="text" name="isbnOid" placeholder="ISBN o ID del libro">
<input type="submit" id="baja" name="removeLibro" class="boton_baja" value="Eliminar"  onclick="remove()">
                <script type="text/javascript">
                    window.addEventListener("load", function(){
                        document.getElementById("baja").addEventListener("click", function(){ 
                                alert("Libro eliminado exitosamente");
                        })
                    })
					            </script>   

        </form>
    </div>
    <?php
        $sql = "SELECT id, Titulo, Autor, Editorial, ISBN, Fecha_de_publicacion, Edicion, Idioma, Categoria, Ubicacion FROM Libro";
        $resultado = $connect->query($sql) or die(mysqli_error($connect)); 
    ?>
    <br>
        <table border="1px solid black" cellspacing="0">
            <thead style="background-color: #1B7CC7;"> 
                <th>Id</th>
                <th>Titulo</th>
                <th>Autor</th>
                <th>Editorial</th> 
                <th>ISBN</th>
                <th>Fecha de publicación</th>
                <th>Edición</th>
                <th>Idioma</th>
                <th>Categoría</th>
                <th>Ubicación</th>
            </thead>
            <tbody>
            <?php
                if (mysqli_num_rows($resultado)>0) {
                    while($valor = mysqli_fetch_assoc($resultado)) {
                            echo "<tr><td align='center'>".$valor["id"]. "</td><td align='center'>" .$valor["Titulo"]. "</td><td align='center'>".$valor["Autor"]."</td><td align='center'>" .$valor["Editorial"]."</td><td align='center'>" .$valor["ISBN"]."</td><td align='center'>" .$valor["Fecha_de_publicacion"]."</td><td align='center'>" .$valor["Edicion"]."</td><td align='center'>" .$valor["Idioma"]. "</td><td align='center'>" .$valor["Categoria"]."</td><td align='center'>" .$valor["Ubicacion"]."</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='10' align='center'>0 resultados</td></tr>";
                }
            ?>
            </tbody>
        </table>
    </div>
	<footer>
    <h4>BIBLIOTECA UCAM</h4>
	</footer>
</body>
</html>
