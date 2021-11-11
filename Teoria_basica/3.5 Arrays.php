<html>
<head><title>ARRAYS</title></head>
<body>
<p>Esto es una línea PHP</p>
<?php
// Crear ARRAY
$nombres[] = "Paco";
$nombres[] = "Silvia";
$nombres[] = "Cristian";

//Crear ARRAY según el indice
$nombres[2] = "Paco";
$nombres[5] = "Silvia";
$nombres[10] = "Cristian";

//Contar número de elementos del ARRAY
$numeroElementos = count($nombres);

//Añadir valores al ARRAY
$nombres = array("Paco", "Silvia", "Cristian", "Víctor");
echo "Añadir valores al ARRAY $nombres[2] <br>";

//Modificar el valor de un índice del ARRAY asi: 3=>"Silvia"
$nombres = array("Paco", 3 => "Silvia", "Cristian", "Víctor");
echo "$nombres[4] <br>";

//ARRAYS asociativos
$notas = array(
    "lengua" => 8,
    "matematicas" => 6,
    "programacion" => 3
);
echo " " . $notas['programacion'] . "<br>"; // Imprime el 3

//ARRAYS asociativos de otra forma
$notas["lengua"] = 8;
$notas["matematicas"] = 6;
$notas["programacion"] = 4;
echo " " . $notas['programacion'] . "<br>";

//ARRAYS MULTIDIMENSIONALES
$flores = array(
    array(
        'titulo' => "Rosa",
        'precio' => "2.00€",
        'numero' => "25"
    ),
    array(
        'titulo' => "Gardenia",
        'precio' => "1.50€",
        'numero' => "35"
    ),
    array(
        'titulo' => "Clavel",
        'precio' => "1.00€",
        'numero' => "40"
    )
);
echo $flores [0]["titulo"] . " - ";
echo $flores [0]["precio"] . " - ";
echo $flores [0]["numero"] . "  <br>";

//ARRAYS en BASES de DATOS
$consulta = "SELECT nombre, apellidos FROM alumnos"; // Guardamos la consulta en $consulta
/*
$query=mysql_query($consulta,$connect);
// Guardamos en $query la ejecución de la consulta conectando con la variable de conexión $connect
$fila=  mysql_fetch_array($query);
// Guardamos como ARRAY el resultado de la consulta a través de "mysql_fetch_array" con la consulta $query de parámetro
echo $fila[“nombre”];   // Imprime el campo "nombre"
echo $fila[1];  // Imprime el campo "apellido"
*/

// Recuperar contenido de ARRAY
$flores = array(array("Titulo" => "rosa",
    "Precio" => 2,
    "Numero" => 7),
    array("Titulo" => "gardenia",
        "Precio" => 3.5,
        "Numero" => 2),
    array("Titulo" => "clavel",
        "Precio" => 6.5,
        "Numero" => 6));

foreach ($flores as $item) {
    echo $item["Titulo"] . ": " . $item["Precio"] . "€, " . $item["Numero"] . " unidades <br>";
}
// Otra forma de utilizar FOREACH
foreach ($flores as $item) {
    foreach ($item as $indice => $valor) {
        echo "$indice:$valor" . "<br>"; // Indice de la variable y su valor
    }
}

// Recorrer ARRAY con WHILE y EACH()
$flores = array("rosa", "gardenia", "clavel");

while ($item = each($flores)) {
    echo $item["key"] . "-" . $item["value"] . "<br>"; // Indice de la variable seguido de su valor
}

// Recorrer ARRAY con WHILE y LIST()
$flores = array(
    array(
        'titulo' => "Rosa",
        'precio' => "2.00€",
        'numero' => "25"
    ),
    array(
        'titulo' => "Gardenia",
        'precio' => "1.50€",
        'numero' => "35"
    ),
    array(
        'titulo' => "Clavel",
        'precio' => "1.00€",
        'numero' => "40"
    )
);

while (list($clave, $valor) = each($flores)) {
    echo "Posición del array multidimensional: " . $clave . " " . $valor["titulo"] . " - " . $valor["precio"]
        . " - " . $valor["numero"] . "<br>";
}

// Recorrer ARRAY con WHILE y LIST()
for ($i = 0; $i < count($flores); $i++) {
    while ($elemento = each($flores[$i])) {
        echo "for, while y count: ";
        echo $elemento[0] . "=" . $elemento[1] . "<br>\n";
    }
    echo "<br>\n";
}

//EJERCICIOS DE CLASE
echo "<br>";
$array = array();
for ($i = 0; $i < 10; $i++) {
    $numero = rand(0, 100);
    array_push($array, $numero);
}
print_r($array);
echo "<br>";

echo "FOR <br>";
for ($i = 0; $i < count($array); $i++) {
    echo "<p>El array con indice $i tiene el valor $array[$i]</p>";
}
echo "FOR EACH<br>";
foreach ($array as $c => $v) {
    echo "<p>El array con indice $c tiene el valor $v</p>";
}

echo "WHILE <br>";
$i = 0;
while ($i < count($array)) {
    echo "<p>El array con indice $i tiene el valor $array[$i]</p>";
    $i++;
}
?>
</body>
</html>