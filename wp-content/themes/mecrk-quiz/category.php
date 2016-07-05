<?php
/**
 * Created by PhpStorm.
 * User: hungtran
 * Date: 4/5/16
 * Time: 12:19 PM
 */
get_header(); ?>

    <div class="cate-content">
        <div class="container">
            <div class="row">
                <div class="">
                    <h2 class="pull-left page-title"><?php echo __('News & Updates', _NP_TEXT_DOMAIN) ?></h2>
                    <div class="post-listing">
                        <?php
                        if(defined('_ENPII_CORE')) { // check plugin enpii core active
                            NpWp::getBlock('common/_loop-item-post.php');
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>