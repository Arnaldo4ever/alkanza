<?php
/*
Archives Page
*/
?>

<!-- Get Page Header
================================================== -->	
<?php get_header(); ?>

<?php
	$all = esc_html__(' Comments', "selfie");
	$one = esc_html__(' Comment', "selfie");
	$displayedCat = '';
	
	$string = get_the_title();
	$pieces = explode(' ', $string);
	$last_word = array_pop($pieces);
	
	$string = str_replace($last_word, "", $string);	
?>
<div id="single" class="fullwidth-section bg-callout title-section">
	<div class="container selfie-header-container">
		<div class="col-md-12 item_bottom">
			<!-- Section title -->
			<div class="section-title item_bottom text-center">
				<span style="color:<?php echo selfie_get_option_value('top_title_icon_color'); ?>;" class="fa fa-folder-open-o fa-2x"></span>
				<h1 style="color: <?php echo selfie_get_option_value('top_title_icon_color'); ?>;"><?php esc_html_e("Archive" , "selfie"); ?></h1>			
			</div>
			<!-- End Section title -->
		</div>
	</div>
</div>



<!-- Page Search Body Start
================================================== -->		
	
<section class="new-line new-line-archive" id="blog-page">
	<div class="container">
		<div class="row">
			<!-- ============ START CONTENT =========== -->
			<div class="col-md-8 col-sm-8" id="primary">
				<div class="blog-item" role="main">
					<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
						<article <?php post_class('post'); ?>>
							<h3 class="post-title"><a href="<?php echo esc_url(the_permalink()); ?>"><?php the_title(); ?></a></h3>
							<div class="post-meta">
								<span class="author"><i class="fa fa-user"></i><?php the_author_meta( 'display_name' ); ?></span>
								<span class="time"><i class="fa fa-clock-o"></i><?php echo get_the_time('M') . ' ' . get_the_time('j') . ', ' . get_the_time('Y'); ?></span>
								<span class="category"><i class="fa fa-folder"></i>
									<?php 
										$categories = get_the_category(get_the_ID());
										$output = '';
										foreach ( $categories as $category ) {
											$output .= '<a href="' . esc_url(get_category_link( $category->term_id )) . '" >' . $category->name . '</a>' . ', ';
										}
										
										$displayedCat = trim($output, ', ');
										
										 echo wp_kses( $displayedCat, array(
												'a' => array(
													'href' => array(),
													'class' => array()									
												)
											) );

									?>								
								
								</span>
								<span class="comment pull-right"><i class="fa fa-comment"></i><?php comments_number( '0 ' . $all, '1 ' . $one, '% ' . $all); ?></span>
							</div>
							<div class="post-excerpt clearfix">
								<p><?php echo strip_shortcodes(wp_trim_words( get_the_content(), 60 )); ?></p>
								<a class="btn btn-default pull-left" href="<?php echo esc_url(the_permalink()); ?>"><?php esc_html_e("Read More" , "selfie"); ?></a>
							</div>							
						</article>					
					<?php endwhile; endif; ?>					
				</div>
				
				<!-- Pagination Started
				================================================== -->						
				<div class="pagination">
					<div class="pages">
						<?php
							global $wp_query;

							$big = 999999999;

							$allowed_html = array(
								'i' => array(
									'class' => array()
								)
							);							

							echo paginate_links( array(
								'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
								'format' => '?paged=%#%',
								'current' => max( 1, get_query_var('paged') ),
								'total' => $wp_query->max_num_pages,														
								'prev_text'    => wp_kses( __( '<i class="fa fa-chevron-left"></i> Previous', 'selfie' ), $allowed_html ),
								'next_text'    => wp_kses( __( 'Next <i class="fa fa-chevron-right"></i>', 'selfie' ), $allowed_html )					
							) );
						?>
					</div>
				</div>
				<!-- Pagination End
				================================================== -->					
			</div>
			
			<!-- Sidebar
			================================================== -->				
			<div class="col-md-4 col-sm-4 selfie-sidebar" id="secondary">
				<?php get_sidebar(); ?>
			</div>				
		</div>
	</div>
</section>


<!-- Footer
================================================== -->	
<?php get_footer(); ?>