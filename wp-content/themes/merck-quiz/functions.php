<?php
require_once "functions_setting.php";
require_once "functions_basic.php";
require_once "functions_custom_post_type.php";
require_once "functions_acf.php";
require_once "functions_ajax.php";


function ajaxUrl()
{
    echo '<script type="text/javascript">
           var ajaxurl = "' . admin_url('admin-ajax.php') . '";
         </script>';
}

add_action('wp_head', 'ajaxUrl');

function merckquiz_ajaxurl()
{
    echo '<script type="text/javascript">
           var ajaxurl = "' . admin_url('admin-ajax.php') . '";
         </script>';
}

add_action('wp_head', 'merckquiz_ajaxurl');
function merckquiz_customBackend()
{
    wp_enqueue_script('custom_role_relation_term', _NP_TEMPLATE_URL . '/js/backend.js');
}

add_action('admin_enqueue_scripts', 'merckquiz_customBackend');


function merckquiz_customLogo()
{
    $mainLogo = get_field('main_logo', 'option');
    ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo $mainLogo['url'] ?>);
            width: 230px;
            background-size: 100%;
        }
    </style>
<?php }

add_action('login_enqueue_scripts', 'merckquiz_customLogo');

function merckquiz_customSidebarBackend()
{

    if (wp_get_current_user()->roles[0] != 'administrator'):

        ?>
        <style type="text/css">
            #wp-admin-bar-wp-logo, #toplevel_page_wpcf7, #menu-posts, #menu-media, #menu-pages, #menu-appearance, #menu-comments, #menu-tools, #menu-settings, #toplevel_page_edit-post_type-acf-field-group, #toplevel_page_w3tc_dashboard, #wp-admin-bar-w3tc, #wp-admin-bar-new-content, #wp-admin-bar-comments {
                display: none;
            }
        </style>
        <?php
    endif;
}

add_action('admin_head', 'merckquiz_customSidebarBackend');

function merckquiz_lostPasswordRedirect()
{

    // Check if have submitted
    $confirm = (isset($_GET['checkemail']) ? $_GET['checkemail'] : '');
    $action = (isset($_GET['action']) ? $_GET['action'] : '');
    if ($confirm) {
        wp_redirect(site_url('/lost-password?checkemail=confirm'));
        exit;
    } elseif ($action == 'lostpassword') {
        wp_redirect(site_url('/lost-password?checkemail=false'));
        exit;
    } elseif (empty($action)) {
        wp_redirect(site_url('/login'));
        exit;
    }
}

add_action('login_headerurl', 'merckquiz_lostPasswordRedirect');

/*
 * redirect after login fail
 */
add_action('wp_login_failed', 'merckquiz_redirectLoginFail');  // hook failed login

function merckquiz_redirectLoginFail($username)
{
    $referrer = $_SERVER['HTTP_REFERER'];  // where did the post submission come from?
    // if there's a valid referrer, and it's not the default log-in screen
    if (!empty($referrer) && !strstr($referrer, 'wp-login') && !strstr($referrer, 'wp-admin')) {
        wp_redirect(site_url('/login') . '?login=failed&user=' . $username);  // let's append some information (login=failed) to the URL for the theme to use
        exit;
    }
}

add_filter('show_admin_bar', '__return_false');
/*
 * Redirect after logged
 */

function merckquiz_redirectDashboard()
{
    global $user;
    if (isset($user->roles) && is_array($user->roles)) {
        if (in_array('administrator', $user->roles) || in_array('admin', $user->roles)) {
            wp_redirect(site_url('/wp-admin'));
            exit;
        } else {
            wp_redirect(home_url());
            exit;
        }
    }
}

add_filter('login_redirect', 'merckquiz_redirectDashboard');
/*
 * get question order of user
 * return array
 */
function merckquiz_getQuestionOrder()
{
    if (is_user_logged_in()) {
        $questionOrder = isset($_SESSION['user-' . get_current_user_id()]) ? $_SESSION['user-' . get_current_user_id()] : null;
        return json_decode($questionOrder);
    }
    return null;
}

