<html>
<head><title>Funciones isset() y unset()</title></head>
<body>
<p>Esto es una línea PHP</p>
<?php
// Con ISSET() comprobamos si una variable tiene valor, devuelve TRUE si es así y FALSE de lo contrario
// Con UNSET() destruimos la variable y liberamos recursos
$Nombre = "Silvia";
if (isset($Nombre)) {
    echo("La variable Nombre tiene un valor: " . $Nombre . "<br>");
}
unset($Nombre); // liberamos la variable $Nombre
if (isset($Nombre)) {
    echo("La variable Nombre aún existe.");
} else {
    echo("La variable Nombre ya no existe.");
}
?>
</body>
</html>