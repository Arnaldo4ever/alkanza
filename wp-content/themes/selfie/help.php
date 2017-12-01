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
    <div class="wpb_wrapper">
      <div class="homepage-container-design" style="color:#666666; margin-top: 110px;">
			<div class="homepage-container-design-inner" style="max-width: 1140px;">
        <div class="vc_row wpb_row vc_inner vc_row-fluid">
          <div class="wpb_column vc_column_container vc_col-sm-12">
            <div class="wpb_wrapper">
              <div class="">

                <div class="vc_col-sm-12">
                  <div class="vc_col-sm-4">
                  <h1 class="titulo">Keep in touch</h1>
                  <p class="selfie-subtitle-text999" style="font-size: 18px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus convallis pulvinar lacus, in porttitor erat accumsan in. Praesent tempus vel ipsum porttitor molestie. Aliquam mattis felis non purus semper.</p>
                  <div class="selfie-copyrights item_left" style="border-left: 2px solid #999;">
                    <a href="#"><i style="font-size: 22px;margin: 0px 5px;" class="fa fa-facebook-square" aria-hidden="true"></i></a>
                    <a href="#"><i style="font-size: 22px;margin: 0px 5px;" class="fa fa-twitter" aria-hidden="true"></i></a>
                  </div>
                  </div>
                  <div class="vc_col-sm-8">
                    <div class="vc_col-sm-6">
                      <input type="text" class="form-control" name="your-name" required="" data-form-field="nombre" value="Nombre" onclick="if(this.value=='Nombre') this.value=''" onblur="if(this.value=='') this.value='Nombre'" id="your-name">
                    </div>
                    <div class="vc_col-sm-6">
                      <input type="mail" class="form-control" name="your-mail" required="" data-form-field="correo" value="Correo" onclick="if(this.value=='Correo') this.value=''" onblur="if(this.value=='') this.value='Correo'" id="your-mail">
                    </div>

                    <div class="vc_col-sm-6">
                      <input type="text" class="form-control" name="your-phone" required="" data-form-field="telefono" value="Teléfono" onclick="if(this.value=='Teléfono') this.value=''" onblur="if(this.value=='') this.value='Teléfono'" id="your-phone">
                    </div>
                    <div class="vc_col-sm-6">
                      <select class="form-control" name="your-request" id="your-request">
                        <option value="Request">Request</option>
                        <option value="opcion2">opcion2</option>
                        <option value="opcion3">opcion3</option>
                        <option value="opcion4">opcion4</option>
                      </select>
                    </div>
                    <div class="vc_col-sm-12">
                      <textarea style="padding: 10px;" class="form-control" rows="6" name="your-message" value="Mensaje" onclick="if(this.value=='Mensaje') this.value=''" onblur="if(this.value=='') this.value='Mensaje'"  />Mensaje</textarea>
                    </div>
                    <div class="vc_col-sm-12">
                      <button style="border: 2px solid #b9916d;" type="submit" class="btn btn-primary">ENVIAR</button>
                    </div>

                  </div>
                </div>

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
.titulo {
  transition: none;
  text-align: inherit;
  line-height: 49px;
  border-width: 0px;
  margin: 0px;
  padding: 0px;
  letter-spacing: 0px;
  font-weight: 600;
  font-size: 48px !important;
  color: #22cfc9;
  font-family: Raleway !important;
}
.btn.btn-primary {
  border: 1px solid #22cfc9;
  border-radius: 10px;
  width: 100%;
  color: #22cfc9;
}
.form-control {
    background-color: transparent;
    background-image: none;
    border: 1px solid #2f343a;
    border-radius: 10px;
    box-shadow: none;
    color: #2f343a;
    display: block;
    font-size: 14px;
    height: 50px;
    line-height: 1.42857;
    padding: 15px 10px;
    transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    vertical-align: middle;
    width: 100%;
    margin-bottom: 15px;
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
