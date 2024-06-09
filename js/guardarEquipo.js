function enviarFormulario() {
    var nombre = document.getElementById("nombre").value;
    var pais = document.getElementById("pais").value;
    //console.log("Nombre:", nombre);
    //console.log("País:", pais);

    if(nombre.trim() !== "" && pais.trim() !== ""){
        // AJAX request
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //console.log("Respuesta del servidor:", this.responseText);
                document.getElementById("mensaje").innerHTML = this.responseText;
                if(this.responseText == "<div class='etiqueta-exito'>Datos guardados correctamente.</div><br><br>"){ // Si se guarda
                    document.getElementById("nombre").value = ""; // Actualizar el valor en el campo de nombre
                    document.getElementById("pais").value = "";
                }
            }
        };
        xhttp.open("POST", "procesos/guardarEquipos.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("nombre=" + nombre + "&pais=" + pais);
    }else{
        document.getElementById("mensaje").innerHTML = "<div class='etiqueta-error'>Debes completar los campos.</div><br><br>";
    } 
}