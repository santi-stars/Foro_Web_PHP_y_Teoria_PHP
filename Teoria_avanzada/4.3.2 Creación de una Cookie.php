<?php
// configuramos los cookies
setcookie("cookie[tres]", "Valor de la cookie tres", time() + 3600);
setcookie("cookie[dos]", "Valor de la cookie dos", time() + 3600);
setcookie("cookie[one]", "Valor de la cookie uno", time() + 3600);
// después de recargar la página, tendrá que visualizar lo siguiente
if (isset($_COOKIE['cookie'])) {
    foreach ($_COOKIE['cookie'] as $name => $value) {
        echo "$name : $value \n" . "<br>";
    }
}