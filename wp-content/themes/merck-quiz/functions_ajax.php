<?php
/**
 * Author: trac.nguyen (npbtrac@yahoo.com)
 * Date: 11/21/2014
 * Time: 3:42 PM
 *
 * handling ajax functions
 */

function merckquiz_getRoles()
{
    global $wp_roles;
    $roles = $wp_roles->get_names();
    $html = '';
    $checkbox = array();
    if ($_POST['termID']) {
        $checkbox = get_field('user_group_relation', 'questionnaire_' . $_POST['termID']);
    }
    $i = 0;
    foreach ($roles as $key => $item) {
        $i++;
        if ($item != 'Administrator') {
            $strChecked = '';
            if (in_array($key, $checkbox)) {
                $strChecked = 'checked';
            }
            $id = $i > 1 ? ('acf-field_577b6dbf90af2-' . $i) : 'acf-field_577b6dbf90af2';
            $html .= '<li><label><input type="checkbox" id="' . $id . '" name="acf[field_577b6dbf90af2][]" value="' . $key . '" ' . $strChecked . '>' . $item . '</label></li>';
        }
    }
    echo $html;
    exit();
}

add_action('wp_ajax_getRoles', 'merckquiz_getRoles');
add_action('wp_ajax_nopriv_getRoles', 'merckquiz_getRoles');

/*
 * ajax insert user
 */
add_action('wp_ajax_ajaxSignUp', 'merckquiz_ajaxSignUp');
add_action('wp_ajax_nopriv_ajaxSignUp', 'merckquiz_ajaxSignUp');
function merckquiz_ajaxSignUp()
{
    $result['code'] = 0;
    $obj = $_POST['form'];
    parse_str($obj, $output);
    $userdata = array(
        'user_login' => $output['username'],
        'user_email' => $output['email'],
        'display_name' => $output['fullname'],
        'user_pass' => $output['password']
    );

    $user_id = wp_insert_user($userdata);
    if (is_wp_error($user_id)) {
        $result['message'] = $user_id->get_error_message();
    } else {
        update_user_meta($user_id, 'phone', $output['phone']);
        $result['code'] = 1;
        $result['message'] = '';
    }
    echo json_encode($result);
    exit();


}

/**
 * Create post contest when user start
 */
add_action('wp_ajax_ajaxContest', 'merckquiz_ajaxContest');
add_action('wp_ajax_nopriv_ajaxContest', 'merckquiz_ajaxContest');
function merckquiz_ajaxContest()
{

    $listQuestion = $_POST['randQuestion'];
    $_SESSION['user-'.get_current_user_id()] = $listQuestion;
    $questionnaire = $_POST['questionnaire'];
    $listQuestion = json_decode($listQuestion);
    $result['code'] = 0;
    $author = get_current_user_id( );
    $title = 'user:'.$author.'-'.'questionnaire:'.$questionnaire;
    $args = array(
        'post_type' => 'contest-session',
        'post_status' => 'pending',
//        'post_status' => 'publish',
        'post_title'=>$title,
        'post_author'=>$author
    );
    $post = wp_insert_post($args);
    if($post){
        $contests=$question=array();
        foreach($listQuestion as $item){
            $question['question']= get_the_title($item);
            $question['id']= $item;
            $contests[]= $question;
        }
        $field_key = "field_578072ac4a137";
        update_field( $field_key, $contests, $post );
        $result['code'] = 1;
        $result['link'] = get_permalink($listQuestion[0]);
        $_SESSION['contest-'.get_current_user_id()] = $post;
    }
    if (is_wp_error($post)) {
        $result['message'] = $post->get_error_message();
    }
    echo json_encode($result);
    exit();
}
/**
 * update field of contest.
 *
 * if user completed update post status and generate file pdf
 */
add_action('wp_ajax_ajaxContestSession', 'merckquiz_ajaxContestSession');
add_action('wp_ajax_nopriv_ajaxContestSession', 'merckquiz_ajaxContestSession');
function merckquiz_ajaxContestSession()
{
    $result['code']=1;
    $data = $_POST['data'];
    parse_str($data, $output);
    $contestID= $output['contestId'];
    $orderCurrent = $output['orderCurrent'];
    $questionId = $output['questionId'];
    $argsAnswer = $output['answer'];
    if(!empty($output['answer']) && !is_array($output['answer'])){
        $argsAnswer= array($output['answer']);
    }
    $contests = get_field('contests',$contestID);
    $contests[$orderCurrent]['answer']= json_encode($argsAnswer);
    $contests[$orderCurrent]['visit']= true;
    if(merckquiz_checkAnswer($argsAnswer, $questionId)){
        $contests[$orderCurrent]['correct']= true;
    }
    else{
        $contests[$orderCurrent]['correct']= false;
    }
    update_field('field_578072ac4a137', $contests, $contestID);
    if(end($contests)['id']==$questionId){
        $args = array(
            'post_type' => 'contest-session',
            'post_status' => 'publish',
            'ID'=> $contestID
        );
        wp_update_post($args);
        $pdf=merckquiz_generatePDF($contestID, $output['term']);
        update_field('pdf',wp_upload_dir()['baseurl'].'/pdf/'.$pdf,$contestID);
        update_field('score',merckquiz_getScore($contestID),$contestID);

    }
    echo json_encode($result);
    exit;
}
function merckquiz_checkAnswer($argAnswer,$id){
    $args=get_field('repeater_of_answers', $id);
    $answerCorrect = array();
    $result = false;
    if(is_array($args)){
        foreach($args as $key=>$item){
            if($item['correct']==true){
                $answerCorrect[]=$key;
            }
        }
    }
    if(is_array($argAnswer) && count($answerCorrect) == count($argAnswer)){
        if(array_diff($answerCorrect,$argAnswer)){
            $result = true;
        }
        else{
            $result =false;
        }
    }
    return $result;
}

/**
 * change password
 */
add_action('wp_ajax_ajaxChangePassword', 'merckquiz_ajaxChangePassword');
add_action('wp_ajax_nopriv_ajaxChangePassword', 'merckquiz_ajaxChangePassword');
function merckquiz_ajaxChangePassword(){
    $result['code'] = 0;
    $obj = $_POST['form'];
    parse_str($obj, $output);
    $oldPassword = $output['oldPassword'];
    $newPassword = $output['password'];
    $user = get_user_by( 'ID', get_current_user_id() );
    if ( $user && wp_check_password( $oldPassword, $user->data->user_pass, $user->ID) ){
        wp_set_password( $newPassword, $user->ID );
        $result['code']=1;
    }
    else{
        $result['message']= __('Old Password not correct.', _NP_TEXT_DOMAIN);
    }
    echo json_encode($result);
    exit;
}

/**
 * change profile
 */
add_action('wp_ajax_ajaxChangeProfile', 'merckquiz_ajaxChangeProfile');
add_action('wp_ajax_nopriv_ajaxChangeProfile', 'merckquiz_ajaxChangeProfile');
function merckquiz_ajaxChangeProfile(){
    $result['code'] = 0;
    $obj = $_POST['form'];
    parse_str($obj, $output);
    $name = $output['fullname'];
    $phone = $output['phone'];
    $user_id = get_current_user_id();
    update_field('phone',$phone, 'user_'.$user_id);

    $user_id = wp_update_user( array( 'ID' => $user_id, 'display_name' => $name ) );

    if ( is_wp_error( $user_id ) ) {
        $result['message'] = $user_id->get_error_message();
    } else {
        $result['code']=1;
    }
    echo json_encode($result);
    exit;
}





