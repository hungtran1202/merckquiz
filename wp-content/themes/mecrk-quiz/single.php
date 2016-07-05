<?php
/**
 * Created by PhpStorm.
 * User: hungtran
 * Date: 4/1/16
 * Time: 3:15 PM
 */
get_header();
$urlImg= wp_get_attachment_url(get_field('banner_image',11));
?>
<div class="page-about">
	<div class="banner" style="background: url(<?php echo $urlImg?>) no-repeat center; background-size: cover">
		<table>
			<tr>
				<td>
					<div class="container">
						<div class="title"><?php echo get_field('title', 11)?></div>
					</div>
				</td>
			</tr>
		</table>
	</div>
	<div class="breadcrumbs" typeof="BreadcrumbList">
		<div class="container">
			<?php if (function_exists('bcn_display')) {
				echo str_replace('United', __('Home', _NP_TEXT_DOMAIN), bcn_display(true));
			} ?>
		</div>
	</div>
	<div class="wrapper-content">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<div class="sidebar">
						<div class="menu-sidebar">
							<nav  class=" ">
								<?php wp_nav_menu(
									array(
										'theme_location' => 'sidebar-service',
										'walker' => new Enpii\BoostStrapNavWalker\BoostStrapNavWalker,
										'menu_class' => 'menu nav-sidebar'
									)
								); ?>
							</nav>
						</div>
					</div>
				</div>
				<div class="col-md-9">
					<div class="title"><?php echo get_the_title()?></div>
					<div class="content-main">
						<?php echo get_the_content()?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php get_footer()?>
