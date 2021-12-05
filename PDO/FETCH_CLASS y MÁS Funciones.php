<?php

class Players
{
    public $id;
    public $nombre;
    public $apellido;

    public function __construct()
    {
        $this->id;
        $this->nombre = strtoupper($this->nombre); // strtoupper lo pone en mayusculas
        $this->apellido;
    }
// ....Código de la clase....
}

include "conexionPDO.php";

$stmt = $dbh->prepare("SELECT * FROM players ORDER BY id ASC");
$stmt->setFetchMode(PDO::FETCH_CLASS, 'Players');
$stmt->execute();
while ($objeto = $stmt->fetch()) {
    echo $objeto->id . ". ";
    echo $objeto->nombre . " -> ";
    echo $objeto->apellido . "<br>";
}

// fetchAll() con PDO::FETCH_ASSOC
echo "<br><br>fetchAll() con PDO::FETCH_ASSOC<br><br>";
$stmt = $dbh->prepare("SELECT * FROM players ORDER BY id ASC");
$stmt->execute();
$players = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($players as $player) {
    echo $player['nombre'] . " - " . $player['apellido'] . "<br>";
}

// fetchAll() con PDO::FETCH_OBJ
echo "<br><br>fetchAll() con PDO::FETCH_OBJ<br><br>";
$stmt = $dbh->prepare("SELECT * FROM players ORDER BY id ASC");
$stmt->execute();
$players = $stmt->fetchAll(PDO::FETCH_OBJ);
foreach ($players as $player) {
    echo $player->nombre . " - " . $player->apellido . "<br>";
}

/* exec() Devuelve el numero de filas afectadas que hemos borrado */
echo "<br><br>exec() Devuelve el numero de filas afectadas que hemos borrado<br><br>";
$count = $dbh->exec("DELETE FROM players WHERE nombre='Faustino'");
print("Borradas $count filas.\n");

// PDO::lastInsertId(). Este método devuelve el id autoincrementado del último registro
//insertado en esa conexión
echo "<br><br>PDO::lastInsertId(). devuelve el id autoincrementado del último registro insertado<br><br>";
$stmt = $dbh->prepare("INSERT INTO players (nombre, apellido)
VALUES (:nombre, :apellido)");
$nombre = "Angelina";
$apellido = "Madrid";
$stmt->bindValue(':nombre', $nombre);
$stmt->bindValue(':apellido', $apellido);
$stmt->execute();
echo $dbh->lastInsertId() . "<br>";

//PDOStatement::fetchColumn(). Otra forma de imprimir datos. Devuelve una única
//columna de la siguiente fila de un conjunto de resultados. La columna se indica con un
//integer, empezando desde cero. Si no se proporciona valor, obtiene la primera columna
echo "<br><br>PDOStatement::fetchColumn(). Otra forma de imprimir datos. Devuelve una única columna<br><br>";
$stmt = $dbh->prepare("SELECT * FROM players");
$stmt->execute();
while ($row = $stmt->fetchColumn(1)) {
    echo "Nombre: $row <br>";
}

// PDOStatement::rowCount(). Devuelve el número de filas afectadas por la última sentencia SQL:
echo "<br><br>PDOStatement::rowCount(). Devuelve el número de filas afectadas por la última sentencia SQL:<br><br>";
$stmt = $dbh->prepare("SELECT * FROM players");
$stmt->execute();
echo $stmt->rowCount() . "<br>";