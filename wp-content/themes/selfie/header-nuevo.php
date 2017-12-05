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



<style>
.logo a {
		background-image: url(<?php echo esc_url(selfie_get_option_value('theme_logo')); ?>);
    display: inline-block;
    background-size: cover;
    background-repeat: no-repeat;
    width: 230px;
    height: 75px;
}
</style>
<!-- Body Section Started
================================================== -->
<body <?php body_class(); ?>>
  <div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
	<span id="letra-menu" onclick="openNav()">
		<svg version="1.1" id="icono" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			 viewBox="0 0 154 96" style="enable-background:new 0 0 154 96;" xml:space="preserve">
		<style type="text/css">
			.st0{fill:#22CFC9;}
			.st1{fill:#2F343A;}
			.st2{fill:#238080;}
		</style>
		<g>
			<rect x="33.2" y="15" class="st0" width="105.3" height="14.3"/>
			<rect x="59.1" y="66.6" class="st1" width="79.3" height="14.3"/>
			<rect x="15.6" y="40.8" class="st2" width="93.7" height="14.3"/>
		</g>
		</svg>
		Menú</span>
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

						</a>
					</div>


					<!-- End Navigation Menu -->
				</div>
			<!-- End Navigation Inner -->
			</nav>
			<!-- End Navigation -->
		</div>
	<!-- End Navbar -->
