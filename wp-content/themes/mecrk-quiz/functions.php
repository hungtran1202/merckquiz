<?php
require_once "functions_setting.php";
require_once "functions_basic.php";
require_once "functions_custom_post_type.php";
require_once "functions_acf.php";
require_once "functions_ajax.php";

function mecrkquiz_ajaxurl() {
    echo '<script type="text/javascript">
           var ajaxurl = "' . admin_url('admin-ajax.php') . '";
         </script>';
}
add_action('wp_head', 'mecrkquiz_ajaxurl');
function mecrkquiz_customBackend() {
    wp_enqueue_script( 'custom_role_relation_term', _NP_TEMPLATE_URL.'/js/backend.js' );
}
add_action( 'admin_enqueue_scripts', 'mecrkquiz_customBackend' );

?>


