$(document).ready(function() {
    // Hacer una solicitud AJAX para verificar si hay datos en la tabla resultados_equipos
    $.ajax({
        type: 'GET',
        url: 'procesos/verificar_datos.php',
        dataType: 'json',
        success: function(response) {
            if (response && response.total > 0) {
                // Si hay datos, llamar a la función actualizarPagina para cargar los resultados automáticamente
                actualizarPagina();
            } else {
                guardar();
                console.log("No hay datos en la tabla resultados_equipos.");
            }
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });

    // Manejar el evento click del botón de actualizar
    $('#boton_actualizar').click(function() {
        actualizar();
        return false; // Evitar la recarga de la página
    });
});
function guardar() {
    var filas = document.querySelectorAll('#tablas table tbody tr');
    var data = [];
    for (var i = 0; i < filas.length; i += 2) {
        var id_partido_ida = filas[i].getElementsByTagName('td')[0].textContent;
        var equipo_local_ida = filas[i].getElementsByTagName('td')[1].textContent;
        var goles_local_ida = filas[i].getElementsByTagName('input')[0].value;
        var equipo_visitante_ida = filas[i].getElementsByTagName('td')[3].textContent;
        var goles_visitante_ida = filas[i].getElementsByTagName('input')[1].value;
        var id_partido_vuelta = filas[i + 1].getElementsByTagName('td')[0].textContent;
        var equipo_local_vuelta = filas[i + 1].getElementsByTagName('td')[1].textContent;
        var goles_local_vuelta = filas[i + 1].getElementsByTagName('input')[0].value;
        var equipo_visitante_vuelta = filas[i + 1].getElementsByTagName('td')[3].textContent;
        var goles_visitante_vuelta = filas[i + 1].getElementsByTagName('input')[1].value;

        // Verificar si se han ingresado valores para los goles
        // Si no se ha ingresado ningún valor, enviar NULL al servidor
        if (goles_local_ida === '') goles_local_ida = null;
        if (goles_visitante_ida === '') goles_visitante_ida = null;
        if (goles_local_vuelta === '') goles_local_vuelta = null;
        if (goles_visitante_vuelta === '') goles_visitante_vuelta = null;

        data.push({
            'id_partido_ida': id_partido_ida,
            'equipo_local_ida': equipo_local_ida,
            'goles_local_ida': goles_local_ida,
            'equipo_visitante_ida': equipo_visitante_ida,
            'goles_visitante_ida': goles_visitante_ida,
            'id_partido_vuelta': id_partido_vuelta,
            'equipo_local_vuelta': equipo_local_vuelta,
            'goles_local_vuelta': goles_local_vuelta,
            'equipo_visitante_vuelta': equipo_visitante_vuelta,
            'goles_visitante_vuelta': goles_visitante_vuelta
        });
    }
    $.ajax({
        type: 'POST',
        url: 'procesos/guardar_resultados.php',
        data: { resultados: data },
        success: function(response) {
            console.log(response);
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log("procesos/clasificaciones.php ejecutado exitosamente");
                }
            };
            xhttp.open("GET", "procesos/clasificaciones.php", true);
            xhttp.send();
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
   
}


function actualizar() {
    var filas = document.querySelectorAll('#tablas table tbody tr');
    var data = [];
    for (var i = 0; i < filas.length; i += 2) {
        var id_partido_ida = filas[i].getElementsByTagName('td')[0].textContent;
        var goles_local_ida = filas[i].getElementsByTagName('input')[0].value;
        var goles_visitante_ida = filas[i].getElementsByTagName('input')[1].value;
        var id_partido_vuelta = filas[i+1].getElementsByTagName('td')[0].textContent;
        var goles_local_vuelta = filas[i+1].getElementsByTagName('input')[0].value;
        var goles_visitante_vuelta = filas[i+1].getElementsByTagName('input')[1].value;

        if (goles_local_ida === '') goles_local_ida = null;
        if (goles_visitante_ida === '') goles_visitante_ida = null;
        if (goles_local_vuelta === '') goles_local_vuelta = null;
        if (goles_visitante_vuelta === '') goles_visitante_vuelta = null;

        data.push({
            'id_partido_ida': id_partido_ida,
            'goles_local_ida': goles_local_ida,
            'goles_visitante_ida': goles_visitante_ida,
            'id_partido_vuelta': id_partido_vuelta,
            'goles_local_vuelta': goles_local_vuelta,
            'goles_visitante_vuelta': goles_visitante_vuelta
        });
    }

    $.ajax({
        type: 'POST',
        url: 'procesos/actualizar_resultados.php',
        data: { resultados: data },
        success: function(response) {
            alert("Resultados actualizados correctamente.");
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log("procesos/clasificaciones.php ejecutado exitosamente");
                }
            };
            xhttp.open("GET", "procesos/clasificaciones.php", true);
            xhttp.send();
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
   
}


function actualizarPagina() {
    // Hacer una solicitud AJAX para obtener los resultados de la base de datos
    $.ajax({
        type: 'GET',
        url: 'procesos/obtener_resultados.php',
        dataType: 'json',
        success: function(response) {
            response.forEach(function(resultado) {
                var idPartido = resultado.id_partido;
                var golesLocal = resultado.goles_locales;
                var golesVisitante = resultado.goles_visitante;
                // Actualizar los valores de los goles locales y visitantes en las tablas
                var filas = document.querySelectorAll('#tablas table tbody tr');
                filas.forEach(function(fila) {
                    var idPartidoFila = fila.querySelector('td:nth-child(1)').textContent;
                    if (idPartidoFila === idPartido) {
                        // Verificar si los elementos existen antes de intentar actualizar sus valores
                        var golesLocalInput = fila.querySelector('td:nth-child(3) input');
                        var golesVisitanteInput = fila.querySelector('td:nth-child(5) input');
                        if (golesLocalInput && golesVisitanteInput) {
                            golesLocalInput.value = golesLocal;
                            golesVisitanteInput.value = golesVisitante;
                        } else {
                            console.error('Elemento input no encontrado en la fila:', fila);
                        }
                    }
                });
            });
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}