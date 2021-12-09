<?php

require_once("conexion/conectar.php");

class Crearddbb
{

    /**
     * function
     * basededatos($nombrehost, $usuariohost, $passwordhost)
     * 1) Crea el archivo ddbb.php que almacena los datos para la conexion con el gestor de base de datos.
     * 2) Comprueba que el archivo haya sido creado y devuelve el mensaje correspondiente.
     * 3) Prueba la conexion para chequear que los datos sean correctos y devuelve mensaje.
     * 4) Intenta crear la base de datos y devuelve mensaje.
     * 5) Intenta crear la tabla y devuelve mensaje.
     *
     * ddbb_modelo.php
     *
     * @param String $nombrehost
     * @param String $usuariohost
     * @param String $passwordhost
     * @return Array
     */
    public static function basededatos($nombrehost, $usuariohost, $passwordhost)
    {
        $archivo = fopen("modelo/conexion/ddbb.php", "w") or die("No se puede abrir/crear el archivo!");
        $php = "<?php 

    define('HOST','" . $nombrehost . "');
    define('USER','" . $usuariohost . "');
    define('PASS', '" . $passwordhost . "');
    define('DBNAME', 'EJEMPLO10');

?>";
        fwrite($archivo, $php);
        fclose($archivo);

        $mensajes = array();

        if (file_exists("modelo/conexion/ddbb.php")) {
            $mensajes[] = "<p class='ok-form'>Archivo: El archivo ha sido creado correctamente</p>";

            $prueba = self::pruebaconexion();
            if (gettype($prueba) != "string") {
                $mensajes[] = "<p class='ok-form'>Conexión: Los datos son correctos, conexion establecida.";

                $ddbb = self::creaddbb();
                if (gettype($ddbb) == "object") {
                    $mensajes[] = "<p class='ok-form'>DDBB: La DDBB EJEMPLO10 ha sido creada.";

                    $tabla = self::creatabla();
                    if (gettype($tabla) == "object") {
                        $mensajes[] = "<p class='ok-form'>Tabla: La Tabla USUARIOS ha sido creada.";
                    } else {
                        $mensajes[] = $tabla;
                        return $mensajes;
                    }
                } else {
                    $mensajes[] = $ddbb;
                    return $mensajes;
                }
            } else {
                $mensajes[] = $prueba;
                return $mensajes;
            }
        } else {
            $mensajes[] = "<p class='error-form'>Error, El archivo no pudo ser creado</p>";
        }

        return $mensajes;
    }

    /**
     * function
     * pruebaconexion()
     * Intenta la conexión sin acceder a ninguna base de datos.
     * Devuelve un objeto PDO. en caso de error, devuelve String
     *
     * ddbb_modelo.php
     *
     * @return Object
     */
    public static function pruebaconexion()
    {
        try {
            $conexion = Conectar::Pruebaconexion();
            return $conexion;
            $conexion = null;
        } catch (PDOException $e) {
            return Conectar::mensajes($e->getCode());
        }
    }

    /**
     * function
     * creaddbb()
     * Conecta al gestor de base de datos y crea la base de datos en caso de que no exista
     * Devuelve un objeto PDO. En caso de error, devuelve String.
     *
     * ddbb_modelo.php
     *
     * @return Object
     */
    public static function creaddbb()
    {
        try {
            $conexion = Conectar::Pruebaconexion();
            if (gettype($conexion) == "string") {
                return $conexion;
            }
            $conexion->exec("CREATE DATABASE IF NOT EXISTS EJEMPLO10 CHARACTER SET utf8 COLLATE utf8_spanish_ci");
            return $conexion;
            $conexion = null;

        } catch (PDOException $e) {
            return Conectar::mensajes($e->getCode());

        }
    }

    /**
     * function
     * creatabla()
     * Conecta al gestor de base de datos y crea la tabla en caso de que no exista.
     * Devuelve un objeto PDO. En caso de error, devuelve String.
     *
     * ddbb_modelo.php
     *
     * @return Object
     */
    public static function creatabla()
    {
        try {
            $conexion = Conectar::Conectar();
            if (gettype($conexion) == "string") {
                return $conexion;
            }
            $conexion->exec("CREATE TABLE IF NOT EXISTS `USUARIOS` ( `USUARIO` VARCHAR(20) NOT NULL , 
`NOMBRE` VARCHAR(20) NOT NULL , 
`APELLIDO` VARCHAR(20) NOT NULL , 
`EMAIL` VARCHAR(50) NOT NULL , 
`PASSWORD` VARCHAR(100) NOT NULL , 
PRIMARY KEY (`USUARIO`)) ENGINE = InnoDB;");
            return $conexion;
            $conexion = null;

        } catch (PDOException $e) {
            return Conectar::mensajes($e->getCode());
        }
    }

}

?>