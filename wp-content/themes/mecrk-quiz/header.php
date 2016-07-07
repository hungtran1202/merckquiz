<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title(); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!--    favicon-->
    <link rel="shortcut icon" href="<?php echo get_field('favicon', 'option') ?>" type="image/x-icon"/>

    <!-- iOS stuffs -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="apple-touch-icon" href="<?php echo get_field('ios_icon_iphone', 'option') ?>">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_field('ios_icon_iphone_ipad', 'option') ?>">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_field('ios_icon_iphone_retina', 'option') ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_field('ios_icon_ipad_retina', 'option') ?>">


    <!--    Google Fonts-->
    <link
        href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic'
        rel='stylesheet' type='text/css'>

    <link href="<?php echo _NP_TEMPLATE_URL . '/assets/plugins/socicon/socicon.css' ?>" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo _NP_TEMPLATE_URL . '/assets/plugins/bootstrap-social/bootstrap-social.css' ?>"
          rel="stylesheet" type="text/css"/>
    <link href="<?php echo _NP_TEMPLATE_URL . '/assets/plugins/font-awesome/css/font-awesome.min.css' ?>"
          rel="stylesheet" type="text/css"/>
    <link href="<?php echo _NP_TEMPLATE_URL . '/assets/plugins/simple-line-icons/simple-line-icons.min.css' ?>"
          rel="stylesheet" type="text/css"/>
    <link href="<?php echo _NP_TEMPLATE_URL . '/assets/plugins/animate/animate.min.css' ?>" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo _NP_TEMPLATE_URL . '/assets/plugins/bootstrap/css/bootstrap.min.css' ?>" rel="stylesheet"
          type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN: BASE PLUGINS  -->
    <link href="<?php echo _NP_TEMPLATE_URL . '/assets/plugins/cubeportfolio/css/cubeportfolio.min.css' ?>"
          rel="stylesheet" type="text/css"/>
    <link href="<?php echo _NP_TEMPLATE_URL . '/assets/plugins/owl-carousel/owl.carousel.css' ?>" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo _NP_TEMPLATE_URL . '/assets/plugins/owl-carousel/owl.theme.css' ?>" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo _NP_TEMPLATE_URL . '/assets/plugins/owl-carousel/owl.transitions.css' ?>" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo _NP_TEMPLATE_URL . '/assets/plugins/fancybox/jquery.fancybox.css' ?>" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo _NP_TEMPLATE_URL . '/assets/plugins/slider-for-bootstrap/css/slider.css' ?>" rel="stylesheet"
          type="text/css"/>
    <!-- END: BASE PLUGINS -->
    <!-- BEGIN THEME STYLES -->
    <link href="<?php echo _NP_TEMPLATE_URL . '/assets/base/css/plugins.css' ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo _NP_TEMPLATE_URL . '/assets/base/css/components.css' ?>" id="style_components"
          rel="stylesheet" type="text/css"/>
    <link href="<?php echo _NP_TEMPLATE_URL . '/assets/base/css/themes/default.css' ?>" rel="stylesheet"
          id="style_theme" type="text/css"/>
    <link href="<?php echo _NP_TEMPLATE_URL . '/assets/base/css/custom.css' ?>" rel="stylesheet" type="text/css"/>
    <!-- END THEME STYLES -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <?php wp_head(); ?>

    <!--[if gte IE 9]>
    <style type="text/css">
        .gradient {
            filter: none;
        }
    </style>
    <![endif]-->
    <!--	--><?php //echo get_field( 'google_analytics', 'option' ); ?>

