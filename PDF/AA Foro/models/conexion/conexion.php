<?php

class Conexion
{
    /**
     * function
     * Conexion()
     * Crea objeto PDO (abre conexion), establece atributos de error
     *
     * conexion.php
     *
     * @return Object
     */
    public static function conexion_start()
    {
        try {
            //Solicita el archivo de la base de datos
            require_once("ddbb.php");
            //instancia objeto PDO
            $conexion = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, USER, PASS, array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ));
            //Codificación para evitar símbolos en carácteres especiales.
            $conexion->exec("SET CHARACTER SET utf8");
            echo "<div class='conexion'>conexion establecida<br></div>";    // BORRAR
            return $conexion;
        } catch (PDOException $e) {
            return self::mensajes($e->getCode());
        }
    }

    /**
     * function
     * Pruebaconexion()
     * Intenta establecer la conexion cone el gestor de base de datos sin acceder a ninguna ddbb.
     * Devuelve un objeto PDO y, en caso de no ser posible la conexion, devuelve mensaje de error
     *
     * conexion.php                 ***BORRAR SI NO SE NECESITA!!!***
     *
     * @return Object
     */
    public static function prueba_conexion()
    {
        try {
            require_once("ddbb.php");
            $conexion = new PDO("mysql:host=" . HOST, USER, PASS); //Conectar::Conexion();
            return $conexion;
        } catch (PDOException $e) {
            return self::mensajes($e->getCode());
        }

    }

    /**
     * function
     * mensajes($e)
     *
     * Recibe como parámetro el código de PDOException y devuelve el mensaje de error correspondiente.
     *
     * ddbb_modelo.php
     *
     * @param String $e
     * @return String
     */
    public static function mensajes($e)
    {
        switch ($e) {
            case "2002":
                if (file_exists("modelo/conexion/ddbb.php")) {
                    return "<p class='error-form'>Error al conectar!! El host es incorrecto: (" . $e . ")</p>";
                } else {
                    return "<p class='warning-form'>No cuenta con los recursos* para conectar con la base de datos. En la página de inicio podrá ver los pasos a seguir para generar los recursos necesarios.<br><small>*Si ya generó los recursos, revise que los datos sean correctos.</small></p>";
                }
                break;
            case "1049":
                return "<p class='error-form'>Error al conectar!! No se encuentra la Base de datos: (" . $e . ")</p>";
                break;
            case "1045":
                return "<p class='error-form'>Error al conectar!! Usuario y/o Contraseña incorrecta: (" . $e . ")</p>";
                break;
            case "42000":
                return "<p class='error-form'>Error al conectar!! Usuario y/o Contraseña incorrecta: (" . $e . ")</p>";
                break;
            case "42S02":
                return "<p class='error-form'>Error en la consulta!! No se encuentra la Tabla en la DDBB: (" . $e . ")</p>";
                break;
            case "23000":
                return "<p class='error-form'>Ya existe el usuario. Prueba con otro alias (" . $e . ")</p>";
                break;
            default:
                return "<p class='error-form'>Error al conectar!! ERROR INESPERADO " . $e . "</p>";
        }//end Switch
    }//end mensajes($e)
}//end Clase
?>