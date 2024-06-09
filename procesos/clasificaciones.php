<?php
require_once "../php/connect.php";

// Eliminar todos los registros existentes en la tabla clasificaciones
$delete_query = "DELETE FROM clasificaciones";
$mysqli->query($delete_query);

// Obtener los nombres de los equipos y sus grupos de la tabla "equipos"
$query_equipos = "SELECT NOMBRE, GRUPO FROM equipos";
$resultado_equipos = $mysqli->query($query_equipos);

// Verificar si se obtuvieron resultados
if ($resultado_equipos && $resultado_equipos->num_rows > 0) {
    // Iterar sobre cada equipo
    while ($fila_equipo = $resultado_equipos->fetch_assoc()) {
        $equipo = $fila_equipo['NOMBRE'];
        $grupo = $fila_equipo['GRUPO'];

        // Consulta SQL para buscar los partidos en los que participó el equipo
        $query_partidos = "SELECT * FROM resultados_partidos 
                           WHERE (EQUIPO_LOCAL = '$equipo' OR EQUIPO_VISITANTE = '$equipo')
                           AND (GOLES_LOCAL IS NOT NULL OR GOLES_VISITANTE IS NOT NULL)";
        $resultado_partidos = $mysqli->query($query_partidos);

        // Inicializar contadores para estadísticas
        $PJ = 0; // Partidos jugados
        $G = 0;  // Partidos ganados
        $E = 0;  // Partidos empatados
        $P = 0;  // Partidos perdidos
        $GF = 0; // Goles a favor
        $GC = 0; // Goles en contra

        // Calcular las estadísticas del equipo para cada partido
        if ($resultado_partidos && $resultado_partidos->num_rows > 0) {
            while ($fila_partido = $resultado_partidos->fetch_assoc()) {
                $goles_local = $fila_partido['GOLES_LOCAL'];
                $goles_visitante = $fila_partido['GOLES_VISITANTE'];

                // Incrementar el contador de partidos jugados
                $PJ++;

                // Actualizar las estadísticas según el resultado del partido
                if ($equipo === $fila_partido['EQUIPO_LOCAL']) {
                    if ($goles_local > $goles_visitante) {
                        $G++;
                    } elseif ($goles_local < $goles_visitante) {
                        $P++;
                    } else {
                        $E++;
                    }
                    $GF += $goles_local;
                    $GC += $goles_visitante;
                } else {
                    if ($goles_visitante > $goles_local) {
                        $G++;
                    } elseif ($goles_visitante < $goles_local) {
                        $P++;
                    } else {
                        $E++;
                    }
                    $GF += $goles_visitante;
                    $GC += $goles_local;
                }
            }
        }

        // Calcular otras estadísticas
        $DG = $GF - $GC; // Diferencia de goles
        $PTS = ($G * 3) + ($E * 1); // Puntos (3 por victoria, 1 por empate)

        // Insertar las estadísticas en la tabla "clasificaciones"
        $insert_query = "INSERT INTO clasificaciones (Grupo, Equipo, PJ, G, E, P, GF, GC, DG, PTS) 
                         VALUES ('$grupo', '$equipo', '$PJ', '$G', '$E', '$P', '$GF', '$GC', '$DG', '$PTS')";
        $mysqli->query($insert_query);
    }
}

// Cerrar la conexión
$mysqli->close();

// Devolver una respuesta exitosa
echo "Actualización de clasificaciones exitosa";
?>
