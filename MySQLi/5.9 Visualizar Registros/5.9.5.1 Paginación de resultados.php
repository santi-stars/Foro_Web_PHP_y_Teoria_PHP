<?php
/*
"int mysqli_num_rows ( resource $result )"  válido para sentencias SELECT o SHOW
devolverá, el número de filas de una consulta en caso de éxito y FALSE en caso de error.

"bool mysqli_data_seek ( resource $result , int $row_number )"
se utiliza junto con funciones como mysqli_fetch_row(), mysqli_fetch_array() o mysqli_fetch_assoc(),
ya que devolverá la siguiente fila tras realizar una llamada a estas funciones
■ $result. Será el identificador que proviene de una llamada a mysqli_query().
■ $row_number. Número de la fila deseada del resultado nuevo del apuntador. El
primer valor que tiene será 0 y su rango debería ser un valor entre 0 a mysql_
num_rows() -1. Sin embargo, si el conjunto de resultados está vacío (mysql_
num_rows() == 0), una búsqueda a 0 fallará con un E_WARNING y mysql_data_
seek() devolverá FALSE.
 */
$dbname = "foroMotos";
$host = "localhost";
$user = "root";
$password = "contraseñaForoMotos";

$conexion = mysqli_connect($host, $user, $password, $dbname) or die ("No se pudo realizar la conexión!");
echo "Conexión realizada con éxito!";
echo "<br>";
$consulta = "SELECT `user_nick`,`user_email` FROM `users` ORDER BY `user_reg_date` DESC;";
$datos = mysqli_query($conexion, $consulta);

echo mysqli_num_rows($datos) . "<br />\n";
/* búsqueda de filas en orden inverso*/
for ($i = mysqli_num_rows($datos) - 1; $i >= 0; $i--) { // Calcula el número de registros que devuelve la consulta
    echo mysqli_data_seek($datos, $i) . "<br />\n";
    if (!mysqli_data_seek($datos, $i)) {    // Si no hay  fila en esa posicion del bucle, lanza un error
        echo "No se encuentra la fila $i: " . "mysql_error()" . "\n";
        continue;
    }
    if (!($row = mysqli_fetch_assoc($datos))) { // Cuando no hay más filas disponibles salta el bucle FOR
        continue;
    }
    echo $row['user_nick'] . ' ' . $row['user_email'] . "<br />\n";
}
mysqli_close($conexion);

// Continuará...