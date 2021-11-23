<?php

class ConvertirObjetoACadena
{
    protected $dni;
    protected $nombre;

    public function __construct($pDni, $pNombre)
    {
        //constructor
        $this->dni = $pDni;
        $this->nombre = $pNombre;
    }

    public function __toString()
    {
        $texto = 'DNI: ' . $this->dni . '<br>';
        $texto .= 'Nombre: ' . $this->nombre . '<br>';
        return $texto;
    }
}

$alumno = new ConvertirObjetoACadena('12345678', 'Pepe Pérez');
echo $alumno; //Llamada implícita al método __toString()