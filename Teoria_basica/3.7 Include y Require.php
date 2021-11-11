<html>
<head><title>INCLUDE Y REQUIRE</title></head>
<body>
<p>Esto es una línea PHP</p>
<?php
// Llamar al script CONSTANTES.PHP con REQUIRE
require('constantes.php');
echo (CIUDAD) . "<br>";
echo (COMUNIDAD) . "<br>";

// INCLUDE
$archivos = array('primero.inc', 'segundo.inc', 'tercero. inc');
for ($i = 0; $i < count($archivos); $i++) {
    include $archivos[$i];
}   // Da error porque no existen esos archivos del array

// Usar archivos para el HEADER y el PIE de página e invocarlos pasándoles valores a las variables que contienen estos
/* ESTO EN UN ARCHIVO.PHP
 *
 * $titulo = "PRUEBA DE INCLUDE";
 * include('header.php');
 * echo "<p> Texto a incluir en cada pagina</p> ";
 * include('pie.php');
 */

?>
</body>
</html>