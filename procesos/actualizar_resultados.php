<?php
require_once "../php/connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar que se recibieron los datos del formulario
    if(isset($_POST['resultados'])) {
        $resultados = $_POST['resultados'];

        foreach($resultados as $resultado) {
            $id_partido_ida = $resultado['id_partido_ida'];
            $goles_local_ida = $resultado['goles_local_ida'];
            $goles_visitante_ida = $resultado['goles_visitante_ida'];
            $id_partido_vuelta = $resultado['id_partido_vuelta'];
            $goles_local_vuelta = $resultado['goles_local_vuelta'];
            $goles_visitante_vuelta = $resultado['goles_visitante_vuelta'];

           // Verificar si los campos de goles están vacíos y establecerlos como NULL si es así
           $goles_local_ida = $goles_local_ida !== '' ? $goles_local_ida : null;
           $goles_visitante_ida = $goles_visitante_ida !== '' ? $goles_visitante_ida : null;
           $goles_local_vuelta = $goles_local_vuelta !== '' ? $goles_local_vuelta : null;
           $goles_visitante_vuelta = $goles_visitante_vuelta !== '' ? $goles_visitante_vuelta : null;                  

            // Actualizar datos del partido de ida
            $query_actualizar_ida = "UPDATE resultados_partidos SET GOLES_LOCAL = ?, GOLES_VISITANTE = ? WHERE ID_PARTIDO = ?";
            $stmt_ida = $mysqli->prepare($query_actualizar_ida);
            $stmt_ida->bind_param("iii", $goles_local_ida, $goles_visitante_ida, $id_partido_ida);
            $stmt_ida->execute();
            $stmt_ida->close();

            // Actualizar datos del partido de vuelta
            $query_actualizar_vuelta = "UPDATE resultados_partidos SET GOLES_LOCAL = ?, GOLES_VISITANTE = ? WHERE ID_PARTIDO = ?";
            $stmt_vuelta = $mysqli->prepare($query_actualizar_vuelta);
            $stmt_vuelta->bind_param("iii", $goles_local_vuelta, $goles_visitante_vuelta, $id_partido_vuelta);
            $stmt_vuelta->execute();
            $stmt_vuelta->close();
        }

        echo "Resultados de los partidos actualizados correctamente.";
    } else {
        echo "Error: No se recibieron todos los datos necesarios del formulario.";
    }
} else {
    echo "Error: No se recibió una solicitud POST.";
}

// Cerrar la conexión
$mysqli->close();
?>
