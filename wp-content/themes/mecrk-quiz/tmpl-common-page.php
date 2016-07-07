<?php
/**
 * Template name: Common Page
 * Created by PhpStorm.
 * User: hungtran
 * Date: 4/1/16
 * Time: 3:15 PM
 */
get_header();
?>
<div class="c-layout-page">
    <!-- BEGIN: LAYOUT/BREADCRUMBS/BREADCRUMBS-3 -->
    <div class="c-layout-breadcrumbs-1 c-bgimage c-subtitle c-fonts-uppercase c-fonts-bold c-bg-img-center"
         style="background-image: url(<?php echo _NP_TEMPLATE_URL.'/assets/base/img/content/backgrounds/bg-28.jpg'?>)">
        <div class="container">
            <div class="c-page-title c-pull-left">
                <h3 class="c-font-uppercase c-font-bold c-font-white c-font-20 c-font-slim"><?php echo get_the_title()?></h3>
                <h4 class="c-font-white c-font-thin c-opacity-07"> Page Sub Title Goes Here </h4>
            </div>
        </div>
    </div>
    <!-- END: LAYOUT/BREADCRUMBS/BREADCRUMBS-3 -->
    <!-- BEGIN: PAGE CONTENT -->
    <!-- BEGIN: CONTENT/MISC/LATEST-ITEMS-3 -->
    <div class="c-content-box c-size-md c-bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="c-content-media-1" style="min-height: 380px;">
                        <a href="#" class="c-title c-font-uppercase c-theme-on-hover c-font-bold">Lorem ipsum</a>

                        <p>Lorem ipsum dolor sit amet, coectetuer adipiscing elit sed diam nonummy et nibh euismod
                            aliquam erat volutpat</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>

