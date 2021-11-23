<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "empresa";

$conexion = mysqli_connect($host, $user, $password, $dbname) or die ("No se pudo realizar la conexión! <br>");
echo "Conexión realizada con éxito! <br>";
$consulta = "CREATE TABLE IF NOT EXISTS 
ARTICULOS( ID_ART INT NOT NULL AUTO_INCREMENT 

PRIMARY KEY, 
ARTICULO VARCHAR(20)NOT NULL, 
COD_FABRICANTE INT(3) NOT NULL, 
PESO INT(3) NOT NULL , 

CATEGORIA VARCHAR(10) NOT NULL, 
PRECIO_VENTA DECIMAL(6,2), 
PRECIO_COSTO DECIMAL(6,2), 
EXISTENCIAS INT(5), 
FECHA_COMPRA DATE )";
if (mysqli_query($conexion, $consulta)) {
    echo "Tabla creada de forma satisfactoria!!";
} else {
    echo "No pudo crearse la tabla";
}
mysqli_close($conexion);