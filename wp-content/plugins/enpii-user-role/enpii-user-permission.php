<?php
/**
Plugin Name: Enpii User Role
Description: Plugin for limit user permission in backend
*/
define('EUP_PLUGIN_URL', plugin_dir_url(__FILE__));
define('EUP_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('EUP_PLUGIN_BASE_NAME', plugin_basename(__FILE__));
require_once(EUP_PLUGIN_DIR .'includes/loader.php');
$GLOBALS['enpii_user_permission'] = new Enpii\UserPermission\UserPermission();