<?php
/**
 * Template name: Home Page
 * Created by PhpStorm.
 * User: hungtran
 * Date: 4/1/16
 * Time: 3:15 PM
 */
get_header();
$dataContent = get_field('block');
?>

<div class="home-content">

    <?php if ($dataContent) { ?>
        <?php foreach ($dataContent as $key => $contentPart) : ?>
            <?php
            NpWp::getBlock('home/_' . $contentPart['acf_fc_layout'], array('data' => $contentPart));
            ?>
        <?php endforeach; ?>
    <?php } ?>
</div>
<?php get_footer() ?>

