<?php
$dbname = "foroMotos";
$user = "root";
$password = "contraseñaForoMotos";
$dbh = "";
// Con un array de opciones
try {
    $dsn = "mysql:host=localhost;dbname=$dbname";
    $dbh = new PDO($dsn, $user, $password, array(
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ));
    echo "conexion establecida";
} catch (PDOException $e) {
    echo $e->getMessage();
}