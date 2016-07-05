<?php
/**
 * Author: trac.nguyen (npbtrac@yahoo.com)
 * Date: 11/21/2014
 * Time: 3:42 PM
 *
 * handling ajax functions
 */

function mecrkquiz_getRoles(){
    global $wp_roles;
    $roles = $wp_roles->get_names();
    $html = '';
    $checkbox = array();
    if($_POST['termID']){
        $checkbox = get_field('user_group_relation','questionnaire_'.$_POST['termID']);
    }
    foreach($roles as $key=>$item){
        if($item !='Administrator') {
            $key++;
            $strChecked = '';
            foreach ($checkbox as $checked){
                if($checked == $item){
                    $strChecked = 'checked';
                }
            }
            $id = $key > 1 ? ('acf-field_577b6dbf90af2-' . $key) : 'acf-field_577b6dbf90af2';
            $html .= '<li><label><input type="checkbox" id="' . $id . '" name="acf[field_577b6dbf90af2][]" value="' . $item . '" '.$strChecked.'>' . $item . '</label></li>';
        }
    }
    echo $html;
    exit();
}
add_action('wp_ajax_getRoles', 'mecrkquiz_getRoles');
add_action('wp_ajax_nopriv_getRoles', 'mecrkquiz_getRoles');


