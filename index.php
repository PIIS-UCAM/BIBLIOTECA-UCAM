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
</head>
<body id="indexBody"> 
    <div class="borderForm">
        <!-- Formulario de acceso-->
        <form id="formAcceso" name="form" action="acceso.php" method="post">
            <a href="javascript:cerrarAcc()" style="float: right; padding-right: 5px; color: black">x</a>
            <h1 style="margin-top: 5px;"><u>Acceso</u>:</h1>
            <input style="width: 125px; " placeholder="Correo" required name="email" type="email" value="" /><br>
            <input style="width: 125px; background-color: transparent;" placeholder="Contraseña" required name="password" type="password" value=""/><br>
            <input name="remember" type="checkbox" value="rememberYES"><label style="color: gold;">Recuérdame</label><br>
            <input type="submit" style="background-color: transparent; font-weight: bold;" name="enviar" value="Entrar"/><br>
            <a style="font-size: 12px; color: #00427b;" href="registro.php"><b>¿<u>No estás registrado</u>?</b></a><br>
            <a style="font-size: 12px; color: #00427b;" href="olvidado.php">¿<u>Has olvidado tu contraseña</u>?</a>
        </form>
    </div>

	<script type="text/javascript">
        document.getElementById("acceso").innerHTML = '<?php echo "Hola "; ?>';
        document.getElementById("usuario").innerHTML = '<?php session_start(); echo $_SESSION['usuario']; ?>';
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
