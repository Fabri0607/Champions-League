<?php
require_once "../php/connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar que se recibieron los datos del formulario
    if (isset($_POST['resultados'])) {
        $resultados = $_POST['resultados'];

        foreach ($resultados as $resultado) {
            // Obtener los datos del resultado del partido
            $id_partido_ida = $resultado['id_partido_ida'];
            $equipo_local_ida = $resultado['equipo_local_ida'];
            $goles_local_ida = $resultado['goles_local_ida'];
            $equipo_visitante_ida = $resultado['equipo_visitante_ida'];
            $goles_visitante_ida = $resultado['goles_visitante_ida'];
            $id_partido_vuelta = $resultado['id_partido_vuelta'];
            $equipo_local_vuelta = $resultado['equipo_local_vuelta'];
            $goles_local_vuelta = $resultado['goles_local_vuelta'];
            $equipo_visitante_vuelta = $resultado['equipo_visitante_vuelta'];
            $goles_visitante_vuelta = $resultado['goles_visitante_vuelta'];

            // Verificar si los campos de goles están vacíos y establecerlos como NULL si es así
            $goles_local_ida = $goles_local_ida !== '' ? $goles_local_ida : null;
            $goles_visitante_ida = $goles_visitante_ida !== '' ? $goles_visitante_ida : null;
            $goles_local_vuelta = $goles_local_vuelta !== '' ? $goles_local_vuelta : null;
            $goles_visitante_vuelta = $goles_visitante_vuelta !== '' ? $goles_visitante_vuelta : null;

            // Insertar datos del partido de ida
            $query_insertar_ida = "INSERT INTO resultados_partidos (ID_PARTIDO, EQUIPO_LOCAL, GOLES_LOCAL, EQUIPO_VISITANTE, GOLES_VISITANTE) VALUES (?, ?, ?, ?, ?)";
            $stmt_ida = $mysqli->prepare($query_insertar_ida);
            $stmt_ida->bind_param("sssss", $id_partido_ida, $equipo_local_ida, $goles_local_ida, $equipo_visitante_ida, $goles_visitante_ida);
            $stmt_ida->execute();
            $stmt_ida->close();

            // Insertar datos del partido de vuelta
            $query_insertar_vuelta = "INSERT INTO resultados_partidos (ID_PARTIDO, EQUIPO_LOCAL, GOLES_LOCAL, EQUIPO_VISITANTE, GOLES_VISITANTE) VALUES (?, ?, ?, ?, ?)";
            $stmt_vuelta = $mysqli->prepare($query_insertar_vuelta);
            $stmt_vuelta->bind_param("sssss", $id_partido_vuelta, $equipo_local_vuelta, $goles_local_vuelta, $equipo_visitante_vuelta, $goles_visitante_vuelta);
            $stmt_vuelta->execute();
            $stmt_vuelta->close();
        }

        echo "Resultados de los partidos guardados correctamente.";
    } else {
        echo "Error: No se recibieron todos los datos necesarios del formulario.";
    }
} else {
    echo "Error: No se recibió una solicitud POST.";
}

// Cerrar la conexión
$mysqli->close();
?>

