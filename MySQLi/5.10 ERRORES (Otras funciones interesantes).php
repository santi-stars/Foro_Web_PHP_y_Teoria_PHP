<?php

$host = "localhost";
$user = "root";
$password = "";
$dbname = "empresa";
$link = mysqli_connect($host, $user, $password, $dbname)
or die ("No se pudo realizar la conexión! <br>");
echo "Conexión realizada con éxito! <br>";
echo "Conexión realizada con éxito!";
echo "<br>";
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n",
        mysqli_connect_error());
    exit();
}
if (!mysqli_query($link, "SET a=1")) {
    printf("Errorcode: %d\n", mysqli_errno($link));
}
/* close connection */
mysqli_close($link);

/*
 * Esta función debería de devolver un error como el siguiente:
 * Errorcode: 1193     PERO NO DEVUELVE UNA PUTA MIERDA!!!
 */