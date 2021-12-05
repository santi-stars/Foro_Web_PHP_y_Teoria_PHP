<?php
include "conexionPDO.php";
// Prepare:
$stmt = $dbh->prepare("INSERT INTO players (nombre, apellido)
VALUES (:nombre, :apellido)");
// Bind
$nombre = "Tortellini";
$apellido = "Mongolini";

$stmt->bindParam(':nombre', $nombre); // Se enlaza a la variable a $nombre
$stmt->bindParam(':apellido', $apellido);// Se enlaza a la variable a $apellido
// Si ahora cambiamos el valor de $nombre:
$nombre = "John";
$stmt->execute(); // Se insertará el cliente con el nombre John