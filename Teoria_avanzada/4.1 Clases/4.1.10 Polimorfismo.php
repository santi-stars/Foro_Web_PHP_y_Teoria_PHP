<html>
<head><title>Polimorfismo</title></head>
<body>
<?php

class Vehiculo
{
    protected $Gasoil = 80; //Comienza con 80 litros de Gasoil

    public function getGasoil()
    {
        return $this->Gasoil;
    }
}

class BMW extends Vehiculo
{
    public function avanzar()
    {
        $this->Gasoil -= 10;
    }

}

class Seat extends Vehiculo
{

    public function avanzar()
    {
        $this->Gasoil -= 5;
    }
}

class conductor
{
    private $vehiculo;

    function __construct($objeto)
    {
        $this->vehiculo = $objeto;

    }

    public function avanzarVehiculo()
    {
        $this->vehiculo->avanzar();

    }

    public function Gasoil()
    {

        return $this->vehiculo->getGasoil();
    }
}

$conductor1 = new conductor (new Seat);
$conductor1->avanzarVehiculo();
$conductor2 = new conductor (new BMW);

$conductor2->avanzarVehiculo();

// Al Seat del conductor 1 le quedan 75 litros de Gasoil

echo "Al Seat del conductor 1 le quedan " . $conductor1->Gasoil() . " litros de Gasoil <br>";
// Al BMW del conductor 2 le quedan 70 litros de Gasoil

echo "Al BMW del conductor 2 le quedan " . $conductor2->Gasoil() . " litros de Gasoil <br>";
?>
</body>
</html>