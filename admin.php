<?php
	include('conexion.php');
	echo "<div style='float: left'>Volver a la página principal:<br> <a href='' onclick='javascript:window.history.back(-1); return false;'><img class='option' src='rsc/imgs/casa.png' /></a></div>";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Panel de administración</title>
	<meta charset="utf-8">
	<style type="text/css">
		tbody tr:nth-child(odd){
		    background: #eac633;
		}
		 
		tbody tr:nth-child(even){
		    background: white;
		}
	</style>
</head>
<body>
	<!--Libros-->
	<div style="clear: both; padding-top: 10px">
		<form name="form" action="admin_consultas.php" method="POST">
			<h1>Libros:</h1>
			<input type="text" name="isbn1" placeholder="ISBN"><br>
			<input type="text" name="titulo" placeholder="Título"><br>
			<input type="text" name="autor" placeholder="Autor"><br>
			<input type="text" name="genero" placeholder="Género"><br>
            <input type="text" name="editorial" placeholder="Editorial"><br>
			<input type="number" name="numpags" placeholder="Número de páginas"><br>
			<input type="number" name="stock" placeholder="Stock"><br>
			<input type="submit" name="add" value="Añadir" onclick="add()"><br><br>
			<input type="text" name="isbn2" placeholder="ISBN">
			<input type="submit" name="remove" value="Eliminar" onclick="remove()">
		</form>
		<?php
			$sql = "SELECT id, titulo, autor, genero, editorial, numero_paginas, stock, ISBN FROM libro";
			$resultado = $connect->query($sql) or die(mysqli_error($connect));
		?>
		<br>
			<table border="1px solid black" cellspacing="0">
				<thead style="background-color: #4d8cf2;">
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
    
	<script type="text/javascript">
        function showHidePass(){
            var pass = document.getElementById("pass");
            var checkpass = document.getElementById("checkpass");

            if (checkpass.checked){
                pass.setAttribute("type", "text");
            } else {
                pass.setAttribute("type", "password");
            }
        }

        function add(){
        	alert('Añadido 😉👍');
        }

        function remove(){
        	alert('Eliminado 😉👍');
        }
    </script>
</body>
</html>