require_once(__DIR__ . '/libs/tcpdf-master/tcpdf.php');
function merckquiz_generatePDF($id, $qustionnaireId)
{
    require_once(__DIR__ . '/libs/tcpdf-master/examples/tcpdf_include.php');

// create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $logo = get_field('main_logo', 'option')['url'];
    $name = _wp_get_current_user()->display_name;
    $termId = explode('questionnaire:', get_the_title($id))[1];
    $questionnaire = get_term($termId, 'questionnaire')->name;
    $date = NpCommon::convertTimeZone("GMT", "d-m-Y");
    $score = merckquiz_getScore($id);
    $argContests = get_field('contests', $id);
    $strContent = '';
    $i = 0;
    $alphabet = range('A', 'Z');

    $fileName = 'contest_' . $id . '_' . uniqid(get_current_user_id().$qustionnaireId.gmdate('YmdHis')) . '.pdf';
// set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor($name);
    $pdf->SetTitle('Contest ' . $qustionnaireId);
    $pdf->SetSubject('Contest');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data


// set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


// ---------------------------------------------------------
// set default font subsetting mode
    $pdf->setFontSubsetting(true);

    // set font
    $pdf->SetFont('freeserif', '', 12);

    // add a page
    $pdf->AddPage();

// define some HTML content with style

    if (is_array($argContests)) {

        foreach ($argContests as $key => $item) {
            $i++;
            $argContestAnswer = json_decode($item['answer']);
            $checkAnswer = merckquiz_checkAnswer($argContestAnswer, $item['id']);
            $strContent .= '<tr>';
            if ($checkAnswer) {
                $strContent .= '<td width="30"><img src="' . _NP_TEMPLATE_URL . '/img/checked.png' . '" alt="" width="20px"></td>';
            } else {
                $strContent .= '<td width="30"><img src="' . _NP_TEMPLATE_URL . '/img/flase.png' . '" alt="" width="20px"></td>';
            }
            $strContent .= '<td width="600">';
            $strContent .= '<h3 class="answerCorrect"><i>' . $i . '. </i>' . $item['question'] . '</h3>';
            $argAnswer = get_field('repeater_of_answers', $item['id']);
            $strContent .= '</td>';
            $strContent .= '</tr>';
            $strContent .= '<tr>';
            $strContent .= '<td width="30">';
            $strContent .= '</td>';
            $strContent .= '<td width="600" colspan="2">';
            if (is_array($argAnswer)) {
                $strContent .= '<table width="600" border="0" cellspacing="10px">';
                foreach ($argAnswer as $keyAS => $answer) {
                    $strContent .= '<tr>';
                    if (!is_array($argContestAnswer)) {
                        $strContent .= '<td width="20"style=" text-align: center"><div class="test1">' . $alphabet[$keyAS] . '</div></td>';
                    } elseif (array_diff(array($keyAS), $argContestAnswer)) {
                        $strContent .= '<td width="20"  style=" text-align: center"><div class="test1">' . $alphabet[$keyAS] . '</div></td>';
                    } else {
                        $strContent .= '<td width="20"style=" text-align: center"><div class="answer-correct">' . $alphabet[$keyAS] . '</div></td>';
                    }
                    $strContent .= '<td width="10"></td>';
                    $strContent .= '<td width="550">' . $answer['name'] . '</td>';
                    $strContent .= '</tr>';
                }
                $strContent .= '</table>';
            }
            $strContent .= '</td>';
            $strContent .= '</tr>';


        }

    }

    $html = <<<EOF
<!-- EXAMPLE OF CSS STYLE -->
<style>
    * {
        box-sizing: border-box;
    }


    .lowercase {
        text-transform: lowercase;
    }
    .uppercase {
        text-transform: uppercase;
    }
    .capitalize {
        text-transform: capitalize;
    }
    .main-logo{
        text-align: center;
    }
    .header-right{
        text-align: right;
    }
    .bold{
        font-weight: bold;
    }
    .answer{
        width: 30px;
        height: 30px;
        border: 1px solid #000000;

        display: inline-block;
    }
    div.answer-correct {
        color: #000;
        background-color: #cbcbcb;
        text-align: center;
    }
</style>
<div class="main-logo"  >
    <img src="$logo" alt="" width="200" height="auto">
</div>
<table class="first">
 <tr>
    <td>
        <div class="header-left">
        <div class="name bold">Name: $name</div>
        <div class="questionnaire bold">Quiz name: $questionnaire</div>
        </div>
    </td>
    <td>
        <div class="header-right">
            <div class="date bold">Date: $date</div>
            <div class="score bold">Score: $score %</div>
        </div>

    </td>
 </tr>

</table>

<table class="first">
 $strContent

</table>
EOF;
// output the HTML content
    $pdf->writeHTML($html, true, false, true, false, '');

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -


// ---------------------------------------------------------

//Close and output PDF document
    $file_path = WP_CONTENT_DIR . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'pdf' . DIRECTORY_SEPARATOR . $fileName;
    $pdf->Output($file_path, 'F');
    return $fileName;

//============================================================+
// END OF FILE
//============================================================+
}

