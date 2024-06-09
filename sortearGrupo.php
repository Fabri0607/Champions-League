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
    <meta http-equiv="refresh" content="<?php echo $session_lifetime; ?>;url=index.html">
    <title>Sortear Grupos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/sorteo.css">
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
                            <a class="nav-link active" href="sortearGrupo.php">Realizar sorteo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="ingresarResultado.php">Ingresar resultados</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div id="cabeza" style="text-align: center;">
        <h2>Equipos</h2>
        <label id="label-asignar-grupos" class="button" for="boton-asignar-grupos" style="display: none;">
            <button id="boton-asignar-grupos" style="display: none;" class="input-button" onclick="mezclarYActualizar()"></button>
            <div id="texto-asignar-grupos" style="display: none;" class="button-content">Asignar Grupos</div>
        </label>
        <label id="label-organizar-grupos" class="button" for="boton-organizar-grupos" style="display: none;">
            <button id="boton-organizar-grupos" style="display: none;" class="input-button" onclick="actualizarEquiposPorGrupos()"></button>
            <div id="texto-organizar-grupos" style="display: none;" class="button-content">Ordenar Grupos</div>
        </label>
    </div>
    <div class="d-flex justify-content-center mt-3">
        <div id="mensaje-sorteo" class="alert alert-success w-50 d-none" role="alert"></div>
    </div>
    <div class="contenedor-tabla">
        <table id="tabla-equipos">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>País</th>
                    <th>Grupo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once "php/connect.php";

                // Consulta SQL para obtener todos los equipos
                $query = "SELECT * FROM equipos";
                $consulta = $mysqli->query($query);

                if ($consulta->num_rows > 0) {
                    while ($fila = $consulta->fetch_assoc()) {
                        echo "<tr>
                                    <td>" . $fila['ID_EQUIPO'] . "</td>
                                    <td>" . $fila['NOMBRE'] . "</td>
                                    <td>" . $fila['PAIS'] . "</td>
                                    <td>" . $fila['GRUPO'] . "</td>
                                </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No se encontraron equipos.</td></tr>";
                }

                $mysqli->close();
                ?>
            </tbody>
        </table>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/sorteargrupo.js"></script>
    <script>
        // Función para verificar si hay equipos sin grupo y mostrar el botón correspondiente
        function verificarEquiposSinGrupo() {
            var filas = document.querySelectorAll('.contenedor-tabla table tbody tr');
            var tieneGrupoNulo = false;
            for (var i = 0; i < filas.length; i++) {
                var grupo = filas[i].getElementsByTagName('td')[3].textContent;
                if (grupo === "") {
                    tieneGrupoNulo = true;
                    break;
                }
            }
            if (tieneGrupoNulo) {
                document.getElementById('boton-asignar-grupos').style.display = 'inline-block';
                document.getElementById('texto-asignar-grupos').style.display = 'inline-block';
                document.getElementById('label-asignar-grupos').style.display = 'inline-block';
            } else {
                document.getElementById('boton-organizar-grupos').style.display = 'inline-block';
                document.getElementById('texto-organizar-grupos').style.display = 'inline-block';
                document.getElementById('label-organizar-grupos').style.display = 'inline-block';
            }
        }
        window.onload = function() {
            verificarEquiposSinGrupo();
        };
    </script>

</body>

</html>