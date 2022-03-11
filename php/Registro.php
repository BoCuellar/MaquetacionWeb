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

    // Validaciones

    // Insertar datos del usuario en la base de datos
    $consulta = "INSERT INTO usuarios (nombre, apellido, contraseña, correo) VALUES (:nombre, :apellido, :contrasena, :correo);";
    $stmt = $conexion->prepare($consulta);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellido', $apellido);
    $stmt->bindParam(':contrasena', $contraseña);
    $stmt->bindParam(':correo', $correo);

    // Ejecutamos la consulta preparada
    $stmt->execute();   

    // Comprobar que la consulta ha sido exitosa
    if ($stmt->rowCount() > 0){
        echo "EXITO!";
        header("Location: inicioSesion.php");
    }else{
        echo 'Hubo un error al insertar el usuario.';
    }

    // Cerrar la conexión con la base de datos
    $conexion = null;
?>