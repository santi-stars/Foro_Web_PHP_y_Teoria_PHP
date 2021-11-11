<html>
<head><title>OPERADORES</title></head>
<body>
<p>Esto es una línea PHP</p>
<?php
/*  OPERADORES ARITMÉTICOS
 * "+" para sumar: $a + $b
 * "-" para restar: $a - $b
 * "*" para multiplicar: $a * $b
 * "/" para la divisir: $a / $b
 * "%" para el módulo $a%$b
*/

// OPERADORES DE CONCATENACIÓN
$a = "Yo trabajo en";
$b = $a . "mi casa"; // $b contiene "Yo trabajo en mi casa"

echo $b;
$a = "Yo trabajo en";
$a .= "mi casa"; // ahora $a contiene “Yo trabajo en mi casa”
echo $a;

// OPERADORES DE ASIGNACIÓN
$b = 6 + ($a = 5);

$a = 2;
$a += 4; // establece $a a 6, igual que $a = $a + 4;
echo $a;
$a = 4;
$a /= 2; // establece $a a 2, igual que $a = $a / 2;
echo $a;

// OPERADORES DE INCREMENTO Y DECREMENTO

echo "<h3>Postincremento</h3>";

$a = 5;
echo $a++ . "<br>\n";
echo $a . "<br>\n";
echo "<h3>Preincremento</h3>";
$a = 5;
echo ++$a . "<br>\n";
echo $a . "<br>\n";
echo "<h3>Postdecremento</h3>";
$a = 5;
echo $a-- . "<br>\n";
echo $a . "<br>\n";
echo "<h3>Predecremento</h3>";
$a = 5;
echo --$a . "<br>\n";
echo $a . "<br>\n";

// OPERADORES CONDICIONALES

/*
==  Igual ($x y $z TRUE si tienen el mismo valor) $x==$z
=== Idéntico ($x y $z TRUE si tienen el mismo valor y son del mismo tipo) $x===$z
!=  Diferente ($x y $z TRUE si son de diferente valor) $x!=$z
<   Menor (TRUE si $x es menor que $z) $x<$z
>   Mayor (TRUE si $x es mayor que $z) $x>$z
<=  Menor o igual (TRUE si $x es menor o igual que $z) $x<=$z
>=  Mayor o igual (TRUE si $x es mayor o igual que $z) $x>=$z
*/

// OPERADORES DE EJECUCIÓN
$var = `ls -al`; // para sistemas Unix

echo "<pre>" . $var . "</pre>";
$var = `dir c:`; // para sistemas Windows
echo "<pre>" . $var . "</pre>";

// OPERADORES LÓGICOS

/*
$a && $b True si $a y $b son verdaderos
$a AND $b Igual que && pero con prioridad más baja

$a || $b True si $a o $b son verdaderos
$a OR $b Igual que || pero con prioridad más baja

$a XOR $b Es matemáticamente igual a (a AND (NOT b)) OR ((NOT a) and b)

!$a True si $a no es verdadero
*/
?>
</body>
</html>