<?php
    // Incluir el archivo de conexión
    include('connection.php');

    // Obtener la conexión con la base de datos
    $conexion = new SQLConnection();

    // Obtener los parámetros de la sesión de usuario
    session_start();
    $correo = $_SESSION['correo'];

     // Comprobamos que el usuario ha llegado a la página iniciando sesión
     if(!isset($_SESSION['correo'])){
        header("Location: inicioSesion.php");
    }

    // Obtener los parámetros del formulario (método POST)
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo2 = $_POST['correo'];
    $contrasena = $_POST['contraseña'];

    // Validaciones (comprobar que el nuevo correo no está ocupado)

    // Preparar la consulta de actualización
    $consulta = "UPDATE usuarios SET nombre=:nombre, apellido=:apellido, correo=:correo2, contraseña=:contrasena WHERE correo=:correo";
    $stmt = $conexion->prepare($consulta);
    $stmt->bindParam('nombre',$nombre);
    $stmt->bindParam('apellido',$apellido);
    $stmt->bindParam('correo2',$correo2);
    $stmt->bindParam('contrasena',$contrasena);
    $stmt->bindParam('correo',$correo);

    $mensaje = "";
    try{
        // Ejecutamos la consulta
        $stmt->execute();

        $mensaje = "Se han actualizado los datos del usuario $correo correctamente."; 
    }catch(PDOException $ex){
        $mensaje = "Hubo un error al actualizar los datos del usuario $correo. Error: ".$ex->getMessage();
    }

    // Cerrar la conexión con la base de datos
    $conexion = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ActualizarUsuario</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
  <!-- Header -->
  <header>

      
  </header>
  <!-- Main -->
  <main>
    <?php 
        echo "<h3>$mensaje</h3>"; 
    ?>
    <button type="button" onclick="location.href='datosUsuario.php';">Volver</button>
 </main>
</body>
</html>
