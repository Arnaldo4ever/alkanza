<?php

if ( ! defined( 'ABSPATH' ) ) exit; /* Exit if accessed directly*/

get_header(); ?>

<?php
	$echo = '';
	$string = woocommerce_page_title( $echo );
	$pieces = explode(' ', $string);
	$last_word = array_pop($pieces);
	
?>

<!-- Page Title Section
================================================== -->
<div id="single" class="fullwidth-section bg-callout title-section">
	<div class="container selfie-header-container">
		<div class="col-md-12 item_bottom">
			<!-- Section title -->
			<div class="section-title item_bottom text-center">
				<span style="color:<?php echo selfie_get_option_value('top_title_icon_color'); ?>;" class="fa fa-shopping-cart fa-2x"></span>
				<h1 style="color: <?php echo selfie_get_option_value('top_title_icon_color'); ?>;"><?php echo esc_attr($string); ?></h1>			
			</div>
			<!-- End Section title -->
		</div>
	</div>
</div>



<!-- WooCommerce Filter Section
================================================== -->	
<div class="filter-options">
	<div class="container filters">
		<?php woocommerce_result_count(); ?>
		<?php woocommerce_catalog_ordering(); ?>
	</div>
</div>


<!-- WooCommerce Check Layout if Full/With Sidebar
================================================== -->	
<?php
	$sidebarClass = '';
	$colClass = 'col-lg-12';
	
?>


<!-- WooCommerce Shop Page - Started
================================================== -->	
<div class="section shop <?php echo esc_attr($sidebarClass); ?>">
	<div class="container">
		<div class="row">
			<div class="<?php echo esc_attr($colClass); ?>">
				<?php
					/**
					 * woocommerce_before_main_content hook
					 *
					 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
					 * @hooked woocommerce_breadcrumb - 20
					 */
					 
					/*do_action( 'woocommerce_before_main_content' );*/
				?>

				<?php if ( have_posts() ) : ?>
					<?php
						/**
						 * woocommerce_before_shop_loop hook
						 *
						 * @hooked woocommerce_result_count - 20
						 * @hooked woocommerce_catalog_ordering - 30
						 */
						/*do_action( 'woocommerce_before_shop_loop' );*/
					?>
					<?php woocommerce_product_loop_start(); ?>

						<?php woocommerce_product_subcategories(); ?>

						<?php while ( have_posts() ) : the_post(); ?>

							<?php wc_get_template_part( 'content', 'product' ); ?>

						<?php endwhile; // end of the loop. ?>

					<?php woocommerce_product_loop_end(); ?>
					<?php
						/**
						 * woocommerce_after_shop_loop hook
						 *
						 * @hooked woocommerce_pagination - 10
						 */
						/*do_action( 'woocommerce_after_shop_loop' );*/
					?>
					<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

						<?php wc_get_template( 'loop/no-products-found.php' ); ?>

					<?php endif; ?>					
					<?php
						global $wp_query;
						$sentient_pagination = '';
						$sentient_page_text = __("Page","selfie");
						$sentient_of_text = __("of","selfie");
						$total = $wp_query->max_num_pages;
						

						if ( $total > 1 ) {
							if ( !$current_page = get_query_var('paged') ){$current_page = 1;}
							$sentient_pagination = '<span class="number-of-pages hidden-xs">' . esc_attr($sentient_page_text) . ' ' . esc_attr($current_page) . ' ' . esc_attr($sentient_of_text) . ' ' . esc_attr($total) . '</span>';
						} else {
							$sentient_pagination = '';
						}
						
						echo $sentient_pagination;
						
						woocommerce_pagination();
					?>	
			</div>
		</div>
	</div>
</div>


<!-- WooCommerce Shop Page Footer
================================================== -->	
<?php get_footer(); ?>
