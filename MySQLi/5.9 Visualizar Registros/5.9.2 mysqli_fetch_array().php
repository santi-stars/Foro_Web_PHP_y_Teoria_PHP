<?php
/*
Mediante la función mysqli_fetch_array() podremos referenciar a los campos por su
nombre, como si fuera un array asociativo, o si lo estimamos oportuno, con un índice numérico.
■ MYSQLI_ASSOC. obtienen solo los índices asociativos como mysql_fetch_assoc().
■ MYSQLI_NUM. obtienen solo los índices numéricos como mysql_fetch_row()).
■ MYSQLI_BOTH. opción predeterminada, y se obtendrá un array con índices asociativos y numéricos
 */

// ■ MYSQLI_NUM
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
while ($reg = mysqli_fetch_array($datos, MYSQLI_NUM)) {
    echo '<tr>';
    echo '<td>', $reg[0], '</td>';
    echo '<td>', $reg[1], '</td>';
    echo '<td>', $reg[2], '</td>';
    echo '</tr>';
}
echo '</table >';
mysqli_close($conexion);

// ■ MYSQLI_ASSOC
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
while ($reg = mysqli_fetch_array($datos,MYSQLI_ASSOC)) {
    echo '<tr>';
    echo '<td>', $reg['ID_ART'], '</td>';
    echo '<td>', $reg['ARTICULO'], '</td>';
    echo '<td>', $reg['COD_FABRICANTE'], '</td>';
    echo '</tr>';
}
echo '</table >';
mysqli_close($conexion);

// ■ MYSQLI_BOTH
$host = "localhost";
$user = "root";
$password = "";
$dbname = "empresa";

$conexion = mysqli_connect($host, $user, $password, $dbname) or die ("No se pudo realizar la conexión! <br>");
echo "Conexión realizada con éxito! <br>";
$consulta = "SELECT * FROM ARTICULOS";
$datos = mysqli_query($conexion, $consulta);
echo '<table border="1">';
while ($reg = mysqli_fetch_array($datos,MYSQLI_BOTH)) {
    echo '<tr>';
    echo '<td>', $reg[0], '</td>';
    echo '<td>', $reg['ARTICULO'], '</td>';
    echo '<td>', $reg[2], '</td>';
    echo '</tr>';
}
echo '</table >';
mysqli_close($conexion);