<?php

require_once("conexion/conexion.php");

class CategoriesModel
{
    public $cat_id;
    public $cat_name;
    public $cat_desc;

    /**
     * __construct
     * function($alias, $nombre, $apellido, $email)
     * Constructor del objeto Usuarios_modelo
     *
     * usuarios_modelo.php
     *
     * @param String $cat_id
     * @param String $cat_name
     * @param String $cat_desc
     */
    function __construct($cat_id, $cat_name, $cat_desc)
    {
        $this->cat_id = $cat_id;
        $this->cat_name = $cat_name;
        $this->cat_desc = $cat_desc;
    }

    /**
     * function
     * get_usuario($alias, $password)
     * Devuelve Boolean o String en caso de error
     *
     * usuarios_modelo.php
     *
     * @param String $alias
     * @param String $password
     * @return array de tipo Categories_model
     */
    public static function get_categories()
    {
        try {
            $conexion = Conexion::ConexionStart();

//Si $conexion es de tipo String, es porque se produjo una excepción. Para la ejecución de la función devolviendo el mensaje de la excepción.
            if (gettype($conexion) == "string") {
                return $conexion;
            }
            //"SELECT USUARIO, NOMBRE, APELLIDO, EMAIL FROM USUARIOS WHERE USUARIO=:usuario AND PASSWORD=:password"
            $sql = "SELECT * FROM `categories` ORDER BY `category_id` ASC";
            $response = $conexion->prepare($sql);
            $response->execute();
            $conexion = null;


            return $response->fetchAll();

        } catch (PDOException $e) {
            return Conexion::mensajes($e->getCode());
        }
    }
}//end clase
?>