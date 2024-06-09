<?php
require_once '../php/connect.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // obtiene los valores del formulario
    $idEquipo = $_POST["idEquipo"];
    $pj = $_POST["PJ"] ?? null;
    $g = $_POST["G"] ?? null;
    $e = $_POST["E"] ?? null;
    $p = $_POST["P"] ?? null;
    $gf = $_POST["GF"] ?? null;
    $gc = $_POST["GC"] ?? null;
    $dg = $_POST["DG"] ?? null;
    $pts = $_POST["PTS"] ?? null;

    // consulta de actualización
    $setClause = [];
    if ($pj !== null) {
        $setClause[] = "PJ = $pj";
    }
    if ($g !== null) {
        $setClause[] = "G = $g";
    }
    if ($e !== null) {
        $setClause[] = "E = $e";
    }
    if ($p !== null) {
        $setClause[] = "P = $p";
    }
    if ($gf !== null) {
        $setClause[] = "GF = $gf";
    }
    if ($gc !== null) {
        $setClause[] = "GC = $gc";
    }
    if ($dg !== null) {
        $setClause[] = "DG = $dg";
    }
    if ($pts !== null) {
        $setClause[] = "PTS = $pts";
    }

    $setQuery = implode(", ", $setClause);

    $query = "UPDATE clasificaciones SET $setQuery WHERE ID_EQUIPO = $idEquipo";

    // Ejecuta la consulta de actualización
    if ($mysqli->query($query)) {
        echo "Clasificación actualizada correctamente.";
    } else {
        echo "Error al actualizar la clasificación: " . $mysqli->error;
    }

    // Cerrar la conexión
    $mysqli->close();
}
