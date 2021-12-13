<?php

require_once("conexion/conexion.php");

class TopicsModel
{
    public $topic_id;
    public $topic_name;
    public $topic_date;
    public $user_id;
    public $category_id;

    /**
     * @param $topic_id
     * @param $topic_name
     * @param $topic_date
     * @param $user_id
     * @param $category_id
     */
    function __construct($topic_id = null, $topic_name = null, $topic_date = null, $user_id = null, $category_id = null)
    {
        $this->topic_id = $topic_id;
        $this->topic_name = $topic_name;
        $this->topic_date = $topic_date;
        $this->user_id = $user_id;
        $this->category_id = $category_id;
    }

    /**
     * @return null
     */
    public function getTopicId()
    {
        return $this->topic_id;
    }

    /**
     * @param null $topic_id
     */
    public function setTopicId($topic_id)
    {
        $this->topic_id = $topic_id;
    }

    /**
     * @return null
     */
    public function getTopicName()
    {
        return $this->topic_name;
    }

    /**
     * @param null $topic_name
     */
    public function setTopicName($topic_name)
    {
        $this->topic_name = $topic_name;
    }

    /**
     * @return null
     */
    public function getTopicDate()
    {
        return $this->topic_date;
    }

    /**
     * @param null $topic_date
     */
    public function setTopicDate($topic_date)
    {
        $this->topic_date = $topic_date;
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
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * @param null $category_id
     */
    public function setCategoryId($category_id)
    {
        $this->category_id = $category_id;
    }

    /**
     * @return array|false|Object|PDO|String
     */
    public static function get_topics()
    {
        try {
            $conexion = Conexion::conexion_start();

//Si $conexion es de tipo String, es porque se produjo una excepción. Para la ejecución de la función devolviendo el mensaje de la excepción.
            if (gettype($conexion) == "string") {
                return $conexion;
            }

            $sql = "SELECT * FROM `topics` ORDER BY `topic_date` DESC";
            $response = $conexion->prepare($sql);
            $response->execute();

            $conexion = null;

            return $response->fetchAll(PDO::FETCH_OBJ);

        } catch (PDOException $e) {
            return Conexion::mensajes($e->getCode());
        }
    }

    public static function get_topics_by_cat_id($cat_id)
    {
        try {
            $conexion = Conexion::conexion_start();

//Si $conexion es de tipo String, es porque se produjo una excepción. Para la ejecución de la función devolviendo el mensaje de la excepción.
            if (gettype($conexion) == "string") {
                return $conexion;
            }

            $sql = "SELECT * FROM `topics` WHERE `category_id`=:category_id";
            $response = $conexion->prepare($sql);
            $response->bindValue(':category_id', $cat_id);
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
}//end clase
?>