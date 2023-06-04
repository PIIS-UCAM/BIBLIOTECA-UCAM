<?php
        
?>

<html>

<head>
    <style> 
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }
        
        h3 {
            color: #002664;
            font-size: 24px;
            margin-left: 20px;
        }

        .search-container {
            margin-left: 20px;
        }

        input[type="search"] {
            margin-bottom: 10px;
        }

        .btn_buscar {
            text-decoration: none;
            font-weight: bold;
            font-size: 15px;
            color: white;
            padding: 5px 30px;
            background-color: #002664;
            border: 2px solid #002664;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn_buscar:hover {
            background-color: #1B7CC7;
            border-color: #1B7CC7;
        }
    </style>

</head>
 
<body>
    <div class="search-container">
        <h3>Busqueda de Libros</h3>
        <p>
            Búsqueda de libro : <input type="search" name="busquedalibro" size="17" maxlength="20"> 
        </p>
        <input type="submit" class="btn_buscar" value="Buscar">
    </div>  
</body>
                
</html>
