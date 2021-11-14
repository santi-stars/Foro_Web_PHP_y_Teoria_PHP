<?php
// bool mail ( string $to , string $subject , string $message [, string $additional_headers
//            [, string $additional_parameters]] )

// $to: Receptor o receptores del correo
// $subject: Título del mail
// $message: Mensaje a enviar
// $additional_headers: String a ser insertado al final de la cabecera, para añadir cabeceras extra (From, Cc y Bcc)

$nombre_origen = "Santi";            //Nombre de remitente
$email_origen = "santi@hotmail.es";             // Email desde donde se envía el correo
$email_copia = "";              // Dirección de copia del correo
$email_ocultos = "";            // Direcciones para correo oculto
$email_destino = "pepe_nazi@hotmail.com";            // Correo destino
$nombre_destinatario = "Pepe";      //a quien va dirigido
$asunto = "Cosas nazis";                   // asunto del correo
$mensaje = "Hola Pepe, solo queria decirte que eres un nazi de mierda.";
$formato = "html";              //opción para enviarlo como html si lo dejas vacio
//a continuación las cabeceras de un correo como para quien va, de quien, etc .
$headers = "To: $nombre_destinatario <$email_destino> \r\n";
$headers .= "From: $nombre_origen <$email_origen> \r\n";
$headers .= "Return-Path: <$email_origen> \r\n";
$headers .= "Reply-To: $email_origen \r\n";
$headers .= "Cc: $email_copia \r\n";
$headers .= "Bcc: $email_ocultos \r\n";
$headers .= "MIME-Version: 1.0 \r\n";
/* ********************************************************
*/

//si el formato no es html entonces que lo envié como texto plano
if ($formato == "html") {
    $headers .= "Content-Type: text/html; charset=iso-8859-1 \r\n";
} else {
    $headers .= "Content-Type: text/plain; charset=iso-8859-1 \r\n";
}

/* si todo esta correcto el correo se envia */
if (@mail($email_destino, $asunto, $mensaje, $headers)) {
    echo "Su correo ha sido correctamente enviado";
} else {
    echo "Error en el envío del correo";
}

/*
Para que funcione, hay que configurar el servidor de envío de correo electrónico SMTP en PHP.INI.
Para ello, localizar en PHP.INI. las siguientes etiquetas y modificarlas con nuestra configuración:

[mail function]
; For Win32 only.
SMTP = localhost //aquí el servidor SMTP
smtp_port = 25  //aquí el puerto de envío del servidor SMTP
; For Win32 only.
sendmail_from = me@localhost.com //aquí la cuenta desde donde enviamos el correo
*/