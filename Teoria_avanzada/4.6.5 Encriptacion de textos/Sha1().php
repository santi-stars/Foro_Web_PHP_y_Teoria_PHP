<?php

function cryptconsha1($string)
{ // Creamos un salt
    $salt = sha1($string . "%*4!#$;.k~’(_@");
    $string = sha1("$salt$string$salt");
    return $string;
}

$password = "ladonnaemobile";
echo "<br>SHA1: " . cryptconsha1($password);