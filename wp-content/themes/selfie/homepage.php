<?php
/*
Template Name: Template - Homepage
*/
?>

<!-- Get Page Header
================================================== -->
<?php get_header(); ?>

<?php
	$string = get_the_title();
	$pieces = explode(' ', $string);
	$last_word = array_pop($pieces);
	
	$string = str_replace($last_word, "", $string);	
?>

<?php if(!is_home() && !is_front_page()) { ?>
<div id="single" class="fullwidth-section bg-callout title-section">
	<div class="container selfie-header-container">
		<div class="col-md-12 item_bottom">
			<!-- Section title -->
			<div class="section-title item_bottom text-center">
				<span style="color:<?php echo selfie_get_option_value('top_title_icon_color'); ?>;" class="fa fa-<?php echo esc_attr(get_post_meta(get_the_ID(), 'Icon', true)); ?> fa-2x"></span>
				<h1 style="color: <?php echo selfie_get_option_value('top_title_icon_color'); ?>;"><?php echo get_the_title(); ?></h1>			
			</div>
			<!-- End Section title -->
		</div>
	</div>
</div>
<?php } ?>



<!-- Page Begin
================================================== -->
<div class="main-container">
	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>				
	<div class="main-page-column-data main-page-column-data-full">
		<div class="get-column-container">			
			<div class="page-content">
				<?php the_content(); ?>			
			</div>				
		</div>
	</div>
	<?php endwhile; endif; ?>			
</div>


<!-- Get Page Header
================================================== -->
<?php get_footer(); ?>