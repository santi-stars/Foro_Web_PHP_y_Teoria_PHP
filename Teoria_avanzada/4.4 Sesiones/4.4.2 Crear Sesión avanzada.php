<?php
session_start();
$_SESSION["nombre"] = "Santi Ballestin";
$_SESSION["edad"] = 34;

if (!isset($_SESSION['contador'])) {
    $_SESSION['contador'] = 0;
} else {
    $_SESSION['contador']++;
}
echo "El valor de la variable NOMBRE es: " . $_SESSION['nombre'] . "<br>";
echo "El valor de la variable EDAD es: " . $_SESSION["edad"] . "<br>";
echo "El valor de la variable CONTADOR es : " . $_SESSION["contador"] . "<br>";
echo "Mostrar las variables de sesión" . "<br>";
foreach ($_SESSION as $indice => $valor) {
    echo "$indice: $valor " . "<br>";
}
// BORRAR VARIABLE de sesión
// unset($_SESSION['contador']);

// CERRAR SESIÓN
// $_SESSION = array();    // Eliminamos todas las variables registradas en la sesión
// session_destroy();      // Destruimos la sesión de forma definitiva