<?php
    include("connection.php");

    // Obtener la conexión de la base de datos
    $conexion = new SQLConnection();

    // Obtener parámetros del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $contraseña = $_POST['password'];
    $contraseña2 = $_POST['password2'];
    $correo = $_POST['correo'];

    $mensaje = "";

    // Validaciones
    // Validar que se han enviado todos los datos necesarios
    if(!empty($nombre) && !empty($apellido) && !empty($contraseña) && !empty($contraseña2) && !empty($correo)){
        // Validar que las contraseñas coincidan
        if ($contraseña == $contraseña2){
            // Validar que el nombre y apellidos solo contienen letras
            if ((!preg_match('/[^a-z]/i', $nombre) && !preg_match('/[^a-z]/i',$apellido))){ // [a-zA-Z ]+ --> Al menos una letra minuscula o mayuscula
                // Validar el correo introducido
                if (preg_match('/([a-z0-9]+)@([a-z]+)\.([a-z]+)/i',$correo)){ // Expresión regular que recoge textoConNumeros@texto.letras
                    // Insertar datos del usuario en la base de datos
                    $consulta = "INSERT INTO usuarios (nombre, apellido, contraseña, correo) VALUES (:nombre, :apellido, :contrasena, :correo);";
                    $stmt = $conexion->prepare($consulta);
                    $stmt->bindParam(':nombre', $nombre);
                    $stmt->bindParam(':apellido', $apellido);
                    $stmt->bindParam(':contrasena', $contraseña);
                    $stmt->bindParam(':correo', $correo);

                    try{
                        // Ejecutamos la consulta preparada
                        $stmt->execute();   

                        // Comprobar que la consulta ha sido exitosa
                        header("Location: inicioSesion.php"); // Si hay éxito, redirijo a la pantalla de inicio
                    }catch (PDOException $e){ // La consulta fallará sólo si el correo ya existe
                        $mensaje = 'El correo introducido ya ha sido asignado a otro usuario. Inserte otro y vuelva a intentarlo.';
                    }    
                }else{
                    $mensaje = "El correo introducido debe ser un correo válido. Nuestros correos tienen la forma nombre@example.com";
                }
            }else{ // Si el nombre o el apellido contienen numeros o caracteres especiales
                $mensaje = "El nombre y apellido solo pueden contener letras.";
            }
        }else{ // Si las contraseñas no coinciden
            $mensaje = "Las contraseñas deben ser iguales";
        }
    }else{ // Si algún campo se encuentra vacío
        $mensaje = "Los campos del formulario no pueden estar vacíos por favor, rellena todos.";
    }

    // Cerrar la conexión con la base de datos
    $conexion = null;
?>

<!-- Sección html del archivo -->
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
    <div class="caja">
    <?php echo "<h3>$mensaje</h3>"; ?>
    <button class="BotonError" type="button" onclick="location.href='../registro.html';">Volver</button>
</div>
</body>
</html>  