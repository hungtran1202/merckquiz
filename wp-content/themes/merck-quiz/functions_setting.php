<?php
session_start();
$_SESSION['once_key'] = !isset($_SESSION['once_key']) || !$_SESSION['once_key'] ? wp_create_nonce(rand(1, 1000)) : $_SESSION['once_key'];

defined('_NP_TEXT_DOMAIN') || define('_NP_TEXT_DOMAIN', 'enpii');

defined('_NP_TEMPLATE_PATH') || define('_NP_TEMPLATE_PATH', get_template_directory());
defined('_NP_TEMPLATE_URL') || define('_NP_TEMPLATE_URL', get_template_directory_uri());

defined('_NP_CHILD_TEMPLATE_PATH') || define('_NP_CHILD_TEMPLATE_PATH', get_stylesheet_directory());
defined('_NP_CHILD_TEMPLATE_URL') || define('_NP_CHILD_TEMPLATE_URL', get_stylesheet_directory_uri());

defined('_NP_THEME_VERSION') || define('_NP_THEME_VERSION', '0.6');

defined('_NP_ALLOW_COMMENT') || define('_NP_ALLOW_COMMENT', false);
defined('ACF_LITE') || define('ACF_LITE', false);
