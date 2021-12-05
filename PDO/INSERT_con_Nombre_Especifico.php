<?php
include "conexionPDO.php";
// Prepare
$stmt = $dbh->prepare("INSERT INTO players (nombre, apellido)
VALUES (:nombre, :apellido)");
// Bind
$nombre = "Tortellini";
$apellido = " Italiani";
$stmt->bindParam(':nombre', $nombre);
$stmt->bindParam(':apellido', $apellido);
// Excecute
$stmt->execute();