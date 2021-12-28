<?php


require_once '..\models\categories_model.php';

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
        return CategoriesModel::get_categories();
    }
    public function cat_by_id($cat_id)
    {
        return CategoriesModel::get_category_by_id($cat_id);
    }
}
