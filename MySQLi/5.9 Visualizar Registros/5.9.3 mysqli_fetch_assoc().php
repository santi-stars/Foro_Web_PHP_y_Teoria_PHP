<?php
/*
equivalente a llamar ejecutar la función mysqli_fetch_array()  utilizando  como  segundo  parámetro
la  constante  MYSQLI_ASSOC., devolverá un array asociativo que corresponderá con la fila
recuperada, moviendo el apuntador de datos interno hacia delante, cuando ya no tenga más filas disponibles devolverá
el valor FALSE
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
while ($reg = mysqli_fetch_assoc($datos)) {
    echo '<tr>';
    echo '<td>', $reg['ID_ART'], '</td>';
    echo '<td>', $reg['ARTICULO'], '</td>';
    echo '<td>', $reg['COD_FABRICANTE'], '</td>';
    echo '</tr>';
}
echo '</table >';
mysqli_close($conexion);