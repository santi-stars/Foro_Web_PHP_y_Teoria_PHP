<?php
require_once '..\controllers\session_controller.php';
// inicializamos el session_controler

$session = new SessionController();
$empty_field = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $topic_name = trim($_POST['topic_title']);
    $cat_id = trim($_GET['cat_id']);
    $comment_text = trim($_POST['description']);
    if ($topic_name != "" && $comment_text != "") {
        // recuperamos el id del usuario con el nombre de usuario
        require_once '..\controllers\users_controller.php';
        $user = UserController::get_user_id_by_user_nick($_SESSION['user']);
        // registramos el nuevo tema con su categoria y el usuario que lo registra
        require_once '..\controllers\topics_controller.php';
        TopicsController::register_topic($topic_name, $user->user_id, $cat_id);
        // recuperamos el último id para ingresar el primer mensaje del tema a la vez que registra el tema
        $topic = TopicsController::get_last_topic_id();
        require_once '..\controllers\comments_controller.php';
        CommentsController::register_comment($comment_text, $user->user_id, $topic->last_id);
        header("location: topics.php?sessionExists=" . $_GET['sessionExists'] . "&cat_id=" . $cat_id);
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
            <p>Tiene que estar registrado para añadir un tema nuevo en nuestro foro</p>
        </div>
        <div id="menu"><a class="item"
                          href="topics.php?sessionExists=<?php echo $_GET['sessionExists'] ?>&cat_id=<?php echo $_GET['cat_id'] ?>">Volver</a>
        </div><!-- content -->
        <?php }
        ?>
        <?php if ($sessionExists === "true") { ?>
            <div id="content">
                <div class="notice">
                    <form class="login-form"
                          action="writte-topic.php?sessionExists=<?php echo $_GET['sessionExists'] ?>&cat_id=<?php echo $_GET['cat_id'] ?>"
                          method="POST">
                        <br>
                        <?php if ($empty_field == true) : ?>
                            <p class="warning">Algún campo vacío!</p>
                        <?php endif; ?>
                        <h1>Nuevo tema</h1>
                        <!-- Nombre de usuario -->
                        <label for="topic_title" class="">Título del tema:</label><br>
                        <input name="topic_title" class="form-control" value="" autofocus><br>
                        <!-- Descripcion del tema -->
                        <label for="description" class="">Descripción</label><br>
                        <textarea type="text" name="description" class="form-control">
                        </textarea><br>
                        <button class="btn-log-reg" type="submit">Registrar</button>
                    </form>
                </div>
                <div id="menu"><a class="item"
                                  href="topics.php?sessionExists=<?php echo $_GET['sessionExists'] ?>&cat_id=<?php echo $_GET['cat_id'] ?>">Volver</a>
                </div>
            </div><!-- content -->
        <?php }

        include_once '..\views\footer.php';
        ?>


