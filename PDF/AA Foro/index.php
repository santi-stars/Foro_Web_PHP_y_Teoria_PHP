<?php

require_once 'controllers\session_controller.php';
// inicializamos el session_controler
$session = new SessionController();


// el siguiente método redirige al usuario a Home, y en función de si la sesión está o no
// iniciada, ésta tiene una apariencia y funcionalidad u otra.

if ($session->get('user') != false) {
    // si la sesión está abierta, dará la bienvenida y permitirá el cierre de sesión
    header("location: views/home.php?sessionExists=true");
} else {
    //si la sesión no está abierta, permitirá el registro o inicio de sesión con una
    // cuenta existente
    header("location: views/home.php?sessionExists=false");
}
