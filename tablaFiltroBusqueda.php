<?php
	include('conexion.php');
	include('consultas.php');
	session_start();
	// echo "<div style='float: left'>Volver a la página principal:<br><br><br><br>  <a href='' onclick='javascript:window.history.back(-1); return false;'><img class='option' src='rsc/imgs/casa.png' /></a></div>";
?>
<html>
  <head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
      <title>Tabla filtro busqueda</title>
      <style>
              thead {
                background-color: #E2A300;
              }
      </style>    

  </head>


  <body>
  <a href="panelFiltroBusqueda.php" style="text-decoration: none; color: #002664;"> < Volver a la Búsqueda Avanzada</a>
    <br>
    <br>
    <?php
        $busqueda_general = $_POST['busqueda_general'];
        //echo $busqueda_general;
        $busqueda_isbn = $_POST['busqueda_isbn'];
        //echo $busqueda_isbn;
        $busqueda_autor = $_POST['busqueda_autor'];
        //echo $busqueda_autor;
        $busqueda_titulo = $_POST['busqueda_titulo'];
        //echo $busqueda_titulo;
        $busqueda_genero = $_POST['busqueda_genero'];
        //echo $busqueda_genero;
        
        if(!empty($busqueda_general)){
          $sql = "SELECT id, titulo, autor, genero, editorial, numero_paginas, stock, ISBN FROM libros WHERE reservado = false AND isbn LIKE '%$busqueda_general%' OR autor LIKE '%$busqueda_general%' OR titulo LIKE '%$busqueda_general%' OR genero LIKE '%$busqueda_general%' OR editorial LIKE '%$busqueda_general%'";
          $resultado = $connect->query($sql) or die(mysqli_error($connect));
        }
        else if(!empty($busqueda_isbn)){
          $sql = "SELECT id, titulo, autor, genero, editorial, numero_paginas, stock, ISBN FROM libros WHERE reservado = false AND isbn LIKE '%$busqueda_isbn%'";
          $resultado = $connect->query($sql) or die(mysqli_error($connect));
        }
        else if(!empty($busqueda_autor)){
          $sql = "SELECT id, titulo, autor, genero, editorial, numero_paginas, stock, ISBN FROM libros WHERE reservado = false AND autor LIKE '%$busqueda_autor%'";
          $resultado = $connect->query($sql) or die(mysqli_error($connect));
        }
        else if(!empty($busqueda_titulo)){
          $sql = "SELECT id, titulo, autor, genero, editorial, numero_paginas, stock, ISBN FROM libros WHERE reservado = false AND titulo LIKE '%$busqueda_titulo%'";
          $resultado = $connect->query($sql) or die(mysqli_error($connect));
        }
        else if(!empty($busqueda_genero)){
          $sql = "SELECT id, titulo, autor, genero, editorial, numero_paginas, stock, ISBN FROM libros WHERE reservado = false AND genero LIKE '%$busqueda_genero%'";
          $resultado = $connect->query($sql) or die(mysqli_error($connect));
        }
        else{
          $sql = "SELECT * FROM libros WHERE 1=0;";
          $resultado = $connect->query($sql) or die(mysqli_error($connect));
        }
        
      ?> 
        <br>
          <div class="container">
            <table class="table table-striped table-hover">
              <thead>
                <th scope="col">Id</th>
                <th scope="col">Título</th>
                <th scope="col">Autor</th> 
                <th scope="col">Género</th>
                <th scope="col">Editorial</th> 
                <th scope="col">Número de páginas</th>
                <th scope="col">ISBN</th>
                <th scope="col">Stock</th>
                <th scope="col">Reservar</th>
              </thead> 
              <tbody>
          <?php
            if (mysqli_num_rows($resultado)>0) {
              while($valor = mysqli_fetch_assoc($resultado)) {
                echo "<form id='formularioReserva' action='consultas.php' method='POST'>
                <input type='text' style='display: none;' name='id_usuario' value='".$_SESSION['id_usuario']."' />
                <input type='text' style='display: none;' name='id_libro' value='".$valor["id"]."' />
                <tr><td align='left'>".$valor["id"]. "</td><td align='left'>" .$valor["titulo"]. "</td><td align='left'>".$valor["autor"]."</td><td align='left'>" .$valor["genero"]. "</td><td align='left'>" .$valor["editorial"]."</td><td align='left'>" .$valor["numero_paginas"]. "</td><td align='left'>" .$valor["ISBN"]."</td><td align='left'>" .$valor["stock"]. "</td><td align='left'>
                <input type='submit' class='btn_reservar' value='Reservar' id='btnReserva' /></td></tr></form></tbody></table></div>";
              }
            } else {
              echo "<tr><td colspan='9' align='center'>0 resultados</td></tr></tbody></table></div>";
            }
          ?>

  </body>
</html>