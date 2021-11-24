<?php
$dbname = "foroMotos";
$host = "localhost";
$user = "root";
$password = "contraseñaForoMotos";

$conexion = mysqli_connect($host, $user, $password, $dbname) or die ("No se pudo realizar la conexión!");
echo "Conexión realizada con éxito!";
echo "<br>";

//Función para ejecutar mysql_result de una manera compatible a mysqli
function mysqli_result($res, $row = 0, $col = 0)
{
    $numrows = mysqli_num_rows($res);
    if ($numrows && $row <= ($numrows - 1) && $row >= 0) {
        mysqli_data_seek($res, $row);
        $resrow = (is_numeric($col)) ? mysqli_fetch_row($res) : mysqli_fetch_assoc($res);
        if (isset($resrow[$col])) {
            return $resrow[$col];
        }
    }
    return false;
}

// número de resultados para mostrar por página
$per_page = 3;
// calcular el total de páginas en la base de datos
$result = mysqli_query($conexion, "SELECT `user_nick`,`user_email` FROM `users` ORDER BY `user_reg_date` DESC;");
$total_results = mysqli_num_rows($result);
// la función ceil() redondea el resultado hacia arriba
$total_pages = ceil($total_results / $per_page);
// comprueba si la varible “page” está configurada en la URL
//  EJEMPLO:  view-paginated.php?page=1
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $show_page = $_GET['page'];
// Nos aseguramos que el valor de $show_page es válido
    if ($show_page > 0 && $show_page <= $total_pages) {
        $start = ($show_page - 1) * $per_page;
        $end = $start + $per_page;
    } else {
// error - muestra el primer conjunto de resultados
        $start = 0;
        $end = $per_page;
    }
} else {
    /* Si la página no está configurada, muestra el
    primer conjunto de resultados*/
    $start = 0;
    $end = $per_page;
}
// Muestra la Paginación en la parte superior de la pantalla
echo "<p><b>Ver P&aacute;gina:</b>";
for ($i = 1; $i <= $total_pages; $i++) {
    echo "<a href='paginacion.php?page=$i'>$i</a>";
}
echo "</p>";
// Visualiza los datos en la tabla
echo "<table border='1' cellpadding='10'>";
echo "<tr> <th>ARTICULO</th> <th>CATEGORIA</th></tr>";
// bucle a través de los resultados de la consulta a la base de datos,
// visualizándolos en la tabla
for ($i = $start; $i < $end; $i++) {
// nos aseguramos que PHP no intenta mostrar los resultados que no existan
    if ($i == $total_results) {
        break;
    }
// visualiza los contenidos en una tabla
    for ($i = $start; $i < $end; $i++) {
// nos aseguramos que PHP no intenta mostrar los resultados que no existan
        if ($i == $total_results) {
            break;
        }
// visualiza los contenidos en una tabla
// para cada fila, extrae sus campos
// y al final muestra los enlaces para editar o eliminar correspondientes al ID
echo "<tr>";
echo "<td>" . mysqli_result($result, $i, ‘ARTICULO’) . "</td>";
echo "<td>" . mysqli_result($result, $i, ‘CATEGORIA’) . "</td>";
echo "</tr>";
}
// cerramos la tabla>
    echo "</table>";
// paginación