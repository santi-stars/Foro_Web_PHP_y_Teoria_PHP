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
            <div class="pestania-wrap">
                <a class="pestania" href="?1">Introducción</a>
                <a class="pestania" href="?2">Crear DDBB</a>
            </div>
            <?php 
                if(empty($_GET) || isset($_GET["1"])){
            ?>
            <div>
                <p><b>Desde esta aplicación podrá:</b></p>
                <ul>
                    <li>Crear usuario.</li>
                    <li>Iniciar Sesión.</li>
                    <li>Editar datos de usuario.</li>
                    <li>Cambiar Contraseña.</li>
                    <li>Reestablecer contraseña (por email).</li>
                </ul>
                <br>
                <p>Para poder utilizar la aplicación deberá contar con una base de datos <i>"EJEMPLO10"</i> y una tabla <i>"USUARIOS"</i> que contendrá todos los usuarios registrados.</p>
                <p>Para crear la base de datos haga click en <a href="?2">"Crear DDBB"</a> y si ya cuenta con estos requisitos...</p><br>
                <input type="submit" value="Acceder" onclick="window.location='vista/login.php';">
            </div>
            <?php }elseif(isset($_GET["2"])){ ?>
            <div>
                <h3>Crear base de datos.</h3>
                <p>El siguiente formulario contiene los valores por defecto. En caso de contar con un host, usuario y/o contraseña distintos, cambie los datos antes de enviar el formulario.</p>
                <p>Al enviar el formulario se creará un archivo .php en la carpeta "modelo/conexion". Este archivo almacenará los datos para la conexión. Luego de crear el archivo, se realizará una prueba de conexión y, si tiene éxito, creará la base de datos <b>"EJEMPLO10"</b> y la tabla <b>"USUARIOS"</b> con los campos <b>usuario, nombre, apellido, email y contraseña.</b></p>
                <p>Tanto la base de datos como la tabla, solo se crearán en caso de que no existan. Esto implica que, si cambia de usuario y/o contraseña, puede volver a crear el archivo con los nuevos datos para actualizar la información.</p>
                <br>
                <hr>
                <br>
                <?php require_once("controlador/ddbb_controlador.php") ?>
                <form action="<?php echo $_SERVER['PHP_SELF'].'?2'; ?>" method="post">

                    <?php require_once("controlador/ddbb_controlador.php"); ?>

                    <div class="div-input">
                        <input type="text" class="user-form" name="nombrehost" id="nombrehost" placeholder="Hostname" value="localhost" autofocus>
                        <label class="label-user-form" id="label-form" for="nombrehost">Hostname</label>
                    </div>
                    <div class="div-input">
                        <input type="text" class="user-form" name="usuariohost" id="usuariohost" placeholder="Nombre de usuario" value="root">
                        <label class="label-user-form" id="label-form" for="usuariohost">Nombre de usuario</label>
                    </div>
                    <div class="div-input">
                        <input type="password" class="user-form" name="passwordhost" id="passwordhost" placeholder="Contraseña">
                        <label class="label-user-form" id="label-form" for="passwordhost">Contraseña</label>
                    </div>
                    <input type="submit" name="crearddbb" value="Crear DDBB">
                </form>
            </div>
            <?php } ?>
        </div>
    </section>
</body>

</html>
