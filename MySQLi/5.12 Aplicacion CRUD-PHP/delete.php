<?php
/*
DELETE.PHP
Elimina una entrada específica de la tabla “players”
*/
// conectar a la base de datos
include('connect-db.php');
/*comprobamos si la variable "id" está configurada en la URL, y comprobamos que es válida */
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
// obtener el valor de ID mediante el método GET
    $id = $_GET['id'];
    $sentencia = "DELETE FROM players WHERE id='$id'"
    or die(mysqli_error());
// eliminamos la entrada
    $result = mysqli_query($connection, $sentencia);
// redirigimos de vuelta a la página de vista principal
    header("Location: view.php");
} else {
    /* Si el ID no está configurado, o no es válido, volvemos a la página principal*/
    header("Location: view.php");
}