<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "empresa";

$conexion = mysqli_connect($host, $user, $password, $dbname) or die ("No se pudo realizar la conexión! <br>");
echo "Conexión realizada con éxito! <br>";
$consulta = "UPDATE ARTICULOS SET PRECIO_VENTA=PRECIO_COSTO*1.6 WHERE CATEGORIA='PRIMERA'";
if (mysqli_query($conexion, $consulta)) {
    echo "Datos actualizados de forma satisfactoria!!";
} else {
    echo "No pudo actualizarse los datos";
}
mysqli_close($conexion);