function merckquiz_getScore($id)
{
    $contests = get_field('contests', $id);
    $totalCorrect = 0;
    $totalQuestion = 0;
    if (is_array($contests)) {
        foreach ($contests as $number => $contest) {
            $totalQuestion = $number + 1;
            if ($contest['correct']) {
                $totalCorrect++;
            }
        }
    }
    return number_format(($totalCorrect / $totalQuestion * 100), 2);
}

/*
 * return html ist of Questionnaire user can join
 */
function merckquiz_questionnaire()
{
    $terms = get_terms('questionnaire', array(
        'hide_empty' => false,
    ));
    global $current_user;
    $myRoles = array();
    $termByRole = array();
    if (isset($current_user->roles) && is_array($current_user->roles)) {
        $myRoles = $current_user->roles;
    }
    foreach ($terms as $term) {
        $termID = $term->term_id;
        $termName = $term->name;
        $termSlug = $term->slug;
        $termLink = get_term_link($termSlug, 'questionnaire');
        $relationRole = get_field('user_group_relation', 'questionnaire_' . $termID);
        if (is_array($relationRole)) {
            if (array_intersect($myRoles,$relationRole)) {
                    ?>
                    <li class="questionnaire"><a href="<?php echo $termLink ?>"><?php echo $termName ?></a></li>
                    <?php
            }

        }

    }
}

/**
 * @param $userId
 * @param $questionnaireId
 * @return false|int|null
 * check user take part in the contest. If user have the contest return id the contest
 */
function merckquiz_checkUserContest($userId, $questionnaireId){
    $result['code']= 0;
    $the_query = new WP_Query(
        array(
            'post_type'=>'contest-session',
            'post_status'=> array('publish', 'pending'),
            'title'=>'user:'.$userId.'-questionnaire:'.$questionnaireId
        )
    );
// The Loop
    if ( $the_query->have_posts() ) :
        while ( $the_query->have_posts() ) : $the_query->the_post();
            $status=get_post_status();
            $result['id']= get_the_ID();
            $result['code']=1;
            if($status=='pending'){
                $result['status']='pending';
                $questions= get_field('contests');
                if(is_array($questions)){
                    foreach($questions as $item){
                        if($item['visit']==false){
                            $result['notVisit']= $item['id'];
                            break;
                        }
                    }
                }
            }
        endwhile;
    endif;
// Reset Post Data
    wp_reset_postdata();
    return $result;
}

/**
 * @param $contestId
 * set session random question and contest id
 */
function merckquiz_setSession($contestId){
    $_SESSION['contest-'.get_current_user_id()] = $contestId;
    $contests=get_field('contests', $contestId);
    $argQuestionId = array();
    if(is_array($contests)){
        foreach($contests as $item){
            $argQuestionId[]= $item['id'];
        }
    }
    $_SESSION['user-'.get_current_user_id()] = $argQuestionId;
}

/**
 * @param $questionId
 * @return array , array answer correct
 */

function merckquiz_countAnswerCorrect($questionId){
    $answers = get_field('repeater_of_answers', $questionId);
    $countAnswer= array();
    foreach ($answers as $key => $item) {
        $countAnswer[]=$item['correct'];
    }
    return $countAnswer;
}
?>


