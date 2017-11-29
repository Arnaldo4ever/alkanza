<?php
/*------------------------------------------------------*/
/* Selfie functions.php Started */
/*------------------------------------------------------*/

/*------------------------------------------------------
Selfie, After Theme Setup - Started
-------------------------------------------------------*/

add_action('after_setup_theme', 'selfie_setup');

function selfie_setup(){

	/* Add theme-supported features here. */
	add_theme_support( 'post-thumbnails' ); 	
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'custom-header');
	add_theme_support( 'post-formats', array('video','gallery','audio' ) );
	add_theme_support( 'title-tag' );
	add_theme_support('woocommerce');	
	
	/* Add theme-supported to Portfolio. */
	add_post_type_support( 'portfolio', 'post-formats' );
	
	/* Add custom actions here. */
	add_action('wp_enqueue_scripts', 'selfie_load_theme_fonts', 30);
	add_action('wp_enqueue_scripts', 'selfie_load_theme_scripts' );
	add_action('wp_enqueue_scripts', 'selfie_load_theme_styles');	
	add_action('init', 'selfie_register_menus' );
	add_action( 'add_meta_boxes', 'selfie_add_sidebar_metabox' );  
	add_action( 'save_post', 'selfie_save_sidebar_postdata' );  
	add_action( 'tgmpa_register', 'selfie_register_required_plugins' );	
	
	
	/* Add custom filters here. */	
	add_filter('wp_list_categories','selfie_categories_postcount_filter');
	add_filter( 'get_search_form', 'selfie_search_form' );
	add_filter( 'wp_generate_attachment_metadata', 'selfie_retina_support_attachment_meta', 10, 2 );
	add_filter( 'delete_attachment', 'selfie_delete_retina_support_images' );
	add_filter( 'request', 'selfie_request_filter' );
	add_filter( 'excerpt_length', 'selfie_custom_excerpt_length', 999 );
	add_filter('excerpt_more', 'selfie_excerpt_more_string');
	add_filter('widget_text', 'do_shortcode');
	
	/* Add ceditor Styles here. */	
	add_editor_style();
	
	/* Add Selfie Content Width. */
	if ( ! isset( $content_width ) ){ $content_width = 1200;}	

	/* Add Custom Background. */
	add_theme_support( 'custom-background');
	
	/* Load Text Domain. */
	load_theme_textdomain('selfie', get_template_directory() . '/languages');
	
}

/*------------------------------------------------------
Selfie, After Theme Setup - End
-------------------------------------------------------*/



/*------------------------------------------------------*/
/* TGM_Plugin_Activation class Started*/
/*-----------------------------------------------------*/
require_once (get_template_directory() . '/admin/tgm/class-tgm-plugin-activation.php');
function selfie_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	 
	$selfie_layerslider_path = get_template_directory() . '/admin/lib/plugins/layersliderwp.zip';
	$selfie_vc_path = get_template_directory() . '/admin/lib/plugins/visual-composer.zip';
	$selfie_revslider_path = get_template_directory() . '/admin/lib/plugins/revslider.zip';
	$selfie_posts_path = get_template_directory() . '/admin/lib/plugins/ProfTeamExtensions.zip';
	$selfie_envato_updater = get_template_directory() . '/admin/lib/plugins/envato-wordpress-toolkit-master.zip';
	$selfie_rankie_path = get_template_directory() . '/admin/lib/plugins/wp-rankie.zip';
	
	$plugins = array(

		// This is an example of how to include a plugin pre-packaged with a theme	
		array(
			'name'     				=> 'Layerslider', // The plugin name
			'slug'     				=> 'LayerSlider', // The plugin slug (typically the folder name)
			'source'   				=> $selfie_layerslider_path, // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '5.6.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		
		array(
			'name'     				=> 'Rankie', // The plugin name
			'slug'     				=> 'wp-rankie', // The plugin slug (typically the folder name)
			'source'   				=> $selfie_rankie_path, // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.4.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),		
		
		array(
			'name'     				=> 'Visual Composer', // The plugin name
			'slug'     				=> 'js_composer', // The plugin slug (typically the folder name)
			'source'   				=> $selfie_vc_path, // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '4.11.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		
		array(
			'name'     				=> 'Revolution Slider', // The plugin name
			'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
			'source'   				=> $selfie_revslider_path, // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '5.2.3.5', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),		
		
		array(
			'name'     				=> 'ProfTeam Extensions', // The plugin name
			'slug'     				=> 'ProfTeamExtensions', // The plugin slug (typically the folder name)
			'source'   				=> $selfie_posts_path, // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '19.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),		

		array(
			'name'     				=> 'Envato WordPress Toolkit', // The plugin name
			'slug'     				=> 'envato-wordpress-toolkit-master', // The plugin slug (typically the folder name)
			'source'   				=> $selfie_envato_updater, // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.7.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),		
				
        array(
            'name'      => 'contact-form-7',
            'slug'      => 'contact-form-7',
            'required'  => false,
        ),
		
        array(
            'name'      => 'woocommerce',
            'slug'      => 'woocommerce',
            'required'  => false,
        ),				
			
	);
	
	
	$theme_text_domain = 'selfie';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       // Show admin notices or not
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> esc_html__( 'Install Required Plugins', 'selfie'),
			'menu_title'                       			=> esc_html__( 'Install Plugins', 'selfie' ),
			'installing'                       			=> esc_html__( 'Installing Plugin: %s', 'selfie' ), // %1$s = plugin name
			'oops'                             			=> esc_html__( 'Something went wrong with the plugin API.', 'selfie' ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' , 'selfie'), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.'  , 'selfie'), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.'  , 'selfie'), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.'  , 'selfie'), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.'  , 'selfie'), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.'  , 'selfie'), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.'  , 'selfie'), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.'  , 'selfie'), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins'  , 'selfie'),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins'  , 'selfie'),
			'return'                           			=> esc_html__( 'Return to Required Plugins Installer', 'selfie' ),
			'plugin_activated'                 			=> esc_html__( 'Plugin activated successfully.', 'selfie' ),
			'complete' 									=> esc_html__( 'All plugins installed and activated successfully. %s', 'selfie' ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );

}
/**************************************/
/*TGM_Plugin_Activation class End*/
/**************************************/




/**************************************/
/*Render title tag - Begin*/
/**************************************/
if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function selfie_slug_render_title() {
?>
	<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php
	}
	add_action( 'wp_head', 'selfie_slug_render_title' );
}
/**************************************/
/*Render title tag - End*/
/**************************************/




/***************************************************/
/*Set Visual Composer as Theme Function - Started*/
/***************************************************/
if(function_exists('vc_set_as_theme')) vc_set_as_theme();
/***************************************************/
/*Set Visual Composer as Theme Function - End*/
/***************************************************/


