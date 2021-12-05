<?php

include "conexionPDO.php";

echo "<br>Transacciones con PDO<br><br>";
try {
    $dbh->beginTransaction();
    $dbh->query("INSERT INTO players (nombre, apellido) VALUES
('Leila', 'Garcia')");
    $dbh->query("INSERT INTO players (nombre, apellido) VALUES
('Antonio', 'Gomez')");
    $dbh->query("INSERT INTO players (nombre, apellido) VALUES
('Leticia', 'Gurez')");
    $dbh->query("INSERT INTO players (nombre, apellido) VALUES
('Raul', 'Perez')");
    $dbh->query("INSERT INTO players (nombre, apellido) VALUES
('Andrés', 'Jimenez')");
    $dbh->exec("INSERT INTO players (nombre, apellido) VALUES
('Andrés', 'Jimenez')");
    $dbh->commit();
    echo "Se han introducido los nuevos clientes";
} catch (Exception $e){
    echo "Ha habido algún error";
//volvemoa atras todo
    $dbh->rollback(). "<br>";
}