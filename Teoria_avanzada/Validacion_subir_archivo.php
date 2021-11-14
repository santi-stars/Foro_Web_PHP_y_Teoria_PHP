<?php
if (is_uploaded_file($_FILES['fichero']['tmp_name'])) {
    echo "Archivo " . $_FILES['fichero']['name'] . " subido con 
éxito.\n";
} else {

    echo "Posible ataque del archivo subido: ";

    echo "nombre del archivo " . $_FILES['fichero']

        ['nombre_tmp'] . "’.";

}

if ($_FILES['fichero']['error']) {

    switch ($_FILES['fichero']['error']) {
        case 1: // UPLOAD_ERR_INI_SIZE
            echo "El archivo sobrepasa el limite autorizado  

            por el servidor(archivo php.ini)!";

            break;

        case 2: //UPLOAD_ERR_FORM_SIZE
            echo "El archivo sobrepasa el limite autorizado
             por el formulario!";

            break;

        case 3: // UPLOAD_ERR_PARTIAL

            echo "El envio del archivo ha sido suspendido 

            durante la transferencia";

            break;

        case 4: // UPLOAD_ERR_NO_FILE
            echo "El archivo que ha enviado tiene un tamaño 
            nulo!";

            break;

    }

}

if ((isset($_FILES['fichero']['archivo'])) &&

    ($_FILES['fichero']['error'] == UPLOAD_ERR_OK)) {
    $ruta_destino = 'C:\Users\santi\Documents\SAN VALERO\2º DAM\DI-PHP';

    move_uploaded_file($_FILES['fichero']['tmp_name'],
        $ruta_destino . $_FILES['fichero']['name']);
}
