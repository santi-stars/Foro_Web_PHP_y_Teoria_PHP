<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;
charset=UTF-8"/>
    <title>Listado de Registros</title>
</head>
<body>
<?php
// conectamos a la base de datos
include ("connect-db.php");
// obtenemos los resultados de la base de datos mediante la consulta
$result = mysqli_query($connection,"SELECT * FROM players ORDER BY id ASC")
or die(mysqli_error());
/* Visualizamos los datos en una tabla
Primero mostramos los links necesarios para ver sin paginar
o
paginados. El parámetro ?page, nos indicará al tener valor
1 que es
primera página de resultados posibles.
*/
echo "<p><b>Ver todos</b> | <a href='view-paginated.php?
page=1'>Ver paginados</a></p>";
echo "<table border='1' cellpadding='10'>";
echo "<tr> <th>ID</th> <th>Nombre</th> <th>Apellido</th>
<th></th><th></th></tr>";
// bucle para extraer los resultados de la base de datos
// los visualiza en el interior de la tabla
while($row = mysqli_fetch_array( $result ))
{
// salida contenidos de cada columna en filas de la tabla
    echo "<tr>";
    echo '<td>' . $row['id'] . '</td>';
    echo '<td>' . $row['nombre'] . '</td>';
    echo '<td>' . $row['apellido'] . '</td>';
    echo '<td><a href="edit.php?id=' . $row['id'] .
        '">Editar</a></td>';
    echo '<td><a href="delete.php?id=' . $row['id'] .
        '">Eliminar</a></td>';
    echo "</tr>";
}
// terminamos la tabla
echo "</table>";
/* En la parte final de la página, mostramos un link para
añadir un nuevo registro*/
?>
<p><a href="new.php">Añadir un nuevo registro</a></p>
</body>
</html>
