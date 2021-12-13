<?php

require_once("conexion/conexion.php");

class UsersModel
{
    public $user_id;
    public $user_nick;
    public $user_email;
    public $user_pass;
    public $user_reg_date;
    public $user_level;

    /**
     * __construct
     * function($alias, $nombre, $apellido, $email)
     * Constructor del objeto Usuarios_modelo
     *
     * usuarios_modelo.php
     *
     * @param null $user_id
     * @param null $user_nick
     * @param null $user_email
     * @param null $user_pass
     */
    function __construct($user_id = null, $user_nick = null, $user_email = null, $user_pass = null, $user_reg_date = null, $user_level = null)
    {
        $this->user_id = $user_id;
        $this->user_nick = $user_nick;
        $this->user_email = $user_email;
        $this->user_pass = $user_pass;
        $this->user_reg_date = $user_reg_date;
        $this->user_level = $user_level;
    }

    /**
     * @return null
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param null $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return null
     */
    public function getUserNick()
    {
        return $this->user_nick;
    }

    /**
     * @param null $user_nick
     */
    public function setUserNick($user_nick)
    {
        $this->user_nick = $user_nick;
    }

    /**
     * @return null
     */
    public function getUserEmail()
    {
        return $this->user_email;
    }

    /**
     * @param null $user_email
     */
    public function setUserEmail($user_email)
    {
        $this->user_email = $user_email;
    }

    /**
     * @return null
     */
    public function getUserPass()
    {
        return $this->user_pass;
    }

    /**
     * @param null $user_pass
     */
    public function setUserPass($user_pass)
    {
        $this->user_pass = $user_pass;
    }

    /**
     * @return mixed|null
     */
    public function getUserRegDate()
    {
        return $this->user_reg_date;
    }

    /**
     * @param mixed|null $user_reg_date
     */
    public function setUserRegDate($user_reg_date)
    {
        $this->user_reg_date = $user_reg_date;
    }

    /**
     * @return mixed|null
     */
    public function getUserLevel()
    {
        return $this->user_level;
    }

    /**
     * @param mixed|null $user_level
     */
    public function setUserLevel($user_level)
    {
        $this->user_level = $user_level;
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
     */ // SE USA****************************************************
    public static function get_user($user_nick, $password)
    {
        try {
            $conexion = Conexion::conexion_start();

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

    /**
     * @param $user_id
     * @return mixed|Object|PDO|String
     */
    public static function get_user_by_id($user_id)
    {
        try {
            $conexion = Conexion::conexion_start();

            if (gettype($conexion) == "string") {
                return $conexion;
            }

            $sql = "SELECT `user_id`, `user_nick`, `user_email`, `user_reg_date`, `user_level` FROM users WHERE `user_id`=:user_id";
            $response = $conexion->prepare($sql);
            $response->bindValue(':user_id', $user_id);
            $response->execute();

            $conexion = null;

            return $response->fetch(PDO::FETCH_OBJ);

        } catch (PDOException $e) {
            return Conexion::mensajes($e->getCode());
        }
    }

    // SE USA****************************************************
    public static function check_user($user_nick, $password)
    {
        try {
            $conexion = Conexion::conexion_start();

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
     * @return array|false|Object|PDO|String
     */
    public static function get_users()
    {
        try {
            $conexion = Conexion::conexion_start();

//Si $conexion es de tipo String, es porque se produjo una excepción. Para la ejecución de la función devolviendo el mensaje de la excepción.
            if (gettype($conexion) == "string") {
                return $conexion;
            }

            $sql = "SELECT * FROM `users` ORDER BY `user_id` ASC";
            $response = $conexion->prepare($sql);
            $response->execute();

            $conexion = null;

            return $response->fetchAll(PDO::FETCH_OBJ);

        } catch (PDOException $e) {
            return Conexion::mensajes($e->getCode());
        }
    }

    public static function get_users_by_topic_id($topic_id)
    {
        try {
            $conexion = Conexion::conexion_start();

//Si $conexion es de tipo String, es porque se produjo una excepción. Para la ejecución de la función devolviendo el mensaje de la excepción.
            if (gettype($conexion) == "string") {
                return $conexion;
            }

            $sql = "SELECT * FROM `topics` WHERE `category_id`=:topic_id";
            $response = $conexion->prepare($sql);
            $response->bindValue(':topic_id', $topic_id);
            $response->execute();

            $conexion = null;

            return $response->fetchAll(PDO::FETCH_OBJ);

        } catch (PDOException $e) {
            return Conexion::mensajes($e->getCode());
        }
    }

    public static function get_count_topics_by_cat_id($cat_id)
    {
        try {
            $conexion = Conexion::conexion_start();

//Si $conexion es de tipo String, es porque se produjo una excepción. Para la ejecución de la función devolviendo el mensaje de la excepción.
            if (gettype($conexion) == "string") {
                return $conexion;
            }

            $sql = "SELECT COUNT(`category_id`) AS `numero_temas` FROM `topics` WHERE `category_id`=:category_id";
            $response = $conexion->prepare($sql);
            $response->bindValue(':category_id', $cat_id);
            $response->execute();

            $conexion = null;

            return $response->fetch(PDO::FETCH_OBJ);

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
            $conexion = Conexion::conexion_start();
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
            $conexion = Conexion::conexion_start();
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
            $conexion = Conexion::conexion_start();
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
            $conexion = Conexion::conexion_start()->prepare($sql);
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
    // SE USA****************************************************
    public static function cryptconmd5($password)
    {
        //Crea un salt
        $salt = md5($password . "%*4!#$;.k~’(_@");
        $password = md5($salt . $password . $salt);
        return $password;
    }
}
