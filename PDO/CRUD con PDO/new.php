<?php
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
            <strong>Apellido: *</strong> <input type="text" name="apellido" value="<?php echo $apellido; ?>"
            /><br/>
            <p>* Requerido</p>
            <input type="submit" name="submit" value="Submit">
        </div>
    </form>
    </body>
    </html>
    <?php
}

// conectar a la base de datos
include('connect-db.php');
// Comprueba si el formulario ha sido enviado.
// Si se ha enviado, comienza el proceso el formulario y guarda los datos en la DB
if (isset($_POST['submit'])) {
// Obtenemos los datos del formulario, asegurándonos que son válidos.
    $nombre = htmlspecialchars($_POST['nombre']);
    $apellido = htmlspecialchars($_POST['apellido']);
// Comprueba que ambos campos han sido introducidos
    if ($nombre == '' || $apellido == '') {
// Genera el mensaje de error
        $error = 'ERROR: Por favor, introduce todos los campos requeridos.!';
// Si ning�n campo est� en blanco, muestra el formulario otra vez
        renderForm($nombre, $apellido, $error);
    } else {
// guardamos los datos en la base de datos
        try {
            $stmt = $dbh->prepare("INSERT INTO players (nombre, apellido) VALUES (:nombre,:apellido)");
            $stmt->bindParam(':nombre', $_POST['nombre'], PDO::PARAM_STR);
            $stmt->bindParam(':apellido', $_POST['apellido'], PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
        /* Una vez que han sido guardados, redirigimos a la p�gina de vista
        principal*/
        header("Location: view.php");
    }
} else {    // Si el formulario no han sido enviado, muestra el formulario
    renderForm('', '', '');
}
?>