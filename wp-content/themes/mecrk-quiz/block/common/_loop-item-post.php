<?php
/**
 * Created by PhpStorm.
 * User: hungtran
 * Date: 4/5/16
 * Time: 1:35 PM
 *
 * @param $wp_query object global query
 */
global $wp_query,$posts;

?>
<div class="post-listing--inner">
    <?php

    $page = isset($_REQUEST['post_page']) ? (int)$_REQUEST['post_page'] : '';
    $posts_per_page = isset($_REQUEST['posts_per_page']) ? (int)$_REQUEST['posts_per_page'] : 2 ;

    $page = $page < 1 ? 1 : $page;
    $posts_per_page = $posts_per_page < 2 ? 2 : $posts_per_page;

    $the_query = new WP_Query(array(
        'post_type' => $posts[0]->post_type,
        'posts_per_page'    => $posts_per_page,
        'orderby' => 'date',
        'order' => 'DESC',

        'paged' => $page
    ));
    $args = array(

        'format' => '?post_page=%#%',
        'current' => $page,
        'total' => $the_query->max_num_pages,
        'show_all' => false,
        'end_size' => 2,
        'mid_size' => 3,
        'prev_next' => true,
        'prev_text' => '<',
        'next_text' => '>',
        'type' => 'plain',
        'add_args' => null,
        'add_fragment' => '',
        'before_page_number' => '',
        'after_page_number' => ''
    );
    while ($the_query->have_posts()) {
        $the_query->the_post();
        ?>
        <li>
            <a href="<?= get_permalink() ?>"><?= get_the_title() ?></a>
        </li>
        <?php
    }
    ?>
    <div class="clearfix"></div>
    <div class="pagination">PAGE <?php echo paginate_links($args); ?></div>
    <div class="clearfix"></div>
    <?php
    wp_reset_query();
    ?>

</div>

