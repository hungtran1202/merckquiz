<?php
/**
 * Created by PhpStorm.
 * User: hungtran
 * Date: 4/4/16
 * Time: 4:55 PM
 */
?>
<aside id="categories-2" class="widget widget_categories">
    <header><h2 class="widget-title"><?= __('Lastest News', _NP_TEXT_DOMAIN)?></h2></header>

    <ul>
        <?php
        while (have_posts()) : the_post();
            ?>
            <li class="cat-item cat-item-1"><a href="<?= get_permalink()?>"><?php the_title() ?></a>
            </li>

            <?php
        endwhile;

        // Reset Query
        wp_reset_query();
        ?>
    </ul>
</aside>
