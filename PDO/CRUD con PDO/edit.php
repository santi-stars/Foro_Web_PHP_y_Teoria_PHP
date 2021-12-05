<?php
/* Crea el formulario para editar el registro desde este
formulario, que es usado en múltiples ocasiones en este fichero,
se convierte en una función que podemos volver a usar
fácilmente
*/
function renderForm($id, $nombre, $apellido, $error)
{
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Listado de Registros</title>
    </head>
    <body>
    <?php
    // si hay errores, nos los muestra en pantalla
    if ($error != '') {
        echo '<div style="padding:4px; border:1px solid red; color:red;">' .
            $error . '</div>';
    }
    ?>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
        <div>
            <p><strong>ID:</strong> <?php echo $id; ?></p>
            <strong>Nombre: *</strong> <input type="text" name="nombre" value="<?php echo $nombre; ?>"/><br/>
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
//comprueba si el formulario ha sido enviado.
// Si es correcto, procesa el formulario y guarda los datos en la BD.
if (isset($_POST['submit'])) {
//confirma que el "ID" recibido es un valor válida antes
// de obtener los datos del formulario
    if (is_numeric($_POST['id'])) {
// obtiene los datos del formulario, asegurándonos que son válidos
        $id = $_POST['id'];
        $nombre = htmlspecialchars($_POST['nombre']);
        $apellido = htmlspecialchars($_POST['apellido']);
// guardamos los datos en la base de datos
        try {
//configuramos el prepared statement
            $stmt = $dbh->prepare("UPDATE players SET nombre=:nombre, apellido=:apellido WHERE id=:id");
            $stmt->bindParam(':nombre', $_POST['nombre'], PDO::PARAM_STR);
            $stmt->bindParam(':apellido', $_POST['apellido'], PDO::PARAM_STR);
            $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }//una vez guardados, redirigimos a la página principal
        header("Location: view.php");
    } else {
// Si el valor de "id" no es válidos, mostramos un mensaje de error
        echo 'Error!';
    }
} else /* Si el formulario no ha sido enviado, obtenemos los datos del formulario desde la base de datos y visualizamos el formulario*/ {
    /* Obtenemos el "id" desde la URL (si existe), asegurándonos
    que es válido comprobando que sea numérico o mayor que 0*/
    if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
// consulta a la base de datos
        $id = $_GET['id'];
        try {
            $stmt = $dbh->prepare('SELECT * FROM players WHERE id=:id');
            $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_STR);
            $stmt->execute();
            $resultado = $stmt->fetchAll();
// comprueba que el "id" coincide con una fila en la base de datos
            if ($resultado) { // obtenemos datos desde la bd
                foreach ($resultado as $player) {
                    $nombre = $player['nombre'];
                    $apellido = $player['apellido'];
                }
// mostramos el formulario
                renderForm($id, $nombre, $apellido, '');
            } else { // si no hay resultados, lo indicamos
                echo "No hay resultados!";
            }
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    } else { /* Si el "ID" de la URL no es válido, o si no hay un valor de "id", mostramos un error */
        echo 'Error!';
    }
}
?>
