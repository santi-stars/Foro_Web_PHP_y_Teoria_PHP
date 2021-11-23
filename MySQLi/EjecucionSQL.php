<?php
include("ConexionBBDD.php");
$consulta = "SELECT * FROM users";
$query = mysqli_query($consulta, $conexion);