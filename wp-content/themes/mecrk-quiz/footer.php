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
<footer class="c-layout-footer c-layout-footer-3 c-bg-dark">		
	<div class="c-postfooter">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-12 c-col">
					<p class="c-copyright c-font-grey">2016 &copy; Mecrk Quiz.
						<span class="c-font-grey-3">All Rights Reserved.</span>
					</p>
				</div>
			</div>
		</div>
	</div>
</footer>
<!-- END: LAYOUT/FOOTERS/FOOTER-5 -->
<!-- BEGIN: LAYOUT/FOOTERS/GO2TOP -->
<div class="c-layout-go2top">
	<i class="icon-arrow-up"></i>
</div>
<!-- END: LAYOUT/FOOTERS/GO2TOP -->
<!-- BEGIN: LAYOUT/BASE/BOTTOM -->
<!-- BEGIN: CORE PLUGINS -->
<!--[if lt IE 9]>-->
<!--<script src="--><?php //echo _NP_TEMPLATE_URL.'/assets/global/plugins/excanvas.min.js'?><!--"></script>-->
<!-- <![endif]-->
<script src="<?php echo _NP_TEMPLATE_URL.'/assets/plugins/jquery.min.js'?>" type="text/javascript"></script>
<script src="<?php echo _NP_TEMPLATE_URL.'/assets/plugins/jquery-migrate.min.js'?>" type="text/javascript"></script>
<script src="<?php echo _NP_TEMPLATE_URL.'/assets/plugins/bootstrap/js/bootstrap.min.js'?>" type="text/javascript"></script>
<script src="<?php echo _NP_TEMPLATE_URL.'/assets/plugins/jquery.easing.min.js'?>" type="text/javascript"></script>
<script src="<?php echo _NP_TEMPLATE_URL.'/assets/plugins/reveal-animate/wow.js'?>" type="text/javascript"></script>
<script src="<?php echo _NP_TEMPLATE_URL.'/assets/base/js/scripts/reveal-animate/reveal-animate.js'?>" type="text/javascript"></script>
<!-- END: CORE PLUGINS -->
<!-- BEGIN: LAYOUT PLUGINS -->
<script src="<?php echo _NP_TEMPLATE_URL.'/assets/plugins/revo-slider/js/jquery.themepunch.tools.min.js'?>" type="text/javascript"></script>
<script src="<?php echo _NP_TEMPLATE_URL.'/assets/plugins/revo-slider/js/jquery.themepunch.revolution.min.js'?>" type="text/javascript"></script>
<script src="<?php echo _NP_TEMPLATE_URL.'/assets/plugins/revo-slider/js/extensions/revolution.extension.slideanims.min.js'?>" type="text/javascript"></script>
<script src="<?php echo _NP_TEMPLATE_URL.'/assets/plugins/revo-slider/js/extensions/revolution.extension.layeranimation.min.js'?>" type="text/javascript"></script>
<script src="<?php echo _NP_TEMPLATE_URL.'/assets/plugins/revo-slider/js/extensions/revolution.extension.navigation.min.js'?>" type="text/javascript"></script>
<script src="<?php echo _NP_TEMPLATE_URL.'/assets/plugins/revo-slider/js/extensions/revolution.extension.video.min.js'?>" type="text/javascript"></script>
<script src="<?php echo _NP_TEMPLATE_URL.'/assets/plugins/cubeportfolio/js/jquery.cubeportfolio.min.js'?>" type="text/javascript"></script>
<script src="<?php echo _NP_TEMPLATE_URL.'/assets/plugins/owl-carousel/owl.carousel.min.js'?>" type="text/javascript"></script>
<script src="<?php echo _NP_TEMPLATE_URL.'/assets/plugins/counterup/jquery.waypoints.min.js'?>" type="text/javascript"></script>
<script src="<?php echo _NP_TEMPLATE_URL.'/assets/plugins/counterup/jquery.counterup.min.js'?>" type="text/javascript"></script>
<script src="<?php echo _NP_TEMPLATE_URL.'/assets/plugins/fancybox/jquery.fancybox.pack.js'?>" type="text/javascript"></script>
<script src="<?php echo _NP_TEMPLATE_URL.'/assets/plugins/slider-for-bootstrap/js/bootstrap-slider.js'?>" type="text/javascript"></script>
<!-- END: LAYOUT PLUGINS -->
<!-- BEGIN: THEME SCRIPTS -->
<script src="<?php echo _NP_TEMPLATE_URL.'/assets/base/js/components.js'?>" type="text/javascript"></script>
<script src="<?php echo _NP_TEMPLATE_URL.'/assets/base/js/components-shop.js'?>" type="text/javascript"></script>
<script src="<?php echo _NP_TEMPLATE_URL.'/assets/base/js/app.js" type="text/javascript'?>"></script>
<script>
	$(document).ready(function()
	{
		App.init(); // init core
	});
</script>
<!-- END: THEME SCRIPTS -->
<!-- END: LAYOUT/BASE/BOTTOM -->
<?php wp_footer()?>
</body>

</html>
