<?php
/**
 * Template Name: Template - Help
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
  <div class="wpb_column vc_column_container vc_col-sm-12" style="-webkit-box-shadow: 0px 0px 20px 1px rgba(199,199,199,1);-moz-box-shadow: 0px 0px 20px 1px rgba(199,199,199,1);box-shadow: 0px 0px 20px 1px rgba(199,199,199,1);background-color: #eff0f2; border-radius: 10px; width: 90%; padding: 15px 70px;">
    <div class="homepage-container-design-inner" style="width: 100%;">
      <div class="section-title  text-right" style="margin-bottom: -3px;">
      		<h1 style="color: #313131; font-size: 62px !important; font-weight: 700; font-family: Raleway !important;">help</h1>
      </div>
	<div class="wpb_text_column wpb_content_element  vc_custom_1451648241754">
		<div class="wpb_wrapper">
			<p class="selfie-subtitle-text999" style="text-align: right; font-size: 20px;">Lorem ipsum dolor sit amet, consectetur<br>adipiscing elit duis ut lobortis nulla luctus</p>
		</div>
	</div>
    </div>
    <div class="wpb_wrapper"><div class="homepage-container-design  " style="color:#666666;">
			<div class="homepage-container-design-inner" style="max-width: 1140px;">
        <div class="vc_row wpb_row vc_inner vc_row-fluid">
          <div class="wpb_column vc_column_container vc_col-sm-12">
            <div class="wpb_wrapper">
              <div class="">
                <?php echo do_shortcode('[contact-form-7 id="4"]'); ?>
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
</style>
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
<?php get_footer(); ?>
