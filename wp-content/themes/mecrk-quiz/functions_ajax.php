<?php
/**
 * Author: trac.nguyen (npbtrac@yahoo.com)
 * Date: 11/21/2014
 * Time: 3:42 PM
 *
 * handling ajax functions
 */

function mecrkquiz_getRoles()
{
    global $wp_roles;
    $roles = $wp_roles->get_names();
    $html = '';
    $checkbox = array();
    if ($_POST['termID']) {
        $checkbox = get_field('user_group_relation', 'questionnaire_' . $_POST['termID']);
    }
    foreach ($roles as $key => $item) {
        if ($item != 'Administrator') {
            $key++;
            $strChecked = '';
            foreach ($checkbox as $checked) {
                if ($checked == $item) {
                    $strChecked = 'checked';
                }
            }
            $id = $key > 1 ? ('acf-field_577b6dbf90af2-' . $key) : 'acf-field_577b6dbf90af2';
            $html .= '<li><label><input type="checkbox" id="' . $id . '" name="acf[field_577b6dbf90af2][]" value="' . $item . '" ' . $strChecked . '>' . $item . '</label></li>';
        }
    }
    echo $html;
    exit();
}

add_action('wp_ajax_getRoles', 'mecrkquiz_getRoles');
add_action('wp_ajax_nopriv_getRoles', 'mecrkquiz_getRoles');

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
        update_user_meta($user_id,'phone',$output['phone']);
        $result['code'] = 1;
        $result['message'] = '';
    }
    echo json_encode($result);
    exit();


}


