<?php
require_once '..\controllers\categories_controller.php';
$category_name = CategoriesController::cat_by_id($_GET['cat_id']);
require_once '..\controllers\topics_controller.php';
$comments = TopicsController::get_topics_by_cat_id($_GET['cat_id']);
require_once '..\controllers\users_controller.php';
require_once '..\controllers\comments_controller.php';


// HEADER
include_once 'header.php';
?>
    <!-- content -->
    <div id="content">
        <h3><a class="cat-link" href='home.php?sessionExists=<?php echo $_GET['sessionExists'] ?>'>CATEGORÍAS --> </a>
            <?php echo $category_name->category_name ?></h3>
        <ul>
            <?php foreach ($comments as $topic) : ?>
                <a class="cat-link"
                   href='comments.php?sessionExists=<?php echo $_GET['sessionExists'] ?>&cat_id=<?php echo $_GET['cat_id'] ?>&topic_id=<?php echo $topic->topic_id; ?>'>
                    <div id="cat-item">
                        <table>
                            <tr>
                                <td class="cat-item__content__column1 first-row">
                                    <h3><?php echo $topic->topic_name ?></h3>
                                </td>
                                <td class="cat-item__content__column2 first-row">
                                    <?php $count_comments = CommentsController::get_count_comments_by_topic_id($topic->topic_id); ?>
                                    <p><?php echo $count_comments->count_comments; ?> - Mensajes</p>

                                </td>
                            </tr>
                            <tr>
                                <td class="cat-item__content__column1 second-row">
                                    <?php $user = UserController::get_user_by_id($topic->user_id) ?>
                                    <p>Por: <strong
                                                class="user-name"><?php echo $user->user_nick . " - " ?></strong><?php echo $topic->topic_date ?>
                                    </p>
                                </td>
                                <td class="cat-item__content__column2 second-row">
                                    <a class="" href='home.php?sessionExists=<?php echo $_GET['sessionExists'] ?>'><img
                                                id="" src="..\png\delete.png"></a>
                                    <a class="" href='home.php?sessionExists=<?php echo $_GET['sessionExists'] ?>'><img
                                                id="" src="..\png\write.png"></a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </a>
            <?php endforeach; ?>
        </ul>
        <button>Nuevo tema <img id="" src="..\png\write.png"></button>
    </div><!-- content -->

<?php
// FOOTER
include_once 'footer.php';
?>