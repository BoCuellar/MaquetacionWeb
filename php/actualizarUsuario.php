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

    $mensaje = "";

    // Validaciones
    if (!empty($nombre) && !empty($apellido) && !empty($correo2) && !empty($contrasena)){
        // Validar el correo introducido
        if (preg_match('/([a-z0-9]+)@([a-z]+)\.([a-z]+)/i',$correo2)){ // Expresión regular que recoge textoConNumeros@texto.3Letras
            // Validar que el nombre y apellido solo contienen letras
            if (!preg_match('/[^a-z]/i', $nombre) && !preg_match('/[^a-z]/i',$apellido)){
                // Preparar la consulta de actualización y validar que el nuevo correo no existe 
                $consulta = "UPDATE usuarios SET nombre=:nombre, apellido=:apellido, correo=:correo2, contraseña=:contrasena WHERE correo=:correo";
                $stmt = $conexion->prepare($consulta);
                $stmt->bindParam('nombre',$nombre);
                $stmt->bindParam('apellido',$apellido);
                $stmt->bindParam('correo2',$correo2);
                $stmt->bindParam('contrasena',$contrasena);
                $stmt->bindParam('correo',$correo);
                
                try{
                    // Ejecutamos la consulta
                    $stmt->execute();

                    $mensaje = "Se han actualizado los datos del usuario $correo correctamente."; 
                }catch(PDOException $ex){ // Si la consulta lanza una excepción es porque el nuevo correo ya existe en la BBDD.
                    $mensaje = "El correo introducido ya ha sido asignado a otro usario. Por favor, elija otro.";
                }
            }else{ // Si el nombre o el apellido contien caracteres distintos a letras
                $mensaje = "El nombre y apellido solo pueden contener letras.";
            }
        }else{ // Si el correo introducido no es un correo aceptable
            $mensaje = "El correo introducido debe ser un correo válido. Nuestros correos tienen la forma nombre@example.com";
        }
    }else{ // Si algún campo se encuentra vacío
        $mensaje = "Todos los campos del formulario son obligatios, por favor rellene los campos vacíos.";
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
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<div class ="caja">
    <?php 
        echo "<h3>$mensaje</h3>"; 
    ?>
    <button type="button" onclick="location.href='datosUsuario.php';">Volver</button>
</div>
</body>
</html>
