
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="css/new.css">
	<title>Nuevo registro</title>
</head>
<body>
	<div id="contenedor">
	<header>
		<h1>Registro de usuario</h1>
	</header>
	<form action="" method="post">		
			<div id="formulario">
				<form action="" method="post">
					<p class="campo">Nombre de usuario: *</p>
						<input type="text" name="user"/><br/>
					<p class="campo">Contraseña: *</p>
						<input type="password" name="password"/><br/>
					<p class="campo">Email: *</p>
						<input type="text" name="email"/><br/>
					<p>*Requerido</p>
					<input type='submit' name='submit' value='Registrarse'>

<?php
require_once ('clase_usuarios.php');
if (isset($_POST['submit'])) {
	//Creamos un objeto de la clase Password y almacenamos el valor de la contraseña encriptada en la variable $pw
	/*Creamos un nuevo usuario que, en el caso de cumplir con las comprobaciones, ejecutará el método nuevo() 
	para escribir sus datos en la base de datos y redirigirá a la página principal*/
	$usuario = new Usuario($_POST['user'],$_POST['email']);
	$pw = $usuario -> encriptar($_POST['password']);
	if ($usuario->comprobaciones() !== false) {
		$usuario->nuevo();	
		header("Location:index.php");
	}	
}
?>
					
				</form>
				<p id="link"><a href="index.php">Volver a pantalla de inicio de sesión</a></p>
			</div>		
		</div>
</body>
</html>


