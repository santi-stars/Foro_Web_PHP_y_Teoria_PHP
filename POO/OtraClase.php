<?php
include "NombreClase.php";
//Trabajaremos con objetos que serán instancias de una clase
//Creamos un objeto con el operador new.
$objeto = new NombreClase();

// Llamamos al método Mostrar() para cada una de las instancias.
$objeto->Mostrar();

// Permitido pero no recomendable.
// Es recomendable utilizar un setter (método que actualiza el valor de un atributo)
$nombreAtributo = 'atributo';
echo $objeto->$nombreAtributo . '<br>'; //Mi nombre es atributo

// Es mejor utilizar un getter (método que devuelva al valor de un atributo)
echo $objeto->atributo . '<br>'; //Mi nombre es atributo