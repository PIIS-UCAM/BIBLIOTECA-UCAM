<?php
    include('conexion.php');
    include('admin.php');
    include('admin_consultas.php');
?> 
<html style="background-color: FFE633;">
	<head>
		
		<center style="font-size: xx-large;"><h5 style="font-size: 40px;"><div style="background-color: #4d8cf2;">BIBLIOTECA UCAM</div></h5></center>
		
		<title>Panel de administración</title>
		<meta charset="utf-8">
		<style type="text/css">
			tbody tr:nth-child(odd){ 
				background: #eac633; 
			}
			
			tbody tr:nth-child(even){
				background: white;
			}

			#pagLibros {
				background-color: #F5B003;
			}
		</style>
	</head>
	<body> 
		<!--Libros-->
		<div style="clear: both; padding-top: 10px">
			<form name="form" action="admin_consultas.php" method="POST">
				<h1>Libros:</h1>
				<input required type="text" name="isbn" placeholder="ISBN"><br>
				<input required type="text" name="titulo" placeholder="Título"><br>
				<input required type="text" name="autor" placeholder="Autor"><br>
				<input required type="text" name="genero" placeholder="Género"><br>
				<input required type="text" name="editorial" placeholder="Editorial"><br>
				<input required type="number" name="numpags" placeholder="Número de páginas"><br>
				<input required type="number" name="stock" placeholder="Stock"><br>
				<input required type="date"  name="reserva"><br>
				<input type="submit" name="addLibro" value="Añadir" onclick="add()"><br><br>
				
			</form>

			<form name="form" action="admin_consultas.php" method="POST">
				<input required type="text" name="isbnOid" placeholder="ISBN o ID">
				<input type="submit" name="removeLibro" value="Eliminar" onclick="remove()"> 
			</form>
			<?php 
				$sql = "SELECT id, titulo, autor, genero, editorial, numero_paginas, stock, reserva, ISBN FROM libro"; 
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
						<th>Fecha de reserva</th>
					</thead> 
					<tbody>
			<?php
				if (mysqli_num_rows($resultado)>0) {
					while($valor = mysqli_fetch_assoc($resultado)) {
						echo "<tr><td align='center'>".$valor["id"]. "</td><td align='center'>" .$valor["titulo"]. "</td><td align='center'>".$valor["autor"]."</td><td align='center'>" .$valor["genero"]. "</td><td align='center'>" .$valor["editorial"]."</td><td align='center'>" .$valor["numero_paginas"]. "</td><td align='center'>" .$valor["ISBN"]."</td><td align='center'>" .$valor["stock"]. "</td><td align='center'>" .$valor["reserva"]."</td></tr>";
					}
				} else {
					echo "<tr><td colspan='8' align='center'>0 resultados</td></tr>";
				}
			?> 
					</tbody> 
				</table>   
		</div>
			  
	</body>

</html>   