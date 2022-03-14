<?php
  include("connection.php");

  // Obtener la conexión de la base de datos
  $conexion = new SQLConnection();

  // Obtener parámetros del formulario
  $contraseña = $_POST['password'];
  $correo = $_POST['correo'];

  $mensaje = "";

  // Validaciones
  if(!empty($correo) && !empty($contraseña)){
    // Validar el correo introducido
    if (preg_match('/([a-z0-9]+)@([a-z]+).([a-z])+/i',$correo)){ // Expresión regular que recoge textoConNumeros@texto.3Letras

      // Insertar datos del usuario en la base de datos
      $consulta = "SELECT * FROM usuarios WHERE correo=:correo AND contraseña=:contrasena;";
      $stmt = $conexion->prepare($consulta);
      $stmt->bindParam(':contrasena', $contraseña);
      $stmt->bindParam(':correo', $correo);

      try{
        // Ejecutamos la consulta preparada
        $stmt->execute();

        // Comprobar los resultados de la consulta
        $results = $stmt->fetchall();
      
        if($stmt->rowCount() > 0){ // Si se reciben resultados, el inicio de sesión fue exitoso
          // Redirigir a datosUsuario.php con el correo por sesión de usuario PHP
          session_start();
          $_SESSION['correo'] = $correo;
          header("Location: datosUsuario.php");  
        }else{ // Si no se reciben, los son incorrectos
          $mensaje = 'Fracaso. Registrate para continuar.';
        }

      }catch(PDOException $ex){
        $mensaje = 'Error en la base de datos: '. $ex->getMessage();
      }

    }else{
      $mensaje = "El correo introducido debe ser un correo válido. Nuestros correos tienen la forma nombre@example.com";
    }
  }else{
    $mensaje = "Los campos del formulario no pueden estar vacíos.";
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
    <link rel="stylesheet" href="../style.css">

<body>

<div class="caja">
    <?php echo "<h3>$mensaje</h3>"; ?>
    <button type="button" onclick="location.href='inicioSesion.php';">Volver</button>
</div>
 
</body>
</html>
