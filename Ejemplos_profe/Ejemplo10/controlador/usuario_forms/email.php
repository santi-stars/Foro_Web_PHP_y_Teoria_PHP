<?php 
                
    class Email{
        
        /** 
        * function
        * email_registrar($array_formdata) 
        * Envía email de confirmación de registro y devuelve mensaje de confirmación de
         * registro y si el email fue enviado o no.
        * 
        * email.php
        *
        * @param Array $array_formdatar
        * @return String
        */
        public static function email_registrar($array_formdata){
            /* 
            El código de envío de mail fue chequeado con un simulador de servidor SMTP y estaría
            funcionando correctamente.
            */
            $usuario = $array_formdata["usuario"];
            $nombre = $array_formdata["nombre"];
            $apellido = $array_formdata["apellido"];
            $email = $array_formdata["email"];
            $asunto = 'Confirmación de registro: '.$email;
            $mensaje = "<!DOCTYPE html><html><head><meta charset='UTF-8'><style> *{font-family: 'Arial', Helvetica, sans-serif;}body{width:80%; margin: 0 auto;background-color: aqua;}td{border:1px solid black;}</style></head><body><header><h1>Confirmación de registro</h1></header><section><article><h3>Hola ".$nombre.":<br>Su Cuenta ha sido creada con éxito.</h3><p>Estos son sus datos:</p><table border='1'><tr><td>Usuario</td><td>Nombre</td><td>Apellido</td><td>Email</td></tr><tr><td>".$usuario."</td><td>".$nombre."</td><td>".$apellido."</td><td>".$email."</td></tr><tr><td colspan='4'>Por seguridad, su contraseña ha sido codificada y no podemos acceder a la misma.</td></tr></table></article></section><footer><p>Ejercicio de Feedback - PHP-MYSQL</p><p>Ezequiel Garay</p></footer></body></html>";
            $headers = "MIME-Version 1.0 \r\n";
            $headers .= "Content-type: text/html; charset=ISO-8859-1 \r\n";
            $headers .= "From: Ejemplo10 <postmaster@localhost.com> \r\n";
            
            // Envía email.
            $resultado = mail($email, $asunto, $mensaje, $headers);
            //Comprueba si el email ha sido enviado y devuelte el mensaje correspondiente.
            if($resultado){
                return $resultado = '<p class="ok-form">El registro ha sido exitoso. Recibirá un mail de confirmación a <b>'.$email.'</b></p>';
            }else{
                return $resultado = '<p class="ok-form">Su cuenta ha sido registrada pero ha habido un error al enviar el email.</b></p>';
            }
            
        }
    }

?>