<?php
require_once '..\controllers\categories_controller.php';
$category_name = CategoriesController::cat_by_id($_GET['cat_id']);
require_once '..\controllers\topics_controller.php';
$topic = TopicsController::get_topic_by_id($_GET['topic_id']);
//$topic_name = TopicsController::
require_once '..\controllers\users_controller.php';
require_once '..\controllers\comments_controller.php';
$comments = CommentsController::get_comments_by_topic_id($_GET['topic_id']);

// HEADER
include_once 'header.php';
?>
    <!-- content -->
    <div id="content">
        <h3><a class="cat-link" href='home.php?sessionExists=<?php echo $_GET['sessionExists'] ?>'>CATEGORÍAS > </a>
            <a class="cat-link"
               href='topics.php?sessionExists=<?php echo $_GET['sessionExists'] ?>&cat_id=<?php echo $_GET['cat_id']; ?>'
            ><?php echo $category_name->category_name . " --> " ?></a><?php echo $topic->topic_name ?></h3>
        <ul>
            <?php foreach ($comments as $comment) : ?>
                <div id="cat-item">
                    <table>
                        <tr>
                            <td class="cat-item__content__column1 first-row">
                                <?php $user = UserController::get_user_by_id($comment->user_id) ?>
                                <p>
                                    <strong class="user-name"><?php echo $user->user_nick; ?></strong><?php echo " - " . $comment->comment_date ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td class="cat-item__content__column1 second-row">
                                <p><?php echo $comment->comment_text; ?></p>
                            </td>
                            <td class="cat-item__content__column2 second-row">
                                <a class="img-button__comments"
                                   href='delete_comment.php?sessionExists=<?php echo $_GET['sessionExists'] ?>&cat_id=
                                       <?php echo $topic->category_id ?>&topic_id=<?php echo $topic->topic_id ?>&comment_id=
                                       <?php echo $comment->comment_id ?>'>
                                    <img id="" src="..\png\delete.png">
                                </a>
                                <a class="img-button__comments"
                                   href='writte-comment.php?sessionExists=<?php echo $_GET['sessionExists'] ?>&cat_id=
                                       <?php echo $topic->category_id ?>&topic_id=<?php echo $topic->topic_id ?>'>
                                    <img id="" src="..\png\write.png">
                                </a>
                            </td>
                        </tr>
                    </table>
                </div>
            <?php endforeach; ?>
        </ul>
        <button>Escribe tu mensaje <img id="" src="..\png\reply.png"></button>
    </div><!-- content -->

<?php
// FOOTER
include_once 'footer.php';
?>