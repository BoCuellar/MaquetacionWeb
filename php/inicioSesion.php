<?php
  // Cerrar la sesión abierta (Si la hubiera)
  session_start();
  if(isset($_SESSION['correo'])){
    session_destroy();
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="../style.css" />
  </head>
  <body>
    <!-- Header -->
    <!-- Header -->
    <header>
      <!-- Menu movil -->
      <nav class="menuMovil">
        <label for="click">
          <img src="./img/menu.svg" alt="menu" />
        </label>
        <input id="click" type="checkbox" />
        <!-- Menu oculto movil -->
        <section class="menuOculto">
        <ul>
            <li>
              <a href="../index.html">Inicio</a>
            </li>
            <li>
              <a href="../servicios.html">Servicios</a>
            </li>
            <li>
              <a href="../contacto.html">Contacto</a>
            </li>
            <li>
              <a href="../quienessomos.html">¿Quienes somos?</a>
            </li>
            <li>
              <a href="inicioSesion.php">Iniciar Sesión</a>
            </li>
            <li>
              <a href="../registro.html">Registro</a>
            </li>
          </ul>
        </section>
        <!-- menu Escritorio -->
        <section class="menuEscritorio">
          <ul>
            <li>
              <a href="../index.html">Inicio</a>
            </li>
            <li>
              <a href="../servicios.html">Servicios</a>
            </li>
            <li>
              <a href="../contacto.html">Contacto</a>
            </li>
            <li>
              <a href="../quienessomos.html">¿Quienes somos?</a>
            </li>
            <li>
              <a href="inicioSesion.php">Iniciar Sesión</a>
            </li>
            <li>
              <a href="../registro.html">Registro</a>
            </li>
          </ul>
        </section>
        <div class="relleno"></div>
        <a href="../index.html"><img src="../img/logo.svg" alt="logo" /></a>
      </nav>
    </header>
    <!-- Main -->
    <main>
      <form action="iniciarSesion.php" class="formulario" id="formulario" method="post">
        <!-- Grupo: Correo Electronico -->
        <div class="formulario__grupo" id="grupo__correo">
          <div class="formulario__grupo-input">
            <input type="email" class="formulario__input" name="correo" id="correo" placeholder="Correo">
            <i class="formulario__validacion-estado fas fa-times-circle"></i>
          </div>
          <p class="formulario__input-error">Solo letras,numeros,puntos,guiones,guion bajo.</p>
        </div>

        <!-- Grupo: Contraseña -->
        <div class="formulario__grupo" id="grupo__password">
          <div class="formulario__grupo-input">
            <input type="password" class="formulario__input" name="password" id="password" placeholder="Contraseña">
            <i class="formulario__validacion-estado fas fa-times-circle"></i>
          </div>
          <p class="formulario__input-error">La contraseña tiene que ser de 4 a 12 dígitos.</p>
        </div>


          
        <div class="formulario__mensaje" id="formulario__mensaje">
          <p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario correctamente. </p>
        </div>

        <div class="formulario__grupo formulario__grupo-btn-enviar">
          <button type="submit" class="formulario__btn">Entrar</button>
          <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Inicio de sesión</p>
        </div>
        <a href="../registro.html">Pulsa en el link para registrarse</a>
        <!--<script src="./js/formularioInicio.js"></script>
        <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>-->
        
      </form>
    </main>
  </body>
</html>

