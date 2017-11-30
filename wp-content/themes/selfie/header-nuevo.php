<!DOCTYPE html>
<!--[if gt IE 8]><html class="ie" <?php language_attributes(); ?>><![endif]-->
<!--[if !IE]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->



<!-- Head Section Started
================================================== -->
<head>


	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

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
  <div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
	<span style="position: fixed; font-size: 16px; cursor:pointer;" onclick="openNav()">
		<img src="http://localhost/alkanza/wp-content/uploads/2017/11/menu.png" style="width: 140px; position: relative; left: -65px;">Menú</span>
  <?php
    wp_nav_menu( array( 'theme_location' => 'header-menu' , 'menu_class' => 'menu nav', 'fallback_cb' => 'selfie_menu_fall_back', 'walker' => new selfie_description_walker() ));
  ?>
</div>
	<!-- Pre-loader -->
	<div class="mask">
		<div id="intro-loader">
		</div>
	</div>
	<!-- End Pre-loader -->


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


					<!-- End Navigation Menu -->
				</div>
			<!-- End Navigation Inner -->
			</nav>
			<!-- End Navigation -->
		</div>
	<!-- End Navbar -->
