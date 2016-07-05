<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

</div><!-- .site-content -->

<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="container-home">
		<div class="row">
			<div class="col-lg-7">
				<div class="footer-menu">
					<nav  class="navbar-collapse ">
						<?php wp_nav_menu(
							array(
								'theme_location' => 'footer',
								'walker' => new Enpii\BoostStrapNavWalker\BoostStrapNavWalker,
								'menu_class' => 'menu nav navbar-nav'
							)
						); ?>
					</nav>
				</div>
			</div>
			<div class="col-lg-5">
				<div class="footer-text">
					<?php echo sprintf(get_field('footer_text','option'), date('Y'))?>
				</div>
			</div>
		</div>
	</div>
</footer><!-- .site-footer -->
</div><!-- .site-inner -->
</div><!-- .site -->

<?php wp_footer(); ?>
</body>
</html>
