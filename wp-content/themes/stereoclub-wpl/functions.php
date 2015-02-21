<?php
/**
 * StereoClub functions and definitions
 *
 * @package WordPress
 * @subpackage StereoClub
 * @since StereoClub 1.0
 */


/*-----------------------------------------------------------------------------------*/
/*	Content Width
/*-----------------------------------------------------------------------------------*/

if ( ! isset( $content_width ) )
	$content_width = 790; /* pixels */

/*-----------------------------------------------------------------------------------*/
/*	Include Option Tree
/*-----------------------------------------------------------------------------------*/

	/*-----------------------------------------------------------
		Optional: set 'ot_show_pages' filter to false.
		This will hide the settings & documentation pages.
	-----------------------------------------------------------*/

	add_filter( 'ot_show_pages', '__return_true' );


	/*-----------------------------------------------------------
		Optional: set 'ot_show_new_layout' filter to false.
		This will hide the "New Layout" section on the Theme Options page.
	-----------------------------------------------------------*/

	add_filter( 'ot_show_new_layout', '__return_false' );


	/*-----------------------------------------------------------
		Required: set 'ot_theme_mode' filter to true.
	-----------------------------------------------------------*/

	add_filter( 'ot_theme_mode', '__return_true' );


	/*-----------------------------------------------------------
		Required: include OptionTree.
	-----------------------------------------------------------*/

	include_once( get_template_directory() . '/option-tree/ot-loader.php' );
	include_once( get_template_directory() . '/inc/theme-options.php' );
	include_once( get_template_directory() . '/inc/custom-post-type/meta-boxes.php' );


/*-----------------------------------------------------------------------------------*/
/*	Theme setup
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wplook_setup' ) ) :

function wplook_setup() {


	/*-----------------------------------------------------------
		Make theme available for translation
	-----------------------------------------------------------*/

	load_theme_textdomain( 'wplook', get_template_directory() . '/languages' );


	/*-----------------------------------------------------------
		Theme style for the visual editor
	-----------------------------------------------------------*/
	
	add_editor_style( 'css/editor-style.css' );

	/*-----------------------------------------------------------
		Add default posts and comments RSS feed links to head
	-----------------------------------------------------------*/
	
	add_theme_support( 'automatic-feed-links' );


	/*-----------------------------------------------------------
		Enable support for Post Thumbnails on posts and pages
	-----------------------------------------------------------*/
	
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'small-thumb', 80, 80, true );
	add_image_size( 'medium-thumb', 300, 300, true );
	add_image_size( 'medium-ver-thumb', 320, 170, true );
	add_image_size( 'medium-hor-thumb', 320, 472, true );
	add_image_size( 'medium-large-thumb', 440, 340, true );
	add_image_size( 'large-thumb', 800, 500, true );
	add_image_size( 'bg-thumb', 1920, 1080, true );
	
	/*-----------------------------------------------------------
		Register menu
	-----------------------------------------------------------*/
	
	function register_my_menus() {
		register_nav_menus(
				array(
					'primary' => __( 'Main Menu', 'wplook' ),
					'language' => __( 'Language Menu', 'wplook' ),
				) 
		);
	}

	add_action( 'init', 'register_my_menus' );
	wp_create_nav_menu( 'Main Menu', array( 'slug' => 'primary' ) );
	wp_create_nav_menu( 'Language Menu', array( 'slug' => 'language' ) );
	
	/*-----------------------------------------------------------
		Enable support for Post Formats
	-----------------------------------------------------------*/
	
	add_theme_support( 'post-formats', array( 'status' ) );


	/*-----------------------------------------------------------
		Add theme Support Custom Background
	-----------------------------------------------------------*/
	
	add_theme_support( 'custom-background' );


	/*-----------------------------------------------------------
		Add theme Support  Custom Header
	-----------------------------------------------------------*/
	
	add_theme_support( 'custom-header' );

}
endif; // wplook_setup
add_action( 'after_setup_theme', 'wplook_setup' );



/*-----------------------------------------------------------------------------------*/
/*	Include Theme specific functionality
/*-----------------------------------------------------------------------------------*/

include_once( get_template_directory() . '/inc/widgets/widget-init.php' );				// Initiate all widgets
include_once( get_template_directory() . '/inc/headerdata.php' );						// Include header data
include_once( get_template_directory() . '/inc/library.php' );							// Include other functions
include_once( get_template_directory() . '/inc/custom-post-type/events.php' );			// Include Post Type Events
include_once( get_template_directory() . '/inc/custom-post-type/video.php' );			// Include Post Type Video
include_once( get_template_directory() . '/inc/custom-post-type/gallery.php' );			// Include Post Type Pledges
include_once( get_template_directory() . '/inc/custom-post-type/dj.php' );				// Include Post Type Resident DJ's
include_once( get_template_directory() . '/inc/custom-post-type/cd.php' );				// Include Post Type CD
require_once (get_template_directory() . '/inc/' . 'comment.php');						// Comments


