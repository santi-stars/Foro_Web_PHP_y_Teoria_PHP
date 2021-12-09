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
        // se reciben los datos que el usuario ha introducido en la vista y se envían al models para que
        // compruebe si el nombre de usuario y la contraseña coinciden con alguna entrada de la base de datos.
        // Si es así, se iniciará la sesión
        if ($this->conexion->userPassCheck($username, $md5password)) {
            $this->set('user', $username);
            return true;
        } else {
            return false;
        }
    }
// USER_CONTROLER---------------------------------------------------------------------------------------------------
    public function register($username, $email, $md5password)
    {
        // se reciben los datos que el usuario ha introducido en la vista y se envían al models para que registre al usuario
        // en la base de datos.
        // Si el registro se realiza correctamente, se enviará un email al usuario
        if ($this->conexion->register($username, $email, $md5password)) {
            $this->sendEmail($username, $email);
            return true;
        } else {
            return false;
        }
    }

    public function sendEmail($username, $email)
    {
        // se envía un email al usuario
        $senderName = "Awesome Application";
        $senderEmail = "register@awesomeapplication.com";
        $recipientEmail = $email;
        $recipientUsername = $username;
        $subject = "Registration succesful";
        $body = "Hi $recipientUsername,\n
        the registration process in $senderName was succesful.\n
        Thanks for your support! Greetings.\n
        The Team of $senderName";

        $headers = "To: $username <$email> \r\n";
        $headers .= "From: $senderName <$senderEmail> \r\n";
        $headers .= "Return-Path: <$senderEmail> \r\n";
        $headers .= "Reply to: <$senderEmail> \r\n";
        $headers .= "MIME-Version: 1.0 \r\n";
        $headers .= "Content-Type: text/html; charset=iso-8859-1\r\n";


        // dado que el envío de mail sólo funciona si se configuran los datos en el servidor, se ha comentado la llamada al método mail() 
        // y se ha seteado la variable $success como false

        // $success = mail($recipientEmail, $subject, $body, $headers);

        $success = false;

        if ($success) {
            $message = "A confirmation email has been sended!";
            echo "<script type='text/javascript'>alert('$message');</script>";
        } else {
            $message = "The registration email could not be sended!";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }

    public function validation($input, $params)
    {
        // el método validation valida cada campo de forma independiente en función del tipo de error a validar
        $error = "";
        for ($i = 0; $i < count($params); $i++) {
            switch ($params[$i]) {
                case 'required':
                    if (!$this->validationRequired($input)) {
                        $error = "El campo no puede estar vacío";
                    }
                    break; //por desgracia, continue 2 no funciona correctamente

                case 'min':
                    if (!$this->validationMin($input)) {
                        $error = "Demasiado corto";
                    }
                    break;

                case 'max':
                    if (!$this->validationMax($input)) {
                        $error = "Supera la longitud máxima permitida";
                    }
                    break;

                case 'email':
                    if (!filter_var($_POST[$input], FILTER_VALIDATE_EMAIL)) {
                        $error = "Formato de email inválido";
                    }
                    break;

                case 'password':
                    if (!$this->validationPassword($input)) {
                        $error = "Formato de contraseña inválido: debe contener al menos 8 carácteres, mayúsculas, minúsculas y números";
                    }
                    break;

                case 'duplicated':
                    if ($this->conexion->inputExists(str_replace("new-", "", $input), $_POST[$input])) {
                        $error = "El " . $input . " ya existe";
                    }
                    break;

                default:

                    break;
            }
        }
        return $error;
    }
// USER_CONTROLER
    public function validationRequired($input)
    {
        // si el campo está vacío, devuelve un error
        if (empty($_POST[$input])) {
            return false;
        } else {
            return true;
        }
    }
// USER_CONTROLER
    public function validationMin($input)
    {
        // si el campo no llega al mínimo, devuelve un error
        if (strlen($_POST[$input]) < 4) {
            return false;
        } else {
            return true;
        }
    }
// USER_CONTROLER
    public function validationMax($input)
    {
        // si el campo se pasa del máximo permitido, devuelve un error
        if (strlen($_POST[$input]) > 20) {
            return false;
        } else {
            return true;
        }
    }
// USER_CONTROLER
    public function validationPassword($input)
    {
        // la contraseña debe contener al menos una mayúscula, una minúscula y un número.
        // si no cumple estas condiciones, devuelve un error
        $uppercase = preg_match('@[A-Z]@', $_POST[$input]);
        $lowercase = preg_match('@[a-z]@', $_POST[$input]);
        $number = preg_match('@[0-9]@', $_POST[$input]);

        if (!$uppercase || !$lowercase || !$number || strlen($_POST[$input]) < 8 || strlen($_POST[$input]) > 32) {
            return false;
        } else {
            return true;
        }
    }
    // USER_CONTROLER---------------------------------------------------------------------------------------------------
}
