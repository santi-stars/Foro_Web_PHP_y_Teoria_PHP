<?php
include "conexionPDO.php";
//FETCH_BOUND
echo "<br><br><strong>FETCH_BOUND</strong><br><br>";
// Preparamos
$stmt = $dbh->prepare("SELECT nombre, apellido FROM players");
// Ejecutamos
$stmt->execute();
// bindColumn
$stmt->bindColumn(1, $nombre);
$stmt->bindColumn('apellido', $apellido);
// Ahora vamos a indicar el fetch mode cuando llamamos a fetch:
while ($row = $stmt->fetch(PDO::FETCH_BOUND)) {
    $players = $nombre . ": " . $apellido;
    echo $players . "<br>";
}
