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
<!--	<link-->
<!--		href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic'-->
<!--		rel='stylesheet' type='text/css'>-->
<!--	<link href='https://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>-->
<!--	<link href='https://fonts.googleapis.com/css?family=Raleway:400,700,600,500,800,300' rel='stylesheet'-->
<!--		  type='text/css'>-->
<!--	<link-->
<!--		href='//fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic&subset=latin,latin-ext'-->
<!--		rel='stylesheet' type='text/css'>-->
	<!--	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>-->
	<?php wp_head(); ?>

	<!--[if gte IE 9]>
	<style type="text/css">
		.gradient {
			filter: none;
		}
	</style>
	<![endif]-->
	<!--	--><?php //echo get_field( 'google_analytics', 'option' ); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<div class="site-inner">
		<header id="masthead" class="site-header" role="banner">
			<span class="wrapper-yellow"></span>

			<div class="container">
				<div class="pull-left">
					<div class="main-logo">
						<a href="<?php echo home_url() ?>">
							<?php echo wp_get_attachment_image(get_field('main_logo', 'option'), 'medium') ?>
						</a>
					</div>
				</div>
				<div class="pull-right">
					<div class="main-navigation">
						<div class="">
							<div class="navbar navbar-default">
								<div class="navbar-header">
									<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
											data-target="#site-navigation" aria-expanded="false"
											aria-controls="site-navigation">
										<span class="sr-only">Toggle navigation</span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</button>
								</div>
								<nav id="site-navigation" class="navbar-collapse collapse" role="navigation">
									<?php wp_nav_menu(
										array(
											'theme_location' => 'primary',
											'walker' => new Enpii\BoostStrapNavWalker\BoostStrapNavWalker,
											'menu_class' => 'menu nav navbar-nav'
										)
									); ?>
								</nav>
							</div>
						</div>
					</div>
					<form class="search-form" action="<?php echo get_home_url() ?>" method="Get">
						<div class="search-form--inner">
							<?php
							$s = isset($_REQUEST['s']) ? $_REQUEST['s'] : '';
							?>
							<input type="text" value="<?php echo $s ?>" name="s"
								   placeholder="<?php echo __('Search...', _NP_TEXT_DOMAIN) ?>"/>
							<span class="btn glyphicon glyphicon-search" aria-hidden="true"></span>
						</div>
					</form>
					<div class="clerfix"></div>
				</div>
			</div>
			<!-- .header-top -->

		</header>
		<!-- .site-header -->

		<div id="content" class="site-content">
