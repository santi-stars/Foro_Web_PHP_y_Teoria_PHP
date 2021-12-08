<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '\Ejemplos_profe\Ejemplo5\presenter\SessionPresenter.php';
// inicializamos el presenter
$session = new SessionPresenter();


// el siguiente método redirige al usuario a Home, y en función de si la sesión está o no
// iniciada, ésta tiene una apariencia y funcionalidad u otra.

if ($session->get('user') != false) {
    // si la sesión está abierta, dará la bienvenida y permitirá el cierre de sesión
    header("location: view/home.php?sessionExists=true");
} else {
    //si la sesión no está abierta, permitirá el registro o inicio de sesión con una
    // cuenta existente
    header("location: view/home.php?sessionExists=false");
}
