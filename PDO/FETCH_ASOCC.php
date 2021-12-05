<?php
include "conexionPDO.php";
// FETCH_ASSOC
echo "<br><br><strong>FETCH_ASSOC</strong><br><br>";
$stmt = $dbh->prepare("SELECT * FROM players");
// Especificamos el fetch mode antes de llamar a fetch()
$stmt->setFetchMode(PDO::FETCH_ASSOC);
// Ejecutamos
$stmt->execute();
// Mostramos los resultados
while ($row = $stmt->fetch()) {
    echo "Nombre: {$row["nombre"]} <br>";
    echo "Apellido: {$row["apellido"]} <br><br>";
}