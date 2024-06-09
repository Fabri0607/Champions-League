function mezclarYActualizar() {

    var filas = document.querySelectorAll('.contenedor-tabla table tbody tr');
    
    if (filas.length !== 32) {
        // Hacer visible el mensaje de sorteo
        let mensaje_sorteo = document.getElementById('mensaje-sorteo');
        mensaje_sorteo.classList.remove('d-none');
        mensaje_sorteo.classList.remove('alert-success');
        mensaje_sorteo.classList.add('alert-danger');
        mensaje_sorteo.innerHTML = "El número de equipos no es 32. La actualización no se realizará.";
        console.error("El número de equipos no es 32. La actualización no se realizará.");
        return; // Salir de la función si el número de equipos no es 32
    }

    mezclarEquipos();
    setTimeout(asignarGrupoYActualizar, 1000);
}

function mezclarEquipos() {
    var tabla = document.querySelector('.contenedor-tabla table tbody');
    for (var i = tabla.children.length; i >= 0; i--) {
        tabla.appendChild(tabla.children[Math.random() * i | 0]);
    }
}

function asignarGrupoYActualizar() {
    var grupos = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];
    var filas = document.querySelectorAll('.contenedor-tabla table tbody tr');

    for (var i = 0; i < filas.length; i++) {
        var grupo = grupos[i % grupos.length];
        filas[i].getElementsByTagName('td')[3].textContent = grupo;
    }
    // Llamar a la función para actualizar los grupos en la base de datos
    actualizarGrupoEnBaseDeDatos();
}

function actualizarGrupoEnBaseDeDatos() {
    var filas = document.querySelectorAll('.contenedor-tabla table tbody tr');

    for (var i = 0; i < filas.length; i++) {
        var idEquipo = filas[i].getElementsByTagName('td')[0].textContent;
        var grupo = filas[i].getElementsByTagName('td')[3].textContent;
        // Enviar una solicitud AJAX para actualizar el grupo en la base de datos
        $.ajax({
            type: 'POST',
            url: 'procesos/actualizar_equipos.php',
            data: { idEquipo: idEquipo, grupo: grupo },
            success: function(response) {
                console.log(response);
		location.reload();
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }
}

function actualizarEquiposPorGrupos() {
    // Realizar una solicitud AJAX para obtener los equipos agrupados por grupos
    var xhttp = new XMLHttpRequest();
    
    // Definir la función a ejecutar cuando cambie el estado de la solicitud
    xhttp.onreadystatechange = function() {
        // Verificar si la solicitud se completó y se recibió una respuesta satisfactoria
        if (this.readyState == 4 && this.status == 200) {
            // Cuando la respuesta sea exitosa, actualizar la tabla en el HTML
            var equiposPorGrupos = JSON.parse(this.responseText);
            actualizarTablaEquiposPorGrupos(equiposPorGrupos);
        }
    };
    
    // Abrir una solicitud GET al archivo PHP que devuelve los equipos por grupos
    xhttp.open("GET", "procesos/equipos_por_grupos.php", true);
    
    // Enviar la solicitud
    xhttp.send();
}

function actualizarTablaEquiposPorGrupos(equiposPorGrupos) {
    // Limpiar la tabla actual
    var tbody = document.querySelector('.contenedor-tabla table tbody');
    tbody.innerHTML = '';

    // Iterar sobre los equipos y agregarlos a la tabla
    equiposPorGrupos.forEach(function(equipo) {
        var fila = "<tr>" +
            "<td>" + equipo.ID_EQUIPO + "</td>" +
            "<td>" + equipo.NOMBRE + "</td>" +
            "<td>" + equipo.PAIS + "</td>" +
            "<td>" + equipo.GRUPO + "</td>" +
            "</tr>";
        tbody.innerHTML += fila;
    });
}