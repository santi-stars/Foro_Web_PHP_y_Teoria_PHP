<?php

require_once 'C:\xampp\htdocs\Teoria\PDF\AA Foro\controllers\session_controller.php';

// se inicializa el presenter
$session = new SessionController();

// si hay errores en los campos, se mostrará al usuario lo que escribió
function fillField($fieldName)
{
    if (!empty($_POST[$fieldName])) {
        echo $_POST[$fieldName];
    }
}

// inicializamos los mensajes de error vacíos
$nameErr = "";
$passErr = "";

// se comprueba si el formulario ha sido enviado usando $_SERVER["REQUEST_METHOD"]. Si el REQUEST_METHOD es POST,
// entonces el formulario ha sido enviado - y debe ser validado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // se comprueba cada campo por separado con el método validation (que comprueba el campo específico para cada parámetro
    // específicado en el array). Los parámetros se especifican por orden de importancia, ya que el error mostrado será el último
    $nameErr = $session->validation("username", ['min', 'max', 'required']);
    $passErr = $session->validation("password", ['password', 'required']);

    require_once 'C:\xampp\htdocs\Teoria\PDF\AA Foro\controllers\users_controller.php';
    $usercontroler = new UserController();
    // si no hay errores, se procede a registrar al usuario. Si el registro es correcto, se le redirigirá a index.
    if ($nameErr === "" && $passErr === "") {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            // $md5password = $usercontroler->cryptconmd5($_POST['password']);
            $md5password = $_POST['password'];
            if ($session->logIn($_POST['username'], $md5password)) {
                $_POST = array();
                header("location: ../index.php");
            } else {
                $message = "El login no ha podido ser completado!";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
        }
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
        <a class="item" href='login.php'>sing in</a> -
        <a class="item" href='register.php'>sing up</a>
    </div>
</div>
<!-- al presenter se le enviará la información una vez validada. $_SERVER["PHP_SELF"] es una variable súper global
que devuelve el nombre de archivo del script que se está ejecutando actualmente. Así envía los datos del formulario
enviado a la propia página, en lugar de saltar a una página diferente.
De esta manera, el usuario recibirá mensajes de error en la misma página que el formulario-->
<form class="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
    <br>
    <h1 class="">Iniciar sesión</h1>
    <!-- Nombre de usuario -->
    <label for="inputUsername" class="">Nombre de usuario:</label><br>
    <input id="inputUsername" name="username" class="" placeholder="Username"
           value="<?php fillField('username') ?>" autofocus>

    <!-- Mensaje de error usuario -->
    <div class="error-message-wrapper">
        <?php if ($nameErr != "") : ?>
            <span><?php echo "* " . $nameErr; ?></span>
        <?php endif; ?>
    </div>

    <!-- ----------- -->
    <!-- Contraseña -->
    <!-- ----------- -->
    <label for="inputPassword" class="">Password</label><br>
    <input type="password" id="inputPassword" name="password" class="" placeholder="Contraseña"
           value="<?php fillField('password') ?>">

    <!-- Mensaje de error contraseña -->
    <div class="error-message-wrapper">
        <?php if ($passErr != "") : ?>
            <?php echo "* " . $passErr; ?>
        <?php endif; ?>
    </div>

    <button class="" type="submit">Iniciar sesión</button>
    <div><a class="item" href='register.php'>sing up</a></div>

</form>
<?php
// FOOTER
include_once 'C:\xampp\htdocs\Teoria\PDF\AA Foro\views\footer.php';
?>