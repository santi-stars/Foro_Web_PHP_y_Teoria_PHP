<?php

include_once 'C:\xampp\htdocs\Teoria\Ejemplos_profe\Ejemplo5\presenter\sesion_controler.php';
// inicializamos el presenter
$session = new sesioncontroler();


// el siguiente método redirige al usuario a Home, y en función de si la sesión está o no
// iniciada, ésta tiene una apariencia y funcionalidad u otra.

if ($session->get5('user') != false) {
    // si la sesión está abierta, dará la bienvenida y permitirá el cierre de sesión
    header("location: view/home.php?sessionExists=true");
} else {
    //si la sesión no está abierta, permitirá el registro o inicio de sesión con una
    // cuenta existente
    header("location: view/home.php?sessionExists=false");
}
