<?php
    session_start();
    session_id();
    session_name();
    include('acceso.php');
?>
<!DOCTYPE html>
<html class="back_color">
<head>
    <meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Biblioteca UCAM</title>
	<link rel="stylesheet" type="text/css" href="css/estilos.css"/>
    <script src="js/jquery-3.6.4.min.js"></script>
    <style>
        /* Paleta de colores de la UCAM */
        :root {
        --ucam-azul-oscuro: #002664;
        --ucam-azul-claro: #1B7CC7;
        --ucam-gris-oscuro: #52595D;
        --ucam-gris-claro: #E9E9E9;
        }

        /* Estilos generales */
        * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        }

        body {
        background-color: var(--ucam-gris-claro);
        font-family: Arial, sans-serif;
        }

        header {
        background-color: var(--ucam-azul-oscuro);
        color: white;
        text-align: center;
        padding: 20px;
        }

        .container {
        max-width: 500px;
        margin: 50px auto;
        padding: 20px;
        border-radius: 10px;
        background-color: var(--ucam-gris-claro);
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        form {
        display: flex;
        flex-direction: column;
        }

        h2 {
        margin-bottom: 20px;
        color: var(--ucam-azul-oscuro);
        }

        label {
        margin-bottom: 10px;
        color: var(--ucam-azul-oscuro);
        }

        input[type="email"],
        input[type="password"] {
        padding: 10px;
        border-radius: 5px;
        border: none;
        margin-bottom: 20px;
        background-color: var(--ucam-gris-claro);
        border: 1px solid var(--ucam-gris-oscuro);
        }

        button {
        padding: 10px;
        border-radius: 5px;
        border: none;
        background-color: var(--ucam-azul-oscuro);
        color: white;
        cursor: pointer;
        margin-bottom: 20px;
        }

        button:hover {
        background-color: var(--ucam-azul-claro);
        }

        a {
        color: var(--ucam-azul-oscuro);
        }
    </style>
</head>
<body id="indexBody"> 
    <header>
      <h1>Bienvenido a la biblioteca de la UCAM</h1>
    </header>
    <div class="container">
        <!-- Formulario de acceso-->
        <form name="form" action="acceso.php" method="post">
            <h2>Iniciar sesión</h2>
            <label for="email">Correo de usuario:</label>
            <input placeholder="Introduzca su correo" required name="email" type="email" />
            <label for="password">Contraseña:</label>
            <input placeholder="Introduzca su contraseña" required name="password" type="password"/>
            <label><input name="remember" type="checkbox" value="rememberYES" /> Recuérdame</label>
            <button type="submit" name="enviar">Entrar</button><br>
        </form>
        <p>¿Aún no eres socio?<a style="font-size: 12px; color: #00427b;" href="registro.php"> <b><u>Regístrate aquí</u></b></a></p>
        <p>¿Has olvidado tu contraseña?<a style="font-size: 12px; color: #00427b;" href="olvidado.php"> <b><u>Recupérala aquí</u></b></a></p>
    </div>

	<script type="text/javascript">
        document.getElementById("acceso").innerHTML = '<?php echo "Hola "; ?>';
        document.getElementById("usuario").innerHTML = '<?php session_start(); echo $_SESSION['nombre']; ?>';
        document.getElementById("seccion").style.display = "none";
        document.getElementById("formAcceso").style.display = "none";
        function secciones() {
            var seccion = document.getElementById("seccion");
            var menu = document.getElementsByClassName('menu');
            if (seccion.style.display === "none") {
                seccion.style.display = "block";

            } else {
                seccion.style.display = "none";
            }
        }
        
        function formulario() {
            var form = document.getElementById("formAcceso");
            if (form.style.display === "none") {
                form.style.display = "block";
            } else {
                form.style.display = "none";
            }
        }

        function cerrarAcc(){
            var form = document.getElementById("formAcceso");
            form.style.display = "none";
        }
                
        function showHidePass() {
            var password = document.getElementById("pass");
            var checkbox = document.getElementById("checkpass");
                
            if (checkbox.checked == true) {
                password.type = "text";
            } else {
                password.type = "password";
            }
        }
	</script>
</body>
<footer>
    <marquee><h3 class="title.footer">BIBLIOTECA UCAM</h3></marquee>  
</footer>
</html>
