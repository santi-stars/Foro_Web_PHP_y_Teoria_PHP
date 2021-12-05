<html lang="es">
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="css/inicio.css">
</head>
<body>
	<header>
		<h1>Pantalla de inicio</h1>
	</header>
	<div id="contenedor">

	<?php
		require_once ("clase_sesion.php");
		$sesion = new Sesion();
		if (isset($_SESSION['user'])) {	
			echo "<h2 id='bienvenida'>Bienvenid@ \n";
			echo "<i>".$sesion->get('user')."</i>";
			echo ", si estás viendo esto has iniciado sesión correctamente</h2><br/>";
			echo "(El identificador de la session es: " .session_id().")<br/>";
			if (isset($_POST['cerrar'])) {
				$sesion->borrar_sesion();
			}	
			?>

			<br/>
			<form method="post">
				<input type="submit" value="Cerrar sesión" name="cerrar">
			</form>
				
			<?php
		}
		else {
			echo "Debes iniciar sesión para poder continuar<br/>";
			echo "<p id='link'><a href='index.php'>Volver a pantalla de inicio de sesión</a></p>";
		}
	?>

	</div>
</body>
</html>