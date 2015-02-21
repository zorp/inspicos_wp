<?php
/**
 * Header data
 *
 * @package WordPress
 * @subpackage StereoClub
 * @since StereoClub 1.0
 */


/*-----------------------------------------------------------------------------------*/
/*	Include CSS
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wpl_css_include' ) ) {
	
	function wpl_css_include () {

		/*-----------------------------------------------------------
			Loads our main stylesheet.
		-----------------------------------------------------------*/
		wp_enqueue_style( 'stereoclub-style', get_stylesheet_uri(), array(), '2013-07-18' );
		
		/*-----------------------------------------------------------
			Custom Font-Icon
		-----------------------------------------------------------*/

		wp_register_style('fonts', get_template_directory_uri().'/css/customicons/style.css', 'css', '');
		wp_enqueue_style('fonts');

		/*-----------------------------------------------------------
			FlexSlider
		-----------------------------------------------------------*/
		
		wp_register_style('flexslider', get_template_directory_uri().'/css/flexslider.css', 'css', '');
		wp_enqueue_style('flexslider');

		/*-----------------------------------------------------------
			Grid
		-----------------------------------------------------------*/
		
		wp_register_style('grid', get_template_directory_uri().'/css/grid.css', 'css', '');
		wp_enqueue_style('grid');

		/*-----------------------------------------------------------
			Include google maps 
		-----------------------------------------------------------*/

		wp_deregister_script('googlemaps');
		wp_register_script('googlemaps', 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false', NULL, true);
		wp_enqueue_script('googlemaps');

		/*-----------------------------------------------------------
			meanMenu
		-----------------------------------------------------------*/
		
		wp_register_style('meanmenu', get_template_directory_uri().'/css/meanmenu.css', 'css', '');
		wp_enqueue_style('meanmenu');

		/*-----------------------------------------------------------------------------------*/
		/*	Keyframe / animation
		/*-----------------------------------------------------------------------------------*/
		
		wp_register_style('keyframes', get_template_directory_uri().'/css/keyframes.css', 'css', '');
		wp_enqueue_style('keyframes');

		/*-----------------------------------------------------------------------------------*/
		/*	prettyPhoto
		/*-----------------------------------------------------------------------------------*/
		
		wp_register_style('prettyPhoto', get_template_directory_uri().'/inc/prettyPhoto/css/prettyPhoto.css', 'css', '');
		wp_enqueue_style('prettyPhoto');

	}
	add_action( 'wp_enqueue_scripts', 'wpl_css_include' );
}

/*-----------------------------------------------------------------------------------*/
/*	Include Java Scripts
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wpl_scripts_include' ) ) {
	
	function wpl_scripts_include() {
		
		/*-----------------------------------------------------------
			Include jQuery
		-----------------------------------------------------------*/
		
		wp_enqueue_script('jquery');

		/*-----------------------------------------------------------
			This part loads a JavaScript file that enables old versions of Internet Explorer to recognize the new HTML5 element
		-----------------------------------------------------------*/
		
		global $is_IE;
		if ($is_IE) { 
			wp_enqueue_script( 'html5',  get_template_directory_uri().'/js/html5.js', '', '', '' );
		}
		/*-----------------------------------------------------------
			Keyboard Image Navigation
		-----------------------------------------------------------*/
		
		if (is_singular() && wp_attachment_is_image()) {
			wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', '', '',  'footer' );
		}

		/*-----------------------------------------------------------
			Include google maps 
		-----------------------------------------------------------*/

		wp_deregister_script('googlemaps');
		wp_register_script('googlemaps', 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false', NULL, true);
		wp_enqueue_script('googlemaps');
			
		/*-----------------------------------------------------------
	    	Base custom scripts
	    -----------------------------------------------------------*/

		wp_enqueue_script( 'base', get_template_directory_uri().'/js/base.js', '', '', '' );

		/*-----------------------------------------------------------
			FlexSlider
		-----------------------------------------------------------*/
		
		wp_enqueue_script( 'flexslider', get_template_directory_uri().'/js/jquery.flexslider-min.js', '', '', 'footer' );

		/*-----------------------------------------------------------
			Equal Height
		-----------------------------------------------------------*/
		
		wp_enqueue_script( 'equalheights', get_template_directory_uri().'/js/jquery.equalHeights.js', '', '', 'footer' );

		/*-----------------------------------------------------------
			meanMenu
		-----------------------------------------------------------*/
		
		wp_enqueue_script( 'meanmenu', get_template_directory_uri().'/js/jquery.meanmenu.js', '', '', 'footer' );

		/*-----------------------------------------------------------
			Fitvids
		-----------------------------------------------------------*/
		wp_enqueue_script( 'fitvids', get_template_directory_uri().'/js/jquery.fitvids.js', '', '', 'footer' );

		/*-----------------------------------------------------------
			Modernizr
		-----------------------------------------------------------*/
		wp_enqueue_script( 'modernizr', get_template_directory_uri().'/js/modernizr.custom.js', '', '', 'footer' );

		if ( ot_get_option('wpl_bg_function') == 'on' ){

			/*-----------------------------------------------------------
				Supersized
			-----------------------------------------------------------*/
			wp_enqueue_script( 'supersized', get_template_directory_uri().'/js/supersized.3.2.7.min.js', '', '', '' );

			
			/*-----------------------------------------------------------
				Supersized Shutter
			-----------------------------------------------------------*/
			wp_enqueue_script( 'supersizedshutter', get_template_directory_uri().'/js/supersized.shutter.js', '', '', '' );
		}
		
		/*-----------------------------------------------------------
			Touch effects
		-----------------------------------------------------------*/
		wp_enqueue_script( 'toucheffects', get_template_directory_uri().'/js/toucheffects.js', '', '', 'footer' );

		/*-----------------------------------------------------------
			prettyPhoto
		-----------------------------------------------------------*/
		
		wp_deregister_script('prettyphoto');
		wp_enqueue_script( 'prettyPhoto', get_template_directory_uri().'/inc/prettyPhoto/js/jquery.prettyPhoto.js', '', '', 'footer' );
		wp_enqueue_script('prettyphoto');
		
		/*	----------------------------------------------------------
			Likes
		= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = */
		wp_enqueue_script('like_post', get_template_directory_uri().'/js/post-like.js', array('jquery'), '1.0', 1 );
		wp_localize_script('like_post', 'ajax_var', array(
			'url' => admin_url('admin-ajax.php'),
			'nonce' => wp_create_nonce('ajax-nonce')
		));

		/*-----------------------------------------------------------
			Audiojs
		-----------------------------------------------------------*/

		wp_deregister_script('audiojs');
		wp_register_script('audiojs', get_template_directory_uri().'/inc/audiojs/audio.js', '', '', '' );
		wp_enqueue_script('audiojs');
		

	}
	add_action('wp_enqueue_scripts', 'wpl_scripts_include');
}


