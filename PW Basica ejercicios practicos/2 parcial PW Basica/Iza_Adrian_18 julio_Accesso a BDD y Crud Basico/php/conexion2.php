<?php
  session_start();
   
  // Obtengo los datos cargados en el formulario de login.
  $user = $_POST['usuario'];
  $clave = $_POST['password'];
   
  // Datos para conectar a la base de datos.
  $nombreServidor = "localhost";
  $nombreUsuario = "admin";
  $passwordBaseDeDatos = "admin";
  $nombreBaseDeDatos = "programacion";
  
  // Crear conexión con la base de datos.
  $conn = new mysqli($nombreServidor, $nombreUsuario, $passwordBaseDeDatos, $nombreBaseDeDatos);
   
  // Validar la conexión de base de datos.
  if ($conn ->connect_error) {
    die("Connection failed: " . $conn ->connect_error);
  }
 
   // Consulta a la base de datos.
  $query = "SELECT * FROM pr_usuarios WHERE usu_user='$user' AND usu_clave='$clave'";
  $resultado = mysqli_query($conn,$query);
  //Verifica que la consulta se realizo con o sin coincidencias en la base 
  if($resultado){
	  
    // Verificando si el usuario existe en la base de datos, cuenta los registros que cumplen con las condiciones (usuario y password).
	$row = mysqli_fetch_array($resultado); 
	if($row>0){
    	// Guardo en la sesión el email del usuario.
    	$_SESSION['user'] = $user;
    	// Redirecciono al usuario a la página principal del sitio.
       	header("Location: ../html/index2.html");
	   }
   else
	   {
        echo 'El usuario o password es incorrecto, INGRESE LOS DATOS NUEVAMENTE, <a href="../login.html">vuelva a intenarlo</a>.<br/>';}
  }
?>