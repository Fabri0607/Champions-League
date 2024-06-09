<link rel=stylesheet href=css/styleLogin.css>

<?php
	$nombre=$_POST['nombre'];
	$clave=md5($_POST['clave']);
	$query="SELECT * FROM administradores WHERE Nombre='$nombre' AND Clave='$clave'";
	$consulta2=$mysqli->query($query);
	if($consulta2->num_rows>=1){
		$fila=$consulta2->fetch_array(MYSQLI_ASSOC);
		session_start();
		$_SESSION['user']=$fila['Nombre'];
		$_SESSION['verificar']=true;
		header("Location: ingresarSección.php");
	}else{
		echo "<p>Los datos son incorrectos</p>";
	}
?>