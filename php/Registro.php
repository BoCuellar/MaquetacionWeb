<?php// Comprobar si se ha enviado el formulario:
    if( !empty($_POST) )
    {
        echo "FORMULARIO RECIBIDO:<br/>";
        echo "====================<p/>";
        // Mostrar la información recibida del formulario:
        print_r( $_POST );
        echo "<hr/>";
        // Comprobar si llegaron los campos requeridos:
         if( isset($_POST['nombre']) && isset($_POST['apellido']) )
        {
            // Nombre:
             if( empty($_POST['nombre']) )
                $aErrores[] = "Debe especificar el nombre";
            else
            {
                // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
                 if( preg_match($patron_texto, $_POST['nombre']) )
                    $aMensajes[] = "Nombre: [".$_POST['nombre']."]";
                else
                    $aErrores[] = "El nombre sólo puede contener letras y espacios";
            }
            // Apellidos:
            if( empty($_POST['apellidos']) )
                $aErrores[] = "Debe especificar los apellidos";
            else
            {
                // Comprobar mediante una expresión regular, que sólo contienen letras y espacios:
                if( preg_match($patron_texto, $_POST['appellido']) )
                    $aMensajes[] = "Apellidos: [".$_POST['apellido']."]";
                else
                    $aErrores[] = "Los apellidos sólo pueden contener letras y espacios";
            }
        
        else
        {
            echo "<p>No se han especificado todos los datos requeridos.</p>";
        }
        // Si han habido errores se muestran, sino se mostrán los mensajes
         if( count($aErrores) > 0 )
        {
            echo "<p>ERRORES ENCONTRADOS:</p>";
            // Mostrar los errores:
            for( $contador=0; $contador < count($aErrores); $contador++ )
                echo $aErrores[$contador]."<br/>";
        }
        else
        {
            // Mostrar los mensajes:
            for( $contador=0; $contador < count($aMensajes); $contador++ )
                echo $aMensajes[$contador]."<br/>";
        }
    }
    else
    {
        echo "<p>No se ha enviado el formulario.</p>";
    }
    echo "<p><a href='registro.html'>Haz clic aquí para volver al formulario</a></p>";
?>