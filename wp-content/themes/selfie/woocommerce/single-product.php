<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header( 'shop' ); ?>

	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		
		/*do_action( 'woocommerce_before_main_content' );*/
	global $product;

	?>
	
	<!-- Page Title Section
	================================================== -->
	<div id="single" class="fullwidth-section bg-callout title-section">
		<div class="container selfie-header-container">
			<div class="col-md-12 item_bottom">
				<!-- Section title -->
				<div class="section-title item_bottom text-center">
					<span style="color:<?php echo selfie_get_option_value('top_title_icon_color'); ?>;" class="fa fa-shopping-cart fa-2x"></span>
					<h1 style="color: <?php echo selfie_get_option_value('top_title_icon_color'); ?>;"><?php echo get_the_title(); ?></h1>			
				</div>
				<!-- End Section title -->
			</div>
		</div>
	</div>	

	<!-- product -->
	<div class="section shop">
		<div class="container">
			<?php while ( have_posts() ) : the_post(); ?>

				<?php wc_get_template_part( 'content', 'single-product' ); ?>

			<?php endwhile; // end of the loop. ?>
			<hr class="">
			<?php
			$sentinet_related = $product->get_related( '4' );
			if( sizeof( $sentinet_related ) == 0 ){
				/*Do Nothing*/
			} else { ?>
				<div class="sentient-portfolio-related-items-main-container">
					<div class="sentient-portfolio-related-items-main-container-internal">
						<div class="section-title  text-center">
							<span class="identity-related-product-icon fa fa-gift fa-2x"></span>
							<h1 class="identity-related-product-heading"><?php _e("Related Products" , "selfie"); ?></h1>
						</div>														
						<?php  woocommerce_output_related_products(); ?>
					</div>
				</div>				
			<?php }	?>				
		</div>
	</div>
	

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

	<?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		
		/*Removed by Sentient*/
		/*do_action( 'woocommerce_sidebar' );*/
	?>

<?php get_footer( 'shop' ); ?>