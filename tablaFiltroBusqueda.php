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

        table {
          text-align: center;
        }

        thead {
          background-color: #E2A300;
        }

        tbody {
          background-color: white;
        }

        td {
          text-align: center;
        }

        #nota-cliente {
          position: fixed;
          bottom: 0;
          left: 0;
          text-align: center;
          width: 100%;
          background-color: #f8f8f8;
          color: #333;
          padding: 20px;
        }

        body {
            background-image: url('https://investigacion.ucam.edu/sites/investigacion.ucam.edu/files/public/imagenes/componentes/two-col/hitech.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }

        .rating {
            --dir: right;
            --fill: gold;
            --fillbg: rgba(100, 100, 100, 0.15);
            --star: url('rsc/imgs/estrella.svg');
            background-color: transparent;
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
  <a href="panelFiltroBusqueda.php" style="text-decoration: none; color: white;"> < Volver a la Búsqueda Avanzada</a>
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
        $busqueda_valoracion = $_POST['valoracion'];
        
        if(!empty($busqueda_general)){
          $sql = "SELECT id, titulo, autor, genero, editorial, numero_paginas, stock, ISBN, media FROM libros WHERE reservado = false AND isbn LIKE '%$busqueda_general%' OR autor LIKE '%$busqueda_general%' OR titulo LIKE '%$busqueda_general%' OR genero LIKE '%$busqueda_general%' OR editorial LIKE '%$busqueda_general%'";
          $resultado = $connect->query($sql) or die(mysqli_error($connect));
        }
        else if(!empty($busqueda_isbn)){
          $sql = "SELECT id, titulo, autor, genero, editorial, numero_paginas, stock, ISBN, media FROM libros WHERE reservado = false AND isbn LIKE '%$busqueda_isbn%'";
          $resultado = $connect->query($sql) or die(mysqli_error($connect));
        }
        else if(!empty($busqueda_autor)){
          $sql = "SELECT id, titulo, autor, genero, editorial, numero_paginas, stock, ISBN, media FROM libros WHERE reservado = false AND autor LIKE '%$busqueda_autor%'";
          $resultado = $connect->query($sql) or die(mysqli_error($connect));
        }
        else if(!empty($busqueda_titulo)){
          $sql = "SELECT id, titulo, autor, genero, editorial, numero_paginas, stock, ISBN, media FROM libros WHERE reservado = false AND titulo LIKE '%$busqueda_titulo%'";
          $resultado = $connect->query($sql) or die(mysqli_error($connect));
        }
        else if(!empty($busqueda_genero)){
          $sql = "SELECT id, titulo, autor, genero, editorial, numero_paginas, stock, ISBN, media FROM libros WHERE reservado = false AND genero LIKE '%$busqueda_genero%'";
          $resultado = $connect->query($sql) or die(mysqli_error($connect));
        }
        else if(!empty($busqueda_valoracion)){
          $sql = "SELECT id, titulo, autor, genero, editorial, numero_paginas, stock, ISBN, media FROM libros WHERE reservado = true AND media >= $busqueda_valoracion";
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
                <th scope="col">Puntuación media</th>
              </thead> 
              <tbody>
          <?php
            if (mysqli_num_rows($resultado)>0) {
              while($valor = mysqli_fetch_assoc($resultado)) {
                $idLibro = $valor["id"];

                echo "<form id='formularioReserva' action='consultas.php' method='POST'>
                <input type='text' style='display: none;' name='id_usuario' value='".$_SESSION['id_usuario']."' />
                
                <input type='text' style='display: none;' name='id_libro' value='".$valor["id"]."' />
                <tr><td align='left'>".$valor["id"]. "</td><td align='left'>" .$valor["titulo"]. "</td><td align='left'>".$valor["autor"]."</td><td align='left'>" .$valor["genero"]. "</td><td align='left'>" .$valor["editorial"]."</td><td align='left'>" .$valor["numero_paginas"]. "</td><td align='left'>" .$valor["ISBN"]."</td><td align='left'>" .$valor["stock"]. "</td><td align='left'>
                <input type='submit' class='btn_reservar' value='Reservar' id='btnReserva' /></td><td align='left'><input class='rating' max='5'
                step='0.5'
                style='--value:".$valor["media"]."'
                type='range'
                value='".$valor["media"]."'><br>(<a href='valoraciones.php?id_libro=$idLibro'>ver valoraciones</a>)</td></tr></form>";
              }
            } else {
              echo "<tr><td colspan='10' align='center'>0 resultados</td></tr>";
            }
          ?>
          </tbody></table></div>
      <!-- <div id="nota-cliente">
        <p>Clicke sobre el libro en cuestión para acceder al apartado de valoraciones y ver los comentarios escritos por otros clientes ✍️.</p>
      </div> -->
      
  </body>
</html>