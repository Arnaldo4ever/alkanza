<?php  
/* Template Name: Template - Portfolio*/  
?>


<!-- Get Page Header
================================================== -->
<?php get_header(); ?>



<!-- Page Title Section
================================================== -->
<?php
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


<?php
	if(selfie_get_option_value('portfolio_pagination_option') == 'On'){
		$portfolioTotal = '12';
	
	} else {
		$portfolioTotal = '-1';
	}
?>

<!-- Page Portfolio Body Start
================================================== -->		
<section class="new-line new-line-portfolio" id="blog-page">

	<!-- Page Portfolio Filter
	================================================== -->
	<?php
		$cat_string = '';
		$terms = get_terms("portfoliocategories");
		$count = count($terms);  
		$AllWord = esc_html__("ALL" , 'selfie');
						
		if ( $count > 0 ){  
		  
			$cat_string .='<li>
						<a class="active" href="#" data-cat="*">' . $AllWord . '</a>
						</li>';
			foreach ( $terms as $term ) {  
				if($term->name != 'Uncategorized' && $term->name != 'uncategorized'){
					$termname = strtolower($term->name);  
					$termname = str_replace(' ', '-', $termname);  
					$cat_string .= '<li>
						<a href="#" data-cat="'.$termname.'">'.$term->name.'</a>
						</li>';  
				}
			}  
		}  	
	
	?>
	
	
	<div id="portfolio-filter">
		<div class="row text-center">
			<div class="col-md-12">
				<ul class="portfolio-filter-list">
					<?php echo wp_kses( $cat_string, array(
								'a' => array(
									'href' => array(),
									'data-cat' => array(),
									'class' => array()									
								),
								'li' => array(),
							) );
					?>
				</ul>
			</div>
		</div>		
	</div>

	<!-- Page Portfolio Container
	================================================== -->
	<div class="container">
		<div class="row">	
			<div class="col-md-12">
				<div id="portfolio-items" class="portfolio-items item_fade_in">
	
	<?php
	$loop = new WP_Query(array('post_type' => 'portfolio', 'posts_per_page' => -1));
	$cat_count = 1;
	
	if ( $loop ) :   
	while ( $loop->have_posts() ) : $loop->the_post();
		$cat_count = 1;
		$terms = get_the_terms( get_the_ID() , 'portfoliocategories' );  
		$separator = ' | ';
		$output = '';
		$outputClass = '';
		if ( $terms && ! is_wp_error( $terms ) ) {   

			foreach ( $terms as $term )   
			{  
				$termname = strtolower($term->name);
				if($cat_count < 3){											
					$output .= $term->name . $separator;
				}
				$termname = strtolower($term->name);  
				$outputClass .= str_replace(' ', '-', $termname) . ' ';
				$cat_count = $cat_count + 1;
			} 
			
			$final_cat_string = trim($output, $separator);
			
		} else {   
		   $final_cat_string = '';
		   $outputClass = '';
		}			
	
	

		if ( get_post_format() == false) {									
			$porIcon = 'camera';
		}elseif ( has_post_format('video')) {
			$porIcon = 'film';
		}elseif ( has_post_format('gallery')) {
			$porIcon = 'image';
		}elseif ( has_post_format( 'audio' )) { 							
			$porIcon = 'music';
		}else { 
			$porIcon = 'camera';			
		} 		
	?>
	
	<?php $feat_image = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) ); ?>
	
	<article class="<?php echo esc_attr($outputClass); ?>">	
		<?php echo get_the_post_thumbnail(get_the_ID() , array( 380, 380)); ?>
		<div class="overlay">
			<div class="controls">
				<a href="<?php echo esc_url(get_permalink()); ?>" class="icon-round-border">
					<i class="fa fa-link"></i>
				</a>
				<a href="<?php echo esc_url($feat_image); ?>" class="icon-round-border icon-view">
					<i class="fa fa-search"></i>
				</a>
			</div>							
			<div class="item-info">
				<h3><?php the_title(); ?></h3>
				<span><?php echo esc_attr($final_cat_string); ?></span>
			</div>
		</div>						
	</article>	

	
	<?php
		endwhile;
		endif;
	?>
	
				</div>
			</div>
		</div>
	</div>	
</section>


<!-- Get Page Footer
================================================== -->
<?php get_footer(); ?>