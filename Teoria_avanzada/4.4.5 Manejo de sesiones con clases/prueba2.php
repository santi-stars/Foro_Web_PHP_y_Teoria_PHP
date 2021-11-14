<?php
// Mostrará por pantalla los valores actuales de la sesión mediante
// la instancia de la clase y recuperación de valores
error_reporting(E_ALL);
ini_set('display_errors', 1);

require("clase_sesion.php");                    // Carga la clase
$sesion = new Sesion();                         // Crea nuevo objeto de la clase SESION
echo $sesion->get("nombre") . "<br>";           // GET del nombre
echo $sesion->get("edad") . "<br>";             // GET de la edad
$sesion->borrar_variable("nombre");    // Borra variable
$sesion->borrar_sesion();                       // Borra sesion
