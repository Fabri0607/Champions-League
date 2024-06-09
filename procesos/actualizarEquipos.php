<?php
require_once "../php/connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el ID del equipo y el nuevo grupo desde la solicitud POST
    $idEquipo = $_POST["idEquipo"];
    $grupo = $_POST["grupo"];

    // Actualizar el grupo en la base de datos
    $query = "UPDATE equipos SET GRUPO='$grupo' WHERE ID_EQUIPO=$idEquipo";
    $resultado = $mysqli->query($query);

    if ($resultado) {
        echo "Grupo actualizado correctamente en la base de datos.";
    } else {
        echo "Error al actualizar el grupo en la base de datos.";
    }
}

$mysqli->close();
?>
