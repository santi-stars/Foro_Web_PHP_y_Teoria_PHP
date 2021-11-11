<html>
<head><title>Manejo de fechas y tiempo</title></head>
<body>
<p>Esto es una línea PHP</p>
<?php
// Función CHECKDATE() devuelve true en caso de que la fecha sea válida
$mes = 8;
$dia = 2;
$ano = 2011;

if (checkdate($mes, $dia, $ano)) {
    echo "La fecha es correcta" . "<br>";
} else {
    echo "La fecha no es correcta" . "<br>";
}

// Función string date(string format [, int timestamp]) damos formato a la fecha y hora según el formato que le pasamos
// por cadena
echo "Hola a todos, coleguis!!! <br><br>";
echo "Hoy es " . " ", date("d/m/Y"), " y la hora actual es ",
date("h:i:s");
echo "<br><br>o de esta forma: <br><br>";
echo (date("l dS of F Y h:i:s A")) . "<br><br>";

// Función array getdate(int timestamp), devuelve un ARRAY con la info de la fecha
$fecha = getdate();
echo("Dia: " . $fecha["mday"] . "<br>");
echo("Mes: " . $fecha["mon"] . "<br>");
echo("Hora: " . $fecha["hours"] . "<br>");
echo("Minutos: " . $fecha["minutes"] . "<br>");
echo("Segundos: " . $fecha["seconds"] . "<br><br>");

//Función int mktime (int hour, int minute, int second, int month, int day, int year [, int is_dst])
$fecha = mktime(19, 15, 00, 8, 15, 2021);
echo $fecha . "<br>";
echo date("d-M-Y", mktime(19, 15, 00, 8, 15, 2021)) . "<br><br>";
# Comprueba la fecha y dá una aproximación
echo date("d-M-Y", mktime(0, 0, 0, 8, 32, 2021)) . "<br><br>";

//Función int time() devuelve fecha actual en formato TIMESTAMP
$hora = time();
echo $hora . "<br>";
$hora = getdate(time());
echo $hora["hours"] . ":" . $hora["minutes"] . ":" . $hora["seconds"];


?>
</body>
</html>