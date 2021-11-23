<?php
class DestruccionObjetosA {
    private $dato;
    private $datoClaseB;

    public function __construct($dato, $datoClaseB) {
        $this->dato = $dato;
        $this->datoClaseB = $datoClaseB;
    }

    public function __destruct() {
        $this->datoClaseB = null;
    }
}

class DestruccionObjetosB {
    private $dato;

    public function __construct($dato) {
        $this->dato = $dato;
    }
}
$instanciaB = new DestruccionObjetosB(100);
$instanciaA = new DestruccionObjetosA(200, $instanciaB);
$instanciaA->__destruct();