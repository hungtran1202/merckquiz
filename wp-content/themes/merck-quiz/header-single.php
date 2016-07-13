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

<body <?php body_class()?>>
<!-- BEGIN: LAYOUT/HEADERS/HEADER-1 -->
<!-- BEGIN: HEADER -->
<header class="c-layout-header c-layout-header-4 c-layout-header-default-mobile" data-minimize-offset="80">
    <div class="c-navbar">
        <div class="container">
            <!-- BEGIN: BRAND -->
            <div class="c-navbar-wrapper clearfix">
                <div class="header-single">
                    <div class="c-brand">
                        <a href="<?php echo home_url() ?>" class="c-logo">
                            <?php
                            $mainLogo = get_field('main_logo', 'option');
                            if ($mainLogo):
                                echo wp_get_attachment_image($mainLogo['id'], 'medium');
                            endif;
                            ?>
                        </a>
                        <div class="time-remaining">
                            <span><?php echo __('Time Remaining:')?></span>
                            <span class="remaining"></span>
                        </div>
                    </div>
                </div>
                <!-- END: BRAND -->
            </div>
        </div>
    </div>
</header>
<!-- END: HEADER -->




