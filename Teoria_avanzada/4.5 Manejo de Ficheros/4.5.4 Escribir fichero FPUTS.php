<?php
// int fputs ($fichero, string $cadena [, int $longitud ] );

// fputs(): devolverá número de bytes escritos, o valor FALSE, si hubo algún error al escribir.
// $fichero: fichero al cual escribir
// $cadena: contenido a escribir
// $longitud: (opcional) indicamos hasta donde quiere escribir
$fichero="contador.txt";
$cadena = " Estas palabras queremos añadir con FPUTS";
if ($apuntador= fopen($fichero,"a"))
{
    fputs($apuntador,$cadena);
}
fclose($apuntador);