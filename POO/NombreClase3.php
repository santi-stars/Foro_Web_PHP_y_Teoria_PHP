<?php
class NombreClase3
{
    private $_atributo;

    // Constructor. Tiene el mismo nombre que la clase.
    function __construct($param = 'defecto')
    {
        // Accedemos a la propiedad a través de $this.
        $this->_atributo = $param;
    }

    function getAtributo()
    {
        return $this->_atributo;
    }

    function setAtributo($param)
    {
        $this->_atributo = $param;
    }

    function mostrar()
    {
        return '$this->_atributo = ' .
            $this->_atributo . '<br>';
    }
}

//Trabajaremos con objetos que serán instancias de una clase
//Creamos un objeto con el operador new.
$objeto1 = new NombreClase3();
$objeto2 = new NombreClase3('objeto2');

// Llamamos al método Mostrar() para cada una de las instancias.
echo $objeto1->mostrar();
echo $objeto2->mostrar();

echo $objeto1->getAtributo() . '<br>';

$objeto2->setAtributo('nuevo valor');
echo $objeto2->getAtributo() . '<br>';

$nombreAtributo = '_atributo';

// $objeto2->_atributo = "Error fatal"; //esto provocará un error fatal
$objeto1->$nombreAtributo = "Error fatal"; //esto provocará un error fatal