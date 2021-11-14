<?php
// Realizará la instancia de la clase y registrará los primeros valores
// mediante los métodos de la clase y realizará el paso de valores al siguiente
// script, prueba2.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require("clase_sesion.php");                    // Carga la clase
$sesion = new Sesion();                         // Crea nuevo objeto de la clase SESION
$sesion->set("nombre", "Silvia Ruíz");          // GET del nombre
$sesion->set("edad", "32");                     // GET de la edad
$id_sesion = SID;                               // Guarda el SID en nueva var "id_sesion"
echo "<a href=\"prueba2.php?sid_session\">Pasar variables";
?>