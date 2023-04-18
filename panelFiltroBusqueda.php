<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

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
    </style>
</head>
<body>
<h3 class="title">Filtro de Búsqueda</h3>
<div class="container">
<form>
  <div class="mb-3">
    <label for="exampleInputBusquedaGeneral" class="form-label">Busqueda general</label>
    <input type="busqueda_general" class="form-control" id="exampleInputBusquedaGeneral" >
  </div>
  <div class="mb-3">
    <label for="exampleInputBusquedaISBN" class="form-label">ISBN</label>
    <input type="busqueda_ISBN" class="form-control" id="exampleInputBusquedaISBN">
  </div>
  <div class="mb-3">
    <label for="exampleInputBusquedaAutor" class="form-label">Autor</label>
    <input type="busqueda_autor" class="form-control" id="exampleInputBusquedaAutor">
  </div>
  <div class="mb-3">
    <label for="exampleInputBusquedaTitulo" class="form-label">Titulo</label>
    <input type="busqueda_titulo" class="form-control" id="exampleInputBusquedaTitulo">
  </div>
  <div class="mb-3">
    <label for="exampleInputBusquedaGenero" class="form-label">Género</label>
     <select class="form-select">
        <option value="accion">Acción</option>
        <option value="novela">Novela</option> 
        <option value="comedia">Comedia</option>
     </select>
  </div>
  <button type="submit" class="btn btn-primary">Busqueda</button>
  </body>
<!-- </center> -->
</form>
</div>
</html> 