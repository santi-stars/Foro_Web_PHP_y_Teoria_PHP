<html>
<head><title>Herencia</title></head>
<body>
<?php

class ClaseEjemplo

{
    var $mult = 2;
    var $numinterno;

    public function multxnum()
    {
        return $this->mult * $this->numinterno;
    }

    public function divxnum()
    {
        return $this->numinterno / $this->mult;
    }
}

class ejemploHeredada extends ClaseEjemplo
{
    function triple()
    {

        return ($this->multxnum() * $this->numinterno);
    }
}

$miObjetoEjemplo = new ClaseEjemplo();
$miObjetoEjemplo->numinterno = 3;
$eldoble = $miObjetoEjemplo->multxnum();
echo "El valor doble es: .$eldoble" . "<br>";
$lamitad = $miObjetoEjemplo->divxnum();
echo "El valor dividido por 2 es: $lamitad" . "<br>";
$objetoHeredado = new ejemploHeredada();
$objetoHeredado->numinterno = 3;
echo "El valor por 3 es: " . $objetoHeredado->triple() . "<br>";
?>
</body>
</html>