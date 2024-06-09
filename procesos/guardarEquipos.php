<?php
	require_once "../php/connect.php";
    if($_SERVER["REQUEST_METHOD"] == "POST" ){
        $nombre=$_POST['nombre'];
        $pais=$_POST['pais'];
        if(strlen($nombre) <= 50 && strlen($pais) <= 50 ){
            // Consulta para contar el número total de equipos
            $query_total_equipos = "SELECT COUNT(*) AS total_equipos FROM equipos";
            $result_total_equipos = $mysqli->query($query_total_equipos);
            $row_total_equipos = $result_total_equipos->fetch_assoc(); //obtiene la primera fila de resultados como un array asociativo
            $total_equipos = $row_total_equipos['total_equipos'];

            // Consulta para contar el número de equipos de un país específico
            $query_equipos_pais = "SELECT COUNT(*) AS equipos_pais FROM equipos WHERE PAIS = '$pais'";
            $result_equipos_pais = $mysqli->query($query_equipos_pais);
            $row_equipos_pais = $result_equipos_pais->fetch_assoc();
            $equipos_pais = $row_equipos_pais['equipos_pais'];
        
            if($total_equipos < 32){
                if($equipos_pais < 4){
                    $query="INSERT INTO equipos(ID_EQUIPO,NOMBRE,PAIS) VALUES(NULL,'$nombre','$pais')";
                    if($mysqli->query($query)){
                           
                        echo "<div class='etiqueta-exito'>Datos guardados correctamente.</div><br><br>";
                        
                    }else{
                        
                        echo "<div class='etiqueta-error'>Ocurrio un error.</div><br><br>";
                        
                    }
                }else{
                    
                    echo "<div class='etiqueta-error'>Error, ya hay 4 equipos del pais ingresado.</div><br><br>";
                    
                }   
            }else{
                
                echo "<div class='etiqueta-error'>Error, ya hay 32 equipos<br>no se pueden ingresar nuevos.</div><br><br>";
                
            }
        }else{
            
            echo "<div class='etiqueta-error'>Error, debes ingresan un máximo de 50<br>caracteres en los campos requeridos.</div><br><br>";
            
        }
    }
?>