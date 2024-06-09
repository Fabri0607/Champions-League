<?php

	session_start();
	if(!$_SESSION['verificar']){
		header("Location: index.html");
	}

    $session_lifetime = 600; // 10 minutos en segundos

    // Verificar si la sesión ha expirado debido a la inactividad
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $session_lifetime)) {
        // Destruir la sesión
        session_unset();
        session_destroy();

        // Redirigir a index.html
        header("Location: index.html");
        exit; // Detener la ejecución del script después de redirigir
    }

    // Actualizar la última actividad de la sesión
    $_SESSION['last_activity'] = time();

?>


<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="refresh" content="<?php echo $session_lifetime; ?>;url=index.html">
	<title>Guardar Equipo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<link href="CSS\styleGuardarEquipo.css" rel=stylesheet></link>
	<link rel="stylesheet" href="CSS\styleIndex.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #000040; margin-top: 0; padding-top: 0px; padding-bottom: 15px;">
            <div class="container-fluid">
            <a class="navbar-brand" href="index.html">
                <img src="img/Logo_UEFA.png" alt="Logo de la UEFA Champions League" width="100" height="100" class="d-inline-block align-text-top">
              </a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="ingresarSección.php">Inicio</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" href="guardarEquipo.php">Agregar equipo</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="sortearGrupo.php">Realizar sorteo</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="ingresarResultado.php">Ingresar resultados</a>
                  </li>
                </ul>
              </div>
            </div>
        </nav>
    </header>
	
<div class="inicio">
	<div class="centro">
	<!-- Aquí se mostrará el mensaje de éxito o error -->
	<div id="mensaje"></div>
    <form id="formulario" method="POST">
      <div class="etiqueta">Registrar Equipo</div><br><br>
      <input id="nombre" class="cuadro-texto-sin-img" type="text" name="nombre" placeholder="Nombre" required><br><br>
      <input id="pais" class="cuadro-texto-sin-img" type="text" name="pais" placeholder="Pais" required><br><br>
      
      <label class="button">
        <input type="button" class="input-button" value="Guardar" onclick="enviarFormulario()">
        <span class="button-content">Guardar</span>
      </label>

    </form>
	</div>
</div>
<script src="js/guardarEquipo.js"></script>
</body>
</html>