<?php
include "conexionPDO.php";
// Prepare
$stmt = $dbh->prepare("INSERT INTO players (nombre, apellido)
VALUES (?, ?)");
// Bind
$nombre = "Miguel";
$apellido = "Hernandez";
$stmt->bindParam(1, $nombre);
$stmt->bindParam(2, $apellido);
// Excecute
$stmt->execute();