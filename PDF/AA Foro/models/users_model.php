<?php

require_once("conexion/conexion.php");

class UsersModel
{
    public $user_nick;
    public $user_email;
    public $user_pass;

    /**
     * __construct
     * function($alias, $nombre, $apellido, $email)
     * Constructor del objeto Usuarios_modelo
     *
     * usuarios_modelo.php
     *
     * @param String $alias
     * @param String $nombre
     * @param String $apellido
     * @param String $email
     */
    function __construct($user_nick, $user_email, $user_pass)
    {
        $this->user_nick=$user_nick;
        $this->user_email=$user_email;
        $this->user_pass=$user_pass;
    }


    /**
     * function
     * get_usuario($alias, $password)
     * Devuelve Boolean o String en caso de error
     *
     * usuarios_modelo.php
     *
     * @param String $user_nick
     * @param String $password
     * @return Usuarios_modelo
     */
    public static function get_user($user_nick, $password)
    {
        try {
            $conexion = Conexion::ConexionStart();

            //Si $conexion es de tipo String, es porque se produjo una excepción. Para la ejecución de la función devolviendo el mensaje de la excepción.
            if (gettype($conexion) == "string") {
                return $conexion;
            }
            // Selecciona todo menos la PASS
            $sql = "SELECT user_id, user_nick, user_email, user_reg_date, user_level FROM users WHERE user_nick=:user_nick AND user_pass=:password";
            $response = $conexion->prepare($sql);
            $response->execute(array(':user_nick' => $user_nick, ':password' => $password));
            $response = $response->fetch(PDO::FETCH_ASSOC);

            // Si el array no está vacío, crea y devuelve un objeto Usuario.
            if ($response) {
                $user = new Usuarios_modelo($response["USUARIO"], $response["NOMBRE"], $response["APELLIDO"], $response["EMAIL"]);
                $conexion = null;
                return $user;
            } else {
                $conexion = null;
                return null;
            }

        } catch (PDOException $e) {
            return Conexion::mensajes($e->getCode());
        }
    }

    public static function check_user($user_nick, $password)
    {  // MODIFICAR PARA QUE DEVUELVA EL NUMERO DE FILAS DE LA SENTENCIA SQL
        try {
            $conexion = Conexion::ConexionStart();

            //Si $conexion es de tipo String, es porque se produjo una excepción. Para la ejecución de la función devolviendo el mensaje de la excepción.
            if (gettype($conexion) == "string") {
                return $conexion;
            }
            // Selecciona todo menos la PASS
            $sql = "SELECT `user_id`, `user_nick`, `user_email`, `user_reg_date`, `user_level` FROM users WHERE `user_nick`=:user_nick AND `user_pass`=:password";
            $response = $conexion->prepare($sql);
            $response->bindValue(':user_nick', $user_nick);
            $response->bindValue(':password', $password);
            $response->execute(array(':user_nick' => $user_nick, ':password' => $password));

            // Si el array no está vacío, crea y devuelve el número de filas que será 1.

            $response_count = $response->rowCount();
            return $response_count;


        } catch (PDOException $e) {
            return Conexion::mensajes($e->getCode());
        }
    }

    /**
     * function
     * registrar($usuario, $password)
     * Devuelve Boolean o String en caso de error
     *
     * usuarios_modelo.php
     *
     * @param Object $usuario
     * @param String $password
     * @return Boolean
     */
    public static function registrar($usuario, $password)
    {
        try {
            $password = self::cryptconmd5($password);
            $conexion = Conexion::ConexionStart();
            if (gettype($conexion) == "string") {
                return $conexion;
            }

            $sql = "INSERT INTO USUARIOS (USUARIO, NOMBRE, APELLIDO, EMAIL, PASSWORD) VALUES (:USU, :NOM, :APE, :EMAIL, :PASS)";
            $respuesta = $conexion->prepare($sql);
            $respuesta = $respuesta->execute(array(":USU" => $usuario->alias, ":NOM" => $usuario->nombre, ":APE" => $usuario->apellido, ":EMAIL" => $usuario->email, ":PASS" => $password));
            return $respuesta;

            $respuesta->closeCursor();
            $conexion = null;

        } catch (PDOException $e) {
            return Conexion::mensajes($e->getCode());
        }
    }

