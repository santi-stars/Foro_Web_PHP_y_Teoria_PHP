<?php 

/*************************
FORMULARIO CAMBIAPASSWORD
muestra de mensajes.
*************************/
// si session[validación] NO está vacío...
if(!empty($_SESSION["mensajecambiapass"])){
    // si get[cambiapass] es si o no...
    if($_GET["cambiapass"] == ("si" || "no")){
        echo $_SESSION["mensajecambiapass"]; // muestra mensaje
    }
    unset($_SESSION["mensajecambiapass"]); // vacía los datos almacenados en session
}

/************************************************
FORMULARIO CAMBIA PASSWORD
Validación de formulario y ejecución de consulta
************************************************/
if(isset($_POST["cambiapass"])){
    $password_actual = $_POST["password"]; // almacena password_actual para comparación en foreach
    $password_nuevo = $_POST["password2"]; // almacena password_nuevo para comparación en foreach
    $password_nuevo_confirma = $_POST["password2confirma"]; //almacena password_nuevo_confirma para comparación en foreach
    
    /*****************************************
    VALIDACION DE CAMPOS
    recorre los datos enviados por formulario.
    *****************************************/
    foreach($_POST as $key=>$value){
        //array asociativo que contiene los nombres de los campos tal como se mostrarán en el mensaje de error
        $campos = ["password"=>"Contraseña actual", "password2"=>"Contraseña nueva", "password2confirma"=>"Cconfirmar contraseña nueva"];
        // elimina espacios del principio y final
        $value = trim($value);
        // si el campo está vacío...
        if($value == ""){
            $mensaje = '<p class="error-form">El campo <b>'.$campos[$key].'</b> no puede estár vacío</p>'; // asigna mensaje
            $validacion=false;
            header("Location:". $_SERVER['PHP_SELF']."?cambiapass=no");
            break;
        // si es alguno de los tres campos de paswwor...
        }elseif($key == "password" || $key == "password2" || $key == "password2confirma"){
            // si el campo es menor que 6 caracteres...
            if(strlen($value) < $num=6){
                $mensaje = '<p class="error-form">El campo <b>'.$campos[$key].'</b> debe ser mayor que '.$num.'</p>';
                $validacion=false;
                header("Location:". $_SERVER['PHP_SELF']."?cambiapass=no"); 
                break;   
            }
            //si es password2...
            if($key == "password2"){
                // si el paswwor nuevo es igual al actual...
                if($value == $password_actual){
                    $mensaje = '<p class="error-form">El campo <b>'.$campos[$key].'</b> debe ser distinta de la <b>Contraseña actual</b></p>';
                    $validacion=false;
                    header("Location:". $_SERVER['PHP_SELF']."?cambiapass=no"); 
                //si password nuevo es distinto a la confirmación de password nuevo...
                }elseif($value != $password_nuevo_confirma){
                    $mensaje = '<p class="error-form">El campo <b>'.$campos[$key].'</b> y <b>Confirmar contraseña nueva</b> deben coincidir</p>';
                    $validacion = false;
                    header("Location:". $_SERVER['PHP_SELF']."?cambiapass=no"); 
                    break;
                }
            }
        }
    }// end foreach
    // si validación es true...
    if($validacion){
        // ejecuta la consulta
        $respuesta = $controlador->cambiapass($_SESSION["USUARIO"], $_POST["password"], $_POST["password2"]);
        // si la respuesta es un string, hay un error al ejecutar la consulta o bien la contraseña actual es incorrecta.
        if(gettype($respuesta) == "string"){
            $_SESSION["mensajecambiapass"]= $respuesta;
            header("Location:../vista/panel_usuario.php?cambiapass=no");
        // Si la respuesta es equivalente a true / si hay una fila afectada...
        }elseif($respuesta){
            $_SESSION["mensajecambiapass"]= '<p class="ok-form">Su contraseña ha sido modificada.</p>';
            header("Location:../vista/panel_usuario.php?cambiapass=si");
        }
    }else{
        $_SESSION["mensajecambiapass"] = $mensaje;
    }
}// end if(isset($_POST["cambiapass"]))
elseif(isset($_POST["cancelarpass"])){
    header("Location:". $_SERVER['PHP_SELF']);
}

?>