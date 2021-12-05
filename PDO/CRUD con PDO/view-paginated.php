<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Paginaci&oacute;n Con PDO</title>
</head>
<body>
<?php
// conectamos a la base de datos
include('connect-db.php');
// número de resultados para mostrar por página
$per_page = 3;
//examino la página a mostrar y el inicio del registro a mostrar
$page = 1;
$inicio = 0;
if (isset($_GET["page"])) {
    $page = $_GET["page"];
    $inicio = ($page - 1) * $per_page;
}
//veo el número total de registros de la tabla
try {
//configuramos el prepared statement
    $stmt = $dbh->prepare('SELECT * FROM players');
    $stmt->execute();
    $total_results = $stmt->rowCount();
} catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage();
}
//calculo el total de páginas
$total_pages = ceil($total_results / $per_page);
try {
    $ssql = "SELECT * FROM players LIMIT " . $inicio . "," . $per_page;
    $rs = $dbh->prepare($ssql);
    $rs->execute();
} catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage();
}
echo "<p><a href='view.php'>Ver todas</a> | <b>Ver Página:</b> ";
//muestro los distintos índices de las páginas, si es que hay varias
if ($total_pages > 1) {
    for ($i = 1; $i <= $total_pages; $i++) {
        if ($page == $i)
//si muestro el índice de la página actual, no coloco enlace
            echo $page . " ";
        else
//si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página
            echo "<a href='view-paginated.php?page=" . $i . "'>" . $i . "</a>
";
    }
}
echo "</p>";
//Empiezo con la tabla
echo "<table border='1' cellpadding='10'>";
echo "<tr> <th>ID</th> <th>Nombre</th> <th>Apellido</th>
<th></th><th></th></tr>";
while ($fila = $rs->fetchAll(PDO::FETCH_ASSOC)) {
    foreach ($fila as $player) {
// salida de contenidos de cada columna en una fila de la tabla
        echo "<tr>";
        echo '<td>' . $player['id'] . '</td>';
        echo '<td>' . $player['nombre'] . '</td>';
        echo '<td>' . $player['apellido'] . '</td>';
        echo '<td><a href="edit.php?id=' . $player['id'] . '">Editar</a></td>';
        echo '<td><a href="delete.php?id=' . $player['id'] . '">Eliminar</a></td>';
        echo "</tr>";
    }
}
// terminamos la tabla
echo "</table>";
/* En la parte final de la página, mostramos un link para añadir un nuevo
registro*/
?>
<p><a href="new.php">Añadir un nuevo registro</a></p>
</body>
</html>