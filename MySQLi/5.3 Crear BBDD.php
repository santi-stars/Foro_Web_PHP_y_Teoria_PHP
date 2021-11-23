<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "";

$conexion = mysqli_connect($host, $user, $password, $dbname) or die ("No se pudo realizar la conexión! <br>");
echo "Conexión realizada con éxito! <br>";
$consulta = "CREATE DATABASE IF NOT EXISTS nuevaDB";
if (mysqli_query($conexion, $consulta)) {
    echo "Base de datos creada de forma satisfactoria!!";
} else {
    echo "No pudo crearse la base de datos";
}
mysqli_close($conexion);