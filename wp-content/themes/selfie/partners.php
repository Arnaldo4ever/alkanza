<?php
/**
 * Template Name: Template - Partners
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

<div class="vc_row wpb_row vc_row-fluid make-margin-bottom-zero vc_custom_1451850512524" style="margin-top: 155px; display: flex; justify-content: center;">
  <div class="wpb_column vc_column_container vc_col-sm-12" style="-webkit-box-shadow: 0px 0px 20px 1px rgba(199,199,199,1);-moz-box-shadow: 0px 0px 20px 1px rgba(199,199,199,1);box-shadow: 0px 0px 20px 1px rgba(199,199,199,1);background-color: #eff0f2; border-radius: 10px; width: 90%; padding: 15px 70px;">
    <div class="homepage-container-design-inner" style="width: 100%;">
      <div class="section-title  text-right" style="margin-bottom: -3px;">
      		<h1 style="color: #313131; font-size: 62px !important; font-weight: 700; font-family: Raleway !important; text-transform: lowercase;"><?php the_title(); ?></h1>
      </div>
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
	<div class="wpb_text_column wpb_content_element  vc_custom_1451648241754">
		<div class="wpb_wrapper">
			<p class="selfie-subtitle-text999" style="text-align: right; font-size: 20px;"><?php the_field('parrafo_principal'); ?></p>
		</div>
	</div>
	<?php endwhile; endif; ?>
    </div>
    <div class="wpb_wrapper"><div class="homepage-container-design  " style="color:#666666;">
			<div class="homepage-container-design-inner" style="max-width: 1400px;">
<div class="vc_row wpb_row vc_inner vc_row-fluid">
  <div class="wpb_column vc_column_container vc_col-sm-12">
    <div class="wpb_wrapper">
      <div class="">

				<div style="position: relative;">
					<a class="tooltips1 tooltips" href="#"><div class="punto"></div><span>Bogotá</span></a>
					<a class="tooltips2 tooltips" href="#"><div class="punto"></div><span>Bogotá</span></a>
					<a class="tooltips3 tooltips" href="#"><div class="punto"></div><span>Bogotá</span></a>
					<a class="tooltips4 tooltips" href="#"><div class="punto"></div><span>Bogotá</span></a>
					<a class="tooltips5 tooltips" href="#"><div class="punto"></div><span>Bogotá</span></a>
					<a class="tooltips6 tooltips" href="#"><div class="punto"></div><span>Bogotá</span></a>
					<a class="tooltips7 tooltips" href="#"><div class="punto"></div><span>Bogotá</span></a>
					<a class="tooltips8 tooltips" href="#"><div class="punto"></div><span>Bogotá</span></a>
					<a class="tooltips9 tooltips" href="#"><div class="punto"></div><span>Bogotá</span></a>
					<a class="tooltips10 tooltips" href="#"><div class="punto"></div><span>Bogotá</span></a>
				</div>
				<img src="http://digitalandes.co/alkanza/wp-content/uploads/2017/12/map.png">


            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
<style>
.navbar {
    background: rgba(255, 255, 255, 1);
}
/*tooltip*/
a.tooltips span {
  position: absolute;
  width:140px;
  color: #FFFFFF;
  background: #22CFC9;
  height: 22px;
  line-height: 22px;
  text-align: center;
  visibility: hidden;
  border-radius: 5px;
}
a.tooltips span:after {
  content: '';
  position: absolute;
  top: 50%;
  right: 100%;
  margin-top: -8px;
  width: 0; height: 0;
  border-right: 8px solid #22CFC9;
  border-top: 8px solid transparent;
  border-bottom: 8px solid transparent;
}
a:hover.tooltips span {
  visibility: visible;
  opacity: 1;
  left: 100%;
  top: 50%;
  margin-top: -11px;
  margin-left: 15px;
  z-index: 999;
}

.btn {
    border-radius: 0px;
    -webkit-border-radius: 0px;
    font-family: inherit;
    font-size: inherit;
    color: inherit;
    background: none;
    cursor: pointer;
    padding: 10px 15px;
    display: inline-block;
    margin: 30px 0px;
    text-transform: uppercase;
    letter-spacing: 1px;
    /* font-weight: 700; */
    outline: none;
    position: relative;
    -webkit-transition: all 0.3s;
    -moz-transition: all 0.3s;
    transition: all 0.3s;
}
.btn-default {
    color: #333333;
    background-color: transparent;
    border-color: transparent;
}
.btn-default:hover, .btn-default:focus, .btn-default:active, .btn-default.active, .open .dropdown-toggle.btn-default {
    color: #fff;
    background-color: #ebebeb;
    border-color: #adadad;
}
.btn-default:hover, .btn-default:focus, .btn-default:active, .btn-default.active, .open .dropdown-toggle.btn-default {
    outline: 0px auto -webkit-focus-ring-color;
    padding: 10px 15px;
    color: #fff;
    background-color: #20d0c6;
    border-color: #20d0c6;
    border-radius: 10px;
}
.member_name {
    color: #22cfc9 !important;
    font-size: 18px !important;
    font-weight: 600 !important;
    letter-spacing: 1px;
    text-transform: none;
}
.punto {
	background: #22cfc9;
	height: 10px;
	width: 10px;
	border-radius: 50%;
}
a.tooltips1 {
	position: absolute;
	left: 22.5%;
	margin-top: 15%;

}
a.tooltips2 {
	position: absolute;
  left: 24%;
  margin-top: 21.5%;
}
a.tooltips3 {
	position: absolute;
  left: 31%;
  margin-top: 23.5%;
}
a.tooltips4 {
	position: absolute;
	left: 30.5%;
  margin-top: 27%;
}
a.tooltips5 {
	position: absolute;
  left: 37%;
  margin-top: 28%;
}
a.tooltips6 {
	position: absolute;
	left: 47.5%;
	margin-top: 10%;
}
a.tooltips7 {
	position: absolute;
	left: 54.5%;
	margin-top: 29%;
}
a.tooltips8 {
	position: absolute;
	left: 76%;
	margin-top: 23%;
}
a.tooltips9 {
	position: absolute;
	left: 77%;
	margin-top: 19%;
}
a.tooltips10 {
	position: absolute;
	left: 81%;
	margin-top: 18.5%;
}
</style>
<script>
jQuery(document).ready(function(){
    jQuery('[data-toggle="tooltip"]').tooltip();
});

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
<?php get_footer(); ?>
