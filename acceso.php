<?php
    //Acceso usuarios registrados
    error_reporting(E_ALL ^ E_NOTICE);
    // Prevenir inyecciones a la base de datos
    $email = $_POST['email'];
    $pass = md5($_POST['password']);

    include("conexion.php");
    // Inicio de variables de sesión
    session_start();
    // Consultas
    $correo=mysqli_query($connect, "SELECT Email FROM usuarios WHERE Email='$email';");
    $comprobar_correo= mysqli_fetch_array($correo);  
    $nombre= mysqli_query($connect, "SELECT nombre FROM usuarios u WHERE u.email='$email' AND u.contrasenia='$pass';") or die(mysqli_error($connect));
    $nombreUsuario= mysqli_fetch_array($nombre);
	$apellidos= mysqli_query($connect, "SELECT apellidos FROM usuarios u WHERE u.email='$email' AND u.contrasenia='$pass';") or die(mysqli_error($connect));
    $apellidosUsuario= mysqli_fetch_array($apellidos);
	$dni= mysqli_query($connect, "SELECT DNI FROM usuarios u WHERE u.email='$email' AND u.contrasenia='$pass';") or die(mysqli_error($connect));
    $dniUsuario= mysqli_fetch_array($dni);
	$fecha_nacimiento= mysqli_query($connect, "SELECT Fecha_de_nacimiento FROM usuarios u WHERE u.email='$email' AND u.contrasenia='$pass';") or die(mysqli_error($connect));
    $fechaNacimiento= mysqli_fetch_array($fecha_nacimiento);
	$fecha_expedicion= mysqli_query($connect, "SELECT Fecha_de_expedicion FROM usuarios u WHERE u.email='$email' AND u.contrasenia='$pass';") or die(mysqli_error($connect));
    $fechaExpedicion= mysqli_fetch_array($fecha_expedicion);
	$fecha_validez= mysqli_query($connect, "SELECT Fecha_de_validez FROM usuarios u WHERE u.email='$email' AND u.contrasenia='$pass';") or die(mysqli_error($connect));
    $fechaValidez= mysqli_fetch_array($fecha_validez);


	$id= mysqli_query($connect, "SELECT id FROM usuarios u WHERE u.email='$email' AND u.contrasenia='$pass';") or die(mysqli_error($connect));
    $idUsuario= mysqli_fetch_array($id);

    $password=mysqli_query($connect, "SELECT contrasenia FROM usuarios WHERE contrasenia='$pass';");
    $comprobar_pass= mysqli_fetch_array($password);
    
//Acceso de administrador:
	
	if (isset($_COOKIE['emailU'])) {
		$_SESSION['email'] = $_COOKIE['emailU'];
		header('location: index.php');
	}else{
		if ($_POST) {
			if (empty($_POST['email']) || empty($_POST['password'])) {
				
			}else{
				if ($_POST['email'] == "bibliotecarioriginal@gmail.com") {
					if ($_POST['password'] == "1234") {
						 
						if ($_POST['remember'] && !empty($_POST['remember'])) {
							setcookie("emailU", $_POST['email'], time()+1576800);
							setcookie("passU", $_POST['password'], time()+1576800);
						}
						$_SESSION['email'] = $_POST['email'];
						echo "<script>alert('👋😀 ¡BIENVENIDO, BIBLIOTECARIO!');</script>";
						echo "<script>window.location = 'admin.php';</script>";

					}else{
					    echo "<script>alert('Contraseña INCORRECTA');</script>";
						echo "<script>window.location = 'index.php'</script>";
					}
				} elseif ($email == $comprobar_correo[0]) {

				    if ($pass == $comprobar_pass[0]) {

                        if ($_POST['remember'] && !empty($_POST['remember'])) {
                            setcookie("emailU", $_POST['email'], time()+1576800);
                            setcookie("passU", $_POST['password'], time()+1576800);
                        }
						
						$_SESSION['id_usuario'] = $idUsuario['id'];
                        $_SESSION['email'] = $_POST['email'];
                        $_SESSION['nombre'] = $nombreUsuario['nombre'];
						$_SESSION['apellidos'] = $apellidosUsuario['apellidos'];
						$_SESSION['DNI'] = $dniUsuario['DNI'];
						$_SESSION['Fecha_de_nacimiento'] = $fechaNacimiento['Fecha_de_nacimiento'];
						$_SESSION['Fecha_de_expedicion'] = $fechaExpedicion['Fecha_de_expedicion'];
						$_SESSION['Fecha_de_validez'] = $fechaValidez['Fecha_de_validez'];

                        include('conexion.php');
                        echo '<script>alert("👋😀 ¡BIENVENID@, '.$_SESSION['nombre'].'!")</script>';
                        echo "<script>window.location = 'biblioteca.php';</script>";
                        
?> 
                        <script type="text/javascript">
                            document.getElementById("usuario").innerHTML = '<?php echo $_SESSION['nombre']; ?>';
                            document.getElementById('salir').innerHTML = 'Salir';
                        </script>
<?php	
				    } else {
						echo "<script>alert('Contraseña INCORRECTA');</script>";
						echo "<script>window.location = 'index.php'</script>";
					}
				} else{
					echo "<script>alert('Correo INCORRECTO');</script>";
					echo '<script>alert("Si ya está registrado, vuelva a intentar acceder ;)")</script>';
					echo "<script>window.location = 'index.php';</script>";
				}
			}
		}else{

			
		}
    }
?>