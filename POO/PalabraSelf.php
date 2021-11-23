<?php

class PalabraSelf
{
    private $_atributo = 'defecto';

    function getAtributo()
    {
        return $this->_atributo;
    }

    function mostrar()
    {
        return 'self::getAtributo() = ' .
            self::getAtributo() . '<br>';
    }
}

// La palabra self se suele utilizar para
// hacer referencia a un método de la propia clase sin tener que indicar el nombre de dicha
// clase y para cuando no podemos utilizar la variable $this dentro de la clase, ya que, la
// clase contiene atributos o métodos estáticos.
$objeto = new PalabraSelf();

echo $objeto->mostrar(); //self::getAtributo() = defecto