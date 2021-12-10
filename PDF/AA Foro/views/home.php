<?php

//require_once 'C:\xampp\htdocs\Teoria\PDF\AA Foro\controllers\session_controller.php';
// inicializamos el session_controler
// $session = new SessionController();
//require_once 'C:\xampp\htdocs\Teoria\PDF\AA Foro\models\conexion\conexion.php';
//$conexion = Conexion::ConexionStart();  //CONECTA


require_once 'C:\xampp\htdocs\Teoria\PDF\AA Foro\controllers\categories_controller.php';
$categories = Categories_model::get_categories();
// HEADER
include_once 'C:\xampp\htdocs\Teoria\PDF\AA Foro\views\header.php';
?>
    <!-- content -->
    <div id="content">
        <h2>CATEGORIAS</h2>
        <?php
        //while ($row = $categories) {
        //echo "Nombre de la categoria: " . $row-> . "<br>";
        //echo "Descripción: " . $row->cat_desc . "<br><br>";
        //}
        foreach ($categories as $category) {
// salida de contenidos de cada columna en una fila de la tabla
            echo $category['category_id'] . " " . $category['category_name'] . "----->" . $category['category_desc'] . "<br>";
        }
        ?>
    </div><!-- content -->

<?php
// FOOTER
include_once 'C:\xampp\htdocs\Teoria\PDF\AA Foro\views\footer.php';
?>