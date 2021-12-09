<html>
<head>
    <title>LIBRERIA UAZON</title>
</head>
<body>
<h1>Ver datos de un libro</h1>
<table border="1">
    <tr>
        <th>TITULO</th>
        <th>PRECIO</th>
    </tr>
    <tr>
        <td><?php echo $libro['titulo'] ?></td>
        <td><?php echo number_format($libro['precio'], 2) ?></td>
    </tr>
</table>
</body>
</html>