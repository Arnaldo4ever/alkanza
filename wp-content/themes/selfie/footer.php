<?php

?>
	<footer>
		<div class="selfie-footer-bottom">
			<div class="homepage-container-design-inner">
        <div class="vc_col-sm-6 selfie-copyrights item_left">
					<a href="#">Politicas de privaciadad</a> / <a href="#">From ADV P2art</a>
				</div>
				<div class="vc_col-sm-5 selfie-copyrights item_right">
				<?php if(selfie_get_option_value('select_copyrights_columns') == 'On') { ?>
					<?php
						$allowed_html = array(
							'a' => array(
								'href' => array(),
								'title' => array()
							),
							'br' => array(),
							'strong' => array(),
						);

						$footerText = wp_kses(selfie_get_option_value('footer_text'), $allowed_html);
					?>
					<?php echo $footerText; ?>
				<?php } ?>
				</div>
				<div class="vc_col-sm-1 selfie-copyrights item_left" style="border-left: 2px solid #999;">
				<a href="#"><i style="font-size: 22px;margin: 0px 5px;" class="fa fa-facebook-square" aria-hidden="true"></i></a>
				<a href="#"><i style="font-size: 22px;margin: 0px 5px;" class="fa fa-twitter" aria-hidden="true"></i></a>
				</div>

			</div>
		</div>
	</footer>

	<?php if(selfie_get_option_value('select_backtotop') == 'On') { ?>
		<a id="back-top" href="#" style="display: none;"><i class="fa fa-angle-up fa-2x"></i></a>
	<?php } ?>


	<!-- Footer End
	================================================== -->

<?php wp_footer(); ?>
</body>
<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "35%";
    document.getElementById("page-template").style.marginRight = "35%";
    document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("page-template").style.marginRight= "0";
    document.body.style.backgroundColor = "white";
}
</script>
</html>
