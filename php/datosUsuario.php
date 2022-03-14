<?php 
    include("connection.php");

    // Obtener la conexión de la base de datos
    $conexion = new SQLConnection();

    // Obtener parámetros de la sesión PHP
    session_start();
    $correo = $_SESSION['correo'];

    // Comprobamos que el usuario ha llegado a la página iniciando sesión
    if(!isset($_SESSION['correo'])){
        header("Location: inicioSesion.php");
    }

    // Insertar datos del usuario en la base de datos
    $consulta = "SELECT * FROM usuarios WHERE correo=:correo;";
    $stmt = $conexion->prepare($consulta);
    $stmt->bindParam(':correo', $correo);

    // Ejecutamos la consulta preparada
    $stmt->execute();

    // Comprobar los resultados de la consulta
    $results = $stmt->fetchall();
    $mensaje = "";

    $input_nombre = "";
    $input_apellido = "";
    $input_correo = "";
    $input_contraseña = "";

    foreach($results as $result){
        $input_nombre = "<input type='text' id='nombre' name='nombre' placeholder='Nombre' value='".$result['nombre']."'";
        $input_apellido = "<input type='text' id='apellido' name='apellido' placeholder='Apellido' value='".$result['apellido']."'";
        $input_correo = "<input type='text' id='correo' name='correo' placeholder='Correo' value='".$result['correo']."'";
        $input_contraseña = "<input type='text' id='contraseña' name='contraseña' placeholder='Contraseña' value='".$result['contraseña']."'";
    }
    // Cerrar la conexión con la base de datos
    $conexion = null;

?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
    
    <section>
        <h3>BIENVENIDO A LOS DATOS DE TU USUARIO</h3>
        <h3> Tus datos: </h3>
        <table>
            <tr>
                <th> Nombre </th>
                <th> Apellido </th>
                <th> Correo </th>
                <th> Constraseña </th>
            </tr>
            <tr>
                <?php 
                    echo "<td> $input_nombre" . "readonly></td>"; // Añadimos readonly a la cadena generadora para que no se pueda editar
                    echo "<td> $input_apellido" . "readonly></td>";
                    echo "<td> $input_correo" . "readonly></td>";
                    echo "<td> $input_contraseña " . "readonly></td>";
                ?>
            </tr>
        </table>
        
        <h3> Modifica tus datos en este formulario: </h3>
        <form action='actualizarUsuario.php' method='post'>
            <table>
                <tr>
                    <th> Nombre </th>
                    <th> Apellido </th>
                    <th> Correo </th>
                    <th> Constraseña </th>
                </tr>
                <tr>
                    <?php 
                        echo "<td> $input_nombre" . "></td>";
                        echo "<td> $input_apellido" . "></td>";
                        echo "<td> $input_correo" . "></td>"; // Con required, no podemos guardar correos vacíos
                        echo "<td> $input_contraseña" . "></td>"; // Con required, no podemos guardar contraseñas vacías
                    ?>
                </tr>
            </table>
            <div>
                <input type="submit" value="Guardar"> 
                <button type="button" onclick="location.href='inicioSesion.php';">Cerrar sesión</button>
            </div>
        </form> 
</section>
</body>
</html>


