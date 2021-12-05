<?php 

/*******************
FORMULARIO ELIMINAR
muestra de mensaje
*******************/
// si session[validacion] NO está vacío...
if(!empty($_SESSION["mensajeeliminar"])){
    //si get[eliminar] está inicializada...
    if(isset($_GET["eliminar"])){
        //si get[eliminar] es igual a no...
        if($_GET["eliminar"]=="no"){
            echo $_SESSION["mensajeeliminar"];  // muestra mensaje  
        }
    }
    unset($_SESSION["mensajeeliminar"]); // elimina datos almacenados en session
}
/************************************************
FORMULARIO CAMBIA PASSWORD
Validación de formulario y ejecución de consulta
************************************************/
// si se a presionado el submit eliminar...
if(isset($_POST["eliminar"])){
    // redirecciona con get[eliminar]...
    header("Location:". $_SERVER['PHP_SELF']."?eliminar");
// si se presiona en confirmar eliminar cuenta...
}elseif(isset($_POST["confirmareliminar"])){
    // se almacena la variable para chequeo
    $password2 = $_POST["password2"];
    //se recorre los datos enviados por formulario 
    foreach($_POST as $key=>$value){
        // elimina los espacios vacíos del principio y el final
        $value = trim($value);
        //si los campos están vacíos...
        if($value == ""){
            $mensaje = '<p class="error-form">El campo <b>'.$key.'</b> no puede estár vacío</p>'; //almacena mensaje
            $validacion=false;
            header("Location:". $_SERVER['PHP_SELF']."?eliminar=no"); // redirecciona 
            break;
        // si el campo a chequear es password...
        }elseif($key == "password"){
            // si es menor que seis caracteres...
            if(strlen($value) < $num=6){
                $mensaje = '<p class="error-form">El campo <b>'.$key.'</b> debe ser mayor que '.$num.'</p>';
                $validacion=false;
                header("Location:". $_SERVER['PHP_SELF']."?eliminar=no"); 
                break;
            // si password es distinto a condiemar password
            }elseif($value != $password2){
                $mensaje = '<p class="error-form">El campo <b>'.$key.'</b> y confirmar password deben coincidir</p>';
                $validacion=false;
                header("Location:". $_SERVER['PHP_SELF']."?eliminar=no"); 
                break;
            }
        }
    }//end foreach
    // si $validacion es true...
    if($validacion){
        //ejecuta la consulta sql
        $respuesta = $controlador->eliminar($_SESSION["USUARIO"], $_POST["password"]);
        // si $respuesta es equivalente a verdadero / si hay una fila afectada...
        if($respuesta){
            header("Location:".$_SERVER['PHP_SELF']."?cerrar"); //si el usuario ha sido eliminado, se cierra elimina la sesión
        // Si la respuesta es un string, hay un error
        }elseif(gettype($respuesta) == "string"){
            $_SESSION["mensajeeliminar"]= $respuesta; //almacena mensaje de error
            header("Location:../vista/panel_usuario.php?eliminar=no");
        // Si no ha habido una fila acetada..
        }else{
            //almacena mensaje
            $_SESSION["mensajeeliminar"]= '<p class="error-form">No se ha podido eliminar el usuario. <b>Contraseña</b> incorrecta</p>';
            header("Location:../vista/panel_usuario.php?eliminar=no");
        }
    // si $validacion es falso...
    }else{
        //almacena mensaje de error
        $_SESSION["mensajeeliminar"]= $mensaje;
    }
}elseif(isset($_POST["cancelareliminar"])){
    header("Location:". $_SERVER['PHP_SELF']);
}
?>
