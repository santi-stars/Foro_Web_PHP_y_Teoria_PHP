<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '\Ejemplos_profe\Ejemplo5\presenter\SessionPresenter.php';

// se inicializa el presenter
$session = new SessionPresenter();

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

    // si no hay errores, se procede a registrar al usuario. Si el registro es correcto, se le redirigirá a index.
    if ($nameErr === "" && $passErr === "") {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $md5password = md5($_POST['password']);
            if ($session->logIn($_POST['username'], $md5password)) {
                $_POST = array();
                header("location: ../index.php");
            } else {
                $message = "The login could not be completed!";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <!-- Estilos de Bootstrap -->
    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/sign-in/">
    <link href="https://getbootstrap.com/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://getbootstrap.com/docs/4.3/examples/sign-in/signin.css" rel="stylesheet">

    <!-- Estilos propios (adicionales) -->
    <link href="../styles.scss" rel="stylesheet">

</head>

<body class="text-center custom-bg">
    <div class="img-bg"></div>
    <!-- al presenter se le enviará la información una vez validada. $_SERVER["PHP_SELF"] es una variable súper global 
    que devuelve el nombre de archivo del script que se está ejecutando actualmente. Así envía los datos del formulario 
    enviado a la propia página, en lugar de saltar a una página diferente.
    De esta manera, el usuario recibirá mensajes de error en la misma página que el formulario-->
    <form class="form-signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <h1 class="h3 mb-3 font-weight-normal text-white">Iniciar sesión</h1>

        <!-- ----------- -->
        <!-- Nombre de usuario -->
        <!-- ----------- -->
        <label for="inputUsername" class="sr-only">Nombre de usuario:</label>
        <input id="inputUsername" name="username" class="form-control" placeholder="Username" value="<?php fillField('username') ?>" autofocus>

        <!-- Mensaje de error usuario -->
        <div class="error-message-wrapper">
            <?php if ($nameErr != "") : ?>
                <span><?php echo "* " . $nameErr; ?></span>
            <?php endif; ?>
        </div>

        <!-- ----------- -->
        <!-- Contraseña -->
        <!-- ----------- -->
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Contraseña" value="<?php fillField('password') ?>">

        <!-- Mensaje de error contraseña -->
        <div class="error-message-wrapper">
            <?php if ($passErr != "") : ?>
                <?php echo "* " . $passErr; ?>
            <?php endif; ?>
        </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar sesión</button>

    </form>

    <footer>
    </footer>
</body>

</html>