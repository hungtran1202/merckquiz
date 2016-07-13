<?php
/**
 * Template name: Contests Page
 * Created by PhpStorm.
 * User: hungtran
 * Date: 4/1/16
 * Time: 3:15 PM
 */
get_header();
wp_reset_query();
?>
<div class="c-layout-page">
    <!-- BEGIN: LAYOUT/BREADCRUMBS/BREADCRUMBS-3 -->
    <div class="c-layout-breadcrumbs-1 c-bgimage c-subtitle c-fonts-uppercase c-fonts-bold c-bg-img-center"
         style="background-image: url(<?php echo get_field('banner_image')?>)">
        <div class="container">
            <div class="c-page-title c-pull-left">
                <h3 class="c-font-uppercase c-font-bold c-font-white c-font-20 c-font-slim"><?php echo get_the_title()?></h3>
                <h4 class="c-font-white c-font-thin c-opacity-07"><?php echo get_field('sub_title')?></h4>
            </div>
        </div>
    </div>
    <!-- END: LAYOUT/BREADCRUMBS/BREADCRUMBS-3 -->
    <!-- BEGIN: PAGE CONTENT -->
    <!-- BEGIN: CONTENT/MISC/LATEST-ITEMS-3 -->
    <div class="c-content-box c-bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="c-content-media-1" style="min-height: 380px;">
                        <h3 class="c-title c-font-uppercase c-theme-on-hover c-font-bold"><?php echo get_field('title_content')?></h3>
                        <?php echo get_the_content()?>
                        <h3 class="c-title c-font-uppercase c-theme-on-hover c-font-bold"><?php echo __('Questionnaires')?></h3>

                        <ul class="c-content-list-1 c-theme c-separator-dot c-font-uppercase">
                            <?php merckquiz_questionnaire();?>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>

