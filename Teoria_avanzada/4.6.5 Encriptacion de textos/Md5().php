<?php
// Función MÁS UTILIZADA para encriptar CONTRASEÑAS, siempre genera el mismo resultado para la misma cadena
// y es de una sola vía, no es posible volver a descodificarla.

function cryptconMD5($string)
{   // Creamos un salt
    $salt = md5($string . "%*4!#$;.k~’(_@");
    $string = md5("$salt$string$salt");
    return $string;
}

$password = "ladonnaemobile";
echo "<br> MD5: " . cryptconMD5($password);