<?php
// Realizará la instancia de la clase y registrará los primeros valores
// mediante los métodos de la clase y realizará el paso de valores al siguiente
// script, prueba2.php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<?php

require("clase_sesion.php");
$sesion = new Sesion();
$sesion->set("nombre", "Silvia Ruíz");
$sesion->set("edad", "32");
$id_sesion = SID;
echo "<a href=\"prueba2.php?sid_session\">Pasar variables";
?>