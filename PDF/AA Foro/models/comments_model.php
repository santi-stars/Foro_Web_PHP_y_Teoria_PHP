<?php

require_once("conexion/conexion.php");

class CommentsModel
{
    public $comment_id;
    public $comment_text;
    public $comment_date;
    public $user_id;
    public $topic_id;

    /**
     * @param $comment_id
     * @param $comment_text
     * @param $comment_date
     * @param $user_id
     * @param $topic_id
     */
    function __construct($comment_id = null, $comment_text = null, $comment_date = null, $user_id = null, $topic_id = null)
    {
        $this->comment_id = $comment_id;
        $this->comment_text = $comment_text;
        $this->comment_date = $comment_date;
        $this->user_id = $user_id;
        $this->topic_id = $topic_id;
    }

    /**
     * @return mixed|null
     */
    public function getCommentId()
    {
        return $this->comment_id;
    }

    /**
     * @param mixed|null $comment_id
     */
    public function setCommentId($comment_id)
    {
        $this->comment_id = $comment_id;
    }

    /**
     * @return mixed|null
     */
    public function getCommentText()
    {
        return $this->comment_text;
    }

    /**
     * @param mixed|null $comment_text
     */
    public function setCommentText($comment_text)
    {
        $this->comment_text = $comment_text;
    }

    /**
     * @return mixed|null
     */
    public function getCommentDate()
    {
        return $this->comment_date;
    }

    /**
     * @param mixed|null $comment_date
     */
    public function setCommentDate($comment_date)
    {
        $this->comment_date = $comment_date;
    }

    /**
     * @return mixed|null
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed|null $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed|null
     */
    public function getTopicId()
    {
        return $this->topic_id;
    }

    /**
     * @param mixed|null $topic_id
     */
    public function setTopicId($topic_id)
    {
        $this->topic_id = $topic_id;
    }

    /**
     * @return array|false|Object|PDO|String
     */
    public static function get_comments()
    {
        try {
            $conexion = Conexion::conexion_start();

//Si $conexion es de tipo String, es porque se produjo una excepción. Para la ejecución de la función devolviendo el mensaje de la excepción.
            if (gettype($conexion) == "string") {
                return $conexion;
            }

            $sql = "SELECT * FROM `comments` ORDER BY `comment_date` DESC";
            $response = $conexion->prepare($sql);
            $response->execute();

            $conexion = null;

            return $response->fetchAll(PDO::FETCH_OBJ);

        } catch (PDOException $e) {
            return Conexion::mensajes($e->getCode());
        }
    }

    public static function get_comments_by_topic_id($topic_id)
    {
        try {
            $conexion = Conexion::conexion_start();

//Si $conexion es de tipo String, es porque se produjo una excepción. Para la ejecución de la función devolviendo el mensaje de la excepción.
            if (gettype($conexion) == "string") {
                return $conexion;
            }

            $sql = "SELECT * FROM `comments` WHERE `topic_id`=:topic_id ORDER BY `comment_date` ASC";
            $response = $conexion->prepare($sql);
            $response->bindValue(':topic_id', $topic_id);
            $response->execute();

            $conexion = null;

            return $response->fetchAll(PDO::FETCH_OBJ);

        } catch (PDOException $e) {
            return Conexion::mensajes($e->getCode());
        }
    }

    public static function get_count_comments_by_topic_id($topic_id)
    {
        try {
            $conexion = Conexion::conexion_start();

//Si $conexion es de tipo String, es porque se produjo una excepción. Para la ejecución de la función devolviendo el mensaje de la excepción.
            if (gettype($conexion) == "string") {
                return $conexion;
            }

            $sql = "SELECT COUNT(`comment_id`) AS `count_comments` FROM `comments` WHERE `topic_id`=:topic_id";
            $response = $conexion->prepare($sql);
            $response->bindValue(':topic_id', $topic_id);
            $response->execute();

            $conexion = null;

            return $response->fetch(PDO::FETCH_OBJ);

        } catch (PDOException $e) {
            return Conexion::mensajes($e->getCode());
        }
    }

    public static function get_user_id_by_comment_id($comment_id)
    {
        try {
            $conexion = Conexion::conexion_start();

//Si $conexion es de tipo String, es porque se produjo una excepción. Para la ejecución de la función devolviendo el mensaje de la excepción.
            if (gettype($conexion) == "string") {
                return $conexion;
            }

            $sql = "SELECT `user_id` FROM `comments` WHERE `comment_id`=:comment_id";
            $response = $conexion->prepare($sql);
            $response->bindValue(':comment_id', $comment_id);
            $response->execute();

            $conexion = null;

            return $response->fetch(PDO::FETCH_OBJ);

        } catch (PDOException $e) {
            return Conexion::mensajes($e->getCode());
        }
    }

    public static function register_comment($comment_text, $user_id, $topic_id)
    {
        try {

            $conexion = Conexion::conexion_start();

            if (gettype($conexion) == "string") {
                return $conexion;
            }

            $sql = "INSERT INTO `comments` (`comment_text`, `user_id`, `topic_id`) VALUES (:comment_text, :user_id, :topic_id)";
            $response = $conexion->prepare($sql);
            $response->bindValue(':comment_text', $comment_text);
            $response->bindValue(':user_id', $user_id);
            $response->bindValue(':topic_id', $topic_id);
            $response->execute();
            $conexion = null;

            return true;

        } catch (PDOException $e) {
            return Conexion::mensajes($e->getCode());
        }
    }

    public static function delete_comment_by_id($comment_id)
    {
        try {
            $conexion = Conexion::conexion_start();

//Si $conexion es de tipo String, es porque se produjo una excepción. Para la ejecución de la función devolviendo el mensaje de la excepción.
            if (gettype($conexion) == "string") {
                return $conexion;
            }

            $sql = "DELETE FROM `comments` WHERE `comment_id`=:comment_id";
            $response = $conexion->prepare($sql);
            $response->bindValue(':comment_id', $comment_id);
            $response->execute();
            $response->fetch(PDO::FETCH_OBJ);
            $conexion = null;

            return true;

        } catch (PDOException $e) {
            return Conexion::mensajes($e->getCode());
        }
    }

}