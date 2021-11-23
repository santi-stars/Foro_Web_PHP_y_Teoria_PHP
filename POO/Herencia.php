<?php

class A
{
    function MetodoX()
    {
        echo 'Metodo de clase A';
    }
}

class B extends A
{
    function Be()
    {
        parent::MetodoX(); //similar a -> A::MetodoX() para llamar al constructor de la clase A o Padre
    }
}

$obj = new B();
echo "<br>";
$obj->Be();
