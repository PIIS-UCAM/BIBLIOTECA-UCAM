<?php
    include('conexion.php');
    include('admin.php');
    include('consultas.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Panel de administración</title>
        <meta charset="utf-8">
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

            .añadir_libro {
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

            .añadir_libro:hover {
                background-color: #004691;
                border-color: #004691;
            }

            .quitar_libro {
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

            .quitar_libro:hover {
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

            input[type="text"], input[type="number"], input[type="date"] {
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
                position: float;
                bottom: 0;
                width: 100%;
            }
            
        </style>
    </head>
    <body>
        <div class="content">
            <!--Libros-->
            <div style="clear: both; padding-top: 10px">
                <h1>Libros:</h1>
                <div class="form-container">
                    <form name="form" action="consultas.php" method="POST">
                        <input required type="text" name="isbn" placeholder="ISBN"><br>
                        <input required type="text" name="titulo" placeholder="Título"><br>
                        <input required type="text" name="autor" placeholder="Autor"><br>
                            <select required name="genero" class="form-select">
                                <option value="" selected disabled hidden>Elija un género</option>
                                <option value="ciencia ficción">Ciencia ficción</option>
                                <option value="fantasía">Fantasía</option>
                                <option value="terror">Terror</option>
                                <option value="romance">Romance</option>
                                <option value="drama">Drama</option>
                                <option value="misterio">Misterio</option>
                                <option value="aventuras">Aventuras</option>
                                <option value="histórica">Histórica</option>
                                <option value="infantil">Infantil</option>
                                <option value="juvenil">Juvenil</option>
                                <option value="poesía">Poesía</option>
                                <option value="ensayo">Ensayo</option>
                            </select><br>
                        <input required type="text" name="editorial" placeholder="Editorial"><br>
                        <input required type="number" name="numpags" placeholder="Número de páginas"><br>
                        <input required type="number" name="stock" placeholder="Stock"><br>
                        <input required type="date"  name="reserva"><br><br>
                        <input type="submit" name="addLibro" class="añadir_libro" value="Añadir" onclick="add()"><br><br>
                </form>

                <form name="form" action="consultas.php" method="POST">
                    <input required type="text" name="isbnOid" placeholder="ISBN o ID">
                    <input type="submit" name="removeLibro" class="quitar_libro" value="Eliminar" onclick="remove()"> 
                </form>
                <?php 
                    $sql = "SELECT id, titulo, autor, genero, editorial, numero_paginas, stock, ISBN FROM libros"; 
                    $resultado = $connect->query($sql) or die(mysqli_error($connect));
                ?> 
                <br>
                <table border="1px solid black" cellspacing="0">
                    <thead style="background-color: #1B7CC7;">
                        <th>Id</th>
                        <th>Título</th>
                        <th>Autor</th> 
                        <th>Género</th>
                        <th>Editorial</th> 
                        <th>Número de páginas</th>
                        <th>ISBN</th>
                        <th>Stock</th>
                    </thead> 
                    <tbody>
            <?php
                if (mysqli_num_rows($resultado)>0) {
                    while($valor = mysqli_fetch_assoc($resultado)) {
                        echo "<tr><td align='center'>".$valor["id"]. "</td><td align='center'>" .$valor["titulo"]. "</td><td align='center'>".$valor["autor"]."</td><td align='center'>" .$valor["genero"]. "</td><td align='center'>" .$valor["editorial"]."</td><td align='center'>" .$valor["numero_paginas"]. "</td><td align='center'>" .$valor["ISBN"]."</td><td align='center'>" .$valor["stock"]. "</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='8' align='center'>0 resultados</td></tr>";
                }
            ?> 
                    </tbody> 
                </table>   
            </div>
        </div>
		
    </div>
	        <footer>
                &copy; 2023 Biblioteca UCAM. Todos los derechos reservados.
            </footer>
</body>
</html>  
