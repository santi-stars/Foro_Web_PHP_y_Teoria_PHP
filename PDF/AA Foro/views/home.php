<?php

//require_once 'C:\xampp\htdocs\Teoria\PDF\AA Foro\controllers\session_controller.php';
// inicializamos el session_controler
// $session = new SessionController();
//require_once 'C:\xampp\htdocs\Teoria\PDF\AA Foro\models\conexion\conexion.php';
//$conexion = Conexion::ConexionStart();  //CONECTA


require_once 'C:\xampp\htdocs\Teoria\PDF\AA Foro\controllers\categories_controller.php';
$categories = CategoriesController::categories_list();
// HEADER
include_once 'C:\xampp\htdocs\Teoria\PDF\AA Foro\views\header.php';
?>
    <!-- content -->
    <div id="content">
        <h2>CATEGORIAS</h2>
        <ul>
        <?php foreach ($categories as $category) : ?>
            <li> <?php echo $category["category_id"] . " " . $category['category_name'] . "----->" . $category['category_desc'];?></li>
            <?php endforeach; ?>
            </ul>
    </div><!-- content -->

<?php
// FOOTER
include_once 'C:\xampp\htdocs\Teoria\PDF\AA Foro\views\footer.php';
?>