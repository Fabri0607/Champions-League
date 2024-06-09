<?php
// Conexión a la base de datos
require_once "../php/connect.php";

// Consulta SQL para obtener los resultados de los partidos
$query = "SELECT ID_PARTIDO, GOLES_LOCAL ,GOLES_VISITANTE FROM `resultados_partidos`;";
$resultado = $mysqli->query($query);

// Array para almacenar los resultados
$resultados = array();

// Obtener los resultados de la consulta
if ($resultado && $resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        // Agregar los resultados al array
        $resultados[] = array(
            'id_partido' => $fila['ID_PARTIDO'],
            'goles_locales' => $fila['GOLES_LOCAL'],
            'goles_visitante' => $fila['GOLES_VISITANTE']
        );
    }
}

// Cerrar la conexión a la base de datos
$mysqli->close();

header('Content-Type: application/json');
echo json_encode($resultados);
?>
