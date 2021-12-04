<?php
/*
EDIT.PHP
Permite a los usuarios editar una entrada específica de la base de datos
*/
/* Crea el formulario para editar el registro desde este formulario, que es usado en múltiples ocasiones en este
fichero, se convierte en una función que podemos volver a usar fácilmente
*/
function renderForm($id, $nombre, $apellido, $error)
{
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>Edición de Registros</title>
    </head>
    <body>
    <?php
    // si hay errores, nos los muestra en pantalla
    if ($error != '') {
        echo '<div style="padding:4px; border:1px solid red; color:red;">' . $error . '</div>';
    }
    ?>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
        <div>
            <p><strong>ID:</strong> <?php echo $id; ?></p>
            <strong>Nombre: *</strong> <input type="text" name="nombre" value="<?php echo $nombre; ?>"/><br/>
            <strong>Apellido: *</strong> <input type="text" name="apellido" value="<?php echo $apellido; ?>"/><br/>
            <p>* Requerido</p><input type="submit" name="submit" value="Submit">
        </div>
    </form>
    </body>
    </html>
    <?php
}

// conectamos a la base de datos
include('connect-db.php');
//comprueba si el formulario ha sido enviado isset($_POST['submit']).
// Si es correcto, procesa el formulario y guarda los datos en la BD.
if (isset($_POST['submit'])) {
//confirma que el “ID" recibido es un valor válido
//antes de obtener los datos del formulario
    if (is_numeric($_POST['id'])) {
// obtiene los datos del formulario, asegurándonos que son válidos
        $id = $_POST['id'];
        $nombre = htmlspecialchars($_POST['nombre']);
        $apellido = htmlspecialchars($_POST['apellido']);
        $sentencia = "UPDATE players SET nombre = '$nombre', apellido = '$apellido' WHERE id = '$id'";
// guardamos los datos en la base de datos
        mysqli_query($connection, $sentencia) or die(mysqli_error());
//una vez guardados, redirigimos a la página principal
        header("Location: view.php");
    }
} else {
    /* Si el formulario no ha sido enviado, obtenemos los datos del formulario desde la base de datos y visualizamos el
    formulario
    Obtenemos el “id” desde la URL (si existe), asegurándonos que es válido comprobando que sea numérico o mayor que 0*/
    if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
// consulta a la base de datos
        $id = $_GET['id'];
        $sentencia = "SELECT * FROM players WHERE id='$id'";
        $result = mysqli_query($connection, $sentencia) or die(mysqli_error());
        $row = mysqli_fetch_array($result);
// comprueba que el “id” coincide con una fila en la base de datos
        if ($row) {
// obtenemos datos desde la bd
            $nombre = $row['nombre'];
            $apellido = $row['apellido'];
// mostramos el formulario
            renderForm($id, $nombre, $apellido, '');
        } else { // si no hay resultados, lo indicamos
            echo "No hay resultados";
        }
    } else {
        /* Si el “ID” de la URL no es válido, o si no hay
        un valor de “id”,
        mostramos un error*/
        echo "Error!";
    }
}
?>