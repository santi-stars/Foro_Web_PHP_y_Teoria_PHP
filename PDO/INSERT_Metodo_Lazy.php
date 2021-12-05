<?php
include "conexionPDO.php";
// Prepare:
$stmt = $dbh->prepare("INSERT INTO players (nombre, apellido)
VALUES (:nombre, :apellido)");
$nombre = "Faustino";
$apellido = "Caramandarino";
// Bind y execute:
if($stmt->execute(array(':nombre'=>$nombre, ':apellido'=>$apellido))) {
    echo "<br>Se ha creado el nuevo registro!";
}