<body class="c-layout-header-6-topbar">
<!-- BEGIN: LAYOUT/HEADERS/HEADER-1 -->
<!-- BEGIN: HEADER -->
<header class="c-layout-header c-layout-header-4 c-layout-header-default-mobile" data-minimize-offset="80">
    <div class="c-navbar">
        <div class="container">
            <!-- BEGIN: BRAND -->
            <div class="c-navbar-wrapper clearfix">
                <div class="c-brand c-pull-left">
                    <a href="<?php echo home_url() ?>" class="c-logo">
                        <?php
                        $mainLogo = get_field('main_logo', 'option');
                        if ($mainLogo):
                            echo wp_get_attachment_image($mainLogo['id'], 'medium');
                        endif;
                        ?>
                    </a>

                    <button class="c-cart-toggler signin-rp" type="button">
                        <a href="javascript:;" data-toggle="modal" data-target="#login-form"
                           class="c-btn-border-opacity-04 c-btn btn-no-focus c-btn-header btn btn-sm c-btn-border-1x c-btn-dark c-btn-circle c-btn-uppercase c-btn-sbold">
                            <i class="icon-user"></i> Sign In</a>
                    </button>
                    <button class="c-hor-nav-toggler" type="button" data-target=".c-mega-menu">
                        <span class="c-line"></span>
                        <span class="c-line"></span>
                        <span class="c-line"></span>
                    </button>
                </div>
                <!-- END: BRAND -->
                <!-- BEGIN: QUICK SEARCH -->
                <!-- END: QUICK SEARCH -->
                <!-- BEGIN: HOR NAV -->
                <!-- BEGIN: LAYOUT/HEADERS/MEGA-MENU -->
                <!-- BEGIN: MEGA MENU -->
                <!-- Dropdown menu toggle on mobile: c-toggler class can be applied to the link arrow or link itself depending on toggle mode -->
                <div class="c-pull-right">
                    <div class="btn-sign-in">
                        <a href="javascript:;" data-toggle="modal" data-target="#login-form"
                           class="c-btn-border-opacity-04 c-btn btn-no-focus c-btn-header btn btn-sm c-btn-border-1x c-btn-dark c-btn-circle c-btn-uppercase c-btn-sbold">
                            <i class="icon-user"></i> Sign In</a>
                    </div>
                    <nav
                        class="c-mega-menu c-pull-right c-mega-menu-dark c-mega-menu-dark-mobile c-fonts-uppercase c-fonts-bold">
                        <ul class="nav navbar-nav c-theme-nav">
                            <li class="c-active">
                                <a href="<?php echo home_url() ?>" class="c-link dropdown-toggle">Home
                                </a>
                            </li>
                            <li class="c-menu-type-classic">
                                <a href="<?php echo site_url('/about') ?>" class="c-link dropdown-toggle">About
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('/contact-us') ?>" class="c-link dropdown-toggle">Contact
                                    Us
                                </a>
                                <!-- END: MOBILE VERSION OF THE TAB MEGA MENU -->
                            </li>

                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- END: HEADER -->

<!-- BEGIN: CONTENT/USER/FORGET-PASSWORD-FORM -->
<div class="modal fade c-content-login-form" id="forget-password-form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content c-square">
            <div class="modal-header c-no-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3 class="c-font-24 c-font-sbold">Password Recovery</h3>

                <p>To recover your password please fill in your email address</p>

                <form name="lostpasswordform" id="lostpasswordform"
                      action="<?php echo site_url('/wp-login.php?action=lostpassword') ?>" method="post">
                    <div class="form-group">
                        <label for="user_login" class="hide">Email</label>
                        <input name="user_login" type="email" class="form-control input-lg c-square" id="user_login"
                               placeholder="Email"></div>
                    <div class="form-group">
                        <button name="wp-submit" id="wp-submit" type="submit"
                                class="btn c-theme-btn btn-md c-btn-uppercase c-btn-bold c-btn-square c-btn-login">
                            Submit
                        </button>
                        <a href="javascript:;" class="c-btn-forgot" data-toggle="modal" data-target="#login-form"
                           data-dismiss="modal"><?php echo __('Go To Login', _NP_TEXT_DOMAIN) ?></a>
                    </div>
                </form>
            </div>
            <div class="modal-footer c-no-border">
                <span class="c-text-account">Don't Have An Account Yet ?</span>
                <a href="javascript:;" data-toggle="modal" data-target="#signup-form" data-dismiss="modal"
                   class="btn c-btn-dark-1 btn c-btn-uppercase c-btn-bold c-btn-slim c-btn-border-2x c-btn-square c-btn-signup">Signup!</a>
            </div>
        </div>
    </div>
