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
        parent::MetodoX(); //similar a -> A::MetodoX()
    }
}

$obj = new B();
echo "<br>";
$obj->Be();
