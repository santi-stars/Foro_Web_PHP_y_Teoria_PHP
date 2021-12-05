<?php
#Verifica si hay sesión iniciada
require_once("controlador/verificar_sesion.php");
?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="css/estilos.css">

<head>
    <meta charset="UTF-8">
    <title>Ejercicio PHP - MySQL</title>
</head>

<body>
    <header>
        <h1>PHP MYSQL</h1>
        <nav>
            <label for="check-menu">
                <input id="check-menu" type="checkbox">
                <div class="btn-menu">Menú</div>
                <ul class="ul-menu">
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="vista/login.php">Acceder</a></li>
                    <li><a href="vista/login.php<?php echo '?registrar'; ?>">Registrarse</a></li>
                </ul>
            </label>
        </nav>
    </header>
    <section>
        <div id="recuadro" class="recuadro-index">
            <h2>Página no encontrada!</h2>
            <br>
            <a class="log-reg" href="index.php">Inicio</a>
        </div>
    </section>
</body>

</html>