/*  ----------------------------------------------------------
	Include Script for Internet Explorer ver 6 and 7
= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = */
if(preg_match('/(?i)msie [6-7]/',$_SERVER['HTTP_USER_AGENT'])) {
	function wplook_ie_version() {
		 wp_enqueue_script( 'customicons', get_template_directory_uri() . '/css/customicons/ie7.js', '', '',  '' );
		}
	add_filter( 'wp_head', 'wplook_ie_version' );
}


if(preg_match('/(?i)msie [6-7]/',$_SERVER['HTTP_USER_AGENT'])) {
	function wpl_css_includeie () {
		wp_register_style('customi', get_template_directory_uri().'/css/customicons/ie7.css', 'css', '');
		wp_enqueue_style('customi');
	}
	add_action( 'wp_enqueue_scripts', 'wpl_css_includeie' );
}

/*-----------------------------------------------------------------------------------*/
/*	Title
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wplook_wp_title' ) ) {

	function wplook_wp_title( $title, $sep ) {
		global $paged, $page;

		if ( is_feed() )
			return $title;

		// Add the site name.
		$title .= get_bloginfo( 'name' );

		// Add the site description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			$title = "$title $sep $site_description";

		// Add a page number if necessary.
		if ( $paged >= 2 || $page >= 2 )
			$title = "$title $sep " . sprintf( __( 'Page %s', 'wplook' ), max( $paged, $page ) );

		return $title;
	}
	add_filter( 'wp_title', 'wplook_wp_title', 10, 2 );
}

/*-----------------------------------------------------------------------------------*/
/*	Doctitle
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wplook_doctitle' ) ) {
	function wplook_doctitle() {

		if ( is_search() ) { 
		  $content = __('Search Results for:', 'wplook'); 
		  $content .= ' ' . esc_html(stripslashes(get_search_query()));
		}

		elseif ( is_category() ) {
		  $content = __('Category Archives:', 'wplook');
		  $content .= ' ' . single_cat_title("", false);
		}

		elseif ( is_day() ) {
			$content = __( 'Daily Archives:', 'wplook');
			$content .= ' ' . esc_html(stripslashes( get_the_date()));
		}
		
		elseif ( is_month() ) {
			$content = __( 'Monthly Archives:', 'wplook');
			$content .= ' ' . esc_html(stripslashes( get_the_date( 'F Y' )));
		}
		elseif ( is_year()  ) {
			$content = __( 'Yearly Archives:', 'wplook');
			$content .= ' ' . esc_html(stripslashes( get_the_date( 'Y' ) ));
		}		
		
		elseif ( is_tag() ) { 
		  $content = __('Tag Archives:', 'wplook');
		  $content .= ' ' . single_tag_title( '', false );
		}

		elseif ( is_author() ) { 
		  $content = __("Author's Posts", 'wplook');
		  
		} 
		
		elseif ( is_404() ) { 
		  $content = __('Not Found', 'wplook'); 
		}
		
		else { 
			$content = '';
		}
		
		$elements = array("content" => $content);   

		// Filters should return an array
		$elements = apply_filters('wplook_doctitle', $elements);
		
		// But if they don't, it won't try to implode
			if(is_array($elements)) {
			  $doctitle = implode(' ', $elements);
			} else {
			  $doctitle = $elements;
			}

			if ( is_search() || is_category() || is_day() || is_month() || is_year() || is_404() || is_tag() || is_author() ) {
				$doctitle = "<div class=\"doctitle\">" . $doctitle . "</div>";
			}

		echo $doctitle;

	} 
} ?>