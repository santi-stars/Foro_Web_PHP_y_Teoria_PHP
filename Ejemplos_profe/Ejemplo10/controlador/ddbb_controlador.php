<?php 
    
    require_once("modelo/ddbb_modelo.php");
    
    class ddbb_controlador{
        
        public function __construct(){}
        
        /** 
        * function($nombrehost, $usuariohost, $passwordhost) 
        * Comunica con ddbb_modelo para crea el archivo que contendrá los datos de acceso a la ddbb y
         * crea la base de datos y su tabla correspondiente para almacenar los usuarios.
        * Devuelve Array() con los mensajes a mostrar en caso de exito o error al crear. 
        * Array[0] = creación de archivo.
        * Array[1] = prueba de conexion.
        * Array[2] = creación de ddbb
        * Array[3] = creación de tabla
        *
        * ddbb_controlador.php
        *
        * @param String $nombrehost
        * @param String $usuariohost
        * @param String $passwordhost
        * @return Array
        */
        public function crea_archivo($nombrehost, $usuariohost, $passwordhost){
            $respuesta = Crearddbb::basededatos($nombrehost, $usuariohost, $passwordhost);
            return $respuesta;
        }
        
        
    }

$controlador = new ddbb_controlador();

//Envio de formulario CREAR ARCHIVO
if(!empty($_POST["crearddbb"])){
    $error = $controlador->crea_archivo($_POST["nombrehost"], $_POST["usuariohost"], $_POST["passwordhost"]);
    //Asignar mensajes a variables de sesión luego de crear el archivo.
    $_SESSION["mensajearchivo"] = $error[0];
    $_SESSION["mensajeconexion"] = $error[1];
    $_SESSION["mensajeddbb"] = $error[2];
    $_SESSION["mensajetabla"] = $error[3];
    
    header("Location:". $_SERVER['PHP_SELF']."?2&creararchivo=si");
}
                                    
if(!empty($_SESSION) && !empty($_GET["creararchivo"])){
    if($_GET["creararchivo"] == "si"){
        //Imprimir mensajes.
        echo $_SESSION["mensajearchivo"];
        unset($_SESSION["mensajearchivo"]);
        echo $_SESSION["mensajeconexion"];
        unset($_SESSION["mensajeconexion"]);
        echo $_SESSION["mensajeddbb"];
        unset($_SESSION["mensajeddbb"]);
        echo $_SESSION["mensajetabla"];
        unset($_SESSION["mensajetabla"]);
    }
}

?>