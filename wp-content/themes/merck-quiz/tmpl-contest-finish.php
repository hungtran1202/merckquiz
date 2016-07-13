<?php
/**
 * Created by PhpStorm.
 * Template name: Contest Finish Page
 * User: hungtran
 * Date: 4/1/16
 * Time: 3:15 PM
 */
get_header();
$contestId = isset($_REQUEST['contest']) ? $_REQUEST['contest'] : '';
$linkPDF = get_field('pdf', $contestId);
$questionnaire = isset($_REQUEST['questionnaire']) ? $_REQUEST['questionnaire'] : '';
if (empty($contestId) || empty($questionnaire)) {
    wp_redirect(home_url());
    exit;
}

?>
<div class="c-layout-page">
    <!-- BEGIN: CONTENT/MISC/LATEST-ITEMS-3 -->
    <div class="c-content-box c-bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="c-content-media-1">
                        <?php echo __('You have completed the contest.', _NP_TEXT_DOMAIN) ?>
                        <div class="btn-report">
                            <?php
                            $term = get_term_by('name', $questionnaire, 'questionnaire');
                            $strView = get_field('view_result', 'questionnaire_' . $term->term_id);
                            if ($strView == 'all') {
                                ?>
                                <a target="_blank" href="<?php echo $linkPDF ?>"
                                   class="btn btn-sm c-theme-btn c-btn-square c-btn-uppercase c-btn-bold">
                                    <?php echo __('Report PDF', _NP_TEXT_DOMAIN) ?>
                                </a>
                                <?php
                            }
                            ?>
                            <a href="<?php echo site_url('/contest') ?>"
                               class="btn btn-sm c-theme-btn c-btn-square c-btn-uppercase c-btn-bold">
                                <?php echo __('Go To Home', _NP_TEXT_DOMAIN) ?>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer() ?>
