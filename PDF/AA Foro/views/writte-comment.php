<?php
require_once '..\controllers\session_controller.php';
// inicializamos el session_controler

$session = new SessionController();
$empty_field = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $cat_id = trim($_GET['cat_id']);
    $topic_id = trim($_GET['topic_id']);
    $comment_text = trim($_POST['comment']);
    if ($comment_text != "") {
        // recuperamos el id del usuario con el nombre de usuario
        require_once '..\controllers\users_controller.php';
        $user = UserController::get_user_id_by_user_nick($_SESSION['user']);
        // registramos el nuevo comentario con su id de tema y el usuario que lo registra
        require_once '..\controllers\comments_controller.php';
        CommentsController::register_comment($comment_text, $user->user_id, $topic_id);
        header("location: comments.php?sessionExists=" . $_GET['sessionExists'] . "&cat_id=" . $cat_id . "&topic_id=" . $topic_id);
    } else {
        $empty_field = true;
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
<!--<h1>Foro Blasco Bikes</h1>-->
<div id="wrapper">
    <div id="menu">
        <a class="item" href="..\index.php">Inicio</a>
        <!-- se obtiene del enlace el valor de sessionExists para mostrar un contenido u otro -->
        <?php $sessionExists = $_GET['sessionExists']; ?>

        <!-- se mostrará un mensaje de bienvenida si la sesión está iniciada -->
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
    <?php
    if ($sessionExists === "false") { ?>
    <div id="content">
        <div class="notice">
            <h1>Aviso</h1>
            <p>Tiene que estar registrado para añadir un comentario nuevo en nuestro foro</p>
        </div>
        <div id="menu"><a class="item"
                          href="comments.php?sessionExists=<?php echo $_GET['sessionExists'] ?>&cat_id=
                          <?php echo $_GET['cat_id'] ?>&topic_id=<?php echo $_GET['topic_id'] ?>">Volver</a>
        </div><!-- content -->
        <?php }
        ?>
        <?php if ($sessionExists === "true") { ?>
            <div id="content">
                <div class="notice">
                    <form class="login-form"
                          action="writte-comment.php?sessionExists=<?php echo $_GET['sessionExists'] ?>&cat_id=
                          <?php echo $_GET['cat_id'] ?>&topic_id=<?php echo $_GET['topic_id'] ?>"
                          method="POST">
                        <br>
                        <?php if ($empty_field == true) : ?>
                            <p class="warning">Algún campo vacío!</p>
                        <?php endif; ?>
                        <h1>Nuevo comentario</h1>
                        <!-- Contenido del comentario -->
                        <label for="comment" class="">Descripción</label><br>
                        <textarea type="text" name="comment" class="form-control" autofocus>
                        </textarea><br>
                        <button class="btn-log-reg" type="submit">Registrar</button>
                    </form>
                </div>
                <div id="menu"><a class="item"
                                  href="comments.php?sessionExists=<?php echo $_GET['sessionExists'] ?>&cat_id=
                                  <?php echo $_GET['cat_id'] ?>&topic_id=<?php echo $_GET['topic_id'] ?>">Volver</a>
                </div>
            </div><!-- content -->
        <?php }

        include_once '..\views\footer.php';
        ?>


