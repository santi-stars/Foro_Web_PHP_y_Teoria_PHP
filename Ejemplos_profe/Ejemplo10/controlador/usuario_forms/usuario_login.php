<?php 

/****************************************************
FORMULARIO LOGIN
recuperación de datos enviados y muestra de mensajes.
****************************************************/
// Si session["formdatalogin] NO está vacio...
if(!empty($_SESSION["formdatalogin"])){
    //elimina espacios en blanco del principio y final
    $alias = trim($_SESSION["formdatalogin"]["usuario"]);
    // si get["login] es no...
    if(($_GET["login"]=="no")){
        echo $_SESSION["mensajelogin"];    
        //si get["campo"] está instanciada...
        if(!empty($_GET["campo"])){ 
            $campo = $_GET["campo"]; // asigna el nombre de campo a la variable $campo para asignar el foco al campo.
        }
    }
    unset($_SESSION["formdatalogin"]); // elimina la formdatalogin
    unset($_SESSION["mensajelogin"]); // elimina la formdatalogin
}

/***********************************************
FORMULARIO LOGIN
Validación de formulario y ejecución de consulta
***********************************************/
if(!empty($_POST["login"])){

    /*******************
    VALIDACION DE CAMPOS
    recorre los datos enviados por formulario.
    *******************/
    foreach($_POST as $key=>$value){
        //elimina espacios en blanco del principio y final
        $value = trim($value);
        //si algun campo está vacío...
        if($value == ""){ 
            $validacion=false; 
            $mensaje = '<p class="error-form">El campo <b>'.$key.'</b> no puede estár vacío</p>'; //asigna mensaje de error.
            header("Location:". $_SERVER['PHP_SELF']."?login=no&campo=$key"); //redirecciona detallando el campo que falló.
            break;
        // si el alias tiene menos de tres caracteres...
        }elseif($key == "usuario" && strlen($value) < $num=3){
            $mensaje = '<p class="error-form">El campo <b>'.$key.'</b> debe ser mayor que '.$num.'</p>';
            $validacion=false;
            header("Location:". $_SERVER['PHP_SELF']."?login=no&campo=$key"); 
            break;
        // si el password tiene menos de seis caracteres...
        }elseif($key == "password" && strlen($value) < $num=6){
            $mensaje = '<p class="error-form">El campo <b>'.$key.'</b> debe ser mayor que '.$num.'</p>';
            $validacion=false;
            header("Location:". $_SERVER['PHP_SELF']."?login=no&campo=$key"); 
            break; 
        }
    }
    
    // si $validacion es true...
    if($validacion){
        // Llama función iniciar_sesion() que devuelve un objeto usuario 
        $usuario = $controlador->iniciar_sesion($_POST["usuario"], $_POST["password"]);
        // Si $usuario es un string, es porque se producjo un error
        if(gettype($usuario) == "string"){
            $_SESSION["formdatalogin"] = $_POST; // almacena los datos enviados por formulario
            $_SESSION["mensajelogin"] = $usuario; // almacena el mensaje de error
            header("Location:". $_SERVER['PHP_SELF']."?login=no");
        // si $usuario es null significa que el usuario o la contraseña son incorrectos.
        }elseif($usuario == null){
            $_SESSION["formdatalogin"] = $_POST; // almacena datos enviados por formulario.
            $_SESSION["mensajelogin"] = '<p class="error-form">Usuario y/o Contraseña incorrecta</p>'; // almacena el mensaje de error.
            header("Location:". $_SERVER['PHP_SELF']."?login=no"); 
        // Si $usuario es un objeto...
        }else{
            //Asigna las variables de sesión.
            $_SESSION["USUARIO"] = $usuario->alias;
            $_SESSION["NOMBRE"] = $usuario->nombre;
            $_SESSION["APELLIDO"] = $usuario->apellido;
            $_SESSION["EMAIL"] = $usuario->email;
            header("Location:panel_usuario.php"); //redirecciona al panel de usuario
        } 
    // si $validacion es falso...
    }else{
        $_SESSION["formdatalogin"] = $_POST; //almacena los datos enviador por formulario
        $_SESSION["mensajelogin"] = $mensaje; // almacena el mensaje de error
    }// end if validacion login
}// en if !empty POST


?>