<?php
// Conexión a la base de datos
require_once "../php/connect.php";

// Consulta SQL para verificar si hay datos en la tabla resultados_equipos
$query = "SELECT COUNT(*) as total FROM resultados_partidos";
$resultado = $mysqli->query($query);

// Verificar si hay datos en la tabla
if ($resultado && $resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
    $total = $fila['total'];
    // Devolver la información en formato JSON
    header('Content-Type: application/json');
    echo json_encode(['total' => $total]);
} else {
    // Si hay un error o no se encontraron datos, devolver un mensaje indicando que no hay datos
    header('Content-Type: application/json');
    echo json_encode(['error' => 'No se encontraron datos en la tabla resultados_equipos']);
}

// Cerrar la conexión a la base de datos
$mysqli->close();
?>

