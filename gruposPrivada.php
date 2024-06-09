
<?php
require_once "php/connect.php";

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

function obtenerClasificacionPorGrupo() {
    global $mysqli; 
    // Ordenar por puntos, goles a favor y diferencia de goles
    $query = "SELECT GRUPO, EQUIPO, PJ, G, E, P, GF, GC, DG, PTS 
              FROM clasificaciones 
              ORDER BY GRUPO, PTS DESC, GF DESC, DG DESC"; // Añadimos GF y DG para desempate
    $resultado = $mysqli->query($query);

    if (!$resultado) {
        die("Error en la consulta: " . $mysqli->error);
    }

    $clasificacion_por_grupo = array();
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $grupo = $fila['GRUPO'];
            if (!isset($clasificacion_por_grupo[$grupo])) {
                $clasificacion_por_grupo[$grupo] = array();
            }
            $clasificacion_por_grupo[$grupo][] = array(
                'equipo' => $fila['EQUIPO'],
                'pj' => $fila['PJ'],
                'g' => $fila['G'],
                'e' => $fila['E'],
                'p' => $fila['P'],
                'gf' => $fila['GF'],
                'gc' => $fila['GC'],
                'dg' => $fila['DG'],
                'pts' => $fila['PTS']
            );
        }
    }
    return $clasificacion_por_grupo;
}

function generarTablasClasificacion($clasificacion_por_grupo) {
    $html = '';

    foreach ($clasificacion_por_grupo as $grupo => $equipos) {
        $html .= "<div class='grupo-clasificacion'>";
        $html .= "<h3>Grupo $grupo</h3>";
        $html .= "<table><thead><tr>
                    <th>Posición</th> 
                    <th>Equipo</th>
                    <th>PJ</th>
                    <th>G</th>
                    <th>E</th>
                    <th>P</th>
                    <th>GF</th>
                    <th>GC</th>
                    <th>DG</th>
                    <th>PTS</th>
                  </tr></thead><tbody>";

        // Índice para la posición de cada equipo
        $posicion = 1;
        foreach ($equipos as $equipo) { 
            $html .= "<tr>
                        <td>{$posicion}</td> <!-- Mostrar la posición -->
                        <td>{$equipo['equipo']}</td>
                        <td>{$equipo['pj']}</td>
                        <td>{$equipo['g']}</td>
                        <td>{$equipo['e']}</td>
                        <td>{$equipo['p']}</td>
                        <td>{$equipo['gf']}</td>
                        <td>{$equipo['gc']}</td>
                        <td>{$equipo['dg']}</td>
                        <td>{$equipo['pts']}</td>
                      </tr>";

            // Incrementar la posición
            $posicion++;
        }

        $html .= "</tbody></table>";
        $html .= "</div>";
    }

    return $html;
}



// Obtener la clasificación por grupo
$clasificacion_por_grupo = obtenerClasificacionPorGrupo();

// Generar las tablas de clasificación por grupo
$tablas_clasificacion = generarTablasClasificacion($clasificacion_por_grupo);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Clasificación por Grupos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/tablasClasificaciones.css">
    <link rel="stylesheet" href="CSS\styleIndex.css">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #000040; margin-top: 0; padding-top: 0px; padding-bottom: 15px;">
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
                        <a class="nav-link active" href="gruposPublica.php">Grupos</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
    <h2>Clasificación por Grupos</h2>
    <div class="tablas-clasificacion-container">
        <?php echo $tablas_clasificacion; ?>
    </div>
    <footer>
        <img class = "logo" src="img/Logo_UEFA.png" alt="Logo de UEFA CHAMPIONS LEAGUE.">

        <br>
        <br>
        
        <div class="redes-sociales">
            <a href="https://twitter.com/championsleague"><img class = "logo-redes" src="img/twitter.png" alt="logo-twitter"></a>  
            <a href="https://www.instagram.com/championsleague/"><img class = "logo-redes" src="img/instagram.png" alt="logo-instagram"></a>
            <a href="https://www.facebook.com/championsleague"><img class = "logo-redes" src="img/facebook.png" alt="logo-facebook"></a>
        </div>


        <p class="copyright">&copy Copyright UEFA Champions League - 2024</p>
    </footer>
</body>
</html>
