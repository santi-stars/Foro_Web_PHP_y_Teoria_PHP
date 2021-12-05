<?php
include "conexionPDO.php";
// Prepare:
$stmt = $dbh->prepare("INSERT INTO players (nombre, apellido)
VALUES (:nombre, :apellido)");
// Bind
$nombre = "Morgan";
$apellido = "Fastini";

$stmt->bindValue(':nombre', $nombre); // Se enlaza al valor Morgan
$stmt->bindValue(':apellido', $apellido); // Se enlaza al valor Fastini
// Si ahora cambiamos el valor de $nombre:
$nombre = "John";
$stmt->execute(); // Se insertará el cliente con el nombre Morgan