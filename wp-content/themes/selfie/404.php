<?php
/**
 * 404 ( Not fount page )
 */
?>


<!-- Get Page Header
================================================== -->
<?php get_header(); ?>


<!-- Page Title Section
================================================== -->
<?php
	$string = selfie_get_option_value('blank_page_title');
	$pieces = explode(' ', $string);
	$last_word = array_pop($pieces);
	
	$string = str_replace($last_word, "", $string);	
?>

<div id="single" class="fullwidth-section bg-callout title-section">
	<div class="container selfie-header-container">
		<div class="col-md-12 item_bottom">
			<!-- Section title -->
			<div class="section-title item_bottom text-center">
				<span style="color:<?php echo selfie_get_option_value('top_title_icon_color'); ?>;" class="fa fa-unlink fa-2x"></span>
				<h1 style="color: <?php echo selfie_get_option_value('top_title_icon_color'); ?>;"><?php echo selfie_get_option_value('blank_page_title'); ?></h1>			
			</div>
			<!-- End Section title -->
		</div>
	</div>
</div>


<!-- 404 content Section -->
<section id="page" class="new-line selfie-found">
	<div class="container">
		<div class="row">
		   <div class="col-md-6 col-md-offset-3 text-center">
			<p class="selfie-not-found-text">404</p>
			<?php
				$allowed_html = array(
					'a' => array(
						'href' => array(),
						'title' => array()
					),
					'br' => array(),
					'strong' => array(),
				);			
			?>
			<p><?php echo wp_kses(selfie_get_option_value('blank_page_desc'), $allowed_html); ?></p>
			<p><a href="<?php  echo esc_url(home_url( '/' )) ; ?>"><i class="fa fa-home fa-3x"></i></a></p>
		   </div>
		</div>
	</div>
</section>
<!-- End 404 Content Section -->


<!-- Footer Section
================================================== -->
<?php get_footer(); ?>
