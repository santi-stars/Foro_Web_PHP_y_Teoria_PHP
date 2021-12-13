<?php
require_once '..\controllers\categories_controller.php';
$category_name = CategoriesController::cat_by_id($_GET['cat_id']);
require_once '..\controllers\topics_controller.php';
$topics = TopicsController::get_topics_by_cat_id($_GET['cat_id']);
require_once '..\controllers\users_controller.php';
require_once '..\controllers\comments_controller.php';


// HEADER
include_once 'header.php';
?>
    <!-- content -->
    <div id="content">
        <h1><?php echo $category_name->category_name ?></h1>
        <ul>
            <?php foreach ($topics as $topic) : ?>
                <a class="cat-link"
                   href='comments.php?sessionExists=<?php echo $_GET['sessionExists'] ?>&topic_id=<?php echo $topic->topic_id; ?>'>
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
                                    <?php $user = UserController::get_user_by_id($topic->user_id) ?>
                                    <p><?php echo $topic->topic_date . " - " ?> <strong
                                                class="user-name"><?php echo $user->user_nick; ?></strong></p>
                                </td>
                                <td class="cat-item__content__column2 second-row">
                                    <?php $count_comments = CommentsController::get_count_comments_by_topic_id($topic->topic_id); ?>
                                    <p><?php echo $count_comments->count_comments; ?></p>
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
include_once 'footer.php';
?>