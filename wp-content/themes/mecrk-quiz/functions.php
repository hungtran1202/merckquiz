<?php
require_once "functions_setting.php";
require_once "functions_basic.php";
require_once "functions_custom_post_type.php";
require_once "functions_acf.php";
require_once "functions_ajax.php";


function ajaxUrl() {
    echo '<script type="text/javascript">
           var ajaxurl = "' . admin_url('admin-ajax.php') . '";
         </script>';
}
add_action('wp_head', 'ajaxUrl');

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


function mecrkquiz_customLogo() {
    $mainLogo= get_field('main_logo', 'option');
    ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo $mainLogo['url'] ?>);
            width: 230px;
            background-size: 100%;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'mecrkquiz_customLogo' );

function mecrkquiz_customSidebarBackend() {
    if(wp_get_current_user()->roles[0] !='administrator'):

    ?>
    <style type="text/css">
        #wp-admin-bar-wp-logo, #toplevel_page_wpcf7, #menu-appearance, #menu-users, #menu-tools, #menu-settings, #toplevel_page_edit-post_type-acf-field-group, #toplevel_page_w3tc_dashboard{
            display: none;
        }
    </style>
<?php
    endif;
}
add_action( 'admin_head', 'mecrkquiz_customSidebarBackend' );

function mecrkquiz_lostPasswordRedirect() {

    // Check if have submitted
    $confirm = ( isset($_GET['checkemail'] ) ? $_GET['checkemail'] : '' );
    $action = ( isset($_GET['action'] ) ? $_GET['action'] : '' );
    if( $confirm ) {
        wp_redirect( site_url('/lost-password?checkemail=confirm') );
        exit;
    }
    elseif($action=='lostpassword'){
        wp_redirect( site_url('/lost-password?checkemail=false') );
        exit;
    }
    elseif(empty($action)){
        wp_redirect( site_url('/lost-password') );
        exit;
    }
}
add_action('login_headerurl', 'mecrkquiz_lostPasswordRedirect');

/*
 * redirect after login fail
 */
add_action( 'wp_login_failed', 'mecrkquiz_redirectLoginFail' );  // hook failed login

function mecrkquiz_redirectLoginFail( $username ) {
    $referrer = $_SERVER['HTTP_REFERER'];  // where did the post submission come from?
    // if there's a valid referrer, and it's not the default log-in screen
    if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') ) {
        wp_redirect( site_url('/login') . '?login=failed&user='.$username );  // let's append some information (login=failed) to the URL for the theme to use
        exit;
    }
}

//add_filter('show_admin_bar', '__return_false');
?>


