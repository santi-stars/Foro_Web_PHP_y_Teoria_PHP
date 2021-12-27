<?php
require_once '..\controllers\session_controller.php';
// inicializamos el session_controler

$session = new SessionController();
$sessionExists = $_GET['sessionExists'];
if ($sessionExists == true) {
    $cat_id = trim($_GET['cat_id']);
    $topic_id = trim($_GET['topic_id']);
    $comment_id = trim($_GET['comment_id']);
    // recuperamos el id del usuario con el nombre de usuario
    require_once '..\controllers\users_controller.php';
    $user = UserController::get_user_id_by_user_nick($_SESSION['user']);
    // Eliminamos el comentario con su id comentario, su id categoria y el usuario que lo elimina
    require_once '..\controllers\comments_controller.php';
    $user_comment_id = CommentsController::get_user_id_by_comment_id($comment_id);  // HACER
    if ($user->user_id == $user_comment_id->user_id) {
        $comment_deleted = CommentsController::delete_comment_by_id($comment_id);   // HACER
    } else {
        $comment_deleted = false;
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
    <div id="content">
        <div class="notice">
            <?php if ($sessionExists === "false") { ?>
                <h1>Aviso</h1>
                <p>Tiene que estar registrado para eliminar un comentario en nuestro foro</p><br><br>
            <?php } ?>
            <?php if ($sessionExists === "true") { ?>
                <?php if ($comment_deleted == true) { ?>
                    <h1>Comentario eliminado</h1>
                    <p>El comentario se ha eliminado correctamente!</p><br><br>
                <?php } ?>

                <?php if ($comment_deleted == false) { ?>
                    <h1>Aviso</h1>
                    <p>Tienes que ser el creador del comentario para eliminarlo!</p><br><br>
                    <?php } ?>
            <?php } ?>
            <div id="menu boton-volver"><a class="item"
                                           href="comments.php?sessionExists=<?php echo $_GET['sessionExists'] ?>&cat_id=
                                           <?php echo $_GET['cat_id'] ?>&topic_id=<?php echo $_GET['topic_id'] ?>">Volver</a>
            </div><!-- menu boton-volver -->
        </div><!--notice -->
    </div><!-- content -->
<?php
include_once '..\views\footer.php';
?>