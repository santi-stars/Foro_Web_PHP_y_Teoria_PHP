<?php

// set_include_path( 'C:\xampp\htdocs\Teoria\PDF\AA Foro' );
require_once '..\models\topics_model.php';

class TopicsController
{
    /**
     *
     */
    public function __construct()
    {
    }


    /**
     * @return array
     */
    public function topics_list()
    {
        return TopicsModel::get_topics();
    }

    public function get_topics_by_cat_id($cat_id)
    {
        return TopicsModel::get_topics_by_cat_id($cat_id);
    }

    /**
     * @param $cat_id
     * @return array|false|Object|PDO|String
     */
    public function get_count_topics_by_cat_id($cat_id)
    {
        return TopicsModel::get_count_topics_by_cat_id($cat_id);
    }
}