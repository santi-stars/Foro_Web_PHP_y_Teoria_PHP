<?php
session_start();
if(isset($_SESSION["USUARIO"])){
    header("Location:vista/panel_usuario.php");
}
?>
