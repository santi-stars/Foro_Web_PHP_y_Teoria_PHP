<?php

class NombreClase
{
    public $atributo = "Mi nombre es atributo";

    function Mostrar()
    {
        echo "Código ejecutado dentro de la clase: NombreClase<br />";
        echo 'La variable $atributo tiene el siguiente valor: ' .
            $this->atributo . '<br />';
    }
}
