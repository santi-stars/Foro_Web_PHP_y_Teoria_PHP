<?php

// set_include_path( 'C:\xampp\htdocs\Teoria\PDF\AA Foro' );
require_once '..\models\comments_model.php';

class CommentsController
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
    public function comments_list()
    {
        return CommentsModel::get_comments();
    }

    public function get_comments_by_topic_id($topic_id)
    {
        return CommentsModel::get_comments_by_topic_id($topic_id);
    }

    /**
     * @param $topic_id
     * @return array|false|Object|PDO|String
     */
    public function get_count_comments_by_topic_id($topic_id)
    {
        return CommentsModel::get_count_comments_by_topic_id($topic_id);
    }
}