<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "empresa";

$conexion = mysqli_connect($host, $user, $password, $dbname) or die ("No se pudo realizar la conexión! <br>");
echo "Conexión realizada con éxito! <br>";
$consulta = "INSERT INTO ARTICULOS (ID_ART, 
ARTICULO, COD_ FABRICANTE, PESO, 
CATEGORIA, PRECIO_VENTA, PRECIO_COSTO, 
EXISTENCIAS, FECHA_COMPRA) VALUES
(1, 'MACARRONES', 100, 2, 'PRIMERA', 10.00, 5.00, 
400, '2011- 03-04'), 
(2, 'MACARRONES', 101, 3, '', 8.00, 4.00, 500, 
'2010-08-15'), 
(3, 'JUDIAS', 100, 4, 'PRIMERA', 3.00, 2.00, 600, 
'2010-12- 12'), 
(4, 'LENTEJAS', 102, 5, 'PRIMERA', 2.00, 1.00, 
200, '2010- 11-11'), 
(5, 'GARBANZOS', 103, 3, 'SEGUNDA', 6.00, 4.00, 
300, '2011- 01-01')";
if (mysqli_query($conexion, $consulta)) {
    echo "Datos insertados de forma satisfactoria!!";
} else {
    echo "No pudo introducirse los datos";
}
mysqli_close($conexion);
?>