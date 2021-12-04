<?php

class NombreClase2
{

    public $atributo;

    // Constructor. Tiene el mismo nombre que la clase.
    function __construct($param = 'defecto')
    {
        // Accedemos a la propiedad a través de $this.
        $this->atributo = $param;
    }

    function mostrar()
    {
        echo '$this->atributo = ' . $this->atributo . '<br>';
    }
} //aquí acaba la definición de la clase

//Trabajaremos con objetos que serán instancias de una clase
//Creamos un objeto con el operador new.
$objeto1 = new NombreClase2();
$objeto2 = new NombreClase2('objeto2');

// Llamamos al método Mostrar() para cada una de las instancias.
$objeto1->mostrar();
$objeto2->mostrar();

// Permitido pero no recomendable.
// Es recomendable utilizar un setter
// (método que actualiza el valor de un atributo)
$nombreAtributo = 'atributo';
echo $objeto1->$nombreAtributo . '<br>';

// Es mejor utilizar un getter
// (método que devuelva al valor de un atributo)
echo $objeto2->atributo . '<br>';