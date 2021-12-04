<?php
/*
CONNECT-DB.PHP
Permite conectarnos a la base de datos
*/
// Variables que usamos en la base de datos para la conexión
$dbname = "foroMotos";
$host = "localhost";
$user = "root";
$password = "contraseñaForoMotos";
$connection = mysqli_connect($host, $user, $password, $dbname) or die ("No se pudo realizar la conexión! <br>");
