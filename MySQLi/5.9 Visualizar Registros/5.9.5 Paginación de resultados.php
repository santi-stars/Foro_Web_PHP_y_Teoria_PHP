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
$host = "localhost";
$user = "root";
$pass = "";
$db = "empresa";

$conexion = mysqli_connect($host, $user, $pass, $db) or die ("No se pudo realizar la conexión!");
echo "Conexión realizada con éxito!";
echo "<br>";
$consulta = "SELECT ARTICULO, CATEGORIA FROM ARTICULOS;";
$datos = mysqli_query($conexion, $consulta);
/* búsqueda de filas en orden inverso*/
for ($i = mysqli_num_rows($datos) - 1; $i >= 0; $i--) {
    if (!mysqli_data_seek($datos, $i)) {
        echo "No se encuentra la fila $i: " . "mysql_error()" . "\n";
        continue;
    }
    if (!($row = mysqli_fetch_assoc($datos))) {
        continue;
    }
    echo $row['ARTICULO'] . ' ' . $row['CATEGORIA'] . "<br />\n";
}
mysqli_close($conexion);

// Continuará...