/***************************************************/
/*Register Fonts - Started*/
/***************************************************/
function selfie_fonts_url() {
    $font_url = '';
    global $prof_default;
    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
	if ( 'off' !== _x( 'on', 'Google font: on or off', 'selfie' ) ) {
		if(of_get_option('select_font',$prof_default) == 'Open+Sans'){
			$font_url = add_query_arg( 'family', urlencode( 'Open Sans:400,300,300italic,400italic,600,600italic,700,700italic,800italic,800&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );						
		} elseif(of_get_option('select_font',$prof_default) == 'Merriweather+Sans') {
			$font_url = add_query_arg( 'family', urlencode( 'Merriweather Sans:400,300,300italic,400italic,700,700italic,800,800italic&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );							
		} elseif(of_get_option('select_font',$prof_default) == 'Source+Sans+Pro') {	
			$font_url = add_query_arg( 'family', urlencode( 'Source Sans Pro:400,200,200italic,300italic,300,400italic,600,600italic,700italic,700,900,900italic&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );							
		} else {
			$changed = str_replace("+", " ", of_get_option('select_font',$prof_default));
			$font_url = add_query_arg( 'family', urlencode($changed . ':400,200,300,600,700,900&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );	
		}	 
	}else{
		if(of_get_option('select_font',$prof_default) == 'Open+Sans'){
			$font_url = add_query_arg( 'family', urlencode( 'Open Sans:400,300,300italic,400italic,600,600italic,700,700italic,800italic,800' ), "//fonts.googleapis.com/css" );						
		} elseif(of_get_option('select_font',$prof_default) == 'Merriweather+Sans') {
			$font_url = add_query_arg( 'family', urlencode( 'Merriweather Sans:400,300,300italic,400italic,700,700italic,800,800italic' ), "//fonts.googleapis.com/css" );							
		} elseif(of_get_option('select_font',$prof_default) == 'Source+Sans+Pro') {	
			$font_url = add_query_arg( 'family', urlencode( 'Source Sans Pro:400,200,200italic,300italic,300,400italic,600,600italic,700italic,700,900,900italic' ), "//fonts.googleapis.com/css" );							
		} else {
			$changed = str_replace("+", " ", of_get_option('select_font',$prof_default));
			$font_url = add_query_arg( 'family', urlencode($changed . ':400,200,300,600,700,900' ), "//fonts.googleapis.com/css" );	
		}					
	}

    return $font_url;
}


function selfie_heading_one_fonts() {
    $font_url = '';
    global $prof_default;
    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
	if ( 'off' !== _x( 'on', 'Google font: on or off', 'selfie' ) ) {
		if(of_get_option('h1_font',$prof_default) == 'Open+Sans'){
			$font_url = add_query_arg( 'family', urlencode( 'Open Sans:400,300,300italic,400italic,600,600italic,700,700italic,800italic,800&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );						
		} elseif(of_get_option('h1_font',$prof_default) == 'Merriweather+Sans') {
			$font_url = add_query_arg( 'family', urlencode( 'Merriweather Sans:400,300,300italic,400italic,700,700italic,800,800italic&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );							
		} elseif(of_get_option('h1_font',$prof_default) == 'Source+Sans+Pro') {	
			$font_url = add_query_arg( 'family', urlencode( 'Source Sans Pro:400,200,200italic,300italic,300,400italic,600,600italic,700italic,700,900,900italic&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );							
		} elseif(of_get_option('h1_font',$prof_default) == 'Oswald'){	
			$font_url = add_query_arg( 'family', urlencode( 'Oswald:400,300,700&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );													
		} else {
			$changed = str_replace("+", " ", of_get_option('h1_font',$prof_default));
			$font_url = add_query_arg( 'family', urlencode($changed . ':400,200,300,600,700,900&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );											
		}		 
	}else{
		if(of_get_option('h1_font',$prof_default) == 'Open+Sans'){
			$font_url = add_query_arg( 'family', urlencode( 'Open Sans:400,300,300italic,400italic,600,600italic,700,700italic,800italic,800' ), "//fonts.googleapis.com/css" );						
		} elseif(of_get_option('h1_font',$prof_default) == 'Merriweather+Sans') {
			$font_url = add_query_arg( 'family', urlencode( 'Merriweather Sans:400,300,300italic,400italic,700,700italic,800,800italic' ), "//fonts.googleapis.com/css" );							
		} elseif(of_get_option('h1_font',$prof_default) == 'Source+Sans+Pro') {	
			$font_url = add_query_arg( 'family', urlencode( 'Source Sans Pro:400,200,200italic,300italic,300,400italic,600,600italic,700italic,700,900,900italic' ), "//fonts.googleapis.com/css" );							
		} elseif(of_get_option('h1_font',$prof_default) == 'Oswald'){	
			$font_url = add_query_arg( 'family', urlencode( 'Oswald:400,300,700' ), "//fonts.googleapis.com/css" );													
		} else {
			$changed = str_replace("+", " ", of_get_option('h1_font',$prof_default));
			$font_url = add_query_arg( 'family', urlencode($changed . ':400,200,300,600,700,900' ), "//fonts.googleapis.com/css" );											
		}					
	}

    return $font_url;
}


function selfie_heading_two_fonts() {
    $font_url = '';
    global $prof_default;
    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
	if ( 'off' !== _x( 'on', 'Google font: on or off', 'selfie' ) ) {
		if(of_get_option('h2_font',$prof_default) == 'Open+Sans'){
			$font_url = add_query_arg( 'family', urlencode( 'Open Sans:400,300,300italic,400italic,600,600italic,700,700italic,800italic,800&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );						
		} elseif(of_get_option('h2_font',$prof_default) == 'Merriweather+Sans') {
			$font_url = add_query_arg( 'family', urlencode( 'Merriweather Sans:400,300,300italic,400italic,700,700italic,800,800italic&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );							
		} elseif(of_get_option('h2_font',$prof_default) == 'Source+Sans+Pro') {	
			$font_url = add_query_arg( 'family', urlencode( 'Source Sans Pro:400,200,200italic,300italic,300,400italic,600,600italic,700italic,700,900,900italic&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );							
		} elseif(of_get_option('h2_font',$prof_default) == 'Oswald'){	
			$font_url = add_query_arg( 'family', urlencode( 'Oswald:400,300,700&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );													
		} else {
			$changed = str_replace("+", " ", of_get_option('h2_font',$prof_default));
			$font_url = add_query_arg( 'family', urlencode($changed . ':400,200,300,600,700,900&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );											
		}		 
	}else{
		if(of_get_option('h2_font',$prof_default) == 'Open+Sans'){
			$font_url = add_query_arg( 'family', urlencode( 'Open Sans:400,300,300italic,400italic,600,600italic,700,700italic,800italic,800' ), "//fonts.googleapis.com/css" );						
		} elseif(of_get_option('h2_font',$prof_default) == 'Merriweather+Sans') {
			$font_url = add_query_arg( 'family', urlencode( 'Merriweather Sans:400,300,300italic,400italic,700,700italic,800,800italic' ), "//fonts.googleapis.com/css" );							
		} elseif(of_get_option('h2_font',$prof_default) == 'Source+Sans+Pro') {	
			$font_url = add_query_arg( 'family', urlencode( 'Source Sans Pro:400,200,200italic,300italic,300,400italic,600,600italic,700italic,700,900,900italic' ), "//fonts.googleapis.com/css" );							
		} elseif(of_get_option('h2_font',$prof_default) == 'Oswald'){	
			$font_url = add_query_arg( 'family', urlencode( 'Oswald:400,300,700' ), "//fonts.googleapis.com/css" );													
		} else {
			$changed = str_replace("+", " ", of_get_option('h2_font',$prof_default));
			$font_url = add_query_arg( 'family', urlencode($changed . ':400,200,300,600,700,900' ), "//fonts.googleapis.com/css" );											
		}					
	}

    return $font_url;
}


function selfie_heading_three_fonts() {
    $font_url = '';
    global $prof_default;
    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
	if ( 'off' !== _x( 'on', 'Google font: on or off', 'selfie' ) ) {
		if(of_get_option('h3_font',$prof_default) == 'Open+Sans'){
			$font_url = add_query_arg( 'family', urlencode( 'Open Sans:400,300,300italic,400italic,600,600italic,700,700italic,800italic,800&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );						
		} elseif(of_get_option('h3_font',$prof_default) == 'Merriweather+Sans') {
			$font_url = add_query_arg( 'family', urlencode( 'Merriweather Sans:400,300,300italic,400italic,700,700italic,800,800italic&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );							
		} elseif(of_get_option('h3_font',$prof_default) == 'Source+Sans+Pro') {	
			$font_url = add_query_arg( 'family', urlencode( 'Source Sans Pro:400,200,200italic,300italic,300,400italic,600,600italic,700italic,700,900,900italic&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );							
		} elseif(of_get_option('h3_font',$prof_default) == 'Oswald'){	
			$font_url = add_query_arg( 'family', urlencode( 'Oswald:400,300,700&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );													
		} else {
			$changed = str_replace("+", " ", of_get_option('h3_font',$prof_default));
			$font_url = add_query_arg( 'family', urlencode($changed . ':400,200,300,600,700,900&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );											
		}		 
	}else{
		if(of_get_option('h3_font',$prof_default) == 'Open+Sans'){
			$font_url = add_query_arg( 'family', urlencode( 'Open Sans:400,300,300italic,400italic,600,600italic,700,700italic,800italic,800' ), "//fonts.googleapis.com/css" );						
		} elseif(of_get_option('h3_font',$prof_default) == 'Merriweather+Sans') {
			$font_url = add_query_arg( 'family', urlencode( 'Merriweather Sans:400,300,300italic,400italic,700,700italic,800,800italic' ), "//fonts.googleapis.com/css" );							
		} elseif(of_get_option('h3_font',$prof_default) == 'Source+Sans+Pro') {	
			$font_url = add_query_arg( 'family', urlencode( 'Source Sans Pro:400,200,200italic,300italic,300,400italic,600,600italic,700italic,700,900,900italic' ), "//fonts.googleapis.com/css" );							
		} elseif(of_get_option('h3_font',$prof_default) == 'Oswald'){	
			$font_url = add_query_arg( 'family', urlencode( 'Oswald:400,300,700' ), "//fonts.googleapis.com/css" );													
		} else {
			$changed = str_replace("+", " ", of_get_option('h3_font',$prof_default));
			$font_url = add_query_arg( 'family', urlencode($changed . ':400,200,300,600,700,900' ), "//fonts.googleapis.com/css" );											
		}					
	}

    return $font_url;
}


function selfie_heading_four_fonts() {
    $font_url = '';
    global $prof_default;
    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
	if ( 'off' !== _x( 'on', 'Google font: on or off', 'selfie' ) ) {
		if(of_get_option('h4_font',$prof_default) == 'Open+Sans'){
			$font_url = add_query_arg( 'family', urlencode( 'Open Sans:400,300,300italic,400italic,600,600italic,700,700italic,800italic,800&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );						
		} elseif(of_get_option('h4_font',$prof_default) == 'Merriweather+Sans') {
			$font_url = add_query_arg( 'family', urlencode( 'Merriweather Sans:400,300,300italic,400italic,700,700italic,800,800italic&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );							
		} elseif(of_get_option('h4_font',$prof_default) == 'Source+Sans+Pro') {	
			$font_url = add_query_arg( 'family', urlencode( 'Source Sans Pro:400,200,200italic,300italic,300,400italic,600,600italic,700italic,700,900,900italic&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );							
		} elseif(of_get_option('h4_font',$prof_default) == 'Oswald'){	
			$font_url = add_query_arg( 'family', urlencode( 'Oswald:400,300,700&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );													
		} else {
			$changed = str_replace("+", " ", of_get_option('h4_font',$prof_default));
			$font_url = add_query_arg( 'family', urlencode($changed . ':400,200,300,600,700,900&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );											
		}		 
	}else{
		if(of_get_option('h4_font',$prof_default) == 'Open+Sans'){
			$font_url = add_query_arg( 'family', urlencode( 'Open Sans:400,300,300italic,400italic,600,600italic,700,700italic,800italic,800' ), "//fonts.googleapis.com/css" );						
		} elseif(of_get_option('h4_font',$prof_default) == 'Merriweather+Sans') {
			$font_url = add_query_arg( 'family', urlencode( 'Merriweather Sans:400,300,300italic,400italic,700,700italic,800,800italic' ), "//fonts.googleapis.com/css" );							
		} elseif(of_get_option('h4_font',$prof_default) == 'Source+Sans+Pro') {	
			$font_url = add_query_arg( 'family', urlencode( 'Source Sans Pro:400,200,200italic,300italic,300,400italic,600,600italic,700italic,700,900,900italic' ), "//fonts.googleapis.com/css" );							
		} elseif(of_get_option('h4_font',$prof_default) == 'Oswald'){	
			$font_url = add_query_arg( 'family', urlencode( 'Oswald:400,300,700' ), "//fonts.googleapis.com/css" );													
		} else {
			$changed = str_replace("+", " ", of_get_option('h4_font',$prof_default));
			$font_url = add_query_arg( 'family', urlencode($changed . ':400,200,300,600,700,900' ), "//fonts.googleapis.com/css" );											
		}					
	}

    return $font_url;
}


function selfie_heading_five_fonts() {
    $font_url = '';
    global $prof_default;
    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
	if ( 'off' !== _x( 'on', 'Google font: on or off', 'selfie' ) ) {
		if(of_get_option('h5_font',$prof_default) == 'Open+Sans'){
			$font_url = add_query_arg( 'family', urlencode( 'Open Sans:400,300,300italic,400italic,600,600italic,700,700italic,800italic,800&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );						
		} elseif(of_get_option('h5_font',$prof_default) == 'Merriweather+Sans') {
			$font_url = add_query_arg( 'family', urlencode( 'Merriweather Sans:400,300,300italic,400italic,700,700italic,800,800italic&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );							
		} elseif(of_get_option('h5_font',$prof_default) == 'Source+Sans+Pro') {	
			$font_url = add_query_arg( 'family', urlencode( 'Source Sans Pro:400,200,200italic,300italic,300,400italic,600,600italic,700italic,700,900,900italic&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );							
		} elseif(of_get_option('h5_font',$prof_default) == 'Oswald'){	
			$font_url = add_query_arg( 'family', urlencode( 'Oswald:400,300,700&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );													
		} else {
			$changed = str_replace("+", " ", of_get_option('h5_font',$prof_default));
			$font_url = add_query_arg( 'family', urlencode($changed . ':400,200,300,600,700,900&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );											
		}		 
	}else{
		if(of_get_option('h5_font',$prof_default) == 'Open+Sans'){
			$font_url = add_query_arg( 'family', urlencode( 'Open Sans:400,300,300italic,400italic,600,600italic,700,700italic,800italic,800' ), "//fonts.googleapis.com/css" );						
		} elseif(of_get_option('h5_font',$prof_default) == 'Merriweather+Sans') {
			$font_url = add_query_arg( 'family', urlencode( 'Merriweather Sans:400,300,300italic,400italic,700,700italic,800,800italic' ), "//fonts.googleapis.com/css" );							
		} elseif(of_get_option('h5_font',$prof_default) == 'Source+Sans+Pro') {	
			$font_url = add_query_arg( 'family', urlencode( 'Source Sans Pro:400,200,200italic,300italic,300,400italic,600,600italic,700italic,700,900,900italic' ), "//fonts.googleapis.com/css" );							
		} elseif(of_get_option('h5_font',$prof_default) == 'Oswald'){	
			$font_url = add_query_arg( 'family', urlencode( 'Oswald:400,300,700' ), "//fonts.googleapis.com/css" );													
		} else {
			$changed = str_replace("+", " ", of_get_option('h5_font',$prof_default));
			$font_url = add_query_arg( 'family', urlencode($changed . ':400,200,300,600,700,900' ), "//fonts.googleapis.com/css" );											
		}					
	}

    return $font_url;
}


function selfie_heading_six_fonts() {
    $font_url = '';
    global $prof_default;
    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
	if ( 'off' !== _x( 'on', 'Google font: on or off', 'selfie' ) ) {
		if(of_get_option('h6_font',$prof_default) == 'Open+Sans'){
			$font_url = add_query_arg( 'family', urlencode( 'Open Sans:400,300,300italic,400italic,600,600italic,700,700italic,800italic,800&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );						
		} elseif(of_get_option('h6_font',$prof_default) == 'Merriweather+Sans') {
			$font_url = add_query_arg( 'family', urlencode( 'Merriweather Sans:400,300,300italic,400italic,700,700italic,800,800italic&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );							
		} elseif(of_get_option('h6_font',$prof_default) == 'Source+Sans+Pro') {	
			$font_url = add_query_arg( 'family', urlencode( 'Source Sans Pro:400,200,200italic,300italic,300,400italic,600,600italic,700italic,700,900,900italic&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );							
		} elseif(of_get_option('h6_font',$prof_default) == 'Oswald'){	
			$font_url = add_query_arg( 'family', urlencode( 'Oswald:400,300,700&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );													
		} else {
			$changed = str_replace("+", " ", of_get_option('h6_font',$prof_default));
			$font_url = add_query_arg( 'family', urlencode($changed . ':400,200,300,600,700,900&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );											
		}		 
	}else{
		if(of_get_option('h6_font',$prof_default) == 'Open+Sans'){
			$font_url = add_query_arg( 'family', urlencode( 'Open Sans:400,300,300italic,400italic,600,600italic,700,700italic,800italic,800' ), "//fonts.googleapis.com/css" );						
		} elseif(of_get_option('h6_font',$prof_default) == 'Merriweather+Sans') {
			$font_url = add_query_arg( 'family', urlencode( 'Merriweather Sans:400,300,300italic,400italic,700,700italic,800,800italic' ), "//fonts.googleapis.com/css" );							
		} elseif(of_get_option('h6_font',$prof_default) == 'Source+Sans+Pro') {	
			$font_url = add_query_arg( 'family', urlencode( 'Source Sans Pro:400,200,200italic,300italic,300,400italic,600,600italic,700italic,700,900,900italic' ), "//fonts.googleapis.com/css" );							
		} elseif(of_get_option('h6_font',$prof_default) == 'Oswald'){	
			$font_url = add_query_arg( 'family', urlencode( 'Oswald:400,300,700' ), "//fonts.googleapis.com/css" );													
		} else {
			$changed = str_replace("+", " ", of_get_option('h6_font',$prof_default));
			$font_url = add_query_arg( 'family', urlencode($changed . ':400,200,300,600,700,900' ), "//fonts.googleapis.com/css" );											
		}					
	}

    return $font_url;
}
/***************************************************/
/*Register Fonts - End*/
/***************************************************/



/***************************************************/
/*Load Selfie Fonts - Started*/
/***************************************************/
function selfie_load_theme_fonts() {

	wp_enqueue_style( 'siteFont', selfie_fonts_url(), array(), '1.0.0' );
	wp_enqueue_style( 'headingOneFont', selfie_heading_one_fonts(), array(), '1.0.0' );
	wp_enqueue_style( 'headingTwoFont', selfie_heading_two_fonts(), array(), '1.0.0' );
	wp_enqueue_style( 'headingThreeFont', selfie_heading_three_fonts(), array(), '1.0.0' );
	wp_enqueue_style( 'headingFourFont', selfie_heading_four_fonts(), array(), '1.0.0' );
	wp_enqueue_style( 'headingFiveFont', selfie_heading_five_fonts(), array(), '1.0.0' );
	wp_enqueue_style( 'headingSixFont', selfie_heading_six_fonts(), array(), '1.0.0' );
}
/***************************************************/
/*Load Selfie Fonts - End*/
/***************************************************/



/***************************************************/
/*Load Selfie Styles - Started*/
/***************************************************/
function selfie_load_theme_styles() {

	global $prof_default;

	wp_enqueue_style('js_composer', get_template_directory_uri() . '/styles/selfie/js_composer.min.css' );
	
	wp_register_style('selfie-usage', get_template_directory_uri().'/styles/selfie-usage.css');
	wp_register_style('selfie-icons', get_template_directory_uri().'/styles/selfie-icons.css');	
	
	wp_register_style('selfie-custom', get_template_directory_uri().'/selfie-styles.css');
	
	wp_register_style('plugins', get_template_directory_uri().'/styles/selfie/plugins.css');	
	wp_register_style('bootstrap', get_template_directory_uri().'/styles/selfie/bootstrap.min.css');
	wp_register_style('selfie-style', get_template_directory_uri().'/styles/selfie/style.css');
	wp_register_style('style-responsive', get_template_directory_uri().'/styles/selfie/style-responsive.css');
	
	wp_register_style('style', get_stylesheet_uri());
	
	wp_enqueue_style( 'style');	
	wp_enqueue_style( 'selfie-icons');	
	wp_enqueue_style( 'selfie-usage');
	
	wp_enqueue_style('plugins');	
	wp_enqueue_style('bootstrap');
	wp_enqueue_style('selfie-style');
	wp_enqueue_style('style-responsive');	
	
	wp_enqueue_style( 'selfie-custom');

	
}

/***************************************************/
/*Load Selfie Styles - End*/
/***************************************************/




/***************************************************/
/*Load Selfie Scripts - Started*/
/***************************************************/
function selfie_load_theme_scripts() {
	global $is_IE;
	

	
	wp_enqueue_script('jquery.visible', get_template_directory_uri().'/js/jquery.visible.js',false,false,true);	
	
	wp_enqueue_script('prof.common', get_template_directory_uri().'/js/prof.common.js',false,false,true);		
	wp_enqueue_script('retina', get_template_directory_uri().'/js/retina.js', '', '', true);		
	
	wp_enqueue_script('scripts-top', get_template_directory_uri().'/js/selfie/scripts-top.js', '', '', true);
	
	wp_enqueue_script('scripts-bottom', get_template_directory_uri().'/js/selfie/scripts-bottom.js', '', '', true);
	wp_enqueue_script('bootstrap.min', get_template_directory_uri().'/js/selfie/bootstrap.min.js', '', '', true);
	wp_enqueue_script('jquery.isotope.min', get_template_directory_uri().'/js/selfie/jquery.isotope.min.js', '', '', true);
	wp_enqueue_script('jquery.sticky', get_template_directory_uri().'/js/selfie/jquery.sticky.js', '', '', true);
	wp_enqueue_script('jquery.nicescroll.min', get_template_directory_uri().'/js/selfie/jquery.nicescroll.min.js', '', '', true);
	wp_enqueue_script('jquery.flexslider.min', get_template_directory_uri().'/js/selfie/jquery.flexslider.min.js', '', '', true);
	wp_enqueue_script('jquery.validate.min', get_template_directory_uri().'/js/selfie/jquery.validate.min.js', '', '', true);
	wp_enqueue_script('mapsgoogle', '//maps.googleapis.com/maps/api/js?sensor=false', '', '', true);
	wp_enqueue_script('gmap-settings', get_template_directory_uri().'/js/selfie/gmap-settings.js', '', '', true);	
	wp_enqueue_script('script', get_template_directory_uri().'/js/selfie/script.js', '', '', true);	
	
 	wp_enqueue_script('numinate', get_template_directory_uri().'/js/numinate.js', '', '', true);  
	
	wp_enqueue_script('magnific-popup', get_template_directory_uri().'/js/selfie/magnific-popup.min.js', '', '', true);	
	wp_enqueue_script('jquery.easy-pie-chart', get_template_directory_uri().'/js/selfie/jquery.easy-pie-chart.js', '', '', true);
	wp_enqueue_script('modernizr', get_template_directory_uri().'/js/selfie/modernizr-2.6.2-respond-1.1.0.min.js', '', '', true);
	wp_enqueue_script('jquery.utilcarousel.min', get_template_directory_uri().'/js/selfie/jquery.utilcarousel.min.js', '', '', true);	
	
	
   
	if ( $is_IE ) {
		wp_enqueue_script('html5','http://html5shim.googlecode.com/svn/trunk/html5.js',false,false,true);
	}

}
/***************************************************/
/*Load Selfie Scripts - End*/
/***************************************************/




/***************************************************/
/*Selfie Retina Functions - Started*/
/***************************************************/

/**
* Retina images
*
* This function is attached to the 'wp_generate_attachment_metadata' filter hook.
*/

function selfie_retina_support_attachment_meta( $metadata, $attachment_id ) {
	foreach ( $metadata as $key => $value ) {
		if ( is_array( $value ) ) {
			foreach ( $value as $image => $attr ) {
				if ( is_array( $attr ) )
					selfie_retina_support_create_images( get_attached_file( $attachment_id ), $attr['width'], $attr['height'], true );
			}
		}
	}

	return $metadata;
}


/**
 * Create retina-ready images
 *
 * Referenced via retina_support_attachment_meta().
 */
function selfie_retina_support_create_images( $file, $width, $height, $crop = false ) {
    if ( $width || $height ) {
        $resized_file = wp_get_image_editor( $file );
        if ( ! is_wp_error( $resized_file ) ) {
            $filename = $resized_file->generate_filename( $width . 'x' . $height . '@2x' );
 
            $resized_file->resize( $width * 2, $height * 2, $crop );
            $resized_file->save( $filename );
 
            $info = $resized_file->get_size();
 
            return array(
                'file' => wp_basename( $filename ),
                'width' => $info['width'],
                'height' => $info['height'],
            );
        }
    }
    return false;
}

/**
 * Delete retina-ready images
 *
 * This function is attached to the 'delete_attachment' filter hook.
 */
function selfie_delete_retina_support_images( $attachment_id ) {
    $meta = wp_get_attachment_metadata( $attachment_id );
    $upload_dir = wp_upload_dir();
	
	if(is_array($meta)){	
		$path = pathinfo( $meta['file'] );

		foreach ( $meta as $key => $value ) {
			if ( 'sizes' === $key ) {
				foreach ( $value as $sizes => $size ) {
					$original_filename = $upload_dir['basedir'] . '/' . $path['dirname'] . '/' . $size['file'];
					$retina_filename = substr_replace( $original_filename, '@2x.', strrpos( $original_filename, '.' ), strlen( '.' ) );
					if ( file_exists( $retina_filename ) )
						unlink( $retina_filename );
				}
			}
		}
	}
}
/***************************************************/
/*Selfie Retina Functions - End*/
/***************************************************/



/***************************************************/
/*Selfie Body Classes - Started*/
/***************************************************/
add_filter( 'body_class', 'selfie_body_class' );
function selfie_body_class( $classes ) {
	

	if(is_front_page() && !is_home()){
		$sentient_front_page = 'home-page';
	} else {
		$sentient_front_page = 'single-page';
	}	
	
	if(is_user_logged_in()) {$identity_user_logged = 'identity-user-logged';} else {$identity_user_logged = '';}	
	
	if(wp_is_mobile()){
		$identityDevice = 'identity-mobile-device';
	}else{
		$identityDevice = 'identity-pc-device';
	}	
	
	if(selfie_get_option_value('select_animation') == 'On'){$identityMobile = 'identity-mobile-put-animation';} else {$identityMobile = 'identity-mobile-hide-animation';}		
	
	$classes[] = esc_attr( 'selfie');
	$classes[] = esc_attr($identityMobile);
	$classes[] = esc_attr($sentient_front_page);
	$classes[] = esc_attr($identity_user_logged);
	$classes[] = esc_attr($identityDevice);
	
	if ( isset( $post ) ) {
		$classes[] = esc_attr( $post->post_type . '_' . $post->post_name );
	}
	if (is_single() ) {
		foreach((wp_get_post_terms( $post->ID)) as $term) {
			$classes[] = esc_attr( $term->slug );
		}
		foreach((wp_get_post_categories( $post->ID, array('fields' => 'slugs'))) as $category) {
			$classes[] = esc_attr( $category );
		}
	}
	
	return $classes;
	
}
/***************************************************/
/*Selfie Body Classes - End*/
/***************************************************/



/***************************************************/
/*Selfie General Array's that will be used - Started*/
/***************************************************/
$selfie_yes_no_arr = array(esc_html__("Yes", "selfie") => "yes", esc_html__("No", "selfie") => "no");
$selfie_circle_icon_arr = array(esc_html__("Circle", "selfie") => "circle", esc_html__("Box", "selfie") => "box");
$selfie_circle_social_arr = array(esc_html__("github", "selfie") => "github", esc_html__("twitter", "selfie") => "twitter", esc_html__("google-plus", "selfie") => "google-plus", esc_html__("pinterest", "selfie") => "pinterest", esc_html__("linkedin", "selfie") => "linkedin", esc_html__("vimeo", "selfie") => "vimeo", esc_html__("Instagram", "selfie") => "instagram",  esc_html__("YouTube", "selfie") => "youtube", esc_html__("Behance", "selfie") => "behance", esc_html__("Facebook", "selfie") => "facebook",esc_html__("Skype", "selfie") => "skype", esc_html__("Mail", "selfie") => "envelope");
$selfie_social_arr = array(esc_html__("github", "selfie") => "github-square", esc_html__("twitter", "selfie") => "twitter-square", esc_html__("google-plus", "selfie") => "google-plus-square", esc_html__("pinterest", "selfie") => "pinterest-square", esc_html__("linkedin", "selfie") => "linkedin-square", esc_html__("vimeo", "selfie") => "vimeo-square", esc_html__("Instagram", "selfie") => "instagram",  esc_html__("YouTube", "selfie") => "youtube-square", esc_html__("Behance", "selfie") => "behance-square", esc_html__("Facebook", "selfie") => "facebook-square",esc_html__("Skype", "selfie") => "skype", esc_html__("Mail", "selfie") => "envelope");
$selfie_animation_arr = array( esc_html__("Top", "selfie") => "item_top", esc_html__("Bottom", "selfie") => "item_bottom", esc_html__("Left", "selfie") => "item_left", esc_html__("Right", "selfie") => "item_right", esc_html__("Fade In", "selfie") => "item_fade_in" , esc_html__("None", "selfie") => "item_do_nothing");
$selfie_icon_arr = array(
esc_html__("Align Left", "selfie") => "align-left",
esc_html__("Align Center", "selfie") => "align-center",
esc_html__("Align Right", "selfie") => "align-right",
esc_html__("Align Justify", "selfie") => "align-justify",
esc_html__("Arrows", "selfie") => "arrows",
esc_html__("Arrow Left", "selfie") => "arrow-left",
esc_html__("Arrow Right", "selfie") => "arrow-right",
esc_html__("Arrow Up", "selfie") => "arrow-up",
esc_html__("Arrow Down", "selfie") => "arrow-down",
esc_html__("Asterisk", "selfie") => "asterisk",
esc_html__("Arrows V", "selfie") => "arrows-v",
esc_html__("Arrows H", "selfie") => "arrows-h",
esc_html__("Arrow Circle Left", "selfie") => "arrow-circle-left",
esc_html__("Arrow Circle Right", "selfie") => "arrow-circle-right",
esc_html__("Arrow Circle Up", "selfie") => "arrow-circle-up",
esc_html__("Arrow Circle Down", "selfie") => "arrow-circle-down",
esc_html__("Arrows Alt", "selfie") => "arrows-alt",
esc_html__("Ambulance", "selfie") => "ambulance",
esc_html__("Adn", "selfie") => "adn",
esc_html__("Angle Double Left", "selfie") => "angle-double-left",
esc_html__("Angle Double Right", "selfie") => "angle-double-right",
esc_html__("Angle Double Up", "selfie") => "angle-double-up",
esc_html__("Angle Double Down", "selfie") => "angle-double-down",
esc_html__("Angle Left", "selfie") => "angle-left",
esc_html__("Angle Right", "selfie") => "angle-right",
esc_html__("Angle Up", "selfie") => "angle-up",
esc_html__("Angle Down", "selfie") => "angle-down",
esc_html__("Anchor", "selfie") => "anchor",
esc_html__("Android", "selfie") => "android",
esc_html__("Apple", "selfie") => "apple",
esc_html__("Archive", "selfie") => "archive",
esc_html__("Automobile", "selfie") => "automobile",
esc_html__("Bars", "selfie") => "bars",
esc_html__("Backward", "selfie") => "backward",
esc_html__("Ban", "selfie") => "ban",
esc_html__("Bar Code", "selfie") => "barcode",
esc_html__("Bank", "selfie") => "bank",
esc_html__("Bell", "selfie") => "bell",
esc_html__("Book", "selfie") => "book",
esc_html__("Bookmark", "selfie") => "bookmark",
esc_html__("Bold", "selfie") => "bold",
esc_html__("Bullhorn", "selfie") => "bullhorn",
esc_html__("Briefcase", "selfie") => "briefcase",
esc_html__("Bolt", "selfie") => "bolt",
esc_html__("Beer", "selfie") => "beer",
esc_html__("Behance", "selfie") => "behance",
esc_html__("Behance Square", "selfie") => "behance-square",
esc_html__("Bitcoin", "selfie") => "bitcoin",
esc_html__("Bitbucket", "selfie") => "bitbucket",
esc_html__("Bitbucket-square", "selfie") => "bitbucket-square",
esc_html__("Bomb", "selfie") => "bomb",
esc_html__("BTC", "selfie") => "glass",
esc_html__("Bullseye", "selfie") => "bullseye",
esc_html__("Bug", "selfie") => "bug",
esc_html__("Building", "selfie") => "building",
esc_html__("Check", "selfie") => "check",
esc_html__("Cog", "selfie") => "cog",
esc_html__("Camera", "selfie") => "camera",
esc_html__("Chevron Left", "selfie") => "chevron-left",
esc_html__("Chevron Right", "selfie") => "chevron-right",
esc_html__("Check Circle", "selfie") => "check-circle",
esc_html__("Cross Hairs", "selfie") => "crosshairs",
esc_html__("Compress", "selfie") => "compress",
esc_html__("Calendar", "selfie") => "calendar",
esc_html__("Comment", "selfie") => "comment",
esc_html__("Chevron Up", "selfie") => "hevron-up",
esc_html__("Chevron Down", "selfie") => "chevron-down",
esc_html__("Camera Retro", "selfie") => "camera-retro",
esc_html__("Cogs", "selfie") => "cogs",
esc_html__("Comments", "selfie") => "comments",
esc_html__("Credit Card", "selfie") => "credit-card",
esc_html__("Certificate", "selfie") => "certificate",
esc_html__("Chain", "selfie") => "chain",
esc_html__("Cloud", "selfie") => "cloud",
esc_html__("Cut", "selfie") => "cut",
esc_html__("Copy", "selfie") => "copy",
esc_html__("Caret Down", "selfie") => "caret-down",
esc_html__("Caret Up", "selfie") => "caret-up",
esc_html__("Caret Left", "selfie") => "caret-left",
esc_html__("Caret Right", "selfie") => "caret-right",
esc_html__("Columns", "selfie") => "columns",
esc_html__("Clipboard", "selfie") => "clipboard",
esc_html__("Cloud Download", "selfie") => "cloud-download",
esc_html__("Cloud Upload", "selfie") => "cloud-upload",
esc_html__("Coffee", "selfie") => "coffee",
esc_html__("Cutlery", "selfie") => "cutlery",
esc_html__("Car", "selfie") => "car",
esc_html__("Cab", "selfie") => "cab",
esc_html__("Chevron Circle Left", "selfie") => "chevron-circle-left",
esc_html__("Chevron Circle Right", "selfie") => "chevron-circle-right",
esc_html__("Chevron Circle Up", "selfie") => "chevron-circle-up",
esc_html__("Chevron Circle Down", "selfie") => "chevron-circle-down",
esc_html__("Check Square", "selfie") => "check-square",
esc_html__("Child", "selfie") => "child",
esc_html__("Chain Broken", "selfie") => "chain-broken",
esc_html__("Circle", "selfie") => "circle",
esc_html__("Circle Thin", "selfie") => "circle-thin",
esc_html__("CNY", "selfie") => "cny",
esc_html__("Code", "selfie") => "code",
esc_html__("Compass", "selfie") => "compass",
esc_html__("Code Pen", "selfie") => "codepen",
esc_html__("css3", "selfie") => "css3",
esc_html__("Cube", "selfie") => "cube",
esc_html__("Cubes", "selfie") => "cubes",
esc_html__("Download", "selfie") => "download",
esc_html__("Dedent", "selfie") => "dedent",
esc_html__("Dashboard", "selfie") => "dashboard",
esc_html__("Database", "selfie") => "database",
esc_html__("Deviantart", "selfie") => "glass",
esc_html__("Desktop", "selfie") => "desktop",
esc_html__("Delicious", "selfie") => "delicious",
esc_html__("Drupal", "selfie") => "drupal",
esc_html__("Dribbble", "selfie") => "dribbble",
esc_html__("Dropbox", "selfie") => "dropbox",
esc_html__("Dollar", "selfie") => "dollar",
esc_html__("Digg", "selfie") => "digg",
esc_html__("Exchange", "selfie") => "exchange",
esc_html__("Eject", "selfie") => "eject",
esc_html__("Expand", "selfie") => "expand",
esc_html__("Exclamation Circle", "selfie") => "exclamation-circle",
esc_html__("Eye", "selfie") => "eye",
esc_html__("Eye Slash", "selfie") => "eye-slash",
esc_html__("Exclamation Triangle", "selfie") => "exclamation-triangle",
esc_html__("External Link", "selfie") => "external-link",
esc_html__("Envelope", "selfie") => "envelope",
esc_html__("Empire", "selfie") => "empire",
esc_html__("Envelope Square", "selfie") => "envelope-square",
esc_html__("External Link Square", "selfie") => "external-link-square",
esc_html__("Eraser", "selfie") => "eraser",
esc_html__("Exclamation", "selfie") => "exclamation",
esc_html__("Ellipsis Horizontal", "selfie") => "ellipsis-h",
esc_html__("Ellipsis Vertical", "selfie") => "ellipsis-v",
esc_html__("Euro", "selfie") => "euro",
esc_html__("Eur", "selfie") => "eur",
esc_html__("Flash", "selfie") => "flash",
esc_html__("Fighter Jet", "selfie") => "fighter-jet",
esc_html__("Film", "selfie") => "film",
esc_html__("Flag", "selfie") => "flag",
esc_html__("Font", "selfie") => "font",
esc_html__("Fast Backward", "selfie") => "fast-backward",
esc_html__("Forward", "selfie") => "forward",
esc_html__("Fast Forward", "selfie") => "fast-forward",
esc_html__("Fire", "selfie") => "fire",
esc_html__("folder", "selfie") => "folder",
esc_html__("Folder Open", "selfie") => "folder-open",
esc_html__("Facebook Square", "selfie") => "facebook-square",
esc_html__("Facebook", "selfie") => "facebook",
esc_html__("Filter", "selfie") => "filter",
esc_html__("Flask", "selfie") => "flask",
esc_html__("Fax", "selfie") => "fax",
esc_html__("Female", "selfie") => "female",
esc_html__("Foursquare", "selfie") => "foursquare",
esc_html__("Fire Extinguisher", "selfie") => "fire-extinguisher",
esc_html__("Flag Checkered", "selfie") => "flag-checkered",
esc_html__("Folder Open", "selfie") => "folder-open-o",
esc_html__("File", "selfie") => "file",
esc_html__("File Text", "selfie") => "file-text",
esc_html__("Flickr", "selfie") => "flickr",
esc_html__("Google Plus Square", "selfie") => "glass",
esc_html__("Google Plus", "selfie") => "google-plus",
esc_html__("Gavel", "selfie") => "gavel",
esc_html__("Glass", "selfie") => "glass",
esc_html__("Gear", "selfie") => "gear",
esc_html__("Gift", "selfie") => "gift",
esc_html__("Gears", "selfie") => "gears",
esc_html__("Github-Square", "selfie") => "github-square",
esc_html__("Github", "selfie") => "github",
esc_html__("Globe", "selfie") => "globe",
esc_html__("Group", "selfie") => "group",
esc_html__("Git Square", "selfie") => "git-square",
esc_html__("GE", "selfie") => "ge",
esc_html__("Google", "selfie") => "google",
esc_html__("Graduation Cap", "selfie") => "graduation-cap",
esc_html__("Git Tip", "selfie") => "gittip",
esc_html__("GBP", "selfie") => "gbp",
esc_html__("Gamepad", "selfie") => "gamepad",
esc_html__("Github Alt", "selfie") => "github-alt",
esc_html__("Git", "selfie") => "git",
esc_html__("Heart", "selfie") => "heart",
esc_html__("Home", "selfie") => "home",
esc_html__("Headphones", "selfie") => "headphones",
esc_html__("Header", "selfie") => "header",
esc_html__("History", "selfie") => "history",
esc_html__("hacker-news", "selfie") => "hacker-news",
esc_html__("html5", "selfie") => "html5",
esc_html__("H Square", "selfie") => "h-square",
esc_html__("Italic", "selfie") => "italic",
esc_html__("Indent", "selfie") => "indent",
esc_html__("image", "selfie") => "image",
esc_html__("Info Circle", "selfie") => "info-circle",
esc_html__("Inverse", "selfie") => "inverse",
esc_html__("Inbox", "selfie") => "inbox",
esc_html__("Institution", "selfie") => "institution",
esc_html__("Instagram", "selfie") => "instagram",
esc_html__("INR", "selfie") => "inr",
esc_html__("Info", "selfie") => "info",
esc_html__("JS Fiddle", "selfie") => "jsfiddle",
esc_html__("Joomla", "selfie") => "joomla",
esc_html__("JPY", "selfie") => "jpy",
esc_html__("Key", "selfie") => "key",
esc_html__("KRW", "selfie") => "krw",
esc_html__("Linkedin Square", "selfie") => "linkedin-square",
esc_html__("Link", "selfie") => "link",
esc_html__("List ul", "selfie") => "list-ul",
esc_html__("List ol", "selfie") => "list-ol",
esc_html__("Linkedin", "selfie") => "linkedin",
esc_html__("Legal", "selfie") => "legal",
esc_html__("List", "selfie") => "list-alt",
esc_html__("Lock", "selfie") => "lock",
esc_html__("List", "selfie") => "list",
esc_html__("Leaf", "selfie") => "leaf",
esc_html__("Life Bouy", "selfie") => "life-bouy",
esc_html__("Life Saver", "selfie") => "life-saver",
esc_html__("Language", "selfie") => "language",
esc_html__("Laptop", "selfie") => "laptop",
esc_html__("Level Up", "selfie") => "level-up",
esc_html__("Level Down", "selfie") => "level-down",
esc_html__("Long Arrow Down", "selfie") => "long-arrow-down",
esc_html__("Long Arrow Up", "selfie") => "long-arrow-up",
esc_html__("Long Arrow Left", "selfie") => "long-arrow-left",
esc_html__("Long Arrow Right", "selfie") => "long-arrow-right",
esc_html__("Linux", "selfie") => "linux",
esc_html__("Life Ring", "selfie") => "life-ring",
esc_html__("Magnet", "selfie") => "magnet",
esc_html__("Magic", "selfie") => "magic",
esc_html__("Money", "selfie") => "money",
esc_html__("Medkit", "selfie") => "medkit",
esc_html__("Music", "selfie") => "music",
esc_html__("Minus Circle", "selfie") => "minus-circle",
esc_html__("Mail Forward", "selfie") => "mail-forward",
esc_html__("Minus", "selfie") => "minus",
esc_html__("Mortar Board", "selfie") => "mortar-board",
esc_html__("Male", "selfie") => "male",
esc_html__("Minus Square", "selfie") => "minus-square",
esc_html__("Maxcdn", "selfie") => "maxcdn",
esc_html__("Mobile Phone", "selfie") => "mobile-phone",
esc_html__("mobile", "selfie") => "mobile",
esc_html__("Mail Reply", "selfie") => "mail-reply",
esc_html__("Microphone", "selfie") => "microphone",
esc_html__("Microphone Slash", "selfie") => "microphone-slash",
esc_html__("Navicon", "selfie") => "navicon",
esc_html__("Open Comment", "selfie") => "comment-o",
esc_html__("Open comments", "selfie") => "comments-o",
esc_html__("Open Lightbulb", "selfie") => "lightbulb-o",
esc_html__("Open Bell", "selfie") => "bell-o",
esc_html__("Open File Text", "selfie") => "file-text-o",
esc_html__("Open Building", "selfie") => "building-o",
esc_html__("Open Hospital", "selfie") => "hospital-o",
esc_html__("Open Envelope", "selfie") => "envelope-o",
esc_html__("Open Star", "selfie") => "star-o",
esc_html__("Open Trash", "selfie") => "trash-o",
esc_html__("Open File", "selfie") => "file-o",
esc_html__("Open Clock", "selfie") => "clock-o",
esc_html__("Open Arrow Circle Down", "selfie") => "arrow-circle-o-down",
esc_html__("Open Arrow Circle Up", "selfie") => "arrow-circle-o-up",
esc_html__("Open Play Circle", "selfie") => "play-circle-o",
esc_html__("Outdent", "selfie") => "outdent",
esc_html__("Open Picture", "selfie") => "picture-o",
esc_html__("Open Pencil Square", "selfie") => "pencil-square-o",
esc_html__("Open Share Square", "selfie") => "share-square-o",
esc_html__("Open Check Square", "selfie") => "check-square-o",
esc_html__("Open Times Circle", "selfie") => "times-circle-o",
esc_html__("Open Check Circle", "selfie") => "check-circle-o",
esc_html__("Open Bar Chart", "selfie") => "bar-chart-o",
esc_html__("Open Thumbs Up", "selfie") => "thumbs-o-up",
esc_html__("Open Thumbs Down", "selfie") => "thumbs-o-down",
esc_html__("Open Heart", "selfie") => "heart-o",
esc_html__("Open Lemon", "selfie") => "lemon-o",
esc_html__("Open Square", "selfie") => "square",
esc_html__("Open Bookmark", "selfie") => "bookmark-o",
esc_html__("Open hdd", "selfie") => "hdd-o",
esc_html__("Open Hand Right", "selfie") => "hand-o-right",
esc_html__("Open Hand Left", "selfie") => "hand-o-left",
esc_html__("Open Hand Up", "selfie") => "hand-o-up",
esc_html__("Open Hand Down", "selfie") => "hand-o-down",
esc_html__("Open Files", "selfie") => "files-o",
esc_html__("Open Floppy", "selfie") => "floppy-o",
esc_html__("Open Circle", "selfie") => "circle-o",
esc_html__("Open Folder", "selfie") => "folder-o",
esc_html__("Open Smile", "selfie") => "smile-o",
esc_html__("Open Frown", "selfie") => "frown-o",
esc_html__("Open Meh", "selfie") => "meh-o",
esc_html__("Open Keyboard", "selfie") => "keyboard-o",
esc_html__("Open Flag", "selfie") => "flag-o",
esc_html__("Open Calendar", "selfie") => "calendar-o",
esc_html__("Open Minus Square", "selfie") => "minus-square-o",
esc_html__("Open Caret Square Down", "selfie") => "caret-square-o-down",
esc_html__("Open Caret Square Up", "selfie") => "caret-square-o-up",
esc_html__("Open Caret Square Right", "selfie") => "caret-square-o-right",
esc_html__("Open Sun", "selfie") => "sun-o",
esc_html__("Open Moon", "selfie") => "moon-o",
esc_html__("Open Arrow Circle Right", "selfie") => "arrow-circle-o-right",
esc_html__("Open Arrow Circle Left", "selfie") => "arrow-circle-o-left",
esc_html__("Open Caret Square Left", "selfie") => "caret-square-o-left",
esc_html__("Open Dot Circle", "selfie") => "dot-circle-o",
esc_html__("Open Plus Square", "selfie") => "plus-square-o",
esc_html__("Open ID", "selfie") => "openid",
esc_html__("Open File pdf", "selfie") => "file-pdf-o",
esc_html__("Open File Word", "selfie") => "file-word-o",
esc_html__("Open File Eexcel", "selfie") => "file-excel-o",
esc_html__("Open File Powerpoint", "selfie") => "file-powerpoint-o",
esc_html__("Open File Photo", "selfie") => "file-photo-o",
esc_html__("Open File Picture", "selfie") => "file-picture-o",
esc_html__("Open File Image", "selfie") => "file-image-o",
esc_html__("Open File Zip", "selfie") => "file-zip-o",
esc_html__("Open File Archive", "selfie") => "file-archive-o",
esc_html__("Open File Sound", "selfie") => "file-sound-o",
esc_html__("Open File Audio", "selfie") => "file-audio-o",
esc_html__("Open File Movie", "selfie") => "file-movie-o",
esc_html__("Open File Video", "selfie") => "file-video-o",
esc_html__("Open File Code", "selfie") => "file-code-o",
esc_html__("Open Circle Notch", "selfie") => "circle-o-notch",
esc_html__("Open Send", "selfie") => "send-o",
esc_html__("Open Paper Plane", "selfie") => "paper-plane-o",
esc_html__("Pinterest", "selfie") => "pinterest",
esc_html__("Pinterest Square", "selfie") => "pinterest-square",
esc_html__("Paste", "selfie") => "paste",
esc_html__("Power Off", "selfie") => "power-off",
esc_html__("Print", "selfie") => "print",
esc_html__("Photo", "selfie") => "photo",
esc_html__("Play", "selfie") => "play",
esc_html__("Pause", "selfie") => "pause",
esc_html__("Plus Circle", "selfie") => "plus-circle",
esc_html__("Plus", "selfie") => "plus",
esc_html__("Plane", "selfie") => "plane",
esc_html__("Phone", "selfie") => "phone",
esc_html__("phone-square", "selfie") => "Phone Square",
esc_html__("Paper Clip", "selfie") => "paperclip",
esc_html__("Puzzle Piece", "selfie") => "puzzle-piece",
esc_html__("Play Circle", "selfie") => "play-circle",
esc_html__("Pencil Square", "selfie") => "pencil-square",
esc_html__("Page Lines", "selfie") => "pagelines",
esc_html__("Pied Piper Square", "selfie") => "pied-piper-square",
esc_html__("Pied Piper", "selfie") => "pied-piper",
esc_html__("Pied Piper Alt", "selfie") => "pied-piper-alt",
esc_html__("Paw", "selfie") => "paw",
esc_html__("Paper Plane", "selfie") => "paper-plane",
esc_html__("Paragraph", "selfie") => "paragraph",
esc_html__("Plus Square", "selfie") => "plus-square",
esc_html__("QR Code", "selfie") => "qrcode",
esc_html__("Question Circle", "selfie") => "question-circle",
esc_html__("Question", "selfie") => "question",
esc_html__("QQ", "selfie") => "qq",
esc_html__("Quote Left", "selfie") => "quote-left",
esc_html__("Quote Right", "selfie") => "quote-right",
esc_html__("Random", "selfie") => "random",
esc_html__("Retweet", "selfie") => "retweet",
esc_html__("Rss", "selfie") => "rss",
esc_html__("Reorder", "selfie") => "reorder",
esc_html__("Rotate Left", "selfie") => "rotate-left",
esc_html__("Road", "selfie") => "road",
esc_html__("Rotate Right", "selfie") => "rotate-right",
esc_html__("Repeat", "selfie") => "repeat",
esc_html__("Refresh", "selfie") => "refresh",
esc_html__("Reply", "selfie") => "reply",
esc_html__("Rocket", "selfie") => "rocket",
esc_html__("Rss Square", "selfie") => "rss-square",
esc_html__("Rupee", "selfie") => "rupee",
esc_html__("RMB", "selfie") => "rmb",
esc_html__("Ruble", "selfie") => "ruble",
esc_html__("Rouble", "selfie") => "rouble",
esc_html__("Rub", "selfie") => "rub",
esc_html__("Renren", "selfie") => "renren",
esc_html__("Reddit", "selfie") => "reddit",
esc_html__("Reddit Square", "selfie") => "reddit-square",
esc_html__("Recycle", "selfie") => "recycle",
esc_html__("RA", "selfie") => "ra",
esc_html__("Rebel", "selfie") => "rebel",
esc_html__("Step Backward", "selfie") => "step-backward",
esc_html__("Stop", "selfie") => "stop",
esc_html__("Step Forward", "selfie") => "step-forward",
esc_html__("Share", "selfie") => "share",
esc_html__("Shopping Cart", "selfie") => "shopping-cart",
esc_html__("Star Half", "selfie") => "star-half",
esc_html__("Sign Out", "selfie") => "sign-out",
esc_html__("Sign In", "selfie") => "sign-in",
esc_html__("Scissors", "selfie") => "scissors",
esc_html__("Save", "selfie") => "save",
esc_html__("Square", "selfie") => "square",
esc_html__("Strikethrough", "selfie") => "strikethrough",
esc_html__("Sort", "selfie") => "sort",
esc_html__("Sort Down", "selfie") => "sort-down",
esc_html__("Sort Desc", "selfie") => "sort-desc",
esc_html__("Sort Up", "selfie") => "sort-up",
esc_html__("Sort Asc", "selfie") => "sort-asc",
esc_html__("Sitemap", "selfie") => "sitemap",
esc_html__("Search", "selfie") => "search",
esc_html__("Star", "selfie") => "star",
esc_html__("Stethoscope", "selfie") => "stethoscope",
esc_html__("Suitcase", "selfie") => "suitcase",
esc_html__("Search Plus", "selfie") => "search-plus",
esc_html__("Search Minus", "selfie") => "search-minus",
esc_html__("Signal", "selfie") => "signal",
esc_html__("Spinner", "selfie") => "Spinner",
esc_html__("Superscript", "selfie") => "superscript",
esc_html__("Subscript", "selfie") => "subscript",
esc_html__("Shield", "selfie") => "shield",
esc_html__("Share Square", "selfie") => "share-square",
esc_html__("Sort Alpha Asc", "selfie") => "sort-alpha-asc",
esc_html__("Sort Alpha Desc", "selfie") => "sort-alpha-desc",
esc_html__("Sort Amount ASC", "selfie") => "sort-amount-asc",
esc_html__("Sort Amount Desc", "selfie") => "sort-amount-desc",
esc_html__("Sort Numeric Asc", "selfie") => "sort-numeric-asc",
esc_html__("Sort Numeric Desc", "selfie") => "sort-numeric-desc",
esc_html__("Stack Overflow", "selfie") => "stack-overflow",
esc_html__("Skype", "selfie") => "skype",
esc_html__("Stack Exchange", "selfie") => "stack-exchange",
esc_html__("Space Shuttle", "selfie") => "space-shuttle",
esc_html__("Slack", "selfie") => "Slack",
esc_html__("Stumbleupon Circle", "selfie") => "stumbleupon-circle",
esc_html__("Stumbleupon", "selfie") => "stumbleupon",
esc_html__("Spoon", "selfie") => "spoon",
esc_html__("Steam", "selfie") => "steam",
esc_html__("Steam Square", "selfie") => "steam-square",
esc_html__("Spotify", "selfie") => "spotify",
esc_html__("Sound Cloud", "selfie") => "soundcloud",
esc_html__("Support", "selfie") => "support",
esc_html__("Send", "selfie") => "send",
esc_html__("Sliders", "selfie") => "sliders",
esc_html__("Share Alt", "selfie") => "share-alt",
esc_html__("Share Alt Square", "selfie") => "share-alt-square",
esc_html__("Tag", "selfie") => "tag",
esc_html__("Tags", "selfie") => "tags",
esc_html__("Text Height", "selfie") => "text-height",
esc_html__("Text Width", "selfie") => "text-width",
esc_html__("Times Circle", "selfie") => "times-circle",
esc_html__("Twitter Square", "selfie") => "twitter-square",
esc_html__("Thumb Tack", "selfie") => "thumb-tack",
esc_html__("Trophy", "selfie") => "trophy",
esc_html__("Twitter", "selfie") => "twitter",
esc_html__("Tasks", "selfie") => "tasks",
esc_html__("Truck", "selfie") => "truck",
esc_html__("Tachometer", "selfie") => "tachometer",
esc_html__("Thumbnail Large", "selfie") => "th-large",
esc_html__("Thumbnail", "selfie") => "th",
esc_html__("Thumbnail List", "selfie") => "th-list",
esc_html__("Times", "selfie") => "times",
esc_html__("Ticket", "selfie") => "ticket",
esc_html__("Toggle Down", "selfie") => "toggle-down",
esc_html__("Toggle Up", "selfie") => "toggle-up",
esc_html__("Toggle Right", "selfie") => "toggle-right",
esc_html__("Thumbs Up", "selfie") => "thumbs-up",
esc_html__("Thumbs Down", "selfie") => "thumbs-down",
esc_html__("Tumblr", "selfie") => "tumblr",
esc_html__("Tumblr Square", "selfie") => "tumblr-square",
esc_html__("Trello", "selfie") => "trello",
esc_html__("Toggle Left", "selfie") => "toggle-left",
esc_html__("Turkish Lira", "selfie") => "turkish-lira",
esc_html__("Try", "selfie") => "try",
esc_html__("Taxi", "selfie") => "taxi",
esc_html__("Tree", "selfie") => "tree",
esc_html__("Tencent Weibo", "selfie") => "tencent-weibo",
esc_html__("Tablet", "selfie") => "tablet",
esc_html__("Terminal", "selfie") => "terminal",
esc_html__("Upload", "selfie") => "upload",
esc_html__("Unlock", "selfie") => "unlock",
esc_html__("Users", "selfie") => "users",
esc_html__("Underline", "selfie") => "underline",
esc_html__("Unsorted", "selfie") => "unsorted",
esc_html__("Undo", "selfie") => "undo",
esc_html__("User md", "selfie") => "user-md",
esc_html__("Umbrella", "selfie") => "umbrella",
esc_html__("User", "selfie") => "user",
esc_html__("Unlock Alt", "selfie") => "unlock-alt",
esc_html__("USD", "selfie") => "usd",
esc_html__("University", "selfie") => "university",
esc_html__("Unlink", "selfie") => "unlink",
esc_html__("Volume Off", "selfie") => "volume-off",
esc_html__("Volume Down", "selfie") => "volume-down",
esc_html__("Volume Up", "selfie") => "volume-up",
esc_html__("Video Camera", "selfie") => "video-camera",
esc_html__("VK", "selfie") => "vk",
esc_html__("Vimeo Square", "selfie") => "vimeo-square",
esc_html__("Vine", "selfie") => "vine",
esc_html__("Warning", "selfie") => "warning",
esc_html__("Wrench", "selfie") => "wrench",
esc_html__("Won", "selfie") => "won",
esc_html__("Windows", "selfie") => "windows",
esc_html__("Weibo", "selfie") => "weibo",
esc_html__("Wheel Chair", "selfie") => "wheelchair",
esc_html__("WordPress", "selfie") => "wordpress",
esc_html__("We Chat", "selfie") => "wechat",
esc_html__("Weixin", "selfie") => "weixin",
esc_html__("Xing", "selfie") => "xing",
esc_html__("Xing Square", "selfie") => "xing-square",
esc_html__("YEN", "selfie") => "yen",
esc_html__("Youtube Square", "selfie") => "youtube-square",
esc_html__("Youtube", "selfie") => "youtube",
esc_html__("Youtube Play", "selfie") => "youtube-play",
esc_html__("Yahoo", "selfie") => "yahoo",
);

$selfie_alert_arr = array(
esc_html__("Warning", "selfie") => "warning",
esc_html__("Information", "selfie") => "info",
esc_html__("Success", "selfie") => "success",
esc_html__("Danger ", "selfie") => "danger "
);

$selfie_list_arr = array(
esc_html__("Default", "selfie") => "default",
esc_html__("Check", "selfie") => "check",
esc_html__("Arrow Right", "selfie") => "chevron-right",
esc_html__("Heart", "selfie") => "heart",
esc_html__("Star ", "selfie") => "star "
);

$selfie_dropcaps_arr = array(
esc_html__("Boxed", "selfie") => "dropcap1",
esc_html__("Transparent", "selfie") => "dropcap2",
esc_html__("Italic", "selfie") => "dropcap3"
);

$selfie_circle_icon_style_arr = array(
esc_html__("Small", "selfie") => "small",
esc_html__("Large", "selfie") => "large"
);

/***************************************************/
/*Selfie General Array's that will be used - End*/
/***************************************************/




/***************************************************/
/*Selfie Search Query Function - Started*/
/***************************************************/
if(!is_admin()){
    add_action('init', 'selfie_search_query_fix');
    function selfie_search_query_fix(){
        if(isset($_GET['s']) && $_GET['s']==''){
            $_GET['s']=' ';
        }
    }
}

function selfie_request_filter( $query_vars ) {
    if( isset( $_GET['s'] ) && empty( $_GET['s'] ) ) {
        $query_vars['s'] = " ";
    }
    return $query_vars;
}
/***************************************************/
/*Selfie Search Query Function - End*/
/***************************************************/




/***************************************************/
/*Selfie Add Post Thumbnails size - Started*/
/***************************************************/
	if ( function_exists( 'add_theme_support' ) ) {
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 220, 220, true );
		set_post_thumbnail_size( 280, 190, true );
		set_post_thumbnail_size( 380, 380, true );
		set_post_thumbnail_size( 75, 75, true );
	}

	if ( function_exists( 'add_image_size' ) ) { 
		add_image_size( 'selfie-team', 220, 220, true );
		add_image_size( 'selfie-portfolio-image', 280, 190, true );
		add_image_size( 'selfie-portfolio-image', 380, 380, true );
		add_image_size( 'selfie-testimonial-image', 75, 75, true );
	}
/***************************************************/
/*Selfie Add Post Thumbnails sizes - End*/
/***************************************************/




/***************************************************/
/*Selfie Menu Options - Started */
/***************************************************/

function selfie_register_menus() {
  register_nav_menus(
    array(
      'header-menu' => esc_html__( 'Header Menu' , 'selfie')
    )
  );
}

/***************************************************/
/*Selfie Menu Options - End */
/***************************************************/




/***************************************************/
/*Selfie Menu Fall Back Function - Started */
/***************************************************/
function selfie_menu_fall_back(){
	
	echo '<ul class="nav" >';
	wp_list_pages(
      array(
        'title_li'  => '',
      	'sort_column'=> 'menu_order',
      )
    );
    echo '</ul>';

}
/***************************************************/
/*Selfie Menu Fall Back Function - End */
/***************************************************/




/***************************************************/
/*Selfie excerpt string function - Started */
/***************************************************/
function selfie_excerpt_more_string( $more ) {
	return '...';
}
/***************************************************/
/*Selfie excerpt string function - End */
/***************************************************/



/***************************************************/
/*Selfie excerpt length Function - Started */
/***************************************************/
function selfie_custom_excerpt_length( $length ) {
	return 80;
}
/***************************************************/
/*Selfie excerpt length Function - End */
/***************************************************/



/***************************************************/
/*Selfie , Add Shortcodes to Visual Composer - Started */
/***************************************************/
/* Here we will check if the Visual Composer is activated */
if(function_exists('vc_map')){


	/*------------------------------------------------------
	Selfie Team Members - Four per Row - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Selfie Team Members" , "selfie"),
	   "base" => "selfie_team_members",
	   "class" => "",
	   "category" => __('Content' , "selfie"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please enter No.# of Team Members to display" , "selfie"),
			 "param_name" => "noofposts",
			 "value" => "4",
			 "description" => __("Number of Team Members to display" , "selfie")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Do you want to display a Read More link for each team member?" , "selfie"),
			 "param_name" => "read",
			 "value" => $selfie_yes_no_arr,
			 "description" => __("If you choose YES then a Read More link will be displayed" , "selfie")
		  )	,
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Please enter team category name (if any) or keep it empty" , "selfie"),
			 "param_name" => "postcategory",
			 "value" => "",
			 "description" => esc_html__("If you entered category then only teams related to this category will be retrieved" , "selfie")
		  )			  
	   )
	) );




	/*------------------------------------------------------
	Selfie Slider - Shortcode
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => esc_html__("Selfie Slider" , "selfie"),
	   "base" => "selfie_slider_section",
	   "class" => "",
	   "category" => esc_html__('Content' , "selfie"),
	   "params" => array(
		  array(
			 "type" => "attach_images",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Selfie Slider" , "selfie"),
			 "param_name" => "background",
			 "value" => "",
			 "description" => esc_html__("Please Choose Images to be displayed in Selfie Slider" , "selfie")
		  ),
	   )
	) );	
	

	/*------------------------------------------------------
	Selfie Service with Image - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => esc_html__("Selfie Services Image" , "selfie"),
	   "base" => "selfie_services_with_image",
	   "class" => "",
	   "category" => esc_html__('Content' , "selfie"),
	   "params" => array(
		  array(
			 "type" => "attach_image",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Service Image" , "selfie"),
			 "param_name" => "image",
			 "value" => "",
			 "description" => esc_html__("Please Choose Image for your Row" , "selfie")
		  ),	   
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Please choose animation type" , "selfie"),
			 "param_name" => "animationtype",
			 "value" => $selfie_animation_arr,
			 "description" => esc_html__("Choose animation type" , "selfie")
		  )	,	   
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Please enter Title" , "selfie"),
			 "param_name" => "title",
			 "value" => "Section Title",
			 "description" => esc_html__("Enter Title" , "selfie")
		  ),	   
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Please enter text" , "selfie"),
			 "param_name" => "text",
			 "value" => "Section Text",
			 "description" => esc_html__("Enter text" , "selfie")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Text Color" , "selfie"),
			 "param_name" => "color",
			 "value" => "#FFFFFF",
			 "description" => esc_html__("Please Choose color for your text" , "selfie")
		  )
	   )
	) );

	/*------------------------------------------------------
	Selfie Address - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => esc_html__("Selfie Details" , "selfie"),
	   "base" => "selfie_details",
	   "class" => "",
	   "category" => esc_html__('Content' , "selfie"),
	   "params" => array(
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Choose Icon" , "selfie"),
			 "param_name" => "icon",
			 "value" => $selfie_icon_arr,
			 "description" => esc_html__("Choose Icon for your Details." , "selfie")
		  ), 	   
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Please enter Title" , "selfie"),
			 "param_name" => "title",
			 "value" => "Section Title",
			 "description" => esc_html__("Enter Title" , "selfie")
		  ),	   
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Please enter text" , "selfie"),
			 "param_name" => "text",
			 "value" => "Section Text",
			 "description" => esc_html__("Enter text" , "selfie")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Title Color" , "selfie"),
			 "param_name" => "titlecolor",
			 "value" => "#999999",
			 "description" => esc_html__("Please Choose color for your Title" , "selfie")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Text Color" , "selfie"),
			 "param_name" => "textcolor",
			 "value" => "#999999",
			 "description" => esc_html__("Please Choose color for your text" , "selfie")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Icon Color" , "selfie"),
			 "param_name" => "iconcolor",
			 "value" => "#999999",
			 "description" => esc_html__("Please Choose color for your Icon" , "selfie")
		  )		  
	   )
	) );	
	

	/*------------------------------------------------------
	Selfie Service with Icon - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => esc_html__("Selfie Services with Icon" , "selfie"),
	   "base" => "selfie_services_with_icon",
	   "class" => "",
	   "category" => esc_html__('Content' , "selfie"),
	   "params" => array(
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Choose Icon" , "selfie"),
			 "param_name" => "icon",
			 "value" => $selfie_icon_arr,
			 "description" => esc_html__("Choose Icon for your Service." , "selfie")
		  ),   
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Please choose animation type" , "selfie"),
			 "param_name" => "animationtype",
			 "value" => $selfie_animation_arr,
			 "description" => esc_html__("Choose animation type" , "selfie")
		  )	,	   
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Please enter Title" , "selfie"),
			 "param_name" => "title",
			 "value" => "Section Title",
			 "description" => esc_html__("Enter Title" , "selfie")
		  ),	   
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Please enter text" , "selfie"),
			 "param_name" => "text",
			 "value" => "Section Text",
			 "description" => esc_html__("Enter text" , "selfie")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Text Color" , "selfie"),
			 "param_name" => "color",
			 "value" => "#FFFFFF",
			 "description" => esc_html__("Please Choose color for your text" , "selfie")
		  )
	   )
	) );	

	
	/*------------------------------------------------------
	Selfie Service with Icon and Rotate - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => esc_html__("Selfie Services with Icon and Zoom" , "selfie"),
	   "base" => "selfie_services_with_icon_rotate",
	   "class" => "",
	   "category" => esc_html__('Content' , "selfie"),
	   "params" => array(
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Choose Icon" , "selfie"),
			 "param_name" => "icon",
			 "value" => $selfie_icon_arr,
			 "description" => esc_html__("Choose Icon for your Service." , "selfie")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Choose Icon for Zoom State" , "selfie"),
			 "param_name" => "icontwo",
			 "value" => $selfie_icon_arr,
			 "description" => esc_html__("Choose Icon for your Service." , "selfie")
		  ),   		  
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Please choose animation type" , "selfie"),
			 "param_name" => "animationtype",
			 "value" => $selfie_animation_arr,
			 "description" => esc_html__("Choose animation type" , "selfie")
		  )	,	   
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Please enter Title" , "selfie"),
			 "param_name" => "title",
			 "value" => "Section Title",
			 "description" => esc_html__("Enter Title" , "selfie")
		  ),	   
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Please enter text" , "selfie"),
			 "param_name" => "text",
			 "value" => "Section Text",
			 "description" => esc_html__("Enter text" , "selfie")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Please enter text for Zoom State" , "selfie"),
			 "param_name" => "texttwo",
			 "value" => "Section Text for Zoom State",
			 "description" => esc_html__("Enter text for Zoom State" , "selfie")
		  ),		  
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Text Color" , "selfie"),
			 "param_name" => "color",
			 "value" => "#FFFFFF",
			 "description" => esc_html__("Please Choose color for your text" , "selfie")
		  )
	   )
	) );		
	
	

	/*------------------------------------------------------
	Selfie Section Title - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => esc_html__("Selfie Section Title" , "selfie"),
	   "base" => "selfie_section_title",
	   "class" => "",
	   "category" => esc_html__('Content' , "selfie"),
	   "params" => array(
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Choose Title Icon" , "selfie"),
			 "param_name" => "icon",
			 "value" => $selfie_icon_arr,
			 "description" => esc_html__("Choose Icon for your Title." , "selfie")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Please enter text" , "selfie"),
			 "param_name" => "normaltext",
			 "value" => "Section Title",
			 "description" => esc_html__("Enter text" , "selfie")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Icon Color" , "selfie"),
			 "param_name" => "iconcolor",
			 "value" => "#FFFFFF",
			 "description" => esc_html__("Please Choose a color for your Icon" , "selfie")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Text Color" , "selfie"),
			 "param_name" => "textcolor",
			 "value" => "#666666",
			 "description" => esc_html__("Please Choose Your Text Color" , "selfie")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Please choose animation type" , "selfie"),
			 "param_name" => "animationtype",
			 "value" => $selfie_animation_arr,
			 "description" => esc_html__("Choose animation type" , "selfie")
		  )		  
	   )
	) );
	


	/*------------------------------------------------------
	Selfie Homepage Row Start - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => esc_html__("Selfie Row Begin" , "selfie"),
	   "base" => "homepage_container",
	   "class" => "",
	   "category" => esc_html__('Content' , "selfie"),
	   "params" => array(
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Font color" , "selfie"),
			 "param_name" => "font",
			 "value" => "#787878",
			 "description" => esc_html__("Please Choose Font color for your Row" , "selfie")
		  )
	   )
	) );


	/*------------------------------------------------------
	Selfie Services Icons - VC
	-------------------------------------------------------*/
	   vc_map( array(
	   "name" => esc_html__("Selfie Services Icons" , "selfie"),
	   "base" => "selfie_services_icons",
	   "class" => "",
	   "category" => esc_html__('Content' , "selfie"),
	   "params" => array(
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Please choose icon" , "selfie"),
			 "param_name" => "icon",
			 "value" => $selfie_icon_arr,
			 "description" => esc_html__("Choose any of the available icons" , "selfie")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Icon color" , "selfie"),
			 "param_name" => "color",
			 "value" => "#666666",
			 "description" => esc_html__("Please Choose your icon color" , "selfie")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Title color" , "selfie"),
			 "param_name" => "titlecolor",
			 "value" => "#666666",
			 "description" => esc_html__("Please Choose your title color" , "selfie")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Description color" , "selfie"),
			 "param_name" => "desccolor",
			 "value" => "#666666",
			 "description" => esc_html__("Please Choose your Description color" , "selfie")
		  ),			  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Please enter a Title here" , "selfie"),
			 "param_name" => "title",
			 "value" => "Title goes here",
			 "description" => esc_html__("The Title of the icon container" , "selfie")
		  ),
		  array(
			 "type" => "textarea",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Please enter Content here" , "selfie"),
			 "param_name" => "text",
			 "value" => "Content goes here",
			 "description" => esc_html__("The content of the icon container" , "selfie")
		  ),array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Please choose icon animation type" , "selfie"),
			 "param_name" => "animationtype",
			 "value" => $selfie_animation_arr,
			 "description" => esc_html__("Choose icons animation type" , "selfie")
		  )
	   )
	) );


	
	/*------------------------------------------------------
	Selfie Animated Numbers - VC
	-------------------------------------------------------*/
	
	vc_map( array(
	   "name" => esc_html__("Selfie Animated Number" , "selfie"),
	   "base" => "selfie_animated_numbers",
	   "class" => "",
	   "category" => esc_html__('Content' , "selfie"),
	   "params" => array(
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Please choose icon" , "selfie"),
			 "param_name" => "icon",
			 "value" => $selfie_icon_arr,
			 "description" => esc_html__("Choose any of the available icons" , "selfie")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Text color" , "selfie"),
			 "param_name" => "textcolor",
			 "value" => "#ffffff",
			 "description" => esc_html__("Please Choose your Text color" , "selfie")
		  ),		  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Number to Animate" , "selfie"),
			 "param_name" => "number",
			 "value" => "1000",
			 "description" => esc_html__("Enter Number to Animate" , "selfie")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Description" , "selfie"),
			 "param_name" => "text",
			 "value" => "Description goes here",
			 "description" => esc_html__("Enter Number Description" , "selfie")
		  )	  
	   )
	) );

	
	/*------------------------------------------------------
	Selfie Pricing Table - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => esc_html__("Selfie Pricing Table" , "selfie"),
	   "base" => "selfie_pricing_table",
	   "class" => "",
	   "category" => esc_html__('Content' , "selfie"),
	   "params" => array(	   
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Table Description" , "selfie"),
			 "param_name" => "description",
			 "value" => "Beginner Pack",
			 "description" => esc_html__("Enter Table Description" , "selfie")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Description color" , "selfie"),
			 "param_name" => "descriptioncolor",
			 "value" => "#ffffff",
			 "description" => esc_html__("Please Choose your Description color" , "selfie")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Description Background color" , "selfie"),
			 "param_name" => "descbackcolor",
			 "value" => "#1dcdaa",
			 "description" => esc_html__("Please Choose your Description Background color" , "selfie")
		  ),		  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Price Currency" , "selfie"),
			 "param_name" => "currency",
			 "value" => "$",
			 "description" => esc_html__("Enter Price Currency here" , "selfie")
		  ),	
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Price" , "selfie"),
			 "param_name" => "price",
			 "value" => "Price goes here",
			 "description" => esc_html__("Enter price here" , "selfie")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Period" , "selfie"),
			 "param_name" => "period",
			 "value" => "Per Month",
			 "description" => esc_html__("Enter Period here" , "selfie")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Price color" , "selfie"),
			 "param_name" => "pricecolor",
			 "value" => "#ffffff",
			 "description" => esc_html__("Please Choose your Price color" , "selfie")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Price Background color" , "selfie"),
			 "param_name" => "pricebackcolor",
			 "value" => "#1abc9c",
			 "description" => esc_html__("Please Choose your Price Background color" , "selfie")
		  ),			  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("URL/Link" , "selfie"),
			 "param_name" => "link",
			 "value" => "http://www.yoursite.com",
			 "description" => esc_html__("Enter URL/Link here" , "selfie")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Button Name" , "selfie"),
			 "param_name" => "linkname",
			 "value" => "Sign up",
			 "description" => esc_html__("Enter Button Name/Title here" , "selfie")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Button Background color" , "selfie"),
			 "param_name" => "buttonbackcolor",
			 "value" => "#1dcdaa",
			 "description" => esc_html__("Please Choose your Button Background color" , "selfie")
		  ),		  
		  array(
			 "type" => "textarea",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Table Content" , "selfie"),
			 "param_name" => "text",
			 "value" => "<li>Value One</li>",
			 "description" => esc_html__("Enter each value per line between < li > </ li > tags" , "selfie")
		  )			  
	   )
	) );


	
	
	/*------------------------------------------------------
	Selfie Chart - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => esc_html__("Selfie Chart" , "selfie"),
	   "base" => "selfie_chart",
	   "class" => "",
	   "category" => esc_html__('Content' , "selfie"),
	   "params" => array(
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Content color" , "selfie"),
			 "param_name" => "textcolor",
			 "value" => "#ffffff",
			 "description" => esc_html__("Please Choose your Content color" , "selfie")
		  ),		   
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Number to Animate" , "selfie"),
			 "param_name" => "number",
			 "value" => "1000",
			 "description" => esc_html__("Enter Number to Animate" , "selfie")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Title" , "selfie"),
			 "param_name" => "title",
			 "value" => "Title goes here",
			 "description" => esc_html__("Enter the Title here" , "selfie")
		  ),	
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Description" , "selfie"),
			 "param_name" => "text",
			 "value" => "Description goes here",
			 "description" => esc_html__("Enter Number Description" , "selfie")
		  )	  
	   )
	) );

	/*------------------------------------------------------
	Selfie Clients Slider - Shortcode
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => esc_html__("Selfie Clients Images" , "selfie"),
	   "base" => "selfie_clients_images",
	   "class" => "",
	   "category" => esc_html__('Content' , "selfie"),
	   "params" => array(
		  array(
			 "type" => "attach_images",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Clients Slider" , "selfie"),
			 "param_name" => "background",
			 "value" => "",
			 "description" => esc_html__("Please Choose Images to be displayed in Selfie Clients Slider" , "selfie")
		  ),
	   )
	) );
	


	/*------------------------------------------------------
	Selfie Button - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => esc_html__("Selfie Button" , "selfie"),
	   "base" => "selfie_button",
	   "class" => "",
	   "category" => esc_html__('Content' , "selfie"),
	   "params" => array(
	     array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Button border color" , "selfie"),
			 "param_name" => "bordercolor",
			 "value" => "#474d5d",
			 "description" => esc_html__("Please Choose a border color for your Button" , "selfie")
		  ),
		 array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Button color" , "selfie"),
			 "param_name" => "buttoncolor",
			 "value" => "#FFFFFF",
			 "description" => esc_html__("Please Choose a background color for your Button" , "selfie")
		  ),
		 array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Button Font color" , "selfie"),
			 "param_name" => "fontcolor",
			 "value" => "#000",
			 "description" => esc_html__("Please Choose Font color for your Button" , "selfie")
		  ),	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Please enter Button Title" , "selfie"),
			 "param_name" => "buttontext",
			 "value" => "Button",
			 "description" => esc_html__("The Title of your Button" , "selfie")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Please enter Button Link" , "selfie"),
			 "param_name" => "link",
			 "value" => "link",
			 "description" => esc_html__("The Link of your Button" , "selfie")
		  )	  		  
	   )
	) );
	
	/*------------------------------------------------------
	Selfie Download Button - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => esc_html__("Selfie Download Button" , "selfie"),
	   "base" => "selfie_download_button",
	   "class" => "",
	   "category" => esc_html__('Content' , "selfie"),
	   "params" => array(
	     array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Button border color" , "selfie"),
			 "param_name" => "bordercolor",
			 "value" => "#474d5d",
			 "description" => esc_html__("Please Choose a border color for your Button" , "selfie")
		  ),
		 array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Button color" , "selfie"),
			 "param_name" => "buttoncolor",
			 "value" => "#FFFFFF",
			 "description" => esc_html__("Please Choose a background color for your Button" , "selfie")
		  ),
		 array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Button Font color" , "selfie"),
			 "param_name" => "fontcolor",
			 "value" => "#000",
			 "description" => esc_html__("Please Choose Font color for your Button" , "selfie")
		  ),	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Please enter Button Title" , "selfie"),
			 "param_name" => "buttontext",
			 "value" => "Button",
			 "description" => esc_html__("The Title of your Button" , "selfie")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Please enter Button Link" , "selfie"),
			 "param_name" => "link",
			 "value" => "link",
			 "description" => esc_html__("The Link of your Button" , "selfie")
		  )	  		  
	   )
	) );
	

	/*------------------------------------------------------
	Selfie Homepage Row Wide Start - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => esc_html__("Selfie Row Wide Begin" , "selfie"),
	   "base" => "homepage_container_wide",
	   "class" => "",
	   "category" => esc_html__('Content' , "selfie"),
	   "params" => array(
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Font color" , "selfie"),
			 "param_name" => "font",
			 "value" => "#787878",
			 "description" => esc_html__("Please Choose Font color for your Row" , "selfie")
		  )
	   )
	) );
	


	/*------------------------------------------------------
	Selfie Skills - VC
	-------------------------------------------------------*/	
	vc_map( array(
	   "name" => esc_html__("Selfie Skills" , "selfie"),
	   "base" => "selfie_skills",
	   "class" => "",
	   "category" => esc_html__('Content' , "selfie"),
	   "params" => array(
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Numbers of Skills Items" , "selfie"),
			 "param_name" => "number",
			 "value" => "6",
			 "description" => esc_html__("Enter Number of Skill Items to display" , "selfie")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Skills Section effect" , "selfie"),
			 "param_name" => "animation",
			 "value" => $selfie_animation_arr,
			 "description" => esc_html__("Here you will choose Skills Section Animation effect" , "selfie")
		  )		
	   )
	) );		
	
	
	/*------------------------------------------------------
	Selfie Homepage Row End - VC
	-------------------------------------------------------*/
	
	vc_map( array(
	   "name" => esc_html__("Selfie Row End" , "selfie"),
	   "base" => "homepage_container_end",
	   "class" => "",
	   "show_settings_on_create" => false,   
	   "category" => esc_html__('Content' , "selfie"),
	) );


	/*------------------------------------------------------
	Selfie Process - VC
	-------------------------------------------------------*/
	
	vc_map( array(
	   "name" => esc_html__("Selfie Process" , "selfie"),
	   "base" => "selfie_process",
	   "class" => "",
	   "category" => esc_html__('Content' , "selfie"),
	   "params" => array(
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Please enter the number of processes you want to display" , "selfie"),
			 "param_name" => "noofprocesses",
			 "value" => "5",
			 "description" => esc_html__("The number of processes" , "selfie")
		  ),  
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Content color" , "selfie"),
			 "param_name" => "color",
			 "value" => "#FFF",
			 "description" => esc_html__("Please Choose Content color" , "selfie")
		  )			  
	   )
	) );

	
	/*------------------------------------------------------
	Selfie Process Element - VC
	-------------------------------------------------------*/	
	vc_map( array(
	   "name" => esc_html__("Selfie Process Timeline" , "selfie"),
	   "base" => "selfie_process_timeline",
	   "class" => "",
	   "category" => esc_html__('Content' , "selfie"),
	   "params" => array(
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Please enter the number of processes you want to display" , "selfie"),
			 "param_name" => "noofprocesses",
			 "value" => "5",
			 "description" => esc_html__("The number of processes" , "selfie")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Icon color" , "selfie"),
			 "param_name" => "iconcolor",
			 "value" => "#f7f7f7",
			 "description" => esc_html__("Please Choose Icon color" , "selfie")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Title color" , "selfie"),
			 "param_name" => "titlecolor",
			 "value" => "#f7f7f7",
			 "description" => esc_html__("Please Choose Content Title" , "selfie")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Text color" , "selfie"),
			 "param_name" => "textcolor",
			 "value" => "#f7f7f7",
			 "description" => esc_html__("Please Choose Text color" , "selfie")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Please enter process category name (if any) or keep it empty" , "selfie"),
			 "param_name" => "postcategory",
			 "value" => "",
			 "description" => esc_html__("If you entered category then only process related to this category will be retrieved" , "selfie")
		  )			  
	   )
	) );

	
	
	/*------------------------------------------------------
	Selfie Portfolio - Four per Row - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => esc_html__("Selfie Portfolio" , "selfie"),
	   "base" => "selfie_portfolio",
	   "class" => "",
	   "category" => esc_html__('Content' , "selfie"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Please enter No.# of portfolio items you want to display" , "selfie"),
			 "param_name" => "numberofposts",
			 "value" => "100",
			 "description" => esc_html__("Number of Portfolio Items to display" , "selfie")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Display Filter?" , "selfie"),
			 "param_name" => "displayoption",
			 "value" => $selfie_yes_no_arr,
			 "description" => esc_html__("If you choose YES then a filter will be displayed" , "selfie")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Please enter portfolio category name (if any) or keep it empty" , "selfie"),
			 "param_name" => "postcategory",
			 "value" => "",
			 "description" => esc_html__("If you entered category then only portfolios related to this category will be retrieved" , "selfie")
		  )		  
	   )
	) );

	
	/*------------------------------------------------------
	Selfie Blogs - Four per Row - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => esc_html__("Selfie Blogs" , "selfie"),
	   "base" => "selfie_blog",
	   "class" => "",
	   "category" => esc_html__('Content' , "selfie"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Please enter No.# of blog items you want to display" , "selfie"),
			 "param_name" => "noofposts",
			 "value" => "1",
			 "description" => esc_html__("Number of blog Items to display" , "selfie")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Please enter blog category name (if any) or keep it empty" , "selfie"),
			 "param_name" => "postcategory",
			 "value" => "",
			 "description" => esc_html__("If you entered category then only blogs related to this category will be retrieved" , "selfie")
		  )			  
	   )
	) );	
	
	/*------------------------------------------------------
	Selfie Testimonial - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => esc_html__("Selfie Testimonial" , "selfie"),
	   "base" => "selfie_testimonial",
	   "class" => "",
	   "category" => esc_html__('Content' , "selfie"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Please enter No.# of Testimonials" , "selfie"),
			 "param_name" => "noofposts",
			 "value" => "3",
			 "description" => esc_html__("Number of Testimonials to display" , "selfie")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Testimonial text color color" , "selfie"),
			 "param_name" => "fontcolor",
			 "value" => "#ffffff",
			 "description" => esc_html__("Please Choose testimonial text color" , "selfie")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Please enter slider speed" , "selfie"),
			 "param_name" => "speed",
			 "value" => "5000",
			 "description" => esc_html__("Slider Speed in Milliseconds" , "selfie")
		  ),		
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Do you want to display full text?" , "selfie"),
			 "param_name" => "length",
			 "value" => $selfie_yes_no_arr,
			 "description" => esc_html__("If yes then all the text will be displayed, else only a brief text will be displayed" , "selfie")
		  ),  		  
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Please choose animation type" , "selfie"),
			 "param_name" => "animationtype",
			 "value" => $selfie_animation_arr,
			 "description" => esc_html__("Choose animation type" , "selfie")
		  )		  
	   )
	) );


	
	/*------------------------------------------------------
	Selfie Resume - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => esc_html__("Selfie Resume Timeline" , "selfie"),
	   "base" => "selfie_resume_timeline",
	   "class" => "",
	   "category" => esc_html__('Content' , "selfie"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Please enter No.# of Present items you want to display" , "selfie"),
			 "param_name" => "noofpresent",
			 "value" => "4",
			 "description" => esc_html__("Number of Present Items to display" , "selfie")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Please enter No.# of Education items you want to display" , "selfie"),
			 "param_name" => "noofeducation",
			 "value" => "2",
			 "description" => esc_html__("Number of Education Items to display" , "selfie")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Please enter Present Items Label" , "selfie"),
			 "param_name" => "presenttext",
			 "value" => "PRESENT",
			 "description" => esc_html__("Please enter Present Items Label" , "selfie")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Please enter Education Items Label" , "selfie"),
			 "param_name" => "educationtext",
			 "value" => "Education",
			 "description" => esc_html__("Please enter Education Items Label" , "selfie")
		  )		  
	   )
	) );
	
	
	
	/*------------------------------------------------------
	Selfie Page Section - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => esc_html__("Selfie Page Section" , "selfie"),
	   "base" => "selfie_page_section",
	   "class" => "",
	   "category" => esc_html__('Content' , "selfie"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Please enter a unique ID" , "selfie"),
			 "param_name" => "id",
			 "value" => "",
			 "description" => esc_html__("This ID must be unique and should not be duplicated in this page" , "selfie")
		  )
	   )
	) );	



	/*------------------------------------------------------
	Selfie Contact Details - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => esc_html__("Selfie Contact Details" , "selfie"),
	   "base" => "selfie_contact_details",
	   "class" => "",
	   "category" => esc_html__('Content' , "selfie"),
	   "params" => array(
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Font color" , "selfie"),
			 "param_name" => "color",
			 "value" => "#333",
			 "description" => esc_html__("Please Choose Font color for your Contact Details" , "selfie")
		  ),	   
		  array(
			 "type" => "textarea",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Address Line 1" , "selfie"),
			 "param_name" => "add1",
			 "value" => "12 Segun Bagicha, 10th Floor",
			 "description" => esc_html__("Please Enter Address Line 1" , "selfie")
		  ),
		  array(
			 "type" => "textarea",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Address Line 2" , "selfie"),
			 "param_name" => "add2",
			 "value" => "Melbourne, Australia",
			 "description" => esc_html__("Please Enter Address Line 2" , "selfie")
		  ),			  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Phone Number 1" , "selfie"),
			 "param_name" => "phone1",
			 "value" => "+1 343-234-4343",
			 "description" => esc_html__("Please Enter Phone Number 1" , "selfie")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Phone Number 2" , "selfie"),
			 "param_name" => "phone2",
			 "value" => "+0 243-243-4243",
			 "description" => esc_html__("Please Enter Phone Number 2" , "selfie")
		  )	  
	   )
	) );

	
	/*------------------------------------------------------
	Selfie Social Icons Circle - VC  
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => esc_html__("Selfie Social Icons Circle" , "selfie"),
	   "base" => "selfie_social_icon_circle",
	   "class" => "",
	   "category" => esc_html__('Content' , "selfie"),
	   "params" => array(  
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Icon back color" , "selfie"),
			 "param_name" => "backcolor",
			 "value" => "#999999",
			 "description" => esc_html__("Please Choose color for Social Icon background" , "selfie")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Icon color" , "selfie"),
			 "param_name" => "color",
			 "value" => "#FFFFFF",
			 "description" => esc_html__("Please Choose color for Social Icon" , "selfie")
		  ),			  
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Please choose social icon" , "selfie"),
			 "param_name" => "socialicon",
			 "value" => $selfie_circle_social_arr,
			 "description" => esc_html__("Choose social icon" , "selfie")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Please enter your social icon URL here" , "selfie"),
			 "param_name" => "link",
			 "value" => "URL goes here",
			 "description" => esc_html__("The URL of the chosen social icon" , "selfie")
		  )	
	   )
	) );	
	
	
	

	/*------------------------------------------------------
	Selfie Social Icons - VC  
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => esc_html__("Selfie Social Icons" , "selfie"),
	   "base" => "selfie_social_icon",
	   "class" => "",
	   "category" => esc_html__('Content' , "selfie"),
	   "params" => array(
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Icon color" , "selfie"),
			 "param_name" => "color",
			 "value" => "#999999",
			 "description" => esc_html__("Please Choose color for Social Icon" , "selfie")
		  ),	 	   
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Please choose social icon" , "selfie"),
			 "param_name" => "socialicon",
			 "value" => $selfie_social_arr,
			 "description" => esc_html__("Choose social icon" , "selfie")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Please enter your social icon URL here" , "selfie"),
			 "param_name" => "link",
			 "value" => "URL goes here",
			 "description" => esc_html__("The URL of the chosen social icon" , "selfie")
		  )	
	   )
	) );

	/*------------------------------------------------------
	Selfie Alert Box - VC
	-------------------------------------------------------*/
	
	vc_map( array(
	   "name" => esc_html__("Selfie Alert Box" , "selfie"),
	   "base" => "selfie_alert_box",
	   "class" => "",
	   "category" => esc_html__('Content' , "selfie"),
	   "params" => array(	  
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Please select a Type" , "selfie"),
			 "param_name" => "type",
			 "value" => $selfie_alert_arr,
			 "description" => esc_html__("The Type of the Alert Box" , "selfie")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Alert Text" , "selfie"),
			 "param_name" => "text",
			 "value" => "Normal Message! Your Message Here",
			 "description" => esc_html__("Enter Alert Text" , "selfie")
		  )
	   )
	) );	

	/*------------------------------------------------------
	Selfie List Item - VC
	-------------------------------------------------------*/
	
	vc_map( array(
	   "name" => esc_html__("Selfie List Item" , "selfie"),
	   "base" => "selfie_list_item",
	   "class" => "",
	   "category" => esc_html__('Content' , "selfie"),
	   "params" => array(
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("List Item color" , "selfie"),
			 "param_name" => "color",
			 "value" => "#333",
			 "description" => esc_html__("Please Choose a color for your List Item" , "selfie")
		  ),		   
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Please select icon for the list item" , "selfie"),
			 "param_name" => "type",
			 "value" => $selfie_list_arr,
			 "description" => esc_html__("The Icon of your list" , "selfie")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("List Item Text" , "selfie"),
			 "param_name" => "text",
			 "value" => "List Item",
			 "description" => esc_html__("Enter List Item Text" , "selfie")
		  )
	   )
	) );		


	
	/*------------------------------------------------------
	Selfie Dropcaps - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => esc_html__("Selfie Dropcaps" , "selfie"),
	   "base" => "selfie_dropcaps",
	   "class" => "",
	   "category" => esc_html__('Content' , "selfie"),
	   "params" => array(	
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Please select Dropcaps Type" , "selfie"),
			 "param_name" => "type",
			 "value" => $selfie_dropcaps_arr,
			 "description" => esc_html__("The Type of your Dropcaps" , "selfie")
		  ),	   
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Dropcaps Character" , "selfie"),
			 "param_name" => "character",
			 "value" => "L",
			 "description" => esc_html__("Enter Dropcaps Character" , "selfie")
		  ),	   
		  array(
			 "type" => "textarea",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Dropcaps Remaining Text" , "selfie"),
			 "param_name" => "text",
			 "value" => "learn how to do awesome dropcaps with Selfie",
			 "description" => esc_html__("Enter Dropcaps Remaining Text" , "selfie")
		  )
	   )
	) );
	
	 /*------------------------------------------------------
	 Selfie Profile - VC
	 -------------------------------------------------------*/
	 
	 vc_map( array(
		"name" => esc_html__("Selfie Profile" , "selfie"),
		"base" => "selfie_profile_details",
		"class" => "",
		"category" => esc_html__('Content' , "selfie"),
		   "params" => array(			  
			  array(
				  "type" => "attach_image",
				  "holder" => "div",
				  "class" => "",
				  "heading" => esc_html__("Upload Your Photo" , "selfie"),
				  "param_name" => "personalimg",
				  "value" => "",
				  "description" => esc_html__("Please Choose a Personal Image" , "selfie")
				  ),
				  array(
				  "type" => "textfield",
				  "holder" => "div",
				  "class" => "",
				  "heading" => esc_html__("Please enter your name here" , "selfie"),
				  "param_name" => "personalname",
				  "value" => "Title goes here",
				  "description" => esc_html__("The personal name goes here" , "selfie")
				  ),
				  array(
				  "type" => "textfield",
				  "holder" => "div",
				  "class" => "",
				  "heading" => esc_html__("Please enter your Designation" , "selfie"),
				  "param_name" => "designation",
				  "value" => "Designation goes here",
				  "description" => esc_html__("Designation" , "selfie")
				  ) ,
				  array(
				  "type" => "textfield",
				  "holder" => "div",
				  "class" => "",
				  "heading" => esc_html__("Please enter your brief description here" , "selfie"),
				  "param_name" => "description",
				  "value" => "Description goes here",
				  "description" => esc_html__("Brief description about you" , "selfie")
				  ),
				  array(
					 "type" => "textfield",
					 "holder" => "div",
					 "class" => "",
					 "heading" => esc_html__("Birthdate title" , "selfie"),
					 "param_name" => "birthdatetitle",
					 "value" => "Birthdate",
					 "description" => esc_html__("Please enter your birth date title" , "selfie")
				  ),		  
				  array(
					 "type" => "textfield",
					 "holder" => "div",
					 "class" => "",
					 "heading" => esc_html__("Birthdate" , "selfie"),
					 "param_name" => "birthdate",
					 "value" => "02/09/1982",
					 "description" => esc_html__("Please enter your birth date" , "selfie")
				  ),	  
				  array(
					 "type" => "textfield",
					 "holder" => "div",
					 "class" => "",
					 "heading" => esc_html__("Phone title" , "selfie"),
					 "param_name" => "phonetitle",
					 "value" => "Phone",
					 "description" => esc_html__("Please enter your Phone title" , "selfie")
				  ),			  
				  array(
					 "type" => "textfield",
					 "holder" => "div",
					 "class" => "",
					 "heading" => esc_html__("Phone" , "selfie"),
					 "param_name" => "phone",
					 "value" => "+1 343-234-4343",
					 "description" => esc_html__("Please Enter your phone number" , "selfie")
				  ),	  
				  array(
					 "type" => "textfield",
					 "holder" => "div",
					 "class" => "",
					 "heading" => esc_html__("Email title" , "selfie"),
					 "param_name" => "emailtitle",
					 "value" => "Email",
					 "description" => esc_html__("Please enter your Email title" , "selfie")
				  ),			  
				  array(
					 "type" => "textfield",
					 "holder" => "div",
					 "class" => "",
					 "heading" => esc_html__("Email" , "selfie"),
					 "param_name" => "email",
					 "value" => "john@example.com",
					 "description" => esc_html__("Please enter your email address" , "selfie")
				  ),
				  array(
					 "type" => "textfield",
					 "holder" => "div",
					 "class" => "",
					 "heading" => esc_html__("Website title" , "selfie"),
					 "param_name" => "websitetitle",
					 "value" => "Website",
					 "description" => esc_html__("Please enter your Website title" , "selfie")
				  ),			  
				  array(
					 "type" => "textfield",
					 "holder" => "div",
					 "class" => "",
					 "heading" => esc_html__("Website" , "selfie"),
					 "param_name" => "website",
					 "value" => "www.example.com",
					 "description" => esc_html__("Please enter your website" , "selfie")
				  )
	   )	
    ));	
	
	
	 /*------------------------------------------------------
	 Selfie About Me Personal Image - VC
	 -------------------------------------------------------*/
	 
	 vc_map( array(
		"name" => esc_html__("Selfie about Me Personal Image" , "selfie"),
		"base" => "selfie_about_me_image",
		"class" => "",
		"category" => esc_html__('Content' , "selfie"),
		   "params" => array(
		      array(
				  "type" => "colorpicker",
				  "holder" => "div",
				  "class" => "",
				  "heading" => esc_html__("Name text color" , "selfie"),
				  "param_name" => "namecolor",
				  "value" => "#ffffff",
				  "description" => esc_html__("Please Choose the text color" , "selfie")
				  ),	
			  array(
				  "type" => "colorpicker",
				  "holder" => "div",
				  "class" => "",
				  "heading" => esc_html__("Content text color" , "selfie"),
				  "param_name" => "color2",
				  "value" => "#666666",
				  "description" => esc_html__("Please Choose the text color" , "selfie")
				  ),	
		      array(
				  "type" => "colorpicker",
				  "holder" => "div",
				  "class" => "",
				  "heading" => esc_html__("Text Background color" , "selfie"),
				  "param_name" => "contentcolor",
				  "value" => "#ffffff",
				  "description" => esc_html__("Please Choose the text background color" , "selfie")
				  ),				  
			  array(
				  "type" => "attach_image",
				  "holder" => "div",
				  "class" => "",
				  "heading" => esc_html__("Upload Your Photo" , "selfie"),
				  "param_name" => "personalimg",
				  "value" => "",
				  "description" => esc_html__("Please Choose a Personal Image" , "selfie")
				  ),
				  array(
				  "type" => "textfield",
				  "holder" => "div",
				  "class" => "",
				  "heading" => esc_html__("Please enter your name here" , "selfie"),
				  "param_name" => "personalname",
				  "value" => "Title goes here",
				  "description" => esc_html__("The personal name goes here" , "selfie")
				  ),
				  array(
				  "type" => "textfield",
				  "holder" => "div",
				  "class" => "",
				  "heading" => esc_html__("Please enter your Designation" , "selfie"),
				  "param_name" => "designation",
				  "value" => "Designation goes here",
				  "description" => esc_html__("Designation" , "selfie")
				  ) ,
				  array(
				  "type" => "textfield",
				  "holder" => "div",
				  "class" => "",
				  "heading" => esc_html__("Please enter your brief description here" , "selfie"),
				  "param_name" => "description",
				  "value" => "Description goes here",
				  "description" => esc_html__("Brief description about you" , "selfie")
				  ) 				  
	   )	
    ));
 
	/*------------------------------------------------------
	Selfie Contact Details - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => esc_html__("Selfie Personal Details" , "selfie"),
	   "base" => "selfie_personal_details",
	   "class" => "",
	   "category" => esc_html__('Content' , "selfie"),
	   "params" => array(
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Font color" , "selfie"),
			 "param_name" => "color",
			 "value" => "#333",
			 "description" => esc_html__("Please Choose Font color for your Personal Details" , "selfie")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Name title" , "selfie"),
			 "param_name" => "nametitle",
			 "value" => "Name",
			 "description" => esc_html__("Please enter your name title" , "selfie")
		  ),		  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Name" , "selfie"),
			 "param_name" => "name",
			 "value" => "John Doe Yurd Smith",
			 "description" => esc_html__("Please enter your full name" , "selfie")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Gender title" , "selfie"),
			 "param_name" => "gendertitle",
			 "value" => "Gender",
			 "description" => esc_html__("Please enter your gender title" , "selfie")
		  ),		  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Gender" , "selfie"),
			 "param_name" => "gender",
			 "value" => "Male",
			 "description" => esc_html__("Please enter your gender" , "selfie")
		  ),		  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Birthdate title" , "selfie"),
			 "param_name" => "birthdatetitle",
			 "value" => "Birthdate",
			 "description" => esc_html__("Please enter your birth date title" , "selfie")
		  ),		  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Birthdate" , "selfie"),
			 "param_name" => "birthdate",
			 "value" => "02/09/1982",
			 "description" => esc_html__("Please enter your birth date" , "selfie")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Born in title" , "selfie"),
			 "param_name" => "borntitle",
			 "value" => "Born in",
			 "description" => esc_html__("Please enter your born in title" , "selfie")
		  ),		  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Born in" , "selfie"),
			 "param_name" => "born",
			 "value" => "New York - United States",
			 "description" => esc_html__("Please enter your born in value" , "selfie")
		  ),		  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Phone title" , "selfie"),
			 "param_name" => "phonetitle",
			 "value" => "Phone",
			 "description" => esc_html__("Please enter your Phone title" , "selfie")
		  ),			  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Phone" , "selfie"),
			 "param_name" => "phone",
			 "value" => "+1 343-234-4343",
			 "description" => esc_html__("Please Enter your phone number" , "selfie")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Nationality title" , "selfie"),
			 "param_name" => "nationalitytitle",
			 "value" => "Nationality",
			 "description" => esc_html__("Please enter your Nationality title" , "selfie")
		  ),			  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Nationality" , "selfie"),
			 "param_name" => "nationality",
			 "value" => "American",
			 "description" => esc_html__("Please Enter your Nationality value" , "selfie")
		  ),		  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Email title" , "selfie"),
			 "param_name" => "emailtitle",
			 "value" => "Email",
			 "description" => esc_html__("Please enter your Email title" , "selfie")
		  ),			  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Email" , "selfie"),
			 "param_name" => "email",
			 "value" => "john@example.com",
			 "description" => esc_html__("Please enter your email address" , "selfie")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Website title" , "selfie"),
			 "param_name" => "websitetitle",
			 "value" => "Website",
			 "description" => esc_html__("Please enter your Website title" , "selfie")
		  ),			  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Website" , "selfie"),
			 "param_name" => "website",
			 "value" => "www.example.com",
			 "description" => esc_html__("Please enter your website" , "selfie")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Facebook title" , "selfie"),
			 "param_name" => "facebooktitle",
			 "value" => "Facebook",
			 "description" => esc_html__("Please enter your Facebook title" , "selfie")
		  ),			  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Facebook" , "selfie"),
			 "param_name" => "facebook",
			 "value" => "",
			 "description" => esc_html__("Please enter your Facebook URL" , "selfie")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("LinkedIn title" , "selfie"),
			 "param_name" => "linkedintitle",
			 "value" => "Linkedin",
			 "description" => esc_html__("Please enter your LinkedIn title" , "selfie")
		  ),			  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("LinkedIn" , "selfie"),
			 "param_name" => "linkedin",
			 "value" => "",
			 "description" => esc_html__("Please enter your LinkedIn URL" , "selfie")
		  ),		  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Twitter title" , "selfie"),
			 "param_name" => "twittertitle",
			 "value" => "Twitter",
			 "description" => esc_html__("Please enter your Twitter title" , "selfie")
		  ),			  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Twitter" , "selfie"),
			 "param_name" => "twitter",
			 "value" => "",
			 "description" => esc_html__("Please enter your Twitter URL" , "selfie")
		  ),	
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Address title" , "selfie"),
			 "param_name" => "addresstitle",
			 "value" => "Address",
			 "description" => esc_html__("Please enter your Address title" , "selfie")
		  ),		  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Address" , "selfie"),
			 "param_name" => "address",
			 "value" => "12 Segun Bagicha, 10th Floor, Dhaka 1000, Bangladesh.",
			 "description" => esc_html__("Please enter your address" , "selfie")
		  )			  
	   )
	) );

	 /*------------------------------------------------------
	 Selfie Circle Service Widget - VC
	 -------------------------------------------------------*/	 
	 vc_map( array(
		"name" => esc_html__("Selfie Circle Service Widget" , "selfie"),
		"base" => "selfie_circle_service_widget",
		"class" => "",
		"category" => esc_html__('Content' , "selfie"),
		"params" => array(
				array(
				 "type" => "dropdown",
				 "holder" => "div",
				 "class" => "",
				 "heading" => esc_html__("Please select icon for the widget" , "selfie"),
				 "param_name" => "icon",
				 "value" => $selfie_icon_arr,
				 "description" => esc_html__("The Icon of your widget" , "selfie")
				  ),
				  array(
				  "type" => "textfield",
				  "holder" => "div",
				  "class" => "",
				  "heading" => esc_html__("Please enter the Title" , "selfie"),
				  "param_name" => "title",
				  "value" => "",
				  "description" => esc_html__("Title goes here" , "selfie")
				  ),
				  array(
				  "type" => "textfield",
				  "holder" => "div",
				  "class" => "",
				  "heading" => esc_html__("Please enter Sub Title" , "selfie"),
				  "param_name" => "subtitle",
				  "value" => "",
				  "description" => esc_html__("Sub Title goes here" , "selfie")
				  ),				  
				 array(
				 "type" => "colorpicker",
				 "holder" => "div",
				 "class" => "",
				 "heading" => esc_html__("Icon color" , "selfie"),
				 "param_name" => "iconcolor",
				 "value" => "#333",
				 "description" => esc_html__("Please Choose Icon color" , "selfie")
				  ),
				 array(
				 "type" => "colorpicker",
				 "holder" => "div",
				 "class" => "",
				 "heading" => esc_html__("Icon Background color" , "selfie"),
				 "param_name" => "iconbackcolor",
				 "value" => "#333",
				 "description" => esc_html__("Please Choose Icon Background color" , "selfie")
				  ),
				 array(
				 "type" => "colorpicker",
				 "holder" => "div",
				 "class" => "",
				 "heading" => esc_html__("Text color" , "selfie"),
				 "param_name" => "textcolor",
				 "value" => "#333",
				 "description" => esc_html__("Please Choose Text color" , "selfie")
				  )					  
			  
	   )	
    ));	
	
	
	
	 /*------------------------------------------------------
	 Selfie Skills Bar - VC
	 -------------------------------------------------------*/	 
	 vc_map( array(
		"name" => esc_html__("Selfie Skills Bar" , "selfie"),
		"base" => "selfie_skills_bar",
		"class" => "",
		"category" => esc_html__('Content' , "selfie"),
		"params" => array(	
				 array(
				 "type" => "colorpicker",
				 "holder" => "div",
				 "class" => "",
				 "heading" => esc_html__("Font color" , "selfie"),
				 "param_name" => "color",
				 "value" => "#333",
				 "description" => esc_html__("Please Choose Font color for your Personal Details" , "selfie")
				  ),
				  array(
				  "type" => "textfield",
				  "holder" => "div",
				  "class" => "",
				  "heading" => esc_html__("Please enter your skill name here" , "selfie"),
				  "param_name" => "skillname",
				  "value" => "Skill Name",
				  "description" => esc_html__("The skill name goes here" , "selfie")
				  ),
				  array(
				  "type" => "textfield",
				  "holder" => "div",
				  "class" => "",
				  "heading" => esc_html__("Please enter your skill percentage" , "selfie"),
				  "param_name" => "skillpercentage",
				  "value" => "Skill percentage goes here",
				  "description" => esc_html__("Skill percentage" , "selfie")
				  ) 				  
	   )	
    ));
 
	/*------------------------------------------------------
	Selfie H1 - VC
	-------------------------------------------------------*/	
	vc_map( array(
	   "name" => esc_html__("Selfie H1" , "selfie"),
	   "base" => "selfie_heading_one",
	   "class" => "",
	   "category" => esc_html__('Content' , "selfie"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Heading Title" , "selfie"),
			 "param_name" => "text",
			 "value" => "",
			 "description" => esc_html__("Enter Heading Title" , "selfie")
		  )
	   )
	) );		

	/*------------------------------------------------------
	Selfie H2 - VC
	-------------------------------------------------------*/	
	vc_map( array(
	   "name" => esc_html__("Selfie H2" , "selfie"),
	   "base" => "selfie_heading_two",
	   "class" => "",
	   "category" => esc_html__('Content' , "selfie"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Heading Title" , "selfie"),
			 "param_name" => "text",
			 "value" => "",
			 "description" => esc_html__("Enter Heading Title" , "selfie")
		  )
	   )
	) );		

	/*------------------------------------------------------
	Selfie H3 - VC
	-------------------------------------------------------*/	
	vc_map( array(
	   "name" => esc_html__("Selfie H3" , "selfie"),
	   "base" => "selfie_heading_three",
	   "class" => "",
	   "category" => esc_html__('Content' , "selfie"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Heading Title" , "selfie"),
			 "param_name" => "text",
			 "value" => "",
			 "description" => esc_html__("Enter Heading Title" , "selfie")
		  )
	   )
	) );	

	
	/*------------------------------------------------------
	Selfie H4 - VC
	-------------------------------------------------------*/	
	vc_map( array(
	   "name" => esc_html__("Selfie H4" , "selfie"),
	   "base" => "selfie_heading_four",
	   "class" => "",
	   "category" => esc_html__('Content' , "selfie"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Heading Title" , "selfie"),
			 "param_name" => "text",
			 "value" => "",
			 "description" => esc_html__("Enter Heading Title" , "selfie")
		  )
	   )
	) );

	/*------------------------------------------------------
	Selfie H5 - VC
	-------------------------------------------------------*/	
	vc_map( array(
	   "name" => esc_html__("Selfie H5" , "selfie"),
	   "base" => "selfie_heading_five",
	   "class" => "",
	   "category" => esc_html__('Content' , "selfie"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Heading Title" , "selfie"),
			 "param_name" => "text",
			 "value" => "",
			 "description" => esc_html__("Enter Heading Title" , "selfie")
		  )
	   )
	) );	
	

	/*------------------------------------------------------
	Selfie H6 - VC
	-------------------------------------------------------*/	
	vc_map( array(
	   "name" => esc_html__("Selfie H6" , "selfie"),
	   "base" => "selfie_heading_six",
	   "class" => "",
	   "category" => esc_html__('Content' , "selfie"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Heading Title" , "selfie"),
			 "param_name" => "text",
			 "value" => "",
			 "description" => esc_html__("Enter Heading Title" , "selfie")
		  )
	   )
	) );

}




/*------------------------------------------------------
Selfie WooCommerce Functions - Started
-------------------------------------------------------*/
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	if (class_exists('Woocommerce')) {
		ob_start();

		?>
			<a href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>" class="dropdown-toggle selfie-cart-contents" data-toggle="dropdown">
				<i class="fa fa-shopping-cart"></i> <span class="label label-primary"><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, "selfie"), $woocommerce->cart->cart_contents_count);?></span>
			</a>		
		<?php
		
		$fragments['a.selfie-cart-contents'] = ob_get_clean();

		return $fragments;
	}
} 

/*------------------------------------------------------
Selfie WooCommerce Functions - End
-------------------------------------------------------*/




/*------------------------------------------------------
Selfie Add WooCommece Cart to Header - Started
-------------------------------------------------------*/
function selfie_get_header_cart(){
	
	$sentient_cart = '';
	if (class_exists('Woocommerce')) {
		global $woocommerce;
		
		do_action( 'woocommerce_before_mini_cart' );
		
		$sentient_cart .= '<ul class="cart_list product_list_widget dropdown-menu">';

			if ( sizeof( WC()->cart->get_cart() ) > 0 ) {

					foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
						$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
						$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

						if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

							$product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
							$thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
							$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );


							$sentient_cart .= '<li>
								<a href="'. esc_url(get_permalink( $product_id )) .'">
									'. $thumbnail . $product_name .'
								</a>

								'. WC()->cart->get_item_data( $cart_item ) .'

								'. apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ) .'
							</li>';

						}
					}


			} else { 
				$sentient_cart_title = __('No products in the cart.', 'selfie' );
				$sentient_cart .= '<li class="empty">'. $sentient_cart_title .'</li>';

			}

		$sentient_cart .= '</ul>';

		if ( sizeof( WC()->cart->get_cart() ) > 0 ) {
			
			$sentient_Subtotal = __( 'Subtotal', 'selfie' );
			$sentient_view = __( 'View Cart', 'selfie' );
			$sentient_checkout = __( 'Checkout', 'selfie' );
			
			$sentient_cart .= '<p class="total"><strong>'. $sentient_Subtotal .':</strong> '. WC()->cart->get_cart_subtotal() .'</p>';

			do_action( 'woocommerce_widget_shopping_cart_before_buttons' );

			$sentient_cart .='<p class="buttons">
				<a href="'. esc_url(WC()->cart->get_cart_url()) .'" class="button wc-forward">'. $sentient_view .'</a>
				<a href="'. esc_url(WC()->cart->get_checkout_url()) .'" class="button checkout wc-forward">' . $sentient_checkout . '</a>
			</p>';
			
		}

		do_action( 'woocommerce_after_mini_cart' ); 

	}
	
	return $sentient_cart;
}
/*------------------------------------------------------
Selfie Add WooCommece Cart to Header - End
-------------------------------------------------------*/



/*------------------------------------------------------
Selfie Get Option Value - Started
-------------------------------------------------------*/
function selfie_get_option_value($selfie_option_name){	
	global $prof_default;
	return of_get_option($selfie_option_name,$prof_default);;
}
/*------------------------------------------------------
Selfie Get Option Value - End
-------------------------------------------------------*/


/*------------------------------------------------------
Selfie Sidebar Functions - Started
-------------------------------------------------------*/

if ( function_exists('register_sidebar') ){
	function selfie_widgets_init() {
		register_sidebar(array(
			'name' => 'Default Sidebar',
			'id' => 'default',			
			'description'   => 'This sidebar can be chosen for any page',	
			'before_widget' => '<aside id="%1$s" class="widget %2$s">' ,
			'after_widget' =>  '</aside>',
			'before_title' => '<div class="widget-title"><h3>',
			'after_title' => '</h3></div>',	
		));
		/************************/
		register_sidebar(array(
			'name' => 'Blog Right Sidebar',
			'id' => 'Blog-Right-Sidebar',
			'description'   => 'This sidebar can be chosen for Blog with right sidebar template or any other templates',	
			'before_widget' => '<aside id="%1$s" class="widget %2$s">' ,
			'after_widget' =>  '</aside>',
			'before_title' => '<div class="widget-title"><h3>',
			'after_title' => '</h3></div>',	
		));
		/************************/
		register_sidebar(array('name'=>'Blog Left Sidebar',
			'id' => 'Blog-Left-Sidebar',
			'description'   => 'This sidebar can be chosen for Blog with left sidebar template or any other templates',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">' ,
			'after_widget' =>  '</aside>',
			'before_title' => '<div class="widget-title"><h3>',
			'after_title' => '</h3></div>',	
		));
		/************************/
		register_sidebar(array('name'=>'Blog Single Sidebar',
			'id' => 'Blog-Single-Sidebar',
			'description'   => 'This sidebar can be chosen for single Blog page or any other templates',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">' ,
			'after_widget' =>  '</aside>',
			'before_title' => '<div class="widget-title"><h3>',
			'after_title' => '</h3></div>',	

		));
		/************************/
		register_sidebar(array('name'=>'Page Right Sidebar',
			'id' => 'Page-Right-Sidebar',
			'description'   => 'This sidebar can be chosen for any Page with right sidebar or any other pages',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">' ,
			'after_widget' =>  '</aside>',
			'before_title' => '<div class="widget-title"><h3>',
			'after_title' => '</h3></div>',	
		));
		/************************/
		register_sidebar(array('name'=>'Page Left Sidebar',
			'id' => 'Page-Left-Sidebar',	
			'description'   => 'This sidebar can be chosen for any Page with left sidebar or any other pages',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">' ,
			'after_widget' =>  '</aside>',
			'before_title' => '<div class="widget-title"><h3>',
			'after_title' => '</h3></div>',	

		));
		/************************/
		register_sidebar(array('name'=>'Extra Sidebar I',
			'id' => 'Extra-Sidebar-I',
			'description'   => 'Extra sidebar that can be chosen for any Page/Post/Template',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">' ,
			'after_widget' =>  '</aside>',
			'before_title' => '<div class="widget-title"><h3>',
			'after_title' => '</h3></div>',	


		));
		/************************/
		register_sidebar(array('name'=>'Extra Sidebar II',
			'id' => 'Extra-Sidebar-II',	
			'description'   => 'Extra sidebar that can be chosen for any Page/Post/Template',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">' ,
			'after_widget' =>  '</aside>',
			'before_title' => '<div class="widget-title"><h3>',
			'after_title' => '</h3></div>',	


		));
		/************************/
		register_sidebar(array('name'=>'Extra Sidebar III',
			'id' => 'Extra-Sidebar-III',
			'description'   => 'Extra sidebar that can be chosen for any Page/Post/Template',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">' ,
			'after_widget' =>  '</aside>',
			'before_title' => '<div class="widget-title"><h3>',
			'after_title' => '</h3></div>',	
		));
		/************************/
		register_sidebar(array('name'=>'FooterColI',
			'id' => 'FooterColI',				
			'description'   => 'Extra widget that can be chosen for Footer Col I',
			'before_widget' => '<aside id="%1$s" class="widget footer-widget %2$s">' ,
			'after_widget' =>  '</aside>',
			'before_title' => '<div class="widget-title"><h3>',
			'after_title' => '</h3></div>',	
		));
		/************************/
		register_sidebar(array('name'=>'FooterColII',
			'id' => 'FooterColII',						
			'description'   => 'Extra widget that can be chosen for Footer Col II',
			'before_widget' => '<aside id="%1$s" class="widget footer-widget %2$s">' ,
			'after_widget' =>  '</aside>',
			'before_title' => '<div class="widget-title"><h3>',
			'after_title' => '</h3></div>',	
		));
		/************************/
		register_sidebar(array('name'=>'FooterColIII',
			'id' => 'FooterColIII',						
			'description'   => 'Extra widget that can be chosen for Footer Col III',
			'before_widget' => '<aside id="%1$s" class="widget footer-widget %2$s">' ,
			'after_widget' =>  '</aside>',
			'before_title' => '<div class="widget-title"><h3>',
			'after_title' => '</h3></div>',	
		));
		/************************/
		register_sidebar(array('name'=>'FooterColIV',
			'id' => 'FooterColIV',				
			'description'   => 'Extra widget that can be chosen for Footer Col IV',
			'before_widget' => '<aside id="%1$s" class="widget footer-widget %2$s">' ,
			'after_widget' =>  '</aside>',
			'before_title' => '<div class="widget-title"><h3>',
			'after_title' => '</h3></div>',	
		));	
		/************************/
		register_sidebar(array('name'=>'HeaderWidget',
			'id' => 'HeaderWidget',				
			'description'   => 'Header Widget can be used for Language Selector',
			'before_widget' => '<div id="%1$s" class="header-widget %2$s">' ,
			'after_widget' =>  '</div>',
			'before_title' => '<div class="header-widget-title">',
			'after_title' => '</div>',	
		));				
	}
}
add_action( 'widgets_init', 'selfie_widgets_init' );
/*------------------------------------------------------
Selfie Sidebar Functions - End
-------------------------------------------------------*/



/*------------------------------------------------------
Selfie, Add Portfolio Thumbnail URL option - Started
-------------------------------------------------------*/

function selfie_get_portfolio_thumbnail_url($pid){  
    $image_id = get_post_thumbnail_id($pid);  
    $image_url = wp_get_attachment_image_src($image_id,'screen-shot');  
    return  $image_url[0];  
}  

/*------------------------------------------------------
Selfie, Add Portfolio Thumbnail URL option - End
-------------------------------------------------------*/



/*------------------------------------------------------
Selfie, Adds a box to the side column on the Post and Page edit screens - Started
-------------------------------------------------------*/
function selfie_add_sidebar_metabox()  
{  
    add_meta_box(  
        'custom_sidebar',  
        esc_html__( 'Custom Sidebar', 'selfie' ),  
        'selfie_custom_sidebar_callback',  
        'post',  
        'side'  
    );  
    add_meta_box(
        'custom_sidebar',  
        esc_html__( 'Custom Sidebar', 'selfie' ),  
        'selfie_custom_sidebar_callback',  
        'page',  
        'side'  
    );  
    add_meta_box(
        'custom_sidebar',  
        esc_html__( 'Custom Sidebar', 'selfie' ),  
        'selfie_custom_sidebar_callback',  
        'project',  
        'side'  
    );

} 



function selfie_custom_sidebar_callback( $post )  
{  
    global $wp_registered_sidebars;  
      
    $custom = get_post_custom($post->ID);  
      
    if(isset($custom['custom_sidebar']))  
        $val = $custom['custom_sidebar'][0];  
    else  
        $val = "default";  
  
    /* Use nonce for verification  */
    wp_nonce_field( plugin_basename( __FILE__ ), 'custom_sidebar_nonce' );  
  
    /* The actual fields for data entry */
    $output = '<p><label for="myplugin_new_field">'. esc_html__("Choose a sidebar to display", 'selfie' ) .'</label></p>';  
    $output .= "<select name='custom_sidebar'>"; 
	
      
    /* Fill the select element with all registered sidebars  */
    foreach($wp_registered_sidebars as $sidebar_id => $sidebar)  
    {  
        $output .= "<option";  
        if($sidebar_id == $val)  
            $output .= " selected='selected'";  
        $output .= " value='". esc_attr($sidebar_id) ."'>". esc_attr($sidebar['name']) ."</option>";  
    }  
    
    $output .= "</select>";  
      
	  
	echo wp_kses( $output, array(
		'p' => array(),		
		'label' => array(
			'for' => array()			
		),
		'select' => array(
			'name' => array()			
		),
		'option' => array(
			'selected' => array(),
			'value' => array()			
		)
	) );	  

}

function selfie_save_sidebar_postdata( $post_id )  
{  
    /* verify if this is an auto save routine.   */
    /* If it is our form has not been submitted, so we dont want to do anything  */
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )   
      return;  
  
    /* verify this came from our screen and with proper authorization,  */
    /* because save_post can be triggered at other times  */
  
	if(isset ($_POST['custom_sidebar_nonce'])){
		if ( !wp_verify_nonce( $_POST['custom_sidebar_nonce'], plugin_basename( __FILE__ ) ) )  
		  return; 
	}   
  
    if ( !current_user_can( 'edit_page', $post_id ) )  
        return;  
  
	if(isset ($_POST['custom_sidebar'])){
		$data = $_POST['custom_sidebar'];  
		update_post_meta($post_id, "custom_sidebar", $data);
	}     
}  
/*------------------------------------------------------
Selfie, Adds a box to the side column on the Post and Page edit screens - End
-------------------------------------------------------*/






if(!function_exists('selfie_backend_theme_activation'))
{
	/**
	 *  This function gets executed if the theme just got activated. It resets the global frontpage setting
	 *  and then redirects the user to the framework main options page
	 */
	function selfie_backend_theme_activation()
	{
		global $pagenow;
		if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) )
		{

			/*provide hook so themes can execute theme specific functions on activation*/
			do_action('selfie_backend_theme_activation');

			/*redirect to options page*/
			header( 'Location: '.admin_url().'themes.php?page=options-framework' ) ;
		}
	}

	add_action('admin_init','selfie_backend_theme_activation');
}




/*------------------------------------------------------
Selfie Walker_Nav_Menu - Started
-------------------------------------------------------*/
class selfie_description_walker extends Walker_Nav_Menu
{
	
	  function start_lvl(&$output, $depth= 0, $args = array()) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"dropdown-menu clearfix\">\n";
	  }
	  function end_lvl(&$output, $depth= 0, $args = array()) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	  }

	  function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 )
      {
           global $wp_query;

           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		   
		   $output .= '';
			
           $class_names = $value = '';

           $classes = empty( $item->classes ) ? array() : (array) $item->classes;
			
			/* Has children */
			$children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));
			if (empty($children)) {
				$toggleClass = '';
			} else {
				$toggleClass = 'dropdown-toggle nav-toggle';
			}				
			
           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
           $class_names = ' class="'. esc_attr( $class_names . ' ' . $toggleClass ) . '"';
		   
           $output .= $indent . '<li ' . $value . $class_names .'>';

           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
           $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		   
		   
           $prepend = '';
           $append = '';
		   
           $description  = ! empty( $item->description ) ? '<span class="menu-item-description">'.esc_attr( $item->description ).'</span>' : '';

           if($depth != 0)
           {
                     $description = $append = $prepend = "";
           }

			
			$item_output = $args->before;
			$item_output .= '<a'. $attributes .'>';
			$item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
			$item_output .= $description.$args->link_after;
			$item_output .= '</a>';
			$item_output .= $args->after;
			
            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
      }
}


class selfie_inner_walker extends Walker_Nav_Menu
{
	
	  function start_lvl(&$output, $depth= 0, $args = array()) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"dropdown-menu clearfix\">\n";
	  }
	  function end_lvl(&$output, $depth= 0, $args = array()) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	  }

	  function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 )
      {
           global $wp_query;

           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		   
		   $output .= '';
			
           $class_names = $value = '';

           $classes = empty( $item->classes ) ? array() : (array) $item->classes;
			
			/* Has children */
			$children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));
			if (empty($children)) {
				$toggleClass = '';
			} else {
				$toggleClass = 'dropdown-toggle nav-toggle';
			}				
			
           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
           $class_names = ' class="'. esc_attr( $class_names . ' ' . $toggleClass ) . '"';
		   
			if (substr($item->url, 0, 1) === '#') {
				$itemURL = home_url( '/' ) . $item->url;
			} else {
				$itemURL = $item->url;
			}

		   
           $output .= $indent . '<li ' . $value . $class_names .'>';

           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
           $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $itemURL        ) .'"' : '';
		   
		   
           $prepend = '';
           $append = '';
		   
           $description  = ! empty( $item->description ) ? '<span class="menu-item-description">'.esc_attr( $item->description ).'</span>' : '';

           if($depth != 0)
           {
                     $description = $append = $prepend = "";
           }

			
			$item_output = $args->before;
			$item_output .= '<a'. $attributes .'>';
			$item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
			$item_output .= $description.$args->link_after;
			$item_output .= '</a>';
			$item_output .= $args->after;
			
            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
      }
}
/*------------------------------------------------------
Selfie Walker_Nav_Menu - End
-------------------------------------------------------*/









/*------------------------------------------------------
Selfie News Widget - Begin
-------------------------------------------------------*/
class Selfie_News_Widget extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'SelfieNewsWidget', 'description' => 'Insert your News' );
	
		parent::__construct(
			'Selfie_News_Widget',
			__( 'Selfie News Widget', 'selfie' ),
			array( 'description' => __( 'Insert your News', 'selfie' ), $widget_ops )
		);
	} 


	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];			
		}
		
		echo Selfie_News_Widget_value($instance['number']);
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( '', 'selfie' );
		$number = ! empty( $instance['number'] ) ? $instance['number'] : __( '1', 'selfie' );
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , "Selfie"); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts:' , "Selfie"); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>">
		</p>		
		<?php 
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['number'] = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '';

		return $instance;
	}
}
/*------------------------------------------------------
Selfie News Widget - End
-------------------------------------------------------*/


/*------------------------------------------------------
Selfie Widget News Function - Begin
-------------------------------------------------------*/
function Selfie_News_Widget_value($noofposts) {
	global $prof_default;
	
	$loop = new WP_Query(array('post_type' => 'post', 'posts_per_page' => $noofposts));
	$return_string = '<div id="selfie-news-feed">';
			
	if ( $loop ) :   
	while ( $loop->have_posts() ) : $loop->the_post();
	$feat_image = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );

	$return_string .= '
                    <div class="selfie-news-article">
                        <div class="selfie-news-pic">
                            <a href="' . $feat_image . '" class="modal-image">
								' . get_the_post_thumbnail( get_the_ID() , "thumbnail" ) . '                                
                            </a>
                            <div class="selfiew-news-time"><a href="' . esc_url( get_permalink()) . '">' . get_the_time('j') . ' ' . get_the_time('M') . '</a></div>
                        </div>
                        <div class="selfie-news-text">
                            <div class="selfie-newsprofilelink">
                                <strong><a href="' . esc_url( get_permalink()) . '">'. get_the_title() .'</a></strong>
                            </div>
                            <p>' . strip_shortcodes(wp_trim_words( get_the_content(), 7 )) . '</p>
                        </div>
                    </div>';
	endwhile;
	endif;		
	
	$return_string .= '</div>';
	return $return_string;
	wp_reset_postdata();					
}
/*------------------------------------------------------
Selfie Widget News Function - End
-------------------------------------------------------*/




/*------------------------------------------------------
Selfie Socials Function - Begin
-------------------------------------------------------*/
function Selfie_Socials_Widget_value() {
	global $prof_default;

	if(of_get_option('facebook_user_account',$prof_default) != ''){
		$facebook = '<div style="background:#3b5998;" class="social-icon social-icon-circle">
							<a style="color:#fff !important;" target="_blank" href="' . esc_url(of_get_option('facebook_user_account',$prof_default)) . '"><i class="fa fa-facebook fa-3x"></i></a>
					</div>';
	}else{
		$facebook = '';
	}
	
	if(of_get_option('twitter_user_account',$prof_default) != ''){
		$twitter = '<div style="background:#00aced;" class="social-icon social-icon-circle">
							<a style="color:#fff !important;" target="_blank" href="' . esc_url(of_get_option('twitter_user_account',$prof_default)) . '"><i class="fa fa-twitter fa-3x"></i></a>
					</div>';
	}else{
		$twitter = '';
	}
	if(of_get_option('dribbble_user_account',$prof_default) != ''){
		$dribbble = '<div style="background:#C73B6F;" class="social-icon social-icon-circle">
							<a style="color:#fff !important;" target="_blank" href="' . esc_url(of_get_option('dribbble_user_account',$prof_default)) . '"><i class="fa fa-dribbble fa-3x"></i></a>
					</div>';
	}else{
		$dribbble = '';
	}
	if(of_get_option('pinterest_user_account',$prof_default) != ''){
		$pinterest = '<div style="background:#C92228;" class="social-icon social-icon-circle">
							<a style="color:#fff !important;" target="_blank" href="' . esc_url(of_get_option('pinterest_user_account',$prof_default)) . '"><i class="fa fa-pinterest fa-3x"></i></a>
					</div>';
	}else{
		$pinterest = '';
	}
	if(of_get_option('linkedin_user_account',$prof_default) != ''){
		$linkedin = '<div style="background:#007bb5;" class="social-icon social-icon-circle">
							<a style="color:#fff !important;" target="_blank" href="' . esc_url(of_get_option('linkedin_user_account',$prof_default)) . '"><i class="fa fa-linkedin fa-3x"></i></a>
					</div>';
	}else{
		$linkedin = '';
	}
	if(of_get_option('rss_user_account',$prof_default) != ''){
		$rss = '<div style="background:#FF6600;" class="social-icon social-icon-circle">
							<a style="color:#fff !important;" target="_blank" href="' . esc_url(of_get_option('rss_user_account',$prof_default)) . '"><i class="fa fa-rss fa-3x"></i></a>
				</div>';
	}else{
		$rss = '';
	}
	if(of_get_option('skype_user_account',$prof_default) != ''){
		$skype = '<div style="background:#12A5F4;" class="social-icon social-icon-circle">
							<a style="color:#fff !important;" target="_blank" href="' . esc_url(of_get_option('skype_user_account',$prof_default)) . '"><i class="fa fa-skype fa-3x"></i></a>
				</div>';
	}else{
		$skype = '';
	}
	if(of_get_option('deviantart_user_account',$prof_default) != ''){
		$deviantart = '<div style="background:#4e6252;" class="social-icon social-icon-circle">
							<a style="color:#fff !important;" target="_blank" href="' . esc_url(of_get_option('deviantart_user_account',$prof_default)) . '"><i class="fa fa-deviantart fa-3x"></i></a>
				</div>';
	}else{
		$deviantart = '';
	}
	if(of_get_option('youtube_user_account',$prof_default) != ''){
		$youtube = '<div style="background:#c4302b;" class="social-icon social-icon-circle">
							<a style="color:#fff !important;" target="_blank" href="' . esc_url(of_get_option('youtube_user_account',$prof_default)) . '"><i class="fa fa-youtube fa-3x"></i></a>
				</div>';
	}else{
		$youtube = '';
	}
	if(of_get_option('instagram_user_account',$prof_default) != ''){
		$instagram = '<div style="background:#3f729b;" class="social-icon social-icon-circle">
							<a style="color:#fff !important;" target="_blank" href="' . esc_url(of_get_option('instagram_user_account',$prof_default)) . '"><i class="fa fa-instagram fa-3x"></i></a>
				</div>';
	}else{
		$instagram = '';
	}	
	if(of_get_option('google_user_account',$prof_default) != ''){
		$google = '<div style="background:#dd4b39;" class="social-icon social-icon-circle">
							<a style="color:#fff !important;" target="_blank" href="' . esc_url(of_get_option('google_user_account',$prof_default)) . '"><i class="fa fa-google-plus fa-3x"></i></a>
				</div>';
	}else{
		$google = '';
	}
	 return '<div class="selfie-social-icons">
				' . $facebook . '
				' . $twitter . '
				' . $dribbble . '
				' . $pinterest . '
				' . $linkedin . '
				' . $rss . '
				' . $skype . '
				' . $deviantart . '
				' . $youtube . '
				' . $google	. '
				' . $instagram . '
             </div>';
				
}
/*------------------------------------------------------
Selfie Socials Function - End
-------------------------------------------------------*/





/*------------------------------------------------------
Selfie Socials Widget - Begin
-------------------------------------------------------*/
class Selfie_Socials_Widget extends WP_Widget {
	
	function __construct() {
		$widget_ops = array('classname' => 'SelfieSocialsWidget', 'description' => 'Insert your Socials' );
	
		parent::__construct(
			'Selfie_Socials_Widget',
			__( 'Selfie Socials Widget', 'selfie' ),
			array( 'description' => __( 'Insert your Socials', 'selfie' ), $widget_ops )
		);
	} 	
	

	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}
		echo Selfie_Socials_Widget_value();
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( '', 'selfie' );
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , "Selfie"); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}

}
/*------------------------------------------------------
Selfie Socials Widget - End
-------------------------------------------------------*/






/*------------------------------------------------------
Selfie Register Contact Widget - Begin
-------------------------------------------------------*/
function Register_Selfie_Contact_Widget() {
	register_widget( 'Selfie_News_Widget' );
	register_widget( 'Selfie_Socials_Widget' );
}
add_action( 'widgets_init', 'Register_Selfie_Contact_Widget' );
/*------------------------------------------------------
Selfie Register Contact Widget - End
-------------------------------------------------------*/





/*------------------------------------------------------
Selfie , Add Custom Fields to the Post Formats (add_action) - Started
-------------------------------------------------------*/
add_action( 'admin_menu', 'selfie_testimonial_company_field' );
add_action( 'save_post', 'selfie_save_testimonial_company_field', 10, 2 );

add_action( 'admin_menu', 'selfie_portfolio_post_format_client_link' );
add_action( 'save_post', 'selfie_save_portfolio_post_format_client_link', 10, 2 );

add_action( 'admin_menu', 'selfie_testimonial_post_format_company_link' );
add_action( 'save_post', 'selfie_save_testimonial_post_format_company_link', 10, 2 );

add_action( 'admin_menu', 'selfie_testimonial_post_format_person_position' );
add_action( 'save_post', 'selfie_save_testimonial_post_format_person_position', 10, 2 );

add_action( 'admin_menu', 'selfie_portfolio_post_format_client_name' );
add_action( 'save_post', 'selfie_save_portfolio_post_format_client_name', 10, 2 );

add_action( 'admin_menu', 'selfie_post_format_facebook_field' );
add_action( 'save_post', 'selfie_save_post_format_facebook_field', 10, 2 );

add_action( 'admin_menu', 'selfie_post_format_twitter_field' );
add_action( 'save_post', 'selfie_save_post_format_twitter_field', 10, 2 );

add_action( 'admin_menu', 'selfie_post_format_flickr_field' );
add_action( 'save_post', 'selfie_save_post_format_flickr_field', 10, 2 );

add_action( 'admin_menu', 'selfie_post_format_linkedin_field' );
add_action( 'save_post', 'selfie_save_post_format_linkedin_field', 10, 2 );

add_action( 'admin_menu', 'selfie_post_format_google_field' );
add_action( 'save_post', 'selfie_save_post_format_google_fieldw', 10, 2 );

add_action( 'admin_menu', 'selfie_post_format_pinterest_field' );
add_action( 'save_post', 'selfie_save_post_format_pinterest_field', 10, 2 );

add_action( 'admin_menu', 'selfie_video_post_format_URL_field' );
add_action( 'save_post', 'selfie_save_video_post_format_URL_field', 10, 2 );

add_action( 'admin_menu', 'selfie_audio_post_format_URL_field' );
add_action( 'save_post', 'selfie_save_audio_post_format_URL_field', 10, 2 );

add_action( 'admin_menu', 'selfie_gallery_post_format_URL_field' );
add_action( 'save_post', 'selfie_save_gallery_post_format_URL_field', 10, 2 );

add_action( 'admin_menu', 'post_icons_list' );
add_action( 'save_post', 'selfie_post_save_icons_list', 10, 2 );

add_action( 'admin_menu', 'selfie_present_position' );
add_action( 'save_post', 'selfie_present_save_position', 10, 2 );

add_action( 'admin_menu', 'selfie_present_period' );
add_action( 'save_post', 'selfie_present_save_period', 10, 2 );

add_action( 'admin_menu', 'selfie_education_university' );
add_action( 'save_post', 'selfie_education_save_university', 10, 2 );

add_action( 'admin_menu', 'selfie_skill_value_field' );
add_action( 'save_post', 'selfie_save_skill_value_field', 10, 2 );

add_action( 'admin_menu', 'selfie_team_post_format_member_position' );
add_action( 'save_post', 'selfie_save_team_post_format_member_position', 10, 2 );

add_action( 'admin_menu', 'team_skilltitleone_field' );
add_action( 'save_post', 'team_save_skilltitleone_field', 10, 2 );

add_action( 'admin_menu', 'team_skillpercentageone_field' );
add_action( 'save_post', 'team_save_skillpercentageone_field', 10, 2 );

add_action( 'admin_menu', 'team_skilltitletwo_field' );
add_action( 'save_post', 'team_save_skilltitletwo_field', 10, 2 );

add_action( 'admin_menu', 'team_skillpercentagetwo_field' );
add_action( 'save_post', 'team_save_skillpercentagetwo_field', 10, 2 );

add_action( 'admin_menu', 'team_skilltitlethree_field' );
add_action( 'save_post', 'team_save_skilltitlethree_field', 10, 2 );

add_action( 'admin_menu', 'team_skillpercentagethree_field' );
add_action( 'save_post', 'team_save_skillpercentagethree_field', 10, 2 );

add_action( 'admin_menu', 'selfie_team_socialone_field' );
add_action( 'save_post', 'selfie_team_save_socialone_field', 10, 2 );

add_action( 'admin_menu', 'selfie_team_socialone_link' );
add_action( 'save_post', 'selfie_team_save_socialone_link', 10, 2 );

add_action( 'admin_menu', 'selfie_team_socialtwo_field' );
add_action( 'save_post', 'selfie_team_save_socialtwo_field', 10, 2 );

add_action( 'admin_menu', 'selfie_team_socialtwo_link' );
add_action( 'save_post', 'selfie_team_save_socialtwo_link', 10, 2 );

add_action( 'admin_menu', 'selfie_team_socialthree_field' );
add_action( 'save_post', 'selfie_team_save_socialthree_field', 10, 2 );

add_action( 'admin_menu', 'selfie_team_socialthree_link' );
add_action( 'save_post', 'selfie_team_save_socialthree_link', 10, 2 );



/*------------------------------------------------------
Selfie , Add Custom Fields to the Post Formats (add_action) - End
-------------------------------------------------------*/



/*------------------------------------------------------
Selfie , Add Custom Fields to the Post Formats (Create Fields) - Started
-------------------------------------------------------*/
function selfie_testimonial_company_field() {
	add_meta_box( 'selfie-testimonial_company-box', 'Testimonial Person Company Name', 'selfie_create_testimonial_company_field', 'testimonial', 'normal', 'high' );
}
function selfie_portfolio_post_format_client_link() {
	add_meta_box( 'my-projectlink-box', 'Project URL', 'selfie_create_portfolio_post_format_client_link', 'portfolio', 'normal', 'high' );
}
function selfie_testimonial_post_format_company_link() {
	add_meta_box( 'selfie-test-company-link', 'Company URL', 'selfie_create_testimonial_post_format_company_link', 'testimonial', 'normal', 'high' );
}
function selfie_testimonial_post_format_person_position() {
	add_meta_box( 'my-test-position-box', 'Person Position', 'selfie_create_testimonial_post_format_person_position', 'testimonial', 'normal', 'high' );
}
function selfie_portfolio_post_format_client_name() {
	add_meta_box( 'my-projectdescription-box', 'Project Client', 'selfie_create_portfolio_post_format_client_name', 'portfolio', 'normal', 'high' );
}
function selfie_post_format_facebook_field() {
	add_meta_box( 'my-facebook-box', 'Facebook URL', 'selfie_create_post_format_facebook_field', 'post', 'normal', 'high' );
	add_meta_box( 'my-facebook-box', 'Facebook URL', 'selfie_create_post_format_facebook_field', 'portfolio', 'normal', 'high' );
}
function selfie_post_format_twitter_field() {
	add_meta_box( 'my-twitter-box', 'Twitter URL', 'selfie_create_post_format_twitter_field', 'post', 'normal', 'high' );
	add_meta_box( 'my-twitter-box', 'Twitter URL', 'selfie_create_post_format_twitter_field', 'portfolio', 'normal', 'high' );
}
function selfie_post_format_flickr_field() {
	add_meta_box( 'my-flickr-box', 'Flickr URL', 'selfie_create_post_format_flickr_field', 'portfolio', 'normal', 'high' );
	add_meta_box( 'my-flickr-box', 'Flickr URL', 'selfie_create_post_format_flickr_field', 'post', 'normal', 'high' );
}
function selfie_post_format_linkedin_field() {
	add_meta_box( 'my-linkedin-box', 'LinkedIn URL', 'selfie_create_post_format_linkedin_field', 'post', 'normal', 'high' );
	add_meta_box( 'my-linkedin-box', 'LinkedIn URL', 'selfie_create_post_format_linkedin_field', 'portfolio', 'normal', 'high' );
}
function selfie_post_format_pinterest_field() {	
	add_meta_box( 'my-pinterest-box', 'Pinterest URL', 'selfie_create_post_format_pinterest_field', 'post', 'normal', 'high' );
	add_meta_box( 'my-pinterest-box', 'Pinterest URL', 'selfie_create_post_format_pinterest_field', 'portfolio', 'normal', 'high' );	
}
function selfie_post_format_google_field() {
	add_meta_box( 'my-google-box', 'Google URL', 'selfie_create_post_format_google_field', 'post', 'normal', 'high' );
	add_meta_box( 'my-google-box', 'Google URL', 'selfie_create_post_format_google_field', 'portfolio', 'normal', 'high' );
}
function selfie_video_post_format_URL_field() {
	add_meta_box( 'my-video-box', 'Video URL for post video format (only)', 'selfie_create_video_post_format_URL_field', 'post', 'normal', 'high' );
	add_meta_box( 'my-video-box', 'Video URL for post video format (only)', 'selfie_create_video_post_format_URL_field', 'portfolio', 'normal', 'high' );
}
function selfie_audio_post_format_URL_field() {
	add_meta_box( 'my-audio-box', 'Audio Shortcode for post Audio format (only)', 'selfie_create_audio_post_format_URL_field', 'post', 'normal', 'high' );
	add_meta_box( 'my-audio-box', 'Audio Shortcode for post Audio format (only)', 'selfie_create_audio_post_format_URL_field', 'portfolio', 'normal', 'high' );
}
function selfie_gallery_post_format_URL_field() {
	add_meta_box( 'my-gallery-box', 'Gallery Image IDs', 'selfie_create_gallery_post_format_URL_field', 'post', 'normal', 'high' );
	add_meta_box( 'my-gallery-box', 'Gallery Image IDs', 'selfie_create_gallery_post_format_URL_field', 'portfolio', 'normal', 'high' );
}
function post_icons_list() {
	add_meta_box( 'my-icon-box', 'Select Icon', 'selfie_create_post_icon_list', 'process', 'normal', 'high' );
	add_meta_box( 'my-icon-box', 'Select Icon', 'selfie_create_post_icon_list', 'page', 'normal', 'high' );
	add_meta_box( 'my-icon-box', 'Select Icon', 'selfie_create_post_icon_list', 'present', 'normal', 'high' );
	add_meta_box( 'my-icon-box', 'Select Icon', 'selfie_create_post_icon_list', 'education', 'normal', 'high' );
}

function selfie_present_position() {
	add_meta_box( 'present-position-box', 'Present Position', 'selfie_create_present_position', 'present', 'normal', 'high' );
}

function selfie_present_period() {
	add_meta_box( 'present-period-box', 'Present Period', 'selfie_create_present_period', 'present', 'normal', 'high' );
	add_meta_box( 'present-period-box', 'Present Period', 'selfie_create_present_period', 'education', 'normal', 'high' );
}

function selfie_education_university() {
	add_meta_box( 'education-university-box', 'Education Label #1', 'selfie_create_education_university', 'education', 'normal', 'high' );
}

function selfie_skill_value_field() {
	add_meta_box( 'selfie-skill-value-box', 'Skill Value', 'selfie_create_skill_value_field', 'skills', 'normal', 'high' );
}


function selfie_team_post_format_member_position() {
	add_meta_box( 'my-team-position-box', 'Team Member Position', 'selfie_create_team_post_format_member_position', 'team', 'normal', 'high' );
}


function team_skilltitleone_field() {
	add_meta_box( 'my-skilltitleone-box', 'Team Skill One Title', 'create_team_skilltitleone_field', 'team', 'normal', 'high' );
}

function team_skillpercentageone_field() {
	add_meta_box( 'my-skillpercentageone-box', 'Team Skill One Percentage (Put Number Only)', 'create_team_skillpercentageone_field', 'team', 'normal', 'high' );
}

function team_skilltitletwo_field() {
	add_meta_box( 'my-skilltitletwo-box', 'Team Skill Two Title', 'create_team_skilltitletwo_field', 'team', 'normal', 'high' );
}

function team_skillpercentagetwo_field() {
	add_meta_box( 'my-skillpercentagetwo-box', 'Team Skill Two Percentage (Put Number Only)', 'create_team_skillpercentagetwo_field', 'team', 'normal', 'high' );
}

function team_skilltitlethree_field() {
	add_meta_box( 'my-skilltitlethree-box', 'Team Skill Three Title', 'create_team_skilltitlethree_field', 'team', 'normal', 'high' );
}

function team_skillpercentagethree_field() {
	add_meta_box( 'my-skillpercentagethree-box', 'Team Skill Three Percentage (Put Number Only)', 'create_team_skillpercentagethree_field', 'team', 'normal', 'high' );
}



function selfie_team_socialone_field() {
	add_meta_box( 'team-socialone-box', 'Team Social One', 'selfie_create_team_socialone', 'team', 'normal', 'high' );
}

function selfie_team_socialone_link() {
	add_meta_box( 'team-socialonelink-box', 'Team Social One Link', 'selfie_create_team_socialonelink', 'team', 'normal', 'high' );
}

function selfie_team_socialtwo_field() {
	add_meta_box( 'team-socialtwo-box', 'Team Social Two', 'selfie_create_team_socialtwo', 'team', 'normal', 'high' );
}

function selfie_team_socialtwo_link() {
	add_meta_box( 'team-socialtwolink-box', 'Team Social Two Link', 'selfie_create_team_socialtwolink', 'team', 'normal', 'high' );
}

function selfie_team_socialthree_field() {
	add_meta_box( 'team-socialthree-box', 'Team Social Three', 'selfie_create_team_socialthree', 'team', 'normal', 'high');
}

function selfie_team_socialthree_link() {
	add_meta_box( 'team-socialthreelink-box', 'Team Social Three Link', 'selfie_create_team_socialthreelink', 'team', 'normal', 'high' );
}

/*------------------------------------------------------
Selfie , Add Custom Fields to the Post Formats (Create Fields) - End
-------------------------------------------------------*/



/*------------------------------------------------------
Selfie , Add Custom Fields to the Post Formats (Create Fields Layout) - Started
-------------------------------------------------------*/
function selfie_create_skill_value_field( $object, $box ) { ?>
	<p>
		<label for="skill-value">Skill Value (Number Only)</label>
		<br />
		<input name="skill-value" id="skill-value" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Skill Value (Number Only)', true ) ); ?>" />
		<input type="hidden" name="selfie_meta_box_skill_value" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }


function selfie_create_testimonial_company_field( $object, $box ) { ?>
	<p>
		<label for="testimonialcompany-shortcode">Testimonial Person Company Name</label>
		<br />
		<input name="testimonialcompany-shortcode" id="testimonialcompany-shortcode" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Testimonial Person Company Name', true )); ?>" />
		<input type="hidden" name="selfie_meta_box_testcompany" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }



function selfie_create_testimonial_post_format_company_link( $object, $box ) { ?>
	<p>
		<label for="testlink-shortcode">Company URL</label>
		<br />
		<input name="testlink-shortcode" id="testlink-shortcode" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Company URL', true )); ?>" />
		<input type="hidden" name="selfie_meta_box_testname" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }


function selfie_create_testimonial_post_format_person_position( $object, $box ) { ?>
	<p>
		<label for="testpositionlink-shortcode">Person Position</label>
		<br />
		<input name="testpositionlink-shortcode" id="testpositionlink-shortcode" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Person Position', true )); ?>" />
		<input type="hidden" name="selfie_meta_box_testposition" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }



function selfie_create_portfolio_post_format_client_link( $object, $box ) { ?>
	<p>
		<label for="projectlink-shortcode">Project URL</label>
		<br />
		<input name="projectlink-shortcode" id="projectlink-shortcode" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Project URL', true )); ?>" />
		<input type="hidden" name="selfie_meta_box_projectlink" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }



function selfie_create_portfolio_post_format_client_name( $object, $box ) { ?>
	<p>
		<label for="projectdescription-shortcode">Project Client</label>
		<br />
		<input name="projectdescription-shortcode" id="projectdescription-shortcode" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Project Client', true )); ?>" />
		<input type="hidden" name="selfie_meta_box_projectdesc" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }



function selfie_create_post_format_facebook_field( $object, $box ) { ?>
	<p>
		<label for="post-facebook">Facebook URL</label>
		<br />
		<input name="post-facebook" id="post-facebook" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Facebook URL', true ) ); ?>" />
		<input type="hidden" name="selfie_meta_box_facebook" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }


function selfie_create_post_format_twitter_field( $object, $box ) { ?>
	<p>
		<label for="post-twitter">Twitter URL</label>
		<br />
		<input name="post-twitter" id="post-twitter" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Twitter URL', true ) ); ?>" />
		<input type="hidden" name="selfie_meta_box_twitter" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }


function selfie_create_post_format_pinterest_field( $object, $box ) { ?>
	<p>
		<label for="post-pinterest">Pinterest URL</label>
		<br />
		<input name="post-pinterest" id="post-pinterest" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Pinterest URL', true ) ); ?>" />
		<input type="hidden" name="selfie_meta_box_pinterest" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }


function selfie_create_post_format_linkedin_field( $object, $box ) { ?>
	<p>
		<label for="post-linkedin">LinkedIn URL</label>
		<br />
		<input name="post-linkedin" id="post-linkedin" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'LinkedIn URL', true ) ); ?>" />
		<input type="hidden" name="selfie_meta_box_linkedin" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }



function selfie_create_post_format_google_field( $object, $box ) { ?>
	<p>
		<label for="post-google">Google URL</label>
		<br />
		<input name="post-google" id="post-google" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Google URL', true ) ); ?>" />
		<input type="hidden" name="selfie_meta_box_google" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }


function selfie_create_post_format_flickr_field( $object, $box ) { ?>
	<p>
		<label for="post-flickr">Flickr URL</label>
		<br />
		<input name="post-flickr" id="post-flickr" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Flickr URL', true ) ); ?>" />
		<input type="hidden" name="selfie_meta_box_flickr" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }


function selfie_create_video_post_format_URL_field( $object, $box ) { ?>
	<p>
		<label for="post-video">Post Video URL</label>
		<br />
		<input name="post-video" id="post-video" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Post Video URL', true ) ); ?>" />
		<input type="hidden" name="selfie_meta_box_video" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }


function selfie_create_audio_post_format_URL_field( $object, $box ) { ?>
	<p>
		<label for="post-audio">Post Audio Shortcode</label>
		<br />
		<input name="post-audio" id="post-audio" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Post Audio Shortcode', true ) ); ?>" />
		<input type="hidden" name="selfie_meta_box_audio" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }

	
function selfie_create_gallery_post_format_URL_field( $object, $box ) { ?>
<p>
	<label for="post-gallery">Post Gallery</label>
	<br />
	<input name="post-gallery" id="post-gallery" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Post Gallery', true ) ); ?>" />
	<input type="hidden" name="selfie_meta_box_gallery" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
</p>
<?php }



function selfie_create_present_position( $object, $box ) { ?>
<p>
	<label for="presentposition-shortcode">Present Position Label #1</label>
	<br />
	<input name="presentposition-shortcode" id="presentposition-shortcode" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Present Position', true ) ); ?>" />
	<input type="hidden" name="selfie_meta_box_presentposition" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
</p>
<?php }


function selfie_create_present_period( $object, $box ) { ?>
<p>
	<label for="presentperiod-shortcode">Present Period</label>
	<br />
	<input name="presentperiod-shortcode" id="presentperiod-shortcode" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Present Period', true ) ); ?>" />
	<input type="hidden" name="selfie_meta_box_presentperiod" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
</p>
<?php }


function selfie_create_education_university( $object, $box ) { ?>
<p>
	<label for="educationuniversity-shortcode">Education Label #1</label>
	<br />
	<input name="educationuniversity-shortcode" id="educationuniversity-shortcode" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Education University', true ) ); ?>" />
	<input type="hidden" name="selfie_meta_box_educationuniversity" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
</p>
<?php }

function selfie_create_team_post_format_member_position( $object, $box ) { ?>
	<p>
		<label for="teampositionlink-shortcode">Person Position</label>
		<br />
		<input name="teampositionlink-shortcode" id="teampositionlink-shortcode" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Team Member Position', true )); ?>" />
		<input type="hidden" name="sentient_meta_box_teamposition" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }




function create_team_skilltitleone_field( $object, $box ) { ?>
<p>
	<label for="post-teamtitleone">Team Skill Title One</label>
	<br />
	<input name="post-teamtitleone" id="post-teamtitleone" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Team Skill Title One', true ) ); ?>" />
	<input type="hidden" name="selfie_meta_box_teamtitleone" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
</p>
<?php }

function create_team_skillpercentageone_field( $object, $box ) { ?>
<p>
	<label for="post-teampercentageone">Team Skill Percentage One</label>
	<br />
	<input name="post-teampercentageone" id="post-teampercentageone" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Team Skill Percentage One', true ) ); ?>" />
	<input type="hidden" name="selfie_meta_box_teampercentageone" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
</p>
<?php }

function create_team_skilltitletwo_field( $object, $box ) { ?>
<p>
	<label for="post-teamtitletwo">Team Skill Title Two</label>
	<br />
	<input name="post-teamtitletwo" id="post-teamtitletwo" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Team Skill Title Two', true ) ); ?>" />
	<input type="hidden" name="selfie_meta_box_teamtitletwo" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
</p>
<?php }

function create_team_skillpercentagetwo_field( $object, $box ) { ?>
<p>
	<label for="post-teampercentagetwo">Team Skill Percentage Two</label>
	<br />
	<input name="post-teampercentagetwo" id="post-teampercentagetwo" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Team Skill Percentage Two', true ) ); ?>" />
	<input type="hidden" name="selfie_meta_box_teampercentagetwo" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
</p>
<?php }

function create_team_skilltitlethree_field( $object, $box ) { ?>
<p>
	<label for="post-teamtitlethree">Team Skill Title Three</label>
	<br />
	<input name="post-teamtitlethree" id="post-teamtitlethree" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Team Skill Title Three', true ) ); ?>" />
	<input type="hidden" name="selfie_meta_box_teamtitlethree" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
</p>
<?php }

function create_team_skillpercentagethree_field( $object, $box ) { ?>
<p>
	<label for="post-teampercentagethree">Team Skill Percentage Three</label>
	<br />
	<input name="post-teampercentagethree" id="post-teampercentagethree" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Team Skill Percentage Three', true ) ); ?>" />
	<input type="hidden" name="selfie_meta_box_teampercentagethree" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
</p>
<?php }


function selfie_create_team_socialone( $object, $box ) { ?>
	<p>
		<label for="teamsocialone-shortcode">Team Social One</label>
		<br />
		<select name="teamsocialone-shortcode" id="teamsocialone-shortcode" cols="60" rows="4" tabindex="30" style="width: 97%;">
			<option value="facebook" <?php if(get_post_meta( $object->ID, 'Team Social One', true ) == 'facebook'){ ?> selected="selected" <?php } ?>>Facebook</option>	
			<option value="twitter" <?php if(get_post_meta( $object->ID, 'Team Social One', true ) == 'twitter'){ ?> selected="selected" <?php } ?>>Twitter</option>	
			<option value="linkedin" <?php if(get_post_meta( $object->ID, 'Team Social One', true ) == 'linkedin'){ ?> selected="selected" <?php } ?>>LinkedIn</option>	
			<option value="gplus" <?php if(get_post_meta( $object->ID, 'Team Social One', true ) == 'gplus'){ ?> selected="selected" <?php } ?>>Google+</option>	
			<option value="pinterest" <?php if(get_post_meta( $object->ID, 'Team Social One', true ) == 'pinterest'){ ?> selected="selected" <?php } ?>>Pinterest</option>	
			<option value="flickr" <?php if(get_post_meta( $object->ID, 'Team Social One', true ) == 'flickr'){ ?> selected="selected" <?php } ?>>Flickr</option>				
		</select>		
		<input type="hidden" name="selfie_meta_box_teamsocialone" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }


function selfie_create_team_socialonelink( $object, $box ) { ?>
<p>
	<label for="teamsocialonelink-shortcode">Team Social One Link</label>
	<br />
	<input name="teamsocialonelink-shortcode" id="teamsocialonelink-shortcode" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Team Social One Link', true ) ); ?>" />
	<input type="hidden" name="selfie_meta_box_teamsocialonelink" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
</p>
<?php }


function selfie_create_team_socialtwo( $object, $box ) { ?>
	<p>
		<label for="teamsocialtwo-shortcode">Team Social Two</label>
		<br />
		<select name="teamsocialtwo-shortcode" id="teamsocialtwo-shortcode" cols="60" rows="4" tabindex="30" style="width: 97%;">
			<option value="facebook" <?php if(get_post_meta( $object->ID, 'Team Social Two', true ) == 'facebook'){ ?> selected="selected" <?php } ?>>Facebook</option>	
			<option value="twitter" <?php if(get_post_meta( $object->ID, 'Team Social Two', true ) == 'twitter'){ ?> selected="selected" <?php } ?>>Twitter</option>	
			<option value="linkedin" <?php if(get_post_meta( $object->ID, 'Team Social Two', true ) == 'linkedin'){ ?> selected="selected" <?php } ?>>LinkedIn</option>	
			<option value="gplus" <?php if(get_post_meta( $object->ID, 'Team Social Two', true ) == 'gplus'){ ?> selected="selected" <?php } ?>>Google+</option>	
			<option value="pinterest" <?php if(get_post_meta( $object->ID, 'Team Social Two', true ) == 'pinterest'){ ?> selected="selected" <?php } ?>>Pinterest</option>	
			<option value="flickr" <?php if(get_post_meta( $object->ID, 'Team Social Two', true ) == 'flickr'){ ?> selected="selected" <?php } ?>>Flickr</option>				
		</select>		
		<input type="hidden" name="selfie_meta_box_teamsocialtwo" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }


function selfie_create_team_socialtwolink( $object, $box ) { ?>
<p>
	<label for="teamsocialtwolink-shortcode">Team Social Two Link</label>
	<br />
	<input name="teamsocialtwolink-shortcode" id="teamsocialtwolink-shortcode" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Team Social Two Link', true ) ); ?>" />
	<input type="hidden" name="selfie_meta_box_teamsocialtwolink" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
</p>
<?php }


function selfie_create_team_socialthree( $object, $box ) { ?>
	<p>
		<label for="teamsocialthree-shortcode">Team Social Three</label>
		<br />
		<select name="teamsocialthree-shortcode" id="teamsocialthree-shortcode" cols="60" rows="4" tabindex="30" style="width: 97%;">
			<option value="facebook" <?php if(get_post_meta( $object->ID, 'Team Social Three', true ) == 'facebook'){ ?> selected="selected" <?php } ?>>Facebook</option>	
			<option value="twitter" <?php if(get_post_meta( $object->ID, 'Team Social Three', true ) == 'twitter'){ ?> selected="selected" <?php } ?>>Twitter</option>	
			<option value="linkedin" <?php if(get_post_meta( $object->ID, 'Team Social Three', true ) == 'linkedin'){ ?> selected="selected" <?php } ?>>LinkedIn</option>	
			<option value="gplus" <?php if(get_post_meta( $object->ID, 'Team Social Three', true ) == 'gplus'){ ?> selected="selected" <?php } ?>>Google+</option>	
			<option value="pinterest" <?php if(get_post_meta( $object->ID, 'Team Social Three', true ) == 'pinterest'){ ?> selected="selected" <?php } ?>>Pinterest</option>	
			<option value="flickr" <?php if(get_post_meta( $object->ID, 'Team Social Three', true ) == 'flickr'){ ?> selected="selected" <?php } ?>>Flickr</option>				
		</select>		
		<input type="hidden" name="selfie_meta_box_teamsocialthree" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }


function selfie_create_team_socialthreelink( $object, $box ) { ?>
<p>
	<label for="teamsocialthreelink-shortcode">Team Social Three Link</label>
	<br />
	<input name="teamsocialthreelink-shortcode" id="teamsocialthreelink-shortcode" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Team Social Three Link', true ) ); ?>" />
	<input type="hidden" name="selfie_meta_box_teamsocialthreelink" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
</p>
<?php }
/*------------------------------------------------------
Selfie , Add Custom Fields to the Post Formats (Create Fields Layout) - End
-------------------------------------------------------*/




/*------------------------------------------------------
Selfie , Add Custom Fields to the Post Formats (Save Values) - Started
-------------------------------------------------------*/

function selfie_save_skill_value_field( $post_id, $post ) {

	if(isset ($_POST['selfie_meta_box_skill_value'])){
		if ( !wp_verify_nonce( $_POST['selfie_meta_box_skill_value'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Title Description', true );
	
	if(isset ($_POST['skill-value'])){
		$new_meta_value = stripslashes( $_POST['skill-value'] );
	} else {
		$new_meta_value = '';
	}														

	$new_meta_value = sanitize_text_field($new_meta_value);	
	
	update_post_meta( $post_id, 'Skill Value (Number Only)', $new_meta_value );
	
}


function selfie_save_testimonial_company_field( $post_id, $post ) {

	if(isset ($_POST['selfie_meta_box_testcompany'])){
		if ( !wp_verify_nonce( $_POST['selfie_meta_box_testcompany'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Team Member Position', true );
	
	if(isset ($_POST['testimonialcompany-shortcode'])){
		$new_meta_value = stripslashes($_POST['testimonialcompany-shortcode']);
	} else {
		$new_meta_value = '';
	}		
	
	$new_meta_value = sanitize_text_field($new_meta_value);
	
	update_post_meta( $post_id, 'Testimonial Person Company Name', $new_meta_value );

}

function selfie_save_testimonial_post_format_person_position( $post_id, $post ) {

	if(isset ($_POST['selfie_meta_box_testposition'])){
		if ( !wp_verify_nonce( $_POST['selfie_meta_box_testposition'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Person Position', true );
	
	if(isset ($_POST['testpositionlink-shortcode'])){
		$new_meta_value = stripslashes( $_POST['testpositionlink-shortcode'] );
	} else {
		$new_meta_value = '';
	}				

	$new_meta_value = sanitize_text_field($new_meta_value);
	
	update_post_meta( $post_id, 'Person Position', $new_meta_value );
	
}


function selfie_save_testimonial_post_format_company_link( $post_id, $post ) {

	if(isset ($_POST['selfie_meta_box_testname'])){
		if ( !wp_verify_nonce( $_POST['selfie_meta_box_testname'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Company URL', true );
	
	if(isset ($_POST['testlink-shortcode'])){
		$new_meta_value = stripslashes( $_POST['testlink-shortcode'] );
	} else {
		$new_meta_value = '';
	}			

	$new_meta_value = esc_url_raw($new_meta_value);

	update_post_meta( $post_id, 'Company URL', $new_meta_value );

}


function selfie_save_portfolio_post_format_client_link( $post_id, $post ) {

	if(isset ($_POST['selfie_meta_box_projectlink'])){
		if ( !wp_verify_nonce( $_POST['selfie_meta_box_projectlink'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Project URL', true );
	
	if(isset ($_POST['projectlink-shortcode'])){
		$new_meta_value = stripslashes( $_POST['projectlink-shortcode'] );
	} else {
		$new_meta_value = '';
	}				

	$new_meta_value = esc_url_raw($new_meta_value);
	
	update_post_meta( $post_id, 'Project URL', $new_meta_value );
	
}


function selfie_save_portfolio_post_format_client_name( $post_id, $post ) {

	if(isset ($_POST['selfie_meta_box_projectdesc'])){
		if ( !wp_verify_nonce( $_POST['selfie_meta_box_projectdesc'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Project Client', true );
	
	if(isset ($_POST['projectdescription-shortcode'])){
		$new_meta_value = stripslashes( $_POST['projectdescription-shortcode'] );
	} else {
		$new_meta_value = '';
	}				

	$new_meta_value = sanitize_text_field($new_meta_value);
	
	update_post_meta( $post_id, 'Project Client', $new_meta_value );
	
}

function selfie_save_post_format_facebook_field( $post_id, $post ) {

	if(isset ($_POST['selfie_meta_box_facebook'])){
		if ( !wp_verify_nonce( $_POST['selfie_meta_box_facebook'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Facebook URL', true );
	
	if(isset ($_POST['post-facebook'])){
		$new_meta_value = stripslashes( $_POST['post-facebook'] );
	} else {
		$new_meta_value = '';
	}			

	$new_meta_value = esc_url($new_meta_value);	
	
	update_post_meta( $post_id, 'Facebook URL', $new_meta_value );

}

function selfie_save_post_format_twitter_field( $post_id, $post ) {

	if(isset ($_POST['selfie_meta_box_twitter'])){
		if ( !wp_verify_nonce( $_POST['selfie_meta_box_twitter'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Twitter URL', true );
	
	if(isset ($_POST['post-twitter'])){
		$new_meta_value = stripslashes( $_POST['post-twitter'] );
	} else {
		$new_meta_value = '';
	}			

	$new_meta_value = esc_url($new_meta_value);	

	update_post_meta( $post_id, 'Twitter URL', $new_meta_value );
	
}

function selfie_save_post_format_linkedin_field( $post_id, $post ) {

	if(isset ($_POST['selfie_meta_box_linkedin'])){
		if ( !wp_verify_nonce( $_POST['selfie_meta_box_linkedin'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'LinkedIn URL', true );
	
	if(isset ($_POST['post-linkedin'])){
		$new_meta_value = stripslashes( $_POST['post-linkedin'] );
	} else {
		$new_meta_value = '';
	}							

	$new_meta_value = esc_url($new_meta_value);	
	
	update_post_meta( $post_id, 'LinkedIn URL', $new_meta_value );
	
}

function selfie_save_post_format_pinterest_field( $post_id, $post ) {

	if(isset ($_POST['selfie_meta_box_linkedin'])){
		if ( !wp_verify_nonce( $_POST['selfie_meta_box_pinterest'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Pinterest URL', true );
	
	if(isset ($_POST['post-pinterest'])){
		$new_meta_value = stripslashes( $_POST['post-pinterest'] );
	} else {
		$new_meta_value = '';
	}							

	$new_meta_value = esc_url($new_meta_value);	
	
	update_post_meta( $post_id, 'Pinterest URL', $new_meta_value );
	
}

function selfie_save_post_format_google_fieldw( $post_id, $post ) {

	if(isset ($_POST['selfie_meta_box_google'])){
		if ( !wp_verify_nonce( $_POST['selfie_meta_box_google'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Google URL', true );
	
	if(isset ($_POST['post-google'])){
		$new_meta_value = stripslashes( $_POST['post-google'] );
	} else {
		$new_meta_value = '';
	}								

	$new_meta_value = esc_url($new_meta_value);	
	
	update_post_meta( $post_id, 'Google URL', $new_meta_value );

}


function selfie_save_post_format_flickr_field( $post_id, $post ) {

	if(isset ($_POST['selfie_meta_box_flickr'])){
		if ( !wp_verify_nonce( $_POST['selfie_meta_box_flickr'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Flickr URL', true );
	
	if(isset ($_POST['post-flickr'])){
		$new_meta_value = stripslashes( $_POST['post-flickr'] );
	} else {
		$new_meta_value = '';
	}											

	$new_meta_value = esc_url($new_meta_value);	
	
	update_post_meta( $post_id, 'Flickr URL', $new_meta_value );
	
}


function selfie_save_video_post_format_URL_field( $post_id, $post ) {

	if(isset ($_POST['selfie_meta_box_video'])){
		if ( !wp_verify_nonce( $_POST['selfie_meta_box_video'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Post Video URL', true );
	
	if(isset ($_POST['post-video'])){
		$new_meta_value = stripslashes( $_POST['post-video'] );
	} else {
		$new_meta_value = '';
	}	

	$new_meta_value = esc_url($new_meta_value);	

	update_post_meta( $post_id, 'Post Video URL', $new_meta_value );
	
}

function selfie_save_audio_post_format_URL_field( $post_id, $post ) {

	if(isset ($_POST['selfie_meta_box_audio'])){
		if ( !wp_verify_nonce( $_POST['selfie_meta_box_audio'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Post Audio Shortcode', true );
	
	if(isset ($_POST['post-audio'])){
		$new_meta_value = stripslashes( $_POST['post-audio'] );
	} else {
		$new_meta_value = '';
	}		

	$new_meta_value = sanitize_text_field($new_meta_value);

	update_post_meta( $post_id, 'Post Audio Shortcode', $new_meta_value );

}


function selfie_save_gallery_post_format_URL_field( $post_id, $post ) {

	if(isset ($_POST['selfie_meta_box_gallery'])){
		if ( !wp_verify_nonce( $_POST['selfie_meta_box_gallery'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Post Gallery', true );
	
	if(isset ($_POST['post-gallery'])){
		$new_meta_value = stripslashes( $_POST['post-gallery'] );
	} else {
		$new_meta_value = '';
	}														

	$new_meta_value = sanitize_text_field($new_meta_value);
	
	update_post_meta( $post_id, 'Post Gallery', $new_meta_value );
	
}

function selfie_post_save_icons_list( $post_id, $post ) {

	if(isset ($_POST['meta_box_icon'])){
		if ( !wp_verify_nonce( $_POST['meta_box_icon'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Icon', true );
	
	if(isset ($_POST['post-icon'])){
		$new_meta_value = stripslashes( $_POST['post-icon'] );
	} else {
		$new_meta_value = '';
	}														

	$new_meta_value = sanitize_text_field($new_meta_value);
	
	update_post_meta( $post_id, 'Icon', $new_meta_value );
	
}


function selfie_present_save_position( $post_id, $post ) {

	if(isset ($_POST['selfie_meta_box_presentposition'])){
		if ( !wp_verify_nonce( $_POST['selfie_meta_box_presentposition'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	


	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Present Position', true );
	
	if(isset ($_POST['presentposition-shortcode'])){
		$new_meta_value = stripslashes( $_POST['presentposition-shortcode'] );
	} else {
		$new_meta_value = '';
	}

	$new_meta_value = sanitize_text_field($new_meta_value);
	
	update_post_meta( $post_id, 'Present Position', $new_meta_value );

}



function selfie_education_save_university( $post_id, $post ) {

	if(isset ($_POST['selfie_meta_box_educationuniversity'])){
		if ( !wp_verify_nonce( $_POST['selfie_meta_box_educationuniversity'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	


	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Education University', true );
	
	if(isset ($_POST['educationuniversity-shortcode'])){
		$new_meta_value = stripslashes( $_POST['educationuniversity-shortcode'] );
	} else {
		$new_meta_value = '';
	}

	$new_meta_value = sanitize_text_field($new_meta_value);
	
	update_post_meta( $post_id, 'Education University', $new_meta_value );
		
}



function selfie_present_save_period( $post_id, $post ) {

	if(isset ($_POST['selfie_meta_box_presentperiod'])){
		if ( !wp_verify_nonce( $_POST['selfie_meta_box_presentperiod'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	


	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Present Period', true );
	
	if(isset ($_POST['presentperiod-shortcode'])){
		$new_meta_value = stripslashes( $_POST['presentperiod-shortcode'] );
	} else {
		$new_meta_value = '';
	}

	$new_meta_value = sanitize_text_field($new_meta_value);
	
	update_post_meta( $post_id, 'Present Period', $new_meta_value );
	
}



function selfie_save_team_post_format_member_position( $post_id, $post ) {

	if(isset ($_POST['sentient_meta_box_teamposition'])){
		if ( !wp_verify_nonce( $_POST['sentient_meta_box_teamposition'], plugin_basename( __FILE__ ) ) )
			return $post_id;	
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Team Member Position', true );
	
	if(isset ($_POST['teampositionlink-shortcode'])){
		$new_meta_value = stripslashes( $_POST['teampositionlink-shortcode'] );
	} else {
		$new_meta_value = '';
	}			

	update_post_meta( $post_id, 'Team Member Position', $new_meta_value );

}



function team_save_skilltitleone_field( $post_id, $post ) {

	if(isset ($_POST['selfie_meta_box_teamtitleone'])){
		if ( !wp_verify_nonce( $_POST['selfie_meta_box_teamtitleone'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Team Skill Title One', true );
	
	if(isset ($_POST['post-teamtitleone'])){
		$new_meta_value = stripslashes( $_POST['post-teamtitleone'] );
	} else {
		$new_meta_value = '';
	}														

	update_post_meta( $post_id, 'Team Skill Title One', $new_meta_value );

}


function team_save_skillpercentageone_field( $post_id, $post ) {

	if(isset ($_POST['selfie_meta_box_teampercentageone'])){
		if ( !wp_verify_nonce( $_POST['selfie_meta_box_teampercentageone'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Team Skill Percentage One', true );
	
	if(isset ($_POST['post-teampercentageone'])){
		$new_meta_value = stripslashes( $_POST['post-teampercentageone'] );
	} else {
		$new_meta_value = '';
	}														

	update_post_meta( $post_id, 'Team Skill Percentage One', $new_meta_value );
	
}


function team_save_skilltitletwo_field( $post_id, $post ) {

	if(isset ($_POST['selfie_meta_box_teamtitletwo'])){
		if ( !wp_verify_nonce( $_POST['selfie_meta_box_teamtitletwo'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Team Skill Title Two', true );
	
	if(isset ($_POST['post-teamtitletwo'])){
		$new_meta_value = stripslashes( $_POST['post-teamtitletwo'] );
	} else {
		$new_meta_value = '';
	}														

	update_post_meta( $post_id, 'Team Skill Title Two', $new_meta_value );

}

function team_save_skillpercentagetwo_field( $post_id, $post ) {

	if(isset ($_POST['selfie_meta_box_teampercentagetwo'])){
		if ( !wp_verify_nonce( $_POST['selfie_meta_box_teampercentagetwo'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Team Skill Percentage Two', true );
	
	if(isset ($_POST['post-teampercentagetwo'])){
		$new_meta_value = stripslashes( $_POST['post-teampercentagetwo'] );
	} else {
		$new_meta_value = '';
	}														

	update_post_meta( $post_id, 'Team Skill Percentage Two', $new_meta_value );
	
}

function team_save_skilltitlethree_field( $post_id, $post ) {

	if(isset ($_POST['selfie_meta_box_teamtitlethree'])){
		if ( !wp_verify_nonce( $_POST['selfie_meta_box_teamtitlethree'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Team Skill Title Three', true );
	
	if(isset ($_POST['post-teamtitlethree'])){
		$new_meta_value = stripslashes( $_POST['post-teamtitlethree'] );
	} else {
		$new_meta_value = '';
	}														

	update_post_meta( $post_id, 'Team Skill Title Three', $new_meta_value );
	
}

function team_save_skillpercentagethree_field( $post_id, $post ) {

	if(isset ($_POST['selfie_meta_box_teampercentagethree'])){
		if ( !wp_verify_nonce( $_POST['selfie_meta_box_teampercentagethree'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Team Skill Percentage Three', true );
	
	if(isset ($_POST['post-teampercentagethree'])){
		$new_meta_value = stripslashes( $_POST['post-teampercentagethree'] );
	} else {
		$new_meta_value = '';
	}														

	update_post_meta( $post_id, 'Team Skill Percentage Three', $new_meta_value );
	
}




function selfie_team_save_socialone_field( $post_id, $post ) {

	if(isset ($_POST['selfie_meta_box_teamsocialone'])){
		if ( !wp_verify_nonce( $_POST['selfie_meta_box_teamsocialone'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	


	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Team Social One', true );
	
	if(isset ($_POST['teamsocialone-shortcode'])){
		$new_meta_value = stripslashes( $_POST['teamsocialone-shortcode'] );
	} else {
		$new_meta_value = '';
	}

	update_post_meta( $post_id, 'Team Social One', $new_meta_value );
	
}


function selfie_team_save_socialone_link( $post_id, $post ) {

	if(isset ($_POST['selfie_meta_box_teamsocialonelink'])){
		if ( !wp_verify_nonce( $_POST['selfie_meta_box_teamsocialonelink'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	


	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Team Social One Link', true );
	
	if(isset ($_POST['teamsocialonelink-shortcode'])){
		$new_meta_value = stripslashes($_POST['teamsocialonelink-shortcode']);
	} else {
		$new_meta_value = '';
	}
	
	update_post_meta( $post_id, 'Team Social One Link', $new_meta_value );
	
}

function selfie_team_save_socialtwo_field( $post_id, $post ) {

	if(isset ($_POST['selfie_meta_box_teamsocialtwo'])){
		if ( !wp_verify_nonce( $_POST['selfie_meta_box_teamsocialtwo'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	


	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Team Social Two', true );
	
	if(isset ($_POST['teamsocialtwo-shortcode'])){
		$new_meta_value = stripslashes( $_POST['teamsocialtwo-shortcode'] );
	} else {
		$new_meta_value = '';
	}

	update_post_meta( $post_id, 'Team Social Two', $new_meta_value );
	
}

function selfie_team_save_socialtwo_link( $post_id, $post ) {

	if(isset ($_POST['selfie_meta_box_teamsocialtwolink'])){
		if ( !wp_verify_nonce( $_POST['selfie_meta_box_teamsocialtwolink'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	


	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Team Social Two Link', true );
	
	if(isset ($_POST['teamsocialtwolink-shortcode'])){
		$new_meta_value = stripslashes( $_POST['teamsocialtwolink-shortcode'] );
	} else {
		$new_meta_value = '';
	}

	update_post_meta( $post_id, 'Team Social Two Link', $new_meta_value );

}

function selfie_team_save_socialthree_field( $post_id, $post ) {

	if(isset ($_POST['selfie_meta_box_teamsocialthree'])){
		if ( !wp_verify_nonce( $_POST['selfie_meta_box_teamsocialthree'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	


	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Team Social Three', true );
	
	if(isset ($_POST['teamsocialthree-shortcode'])){
		$new_meta_value = stripslashes( $_POST['teamsocialthree-shortcode'] );
	} else {
		$new_meta_value = '';
	}

	update_post_meta( $post_id, 'Team Social Three', $new_meta_value );

}

function selfie_team_save_socialthree_link( $post_id, $post ) {

	if(isset ($_POST['selfie_meta_box_teamsocialthreelink'])){
		if ( !wp_verify_nonce( $_POST['selfie_meta_box_teamsocialthreelink'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	


	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Team Social Three Link', true );
	
	if(isset ($_POST['teamsocialthreelink-shortcode'])){
		$new_meta_value = stripslashes( $_POST['teamsocialthreelink-shortcode'] );
	} else {
		$new_meta_value = '';
	}

	update_post_meta( $post_id, 'Team Social Three Link', $new_meta_value );
	
}


/*------------------------------------------------------
Selfie , Add Custom Fields to the Post Formats (Save Values) - End
-------------------------------------------------------*/



/*------------------------------------------------------
Selfie Comments - Started
-------------------------------------------------------*/
function selfie_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
	?>
	<<?php echo $tag; ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-content">
	<?php endif; ?>
	<div class="avatar">
	<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment,54 ); ?>
	</div>
	<div class="comment-box">
		<div class="comment-meta">
			<?php printf(esc_html__('%s'  , "selfie"), get_comment_author_link()); ?> , <?php esc_html_e("on" , "selfie"); ?> <?php echo get_comment_date('M' , $comment->comment_ID ) . ' ' . get_comment_date('j' , $comment->comment_ID ) . ', ' . get_comment_date('Y' , $comment->comment_ID ); ?> <?php esc_html_e("at" , "selfie"); ?> <?php echo comment_time('H:i'); ?>
			<span class="pull-right"><?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span>
		</div>
		<div class="comment-text">
			<?php comment_text() ?>
		</div>
	</div>
	
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
	<?php
}
/*------------------------------------------------------
Selfie Comments - End
-------------------------------------------------------*/



/*------------------------------------------------------
Selfie Search - Started
-------------------------------------------------------*/
function selfie_search_form( $form ) {

    $form = '
	<form role="search" method="get" class="search-form" id="search-form" action="' . home_url( '/' ) . '">
		<input type="text" placeholder="' . esc_html__("Search" , "selfie") . '" name="s" id="s" class="search-input form-control">
		<button type="submit" title="' . esc_html__("Search" , "selfie") . '" name="submit" class="submit"><i class="fa fa-search"></i></button>
	</form>	
	';

    return $form;
}

/*------------------------------------------------------
Selfie Search - End
-------------------------------------------------------*/




/*------------------------------------------------------
Selfie Category List - Started
-------------------------------------------------------*/
function selfie_categories_postcount_filter ($variable) {
   $variable = str_replace('(', '<span class="post_count"> ', $variable);
   $variable = str_replace(')', ' </span>', $variable);
   return $variable;
}
/*------------------------------------------------------
Selfie Category List - End
-------------------------------------------------------*/



/*------------------------------------------------------
Selfie Importer - Started
-------------------------------------------------------*/
require get_template_directory() . '/importer/init.php';
/*------------------------------------------------------
Selfie Importer - Started
-------------------------------------------------------*/





/*------------------------------------------------------
Selfie Admin Panel - Started
-------------------------------------------------------*/
if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri().'/admin/');
	require_once (get_template_directory() . '/admin/options-framework.php');
}
/*------------------------------------------------------
Selfie Admin Panel - End
-------------------------------------------------------*/




/***************************************************/
/*Selfie Import CSS Styles - Started*/
/***************************************************/
function selfie_Import_CSS(){

	$selfieFile = get_template_directory() . '/selfie-styles.css';
	
	/* Append a new person to the file*/
	$selfieCurrent = selfie_Generate_CSS();
	
	/* Write the contents back to the file*/
	
	/** Write to options.css file **/
	WP_Filesystem();
	global $wp_filesystem;
	if ( ! $wp_filesystem->put_contents( $selfieFile, $selfieCurrent, 0644) ) {
	    return true;
	}	

}
/***************************************************/
/*Selfie Import CSS Styles - End*/
/***************************************************/



/***************************************************/
/*Selfie Generate CSS Styles - Started*/
/***************************************************/

function selfie_Generate_CSS(){

	global $prof_default;

	$GetStyle = "";
	
	/* Apply Dynamic CSS*/
	$GetStyle .= "";
	$getcorrectbodyfont = str_replace('+', ' ', of_get_option('select_font',$prof_default));
	
	$getcorrectheadingonefont = str_replace('+', ' ', of_get_option('h1_font',$prof_default));
	$getcorrectheadingtwofont = str_replace('+', ' ', of_get_option('h2_font',$prof_default));
	$getcorrectheadingthreefont = str_replace('+', ' ', of_get_option('h3_font',$prof_default));
	$getcorrectheadingfourfont = str_replace('+', ' ', of_get_option('h4_font',$prof_default));
	$getcorrectheadingfivefont = str_replace('+', ' ', of_get_option('h5_font',$prof_default));
	$getcorrectheadingSixfont = str_replace('+', ' ', of_get_option('h6_font',$prof_default));
	
	/* HTML styles	*/
	$GetStyle .= "
		
		@font-face{font-family: entypo; src: url(" . get_template_directory_uri(). "/fonts/entypo.woff);}		
		@font-face{font-family: entyposocial; src: url(" . get_template_directory_uri(). "/fonts/entypo-social.woff);}
		@font-face{font-family: fontello; src: url(" . get_template_directory_uri(). "/fonts/fontello.woff);}
		@font-face{font-family: fontawesome; src: url(" . get_template_directory_uri(). "/fonts/fontawesome-webfont.woff);}				
		
		.header .heading,
		input, textarea,
		.wpb_wrapper, .wpb_wrapper p,
		.wpb_wrapper p span:not(.fa), .wpb_wrapper span:not(.fa),
		.wpb_wrapper span p, .ui-widget, body{
			font-family: " . $getcorrectbodyfont . " !important;
		}
		
		.wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header a{
			font-family: " . $getcorrectbodyfont . " !important;
		}
		
		.wpb_accordion_content{
			font-family: " . $getcorrectbodyfont . " !important;
		}
		
		footer {background:" . of_get_option('foo_color',$prof_default) . "; border-top: 1px solid " . of_get_option('foo_border_color',$prof_default) . "; color: " . of_get_option('foo_text_color',$prof_default) . ";}
		
		.vc_col-sm-3.selfie-footer-phone,
		.vc_col-sm-3.selfie-footer-phone a,
		.vc_col-sm-6.selfie-copyrights,
		.selfie-footer-email,
		.selfie-footer-email a,
		.selfie-footer-socials a {color: " . of_get_option('foo_text_color',$prof_default) . ";}
		
		.selfie-footer-email{
			border-left: 1px solid " . of_get_option('foo_border_color',$prof_default) . ";
			border-right: 1px solid " . of_get_option('foo_border_color',$prof_default) . ";		
		}
		
		.selfie-footer-bottom{
			border-top: 1px solid " . of_get_option('foo_border_color',$prof_default) . ";
		}
		
		.vc_col-sm-3.selfie-footer-phone{
			border-left: 1px solid " . of_get_option('foo_border_color',$prof_default) . ";
			border-right: 1px solid " . of_get_option('foo_border_color',$prof_default) . ";
		}
		
		.header .box-heading,
		.number-counters strong {
			font-family: " . $getcorrectheadingtwofont . ";
		}
		
		.counters-item strong,
		.section-title h1 span{
			font-family: " . $getcorrectheadingonefont . " !important;
		}
		
		h1{color:" . of_get_option('h1_color',$prof_default) . "; font-family: " . $getcorrectheadingonefont . " !important; font-size: " . of_get_option('h1_font_size',$prof_default) . " !important; line-height: " . of_get_option('h1_line_height',$prof_default) . " !important;}
		h2{color:" . of_get_option('h2_color',$prof_default) . "; font-family: " . $getcorrectheadingtwofont . " !important; font-size: " . of_get_option('h2_font_size',$prof_default) . " !important; line-height: " . of_get_option('h2_line_height',$prof_default) . " !important;}
		h3{color:" . of_get_option('h3_color',$prof_default) . "; font-family: " . $getcorrectheadingthreefont . " !important; font-size: " . of_get_option('h3_font_size',$prof_default) . " !important; line-height: " . of_get_option('h3_line_height',$prof_default) . " !important;}
		h4{color:" . of_get_option('h4_color',$prof_default) . "; font-family: " . $getcorrectheadingfourfont . " !important; font-size: " . of_get_option('h4_font_size',$prof_default) . " !important; line-height: " . of_get_option('h4_line_height',$prof_default) . " !important;}			
		h5{color:" . of_get_option('h5_color',$prof_default) . ";font-family: " . $getcorrectheadingfivefont . " !important;font-size: " . of_get_option('h5_font_size',$prof_default) . " !important;line-height: " . of_get_option('h5_line_height',$prof_default) . " !important;}
		h6{color:" . of_get_option('h6_color',$prof_default) . "; font-family: " . $getcorrectheadingSixfont . " !important; font-size: " . of_get_option('h6_font_size',$prof_default) . " !important; line-height: " . of_get_option('h6_line_height',$prof_default) . " !important;}			
		
		.wpb_toggle, #content h4.wpb_toggle{
			background-color: #f5f5f5 !important;
			border: 1px solid #dddddd !important;
			color: #333333 !important;
			padding:10px 15px !important;
			border-radius:3px !important;			
			font-size: 16px !important;
			line-height:1.5 !important;			
		}
		
		.wpb_toggle.wpb_toggle_title_active{margin-bottom:-1px !important;}
		
		.wpb_toggle_content {
		  border: 1px solid #dddddd;
		  border-radius: 0 0 3px 3px;
		  margin-bottom: 5px !important;
		  padding: 15px !important;
		  margin-top:0 !important;
		}		
		
		.logo{margin-top:" . of_get_option('theme_site_logo_padding_top',$prof_default) . "; margin-bottom:" . of_get_option('theme_site_logo_padding_bottom',$prof_default) . "; margin-left:" . of_get_option('theme_site_logo_padding_left',$prof_default) . ";margin-right:" . of_get_option('theme_site_logo_padding_right',$prof_default) . ";}		

		.flickr_badge_image:hover{border-color:" . of_get_option('theme_color',$prof_default) . " !important;}
		
		.proftheme-widget ul li a.sentient-widget-recent-post-title:hover,{color:" . of_get_option('theme_color',$prof_default) . " !important;}
		
		.label.label-primary {background:" . of_get_option('theme_color',$prof_default) . ";}
		
		.wpb_toggle:hover, #content h4.wpb_toggle:hover{color:" . of_get_option('theme_color',$prof_default) . " !important;}
		.wpb_toggle_title_active:hover, #content h4.wpb_toggle_title_active:hover{color:" . of_get_option('theme_color',$prof_default) . " !important;}
		
		.wpb_toggle, #content h4.wpb_toggle{background-color:#f5f5f5 !important; background-image:none !important; color:#333 !important;}
		.wpb_toggle_title_active, #content h4.wpb_toggle_title_active{background-color:#f5f5f5 !important; color:#333 !important; background-image:none !important;}
				
		.wpb_tabs_nav.ui-tabs-nav.clearfix.ui-helper-reset.ui-helper-clearfix.ui-widget-header.ui-corner-all li.ui-state-default.ui-corner-top.ui-tabs-active.ui-state-active,
		.portfolio-pagination span:hover, .portfolio-pagination a.page-numbers:hover ,
		.portfolio-pagination .page-numbers:hover, #wp-calendar #today,
		.contactform .contact-form-send-btn{
			background:" . of_get_option('theme_color',$prof_default) . " !important;
		}
		
		.selfie-contact input[type='submit']:hover{
			opacity:0.8;
		}		
		
		.selfie-contact input[type='submit']{
			background-color: transparent;
			border: 1px solid " . of_get_option('theme_color',$prof_default) . ";
			color: #9babb3;		
		}
		
		.selfie-contact.selfie-newsletter-contact input[type='submit']{
			background-color: " . of_get_option('theme_color',$prof_default) . ";
			border: 1px solid " . of_get_option('theme_color',$prof_default) . ";
			color: #fff;		
		}

		#recentcomments .sentient-comments-author a:hover{color:" . of_get_option('theme_color',$prof_default) . " !important;}

		.comment-edit-link,
		a:hover:not(.sentient-button),
		.Recent-post-list li:hover,
		Recent-post-list li a:hover,
		.comment-post-title,
		#recentcomments .recentcomments a,
		#comments #respond h3,
		.reply a.comment-reply-link:hover ,
		.reply:hover{
			color:" . of_get_option('theme_color',$prof_default) . " !important;
		}
		
		
		.post .blog-entry .entry-header h4 a:hover,	.sidebar .cat-item:hover a,
		.sidebar .cat-item:hover span, .comment-info span a,
		ul li.active .d-text-c-h, .d-text-c.active, .sidebar .widget .twitter_widget ul li a,
		.d-text-c-h.active, .d-text-c-h:hover, .our-team-section .team-member:hover h6,
		.d-text-c {
			color: " . of_get_option('theme_color',$prof_default) . " !important;
		}
		
		.d-bg-c.active, .d-bg-c-h:hover, .d-bg-c-h.active, .d-bg-c {
			background: " . of_get_option('theme_color',$prof_default) . " !important;
		}

		
		.div-top:hover{border:2px solid " . of_get_option('theme_color',$prof_default) . ";}
		.div-top:hover i{color:" . of_get_option('theme_color',$prof_default) . ";}
				
		a{color: " . of_get_option('theme_color',$prof_default) . ";}
		
		
		.process-node.active {
			background: " . of_get_option('icon_process_color',$prof_default) . ";
			border: 2px solid " . of_get_option('icon_process_border',$prof_default) . ";
		}
		
		footer p a{color:" . of_get_option('theme_color',$prof_default) . " !important;}
		

		.slider-section .ls-bottom-nav-wrapper  .ls-bottom-slidebuttons a:hover,
		.slider-section .ls-bottom-nav-wrapper  .ls-bottom-slidebuttons a.ls-nav-active{
			background:" . of_get_option('theme_color',$prof_default) . " !important;
			border:2px solid " . of_get_option('theme_color',$prof_default) . " !important;
		}		
		
		.bg-callout{background-color: " . of_get_option('top_title_color',$prof_default) . "; background-image: url('" . of_get_option('top_title_image',$prof_default) . "');}
		
		.skill-member .skillBar li span,
		#secondary a.tag:hover,
		.skillBar li span,
		.bg3 {
			background-color: " . of_get_option('theme_color',$prof_default) . " !important;
		}

		.timeline .note:hover:after,
		.browserImage .browserTop,
		.timeline .note:hover:after,
		.package-active,
		.icon-circular:hover i.fa,
		.icon-box,
		.dropcap1 {
			background: " . of_get_option('theme_color',$prof_default) . ";
		}

		.package-active:after,
		.icon-box:after {
			border-top-color: " . of_get_option('theme_color',$prof_default) . ";
		}

		.icon-circular i.fa{
			border:2px solid " . of_get_option('theme_color',$prof_default) . ";
			color:" . of_get_option('theme_color',$prof_default) . ";
		}

		.icon-circular:hover i.fa{
			background:" . of_get_option('theme_color',$prof_default) . ";
			color:#fff;
		}		
		
		.packages {
			border: 1px solid " . of_get_option('theme_color',$prof_default) . ";
		}
		
		.profileInfo h5 span,
		.selfie-profile-details h4{color:" . of_get_option('theme_color',$prof_default) . ";}

		.bg3 .section-title div span {
			color: " . of_get_option('theme_color',$prof_default) . " !important;
		}	

		.trans-nav .nav-menu ul.dropdown-menu .current_page_item a{color:" . of_get_option('theme_color',$prof_default) . " !important;}
		
		.wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header{
			background: #CCC !important;
			color: #222;
			cursor: pointer;
			display: block;
			outline: 0 none !important;
			padding: 0 !important;
			text-decoration: none;
			margin: 0 !important;
		}
		
		.wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header a:hover{
			color: #222 !important;
		}
		

		
		#navigation-sticky.trans-nav {			
		    background: -webkit-linear-gradient(bottom, " . selfie_hex2rgb(of_get_option('menu_background_color',$prof_default) , 0) . ", " . selfie_hex2rgb(of_get_option('menu_background_color',$prof_default) , 1) . ");
			background: -o-linear-gradient(bottom, " . selfie_hex2rgb(of_get_option('menu_background_color',$prof_default) , 0) . ", " . selfie_hex2rgb(of_get_option('menu_background_color',$prof_default) , 1) . ");
			background: -moz-linear-gradient(bottom, " . selfie_hex2rgb(of_get_option('menu_background_color',$prof_default) , 0) . ", " . selfie_hex2rgb(of_get_option('menu_background_color',$prof_default) , 1) . ");
			background: linear-gradient(to top, " . selfie_hex2rgb(of_get_option('menu_background_color',$prof_default) , 0) . ", " . selfie_hex2rgb(of_get_option('menu_background_color',$prof_default) , 1) . ");
		
		}
			
		.woocommerce .wc-proceed-to-checkout a.checkout-button.button,
		.woocommerce table.shop_table td.actions .button,
		.woocommerce .coupon .button{
			background-color: " . of_get_option('theme_color',$prof_default) . ";
			border: 1px solid " . of_get_option('theme_color',$prof_default) . ";
		}		
			
		.selfiew-news-time,
		.woocommerce ul.products li.product .onsale {
		  background: " . of_get_option('theme_color',$prof_default) . " none repeat scroll 0 0;
		}		
		
		.price ins .amount {color: " . of_get_option('theme_color',$prof_default) . ";}
		
		#secondary a.tag:hover, .bg3,
		#navigation-sticky.minified.darken {
			background-color: " . selfie_hex2rgb(of_get_option('sticky_menu_background_color',$prof_default) , of_get_option('menu_background_color_opacity_sticky',$prof_default)) . " !important;
		}

		.blog-audio-container{background:" . of_get_option('theme_color',$prof_default) . ";}
		.proftheme-widget #searchform i.icon-search:hover{color:" . of_get_option('theme_color',$prof_default) . " !important;}
		.tagcloud a:hover{background:" . of_get_option('theme_color',$prof_default) . " !important; color:#fff !important;}

		.trans-nav .nav-menu ul.dropdown-menu li a:hover,
		.nav-menu ul li a:hover,
		.nav-menu ul li.active a:hover,
		.nav-menu ul li.active a {
			color: " . of_get_option('theme_color',$prof_default) . " !important;
		}

		.mobile-nav-button, .selfie-download-cv, .nav-menu ul li a {color: " . of_get_option('menu_items_color',$prof_default) . ";}		
		.darken .mobile-nav-button, .darken .selfie-download-cv, .darken .nav-menu ul li a {color: " . of_get_option('menu_sticky_items',$prof_default) . ";}
		
		@media (max-width: 992px) {
			.trans-nav div.nav-menu ul.nav{background-color: " . selfie_hex2rgb(of_get_option('menu_dropdown_background',$prof_default) , of_get_option('menu_dropdown_opacity',$prof_default)) . ";}
		}
		
		.widget_shopping_cart_content, .trans-nav .nav-menu ul.dropdown-menu {
			background-color: " . selfie_hex2rgb(of_get_option('menu_dropdown_background',$prof_default) , of_get_option('menu_dropdown_opacity',$prof_default)) . ";
		}		
		
		article .post-excerpt a.btn:hover{color:" . of_get_option('theme_color',$prof_default) . " !important;}
		
		.portfolio-items .controls a:hover i , .portfolio-items .controls a i:hover{background:" . of_get_option('theme_color',$prof_default) . "; border:1px solid " . of_get_option('theme_color',$prof_default) . ";}
		
		
		.timeline-icon .bg-primary{background:" . of_get_option('theme_color',$prof_default) . ";}
		.timeline-time {color: " . of_get_option('theme_color',$prof_default) . ";}
		
		.job-ribbon{background: " . of_get_option('theme_color',$prof_default) . ";}
		.job-ribbon::before, .job-ribbon::after {border-color: " . of_get_option('theme_color',$prof_default) . " transparent;}
		
		.portfolio-items .item-info {
			border: 2px solid " . of_get_option('theme_color',$prof_default) . ";
		}		
		
		.mkdf-blog-standard-item-holder-outer .mkdf-blog-standard-image-holder{background-color:" . of_get_option('theme_color',$prof_default) . ";}

		.mkdf-blog-standard-item-holder-outer .mkdf-blog-standard-category a{background-color:" . of_get_option('theme_color',$prof_default) . "; color:#fff;}

		.mkdf-blog-standard-item-holder-outer .mkdf-standard-content-holder:hover .mkdf-blog-standard-category a{background-color:#fff; color:" . of_get_option('theme_color',$prof_default) . ";}

		.cart_list.product_list_widget li.empty,
		.trans-nav .nav-menu ul li.active li a,
		.trans-nav .nav-menu ul.dropdown-menu li a {
			color: " . of_get_option('menu_dropdown_items',$prof_default) . " !important;
		}
				
		";			
		
	$GetStyle .= of_get_option('css_text',$prof_default);
	$GetStyle .= " 
	
	";
	$GetStyle .= "
	
	";
	
	return $GetStyle;
}

/***************************************************/
/*Selfie Import CSS Styles - End*/
/***************************************************/



function selfie_hex2rgb($hex , $opacity) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = 'rgba(' . $r . ',' . $g . ',' . $b . ',' . $opacity . ')';

   return $rgb; 
}



/***************************************************/
/*Selfie Custom Field Icon List - End*/
/***************************************************/
function selfie_create_post_icon_list( $object, $box ) { ?>
	<p>
		<label for="post-icon">Icon</label>
		<br />
		<select name="post-icon" id="post-icon" cols="60" rows="4" tabindex="30" style="width: 97%;">
			<option value="align-left" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'align-left'){ ?> selected="selected" <?php } ?>>Align Left</option>
			<option value="align-center" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'align-center'){ ?> selected="selected" <?php } ?>>Align Center</option>
			<option value="align-right" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'align-right'){ ?> selected="selected" <?php } ?>>Align Right</option>
			<option value="align-justify" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'align-justify'){ ?> selected="selected" <?php } ?>>Align Justify</option>
			<option value="arrows" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrows'){ ?> selected="selected" <?php } ?>>Arrows</option>
			<option value="arrow-left" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrow-left'){ ?> selected="selected" <?php } ?>>Align Justify</option>
			<option value="arrow-right" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrow-right'){ ?> selected="selected" <?php } ?>>Arrow Left</option>
			<option value="arrow-up" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrow-up'){ ?> selected="selected" <?php } ?>>Arrow Up</option>
			<option value="arrow-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrow-down'){ ?> selected="selected" <?php } ?>>Arrow Down</option>
			<option value="asterisk" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'asterisk'){ ?> selected="selected" <?php } ?>>Asterisk</option>
			<option value="arrows-v" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrows-v'){ ?> selected="selected" <?php } ?>>Arrows V</option>
			<option value="arrows-h" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrows-h'){ ?> selected="selected" <?php } ?>>Arrows H</option>
			<option value="arrow-circle-left" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrow-circle-left'){ ?> selected="selected" <?php } ?>>Arrow Circle Left</option>
			<option value="arrow-circle-right" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrow-circle-right'){ ?> selected="selected" <?php } ?>>Arrow Circle Right</option>
			<option value="arrow-circle-up" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrow-circle-up'){ ?> selected="selected" <?php } ?>>Arrow Circle Up</option>
			<option value="arrow-circle-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrow-circle-down'){ ?> selected="selected" <?php } ?>>Arrow Circle Down</option>
			<option value="arrows-alt" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrows-alt'){ ?> selected="selected" <?php } ?>>Arrows Alt</option>
			<option value="ambulance" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'ambulance'){ ?> selected="selected" <?php } ?>>Ambulance</option>
			<option value="adn" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'adn'){ ?> selected="selected" <?php } ?>>Adn</option>
			<option value="angle-double-left" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'angle-double-left'){ ?> selected="selected" <?php } ?>>Angle Double Left</option>
			<option value="angle-double-right" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'angle-double-right'){ ?> selected="selected" <?php } ?>>Angle Double Right</option>
			<option value="angle-double-up" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'angle-double-up'){ ?> selected="selected" <?php } ?>>Angle Double Up</option>
			<option value="angle-double-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'angle-double-down'){ ?> selected="selected" <?php } ?>>Angle Double Down</option>
			<option value="angle-left" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'angle-left'){ ?> selected="selected" <?php } ?>>Angle Left</option>
			<option value="angle-right" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'angle-right'){ ?> selected="selected" <?php } ?>>Angle Right</option>
			<option value="angle-up" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'angle-up'){ ?> selected="selected" <?php } ?>>Angle Up</option>
			<option value="angle-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'angle-down'){ ?> selected="selected" <?php } ?>>Angle Down</option>
			<option value="anchor" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'anchor'){ ?> selected="selected" <?php } ?>>Anchor</option>
			<option value="android" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'android'){ ?> selected="selected" <?php } ?>>Android</option>
			<option value="apple" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'apple'){ ?> selected="selected" <?php } ?>>Apple</option>
			<option value="archive" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'archive'){ ?> selected="selected" <?php } ?>>Archive</option>
			<option value="automobile" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'automobile'){ ?> selected="selected" <?php } ?>>Archive</option>
			<option value="bars" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bars'){ ?> selected="selected" <?php } ?>>Bars</option>
			<option value="backward" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'backward'){ ?> selected="selected" <?php } ?>>Backward</option>
			<option value="ban" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'ban'){ ?> selected="selected" <?php } ?>>Ban</option>
			<option value="barcode" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'barcode'){ ?> selected="selected" <?php } ?>>Barcode</option>
			<option value="bank" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bank'){ ?> selected="selected" <?php } ?>>Bank</option>
			<option value="bell" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bell'){ ?> selected="selected" <?php } ?>>Bell</option>
			<option value="book" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'book'){ ?> selected="selected" <?php } ?>>Book</option>
			<option value="bookmark" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bookmark'){ ?> selected="selected" <?php } ?>>Bookmark</option>
			<option value="bold" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bold'){ ?> selected="selected" <?php } ?>>Bold</option>
			<option value="bullhorn" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bullhorn'){ ?> selected="selected" <?php } ?>>Bullhorn</option>
			<option value="briefcase" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'briefcase'){ ?> selected="selected" <?php } ?>>Briefcase</option>
			<option value="bolt" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bolt'){ ?> selected="selected" <?php } ?>>Bolt</option>
			<option value="beer" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'beer'){ ?> selected="selected" <?php } ?>>Beer</option>
			<option value="behance" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'behance'){ ?> selected="selected" <?php } ?>>Behance</option>
			<option value="bitcoin" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bitcoin'){ ?> selected="selected" <?php } ?>>Bitcoin</option>
			<option value="bitbucket" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bitbucket'){ ?> selected="selected" <?php } ?>>Bitbucket</option>
			<option value="bomb" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bomb'){ ?> selected="selected" <?php } ?>>Bomb</option>
			<option value="glass" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'glass'){ ?> selected="selected" <?php } ?>>Glass</option>
			<option value="bullseye" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bullseye'){ ?> selected="selected" <?php } ?>>Bullseye</option>
			<option value="bug" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bug'){ ?> selected="selected" <?php } ?>>Bug</option>
			<option value="building" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'building'){ ?> selected="selected" <?php } ?>>Building</option>
			<option value="check" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'check'){ ?> selected="selected" <?php } ?>>Check</option>
			<option value="cog" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'cog'){ ?> selected="selected" <?php } ?>>Cog</option>
			<option value="camera" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'camera'){ ?> selected="selected" <?php } ?>>Camera</option>
			<option value="crosshairs" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'crosshairs'){ ?> selected="selected" <?php } ?>>Cross Hairs</option>
			<option value="compress" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'compress'){ ?> selected="selected" <?php } ?>>Compress</option>
			<option value="calendar" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'calendar'){ ?> selected="selected" <?php } ?>>Calendar</option>
			<option value="comment" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'comment'){ ?> selected="selected" <?php } ?>>Comment</option>
			<option value="cogs" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'cogs'){ ?> selected="selected" <?php } ?>>Cogs</option>
			<option value="comments" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'comments'){ ?> selected="selected" <?php } ?>>Comments</option>
			<option value="credit-card" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'credit-card'){ ?> selected="selected" <?php } ?>>Credit Card</option>
			<option value="certificate" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'certificate'){ ?> selected="selected" <?php } ?>>Certificate</option>
			<option value="chain" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'chain'){ ?> selected="selected" <?php } ?>>Chain</option>
			<option value="cloud" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'cloud'){ ?> selected="selected" <?php } ?>>Cloud</option>
			<option value="cut" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'cut'){ ?> selected="selected" <?php } ?>>Cut</option>
			<option value="copy" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'copy'){ ?> selected="selected" <?php } ?>>Copy</option>
			<option value="caret-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'caret-down'){ ?> selected="selected" <?php } ?>>Caret Down</option>
			<option value="caret-up" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'caret-up'){ ?> selected="selected" <?php } ?>>Caret Up</option>
			<option value="caret-left" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'caret-left'){ ?> selected="selected" <?php } ?>>Caret Left</option>
			<option value="caret-right" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'caret-right'){ ?> selected="selected" <?php } ?>>Caret Right</option>
			<option value="columns" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'columns'){ ?> selected="selected" <?php } ?>>Columns</option>
			<option value="clipboard" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'clipboard'){ ?> selected="selected" <?php } ?>>Clipboard</option>
			<option value="cloud-download" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'cloud-download'){ ?> selected="selected" <?php } ?>>Cloud Download</option>
			<option value="cloud-upload" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'cloud-upload'){ ?> selected="selected" <?php } ?>>Cloud Upload</option>
			<option value="coffee" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'coffee'){ ?> selected="selected" <?php } ?>>Coffee</option>
			<option value="cutlery" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'cutlery'){ ?> selected="selected" <?php } ?>>Cutlery</option>
			<option value="car" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'car'){ ?> selected="selected" <?php } ?>>Car</option>
			<option value="cab" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'cab'){ ?> selected="selected" <?php } ?>>Cab</option>
			<option value="chevron-circle-left" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'chevron-circle-left'){ ?> selected="selected" <?php } ?>>Chevron Circle Left</option>
			<option value="chevron-circle-right" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'chevron-circle-right'){ ?> selected="selected" <?php } ?>>Chevron Circle Right</option>
			<option value="chevron-circle-up" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'chevron-circle-up'){ ?> selected="selected" <?php } ?>>Chevron Circle Up</option>
			<option value="chevron-circle-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'chevron-circle-down'){ ?> selected="selected" <?php } ?>>Chevron Circle Down</option>
			<option value="check-square" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'check-square'){ ?> selected="selected" <?php } ?>>Check Square</option>
			<option value="child" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'child'){ ?> selected="selected" <?php } ?>>Child</option>
			<option value="chain-broken" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'chain-broken'){ ?> selected="selected" <?php } ?>>Chain Broken</option>
			<option value="circle" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'circle'){ ?> selected="selected" <?php } ?>>Circle</option>
			<option value="circle-thin" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'circle-thin'){ ?> selected="selected" <?php } ?>>Circle Thin</option>
			<option value="cny" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'cny'){ ?> selected="selected" <?php } ?>>CNY</option>
			<option value="code" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'code'){ ?> selected="selected" <?php } ?>>Code</option>
			<option value="compass" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'compass'){ ?> selected="selected" <?php } ?>>Compass</option>
			<option value="codepen" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'codepen'){ ?> selected="selected" <?php } ?>>Code Pen</option>
			<option value="css3" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'css3'){ ?> selected="selected" <?php } ?>>CSS3</option>
			<option value="cube" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'cube'){ ?> selected="selected" <?php } ?>>Cube</option>
			<option value="cubes" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'cubes'){ ?> selected="selected" <?php } ?>>Cubes</option>
			<option value="download" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'download'){ ?> selected="selected" <?php } ?>>Download</option>
			<option value="dedent" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'dedent'){ ?> selected="selected" <?php } ?>>Dedent</option>
			<option value="dashboard" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'dashboard'){ ?> selected="selected" <?php } ?>>Dashboard</option>
			<option value="database" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'database'){ ?> selected="selected" <?php } ?>>Database</option>
			<option value="glass" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'glass'){ ?> selected="selected" <?php } ?>>Glass</option>
			<option value="desktop" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'desktop'){ ?> selected="selected" <?php } ?>>Desktop</option>
			<option value="delicious" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'delicious'){ ?> selected="selected" <?php } ?>>Delicious</option>
			<option value="drupal" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'drupal'){ ?> selected="selected" <?php } ?>>Drupal</option>
			<option value="dribbble" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'dribbble'){ ?> selected="selected" <?php } ?>>Dribbble</option>
			<option value="dropbox" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'dropbox'){ ?> selected="selected" <?php } ?>>Dropbox</option>
			<option value="dollar" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'dollar'){ ?> selected="selected" <?php } ?>>Dollar</option>
			<option value="digg" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'digg'){ ?> selected="selected" <?php } ?>>Digg</option>
			<option value="exchange" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'exchange'){ ?> selected="selected" <?php } ?>>Exchange</option>
			<option value="eyedropper" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'eyedropper'){ ?> selected="selected" <?php } ?>>Eye Dropper</option>
			<option value="eject" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'eject'){ ?> selected="selected" <?php } ?>>Eject</option>
			<option value="expand" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'expand'){ ?> selected="selected" <?php } ?>>Expand</option>
			<option value="exclamation-circle" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'exclamation-circle'){ ?> selected="selected" <?php } ?>>Exclamation Circle</option>
			<option value="eye" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'eye'){ ?> selected="selected" <?php } ?>>Eye</option>
			<option value="eye-slash" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'eye-slash'){ ?> selected="selected" <?php } ?>>Eye Slash</option>
			<option value="exclamation-triangle" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'exclamation-triangle'){ ?> selected="selected" <?php } ?>>Exclamation Triangle</option>
			<option value="external-link" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'external-link'){ ?> selected="selected" <?php } ?>>External Link</option>
			<option value="envelope" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'envelope'){ ?> selected="selected" <?php } ?>>Envelope</option>
			<option value="empire" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'empire'){ ?> selected="selected" <?php } ?>>Empire</option>
			<option value="eraser" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'eraser'){ ?> selected="selected" <?php } ?>>Eraser</option>
			<option value="exclamation" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'exclamation'){ ?> selected="selected" <?php } ?>>Exclamation</option>
			<option value="ellipsis-h" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'ellipsis-h'){ ?> selected="selected" <?php } ?>>Ellipsis H</option>
			<option value="ellipsis-v" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'ellipsis-v'){ ?> selected="selected" <?php } ?>>Ellipsis V</option>
			<option value="euro" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'euro'){ ?> selected="selected" <?php } ?>>Euro</option>
			<option value="eur" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'eur'){ ?> selected="selected" <?php } ?>>Eur</option>
			<option value="flash" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'flash'){ ?> selected="selected" <?php } ?>>Flash</option>
			<option value="fighter-jet" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'fighter-jet'){ ?> selected="selected" <?php } ?>>Fighter Jet</option>
			<option value="film" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'film'){ ?> selected="selected" <?php } ?>>Film</option>
			<option value="flag" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'flag'){ ?> selected="selected" <?php } ?>>Flag</option>
			<option value="font" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'font'){ ?> selected="selected" <?php } ?>>Font</option>
			<option value="fast-backward" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'fast-backward'){ ?> selected="selected" <?php } ?>>Fast Backward</option>
			<option value="forward" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'forward'){ ?> selected="selected" <?php } ?>>Forward</option>
			<option value="fast-forward" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'fast-forward'){ ?> selected="selected" <?php } ?>>Fast Forward</option>
			<option value="fire" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'fire'){ ?> selected="selected" <?php } ?>>Fire</option>
			<option value="folder" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'folder'){ ?> selected="selected" <?php } ?>>Folder</option>
			<option value="folder-open" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'folder-open'){ ?> selected="selected" <?php } ?>>Folder Open</option>
			<option value="facebook" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'facebook'){ ?> selected="selected" <?php } ?>>Facebook</option>
			<option value="filter" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'filter'){ ?> selected="selected" <?php } ?>>Filter</option>
			<option value="fax" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'fax'){ ?> selected="selected" <?php } ?>>Fax</option>
			<option value="female" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'female'){ ?> selected="selected" <?php } ?>>Female</option>
			<option value="foursquare" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'foursquare'){ ?> selected="selected" <?php } ?>>foursquare</option>
			<option value="fire-extinguisher" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'fire-extinguisher'){ ?> selected="selected" <?php } ?>>Fire Extinguisher</option>
			<option value="flag-checkered" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'flag-checkered'){ ?> selected="selected" <?php } ?>>Flag Checkered</option>
			<option value="file" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'file'){ ?> selected="selected" <?php } ?>>File</option>
			<option value="file-text" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'file-text'){ ?> selected="selected" <?php } ?>>File Text</option>
			<option value="flickr" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'flickr'){ ?> selected="selected" <?php } ?>>flickr</option>
			<option value="google-plus" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'google-plus'){ ?> selected="selected" <?php } ?>>Google Plus</option>
			<option value="gavel" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'gavel'){ ?> selected="selected" <?php } ?>>Gavel</option>
			<option value="glass" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'glass'){ ?> selected="selected" <?php } ?>>Glass</option>
			<option value="gear" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'gear'){ ?> selected="selected" <?php } ?>>Gear</option>
			<option value="gift" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'gift'){ ?> selected="selected" <?php } ?>>Gift</option>
			<option value="gears" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'gears'){ ?> selected="selected" <?php } ?>>Gears</option>
			<option value="github" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'github'){ ?> selected="selected" <?php } ?>>Github</option>
			<option value="globe" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'globe'){ ?> selected="selected" <?php } ?>>Globe</option>
			<option value="group" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'group'){ ?> selected="selected" <?php } ?>>Group</option>
			<option value="google" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'google'){ ?> selected="selected" <?php } ?>>Google</option>
			<option value="graduation-cap" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'graduation-cap'){ ?> selected="selected" <?php } ?>>Graduation Cap</option>
			<option value="gittip" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'gittip'){ ?> selected="selected" <?php } ?>>Gittip</option>
			<option value="gbp" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'gbp'){ ?> selected="selected" <?php } ?>>GBP</option>
			<option value="gamepad" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'gamepad'){ ?> selected="selected" <?php } ?>>Game Pad</option>
			<option value="git" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'git'){ ?> selected="selected" <?php } ?>>GIT</option>
			<option value="heart" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'heart'){ ?> selected="selected" <?php } ?>>Heart</option>
			<option value="home" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'home'){ ?> selected="selected" <?php } ?>>Home</option>
			<option value="headphones" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'headphones'){ ?> selected="selected" <?php } ?>>Headphones</option>
			<option value="header" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'header'){ ?> selected="selected" <?php } ?>>Header</option>
			<option value="history" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'history'){ ?> selected="selected" <?php } ?>>History</option>
			<option value="hacker-news" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'hacker-news'){ ?> selected="selected" <?php } ?>>Hacker News</option>
			<option value="html5" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'html5'){ ?> selected="selected" <?php } ?>>HTML5</option>
			<option value="h-square" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'h-square'){ ?> selected="selected" <?php } ?>>H Square</option>
			<option value="italic" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'italic'){ ?> selected="selected" <?php } ?>>Italic</option>
			<option value="indent" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'indent'){ ?> selected="selected" <?php } ?>>Indent</option>
			<option value="image" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'image'){ ?> selected="selected" <?php } ?>>Image</option>
			<option value="inverse" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'inverse'){ ?> selected="selected" <?php } ?>>Inverse</option>
			<option value="inbox" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'inbox'){ ?> selected="selected" <?php } ?>>Inbox</option>
			<option value="institution" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'institution'){ ?> selected="selected" <?php } ?>>Institution</option>
			<option value="instagram" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'instagram'){ ?> selected="selected" <?php } ?>>Instagram</option>
			<option value="inr" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'inr'){ ?> selected="selected" <?php } ?>>INR</option>
			<option value="info" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'info'){ ?> selected="selected" <?php } ?>>Info</option>
			<option value="jsfiddle" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'jsfiddle'){ ?> selected="selected" <?php } ?>>JS Fiddle</option>
			<option value="joomla" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'joomla'){ ?> selected="selected" <?php } ?>>Joomla</option>
			<option value="jpy" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'jpy'){ ?> selected="selected" <?php } ?>>JPY</option>
			<option value="key" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'key'){ ?> selected="selected" <?php } ?>>Key</option>
			<option value="krw" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'krw'){ ?> selected="selected" <?php } ?>>KRW</option>
			<option value="link" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'link'){ ?> selected="selected" <?php } ?>>Link</option>
			<option value="list-ul" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'list-ul'){ ?> selected="selected" <?php } ?>>List Ul</option>
			<option value="list-ol" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'list-ol'){ ?> selected="selected" <?php } ?>>List OL</option>
			<option value="linkedin" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'linkedin'){ ?> selected="selected" <?php } ?>>LinkedIn</option>
			<option value="legal" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'legal'){ ?> selected="selected" <?php } ?>>Legal</option>
			<option value="list-alt" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'list-alt'){ ?> selected="selected" <?php } ?>>List Alt</option>
			<option value="lock" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'lock'){ ?> selected="selected" <?php } ?>>Lock</option>
			<option value="list" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'list'){ ?> selected="selected" <?php } ?>>List</option>
			<option value="leaf" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'leaf'){ ?> selected="selected" <?php } ?>>Leaf</option>
			<option value="life-bouy" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'life-bouy'){ ?> selected="selected" <?php } ?>>Lifebouy</option>
			<option value="life-saver" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'life-saver'){ ?> selected="selected" <?php } ?>>Life Saver</option>
			<option value="language" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'language'){ ?> selected="selected" <?php } ?>>Language</option>
			<option value="laptop" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'laptop'){ ?> selected="selected" <?php } ?>>Laptop</option>
			<option value="level-up" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'level-up'){ ?> selected="selected" <?php } ?>>Level up</option>
			<option value="level-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'level-down'){ ?> selected="selected" <?php } ?>>Level Down</option>
			<option value="linux" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'linux'){ ?> selected="selected" <?php } ?>>Linux</option>
			<option value="life-ring" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'life-ring'){ ?> selected="selected" <?php } ?>>Life Ring</option>
			<option value="magnet" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'magnet'){ ?> selected="selected" <?php } ?>>Magnet</option>
			<option value="map-marker" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'map-marker'){ ?> selected="selected" <?php } ?>>Map Marker</option>
			<option value="magic" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'magic'){ ?> selected="selected" <?php } ?>>Magic</option>
			<option value="money" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'money'){ ?> selected="selected" <?php } ?>>Money</option>
			<option value="medkit" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'medkit'){ ?> selected="selected" <?php } ?>>Med kit</option>
			<option value="music" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'music'){ ?> selected="selected" <?php } ?>>Music</option>
			<option value="mail-forward" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'mail-forward'){ ?> selected="selected" <?php } ?>>Mail Forward</option>
			<option value="minus" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'minus'){ ?> selected="selected" <?php } ?>>Minus</option>
			<option value="mortar-board" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'mortar-board'){ ?> selected="selected" <?php } ?>>Mortar Board</option>
			<option value="male" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'male'){ ?> selected="selected" <?php } ?>>Male</option>
			<option value="mobile-phone" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'mobile-phone'){ ?> selected="selected" <?php } ?>>Mobile Phone</option>
			<option value="mobile" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'mobile'){ ?> selected="selected" <?php } ?>>Mobile</option>
			<option value="mail-reply" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'mail-reply'){ ?> selected="selected" <?php } ?>>Mail Reply</option>
			<option value="microphone" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'microphone'){ ?> selected="selected" <?php } ?>>Microphone</option>
			<option value="microphone-slash" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'microphone-slash'){ ?> selected="selected" <?php } ?>>Microphone Slash</option>
			<option value="navicon" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'navicon'){ ?> selected="selected" <?php } ?>>Nav icon</option>
			<option value="lightbulb-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'lightbulb-o'){ ?> selected="selected" <?php } ?>>Open Lightbulb</option>
			<option value="bell-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bell-o'){ ?> selected="selected" <?php } ?>>Open Bell</option>
			<option value="building-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'building-o'){ ?> selected="selected" <?php } ?>>Open Building</option>
			<option value="hospital-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'hospital-o'){ ?> selected="selected" <?php } ?>>Open Hospital</option>
			<option value="envelope-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'envelope-o'){ ?> selected="selected" <?php } ?>>Open Envelope</option>
			<option value="star-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'star-o'){ ?> selected="selected" <?php } ?>>Open Star</option>
			<option value="trash-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'trash-o'){ ?> selected="selected" <?php } ?>>Open Trash</option>
			<option value="file-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'file-o'){ ?> selected="selected" <?php } ?>>Open File</option>
			<option value="clock-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'clock-o'){ ?> selected="selected" <?php } ?>>Open Clock</option>
			<option value="outdent" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'outdent'){ ?> selected="selected" <?php } ?>>Outdent</option>
			<option value="picture-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'picture-o'){ ?> selected="selected" <?php } ?>>Open Picture</option>
			<option value="pencil-square-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'pencil-square-o'){ ?> selected="selected" <?php } ?>>Open Pencil Square</option>
			<option value="bar-chart-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bar-chart-o'){ ?> selected="selected" <?php } ?>>Open Bar Chart</option>
			<option value="thumbs-o-up" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'thumbs-o-up'){ ?> selected="selected" <?php } ?>>Open Thumbs Up</option>
			<option value="thumbs-o-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'thumbs-o-down'){ ?> selected="selected" <?php } ?>>Open Thumbs Down</option>
			<option value="heart-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'heart-o'){ ?> selected="selected" <?php } ?>>Open Heart</option>
			<option value="lemon-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'lemon-o'){ ?> selected="selected" <?php } ?>>Open Lemon</option>
			<option value="square" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'square'){ ?> selected="selected" <?php } ?>>Open Square</option>
			<option value="bookmark-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bookmark-o'){ ?> selected="selected" <?php } ?>>Open Bookmark</option>
			<option value="hdd-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'hdd-o'){ ?> selected="selected" <?php } ?>>Open hdd</option>
			<option value="hand-o-right" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'hand-o-right'){ ?> selected="selected" <?php } ?>>Open Hand Right</option>
			<option value="hand-o-left" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'hand-o-left'){ ?> selected="selected" <?php } ?>>Open Hand Left</option>
			<option value="hand-o-up" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'hand-o-up'){ ?> selected="selected" <?php } ?>>Open Hand Up</option>
			<option value="hand-o-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'hand-o-down'){ ?> selected="selected" <?php } ?>>Open Hand Down</option>
			<option value="files-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'files-o'){ ?> selected="selected" <?php } ?>>Open Files</option>
			<option value="floppy-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'floppy-o'){ ?> selected="selected" <?php } ?>>Open Floppy</option>
			<option value="circle-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'circle-o'){ ?> selected="selected" <?php } ?>>Open Circle</option>
			<option value="folder-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'folder-o'){ ?> selected="selected" <?php } ?>>Open Folder</option>
			<option value="smile-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'smile-o'){ ?> selected="selected" <?php } ?>>Open Smile</option>
			<option value="pinterest" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'pinterest'){ ?> selected="selected" <?php } ?>>Pinterest</option>
			<option value="paste" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'paste'){ ?> selected="selected" <?php } ?>>Paste</option>
			<option value="power-off" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'power-off'){ ?> selected="selected" <?php } ?>>Power Off</option>
			<option value="print" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'print'){ ?> selected="selected" <?php } ?>>Print</option>
			<option value="photo" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'photo'){ ?> selected="selected" <?php } ?>>Photo</option>
			<option value="play" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'play'){ ?> selected="selected" <?php } ?>>Play</option>
			<option value="pause" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'pause'){ ?> selected="selected" <?php } ?>>Pause</option>
			<option value="plus-circle" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'plus-circle'){ ?> selected="selected" <?php } ?>>Plus Circle</option>
			<option value="plus" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'plus'){ ?> selected="selected" <?php } ?>>Plus</option>
			<option value="plane" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'plane'){ ?> selected="selected" <?php } ?>>Plane</option>
			<option value="phone" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'phone'){ ?> selected="selected" <?php } ?>>Phone</option>
			<option value="phone-square" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'phone-square'){ ?> selected="selected" <?php } ?>>Phone Square</option>
			<option value="paperclip" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'paperclip'){ ?> selected="selected" <?php } ?>>Paper Clip</option>
			<option value="puzzle-piece" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'puzzle-piece'){ ?> selected="selected" <?php } ?>>Puzzle Piece</option>
			<option value="play-circle" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'play-circle'){ ?> selected="selected" <?php } ?>>Play Circle</option>
			<option value="pencil-square" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'pencil-square'){ ?> selected="selected" <?php } ?>>Pencil Square</option>
			<option value="pagelines" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'pagelines'){ ?> selected="selected" <?php } ?>>Page Lines</option>
			<option value="pied-piper-square" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'pied-piper-square'){ ?> selected="selected" <?php } ?>>Pied Piper Square</option>
			<option value="pied-piper" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'pied-piper'){ ?> selected="selected" <?php } ?>>Pied Piper</option>
			<option value="pied-piper-alt" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'pied-piper-alt'){ ?> selected="selected" <?php } ?>>Pied Piper Alt</option>
			<option value="paw" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'paw'){ ?> selected="selected" <?php } ?>>Paw</option>
			<option value="paper-plane" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'paper-plane'){ ?> selected="selected" <?php } ?>>Paper Plane</option>
			<option value="paragraph" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'paragraph'){ ?> selected="selected" <?php } ?>>Paragraph</option>
			<option value="plus-square" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'plus-square'){ ?> selected="selected" <?php } ?>>Plus Square</option>
			<option value="qrcode" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'qrcode'){ ?> selected="selected" <?php } ?>>QR Code</option>
			<option value="question-circle" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'question-circle'){ ?> selected="selected" <?php } ?>>Question Circle</option>
			<option value="question" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'question'){ ?> selected="selected" <?php } ?>>Question</option>
			<option value="qq" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'qq'){ ?> selected="selected" <?php } ?>>QQ</option>
			<option value="quote-left" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'quote-left'){ ?> selected="selected" <?php } ?>>Quote Left</option>
			<option value="quote-right" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'quote-right'){ ?> selected="selected" <?php } ?>>Quote Right</option>
			<option value="random" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'random'){ ?> selected="selected" <?php } ?>>Random</option>
			<option value="retweet" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'retweet'){ ?> selected="selected" <?php } ?>>Retweet</option>
			<option value="rss" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'rss'){ ?> selected="selected" <?php } ?>>RSS</option>
			<option value="reorder" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'reorder'){ ?> selected="selected" <?php } ?>>Reorder</option>
			<option value="rotate-left" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'rotate-left'){ ?> selected="selected" <?php } ?>>Rotate Left</option>
			<option value="rotate-right" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'rotate-right'){ ?> selected="selected" <?php } ?>>Rotate Right</option>
			<option value="road" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'road'){ ?> selected="selected" <?php } ?>>Road</option>
			<option value="repeat" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'repeat'){ ?> selected="selected" <?php } ?>>Repeat</option>
			<option value="refresh" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'refresh'){ ?> selected="selected" <?php } ?>>Refresh</option>
			<option value="reply" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'reply'){ ?> selected="selected" <?php } ?>>Reply</option>
			<option value="rocket" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'rocket'){ ?> selected="selected" <?php } ?>>Rocket</option>
			<option value="rupee" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'rupee'){ ?> selected="selected" <?php } ?>>Rupee</option>
			<option value="rmb" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'rmb'){ ?> selected="selected" <?php } ?>>RMB</option>
			<option value="ruble" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'ruble'){ ?> selected="selected" <?php } ?>>Ruble</option>
			<option value="rouble" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'rouble'){ ?> selected="selected" <?php } ?>>Rouble</option>
			<option value="rub" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'rub'){ ?> selected="selected" <?php } ?>>Rub</option>
			<option value="renren" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'renren'){ ?> selected="selected" <?php } ?>>Renren</option>
			<option value="reddit" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'reddit'){ ?> selected="selected" <?php } ?>>Reddit</option>
			<option value="recycle" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'recycle'){ ?> selected="selected" <?php } ?>>Recycle</option>
			<option value="rebel" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'rebel'){ ?> selected="selected" <?php } ?>>Rebel</option>
			<option value="step-backward" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'step-backward'){ ?> selected="selected" <?php } ?>>Step Backward</option>
			<option value="stop" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'stop'){ ?> selected="selected" <?php } ?>>Stop</option>
			<option value="step-forward" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'step-forward'){ ?> selected="selected" <?php } ?>>Step Forward</option>
			<option value="shopping-cart" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'shopping-cart'){ ?> selected="selected" <?php } ?>>Shopping Cart</option>
			<option value="star-half" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'star-half'){ ?> selected="selected" <?php } ?>>Star Half</option>
			<option value="sign-out" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'sign-out'){ ?> selected="selected" <?php } ?>>Sign Out</option>
			<option value="sign-in" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'sign-in'){ ?> selected="selected" <?php } ?>>Sign In</option>
			<option value="scissors" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'scissors'){ ?> selected="selected" <?php } ?>>Scissors</option>
			<option value="save" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'save'){ ?> selected="selected" <?php } ?>>Save</option>
			<option value="square" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'square'){ ?> selected="selected" <?php } ?>>Square</option>
			<option value="strikethrough" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'strikethrough'){ ?> selected="selected" <?php } ?>>Strike Through</option>
			<option value="sort" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'sort'){ ?> selected="selected" <?php } ?>>Sort</option>
			<option value="sort-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'sort-down'){ ?> selected="selected" <?php } ?>>Sort Down</option>
			<option value="sitemap" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'sitemap'){ ?> selected="selected" <?php } ?>>Site map</option>
			<option value="search" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'search'){ ?> selected="selected" <?php } ?>>Search</option>
			<option value="star" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'star'){ ?> selected="selected" <?php } ?>>Star</option>
			<option value="stethoscope" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'stethoscope'){ ?> selected="selected" <?php } ?>>Stethoscope</option>
			<option value="suitcase" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'suitcase'){ ?> selected="selected" <?php } ?>>Suitcase</option>
			<option value="search-plus" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'search-plus'){ ?> selected="selected" <?php } ?>>Search Plus</option>
			<option value="search-minus" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'search-minus'){ ?> selected="selected" <?php } ?>>Search Minus</option>
			<option value="signal" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'signal'){ ?> selected="selected" <?php } ?>>Signal</option>
			<option value="spinner" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'spinner'){ ?> selected="selected" <?php } ?>>Spinner</option>
			<option value="superscript" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'superscript'){ ?> selected="selected" <?php } ?>>Superscript</option>
			<option value="subscript" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'subscript'){ ?> selected="selected" <?php } ?>>Subscript</option>
			<option value="shield" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'shield'){ ?> selected="selected" <?php } ?>>Shield</option>
			<option value="stack-overflow" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'stack-overflow'){ ?> selected="selected" <?php } ?>>Stack Overflow</option>
			<option value="skype" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'skype'){ ?> selected="selected" <?php } ?>>Skype</option>
			<option value="stack-exchange" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'stack-exchange'){ ?> selected="selected" <?php } ?>>Stack Exchange</option>
			<option value="space-shuttle" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'space-shuttle'){ ?> selected="selected" <?php } ?>>Space Shuttle</option>
			<option value="slack" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'slack'){ ?> selected="selected" <?php } ?>>Slack</option>
			<option value="stumbleupon-circle" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'stumbleupon-circle'){ ?> selected="selected" <?php } ?>>Stumbleupon Circle</option>
			<option value="stumbleupon" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'stumbleupon'){ ?> selected="selected" <?php } ?>>Stumbleupon</option>
			<option value="spoon" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'spoon'){ ?> selected="selected" <?php } ?>>Spoon</option>
			<option value="steam" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'steam'){ ?> selected="selected" <?php } ?>>Steam</option>
			<option value="spotify" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'spotify'){ ?> selected="selected" <?php } ?>>Spotify</option>
			<option value="soundcloud" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'soundcloud'){ ?> selected="selected" <?php } ?>>Soundcloud</option>
			<option value="support" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'support'){ ?> selected="selected" <?php } ?>>Support</option>
			<option value="send" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'send'){ ?> selected="selected" <?php } ?>>Send</option>
			<option value="sliders" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'sliders'){ ?> selected="selected" <?php } ?>>Sliders</option>
			<option value="share-alt" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'share-alt'){ ?> selected="selected" <?php } ?>>Share Alt</option>
			<option value="tag" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'tag'){ ?> selected="selected" <?php } ?>>Tag</option>
			<option value="tags" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'tags'){ ?> selected="selected" <?php } ?>>Tags</option>
			<option value="text-height" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'text-height'){ ?> selected="selected" <?php } ?>>Text Height</option>
			<option value="text-width" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'text-width'){ ?> selected="selected" <?php } ?>>Text Width</option>
			<option value="times-circle" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'times-circle'){ ?> selected="selected" <?php } ?>>Times Circle</option>
			<option value="thumb-tack" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'thumb-tack'){ ?> selected="selected" <?php } ?>>Thumb Tack</option>
			<option value="trophy" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'trophy'){ ?> selected="selected" <?php } ?>>Trophy</option>
			<option value="twitter" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'twitter'){ ?> selected="selected" <?php } ?>>Twitter</option>
			<option value="tasks" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'tasks'){ ?> selected="selected" <?php } ?>>Tasks</option>
			<option value="truck" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'truck'){ ?> selected="selected" <?php } ?>>Truck</option>
			<option value="tachometer" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'tachometer'){ ?> selected="selected" <?php } ?>>Tachometer</option>
			<option value="th-large" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'th-large'){ ?> selected="selected" <?php } ?>>Thumbnail Large</option>
			<option value="th" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'th'){ ?> selected="selected" <?php } ?>>Thumbnail</option>
			<option value="th-list" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'th-list'){ ?> selected="selected" <?php } ?>>Thumbnail</option>
			<option value="th" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'th'){ ?> selected="selected" <?php } ?>>Thumbnail List</option>
			<option value="times" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'times'){ ?> selected="selected" <?php } ?>>Times</option>
			<option value="ticket" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'ticket'){ ?> selected="selected" <?php } ?>>Ticket</option>
			<option value="toggle-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'toggle-down'){ ?> selected="selected" <?php } ?>>Toggle Down</option>
			<option value="toggle-up" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'toggle-up'){ ?> selected="selected" <?php } ?>>Toggle Up</option>
			<option value="toggle-right" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'toggle-right'){ ?> selected="selected" <?php } ?>>Toggle Right</option>
			<option value="tumblr" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'tumblr'){ ?> selected="selected" <?php } ?>>Tumblr</option>
			<option value="trello" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'trello'){ ?> selected="selected" <?php } ?>>Trello</option>
			<option value="toggle-left" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'toggle-left'){ ?> selected="selected" <?php } ?>>Toggle Left</option>
			<option value="turkish-lira" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'turkish-lira'){ ?> selected="selected" <?php } ?>>Turkish Lira</option>
			<option value="try" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'try'){ ?> selected="selected" <?php } ?>>Try</option>
			<option value="taxi" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'taxi'){ ?> selected="selected" <?php } ?>>Taxi</option>
			<option value="tree" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'tree'){ ?> selected="selected" <?php } ?>>Tree</option>
			<option value="tencent-weibo" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'tencent-weibo'){ ?> selected="selected" <?php } ?>>Tencent Weibo</option>
			<option value="tablet" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'tablet'){ ?> selected="selected" <?php } ?>>Tablet</option>
			<option value="terminal" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'terminal'){ ?> selected="selected" <?php } ?>>Terminal</option>
			<option value="upload" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'upload'){ ?> selected="selected" <?php } ?>>Upload</option>
			<option value="unlock" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'unlock'){ ?> selected="selected" <?php } ?>>Unlock</option>
			<option value="users" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'users'){ ?> selected="selected" <?php } ?>>Users</option>
			<option value="underline" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'underline'){ ?> selected="selected" <?php } ?>>Underline</option>
			<option value="unsorted" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'unsorted'){ ?> selected="selected" <?php } ?>>Unsorted</option>
			<option value="undo" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'undo'){ ?> selected="selected" <?php } ?>>Undo</option>
			<option value="user-md" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'user-md'){ ?> selected="selected" <?php } ?>>User MD</option>
			<option value="umbrella" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'umbrella'){ ?> selected="selected" <?php } ?>>Umbrella</option>
			<option value="user" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'user'){ ?> selected="selected" <?php } ?>>User</option>
			<option value="unlock-alt" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'unlock-alt'){ ?> selected="selected" <?php } ?>>Unlock Alt</option>
			<option value="usd" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'usd'){ ?> selected="selected" <?php } ?>>USD</option>
			<option value="university" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'university'){ ?> selected="selected" <?php } ?>>University</option>
			<option value="unlink" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'unlink'){ ?> selected="selected" <?php } ?>>Unlink</option>
			<option value="volume-off" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'volume-off'){ ?> selected="selected" <?php } ?>>Volume Off</option>
			<option value="volume-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'volume-down'){ ?> selected="selected" <?php } ?>>Volume Down</option>
			<option value="volume-up" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'volume-up'){ ?> selected="selected" <?php } ?>>Volume Up</option>
			<option value="video-camera" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'video-camera'){ ?> selected="selected" <?php } ?>>Video Camera</option>
			<option value="vk" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'vk'){ ?> selected="selected" <?php } ?>>VK</option>
			<option value="vine" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'vine'){ ?> selected="selected" <?php } ?>>Vine</option>
			<option value="warning" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'warning'){ ?> selected="selected" <?php } ?>>Warning</option>
			<option value="wrench" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'wrench'){ ?> selected="selected" <?php } ?>>Wrench</option>
			<option value="won" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'won'){ ?> selected="selected" <?php } ?>>Won</option>
			<option value="windows" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'windows'){ ?> selected="selected" <?php } ?>>Windows</option>
			<option value="weibo" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'weibo'){ ?> selected="selected" <?php } ?>>Weibo</option>
			<option value="wheelchair" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'wheelchair'){ ?> selected="selected" <?php } ?>>Wheel Chair</option>
			<option value="wordpress" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'wordpress'){ ?> selected="selected" <?php } ?>>WordPress</option>
			<option value="wechat" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'wechat'){ ?> selected="selected" <?php } ?>>We Chat</option>
			<option value="weixin" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'weixin'){ ?> selected="selected" <?php } ?>>Weixin</option>
			<option value="xing" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'xing'){ ?> selected="selected" <?php } ?>>Xing</option>
			<option value="yen" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'yen'){ ?> selected="selected" <?php } ?>>Yen</option>
			<option value="youtube" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'youtube'){ ?> selected="selected" <?php } ?>>YouTube</option>
			<option value="yahoo" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'yahoo'){ ?> selected="selected" <?php } ?>>Yahoo</option>
		</select> 
		<input type="hidden" name="meta_box_icon" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }
/***************************************************/
/*Selfie Custom Field Icon List - End*/
/***************************************************/

?>