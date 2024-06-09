<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<title>Login</title>
	<link rel="stylesheet" href="CSS\reset.css">
	<link rel="stylesheet" href="CSS\styleLogin.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<body>

	<form action="login-page.php" method="POST">
		<h1>Login</h1>
		<label>Usuario</label>
		<input type="text" name="nombre" required placeholder="Usuario">
		<label>Contraseña</label>
		<input type="password" name="clave" required placeholder="Contraseña">

		<input type="submit" value="Ingresar" class="ingresar">
	</form>

	<?php
	if (isset($_POST['nombre']) && isset($_POST['clave'])) {
		require_once "php/connect.php";
		require_once "procesos/login.php";
	}
	?>

</body>

</html>