<?php
/*
Template Name: Template - Blog Left Sidebar
*/
?>


<!-- Get Page Header
================================================== -->
<?php get_header(); ?>



<!-- Page Title Section
================================================== -->
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
				<span style="color:<?php echo selfie_get_option_value('top_title_icon_color'); ?>;" class="fa fa-<?php echo esc_attr(get_post_meta(get_the_ID(), 'Icon', true)); ?> fa-2x"></span>
				<h1 style="color: <?php echo selfie_get_option_value('top_title_icon_color'); ?>;"><?php echo get_the_title(); ?></h1>			
			</div>
			<!-- End Section title -->
		</div>
	</div>
</div>


<!-- Page Blog Body Start
================================================== -->		
	
<section class="new-line" id="blog-page">
	<div class="container">
		<div class="row">

			<!-- START SIDEBAR -->
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>				
				<div class="col-md-4 col-sm-4 selfie-sidebar" id="secondary">
					<?php get_sidebar(); ?>
				</div>
			<?php endwhile; endif; ?>	
			
			<!-- ============ START POSTS =========== -->
			<div class="col-md-8 col-sm-8" id="primary">
				<div class="blog-item">
					<?php
					$temp = $wp_query;
					$wp_query= null;
					$wp_query = new WP_Query();
					
					$wp_query->query('posts_per_page=4'.'&paged='.$paged);

					while ($wp_query->have_posts()) : $wp_query->the_post();
					?>
						<?php 
							if (has_post_format( 'gallery' ) && get_post_meta(get_the_ID(), 'Post Gallery', true) != '') { 
								$ThumbClass = 'flexslider';
							} elseif ( has_post_format( 'video' ) || has_post_format( 'audio' )){
								$ThumbClass = 'media-container';								
							}else{
								$ThumbClass = '';
							}
						?>
						<article <?php post_class(); ?>>
							<div class="post-thumb <?php echo esc_attr($ThumbClass); ?>">
								<!-- Standard Post Format
								================================================== -->							
								
								<?php
									if ( get_post_format() == false && has_post_thumbnail()) {									
								?>
									<?php the_post_thumbnail('full'); ?>
														
								<!-- Video Post Format
								================================================== -->								
								<?php
									} elseif ( has_post_format('video') && get_post_meta(get_the_ID(), 'Post Video URL', true) != '') {
								?>
										<embed SRC=<?php echo esc_url(get_post_meta(get_the_ID(), 'Post Video URL', true)); ?> width="100%" height="400px" AUTOPLAY=false ></embed>

								<!-- Gallery Post Format
								================================================== -->							
								<?php
									}elseif ( has_post_format('gallery') && get_post_meta(get_the_ID(), 'Post Gallery', true)!= '') { ?>
										<ul class="slides">
										<?php
											$galleryids = explode(",", get_post_meta(get_the_ID(), 'Post Gallery', true));
											$idscount = count($galleryids);
											for ($x=0; $x < $idscount; $x++)
											{	
												$getimageurlarray = wp_get_attachment_image_src( $galleryids[$x] , 'full');
												
												$alt = get_post_meta($galleryids[$x], '_wp_attachment_image_alt', true);
												
												echo '<li>   
																	<a href="'. esc_url(get_permalink()) .'"><img class="img-center img-responsive" src="' . esc_url($getimageurlarray[0]) . '" alt="' . esc_attr($alt) . '"/></a>
															</li>';
											} 
										?>
										</ul>
										
								<!-- Audio Post Format
								================================================== -->								
								<?php
								}elseif ( has_post_format( 'audio' ) && get_post_meta(get_the_ID(), 'Post Audio Shortcode', true)!= '') { ?>							
									<?php the_post_thumbnail('full'); ?>									
								
								<!-- ELSE
								================================================== -->									
								<?php } else { ?>					
									<?php the_post_thumbnail('full'); ?>
								<?php } ?>
							</div>							
							<div class="selfie-blog-article">
								<h3 class="post-title"><a href="<?php echo esc_url(the_permalink()); ?>"><?php the_title(); ?></a></h3>
								<h4>
									<?php  esc_html_e("By " , "selfie");  the_author_meta( 'display_name' ); echo ' | '; echo get_the_time('M') . ' ' . get_the_time('j') . ', ' . get_the_time('Y'); ?>
								</h4>
								<div class="post-excerpt clearfix">
								<p><?php echo strip_shortcodes(wp_trim_words( get_the_content(), 50 )); ?></p>
								<div class="selfie-blog-article-link">
									<a class="btn btn-default" href="<?php echo esc_url(the_permalink()); ?>"><i class="fa fa-link"></i><?php esc_html_e("Read More" , "selfie"); ?></a>
								</div>
								<div class="post-meta">
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
							</div>
							</div>
						</article>
					<?php endwhile; ?>		
						
					<!-- Pagination Begin
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
					
					<?php $wp_query = null; $wp_query = $temp;?>
					
				</div>
			</div>
		</div>
	</div>
</section>


<!-- Page Blog Full Body End
================================================== -->



<!-- Get Page Footer
================================================== -->
<?php get_footer(); ?>