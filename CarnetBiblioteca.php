<html>

<head>
  <title>Carnet</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <style>
        .card{
          width: 30rem;
          height: 15rem;
          margin: 30px 0px 0px 500px;
        }

        .card-img-top{
          width: 10rem;
          height: 11rem;
          float: left;
        }

        .card-header{
          text-align: center;
          background-color: #002664;
          color: white;
          font-weight: 900;
        }

        .card-body{
          background-color: #E9E9E9;
          color: black;
          font-weight:700;
        }

        .card-text1{
          margin: 0px 0px 5px 175px;
        }

        .card-text2{
          margin: 0px 0px 5px 175px;
        }

        .card-text3{
          margin: 0px 0px 5px 175px;
        }

        .card-text4{
          margin: 0px 0px 5px 175px;
        }
        .card-text5{
          margin: 0px 0px 5px 175px;
        }

        .card-text6{
          margin: 0px 0px 5px 175px;
        }

  </style> 

 
</head>

 
<body>
           <!-- forma de recuperar los datos para ello incluimos el fichero php de alta del usuario    -->

<div class="card">
<div class="card-header">BIBLIOTECA UCAM</div>
<div class="card-body">
        <img class="card-img-top" src="https://acortar.link/Rkd7hG">
    <p class="card-text1">Nombre:</p><?php $nombre =  $_GET['nombre'] ?>
    <p class="card-text2">Apellido:</p><?php $apellido =  $_GET['apellido'] ?>
    <p class="card-text3">Fecha de nacimiento:</p> <?php $fechanacimineto =  $_GET['fechanacimiento'] ?>
    <p class="card-text4">DNI:</p> <?php $dni =  $_GET['dni'] ?>
    <p class="card-text5">Fecha de expedición:</p>
    <p class="card-text6">Fecha de validez:</p>
  </div>
</div>
</body>

<?php
            /*codigo php*/  

?>

 </html>
 