<?php
include "conexionPDO.php";
// FETCH_OBJ
echo "<br><br><strong>FETCH_OBJ</strong><br><br>";
$stmt = $dbh->prepare("SELECT * FROM players");
// Ejecutamos
$stmt->execute();// Ahora vamos a indicar el fetch mode cuando llamamos a fetch:
while($row = $stmt->fetch(PDO::FETCH_OBJ)){
    echo "Nombre: " . $row->nombre . "<br>";
    echo "Apellido: " . $row->apellido . "<br><br>";
}