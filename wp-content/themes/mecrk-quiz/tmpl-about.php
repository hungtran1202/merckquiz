<?php
/**
 * Template name: About Page
 * Created by PhpStorm.
 * User: hungtran
 * Date: 4/1/16
 * Time: 3:15 PM
 */
get_header();
?>
<div class="container">
    <h1><?php echo __('Content Page', _NP_TEXT_DOMAIN) ?></h1>

    <div class="content">
        <?php echo get_the_content() ?>
    </div>
</div>
<li class="select2-results-dept-0 select2-result select2-result-selectable select2-highlighted" role="presentation"><div class="select2-result-label" id="select2-result-label-2" role="option"><span class="select2-match"></span>test</div></li><li class="select2-results-dept-0 select2-result select2-result-selectable" role="presentation"><div class="select2-result-label" id="select2-result-label-3" role="option"><span class="select2-match"></span>test 2</div></li>
<?php get_footer() ?>
