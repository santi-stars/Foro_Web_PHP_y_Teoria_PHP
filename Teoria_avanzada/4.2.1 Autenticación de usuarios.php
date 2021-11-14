<html>
<head><title>Autenticación de usuarios</title></head>
<body>
<?php
function validar($user, $pass)
{
    $users = array('silvia' => 'silvia', 'pedro' => 'perico');
    if (isset($users[$user]) && ($users[$user] == $pass)) {
        return true;
    } else {
        return false;
    }
}

//codigo principal de la validación
if (!validar($_SERVER['PHP_AUTH_USER'],
    $_SERVER['PHP_AUTH_PW'])) {
    header('WWW-Authenticate:Basic realm = "Mi zona web"');
    header('HTTP/1.0 401 Unauthorized');
    echo "Usuario y contraseña incorrectos";
    exit;
} else {
    echo "Bienvenido/a " . $_SERVER['PHP_AUTH_USER'];
}
?>
</body>
</html>