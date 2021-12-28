<?php
require_once '..\controllers\session_controller.php';
$session = new SessionController();

define ('DEFAULT_FOLDER', "..\index.php");

define ('DEFAULT_CAT', "");

$cat = DEFAULT_CAT;
if ( !empty ( $_GET[ 'category' ] ) )
    $cat = "&cat_id=" . $_GET [ 'category' ];

switch ($_GET['notice']) {
    case 'registered':
        $message = "El registro de usuario se ha registrado con exito! Enhorabuena!!!";
        break;
    case 'registerFail':
        $message = "El registro de usuario ha fallado con exito! Enhorabuena!!!";
        break;
}

// inicializamos el session_controler



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($session->get('user') != false) {
        $session->delete();
        header("location: ..\index.php");
    }
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="shortcut icon" href="..\png\icono_blascobikes.ico">
    <link rel="stylesheet" href="../css/style.css">
    <title>Foro Blasco Bikes</title>
</head>
<body>
<img id="fondo-header" src="..\PNG\header_foro_blasco_bikes.png">
<div id="wrapper">
    <div id="menu">
        <a class="item" href="..\index.php">Volver</a>
        <!-- se obtiene del enlace el valor de sessionExists para mostrar un contenido u otro -->
        <?php $sessionExists = $_GET['sessionExists']; ?>

        <div id="userbar">
            <?php if ($sessionExists === "true") : ?>
                <a class="item" href=''><?php echo "Bienvenido " ?><strong
                            class="user-name"> <?php echo $session->get('user'); ?></strong></a> -
                <a class="item" href='home.php?sessionExists=false'>Cerrar sesión</a>
            <?php endif; ?>
            <?php if ($sessionExists === "false") : ?>
                <?php $session->delete(); ?>
                <a class="item" href='login.php'>Iniciar sesión</a> -
                <a class="item" href='register.php'>Regístrate</a>
            <?php endif; ?>
        </div>
    </div>

<div id="content">
    <h1>AVISO</h1>
    <?php echo $message ?>
</div><!-- content -->

<?php
// FOOTER
include_once 'footer.php';
?>


