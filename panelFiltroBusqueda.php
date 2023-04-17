<html>


<head>
<title>Panel Filtro de Busqueda</title>
    <style>
           .title{
                color: #F5B003;
                background-color: #004175;
                font-size: 80px;
                font-family: Arial, Helvetica, sans-serif;
                border-radius: 50%;
           } 

            #boton{
                background-color: #004175;
                color: #F5B003;
                width: 10%;
                height: 5%;
                font-family: Arial, Helvetica, sans-serif;
                font-size: 12px;
                border: #F5B003;
            } 

            .formulario{
                border: 4ppx solid #004175;
                background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQkdDv61OTCtbFynELgURXej2eBQCJD9WiKFfuiDSIk8DRWoH6s3nkgfKaiU_NI_qJq-OY&usqp=CAU');
                border: 5px solid #004175;

            }

            .letter{
                color: whitesmoke;
                font-family: Arial, Helvetica, sans-serif;
                font-size: 16px;
            }

    </style>
</head>
 
<center>

<body>
<h3 class="title">Filtro de Busqueda</h3>

    <form class="formulario">
     <p><strong class="letter">Busqueda general</strong></p><input type="text" id="busqueda_general" placeholder="Busqueda general" maxlength="20px" size="30px">   
     <p><strong class="letter">ISBN :</strong></p><input type="text" id="busqueda_isbn" placeholder="Busqueda por isbn" maxlength="20px" size="19px">    
     <p><strong class="letter">Autor :</strong></p><input type="text" id="busqueda_autor" placeholder="Busqueda autor" maxlength="20px" size="19px">
     <p><strong class="letter">Titulo :</strong></p><input type="text" id="busqueda_titulo" placeholder="Busqueda titulo" maxlength="20px" size="19px"> 
     <p>class="letter"><strong>Genero :</strong></p>
     <select>
        <option value="accion">Accion</option>
        <option value="novela">Novela</option> 
        <option value="comedia">Comedia</option>
     </select><br><br><br><br><br><br>

     <input id="boton" type="submit" title="Busqueda">  

    </form>

</body>
</center>

</html> 