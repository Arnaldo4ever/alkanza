<?php
/**
 * Template Name: Template - Team
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

<div class="vc_row wpb_row vc_row-fluid make-margin-bottom-zero vc_custom_1451850512524" style="margin-top: 170px; display: flex; justify-content: center;">
  <div class="wpb_column vc_column_container vc_col-sm-12" style="background-color: #d6d6d6; border-radius: 10px; width: 90%; padding: 50px;">
    <div class="homepage-container-design-inner" style="width: 100%;">
      <div class="section-title  text-right">
      		<h1 style="color: #999999;">Team</h1>
      </div>
	<div class="wpb_text_column wpb_content_element  vc_custom_1451648241754">
		<div class="wpb_wrapper">
			<p class="selfie-subtitle-text999" style="text-align: right;">Lorem ipsum dolor sit amet, consectetur<br>adipiscing elit duis ut lobortis nulla luctus</p>
		</div>
	</div>
    </div>
    <div class="wpb_wrapper"><div class="homepage-container-design  " style="color:#666666;">
			<div class="homepage-container-design-inner" style="max-width: 1140px;">
<div class="vc_row wpb_row vc_inner vc_row-fluid">
  <div class="wpb_column vc_column_container vc_col-sm-12">
    <div align="center">
      <?php if (have_posts() ) while ( have_posts() ) : the_post(); ?>
            <button class="btn btn-default filter-button" data-filter="<?php echo $cache_categories[$cat]->cat_name ?>"><?php echo $cache_categories[$cat]->cat_name ?></button>
            <?php endwhile; ?>
        </div>
    <div class="wpb_wrapper">
      <div class="">
        <?php $args = array( 'post_type' => 'team', 'posts_per_page' => 99, 'order'=> 'DESC', 'orderby' => 'id' ); ?>
        <?php $the_query = new WP_Query( $args ); ?>
        <?php if ( $the_query->have_posts() ) while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
        <div class="col-md-3 col-sm-6 col-xs-12 filter <?php $category = get_the_category(); echo $category[0]->cat_name; ?>">
							<div class="member_item">
							<div class="member_img">
								<img width="500" height="500" src="http://themes.profteamsolutions.com/selfie-multi/wp-content/uploads/2016/01/Team-2.jpg" class="attachment-identity-team size-identity-team wp-post-image" alt="Team-2" srcset="http://themes.profteamsolutions.com/selfie-multi/wp-content/uploads/2016/01/Team-2-150x150.jpg 150w, http://themes.profteamsolutions.com/selfie-multi/wp-content/uploads/2016/01/Team-2-300x300.jpg 300w, http://themes.profteamsolutions.com/selfie-multi/wp-content/uploads/2016/01/Team-2-75x75.jpg 75w, http://themes.profteamsolutions.com/selfie-multi/wp-content/uploads/2016/01/Team-2-220x220.jpg 220w, http://themes.profteamsolutions.com/selfie-multi/wp-content/uploads/2016/01/Team-2-380x380.jpg 380w, http://themes.profteamsolutions.com/selfie-multi/wp-content/uploads/2016/01/Team-2-180x180.jpg 180w, http://themes.profteamsolutions.com/selfie-multi/wp-content/uploads/2016/01/Team-2-400x400.jpg 400w, http://themes.profteamsolutions.com/selfie-multi/wp-content/uploads/2016/01/Team-2.jpg 500w" sizes="(max-width: 500px) 100vw, 500px">
							</div>
							<div class="member_descr center">
								<div class="member_name">
									Rose Doe
								</div>
								<div class="member_post">
									  Graphic Designer
								</div>
								<div class="member_social">
								<a href="http://themes.profteamsolutions.com/selfie-multi/" class="facebook"><i class="fa fa-facebook"></i></a><a href="http://themes.profteamsolutions.com/selfie-multi/" class="twitter"><i class="fa fa-twitter"></i></a><a href="http://themes.profteamsolutions.com/selfie-multi/" class="linkedin"><i class="fa fa-linkedin"></i></a>
								</div>
								<div class="member_about">
									 In et massa a massa egestas suscipit tincidunt ut est. Curabitur rutrum faucibus elit, at convallis diam.
								</div>
								<div class="skill-member">
									<ul class="skillBar">
										<li style="opacity: 1; left: 0px;">
									<div class="skillBg">
										<span data-width="90" style="width: 90%;"><strong>Photoshop 90%</strong></span>
									</div>
								</li><li style="opacity: 1; left: 0px;">
									<div class="skillBg">
										<span data-width="85" style="width: 85%;"><strong>HTML/CSS 85%</strong></span>
									</div>
								</li><li style="opacity: 1; left: 0px;">
									<div class="skillBg">
										<span data-width="92" style="width: 92%;"><strong>Management 92%</strong></span>
									</div>
								</li>
									</ul>
								</div>
							</div>
							</div>
							</div>
            <?php endwhile; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
<script>
jQuery(document).ready(function(){

  jQuery(".filter-button").click(function(){
      var value = jQuery(this).attr('data-filter');

      if(value == "all")
      {
          //$('.filter').removeClass('hidden');
          jQuery('.filter').show('1000');
      }
      else
      {
//            $('.filter[filter-item="'+value+'"]').removeClass('hidden');
//            $(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');
          jQuery(".filter").not('.'+value).hide('3000');
          jQuery('.filter').filter('.'+value).show('3000');

      }
  });

  if (jQuery(".filter-button").removeClass("active")) {
jQuery(this).removeClass("active");
}
jQuery(this).addClass("active");

});
</script>
<!-- Get Page Footer
================================================== -->
<?php get_footer('nuevo'); ?>
