<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registro</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>

  <!-- Grupo: Nombre -->
  <div class="formulario__grupo" id="grupo__nombre">
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="nombre" id="nombre" placeholder="Nombre">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">Letras y espacios, pueden llevar acentos.</p>
			</div>

   
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
    
            
           
            <div class="formulario__grupo formulario__grupo-btn-enviar">
        <button type="submit" class="formulario__btn">Entrar</button>
        <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Inicio de sesión</p>
      </div>

</body>
</html>


    