<?php
session_start();
if(isset($_SESSION["USUARIO"])){
    header("Location:panel_usuario.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ejercicio PHP - MySQL</title>
    <link rel="stylesheet" href="../css/estilos.css">

</head>

<body>
    <header>
        <h1>PHP MYSQL</h1>
        <nav>
            <label for="check-menu">
                <input id="check-menu" type="checkbox">
                <div class="btn-menu">Menú</div>
                <ul class="ul-menu">
                    <li><a href="../index.php">Inicio</a></li>
                    <li><a href="login.php">Acceder</a></li>
                    <li><a href="login.php<?php echo '?registrar'; ?>">Registrarse</a></li>
                </ul>
            </label>
        </nav>
    </header>
    <?php 
    if(isset($_GET["registrar"])){
        require_once("registrar.php");
    }else{
    ?>
    <section id="formaulario">
        <div id="recuadro">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <?php require_once("../controlador/usuarios_controlador.php"); ?>
                <h2 class="title-form">Iniciar Sesión</h2>
                <div class="div-input">
                    <input type="text" class="user-form" name="usuario" id="usuario" placeholder="Nombre de usuario" <?php echo (isset($alias) ? 'value="'.$alias.'"' : ''); echo (($campo == 'usuario' || $campo == null) ? 'autofocus':''); ?>>
                    <label class="label-user-form" id="label-form" for="usuario">Nombre de usuario</label>
                </div>
                <div class="div-input">
                    <input type="password" class="user-form" name="password" id="password" <?php echo ( $campo == 'password' ? 'autofocus':''); ?> placeholder="Contraseña">
                    <label class="label-user-form" id="label-form" for="password">Contraseña</label>
                </div>
                <input type="submit" name="login" value="Iniciar sesión">
            <p class="p-registrar-login">No tienes una cuenta? <a class="log-reg" href="<?php echo "?registrar" ?>">Registrarse</a></p>
            </form>
        </div>
    </section>
    <?php } ?>
</body>
</html>
