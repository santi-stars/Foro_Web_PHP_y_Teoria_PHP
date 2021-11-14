<?php
$fichero = @fopen("contador.txt", "r") or die("El fichero no ha podido ser abierto");   // ABRIR

// ESTO CIERRA el Fichero
fclose($fichero);