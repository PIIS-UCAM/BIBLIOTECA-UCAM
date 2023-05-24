<html>
<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/estilos.css"/>
  <title>Panel Filtro de Busqueda</title>

  <style> 
    /* Paleta de colores de la UCAM */
    :root {
        --ucam-azul-oscuro: #002664;
        --ucam-azul-claro: #1B7CC7;
        --ucam-gris-oscuro: #52595D;
        --ucam-gris-claro: #E9E9E9;
    }

    body {
        background-image: url('https://investigacion.ucam.edu/sites/investigacion.ucam.edu/files/public/imagenes/componentes/two-col/hitech.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
    }

    .title{
        color: white;
        background-color: #002664;
        font-size: 50px;
        font-family: Arial, Helvetica, sans-serif;
    } 

    #boton{
        background-color: #002664;
        color: white;
        width: 10%;
        height: 5%;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12px;
        border: #002664;
    } 
    .container {
        max-width: 500px;
        margin: 50px auto;
        padding: 20px;
        border-radius: 10px;
        background-color: var(--ucam-gris-claro);
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        opacity: 0.90;

    }

    .formulario{
        /* color: white; */
        background-color: var(--ucam-gris-claro);
        background-repeat: no-repeat;
        background-size:cover;
        background-attachment: fixed;
    }

    .letter{
        color: black;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 16px;
    }

    .title {
        text-align: center;
    }
    .btn-primary {
        background-color: #002664;
    }

    .star {
        font-size: 1.5rem;
        color: #ccc;
        cursor: pointer;
    }

    .star:hover, .star.hover {
        color: #ffc107;
    }

    .star.selected {
        color: #ffc107;
    }
    
  </style>
</head>
<body>
  <h3 class="title">Filtro de Búsqueda</h3>
  <a href="biblioteca.php" style="text-decoration: none; color: white;"> < Volver a la Biblioteca</a>
  <div class="container">
  <form name="form" id="formularioFiltroBusqueda" action="tablaFiltroBusqueda.php" method="POST">
      <div class="mb-3">
        <label for="inputBusquedaGeneral" class="form-label">Busqueda general</label>
        <input name="busqueda_general" type="busqueda_general" class="form-control" id="inputBusquedaGeneral" >
      </div>
      <div class="mb-3">
        <label for="inputBusquedaISBN" class="form-label">ISBN</label>
        <input name="busqueda_isbn" type="busqueda_ISBN" class="form-control" id="inputBusquedaISBN">
      </div>
      <div class="mb-3">
        <label for="inputBusquedaAutor" class="form-label">Autor</label>
        <input name="busqueda_autor" type="busqueda_autor" class="form-control" id="inputBusquedaAutor">
      </div>
      <div class="mb-3">
        <label for="inputBusquedaTitulo" class="form-label">Titulo</label>
        <input name="busqueda_titulo" type="busqueda_titulo" class="form-control" id="inputBusquedaTitulo">
      </div>
      <div class="mb-3">
        <label for="inputBusquedaGenero" class="form-label">Género</label>
        <select name="busqueda_genero" class="form-select" id="inputBusquedaGenero">
          <option value="" selected disabled hidden>Elija una opción</option>
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
        </select>
      </div>
      <div class="mb-3">
        <label for="star" class="form-label">Puntuación <br> (se mostrarán resultados con la misma o mejor valoración)</label>
        <div class="rating">
          <span class="star" data-value="1">&#9733;</span>
          <span class="star" data-value="2">&#9733;</span>
          <span class="star" data-value="3">&#9733;</span>
          <span class="star" data-value="4">&#9733;</span>
          <span class="star" data-value="5">&#9733;</span>
          <input type="hidden" name="valoracion" class="star-value" value="">
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Busqueda</button>
    </form>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const stars = document.querySelectorAll('.star');
      const starValue = document.querySelector('.star-value');
      stars.forEach((star, index) => {
        star.addEventListener('click', function () {
          const ratingValue = this.getAttribute('data-value');
          starValue.value = ratingValue;
          stars.forEach((s, i) => {
            if (i < index + 1) {
              s.classList.add('selected');
            } else {
              s.classList.remove('selected');
            }
          });
        });

        star.addEventListener('mouseover', function () {
          stars.forEach((s, i) => {
            if (i <= index) {
              s.classList.add('hover');
            } else {
              s.classList.remove('hover');
            }
          });
        });
        star.addEventListener('mouseout', function () {
          stars.forEach(s => {
            s.classList.remove('hover');
          });
        });
      });
    });
  </script>

</body>
</html> 