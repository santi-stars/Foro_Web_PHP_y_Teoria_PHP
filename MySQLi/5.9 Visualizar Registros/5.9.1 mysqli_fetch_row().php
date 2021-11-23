<?php
/*
La función mysqli_fetch_row() recupera una fila de datos del resultado asociado al
identificador de resultado especificado. La fila es devuelta como un array. Cada campo
del resultado es almacenado en un índice del array, empezando desde 0. En último
lugar devolverá FALSE si ya no quedan más filas que mostrar.
el array que devuelve, solo admite referencias numéricas a los campos obtenidos de la consulta. El primer
campo referenciado es el 0, el segundo el 1 y así sucesivamente.
 */
$host = "localhost";
$user = "root";
$password = "";
$dbname = "empresa";

$conexion = mysqli_connect($host, $user, $password, $dbname) or die ("No se pudo realizar la conexión! <br>");
echo "Conexión realizada con éxito! <br>";
$consulta = "SELECT * FROM ARTICULOS";
$datos = mysqli_query($conexion, $consulta);
//pintamos la tabla con los datos
echo '<table border="1">';
while ($reg = mysqli_fetch_row($datos)) {   // Devuelve cada fila como un array y FALSE cuando ya no hay más filas
    echo '<tr>';
    echo '<td>', $reg[0], '</td>';
    echo '<td>', $reg[1], '</td>';
    echo '<td>', $reg[2], '</td>';
    echo '</tr>';
}
echo '</table >';
mysqli_close($conexion);

$host = "localhost";
$user = "root";
$password = "";
$dbname = "empresa";
$conexion = mysqli_connect($host, $user, $password, $dbname) or die ("No se pudo realizar la conexión! <br>");
echo "Conexión realizada con éxito! <br>";
$consulta = "SELECT * FROM ARTICULOS";
$datos = mysqli_query($conexion, $consulta);
//pintamos la tabla con los datos
echo '<table border="1">';
while ($reg = mysqli_fetch_row($datos)) {   // Devuelve cada fila como un array y FALSE cuando ya no hay más filas
    echo '<tr>';
    foreach ($reg as $cambia) {
        echo '<td>', $cambia, '</td>';
    }
    echo '</tr>';
}
echo '</table >';
mysqli_close($conexion);