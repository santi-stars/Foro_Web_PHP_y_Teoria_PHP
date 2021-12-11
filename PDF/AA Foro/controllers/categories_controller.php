<?php


require_once 'C:\xampp\htdocs\Teoria\PDF\AA Foro\models\categories_model.php';

class CategoriesController
{

    public function __construct()
    {
    }


    /**
     * @return CategoriesModel|Objeto|null
     */
    public function categories_list()
    {
        return CategoriesModel::get_categories();;
    }
}//end Clase

?>
