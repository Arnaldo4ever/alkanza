<?php
/**
 * Template Name: Template - Inicio
 */
?>


<!-- Get Page Header
================================================== -->
<?php get_header('nuevo'); ?>



<!-- Page Title Section
================================================== -->
<?php
	$string = get_the_title();
	$pieces = explode(' ', $string);
	$last_word = array_pop($pieces);

	$string = str_replace($last_word, "", $string);
?>


<!-- Page Blog Body Start
================================================== -->

<section class="new-line" id="blog-page">
	<div class="container">
		<div class="row">
			<!-- ============ START POSTS =========== -->
			<div class="col-md-12" id="primary">
				<div class="blog-item">
					<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
						<!-- Content
						================================================== -->
						<?php the_content(); ?>

						<!-- Blog Comments Section
						================================================== -->
						<?php if(comments_open($post->ID )){?>
						<div id="comment" class="comments">
								<?php comments_template('', true); ?>
						</div>
						<?php } ?>

					<?php endwhile; endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Get Page Footer
================================================== -->
<?php get_footer('nuevo'); ?>
