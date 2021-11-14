<?php
// Mostrará por pantalla los valores actuales de la sesión mediante
// la instancia de la clase y recuperación de valores
error_reporting(E_ALL);
ini_set('display_errors', 1);
require("clase_sesion.php");
$sesion = new Sesion();
echo $sesion->get("nombre") . "<br>";
echo $sesion->get("edad") . "<br>";
$sesion->borrar_variable("nombre");
$sesion->borrar_sesion();
