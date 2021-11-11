<html>
<head><title>Tipos de datos</title></head>
<body>
<?php
// ENTEROS
$a = 1234;
$a = 01234;
$a = 0x1234;
$a = -1234;

// FLOAT o DOUBLE
$a = 1.234;
$a = 1.2e3;

// CADENA
$pais = "España";
$ciudad = 'Zaragoza';

// BOOLEANO
$porelano = true;

// CONVERIONES
$numero = 10;//tipo entero
$numero2 = (double)$numero; // $numero2 es tipo double

$a = "hola";
$array = (array)$a;// $array será tipo array y su primer valor será una cadena
echo $array[0];// tendremos como salida “hola”

$objeto = (object)$a; //se convierte a tipo objeto

$var1 = 11.1;
$var2 = (int)$var1;//la convertimos a tipo entero con valor 11
echo $var2;

$var = 8.5;
echo "$var<br>";
settype($var, "integer");    // Convertimos a ENTERO
echo "$var";

// Averiguar tipo de variable
$edad = "34";
print ("Tipo actual: " . gettype($edad) . "<br>");
settype($edad, "integer");
print ("Tipo actual: " . gettype($edad) . "<br>");

// Chequear Var
$edad = 34.8;
if (is_int($edad)) echo "$edad" . " es un entero;";
else echo "$edad" . " no es un entero";

// Constantes

const CIUDAD = "Zaragoza";
const PAIS = "España";
echo "Vivo en " . CIUDAD . "< br>";
echo "Y mi país es " . PAIS;

echo __LINE__ . ".- VERSION de PHP:" . PHP_VERSION;
echo "<br>";
echo __LINE__ . ".- SISTEMA Operativo del Servidor: " . PHP_OS;

// Asignar por referencia

$var1 = "Silvia"; // Asigna el valor ‘Silvia’ a $var1
$var2 = &$var1; // Referencia $var1 vía $var2.
$var2 = "Mi nombre es $var2 <br>"; // Modifica $var2...
echo $var1; // $var1 también se modifica.
echo $var2;

// Variable de variables

$var = "ciudad";
$$var = "Zaragoza";
echo $ciudad . "<br>"; //el resultado es Zaragoza
echo $$var; //el resultado es Zaragoza

// Supervariables

echo "Tu dirección IP es: " . $_SERVER["REMOTE_ADDR"] . "<br>";
echo "Tu directorio de proyectos es : " . $_SERVER["DOCUMENT_ROOT"] . "<br>";

// Ambitos de las variables

# Dá error porque no referencia a la variable global

$a = 1; // ámbito global
function prueba()
{
    echo "$a"; // referencia a una variable de ámbito local
}

Test();


# Referencia a las variables globales dentro de la función
$var1 = 1;
$var2 = 2;
function suma()
{
    global $var1, $var2;
    $var2 = $var1 + $var2;
}

suma();
echo $var2 . "<br>";

# Static mantiene su valor dentro de su ambito y para la cuenta atras hay que llamar al método varias veces hasta dejarlo a 0
function Cuentaatras()
{
    static $a = 10;
    echo $a . "<br>";
    $a--;
}

Cuentaatras();
Cuentaatras();
?>
</body>
</html>















