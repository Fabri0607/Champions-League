<?php

session_start();
if (!$_SESSION['verificar']) {
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
  <meta name="viewport" content="width=device-width">
  <meta http-equiv="refresh" content="<?php echo $session_lifetime; ?>;url=index.html">
  <title>UEFA Champions League</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="CSS\reset.css">
  <link rel="stylesheet" href="CSS\ingresarSeccion.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
              <a class="nav-link active" aria-current="page" href="ingresarSección.php">Inicio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="gruposPrivada.php">Grupos</a>
            </li>
            <li class="nav-item logout">
              <a class="nav-link" href="logout.php">
                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <main>
    <div class="intro">
      <video controls autoplay playsinline loop src="img/UEFA_Intro.mp4"></video>
    </div>


    <section class="principal">
      <h2 class="titulo-principal">UEFA Champions League</h2>
    </section>

    <section class="productos-est">
      <div class="form-box">
        <h3 class="titulo-principal"></h3>
        <div class="botones-container">
          <ul class="productos">
            <li><button><a href="guardarEquipo.php">Ingresar Equipos</a></button></li>
            <li><button><a href="sortearGrupo.php">Sortear Grupos</a></button></li>
            <li><button><a href="ingresarResultado.php">Ingresar Resultados</a></button></li>
          </ul>
        </div>
      </div>
    </section>

  </main>

  <footer>
    <img class="logo" src="img/Logo_UEFA.png" alt="Logo de UEFA">

    <br>
    <br>

    <div class="redes-sociales">
      <a href="https://twitter.com/championsleague"><img class="logo-redes" src="img/twitter.png" alt="logo-twitter"></a>
      <a href="https://www.instagram.com/championsleague/"><img class="logo-redes" src="img/instagram.png" alt="logo-instagram"></a>
      <a href="https://www.facebook.com/championsleague"><img class="logo-redes" src="img/facebook.png" alt="logo-facebook"></a>
    </div>


    <p class="copyright">&copy Copyright UEFA Champions League - 2024</p>
  </footer>
</body>

</html>