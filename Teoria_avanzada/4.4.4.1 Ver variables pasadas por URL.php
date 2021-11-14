<?php
session_start();
echo "Mostrar las variables de sesión" . "<br>";
foreach ($_SESSION as $indice => $valor) {
    echo "$indice: $valor " . "<br>";
}

