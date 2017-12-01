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
    <div align="left">
      <?php

    // Ahora buscamos las categorías inferiores
    $argumentos = array(
      'child_of' => $categoria_id
      );

    // Creamos la matriz $categorias_hijas
    $categorias_hijas = array();
    $categorias_hijas = get_categories( $argumentos );

    // Y las mostramos
    if ( !empty( $categorias_hijas ) ) {
      ?>
      <?php
      foreach( $categorias_hijas as $subcategoria ) {
        ?>
          <button class="btn btn-default filter-button" data-filter="<?php echo $subcategoria->cat_name; ?>"><?php echo $subcategoria->cat_name; ?></button>
      <?php
       }
      ?>
      <?php
    }
  ?>
      </div>
    <div class="wpb_wrapper">
      <div class="">
        <?php $args = array( 'post_type' => 'team', 'posts_per_page' => 99, 'order'=> 'DESC', 'orderby' => 'id' ); ?>
        <?php $the_query = new WP_Query( $args ); ?>
        <?php if ( $the_query->have_posts() ) while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
          <?php
            $post_id = get_the_ID(); //Trae el ID correcto.
            $cat = the_category(",", $post_id);
          ?>
        <div class="col-md-3 col-sm-6 col-xs-12 filter <?php echo $cat; ?>">
							<div class="member_item">
							<div class="member_img">
								<img src="<?php the_post_thumbnail_url('full'); ?>" class="attachment-identity-team size-identity-team wp-post-image">
							</div>
							<div class="member_descr center">
								<div class="member_name">
									<?php the_title(); ?>
								</div>
								<div class="member_post">
									  Graphic Designer
								</div>
								<div class="member_about">
									 <?php the_content(); ?>
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
