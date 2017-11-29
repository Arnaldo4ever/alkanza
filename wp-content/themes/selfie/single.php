<!-- Single Page Started
================================================== -->	


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
	
	if ( has_post_format( 'video' )) {
		$iconString = 'film';
	} elseif( has_post_format( 'gallery' )){
		$iconString = 'picture-o';
	} elseif( has_post_format( 'audio' )){
		$iconString = 'music';
	}elseif('portfolio' == get_post_type()){
		$iconString = 'camera';
	}else{
		$iconString = 'book';
	}

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



<!-- Single Portfolio Template Started
================================================== -->	
<?php if ('team' == get_post_type()){ ?>
<section id="project-section" class="team-section">
	<div class="container">
		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>		
		<div class="row">
		
		<?php 
			$firstContainer = 'col-md-4';
			$secondContainer = 'col-md-6';
		?>
			<!-- Thumbnail Started
			================================================== -->			
			<div class="<?php echo esc_attr($firstContainer);?>">
				<div class="project-cover">
					<?php the_post_thumbnail( 'full' ); ?>
				</div>
			</div>
			
			<!-- Content Started
			================================================== -->				
			<div class="<?php echo esc_attr($secondContainer);?>">
				<div class="project-desc">
                  <h3><?php the_title(); ?></h3>
                  <div class="line-strong"></div>
                  <ul class="list-details">
                    <li><i class="fa fa-calendar"></i><?php echo ' ' . get_the_time('j') . ' ' . get_the_time('M') . ' ' . get_the_time('Y'); ?></li>
					<?php 
						if(has_tag()){ 								
							$identityTag = '';
							$identitytags = get_the_tags();
							if ($identitytags) {
							  foreach($identitytags as $tag) {	  
								$identityTag .= '' . $tag->name . ', ';
							  }
							}

							$identityTag = '<li><i class="fa fa-tag"></i>' . trim($identityTag, ', ') . '</li>';
							
							 echo wp_kses( $identityTag, array(
									'li' => array(
										'class' => array()
									),
									'i' => array(
										'class' => array()
									)
								) );									
						}
					?>

                  </ul>
				  
                  <p><?php the_content(); ?></p>
				
				</div>			
			</div>
		</div>	
		
		<?php endwhile; ?>
		<?php endif; ?>		
	</div>
</section>

<?php }elseif ('portfolio' == get_post_type()){ ?>

<section id="project-section" class="project-section">
	<div class="container">
	
		<!-- Portfolio Controls
		================================================== -->				
		<div class="identity-portfolio-control">		
			<?php previous_post_link('%link', '<i class="fa fa-arrow-left"></i>'); ?>					
			<a href="<?php  echo esc_url(selfie_get_option_value('portfolio_url_option')); ?>"><i class="fa fa-square-o"></i></a>			
			<?php next_post_link('%link' , '<i class="fa fa-arrow-right"></i>'); ?>
		</div>
	
	
		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>		
		<div class="row">
		
		<?php
			$firstContainer = 'col-md-12';
			$secondContainer = 'col-md-12';
		?>
			<!-- Thumbnail Started
			================================================== -->			
			<div class="<?php echo esc_attr($firstContainer); ?>">
				<div class="project-cover">
					<?php if ( has_post_format( 'gallery' ) && get_post_meta(get_the_ID(), 'Post Gallery', true) != ''){ ?>
					
						<div class="flexslider">
							<ul class="slides">
							<?php
								$galleryids = explode(",", get_post_meta(get_the_ID(), 'Post Gallery', true));
								$idscount = count($galleryids);
								for ($x=0; $x < $idscount; $x++)
								{	
									$getimageurlarray = wp_get_attachment_image_src( $galleryids[$x] , 'full');
									
									$alt = get_post_meta($galleryids[$x], '_wp_attachment_image_alt', true);
									
									echo '<li>   
														<a href="' . esc_url($getimageurlarray[0]) . '"><img class="img-center img-responsive" src="' . esc_url($getimageurlarray[0]) . '" alt="' . esc_attr($alt) . '"/></a>
												</li>';
								} 
							?>
							</ul>
						</div>
					<?php } elseif ( has_post_format( 'video' ) && get_post_meta(get_the_ID(), 'Post Video URL', true) != ''){ ?>
							<div class="media-container">
								<embed SRC=<?php echo esc_url(get_post_meta(get_the_ID(), 'Post Video URL', true)); ?> width="100%" height="450px" AUTOPLAY=false ></embed>							
							</div>	
					<?php } elseif ( has_post_format( 'audio' ) && get_post_meta(get_the_ID(), 'Post Audio Shortcode', true) != ''){ ?>
							<?php echo do_shortcode(get_post_meta(get_the_ID(), 'Post Audio Shortcode', true)); ?>
					<?php } else { ?>							
						<?php the_post_thumbnail( 'full' ); ?>
					<?php } ?>

				</div>
			</div>
			
			<!-- Content Started
			================================================== -->				
			<div class="<?php echo esc_attr($secondContainer); ?>">
				<div class="project-desc">
                  <h3 class="post-title"><?php the_title(); ?></h3>
					<div class="post-meta">
						<span class="time"><i class="fa fa-clock-o"></i><?php echo get_the_time('M') . ' ' . get_the_time('j') . ', ' . get_the_time('Y'); ?></span>
						<?php if(get_post_meta(get_the_ID(), 'Project URL', true) != '') { ?>
							<span class="comment pull-right"><i class="fa fa-globe"></i> <a href="<?php echo esc_url(get_post_meta(get_the_ID(), 'Project URL', true)); ?>"><?php esc_html_e("LIVE DEMO" , "selfie"); ?></a></span>
						<?php } ?>
						<?php if(get_post_meta(get_the_ID(), 'Project Client', true) != '') { ?>
							<span class="category pull-right"><i class="fa fa-user"></i> <?php get_post_meta(get_the_ID(), 'Project Client', true); ?></span>
						<?php } ?>																					
					</div>				  
                 
				  
                  <p><?php the_content(); ?></p>

					<?php
						if(get_post_meta(get_the_ID(), 'Flickr URL', true) != ''){
							$sentient_flickr = '<div class="social-icon">
													<a href="'. esc_url(get_post_meta(get_the_ID(), 'Flickr URL', true)) .'"><i class="fa fa-flickr fa-3x"></i></a>
												</div>';
						}else{$sentient_flickr = '';}

						if(get_post_meta(get_the_ID(), 'LinkedIn URL', true) != ''){				
							$sentient_linkedin = '<div class="social-icon">
													<a href="'. esc_url(get_post_meta(get_the_ID(), 'LinkedIn URL', true)) .'"><i class="fa fa-linkedin fa-3x"></i></a>
												</div>';
						} else {
							$sentient_linkedin = '';
						}

						if(get_post_meta(get_the_ID(), 'Pinterest URL', true) != ''){				
							$sentient_pinterest = '<div class="social-icon">
													<a href="'. esc_url(get_post_meta(get_the_ID(), 'Pinterest URL', true)) .'"><i class="fa fa-pinterest fa-3x"></i></a>
												</div>';
						} else {
							$sentient_pinterest = '';
						}
						
						if(get_post_meta(get_the_ID(), 'Twitter URL', true) != ''){				
							$sentient_twitter = '<div class="social-icon">
													<a href="'. esc_url(get_post_meta(get_the_ID(), 'Twitter URL', true)) .'"><i class="fa fa-twitter fa-3x"></i></a>
												</div>';
						} else {
							$sentient_twitter = '';
						}												
					
						if(get_post_meta(get_the_ID(), 'Facebook URL', true) != ''){				
							$sentient_facebook = '<div class="social-icon">
													<a href="'. esc_url(get_post_meta(get_the_ID(), 'Facebook URL', true)) .'"><i class="fa fa-facebook fa-3x"></i></a>
												</div>';
						} else {
							$sentient_facebook = '';
						}												

						if(get_post_meta(get_the_ID(), 'Google URL', true) != ''){		
							$sentient_google = '<div class="social-icon">
													<a href="'. esc_url(get_post_meta(get_the_ID(), 'Google URL', true)) .'"><i class="fa fa-google-plus fa-3x"></i></a>
												</div>';
						} else {
							$sentient_google = '';
						}	
					
					?>				

					<!-- Display Post Social
					================================================== -->					
					<?php 
					$allSocials='';
					if($sentient_flickr == '' && $sentient_linkedin == '' && $sentient_google == '' && $sentient_pinterest == '' && $sentient_twitter == '' && $sentient_facebook == '') { 
						/* Nothing to Display */
					} else {?>
						<?php 
							$allSocials = $sentient_facebook . $sentient_twitter . $sentient_pinterest . $sentient_google . $sentient_linkedin . $sentient_flickr;
						
							echo '<div class="post-meta">' . wp_kses( $allSocials, array(
								'div' => array(
									'class' => array()									
								),
								'a' => array(
									'href' => array()									
								),
								'i' => array(
									'class' => array()									
								)									
							) ) . '</div>';
						
							
							
						?>								
					<?php } ?>					
				</div>			
			</div>
		</div>

		
		<!-- Blog Author Section
		================================================== -->					
		<?php if(selfie_get_option_value('portfolio_author_option')  == 'On'){ ?>
			<div class="post-author clearfix portfolio-author">
				<h3><?php esc_html_e("About the Author" , "selfie"); ?></h3>
				<div class="pull-left">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?>
				</div>									
				<p>
					<?php the_author_meta('description'); ?>
				</p>
			</div>																							
		<?php } ?>							
		
		
		<!-- Comments Section
		================================================== -->					
		<?php if(comments_open($post->ID )){?> 
		<div id="comment" class="comments">
			<?php comments_template('', true); ?>
		</div>											
		<?php } ?>		
		
		<?php endwhile; ?>
		<?php endif; ?>			
	</div>
</section>

<!-- Single Portfolio Template End
================================================== -->	



<!-- Single Post Template Started
================================================== -->	
<?php } else { ?>

	<!-- Page Single Body Start
	================================================== -->		
	<section class="new-line" id="blog-page">
		<div class="container">
			<div class="row">
				<!-- ============ START POST =========== -->
				<div class="col-md-8 col-sm-8" id="primary">
					<!-- Loop Started
					================================================== -->		
					<?php if(have_posts()) : while(have_posts()) : the_post(); ?>				
						<?php 
							if (has_post_format( 'gallery' ) && get_post_meta(get_the_ID(), 'Post Gallery', true) != '') { 
								$ThumbClass = 'flexslider';
							} elseif ( has_post_format( 'video' ) || has_post_format( 'audio' )){
								$ThumbClass = 'media-container';								
							}else{
								$ThumbClass = '';
							}
						?>					
						<div class="single-blog">	
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
																		<a href="' . esc_url($getimageurlarray[0]) . '"><img class="img-center img-responsive" src="' . esc_url($getimageurlarray[0]) . '" alt="' . esc_attr($alt) . '"/></a>
																</li>';
												} 
											?>
											</ul>
											
									<!-- Audio Post Format
									================================================== -->								
									<?php
									}elseif ( has_post_format( 'audio' ) && get_post_meta(get_the_ID(), 'Post Audio Shortcode', true)!= '') { ?>							
										<?php echo do_shortcode(get_post_meta(get_the_ID(), 'Post Audio Shortcode', true)) ;  ?>									
									
									<!-- ELSE
									================================================== -->									
									<?php } else { ?>					
										<?php the_post_thumbnail('full'); ?>
									<?php } ?>								
								</div>
								
								<h3 class="post-title"><a href="<?php echo esc_url(the_permalink()); ?>"><?php the_title(); ?></a></h3>
								
								<div class="post-meta">
									<span class="time"><i class="fa fa-clock-o"></i><?php echo get_the_time('M') . ' ' . get_the_time('j') . ', ' . get_the_time('Y'); ?></span>
									<span class="comment pull-right"><i class="fa fa-comment"></i><?php comments_number( '0 ' . $all, '1 ' . $one, '% ' . $all); ?></span>
									<span class="category pull-right"><i class="fa fa-folder"></i>
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
									<span class="author pull-right"><i class="fa fa-user"></i><?php the_author_meta( 'display_name' ); ?></span>
								</div>

								<div class="post-excerpt clearfix">
									<p><?php the_content(); ?></p>
								</div>


								<?php
									if(get_post_meta(get_the_ID(), 'Flickr URL', true) != ''){
										$sentient_flickr = '<div class="social-icon">
																<a href="'. esc_url(get_post_meta(get_the_ID(), 'Flickr URL', true)) .'"><i class="fa fa-flickr fa-3x"></i></a>
															</div>';
									}else{$sentient_flickr = '';}

									if(get_post_meta(get_the_ID(), 'LinkedIn URL', true) != ''){				
										$sentient_linkedin = '<div class="social-icon">
																<a href="'. esc_url(get_post_meta(get_the_ID(), 'LinkedIn URL', true)) .'"><i class="fa fa-linkedin fa-3x"></i></a>
															</div>';
									} else {
										$sentient_linkedin = '';
									}

									if(get_post_meta(get_the_ID(), 'Pinterest URL', true) != ''){				
										$sentient_pinterest = '<div class="social-icon">
																<a href="'. esc_url(get_post_meta(get_the_ID(), 'Pinterest URL', true)) .'"><i class="fa fa-pinterest fa-3x"></i></a>
															</div>';
									} else {
										$sentient_pinterest = '';
									}
									
									if(get_post_meta(get_the_ID(), 'Twitter URL', true) != ''){				
										$sentient_twitter = '<div class="social-icon">
																<a href="'. esc_url(get_post_meta(get_the_ID(), 'Twitter URL', true)) .'"><i class="fa fa-twitter fa-3x"></i></a>
															</div>';
									} else {
										$sentient_twitter = '';
									}												
								
									if(get_post_meta(get_the_ID(), 'Facebook URL', true) != ''){				
										$sentient_facebook = '<div class="social-icon">
																<a href="'. esc_url(get_post_meta(get_the_ID(), 'Facebook URL', true)) .'"><i class="fa fa-facebook fa-3x"></i></a>
															</div>';
									} else {
										$sentient_facebook = '';
									}												

									if(get_post_meta(get_the_ID(), 'Google URL', true) != ''){		
										$sentient_google = '<div class="social-icon">
																<a href="'. esc_url(get_post_meta(get_the_ID(), 'Google URL', true)) .'"><i class="fa fa-google-plus fa-3x"></i></a>
															</div>';
									} else {
										$sentient_google = '';
									}	
								
								?>									
								<?php 
									if(has_tag()){ 								
										$identityTag = '';
										$identitytags = get_the_tags();
										if ($identitytags) {
										  foreach($identitytags as $tag) {	  
											$identityTag .= '' . $tag->name . ', ';
										  }
										}

										$identityTag = '<div class="post-tags"><span><i class="fa fa-tag"></i>' . trim($identityTag, ', ') . '</span></div>';									
										
										 echo wp_kses( $identityTag, array(
												'div' => array(
													'class' => array()
												),
												'i' => array(
													'class' => array()
												),
												'span' => array(
													'class' => array()
												)												
											) );											
										
									}
								?>	

				
								<!-- Display Post Social
								================================================== -->					
								<?php 
								$allSocials = '';
								if($sentient_flickr == '' && $sentient_linkedin == '' && $sentient_google == '' && $sentient_pinterest == '' && $sentient_twitter == '' && $sentient_facebook == '') { 
									/* Nothing to Display */
								} else {?>
									<?php 
									
										$allSocials = $sentient_facebook . $sentient_twitter . $sentient_pinterest . $sentient_google . $sentient_linkedin . $sentient_flickr;
									
										echo wp_kses( $allSocials, array(
											'div' => array(
												'class' => array()									
											),
											'a' => array(
												'href' => array()									
											),
											'i' => array(
												'class' => array()									
											)									
										) );																		
									
									?>								
								<?php } ?>	
					
							</article>
							
							<!-- Blog Author Section
							================================================== -->					
							<?php if(selfie_get_option_value('blog_author_option') == 'On'){ ?>
								<div class="post-author clearfix">
									<h3><?php esc_html_e("About the Author" , "selfie"); ?></h3>
									<div class="pull-left">
										<?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?>
									</div>									
									<p>
										<?php the_author_meta('description'); ?>
									</p>
								</div>																							
							<?php } ?>							
							
							
							<!-- Comments Section
							================================================== -->					
							<?php if(comments_open($post->ID )){?> 
							<div id="comment" class="comments">
								<?php comments_template('', true); ?>
							</div>											
							<?php } ?>
							<div class="prof-wp-links-pages"><?php wp_link_pages(array('before' => '<p>' . esc_html__('Pages: ','selfie'),'after'=> '</p>')); ?></div>							
							
							
						</div>
					<?php endwhile; ?>
					<?php endif; ?>						
				</div>
				
				<!-- START SIDEBAR -->
				<div class="col-md-4 col-sm-4 selfie-sidebar" id="secondary">
					<?php get_sidebar(); ?>
				</div>				
			</div>
		</div>
	</section>		
<?php } ?>
<!-- Single Post Template End
================================================== -->	



<!-- Get Page Footer
================================================== -->	
<?php get_footer(); ?>