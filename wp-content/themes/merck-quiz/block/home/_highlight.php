<?php
/**
 * Created by PhpStorm.
 * User: hungtran
 * Date: 4/28/16
 * Time: 11:26 AM
 */
?>
<div class="highlight">
    <div class="highlight">
        <?php
        foreach ($data['list_post'] as $item) {
            $title = $item['service']->post_title;
            $link = get_permalink($item['service']->ID);
            $intro = NpWp::enpii_subtring($item['service']->post_excerpt, 48, '...');
            $urlImg = wp_get_attachment_url(get_post_thumbnail_id($item['service']->ID));
            ?>
            <div class="col-md-3 post-item">
                <div class="post-item-inner"
                     style="background: url(<?php echo $urlImg ?>) no-repeat center; background-size: cover">
                    <div class="title"><?php echo $title ?></div>
                    <div class="intro"><?php echo $intro ?></div>
                    <div class="button"><a href="<?php echo $link ?>"></a></div>
                </div>
            </div>
            <?php
        }
        ?>
        <div class="clearfix"></div>
    </div>
</div>
