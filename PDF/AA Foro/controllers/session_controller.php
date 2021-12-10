<?php
include_once 'C:\xampp\htdocs\Teoria\PDF\AA Foro\models\conexion\conexion.php';//MODIFICAR
// el SessionController responde a eventos, generalmente acciones del usuario sobre la vista,
// e invoca peticiones al models cuando se hace alguna solicitud sobre la información
class SessionController
{
    private $conexion;

    public function __construct()
    {
        // se inicia el models y la sesión
        //$this->model = new Model();
        $this->conexion=new Conexion();
        $this->start();
    }

    function start()
    {
        // se inicia la sesión
        session_start();
    }

    /**
     * Setter de la sesión
     * @param $name nombre de la sesión
     * @param $value valor de la sesión
     */
    public function set($name, $value)
    {
        // se registra la variable de sesión
        $_SESSION[$name] = $value;
    }

    public function get($name)
    {
        // se comprueba si la variable de sesión existe
        if (isset($_SESSION[$name])) {
            return $_SESSION[$name];
        } else {
            return false;
        }
    }

    public function deleteVar($name)
    {
        // se elimina la variable de sesión
        unset($_SESSION[$name]);
    }

    public function delete()
    {
        // se cierra la sesión
        $_SESSION = array();
        session_destroy();
    }

    public function logIn($username, $md5password)
    {
        require_once 'C:\xampp\htdocs\Teoria\PDF\AA Foro\controllers\users_controller.php';
        $usercontroler = new UserController();
        // se reciben los datos que el usuario ha introducido en la vista y se envían al models para que
        // compruebe si el nombre de usuario y la contraseña coinciden con alguna entrada de la base de datos.
        // Si es así, se iniciará la sesión
        if ($usercontroler->userPassCheck($username, $md5password)) {
            $this->set('user', $username);
            $usercontroler=null;
            return true;
        } else {
            $usercontroler=null;
            return false;
        }
    }
    public function validation($input, $params)
    {
        require_once 'C:\xampp\htdocs\Teoria\PDF\AA Foro\controllers\users_controller.php';
        $usercontroler = new UserController();

        return $usercontroler->validation($input, $params);
    }
}
