<html>
<head><title>FUNCIONES</title></head>
<body>
<p>Esto es una línea PHP</p>
<?php
// Creación de funciones
function nombre_funcion($variable)
{
    echo "código: " . $variable . "<br>";
}

nombre_funcion("pepe");

// Llamadas a funciones
/*
suma(); // llamada a función sin argumentos
suma(5); // llamada a función con un argumento
suma(13,8,6); // llamada a función con tres argumentos
*/

// Parámetros de las funciones
function suma($x, $y)
{
    $z = $x + $y;
    return $z;
}

/*
 * la función devuelve el valor de la suma, pasamos 2 valores a la función y el valor que devuelve la función se almacena
 * en la variable $resultado
 */
$resultado = suma(13, 26);
echo $resultado . "<br>";

// Paso de parámetros POR VALOR
function cuadrado($a)
{
    $a = $a * $a;
    return $a; // devuelve el cuadrado de la variable
}

$a = 5;
echo "valor de 'a' antes de llamar a la función: $a <br>";
echo "valor devuelto por la funcion: " . cuadrado($a) . "<br>";
echo "valor de 'a' después de llamar a la función $a <br>";

// Paso de parámetros POR REFERENCIA
function cuadrado2(&$a)
{
    $a = $a * $a;
    return $a; // devuelve el cuadrado de la variable
}

$a = 5;
echo "valor de 'a' antes de llamar a la función: $a <br>";
echo "valor devuelto por la funcion: " . cuadrado2($a) . "<br>";
echo "valor de 'a' después de llamar a la función $a <br>";

// Paso de parámetros POR DEFECTO
function micasa($color = "amarillo")
{
    return "Mi casa es de color $color.\n";
}

echo micasa();
echo "<br>";
echo micasa("rojo");
echo "<br>";
# El valor por defecto siempre tiene que estar a la derecha de otros parámetros sin valor por defecto
function micasa2($color1, $color2 = "amarillo")
{
    return "Mi casa es de color $color1 y color $color2.\n";
}

echo micasa2("rojo");

// Operador return
function varios_valores()
{
    return array(2, 3, 6, 8, 14);
}

$miarray = varios_valores();
for ($i = 0; $i <= 4; $i++) {
    echo $miarray[$i] . "<br>";
}


?>
</body>
</html>