<?php

require_once '..\models\topics_model.php';

class TopicsController
{

    public function __construct()
    {
    }

    public function topics_list()
    {
        return TopicsModel::get_topics();
    }

    public function get_topic_by_id($topic_id)
    {
        return TopicsModel::get_topic_by_id($topic_id);
    }

    public function get_topics_by_cat_id($cat_id)
    {
        return TopicsModel::get_topics_by_cat_id($cat_id);
    }

    public function get_last_topic_id()
    {
        return TopicsModel::get_last_topic_id();
    }

    public function get_count_topics_by_cat_id($cat_id)
    {
        return TopicsModel::get_count_topics_by_cat_id($cat_id);
    }

    public function get_user_id_by_topic_id($topic_id)
    {
        return TopicsModel::get_user_id_by_topic_id($topic_id);
    }

    public function register_topic($topic_name, $user_id, $category_id)
    {
        return TopicsModel::register_topic($topic_name, $user_id, $category_id);
    }

    public function delete_topic_by_id($topic_id)
    {
        return TopicsModel::delete_topic_by_id($topic_id);
    }
}