/*-----------------------------------------------------------------------------------*/
/*	Custom Background
/*-----------------------------------------------------------------------------------*/

$defaults = array(
	'default-color'          => '1c1d21',
	'default-image'          => '',
	'wp-head-callback'       => '_custom_background_cb',
	'admin-head-callback'    => '',
	'admin-preview-callback' => ''
);
add_theme_support( 'custom-background', $defaults );


/*-----------------------------------------------------------
	Custom Header
-----------------------------------------------------------*/

$defaults = array(
	'default-image'          => '',
	'random-default'         => false,
	'width'                  => '1200',
	'height'                 => '380',
	'flex-height'            => true,
	'flex-width'             => true,
	'default-text-color'     => '',
	'header-text'            => false,
	'uploads'                => true,
	'wp-head-callback'       => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
);
add_theme_support( 'custom-header', $defaults );



/*-----------------------------------------------------------------------------------*/
/*	BE Dashbord Widget
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wplook_dashboard_widgets' ) ) {

	function wplook_dashboard_widgets() {
		global $wp_meta_boxes;
		unset(
			$wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins'],
			$wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary'],
			$wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']
		);
			wp_add_dashboard_widget( 'dashboard_custom_feed', '<a href="https://wplook.com?utm_source=Our-Themes&utm_medium=rss&utm_campaign=StereoClub">WPlook News</a>' , 'dashboard_custom_feed_output' );
	}
	add_action('wp_dashboard_setup', 'wplook_dashboard_widgets');
}


if ( ! function_exists( 'dashboard_custom_feed_output' ) ) {

	function dashboard_custom_feed_output() {
		echo '<div class="rss-widget rss-wplook">';
		wp_widget_rss_output(array(
			'url' => 'http://feeds.feedburner.com/wplook',
			'title' => '',
			'items' => 5,
			'show_summary' => 1,
			'show_author' => 0,
			'show_date' => 1
			));
		echo '</div>';
	}
}

if ( ! function_exists( 'wplook_bar_menu' ) ):

	function wplook_bar_menu() {
		global $wp_admin_bar;
		if ( !is_super_admin() || !is_admin_bar_showing() )
			return;
		$admin_dir = get_admin_url();

		$wp_admin_bar->add_menu( 
			array(
				'id' => 'custom_menu',
				'title' => __( 'WPlook Panel', 'wplook' ),
				'href' => FALSE,
				'meta' => array('title' => 'WPlook Options Panel', 'class' => 'wplookpanel') 
			) 
		);

		$wp_admin_bar->add_menu(
			array(
				'id' => 'wpl_to',
				'parent' => 'custom_menu',
				'title' => __( 'Theme Options', 'wplook' ),
				'href' => $admin_dir .'themes.php?page=ot-theme-options',
				'meta' => array('title' => 'Theme Option') 
			)
		);

		$wp_admin_bar->add_menu(
			array(
				'id' => 'wpl_sp',
				'parent' => 'custom_menu',
				'title' => __( 'Support', 'wplook' ),
				'href' => 'https://wplook.com/help/?utm_source=Support&utm_medium=link&utm_campaign=StereoClub',
				'meta' => array('title' => 'Support') 
			)
		);


		$wp_admin_bar->add_menu(
			array(
				'id' => 'wpl_wt',
				'parent' => 'custom_menu',
				'title' => __( 'Our Themes', 'wplook' ),
				'href' => 'https://wplook.com/wordpress/themes/?utm_source=Our-Themes&utm_medium=link&utm_campaign=StereoClub',
				'meta' => array('title' => 'Our Themes')
				)
		);

		$wp_admin_bar->add_menu(
			array(
				'id' => 'wpl_fb',
				'parent' => 'custom_menu',
				'title' => __( 'Become our fan on Facebook', 'wplook' ),
				'href' => 'http://www.facebook.com/wplookthemes',
				'meta' => array('target' => 'blank', 'title' => 'Become our fan on Facebook') 
			)
		);

		$wp_admin_bar->add_menu(
			array(
				'id' => 'wpl_tw',
				'parent' => 'custom_menu',
				'title' => __( 'Follow us on Twitter', 'wplook' ),
				'href' => 'http://twitter.com/#!/wplook',
				'meta' => array('target' => 'blank', 'title' => 'Follow us on Twitter')
			)
		);
	}
	add_action('admin_bar_menu', 'wplook_bar_menu', '1000');
endif;