    /**
     * function
     * actualizar($usuario, $password)
     * Devuelve Integer o String en caso de error
     *
     * usuarios_modelo.php
     *
     * @param Object $usuario
     * @param String $password
     * @return Integer
     */
    public static function actualizar($usuario, $password)
    {
        try {
            $password = self::cryptconmd5($password);
            $sql = 'UPDATE USUARIOS SET NOMBRE=:NOM, APELLIDO=:APE, EMAIL=:EMAIL WHERE USUARIO=:USU AND PASSWORD=:PASS';
            $conexion = Conexion::ConexionStart();
            if (gettype($conexion) == "string") {
                return $conexion;
            }
            $conexion = $conexion->prepare($sql);
            $conexion->execute(array(":NOM" => $usuario->nombre, ":APE" => $usuario->apellido, ":EMAIL" => $usuario->email, ":USU" => $usuario->alias, ":PASS" => $password));
            return $respuesta = $conexion->rowCount();

            $respuesta->closeCursor();
            $conexion = null;

        } catch (PDOException $e) {
            return Conexion::mensajes($e->getCode());
        }

    }

    /**
     * function
     * cambiapass($alias, $password_actual, $password_nuevo)
     * Devuelve Integer o String en caso de error
     *
     * usuarios_modelo.php
     *
     * @param String $alias
     * @param String $password_actual
     * @param String $password_nuevo
     * @return Integer
     */
    public static function cambiapass($alias, $password_actual, $password_nuevo)
    {

        try {
            $password_nuevo = self::cryptconmd5($password_nuevo);
            $usuario = self::get_user($alias, $password_actual);

            if (gettype($usuario) == "string") {
                return $usuario;
            } elseif ($usuario == null) {
                return '<p class="error-form">Contraseña incorrecta. No se a cambiado su clave de usuario</p>';
            }
            $sql = 'UPDATE USUARIOS SET PASSWORD=:PASSNUEVO WHERE USUARIO=:USU AND PASSWORD=:PASS';
            $conexion = Conexion::ConexionStart();
            if (gettype($conexion) == "string") {
                return $conexion;
            }
            $conexion = $conexion->prepare($sql);
            $password_actual = self::cryptconmd5($password_actual);
            $conexion->execute(array(":PASSNUEVO" => $password_nuevo, ":USU" => $usuario->alias, ":PASS" => $password_actual));

            return $respuesta = $conexion->rowCount();

            $respuesta->closeCursor();
            $conexion = null;

        } catch (PDOException $e) {
            return Conexion::mensajes($e->getCode());
        }

    }

    /**
     * function
     * eliminar($alias, $password)
     * Devuelve Integer o String en caso de error
     *
     * usuarios_modelo.php
     *
     * @param String $alias
     * @param String $password
     * @return Integer
     */
    public static function eliminar($alias, $password)
    {
        try {
            $password = self::cryptconmd5($password);
            $sql = 'DELETE FROM USUARIOS WHERE USUARIO=:USU AND PASSWORD=:PASS';
            $conexion = Conexion::ConexionStart()->prepare($sql);
            $conexion->execute(array(":USU" => $alias, ":PASS" => $password));

            return $respuesta = $conexion->rowCount();

            $respuesta->closeCursor();
            $conexion = null;
        } catch (PDOException $e) {
            return Conexion::mensajes($e->getCode());
        }
    }

    /**
     * function
     * cryptconmd5($password)
     * Devuelve clave encriptada
     *
     * usuarios_modelo.php
     *
     * @param String $password
     * @return String
     */
    public static function cryptconmd5($password)
    {
        //Crea un salt
        $salt = md5($password . "%*4!#$;.k~’(_@");
        $password = md5($salt . $password . $salt);
        return $password;
    }

}//end clase


?>