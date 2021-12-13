<?php
require_once '..\controllers\categories_controller.php';
$categories = CategoriesController::categories_list();
require_once '..\controllers\topics_controller.php';

// HEADER
include_once '..\views\header.php';
?>
    <!-- content -->
    <div id="content">
        <h1>CATEGORIAS</h1>
        <ul>
            <?php foreach ($categories as $category) : ?>
                <a class="cat-link"
                   href='topics.php?sessionExists=<?php echo $_GET['sessionExists'] ?>&cat_id=<?php echo $category->category_id; ?>'>
                    <div id="cat-item">
                        <table>
                            <tr>
                                <td class="cat-item__content__column1 first-row">
                                    <h3><?php echo $category->category_name ?></h3>
                                </td>
                                <td class="cat-item__content__column2 first-row">
                                    <p>Temas</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="cat-item__content__column1 second-row">
                                    <p><?php echo $category->category_desc; ?></p>
                                </td>
                                <td class="cat-item__content__column2 second-row">
                                    <?php $count_topics = TopicsController::get_count_topics_by_cat_id($category->category_id); ?>
                                    <p><?php echo $count_topics->count_topics; ?></p>
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