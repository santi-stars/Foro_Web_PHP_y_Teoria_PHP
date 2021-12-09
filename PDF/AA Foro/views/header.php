<?php
require_once 'C:\xampp\htdocs\Teoria\PDF\AA Foro\controllers\session_controller.php';
// inicializamos el session_controler
$session = new SessionController();

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
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/style.css">
    <title>Foro Blasco Bikes</title>
</head>
<body>
<h1>Foro Blasco Bikes</h1>
<div id="wrapper">
    <div id="menu">
        <a class="item" href="C:\xampp\htdocs\Teoria\PDF\PDF\index.php">Home</a>
        <!-- se obtiene del enlace el valor de sessionExists para mostrar un contenido u otro -->
        <?php $sessionExists = $_GET['sessionExists']; ?>

        <!-- se mostrará un mensaje de bienvenida si la sesión está iniciada -->
        <?php if ($sessionExists === "true") : ?>
        <div id="userbar">
            <a class="item" href=''><?php echo "Bienvenido " . $session->get('user') ?></a> -
            <a class="item" href=''>LOGOUT</a>
            <?php endif; ?>
            <a class="item" href='LOGIN'>sing in</a> -
            <a class="item" href='REGISTER'>sing up</a>
        </div>
    </div>