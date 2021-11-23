<?php

$dbname = "foroMotos";
$host = "localhost";
$user = "root";
$password = "contraseñaForoMotos";
if ($conexion = mysqli_connect($host, $user, $password, $dbname)) {
    echo "Conexión realizada con éxito! <br>";
    // mysqli_close($conexion);
} else {
    echo "No se pudo realizar la conexión! <br>";
}

$consulta = "SELECT * FROM users order by user_reg_date asc";
$query = mysqli_query($conexion, $consulta);

//pintamos la tabla con los datos
echo '<table border="2">';

while ($reg = mysqli_fetch_array($query, MYSQLI_NUM)) {
    echo '<tr>';
    echo '<td>', $reg[0], '</td>';
    echo '<td>', $reg[1], '</td>';
    echo '<td>', $reg[2], '</td>';
    echo '<td>', $reg[3], '</td>';
    echo '<td>', $reg[4], '</td>';

    echo '</tr>';
}
echo '</table >';
mysqli_close($conexion);
/*
 * Otro ejemplo más corto y practico

$dbname = "foroMotos";
$host= "localhost";
$user = "root";
$password = "contraseñaForoMotos";
$conexion = mysqli_connect($host, $user, $password, $dbname)
or die ("No se pudo realizar la conexión! <br>");
mysqli_close($conexion);
*/


/* Se suele incluir este ejemplo en un fichero de conexion.php y se incluye en cualquier script mediante "include"
<?php
include("conexion.php");
?>
 */