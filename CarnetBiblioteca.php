<html>

<head>
  <title>Carnet</title>
  <style>
        .padre{
          background-color:  #004175;
          width: 36%;
          height: 39%;
          position: relative;
          border-radius: 10%;
          border-bottom: 10%;
        }

        .carnet{
           background-color: #F5B003;
           color: white;
           font-family:Arial, Helvetica, sans-serif;
           border-radius: 10%;
           border-bottom: 10%;
        }


        .photo{
          width: 103px;
          height: 105px;
          position: relative;
          right: 200px;
        }

        .lettera{
           font-family: Arial, Helvetica, sans-serif;
           color: whitesmoke;
           font-size: 20px;
        }

        .letterb{
          font-family: Arial, Helvetica, sans-serif;
           color: whitesmoke;
           font-size: 20px;
        }

        .letterc{
          font-family: Arial, Helvetica, sans-serif;
           color: whitesmoke;
           font-size: 20px;
        }

        .letterd{
          font-family: Arial, Helvetica, sans-serif;
           color: whitesmoke;
           font-size: 20px;
        }

        
  </style> 

 
</head>

 
<body>
        <center>
        <div class="padre">
          <center><h1 class="carnet">Biblioteca UCAM</h1></center>  
                                                            /*forma de recuperar los datos para ello incluimos el fichero php de alta del usuario*/       
            <label class="lettera">Nombre: </label><br><br> <?php $nombre =  $_GET['nombre'] ?>
            <label class="letterb">Apellido:</label><br><br> <?php $apellido =  $_GET['apellido'] ?>
            <label class="letterc">Fecha de nacimiento:</label><br><br> <?php $fechanacimineto =  $_GET['fechanacimiento'] ?>
            <label class="letterd">DNI:</label><br><br> <?php $dni =  $_GET['dni'] ?>

          <img class="photo" src="https://acortar.link/Rkd7hG">
       
        </div> 
      </center> 
</body>

<?php
            /*codigo php*/  

?>

 </html>
 