</div>
<!-- END: CONTENT/USER/FORGET-PASSWORD-FORM -->
<!-- BEGIN: CONTENT/USER/SIGNUP-FORM -->
<div class="modal fade c-content-login-form" id="signup-form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content c-square">
            <div class="modal-header c-no-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3 class="c-font-24 c-font-sbold"><?php echo __('Create An Account', _NP_TEXT_DOMAIN) ?></h3>

                <p><?php echo __('Please fill in below form to create an account with us', _NP_TEXT_DOMAIN) ?></p>

                <div class="message-signup alert hidden"></div>
                <form name="signup" id="signup" method="post" class="signup">
                    <div class="form-group">
                        <label for="email" class="hide">Email *</label>
                        <input name="email" type="email" class="form-control input-lg c-square" id="email"
                               placeholder="Email *">
                    </div>
                    <div class="form-group">
                        <label for="signup-username"
                               class="hide"><?php echo __('Username *', _NP_TEXT_DOMAIN) ?></label>
                        <input name="username" type="text" class="form-control input-lg c-square username"
                               id="signup-username"
                               placeholder="<?php echo __('Username *', _NP_TEXT_DOMAIN) ?>">
                    </div>
                    <div class="form-group">
                        <label for="signup-fullname"
                               class="hide"><?php echo __('Fullname *', _NP_TEXT_DOMAIN) ?></label>
                        <input name="fullname" type="text" class="form-control input-lg c-square" id="signup-fullname"
                               placeholder="<?php echo __('Fullname *', _NP_TEXT_DOMAIN) ?>">
                    </div>
                    <div class="form-group">
                        <label for="signup-phone" class="hide"><?php echo __('Phone', _NP_TEXT_DOMAIN) ?></label>
                        <input name="phone" type="tel" class="form-control input-lg c-square" id="signup-phone"
                               placeholder="<?php echo __('Phone', _NP_TEXT_DOMAIN) ?>">
                    </div>
                    <div class="form-group">
                        <label for="password" class="hide"><?php echo __('Password *', _NP_TEXT_DOMAIN) ?></label>
                        <input name="password" type="password" minlength="6"
                               class="form-control input-lg c-square password" id="password"
                               placeholder="<?php echo __('Password *', _NP_TEXT_DOMAIN) ?>">
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword"
                               class="hide"><?php echo __('Confirm Password', _NP_TEXT_DOMAIN) ?></label>
                        <input name="confirmPassword" type="password"
                               class="form-control input-lg c-square confirmPassword" id="confirmPassword"
                               placeholder="<?php echo __('Confirm Password *', _NP_TEXT_DOMAIN) ?>">

                        <div id="message-confirm" class="message-confirm *"></div>
                    </div>
                    <div class="form-group">
                        <button type="submit"
                                class="btn c-theme-btn btn-md c-btn-uppercase c-btn-bold c-btn-square c-btn-login">
                            <?php echo __('Signup', _NP_TEXT_DOMAIN) ?>
                        </button>
                        <a href="javascript:;" class="c-btn-forgot" data-toggle="modal" data-target="#login-form"
                           data-dismiss="modal"><?php echo __('Go To Login', _NP_TEXT_DOMAIN) ?></a>

                    </div>
                </form>
            </div>
            <div class="modal-footer c-no-border">
                <span class="c-text-account"><?php echo __("Forgot password?", _NP_TEXT_DOMAIN)?></span>
                <a href="javascript:;" data-toggle="modal" data-target="#forget-password-form" data-dismiss="modal"
                   class="btn c-btn-dark-1 btn c-btn-uppercase c-btn-bold c-btn-slim c-btn-border-2x c-btn-square c-btn-signup"><?php echo __('Reset Password')?></a>
            </div>

        </div>
    </div>
</div>
<!-- END: CONTENT/USER/SIGNUP-FORM -->
<!-- BEGIN: CONTENT/USER/LOGIN-FORM -->
<div class="modal fade c-content-login-form" id="login-form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content c-square">
            <div class="modal-header c-no-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3 class="c-font-24 c-font-sbold"><?php echo __('Login', _NP_TEXT_DOMAIN)?></h3>

                <p>Let's make today a great day!</p>

                <form name="loginform" id="loginform" action="<?php echo site_url('/wp-login.php') ?>" method="post">
                    <div class="form-group">
                        <label for="user_login" class="hide">Email</label>
                        <input name="log" type="text" class="form-control input-lg c-square" id="user_login"
                               placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="user_pass" class="hide">Password</label>
                        <input name="pwd" type="password" class="form-control input-lg c-square" id="user_pass"
                               placeholder="Password"></div>
                    <div class="form-group">
                        <div class="c-checkbox">
                            <input name="rememberme" type="checkbox" id="rememberme" class="c-check" value="forever">
                            <label for="rememberme" class="c-font-thin c-font-17">
                                <span></span>
                                <span class="check"></span>
                                <span class="box"></span> Remember Me </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <button name="wp-submit" id="wp-submit" type="submit"
                                class="btn c-theme-btn btn-md c-btn-uppercase c-btn-bold c-btn-square c-btn-login">Login
                        </button>
                        <a href="javascript:;" data-toggle="modal" data-target="#forget-password-form"
                           data-dismiss="modal" class="c-btn-forgot">Forgot Your Password ?</a>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
            <div class="modal-footer c-no-border">
                <span class="c-text-account">Don't Have An Account Yet ?</span>
                <a href="javascript:;" data-toggle="modal" data-target="#signup-form" data-dismiss="modal"
                   class="btn c-btn-dark-1 btn c-btn-uppercase c-btn-bold c-btn-slim c-btn-border-2x c-btn-square c-btn-signup">Signup!</a>
            </div>
        </div>
    </div>
</div>
<!-- END: CONTENT/USER/LOGIN-FORM -->


