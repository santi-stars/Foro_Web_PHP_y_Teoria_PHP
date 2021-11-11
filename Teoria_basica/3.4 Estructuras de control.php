<html>
<head><title>ESTRUCTURAS DE CONTROL</title></head>
<body>
<p>Esto es una línea PHP</p>
<?php
// IF
$a = 44;
$b = 77;
if ($a <= $b) {
    echo "Si la expresión es TRUE, esta parte se ejecuta";
}

//IF ELSE
$a = 44;
$b = 77;
if ($a >= $b) {
    echo "Si la expresión es TRUE, esta parte se ejecuta";
} else {
    echo "Si la expresión es TRUE, esta parte NO se ejecuta";
}

//ELEIF
$a = 44;
$b = 77;

if ($a > $b) {
    echo "a es mayor que b";
} elseif ($a == $b) {
    echo "a es igual que b";
} else {
    echo "a es menor que b";
}

//SINTAXIS ALTERNATIVA IF/ELSE

#1
$a = 44;
$b = 77;
if ($a > $b) :
    echo "a es mayor que b";
elseif ($a == $b):
    echo "a es igual que b";
else:
    echo "a es menor que b";
endif;

#2
$var = 5;
$var == 5 ? "$var es igual a 5" : "$var es diferente de 5";
# Es lo mismo que:

if ($var == 5) {
    echo "$var es igual a 5";
} else {
    echo "$var es diferente de 5";
}

//SWITCH
$ciudad = "Zaragoza";
switch ($ciudad) {
    case "Zaragoza":
        echo "la comunidad es Aragón";
        break;
    case "Barcelona":
        echo "la comunidad es Cataluña";
        break;
    case "Castellón":
        echo "la comunidad es Valencia";
        break;
    default:
        echo "otra comunidad autonoma";
}

//SINTAXIS ALTERNATIVA SWITCH
$ciudad = "Zaragoza";
switch ($ciudad) :
    case "Zaragoza":
        echo "la comunidad es Aragón";
        break;
    case "Barcelona":
        echo "la comunidad es Cataluña";
        break;
    case "Castellón":
        echo "la comunidad es Valencia";
        break;
    default:
        echo "otra comunidad autonoma";
endswitch;

//WHILE

# Cuenta hasta 10
$i = 1;
while ($i <= 10) {
    echo $i++;
}

# Cuenta atras hasta 0
$i = 10;
while (--$i) : echo $i; endwhile;

//DO WHILE
$i = 15;
do {
    echo $i . "<br>";
    $i--; //sólo se ejecuta una vez porque no cumple la condición
} while ($i < 10);

# El 0 hace que se salga del bucle y que no se imprima el 0
$i = 10;
do {
    echo $i . "<br>";
    $i--;
} while ($i);

//FOR
for ($i = 1; $i <= 10; $i++) {
    echo $i;
}

//FOREACH
$a = array(3, 4, 8, 17, 20);    //Declaramos ARRAY a recorrer
foreach ($a as $c) {        //Recorremos todos los elementos de $a como $c cada elemento
    print "Valor actual de \$a: $c.\n";
}

//BREAK
$i = 0;
while (++$i) {
    switch ($i) {
        case 5:
            echo "Con el valor 5 salimos del switch<br > \n";
            break 1;    //Salimos del switch
        case 10:
            echo "Con el valor 10 salimos del while<br > \n";
            break 2;    //Salimos del while
        default:
            echo $i . "<br>";
            break;
    }
}

//CONTINUE
$i = 0;

while ($i++ < 17) { //condición de no múltiplo de 3

    if ($i % 3 != 0) {
        continue;
    }
    echo "El valor de i es: " . $i . "<br>";
}
# Si $i es múltiplo de 3, imprime el mensaje, si NO, salta a la siguiente iteración del WHILE



?>
</body>
</html>

















