<?php

?>
	<footer>
		<div class="selfie-footer-bottom">
			<div class="homepage-container-design-inner">
        <div class="vc_col-sm-6 selfie-footer-phone item_right">
					<?php echo esc_attr(selfie_get_option_value('footer_phone')); ?>
				</div>
				<div class="vc_col-sm-6 selfie-copyrights">
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
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("page-template").style.marginRight = "250px";
    document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("page-template").style.marginRight= "0";
    document.body.style.backgroundColor = "white";
}
</script>
</html>
