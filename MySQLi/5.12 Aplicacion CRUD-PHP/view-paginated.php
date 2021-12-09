<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;
charset=utf-8"/>
    <title>Paginaci&oacute;n Con MySQLi</title>
</head>
<body>
<?php
/*
VIEW-PAGINATED.PHP
Visualiza todos los datos de la tabla “player”
Es una versión modificada del fichero views.php, que
incluye paginación
*/
//Función para ejecutar mysql_result de una manera compatible a mysql
function mysqli_result($res, $row = 0, $col = 0)
{
    $numrows = mysqli_num_rows($res);
    if ($numrows && $row <= ($numrows - 1) && $row >= 0) {
        mysqli_data_seek($res, $row);
        $resrow = (is_numeric($col)) ?
            mysqli_fetch_row($res) : mysqli_fetch_assoc($res);
        if (isset($resrow[$col])) {
            return $resrow[$col];
        }
    }
    return false;
}

// conectamos a la base de datos
include('connect-db.php');
// número de resultados para mostrar por página
$per_page = 3;
// calcular el total de páginas en la base de datos
$result = mysqli_query($connection, "SELECT * FROM players ORDER BY id ASC") or die(mysqli_error());
$total_results = mysqli_num_rows($result);
// la función ceil() redondea el resultado hacia arriba
$total_pages = ceil($total_results / $per_page);
// comprueba si la varible "page" está configurada en la URL
// EJEMPLO: views-paginated.php?page=1
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $show_page = $_GET['page'];
// Nos aseguramos que el valor de $show_page es válido
    if ($show_page > 0 && $show_page <= $total_pages) {
        $start = ($show_page - 1) * $per_page;
        $end = $start + $per_page;
    } else { // error - muestra el primer conjunto de resultados
        $start = 0;
        $end = $per_page;
    }
} else { /* Si la página no está configurada, muestra el
primer conjunto de resultados*/
    $start = 0;
    $end = $per_page;
}
// Muestra la Paginación en la parte superior de la pantalla
echo "<p><a href='views.php'>Ver todas</a> | <b>Ver P&aacute;gina:</b> ";
for ($i = 1; $i <= $total_pages; $i++) {
    echo "<a href='views-paginated.php?page=$i'>$i</a>";
}
echo "</p>";
// Visualiza los datos en la tabla
echo "<table border='1' cellpadding='10'>";
echo "<tr> <th>ID</th> <th>Nombre</th> <th>Apellido</th>
<th></th> <th></th></tr>";
// bucle a través de los resultados de la consulta a la base de datos, visualizándolos en la tabla
for ($i = $start; $i < $end; $i++) {
// nos aseguramos que PHP no intenta mostrar los resultados que no existan
    if ($i == $total_results) {
        break;
    }

// visualiza los contenidos en una tabla para cada fila,extrae sus campos
// y al final muestra los enlaces para editar o eliminar correspondientes al ID
    echo "<tr>";
    echo '<td>' . mysqli_result($result, $i, 'id') . '</td>';
    echo '<td>' . mysqli_result($result, $i, 'nombre') . '</td>';
    echo '<td>' . mysqli_result($result, $i, 'apellido') . '</td>';
    echo '<td><a href="edit.php?id=' . mysqli_result($result, $i, 'id') . '">Editar</a></td>';
    echo '<td><a href="delete.php?id=' . mysqli_result($result, $i, 'id') . '">Eliminar</a></td>';
}
echo "</tr>";
?>
</body>
</html>