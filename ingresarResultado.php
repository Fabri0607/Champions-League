<?php

// Iniciar la sesión


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

require_once "php/connect.php";

// Función para generar un ID de partido único
function generarIDPartido($numero_partido)
{
    return  $numero_partido;
}

// Función para generar combinaciones de partidos de ida y vuelta
function generarCombinacionesPartidos($equipos)
{
    $combinaciones = array();
    $num_equipos = count($equipos);
    for ($i = 0; $i < $num_equipos - 1; $i++) {
        for ($j = $i + 1; $j < $num_equipos; $j++) {
            $partido_ida = array($equipos[$i], $equipos[$j]);
            $partido_vuelta = array($equipos[$j], $equipos[$i]);
            $combinaciones[] = array($partido_ida, $partido_vuelta);
        }
    }
    return $combinaciones;
}

// Función para generar una tabla de partidos por grupo
function generarTablaPartidos($grupo, $combinaciones, &$numero_partido)
{
    $html = "<h3>Grupo $grupo</h3>";
    $html .= "<table>
                <thead>
                    <tr>
                        <th>ID Partido</th>
                        <th>Equipo Local</th>
                        <th>Goles Local</th>
                        <th>Equipo Visitante</th>
                        <th>Goles Visitante</th>
                    </tr>
                </thead>
                <tbody>";

    // Generar filas de la tabla para cada combinación de partidos
    foreach ($combinaciones as $combinacion) {

        $id_partido_ida = generarIDPartido($numero_partido++);
        $id_partido_vuelta = generarIDPartido($numero_partido++);
        $equipo_local_ida = $combinacion[0][0];
        $equipo_visitante_ida = $combinacion[0][1];
        $equipo_local_vuelta = $combinacion[1][0];
        $equipo_visitante_vuelta = $combinacion[1][1];
        $html .= "<tr data-id='$id_partido_ida'>
                    <td >$id_partido_ida</td>
                    <td>$equipo_local_ida</td>
                    <td><input type='number' name='goles_local[$id_partido_ida]' values=''></td>
                    <td>$equipo_visitante_ida</td>
                    <td><input type='number' name='goles_visitante[$id_partido_ida]' values='' ></td>
                </tr>";
        $html .= "<tr data-id='$id_partido_vuelta'>
                    <td>$id_partido_vuelta</td>
                    <td>$equipo_local_vuelta</td>
                    <td><input type='number' name='goles_local[$id_partido_vuelta]' values='' ></td>
                    <td>$equipo_visitante_vuelta</td>
                    <td><input type='number' name='goles_visitante[$id_partido_vuelta]' values='' ></td>
                </tr>";
    }

    $html .= "</tbody></table>";
    return $html;
}

// Consulta SQL para obtener todos los equipos por grupo
$query = "SELECT DISTINCT GRUPO FROM equipos";
$resultado = $mysqli->query($query);

// Array para almacenar las combinaciones de partidos por grupo
$combinaciones_por_grupo = array();

// Obtener las combinaciones de partidos por grupo
if ($resultado && $resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $grupo = $fila['GRUPO'];
        // Consulta SQL para obtener los equipos del grupo
        $query_equipos = "SELECT NOMBRE FROM equipos WHERE GRUPO = '$grupo'";
        $resultado_equipos = $mysqli->query($query_equipos);
        $equipos_grupo = array();
        // Obtener los nombres de los equipos del grupo
        if ($resultado_equipos && $resultado_equipos->num_rows > 0) {
            while ($fila_equipo = $resultado_equipos->fetch_assoc()) {
                $equipos_grupo[] = $fila_equipo['NOMBRE'];
            }
            // Generar combinaciones de partidos de ida y vuelta para el grupo
            $combinaciones_por_grupo[$grupo] = generarCombinacionesPartidos($equipos_grupo);
        }
    }
}

// Generar las tablas de partidos por grupo ordenadas de la A a la H
$tablas_partidos_por_grupo = '';
$numero_partido = 1; // Inicializamos el número de partido en 1
for ($i = 65; $i <= 72; $i++) { // Códigos ASCII de A a H
    $grupo = chr($i);
    if (isset($combinaciones_por_grupo[$grupo])) {
        $tablas_partidos_por_grupo .= generarTablaPartidos($grupo, $combinaciones_por_grupo[$grupo], $numero_partido);
    }
}

// Cerrar la conexión
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="<?php echo $session_lifetime; ?>;url=index.html">
    <title>Ingresar Resultados Partidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/ingresarResultados.css">
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
                            <a class="nav-link" href="guardarEquipo.php">Agregar equipo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="sortearGrupo.php">Realizar sorteo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="ingresarResultado.php">Ingresar resultados</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <h2 style="text-align: center;">Partidos por Grupos</h2>
    <div id="tablas" style="text-align: center;">
        <form id="form_resultados">

            <?php echo $tablas_partidos_por_grupo; ?>
            <button id="boton_actualizar" class="button">
                <span class="button-content" onclick="">Actualizar Resultados</span>
            </button>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/ingresarResultado.js"></script>


</body>

</html>