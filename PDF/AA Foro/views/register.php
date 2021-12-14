<?php

require_once '..\controllers\users_controller.php';

// se inicializa el presenter
$user = new UserController();

// si hay errores en los campos, se mostrará al usuario lo que escribió
function fillField($fieldName)
{
    if (!empty($_POST[$fieldName])) {
        echo $_POST[$fieldName];
    }
}

// inicializamos los mensajes de error vacíos
$nameErr = "";
$emailErr = "";
$passErr = "";

// se comprueba si el formulario ha sido enviado usando $_SERVER["REQUEST_METHOD"]. Si el REQUEST_METHOD es POST,
// entonces el formulario ha sido enviado - y debe ser validado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // se comprueba cada campo por separado con el método validation (que comprueba el campo específico para cada parámetro
    // específicado en el array). Los parámetros se especifican por orden de importancia, ya que el error mostrado será el último
    $nameErr = $user->validation("new-username", ['min', 'max', 'duplicated', 'required']);
    $emailErr = $user->validation("new-email", ['email', 'duplicated', 'required']);
    $passErr = $user->validation("new-password", ['password', 'required']);

    // si no hay errores, se procede a registrar al usuario. Si el registro es correcto, se le redirigirá a Login.
    if ($nameErr === "" && $emailErr === "" && $passErr === "") {
        if (isset($_POST['new-username']) && isset($_POST['new-email']) && isset($_POST['new-password'])) {
            $md5password = $user->cryptconmd5($_POST['new-password']);

            if ($user->register($_POST['new-username'], $_POST['new-email'], $md5password)) {
                $_POST = array();
                $message = "El registro de usuario se ha completado con exito! \n Enhorabuena!!!";
                echo "<script type='text/javascript'>alert('$message');</script>";
                header("location: ../index.php");
            } else {
                $message = "El registro de usuario ha fallado con exito! Enhorabuena!!!";
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
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="shortcut icon" href="..\png\icono_blascobikes.ico">
        <link rel="stylesheet" href="../css/style.css">
        <title>Foro Blasco Bikes</title>
    </head>
<body>
    <img id="fondo-header" src="..\PNG\header_foro_blasco_bikes.png">
    <div id="wrapper">
        <div id="menu">
            <a class="item" href="..\index.php">Inicio</a>
        </div>
    </div>
<!-- al presenter se le enviará la información una vez validada. $_SERVER["PHP_SELF"] es una variable súper global
que devuelve el nombre de archivo del script que se está ejecutando actualmente. Así envía los datos del formulario
enviado a la propia página, en lugar de saltar a una página diferente.
De esta manera, el usuario recibirá mensajes de error en la misma página que el formulario-->
<form class="form-signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

    <h1 class="h3 mb-3 font-weight-normal text-white">Registro</h1>
    <!-- ----------- -->
    <!-- Nombre de usuario -->
    <!-- ----------- -->
    <label for="inputUsername" class="sr-only">Nombre de usuario:</label>
    <input id="inputUsername" name="new-username" class="form-control" placeholder="Username"
           value="<?php fillField('new-username') ?>" autofocus>

    <!-- Mensaje de error usuario -->
    <div class="error-message-wrapper">
        <?php if ($nameErr != "") : ?>
            <span><?php echo "* " . $nameErr; ?></span>
        <?php endif; ?>
    </div>

    <!-- ----------- -->
    <!-- Email -->
    <!-- ----------- -->
    <label for="inputEmail" class="sr-only">Email</label>
    <input id="inputEmail" name="new-email" class="form-control" placeholder="Email"
           value="<?php fillField('new-email') ?>">

    <!-- Mensaje de error email -->
    <div class="error-message-wrapper">
        <?php if ($emailErr != "") : ?>
            <?php echo "* " . $emailErr; ?>
        <?php endif; ?>
    </div>

    <!-- ----------- -->
    <!-- Contraseña -->
    <!-- ----------- -->
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" name="new-password" class="form-control" placeholder="Contraseña"
           value="<?php fillField('new-password') ?>">

    <!-- Mensaje de error contraseña -->
    <div class="error-message-wrapper">
        <?php if ($passErr != "") : ?>
            <?php echo "* " . $passErr; ?>
        <?php endif; ?>
    </div>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Registrarse</button>
</form>

<?php
// FOOTER
include_once 'footer.php';
?>