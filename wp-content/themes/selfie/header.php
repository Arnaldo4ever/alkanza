<!DOCTYPE html>
<!--[if gt IE 8]><html class="ie" <?php language_attributes(); ?>><![endif]-->
<!--[if !IE]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->



<!-- Head Section Started
================================================== -->
<head>


	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="<?php bloginfo( 'charset' ); ?>" />

	<!-- Get Variables and pull files
  ================================================== -->
	<?php
		if(is_user_logged_in()) {$identity_user_logged = 'identity-user-logged';} else {$identity_user_logged = '';}
	?>


	<!-- Responsive is enabled
	================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">


	<!-- Favicons
	================================================== -->
	<?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) { ?>
		<link rel="shortcut icon" href="<?php echo esc_url(selfie_get_option_value('theme_favicon')); ?>" type="image/vnd.microsoft.icon"/>
	<?php } ?>


	<?php wp_head(); ?>
</head>
<!-- Head Section End
================================================== -->




<!-- Body Section Started
================================================== -->
<body <?php body_class(); ?>>

	<!-- Pre-loader -->
	<div class="mask">
		<div id="intro-loader">
		</div>
	</div>
	<!-- End Pre-loader -->



	<!-- Upper Navigation Bar -->
		<div class="selfie-upper-nav">
			<div class="container">
				<div class="vc_col-sm-8">
					<div class="selfie-upper-text"><?php echo esc_attr(selfie_get_option_value('top_header_desc')); ?></div>
					<div class="selfie-upper-mail"><i class="fa fa-envelope fa-2x"></i><?php echo esc_attr(selfie_get_option_value('top_header_email')); ?></div>
					<div class="selfie-upper-phone"><i class="fa fa-phone fa-2x"></i><?php echo esc_attr(selfie_get_option_value('top_header_phone')); ?></div>
				</div>
				<div class="vc_col-sm-4">
					<?php
						global $woocommerce;
						if (class_exists('Woocommerce') && selfie_get_option_value('select_shoppingcart') == 'On') {
					?>
							<span class="dropdown cart-nav selfie-cart-list">
								<a href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>" class="selfie-cart-link dropdown-toggle identity-cart-contents" data-toggle="dropdown">
									<i class="fa fa-shopping-cart"></i> <span class="label label-primary"><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, "selfie"), $woocommerce->cart->cart_contents_count);?></span>
								</a>
								<div class="widget_shopping_cart_content dropdown cart-nav"><?php echo selfie_get_header_cart(); ?></div>
							</span>
					<?php } ?>
					<?php if (!dynamic_sidebar('HeaderWidget')) { ?>
						<?php dynamic_sidebar('HeaderWidget'); ?>
					<?php } ?>
				</div>
			</div>
		</div>	
	<!-- Upper Navigation Bar -->


	<!-- Navbar -->
		<!-- Navigation -->
		<div class="navbar navbar-fixed-top <?php echo esc_attr($identity_user_logged); ?>">
			<nav id="navigation-sticky" class="trans-nav">
				<!-- Navigation Inner -->
				<div class="container inner">
					<div class="logo">
						<!-- Navigation Logo Link -->
						<a href="<?php  echo esc_url(home_url( '/' )) ; ?>" title="<?php esc_attr(bloginfo( 'name' )) ?>" rel="home" class="scroll">
							<?php if (selfie_get_option_value('select_display_logo') == 'On'){?>
									<img src="<?php echo esc_url(selfie_get_option_value('theme_logo')); ?>" alt="logo" class="site_logo" />
									<img src="<?php echo esc_url(selfie_get_option_value('theme_logo_sticky')); ?>" alt="logo" class="site_logo site_logo_sticky" />
							<?php } else { ?>
									<div><?php echo esc_attr(selfie_get_option_value('theme_site_logo_text')); ?></div>
							<?php } ?>
						</a>
					</div>


					<!-- Mobile Menu Button -->
					<a class="mobile-nav-button"><i class="fa fa-bars"></i></a>
					<!-- Navigation Menu -->
					<div class="nav-menu">
						<div class="nav selfie-nav">
							<?php
								wp_nav_menu( array( 'theme_location' => 'header-menu' , 'menu_class' => 'menu nav', 'fallback_cb' => 'selfie_menu_fall_back', 'walker' => new selfie_description_walker() ));
							?>
						</div>
					</div>
					<!-- End Navigation Menu -->
				</div>
			<!-- End Navigation Inner -->
			</nav>
			<!-- End Navigation -->
		</div>
	<!-- End Navbar -->

   <!-- === START SLIDER SECTION === -->
	<?php if(is_front_page() && !is_home()){ ?>
		<section id="home">
			<?php echo do_shortcode(selfie_get_option_value('page_slider')); ?>
		</section>
	<?php } ?>
	<!-- === END SLIDER SECTION === -->
