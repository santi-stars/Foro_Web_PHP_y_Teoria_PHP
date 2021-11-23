<?php
/*
el resultado que devuelve, es un objeto con propiedades, que corresponderán a la fila recuperada

"object  mysqli_fetch_object  (resource $result [, string $class_name [, array $params ]])"

■ $result. variable que contiene el resultado de haber realizado anteriormente la ejecución "mysqli_query()".
■ $class_name. El nombre de la clase para instanciar y configurar sus propiedades.
■ $params. Un array opcional de parámetros para pasar al constructor de los objetos class_name
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
while ($reg = mysqli_fetch_object($datos)) {
    echo '<tr>';
    echo '<td>', $reg->ID_ART, '</td>';
    echo '<td>', $reg->ARTICULO, '</td>';
    echo '<td>', $reg->COD_FABRICANTE, '</td>';
    echo '</tr>';
}
echo '</table >';
mysqli_close($conexion);