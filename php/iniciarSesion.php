<?php
  include("connection.php");

  // Obtener la conexión de la base de datos
  $conexion = new SQLConnection();

  // Obtener parámetros del formulario
  $contraseña = $_POST['password'];
  $correo = $_POST['correo'];

  // Insertar datos del usuario en la base de datos
  $consulta = "SELECT * FROM usuarios WHERE correo=:correo AND contraseña=:contrasena;";
  $stmt = $conexion->prepare($consulta);
  $stmt->bindParam(':contrasena', $contraseña);
  $stmt->bindParam(':correo', $correo);

  $mensaje = "";

  try{
    // Ejecutamos la consulta preparada
    $stmt->execute();

    // Comprobar los resultados de la consulta
    $results = $stmt->fetchall();
  
    if($stmt->rowCount() > 0){
      // Redirigir a datosUsuario.php con el correo por sesión de usuario PHP
      session_start();
      $_SESSION['correo'] = $correo;
      header("Location: datosUsuario.php");  
    }else{
      $mensaje = 'Fracaso. Registrate para continuar.';
    }
    


  }catch(PDOException $ex){
    $mensaje = 'Error en la base de datos: '. $ex->getMessage();
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
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
  <!-- Header -->
  <header>

      
  </header>
  <!-- Main -->
  <main>
    <?php echo "<h3>$mensaje</h3>"; ?>
    <button type="button" onclick="location.href='inicioSesion.php';">Volver</button>
 </main>
</body>
</html>
