<?php 

/*****************************************
FORMULARIO MODIFICAR
Muestra mensajes y asigna variable $campo
*****************************************/
// si NO está vacío...
if(!empty($_SESSION["formdatamodificar"])){  
    // si get[modificar] está inicializada...
    if(isset($_GET["modificar"])){
        if($_GET["modificar"]==("si" || "no")){ 
            echo $_SESSION["mensajemodificar"]; // muestra mensaje 
        }
        // si get[campo] está inicializada
        if(!empty($_GET["campo"])){
            $campo = $_GET["campo"]; // almacena el campo para asignar el foco.
        }
    }
    unset($_SESSION["formdatamodificar"]); //elimina los datos almacenados en session
    unset($_SESSION["mensajemodificar"]); //elimina los datos almacenados en session
}

/************************************
FORMULARIO MODIFICAR
Valida formulario y ejecuta consulta
************************************/

// si post["modificar"] está inicializada...
if(isset($_POST["modificar"])){
    $password2 = $_POST["password2"]; // almacena la confirmación de password en variable para comprobaciones
    
    // recorre los datos enviados por formulario
    foreach($_POST as $key=>$value){
        //elimina espacios en blanco del principio y final
        $value = trim($value);
        // si algún campo está vacío...
        if($value == ""){
            $mensaje = '<p class="error-form">El campo <b>'.$key.'</b> no puede estár vacío</p>'; // asigna el mensaje de error
            $validacion=false;
            header("Location:". $_SERVER['PHP_SELF']."?modificar=no&campo=$key"); // redirecciona detallando el campo que falló
            break;
        // si el campo a revisar es nombre o apellido...
        }elseif($key == "nombre" || $key == "apellido"){
            // si el campo no tiene los caracteres permitidos y si tiene menos de dos caracteres...
            if(!preg_match("/^[ A-Za-zäÄëËïÏöÖüÜáéíóúáéíóúÁÉÍÓÚÂÊÎÔÛâêîôûàèìòùÀÈÌÒÙñÑ.-]{2,20}+$/", $value)){
                $mensaje = '<p class="error-form">El campo <b>'.$key.'</b> sólo puede contener letras (mínimo 2 y máximo 20 caracteres)</p>';
                $validacion=false;
                header("Location:". $_SERVER['PHP_SELF']."?modificar=no&campo=$key"); 
                break;
            }
        // si el campo a revisar es email...
        }elseif($key == "email"){
            // si el campo NO tiene un formato válido...
            if(!filter_var($value, FILTER_VALIDATE_EMAIL)){
                $mensaje = '<p class="error-form">El email <b>'.$value.'</b> está incorrecto.</p>';
                $validacion=false;
                header("Location:". $_SERVER['PHP_SELF']."?modificar=no&campo=$key"); 
                break;
            // si el campo tiene más de cincuenta caracteres.
            }elseif(strlen($value) > ($num=50)){
                $mensaje = '<p class="error-form">El campo <b>'.$key.'</b> no debe ser mayor que '.$num.' caracteres</p>';
                $validacion=false;
                header("Location:". $_SERVER['PHP_SELF']."?modificar=no&campo=$key"); 
                break;
            }
        // si el campo a revisar es password
        }elseif($key == "password"){
            // si tiene menos de seis caracteres
            if(strlen($value) < $num=6){
                $mensaje = '<p class="error-form">El campo <b>'.$key.'</b> debe ser mayor que '.$num.'</p>';
                $validacion=false;
                header("Location:". $_SERVER['PHP_SELF']."?modificar=no&campo=$key"); 
                break;
            // si el password es distinto de confirmar password...
            }elseif($value != $password2){
                $mensaje = '<p class="error-form">El campo <b>'.$key.'</b> y confirmar password deben coincidir</p>';
                $validacion=false;
                header("Location:". $_SERVER['PHP_SELF']."?modificar=no&campo=$key"); 
                break;
            }
        }
    }
    // si $validacion es true...
    if($validacion){
        // crea un objeto usuario... 
        $usuario = new Usuarios_modelo($_SESSION["USUARIO"], $_POST["nombre"],$_POST["apellido"],$_POST["email"]);
        // llama a la función actualizar()
        $respuesta = $controlador->actualizar($usuario, $_POST["password"]);
        // si la respuesta es un string significa que hubo un error.
        if(gettype($respuesta) == "string"){

            $_SESSION["formdatamodificar"] = $_POST; // almacena los datos enviados por formulario.
            $_SESSION["mensajemodificar"]= $respuesta; // asigna el mensaje que será mostrado.
            header("Location:../vista/panel_usuario.php?modificar=no");
        
        // si se han realizado cambios en la base de datos...
        }elseif($respuesta){
            // se reestablecen los datos de $_SESSION que se muestran. El alias es el único valor que NO puede cambiarse, por lo tanto no se re asigna este valor.     
            $_SESSION["NOMBRE"] = $_POST["nombre"];
            $_SESSION["APELLIDO"] = $_POST["apellido"];
            $_SESSION["EMAIL"] = $_POST["email"];   
            $_SESSION["formdatamodificar"] = $_POST;
            $_SESSION["mensajemodificar"] = '<p class="ok-form">Los datos han sido modificados!!</p>';
            header("Location:../vista/panel_usuario.php?modificar=si");
            
        // si no se ha modificado ningún campo en la base de datos...
        }else{
            $_SESSION["formdatamodificar"] = $_POST;
            $_SESSION["mensajemodificar"] = '<p class="error-form">No se ha podido modificar sus datos. <b>Password</b> incorrecto o quizás no ha modificado ningún campo.</p>'; // se asigna mensaje de error
            header("Location:../vista/panel_usuario.php?modificar=no");
        }
    }else{
        $_SESSION["formdatamodificar"] = $_POST;
        $_SESSION["mensajemodificar"]= $mensaje;
    }// end if $validación
}// end if post[modificar]

?>