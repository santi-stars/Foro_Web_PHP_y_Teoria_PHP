<?php
/*
Permite a los usuarios crear una nueva entrada en la base
de datos
*/
// crear el nuevo formulario de nuevo registro
function renderForm($nombre, $apellido, $error)
{
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>Nuevo Registro</title>
    </head>
    <body>
    <?php
    // Si hay errores, los muestra en pantalla
    if ($error != '') {
        echo '<div style="padding:4px; border:1px solid red;color:#ff0000;">' . $error . '</div>';
    }
    ?>
    <form action="" method="post">
        <div>
            <strong>Nombre: *</strong> <input type="text" name="nombre" value="<?php echo $nombre; ?>"
            /><br/>
            <strong>Apellido: *</strong> <input type="text" name="apellido" value="<?php echo $apellido; ?>"/><br/>
            <p>* Requerido</p>
            <input type="submit" name="submit" value="Submit">
        </div>
    </form>
    </body>
    </html>
    <?php
}

// conectamos a la base de datos
include('connect-db.php');
// Comprueba si el formulario ha sido enviado.
// Si se ha enviado, comienza el proceso el formulario y guarda los datos en la DB
if (isset($_POST['submit'])) {
// Obtenemos los datos del formulario, asegur ndonos que son validos .
    $nombre = htmlspecialchars($_POST['nombre']);
    $apellido = htmlspecialchars($_POST['apellido']);
// Comprueba que ambos campos han sido introducidos
    if ($nombre == '' || $apellido == '') {
// Genera el mensaje de error
        $error = 'ERROR: Por favor, introduce todos los
campos requeridos.!';
// Si ninguún campo esta en blanco, muestra el formulario otra vez
        renderForm($nombre, $apellido, $error);
    } else {
// guardamos los datos en la base de datos
        $sentencia = "INSERT players SET nombre='$nombre', apellido = '$apellido' " or die(mysqli_error());
        mysqli_query($connection, $sentencia);
        /* Una vez que han sido guardados, redirigimos a la página de vista principal*/
        header("Location: VIEW.php");
    }
} else { // Si el formulario no han sido enviado, muestra el formulario
    renderForm('', '', '');
}
?>