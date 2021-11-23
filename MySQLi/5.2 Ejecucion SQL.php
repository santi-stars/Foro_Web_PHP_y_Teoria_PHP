<?php
$dbname = "foroMotos";
$host= "localhost";
$user = "root";
$password = "contraseñaForoMotos";
$conexion = mysqli_connect($host, $user, $password, $dbname)
or die ("No se pudo realizar la conexión! <br>");

$consulta = "SELECT * FROM users";
$query = mysqli_query($conexion, $consulta);

mysqli_close($conexion);