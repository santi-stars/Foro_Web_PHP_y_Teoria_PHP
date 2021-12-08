<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '\Ejemplos_profe\Ejemplo5\presenter\SessionPresenter.php';

// se inicializa el presenter
$session = new SessionPresenter();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($session->get('user') != false) {
        $session->delete();
        header("location: ..\index.php");
    }
}

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Home</title>

    <!-- Estilos de Bootstrap -->
    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/sign-in/">
    <link href="https://getbootstrap.com/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://getbootstrap.com/docs/4.3/examples/sign-in/signin.css" rel="stylesheet">

    <!-- Estilos propios (adicionales) -->
    <link href="../styles.scss" rel="stylesheet">

</head>

<body class="text-center custom-bg">
    <div class="img-bg"></div>

    <!-- se obtiene del enlace el valor de sessionExists para mostrar un contenido u otro -->
    <?php $sessionExists = $_GET['sessionExists']; ?>

    <!-- se mostrará un mensaje de bienvenida si la sesión está iniciada -->
    <?php if ($sessionExists === "true") : ?>
        <form class="welcome-text" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="hero-header">
                <?php echo "Bienvenido " . $session->get('user') ?>
            </div>
            <button class="btn btn-lg btn-primary btn-block button-max-width" type="submit" style="margin-top:12px;">Cerrar sesión</button>
        </form>
    <?php endif; ?>

    <!-- se permitirá el registro o inicio de sesión si la sesión no está abierta -->
    <?php if ($sessionExists === "false") : ?>
        <div class="form-signin">
            <a href="login.php"><button class="btn btn-lg btn-primary btn-block button-margin" type="submit">Iniciar sesión</button></a>
            <a href="register.php"><button class="btn btn-lg btn-primary btn-block button-margin" type="submit">Registrarse</button></a>
        </div>
    <?php endif; ?>

    <footer>

    </footer>
</body>

</html>