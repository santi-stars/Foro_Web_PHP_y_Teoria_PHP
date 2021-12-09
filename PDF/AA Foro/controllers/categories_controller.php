<?php


require_once 'C:\xampp\htdocs\Teoria\PDF\AA Foro\models\categories_model.php';

class Categories_controller
{

    public function __construct()
    {
    }


    /**
     * @return Categories_model|Objeto|null
     */
    public function categories_list()
    {
        $categories = Categories_model::get_categories();
        return $categories;
    }
}//end Clase

?>
