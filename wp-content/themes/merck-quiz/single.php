<?php
/**
 * Created by PhpStorm.
 * User: hungtran
 * Date: 4/1/16
 * Time: 3:15 PM
 */
get_header('single');
wp_reset_query();
$contestID = isset($_SESSION['contest-' . get_current_user_id()]) ? $_SESSION['contest-' . get_current_user_id()] : '';
$strRandomQuestion = isset($_SESSION['user-' . get_current_user_id()]) ? $_SESSION['user-' . get_current_user_id()] : '';
$id = get_the_ID();
$itemCurrent = '';
$contests = get_field('contests', $contestID);
$dateCurrent = NpCommon::convertTimeZone("GMT", "Y-m-d H:i:s");
$finished['code'] = 0;
$arrRandomQuestion = json_decode($strRandomQuestion);

$nextKey = 0;

if (is_array($contests)) {
    foreach ($contests as $key => $item) {
        if ($item['id'] == $id && !empty($contestID)) {
            $itemCurrent = $key;
            if (!empty($item['time_start']) && $item['visit']) {
                $finished['code']=1;
            }
            if (empty($item['time_start'])) {
                $contests[$key]['time_start'] = $dateCurrent;
                update_field('field_578072ac4a137', $contests, $contestID);
                break;
            }
            break;
        }

    }
}
if(is_array($arrRandomQuestion)){
    foreach($arrRandomQuestion as $question_key => $questionId){
        if(!$contests[$question_key]['visit']) {
            $nextKey = $question_key;
            break;
        }
    }
}
$timeAllowed = get_field('time_allowed');
$timeEnd = strtotime($contests[$itemCurrent]['time_start']) + $timeAllowed;
$timeCurrent = strtotime($dateCurrent);
$term = wp_get_post_terms(get_the_ID(), 'questionnaire');
$termId = explode('questionnaire:', get_the_title($contestID))[1];
$termName = get_term($termId, 'questionnaire')->name;
$checkContestSession = merckquiz_checkUserContest(get_current_user_id(),$termId);

if($checkContestSession['code']==1 && $checkContestSession['status'] !='pending'){
    wp_redirect(home_url());
    exit;
}
$linkNext='';
if ($nextKey != 0 && $finished['code']==1) {
    $linkNext =get_permalink($arrRandomQuestion[$nextKey]);
    wp_redirect($linkNext);
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
                        <h3 class="c-title c-font-uppercase c-theme-on-hover c-font-bold"><?php echo $termName ?></h3>
                        <?php
                        $questions = merckquiz_getQuestionOrder();
                        $question = get_the_title($id);
                        $answer = get_field('repeater_of_answers', $id);
                        $questionPrev = $questionNext = $postCurrent = '';
                        if (is_array($questions)) {
                            foreach ($questions as $value => $postId) {
                                if ($postId == $id) {
                                    $orderCurrent = $value;
                                }
                            }
                            $questionNext = get_permalink($questions[$orderCurrent + 1]);
                            if (end($questions) == $id) {
                                $questionNext = get_permalink(114) . '?contest=' . $contestID . '&questionnaire=' . $termName;
                            }
                        }
                        if(!empty($linkNext)){
                            $questionNext = $linkNext;
                        }
                        ?>
                        <form class="form-contest" action="" method="post" data-next="<?php echo $questionNext ?>">
                            <div class="box-question question-<?php echo $id ?>">
                                <input name="contestId" type="hidden" value="<?php echo $contestID ?>">
                                <input name="term" type="hidden" value="<?php echo $termId ?>">
                                <input name="questionId" type="hidden" value="<?php echo $id ?>">
                                <input name="orderCurrent" type="hidden" value="<?php echo $orderCurrent ?>">

                                <div class="question-name"><?php echo ($orderCurrent + 1) . '. ' . $question ?></div>
                                <div class="question-image"><?php echo get_the_content() ?></div>
                                <div class="answer">
                                    <div class="row">
                                        <?php
                                        if (merckquiz_countAnswerCorrect(get_the_ID()) > 1) {
                                            foreach ($answer as $key => $item) {
                                                ?>
                                                <div class="col-sm-6 answer-item">
                                                    <input name="answer" type="radio" id="<?php echo $key ?>"
                                                           value="<?php echo $key ?>">
                                                    <label for="<?php echo $key ?>"><?php echo $item['name'] ?></label>
                                                </div>
                                                <?php
                                            }
                                        } else {
                                            foreach ($answer as $key => $item) {
                                                ?>
                                                <div class="col-sm-6 answer-item">
                                                    <input name="answer[]" type="checkbox" id="<?php echo $key ?>"
                                                           value="<?php echo $key ?>">
                                                    <label for="<?php echo $key ?>"><?php echo $item['name'] ?></label>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <button
                                class="btn btn-sm c-theme-btn c-btn-square c-btn-uppercase c-btn-bold btn-next">
                                <?php echo __('Next', _NP_TEXT_DOMAIN) ?>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script language="javascript">
    var timeEnd = "<?php echo $timeEnd?>";
    var timeCurrent = "<?php echo $timeCurrent ?>";
    var questionNext = "<?php echo $questionNext ?>";
</script>
<?php get_footer() ?>
