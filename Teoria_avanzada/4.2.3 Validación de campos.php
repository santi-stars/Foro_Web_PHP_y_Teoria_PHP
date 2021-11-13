<html>
<head><title>Title</title></head>
<body>
<!--// Validación de ENTERO-->
<?php
$var = '2.3';
if (filter_var($var, FILTER_VALIDATE_INT) === false) {
    echo 'El valor es un ENTERO';
} else {
    echo 'El valor NO es un ENTERO';
}
?>
<!--// Validación de ENTERO dentro de un RANGO-->
<?php
$a = '1';
$b = '-1';
$c = '3';

$rango = array('options' => array('min_range' => 0, 'max_range' => 3,));

if (filter_var($a, FILTER_VALIDATE_INT, $rango) !== FALSE) {
    echo "La variable a es correcta(valor entre 0 y 3).<br>";
}
if (filter_var($b, FILTER_VALIDATE_INT, $rango) !== FALSE) {
    echo "La variable b es correcta(valor entre 0 y 3).<br>";
}
if (filter_var($c, FILTER_VALIDATE_INT, $rango) !== FALSE) {
    echo "La variable c es correcta(valor entre 0 y 3).<br>";
}
?>
<!--// Validación de EMAIL-->
<?php
$email_a = 'cristian@midominio.com';
$email_b = 'cristian';
if (filter_var($email_a, FILTER_VALIDATE_EMAIL)) {
    echo "Esta dirección de email (email_a) es considerada válida.<br>";
}
if (filter_var($email_b, FILTER_VALIDATE_EMAIL)) {
    echo "Esta dirección de email (email_b) es considerada válida.<br>";
}
?>
<!--// Validación de formato IP-->
<?php
$ip_a = '192.168.1.25';
$ip_b = '23.34.36.36';
if (filter_var($ip_a, FILTER_VALIDATE_IP)) {
    echo "La dirección IP " . $ip_a . " es válida.<br>";
}
if (filter_var($ip_b, FILTER_VALIDATE_IP)) {
    echo "La dirección IP " . $ip_b . " es válida.<br>";
}
?>
<!--Elimina ETIQUETAS y solo deja String-->
<?php
$text = '<b>"Hola mundo!"</b>';
echo $text . "<br>";
echo filter_var($text, FILTER_SANITIZE_STRING);
?>
</body>
</html>