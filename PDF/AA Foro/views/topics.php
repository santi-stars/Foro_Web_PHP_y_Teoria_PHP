<?php
require_once 'C:\xampp\htdocs\Teoria\PDF\AA Foro\controllers\categories_controller.php';
$categories = CategoriesController::categories_list();
$category_name = CategoriesController::cat_by_id($_GET['cat_id']);
require_once 'C:\xampp\htdocs\Teoria\PDF\AA Foro\controllers\topics_controller.php';
$topics = TopicsController::get_topics_by_cat_id($_GET['cat_id']);

// HEADER
    include_once 'C:\xampp\htdocs\Teoria\PDF\AA Foro\views\header.php';
?>
    <!-- content -->
    <div id="content">
        <h1><?php echo $category_name->category_name ?></h1>
        <ul>
            <?php foreach ($topics as $topic) : ?>
                <a class="cat-link"
                   href='topics.php?sessionExists=<?php echo $_GET['sessionExists'] ?>&cat_id=<?php echo $topic->topic_id; ?>'>
                    <div id="cat-item">
                        <table>
                            <tr>
                                <td class="cat-item__content__column1 first-row">
                                    <h3><?php echo $topic->topic_name ?></h3>
                                </td>
                                <td class="cat-item__content__column2 first-row">
                                    <p>Mensajes</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="cat-item__content__column1 second-row">
                                    <p><?php echo $topic->topic_date . " - "."Usuario"; ?></p>
                                </td>
                                <td class="cat-item__content__column2 second-row">
                                    <?php $category_id = TopicsController::get_count_topics_by_cat_id($topic->category_id); ?>
                                    <p><?php echo $topic->topic_id; ?></p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </a>
            <?php endforeach; ?>
        </ul>
    </div><!-- content -->

<?php
// FOOTER
include_once 'C:\xampp\htdocs\Teoria\PDF\AA Foro\views\footer.php';
?>