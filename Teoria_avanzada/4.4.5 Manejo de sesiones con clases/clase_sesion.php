<?php
// Va  a  contener  la  clase  que  utilizaremos  para  las
// principales  funciones
error_reporting(E_ALL);
ini_set('display_errors', 1);

class Sesion                    // Creamos CLASE en PHP
{

    function __construct()                  // Constructor que inicia la sesión
    {
        session_start();
    }

    public function set($nombre, $valor)    // SETTER para el NOMBRE de sesión y el VALOR
    {
        $_SESSION[$nombre] = $valor;
    }

    public function get($nombre)            // GETTER para el NOMBRE de sesión y el VALOR
    {
        if (isset ($_SESSION [$nombre])) {
            return $_SESSION [$nombre];
        } else {
            return false;                   // Retorna FALSE si no hay SESIÓN
        }
    }

    public function borrar_variable($nombre)    // BORRA la var NOMBRE de la SESIÓN
    {
        unset ($_SESSION [$nombre]);
    }

    public function borrar_sesion()             // BORRA la SESIÓN
    {
        $_SESSION = array();
        session_destroy();
    }
}