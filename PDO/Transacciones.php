<?php

include "conexionPDO.php";

echo "<br>Transacciones con PDO<br><br>";
try {
    $dbh->beginTransaction();
    $stmt = $dbh->prepare("INSERT INTO players (nombre, apellido) VALUES
('Leila', 'Garcia')");
    $stmt = $dbh->prepare("INSERT INTO players (nombre, apellido) VALUES
('Antonio', 'Gomez')");
    $stmt = $dbh->prepare("INSERT INTO players (nombre, apellido) VALUES
('Leticia', 'Gurez')");
    $stmt = $dbh->prepare("INSERT INTO players (nombre, apellido) VALUES
('Raul', 'Perez')");
    $stmt = $dbh->prepare("INSERT INTO players (nombre, apellido) VALUES
('Andrés', 'Jimenez')");
    $stmt->execute();
    $dbh->commit();
    echo "Se han introducido los nuevos clientes";
} catch (Exception $e){
    echo "Ha habido algún error";
//volvemos atras todo
    $dbh->rollback(). "<br>";
}