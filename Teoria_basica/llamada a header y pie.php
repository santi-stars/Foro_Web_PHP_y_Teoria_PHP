<?php
// Usar archivos para el HEADER y el PIE de página e invocarlos pasándoles valores a las variables que contienen estos
$titulo = "PRUEBA DE INCLUDE";
include('header.php');
echo "<p> Texto a incluir en cada pagina</p> ";
include('pie.php');
?>