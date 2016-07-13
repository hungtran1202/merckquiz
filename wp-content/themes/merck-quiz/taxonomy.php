<?php
/**
 * Created by PhpStorm.
 * User: hungtran
 * Date: 4/5/16
 * Time: 12:19 PM
 */
get_header();
$contestID = 64;
$obj = get_queried_object();
$description = $obj->description;
$name = $obj->name;
$termId = $obj->term_id;
?>

    <div class="c-layout-page">
        <!-- BEGIN: LAYOUT/BREADCRUMBS/BREADCRUMBS-3 -->
        <div class="c-layout-breadcrumbs-1 c-bgimage c-subtitle c-fonts-uppercase c-fonts-bold c-bg-img-center"
             style="background-image: url(<?php echo get_field('banner_image', $contestID) ?>)">
            <div class="container">
                <div class="c-page-title c-pull-left">
                    <h3 class="c-font-uppercase c-font-bold c-font-white c-font-20 c-font-slim">
                        <?php echo get_the_title($contestID) ?>
                    </h3>
                    <h4 class="c-font-white c-font-thin c-opacity-07"><?php echo get_field('sub_title', $contestID) ?></h4>
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
                            <h3 class="c-title c-font-uppercase c-theme-on-hover c-font-bold"><?php echo $name ?></h3>

                            <?php echo $description ?>
                            <div class="list-question">
                                <?php
                                $argQuestion = array();
                                $i = 0;
                                $args = array(
                                    'post_type' => 'question',
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'questionnaire',                //(string) - Taxonomy.
                                            'field' => 'id',                    //(string) - Select taxonomy term by ('id' or 'slug')
                                            'terms' => $termId,    //(int/string/array) - Taxonomy term(s).
                                            'operator' => 'IN'
                                        ),
                                    )
                                );
                                $the_query = new WP_Query($args);
                                // The Loop
                                if ($the_query->have_posts()) :
                                    while ($the_query->have_posts()) : $the_query->the_post();
                                        $i++;
                                        $argQuestion[] = get_the_ID();
                                    endwhile;
                                endif;
                                // Reset Post Data
                                wp_reset_postdata();
                                shuffle($argQuestion);
                                $result = json_encode($argQuestion);
                                $report = merckquiz_checkUserContest(get_current_user_id(), $termId);
                                $viewResult = get_field('view_result', 'questionnaire_' . $termId);
                                if ($report['code'] == 1) {
                                    if ($report['status'] != 'pending') {
                                        merckquiz_setSession($report['id']);
                                        ?>
                                        <div class="c-margin-t-30">
                                            <?php echo __('You already joined the contest', _NP_TEXT_DOMAIN) ?>
                                            <div class="form-group">
                                                <?php
                                                if ($viewResult == 'all') {
                                                    ?>
                                                    <a target="_blank" href="<?php echo get_field('pdf', $report['id']) ?>"
                                                       class="btn btn-sm btn-result c-theme-btn">
                                                        <?php echo __('View Result', _NP_TEXT_DOMAIN) ?>
                                                    </a>

                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="c-margin-t-30">
                                            <div class="form-group">
                                                <a href="<?php echo get_permalink($report['notVisit']) ?>"
                                                   class="btn btn-sm btn-result c-theme-btn">
                                                    <?php echo __('Resume Contest', _NP_TEXT_DOMAIN) ?>
                                                </a>
                                            </div>
                                        </div>
                                        <?php
                                    }

                                } else {
                                    ?>
                                    <div class="c-margin-t-30">
                                        <div class="form-group">
                                            <button type="submit" data-session="<?php echo $result ?>"
                                                    data-questionnaire="<?php echo $termId ?>"
                                                    class="btn btn-sm c-theme-btn c-btn-square c-btn-uppercase c-btn-bold btn-start">
                                                <?php echo __('Start', _NP_TEXT_DOMAIN) ?>
                                            </button>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>