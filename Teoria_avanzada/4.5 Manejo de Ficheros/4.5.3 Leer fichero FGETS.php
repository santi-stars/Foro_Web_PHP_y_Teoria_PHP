<?php // LEER Ficheroo
// string fgets ($fichero [, int $longitud ] );
// $longitud: indicamos el nº de caracteres a leer, si queremos...si no, lee hasta el final

$fichero = @fopen("contador.txt", "r") or die("El fichero no ha podido ser abierto");
if ($fichero) {
    while (($linea = fgets($fichero, 5)) !== false) {
        echo $linea;
        echo "<br>";
    }
    fclose($fichero);
}