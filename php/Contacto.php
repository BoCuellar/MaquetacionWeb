<?php
    include("connection.php");

    // Obtener la conexión de la base de datos
    $conexion = new SQLConnection();

    // Obtener parámetros del formulario
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];	
    $telefono = $_POST['telefono'];
    $texto = $_POST['mensaje']; // Esto es un textarea

    $mensaje = "";

    // Validamos que los campos no estén vacíos
    if (!empty($nombre) && !empty($correo) && !empty($telefono) && !empty($texto)){
        // Validamos que el nombre no tiene numeros
        if (preg_match('/[a-z <]+/i',$nombre)){
            // Validamos que el correo sea válido
            if (preg_match('/([a-z0-9]+)@([a-z]+)\.([a-z]+)/i',$correo)){
                if (preg_match('/[0-9]{9}/i', $telefono)){
                    // Insertamos los datos en la base de datos
                    $consulta = "INSERT INTO contactos (nombres, correo, telefono, mensaje) VALUES (:nombre, :correo, :telefono, :mensaje);";
                    $stmt = $conexion->prepare($consulta);
                    $stmt->bindParam(':nombre', $nombre);
                    $stmt->bindParam(':correo', $correo);
                    $stmt->bindParam(':telefono', $telefono);
                    $stmt->bindParam(':mensaje', $texto);

                    try{
                        // Ejecutamos la consulta preparada
                        $stmt->execute();

                        // Comprobar que la consulta ha sido exitosa
                        $mensaje = "Tu mensaje ha sido enviado correctamente. Esperamos contestarte en breve.";
                    }catch (PDOException $e){ // La consulta fallará sólo si el correo ya existe
                        $mensaje = 'El correo introducido ya ha sido asignado a otro usuario. Inserte otro y vuelva a intentarlo.';
                    }
                }else{
                    $mensaje = 'El teléfono introducido no es válido. Inserte otro y vuelva a intentarlo.';
                }
            }else {
                $mensaje = "El correo introducido debe ser un correo válido. Nuestros correos tienen la forma example@gmail.com";    
            }
        }else{
            $mensaje = 'El nombre introducido no es válido. Los nombres no pueden contener números o caracteres especiales. Inserte otro y vuelva a intentarlo.';
        }
    }else{
        $mensaje = "Los campos no pueden estar vacíos.";
    }
    // Cerrar la conexión con la base de datos
    $conexion = null;
?>

<!-- Sección html del archivo -->
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Contacto</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
    <div class="caja">
    <?php echo "<h3>$mensaje</h3>"; ?>
    <button class="BotonError" type="button" onclick="location.href='../contacto.html';">Volver</button>
</div>
</body>
</html>  