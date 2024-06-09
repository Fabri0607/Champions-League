<?php
    require_once "../php/connect.php";

    // Consulta SQL para obtener todos los equipos
    $query = "SELECT * FROM equipos ORDER BY GRUPO";
    $consulta = $mysqli->query($query);

    $equipos = array(); // Array para almacenar los equipos

    if ($consulta->num_rows > 0) {
        while ($fila = $consulta->fetch_assoc()) {
            // Agregar cada fila de equipo al array con todos los parámetros
            $equipo = array(
                'ID_EQUIPO' => $fila['ID_EQUIPO'],
                'NOMBRE' => $fila['NOMBRE'],
                'PAIS' => $fila['PAIS'],
                'GRUPO' => $fila['GRUPO']
            );
            $equipos[] = $equipo;
        }
    }

    // Cerrar la conexión a la base de datos
    $mysqli->close();

    // Convertir el array de equipos a formato JSON y devolverlo
    echo json_encode($equipos);
?>
